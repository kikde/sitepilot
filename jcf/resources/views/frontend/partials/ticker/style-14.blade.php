
<style>
  /* ===== Scoped Mobile Ticker ===== */
  #style-14{--h:56px;--gap:40px;--speed:22s;--ink:#0f172a}
  #style-14,#style-14 *{box-sizing:border-box}
  #style-14 .wrap{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #style-14 .tkr{position:relative;height:var(--h);border-radius:16px;overflow:hidden;display:flex;align-items:center;border:1px solid transparent;background:#fff}
  #style-14 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #style-14 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp14 var(--speed) linear infinite}
  #style-14 .tkr:hover .track{animation-play-state:paused}
  #style-14 .item{color:var(--ink);font-size:16px}
  #style-14 .item a{color:inherit;text-decoration:none}
  #style-14 .label{position:relative;z-index:1;height:100%;min-width:168px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #style-14 .nav{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #style-14 .btn{width:28px;height:28px;border-radius:8px;border:1px solid #e7ecf4;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes kp14{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  /* ===== Variant ===== */
  
  #style-14 .tkr{background:#fff;border:2px solid #79a4f6;border-radius:999px}
  #style-14 .label{background:transparent;color:#79a4f6;min-width:150px}
  #style-14 .body:before{content:"";position:absolute;left:150px;top:50%;transform:translateY(-50%);height:60%;width:0;border-left:2px dotted #79a4f6}

  @media(max-width:360px){
    #style-14{--h:52px;--gap:28px}
    #style-14 .label{min-width:140px;font-size:12px}
    #style-14 .item{font-size:15px}
  }
</style>
<div id="style-14">
  <div class="wrap">
    <div class="tkr">
      <div class="label">Hot News</div>
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
