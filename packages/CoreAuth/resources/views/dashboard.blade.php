@extends('coreauth::layouts.base')

@section('content')
<h2 style="margin:0 0 12px;">Dashboard</h2>
<p class="muted" style="margin:0 0 12px;">Welcome @if(Auth::check()) {{ Auth::user()->name }} @else Guest @endif</p>
@php
  $counts = [];
  try { $counts['users'] = \DB::table('users')->count(); } catch (\Throwable $e) { $counts['users']=0; }
  try { $counts['tenants'] = \Schema::hasTable('coreauth_tenants') ? \DB::table('coreauth_tenants')->count() : (\Schema::hasTable('tenants') ? \DB::table('tenants')->count() : 0); } catch (\Throwable $e) { $counts['tenants']=0; }
  try { $counts['posts'] = \Schema::hasTable('posts') ? (function_exists('tenant_id') ? \DB::table('posts')->where('tenant_id', tenant_id())->count() : \DB::table('posts')->count()) : 0; } catch (\Throwable $e) { $counts['posts']=0; }
  try { $counts['invoices'] = \Schema::hasTable('billing_invoices') ? \DB::table('billing_invoices')->count() : 0; } catch (\Throwable $e) { $counts['invoices']=0; }
  try { $counts['sessions'] = \Schema::hasTable('coreauth_sessions') ? \DB::table('coreauth_sessions')->count() : 0; } catch (\Throwable $e) { $counts['sessions']=0; }
  try { $counts['plans'] = \Schema::hasTable('billing_plans') ? \DB::table('billing_plans')->count() : 0; } catch (\Throwable $e) { $counts['plans']=0; }
  try { $counts['domains'] = \Schema::hasTable('tenant_domains') ? \DB::table('tenant_domains')->where('status','verified')->count() : 0; } catch (\Throwable $e) { $counts['domains']=0; }
@endphp

<style>
  .cards{display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:18px}
  .stat{position:relative; border-radius:16px; padding:18px 20px; color:#fff; box-shadow:0 10px 24px rgba(0,0,0,.18)}
  .stat small{opacity:.95; letter-spacing:.5px; font-weight:600}
  .stat .num{font-size:32px; font-weight:800; line-height:1.15; margin-top:6px}
  .stat .ico{position:absolute; right:16px; top:12px; opacity:.9}
  .stat .ico svg{width:28px; height:28px; stroke:#ffffff; fill:none; stroke-width:2}
  .g1{background:linear-gradient(135deg,#1e40af,#2563eb)}
  .g2{background:linear-gradient(135deg,#16a34a,#22c55e)}
  .g3{background:linear-gradient(135deg,#6b7280,#4b5563)}
  .g4{background:linear-gradient(135deg,#60a5fa,#38bdf8)}
  .g5{background:linear-gradient(135deg,#22c55e,#16a34a)}
  .g6{background:linear-gradient(135deg,#2563eb,#1d4ed8)}
  .g7{background:linear-gradient(135deg,#a78bfa,#6366f1)}
  .g8{background:linear-gradient(135deg,#1e40af,#2563eb)}
  [data-theme="light"] .stat{box-shadow:0 10px 24px rgba(2,6,23,.12)}
  .cards .stat{border:1px solid rgba(255,255,255,.14)}
</style>
<div class="cards" style="margin:12px 0 20px;">
  <div class="stat g2">
    <small>TOTAL USERS</small>
    <div class="num">{{ $counts['users'] }}</div>
    <span class="ico"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></span>
  </div>
  <div class="stat g7">
    <small>TOTAL TENANTS</small>
    <div class="num">{{ $counts['tenants'] }}</div>
    <span class="ico"><svg viewBox="0 0 24 24"><path d="M3 21V8l9-5 9 5v13"/><path d="M9 21V12h6v9"/></svg></span>
  </div>
  <div class="stat g1">
    <small>TOTAL POSTS</small>
    <div class="num">{{ $counts['posts'] }}</div>
    <span class="ico"><svg viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg></span>
  </div>
  <div class="stat g4">
    <small>TOTAL INVOICES</small>
    <div class="num">{{ $counts['invoices'] }}</div>
    <span class="ico"><svg viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8"/></svg></span>
  </div>
  <div class="stat g6">
    <small>ACTIVE SESSIONS</small>
    <div class="num">{{ $counts['sessions'] }}</div>
    <span class="ico"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M9 20h6"/></svg></span>
  </div>
  <div class="stat g3">
    <small>PLANS</small>
    <div class="num">{{ $counts['plans'] }}</div>
    <span class="ico"><svg viewBox="0 0 24 24"><path d="M12 2v20"/><path d="M2 7h20"/></svg></span>
  </div>
  <div class="stat g8">
    <small>VERIFIED DOMAINS</small>
    <div class="num">{{ $counts['domains'] }}</div>
    <span class="ico"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 12l2 2 4-4"/></svg></span>
  </div>
</div>

@php
    $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
    $tenant = $tm->current();
@endphp
@if($tenant)
  <div style="margin:8px 0;">
    <span class="muted">Tenant:</span> <strong>{{ $tenant->name }}</strong>
    <span style="margin-left:8px; padding:2px 8px; border-radius:9999px; font-size:0.85rem; {{ ($tenant->license_status ?? 'active') === 'active' ? 'background:#dcfce7; color:#166534;' : 'background:#fee2e2; color:#991b1b;' }}">
        License: {{ strtoupper($tenant->license_status ?? 'active') }}
    </span>
    <a href="{{ route('billing') }}" style="margin-left:8px;">Billing</a>
  </div>
@endif





@endsection
