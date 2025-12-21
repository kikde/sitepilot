<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Dapunjabi\CoreAuth\Support\TenantManager;

class RequireActiveLicense
{
    public function handle($request, Closure $next)
    {
        $tenant = app(TenantManager::class)->current();
        if ($tenant && ($tenant->license_status ?? 'active') !== 'active') {
            return redirect('/billing')->withErrors(['license' => 'License is '.$tenant->license_status.'. Access is limited until resolved.']);
        }
        return $next($request);
    }
}

