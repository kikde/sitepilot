<?php

namespace Dapunjabi\TenancyAdapter\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PostUpdateCommand extends Command
{
    protected $signature = 'tenancy:run-post-update {--publish : Publish package assets (config, views, migrations)} {--force : Overwrite any existing published files}';
    protected $description = 'Run post-update tasks for Tenancy-Adapter: publish assets and clear caches.';

    public function handle(): int
    {
        if ($this->option('publish')) {
            $this->info('Publishing Tenancy-Adapter assets...');
            Artisan::call('vendor:publish', ['--tag' => 'tenancy-config', '--force' => $this->option('force')]);
            $this->output->write(Artisan::output());
            Artisan::call('vendor:publish', ['--tag' => 'tenancy-views', '--force' => $this->option('force')]);
            $this->output->write(Artisan::output());
            Artisan::call('vendor:publish', ['--tag' => 'tenancy-migrations', '--force' => $this->option('force')]);
            $this->output->write(Artisan::output());
        }

        $this->info('Clearing application caches...');
        Artisan::call('optimize:clear');
        $this->output->write(Artisan::output());

        $this->info('Tenancy-Adapter post-update complete.');
        return self::SUCCESS;
    }
}

