<style>
/* ====== TOKENS ====== */
:root{
  --ink:#1f2937; --muted:#6b7280; --brand:#ff6b6b; --edge:#eef1f4; --line:#e5e7eb; --accent:#0ea5e9;
  --z-header:60; --z-overlay:1000;
}
.th-header, .th-header * { box-sizing:border-box; }
.th-header{ font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; }

/* --- TOP BAR donate as a pill button --- */
.th-header .topbar a.btn-donate{
  background:#0ea5e9; color:#fff; padding:6px 12px; border-radius:999px;
  font-weight:600; display:inline-block;
}

/* ====== TOP BAR ====== */
.th-header .topbar{ background:#3b3b3b; color:#fff; font-size:13px; }
.th-header .topbar .wrap{
  max-width:1100px; margin:0 auto; padding:8px 12px; display:flex; justify-content:space-between; gap:10px;
}
.th-header .topbar ul{ display:flex; gap:14px; padding:0; margin:0; list-style:none; align-items:center; }
.th-header .topbar li{ display:flex; gap:8px; align-items:center; white-space:nowrap; }
.th-header .topbar a{ color:#fff; text-decoration:none; }

/* ====== LOWER (sticky) ====== */
.th-header .lower{
  position:sticky; top:0; z-index:var(--z-header); background:#fff; border-bottom:1px solid var(--line);
}
.th-header .lower .row{
  max-width:1100px; margin:0 auto; padding:10px 12px;
  display:grid; grid-template-columns:40px 1fr 40px; /* left icon | logo | right icon */
  gap:10px; align-items:center;
}

/* Burger (you were missing the base box – added back) */
.th-header .burger{
  width:40px; height:40px; border:none; background:transparent;
  display:grid; place-items:center; border-radius:10px; cursor:pointer;
  position:relative; z-index:1001;
}
.th-header .burger .bar,
.th-header .burger .bar:before,
.th-header .burger .bar:after{
  content:""; display:block; width:22px; height:2px; background:#1f2937; border-radius:2px; position:relative;
}
.th-header .burger .bar:before{ position:absolute; top:-7px; left:0; }
.th-header .burger .bar:after{ position:absolute; top:7px; left:0; }

/* Logo centered */
.th-header .logox{
  display:flex; align-items:center; gap:10px;
  text-decoration:none; color:#111; justify-self:center;
  background:transparent !important; border:none !important; box-shadow:none !important; border-radius:0 !important; padding:0 !important;
}
.th-header .logox img{ height:38px; width:auto; max-width:100%; object-fit:contain; }
.th-header .logox strong{ display:block; line-height:1.05; }
.th-header .logox small{ display:block; font-size:10px; color:#94a3b8; margin-top:2px }

/* Search button (right) */
.th-header .search-btn{
  width:40px; height:40px; border:none; background:#f3f4f6; border-radius:10px;
  display:grid; place-items:center; font-size:18px; color:#111; cursor:pointer; justify-self:end;
}

/* Desktop nav (≥992px) */
.th-header .nav{ display:none; }
@media (min-width:992px){
  .th-header .lower .row{ grid-template-columns:1fr auto 40px; }
  .th-header .burger{ display:none; }
  .th-header .nav{ display:block; }
  .th-header .nav ul{ display:flex; gap:18px; list-style:none; margin:0; padding:0; align-items:center; }
  .th-header .nav a{ color:#111; text-decoration:none; padding:8px 6px; border-radius:8px; }
  .th-header .nav .current > a{ color:#0ea5e9; font-weight:700; }
  .th-header .nav li{ position:relative; }
  .th-header .nav li.dropdown > ul{
    position:absolute; top:100%; left:0; background:#fff; border:1px solid var(--line);
    border-radius:10px; padding:8px; display:none; box-shadow:0 10px 30px rgba(0,0,0,.08); min-width:200px;
  }
  .th-header .nav li.dropdown:hover > ul{ display:block; }
}

/* Tighter original topbar spacing on mobile (kept for compatibility) */
.th-header .header-top-two .top-inner{ padding:8px 12px; }
.th-header .header-top-two .info{ gap:10px; }
.th-header .header-top-two .info li{ display:flex; gap:6px; align-items:center; }

/* ====== GLOBAL OVERLAYS (outside header!) ====== */
/* Drawer */
.th-drawer{ position:fixed; inset:0; z-index:var(--z-overlay); pointer-events:none; }
.th-drawer .backdrop{
  position:absolute; inset:0; background:rgba(0,0,0,.35); opacity:0; transition:.2s;
}
.th-drawer .panel{
  position:absolute; top:0; left:0; height:100%; width:min(86%,360px); background:#fff;
  transform:translateX(-100%); transition:.25s; box-shadow:10px 0 30px rgba(0,0,0,.15);
  display:flex; flex-direction:column;
}
body.th-menu-open .th-drawer{ pointer-events:auto; }
body.th-menu-open .th-drawer .backdrop{ opacity:1; }
body.th-menu-open .th-drawer .panel{ transform:none; }
.th-drawer header{
  display:flex; align-items:center; justify-content:space-between; padding:14px; border-bottom:1px solid var(--line);
}
.th-drawer .close{ width:36px; height:36px; border:none; background:#f3f4f6; border-radius:10px; cursor:pointer; }
.th-drawer .m-nav{ padding:8px 12px 18px; overflow:auto; }
.th-drawer .m-nav ul{ list-style:none; margin:0; padding:0; }
.th-drawer .m-nav li{ border-bottom:1px solid var(--edge); }
.th-drawer .m-nav a{ display:flex; justify-content:space-between; align-items:center; padding:12px 6px; text-decoration:none; color:#111; }
.th-drawer .m-nav li ul{ padding-left:10px; background:#f9fafb; }
.th-drawer .m-info{ padding:12px; border-top:1px solid var(--line); color:#475569; font-size:14px; }

/* Search */
.th-search{ position:fixed; inset:0; z-index:var(--z-overlay); pointer-events:none; }
.th-search .sp-backdrop{
  position:absolute; inset:0; background:rgba(0,0,0,.45); opacity:0; transition:.2s;
}
.th-search .sp-box{
  position:absolute; left:50%; top:14%; transform:translateX(-50%) scale(.98);
  width:min(720px,92%); background:#fff; border-radius:14px; padding:12px;
  box-shadow:0 20px 60px rgba(0,0,0,.18); display:flex; gap:8px; align-items:center;
  opacity:0; transition:.2s;
}
.th-search .sp-input{ flex:1; height:44px; border:1px solid #e5e7eb; border-radius:10px; padding:0 12px; font-size:16px; }
.th-search .sp-go{ height:44px; padding:0 14px; border:none; border-radius:10px; background:#0ea5e9; color:#fff; font-weight:700; cursor:pointer; }
.th-search .sp-close{ width:36px; height:36px; border:none; background:#f3f4f6; border-radius:10px; margin-left:4px; cursor:pointer; }
body.th-search-open .th-search{ pointer-events:auto; }
body.th-search-open .th-search .sp-backdrop{ opacity:1; }
body.th-search-open .th-search .sp-box{ opacity:1; transform:translateX(-50%) scale(1); }
</style>


<!-- ============ HEADER (Blade-ready) ============ -->
<header class="th-header">

  <!-- compact topbar -->
  <div class="topbar">
    <div class="wrap">
      <ul class="info pull-left clearfix">
        <li>📞 For Enquiries <a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></li>
        <!-- <li>✉️ <a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></li> -->
      </ul>
      <ul class="info pull-right clearfix">
        <li>🗂️ <a class="btn-donate" href="{{ url('/user-donate') }}">Donates</a></li>
      </ul>
    </div>
  </div>

  <!-- lower: burger | logo(center) | search -->
  <div class="lower">
    <div class="row">
      <!-- burger -->
      <button class="burger" id="thBurger" aria-label="Open menu" aria-expanded="false" aria-controls="thDrawer">
        <span class="bar"></span>
      </button>

      <!-- logo centered -->
      <a class="logox" href="{{ url('/') }}">
        <img src="{{ asset('backend/uploads/'.$setting->site_logo) }}" alt="Trulyhelp">
        <div>
          <strong>Trulyhelp</strong>
          <small>A Life Of Dignity For All</small>
        </div>
      </a>

      <!-- search button -->
      <button class="search-btn" id="thSearchBtn" aria-label="Open search">🔍</button>
    </div>

    <!-- desktop nav (≥992px) -->
    <nav class="nav">
      <ul class="navigation clearfix">
        <li class=" {{Request::is('/') ? 'current': ''}}"><a href="{{ url('/') }}">Home</a></li>

        <li class="dropdown {{Request::is('about') ? 'current': ''}}">
          <a href="{{ url('/about') }}">About</a>
          <ul>
            <li><a href="{{ url('/news-post') }}">Breaking News</a></li>
            <li><a href="{{ url('/success-story') }}">Success Stories</a></li>
            <li><a href="{{ url('/support-ticket') }}">Support Ticket</a></li>
            <li><a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a></li>
            <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
          </ul>
        </li>

        <li class="{{Request::is('our-team') ? 'current': ''}}">
          <a href="{{ url('our-management-body') }}">Management Body</a>
        </li>

        <li class="{{Request::is('all-donars') ? 'current': ''}}">
          <a href="{{ url('/donors') }}">Donors</a>
        </li>

        <li class="{{Request::is('our-members') ? 'current': ''}}">
          <a href="{{ url('/our-members') }}">Members</a>
        </li>

        <li class="dropdown {{Request::is('objective') ? 'current': ''}}">
          <a href="#">Objective</a>
          <ul>
            @foreach($secmenu as $items)
              @if($items->pagestatus == "Published")
                <li class="{{Request::is('objective-details') ? 'current': ''}}">
                  <a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">{{$items->sector_name}}</a>
                </li>
              @endif
            @endforeach
          </ul>
        </li>

        <li class="dropdown">
          <a href="#">Gallery</a>
          <ul>
            <li class="{{Request::is('photo-gallery') ? 'current': ''}}">
              <a href="{{ url('/photo-gallery') }}">Photo Gallery</a>
            </li>
            <li class="{{Request::is('video-gallery') ? 'current': ''}}">
              <a href="{{ url('/video-gallery') }}">Video Gallery</a>
            </li>
          </ul>
        </li>

        <li class="{{Request::is('contact') ? 'current': ''}}">
          <a href="{{ url('/contact') }}">Contact Us</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

<!-- ========== MOBILE DRAWER (OUTSIDE HEADER) ========== -->
<div class="th-drawer" id="thDrawer" aria-hidden="true">
  <div class="backdrop" id="thBackdrop"></div>
  <div class="panel" role="dialog" aria-label="Mobile menu">
    <header>
      <a class="logo" href="{{ url('/') }}" style="text-decoration:none;color:#111;">
        <img src="{{ asset('backend/uploads/'.$setting->site_logo) }}" alt="Trulyhelp">
        <div><strong>Trulyhelp</strong><small>A Life Of Dignity For All</small></div>
      </a>
      <button class="close" id="thClose" type="button" aria-label="Close menu">✕</button>
    </header>

    <nav class="m-nav" aria-label="Mobile">
      <ul>
        <li><a href="{{ url('/') }}">Home</a></li>

        <li>
          <a href="{{ url('/about') }}">About <span>▾</span></a>
          <ul>
            <li><a href="{{ url('/news-post') }}">Breaking News</a></li>
            <li><a href="{{ url('/success-story') }}">Success Stories</a></li>
            <li><a href="{{ url('/support-ticket') }}">Support Ticket</a></li>
            <li><a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a></li>
            <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
          </ul>
        </li>

        <li><a href="{{ url('our-management-body') }}">Management Body</a></li>
        <li><a href="{{ url('/donors') }}">Donors</a></li>
        <li><a href="{{ url('/our-members') }}">Members</a></li>

        <li>
          <a href="#">Objective <span>▾</span></a>
          <ul>
            @foreach($secmenu as $items)
              @if($items->pagestatus == "Published")
                <li><a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">{{$items->sector_name}}</a></li>
              @endif
            @endforeach
          </ul>
        </li>

        <li>
          <a href="#">Gallery <span>▾</span></a>
          <ul>
            <li><a href="{{ url('/photo-gallery') }}">Photo Gallery</a></li>
            <li><a href="{{ url('/video-gallery') }}">Video Gallery</a></li>
          </ul>
        </li>

        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
      </ul>
    </nav>

    <div class="m-info">
      <strong>Contact</strong><br>
      {{$setting->address}}<br>
      <a href="tel:{{$setting->phone}}">{{$setting->phone}}</a><br>
      <a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a>
    </div>
  </div>
</div>

<!-- ========== SEARCH OVERLAY (OUTSIDE HEADER) ========== -->
<div class="th-search" id="thSearchPanel" aria-hidden="true">
  <div class="sp-backdrop" id="spBackdrop"></div>
  <form class="sp-box" action="{{ url('/search') }}" method="get" role="search" aria-label="Site search">
    <input class="sp-input" type="search" name="q" placeholder="Search…" autocomplete="off" />
    <button class="sp-go" type="submit">Search</button>
    <button class="sp-close" id="spClose" type="button" aria-label="Close search">✕</button>
  </form>
</div>

<script>
/* ===== Drawer (single, working) ===== */
(function(){
  const body     = document.body;
  const burger   = document.getElementById('thBurger');
  const drawer   = document.getElementById('thDrawer');
  const closeBtn = document.getElementById('thClose');
  const backdrop = document.getElementById('thBackdrop');

  if(!burger || !drawer) return;

  function openMenu(){
    body.classList.add('th-menu-open');
    drawer.setAttribute('aria-hidden','false');
    burger.setAttribute('aria-expanded','true');
    document.documentElement.style.overflow = 'hidden';
    body.style.overflow = 'hidden';
  }
  function closeMenu(){
    body.classList.remove('th-menu-open');
    drawer.setAttribute('aria-hidden','true');
    burger.setAttribute('aria-expanded','false');
    document.documentElement.style.overflow = '';
    body.style.overflow = '';
  }
  function toggleMenu(){
    body.classList.contains('th-menu-open') ? closeMenu() : openMenu();
  }

  burger.addEventListener('click', toggleMenu);
  closeBtn?.addEventListener('click', closeMenu);
  backdrop?.addEventListener('click', closeMenu);
  window.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
})();

/* ===== Search overlay ===== */
(function(){
  const body  = document.body;
  const btn   = document.getElementById('thSearchBtn');
  const panel = document.getElementById('thSearchPanel');
  const close = document.getElementById('spClose');
  const bd    = document.getElementById('spBackdrop');

  function openS(){
    body.classList.add('th-search-open');
    panel.setAttribute('aria-hidden','false');
    document.documentElement.style.overflow='hidden';
    body.style.overflow='hidden';
    setTimeout(()=>{ panel.querySelector('.sp-input')?.focus(); }, 50);
  }
  function closeS(){
    body.classList.remove('th-search-open');
    panel.setAttribute('aria-hidden','true');
    document.documentElement.style.overflow='';
    body.style.overflow='';
  }
  btn?.addEventListener('click', openS);
  close?.addEventListener('click', closeS);
  bd?.addEventListener('click', closeS);
  window.addEventListener('keydown', e=>{ if(e.key==='Escape') closeS(); });
})();
</script>

