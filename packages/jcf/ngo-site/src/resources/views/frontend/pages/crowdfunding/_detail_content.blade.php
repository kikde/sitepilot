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
  border-radius:16px;
  overflow:hidden;
  background:#0b1220;
  margin-bottom:18px;
}
.cfd-hero img{
  width:100%;
  height:auto;
  display:block;
}

/* layout */
.cf-detail-page .cfd-grid{
  display:grid;
  grid-template-columns:1fr;
  gap:18px;
}
@media (min-width:992px){
  .cf-detail-page .cfd-grid{ grid-template-columns:1fr 360px; }
}

.cf-detail-page .cfd-breadcrumb{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
  align-items:center;
  font-size:14px;
  color:#64748b;
  margin-bottom:14px;
}
.cf-detail-page .cfd-breadcrumb a{
  color:#2563eb;
  text-decoration:none;
  font-weight:700;
}

.cf-detail-page .cfd-title{
  font-size:30px;
  line-height:1.2;
  font-weight:900;
  color:#0f172a;
  margin:8px 0 12px;
}

.cf-detail-page .cfd-meta{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
  align-items:center;
  font-size:14px;
  color:#64748b;
  margin-bottom:18px;
}
.cf-detail-page .cfd-meta .pill{
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:6px 10px;
  border-radius:999px;
  background:#f1f5f9;
  color:#0f172a;
  font-weight:800;
  font-size:12px;
}

.cf-detail-page .cfd-progress{
  margin:14px 0 8px;
}
.cf-detail-page .cfd-progress .bar{
  height:10px;
  border-radius:999px;
  background:#e2e8f0;
  overflow:hidden;
}
.cf-detail-page .cfd-progress .bar > span{
  display:block;
  height:100%;
  border-radius:999px;
  background:linear-gradient(90deg,#22c55e,#16a34a);
  width:0%;
}
.cf-detail-page .cfd-progress .labels{
  margin-top:10px;
  display:flex;
  justify-content:space-between;
  font-size:13px;
  color:#334155;
  font-weight:800;
}

.cf-detail-page .cfd-content{
  font-size:16px;
  line-height:1.8;
  color:#334155;
}
.cf-detail-page .cfd-content p{ margin:0 0 14px; }
.cf-detail-page .cfd-content a{ color:#2563eb; font-weight:700; }

.cf-detail-page .cfd-sidebar{
  background:#ffffff;
  border-radius:18px;
  box-shadow:0 18px 40px rgba(15,23,42,.08);
  padding:18px 18px 20px;
  position:sticky;
  top:18px;
  height:fit-content;
}
.cf-detail-page .cfd-sidebar h4{
  margin:0 0 12px;
  font-size:16px;
  font-weight:900;
  color:#0f172a;
}
.cf-detail-page .cfd-related{
  list-style:none;
  padding:0;
  margin:0;
  display:flex;
  flex-direction:column;
  gap:12px;
}
.cf-detail-page .cfd-related-item{
  padding:12px 12px;
  border-radius:14px;
  background:#f8fafc;
}
.cf-detail-page .cfd-related-item a{
  color:#0f172a;
  text-decoration:none;
  font-weight:900;
  line-height:1.35;
  display:block;
}
.cf-detail-page .cfd-related-item a:hover{ color:#2563eb; }
.cf-detail-page .cfd-related-amt{
  margin-top:6px;
  font-size:12px;
  color:#64748b;
  font-weight:800;
}
</style>

@php
  $goalAmount = (float)($pagedetails->amount ?? 0);
  $raisedAmount = (float)($totalDonation ?? 0);
  $progress = 0;
  if ($goalAmount > 0) {
    $progress = min(100, max(0, ($raisedAmount / $goalAmount) * 100));
  }
@endphp

<section class="cf-detail-page">
  <div class="cfd-wrapper">
    <div class="cfd-grid">
      <article class="cfd-main-card">

        <div class="cfd-breadcrumb">
          <a href="{{ url('/ngo') }}">Home</a>
          <span>/</span>
          <a href="{{ url('/crowdfunding') }}">Crowdfunding</a>
          <span>/</span>
          <span>{{ $pagedetails->pagetitle ?? 'Crowdfunding' }}</span>
        </div>

        <h1 class="cfd-title">{{ $pagedetails->pagetitle ?? 'Crowdfunding' }}</h1>

        <div class="cfd-meta">
          <span class="pill">
            <i class="fa fa-calendar"></i>
            {{ optional($pagedetails->updated_at ?? $pagedetails->created_at)->format('M d, Y') }}
          </span>

          @if(!empty($pagedetails->amount))
            <span class="pill">
              <i class="fa fa-bullseye"></i>
              Goal: ₹{{ number_format((float)$pagedetails->amount) }}
            </span>
          @endif
        </div>

        @if(!empty($pagedetails->image))
          <div class="cfd-hero">
            <img src="{{ asset('backend/pages/'.$pagedetails->image) }}" alt="{{ $pagedetails->pagetitle ?? '' }}">
          </div>
        @endif

        <div class="cfd-progress">
          <div class="bar">
            <span style="width: {{ number_format($progress, 2) }}%;"></span>
          </div>
          <div class="labels">
            <div>Raised: ₹{{ number_format($raisedAmount) }}</div>
            <div>{{ number_format($progress, 0) }}%</div>
          </div>
        </div>

        <div class="cfd-content">
          {!! $pagedetails->description ?? '' !!}
        </div>
      </article>

      <aside class="cfd-sidebar">
        <h4>More Campaigns</h4>

        @if(isset($pages) && count($pages))
          <div>
            <ul class="cfd-related">
              @foreach($pages as $other)
                @php
                  $otherRaisedRs = (float)($other->totaldonation ?? 0);
                @endphp
                <li class="cfd-related-item">
                  <a href="{{ url('/crowdfunding/'.$other->id.'/'.$other->slug) }}">
                    {{ \Illuminate\Support\Str::limit($other->pagetitle, 60) }}
                  </a>
                  <div class="cfd-related-amt">
                    Raised: ƒ,1{{ number_format($otherRaisedRs) }}
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        @else
          <p style="margin:0; color:#64748b; font-size:14px;">No other campaigns found.</p>
        @endif
      </aside>
    </div>

  </div>
</section>
