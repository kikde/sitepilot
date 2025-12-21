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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->integer('rating')->nullable();
            $table->string('images')->nullable();
            $table->string('alt_tag')->nullable();
            $table->longtext('description')->nullable();
            $table->string('name')->nullable();
            $table->text('desg')->nullable();
            $table->string('before_img')->nullable();
            $table->string('after_img')->nullable();
            $table->string('page_title')->nullable();
            $table->string('page_keywords')->nullable();
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
        Schema::dropIfExists('testimonials');
    }
};
