<?php

namespace Dapunabi\Billing;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/billing.php', 'billing');
    }

    public function boot(): void
    {
        // Load package resources
        if (file_exists(__DIR__.'/Routes/web.php')) {
            $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        }
        if (is_dir(__DIR__.'/resources/views')) {
            $this->loadViewsFrom(__DIR__.'/resources/views', 'billing');
        }
        if (is_dir(__DIR__.'/Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/Migrations');
        }

        // Publishes
        $this->publishes([
            __DIR__.'/config/billing.php' => config_path('billing.php'),
        ], 'billing-config');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/billing'),
        ], 'billing-views');

        $this->publishes([
            __DIR__.'/Migrations' => database_path('migrations'),
        ], 'billing-migrations');

        
// Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Dapunabi\Billing\Console\InstallCommand::class,
                \Dapunabi\Billing\Console\CheckPastDueCommand::class,
                \Dapunabi\Billing\Console\PostUpdateCommand::class,
            ]);
        }

// Route middleware alias for seat enforcement
        $router = $this->app['router'];
        if (method_exists($router, 'aliasMiddleware')) {
            $router->aliasMiddleware('seat', \Dapunabi\Billing\Http\Middleware\RequireSeat::class);
        }

        // Admin navigation (optional, when CoreAuth is present)
        try {
            if (class_exists(\Dapunjabi\CoreAuth\Support\AdminNavRegistry::class)) {
                $nav = $this->app->make(\Dapunjabi\CoreAuth\Support\AdminNavRegistry::class);
                $nav->section('billing', 'Billing', 30)
                    ->add('billing', ['label' => 'Billing Portal', 'icon' => 'credit-card', 'route' => 'billing', 'order' => 10])
                    ->add('billing', ['label' => 'Seats', 'icon' => 'users', 'route' => 'billing.seats', 'order' => 20]);

                $nav->section('platform', 'Platform', 5)
                    ->add('platform', ['label' => 'Plans', 'icon' => 'package', 'route' => 'billing.admin.plans', 'platform' => true, 'order' => 25])
                    ->add('platform', ['label' => 'Invoices', 'icon' => 'file-text', 'route' => 'billing.admin.invoices', 'platform' => true, 'order' => 26]);
            }
        } catch (\Throwable $e) {}

        // Schedule auto-suspend checker daily
        $this->app->booted(function () {
            try {
                $schedule = $this->app->make(\Illuminate\Console\Scheduling\Schedule::class);
                $schedule->command('billing:check-past-due')->dailyAt('01:30');
            } catch (\Throwable $e) {
                // ignore if schedule not available
            }
        });
    }
}






