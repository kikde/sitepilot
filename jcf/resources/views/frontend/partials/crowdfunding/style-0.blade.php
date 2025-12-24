<!-- Crowdfunding Start-->
<section class="news-section sec-pad">
    <div class="auto-container">
        <div class="sec-title text-left">
            <h6>Recent Causes </h6>
            <h2>Featurd Campaign</h2>
        </div>
        <div class="three-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
            @foreach($secmenu as $items)
            <div class="news-block-one">
                <div class="inner-box">
                    <div class="image-box">
                        <figure class="image"><a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}"><img src="{{asset('/backend/uploads/'.$items->breadcrumb)}}" alt=""></a></figure>
                        {{-- <div class="post-date"><h6><span>30</span> Nov, 2020</h6></div> --}}
                    </div>
                    <div class="lower-content">
                        <div class="progress-box">

                            <div class="bar">
                                <div class="bar-inner count-bar counted" data-percent="72%" style="width: 72%;"></div>
                                <div class="count-text">72%</div>
                            </div>
                        </div>
                        <h4><a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">{{$items->pagekeyword}}</a></h4>
                        <div class="category"><a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">{{$items->sector_name}}</a></div>
                        <div class="btn-box"><a href="{{url('/user-donate')}}" class="theme-btn-four thm-btn">Donate Now</a></div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Crowdfunding end -->