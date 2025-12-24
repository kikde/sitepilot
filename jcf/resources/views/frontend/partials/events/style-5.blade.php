{{-- resources/views/frontend/partials/test/style-15.blade.php --}}
{{-- Inline-scoped partial for "Upcoming Events – Mobile Block" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-events-1{
    --kp-ink:#173a3a;
    --kp-muted:#6d7b7b;
    --kp-accent:#ef7d22;
    color:var(--kp-ink);
    font-family:"Poppins",system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-events-1, #kp-events-1 *{ box-sizing:border-box; }
  #kp-events-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-events-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; }
  #kp-events-1 .kp-hero{ width:100%; aspect-ratio:4/3; object-fit:cover; border-radius:8px; overflow:hidden; }
  #kp-events-1 .kp-content{ padding:18px 16px 28px; }

  #kp-events-1 .kp-kicker{ color:#8aa3a0; font-weight:700; letter-spacing:.1em; font-size:.9rem; display:flex; align-items:center; gap:10px; }
  #kp-events-1 .kp-kicker:after{ content:""; height:2px; width:36px; background:var(--kp-accent); border-radius:2px; }

  #kp-events-1 .kp-title{ margin:6px 0 10px 0; font-size:1.8rem; line-height:1.2; font-weight:800; }
  #kp-events-1 .kp-lead{ margin:0 0 16px 0; color:var(--kp-muted); line-height:1.75; }
  #kp-events-1 .kp-btn{ display:inline-block; background:var(--kp-accent); color:#fff !important; text-decoration:none !important; padding:14px 16px; font-weight:900; border-radius:6px; letter-spacing:.4px; }
</style>

<div id="kp-events-1">
  <section class="kp-wrap">
    <img class="kp-hero" src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1400&auto=format&fit=crop" alt="Group of children outdoors">
    <div class="kp-content">
      <div class="kp-kicker">Upcoming Events</div>
      <h2 class="kp-title">Check latest upcoming events</h2>
      <p class="kp-lead">There are many variations of passages of lorem ipsum available but the majority have suffered.</p>
      <a class="kp-btn" href="#">REGISTER YOUR SEAT</a>
    </div>
  </section>
</div>
