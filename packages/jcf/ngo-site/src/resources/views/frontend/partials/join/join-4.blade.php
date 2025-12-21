<style>
:root{ --brand:#005bff; --accent:#ff4747; --ink:#0f172a; }

.join-wide {
  margin:48px 0; border-radius:16px; overflow:hidden;
  background:#fff; border:1px solid rgba(0,0,0,.06);
  box-shadow:0 10px 24px rgba(0,0,0,.08);
  display:flex; min-height:240px;
}
.join-wide .pic{
  flex:0 0 42%; min-height:240px;
  background:url('https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
}
.join-wide .body{
  flex:1; padding:28px 26px; display:flex; flex-direction:column; justify-content:center;
}
.join-wide h3{ margin:0 0 8px; font-size:1.6rem; font-weight:900; color:var(--ink); }
.join-wide p{ margin:0 0 16px; color:#475569; line-height:1.6; }
.join-wide .meta{ display:flex; gap:14px; flex-wrap:wrap; margin-bottom:16px; }
.join-wide .tag{
  padding:6px 12px; border-radius:999px; font-weight:700; font-size:.85rem;
  background:#eef2ff; color:#334155; border:1px solid #dbeafe;
}
.join-wide .cta{
  align-self:flex-start; text-decoration:none; font-weight:800;
  padding:10px 18px; border-radius:28px; color:#fff;
  background:linear-gradient(90deg,var(--brand),var(--accent));
  box-shadow:0 8px 18px rgba(0,91,255,.28); transition:transform .2s;
}
.join-wide .cta:hover{ transform:translateY(-2px); }

@media(max-width:900px){
  .join-wide{ flex-direction:column; }
  .join-wide .pic{ width:100%; min-height:220px; }
}
</style>

<section class="join-wide">
  <div class="pic" aria-hidden="true"></div>
  <div class="body">
    <h3>Join as a Weekend Volunteer</h3>
    <div class="meta">
      <span class="tag">2–4 hrs/week</span>
      <span class="tag">Local Drives</span>
      <span class="tag">Certificate</span>
    </div>
    <p>Be on-ground for food distributions, school support, cleanliness drives and more. Your time = someone’s smile.</p>
    <a class="cta" href="/join">Join Now</a>
  </div>
</section>
