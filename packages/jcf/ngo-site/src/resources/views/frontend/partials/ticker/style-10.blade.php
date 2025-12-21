
<style>
  /* ===== Scoped Mobile Ticker ===== */
  #style-10{--h:56px;--gap:40px;--speed:22s;--ink:#0f172a}
  #style-10,#style-10 *{box-sizing:border-box}
  #style-10 .wrap{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #style-10 .tkr{position:relative;height:var(--h);border-radius:16px;overflow:hidden;display:flex;align-items:center;border:1px solid transparent;background:#fff}
  #style-10 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #style-10 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp10 var(--speed) linear infinite}
  #style-10 .tkr:hover .track{animation-play-state:paused}
  #style-10 .item{color:var(--ink);font-size:16px}
  #style-10 .item a{color:inherit;text-decoration:none}
  #style-10 .label{position:relative;z-index:1;height:100%;min-width:168px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #style-10 .nav{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #style-10 .btn{width:28px;height:28px;border-radius:8px;border:1px solid #e7ecf4;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes kp10{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  /* ===== Variant ===== */
  
  #style-10 .tkr{background:#fff;border:1px solid #7f38ff;border-radius:8px}
  #style-10 .label{background:#7f38ff}
  #style-10 .label:before{content:"";position:absolute;left:-10px;top:50%;transform:translateY(-50%);width:20px;height:20px;background:#fff;border-radius:999px;box-shadow:10px 0 0 #7f38ff}

  @media(max-width:360px){
    #style-10{--h:52px;--gap:28px}
    #style-10 .label{min-width:140px;font-size:12px}
    #style-10 .item{font-size:15px}
  }
</style>
<div id="style-10">
  <div class="wrap">
    <div class="tkr">
      <div class="label">Rounded</div>
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
