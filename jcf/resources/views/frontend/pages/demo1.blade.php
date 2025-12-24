@extends('layouts.master')

{{-- {!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!}
<!-- OR with multi -->
{!! JsonLdMulti::generate() !!} --}}
<!-- OR -->
{{-- {!! SEO::generate() !!} --}}
<!-- MINIFIED -->
@section('content')
{!! SEO::generate(true) !!}
    
   
   <!-- President Message -->
    @include ("frontend.partials.message.presidentmessage")


 

{{--
@include ("frontend.partials.header.style-1")
@include ("frontend.partials.header.style-2")
@include ("frontend.partials.header.style-3")
@include ("frontend.partials.header.style-4")
@include ("frontend.partials.header.style-5")
@include ("frontend.partials.header.style-6")
@include ("frontend.partials.header.style-7")
@include ("frontend.partials.header.style-8")
@include ("frontend.partials.header.style-9")

@include ("frontend.partials.footer.style-1")
@include ("frontend.partials.footer.style-2")
  
@include ("frontend.partials.button.style-1")
@include ("frontend.partials.button.style-2")
@include ("frontend.partials.button.style-3")
@include ("frontend.partials.button.style-4")



 




 


@include ("frontend.partials.section.style-1")
@include ("frontend.partials.section.style-2")
@include ("frontend.partials.section.style-3")
@include ("frontend.partials.section.style-4")
@include ("frontend.partials.section.style-5")
@include ("frontend.partials.section.style-6")
@include ("frontend.partials.section.style-7")
@include ("frontend.partials.section.style-8")
@include ("frontend.partials.section.style-9")
@include ("frontend.partials.section.style-10")
@include ("frontend.partials.section.style-11")
@include ("frontend.partials.section.style-12")
@include ("frontend.partials.section.style-13")
@include ("frontend.partials.section.style-14")
@include ("frontend.partials.section.style-15")
@include ("frontend.partials.section.style-16")
@include ("frontend.partials.section.style-17")
@include ("frontend.partials.section.style-18")
@include ("frontend.partials.section.style-19")
@include ("frontend.partials.section.style-20")
@include ("frontend.partials.section.style-21")
@include ("frontend.partials.section.style-22")
@include ("frontend.partials.section.style-23")
@include ("frontend.partials.section.style-24")
@include ("frontend.partials.section.style-25")
@include ("frontend.partials.section.style-26")
@include ("frontend.partials.section.style-27")
@include ("frontend.partials.section.style-28")
@include ("frontend.partials.section.style-29")
@include ("frontend.partials.section.style-30")
@include ("frontend.partials.section.style-31")
@include ("frontend.partials.section.style-32")



--}}


@if(false)

<!-- Logo With Header -->


<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;------------- Header Style --------------&gt;
</h6>
    @include ("frontend.partials.header.fancyheader")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;------------- Ticker Style --------------&gt;
</h6>
<!-- Latest Activity Ticker -->
@include ("frontend.partials.ticker.style-1")  
@include ("frontend.partials.ticker.style-2")
@include ("frontend.partials.ticker.style-3")
@include ("frontend.partials.ticker.style-4")
@include ("frontend.partials.ticker.style-5")
@include ("frontend.partials.ticker.style-6")
@include ("frontend.partials.ticker.style-7")
@include ("frontend.partials.ticker.style-8")
@include ("frontend.partials.ticker.style-9")
@include ("frontend.partials.ticker.style-10")
@include ("frontend.partials.ticker.style-11")
@include ("frontend.partials.ticker.style-12")
@include ("frontend.partials.ticker.style-13")
@include ("frontend.partials.ticker.style-14")
@include ("frontend.partials.ticker.style-15")
@include ("frontend.partials.ticker.style-16")
@include ("frontend.partials.ticker.style-17")
@include ("frontend.partials.ticker.style-18")
@include ("frontend.partials.ticker.style-19")
@include ("frontend.partials.ticker.style-20")
@include ("frontend.partials.ticker.style-21")
@include ("frontend.partials.ticker.style-22")
@include ("frontend.partials.ticker.style-23")
@include ("frontend.partials.ticker.style-24")
@include ("frontend.partials.ticker.style-25")
@include ("frontend.partials.ticker.style-26")
@include ("frontend.partials.ticker.style-27")
@include ("frontend.partials.ticker.style-28")
@include ("frontend.partials.ticker.style-29")
@include ("frontend.partials.ticker.style-30")
@include ("frontend.partials.ticker.style-31")
@include ("frontend.partials.ticker.style-32")
@include ("frontend.partials.ticker.style-33")
@include ("frontend.partials.ticker.style-34")
@include ("frontend.partials.ticker.style-35")
@include ("frontend.partials.ticker.style-36")
@include ("frontend.partials.ticker.style-37")
@include ("frontend.partials.ticker.style-38")
@include ("frontend.partials.ticker.style-39")
@include ("frontend.partials.ticker.style-40")




<!-- Ticker with Clickable Service Name -->
    @include ("frontend.partials.ticker.style-2")
<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;------------- Banner Style --------------&gt;
</h6>
 <!-- Banner Style-->
    @include ("frontend.partials.banner.style-1")
    @include ("frontend.partials.banner.style-2")
    @include ("frontend.partials.banner.style-3")
    @include ("frontend.partials.banner.style-4")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;------------- youtube Style --------------&gt;
</h6>
<!-- youtubevideo-section -->
    @include('frontend.partials.youtube.style-1')
    @include('frontend.partials.youtube.style-2')
    @include('frontend.partials.youtube.style-3')
    @include('frontend.partials.youtube.style-4')
    @include ("frontend.partials.youtube.style-5")
    @include ("frontend.partials.youtube.style-6")
    @include ("frontend.partials.youtube.style-7")
    @include ("frontend.partials.youtube.style-8")
    @include ("frontend.partials.youtube.style-9")
    @include ("frontend.partials.youtube.style-10")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;------------- forms Style --------------&gt;
</h6>
<!-- forms-section -->
    @include('frontend.partials.forms.form-1')
    @include('frontend.partials.forms.form-2')
    @include('frontend.partials.forms.form-3')
    @include('frontend.partials.forms.form-4')
    @include('frontend.partials.forms.form-5')
    @include('frontend.partials.forms.form-6')
    @include('frontend.partials.forms.form-7')
    @include('frontend.partials.forms.form-8')
    @include('frontend.partials.forms.form-9')
<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Complaint Forms Style ----------&gt;
</h6>
@include('frontend.partials.forms.complaint-1')
@include('frontend.partials.forms.complaint-2')
@include('frontend.partials.forms.complaint-3')
@include('frontend.partials.forms.complaint-4')

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Donation Forms Style ----------&gt;
</h6>
@include('frontend.partials.forms.donate-1')
@include('frontend.partials.forms.donate-2')
@include('frontend.partials.forms.donate-3')




<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- President Style ----------&gt;
</h6>
 <!-- President Message -->
    @include ("frontend.partials.message.presidentmessage")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Management Style ----------&gt;
</h6>
<!-- Management Team -->
     @include('frontend.partials.team.style-1')
     @include('frontend.partials.team.style-2')
     @include('frontend.partials.team.style-3')


<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Gallery Style ----------&gt;
</h6>
<!-- Gallery Start -->
    @include('frontend.partials.gallery.style-1')
    @include('frontend.partials.gallery.style-2')
    @include('frontend.partials.gallery.style-3')
    @include('frontend.partials.gallery.style-4')
    @include('frontend.partials.gallery.style-5')
    @include('frontend.partials.gallery.style-6')
    @include('frontend.partials.gallery.style-7')

    <h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Events Style ----------&gt;
</h6>
<!-- Events  -->
     @include ("frontend.partials.events.style-1")
     @include ("frontend.partials.events.style-2")
     @include ("frontend.partials.events.style-3")
     @include ("frontend.partials.events.style-4")
     @include ("frontend.partials.events.style-5")
     @include ("frontend.partials.events.style-6")
     @include ("frontend.partials.events.style-7")
     @include ("frontend.partials.events.style-8")
     @include ("frontend.partials.events.style-9")
     @include ("frontend.partials.events.style-10")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- News Style ----------&gt;
</h6>
<!-- Breaking News  -->
    @include ("frontend.partials.breakingnews.style-1")
    @include ("frontend.partials.breakingnews.style-2")
    @include ("frontend.partials.breakingnews.style-3")
    @include ("frontend.partials.breakingnews.style-4")
    @include ("frontend.partials.breakingnews.style-5")
    @include ("frontend.partials.breakingnews.style-6")
    @include ("frontend.partials.breakingnews.style-7")
    @include ("frontend.partials.breakingnews.style-8")
    @include ("frontend.partials.breakingnews.style-9")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Reviews Style ----------&gt;
</h6>
<!-- Reviews Style -->

    @include ("frontend.partials.review.style-1")
    @include ("frontend.partials.review.style-2")
    @include ("frontend.partials.review.style-3")
    @include ("frontend.partials.review.style-4")
    @include ("frontend.partials.review.style-5")
    @include ("frontend.partials.review.style-6")
    @include ("frontend.partials.review.style-7")
    @include ("frontend.partials.review.style-8")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Ads Style ----------&gt;
</h6>
<!-- Ads start -->
    @include ("frontend.partials.ads.style-1")
    @include ("frontend.partials.ads.style-2")
    @include ("frontend.partials.ads.style-3")
    @include ("frontend.partials.ads.style-4")
    @include ("frontend.partials.ads.style-5")
    @include ("frontend.partials.ads.style-6")
    @include ("frontend.partials.ads.style-7")
    @include ("frontend.partials.ads.style-8")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Join Now Style ----------&gt;
</h6>
<!-- Join Now -->
    @include ("frontend.partials.join.join-1")
    @include ("frontend.partials.join.join-2")
    @include ("frontend.partials.join.join-3")
    @include ("frontend.partials.join.join-4")
    @include ("frontend.partials.join.join-5")
    @include ("frontend.partials.join.join-6")
    @include ("frontend.partials.join.join-7")

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Donate Now Style ----------&gt;
</h6>
<!-- Donate  -->
    @include ("frontend.partials.donate.style-1")
    @include ("frontend.partials.donate.style-2")
    @include ("frontend.partials.donate.style-3")
    @include ("frontend.partials.donate.style-4")
    @include ("frontend.partials.donate.style-5")
    @include ("frontend.partials.donate.style-6")
    @include ("frontend.partials.donate.style-7")
    @include ("frontend.partials.donate.style-8")
    @include ("frontend.partials.donate.style-9")
    @include ("frontend.partials.donate.style-10")
    @include ("frontend.partials.donate.style-11")
    @include ("frontend.partials.donate.style-12")
    @include ("frontend.partials.donate.style-13")
    @include ("frontend.partials.donate.style-14")
    @include ("frontend.partials.donate.style-15")
    @include ("frontend.partials.donate.style-16")
    @include ("frontend.partials.donate.style-18")
    @include ("frontend.partials.donate.style-19")
    @include ("frontend.partials.donate.style-20")
    @include ("frontend.partials.donate.style-21")
    @include ("frontend.partials.donate.style-22")
    @include ("frontend.partials.donate.style-23")
   

<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- CrowdFunding Style ----------&gt;
</h6>

<!-- CrowdFunding Payment Collection -->
    @include ("frontend.partials.crowdfunding.style-1")
    @include ("frontend.partials.crowdfunding.style-2")
    @include ("frontend.partials.crowdfunding.style-3")
    @include ("frontend.partials.crowdfunding.style-4")
    @include ("frontend.partials.crowdfunding.style-5")
    @include ("frontend.partials.crowdfunding.style-6")
    @include ("frontend.partials.crowdfunding.style-7")
    @include ("frontend.partials.crowdfunding.style-8")
    @include ('frontend.partials.crowdfunding.style-9')
    @include ('frontend.partials.crowdfunding.style-10')
    @include ('frontend.partials.crowdfunding.style-11')
    @include ('frontend.partials.crowdfunding.style-12') 
    @include('frontend.partials.crowdfunding.style-13')
    @include('frontend.partials.crowdfunding.style-14')
    @include('frontend.partials.crowdfunding.style-15')
    @include('frontend.partials.crowdfunding.style-16')
    @include('frontend.partials.crowdfunding.style-17')
    @include('frontend.partials.crowdfunding.style-18')
    @include('frontend.partials.crowdfunding.style-19')


<h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- SocialPost Style ----------&gt;
</h6>
<!-- SocialPost -->

    @include ("frontend.partials.socialpost.style-1")
    @include ("frontend.partials.socialpost.style-2")
    @include ("frontend.partials.socialpost.style-3")
    @include ("frontend.partials.socialpost.style-4")
    @include ("frontend.partials.socialpost.style-5")
    @include ("frontend.partials.socialpost.style-6")

    <h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Our partners Style ----------&gt;
</h6>
<!-- Ourpartners-section -->
@include('frontend.partials.partners.style-1')

    <h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Awards Style ----------&gt;
</h6>
<!-- Awards-section -->
@include('frontend.partials.awards.style-1')

    <h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Recent Story ----------&gt;
</h6>
@include('frontend.partials.story.style-1')
   <h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- Blog  ----------&gt;
</h6>
@include('frontend.partials.blog.style-1')
@include('frontend.partials.blog.style-2')


   <h6 style="margin:8px 0;text-align:center;font-weight:600;font-size:clamp(12px,4vw,14px);line-height:1.3;color:#0f172a;">
  &lt;--------- volunteers Style  ----------&gt;
</h6>
@include('frontend.partials.volunteers.style-1')
@include('frontend.partials.volunteers.style-2')
@include('frontend.partials.volunteers.style-3')
@include('frontend.partials.volunteers.style-4')

<!-- --------------------------------------------------- mission Style ---------------------------------------------------->
 @include ("frontend.partials.mission.style-1")
 @include ("frontend.partials.mission.style-2")


@endif













{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script> --}}


<script>
    document.addEventListener("DOMContentLoaded", () => {
        function counter(id, start, end, duration) {
            let obj = document.getElementById(id),
                current = start,
                range = end - start,
                increment = end > start ? 1 : -1,
                step = Math.abs(Math.floor(duration / range)),
                timer = setInterval(() => {
                    current += increment;
                    obj.textContent = current;
                    if (current == end) {
                        clearInterval(timer);
                    }
                }, step);
        }
        var countx1 = document.getElementById('count1').innerHTML;
        var countx2 = document.getElementById('count2').innerHTML;
        var countx3 = document.getElementById('count3').innerHTML;
        var countx4 = document.getElementById('count4').innerHTML;
        console.log(countx4);


        counter("count1", 0, countx1, 3000);
        counter("count2", 0, countx2, 2500);
        counter("count3", 0, countx3, 3000);
        counter("count4", 0, countx4, 3000);
    });
</script>
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
