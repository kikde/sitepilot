{{-- resources/views/frontend/partials/section/style-about-us-panel-yellow.blade.php --}}
<style>
  #kp-about-yellow{--bg:#fff9f0;--ink:#1f2933;--mut:#6b7280;--accent:#f4ae34;--accent-ink:#7a4c00;color:var(--ink);font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
  #kp-about-yellow,#kp-about-yellow *{box-sizing:border-box}
  #kp-about-yellow .wrap{max-width:420px;width:100%;padding:16px;margin:0 auto 24px;background:var(--bg)}
  #kp-about-yellow .kicker{color:var(--accent);font-weight:900;letter-spacing:.5px;margin-bottom:8px;font-family:'Courier New',monospace}
  #kp-about-yellow h1{font-family:Georgia,'Times New Roman',serif;line-height:1.15;margin:0 0 10px;color:#111827}
  #kp-about-yellow p{color:var(--mut);line-height:1.7;margin:0 0 8px}
  #kp-about-yellow .list{display:grid;gap:10px;margin:14px 0}
  #kp-about-yellow .item{display:flex;gap:10px;align-items:flex-start;color:#111827}
  #kp-about-yellow .badge{width:18px;height:18px;border-radius:50%;border:2px solid var(--accent);display:grid;place-items:center;margin-top:2px}
  #kp-about-yellow .badge::after{content:'✓';color:var(--accent);font-size:.7rem;font-weight:900}
  #kp-about-yellow .stat{background:#f7b955;color:#111;border-radius:4px;padding:16px;display:flex;gap:12px;align-items:center;margin-top:14px}
  #kp-about-yellow .stat .ico{font-size:28px}
  #kp-about-yellow .stat .num{font-size:1.6rem;font-weight:900}
  #kp-about-yellow .stat small{color:#111a}
  #kp-about-yellow .panel{position:relative;border-top:1px solid #f1e1c7;margin-top:12px}
  #kp-about-yellow .bg-hands{position:absolute;inset:0;background:radial-gradient(80% 60% at 50% 40%,#f6e6c7,transparent 60%);opacity:.35;pointer-events:none}
</style>
<div id="kp-about-yellow">
  <section class="wrap">
    <div class="kicker">ABOUT US</div>
    <h1>We Are In A Mission To<br>Help The Helpness</h1>
    <div class="panel">
      <div class="bg-hands"></div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris</p>
      <div class="list">
        <div class="item"><div class="badge"></div><div>Support people in extreme need</div></div>
        <div class="item"><div class="badge"></div><div>Largest global crowdfunding community</div></div>
        <div class="item"><div class="badge"></div><div>Make the world a better place</div></div>
        <div class="item"><div class="badge"></div><div>Share your love for community</div></div>
      </div>
      <div class="stat"><div class="ico">💰</div><div><div class="num">70,458</div><small>Successful Campaigns</small></div></div>
    </div>
  </section>
</div>
