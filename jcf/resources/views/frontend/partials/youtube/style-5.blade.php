{{-- resources/views/frontend/partials/section/style-5.blade.php --}}
<style>
  #kp-hero-hope{--ink:#ffffff;--bg:#0a0f12}
  #kp-hero-hope,#kp-hero-hope *{box-sizing:border-box}
  #kp-hero-hope .hero{position:relative;max-width:420px;width:100%;height:360px;overflow:hidden;border-radius:8px;margin:0 auto 24px}
  #kp-hero-hope .hero::before{content:"";position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,.55),rgba(0,0,0,.55))}
  #kp-hero-hope .hero img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;filter:grayscale(.2)}
  #kp-hero-hope .bar{position:absolute;top:12px;left:12px;right:12px;display:flex;justify-content:space-between;align-items:center;font-weight:900;color:var(--ink)}
  #kp-hero-hope .logo{font-family:'Brush Script MT',cursive;font-size:28px}
  #kp-hero-hope .tools{display:flex;gap:12px}
  #kp-hero-hope .kicker{position:absolute;left:16px;bottom:100px;font-size:28px;line-height:1.15;font-weight:900;max-width:85%;color:var(--ink)}
  #kp-hero-hope .actions{position:absolute;left:16px;bottom:32px;display:flex;align-items:center;gap:12px;color:var(--ink)}
  #kp-hero-hope .play{width:52px;height:52px;border-radius:50%;background:#fff2;border:2px solid #fff;display:grid;place-items:center}
  #kp-hero-hope .play::after{content:'▶';margin-left:3px}
  #kp-hero-hope .txt{font-weight:900}
</style>
<div id="kp-hero-hope">
  <header class="hero" aria-label="Hope video hero">
    <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1200&auto=format&fit=crop" alt="background">
    <div class="bar"><div class="logo">Hope</div><div class="tools">🛒 🔍 ☰</div></div>
    <div class="kicker">Join us in making a difference now</div>
    <div class="actions"><div class="play" aria-hidden="true"></div><div class="txt">WATCH VIDEO</div></div>
  </header>
</div>
