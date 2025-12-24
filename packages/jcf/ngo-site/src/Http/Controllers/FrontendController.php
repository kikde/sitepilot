<?php

namespace Jcf\NgoSite\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Member\Entities\Member;
use Modules\Page\Entities\Banner;
use Modules\Page\Entities\Donor;
use Modules\Page\Entities\Page;
use Modules\Page\Entities\Post;
use Modules\Page\Entities\Sector;
use Modules\Page\Entities\SuccessStory;
use Modules\Page\Entities\SuccessStoryCategory;
use Modules\Page\Entities\Testimonial;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.pages.index');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function managementTeam()
    {
        return view('frontend.pages.management-team');
    }

    public function donors()
    {
        $bannerimg = null;
        try {
            $bannerimg = Banner::query()->where('page_name', 'Donars')->first();
        } catch (\Throwable $e) {
            $bannerimg = null;
        }

        $donars = Donor::query()->latest()->paginate(12)->withQueryString();

        return view('frontend.pages.donors', compact('donars', 'bannerimg'));
    }

    public function members()
    {
        $members = Member::query()->latest()->paginate(12)->withQueryString();

        $memberCount = $members->total();
        $latestMembers = Member::query()->latest()->limit(6)->get();

        return view('frontend.pages.member', compact('members', 'memberCount', 'latestMembers'));
    }

    public function donateNow()
    {
        $getlist = Config::get('constants.state', []);

        return view('frontend.pages.donatenow', compact('getlist'));
    }

    public function crowdfunding()
    {
        $funds = collect();
        try {
            if (class_exists(Page::class) && Schema::hasTable('pages')) {
                $query = Page::query();
                if (Schema::hasColumn('pages', 'raised_fund')) {
                    $query->whereNotNull('raised_fund')->where('raised_fund', '>', 0);
                }
                $funds = $query->latest()->paginate(12)->withQueryString();
            }
        } catch (\Throwable $e) {
            $funds = collect();
        }

        $donationSums = [];
        try {
            if (Schema::hasTable('donations') && Schema::hasColumn('donations', 'campaign') && Schema::hasColumn('donations', 'status')) {
                if (Schema::hasColumn('donations', 'amount_paise')) {
                    $donationSums = DB::table('donations')
                        ->select('campaign', DB::raw('SUM(amount_paise) AS total_paise'))
                        ->whereNotNull('campaign')
                        ->where('campaign', '!=', '')
                        ->where('status', 'paid')
                        ->groupBy('campaign')
                        ->pluck('total_paise', 'campaign')
                        ->toArray();
                } elseif (Schema::hasColumn('donations', 'amount')) {
                    $donationSums = DB::table('donations')
                        ->select('campaign', DB::raw('SUM(amount) AS total'))
                        ->whereNotNull('campaign')
                        ->where('campaign', '!=', '')
                        ->where('status', 'paid')
                        ->groupBy('campaign')
                        ->pluck('total', 'campaign')
                        ->map(fn ($v) => (float) $v * 100)
                        ->toArray();
                }
            }
        } catch (\Throwable $e) {
            $donationSums = [];
        }

        return view('frontend.pages.crowdfunding', compact('funds', 'donationSums'));
    }

    public function crowdfundingDetails(int $id, ?string $slug = null)
    {
        $pagedetails = Page::query()->findOrFail($id);

        if ($slug && $pagedetails->slug && $slug !== $pagedetails->slug) {
            return redirect()->to(url('/crowdfunding/' . $pagedetails->id . '/' . $pagedetails->slug), 301);
        }

        $pages = Page::query()
            ->whereKeyNot($pagedetails->id)
            ->latest()
            ->limit(8)
            ->get();

        $totalDonation = 0.0;
        try {
            if (Schema::hasTable('donations') && Schema::hasColumn('donations', 'campaign') && Schema::hasColumn('donations', 'status')) {
                $campaignKey = $pagedetails->slug ?? null;
                if ($campaignKey) {
                    if (Schema::hasColumn('donations', 'amount_paise')) {
                        $paise = (float) DB::table('donations')
                            ->where('campaign', $campaignKey)
                            ->where('status', 'paid')
                            ->sum('amount_paise');
                        $totalDonation = $paise / 100;
                    } elseif (Schema::hasColumn('donations', 'amount')) {
                        $totalDonation = (float) DB::table('donations')
                            ->where('campaign', $campaignKey)
                            ->where('status', 'paid')
                            ->sum('amount');
                    }
                }
            }
        } catch (\Throwable $e) {
            $totalDonation = 0.0;
        }

        return view('frontend.pages.crowdfunding-details', compact('pagedetails', 'pages', 'totalDonation'));
    }

    public function complainForm()
    {
        return view('frontend.pages.complain-form');
    }

    public function newsIndex()
    {
        $newspost = Post::query()->latest()->paginate(10)->withQueryString();

        return view('frontend.pages.news-post', compact('newspost'));
    }

    public function newsDetails(int $id, ?string $slug = null)
    {
        $newspost = Post::query()->findOrFail($id);

        if ($slug && $newspost->slug && $slug !== $newspost->slug) {
            return redirect()->to(url('/news-details/' . $newspost->id . '/' . $newspost->slug), 301);
        }

        $recentPosts = Post::query()
            ->whereKeyNot($newspost->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('frontend.pages.news-details', compact('newspost', 'recentPosts'));
    }

    public function objectiveDetails(int $id, ?string $slug = null)
    {
        $sectorpage = Sector::query()->findOrFail($id);

        if ($slug && $sectorpage->slug && $slug !== $sectorpage->slug) {
            return redirect()->to(url('/objective-details/' . $sectorpage->id . '/' . $sectorpage->slug), 301);
        }

        $sectors = Sector::query()->orderBy('sector_name')->get();

        return view('frontend.pages.sector_details', compact('sectorpage', 'sectors'));
    }

    public function successStories()
    {
        $story = SuccessStory::query()->with('category')->latest()->paginate(10)->withQueryString();
        $categ = SuccessStoryCategory::query()->orderBy('name')->get();
        $new = SuccessStory::query()->latest()->limit(6)->get();

        return view('frontend.pages.success-story.success_story', compact('story', 'categ', 'new'));
    }

    public function successStoryDetails(int $id, ?string $slug = null)
    {
        $detail = SuccessStory::query()->with('category')->findOrFail($id);

        if ($slug && $detail->slug && $slug !== $detail->slug) {
            return redirect()->to(url('/success-story-details/' . $detail->id . '/' . $detail->slug), 301);
        }

        $categ = SuccessStoryCategory::query()->orderBy('name')->get();
        $newpro = SuccessStory::query()->with('category')->latest()->limit(6)->get();

        return view('frontend.pages.success-story.success-story-single', compact('detail', 'categ', 'newpro'));
    }

    public function successStoriesByCategory(int $id)
    {
        $story = SuccessStory::query()
            ->with('category')
            ->where('success_story_category_id', $id)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categ = SuccessStoryCategory::query()->orderBy('name')->get();
        $new = SuccessStory::query()->latest()->limit(6)->get();

        return view('frontend.pages.success-story.success_story', compact('story', 'categ', 'new'));
    }

    public function terms()
    {
        // Prefer type-based lookup used in legacy admin: types = 'TC'
        $term = Page::query()->where('types', 'TC')->first();
        if (!$term || empty($term->description)) {
            $fallback = $this->findStaticPage(['terms-and-conditions', 'terms'], ['Terms', 'Terms & Conditions']);
            $term = $fallback ?: $term;
        }
        $review = Testimonial::query()->latest()->limit(12)->get();

        return view('frontend.pages.terms', compact('term', 'review'));
    }

    public function privacy()
    {
        // Prefer type-based lookup: types = 'PP'
        $privacy = Page::query()->where('types', 'PP')->first();
        if (!$privacy || empty($privacy->description)) {
            $fallback = $this->findStaticPage(['privacy-policy', 'privacy'], ['Privacy Policy']);
            $privacy = $fallback ?: $privacy;
        }
        $review = Testimonial::query()->latest()->limit(12)->get();

        return view('frontend.pages.policy', compact('privacy', 'review'));
    }

    public function cancellationsAndRefunds()
    {
        // Prefer type-based lookup: types = 'CRP' (Cancellation & Refund Policy)
        $term = Page::query()->where('types', 'CRP')->first();
        if (!$term || empty($term->description)) {
            $fallback = $this->findStaticPage(
                ['cancellation-and-refund-policy', 'cancellations-and-refunds'],
                ['Cancellations & Refunds Policy', 'Cancellation And Refund Policy']
            );
            $term = $fallback ?: $term;
        }
        $review = Testimonial::query()->latest()->limit(12)->get();

        return view('frontend.pages.terms', compact('term', 'review'));
    }

    private function findStaticPage(array $slugs, array $names)
    {
        $base = Page::query();

        // 1) Exact slug with non-empty description (prefer Published)
        foreach ($slugs as $slug) {
            $page = (clone $base)
                ->where('slug', $slug)
                ->when(\Schema::hasColumn('pages', 'pagestatus'), function ($q) { $q->where('pagestatus', 'Published'); })
                ->whereNotNull('description')
                ->whereRaw("TRIM(description) <> ''")
                ->first();
            if ($page) return $page;
        }

        // 2) Exact name with non-empty description
        foreach ($names as $name) {
            $page = (clone $base)
                ->where('name', $name)
                ->when(\Schema::hasColumn('pages', 'pagestatus'), function ($q) { $q->where('pagestatus', 'Published'); })
                ->whereNotNull('description')
                ->whereRaw("TRIM(description) <> ''")
                ->first();
            if ($page) return $page;
        }

        // 3) Fuzzy name match LIKE
        if (!empty($names)) {
            $page = (clone $base)
                ->when(\Schema::hasColumn('pages', 'pagestatus'), function ($q) { $q->where('pagestatus', 'Published'); })
                ->whereNotNull('description')
                ->whereRaw("TRIM(description) <> ''")
                ->where(function ($q) use ($names) {
                    foreach ($names as $n) {
                        $q->orWhere('name', 'LIKE', '%'.trim($n).'%');
                    }
                })
                ->latest('id')
                ->first();
            if ($page) return $page;
        }

        // 4) Last-resort placeholder; blades provide defaults
        return (object) [
            'name' => $names[0] ?? 'Page',
            'breadcrumb' => null,
            'description' => null,
        ];
    }

    public function donations()
    {
        $rows = collect();
        try {
            if (class_exists(\Modules\Page\Entities\Donation::class)) {
                $rows = \Modules\Page\Entities\Donation::query()
                    ->with('donor')
                    ->where('status', 'paid')
                    ->latest()
                    ->paginate(12)
                    ->withQueryString();
            }
        } catch (\Throwable $e) {
            $rows = collect();
        }

        return view('frontend.pages.donations', compact('rows'));
    }
}
