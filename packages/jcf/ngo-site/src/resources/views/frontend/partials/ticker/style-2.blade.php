<!-- Ribbon / Testimonials Ticker (clickable) -->
 <div class="ribbon-ticker" role="region" aria-label="Testimonials">
  <div class="ribbon-label">Events</div>
  <div class="ribbon-track">
     @foreach( $all_events  as $tickers)

    <a href="#testimonials" class="ribbon-text">
      <strong>{{$tickers->title}}</strong> — {{$tickers->meta_description}}
    </a>
    @endforeach
  </div>
</div>
  