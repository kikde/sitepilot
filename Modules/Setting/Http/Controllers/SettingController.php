<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Mail\BasicMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;


use Image;
use View;

class SettingController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
         if (! app()->runningInConsole()) {
             try {
                 $setting = Setting::first();
             } catch (\Throwable $e) {
                 $setting = null;
             }
             View::share(['setting' => $setting]);
         }
        //  $this->middleware('permission:general-settings-smtp-settings',['only'=>['smtp_settings','update_smtp_settings','test_smtp_settings']]);
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $settings = Setting::first();
        return view('setting::index', compact('settings'));
        // return view('setting::index');
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        // $this->validate($request, [
        //     'name' => 'required',
        //     'site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
        // ]);
           
        $set =  Setting::first();

        if ($request->hasFile('site_logo')) {
            $postimage = $request->file('site_logo');
            $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->resize(600, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/backend/uploads/'. $filename));
            
            $set->site_logo = $filename;
            // return $filename;
        } 
        if($request->hasFile('favicon_icon')){
            $postimage = $request->file('favicon_icon');
            $filename = $request->id . '_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/backend/icons/'. $filename));
            $set->favicon_icon = $filename;
        }
            if($request->hasFile('company_stamp')){
            $postimage = $request->file('company_stamp');
            $filename = $request->id . '_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->resize(600, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/backend/uploads/'. $filename));
            $set->company_stamp = $filename;
        }

        $set->site_url = $request->site_url;
        $set->site_email = $request->site_email;
        $set->title = $request->title;
        $set->meta_keywords = $request->meta_keywords;
        $set->meta_description = $request->meta_description;
        $set->meta_author = $request->meta_author;
        $set->address = $request->address;
        $set->phone = $request->phone;
        $set->language = $request->language;
        $set->company_no = $request->company_no;
        $set->pan_no  = $request->pan_no;
        $set->tan_no = $request->tan_no;
        $set->cin_no = $request->cin_no;
        $set->reg_no = $request->reg_no;
        $set->facebook_url = $request->facebook_url;        
        $set->insta_url = $request->insta_url; 
        $set->linkdin_url = $request->linkdin_url; 
        $set->twitter = $request->twitter; 
         $set->youtube = $request->youtube; 
        $set->save();
        return redirect()->back()->with('message','Updated Setting Successfully!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
    
    
    //===========================================Payment Gatwaye-------------------------------------------------------//

public function editPayment()
    {
        return view('setting::razorpay', [
            'razorpay_active' => env('RAZORPAY_ACTIVE', false),
            'razorpay_key_id' => env('RAZORPAY_KEY_ID', ''),
            'razorpay_key_secret' => env('RAZORPAY_KEY_SECRET', ''),
        ]);
    }

    public function updatePayment(Request $request)
    {
        $request->validate([
            'razorpay_key_id'     => 'required|string',
            'razorpay_key_secret' => 'required|string',
        ]);

        $active = $request->has('razorpay_active') ? 'true' : 'false';

        $this->setEnv('RAZORPAY_ACTIVE', $active);
        $this->setEnv('RAZORPAY_KEY_ID', $request->razorpay_key_id);
        $this->setEnv('RAZORPAY_KEY_SECRET', $request->razorpay_key_secret);

        // refresh config cache if you use it
        try {
            Artisan::call('config:clear');
        } catch (\Throwable $e) {}

        return back()->with('success', 'Razorpay settings updated successfully.');
    }

    protected function setEnv($key, $value)
    {
        $path = base_path('.env');

        if (!file_exists($path)) {
            return;
        }

        $value = str_replace('"', '\"', $value);

        $env = file_get_contents($path);

        if (preg_match("/^{$key}=.*/m", $env)) {
            // replace existing
            $env = preg_replace(
                "/^{$key}=.*/m",
                "{$key}=\"{$value}\"",
                $env
            );
        } else {
            // add new
            $env .= PHP_EOL."{$key}=\"{$value}\"";
        }

        file_put_contents($path, $env);
    }


//==================================================================SMTP Setting=======================================================//


public function update_smtp_settings(Request $request)
{
//    return $request;
    // $this->validate($request, [
    //     'site_smtp_mail_host' => 'required|string',
    //     'site_smtp_mail_mailer' => 'required|string',
    //     'site_smtp_mail_port' => 'required|string',
    //     'site_smtp_mail_username' => 'required|string',
    //     'site_smtp_mail_password' => 'required|string',
    //     'site_smtp_mail_encryption' => 'required|string'
    // ]);

    $fields = [
        'site_smtp_mail_mailer',
        'site_smtp_mail_host',
        'site_smtp_mail_port',
        'site_smtp_mail_username',
        'site_smtp_mail_password',
        'site_smtp_mail_encryption',
    ];
    foreach ($fields as $field) {
        update_static_option($field, $request->$field);
    }
    $env_val['MAIL_MAILER'] = !empty($request->site_smtp_mail_mailer) ? $request->site_smtp_mail_mailer : 'smtp';
    $env_val['MAIL_HOST'] = !empty($request->site_smtp_mail_host) ? $request->site_smtp_mail_host : 'YOUR_SMTP_MAIL_HOST';
    $env_val['MAIL_PORT'] = !empty($request->site_smtp_mail_port) ? $request->site_smtp_mail_port : 'YOUR_SMTP_MAIL_POST';
    $env_val['MAIL_USERNAME'] = !empty($request->site_smtp_mail_username) ? $request->site_smtp_mail_username : 'YOUR_SMTP_MAIL_USERNAME';
    $env_val['MAIL_PASSWORD'] = !empty($request->site_smtp_mail_password) ? $request->site_smtp_mail_password : 'YOUR_SMTP_MAIL_USERNAME_PASSWORD';
    $env_val['MAIL_ENCRYPTION'] = !empty($request->site_smtp_mail_encryption) ? $request->site_smtp_mail_encryption : 'YOUR_SMTP_MAIL_ENCRYPTION';

    setEnvValue($env_val);

    return redirect()->back()->with('message','Updated Smtp Setting Successfully!');
}


public function test_smtp_settings(Request $request){

    // return $request;
    $request->validate([
        'subject' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'message' => 'required|string',
    ]);
    // $res_data = [
    //     'msg' => __('Mail Send Success'),
    //     'type' => 'success'
    // ];

    $maildata = [
    'subject' => $request->subject,
    'message' => $request->message
     ];

    //  return $maildata['message'];

     Mail::to($request->email)->send(new BasicMail($maildata));
    //  dd("Email is sent successfully.");
     return  redirect()->back()->with('notfound', "Mail Not Send !!");
    // try {
    //     Mail::to($request->email)->send(new BasicMail([
    //         'subject' => $request->subject,
    //         'message' => $request->message
    //     ]));
    // }catch (\Exception $e){
    //     return  redirect()->back()->with('notfound', "Mail Not Send !!");
        
    //     // redirect()->back()->with([
    //     //     'type' => 'danger',
    //     //     'msg' => $e->getMessage()
    //     // ]);
    // }

    // if (Mail::failures()){
    //     $res_data = [
    //         'msg' => __('Mail Send Failed'),
    //         'type' => 'danger'
    //     ];
    // }
    // return redirect()->back()->with($res_data);
}




public function seo_settings()
{
    
    return view('setting::settings.seo_settings.seo');
}

public function update_seo_settings(Request $request)
{

    $request->validate([
            'site_meta_tags' => 'required|string',
            'site_meta_description' => 'required|string'
        ]);

        $site_tags = 'site_meta_tags';
        $site_description = 'site_meta_description';

        update_static_option($site_tags, $request->$site_tags);
        update_static_option($site_description, $request->$site_description);


    return redirect()->back()->with('message','Updated SEO Setting Successfully!');
}



 }
