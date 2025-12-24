<style>
:root{
  --donate4-primary:#ff4747;
  --donate4-accent:#ff8847;
  --donate4-bg:#fff;
  --donate4-text:#0f172a;
}

.donate-mini{
  margin:45px auto;
  max-width:700px;
  background:var(--donate4-bg);
  border-radius:16px;
  border:1px solid rgba(0,0,0,.06);
  box-shadow:0 8px 22px rgba(0,0,0,.08);
  position:relative;
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:22px 26px;
}

/* gradient stripe accent */
.donate-mini::before{
  content:"";
  position:absolute;
  left:0; top:0; bottom:0;
  width:10px;
  background:linear-gradient(180deg,var(--donate4-primary),var(--donate4-accent));
}

.donate-mini .icon{
  flex:0 0 70px; height:70px;
  border-radius:14px;
  background:linear-gradient(135deg,var(--donate4-primary),var(--donate4-accent));
  color:#fff; font-size:30px; font-weight:900;
  display:flex; align-items:center; justify-content:center;
  box-shadow:0 8px 18px rgba(255,71,71,.35);
  margin-right:20px;
}

.donate-mini .content{
  flex:1;
}

.donate-mini h3{
  margin:0 0 6px;
  font-size:1.35rem;
  font-weight:900;
  color:var(--donate4-text);
}

.donate-mini p{
  margin:0;
  color:#475569;
  font-size:0.95rem;
}

.donate-mini .cta{
  text-decoration:none;
  font-weight:800;
  padding:10px 22px;
  border-radius:999px;
  color:#fff;
  background:linear-gradient(90deg,var(--donate4-primary),var(--donate4-accent));
  box-shadow:0 8px 20px rgba(255,71,71,.3);
  transition:transform .2s, box-shadow .2s;
}
.donate-mini .cta:hover{
  transform:translateY(-3px);
  box-shadow:0 12px 28px rgba(255,71,71,.4);
}

@media(max-width:720px){
  .donate-mini{ flex-direction:column; text-align:center; padding:28px 20px; }
  .donate-mini .icon{ margin:0 0 10px; }
  .donate-mini .cta{ margin-top:14px; }
}
</style>

<div class="donate-mini">
  <div class="icon">💖</div>
  <div class="content">
    <h3>Every Small Act Matters</h3>
    <p>Your ₹100 can fill an empty plate or buy a child’s school kit.</p>
  </div>
  <a href="{{url('/user-donate')}}" class="cta">Donate Now</a>
</div>
 