{{-- Stylish Awards / Recognitions --}}
<style>
  :root{
    --aw-grad-start:#ec058e;
    --aw-grad-end:#6ab4cf;
    --aw-card:#ffffff;
    --aw-ink:#0b1020;
    --aw-muted:#e5e7eb;
  }

  .awards-modern{
    position:relative;
    padding:60px 0 80px;
    background:linear-gradient(135deg,var(--aw-grad-start),var(--aw-grad-end));
    color:#fff;
    overflow:hidden;
  }

  /* optional background image overlay */
  .awards-modern::before{
    content:"";
    position:absolute;
    inset:0;
    background:
      radial-gradient(circle at 10% 0%,rgba(255,255,255,.15) 0,transparent 55%),
      radial-gradient(circle at 90% 100%,rgba(0,0,0,.25) 0,transparent 60%);
    mix-blend-mode:soft-light;
    opacity:.85;
    pointer-events:none;
  }

  .awards-modern .auto-container{
    position:relative;
    z-index:1;
  }

  .awards-head{
    text-align:center;
    margin-bottom:28px;
  }
  .awards-kicker{
    font-size:.8rem;
    letter-spacing:.18em;
    text-transform:uppercase;
    font-weight:700;
    opacity:.85;
  }
  .awards-title{
    margin:6px auto 0;
    max-width:540px;
  }
  .awards-title h2{
    font-size:2rem;
    font-weight:800;
    line-height:1.25;
    margin:0;
    color: #ffffff !important;
  }

  /* slider shell */
  .awards-slider-wrap{
    max-width:960px;
    margin:0 auto;
  }

  .awards-carousel .owl-stage-outer{
    overflow:hidden;                /* stops horizontal scroll on mobile */
  }
  .awards-carousel .owl-item{
    padding:6px 10px;
  }

  /* single card */
  .awards-card{
    background:var(--aw-card);
    border-radius:22px;
    padding:16px 16px 18px;
    box-shadow:0 18px 40px rgba(15,23,42,.25);
    display:flex;
    gap:14px;
    align-items:center;
  }

  .aw-img-wrap{
    flex:0 0 120px;
    max-width:120px;
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 10px 22px rgba(15,23,42,.25);
  }
  .aw-img-wrap img{
    width:100%;
    height:120px;
    object-fit:cover;
    display:block;
  }

  .aw-body{
    flex:1;
    color:var(--aw-ink);
  }

  .aw-pill{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:4px 10px;
    border-radius:999px;
    background:#020617;
    color:#f9fafb;
    font-size:.72rem;
    letter-spacing:.14em;
    text-transform:uppercase;
    font-weight:700;
    margin-bottom:6px;
  }
  .aw-pill i{
    font-size:.9rem;
  }

  .aw-body h4{
    margin:0 0 4px;
    font-size:1.05rem;
    font-weight:800;
  }
  .aw-body p{
    margin:0;
    font-size:.87rem;
    color:#4b5563;
  }

  /* nav arrows */
  .awards-modern .owl-nav{
    margin-top:18px;
    text-align:center;
  }
  .awards-modern .owl-nav button{
    width:34px;
    height:34px;
    border-radius:999px !important;
    background:#f4f4f5 !important;
    color:#4b5563 !important;
    border:none;
    margin:0 5px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:18px !important;
    box-shadow:0 6px 16px rgba(15,23,42,.25);
  }
  .awards-modern .owl-nav button span{
    line-height:1;
  }
  .awards-modern .owl-nav button:hover{
    background:#ffffff !important;
    color:#111827 !important;
  }

  /* dots (if you ever enable) */
  .awards-modern .owl-dots{
    margin-top:10px;
  }
  .awards-modern .owl-dots .owl-dot span{
    background:rgba(249,250,251,.5);
  }
  .awards-modern .owl-dots .owl-dot.active span{
    background:#ffffff;
  }

  @media(max-width:767px){
    .awards-card{
      flex-direction:column;
      text-align:center;
    }
    .aw-img-wrap{
      flex:0 0 auto;
      max-width:180px;
      margin:0 auto 4px;
    }
    .aw-img-wrap img{
      height:140px;
    }
    .awards-title h2{
      font-size:1.6rem;
    }
  }
</style>

<section class="awards-modern">
  <div class="auto-container">
    <header class="awards-head">
      @if(!empty($statics?->heading))
        <div class="awards-kicker">{{ $statics->heading }}</div>
      @else
        <div class="awards-kicker">Accreditations &amp; Awards</div>
      @endif

      <div class="awards-title">
        <h2>{!! $statics->subheading ?? "We're Proud to Share Our Achievements" !!}</h2>
      </div>
    </header>

    @if($award->count())
      <div class="awards-slider-wrap">
        <div class="awards-carousel owl-carousel owl-theme">
          @foreach($award as $list)
            <div class="awards-card">
              <div class="aw-img-wrap">
                <img src="{{ asset('backend/home/award/'.$list->images) }}"
                     alt="{{ $list->title ?? 'Award' }}">
              </div>

              <div class="aw-body">
                <div class="aw-pill">
                  <i class="fas fa-award"></i>
                  <span>Award &amp; Recognition</span>
                </div>
                <h4>{{ $list->title }}</h4>
                @if($list->description)
                  <p>{{ $list->description }}</p>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @else
      <p class="text-center mt-2" style="position:relative;z-index:1;color:#fee2e2;">
        No awards added yet.
      </p>
    @endif
  </div>
</section>

<script>
  (function($){
    "use strict";
    $(document).ready(function () {
      $('.awards-carousel').owlCarousel({
        loop:true,
        margin:20,
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        smartSpeed:600,
        navText:['<span class="fas fa-angle-left"></span>','<span class="fas fa-angle-right"></span>'],
        responsive:{
          0:{ items:1 },
          768:{ items:2 }
        }
      });
    });
  })(jQuery);
</script>
