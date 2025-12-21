<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('project:health', function () {
    $ok = true;

    $this->line('== Project Health ==');
    $this->newLine();

    // DB
    $this->line('DB');
    try {
        DB::select('select 1');
        $this->info('- Connection: OK');
    } catch (\Throwable $e) {
        $ok = false;
        $this->error('- Connection: FAIL');
        $this->line('  ' . $e->getMessage());
    }

    // Tenancy
    $this->newLine();
    $this->line('Tenancy');
    $tenancyTables = ['tenants', 'tenant_domains'];
    foreach ($tenancyTables as $t) {
        $exists = Schema::hasTable($t);
        $this->line('- Table `' . $t . '`: ' . ($exists ? 'OK' : 'MISSING'));
        if (! $exists) {
            $ok = false;
        }
    }

    $tenantCount = Schema::hasTable('tenants') ? (int) DB::table('tenants')->count() : 0;
    $domainCount = Schema::hasTable('tenant_domains') ? (int) DB::table('tenant_domains')->count() : 0;
    $this->line('- Tenants: ' . $tenantCount);
    $this->line('- Tenant domains: ' . $domainCount);

    $this->line('- Routes:');
    $tenancyRouteNames = [
        'tenancy.admin.tenants.index' => '/admin/tenants',
        'tenant.select' => '/tenant/select',
    ];
    foreach ($tenancyRouteNames as $name => $path) {
        $this->line('  - ' . $name . ': ' . (Route::has($name) ? 'OK' : 'MISSING') . ' (' . $path . ')');
    }

    $this->line('- Manual check (browser):');
    $this->line('  - /tenant/debug (shows active tenant)');
    $this->line('  - /api/v1/tenant/config (returns tenant config JSON)');
    $this->line('  - If using domain tenants: add `127.0.0.1 tenantb.local` to hosts, then open http://tenantb.local:8000/tenant/debug');

    // Billing
    $this->newLine();
    $this->line('Billing');
    $billingTables = [
        'billing_plans',
        'billing_subscriptions',
        'billing_invoices',
        'billing_subscription_seats',
        'billing_webhook_logs',
    ];
    foreach ($billingTables as $t) {
        $exists = Schema::hasTable($t);
        $this->line('- Table `' . $t . '`: ' . ($exists ? 'OK' : 'MISSING'));
        if (! $exists) {
            $ok = false;
        }
    }

    $planCount = Schema::hasTable('billing_plans') ? (int) DB::table('billing_plans')->count() : 0;
    $subCount = Schema::hasTable('billing_subscriptions') ? (int) DB::table('billing_subscriptions')->count() : 0;
    $invoiceCount = Schema::hasTable('billing_invoices') ? (int) DB::table('billing_invoices')->count() : 0;
    $this->line('- Plans: ' . $planCount);
    $this->line('- Subscriptions: ' . $subCount);
    $this->line('- Invoices: ' . $invoiceCount);

    $this->line('- Routes:');
    $billingRouteNames = [
        'billing' => '/billing',
        'billing.admin.plans' => '/admin/plans',
        'billing.admin.invoices' => '/admin/billing/invoices',
    ];
    foreach ($billingRouteNames as $name => $path) {
        $this->line('  - ' . $name . ': ' . (Route::has($name) ? 'OK' : 'MISSING') . ' (' . $path . ')');
    }

    $this->line('- Manual check (browser):');
    $this->line('  - /admin/plans (create/check subscription plans)');
    $this->line('  - /billing (tenant billing portal)');

    // Media Manager
    $this->newLine();
    $this->line('Media Manager');
    $mediaTable = 'media';
    $mediaExists = Schema::hasTable($mediaTable);
    $this->line('- Table `' . $mediaTable . '`: ' . ($mediaExists ? 'OK' : 'MISSING'));
    if (! $mediaExists) {
        $ok = false;
    }
    $mediaCount = $mediaExists ? (int) DB::table($mediaTable)->count() : 0;
    $this->line('- Media rows: ' . $mediaCount);

    $this->line('- Routes:');
    $mediaRouteNames = [
        'media.admin.index' => '/admin/media',
        'api.media.upload' => '/api/v1/media/upload',
        'media.share.open' => '/media/share/{token}',
    ];
    foreach ($mediaRouteNames as $name => $path) {
        $this->line('  - ' . $name . ': ' . (Route::has($name) ? 'OK' : 'MISSING') . ' (' . $path . ')');
    }

    $this->line('- Manual check (browser):');
    $this->line('  - /admin/media (upload + listing)');

    // NGO plugin mount info
    $this->newLine();
    $this->line('NGO Plugin');
    $this->line('- mount_path: ' . (string) config('ngo-site.mount_path'));
    $this->line('- legacy_routes: ' . (config('ngo-site.legacy_routes') ? 'true' : 'false'));
    $this->line('- legacy_payment_routes: ' . (config('ngo-site.legacy_payment_routes') ? 'true' : 'false'));
    $this->line('- Manual check (browser):');
    $this->line('  - /' . trim((string) config('ngo-site.mount_path', 'ngo'), '/') . ' (NGO home)');

    $this->newLine();
    if ($ok) {
        $this->info('OK: No missing tables/routes detected.');
        return self::SUCCESS;
    }

    $this->error('FAIL: Missing tables/routes detected (see above).');
    return self::FAILURE;
})->purpose('Quickly verify tenancy, billing, media-manager, and NGO plugin wiring.');

Artisan::command('sync:legacy-migrations', function () {
    if (! Schema::hasTable('migrations')) {
        $this->error('Missing migrations table. Run `php artisan migrate --path=database/migrations --force` on a fresh DB first.');
        return self::FAILURE;
    }

    $map = [
        '0001_01_01_000000_create_users_table' => 'users',
        '0001_01_01_000001_create_cache_table' => 'cache',
        '0001_01_01_000002_create_jobs_table' => 'jobs',
        '2022_07_27_061612_create_members_table' => 'members',
    ];

    $already = DB::table('migrations')->pluck('migration')->all();
    $batch = (int) (DB::table('migrations')->max('batch') ?? 0) + 1;

    $inserted = 0;
    foreach ($map as $migration => $table) {
        if (in_array($migration, $already, true)) {
            $this->line("OK: {$migration} already recorded.");
            continue;
        }

        if (! Schema::hasTable($table)) {
            $this->warn("SKIP: {$migration} (table `{$table}` not found).");
            continue;
        }

        DB::table('migrations')->insert([
            'migration' => $migration,
            'batch' => $batch,
        ]);
        $inserted++;
        $this->info("RECORDED: {$migration} (table `{$table}` exists).");
    }

    $this->info("Done. Inserted {$inserted} migration record(s) in batch {$batch}.");
    return self::SUCCESS;
})->purpose('Record legacy migrations as ran when tables already exist (for imported DBs).');
