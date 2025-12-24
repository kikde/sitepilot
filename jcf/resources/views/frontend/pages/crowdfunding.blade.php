@extends('layouts.master')

@section('content')

<style>
/* ========= CROWD FUNDING DETAIL (scoped) ========= */

.cf-detail-page{
  background:#f9fafb;
  padding:40px 0 60px;
  font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Noto Sans",Arial,sans-serif;
}
.cf-detail-page .cfd-wrapper{
  max-width:1140px;
  margin:0 auto;
}

/* main card */
.cfd-main-card{
  background:#ffffff;
  border-radius:20px;
  box-shadow:0 18px 40px rgba(15,23,42,.12);
  padding:22px 20px 28px;
}
@media (min-width:992px){
  .cfd-main-card{ padding:26px 28px 34px; }
}

/* hero */
.cfd-hero{
  position:relative;
  border-radius:18px;
  overflow:hidden;
  margin-bottom:18px;
  background:#0b1120;
}
.cfd-hero-img img{
  width:100%; max-height:420px;
  object-fit:cover; display:block;
}

/* label + goal tag */
.cfd-chip{
  position:absolute;
  top:14px; left:14px;
  padding:4px 12px;
  border-radius:999px;
  font-size:.76rem; font-weight:700;
  letter-spacing:.14em; text-transform:uppercase;
  background:#ffffff;
  color:#ef4444;
  box-shadow:0 8px 20px rgba(0,0,0,.35);
}

.cfd-meta-strip{
  position:absolute;
  left:14px; right:14px; bottom:14px;
  border-radius:16px;
  padding:8px 12px;
  background:linear-gradient(90deg,rgba(220,38,38,.96),rgba(249,115,22,.96));
  color:#fff;
  display:flex;
  flex-wrap:wrap;
  align-items:center;
  gap:8px;
  font-size:.8rem;
}
.cfd-meta-item{
  display:flex; align-items:center; gap:6px;
}
.cfd-meta-item i{ font-size:.9rem; }

/* title / subtitle */
.cfd-header{ margin-bottom:14px; }
.cfd-title{
  font-size:1.8rem;
  font-weight:800;
  color:#111827;
  margin-bottom:4px;
}
@media (min-width:992px){
  .cfd-title{ font-size:2.1rem; }
}
.cfd-subtitle{
  margin:0;
  color:#6b7280;
  font-size:.95rem;
}

/* funding numbers row */
.cfd-stats-row{
  display:flex;
  flex-wrap:wrap;
  gap:10px;
  margin:12px 0 10px;
}
.cfd-stat{
  flex:1 1 150px;
  min-width:0;
  background:#fef2f2;
  border-radius:14px;
  padding:9px 12px;
  border:1px solid #fee2e2;
}
.cfd-stat-label{
  font-size:.78rem;
  text-transform:uppercase;
  letter-spacing:.08em;
  color:#b91c1c;
  font-weight:600;
}
.cfd-stat-value{
  font-size:1.02rem;
  font-weight:800;
  color:#111827;
}
.cfd-stat-sub{
  font-size:.8rem;
  color:#6b7280;
}

/* progress bar */
.cfd-progress-wrap{
  margin:6px 0 14px;
}
.cfd-progress{
  width:100%; height:9px;
  border-radius:999px;
  overflow:hidden;
  background:#f3f4f6;
}
.cfd-progress-bar{
  height:100%;
  background:linear-gradient(90deg,#22c55e,#16a34a);
}

.cfd-progress-meta{
  display:flex;
  justify-content:space-between;
  font-size:.78rem;
  color:#6b7280;
  margin-top:4px;
}

/* --- Share strip (CF details) --- */

.cfd-share-strip{
  display:inline-flex;
  flex-direction:column;
  align-items:flex-start;
  gap:6px;
  padding:10px 12px 12px;
  border-radius:16px;
  background:#f3f4ff;
  border:1px solid #e0e7ff;
  max-width:100%;
}

.cfd-share-strip .label{
  font-size:.86rem;
  font-weight:600;
  color:#1f2937;
}

/* row of icon buttons */
.cfd-share-icons{
  display:flex;
  align-items:center;
  gap:8px;
}

/* square icon-only buttons */
.cfd-share-btn{
  width:36px;
  height:36px;
  border-radius:12px;
  border:none;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
  text-decoration:none;
  transition:.18s;
  box-shadow:0 4px 10px rgba(15,23,42,.12);
}

.cfd-share-btn i{
  font-size:1rem;
  color:#ffffff;
}

/* colors */
.cfd-share-btn.fb { background:#1877f2; }
.cfd-share-btn.x  { background:#0f172a; }
.cfd-share-btn.wa { background:#16a34a; }
.cfd-share-btn.copy {
  background:#ffffff;
  box-shadow:0 4px 10px rgba(15,23,42,.1);
}
.cfd-share-btn.copy i{
  color:#111827;
}

/* hover */
.cfd-share-btn:hover{
  transform:translateY(-1px);
  box-shadow:0 6px 14px rgba(15,23,42,.18);
}

/* content */
.cfd-content{
  margin-top:4px;
  color:#111827;
  font-size:.98rem;
  line-height:1.75;
}
.cfd-content p{ margin-bottom:1rem; }
.cfd-content h2,
.cfd-content h3{
  margin-top:1.2rem;
  margin-bottom:.4rem;
  font-weight:700;
}

/* CTA row */
.cfd-cta-row{
  margin-top:18px;
  display:flex;
  flex-wrap:wrap;
  gap:10px;
}
.cfd-cta-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  padding:9px 16px;
  border-radius:999px;
  border:none;
  text-decoration:none;
  font-size:.9rem;
  font-weight:600;
  cursor:pointer;
  transition:.18s;
}
.cfd-cta-primary{
  background:linear-gradient(135deg,#ff4d4d,#ff934d);
  color:#fff;
  box-shadow:0 8px 20px rgba(239,68,68,.3);
}
.cfd-cta-secondary{
  background:#ffffff;
  color:#111827;
  border:1px solid #e5e7eb;
}
.cfd-cta-btn i{ font-size:.95rem; }
.cfd-cta-btn:hover{
  transform:translateY(-1px);
  box-shadow:0 8px 18px rgba(15,23,42,.12);
}

/* tags */
.cfd-tags{
  margin-top:18px;
  display:flex;
  flex-wrap:wrap;
  gap:8px;
}
.cfd-tag{
  padding:4px 10px;
  border-radius:999px;
  background:#fefce8;
  color:#92400e;
  font-size:.78rem;
  border:1px solid #facc15;
}

/* sidebar */
.cfd-sidebar{
  background:#0b1120;
  color:#e5e7eb;
  border-radius:20px;
  padding:18px 16px 20px;
  box-shadow:0 18px 34px rgba(15,23,42,.22);
}
.cfd-sidebar-title{
  font-size:1.05rem;
  font-weight:700;
  margin-bottom:4px;
  color:#f9fafb;
}
.cfd-sidebar-sub{
  font-size:.8rem;
  color:#9ca3af;
  margin-bottom:12px;
}

/* quick facts box */
.cfd-info-box{
  background:rgba(15,23,42,.9);
  border-radius:14px;
  padding:10px 11px 12px;
  border:1px solid rgba(148,163,184,.7);
  margin-bottom:12px;
}
.cfd-info-heading{
  font-size:.83rem;
  font-weight:700;
  text-transform:uppercase;
  letter-spacing:.08em;
  margin-bottom:6px;
}
.cfd-info-line{
  font-size:.84rem;
  margin-bottom:3px;
}
.cfd-info-line i{ margin-right:6px; }

/* related campaigns list */
.cfd-related-list{
  list-style:none;
  padding:0; margin:6px 0 0;
  display:flex;
  flex-direction:column;
  gap:8px;
}
.cfd-related-item a{
  color:#e5e7eb;
  font-size:.84rem;
  text-decoration:none;
}
.cfd-related-item a:hover{ color:#f97316; }
.cfd-related-amt{
  font-size:.75rem;
  color:#9ca3af;
}

/* mobile */
@media (max-width:991.98px){
  .cf-detail-page{ padding:26px 0 40px; }
  .cfd-sidebar{ margin-top:16px; }
}
@media (max-width: 575.98px){
  .cfd-share-strip{
    width:100%;
    padding:8px 10px 10px;
    border-radius:16px;
  }
}

</style>

@php
  /** @var \App\Models\Page $fund */
  $campaignUrl = url('/crowdfunding/'.$fund->id.'/'.$fund->slug);
  $createdDate = optional($fund->created_at)->format('F d, Y');
@endphp

<section class="cf-detail-page">
  <div class="cfd-wrapper auto-container">
    <div class="row clearfix">

      {{-- MAIN --}}
      <div class="col-lg-8 col-md-12 col-sm-12">
        <article class="cfd-main-card">

          {{-- HERO --}}
          <div class="cfd-hero">
            <div class="cfd-hero-img">
              @if($fund->breadcrumb)
                <img src="{{ asset('backend/uploads/'.$fund->breadcrumb) }}"
                     alt="{{ $fund->pagetitle }}">
              @else
                <img src="{{ asset('frontend/custom/breadcrumb.png') }}"
                     alt="{{ $fund->pagetitle }}">
              @endif
            </div>

            <span class="cfd-chip">Crowd Funding</span>

            <div class="cfd-meta-strip">
              @if($createdDate)
                <span class="cfd-meta-item">
                  <i class="far fa-calendar-alt"></i>{{ $createdDate }}
                </span>
              @endif

              @if($fund->pagekeyword)
                <span class="cfd-meta-item">
                  <i class="fas fa-tag"></i>{{ $fund->pagekeyword }}
                </span>
              @endif
            </div>
          </div>

          {{-- HEADER --}}
          <header class="cfd-header">
            <h1 class="cfd-title">{{ $fund->pagetitle }}</h1>
            @if($fund->meta_title)
              <p class="cfd-subtitle">{{ $fund->meta_title }}</p>
            @endif
          </header>

          {{-- FUNDING STATS --}}
          <div class="cfd-stats-row">
            <div class="cfd-stat">
              <div class="cfd-stat-label">Raised</div>
              <div class="cfd-stat-value">
                ₹{{ number_format($raisedRupees) }}
              </div>
              @if($target)
                <div class="cfd-stat-sub">{{ $percent }}% of goal</div>
              @endif
            </div>

            @if($target)
              <div class="cfd-stat">
                <div class="cfd-stat-label">Goal</div>
                <div class="cfd-stat-value">
                  ₹{{ number_format($target) }}
                </div>
                <div class="cfd-stat-sub">
                  Remaining: ₹{{ number_format(max(0, $target - $raisedRupees)) }}
                </div>
              </div>
            @endif

            <div class="cfd-stat">
              <div class="cfd-stat-label">Supporters</div>
              <div class="cfd-stat-value">
                {{ $donorsCount }}+
              </div>
              <div class="cfd-stat-sub">
                kind hearts
              </div>
            </div>
          </div>

          {{-- PROGRESS BAR --}}
          @if($target)
            <div class="cfd-progress-wrap">
              <div class="cfd-progress">
                <div class="cfd-progress-bar" style="width: {{ $percent }}%;"></div>
              </div>
              <div class="cfd-progress-meta">
                <span>{{ $percent }}% funded</span>
                <span>Goal: ₹{{ number_format($target) }}</span>
              </div>
            </div>
          @endif

          {{-- SHARE --}}
        <div class="cfd-share-strip">
          <span class="label">Share this campaign:</span>

            <div class="cfd-share-icons">
                <a class="cfd-share-btn fb"
                target="_blank"
                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($campaignUrl) }}">
                <i class="fab fa-facebook-f"></i>
                </a>

                <a class="cfd-share-btn x"
                target="_blank"
                href="https://twitter.com/intent/tweet?url={{ urlencode($campaignUrl) }}&text={{ urlencode($fund->pagetitle) }}">
                <i class="fab fa-twitter"></i>
                </a>

                <a class="cfd-share-btn wa"
                target="_blank"
                href="https://wa.me/?text={{ urlencode($fund->pagetitle.' '.$campaignUrl) }}">
                <i class="fab fa-whatsapp"></i>
                </a>

                <button class="cfd-share-btn copy" type="button"
                        onclick="navigator.clipboard.writeText('{{ $campaignUrl }}')">
                <i class="fas fa-link"></i>
                </button>
            </div>
        </div>



          {{-- DESCRIPTION / CONTENT --}}
          <div class="cfd-content">
            {!! $fund->description !!}
          </div>

          {{-- CTA ROW --}}
          <div class="cfd-cta-row">
            <a href="{{ url('/user-donate?campaign='.$fund->slug) }}"
               class="cfd-cta-btn cfd-cta-primary">
              <i class="fas fa-hand-holding-heart"></i> Donate Now
            </a>

            <a href="{{ url('/crowdfunding') }}"
               class="cfd-cta-btn cfd-cta-secondary">
              <i class="fas fa-arrow-left"></i> Back to campaigns
            </a>
          </div>

          {{-- TAGS --}}
          <div class="cfd-tags">
            @if($fund->pagekeyword)
              <span class="cfd-tag">#{{ $fund->pagekeyword }}</span>
            @endif
            <span class="cfd-tag">#VihatmaaSewaFoundation</span>
            <span class="cfd-tag">#Crowdfunding</span>
          </div>

        </article>
      </div>

      {{-- SIDEBAR --}}
      <div class="col-lg-4 col-md-12 col-sm-12">
        <aside class="cfd-sidebar">
          <h3 class="cfd-sidebar-title">Why your support matters</h3>
          <p class="cfd-sidebar-sub">
            Every contribution helps us reach more beneficiaries through
            Vihatmaa Sewa Foundation’s initiatives.
          </p>

          <div class="cfd-info-box">
            <div class="cfd-info-heading">Campaign Snapshot</div>
            <div class="cfd-info-line">
              <i class="fas fa-heart"></i>
              Raised: ₹{{ number_format($raisedRupees) }}
            </div>
            @if($target)
              <div class="cfd-info-line">
                <i class="fas fa-bullseye"></i>
                Goal: ₹{{ number_format($target) }}
              </div>
              <div class="cfd-info-line">
                <i class="fas fa-chart-line"></i>
                {{ $percent }}% funded
              </div>
            @endif
            <div class="cfd-info-line">
              <i class="fas fa-users"></i>
              Supporters: {{ $donorsCount }}+
            </div>
          </div>

          @if(isset($relatedFunds) && $relatedFunds->count())
            <div class="cfd-info-box">
              <div class="cfd-info-heading">More Campaigns</div>
              <ul class="cfd-related-list">
                @foreach($relatedFunds as $other)
                  @php
                    $otherRaisedPaise  = $other->slug
                      ?  \Modules\Page\Entities\Donation::where('campaign', $other->slug)->where('status','paid')->sum('amount_paise')
                      : 0;
                    $otherRaisedRs     = round($otherRaisedPaise / 100);
                  @endphp
                  <li class="cfd-related-item">
                    <a href="{{ url('/crowdfunding/'.$other->id.'/'.$other->slug) }}">
                      {{ \Illuminate\Support\Str::limit($other->pagetitle, 60) }}
                    </a>
                    <div class="cfd-related-amt">
                      Raised: ₹{{ number_format($otherRaisedRs) }}
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </aside>
      </div>

    </div>
  </div>
</section>

@endsection
