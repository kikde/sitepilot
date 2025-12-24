<style>
  /* Scoped Breaking News Ticker #37 */
  #kp-bn-37 { --height:54px; --speed:24s; --label-bg:#e11d48; --label-fg:#fff; --bar-bg:#fff; --bar-fg:#111827; --border:#e5e7eb }
  #kp-bn-37, #kp-bn-37 * { box-sizing:border-box }
  #kp-bn-37 .bn { display:flex; align-items:stretch; height:var(--height); border-radius:6px; overflow:hidden; background:var(--bar-bg); border:1px solid var(--border); position:relative; box-shadow:0 12px 24px rgba(0,0,0,.12) }
  #kp-bn-37 .bn-label { display:flex; align-items:center; padding:0 18px; font-weight:800; letter-spacing:.3px; background:var(--label-bg); color:var(--label-fg); position:relative; white-space:nowrap }
  #kp-bn-37 .bn-label:after { content:""; position:absolute; right:-14px; top:0; width:0; height:0; border-top: calc(var(--height)/2) solid transparent; border-bottom: calc(var(--height)/2) solid transparent; border-left:14px solid var(--label-bg) }
  #kp-bn-37 .bn-body { flex:1; overflow:hidden; position:relative; padding-left:18px; color:var(--bar-fg); background:var(--bar-bg) }
  #kp-bn-37 .bn-track { position:absolute; left:0; top:50%; transform:translateY(-50%); display:inline-flex; gap:22px; white-space:nowrap; will-change:transform; animation:scroll-37 linear var(--speed) infinite }
  #kp-bn-37 .bn:hover .bn-track { animation-play-state:paused }
  #kp-bn-37 .bn-item { display:inline-flex; align-items:center; gap:10px }
  #kp-bn-37 .bn-sep { opacity:.35 }
  #kp-bn-37 .dot { width:8px; height:8px; border-radius:999px; background:var(--label-bg) }
  @keyframes scroll-37 { from { transform:translate(0,-50%) } to { transform:translate(-50%,-50%) } }
  /* Themes */
  #kp-bn-37.theme-cnn    { --label-bg:#e11d48; --bar-bg:#ffffff; --bar-fg:#111827; --border:#f3f4f6 }
  #kp-bn-37.theme-testimonials { --label-bg:#10b981; --bar-bg:#f8fffb; --border:#34d399 }
  #kp-bn-37.theme-breaking { --label-bg:#f59e0b; --bar-bg:#ffffff; --border:#fcd34d }
  #kp-bn-37.theme-news-blue { --label-bg:#0ea5e9; --bar-bg:#ffffff; --border:#67e8f9 }
  #kp-bn-37.theme-news-orange { --label-bg:#f97316; --bar-bg:#ffffff; --border:#fbbf24 }
  #kp-bn-37.theme-rss { --label-bg:#7c3aed; --bar-bg:#ffffff; --border:#ddd6fe }
  #kp-bn-37.theme-latest { --label-bg:#ef4444; --bar-bg:#ffffff; --border:#fecaca }
  #kp-bn-37.theme-bulletin { --label-bg:#111827; --label-fg:#fff; --bar-bg:#f9fafb; --bar-fg:#111827; --border:#e5e7eb }
  #kp-bn-37.theme-messages { --label-bg:#9ca3af; --bar-bg:#ffffff; --bar-fg:#111827; --border:#e5e7eb }
  #kp-bn-37.theme-breaking-purple { --label-bg:#a855f7; --bar-bg:#ffffff; --border:#d8b4fe }
  
  @media (max-width:380px) {
    #kp-bn-37 { --height:48px }
    #kp-bn-37 .bn-track { gap:18px }
  }
</style>
<div id="kp-bn-37" class="theme-rss">
  <div class="bn ">
    <div class="bn-label">RSS</div>
    <div class="bn-body">
      <div class="bn-track" style="--speed:24s">
            <span class="bn-item"><span class="dot"></span> Maecenas libero ipsum, placerat in mattis vel, tincidunt quis est. <span class="bn-sep">•</span></span>
            <span class="bn-item"><span class="dot"></span> Community kitchen launched in sector 9 <span class="bn-sep">•</span></span>
            <span class="bn-item"><span class="dot"></span> Monthly report published for September <span class="bn-sep">•</span></span>
      </div>
    </div>
  </div>
</div>
