<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Dapunjabi\CoreAuth\Models\Invite;
use Dapunjabi\CoreAuth\Models\Role;

class InviteController extends Controller
{
    public function form(TenantManager $tm)
    {
        if (!Auth::check()) return redirect()->route('login');
        $tenant = $tm->current();
        if (!$tenant) return redirect('/tenant/select');
        $roles = Role::query()->orderBy('slug')->get();
        $invites = Invite::query()->where('tenant_id', $tenant->id)->orderByDesc('created_at')->get();
        return view('coreauth::tenant.invite', compact('tenant','roles','invites'));
    }

    public function send(Request $request, TenantManager $tm)
    {
        if (!Auth::check()) return redirect()->route('login');
        $tenant = $tm->current();
        if (!$tenant) return redirect('/tenant/select');

        $data = $request->validate([
            'email' => ['required','email'],
            'role_slug' => ['required','string'],
        ]);

        $token = bin2hex(random_bytes(16));
        Invite::create([
            'token' => $token,
            'tenant_id' => $tenant->id,
            'role_slug' => $data['role_slug'],
            'email' => $data['email'],
            'invited_by' => Auth::id(),
            'expires_at' => now()->addDays(14),
        ]);

        $link = url('/tenant/invite/accept/'.$token);
        return back()->with('status', 'Invite created: '.$link);
    }

    public function showAccept(string $token)
    {
        $invite = Invite::query()->where('token', $token)->firstOrFail();
        return view('coreauth::tenant.invite-accept', ['invite' => $invite]);
    }

    public function accept(Request $request)
    {
        $data = $request->validate(['token' => ['required','string']]);
        $invite = Invite::query()->where('token', $data['token'])->firstOrFail();
        if ($invite->accepted_at) return redirect()->route('dashboard')->with('status', 'Invite already accepted');
        if ($invite->expires_at && now()->greaterThan($invite->expires_at)) return back()->withErrors(['token' => 'Invite expired']);
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Please login to accept invite');
        }
        $user = Auth::user();
        if (strcasecmp($user->email, $invite->email) !== 0) {
            return back()->withErrors(['email' => 'Logged-in user email does not match invite email ('.$invite->email.')']);
        }
        DB::transaction(function () use ($invite, $user) {
            DB::table('coreauth_tenant_user')->updateOrInsert(['tenant_id' => $invite->tenant_id, 'user_id' => $user->id], []);
            DB::table('coreauth_role_user')->updateOrInsert(['tenant_id' => $invite->tenant_id, 'user_id' => $user->id, 'role_slug' => $invite->role_slug], []);
            $invite->accepted_at = now();
            $invite->save();
        });
        session(['tenant_id' => $invite->tenant_id]);
        return redirect()->route('dashboard')->with('status', 'Invite accepted, access granted.');
    }
}

