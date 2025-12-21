<?php

namespace Dapunabi\Media\Console;

use Illuminate\Console\Command;

class PostUpdateCommand extends Command
{
    protected $signature = 'media:run-post-update {--force : Overwrite any existing published files}';
    protected $description = 'Post-update: publish config/views/migrations and clear caches';

    public function handle(): int
    {
        $force = (bool) $this->option('force');
        $this->info('Publishing media-manager assets...');
        $this->call('vendor:publish', ['--tag' => 'media-config', '--force' => $force]);
        $this->call('vendor:publish', ['--tag' => 'media-views', '--force' => $force]);
        $this->call('vendor:publish', ['--tag' => 'media-migrations', '--force' => $force]);

        $this->info('Clearing framework caches...');
        try { $this->call('optimize:clear'); } catch (\Throwable $e) { /* ignore */ }

        $this->info('Done.');
        return self::SUCCESS;
    }
}

