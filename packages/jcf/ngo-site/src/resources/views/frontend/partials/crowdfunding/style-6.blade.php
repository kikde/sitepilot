<!-- ========= SIMPLE CROWDFUNDING CARDS (Copy–Paste One File) ========= -->
<style>
/* ===== Core Card Styles (mobile-first) ===== */
.cf-card{
  /* Theme variables (overridden by .theme-* classes) */
  --cf-bg:#ffffff;       /* card background */
  --cf-ink:#0f172a;      /* main text */
  --cf-muted:#64748b;    /* secondary text */
  --cf-primary:#005bff;  /* gradient start */
  --cf-accent:#ff4747;   /* gradient end   */
  --cf-soft:#f1f5f9;     /* soft surfaces  */
  --cf-ring:#e5e7eb;     /* borders        */

  max-width:480px;
  margin:14px auto;
  border-radius:16px;
  background:var(--cf-bg);
  border:1px solid var(--cf-ring);
  box-shadow:0 10px 24px rgba(0,0,0,.08);
  font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;
  overflow:hidden;
}
.cf-hero{ height:160px; background:#e2e8f0 center/cover no-repeat; }
.cf-body{ padding:14px; }
.cf-title{ margin:0 0 4px; font-weight:900; color:var(--cf-ink); font-size:1.05rem; }
.cf-sub{ margin:0 0 10px; color:var(--cf-muted); font-weight:700; font-size:.9rem; }

.cf-stats{ display:flex; justify-content:space-between; gap:10px; }
.cf-raised{ font-weight:900; color:var(--cf-ink); }
.cf-goal{ color:var(--cf-muted); font-weight:800; }

.cf-bar{ margin:10px 0; height:12px; border-radius:999px; overflow:hidden;
  background:var(--cf-soft); border:1px solid var(--cf-ring); }
.cf-bar > span{
  display:block; height:100%;
  width:60%; /* <- initial width; will animate to data-percent via JS */
  background:linear-gradient(90deg,var(--cf-primary),var(--cf-accent));
  transition:width .6s ease;
}

.cf-eta{ color:var(--cf-ink); font-weight:800; font-size:.9rem; }

.cf-cta{ display:flex; gap:8px; margin-top:12px; }
.cf-btn{
  flex:1; text-align:center; text-decoration:none; font-weight:900;
  padding:12px 14px; border-radius:12px; color:#fff;
  background:linear-gradient(90deg,var(--cf-primary),var(--cf-accent));
  box-shadow:0 8px 18px rgba(0,0,0,.12);
}
.cf-sec{
  padding:12px 14px; border-radius:12px; font-weight:800; text-decoration:none;
  color:var(--cf-ink); background:#fff; border:1px solid var(--cf-ring);
}

/* ===== Theme Presets (add to .cf-card) ===== */
.theme-blue{
  --cf-primary:#005bff; --cf-accent:#ff4747;
  --cf-soft:#eef2ff;    --cf-ring:#e5e7eb;  --cf-bg:#ffffff;
}
.theme-teal{
  --cf-primary:#06b6d4; --cf-accent:#10b981;
  --cf-soft:#ecfeff;    --cf-ring:#dcfafe;  --cf-bg:#ffffff;
}
.theme-purple{
  --cf-primary:#7c3aed; --cf-accent:#ef5da8;
  --cf-soft:#faf5ff;    --cf-ring:#eadcff;  --cf-bg:#ffffff;
}

/* ===== Optional: lightweight layout to preview multiple cards together ===== */
.cf-grid{
  display:grid; gap:16px; grid-template-columns: 1fr; /* 1 per row on mobile */
  margin:18px auto; max-width:520px; padding:0 8px;
}
@media(min-width:600px){ .cf-grid{ grid-template-columns: 1fr 1fr; max-width:1060px; } }
</style>

<div class="cf-grid">
  <!-- ========== DEMO 1: BLUE THEME ========== -->
  <div class="cf-card theme-blue">
    <div class="cf-hero" style="background-image:url('https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1200&q=80')"></div>
    <div class="cf-body">
      <h3 class="cf-title">Flood Relief for 100 Families</h3>
      <p class="cf-sub">₹7,20,850 raised of ₹10,00,000</p>

      <div class="cf-stats">
        <div class="cf-raised">₹7,20,850</div>
        <div class="cf-goal">Goal ₹10,00,000</div>
      </div>

      <!-- Set final percent in data-percent; JS will animate width -->
      <div class="cf-bar" data-percent="72"><span></span></div>
      <div class="cf-eta">⏳ 9 days left • 72% funded</div>

      <div class="cf-cta">
        <a class="cf-btn" href="/donate?amount=1000">Donate ₹1,000</a>
        <a class="cf-sec" href="#share">Share</a>
      </div>
    </div>
  </div>

  <!-- ========== DEMO 2: TEAL THEME ========== -->
  <div class="cf-card theme-teal">
    <div class="cf-hero" style="background-image:url('https://images.unsplash.com/photo-1603575448368-5f1eac03e3aa?auto=format&fit=crop&w=1200&q=80')"></div>
    <div class="cf-body">
      <h3 class="cf-title">Healthcare Kits for Rural Families</h3>
      <p class="cf-sub">₹4,05,000 raised of ₹7,00,000</p>

      <div class="cf-stats">
        <div class="cf-raised">₹4,05,000</div>
        <div class="cf-goal">Goal ₹7,00,000</div>
      </div>

      <div class="cf-bar" data-percent="58"><span></span></div>
      <div class="cf-eta">⏳ 12 days left • 58% funded</div>

      <div class="cf-cta">
        <a class="cf-btn" href="/donate?amount=500">Donate ₹500</a>
        <a class="cf-sec" href="#share">Share</a>
      </div>
    </div>
  </div>

  <!-- ========== DEMO 3: PURPLE THEME ========== -->
  <div class="cf-card theme-purple">
    <div class="cf-hero" style="background-image:url('https://images.unsplash.com/photo-1593113598332-8b2c65a3dc8f?auto=format&fit=crop&w=1200&q=80')"></div>
    <div class="cf-body">
      <h3 class="cf-title">Educate 200 Girls — Scholarship Drive</h3>
      <p class="cf-sub">₹8,10,250 raised of ₹12,00,000</p>

      <div class="cf-stats">
        <div class="cf-raised">₹8,10,250</div>
        <div class="cf-goal">Goal ₹12,00,000</div>
      </div>

      <div class="cf-bar" data-percent="67"><span></span></div>
      <div class="cf-eta">⏳ 15 days left • 67% funded</div>

      <div class="cf-cta">
        <a class="cf-btn" href="/donate?amount=1000">Donate ₹1,000</a>
        <a class="cf-sec" href="#share">Share</a>
      </div>
    </div>
  </div>
</div>

<!-- ===== Optional tiny JS to animate bars to their data-percent ===== -->
<script>
document.querySelectorAll('.cf-bar').forEach(function(bar){
  var target = parseFloat(bar.getAttribute('data-percent') || '0');
  target = Math.max(0, Math.min(100, target));
  var span = bar.querySelector('span');
  span.style.width = '0%';
  requestAnimationFrame(function(){ span.style.width = target + '%'; });
});
</script>
