<?php

namespace App\Http\Controllers\Admin;
use Modules\Setting\Entities\Setting;
use App\Models\Events;
use App\Models\EventsCategory;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Auth;
use View;

class EventsPageManageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

        $setting = Setting::first();
        View::share(['setting'=>$setting]);
    }
    public function events_page_manage()
    {
        return view(self::BASE_PATH . 'page-manage');
    }

    public function update_events_page_manage(Request $request)
    {

        $this->validate($request, [
            'event_page_bg_image' => 'nullable|string',
        ]);

        $fields = [
            'event_page_bg_image',
        ];
        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }

        return redirect()->back()->with([
            'message' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }
}
