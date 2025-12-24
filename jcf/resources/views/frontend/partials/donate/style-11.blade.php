<style>
:root{
  --ink:#0f172a;
  --muted:#64748b;
  --brand:#ff6a00;
  --brand2:#ff2a2a;
  --green:#10b981;
  --blue:#2563eb;
}
*{box-sizing:border-box}
body{margin:0;background:#f6f8fb;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:var(--ink)}
.grid{display:grid;grid-template-columns:1fr;gap:16px;padding:16px;max-width:1100px;margin:0 auto}
h3{margin:.6rem 0 .25rem;font-size:18px}
p{margin:0;color:var(--muted);line-height:1.45}
.btn{
  display:inline-flex;align-items:center;gap:10px;
  padding:12px 18px;border-radius:999px;border:none;cursor:pointer;
  font-weight:900;text-transform:capitalize;letter-spacing:.2px;color:#fff;
  transition:transform .08s ease,filter .2s ease,box-shadow .2s ease;
}
.btn:active{transform:translateY(1px) scale(.98)}
.badge{display:inline-flex;align-items:center;gap:8px;padding:6px 10px;border-radius:999px;font-size:12px;font-weight:800}

/* Placeholder image (data‑URI SVG) */
.card img{width:100%;height:180px;object-fit:cover;border-radius:14px}
.ph{background:#e2e8f0;border-radius:14px;overflow:hidden}
/* common card base */
.card{
  background:#fff;border:1px solid #eef2f7;border-radius:18px;padding:14px;
  box-shadow:0 10px 18px rgba(2,6,23,.06);position:relative
}
.footer{display:flex;align-items:center;justify-content:space-between;margin-top:12px}
.progress{height:8px;background:#eef2f7;border-radius:999px;overflow:hidden}
.progress>span{display:block;height:100%;background:linear-gradient(90deg,#34d399,#10b981)}
.meta{display:flex;gap:8px;align-items:center;color:#475569;font-size:12px}

/* ========== Style A — Soft card with pill button (closest to sample) */
.card.a .btn{background:linear-gradient(90deg,#ff8a00,#ff5a00)}
.card.a .btn .r{width:0;height:0;border-left:12px solid #fff;border-top:7px solid transparent;border-bottom:7px solid transparent}

/* ========== Style B — Gradient border & floating badge */
.card.b{background:linear-gradient(#fff,#fff) padding-box,linear-gradient(135deg,#22d3ee,#a78bfa) border-box;border:2px solid transparent}
.card.b .badge{background:#ecfeff;color:#155e75;border:1px solid #a5f3fc}
.card.b .btn{background:linear-gradient(90deg,#22d3ee,#3b82f6)}

/* ========== Style C — Overlap image + ribbon */
.card.c{padding:0 0 14px 0;overflow:hidden}
.card.c .hero{position:relative}
.card.c .hero img{border-radius:0}
.ribbon{position:absolute;left:14px;top:14px;background:#ef4444;color:#fff;padding:6px 10px;border-radius:8px;font-weight:800}
.card.c .body{padding:0 14px}
.card.c .btn{background:linear-gradient(90deg,#ef4444,#f97316)}

/* ========== Style D — Glassy overlay button on image */
.card.d{padding:0;overflow:hidden}
.card.d .hero{position:relative}
.card.d .glass{
  position:absolute;left:12px;right:12px;bottom:12px;
  backdrop-filter:blur(6px);background:rgba(255,255,255,.6);border:1px solid rgba(255,255,255,.9);
  border-radius:14px;padding:10px;display:flex;align-items:center;justify-content:space-between
}
.card.d .glass .btn{background:linear-gradient(90deg,#22c55e,#16a34a)}
.card.d .hero img{height:220px}

/* ========== Style E — Accent bar + two buttons */
.card.e{border-radius:18px}
.card.e:before{content:"";position:absolute;left:0;top:0;right:0;height:6px;background:linear-gradient(90deg,#16a34a,#22c55e,#06b6d4);border-top-left-radius:18px;border-top-right-radius:18px}
.card.e .btn{background:linear-gradient(90deg,#0ea5e9,#2563eb)}
.card.e .btn.secondary{background:#f1f5f9;color:#0f172a;font-weight:800}

/* ========== Style F — Dark card + big CTA */
.card.f{background:#0b1220;color:#e2e8f0;border:1px solid #151b28}
.card.f p{color:#94a3b8}
.card.f .btn{background:linear-gradient(90deg,#f59e0b,#ef4444)}
.card.f .meta{color:#9aa5b1}

@media(min-width:720px){
  .grid{grid-template-columns:repeat(2,1fr)}
}
@media(min-width:1040px){
  .grid{grid-template-columns:repeat(3,1fr)}
}
</style>
</head>
<body>

<div class="grid">

  <!-- A -->
  <article class="card a">
    <div class="ph">
      <img alt="Education program" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='480'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop stop-color='%23ffe08a'/%3E%3Cstop offset='1' stop-color='%23ffba8a'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g)' width='100%25' height='100%25'/%3E%3Ctext x='50%25' y='52%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-weight='700' font-size='38' fill='%23555555'%3EEducation%3C/text%3E%3C/svg%3E" />
    </div>
    <h3>Education for All</h3>
    <p>Bridge the learning gap so every child can dream, grow, and thrive.</p>
    <div class="footer">
      <div class="meta">Raised <strong>$8,420</strong> of $12,000</div>
      <button class="btn">Donate Now <span class="r"></span></button>
    </div>
    <div class="progress" aria-hidden="true" style="margin-top:10px"><span style="width:70%"></span></div>
  </article>

  <!-- B -->
  <article class="card b">
    <div class="ph">
      <img alt="Clean Water" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='480'%3E%3Cdefs%3E%3ClinearGradient id='g2' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop stop-color='%23b3e5fc'/%3E%3Cstop offset='1' stop-color='%23dbeafe'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g2)' width='100%25' height='100%25'/%3E%3Ctext x='50%25' y='52%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-weight='700' font-size='38' fill='%23506375'%3EWater%3C/text%3E%3C/svg%3E" />
    </div>
    <div class="badge">New campaign</div>
    <h3>Clean Water Access</h3>
    <p>Install community wells and train local caretakers for long‑term impact.</p>
    <div class="footer">
      <div class="meta">57% funded</div>
      <button class="btn">Donate</button>
    </div>
  </article>

  <!-- C -->
  <article class="card c">
    <div class="hero">
      <img alt="Food Support" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='480'%3E%3Cdefs%3E%3ClinearGradient id='g3' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop stop-color='%23fde68a'/%3E%3Cstop offset='1' stop-color='%23fca5a5'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g3)' width='100%25' height='100%25'/%3E%3Ctext x='50%25' y='52%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-weight='700' font-size='38' fill='%23555555'%3EFood Aid%3C/text%3E%3C/svg%3E" />
      <span class="ribbon">Urgent</span>
    </div>
    <div class="body">
      <h3>Emergency Food Support</h3>
      <p>Provide nutritious meals to families affected by floods.</p>
      <div class="footer">
        <div class="meta">Goal: 15,000 meals</div>
        <button class="btn">Donate</button>
      </div>
    </div>
  </article>

  <!-- D -->
  <article class="card d">
    <div class="hero">
      <img alt="Girls Coding" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='520'%3E%3Cdefs%3E%3ClinearGradient id='g4' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop stop-color='%23c4b5fd'/%3E%3Cstop offset='1' stop-color='%2394a3b8'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g4)' width='100%25' height='100%25'/%3E%3Ctext x='50%25' y='52%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-weight='700' font-size='38' fill='%23506375'%3ECode%20Camp%3C/text%3E%3C/svg%3E" />
      <div class="glass">
        <div>
          <strong>Girls in Tech</strong><br>
          <small style="color:#334155">Scholarships for 200 students</small>
        </div>
        <button class="btn">Donate</button>
      </div>
    </div>
  </article>

  <!-- E -->
  <article class="card e">
    <div class="ph">
      <img alt="Health Outreach" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='480'%3E%3Cdefs%3E%3ClinearGradient id='g5' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop stop-color='%23a7f3d0'/%3E%3Cstop offset='1' stop-color='%2398c1ff'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g5)' width='100%25' height='100%25'/%3E%3Ctext x='50%25' y='52%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-weight='700' font-size='38' fill='%23334155'%3EHealth%3C/text%3E%3C/svg%3E" />
    </div>
    <h3>Health Outreach</h3>
    <p>Mobile clinics bringing essential care to remote villages.</p>
    <div class="footer">
      <div class="meta"><span>Target $20k</span></div>
      <div style="display:flex;gap:8px">
        <button class="btn secondary">Details</button>
        <button class="btn">Donate</button>
      </div>
    </div>
  </article>

  <!-- F -->
  <article class="card f">
    <div class="ph">
      <img alt="Shelter Relief" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='480'%3E%3Cdefs%3E%3ClinearGradient id='g6' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop stop-color='%233f3f46'/%3E%3Cstop offset='1' stop-color='%23576073'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g6)' width='100%25' height='100%25'/%3E%3Ctext x='50%25' y='52%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-weight='700' font-size='38' fill='%23e5e7eb'%3EShelter%3C/text%3E%3C/svg%3E" />
    </div>
    <h3>Shelter & Warmth</h3>
    <p>Emergency kits and temporary shelters for families displaced by storms.</p>
    <div class="footer">
      <div class="meta">83% funded</div>
      <button class="btn">Donate Now</button>
    </div>
  </article>

</div>

<!-- Color theming per card for buttons -->
<script>
document.querySelectorAll('.card').forEach((c,i)=>{
  const map = [
    ['#ff8a00','#ff5a00'],
    ['#22d3ee','#3b82f6'],
    ['#ef4444','#f97316'],
    ['#22c55e','#16a34a'],
    ['#0ea5e9','#2563eb'],
    ['#f59e0b','#ef4444'],
  ];
  const [c1,c2] = map[i%map.length];
  c.querySelectorAll('.btn').forEach(b=>{
    b.style.background = `linear-gradient(90deg, ${c1}, ${c2})`;
  });
});
</script>


