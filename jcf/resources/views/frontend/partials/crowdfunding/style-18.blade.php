{{-- resources/views/frontend/partials/test/style-11.blade.php --}}
{{-- Inline-scoped partial for "Urgent Appeal – Bhushan" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-urgent-1{
    --kp-ink:#2a2f2f;
    --kp-muted:#6b7b7b;
    --kp-line:#e7e7e7;
    --kp-green:#6fbf73;
    color:var(--kp-ink);
    font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-urgent-1, #kp-urgent-1 *{ box-sizing:border-box; }
  #kp-urgent-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-urgent-1 .kp-wrap{ max-width:420px; width:100%; margin:0 auto; }
  #kp-urgent-1 .kp-card{ border:1px solid var(--kp-line); border-radius:8px; overflow:hidden; box-shadow:0 12px 26px rgba(0,0,0,.06); background:#fff; }

  #kp-urgent-1 .kp-media{ position:relative; border:1px solid var(--kp-line); margin:12px; border-radius:6px; overflow:hidden; }
  #kp-urgent-1 .kp-media img{ width:100%; aspect-ratio:4/3; object-fit:cover; }
  #kp-urgent-1 .kp-ribbon{ position:absolute; left:12px; top:12px; background:#168a50; color:#fff; border-radius:6px; padding:8px 10px; font-weight:900; }

  #kp-urgent-1 .kp-meta{ text-align:center; padding:10px 0; border-top:1px solid var(--kp-line); }
  #kp-urgent-1 .kp-meta div{ margin:2px 0; color:#555; }

  #kp-urgent-1 .kp-title{ margin:10px 12px; text-align:center; font-family:Georgia, "Times New Roman", serif; font-size:20px; line-height:1.25; font-weight:800; }
  #kp-urgent-1 .kp-desc{ margin:0 12px 14px; color:#384b57; line-height:1.8; }

  #kp-urgent-1 .kp-btn{ display:block; margin:12px auto 20px; background:#7ac27d; color:#fff !important; border:none; border-radius:8px; padding:12px 16px; font-weight:900; text-align:center; width:max-content; text-decoration:none !important; cursor:pointer; }
</style>

<div id="kp-urgent-1">
  <div class="kp-wrap">
    <article class="kp-card">
      <div class="kp-media">
        <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1400&auto=format&fit=crop" alt="child">
        <div class="kp-ribbon">URGENT</div>
      </div>
      <div class="kp-meta">
        <div>Bhushan Kumar</div>
        <div>Treatment cost – ₹2,50,000</div>
        <div>UHID No – 108614934</div>
      </div>
      <div class="kp-title">URGENT APPEAL TO SAVE 5-YEAR-OLD BHUSHAN KUMAR’S LIFE</div>
      <p class="kp-desc">We humbly reach out to you with folded hands for a little boy, Bhushan Kumar, just 5 years old, who is bravely fighting at AIIMS Hospital, Delhi. struggling parents.</p>
      <a class="kp-btn" href="/donate">Save Bhushan</a>
    </article>
  </div>
</div>
