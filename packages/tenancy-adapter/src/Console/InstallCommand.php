<?php

namespace Dapunjabi\TenancyAdapter\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'tenancy:install';
    protected $description = 'Install Tenancy-Adapter: publish config, run migrations, seed default tenants';

    public function handle(): int
    {
        $this->info('Publishing tenancy config and migrations...');
        Artisan::call('vendor:publish', ['--tag' => 'tenancy-config', '--force' => true]);
        Artisan::call('vendor:publish', ['--tag' => 'tenancy-migrations', '--force' => true]);
        $this->output->write(Artisan::output());

        $this->info('Running migrations (package path)...');
        Artisan::call('migrate', ['--path' => 'packages/tenancy-adapter/src/Migrations', '--force' => true]);
        $this->output->write(Artisan::output());

        $this->info('Seeding default tenants...');
        try {
            Artisan::call('db:seed', ['--class' => \Dapunjabi\TenancyAdapter\Database\Seeders\TenancySeeder::class]);
            $this->output->write(Artisan::output());
        } catch (\Throwable $e) {
            $this->warn('Seeder failed: '.$e->getMessage());
        }

        $this->info('Tenancy-Adapter installation complete.');
        return self::SUCCESS;
    }
}
