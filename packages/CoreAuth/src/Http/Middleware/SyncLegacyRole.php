<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Dapunjabi\CoreAuth\Support\TenantManager;

class SyncLegacyRole
{
    public function handle($request, Closure $next)
    {
        try {
            if (!Auth::check()) {
                return $next($request);
            }

            $tm = app(TenantManager::class);
            $tenantId = $tm->current()?->id ?? (function_exists('tenant_id') ? tenant_id() : null);
            if (!$tenantId) {
                return $next($request);
            }

            $user = Auth::user();
            if (!$user || !isset($user->id)) {
                return $next($request);
            }

            if (!Schema::hasColumn('users', 'role')) {
                return $next($request);
            }

            $uid = (int) $user->id;
            $tid = (int) $tenantId;

            $already = DB::table('coreauth_role_user')->where('user_id', $uid)->where('tenant_id', $tid)->exists();
            if ($already) {
                return $next($request);
            }

            $legacyRole = is_numeric($user->role ?? null) ? (int) $user->role : null;

            $roleSlug = match ($legacyRole) {
                0, 1, 3 => 'tenant_admin',
                2 => 'viewer',
                default => 'viewer',
            };

            DB::table('coreauth_role_user')->updateOrInsert(
                ['user_id' => $uid, 'tenant_id' => $tid, 'role_slug' => $roleSlug],
                []
            );
        } catch (\Throwable $e) {
        }

        return $next($request);
    }
}

