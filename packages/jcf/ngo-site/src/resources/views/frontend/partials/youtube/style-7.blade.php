{{-- resources/views/frontend/partials/section/style-7b.blade.php --}}
<style>
  #kp-hero-ctas{}
  #kp-hero-ctas,#kp-hero-ctas *{box-sizing:border-box}
  #kp-hero-ctas .hero{position:relative;max-width:420px;width:100%;height:380px;border-radius:10px;overflow:hidden;margin:0 auto 24px}
  #kp-hero-ctas .hero img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;filter:grayscale(100%)}
  #kp-hero-ctas .hero::after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(0,0,0,.75),rgba(0,0,0,.2) 60%)}
  #kp-hero-ctas .content{position:absolute;left:16px;bottom:28px;color:#fff;max-width:85%}
  #kp-hero-ctas .play{width:56px;height:56px;border-radius:50%;border:3px solid #fff;display:grid;place-items:center;margin-bottom:12px}
  #kp-hero-ctas .play::after{content:'▶';margin-left:3px}
  #kp-hero-ctas h2{margin:0 0 10px;font-weight:900}
  #kp-hero-ctas .ctas{display:flex;gap:10px}
  #kp-hero-ctas .btn{border:none;border-radius:6px;padding:12px 16px;font-weight:900}
  #kp-hero-ctas .red{background:#e33c34;color:#fff}
  #kp-hero-ctas .green{background:#54b64b;color:#fff}
</style>
<div id="kp-hero-ctas">
  <section class="hero">
    <img src="https://images.unsplash.com/photo-1504598318550-17eba1008a68?q=80&w=1200&auto=format&fit=crop" alt="hero">
    <div class="content">
      <div class="play" aria-hidden="true"></div>
      <h2>We were created to reflect God’s love in the world</h2>
      <div class="ctas"><button class="btn red">ABOUT US</button><button class="btn green">VOLUNTEER</button></div>
    </div>
  </section>
</div>
