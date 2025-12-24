{{-- resources/views/frontend/partials/test/style-10.blade.php --}}
{{-- Inline-scoped partial for "Send A Gift – Progress" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-gift-1{
    --kp-bg:#0d2c24;
    --kp-ink:#eafff5;
    --kp-accent:#39cc8f;
    --kp-panel:#0f3a30;
    --kp-track:#0b281f;
    color:var(--kp-ink);
    font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-gift-1, #kp-gift-1 *{ box-sizing:border-box; }
  #kp-gift-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  /* container */
  #kp-gift-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; }

  /* card */
  #kp-gift-1 .kp-card{ position:relative; border-radius:14px; overflow:hidden; background:var(--kp-panel); }
  #kp-gift-1 .kp-card > img{ width:100%; aspect-ratio:4/3; object-fit:cover; filter:brightness(.55); }

  /* overlay content */
  #kp-gift-1 .kp-content{
    position:absolute; inset:0; padding:16px;
    display:flex; flex-direction:column; justify-content:center;
  }

  #kp-gift-1 .kp-title{ margin:0 0 6px; font-size:22px; font-weight:800; }
  #kp-gift-1 .kp-desc{ margin:0 0 10px; opacity:.95; line-height:1.6; }

  /* progress */
  #kp-gift-1 .kp-progress{ height:8px; background:var(--kp-track); border-radius:999px; overflow:hidden; position:relative; margin:6px 0 2px; }
  #kp-gift-1 .kp-fill{ height:100%; width:62%; background:var(--kp-accent); position:relative; }
  #kp-gift-1 .kp-badge{ position:absolute; right:0; top:-24px; background:var(--kp-accent); color:var(--kp-bg); border-radius:6px; padding:2px 6px; font-weight:900; font-size:.85rem; }

  /* meta + button */
  #kp-gift-1 .kp-meta{ display:flex; justify-content:space-between; opacity:.9; margin-bottom:10px; font-weight:700; }
  #kp-gift-1 .kp-btn{ background:var(--kp-accent); color:var(--kp-bg) !important; border:none; border-radius:999px; padding:12px 16px; font-weight:900; width:max-content; text-decoration:none !important; cursor:pointer; }

  /* Optional background texture mimic (very subtle) if you want a section bg */
  /* Place this wrapper inside a section with your own bg; we keep partial transparent by default */
</style>

<div id="kp-gift-1">
  <div class="kp-wrap">
    <div class="kp-card">
      <img src="https://images.unsplash.com/photo-1504194104404-433180773017?q=80&w=1400&auto=format&fit=crop" alt="Gift for children">
      <div class="kp-content">
        <h3 class="kp-title">Send A Gift For Children’s</h3>
        <p class="kp-desc">Dicta sunt explicabo nemo enim ipsam voluptatem quia voluptas.</p>
        <div class="kp-progress"><div class="kp-fill"><span class="kp-badge">61.71%</span></div></div>
        <div class="kp-meta"><span>Raised: $17,280</span><span>Goal: $28,000</span></div>
        <a class="kp-btn" href="/donate">➤ Donate Now</a>
      </div>
    </div>
  </div>
</div>
