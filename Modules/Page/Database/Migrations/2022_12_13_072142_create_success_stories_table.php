<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('slug')->nullable();
            $table->longText('content');
            $table->unsignedInteger('success_story_category_id');
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_meta_title')->nullable();
            $table->text('og_meta_description')->nullable();
            $table->string('og_meta_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('success_stories');
    }
};
