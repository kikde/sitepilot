<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\Totp;

class MfaVerifyController extends Controller
{
    public function show()
    {
        return view('coreauth::mfa.verify');
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'code' => ['required','string'],
        ]);
        $pendingId = $request->session()->get('coreauth.mfa_user_id');
        if (!$pendingId) return redirect()->route('login');
        $userClass = config('auth.providers.users.model') ?? \App\Models\User::class;
        $user = $userClass::find($pendingId);
        if (!$user) return redirect()->route('login');

        // Recovery code support
        $codes = $user->mfa_recovery_codes ? json_decode($user->mfa_recovery_codes, true) : [];
        if (in_array(strtoupper($data['code']), array_map('strtoupper', $codes))) {
            // consume code
            $codes = array_values(array_filter($codes, fn($c) => strtoupper($c) !== strtoupper($data['code'])));
            $user->mfa_recovery_codes = json_encode($codes);
            $user->last_mfa_at = now();
            $user->save();
            Auth::login($user);
            $request->session()->forget('coreauth.mfa_user_id');
            $request->session()->regenerate();
            \Dapunjabi\CoreAuth\Support\Audit::log('mfa_recovery_used', [], $user->getKey());
            return redirect()->intended(route('dashboard'));
        }

        if ($user->mfa_secret && Totp::verify($user->mfa_secret, $data['code'])) {
            $user->last_mfa_at = now();
            $user->save();
            Auth::login($user);
            $request->session()->forget('coreauth.mfa_user_id');
            $request->session()->regenerate();
            \Dapunjabi\CoreAuth\Support\Audit::log('mfa_verified', [], $user->getKey());
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['code' => 'Invalid code']);
    }
}
