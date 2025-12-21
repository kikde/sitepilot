<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Models\Permission;
use Dapunjabi\CoreAuth\Models\Role;

class AdminPermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::query()->orderBy('slug')->get();
        $roles = Role::query()->orderBy('slug')->get();
        $matrix = DB::table('coreauth_permission_role')->get()->groupBy('role_slug');
        return view('coreauth::admin.permissions', compact('permissions','roles','matrix'));
    }

    public function update(Request $request)
    {
        $data = $request->validate(['perm' => ['array']]);
        $perm = $data['perm'] ?? [];
        DB::transaction(function () use ($perm) {
            DB::table('coreauth_permission_role')->truncate();
            foreach ($perm as $role => $perms) {
                foreach (array_keys((array)$perms) as $p) {
                    DB::table('coreauth_permission_role')->insert([
                        'role_slug' => $role,
                        'permission_slug' => $p,
                    ]);
                }
            }
        });
        \Dapunjabi\CoreAuth\Support\Audit::log('permissions_updated', ['roles' => array_keys($perm ?? [])]);
        return back()->with('status', 'Permissions updated');
    }
}
