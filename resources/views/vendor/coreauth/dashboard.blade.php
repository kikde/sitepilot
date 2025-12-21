@extends('coreauth::layouts.base')

@section('content')
@php
  $counts = [];
  try { $counts['users'] = \DB::table('users')->count(); } catch (\Throwable $e) { $counts['users']=0; }
  try { $counts['tenants'] = \Schema::hasTable('tenants') ? \DB::table('tenants')->count() : 0; } catch (\Throwable $e) { $counts['tenants']=0; }
  try { $counts['domains'] = \Schema::hasTable('tenant_domains') ? \DB::table('tenant_domains')->where('status','verified')->count() : 0; } catch (\Throwable $e) { $counts['domains']=0; }
  try { $counts['plans'] = \Schema::hasTable('billing_plans') ? \DB::table('billing_plans')->count() : 0; } catch (\Throwable $e) { $counts['plans']=0; }
  try { $counts['subscriptions'] = \Schema::hasTable('billing_subscriptions') ? \DB::table('billing_subscriptions')->count() : 0; } catch (\Throwable $e) { $counts['subscriptions']=0; }
  try { $counts['invoices'] = \Schema::hasTable('billing_invoices') ? \DB::table('billing_invoices')->count() : 0; } catch (\Throwable $e) { $counts['invoices']=0; }
@endphp

<style>
  .grid{display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:14px}
  .stat{border:1px solid rgba(15,23,42,.12); border-radius:16px; padding:14px 14px; background:#fff}
  .stat .label{color:#64748b; font-size:12px; letter-spacing:.12em; text-transform:uppercase; font-weight:800}
  .stat .num{font-size:30px; font-weight:900; line-height:1.1; margin-top:8px; color:#0f172a}
  .stat .sub{margin-top:8px; color:#64748b; font-weight:700; font-size:13px}
  .quick{display:flex; flex-wrap:wrap; gap:10px; margin-top:14px}
  .qbtn{display:inline-flex; align-items:center; gap:8px; padding:10px 12px; border-radius:14px; border:1px solid rgba(15,23,42,.12); background:#fff; font-weight:800}
  .qbtn:hover{background:rgba(37,99,235,.06); border-color:rgba(37,99,235,.22)}
</style>

<div style="display:flex; justify-content:space-between; align-items:flex-end; gap:12px; flex-wrap:wrap;">
  <div>
    <h1 style="margin:0; font-size:22px; font-weight:900;">Dashboard</h1>
    <div style="margin-top:6px; color:#64748b; font-weight:700;">
      Welcome {{ auth()->check() ? auth()->user()->name : 'Guest' }}.
    </div>
  </div>
  <div style="color:#64748b; font-weight:700;">
    {{ now()->format('M d, Y') }}
  </div>
</div>

<div class="grid" style="margin-top:14px;">
  <div class="stat"><div class="label">Users</div><div class="num">{{ $counts['users'] }}</div><div class="sub">All users in DB</div></div>
  <div class="stat"><div class="label">Tenants</div><div class="num">{{ $counts['tenants'] }}</div><div class="sub">Total tenants</div></div>
  <div class="stat"><div class="label">Verified Domains</div><div class="num">{{ $counts['domains'] }}</div><div class="sub">Domains verified</div></div>
  <div class="stat"><div class="label">Plans</div><div class="num">{{ $counts['plans'] }}</div><div class="sub">Billing plans</div></div>
  <div class="stat"><div class="label">Subscriptions</div><div class="num">{{ $counts['subscriptions'] }}</div><div class="sub">Active records</div></div>
  <div class="stat"><div class="label">Invoices</div><div class="num">{{ $counts['invoices'] }}</div><div class="sub">Total invoices</div></div>
</div>

<div class="quick">
  @if(\Illuminate\Support\Facades\Route::has('tenancy.admin.tenants.index'))
    <a class="qbtn" href="{{ route('tenancy.admin.tenants.index') }}">Tenants</a>
  @endif
  @if(\Illuminate\Support\Facades\Route::has('billing.admin.plans'))
    <a class="qbtn" href="{{ route('billing.admin.plans') }}">Plans</a>
  @endif
  @if(\Illuminate\Support\Facades\Route::has('billing'))
    <a class="qbtn" href="{{ route('billing') }}">Billing Portal</a>
  @endif
  @if(\Illuminate\Support\Facades\Route::has('media.admin.index'))
    <a class="qbtn" href="{{ route('media.admin.index') }}">Media</a>
  @endif
  <a class="qbtn" href="{{ url('/ngo') }}" target="_blank">View NGO</a>
</div>

@endsection

