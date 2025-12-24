<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\Member\Entities\Category;
use View;
use Auth;

class CategoryController extends Controller
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
        $cate = Category::simplePaginate('10');
        return view('member::category.index', compact('cate'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('member::add.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $cat = new Category;
        $cat->user_id = Auth::user()->id;
        $cat->name = $request->name;
    
      
        //  return $ques;
         $cat->save();
         return redirect('/category')->with('message',"Added Sucessfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('member::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $cat = Faq::find($id);
        return view('faq::edit', copmact('cat'));
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
        $cat = Category::where('id', $id)->first();
        $cat->user_id = Auth::user()->id;
        $cat->name = $request->name;
    
      
        //  return $ques;
         $cat->save();
         return redirect('/category')->with('message',"update Sucessfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $cat = Category::where('id', $id)->first();
        $cat->delete();
        return redirect('/category')->with('message',"Deleted Sucessfully");

    }
}
