<?php

namespace Dapunjabi\TenancyAdapter\Database;

use Dapunjabi\TenancyAdapter\Models\Tenant;

class DefaultTenancyConnectionResolver implements TenancyConnectionResolver
{
    public function resolveConnectionName(Tenant $tenant): string
    {
        // For now, just return the default application connection.
        return config('database.default');
    }
}

