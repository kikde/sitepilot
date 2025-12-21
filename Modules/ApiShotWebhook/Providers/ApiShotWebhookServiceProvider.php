<?php

namespace Modules\ApiShotWebhook\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\ApiShotWebhook\Services\ApishotClient;
use Modules\ApiShotWebhook\Services\SnapshotService;

class ApiShotWebhookServiceProvider extends ServiceProvider
{
    /**
     * Register bindings and merge config.
     */
    public function register(): void
    {
        // Merge module config → available via config('apishot.*')
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'apishot');

        // Bind services as singletons
        $this->app->singleton(ApishotClient::class, fn () => new ApishotClient());

        $this->app->singleton(SnapshotService::class, fn ($app) => new SnapshotService(
            $app->make(ApishotClient::class)
        ));
    }

    /**
     * Boot routes, migrations, and publishables.
     */
    public function boot(): void
    {
        $modulePath = __DIR__ . '/../';

        // API routes (existing)
        $this->loadRoutesFrom($modulePath . 'Routes/api.php');

        // (Optional) signed web routes, if you added web.php
        if (file_exists($modulePath . 'Routes/web.php')) {
            $this->loadRoutesFrom($modulePath . 'Routes/web.php');
        }

        // Migrations
        $this->loadMigrationsFrom($modulePath . 'Database/Migrations');

        // Allow publishing config to /config/apishot.php for overrides
        $this->publishes([
            $modulePath . 'Config/config.php' => config_path('apishot.php'),
        ], 'config');
    }
}
