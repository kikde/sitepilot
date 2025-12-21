<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('billing_plans', function (Blueprint $table) {
            if (!Schema::hasColumn('billing_plans', 'seat_limit')) {
                $table->unsignedInteger('seat_limit')->nullable()->after('trial_days');
            }
        });
    }

    public function down(): void
    {
        Schema::table('billing_plans', function (Blueprint $table) {
            if (Schema::hasColumn('billing_plans', 'seat_limit')) {
                $table->dropColumn('seat_limit');
            }
        });
    }
};

