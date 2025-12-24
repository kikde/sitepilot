{{-- resources/views/frontend/partials/section/style-1.blade.php --}}
<style>
  #kp-ticker-s1{--h:56px;--gap:28px;--ink:#0f172a}
  #kp-ticker-s1,#kp-ticker-s1 *{box-sizing:border-box}
  #kp-ticker-s1 .wrap{background:#2b2f37;border-radius:12px;padding:8px;position:relative;max-width:900px;margin:0 auto 24px}
  #kp-ticker-s1 .rail{display:flex;align-items:center;background:#fff;border-radius:14px;border:2px solid #111827;overflow:hidden}
  #kp-ticker-s1 .label{flex:0 0 auto;background:#ffd21f;color:#111827;font-weight:900;height:var(--h);display:flex;align-items:center;padding:0 16px;position:relative}
  #kp-ticker-s1 .label:after{content:"";position:absolute;right:-18px;top:50%;width:80px;height:40px;background:#ffd21f;transform:translateY(-50%) rotate(-12deg);border-radius:20px}
  #kp-ticker-s1 .body{position:relative;flex:1;height:var(--h);margin-left:24px;margin-right:8px;border-radius:12px;background:#fff;overflow:hidden}
  #kp-ticker-s1 .outline{position:absolute;inset:6px;border-radius:10px;box-shadow:0 0 0 3px #111827;pointer-events:none}
  #kp-ticker-s1 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;will-change:transform;animation:kp-s1-scroll 22s linear infinite}
  #kp-ticker-s1 .row:hover .track{animation-play-state:paused}
  #kp-ticker-s1 .item{font-size:16px;color:var(--ink)}
  #kp-ticker-s1 .item a{color:inherit;text-decoration:none}
  @keyframes kp-s1-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
</style>
<div id="kp-ticker-s1">
  <div class="wrap">
    <div class="rail">
      <div class="label">24 NEWS</div>
      <div class="body">
        <div class="row" style="height:var(--h)">
          <div class="track">
            <span class="item"><a href="#">LOREM IPSUM DOLOR SIT AMET,</a></span>
            <span class="item"><a href="#">Government announces rural health mission</a></span>
            <span class="item"><a href="#">Volunteers needed for flood relief</a></span>
            <span class="item"><a href="#">LOREM IPSUM DOLOR SIT AMET,</a></span>
            <span class="item"><a href="#">Government announces rural health mission</a></span>
            <span class="item"><a href="#">Volunteers needed for flood relief</a></span>
          </div>
        </div>
      </div>
      <span class="outline"></span>
    </div>
  </div>
</div>
