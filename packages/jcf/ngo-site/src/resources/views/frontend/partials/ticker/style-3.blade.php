{{-- resources/views/frontend/partials/section/style-3.blade.php --}}
<style>
  #kp-ticker-s3{--h:56px;--gap:28px}
  #kp-ticker-s3,#kp-ticker-s3 *{box-sizing:border-box}
  #kp-ticker-s3 .wrap{background:#18151a;border-radius:12px;padding:10px;max-width:900px;margin:0 auto 24px;box-shadow:0 6px 12px rgba(0,0,0,.12)}
  #kp-ticker-s3 .rail{position:relative;display:flex;align-items:center;overflow:visible}
  #kp-ticker-s3 .live{position:relative;z-index:2;background:#27c5ec;color:#fff;font-weight:900;height:var(--h);padding:0 18px;display:flex;align-items:center;border-radius:18px}
  #kp-ticker-s3 .live:after{content:"";position:absolute;right:-6px;top:50%;width:16px;height:32px;transform:translateY(-50%) rotate(10deg);background:#199fc2;border-radius:6px}
  #kp-ticker-s3 .band{position:relative;flex:1;height:var(--h);margin-left:12px;background:#fff;border-radius:6px;overflow:hidden}
  #kp-ticker-s3 .band:after{content:"";position:absolute;right:-30px;top:0;width:60px;height:var(--h);background:#fff;transform:skewX(-20deg)}
  #kp-ticker-s3 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-s3-scroll 22s linear infinite}
  #kp-ticker-s3 .item{font-weight:700}
  #kp-ticker-s3 .row:hover .track{animation-play-state:paused}
  @keyframes kp-s3-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
</style>
<div id="kp-ticker-s3">
  <div class="wrap">
    <div class="rail">
      <div class="live">Live TV</div>
      <div class="band">
        <div class="row" style="height:var(--h);position:relative">
          <div class="track">
            <span class="item"><a href="#">LOREM IPSUM DOLOR SIT AMET</a></span>
            <span class="item"><a href="#">Parliament session resumes at noon</a></span>
            <span class="item"><a href="#">Weather alert: heavy rainfall expected</a></span>
            <span class="item"><a href="#">LOREM IPSUM DOLOR SIT AMET</a></span>
            <span class="item"><a href="#">Parliament session resumes at noon</a></span>
            <span class="item"><a href="#">Weather alert: heavy rainfall expected</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
