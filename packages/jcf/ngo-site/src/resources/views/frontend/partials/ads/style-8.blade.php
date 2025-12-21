<style>
:root{
  --ad-primary:#005bff;
  --ad-accent:#ff4747;
  --ad-text:#0f172a;
}

/* Unique ad section wrapper */
.advert-card{
  position:relative;
  border-radius:18px;
  padding:36px 26px 32px;
  background:#ffffff;
  border:1px solid rgba(0,0,0,.06);
  box-shadow:0 10px 28px rgba(0,0,0,.08);
  overflow:hidden;
  margin:40px auto;
  max-width:440px;
}

.advert-card .ad-bg{
  position:absolute; inset:-2px;
  background:
    radial-gradient(180px 120px at 15% 30%, rgba(0,91,255,.16), transparent 60%),
    radial-gradient(220px 140px at 85% 70%, rgba(255,71,71,.16), transparent 60%);
  z-index:0;
}

.advert-card .ad-inner{
  position:relative;
  z-index:1;
  display:flex;
  flex-direction:column;
  align-items:center;
  text-align:center;
  gap:14px;
}

.advert-card .ad-icon{
  width:92px;
  height:92px;
  border-radius:18px;
  background:linear-gradient(135deg, var(--ad-primary), var(--ad-accent));
  color:#fff;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:46px;
  box-shadow:0 10px 24px rgba(0,91,255,.25);
  animation:adPulse 2.2s ease-in-out infinite;
}
@keyframes adPulse{
  0%,100%{ transform:scale(1)}
  50%{ transform:scale(1.06)}
}

.advert-card .ad-text{
  max-width:90%;
  margin:0 auto;
}

.advert-card .ad-text h3{
  margin:10px 0 8px;
  font-size:1.35rem;
  font-weight:800;
  color:var(--ad-text);
  line-height:1.3;
}
.advert-card .ad-text p{
  margin:0;
  color:#475569;
  font-size:0.95rem;
  line-height:1.4;
}

/* Centered Button */
.advert-card .ad-btn{
  display:inline-block;
  margin-top:20px;
  border-radius:999px;
  text-decoration:none;
  font-weight:700;
  padding:12px 28px;
  color:#fff;
  background:linear-gradient(90deg, var(--ad-primary), var(--ad-accent));
  box-shadow:0 8px 20px rgba(0,91,255,.28);
  transition:transform .2s, box-shadow .2s;
  text-align:center;
}
.advert-card .ad-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 26px rgba(0,91,255,.36);
}

/* Responsive */
@media(max-width:640px){
  .advert-card{
    padding:30px 20px;
  }
  .advert-card .ad-icon{
    width:84px; height:84px;
  }
  .advert-card .ad-text h3{
    font-size:1.2rem;
  }
}
</style>

<div class="advert-card">
  <div class="ad-bg" aria-hidden="true"></div>
  <div class="ad-inner">
    <div class="ad-icon">📣</div>
    <div class="ad-text">
      <h3>Showcase Your Brand on Our Platform</h3>
      <p>High-impact placement. Great visibility. Better conversions.</p>
    </div>
    <a href="#" class="ad-btn">Start Advertising</a>
  </div>
</div>
