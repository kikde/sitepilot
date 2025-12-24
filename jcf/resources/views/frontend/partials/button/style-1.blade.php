{-- resources/views/frontend/partials/section/style-1.blade.php --}
<style>
/* Scoped from buttons-v1.html */
#kp-btns-1 { margin: 18px 0; }
#kp-btns-1 :root{
  --red:#ee1d40;
  --red-dark:#b50b2b;
  --blue:#0a4ea5;
  --blue2:#0d3880;
  --lime:#c9e32f;
  --char:#ff6a3c;
  --orange:#ffb400;
  --yellow:#ffc107;
  --indigo:#3b82f6;
  --emerald:#10b981;
  --pink:#ec4899;
  --purple:#8b5cf6;
  --teal:#14b8a6;
}#kp-btns-1 *{box-sizing:border-box}#kp-btns-1 body{margin:0;background:#ffffff;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:#0f172a}#kp-btns-1 .wrap{display:grid;gap:16px;padding:14px;grid-template-columns:1fr}#kp-btns-1 .section{background:#f8fafc;border:1px solid #eef2f7;border-radius:14px;padding:12px}#kp-btns-1 h2{margin:.2rem 0 .6rem;font-size:16px;color:#334155;font-weight:800;letter-spacing:.3px}#kp-btns-1 /* Base button */
.btn{
  --bg:#111;
  --fg:#fff;
  --pad-x:18px;
  --pad-y:12px;
  --radius:999px;
  appearance:none;border:none;outline:none;
  background:var(--bg);color:var(--fg);
  font-weight:900;letter-spacing:.3px;text-transform:uppercase;
  padding:var(--pad-y) var(--pad-x);
  border-radius:var(--radius);
  display:inline-flex;align-items:center;gap:10px;
  cursor:pointer;
  transition:transform .08s ease, filter .2s ease, box-shadow .2s ease;
}#kp-btns-1 .btn:active{transform:translateY(1px) scale(.98)}#kp-btns-1 /* 1) Solid Donate variations (top-left image) */
.bt-solid{--bg:var(--red);box-shadow:0 10px 20px rgba(238,29,64,.25)}#kp-btns-1 .bt-solid .ico{width:22px;height:22px;display:inline-block}#kp-btns-1 .bt-solid.white{--bg:#fff;--fg:var(--red);box-shadow:inset 0 0 0 4px var(--red)}#kp-btns-1 .bt-solid-cut{--bg:transparent;--fg:#fff;border:4px solid var(--red);padding:calc(var(--pad-y) - 2px) calc(var(--pad-x) - 2px)}#kp-btns-1 .bt-solid-cut .cut{position:relative;display:inline-flex;align-items:center;justify-content:center;background:#fff;border-radius:10px;padding:8px 10px;color:var(--red);margin-left:-8px}#kp-btns-1 .bt-solid-cut{background:var(--red); box-shadow:0 10px 20px rgba(238,29,64,.25)}#kp-btns-1 /* 2) Speech bubble "CHARITY" */
.bt-bubble{
  --bg:var(--char);
  background:var(--char);
  border-radius:999px 999px 18px 999px;
  position:relative;
  padding:16px 28px;
  color:#fff;
  font-size:26px;
  text-transform:uppercase;
  font-weight:900;
  letter-spacing:.6px;
  display:inline-flex;align-items:center;justify-content:center;
  box-shadow:0 16px 30px rgba(255,106,60,.25);
}#kp-btns-1 .bt-bubble:after{
  content:""; position:absolute; left:48%; bottom:-12px;
  width:18px;height:18px;background:var(--char); transform:rotate(45deg);
  border-radius:2px;
}#kp-btns-1 .bt-bubble .decor{
  position:absolute; left:26px; right:26px; top:8px; bottom:8px; pointer-events:none;
}#kp-btns-1 .bt-bubble .decor:before, #kp-btns-1 .bt-bubble .decor:after{
  content:""; position:absolute; height:3px; width:60px; border-radius:3px;
  background:#fff7; left:0; top:0;
}#kp-btns-1 .bt-bubble .decor:after{ right:0; left:auto; bottom:0; top:auto; width:80px }#kp-btns-1 /* 3) Glossy red pill (donate) */
.bt-gloss{
  --bg:linear-gradient(180deg,#ff2a2a 0%, #d50000 100%);
  background:var(--bg); color:#fff;
  padding:14px 26px;border-radius:999px;
  box-shadow:inset 0 2px 0 rgba(255,255,255,.5), 0 12px 26px rgba(213,0,0,.35);
  border:1px solid #a30808;
}#kp-btns-1 .bt-gloss .shine{
  position:absolute; inset:6px 10px auto 10px; height:40%; border-radius:999px;
  background:linear-gradient(180deg,rgba(255,255,255,.85),rgba(255,255,255,.0));
  pointer-events:none;
}#kp-btns-1 .bt-gloss .wrap-i{ position:relative; display:inline-flex; align-items:center; gap:10px }#kp-btns-1 .bt-gloss svg{ filter:drop-shadow(0 2px 0 rgba(0,0,0,.15)) }#kp-btns-1 /* 4) Deep blue CTA (download) */
.bt-blue{
  background:linear-gradient(180deg,#0d5bbf,#082c5c);
  border:2px solid #0e2f6c; color:#fff; border-radius:14px;
  padding:12px 20px; box-shadow:0 10px 20px rgba(13,91,191,.35);
}#kp-btns-1 /* 5) Lime chevron (watch now) */
.bt-lime{
  --bg:var(--lime); color:#111827; font-weight:800;
  background:var(--lime); border-radius:8px; padding:12px 18px; position:relative;
  box-shadow:0 10px 20px rgba(201,227,47,.35);
}#kp-btns-1 .bt-lime:after{
  content:""; position:absolute; right:44px; top:0; bottom:0; width:20px;
  background:linear-gradient(90deg,transparent 0, #fff 0, #fff 100%);
  clip-path:polygon(0 0,100% 50%,0 100%);
  opacity:.7;
}#kp-btns-1 .bt-lime .tail{ margin-left:auto; width:18px; height:18px; border:2px solid #111; border-left:none; border-top:none; transform:rotate(-45deg); border-radius:2px }#kp-btns-1 /* 6) Red subscribe with soft shadow */
.bt-sub{
  --bg:#ff2a2a; background:var(--bg); color:#fff; border-radius:999px; padding:12px 22px;
  box-shadow:0 18px 24px rgba(255,42,42,.28);
}#kp-btns-1 .bt-sub .dbl{display:inline-flex; gap:6px; margin-right:4px}#kp-btns-1 .bt-sub .dbl i{width:8px;height:8px;border:2px solid #fff;border-left:none;border-top:none;transform:rotate(-45deg);border-radius:1px}#kp-btns-1 /* 7) Yellow outlined with hand icon */
.bt-outline{
  background:#fff; color:#111; border-radius:999px; padding:14px 26px;
  box-shadow:0 10px 20px rgba(0,0,0,.06); border:6px solid var(--yellow); position:relative;
}#kp-btns-1 .bt-outline:after{
  content:""; position:absolute; inset:7px; border:3px solid #fff; border-radius:999px;
}#kp-btns-1 .hand{ width:28px;height:28px; }#kp-btns-1 /* 8) Gradient book now */
.bt-grad{
  background:linear-gradient(180deg,#1f7be0,#1cb35e); color:#fff; border:none; padding:14px 26px; border-radius:12px;
  box-shadow:0 16px 26px rgba(28,179,94,.28);
}#kp-btns-1 /* 9) Neon glassy set (matrix of examples) */
.row{display:flex;flex-wrap:wrap;gap:10px}#kp-btns-1 .glass{
  --g1:#ff6a88; --g2:#ff99e6; --icon:"";
  background:linear-gradient(90deg,var(--g1),var(--g2));
  color:#fff; border-radius:12px; padding:12px 16px; border:2px solid rgba(255,255,255,.6);
  box-shadow:0 8px 16px rgba(0,0,0,.12), inset 0 -2px 0 rgba(255,255,255,.5);
  font-weight:800; letter-spacing:.2px; display:inline-flex; align-items:center; gap:10px;
}#kp-btns-1 .glass .i{width:18px;height:18px;display:inline-block;border:2px solid #fff;border-radius:3px;transform:rotate(45deg) skew(5deg)}#kp-btns-1 .glass.arrow{clip-path:polygon(0 0, calc(100% - 14px) 0, 100% 50%, calc(100% - 14px) 100%, 0 100%, 14px 50%)}#kp-btns-1 .glass.round{border-radius:999px}#kp-btns-1 .glass .play{width:0;height:0;border-left:10px solid #fff;border-top:6px solid transparent;border-bottom:6px solid transparent;margin-left:2px}#kp-btns-1 .glass .cart{width:18px;height:18px;border:2px solid #fff;border-radius:4px;position:relative}#kp-btns-1 .glass .cart:after{content:"";position:absolute;bottom:-6px;left:2px;width:12px;height:6px;border:2px solid #fff;border-top:none;border-radius:0 0 8px 8px}#kp-btns-1 .glass .bell{width:16px;height:16px;border:2px solid #fff;border-radius:8px 8px 4px 4px;position:relative}#kp-btns-1 .glass .bell:after{content:"";position:absolute;left:50%;bottom:-4px;transform:translateX(-50%);width:4px;height:4px;background:#fff;border-radius:999px}#kp-btns-1 .glass .dl{width:16px;height:16px;border-left:0;border-right:0;border-top:0;border-bottom:2px solid #fff;position:relative}#kp-btns-1 .glass .dl:after{content:"";position:absolute;left:50%;top:-4px;transform:translateX(-50%);width:0;height:0;border-left:6px solid transparent;border-right:6px solid transparent;border-top:8px solid #fff}#kp-btns-1 .glass .heart{width:18px;height:18px;position:relative}#kp-btns-1 .glass .heart:before, #kp-btns-1 .glass .heart:after{content:"";position:absolute;width:10px;height:16px;background:#fff;border-radius:10px 10px 0 0;transform:rotate(-45deg);left:6px;top:2px}#kp-btns-1 .glass .heart:after{transform:rotate(45deg);left:2px}{#kp-btns-1 .wrap{grid-template-columns:1fr 1fr}
}
</style>
<div id="kp-btns-1">
<div class="wrap">

    <div class="section">
      <h2>1) Donate — solid / cut / outline</h2>
      <div class="row">
        <button class="btn bt-solid">
          <svg class="ico" viewBox="0 0 24 24" fill="none"><path d="M12 21s-8-4.6-8-10a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 5.4-8 10-8 10Z" fill="#fff"/></svg>
          Donate
        </button>

        <button class="btn bt-solid-cut">
          <span class="cut">
            <svg class="ico" viewBox="0 0 24 24" fill="none"><path d="M12 21s-8-4.6-8-10a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 5.4-8 10-8 10Z" fill="#ee1d40"/></svg>
          </span>
          Donate
        </button>

        <button class="btn bt-solid white">
          <svg class="ico" viewBox="0 0 24 24" fill="none"><path d="M12 21s-8-4.6-8-10a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 5.4-8 10-8 10Z" fill="#ee1d40"/></svg>
          Donate
        </button>

        <button class="btn bt-solid">
          <span style="width:22px;height:22px;border:3px solid #fff;border-radius:4px;display:inline-block"></span>
          Donate
        </button>
      </div>
    </div>

    <div class="section">
      <h2>2) Speech bubble badge</h2>
      <div class="row">
        <div class="bt-bubble">
          Charity
          <span class="decor"></span>
        </div>
      </div>
    </div>

    <div class="section">
      <h2>3) Glossy red donate</h2>
      <div class="row">
        <button class="btn bt-gloss">
          <span class="wrap-i">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M4 13c0 3 4 6 8 8c4-2 8-5 8-8a5 5 0 0 0-9-3a5 5 0 0 0-7 3z" fill="#fff"/>
              <path d="M14 10c.6-.9 1.6-1.5 2.7-1.5c1.8 0 3.3 1.5 3.3 3.3" stroke="#fff" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            Donate
            <span class="shine"></span>
          </span>
        </button>
      </div>
    </div>

    <div class="section">
      <h2>4) Deep blue CTA</h2>
      <div class="row">
        <button class="btn bt-blue">Download Now</button>
      </div>
    </div>

    <div class="section">
      <h2>5) Lime chevron</h2>
      <div class="row">
        <button class="btn bt-lime">
          Watch Now
          <span class="tail"></span>
        </button>
      </div>
    </div>

    <div class="section">
      <h2>6) Red Subscribe</h2>
      <div class="row">
        <button class="btn bt-sub">
          <span class="dbl"><i></i><i></i></span>
          Subscribe
        </button>
      </div>
    </div>

    <div class="section">
      <h2>7) Yellow outline with hand</h2>
      <div class="row">
        <button class="btn bt-outline">
          <svg class="hand" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="1.6">
            <path d="M3 12c2.5 0 4.5-2 6-2l4 2 3-1c1.5 0 2.5 1 2.5 2.5S17 16 16 16H9l-1 3-2 1-2-2 1-4Z" />
          </svg>
          Click Here
        </button>
      </div>
    </div>

    <div class="section">
      <h2>8) Book now gradient</h2>
      <div class="row">
        <button class="btn bt-grad">
          Book Now
          <span style="width:0;height:0;border-left:12px solid #fff;border-top:7px solid transparent;border-bottom:7px solid transparent"></span>
        </button>
      </div>
    </div>

    <div class="section">
      <h2>9) Neon glassy micro set</h2>
      <div class="row">
        <button class="glass round" style="--g1:#fa7d4c;--g2:#f44369">Contact Us <span class="i" style="border-radius:999px;border-color:#fff"></span></button>
        <button class="glass arrow" style="--g1:#7ad957;--g2:#2ecc71">Upload <span class="i" style="transform:none;border-radius:2px"></span></button>
        <button class="glass round" style="--g1:#9c27b0;--g2:#3f51b5">Read More <span class="i" style="width:0;height:0;border-left:10px solid #fff;border-top:6px solid transparent;border-bottom:6px solid transparent;border:none"></span></button>
        <button class="glass arrow" style="--g1:#4c7dff;--g2:#24a1ff">Read More <span class="i" style="width:0;height:0;border-left:10px solid #fff;border-top:6px solid transparent;border-bottom:6px solid transparent;border:none"></span></button>
        <button class="glass round" style="--g1:#48c6ef;--g2:#6f86d6">Watch Now <span class="play"></span></button>
        <button class="glass round" style="--g1:#f6d365;--g2:#fda085">Buy Now <span class="cart"></span></button>
        <button class="glass arrow" style="--g1:#4cd4a5;--g2:#388e7f">Subscribe <span class="bell"></span></button>
        <button class="glass round" style="--g1:#ff6a88;--g2:#ff99e6">Download <span class="dl"></span></button>
        <button class="glass round" style="--g1:#ffb347;--g2:#ffd452">Donate Now <span class="heart"></span></button>
        <button class="glass arrow" style="--g1:#f06292;--g2:#ec407a">Click Here <span class="i" style="width:0;height:0;border-left:10px solid #fff;border-top:6px solid transparent;border-bottom:6px solid transparent;border:none"></span></button>
      </div>
    </div>

  </div>
</div>
