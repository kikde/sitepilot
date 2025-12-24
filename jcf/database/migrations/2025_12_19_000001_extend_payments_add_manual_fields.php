<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'payment_rec')) {
                $table->string('payment_rec')->nullable()->after('screenshot');
            }
            if (!Schema::hasColumn('payments', 'method')) {
                $table->string('method', 50)->nullable()->after('currency');
            }
            if (!Schema::hasColumn('payments', 'note')) {
                $table->text('note')->nullable()->after('method');
            }
            if (!Schema::hasColumn('payments', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('status');
            }
            if (!Schema::hasColumn('payments', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('is_verified');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'payment_rec')) {
                $table->dropColumn('payment_rec');
            }
            if (Schema::hasColumn('payments', 'method')) {
                $table->dropColumn('method');
            }
            if (Schema::hasColumn('payments', 'note')) {
                $table->dropColumn('note');
            }
            if (Schema::hasColumn('payments', 'is_verified')) {
                $table->dropColumn('is_verified');
            }
            if (Schema::hasColumn('payments', 'verified_at')) {
                $table->dropColumn('verified_at');
            }
        });
    }
};

