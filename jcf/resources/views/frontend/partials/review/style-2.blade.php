<section class="rt-pro-section">
  <div class="container">
    <h3 class="rv-title">Our Happy Supporters</h3>

    <div class="rt-pro" data-speed="90">
      <div class="rtp-track">
        <!-- Card -->
        <div class="rtp-card">
          <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?w=200&q=80" alt="">
          <div class="rtp-body">
            <h5 class="rtp-name">विवेक मिश्रा</h5>
            <div class="rtp-stars">★★★★★</div>
            <p class="rtp-msg">“दान प्रक्रिया बहुत आसान और भरोसेमंद है।”</p>
          </div>
        </div>

        <div class="rtp-card">
          <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&q=80" alt="">
          <div class="rtp-body">
            <h5 class="rtp-name">Sana</h5>
            <div class="rtp-stars">★★★★☆</div>
            <p class="rtp-msg">“महिला शिक्षा की दिशा में शानदार पहल।”</p>
          </div>
        </div>

        <div class="rtp-card">
          <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?w=200&q=80" alt="">
          <div class="rtp-body">
            <h5 class="rtp-name">Rahul</h5>
            <div class="rtp-stars">★★★★★</div>
            <p class="rtp-msg">“बच्चों के लिए चलाए गए कैम्प लाजवाब हैं।”</p>
          </div>
        </div>

        <!-- Duplicate more rtp-card items as needed -->
      </div>
    </div>
  </div>
</section>

<style>
/* --- Rectangular ticker with stars --- */
.rt-pro-section{ padding:40px 0; background:#f9fafb;}
.rt-pro{
  position:relative; overflow:hidden; border-radius:16px;
  background:#fff; box-shadow:0 8px 30px rgba(15,23,42,0.08);
  transform:translateX(-10px);
  -webkit-mask-image:linear-gradient(90deg,transparent 0,#000 40px,#000 calc(100% - 40px),transparent 100%);
  mask-image:linear-gradient(90deg,transparent 0,#000 40px,#000 calc(100% - 40px),transparent 100%);
}
.rtp-track{
  display:flex; gap:20px; padding:20px;
  animation:tickerMove var(--rtp-dur,40s) linear infinite;
  will-change: transform;
}
.rtp-card{
  display:flex; align-items:center; gap:16px;
  background:#f8fafc; border:1px solid rgba(15,23,42,0.08);
  border-radius:14px; padding:14px 18px;
  min-width:320px; max-width:460px; flex-shrink:0;
  box-shadow:0 2px 12px rgba(0,0,0,0.06);
}
.rtp-card img{ width:64px; height:64px; border-radius:12px; object-fit:cover;}
.rtp-body{ display:flex; flex-direction:column; gap:4px; }
.rtp-name{ margin:0; font-size:16px; font-weight:800; color:#0f172a; }
.rtp-stars{ color:#f59e0b; font-size:15px; letter-spacing:1px; line-height:1; }
.rtp-msg{ margin:2px 0 0; font-size:14px; color:#475569; line-height:1.5; }

.rt-pro:hover .rtp-track{ animation-play-state:paused;}
@keyframes tickerMove{ from{transform:translateX(-50%);} to{transform:translateX(0);} }

@media (max-width:768px){
  .rtp-card{ min-width:270px; }
  .rtp-card img{ width:56px; height:56px; }
}
</style>

<script>
/* --- Clone & speed calculation for infinite ticker --- */
(function(){
  const wrap=document.querySelector('.rt-pro');
  if(!wrap) return;
  const track=wrap.querySelector('.rtp-track');
  const speed=parseFloat(wrap.dataset.speed)||90;

  const original=Array.from(track.children);
  const before=track.scrollWidth;
  track.append(...original.map(n=>n.cloneNode(true)));
  if(track.scrollWidth<before*2) track.append(...original.map(n=>n.cloneNode(true)));

  const distance=track.scrollWidth/2; // -50% -> 0
  track.style.setProperty('--rtp-dur', `${distance/speed}s`);
})();
</script>
