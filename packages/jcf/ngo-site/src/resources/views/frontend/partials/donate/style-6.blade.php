<style>
:root{
  --don5-primary:#ff4747;
  --don5-accent:#ff8847;
  --don5-bg:#fffaf9;
  --don5-text:#0f172a;
}

.donate-wave{
  margin:70px 0;
  position:relative;
  overflow:hidden;
  background:var(--don5-bg);
  border-radius:24px;
  box-shadow:0 12px 32px rgba(0,0,0,.1);
}

/* animated gradient background wave */
.donate-wave::before{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(135deg,var(--don5-primary),var(--don5-accent));
  opacity:.12;
  clip-path:ellipse(140% 60% at 50% 120%);
  animation:waveShift 8s ease-in-out infinite alternate;
}
@keyframes waveShift{
  0%{ clip-path:ellipse(140% 60% at 50% 120%); }
  100%{ clip-path:ellipse(160% 80% at 50% 100%); }
}

/* inner content */
.donate-wave .inner{
  position:relative;
  z-index:1;
  display:flex;
  flex-wrap:wrap;
  align-items:center;
  justify-content:space-between;
  padding:70px 50px;
  gap:30px;
}

/* text block */
.donate-wave .text{
  flex:1 1 45%;
}
.donate-wave h2{
  font-size:2.1rem;
  font-weight:900;
  color:var(--don5-text);
  margin-bottom:14px;
}
.donate-wave p{
  color:#475569;
  line-height:1.7;
  font-size:1.05rem;
  margin-bottom:26px;
}

/* button */
.donate-wave .btn{
  display:inline-block;
  padding:14px 36px;
  border-radius:40px;
  font-weight:800;
  text-decoration:none;
  color:#fff;
  background:linear-gradient(90deg,var(--don5-primary),var(--don5-accent));
  box-shadow:0 10px 26px rgba(255,71,71,.35);
  transition:transform .25s, box-shadow .25s;
}
.donate-wave .btn:hover{
  transform:translateY(-3px);
  box-shadow:0 16px 36px rgba(255,71,71,.45);
}

/* image side */
.donate-wave .photo{
  flex:1 1 45%;
  border-radius:20px;
  min-height:320px;
  background:url('https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
  position:relative;
  box-shadow:0 10px 28px rgba(0,0,0,.15);
}
.donate-wave .photo::after{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(135deg,rgba(255,71,71,.12),rgba(255,136,71,.12));
  border-radius:inherit;
}

/* responsive */
@media(max-width:880px){
  .donate-wave .inner{ flex-direction:column-reverse; text-align:center; padding:60px 24px; }
  .donate-wave .photo{ width:100%; min-height:260px; }
}
</style>

<section class="donate-wave">
  <div class="inner">
    <div class="text">
      <h2>🌈 Help Us Create Waves of Change</h2>
      <p>
        Your generosity fuels our mission — feeding the hungry, educating children, and  
        restoring hope to families in need. Let’s make compassion go viral. 🌍
      </p>
      <a href="{{url('/user-donate')}}" class="btn">Donate Now</a>
    </div>
    <div class="photo" aria-hidden="true"></div>
  </div>
</section>
