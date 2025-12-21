<?php

namespace Dapunjabi\CoreAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Dapunjabi\CoreAuth\Console\InstallCommand;
use Dapunjabi\CoreAuth\Console\SeedCommand;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Dapunjabi\CoreAuth\Support\AdminNavRegistry;

class CoreAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/coreauth.php', 'coreauth');
        $this->app->singleton(TenantManager::class, function ($app) {
            return new TenantManager($app['request']);
        });
        $this->app->singleton(AdminNavRegistry::class, function () {
            return new AdminNavRegistry();
        });
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'coreauth');
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');

        $this->publishes([
            __DIR__.'/../config/coreauth.php' => config_path('coreauth.php'),
        ], 'coreauth-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/coreauth'),
        ], 'coreauth-views');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/coreauth'),
        ], 'coreauth-assets');

        $this->publishes([
            __DIR__.'/../Migrations' => database_path('migrations'),
        ], 'coreauth-migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                SeedCommand::class,
            ]);
        }

        // Route middleware aliases
        $router = $this->app['router'];
        $router->aliasMiddleware('tenant', \Dapunjabi\CoreAuth\Http\Middleware\ResolveTenant::class);
        $router->aliasMiddleware('permission', \Dapunjabi\CoreAuth\Http\Middleware\RequirePermission::class);
        $router->aliasMiddleware('license', \Dapunjabi\CoreAuth\Http\Middleware\RequireActiveLicense::class);
        $router->aliasMiddleware('platform', \Dapunjabi\CoreAuth\Http\Middleware\RequirePlatformAdmin::class);
        $router->pushMiddlewareToGroup('web', \Dapunjabi\CoreAuth\Http\Middleware\LogSession::class);
        $router->pushMiddlewareToGroup('web', \Dapunjabi\CoreAuth\Http\Middleware\SyncLegacyRole::class);
        $router->pushMiddlewareToGroup('web', \Dapunjabi\CoreAuth\Http\Middleware\EnsureTenantSeedData::class);

        // Default navigation (packages can extend this registry).
        try {
            $nav = $this->app->make(AdminNavRegistry::class);
            $nav->section('main', 'Main', 10)
                ->add('main', ['label' => 'Dashboard', 'icon' => 'home', 'route' => 'dashboard', 'order' => 10])
                ->add('main', ['label' => 'Tenant Selector', 'icon' => 'layers', 'route' => 'tenant.select', 'order' => 20]);

            $nav->section('security', 'Security', 80)
                ->add('security', ['label' => 'Roles', 'icon' => 'shield', 'route' => 'admin.roles', 'permission' => 'manage-roles', 'order' => 10])
                ->add('security', ['label' => 'Permissions', 'icon' => 'key', 'route' => 'admin.permissions', 'permission' => 'manage-permissions', 'order' => 20])
                ->add('security', ['label' => 'Profile', 'icon' => 'user', 'route' => 'account.profile', 'order' => 90])
                ->add('security', ['label' => 'Sessions', 'icon' => 'clock', 'route' => 'account.sessions', 'order' => 95]);

            $nav->section('platform', 'Platform', 5)
                ->add('platform', ['label' => 'Platform Dashboard', 'icon' => 'grid', 'route' => 'platform.dashboard', 'platform' => true, 'order' => 5])
                ->add('platform', ['label' => 'Tenants', 'icon' => 'globe', 'route' => 'tenancy.admin.tenants.index', 'platform' => true, 'order' => 10])
                ->add('platform', ['label' => 'Billing Admin', 'icon' => 'credit-card', 'route' => 'billing.admin.invoices', 'platform' => true, 'order' => 20])
                ->add('platform', ['label' => 'Webhooks', 'icon' => 'activity', 'route' => 'billing.admin.webhooks', 'platform' => true, 'order' => 30]);
        } catch (\Throwable $e) {}

        // Ensure default roles/permissions exist for plugin modules (safe upsert).
        try {
            if (Schema::hasTable('coreauth_roles') && Schema::hasTable('coreauth_permissions')) {
                $roles = [
                    ['slug' => 'superadmin', 'name' => 'Super Admin'],
                    ['slug' => 'tenant_admin', 'name' => 'Tenant Admin'],
                    ['slug' => 'admin', 'name' => 'Admin'],
                    ['slug' => 'editor', 'name' => 'Editor'],
                    ['slug' => 'viewer', 'name' => 'Viewer'],
                ];
                foreach ($roles as $r) {
                    DB::table('coreauth_roles')->updateOrInsert(['slug' => $r['slug']], ['name' => $r['name']]);
                }

                $perms = [
                    ['slug' => 'view-dashboard', 'name' => 'View Dashboard'],
                    ['slug' => 'manage-roles', 'name' => 'Manage Roles'],
                    ['slug' => 'manage-permissions', 'name' => 'Manage Permissions'],
                    ['slug' => 'media.manage', 'name' => 'Manage Media Library'],
                    ['slug' => 'ui.manage', 'name' => 'Manage UI Builder'],
                    ['slug' => 'content.manage', 'name' => 'Manage Website Content'],
                ];
                foreach ($perms as $p) {
                    DB::table('coreauth_permissions')->updateOrInsert(['slug' => $p['slug']], ['name' => $p['name']]);
                }

                if (Schema::hasTable('coreauth_permission_role')) {
                    $map = [
                        'admin' => ['view-dashboard','manage-roles','manage-permissions','media.manage','ui.manage','content.manage'],
                        'tenant_admin' => ['view-dashboard','manage-roles','manage-permissions','media.manage','ui.manage','content.manage'],
                        'editor' => ['view-dashboard','ui.manage','content.manage'],
                        'viewer' => ['view-dashboard'],
                    ];
                    foreach ($map as $role => $permSlugs) {
                        foreach ($permSlugs as $perm) {
                            DB::table('coreauth_permission_role')->updateOrInsert([
                                'role_slug' => $role,
                                'permission_slug' => $perm,
                            ], []);
                        }
                    }
                }
            }
        } catch (\Throwable $e) {}

        // Keep CoreAuth tenant license_status in sync with Billing Subscriptions events.
        try {
            if (class_exists(\Dapunabi\Billing\Events\SubscriptionStatusChanged::class)) {
                Event::listen(\Dapunabi\Billing\Events\SubscriptionStatusChanged::class, function ($event) {
                    try {
                        $tenantId = (int) ($event->tenantId ?? 0);
                        if (!$tenantId) return;
                        if (!Schema::hasTable('coreauth_tenants')) return;
                        $new = (string) ($event->newStatus ?? 'active');
                        $mapped = match ($new) {
                            'active', 'trialing' => 'active',
                            'past_due' => 'past_due',
                            default => 'suspended',
                        };
                        DB::table('coreauth_tenants')->where('id', $tenantId)->update([
                            'license_status' => $mapped,
                            'updated_at' => now(),
                        ]);
                    } catch (\Throwable $e) {}
                });
            }
        } catch (\Throwable $e) {}
    }
}


