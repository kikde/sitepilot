{{-- resources/views/frontend/partials/section/style-8b.blade.php --}}
<style>
  #kp-latest-activities,*{box-sizing:border-box}
  #kp-latest-activities .wrap{max-width:420px;width:100%;text-align:center;margin:0 auto 24px}
  #kp-latest-activities .hero{position:relative;border-radius:10px;overflow:hidden}
  #kp-latest-activities .hero img{width:100%;aspect-ratio:4/3;object-fit:cover;display:block;filter:brightness(.6) saturate(.9)}
  #kp-latest-activities .overlay{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;align-items:center;padding:16px;color:#fff}
  #kp-latest-activities h2{position:absolute;top:10px;left:50%;transform:translateX(-50%);font-family:Georgia,'Times New Roman',serif;margin:0}
  #kp-latest-activities .play{width:64px;height:64px;border-radius:999px;background:rgba(255,255,255,.2);backdrop-filter:blur(2px);display:grid;place-items:center;border:3px solid #c2e5d2}
  #kp-latest-activities .location{margin-top:10px;font-weight:800;text-shadow:0 1px 2px rgba(0,0,0,.5)}
  #kp-latest-activities .cta{margin-top:12px;background:#0a5b45;color:#fff;border-radius:6px;padding:12px 16px;text-decoration:none;font-weight:900}
</style>
<div id="kp-latest-activities">
  <div class="wrap">
    <div class="hero">
      <img src="https://images.unsplash.com/photo-1457449940276-e8deed18bfff?q=80&w=1400&auto=format&fit=crop" alt="activity">
      <div class="overlay">
        <h2>Watch Our Latest Activities</h2>
        <div class="play" aria-hidden="true">▶</div>
        <div class="location">2023 – Noida</div>
        <div style="margin-top:8px">Construction of Building for orphan children</div>
        <a class="cta" href="#">Donate Now</a>
      </div>
    </div>
  </div>
</div>
