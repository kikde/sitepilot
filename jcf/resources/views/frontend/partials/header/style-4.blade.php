<style>
/* ===== Scoped Header Variant 3 (NALSA-like) ===== */
.hv3{--ink:#0b0b0b;--muted:#4b5563;--line:#e5e7eb;--bg:#fff;--accent:#c89b27;--accent-700:#b68412;--top:#f4f2ee;--shadow:0 8px 26px rgba(0,0,0,.08)}
.hv3, .hv3 *{box-sizing:border-box}
.hv3 a{color:inherit;text-decoration:none}
.hv3 ul{list-style:none;margin:0;padding:0}
.hv3 img{display:block;max-width:100%;height:auto}

/* scope */
.hv3x{--line:#e5e7eb;--ink:#0b0b0b;--muted:#4b5563;--bg:#fff}

/* reset bits */
.hv3x, .hv3x *{box-sizing:border-box}
.hv3x img{display:inline-block;vertical-align:middle}
.hv3x a{color:inherit;text-decoration:none}

/* util icons row */
.hv3x .util{
  background:#fff;
  border-bottom:1px solid var(--line);
}
.hv3x .util .icons{
  display:flex; justify-content:center; align-items:center;
  gap:26px; padding:6px 8px;
}
.hv3x .util .icons .ico{
  width:26px; height:26px; display:grid; place-items:center;
}
.hv3x .util .icons svg{width:22px;height:22px;fill:#111}

/* Top utility bar */
/* topbar */
.hv3x .topbar{
  background:#f4f2ee;
  border-bottom:1px solid var(--line);
  color:#222; font-size:13px;
}
.hv3x .topbar .row{
  display:flex; justify-content:center; align-items:center;
  gap:12px; padding:8px 12px; flex-wrap:wrap;
}
.hv3x .pill{
  display:inline-flex; align-items:center; gap:8px; line-height:1.2;
}
.hv3x .flag{
  width:20px; height:14px; object-fit:cover; border-radius:2px;
  box-shadow:0 0 0 1px rgba(0,0,0,.08);
}
.hv3x .sep{opacity:.45; user-select:none}

/* A+/A/A- dots spacing */
.hv3x .dots{opacity:.45; margin:0 3px}
/* Flag image (fixed vertical centering) */
.hv3 .flag{
  width:22px;height:15px;object-fit:cover;display:inline-block;
  border:1px solid rgba(0,0,0,.08); border-radius:2px;
}

/* Main bar */
.hv3 .header{background:var(--bg);position:relative;z-index:3;box-shadow:var(--shadow)}
.hv3 .bar{display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:14px;padding:12px 14px}
.hv3 .brand{display:flex;align-items:flex-start;gap:12px}
.hv3 .brand img{height:54px}
.hv3 .brand .title{font-weight:900;line-height:1.1;font-size:16px;text-transform:uppercase}
.hv3 .brand .sub{font-size:11px;opacity:.7;margin-top:2px}

/* Right hamburger */
.hv3 .hamburger{height:42px;width:54px;border:1px solid var(--line);background:#fff;border-radius:10px;display:grid;place-items:center;cursor:pointer}
.hv3 .hamburger span{display:block;width:26px;height:2px;background:#111;position:relative}
.hv3 .hamburger span::before,.hv3 .hamburger span::after{content:"";position:absolute;left:0;width:26px;height:2px;background:#111;transition:transform .25s ease, top .25s ease}
.hv3 .hamburger span::before{top:-8px}
.hv3 .hamburger span::after{top:8px}
.hv3 .hamburger.is-active span{background:transparent}
.hv3 .hamburger.is-active span::before{top:0;transform:rotate(45deg)}
.hv3 .hamburger.is-active span::after{top:0;transform:rotate(-45deg)}

/* Search strip */
.hv3 .search{padding:10px 14px;border-top:1px solid var(--line);background:#fff}
.hv3 .search .box{display:flex;align-items:center;border:2px solid var(--accent);border-radius:10px;overflow:hidden;max-width:680px}
.hv3 .search input{flex:1;padding:12px 12px;border:0;font-size:15px;outline:none}
.hv3 .search button{width:52px;height:44px;border:0;background:transparent;cursor:pointer;font-size:18px}

/* Drawer */
.hv3 .backdrop{position:fixed;inset:0;background:rgba(0,0,0,.5);opacity:0;pointer-events:none;transition:opacity .25s ease;z-index:9998}
.hv3 .drawer{position:fixed;top:0;right:0;height:100dvh;width:min(86vw,360px);background:#fff;box-shadow:-14px 0 34px rgba(0,0,0,.18);transform:translateX(100%);transition:transform .28s ease;display:flex;flex-direction:column;z-index:9999}
.hv3 .drawer-head{padding:14px 16px;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between}
.hv3 .drawer-close{border:none;background:#f1f5f9;width:36px;height:36px;border-radius:10px;font-size:18px;cursor:pointer}
.hv3 .drawer-body{padding:10px 12px 18px;overflow:auto}
.hv3 .menu > li{margin:8px 0}
.hv3 .menu > li > .row{display:flex;align-items:center;justify-content:space-between;border:1px solid var(--line);padding:12px;border-radius:12px;font-weight:700}
.hv3 .menu .caret{border:none;background:#f3f4f6;width:34px;height:34px;border-radius:8px;display:grid;place-items:center;cursor:pointer}
.hv3 .menu .sub{display:none;margin:8px 0 0 8px;border-left:2px solid var(--line)}
.hv3 .menu .sub a{display:block;padding:10px 12px;color:var(--muted)}
.hv3 .menu .sub.show{display:block}

@media (max-width:520px){
  .hv3 .brand img{height:48px}
}
</style>

<body class="hv3">
<!-- Top bar -->
<div class="hv3x">
  <!-- utility icons strip -->
 
  <!-- centered topbar -->
  <div class="topbar">
    <div class="row">
      <span class="pill">
        <img class="flag" src="https://flagcdn.com/w20/in.png" alt="India flag">
        <b>न्याय विभाग</b>
      </span>
      <span class="sep">|</span>
      <span class="pill">DEPARTMENT OF JUSTICE</span>
      <span class="sep">|</span>
      <a class="pill" href="#main">SKIP TO MAIN CONTENT</a>
      <span class="sep">|</span>
      <span class="pill">SCREEN READER ACCESS</span>
      <span class="sep">|</span>
      <span>A+</span><span class="dots">•</span><span>A</span><span class="dots">•</span><span>A-</span>
    </div>
  </div>
</div>




<!-- Main header -->
<header class="header">
  <div class="bar">
    <a class="brand" href="#">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/250px-Emblem_of_India.svg.png" alt="Emblem">
      <div>
        <div class="title">NATIONAL LEGAL<br>SERVICES AUTHORITY</div>
        <div class="sub">राष्ट्रीय विधिक सेवा प्राधिकरण</div>
      </div>
    </a>

    <div></div>

    <button class="hamburger" id="hv3Btn" aria-label="Open menu" aria-expanded="false" aria-controls="hv3Drawer">
      <span></span>
    </button>
  </div>

  <!-- Search strip -->
  <div class="search">
    <form class="box" action="#" method="get" role="search">
      <input type="search" name="q" placeholder="Search" aria-label="Search">
      <button type="submit" aria-label="Search">🔍</button>
    </form>
  </div>
</header>

<!-- Drawer -->
<div class="backdrop" id="hv3Backdrop"></div>
<aside class="drawer" id="hv3Drawer" aria-hidden="true">
  <div class="drawer-head">
    <b>Menu</b>
    <button class="drawer-close" id="hv3Close" aria-label="Close">×</button>
  </div>
  <div class="drawer-body">
    <ul class="menu">
      <li><div class="row"><a href="{{ url('/') }}">Home</a></div></li>
      <li>
        <div class="row">
          <a href="{{ url('/about') }}">About</a>
          <button class="caret" type="button" data-target="sub-about" aria-label="Toggle About">▾</button>
        </div>
        <div id="sub-about" class="sub">
          <a href="{{ url('/news-post') }}">Breaking News</a>
          <a href="{{ url('/success-story') }}">Success Stories</a>
          <a href="{{ url('/support-ticket') }}">Support Ticket</a>
          <a href="{{ url('/terms-and-conditions') }}">Terms &amp; Conditions</a>
          <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
        </div>
      </li>
      <li><div class="row"><a href="{{ url('/our-management-body') }}">Management Body</a></div></li>
      <li><div class="row"><a href="{{ url('/donors') }}">Donors</a></div></li>
      <li><div class="row"><a href="{{ url('/our-members') }}">Members</a></div></li>
      <li>
        <div class="row">
          <span>Objective</span>
          <button class="caret" type="button" data-target="sub-objective" aria-label="Toggle Objective">▾</button>
        </div>
        <div id="sub-objective" class="sub">
          @foreach($secmenu as $items)
            @if($items->pagestatus == "Published")
              <a class="{{Request::is('objective-details') ? 'current': ''}}" href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">{{$items->sector_name}}</a>
            @endif
          @endforeach
        </div>
      </li>
      <li>
        <div class="row">
          <span>Gallery</span>
          <button class="caret" type="button" data-target="sub-gallery" aria-label="Toggle Gallery">▾</button>
        </div>
        <div id="sub-gallery" class="sub">
          <a href="{{ url('/photo-gallery') }}">Photo Gallery</a>
          <a href="{{ url('/video-gallery') }}">Video Gallery</a>
        </div>
      </li>
      <li><div class="row"><a href="{{ url('/contact') }}">Contact Us</a></div></li>
    </ul>

     <div style="margin-top:16px;color:var(--muted);font-size:14px">
      <p><b>Address:</b> {{$setting->address}}</p>
      <p><b>Phone:</b> <a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></p>
      <p><b>Email:</b> <a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></p>
    </div>
  </div>
</aside>

<script>
(function(){
  const btn = document.getElementById('hv3Btn');
  const drawer = document.getElementById('hv3Drawer');
  const backdrop = document.getElementById('hv3Backdrop');
  const closeBtn = document.getElementById('hv3Close');

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

  // submenus
  document.querySelectorAll('.hv3 .menu .caret').forEach(c=>{
    c.addEventListener('click', ()=>{
      const id = c.getAttribute('data-target');
      const el = document.getElementById(id);
      if(!el) return;
      el.classList.toggle('show');
    });
  });
})();
</script>

