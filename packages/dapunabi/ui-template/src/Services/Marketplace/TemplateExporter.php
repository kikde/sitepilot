<?php

namespace Dapunabi\UiTemplate\Services\Marketplace;

use ZipArchive;
use Illuminate\Support\Facades\File;
use Dapunabi\UiTemplate\Models\Template;
use Dapunabi\UiTemplate\Models\Block;
use Dapunabi\UiTemplate\Services\TemplateRepository;

class TemplateExporter
{
    public function __construct(protected TemplateRepository $repo) {}

    public function exportBySlug(string $slug, ?int $tenantId, string $toPath): string
    {
        $template = $this->repo->templateBySlug($slug, $tenantId);
        if (! $template) {
            throw new \RuntimeException('Template not found: '.$slug);
        }

        $bundle = $this->buildBundle($template);

        File::ensureDirectoryExists($toPath);
        $zipFile = rtrim($toPath, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$template->slug.'-template.zip';

        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE|ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException('Unable to create zip: '.$zipFile);
        }
        $zip->addFromString('manifest.json', json_encode($bundle['manifest'], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
        $zip->addFromString('template.json', json_encode($bundle['template'], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
        $zip->addFromString('blocks.json', json_encode($bundle['blocks'], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
        $zip->close();

        return $zipFile;
    }

    protected function buildBundle(Template $template): array
    {
        $version = 1;
        if (is_array($template->meta ?? null) && isset(($template->meta)['version'])) {
            $version = (int) ($template->meta)['version'];
        }
        $codes = $this->extractBlockCodes($template->data ?? []);
        $blocks = Block::whereIn('code', $codes)->orderBy('code')->get()->map(function(Block $b){
            return [
                'code' => $b->code,
                'name' => $b->name,
                'schema' => $b->schema,
                'defaults' => $b->defaults,
                'component' => $b->component,
                'preview' => $b->preview,
                'category' => $b->category,
                'version' => $b->version,
                'meta' => $b->meta,
            ];
        })->values()->all();

        return [
            'manifest' => [
                'type' => 'ui-template',
                'name' => $template->name,
                'slug' => $template->slug,
                'version' => $version,
                'exported_at' => now()->toIso8601String(),
                'blocks' => $codes,
            ],
            'template' => [
                'name' => $template->name,
                'slug' => $template->slug,
                'type' => $template->type,
                'data' => $template->data,
                'meta' => $template->meta,
                'published' => (bool) $template->published,
            ],
            'blocks' => $blocks,
        ];
    }

    protected function extractBlockCodes(array $data): array
    {
        $codes = [];
        $sections = $data['sections'] ?? [];
        foreach ($sections as $section) {
            foreach (($section['blocks'] ?? []) as $b) {
                if (!empty($b['code'])) $codes[] = $b['code'];
                if (!empty($b['key'])) $codes[] = $b['key'];
            }
        }
        return array_values(array_unique($codes));
    }
}

