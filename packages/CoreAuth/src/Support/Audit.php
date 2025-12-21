<?php

namespace Dapunjabi\CoreAuth\Support;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Audit
{
    public static function log(string $action, array $details = [], ?int $userId = null, ?int $actorId = null): void
    {
        try {
            $request = request();
            DB::table('coreauth_audit_logs')->insert([
                'user_id' => $userId ?? (Auth::check() ? Auth::id() : null),
                'actor_id' => $actorId ?? (Auth::check() ? Auth::id() : null),
                'action' => $action,
                'details' => !empty($details) ? json_encode($details) : null,
                'ip' => $request?->ip(),
                'user_agent' => substr((string)($request?->userAgent() ?? ''), 0, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // swallow logging errors
        }
    }
}

