<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        return view('coreauth::dashboard');
    }
}

