<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Modules\Setting\Entities\Setting;
use View;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:30,1')->only('verify', 'resend');
        $setting = Setting::first();
        View::share(['setting'=>$setting]);
    }
    
        public function show(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
    
        // ✅ Send verification email automatically (once / throttled)
        $request->user()->sendEmailVerificationNotification();
    
        return view('verification.notice', [
            'pageTitle' => __('Account Verification')
        ]);
    }


    // public function show(Request $request)
    // {
    //     return $request->user()->hasVerifiedEmail()
    //                     ? redirect($this->redirectPath())
    //                     : view('verification.notice', [
    //                         'pageTitle' => __('Account Verification')
    //                     ]);

                       
                        
    // }
}
