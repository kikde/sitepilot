<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tenant_domains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('domain')->unique();
            $table->string('verification_token')->nullable();
            $table->string('status')->default('pending'); // pending|verified
            $table->boolean('verified')->default(false); // legacy flag for compatibility
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tenant_domains');
    }
};
