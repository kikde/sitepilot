
  <style>
    :root{
      --bg:#0f0f10;
      --ink:#e5e7eb;
      --muted:#9ca3af;
      --link:#c9d1ff;
      --accent:#ffffff22;
      --line:#2a2a2b;
      --brand:#ff9f1a;
      --radius:14px;
    }
    /* *{box-sizing:border-box} */
    /* body{
      margin:0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Noto Sans", "EmojiOne Color";
      background:#111827;
      color:var(--ink);
      line-height:1.6;
      display:flex;
      min-height:100vh;
      align-items:flex-end;
    } */
    .footer{
      width:100%;
      background:var(--bg);
      color:var(--ink);
      padding:28px 16px 38px;
      border-top:1px solid var(--line);
      box-shadow:0 -10px 40px rgba(0,0,0,.22) inset;
    }
    .container{
      max-width:980px;
      margin:0 auto;
      text-align:center;
    }

    /* Top link bar */
    .topbar{
      display:flex;
      flex-wrap:wrap;
      justify-content:center;
      gap:.25rem .75rem;
      font-size:.92rem;
      padding:6px 10px 14px;
      border-bottom:1px solid var(--line);
      margin-bottom:16px;
    }
    .topbar a{
      color:var(--ink);
      text-decoration:none;
      opacity:.9;
      padding:2px 6px;
      border-radius:8px;
    }
    .topbar a:hover{ background:var(--accent); }
    .sep{ color:#a1a1aa; opacity:.6; }

    /* Body text */
    .content{
      font-size:.98rem;
      color:var(--muted);
    }
    .content b, .content strong{ color:var(--ink); }
    .content a{
      color:var(--link);
      text-decoration:underline;
      text-underline-offset:3px;
    }

    /* Last updated */
    .updated{
      margin:10px 0 18px;
      font-size:.95rem;
      color:var(--muted);
    }
    .updated b{ color:#fff; }

    /* Logo stack */
    .logos{
      margin-top:6px;
      display:grid;
      gap:16px;
      justify-items:center;
    }
    .logo{
      background:linear-gradient(180deg,#1b1b1c,#121213);
      border:1px solid var(--line);
      border-radius:var(--radius);
      padding:14px 18px;
      width:min(360px,90%);
      box-shadow:0 2px 0 #000 inset, 0 10px 30px rgba(0,0,0,.16);
    }
    .logo img{
      max-width:70px;
      height:auto;
      display:block;
      margin:0 auto;
      /* filter:brightness(0) invert(1) contrast(1.1); */
      opacity:.95;
    }
    .logo small{
      display:block;
      margin-top:6px;
      color:var(--muted);
      font-size:.8rem;
      letter-spacing:.2px;
    }

    /* Fine print */
    .fine{
      margin-top:20px;
      color:#a3a3a3;
      font-size:.88rem;
    }

    /* Responsive tweaks */
    @media (min-width:720px){
      .logos{ grid-template-columns:repeat(3,1fr); }
      .logo{ width:100%; }
    }
  </style>

  <footer class="footer" role="contentinfo">
    <div class="container">
      <nav class="topbar" aria-label="Utility links">
        <a href="#">Feedback</a><span class="sep">|</span>
        <a href="#">Website Policies</a><span class="sep">|</span>
        <a href="#">Contact Us</a><span class="sep">|</span>
        <a href="#">Help</a><span class="sep">|</span>
        <a href="#">Web Information Manager</a><span class="sep">|</span>
        <a href="#">Site Map</a><span class="sep">|</span>
        <a href="#">Copyright Policy</a><span class="sep">|</span>
        <a href="#">Privacy Policy</a><span class="sep">|</span>
        <a href="#">Terms &amp; Condition</a><span class="sep">|</span>
        <a href="#">Login</a>
      </nav>

      <div class="content" aria-label="Ownership">
        Content Owned by <strong>{{$setting->site_url}}</strong><br/>
        Developed and hosted by <a href="#" rel="noopener">{{$setting->meta_author}}</a>,
        <!-- <a href="#" rel="noopener">Ministry of Electronics &amp; Information Technology</a>, Government of India -->
      </div>

      <div class="updated">Last Updated:
        <b>Oct 13, 2025</b>
      </div>

      <div class="logos" aria-label="Platform and programme logos">
        <!-- You can replace src with official logo images or local files -->
        <div class="logo">
          <img src="https://upload.wikimedia.org/wikipedia/en/8/8c/Beti_Bachao_Beti_Padhao_logo.jpg" alt="SwaaS (placeholder)" />
          <small>बेटी बचाओ, बेटी पढ़ाओ</small>
        </div>
        <div class="logo">
          <img src="https://www.uxdt.nic.in/wp-content/uploads/2020/06/Swach-Bharat_Preview.png" alt="NIC (placeholder)" />
          <small>Swachh Bharat</small>
        </div>
        <div class="logo">
          <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/95/Digital_India_logo.svg/1200px-Digital_India_logo.svg.png" alt="Digital India (placeholder)" />
          <small>Digital India</small>
        </div>
      </div>

      <!-- <div class="fine">This is a static HTML replica for demo purposes. Replace links, text, and logos as needed.</div> -->
    </div>
  </footer>

