        <!-- project-section -->
        <section class="project-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h6>Our Media Coverage</h6>
                    <h2>Recently Add Media</h2>
                </div>
                <div class="project-inner">
                    <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                        {{-- @if(count($story)> 0) --}}
                        @foreach($story as $list)
                        <div class="project-block-one">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{asset('backend/story/'.$list->image)}}" alt=""></figure>
                                <div class="text">
                                    <h4>{{$list->title}}</h4>
                                    <a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}"><i class="fal fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    
                        {{-- {{ $story->links('vendor.pagination.default') }}  --}}
                        {{-- @else
                        <h5 class="justify-content-center"> No Data found</h5>
                        @endif --}}
                        
                    </div>
                </div>
                <!-- <div class="btn-box">
                    <a href="{{url('/success-story')}}" class="theme-btn-three thm-btn blue-color">View All Media</a>
                </div> -->
              
            </div>
        </section>
        <!-- project-section end -->

            