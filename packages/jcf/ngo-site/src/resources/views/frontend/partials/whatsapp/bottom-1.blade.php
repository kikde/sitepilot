<style>
:root{
  --nav-bg:#1a0a4a;          /* dark purple like screenshot */
  --nav-fg:#7d6aa6;          /* muted icon color */
  --nav-active:#ffffff;      /* active/center icon */
  --bar-h:72px;
  --bump-d:72px;             /* bump diameter */
  --radius:22px;
  --safe: env(safe-area-inset-bottom, 0px);
}

/* stick to bottom, centered */
.bottom-nav{
  position:fixed;
  left:50%;
  bottom: calc(var(--safe));
  transform:translateX(-50%);
  width:min(680px, 94vw);
  z-index:9999;
}

/* bar */
.bottom-nav .nav{
  position:relative;
  display:flex;
  justify-content:space-between;
  align-items:center;
  list-style:none;
  margin:0;
  padding:0 18px;
  height:var(--bar-h);
  background:var(--nav-bg);
  border-radius:var(--radius);
  box-shadow:0 10px 26px rgba(0,0,0,.18);
  overflow:visible; /* allow the bump */
}

/* the bump on top */
.bottom-nav .nav::before{
  content:"";
  position:absolute;
  left:50%;
  top:0;
  width:var(--bump-d);
  height:var(--bump-d);
  background:var(--nav-bg);
  border-radius:50%;
  transform:translate(-50%, -50%); /* half outside to form a bump */
  box-shadow:0 -6px 16px rgba(0,0,0,.10) inset;
  z-index:0;
}

/* items */
.bottom-nav .nav > li{
  flex:1 0 20%;
  text-align:center;
  position:relative;
}

.bottom-nav .nav a{
  display:grid;
  place-items:center;
  padding-top:6px;
  text-decoration:none;
  color:var(--nav-fg);
}

.bottom-nav .nav a .title{
  font:600 12px/1.1 system-ui, -apple-system, Segoe UI, Roboto, Arial;
  margin-top:6px;
  opacity:.7;
}

/* icons */
.bottom-nav .nav i{
  font-size:26px;
  line-height:1;
  opacity:.6;
  transition:opacity .2s, transform .2s;
}
.bottom-nav .nav a:hover i{ opacity:.8; }

/* active look for non-center items if you want to mark one */
.bottom-nav .nav a.active i,
.bottom-nav .nav a.active .title{
  color:var(--nav-active);
  opacity:1;
}

/* center action */
.bottom-nav .nav .center{
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  top:-10px;                /* pulls it up into the bump */
  width:110px;              /* space for label */
  pointer-events:none;      /* let only the button get clicks */
  text-align:center;
}

.bottom-nav .fab{
  pointer-events:auto;
  width:48px; height:48px;
  border-radius:50%;
  background:transparent;
  border:4px solid #fff;    /* white ring */
  color:#fff;
  display:grid; place-items:center;
  margin:0 auto;
  box-shadow:0 6px 18px rgba(0,0,0,.25);
}
.bottom-nav .fab i{ font-size:26px; }

/* “Add” label under the button */
.bottom-nav .fab-label{
  display:block;
  color:#fff;
  font:700 13px/1.2 system-ui,-apple-system,Segoe UI,Roboto,Arial;
  margin-top:6px;
}

/* mobile-safe radius on small screens */
@media (max-width:420px){
  :root{ --bar-h:68px; --bump-d:68px; }
}

</style>



<!-- Spacer so content isn't hidden behind the sticky bar -->

<!-- Put this near the end of <body> (above the footer) -->
<nav class="bottom-nav">
  <ul class="nav">
    <li><a href="https://wa.me/{{ $setting->phone }}?text={{ urlencode('Hello Team, Thank you for your support!') }}"
   target="_blank"
   rel="noopener"
   aria-label="Chat on WhatsApp"><i class='bx bxl-whatsapp'></i><span class="title">WhatsApp</span></a></li>
    <li><a href="{{ url('/user-donate') }}"><i class='bx bx-donate-heart'></i><span class="title">Donate</span></a></li>

    <!-- Center action (looks like the screenshot) -->
    <li class="center">
      <button class="fab" type="button"><i class='bx bx-plus'></i></button>
      <span class="fab-label">Add</span>
    </li>

    <li><a href="{{ url('/complain-form') }}"><i class='bx bx-bell'></i><span class="title">Complaint</span></a></li>
    <li><a href="{{ url('/member-registration') }}"><i class='bx bx-user'></i><span class="title">Register</span></a></li>
  </ul>
</nav>


<script>
  const items = document.querySelectorAll('.bottom-nav .nav > li a');
  items.forEach(a=>{
    a.addEventListener('click', (e)=>{
      items.forEach(x=>x.classList.remove('active'));
      a.classList.add('active');
    });
  });

  // Center FAB click
  document.querySelector('.bottom-nav .fab')?.addEventListener('click', ()=>{
    // do something (open modal, new receipt, etc.)
    console.log('FAB clicked');
  });
</script>

