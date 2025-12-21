<?php

namespace Dapunjabi\TenancyAdapter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Dapunjabi\TenancyAdapter\Console\InstallCommand;
use Dapunjabi\TenancyAdapter\Console\VerifyDomainsCommand;
use Dapunjabi\TenancyAdapter\Console\ListTenantsCommand;
use Dapunjabi\TenancyAdapter\Console\MigrateTenantCommand;
use Dapunjabi\TenancyAdapter\Http\Middleware\TenantResolveMiddleware;
use Dapunjabi\TenancyAdapter\Http\Middleware\TenantStatusMiddleware;
use Dapunjabi\TenancyAdapter\Http\Middleware\FeatureFlagMiddleware;
use Dapunjabi\TenancyAdapter\Http\Middleware\TenantQuotaMiddleware;
use Dapunjabi\TenancyAdapter\Console\PostUpdateCommand;

class TenancyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/tenancy.php', 'tenancy');

        // Bind default tenancy connection resolver
        $this->app->singleton(\Dapunjabi\TenancyAdapter\Database\TenancyConnectionResolver::class, function () {
            return new \Dapunjabi\TenancyAdapter\Database\DefaultTenancyConnectionResolver();
        });
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        if (file_exists(__DIR__.'/Routes/api.php')) {
            $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        }
        $this->loadViewsFrom(__DIR__.'/resources/views', 'tenancy');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->publishes([
            __DIR__.'/config/tenancy.php' => config_path('tenancy.php'),
        ], 'tenancy-config');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/tenancy'),
        ], 'tenancy-views');

        $this->publishes([
            __DIR__.'/Migrations' => database_path('migrations'),
        ], 'tenancy-migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                VerifyDomainsCommand::class,
                ListTenantsCommand::class,
                MigrateTenantCommand::class,
                PostUpdateCommand::class,
            ]);
        }

        // Ensure tenant resolution runs very early
        $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
        if (method_exists($kernel, 'prependMiddleware')) {
            $kernel->prependMiddleware(TenantResolveMiddleware::class);
        }

        // Add tenant status gate to web/api groups
        $router = $this->app['router'];
        if (method_exists($router, 'pushMiddlewareToGroup')) {
            $router->pushMiddlewareToGroup('web', TenantStatusMiddleware::class);
            $router->pushMiddlewareToGroup('api', TenantStatusMiddleware::class);
        }

        // Aliases for use on routes
        if (method_exists($router, 'aliasMiddleware')) {
            $router->aliasMiddleware('feature', FeatureFlagMiddleware::class);
            $router->aliasMiddleware('quota', TenantQuotaMiddleware::class);
        }

        // Schema macro to add tenant_id column + FK
        if (! Blueprint::hasMacro('tenantId')) {
            Blueprint::macro('tenantId', function () {
                /** @var Blueprint $this */
                if (method_exists($this, 'foreignId')) {
                    $this->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                } else {
                    $this->unsignedBigInteger('tenant_id');
                    $this->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
                }
            });
        }
    }
}



