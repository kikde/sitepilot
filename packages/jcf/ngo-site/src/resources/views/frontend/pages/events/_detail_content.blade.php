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

.event-detail-page .ed-grid{
  display:grid;
  grid-template-columns:1fr;
  gap:18px;
}
@media (min-width:992px){
  .event-detail-page .ed-grid{ grid-template-columns:1fr 360px; }
}

.event-detail-page .ed-breadcrumb{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
  align-items:center;
  font-size:14px;
  color:#64748b;
  margin-bottom:14px;
}
.event-detail-page .ed-breadcrumb a{
  color:#2563eb;
  text-decoration:none;
  font-weight:700;
}
.event-detail-page .ed-title{
  font-size:30px;
  line-height:1.2;
  font-weight:900;
  color:#0f172a;
  margin:8px 0 12px;
}
.event-detail-page .ed-meta{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
  align-items:center;
  font-size:14px;
  color:#64748b;
  margin-bottom:18px;
}
.event-detail-page .ed-meta .pill{
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

.event-detail-page .ed-hero{
  border-radius:16px;
  overflow:hidden;
  background:#0b1220;
  margin-bottom:18px;
}
.event-detail-page .ed-hero img{
  width:100%;
  height:auto;
  display:block;
}

.event-detail-page .ed-content{
  font-size:16px;
  line-height:1.8;
  color:#334155;
}
.event-detail-page .ed-content p{ margin:0 0 14px; }
.event-detail-page .ed-content a{ color:#2563eb; font-weight:700; }

.event-detail-page .ed-sidebar{
  background:#ffffff;
  border-radius:18px;
  box-shadow:0 18px 40px rgba(15,23,42,.08);
  padding:18px 18px 20px;
  position:sticky;
  top:18px;
  height:fit-content;
}
.event-detail-page .ed-sidebar h4{
  margin:0 0 12px;
  font-size:16px;
  font-weight:900;
  color:#0f172a;
}
.event-detail-page .ed-related{
  list-style:none;
  padding:0;
  margin:0;
  display:flex;
  flex-direction:column;
  gap:12px;
}
.event-detail-page .ed-related-item{
  padding:12px 12px;
  border-radius:14px;
  background:#f8fafc;
}
.event-detail-page .ed-related-item a{
  color:#0f172a;
  text-decoration:none;
  font-weight:900;
  line-height:1.35;
  display:block;
}
.event-detail-page .ed-related-item a:hover{ color:#2563eb; }
.event-detail-page .ed-related-date{
  margin-top:6px;
  font-size:12px;
  color:#64748b;
  font-weight:800;
}
</style>

<section class="event-detail-page">
  <div class="ed-wrapper">
    <div class="ed-grid">
      <article class="ed-main-card">

        <div class="ed-breadcrumb">
          <a href="{{ url('/ngo') }}">Home</a>
          <span>/</span>
          <a href="{{ url('/event') }}">Events</a>
          <span>/</span>
          <span>{{ $event->title ?? 'Event Details' }}</span>
        </div>

        <h1 class="ed-title">{{ $event->title ?? 'Event Details' }}</h1>

        <div class="ed-meta">
          @if(!empty($event->start_date))
            <span class="pill">
              <i class="fa fa-calendar"></i>
              {{ optional($event->start_date)->format('M d, Y') }}
            </span>
          @endif

          @if(!empty($event->location))
            <span class="pill">
              <i class="fa fa-map-marker"></i>
              {{ $event->location }}
            </span>
          @endif
        </div>

        @if(!empty($event->image))
          <div class="ed-hero">
            <img src="{{ asset('backend/events/'.$event->image) }}" alt="{{ $event->title ?? '' }}">
          </div>
        @endif

        <div class="ed-content">
          {!! $event->description ?? '' !!}
        </div>
      </article>

      <aside class="ed-sidebar">
        <h4>More Events</h4>

        @if(isset($relatedEvents) && count($relatedEvents))
          <div>
            <ul class="ed-related">
              @foreach($relatedEvents as $re)
                <li class="ed-related-item">
                  <a href="{{ url('/event-details/'.$re->id.'/'.$re->slug) }}">
                    {{ \Illuminate\Support\Str::limit($re->title, 70) }}
                  </a>
                  <div class="ed-related-date">
                    {{ optional($re->start_date)->format('M d, Y') }}
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        @else
          <p style="margin:0; color:#64748b; font-size:14px;">No other events found.</p>
        @endif
      </aside>
    </div>
  </div>
</section>

