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
                        <a href="#" class="brand-logo">
                            <img src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" height="150" width="150">
                            {{-- <h2 class="brand-text text-primary ml-1 mt-4">TTCL</h2> --}}
                        </a>
                        <h4 class="card-title mb-1 text-primary text-center">Please Verify Email</h4>
                       

                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>

                        {{-- <p class="text-center mt-2">
                            <span>New on our platform?</span>
                            <a href="#">
                                <span>Create an account</span>
                            </a>
                        </p> --}}

                        <div class="divider my-2">
                            <div class="divider-text">or</div>
                        </div>

                        <div class="auth-footer-btn d-flex justify-content-center">
                            <a class="btn btn-facebook" href="{{$setting->facebook_url}}"><i data-feather="facebook"></i></a>
                            <a class="btn btn-twitter white" href="{{$setting->twitter}}"><i data-feather="twitter"></i></a>
                            <a class="btn btn-google" href="{{$setting->twitter}}"><i data-feather="youtube"></i></a>
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
