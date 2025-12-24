<?php

namespace Modules\Watermark\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Setting\Entities\Setting;

class WatermarkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        View::share(['setting' => Setting::first()]);
    }

    public function index()
    {
        return view('watermark::index');
    }
}

