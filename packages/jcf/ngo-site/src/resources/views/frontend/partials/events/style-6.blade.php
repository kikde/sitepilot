{{-- resources/views/frontend/partials/test/style-16.blade.php --}}
{{-- Inline-scoped partial for "Recent Events – Card 2" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-events-2{
    --kp-ink:#15212c; --kp-muted:#6f7b7a; --kp-accent:#ff7a1a; --kp-chip:#1ea37b;
    color:var(--kp-ink);
    font-family:"Poppins",system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-events-2, #kp-events-2 *{ box-sizing:border-box; }
  #kp-events-2 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-events-2 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; }

  /* top slab */
  #kp-events-2 .kp-slab{ background:#fff; border-radius:14px; padding:14px; text-align:center; box-shadow:0 10px 24px rgba(0,0,0,.06); }
  #kp-events-2 .kp-date{ color:var(--kp-accent); font-weight:900; }
  #kp-events-2 .kp-speakers{ font-weight:900; margin-top:6px; }

  #kp-events-2 .kp-avatars{ display:flex; justify-content:center; gap:12px; margin-top:10px; }
  #kp-events-2 .kp-av{ width:56px; height:56px; border-radius:999px; background:#eee center/cover; border:3px solid #ffd1b1; }

  /* card */
  #kp-events-2 .kp-card{ background:#fff; border-radius:14px; padding:12px; margin-top:12px; box-shadow:0 12px 28px rgba(0,0,0,.06); }

  #kp-events-2 .kp-h2{ margin:12px 0 0; font-family:Georgia,"Times New Roman",serif; font-size:1.4rem; font-weight:800; line-height:1.2; }
  #kp-events-2 .kp-meta{ display:flex; justify-content:center; gap:18px; color:var(--kp-muted); margin:8px 0; flex-wrap:wrap; }
  #kp-events-2 .kp-btn{ background:var(--kp-accent); color:#fff !important; border:none; border-radius:999px; padding:12px 16px; font-weight:900; text-decoration:none !important; display:inline-block; }

  #kp-events-2 .kp-media{ border-radius:12px; overflow:hidden; margin-top:12px; position:relative; }
  #kp-events-2 .kp-media img{ width:100%; aspect-ratio:4/3; object-fit:cover; }
  #kp-events-2 .kp-badge{ position:absolute; right:10px; bottom:10px; background:var(--kp-chip); color:#fff; border-radius:8px; padding:6px 10px; font-weight:800; }
</style>

<div id="kp-events-2">
  <div class="kp-wrap">
    <div class="kp-slab">
      <div class="kp-date">17–29 March</div>
      <div class="kp-speakers">Our Speakers</div>
      <div class="kp-avatars">
        <div class="kp-av" style="background-image:url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=200&auto=format&fit=crop')"></div>
        <div class="kp-av" style="background-image:url('https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=200&auto=format&fit=crop')"></div>
        <div class="kp-av" style="background-image:url('https://images.unsplash.com/photo-1547427296-76bcadfb4f2c?q=80&w=200&auto=format&fit=crop')"></div>
        <div class="kp-av" style="background-image:url('https://images.unsplash.com/photo-1547106634-56dcd53ae883?q=80&w=200&auto=format&fit=crop')"></div>
      </div>
    </div>

    <article class="kp-card">
      <h2 class="kp-h2">Hand For Children</h2>
      <div class="kp-meta">
        <span>🕒 07.00 am – 5.00 pm</span>
        <span>📍 6354 Elgin St Road, Australia</span>
      </div>
      <a class="kp-btn" href="#">Event Details →</a>
      <div class="kp-media">
        <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=1200&auto=format&fit=crop" alt="Event cover">
        <span class="kp-badge">Education</span>
      </div>
    </article>
  </div>
</div>
