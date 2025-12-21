
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  :root{
    --ink:#1c2430; --muted:#6b7280; --brand:#f3b027; --line:#efe7db;
    --bg:#ffffff; --pill:#fff6dc;
  }
  *{box-sizing:border-box}
  body{margin:0; padding:22px 16px; background:#faf7f2;
    font-family:"Poppins", system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial; color:var(--ink); display:flex; justify-content:center;}
  .wrap{max-width:420px; width:100%; background:var(--bg); border:1px solid var(--line); border-radius:8px; padding:18px 16px 22px; box-shadow:0 10px 28px rgba(0,0,0,.06);}
  .kicker{color:#f0a700; font-weight:800; letter-spacing:.15em; font-size:.85rem; margin-bottom:6px;}
  h1{margin:0 0 10px 0; font-size:1.8rem; line-height:1.25;}
  .lead{color:var(--muted); margin:0 0 14px 0; line-height:1.75;}
  .bg-hands{position:relative; overflow:hidden;}
  .bg-hands:after{
    content:""; position:absolute; inset:0;
    background:
      radial-gradient(ellipse at 20% 70%, rgba(0,0,0,.02), transparent 60%),
      radial-gradient(ellipse at 80% 40%, rgba(0,0,0,.02), transparent 60%);
    pointer-events:none;
  }
  .list{margin:6px 0 14px 0; display:grid; gap:12px;}
  .list li{list-style:none; display:flex; align-items:flex-start; gap:10px; color:#2a323d;}
  .tick{width:22px; height:22px; border-radius:999px; background:#fff6dc; border:1px solid #f7d580; display:grid; place-items:center; flex:0 0 22px;}
  .tick i{color:#d7a000; font-size:.82rem;}
  .stat{
    margin-top:10px; background:var(--pill); border:1px solid #f7d580; border-radius:4px; padding:18px; display:grid; grid-template-columns:40px 1fr; gap:12px;
  }
  .stat .sicon{width:40px; height:40px; border-radius:8px; display:grid; place-items:center; background:#ffecc2; border:1px solid #f7d580;}
  .stat strong{font-size:1.4rem;}
  .stat small{color:var(--muted); display:block; margin-top:2px;}
  @media (min-width:420px){ h1{font-size:2rem;} }
</style>

  <section class="wrap bg-hands">
    <div class="kicker">About Us</div>
    <h1>We Are In A Mission To<br>Help The Helpness</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris</p>

    <ul class="list">
      <li><span class="tick"><i class="fa-solid fa-check"></i></span>Support people in extreme need</li>
      <li><span class="tick"><i class="fa-solid fa-check"></i></span>Largest global crowdfunding community</li>
      <li><span class="tick"><i class="fa-solid fa-check"></i></span>Make the world a better place</li>
      <li><span class="tick"><i class="fa-solid fa-check"></i></span>Share your love for community</li>
    </ul>

    <div class="stat">
      <div class="sicon"><i class="fa-solid fa-sack-dollar"></i></div>
      <div><strong>70,458</strong><small>Successful Campaigns</small></div>
    </div>
  </section>

