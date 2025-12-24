<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use App\Models\Language;
use App\Models\EventAttendance;
use App\Models\EventPaymentLogs;
use App\Models\Events;
use App\Models\EventsCategory;
use App\Mail\BasicMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Auth;
use View;

class EventsController extends Controller
{
    private const BASE_PATH = 'backend.events.';
    public function __construct()
    {
        $this->middleware('auth');

        $setting = Setting::first();
        View::share(['setting'=>$setting]);
    }

   
   
    //
 public function all_events(Request $request)
{
    // allow ?per_page= to be overridden (defaults to 12)
    $perPage = (int) $request->get('per_page', 12);

    $all_events = Events::latest()
        ->paginate($perPage)      // <-- paginate instead of get()
        ->withQueryString();      // keeps existing query params on links()

    return view(self::BASE_PATH.'all-events')
        ->with(['all_events' => $all_events]);
}

    public function new_event(){
        $all_categories = EventsCategory::where(['status' => 'publish'])->get();
        return view(self::BASE_PATH.'new-event')->with(['all_categories' => $all_categories]);
    }


public function store_event(Request $request)
{
    $request->validate([
        'title'             => 'required|string|max:191',
        'category_id'       => 'nullable|integer|exists:events_categories,id',

        'short_description' => 'nullable|string',
        'event_content'     => 'nullable|string',
        'description'     => 'nullable|string',

        // NEW date & time fields
        'start_date'        => 'required|date',
        'start_time'        => 'nullable',
        'end_date'          => 'nullable|date|after_or_equal:start_date',
        'end_time'          => 'nullable',
        'timezone'          => 'nullable|string|max:100',

        // Cost & tickets
        'is_free'           => 'required|boolean',
        'price_amount'      => 'nullable|numeric',
        'price_currency'    => 'nullable|string|max:10',
        'cost_label'        => 'nullable|string|max:255',
        'capacity'          => 'nullable|integer',
        'available_tickets' => 'nullable|integer',
        'tickets'           => 'nullable|string|max:255',

        // Registration
        'registration_required' => 'nullable|boolean',
        'registration_deadline' => 'nullable|date',
        'registration_url'      => 'nullable|string|max:255',

        // Organizer
        'organizer'         => 'nullable|string|max:191',
        'organizer_email'   => 'nullable|string|max:191',
        'organizer_phone'   => 'nullable|string|max:191',
        'organizer_whatsapp'=> 'nullable|string|max:191',
        'organizer_website' => 'nullable|string|max:191',

        // Venue
        'venue'             => 'nullable|string|max:191',
        'venue_location'    => 'nullable|string|max:191',
        'venue_address'     => 'nullable|string',
        'venue_city'        => 'nullable|string|max:191',
        'venue_state'       => 'nullable|string|max:191',
        'venue_country'     => 'nullable|string|max:191',
        'venue_phone'       => 'nullable|string|max:191',
        'venue_map_url'     => 'nullable|string|max:255',

        // Media
        'video_url'         => 'nullable|string|max:255',
        'brochure_url'      => 'nullable|string|max:255',
        'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp,gif',

        // Status & SEO
        'slug'              => 'nullable|string|max:191',
        'status'            => 'required|string|in:draft,published,cancelled,completed',
        'is_featured'       => 'nullable|boolean',
        'show_on_homepage'  => 'nullable|boolean',
        'display_from'      => 'nullable|date',
        'display_to'        => 'nullable|date',

        'meta_title'        => 'nullable|string',
        'meta_tags'         => 'nullable|string',
        'meta_description'  => 'nullable|string',
    ]);

    // Slug
    $slug = $request->filled('slug')
        ? Str::slug($request->slug)
        : Str::slug($request->title);

    // Booleans
    $isFree             = $request->boolean('is_free');
    $isFeatured         = $request->boolean('is_featured');
    $showOnHomepage     = $request->boolean('show_on_homepage');
    $registrationNeeded = $request->boolean('registration_required');

    // Image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $file      = $request->file('image');
        $filename  = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $filename  = $filename.'.'.$extension;
        $file->move(public_path('backend/events'), $filename);
        $imagePath = $filename;
    }

    Events::create([
        'title'             => $request->title,
        'slug'              => $slug,
        'category_id'       => $request->category_id,

        'short_description' => $request->short_description,
         'content'           => $request->event_content,  // old field
        'description'       => $request->event_content,  // new field if you added it

        // ✅ NEW REQUIRED FIELD
        'start_date'        => $request->start_date,
        'start_time'        => $request->start_time,
        'end_date'          => $request->end_date,
        'end_time'          => $request->end_time,
        'timezone'          => $request->timezone ?? 'Asia/Kolkata',

        // Cost & tickets
        'is_free'           => $isFree,
        'price_amount'      => $request->price_amount,
        'price_currency'    => $request->price_currency ?? 'INR',
        'cost_label'        => $request->cost_label,
        'capacity'          => $request->capacity,
        'available_tickets' => $request->available_tickets,
        'tickets'           => $request->tickets,
        // optional legacy "cost" text
        'cost'              => $request->cost_label ?: ($isFree ? 'Free' : null),

        // Registration
        'registration_required' => $registrationNeeded,
        'registration_deadline' => $request->registration_deadline,
        'registration_url'      => $request->registration_url,

        // Organizer
        'organizer'         => $request->organizer,
        'organizer_email'   => $request->organizer_email,
        'organizer_phone'   => $request->organizer_phone,
        'organizer_whatsapp'=> $request->organizer_whatsapp,
        'organizer_website' => $request->organizer_website,

        // Venue
        'venue'             => $request->venue,
        'venue_location'    => $request->venue_location,
        'venue_address'     => $request->venue_address,
        'venue_city'        => $request->venue_city,
        'venue_state'       => $request->venue_state,
        'venue_country'     => $request->venue_country,
        'venue_phone'       => $request->venue_phone,
        'venue_map_url'     => $request->venue_map_url,

        // Media
        'image'             => $imagePath,
        'video_url'         => $request->video_url,
        'brochure_url'      => $request->brochure_url,

        // Status / visibility
        'status'            => $request->status,
        'is_featured'       => $isFeatured,
        'show_on_homepage'  => $showOnHomepage,
        'display_from'      => $request->display_from,
        'display_to'        => $request->display_to,

        // SEO
        'meta_title'        => $request->meta_title,
        'meta_tags'         => $request->meta_tags,
        'meta_description'  => $request->meta_description,
    ]);

    return redirect()
        ->route('admin.events.all')
        ->with('message', 'Event created successfully.');
}




    public function edit_event($id){
        $event = Events::findOrfail($id);
        $all_categories = EventsCategory::where(['status' => 'publish'])->get();
        return view(self::BASE_PATH.'edit-event')->with(['all_categories' => $all_categories,'event' => $event]);
    }

    public function delete_event(Request $request,$id){
        Events::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => __('Event Delete Success...'),'type'=>'danger']);
    }
public function update_event(Request $request)
{
      // dd($request->description);
    
    $event = Events::findOrFail($request->input('id'));
    // return $event;
    $request->validate([
        'title'             => 'required|string|max:191',
        'category_id'       => 'nullable|integer|exists:events_categories,id',

        'short_description' => 'nullable|string',
        'event_content'     => 'nullable|string',

        'start_date'        => 'required|date',
        'start_time'        => 'nullable',
        'end_date'          => 'nullable|date|after_or_equal:start_date',
        'end_time'          => 'nullable',
        'timezone'          => 'nullable|string|max:100',

        'is_free'           => 'required|boolean',
        'price_amount'      => 'nullable|numeric',
        'price_currency'    => 'nullable|string|max:10',
        'cost_label'        => 'nullable|string|max:255',
        'capacity'          => 'nullable|integer',
        'available_tickets' => 'nullable|integer',
        'tickets'           => 'nullable|string|max:255',

        'registration_required' => 'nullable|boolean',
        'registration_deadline' => 'nullable|date',
        'registration_url'      => 'nullable|string|max:255',

        'organizer'         => 'nullable|string|max:191',
        'organizer_email'   => 'nullable|string|max:191',
        'organizer_phone'   => 'nullable|string|max:191',
        'organizer_whatsapp'=> 'nullable|string|max:191',
        'organizer_website' => 'nullable|string|max:191',

        'venue'             => 'nullable|string|max:191',
        'venue_location'    => 'nullable|string|max:191',
        'venue_address'     => 'nullable|string',
        'venue_city'        => 'nullable|string|max:191',
        'venue_state'       => 'nullable|string|max:191',
        'venue_country'     => 'nullable|string|max:191',
        'venue_phone'       => 'nullable|string|max:191',
        'venue_map_url'     => 'nullable|string|max:255',

        'video_url'         => 'nullable|string|max:255',
        'brochure_url'      => 'nullable|string|max:255',
        'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp,gif',

        'slug'              => 'nullable|string|max:191',
        'status'            => 'required|string|in:draft,published,cancelled,completed',
        'is_featured'       => 'nullable|boolean',
        'show_on_homepage'  => 'nullable|boolean',
        'display_from'      => 'nullable|date',
        'display_to'        => 'nullable|date',

        'meta_title'        => 'nullable|string',
        'meta_tags'         => 'nullable|string',
        'meta_description'  => 'nullable|string',
    ]);

    // Slug unique (ignore current record)
    $proposed = Str::slug($request->filled('slug') ? $request->slug : $request->title);
    $exists   = Events::where('slug', $proposed)->where('id', '!=', $event->id)->exists();
    $slug     = $exists ? $proposed.'-'.substr($event->id, -3) : $proposed;

    // Booleans
    $isFree             = $request->boolean('is_free');
    $isFeatured         = $request->boolean('is_featured');
    $showOnHomepage     = $request->boolean('show_on_homepage');
    $registrationNeeded = $request->boolean('registration_required');

    // Image (keep old if none uploaded)
    $imagePath = $event->image;
    if ($request->hasFile('image')) {
        $file      = $request->file('image');
        $filename  = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $filename  = $filename.'.'.$extension;
        $file->move(public_path('backend/events'), $filename);
        $imagePath = $filename;
    }

    $event->update([
        'title'             => $request->title,
        'slug'              => $slug,
        'category_id'       => $request->category_id,

        'short_description' => $request->short_description,
         'content'           => $request->event_content,
         'description'       => $request->event_content,

        'start_date'        => $request->start_date,
        'start_time'        => $request->start_time,
        'end_date'          => $request->end_date,
        'end_time'          => $request->end_time,
        'timezone'          => $request->timezone ?? 'Asia/Kolkata',

        'is_free'           => $isFree,
        'price_amount'      => $request->price_amount,
        'price_currency'    => $request->price_currency ?? 'INR',
        'cost_label'        => $request->cost_label,
        'capacity'          => $request->capacity,
        'available_tickets' => $request->available_tickets,
        'tickets'           => $request->tickets,
        'cost'              => $request->cost_label ?: ($isFree ? 'Free' : null),

        'registration_required' => $registrationNeeded,
        'registration_deadline' => $request->registration_deadline,
        'registration_url'      => $request->registration_url,

        'organizer'         => $request->organizer,
        'organizer_email'   => $request->organizer_email,
        'organizer_phone'   => $request->organizer_phone,
        'organizer_whatsapp'=> $request->organizer_whatsapp,
        'organizer_website' => $request->organizer_website,

        'venue'             => $request->venue,
        'venue_location'    => $request->venue_location,
        'venue_address'     => $request->venue_address,
        'venue_city'        => $request->venue_city,
        'venue_state'       => $request->venue_state,
        'venue_country'     => $request->venue_country,
        'venue_phone'       => $request->venue_phone,
        'venue_map_url'     => $request->venue_map_url,

        'image'             => $imagePath,
        'video_url'         => $request->video_url,
        'brochure_url'      => $request->brochure_url,

        'status'            => $request->status,
        'is_featured'       => $isFeatured,
        'show_on_homepage'  => $showOnHomepage,
        'display_from'      => $request->display_from,
        'display_to'        => $request->display_to,

        'meta_title'        => $request->meta_title,
        'meta_tags'         => $request->meta_tags,
        'meta_description'  => $request->meta_description,
    ]);

    return redirect()
        ->route('admin.events.all')
        ->with('message', 'Event updated successfully.');
}

    
}




