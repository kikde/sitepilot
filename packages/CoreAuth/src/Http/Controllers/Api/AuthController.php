<?php

namespace Dapunjabi\CoreAuth\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Dapunjabi\CoreAuth\Support\TokenManager;
use Dapunjabi\CoreAuth\Support\Totp;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string'],
            'mfa_code' => ['nullable','string']
        ]);
        $userClass = config('auth.providers.users.model') ?? \App\Models\User::class;
        $user = $userClass::query()->where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        if (($user->mfa_enabled ?? false)) {
            if (empty($data['mfa_code']) || ((!empty($user->mfa_secret) && !Totp::verify($user->mfa_secret, $data['mfa_code']))
                && !in_array(strtoupper($data['mfa_code']), array_map('strtoupper', $user->mfa_recovery_codes ? json_decode($user->mfa_recovery_codes, true) : []), true))) {
                return response()->json(['message' => 'MFA required', 'requires_mfa' => true], 401);
            }
        }
        $token = TokenManager::issue($user->getKey());
        \Dapunjabi\CoreAuth\Support\Audit::log('api_login', ['email' => $user->email], $user->getKey());
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer', 'expires_in' => 3600]);
    }

    public function logout(Request $request)
    {
        $token = self::bearer($request);
        if ($token) TokenManager::revoke($token);
        return response()->json(['message' => 'Logged out']);
    }

    public function refresh(Request $request)
    {
        $token = self::bearer($request);
        $userId = TokenManager::validate($token);
        if (!$userId) return response()->json(['message' => 'Unauthorized'], 401);
        TokenManager::revoke($token);
        $new = TokenManager::issue($userId);
        return response()->json(['access_token' => $new, 'token_type' => 'Bearer', 'expires_in' => 3600]);
    }

    protected static function bearer(Request $request): ?string
    {
        $h = $request->header('Authorization');
        if (!$h) return null;
        if (stripos($h, 'Bearer ') === 0) return trim(substr($h, 7));
        return null;
    }
}

