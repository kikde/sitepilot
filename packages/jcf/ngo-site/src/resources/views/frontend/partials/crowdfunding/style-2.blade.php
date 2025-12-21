@extends('layouts.master')

@section('content')

<style>
  /* ==== All Funding list page (scoped) ==== */
  .cf-list-page{
    background:#f9fafb;
    padding:40px 0 60px;
  }
  .cf-list-page .cf-head{
    text-align:center;
    margin-bottom:28px;
  }
  .cf-list-page .cf-kicker{
    font-size:.8rem;
    letter-spacing:.16em;
    text-transform:uppercase;
    color:#ff4d4d;
    margin-bottom:6px;
  }
  .cf-list-page .cf-title{
    font-size:1.9rem;
    font-weight:800;
    color:#111827;
    margin:0 0 6px;
  }
  .cf-list-page .cf-sub{
    color:#6b7280;
    font-size:.95rem;
    max-width:640px;
    margin:0 auto;
  }

  .cf-grid-row{
    row-gap:24px;
  }

  .cf-card{
    background:#ffffff;
    border-radius:18px;
    box-shadow:0 18px 40px rgba(15,23,42,.12);
    overflow:hidden;
    display:flex;
    flex-direction:row;
    gap:14px;
    padding:12px 14px;
    height:100%;
    border:1px solid #f3f4f6;
  }

  .cf-thumb-wrap{
    flex:0 0 34%;
    max-width:34%;
    border-radius:14px;
    overflow:hidden;
    background:#f3f4ff;
    position:relative;
  }
  .cf-thumb-wrap img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }
  .cf-tag{
    position:absolute;
    left:8px;
    top:8px;
    padding:3px 9px;
    border-radius:999px;
    font-size:.7rem;
    text-transform:uppercase;
    letter-spacing:.14em;
    background:#ffffff;
    color:#f97316;
    font-weight:700;
  }

  .cf-body{
    flex:1;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
  }
  .cf-category{
    font-size:.75rem;
    text-transform:uppercase;
    letter-spacing:.16em;
    color:#9ca3af;
    margin-bottom:2px;
  }
  .cf-name{
    font-size:1.05rem;
    font-weight:800;
    margin:0 0 4px;
    color:#111827;
  }
  .cf-title-line{
    font-size:.9rem;
    font-weight:600;
    color:#ef4444;
    margin-bottom:4px;
  }
  .cf-desc{
    font-size:.87rem;
    color:#4b5563;
    margin-bottom:8px;
  }

  /* (optional) tiny meta row – you can hook donations later */
  .cf-meta-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:.8rem;
    color:#6b7280;
    margin-bottom:6px;
  }

  .cf-actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:8px;
    margin-top:4px;
  }

  .cf-cta{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:7px 16px;
    border-radius:999px;
    border:none;
    text-decoration:none;
    font-size:.86rem;
    font-weight:700;
    cursor:pointer;
    background:linear-gradient(135deg,#ff4d4d,#ff934d);
    color:#fff;
    box-shadow:0 8px 20px rgba(239,68,68,.3);
  }
  .cf-cta:hover{
    text-decoration:none;
    opacity:.95;
  }

  .cf-link{
    font-size:.82rem;
    font-weight:600;
    color:#2563eb;
    text-decoration:none;
  }
  .cf-link:hover{
    text-decoration:underline;
  }

  .cf-empty{
    text-align:center;
    color:#6b7280;
    margin-top:24px;
  }

  /* pagination wrapper */
  .cf-pagination{
    margin-top:24px;
  }

  /* Mobile tweaks */
  @media (max-width: 767.98px){
    .cf-card{
      flex-direction:column;
      padding:12px;
    }
    .cf-thumb-wrap{
      flex:0 0 auto;
      max-width:100%;
      height:190px;
    }
  }

.cf-progress{
  width:100%;
  background:#f3f4f6;
  border-radius:999px;
  overflow:hidden;
  height:7px;
  margin:4px 0 6px;
}
.cf-progress-bar{
  height:100%;
  background:linear-gradient(90deg,#22c55e,#16a34a);
}

</style>

<section class="cf-list-page">
  <div class="auto-container">
    <header class="cf-head">
      <div class="cf-kicker">Support Our Causes</div>
      <h2 class="cf-title">All Crowd Funding Campaigns</h2>
      <p class="cf-sub">Choose a campaign close to your heart and help {{$setting->title}} continue its work.</p>
    </header>

    @if($funds->count())
      <div class="row cf-grid-row">
        @foreach($funds as $fund)

        @php
    $target        = $fund->raised_fund ?? 0; // column in pages table
    $raisedPaise   = $donationSums[$fund->slug] ?? 0;
    $raisedRupees  = round($raisedPaise / 100);
    $percent       = $target > 0 ? min(100, round(($raisedRupees / $target) * 100)) : 0;
@endphp
          <div class="col-lg-6 col-md-6 col-sm-12">
            <article class="cf-card">
              <div class="cf-thumb-wrap">
                <span class="cf-tag">{{$fund->slug}}</span>
                @if($fund->breadcrumb)
                  <img src="{{ asset('backend/uploads/'.$fund->breadcrumb) }}"
                       alt="{{ $fund->pagetitle ?? $fund->name }}">
                @else
                  <img src="{{ asset('frontend/custom/breadcrumb.png') }}"
                       alt="Crowd funding">
                @endif
              </div>

              <div class="cf-body">
                <div>
                  @if($fund->pagekeyword)
                    <div class="cf-category">{{ strtoupper($fund->pagekeyword) }}</div>
                  @endif

                  <h3 class="cf-name">{{ $fund->pagetitle ?? $fund->name }}</h3>

                  @if($fund->description)
                    <p class="cf-desc">
                      {{ \Illuminate\Support\Str::limit(strip_tags($fund->description), 130) }}
                    </p>
                  @endif

                  <div class="cf-meta-row">
  <span>
    Raised: ₹{{ number_format($raisedRupees) }}
    @if($target)
      of ₹{{ number_format($target) }}
    @endif
  </span>

  @if($target)
    <span>{{ $percent }}% funded</span>
  @endif
</div>

@if($target)
  <div class="cf-progress">
    <div class="cf-progress-bar" style="width: {{ $percent }}%;"></div>
  </div>
@endif

                </div>

                <div class="cf-actions">
                  {{-- Adjust donate URL if yours is different --}}
                  <a href="{{ url('/user-donate?campaign='.$fund->slug) }}" class="cf-cta">
                    Donate Now
                  </a>

                  <a href="{{ url('/crowdfunding/'.$fund->id.'/'.$fund->slug) }}"
                     class="cf-link">
                    View details →
                  </a>
                </div>
              </div>
            </article>
          </div>
        @endforeach
      </div>

      <div class="cf-pagination text-center">
        {!! $funds->links('vendor.pagination.default') !!}
      </div>
    @else
      <p class="cf-empty">No active crowd funding campaigns found.</p>
    @endif
  </div>
</section>

@endsection
