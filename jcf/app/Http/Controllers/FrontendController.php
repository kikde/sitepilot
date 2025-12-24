<?php

namespace App\Http\Controllers;
// use Modules\Member\Entities\Member;
use App\Models\Frontend;
use Modules\Setting\Entities\Setting;
use Modules\Member\Entities\Category;
use Modules\Page\Entities\Sector;
use Modules\Page\Entities\Faq;
use Modules\Page\Entities\Donor;
use Modules\Page\Entities\Banner;
use Modules\Page\Entities\Testimonial;
use Modules\Page\Entities\Manageteam;
use Modules\Gallery\Entities\Gallery;
use App\Mail\UserMail;
use App\Mail\ComplaintThanksMail;

use Modules\Page\Entities\SuccessStory;
use Modules\Page\Entities\SuccessStoryCategory;
use Modules\Page\Entities\Page;
use Modules\Page\Entities\Post;
use Modules\Page\Entities\Bank;
use Modules\Page\Entities\Donation;
use Illuminate\Support\Facades\DB;
use Mail;
use View;
use Config;
// use Image;
// use Auth;
// use Storage;
// use GuzzleHttp\Client;
use App\Models\User;
use App\Models\HomeBanner;
use App\Models\TodoSection;
use App\Models\StaticData;
use App\Models\AwardSection;
use Modules\Partner\Entities\Partner;
use App\Models\Events;

use Illuminate\Http\Request;
use Modules\Setting\Entities\EmailTemplate;
use Notification;
use App\Notifications\DbStoreNotification;
use App\Utility\EmailUtility;

class FrontendController extends Controller
{

    public function __construct()
    {
        $res_query = Sector::query();
        $setting = Setting::first();
        $secmenu = $res_query->get(['sector_name','id', 'slug','pagestatus', 'breadcrumb','description', 'pagekeyword']);
        $footer = Sector::query();
        $testi = Testimonial::latest()->limit(6)->get();
        $manage = Manageteam::latest()->limit(8)->get();
        $statics = StaticData::first();
        $award = AwardSection::get();
        $footermenu = $footer->limit(5)->get(['sector_name','id', 'slug','pagestatus']);
        $dmessage  =  Page::where('types', "DM")->first();
        // Provide a safe default object so views never error if DM page is removed
        if (!$dmessage) {
            $dmessage = (object) [
                'name' => null,
                'breadcrumb' => null,
                'image' => null,
                'description' => null,
            ];
        }
        View::share([
            'setting'=>$setting,
            'secmenu' =>$secmenu,
            'testi' =>$testi,
            'footermenu' =>$footermenu,
            'manage'=>$manage,
            'statics'=>$statics,
            'award'=>$award,
            'dmessage'=>$dmessage
        ]);
    }

    public function getData(){

        return ['name' => 'sara'];
    }

    public function postData(Request $req){


        return ['url' => $req->url];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //--------------------------------------Cleaned Page Start---------------------------------------------//

   public function showTerms()
    {
        $term = Page::where('types', "TC")->first();

        $review = Testimonial::get();
        return view('frontend.pages.terms', compact('review', 'term'));
    }


     public function showPrivacyPolicy()
    {
        $privacy = Page::where('types', "PP")->first();
        $review = Testimonial::get();
        return view('frontend.pages.policy', compact('review', 'privacy'));
    }

     public function showrefundPolicy()
    {
        $privacy = Page::where('types', "CRP")->first();
        $review = Testimonial::get();
        return view('frontend.pages.policy', compact('review', 'privacy'));
    }
    
      public function showShipping()
    {
        $privacy = Page::where('types', "SP")->first();
        $review = Testimonial::get();
        return view('frontend.pages.policy', compact('review', 'privacy'));
    }
   

   public function showDonors()
    {

        $donars = Donor::latest()->paginate(6);
        $bannerimg = Banner::where('page_name', 'Donars')->first();
        return view('frontend.pages.donors', compact('donars', 'bannerimg'));
    }


    public function showFaqs()
    {
        $videos = Gallery::where('type', 'video')->get();
        $faq = Faq::limit(4)->get();
        return view('frontend.pages.faq', compact('faq', 'videos'));
    }


     public function showManagementBody()
    {

        $ManagementBody = Sector::limit(4)->get();
        return view('frontend.pages.management-team', compact('ManagementBody'));
    }

    public function showMembers()
    {
        $categories = Category::get();
       $base = User::where(function ($q) {
            $q->where('role', 2)
            ->orWhere('useractive', 1);
        })->where('role', '!=', 1);

        $memberCount   = (clone $base)->count();
        $members       = (clone $base)->paginate(9);
        $latestMembers = (clone $base)->latest()->limit(3)->get();

        return view('frontend.pages.member', compact('members', 'categories', 'latestMembers', 'memberCount'));
    }
     //=====================================================EVENTS=============================================//
        public function showEvents()
    {

        $event = Events::where('status', 'published')->latest()->paginate(10);
        return view('frontend.partials.events.style-1', compact('event'));
    }

       public function event_Details($id, $slug = null)
    {

        $event = Events::where('status', 'published')->findOrFail($id);

       if($slug !== $event->slug) {
        return redirect()->to(url('/event-details/'.$event->id.'/'.$event->slug), 301);
      }

    $relatedEvents = Events::where('status','published')
        ->where('id','!=',$event->id)
        ->latest()
        ->take(5)
        ->get();

    return view('frontend.pages.event_details', compact('event','relatedEvents'));
    
    }

    
    
       public function complainForm()
    {

        return view('frontend.pages.complain-form');
    }

//--------------------------------------Cleaned Page End---------------------------------------------//
protected function getHomepageCrowdfundData(): array
{
    // 1) Get CF pages (no paginate on home)
    $crowdfund = Page::where('types', 'CF')
        ->where('pagestatus', 'Published')
        ->latest()
        ->get();

    // 2) Collect slugs from this result
    $slugs = $crowdfund->pluck('slug')->filter()->all();

    // 3) Get total paid donations + paid donor count per campaign (campaign = slug)
    $stats = Donation::whereIn('campaign', $slugs)
        ->where('status', 'paid')   // ✅ only paid donations
        ->selectRaw('campaign, SUM(amount_paise) as total_paise, COUNT(*) as donor_count')
        ->groupBy('campaign')
        ->get()
        ->keyBy('campaign');        // ['slug' => model with total_paise, donor_count]

    return [
        'crowdfund'      => $crowdfund,
        'crowdfundStats' => $stats,
    ];
}


  protected function loadHomepageData(): array
{
     $base = [
        'story'      => SuccessStory::latest()->take(4)->get(),
        'photos'     => Gallery::where('type','photo')->where('share_site', 'gallery')->where('status','published')->get(),
        'certificates' => Gallery::where('type', 'photo')->where('share_site', 'certificate')->where('status', 'Published')->latest()->take(8)->get(),
        'homebanner' => HomeBanner::where('status','published')->get(),
        'members'    => User::where('role',2)->where('useractive',1)->inRandomOrder()->take(20)->get(),
        'whato'      => TodoSection::where('status','published')->get(),
        'partner'    => Partner::latest()->get(),
        'all_events' => Events::where('status', 'published')->latest()->take(4)->get(),
        'newspost'   => Post::where('pagestatus','published')->latest()->take(4)->get(),
        'dmessage'  =>  Page::latest()->where('types', "DM")->first(),
        'donors'   => Donor::latest()->take(4)->get(),

    ];

      $extra = [
        'faq' => Faq::latest()->take(4)->get(),
    ];

     // merge base data with crowdfunding data
    return array_merge($base, $this->getHomepageCrowdfundData(), $extra);
}

public function index()
{
    return view('frontend.pages.index', $this->loadHomepageData());
}

public function demoNumeric(int $num)
{
    $view = "frontend.pages.demo-{$num}";
    abort_unless(\View::exists($view), 404);
    return view($view, array_merge($this->loadHomepageData(), [
        'slug' => "demo-{$num}",
        'num'  => $num,
    ]));
}

public function demo(string $slug)
{
    if (preg_match('/^demo(\d+)$/', $slug, $m)) $slug = "demo-{$m[1]}";

    $allowed = [
        'demo-1' => 'frontend.pages.demo-1',
        'demo-2' => 'frontend.pages.demo-2',
        'demo-3' => 'frontend.pages.demo-3',
        // add others...
    ];
    abort_unless(isset($allowed[$slug]), 404);

    return view($allowed[$slug], array_merge($this->loadHomepageData(), [
        'slug' => $slug,
    ]));
}

   //==========================================New Registration ================================//
    public function userRegister()  {


        $getlist = Config::get('constants.state');
        return view('frontend.pages.registration', compact('getlist'));
    }

    public function getcity(Request $request)
    {

       $getlist = Config::get('constants.state');

       $result= $getlist[$request->sid];

       $html='<option value="">Select City</option>';
       foreach($result as $list){

           $html.='<option value="'.$list.'">'.$list.'</option>';
       }
       return $html;

    } 
    public function fetchCitiesByState(Request $request)
{
    $request->validate(['sid' => 'required|string']);

    $getlist = Config::get('constants.state', []);
    $cities  = $getlist[$request->sid] ?? [];

    $html = '<option value="">Select City</option>';

    foreach ($cities as $city) {
        $html .= '<option value="'.$city.'">'.$city.'</option>';
    }

    return response($html);
}

    // public function newMember(Request $request){

    //     // return $request;
    //     $list = new Product;

    //         if ($request->hasFile('uploadfile')) {
    //         $this->Uploadfile($request,$list);
    //     }

    //     if(Product::where('id','!=' ,$request->id)->where('mobile', $request->mobile)->count()>0){
    //         return redirect()->back()->with('notfound','Mobile Already Exist');
    //     }
    //     if(Product::where('id','!=' ,$request->id)->where('email', $request->email)->count()>0){
    //         return redirect()->back()->with('notfound','Email Already Exist');
    //     }

    //     $password = Auth::user()->password;

    //     $list->user_id = Auth::user()->id;

    //     $list->name = $request->name;
    //     $list->gender = $request->gender;
    //     $list->dob = $request->dob;
    //     $list->father_name = $request->father_name;
    //     $list->profession = $request->profession;
    //     $list->bloodgroup = $request->bloodgroup;
    //     $list->state = $request->state;
    //     $list->city = $request->city;
    //     $list->mobile = $request->mobile;
    //     $list->email = $request->email;
    //     $list->address = $request->address;
    //     $list->pincode = $request->pincode;
    //     $list->idtype = $request->idtype;
    //     $list->page_title = $request->page_title;
    //     $list->page_keyword = $request->page_keyword;
    //     $list->slug = $request->slug;
    //     $list->status = $request->status;

    //     if ($request->hasFile('images')) {
    //         $postimage = $request->file('images');
    //         $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
    //         Image::make($postimage)->save(public_path('/backend/uploads/'. $filename));

    //         $list->images = $filename;

    //     }
    //     if ($request->hasFile('document')) {
    //       $postimage = $request->file('document');
    //       $banner = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
    //       Image::make($postimage)->save(public_path('/backend/uploads/'. $banner));

    //       $list->document = $banner;
    //     }

    //       // return $list;
    //      $list->save();

    //      if ($request->email != null  && env('MAIL_USERNAME') != null) {
    //         $account_oppening_email = EmailTemplate::where('identifier', 'account_oppening_email')->first();
    //         if ($account_oppening_email->status == 1) {
    //          EmailUtility::account_oppening_email($list->id);

    //         }
    //     }
    //     return redirect()->back()->with('message', 'Please Contact Admin for Your ID Card Activation!!');


    // }



    //============================================================Donate Now============================================================//

    public function userDonate(){
        
        $banks = Bank::get();
        $donors   = Donor::latest()->take(4)->get();
        $getlist = Config::get('constants.state');
        return view('frontend.pages.donatenow', compact('getlist', 'banks', 'donors'));
    }




//=========================================================SendMail=====================================================================//
    public function sendmail(Request $request)
{
    // Basic validation
    $request->validate([
        'name'    => 'required|string|max:255',
        'mobile'  => ['required','regex:/^[6-9]\d{9}$/'],
        'email'   => 'required|email',
        'address' => 'required|string',
        'message' => 'required|string',
        'file1'   => 'nullable|file|max:5120',
        'file2'   => 'nullable|file|max:5120',
    ]);

    $mailform = $request;

    // 1) Send to admin
    Mail::to(env('MAIL_TO'))->send(new UserMail($mailform));

    // 2) Send confirmation to user
    Mail::to($request->email)->send(new ComplaintThanksMail($mailform));

    // 3) Redirect back with thank-you message
    return redirect()
        ->back()
        ->with('message', 'Thank you! Your complaint has been submitted successfully.');
}


//===============================================Members====================================//

    public function productby($id){
        // return $id;
        $cate = Category::get();
        $new = User::where('role', 2)->orwhere('useractive', 1)->latest()->limit(3)->get();
        $pro = Product::where('category_id', $id)->paginate(6);

        return view('frontend.pages.member', compact('pro', 'cate','new'));

    }

    public function new_product(){

        $cate = Category::get();
        $new = User::where('role', 2)->orwhere('useractive', 1)->latest()->limit(3)->get();
        $pro = User::where('role', 2)->orwhere('useractive', 1)->latest()->limit(3)->paginate(3);

        return view('frontend.pages.member', compact('pro', 'cate','new'));

    }


    public function searchproduct(Request $request){

        $search = $request->get('searchinput');

        $cate = Category::get();
        $new = User::where('role', 2)->latest()->limit(3)->get();

        $pro = User::Where('name', 'like', '%' . $search . '%')
                            ->orWhere('mobile', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%')
                            ->orWhere('dob', 'like', '%' . $search . '%')
                            ->paginate(9);

         return view('frontend.pages.member', compact('pro', 'cate','new'));

    }




    public function query($id){


        // $id = $request->id;
        $new = User::latest()->limit(3)->get();
        $cate = Category::get();

        $ids = str_split(str_replace(',', '', $id));

        $pro = User::whereIn('id', $ids)->paginate(9);


        return view('frontend.pages.member', compact('pro', 'cate','new'));



    }

//=============================================About Section===================================================//

    public function aboutUs()
    {
       
        return view('frontend.pages.about');
    }

    public function newsPost()
        {
            // paginate only (limit+paginate together is pointless)
            $newspost = Post::where('pagestatus', 'Published')
                ->latest()
                ->paginate(10); // 9 per page, adjust as you like

            return view('frontend.pages.news-post', compact('newspost'));
        }

    public function news_Details($id, $slug = null)
    {
        // Ensure we only fetch published posts
        $newspost = Post::where('pagestatus', 'Published')
            ->where('id', $id)
            ->firstOrFail();

        // Optional: if slug mismatch, redirect to canonical URL
        if ($slug !== $newspost->slug) {
            return redirect()->to(url('/news-post/'.$newspost->id.'/'.$newspost->slug), 301);
        }

        // Recent posts (sidebar)
        $recentPosts = Post::where('pagestatus', 'Published')
            ->where('id', '!=', $newspost->id)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.pages.news-details', compact('newspost', 'recentPosts'));
    }

  //=================================================Crawdfunding======================================//

    public function showfunding()
        {
            // 1) Get CF pages
        $funds = Page::where('types', 'CF')
            ->where('pagestatus', 'Published')
            ->latest()
            ->paginate(10);

        // 2) Collect slugs from this page of results
        $slugs = $funds->pluck('slug')->filter()->all();

        // 3) Get total paid donations per campaign (campaign = slug)
        $donationSums = Donation::whereIn('campaign', $slugs)
            ->where('status', 'paid')               // only successful
            ->selectRaw('campaign, SUM(amount_paise) as total_paise')
            ->groupBy('campaign')
            ->pluck('total_paise', 'campaign');     // ['slug' => total_paise]

        return view('frontend.partials.crowdfunding.style-2', [
            'funds'         => $funds,
            'donationSums'  => $donationSums,
        ]);
   }
  public function fund_Details($id, $slug = null)
{
    // 1) Get this campaign
    $fund = Page::where('types', 'CF')
        ->where('pagestatus', 'Published')
        ->findOrFail($id);

    // 2) Canonical slug redirect
    if ($slug !== $fund->slug) {
        return redirect()->to(
            url('/crowdfunding/'.$fund->id.'/'.$fund->slug),
            301
        );
    }

    // 3) Donation summary
    $raisedPaise  = Donation::where('campaign', $fund->slug)
        ->where('status', 'paid')
        ->sum('amount_paise');

    $raisedRupees = round($raisedPaise / 100);
    $target       = $fund->raised_fund ?? 0;
    $percent      = $target > 0
        ? min(100, round(($raisedRupees / $target) * 100))
        : 0;

    $donorsCount  = Donation::where('campaign', $fund->slug)
        ->where('status', 'paid')
        ->count();

    // 4) Related campaigns (sidebar)
    $relatedFunds = Page::where('types', 'CF')
        ->where('pagestatus', 'Published')
        ->where('id', '!=', $fund->id)
        ->latest()
        ->take(5)
        ->get();

    return view('frontend.pages.crowdfunding', [
        'fund'         => $fund,
        'raisedRupees' => $raisedRupees,
        'target'       => $target,
        'percent'      => $percent,
        'donorsCount'  => $donorsCount,
        'relatedFunds' => $relatedFunds,
    ]);
}
//=================================================Crawdfunding END======================================//

    public function successStory()
    {
       $categ = SuccessStoryCategory::get();
       $story = SuccessStory::where('status', 'Published')->paginate(6);
       $new = SuccessStory::latest()->limit(3)->get();
        // return $id;
      return view('frontend.pages.success-story.success_story', compact('story','categ','new'));
    }

    public function story_Details($id)
    {
        $categ = SuccessStoryCategory::get();
        $detail = SuccessStory::find($id);

        $newpro = SuccessStory::latest()->limit(4)->get();
        return view('frontend.pages.success-story.success-story-single', compact('detail', 'newpro', 'categ'));
    }

    public function latestStory(){

        $categ = SuccessStoryCategory::get();
        $new = SuccessStory::latest()->limit(3)->get();
        $pro = SuccessStory::latest()->limit(3)->paginate(3);

        return view('frontend.pages.success-story.success_story', compact('pro', 'categ','new'));

    }

    public function searchStory(Request $request){

        $search = $request->get('searchinput');

        $categ = SuccessStoryCategory::get();
        $new = SuccessStory::latest()->limit(3)->get();

        $pro = SuccessStory::Where('title', 'like', '%' . $search . '%')
                            ->orWhere('slug', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%')
                            ->orWhere('content', 'like', '%' . $search . '%')
                            ->paginate(9);

         return view('frontend.pages.success-story.success_story', compact('pro', 'categ','new'));

    }

    public function supportTicket(){

        return view('frontend.auth.login');
    }

    public function supportStore(){
        $getlist = Config::get('constants.state');
        return view('frontend.auth.register', compact('getlist'));
    }

  //================================================About Section End=============================================//


    public function contactus()
    {
        return view('frontend.pages.contact');
    }


    public function notfound()
    {
        return view('frontend.pages.404');
    }







//================================================Media Gallery==========================================//
    public function mediaPhoto(Request $request)
    {
         // default tab = gallery
    $site = $request->get('share_site', 'gallery');

    $q = Gallery::query()
        ->where('type', 'photo')
        ->where('status', 'published')
        // Strict gallery
        ->when($site === 'gallery', fn($qq) => $qq->where('share_site', 'gallery'))
        // Any other tab like certificate/project
        ->when($site !== 'gallery', fn($qq) => $qq->where('share_site', $site));

    // keep query string on pagination
    $photos = $q->paginate(9)->appends($request->query());

    return view('frontend.pages.photo', [
        'photos'     => $photos,
        'share_site' => $site,
    ]);
    }



    public function mediaVideo()
    {
        $videos = Gallery::where('type', 'video')->where('status', 'published')->paginate(9);
        return view('frontend.pages.media',compact('videos'));
    }


//--------------------------------Services Page------------------------------//

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function create($id)
    {
        $sectors = Sector::limit(8)->get();
        $sectorpage = Sector::find($id);
        return view('frontend.pages.sector_details', compact('sectorpage', 'sectors'));
    }


//--------------------------------Services Page end------------------------------//

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function show(Frontend $frontend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function edit(Frontend $frontend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frontend $frontend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frontend $frontend)
    {
        //
    }
}
