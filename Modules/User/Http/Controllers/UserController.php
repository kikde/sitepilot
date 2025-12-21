<?php
namespace Modules\User\Http\Controllers;
use App\Models\Payment;   
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\Note;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\User\Services\ApiShot;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // for directory ensure
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Modules\Page\Entities\Page;
use Config;
use View;
use Auth;
use Carbon\Carbon;
use DB;
/**
 * UserController
 *
 * This controller manages:
 * - Admin CRUD (role 1)
 * - Member/User CRUD (role 2/0) + list screens
 * - Flags: Top-Ten, Featured
 * - Account status: Activate/Deactivate
 * - Document rendering via APIshot (receipt, affidavit, batch docs)
 * - Frontend card views used as render targets (idcard, letters, receipt)
 * - Notes (admin-only)
 *
 * Routes are grouped/renamed for clarity (see routes/web.php in your app).
 * Back-compat method aliases are kept so older Blade/actions continue to work.
 */
class UserController extends Controller
{
    /* =========================================================================
     | Constructor
     |========================================================================= */
    public function __construct()
    {
        // $this->middleware('auth'); // enable if you want auth protection
        if (! app()->runningInConsole()) {
            try {
                $setting = Setting::first();
            } catch (\Throwable $e) {
                $setting = null;
            }
            try {
                $stampsign = Page::where('types', "DM")->first();
            } catch (\Throwable $e) {
                $stampsign = null;
            }
            View::share(['setting' => $setting, 'stampsign' => $stampsign]);
        }
    }

    /* =========================================================================
     | ADMIN MANAGEMENT (role = 1)
     | - Index/Create used by /admins resource routes
     |========================================================================= */
  public function index()
{      
      $me = Auth::user();

    // Main admin condition: by email (best) or by name
    $isMainAdmin = ($me->email === 'sara@kikde.com'); 
    // OR: $isMainAdmin = ($me->name === 'sara');

    $query = User::query()->where('role', 1);

    if (!$isMainAdmin) {
        $query->where('id', $me->id); // only self
    }

    $user = $query->simplePaginate(5);

    return view('user::index', compact('user'));
}

    public function create()
    {
        abort_unless(auth()->user()->role == 1, 403);
        return view('user::add');
    }

    public function Adminstore(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required',
            'mobile'   => 'required|unique:users',
        ]);

        $user = new User;

     if ($request->hasFile('profile_image')) {
    $file   = $request->file('profile_image');
    $dest   = public_path('backend/uploads/admin');
    if (!File::exists($dest)) {
        File::makeDirectory($dest, 0755, true);
    }

    $ext      = strtolower($file->getClientOriginalExtension());
    $filename = 'profile_'.$user->id.'_'.time().'.'.$ext;

    // Save processed image straight to public folder
    Image::make($file)->orientate()->save($dest.'/'.$filename, 90);
   
    $user->profile_image = $filename; // relative public path
      }
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->mobile     = $request->mobile;
        $user->password   = Hash::make($request->password);
        $user->role       = $request->role ?? 1;
        $user->useractive = $request->useractive ?? 1;
        $user->save();

        session()->flash('message', 'Admin created!');
        return redirect()->back();
    }

public function Adminupdate(Request $request, $id)
{
    $request->validate([
        'name'   => ['required','string','max:190'],
        'email'  => ['required','email','max:190'],
        'mobile' => ['required','max:30'],
        'profile_image' => ['nullable','image','mimes:jpeg,jpg,png,webp,gif','max:4096'],
        'password' => ['nullable','string','min:6'],
    ]);

    $user = User::findOrFail($id);

    // handle image upload (optional)
      if ($request->hasFile('profile_image')) {
    $file   = $request->file('profile_image');
    $dest   = public_path('backend/uploads/admin');
    if (!File::exists($dest)) {
        File::makeDirectory($dest, 0755, true);
    }

    $ext      = strtolower($file->getClientOriginalExtension());
    $filename = 'profile_'.$user->id.'_'.time().'.'.$ext;

    // Save processed image straight to public folder
    Image::make($file)->orientate()->save($dest.'/'.$filename, 90);
   
    $user->profile_image = $filename; // relative public path
      }
    // other fields
    $user->name   = $request->name;
    $user->email  = $request->email;
    $user->mobile = $request->mobile;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->role       = $request->role       ?? 1;
    $user->useractive = $request->useractive ?? 1;

    $user->save();

    return back()->with('message', 'Admin Updated!');
}

    /* =========================================================================
     | MEMBER/USER CREATION (role 2/0)
     |========================================================================= */
    public function store(Request $request)
    {
         $currentUser = auth()->user();
          // If admin, take the posted referrer_id (but force it to be role=2)
    if ($currentUser->role == 1) {
        $request->validate([
            'referrer_id' => ['nullable','integer','exists:users,id'],
        ]);

        $referrerId = null;
        if ($request->filled('referrer_id')) {
            $chosen = User::find($request->input('referrer_id'));
            // Only allow role=2 as referrer
            $referrerId = ($chosen && $chosen->role == 2) ? $chosen->id : null;
        }
    } else {
        // Regular user: referrer is always themselves
        $referrerId = $currentUser->id;
    }

        $validupto = Carbon::now()->addYear()->format('d-m-Y');

        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users',
            'password'      => 'required',
            'mobile'        => 'required|unique:users',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'idproof_doc'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'referrer_id'    => 'nullable', 'integer', 'exists:users,id',
            'ref'            => 'nullable', 'string', 'max:32' 
        ], [
            'profile_image.required'=> 'Image required please upload your photo',
            'idproof_doc.required'  => 'Allowed JPG, GIF or PNG. Max size of 800kB',
        ]);

  
        $user = new User;

        $user->referrer_id = $referrerId;

     if ($request->hasFile('profile_image')) {
    $file = $request->file('profile_image');
    $dir  = "backend/uploads/members";
    $name = 'profile_'.time().'.'.$file->getClientOriginalExtension();
    // (optional) auto-rotate and re-encode
    $image = Image::make($file)->orientate()->encode($file->getClientOriginalExtension(), 90);
    // save to PUBLIC disk
    Storage::disk('private')->put("$dir/$name", (string) $image);

    // store the disk-relative path in DB (no 'storage/', no 'backend/uploads/')
    $user->profile_image = "$dir/$name";
    }
        // Base fields
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->mobile      = $request->mobile;
        $user->password    = Hash::make($request->password);
        $user->referrer_id   = $referrerId;
        $user->fname       = $request->fname;
        $user->dob         = $request->dob;
        $user->gender      = $request->gender;
        $user->education   = $request->education;
        $user->occupation  = $request->occupation;
        $user->desg        = $request->desg;
        $user->address     = $request->address;
        $user->landmark    = $request->landmark;
        $user->pincode     = $request->pincode;
        $user->state       = $request->state;
        $user->city        = $request->city;
        $user->role        = $request->role ?? 2;
        $user->topten      = '0';
        $user->pow         = '0';
        $user->bloodgroup  = $request->bloodgroup;
        $user->bpscell     = $request->bpscell;
        $user->idtype      = $request->idtype;
if ($request->hasFile('idproof_doc')) {
    $file = $request->file('idproof_doc');
    $dir  = "users/{$user->id}/idproof";
    $name = 'idproof_'.time().'.'.$file->getClientOriginalExtension();
    \Storage::disk('private')->putFileAs($dir, $file, $name);
    $user->idproof_doc = "$dir/$name";
}


        $user->addtype = $request->addtype;
     if ($request->hasFile('other_doc')) {
    $file = $request->file('other_doc');
    $dir  = "users/{$user->id}/other";
    $name = 'other_'.time().'.'.$file->getClientOriginalExtension();
    \Storage::disk('private')->putFileAs($dir, $file, $name);
    $user->other_doc = "$dir/$name";
}

        $user->id_no       = $request->id_no;
        $user->address_no  = $request->address_no;
        $user->useractive  = $request->useractive ?? 1;
        $user->valid_upto  = $validupto;

        $user->save();
        session()->flash('message', 'Member created!');
        return redirect()->back();

}

    /* =========================================================================
     | FILE HELPERS (ID proof / Address proof)
     |========================================================================= */
 protected function Uploadfile(Request $request, User $user)
{
    $file = $request->file('idproof_doc');
    $dir  = "users/{$user->id}/idproof";
    $name = 'idproof_'.time().'.'.$file->getClientOriginalExtension();
    \Storage::disk('private')->putFileAs($dir, $file, $name);
    $user->idproof_doc = "$dir/$name";
}

 protected function Uploadaddress(Request $request, User $user)
{
    $file = $request->file('other_doc');
    $dir  = "users/{$user->id}/other";
    $name = 'other_'.time().'.'.$file->getClientOriginalExtension();
    \Storage::disk('private')->putFileAs($dir, $file, $name);
    $user->other_doc = "$dir/$name";
}

    /* =========================================================================
     | PROFILE (single record edit/update)
     |========================================================================= */
    public function show($id)
    {
        return view('user::add');
    }

    public function edit($id)
    {
        $users = User::find($id);
        $notes = Note::get();
        return view('user::edit', compact('users', 'notes'));
    }

    public function getcity(Request $request)
    {
        $getlist = Config::get('constants.state');
        $result  = $getlist[$request->sid] ?? [];
        $html    = '<option value="">Select City</option>';
        foreach ($result as $list) {
            $html .= '<option value="'.$list.'">'.$list.'</option>';
        }
        return $html;
    }

  public function update(Request $request, $id)
{
    Log::info('User update() called', [
        'id'      => $id,
        'user_id' => auth()->id(),
        'ip'      => $request->ip(),
    ]);

    $request->validate([
        'name'   => 'required',
        'email'  => 'required',
        'mobile' => 'required',
    ]);

    $user = User::where('id', $request->id)->firstOrFail();

     $actor   = auth()->user();

      // Referrer logic
    if ($actor->role == 1) {
        $referrerId = null;
        if ($request->filled('referrer_id')) {
            $candidate = User::find($request->input('referrer_id'));
            $referrerId = ($candidate && $candidate->role == 2) ? $candidate->id : null;
        }
    } else {
        // lock to existing or self
        $referrerId = $user->referrer_id ?: $actor->id;
    }
    Log::info('Loaded user', ['db_id' => $user->id, 'regno' => $user->regno]);

    // Unique constraints (other than current)
    if (User::where('id', '!=', $request->id)->where('email', $request->email)->exists()) {
        Log::warning('Email already exists on another user', ['email' => $request->email, 'current_id' => $request->id]);
        return redirect()->back()->with('Message', 'Email Already Exists');
    }
    if (User::where('id', '!=', $request->id)->where('mobile', $request->mobile)->exists()) {
        Log::warning('Mobile already exists on another user', ['mobile' => $request->mobile, 'current_id' => $request->id]);
        return redirect()->back()->with('Message', 'Mobile Already Exists');
    }

    // ---------- PROFILE IMAGE ----------
    if ($request->hasFile('profile_image')) {
        $postimage = $request->file('profile_image');
        Log::info('profile_image received', [
            'original_name' => $postimage->getClientOriginalName(),
            'mime'          => $postimage->getClientMimeType(),
            'size_bytes'    => $postimage->getSize(),
            'tmp_path'      => $postimage->getRealPath(),
        ]);

        $dir = public_path('backend/uploads/members');
        if (!File::isDirectory($dir)) {
            Log::info('Creating uploads directory', ['dir' => $dir]);
            File::makeDirectory($dir, 0775, true);
        }
        Log::info('Uploads dir writable?', ['dir' => $dir, 'writable' => is_writable($dir)]);

        $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
        $target   = $dir . DIRECTORY_SEPARATOR . $filename;

        try {
            Image::make($postimage)->orientate()->save($target);
            $user->profile_image = $filename;
            Log::info('Profile image saved', ['target' => $target, 'exists' => File::exists($target)]);
        } catch (\Throwable $e) {
            Log::error('Failed saving profile image', ['error' => $e->getMessage(), 'target' => $target]);
        }
    } else {
        Log::info('No profile_image in request');
    }

    // ---------- BASIC FIELDS ----------
    $user->name       = $request->name;
    $user->email      = $request->email;
    $user->mobile     = $request->mobile;
    $user->referrer_id = $referrerId;

    if (!is_null($request->password)) {
        $user->password = Hash::make($request->password);
        Log::info('Password updated');
    }

    $user->fname      = $request->fname;
    $user->dob        = $request->dob;
    $user->gender     = $request->gender;
    $user->education  = $request->education;
    $user->occupation = $request->occupation;
    $user->desg       = $request->desg; 
    $user->address    = $request->address;
    $user->landmark   = $request->landmark;
    $user->pincode    = $request->pincode;
    $user->state      = $request->state;
    $user->city       = $request->city;
    $user->role       = '2';
    $user->bloodgroup = $request->bloodgroup;
    $user->bpscell    = $request->bpscell;
    $user->idtype     = $request->idtype;

    // ---------- ID PROOF DOC ----------
    if ($request->hasFile('idproof_doc')) {
        Log::info('idproof_doc received', [
            'original_name' => $request->file('idproof_doc')->getClientOriginalName(),
            'mime'          => $request->file('idproof_doc')->getClientMimeType(),
            'size_bytes'    => $request->file('idproof_doc')->getSize(),
        ]);

        try {
            $this->Uploadfile($request, $user); // make sure this stores into public/backend/uploads OR storage/app/public/...
            Log::info('Uploadfile() completed', ['user_id' => $user->id, 'idproof_doc' => $user->idproof_doc]);
        } catch (\Throwable $e) {
            Log::error('Uploadfile() failed', ['error' => $e->getMessage()]);
        }
    } else {
        Log::info('No idproof_doc in request');
    }

    $user->addtype = $request->addtype;

    // ---------- OTHER DOC ----------
    if ($request->hasFile('other_doc')) {
        Log::info('other_doc received', [
            'original_name' => $request->file('other_doc')->getClientOriginalName(),
            'mime'          => $request->file('other_doc')->getClientMimeType(),
            'size_bytes'    => $request->file('other_doc')->getSize(),
        ]);

        try {
            $this->Uploadaddress($request, $user);
            Log::info('Uploadaddress() completed', ['user_id' => $user->id, 'other_doc' => $user->other_doc]);
        } catch (\Throwable $e) {
            Log::error('Uploadaddress() failed', ['error' => $e->getMessage()]);
        }
    } else {
        Log::info('No other_doc in request');
    }

    $user->id_no      = $request->id_no;
    $user->address_no = $request->address_no;
    $user->useractive = $request->useractive ?? 1;
    $user->valid_upto = $request->valid_upto;

    // ---------- REG NUMBER ----------
    $dis   = str_replace(' ', '', strtoupper(substr($user->city ?? '', 0, 6)));
    $scode = $user->state ?? '';
    preg_match('#\((.*?)\)#', $scode, $match);
    $stateCode = $match[1] ?? 'NA';
    $user->regno = 'HHF/'.$stateCode.'/'.$dis.'/'.$id;
    Log::info('Regno computed', ['regno' => $user->regno, 'state' => $user->state, 'city' => $user->city]);

    $user->save();
    Log::info('User saved', [
        'id'             => $user->id,
        'profile_image'  => $user->profile_image ? ('backend/uploads/'.$user->profile_image) : null,
        'idproof_doc'    => $user->idproof_doc ?? null,
        'other_doc'      => $user->other_doc ?? null,
    ]);

    session()->flash('message', 'User Updated!');
    return redirect()->back()->with('message', "Updated Successfully");
}

    public function destroy($id)
    {
        if ($u = User::find($id)) {
            $u->delete();
        }
        return redirect()->back()->with('message', "Deleted Successfully");
    }

    /* =========================================================================
     | USERS LIST (members) — clearer name + back-compat alias
     |========================================================================= */
/* =========================================================================
 | USERS LIST (members) — clearer name
 |========================================================================= */
public function usersIndex()
{
      $authUser = Auth::user();

    $query = User::query()
        ->whereNull('deleted_at')
        ->where(function ($q) {
            $q->where('role', 2)->orWhere('role', 0);
        })
        ->with([
            'latestPayment' => function ($q) {
                $q->select(
                    'payments.id',
                    'payments.user_id',
                    'payments.payment_rec',
                    'payments.updated_at'
                );
            }
        ]);

    // 🧩 Show all if admin, or only referrer's users otherwise
    if ($authUser->role != 1) {
        $query->where('referrer_id', $authUser->id);
    }

    $user = $query->latest()->simplePaginate(10);

    return view('user::users.index', compact('user'));
}
    // Back-compat for old route /userslist
    public function getUser()
    {
        return $this->usersIndex();
    }

    public function addUser()
    {
        $getlist = Config::get('constants.state');
          $currentUser = auth()->user();

    if ($currentUser->role == 1) {
        // Admin: can choose any non-admin (role=2) as referrer
        $possibleReferrers = User::where('role', 2)
            ->orderBy('name')
            ->get(['id','name','email']);
    } else {
        // Regular user: they are the only valid referrer (self)
        $possibleReferrers = collect([$currentUser]);
    }
        return view('user::users.add', compact('possibleReferrers', 'currentUser','getlist'));
    }

    public function editUser($id)
    {
        $getlist = Config::get('constants.state');
        $users   = User::find($id);
        $payment = Payment::where('user_id', $id)->first();
        
             // make sure the user has a referral_code
    if (empty($users->referral_code)) {
        do {
            $code = Str::upper(Str::random(8));
        } while (User::where('referral_code', $code)->exists());
        $users->referral_code = $code;
        $users->save();
    }

    // build the share URL for /member-registration
    // (if you have a named route, you can use route('member.registration', ['ref' => $users->referral_code]))
    $shareUrl = url('/member-registration?ref=' . $users->referral_code);

    $currentUser = auth()->user();
    if ($currentUser->role == 1) {
        $possibleReferrers = User::where('role', 2)
            ->orderBy('name')
            ->get(['id','name','email']);
    } else {
        $possibleReferrers = collect([$currentUser]);
    }


        return view('user::users.edit', compact('users', 'getlist', 'payment', 'possibleReferrers', 'shareUrl'));
    }

    /* =========================================================================
     | FRONTEND RENDER TARGETS (APIshot loads these URLs)
     |========================================================================= */
    public function letterCard($id)   { $data    = User::findOrFail($id) ; return view('frontend.templates.idcard.style-1',     compact('data')); }
    public function joinLetter($id)   { $jletter = User::findOrFail($id) ; return view('frontend.templates.membership.style-1', compact('jletter')); }
    public function honarLetter($id)  { $hletter = User::findOrFail($id) ; return view('frontend.templates.other.honarletter',  compact('hletter')); }
    public function offLetter($id)    { $jletter = User::findOrFail($id) ; return view('frontend.templates.other.offical1',     compact('jletter')); }
    public function offtwoetter($id)  { $data = User::findOrFail($id) ; return view('frontend.templates.certificates.style-1',    compact('data')); }
    public function affiLatter($id)   { $aff     = User::findOrFail($id) ; return view('frontend.templates.affidavit.style-1',   compact('aff')); }
    public function recPayment($id)   { $payrec  = User::findOrFail($id) ; return view('frontend.templates.receipt.style-2',    compact('payrec')); }



public function updateAffi(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'after_verifiy_affidavit' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
    ]);

    $file = $request->file('after_verifiy_affidavit');
    $dir  = "users/{$user->id}/affidavit/after";
    $name = 'aff_after_'.time().'.'.$file->getClientOriginalExtension();
    \Storage::disk('private')->putFileAs($dir, $file, $name);

    // store relative path
    $user->after_verifiy_affidavit = "$dir/$name";
    $user->save();

    return back()->with('message', 'Uploaded Successfully');
}


    /* =========================================================================
     | BASE URL HELPERS
     |========================================================================= */
    private function viewBase(): string
    {
        return rtrim(config('member.viewbase') ?? env('VIEW_BASE', url('/')), '/');
    }

    private function buildViewUrl(string $path, $id): string
    {
        return $this->viewBase() . '/' . trim($path, '/') . '/' . $id;
    }

    /** Build relative route slug used by ApiShot::capture, e.g. "payment-receipt/74" */
    private function vurl(string $slug, $id): string
    {
        return trim($slug, '/').'/'.$id;
    }

    /**
     * Build a temporary signed, absolute render URL for a given slug and user id.
     * Uses the same host as your configured VIEW_BASE so the signature validates when fetched by APIshot.
     */
    private function signedRenderUrl(string $slug, int $id, int $ttlSeconds = 120): string
    {
        $map = [
            'idcard'            => 'render.idcard',
            'joining-letter'    => 'render.joining',
            'off1-letter'       => 'render.off1',
            'off2-letter'       => 'render.off2',
            'honor-letter'      => 'render.honor',
            'payment-receipt'   => 'render.receipt',
            'affidavit'         => 'render.affidavit',            // convenience alias
            'documents/affidavit' => 'render.affidavit',          // back-compat
        ];

        if (!isset($map[$slug])) {
            // Fallback: try to use the slug directly as a named route if provided
            $routeName = $slug;
        } else {
            $routeName = $map[$slug];
        }

        // Force the URL generator to the VIEW_BASE host so signature matches
        $base   = rtrim(config('member.viewbase') ?? env('VIEW_BASE', config('app.url')), '/');
        $scheme = parse_url($base, PHP_URL_SCHEME) ?: null;
        if ($base) {
            URL::forceRootUrl($base);
            if ($scheme) {
                URL::forceScheme($scheme);
            }
        }

        return URL::temporarySignedRoute($routeName, now()->addSeconds($ttlSeconds), ['id' => $id]);
    }

    /* =========================================================================
     | APISHOT INTEGRATIONS (queue renders; webhook writes files)
     |========================================================================= */

    /** Queue *all* documents typically generated at activation (kept as-is) */
    public function Activate($id)
    {
        $user = User::find($id);
        if (!$user) return back()->with('message','User not found.');

      foreach (['idcard','joining-letter','off1-letter','off2-letter','honor-letter','payment-receipt'] as $slug) {
    $signedUrl = $this->signedRenderUrl($slug, (int)$id, 120);
    $r = ApiShot::capture((int)$id, $signedUrl, [
        'ext'             => 'pdf',
        'pageSize'        => 'A4',
        'printBackground' => true,
        'waitUntil'       => 'networkidle',
        'waitFor'         => 1200,
    ]);
    if (isset($r['error'])) {
        \Log::warning('APISHOT.DOCS_QUEUE_FAIL', ['user_id'=>$id, 'slug'=>$slug, 'error'=>$r['error']]);
        // continue instead of returning so the other docs can still queue
        continue;
    }
    usleep(250000); // 250ms between kicks to reduce 429s
}

        $user->status = '1';
        $user->save();
        return back()->with('message','Activation started. Documents will appear shortly.');
    }

    /** Deactivate overall (status flag only) */
    public function Deactive($id)
    {
        $team = User::find($id);
        if (!$team) return back()->with('message','User not found.');
        $team->status = '0';
        $team->save();
        session()->flash('message', 'DeActivated!');
        return redirect()->back();
    }

    /* ----- RECEIPT (Verified switch) --------------------------------------- */

    /** New clear name: queue receipt render (webhook saves to Payment.payment_rec) */
    public function receiptActivate($userId)
    {
        Payment::firstOrCreate(['user_id' => $userId], []);

        $signedUrl = $this->signedRenderUrl('payment-receipt', (int)$userId, 120);
        $resp = ApiShot::capture((int)$userId, $signedUrl, [
            'ext'             => 'pdf',
            'pageSize'        => 'A4',
            'printBackground' => true,
            'waitUntil'       => 'networkidle',
            'waitFor'         => 1200,
            // 'timeout'       => 60,  // seconds - enable if needed
        ]);

        if (isset($resp['error'])) {
            \Log::warning('APISHOT.RECEIPT_ACTIVATE_FAIL', ['user_id' => $userId, 'error' => $resp['error']]);
            return back()->with('message', 'Receipt generation failed.');
        }

        return back()->with('message', 'Receipt render queued. It will attach automatically when ready.');
    }

    /** Clear stored receipt path (turn off Verified) */
    public function receiptDeactivate($userId)
    {
        $payment = Payment::where('user_id', $userId)->first();
        if (!$payment) {
            return back()->with('message', 'Payment record not found.');
        }

        $payment->payment_rec = null;
        $payment->save();

        return back()->with('message', 'Receipt deactivated.');
    }

    // Back-compat aliases so old routes keep working
    public function RecActivate($id)  { return $this->receiptActivate($id); }
    public function deactiveRecp($id) { return $this->receiptDeactivate($id); }

    /* ----- AFFIDAVIT ------------------------------------------------------- */

    /** Queue affidavit render (webhook will attach to user table fields) */


    public function affidavitQueue($userId)
{
    if (!\Modules\User\Entities\User::find($userId)) {
        return back()->with('message','User not found.');
    }

    $url = $this->signedRenderUrl('affidavit', (int)$userId, 120);
    $suggest = "affidavit_{$userId}_" . time() . ".pdf";

    $r = \Modules\User\Services\ApiShot::capture((int)$userId, $url, [
        'ext'             => 'pdf',
        'pageSize'        => 'A4',
        'printBackground' => true,
        'waitUntil'       => 'networkidle',
        'waitFor'         => 1200,

        // ⬇️ Make sure your ApiShot::capture passes these through to the POST body
        'meta'         => ['user_id' => (int)$userId, 'kind' => 'affidavit', 'suggest' => $suggest],
        'datasinkMeta' => ['user_id' => (int)$userId, 'kind' => 'affidavit', 'suggest' => $suggest],
    ]);

    if (isset($r['error'])) {
        \Log::warning('APISHOT.AFFIDAVIT_QUEUE_FAIL', ['user_id'=>$userId, 'error'=>$r['error']]);
        return back()->with('message', 'Affidavit generation failed.');
    }

    return back()->with('message','Affidavit render queued. It will attach automatically when ready.');
}

    /** Remove affidavit fields (before/after) */
    public function affidavitDeactivate($userId)
    {
        $user = User::find($userId);
        if (!$user) return back()->with('message','User not found.');

        $user->before_affidavit         = null;
        $user->after_verifiy_affidavit  = null;
        $user->save();

        return back()->with('message', 'Affidavit deactivated.');
    }

    // Back-compat aliases
    public function AffiActivate($id) { return $this->affidavitQueue($id); }
    public function deactiveaffi($id) { return $this->affidavitDeactivate($id); }

    /** Reset “after verify” document to force re-upload */
    public function afterVerify($id)
    {
        $user = User::find($id);
        if (!$user) return back()->with('message','User not found.');

        $user->after_verifiy_affidavit = null;
        $user->save();

        session()->flash('message', 'Submit Again with Correction!');
        return redirect()->back();
    }

    /* =========================================================================
     | ACCOUNT STATUS (Enable/Disable user account)
     |========================================================================= */
    public function userActive($id)
    {
        $team = User::find($id);
        if (!$team) return back()->with('message','User not found.');

        $scode = $team->state ?? '';
        $dis   = str_replace(' ', '', strtoupper(substr($team->city ?? '', 0, 6)));
        preg_match('#\((.*?)\)#', $scode, $match);
        $stateCode = $match[1] ?? 'NA';

        $team->useractive = '1';
        $team->role       = '2';
        $team->regno      = 'HHF/'.$stateCode.'/'.$dis.'/'.$id;
        $team->save();

        session()->flash('message', 'Activated!');
        return redirect()->back();
    }

    public function userDeactive($id)
    {
        $team = User::find($id);
        if (!$team) return back()->with('message','User not found.');
        $team->useractive = '0';
        $team->save();
        session()->flash('message', 'DeActivated!');
        return redirect()->back();
    }

    /* =========================================================================
     | FLAGS (Top-Ten / Featured)
     |========================================================================= */
    public function topUser($id) // set topten = 0
    {
        $team = User::find($id);
        if (!$team) return back()->with('message','User not found.');
        $team->topten = '0';
        $team->save();
        session()->flash('message', 'Top-ten User DeActivated!');
        return redirect()->back();
    }

    public function topUserDeactive($id) // set topten = 1
    {
        $team = User::find($id);
        if (!$team) return back()->with('message','User not found.');
        $team->topten = '1';
        $team->save();
        session()->flash('message', 'Top-ten User Activated!');
        return redirect()->back();
    }

    public function featureUser($id) // set pow = 1
    {
        $team = User::find($id);
        if (!$team) return back()->with('message','User not found.');
        $team->pow = '1';
        $team->save();
        session()->flash('message', 'Featured User Activated!');
        return redirect()->back();
    }

    public function unFeatured($id) // set pow = 0
    {
        $team = User::find($id);
        if (!$team) return back()->with('message','User not found.');
        $team->pow = '0';
        $team->save();
        session()->flash('message', 'Featured User DeActivated!');
        return redirect()->back();
    }

    /* =========================================================================
     | NOTES
     |========================================================================= */
    public function Notestore(Request $request)
    {
        $request->validate(['notes' => 'required']);
        $dbinsert = new Note;
        $dbinsert->admin_id = Auth::user()->id ?? null;
        $dbinsert->notes    = $request->notes;
        $dbinsert->save();
        return back()
            ->withInput(['pill' => 'account-vertical-notifications'])
            ->with(['message' => "Notes Added Successfully!"]);
    }

    public function updateNote(Request $request, $id)
    {
        $request->validate(['notes' => 'required']);
        $dbinsert = Note::where('id', $id)->firstOrFail();
        $dbinsert->admin_id = $request->admin_id ?? (Auth::user()->id ?? null);
        $dbinsert->notes    = $request->notes;
        $dbinsert->save();

        return back()
            ->withInput(['pill' => 'account-vertical-notifications'])
            ->with(['message' => "Notes Updated Successfully!"]);
    }

    public function noteDestroy($id)
    {
        if ($note = Note::find($id)) {
            $note->delete();
        }
        return back()
            ->withInput(['pill' => 'account-vertical-notifications'])
            ->with(['message' => "Notes Delete Successfully!"]);
    }

    /* =========================================================================
     | DEPRECATED (kept only to avoid fatal errors if referenced)
     |========================================================================= */

    /**
     * @deprecated Use ApiShot::capture() + webhook instead.
     * Leaving method here to avoid fatal errors if legacy code calls it.
     */
    public function pdfGenerator($id, $link)
    {
        Log::warning('pdfGenerator() is deprecated. Use ApiShot::capture() + webhook.');
        return "fail";
    }

//========================================SearchBY AND EXPORT===================================//

public function search(Request $request)
{
    // accept either ?q= or legacy ?inputsearch=
    $term = trim($request->input('q', $request->input('inputsearch', '')));

    $user = \App\Models\User::query()
        ->with(['referrer'])
        ->whereIn('role', [2, 0])                         // ← role filter
        ->when($term !== '', function ($q) use ($term) {   // group the OR search
            $q->where(function ($qq) use ($term) {
                $qq->where('name',   'LIKE', "%{$term}%")
                   ->orWhere('email','LIKE', "%{$term}%")
                   ->orWhere('mobile','LIKE', "%{$term}%")
                   ->orWhere('referrer_id','LIKE', "%{$term}%")
                   ->orWhere('useractive','LIKE', "%{$term}%");
            });
        })
        ->latest()
        ->simplePaginate(20)
        ->appends(['q' => $term]); // keep query in pagination links

    // IMPORTANT: correct view key and variable name
    return view('user::users.index', [
        'user'      => $user,      // your blade loops over $user
        'onlyTable' => false,      // full page render
    ]);
}





public function export(Request $request)
{
    $filename = 'Members_List_'.now()->format('Y-m-d_H-i-s').'.csv';

    $headers = [
        'Content-Type'        => 'text/csv; charset=UTF-8',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
        'Pragma'              => 'no-cache',
        'Cache-Control'       => 'no-store, no-cache, must-revalidate, max-age=0',
        'Expires'             => '0',
    ];

    $stream = function () use ($request) {
        // clean buffers (prevents corrupt CSV)
        if (function_exists('ob_get_level')) {
            while (ob_get_level() > 0) { @ob_end_clean(); }
        }

        $out = fopen('php://output', 'w');

        // UTF-8 BOM so Excel opens Unicode properly
        fwrite($out, chr(0xEF).chr(0xBB).chr(0xBF));

        // Headings
        fputcsv($out, [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Referrer (ID — Name)',
            'User Status',
            'Payment Status',
            'Valid Upto',
        ]);

        // Base query: ONLY role = 2, eager-load referrer + latestPayment
        $q = \App\Models\User::query()
            ->select(['id','name','email','mobile','referrer_id','useractive','valid_upto','role'])
            ->with([
                'referrer:id,name',
                'latestPayment:id,user_id,payment_rec',
            ])
            ->where('role', 2);

        // (Optional) keep current UI filters
        if ($request->filled('query')) {
            $s = $request->input('query');
            $q->where(function($x) use ($s){
                $x->where('name','LIKE',"%{$s}%")
                  ->orWhere('mobile','LIKE',"%{$s}%");
            });
        }
        if ($request->filled('verified')) {
            if ($request->verified === '1') {
                $q->whereHas('latestPayment', fn($qq) => $qq->whereNotNull('payment_rec'));
            } elseif ($request->verified === '0') {
                $q->whereDoesntHave('latestPayment', fn($qq) => $qq->whereNotNull('payment_rec'));
            }
        }

        foreach ($q->orderBy('id')->cursor() as $u) {
            // Referrer display: "id — name" or "—"
            $refDisplay = $u->referrer ? ($u->referrer->id.' — '.$u->referrer->name) : '—';

            // Status text
            $userStatus    = ($u->useractive == 1) ? 'Activate' : 'Deactive';
            $paymentStatus = filled(optional($u->latestPayment)->payment_rec) ? 'Activate' : 'Deactive';

            // Excel quirks: force text for mobile and date to avoid scientific notation/######
            $mobileText = "\t".$u->mobile; // leading tab => Excel treats as text

            // valid_upto can be a string or Carbon; format and force text
            if ($u->valid_upto instanceof \Carbon\Carbon) {
                $vuRaw = $u->valid_upto->format('d-m-Y');
            } else {
                $vuRaw = (string) $u->valid_upto; // e.g., "31-10-2026"
            }
            $validUptoText = $vuRaw !== '' ? "\t".$vuRaw : '';

            fputcsv($out, [
                $u->id,
                $u->name,
                $u->email,
                $mobileText,
                $refDisplay,
                $userStatus,
                $paymentStatus,
                $validUptoText,
            ]);
        }

        fclose($out);
    };

    return response()->streamDownload($stream, $filename, $headers);
}


}
