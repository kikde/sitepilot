<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['home_banners', 'home_todos', 'home_award_static'] as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }
            if (Schema::hasColumn($table, 'tenant_id')) {
                continue;
            }
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
            });
        }
    }

    public function down(): void
    {
        foreach (['home_banners', 'home_todos', 'home_award_static'] as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }
            if (!Schema::hasColumn($table, 'tenant_id')) {
                continue;
            }
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->dropIndex(['tenant_id']);
                $blueprint->dropColumn('tenant_id');
            });
        }
    }
};
