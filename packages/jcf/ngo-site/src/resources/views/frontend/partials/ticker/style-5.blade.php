{{-- resources/views/frontend/partials/section/style-5.blade.php --}}
<style>
  #kp-ticker-s5{--h:56px;--gap:28px}
  #kp-ticker-s5,#kp-ticker-s5 *{box-sizing:border-box}
  #kp-ticker-s5 .wrap{position:relative;background:#ffffff;border-radius:6px;overflow:visible;max-width:900px;margin:0 auto 24px;box-shadow:0 6px 12px rgba(0,0,0,.12);padding:8px}
  #kp-ticker-s5 .top{display:flex;align-items:center;height:var(--h)}
  #kp-ticker-s5 .tag{position:relative;background:#ff6a00;color:#fff;font-weight:900;margin-left:8px;height:40px;padding:0 14px;display:flex;align-items:center;transform:skewX(-15deg);border-radius:3px}
  #kp-ticker-s5 .tag span{transform:skewX(15deg)}
  #kp-ticker-s5 .band{flex:1;height:50px;background:#0d6d6a;color:#fff;display:flex;align-items:center;margin-left:10px;border-radius:3px;box-shadow:0 10px 0 rgba(0,0,0,.06);position:relative;overflow:hidden}
  #kp-ticker-s5 .body{height:50px;position:relative}
  #kp-ticker-s5 .track{position:absolute;left:0;top:50%;transform:translateY(-50%);display:inline-flex;gap:var(--gap);white-space:nowrap;animation:kp-s5-scroll 22s linear infinite}
  #kp-ticker-s5 .item{color:#fff;font-weight:800}
  #kp-ticker-s5 .sub{height:34px;background:#ff6a00;color:#fff;display:flex;align-items:center;margin:8px 0 0 24px;width:70%;border-radius:3px;padding:0 10px}
  #kp-ticker-s5 a{color:#fff;text-decoration:none}
  @keyframes kp-s5-scroll{from{transform:translate(0,-50%)}to{transform:translate(-50%,-50%)}}
</style>
<div id="kp-ticker-s5">
  <div class="wrap">
    <div class="top">
      <div class="tag"><span>BREAKING <b>NEWS</b></span></div>
      <div class="band">
        <div class="body">
          <div class="row">
            <div class="track">
              <span class="item"><a href="#">NEWS TITLE TEXT HERE</a></span>
              <span class="item"><a href="#">Cabinet approves new startup incentives</a></span>
              <span class="item"><a href="#">School reopen schedule announced</a></span>
              <span class="item"><a href="#">NEWS TITLE TEXT HERE</a></span>
              <span class="item"><a href="#">Cabinet approves new startup incentives</a></span>
              <span class="item"><a href="#">School reopen schedule announced</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sub">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
  </div>
</div>
