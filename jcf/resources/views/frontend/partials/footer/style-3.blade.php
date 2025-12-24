<style>
    :root{
      --panel:#0b5bb5;      /* primary blue block */
      --panel-deep:#0a4ea0; /* deeper blue for depth */
      --ink:#ffffff;        /* main text */
      --muted:#fff !important;      /* soft text */
      --bullet:#b8d3ff;     /* list bullet/line */
      --line:#4f86d9;       /* dotted rule */
      --radius:12px;
    }
    
    
    footer{ width:100%; }
    .wrap{
      max-width:980px;
      margin:0 auto;
      /* padding:18px 16px 26px; */
    }
    .panel{
      background:linear-gradient(180deg,var(--panel),var(--panel-deep));
      border-radius:14px 14px 0 0;
      padding:28px 22px 18px;
      box-shadow:0 -18px 60px rgba(0,0,0,.28) inset;
      border:1px solid #2a6fd0;
    }

      /* Title */
    .title{
      font-weight:800;
      font-size:1.6rem;
      letter-spacing:.3px;
      text-shadow:0 1px 0 rgba(0,0,0,.15);
      margin:0 0 14px;
      color: #fff;
    }

    .meta{
      color: #fff;
      font-size:.98rem;
      margin:2px 0 18px;
    }
    .meta b{ color:#fff; }

    /* Two-column links */
    .links{
      display:grid;
      grid-template-columns:1fr;
      gap:6px 24px;
      margin:12px 0 18px;
      padding-left:18px;
      color: #fff;
    }
    .links li{
      margin:6px 0;
    }
    .links a{
      color: #fff;
      text-decoration:none;
    }
    .links a:hover{ color:#fff; text-decoration:underline; text-underline-offset:3px; }
    @media(min-width:700px){
      .links{ grid-template-columns:1fr 1fr; }
    }

    /* Connect with us icons */
    .connect h4{
      margin:14px 0 10px;
      font-size:1.05rem;
      color: #fff;
    }
    .icons{ display:flex; gap:12px; }
    .ico{
      width:44px;height:44px;border-radius:999px;
      display:grid;place-items:center;
      border:1px solid #ffffff33;
      box-shadow:0 6px 14px rgba(0,0,0,.22), inset 0 2px 8px rgba(255,255,255,.08);
    }
    .ico svg{ width:22px;height:22px; fill:#fff; }
    .fb{ background:radial-gradient(120% 120% at 30% 30%, #4062ff, #2743c7); }
    .tw{ background:radial-gradient(120% 120% at 30% 30%, #5bdcff, #33a9e0); }
    .yt{ background:radial-gradient(120% 120% at 30% 30%, #ff5a5a, #d91616); }
    .ig{ background:conic-gradient(from 30deg, #ffcf33, #ff6a00, #ff2d55, #a439ff, #4facfe, #ffcf33); }

    /* dotted rule + copyright */
    .rule{
      border-top:2px dotted var(--line);
      opacity:.7;
      margin:18px 0 12px;
    }
    .copy{
      color: #fff;
      font-size:.92rem;
      padding-bottom:6px;
    }
  </style>

  <footer>
    <div class="wrap">
      <div class="panel">
        <h3 class="title">{{$setting->title}} NGO Portal</h3>

        <div class="meta">
          Last Updated on : <b>31<sup>st</sup> Aug 2025</b><br/>
          Visitors : <b>278,619</b>
        </div>

        <ul class="links">
          <li>Website Policies</li>
          <li>Disclaimer</li>
          <li>Help</li>
          <li>Terms and Conditions</li>
        </ul>

        <div class="connect">
          <h4>Connect with us</h4>
          <div class="icons">
            <a class="ico fb" href="#" aria-label="Facebook">
              <svg viewBox="0 0 24 24"><path d="M13 22V12h3.5l.5-4H13V6c0-1.1.9-2 2-2h2V1h-3a5 5 0 0 0-5 5v2H6v4h3v10h4z"/></svg>
            </a>
            <a class="ico tw" href="#" aria-label="Twitter">
              <svg viewBox="0 0 24 24"><path d="M22 5.8c-.7.3-1.4.5-2.1.6.8-.5 1.3-1.2 1.6-2.1-.8.5-1.6.8-2.5 1a3.7 3.7 0 0 0-6.4 3.3A10.4 10.4 0 0 1 3.1 4.6a3.7 3.7 0 0 0 1.1 5 3.6 3.6 0 0 1-1.7-.5v.1c0 1.8 1.3 3.3 3 3.7-.3.1-.7.1-1 .1-.2 0-.5 0-.7-.1.5 1.6 2 2.8 3.8 2.8A7.4 7.4 0 0 1 2 18.3 10.4 10.4 0 0 0 7.7 20c6.9 0 10.7-5.7 10.7-10.7v-.5c.7-.6 1.3-1.2 1.6-2z"/></svg>
            </a>
            <a class="ico yt" href="#" aria-label="YouTube">
              <svg viewBox="0 0 24 24"><path d="M23 12s0-3.5-.5-5.1c-.3-1-1-1.8-2-2-1.8-.5-8.5-.5-8.5-.5s-6.7 0-8.5.5c-1 .2-1.7 1-2 2C1 8.5 1 12 1 12s0 3.5.5 5.1c.3 1 1 1.8 2 2 1.8.5 8.5.5 8.5.5s6.7 0 8.5-.5c1-.2 1.7-1 2-2 .5-1.6.5-5.1.5-5.1zM9.8 15.3V8.7L16 12l-6.2 3.3z"/></svg>
            </a>
            <a class="ico ig" href="#" aria-label="Instagram">
              <svg viewBox="0 0 24 24"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-1.75a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg>
            </a>
          </div>
        </div>

        <div class="rule"></div>
        <div class="copy">Copyright @ 2025 {{$setting->site_url}}. | Government of India, All rights reserved.</div>
      </div>
    </div>
  </footer>

