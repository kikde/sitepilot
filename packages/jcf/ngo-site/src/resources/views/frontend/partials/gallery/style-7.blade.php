<!-- Gallery-section -->
     <section class="news-section sec-pad">
        <div class="auto-container">
            <div class="sec-title text-left">
                <h6>Journey in Pictures</h6>
                <h2>Gallery </h2>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                @foreach($photos as $gallery)
                <div class="news-block-one">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="{{$setting->site_url}}"><img src="{{('backend/gallery/photo/'.$gallery->images)}}" alt=""></a></figure>
                            {{-- <div class="post-date"><h6><span>30</span> Nov, 2020</h6></div> --}}
                        </div>
                        {{-- <div class="lower-content">
                            <div class="category"><a href="blog-details.html">Office Cleaning</a></div>
                            <h4><a href="blog-details.html">Your Need-To-Know Guide For Infection Control</a></h4>
                            <div class="link"><a href="blog-details.html">Read More</a></div>
                        </div> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Gallery-section end -->