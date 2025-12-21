<?php

namespace Dapunjabi\TenancyAdapter\Console;

use Illuminate\Console\Command;
use Dapunjabi\TenancyAdapter\Models\TenantDomain;
use Dapunjabi\TenancyAdapter\Events\TenantDomainVerified;

class VerifyDomainsCommand extends Command
{
    protected $signature = 'tenancy:verify-domains {--domain=} {--simulate}';
    protected $description = 'Verify pending tenant domains (simulation for local development)';

    public function handle(): int
    {
        $domain = $this->option('domain');
        $simulate = (bool) $this->option('simulate');

        $query = TenantDomain::query()->where('status', 'pending');
        if ($domain) {
            $query->where('domain', $domain);
        }

        $count = 0;
        foreach ($query->cursor() as $record) {
            if ($simulate) {
                $record->markVerified();
                event(new TenantDomainVerified($record));
                $this->info("Verified: {$record->domain} (tenant #{$record->tenant_id})");
                $count++;
            } else {
                $this->warn("Real verification not implemented. Re-run with --simulate or specify --domain.");
                break;
            }
        }

        $this->info("Processed {$count} domain(s).");
        return self::SUCCESS;
    }
}

