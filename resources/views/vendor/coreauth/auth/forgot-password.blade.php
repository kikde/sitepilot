@extends('coreauth::layouts.auth')

@section('content')
<div class="auth-wrapper auth-v2">
  <div class="auth-inner row m-0">
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        <img class="img-fluid" src="{{ asset('backend/app-assets/images/pages/forgot-password-v2.svg') }}" alt="Forgot password" />
      </div>
    </div>
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-10 col-md-8 col-lg-12 px-xl-2 mx-auto">
        <h4 class="card-title mb-1">Forgot Password?</h4>
        <p class="card-text mb-2">Enter your email and we'll send reset instructions.</p>

        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required />
          </div>
          <button class="btn btn-primary btn-block" type="submit">Send Reset Link</button>
        </form>
        <p class="text-center mt-2">
          <a href="{{ route('login') }}"><i data-feather="chevron-left"></i> Back to login</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

