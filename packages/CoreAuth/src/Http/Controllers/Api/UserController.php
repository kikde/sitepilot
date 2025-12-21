<?php

namespace Dapunjabi\CoreAuth\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Dapunjabi\CoreAuth\Support\TokenManager;
use Dapunjabi\CoreAuth\Support\TenantManager;

class UserController extends Controller
{
    protected function userFromToken(Request $request)
    {
        $token = $request->bearerToken();
        $uid = TokenManager::validate($token);
        if (!$uid) return null;
        $userClass = config('auth.providers.users.model') ?? \App\Models\User::class;
        return $userClass::find($uid);
    }

    public function me(Request $request, TenantManager $tm)
    {
        $user = $this->userFromToken($request);
        if (!$user) return response()->json(['message' => 'Unauthorized'], 401);
        $tenant = $tm->current();
        return response()->json([
            'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
            'tenant' => $tenant ? ['id' => $tenant->id, 'name' => $tenant->name, 'slug' => $tenant->slug, 'license' => $tenant->license_status ?? 'active'] : null,
        ]);
    }

    public function permissions(Request $request, TenantManager $tm)
    {
        $user = $this->userFromToken($request);
        if (!$user) return response()->json(['message' => 'Unauthorized'], 401);
        $tenant = $tm->current();
        $tenantId = $tenant?->id;
        $perms = [];
        if ($tenantId) {
            $roleSlugs = DB::table('coreauth_role_user')->where('user_id', $user->id)->where('tenant_id', $tenantId)->pluck('role_slug')->toArray();
            if (in_array('superadmin', $roleSlugs, true)) {
                $perms = DB::table('coreauth_permissions')->pluck('slug')->toArray();
            } else {
                $perms = DB::table('coreauth_permission_role')->whereIn('role_slug', $roleSlugs)->pluck('permission_slug')->unique()->values()->toArray();
            }
        }
        return response()->json(['permissions' => array_values($perms)]);
    }
}

