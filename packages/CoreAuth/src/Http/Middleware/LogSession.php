<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogSession
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check()) {
            $sid = $request->session()->getId();
            $userId = Auth::id();
            DB::table('coreauth_sessions')->updateOrInsert(
                ['session_id' => $sid],
                [
                    'user_id' => $userId,
                    'ip' => $request->ip(),
                    'user_agent' => substr((string) $request->userAgent(), 0, 500),
                    'last_activity' => now(),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
        return $response;
    }
}

