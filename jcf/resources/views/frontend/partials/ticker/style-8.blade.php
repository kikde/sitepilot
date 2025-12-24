{{-- resources/views/frontend/partials/section/style-2.blade.php --}}
<style>
  #kp-ticker-s2{--h:56px;--gap:30px}
  #kp-ticker-s2,#kp-ticker-s2 *{box-sizing:border-box}
  #kp-ticker-s2 .wrap{max-width:900px;margin:0 auto 24px}
  #kp-ticker-s2 .bar{position:relative;background:linear-gradient(180deg,#ff2a2a,#d90000);height:var(--h);border-radius:999px;width:100%;padding-left:12px;box-shadow:0 8px 18px rgba(0,0,0,.18)}
  #kp-ticker-s2 .cap{position:absolute;left:6px;top:-14px;height:48px;padding:0 16px;background:#fff;border-radius:999px;color:#111827;display:flex;align-items:center;font-weight:900;text-transform:uppercase;letter-spacing:.4px}
  #kp-ticker-s2 .body{height:var(--h);margin-left:160px;overflow:hidden}
  #kp-ticker-s2 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-s2-scroll 22s linear infinite}
  #kp-ticker-s2 .row:hover .track{animation-play-state:paused}
  #kp-ticker-s2 .item{color:#fff;font-weight:700;letter-spacing:.2px}
  @keyframes kp-s2-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
</style>
<div id="kp-ticker-s2">
  <div class="wrap">
    <div class="bar">
      <div class="cap">Breaking News</div>
      <div class="body">
        <div class="row" style="position:relative;height:var(--h)">
          <div class="track">
            <span class="item"><a href="#" style="color:#fff;text-decoration:none">LOREM IPSUM DOLOR SIT AMET, CONSECTETUER ADIPISCING</a></span>
            <span class="item"><a href="#" style="color:#fff;text-decoration:none">City derby tonight at 20:30</a></span>
            <span class="item"><a href="#" style="color:#fff;text-decoration:none">New metro line opens Monday</a></span>
            <span class="item"><a href="#" style="color:#fff;text-decoration:none">LOREM IPSUM DOLOR SIT AMET, CONSECTETUER ADIPISCING</a></span>
            <span class="item"><a href="#" style="color:#fff;text-decoration:none">City derby tonight at 20:30</a></span>
            <span class="item"><a href="#" style="color:#fff;text-decoration:none">New metro line opens Monday</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
