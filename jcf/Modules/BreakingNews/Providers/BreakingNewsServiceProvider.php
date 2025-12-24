<?php

namespace Modules\BreakingNews\Providers;

use Illuminate\Support\ServiceProvider;

class BreakingNewsServiceProvider extends ServiceProvider
{
    protected $moduleName = 'BreakingNews';
    protected $moduleNameLower = 'breakingnews';

    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->app->register(RouteServiceProvider::class);
    }

    public function register() {}

    protected function registerConfig()
    {
        if (is_file(module_path($this->moduleName, 'Config/config.php'))){
            $this->mergeConfigFrom(module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower);
        }
    }

    protected function registerViews()
    {
        $sourcePath = module_path($this->moduleName, 'Resources/views');
        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    protected function registerTranslations()
    {
        $langPath = module_path($this->moduleName, 'Resources/lang');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        }
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}

