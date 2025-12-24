{{-- resources/views/pages/index_cards.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
  /* ---------- Page header actions ---------- */
  @media (min-width: 768px){ .gap-2{ gap:.5rem; } }

  /* ---------- Cards Grid ---------- */
  .page-grid{
    display:grid;
    grid-template-columns: repeat(1, minmax(0,1fr));
    gap: 14px;
  }
  @media (min-width: 576px){ .page-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); } }
  @media (min-width: 992px){ .page-grid{ grid-template-columns: repeat(3, minmax(0,1fr)); } }

  .page-card{
    border:1px solid #edf1f5;
    border-radius:16px;
    box-shadow:0 10px 24px rgba(16,24,40,.06);
    background:#fff;
    transition: transform .12s ease, box-shadow .12s ease;
  }
  .page-card:hover{
    transform: translateY(-2px);
    box-shadow:0 12px 28px rgba(16,24,40,.10);
  }
  .page-card .card-body{ padding:14px 14px 12px; }

  /* two-line clamp for titles */
  .title{
    font-weight:800; color:#111827; margin:0 0 6px;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;
    overflow:hidden;
  }

  .meta-row{
    display:flex; align-items:center; justify-content:space-between;
    gap:.5rem; margin-bottom:.6rem;
  }
  .badge-pill{ border-radius:999px; padding:.35rem .6rem; font-weight:600; }

  /* action row: 2 buttons with space */
  .action-row{
    display:grid; grid-template-columns: 1fr 1fr; gap:.5rem;
  }
  .action-row .btn{
    width:100%; border-radius:12px; padding:.55rem .9rem;
  }

  /* small icon size for neatness */
  i[data-feather]{ width:16px; height:16px; }
</style>

{{-- ===== Header (title left, actions right in same row) ===== --}}
<style>
  /* gap utility for Bootstrap 4 projects */
  .gap-2 { gap: .5rem; }
</style>

<div class="content-header row">
  <div class="col-12">
    <div class="d-flex flex-wrap align-items-center justify-content-between">
      {{-- Left: Title + breadcrumbs --}}
      <div class="mb-1 mb-md-0">
        <h2 class="content-header-title mb-0">Projects</h2>
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Objective</li>
          </ol>
        </div>
      </div>

      {{-- Right: Back + Add New --}}
      <div class="d-flex align-items-center gap-2">
        <a href="javascript:void(0)"
           class="btn btn-outline-secondary btn-round btn-sm"
           data-smart-back
           data-back-fallback="{{ url('/pages') }}">
          <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
        </a>

        <a href="{{ url('/pages/create') }}"
           class="btn btn-primary btn-round btn-sm">
          <i data-feather="plus"></i><span class="ms-1">Add New</span>
        </a>
      </div>
    </div>
  </div>
</div>

  {{-- ===== Body (Cards) ===== --}}
  <div class="content-body">
    @if(count($allsector) > 0)
      <div class="page-grid">
        @foreach($allsector as $lists)
          <div class="page-card">
            <div class="card-body">
              <div class="meta-row">
                <small class="text-muted">#{{ $lists->id }}</small>

                @if($lists->pagestatus == 'Published')
                  <span class="badge badge-pill badge-light-success">Published</span>
                @elseif($lists->pagestatus == 'Pending')
                  <span class="badge badge-pill badge-light-primary">Pending</span>
                @else
                  <span class="badge badge-pill badge-light-info">Draft</span>
                @endif
              </div>

              <h5 class="title" title="{{ $lists->pagetitle }}">
                {{ $lists->pagetitle }}
              </h5>

              <!-- <div class="text-muted mb-2" style="font-size:.88rem">
                <span class="mr-1">Slug:</span>{{ $lists->slug }}
              </div> -->

              <div class="action-row">
                <a class="btn btn-outline-primary" href="{{ url('/pages/'.$lists->id) }}">
                  <i data-feather="edit"></i> Edit
                </a>

                <a href="{{ url('/pages/'.$lists->id) }}"
                   class="btn btn-outline-danger js-swal-delete"
                   data-id="{{ $lists->id }}"
                   data-name="{{ $lists->sector_name ?? ('#'.$lists->id) }}">
                  <i data-feather="trash-2"></i> Delete
                </a>
              </div>

              <form id="delete-media-post-{{ $lists->id }}"
                    action="{{ url('/pages/'.$lists->id) }}"
                    method="post" class="d-none">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
          {{ $allsector->links() }}
        </ul>
      </nav>
    @else
      <h5 class="text-center text-muted">No Data found</h5>
    @endif
  </div>
</div>

{{-- Icons --}}
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

{{-- Smart Back: close sticky menu, then referrer; else fallback --}}
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
function smartBack(fallbackHref){
  hardCloseMenu();
  const here = location.href;
  const ref  = document.referrer || "";
  const sameOrigin = ref.startsWith(location.origin);

  if (sameOrigin){
    const r = new URL(ref), h = new URL(here);
    if (r.pathname + r.search !== h.pathname + h.search){
      return location.replace(ref);
    }
  }
  const before = location.href;
  history.back();
  setTimeout(()=>{ if (location.href === before) location.assign(fallbackHref); }, 500);
}

document.addEventListener('click', function (e) {
  const btn = e.target.closest('[data-smart-back]');
  if (!btn) return;
  e.preventDefault();
  e.stopPropagation();
  smartBack(btn.getAttribute('data-back-fallback') || "{{ url('/pages') }}");
});

document.addEventListener('DOMContentLoaded', hardCloseMenu);
window.addEventListener('pageshow', ev => { if (ev.persisted) hardCloseMenu(); });
</script>
@endsection
