{{-- resources/views/frontend/partials/test/style-4.blade.php --}}
{{-- Inline-scoped partial for "Help And Donate Us – Slider Card". --}}
{{-- Safe to include inside any page section. --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-slider-1{
    --kp-ink:#1c2329; --kp-muted:#6f7680; --kp-accent:#ff7e1b; --kp-accent2:#ff9d2e; --kp-line:#e9e2d7;
    color:var(--kp-ink);
    font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-slider-1, #kp-slider-1 *{ box-sizing:border-box; }
  #kp-slider-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-slider-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; text-align:center; }
  #kp-slider-1 .kp-kicker{ color:#f06f6f; font-family:'Comic Sans MS', cursive; font-size:1rem; margin:2px 0 6px; }
  #kp-slider-1 .kp-h2{ margin:0 0 10px; font-size:24px; font-weight:800; }

  #kp-slider-1 .kp-slider{ background:#f5efe5; border:1px solid var(--kp-line); border-radius:10px; padding:10px; position:relative; text-align:left; }
  #kp-slider-1 .kp-photo{ border-radius:8px; width:100%; aspect-ratio:4/3; object-fit:cover; border:1px solid var(--kp-line); }
  #kp-slider-1 .kp-tag{ position:absolute; left:16px; top:16px; background:#e84b3c; color:#fff; font-weight:800; padding:6px 10px; border-radius:6px; }
  #kp-slider-1 .kp-icons{ position:absolute; right:16px; top:16px; display:flex; gap:10px; }
  #kp-slider-1 .kp-icons .kp-badge{ position:relative; background:#fff; border-radius:10px; padding:6px; border:1px solid var(--kp-line); }
  #kp-slider-1 .kp-icons .kp-badge small{ position:absolute; right:-6px; top:-6px; background:#ff3b3b; color:#fff; border-radius:999px; padding:2px 6px; font-size:.7rem; font-weight:900; }

  #kp-slider-1 .kp-nav{ position:absolute; top:50%; transform:translateY(-50%); background:#fff; border:1px solid var(--kp-line); width:34px; height:34px; border-radius:6px; display:grid; place-items:center; font-weight:900; cursor:default; }
  #kp-slider-1 .kp-nav.prev{ left:8px; } 
  #kp-slider-1 .kp-nav.next{ right:8px; }

  #kp-slider-1 .kp-title{ margin:10px 6px; font-weight:800; }
  #kp-slider-1 .kp-metrics{ display:grid; grid-template-columns:1fr 1fr; gap:12px; border-top:1px dashed var(--kp-line); padding:10px 6px 0; }
  #kp-slider-1 .kp-metrics .kp-kv small{ display:block; color:var(--kp-muted); }

  #kp-slider-1 .kp-progress{ margin:12px 6px; height:10px; border-radius:999px; background:#f0d6ce; position:relative; }
  #kp-slider-1 .kp-progress .kp-fill{ position:absolute; height:100%; width:85%; background:linear-gradient(90deg,var(--kp-accent),var(--kp-accent2)); border-radius:999px; }
  #kp-slider-1 .kp-progress .kp-bubble{ position:absolute; left:85%; transform:translate(-50%,-140%); background:#fff; border:1px solid var(--kp-line); padding:2px 6px; border-radius:999px; font-size:.8rem; }

  /* Icons (optional) if fontawesome not present, keep spacing consistent */
  #kp-slider-1 .kp-icons i{ display:inline-block; width:14px; height:14px; }
</style>

<div id="kp-slider-1">
  <div class="kp-wrap">
    <div class="kp-kicker">Donate Us</div>
    <div class="kp-h2">Help And Donate Us</div>

    <section class="kp-slider">
      <img class="kp-photo" src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=1400&auto=format&fit=crop" alt="Volunteers serving food">
      <div class="kp-tag">Food Health</div>

      <div class="kp-icons">
        <div class="kp-badge"><i class="fa-regular fa-bell"></i><small>3</small></div>
        <div class="kp-badge"><i class="fa-solid fa-video"></i></div>
      </div>

      <div class="kp-nav prev" aria-hidden="true">‹</div>
      <div class="kp-nav next" aria-hidden="true">›</div>

      <div class="kp-title">Your small help can bring a Better Life to Everyone</div>

      <div class="kp-metrics">
        <div class="kp-kv"><small>Achive:</small> <strong>$25,345</strong></div>
        <div class="kp-kv"><small>Goal:</small> <strong>$12,000</strong></div>
      </div>

      <div class="kp-progress">
        <div class="kp-fill"></div>
        <div class="kp-bubble">211.2%</div>
      </div>
    </section>
  </div>
</div>
