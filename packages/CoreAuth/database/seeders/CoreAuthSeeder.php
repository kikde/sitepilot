<?php

namespace Dapunjabi\CoreAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Dapunjabi\CoreAuth\Models\Tenant;
use Dapunjabi\CoreAuth\Models\Role;
use Dapunjabi\CoreAuth\Models\Permission;

class CoreAuthSeeder extends Seeder
{
    public function run(): void
    {
        $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;

        // Superadmin from config (created by installer; ensure exists)
        $email = config('coreauth.superadmin.email');
        if ($email) {
            $userModel::query()->firstOrCreate(['email' => $email], [
                'name' => config('coreauth.superadmin.name', 'Super Admin'),
                'password' => Hash::make(config('coreauth.superadmin.password', 'password')),
                'email_verified_at' => now(),
            ]);
        }

        // Test User 1 (active, verified)
        $userModel::query()->firstOrCreate(['email' => 'test1@example.com'], [
            'name' => 'Test User 1',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Test User 2 (pending verification)
        $userModel::query()->firstOrCreate(['email' => 'test2@example.com'], [
            'name' => 'Test User 2',
            'password' => Hash::make('password123'),
            'email_verified_at' => null,
        ]);

        // Test User 3 (MFA enabled)
        $test3 = $userModel::query()->firstOrCreate(['email' => 'test3@example.com'], [
            'name' => 'Test User 3',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        if (is_null($test3->mfa_secret ?? null)) {
            $test3->mfa_enabled = true;
            $test3->mfa_secret = 'JBSWY3DPEHPK3PXP'; // example secret for testing
            $test3->mfa_recovery_codes = json_encode(['ABCD1234','EFGH5678','IJKL9012','MNOP3456']);
            $test3->save();
        }

        // Phase 3: Tenants, Roles, Permissions
        $defaultTenant = Tenant::query()->firstOrCreate(['slug' => 'default'], ['name' => 'Default Tenant','license_status' => 'active']);
        $altTenant = Tenant::query()->firstOrCreate(['slug' => 'second'], ['name' => 'Second Tenant','license_status' => 'past_due']);

        $roles = collect([
            ['slug' => 'superadmin', 'name' => 'Super Admin'],
            ['slug' => 'admin', 'name' => 'Admin'],
            ['slug' => 'editor', 'name' => 'Editor'],
            ['slug' => 'viewer', 'name' => 'Viewer'],
        ]);
        foreach ($roles as $r) { Role::query()->firstOrCreate(['slug' => $r['slug']], ['name' => $r['name']]); }

        $permissions = collect([
            ['slug' => 'manage-roles', 'name' => 'Manage Roles'],
            ['slug' => 'manage-permissions', 'name' => 'Manage Permissions'],
            ['slug' => 'view-dashboard', 'name' => 'View Dashboard'],
        ]);
        foreach ($permissions as $p) { Permission::query()->firstOrCreate(['slug' => $p['slug']], ['name' => $p['name']]); }

        // Map admin/editor/viewer permissions (superadmin implicit bypass in code)
        $rolePerm = [
            'admin' => ['manage-roles','manage-permissions','view-dashboard'],
            'editor' => ['view-dashboard'],
            'viewer' => ['view-dashboard'],
        ];
        foreach ($rolePerm as $role => $perms) {
            foreach ($perms as $perm) {
                DB::table('coreauth_permission_role')->updateOrInsert([
                    'role_slug' => $role,
                    'permission_slug' => $perm,
                ], []);
            }
        }

        // Attach users to tenants and roles
        $super = $userModel::query()->where('email', config('coreauth.superadmin.email'))->first();
        if ($super) {
            DB::table('coreauth_tenant_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $super->id], []);
            DB::table('coreauth_role_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $super->id, 'role_slug' => 'superadmin'], []);
        }

        $test1 = $userModel::query()->where('email', 'test1@example.com')->first();
        if ($test1) {
            DB::table('coreauth_tenant_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $test1->id], []);
            DB::table('coreauth_role_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $test1->id, 'role_slug' => 'admin'], []);
        }

        $test2 = $userModel::query()->where('email', 'test2@example.com')->first();
        if ($test2) {
            DB::table('coreauth_tenant_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $test2->id], []);
            DB::table('coreauth_role_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $test2->id, 'role_slug' => 'viewer'], []);
        }

        // Test User 4 (multiple tenants)
        $test4 = $userModel::query()->firstOrCreate(['email' => 'test4@example.com'], [
            'name' => 'Test User 4',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        DB::table('coreauth_tenant_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $test4->id], []);
        DB::table('coreauth_tenant_user')->updateOrInsert(['tenant_id' => $altTenant->id, 'user_id' => $test4->id], []);
        DB::table('coreauth_role_user')->updateOrInsert(['tenant_id' => $defaultTenant->id, 'user_id' => $test4->id, 'role_slug' => 'editor'], []);
        DB::table('coreauth_role_user')->updateOrInsert(['tenant_id' => $altTenant->id, 'user_id' => $test4->id, 'role_slug' => 'viewer'], []);

        // Test User 5 (for invites)
        $test5 = $userModel::query()->firstOrCreate(['email' => 'test5@example.com'], [
            'name' => 'Test User 5',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        // Generate an invite token for Test User 5 to default tenant as viewer
        if (!DB::table('coreauth_invites')->where('email', 'test5@example.com')->exists()) {
            DB::table('coreauth_invites')->insert([
                'token' => bin2hex(random_bytes(16)),
                'tenant_id' => $defaultTenant->id,
                'role_slug' => 'viewer',
                'email' => 'test5@example.com',
                'invited_by' => $super?->id,
                'expires_at' => now()->addDays(14),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Sample invoices
        $makeInv = function ($tenantId, $number, $amount, $status) {
            DB::table('coreauth_invoices')->updateOrInsert(['number' => $number], [
                'tenant_id' => $tenantId,
                'amount' => $amount,
                'currency' => 'USD',
                'status' => $status,
                'due_date' => now()->addDays(7)->toDateString(),
                'paid_at' => $status === 'paid' ? now() : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };
        $makeInv($defaultTenant->id, 'INV-1001', 49.00, 'paid');
        $makeInv($altTenant->id, 'INV-2001', 49.00, 'due');
    }
}
