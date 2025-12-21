<style>
  #kp-tkr-s4{--h:56px;--gap:36px;--speed:22s;--ink:#0f172a}
  #kp-tkr-s4,#kp-tkr-s4 *{box-sizing:border-box}
  #kp-tkr-s4 .wrap{max-width:900px;margin:0 auto 24px}
  #kp-tkr-s4 .bar{position:relative;display:flex;align-items:center;gap:10px;height:var(--h);border-radius:14px;overflow:hidden}
  #kp-tkr-s4 .label{flex:0 0 auto;display:flex;align-items:center;justify-content:center;height:100%;min-width:160px;font-weight:900;letter-spacing:.3px;text-transform:uppercase}
  #kp-tkr-s4 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #kp-tkr-s4 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-tkr-s4-scroll var(--speed) linear infinite}
  #kp-tkr-s4 .item a{color:inherit;text-decoration:none}
  #kp-tkr-s4 .bar:hover .track{animation-play-state:paused}
  @keyframes kp-tkr-s4-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  
  #kp-tkr-s4 .bar{background:linear-gradient(90deg,#2193f3,#47d3ff);color:#fff;border-radius:8px;box-shadow:0 10px 26px rgba(2,132,199,.25)}
  #kp-tkr-s4 .label{min-width:120px;background:#111827}
  #kp-tkr-s4 .label:after{content:"LIVE";margin-left:8px;background:#e0103a;color:#fff;font-size:12px;padding:4px 8px;border-radius:4px}
  #kp-tkr-s4 .item{color:#fff}

</style>
<div id="kp-tkr-s4">
  <div class="wrap">
    <div class="bar">
      <div class="label">TV LOGO</div>
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
