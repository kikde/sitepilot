<?php

namespace Dapunjabi\TenancyAdapter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Dapunjabi\TenancyAdapter\Models\Tenant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class TenantAdminController extends Controller
{
    public function index()
    {
        $tenants = Tenant::query()->orderBy('name')->get();
        return view('tenancy::admin.tenants.index', compact('tenants'));
    }

    public function show($id)
    {
        $tenant = Tenant::withoutGlobalScopes()->with('domains')->findOrFail($id);
        $usersCount = $this->resolveUsersCount($tenant);
        $settings = $tenant->settings ?? [];
        $theme = $settings['theme'] ?? [];
        return view('tenancy::admin.tenants.show', compact('tenant', 'usersCount', 'theme'));
    }

    public function create()
    {
        return view('tenancy::admin.tenants.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tenants,slug',
        ]);

        $slug = $data['slug'] ?? Str::slug($data['name']);

        $tenant = Tenant::create([
            'name' => $data['name'],
            'slug' => $slug,
            'settings' => [
                'theme' => [
                    'primary' => '#3b82f6',
                    'accent' => '#f59e0b',
                ],
            ],
        ]);

        return redirect()->route('tenancy.admin.tenants.index')
            ->with('status', "Tenant '{$tenant->name}' created.");
    }

    public function domains($id)
    {
        $tenant = Tenant::withoutGlobalScopes()->findOrFail($id);
        $domains = $tenant->domains()->orderByDesc('verified_at')->get();
        return view('tenancy::admin.tenants.domains', compact('tenant', 'domains'));
    }

    public function addDomain($id, Request $request)
    {
        $tenant = Tenant::withoutGlobalScopes()->findOrFail($id);
        $data = $request->validate([
            'domain' => 'required|string|max:255|unique:tenant_domains,domain',
        ]);
        $domain = new \Dapunjabi\TenancyAdapter\Models\TenantDomain([
            'domain' => strtolower(trim($data['domain'])),
            'status' => 'pending',
        ]);
        $tenant->domains()->save($domain);
        event(new \Dapunjabi\TenancyAdapter\Events\TenantDomainAdded($domain));

        return redirect()->route('tenancy.admin.tenants.domains', ['id' => $tenant->id])
            ->with('status', 'Domain added. Verification pending.');
    }

    public function updateStatus($id, Request $request)
    {
        $tenant = Tenant::withoutGlobalScopes()->findOrFail($id);
        $data = $request->validate([
            'status' => 'required|in:active,suspended,pending',
        ]);
        $tenant->status = $data['status'];
        $tenant->save();

        return redirect()->route('tenancy.admin.tenants.index')
            ->with('status', "Status for '{$tenant->name}' set to {$tenant->status}.");
    }

    public function theme($id)
    {
        $tenant = Tenant::withoutGlobalScopes()->findOrFail($id);
        $settings = $tenant->settings ?? [];
        $theme = $settings['theme'] ?? [];
        $features = $settings['features'] ?? [];
        return view('tenancy::admin.tenants.theme', compact('tenant', 'theme', 'features'));
    }

    public function updateTheme($id, Request $request)
    {
        $tenant = Tenant::withoutGlobalScopes()->findOrFail($id);

        $data = $request->validate([
            'primary' => 'nullable|string|max:20',
            'logo' => 'nullable|image|max:2048',
            'feature_mfa' => 'nullable|boolean',
            'feature_billing' => 'nullable|boolean',
            'feature_pos' => 'nullable|boolean',
            'feature_ecommerce' => 'nullable|boolean',
            'storage_quota_mb' => 'nullable|integer|min:0',
        ]);

        $settings = $tenant->settings ?? [];
        $settings['theme'] = $settings['theme'] ?? [];
        $settings['features'] = $settings['features'] ?? [];

        if (isset($data['primary'])) {
            $settings['theme']['primary'] = $data['primary'];
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('tenant-logos', 'public');
            $url = Storage::disk('public')->url($path);
            $settings['theme']['logo_url'] = $url;
        }

        $settings['features']['mfa'] = (bool) $request->boolean('feature_mfa');
        $settings['features']['billing'] = (bool) $request->boolean('feature_billing');
        $settings['features']['enable_pos'] = (bool) $request->boolean('feature_pos');
        $settings['features']['enable_ecommerce'] = (bool) $request->boolean('feature_ecommerce');

        $settings['quotas'] = $settings['quotas'] ?? [];
        if (isset($data['storage_quota_mb'])) {
            $settings['quotas']['storage_quota_mb'] = (int) $data['storage_quota_mb'];
        }

        $tenant->settings = $settings;
        $tenant->save();

        $this->invalidateTenantConfigCache($tenant);

        return redirect()->route('tenancy.admin.tenants.theme', ['id' => $tenant->id])
            ->with('status', 'Theme/settings updated.');
    }

    protected function invalidateTenantConfigCache(Tenant $tenant): void
    {
        $hosts = [];
        $hosts[] = request()->getHost();
        foreach ($tenant->domains as $domain) {
            $hosts[] = $domain->domain;
        }
        $hosts[] = 'localhost';
        $hosts[] = '127.0.0.1';
        $hosts[] = $tenant->slug.'.localhost';

        foreach (array_unique(array_filter($hosts)) as $host) {
            Cache::forget('tenancy:config:host:'.$host);
        }
    }

    protected function resolveUsersCount(Tenant $tenant): int|string
    {
        try {
            $userModel = config('auth.providers.users.model', \App\Models\User::class);
            if (! class_exists($userModel)) return 'N/A';

            // If users table has tenant_id, count directly
            if (\Illuminate\Support\Facades\Schema::hasColumn((new $userModel)->getTable(), 'tenant_id')) {
                return $userModel::where('tenant_id', $tenant->id)->count();
            }

            // If CoreAuth pivot exists, count via pivot
            if (\Illuminate\Support\Facades\Schema::hasTable('coreauth_tenant_user')) {
                return \Illuminate\Support\Facades\DB::table('coreauth_tenant_user')->where('tenant_id', $tenant->id)->count();
            }

            return 'N/A';
        } catch (\Throwable $e) {
            return 'N/A';
        }
    }
}
