{{-- resources/views/frontend/partials/section/style-4.blade.php --}}
<style>
  /* Scoped: Buttons Collection – PURE HTML (no Blade vars) */
  #kp-btns-4, #kp-btns-4 * { box-sizing: border-box }
  #kp-btns-4 { --gap:12px; --panel:#fff; --line:#e8edf5; --pad:12px; margin:18px 0 }
  #kp-btns-4 .wrap { display:grid; gap:16px; grid-template-columns:1fr }
  #kp-btns-4 .section { background: var(--panel); border:1px solid var(--line); border-radius:14px; padding: var(--pad); box-shadow:0 10px 18px rgba(0,0,0,.06) }
  #kp-btns-4 h2 { margin:.2rem 0 .6rem; font-size:16px; color:#334155; font-weight:800; letter-spacing:.3px }
  #kp-btns-4 .row { display:flex; flex-wrap:wrap; gap: var(--gap) }

  /* Base Button */
  #kp-btns-4 .btn{
    --btn-bg:#111827; --btn-fg:#fff; --btn-r:12px;
    appearance:none; border:none; outline:none;
    display:inline-flex; align-items:center; justify-content:center; gap:10px;
    padding:12px 18px; border-radius:var(--btn-r);
    background:var(--btn-bg); color:var(--btn-fg); box-shadow:0 8px 18px rgba(0,0,0,.12);
    cursor:pointer; text-decoration:none; font-weight:900; letter-spacing:.3px; text-transform:uppercase;
    transition:transform .08s ease, filter .2s ease, box-shadow .2s ease, background .2s ease;
  }
  #kp-btns-4 .btn:active{ transform:translateY(1px) scale(.98) }

  /* Sizes / shapes */
  #kp-btns-4 .pill{ border-radius:999px }
  #kp-btns-4 .square{ border-radius:8px }
  #kp-btns-4 .sm{ padding:.55rem .85rem; font-size:.86rem }
  #kp-btns-4 .lg{ padding:.9rem 1.2rem; font-size:1.02rem }
  #kp-btns-4 .xl{ padding:1.05rem 1.4rem; font-size:1.12rem }

  /* Solid palettes */
  #kp-btns-4 .red{ --btn-bg:#ef4444 }
  #kp-btns-4 .pink{ --btn-bg:#ec4899 }
  #kp-btns-4 .purple{ --btn-bg:#8b5cf6 }
  #kp-btns-4 .indigo{ --btn-bg:#6366f1 }
  #kp-btns-4 .blue{ --btn-bg:#3b82f6 }
  #kp-btns-4 .cyan{ --btn-bg:#06b6d4 }
  #kp-btns-4 .emerald{ --btn-bg:#10b981 }
  #kp-btns-4 .yellow{ --btn-bg:#f59e0b; --btn-fg:#111827 }

  /* Gradients */
  #kp-btns-4 .g1{ background:linear-gradient(135deg,#ff4d4d,#ff934d) }
  #kp-btns-4 .g2{ background:linear-gradient(135deg,#6366f1,#22d3ee) }
  #kp-btns-4 .g3{ background:linear-gradient(135deg,#10b981,#84cc16) }
  #kp-btns-4 .g4{ background:linear-gradient(135deg,#06b6d4,#0ea5e9) }

  /* Icon primitives (pure CSS) */
  #kp-btns-4 .play{ width:0; height:0; border-left:12px solid currentColor; border-top:7px solid transparent; border-bottom:7px solid transparent }
  #kp-btns-4 .check{ position:relative; width:18px; height:18px; border:3px solid currentColor; border-radius:4px }
  #kp-btns-4 .check:after{ content:""; position:absolute; left:3px; top:3px; width:8px; height:12px; border-right:3px solid currentColor; border-bottom:3px solid currentColor; transform:rotate(45deg) }
  #kp-btns-4 .arrow-r{ width:0; height:0; border-left:12px solid currentColor; border-top:7px solid transparent; border-bottom:7px solid transparent }
  #kp-btns-4 .cart{ width:18px; height:18px; border:3px solid currentColor; border-radius:4px; position:relative }
  #kp-btns-4 .cart:after{ content:""; position:absolute; bottom:-6px; left:2px; width:12px; height:6px; border:3px solid currentColor; border-top:none; border-radius:0 0 8px 8px }

  /* Two-tone plate */
  #kp-btns-4 .plate{ position:relative; display:inline-flex }
  #kp-btns-4 .plate:after{ content:""; position:absolute; left:8px; right:8px; bottom:-8px; height:8px; border-radius:999px; background:rgba(0,0,0,.15); filter:blur(8px) }
  #kp-btns-4 .b{ --c:#1e88e5; background:#fff; color:var(--c); border:2px solid var(--c); padding:10px 14px 10px 60px; position:relative; border-radius:14px }
  #kp-btns-4 .b .icon{ position:absolute; left:6px; top:6px; bottom:6px; width:44px; background:var(--c); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center }

  /* Download family */
  #kp-btns-4 .circle{ position:absolute; left:6px; top:6px; bottom:6px; width:44px; border-radius:999px; background:currentColor; display:flex; align-items:center; justify-content:center; color:#fff }
  #kp-btns-4 .down{ width:0; height:0; border-left:8px solid transparent; border-right:8px solid transparent; border-top:12px solid currentColor }
  #kp-btns-4 .bar{ height:4px; width:18px; background:currentColor; margin-top:2px; border-radius:2px }

  /* Glassy */
  #kp-btns-4 .glass{ --g1:#ff6a88; --g2:#ff99e6; background:linear-gradient(90deg,var(--g1),var(--g2)); color:#fff; border-radius:12px; padding:12px 16px; border:2px solid rgba(255,255,255,.6); box-shadow:0 8px 16px rgba(0,0,0,.12), inset 0 -2px 0 rgba(255,255,255,.5); font-weight:800; letter-spacing:.2px; display:inline-flex; align-items:center; gap:10px }
  #kp-btns-4 .glass.arrow{ clip-path:polygon(0 0, calc(100% - 14px) 0, 100% 50%, calc(100% - 14px) 100%, 0 100%, 14px 50%) }
  #kp-btns-4 .glass.round{ border-radius:999px }

  @media(min-width:760px){ #kp-btns-4 .wrap{ grid-template-columns:1fr 1fr } }
</style>

<div id="kp-btns-4">
  <div class="wrap">

    <div class="section">
      <h2>Solid &amp; Gradients</h2>
      <div class="row">
        <button class="btn red">Primary</button>
        <button class="btn blue pill">Buy Now</button>
        <button class="btn emerald square">Success</button>
        <button class="btn g1 pill">Hire Us</button>
        <button class="btn g2 lg pill">Get Started</button>
        <button class="btn g3 xl pill">Download</button>
        <button class="btn g4">Explore</button>
      </div>
    </div>

    <div class="section">
      <h2>Two-Tone Plate</h2>
      <div class="row">
        <span class="plate"><button class="btn b" style="--c:#1e88e5"><span class="icon"><span class="arrow-r" style="border-left-color:#fff"></span></span> Download</button></span>
        <span class="plate"><button class="btn b" style="--c:#6d6dfa"><span class="icon"><span class="cart"></span></span> Buy Now</button></span>
        <span class="plate"><button class="btn b" style="--c:#0ea5a6"><span class="icon"><span class="play"></span></span> Watch</button></span>
      </div>
    </div>

    <div class="section">
      <h2>Blue Download</h2>
      <div class="row">
        <button class="btn square" style="position:relative; padding-left:60px; color:#1a52ff; background:#fff; border:3px solid #1a52ff">
          <span class="circle" style="color:#1a52ff"></span>
          Free Download
        </button>
        <button class="btn pill" style="background:linear-gradient(180deg,#33a1ff,#1a52ff)">Free Download</button>
        <button class="btn pill" style="background:linear-gradient(180deg,#1a52ff,#1544d6)">Download Now</button>
        <button class="btn pill" style="background:#fff; color:#1a52ff; border:3px solid #1a52ff">Get File</button>
      </div>
    </div>

   <div class="section">
      <h2>Neon Glassy</h2>
      <div class="row">
        <button class="glass round" style="--g1:#fa7d4c;--g2:#f44369">Contact Us <span class="check" style="border-color:#fff"></span></button>
        <button class="glass arrow" style="--g1:#7ad957;--g2:#2ecc71">Upload <span class="check" style="transform:none;border-radius:2px;border-color:#fff"></span></button>
        <button class="glass round" style="--g1:#48c6ef;--g2:#6f86d6">Watch Now <span class="play"></span></button>
      </div>
    </div>

  </div>
</div>
