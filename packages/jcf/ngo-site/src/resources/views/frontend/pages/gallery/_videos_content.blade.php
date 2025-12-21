<section class="feedback-section sec-pad">
  <div class="auto-container">
      <div class="sec-title text-center">
          <h6>Videos</h6>
      </div>
      @if(count($videos)> 0)
      <div class="row clearfix">
          @foreach($videos as $gallery)
          <div class="col-lg-4 col-md-6 col-sm-12 feedback-block">
              <div class="feedback-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                  <div class="inner-box">
                      <figure class="image-box"><img src="{{ asset('backend/gallery/photo/'.$gallery->images) }}" alt=""></figure>
                      <div class="video-btn">
                          <a href="{{asset('backend/gallery/video/'.$gallery->video)}}" class="lightbox-image" data-caption=""><i class="flaticon-play-button-arrowhead"></i></a>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach

      </div>
      <div class="pagination-wrapper centred">
          {{ $videos->links('vendor.pagination.default') }}
      </div>
              @else
              <h5 class="justify-content-center"> No Data found</h5>
              @endif
      </div>
</section>

