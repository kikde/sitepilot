<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\Page\Entities\SuccessStory;
use Modules\Page\Entities\SuccessStoryCategory;
use Image;
use Auth;
use View;

class SuccessStoryController extends Controller
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
    }
   
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $cname = SuccessStoryCategory::pluck('name', 'id');
        // $cname = Category::where('user_id', 1)->value('name');
        $storylist = SuccessStory::latest()->simplePaginate(10);
        return view('page::success-story.index', compact('storylist', 'cname'));
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
 
        $cname = SuccessStoryCategory::pluck('name', 'id');
       
        return view('page::success-story.add', compact('cname'));
    } 

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $list = new SuccessStory; 

        if ($request->hasFile('og_meta_image')) {      
          $this->Uploadfile($request,$list);
        }

  
        $list->title = $request->title; 
        $list->slug = $request->slug; 
        $list->content = $request->content;
        $list->success_story_category_id = $request->success_story_category_id;
        $list->excerpt = $request->excerpt;  
        $list->meta_title = $request->meta_title;
        $list->meta_tags = $request->meta_tags;
        $list->meta_description = $request->meta_description;
        $list->og_meta_title = $request->og_meta_title;
        $list->og_meta_description = $request->og_meta_description;    
        $list->status = $request->status;

        if ($request->hasFile('image')) {
            $postimage = $request->file('image');
            $filename = str_replace(' ', '',$request->title) . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/story/'. $filename));
            
            $list->image = $filename;

        }
       
          // return $list;
         $list->save();

         return redirect('/successstory')->with('message',"Story Added Sucessfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $cname = SuccessStoryCategory::pluck('name', 'id');
        $story = SuccessStory::findOrFail($id);
        return view('page::success-story.edit', compact('story', 'cname'));
        
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('page::edit');
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
        $list =  SuccessStory::where('id', $request->id)->first();

        if ($request->hasFile('og_meta_image')) {      
          $this->Uploadfile($request,$list);
        }

  
        $list->title = $request->title; 
        $list->slug = $request->slug; 
        $list->content = $request->content;
        $list->success_story_category_id = $request->success_story_category_id;
        $list->excerpt = $request->excerpt;  
        $list->meta_title = $request->meta_title;
        $list->meta_tags = $request->meta_tags;
        $list->meta_description = $request->meta_description;
        $list->og_meta_title = $request->og_meta_title;
        $list->og_meta_description = $request->og_meta_description;    
        $list->status = $request->status;

        if ($request->hasFile('image')) {
            $postimage = $request->file('image');
            $filename = str_replace(' ', '',$request->title) . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/story/'. $filename));
            
            $list->image = $filename;

        }
       
          // return $list;
         $list->save();

         return redirect('/successstory')->with('message',"Story Updated Sucessfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $pro = SuccessStory::find($id);
        $pro->delete();
        return redirect('/successstory')->with('message',"deleted Sucessfully"); 
    }


    public function Uploadfile($request,$list)
    {
        $postimage = $request->file('og_meta_image');
        $filename = str_replace(' ', '',$request->title). '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
        $postimage->move(public_path('/backend/story/'), $filename);
        // $data->image_path = public_path('/uploads/profiles/').$filename;
        $list->og_meta_image = $filename;
        // return public_path('/backend/svg').$filename;
    }
}
