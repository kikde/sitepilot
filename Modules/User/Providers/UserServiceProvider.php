<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class UserServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'User';
    protected string $moduleNameLower = 'user';

    public function boot(): void
    {
        // Routes (moved here; delete RouteServiceProvider if you use this)
        $this->mapRoutes();

        // Migrations / Views / Lang / Config
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerViews();
        $this->registerTranslations();
        $this->registerConfig();
    }

    public function register(): void
    {
        //
    }

    protected function mapRoutes(): void
    {
        // web
        Route::middleware('web')
            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
            ->group(module_path($this->moduleName, '/Routes/web.php'));

        // api
        Route::prefix('api')
            ->middleware('api')
            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
            ->group(module_path($this->moduleName, '/Routes/api.php'));
    }

    protected function registerConfig(): void
    {
        $map = [
        // source => [published filename, config key]
        'config.php'   => [$this->moduleNameLower . '.php', $this->moduleNameLower], // -> config('user.*')
        'apishot.php'  => ['apishot.php', 'apishot'],                                // -> config('apishot.*')
    ];

    foreach ($map as $source => [$publishAs, $key]) {
        $sourcePath = module_path($this->moduleName, 'Config/' . $source);
        if (file_exists($sourcePath)) {
            // allow publish/override to /config
            $this->publishes([$sourcePath => config_path($publishAs)], 'config');

            // merge so values are available even if not published
            $this->mergeConfigFrom($sourcePath, $key);
        }
    }
    }

    protected function registerViews(): void
    {
        $viewPath   = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    protected function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'));
        }
    }

    protected function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
