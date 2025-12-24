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
                            <li class="breadcrumb-item active">Media List
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <a href="{{url('/successstory/create')}}" class="btn-icon btn btn-primary btn-round btn-sm" type="button" ><i data-feather="plus"></i>Add New</a>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="content-body"> 

        <!-- Table Hover Animation start -->
        <div class="row" id="table-hover-animation">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">List</h4>
                        <h2 class="text-primary">Custom Url</h2>
                    </div> --}}
                    {{-- <div class="card-body">
                        <p class="card-text">
                            Add <code>.table-hover-animation</code> to enable a hover stat with animation on table rows within a
                            <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                        </p>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table table-hover-animation">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>STATUS</th>
                                    <th>View</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            @if(count($storylist)> 0)
                            @foreach($storylist as $lists)
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="{{$lists->id}}" value="{{$lists->id}}" >
                                            <label class="custom-control-label" for="{{$lists->id}}"></label>
                                        </div>
                                      
                                            
                                        </td>
                                        <td>{{$lists->title}}</td>
                                    <td>
                                        @if($lists->image)
                                        <img src="{{asset('/backend/story/'.$lists->image)}}" class="rounded  mr-50" height="90" width="90" alt="Angular" />
                                        @else
                                        <img src="{{asset('frontend/custom/breadcrump.png')}}" class="rounded  mr-50" height="90" width="90" alt="Angular" />
                                        @endif
                                    </td>
                                    <td>{{ $lists->category->name ?? 'Uncategorized' }}</td>
                                    
                                    <td>{{date_format($lists->updated_at,'d M Y')}}</td>
                                
                                 
                                   
                                    <td>
                                        @if ($lists->status== 'Published')
                                        <span class="badge badge-pill badge-light-primary mr-1">Published</span>
                                            @elseif ($lists->status== 'Pending')
                                            <span class="badge badge-pill badge-light-warning mr-1">Pending</span>  
                                            @else
                                            <span class="badge badge-pill badge-light-danger mr-1">Darft</span>  
                                            @endif
                                    </td>
                                    <td> <a href="{{ url('/successstory/'.$lists->id.'/'.$lists->slug) }}" target="_blank"><i data-feather='eye'></i></a></td>
                                    <td>
                                         
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('/successstory/'.$lists->id ) }}" >
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/successstory/'.$lists->id ) }}" onclick="event.preventDefault(); document.getElementById('delete-media-post-{{ $lists->id }}').submit();" >
                                                     <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </a> 
                                                <form id="delete-media-post-{{ $lists->id }}" +
                                                    action="{{ url('/successstory/'.$lists->id) }}" method="post">
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
                {{ $storylist->links() }}
                @else
                <h5 class="justify-content-center"> No Data found</h5>
                @endif
            </ul>
        </nav>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js" 
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
crossorigin="anonymous"></script>
<script type="text/javascript">
// var madeurl ='http://127.0.0.1:8000/product-query/';


// var customurl = document.getElementById('xxx');


// console.log(customurl);


$(document).ready(function() {
$('input:checkbox').change(function() {
   
  var isChecked = $('input:checkbox:checked').map(function() {
    return this.value;
  }).toArray();
  // convert the array to a string
  isChecked = isChecked.toString();
  console.log(isChecked);
  // if string contains ',', then run this function
//   while (isChecked.indexOf(',') > -1) {
//     //then replace the commas
//     isChecked = isChecked.replace(' ', ',');
//   }
  // show on the page
  $('h2').text('https://www.vihatmaa-sewa-foundation.kikde.com/media-coverage/'+isChecked);
});
});

 </script>