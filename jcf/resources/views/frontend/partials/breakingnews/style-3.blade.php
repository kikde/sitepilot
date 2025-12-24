<section class="news-twoCol">
  <header class="ntc-head">
   
    <span class="rp-title" style="color:#ff7a00; font-weight:700;">
  Upcoming Events
</span>
    <span class="ntc-icon" aria-hidden="true">⏰</span>
  </header>

  <div class="ntc-cols">
 <!-- Column A -->

   
   
      @foreach( $all_events as $events)
         
      <article class="ntc-item">
        <a class="ntc-thumb" href="#"><img src="{{asset('backend/events/'.$events->image)}}" alt=""></a>
        <div class="ntc-body">
          <a class="ntc-link" href="{{url('/event-details/'.$events->id.'/'.$events->slug)}}">{{ Str::words($events->title, 20, '…') }}</a>
          <div class="ntc-meta"><time>{{ $events->updated_at->format('F d, Y') }}</time></div>
        </div>
      </article>
  @endforeach
      
<div class="all-events" style="display:flex; justify-content:center; margin-top:16px;">
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
</section>



  