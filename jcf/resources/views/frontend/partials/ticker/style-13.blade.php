
<style>
  /* ===== Scoped Mobile Ticker ===== */
  #style-13{--h:56px;--gap:40px;--speed:22s;--ink:#0f172a}
  #style-13,#style-13 *{box-sizing:border-box}
  #style-13 .wrap{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #style-13 .tkr{position:relative;height:var(--h);border-radius:16px;overflow:hidden;display:flex;align-items:center;border:1px solid transparent;background:#fff}
  #style-13 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #style-13 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp13 var(--speed) linear infinite}
  #style-13 .tkr:hover .track{animation-play-state:paused}
  #style-13 .item{color:var(--ink);font-size:16px}
  #style-13 .item a{color:inherit;text-decoration:none}
  #style-13 .label{position:relative;z-index:1;height:100%;min-width:168px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #style-13 .nav{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #style-13 .btn{width:28px;height:28px;border-radius:8px;border:1px solid #e7ecf4;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes kp13{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  /* ===== Variant ===== */
  
  #style-13 .tkr{background:#fff;border:2px solid #c084fc;border-radius:999px}
  #style-13 .label{background:#c084fc;color:#fff;border-radius:999px;min-width:168px;margin-left:6px}
  #style-13 .btn{background:#fff;border-color:#c084fc;color:#c084fc;border-radius:999px}

  @media(max-width:360px){
    #style-13{--h:52px;--gap:28px}
    #style-13 .label{min-width:140px;font-size:12px}
    #style-13 .item{font-size:15px}
  }
</style>
<div id="style-13">
  <div class="wrap">
    <div class="tkr">
      <div class="label">Braking News</div>
      <div class="body"><div class="track">
          <span class="item"><a href="#">Sample headline one for testing ticker</a></span>
          <span class="item"><a href="#">Another quick update from the team</a></span>
          <span class="item"><a href="#">Mobile friendly and pauses on hover</a></span>
          <span class="item"><a href="#">Sample headline one for testing ticker</a></span>
          <span class="item"><a href="#">Another quick update from the team</a></span>
          <span class="item"><a href="#">Mobile friendly and pauses on hover</a></span>
      </div></div>
      <div class="nav"><button class="btn">‹</button><button class="btn">›</button></div>
    </div>
  </div>
</div>
