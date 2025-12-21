<?php

namespace Dapunabi\UiTemplate;

use Illuminate\Support\ServiceProvider;

class UiTemplateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/ui-template.php', 'ui-template');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'uitpl');

        $this->publishes([
            __DIR__.'/config/ui-template.php' => config_path('ui-template.php'),
        ], 'ui-template-config');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/uitpl'),
        ], 'ui-template-views');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Dapunabi\UiTemplate\Console\InstallCommand::class,
                \Dapunabi\UiTemplate\Console\ExportCommand::class,
                \Dapunabi\UiTemplate\Console\ExportTemplateCommand::class,
                \Dapunabi\UiTemplate\Console\ImportTemplateCommand::class,
                \Dapunabi\UiTemplate\Console\GenerateSitemapCommand::class,
                \Dapunabi\UiTemplate\Console\PostUpdateCommand::class,
            ]);
        }
        

        // Register BlockRegistry as a singleton
        $this->app->singleton(\Dapunabi\UiTemplate\Services\BlockRegistry::class, function () {
            $reg = new \Dapunabi\UiTemplate\Services\BlockRegistry();
            $reg->load();
            return $reg;
        });
        $this->app->singleton(\Dapunabi\UiTemplate\Services\TemplateRenderer::class, function ($app) {
            return new \Dapunabi\UiTemplate\Services\TemplateRenderer(
                $app->make(\Dapunabi\UiTemplate\Services\Renderer::class),
                $app->make(\Dapunabi\UiTemplate\Services\BlockRegistry::class),
            );
        });

        // Shortcode services
        $this->app->singleton(\Dapunabi\UiTemplate\Services\Shortcode\ShortcodeRegistry::class, function () {
            $r = new \Dapunabi\UiTemplate\Services\Shortcode\ShortcodeRegistry();
            // Core shortcodes
            $r->register('cta', new \Dapunabi\UiTemplate\Services\Shortcode\Handlers\CTAHandler());
            $r->register('latest_posts', new \Dapunabi\UiTemplate\Services\Shortcode\Handlers\LatestPostsHandler());
            $r->register('form', new \Dapunabi\UiTemplate\Services\Shortcode\Handlers\FormHandler());
            // DB-registered shortcodes with handler class
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('ui_shortcodes')) {
                    foreach (\Dapunabi\UiTemplate\Models\Shortcode::where('active', true)->get() as $row) {
                        $cls = $row->handler;
                        if ($cls && class_exists($cls)) {
                            $inst = app($cls);
                            if ($inst instanceof \Dapunabi\UiTemplate\Services\Shortcode\ShortcodeInterface) {
                                $r->register($row->code, $inst);
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {}
            return $r;
        });
        $this->app->singleton(\Dapunabi\UiTemplate\Services\Shortcode\ShortcodeParser::class, function ($app) {
            return new \Dapunabi\UiTemplate\Services\Shortcode\ShortcodeParser(
                $app->make(\Dapunabi\UiTemplate\Services\Shortcode\ShortcodeRegistry::class)
            );
        });

        // Renderer
        $this->app->singleton(\Dapunabi\UiTemplate\Services\Renderer::class, function ($app) {
            return new \Dapunabi\UiTemplate\Services\Renderer(
                $app->make(\Dapunabi\UiTemplate\Services\BlockRegistry::class),
                $app->make(\Dapunabi\UiTemplate\Services\Shortcode\ShortcodeParser::class)
            );
        });

        // Middleware alias
        $router = $this->app['router'];
        $router->aliasMiddleware('uitpl.can', \Dapunabi\UiTemplate\Http\Middleware\EnsureUiPermission::class);
    }
}








