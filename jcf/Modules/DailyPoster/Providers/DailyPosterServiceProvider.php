<?php

namespace Modules\DailyPoster\Providers;

use Illuminate\Support\ServiceProvider;

class DailyPosterServiceProvider extends ServiceProvider
{
    protected $moduleName = 'DailyPoster';
    protected $moduleNameLower = 'dailyposter';

    public function boot()
    {
        $this->registerViews();
        $this->app->register(RouteServiceProvider::class);
    }

    public function register() {}

    protected function registerViews()
    {
        $sourcePath = module_path($this->moduleName, 'Resources/views');
        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
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

