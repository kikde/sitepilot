<?php

namespace Dapunabi\UiTemplate\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnsureUiPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->guest(route('login'));
        }

        // Allow all if CoreAuth superadmin
        try {
            $roles = DB::table('coreauth_role_user')
                ->where('user_id', $user->id)
                ->pluck('role_slug')->all();
            if (in_array('superadmin', $roles, true)) {
                return $next($request);
            }
        } catch (\Throwable $e) {
            // If CoreAuth tables not present, allow for development
            return $next($request);
        }

        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $allowed = ['tenant_admin','admin','editor'];

        if ($tenantId) {
            $has = DB::table('coreauth_role_user')
                ->where('user_id', $user->id)
                ->where('tenant_id', $tenantId)
                ->whereIn('role_slug', $allowed)
                ->exists();
            if ($has) return $next($request);
        }

        // Fallback: global role (no tenant)
        $hasGlobal = DB::table('coreauth_role_user')
            ->where('user_id', $user->id)
            ->whereNull('tenant_id')
            ->whereIn('role_slug', $allowed)
            ->exists();
        if ($hasGlobal) return $next($request);

        abort(403, 'UI-Template: insufficient permissions');
    }
}

