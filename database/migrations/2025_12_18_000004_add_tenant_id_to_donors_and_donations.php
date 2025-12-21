<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('donors')) {
            Schema::table('donors', function (Blueprint $table) {
                if (!Schema::hasColumn('donors', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }

        if (Schema::hasTable('donations')) {
            Schema::table('donations', function (Blueprint $table) {
                if (!Schema::hasColumn('donations', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }

        if (Schema::hasTable('donation_subscriptions')) {
            Schema::table('donation_subscriptions', function (Blueprint $table) {
                if (!Schema::hasColumn('donation_subscriptions', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('donation_subscriptions') && Schema::hasColumn('donation_subscriptions', 'tenant_id')) {
            Schema::table('donation_subscriptions', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        if (Schema::hasTable('donations') && Schema::hasColumn('donations', 'tenant_id')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        if (Schema::hasTable('donors') && Schema::hasColumn('donors', 'tenant_id')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }
    }
};

