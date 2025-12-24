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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('screenshot')->nullable();
            $table->string('razorpay_order_id')->nullable()->after('screenshot');
            $table->string('razorpay_payment_id')->nullable()->after('razorpay_order_id');
            $table->string('status')->nullable()->after('razorpay_payment_id'); // created/paid/failed
            $table->integer('amount')->nullable()->after('status'); // store in paise
            $table->string('currency', 10)->nullable()->after('amount');
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
        Schema::dropIfExists('payments');
    }
};
