<?php

namespace Jcf\NgoSite\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareNgoViewData
{
    /**
     * Share legacy view data required by JCF blade templates.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = null;
        try {
            if (class_exists(\Modules\Setting\Entities\Setting::class)) {
                $setting = \Modules\Setting\Entities\Setting::query()->first();
            }
        } catch (\Throwable $e) {
            $setting = null;
        }

        if (! $setting) {
            $setting = (object) [
                'title' => config('app.name', 'NGO Site'),
                'meta_author' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'favicon_icon' => '',
            ];
        }

        $dmessage = null;
        try {
            if (class_exists(\Modules\Page\Entities\Page::class)) {
                $dmessage = \Modules\Page\Entities\Page::query()
                    ->where('types', 'DM')
                    ->first();
            }
        } catch (\Throwable $e) {
            $dmessage = null;
        }

        $secmenu = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Sector::class)) {
                $secmenu = \Modules\Page\Entities\Sector::query()
                    ->get(['sector_name', 'id', 'slug', 'pagestatus', 'breadcrumb', 'description', 'pagekeyword']);
            }
        } catch (\Throwable $e) {
            $secmenu = collect();
        }

        if (! $dmessage) {
            $dmessage = (object) [
                'name' => null,
                'breadcrumb' => null,
                'image' => null,
                'description' => null,
            ];
        }

        $theme = [
            'header' => 'style-2',
            'footer' => 'style-2',
            'body_class' => 'red-color',
        ];

        $homebanner = collect();
        try {
            if (Schema::hasTable('home_banners')) {
                $homebanner = DB::table('home_banners')->orderByDesc('id')->get();
            } elseif (Schema::hasTable('homebanner')) {
                $homebanner = DB::table('homebanner')->orderByDesc('id')->get();
            } elseif (Schema::hasTable('banners')) {
                $homebanner = DB::table('banners')->orderByDesc('id')->get();
            }
        } catch (\Throwable $e) {
            $homebanner = collect();
        }

        $whato = collect();
        try {
            if (Schema::hasTable('home_todos')) {
                $whato = DB::table('home_todos')->orderByDesc('id')->get();
            } elseif (Schema::hasTable('home_todo')) {
                $whato = DB::table('home_todo')->orderByDesc('id')->get();
            }
        } catch (\Throwable $e) {
            $whato = collect();
        }

        $newspost = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Post::class)) {
                $newspost = \Modules\Page\Entities\Post::query()->latest()->take(12)->get();
            }
        } catch (\Throwable $e) {
            $newspost = collect();
        }

        $all_events = collect();
        try {
            if (Schema::hasTable('events')) {
                $all_events = DB::table('events')->orderByDesc('id')->limit(12)->get();
            }
        } catch (\Throwable $e) {
            $all_events = collect();
        }

        $members = collect();
        try {
            if (Schema::hasTable('members')) {
                $members = DB::table('members')->orderByDesc('id')->limit(12)->get();
            }
        } catch (\Throwable $e) {
            $members = collect();
        }

        $donors = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Donor::class)) {
                $donors = \Modules\Page\Entities\Donor::query()->latest()->limit(10)->get();
            }
        } catch (\Throwable $e) {
            $donors = collect();
        }

        $faq = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Faq::class)) {
                $faq = \Modules\Page\Entities\Faq::query()->latest()->limit(12)->get();
            }
        } catch (\Throwable $e) {
            $faq = collect();
        }

        $manage = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Manageteam::class)) {
                $manage = \Modules\Page\Entities\Manageteam::query()->latest()->limit(12)->get();
            }
        } catch (\Throwable $e) {
            $manage = collect();
        }

        $testi = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Testimonial::class)) {
                $testi = \Modules\Page\Entities\Testimonial::query()->latest()->limit(12)->get();
            }
        } catch (\Throwable $e) {
            $testi = collect();
        }

        $footermenu = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Sector::class)) {
                $footermenu = \Modules\Page\Entities\Sector::query()
                    ->limit(5)
                    ->get(['sector_name', 'id', 'slug', 'pagestatus']);
            }
        } catch (\Throwable $e) {
            $footermenu = collect();
        }

        $statics = null;
        $award = collect();
        try {
            if (Schema::hasTable('home_award_static')) {
                $statics = DB::table('home_award_static')->first();
            }
            if (Schema::hasTable('home_award_section')) {
                $award = DB::table('home_award_section')->orderByDesc('id')->get();
            }
        } catch (\Throwable $e) {
            $statics = null;
            $award = collect();
        }

        $photos = collect();
        $certificates = collect();
        try {
            if (class_exists(\Modules\Gallery\Entities\Gallery::class)) {
                $photos = \Modules\Gallery\Entities\Gallery::query()
                    ->where('type', 'photo')
                    ->where('share_site', 'gallery')
                    ->latest()
                    ->limit(12)
                    ->get();

                $certificates = \Modules\Gallery\Entities\Gallery::query()
                    ->where('type', 'photo')
                    ->where('share_site', 'certificate')
                    ->latest()
                    ->limit(12)
                    ->get();
            }
        } catch (\Throwable $e) {
            $photos = collect();
            $certificates = collect();
        }

        $story = collect();
        try {
            if (class_exists(\Modules\Page\Entities\SuccessStory::class)) {
                $story = \Modules\Page\Entities\SuccessStory::query()
                    ->latest()
                    ->limit(12)
                    ->get();
            }
        } catch (\Throwable $e) {
            $story = collect();
        }

        $crowdfund = collect();
        $crowdfundStats = [];
        try {
            if (class_exists(\Modules\Page\Entities\Page::class) && Schema::hasTable('pages')) {
                $q = \Modules\Page\Entities\Page::query();
                if (Schema::hasColumn('pages', 'raised_fund')) {
                    $q->whereNotNull('raised_fund')->where('raised_fund', '>', 0);
                } else {
                    $q->whereNotNull('types');
                }
                $crowdfund = $q->latest()->limit(10)->get();
            }

            if (Schema::hasTable('donations') && Schema::hasColumn('donations', 'campaign')) {
                $rows = DB::table('donations')
                    ->select(
                        'campaign',
                        DB::raw('SUM(amount_paise) AS total_paise'),
                        DB::raw('COUNT(DISTINCT donor_id) AS donor_count')
                    )
                    ->whereNotNull('campaign')
                    ->where('campaign', '!=', '')
                    ->where('status', 'paid')
                    ->groupBy('campaign')
                    ->get();

                foreach ($rows as $row) {
                    $crowdfundStats[$row->campaign] = $row;
                }
            }
        } catch (\Throwable $e) {
            $crowdfund = collect();
            $crowdfundStats = [];
        }

        View::share([
            'setting' => $setting,
            'dmessage' => $dmessage,
            'secmenu' => $secmenu,
            'theme' => $theme,
            'homebanner' => $homebanner,
            'whato' => $whato,
            'newspost' => $newspost,
            'all_events' => $all_events,
            'members' => $members,
            'donors' => $donors,
            'faq' => $faq,
            'manage' => $manage,
            'testi' => $testi,
            'footermenu' => $footermenu,
            'statics' => $statics,
            'award' => $award,
            'photos' => $photos,
            'certificates' => $certificates,
            'story' => $story,
            'crowdfund' => $crowdfund,
            'crowdfundStats' => $crowdfundStats,
        ]);

        return $next($request);
    }
}
