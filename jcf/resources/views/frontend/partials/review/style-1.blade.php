<section class="rv-section">
  <div class="container position-relative">
    <h3 class="rv-title">What people say</h3>

    <div class="rv-viewport edge-fade" id="rvViewport">
      <div class="rv-track" id="rvTrack">

          @foreach($testi as $list)
        <!-- Card 1 -->
        <article class="rv-card">
          <img class="rv-avatar" src="{{asset('backend/testimonial/'.$list->images)}}" alt="">
          <h4 class="rv-name">{{$list->name}}</h4>
          <span class="rv-role">{{$list->desg}} · {{$setting->title}}</span>

             {!! \Illuminate\Support\Str::limit(strip_tags($list->description), 118) !!}

                        @if (strlen(strip_tags($list->description)) > 118)
                        <button  class="designation" href="#" onclick="openmodel('{{$list->description}}')">Read More</button>
                        @endif
          
          <div class="rv-stars">
               
                        @for ($i = 0; $i < $list->rating; $i++)
                                            <i class="fas fa-star"></i>
                                            @endfor
                    
          </div>
        </article>
        @endforeach
      </div>
    </div>

    <!-- Arrows -->
    <button class="rv-arrow rv-prev" type="button" aria-label="Previous">&#10094;</button>
    <button class="rv-arrow rv-next" type="button" aria-label="Next">&#10095;</button>
  </div>
</section>

<style>
/* --- Big slider styles --- */
.rv-section{ padding:56px 0; background:#f6f9fc;}
.rv-title{ font-size:24px; font-weight:800; color:#0f172a; margin-bottom:18px;}

.rv-viewport{
  overflow-x:auto; overflow-y:visible;
  scroll-snap-type:x mandatory;
  -webkit-overflow-scrolling:touch;
  padding-bottom:8px;
}
.rv-track{
  display:flex; gap:20px; padding:6px 8px;
  transform: translateX(-12px); /* peek from outside */
}

.rv-card{
  flex:0 0 clamp(280px, 55vw, 520px);
  scroll-snap-align:center;
  background:#fff;
  border-radius:20px;
  box-shadow:0 10px 30px rgba(2,6,23,.08);
  padding:28px 22px;
  text-align:center;
  border:1px solid rgba(2,6,23,.06);
}
.rv-avatar{
  width:96px; height:96px; border-radius:50%;
  object-fit:cover; display:block; margin:0 auto 14px auto;
  box-shadow:0 0 0 6px #fff, 0 6px 18px rgba(15,23,42,.15);
}
.rv-name{ margin:0; font-size:22px; font-weight:800; color:#0f172a;}
.rv-role{ display:block; color:#64748b; font-size:14px; margin-top:4px;}
.rv-text{ color:#334155; font-size:16px; line-height:1.8; margin:12px 0 10px;}
.rv-stars{ color:#f59e0b; letter-spacing:2px; font-size:18px;}
.edge-fade{
  -webkit-mask-image: linear-gradient(90deg, transparent 0, #000 28px, #000 calc(100% - 28px), transparent 100%);
  mask-image: linear-gradient(90deg, transparent 0, #000 28px, #000 calc(100% - 28px), transparent 100%);
}
.rv-arrow{
  position:absolute; top:50%; transform:translateY(-50%);
  width:42px; height:42px; border-radius:999px; border:0;
  background:#fff; box-shadow:0 8px 20px rgba(2,6,23,.12);
  color:#0f172a; font-size:20px; line-height:42px; text-align:center;
  z-index:2;
}
.rv-prev{ left:-6px; }
.rv-next{ right:-6px; }
.rv-arrow:active{ transform:translateY(-50%) scale(.98); }
@media (max-width: 768px){
  .rv-card{ flex-basis: 86vw; }
  .rv-prev{ left:2px;} .rv-next{ right:2px;}
}
</style>


<script>
/* --- Testimonial slider with autoplay + pause on interaction --- */
(function(){
  const viewport = document.getElementById('rvViewport');
  const track    = document.getElementById('rvTrack');
  const prevBtn  = document.querySelector('.rv-prev');
  const nextBtn  = document.querySelector('.rv-next');
  if(!viewport || !track) return;

  const cards  = Array.from(track.querySelectorAll('.rv-card'));
  const OFFSET = 12;                 // matches your translateX(-12px)
  if (cards.length <= 1) return;     // nothing to autoplay

  // find the nearest card to the current scrollLeft
  function nearestIndex(){
    const left = viewport.scrollLeft;
    let idx = 0, min = Infinity;
    cards.forEach((card, i) => {
      const x = card.offsetLeft - OFFSET;
      const d = Math.abs(left - x);
      if (d < min) { min = d; idx = i; }
    });
    return idx;
  }

  function scrollToIndex(i, instant = false){
    i = (i + cards.length) % cards.length; // loop
    activeIndex = i;
    const target = cards[i].offsetLeft - OFFSET;
    viewport.scrollTo({ left: target, behavior: instant ? 'auto' : 'smooth' });
  }

  // Buttons
  prevBtn?.addEventListener('click', () => { pauseThenResume(); scrollToIndex(activeIndex - 1); });
  nextBtn?.addEventListener('click', () => { pauseThenResume(); scrollToIndex(activeIndex + 1); });

  // Autoplay
  const AUTO_MS = 3500;
  let autoTimer = null;
  let activeIndex = nearestIndex();

  function tick(){
    scrollToIndex(activeIndex + 1);
    startAuto(AUTO_MS);
  }

  function startAuto(delay = AUTO_MS){
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    clearTimeout(autoTimer);
    autoTimer = setTimeout(tick, delay);
  }

  function stopAuto(){
    clearTimeout(autoTimer);
  }

  // Pause on user interaction; resume after a short delay
  function pauseThenResume(){
    stopAuto();
    startAuto(3000); // resume after 3s
  }

  ['mouseenter','focusin','pointerdown','touchstart'].forEach(ev => {
    viewport.addEventListener(ev, stopAuto, {passive:true});
  });
  ['mouseleave','focusout','pointerup','touchend','touchcancel'].forEach(ev => {
    viewport.addEventListener(ev, () => startAuto(1500), {passive:true});
  });

  // Pause when tab is hidden
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) stopAuto(); else startAuto(1500);
  });

  // Kick off
  startAuto(2000);
})();
</script>
