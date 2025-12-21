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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
                $table->foreignId('donor_id')->constrained('donors')->cascadeOnDelete();
                $table->string('campaign')->nullable();
                $table->unsignedBigInteger('amount_paise');
                $table->string('currency', 8)->default('INR');
                $table->string('status', 20)->default('created');
                $table->string('razorpay_order_id')->nullable()->index();
                $table->string('razorpay_payment_id')->nullable()->index();
                $table->string('razorpay_signature')->nullable();
                $table->string('receipt_no')->nullable()->index();
                $table->string('receipt_pdf_path')->nullable();
                $table->timestamp('emailed_at')->nullable();
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
        Schema::dropIfExists('donations');
    }
};
