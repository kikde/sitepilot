<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Setting\Entities\Setting;
use Modules\Page\Entities\Donor;
use Modules\Page\Entities\Donation;
use Illuminate\Validation\Rule;
use Modules\Page\Entities\Banner;
use Modules\Page\Entities\Bank;
use App\Mail\DonationReceiptMail;
use App\Services\DonationReceiptService;
use Illuminate\Support\Facades\Mail;
use App\Services\RazorpayRecurringService;
use Modules\Page\Entities\DonationSubscription;
use Modules\User\Entities\MemberSubscription;
use Modules\User\Entities\Payment;
use Modules\User\Entities\User;
use Razorpay\Api\Api;
use Image;
use Auth;
use View;
use Config;

class DonarsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
         $this->middleware('auth')->except(['startDonation','callback','webhook']);
         $setting = Setting::first();
         View::share(['setting'=>$setting]);
         
    }
    public function index()
    {
        $donar = Donor::latest()->simplePaginate('10');
        return view('page::donors.index', compact('donar'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $getlist = Config::get('constants.state');
        return view('page::donors.add', compact('getlist'));
    }

    public function listCity(Request $request)
    {

       $getlist = Config::get('constants.state');
       $result= $getlist[$request->sid];
       $html='<option value="">Select City</option>';
       foreach($result as $list){
   
           $html.='<option value="'.$list.'">'.$list.'</option>';
       }
       return $html;

      
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $donar = new Donor;

        if ($request->hasFile('profile')) {
            $postimage = $request->file('profile');
            $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'. $filename));
            
            $donar->profile = $filename;
         } 
        $donar->name = $request->name;
        $donar->email = $request->email;
        $donar->mobile = $request->mobile;
        $donar->pan_no = $request->pan_no;
        $donar->state = $request->state;
        $donar->city = $request->city;
        $donar->address = $request->address;
        $donar->pincode = $request->pincode;
  
        $donar->save();
        return redirect()->back()->with('message',"Donors Added Sucessfully!!");

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $donarlist = Donor::find($id); 
        $getlist = Config::get('constants.state');
        return view('page::donors.edit', compact('donarlist', 'getlist'));
        
    }

    public function getbanner(){

        $bannerimg = Banner::where('page_name', 'Donars')->first();
        return view('page::donors.addbreadcrum', compact('bannerimg'));
    }

    public function bannerStore(Request $request){
        // return $request;
        if ($request->exists('id')){
            $banner = Banner::where('id',$request->id)->first();

            if ($request->hasFile('breadcrumb')) {
                $postimage = $request->file('breadcrumb');
                $bannerfile = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
                Image::make($postimage)->save(public_path('/backend/uploads/'. $bannerfile));
    
                $banner->breadcrumb = $bannerfile;
            }
            $banner->page_name = $request->page_name;
            $banner->save();
            return redirect()->back()->with('message',"Updated Sucessfully!!"); 
        }
        else{
            $banner = new Banner;

            if ($request->hasFile('breadcrumb')) {
                $postimage = $request->file('breadcrumb');
                $bannerfile = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
                Image::make($postimage)->save(public_path('/backend/uploads/'. $bannerfile));
    
                $banner->breadcrumb = $bannerfile;
            }
            $banner->page_name = $request->page_name;
            $banner->save();
            return redirect()->back()->with('message',"Added Sucessfully!!"); 
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        // return view('page::donars.addbreadcrum');
    //     $getlist = Config::get('constants.state');
    //     $donarlist = Donar::find($id); 
    //    return view('page::donars.edit', compact('donarlist', 'getlist'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
        $donar = Donor::where('id',$request->id)->first();

        if ($request->hasFile('profile')) {
            $postimage = $request->file('profile');
            $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'. $filename));
            
            $donar->profile = $filename;
         } 
       
        $donar->name = $request->name;
        $donar->email = $request->email;
        $donar->mobile = $request->mobile;
        $donar->pan_no = $request->pan_no;
        $donar->state = $request->state;
        $donar->city = $request->city;
        $donar->address = $request->address;
        $donar->pincode = $request->pincode;
        $donar->save();
        return redirect()->back()->with('message',"Donors updated Sucessfully!!");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $donar = Donor::find($id);
        $donar->delete();
        return redirect()->back()->with('message',"deleted Sucessfully"); 
    }


//==============================================Start Donation All Places ===========================================//
     public function startDonation(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:120'],
            'email'   => ['nullable','email','max:190'],
            // Indian mobile numbers: 10 digits starting with 6-9
            'mobile'  => ['required','regex:/^[6-9]\d{9}$/'],
            'pan_no'  => ['nullable','string','max:20'],
            'state'   => ['nullable','string','max:80'],
            'city'    => ['nullable','string','max:80'],
            'address' => ['nullable','string','max:255'],
            'pincode' => ['nullable','string','max:12'],
            'amount'  => ['required','numeric','min:1'], // in INR rupees
            'campaign'=> ['nullable','string','max:120'],
        ]);

        // 1) Find or create donor (mobile is a good unique key; fallback email)
        $donor = Donor::firstOrNew(['mobile' => $data['mobile']]);
        $donor->fill([
            'name'    => $data['name'],
            'email'   => $data['email'] ?? $donor->email,
            'pan_no'  => $data['pan_no'] ?? $donor->pan_no,
            'state'   => $data['state'] ?? $donor->state,
            'city'    => $data['city'] ?? $donor->city,
            'address' => $data['address'] ?? $donor->address,
            'pincode' => $data['pincode'] ?? $donor->pincode,
        ])->save();

        // 2) Create Razorpay order
        $api   = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $amtPaise  = (int) round(((float) $data['amount']) * 100); // INR -> paise
        $receiptId = 'don_'.$donor->id.'_'.now()->format('Ymd_His');

        $rOrder = $api->order->create([ 
            'amount'          => $amtPaise,
            'currency'        => 'INR',
            'receipt'         => $receiptId,
            'payment_capture' => 1, // auto-capture
            // 'notes' => [...],
        ]);

        // 3) Create Donation row (status = created)
        $donation = Donation::create([
            'donor_id'            => $donor->id,
            'campaign'            => $data['campaign'] ?? null,
            'amount_paise'        => $amtPaise,
            'currency'            => 'INR',
            'status'              => 'created',
            'razorpay_order_id'   => $rOrder['id'],
            'meta'                => [
                'receipt' => $receiptId,
                'form_source' => url()->previous(),
            ],
        ]);

        // 4) Render a minimal blade that opens Razorpay Checkout (or return JSON if you prefer AJAX)
        //    Provide everything the checkout needs.
        return response()->view('page::donations.checkout', [
            'key'            => config('services.razorpay.key'),
            'orderId'        => $rOrder['id'],
            'amountPaise'    => $amtPaise,
            'donor'          => $donor,
            'donation'       => $donation,
            'callbackRoute'  => route('donate.callback'), // POST target from Checkout
        ]);
    }

    /**
     * Success callback from Razorpay Checkout (non-webhook).
     * Verifies signature and marks donation as paid/failed accordingly.
     */
    public function callback(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
        ]);

        $orderId    = $request->input('razorpay_order_id');
        $paymentId  = $request->input('razorpay_payment_id');
        $signature  = $request->input('razorpay_signature');
        $secret     = config('services.razorpay.secret');

        $generated = hash_hmac('sha256', $orderId.'|'.$paymentId, $secret);

        $donation = Donation::where('razorpay_order_id', $orderId)->first();

        if (!$donation) {
            return back()->with('error', 'Donation record not found.');
        }

       if (hash_equals($generated, $signature)) {
            $donation->update([
                'status' => 'paid',
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature'  => $signature,
            ]);

            // >>> generate + email receipt
            $this->finalizePaid($donation);

            return redirect()->to('/thank-you')->with('message', 'Thank you! Your donation was successful.');
        
        } else {
            $donation->update([
                'status'              => 'failed',
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature'  => $signature,
            ]);
            return redirect()->to('/')->with('error', 'Signature verification failed.');
        }
    }

    /**
     * Razorpay Webhook (recommended). Set this URL & secret in Razorpay Dashboard.
     * Handles asynchronous events (payment.captured, payment.failed etc).
     */
     public function webhook(Request $request)
{
    // 1) Verify Razorpay webhook signature (if secret is set in .env)
    $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');
    $payload       = $request->getContent();
    $receivedSig   = $request->header('X-Razorpay-Signature');

    if ($webhookSecret) {
        $expected = hash_hmac('sha256', $payload, $webhookSecret);
        if (! hash_equals($expected, (string) $receivedSig)) {
            Log::warning('Razorpay webhook: signature mismatch');
            return response('Invalid signature', 400);
        }
    }

    // 2) Pull common pieces from payload
    $event             = $request->input('event');
    $paymentEntity     = $request->input('payload.payment.entity');       // has payment info
    $orderEntity       = $request->input('payload.order.entity');         // sometimes used
    $subscriptionEntity= $request->input('payload.subscription.entity');  // for subscription events

    // ------------------------------------------------------------------
    // A) ONE-TIME DONATION: payment.captured
    // ------------------------------------------------------------------
    if ($event === 'payment.captured' && $paymentEntity && isset($paymentEntity['order_id'])) {

        $orderId   = $paymentEntity['order_id'] ?? null;
        $paymentId = $paymentEntity['id'] ?? null;

        if ($orderId) {
            $donation = Donation::where('razorpay_order_id', $orderId)->first();

            if ($donation) {
                $donation->update([
                    'status'              => 'paid',
                    'razorpay_payment_id' => $paymentId,
                    'meta'                => array_merge($donation->meta ?? [], [
                        'webhook' => $request->all(),
                    ]),
                ]);

                try {
                    // generate + email receipt
                    $this->finalizePaid($donation);
                } catch (\Throwable $e) {
                    Log::error('finalizePaid failed for one-time donation', [
                        'donation_id' => $donation->id,
                        'msg'         => $e->getMessage(),
                    ]);
                }
            }
        }
    }

    // ------------------------------------------------------------------
    // B) ONE-TIME DONATION: payment.failed
    // ------------------------------------------------------------------
    if ($event === 'payment.failed' && $paymentEntity && isset($paymentEntity['order_id'])) {

        $orderId   = $paymentEntity['order_id'] ?? null;
        $paymentId = $paymentEntity['id'] ?? null;

        if ($orderId) {
            $donation = Donation::where('razorpay_order_id', $orderId)->first();

            if ($donation) {
                $donation->update([
                    'status'              => 'failed',
                    'razorpay_payment_id' => $paymentId,
                    'meta'                => array_merge($donation->meta ?? [], [
                        'webhook' => $request->all(),
                    ]),
                ]);
            }
        }
    }

    // ------------------------------------------------------------------
    // C) RECURRING AUTOPAY: subscription.charged
    //    (covers BOTH donation-subscriptions + membership-subscriptions)
    // ------------------------------------------------------------------
    if ($event === 'subscription.charged' && $paymentEntity) {

        $subscriptionId = $paymentEntity['subscription_id'] ?? null;
        $paymentId      = $paymentEntity['id'] ?? null;
        $amountPaise    = $paymentEntity['amount'] ?? null;
        $currency       = $paymentEntity['currency'] ?? 'INR';
        $orderId        = $paymentEntity['order_id'] ?? null;

        if ($subscriptionId) {
            // 1) Try DonationSubscription first
            $donSub = DonationSubscription::where('razorpay_subscription_id', $subscriptionId)->first();

            if ($donSub) {
                // Create a new Donation row for each recurring charge
                $donation = Donation::create([
                    'donor_id'            => $donSub->donor_id,
                    'campaign'            => $donSub->meta['campaign'] ?? null,
                    'amount_paise'        => $amountPaise,
                    'currency'            => $currency,
                    'status'              => 'paid',
                    'razorpay_order_id'   => $orderId,
                    'razorpay_payment_id' => $paymentId,
                    'razorpay_signature'  => null,
                    'meta'                => array_merge($donSub->meta ?? [], [
                        'source'          => 'autopay',
                        'subscription_id' => $subscriptionId,
                        'webhook'         => $request->all(),
                    ]),
                ]);

                // Ensure subscription is marked active
                if ($donSub->status !== 'active') {
                    $donSub->status = 'active';
                    $donSub->save();
                }

                try {
                    // generate + email receipt for each recurring donation
                    $this->finalizePaid($donation);
                } catch (\Throwable $e) {
                    Log::error('finalizePaid failed for recurring donation', [
                        'donation_id'      => $donation->id,
                        'subscription_id'  => $subscriptionId,
                        'msg'              => $e->getMessage(),
                    ]);
                }

            } else {
                // 2) If not a DonationSubscription, try MemberSubscription (membership Autopay)
                $memSub = MemberSubscription::where('razorpay_subscription_id', $subscriptionId)->first();

                if ($memSub) {
                    Payment::create([
                        'user_id'             => $memSub->user_id,
                        'screenshot'          => null,
                        'razorpay_order_id'   => $orderId,
                        'razorpay_payment_id' => $paymentId,
                        'status'              => 'autopay_recurring', // distinguish in list
                        'amount'              => $amountPaise,
                        'currency'            => $currency,
                        'method'              => 'UPI Autopay',
                        'note'                => 'Recurring membership charge via webhook',
                        'is_verified'         => false,   // admin verifies & activates if needed
                        'verified_at'         => null,
                    ]);

                    if ($memSub->status !== 'active') {
                        $memSub->status = 'active';
                        $memSub->save();
                    }
                } else {
                    Log::warning('subscription.charged: subscription not found for donation or membership', [
                        'subscription_id' => $subscriptionId,
                    ]);
                }
            }
        }
    }

    // ------------------------------------------------------------------
    // D) OPTIONAL: update subscription status for both kinds
    // ------------------------------------------------------------------
    if (in_array($event, ['subscription.paused', 'subscription.completed', 'subscription.cancelled'])
        && $subscriptionEntity
    ) {
        $subscriptionId = $subscriptionEntity['id'] ?? null;
        $status         = $subscriptionEntity['status'] ?? $event;

        if ($subscriptionId) {
            // donation subscription
            $donSub = DonationSubscription::where('razorpay_subscription_id', $subscriptionId)->first();
            if ($donSub) {
                $donSub->status = $status;
                $donSub->save();
            }

            // membership subscription
            $memSub = MemberSubscription::where('razorpay_subscription_id', $subscriptionId)->first();
            if ($memSub) {
                $memSub->status = $status;
                $memSub->save();
            }
        }
    }

    return response('OK', 200);
}



   private function finalizePaid(Donation $donation): void
{
    // Generate PDF once
    if (!$donation->receipt_pdf_path || !$donation->receipt_no) {
        app(DonationReceiptService::class)->createAndStorePdf($donation);
        $donation->refresh();
    }

    // Email if donor has email and not already emailed
    $donation->loadMissing('donor');
    if ($donation->donor?->email && !$donation->emailed_at) {
        Mail::to($donation->donor->email)->send(new DonationReceiptMail($donation));
        $donation->update(['emailed_at' => now()]);
    }
}

public function donationCancelled()
{
    // you can also read any flash messages here if needed
    return view('page::donations.donation-cancelled');
}

//===========================================================Admin Creation Donation===========================================//
    public function donationsIndex(Request $request)
    {
    $rows = Donation::with('donor')
        ->when($request->filled('donor'), fn($q) => $q->where('donor_id', $request->donor))
        ->latest()
        ->simplePaginate(20)
        ->appends($request->query());

    return view('page::donations.index', compact('rows'));
}

    public function adminCreateDonation(Request $request, Donor $donor)
    {
    $data = $request->validate([
        'amount'    => ['required','numeric','min:1'],
        'campaign'  => ['nullable','string','max:120'],
        'mark_paid' => ['nullable','boolean'],
        'pay_mode'  => ['nullable', Rule::in(['razorpay','upi','cash','bank','cheque','other'])],
        'notes'     => ['nullable','string','max:500'],
    ]);

    $amountPaise = (int) round(((float) $data['amount']) * 100);
    $isPaid = (bool) ($data['mark_paid'] ?? false);

    $donation = Donation::create([
        'donor_id'            => $donor->id,
        'campaign'            => $data['campaign'] ?? null,
        'amount_paise'        => $amountPaise,
        'currency'            => 'INR',
        'status'              => $isPaid ? 'paid' : 'created',
        'razorpay_order_id'   => null,
        'razorpay_payment_id' => $isPaid ? ('ADMIN-'.now()->format('YmdHis')) : null,
        'razorpay_signature'  => null,
        'meta'                => [
            'source'   => 'admin',
            'pay_mode' => $data['pay_mode'] ?? null,
            'notes'    => $data['notes'] ?? null,
            'created_by' => auth()->id(),
        ],
    ]);

    // Optional: issue receipt immediately if marked paid
    if ($isPaid) {
        try {
            // Generate a PDF receipt and email it to donor if email exists
            $service = app(\App\Services\DonationReceiptService::class);
            $service->createAndStorePdf($donation);

            if (!empty($donor->email)) {
                \Mail::to($donor->email)->queue(new \App\Mail\DonationReceiptMail($donation));
            }
        } catch (\Throwable $e) {
            \Log::warning('DONATION.ADMIN_RECEIPT_FAIL', ['id' => $donation->id, 'msg' => $e->getMessage()]);
        }
    }
    
    // Finish adminCreateDonation()
    return back()->with('message', 'Donation saved'.($isPaid ? ' & marked paid.' : '.'));
    }

    /** Generate and persist a receipt PDF for a donation */
    public function generateReceipt(Donation $donation, DonationReceiptService $service)
    {
        if (!$donation->relationLoaded('donor')) $donation->load('donor');

        try {
            $service->createAndStorePdf($donation);
            return back()->with('message', 'Receipt generated.');
        } catch (\Throwable $e) {
            \Log::error('DONATION.RECEIPT_GEN_FAIL', ['id'=>$donation->id, 'msg'=>$e->getMessage()]);
            return back()->with('message', 'Failed to generate receipt.');
        }
    }

    /** Download the stored receipt */
    public function downloadReceipt(Donation $donation)
    {
        $path = $donation->receipt_pdf_path;
        if (!$path || !\Storage::disk('public')->exists($path)) {
            return back()->with('message', 'Receipt not found. Please generate first.');
        }
        return response()->download(storage_path('app/public/'.$path));
    }

    /** Email the receipt PDF to the donor */
    public function emailReceipt(Donation $donation)
    {
        if (!$donation->relationLoaded('donor')) $donation->load('donor');
        if (empty($donation->donor?->email)) {
            return back()->with('message', 'Donor does not have an email.');
        }

        // Ensure there is a PDF; generate if missing
        if (!$donation->receipt_pdf_path || !\Storage::disk('public')->exists($donation->receipt_pdf_path)) {
            app(DonationReceiptService::class)->createAndStorePdf($donation);
        }

        try {
            \Mail::to($donation->donor->email)->queue(new \App\Mail\DonationReceiptMail($donation));
            return back()->with('message', 'Receipt emailed to donor.');
        } catch (\Throwable $e) {
            \Log::error('DONATION.RECEIPT_MAIL_FAIL', ['id'=>$donation->id, 'msg'=>$e->getMessage()]);
            return back()->with('message', 'Failed to send email.');
        }
    }



//===================================================BANK DETAILS======================================================================//
 /**
     * Display a listing of the bank details.
     */
    public function bankIndex()
    {
        // Show only banks created by logged in user (change if you want global)
        $bank = Bank::where('user_id', Auth::id())
            ->latest()
            ->simplePaginate(10);

        return view('page::donations.bank-details', compact('bank'));
        // ^ adjust view path if your blade is different
    }

    /**
     * Store a newly created bank detail in storage.
     */
    public function storeBank(Request $request)
    {
        $request->validate([
            'account_holder' => 'nullable|string|max:191',
            'bank_name'      => 'required|string|max:191',
            'account_number' => 'required|string|max:50',
            'account_ifsc'   => 'required|string|max:20',
            'message'        => 'nullable|string',
            // Relax QR code validation as requested (accept any file up to 8MB)
            
        ]);

        $payload = [
            'user_id'        => Auth::id(),
            'account_holder' => $request->account_holder,
            'bank_name'      => $request->bank_name,
            'account_number' => $request->account_number,
            'account_ifsc'   => $request->account_ifsc,
            'message'        => $request->message,
        ];

        // Handle optional QR upload and persist path inside message as JSON
        if ($request->hasFile('qr_code')) {
            $img  = $request->file('qr_code');
            $dir  = 'banks/qr/'.Auth::id();
            $name = 'qr_'.time().'.'.$img->getClientOriginalExtension();
            \Storage::disk('public')->putFileAs($dir, $img, $name);

            $qrPath = $dir.'/'.$name;

            // merge message as JSON
            $msg = $request->message;
            $data = [];
            if ($msg) {
                $decoded = json_decode($msg, true);
                if (is_array($decoded)) $data = $decoded; else $data['text'] = $msg;
            }
            $data['qr'] = $qrPath;
            $payload['message'] = json_encode($data);
        }

        Bank::create($payload);

        return redirect('/bank-details')->with('message', 'Added successfully.');
    }

    /**
     * Update the specified bank detail in storage.
     */
    public function updateBank(Request $request, Bank $bank)
    {
        // Security: ensure this entry belongs to current user
        if ($bank->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'account_holder' => 'nullable|string|max:191',
            'bank_name'      => 'required|string|max:191',
            'account_number' => 'required|string|max:50',
            'account_ifsc'   => 'required|string|max:20',
            'message'        => 'nullable|string',
            // Relax QR code validation as requested (accept any file up to 8MB)
            'qr_code'        => 'nullable|file|max:8192',
        ]);

        $payload = [
            'account_holder' => $request->account_holder,
            'bank_name'      => $request->bank_name,
            'account_number' => $request->account_number,
            'account_ifsc'   => $request->account_ifsc,
            'message'        => $request->message,
        ];

        if ($request->hasFile('qr_code')) {
            $img  = $request->file('qr_code');
            $dir  = 'banks/qr/'.Auth::id();
            $name = 'qr_'.time().'.'.$img->getClientOriginalExtension();
            \Storage::disk('public')->putFileAs($dir, $img, $name);
            $qrPath = $dir.'/'.$name;

            // merge with existing message JSON
            $data = [];
            if ($request->message) {
                $decoded = json_decode($request->message, true);
                if (is_array($decoded)) $data = $decoded; else $data['text'] = $request->message;
            } else if ($bank->message) {
                $decoded = json_decode($bank->message, true);
                if (is_array($decoded)) $data = $decoded;
            }
            $data['qr'] = $qrPath;
            $payload['message'] = json_encode($data);
        }

        $bank->update($payload);

        return redirect('/bank-details')->with('message', 'Updated successfully.');
    }

    /**
     * Remove the specified bank detail from storage.
     */
    public function destroyBank(Bank $bank)
    {
        // Security: ensure this entry belongs to current user
        if ($bank->user_id !== Auth::id()) {
            abort(403);
        }

        $bank->delete();

        return redirect('/bank-details')->with('message', 'Deleted successfully.');
    }
//----------------------------------------------------------Autopay Payment  of Donation---------------------------------//
public function startDonationAutopay(Request $request, RazorpayRecurringService $recurring)
{
    $data = $request->validate([
        'name'    => ['required','string','max:120'],
        'email'   => ['nullable','email','max:190'],
        'mobile'  => ['required','string','max:20'],
        'pan_no'  => ['nullable','string','max:20'],
        'state'   => ['nullable','string','max:80'],
        'city'    => ['nullable','string','max:80'],
        'address' => ['nullable','string','max:255'],
        'pincode' => ['nullable','string','max:12'],
        'campaign'=> ['nullable','string','max:120'],
    ]);

    // 1) Donor
    $donor = Donor::firstOrNew(['mobile' => $data['mobile']]);
    $donor->fill([
        'name'    => $data['name'],
        'email'   => $data['email'] ?? $donor->email,
        'pan_no'  => $data['pan_no'] ?? $donor->pan_no,
        'state'   => $data['state'] ?? $donor->state,
        'city'    => $data['city'] ?? $donor->city,
        'address' => $data['address'] ?? $donor->address,
        'pincode' => $data['pincode'] ?? $donor->pincode,
    ])->save();

    // 2) choose plan for recurring donation
    $planId = config('services.razorpay.donation_plan_id');

    // 3) create subscription
    $subscription = $recurring->createUpiSubscription(
        $planId,
        totalCount: 12,  // e.g. 12 months
        customer: [
            'name'   => $donor->name,
            'email'  => $donor->email,
            'mobile' => $donor->mobile,
        ],
        notes: [
            'type'     => 'donation',
            'donor_id' => $donor->id,
            'campaign' => $data['campaign'] ?? null,
        ]
    );

    // 4) store in DB
    $sub = DonationSubscription::create([
        'donor_id'              => $donor->id,
        'razorpay_subscription_id' => $subscription['id'],
        'plan_id'               => $planId,
        'status'                => $subscription['status'] ?? 'created',
        'amount_paise'          => $subscription['item']['amount'] ?? null,
        'interval'              => $subscription['item']['interval'] ?? null,
        'meta'                  => [
            'campaign'    => $data['campaign'] ?? null,
            'form_source' => url()->previous(),
        ],
    ]);

    return view('page::donations.autopay-checkout', [
        'key'            => config('services.razorpay.key'),
        'subscription'   => $subscription,
        'subscriptionId' => $subscription['id'],
        'donor'          => $donor,
        'callbackRoute'  => route('donate.autopay.callback'),
    ]);
}

public function autopayCallback(Request $request, RazorpayRecurringService $recurring)
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
        return redirect()->to('/')->with('error', 'Autopay signature verification failed.');
    }

    // mark subscription active
    $sub = DonationSubscription::where('razorpay_subscription_id', $subId)->first();
    if ($sub) {
        $sub->status = 'active';
        $sub->save();
    }

    return redirect()->to('/thank-you')
        ->with('message', 'UPI Autopay setup successful! Thank you for starting recurring donations.');
}


}



