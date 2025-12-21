@extends('layouts.app')

@section('content')
@php
  $tenantId = function_exists('tenant_id') ? tenant_id() : null;
  $counts = [
    'members' => 0,
    'donors' => 0,
    'donations' => 0,
    'news' => 0,
    'pages' => 0,
    'tickets' => 0,
  ];

  try { if (\Illuminate\Support\Facades\Schema::hasTable('users')) $counts['members'] = \DB::table('users')->count(); } catch (\Throwable $e) {}
  try { if (\Illuminate\Support\Facades\Schema::hasTable('donors')) $counts['donors'] = \DB::table('donors')->count(); } catch (\Throwable $e) {}
  try { if (\Illuminate\Support\Facades\Schema::hasTable('donations')) $counts['donations'] = \DB::table('donations')->count(); } catch (\Throwable $e) {}
  try { if (\Illuminate\Support\Facades\Schema::hasTable('posts')) $counts['news'] = $tenantId && \Illuminate\Support\Facades\Schema::hasColumn('posts','tenant_id') ? \DB::table('posts')->where('tenant_id',$tenantId)->count() : \DB::table('posts')->count(); } catch (\Throwable $e) {}
  try { if (\Illuminate\Support\Facades\Schema::hasTable('pages')) $counts['pages'] = $tenantId && \Illuminate\Support\Facades\Schema::hasColumn('pages','tenant_id') ? \DB::table('pages')->where('tenant_id',$tenantId)->count() : \DB::table('pages')->count(); } catch (\Throwable $e) {}
  try { if (\Illuminate\Support\Facades\Schema::hasTable('support_tickets')) $counts['tickets'] = $tenantId && \Illuminate\Support\Facades\Schema::hasColumn('support_tickets','tenant_id') ? \DB::table('support_tickets')->where('tenant_id',$tenantId)->count() : \DB::table('support_tickets')->count(); } catch (\Throwable $e) {}
@endphp

<div class="content-header row">
  <div class="content-header-left col-md-8 col-12 mb-2">
    <div class="row breadcrumbs-top">
      <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Dashboard</h2>
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Overview</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content-header-right col-md-4 col-12 text-md-right mb-2">
    <a href="{{ url('/ngo') }}" class="btn btn-outline-primary" target="_blank">Open Website</a>
    <a href="{{ url('/newsList') }}" class="btn btn-primary">Manage News</a>
  </div>
</div>

<div class="row match-height">
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Members</h6>
        <h2 class="mb-0">{{ $counts['members'] }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Donors</h6>
        <h2 class="mb-0">{{ $counts['donors'] }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Donations</h6>
        <h2 class="mb-0">{{ $counts['donations'] }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">News Posts</h6>
        <h2 class="mb-0">{{ $counts['news'] }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Pages</h6>
        <h2 class="mb-0">{{ $counts['pages'] }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <h6 class="text-muted mb-0">Support Tickets</h6>
        <h2 class="mb-0">{{ $counts['tickets'] }}</h2>
      </div>
    </div>
  </div>
</div>

@endsection

