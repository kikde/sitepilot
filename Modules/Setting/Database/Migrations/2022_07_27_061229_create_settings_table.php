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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_url')->nullable();
            $table->string('site_email')->nullable();
            $table->string('title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_author')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('timezone')->nullable();
            $table->String('language')->nullable();
            $table->String('site_logo')->nullable();
            $table->String('favicon_icon')->nullable();
            $table->text('company_stamp')->nullable();
            $table->text('company_no')->nullable();
            $table->text('pan_no')->nullable();
            $table->text('tan_no')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('insta_url')->nullable();
            $table->string('linkdin_url')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
