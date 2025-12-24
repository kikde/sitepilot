<?php

namespace Modules\Birthdays\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        Route::middleware('web')
            ->group(module_path('Birthdays', '/Routes/web.php'));
    }
}

