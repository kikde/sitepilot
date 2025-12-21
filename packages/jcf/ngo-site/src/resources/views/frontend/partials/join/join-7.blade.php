{{-- resources/views/frontend/partials/test/style-14.blade.php --}}
{{-- Inline-scoped partial for "Proud Volunteer – Overlay Hero" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-vol-1{
    --kp-ink:#ffffff;
    --kp-btn:#f0ad3d;
    --kp-btn-ink:#1d1f22;
    color:var(--kp-ink);
    font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-vol-1, #kp-vol-1 *{ box-sizing:border-box; }
  #kp-vol-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-vol-1 .kp-hero{ position:relative; max-width:420px; width:100%; border-radius:10px; overflow:hidden; margin:0 auto; }
  #kp-vol-1 .kp-hero > img{ width:100%; aspect-ratio:4/3; object-fit:cover; filter:brightness(.55); }

  #kp-vol-1 .kp-text{ position:absolute; inset:0; display:grid; place-items:center; text-align:center; padding:16px; }
  #kp-vol-1 .kp-title{ font-family:Georgia,"Times New Roman",serif; font-size:1.8rem; margin:0 0 10px; font-weight:800; }
  #kp-vol-1 .kp-desc{ opacity:.92; margin:0; line-height:1.6; }

  #kp-vol-1 .kp-btn{ margin-top:10px; background:var(--kp-btn); color:var(--kp-btn-ink) !important; border:none; border-radius:6px; padding:12px 16px; font-weight:900; text-decoration:none !important; display:inline-block; cursor:pointer; }
</style>

<div id="kp-vol-1">
  <section class="kp-hero">
    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop" alt="Volunteers teamwork">
    <div class="kp-text">
      <div>
        <h2 class="kp-title">Become A Proud Volunteer Now</h2>
        <p class="kp-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a class="kp-btn" href="/volunteer/apply">JOIN NOW</a>
      </div>
    </div>
  </section>
</div>
