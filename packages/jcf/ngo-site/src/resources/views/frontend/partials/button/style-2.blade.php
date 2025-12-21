{-- resources/views/frontend/partials/section/style-2.blade.php --}
<style>
/* Scoped from buttons-v2.html */
#kp-btns-2 { margin: 18px 0; }
#kp-btns-2 :root{
  --shadow:0 10px 18px rgba(0,0,0,.12);
}#kp-btns-2 *{box-sizing:border-box}#kp-btns-2 body{margin:0;background:#f7f7fb;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:#0f172a}#kp-btns-2 .wrap{display:grid;gap:16px;padding:14px;grid-template-columns:1fr}#kp-btns-2 h2{margin:.4rem 0 .6rem;font-size:16px;color:#334155;font-weight:800;letter-spacing:.3px}#kp-btns-2 .section{background:#fff;border:1px solid #edf2f7;border-radius:14px;padding:12px;box-shadow:var(--shadow)}#kp-btns-2 .row{display:flex;flex-wrap:wrap;gap:12px}#kp-btns-2 /* Base button */
.btn{
  --px:18px; --py:12px;
  appearance:none;border:none;outline:none;
  border-radius:999px; padding:var(--py) var(--px);
  font-weight:900; letter-spacing:.3px; text-transform:uppercase;
  display:inline-flex; align-items:center; gap:10px;
  cursor:pointer; transition:transform .08s ease, filter .2s ease;
}#kp-btns-2 .btn:active{ transform:translateY(1px) scale(.98) }#kp-btns-2 /* Soft shadow under plate */
.plate{position:relative; display:inline-flex}#kp-btns-2 .plate:after{content:""; position:absolute; left:8px; right:8px; bottom:-8px; height:8px; border-radius:999px; background:rgba(0,0,0,.15); filter:blur(8px);}#kp-btns-2 /* ====== Set A: Colorful Subscribe / Unsubscribe ====== */
.a1{background:#1ac79e;color:#fff}#kp-btns-2 .a1 .play{width:0;height:0;border-left:12px solid #fff;border-top:7px solid transparent;border-bottom:7px solid transparent}#kp-btns-2 .a2{background:#fff;color:#ff6f00;border:3px solid #ff6f00}#kp-btns-2 .a2 .mail{width:20px;height:20px;border:3px solid currentColor;border-radius:999px;position:relative}#kp-btns-2 .a2 .mail:after{content:"";position:absolute;left:3px;right:3px;top:6px;height:0;border-top:3px solid currentColor;border-left:3px solid transparent;border-right:3px solid transparent}#kp-btns-2 .a3{background:#ff9d00;color:#fff;border-radius:16px}#kp-btns-2 .a3 .dbl{display:inline-flex;gap:4px}#kp-btns-2 .a3 .dbl i{width:8px;height:8px;border-right:3px solid #fff;border-bottom:3px solid #fff;transform:rotate(-45deg);border-radius:1px}#kp-btns-2 .a4{background:#ff2a72;color:#fff}#kp-btns-2 .a4 .meg{width:18px;height:18px;border:3px solid #fff;border-radius:4px;position:relative}#kp-btns-2 .a4 .meg:after{content:"";position:absolute;left:2px;bottom:-5px;width:10px;height:8px;border:3px solid #fff;border-top:none;border-radius:0 0 6px 6px}#kp-btns-2 .a5{background:#1692ff;color:#fff}#kp-btns-2 .a5 .chk{width:18px;height:18px;border:3px solid #fff;border-radius:4px;position:relative}#kp-btns-2 .a5 .chk:after{content:"";position:absolute;left:3px;top:3px;width:8px;height:12px;border-right:3px solid #fff;border-bottom:3px solid #fff;transform:rotate(45deg)}#kp-btns-2 .a6{background:#8b5cf6;color:#fff}#kp-btns-2 .a6 .chk{width:18px;height:18px;border:3px solid #fff;border-radius:4px;position:relative}#kp-btns-2 .a6 .chk:after{content:"";position:absolute;left:3px;top:3px;width:8px;height:12px;border-right:3px solid #fff;border-bottom:3px solid #fff;transform:rotate(45deg)}#kp-btns-2 .a7{background:#9ca3af;color:#fff}#kp-btns-2 .a7 .sad{width:18px;height:18px;border:3px solid #fff;border-radius:50%;position:relative}#kp-btns-2 .a7 .sad:before, #kp-btns-2 .a7 .sad:after{content:"";position:absolute;background:#fff;width:3px;height:3px;border-radius:50%}#kp-btns-2 .a7 .sad:before{left:4px;top:6px}#kp-btns-2 .a7 .sad:after{right:4px;top:6px}#kp-btns-2 .a7 .sad i{position:absolute;left:4px;right:4px;bottom:4px;border-bottom:3px solid #fff;border-radius:0 0 999px 999px}#kp-btns-2 /* ====== Set B: Two‑tone icon plate buttons ====== */
.b{--c:#1e88e5; --bg:#fff}#kp-btns-2 .b{background:var(--bg); color:var(--c); border:2px solid var(--c); padding:10px 14px 10px 60px; position:relative; border-radius:14px}#kp-btns-2 .b .icon{position:absolute; left:6px; top:6px; bottom:6px; width:44px; background:var(--c); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center}#kp-btns-2 .b .icon .arrow{width:0;height:0;border-left:10px solid #fff;border-top:6px solid transparent;border-bottom:6px solid transparent}#kp-btns-2 .b .icon .phone{width:18px;height:18px;border:3px solid #fff;border-radius:999px;position:relative}#kp-btns-2 .b .icon .phone:after{content:"";position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:6px;height:6px;border:3px solid #fff;border-radius:50%}#kp-btns-2 .b .icon .thumb{width:18px;height:18px;border:3px solid #fff;border-radius:3px;border-bottom-left-radius:10px;position:relative}#kp-btns-2 .b .icon .cart{width:18px;height:18px;border:3px solid #fff;border-radius:4px;position:relative}#kp-btns-2 .b .icon .cart:after{content:"";position:absolute;bottom:-6px;left:2px;width:12px;height:6px;border:3px solid #fff;border-top:none;border-radius:0 0 8px 8px}#kp-btns-2 .b .icon .i{width:18px;height:18px;border:3px solid #fff;border-radius:50%}#kp-btns-2 .b.buy{--c:#0ea5a6}#kp-btns-2 .b.like{--c:#ff9d00}#kp-btns-2 .b.contact{--c:#6d6dfa}#kp-btns-2 .b.watch{--c:#8b5cf6}#kp-btns-2 .b.learn{--c:#111827;color:#111827;border-color:#111827}#kp-btns-2 .b.learn .icon{background:#111827}#kp-btns-2 /* ====== Set C: Blue download family ====== */
.c{border-radius:14px; font-weight:900; text-transform:uppercase}#kp-btns-2 .c1{background:#fff;color:#2b6cb0;border:3px solid #2b6cb0;padding:10px 18px 10px 60px;position:relative}#kp-btns-2 .c1 .circle{position:absolute;left:6px;top:6px;bottom:6px;width:44px;border-radius:999px;background:#2b6cb0;display:flex;align-items:center;justify-content:center;color:#fff}#kp-btns-2 .down{width:0;height:0;border-left:8px solid transparent;border-right:8px solid transparent;border-top:12px solid currentColor}#kp-btns-2 .bar{height:4px;width:18px;background:currentColor;margin-top:2px;border-radius:2px}#kp-btns-2 .c2{background:linear-gradient(180deg,#33a1ff,#1a52ff);color:#fff;border:none;padding:12px 20px;border-radius:14px;box-shadow:var(--shadow)}#kp-btns-2 .c3{background:#fff;color:#7c8aa1;border:3px solid #7c8aa1;padding:10px 18px 10px 60px;position:relative;border-radius:14px}#kp-btns-2 .c3 .square{position:absolute;left:6px;top:6px;bottom:6px;width:44px;background:#7c8aa1;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff}#kp-btns-2 .c4{background:linear-gradient(180deg,#1a52ff,#1544d6);color:#fff;border:none;padding:12px 20px;border-radius:999px;box-shadow:var(--shadow)}#kp-btns-2 .c5{background:#fff;color:#1a52ff;border:3px solid #1a52ff;padding:12px 20px;border-radius:999px}#kp-btns-2 .c6{background:#fff;color:#1a52ff;border:3px solid #1a52ff;padding:10px 18px 10px 60px;position:relative;border-radius:999px}#kp-btns-2 .c6 .circle{position:absolute;left:6px;top:6px;bottom:6px;width:44px;border-radius:999px;background:#1a52ff;display:flex;align-items:center;justify-content:center;color:#fff}#kp-btns-2 /* ====== Set D: Modern gradient CTAs ====== */
.grad{color:#fff;border:none;padding:12px 18px;border-radius:12px;box-shadow:var(--shadow)}#kp-btns-2 .g1{background:linear-gradient(90deg,#8a5ef8,#36c4ff)}#kp-btns-2 .g2{background:linear-gradient(90deg,#0db6e0,#1fc567)}#kp-btns-2 .g3{background:linear-gradient(90deg,#ffb84d,#f97316)}#kp-btns-2 .g4{background:linear-gradient(90deg,#9c27b0,#673ab7)}#kp-btns-2 .g5{background:linear-gradient(90deg,#ff5a7d,#a9004f)}#kp-btns-2 .g6{background:linear-gradient(90deg,#3b82f6,#1e40af)}#kp-btns-2 .g7{background:linear-gradient(90deg,#ef4444,#dc2626)}#kp-btns-2 .g8{background:linear-gradient(90deg,#f59e0b,#fde047); color:#111827}#kp-btns-2 .g9{background:linear-gradient(90deg,#0ea5a6,#14b8a6)}#kp-btns-2 .g10{background:linear-gradient(90deg,#f43f5e,#ec4899,#f59e0b)}#kp-btns-2 /* right chevron cap */
.chev{position:relative;padding-right:48px}#kp-btns-2 .chev:after{content:""; position:absolute; right:0; top:0; bottom:0; width:42px; background:rgba(255,255,255,.2);
  clip-path:polygon(0 0,100% 50%,0 100%); border-radius:0 12px 12px 0}#kp-btns-2 /* pill with pedestal */
.pedestal{position:relative}#kp-btns-2 .pedestal:before{content:""; position:absolute; left:18px; right:18px; bottom:-6px; height:6px; background:rgba(0,0,0,.25); filter:blur(6px); border-radius:6px}{#kp-btns-2 .wrap{grid-template-columns:1fr 1fr}
}
</style>
<div id="kp-btns-2">
<div class="wrap">

  <div class="section">
    <h2>A) Subscribe / Unsubscribe (color variants)</h2>
    <div class="row">
      <button class="btn a1"><span class="play"></span> Subscribe</button>
      <button class="btn a2"><span class="mail"></span> Subscribe</button>
      <button class="btn a3"><span class="dbl"><i></i><i></i></span> Subscribe</button>
      <button class="btn a4"><span class="meg"></span> Subscribe</button>
      <button class="btn a5"><span class="chk"></span> Subscribe</button>
      <button class="btn a6"><span class="chk"></span> Subscribe</button>
      <button class="btn a7"><span class="sad"><i></i></span> Unsubscribe</button>
    </div>
  </div>

  <div class="section">
    <h2>B) Two‑tone plate buttons</h2>
    <div class="row">
      <span class="plate"><button class="btn b" style="--c:#1e88e5"><span class="icon"><span class="arrow"></span></span> Download</button></span>
      <span class="plate"><button class="btn b watch" style="--c:#8b5cf6"><span class="icon"><span class="arrow"></span></span> Watch Now</button></span>
      <span class="plate"><button class="btn b like" style="--c:#ff9d00"><span class="icon"><span class="thumb"></span></span> Like Us</button></span>
      <span class="plate"><button class="btn b contact" style="--c:#6d6dfa"><span class="icon"><span class="phone"></span></span> Contact Us</button></span>
      <span class="plate"><button class="btn b buy" style="--c:#0ea5a6"><span class="icon"><span class="cart"></span></span> Buy Now</button></span>
      <span class="plate"><button class="btn b learn"><span class="icon"><span class="i"></span></span> Learn More</button></span>
    </div>
  </div>

  <div class="section">
    <h2>C) Blue Download family</h2>
    <div class="row">
      <button class="btn c c1"><span class="circle"><span class="down" style="color:#fff"></span><span class="bar" style="background:#fff"></span></span> Free Download</button>
      <button class="btn c c2">Free Download</button>
      <button class="btn c c3"><span class="square"><span class="down" style="color:#fff"></span><span class="bar" style="background:#fff"></span></span> Free Download</button>
      <button class="btn c c4 pedestal">Free Download</button>
      <button class="btn c c5">Free Download</button>
      <button class="btn c c6"><span class="circle"><span class="down" style="color:#fff"></span><span class="bar" style="background:#fff"></span></span> Free Download</button>
    </div>
  </div>

  <div class="section">
    <h2>D) Modern gradient CTAs</h2>
    <div class="row">
      <button class="btn grad g1">Download</button>
      <button class="btn grad g2 chev">Watch Our Video</button>
      <button class="btn grad g1">Contact Us</button>
      <button class="btn grad g3">Subscribe</button>
      <button class="btn grad g4 chev">Learn More</button>
      <button class="btn grad g5 chev">Like & Share</button>
      <button class="btn grad g6 pedestal">Buy Now</button>
      <button class="btn grad g6">Watch Now</button>
      <button class="btn grad g7">Sign Now</button>
      <button class="btn grad g10">Login Now</button>
    </div>
  </div>

</div>
</div>
