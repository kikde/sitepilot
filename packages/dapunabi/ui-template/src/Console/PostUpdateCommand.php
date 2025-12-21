<?php

namespace Dapunabi\UiTemplate\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PostUpdateCommand extends Command
{
    protected $signature = 'ui-template:run-post-update {--no-migrate} {--no-publish}';
    protected $description = 'Publish assets/config and refresh caches after updating ui-template';

    public function handle(): int
    {
        if (! $this->option('no-publish')) {
            $this->info('Publishing config and views...');
            Artisan::call('vendor:publish', ['--tag' => 'ui-template-config', '--force' => true]);
            Artisan::call('vendor:publish', ['--tag' => 'ui-template-views', '--force' => true]);
        }
        if (! $this->option('no-migrate')) {
            $this->info('Running package migrations...');
            Artisan::call('migrate', ['--path' => 'packages/dapunabi/ui-template/src/Migrations', '--force' => true]);
        }
        $this->info('Clearing caches...');
        Artisan::call('optimize:clear');
        $this->line(Artisan::output());
        $this->info('ui-template post-update completed.');
        return self::SUCCESS;
    }
}

