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
                            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
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
                            <h4 class="card-title">edit Donors</h4>
                        </div>
                        <div class="card-body">
                          
                            <!-- Form -->
                            <form  class="mt-2" action="{{url('/donors/'.$donarlist->id)}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <input id="id" type="text" class="form-control" name="id" value="{{$donarlist->id}}" hidden>
                                 <!-- header media -->
                                 <div class="media">
                                    @if($donarlist->profile)
                                    <a href="javascript:void(0);" class="mr-25">
                                        
                                        <img src="{{asset('backend/uploads/'.$donarlist->profile)}}"
                                            id="account-upload-img" class="rounded mr-50" alt="profile image"
                                            height="80" width="80" value="" />
                                    </a>
                                    @else
                                    <a href="javascript:void(0);" class="mr-25">
                                        
                                        <img src="{{asset('backend/uploads/user.jpg')}}"
                                            id="account-upload-img" class="rounded mr-50" alt="profile image"
                                            height="80" width="80" value="" />
                                    </a>
                                    @endif
                                    <!-- upload and reset button -->
                                    <div class="media-body mt-75 ml-1">
                                        <label for="account-upload"
                                            class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                        <input type="file" id="account-upload" hidden accept="image/*"
                                            name="profile" />
                                        <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                        <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <!--/ header media -->
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-title">Name</label>
                                            <input type="text" id="blog-edit-title" class="form-control" name="name" onchange="fillslug(this.value)" placeholder="" value="{{$donarlist->name}}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="edit-title">Mobile</label>
                                            <input type="tel" id="edit-title" class="form-control" name="mobile"  placeholder="" value="{{$donarlist->mobile}}" maxlength="10"  required/>
                                        </div>
                                     </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Email</label>
                                            <input type="text" id="email" class="form-control" name="email"  value="{{$donarlist->email}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Pan no.</label>
                                            <input type="text" id="pan_no" class="form-control" name="pan_no"  value="{{$donarlist->pan_no}}" />
                                        </div>
                                    </div>                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Address</label>
                                            <input type="text" id="address" class="form-control" name="address"  value="{{$donarlist->address}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect" >State</label> 
                                            
                                            <select name="state" id="state"  class="form-control" required>
                                                <option value="{{$donarlist->state}}">{{$donarlist->state}}</option>
                                                @foreach($getlist as $key=>$value)
                                                <option value="{{$key}}">{{$key}}</option>
                                                @endforeach
                                            </select>                                          
                                        </div>
                                    </div>       
                                   <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect">City</label>
                                            <select class="custom-select" name="city" id="city">
                                                <option value="{{$donarlist->city}}">{{$donarlist->city}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Pincode</label>
                                            <input type="text" id="pincode" class="form-control" name="pincode" value="{{$donarlist->pincode}}" placeholder="" />
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Page Keyword</label>
                                            <input type="text" id="blog-edit-slug" class="form-control" name="pagekeyword" value="{{$donarlist->pagekeyword}}" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-status">Status</label>
                                            {!! Form::select('pagestatus', Config::get('constants.pagestatus'), $donarlist->pagestatus, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label>Description</label>
                                            <div id="blog-editor-wrapper">
                                               
                                                    
                                                    <input type="hidden"  class="form-control" name="description" id="description" />

                                                    <div id="blog-editor-container">
                    
                                                        <div class="editor" > 
                                                         {!!$donarlist->description!!}
                                                       </div>
                                                      
                                                      </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}

                                    <div class="col-12 mt-50">
                                        <button type="submit"  id="btn-submit" class="btn btn-primary mr-1">Save Changes</button>
                                        <a href="{{ url('/donors') }}" class="btn btn-outline-secondary mt-0">Go Back</a>
                                    </div>
                                </div>
                            </form>
                            <!--/ Form -->
                        </div>
                    </div>

                    <div class="card mt-2">
                    <div class="card-header"><h4 class="card-title mb-0">Record a Donation</h4></div>
                    <div class="card-body">
                        <form action="{{ route('admin.donations.store', $donarlist->id) }}" method="POST">
                        @csrf
                        <div class="row g-1">
                            <div class="col-md-3">
                            <label class="form-label">Amount (INR)</label>
                            <input type="number" step="0.01" min="1" class="form-control" name="amount" required>
                            </div>
                            <div class="col-md-3">
                            <label class="form-label">Campaign</label>
                            <input type="text" class="form-control" name="campaign" placeholder="e.g. Relief Fund">
                            </div>
                            <div class="col-md-3">
                            <label class="form-label">Payment Mode</label>
                            <select name="pay_mode" class="form-control">
                                <option value="cash">Cash</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="cheque">Cheque</option>
                                <option value="upi">UPI</option>
                                <option value="razorpay">Razorpay</option>
                                <option value="other">Other</option>
                            </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mark_paid" name="mark_paid" value="1">
                                <label class="form-check-label" for="mark_paid">Mark as Paid (issue receipt)</label>
                            </div>
                            </div>
                            <div class="col-12">
                            <label class="form-label">Notes</label>
                            <input type="text" class="form-control" name="notes" placeholder="Txn ref / remarks">
                            </div>
                            <div class="col-12 mt-1">
                            <button type="submit" class="btn btn-success">Save Donation</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Blog Edit -->

    </div>
</div>


<Script>

function fillslug(val) {

  var str = val;
//   console.log(str);

  str = str.replace(/\s+/g, '-').toLowerCase();
  console.log(str);
  document.getElementById("slug").value = str;
  }

$('#btn-submit').on('click', () => { 
    var myEditor = document.querySelector('.editor');

    // console.log(myEditor);
    // Get HTML content
    var html = myEditor.children[0].innerHTML;

    // alert(html);
    // Copy HTML content in hidden form
   $('#description').val( html )

    // console.log(html);

    // Post form
    myForm.submit();

})



</Script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script type='text/javascript'>

    jQuery('#state').change(function(){
        // console.log('im in');
                    let sid=jQuery(this).val();
                    console.log(sid);
                    jQuery.ajax({
                        url:'/city-list',
                        type:'post',
                        data:'sid='+sid+'&_token={{csrf_token()}}',
                        success:function(result){
                            jQuery('#city').html(result)
                        }
                    });
                });
    
        </script>

@endsection
