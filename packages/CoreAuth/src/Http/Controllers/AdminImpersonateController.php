<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\Audit;

class AdminImpersonateController extends Controller
{
    protected function ensureSuperadmin(): void
    {
        $user = Auth::user();
        if (!$user) abort(403);
        $sup = config('coreauth.superadmin.email');
        if (! $sup || strcasecmp($user->email, $sup) !== 0) {
            abort(403, 'Only superadmin may impersonate.');
        }
    }

    public function index()
    {
        $this->ensureSuperadmin();
        $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;
        $users = $userModel::query()->orderBy('email')->get();
        return view('coreauth::admin.impersonate', compact('users'));
    }

    public function start(Request $request, int $id)
    {
        $this->ensureSuperadmin();
        $adminId = Auth::id();
        $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;
        $target = $userModel::findOrFail($id);
        if ($target->getKey() === $adminId) return back()->with('status', 'Already yourself');
        $request->session()->put('impersonator_id', $adminId);
        Auth::login($target);
        Audit::log('impersonation_start', ['target_id' => $target->getKey(), 'target_email' => $target->email], $target->getKey(), $adminId);
        return redirect()->route('dashboard')->with('status', 'Now impersonating '.$target->email);
    }

    public function stop(Request $request)
    {
        $imp = (int) $request->session()->pull('impersonator_id');
        if ($imp) {
            $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;
            $admin = $userModel::find($imp);
            if ($admin) {
                Audit::log('impersonation_stop', [], $admin->getKey(), $admin->getKey());
                Auth::login($admin);
                return redirect()->route('dashboard')->with('status', 'Stopped impersonation');
            }
        }
        return redirect()->route('login');
    }
}

