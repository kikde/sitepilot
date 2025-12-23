<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'title','content','category_id','slug','status','is_featured','show_on_homepage','display_from','display_to',
        'start_date','start_time','end_date','end_time','timezone','cost','is_free','price_amount','price_currency',
        'cost_label','tickets','capacity','available_tickets','registration_required','registration_deadline',
        'registration_url','short_description','description','image','image_alt','gallery_images','video_url',
        'brochure_url','organizer','organizer_email','organizer_website','organizer_phone','organizer_whatsapp',
        'venue','venue_location','venue_address','venue_city','venue_state','venue_country','venue_phone',
        'venue_map_url','venue_lat','venue_lng','meta_title','meta_tags','meta_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'show_on_homepage' => 'boolean',
        'is_free' => 'boolean',
        'registration_required' => 'boolean',
        'gallery_images' => 'array',
        'display_from' => 'datetime',
        'display_to' => 'datetime',
        'registration_deadline' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }
}

