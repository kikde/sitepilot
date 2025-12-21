@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Members</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Add New </a>
                                </li>
                               
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
       
        
        <div class="content-body">


              <!-- Basic multiple Column Form section start -->
              <section id="multiple-column-form">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Member</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" action="{{ url('/members') }}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column" class="font-weight-bolder">Name</label>
                                                <input type="text" id="name" class="form-control" name="name" onchange="fillslug(this.value)" value=""placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="customSelect">Gender</label>
                                                {!! Form::select('gender', Config::get('constants.gender'), null, ['class'=>"form-control",'placeholder' => 'Pick a Gender...', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12"> 
                                            <div class="form-group">
                                                <label for="dob-column">DOB</label>
                                                <input type="date" id="dob-column" class="form-control" placeholder="DOB" name="dob" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="=father-floating">Father Name</label>
                                                <input type="text" id="father-floating" class="form-control" name="father_name" placeholder="Father Name" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="customSelect">Profession</label>
                                                {!! Form::select('profession', Config::get('constants.profession'), null, ['class'=>"form-control",'placeholder' => 'Select...', 'reqired']) !!}
                                            </div>
                                        </div>
    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="customSelect">Blood Group</label>
                                                {!! Form::select('bloodgroup', Config::get('constants.bloodgroup'), null, ['class'=>"form-control",'placeholder' => 'Select...', 'reqired']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="customSelect" >State</label> 
                                                
                                                <select name="state" id="state"  class="form-control">
                                                    <option value="">Select State</option>
                                                    @foreach($states as $key=>$value)
                                                    <option value="{{$key}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                           
                                               
                                            </div>
                                        </div>
            
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="customSelect">City</label>
                                                <select name="city" class="custom-select" id="city">
                                                    <option value="Select">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                     
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="mobile-column">Mobile</label>
                                                <input type="tel" id="mobile-column" class="form-control" name="mobile" placeholder="Mobile" maxlength="10" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Email</label>
                                                <input type="email" id="email-id-column" class="form-control" name="email" placeholder="Email" required/>
                                            </div>
                                        </div>
            
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input class="form-control" id="address" rows="3" name="address" placeholder="Address" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="pincode-id-column">Pincode</label>
                                                <input type="number" id="pincode-id-column" class="form-control" name="pincode" placeholder="Pincode" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"class="font-weight-bolder">Slug</label>
                                                <input type="text" id="slug" class="form-control" name="slug"  value="" placeholder="" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"class="font-weight-bolder">Page Title</label>
                                                <input type="text" id="slug" class="form-control" name="page_title"  value="" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"class="font-weight-bolder">Page Keyword</label>
                                                <input type="text" id="slug" class="form-control" name="page_keyword"  value="" placeholder="" />
                                            </div>
                                        </div>
                                      
                                       
                                  
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column" class="font-weight-bolder">Ratings</label>
                                                <input type="number" id="rating" class="form-control" name="rating"  value=""placeholder="" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column" class="font-weight-bolder">Select Id Type</label>
                                                {!! Form::select('idtype', Config::get('constants.idtype'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column" class="font-weight-bolder">uploadfile</label>
                                                <input type="file" id="uploadfile" class="form-control" name="uploadfile"  value=""placeholder="" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="border rounded p-2">
                                                <h4 class="mb-1">Profile Image</h4>
                                                <div class="media flex-column flex-md-row">
                                                    <img src="{{asset('frontend/custom/breadcrump.png')}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                                    <div class="media-body">
                                                      
                                                        <p class="my-50">
                                                            <a href="javascript:void(0);" id="blog-image-text">Required image resolution 270x280.</a>
                                                        </p>
                                                        <div class="d-inline-block">
                                                            <div class="form-group mb-0">
                                                                <div class="custom-file">
                                                                    <input type="file" name="images" class="custom-file-input"  id="blogCustomFile" value="" accept="image/*" />
                                                                    <label class="custom-file-label" for="blogCustomFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group row  increment ">
                                                <div class="col-sm-3 col-form-label font-weight-bolder">
                                                    <label for="messages">Other Documents</label>
                                                </div>
                                             
                                                <input type="file" id="account-upload" class="form-control"  name="document"  multiple/>

                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column" class="font-weight-bolder">Status</label>
                                                {!! Form::select('status', Config::get('constants.status'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                            </div>
                                        </div>
                                       
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Floating Label Form section end -->
                   

        </div>
    </div>
</div>



<script type="text/javascript">

function fillslug(val) {
  
  var str = val;
  str = str.replace(/\s+/g, '-').toLowerCase();
  console.log(str);
  document.getElementById("slug").value = str;
  }
   
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>


<script type='text/javascript'>

jQuery('#state').change(function(){
    // console.log('im in');
				let sid=jQuery(this).val();
                console.log(sid);
				jQuery.ajax({
					url:'/city-listby',
					type:'post',
					data:'sid='+sid+'&_token={{csrf_token()}}',
					success:function(result){
						jQuery('#city').html(result)
					}
				});
			});

    </script>
@endsection

