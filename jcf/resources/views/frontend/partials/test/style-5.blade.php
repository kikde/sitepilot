{{-- resources/views/frontend/partials/test/style-5.blade.php --}}
{{-- Inline-scoped partial for "Non-Profit Card – Aid for starving children" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-nonprofit-1{
    --kp-card:#ffffff; --kp-bg:#f6f6f6; --kp-line:#eee2d3;
    --kp-ink:#0f172a; --kp-muted:#6b7280; --kp-pill:#ff8a25; --kp-bar:#e7e7e7; --kp-barfill:#9ad66a;
    color:var(--kp-ink);
    font-family:"Poppins", system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  }
  #kp-nonprofit-1, #kp-nonprofit-1 * { box-sizing: border-box; }
  #kp-nonprofit-1 img { max-width: 100% !important; height: auto !important; display:block !important; }

  #kp-nonprofit-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; }
  #kp-nonprofit-1 .kp-card{ background:var(--kp-card); border:1px solid var(--kp-line); border-radius:8px; overflow:hidden; box-shadow:0 10px 24px rgba(0,0,0,.06); }
  #kp-nonprofit-1 .kp-media img{ width:100%; aspect-ratio:4/3; object-fit:cover; }
  #kp-nonprofit-1 .kp-body{ padding:16px; }

  #kp-nonprofit-1 .kp-pill{ display:inline-block; background:var(--kp-pill); color:#fff; font-weight:800; letter-spacing:.5px; font-size:.8rem; padding:6px 10px; border-radius:4px; margin-bottom:12px; }
  #kp-nonprofit-1 .kp-title{ margin:0 0 10px 0; font-size:1.2rem; font-weight:800; }
  #kp-nonprofit-1 .kp-desc{ margin:0 0 12px 0; color:var(--kp-muted); line-height:1.7; }

  #kp-nonprofit-1 .kp-progress{ height:6px; background:var(--kp-bar); border-radius:999px; margin:10px 0 10px; overflow:hidden; }
  #kp-nonprofit-1 .kp-progress .kp-fill{ height:100%; width:8%; background:var(--kp-barfill); border-radius:999px; }

  #kp-nonprofit-1 .kp-meta{ display:flex; justify-content:space-between; font-weight:700; font-size:.95rem; margin-top:10px; }
  #kp-nonprofit-1 .kp-meta small{ display:block; color:var(--kp-muted); font-weight:600; }
</style>

<div id="kp-nonprofit-1">
  <div class="kp-wrap">
    <article class="kp-card">
      <div class="kp-media">
        <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?q=80&w=1400&auto=format&fit=crop" alt="Child portrait">
      </div>
      <div class="kp-body">
        <span class="kp-pill">NON-PROFIT</span>
        <div class="kp-title">Aid for starving children</div>
        <p class="kp-desc">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>
        <div class="kp-progress"><div class="kp-fill" style="width:8%"></div></div>
        <div class="kp-meta">
          <div><small>Raised:</small> $938</div>
          <div><small>Goal:</small> $50,000</div>
        </div>
      </div>
    </article>
  </div>
</div>
