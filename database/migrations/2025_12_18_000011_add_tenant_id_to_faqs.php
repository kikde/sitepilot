<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('faqs')) {
            return;
        }
        if (Schema::hasColumn('faqs', 'tenant_id')) {
            return;
        }

        Schema::table('faqs', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('faqs')) {
            return;
        }
        if (!Schema::hasColumn('faqs', 'tenant_id')) {
            return;
        }

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
};

