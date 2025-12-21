<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
          'tenant_id',
          'title',
            'address',
            'company_no',
            'pan_no',
            'site_logo',
        ];

    protected static function newFactory()
    {
        return \Modules\Setting\Database\factories\SettingFactory::new();
    }

    protected static function booted(): void
    {
        $hasTenantId = null;

        static::addGlobalScope('tenant', function ($q) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('settings', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
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
                try { $hasTenantId = Schema::hasColumn('settings', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId && empty($model->tenant_id)) {
                $model->tenant_id = (int) $tenantId;
            }
        });
    }
}
