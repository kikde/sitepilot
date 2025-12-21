<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('support_tickets')) {
            Schema::table('support_tickets', function (Blueprint $table) {
                if (!Schema::hasColumn('support_tickets', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }

        if (Schema::hasTable('support_ticket_messages')) {
            Schema::table('support_ticket_messages', function (Blueprint $table) {
                if (!Schema::hasColumn('support_ticket_messages', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }

        if (Schema::hasTable('support_ticket_departments')) {
            Schema::table('support_ticket_departments', function (Blueprint $table) {
                if (!Schema::hasColumn('support_ticket_departments', 'tenant_id')) {
                    $table->unsignedBigInteger('tenant_id')->nullable()->after('id')->index();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('support_ticket_departments') && Schema::hasColumn('support_ticket_departments', 'tenant_id')) {
            Schema::table('support_ticket_departments', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        if (Schema::hasTable('support_ticket_messages') && Schema::hasColumn('support_ticket_messages', 'tenant_id')) {
            Schema::table('support_ticket_messages', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }

        if (Schema::hasTable('support_tickets') && Schema::hasColumn('support_tickets', 'tenant_id')) {
            Schema::table('support_tickets', function (Blueprint $table) {
                $table->dropIndex(['tenant_id']);
                $table->dropColumn('tenant_id');
            });
        }
    }
};

