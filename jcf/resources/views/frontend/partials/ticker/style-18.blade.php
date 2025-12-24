<style>
  #kp-tkr-s2{--h:56px;--gap:36px;--speed:22s;--ink:#0f172a}
  #kp-tkr-s2,#kp-tkr-s2 *{box-sizing:border-box}
  #kp-tkr-s2 .wrap{max-width:900px;margin:0 auto 24px}
  #kp-tkr-s2 .bar{position:relative;display:flex;align-items:center;gap:10px;height:var(--h);border-radius:14px;overflow:hidden}
  #kp-tkr-s2 .label{flex:0 0 auto;display:flex;align-items:center;justify-content:center;height:100%;min-width:160px;font-weight:900;letter-spacing:.3px;text-transform:uppercase}
  #kp-tkr-s2 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #kp-tkr-s2 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-tkr-s2-scroll var(--speed) linear infinite}
  #kp-tkr-s2 .item a{color:inherit;text-decoration:none}
  #kp-tkr-s2 .bar:hover .track{animation-play-state:paused}
  @keyframes kp-tkr-s2-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  
  #kp-tkr-s2 .bar{background:linear-gradient(90deg,#ff3b30,#d61b1b);border-radius:999px;box-shadow:0 10px 26px rgba(214,27,27,.25)}
  #kp-tkr-s2 .label{background:#fff;color:#d61b1b;border-radius:999px;margin-left:8px;padding:0 16px}
  #kp-tkr-s2 .item{color:#fff;font-weight:700}

</style>
<div id="kp-tkr-s2">
  <div class="wrap">
    <div class="bar">
      <div class="label">LIVE</div>
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
