<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    /**
     * Allow mass assignment for all the fields
     * we are using in the controller + migration.
     */
     protected $guarded = [];
     
     
     
    // protected $fillable = [
    //     // Core
    //     'title',
    //     'slug',
    //     'category_id',

    //     // Content
    //     'short_description',
    //     'description',      // new detailed field (same as content for now)

    //     // Date & Time
    //     'start_date',
    //     'start_time',
    //     'end_date',
    //     'end_time',
    //     'timezone',

    //     // Cost & Tickets
    //     'is_free',
    //     'price_amount',
    //     'price_currency',
    //     'cost_label',
    //     'capacity',
    //     'available_tickets',
    //     'tickets',
    //     'cost',             // legacy text (e.g. "Free", "Donation Based")

    //     // Registration
    //     'registration_required',
    //     'registration_deadline',
    //     'registration_url',

    //     // Organizer
    //     'organizer',
    //     'organizer_email',
    //     'organizer_phone',
    //     'organizer_whatsapp',
    //     'organizer_website',

    //     // Venue
    //     'venue',
    //     'venue_location',
    //     'venue_address',
    //     'venue_city',
    //     'venue_state',
    //     'venue_country',
    //     'venue_phone',
    //     'venue_map_url',
    //     'venue_lat',
    //     'venue_lng',

    //     // Media
    //     'image',
    //     'image_alt',
    //     'gallery_images',
    //     'video_url',
    //     'brochure_url',

    //     // Status & Visibility
    //     'status',           // draft, published, cancelled, completed
    //     'is_featured',
    //     'show_on_homepage',
    //     'display_from',
    //     'display_to',

    //     // SEO
    //     'meta_title',
    //     'meta_tags',
    //     'meta_description',

    //     // Analytics
    //     'views_count',
    //     'registrations_count',
    //     'interested_count',
    // ];

    /**
     * Relationship: Event belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\EventsCategory::class, 'category_id');
    }

    /**
     * Accessor for full image URL.
     * Assumes uploaded images are stored in public/backend/events.
     */
    public function getImageUrlAttribute(): string
    {
        $image = $this->image;

        if (!$image) {
            return asset('frontend/custom/breadcrump.png'); // fallback image
        }

        // If already a full URL, just return it
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        // Try backend/events/{filename}
        $relativePath = 'backend/events/' . ltrim($image, '/');

        if (file_exists(public_path($relativePath))) {
            return asset($relativePath);
        }

        // Fallback to original behaviour (public root or storage)
        if (file_exists(public_path($image))) {
            return asset($image);
        }

        return asset('storage/' . ltrim($image, '/'));
    }
}
