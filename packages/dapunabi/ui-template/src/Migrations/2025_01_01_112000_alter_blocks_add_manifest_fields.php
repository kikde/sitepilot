<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ui_blocks', function (Blueprint $table) {
            if (! Schema::hasColumn('ui_blocks', 'component')) {
                $table->string('component')->nullable()->after('defaults');
            }
            if (! Schema::hasColumn('ui_blocks', 'preview')) {
                $table->text('preview')->nullable()->after('component');
            }
            if (! Schema::hasColumn('ui_blocks', 'category')) {
                $table->string('category')->nullable()->after('preview');
            }
            if (! Schema::hasColumn('ui_blocks', 'meta')) {
                $table->json('meta')->nullable()->after('category');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ui_blocks', function (Blueprint $table) {
            if (Schema::hasColumn('ui_blocks', 'meta')) $table->dropColumn('meta');
            if (Schema::hasColumn('ui_blocks', 'category')) $table->dropColumn('category');
            if (Schema::hasColumn('ui_blocks', 'preview')) $table->dropColumn('preview');
            if (Schema::hasColumn('ui_blocks', 'component')) $table->dropColumn('component');
        });
    }
};
