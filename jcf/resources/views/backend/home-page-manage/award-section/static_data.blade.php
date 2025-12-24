@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Static Option</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">AWard
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="form-modal-ex">
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                        <i data-feather="plus" ></i>Add 
                    </button> --}}
                    <!-- Modal -->
                    {{-- <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Add Option</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/home/static-data')}}" method="POST" id="faqform">
                                    @csrf
                                    <div class="modal-body">
                                        <label>Heading: </label>
                                        <div class="form-group">
                                            <input type="text" name="heading" placeholder="" class="form-control" />
                                        </div>
    
                                        <label>Subheading: </label>
                                        <div class="form-group">
                                            <input type="text" name="subheading" class="form-control" id=""/>
                                        </div>

                                        <label>Bacground Image: </label>
                                        <div class="form-group">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="messages">Upload</label>
                                            </div>
                                      
                                            
                                            <img src="{{asset('frontend/custom/breadcrump.png')}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                    
                                    
                                        <!-- upload and reset button -->
                                        <div class="media-body mt-75 ml-1">
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                            <input type="file" id="account-upload" class="custom-file-input"  name="background" accept="image/*"  />
                                           
                                        </div>
                                            
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" id="faq" class="btn btn-primary" value="Save Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            
        </div>
    </div>
    <div class="content-body"> 
       
        <!-- Table Hover Animation start -->
        <div class="row" id="table-hover-animation">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List</h4>
                    </div>
                   
                    <div class="table-responsive">
                        @if(count($staticdata)> 0)


                        <table class="table table-hover-animation">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Background Image</th>
                                    <th>Heading</th>
                                    <th>Subheading</th>     
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            @foreach($staticdata as $faqs)
                            <tbody>
                                <tr>
                                    <td>{{$faqs->id}}</td>

                                    <td>
                                        @if ($faqs->background)
                                            <img src="{{asset('backend/home/award/'.$faqs->background)}}" class="mr-75" height="280" width="280" alt="Angular" />
                                        @else
                                            <img src="{{asset('frontend/custom/breadcrump.png')}}" class="mr-75" height="280" width="280" alt="Angular" />
                                       
                                        @endif
                                    </td>
                                    <td>{{$faqs->heading}}</td>
                                    <td>{!! $faqs->subheading !!}</td>
                                    
                                    <td>
                                    <!-- Button trigger modal -->
                                    <a  class="text-primary" data-toggle="modal" data-target="#inlineForm" >
                                        <button class="btn btn-primary">Update New</button>
                                    </a>

                                    
                                    {{-- <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$faqs->id}}').submit();"><i data-feather="trash-2" class="mr-50"></i></a>
                                    <form id="delete-form-{{$faqs->id}}"  
                                    + action="{{url('/home/static-data/'.$faqs->id)}}" 
                                    method="post"> 
                                   @csrf @method('DELETE') 
                                   </form> --}}
                                    </td>
                                </tr>
                                
                  
                    
                            </tbody>
                            @endforeach
                        </table>
                        
                    </div>

                <!-- Modal -->
               
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Update Static</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{url('/home/static-data/'.$faqs->id)}}" method="POST" id="faqform" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="text" name="id" value="{{$faqs->id}}" placeholder="" class="form-control" hidden />
                                        <input type="text" name="user_id" value="{{$faqs->user_id}}" placeholder="" class="form-control" hidden />
                                <div class="modal-body">
                                    <label>Heading: </label>
                                    <div class="form-group">
                                        <input type="text" name="heading" placeholder="" value="{{$faqs->heading}}" class="form-control" />
                                    </div>

                                    <label>Subheading: </label>
                                    <div class="form-group">
                                        <input type="text" name="subheading" class="form-control" value="{{$faqs->subheading}}" id=""/>
                                    </div>

                                    <label>Bacground Image: </label>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="messages">Upload</label>
                                        </div>
                                  
                                        @if($faqs->background)
                                            <img src="{{asset('backend/home/award/'.$faqs->background)}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                        @else
                                        <img src="{{asset('frontend/custom/breadcrump.png')}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="200" width="500" />
                
                                        @endif
                                        <div class="media-body mt-75 ml-1">
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                            <input type="file" id="account-upload" class="custom-file-input"  name="background" accept="image/*"  />
                                           
                                        </div> 
                                        {{-- <input type="file" name="background" class="form-control" value="" id=""/>--}}
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="submit" id="faq" class="btn btn-primary" value="Save Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              
                

                </div>
            </div>
        </div>
        <!-- Table head options end -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-2">
                {{$staticdata->links()}}
                @else
                <h5 class="justify-content-center"> No Data found</h5>
                 @endif
            </ul>
        </nav>
    </div>
</div>
@endsection
