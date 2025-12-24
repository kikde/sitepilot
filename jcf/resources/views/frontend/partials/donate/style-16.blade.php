
<style>
:root{--ink:#0e1a24;--muted:#6c7a87;--line:#eceff3;--orange:#ff6f3d}
*{box-sizing:border-box} 
.card{background:#fff;border:1px solid var(--line);border-radius:18px;padding:12px;box-shadow:0 16px 36px rgba(0,0,0,.08)}
.media{border-radius:12px;overflow:hidden}
.media img{display:block;width:100%;aspect-ratio:4/3;object-fit:cover}
.badge{position:absolute;margin:10px;background:#ff6f3d;color:#fff;border-radius:999px;padding:6px 10px;font-weight:900}
.progress{display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:10px;margin:8px 0}
.bar{height:6px;background:#ffe1d6;border-radius:999px;overflow:hidden;grid-column:1/-1}
.fill{height:100%;width:64%;background:#ff6f3d}
.meta{display:flex;justify-content:space-between;color:#6c7a87;font-weight:900}
h3{margin:10px 0 6px}
p{color:#6c7a87;line-height:1.6;margin:0 0 10px}
.btn{display:inline-block;background:#0e1a24;color:#fff;border:none;border-radius:10px;padding:12px 16px;font-weight:900}
</style>
<div class="wrap">
  <article class="card">
    <div class="media" style="position:relative">
      <span class="badge">Foods</span>
      <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1400&auto=format&fit=crop" alt="">
    </div>
    <div class="progress">
      <div class="meta"><span>Raised : $25,000</span><span>Goal : $30,000</span></div>
      <div class="bar"><div class="fill"></div></div>
    </div>
    <h3>Lifes kills for Children in South African peoples</h3>
    <p>We work together to make a lasting difference, helping people. With kindness and hard work</p>
    <button class="btn">Donate now ↗</button>
  </article>
</div>

