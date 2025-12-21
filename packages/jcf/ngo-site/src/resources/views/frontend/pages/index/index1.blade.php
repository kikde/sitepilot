
@extends('layouts.master')

<!-- MINIFIED -->

@section('content')

{!! SEO::generate(true) !!}
  
   @include ("frontend.partials.ticker.style-2")
   @include ("frontend.partials.banner.style-1") 
   
  @include ("frontend.partials.message.presidentmessage")
  @include ("frontend.partials.ticker.style-1")
   @include ("frontend.partials.ticker.style-4") <!--Frams Ticker-->
   {{--@include ("frontend.partials.about.style-4") 
    <!--SocialPost-->
  @include ("frontend.partials.socialpost.style-7")--}}

  @include('frontend.partials.join.join-2')
  @include('frontend.partials.join.join-3')

  @include ("frontend.partials.crowdfunding.style-1")
  
  {{--@include('frontend.partials.story.style-1')--}}
  @include('frontend.partials.youtube.style-11')
  @include ("frontend.partials.blog.style-1")
 
  <!-- Breaking News  -->
  @include ("frontend.partials.breakingnews.style-1")
  @include ("frontend.partials.breakingnews.style-2")
  @include ("frontend.partials.breakingnews.style-3")
 {{-- @include ("frontend.partials.breakingnews.style-4")--}}
  <!-- Management team -->
  @include('frontend.partials.team.style-1')
  @include('frontend.partials.team.style-2')
  {{--@include('frontend.partials.team.style-4')--}} <!--Frams Management Team-->
  <!-- Management team -->
   
   
   @include ("frontend.partials.review.style-1") 
 
   <!-- Members -->
        @include('frontend.partials.volunteers.style-1')
    {{--@include('frontend.partials.volunteers.style-2')--}}  <!--Frams view-->


    @include ("frontend.partials.ads.style-7")
    @include ("frontend.partials.ads.style-8")
    
    @include('frontend.partials.forms.donation.style-3')




@endsection

<script>
  (function(){
    const tickers = document.querySelectorAll('.rt-ticker');

    tickers.forEach(ticker => {
      const track = ticker.querySelector('.rt-track');
      if(!track) return;

      // Clone content to make a seamless loop
      const original = Array.from(track.children);
      const trackWidthBefore = track.scrollWidth;

      // Duplicate once; if still short, duplicate again
      track.append(...original.map(n => n.cloneNode(true)));
      if (track.scrollWidth < trackWidthBefore * 2) {
        track.append(...original.map(n => n.cloneNode(true)));
      }

      // Compute duration from real pixel width and speed
      // Speed is px per second (data-speed), default 90
      const speed = parseFloat(ticker.dataset.speed) || 90;
      const totalWidth = track.scrollWidth;    // after cloning
      // We animate -50% -> 0, so travel distance is half the width
      const distancePx = totalWidth / 2;
      const durationSec = distancePx / speed;

      track.style.setProperty('--rt-duration', `${durationSec}s`);

      // Optional: pause on hover via JS class (better mobile support)
      ticker.addEventListener('mouseenter', () => ticker.classList.add('is-paused'));
      ticker.addEventListener('mouseleave', () => ticker.classList.remove('is-paused'));

      // Recalculate on resize (debounced)
      let t;
      window.addEventListener('resize', () => {
        clearTimeout(t);
        t = setTimeout(() => {
          const w = track.scrollWidth;
          const d = (w/2) / speed;
          track.style.setProperty('--rt-duration', `${d}s`);
        }, 150);
      });
    });
  })();
</script>


<script>
document.querySelectorAll('.gallery-item img').forEach(img=>{
  img.addEventListener('click',()=>{
    const overlay=document.createElement('div');
    overlay.style.cssText=`
      position:fixed;inset:0;background:rgba(0,0,0,.9);
      display:flex;align-items:center;justify-content:center;z-index:99999;
    `;
    const clone=document.createElement('img');
    clone.src=img.src;
    clone.style.cssText='max-width:90%;max-height:90%;border-radius:10px;box-shadow:0 0 40px rgba(0,0,0,.8)';
    overlay.appendChild(clone);
    overlay.addEventListener('click',()=>overlay.remove());
    document.body.appendChild(overlay);
  });
});
</script>
