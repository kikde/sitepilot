<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('coreauth_tenants', function (Blueprint $table) {
            $table->string('license_status')->default('active')->after('slug');
        });
    }
    public function down(): void
    {
        Schema::table('coreauth_tenants', function (Blueprint $table) {
            $table->dropColumn('license_status');
        });
    }
};

