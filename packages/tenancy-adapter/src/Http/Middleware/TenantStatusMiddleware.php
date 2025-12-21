<?php

namespace Dapunjabi\TenancyAdapter\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantStatusMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = \Illuminate\Support\Facades\App::bound('currentTenant')
            ? \Illuminate\Support\Facades\App::make('currentTenant')
            : (\function_exists('currentTenant') ? \currentTenant() : null);
        if (! $tenant) {
            return $next($request);
        }

        // Allow admin UI to manage tenants even when suspended
        if ($request->is('admin/*')) {
            return $next($request);
        }

        if (($tenant->status ?? 'active') !== 'active') {
            return response()->view('tenancy::tenant.maintenance', [
                'tenant' => $tenant,
            ], 503);
        }

        return $next($request);
    }
}
