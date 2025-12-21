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

        // Admin navigation (optional, when CoreAuth is present)
        try {
            if (class_exists(\Dapunjabi\CoreAuth\Support\AdminNavRegistry::class)) {
                $nav = $this->app->make(\Dapunjabi\CoreAuth\Support\AdminNavRegistry::class);
                $nav->section('ngo', 'NGO', 90)
                    ->add('ngo', ['label' => 'Open Website', 'icon' => 'external-link', 'url' => url('/ngo'), 'order' => 10])
                    ->add('ngo', ['label' => 'Pages', 'icon' => 'file-text', 'url' => url('/pages'), 'permission' => 'content.manage', 'order' => 20])
                    ->add('ngo', ['label' => 'News', 'icon' => 'rss', 'url' => url('/newsList'), 'permission' => 'content.manage', 'order' => 30])
                    ->add('ngo', ['label' => 'Donors', 'icon' => 'users', 'url' => url('/donors'), 'permission' => 'content.manage', 'order' => 40])
                    ->add('ngo', ['label' => 'Donations', 'icon' => 'gift', 'url' => url('/donations'), 'permission' => 'content.manage', 'order' => 50])
                    ->add('ngo', ['label' => 'Bank Details', 'icon' => 'lock', 'url' => url('/bank-details'), 'permission' => 'content.manage', 'order' => 60])
                    ->add('ngo', ['label' => 'Testimonials', 'icon' => 'message-circle', 'url' => url('/testimonials'), 'permission' => 'content.manage', 'order' => 70])
                    ->add('ngo', ['label' => 'FAQs', 'icon' => 'help-circle', 'url' => url('/faqs'), 'permission' => 'content.manage', 'order' => 80])
                    ->add('ngo', ['label' => 'Management Team', 'icon' => 'users', 'url' => url('/management-team'), 'permission' => 'content.manage', 'order' => 90])
                    ->add('ngo', ['label' => 'Success Stories', 'icon' => 'star', 'url' => url('/successstory'), 'permission' => 'content.manage', 'order' => 100])
                    ->add('ngo', ['label' => 'Story Categories', 'icon' => 'folder', 'url' => url('/succes-story-category'), 'permission' => 'content.manage', 'order' => 110]);
            }
        } catch (\Throwable $e) {}
    }
}
