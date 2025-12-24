@extends('layouts.master')

@section('content')

@php
  // Optional: human-friendly title based on filter
  $title = 'Our Photo Gallery';
  if ($share_site === 'certificate') {
      $title = 'Our Certificates';
  }
@endphp

<!-- Page Title -->
<!-- <section class="page-title style-two centred" style="background-image: url({{ asset('frontend/assets/images/background/media.png') }});">
  <div class="auto-container">
    <div class="content-box">
      <div class="title">
        <h1>{{ $title }}</h1>
      </div>
    </div>
  </div>
</section> -->
<!-- End Page Title -->

<!-- Optional filter tabs -->
<div class="auto-container">
  <div class="d-flex gap-2 justify-content-center my-3 flex-wrap">
    <a href="{{ route('front.photo') }}"
       class="btn btn-sm {{ $share_site ? 'btn-outline-primary' : 'btn-primary' }}">
      All Photos
    </a>

    <a href="{{ route('front.photo', ['share_site' => 'certificate']) }}"
       class="btn btn-sm {{ $share_site==='certificate' ? 'btn-primary' : 'btn-outline-primary' }}">
      Certificates
    </a>

    {{-- Add more categories if you use them --}}
    {{-- <a href="{{ route('front.photo', ['share_site' => 'project']) }}" class="btn btn-sm {{ $share_site==='project' ? 'btn-primary' : 'btn-outline-primary' }}">Projects</a> --}}
  </div>
</div>

<!-- project-style-two -->
<section class="project-style-two sec-pad-2">
  <div class="auto-container">
    <div class="row clearfix">

      @if($photos->count() > 0)
        @foreach($photos as $gallery)
          <div class="col-lg-4 col-md-6 col-sm-12 project-block">
            <div class="project-block-two">
              <div class="inner-box">
                @if($gallery->images)
                  <figure class="image-box">
                    <img src="{{ asset('backend/gallery/photo/'.$gallery->images) }}" alt="{{ $gallery->title ?? 'Photo' }}">
                  </figure>
                @else
                  <figure class="image-box">
                    <img src="{{ asset('frontend/custom/breadcrumb.png') }}" alt="Placeholder">
                  </figure>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="col-12 text-center">
          <h5 class="justify-content-center">No Data found</h5>
        </div>
      @endif

    </div>

    <div class="pagination-wrapper centred">
      {{ $photos->links('vendor.pagination.default') }}
    </div>
  </div>
</section>
<!-- project-style-two end -->

@endsection
