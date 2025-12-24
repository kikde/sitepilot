@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Banner</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Edit Banner</a>
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
                                <form class="form form-horizontal" action="{{url('/home/todo-update/'.$todo->id)}}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    @method('PUT')

                                    <input id="id" type="text" class="form-control" name="id" value="{{$todo->id}}" hidden>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="messages">Upload</label>
                                                </div>
                                          
                                                @if($todo->images)
                                                    <img src="{{asset('backend/home/todo/'.$todo->images)}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                                @else
                                                <img src="{{asset('frontend/custom/breadcrump.png')}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                        
                                                @endif
                                        
                                            <!-- upload and reset button -->
                                            <div class="media-body mt-75 ml-1">
                                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                <input type="file" id="account-upload" class="custom-file-input"  name="images" accept="image/*"  />
                                               
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="email-id">Image Alt Tag</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="alt_tag" class="form-control" name="alt_tag"  value="{{$todo->alt_tag}}" placeholder="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="email-id">Title</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="title" class="form-control" name="title"  value="{{$todo->title}}"placeholder="" />
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="email-id">Description</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="description" class="form-control" name="description"  value="{{$todo->description}}" placeholder="" />
                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3 col-form-label">
                                                    <label for="messages">Status</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    {!!Form::select('status',Config::get('constants.pagestatus'),$todo->status,["Class" =>"form-control"])!!}
                                                    
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            <a href="{{url('/home/todo-list')}}" class="btn btn-outline-secondary">Go Back</a>
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
@endsection
