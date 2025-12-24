<?php

namespace Modules\Birthdays\Providers;

use Illuminate\Support\ServiceProvider;

class BirthdaysServiceProvider extends ServiceProvider
{
    protected $moduleName = 'Birthdays';
    protected $moduleNameLower = 'birthdays';

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

