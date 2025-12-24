<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Page\Entities\Sector;
use Modules\Page\Entities\Post;
use Modules\Page\Entities\Page;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

use Image;
use Auth;
use View;


class PageController extends Controller
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
    public function index()                             //objectives
    {
       
        $allsector = Sector::latest()->SimplePaginate(10);
        return view('page::objective.index', compact('allsector'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('page::objective.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)                    
    {
        //
        // return $request;

        $sector = new Sector;

        if ($request->hasFile('breadcrumb')) {
            $postimage = $request->file('breadcrumb');
            $bannerfile = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'. $bannerfile));

            $sector->breadcrumb = $bannerfile;
        }
            

            $sector->sector_name = $request->sector_name;
            $sector->slug = $request->slug;
            $sector->heading = $request->heading;
            $sector->subheading = $request->subheading;
            $sector->description = $request->description;
            $sector->pagetitle = $request->pagetitle;
            $sector->pagekeyword = $request->pagekeyword;
            $sector->pagestatus = $request->pagestatus;

            if ($request->hasFile('image')) {
                $postimage = $request->file('image');
                $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
                Image::make($postimage)->save(public_path('/backend/uploads/'. $filename));
                
                $sector->image = $filename;

        } 

    //  return  $sector;

        $sector->save();
         return redirect('/pages')->with('message',"Added Sucessfully");

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
       $sectorlist = Sector::find($id); 
       return view('page::objective.edit', compact('sectorlist'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $sectorlist = Sector::find($id); 
       return view('page::objective.edit', compact('sectorlist'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
 public function update(Request $request, $id)
{
    $sector = Sector::findOrFail($id);

    $validated = $request->validate([
        'sector_name' => 'required|string|max:255',
        'slug'        => 'required|string|max:255|unique:sectors,slug,' . $sector->id,
        'pagetitle'   => 'nullable|string|max:255',
        'pagekeyword' => 'nullable|string|max:255',
        'pagestatus'  => 'required|in:Published,Draft,Pending',
        'breadcrumb'  => 'nullable|image|max:10240', // 10MB
        'image'       => 'nullable|image|max:10240',
        'description' => 'nullable|string',
    ]);

    $baseName = \Str::slug($request->sector_name ?: 'sector');

    if ($request->hasFile('breadcrumb')) {
        $postimage  = $request->file('breadcrumb');
        $bannerfile = $baseName . '_breadcrumb_' . time() . '.' . $postimage->getClientOriginalExtension();
        \Image::make($postimage)->save(public_path('/backend/uploads/' . $bannerfile));
        $sector->breadcrumb = $bannerfile;
    }

    if ($request->hasFile('image')) {
        $postimage = $request->file('image');
        $filename  = $baseName . '_image_' . time() . '.' . $postimage->getClientOriginalExtension();
        \Image::make($postimage)->save(public_path('/backend/uploads/' . $filename));
        $sector->image = $filename;
    }

    $sector->sector_name = $request->sector_name;
    $sector->slug        = $request->slug;
    $sector->heading     = $request->heading;
    $sector->subheading  = $request->subheading;
    $sector->description = $request->description; // now populated by JS
    $sector->pagetitle   = $request->pagetitle;
    $sector->pagekeyword = $request->pagekeyword;
    $sector->pagestatus  = $request->pagestatus;

    $sector->save();

    return redirect('/pages')->with('message', 'Updated Successfully');
}


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $sector = Sector::find($id);
        $sector->delete();
        return redirect()->back()->with('message',"deleted Sucessfully");
    }


//================================================Create Pages==============================//
public function pageList()
{
   
    $allsector = Page::latest()->SimplePaginate(10);
    return view('page::pages.index', compact('allsector'));
}

/**
 * Show the form for creating a new resource.
 * @return Renderable
 */
public function createNew()
{
    return view('page::pages.add');
}

/**
 * Store a newly created resource in storage.
 * @param Request $request
 * @return Renderable
 */
public function storePage(Request $request)
{
    //
    // return $request;

    $sector = new Page;

    if ($request->hasFile('breadcrumb')) {
        $postimage = $request->file('breadcrumb');
        $bannerfile = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
        Image::make($postimage)->save(public_path('/backend/uploads/'. $bannerfile));

        $sector->breadcrumb = $bannerfile;
    }
        

        $sector->name = $request->name;
        $sector->slug = $request->slug;
        $sector->raised_fund = $request->raised_fund;
        $sector->description = $request->description;
        $sector->pagetitle = $request->pagetitle;
        $sector->pagekeyword = $request->pagekeyword;
        $sector->pagestatus = $request->pagestatus;
        $sector->types = $request->types;

        if ($request->hasFile('image')) {
            $postimage = $request->file('image');
            $filename = str_replace(' ', '',$request->name).'_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'. $filename));
            
            $sector->image = $filename;

    } 

//  return  $sector;

    $sector->save();
     return redirect('/pageList')->with('message',"Added Sucessfully");

}

/**
 * Show the specified resource.
 * @param int $id
 * @return Renderable
 */
public function showPage($id)
{
   $sectorlist = Page::find($id); 
   return view('page::pages.edit', compact('sectorlist'));
}

/**
 * Show the form for editing the specified resource.
 * @param int $id
 * @return Renderable
 */
public function editPage($id)
{
    $sectorlist = Page::find($id); 
   return view('page::pages.edit', compact('sectorlist'));
}

/**
 * Update the specified resource in storage.
 * @param Request $request
 * @param int $id
 * @return Renderable
 */
public function updatePage(Request $request, $id)
{
    //
    $sector = Page::where('id',$request->id)->first();

    if ($request->hasFile('breadcrumb')) {
        $postimage = $request->file('breadcrumb');
        $bannerfile = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
        Image::make($postimage)->save(public_path('/backend/uploads/'. $bannerfile));

        $sector->breadcrumb = $bannerfile;
    }
        

        $sector->name = $request->name;
        $sector->slug = $request->slug;
        $sector->raised_fund = $request->raised_fund;
        $sector->description = $request->description;
        $sector->pagetitle = $request->pagetitle;
        $sector->pagekeyword = $request->pagekeyword;
        $sector->pagestatus = $request->pagestatus;
        $sector->types = $request->types;

        if ($request->hasFile('image')) {
            $postimage = $request->file('image');
            $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'. $filename));
            
            $sector->image = $filename;

    } 

//  return  $sector;

    $sector->save();
     return redirect('/pageList')->with('message',"Updated Sucessfully");

}

/**
 * Remove the specified resource from storage.
 * @param int $id
 * @return Renderable
 */
public function deletePage($id)
{
    //
    $sector = Page::find($id);
    $sector->delete();
    return redirect()->back()->with('message',"deleted Sucessfully");
}

//-----------------------------------------------News Post----------------------------------//

    public function newsList()                           
    {
       
        $newspost= Post::latest()->SimplePaginate(10);
        return view('page::post.index', compact('newspost'));
    }

    
    public function createPost()
    {
        return view('page::post.add');
    }

   
    public function storePost(Request $request)                    
    {
        //
        // return $request;

        $newspost = new Post;

        if ($request->hasFile('breadcrumb')) {
            $postimage = $request->file('breadcrumb');
            $bannerfile = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/uploads/'. $bannerfile));

            $newspost->breadcrumb = $bannerfile;
        }
            

            $newspost->sector_name = $request->sector_name;
            $newspost->slug = $request->slug;
            $newspost->heading = $request->heading;
            $newspost->subheading = $request->subheading;
            $newspost->description = $request->description;
            $newspost->pagetitle = $request->pagetitle;
            $newspost->pagekeyword = $request->pagekeyword;
            $newspost->pagestatus = $request->pagestatus;

            if ($request->hasFile('image')) {
                $postimage = $request->file('image');
                $filename = $request->name . '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
                Image::make($postimage)->save(public_path('/backend/uploads/'. $filename));
                
                $newspost->image = $filename;

        } 

        $newspost->save();
         return redirect('/newsList')->with('message',"Added Sucessfully");

    }

    
    public function showPost($id)
    {
       $postlist = Post::find($id); 
       return view('page::post.edit', compact('postlist'));
    }

   
    
 public function updatePost(Request $request, $id)
{
    $newspost = Post::findOrFail($id);

    $validated = $request->validate([
        // 'sector_name' => 'required|string|max:255',
        // 'slug'        => 'required|string|max:255|unique:sectors,slug,' . $newspost->id,
        'pagetitle'   => 'nullable|string|max:255',
        'pagekeyword' => 'nullable|string|max:255',
        'pagestatus'  => 'required|in:Published,Draft,Pending',
        'breadcrumb'  => 'nullable|image|max:10240', // 10MB
        'image'       => 'nullable|image|max:10240',
        'description' => 'nullable|string',
    ]);

    $baseName = \Str::slug($request->sector_name ?: 'sector');

    if ($request->hasFile('breadcrumb')) {
        $postimage  = $request->file('breadcrumb');
        $bannerfile = $baseName . '_breadcrumb_' . time() . '.' . $postimage->getClientOriginalExtension();
        \Image::make($postimage)->save(public_path('/backend/uploads/' . $bannerfile));
        $newspost->breadcrumb = $bannerfile;
    }

    if ($request->hasFile('image')) {
        $postimage = $request->file('image');
        $filename  = $baseName . '_image_' . time() . '.' . $postimage->getClientOriginalExtension();
        \Image::make($postimage)->save(public_path('/backend/uploads/' . $filename));
        $newspost->image = $filename;
    }

    $newspost->sector_name = $request->sector_name;
    $newspost->slug        = $request->slug;   
    $newspost->heading     = $request->heading;
    $newspost->subheading  = $request->subheading;
    $newspost->description = $request->description; // now populated by JS
    $newspost->pagetitle   = $request->pagetitle;
    $newspost->pagekeyword = $request->pagekeyword;
    $newspost->pagestatus  = $request->pagestatus;

    $newspost->save();

    return redirect('/newsList')->with('message', 'Updated Successfully');
}


    public function deletePost($id)
    {
        //
        $newspost = Post::find($id);
        $newspost->delete();
        return redirect()->back()->with('message',"deleted Sucessfully");
    }

    
  public function ckeditorUpload(Request $request)
{
    // Validate the incoming file – CKEditor sends it as "upload"
    $request->validate([
        'upload' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120', // 5MB
    ]);

    if ($request->hasFile('upload')) {
        $file = $request->file('upload');
        $ext  = $file->getClientOriginalExtension();

        // Use Str::random from Illuminate\Support\Str (imported at top)
        $fileName = time() . '_' . Str::random(8) . '.' . $ext;

        // Ensure the directory exists: public/uploads/ckeditor
        $uploadPath = public_path('uploads/ckeditor');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        // Move file
        $file->move($uploadPath, $fileName);

        $url = asset('uploads/ckeditor/' . $fileName);

        // CKEditor expects this exact JSON format
        return response()->json([
            'uploaded' => 1,
            'fileName' => $fileName,
            'url'      => $url,
        ]);
    }

    // Error response CKEditor understands
    return response()->json([
        'uploaded' => 0,
        'error'    => [ 'message' => 'No file uploaded.' ]
    ], 400);
}



    public function quillImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // 5MB
        ]);

        // store in storage/app/public/quill-images
        $path = $request->file('image')->store('quill-images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }



}



