<style>
   
    .auto-container2 {
      max-width: 1140px;
      margin: 0 auto;
    }

    /* ===== Events Slider STYLE 2 (VSF-EVT2) ===== */

    .vsf-evt2-section {
      padding: 20px 0 40px 0;
    }

    .vsf-evt2-header {
      text-align: center;
      margin-bottom: 26px;
    }

    .vsf-evt2-header h6 {
      font-size: 14px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: #ff5a1f;
      margin-bottom: 6px;
    }

    .vsf-evt2-header h2 {
      font-size: 30px;
      font-weight: 800;
      color: #1f2933;
      margin-bottom: 8px;
    }

    .vsf-evt2-header p {
      color: #6b7280;
      font-size: 14px;
    }

    .vsf-evt2-card {
      padding: 10px;
    }

    .vsf-evt2-inner {
      background: linear-gradient(140deg, #ffffff, #fff7f2);
      border-radius: 26px;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
      border: 1px solid rgba(255, 255, 255, 0.9);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .vsf-evt2-media {
      position: relative;
      overflow: hidden;
    }

    .vsf-evt2-image {
      width: 100%;
      height: 190px;
      object-fit: cover;
      display: block;
      transform: scale(1);
      transition: transform 0.35s ease;
    }

    .vsf-evt2-inner:hover .vsf-evt2-image {
      transform: scale(1.05);
    }

    .vsf-evt2-gradient {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent 60%);
      pointer-events: none;
    }

    .vsf-evt2-category-pill {
      position: absolute;
      left: 14px;
      bottom: 14px;
      padding: 4px 11px;
      border-radius: 999px;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      background: rgba(253, 126, 20, 0.96);
      color: #ffffff;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      z-index: 2;
    }

    .vsf-evt2-category-icon {
      font-size: 12px;
    }

    .vsf-evt2-date-badge {
      position: absolute;
      right: 14px;
      bottom: 14px;
      background: rgba(255, 255, 255, 0.96);
      color: #111827;
      border-radius: 12px;
      padding: 6px 9px;
      font-size: 11px;
      text-align: right;
      z-index: 2;
      box-shadow: 0 10px 22px rgba(15, 23, 42, 0.4);
    }

    .vsf-evt2-date-main {
      font-weight: 800;
      font-size: 15px;
      color: #ff5a1f;
    }

    .vsf-evt2-date-sub {
      font-size: 11px;
      color: #4b5563;
    }

    .vsf-evt2-body {
      padding: 14px 16px 14px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .vsf-evt2-title {
      font-size: 17px;
      font-weight: 800;
      color: #111827;
      margin-bottom: 6px;
    }

    .vsf-evt2-desc {
      font-size: 13px;
      color: #4b5563;
      line-height: 1.45;
      margin-bottom: 10px;
      max-height: 60px;
      overflow: hidden;
    }

    .vsf-evt2-meta-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 6px 14px;
      font-size: 12px;
      color: #4b5563;
      margin-bottom: 10px;
    }

    .vsf-evt2-meta-item {
      display: flex;
      align-items: flex-start;
      gap: 6px;
      line-height: 1.4;
    }

    .vsf-evt2-meta-label {
      font-weight: 600;
      color: #111827;
    }

    .vsf-evt2-meta-icon {
      font-size: 13px;
      width: 16px;
      text-align: center;
      color: #f97316;
      margin-top: 2px;
    }

    .vsf-evt2-meta-text span {
      display: block;
    }

    .vsf-evt2-footer {
      margin-top: auto;
      padding-top: 6px;
      border-top: 1px dashed rgba(148, 163, 184, 0.6);
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
    }

    .vsf-evt2-cost-pill {
      padding: 5px 11px;
      border-radius: 999px;
      background: #22c55e;
      color: #ffffff;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 0 8px 16px rgba(34, 197, 94, 0.6);
    }

    .vsf-evt2-cost-pill-paid {
      background: #f97316;
    }

    .vsf-evt2-tickets-pill {
      padding: 4px 10px;
      border-radius: 999px;
      background: #fef3c7;
      color: #b45309;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .vsf-evt2-small-icon {
      font-size: 12px;
    }

    .vsf-evt2-contact-row {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 8px;
      font-size: 11px;
    }

    .vsf-evt2-contact-pill {
      padding: 4px 9px;
      border-radius: 999px;
      background: rgba(15, 23, 42, 0.03);
      color: #1d4ed8;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .vsf-evt2-contact-pill:hover {
      text-decoration: underline;
    }

    .vsf-evt2-dots-row {
      display: flex;
      justify-content: center;
      gap: 6px;
      margin-top: 16px;
    }

    .vsf-evt2-base-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: rgba(148, 163, 184, 0.35);
      box-shadow: 0 0 8px rgba(148, 163, 184, 0.4);
    }

    @media (max-width: 575.98px) {
      /* body {
        padding: 20px 10px;
      } */
      .vsf-evt2-header h2 {
        font-size: 24px;
      }
      .vsf-evt2-image {
        height: 350px;
      }
      .vsf-evt2-meta-grid {
        grid-template-columns: 1fr;
      }
    }
.vsf-evt2-section .vsf-evt2-carousel .owl-nav{
  display:none !important;
}


  </style>

  <section class="vsf-evt2-section">
    <div class="auto-container2">

      <div class="vsf-evt2-header">
        <h6>Upcoming Programs</h6>
        <h2>Events &amp; Activities</h2>
        <p>Join our on-ground drives, awareness camps and special celebrations.</p>
      </div>

      <div class="vsf-evt2-wrapper">
        <div class="vsf-evt2-carousel owl-carousel owl-theme">
           @foreach( $all_events as $events)
          <!-- Event 1 (demo) -->
          <div class="vsf-evt2-card">
            <div class="vsf-evt2-inner">
              <div class="vsf-evt2-media">
                <img
                  class="vsf-evt2-image"
                  src="{{asset('backend/events/'.$events->image)}}"
                  alt="Event 1"
                />
                <div class="vsf-evt2-gradient"></div>

                <!-- Category -->
                <div class="vsf-evt2-category-pill">
                  <span class="vsf-evt2-category-icon">🍽️</span>
                  <span>{{$events->category_id }}</span>
                </div>
@php
   $startDate  = $events->start_date ? \Carbon\Carbon::parse($events->start_date)->format('F d, Y') : null;
  $endDate    = $events->end_date ? \Carbon\Carbon::parse($events->end_date)->format('F d, Y') : null;
  $startTime  = $events->start_time ? \Carbon\Carbon::parse($events->start_time)->format('h:i A') : null;
  $endTime    = $events->end_time ? \Carbon\Carbon::parse($events->end_time)->format('h:i A') : null;
@endphp
                <!-- Date + Time -->
                <div class="vsf-evt2-date-badge">
                  @if($startDate)
                  <div class="vsf-evt2-date-main">
                    {{ $startDate }}
                  @if($endDate && $endDate !== $startDate)
                    – {{ $endDate }}
                  @endif
                </div>
                 @endif
                 @if($startTime)
                  <div class="vsf-evt2-date-sub">
                  {{$startTime}}
                   @if($endTime) – {{ $endTime }} @endif
                  @if($events->timezone)
                    <span style="opacity:.9;">({{ $events->timezone }})</span>
                  @endif
                </div>
              @endif
                </div>
              </div>

              <div class="vsf-evt2-body">
                <div class="vsf-evt2-title">
                 <a href="{{url('/event-details/'.$events->id.'/'.$events->slug)}}" >{{$events->title}}</a>
                </div>
                <div class="vsf-evt2-desc">
                  {{$events->short_description}}
                </div>

               <div class="vsf-evt2-meta-grid d-flex flex-wrap">
                  <div class="vsf-evt2-meta-item d-flex">
                    <span class="vsf-evt2-meta-icon">📍</span>
                    <div class="vsf-evt2-meta-text">
                      <span class="vsf-evt2-meta-label d-block">Venue</span>
                      <span class="vsf-evt2-meta-value d-block">{{$events->venue}}</span>
                    </div>
                  </div>

                  <div class="vsf-evt2-meta-item d-flex">
                    <span class="vsf-evt2-meta-icon">📌</span>
                    <div class="vsf-evt2-meta-text">
                      <span class="vsf-evt2-meta-label d-block">Location</span>
                      <span class="vsf-evt2-meta-value d-block">{{$events->venue_location}}</span>
                    </div>
                  </div>

                  <div class="vsf-evt2-meta-item d-flex">
                    <span class="vsf-evt2-meta-icon">☎️</span>
                    <div class="vsf-evt2-meta-text">
                      <span class="vsf-evt2-meta-label d-block">Venue Phone</span>
                      <span class="vsf-evt2-meta-value d-block">{{$events->venue_phone}}</span>
                    </div>
                  </div>

                  <div class="vsf-evt2-meta-item d-flex">
                    <span class="vsf-evt2-meta-icon">👤</span>
                    <div class="vsf-evt2-meta-text">
                      <span class="vsf-evt2-meta-label d-block">Organizer</span>
                      <span class="vsf-evt2-meta-value d-block">{{$events->organizer}}</span>
                    </div>
                  </div>
                </div>


                <div class="vsf-evt2-footer">
                  <div class="vsf-evt2-cost-pill">
                    <span class="vsf-evt2-small-icon">{{$events->cost_label}}</span>
                    <span>{{$events->is_free}}</span>
                  </div>

                  <div class="vsf-evt2-tickets-pill">
                    <span class="vsf-evt2-small-icon">🎫</span>
                    <span>{{$events->tickets}} ({{$events->available_tickets}})</span>
                  </div>
                </div>

                <div class="vsf-evt2-contact-row d-flex">
                  <a href="tel:{{$events->organizer_phone}}" class="vsf-evt2-contact-pill">
                    <span class="vsf-evt2-small-icon">📞{{$events->organizer_phone}}</span>
                  </a>
                  <a href="mailto:{{$events->organizer_email}}" class="vsf-evt2-contact-pill">
                    <span class="vsf-evt2-small-icon">💌{{$events->organizer_email}}</span>
                  </a>
                  <a href="{{url($events->organizer_website)}}" target="_blank" class="vsf-evt2-contact-pill">
                    <span class="vsf-evt2-small-icon">🌐{{$events->organizer_website}}</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
            

        </div>

        <div class="vsf-evt2-dots-row">
             <a href="{{url('/event-all')}}"
       class="events-btn"
       style="
           background: linear-gradient(90deg, #6ab4cf, #00a5e2);
           color: #ffffff;
           padding: 8px 28px;
           border-radius: 999px;
           font-weight: 700;
           text-decoration: none;
           display: inline-flex;
           align-items: center;
           justify-content: center;
           border: none;
       ">
        View All Events
      </a>
        </div>
      </div>
    </div>
  </section>

  <!-- jQuery + Owl Carousel JS (CDN) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script>
    $(document).ready(function(){
      $('.vsf-evt2-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3800,
        smartSpeed: 750, 
        responsive:{
          0:{ items:1 },
          576:{ items:1 },
          768:{ items:2 },
          992:{ items:3 }
        }
      });
    });
  </script>

