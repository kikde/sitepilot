@extends('coreauth::layouts.auth')

@section('content')
<div class="auth-wrapper auth-v2">
  <div class="auth-inner row m-0">
    <div class="d-none d-lg-flex col-lg-7 align-items-center p-0">
      <div class="w-100 d-lg-flex align-items-center justify-content-center">
        <div style="max-width:520px;padding:24px;">
          <h2 style="font-weight:900;margin:0 0 10px;">Create Admin Account</h2>
          <p class="text-muted" style="margin:0;">After signup, select a tenant and assign roles/permissions.</p>
        </div>
      </div>
    </div>
    <div class="d-flex col-lg-5 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title font-weight-bold mb-1">Create account</h2>
        <p class="card-text mb-2">Fill details to continue.</p>
        <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group">
            <label class="form-label" for="reg-name">Name</label>
            <input class="form-control" id="reg-name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
          </div>
          <div class="form-group">
            <label class="form-label" for="reg-email">Email</label>
            <input class="form-control" id="reg-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
          </div>
          <div class="form-group">
            <label class="form-label" for="reg-password">Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="reg-password" type="password" name="password" required autocomplete="new-password">
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="reg-password-confirm">Confirm Password</label>
            <input class="form-control" id="reg-password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
          </div>
          <button class="btn btn-primary btn-block" type="submit">Create account</button>
        </form>
        <p class="text-center mt-2">
          <span>Already have an account?</span>
          <a href="{{ route('login') }}"><span>&nbsp;Sign in</span></a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

