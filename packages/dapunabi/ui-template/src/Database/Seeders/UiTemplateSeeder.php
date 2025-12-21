<?php

namespace Dapunabi\UiTemplate\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Dapunabi\UiTemplate\Models\Block;
use Dapunabi\UiTemplate\Models\Template;
use Dapunabi\UiTemplate\Models\TemplateRevision;
use Dapunabi\UiTemplate\Models\Page;
use Dapunabi\UiTemplate\Models\Theme;
use Dapunabi\UiTemplate\Models\Shortcode;

class UiTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $tenantId = null;
        try {
            if (DB::getSchemaBuilder()->hasTable('tenants')) {
                $tenantId = DB::table('tenants')->where('slug','default')->value('id');
            } elseif (DB::getSchemaBuilder()->hasTable('coreauth_tenants')) {
                $tenantId = DB::table('coreauth_tenants')->where('slug','default')->value('id');
            }
        } catch (\Throwable $e) {}

        // Blocks library (starter)
        Block::firstOrCreate([
            'code' => 'hero',
        ], [
            'tenant_id' => $tenantId,
            'name' => 'Hero',
            'schema' => [
                'title' => 'string',
                'subtitle' => 'string',
                'cta_text' => 'string',
                'cta_url' => 'string',
            ],
            'defaults' => [
                'title' => 'Welcome to Your Product',
                'subtitle' => 'Build pages visually with UI-Template',
                'cta_text' => 'Get Started',
                'cta_url' => '/register',
            ],
            'active' => true,
        ]);

        Block::firstOrCreate([
            'code' => 'features',
        ], [
            'tenant_id' => $tenantId,
            'name' => 'Features',
            'schema' => [
                'items' => 'array',
            ],
            'defaults' => [
                'items' => [
                    ['icon' => 'mdi-rocket', 'title' => 'Fast', 'text' => 'Blazing-fast editor'],
                    ['icon' => 'mdi-palette', 'title' => 'Theming', 'text' => 'Vuetify theme tokens'],
                    ['icon' => 'mdi-arrange-bring-forward', 'title' => 'Blocks', 'text' => 'Re-usable blocks library'],
                ],
            ],
            'active' => true,
        ]);

        Block::firstOrCreate([
            'code' => 'footer',
        ], [
            'tenant_id' => $tenantId,
            'name' => 'Footer',
            'schema' => [
                'copyright' => 'string',
            ],
            'defaults' => [
                'copyright' => '© '.date('Y').' Dapunabi',
            ],
            'active' => true,
        ]);

        // Starter template
        $template = Template::firstOrCreate([
            'slug' => 'starter-landing',
        ], [
            'tenant_id' => $tenantId,
            'name' => 'Starter Landing',
            'type' => 'page',
            'data' => [
                'sections' => [
                    ['key' => 'hero-1', 'blocks' => [['code' => 'hero']]],
                    ['key' => 'features-1', 'blocks' => [['code' => 'features']]],
                    ['key' => 'footer-1', 'blocks' => [['code' => 'footer']]],
                ],
            ],
            'meta' => [
                'description' => 'Starter one-page landing',
            ],
            'published' => true,
        ]);

        TemplateRevision::firstOrCreate([
            'template_id' => $template->id,
            'version' => 1,
        ], [
            'tenant_id' => $tenantId,
            'payload' => $template->data ?? [],
        ]);

        // Home page from template
        Page::firstOrCreate([
            'slug' => 'home',
        ], [
            'tenant_id' => $tenantId,
            'title' => 'Home',
            'template_id' => $template->id,
            'data' => null,
            'meta' => ['seo_title' => 'Home'],
            'published' => true,
        ]);

        // Theme tokens
        Theme::updateOrCreate([
            'tenant_id' => $tenantId,
        ], [
            'tokens' => [
                'primary' => '#1976D2',
                'secondary' => '#10b981',
            ],
            'settings' => [
                'font' => 'Inter',
            ],
        ]);

        // Shortcodes registry samples
        Shortcode::firstOrCreate([
            'code' => 'cta',
        ], [
            'handler' => null,
            'description' => 'Call to Action block',
            'schema' => ['id' => 'int', 'text' => 'string', 'url' => 'string'],
            'active' => true,
        ]);

        Shortcode::firstOrCreate([
            'code' => 'gallery',
        ], [
            'handler' => null,
            'description' => 'Image gallery',
            'schema' => ['id' => 'int'],
            'active' => true,
        ]);
    }
}

