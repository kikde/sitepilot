<style>
  /* ====== Scoped Theme ====== */
  .hv2{--ink:#0f172a;--muted:#475569;--line:#e5e7eb;--bg:#ffffff;--top:#2b2b2b;--accent:#0ea5e9;--shadow:0 8px 28px rgba(0,0,0,.08)}
  .hv2, .hv2 *{box-sizing:border-box}
  .hv2 a{color:inherit;text-decoration:none}
  .hv2 ul{list-style:none;margin:0;padding:0}
  .hv2 img{display:block;max-width:100%;height:auto}

  /* Main header */
  .hv2 .header{background:var(--bg);box-shadow:var(--shadow);position:relative;z-index:10}
  .hv2 .bar{
    display:grid;grid-template-columns:1fr auto 1fr;align-items:center;
    gap:12px;padding:12px 14px;
  }
  .hv2 .brand{display:flex;align-items:center;gap:10px}
  .hv2 .brand img{height:46px}
  .hv2 .badges{justify-self:center;display:flex;gap:14px;align-items:center}
  .hv2 .badges img{height:32px;opacity:.95}

  /* Right side: hamburger */
  .hv2 .right{justify-self:end;display:flex;align-items:center;gap:8px}
  .hv2 .hamburger{
    height:42px;width:54px;border:1px solid var(--line);background:#fff;border-radius:10px;
    display:grid;place-items:center;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,.06)
  }
  .hv2 .hamburger span{display:block;width:26px;height:2px;background:#334155;position:relative}
  .hv2 .hamburger span::before,.hv2 .hamburger span::after{
    content:"";position:absolute;left:0;width:26px;height:2px;background:#334155;
    transition:transform .25s ease, top .25s ease, opacity .2s ease
  }
  .hv2 .hamburger span::before{top:-8px}
  .hv2 .hamburger span::after{top:8px}
  .hv2 .hamburger.is-active span{background:transparent}
  .hv2 .hamburger.is-active span::before{top:0;transform:rotate(45deg)}
  .hv2 .hamburger.is-active span::after{top:0;transform:rotate(-45deg)}

  /* Drawer (Right) */
  .hv2 .backdrop{
    position:fixed;inset:0;background:rgba(0,0,0,.45);opacity:0;pointer-events:none;
    transition:opacity .25s ease;z-index:9998
  }
  .hv2 .drawer{
    position:fixed;top:0;right:0;height:100dvh;width:min(86vw,360px);background:#fff;
    box-shadow:-12px 0 34px rgba(0,0,0,.18);transform:translateX(100%);transition:transform .28s ease;
    display:flex;flex-direction:column;z-index:9999
  }
  .hv2 .drawer-head{padding:14px 16px;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between}
  .hv2 .drawer-close{border:none;background:#f1f5f9;width:36px;height:36px;border-radius:10px;font-size:18px;cursor:pointer}
  .hv2 .drawer-body{padding:10px 12px 18px;overflow:auto}

  /* Drawer menu */
  .hv2 .menu > li{
    margin:8px 0;border:1px solid var(--line);border-radius:12px;overflow:hidden
  }
  .hv2 .menu-row{
    display:flex;align-items:center;justify-content:space-between;gap:8px;
    padding:12px 12px;color:var(--ink);font-weight:700;background:#fff
  }
  .hv2 .menu-row .toggle{
    border:none;background:#f1f5f9;width:34px;height:34px;border-radius:10px;cursor:pointer;
    display:grid;place-items:center;font-size:18px;flex:0 0 34px
  }
  .hv2 .menu-row .toggle[aria-expanded="true"]{background:#eaf6fd;color:#0277bd}
  .hv2 .menu .sub{display:none;border-top:1px solid var(--line);background:#fcfcfd}
  .hv2 .menu .sub a{display:block;padding:10px 12px 10px 14px;color:var(--muted)}
  .hv2 .menu .sub a:hover{background:#f3f4f6;color:#0f172a}

  .hv2 .contact{margin:18px 2px 8px;color:var(--muted);font-size:14px}
  .hv2 .contact b{color:var(--ink)}

  @media (max-width:520px){
    .hv2 .brand img{height:42px}
    .hv2 .badges img{height:59px}
  }
</style>

<body class="hv2">

  <!-- Main Header -->
  <header class="header">
    <div class="bar">
      <!-- Left brand -->
      <a class="brand" href="{{ url('/') }}" aria-label="Home">
        <img src="{{ asset('backend/uploads/'.$setting->site_logo) }}" alt="Logo">
      </a>

      <!-- Middle badges (replace if you have your own) -->
      <div class="badges" aria-hidden="true">
        <img src="https://www.ux4g.gov.in/assets/img/uxdt-logo/azadi-ka-amrit-mahotsav-01.jpg" alt="Azadi Ka Amrit Mahotsav">
        <img src="https://cds.edu/wp-content/uploads/G20-theme-and-logo-e1676954367274.png" alt="G20 India">
      </div>

      <!-- Right actions: only hamburger -->
      <div class="right">
        <button class="hamburger" id="hv2Btn" aria-label="Open menu" aria-expanded="false" aria-controls="hv2Drawer">
          <span></span>
        </button>
      </div>
    </div>
  </header>

  <!-- Drawer -->
  <div class="backdrop" id="hv2Backdrop"></div>
  <aside class="drawer" id="hv2Drawer" aria-hidden="true">
    <div class="drawer-head">
      <b>Menu</b>
      <button class="drawer-close" id="hv2Close" aria-label="Close">×</button>
    </div>

    <div class="drawer-body">
      <ul class="menu" id="hv2Menu">
        <li>
          <div class="menu-row">
            <a href="{{ url('/') }}">Home</a>
          </div>
        </li>

        <!-- About (with sub; parent link stays clickable, caret toggles the sub) -->
        <li>
          <div class="menu-row">
            <a href="{{ url('/about') }}">About</a>
            <button class="toggle" type="button" aria-expanded="false" aria-controls="sub-about">▾</button>
          </div>
          <div class="sub" id="sub-about">
            <a href="{{ url('/news-post') }}">Breaking News</a>
            <a href="{{ url('/success-story') }}">Success Stories</a>
            <a href="{{ url('/support-ticket') }}">Support Ticket</a>
            <a href="{{ url('/terms-and-conditions') }}">Terms &amp; Conditions</a>
            <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
          </div>
        </li>

        <!-- Management Body -->
        <li>
          <div class="menu-row"><a href="{{ url('our-management-body') }}">Management Body</a></div>
        </li>

        <!-- Donors -->
        <li>
          <div class="menu-row"><a href="{{ url('/donors') }}">Donors</a></div>
        </li>

        <!-- Members -->
        <li>
          <div class="menu-row"><a href="{{ url('/our-members') }}">Members</a></div>
        </li>

        <!-- Objective (dynamic sub) -->
        <li>
          <div class="menu-row">
            <span>Objective</span>
            <button class="toggle" type="button" aria-expanded="false" aria-controls="sub-objective">▾</button>
          </div>
          <div class="sub" id="sub-objective">
            <!-- Dynamic objective links -->
            @foreach($secmenu as $items)
              @if($items->pagestatus == "Published")
                <a class="{{Request::is('objective-details') ? 'current': ''}}" href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">
                  {{$items->sector_name}}
                </a>
              @endif
            @endforeach
          </div>
        </li>

        <!-- Gallery -->
        <li>
          <div class="menu-row">
            <span>Gallery</span>
            <button class="toggle" type="button" aria-expanded="false" aria-controls="sub-gallery">▾</button>
          </div>
          <div class="sub" id="sub-gallery">
            <a class="{{Request::is('photo-gallery') ? 'current': ''}}" href="{{ url('/photo-gallery') }}">Photo Gallery</a>
            <a class="{{Request::is('video-gallery') ? 'current': ''}}" href="{{ url('/video-gallery') }}">Video Gallery</a>
          </div>
        </li>

        <!-- Contact -->
        <li>
          <div class="menu-row"><a href="{{ url('/contact') }}">Contact Us</a></div>
        </li>
      </ul>

      <div class="contact">
        <p><b>Address:</b> {{$setting->address}}</p>
        <p><b>Phone:</b> <a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></p>
        <p><b>Email:</b> <a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></p>
      </div>
    </div>
  </aside>

<script>
  (function(){
    const btn = document.getElementById('hv2Btn');
    const drawer = document.getElementById('hv2Drawer');
    const backdrop = document.getElementById('hv2Backdrop');
    const closeBtn = document.getElementById('hv2Close');
    const toggles = document.querySelectorAll('.hv2 .menu-row .toggle');

    function openDrawer(){
      drawer.style.transform='translateX(0)';
      backdrop.style.opacity='1';
      backdrop.style.pointerEvents='auto';
      btn.classList.add('is-active');
      btn.setAttribute('aria-expanded','true');
      drawer.setAttribute('aria-hidden','false');
      document.body.style.overflow='hidden';
    }
    function closeDrawer(){
      drawer.style.transform='translateX(100%)';
      backdrop.style.opacity='0';
      backdrop.style.pointerEvents='none';
      btn.classList.remove('is-active');
      btn.setAttribute('aria-expanded','false');
      drawer.setAttribute('aria-hidden','true');
      document.body.style.overflow='';
    }
    btn.addEventListener('click',()=> btn.classList.contains('is-active') ? closeDrawer() : openDrawer());
    backdrop.addEventListener('click', closeDrawer);
    closeBtn.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', e => { if(e.key==='Escape') closeDrawer(); });

    // Sub menu toggles (each caret opens/closes without blocking parent link)
    toggles.forEach(tg => {
      tg.addEventListener('click', (e)=>{
        const expanded = tg.getAttribute('aria-expanded') === 'true';
        const panel = document.getElementById(tg.getAttribute('aria-controls'));
        tg.setAttribute('aria-expanded', String(!expanded));
        if(panel){
          panel.style.display = expanded ? 'none' : 'block';
        }
      });
    });
  })();
</script>

