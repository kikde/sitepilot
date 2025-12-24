<?php

// app/Providers/ViewServiceProvider.php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Setting\Entities\Setting;
use Modules\Page\Entities\Sector;
use Modules\Page\Entities\Testimonial;
use Modules\Page\Entities\Manageteam;
use App\Models\Events;
use App\Models\StaticData;
use App\Models\AwardSection;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Compose only header/footer partials (avoid loading on every view)
        View::composer([
            'frontend.partials.header.*',
            'frontend.partials.footer.*',
        ], function ($view) {
            $setting    = cache()->remember('site_setting', 300, fn() => Setting::first());
            $secmenu    = cache()->remember('secmenu', 300, fn() => Sector::get(['sector_name','id','slug','pagestatus','breadcrumb','description','pagekeyword']));
            $footermenu = cache()->remember('footermenu', 300, fn() => Sector::limit(5)->get(['sector_name','id','slug','pagestatus']));
            $testi      = cache()->remember('testimonials6', 300, fn() => Testimonial::latest()->limit(6)->get());
            $manage     = cache()->remember('manage8', 300, fn() => Manageteam::latest()->limit(8)->get());
            $statics    = cache()->remember('statics_first', 300, fn() => StaticData::first());
            $award      = cache()->remember('awards', 300, fn() => AwardSection::get());
            $all_events = cache()->remember('events', 300, fn() => Events::latest()->get());
            

            $view->with(compact('setting','secmenu','footermenu','testi','manage','statics','award', 'all_events'));
        });
    }
}
 