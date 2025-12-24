{{-- resources/views/frontend/partials/section/style-6.blade.php --}}
<style>
  #kp-ticker-s6{--h:56px;--gap:26px}
  #kp-ticker-s6,#kp-ticker-s6 *{box-sizing:border-box}
  #kp-ticker-s6 .wrap{position:relative;background:#c4e7ef;border-radius:10px;padding:10px 10px 16px 10px;color:#111827;max-width:900px;margin:0 auto 24px;box-shadow:0 6px 12px rgba(0,0,0,.12)}
  #kp-ticker-s6 .top{display:flex;align-items:center;gap:10px}
  #kp-ticker-s6 .badge{flex:0 0 auto;width:60px;height:60px;background:#fff;border:10px solid #ffd21f;border-radius:999px;display:flex;align-items:center;justify-content:center;font-weight:900;line-height:1.05;font-size:14px;text-align:center}
  #kp-ticker-s6 .title{background:#ffd21f;padding:6px 10px;border-radius:3px;font-weight:800}
  #kp-ticker-s6 .card{flex:1;background:#fff;border-radius:4px;box-shadow:0 6px 0 rgba(0,0,0,.2);padding:10px 12px}
  #kp-ticker-s6 .name{font-weight:800}
  #kp-ticker-s6 .role{font-size:12px;color:#6b7280}
  #kp-ticker-s6 .strip{display:flex;align-items:center;gap:8px;height:34px;margin-top:8px}
  #kp-ticker-s6 .time{flex:0 0 auto;background:#000;color:#fff;padding:0 10px;border-radius:3px;display:flex;align-items:center;gap:6px}
  #kp-ticker-s6 .bar{flex:1;background:#e11d2f;color:#fff;border-radius:3px;padding:0 10px;display:flex;align-items:center;gap:10px;overflow:hidden;position:relative}
  #kp-ticker-s6 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-s6-scroll 22s linear infinite}
  #kp-ticker-s6 .dot{width:8px;height:8px;border-radius:999px;background:#ffd21f;display:inline-block;margin-right:6px}
  #kp-ticker-s6 .text{color:#fff}
  @keyframes kp-s6-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
</style>
<div id="kp-ticker-s6">
  <div class="wrap">
    <div class="top">
      <div class="badge">24<br>NEWS</div>
      <span class="title">BREAKING NEWS</span>
      <div class="card">
        <div class="name">Thomas Dane Albert</div>
        <div class="role">Director</div>
        <div class="strip">
          <div class="time">🕒 7:45</div>
          <div class="bar">
            <div class="row" style="height:34px;position:relative">
              <div class="track">
                <span class="text"><span class="dot"></span> Lorem ipsum dolor sit amet consectetur</span>
                <span class="text"><span class="dot"></span> Lorem ipsum</span>
                <span class="text"><span class="dot"></span> New guidelines issued</span>
                <span class="text"><span class="dot"></span> Lorem ipsum dolor sit amet consectetur</span>
                <span class="text"><span class="dot"></span> Lorem ipsum</span>
                <span class="text"><span class="dot"></span> New guidelines issued</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
