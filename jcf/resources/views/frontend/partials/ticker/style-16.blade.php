
<style>
  /* ===== Scoped Mobile Ticker ===== */
  #style-16{--h:56px;--gap:40px;--speed:22s;--ink:#0f172a}
  #style-16,#style-16 *{box-sizing:border-box}
  #style-16 .wrap{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #style-16 .tkr{position:relative;height:var(--h);border-radius:16px;overflow:hidden;display:flex;align-items:center;border:1px solid transparent;background:#fff}
  #style-16 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #style-16 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp16 var(--speed) linear infinite}
  #style-16 .tkr:hover .track{animation-play-state:paused}
  #style-16 .item{color:var(--ink);font-size:16px}
  #style-16 .item a{color:inherit;text-decoration:none}
  #style-16 .label{position:relative;z-index:1;height:100%;min-width:168px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #style-16 .nav{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #style-16 .btn{width:28px;height:28px;border-radius:8px;border:1px solid #e7ecf4;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes kp16{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  /* ===== Variant ===== */
  
  #style-16 .tkr{background:#0426ff;border:1px solid #0426ff;color:#cdd5ff;border-radius:4px}
  #style-16 .label{background:#000;min-width:180px;justify-content:flex-start;padding-left:18px}
  #style-16:before,#style-16:after{content:"";position:absolute;top:0;bottom:0;width:16px;background:transparent;border-left:3px solid rgba(255,255,255,.3);transform:skewX(-12deg)}
  #style-16:before{left:170px}
  #style-16:after{right:40px}
  #style-16 .item{color:#eef1ff;font-style:italic}
  #style-16 .btn{background:transparent;border:2px solid #99a7ff;color:#99a7ff}

  @media(max-width:360px){
    #style-16{--h:52px;--gap:28px}
    #style-16 .label{min-width:140px;font-size:12px}
    #style-16 .item{font-size:15px}
  }
</style>
<div id="style-16">
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
