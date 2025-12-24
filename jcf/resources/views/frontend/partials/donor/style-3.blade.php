





<section class="team-section sec-pad">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h6>Our Helping Hero's</h6>
            <h2>Donors</h2>
        </div>

        @if(count($donors) > 0)
            <div class="four-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">

                @foreach($donors as $list)
                    <div class="team-block-one">
                        <div class="inner-box">
                            <div class="pattern" style="background-image: url({{ asset('frontend/assets/images/shape/shape-5.png') }});"></div>

                            {{-- social icons (optional, you can remove) --}}
                            <div class="social-links">
                                <span>+</span>
                                <ul class="social-list clearfix">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>

                            <figure class="image-box">
                                @if($list->profile)
                                    <img src="{{ asset('backend/uploads/'.$list->profile) }}"
                                         alt="{{ $list->name ?? 'Donor' }}">
                                @else
                                    {{-- fallback image --}}
                                    <img src="{{ asset('frontend/custom/user.png') }}"
                                         alt="Donor">
                                @endif
                                {{-- link icon (optional) --}}
                                {{-- <a href="#"><i class="fas fa-link"></i></a> --}}
                            </figure>

                            <div class="lower-content">
                                <h4>
                                    {{-- change "name" to your actual field if different --}}
                                    <a href="#">{{ $list->name ?? 'Anonymous Donor' }}</a>
                                </h4>

                                {{-- designation / location / amount etc. --}}
                                @if(!empty($list->city))
                                    <span class="designation">{{ $list->city }}</span>
                                @else
                                    <span class="designation">Generous Donor</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <p class="text-center">No donors found yet.</p>
        @endif
    </div>

    <div class="btn-box text-center">
        <a href="{{url('/our-donors')}}" class="theme-btn-four thm-btn">View All Donor</a>
    </div>

</section>

<script>
$(document).ready(function(){
    $('.four-item-carousel').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        dots:true,
        autoplay:true,
        autoplayTimeout:3000,
        smartSpeed:700,
        navText: [
            '<span class="fas fa-angle-left"></span>',
            '<span class="fas fa-angle-right"></span>'
        ],
        responsive:{
            0:{ items:1 },
            576:{ items:1 },
            768:{ items:2 },
            992:{ items:3 },
            1200:{ items:4 }
        }
    });
});
</script>
