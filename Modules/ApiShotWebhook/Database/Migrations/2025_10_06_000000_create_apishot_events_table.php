<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('apishot_events', function (Blueprint $t) {
            $t->id();
            $t->string('job_id', 64)->index();
            $t->string('status', 32)->index();
            $t->string('format', 16)->nullable();
            $t->text('result_url')->nullable();
            $t->unsignedBigInteger('bytes')->nullable();
            $t->json('payload')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('apishot_events'); }
};
