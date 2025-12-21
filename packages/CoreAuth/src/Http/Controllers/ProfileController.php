<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    public function edit()
    {
        $this->authorizeAccess();
        return view('coreauth::account.profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $this->authorizeAccess();

        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user->name = $validated['name'];
        if ($user->email !== $validated['email']) {
            $user->email = $validated['email'];
            // If app uses email verification, resetting email may require reverification.
            if (property_exists($user, 'email_verified_at')) {
                $user->email_verified_at = null;
            }
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('status', 'Profile updated');
    }

    protected function authorizeAccess(): void
    {
        if (! Auth::check()) {
            abort(302, '', ['Location' => route('login')]);
        }
    }
}

