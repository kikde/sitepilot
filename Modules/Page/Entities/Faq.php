<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function booted(): void
    {
        // Tenant isolation (best-effort; only when tenant_id column exists).
        try {
            $tenantId = function_exists('tenant_id') ? tenant_id() : null;
            $hasTenantId = Schema::hasColumn((new static)->getTable(), 'tenant_id');

            if ($tenantId && $hasTenantId) {
                static::addGlobalScope('tenant', function ($q) use ($tenantId) {
                    $q->where('tenant_id', (int) $tenantId);
                });

                static::creating(function ($model) use ($tenantId) {
                    if (empty($model->tenant_id)) {
                        $model->tenant_id = (int) $tenantId;
                    }
                });
            }
        } catch (\Throwable $e) {
            // ignore
        }
    }

    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\FaqFactory::new();
    }
}
