<?php

namespace Dapunabi\Billing\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'billing:install';
    protected $description = 'Install Billing-Subscriptions: publish config, run migrations, seed plans';

    public function handle(): int
    {
        $this->info('Publishing config...');
        $this->call('vendor:publish', ['--tag' => 'billing-config', '--force' => true]);

        $this->info('Running migrations...');
        $this->call('migrate', [
            '--path' => 'packages/dapunabi/billing-subscriptions/src/Migrations',
            '--force' => true,
        ]);

        $this->info('Seeding sample plans and subscriptions...');
        try {
            Artisan::call('db:seed', ['--class' => \Dapunabi\Billing\Database\Seeders\BillingSeeder::class]);
        } catch (\Throwable $e) {
            $this->warn('Seeder failed: '.$e->getMessage());
        }

        $this->info('Billing-Subscriptions installed.');
        return self::SUCCESS;
    }
}

