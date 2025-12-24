<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->string('referral_code', 32)->unique()->nullable();

            $table->string('regno')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->string('fname')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('desg')->nullable();
            $table->string('address')->nullable();
            $table->string('landmark')->nullable();
            $table->string('pincode')->nullable();   
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('role')->default('0');  // 2-User,1-Admin
            $table->integer('status')->default(0);  // 1 for active 0 for not active
            $table->integer('useractive')->default(0);
            $table->string('bloodgroup')->nullable();
            $table->string('bpscell')->nullable();
            $table->string('idtype')->nullable();
            $table->string('idproof_doc')->nullable();
            $table->string('addtype')->nullable();
            $table->string('other_doc')->nullable();
            $table->string('id_no')->nullable();
            $table->string('address_no')->nullable();
            $table->string('topten')->nullable()->default('0');
            $table->string('pow')->nullable()->default('0');
            $table->string('appointment_letter')->nullable();
            $table->string('idcard')->nullable();
            $table->string('honar_letter')->nullable();
            $table->string('official_1')->nullable();
            $table->string('official_2')->nullable(); 
            $table->string('before_affidavit')->nullable(); 
            $table->string('after_verifiy_affidavit')->nullable();
            $table->string('valid_upto')->nullable();
            
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

         // Add the self-referencing FK after create (safer across MySQL/MariaDB versions)
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('referrer_id')
                  ->references('id')->on('users')
                  ->nullOnDelete();
        });
    } 
    


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referrer_id']);
        });
        Schema::dropIfExists('users');
    }
};
