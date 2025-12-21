<?php

namespace Dapunjabi\CoreAuth;

use Illuminate\Support\ServiceProvider;
use Dapunjabi\CoreAuth\Console\InstallCommand;
use Dapunjabi\CoreAuth\Console\SeedCommand;
use Dapunjabi\CoreAuth\Support\TenantManager;

class CoreAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/coreauth.php', 'coreauth');
        $this->app->singleton(TenantManager::class, function ($app) {
            return new TenantManager($app['request']);
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
        $router->pushMiddlewareToGroup('web', \Dapunjabi\CoreAuth\Http\Middleware\LogSession::class);
    }
}


