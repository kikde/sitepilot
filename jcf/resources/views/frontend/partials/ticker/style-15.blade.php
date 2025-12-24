
<style>
  /* ===== Scoped Mobile Ticker ===== */
  #style-15{--h:56px;--gap:40px;--speed:22s;--ink:#0f172a}
  #style-15,#style-15 *{box-sizing:border-box}
  #style-15 .wrap{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #style-15 .tkr{position:relative;height:var(--h);border-radius:16px;overflow:hidden;display:flex;align-items:center;border:1px solid transparent;background:#fff}
  #style-15 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #style-15 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp15 var(--speed) linear infinite}
  #style-15 .tkr:hover .track{animation-play-state:paused}
  #style-15 .item{color:var(--ink);font-size:16px}
  #style-15 .item a{color:inherit;text-decoration:none}
  #style-15 .label{position:relative;z-index:1;height:100%;min-width:168px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #style-15 .nav{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #style-15 .btn{width:28px;height:28px;border-radius:8px;border:1px solid #e7ecf4;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes kp15{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  /* ===== Variant ===== */
  
  #style-15 .tkr{background:#fff5f1;border:2px solid #fff5f1;border-radius:999px}
  #style-15 .label{background:#ff4300;border-radius:999px;min-width:210px;justify-content:space-between;padding:0 16px}
  #style-15 .label .in-ar{display:flex;gap:10px}
  #style-15 .label .in-ar span{width:20px;height:20px;border-radius:999px;border:2px solid #fff;display:inline-flex;align-items:center;justify-content:center;line-height:1;color:#fff}

  @media(max-width:360px){
    #style-15{--h:52px;--gap:28px}
    #style-15 .label{min-width:140px;font-size:12px}
    #style-15 .item{font-size:15px}
  }
</style>
<div id="style-15">
  <div class="wrap">
    <div class="tkr">
      <div class="label">Latest News <span class="in-ar"><span>‹</span><span>›</span></span></div>
      <div class="body"><div class="track">
          <span class="item"><a href="#">Sample headline one for testing ticker</a></span>
          <span class="item"><a href="#">Another quick update from the team</a></span>
          <span class="item"><a href="#">Mobile friendly and pauses on hover</a></span>
          <span class="item"><a href="#">Sample headline one for testing ticker</a></span>
          <span class="item"><a href="#">Another quick update from the team</a></span>
          <span class="item"><a href="#">Mobile friendly and pauses on hover</a></span>
      </div></div>
      
    </div>
  </div>
</div>
