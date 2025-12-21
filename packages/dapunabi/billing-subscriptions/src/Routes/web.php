<?php

use Illuminate\Support\Facades\Route;
use Dapunabi\Billing\Models\Plan;
use Dapunabi\Billing\Models\Subscription;
use Dapunabi\Billing\Models\Invoice;
use Dapunabi\Billing\Gateways\LocalGatewayAdapter;
use Dapunabi\Billing\Gateways\StripeAdapter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Dapunabi\Billing\Support\InvoicePdf;

Route::middleware('web')->group(function () {
    // Admin plans (very simple Phase 1 UI)
    Route::get('/admin/plans', function () {
        $plans = Plan::orderBy('price')->get();
        return view('billing::admin.plans.index', compact('plans'));
    })->middleware(['auth','platform'])->name('billing.admin.plans');

    Route::post('/admin/plans', function () {
        request()->validate([
            'code' => 'required|string|unique:billing_plans,code',
            'name' => 'required|string',
            'interval' => 'required|in:monthly,yearly',
            'price' => 'required|numeric|min:0',
            'seat_limit' => 'nullable|integer|min:1',
        ]);
        Plan::create([
            'code' => request('code'),
            'name' => request('name'),
            'interval' => request('interval'),
            'price' => request('price'),
            'currency' => config('billing.currency', 'USD'),
            'trial_days' => 0,
            'seat_limit' => request('seat_limit') !== null ? (int) request('seat_limit') : null,
            'active' => true,
        ]);
        return redirect()->route('billing.admin.plans')->with('status', 'Plan created');
    })->middleware(['auth','platform'])->name('billing.admin.plans.store');

    // Tenant billing dashboard
    Route::get('/billing', function () {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $subs = $tenantId ? Subscription::where('tenant_id', $tenantId)->orderByDesc('id')->get() : collect();
        $plans = Plan::where('active', true)->orderBy('price')->get();
        return view('billing::billing.index', compact('subs', 'plans', 'tenantId'));
    })->middleware(['auth','tenant'])->name('billing');

    // Phase 2: Local gateway checkout (development stub)
    Route::post('/billing/checkout/local', function () {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        abort_if(!$tenantId, 400, 'No tenant context');

        request()->validate([
            'plan_code' => 'required|string|exists:billing_plans,code',
        ]);

        $plan = Plan::where('code', request('plan_code'))->where('active', true)->firstOrFail();

        $adapter = new LocalGatewayAdapter();
        $invoice = $adapter->createInvoice($tenantId, $plan);

        return redirect()->route('billing.checkout.confirm', ['id' => $invoice->id]);
    })->middleware(['auth','tenant'])->name('billing.checkout.local');

    Route::get('/billing/checkout/confirm/{id}', function ($id) {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        abort_if(!$tenantId, 400, 'No tenant context');

        $invoice = Invoice::where('id', $id)->where('tenant_id', $tenantId)->firstOrFail();

        // Simulate payment success
        $invoice->status = 'paid';
        $invoice->paid_at = now();
        $invoice->save();

        // Activate or create subscription
        $plan = Plan::where('code', $invoice->number_meta['plan_code'] ?? null)->first();
        // Fallback: attempt to parse from invoice number meta is not stored; derive from last unpaid stub
        if (!$plan) {
            // As LocalGatewayAdapter stores plan_code in invoice attributes if available
            $plan = Plan::where('code', $invoice->plan_code ?? null)->first();
        }

        // If plan still not resolved, skip sub update (development stub)
                if ($plan) {
                    $start = Carbon::now();
                    $end = $plan->interval === 'yearly' ? (clone $start)->addYear() : (clone $start)->addMonth();

                    $sub = Subscription::updateOrCreate([
                        'tenant_id' => $tenantId,
                        'plan_code' => $plan->code,
                    ], [
                        'user_id' => Auth::id(),
                        'status' => 'active',
                        'current_period_start' => $start,
                        'current_period_end' => $end,
                        'cancel_at_period_end' => false,
                    ]);
                    event(new \Dapunabi\Billing\Events\SubscriptionStatusChanged($tenantId, $plan->code, null, 'active', 'local-confirm'));
                }

        return redirect()->route('billing.index')->with('status', 'Payment confirmed and subscription activated.');
    })->middleware(['auth','tenant'])->name('billing.checkout.confirm');

    // Stripe checkout (redirect to Stripe Hosted Checkout)
    Route::post('/billing/checkout', function () {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        abort_if(!$tenantId, 400, 'No tenant context');

        request()->validate(['plan_code' => 'required|string|exists:billing_plans,code']);
        $plan = Plan::where('code', request('plan_code'))->where('active', true)->firstOrFail();

        $successUrl = url('/billing');
        $cancelUrl = url('/billing');

        try {
            $adapter = new StripeAdapter();
            $url = $adapter->createCheckoutSession($tenantId, (int) Auth::id(), $plan, $successUrl, $cancelUrl);
        } catch (\Throwable $e) {
            return back()->withErrors(['stripe' => $e->getMessage()]);
        }

        return redirect()->away($url);
    })->middleware(['auth','tenant'])->name('billing.checkout');

    // Stripe webhook endpoint (idempotent)
    Route::post('/webhooks/stripe', function () {
        $secret = config('billing.stripe.webhook_secret');
        if (!$secret) return response('Webhook secret not configured', 400);

        $payload = file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        // Idempotency check
        $exists = DB::table('billing_webhook_logs')->where('event_id', $event->id)->exists();
        if ($exists) return response('Already processed', 200);

        $type = $event->type;
        try {
            switch ($type) {
                case 'checkout.session.completed':
                    $sess = $event->data->object;
                    $tenantId = (int) ($sess->metadata->tenant_id ?? 0);
                    $userId = (int) ($sess->metadata->user_id ?? 0);
                    $planCode = (string) ($sess->metadata->plan_code ?? '');
                    if ($tenantId && $planCode) {
                        $plan = Plan::where('code', $planCode)->first();
                        if ($plan) {
                            $start = Carbon::now();
                            $end = $plan->interval === 'yearly' ? (clone $start)->addYear() : (clone $start)->addMonth();
                            $sub = Subscription::updateOrCreate([
                                'tenant_id' => $tenantId,
                                'plan_code' => $plan->code,
                            ], [
                                'user_id' => $userId ?: null,
                                'status' => 'active',
                                'current_period_start' => $start,
                                'current_period_end' => $end,
                                'cancel_at_period_end' => false,
                            ]);
                            event(new \Dapunabi\Billing\Events\SubscriptionStatusChanged($tenantId, $plan->code, null, 'active', 'stripe-checkout'));
                        }
                    }
                    break;
                case 'invoice.paid':
                    $inv = $event->data->object;
                    $number = $inv->number ?? null;
                    if ($number) {
                        Invoice::where('number', $number)->update(['status' => 'paid', 'paid_at' => now()]);
                    }
                    break;
                case 'invoice.payment_failed':
                    $inv = $event->data->object;
                    $number = $inv->number ?? null;
                    if ($number) {
                        Invoice::where('number', $number)->update(['status' => 'due']);
                    }
                    // Also mark subscription past_due if we can infer tenant/plan from metadata
                    $tenantId = isset($inv->metadata->tenant_id) ? (int) $inv->metadata->tenant_id : null;
                    $planCode = isset($inv->metadata->plan_code) ? (string) $inv->metadata->plan_code : null;
                    if ($tenantId && $planCode) {
                        Subscription::where('tenant_id', $tenantId)->where('plan_code', $planCode)->update(['status' => 'past_due']);
                    }
                    break;
                default:
                    // ignore other events
                    break;
            }
        } finally {
            DB::table('billing_webhook_logs')->insert([
                'provider' => 'stripe',
                'event_id' => $event->id,
                'type' => $type,
                'payload' => $payload,
                'processed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response('ok', 200);
    })->name('billing.webhooks.stripe');

    // Phase 4: Invoice list and download (PDF on demand)
    Route::get('/billing/invoices', function () {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        if (! $tenantId) {
            try {
                if (class_exists('Dapunjabi\\CoreAuth\\Support\\TenantManager')) {
                    $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
                    $tenantId = $tm->current()?->id;
                }
            } catch (\Throwable $e) {}
        }
        if (! $tenantId) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('tenants')) {
                    $tenantId = \Illuminate\Support\Facades\DB::table('tenants')->where('slug','default')->value('id');
                } elseif (\Illuminate\Support\Facades\Schema::hasTable('coreauth_tenants')) {
                    $tenantId = \Illuminate\Support\Facades\DB::table('coreauth_tenants')->where('slug','default')->value('id');
                }
            } catch (\Throwable $e) {}
        }
        if (! $tenantId) {
            return redirect()->route('tenant.select')->withErrors(['tenant' => 'Please select a tenant to view invoices.']);
        }
        $invoices = Invoice::where('tenant_id', $tenantId)->orderByDesc('id')->get();
        return view('billing::billing.invoices', compact('invoices'));
    })->middleware(['auth','tenant'])->name('billing.invoices');

    Route::get('/billing/invoices/{id}/download', function ($id) {
        $tenant = function_exists('currentTenant') ? currentTenant() : null;
        if (! $tenant) {
            try {
                if (class_exists('Dapunjabi\\CoreAuth\\Support\\TenantManager')) {
                    $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
                    $tenant = $tm->current();
                }
            } catch (\Throwable $e) {}
        }
        if (! $tenant) {
            return redirect()->route('tenant.select')->withErrors(['tenant' => 'Please select a tenant first.']);
        }
        $invoice = Invoice::where('tenant_id', $tenant->id)->findOrFail($id);
        $rel = InvoicePdf::generateAndStore($invoice, $tenant->slug ?? ('tenant-'.$tenant->id));
        $abs = Storage::disk('local')->path($rel);
        return response()->download($abs, basename($abs));
    })->middleware(['auth','tenant'])->name('billing.invoices.download');

    // Phase 5: Seats management UI and actions
    Route::get('/billing/seats', function () {
        $tenant = function_exists('currentTenant') ? currentTenant() : null;
        if (! $tenant) {
            try {
                if (class_exists('Dapunjabi\\CoreAuth\\Support\\TenantManager')) {
                    $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
                    $tenant = $tm->current();
                }
            } catch (\Throwable $e) {}
        }
        if (! $tenant) {
            return redirect()->route('tenant.select')->withErrors(['tenant' => 'Please select a tenant to manage seats.']);
        }
        $tenantId = $tenant->id;
        $sm = new \Dapunabi\Billing\Support\SeatManager();
        $sub = $sm->activeSubscription($tenantId);
        $allowed = $sm->allowedSeats($sub);
        $used = $sm->seatsUsed($tenantId);
        $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;
        $subIds = \Dapunabi\Billing\Models\Subscription::where('tenant_id', $tenantId)->pluck('id');
        $seats = \Dapunabi\Billing\Models\SubscriptionSeat::whereIn('subscription_id', $subIds)->get();
        $users = $userModel::whereIn('id', $seats->pluck('user_id')->filter())->get()->keyBy('id');
        return view('billing::billing.seats', compact('tenant','sub','allowed','used','seats','users'));
    })->middleware(['auth','tenant'])->name('billing.seats');

    Route::post('/billing/seats/assign', function () {
        $tenant = function_exists('currentTenant') ? currentTenant() : null;
        if (! $tenant) {
            try {
                if (class_exists('Dapunjabi\\CoreAuth\\Support\\TenantManager')) {
                    $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
                    $tenant = $tm->current();
                }
            } catch (\Throwable $e) {}
        }
        if (! $tenant) {
            return redirect()->route('tenant.select')->withErrors(['tenant' => 'Please select a tenant to manage seats.']);
        }
        $tenantId = $tenant->id;
        $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;
        request()->validate([
            'user_id' => 'nullable|integer',
            'email' => 'nullable|email'
        ]);
        $userId = request('user_id');
        if (!$userId && request('email')) {
            $userId = $userModel::where('email', request('email'))->value('id');
        }
        if (!$userId) return back()->withErrors(['assign' => 'User not found']);
        $sm = new \Dapunabi\Billing\Support\SeatManager();
        if (! $sm->assign($tenantId, (int) $userId)) {
            return back()->withErrors(['assign' => 'No seats available. Upgrade your plan.']);
        }
        return back()->with('status', 'Seat assigned.');
    })->middleware(['auth','tenant'])->name('billing.seats.assign');

    Route::post('/billing/seats/release', function () {
        $tenant = function_exists('currentTenant') ? currentTenant() : null;
        if (! $tenant) {
            try {
                if (class_exists('Dapunjabi\\CoreAuth\\Support\\TenantManager')) {
                    $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
                    $tenant = $tm->current();
                }
            } catch (\Throwable $e) {}
        }
        if (! $tenant) {
            return redirect()->route('tenant.select')->withErrors(['tenant' => 'Please select a tenant to manage seats.']);
        }
        request()->validate(['user_id' => 'required|integer']);
        $sm = new \Dapunabi\Billing\Support\SeatManager();
        $count = $sm->release($tenant->id, (int) request('user_id'));
        return back()->with('status', $count ? 'Seat released.' : 'No seat to release.');
    })->middleware(['auth','tenant'])->name('billing.seats.release');

    // Phase 7: Admin tools - Manual invoice, Refund, Webhook logs + replay
    Route::get('/admin/billing/invoices', function () {
        $tenants = [];
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('coreauth_tenants')) {
                $tenants = DB::table('coreauth_tenants')->select('id','name','slug')->orderBy('id')->get();
            } elseif (\Illuminate\Support\Facades\Schema::hasTable('tenants')) {
                $tenants = DB::table('tenants')->select('id','name','slug')->orderBy('id')->get();
            }
        } catch (\Throwable $e) {}
        $invoices = Invoice::orderByDesc('id')->limit(50)->get();
        return view('billing::admin.invoices.index', compact('invoices','tenants'));
    })->middleware(['auth','platform'])->name('billing.admin.invoices');

    Route::post('/admin/billing/invoices', function () {
        request()->validate([
            'tenant_id' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:8',
            'number' => 'nullable|string|max:190',
            'due_date' => 'nullable|date',
        ]);
        $num = request('number') ?: ('INV-'.date('Ymd').'-'.str_pad((string)(Invoice::max('id')+1), 4, '0', STR_PAD_LEFT));
        Invoice::create([
            'tenant_id' => (int) request('tenant_id'),
            'number' => $num,
            'amount' => (float) request('amount'),
            'currency' => request('currency') ?: config('billing.currency','USD'),
            'status' => 'due',
            'due_date' => request('due_date'),
        ]);
        return back()->with('status','Invoice created');
    })->middleware(['auth','platform'])->name('billing.admin.invoices.store');

    Route::post('/admin/billing/invoices/{id}/refund', function ($id) {
        $inv = Invoice::findOrFail($id);
        $inv->status = 'void';
        $inv->save();
        return back()->with('status', 'Invoice voided (refund simulated).');
    })->middleware(['auth','platform'])->name('billing.admin.invoices.refund');

    Route::get('/admin/webhooks', function () {
        $logs = DB::table('billing_webhook_logs')->orderByDesc('id')->limit(100)->get();
        return view('billing::admin.webhooks.index', compact('logs'));
    })->middleware(['auth','platform'])->name('billing.admin.webhooks');

    Route::post('/admin/webhooks/{id}/replay', function ($id) {
        $row = DB::table('billing_webhook_logs')->where('id', $id)->first();
        if (!$row) return back()->withErrors(['webhook' => 'Log not found']);
        try {
            \Dapunabi\Billing\Support\WebhookProcessor::process($row->provider, $row->payload);
        } catch (\Throwable $e) {
            return back()->withErrors(['webhook' => 'Replay failed: '.$e->getMessage()]);
        }
        return back()->with('status', 'Webhook processed again.');
    })->middleware(['auth','platform'])->name('billing.admin.webhooks.replay');
});
