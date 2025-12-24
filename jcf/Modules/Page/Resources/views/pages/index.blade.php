{{-- resources/views/page/index.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
  /* ---------- Header actions spacing ---------- */
  @media (min-width: 768px){ .gap-md-2{ gap:.5rem; } }

  /* ---------- Card list (mobile-first) ---------- */
  @media (max-width: 767.98px){
    /* hide desktop table on phones */
    #pages-list .table-responsive{ display:none !important; }

    .page-cards{
      display:grid;
      gap:.9rem;
      padding:0 .5rem .75rem;
    }
    .page-card{
      border:1px solid #edf1f5;
      border-radius:16px;
      box-shadow:0 10px 24px rgba(16,24,40,.06);
      overflow:hidden;
    }
    .page-card .card-body{ padding:14px; }

    .page-card .row-1{
      display:flex; align-items:center; justify-content:space-between; margin-bottom:.35rem;
    }
    .page-card .badge{
      border-radius:999px; padding:.35rem .6rem; font-weight:600;
    }

    /* id + title (clamp to 2 lines) */
    .page-card .title{
      font-weight:800; color:#111827; margin:0;
      display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;
      overflow:hidden;
    }
    .page-card .meta{
      color:#6b7280; font-size:.86rem; margin-top:.15rem;
    }

    /* action row -> two buttons with a gap */
    .page-card .actions{
      display:grid; grid-template-columns:1fr 1fr; gap:.5rem; margin-top:.65rem;
    }
    .page-card .actions .btn{
      width:100%; border-radius:12px; padding:.55rem .9rem;
    }
  }

  /* compact action buttons in table too */
  .action-buttons{ display:inline-flex; gap:.45rem; }
  .action-buttons .btn{
    width:auto !important; min-width:unset !important;
    padding:.32rem .55rem !important; font-size:.78rem !important; line-height:1.1 !important; border-radius:8px !important;
  }
  .action-buttons .btn i{ width:14px; height:14px; }

  /* tiny phones: icon-only in cards */
  @media (max-width:480px){
    .page-card .actions .btn span{ display:none; }
  }
</style>
{{-- put this near your other page-specific styles --}}
<style>
  /* Header actions: right-aligned with reliable spacing */
  .header-actions{
    display:flex;
    align-items:center;
    justify-content:flex-end;
    flex-wrap:wrap;
    gap:.5rem;                         /* modern browsers */
  }
  @supports not (gap:.5rem){
    .header-actions > * + *{ margin-left:.5rem; }  /* BS4 fallback */
  }

  /* On very small screens, stack neatly */
  @media (max-width:575.98px){
    .header-actions{
      justify-content:flex-start;      /* left on phones, avoids overflow */
    }
  }
</style>

{{-- ===== Header ===== --}}
<style>
  /* neat spacing + keep buttons on the right */
  .header-actions{
    display:flex; align-items:center; gap:.5rem;
    margin-left:auto;                 /* push to the right inside the row */
    flex-wrap:wrap;
  }
  @supports not (gap:.5rem){ .header-actions > * + *{ margin-left:.5rem; } }
</style>

<div class="content-header row">
  <div class="col-12">
    <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
      {{-- Left: Title + breadcrumbs --}}
      <div class="mb-1 mb-md-0">
        <h2 class="content-header-title mb-0">Pages</h2>
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Pages</li>
          </ol>
        </div>
      </div>

      {{-- Right: Back + Add New (inside the same row) --}}
      <div class="header-actions">
        <a href="{{ url('/pageList') }}"
           class="btn btn-outline-secondary btn-round btn-sm"
           data-smart-back
           data-back-href="{{ url('/pageList') }}">
          <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
        </a>

        <a href="{{ url('/page/create') }}" class="btn btn-primary btn-round btn-sm">
          <i data-feather="plus"></i><span class="ms-1">Add New</span>
        </a>
      </div>
    </div>  {{-- /flex row --}}
  </div>    {{-- /col-12 --}}
</div>       {{-- /content-header --}}

  {{-- ===== Body ===== --}}
  <div class="content-body" id="pages-list">
    <div class="row">
      <div class="col-12">
        <div class="card">

          {{-- Desktop table (md and up) --}}
          <div class="table-responsive d-none d-md-block">
            <table class="table">
              <thead>
              <tr>
                <th>ID</th>
                <th>Page Title</th>
                <th>Page Type</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </thead>

              @if(count($allsector) > 0)
                @foreach($allsector as $lists)
                  <tbody>
                    <tr>
                      <td>{{ $lists->id }}</td>
                      <td><b class="text-danger">{{ $lists->pagetitle }}</b></td>
                      <td>{{ $lists->types }}</td>
                      <td>
                        @if($lists->pagestatus == 'Published')
                          <span class="badge badge-pill badge-light-success">Published</span>
                        @elseif($lists->pagestatus == 'Pending')
                          <span class="badge badge-pill badge-light-primary">Pending</span>
                        @else
                          <span class="badge badge-pill badge-light-info">Draft</span>
                        @endif
                      </td>
                      <td>
                        <div class="action-buttons">
                          <a href="{{ url('/page-edit/'.$lists->id) }}"
                             class="btn btn-info btn-sm" title="Edit">
                            <i data-feather="edit-2"></i><span> Edit</span>
                          </a>

                          <a href="{{ url('/page-del/'.$lists->id) }}"
                             class="btn btn-danger btn-sm js-swal-delete"
                             data-id="{{ $lists->id }}"
                             data-name="{{ $lists->pagetitle ?? 'this item' }}">
                            <i data-feather="trash-2"></i><span> Delete</span>
                          </a>

                          <form id="delete-media-post-{{ $lists->id }}"
                                action="{{ url('/page-del/'.$lists->id) }}"
                                method="post" class="d-none">
                            @csrf @method('DELETE')
                          </form>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                @endforeach
              @endif
            </table>
          </div>

          {{-- Mobile cards (below md) --}}
          <div class="d-md-none">
            @if(count($allsector) > 0)
              <div class="page-cards">
                @foreach($allsector as $lists)
                  <div class="card page-card">
                    <div class="card-body">
                      <div class="row-1">
                        <small class="text-muted">#{{ $lists->id }}</small>
                        @if($lists->pagestatus == 'Published')
                          <span class="badge badge-light-success">Published</span>
                        @elseif($lists->pagestatus == 'Pending')
                          <span class="badge badge-light-primary">Pending</span>
                        @else
                          <span class="badge badge-light-info">Draft</span>
                        @endif
                      </div>

                      <h5 class="title">{{ $lists->pagetitle }}</h5>
                      <div class="meta">Type: {{ $lists->types }}</div>

                      <div class="actions">
                        <a href="{{ url('/page-edit/'.$lists->id) }}"
                           class="btn btn-outline-primary">
                          <i data-feather="edit"></i> <span>Edit</span>
                        </a>

                        <a href="{{ url('/page-del/'.$lists->id) }}"
                           class="btn btn-outline-danger js-swal-delete"
                           data-id="{{ $lists->id }}"
                           data-name="{{ $lists->pagetitle ?? 'this item' }}">
                          <i data-feather="trash-2"></i> <span>Delete</span>
                        </a>
                      </div>

                      <form id="delete-media-post-{{ $lists->id }}"
                            action="{{ url('/page-del/'.$lists->id) }}"
                            method="post" class="d-none">
                        @csrf @method('DELETE')
                      </form>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="card"><div class="card-body text-center text-muted">No Data found</div></div>
            @endif
          </div>

        </div>

        {{-- Pagination --}}
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center mt-2">
            {{ $allsector->links() }}
          </ul>
        </nav>

      </div>
    </div>
  </div>
</div>

{{-- Feather icons --}}
<script>
document.addEventListener('DOMContentLoaded', function(){
  if (window.feather) feather.replace();
});
</script>

{{-- SweetAlert delete (fallback to confirm) --}}
<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.js-swal-delete');
  if (!btn) return;
  e.preventDefault();

  const id   = btn.getAttribute('data-id');
  const name = btn.getAttribute('data-name') || 'this item';
  const form = document.getElementById('delete-media-post-' + id);
  if (!form) return;

  if (typeof Swal === 'undefined') {
    if (confirm('Delete "' + name + '"? This cannot be undone.')) form.submit();
    return;
  }

  Swal.fire({
    title: 'Delete "' + name + '"?',
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

{{-- Smart Back (closes overlay/offcanvas first) --}}
<script>
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
const BACK_FALLBACK = "{{ url('/page') }}";

document.addEventListener('click', function (e) {
  const btn = e.target.closest('[data-smart-back]');
  if (!btn) return;
  e.preventDefault();
  e.stopPropagation();
  hardCloseMenu();
  const ref = document.referrer || "";
  const dest = btn.dataset.backFallback || (ref.startsWith(location.origin) ? ref : BACK_FALLBACK);
  setTimeout(()=>{ location.href = dest; }, 0);
});
document.addEventListener('DOMContentLoaded', hardCloseMenu);
window.addEventListener('pageshow', ev => { if (ev.persisted) hardCloseMenu(); });
</script>

@endsection
