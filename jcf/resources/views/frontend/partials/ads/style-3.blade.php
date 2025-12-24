<style>
.ad-section { margin: 42px 0; }

.ad-neon {
  position: relative;
  border-radius: 18px;
  padding: 26px 18px;
  text-align: center;
  color: #fff;
  background: linear-gradient(90deg,#7b2cff,#00d4ff);
  box-shadow: 0 10px 28px rgba(0,0,0,.18);
  overflow: hidden;
}

.ad-neon::before{
  content:"";
  position:absolute; inset:-2px;
  border-radius:20px;
  background: conic-gradient(from 0deg, #7b2cff, #00d4ff, #00ffa3, #ff4d6d, #7b2cff);
  filter: blur(14px);
  z-index:0; opacity:.45; animation: spin 6s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

.ad-neon > * { position: relative; z-index: 1; }

.ad-neon h3{
  margin:0 0 10px; font-size:1.55rem; font-weight:800; letter-spacing:.3px;
}

.ad-neon .cta{
  display:inline-block; padding:11px 22px; border-radius:30px;
  background:#fff; color:#1b1b1b; font-weight:700; text-decoration:none;
  box-shadow: 0 8px 16px rgba(0,0,0,.15);
  transition: transform .25s;
}
.ad-neon .cta:hover{ transform: translateY(-3px) scale(1.03); }

.ad-neon .shine{
  position:absolute; top:0; left:-60%;
  width:60%; height:100%;
  background: linear-gradient(120deg, transparent, rgba(255,255,255,.55), transparent);
  transform: skewX(-20deg); animation: shine 2.8s ease-in-out infinite;
}
@keyframes shine { 0%{ left:-60%; } 50%{ left:120%; } 100%{ left:120%; } }
</style>

<div class="ad-section">
  <div class="ad-neon">
    <span class="shine" aria-hidden="true"></span>
    <h3>🚀 Boost Your Reach — Advertise With Us</h3>
    <a href="#" class="cta">Book Your Slot</a>
  </div>
</div>
