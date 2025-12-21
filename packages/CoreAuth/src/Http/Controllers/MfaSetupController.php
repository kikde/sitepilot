<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\Totp;

class MfaSetupController extends Controller
{
    public function show(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        $user = Auth::user();
        $secret = $user->mfa_secret ?: Totp::generateSecret();
        $otpauth = Totp::otpauthUrl(config('app.name', 'Laravel'), $user->email, $secret);
        $qr = 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data='.urlencode($otpauth);
        return view('coreauth::mfa.setup', [
            'user' => $user,
            'secret' => $secret,
            'otpauth' => $otpauth,
            'qr' => $qr,
        ]);
    }

    public function enable(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        $user = Auth::user();
        $data = $request->validate([
            'secret' => ['required','string'],
            'code' => ['required','string'],
        ]);
        if (!Totp::verify($data['secret'], $data['code'])) {
            return back()->withErrors(['code' => 'Invalid code']);
        }
        $user->mfa_secret = $data['secret'];
        $user->mfa_enabled = true;
        $user->mfa_recovery_codes = json_encode($this->generateRecoveryCodes());
        $user->last_mfa_at = now();
        $user->save();
        \Dapunjabi\CoreAuth\Support\Audit::log('mfa_enabled', [] , $user->getKey());
        return redirect()->route('account.sessions')->with('status', 'MFA enabled');
    }

    protected function generateRecoveryCodes(int $count = 8): array
    {
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            $codes[] = strtoupper(bin2hex(random_bytes(4)));
        }
        return $codes;
    }
}
