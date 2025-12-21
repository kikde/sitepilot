<style>
/* ===================== OBJECTIVE SLIDER (SCOPED) ===================== */

/* Wrapper */
.objective-slider{
  padding: 40px 0 50px;
}

/* Prevent the carousel from causing horizontal scroll */
.objective-slider .three-item-carousel{
  width:100%;
  overflow:hidden;
}
.objective-slider .three-item-carousel .owl-stage-outer{
  overflow:hidden;
}

/* Card base */
.objective-slider .news-block-one .inner-box{
  height:100%;
  display:flex;
  flex-direction:column;
  border-radius:16px;
  background:#ffffff;
  box-shadow:0 10px 26px rgba(15,23,42,.14);
  transition:transform .18s ease, box-shadow .18s ease;
}
.objective-slider .news-block-one .inner-box:hover{
  transform:translateY(-3px);
  box-shadow:0 16px 36px rgba(15,23,42,.18);
}

/* Image + date tag */
.objective-slider .news-block-one .image-box{
  position:relative;
  overflow:visible;            /* so date badge is not cut */
}

.objective-slider .news-block-one .image-box img{
  width:100%;
  height:190px;
  object-fit:cover;
  display:block;
  border-radius:16px 16px 0 0;
}

/* DATE BADGE – custom so it doesn’t rely on theme */
.objective-slider .news-block-one .post-date{
  position:absolute;
  left:16px;
  top:12px;
  background:#ef4444;
  border-radius:999px;
  padding:3px 12px;
  color:#ffffff;
  font-size:.72rem;
  font-weight:700;
  text-transform:uppercase;
  letter-spacing:.12em;
  z-index:2;
}
.objective-slider .news-block-one .post-date h6{
  margin:0;
  color:#ffffff;
  font-size:.72rem;
  font-weight:700;
}

/* Text area */
.objective-slider .news-block-one .lower-content{
  padding:12px 14px 16px;
}

.objective-slider .news-block-one .category a{
  font-size:.78rem;
  text-transform:uppercase;
  letter-spacing:.15em;
  color:#f97316;
  font-weight:700;
}

.objective-slider .news-block-one h4{
  margin:6px 0 0;
  font-size:1rem;
  font-weight:800;
  color:#111827;
}
.objective-slider .news-block-one h4 a{
  color:inherit;
  text-decoration:none;
}
.objective-slider .news-block-one h4 a:hover{
  color:#ef4444;
}

/* ---------- Mobile tweaks ---------- */
@media (max-width: 767px){

  /* Small side padding per slide, no horizontal page scroll */
  .objective-slider .three-item-carousel .owl-item{
    padding:0 6px;
  }

  .objective-slider .news-block-one .image-box img{
    height:180px;
  }

  /* Put nav inside, centered, so it doesn’t extend width */
  .objective-slider .three-item-carousel.nav-style-one .owl-nav{
    position:static;
    margin-top:10px;
    text-align:center;
  }

  .objective-slider .three-item-carousel.nav-style-one .owl-nav .owl-prev,
  .objective-slider .three-item-carousel.nav-style-one .owl-nav .owl-next{
    position:static;
    transform:none;
    margin:0 4px;
  }
}

/* Extra small: slightly shorter image */
@media (max-width: 420px){
  .objective-slider .news-block-one .image-box img{
    height:170px;
  }
}
</style>


<!-- news-section -->
<section class="news-section sec-pad objective-slider">
  <div class="auto-container">
    <div class="sec-title text-left">
      <h6>Our Objective</h6>
      <h2>Latest From Our Blog</h2>
    </div>

    <div class="three-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
      @foreach($secmenu as $items)
        <div class="news-block-one">
          <div class="inner-box">
            <div class="image-box">
              <figure class="image">
                <a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">
                  <img src="{{ asset('/backend/uploads/'.$items->breadcrumb) }}" alt="">
                </a>
              </figure>

              <!-- <div class="post-date">
                <h6>{{ \Carbon\Carbon::parse($items->updated_at)->format('F d, Y') }}</h6>
              </div> -->
            </div>

            <div class="lower-content">
              <div class="category">
                <a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">
                  {{ $items->sector_name }}
                </a>
              </div>

              <h4>
                <a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">
                  {{ $items->pagekeyword }}
                </a>
              </h4>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
<!-- news-section end -->
