@extends('layouts.app')

@section('content')
<style>
  /* ---------- Header actions ---------- */
  .page-actions{ gap:.5rem; }
  .btn-back{
    display:inline-flex; align-items:center; gap:.35rem;
    border-radius:10px; border:1px solid #e5e7eb; background:#fff;
    padding:.45rem .75rem; font-weight:600;
  }
  .btn-back i{ width:18px;height:18px; }

  /* Cap search widths or other inline controls (future ready) */
  @media (min-width: 768px){
    .header-inline-wrap{ min-width: 320px; }
  }

  /* ===== Mobile polish (scoped to admin list) ===== */
  @media (max-width: 767.98px){
    .content-wrapper{ padding-left: 8px; padding-right: 8px; }

    /* Hide desktop table on phones */
    #admin-list .table-responsive{ display:none !important; }

    /* Cards grid */
    #admin-list .cards{ display:grid; gap:.9rem; padding: 0 .5rem .75rem; }

    /* Card shell */
    #admin-list .admin-card{
      border:1px solid #edf1f5; border-radius:16px;
      box-shadow:0 10px 24px rgba(16,24,40,.06); overflow:hidden;
    }
    #admin-list .admin-card .card-body{ padding:14px; }

    /* Card head */
    #admin-list .admin-card .card-head{
      display:flex; align-items:center; gap:12px; margin-bottom:.25rem;
    }
    #admin-list .avatar{
      width:76px; height:76px; border-radius:50%; object-fit:cover; background:#f3f4f6;
    }
    #admin-list h5{
      font-size:1.06rem; line-height:1.15; margin:0; font-weight:800; color:#111827;
    }
    #admin-list .sub{ color:#6b7280; font-size:.86rem; }

    /* Kebab button */
    #admin-list .dropdown > .btn{
      padding:.4rem .6rem; border-radius:10px; border:1px solid #e5e7eb; background:#fff;
    }

    /* Label/value grid */
    #admin-list .kv{
      display:grid; grid-template-columns: 110px 1fr; gap:.45rem .75rem; margin-top:.4rem;
    }
    #admin-list .kv .k{ color:#6b7280; font-size:.9rem; white-space:nowrap; }
    #admin-list .kv .v{ color:#111827; font-size:.95rem; }

    /* Status chip */
    .badge.rounded-pill{ border-radius:999px; padding:.35rem .6rem; font-weight:600; }

    /* Tiny phones */
    @media (max-width:360px){ #admin-list .kv{ grid-template-columns: 98px 1fr; } }
  }

  .btn-outline-danger{ border-color:#ef4444; }
  .btn:focus, .form-control:focus{ box-shadow:0 0 0 .2rem rgba(99,102,241,.12); }
</style>

<div class="content-wrapper">
  {{-- Header --}}
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12 d-flex align-items-center justify-content-between">
          <div>
            <h2 class="content-header-title float-left mb-0">Admins</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">User List</li>
              </ol>
            </div>
          </div>

          {{-- Back + Add --}}
          <div class="page-actions d-flex">
         <a href="javascript:void(0)" class="btn btn-outline-secondary btn-round btn-sm" data-smart-back>
  <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
</a>
            <a href="{{ url('/users/create') }}" class="btn btn-primary btn-round btn-sm">
              <i data-feather="plus"></i><span class="ms-1">Add New</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Body --}}
  <div class="content-body" id="admin-list">
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
   
          </div>

          {{-- Desktop table --}}
          <div class="table-responsive d-none d-md-block">
            <table class="table table-hover-animation">
              <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>

              @if(count($user)>0)
                @foreach($user as $users)
                 
                    <tbody>
                    <tr>
                      <td>{{$users->id }}</td>
                      <td>{{$users->name}}</td>
                      <td>{{$users->email}}</td>
                      <td>
                        @if ($users->role == 1)
                        <span class="badge badge-pill badge-light-primary mr-1">Admin</span>
                         @elseif ($users->role == 3)
                          <span class="badge badge-pill badge-light-danger mr-1">Manager</span>
                          @else
                          -
                        @endif
                      </td>
                      <td>
                        @if ($users->useractive)
                          <span class="badge badge-pill badge-light-primary mr-1">Active</span>
                        @else
                          <span class="badge badge-pill badge-light-danger mr-1">Deactive</span>
                        @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/profile/'.$users->id) }}">
                              <i data-feather="edit-2" class="mr-50"></i><span>Edit</span>
                            </a>
                            <a class="dropdown-item" href="{{ url('/user-delete/'.$users->id) }}"
                               onclick="event.preventDefault(); document.getElementById('delete-media-post-{{ $users->id }}').submit();">
                              <i data-feather="trash" class="mr-50"></i><span>Delete</span>
                            </a>
                            <form id="delete-media-post-{{ $users->id }}" action="{{ url('/user-delete/'.$users->id) }}" method="post">
                              @csrf @method('DELETE')
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                    </tbody>
                 
                @endforeach
              @endif
            </table>

            @if(count($user)>0)
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-2">
                  {{ $user->links() }}
                </ul>
              </nav>
            @else
              <h5 class="justify-content-center">No Data found</h5>
            @endif
          </div>

          {{-- Mobile cards --}}
          <div class="d-md-none">
            @if(count($user)>0)
              <div class="cards">
                @foreach($user as $users)
                  @if($users->role == 1)
                    <div class="card admin-card">
                      <div class="card-body">
                        <div class="card-head">
                          <img
                            src="{{ $users->profile_image ? asset('backend/uploads/admin/'.$users->profile_image) : asset('backend/uploads/user.jpg') }}"
                            class="avatar" alt="{{ $users->name }}">
                          <div class="flex-grow-1">
                            <h5>{{ $users->name }}</h5>
                            <div class="sub">{{ $users->email }}</div>
                          </div>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="{{ url('/profile/'.$users->id) }}">Edit</a>
                              <a class="dropdown-item" href="{{ url('/user-delete/'.$users->id) }}"
                                 onclick="event.preventDefault(); document.getElementById('delete-media-post-m-{{ $users->id }}').submit();">
                                Delete
                              </a>
                              <form id="delete-media-post-m-{{ $users->id }}" action="{{ url('/user-delete/'.$users->id) }}" method="post">
                                @csrf @method('DELETE')
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="kv">
                          <div class="k">User ID</div>
                          <div class="v">{{ $users->id }}</div>

                          <div class="k">Created</div>
                          <div class="v">{{ $users->created_at }}</div>

                          <div class="k">Status</div>
                          <div class="v">
                            @if ($users->useractive)
                              <span class="badge rounded-pill badge-light-primary">Active</span>
                            @else
                              <span class="badge rounded-pill badge-light-danger">Deactive</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>

              <nav aria-label="Page navigation example" class="mt-2">
                <ul class="pagination justify-content-center">
                  {{ $user->links() }}
                </ul>
              </nav>
            @else
              <div class="card"><div class="card-body text-center text-muted">No Data found</div></div>
            @endif
          </div>
          {{-- /Mobile cards --}}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    if (window.feather) feather.replace();
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
