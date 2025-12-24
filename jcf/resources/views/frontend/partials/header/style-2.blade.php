<style>
  :root{
    --green:#ec058e;
    --saffron:#6ab4cf;
    --ink:#111827;
    --line:#e5e7eb;
    --shadow:0 8px 24px rgba(0,0,0,.08);

    /* JS updates these so sticky bars stack perfectly */
    --gsH: 40px;      /* gov-strip height fallback */
    --headerH: 120px; /* header height fallback */
  }

  /* =============== GOV STRIP (TOP) =============== */
  .gov-strip{
    position: sticky;
    top: 0;
    z-index: 10003; /* above backdrop(10001)/drawer(10002) */
    background: linear-gradient(90deg, var(--saffron), #ec058e);
    color:#fff;
    font-size:12px;
    line-height:1.2;
    width:100%;
    box-sizing:border-box;
    overflow:visible;
  }
  /* Safer container + side padding */
  .gov-strip .row{
    display:flex; align-items:center; flex-wrap:wrap;
    gap:12px;
    padding:10px 18px;
    max-width:1300px;
    margin:0 auto;
    position:relative;
  }

  /* Left/Right groups */
  .gov-left{ display:flex; align-items:center; gap:12px; flex-wrap:wrap; min-width:0; }
  .gov-right{ margin-left:auto; display:flex; align-items:center; gap:10px; }

  

  /* Login button */
  .gov-login{
    display:inline-flex; align-items:center; gap:8px;
    color:#fff; text-decoration:none; font-weight:700;
    padding:8px 14px; border-radius:999px;
    background:#e18c25;
    border:1px solid rgba(255,255,255,.35);
    transition:transform .15s ease, filter .2s ease;
    box-shadow:0 4px 12px rgba(0,0,0,.15);
  }
  .gov-login:hover{ transform:translateY(-1px); filter:brightness(1.05); }
  .gov-login i{ font-size:14px; line-height:1; color:#fff; }

  /* =============== HEADER (MIDDLE) =============== */
  .boxed_wrapper{ overflow:visible !important; position:relative; }
  .header{
    background:#fff;
    box-shadow:var(--shadow);
    position: sticky;
    top: var(--gsH);          /* sits below gov strip */
    z-index:10000;
    border-bottom:1px solid var(--line);
  }
  .header .bar{
    display:grid;
    grid-template-columns:auto 1fr auto;
    align-items:center; gap:12px; padding:10px 14px;
  }
  .brand{ display:flex; align-items:center; gap:10px; text-decoration:none; color:inherit; }
  .brand img{ height:100px; width:auto; max-width:100%; object-fit:contain; }
 .center-emblem {
  justify-self: center;
  display: flex;
  align-items: center;
  justify-content: center;  /* center horizontally */
  text-align: center;
}

/* Style the trust name text */
.center-emblem {
  font-family: 'Noto Serif Devanagari', 'Poppins', sans-serif;
  color: #230c74; /* deep blue title color */
  font-weight: 700; /* make it bold */
  font-size: 29px; /* adjust size as needed */
  /*text-shadow: 1px 1px 3px #ffaa01; */
  letter-spacing: 0.5px; /* spacing for clarity */
  line-height: 1.3;
}

/* Optional: add responsive adjustment */
@media (max-width: 768px) {
  .center-emblem {
    font-size: 25px !important;
  }
}


  .hambox{ justify-self:end; }
  .hamburger{
    height:42px; width:54px; border:1px solid var(--line);
    background:#fff; border-radius:10px; display:grid; place-items:center;
    cursor:pointer; box-shadow:0 2px 6px rgba(0,0,0,.06);
  }
  .hamburger span{ display:block; width:26px; height:2px; background:#334155; position:relative; }
  .hamburger span::before, .hamburger span::after{
    content:""; position:absolute; left:0; width:26px; height:2px; background:#334155;
    transition:transform .25s ease, top .25s ease, opacity .2s ease;
  }
  .hamburger span::before{ top:-8px; }
  .hamburger span::after{ top:8px; }
  .hamburger.is-active span{ background:transparent; }
  .hamburger.is-active span::before{ top:0; transform:rotate(45deg); }
  .hamburger.is-active span::after{ top:0; transform:rotate(-45deg); }

  /* Drawer/backdrop */
  .hv2-backdrop{
    position:fixed; inset:0; background:rgba(0,0,0,.45);
    opacity:0; pointer-events:none; transition:opacity .25s ease;
    z-index:10001;
  }
  .hv2-drawer{
    position:fixed; top:0; left:0; height:100dvh; width:min(86vw,360px);
    background:#fff; box-shadow:10px 0 30px rgba(0,0,0,.18);
    transform:translateX(-100%); transition:transform .28s ease;
    display:flex; flex-direction:column; z-index:10002;
  }
  .header.is-drawer-open { z-index:1; }

  .drawer-head{
    padding:14px 16px; display:flex; align-items:center; justify-content:space-between;
    border-bottom:1px solid var(--line);
  }
  .drawer-head b{ font-size:16px; }
  .drawer-close{
    border:none; background:#f1f5f9; width:36px; height:36px; border-radius:10px; font-size:18px; cursor:pointer;
  }
  .drawer-body{ padding:6px 12px 18px; overflow:auto; }
  .hv2-menu{ list-style:none; margin:0; padding:0; font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; font-size:16px; color:#0f172a; font-weight:600; }
  .hv2-menu > li{ border:1px solid var(--line); border-radius:12px; margin:8px 0; overflow:hidden; }
  .hv2-menu .menu-row{
    display:flex; align-items:center; justify-content:space-between; padding:14px 12px;
    background:#fff; text-decoration:none; color:#0f172a; line-height:1.3; cursor:pointer;
  }
  .hv2-menu .menu-row a{ flex:1; text-decoration:none; color:#0f172a; }
  .hv2-menu .toggle{
    border:none; background:#f8fafc; border-left:1px solid var(--line); border-radius:8px;
    width:36px; height:32px; font-size:16px; line-height:1; cursor:pointer; margin-left:8px; flex-shrink:0;
  }
  .hv2-menu .sub{ display:none; background:#f9fafb; border-top:1px solid var(--line); padding:8px 12px; }
  .hv2-menu .sub a{ display:block; text-decoration:none; color:#334155; font-weight:500; font-size:15px; padding:8px 0; line-height:1.4; }
  .hv2-menu .sub a.current{ color:#0a7bd4; font-weight:600; }

  .contact{ border-top:1px solid var(--line); margin-top:18px; padding-top:12px; font-size:14px; color:#475569; line-height:1.5; }
  .contact a{ color:#0a7bd4; text-decoration:none; word-break:break-word; }

  @media (max-width:420px){ .brand img{ height:44px; } }

  /* =============== SOCIAL STRIP (BOTTOM OF STACK) =============== */
  .strip{
    position: sticky;
    top: calc(var(--gsH) + var(--headerH)); /* sits under gov + header */
    z-index: 9999; /* below drawer/backdrop, above content */
    background: linear-gradient(90deg,var(--saffron),#ec058e);
    color:#fff; border-bottom:0; box-shadow: var(--shadow); width:100%;
  }
  .strip .row{ display:flex; align-items:center; gap:12px; padding:8px 12px; }
  .strip .container{ max-width:1200px; margin:0 auto; width:100%; }
  .strip .socials{ display:flex; gap:10px; align-items:center; }
  .strip .social .fab{
    display:grid; place-items:center; width:36px; height:36px; border-radius:999px;
    background: rgba(255,255,255,.18); border:1px solid rgba(255,255,255,.35);
    transition:transform .15s ease, background .2s ease, border-color .2s ease;
    color:#fff; line-height:0 !important;
  }
  .strip .social:hover{ transform:translateY(-2px); background:rgba(255,255,255,.28); border-color:rgba(255,255,255,.5); }
  .strip .spacer{ flex:1; }
  .donate-outline{
     color:#fff; background:var(--c);
    padding:10px 16px; border-radius:999px; text-decoration:none; font-weight:700;
    border:4px solid #ffc107;
    animation:donatePulse 0.8s ease-in-out infinite;
  }
  @keyframes donatePulse{
    0%{ transform:scale(1); box-shadow:0 8px 18px rgba(0,0,0,.12); }
    50%{ transform:scale(0.96); box-shadow:0 6px 12px rgba(0,0,0,.08); }
    100%{ transform:scale(1); box-shadow:0 8px 18px rgba(0,0,0,.12); }
  }

  /* =============== GOOGLE TRANSLATE VISIBILITY =============== */
  


/* Keep language block above other UI */
.lang-switch{ position:relative; z-index:10004; display:flex; align-items:center; gap:8px; }



/* keep the page from being pushed down */
    body { top: 0 !important; }

    /* hide Google's bars/tooltips/logo like in the CodePen */
    body > .skiptranslate,
    .goog-logo-link,
    .gskiptranslate,
    .goog-te-gadget span,
    .goog-te-banner-frame,
    #goog-gt-tt,
    .goog-te-balloon-frame,
    div#goog-gt-tt {
      display: none !important;
    }

    .goog-te-gadget {
      color: transparent !important;
      font-size: 0;
    }

    .goog-text-highlight {
      background: transparent !important;
      box-shadow: none !important;
    }

    /* style the dropdown */
    #google_translate_element select {
      background: linear-gradient(90deg,#6ab4cf,#00a5e2);
      border: 1px solid rgba(255,255,255,.45);
      border-radius: 10px;
      box-shadow: 0 6px 16px rgba(0,0,0,.15);
      color: #fff !important; /* select text color black */
      font-weight: bold;
      overflow: visible;
      padding: 8px 12px;
    }

    /* Ensure the option text is also black (and override inline/google styles) */
    #google_translate_element select option {
      color: #000 !important;
      background: transparent;
    }

</style>

<!-- ======= GOV STRIP ======= -->
<div class="gov-strip">
  <div class="row">
    <div class="lang-switch">
      
        <!-- <span class="gt-label">Select Language</span> -->
        <div id="google_translate_element"></div>
      
    </div>

    <div class="gov-right">
      <a class="gov-login" href="{{ route('login') }}">
        <i class="flaticon-home"></i>
        <span>Login</span>
      </a>
    </div>
  </div>

  <!-- holder for google iframe -->
  <div id="google_translate_frame_holder"></div>
</div>



<!-- ======= HEADER ======= -->
<header class="header">
  <div class="bar">
    <a class="brand" href="{{ url('/') }}">
      <img src="{{ asset('backend/uploads/'.$setting->site_logo) }}" alt="Emblem">
    </a>
    <div class="center-emblem">
    {{$setting->title}}
     {{-- <img src="https://cds.edu/wp-content/uploads/G20-theme-and-logo-e1676954367274.png" alt="G20">--}}
    </div>
    <div class="hambox">
      <button class="hamburger" id="hv2Btn" aria-label="Open menu" aria-expanded="false" aria-controls="hv2Drawer">
        <span></span>
      </button>
    </div>
  </div>
</header>

<!-- ======= SOCIAL STRIP ======= -->
<div class="strip">
  <div class="row container">
    <div class="socials">
      <a class="social" href="{{ $setting->facebook_url }}" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a class="social" href="{{ $setting->insta_url }}" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <a class="social" href="{{ $setting->youtube }}" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      <a class="social" href="{{ $setting->twitter }}" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
    </div>
    <div class="spacer"></div>
    <a href="{{ url('/user-donate') }}" class="donate-outline" id="donateBtn"><i class='bx bx-donate-heart'></i>Donate</a>
  </div>
</div>

<!-- Drawer Backdrop -->
<div class="hv2-backdrop" id="hv2Backdrop"></div>

<!-- Drawer Panel -->
<aside class="hv2-drawer" id="hv2Drawer" aria-hidden="true">
  <div class="drawer-head">
    <b>Menu</b>
    <button class="drawer-close" id="hv2Close" aria-label="Close">×</button>
  </div>
  <div class="drawer-body">
    <ul class="hv2-menu" id="hv2Menu">
      <li><div class="menu-row"><a href="{{ url('/') }}">Home</a></div></li>
      <li>
        <div class="menu-row">
          <a href="{{ url('/about') }}">About</a>
          <button class="toggle" type="button" aria-expanded="false" aria-controls="sub-about">▾</button>
        </div>
        <div class="sub" id="sub-about">
          <a href="{{ url('/news-post') }}">Breaking News</a>
          <a href="{{ url('/success-story') }}">Media Coverage</a>
          <a href="{{ url('/terms-and-conditions') }}">Terms &amp; Conditions</a>
          <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
          <a href="{{ url('/faq') }}">Faq's</a>
          <a href="{{ url('/cancellation-and-refund-policy') }}">Cancellations & Refunds Policy</a>
        </div>
      </li>
      <li><div class="menu-row"><a href="{{ url('our-management-body') }}">Management Team</a></div></li>
      <li><div class="menu-row"><a href="{{ url('/our-donors') }}">Donors</a></div></li>
      <li><div class="menu-row"><a href="{{ url('/our-members') }}">Members</a></div></li>
      <li>
        <div class="menu-row">
          <span>Objective</span>
          <button class="toggle" type="button" aria-expanded="false" aria-controls="sub-objective">▾</button>
        </div>
        <div class="sub" id="sub-objective">
          @foreach($secmenu as $items)
            @if($items->pagestatus == "Published")
              <a class="{{ Request::is('objective-details/*') ? 'current' : '' }}"
                 href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">
                {{$items->sector_name}}
              </a>
            @endif
          @endforeach
        </div>
      </li>
        <li>
        <div class="menu-row">
          <a href="#">Gallery</a>
          <button class="toggle" type="button" aria-expanded="false" aria-controls="sub-gallery">▾</button>
        </div>
        <div class="sub" id="sub-gallery">
          <a href="{{ url('/photo-gallery') }}">Photo Gallery</a>
          <a href="{{ url('/video-gallery') }}">Video Gallery</a>
        </div>
      </li>
      <li><div class="menu-row"><a href="{{ url('/contact') }}">Contact Us</a></div></li>
    </ul>
    <div class="contact">
      <p><b>Address:</b> {{$setting->address}}</p>
      <p><b>Phone:</b> <a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></p>
      <p><b>Email:</b> <a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></p>
    </div>
  </div>
</aside>



<script>
/* Drawer logic */
(function(){
  const btn       = document.getElementById('hv2Btn');
  const drawer    = document.getElementById('hv2Drawer');
  const backdrop  = document.getElementById('hv2Backdrop');
  const closeBtn  = document.getElementById('hv2Close');
  const toggles   = drawer.querySelectorAll('.toggle');
  const header    = document.querySelector('.header');

  function openDrawer(){
    drawer.style.transform = 'translateX(0)';
    backdrop.style.opacity = '1';
    backdrop.style.pointerEvents = 'auto';
    btn.classList.add('is-active');
    btn.setAttribute('aria-expanded','true');
    drawer.setAttribute('aria-hidden','false');
    document.body.style.overflow='hidden';
    if (header) header.classList.add('is-drawer-open');
  }
  function closeDrawer(){
    drawer.style.transform = 'translateX(-100%)';
    backdrop.style.opacity = '0';
    backdrop.style.pointerEvents = 'none';
    btn.classList.remove('is-active');
    btn.setAttribute('aria-expanded','false');
    drawer.setAttribute('aria-hidden','true');
    document.body.style.overflow='';
    if (header) header.classList.remove('is-drawer-open');
  }

  btn.addEventListener('click', () => btn.classList.contains('is-active') ? closeDrawer() : openDrawer());
  backdrop.addEventListener('click', closeDrawer);
  closeBtn.addEventListener('click', closeDrawer);
  document.addEventListener('keydown', e => { if(e.key==='Escape') closeDrawer(); });

  toggles.forEach(tg => {
    tg.addEventListener('click', e => {
      e.stopPropagation();
      const expanded = tg.getAttribute('aria-expanded') === 'true';
      const panelId  = tg.getAttribute('aria-controls');
      const panel    = document.getElementById(panelId);
      tg.setAttribute('aria-expanded', expanded ? 'false' : 'true');
      if(panel){ panel.style.display = expanded ? 'none' : 'block'; }
    });
  });
})();

/* Measure gov-strip and header heights so sticky offsets stack perfectly */
(function measureBars(){
  const gov = document.querySelector('.gov-strip');
  const header = document.querySelector('.header');
  function apply(){
    const gsH = gov ? gov.offsetHeight : 0;
    const hH  = header ? header.offsetHeight : 0;
    document.documentElement.style.setProperty('--gsH', gsH + 'px');
    document.documentElement.style.setProperty('--headerH', hH + 'px');
  }
  ['load','resize'].forEach(evt => window.addEventListener(evt, () => requestAnimationFrame(apply)));
  [gov, header].forEach(el => {
    if (!el) return;
    el.querySelectorAll('img').forEach(img => {
      if (!img.complete) img.addEventListener('load', apply, { once:true });
    });
  });
  setTimeout(apply, 200);
})();


  // Working init (like your other page) Google
 

</script>
