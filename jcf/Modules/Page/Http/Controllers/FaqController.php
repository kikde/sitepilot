<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Faq;
use Modules\Setting\Entities\Setting;
use Auth;
use View;

class FaqController extends Controller
{


    public function __construct()
    {
         $this->middleware('auth');
         $setting = Setting::first();
         View::share(['setting'=>$setting]);
         
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $faq = Faq::latest()->simplePaginate('10');
        // $getfaq = Faq::find($id);
        return view('page::faq.index', compact('faq'));
        // return view('page::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('page::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $ques = new Faq;
        $ques->user_id = Auth::user()->id;
        $ques->title = $request->title ?? "null";
        $ques->question = $request->question;
        $ques->answer = $request->answer;
      
        //  return $ques;
         $ques->save();
         return redirect('/faqs')->with('message',"Added Sucessfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('page::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
         return $id;
        $faqs = Faq::find($id);

        return view('page::faq.edit', copmact('ques'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
       public function update(Request $request, $id)
{

    $ques = Faq::findOrFail($id);

    $ques->question = $request->question;
    $ques->answer   = $request->answer;

    $ques->save();

    return redirect('/faqs')->with('message', 'Updated Successfully');
}

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        // return $id;
        $faqs = Faq::find($id);

        $faqs->delete();
        return redirect()->back()->with('message',"deleted Sucessfully");
    }
}
