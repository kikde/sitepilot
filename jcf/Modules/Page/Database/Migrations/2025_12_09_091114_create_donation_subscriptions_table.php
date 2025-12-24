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
        Schema::create('donation_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id')->nullable();
            $table->string('razorpay_subscription_id')->unique();
            $table->string('plan_id')->nullable();
            $table->string('status')->default('created'); // created/active/paused/cancelled
            $table->integer('amount_paise')->nullable();
            $table->integer('interval')->nullable()->comment('e.g. interval for the plan');
            $table->json('meta')->nullable();
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
        Schema::dropIfExists('donation_subscriptions');
    }
};
