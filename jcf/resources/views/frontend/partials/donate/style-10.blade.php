
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Donation Cards – Mobile Slider</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --ink:#0f172a; --muted:#475569; --line:#e5e7eb; --card:#fff;
  --brand:#f2545b; --accent:#2ec27e; --amber:#f7b500;
}
*{box-sizing:border-box}
body{margin:0;background:#f6f7fb;font:500 15px/1.55 'Inter',system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:var(--ink)}

/* Section */
.wrap{max-width:520px;margin:0 auto;padding:14px}
.h1{font:800 22px/1.2 'Inter',system-ui;letter-spacing:.01em;margin:8px 4px 12px}

/* Slider */
.slider{position:relative;overflow:hidden}
.track{
  display:flex; gap:14px; padding:4px; scroll-behavior:smooth;
  overflow-x:auto; scrollbar-width:none; -ms-overflow-style:none;
  touch-action:pan-y; scroll-snap-type:x mandatory;
}
.track::-webkit-scrollbar{display:none}
.slide{flex:0 0 86%; scroll-snap-align:center}
@media (min-width:420px){ .slide{flex-basis:78%} }

/* Card */
.card{
  background:var(--card); border-radius:14px; overflow:hidden;
  box-shadow:0 12px 30px rgba(16,24,40,.08), 0 1px 0 rgba(16,24,40,.06);
  border:1px solid #f1f3f6;
}
.figure{position:relative; aspect-ratio: 16/10; background:#ddd center/cover no-repeat;}
.badge{
  position:absolute; left:10px; top:10px; background:#2bb673; color:#fff;
  padding:6px 10px; border-radius:20px; font-weight:800; font-size:12px;
  box-shadow:0 8px 18px rgba(0,0,0,.18);
}
.icons{
  position:absolute; right:10px; top:10px; display:flex; gap:6px; align-items:center;
  background:rgba(255,255,255,.9); color:#1f2937; padding:6px 8px; border-radius:10px; font-size:12px; font-weight:700;
}
.icons span{display:inline-flex; align-items:center; gap:4px}
.icons .dot{width:18px;height:18px;border-radius:4px;background:#ecf1ff;display:inline-grid;place-items:center;font-size:12px}

/* Divider with knob */
.divider{
  position:relative; height:14px; background:linear-gradient(90deg,#f4d0cc 0 40%,#ffeec2 40% 75%,#d7f7e8 75% 100%);
}
.knob{
  position:absolute; right:8%; top:-7px; width:14px; height:14px; background:#ff6b57;
  border-radius:14px; border:3px solid #fff; box-shadow:0 4px 10px rgba(0,0,0,.15);
}

/* Stats */
.stats{display:flex; text-align:center; gap:8px; padding:10px 12px}
.stat{flex:1}
.stat small{display:block; color:#6b7280; font-weight:700; letter-spacing:.04em}
.stat b{display:block; margin-top:4px}
.stat .raised{color:#d54b56}
.stat .goal{color:#10b981}
.stat .pct{color:#b7791f}

/* Content */
.body{padding:0 12px 14px}
.title{font:800 17px/1.35 'Inter',system-ui;margin:6px 0 6px}
.desc{color:#6b7280; margin:0 0 10px}
.btn{
  display:inline-flex; align-items:center; gap:8px; font-weight:800; font-size:14px;
  color:var(--brand); text-decoration:none;
}
.btn:active{opacity:.8}

/* Dots */
.dots{display:flex; justify-content:center; gap:6px; margin:10px 0 2px}
.dot{width:7px;height:7px;border-radius:7px;background:#dfe5ef}
.dot.is-active{background:#1e293b}
</style>
</head>
<body>

<section class="wrap" aria-label="Donation Stories">
  <h2 class="h1">Featured Causes</h2>

  <div class="slider" id="slider">
    <div class="track" id="track">

      <!-- Slide 1 -->
      <article class="slide">
        <div class="card">
          <div class="figure" style="background-image:url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1400&auto=format&fit=crop');">
            <span class="badge">Water Charity</span>
            <div class="icons"><span class="dot">🎥</span><span class="dot">🖼️</span><span class="dot">3</span></div>
          </div>
          <div class="divider"><span class="knob"></span></div>
          <div class="stats">
            <div class="stat"><small>RAISED</small><b class="raised">$18,265</b></div>
            <div class="stat"><small>&nbsp;</small><b class="pct">121.8%</b></div>
            <div class="stat"><small>GOAL</small><b class="goal">$15,000</b></div>
          </div>
          <hr style="border:0;border-top:1px solid var(--line);margin:4px 12px 8px;opacity:.7">
          <div class="body">
            <div class="title">Give African Childrens a good Education &amp; Healthy</div>
            <p class="desc">Lorem ipsum dolor sit amet, consectetur eiusmod tempor incididunt.</p>
            <a class="btn" href="#">Donate Now ↗</a>
          </div>
        </div>
      </article>

      <!-- Slide 2 -->
      <article class="slide">
        <div class="card">
          <div class="figure" style="background-image:url('https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=1400&auto=format&fit=crop');">
            <span class="badge" style="background:#0ea5e9">Medical Health</span>
            <div class="icons"><span class="dot">🎥</span><span class="dot">🖼️</span><span class="dot">3</span></div>
          </div>
          <div class="divider"><span class="knob" style="right:12%"></span></div>
          <div class="stats">
            <div class="stat"><small>RAISED</small><b class="raised">$17,810</b></div>
            <div class="stat"><small>&nbsp;</small><b class="pct">111.3%</b></div>
            <div class="stat"><small>GOAL</small><b class="goal">$16,000</b></div>
          </div>
          <hr style="border:0;border-top:1px solid var(--line);margin:4px 12px 8px;opacity:.7">
          <div class="body">
            <div class="title">Raise funds for children’s clean &amp; healthy food</div>
            <p class="desc">Lorem ipsum dolor sit amet, consectetur eiusmod tempor incididunt.</p>
            <a class="btn" href="#">Donate Now ↗</a>
          </div>
        </div>
      </article>

      <!-- Slide 3 (extra example) -->
      <article class="slide">
        <div class="card">
          <div class="figure" style="background-image:url('https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1400&auto=format&fit=crop');">
            <span class="badge" style="background:#f97316">Education</span>
            <div class="icons"><span class="dot">🎥</span><span class="dot">🖼️</span><span class="dot">5</span></div>
          </div>
          <div class="divider"><span class="knob" style="right:30%"></span></div>
          <div class="stats">
            <div class="stat"><small>RAISED</small><b class="raised">$9,240</b></div>
            <div class="stat"><small>&nbsp;</small><b class="pct">61.6%</b></div>
            <div class="stat"><small>GOAL</small><b class="goal">$15,000</b></div>
          </div>
          <hr style="border:0;border-top:1px solid var(--line);margin:4px 12px 8px;opacity:.7">
          <div class="body">
            <div class="title">Equip rural schools with safe water</div>
            <p class="desc">Help us deliver purifiers and hygiene education to 30 villages.</p>
            <a class="btn" href="#">Donate Now ↗</a>
          </div>
        </div>
      </article>

    </div>

    <div class="dots" id="dots"></div>
  </div>
</section>

<script>
(function(){
  const track = document.getElementById('track');
  const dots  = document.getElementById('dots');
  const slides = Array.from(track.children);
  // Build dots
  slides.forEach((_,i)=>{
    const d=document.createElement('span');
    d.className='dot'+(i===0?' is-active':'');
    dots.appendChild(d);
  });

  function activeIndex(){
    const w = track.getBoundingClientRect().width;
    const sc = track.scrollLeft;
    const idx = Math.round(sc / (slides[0].getBoundingClientRect().width + 14));
    return Math.max(0, Math.min(slides.length-1, idx));
  }
  function updateDots(){
    const idx = activeIndex();
    [...dots.children].forEach((d,i)=>d.classList.toggle('is-active', i===idx));
  }
  track.addEventListener('scroll', ()=>{ requestAnimationFrame(updateDots); });

  // Autoplay (pause on touch)
  let autoscroll = setInterval(()=>{
    const next = (activeIndex()+1) % slides.length;
    const cardW = slides[0].getBoundingClientRect().width + 14;
    track.scrollTo({left: next*cardW, behavior:'smooth'});
  }, 3500);

  ['touchstart','mouseenter'].forEach(e=>track.addEventListener(e,()=>clearInterval(autoscroll),{passive:true}));
  ['touchend','mouseleave'].forEach(e=>track.addEventListener(e,()=>{
    autoscroll = setInterval(()=>{
      const next = (activeIndex()+1) % slides.length;
      const cardW = slides[0].getBoundingClientRect().width + 14;
      track.scrollTo({left: next*cardW, behavior:'smooth'});
    }, 3500);
  },{passive:true}));

  // Swipe-friendly (native scrolling enabled)
})();
</script>

</body>
</html>