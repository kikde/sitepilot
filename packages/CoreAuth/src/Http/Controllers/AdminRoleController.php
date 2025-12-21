<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Dapunjabi\CoreAuth\Models\Role;

class AdminRoleController extends Controller
{
    public function index(TenantManager $tm)
    {
        if (!Auth::check()) return redirect()->route('login');
        $tenant = $tm->current();
        if (!$tenant) return redirect('/tenant/select');
        $roles = Role::query()->orderBy('slug')->get();
        $userIds = DB::table('coreauth_tenant_user')->where('tenant_id', $tenant->id)->pluck('user_id');
        $users = app(config('auth.providers.users.model', \App\Models\User::class))::query()->whereIn('id', $userIds)->get();
        $assignments = DB::table('coreauth_role_user')->where('tenant_id', $tenant->id)->get()->groupBy('user_id');
        return view('coreauth::admin.roles', compact('tenant','roles','users','assignments'));
    }

    public function update(Request $request, TenantManager $tm)
    {
        $tenant = $tm->current();
        if (!$tenant) return redirect('/tenant/select');
        $data = $request->validate([
            'roles' => ['array'],
        ]);
        $rolesByUser = $data['roles'] ?? [];
        DB::transaction(function () use ($rolesByUser, $tenant) {
            DB::table('coreauth_role_user')->where('tenant_id', $tenant->id)->delete();
            foreach ($rolesByUser as $userId => $roleSlugs) {
                foreach ((array)$roleSlugs as $slug) {
                    DB::table('coreauth_role_user')->insert([
                        'tenant_id' => $tenant->id,
                        'user_id' => (int) $userId,
                        'role_slug' => $slug,
                    ]);
                }
            }
        });
        \Dapunjabi\CoreAuth\Support\Audit::log('roles_updated', ['tenant_id' => $tenant->id, 'count' => count($rolesByUser)]);
        return back()->with('status', 'Roles updated');
    }
}
