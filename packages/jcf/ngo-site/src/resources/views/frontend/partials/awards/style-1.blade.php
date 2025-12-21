        <!-- award-section -->
        <section class="award-section">
            <div class="bg-layer" style="background-image: url({{ asset('backend/home/award/'.$statics->background)}});"></div>
            <div class="auto-container">
                <div class="sec-title text-center light">
                    <h6>{{$statics->heading}}</h6>
                    <h2>{!!$statics->subheading!!}</h2>
                </div>
                <div class="two-column-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                    @if(count($award)>0)
                    @foreach($award as $list)
                    <div class="award-block-one">
                        <div class="inner-box">
                            <figure class="award-image"><img src="{{asset('backend/home/award/'.$list->images)}}" alt=""></figure>
                            <h4>{{$list->title}}</h4>
                            <p>{{$list->description}}</p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    No Data Found
                    @endif
                    {{-- <div class="award-block-one">
                        <div class="inner-box">
                            <figure class="award-image"><img src="{{asset('frontend/assets/images/resource/award-5.png')}}" alt=""></figure>
                            <h4>Best Choice Award - 2008</h4>
                            <p>Indignation and dislike men who are so demoralized by the charms of pleasure of the moment.</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- award-section end -->


        