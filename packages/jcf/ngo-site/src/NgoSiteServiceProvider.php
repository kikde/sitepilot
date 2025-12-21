<?php

namespace Jcf\NgoSite;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NgoSiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/ngo-site.php', 'ngo-site');
    }

    public function boot(): void
    {
        if (! class_exists('SEO')) {
            class_alias(\Jcf\NgoSite\Support\SEO::class, 'SEO');
        }

        $this->publishes([
            __DIR__ . '/config/ngo-site.php' => config_path('ngo-site.php'),
        ], 'ngo-site-config');

        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ngo');

        View::addLocation(__DIR__ . '/resources/views');
    }
}
