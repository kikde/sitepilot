<?php

namespace Dapunjabi\CoreAuth\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function create()
    {
        return view('coreauth::auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = (bool) $request->boolean('remember');

        // Check for MFA requirement before logging in fully
        $userClass = config('auth.providers.users.model') ?? \App\Models\User::class;
        $candidate = $userClass::query()->where('email', $credentials['email'])->first();

        if (! Auth::attempt($credentials, $remember)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }

        // If candidate has MFA enabled, require challenge
        if ($candidate && ($candidate->mfa_enabled ?? false)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            \Dapunjabi\CoreAuth\Support\Audit::log('login_mfa_challenge', ['email' => $candidate->email], $candidate->getKey());
            $request->session()->put('coreauth.mfa_user_id', $candidate->getKey());
            return redirect()->to('/mfa/verify');
        }

        $request->session()->regenerate();
        \Dapunjabi\CoreAuth\Support\Audit::log('login_success', ['email' => $credentials['email']]);
        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
