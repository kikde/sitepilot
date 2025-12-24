<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');

            /**
             * CORE
             */
            $table->string('title');
            $table->longText('content')->nullable();

            // If you have a categories table with id
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('slug')->nullable()->unique();

            /**
             * STATUS / VISIBILITY
             * status: draft, published, cancelled, completed (by convention)
             */
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('show_on_homepage')->default(false);
            $table->dateTime('display_from')->nullable();
            $table->dateTime('display_to')->nullable();

            /**
             * DATE / TIME
             */
            $table->date('start_date');
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->string('timezone')->nullable()->default('Asia/Kolkata');

            /**
             * COST / TICKETS / REGISTRATION
             */
            // Legacy / display text if you want (“Free Entry”, “Donation Based”, etc.)
            $table->string('cost')->nullable();

            $table->boolean('is_free')->default(true);
            $table->decimal('price_amount', 10, 2)->nullable();   // e.g. 200.00
            $table->string('price_currency')->nullable()->default('INR');
            $table->string('cost_label')->nullable();             // e.g. "Free Entry", "Donation Based"

            $table->string('tickets')->nullable();                // e.g. "Registration required", "Walk-in allowed"
            $table->integer('capacity')->nullable();              // total seats
            $table->integer('available_tickets')->nullable();     // current remaining

            $table->boolean('registration_required')->default(false);
            $table->dateTime('registration_deadline')->nullable();
            $table->string('registration_url')->nullable();       // Google Form / external ticket link

            /**
             * CONTENT & MEDIA
             */
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();                  // main banner
            $table->string('image_alt')->nullable();              // alt text
            $table->json('gallery_images')->nullable();           // extra images
            $table->string('video_url')->nullable();              // promo / YouTube
            $table->string('brochure_url')->nullable();           // PDF / brochure

            /**
             * ORGANIZER / CONTACT
             */
            $table->string('organizer')->nullable();              // organizer name
            $table->string('organizer_email')->nullable();
            $table->string('organizer_website')->nullable();
            $table->string('organizer_phone')->nullable();
            $table->string('organizer_whatsapp')->nullable();

            /**
             * VENUE
             */
            $table->string('venue')->nullable();                  // venue name
            $table->string('venue_location')->nullable();         // short location / landmark
            $table->text('venue_address')->nullable();            // full address
            $table->string('venue_city')->nullable();
            $table->string('venue_state')->nullable();
            $table->string('venue_country')->nullable()->default('India');
            $table->string('venue_phone')->nullable();
            $table->string('venue_map_url')->nullable();          // Google Maps link
            $table->decimal('venue_lat', 10, 7)->nullable();
            $table->decimal('venue_lng', 10, 7)->nullable();

            /**
             * SEO
             */
            $table->text('meta_title')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();

            /**
             * ANALYTICS (optional but nice to have)
             */
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('registrations_count')->default(0);
            $table->unsignedBigInteger('interested_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Foreign key for category (comment this if you don't have categories table yet)
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
