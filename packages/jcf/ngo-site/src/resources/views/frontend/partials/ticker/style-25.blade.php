
<style>
  /* Scoped Mobile Ticker #25 */
  #kp-mtkr-25{--h:54px;--gap:42px;--speed:23s;--ink:#0f172a}
  #kp-mtkr-25,#kp-mtkr-25 *{box-sizing:border-box}
  #kp-mtkr-25 .wrapper{display:flex;flex-direction:column;gap:14px;padding:0;margin:0 auto 24px;max-width:900px}
  #kp-mtkr-25 .tkr{height:var(--h);border-radius:14px;display:flex;align-items:center;overflow:hidden;position:relative;border:1px solid transparent}
  #kp-mtkr-25 .tkr-label{position:relative;z-index:1;min-width:168px;height:100%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;letter-spacing:.3px;text-transform:uppercase;padding:0 12px}
  #kp-mtkr-25 .tkr-body{position:relative;flex:1;height:100%;overflow:hidden}
  #kp-mtkr-25 .tkr-track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:move-25 var(--speed) linear infinite}
  #kp-mtkr-25 .tkr:hover .tkr-track{animation-play-state:paused}
  #kp-mtkr-25 .tkr-item{color:var(--ink);font-size:16px}
  #kp-mtkr-25 .tkr-item a{color:inherit;text-decoration:none}
  #kp-mtkr-25 .tkr-nav{position:absolute;right:10px;top:50%;transform:translateY(-50%);display:flex;gap:10px}
  #kp-mtkr-25 .tkr-btn{width:28px;height:28px;border-radius:8px;border:1px solid #eef2f7;background:#fff;color:inherit;display:flex;align-items:center;justify-content:center;font-weight:800;line-height:1}
  @keyframes move-25{ from{ transform:translate(0,-50%) } to{ transform:translate(-50%,-50%) } }
  /* Theme */
  
  #kp-mtkr-25 .tkr{ background:#eaf2f9; border-color:#e6eef7; border-radius:14px 26px 26px 14px }
  #kp-mtkr-25 .tkr-label{ background:#f15461; border-top-left-radius:14px; border-bottom-left-radius:26px; border-top-right-radius:0; border-bottom-right-radius:26px }
  #kp-mtkr-25 .tkr-btn{ background:transparent; border-color:transparent; color:#f15461 }

  @media (max-width:340px){
    #kp-mtkr-25{ --h:48px; --gap:28px }
    #kp-mtkr-25 .tkr-label{ min-width:140px; font-size:12px }
    #kp-mtkr-25 .tkr-item{ font-size:15px }
  }
</style>

<div id="kp-mtkr-25">
  <div class="wrapper">
    <div class="tkr">
      <div class="tkr-label">News Now</div>
      <div class="tkr-body">
        <div class="tkr-track">
          <span class="tkr-item"><a href="#">How To Make Meet The Team Section In WordPress?</a></span>
          <span class="tkr-item"><a href="#">Members app beta launching this week</a></span>
          <span class="tkr-item"><a href="#">Donation gateway upgraded for UPI</a></span>
          <span class="tkr-item"><a href="#">How To Make Meet The Team Section In WordPress?</a></span>
          <span class="tkr-item"><a href="#">Members app beta launching this week</a></span>
          <span class="tkr-item"><a href="#">Donation gateway upgraded for UPI</a></span>
        </div>
      </div>
      <div class="tkr-nav"><button class="tkr-btn">‹</button><button class="tkr-btn">›</button></div>
    </div>
  </div>
</div>
