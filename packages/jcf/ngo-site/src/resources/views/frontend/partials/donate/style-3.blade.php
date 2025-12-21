<style>
:root{
  --donate2-primary:#ff4747;
  --donate2-accent:#ff8847;
  --donate2-text:#0f172a;
}

.donate-large{
  margin:60px 0;
  border-radius:20px;
  overflow:hidden;
  position:relative;
  background:#fff;
  box-shadow:0 10px 30px rgba(0,0,0,.1);
  display:flex;
  flex-wrap:wrap;
  align-items:center;
  justify-content:space-between;
}

/* left: text */
.donate-large .text{
  flex:1 1 50%;
  padding:60px 40px;
  z-index:2;
}

.donate-large h2{
  font-size:2rem;
  font-weight:900;
  color:var(--donate2-text);
  margin-bottom:14px;
}

.donate-large p{
  font-size:1.05rem;
  color:#475569;
  margin-bottom:26px;
  line-height:1.6;
}

.donate-large .btn{
  background:linear-gradient(90deg,var(--donate2-primary),var(--donate2-accent));
  color:#fff;
  padding:14px 34px;
  border-radius:30px;
  font-weight:800;
  text-decoration:none;
  box-shadow:0 10px 24px rgba(255,71,71,.3);
  transition:all .3s ease;
}
.donate-large .btn:hover{
  transform:translateY(-3px);
  box-shadow:0 14px 34px rgba(255,71,71,.4);
}

/* right: image */
.donate-large .photo{
  flex:1 1 45%;
  min-height:320px;
  background:url('https://images.unsplash.com/photo-1603575448368-5f1eac03e3aa?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
  position:relative;
}
.donate-large .photo::after{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(90deg,rgba(255,71,71,.15),rgba(255,136,71,.15));
}

/* responsive */
@media(max-width:860px){
  .donate-large{ flex-direction:column-reverse; text-align:center; }
  .donate-large .photo{ width:100%; min-height:260px; }
  .donate-large .text{ padding:40px 20px; }
}
</style>

<section class="donate-large">
  <div class="text">
    <h2>🌻 Together We Can Heal Lives</h2>
    <p>
      Every donation gives someone hope — food for a hungry child, medicine for the sick, or education for those who dream.
      Your kindness writes new stories every day.
    </p>
    <a href="/donate" class="btn">Donate Now</a>
  </div>
  <div class="photo" aria-hidden="true"></div>
</section>
