<?php

namespace Dapunjabi\CoreAuth\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dapunjabi\CoreAuth\Models\Tenant;

class TenantManager
{
    protected ?Tenant $tenant = null;
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->resolveFromRequest();
    }

    public function current(): ?Tenant
    {
        return $this->tenant;
    }

    public function resolveFromRequest(): void
    {
        // header > session > host
        $header = $this->request->header('X-Tenant');
        if ($header && ($t = Tenant::query()->where('slug', $header)->orWhere('id', $header)->first())) {
            $this->tenant = $t; $this->remember($t); return;
        }
        $sessionId = session('tenant_id');
        if ($sessionId && ($t = Tenant::query()->find($sessionId))) {
            $this->tenant = $t; return;
        }
        // Try subdomain: subdomain.example.com => subdomain (skip if host is IP)
        $host = $this->request->getHost();
        if ($host && !filter_var($host, FILTER_VALIDATE_IP)) {
            $parts = explode('.', $host);
            if (count($parts) >= 3) {
                $sub = $parts[0];
                if ($t = Tenant::query()->where('slug', $sub)->first()) {
                    $this->tenant = $t; $this->remember($t); return;
                }
            }
        }
        $this->tenant = null;
    }

    public function remember(Tenant $tenant): void
    {
        session(['tenant_id' => $tenant->id]);
        $this->tenant = $tenant;
    }

    public function setById(int $tenantId): bool
    {
        $t = Tenant::query()->find($tenantId);
        if ($t) { $this->remember($t); return true; }
        return false;
    }

    public function userRolesForTenant($userId, $tenantId): array
    {
        $rows = DB::table('coreauth_role_user')->where('user_id', $userId)->where('tenant_id', $tenantId)->pluck('role_slug');
        return $rows ? $rows->toArray() : [];
    }

    public function userHasPermission($userId, string $permission, ?int $tenantId = null): bool
    {
        // Superadmin role bypass
        if ($tenantId) {
            $roles = $this->userRolesForTenant($userId, $tenantId);
            if (in_array('superadmin', $roles, true)) return true;
        }

        // direct user permission
        $q = DB::table('coreauth_permission_user')->where('user_id', $userId)->where('permission_slug', $permission);
        if ($tenantId) $q->where(function ($qq) use ($tenantId) { $qq->whereNull('tenant_id')->orWhere('tenant_id', $tenantId); });
        if ($q->exists()) return true;

        // via roles
        $roleSlugs = $tenantId ? $this->userRolesForTenant($userId, $tenantId) : [];
        if (empty($roleSlugs)) return false;
        $count = DB::table('coreauth_permission_role')->whereIn('role_slug', $roleSlugs)->where('permission_slug', $permission)->count();
        return $count > 0;
    }
}
