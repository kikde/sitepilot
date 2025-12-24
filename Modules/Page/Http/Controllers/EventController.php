<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Modules\Page\Entities\Event;
use Modules\Page\Entities\EventCategory;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->orderByDesc('id')->paginate(12);
        $candidates = [
            'ngo::backend.events.all-events',
            'backend.events.all-events',
        ];
        foreach ($candidates as $tpl) {
            if (View::exists($tpl)) {
                return view($tpl, ['all_events' => $events]);
            }
        }
        // Fallback: render directly from package file path if resolver missed it
        $pkg = base_path('packages/jcf/ngo-site/src/resources/views/backend/events/all-events.blade.php');
        if (is_file($pkg)) {
            return View::file($pkg, ['all_events' => $events]);
        }
        $paths = implode("\n - ", (array) View::getFinder()->getPaths());
        abort(500, "Events view not found. Tried: " . implode(', ', $candidates) . "\nView paths:\n - " . $paths . "\nPkg file missing: " . $pkg);
    }

    public function create()
    {
        $candidates = [
            'ngo::backend.events.new-event',
            'backend.events.new-event',
        ];
        $data = [
            'all_categories' => EventCategory::orderBy('title')->get(),
            'event' => null,
        ];
        foreach ($candidates as $tpl) {
            if (View::exists($tpl)) {
                return view($tpl, $data);
            }
        }
        $pkg = base_path('packages/jcf/ngo-site/src/resources/views/backend/events/new-event.blade.php');
        if (is_file($pkg)) {
            return View::file($pkg, $data);
        }
        $paths = implode("\n - ", (array) View::getFinder()->getPaths());
        abort(500, "New-event view not found. Tried: " . implode(', ', $candidates) . "\nView paths:\n - " . $paths . "\nPkg file missing: " . $pkg);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Robust editor fallback: accept either 'description' or 'content'
        if (!array_key_exists('description', $data) && array_key_exists('content', $data)) {
            $data['description'] = $data['content'];
        }
        $v = Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:events,slug',
            'category_id' => 'nullable|integer|exists:events_categories,id',
            'status' => 'nullable|string|max:32',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'image' => 'nullable|image|max:10240',
        ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }

        $desc = $request->input('description', $request->input('content'));
        $payload = [
            'title' => $data['title'],
            'slug' => ($data['slug'] ?? '') ? $data['slug'] : Str::slug($data['title']).'-'.Str::random(4),
            'category_id' => $data['category_id'] ?? null,
            'status' => $data['status'] ?? 'draft',
            'short_description' => $data['short_description'] ?? null,
            'description' => $desc,
            'content' => $desc,
            'start_date' => $data['start_date'] ?? null,
            'start_time' => $data['start_time'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'end_time' => $data['end_time'] ?? null,
            'timezone' => $data['timezone'] ?? 'Asia/Kolkata',
            'is_free' => (int)($data['is_free'] ?? 1) == 1,
            'price_amount' => $data['price_amount'] ?? null,
            'price_currency' => $data['price_currency'] ?? 'INR',
            'tickets' => $data['tickets'] ?? null,
            'capacity' => $data['capacity'] ?? null,
            'available_tickets' => $data['available_tickets'] ?? null,
            'registration_required' => (int)($data['registration_required'] ?? 0) == 1,
            'registration_deadline' => $data['registration_deadline'] ?? null,
            'registration_url' => $data['registration_url'] ?? null,
            'venue' => $data['venue'] ?? null,
            'venue_location' => $data['venue_location'] ?? null,
            'venue_address' => $data['venue_address'] ?? null,
            'venue_city' => $data['venue_city'] ?? null,
            'venue_state' => $data['venue_state'] ?? null,
            'venue_country' => $data['venue_country'] ?? 'India',
            'venue_phone' => $data['venue_phone'] ?? null,
            'venue_map_url' => $data['venue_map_url'] ?? null,
            'video_url' => $data['video_url'] ?? null,
            'brochure_url' => $data['brochure_url'] ?? null,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_tags' => $data['meta_tags'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
        ];

        // Ensure required date has a sensible default if DB column is NOT NULL in some envs
        if (empty($payload['start_date'])) {
            $payload['start_date'] = now()->toDateString();
        }
        if (($payload['category_id'] ?? '') === '') {
            $payload['category_id'] = null;
        }

        if ($request->hasFile('image')) {
            $payload['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($payload);
        return redirect()->route('admin.events.all')->with('message', 'Event created.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail((int)$id);
        $candidates = [
            'ngo::backend.events.edit-event',
            'backend.events.edit-event',
        ];
        $data = [
            'id' => $event->id,
            'event' => $event,
            'all_categories' => EventCategory::orderBy('title')->get(),
        ];
        foreach ($candidates as $tpl) {
            if (View::exists($tpl)) {
                return view($tpl, $data);
            }
        }
        $pkg = base_path('packages/jcf/ngo-site/src/resources/views/backend/events/edit-event.blade.php');
        if (is_file($pkg)) {
            return View::file($pkg, $data);
        }
        $paths = implode("\n - ", (array) View::getFinder()->getPaths());
        abort(500, "Edit-event view not found. Tried: " . implode(', ', $candidates) . "\nView paths:\n - " . $paths . "\nPkg file missing: " . $pkg);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail((int)$id);
        $data = $request->all();
        $v = Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:events,slug,'.$event->id,
            'category_id' => 'nullable|integer|exists:events_categories,id',
            'status' => 'nullable|string|max:32',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'image' => 'nullable|image|max:10240',
        ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }

        // Build payload preserving existing values when inputs are empty (avoid NULLing NOT NULL columns)
        $fields = [
            'title','slug','category_id','status','short_description','description','start_date','start_time','end_date','end_time',
            'timezone','is_free','price_amount','price_currency','tickets','capacity','available_tickets','registration_required',
            'registration_deadline','registration_url','venue','venue_location','venue_address','venue_city','venue_state',
            'venue_country','venue_phone','venue_map_url','video_url','brochure_url','meta_title','meta_tags','meta_description',
        ];
        $payload = [];
        foreach ($fields as $f) {
            $incoming = $data[$f] ?? null;
            // Treat empty strings as "no change" to protect required columns
            if ($incoming === '' || $incoming === null) {
                $payload[$f] = $event->{$f};
            } else {
                $payload[$f] = $incoming;
            }
        }
        // Always respect submitted description/content (allow clearing)
        if (array_key_exists('description', $data)) {
            $payload['description'] = $data['description'];
            $payload['content'] = $data['description'];
        }
        // Coerce booleans
        $payload['is_free'] = (int)($data['is_free'] ?? ($event->is_free ? 1 : 0)) == 1;
        $payload['registration_required'] = (int)($data['registration_required'] ?? ($event->registration_required ? 1 : 0)) == 1;
        // Category empty => null
        if ($payload['category_id'] === '') { $payload['category_id'] = null; }

        if ($request->hasFile('image')) {
            $payload['image'] = $request->file('image')->store('events', 'public');
        }
        $event->update($payload);
        return back()->with('message', 'Event updated.');
    }

    public function delete($id)
    {
        $event = Event::findOrFail((int)$id);
        $event->delete();
        return back()->with('message', 'Event deleted.');
    }

    public function clone(Request $request)
    {
        $id = (int)($request->input('id'));
        $event = Event::findOrFail($id);
        $copy = $event->replicate();
        $copy->slug = Str::slug($event->slug ?: $event->title).'-copy-'.Str::random(4);
        $copy->title = $event->title.' (Copy)';
        $copy->push();
        return back()->with('message', 'Event cloned.');
    }
}
