@extends('coreauth::layouts.auth')

@section('content')
@php
  $setting = $setting ?? null;
  if (!$setting) {
    try {
      if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
        $q = \Illuminate\Support\Facades\DB::table('settings');
        if (function_exists('tenant_id') && \Illuminate\Support\Facades\Schema::hasColumn('settings', 'tenant_id')) {
          $q->where('tenant_id', tenant_id());
        }
        $setting = $q->first();
      }
    } catch (\Throwable $e) {
      $setting = null;
    }
  }
@endphp

<div class="auth-wrapper auth-v2">
  <div class="auth-inner row m-0">
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        <img class="img-fluid" src="{{ asset('backend/app-assets/images/pages/login-v2.svg') }}" alt="Login" />
      </div>
    </div>

    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-10 col-md-8 col-lg-12 px-xl-2 mx-auto">
        <div class="text-center mb-2">
          @if(!empty($setting?->favicon_icon))
            <img src="{{ asset('backend/icons/'.$setting->favicon_icon) }}" alt="Logo" style="height:64px; width:auto;" />
          @else
            <div class="brand-badge" style="margin:0 auto; width:64px; height:64px; border-radius:16px; font-size:22px;">BP</div>
          @endif
          <h3 class="mt-2 mb-0" style="font-weight:900; letter-spacing:.02em;">
            {{ $setting->title ?? config('app.name', 'BaseProject') }}
          </h3>
        </div>

        <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label class="form-label" for="login-email">Email</label>
            <input id="login-email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter email" />
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="login-password">Password</label>
              <a href="{{ route('password.request') }}"><small>Forgot Password?</small></a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input id="login-password" class="form-control form-control-merge" type="password" name="password" required placeholder="********" />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" id="remember-me" type="checkbox" name="remember" value="1" />
              <label class="custom-control-label" for="remember-me"> Remember Me</label>
            </div>
          </div>

          <button class="btn btn-primary btn-block" type="submit">Sign in</button>
        </form>

        <p class="text-center mt-2">
          <span>New on our platform?</span>
          <a href="{{ route('register') }}"><span>Create an account</span></a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
