<?php

namespace Dapunjabi\CoreAuth\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    public function create()
    {
        return view('coreauth::auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $userClass = config('auth.providers.users.model') ?? User::class;

        /** @var \Illuminate\Database\Eloquent\Model $user */
        $user = $userClass::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Attempt to send verification if the model supports it
        if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}

