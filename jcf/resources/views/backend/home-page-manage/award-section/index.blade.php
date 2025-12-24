@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Award Section</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Award list
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <a href="{{url('/home/add-award')}}" class="btn-icon btn btn-primary btn-round btn-sm" type="button" ><i data-feather="plus"></i>Add New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body"> 
        @if(count($award)> 0)
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
                                    <th>Images</th>
                                    <th>Title</th>
                                    <th>Descriptin</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach($award as $list)
                            <tbody>
                                <tr>
                                    <td>
                                        @if ($list->images)
                                            <img src="{{asset('backend/home/award/'.$list->images)}}" class="mr-75" height="80" width="80" alt="Angular" />
                                        @else
                                            <img src="{{asset('frontend/custom/breadcrump.png')}}" class="mr-75" height="80" width="80" alt="Angular" />
                                       
                                        @endif
                                    </td>
                                    <td>{{$list->title}}</td>
                                    <td>{{$list->description}}</td>
                                    <td> 
                                        @if($list->status == "Published")
                                        <span class="badge badge-pill badge-light-success mr-1">Published</span>
                                        @elseif($list->status == "Pending")
                                        <span class="badge badge-pill badge-light-primary mr-1">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-light-info mr-1">Draft</span>
                                        @endif
                                    </td>


                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{url('/home/edit-award/'.$list->id)}}">
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/home/delete-award/'.$list->id) }}" onclick="event.preventDefault(); document.getElementById('delete-media-post-{{ $list->id }}').submit();">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </a>
                                                <form id="delete-media-post-{{ $list->id }}" +
                                                    action="{{ url('/home/delete-award/'.$list->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                               
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
                {{$award->links()}}
                @else
                <h5 class="justify-content-center"> No Data found</h5>
                 @endif
            </ul>
        </nav>
    </div>
</div>
@endsection
