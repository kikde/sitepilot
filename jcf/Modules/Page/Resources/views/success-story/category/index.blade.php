@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Category List</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">List
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
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                        <i data-feather="plus" ></i>Add Category
                    </button>
                    <!-- Modal -->
                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Add</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/succes-story-category')}}" method="POST" id="catform">
                                    @csrf
                                    <div class="modal-body">
                                        <label>Name: </label>
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Add New" class="form-control" />
                                        </div>

                                        <label>Status: </label>
                                        <div class="form-group">
                                            {!! Form::select('status', Config::get('constants.status'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
    
                
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" id="category" class="btn btn-primary" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="content-body"> 
        @if(count($cate)> 0)
        <!-- Table Hover Animation start -->
        <div class="row" id="table-hover-animation">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List</h4>
                    </div>
                  
                    <div class="table-responsive">
                      
                        <table class="table table-hover-animation">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>   
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            @foreach($cate as $faqs)
                            <tbody>
                                <tr>
                                    <td>{{$faqs->id}}</td>
                                    <td>{{$faqs->name}}</td>
                                    
                                    
                                
                                    <td>
                                        
                                        <a href="" id="editfaq" data-toggle="modal" data-target="#editfaq{{$faqs->id}}" data-id="{{$faqs->id}}"><i data-feather='edit'></i></a>

                                        <a href="" onclick="event.preventDefault(); document.getElementById('delete-form-{{$faqs->id}}').submit();"><i data-feather="trash-2" class="mr-50"></i></a>
                                                        <form id="delete-form-{{$faqs->id}}"  
                                                        + action="{{url('/succes-story-category/'.$faqs->id)}}" 
                                                        method="post"> 
                                                       @csrf @method('DELETE') 
                                                       </form>
                                    </td>
                                </tr>
                    <!-- Modal -->
                    <div class="modal fade text-left" id="editfaq{{$faqs->id}}" tabindex="-1" role="dialog" aria-labelledby="editfaq{{$faqs->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="editfaq">Edit Categories</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/succes-story-category/'.$faqs->id)}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <label>Category: </label>
                                        <div class="form-group">
                                            <input type="text" name="name" value="{{$faqs->name}}" class="form-control" />
                                        </div>
                                        <label>Status: </label>
                                        <div class="form-group">
                                            {!! Form::select('status', Config::get('constants.status'), $faqs->status, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" id="category" class="btn btn-primary" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                            </tbody>
                            @endforeach
                        </table>
                        
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Table head options end -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-2">
                {{$cate->links()}}
                @else
                <h5 class="justify-content-center"> No Data found</h5>
                 @endif
            </ul>
        </nav>
    </div>
</div>
@endsection
