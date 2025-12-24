@extends('layouts.master')

@section('content')


   <!-- Page Title -->
   <!-- <section class="page-title style-two centred" style="background-image: url({{asset('frontend/assets/images/background/media.png')}});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>Our Video Gallery</h1>
            </div>
            {{-- <ul class="bread-crumb clearfix">
                <li><a href="{{url('/')}}">Home</a></li>
              
            </ul> --}}
        </div>
    </div>
</section> -->
<!-- End Page Title -->


  <!-- feedback-section -->
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
                        {{-- <div class="share-option">
                            <span><i class="flaticon-share"></i>Share</span>
                            <ul class="share-links clearfix">
                                 <li><a href='https://www.facebook.com/sharer/sharer.php?u=https%3A//delhi91.org/{{$gallery->video}}'><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkdin"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="pagination-wrapper centred">
            {{ $videos->links('vendor.pagination.default') }} 
                    @else
                    <h5 class="justify-content-center"> No Data found</h5>
                    @endif
        </div>
        

    </div>
</section>
<!-- feedback-section end -->



@endsection