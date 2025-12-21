<?php

namespace Dapunabi\Billing\Console;

use Illuminate\Console\Command;

class PostUpdateCommand extends Command
{
    protected $signature = 'billing:run-post-update {--no-migrate}';
    protected $description = 'Post-update: publish config, run migrations (optional), clear app caches';

    public function handle(): int
    {
        $this->info('Publishing billing config...');
        $this->call('vendor:publish', ['--tag' => 'billing-config', '--force' => true]);

        if (! $this->option('no-migrate')) {
            $this->info('Running package migrations...');
            $this->call('migrate', [
                '--path' => 'packages/dapunabi/billing-subscriptions/src/Migrations',
                '--force' => true,
            ]);
        }

        $this->info('Clearing caches...');
        $this->call('optimize:clear');

        $this->info('Done.');
        return self::SUCCESS;
    }
}

