@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Media Coverage</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Edit New </a>
                                </li>
                               
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
        <div class="content-body">

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Product</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ url('/successstory/'.$story->id) }}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        @method('PUT')
                                        <input id="id" type="text" class="form-control" name="id" value="{{$story->id}}" hidden>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column" class="font-weight-bolder">Title</label>
                                                    <input type="text" id="title" class="form-control" name="title" onchange="fillslug(this.value)" value="{{$story->title}}" placeholder="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column"class="font-weight-bolder">Slug</label>
                                                    <input type="text" id="slug" class="form-control" name="slug"  value="{{$story->slug}}" placeholder="" />
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label>Content</label>
                                                    <div id="blog-editor-wrapper">
                                                       
                                                            
                                                            <input type="hidden"  class="form-control" name="content" id="content" />
        
                                                            <div id="blog-editor-container">
                            
                                                                <div class="editor" > 
                                                                      {!!$story->content!!}
                                                               </div>
                                                              
                                                            </div>
        
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6 col-12"> 
                                                <div class="form-group">
                                                    <label for="dob-column">Meta Tags</label>
                                                    <input type="text" id="dob-column" class="form-control"  name="meta_tags" value="{{$story->meta_tags}}"  />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="=father-floating">Excerpt</label>
                                                    <textarea id="father-floating" class="form-control" name="excerpt"  >{{$story->excerpt}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12"> 
                                                <div class="form-group">
                                                    <label for="dob-column">Meta Title</label>
                                                    <input type="text" id="dob-column" class="form-control"  name="meta_tags" value="{{$story->meta_title}}"  />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12"> 
                                                <div class="form-group">
                                                    <label for="dob-column">Meta OgMeta Title</label>
                                                    <input type="text" id="dob-column" class="form-control"  name="og_meta_title" value="{{$story->og_meta_title}}"  />
                                                </div>
                                            </div>
    
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="=father-floating">Meta Description</label>
                                                    <textarea id="father-floating" class="form-control" name="meta_description" value="{{$story->meta_description}}"  ></textarea>
                                                </div>
                                            </div>
    
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="=father-floating">OgMeta Description</label>
                                                    <textarea id="father-floating" class="form-control" name="og_meta_description"  value="{{$story->og_meta_description}}"  ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="border rounded p-2">
                                                    <h4 class="mb-1">Image</h4>
                                                    <div class="media flex-column flex-md-row">
                                                        @if($story->image)
                                                        <img src="{{asset('backend/story/'.$story->image)}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                                        @else
                                                        <img src="{{asset('frontend/custom/breadcrump.png')}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                                        @endif
                                                        <div class="media-body">
                                                          
                                                            <p class="my-50">
                                                                <a href="javascript:void(0);" id="blog-image-text">Required image resolution 270x280.</a>
                                                            </p>
                                                            <div class="d-inline-block">
                                                                <div class="form-group mb-0">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="image" class="custom-file-input"  id="blogCustomFile" value="" accept="image/*" />
                                                                        <label class="custom-file-label" for="blogCustomFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-6 col-12">
                                                <div class="media">
                                                    
                                                    @if($story->og_meta_image)
                                                        <img src="{{asset('backend/story/'.$story->og_meta_image)}}"
                                                            id="account-upload-img" class="rounded mr-50" alt="profile image"
                                                            height="170" width="110" value="" />
                                                    @else
                                                    <img src="{{asset('frontend/custom/breadcrump.png')}}"
                                                    id="account-upload-img" class="rounded mr-50" alt="profile image"
                                                    height="170" width="110" value="" />
                                                    @endif
                                                    <!-- upload and reset button -->
                                                    <div class="media-body mt-75 ml-1">
                                                        <label for="account-upload"
                                                            class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                        <input type="file" id="account-upload" hidden accept="image/*"
                                                            name="og_meta_image" />
                                                        <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                       
                                                    </div>
                                                    <!--/ upload and reset button -->
                                                </div>

                                                
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column" class="font-weight-bolder">Category</label>
                                                    {!! Form::select('success_story_category_id', $cname, $story->success_story_category_id, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column" class="font-weight-bolder">Status</label>
                                                    {!! Form::select('status', Config::get('constants.pagestatus'), $story->status, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                                </div>
                                            </div>
                                           
                                            <div class="col-12">
                                                <button type="submit" id="btn-submit" class="btn btn-primary mr-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->




  

        </div>
    </div>
</div>

<script>
  function fillslug(val){
    var str = (val || '').toString().trim().replace(/\s+/g, '-').toLowerCase();
    var slugEl = document.getElementById('slug');
    if (slugEl) slugEl.value = str; // safe even though slug input is commented out
  }

  // Editor HTML -> hidden field on submit
  (function(){
    const form = document.querySelector('form.form-horizontal');
    form?.addEventListener('submit', function(){
      const quillBody = document.querySelector('.ql-editor');
      const contentEditable = document.querySelector('#blog-editor-container .editor');
      let html = '';
      if (quillBody) html = quillBody.innerHTML;
      else if (contentEditable) html = contentEditable.innerHTML;
      document.getElementById('content').value = html;
    });
  })();
</script>
@endsection

