<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Dapunjabi\CoreAuth\Support\TenantManager;

class ResolveTenant
{
    public function handle($request, Closure $next)
    {
        app(TenantManager::class)->resolveFromRequest();
        return $next($request);
    }
}

