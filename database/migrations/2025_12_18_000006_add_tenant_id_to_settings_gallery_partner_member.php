<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Settings
        if (Schema::hasTable('settings')) {
            Schema::table('settings', function (Blueprint $table) {
                if (!Schema::hasColumn('settings', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
            try {
                DB::statement("ALTER TABLE `settings` ADD UNIQUE `settings_tenant_unique` (`tenant_id`)");
            } catch (\Throwable $e) {
            }
        }

        // Email templates (optional per-tenant)
        if (Schema::hasTable('email_templates')) {
            Schema::table('email_templates', function (Blueprint $table) {
                if (!Schema::hasColumn('email_templates', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }

        // Gallery
        if (Schema::hasTable('galleries')) {
            Schema::table('galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('galleries', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }

        // Partners
        if (Schema::hasTable('partners')) {
            Schema::table('partners', function (Blueprint $table) {
                if (!Schema::hasColumn('partners', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }

        // Members (Module\Member)
        if (Schema::hasTable('members')) {
            Schema::table('members', function (Blueprint $table) {
                if (!Schema::hasColumn('members', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });

            // Make unique constraints per-tenant (email/mobile)
            try { Schema::table('members', fn (Blueprint $t) => $t->dropUnique('members_mobile_unique')); } catch (\Throwable $e) {}
            try { Schema::table('members', fn (Blueprint $t) => $t->dropUnique('members_email_unique')); } catch (\Throwable $e) {}

            try { DB::statement("ALTER TABLE `members` ADD UNIQUE `members_tenant_mobile_unique` (`tenant_id`,`mobile`)"); } catch (\Throwable $e) {}
            try { DB::statement("ALTER TABLE `members` ADD UNIQUE `members_tenant_email_unique` (`tenant_id`,`email`)"); } catch (\Throwable $e) {}
        }

        // Member categories (categories table)
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                if (!Schema::hasColumn('categories', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }
    }

    public function down(): void
    {
        // categories
        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'tenant_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        // members
        if (Schema::hasTable('members') && Schema::hasColumn('members', 'tenant_id')) {
            try { Schema::table('members', fn (Blueprint $t) => $t->dropUnique('members_tenant_mobile_unique')); } catch (\Throwable $e) {}
            try { Schema::table('members', fn (Blueprint $t) => $t->dropUnique('members_tenant_email_unique')); } catch (\Throwable $e) {}
            try { DB::statement("ALTER TABLE `members` ADD UNIQUE `members_mobile_unique` (`mobile`)"); } catch (\Throwable $e) {}
            try { DB::statement("ALTER TABLE `members` ADD UNIQUE `members_email_unique` (`email`)"); } catch (\Throwable $e) {}

            Schema::table('members', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        // partners
        if (Schema::hasTable('partners') && Schema::hasColumn('partners', 'tenant_id')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        // galleries
        if (Schema::hasTable('galleries') && Schema::hasColumn('galleries', 'tenant_id')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        // email templates
        if (Schema::hasTable('email_templates') && Schema::hasColumn('email_templates', 'tenant_id')) {
            Schema::table('email_templates', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        // settings
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'tenant_id')) {
            try { Schema::table('settings', fn (Blueprint $t) => $t->dropUnique('settings_tenant_unique')); } catch (\Throwable $e) {}
            Schema::table('settings', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }
    }
};

