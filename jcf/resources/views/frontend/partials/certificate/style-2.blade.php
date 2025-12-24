<style>
/* ===== Certificates Slider (VSF) ===== */

.vsf-cert-section{
  padding:20px 0 40px;
}

.vsf-cert-section .auto-container1{
  max-width:1140px;
  margin:0 auto;
}

.vsf-cert-section .vsf-cert-header{
  text-align:center;
  margin-bottom:30px;
}
.vsf-cert-section .vsf-cert-header h6{
  font-size:14px;
  letter-spacing:.18em;
  text-transform:uppercase;
  color:#ff5a1f;
  margin-bottom:6px;
}
.vsf-cert-section .vsf-cert-header h2{
  font-size:30px;
  font-weight:800;
  color:#1f2933;
  margin-bottom:8px;
}
.vsf-cert-section .vsf-cert-header p{
  color:#6b7280;
  font-size:14px;
}

.vsf-cert-section .vsf-cert-wrapper{
  position:relative;
}

.vsf-cert-section .vsf-cert-card{
  padding:10px;
}

.vsf-cert-section .vsf-cert-inner{
  background:linear-gradient(135deg,#ffffff,#fdf5f0);
  border-radius:24px;
  box-shadow:0 18px 40px rgba(15,23,42,.13);
  border:1px solid rgba(255,255,255,.9);
  overflow:hidden;
  padding:18px 18px 14px;
  position:relative;
}

.vsf-cert-section .vsf-cert-ribbon{
  position:absolute;
  top:8px;
  left:8px;
  padding:3px 10px;
  border-radius:999px;
  font-size:10px;
  text-transform:uppercase;
  background:#fd7e14;
  color:#fff;
  letter-spacing:.08em;
  z-index:2;
}

.vsf-cert-section .vsf-cert-image-box{
  position:relative;
  background:#ffffff;
  border-radius:18px;
  border:1px solid #e5e7eb;
  padding:10px;
  height:230px;
  display:flex;
  align-items:center;
  justify-content:center;
  overflow:hidden;
}

.vsf-cert-section .vsf-cert-image-box img{
  max-width:100%;
  max-height:100%;
  object-fit:contain;
}

.vsf-cert-section .vsf-cert-meta{
  text-align:center;
  margin-top:12px;
}
.vsf-cert-section .vsf-cert-title{
  font-size:16px;
  font-weight:700;
  color:#111827;
  margin-bottom:4px;
}
.vsf-cert-section .vsf-cert-sub{
  font-size:12px;
  color:#6b7280;
}

/* “View all” button */
.vsf-cert-section .vsf-cert-dots-row{
  display:flex;
  justify-content:center;
  gap:6px;
  margin-top:16px;
}
.vsf-cert-section .vsf-cert-dot{
  display:inline-block;
  padding:9px 22px;
  border-radius:8px;
  font-weight:700;
  color:#fff;
  text-decoration:none;
  background:linear-gradient(135deg,#00a5e2,#ec058e);
  box-shadow:0 4px 12px rgba(0,0,0,.2);
  transition:transform .15s, box-shadow .15s;
}
.vsf-cert-section .vsf-cert-dot:hover{
  transform:translateY(-1px);
  box-shadow:0 6px 16px rgba(0,0,0,.25);
}
.vsf-cert-section .vsf-certificate-carousel .owl-nav{
  display:none !important;
}

/* MOBILE */
@media (max-width:575.98px){
  .vsf-cert-section .vsf-cert-header h2{
    font-size:24px;
  }
  .vsf-cert-section .vsf-cert-inner{
    padding:16px 14px 12px;
  }
  .vsf-cert-section .vsf-cert-image-box{
    height:200px;
  }
}
</style>
<section class="vsf-cert-section">
  <div class="auto-container1">

    <div class="vsf-cert-header">
      <h6>Official Documents</h6>
      <h2>Recognitions &amp; Registrations</h2>
      <p>Our trust registrations, approvals and certificates in one place.</p>
    </div>

    @if($certificates->count())
      <div class="vsf-cert-wrapper">
        <div class="vsf-certificate-carousel owl-carousel">
          @foreach($certificates as $certificate)
            <div class="vsf-cert-card">
              <div class="vsf-cert-inner">
                <figure class="vsf-cert-image-box">
                  <span class="vsf-cert-ribbon">Certificate</span>
                  @if($certificate->images)
                    <img src="{{ asset('backend/gallery/photo/'.$certificate->images) }}"
                         alt="{{ $certificate->title }}">
                  @else
                    <img src="{{ asset('frontend/custom/breadcrumb.png') }}"
                         alt="Certificate">
                  @endif
                </figure>

                <div class="vsf-cert-meta">
                  <div class="vsf-cert-title">{{ $certificate->title }}</div>
                  <div class="vsf-cert-sub">Reg. No: {{ $certificate->description }}</div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="vsf-cert-dots-row">
          <a href="{{ route('front.photo', ['share_site' => 'certificate']) }}"
             class="vsf-cert-dot">
            View All Certificate
          </a>
        </div>
      </div>
    @else
      <p>No certificates found.</p>
    @endif
  </div>
</section>
<script>
  $(function () {
    var $certSlider = $('.vsf-certificate-carousel');
    if (!$certSlider.length) return;

    $certSlider.owlCarousel({
      loop: true,
      margin: 20,
      nav: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 3500,
      smartSpeed: 700,
      responsive: {
        0:   { items: 1 },
        576: { items: 1 },
        768: { items: 2 },
        992: { items: 3 }
      }
    });
  });
</script>
