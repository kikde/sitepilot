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
                            
                            <li class="breadcrumb-item"><a href="#">Create Donors</a>
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
                            <h4 class="card-title">Add Donors</h4>
                        </div>
                        <div class="card-body">
                          
                            <!-- Form -->
                            <form  class="mt-2" action="{{url('/donors')}}" method="post" enctype="multipart/form-data" >
                                @csrf

                                 <!-- header media -->
                                 <div class="media">
                                    <a href="javascript:void(0);" class="mr-25">
                                        
                                        <img src="{{asset('backend/uploads/user.jpg')}}"
                                            id="account-upload-img" class="rounded mr-50" alt="profile image"
                                            height="80" width="80" value="" />
                                    </a>
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
                                            <input type="text" id="blog-edit-title" class="form-control" name="name" onchange="fillslug(this.value)" placeholder="" value="" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Email</label>
                                            <input type="email" id="email" class="form-control" name="email"   />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="edit-title">Mobile</label>
                                            <input type="tel" id="edit-title" class="form-control" name="mobile"  placeholder="" value=""maxlength="10"  required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Pan No.</label>
                                            <input type="text" id="pan_no" class="form-control" name="pan_no"   />
                                        </div>
                                    </div>

                                      <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Address</label>
                                            <input type="text" id="address" class="form-control" name="address" value="" placeholder="" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect" >State</label> 
                                            
                                            <select name="state" id="state"  class="form-control" required>
                                                <option value="">Select State</option>
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
                                                <option value="Select">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Pincode</label>
                                            <input type="text" id="pincode" class="form-control" name="pincode"   />
                                        </div>
                                    </div>
                                  
                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Page Keyword</label>
                                            <input type="text" id="blog-edit-slug" class="form-control" name="pagekeyword" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-status">Status</label>
                                            {!! Form::select('pagestatus', Config::get('constants.pagestatus'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div>

                                   <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label>Description</label>
                                            <div id="blog-editor-wrapper">
                                               
                                                    
                                                    <input type="hidden"  class="form-control" name="description" id="description" />

                                                    <div id="blog-editor-container">
                    
                                                        <div class="editor" > 
 
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
                </div>
            </div>
        </div>
        <!--/ Blog Edit -->

    </div>
</div>


<Script>

function fillslug(val) {
  
  var str = val;
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
