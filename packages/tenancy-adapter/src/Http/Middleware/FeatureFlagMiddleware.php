<?php

namespace Dapunjabi\TenancyAdapter\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FeatureFlagMiddleware
{
    public function handle(Request $request, Closure $next, string $flag)
    {
        $tenant = currentTenant();
        if (! $tenant) {
            return $next($request);
        }

        $features = (array) data_get($tenant, 'settings.features', []);

        // Allow both short key and enable_* prefix
        $keys = [$flag, 'enable_'.$flag];
        $enabled = false;
        foreach ($keys as $k) {
            if (array_key_exists($k, $features)) {
                $enabled = (bool) $features[$k];
                break;
            }
        }

        if (! $enabled) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Feature disabled: '.$flag], 403);
            }
            return response()->view('tenancy::tenant.feature_disabled', [
                'tenant' => $tenant,
                'feature' => $flag,
            ], 403);
        }

        return $next($request);
    }
}

