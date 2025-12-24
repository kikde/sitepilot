@extends('layouts.master')

@section('content')

<style>
/* ========= EVENT DETAILS PAGE (scoped) ========= */

.event-detail-page{
  background:#f9fafb;
  padding:40px 0 60px;
  font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Noto Sans",Arial,sans-serif;
}
.event-detail-page .ed-wrapper{
  max-width:1140px;
  margin:0 auto;
}

/* main card + sidebar layout */
.event-detail-page .ed-main-card{
  background:#ffffff;
  border-radius:20px;
  box-shadow:0 18px 40px rgba(15,23,42,.12);
  padding:22px 20px 28px;
}
@media (min-width:992px){
  .event-detail-page .ed-main-card{
    padding:26px 28px 34px;
  }
}

/* hero section */
.ed-hero{
  position:relative;
  border-radius:18px;
  overflow:hidden;
  margin-bottom:18px;
  background:#0b1120;
}
.ed-hero-img img{
  width:100%;
  max-height:420px;
  object-fit:cover;
  display:block;
}

/* top label ribbons */
.ed-status-chip{
  position:absolute;
  top:14px;
  left:14px;
  padding:4px 12px;
  border-radius:999px;
  font-size:.76rem;
  font-weight:700;
  letter-spacing:.08em;
  text-transform:uppercase;
  color:#fff;
  box-shadow:0 8px 20px rgba(0,0,0,.35);
}
.ed-status-upcoming{ background:linear-gradient(135deg,#22c55e,#16a34a); }
.ed-status-completed{ background:linear-gradient(135deg,#4b5563,#111827); }
.ed-status-cancelled{ background:linear-gradient(135deg,#ef4444,#b91c1c); }
.ed-status-draft{ background:linear-gradient(135deg,#9ca3af,#4b5563); }

.ed-featured-badge{
  position:absolute;
  top:14px;
  right:14px;
  padding:4px 10px;
  border-radius:999px;
  font-size:.76rem;
  font-weight:700;
  background:linear-gradient(135deg,#f97316,#e11d48);
  color:#fff;
  box-shadow:0 8px 20px rgba(0,0,0,.35);
}

/* meta strip at bottom of image */
.ed-meta-strip{
  position:absolute;
  left:14px;
  right:14px;
  bottom:14px;
  border-radius:16px;
  padding:8px 12px;
  background:linear-gradient(90deg,rgba(220,38,38,.95),rgba(249,115,22,.95));
  color:#fff;
  display:flex;
  flex-wrap:wrap;
  align-items:center;
  gap:8px;
}
.ed-meta-item{
  display:flex;
  align-items:center;
  gap:6px;
  font-size:.8rem;
}
.ed-meta-item i{ font-size:.9rem; }

/* title + subtitle */
.ed-header{
  margin-bottom:12px;
}
.ed-title{
  font-size:1.8rem;
  font-weight:800;
  color:#111827;
  margin-bottom:6px;
  line-height:1.3;
}
@media (min-width:992px){
  .ed-title{ font-size:2.1rem; }
}
.ed-subtitle{
  margin:0;
  color:#6b7280;
  font-size:.96rem;
}

/* key facts cards */
.ed-facts-row{
  display:flex;
  flex-wrap:wrap;
  gap:12px;
  margin:14px 0 18px;
}
.ed-fact{
  flex:1 1 140px;
  min-width:0;
  background:#f3f4ff;
  border-radius:14px;
  padding:10px 12px;
  border:1px solid #e0e7ff;
  display:flex;
  flex-direction:column;
  gap:2px;
}
.ed-fact-label{
  font-size:.78rem;
  text-transform:uppercase;
  letter-spacing:.08em;
  color:#6b7280;
  font-weight:600;
}
.ed-fact-value{
  font-size:.95rem;
  font-weight:700;
  color:#111827;
}
.ed-fact-value i{
  margin-right:4px;
}

/* share strip */
.ed-share-strip{
  display:flex;
  flex-wrap:wrap;
  align-items:center;
  gap:8px;
  padding:10px 12px;
  border-radius:16px;
  background:#f3f4ff;
  border:1px solid #e0e7ff;
  margin-bottom:18px;
}
.ed-share-strip .label{
  font-size:.85rem;
  font-weight:600;
  color:#1f2937;
  margin-right:6px;
}

.ed-share-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:6px;
  padding:6px 12px;
  border-radius:999px;
  font-size:.8rem;
  font-weight:600;
  border:none;
  text-decoration:none;
  cursor:pointer;
  transition:.18s;
  white-space:nowrap;
}
.ed-share-btn i{ font-size:.9rem; }

.ed-share-btn.fb{ background:#1877f2; color:#fff; }
.ed-share-btn.x{ background:#0f172a; color:#fff; }
.ed-share-btn.wa{ background:#16a34a; color:#fff; }
.ed-share-btn.copy{
  background:#ffffff;
  color:#111827;
  border:1px solid #e5e7eb;
}
.ed-share-btn:hover{
  transform:translateY(-1px);
  box-shadow:0 8px 18px rgba(15,23,42,.1);
}

/* content area */
.ed-content{
  margin-top:4px;
  color:#111827;
  font-size:.98rem;
  line-height:1.75;
}
.ed-content p{ margin-bottom:1rem; }
.ed-content h2,
.ed-content h3,
.ed-content h4{
  margin-top:1.2rem;
  margin-bottom:.5rem;
  font-weight:700;
  color:#111827;
}

/* secondary sections */
.ed-section-title{
  margin-top:20px;
  font-size:1.05rem;
  font-weight:700;
  color:#111827;
}
.ed-list{
  margin:8px 0 0;
  padding-left:18px;
  color:#374151;
  font-size:.93rem;
}

/* CTA buttons */
.ed-cta-row{
  margin-top:18px;
  display:flex;
  flex-wrap:wrap;
  gap:10px;
}
.ed-cta-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  padding:9px 14px;
  border-radius:999px;
  border:none;
  text-decoration:none;
  font-size:.9rem;
  font-weight:600;
  cursor:pointer;
  transition:.18s;
}
.ed-cta-primary{
  background:linear-gradient(135deg,#f97316,#dc2626);
  color:#fff;
}
.ed-cta-secondary{
  background:#ffffff;
  color:#111827;
  border:1px solid #e5e7eb;
}
.ed-cta-btn i{ font-size:.95rem; }
.ed-cta-btn:hover{
  transform:translateY(-1px);
  box-shadow:0 8px 18px rgba(15,23,42,.12);
}

/* tags row */
.ed-tags{
  margin-top:18px;
  display:flex;
  flex-wrap:wrap;
  gap:8px;
}
.ed-tag{
  padding:4px 10px;
  border-radius:999px;
  background:#fef2f2;
  color:#b91c1c;
  font-size:.78rem;
  border:1px solid #fecaca;
}

/* sidebar */
.ed-sidebar{
  background:#0b1120;
  color:#e5e7eb;
  border-radius:20px;
  padding:18px 16px 20px;
  box-shadow:0 18px 34px rgba(15,23,42,.22);
}
.ed-sidebar-title{
  font-size:1.05rem;
  font-weight:700;
  margin-bottom:4px;
  color:#f9fafb;
}
.ed-sidebar-sub{
  font-size:.8rem;
  color:#9ca3af;
  margin-bottom:12px;
}

/* info list boxes */
.ed-info-box{
  background:rgba(15,23,42,.8);
  border-radius:14px;
  padding:10px 11px 12px;
  margin-bottom:12px;
  border:1px solid rgba(148,163,184,.7);
}
.ed-info-heading{
  font-size:.83rem;
  font-weight:700;
  text-transform:uppercase;
  letter-spacing:.08em;
  margin-bottom:6px;
  color:#e5e7eb;
}
.ed-info-line{
  font-size:.84rem;
  margin-bottom:2px;
}
.ed-info-line i{
  margin-right:6px;
}

/* related events list */
.ed-related-list{
  list-style:none;
  padding:0;
  margin:6px 0 0;
  display:flex;
  flex-direction:column;
  gap:8px;
}
.ed-related-item a{
  color:#e5e7eb;
  font-size:.84rem;
  text-decoration:none;
}
.ed-related-item a:hover{ color:#f97316; }
.ed-related-date{
  font-size:.75rem;
  color:#9ca3af;
}

/* mobile adjustments */
@media (max-width:991.98px){
  .event-detail-page{
    padding:26px 0 40px;
  }
  .ed-sidebar{
    margin-top:16px;
  }
}
/* MOBILE: icon-only share buttons on EVENT page */
@media (max-width: 575.98px){
  .ed-share-strip{
    flex-wrap:wrap;
    align-items:center;
    padding:8px 10px;
    border-radius:14px;
  }

  .ed-share-strip .label{
    width:100%;
    margin:0 0 4px 2px;
  }

  .ed-share-btn{
    width:40px;
    height:40px;
    padding:0;
    border-radius:10px;
    justify-content:center;
    font-size:0;        /* hides the text “Facebook / WhatsApp” */
  }

  .ed-share-btn i{
    font-size:1.1rem;   /* icon visible & clear */
  }
}

</style>

@php
  /** @var \App\Models\Event $event */
  $eventUrl   = url('/events/'.$event->id.'/'.$event->slug);
  $isFree     = (bool)$event->is_free;
  $startDate  = $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('F d, Y') : null;
  $endDate    = $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('F d, Y') : null;
  $startTime  = $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') : null;
  $endTime    = $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('h:i A') : null;
  $deadline   = $event->registration_deadline ? \Carbon\Carbon::parse($event->registration_deadline)->format('F d, Y') : null;
@endphp

<section class="event-detail-page">
  <div class="ed-wrapper auto-container">
    <div class="row clearfix">
      {{-- MAIN CONTENT --}}
      <div class="col-lg-8 col-md-12 col-sm-12">
        <article class="ed-main-card">
          {{-- HERO --}}
          <div class="ed-hero">
            <div class="ed-hero-img">
              @if($event->image)
                <img src="{{asset('backend/events/'.$event->image)}}" alt="{{ $event->title }}">
              @else
                <img src="{{ asset('frontend/custom/event-placeholder.jpg') }}" alt="{{ $event->title }}">
              @endif
            </div>

            {{-- STATUS CHIP --}}
            @php
              $statusClass = match($event->status){
                'published' => 'ed-status-upcoming',
                'completed' => 'ed-status-completed',
                'cancelled' => 'ed-status-cancelled',
                default     => 'ed-status-draft',
              };
            @endphp
            <span class="ed-status-chip {{ $statusClass }}">
              {{ ucfirst($event->status) }}
            </span>

            {{-- FEATURED BADGE --}}
            @if($event->is_featured)
              <span class="ed-featured-badge">Featured Event</span>
            @endif

            {{-- META STRIP --}}
            <div class="ed-meta-strip">
              @if($startDate)
                <span class="ed-meta-item">
                  <i class="far fa-calendar-alt"></i>
                  {{ $startDate }}
                  @if($endDate && $endDate !== $startDate)
                    – {{ $endDate }}
                  @endif
                </span>
              @endif

              @if($startTime)
                <span class="ed-meta-item">
                  <i class="far fa-clock"></i>
                  {{ $startTime }}
                  @if($endTime) – {{ $endTime }} @endif
                  @if($event->timezone)
                    <span style="opacity:.9;">({{ $event->timezone }})</span>
                  @endif
                </span>
              @endif

              @if($event->venue_city || $event->venue_state || $event->venue_country)
                <span class="ed-meta-item">
                  <i class="fas fa-map-marker-alt"></i>
                  {{ $event->venue_city }}
                  @if($event->venue_state) , {{ $event->venue_state }} @endif
                  @if($event->venue_country) , {{ $event->venue_country }} @endif
                </span>
              @endif
            </div>
          </div>

          {{-- TITLE / SUBTITLE --}}
          <header class="ed-header">
            <h1 class="ed-title">{{ $event->title }}</h1>
            @if($event->short_description)
              <p class="ed-subtitle">{{ $event->short_description }}</p>
            @endif
             @if($event->short_description)
              <p class="ed-subtitle">{!!$event->description !!}</p>
            @endif

          </header>

          {{-- KEY FACTS ROW --}}
          <div class="ed-facts-row">
            <div class="ed-fact">
              <div class="ed-fact-label">Cost</div>
              <div class="ed-fact-value">
                @if($isFree)
                  <i class="fas fa-ticket-alt"></i> Free Event
                @elseif($event->price_amount)
                  <i class="fas fa-ticket-alt"></i>
                  {{ $event->price_currency ?? 'INR' }} {{ number_format($event->price_amount, 2) }}
                  @if($event->cost_label) ({{ $event->cost_label }}) @endif
                @else
                  <i class="fas fa-ticket-alt"></i> See details
                @endif
              </div>
            </div>

            @if($event->capacity || $event->available_tickets)
              <div class="ed-fact">
                <div class="ed-fact-label">Seats / Tickets</div>
                <div class="ed-fact-value">
                  @if($event->capacity)
                    Capacity: {{ $event->capacity }}
                  @endif
                  @if($event->available_tickets)
                    @if($event->capacity) • @endif
                    Available: {{ $event->available_tickets }}
                  @endif
                </div>
              </div>
            @endif

            @if($deadline)
              <div class="ed-fact">
                <div class="ed-fact-label">Registration Closes</div>
                <div class="ed-fact-value">
                  <i class="far fa-calendar-check"></i> {{ $deadline }}
                </div>
              </div>
            @endif
          </div>

          {{-- SHARE STRIP --}}
          <div class="ed-share-strip">
            <span class="label">Share this event:</span>

            <a class="ed-share-btn fb"
               target="_blank"
               href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($eventUrl) }}">
              <i class="fab fa-facebook-f"></i> Facebook
            </a>

            <a class="ed-share-btn x"
               target="_blank"
               href="https://twitter.com/intent/tweet?url={{ urlencode($eventUrl) }}&text={{ urlencode($event->title) }}">
              <i class="fab fa-twitter"></i> X Twitter
            </a>

            <a class="ed-share-btn wa"
               target="_blank"
               href="https://wa.me/?text={{ urlencode($event->title.' '.$eventUrl) }}">
              <i class="fab fa-whatsapp"></i> WhatsApp
            </a>

            <button class="ed-share-btn copy" type="button"
                    onclick="navigator.clipboard.writeText('{{ $eventUrl }}')">
              <i class="fas fa-link"></i> Copy Link
            </button>
          </div>

          {{-- MAIN CONTENT --}}
          <div class="ed-content">
            {!! $event->event_content !!}
          </div>

          {{-- OPTIONAL SECTIONS --}}
          @if($event->tickets || $event->video_url || $event->brochure_url)
            <h3 class="ed-section-title">Event Resources</h3>
            <ul class="ed-list">
              @if($event->tickets)
                <li>{{ $event->tickets }}</li>
              @endif
              @if($event->video_url)
                <li>
                  🎥 Event video:
                  <a href="{{ $event->video_url }}" target="_blank">Watch / Preview</a>
                </li>
              @endif
              @if($event->brochure_url)
                <li>
                  📄 Download brochure:
                  <a href="{{ $event->brochure_url }}" target="_blank">Download</a>
                </li>
              @endif
            </ul>
          @endif

          {{-- CTA BUTTONS --}}
          <div class="ed-cta-row">
            @if($event->registration_required && $event->registration_url)
              <a href="{{ $event->registration_url }}" target="_blank"
                 class="ed-cta-btn ed-cta-primary">
                <i class="fas fa-edit"></i> Register Now
              </a>
            @endif

            @if($event->venue_map_url)
              <a href="{{ $event->venue_map_url }}" target="_blank"
                 class="ed-cta-btn ed-cta-secondary">
                <i class="fas fa-map-marked-alt"></i> View on Map
              </a>
            @endif
          </div>

          {{-- TAGS FROM CATEGORY / LOCATION --}}
          <div class="ed-tags">
            @if($event->category_id)
              <span class="ed-tag">#Category {{ $event->category_id }}</span>
            @endif
            @if($event->venue_city)
              <span class="ed-tag">#{{ $event->venue_city }}</span>
            @endif
            @if($event->venue_state)
              <span class="ed-tag">#{{ $event->venue_state }}</span>
            @endif
          </div>
        </article>
      </div>

      {{-- SIDEBAR --}}
      <div class="col-lg-4 col-md-12 col-sm-12">
        <aside class="ed-sidebar">
          {{-- Organizer box --}}
          <div class="ed-info-box">
            <div class="ed-info-heading">Organizer</div>
            <div class="ed-info-line">
              <i class="fas fa-user-tie"></i> {{ $event->organizer ?? 'Vihatmaa Sewa Foundation' }}
            </div>
            @if($event->organizer_email)
              <div class="ed-info-line">
                <i class="far fa-envelope"></i> {{ $event->organizer_email }}
              </div>
            @endif
            @if($event->organizer_phone)
              <div class="ed-info-line">
                <i class="fas fa-phone-alt"></i> {{ $event->organizer_phone }}
              </div>
            @endif
            @if($event->organizer_whatsapp)
              <div class="ed-info-line">
                <i class="fab fa-whatsapp"></i> {{ $event->organizer_whatsapp }}
              </div>
            @endif
            @if($event->organizer_website)
              <div class="ed-info-line">
                <i class="fas fa-globe"></i>
                <a href="{{ $event->organizer_website }}" target="_blank" style="color:#93c5fd;">
                  Visit website
                </a>
              </div>
            @endif
          </div>

          {{-- Venue box --}}
          <div class="ed-info-box">
            <div class="ed-info-heading">Venue</div>
            @if($event->venue)
              <div class="ed-info-line">
                <i class="fas fa-building"></i> {{ $event->venue }}
              </div>
            @endif
            @if($event->venue_address)
              <div class="ed-info-line">
                <i class="fas fa-map-marker-alt"></i> {{ $event->venue_address }}
              </div>
            @endif
            @if($event->venue_city || $event->venue_state || $event->venue_country)
              <div class="ed-info-line">
                {{ $event->venue_city }}
                @if($event->venue_state) , {{ $event->venue_state }} @endif
                @if($event->venue_country) , {{ $event->venue_country }} @endif
              </div>
            @endif
            @if($event->venue_phone)
              <div class="ed-info-line">
                <i class="fas fa-phone"></i> {{ $event->venue_phone }}
              </div>
            @endif
            @if($event->venue_map_url)
              <div class="ed-info-line">
                <i class="fas fa-map"></i>
                <a href="{{ $event->venue_map_url }}" target="_blank" style="color:#93c5fd;">
                  Open in Google Maps
                </a>
              </div>
            @endif
          </div>

          {{-- Related events (optional) --}}
          @if(isset($relatedEvents) && $relatedEvents->count())
            <div class="ed-info-box">
              <div class="ed-info-heading">More Events</div>
              <ul class="ed-related-list">
                @foreach($relatedEvents as $re)
                  <li class="ed-related-item">
                    <a href="{{ url('/events/'.$re->id.'/'.$re->slug) }}">
                      {{ \Illuminate\Support\Str::limit($re->title, 60) }}
                    </a>
                    <div class="ed-related-date">
                      {{ optional($re->start_date)->format('M d, Y') }}
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

{{-- simple copy-link feedback (optional) --}}
<script>
  // You can extend this if you want a toast after copy; for now it's just quiet copy.
</script>

@endsection
