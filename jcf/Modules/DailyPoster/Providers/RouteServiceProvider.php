<?php

namespace Modules\DailyPoster\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        Route::middleware('web')
            ->group(module_path('DailyPoster', '/Routes/web.php'));
    }
}

