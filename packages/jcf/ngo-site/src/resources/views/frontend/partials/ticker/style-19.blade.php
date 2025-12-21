<style>
  #kp-tkr-s3{--h:56px;--gap:36px;--speed:22s;--ink:#0f172a}
  #kp-tkr-s3,#kp-tkr-s3 *{box-sizing:border-box}
  #kp-tkr-s3 .wrap{max-width:900px;margin:0 auto 24px}
  #kp-tkr-s3 .bar{position:relative;display:flex;align-items:center;gap:10px;height:var(--h);border-radius:14px;overflow:hidden}
  #kp-tkr-s3 .label{flex:0 0 auto;display:flex;align-items:center;justify-content:center;height:100%;min-width:160px;font-weight:900;letter-spacing:.3px;text-transform:uppercase}
  #kp-tkr-s3 .body{position:relative;flex:1;height:100%;overflow:hidden}
  #kp-tkr-s3 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-tkr-s3-scroll var(--speed) linear infinite}
  #kp-tkr-s3 .item a{color:inherit;text-decoration:none}
  #kp-tkr-s3 .bar:hover .track{animation-play-state:paused}
  @keyframes kp-tkr-s3-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
  
  #kp-tkr-s3 .bar{background:#ffffff;border:1px solid #dbe2ea}
  #kp-tkr-s3 .label{position:relative;background:#27c5ec;color:#fff;padding:0 18px;border-radius:10px}
  #kp-tkr-s3 .label:after{content:"";position:absolute;right:-8px;top:50%;transform:translateY(-50%) skewX(-15deg);width:16px;height:26px;background:#199fc2;border-radius:4px}
  #kp-tkr-s3 .item{color:#0f172a;font-weight:700}

</style>
<div id="kp-tkr-s3">
  <div class="wrap">
    <div class="bar">
      <div class="label">Live TV</div>
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
