

<style>
  :root{
    --bg:#faf9f7;
    --card:#ffffff;
    --ink:#222222;
    --muted:#6b7280;
    --brand:#f5b638;     /* warm yellow */
    --brand-dark:#1f1f1f;
    --shadow:0 8px 24px rgba(0,0,0,.08);
    --radius:14px;
  }
  *{box-sizing:border-box}
  body{
    margin:0; padding:22px; background:var(--bg);
    font-family: "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
    color:var(--ink);
  }
  .wrap{ max-width:420px; margin:0 auto; display:grid; gap:22px; }

  .card{
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    border:1px solid #eee8df;
    overflow:hidden;
  }

  .card__inner{
    padding:28px 22px 30px;
    text-align:center;
  }

  /* LIGHT VARIANT (white background) */
  .card--light{ background:var(--card); }
  .card--light .icon{ color:#f3b027; }
  .card--light .title{ color:#1c1c1c; }
  .card--light .desc{ color:var(--muted); }
  .card--light .btn{
    background:#f3b027;
    color:#1f1f1f;
  }

  /* FILLED VARIANT (yellow background) */
  .card--filled{
    background:#f3b027;
  }
  .card--filled .icon{ color:#1f1f1f; }
  .card--filled .title{ color:#1f1f1f; }
  .card--filled .desc{ color:rgba(0,0,0,.75); }
  .card--filled .btn{
    background:#1f1f1f;
    color:#ffffff;
  }

  .icon{
    font-size:42px;
    margin-bottom:14px;
    line-height:1;
  }
  .title{
    margin:0 0 12px 0;
    font-weight:700;
    font-size:1.14rem;
  }
  .desc{
    margin:0 auto 18px;
    max-width:26ch;
    line-height:1.7;
    font-size:.96rem;
  }
  .btn{
    display:inline-block;
    padding:12px 22px;
    border-radius:4px;
    font-weight:800;
    letter-spacing:.5px;
    text-transform:uppercase;
    text-decoration:none;
    box-shadow:0 6px 14px rgba(0,0,0,.08);
  }

  /* Mobile niceties */
  @media (min-width:420px){
    .card__inner{ padding:34px 28px 36px; }
  }
</style>
</head>
<body>
  <div class="wrap">


    <!-- Card 2: Make Donation (Filled) -->
    <article class="card card--filled">
      <div class="card__inner">
        <div class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
        <h3 class="title">Make Donation</h3>
        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        <a class="btn" href="#">Join Now</a>
      </div>
    </article>

  </div>

