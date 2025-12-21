<?php

namespace Dapunjabi\TenancyAdapter\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Dapunjabi\TenancyAdapter\Models\Tenant;
use Dapunjabi\TenancyAdapter\Database\TenancyConnectionResolver;

class MigrateTenantCommand extends Command
{
    protected $signature = 'tenancy:migrate-tenant {tenant : Tenant ID or slug} {--dry-run}';
    protected $description = 'Prepare to run migrations for a specific tenant (dry-run stub)';

    public function handle(TenancyConnectionResolver $resolver): int
    {
        $identifier = $this->argument('tenant');
        $tenant = is_numeric($identifier)
            ? Tenant::withoutGlobalScopes()->find($identifier)
            : Tenant::withoutGlobalScopes()->where('slug', $identifier)->first();

        if (! $tenant) {
            $this->error('Tenant not found: '.$identifier);
            return self::FAILURE;
        }

        $conn = $resolver->resolveConnectionName($tenant);
        $this->info("[Dry-Run] Preparing migrations for tenant '{$tenant->name}' (#{$tenant->id})");
        $this->line("• Connection name: {$conn}");

        $cfg = Config::get('database.connections.'.$conn, []);
        $dsn = $this->formatConnectionPreview($cfg);
        $this->line("• Connection preview: {$dsn}");

        $this->line('• Migrations path (package): packages/tenancy-adapter/src/Migrations');
        $this->line('• Command to execute (future): php artisan migrate --database='.$conn.' --path=packages/tenancy-adapter/src/Migrations');

        if ($this->option('dry-run')) {
            $this->info('Dry-run completed. No migrations executed.');
            return self::SUCCESS;
        }

        $this->warn('Actual per-tenant migrations are not implemented yet. Re-run with --dry-run.');
        return self::SUCCESS;
    }

    protected function formatConnectionPreview(array $cfg): string
    {
        $driver = $cfg['driver'] ?? 'unknown';
        if ($driver === 'sqlite') {
            return 'sqlite:'.($cfg['database'] ?? '');
        }
        $host = $cfg['host'] ?? '127.0.0.1';
        $db = $cfg['database'] ?? '';
        $user = $cfg['username'] ?? '';
        return sprintf('%s://%s@%s/%s', $driver, $user, $host, $db);
    }
}

