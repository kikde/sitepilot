<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ui_pages', function (Blueprint $table) {
            if (! Schema::hasColumn('ui_pages', 'locale')) {
                $table->string('locale', 10)->default('en')->after('slug');
            }
        });

        // Replace unique(tenant_id, slug) with unique(tenant_id, slug, locale)
        try {
            $tableName = 'ui_pages';
            $connection = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $connection->listTableDetails($tableName);
            if ($doctrineTable->hasIndex('ui_pages_tenant_id_slug_unique')) {
                Schema::table('ui_pages', function (Blueprint $table) {
                    $table->dropUnique('ui_pages_tenant_id_slug_unique');
                });
            }
        } catch (\Throwable $e) { /* ignore */ }

        Schema::table('ui_pages', function (Blueprint $table) {
            try {
                $table->unique(['tenant_id','slug','locale'], 'ui_pages_tenant_slug_locale_unique');
            } catch (\Throwable $e) { /* ignore */ }
        });
    }

    public function down(): void
    {
        Schema::table('ui_pages', function (Blueprint $table) {
            try { $table->dropUnique('ui_pages_tenant_slug_locale_unique'); } catch (\Throwable $e) {}
            try { $table->unique(['tenant_id','slug']); } catch (\Throwable $e) {}
            if (Schema::hasColumn('ui_pages', 'locale')) {
                $table->dropColumn('locale');
            }
        });
    }
};
