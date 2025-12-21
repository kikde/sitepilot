<?php

namespace Dapunabi\Billing\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dapunabi\Billing\Models\Subscription;

class CheckPastDueCommand extends Command
{
    protected $signature = 'billing:check-past-due {--dry-run}';
    protected $description = 'Auto-suspend tenants whose invoices are past grace period';

    public function handle(): int
    {
        $grace = (int) config('billing.grace_period_days', 7);
        $suspend = (bool) config('billing.suspend_after_grace', true);
        $cutoff = Carbon::now()->subDays($grace);
        $dry = (bool) $this->option('dry-run');

        // Find tenants with unpaid invoices older than grace
        $rows = DB::table('billing_invoices')
            ->select('tenant_id', DB::raw('COUNT(*) as cnt'))
            ->where('status', '!=', 'paid')
            ->where(function ($q) use ($cutoff) {
                $q->whereDate('due_date', '<=', $cutoff->toDateString())
                  ->orWhere('created_at', '<=', $cutoff);
            })
            ->groupBy('tenant_id')
            ->get();

        if ($rows->isEmpty()) {
            $this->info('No overdue tenants beyond grace period.');
            return self::SUCCESS;
        }

        foreach ($rows as $row) {
            $tenantId = (int) $row->tenant_id;
            if (! $tenantId) continue;

            $this->line("Tenant {$tenantId} overdue invoices: {$row->cnt}");

            if ($dry) continue;

            // Update subscriptions to suspended when currently past_due
            $subs = Subscription::where('tenant_id', $tenantId)->get();
            foreach ($subs as $sub) {
                $old = $sub->status;
                if ($old !== 'suspended' && $suspend) {
                    $sub->status = 'suspended';
                    $sub->save();
                    event(new \Dapunabi\Billing\Events\SubscriptionStatusChanged($tenantId, $sub->plan_code, $old, 'suspended', 'auto-suspend'));                    
                }
            }

            // Update host systems: CoreAuth license and Tenancy-Adapter status if present
            try {
                if (DB::getSchemaBuilder()->hasTable('coreauth_tenants')) {
                    DB::table('coreauth_tenants')->where('id', $tenantId)->update(['license_status' => 'suspended', 'updated_at' => now()]);
                }
            } catch (\Throwable $e) {}
            try {
                if (DB::getSchemaBuilder()->hasTable('tenants')) {
                    DB::table('tenants')->where('id', $tenantId)->update(['status' => 'suspended', 'updated_at' => now()]);
                }
            } catch (\Throwable $e) {}
        }

        $this->info('Check complete.');
        return self::SUCCESS;
    }
}

