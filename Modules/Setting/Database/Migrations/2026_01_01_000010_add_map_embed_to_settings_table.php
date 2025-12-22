<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('settings') && !Schema::hasColumn('settings', 'map_embed')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->longText('map_embed')->nullable()->after('youtube');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'map_embed')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('map_embed');
            });
        }
    }
};

