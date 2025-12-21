<style>
  #kp-tkr-s7{--h:56px;--gap:36px;--speed:22s;--ink:#0f172a}
  #kp-tkr-s7,#kp-tkr-s7 *{box-sizing:border-box}
  #kp-tkr-s7 .wrap{max-width:900px;margin:0 auto 24px}
  #kp-tkr-s7 .bar{position:relative;display:flex;align-items:center;gap:10px;height:var(--h);border-radius:14px;overflow:hidden}
  #kp-tkr-s7 .label{flex:0 0 auto;display:flex;align-items:center;justify-content:center;height:100%;min-width:160px;font-weight:900;letter-spacing:.3px;text-transform:uppercase}
  #kp-tkr-s7 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #kp-tkr-s7 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-tkr-s7-scroll var(--speed) linear infinite}
  #kp-tkr-s7 .item a{color:inherit;text-decoration:none}
  #kp-tkr-s7 .bar:hover .track{animation-play-state:paused}
  @keyframes kp-tkr-s7-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  
  #kp-tkr-s7 .bar{background:#0426ff;border:1px solid #0426ff;color:#cdd5ff;border-radius:6px}
  #kp-tkr-s7 .label{background:#000;min-width:180px;justify-content:flex-start;padding:0 18px}
  #kp-tkr-s7 .item{color:#eef1ff}

</style>
<div id="kp-tkr-s7">
  <div class="wrap">
    <div class="bar">
      <div class="label">Braking News</div>
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
