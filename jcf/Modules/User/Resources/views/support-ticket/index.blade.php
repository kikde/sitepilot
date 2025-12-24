@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">All Tickets</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">All Tickets

                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <a href="{{url('/support-tickets/create')}}" class="btn-icon btn btn-primary btn-round btn-sm" type="button" ><i data-feather="plus"></i>Add New Tickets</a>
                    
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
                    <div class="card-body">
                        <div class="bulk-delete-wrapper">
                                    <div class="select-box-wrap">
                                        <select name="bulk_option" id="bulk_option">
                                            <option value="">{{{__('Bulk Action')}}}</option>
                                            <option value="delete">{{{__('Delete')}}}</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                    </div>
                                </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover-animation">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <div class="mark-all-checkbox">
                                            <input type="checkbox" class="all-checkbox">
                                        </div>
                                    </th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Department</th>
                                    <th>User</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if(count($all_tickets)> 0)
                            @foreach($all_tickets as $users)
                            {{-- @if($users->role == 1) --}}
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="bulk-checkbox-wrapper">
                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$users->id}}">
                                        </div>
                                    </td>
                                    <td>#{{$users->id}}</td>
                                    <td>{{$users->title}}</td>
                                    <td>{{$users->department->name ?? 'anonymous'}}</td>
                                    <td>{{$users->user->name ?? 'anonymous'}}</td>
                                    <td>
                                        {{-- {{$users->priority}} --}}
                                        <div class="btn-group">
                                            <button type="button" class="{{$users->priority}} dropdown-toggle btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$users->priority}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item change_priority" data-id="{{$users->id}}" data-val="low" href="#">{{__('Low')}}</a>
                                                <a class="dropdown-item change_priority" data-id="{{$users->id}}" data-val="high" href="#">{{__('High')}}</a>
                                                <a class="dropdown-item change_priority" data-id="{{$users->id}}" data-val="medium" href="#">{{__('Medium')}}</a>
                                                <a class="dropdown-item change_priority" data-id="{{$users->id}}" data-val="urgent" href="#">{{__('Urgent')}}</a>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        {{-- @if ($users->status)
                                        <span class="badge badge-pill badge-light-primary mr-1">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-light-danger mr-1">Deactive</span>  
                                            @endif --}}
                                            <div class="btn-group">
                                                <button type="button" class="status-{{$users->status}} btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{$users->status}}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item status_change" data-id="{{$users->id}}" data-val="open" href="#">{{__('Open')}}</a>
                                                    <a class="dropdown-item status_change" data-id="{{$users->id}}" data-val="close" href="#">{{__('Close')}}</a>
                                                </div>
                                            </div>
                                        
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('/support-tickets/'.$users->id) }}" >
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/support-tickets/'.$users->id) }}" onclick="event.preventDefault(); document.getElementById('delete-media-post-{{ $users->id }}').submit();">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </a> 
                                                <form id="delete-media-post-{{ $users->id }}" +
                                                    action="{{ url('/support-tickets/'.$users->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                               
                            </tbody>
                            {{-- @endif --}}
                            @endforeach

                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-2">
                                {{-- {{ $all_tickets->links() }} --}}
                                @else
                                <h5 class="justify-content-center"> No Data found</h5>
                                @endif
                            </ul>
                        </nav>
                
                    </div>
                </div>
            </div>
        </div>
        <!-- Table head options end -->

    </div>
</div>
<x-datatable.js/>
    <script>

        $(function(){
            "use strict";

            <x-bulk-action-js :url="route('admin.support.ticket.bulk.action')"/>
            $(document).on('click','.change_priority',function (e){
               e.preventDefault();
               //get value
                var priority = $(this).data('val');
                var id = $(this).data('id');
                var currentPriority =  $(this).parent().prev('button').text();
                currentPriority = currentPriority.trim();
                $(this).parent().prev('button').removeClass(currentPriority).addClass(priority).text(priority);
               //ajax call
                $.ajax({
                    'type': 'post',
                    'url' : "{{route('admin.support.ticket.priority.change')}}",
                    'data' : {
                        _token : "{{csrf_token()}}",
                        priority : priority,
                        id : id,
                    },
                    success: function (data){
                        $(this).parent().find('button.'+currentPriority).removeClass(currentPriority).addClass(priority).text(priority);
                    }
                })
            });
            $(document).on('click','.status_change',function (e){
                e.preventDefault();
                //get value
                var status = $(this).data('val');
                var id = $(this).data('id');
                var currentStatus =  $(this).parent().prev('button').text();
                currentStatus = currentStatus.trim();
                $(this).parent().prev('button').removeClass('status-'+currentStatus).addClass('status-'+status).text(status);
                //ajax call
                $.ajax({
                    'type': 'post',
                    'url' : "{{route('admin.support.ticket.status.change')}}",
                    'data' : {
                        _token : "{{csrf_token()}}",
                        status : status,
                        id : id,
                    },
                    success: function (data){
                        $(this).parent().prev('button').removeClass(currentStatus).addClass(status).text(status);
                    }
                })
            });


        })(jQuery);
    </script>
@endsection
