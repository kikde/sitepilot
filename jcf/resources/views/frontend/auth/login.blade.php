@extends('layouts.master')

@section('content')

 <!-- Page Title -->
 <section class="page-title style-two centred" style="background-image: url({{asset('frontend/assets/images/background/support-ticket.png')}});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>Manager Login</h1>
            </div>
           
        </div>
    </div>
</section>
<!-- End Page Title -->
 <!-- checkout-page-section -->
 <section class="checkout-page-section centered">
    <div class="auto-container ">
        <div class="order-information">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 left-column">
                    <div class="information-inner">
                         <div class="contact-information">
                            <h2>Login to create support ticket</h2>
                            
                            <form action="{{route('login')}}" method="post" >
                                @csrf
                                
                                <div class="field-input">
                                    <input type="email" name="email" placeholder="Email Address" required="">
                                </div>
                                <div class="field-input">
                                        <input type="text" name="password" placeholder="Enter Password" required="">                               
                                    {{-- <input type="password" name="password" placeholder="Phone Number" required=""> --}}                               
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        <small>Forgot Password?</small>
                                    </a>
                                    @endif
                                </div>
                                <div class="field-input">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control material-checkbox" for="remember_front">
                                            <input id="remember_front" name="remember" value="1" type="checkbox" class="material-control-input" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="material-control-indicator"></span>
                                            <span class="description">Remember Me</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group btn-box">
                                    <button type="submit" class="theme-btn-three thm-btn">Login</button>
                                </div>
                            </form>
                            <p class="text-center mt-2">
                                <span>New on our platform?</span>
                                <a href="{{url('registers')}}">
                                    <span>Create an account</span>
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



@endsection
