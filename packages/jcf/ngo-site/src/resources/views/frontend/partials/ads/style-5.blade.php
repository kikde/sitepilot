<style>
:root{
  --ad-primary:#005bff;   /* brand blue */
  --ad-accent:#ff4747;    /* accent red */
  --ad-text:#0f172a;
}
.ad-section{ margin:40px 0; }

/* compact ribbon */
.ad-ribbon {
  position: relative;
  border-radius: 14px;
  padding: 16px 14px;
  background: linear-gradient(90deg, var(--ad-accent), var(--ad-primary));
  color:#fff;
  text-align:center;
  box-shadow: 0 8px 22px rgba(0,0,0,.18);
  overflow:hidden;
}
.ad-ribbon .shine{
  position:absolute; inset:0; transform: skewX(-20deg);
  background: linear-gradient(120deg, transparent, rgba(255,255,255,.35), transparent);
  left:-80%; width:50%;
  animation: adshine 3s ease-in-out infinite;
}
@keyframes adshine{ 0%{left:-80%} 60%{left:130%} 100%{left:130%} }

.ad-ribbon h4{
  margin:0 0 8px; font-weight:800; font-size:1.08rem; letter-spacing:.2px;
}
.ad-ribbon .cta{
  display:inline-block; background:#fff; color:var(--ad-primary);
  padding:8px 16px; border-radius:999px; font-weight:700; text-decoration:none;
  transition:transform .2s;
}
.ad-ribbon .cta:hover{ transform: translateY(-2px) scale(1.03); }
</style>

<div class="ad-section">
  <div class="ad-ribbon">
    <span class="shine" aria-hidden="true"></span>
    <h4>Advertise Here — Reach Real Users</h4>
    <a href="#" class="cta">Book a Slot</a>
  </div>
</div>
