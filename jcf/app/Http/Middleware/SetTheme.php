<?php

namespace App\Http\Middleware;

use Closure;
use Modules\Setting\Entities\Setting;
use App\Models\Events;

use Illuminate\Support\Facades\View;

class SetTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
       public function handle($request, Closure $next)
    {
        $themes = config('themes');
        $key = $request->route('theme'); // from /demo1, /demo2
        if (!in_array($key, $themes['allowed'] ?? [])) {
            $key = $themes['default'];
        }

        $theme = $themes['map'][$key] ?? $themes['map'][$themes['default']];
        $theme['key'] = $key;

        // Share with all views
        View::share('theme', $theme);

        // Also keep in app() if you like: app()->instance('currentTheme', $theme);

          $setting = Setting::query()->first();
         View::share('setting', $setting);

          $all_events = Events::latest()->get();
          View::share('all_events', $all_events);

        return $next($request);
    }
}
