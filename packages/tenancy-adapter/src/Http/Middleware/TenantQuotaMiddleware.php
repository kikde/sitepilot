<?php

namespace Dapunjabi\TenancyAdapter\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantQuotaMiddleware
{
    public function handle(Request $request, Closure $next, string $quotaKey = 'storage_quota_mb')
    {
        $tenant = currentTenant();
        if (! $tenant) {
            return $next($request);
        }

        $quotaMb = (int) data_get($tenant, 'settings.quotas.'.$quotaKey, 0);
        if ($quotaMb <= 0) {
            // No quota configured -> allow
            return $next($request);
        }

        $currentMb = (int) (tenant_storage_usage_mb($tenant) ?? 0);

        // If uploading a file, include its size in the check
        $incomingBytes = 0;
        foreach ($request->allFiles() as $file) {
            if (is_array($file)) {
                foreach ($file as $f) { $incomingBytes += $f->getSize(); }
            } else {
                $incomingBytes += $file->getSize();
            }
        }
        $incomingMb = $incomingBytes > 0 ? ($incomingBytes / 1024 / 1024) : 0;

        if ($currentMb + $incomingMb > $quotaMb) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Storage quota exceeded',
                    'quota_mb' => $quotaMb,
                    'used_mb' => round($currentMb, 2),
                ], 413);
            }
            return response()->view('tenancy::tenant.quota_exceeded', [
                'tenant' => $tenant,
                'quota_mb' => $quotaMb,
                'used_mb' => round($currentMb, 2),
            ], 413);
        }

        return $next($request);
    }
}

