<?php

namespace Dapunabi\UiTemplate\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'ui-template:install {--no-seed : Skip seeding starter blocks/templates}';
    protected $description = 'Install UI-Template (publish config/views, migrate, seed starter data)';

    public function handle(): int
    {
        $this->info('Publishing config/views...');
        Artisan::call('vendor:publish', ['--tag' => 'ui-template-config', '--force' => true]);
        Artisan::call('vendor:publish', ['--tag' => 'ui-template-views', '--force' => true]);

        $this->info('Running migrations (package path)...');
        Artisan::call('migrate', ['--path' => 'packages/dapunabi/ui-template/src/Migrations', '--force' => true]);
        $this->line(Artisan::output());

        if (! $this->option('no-seed')) {
            try {
                Artisan::call('db:seed', ['--class' => \Dapunabi\UiTemplate\Database\Seeders\UiTemplateSeeder::class]);
                $this->info('Seeded starter blocks/templates.');
            } catch (\Throwable $e) {
                $this->warn('Seeding failed: '.$e->getMessage());
            }
        }

        $this->info('UI-Template installed.');
        return self::SUCCESS;
    }
}
