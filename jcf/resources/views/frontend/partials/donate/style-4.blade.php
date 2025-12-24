<style>
:root{
  --donate3-primary:#ff4747;
  --donate3-accent:#ff8847;
  --donate3-text:#0f172a;
}

/* Wrapper */
.donate-diagonal{
  position:relative;
  overflow:hidden;
  border-radius:20px;
  margin:60px 0;
  background:linear-gradient(135deg,#fff 0%,#fff7f4 100%);
  box-shadow:0 12px 32px rgba(0,0,0,.1);
}

/* animated diagonal overlay */
.donate-diagonal::before{
  content:"";
  position:absolute;
  top:-50%; left:-50%;
  width:200%; height:200%;
  background:conic-gradient(from 0deg,var(--donate3-primary),var(--donate3-accent),var(--donate3-primary));
  opacity:.1;
  transform:rotate(-15deg);
  animation:spinGrad 12s linear infinite;
}
@keyframes spinGrad{to{transform:rotate(345deg);}}

/* content layout */
.donate-diagonal .inner{
  position:relative; z-index:1;
  display:flex; align-items:center; justify-content:space-between;
  flex-wrap:wrap; padding:60px 40px;
}

/* left text */
.donate-diagonal .content{
  flex:1 1 48%;
  text-align:left;
}
.donate-diagonal h2{
  font-size:2rem; font-weight:900;
  background:linear-gradient(90deg,var(--donate3-primary),var(--donate3-accent));
  -webkit-background-clip:text; -webkit-text-fill-color:transparent;
  margin:0 0 12px;
}
.donate-diagonal p{
  color:#334155; line-height:1.7; font-size:1.05rem;
  margin:0 0 24px;
}
.donate-diagonal .cta{
  display:inline-block;
  padding:14px 32px; border-radius:999px;
  font-weight:800; text-decoration:none; color:#fff;
  background:linear-gradient(90deg,var(--donate3-primary),var(--donate3-accent));
  box-shadow:0 10px 24px rgba(255,71,71,.35);
  transition:transform .25s, box-shadow .25s;
}
.donate-diagonal .cta:hover{
  transform:translateY(-3px) scale(1.03);
  box-shadow:0 14px 34px rgba(255,71,71,.45);
}

/* right image block (✅ new working image) */
.donate-diagonal .photo{
  flex:1 1 45%;
  min-height:320px;
  border-radius:16px;
  background:url('https://images.unsplash.com/photo-1593113598332-8b2c65a3dc8f?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
  position:relative;
  overflow:hidden;
  box-shadow:0 8px 26px rgba(255,71,71,.25);
}
.donate-diagonal .photo::after{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(135deg,rgba(255,71,71,.15),rgba(255,136,71,.15));
}

/* responsive */
@media(max-width:860px){
  .donate-diagonal .inner{
    flex-direction:column-reverse;
    text-align:center;
    padding:50px 22px;
  }
  .donate-diagonal .photo{
    width:100%; min-height:260px; border-radius:12px;
  }
}
</style>

<section class="donate-diagonal">
  <div class="inner">
    <div class="content">
      <h2>🌟 Your Kindness Creates Ripples of Hope</h2>
      <p>
        Each rupee you donate feeds a family, funds a child’s education,  
        or brings essential healthcare to those in need.  
        Small hearts joining together make big miracles. ❤️
      </p>
      <a href="/donate" class="cta">Donate Now</a>
    </div>
    <div class="photo" aria-hidden="true"></div>
  </div>
</section>
