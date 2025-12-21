<?php

namespace Dapunjabi\CoreAuth\Support;

use Illuminate\Support\Facades\DB;

class TokenManager
{
    public static function issue(int $userId, int $ttlMinutes = 60): string
    {
        $token = bin2hex(random_bytes(32));
        DB::table('coreauth_api_tokens')->insert([
            'user_id' => $userId,
            'name' => 'api',
            'token' => $token,
            'abilities' => json_encode(['*']),
            'expires_at' => now()->addMinutes($ttlMinutes),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $token;
    }

    public static function validate(?string $token): ?int
    {
        if (!$token) return null;
        $row = DB::table('coreauth_api_tokens')->where('token', $token)->first();
        if (!$row) return null;
        if ($row->expires_at && now()->greaterThan($row->expires_at)) {
            DB::table('coreauth_api_tokens')->where('id', $row->id)->delete();
            return null;
        }
        DB::table('coreauth_api_tokens')->where('id', $row->id)->update(['last_used_at' => now()]);
        return (int) $row->user_id;
    }

    public static function revoke(string $token): void
    {
        DB::table('coreauth_api_tokens')->where('token', $token)->delete();
    }
}

