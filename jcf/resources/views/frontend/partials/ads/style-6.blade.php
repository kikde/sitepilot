<style>
/* full hero */
.ad-hero{
  position:relative; border-radius:18px; padding:28px 22px;
  background:#ffffff;
  border:1px solid rgba(0,0,0,.06);
  box-shadow:0 10px 28px rgba(0,0,0,.08);
  overflow:hidden;
  margin:40px 0;
}
.ad-hero .bg{
  position:absolute; inset:-2px;
  background:
    radial-gradient(180px 120px at 15% 30%, rgba(0,91,255,.16), transparent 60%),
    radial-gradient(220px 140px at 85% 70%, rgba(255,71,71,.16), transparent 60%);
  z-index:0;
}
.ad-hero .content{ position:relative; z-index:1; display:flex; gap:18px; align-items:center; }
.ad-hero .badge{
  min-width:96px; height:96px; border-radius:16px;
  background: linear-gradient(135deg, var(--ad-primary), var(--ad-accent));
  color:#fff; display:flex; align-items:center; justify-content:center;
  font-size:38px; box-shadow:0 10px 24px rgba(0,91,255,.25);
  animation: pulse 2.2s ease-in-out infinite;
}
@keyframes pulse{ 0%,100%{ transform:scale(1)} 50%{ transform:scale(1.04)} }

.ad-hero h3{ margin:0 0 6px; font-size:1.6rem; font-weight:900; color:var(--ad-text); }
.ad-hero p{ margin:0 0 14px; color:#334155; }
.ad-hero .cta{
  display:inline-block; border-radius:999px; text-decoration:none; font-weight:800;
  padding:12px 22px; color:#fff;
  background: linear-gradient(90deg, var(--ad-primary), var(--ad-accent));
  box-shadow:0 8px 20px rgba(0,91,255,.28);
  transition: transform .2s, box-shadow .2s;
}
.ad-hero .cta:hover{ transform: translateY(-2px); box-shadow:0 12px 26px rgba(0,91,255,.36); }

@media(max-width:640px){
  .ad-hero .content{ flex-direction:column; text-align:center; }
  .ad-hero .badge{ width:96px; }
}
</style>

<div class="ad-hero">
  <div class="bg" aria-hidden="true"></div>
  <div class="content">
    <div class="badge">📣</div>
    <div class="text">
      <h3>Showcase Your Brand on Our Platform</h3>
      <p>High-impact placement. Great visibility. Better conversions.</p>
      <a href="#" class="cta">Start Advertising</a>
    </div>
  </div>
</div>
