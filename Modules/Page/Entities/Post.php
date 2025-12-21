<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'posts';
    
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\PostFactory::new();
    }

    protected static function booted(): void
    {
        $hasTenantId = null;

        static::addGlobalScope('tenant', function ($q) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('posts', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
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
                try { $hasTenantId = Schema::hasColumn('posts', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId && empty($model->tenant_id)) {
                $model->tenant_id = (int) $tenantId;
            }
        });
    }
}
