
<style>
  /* ===== Scoped Mobile Ticker ===== */
  #style-12{--h:56px;--gap:40px;--speed:22s;--ink:#0f172a}
  #style-12,#style-12 *{box-sizing:border-box}
  #style-12 .wrap{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #style-12 .tkr{position:relative;height:var(--h);border-radius:16px;overflow:hidden;display:flex;align-items:center;border:1px solid transparent;background:#fff}
  #style-12 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #style-12 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp12 var(--speed) linear infinite}
  #style-12 .tkr:hover .track{animation-play-state:paused}
  #style-12 .item{color:var(--ink);font-size:16px}
  #style-12 .item a{color:inherit;text-decoration:none}
  #style-12 .label{position:relative;z-index:1;height:100%;min-width:168px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #style-12 .nav{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #style-12 .btn{width:28px;height:28px;border-radius:8px;border:1px solid #e7ecf4;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes kp12{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  /* ===== Variant ===== */
  
  #style-12 .tkr{background:linear-gradient(90deg,#5b30db,#5b30db);border:2px solid #5b30db;border-radius:999px;color:#fff}
  #style-12 .label{background:#fff;color:#5b30db;border-radius:999px;margin-left:8px}
  #style-12 .item{color:#fff}
  #style-12 .btn{background:#fff;border-color:#fff;color:#5b30db;border-radius:999px}

  @media(max-width:360px){
    #style-12{--h:52px;--gap:28px}
    #style-12 .label{min-width:140px;font-size:12px}
    #style-12 .item{font-size:15px}
  }
</style>
<div id="style-12">
  <div class="wrap">
    <div class="tkr">
      <div class="label">Recent News</div>
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
