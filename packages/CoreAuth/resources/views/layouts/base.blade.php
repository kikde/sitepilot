<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CoreAuth</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#0b1020; --panel:#0f172a; --text:#e5e7eb; --muted:#94a3b8; --accent:#6366f1; --brand:#22d3ee; --ring:#1f2937; --border:#1f2937;
      --card:rgba(17,24,39,.5);
    }
    [data-theme="light"]{
      --bg:#f5f7fb; --panel:#ffffff; --text:#111827; --muted:#6b7280; --accent:#4f46e5; --brand:#0ea5e9; --ring:#e5e7eb; --border:#e5e7eb; --card:#ffffff;
    }
    *{box-sizing:border-box}
    body{font-family:Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial; margin:0; background:var(--bg); color:var(--text)}
    a{color:var(--text); text-decoration:none}
    .app{display:grid; grid-template-columns:260px 1fr; min-height:100vh}
    .sidebar{background:linear-gradient(180deg, rgba(34,211,238,.12), rgba(99,102,241,.12)); border-right:1px solid var(--border); padding:16px; position:sticky; top:0; height:100vh}
    .brand{display:flex; align-items:center; gap:10px; font-weight:600; letter-spacing:.3px; margin-bottom:16px}
    .brand .logo{width:34px; height:34px; border-radius:8px; background:linear-gradient(135deg, var(--brand), var(--accent)); display:flex; align-items:center; justify-content:center; color:#0b1020; font-weight:800}
    .menu{list-style:none; margin:0; padding:0}
    .menu li{margin:6px 0}
    .menu a{display:flex; align-items:center; gap:10px; padding:8px 10px; border-radius:8px; color:var(--text); border:1px solid transparent}
    .menu a:hover{background:rgba(99,102,241,.12); border-color:rgba(99,102,241,.25)}
    .menu .section{margin-top:12px; margin-bottom:6px; font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.4px}
    .header{display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--border); padding:12px 18px; background:rgba(17,24,39,.5); position:sticky; top:0; backdrop-filter: blur(10px)}
    .header .right{display:flex; gap:10px; align-items:center}
    .btn{background:var(--accent); color:#0b1020; border:none; border-radius:8px; padding:8px 12px; cursor:pointer}
    .btn-outline{background:transparent; color:var(--text); border:1px solid var(--ring); border-radius:8px; padding:8px 12px; cursor:pointer}
    .content{padding:18px}
    .card{background:var(--card); border:1px solid var(--ring); border-radius:12px; padding:16px;}
    .dropdown{position:relative}
    .dropdown-menu{position:absolute; right:0; top:100%; background:var(--panel); border:1px solid var(--ring); border-radius:10px; padding:8px; display:none; min-width:220px; z-index:50}
    .dropdown-menu a{display:block; padding:8px 10px; border-radius:8px}
    .dropdown-menu a:hover{background:rgba(99,102,241,.12)}
    /* Sidebar dropdown sections */
    .section{display:flex; align-items:center; justify-content:space-between; cursor:pointer}
    .section .caret{font-size:14px; color:var(--muted); transition:transform .15s ease}
    .collapsed{display:none}
    .muted{color:var(--muted); font-size:0.9rem}
    .flash{background:rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.3); color:#bbf7d0; padding:8px 12px; border-radius:8px; margin:12px 0}
    .error{background:rgba(239,68,68,.12); border:1px solid rgba(239,68,68,.3); color:#fecaca; padding:8px 12px; border-radius:8px; margin:12px 0}
    /* Mobile */
    @media (max-width: 960px){
      .app{grid-template-columns:1fr}
      .sidebar{position:fixed; left:-280px; width:240px; transition:left .2s ease; height:100%;}
      .sidebar.open{left:0}
    }
  </style>
  @stack('head')
  </head>
<body>
  <div class="app">
    <aside id="sidebar" class="sidebar">
      <div class="brand">
        <div class="logo">D</div>
        <div>dapunabi CRM</div>
      </div>
      <div class="section" data-dropdown>Main <span class="caret">▾</span></div>
      <ul class="menu" data-section>
        <li><a href="{{ route('dashboard') }}">🏠 Dashboard</a></li>
        <li><a href="{{ route('tenant.select') }}">🔀 Tenant Selector</a></li>
      </ul>
      <div class="section" data-dropdown>CoreAuth <span class="caret">▾</span></div>
      <ul class="menu" data-section>
        <li><a href="{{ route('admin.roles') }}">👥 Roles</a></li>
        <li><a href="{{ route('admin.permissions') }}">🔑 Permissions</a></li>
        <li><a href="/mfa/setup">🔒 MFA Setup</a></li>
        <li><a href="/mfa/verify">✅ MFA Verify</a></li>
        <li><a href="{{ route('account.profile') }}">👤 Profile</a></li>
        <li><a href="{{ route('account.sessions') }}">🖥️ Sessions</a></li>
        <li><a href="/admin/impersonate">🧪 Impersonate</a></li>
        <li><a href="/admin/audit">Audit Logs</a></li>
        <li><a href="/spa">SPA</a></li>
        <li><a href="/api/v1/getMe" target="_blank">API</a></li>
      </ul>
      <div class="section" data-dropdown>Tenancy <span class="caret">▾</span></div>
      <ul class="menu" data-section>
        <li><a href="/admin/tenants">📒 Tenants</a></li>
        <li><a href="/admin/tenants/create">➕ Create Tenant</a></li>
        <li><a href="/tenant/posts">Posts</a></li>
        <li><a href="/tenant/media">Media</a></li>
        <li><a href="/tenant/pos">POS</a></li>
        <li><a href="/tenant/shop">Shop</a></li>
        <li><a href="/tenant/debug" target="_blank">Resolver Debug</a></li>
      </ul>
      <div class="section" data-dropdown>Billing <span class="caret">▾</span></div>
      <ul class="menu" data-section>
        <li><a href="/billing">Billing</a></li>
        <li><a href="/billing/invoices">Invoices</a></li>
        <li><a href="/billing/seats">Seats</a></li>
        <li><a href="/admin/plans">Admin: Plans</a></li>
        <li><a href="/admin/billing/invoices">Admin: Invoices</a></li>
        <li><a href="/admin/webhooks">Admin: Webhooks</a></li>
      </ul>
      <div class="section" data-dropdown>UI Template <span class="caret">▾</span></div>
      <ul class="menu" data-section>
        <li><a href="/ui/editor?slug=home">Editor</a></li>
        <li><a href="/admin/ui/pages">Pages</a></li>
        <li><a href="/admin/ui/templates">Templates</a></li>
        <li><a href="/admin/ui/templates/import">Import Template</a></li>
        <li><a href="/admin/ui/theme">Theme Editor</a></li>
        <li><a href="/admin/ui/blocks">Block Registry</a></li>
        <li><a href="/api/v1/ui/blocks" target="_blank">Blocks API</a></li>
        <li><a href="/api/v1/pages/home" target="_blank">Render API</a></li>
        <li><a href="/api/v1/theme/config" target="_blank">Theme API</a></li>
      </ul>
    </aside>
    <div>
      <div class="header">
        <div style="display:flex; gap:8px; align-items:center">
          <button class="btn btn-outline" id="toggle">☰</button>
          <div class="dropdown">
            <button class="btn btn-outline" id="mainMenu">Main ▾</button>
            <div class="dropdown-menu" id="mainMenuMenu">
              <a href="{{ route('dashboard') }}">Dashboard</a>
              <a href="{{ route('tenant.select') }}">Tenant Selector</a>
              <a href="/billing">Billing</a>
              <a href="/ui/editor?slug=home">UI Editor</a>
              <a href="/p/home" target="_blank">View Page</a>
            </div>
          </div>
        </div>
        <div class="right">
          <button class="btn btn-outline" id="themeToggle">Theme</button>
          @if(Auth::check())
            <span class="muted">{{ Auth::user()->name }}</span>
            @if(session()->has('impersonator_id'))
            <form method="POST" action="/admin/impersonate/stop" style="display:inline; margin:0;">
              @csrf
              <button class="btn btn-outline" type="submit" title="Stop Impersonation">Stop Impersonation</button>
            </form>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline; margin:0;">
              @csrf
              <button class="btn" type="submit">Logout</button>
            </form>
          @else
            <a class="btn btn-outline" href="{{ route('login') }}">Login</a>
            <a class="btn" href="{{ route('register') }}">Register</a>
          @endif
        </div>
      </div>
      <main class="content">
        @if(session()->has('impersonator_id'))
          <div class="flash" style="background:rgba(245,158,11,.12); border-color:rgba(245,158,11,.3); color:#fde68a;">
            Impersonating as {{ Auth::user()->email }} — actions are logged.
          </div>
        @endif
        @if (session('status'))
          <div class="flash">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
          <div class="error">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="card">
          {{ $slot ?? '' }}
          @yield('content')
        </div>
        <div class="muted" style="margin-top:12px;">Brand: dapunjabi • Package: dapunjabi/coreauth</div>
      </main>
    </div>
  </div>
  <script>
    const toggle = document.getElementById('toggle');
    const sidebar = document.getElementById('sidebar');
    toggle?.addEventListener('click', () => sidebar.classList.toggle('open'));
    // Theme toggle with localStorage persistence
    const themeToggle = document.getElementById('themeToggle');
    const root = document.documentElement;
    function applyTheme(t){ if(t==='light'){ root.setAttribute('data-theme','light'); } else { root.removeAttribute('data-theme'); } }
    const saved = localStorage.getItem('ui.theme');
    applyTheme(saved || 'dark');
    themeToggle?.addEventListener('click', ()=>{ const cur = root.getAttribute('data-theme')==='light'?'dark':'light'; localStorage.setItem('ui.theme', cur); applyTheme(cur); });
    // Header dropdown
    const mainBtn = document.getElementById('mainMenu');
    const mainMenu = document.getElementById('mainMenuMenu');
    mainBtn?.addEventListener('click', ()=>{ mainMenu.style.display = mainMenu.style.display==='block' ? 'none' : 'block'; });
    document.addEventListener('click', (e)=>{ if(!mainBtn?.contains(e.target) && !mainMenu?.contains(e.target)){ if(mainMenu) mainMenu.style.display='none'; } });
    // Sidebar dropdown toggles
    document.querySelectorAll('.sidebar [data-dropdown]').forEach((sec) => {
      sec.addEventListener('click', () => {
        const list = sec.nextElementSibling;
        if (!list) return;
        const caret = sec.querySelector('.caret');
        const hidden = list.classList.toggle('collapsed');
        if (caret) caret.style.transform = hidden ? 'rotate(-90deg)' : 'rotate(0deg)';
      });
    });
  </script>
</body>
</html>
