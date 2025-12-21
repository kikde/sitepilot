{{-- resources/views/frontend/partials/test/style-8.blade.php --}}
{{-- Inline-scoped partial for "Recent Causes – Dark" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-recent-1{
    --kp-bg:#121619;
    --kp-panel:#1a2025;
    --kp-ink:#eaf1f6;
    --kp-muted:#a8b8c5;
    --kp-red:#ff1f1f;
    --kp-line:#2b333a;
    color:var(--kp-ink);
    font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-recent-1, #kp-recent-1 *{ box-sizing:border-box; }
  #kp-recent-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-recent-1 .kp-panel{ max-width:420px; width:100%; background:var(--kp-panel); padding:16px 16px 24px; border-radius:0 0 0 12px; margin:0 auto; }
  #kp-recent-1 .kp-kicker{ text-align:center; color:#ff7a7a; font-family:'Caveat',cursive; margin-bottom:8px; }
  #kp-recent-1 .kp-h1{ margin:0 0 12px; font-size:2.2rem; line-height:1.05; }

  #kp-recent-1 .kp-card{ background:#fff; border-radius:14px; padding:12px; color:#0f2230; }
  #kp-recent-1 .kp-media{ border-radius:10px; overflow:hidden; margin:8px 0; }
  #kp-recent-1 .kp-media img{ width:100%; aspect-ratio:4/3; object-fit:cover; filter:grayscale(100%); }

  #kp-recent-1 .kp-progress{ height:10px; background:#ffb2b2; border-radius:999px; overflow:hidden; margin:10px 0; }
  #kp-recent-1 .kp-fill{ height:100%; width:49%; background:var(--kp-red); }

  #kp-recent-1 .kp-btn{ background:#fff; border:2px solid #0f2230; border-radius:999px; padding:12px 16px; font-weight:900; color:#0f2230; text-decoration:none; display:inline-block; }
  #kp-recent-1 .kp-muted{ color:#6b7a86; }
</style>

<div id="kp-recent-1" style="background: var(--kp-bg);">
  <section class="kp-panel">
    <div class="kp-kicker">We Are Always Open For Children</div>
    <div class="kp-h1">Our Recent<br>Causes</div>

    <article class="kp-card">
      <small class="kp-muted">No Email Logo Set For This Campaign.</small>

      <div class="kp-media">
        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1400&auto=format&fit=crop" alt="Recent cause cover">
      </div>

      <h3 style="margin: 6px 0 6px; font-size: 1.1rem; font-weight: 800;">Help For Food</h3>
      <p class="kp-muted" style="margin: 0 0 8px;">Lorem Ipsum Dolor Sit Amet, Consete Sadipscing Elitr, Sed Diam Nonum</p>

      <div><b>490,815.00</b> Raised Of <b>1,000.00</b> Goal</div>
      <div class="kp-progress"><div class="kp-fill"></div></div>

      <a href="/donate" class="kp-btn">Donate Now</a>
    </article>
  </section>
</div>
