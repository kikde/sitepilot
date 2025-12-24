<?php

namespace App\Http\Controllers;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\Note;
use Modules\User\Entities\User as MemberUser;
use Modules\Page\Entities\Manageteam;
use Modules\User\Entities\SupportTicket;
use Modules\Page\Entities\Donation;
use Modules\User\Entities\Payment as MemberPayment;
use Illuminate\Http\Request;
use Auth;
use App\Models\User; // Auth m;odel used elsewhere in this controller

use Modules\Page\Entities\Manageteam;
use App\Models\Payment;
use Session;
use Image;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
  
        $setting = Setting::first();
        View::share(['setting'=>$setting]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        
        // return view('home');
        if(Auth::user()->useractive ==0){
            $flash =  Session::flush();

            return  redirect()->back()->with('notfound',"Please Contact admin for Your Account Activation");
        }
        else if(Auth::user()->role == 3){
            return  redirect()->back()->with('message',"Your are Successfully Register Come to Enjoy Your Day..");
        }
       elseif(Auth::user()->role ==2 or Auth::user()->role ==0){
            $mobile = Auth::user()->mobile;
            $id= Auth::user()->id;

             // build $me or other data as you already do...
        $me = $user->loadCount('referrals')->load('referrer','referrals');

        // ✅ make sure the user has a referral_code; generate on demand if missing
        if (empty($user->referral_code)) {
            do {
                $code = Str::upper(Str::random(8));
            } while (\Modules\User\Entities\User::where('referral_code', $code)->exists());
            $user->referral_code = $code;
            $user->save();
        }

        // ✅ pass share URL
        $shareUrl = route('member.registration', ['ref' => $user->referral_code]);
        // or if your route name is different:
        // $shareUrl = route('member.register.show', ['ref' => $user->referral_code]);
             
            $rec = Payment::where('user_id', $id)->first();
            $perfor = User::where('pow', 1)->first();
            $davit = User::where('id', $id)->first();
            $top = User::where('topten', 1)->limit(10)->get();
            $notice = Note::latest()->limit(4)->get();
            return view('home', compact('perfor','top', 'mobile', 'rec', 'davit', 'notice','me','shareUrl'));
        }
       
        else if(Auth::user()->role == 1){
            // Total Members from module users: role = 2 and active status
            $totalMembers = User::where('role', '2')
                ->where('useractive', '1')
                ->where('status', '1')
                ->count();

            // Management Team count
            $managementTeamCount = Manageteam::count();
            $monthlyDonationPaise = \Modules\Page\Entities\Donation::where('status','paid')
                ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->sum('amount_paise');
            $monthlyDonationInr = $monthlyDonationPaise ? round($monthlyDonationPaise/100, 2) : 0;

            // Revenue report (current year): donations (paid) + member payments
            $year = now()->year;
            $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            $revenueEarnings = array_fill(0, 12, 0.0);
            $revenueExpenses = array_fill(0, 12, 0.0); // no expenses available; keep 0

            // Donations
            $donations = Donation::where('status','paid')
                ->whereYear('created_at', $year)
                ->get(['amount_paise','created_at']);
            foreach ($donations as $d) {
                $idx = (int) $d->created_at->format('n') - 1; // 0..11
                $revenueEarnings[$idx] += ($d->amount_paise ?? 0) / 100.0;
            }

            // Member payments (mix of paise and INR); include verified or captured
            $payments = MemberPayment::whereYear('created_at', $year)
                ->get(['amount','currency','status','is_verified','created_at']);
            foreach ($payments as $p) {
                if (! $p->created_at) continue;
                $idx = (int) $p->created_at->format('n') - 1;
                $amt = (float) ($p->amount ?? 0);
                // Heuristic: Razorpay amounts are in paise, manual likely INR
                $amtInr = $amt >= 1000 ? $amt/100.0 : $amt;
                $revenueEarnings[$idx] += $amtInr;
            }

            // Support tracker metrics (last 7 days)
            $ticketsTotal7d = SupportTicket::where('created_at', '>=', now()->subDays(7))->count();
            $ticketsOpen7d  = SupportTicket::where('created_at', '>=', now()->subDays(7))
                ->where('status', 'open')->count();
            $ticketsClosed7d = SupportTicket::where('created_at', '>=', now()->subDays(7))
                ->whereIn('status', ['close','closed','resolved'])->count();
            $ticketsCompletedPct = $ticketsTotal7d > 0 ? round(($ticketsClosed7d / $ticketsTotal7d) * 100) : 0;
            $supportResponseTime = '1d';

            return view('backend.home.home', compact(
                'totalMembers',
                'managementTeamCount',
                'monthlyDonationInr',
                'ticketsTotal7d',
                'ticketsOpen7d',
                'ticketsClosed7d',
                'ticketsCompletedPct',
                'supportResponseTime',
                'months',
                'revenueEarnings',
                'revenueExpenses',
                'year'
            ));

        }
    }

  public function makePay(Request $request)
{
    $id = Auth::user()->id;

    // Ensure a payment row exists (same behavior as elsewhere)
    $pay = Payment::firstOrCreate(['user_id' => $id], []);

    if ($request->hasFile('screenshot')) {
        $postimage = $request->file('screenshot');
        $filename  = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
        Image::make($postimage)->save(public_path('/backend/screenshots/'. $filename));
        $pay->screenshot = $filename;
        $pay->save();
    }

    // Build affidavit VIEW url from config, not SNAP
    $viewBase      = rtrim(config('member.viewbase') ?? env('VIEW_BASE', 'https://mdmks.kikde.com'), '/');
    $affidavitUrl  = $viewBase . '/affi-letter/' . $id;

    // Use the new APIshot-powered generator (async + webhook)
    [$tokenOrPath, $status] = app('Modules\User\Http\Controllers\UserController')
        ->pdfGenerator($id, $affidavitUrl);

    // Accept both the new "Queued" (webhook will attach later) or legacy "Success"
    if ($status === 'Queued') {
        // Webhook will store file and update users.before_affidavit when ready
        return back()->with('message', 'योगदान के लिए धन्यवाद ! आपका शपथ पत्र तैयार किया जा रहा है।');
    } elseif ($status === 'Success') {
        // In case the generator returned an immediate file path (sync mode)
        $user = User::find($id);
        if ($user) {
            $user->before_affidavit = $tokenOrPath; // this is the saved path
            $user->save();
        }
        return back()->with('message', 'योगदान के लिए धन्यवाद ! शपथ पत्र तैयार हो गया है।');
    }

    // Any failure falls back here
    return back()->with('message', 'Try Again Some Technical Error!');
}
}
