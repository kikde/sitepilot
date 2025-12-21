{{-- resources/views/frontend/partials/donate/style-20.blade.php --}}
<style>
  #kp-donate-20{--ink:#192a27;--muted:#6d7b7b;--ring:#e3ebe9;--chip:#eef2f1;--brand:#0b6b60;--accent:#ffc400;color:var(--ink);font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial;position:relative;isolation:isolate}
  #kp-donate-20,#kp-donate-20 *{box-sizing:border-box}
  #kp-donate-20 .wrap{max-width:420px;width:100%;margin:0 auto 24px}
  #kp-donate-20 .panel{background:#fff;border-radius:16px;border:1px solid #e8e2d7;box-shadow:0 12px 28px rgba(0,0,0,.06);padding:16px}
  #kp-donate-20 h3{margin:0 0 12px}
  #kp-donate-20 .notice{background:#fff3cd;border:1px solid #ffe08a;color:#7a5a00;border-radius:8px;padding:12px;margin-bottom:12px}
  #kp-donate-20 .slider{display:grid;grid-template-columns:60px 1fr;gap:10px;align-items:center}
  #kp-donate-20 .currency{background:#11443e;color:#fff;border-radius:999px;display:grid;place-items:center;height:48px;font-weight:900}
  #kp-donate-20 .range{position:relative;height:48px;background:#f0f3f2;border:1px solid var(--ring);border-radius:999px;display:flex;align-items:center;padding:0 16px;font-weight:900}
  #kp-donate-20 .dot{position:absolute;height:18px;width:18px;border-radius:999px;background:#0b6b60;right:24%}
  #kp-donate-20 .chips{display:flex;flex-wrap:wrap;gap:12px;margin:14px 0}
  #kp-donate-20 .chip{background:var(--chip);border:1px solid var(--ring);border-radius:999px;padding:10px 14px;font-weight:800}
  #kp-donate-20 .radios{display:grid;gap:10px;margin:8px 0 14px;color:#223}
  #kp-donate-20 .submit{display:inline-flex;align-items:center;gap:10px;background:#ffc400;color:#111;border:none;border-radius:999px;padding:14px 18px;font-weight:900;box-shadow:0 12px 28px rgba(255,196,0,.35)}
</style>
<div id="kp-donate-20">
  <div class="wrap">
    <section class="panel">
      <h3>Support Where It Counts.</h3>
      <div class="notice"><strong>Notice:</strong> Test Mode Is Enabled. While In Test Mode No Live Donations Are Processed.</div>
      <div>Your Donation:</div>
      <div class="slider">
        <div class="currency">$</div>
        <div class="range">100 <span class="dot"></span></div>
      </div>
      <div class="chips">
        <div class="chip">20</div><div class="chip">50</div><div class="chip" style="background:#0b6b60;color:#fff">100</div><div class="chip">200</div>
        <div class="chip" style="width:100%">Custom</div>
      </div>
      <div class="radios">
        <label><input type="radio" name="pay" checked> Credit Card</label>
        <label><input type="radio" name="pay"> Test Donation</label>
        <label><input type="radio" name="pay"> Offline Donation</label>
      </div>
      <button class="submit" type="button">Donate Now</button>
    </section>
  </div>
</div>
