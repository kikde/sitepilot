<?php

namespace Modules\Volunteer\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Setting\Entities\Setting;

class VolunteerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        View::share(['setting' => Setting::first()]);
    }

    public function index()
    {
        return view('volunteer::index');
    }
}

