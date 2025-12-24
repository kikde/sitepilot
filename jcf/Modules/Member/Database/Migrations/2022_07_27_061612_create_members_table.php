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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('father_name')->nullable(); 
            $table->string('profession')->nullable(); 
            $table->string('bloodgroup')->nullable(); 
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('images')->nullable();
            $table->string('idtype')->nullable();
            $table->string('uploadfile')->nullable();
            $table->string('document')->nullable();
            $table->string('slug')->nullable();
            $table->string('page_title')->nullable();
            $table->string('page_keyword')->nullable();
            $table->string('rating')->nullable();
            $table->string('category_id')->nullable();
            $table->text('screenshot')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('members');
    }
};
