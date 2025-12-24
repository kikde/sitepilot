@extends('layouts.master')

@section('content')

 <!-- Page Title -->
 <section class="page-title style-two centred" style="background-image: url({{asset('frontend/assets/images/background/support-ticket.png')}});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>Manager Register</h1>
            </div>
          
        </div>
    </div>
</section>
<!-- End Page Title -->
 <!-- checkout-page-section -->
 <section class="checkout-page-section ">
    <div class="auto-container">
        <div class="order-information ">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 left-column">
                    <div class="information-inner">
                      
                        <div class="shopping-address">
                            <h2>Register New Account</h2>
                            <form action="{{ route('register') }}" method="POST" >
                                @csrf
                            <div class="row clearfix">
                               
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="name" placeholder="Name" required="">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="email" name="email" placeholder="Email" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <div class="select-box">
                                            <select class="wide" name="state" id="state" >
                                                <option data-display="Select State">Select State</option>
                                                @foreach($getlist as $key=>$value)
                                                <option value="{{$key}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="city" placeholder="City" required="">
                                        {{-- <select class="wide" id="city">
                                            <option data-display="Select City">Select City</option>
                                        </select> --}}
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="password" placeholder="Password" required="">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="password_confirmation" placeholder="Confirm Password" required="">
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="status" name="status" value="1" placeholder="" />
                                <input type="hidden" class="form-control" id="role" name="role" value="3" placeholder="" />
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="field-input">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control material-checkbox">
                                                <input type="checkbox" class="material-control-input">
                                                <span class="material-control-indicator"></span>
                                                <span class="description">I agree to <a href="javascript:void(0);">privacy policy & terms</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="form-group btn-box">
                                    <button type="submit" class="theme-btn-three thm-btn">Register</button>
                                </div>
        
                            </div>
                        </form>
                        <p class="text-center mt-2">
                            <span>Already have an account?</span>
                            <a href="{{url('/manager-login')}}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
       
    </div>
</section>
<!-- checkout-page-section end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>


<script type='text/javascript'>

jQuery('#state').change(function(){
    console.log('im in');
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