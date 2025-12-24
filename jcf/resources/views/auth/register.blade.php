@extends('layouts.auth')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-v1 px-2">
            <div class="auth-inner py-2">
                <!-- Register v1 -->
                <div class="card mb-0">
                    <div class="card-body">
                    
                            <img class="rounded mx-auto d-block " src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" height="180" width="180">
                            <h2 class="brand-text text-primary text-center">{{$setting->title}}</h2>
                     
                        

                        <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="register-username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="register-username" name="username" placeholder="" aria-describedby="register-username" tabindex="1" autofocus />
                            </div> --}}

                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="" aria-describedby="register-name" tabindex="1" required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="register-email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="register-email" name="email" placeholder="" aria-describedby="register-email" tabindex="2" required />
                            </div>

                            <div class="form-group">
                                <label for="register-password" class="form-label">Password</label>

                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" id="register-password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password"  required tabindex="3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="register-password" class="form-label">Confirm Password</label>

                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" id="password_confirmation" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" required tabindex="3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                              
                                <input type="text" class="form-control" id="regno" name="regno" placeholder="" value="" aria-describedby="regno" tabindex="2" hidden/>
                            </div>
                            <input type="text" class="form-control" id="useractive" name="useractive" placeholder="" value=""  hidden/>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="checkbox"  id="register-privacy-policy"tabindex="4" />
                                    <label class="custom-control-label" for="register-privacy-policy">
                                        I agree to <a href="{{$setting->url}}">privacy policy & terms</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block" tabindex="5">Sign up</button>
                        </form>

                        <p class="text-center mt-2">
                            <span>Already have an account?</span>
                            <a href="{{route('login')}}">
                                <span>Sign in instead</span>
                            </a>
                        </p>

                        <div class="divider my-2">
                            <div class="divider-text">or</div>
                        </div>

                        <div class="auth-footer-btn d-flex justify-content-center">
                            <a class="btn btn-facebook" href="{{$setting->facebook_url}}"><i data-feather="facebook"></i></a>
                            <a class="btn btn-twitter white" href="{{$setting->twitter}}"><i data-feather="twitter"></i></a>
                            <a class="btn btn-google" href="{{$setting->insta_url}}"><i data-feather="youtube"></i></a>
                            <a class="btn btn-github" href="{{$setting->linkdin_url}}"><i data-feather="linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /Register v1 -->
            </div>
        </div>

    </div>
</div>




@endsection
