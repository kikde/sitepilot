<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Modules\Setting\Entities\Setting;
use Modules\Page\Entities\Sector;
use Modules\Page\Entities\Testimonial;
use Modules\Page\Entities\Manageteam;
use App\Models\StaticData;
use App\Models\AwardSection;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use View;
use Carbon\Carbon;
use Image;
use Config;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $res_query  = Sector::query();
        $setting    = Setting::first();
        $secmenu    = $res_query->get(['sector_name','id','slug','pagestatus','breadcrumb','description','pagekeyword']);
        $footer     = Sector::query();
        $testi      = Testimonial::latest()->limit(6)->get();
        $manage     = Manageteam::latest()->limit(8)->get();
        $statics    = StaticData::first();
        $award      = AwardSection::get();
        $footermenu = $footer->limit(5)->get(['sector_name','id','slug','pagestatus']);

        View::share([
            'setting'    => $setting,
            'secmenu'    => $secmenu,
            'testi'      => $testi,
            'footermenu' => $footermenu,
            'manage'     => $manage,
            'statics'    => $statics,
            'award'      => $award,
        ]);
    }

    /** Show the public member registration form */
    public function showMemberRegistrationForm(Request $request)
    {

         if ($request->filled('ref')) {
        Session::put('ref_code', $request->query('ref'));
         }

         $refCode   = Session::get('ref_code');
         $referrer  = null;
        if ($refCode) {
        // Optionally only allow role=2 as referrer
            $referrer = User::where('referral_code', $refCode)
                // ->where('role', 2) // uncomment if you want to restrict
                ->select('id','name','email','referral_code')
                ->first();
            }

        $getlist = Config::get('constants.state', []);
        return view('frontend.pages.member-registration', compact('getlist','refCode','referrer'));
    }

    /** AJAX: return <option> list of cities for a given state key */
public function fetchCitiesByState(Request $request)
{
    $request->validate(['sid' => 'required|string']);

    $getlist = Config::get('constants.state', []);
    $cities  = $getlist[$request->sid] ?? [];

    $html = '<option value="">Select City</option>';

    foreach ($cities as $city) {
        $html .= '<option value="'.$city.'">'.$city.'</option>';
    }

    return response($html);
}
    /** Handle form submit and persist member into users table (PRIVATE storage for files) */
public function storeMemberRegistration(Request $request)
{
    // --- legacy field aliases ---
    if ($request->filled('fname') && !$request->filled('father_name')) {
        $request->merge(['father_name' => $request->input('fname')]);
    }
    if ($request->hasFile('brouchure') && !$request->hasFile('document')) {
        $request->files->set('document', $request->file('brouchure'));
    }
    if ($request->hasFile('documents') && !$request->hasFile('document')) {
        $request->files->set('document', $request->file('documents'));
    }

    // --- validation ---
    $rules = [
        'name'            => 'required|string|max:190',
        'email'           => 'nullable|email|max:190|unique:users,email',
        // Indian mobile: 10 digits, starts 6-9
        'mobile'          => [
            'required',
            'regex:/^[6-9]\d{9}$/',
            'unique:users,mobile'
        ],
        'father_name'     => 'nullable|string|max:190',
        'dob'             => 'nullable|date',
        'gender'          => 'nullable|string|max:20',
        'profession'      => 'nullable|string|max:190',
        'address'         => 'nullable|string|max:500',
        'pincode'         => 'nullable|string|max:10',
        'state'           => 'nullable|string|max:100',
        'city'            => 'nullable|string|max:100',
        'bloodgroup'      => 'nullable|string|max:10',
        'idtype'          => 'nullable|string|max:100',

        // files
        'profile_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:3072',
        'document'        => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
        'other_document'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
    ];

    $messages = [
        'profile_image.image' => 'Please upload a valid image (jpg, jpeg, png, webp, gif).',
        'profile_image.max'   => 'Profile image may not be greater than 3 MB.',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        return $request->expectsJson()
            ? response()->json(['status' => 'error', 'errors' => $validator->errors()], 422)
            : back()->withErrors($validator)->withInput();
    }

    try {
        $newUserId = DB::transaction(function () use ($request) {

            // Resolve referrer
            $refCode = $request->input('ref') ?: Session::get('ref_code');
            $referrerId = null;
            if ($refCode) {
                $ref = User::where('referral_code', $refCode)->select('id')->first();
                if ($ref) $referrerId = $ref->id;
            }

            // 1) Create user FIRST (we need id for folder paths)
            $user = new User();
            $user->name        = $request->name;
            $user->email       = $request->email;
            $user->mobile      = $request->mobile;
            $user->password    = Hash::make(Str::random(12));

            $user->fname       = $request->father_name;
            $user->dob         = $request->dob;
            $user->gender      = $request->gender;
            $user->education   = $request->profession;
            $user->occupation  = $request->profession;
            $user->desg        = 'Member';

            $user->address     = $request->address;
            $user->landmark    = null;
            $user->pincode     = $request->pincode;
            $user->state       = $request->state;
            $user->city        = $request->city;

            // defaults
            $user->role        = '2';
            $user->status      = '0';
            $user->useractive  = '0';
            $user->topten      = '0';
            $user->pow         = '0';
            $user->bloodgroup  = $request->bloodgroup;
            $user->bpscell     = null;

            // id docs meta
            $user->idtype      = $request->idtype;
            $user->addtype     = $request->idtype;

            // membership validity
            $user->valid_upto  = Carbon::now()->addYear()->format('d-m-Y');

            // referrals
            $user->referrer_id = $referrerId;
            if (empty($user->referral_code)) {
                do {
                    $code = Str::upper(Str::random(8));
                } while (User::where('referral_code', $code)->exists());
                $user->referral_code = $code;
            }

            $user->save(); // <-- NOW we have $user->id

            // 2) FILES
            // Profile photo → PUBLIC disk (displayable via Storage::url)
            // if ($request->hasFile('profile_image')) {
            //     $path = $request->file('profile_image')
            //         ->store("backend/uploads/members", 'public'); // storage/app/public/...
            //     $user->profile_image = $path; // e.g. users/123/profile/abc.jpg
            // }
               if ($request->hasFile('profile_image')) {

                $file = $request->file('profile_image');
            
                // unique file name
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
                // move to public/backend/uploads/members
                $file->move(public_path('backend/uploads/members'), $filename);
            
                // optional: delete old image
                if ($user->profile_image && file_exists(public_path('backend/uploads/members/'.$user->profile_image))) {
                    @unlink(public_path('backend/uploads/members/'.$user->profile_image));
                }
            
                // store only filename in DB
                $user->profile_image = $filename;
            }
          

            // ID document → PRIVATE disk (not publicly accessible)
            if ($request->hasFile('document')) {
                $path = $request->file('document')
                    ->store("users/{$user->id}/idproof", 'private'); // storage/app/private/...
                $user->idproof_doc = $path;
            }

            // Other document → PRIVATE disk
            if ($request->hasFile('other_document')) {
                $path = $request->file('other_document')
                    ->store("users/{$user->id}/other", 'private');
                $user->other_doc = $path;
            }

            if (empty($user->other_doc) && !empty($user->idproof_doc)) {
                $user->other_doc = $user->idproof_doc;
            }

            $user->save();

            // Clear referral code after use
            Session::forget('ref_code');

            return $user->id;
        });
        session(['payment_member_id' => $newUserId]);

        // Send registration confirmation + email verification (if email was provided)
        try {
            $member = User::find($newUserId);
            if ($member && filled($member->email)) {
                // 1) Confirmation email
                $msg  = '<p>Dear '.e($member->name).',</p>';
                $msg .= '<p>Your registration has been submitted successfully. Our team will verify your details and activate your ID soon.</p>';
                $msg .= '<p>If you have not done so already, please verify your email address to complete your profile.</p>';
                $msg .= '<p><a href="'.e(route('verification.notice')).'" style="display:inline-block;padding:8px 14px;background:#ff4d4d;color:#fff;border-radius:6px;text-decoration:none;">Verify Email</a></p>';

                $subject = 'Registration Received - '.(config('app.name'));
                Mail::to($member->email)->send(new BasicMail([
                    'subject' => $subject,
                    'message' => $msg,
                ]));

                // 2) Laravel verification email (sends signed link)
                // Use the App\\Models\\User instance to leverage MustVerifyEmail
                $portalUser = \App\Models\User::find($newUserId);
                if ($portalUser && method_exists($portalUser, 'sendEmailVerificationNotification')) {
                    $portalUser->sendEmailVerificationNotification();
                }
            }
        } catch (\Throwable $mailEx) {
            \Log::warning('Registration mail/verification send failed', ['error' => $mailEx->getMessage()]);
        }
        return redirect()
            ->route('member.register.show')
            ->with([
                'success'     => 'Registration received! Our team will verify and activate your ID soon.',
                'member_name' => $request->name,
                'member_id'   => $newUserId,
            ]);

    } catch (\Throwable $e) {
        Log::error('Member registration failed', [
            'error' => $e->getMessage(),
            'line'  => $e->getLine(),
            'file'  => $e->getFile(),
        ]);

        return back()->withInput()
            ->with('error', 'Something went wrong while saving your registration. Please try again.');
    }

}

    /** Reusable validation rules */
    private function memberRules(): array
    {
        return [
            'name'            => 'required|string|max:150',
            'gender'          => 'nullable|string|max:30',
            'dob'             => 'nullable|date',
            'father_name'     => 'nullable|string|max:150',
            'profession'      => 'nullable|string|max:150',
            'bloodgroup'      => 'nullable|string|max:10',
            'state'           => 'required|string|max:100',
            'city'            => 'required|string|max:120',
            'mobile'          => ['required','regex:/^[6-9]\d{9}$/','unique:users,mobile'],
            'email'           => 'nullable|email|max:190|unique:users,email',
            'address'         => 'required|string|max:255',
            'pincode'         => 'required|string|max:12',
            'idtype'          => 'required|string|max:100',
            'profile_image'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'document'        => 'required|file|mimes:jpeg,png,jpg,pdf|max:4096',
            'other_document'  => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
        ];
    }

    /** Reusable validation messages */
    private function memberMessages(): array
    {
        return [
            'images.required'   => 'Please upload your profile photo.',
            'document.required' => 'Please upload your ID document.',
        ];
    }

    /** (Optional) standalone thank-you page */
    public function showThankYou($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.partials.response.thankyou-1', compact('user'));
    }

   public function getCardDownload(){
      
        return view('frontend.pages.member-pdfdownload');

   }
    
   public function printIdcard(Request $request)
{
    // 1. Validate basic input
    $request->validate([
        'mobile'   => 'required',
        'dob'      => 'required',
        'cardtype' => 'required|in:idcard,honor-letter,certificate,payment-receipt',
    ]);

    // 2. Find user by mobile + dob
    $user = User::where('dob', $request->dob)
        ->where('mobile', $request->mobile)
        ->first();

    if (!$user) {
        return redirect()->back()->with('message', "Record Not Matched");
    }

    // 3. Check if user is active
    if ($user->status != 1 || $user->useractive != 1) {
        return redirect()->back()
            ->with('message', "Your membership is not active yet. Please contact administration.");
    }

    // 4. Map cardtype to DB column name
    // 👉 I recommend using underscore column names in DB: idcard, honor_letter, certificate, payment_receipt
    $columnMap = [
        'idcard'           => 'idcard',
        'honor-letter'     => 'honor_letter',
        'certificate'      => 'official_2',
        'payment-receipt'  => 'payment_receipt',
    ];

    $cardtype = $request->cardtype;

    if (!array_key_exists($cardtype, $columnMap)) {
        return redirect()->back()->with('error', "Invalid document type selected.");
    }

    $columnName = $columnMap[$cardtype];

    // 5. Get file path from user record
    $file = $user->$columnName;

    if (!$file) {
        return redirect()->back()->with('message', "File not uploaded yet. Please contact administration.");
    }

    // 6. Build real path & download
    // If you store files in: storage/app/public/...
    $fullPath = storage_path('app/public/' . $file);

    if (!file_exists($fullPath)) {
        return redirect()->back()->with('message', "File not found on server. Please contact administration.");
    }

    return response()->download($fullPath);
}


}
