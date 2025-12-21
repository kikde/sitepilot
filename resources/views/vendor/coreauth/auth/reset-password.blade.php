@extends('coreauth::layouts.auth')

@section('content')
<div class="auth-wrapper auth-v2">
  <div class="auth-inner row m-0">
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        <img class="img-fluid" src="{{ asset('backend/app-assets/images/pages/reset-password-v2.svg') }}" alt="Reset password" />
      </div>
    </div>
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-10 col-md-8 col-lg-12 px-xl-2 mx-auto">
        <h4 class="card-title mb-1">Reset Password</h4>
        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $email ?? '') }}" required />
          </div>

          <div class="form-group">
            <label class="form-label" for="password">New Password</label>
            <input id="password" class="form-control" type="password" name="password" required />
          </div>

          <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
          </div>

          <button class="btn btn-primary btn-block" type="submit">Update Password</button>
        </form>
        <p class="text-center mt-2">
          <a href="{{ route('login') }}"><i data-feather="chevron-left"></i> Back to login</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

