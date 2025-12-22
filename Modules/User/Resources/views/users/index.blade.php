{{-- =========================================================================================
| Users List (Admin) - refreshed mobile UI + Back button
|========================================================================================= --}}
@extends('layouts.app')

@section('content')
<style>
  /* Desktop: cap search width so it doesn’t sprawl */
  @media (min-width: 768px){
    .search-wrap { min-width: 360px; max-width: 520px; }
  }
  .search-group .input-group-text { border-right: 0; }
  .search-group .form-control    { border-left: 1; height: 3.142rem !important; }
  .search-group .btn {border-left: 0;}

  /* ---------- Header actions ---------- */
  .page-actions{ gap:.5rem; }
  .btn-back{
    display:inline-flex; align-items:center; gap:.35rem;
    border-radius:10px; border:1px solid #e5e7eb; background:#fff;
    padding:.45rem .75rem; font-weight:600;
  }
  .btn-back i{ width:18px;height:18px; }

  /* ---------- Mobile cards polish ---------- */
  @media (max-width: 767.98px){
    .user-cards{ display:grid; gap: .85rem; }
    .user-card{
      border: 1px solid #edf1f5;
      border-radius: 16px;
      box-shadow: 0 10px 24px rgba(16,24,40,.06);
    }
    .user-card .card-body{ padding: 14px 14px 12px; }

    .user-card .card-body > .card-head{
      display:flex; align-items:center; gap:12px; margin-bottom:.25rem;
    }
    .user-card .avatar{
      width:76px; height:76px; border-radius:50%; object-fit:cover; background:#f3f4f6;
    }
    .user-card h5{
      font-size:1.06rem; line-height:1.15; margin:0; font-weight:800; color:#111827;
    }
    .user-card small{ color:#6b7280; font-size:.86rem; }

    /* key-value grid */
    .user-card .kv{
      display:grid;
      grid-template-columns: 1fr auto; /* label | control/value squeezed right */
      row-gap:.45rem; column-gap:.75rem;
      margin-top:.35rem;
    }
    .user-card .kv .k{
      color:#6b7280; font-size:.9rem; line-height:1.2; align-self:center;
    }
    .user-card .kv .v{ align-self:center; }
  .user-card .kv .v.right{ display:flex; justify-content:flex-end; align-items:center; }
  /* Verified controls: keep toggle and eye button equal height */
  .verified-controls{ display:inline-flex; align-items:center; gap:8px; }
  .verified-controls .custom-control.custom-switch{ min-height:32px; }
  .verified-controls .btn-eye{ height:32px; width:32px; padding:0; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; }

    /* switches & small buttons compact */
    .custom-control.custom-switch{ min-height:1.5rem; }
    .user-card .dropdown > .btn{
      padding:.4rem .6rem; border-radius:10px; border-color:#e5e7eb; background:#fff;
    }
    /* make dropdown buttons auto-width (not full line) */
    .user-card .actions .btn{ width:auto; }
    .user-card .dropdown-menu{ border-radius:12px; overflow:hidden; border-color:#e5e7eb; }
    /* receipt button */
    .user-card .btn-chip{
      display:inline-flex; align-items:center; gap:.35rem;
      padding:.4rem .6rem; border-radius:999px; border:1px solid #e5e7eb; background:#fff;
      font-weight:600;
    }
  }

  .btn-outline-danger{ border-color:#ef4444; }

  /* ---- Remove horizontal scrollbar on this page ---- */
  .content-wrapper, .table-responsive, .user-cards{ overflow-x: hidden !important; }
  .table-responsive{ -ms-overflow-style: none; scrollbar-width: none; }
  .table-responsive::-webkit-scrollbar{ display:none; height:0; }
  /* Avoid clipping buttons/controls – allow wrapping inside cells */
  .table{ table-layout: auto; }
  .table th, .table td{ white-space: normal; word-break: break-word; overflow: visible; text-overflow: clip; }
  /* Keep ID column on one line so numbers don't split */
  .table th.col-id, .table td.col-id{ white-space: nowrap; word-break: keep-all; width: 80px; max-width: 80px; }
</style>

<div class="content-wrapper">
  {{-- ============================ Page Header ============================ --}}
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12 d-flex align-items-center justify-content-between">
          <div>
            <h2 class="content-header-title float-left mb-0">Members List</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Members List</li>
              </ol>
            </div>
          </div>

          {{-- Back + Add (stacks on mobile) --}}
          <div class="page-actions d-flex">
      <a href="javascript:void(0)" class="btn btn-outline-secondary btn-round btn-sm" data-smart-back>
  <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
</a>
            <a href="{{ url('/users-add') }}" class="btn btn-primary btn-round btn-sm">
              <i data-feather="plus"></i><span class="ms-1">Add New</span>
            </a>
            <button id="bulkDeleteBtn" type="button" class="btn btn-outline-danger btn-round btn-sm">
              <i data-feather="trash-2"></i><span class="ms-1">Delete Selected</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- =================================== Body ========================================= --}}
  <div class="content-body">
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
           

            <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center ms-md-auto gap-2 w-100 w-md-auto">
              {{-- Search --}}
              <form id="membersSearchForm" action="{{ route('users.search') }}" method="GET" class="search-wrap w-100 w-md-auto">
                <div class="input-group input-group-sm search-group mb-1">
                  <input type="text" name="q" id="searchInput" value="{{ request('q') }}" class="form-control" placeholder="Search name, email, mobile…" autocomplete="off">
                  <button class="btn btn-primary" type="submit">Search</button>
                </div>
              </form>
              {{-- Export --}}
              <button type="button" id="exportBtn" class="btn btn-success btn-sm w-100 w-md-auto">
                <i data-feather="download" class="me-1"></i> Export
              </button>
            </div>
          </div>

          {{-- ======================= DESKTOP TABLE ======================= --}}
          <div class="table-responsive d-none d-md-block">
            <form id="bulkDeleteForm" method="post" action="{{ route('admin.users.bulk.delete') }}">
              @csrf
            <table class="table">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAll"></th>
                  <th class="col-id">ID</th>
                  <th>Profile</th>
                  <th>Referred by</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Top-Ten</th>
                  <th>Top Performer</th>
                  <th>Verify Payment</th>
                  <!-- <th>Payments</th> -->
                  <th>Pdf Maker</th>
                  <th>Account Status</th>
                  <th>Receipt</th>
                  <th>Action</th>
                </tr>
              </thead>

              @if($user->count() > 0)
                @foreach($user as $users)
                  <tbody>
                    <tr>
                      <td><input type="checkbox" class="row-check" name="ids[]" value="{{ $users->id }}"></td>
                      <td class="col-id">{{ $users->id }}</td>
                      <td>
                        @if($users->profile_image)
                          <img src="{{ asset('backend/uploads/members/'.$users->profile_image) }}" class="avatar mr-50" height="80" width="80" alt="{{ $users->name }}" />
                        @else
                          <img src="{{ asset('backend/uploads/user.jpg') }}" class="avatar mr-50" height="80" width="80" alt="{{ $users->name }}" />
                        @endif
                      </td>
                      <td>
                        @if($users->referrer)
                          {{ $users->referrer->id }}-{{ $users->referrer->name }}
                        @else — @endif
                      </td>
                      <td>{{ $users->name }}</td>
                      <td>{{ $users->mobile }}</td>

                      {{-- Top-Ten --}}
                      <td>
                        @if($users->topten == 0)
                          <form action="{{ url('/deselect/'.$users->id) }}" method="post">
                            @csrf
                            <div class="custom-control custom-control-primary custom-switch">
                              <input type="checkbox" name="topten" value="0" class="custom-control-input" id="customSwitchTopTen{{$users->id}}" onchange="this.form.submit()">
                              <label class="custom-control-label" for="customSwitchTopTen{{$users->id}}"></label>
                            </div>
                          </form>
                        @else
                          <form action="{{ url('/select/'.$users->id) }}" method="post">
                            @csrf
                            <div class="custom-control custom-control-primary custom-switch">
                              <input type="checkbox" name="topten" value="1" class="custom-control-input" id="customSwitchTopTen{{$users->id}}" onchange="this.form.submit()" checked>
                              <label class="custom-control-label" for="customSwitchTopTen{{$users->id}}"></label>
                            </div>
                          </form>
                        @endif
                      </td>

                      {{-- Top Performer --}}
                      <td>
                        @if($users->pow == 0)
                          <form action="{{ url('/featured/'.$users->id) }}" method="post">
                            @csrf
                            <div class="custom-control custom-control-primary custom-switch">
                              <input type="checkbox" name="pow" value="0" class="custom-control-input" id="customSwitchPow{{$users->id}}" onchange="this.form.submit()">
                              <label class="custom-control-label" for="customSwitchPow{{$users->id}}"></label>
                            </div>
                          </form>
                        @else
                          <form action="{{ url('/unfeatured/'.$users->id) }}" method="post">
                            @csrf
                            <div class="custom-control custom-control-primary custom-switch">
                              <input type="checkbox" name="pow" value="1" class="custom-control-input" id="customSwitchPow{{$users->id}}" onchange="this.form.submit()" checked>
                              <label class="custom-control-label" for="customSwitchPow{{$users->id}}"></label>
                            </div>
                          </form>
                        @endif
                      </td>

                      {{-- Verified (toggle) --}}
                      <td>
                        @php
                          $receiptPath = optional($users->latestPayment)->payment_rec;
                          $hasReceipt  = filled($receiptPath);
                          $isVerified  = (bool) optional($users->latestPayment)->is_verified;
                          $isRendering = $isVerified && !$hasReceipt;
                        @endphp
                        <form action="{{ $hasReceipt ? url('/deactive-aff/'.$users->id) : url('/active-aff/'.$users->id) }}" method="post">
                          @csrf
                          <div class="custom-control custom-control-primary custom-switch">
                            <input type="checkbox" class="custom-control-input" id="verified{{$users->id}}" onchange="this.form.submit()" {{ $hasReceipt ? 'checked' : '' }} @if($isRendering) disabled @endif>
                            <label class="custom-control-label" for="verified{{$users->id}}"></label>
                          </div>
                        </form>
                        <div class="mt-25 verified-controls">
                          <a href="{{ route('admin.members.payments', $users->id) }}" title="View payments" class="btn btn-outline-primary btn-eye">
                            <i data-feather="eye"></i>
                          </a>
                          @if($hasReceipt)
                            <a href="{{ asset('storage/'.$receiptPath) }}" title="Download receipt" class="btn btn-outline-success btn-eye" download>
                              <i data-feather="download"></i>
                            </a>
                          @elseif($isRendering)
                            <small class="text-warning">Rendering…</small>
                          @else
                            <small class="text-muted">No Payment yet</small>
                          @endif
                        </div>
                      </td>

                      {{-- Payments link column --}}
                      <!-- <td>
                        <a href="{{ route('admin.members.payments', $users->id) }}" class="btn btn-outline-primary btn-sm btn-eye" title="View payments">
                          <i data-feather="eye"></i>
                        </a>
                      </td> -->

                      {{-- Pdf Maker --}}
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-danger dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if ($users->status == 1)
                              <a class="text-success" href="{{ url('/pdf/'.$users->id.'/active') }}">Activate</a>
                            @else
                              <a class="text-danger" href="{{ url('/pdf/'.$users->id.'/deactive') }}">Deactivate</a>
                            @endif
                          </button>
                          <div class="dropdown-menu">
                            @if ($users->status == 0)
                              <a class="dropdown-item text-success" href="{{ url('/pdf/'.$users->id.'/active') }}">Activate</a>
                            @endif
                            @if ($users->status)
                              <a class="dropdown-item text-danger" href="{{ url('/pdf/'.$users->id.'/deactive') }}">Deactivate</a>
                            @endif
                          </div>
                        </div>
                      </td>

                      {{-- Account Status --}}
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-danger dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if ($users->useractive == 1)
                              <a class="text-success" href="{{ url('/user/'.$users->id.'/active') }}">User Activate</a>
                            @else
                              <a class="text-danger" href="{{ url('/user/'.$users->id.'/deactive') }}">User Deactivate</a>
                            @endif
                          </button>
                          <div class="dropdown-menu">
                            @if ($users->useractive == 0)
                              <a class="dropdown-item text-success" href="{{ url('/user/'.$users->id.'/active') }}">User Activate</a>
                            @endif
                            @if ($users->useractive)
                              <a class="dropdown-item text-danger" href="{{ url('/user/'.$users->id.'/deactive') }}">User Deactivate</a>
                            @endif
                          </div>
                        </div>
                      </td>

                      {{-- Receipt --}}
                      <td>
                        @if($hasReceipt)
                          <div class="avatar bg-light-primary rounded" title="Download receipt">
                            <div class="avatar-content">
                              <a href="{{ asset('storage/'.$receiptPath) }}" download>
                                <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                              </a>
                            </div>
                          </div>
                        @else
                          <div class="avatar bg-light-danger rounded" title="No receipt">
                            <div class="avatar-content">
                              <i data-feather="x" class="avatar-icon font-medium-3"></i>
                            </div>
                          </div>
                        @endif
                      </td>

                      {{-- Actions --}}
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/user-edit/'.$users->id) }}">
                              <i data-feather="edit-2" class="mr-50"></i><span>Edit</span>
                            </a>
                            <a class="dropdown-item js-swal-delete" data-id="{{ $users->id }}" data-name="{{ $users->name ?? 'this item' }}"  href="{{ url('/user-delete/'.$users->id) }}"
                             >
                              <i data-feather="trash" class="mr-50"></i><span>Delete</span>
                            </a>
                            <form id="delete-media-post-m-{{ $users->id }}" action="{{ url('/user-delete/'.$users->id) }}" method="post">
                              @csrf @method('DELETE')
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                @endforeach
              @else
                <tbody><tr><td colspan="13" class="text-center text-muted">No Data found</td></tr></tbody>
              @endif
            </table>
            </form>
          </div>
           

          {{-- ======================= MOBILE CARDS ======================= --}}
          <div class="d-md-none">
            @if($user->count() > 0)
              <div class="user-cards">
                @foreach($user as $users)
                  @php
                    $receiptPath = optional($users->latestPayment)->payment_rec;
                    $hasReceipt  = filled($receiptPath);
                    $isVerified  = (bool) optional($users->latestPayment)->is_verified;
                    $isRendering = $isVerified && !$hasReceipt;
                  @endphp

                  <div class="card user-card">
                    <div class="card-body">
                      <div class="card-head">
                          @if($users->profile_image)
                          <img src="{{ asset('backend/uploads/members/'.$users->profile_image) }}" class="avatar mr-50" height="80" width="80" alt="{{ $users->name }}" />
                        @else
                          <img src="{{ asset('backend/uploads/user.jpg') }}" class="avatar mr-50" height="80" width="80" alt="{{ $users->name }}" />
                        @endif
                        <div class="flex-grow-1">
                          <h5>{{ $users->name }}</h5>
                          <small>{{ $users->mobile }}</small><br>
                          <small>ID-{{ $users->id }}</small>
                        </div>
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ url('/user-edit/'.$users->id) }}">Edit</a>

                            <a class="dropdown-item js-swal-delete" data-id="{{ $users->id }}" data-name="{{ $users->name ?? 'this item' }}" href="{{ url('/user-delete/'.$users->id) }}"
                              >
                              Delete
                            </a>
                            <form id="delete-media-post-m-{{ $users->id }}" action="{{ url('/user-delete/'.$users->id) }}" method="post" class="d-none">@csrf @method('DELETE')</form>
                          </div>
                        </div>
                      </div>



                      <div class="kv">
                        <div class="k">Referred by</div>
                        <div class="v">
                          @if($users->referrer) {{ $users->referrer->id }} — {{ $users->referrer->name }} @else — @endif
                        </div>

                        <div class="k">Top-Ten</div>
                        <div class="v right">
                          @if($users->topten == 0)
                            <form action="{{ url('/deselect/'.$users->id) }}" method="post">@csrf
                              <div class="custom-control custom-control-primary custom-switch">
                                <input type="checkbox" name="topten" value="0" class="custom-control-input" id="customSwitchTopTenM{{$users->id}}" onchange="this.form.submit()">
                                <label class="custom-control-label" for="customSwitchTopTenM{{$users->id}}"></label>
                              </div>
                            </form>
                          @else
                            <form action="{{ url('/select/'.$users->id) }}" method="post">@csrf
                              <div class="custom-control custom-control-primary custom-switch">
                                <input type="checkbox" name="topten" value="1" class="custom-control-input" id="customSwitchTopTenM{{$users->id}}" onchange="this.form.submit()" checked>
                                <label class="custom-control-label" for="customSwitchTopTenM{{$users->id}}"></label>
                              </div>
                            </form>
                          @endif
                        </div>

                        <div class="k">Top Performer</div>
                        <div class="v right">
                          @if($users->pow == 0)
                            <form action="{{ url('/featured/'.$users->id) }}" method="post">@csrf
                              <div class="custom-control custom-control-primary custom-switch">
                                <input type="checkbox" name="pow" value="0" class="custom-control-input" id="customSwitchPowM{{$users->id}}" onchange="this.form.submit()">
                                <label class="custom-control-label" for="customSwitchPowM{{$users->id}}"></label>
                              </div>
                            </form>
                          @else
                            <form action="{{ url('/unfeatured/'.$users->id) }}" method="post">@csrf
                              <div class="custom-control custom-control-primary custom-switch">
                                <input type="checkbox" name="pow" value="1" class="custom-control-input" id="customSwitchPowM{{$users->id}}" onchange="this.form.submit()" checked>
                                <label class="custom-control-label" for="customSwitchPowM{{$users->id}}"></label>
                              </div>
                            </form>
                          @endif
                        </div>

                        <div class="k">Verified</div>
                        <div class="v right">
                          <form action="{{ $hasReceipt ? url('/deactive-aff/'.$users->id) : url('/active-aff/'.$users->id) }}" method="post">@csrf
                            <div class="verified-controls">
                              <div class="custom-control custom-control-primary custom-switch">
                                <input type="checkbox" class="custom-control-input" id="verifiedM{{$users->id}}" onchange="this.form.submit()" {{ $hasReceipt ? 'checked' : '' }} @if($isRendering) disabled @endif>
                                <label class="custom-control-label" for="verifiedM{{$users->id}}"></label>
                              </div>
                              <a href="{{ route('admin.members.payments', $users->id) }}" title="View payments" class="btn btn-sm btn-outline-primary btn-eye">
                                <i data-feather="eye"></i>
                              </a>
                              @if($hasReceipt)
                                <a href="{{ asset('storage/'.$receiptPath) }}" title="Download receipt" class="btn btn-sm btn-outline-success btn-eye" download>
                                  <i data-feather="download"></i>
                                </a>
                              @elseif($isRendering)
                                <small class="text-warning" style="line-height:32px;">Rendering…</small>
                              @endif
                            </div>
                          </form>
                        </div>

                        <div class="k">PDF Maker</div>
                        <div class="v right actions">
                          <div class="btn-group">
                            <button type="button" class="btn btn-outline-danger dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              @if ($users->status == 1) Activate @else Deactivate @endif
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              @if ($users->status == 0)
                                <a class="dropdown-item text-success" href="{{ url('/pdf/'.$users->id.'/active') }}">Activate</a>
                              @endif
                              @if ($users->status)
                                <a class="dropdown-item text-danger" href="{{ url('/pdf/'.$users->id.'/deactive') }}">Deactivate</a>
                              @endif
                            </div>
                          </div>
                        </div>

                        <div class="k">Account</div>
                        <div class="v right actions">
                          <div class="btn-group">
                            <button type="button" class="btn btn-outline-danger dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              @if ($users->useractive == 1) User Activate @else User Deactivate @endif
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              @if ($users->useractive == 0)
                                <a class="dropdown-item text-success" href="{{ url('/user/'.$users->id.'/active') }}">User Activate</a>
                              @endif
                              @if ($users->useractive)
                                <a class="dropdown-item text-danger" href="{{ url('/user/'.$users->id.'/deactive') }}">User Deactivate</a>
                              @endif
                            </div>
                          </div>
                        </div>

                        <div class="k">Receipt</div>
                        <div class="v right">
                          @if($hasReceipt)
                            <a class="btn-chip" href="{{ asset('storage/'.$receiptPath) }}" download>
                              <i data-feather="arrow-down"></i> Download
                            </a>
                          @else
                            <span class="badge bg-light-danger text-danger">No receipt</span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="card"><div class="card-body text-center text-muted">No Data found</div></div>
            @endif
          </div>
          {{-- /MOBILE CARDS --}}
        </div>
      </div>
    </div>
  </div>
  
</div>
  @if(count($user)>0)
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-2">
                  {{ $user->links() }}
                </ul>
              </nav>
            @else
              <h5 class="justify-content-center">No Data found</h5>
            @endif

{{-- Helpers --}}
<script>
  function show_alert(){ alert("Do You Really Want To Delete This"); }

  document.addEventListener('DOMContentLoaded', function(){
    if (window.feather) feather.replace();
    // Bulk delete helpers
    const checkAll = document.getElementById('checkAll');
    const checks = Array.from(document.querySelectorAll('.row-check'));
    if (checkAll) {
      checkAll.addEventListener('change', function(){
        checks.forEach(c => { c.checked = checkAll.checked; });
      });
    }
    const bulkBtn = document.getElementById('bulkDeleteBtn');
    if (bulkBtn) {
      bulkBtn.addEventListener('click', function(){
        const any = Array.from(document.querySelectorAll('.row-check')).some(c => c.checked);
        if (!any) { alert('Select at least one user.'); return; }
        if (confirm('Delete selected users? This cannot be undone.')) {
          document.getElementById('bulkDeleteForm').submit();
        }
      });
    }
    const btn = document.getElementById('exportBtn');
    if (btn){
      btn.addEventListener('click', function(){
        const q = encodeURIComponent(document.getElementById('searchInput')?.value || '');
        const v = encodeURIComponent(document.getElementById('verifiedFilter')?.value || '');
        window.location = "{{ route('users.export') }}" + "?query=" + q + "&verified=" + v;
      });
    }
  });
</script>

<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.js-swal-delete');
  if (!btn) return;

  e.preventDefault();

  const id   = btn.getAttribute('data-id');
  const name = btn.getAttribute('data-name') || 'this item';
  const form = document.getElementById('delete-media-post-m-' + id);

  if (!form) { return; } // safety

  if (typeof Swal === 'undefined') {
    // Fallback if SweetAlert2 isn't loaded
    if (confirm('Delete ' + name + '? This cannot be undone.')) form.submit();
    return;
  }

  Swal.fire({
    title: 'Delete ' + name + '?',
    text: "This action can't be undone.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete',
    cancelButtonText: 'Cancel',
    buttonsStyling: false,
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ml-1'
    }
  }).then(function (result) {
    if (result.isConfirmed) form.submit();
  });
});
</script>
<script>
  // Stronger close that removes overlays entirely
  function hardCloseMenu() {
    const b = document.body;
    b.classList.remove('menu-open', 'menu-expanded');
    document.querySelectorAll('.sidenav-overlay, .drag-target').forEach(n => {
      try { n.remove(); } catch(_) {}
    });

    // Bootstrap offcanvas (if any)
    if (window.bootstrap) {
      document.querySelectorAll('.offcanvas.show').forEach(el => {
        const inst = bootstrap.Offcanvas.getInstance(el);
        if (inst) inst.hide();
      });
    }
  }

  // Choose where "Back" should land if referrer isn't usable
  const BACK_FALLBACK = "{{ url('/users') }}"; // <— adjust to your list route

  // Smart Back: close menu, prevent bubbling, then navigate
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-smart-back]');
    if (!btn) return;

    e.preventDefault();
    e.stopPropagation();     // don't let any header/overlay handlers fire

    hardCloseMenu();

    // Prefer same-origin referrer; otherwise go to fallback
    const ref = document.referrer || '';
    const sameOrigin = ref.startsWith(location.origin);
    const dest = btn.dataset.backHref || (sameOrigin ? ref : BACK_FALLBACK);

    // Use location.href instead of history.back() to avoid restoring stale UI state
    setTimeout(() => { location.href = dest; }, 0);
  });

  // Close any stuck sidebar on normal load *and* when page is restored from bfcache
  document.addEventListener('DOMContentLoaded', hardCloseMenu);
  window.addEventListener('pageshow', function(ev){
    // persisted === true means bfcache restore
    if (ev.persisted) hardCloseMenu();
  });
</script>


@endsection



