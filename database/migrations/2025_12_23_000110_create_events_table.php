<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->longText('content')->nullable();
                $table->unsignedBigInteger('category_id')->nullable();
                $table->string('slug')->nullable()->unique();
                $table->string('status')->default('draft');
                $table->boolean('is_featured')->default(false);
                $table->boolean('show_on_homepage')->default(false);
                $table->dateTime('display_from')->nullable();
                $table->dateTime('display_to')->nullable();
                $table->date('start_date')->nullable();
                $table->time('start_time')->nullable();
                $table->date('end_date')->nullable();
                $table->time('end_time')->nullable();
                $table->string('timezone')->nullable()->default('Asia/Kolkata');
                $table->string('cost')->nullable();
                $table->boolean('is_free')->default(true);
                $table->decimal('price_amount', 10, 2)->nullable();
                $table->string('price_currency')->nullable()->default('INR');
                $table->string('cost_label')->nullable();
                $table->string('tickets')->nullable();
                $table->integer('capacity')->nullable();
                $table->integer('available_tickets')->nullable();
                $table->boolean('registration_required')->default(false);
                $table->dateTime('registration_deadline')->nullable();
                $table->string('registration_url')->nullable();
                $table->text('short_description')->nullable();
                $table->longText('description')->nullable();
                $table->string('image')->nullable();
                $table->string('image_alt')->nullable();
                $table->json('gallery_images')->nullable();
                $table->string('video_url')->nullable();
                $table->string('brochure_url')->nullable();
                $table->string('organizer')->nullable();
                $table->string('organizer_email')->nullable();
                $table->string('organizer_website')->nullable();
                $table->string('organizer_phone')->nullable();
                $table->string('organizer_whatsapp')->nullable();
                $table->string('venue')->nullable();
                $table->string('venue_location')->nullable();
                $table->text('venue_address')->nullable();
                $table->string('venue_city')->nullable();
                $table->string('venue_state')->nullable();
                $table->string('venue_country')->nullable()->default('India');
                $table->string('venue_phone')->nullable();
                $table->string('venue_map_url')->nullable();
                $table->decimal('venue_lat', 10, 7)->nullable();
                $table->decimal('venue_lng', 10, 7)->nullable();
                $table->text('meta_title')->nullable();
                $table->text('meta_tags')->nullable();
                $table->text('meta_description')->nullable();
                $table->unsignedBigInteger('views_count')->default(0);
                $table->unsignedBigInteger('registrations_count')->default(0);
                $table->unsignedBigInteger('interested_count')->default(0);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

