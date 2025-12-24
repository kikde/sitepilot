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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->string('breadcrumb')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->longtext('description')->nullable(); 
            $table->string('pagetitle')->nullable();
            $table->string('pagekeyword')->nullable();
            $table->string('pagestatus')->nullable();
            $table->string('types')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
