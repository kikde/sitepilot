<style>
:root{ --brand:#005bff; --accent:#ff4747; --ink:#0f172a; }

.join-stripe {
  margin:48px 0; border-radius:16px; overflow:hidden; position:relative;
  background:#ffffff; border:1px solid rgba(0,0,0,.06);
  box-shadow:0 10px 24px rgba(0,0,0,.08);
}
.join-stripe .stripe{
  height:10px; background:linear-gradient(90deg,var(--brand),var(--accent));
}
.join-stripe .wrap{
  display:flex; gap:20px; padding:22px 24px; align-items:center;
}
.join-stripe .icon{
  flex:0 0 84px; height:84px; border-radius:14px; display:grid; place-items:center;
  font-size:34px; color:#fff; background:linear-gradient(135deg,var(--brand),var(--accent));
  box-shadow:0 8px 18px rgba(0,91,255,.25);
}
.join-stripe .text{ flex:1; }
.join-stripe h3{ margin:0 0 6px; font-size:1.5rem; font-weight:900; color:var(--ink); }
.join-stripe ul{ margin:8px 0 0 0; padding-left:18px; color:#475569; }
.join-stripe li{ margin:4px 0; }
.join-stripe .cta{
  text-decoration:none; font-weight:800;
  padding:10px 18px; border-radius:28px; color:#fff;
  background:linear-gradient(90deg,var(--brand),var(--accent));
  box-shadow:0 8px 18px rgba(0,91,255,.28);
  white-space:nowrap;
}

@media(max-width:760px){
  .join-stripe .wrap{ flex-direction:column; text-align:center; }
  .join-stripe .cta{ width:100%; }
}
</style>

<section class="join-stripe">
  <div class="stripe" aria-hidden="true"></div>
  <div class="wrap">
    <div class="icon">🤝</div>
    <div class="text">
      <h3>Become a Community Champion</h3>
      <ul>
        <li>Lead or join monthly micro-projects in your area</li>
        <li>Training, resources & volunteer certificate</li>
        <li>Flexible hours — students and professionals welcome</li>
      </ul>
    </div>
    <a href="/join" class="cta">Apply to Join</a>
  </div>
</section>
