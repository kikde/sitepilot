<?php

namespace Dapunabi\Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/media-manager.php', 'media-manager');
        // Public API binding
        $this->app->singleton(\Dapunabi\Media\Services\MediaApi::class, fn() => new \Dapunabi\Media\Services\MediaApi());
    }

    public function boot(): void
    {
        if (file_exists(__DIR__.'/Routes/web.php')) {
            $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        }
        if (file_exists(__DIR__.'/Routes/api.php')) {
            $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        }
        if (is_dir(__DIR__.'/resources/views')) {
            $this->loadViewsFrom(__DIR__.'/resources/views', 'media');
        }
        if (is_dir(__DIR__.'/Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/Migrations');
        }

        $this->publishes([
            __DIR__.'/config/media-manager.php' => config_path('media-manager.php'),
        ], 'media-config');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/media'),
        ], 'media-views');

        $this->publishes([
            __DIR__.'/Migrations' => database_path('migrations'),
        ], 'media-migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Dapunabi\Media\Console\InstallCommand::class,
            ]);
        }

        // Additional console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Dapunabi\Media\Console\RecalculateUsageCommand::class,
                \Dapunabi\Media\Console\PruneCommand::class,
                \Dapunabi\Media\Console\PostUpdateCommand::class,
            ]);
        }

        // Admin navigation (optional, when CoreAuth is present)
        try {
            if (class_exists(\Dapunjabi\CoreAuth\Support\AdminNavRegistry::class)) {
                $nav = $this->app->make(\Dapunjabi\CoreAuth\Support\AdminNavRegistry::class);
                $nav->section('builder', 'Builder', 40)
                    ->add('builder', ['label' => 'Media Library', 'icon' => 'image', 'route' => 'media.admin.index', 'permission' => 'media.manage', 'order' => 10]);
            }
        } catch (\Throwable $e) {}
    }
}




