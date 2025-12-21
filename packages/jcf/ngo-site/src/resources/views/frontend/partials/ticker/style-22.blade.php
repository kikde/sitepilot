<style>
  #kp-tkr-s6{--h:56px;--gap:36px;--speed:22s;--ink:#0f172a}
  #kp-tkr-s6,#kp-tkr-s6 *{box-sizing:border-box}
  #kp-tkr-s6 .wrap{max-width:900px;margin:0 auto 24px}
  #kp-tkr-s6 .bar{position:relative;display:flex;align-items:center;gap:10px;height:var(--h);border-radius:14px;overflow:hidden}
  #kp-tkr-s6 .label{flex:0 0 auto;display:flex;align-items:center;justify-content:center;height:100%;min-width:160px;font-weight:900;letter-spacing:.3px;text-transform:uppercase}
  #kp-tkr-s6 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #kp-tkr-s6 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-tkr-s6-scroll var(--speed) linear infinite}
  #kp-tkr-s6 .item a{color:inherit;text-decoration:none}
  #kp-tkr-s6 .bar:hover .track{animation-play-state:paused}
  @keyframes kp-tkr-s6-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  
  #kp-tkr-s6 .bar{background:#c4e7ef;border:1px solid #b3dce7;border-radius:10px;padding-right:10px}
  #kp-tkr-s6 .label{background:#ffd21f;color:#111827;border-radius:8px}
  #kp-tkr-s6 .item{color:#0f172a}

</style>
<div id="kp-tkr-s6">
  <div class="wrap">
    <div class="bar">
      <div class="label">Breaking News</div>
      <div class="body">
        <div class="track">
          <span class="item"><a href="#">Sample headline one for testing ticker</a></span>
          <span class="item"><a href="#">Another quick update from the team</a></span>
          <span class="item"><a href="#">Mobile friendly and pauses on hover</a></span>
          <span class="item"><a href="#">Sample headline one for testing ticker</a></span>
          <span class="item"><a href="#">Another quick update from the team</a></span>
          <span class="item"><a href="#">Mobile friendly and pauses on hover</a></span>
        </div>
      </div>
    </div>
  </div>
</div>
