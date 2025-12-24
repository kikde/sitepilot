<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBanner;
use App\Models\TodoSection;
use App\Models\StaticData;
use App\Models\AwardSection;
use Modules\Setting\Entities\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image; 
use View;

class HomePageManageController extends Controller
{
    //
    public function __construct()
    {
         $this->middleware('auth');
         $setting = Setting::first();
         View::share(['setting'=>$setting]);
    }

    public function homeBanner()
    {
        
        $banner = HomeBanner::latest()->simplePaginate('6');
        return view('backend.home-page-manage.banner.index', compact('banner'));
    }



    public function createBanner()
    {
       
        return view('backend.home-page-manage.banner.add');
    }
   //======================== Banner Section =========================//
public function storeNew(Request $request)
{
    Log::info('HomeBanner.storeNew: incoming', [
        'payload'  => $request->except(['_token', 'images']),
        'has_file' => $request->hasFile('images'),
        'user_id'  => optional(Auth::user())->id,
        'ip'       => $request->ip(),
        'ua'       => $request->userAgent(),
    ]);

    // Minimal validation (keeps your current behavior)
    $request->validate([
        // 'title'  => 'required|string|max:255',
        'status' => 'nullable|in:Published,Draft',
        'images' => 'sometimes|file|mimes:jpg,jpeg,png,webp,gif|nullable|max:8192', // 8MB; tune if needed
    ]);

    try {
        $gall = new HomeBanner;

        // Handle upload (no decoding)
        if ($request->hasFile('images')) {
            $postimage = $request->file('images');

            $dir = public_path('backend/home/banner');
            if (!is_dir($dir)) mkdir($dir, 0755, true);

            $ext       = strtolower($postimage->getClientOriginalExtension());
            $photoname = '_prd_' . Str::uuid() . '.' . $ext;

            $postimage->move($dir, $photoname);

            $target = $dir . DIRECTORY_SEPARATOR . $photoname;
            Log::info('HomeBanner.storeNew: image moved', [
                'target_path' => $target,
                'filename'    => $photoname,
                'is_readable' => is_readable($target),
                'filesize'    => @filesize($target),
            ]);

            $gall->images = $photoname;
        }

        // Fields
        $gall->alt_tag          = $request->alt_tag;
        $gall->user_id          = Auth::user()->id;
        $gall->title            = $request->title;
        $gall->meta_title       = $request->meta_title;
        $gall->meta_tag         = $request->meta_tag;
        $gall->meta_keywords    = $request->meta_keywords;
        $gall->meta_description = $request->meta_description;
        $gall->status           = $request->status ?? 'Draft';

        $gall->save();

        Log::info('HomeBanner.storeNew: saved model', [
            'id'      => $gall->id,
            'image'   => $gall->images ?? null,
            'status'  => $gall->status ?? null,
            'user_id' => $gall->user_id,
        ]);

        return redirect('/home/banner-list')->with('message', 'Added Sucessfully');
    } catch (\Throwable $e) {
        Log::error('HomeBanner.storeNew: failed', [
            'error'   => $e->getMessage(),
            'code'    => $e->getCode(),
            'line'    => $e->getLine(),
            'file'    => $e->getFile(),
            'trace'   => $e->getTraceAsString(),
            'payload' => $request->except(['_token', 'images']),
        ]);
        return back()->withErrors('Something went wrong while saving the banner.');
    }
}


    
   public function bannnerShow($id)
{
    $gall = HomeBanner::find($id);
    if (!$gall) {
        return redirect()->back()->withErrors('Banner not found.');
    }
    return view('backend.home-page-manage.banner.edit', compact('gall'));
}


   public function bannerUpdate(Request $request, $id)
{
    $request->validate([
        // 'title'  => 'required|string|max:255',
        'status' => 'nullable|in:Published,Draft',
        'images' => 'sometimes|file|mimes:jpg,jpeg,png,webp,gif|nullable|max:8192',
    ]);

    $gall = HomeBanner::find($id);
    if (!$gall) {
        return redirect()->back()->withErrors('Banner not found.');
    }

    try {
        // Replace image if new uploaded
        if ($request->hasFile('images')) {
            $postimage = $request->file('images');

            $dir = public_path('backend/home/banner');
            if (!is_dir($dir)) mkdir($dir, 0755, true);

            $ext       = strtolower($postimage->getClientOriginalExtension());
            $photoname = '_prd_' . Str::uuid() . '.' . $ext;

            // move new file first
            $postimage->move($dir, $photoname);

            // delete old file (best-effort)
            if (!empty($gall->images)) {
                $oldPath = $dir . DIRECTORY_SEPARATOR . $gall->images;
                if (is_file($oldPath)) @unlink($oldPath);
            }

            $gall->images = $photoname;
        }

        // Fields
        $gall->alt_tag          = $request->alt_tag;
        $gall->user_id          = Auth::user()->id;
        $gall->title            = $request->title;
        $gall->meta_title       = $request->meta_title;
        $gall->meta_tag         = $request->meta_tag;
        $gall->meta_keywords    = $request->meta_keywords;
        $gall->meta_description = $request->meta_description;
        $gall->status           = $request->status ?? $gall->status;

        $gall->save();

        return redirect('/home/banner-list')->with('message', 'Updated Sucessfully');
    } catch (\Throwable $e) {
        Log::error('HomeBanner.bannerUpdate: failed', [
            'id'      => $id,
            'error'   => $e->getMessage(),
            'code'    => $e->getCode(),
            'line'    => $e->getLine(),
            'file'    => $e->getFile(),
            'trace'   => $e->getTraceAsString(),
        ]);
        return back()->withErrors('Something went wrong while updating the banner.');
    }
}


public function bannerDelete($id)
{
    $gall = HomeBanner::find($id);
    if (!$gall) {
        return redirect()->back()->withErrors('Banner not found.');
    }

    try {
        // delete file (best-effort)
        if (!empty($gall->images)) {
            $path = public_path('backend/home/banner/' . $gall->images);
            if (is_file($path)) @unlink($path);
        }

        $gall->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    } catch (\Throwable $e) {
        Log::error('HomeBanner.bannerDelete: failed', [
            'id'    => $id,
            'error' => $e->getMessage(),
        ]);
        return redirect()->back()->withErrors('Could not delete the banner.');
    }
}

   //================================================WHAT-WE-DO SECTION===================================//


    public function homeTodo()
    {
        
        $todo = TodoSection::latest()->simplePaginate('6');
        return view('backend.home-page-manage.what-we-do.index', compact('todo'));
    }



    public function createTodo()
    {
       
        return view('backend.home-page-manage.what-we-do.add');
    }

    public function storeTodo(Request $request)
    {
        //
        $gall = new TodoSection;   

        if ($request->hasFile('images')) {
            $postimage = $request->file('images');
            $filename = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/home/todo/'. $filename));
            
            $gall->images = $filename;
            //return $filename;
        } 
       
        $gall->alt_tag = $request->alt_tag;
        $gall->user_id = Auth::user()->id;
        $gall->title = $request->title;
        $gall->description = $request->description;
        $gall->status = $request->status; 
        //return $pack;
        $gall->save();
        return redirect('/home/todo-list')->with('message',"Added Sucessfully");
    }
    
    public function todoShow($id)
    {
        $todo = TodoSection::find($id);
        return view('backend.home-page-manage.what-we-do.edit', compact('todo'));
    }

    public function todoUpdate(Request $request,$id)
    {
        //
        $gall = TodoSection::where('id',$id)->first();   

        if ($request->hasFile('images')) {
            $postimage = $request->file('images');
            $filename = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/home/todo/'. $filename));
            
            $gall->images = $filename;
            //return $filename;
        } 
       
        $gall->alt_tag = $request->alt_tag;
        $gall->user_id = Auth::user()->id;
        $gall->title = $request->title;
        $gall->description = $request->description;
        $gall->status = $request->status;
      
        $gall->save();
        return redirect('/home/todo-list')->with('message',"Updated Sucessfully");
    }


    public function todoDelete($id)
    {
        //
        $gall = TodoSection::find($id);
        $gall->delete();
        return redirect()->back()->with('message',"deleted Sucessfully");
    }



  //================================================WHAT-WE-DO END SECTION===================================//


  //================================================AWARD SECTION===================================//

  public function static_data()
  {
      
      $staticdata = StaticData::latest()->simplePaginate('6');
      return view('backend.home-page-manage.award-section.static_data', compact('staticdata'));
  }



  public function storeStatic(Request $request, $id)
  {
    //   return $request;
    //   $statics = new StaticData;   
    $statics = StaticData::where('id',$id)->first();  

    if ($request->hasFile('background')) {      
       $this->Uploadfile($request,$statics);

    }
     
      $statics->user_id = Auth::user()->id;
      $statics->heading = $request->heading;
      $statics->subheading = $request->subheading;
    
    //   if ($request->hasFile('background')) {

       
    //     $postimage = $request->file('backgroundx');
    //     $filename = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
    //     Image::make($postimage)->save(public_path('/backend/home/award/'. $filename));
        
    //     $statics->backgroundx = $filename;
      
    // } 
 
      $statics->save();
      return redirect('/home/static-data')->with('message',"Updated Sucessfully");
  }
  
  public function Uploadfile($request,$statics)
{
    $postimage = $request->file('background');
    $filename = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
    $postimage->move(public_path('/backend/home/award/'), $filename);
    $statics->background = $filename;

   
   
}



  public function homeAward()
  {
      
      $award = AwardSection::latest()->simplePaginate('6');
      return view('backend.home-page-manage.award-section.index', compact('award'));
  }



  public function createAward()
  {
     
      return view('backend.home-page-manage.award-section.add');
  }

  public function storeAward(Request $request)
  {
      //
      $award = new AwardSection;   

      if ($request->hasFile('images')) {
          $postimage = $request->file('images');
          $filename = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
          Image::make($postimage)->save(public_path('/backend/home/award/'. $filename));
          
          $award->images = $filename;
          //return $filename;
      } 
     
      $award->alt_tag = $request->alt_tag;
      $award->user_id = Auth::user()->id;
      $award->title = $request->title;
      $award->description = $request->description;
      $award->status = $request->status;
      //return $pack;
      $award->save();
      return redirect('/home/award-list')->with('message',"Added Sucessfully");
  }
  
  public function awardShow($id)
  {
      $award = AwardSection::find($id);
      return view('backend.home-page-manage.award-section.edit', compact('award'));
  }

  public function awardUpdate(Request $request,$id)
  {
      //
      $award = AwardSection::where('id',$id)->first();   

      if ($request->hasFile('images')) {
          $postimage = $request->file('images');
          $filename = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
          Image::make($postimage)->save(public_path('/backend/home/award/'. $filename));
          
          $award->images = $filename;
          //return $filename;
      } 
     
      $award->alt_tag = $request->alt_tag;
      $award->user_id = Auth::user()->id;
      $award->title = $request->title;
      $award->description = $request->description;
      $award->status = $request->status;
    
      $award->save();
      return redirect('/home/award-list')->with('message',"Updated Sucessfully");
  }


  public function awardDelete($id)
  {
      //
      $award = AwardSection::find($id);
      $award->delete();
      return redirect()->back()->with('message',"deleted Sucessfully");
  }
















}
