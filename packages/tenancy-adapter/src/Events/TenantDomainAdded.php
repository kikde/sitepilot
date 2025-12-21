<?php

namespace Dapunjabi\TenancyAdapter\Events;

use Dapunjabi\TenancyAdapter\Models\TenantDomain;

class TenantDomainAdded
{
    public function __construct(public TenantDomain $domain) {}
}

