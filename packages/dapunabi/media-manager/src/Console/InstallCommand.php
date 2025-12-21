<?php

namespace Dapunabi\Media\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'media:install {--force : Overwrite any existing files}';
    protected $description = 'Install Media Manager (publish config, run migrations, storage:link)';

    public function handle(): int
    {
        $this->info('Publishing config...');
        $this->call('vendor:publish', [
            '--tag' => 'media-config',
            '--force' => (bool) $this->option('force'),
        ]);

        $this->info('Running migrations (package path)...');
        $this->call('migrate', [
            '--path' => 'packages/dapunabi/media-manager/src/Migrations',
            '--force' => true,
        ]);

        $this->info('Creating storage symlink (if not exists)...');
        $this->call('storage:link');

        $this->info('Media Manager installed.');
        return self::SUCCESS;
    }
}

