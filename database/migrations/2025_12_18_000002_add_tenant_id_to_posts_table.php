<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('posts')) {
            return;
        }

        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'tenant_id')) {
                $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
            }
        });

        // Make sector_name unique per-tenant (not globally).
        try {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropUnique('posts_sector_name_unique');
            });
        } catch (\Throwable $e) {
        }

        try {
            // Composite unique (tenant_id, sector_name)
            DB::statement("ALTER TABLE `posts` ADD UNIQUE `posts_tenant_sector_unique` (`tenant_id`,`sector_name`)");
        } catch (\Throwable $e) {
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('posts')) {
            return;
        }

        try {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropUnique('posts_tenant_sector_unique');
            });
        } catch (\Throwable $e) {
        }

        try {
            DB::statement("ALTER TABLE `posts` ADD UNIQUE `posts_sector_name_unique` (`sector_name`)");
        } catch (\Throwable $e) {
        }

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'tenant_id')) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            }
        });
    }
};

