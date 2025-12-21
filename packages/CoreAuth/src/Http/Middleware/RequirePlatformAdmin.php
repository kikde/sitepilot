<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequirePlatformAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user && $user->email === config('coreauth.superadmin.email')) {
            return $next($request);
        }

        try {
            $isSuper = DB::table('coreauth_role_user')
                ->where('user_id', $user->id)
                ->where('role_slug', 'superadmin')
                ->exists();
            if ($isSuper) {
                return $next($request);
            }
        } catch (\Throwable $e) {
            // If CoreAuth tables are missing, fail closed for safety.
        }

        abort(403, 'Platform access required.');
    }
}

