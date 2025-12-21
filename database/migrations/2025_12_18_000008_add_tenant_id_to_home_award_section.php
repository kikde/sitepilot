<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('home_award_section')) {
            return;
        }
        if (Schema::hasColumn('home_award_section', 'tenant_id')) {
            return;
        }

        Schema::table('home_award_section', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('home_award_section')) {
            return;
        }
        if (!Schema::hasColumn('home_award_section', 'tenant_id')) {
            return;
        }
        Schema::table('home_award_section', function (Blueprint $table) {
            $table->dropIndex(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
};

