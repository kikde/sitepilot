<?php

namespace Dapunabi\UiTemplate\Services\Marketplace;

use ZipArchive;
use Illuminate\Support\Facades\File;
use Dapunabi\UiTemplate\Models\Template;
use Dapunabi\UiTemplate\Models\Block;

class TemplateImporter
{
    public function importZip(string $zipPath, ?int $tenantId = null): array
    {
        if (! file_exists($zipPath)) {
            throw new \RuntimeException('File not found: '.$zipPath);
        }
        $tmpDir = storage_path('app/ui-import-'.uniqid());
        File::ensureDirectoryExists($tmpDir);

        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            throw new \RuntimeException('Unable to open zip: '.$zipPath);
        }
        $zip->extractTo($tmpDir);
        $zip->close();

        $manifest = $this->readJson($tmpDir.'/manifest.json');
        $tpl = $this->readJson($tmpDir.'/template.json');
        $blocks = $this->readJson($tmpDir.'/blocks.json');

        // Import blocks
        $importedBlocks = [];
        foreach (($blocks ?? []) as $b) {
            $rec = Block::updateOrCreate([
                'code' => $b['code'],
                'tenant_id' => $tenantId,
            ], [
                'name' => $b['name'] ?? $b['code'],
                'schema' => $b['schema'] ?? [],
                'defaults' => $b['defaults'] ?? [],
                'component' => $b['component'] ?? null,
                'preview' => $b['preview'] ?? null,
                'category' => $b['category'] ?? null,
                'active' => true,
                'version' => (int) ($b['version'] ?? 1),
                'meta' => array_merge((array)($b['meta'] ?? []), ['source' => 'market']),
            ]);
            $importedBlocks[] = $rec->code;
        }

        // Import template
        $meta = (array) ($tpl['meta'] ?? []);
        if (! empty($manifest['version'])) {
            $meta['version'] = (int) $manifest['version'];
            $meta['market_preview_updated_at'] = now()->toIso8601String();
        }
        $template = Template::updateOrCreate([
            'slug' => $tpl['slug'],
            'tenant_id' => $tenantId,
        ], [
            'name' => $tpl['name'] ?? $tpl['slug'],
            'type' => $tpl['type'] ?? 'page',
            'data' => $tpl['data'] ?? [],
            'meta' => $meta,
            'published' => (bool) ($tpl['published'] ?? false),
        ]);

        File::deleteDirectory($tmpDir);

        return [
            'template' => $template->only(['id','slug','name','tenant_id']),
            'blocks' => $importedBlocks,
            'version' => $meta['version'] ?? null,
        ];
    }

    protected function readJson(string $path): array
    {
        if (! file_exists($path)) return [];
        $json = file_get_contents($path);
        $data = json_decode($json, true);
        return is_array($data) ? $data : [];
    }
}

