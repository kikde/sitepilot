{{-- resources/views/frontend/partials/test/style-13.blade.php --}}
{{-- Inline-scoped partial for "Quick Fundraising Card" --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-quick-1{
    --kp-bg:#faf9f7; --kp-card:#ffffff; --kp-ink:#222222; --kp-muted:#6b7280;
    --kp-brand:#f3b027; --kp-brand-dark:#1f1f1f;
    --kp-shadow:0 8px 24px rgba(0,0,0,.08); --kp-radius:14px;
    color:var(--kp-ink);
    font-family:"Poppins",system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  #kp-quick-1, #kp-quick-1 *{ box-sizing:border-box; }
  #kp-quick-1 img{ max-width:100% !important; height:auto !important; display:block !important; }

  #kp-quick-1 .kp-wrap{ max-width:420px; margin:0 auto; }
  #kp-quick-1 .kp-card{ border-radius:var(--kp-radius); box-shadow:var(--kp-shadow); border:1px solid #eee8df; overflow:hidden; background:var(--kp-card); }
  #kp-quick-1 .kp-inner{ padding:34px 28px 36px; text-align:center; }
  #kp-quick-1 .kp-icon{ font-size:42px; margin-bottom:14px; line-height:1; color:var(--kp-brand); }
  #kp-quick-1 .kp-title{ margin:0 0 12px 0; font-weight:800; font-size:1.14rem; color:#1c1c1c; }
  #kp-quick-1 .kp-desc{ margin:0 auto 18px; max-width:26ch; line-height:1.7; font-size:.96rem; color:var(--kp-muted); }
  #kp-quick-1 .kp-btn{ display:inline-block; padding:12px 22px; border-radius:6px; font-weight:800; letter-spacing:.5px; text-transform:uppercase; text-decoration:none !important; box-shadow:0 6px 14px rgba(0,0,0,.08); background:var(--kp-brand); color:var(--kp-brand-dark) !important; }
</style>

<div id="kp-quick-1">
  <div class="kp-wrap">
    <article class="kp-card">
      <div class="kp-inner">
        <div class="kp-icon"><i class="fa-solid fa-handshake-simple"></i></div>
        <h3 class="kp-title">Quick Fundraising</h3>
        <p class="kp-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        <a class="kp-btn" href="#">Join Now</a>
      </div>
    </article>
  </div>
</div>
