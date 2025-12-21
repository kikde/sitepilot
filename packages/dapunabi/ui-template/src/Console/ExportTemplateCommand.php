<?php

namespace Dapunabi\UiTemplate\Console;

use Illuminate\Console\Command;
use Dapunabi\UiTemplate\Services\Marketplace\TemplateExporter;

class ExportTemplateCommand extends Command
{
    protected $signature = 'ui-template:export-template {slug} {--tenant=} {--path=}';
    protected $description = 'Export a template bundle (ZIP) by slug';

    public function handle(TemplateExporter $exporter): int
    {
        $slug = (string) $this->argument('slug');
        $tenantOpt = $this->option('tenant');
        $tenantId = $tenantOpt !== null ? (int) $tenantOpt : (function_exists('tenant_id') ? tenant_id() : null);
        $path = (string) ($this->option('path') ?: base_path('export'));
        try {
            $file = $exporter->exportBySlug($slug, $tenantId ? (int)$tenantId : null, $path);
            $this->info('Exported: '.$file);
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }
    }
}

