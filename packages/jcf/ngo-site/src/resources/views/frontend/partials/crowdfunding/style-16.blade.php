{{-- resources/views/frontend/partials/test/style-9.blade.php --}}
{{-- Inline-scoped partial for "Rooted in Action – Cause Card" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-rooted-1{
    --kp-ink:#1b2836;
    --kp-muted:#6e7a86;
    --kp-accent:#20c15a;
    --kp-orange:#ff8c00;
    --kp-line:#efe7df;
    color:var(--kp-ink);
    font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
    background:#fbf7ee00; /* transparent to inherit page bg */
  }
  #kp-rooted-1, #kp-rooted-1 *{ box-sizing:border-box; }
  #kp-rooted-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-rooted-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; padding:16px 16px 20px; }

  #kp-rooted-1 .kp-h2{ margin:0; text-align:center; font-family:Georgia,"Times New Roman",serif; font-size:28px; line-height:1.1; }
  #kp-rooted-1 .kp-h2 .kp-act{ color:var(--kp-accent); }
  #kp-rooted-1 .kp-sub{ text-align:center; color:var(--kp-muted); margin:4px 0 12px; }

  #kp-rooted-1 .kp-card{ background:#fff; border:1px solid var(--kp-line); border-radius:8px; box-shadow:0 12px 26px rgba(0,0,0,.06); overflow:hidden; padding:10px; }
  #kp-rooted-1 .kp-badges{ display:flex; justify-content:space-between; font-weight:900; color:#1a232b; gap:10px; align-items:center; }
  #kp-rooted-1 .kp-badges .kp-left{ background:var(--kp-orange); color:#fff; padding:6px 10px; border-radius:6px; }

  #kp-rooted-1 .kp-title{ margin:6px 0 0; font-size:18px; font-weight:800; }
  #kp-rooted-1 .kp-media{ margin:10px 0 8px; }
  #kp-rooted-1 .kp-media img{ width:100%; aspect-ratio:4/3; object-fit:cover; border-radius:4px; }

  #kp-rooted-1 .kp-meta{ display:flex; justify-content:space-between; color:#1a7a54; margin-bottom:8px; font-weight:700; }
  #kp-rooted-1 .kp-desc{ color:#384b57; line-height:1.7; margin:0; }

  #kp-rooted-1 .kp-brands{ display:flex; gap:10px; align-items:center; margin:10px 0; flex-wrap:wrap; }
  #kp-rooted-1 .kp-brand{ background:#f2f2f2; border-radius:999px; padding:6px 12px; font-weight:900; }

  #kp-rooted-1 .kp-cta{ display:block; margin:12px auto 0; background:var(--kp-orange); color:#fff !important; border:none; border-radius:8px; font-weight:900; padding:12px 16px; max-width:200px; text-align:center; text-decoration:none !important; cursor:pointer; }
</style>

<div id="kp-rooted-1">
  <div class="kp-wrap">
    <div class="kp-h2">ROOTED IN <span class="kp-act">ACTION</span></div>
    <p class="kp-sub">12 Months–12 Causes</p>

    <article class="kp-card">
      <div class="kp-badges">
        <span class="kp-left">Tax Benefits Available</span>
        <span style="color:#ff7a3b">DIFFERENTLY ABLED</span>
      </div>

      <div class="kp-title">Calm &amp; Connect</div>

      <div class="kp-media">
        <img src="https://images.unsplash.com/photo-1534536281715-e28d76689b4d?q=80&w=1400&auto=format&fit=crop" alt="Rooted in Action cover">
      </div>

      <div class="kp-meta">
        <span>26 Sep 2025</span>
        <span>📍 PUNE</span>
      </div>

      <p class="kp-desc">India Is Us, in collaboration with Hitachi, organized a DEI-focused initiative supporting...</p>

      <div class="kp-brands">
        <span class="kp-brand">HITACHI</span>
        <span class="kp-brand">✓</span>
      </div>

      <a class="kp-cta" href="/donate">Donate Now</a>
    </article>
  </div>
</div>
