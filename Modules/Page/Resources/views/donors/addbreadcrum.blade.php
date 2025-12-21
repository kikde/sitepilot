@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Pages</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Create new page</a>
                            </li>
                            
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <div class="content-body">
        <!-- Blog Edit -->
        <div class="blog-edit-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Breadcrumb </h4>
                        </div>
                        <div class="card-body">
                            @if(!$bannerimg == 0)
                            <!-- Form -->
                            <form  class="mt-2" action="{{url('/banner')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                             
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            {{-- <label for="blog-edit-title">Page Name</label> --}}
                                            <input type="hidden" id="blog-edit-title" class="form-control" name="page_name"  placeholder="" value="{{$bannerimg->page_name}}" />

                                            <input type="hidden" id="id" class="form-control" name="id"  placeholder="" value="{{$bannerimg->id}}" />
                                        </div>
                                    </div>
                                    <div class="col-12"> 
                                        <div class="border rounded p-2">
                                            <h4 class="mb-1">Breadcrumb Image</h4>
                                            <div class="media flex-column flex-md-row">
                                               @if($bannerimg->breadcrumb)
                                                <img src="{{asset('/backend/uploads/'.$bannerimg->breadcrumb)}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                             @else
                                                <img src="{{asset('frontend/custom/breadcrump.png')}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                               @endif
                                                <div class="media-body">
                                                    
                                                    <p class="my-50">
                                                        <a href="javascript:void(0);" id="blog-image-text">Required image resolution 1920x442, image size 10mb.</a>
                                                    </p>
                                                    <div class="d-inline-block">
                                                        <div class="form-group mb-0">
                                                            <div class="custom-file">
                                                                <input type="file" name="breadcrumb" class="custom-file-input" id="blogCustomFile" accept="image/*" />
                                                                <label class="custom-file-label" for="blogCustomFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <button type="submit"  id="btn-submit" class="btn btn-primary mr-1">Save Changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ Form -->
                            @else
                               <!-- Form -->
                               <form  class="mt-2" action="{{url('/banner')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            {{-- <label for="blog-edit-title">Page Name</label> --}}
                                            <input type="hidden" id="blog-edit-title" class="form-control" name="page_name"  placeholder="" value="Donars" />

                                        
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="border rounded p-2">
                                            <h4 class="mb-1">Breadcrumb Image</h4>
                                            <div class="media flex-column flex-md-row">

                                                <img src="{{asset('frontend/custom/breadcrump.png')}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                               
                                                <div class="media-body">
                                                    
                                                    <p class="my-50">
                                                        <a href="javascript:void(0);" id="blog-image-text">Required image resolution 1920x442, image size 10mb.</a>
                                                    </p>
                                                    <div class="d-inline-block">
                                                        <div class="form-group mb-0">
                                                            <div class="custom-file">
                                                                <input type="file" name="breadcrumb" class="custom-file-input" id="blogCustomFile" accept="image/*" />
                                                                <label class="custom-file-label" for="blogCustomFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <button type="submit"  id="btn-submit" class="btn btn-primary mr-1">Save Changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ Form -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Blog Edit -->

    </div>
</div>





@endsection
