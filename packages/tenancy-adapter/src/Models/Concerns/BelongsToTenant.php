<?php

namespace Dapunjabi\TenancyAdapter\Models\Concerns;

use Dapunjabi\TenancyAdapter\Database\Eloquent\TenantScope;

trait BelongsToTenant
{
    public static function bootBelongsToTenant(): void
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (empty($model->{$model->getTenantIdColumn()})) {
                $tenant = currentTenant();
                if ($tenant) {
                    $model->{$model->getTenantIdColumn()} = $tenant->id;
                }
            }
        });
    }

    public function getTenantIdColumn(): string
    {
        return property_exists($this, 'tenantIdColumn') ? $this->tenantIdColumn : 'tenant_id';
    }

    public function tenant()
    {
        return $this->belongsTo(\Dapunjabi\TenancyAdapter\Models\Tenant::class, $this->getTenantIdColumn());
    }
}

