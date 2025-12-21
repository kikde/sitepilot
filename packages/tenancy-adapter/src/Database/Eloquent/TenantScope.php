<?php

namespace Dapunjabi\TenancyAdapter\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $tenant = \Illuminate\Support\Facades\App::bound('currentTenant')
            ? \Illuminate\Support\Facades\App::make('currentTenant')
            : (\function_exists('currentTenant') ? \currentTenant() : null);
        $column = $model->getTable().'.'.$this->tenantIdColumn($model);

        if ($tenant) {
            $builder->where($column, $tenant->id);
        } else {
            // No tenant resolved → prevent cross-tenant leakage
            $builder->whereRaw('0 = 1');
        }
    }

    protected function tenantIdColumn(Model $model): string
    {
        if (method_exists($model, 'getTenantIdColumn')) {
            return $model->getTenantIdColumn();
        }
        return 'tenant_id';
    }
}
