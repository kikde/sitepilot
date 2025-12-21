<!-- banner-section -->
<section id="homepage-banner" class="banner-section style-three centred">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
        @if(count($homebanner)>0)
        @foreach($homebanner as $banner)
        <div class="slide-item">
            @if(!empty($banner->images))
            <div class="image-layer" style="background-image:url({{ asset('backend/home/banner/'.$banner->images) }})"></div>
            @else
            <div class="image-layer" style="background-image:url({{ asset('frontend/custom/breadcrump.png') }})"></div>
            @endif

            <div class="auto-container">
                <div class="content-box">
                    <!-- keep empty or your text, doesn't matter -->
                </div>
            </div>

            <!-- ⬇️ 2 compact buttons, OUTSIDE content-box -->
            <div class="btn-box double-btn">
                <!-- <a href="{{ url('/user-registration') }}" class="register-btn">Register</a>
                <a href="{{ url('/user-donate') }}" class="donate-btn">Donate</a> -->
            </div>
        </div>
        @endforeach
        @endif
    </div>
</section>