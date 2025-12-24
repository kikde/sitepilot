
<style>
  /* ===== Scoped Mobile Ticker ===== */
  #style-9{--h:56px;--gap:40px;--speed:22s;--ink:#0f172a}
  #style-9,#style-9 *{box-sizing:border-box}
  #style-9 .wrap{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #style-9 .tkr{position:relative;height:var(--h);border-radius:16px;overflow:hidden;display:flex;align-items:center;border:1px solid transparent;background:#fff}
  #style-9 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #style-9 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp9 var(--speed) linear infinite}
  #style-9 .tkr:hover .track{animation-play-state:paused}
  #style-9 .item{color:var(--ink);font-size:16px}
  #style-9 .item a{color:inherit;text-decoration:none}
  #style-9 .label{position:relative;z-index:1;height:100%;min-width:168px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #style-9 .nav{position:absolute;right:12px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #style-9 .btn{width:28px;height:28px;border-radius:8px;border:1px solid #e7ecf4;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes kp9{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  /* ===== Variant ===== */
  
  #style-9 .tkr{background:#fff;border-color:#ff69b4;border:1px solid #ff69b4}
  #style-9 .label{background:#ff69b4;padding-left:24px}
  #style-9 .label:before,
  #style-9 .label:after{content:"";position:absolute;left:0;top:0;width:18px;height:100%;background:#ff69b4}
  #style-9 .label:after{left:auto;right:-16px;width:0;height:0;top:50%;transform:translateY(-50%);border-top:14px solid transparent;border-bottom:14px solid transparent;border-left:16px solid #fff}

  @media(max-width:360px){
    #style-9{--h:52px;--gap:28px}
    #style-9 .label{min-width:140px;font-size:12px}
    #style-9 .item{font-size:15px}
  }
</style>
<div id="style-9">
  <div class="wrap">
    <div class="tkr">
      <div class="label">Triangle</div>
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
