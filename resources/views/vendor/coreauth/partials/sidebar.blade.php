@php
  $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
  $tenant = $tm->current();
  $tenantId = $tenant?->id;
  $userId = auth()->id();
  $isSuperAdmin = auth()->check() && auth()->user()?->email === config('coreauth.superadmin.email');
  $can = function (string $perm) use ($tm, $tenantId, $userId): bool {
    if (!$userId || !$tenantId) return false;
    return $tm->userHasPermission($userId, $perm, $tenantId);
  };

  $navSections = [];
  try {
    $navSections = app(\Dapunjabi\CoreAuth\Support\AdminNavRegistry::class)->all();
  } catch (\Throwable $e) {
    $navSections = [];
  }

  $resolveHref = function (array $item): string {
    $r = $item['route'] ?? null;
    if ($r && \Illuminate\Support\Facades\Route::has($r)) {
      try { return route($r); } catch (\Throwable $e) {}
    }
    $url = $item['url'] ?? '#';
    return $url ?: '#';
  };

  $isActiveItem = function (array $item) use ($resolveHref): bool {
    $r = $item['route'] ?? null;
    if ($r && request()->routeIs($r)) return true;
    $href = $resolveHref($item);
    try {
      $path = parse_url($href, PHP_URL_PATH);
      if ($path) {
        $path = ltrim($path, '/');
        if ($path !== '' && request()->is($path) || request()->is($path.'/*')) return true;
      }
    } catch (\Throwable $e) {}
    return false;
  };

  $showItem = function (array $item) use ($isSuperAdmin, $can, $tenantId): bool {
    if (!empty($item['platform'])) {
      return $isSuperAdmin;
    }
    $perm = $item['permission'] ?? null;
    if ($perm) {
      return $isSuperAdmin || ($tenantId && $can($perm));
    }
    return true;
  };
@endphp

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <span class="brand-logo"><div class="brand-badge">BP</div></span>
                    <h2 class="brand-text mb-0">{{ strtoupper(substr(str_replace(' ', '', config('app.name','BaseProject')),0,8)) }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @foreach($navSections as $section)
                @php
                    $visibleItems = array_values(array_filter($section['items'] ?? [], fn($it) => $showItem($it)));
                    if (empty($visibleItems)) continue;
                @endphp

                <li class="menu-section">{{ $section['label'] }}</li>

                @foreach($visibleItems as $item)
                    @php
                        $children = array_values(array_filter($item['children'] ?? [], fn($it) => $showItem($it)));
                        $hasChildren = !empty($children);
                        $itemActive = $isActiveItem($item);
                        $childActive = false;
                        if ($hasChildren) {
                            foreach ($children as $ch) { if ($isActiveItem($ch)) { $childActive = true; break; } }
                        }
                        $open = $hasChildren && ($childActive || $itemActive);
                        $icon = $item['icon'] ?? 'circle';
                        $href = $resolveHref($item);
                    @endphp

                    @if($hasChildren)
                        <li class="nav-item has-sub {{ $open ? 'open' : '' }}">
                            <a class="d-flex align-items-center" href="#">
                                <i data-feather="{{ $icon }}"></i>
                                <span class="menu-title text-truncate">{{ $item['label'] ?? 'Untitled' }}</span>
                            </a>
                            <ul class="menu-content">
                                @foreach($children as $child)
                                    @php
                                        $chIcon = $child['icon'] ?? 'circle';
                                        $chHref = $resolveHref($child);
                                        $chActive = $isActiveItem($child);
                                        $target = !empty($child['target']) ? $child['target'] : ((!empty($child['url']) && str_starts_with((string)$child['url'],'http')) ? '_blank' : null);
                                    @endphp
                                    <li class="{{ $chActive ? 'active' : '' }}">
                                        <a class="d-flex align-items-center" href="{{ $chHref }}" @if($target) target="{{ $target }}" @endif>
                                            <i data-feather="{{ $chIcon }}"></i>
                                            <span class="menu-item text-truncate">{{ $child['label'] ?? 'Item' }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        @php
                            $target = !empty($item['target']) ? $item['target'] : ((!empty($item['url']) && str_starts_with((string)$item['url'],'http')) ? '_blank' : null);
                        @endphp
                        <li class="nav-item {{ $itemActive ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ $href }}" @if($target) target="{{ $target }}" @endif>
                                <i data-feather="{{ $icon }}"></i>
                                <span class="menu-title text-truncate">{{ $item['label'] ?? 'Item' }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
