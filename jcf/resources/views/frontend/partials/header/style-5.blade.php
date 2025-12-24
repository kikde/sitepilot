
<style>
/* ===== Scoped Theme (DP Variant) ===== */
:root { --ink:#0b0b0b; --muted:#5b6472; --line:#e5e7eb; --bg:#ffffff; --accent:#f59e0b; --navy:#0c2443; --shadow:0 10px 28px rgba(0,0,0,.1); }
*{box-sizing:border-box} html,body{margin:0; font-family:system-ui,-apple-system,Segoe UI,Roboto,Inter,Arial,sans-serif; color:var(--ink); background:#f7f7f7;}

/* Top icon strip (centered) */
.dp-topstrip{background:#111; color:#fff;}
.dp-topstrip .row{max-width:1200px;margin:0 auto; display:flex; align-items:center; justify-content:center; gap:28px; padding:6px 12px;}
.dp-topstrip .ico{display:flex; align-items:center; gap:6px; opacity:.92; font-weight:600;}
.dp-topstrip .ico svg{width:22px; height:22px; display:block;}

/* Banner bar (navy) */
.dp-banner{background:var(--navy); color:#fff; box-shadow:var(--shadow); position:relative; z-index:2;}
.dp-banner .bar{max-width:1200px;margin:0 auto; display:grid; grid-template-columns:1fr auto 1fr; align-items:center; gap:12px; padding:12px 14px;}
.dp-brand{display:flex; align-items:center; gap:12px;}
.dp-brand .logo{height:48px; width:48px; object-fit:contain;}
.dp-brand .title{display:flex; flex-direction:column; line-height:1; }
.dp-brand .title b{font-size:26px; letter-spacing:.3px;}
.dp-brand .title small{font-size:12px; opacity:.9; letter-spacing:.6px;}

/* equals divider */
.dp-eq{height:2px; background:linear-gradient(90deg,#fff 0 40%,transparent 40% 60%,#fff 60% 100%); width:28px; border-radius:2px; justify-self:center}

/* badges block */
.dp-badges{display:flex; align-items:center; gap:12px; justify-self:end;}
.dp-badges img{height:40px; background:#fff; padding:6px 10px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,.12);}

/* hamburger (right) */
.dp-right{display:flex; justify-content:flex-end;}
.dp-hamburger{height:44px; width:56px; background:#ffffff; border:1px solid #e6e8ee; border-radius:12px; display:grid; place-items:center; cursor:pointer; box-shadow:0 2px 8px rgba(0,0,0,.12);}
.dp-hamburger span{display:block; width:26px; height:2px; background:#0f172a; position:relative;}
.dp-hamburger span::before,.dp-hamburger span::after{content:""; position:absolute; left:0; width:26px; height:2px; background:#0f172a; transition:transform .25s ease, top .25s ease;}
.dp-hamburger span::before{top:-8px}
.dp-hamburger span::after{top:8px}
.dp-hamburger.is-active span{background:transparent}
.dp-hamburger.is-active span::before{top:0; transform:rotate(45deg)}
.dp-hamburger.is-active span::after{top:0; transform:rotate(-45deg)}

/* Drawer */
.dp-backdrop{position:fixed; inset:0; background:rgba(0,0,0,.5); opacity:0; pointer-events:none; transition:opacity .25s ease; z-index:9998;}
.dp-drawer{position:fixed; top:0; right:0; height:100dvh; width:min(88vw,360px); background:#fff; transform:translateX(100%); transition:transform .28s ease; z-index:9999; display:flex; flex-direction:column; box-shadow:-16px 0 40px rgba(0,0,0,.2);}
.dp-drawer .head{display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-bottom:1px solid var(--line);}
.dp-drawer .close{width:36px;height:36px;border-radius:10px;border:0;background:#eef2f7;cursor:pointer;font-size:18px}
.dp-drawer .body{padding:12px 14px; overflow:auto;}
.dp-drawer .menu>li{margin:8px 0}
.dp-drawer .menu>li>a, .dp-drawer .menu>li>.row{display:flex; align-items:center; justify-content:space-between; border:1px solid var(--line); padding:12px; border-radius:12px; font-weight:700; color:#0f172a; background:#fff}
.dp-drawer .sub{display:none; margin:8px 0 0 8px; border-left:2px solid var(--line)}
.dp-drawer .sub a{display:block; padding:10px 12px; color:var(--muted)}
.dp-drawer .sub.show{display:block}
.dp-drawer .caret{border:0;background:#f5f6fa; width:32px; height:32px; border-radius:8px; display:grid; place-items:center; cursor:pointer}

.dp-content{max-width:960px;margin:30px auto;padding:0 16px; color:var(--muted);}

@media (max-width:720px){
  .dp-banner .bar{grid-template-columns:1fr auto auto}
  .dp-badges img{height:34px}
  .dp-brand .title b{font-size:22px}
  .dp-brand .logo{height:44px;width:44px}
}
</style>


<!-- Top centered utility strip -->
<!-- <div class="dp-topstrip" role="navigation" aria-label="Utility">
  <div class="row">
    <div class="ico" title="Skip to main content"> -->
      <!-- keyboard icon -->
      <!-- <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3 6h18v2H3V6zm0 10h12v2H3v-2zm0-5h18v2H3v-2zm17 6 4-4-4-4v8z"/></svg>
    </div>
    <div class="ico" title="Language">
      <span style="font-weight:800;font-size:18px">अ</span><span style="border-left:1px solid #999;height:18px;opacity:.5"></span><span style="font-weight:800;font-size:16px">A</span>
    </div>
    <div class="ico" title="Accessibility"> -->
      <!-- person icon -->
      <!-- <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a2 2 0 110 4 2 2 0 010-4zm7 5H5a1 1 0 100 2h5v13h2V9h5a1 1 0 100-2z"/></svg>
    </div>
  </div>
</div> -->

<!-- Navy banner -->
<div class="dp-banner">
  <div class="bar">
    <!-- Left brand -->
    <a class="dp-brand" href="{{ url('/') }}" aria-label="Home">
      <img class="logo" src="{{ asset('backend/uploads/'.$setting->site_logo) }}" alt="Delhi Police">
      <div class="title">
        <b>Delhi Police</b>
        <small>SHANTI SEWA NYAYA</small>
      </div>
    </a>

    <!-- symbol divider -->
    <!-- <div class="dp-eq" aria-hidden="true"></div> -->

    <!-- Badges + Hamburger -->
    <div class="dp-badges">
      <img src="https://upload.wikimedia.org/wikipedia/en/8/8c/Beti_Bachao_Beti_Padhao_logo.jpg" alt="Emblem" />
      <img src="https://cds.edu/wp-content/uploads/G20-theme-and-logo-e1676954367274.png" alt="G20" />
      <img src="https://www.ux4g.gov.in/assets/img/uxdt-logo/azadi-ka-amrit-mahotsav-01.jpg" alt="AKAM" />
      <div class="dp-right">
        <button class="dp-hamburger" id="dpBtn" aria-label="Open menu" aria-expanded="false" aria-controls="dpDrawer">
          <span></span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Drawer -->
<div class="dp-backdrop" id="dpBackdrop"></div>
<aside class="dp-drawer" id="dpDrawer" aria-hidden="true">
  <div class="head">
    <b>Menu</b>
    <button class="close" id="dpClose" aria-label="Close">×</button>
  </div>
  <div class="body">
    <ul class="menu">
      <li><a href="{{ url('/') }}">Home</a></li>

      <li>
        <div class="row">
          <a href="{{ url('/about') }}">About</a>
          <button class="caret" type="button" data-target="sub-about">▾</button>
        </div>
        <div class="sub" id="sub-about">
          <a href="{{ url('/news-post') }}">Breaking News</a>
          <a href="{{ url('/success-story') }}">Success Stories</a>
          <a href="{{ url('/support-ticket') }}">Support Ticket</a>
          <a href="{{ url('/terms-and-conditions') }}">Terms &amp; Conditions</a>
          <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
        </div>
      </li>

      <li><a href="{{ url('our-management-body') }}">Management Body</a></li>
      <li><a href="{{ url('/donors') }}">Donors</a></li>
      <li><a href="{{ url('/our-members') }}">Members</a></li>

      <li>
        <div class="row">
          <span>Objective</span>
          <button class="caret" type="button" data-target="sub-objective">▾</button>
        </div>
        <div class="sub" id="sub-objective">
          {{-- Dynamic objective links --}}
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
          <button class="caret" type="button" data-target="sub-gallery">▾</button>
        </div>
        <div class="sub" id="sub-gallery">
          <a class="{{Request::is('photo-gallery') ? 'current': ''}}" href="{{ url('/photo-gallery') }}">Photo Gallery</a>
          <a class="{{Request::is('video-gallery') ? 'current': ''}}" href="{{ url('/video-gallery') }}">Video Gallery</a>
        </div>
      </li>

      <li><a href="{{ url('/contact') }}">Contact Us</a></li>
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
  const btn = document.getElementById('dpBtn');
  const drawer = document.getElementById('dpDrawer');
  const backdrop = document.getElementById('dpBackdrop');
  const closeBtn = document.getElementById('dpClose');

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
  document.querySelectorAll('.dp-drawer .caret').forEach(c=>{
    c.addEventListener('click', ()=>{
      const id = c.getAttribute('data-target');
      const el = document.getElementById(id);
      if(el){ el.classList.toggle('show'); }
    });
  });
})();
</script>

