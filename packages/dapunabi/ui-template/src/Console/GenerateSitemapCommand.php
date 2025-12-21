<?php

namespace Dapunabi\UiTemplate\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Dapunabi\UiTemplate\Models\Page;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'ui-template:generate-sitemap {--tenant=} {--path=}';
    protected $description = 'Generate sitemap.xml for published pages';

    public function handle(): int
    {
        $tenantOpt = $this->option('tenant');
        $tenantId = $tenantOpt !== null ? (int) $tenantOpt : (function_exists('tenant_id') ? tenant_id() : null);
        $path = (string) ($this->option('path') ?: public_path());
        $base = rtrim((string) config('app.url'), '/');

        $q = Page::query()->where('published', true);
        if ($tenantId) $q->where('tenant_id', $tenantId);
        $pages = $q->orderBy('updated_at','desc')->get(['slug','locale','updated_at']);

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($pages as $p) {
            $loc = $base.'/p/'.urlencode($p->slug);
            if ($p->locale && $p->locale !== 'en') {
                $loc .= '?locale='.urlencode($p->locale);
            }
            $lastmod = optional($p->updated_at)->toAtomString();
            $xml[] = '  <url>';
            $xml[] = '    <loc>'.htmlspecialchars($loc, ENT_XML1).'</loc>';
            if ($lastmod) $xml[] = '    <lastmod>'.$lastmod.'</lastmod>';
            $xml[] = '  </url>';
        }
        $xml[] = '</urlset>';

        File::ensureDirectoryExists($path);
        File::put(rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'sitemap.xml', implode("\n", $xml));
        $this->info('Sitemap generated at: '.rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'sitemap.xml');
        return self::SUCCESS;
    }
}

