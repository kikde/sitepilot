<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pages')) {
            return;
        }

        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'tenant_id')) {
                $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
            }
        });

        // Make name unique per-tenant (not globally).
        try {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropUnique('pages_name_unique');
            });
        } catch (\Throwable $e) {
        }

        try {
            DB::statement("ALTER TABLE `pages` ADD UNIQUE `pages_tenant_name_unique` (`tenant_id`,`name`)");
        } catch (\Throwable $e) {
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('pages')) {
            return;
        }

        try {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropUnique('pages_tenant_name_unique');
            });
        } catch (\Throwable $e) {
        }

        try {
            DB::statement("ALTER TABLE `pages` ADD UNIQUE `pages_name_unique` (`name`)");
        } catch (\Throwable $e) {
        }

        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'tenant_id')) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            }
        });
    }
};

