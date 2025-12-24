@extends('layouts.auth')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-v1 px-2">
            <div class="auth-inner py-2">
                <!-- Login v1 -->
                <div class="card mb-0">
                    <div class="card-body">
                        
                           <img class="rounded mx-auto d-block " src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" height="180" width="180">
                            <h2 class="brand-text text-primary text-center">{{$setting->title}}</h2>

                        <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="login-email" class="form-label">Enter Email</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="login-password">Password</label>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        <small>Forgot Password?</small>
                                    </a>
                                    @endif
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password"
                                        class="form-control form-control-merge  @error('password') is-invalid @enderror"
                                        id="password" name="password" tabindex="2" value=""
                                        aria-describedby="login-password" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="remember" name="remember" value="1" tabindex="3" {{ old('remember') ? 'checked' : '' }} />
                                    <label class="custom-control-label" for="remember"> Remember Me </label>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-block" tabindex="4">Sign in</button>
                        </form>

                        <!-- <p class="text-center mt-2">
                            <span>New on our platform?</span>
                            <a href="{{route('register')}}">
                                <span>Create an account</span>
                            </a>
                        </p> -->

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
                <!-- /Login v1 -->
            </div>
        </div>

    </div>
</div>


@endsection
