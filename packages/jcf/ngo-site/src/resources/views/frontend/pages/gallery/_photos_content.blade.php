@php
  $title = 'Our Photo Gallery';
  if ($share_site === 'certificate') {
      $title = 'Our Certificates';
  }
@endphp

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
  </div>
</div>

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

