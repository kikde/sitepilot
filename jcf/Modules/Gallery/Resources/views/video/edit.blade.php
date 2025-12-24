@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Gallery</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Add Gallery</a>
                                </li>
                               
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="content-body"> 
            <!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit New</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" action="{{url('/photogallery/'.$gall->id)}}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    @method('PUT')

                                    <input id="id" type="text" class="form-control" name="id" value="{{$gall->id}}" hidden>
                                    <input type="hidden" class="hidden" name="type" value="video">
                                    <div class="row">
                                            
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="email-id">Title</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="title" class="form-control" name="title"  value="{{$gall->title}}" placeholder="" />
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="description">Description</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <textarea name="description" class="form-control"> </textarea>
                                                </div>
                                            </div>
                                        </div>--}}

                                    
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="messages">Status</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    {!!Form::select('status',Config::get('constants.pagestatus'),null,["Class" =>"form-control"])!!}
                                                    
                                                </div>
                                            </div>
                                        </div>

                                       {{-- <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="email-id">Video Options</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select class="select2 form-control" name="video_option" id="default-select">
                                                        <option value="square">Slecet</option>
                                                        <option value="rectangle">Upload</option>
                                                        <option value="Share Link">Share Link</option>
                                                      
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>--}}
                                                    
                                                       {{-- THUMBNAIL --}}
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="thumbnail-input">Thumbnail</label>

                                                        <div class="col-sm-9 d-flex align-items-center">
                                                            <img src="{{ asset('backend/gallery/photo/'.$gall->images) }}"
                                                                id="thumbnail-preview"
                                                                class="rounded mr-50"
                                                                alt="preview image" height="100" width="100" />

                                                            <div class="ml-1">
                                                                <label for="thumbnail-input" class="btn btn-sm btn-primary mb-0">Choose Image</label>
                                                                <input type="file"
                                                                    id="thumbnail-input"
                                                                    class="custom-file-input d-none"
                                                                    name="images"
                                                                    accept="image/*">
                                                                <div class="text-muted small mt-50">JPG / PNG, recommended 800px</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- VIDEO --}}
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="video-input">Upload</label>
                                                            </div>

                                                            <video width="320" height="180" controls preload="metadata">
                                                                <source src="{{ asset('backend/gallery/video/'.$gall->video) }}" type="video/mp4">
                                                            </video>

                                                            <div class="media-body mt-75 ml-1">
                                                                <label for="video-input" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                                <input type="file"
                                                                    id="video-input"
                                                                    class="custom-file-input"
                                                                    name="video"
                                                                    accept="video/*">
                                                            </div>
                                                        </div>
                                                    </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="email-id">Sharing Site</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select class="select2 form-control" name="share_site" value="video" id="default-select">
                                                        <option value="{{$gall->share_site}}" >{{$gall->share_site}}</option>
                                                        <option value="video">Video</option>
                                                        <!-- <option value="Dailymotion">Dailymotion</option> -->
                                                      
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="email-id">YoutubeLink</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="link" class="form-control" name="link"  value=""placeholder="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            <a href="{{url('/videogallery')}}" class="btn btn-outline-secondary">Go Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </section>
            <!-- Basic Horizontal form layout section end -->           

        </div>
    </div>
</div>

<script>
document.getElementById('thumbnail-input')?.addEventListener('change', function (e) {
    const [file] = e.target.files;
    if (file) {
        document.getElementById('thumbnail-preview').src = URL.createObjectURL(file);
    }
});
</script>

@endsection
