<?php

namespace Dapunjabi\TenancyAdapter\Database\Seeders;

use Illuminate\Database\Seeder;
use Dapunjabi\TenancyAdapter\Models\Tenant;
use Dapunjabi\TenancyAdapter\Models\TenantDomain;
use Dapunjabi\TenancyAdapter\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TenancySeeder extends Seeder
{
    public function run(): void
    {
        $default = Tenant::firstOrCreate(
            ['slug' => 'default'],
            [
                'name' => 'Default Tenant',
                'settings' => [
                    'theme' => [
                        'primary' => '#1976D2',
                        'primary_color' => '#1976D2',
                        'accent' => '#10b981',
                    ],
                    'features' => [
                        'enable_news' => true,
                    ],
                    'quotas' => [
                        'storage_quota_mb' => 10,
                    ],
                    'primary_domain' => 'localhost',
                ],
            ]
        );

        TenantDomain::firstOrCreate([
            'tenant_id' => $default->id,
            'domain' => 'localhost',
        ], [
            'status' => 'verified',
            'verified' => true,
            'verified_at' => now(),
        ]);

        // Also allow 127.0.0.1 for local dev convenience
        TenantDomain::firstOrCreate([
            'tenant_id' => $default->id,
            'domain' => '127.0.0.1',
        ], [
            'status' => 'verified',
            'verified' => true,
            'verified_at' => now(),
        ]);

        $tenantB = Tenant::firstOrCreate(
            ['slug' => 'tenantb.local'],
            [
                'name' => 'Tenant B',
                'settings' => [
                    'theme' => [
                        'primary' => '#1976D2',
                        'primary_color' => '#1976D2',
                        'accent' => '#ef4444',
                    ],
                    'features' => [
                        'enable_news' => true,
                        'enable_pos' => false,
                    ],
                    'quotas' => [
                        'storage_quota_mb' => 5,
                    ],
                    'primary_domain' => 'tenantb.local',
                ],
            ]
        );

        TenantDomain::firstOrCreate([
            'tenant_id' => $tenantB->id,
            'domain' => 'tenantb.local',
        ], [
            'status' => 'verified',
            'verified' => true,
            'verified_at' => now(),
        ]);

        // Sample posts for each tenant
        Post::unguard();
        foreach ([
            [$default, 'Welcome to Default Tenant', 'This is a default tenant post.'],
            [$default, 'Getting Started', 'Second sample post for default.'],
            [$tenantB, 'Tenant B News', 'Updates for Tenant B only.'],
        ] as [$tenant, $title, $body]) {
            Post::firstOrCreate([
                'tenant_id' => $tenant->id,
                'title' => $title,
            ], [
                'body' => $body,
            ]);
        }
        Post::reguard();

        // Create tenant admin for Tenant B and link via CoreAuth pivots if available
        try {
            $userModel = config('auth.providers.users.model') ?? \App\Models\User::class;
            $adminB = $userModel::firstOrCreate([
                'email' => 'tenantb.admin@example.com',
            ], [
                'name' => 'Tenant B Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);

            if (DB::getSchemaBuilder()->hasTable('coreauth_tenant_user')) {
                DB::table('coreauth_tenant_user')->updateOrInsert([
                    'tenant_id' => $tenantB->id,
                    'user_id' => $adminB->id,
                ], []);
            }
            if (DB::getSchemaBuilder()->hasTable('coreauth_role_user')) {
                DB::table('coreauth_role_user')->updateOrInsert([
                    'tenant_id' => $tenantB->id,
                    'user_id' => $adminB->id,
                    'role_slug' => 'admin',
                ], []);
            }
        } catch (\Throwable $e) {
            // CoreAuth not installed; ignore
        }
    }
}
