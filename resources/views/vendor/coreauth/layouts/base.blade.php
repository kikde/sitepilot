<!doctype html>
@php
  /** @var \Dapunjabi\CoreAuth\Support\TenantManager $tm */
  $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
  $tenant = $tm->current();
  $tenantId = $tenant?->id;

  $primary = data_get($tenant, 'settings.theme.primary', '#2563eb');
  $accent = data_get($tenant, 'settings.theme.accent', '#f59e0b');

  $userId = auth()->id();
  $can = function (?string $permission) use ($tm, $tenantId, $userId): bool {
    if (!$permission) return true;
    if (!$userId || !$tenantId) return false;
    return $tm->userHasPermission($userId, $permission, $tenantId);
  };

  $routeOk = function (?string $routeName): bool {
    if (!$routeName) return false;
    try { return \Illuminate\Support\Facades\Route::has($routeName); } catch (\Throwable $e) { return false; }
  };

  $sections = [
    [
      'label' => 'Main',
      'items' => [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'perm' => 'view-dashboard'],
        ['label' => 'Tenant Selector', 'route' => 'tenant.select', 'perm' => 'view-dashboard'],
      ],
    ],
    [
      'label' => 'CoreAuth',
      'items' => [
        ['label' => 'Roles', 'route' => 'admin.roles', 'perm' => 'manage-roles'],
        ['label' => 'Permissions', 'route' => 'admin.permissions', 'perm' => 'manage-permissions'],
        ['label' => 'Audit Logs', 'route' => null, 'url' => url('/admin/audit'), 'perm' => 'manage-permissions'],
        ['label' => 'Impersonate', 'route' => null, 'url' => url('/admin/impersonate'), 'perm' => 'manage-roles'],
        ['label' => 'Profile', 'route' => 'account.profile', 'perm' => 'view-dashboard'],
        ['label' => 'Sessions', 'route' => 'account.sessions', 'perm' => 'view-dashboard'],
      ],
    ],
    [
      'label' => 'Tenancy',
      'items' => [
        ['label' => 'Tenants', 'route' => 'tenancy.admin.tenants.index', 'perm' => 'manage-permissions'],
        ['label' => 'Theme (Tenant)', 'route' => 'uitpl.admin.theme', 'perm' => 'manage-permissions'],
        ['label' => 'Tenant Config API', 'route' => null, 'url' => url('/api/v1/tenant/config'), 'perm' => 'view-dashboard', 'external' => true],
      ],
    ],
    [
      'label' => 'Billing',
      'items' => [
        ['label' => 'Billing Portal', 'route' => 'billing', 'perm' => 'view-dashboard'],
        ['label' => 'Plans', 'route' => 'billing.admin.plans', 'perm' => 'manage-permissions'],
        ['label' => 'Invoices (Admin)', 'route' => 'billing.admin.invoices', 'perm' => 'manage-permissions'],
        ['label' => 'Webhooks', 'route' => 'billing.admin.webhooks', 'perm' => 'manage-permissions'],
      ],
    ],
    [
      'label' => 'Media',
      'items' => [
        ['label' => 'Media Library', 'route' => 'media.admin.index', 'perm' => 'manage-permissions'],
      ],
    ],
    [
      'label' => 'UI Builder',
      'items' => [
        ['label' => 'Pages', 'route' => 'uitpl.admin.pages', 'perm' => 'manage-permissions'],
        ['label' => 'Templates', 'route' => 'uitpl.admin.templates', 'perm' => 'manage-permissions'],
        ['label' => 'Import Template', 'route' => null, 'url' => url('/admin/ui/templates/import'), 'perm' => 'manage-permissions'],
        ['label' => 'Blocks', 'route' => 'uitpl.admin.blocks', 'perm' => 'manage-permissions'],
      ],
    ],
    [
      'label' => 'Content',
      'items' => [
        ['label' => 'Pages', 'route' => null, 'url' => url('/pages'), 'perm' => 'view-dashboard'],
        ['label' => 'News', 'route' => null, 'url' => url('/newsList'), 'perm' => 'view-dashboard'],
        ['label' => 'Donors', 'route' => null, 'url' => url('/donors'), 'perm' => 'view-dashboard'],
        ['label' => 'Users', 'route' => null, 'url' => url('/userslist'), 'perm' => 'view-dashboard'],
      ],
    ],
  ];

  $activePath = request()->path();
  $isActive = function (?string $routeName, ?string $url) use ($activePath): bool {
    try {
      $target = $routeName ? route($routeName) : $url;
      if (!$target) return false;
      $path = parse_url($target, PHP_URL_PATH) ?: '/';
      $path = ltrim($path, '/');
      if ($path === '') $path = '/';
      return $path === $activePath || ($path !== '/' && str_starts_with($activePath, $path));
    } catch (\Throwable $e) {
      return false;
    }
  };
@endphp
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'BaseProject') }}</title>
  <style>
    :root{
      --bg: #f6f7fb;
      --panel: #ffffff;
      --text: #0f172a;
      --muted: #64748b;
      --border: rgba(15, 23, 42, .12);
      --shadow: 0 10px 26px rgba(2, 6, 23, .08);
      --primary: {{ $primary }};
      --accent: {{ $accent }};
      --ring: rgba(37, 99, 235, .22);
    }
    *{box-sizing:border-box}
    body{font-family: system-ui, -apple-system, Segoe UI, Roboto, Inter, Arial; margin:0; background:var(--bg); color:var(--text)}
    a{color:inherit; text-decoration:none}

    .shell{display:grid; grid-template-columns: 280px 1fr; min-height:100vh}
    .sidebar{background:var(--panel); border-right:1px solid var(--border); padding:16px; position:sticky; top:0; height:100vh; overflow:auto}
    .brand{display:flex; align-items:center; gap:10px; padding:10px 10px; border-radius:14px; border:1px solid var(--border); background:linear-gradient(180deg, rgba(37,99,235,.06), rgba(245,158,11,.06));}
    .brand .logo{width:36px; height:36px; border-radius:12px; background:linear-gradient(135deg,var(--primary),var(--accent)); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:900}
    .brand .meta{min-width:0}
    .brand .name{font-weight:900; line-height:1.1}
    .brand .sub{font-size:12px; color:var(--muted); overflow:hidden; text-overflow:ellipsis; white-space:nowrap}

    .section{margin-top:14px;}
    .section .title{display:flex; align-items:center; justify-content:space-between; font-size:12px; letter-spacing:.14em; text-transform:uppercase; color:var(--muted); padding:8px 10px}
    .items{list-style:none; margin:0; padding:0}
    .items a{display:flex; align-items:center; justify-content:space-between; gap:10px; padding:10px 10px; border-radius:12px; border:1px solid transparent; color:var(--text)}
    .items a:hover{background:rgba(37,99,235,.06); border-color:rgba(37,99,235,.12)}
    .items a.active{background:rgba(37,99,235,.10); border-color:rgba(37,99,235,.22)}
    .items .hint{font-size:12px; color:var(--muted)}

    .topbar{display:flex; justify-content:space-between; align-items:center; padding:14px 18px; border-bottom:1px solid var(--border); background:rgba(255,255,255,.9); backdrop-filter: blur(10px); position:sticky; top:0; z-index:20}
    .topbar .left{display:flex; align-items:center; gap:10px}
    .btn{display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:12px; border:1px solid var(--border); background:var(--panel); cursor:pointer; font-weight:700}
    .btn:hover{box-shadow: 0 8px 16px rgba(2,6,23,.06)}
    .pill{display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px; border:1px solid var(--border); background:var(--panel); font-size:12px; color:var(--muted); font-weight:700}
    .pill strong{color:var(--text)}
    .content{padding:18px}
    .card{background:var(--panel); border:1px solid var(--border); border-radius:18px; box-shadow: var(--shadow); padding:16px}
    .flash{margin:12px 0; padding:10px 12px; border-radius:14px; border:1px solid rgba(34,197,94,.25); background:rgba(34,197,94,.08); color:#166534; font-weight:700}
    .error{margin:12px 0; padding:10px 12px; border-radius:14px; border:1px solid rgba(239,68,68,.25); background:rgba(239,68,68,.08); color:#991b1b; font-weight:700}

    /* mobile */
    @media (max-width: 980px){
      .shell{grid-template-columns: 1fr}
      .sidebar{position:fixed; left:-310px; width:280px; transition:left .2s ease; z-index:50}
      .sidebar.open{left:0}
    }
  </style>
  @stack('head')
</head>
<body>
  <div class="shell">
    <aside id="sidebar" class="sidebar">
      <div class="brand">
        <div class="logo">BP</div>
        <div class="meta">
          <div class="name">{{ config('app.name', 'BaseProject') }}</div>
          <div class="sub">
            @if($tenant)
              Tenant: {{ $tenant->name }}
            @else
              No tenant selected
            @endif
          </div>
        </div>
      </div>

      @foreach($sections as $sec)
        @php
          $visibleItems = [];
          foreach ($sec['items'] as $it) {
            $routeName = $it['route'] ?? null;
            $url = $it['url'] ?? null;
            if ($routeName && !$routeOk($routeName)) continue;
            if (!$routeName && !$url) continue;
            if (!auth()->check()) continue;
            if (!$can($it['perm'] ?? null)) continue;
            $visibleItems[] = $it;
          }
        @endphp
        @if(count($visibleItems))
          <div class="section">
            <div class="title">{{ $sec['label'] }}</div>
            <ul class="items">
              @foreach($visibleItems as $it)
                @php
                  $routeName = $it['route'] ?? null;
                  $url = $routeName ? route($routeName) : ($it['url'] ?? '#');
                  $active = $isActive($routeName, $it['url'] ?? null);
                  $external = (bool)($it['external'] ?? false);
                @endphp
                <li>
                  <a href="{{ $url }}" class="{{ $active ? 'active' : '' }}" @if($external) target="_blank" @endif>
                    <span>{{ $it['label'] }}</span>
                    @if($external)
                      <span class="hint">↗</span>
                    @endif
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
      @endforeach
    </aside>

    <div>
      <div class="topbar">
        <div class="left">
          <button class="btn" id="toggleSidebar" type="button">Menu</button>
          @if($tenant)
            <span class="pill"><strong>{{ $tenant->slug }}</strong></span>
          @endif
        </div>
        <div style="display:flex; align-items:center; gap:10px;">
          @if(auth()->check())
            <span class="pill">Signed in: <strong>{{ auth()->user()->name }}</strong></span>
            @if(session()->has('impersonator_id'))
              <form method="POST" action="/admin/impersonate/stop" style="margin:0;">
                @csrf
                <button class="btn" type="submit">Stop Impersonation</button>
              </form>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
              @csrf
              <button class="btn" type="submit">Logout</button>
            </form>
          @else
            <a class="btn" href="{{ route('login') }}">Login</a>
          @endif
        </div>
      </div>

      <main class="content">
        @if (session('status'))
          <div class="flash">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
          <div class="error">
            <div style="margin-bottom:6px;">Please fix the following:</div>
            <ul style="margin:0; padding-left:18px;">
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
      </main>
    </div>
  </div>

  <script>
    const toggle = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    toggle?.addEventListener('click', () => sidebar.classList.toggle('open'));
  </script>
  @stack('scripts')
</body>
</html>

