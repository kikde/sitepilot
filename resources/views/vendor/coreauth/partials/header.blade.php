@php
  $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
  $tenant = $tm->current();
  $tenantOptions = collect();
  $isSuperAdmin = false;
  try {
    if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Schema::hasTable('coreauth_role_user')) {
      $userId = \Illuminate\Support\Facades\Auth::id();
      $isSuperAdmin =
        (\Illuminate\Support\Facades\Auth::user()?->email === config('coreauth.superadmin.email')) ||
        \Illuminate\Support\Facades\DB::table('coreauth_role_user')->where('user_id', $userId)->where('role_slug', 'superadmin')->exists();

      if (\Illuminate\Support\Facades\Schema::hasTable('coreauth_tenants')) {
        if ($isSuperAdmin) {
          $tenantOptions = \Illuminate\Support\Facades\DB::table('coreauth_tenants')->select('id', 'name', 'slug')->orderBy('id')->get();
        } else {
          $tenantIds = collect();
          if (\Illuminate\Support\Facades\Schema::hasTable('coreauth_tenant_user')) {
            $tenantIds = \Illuminate\Support\Facades\DB::table('coreauth_tenant_user')->where('user_id', $userId)->pluck('tenant_id');
          }
          if ($tenantIds->isEmpty()) {
            $tenantIds = \Illuminate\Support\Facades\DB::table('coreauth_role_user')->where('user_id', $userId)->distinct()->pluck('tenant_id');
          }
          if ($tenantIds->isNotEmpty()) {
            $tenantOptions = \Illuminate\Support\Facades\DB::table('coreauth_tenants')->select('id', 'name', 'slug')->whereIn('id', $tenantIds)->orderBy('id')->get();
          }
        }
      }
    }
  } catch (\Throwable $e) {}
@endphp
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
            <div class="brand-wrap">
                <div class="brand-badge">BP</div>
                <div>
                    <div class="brand-title">{{ config('app.name','BaseProject') }}</div>
                    <div class="brand-sub">
                        @if($tenant)
                            {{ $tenant->slug }}
                        @else
                            No tenant selected
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="menu-item-pill">
                            @if($tenant) Tenant: {{ $tenant->slug }} @else Select Tenant @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if($tenantOptions->isNotEmpty())
                            @foreach($tenantOptions as $t)
                                <form method="POST" action="{{ url('/tenant/select') }}" class="m-0">
                                    @csrf
                                    <input type="hidden" name="tenant_id" value="{{ (int) $t->id }}">
                                    <button type="submit" class="dropdown-item @if($tenant && (int)$tenant->id === (int)$t->id) active @endif">
                                        {{ $t->slug }} <span class="text-muted">— {{ $t->name }}</span>
                                    </button>
                                </form>
                            @endforeach
                            <div class="dropdown-divider"></div>
                        @endif
                        <a class="dropdown-item" href="{{ route('tenant.select') }}">
                            <i class="mr-50" data-feather="layers"></i> Tenant Selector
                        </a>
                        @if($isSuperAdmin)
                            <a class="dropdown-item" href="{{ url('/admin/tenants') }}">
                                <i class="mr-50" data-feather="globe"></i> Manage Tenants
                            </a>
                        @endif
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{ auth()->user()->name }}</span>
                            <span class="user-status">Admin</span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ asset('backend/uploads/user.jpg') }}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('account.profile') }}"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('account.sessions') }}"><i class="mr-50" data-feather="clock"></i> Sessions</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('coreauth-logout-form').submit();">
                            <i class="mr-50" data-feather="power"></i> Logout
                        </a>
                        <form id="coreauth-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
</nav>
