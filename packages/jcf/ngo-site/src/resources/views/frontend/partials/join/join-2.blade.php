<style>
:root{
  --brand:#ec058e;
  --accent:#6ab4cf;
}

/* Section wrapper with safe width */
.join-hero-v2{
  margin:48px 0;
  position:relative;
  width:100%;
  min-height:450px;
  background:url('{{asset("backend/uploads/".$setting->site_logo)}}') center/cover no-repeat;
  border-radius:18px;
  overflow:hidden;
  box-shadow:0 12px 30px rgba(0,0,0,.15);
}

/* Stronger overlay so text pops */
.join-hero-v2::before{
  content:"";
  position:absolute; inset:0;
  background:
    /* linear-gradient(180deg, rgba(7,20,46,.72), rgba(7,20,46,.55)), */
    radial-gradient(600px 280px at 50% 40%, rgba(0,91,255,.22), transparent 60%);
}

/* Center container */
.join-hero-v2 .inner{
  position:relative; z-index:1;
  max-width:980px; margin:0 auto; padding:28px 20px;
  display:flex; align-items:center; justify-content:center; min-height:450px;
}

/* Glass card for content */
.join-card{
  background:rgba(255,255,255,.12);
  backdrop-filter: blur(8px);
  border:1px solid rgba(255,255,255,.25);
  border-radius:16px;
  padding:28px 24px;
  text-align:center;
  color:#eaf2ff !important;
  box-shadow:0 10px 26px rgba(0,0,0,.18);
  max-width:720px; width:100%;
}

/* Headline */
.join-card h1{
  margin:0 0 10px;
  font-size:clamp(22px, 3.6vw, 34px);
  font-weight:900; letter-spacing:.3px;
  color: #fff !important;
}

/* Subtext */
.join-card p{
  margin:0 0 18px;
  font-size:clamp(14px, 2.2vw, 18px);
  line-height:1.6; color:#f1f5f9;
}

/* CTA button */
.join-card .btn{
  display:inline-block;
  padding:12px 26px; border-radius:999px;
  background:linear-gradient(90deg, #00a5e2, #ec058e);
  color:#fff; text-decoration:none; font-weight:800;
  box-shadow:0 10px 22px rgba(0,91,255,.35);
  transition:transform .2s, box-shadow .2s;
}
.join-card .btn:hover{ transform:translateY(-2px); box-shadow:0 14px 30px rgba(0,91,255,.45); }

/* Mobile tweaks */
@media (max-width:640px){
  .join-card{ padding:22px 18px; }
}
</style>

<section class="join-hero-v2">
  <div class="inner">
    <div class="join-card">
      <h1>🌿 Be the Change — Join Our NGO</h1>
      <p>
        Volunteer a few hours a week to empower children, support families, and protect our environment.
        Your time can transform lives.
      </p>
      <a href="{{url('/member-registration')}}" class="btn">Member Apply</a>
    </div>
  </div>
</section>
