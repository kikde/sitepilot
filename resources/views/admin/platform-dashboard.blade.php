@extends('coreauth::layouts.base')

@section('content')
@php
  $tenantCount = 0;
  $domainCount = 0;
  $invoiceCount = 0;
  $planCount = 0;
  try { $tenantCount = \Illuminate\Support\Facades\Schema::hasTable('tenants') ? \DB::table('tenants')->count() : (\DB::table('coreauth_tenants')->count() ?? 0); } catch (\Throwable $e) {}
  try { $domainCount = \Illuminate\Support\Facades\Schema::hasTable('tenant_domains') ? \DB::table('tenant_domains')->where('status','verified')->count() : 0; } catch (\Throwable $e) {}
  try { $invoiceCount = \Illuminate\Support\Facades\Schema::hasTable('billing_invoices') ? \DB::table('billing_invoices')->count() : 0; } catch (\Throwable $e) {}
  try { $planCount = \Illuminate\Support\Facades\Schema::hasTable('billing_plans') ? \DB::table('billing_plans')->count() : 0; } catch (\Throwable $e) {}
@endphp

<div class="content-header row">
  <div class="content-header-left col-md-8 col-12 mb-2">
    <div class="row breadcrumbs-top">
      <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Platform Dashboard</h2>
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Overview</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content-header-right col-md-4 col-12 text-md-right mb-2">
    <a href="{{ url('/admin/demo') }}" class="btn btn-outline-primary">Demo Guide</a>
    <a href="{{ url('/admin/tenants') }}" class="btn btn-primary">Manage Tenants</a>
  </div>
</div>

<div class="row match-height">
  <div class="col-lg-3 col-sm-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Tenants</h6>
        <h2 class="mb-0">{{ $tenantCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Verified Domains</h6>
        <h2 class="mb-0">{{ $domainCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Plans</h6>
        <h2 class="mb-0">{{ $planCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Invoices</h6>
        <h2 class="mb-0">{{ $invoiceCount }}</h2>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Quick Actions</h4>
      </div>
      <div class="card-body">
        <div class="d-flex flex-wrap" style="gap:10px;">
          <a class="btn btn-outline-primary" href="{{ url('/admin/tenants') }}">Tenants</a>
          <a class="btn btn-outline-primary" href="{{ url('/admin/plans') }}">Plans</a>
          <a class="btn btn-outline-primary" href="{{ url('/admin/billing/invoices') }}">Invoices</a>
          <a class="btn btn-outline-primary" href="{{ url('/admin/webhooks') }}">Webhooks</a>
          <a class="btn btn-outline-primary" href="{{ url('/tenant/select') }}">Switch Tenant</a>
          <a class="btn btn-outline-primary" href="{{ url('/ngo') }}" target="_blank">Open NGO Site</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Domains Tip</h4>
      </div>
      <div class="card-body">
        <p class="mb-0 text-muted">
          For local multi-domain testing, point domains like <code>tenant1.test</code> and <code>tenant2.test</code> to the same project folder in Laragon.
          After adding a domain, verify it in <strong>Admin → Tenants → Domains</strong>.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

