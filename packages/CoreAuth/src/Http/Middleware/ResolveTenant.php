<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResolveTenant
{
    public function handle($request, Closure $next)
    {
        $tm = app(TenantManager::class);
        $tm->resolveFromRequest();

        // If an authenticated non-platform user has no tenant context, force tenant selection.
        try {
            if (Auth::check() && ! $tm->current()) {
                $userId = Auth::id();
                $isSuperAdmin =
                    (Auth::user()?->email === config('coreauth.superadmin.email')) ||
                    DB::table('coreauth_role_user')->where('user_id', $userId)->where('role_slug', 'superadmin')->exists();

                if (! $isSuperAdmin) {
                    $path = '/'.ltrim($request->path(), '/');
                    $allow = ['/tenant/select', '/logout', '/account/profile', '/account/sessions', '/mfa/setup', '/mfa/verify'];
                    if (! Str::startsWith($path, $allow)) {
                        return redirect()->route('tenant.select')->withErrors([
                            'tenant' => 'Please select a tenant to continue.',
                        ]);
                    }
                }
            }
        } catch (\Throwable $e) {
            // ignore
        }
        return $next($request);
    }
}
