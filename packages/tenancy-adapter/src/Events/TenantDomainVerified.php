<?php

namespace Dapunjabi\TenancyAdapter\Events;

use Dapunjabi\TenancyAdapter\Models\TenantDomain;

class TenantDomainVerified
{
    public function __construct(public TenantDomain $domain) {}
}

