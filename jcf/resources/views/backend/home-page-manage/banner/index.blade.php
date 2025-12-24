@extends('layouts.app')

@section('content')
<style>
  :root{
    --surface:#ffffff;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#6b7280;
    --line:#e5e7eb;
    --primary:#6c5ce7;
    --primary-2:#8b5cf6;
    --success:#22c55e;
    --warning:#f59e0b;
    --danger:#ef4444;
  }

  /* ===== Page header ===== */
  .page-head{
    border:1px solid var(--line);
    border-radius:16px;
    background:
      radial-gradient(1200px 1200px at 100% -10%, rgba(108,92,231,.10), transparent 40%),
      radial-gradient(1200px 1200px at -10% 110%, rgba(139,92,246,.10), transparent 40%),
      var(--surface);
    padding:14px 16px;
    box-shadow:0 10px 24px rgba(16,24,40,.06);
  }
  .page-head h2{
    font-weight:800; letter-spacing:.2px; margin:0;
  }
  .breadcrumb-wrapper .breadcrumb{
    margin:6px 0 0;
  }

  .page-actions{ display:flex; align-items:center; gap:.5rem; flex-wrap:wrap; }
  .btn-round{ border-radius:999px; }
  .btn-chip{
    display:inline-flex; align-items:center; gap:.45rem;
    border:1px solid var(--line); background:#fff; color:var(--text);
    padding:.5rem .8rem; font-weight:600; transition:all .15s ease;
  }
  .btn-chip:hover{ transform:translateY(-1px); box-shadow:0 6px 16px rgba(16,24,40,.08); }
  .btn-primary{
    background: linear-gradient(90deg, var(--primary), var(--primary-2));
    color:#fff; border:none;
  }
  .btn-primary:hover{ filter:saturate(1.1) brightness(1.03); }

  /* ===== Card ===== */
  .card-elev{
    border:1px solid var(--line);
    border-radius:16px;
    box-shadow:0 10px 24px rgba(16,24,40,.06);
    overflow:hidden;
  }
  .card-elev .card-header{
    padding:14px 16px; background:linear-gradient(180deg,#fafafa,#fff);
    border-bottom:1px dashed var(--line);
  }

  /* ===== Table ===== */
  .table thead th{
    font-size:.85rem; text-transform:uppercase; letter-spacing:.06em;
    color:var(--muted); border-bottom:1px solid var(--line);
  }
  .table td{ vertical-align:middle; }

  /* Images */
  .thumb{
    width:96px; height:64px; object-fit:cover;
    border-radius:12px; box-shadow:0 6px 16px rgba(2,6,23,.08);
  }

  /* Status pills */
  .badge-soft{
    display:inline-flex; align-items:center; gap:.35rem; font-weight:700;
    border-radius:999px; padding:.35rem .6rem; font-size:.75rem;
  }
  .badge-published{ background:rgba(34,197,94,.12); color:#047857; border:1px solid rgba(34,197,94,.25); }
  .badge-pending{ background:rgba(59,130,246,.12); color:#1d4ed8; border:1px solid rgba(59,130,246,.25); }
  .badge-draft{ background:rgba(100,116,139,.12); color:#334155; border:1px solid rgba(100,116,139,.25); }

  /* Row actions */
  .row-actions{ display:flex; justify-content:flex-end; gap:.4rem; }
  .btn-icon{
    width:40px; height:40px; display:inline-flex; align-items:center; justify-content:center;
    border-radius:12px; border:1px solid var(--line); background:#fff; transition:.15s;
  }
  .btn-icon:hover{ transform:translateY(-1px); box-shadow:0 6px 16px rgba(16,24,40,.08); }
  .btn-icon.warn{ border-color:#fde68a; background:#fffbeb; }
  .btn-icon.danger{ border-color:#fecaca; background:#fef2f2; }

  /* ===== Mobile: table -> cards ===== */
  @media (max-width: 768px){
    .table-responsive{ border:none; }
    table.table{ display:block; }
    thead{ display:none; }
    tbody{ display:grid; gap:12px; }
    tr{
      display:grid; gap:8px;
      border:1px solid var(--line); border-radius:14px; padding:12px;
      box-shadow:0 8px 18px rgba(16,24,40,.06);
      background:#fff;
    }
    td{ display:flex; align-items:center; justify-content:space-between; gap:12px; border:none !important; padding:6px 0 !important; }
    td::before{
      content:attr(data-label);
      font-size:.8rem; color:var(--muted); text-transform:uppercase; letter-spacing:.05em;
    }
    .row-actions{ justify-content:flex-start; }
  }

  /* XS buttons – icons only */
  @media (max-width: 420px){
    .btn-chip span{ display:none; }
    .btn-icon{ width:38px; height:38px; }
  }

  /* ===== Empty state ===== */
  .empty-state{
    border:1px dashed var(--line); border-radius:16px; padding:24px;
    text-align:center; color:var(--muted); background:#fff;
  }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12 d-flex align-items-center justify-content-between">
          <div class="page-head w-100 d-flex align-items-center justify-content-between">
            <div>
              <h2 class="content-header-title mb-0">Banner</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                  <li class="breadcrumb-item active">Banner list</li>
                </ol>
              </div>
            </div>

            <div class="page-actions">
              <a href="javascript:void(0)" class="btn btn-chip btn-round" data-smart-back data-back-fallback="{{ url('/home') }}">
                <i data-feather="arrow-left"></i><span>Back</span>
              </a>
              <a href="{{ url('/home/add-new') }}" class="btn btn-primary btn-round">
                <i data-feather="plus"></i><span class="ms-1">Add New</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    @if(count($banner) > 0)
      <div class="row" id="table-hover-animation">
        <div class="col-12">
          <div class="card card-elev">
            <div class="card-header"><h4 class="card-title mb-0">Banner List</h4></div>

            <div class="table-responsive">
              <table class="table align-middle">
                <thead>
                  <tr>
                    <th style="width:80px;">ID</th>
                    <th>Images</th>
                    <th>Status</th>
                    <th class="text-end" style="width:140px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($banner as $gallery)
                    <tr>
                      <td data-label="ID">{{ $gallery->id }}</td>

                      <td data-label="Images">
                        @if ($gallery->images)
                          <img src="{{ asset('backend/home/banner/'.$gallery->images) }}" class="thumb" alt="Banner">
                        @else
                          <img src="{{ asset('frontend/custom/breadcrump.png') }}" class="thumb" alt="Banner">
                        @endif
                      </td>

                      <td data-label="Status">
                        @if($gallery->status == "Published")
                          <span class="badge-soft badge-published">Published</span>
                        @elseif($gallery->status == "Pending")
                          <span class="badge-soft badge-pending">Pending</span>
                        @else
                          <span class="badge-soft badge-draft">Draft</span>
                        @endif
                      </td>

                      <td data-label="Actions">
                        <div class="row-actions">
                          <a href="{{ url('/home/edit/'.$gallery->id) }}"
                             class="btn-icon warn" title="Edit">
                            <i data-feather="edit-2"></i>
                          </a>

                          <a href="{{ url('/home/delete/'.$gallery->id) }}"
                             class="btn-icon danger"
                             title="Delete"
                             onclick="event.preventDefault(); if(confirm('Delete this banner?')) document.getElementById('delete-media-post-{{ $gallery->id }}').submit();">
                            <i data-feather="trash-2"></i>
                          </a>

                          <form id="delete-media-post-{{ $gallery->id }}"
                                action="{{ url('/home/delete/'.$gallery->id) }}"
                                method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-2">
          {{ $banner->links() }}
        </ul>
      </nav>
    @else
      <div class="empty-state">
        <svg width="46" height="46" viewBox="0 0 24 24" fill="none" style="margin-bottom:8px;">
          <path d="M3 7h18M3 12h18M3 17h18" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <h5 class="mb-1">No Banners yet</h5>
        <p class="mb-2">Add your first banner to get started.</p>
        <a href="{{ url('/home/add-new') }}" class="btn btn-primary btn-round">
          <i data-feather="plus"></i><span class="ms-1">Add New</span>
        </a>
      </div>
    @endif
  </div>
</div>

<script>
  // Icons
  document.addEventListener('DOMContentLoaded', function(){
    if (window.feather) feather.replace();
  });

  // Smart Back (close any sidebars/offcanvas then go referrer or fallback)
  (function(){
    function hardCloseMenu(){
      document.body.classList.remove('menu-open','menu-expanded');
      document.querySelectorAll('.sidenav-overlay, .drag-target').forEach(n=>{ try{ n.remove(); }catch(e){} });
      if (window.bootstrap){
        document.querySelectorAll('.offcanvas.show').forEach(el=>{
          const inst = bootstrap.Offcanvas.getInstance(el);
          if (inst) inst.hide();
        });
      }
    }
    document.addEventListener('click', function (e) {
      const btn = e.target.closest('[data-smart-back]'); if (!btn) return;
      e.preventDefault(); e.stopPropagation(); hardCloseMenu();
      const ref = document.referrer || '';
      const dest = ref.startsWith(location.origin) ? ref : (btn.dataset.backFallback || '{{ url('/home') }}');
      setTimeout(()=>{ location.href = dest; }, 0);
    });
    // ensure overlays aren’t stuck after history bfcache restores
    window.addEventListener('pageshow', (ev)=>{ if (ev.persisted) hardCloseMenu(); });
  })();
</script>
@endsection
