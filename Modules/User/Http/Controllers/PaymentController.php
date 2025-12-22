<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RazorpayRecurringService;
use Modules\User\Entities\MemberSubscription;
use Razorpay\Api\Api;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\User\Entities\User;
use Modules\User\Entities\Payment;
use Illuminate\Support\Facades\Storage;
use Modules\Setting\Entities\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMail;
use App\Mail\MembershipPaymentReceipt;
use Barryvdh\DomPDF\Facade\Pdf;

use Image;

class PaymentController extends Controller
{
     public function __construct()
    {
        // load first (or current) setting record and share with all views
        if (! app()->runningInConsole()) {
            try {
                $this->setting = Setting::first();
            } catch (\Throwable $e) {
                $this->setting = null;
            }
            view()->share('setting', $this->setting);
        }
    }
    
    // POST /make-payment
 public function store(Request $request)
{
    $userId = auth()->id();

    // 1) Validate the incoming file — only images for “screenshot”
    $request->validate([
        'screenshot' => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:5120',
    ], [
        'screenshot.required' => 'Please upload your payment screenshot.',
        'screenshot.mimes'    => 'Allowed types: jpg, jpeg, png, webp, gif.',
    ]);

    // 2) Ensure row exists
    $pay = \App\Models\Payment::firstOrCreate(['user_id' => $userId], []);

    // 3) Save the file to storage/public/backend/screenshots
    $file     = $request->file('screenshot');
    $folder   = 'backend/screenshots';
    $basename = 'payshot_' . $userId . '_' . time();
    $ext      = strtolower($file->getClientOriginalExtension());
    $filename = $basename . '.' . $ext;

    // make sure folder exists
    Storage::disk('public')->makeDirectory($folder);

    // Use Intervention only for real images; otherwise store raw
    try {
        // read as image (will throw if not an image even if mimetype says so)
        Image::make($file->getPathname())->orientate(); // you can chain ->resize() etc.
        // store binary via Intervention to the same filename
        $absPath = storage_path('app/public/' . $folder . '/' . $filename);
        Image::make($file->getPathname())->save($absPath, 90);
    } catch (\Throwable $e) {
        // fallback: just move it if Intervention can’t read (shouldn’t happen with the validation)
        Storage::disk('public')->putFileAs($folder, $file, $filename);
    }

    // 4) Update DB with the relative path (what you use in asset('storage/...'))
    $pay->screenshot = $folder . '/' . $filename;
    $pay->save();

    // (…your affidavit queue logic can run after this, unchanged…)
    return back()->with('message', 'Screenshot uploaded. Thank you!');
}

/** Show Razorpay checkout for last registered member */
    public function showPaymentPage(Request $request)
    {
        // get user from session (set in storeMemberRegistration)
        $memberId = session('payment_member_id');

        // optional fallback: logged in member
        if (!$memberId && auth()->check()) {
            $memberId = auth()->id();
        }

        if (!$memberId) {
            return redirect()
                ->route('member.register.show')
                ->with('error', 'No member found for payment. Please register again.');
        }

        $user = User::findOrFail($memberId);

        // membership amount (₹)
        $amountInRupees = 299;
        $amountInPaise  = $amountInRupees * 100;

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $orderData = [
            'receipt'         => 'MEMBER-' . $user->id . '-' . time(),
            'amount'          => $amountInPaise,
            'currency'        => 'INR',
            'payment_capture' => 1,
        ];

        $order = $api->order->create($orderData);

        // store order id in session
        session(['razorpay_order_id' => $order['id']]);

        return view('frontend.pages.member-payment', [
            'user'   => $user,
            'order'  => $order,
            'amount' => $amountInRupees,
            'key'    => config('services.razorpay.key'),
        ]);
    }

    /** Razorpay callback after checkout */
    public function handleCallback(Request $request)
    {
        $memberId          = session('payment_member_id');
        $razorpayOrderId   = session('razorpay_order_id') ?: $request->input('razorpay_order_id');
        $razorpayPaymentId = $request->input('razorpay_payment_id');
        $razorpaySignature = $request->input('razorpay_signature');

        if (!$memberId || !$razorpayOrderId || !$razorpayPaymentId || !$razorpaySignature) {
            return redirect()
                ->route('payment')
                ->with('error', 'Invalid payment response. Please try again.');
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // 1) verify signature
        $generatedSignature = hash_hmac(
            'sha256',
            $razorpayOrderId . '|' . $razorpayPaymentId,
            config('services.razorpay.secret')
        );

        if (!hash_equals($generatedSignature, $razorpaySignature)) {
            return redirect()
                ->route('payment')
                ->with('error', 'Payment verification failed.');
        }

        try {
            // 2) fetch payment details from Razorpay
            $paymentDetails = $api->payment->fetch($razorpayPaymentId);

            // store payment in DB (NOT activating user here)
            $saved = Payment::create([
                'user_id'             => $memberId,
                'screenshot'          => null,
                'razorpay_order_id'   => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'status'              => $paymentDetails['status'] ?? 'captured',
                'amount'              => $paymentDetails['amount'] ?? null,
                'currency'            => $paymentDetails['currency'] ?? 'INR',
                'is_verified'         => false,
                'verified_at'         => null,
               
            ]);

            // Generate receipt PDF and save under public storage
            $user = User::find($memberId);
            $receiptRel = null;
            try {
                if ($user) {
                    $dir   = 'receipts/'.$user->id;
                    \Storage::disk('public')->makeDirectory($dir);
                    $filename = 'receipt-'.$saved->id.'.pdf';
                    $relative = $dir.'/'.$filename;

                    $pdf = Pdf::loadView('frontend.templates.receipt.style-2', [
                        'user'    => $user,
                        'payment' => $saved,
                        'setting' => $this->setting,
                    ]);
                    $pdf->save(storage_path('app/public/'.$relative));

                    $receiptRel = $relative;

                    // persist on payment row for later download
                    $saved->payment_rec = $receiptRel;
                    $saved->save();
                }
            } catch (\Throwable $pdfEx) {
                Log::warning('Payment receipt PDF render failed', ['error' => $pdfEx->getMessage()]);
            }

            // clear session
            session()->forget(['payment_member_id', 'razorpay_order_id']);

            // send confirmation email to member (non-blocking) with PDF attachment when available
            try {
                if ($user && filled($user->email)) {
                    $amt = isset($paymentDetails['amount']) ? number_format(((float)$paymentDetails['amount'])/100, 2) : '—';
                    $msg = '<p>Dear '.e($user->name).',</p>'
                         . '<p>We have received your membership payment. Details below:</p>'
                         . '<table><tr><th align="left">Payment ID</th><td>'.e($razorpayPaymentId).'</td></tr>'
                         . '<tr><th align="left">Order ID</th><td>'.e($razorpayOrderId).'</td></tr>'
                         . '<tr><th align="left">Status</th><td>'.e($paymentDetails['status'] ?? 'captured').'</td></tr>'
                         . '<tr><th align="left">Amount</th><td>INR '.$amt.'</td></tr>'
                         . '<tr><th align="left">Date</th><td>'.now()->format('d-m-Y H:i').'</td></tr></table>'
                         . '<p>Our team will verify and activate your ID soon.</p>';

                    if ($receiptRel) {
                        Mail::to($user->email)->send(new MembershipPaymentReceipt($user, $saved, $receiptRel));
                    } else {
                        $subject = 'Payment Confirmation - '.($this->setting->title ?? config('app.name'));
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => $subject,
                            'message' => $msg,
                        ]));
                    }
                }
            } catch (\Throwable $mailEx) {
                Log::warning('Payment confirmation mail failed', ['error' => $mailEx->getMessage()]);
            }

            return redirect()
                ->route('member.register.show')
                ->with([
                    'success' => 'Payment successful. We will contact you shortly.',
                    'success_type' => 'payment',
                ]);

        } catch (\Throwable $e) {
            Log::error('Razorpay payment fetch failed', [
                'msg' => $e->getMessage(),
            ]);

            // email prompt to complete payment
            try {
                if ($memberId) {
                    $user = User::find($memberId);
                    if ($user && filled($user->email)) {
                        $link = route('payment');
                        $msg = '<p>Dear '.e($user->name).',</p><p>Your payment was captured but we could not save it in our system. Please contact support or try again from the link below.</p>'
                             . '<p><a href="'.e($link).'" style="display:inline-block;padding:8px 14px;background:#ff4d4d;color:#fff;border-radius:6px;text-decoration:none;">Complete Payment</a></p>';
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => 'Action needed: Complete your membership payment',
                            'message' => $msg,
                        ]));
                    }
                }
            } catch (\Throwable $mailEx) {
                Log::warning('Payment failure mail failed', ['error' => $mailEx->getMessage()]);
            }

            return redirect()
                ->route('payment')
                ->with('error', 'Payment captured but not saved in system. Contact support with payment id: '.$razorpayPaymentId);
        }
    }

 /**
     * ADMIN: List all payments for one member
     * Route: GET admin/members/{user}/payments
     */
    public function userPayments(User $user)
    {
        $payments = $user->payments()->latest()->get();

        return view('user::users.payments', compact('user', 'payments'));
    }
    
    public function verify(Payment $payment, Request $request)
    {
        $payment->is_verified = true;
        $payment->verified_at = now();
        $payment->save();

        // after admin verifies → activate user
        $payment->user()->update([
            'status'     => 1,
            'useractive' => 1,
        ]);

        // Queue affidavit render if not present yet
        try {
            $u = \Modules\User\Entities\User::find($payment->user_id);
            if ($u && empty($u->before_affidavit)) {
                app(\Modules\User\Http\Controllers\UserController::class)->affidavitQueue($u->id);
            }
        } catch (\Throwable $e) {
            \Log::warning('Affidavit queue after verify failed', ['error'=>$e->getMessage(), 'user_id'=>$payment->user_id]);
        }

        return back()->with('success', 'Payment verified and member activated.');
    }
    
      public function storeManual(User $user, Request $request)
    {
        $data = $request->validate([
            'amount'     => 'required|numeric|min:1',             // membership fees / amount
            'method'     => 'nullable|string|max:50',             // e.g. Cash / NEFT / UPI
            'note'       => 'nullable|string|max:255',            // optional remarks
            'screenshot' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->amount  = $data['amount'];
        $payment->currency = 'INR';
        $payment->status   = 'manual';      // mark that this is a manual entry
        $payment->method   = $data['method'] ?? 'Manual';
        $payment->note     = $data['note'] ?? null;

        // by default, admin can still verify later
        $payment->is_verified = false;
        $payment->verified_at = null;

        // optional screenshot / receipt upload
        if ($request->hasFile('screenshot')) {
            // e.g. store in storage/app/public/payments
            $path = $request->file('screenshot')->store('payments', 'public');
            $payment->screenshot = $path;   // you already use 'screenshot' & 'payment_rec'
        }

        $payment->save();

        return back()->with('message', 'Manual payment added for this member.');
    }
//--------------------------------------------Autopay Payment--------------------------------------------------//

public function showMembershipAutopay(Request $request, RazorpayRecurringService $recurring)
{
    // same logic as your one-time method
    $memberId = session('payment_member_id');

    if (!$memberId && auth()->check()) {
        $memberId = auth()->id();
    }

    if (!$memberId) {
        return redirect()
            ->route('member.register.show')
            ->with('error', 'No member found for autopay. Please register first.');
    }

    $user = User::findOrFail($memberId);

    $planId = config('services.razorpay.membership_plan_id');

    $subscription = $recurring->createUpiSubscription(
        $planId,
        totalCount: 12, // e.g. 12 months
        customer: [
            'name'   => $user->name,
            'email'  => $user->email,
            'mobile' => $user->mobile,
        ],
        notes: [
            'type'    => 'membership',
            'user_id' => $user->id,
        ]
    );

    MemberSubscription::create([
        'user_id'                 => $user->id,
        'razorpay_subscription_id'=> $subscription['id'],
        'plan_id'                 => $planId,
        'status'                  => $subscription['status'] ?? 'created',
        'amount_paise'            => $subscription['item']['amount'] ?? null,
        'interval'                => $subscription['item']['interval'] ?? null,
        'meta'                    => ['from' => 'membership-autopay'],
    ]);

    return view('frontend.pages.member-autopay', [
        'key'            => config('services.razorpay.key'),
        'user'           => $user,
        'subscriptionId' => $subscription['id'],
        'subscription'   => $subscription,
        'callbackRoute'  => route('member.autopay.callback'),
    ]);
}

public function membershipAutopayCallback(Request $request, RazorpayRecurringService $recurring)
{
    $request->validate([
        'razorpay_payment_id'      => 'required|string',
        'razorpay_subscription_id' => 'required|string',
        'razorpay_signature'       => 'required|string',
    ]);

    $subId     = $request->input('razorpay_subscription_id');
    $paymentId = $request->input('razorpay_payment_id');
    $signature = $request->input('razorpay_signature');

    if (! $recurring->verifySubscriptionSignature($subId, $paymentId, $signature)) {
        return redirect()
            ->route('member.register.show')
            ->with('error', 'Autopay signature verification failed.');
    }

    $sub = MemberSubscription::where('razorpay_subscription_id', $subId)->first();
    if ($sub) {
        $sub->status = 'active';
        $sub->save();
    }

    // Optional: store first payment record as "pending verification"
    $saved = Payment::create([
        'user_id'             => $sub?->user_id,
        'screenshot'          => null,
        'razorpay_order_id'   => null,
        'razorpay_payment_id' => $paymentId,
        'status'              => 'autopay_first',
        'amount'              => $sub?->amount_paise,
        'currency'            => 'INR',
        'is_verified'         => false,
        'verified_at'         => null,
    ]);

    // Clear session if you used it
    session()->forget('payment_member_id');

    // Generate receipt PDF for autopay and save path
    $receiptRel = null;
    try {
        $user = $sub ? User::find($sub->user_id) : null;
        if ($user) {
            $dir   = 'receipts/'.$user->id;
            \Storage::disk('public')->makeDirectory($dir);
            $filename = 'receipt-'.$saved->id.'.pdf';
            $relative = $dir.'/'.$filename;

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('frontend.templates.receipt.style-2', [
                'user'    => $user,
                'payment' => $saved,
                'setting' => $this->setting,
            ]);
            $pdf->save(storage_path('app/public/'.$relative));

            $receiptRel = $relative;
            $saved->payment_rec = $receiptRel;
            $saved->save();
        }
    } catch (\Throwable $pdfEx) {
        \Log::warning('Autopay receipt PDF render failed', ['error' => $pdfEx->getMessage()]);
    }

    // send confirmation email for autopay setup/payment
    try {
        $user = $sub ? ($user ?? User::find($sub->user_id)) : null;
        if ($user && filled($user->email)) {
            $amt = $sub?->amount_paise ? number_format(((float)$sub->amount_paise)/100, 2) : '—';
            if ($receiptRel) {
                // Attach the generated receipt
                Mail::to($user->email)->send(new \App\Mail\MembershipPaymentReceipt($user, $saved, $receiptRel));
            } else {
                $msg = '<p>Dear '.e($user->name).',</p>'
                     . '<p>Your UPI Autopay for membership has been set up successfully.</p>'
                     . '<table><tr><th align="left">Payment ID</th><td>'.e($paymentId).'</td></tr>'
                     . '<tr><th align="left">Subscription ID</th><td>'.e($subId).'</td></tr>'
                     . '<tr><th align="left">Amount (first debit)</th><td>INR '.$amt.'</td></tr>'
                     . '<tr><th align="left">Date</th><td>'.now()->format('d-m-Y H:i').'</td></tr></table>'
                     . '<p>We will verify and activate your membership soon.</p>';
                $subject = 'Membership Autopay Confirmation - '.($this->setting->title ?? config('app.name'));
                Mail::to($user->email)->send(new BasicMail([
                    'subject' => $subject,
                    'message' => $msg,
                ]));
            }
        }
    } catch (\Throwable $mailEx) {
        Log::warning('Autopay confirmation mail failed', ['error' => $mailEx->getMessage()]);
    }

    return redirect()
        ->route('member.register.show')
        ->with([
            'success' => 'UPI Autopay for membership setup successfully. Admin will verify payments.',
            'success_type' => 'payment',
        ]);
}



}
