<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Dapunjabi\CoreAuth\Models\Tenant;

class TenantController extends Controller
{
    public function select()
    {
        if (!Auth::check()) return redirect()->route('login');
        $userId = Auth::id();

        $isSuperAdmin =
            (Auth::user()?->email === config('coreauth.superadmin.email')) ||
            DB::table('coreauth_role_user')->where('user_id', $userId)->where('role_slug', 'superadmin')->exists();

        if ($isSuperAdmin) {
            // Prefer TenancyAdapter tenants if present, and mirror them into CoreAuth tenants table.
            try {
                if (Schema::hasTable('tenants') && Schema::hasTable('coreauth_tenants')) {
                    $rows = DB::table('tenants')->select('id', 'name', 'slug')->orderBy('id')->get();
                    foreach ($rows as $r) {
                        $id = (int) $r->id;
                        $payload = ['name' => (string) $r->name, 'slug' => (string) $r->slug];
                        $exists = DB::table('coreauth_tenants')->where('id', $id)->exists();
                        if ($exists) {
                            DB::table('coreauth_tenants')->where('id', $id)->update($payload);
                        } else {
                            DB::table('coreauth_tenants')->insert($payload + [
                                'id' => $id,
                                'license_status' => 'active',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } catch (\Throwable $e) {}

            $tenants = Tenant::query()->orderBy('name')->get();
            return view('coreauth::tenant.select', ['tenants' => $tenants]);
        }

        // Prefer explicit tenant assignments if present, but fall back to role assignments.
        $tenantIds = collect();
        if (Schema::hasTable('coreauth_tenant_user')) {
            $tenantIds = DB::table('coreauth_tenant_user')->where('user_id', $userId)->pluck('tenant_id');
        }
        if ($tenantIds->isEmpty() && Schema::hasTable('coreauth_role_user')) {
            $tenantIds = DB::table('coreauth_role_user')->where('user_id', $userId)->distinct()->pluck('tenant_id');
        }

        $tenants = Tenant::query()->whereIn('id', $tenantIds)->orderBy('name')->get();
        return view('coreauth::tenant.select', ['tenants' => $tenants]);
    }

    public function set(Request $request, TenantManager $tm)
    {
        $request->validate(['tenant_id' => ['required', 'integer']]);

        if (!Auth::check()) return redirect()->route('login');
        $userId = Auth::id();
        $tenantId = (int) $request->tenant_id;

        $isSuperAdmin =
            (Auth::user()?->email === config('coreauth.superadmin.email')) ||
            DB::table('coreauth_role_user')->where('user_id', $userId)->where('role_slug', 'superadmin')->exists();

        if (!$isSuperAdmin) {
            $allowedTenantIds = collect();
            if (Schema::hasTable('coreauth_tenant_user')) {
                $allowedTenantIds = DB::table('coreauth_tenant_user')->where('user_id', $userId)->pluck('tenant_id');
            }
            if ($allowedTenantIds->isEmpty() && Schema::hasTable('coreauth_role_user')) {
                $allowedTenantIds = DB::table('coreauth_role_user')->where('user_id', $userId)->distinct()->pluck('tenant_id');
            }
            if (!$allowedTenantIds->contains($tenantId)) {
                return back()->withErrors(['tenant_id' => 'You are not assigned to this tenant.']);
            }
        }

        if ($tm->setById($tenantId)) {
            return redirect()->route('dashboard')->with('status', 'Tenant selected');
        }
        return back()->withErrors(['tenant' => 'Invalid tenant']);
    }
}
