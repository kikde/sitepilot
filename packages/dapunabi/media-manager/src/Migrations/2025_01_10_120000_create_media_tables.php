<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Allow running against databases that already have some of these tables
        // (e.g. importing an existing NGO DB dump first).

        $mediaTable = (string) config('media-manager.tables.media', 'mm_media');
        $variantsTable = (string) config('media-manager.tables.variants', 'mm_media_variants');
        $usageTable = (string) config('media-manager.tables.usage', 'mm_media_usage');
        $sharesTable = (string) config('media-manager.tables.shares', 'mm_media_shares');
        $statsTable = (string) config('media-manager.tables.storage_stats', 'mm_media_storage_stats');
        $versionsTable = (string) config('media-manager.tables.versions', 'mm_media_versions');

        if (! Schema::hasTable($mediaTable)) {
            Schema::create($mediaTable, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('tenant_id')->nullable()->index();
                $table->uuid('uuid')->unique();
                $table->string('filename');
                $table->string('original_name')->nullable();
                $table->string('mime_type')->nullable();
                $table->unsignedBigInteger('size')->default(0);
                $table->string('disk', 50)->default('public');
                $table->string('path')->index();
                $table->string('hash', 128)->nullable()->index();
                $table->json('variants_json')->nullable();
                $table->json('meta_json')->nullable();
                $table->json('tags_json')->nullable();
                $table->string('folder')->nullable()->index();
                $table->unsignedBigInteger('uploaded_by')->nullable()->index();
                $table->string('visibility', 20)->default('private');
                $table->unsignedInteger('version')->default(1);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($variantsTable)) {
            Schema::create($variantsTable, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('media_id')->index();
                $table->string('name');
                $table->string('path');
                $table->unsignedInteger('width')->nullable();
                $table->unsignedInteger('height')->nullable();
                $table->unsignedBigInteger('size')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($usageTable)) {
            Schema::create($usageTable, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('tenant_id')->nullable()->index();
                $table->unsignedBigInteger('media_id')->index();
                $table->string('used_in');
                $table->string('reference_id')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($sharesTable)) {
            Schema::create($sharesTable, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('media_id')->index();
                $table->string('token')->unique();
                $table->timestamp('expires_at')->nullable();
                $table->unsignedInteger('downloads_count')->default(0);
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable($statsTable)) {
            Schema::create($statsTable, function (Blueprint $table) {
                $table->unsignedBigInteger('tenant_id')->primary();
                $table->unsignedBigInteger('total_bytes')->default(0);
                $table->unsignedBigInteger('file_count')->default(0);
                $table->timestamp('updated_at')->nullable();
            });
        }

        if (! Schema::hasTable($versionsTable)) {
            Schema::create($versionsTable, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('media_id')->index();
                $table->unsignedInteger('version_no');
                $table->string('disk', 50);
                $table->string('path');
                $table->unsignedBigInteger('size')->default(0);
                $table->string('mime_type')->nullable();
                $table->string('filename');
                $table->string('original_name')->nullable();
                $table->unsignedBigInteger('uploaded_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        $mediaTable = (string) config('media-manager.tables.media', 'mm_media');
        $variantsTable = (string) config('media-manager.tables.variants', 'mm_media_variants');
        $usageTable = (string) config('media-manager.tables.usage', 'mm_media_usage');
        $sharesTable = (string) config('media-manager.tables.shares', 'mm_media_shares');
        $statsTable = (string) config('media-manager.tables.storage_stats', 'mm_media_storage_stats');
        $versionsTable = (string) config('media-manager.tables.versions', 'mm_media_versions');

        Schema::dropIfExists($versionsTable);
        Schema::dropIfExists($statsTable);
        Schema::dropIfExists($sharesTable);
        Schema::dropIfExists($usageTable);
        Schema::dropIfExists($variantsTable);
        Schema::dropIfExists($mediaTable);
    }
};
