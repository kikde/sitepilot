<style>
  #kp-tkr-s5{--h:56px;--gap:36px;--speed:22s;--ink:#0f172a}
  #kp-tkr-s5,#kp-tkr-s5 *{box-sizing:border-box}
  #kp-tkr-s5 .wrap{max-width:900px;margin:0 auto 24px}
  #kp-tkr-s5 .bar{position:relative;display:flex;align-items:center;gap:10px;height:var(--h);border-radius:14px;overflow:hidden}
  #kp-tkr-s5 .label{flex:0 0 auto;display:flex;align-items:center;justify-content:center;height:100%;min-width:160px;font-weight:900;letter-spacing:.3px;text-transform:uppercase}
  #kp-tkr-s5 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #kp-tkr-s5 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-tkr-s5-scroll var(--speed) linear infinite}
  #kp-tkr-s5 .item a{color:inherit;text-decoration:none}
  #kp-tkr-s5 .bar:hover .track{animation-play-state:paused}
  @keyframes kp-tkr-s5-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  
  #kp-tkr-s5 .bar{background:#0d6d6a;border-radius:8px;color:#fff;box-shadow:0 10px 24px rgba(0,0,0,.15)}
  #kp-tkr-s5 .label{background:#ff6a00;border-radius:8px;padding:0 14px}
  #kp-tkr-s5 .item{color:#fff;font-weight:800}

</style>
<div id="kp-tkr-s5">
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
