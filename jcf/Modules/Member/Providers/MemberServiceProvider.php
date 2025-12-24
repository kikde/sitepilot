<?php

namespace Modules\Member\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MemberServiceProvider extends ServiceProvider
{
    /**
     * Module names.
     */
    protected string $moduleName = 'Member';
    protected string $moduleNameLower = 'member';

    /**
     * Namespace for controllers used in route groups.
     */
    protected string $moduleNamespace = 'Modules\\Member\\Http\\Controllers';

    /**
     * Register bindings/services.
     */
    public function register(): void
    {
        // No separate RouteServiceProvider anymore.
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerConfig();
        $this->registerTranslations();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        $this->mapRoutes(); // <-- load web + api routes
    }

    /**
     * Load module routes (web + api) with proper middleware & namespace.
     */
    protected function mapRoutes(): void
    {
        // WEB routes
        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->moduleNamespace,
        ], function () {
            $web = module_path($this->moduleName, 'Routes/web.php');
            if (file_exists($web)) {
                require $web;
            }
        });

        // API routes
        Route::group([
            'prefix'     => 'api',
            'middleware' => 'api',
            'namespace'  => $this->moduleNamespace,
        ], function () {
            $api = module_path($this->moduleName, 'Routes/api.php');
            if (file_exists($api)) {
                require $api;
            }
        });
    }

    /**
     * Register and merge config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');

        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Load views (publishable + source).
     */
    public function registerViews(): void
    {
        $viewPath   = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower . '-module-views']);

        $paths = [];
        foreach (config('view.paths', []) as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }

        $this->loadViewsFrom(array_merge($paths, [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Load translations (php + json).
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(
                module_path($this->moduleName, 'Resources/lang'),
                $this->moduleNameLower
            );
            $this->loadJsonTranslationsFrom(
                module_path($this->moduleName, 'Resources/lang')
            );
        }
    }

    /**
     * Provided services.
     */
    public function provides(): array
    {
        return [];
    }
}
