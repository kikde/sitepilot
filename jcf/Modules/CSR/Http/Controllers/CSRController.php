<?php

namespace Modules\CSR\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Setting\Entities\Setting;

class CSRController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        View::share(['setting' => Setting::first()]);
    }

    public function index()
    {
        return view('csr::index');
    }
}

