
<style>
:root{
  --brand:#19a463;
  --brand-700:#118451;
  --ink:#0d1b1a;
  --muted:#cfe7dc;
  --card:#0b0f10;
}
*{box-sizing:border-box}
html,body{margin:0;background:#f5f7fa;font:500 15px/1.7 'Inter',system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:#fff}

.wrap{max-width:680px;margin:0 auto;padding:18px 14px}
.card{
  position:relative;border-radius:18px;overflow:hidden;min-height:320px;
  box-shadow:0 12px 30px rgba(0,0,0,.14);
  background:#0a0d0f;
}
.bg{
  position:absolute;inset:0;
  background:url('https://images.unsplash.com/photo-1492175742197-ed20dc5a6bed?q=80&w=1400&auto=format&fit=crop') center/cover no-repeat;
  filter:grayscale(.2) brightness(.65);
}
.tint{position:absolute;inset:0;background:linear-gradient(180deg, rgba(0,0,0,.35), rgba(0,0,0,.55));}

.content{position:relative;z-index:2;padding:24px 18px 20px}
.h1{margin:0 0 6px;font:800 22px/1.25 'Inter'}
.lead{margin:0 0 16px;color:var(--muted)}

/* Progress bar */
.progress{
  --value:0; /* 0..100 */
  position:relative;height:10px;border-radius:999px;
  background:rgba(255,255,255,.2);overflow:hidden;
  box-shadow:inset 0 0 0 1px rgba(255,255,255,.15);
}
.progress > i{
  position:absolute;inset:0;display:block;
  background:linear-gradient(90deg,#2cd97d,#19a463);
  transform:translateX(calc(var(--value) * 1% - 100%));
}
/* thumb */
.thumb{
  --left:0%;
  position:absolute;top:50%;left:var(--left);translate:-50% -50%;
  width:14px;height:14px;border-radius:50%;background:#fff;border:2px solid var(--brand);
  box-shadow:0 2px 8px rgba(0,0,0,.25);
}
.badge{
  position:absolute;top:-34px;left:50%;translate:-50% 0;
  background:var(--brand);color:#fff;font-weight:800;font-size:12px;
  padding:4px 8px;border-radius:8px;white-space:nowrap;box-shadow:0 4px 16px rgba(25,164,99,.35);
}

/* meta line */
.meta{display:flex;justify-content:space-between;color:#e8fff3;font-weight:800;font-size:13px;margin:8px 2px 14px}

/* CTA */
.cta{display:inline-flex;align-items:center;gap:12px;text-decoration:none;color:#0e2e20;
  background:#fff;padding:12px 16px;border-radius:999px;font-weight:800;
  box-shadow:0 12px 28px rgba(16,75,52,.28);
}
.cta .circle{width:32px;height:32px;border-radius:999px;background:var(--brand);
  display:grid;place-items:center;color:#fff}
.cta .circle svg{width:16px;height:16px}
.cta:hover .circle{background:var(--brand-700)}

@media(min-width:480px){
 .content{padding:28px 24px}
 .h1{font-size:26px}
}
</style>
</head>
<body>
<section class="wrap">
  <div class="card" data-raised="17280" data-goal="28000">
    <div class="bg" aria-hidden="true"></div>
    <div class="tint" aria-hidden="true"></div>

    <div class="content">
      <h2 class="h1">Send A Gift For Children’s</h2>
      <p class="lead">Dicta sunt explicabo nemo enim ipsam voluptatem quia voluptas.</p>

      <div style="position:relative;margin-bottom:4px">
        <div class="progress" id="bar"><i></i></div>
        <div class="thumb" id="thumb"><span class="badge" id="pc">0%</span></div>
      </div>
      <div class="meta">
        <span>Raised: <span id="raised">$0</span></span>
        <span>Goal: <span id="goal">$0</span></span>
      </div>

      <a href="#" class="cta">
        <span class="circle">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </span>
        Donate Now
      </a>
    </div>
  </div>
</section>

<script>
(function(){
  const card = document.querySelector('.card');
  const raised = Number(card.dataset.raised||0);
  const goal = Number(card.dataset.goal||1);
  const percent = Math.min(100, Math.max(0, (raised/goal)*100));
  const bar = document.getElementById('bar');
  const thumb = document.getElementById('thumb');
  const pc = document.getElementById('pc');
  const fmt = v => '$' + v.toLocaleString('en-US');

  document.getElementById('raised').textContent = fmt(raised);
  document.getElementById('goal').textContent = fmt(goal);

  // Animate progress
  let cur = 0;
  const step = ()=>{
    cur += (percent - cur) * 0.15;
    bar.style.setProperty('--value', cur);
    thumb.style.setProperty('--left', cur + '%');
    pc.textContent = (cur).toFixed(2) + '%';
    if (Math.abs(cur - percent) > 0.2) requestAnimationFrame(step);
    else{
      bar.style.setProperty('--value', percent);
      thumb.style.setProperty('--left', percent + '%');
      pc.textContent = percent.toFixed(2) + '%';
    }
  };
  requestAnimationFrame(step);
})();
</script>
