<?php

namespace Dapunabi\UiTemplate\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Dapunabi\UiTemplate\Models\Page;
use Dapunabi\UiTemplate\Models\Theme;
use Dapunabi\UiTemplate\Services\TemplateRenderer;
use Dapunabi\UiTemplate\Services\ThemeCompiler;

class ExportCommand extends Command
{
    protected $signature = 'ui-template:export {page_slug} {--path=}';
    protected $description = 'Render a page and export it to a static .html file';

    public function handle(TemplateRenderer $tr): int
    {
        $slug = (string) $this->argument('page_slug');
        $path = (string) ($this->option('path') ?: base_path('export'));
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;

        $q = Page::query()->where('slug', $slug);
        if ($tenantId) $q->where('tenant_id', $tenantId);
        $page = $q->first();
        if (! $page) {
            $this->error('Page not found: '.$slug);
            return self::FAILURE;
        }

        $html = $tr->renderCached($page); // use current cached renderer output

        // Compile theme CSS variables
        $tokens = ['primary' => '#1976D2','secondary' => '#10b981'];
        try {
            if ($tenantId) {
                $row = Theme::where('tenant_id', $tenantId)->first();
                if ($row && is_array($row->tokens)) $tokens = array_merge($tokens, $row->tokens);
            }
        } catch (\Throwable $e) {}
        $cssVars = ThemeCompiler::compileCssVariables($tokens);
        $css = '';
        foreach ($cssVars as $k => $v) { $css .= ":root{ {$k}: {$v}; }\n"; }

        $doc = <<<HTML
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$page->title}</title>
    <style>
      body{font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; margin:0; padding:0;}
      {$css}
    </style>
  </head>
  <body>
    {$html}
  </body>
  </html>
HTML;

        File::ensureDirectoryExists($path);
        $file = rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$slug.'.html';
        File::put($file, $doc);
        $this->info('Exported: '.$file);
        return self::SUCCESS;
    }
}

