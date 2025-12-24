<style>
  :root{
    --ink:#0f172a; --muted:#64748b; --brand:#f6c21a; --ink-2:#111827;
    --line:#ececec; --bg:#f8fafc; --card:#ffffff;
  }
  *{box-sizing:border-box}
  body{margin:0; padding:18px; background:var(--bg);
       font-family:"Poppins",system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:var(--ink);
       display:flex; justify-content:center;}
  .wrap{max-width:420px; width:100%;}
  .cause{
    background:var(--card); border:1px solid var(--line);
    box-shadow:0 14px 38px rgba(0,0,0,.08); border-radius:18px; padding:14px;
  }
  .media{
    position:relative; border-radius:16px; overflow:hidden;
  }
  .media img{display:block; width:100%; height:auto; aspect-ratio:16/11; object-fit:cover;}
  /* paint swipe overlay on right */
  .media:after{
    content:""; position:absolute; inset:auto 0 0 65%;
    background:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 220"><path fill="white" d="M110 0c-22 26-38 56-40 86-3 45 32 89 40 134H90c-10-41-45-86-48-126C39 63 73 28 98 0z"/></svg>') no-repeat right bottom/contain;
    opacity:.95; pointer-events:none;
  }
  h3{margin:16px 6px 6px; font-size:1.06rem; line-height:1.35;}
  .desc{margin:0 6px 14px; color:var(--muted); line-height:1.7;}
  /* progress */
  .prog{position:relative; margin:10px 6px 6px; height:10px; background:#f3f4f6; border-radius:999px;}
  .prog .bar{position:absolute; inset:0 auto 0 0; width:78%; background:var(--brand); border-radius:999px;}
  .prog .tag{position:absolute; right:22%; transform:translate(50%,-140%);
            background:#111; color:#fff; font-weight:800; font-size:.72rem; padding:4px 6px; border-radius:4px;}
  .kv{display:grid; grid-template-columns:1fr 1fr; gap:8px; margin:10px 6px 0;}
  .kv small{display:block; color:var(--muted); font-weight:700}
  .kv .right{text-align:right}
  .cta{margin:16px 6px 4px}
  .btn{
    display:inline-flex; align-items:center; gap:10px; padding:14px 18px;
    background:var(--brand); color:#1a1a1a; text-decoration:none; font-weight:800;
    border-radius:999px; box-shadow:0 10px 24px rgba(246,194,26,.35);
  }
</style>
</head>
<body>
  <div class="wrap">
    <article class="cause">
      <div class="media">
        <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?q=80&w=1400&auto=format&fit=crop" alt="Smiling child with donation box">
      </div>

      <h3>Support Learning, Inspire Hope In Africa</h3>
      <p class="desc">Looking For A Restaurant That Serves Delicious, Beautifully Presented Dishes With Impeccable Service.</p>

      <div class="prog">
        <div class="bar"></div>
        <div class="tag">78%</div>
      </div>

      <div class="kv">
        <div><small>Goal :</small> $250,000</div>
        <div class="right"><small>Raised:</small> $500,000</div>
      </div>

      <div class="cta">
        <a class="btn" href="#"><span>Donte Now</span> <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
      </div>
    </article>
  </div>

