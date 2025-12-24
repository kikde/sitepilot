<style>
.ad-section { margin: 42px 0; }

.ad-split {
  display:flex; align-items:center; gap:18px;
  background:#0f172a; color:#e5e7eb;
  border-radius:18px; padding:18px;
  box-shadow:0 8px 24px rgba(2,6,23,.35);
  overflow:hidden;
}
.ad-split .tile{
  min-width:84px; min-height:84px; border-radius:16px;
  background: radial-gradient(120px 120px at 20% 20%, #22d3ee, transparent 40%),
              radial-gradient(120px 120px at 80% 80%, #6366f1, transparent 45%),
              #111827;
  display:flex; align-items:center; justify-content:center;
  font-size:36px; box-shadow: inset 0 0 0 1px rgba(255,255,255,.08);
}
.ad-split .content{ flex:1; }
.ad-split h4{
  margin:0 0 6px; font-size:1.35rem; font-weight:800; color:#ffffff;
}
.ad-split p{ margin:0 0 12px; color:#c7d2fe; }
.ad-split .btn{
  display:inline-block; padding:10px 18px; border-radius:28px;
  background:linear-gradient(90deg,#22d3ee,#60a5fa);
  color:#0b1220; text-decoration:none; font-weight:800;
  transition: transform .2s, box-shadow .2s;
  box-shadow:0 6px 16px rgba(96,165,250,.35);
}
.ad-split .btn:hover{ transform: translateY(-2px); box-shadow:0 10px 22px rgba(96,165,250,.45); }

@media (max-width:640px){
  .ad-split{ flex-direction:column; text-align:center; }
  .ad-split .tile{ width:96px; height:96px; }
}
</style>

<div class="ad-section">
  <div class="ad-split">
    <div class="tile" aria-hidden="true">📣</div>
    <div class="content">
      <h4>Premium Space for Your Advertisement</h4>
      <p>High visibility. Real audience. Better conversions.</p>
      <a href="#" class="btn">Place Ad Now</a>
    </div>
  </div>
</div>
