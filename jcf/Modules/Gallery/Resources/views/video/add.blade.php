@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Video Gallery</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Add Video</a>
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
                                <h4 class="card-title">Add New</h4>
                            </div>
                            <div class="card-body">
                                <form class="form" action="{{ url('/photogallery') }}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    
                                       <input type="hidden" class="hidden" name="type" value="video">

                                            <div class="row">
                                            
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="email-id">Title</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="title" class="form-control" name="title"  value=""placeholder="" />
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
                                                        <img src="{{ asset('frontend/custom/breadcrump.png') }}"
                                                            id="thumbnail-preview"
                                                            class="rounded mr-50"
                                                            alt="preview image" height="100" width="100" />

                                                        <div class="ml-1">
                                                            <label for="thumbnail-input" class="btn btn-sm btn-primary mb-0">Choose Image</label>
                                                            <input type="file"
                                                                id="thumbnail-input"
                                                                class="custom-file-input d-none"
                                                                name="images"
                                                                accept="image/*"
                                                                required>
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

                                                                {{-- video preview --}}
                                                                <video id="video-preview"
                                                                    width="160"
                                                                    height="90"
                                                                    controls
                                                                    class="rounded mr-50 d-none">
                                                                    <source id="video-preview-source" src="#" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>

                                                                <!-- upload button -->
                                                                <div class="media-body mt-75 ml-1">
                                                                    <label for="video-input" class="btn btn-sm btn-primary mb-75 mr-75">Upload Video</label>
                                                                    <input type="file"
                                                                        id="video-input"
                                                                        class="custom-file-inputx"
                                                                        name="video"
                                                                        accept="video/*"
                                                                        required/>
                                                                </div>
                                                                <!--/ upload button -->
                                                            </div>
                                                        </div>

 

                                                 <div class="col-12" hidden>
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="email-id">Sharing Site</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <select class="select2 form-control" name="share_site" value="video" id="default-select">
                                                            
                                                                <option value="video">Youtube</option>
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


document.getElementById('video-input')?.addEventListener('change', function (e) {
    const [file] = e.target.files;
    if (!file) return;

    const url = URL.createObjectURL(file);

    const video = document.getElementById('video-preview');
    const source = document.getElementById('video-preview-source');

    source.src = url;
    video.classList.remove('d-none');
    video.load();
});


</script>


@endsection
