<?php

namespace Dapunabi\Billing\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Dapunabi\Billing\Models\Plan;
use Dapunabi\Billing\Models\Subscription;

class BillingSeeder extends Seeder
{
    public function run(): void
    {
        // Seed plans
        $plans = [
            ['code' => 'basic-monthly', 'name' => 'Basic Monthly', 'interval' => 'monthly', 'price' => 19.00, 'seat_limit' => 3],
            ['code' => 'pro-monthly', 'name' => 'Pro Monthly', 'interval' => 'monthly', 'price' => 49.00, 'seat_limit' => 10],
        ];
        foreach ($plans as $p) {
            Plan::updateOrCreate(['code' => $p['code']], array_merge($p, [
                'currency' => config('billing.currency', 'USD'),
                'trial_days' => 0,
                'active' => true,
            ]));
        }

        // Attach one subscription to the default tenant if present
        try {
            $tenantModel = class_exists('Dapunjabi\\TenancyAdapter\\Models\\Tenant')
                ? 'Dapunjabi\\TenancyAdapter\\Models\\Tenant'
                : null;
            $tenantId = null;
            if ($tenantModel) {
                $tenantId = $tenantModel::where('slug', 'default')->value('id');
            } elseif (DB::getSchemaBuilder()->hasTable('tenants')) {
                $tenantId = DB::table('tenants')->where('slug','default')->value('id');
            }

            if ($tenantId) {
                $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;
                $userId = $userModel::query()->where('email', 'admin@example.com')->value('id');

                Subscription::firstOrCreate([
                    'tenant_id' => $tenantId,
                    'plan_code' => 'pro-monthly',
                ], [
                    'user_id' => $userId,
                    'status' => 'active',
                    'current_period_start' => now(),
                    'current_period_end' => now()->addMonth(),
                ]);
            }
        } catch (\Throwable $e) {
            // ignore if tenancy/users not present
        }
    }
}
