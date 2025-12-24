{{-- resources/views/frontend/partials/test/style-1.blade.php --}}
{{-- Inline-scoped styles (no @push needed). Safe to include inside any page section. --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-campaign-1{--kp-ink:#0e1a24;--kp-muted:#6c7a87;--kp-line:#eceff3;--kp-accent:#ff6f3d;--kp-bg:#fff;color:var(--kp-ink);font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif}
  #kp-campaign-1,#kp-campaign-1 *{box-sizing:border-box}
  #kp-campaign-1 img{max-width:100%!important;height:auto!important;display:block!important}

  #kp-campaign-1 .kp-wrap{max-width:420px;width:100%;margin:0 auto}
  #kp-campaign-1 .kp-card{background:var(--kp-bg);border:1px solid var(--kp-line);border-radius:18px;padding:14px;box-shadow:0 16px 36px rgba(0,0,0,.08)}
  #kp-campaign-1 .kp-media{position:relative;border-radius:14px;overflow:hidden}
  #kp-campaign-1 .kp-media>img{width:100%!important;aspect-ratio:4/3;object-fit:cover!important;border-radius:14px}
  #kp-campaign-1 .kp-badge{position:absolute;top:10px;left:10px;background:var(--kp-accent);color:#fff;border-radius:999px;padding:6px 10px;font-weight:800;line-height:1;font-size:12px;letter-spacing:.2px;z-index:2}

  #kp-campaign-1 .kp-progress{display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:10px;margin:12px 0 8px}
  #kp-campaign-1 .kp-meta{grid-column:1/-1;display:flex;justify-content:space-between;color:var(--kp-muted);font-weight:800;font-size:12px}
  #kp-campaign-1 .kp-bar{grid-column:1/-1;height:8px;background:#ffe1d6;border-radius:999px;overflow:hidden}
  #kp-campaign-1 .kp-fill{height:100%;width:64%;background:var(--kp-accent)}

  #kp-campaign-1 .kp-title{display:block;margin:12px 0 8px!important;font-size:20px!important;line-height:1.28!important;font-weight:800!important;color:var(--kp-ink)!important;letter-spacing:0}
  #kp-campaign-1 .kp-desc{display:block;color:var(--kp-muted)!important;line-height:1.6!important;font-size:14px!important;margin-bottom:14px!important}
  #kp-campaign-1 .kp-btn{display:inline-block;background:var(--kp-ink);color:#fff!important;border:none;border-radius:10px;padding:12px 16px;font-weight:800!important;font-size:14px!important;text-decoration:none!important;transition:transform .15s ease,box-shadow .15s ease;box-shadow:0 6px 16px rgba(14,26,36,.15);cursor:pointer}
  #kp-campaign-1 .kp-btn:hover{transform:translateY(-2px);box-shadow:0 10px 22px rgba(14,26,36,.22)}

  @media (max-width:480px){
    #kp-campaign-1 .kp-card{padding:12px;border-radius:16px}
    #kp-campaign-1 .kp-media{border-radius:12px}
    #kp-campaign-1 .kp-title{font-size:18px!important}
  }
</style>

<div id="kp-campaign-1">
  <div class="kp-wrap">
    <article class="kp-card">
      <div class="kp-media">
        <span class="kp-badge">Foods</span>
        <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1400&auto=format&fit=crop" alt="Food campaign">
      </div>

      <div class="kp-progress">
        <div class="kp-meta">
          <span>Raised : $25,000</span>
          <span>Goal : $30,000</span>
        </div>
        <div class="kp-bar"><div class="kp-fill" style="width:64%"></div></div>
      </div>

      <span class="kp-title">Lifes kills for Children in South African peoples</span>
      <span class="kp-desc">We work together to make a lasting difference, helping people. With kindness and hard work</span>
      <a href="/donate" class="kp-btn">Donate now ↗</a>
    </article>
  </div>
</div>
