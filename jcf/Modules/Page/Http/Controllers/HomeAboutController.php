<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Modules\Setting\Entities\Setting;

class HomeAboutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        View::share(['setting' => Setting::first()]);
    }

    protected function path(): string
    {
        return 'home_about.json';
    }

    public function edit()
    {
        $data = ['title' => 'About Us', 'mission' => '', 'vision' => '', 'values' => ''];
        if (Storage::disk('local')->exists($this->path())) {
            $json = json_decode(Storage::disk('local')->get($this->path()), true);
            if (is_array($json)) $data = array_merge($data, $json);
        }
        return view('page::home-about.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $payload = $request->validate([
            'title'   => 'nullable|string|max:120',
            'mission' => 'nullable|string',
            'vision'  => 'nullable|string',
            'values'  => 'nullable|string',
        ]);

        Storage::disk('local')->put($this->path(), json_encode($payload));
        return back()->with('message', 'About section updated');
    }
}

