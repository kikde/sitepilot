<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Illuminate\Support\Str;

class RequireActiveLicense
{
    public function handle($request, Closure $next)
    {
        $tenant = app(TenantManager::class)->current();
        $status = $tenant?->license_status ?? 'active';
        if ($tenant && $status !== 'active') {
            // Allow access to billing routes even when suspended/past_due.
            $path = '/'.ltrim($request->path(), '/');
            if (Str::startsWith($path, ['/billing', '/webhooks/stripe'])) {
                return $next($request);
            }

            if ($status === 'past_due') {
                session()->flash('license_warning', 'Payment overdue. Please update billing to avoid suspension.');
                return $next($request);
            }

            return redirect('/billing')->withErrors([
                'license' => "License is {$status}. Access is limited until resolved.",
            ]);
        }
        return $next($request);
    }
}
