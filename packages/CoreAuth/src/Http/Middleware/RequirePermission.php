<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Dapunjabi\CoreAuth\Support\TenantManager;

class RequirePermission
{
    public function handle($request, Closure $next, string $permission)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $tm = app(TenantManager::class);
        $tenant = $tm->current();
        $tenantId = $tenant?->id;
        if (!$tenantId) {
            return redirect()->to('/tenant/select')->withErrors(['tenant' => 'Please select a tenant.']);
        }
        if (!$tm->userHasPermission(Auth::id(), $permission, $tenantId)) {
            abort(403, 'Insufficient permissions');
        }
        return $next($request);
    }
}

