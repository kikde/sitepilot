<?php

namespace Dapunjabi\TenancyAdapter\Console;

use Illuminate\Console\Command;
use Dapunjabi\TenancyAdapter\Models\Tenant;

class ListTenantsCommand extends Command
{
    protected $signature = 'tenancy:list {--status=}';
    protected $description = 'List tenants with status, slug, and id';

    public function handle(): int
    {
        $status = $this->option('status');
        $query = Tenant::query()->orderBy('name');
        if ($status) {
            $query->where('status', $status);
        }
        $rows = $query->get(['id','name','slug','status'])->map(function ($t) {
            return [
                'ID' => $t->id,
                'Name' => $t->name,
                'Slug' => $t->slug,
                'Status' => $t->status ?? 'active',
            ];
        })->toArray();

        if (empty($rows)) {
            $this->info('No tenants found.');
            return self::SUCCESS;
        }

        $this->table(array_keys($rows[0]), $rows);
        return self::SUCCESS;
    }
}

