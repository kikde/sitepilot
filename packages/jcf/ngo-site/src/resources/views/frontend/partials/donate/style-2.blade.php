<style>
:root{
  --donate1-primary:#ff4747;
  --donate1-accent:#ff8847;
}

.donate-card {
  margin:40px auto;
  max-width:680px;
  background:#fff;
  border-radius:16px;
  border:1px solid rgba(0,0,0,.06);
  box-shadow:0 8px 24px rgba(0,0,0,.08);
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:20px 26px;
  position:relative;
}

.donate-card::before {
  content:"";
  position:absolute;
  inset:0;
  background:linear-gradient(90deg, rgba(255,71,71,.05), rgba(255,136,71,.08));
  z-index:0;
}

.donate-card .icon {
  position:relative;
  z-index:1;
  flex:0 0 68px;
  height:68px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  background:linear-gradient(135deg,var(--donate1-primary),var(--donate1-accent));
  color:#fff;
  font-size:32px;
  box-shadow:0 8px 18px rgba(255,71,71,.35);
}

.donate-card .content {
  position:relative;
  z-index:1;
  flex:1;
  margin-left:20px;
}

.donate-card h3 {
  margin:0 0 6px;
  font-size:1.3rem;
  font-weight:800;
  color:#0f172a;
}

.donate-card p {
  margin:0;
  color:#475569;
  font-size:0.95rem;
}

.donate-card .cta {
  position:relative;
  z-index:1;
  text-decoration:none;
  font-weight:800;
  font-size:0.95rem;
  padding:10px 20px;
  border-radius:30px;
  color:#fff;
  background:linear-gradient(90deg,var(--donate1-primary),var(--donate1-accent));
  box-shadow:0 8px 20px rgba(255,71,71,.3);
  transition:transform .2s, box-shadow .2s;
}

.donate-card .cta:hover {
  transform:translateY(-3px);
  box-shadow:0 12px 28px rgba(255,71,71,.4);
}

@media(max-width:700px){
  .donate-card{ flex-direction:column; text-align:center; gap:14px; }
  .donate-card .content{ margin:0; }
}
</style>

<div class="donate-card">
  <div class="icon">❤️</div>
  <div class="content">
    <h3>Donate & Bring a Smile</h3>
    <p>Even ₹100 can help provide meals, medicine, or education to someone in need.</p>
  </div>
  <a href="{{url('/user-donate')}}" class="cta">Donate Now</a>
</div>
