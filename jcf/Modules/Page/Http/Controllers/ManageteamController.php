<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Setting\Entities\Setting;
use Modules\Page\Entities\Manageteam;
use Image;
use Auth;
use View;

class ManageteamController extends Controller
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

        $test = Manageteam::latest()->SimplePaginate('5');
        return view('page::manageteam.index', compact('test'));
      
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('page::manageteam.add');
      
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $testing = new Manageteam;
    
        if ($request->hasFile('images')) {
            $postimage = $request->file('images');
            $filename = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/teams/'. $filename));
            
            $testing->images = $filename;
            // return $filename;
        } 
        $testing->alt_tag = $request->alt_tag;
        $testing->user_id = Auth::user()->id;
        // $testing->title = $request->title;
        $testing->description = $request->description;
        $testing->name = $request->name;
        $testing->desg = $request->desg;
        $testing->rating = $request->rating;
        $testing->page_title = $request->page_title;
        $testing->page_keywords = $request->page_keywords;
       
        //  return $testing;
        $testing->save();
         return redirect('/management-team')->with('message',"Added Sucessfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('page::manageteam.show');
        // return view('page::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
       
        $test = Manageteam::find($id);
        return view('page::manageteam.edit', compact('test'));
        
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
        $testing = Manageteam::where('id',$request->id)->first();
        if ($request->hasFile('images')) {
            $postimage = $request->file('images');
            $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->resize(670, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/backend/teams/'. $filename));
            
            $testing->images = $filename;
            //return $filename;
        } 
        $testing->alt_tag = $request->alt_tag;
        $testing->user_id = Auth::user()->id;
        // $testing->title = $request->title ?? "Null";
        $testing->description = $request->description;
        $testing->name = $request->name;
        $testing->desg = $request->desg;
        $testing->rating = $request->rating;
        $testing->page_title = $request->page_title;
        $testing->page_keywords = $request->page_keywords;
         
         $testing->save();
        //  return $test;
         return redirect('/management-team')->with('message',"updated Sucessfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $test = Manageteam::find($id);
        $test->delete();
        return redirect()->back()->with('message',"deleted Sucessfully");
    }
}
