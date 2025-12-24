@extends('layouts.formtheme')

@section('content')

{{-- <div class="content-overlay"></div>
<div class="header-navbar-shadow"></div> --}}
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-v2">
            <div class="auth-inner row m-0">
                <!-- Brand logo-->
                {{-- <a class="brand-logo" href="javascript:void(0);">

                    <img class="img-fluid" src="{{asset('backend/icons/'.$setting->favicon_icon)}}" alt="Register"  />

                </a> --}}
                <!-- /Brand logo-->
                <!-- Left Text-->
                <div class="d-none d-lg-flex col-lg-6 align-items-center p-0">
                    <div class="w-100 d-lg-flex align-items-center justify-content-center">
                        <img class="" src="{{asset('backend/app-assets/images/pages/ngo-ragistration.png')}}" alt="Register V2" width="900" height="850"/>


                    </div>

                </div>

                <!-- /Left Text-->

                <!-- Register-->
                <div class="d-flex col-lg-6 align-items-center auth-bg px-2 p-lg-5">

                    <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                        {{-- @include('backend.partials.message') --}}

                        <h2 class="card-title font-weight-bold mb-1 test">New Member Registration</h2>
                        {{-- <p class="card-text mb-2">Online ID Card Application Form</p> --}}
                            <form class="auth-register-form mt-2" action="{{url('/user-registration')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- <form class="form"> --}}
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Name</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Name" value="sara" name="name" required/>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect">Gender</label>
                                            {!! Form::select('gender', Config::get('constants.gender'), null, ['class'=>"form-control",'value' => 'female', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="dob-column">DOB</label>
                                            <input type="date" id="dob-column" class="form-control" placeholder="DOB" name="dob" value="<?php echo date('Y-m-d'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="=father-floating">Father Name</label>
                                            <input type="text" id="father-floating" class="form-control" name="fname" value="modafaq" placeholder="Father Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect">Profession</label>
                                            {!! Form::select('profession', Config::get('constants.profession'), null, ['class'=>"form-control",'value' => 'student', 'reqired']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect">Blood Group</label>
                                            {!! Form::select('bloodgroup',Config::get('constants.bloodgroup'), null, ['class'=>"form-control",'value' => 'A+', 'reqired']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect" >State</label>

                                            <select name="state" id="state"  class="form-control">
                                                <option value="Delhi">Delhi</option>
                                                @foreach($getlist as $key=>$value)
                                                <option value="{{$key}}">{{$key}}</option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customSelect">City</label>
                                            <select class="custom-select" id="city">
                                                <option value="delhi">Delhi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile-column">Mobile</label>
                                            <input type="tel" id="mobile-column" class="form-control" name="mobile" inputmode="numeric" pattern="[6-9][0-9]{9}" maxlength="10" placeholder="10-digit mobile" value="" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Email</label>
                                            <input type="email" id="email-id-column" class="form-control" name="email" value="kikde.sara@gmail.com"  placeholder="Email" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input class="form-control" id="address" rows="3" name="address" value="dsjfkf" placeholder="Address" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pincode-id-column">Pincode</label>
                                            <input type="number" id="pincode-id-column" class="form-control" name="pincode" placeholder="Pincode" maxlength="6" value="878723" />
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-12">
                                        <div class="media mb-0">
                                            <img src="{{asset('frontend/custom/user.png')}}" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />
                                            <div class="media-body mt-50">

                                                <div class="col-12 d-flex mt-1 px-0">
                                                    <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                        <span class="d-none d-sm-block">Upload</span>
                                                        <input class="form-control" type="file" name="images"  id="change-picture" hidden  />
                                                        <span class="d-block d-sm-none">
                                                            <i class="mr-0" data-feather="edit"></i>
                                                        </span>
                                                    </label>
                                                    <button class="btn btn-outline-secondary d-none d-sm-block">Remove</button>
                                                    <button class="btn btn-outline-secondary d-block d-sm-none">
                                                        <i class="mr-0" data-feather="trash-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column" class="font-weight-bolder">Select Id Type</label>
                                            {!! Form::select('idtype', Config::get('constants.idtype'), null, ['class'=>"form-control",'value' => 'Aadhaar', 'reqired']) !!}
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">uploadfile</label>
                                            <input type="file" id="brouchure" class="form-control" name="brouchure"  value=""placeholder="" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">

                                            <label for="messages">Other Documents</label>
                                            <input type="file" id="account-upload" class="form-control"  name="documents" />

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="hidden" id="account-upload" class="form-control"  name="status" value="0"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <button type="submit" class="btn btn-danger ml-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary ml-2">Reset</button>
                                    </div>

                                </div>
                            </form>

                        <p class="text-center mt-2"><span>Already have an account?</span><a href="{{url('/download')}}"><span>&nbsp;Download Your IdCard</span></a></p>
                        <div class="divider my-2">
                            <div class="divider-text">or</div>
                        </div>
                        <div class="auth-footer-btn d-flex justify-content-center">
                            <a class="btn btn-facebook" href="javascript:void(0)"><i data-feather="facebook"></i></a>
                            <a class="btn btn-twitter white" href="javascript:void(0)"><i data-feather="twitter"></i></a>
                            <a class="btn btn-google" href="javascript:void(0)"><i data-feather="mail"></i></a>
                            <a class="btn btn-github" href="javascript:void(0)"><i data-feather="github"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /Register-->
            </div>
        </div>
    </div>
</div>


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
