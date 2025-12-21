<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    // (demo command is defined later in this file)

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

Artisan::command('demo:setup', function () {
    $this->info('Setting up demo data...');

    $now = now();
    $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;

    // 1) Tenants (TenancyAdapter)
    $ensureTenant = function (string $slug, string $name) use ($now) {
        if (!Schema::hasTable('tenants')) return null;
        $row = DB::table('tenants')->where('slug', $slug)->first();
        if ($row) return $row;
        $id = DB::table('tenants')->insertGetId([
            'name' => $name,
            'slug' => $slug,
            'status' => 'active',
            'settings' => json_encode([
                'theme' => ['preset' => 'ngo', 'primary' => '#0ea5e9', 'accent' => '#22c55e'],
                'features' => ['enable_news' => true, 'billing' => true],
                'quotas' => ['storage_quota_mb' => 50],
            ]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        return DB::table('tenants')->where('id', $id)->first();
    };

    $t1 = $ensureTenant('tenant1.test', 'Tenant 1 (NGO Demo)');
    $t2 = $ensureTenant('tenant2.test', 'Tenant 2 (Past Due Demo)');

    // Ensure domains
    if ($t1 && Schema::hasTable('tenant_domains')) {
        DB::table('tenant_domains')->updateOrInsert(
            ['domain' => 'tenant1.test'],
            ['tenant_id' => $t1->id, 'status' => 'verified', 'verified_at' => $now, 'created_at' => $now, 'updated_at' => $now]
        );
    }
    if ($t2 && Schema::hasTable('tenant_domains')) {
        DB::table('tenant_domains')->updateOrInsert(
            ['domain' => 'tenant2.test'],
            ['tenant_id' => $t2->id, 'status' => 'verified', 'verified_at' => $now, 'created_at' => $now, 'updated_at' => $now]
        );
    }

    // 2) CoreAuth tenants mirror + license status
    if ($t1 && Schema::hasTable('coreauth_tenants')) {
        DB::table('coreauth_tenants')->updateOrInsert(
            ['id' => $t1->id],
            ['name' => $t1->name, 'slug' => $t1->slug, 'license_status' => 'active', 'updated_at' => $now, 'created_at' => $now]
        );
    }
    if ($t2 && Schema::hasTable('coreauth_tenants')) {
        DB::table('coreauth_tenants')->updateOrInsert(
            ['id' => $t2->id],
            ['name' => $t2->name, 'slug' => $t2->slug, 'license_status' => 'past_due', 'updated_at' => $now, 'created_at' => $now]
        );
    }

    // 3) Roles + permissions (CoreAuth)
    if (Schema::hasTable('coreauth_roles')) {
        foreach ([
            ['slug' => 'superadmin', 'name' => 'Super Admin'],
            ['slug' => 'tenant_admin', 'name' => 'Tenant Admin'],
            ['slug' => 'admin', 'name' => 'Admin'],
            ['slug' => 'editor', 'name' => 'Editor'],
            ['slug' => 'viewer', 'name' => 'Viewer'],
        ] as $r) {
            DB::table('coreauth_roles')->updateOrInsert(['slug' => $r['slug']], ['name' => $r['name'], 'updated_at' => $now, 'created_at' => $now]);
        }
    }
    if (Schema::hasTable('coreauth_permissions')) {
        foreach ([
            ['slug' => 'view-dashboard', 'name' => 'View Dashboard'],
            ['slug' => 'manage-roles', 'name' => 'Manage Roles'],
            ['slug' => 'manage-permissions', 'name' => 'Manage Permissions'],
            ['slug' => 'media.manage', 'name' => 'Manage Media Library'],
            ['slug' => 'ui.manage', 'name' => 'Manage UI Builder'],
            ['slug' => 'content.manage', 'name' => 'Manage Website Content'],
        ] as $p) {
            DB::table('coreauth_permissions')->updateOrInsert(['slug' => $p['slug']], ['name' => $p['name'], 'updated_at' => $now, 'created_at' => $now]);
        }
    }
    if (Schema::hasTable('coreauth_permission_role')) {
        $map = [
            'tenant_admin' => ['view-dashboard','manage-roles','manage-permissions','media.manage','ui.manage','content.manage'],
            'admin' => ['view-dashboard','manage-roles','manage-permissions','media.manage','ui.manage','content.manage'],
            'editor' => ['view-dashboard','ui.manage','content.manage'],
            'viewer' => ['view-dashboard'],
        ];
        foreach ($map as $role => $perms) {
            foreach ($perms as $perm) {
                DB::table('coreauth_permission_role')->updateOrInsert(['role_slug' => $role, 'permission_slug' => $perm], []);
            }
        }
    }

    // 4) Users
    $makeUser = function (string $email, string $name) use ($userModel) {
        return $userModel::query()->firstOrCreate(['email' => $email], [
            'name' => $name,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    };
    $super = $userModel::query()->firstOrCreate(['email' => config('coreauth.superadmin.email')], [
        'name' => config('coreauth.superadmin.name','Super Admin'),
        'password' => Hash::make(config('coreauth.superadmin.password','password')),
        'email_verified_at' => now(),
    ]);
    $cust1 = $makeUser('customer1@tenant1.test', 'Customer Admin (Tenant 1)');
    $cust2 = $makeUser('customer2@tenant2.test', 'Customer Admin (Tenant 2)');
    $editor = $makeUser('editor@tenant1.test', 'Editor (Tenant 1)');
    $viewer = $makeUser('viewer@tenant1.test', 'Viewer (Tenant 1)');

    // 5) Assign tenants + roles
    $attach = function ($userId, $tenantId, $roleSlug) {
        if (!Schema::hasTable('coreauth_tenant_user') || !Schema::hasTable('coreauth_role_user')) return;
        DB::table('coreauth_tenant_user')->updateOrInsert(['tenant_id' => $tenantId, 'user_id' => $userId], []);
        DB::table('coreauth_role_user')->updateOrInsert(['tenant_id' => $tenantId, 'user_id' => $userId, 'role_slug' => $roleSlug], []);
    };
    if ($t1) {
        $attach($super->id, $t1->id, 'superadmin');
        $attach($cust1->id, $t1->id, 'tenant_admin');
        $attach($editor->id, $t1->id, 'editor');
        $attach($viewer->id, $t1->id, 'viewer');
    }
    if ($t2) {
        $attach($super->id, $t2->id, 'superadmin');
        $attach($cust2->id, $t2->id, 'tenant_admin');
    }

    // 6) Billing plans + subscriptions (Billing Subscriptions)
    if (Schema::hasTable('billing_plans')) {
        $plans = [
            ['code' => 'ngo_basic_m', 'name' => 'NGO Basic', 'interval' => 'monthly', 'price' => 0.00, 'currency' => 'USD', 'trial_days' => 0, 'seat_limit' => 2, 'active' => 1],
            ['code' => 'ngo_pro_m', 'name' => 'NGO Pro', 'interval' => 'monthly', 'price' => 19.00, 'currency' => 'USD', 'trial_days' => 7, 'seat_limit' => 10, 'active' => 1],
            ['code' => 'ngo_pro_y', 'name' => 'NGO Pro', 'interval' => 'yearly', 'price' => 190.00, 'currency' => 'USD', 'trial_days' => 14, 'seat_limit' => 25, 'active' => 1],
        ];
        foreach ($plans as $p) {
            DB::table('billing_plans')->updateOrInsert(['code' => $p['code']], $p + ['updated_at' => $now, 'created_at' => $now]);
        }
    }
    if (Schema::hasTable('billing_subscriptions') && $t1) {
        DB::table('billing_subscriptions')->updateOrInsert(
            ['tenant_id' => $t1->id, 'plan_code' => 'ngo_pro_m'],
            [
                'user_id' => $cust1->id,
                'status' => 'active',
                'current_period_start' => $now,
                'current_period_end' => $now->copy()->addMonth(),
                'cancel_at_period_end' => 0,
                'updated_at' => $now,
                'created_at' => $now,
            ]
        );
    }
    if (Schema::hasTable('billing_subscriptions') && $t2) {
        DB::table('billing_subscriptions')->updateOrInsert(
            ['tenant_id' => $t2->id, 'plan_code' => 'ngo_pro_m'],
            [
                'user_id' => $cust2->id,
                'status' => 'past_due',
                'current_period_start' => $now->copy()->subMonth(),
                'current_period_end' => $now->copy()->subDay(),
                'cancel_at_period_end' => 0,
                'updated_at' => $now,
                'created_at' => $now,
            ]
        );
    }
    if (Schema::hasTable('billing_invoices') && $t2) {
        DB::table('billing_invoices')->updateOrInsert(
            ['tenant_id' => $t2->id, 'number' => 'DEMO-DUE-'.(string)$t2->id],
            [
                'amount' => 19.00,
                'currency' => 'USD',
                'status' => 'due',
                'due_date' => $now->toDateString(),
                'paid_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }

    $this->info('Demo ready.');
    $this->line('Open /admin/demo for quick links (superadmin only).');
    $this->line('Superadmin: '.config('coreauth.superadmin.email').' / '.config('coreauth.superadmin.password','password'));
    $this->line('Tenant1 customer: customer1@tenant1.test / password');
    $this->line('Tenant2 customer: customer2@tenant2.test / password');
    $this->line('Editor: editor@tenant1.test / password');
    $this->line('Viewer: viewer@tenant1.test / password');
})->purpose('Seed full demo: tenants, users, roles, plans, subscriptions');
