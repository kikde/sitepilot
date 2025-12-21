{{-- resources/views/frontend/partials/test/style-7.blade.php --}}
{{-- Inline-scoped partial for "Raised / Goal Trio – Card" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-trio-1{
    --kp-ink:#0f2a20;
    --kp-muted:#6b7d73;
    --kp-line:#ece6dc;
    --kp-accent:#ea5f4f;
    --kp-good:#22a95a;
    color:var(--kp-ink);
    font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-trio-1, #kp-trio-1 *{ box-sizing:border-box; }
  #kp-trio-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-trio-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; }
  #kp-trio-1 .kp-card{ background:#fff; border:1px solid var(--kp-line); border-radius:14px; padding:12px; box-shadow:0 12px 26px rgba(0,0,0,.06); }
  #kp-trio-1 .kp-media{ border-radius:10px; overflow:hidden; position:relative; }
  #kp-trio-1 .kp-media img{ width:100%; aspect-ratio:4/3; object-fit:cover; }
  #kp-trio-1 .kp-badge{ position:absolute; right:12px; top:12px; background:#fff; border-radius:999px; padding:6px 8px; font-size:14px; }

  #kp-trio-1 .kp-hr{ height:2px; background:#f0d8ce; border-radius:999px; margin-top:10px; }

  #kp-trio-1 .kp-row{ display:grid; grid-template-columns:1fr 1fr 1fr; text-align:center; margin:10px 0; font-weight:900; }
  #kp-trio-1 .kp-row > div{ padding:8px 0; }
  #kp-trio-1 .kp-row > div:first-child{ color:var(--kp-accent); }
  #kp-trio-1 .kp-row > div:last-child{ color:var(--kp-good); }

  #kp-trio-1 .kp-title{ margin:12px 0 6px; font-size:20px; line-height:1.25; font-weight:800; color:var(--kp-ink); }
  #kp-trio-1 .kp-desc{ color:var(--kp-muted); margin:0 0 8px; line-height:1.6; }

  #kp-trio-1 .kp-link{ display:inline-block; margin-top:10px; color:var(--kp-accent) !important; font-weight:900; text-decoration:none; }
</style>

<div id="kp-trio-1">
  <div class="kp-wrap">
    <article class="kp-card">
      <div class="kp-media">
        <div class="kp-badge">🎥 3</div>
        <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1400&auto=format&fit=crop" alt="">
      </div>

      <div class="kp-hr"></div>

      <div class="kp-row">
        <div>RAISED<br>$25,260</div>
        <div>140.3%</div>
        <div>GOAL<br>$18,000</div>
      </div>

      <div class="kp-title">Raise funds for clean water system for rural poor</div>
      <div class="kp-desc">Lorem ipsum dolor sit amet, consectetur eiusmod tempor incididunt.</div>
      <a class="kp-link" href="#">Donate Now ↗</a>
    </article>
  </div>
</div>
