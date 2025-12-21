<?php

namespace Dapunjabi\TenancyAdapter\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class TenantConfigController extends Controller
{
    public function show(Request $request)
    {
        $host = $request->getHost();
        $key = "tenancy:config:host:".$host;

        $payload = Cache::remember($key, now()->addMinutes(5), function () use ($request) {
            $tenant = currentTenant();
            $theme = (array) data_get($tenant, 'settings.theme', []);
            $features = (array) data_get($tenant, 'settings.features', []);

            return [
                'tenant' => $tenant ? [
                    'id' => $tenant->id,
                    'name' => $tenant->name,
                    'slug' => $tenant->slug,
                ] : null,
                'theme' => [
                    'primary' => $theme['primary'] ?? '#3b82f6',
                    'logo_url' => $theme['logo_url'] ?? null,
                ],
                'features' => $features + [
                    'mfa' => false,
                    'billing' => false,
                ],
                'license_status' => 'active',
            ];
        });

        return response()->json($payload);
    }
}

