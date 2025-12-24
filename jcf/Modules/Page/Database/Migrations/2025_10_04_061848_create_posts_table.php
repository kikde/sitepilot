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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('sector_name')->unique()->nullable();
            $table->string('breadcrumb')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('heading')->nullable();
            $table->string('description')->nullable();
            $table->string('subheading')->nullable();
            $table->string('pagetitle')->nullable();
            $table->string('pagekeyword')->nullable();
            $table->string('pagestatus')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
