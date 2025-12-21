<?php

namespace Dapunabi\Billing\Support;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dapunabi\Billing\Models\Plan;
use Dapunabi\Billing\Models\Subscription;
use Dapunabi\Billing\Models\Invoice;

class WebhookProcessor
{
    public static function process(string $provider, string $payload): void
    {
        if ($provider === 'stripe') {
            self::processStripe($payload);
        }
    }

    protected static function processStripe(string $payload): void
    {
        $event = json_decode($payload);
        if (!$event || empty($event->type)) return;
        $type = $event->type;
        switch ($type) {
            case 'checkout.session.completed':
                $sess = $event->data->object ?? null;
                if (!$sess) break;
                $tenantId = isset($sess->metadata->tenant_id) ? (int) $sess->metadata->tenant_id : 0;
                $userId = isset($sess->metadata->user_id) ? (int) $sess->metadata->user_id : 0;
                $planCode = isset($sess->metadata->plan_code) ? (string) $sess->metadata->plan_code : '';
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
                        event(new \Dapunabi\Billing\Events\SubscriptionStatusChanged($tenantId, $plan->code, null, 'active', 'stripe-webhook'));
                    }
                }
                break;
            case 'invoice.paid':
                $inv = $event->data->object ?? null;
                if ($inv && isset($inv->number)) {
                    Invoice::where('number', $inv->number)->update(['status' => 'paid', 'paid_at' => now()]);
                }
                break;
            case 'invoice.payment_failed':
                $inv = $event->data->object ?? null;
                if ($inv && isset($inv->number)) {
                    Invoice::where('number', $inv->number)->update(['status' => 'due']);
                }
                $tenantId = isset($inv->metadata->tenant_id) ? (int) $inv->metadata->tenant_id : null;
                $planCode = isset($inv->metadata->plan_code) ? (string) $inv->metadata->plan_code : null;
                if ($tenantId && $planCode) {
                    Subscription::where('tenant_id', $tenantId)->where('plan_code', $planCode)->update(['status' => 'past_due']);
                }
                break;
            default:
                // ignore
                break;
        }
    }
}

