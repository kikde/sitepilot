<?php

namespace Dapunjabi\TenancyAdapter\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Dapunjabi\TenancyAdapter\Models\Tenant;
use Dapunjabi\TenancyAdapter\Models\TenantDomain;

class TenantResolveMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $resolvedVia = null;
        $tenant = null;

        $safeHas = function (string $table): bool {
            try { return Schema::hasTable($table); } catch (\Throwable $e) { return false; }
        };

        // 1) Header: X-Tenant-Slug (configurable)
        $headerName = config('tenancy.resolver.header', 'X-Tenant-Slug');
        $slugFromHeader = $request->header($headerName);
        if ($slugFromHeader && $safeHas('tenants')) {
            try {
                $tenant = Tenant::where('slug', $slugFromHeader)->first();
                $resolvedVia = $tenant ? 'header' : null;
            } catch (\Throwable $e) {
                // ignore DB errors during early boot
            }
        }

        // 2) Exact domain match in tenant_domains (verified only)
        if (! $tenant && $safeHas('tenant_domains')) {
            $host = $request->getHost();
            if ($host) {
                try {
                    $tenant = TenantDomain::where('domain', $host)
                        ->where('status', 'verified')
                        ->first()?->tenant;
                    $resolvedVia = $tenant ? 'domain' : null;
                } catch (\Throwable $e) {
                    // ignore DB errors
                }
            }
        }

        // 3) Subdomain -> slug
        if (! $tenant && $safeHas('tenants')) {
            $host = $request->getHost();
            if ($host && Str::contains($host, '.')) {
                $parts = explode('.', $host);
                $sub = $parts[0] ?? null;
                if ($sub && $sub !== 'www') {
                    try {
                        $tenant = Tenant::where('slug', $sub)->first();
                        $resolvedVia = $tenant ? 'subdomain' : null;
                    } catch (\Throwable $e) {
                        // ignore DB errors
                    }
                }
            }
        }

        // 4) Path-based /{prefix}/{slug}/...
        if (! $tenant && $safeHas('tenants')) {
            $prefix = trim((string) config('tenancy.resolver.path_prefix', 't'), '/');
            $segments = array_values(array_filter(explode('/', $request->path())));
            if (!empty($segments) && ($segments[0] ?? null) === $prefix && isset($segments[1])) {
                try {
                    $tenant = Tenant::where('slug', $segments[1])->first();
                    $resolvedVia = $tenant ? 'path' : null;
                } catch (\Throwable $e) {
                    // ignore DB errors
                }
            }
        }

        // 5) Fallback to default tenant if present
        if (! $tenant && $safeHas('tenants')) {
            try {
                $tenant = Tenant::where('slug', 'default')->first();
                $resolvedVia = $tenant ? 'fallback' : null;
            } catch (\Throwable $e) {
                // ignore DB errors
            }
        }

        // Bind + request attribute
        if ($tenant) {
            app()->instance('currentTenant', $tenant);
            $request->attributes->set('tenant', $tenant);
            $request->attributes->set('tenant_resolved_via', $resolvedVia);
        }

        return $next($request);
    }
}
