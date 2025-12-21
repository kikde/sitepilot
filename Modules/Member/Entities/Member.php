<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'name',
        'slug',
        'description',
        'images',
    ];

    // protected $casts = [
    //     'images' => 'array',
    // ];

    protected static function newFactory()
    {
        return \Modules\Member\Database\factories\MemberFactory::new();
    }

    // Many-to-many: default pivot table `category_member`
    // If your pivot is named differently, specify ->withTimestamps()->using() or ->withPivot(), and `->table('category_member')` via intermediate model.
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function thumbImages()
    {
        return $this->hasMany(Thumbimage::class);
    }

    protected static function booted(): void
    {
        $hasTenantId = null;

        static::addGlobalScope('tenant', function ($q) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('members', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
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
                try { $hasTenantId = Schema::hasColumn('members', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId && empty($model->tenant_id)) {
                $model->tenant_id = (int) $tenantId;
            }
        });
    }
}
