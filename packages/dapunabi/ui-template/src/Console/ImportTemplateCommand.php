<?php

namespace Dapunabi\UiTemplate\Console;

use Illuminate\Console\Command;
use Dapunabi\UiTemplate\Services\Marketplace\TemplateImporter;

class ImportTemplateCommand extends Command
{
    protected $signature = 'ui-template:import-template {zip} {--tenant=}';
    protected $description = 'Import a template bundle (ZIP) into current or specified tenant';

    public function handle(TemplateImporter $importer): int
    {
        $zip = (string) $this->argument('zip');
        $tenantOpt = $this->option('tenant');
        $tenantId = $tenantOpt !== null ? (int) $tenantOpt : (function_exists('tenant_id') ? tenant_id() : null);
        try {
            $res = $importer->importZip($zip, $tenantId);
            $this->info('Imported template: '.$res['template']['slug'].' (version '.($res['version'] ?? 'n/a').')');
            $this->line('Blocks: '.implode(', ', $res['blocks']));
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }
    }
}

