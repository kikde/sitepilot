{-- resources/views/frontend/partials/section/style-3.blade.php --}
<style>
/* Scoped from buttons-v3.html */
#kp-btns-3 { margin: 18px 0; }
#kp-btns-3 *{box-sizing:border-box}#kp-btns-3 body{margin:0;background:#f5f6fa;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:#0f172a}#kp-btns-3 .wrap{display:grid;gap:16px;padding:14px;grid-template-columns:1fr}#kp-btns-3 .section{background:#fff;border:1px solid #e8edf5;border-radius:14px;padding:12px}#kp-btns-3 h2{margin:.2rem 0 .6rem;font-size:16px;color:#334155;font-weight:800;letter-spacing:.3px}#kp-btns-3 .row{display:flex;flex-wrap:wrap;gap:12px}#kp-btns-3 /* Base button */
.btn{
  appearance:none;border:none;outline:none;cursor:pointer;
  display:inline-flex;align-items:center;gap:10px;
  padding:12px 18px;border-radius:999px;font-weight:900;letter-spacing:.3px;text-transform:uppercase;
  transition:transform .08s ease, filter .2s ease, box-shadow .2s ease;
}#kp-btns-3 .btn:active{transform:translateY(1px) scale(.98)}#kp-btns-3 /* ============ Yellow CLICK HERE set ============ */
.y{--y1:#ffcc00;--y2:#ff9d00}#kp-btns-3 .y .hand{width:22px;height:22px;border:3px solid currentColor;border-radius:6px;position:relative;background:#fff}#kp-btns-3 .y .hand:after{content:"";position:absolute;right:-6px;top:50%;transform:translateY(-50%) rotate(-45deg);width:10px;height:10px;border-right:3px solid currentColor;border-bottom:3px solid currentColor;border-radius:2px}#kp-btns-3 /* Outline yellow with inner white gap */
.y1{background:#fff;color:#111827;border:4px solid var(--y1);box-shadow:0 8px 0 #d4a2001a}#kp-btns-3 /* Solid white plate with right yellow coin */
.y2{background:#fff;color:#111827;border:4px solid #e3e7ef;padding-right:62px;position:relative}#kp-btns-3 .y2:after{content:"";position:absolute;right:6px;top:6px;bottom:6px;width:44px;border-radius:999px;background:linear-gradient(180deg,var(--y1),var(--y2))}#kp-btns-3 /* White to grey split with yellow coin */
.y3{background:linear-gradient(90deg,#fff 0 60%,#9aa3ad 60%);color:#111827;border:4px solid var(--y1);padding-right:62px;position:relative}#kp-btns-3 .y3:after{content:"";position:absolute;right:6px;top:6px;bottom:6px;width:44px;border-radius:999px;background:#fff}#kp-btns-3 /* Orange soft with thick outline */
.y4{background:linear-gradient(180deg,#ffb329,#ff9900);color:#111827;border:4px solid #ffb329;box-shadow:0 4px 0 #c97c001a}#kp-btns-3 /* Dark outline with soft inner glow */
.y5{background:#111827;color:#ffffff;border:4px solid #ffa21e;box-shadow:0 10px 18px rgba(0,0,0,.25)}#kp-btns-3 /* Big glossy yellow CTA */
.y6{background:linear-gradient(180deg,#ffe066,#ffb400);color:#fff;border:none;padding:18px 28px;border-radius:999px;position:relative;box-shadow:0 16px 24px rgba(255,180,0,.32)}#kp-btns-3 .y6 .shine{position:absolute;left:14px;right:14px;top:10px;height:42%;background:linear-gradient(180deg,rgba(255,255,255,.9),rgba(255,255,255,0));border-radius:999px}#kp-btns-3 .arrow-r{width:0;height:0;border-left:12px solid currentColor;border-top:7px solid transparent;border-bottom:7px solid transparent}#kp-btns-3 /* ============ Red SUBSCRIBE pack ============ */
.red{--r:#ff2626;--r2:#e10b0b}#kp-btns-3 /* Solid red */
.r1{background:linear-gradient(180deg,var(--r),var(--r2));color:#fff;box-shadow:0 10px 20px rgba(225,11,11,.28)}#kp-btns-3 /* White plate with red icon left */
.r2{background:#fff;color:#e10b0b;border-radius:14px;padding:10px 18px 10px 64px;position:relative;border:3px solid #ffe1e1}#kp-btns-3 .r2 .icon{position:absolute;left:6px;top:6px;bottom:6px;width:44px;border-radius:10px;background:var(--r);display:flex;align-items:center;justify-content:center;color:#fff}#kp-btns-3 /* Red with white right coin */
.r3{background:linear-gradient(180deg,var(--r),var(--r2));color:#fff;padding-right:62px;position:relative;box-shadow:0 12px 20px rgba(225,11,11,.28)}#kp-btns-3 .r3:after{content:"";position:absolute;right:6px;top:6px;bottom:6px;width:44px;background:#fff;border-radius:999px}#kp-btns-3 /* White plate with red chevron tag */
.r4{background:#fff;color:#e10b0b;border:3px solid #ffe1e1;padding-right:90px;position:relative}#kp-btns-3 .r4:after{content:"";position:absolute;right:0;top:0;bottom:0;width:86px;background:var(--r);clip-path:polygon(0 0,100% 0,86% 50%,100% 100%,0 100%);border-radius:0 12px 12px 0}#kp-btns-3 /* Red with slim white inner pill */
.r5{background:linear-gradient(180deg,var(--r),var(--r2));color:#fff;border:3px solid #fff;box-shadow:0 8px 18px rgba(0,0,0,.15)}#kp-btns-3 /* Red with left white plate & play icon */
.r6{background:linear-gradient(180deg,var(--r),var(--r2));color:#fff;padding-left:68px;position:relative}#kp-btns-3 .r6:before{content:"";position:absolute;left:6px;top:6px;bottom:6px;width:44px;border-radius:8px;background:#fff}#kp-btns-3 .r6 .play{position:absolute;left:20px;top:50%;transform:translateY(-50%);width:0;height:0;border-left:12px solid var(--r);border-top:7px solid transparent;border-bottom:7px solid transparent}#kp-btns-3 .icon-bell{width:18px;height:18px;border:3px solid currentColor;border-radius:9px 9px 6px 6px;position:relative}#kp-btns-3 .icon-bell:after{content:"";position:absolute;left:50%;bottom:-4px;transform:translateX(-50%);width:5px;height:5px;background:currentColor;border-radius:999px}#kp-btns-3 .icon-meg{width:18px;height:18px;border:3px solid currentColor;border-radius:4px;position:relative}#kp-btns-3 .icon-meg:after{content:"";position:absolute;left:2px;bottom:-5px;width:10px;height:8px;border:3px solid currentColor;border-top:none;border-radius:0 0 6px 6px}#kp-btns-3 .icon-arrow{width:0;height:0;border-left:12px solid currentColor;border-top:7px solid transparent;border-bottom:7px solid transparent}{#kp-btns-3 .wrap{grid-template-columns:1fr 1fr}}
</style>
<div id="kp-btns-3">
<div class="wrap">

  <div class="section">
    <h2>Yellow “Click Here” set</h2>
    <div class="row y">
      <button class="btn y1">Click Here <span class="hand"></span></button>
      <button class="btn y2">Click Here</button>
      <button class="btn y3">Click Here <span class="hand"></span></button>
      <button class="btn y4">Click Here <span class="hand"></span></button>
      <button class="btn y5">Click Here <span class="hand"></span></button>
      <button class="btn y6">Click Here <span class="arrow-r"></span><span class="shine"></span></button>
    </div>
  </div>

  <div class="section">
    <h2>Red “Subscribe” pack</h2>
    <div class="row red">
      <button class="btn r1">Subscribe</button>
      <button class="btn r2"><span class="icon"><span class="icon-bell" style="color:#fff"></span></span> Subscribe</button>
      <button class="btn r3">Subscribe</button>
      <button class="btn r4">Subscribe</button>
      <button class="btn r5">Subscribe</button>
      <button class="btn r6">Subscribe <span class="play"></span></button>
      <button class="btn r2"><span class="icon"><span class="icon-meg" style="color:#fff"></span></span> Subscribe</button>
      <button class="btn r1"><span class="icon-arrow"></span> Subscribe</button>
    </div>
  </div>

</div>
</div>
