@extends('layouts.master')

@section('content')
<section class="page-title style-two centred" style="background-image: url({{ asset('frontend/assets/images/background/donation.png') }});">
  <div class="auto-container">
    <div class="content-box">
      <div class="title"><h1>Thank You</h1></div>
      <ul class="bread-crumb clearfix">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Thank You</li>
      </ul>
    </div>
  </div>
</section>

<section class="checkout-page-section">
  <div class="auto-container">
    <div class="order-information">
      <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 left-column">
          <div class="information-inner">
            <div class="shopping-address">
              <h3 style="color:#0a267a">We appreciate your support!</h3>
              <p>Your donation has been processed successfully. A receipt has been generated and, if an email was provided, sent to your inbox.</p>
              <p><a class="theme-btn-four thm-btn" href="{{ url('/') }}">Back to Home</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 right-column">
          <div class="order-summary">
            <h4>Need Help?</h4>
            <div class="inner-box">
              <p>Contact us at <a href="mailto:{{ $setting->site_email ?? 'info@example.com' }}">{{ $setting->site_email ?? 'info@example.com' }}</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection