<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class DonationSubscription extends Model
{
    use HasFactory;

    protected $table = 'donation_subscriptions';

    protected $fillable = [
        'tenant_id',
        'donor_id',
        'razorpay_subscription_id',
        'plan_id',
        'status',
        'amount_paise',
        'interval',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * A subscription belongs to a donor.
     */
    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id');
    }

    /**
     * Helper: is subscription active?
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Helper: formatted amount in rupees.
     */
    public function amountInRupees(): ?float
    {
        return $this->amount_paise !== null
            ? $this->amount_paise / 100
            : null;
    }

    protected static function booted(): void
    {
        $hasTenantId = null;

        static::addGlobalScope('tenant', function ($q) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('donation_subscriptions', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId) {
                $q->where('tenant_id', (int) $tenantId);
            }
        });

        static::creating(function (self $model) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('donation_subscriptions', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId && empty($model->tenant_id)) {
                $model->tenant_id = (int) $tenantId;
            }
        });
    }
}
