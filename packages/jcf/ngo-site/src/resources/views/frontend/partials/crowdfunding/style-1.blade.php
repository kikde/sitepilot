{{-- CROWD FUNDING SLIDER (HOMEPAGE) --}}
<style>
/* ===== Scoped Crowdfund Slider ===== */
.cf-home-section{
  --cf-brand:#ff4747;
  --cf-brand2:#ff8a47;
  --cf-ink:#0f172a;
  --cf-muted:#6b7280;
  --cf-card:#ffffff;
  --cf-soft:#f8fafc;
  padding:28px 0 10px;
}

/* header */
.cf-home-header{
  text-align:center;
  margin-bottom:10px;
}
.cf-home-header h3{
  font-size:1.5rem;
  font-weight:800;
  margin:0;
  color:var(--cf-ink);
}
.cf-home-header p{
  font-size:.9rem;
  color:var(--cf-muted);
  margin:4px 0 0;
}

/* slider shell */
.cf-home-slider{
  position:relative;
  max-width:980px;
  margin:16px auto 0;
  padding:0 32px;  /* space for arrows */
}
.cf-home-viewport{
  overflow:hidden;
}
.cf-home-track{
  display:flex;
  transition:transform .6s ease;
}
.cf-home-slide{
  flex:0 0 100%;
  padding:0 4px;
}

/* Arrows: sit above slides, centered vertically */
.cf-home-arrow{
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 20;              /* <– higher than cards/track */
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: #f1f5f9;
  box-shadow: 0 4px 10px rgba(15,23,42,.18);
  display: grid;
  place-items: center;
  font-size: 20px;
  font-weight: 900;
  color: #6b7280;
  cursor: pointer;
}
.cf-home-arrow:hover{
  background:#e0e7ff;
}
.cf-home-arrow.prev{ left:7px; }
.cf-home-arrow.next{ right:7px; }

@media (max-width:767.98px){
  .cf-home-slider{
    padding:0 8px;
  }
  .cf-home-arrow{
    width:30px; height:30px; font-size:16px; top:210px;
  }
}

/* ===== CARD (scoped) ===== */
.cf-home-section .donate-card{
  display:flex;
  flex-direction:column;
  max-width:100%;
  margin:0;
  background:var(--cf-card);
  border-radius:18px;
  overflow:hidden;
  box-shadow:0 14px 34px rgba(0,0,0,.10);
  border:1px solid rgba(0,0,0,.06);
  font-family:system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;
}

@media (min-width:768px){
  .cf-home-section .donate-card{
    flex-direction:row;
    
  }
  .cf-home-section .dn-hero{ width:42%; min-height:300px; }
  .cf-home-section .dn-body{ width:58%; }
}

.cf-home-section .dn-hero{
  position:relative;
  height:210px;
  background-size:cover;
  background-position:center;
  background-repeat:no-repeat;
}
.cf-home-section .dn-hero::after{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(180deg,rgba(0,0,0,.0),rgba(0,0,0,.45));
}
.cf-home-section .dn-tag{
  position:absolute;
  left:12px; top:12px;
  background:#fff;
  color:#0b1220;
  font-weight:800;
  padding:6px 10px;
  border-radius:999px;
  font-size:.8rem;
  box-shadow:0 6px 14px rgba(0,0,0,.12);
}
.cf-home-section .dn-title{
  position:absolute;
  left:14px; right:14px; bottom:12px;
  color: #fff !important;
  font-size:1.05rem;
  font-weight:900;
  line-height:1.25;
  text-shadow:0 2px 10px rgba(0,0,0,.35);
}

.cf-home-section .dn-body{
  padding:14px 16px 16px;
}

/* progress & stats */
.cf-home-section .dn-progress{
  margin-top:6px;
  background:var(--cf-soft);
  height:14px;
  border-radius:999px;
  overflow:hidden;
  border:1px solid rgba(0,0,0,.05);
}
.cf-home-section .dn-progress > span{
  display:block;
  height:100%;
  background:linear-gradient(90deg,var(--cf-brand),var(--cf-brand2));
  border-radius:inherit;
  box-shadow:inset 0 0 8px rgba(255,255,255,.35);
  transition:width .6s ease;
}

.cf-home-section .dn-stats{
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin-top:10px;
  gap:10px;
}
.cf-home-section .dn-raised{
  font-weight:900;
  color:#ff5347;
  font-size:1.05rem;
}
.cf-home-section .dn-goal{
  color:#ff5347;
  font-weight:700;
  font-size:.92rem;
}
.cf-home-section .dn-eta{
  margin-top:6px;
  color:#0b1220;
  font-weight:700;
  font-size:.9rem;
}

/* donors */
.cf-home-section .dn-donors{
  margin-top:10px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  font-size:.86rem;
  color:var(--cf-muted);
}
.cf-home-section .dn-count{
  font-weight:800;
  color:#ff5347;
}

/* CTAs */
.cf-home-section .dn-cta{
  margin-top:12px;
  display:flex;
  gap:10px;
}
.cf-home-section .dn-btn{
  flex:1;
  text-align:center;
  padding:13px 65px;
  border-radius:12px;
  text-decoration:none;
  font-weight:900;
  color:#fff !important;
  background:linear-gradient(90deg,var(--cf-brand),var(--cf-brand2));
  box-shadow:0 10px 22px rgba(255,71,71,.30);
  transition:transform .2s, box-shadow .2s;
  font-size:.9rem;
}
.cf-home-section .dn-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 28px rgba(255,71,71,.38);
}
.cf-home-section .dn-secondary{
  padding:11px 14px;
  border-radius:12px;
  font-weight:800;
  text-decoration:none;
  color:#0f172a;
  background:#fff;
  border:1px solid rgba(0,0,0,.08);
  box-shadow:0 6px 16px rgba(0,0,0,.06);
  font-size:.86rem;
}

/* trust */
.cf-home-section .dn-trust{
  margin-top:10px;
  display:flex;
  gap:8px;
  align-items:center;
  flex-wrap:wrap;
  color:var(--cf-muted);
  font-size:.8rem;
  font-weight:700;
}
.cf-home-section .dn-chip{
  display:inline-flex;
  align-items:center;
  gap:6px;
  padding:6px 10px;
  border-radius:999px;
  background:#f1f5f9;
  color:#0b1220;
  border:1px solid rgba(0,0,0,.06);
  font-weight:800;
  font-size:.78rem;
}

@media (max-width:767.98px){
    .cf-home-section .dn-body{
    padding:12px 12px 14px;
  }

  /* keep them in one row, both expand nicely */
  .cf-home-section .dn-cta{
    flex-direction:row;
  }
  
}
</style>

<section class="cf-home-section">
  <div class="auto-container">
    <header class="cf-home-header">
      <h3>Crowd Funding Campaigns</h3>
      <p>Support an ongoing initiative of {{$setting->title}}.</p>
    </header>
     @if($crowdfund->count())
        <div class="cf-home-slider" id="cf-home-slider">
          <button class="cf-home-arrow prev" type="button" aria-label="Previous">‹</button>

          <div class="cf-home-viewport">
            <div class="cf-home-track">
              @foreach($crowdfund as $funds)
                @php
                    // Get stats for this campaign (if any)
                    $stats        = $crowdfundStats[$funds->slug] ?? null;
                    $totalPaise   = $stats->total_paise ?? 0;
                    $donorCount   = $stats->donor_count ?? 0;   // ✅ only paid donors
                    $raisedRupees = round($totalPaise / 100);

                    $target  = $funds->raised_fund ?? 0;
                    $percent = $target > 0
                        ? min(100, round(($raisedRupees / $target) * 100))
                        : 0;
                @endphp

                <article class="cf-home-slide">
                  <div class="donate-card" role="region"
                      aria-label="Crowdfunding: {{ $funds->pagetitle }}">
                    <div class="dn-hero"
                        style="background-image:url('{{ $funds->breadcrumb
                            ? asset('backend/uploads/'.$funds->breadcrumb)
                            : asset('frontend/custom/breadcrumb.png') }}');">
                      @if($funds->pagekeyword)
                        <span class="dn-tag">{{ $funds->pagekeyword }}</span>
                      @endif
                      <div class="dn-title">{{ $funds->pagetitle }}</div>
                    </div>

                    <div class="dn-body">
                      <div class="dn-stats">
                        <div class="dn-raised">
                          ₹{{ number_format($raisedRupees) }}
                          <span style="color:#6b7280;font-weight:700;font-size:.9rem;">raised</span>
                        </div>

                        @if($target)
                          <div class="dn-goal">
                            Goal: ₹{{ number_format($target) }}
                          </div>
                        @endif
                      </div>

                      @if($target)
                        <div class="dn-progress" aria-label="Funding progress">
                          <span style="width: {{ $percent }}%;"
                                role="progressbar"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                aria-valuenow="{{ $percent }}"></span>
                        </div>
                      @endif

                      <div class="dn-donors">
                        <div class="dn-count">{{ $donorCount }} donors</div>
                        <div>{{ $percent }}% funded</div>
                      </div>

                      <div class="dn-cta">
                        <a href="{{ url('/user-donate?campaign='.$funds->slug) }}"
                          class="dn-btn">
                          Donate Now
                        </a>

                        <a href="https://wa.me/{{ $setting->phone }}?text={{ urlencode('I want to support this campaign: '.$funds->pagetitle.' '.url('/crowdfunding/'.$funds->id.'/'.$funds->slug)) }}"
                          target="_blank"
                          rel="noopener"
                          class="dn-secondary">
                          <i class="fa fa-share"></i>Share
                        </a>
                      </div>

                      <div class="dn-trust">
                        <span class="dn-chip">🔒 100% Secure</span>
                        <span class="dn-chip">📜 80G Eligible</span>
                        <span class="dn-chip">✅ Verified Campaign</span>
                      </div>
                    </div>
                  </div>
                </article>
              @endforeach
            </div>
          </div>

          <button class="cf-home-arrow next" type="button" aria-label="Next">›</button>
        </div>
     @endif
    

  
  </div>
   <div class="dn-cta">
        <a href="{{ url('/crowdfunding') }}" class="dn-btn">View All Crowd Funding</a>
      
      </div>
</section>

<script>
(function(){
  const slider = document.getElementById('cf-home-slider');
  if (!slider) return;

  const track = slider.querySelector('.cf-home-track');
  const slides = Array.from(track.children);
  const prev = slider.querySelector('.cf-home-arrow.prev');
  const next = slider.querySelector('.cf-home-arrow.next');

  const total = slides.length;
  if (!total) return;

  let index = 0;

  function goTo(i){
    index = (i + total) % total;
    track.style.transform = 'translateX(-' + (index * 100) + '%)';
  }

  prev.addEventListener('click', function(){ goTo(index - 1); });
  next.addEventListener('click', function(){ goTo(index + 1); });

  let timer = setInterval(function(){ goTo(index + 1); }, 6000);

  slider.addEventListener('mouseenter', function(){ clearInterval(timer); });
  slider.addEventListener('mouseleave', function(){
    timer = setInterval(function(){ goTo(index + 1); }, 6000);
  });

  goTo(0);
})();
</script>
