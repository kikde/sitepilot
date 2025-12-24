<!-- DONATE – Sticky Bottom Bar (mobile) -->
<style>
:root{ --p:#005bff; --a:#ff4747; }
.dn-stick{position:fixed;left:0;right:0;bottom:10px;margin:auto;max-width:540px;padding:10px;border-radius:16px;
  background:#ffffffcc;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
  box-shadow:0 18px 40px rgba(0,0,0,.22);border:1px solid rgba(0,0,0,.08);z-index:50}
.dn-s-row{display:flex;align-items:center;gap:10px}
.dn-s-progress{flex:1;background:#eef2ff;height:10px;border-radius:999px;overflow:hidden}
.dn-s-progress>span{display:block;height:100%;width:68%;background:linear-gradient(90deg,var(--p),var(--a))}
.dn-s-numbers{font-weight:900;color:#0f172a;font-size:.95rem;white-space:nowrap}
.dn-s-btn{flex:0 0 130px;text-align:center;text-decoration:none;color:#fff;font-weight:900;padding:12px;border-radius:12px;
  background:linear-gradient(90deg,var(--p),var(--a));box-shadow:0 10px 22px rgba(0,91,255,.28)}
@media(min-width:768px){ .dn-stick{bottom:16px} }
</style>

<div class="dn-stick" role="region" aria-label="Quick Donate">
  <div class="dn-s-row">
    <div class="dn-s-numbers">₹6.8L / ₹10L</div>
    <div class="dn-s-progress"><span></span></div>
    <a class="dn-s-btn" href="/donate">Donate</a>
  </div>
</div>
<!-- Tip: show/hide with JS after scroll if you want -->
