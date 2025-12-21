<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // templates
        Schema::create('ui_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('page'); // page|partial|layout
            $table->json('data')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });

        // template_revisions
        Schema::create('ui_template_revisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->unsignedBigInteger('template_id')->index();
            $table->unsignedInteger('version')->default(1);
            $table->json('payload');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });

        // blocks registry
        Schema::create('ui_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->string('code')->index();
            $table->string('name');
            $table->json('schema')->nullable();
            $table->json('defaults')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('version')->default(1);
            $table->timestamps();
        });

        // pages
        Schema::create('ui_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->index();
            $table->unsignedBigInteger('template_id')->nullable()->index();
            $table->json('data')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
            $table->unique(['tenant_id','slug']);
        });

        // sections (composition of blocks)
        Schema::create('ui_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->unsignedBigInteger('page_id')->nullable()->index();
            $table->unsignedBigInteger('template_id')->nullable()->index();
            $table->string('key')->index();
            $table->json('blocks')->nullable(); // array of { code, props }
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
        });

        // themes (per-tenant tokens/settings)
        Schema::create('ui_themes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->unique();
            $table->json('tokens')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
        });

        // shortcodes registry
        Schema::create('ui_shortcodes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('handler')->nullable();
            $table->string('description')->nullable();
            $table->json('schema')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ui_shortcodes');
        Schema::dropIfExists('ui_themes');
        Schema::dropIfExists('ui_sections');
        Schema::dropIfExists('ui_pages');
        Schema::dropIfExists('ui_blocks');
        Schema::dropIfExists('ui_template_revisions');
        Schema::dropIfExists('ui_templates');
    }
};
