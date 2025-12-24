<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Entities\EmailTemplate;
use Validator;
use Redirect;
use View;

class EmailTemplateController extends Controller
{
    private $rules = array();
    private $messages = array();

    public function __construct()
    {
         $this->middleware('auth');
         $setting = Setting::first();
         View::share(['setting'=>$setting]);

        // $this->middleware(['permission:email_templates'])->only('index');

        $this->rules = [
            'subject'   => ['required','max:255'],
            'body'      => ['required'],
        ];

        $this->messages = [
            'subject.required'  => translate('Email subject is required'),
            'subject.max'       => translate('Max 255 characters'),
            'body.required'     => translate('Email Body is required'),
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $email_id = EmailTemplate::pluck('identifier', 'id');
        $email_templates = EmailTemplate::all();
        return view('setting::settings.email_templates.index', compact('email_templates','email_id'));
       
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::settings.email_templates.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        
        $rules      = $this->rules;
        $messages   = $this->messages;
        $validator  = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // flash(translate('Something went wrong'))->error();
            return Redirect::back()->withErrors($validator);
        }

        $email_template             = new EmailTemplate;
        $email_template->identifier = $request->identifier;
        $email_template->subject    = $request->subject;
        $email_template->body       = $request->body;

       
        if ($request->status == 1) {
            $email_template->status = 1;
        }
        else{
            $email_template->status = 0;
        }

        if($email_template->save()){
            // flash(translate('Email Template has been updated successfully'))->success();
            return redirect('/email-templates')->with('message', 'Email Template has been Added successfully');
        } else {
            // flash(translate('Sorry! Something went wrong.'))->error();
            return redirect()->back()->with('message','Sorry! Something went wrong.');
        }

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
    public function update(Request $request)
    {
        //
        return $request;
       
        $rules      = $this->rules;
        $messages   = $this->messages;
        $validator  = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // flash(translate('Something went wrong'))->error();
            return Redirect::back()->withErrors($validator);
        }

        $email_template             = EmailTemplate::where('identifier', $request->identifier)->first();
        $email_template->subject    = $request->subject;
        $email_template->body       = $request->body;

       
        if ($request->status == 1) {
            $email_template->status = 1;
        }
        else{
            $email_template->status = 0;
        }

        if($email_template->save()){
            // flash(translate('Email Template has been updated successfully'))->success();
            return redirect()->back()->with('message', 'Email Template has been updated successfully');
        } else {
            // flash(translate('Sorry! Something went wrong.'))->error();
            return redirect()->back()->with('message','Sorry! Something went wrong.');
        }

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
}
