<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Modules\Setting\Entities\Setting;
use Modules\Page\Entities\Donor;
use Modules\Page\Entities\Donation;
use Modules\Page\Entities\Banner;
use Modules\Page\Entities\Bank;
use Modules\Page\Entities\DonationSubscription;
use Modules\User\Entities\MemberSubscription;
use Modules\User\Entities\Payment;
use App\Mail\DonationReceiptMail;
use App\Services\DonationReceiptService;
use App\Services\RazorpayRecurringService;
use Razorpay\Api\Api;
use Image;
use Auth;
use View;
use Config;

class DonarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['startDonation', 'callback', 'webhook', 'startDonationAutopay', 'autopayCallback']);
        if (!app()->runningInConsole()) {
            try { $setting = Setting::first(); } catch (\Throwable $e) { $setting = null; }
            View::share(['setting' => $setting]);
        }
    }

    public function index(): Renderable
    {
        $donar = Donor::latest()->simplePaginate(10);
        return view('page::donors.index', compact('donar'));
    }

    public function create(): Renderable
    {
        $getlist = Config::get('constants.state', []);
        return view('page::donors.add', compact('getlist'));
    }

    public function listCity(Request $request)
    {
        $getlist = Config::get('constants.state', []);
        $result = $getlist[$request->sid] ?? [];
        $html = '<option value="">Select City</option>';
        foreach ($result as $list) { $html .= '<option value="'.$list.'">'.$list.'</option>'; }
        return $html;
    }

    public function store(Request $request)
    {
        $donar = new Donor();
        if ($request->hasFile('profile')) {
            $postimage = $request->file('profile');
            $filename = $request->name.'_prd_'.time().'.'.$postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'.$filename));
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
        return back()->with('message', 'Donors Added Sucessfully!!');
    }

    public function show($id): Renderable
    {
        $donarlist = Donor::find($id);
        $getlist = Config::get('constants.state', []);
        return view('page::donors.edit', compact('donarlist', 'getlist'));
    }

    public function getbanner(): Renderable
    {
        $bannerimg = Banner::where('page_name', 'Donars')->first();
        return view('page::donors.addbreadcrum', compact('bannerimg'));
    }

    public function bannerStore(Request $request)
    {
        if ($request->exists('id')) {
            $banner = Banner::where('id', $request->id)->first();
            if ($request->hasFile('breadcrumb')) {
                $postimage = $request->file('breadcrumb');
                $bannerfile = $request->name.'_prd_'.time().'.'.$postimage->getClientOriginalExtension();
                Image::make($postimage)->save(public_path('/backend/uploads/'.$bannerfile));
                $banner->breadcrumb = $bannerfile;
            }
            $banner->page_name = $request->page_name;
            $banner->save();
            return back()->with('message', 'Updated Sucessfully!!');
        } else {
            $banner = new Banner();
            if ($request->hasFile('breadcrumb')) {
                $postimage = $request->file('breadcrumb');
                $bannerfile = $request->name.'_prd_'.time().'.'.$postimage->getClientOriginalExtension();
                Image::make($postimage)->save(public_path('/backend/uploads/'.$bannerfile));
                $banner->breadcrumb = $bannerfile;
            }
            $banner->page_name = $request->page_name;
            $banner->save();
            return back()->with('message', 'Added Sucessfully!!');
        }
    }

    public function update(Request $request, $id)
    {
        $donar = Donor::where('id', $id)->firstOrFail();
        if ($request->hasFile('profile')) {
            $postimage = $request->file('profile');
            $filename = $request->name.'_prd_'.time().'.'.$postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'.$filename));
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
        return back()->with('message', 'Donors updated Sucessfully!!');
    }

    public function destroy($id)
    {
        $donar = Donor::findOrFail($id);
        $donar->delete();
        return back()->with('message', 'deleted Sucessfully');
    }

    // ======================== Donations (one-time) ========================
    public function startDonation(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:120'],
            'email'   => ['nullable','email','max:190'],
            'mobile'  => ['required','regex:/^[6-9]\d{9}$/'],
            'pan_no'  => ['nullable','string','max:20'],
            'state'   => ['nullable','string','max:80'],
            'city'    => ['nullable','string','max:80'],
            'address' => ['nullable','string','max:255'],
            'pincode' => ['nullable','string','max:12'],
            'amount'  => ['required','numeric','min:1'],
            'campaign'=> ['nullable','string','max:120'],
        ]);

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

        $api   = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $amtPaise  = (int) round(((float) $data['amount']) * 100);
        $receiptId = 'don_'.$donor->id.'_'.now()->format('Ymd_His');

        $rOrder = $api->order->create([
            'amount'          => $amtPaise,
            'currency'        => 'INR',
            'receipt'         => $receiptId,
            'payment_capture' => 1,
        ]);

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

        $callback = (\Illuminate\Support\Facades\Route::has('donate.callback')
            ? route('donate.callback')
            : (\Illuminate\Support\Facades\Route::has('ngo.donate.callback')
                ? route('ngo.donate.callback')
                : url('/donate/callback')));

        return response()->view('page::donations.checkout', [
            'key'            => config('services.razorpay.key'),
            'orderId'        => $rOrder['id'],
            'amountPaise'    => $amtPaise,
            'donor'          => $donor,
            'donation'       => $donation,
            'callbackRoute'  => $callback,
        ]);
    }

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
        $generated  = hash_hmac('sha256', $orderId.'|'.$paymentId, $secret);

        $donation = Donation::where('razorpay_order_id', $orderId)->first();
        if (!$donation) return back()->with('error', 'Donation record not found.');

        if (hash_equals($generated, $signature)) {
            $donation->update([
                'status' => 'paid',
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature'  => $signature,
            ]);
            $this->finalizePaid($donation);
            return redirect()->to('/thank-you')->with('message', 'Thank you! Your donation was successful.');
        }

        $donation->update([
            'status'              => 'failed',
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature'  => $signature,
        ]);
        return redirect()->to('/')->with('error', 'Signature verification failed.');
    }

    public function donationCancelled()
    {
        return view('page::donations.donation-cancelled');
    }

    private function finalizePaid(Donation $donation): void
    {
        if (!$donation->receipt_pdf_path || !$donation->receipt_no) {
            app(DonationReceiptService::class)->createAndStorePdf($donation);
            $donation->refresh();
        }
        $donation->loadMissing('donor');
        if ($donation->donor?->email && !$donation->emailed_at) {
            try {
                Mail::to($donation->donor->email)->send(new DonationReceiptMail($donation));
                $donation->update(['emailed_at' => now()]);
            } catch (\Throwable $e) {
                Log::warning('Donation receipt email failed', ['donation_id' => $donation->id, 'error' => $e->getMessage()]);
            }
        }
    }

    // ======================== Donations listing (admin) ========================
    public function donationsIndex(Request $request): Renderable
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

        if ($isPaid) {
            try { $this->finalizePaid($donation); } catch (\Throwable $e) { /* ignore */ }
        }

        return back()->with('message', 'Donation saved'.($isPaid ? ' & marked paid.' : '.'));
    }

    // ======================== Bank details (admin) ========================
    public function bankIndex(): Renderable
    {
        $bank = Bank::where('user_id', Auth::id())->latest()->simplePaginate(10);
        return view('page::donations.bank-details', compact('bank'));
    }

    public function storeBank(Request $request)
    {
        $request->validate([
            'account_holder' => 'nullable|string|max:191',
            'bank_name'      => 'required|string|max:191',
            'account_number' => 'required|string|max:50',
            'account_ifsc'   => 'required|string|max:20',
            'message'        => 'nullable|string',
        ]);

        Bank::create([
            'user_id'        => Auth::id(),
            'account_holder' => $request->account_holder,
            'bank_name'      => $request->bank_name,
            'account_number' => $request->account_number,
            'account_ifsc'   => $request->account_ifsc,
            'message'        => $request->message,
        ]);

        return redirect('/bank-details')->with('message', 'Added successfully.');
    }

    public function updateBank(Request $request, Bank $bank)
    {
        if ($bank->user_id !== Auth::id()) abort(403);

        $request->validate([
            'account_holder' => 'nullable|string|max:191',
            'bank_name'      => 'required|string|max:191',
            'account_number' => 'required|string|max:50',
            'account_ifsc'   => 'required|string|max:20',
            'message'        => 'nullable|string',
        ]);

        $bank->update([
            'account_holder' => $request->account_holder,
            'bank_name'      => $request->bank_name,
            'account_number' => $request->account_number,
            'account_ifsc'   => $request->account_ifsc,
            'message'        => $request->message,
        ]);

        return redirect('/bank-details')->with('message', 'Updated successfully.');
    }

    public function destroyBank(Bank $bank)
    {
        if ($bank->user_id !== Auth::id()) abort(403);
        $bank->delete();
        return redirect('/bank-details')->with('message', 'Deleted successfully.');
    }

    // ======================== Autopay (recurring) ========================
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

        $planId = config('services.razorpay.donation_plan_id');
        $subscription = $recurring->createUpiSubscription(
            $planId,
            totalCount: 12,
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

        DonationSubscription::create([
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

        if (!$recurring->verifySubscriptionSignature($subId, $paymentId, $signature)) {
            return redirect()->to('/')->with('error', 'Autopay signature verification failed.');
        }

        $sub = DonationSubscription::where('razorpay_subscription_id', $subId)->first();
        if ($sub) { $sub->status = 'active'; $sub->save(); }

        return redirect()->to('/thank-you')->with('message', 'UPI Autopay setup successful! Thank you for starting recurring donations.');
    }
}