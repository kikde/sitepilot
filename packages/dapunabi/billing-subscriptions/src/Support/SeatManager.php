<?php

namespace Dapunabi\Billing\Support;

use Dapunabi\Billing\Models\Subscription;
use Dapunabi\Billing\Models\SubscriptionSeat;
use Dapunabi\Billing\Models\Plan;
use Illuminate\Support\Facades\DB;

class SeatManager
{
    public function activeSubscription(int $tenantId): ?Subscription
    {
        return Subscription::where('tenant_id', $tenantId)
            ->whereIn('status', ['trialing','active'])
            ->orderByDesc('id')
            ->first();
    }

    public function allowedSeats(?Subscription $sub): ?int
    {
        if (!$sub) return null;
        $plan = Plan::where('code', $sub->plan_code)->first();
        return $plan?->seat_limit;
    }

    public function seatsUsed(int $tenantId): int
    {
        return SubscriptionSeat::whereIn('subscription_id', function ($q) use ($tenantId) {
            $q->select('id')->from('billing_subscriptions')->where('tenant_id', $tenantId);
        })->count();
    }

    public function hasSeat(int $tenantId, int $userId): bool
    {
        return SubscriptionSeat::whereIn('subscription_id', function ($q) use ($tenantId) {
            $q->select('id')->from('billing_subscriptions')->where('tenant_id', $tenantId);
        })->where('user_id', $userId)->exists();
    }

    public function canAssign(?Subscription $sub, int $tenantId): bool
    {
        $limit = $this->allowedSeats($sub);
        if ($limit === null) return true; // unlimited or not configured
        return $this->seatsUsed($tenantId) < $limit;
    }

    public function assign(int $tenantId, int $userId): bool
    {
        $sub = $this->activeSubscription($tenantId);
        if (!$sub) return false;
        if ($this->hasSeat($tenantId, $userId)) return true;
        if (!$this->canAssign($sub, $tenantId)) return false;

        SubscriptionSeat::create([
            'subscription_id' => $sub->id,
            'user_id' => $userId,
        ]);
        return true;
    }

    public function release(int $tenantId, int $userId): int
    {
        $subIds = Subscription::where('tenant_id', $tenantId)->pluck('id');
        return SubscriptionSeat::whereIn('subscription_id', $subIds)->where('user_id', $userId)->delete();
    }
}

