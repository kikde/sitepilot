{{-- resources/views/frontend/partials/test/style-12.blade.php --}}
{{-- Inline-scoped partial for "Water Charity – Stats Card" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-water-1{
    --kp-ink:#1c2329; --kp-muted:#6f7680; --kp-accent:#19c37d; --kp-orange:#ea6a14; --kp-line:#e8e2d9;
    color:var(--kp-ink);
    font-family:"Poppins",system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-water-1, #kp-water-1 *{ box-sizing:border-box; }
  #kp-water-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-water-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; }
  #kp-water-1 .kp-card{ background:#fff; border:1px solid var(--kp-line); border-radius:10px; box-shadow:0 12px 28px rgba(0,0,0,.06); overflow:hidden; }

  #kp-water-1 .kp-media{ position:relative; }
  #kp-water-1 .kp-media img{ width:100%; aspect-ratio:4/3; object-fit:cover; border-bottom:6px solid #e07b61; }
  #kp-water-1 .kp-badge{ position:absolute; left:12px; top:10px; background:#0db37a; color:#fff; padding:6px 10px; border-radius:6px; font-weight:800; }
  #kp-water-1 .kp-icons{ position:absolute; right:12px; top:10px; display:flex; gap:8px; }
  #kp-water-1 .kp-icons .kp-b{ background:#fff; border:1px solid var(--kp-line); border-radius:6px; padding:6px; position:relative; }
  #kp-water-1 .kp-icons .kp-b small{ position:absolute; right:-6px; top:-6px; background:#ff3b3b; color:#fff; font-weight:900; padding:1px 6px; border-radius:12px; font-size:.7rem; }

  #kp-water-1 .kp-body{ padding:14px 14px 18px; }

  #kp-water-1 .kp-stats{ display:grid; grid-template-columns:1fr 1fr 1fr; text-align:center; font-weight:900; color:#1c1c1c; margin-top:-16px; position:relative; }
  #kp-water-1 .kp-stats:before{ content:""; position:absolute; left:0; right:0; top:-12px; height:6px; background:#e07b61; border-radius:12px; }
  #kp-water-1 .kp-stats > div{ padding:16px 0; border-right:1px solid var(--kp-line); }
  #kp-water-1 .kp-stats > div:last-child{ border-right:none; }
  #kp-water-1 .kp-stats small{ display:block; color:var(--kp-muted); font-weight:700; }

  #kp-water-1 .kp-title{ margin:10px 0; font-size:1.1rem; font-weight:800; }
  #kp-water-1 .kp-desc{ margin:0 0 8px; color:var(--kp-muted); line-height:1.7; }
  #kp-water-1 .kp-more{ color:var(--kp-orange) !important; font-weight:900; text-decoration:none !important; }
</style>

<div id="kp-water-1">
  <div class="kp-wrap">
    <article class="kp-card">
      <div class="kp-media">
        <img src="https://images.unsplash.com/photo-1460353581641-37baddab0fa2?q=80&w=1400&auto=format&fit=crop" alt="Children playing and water pump">
        <div class="kp-badge">Water Charity</div>
        <div class="kp-icons">
          <div class="kp-b"><i class="fa-regular fa-bell"></i><small>3</small></div>
          <div class="kp-b"><i class="fa-solid fa-video"></i></div>
        </div>
      </div>

      <div class="kp-body">
        <div class="kp-stats">
          <div><div style="color:#ea6a14">$18,265</div><small>RAISED</small></div>
          <div><div style="color:#8a7b2d">121.8%</div><small></small></div>
          <div><div style="color:#0db37a">$15,000</div><small>GOAL</small></div>
        </div>

        <div class="kp-title">Give African Childrens a good Education &amp; Healthy</div>
        <p class="kp-desc">Lorem ipsum dolor sit amet, consectetur eiusmod tempor incididunt.</p>
        <a class="kp-more" href="#">Donate Now <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </article>
  </div>
</div>
