<?php

namespace Dapunjabi\TenancyAdapter\Database;

use Dapunjabi\TenancyAdapter\Models\Tenant;

interface TenancyConnectionResolver
{
    /**
     * Return the database connection name for the given tenant.
     * Implementations may derive connection parameters per tenant.
     */
    public function resolveConnectionName(Tenant $tenant): string;
}

