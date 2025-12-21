<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
  'tenant_id','donor_id','campaign','amount_paise','currency','status',
  'razorpay_order_id','razorpay_payment_id','razorpay_signature','meta',
  'receipt_no','receipt_pdf_path','emailed_at',
];
protected $casts = [
  'meta' => 'array',
  'emailed_at' => 'datetime',
];
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\DonationFactory::new();
    }


public function donor()
{
    return $this->belongsTo(Donor::class, 'donor_id'); // explicit key (safe)
}

    protected static function booted(): void
    {
        $hasTenantId = null;

        static::addGlobalScope('tenant', function ($q) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('donations', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
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
                try { $hasTenantId = Schema::hasColumn('donations', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId && empty($model->tenant_id)) {
                $model->tenant_id = (int) $tenantId;
            }
        });
    }
}
