{{-- resources/views/news/index.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
  /* Desktop header spacing utility */
  @media (min-width: 768px){
    .header-actions{ gap:.5rem; }
  }

  /* ===== Mobile cards (≤ md) while keeping desktop table intact ===== */
  @media (max-width: 767.98px){
    /* hide desktop table, show cards */
    #news-list .table-responsive{ display:none !important; }
    .news-cards{ display:grid; gap:.9rem; padding:0 .5rem .75rem; }

    .news-card{
      border:1px solid #edf1f5; border-radius:16px;
      box-shadow:0 10px 24px rgba(16,24,40,.06); overflow:hidden;
    }
    .news-card .card-body{ padding:14px; }

    /* title clamp (1–2 lines) */
    .news-card .title{
      font-weight:800; color:#111827; margin:0 0 .25rem 0;
      display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;
      overflow:hidden;
    }

    .news-card .meta{
      display:flex; align-items:center; gap:.5rem; margin-bottom:.5rem;
    }
    .news-card .badge{ border-radius:999px; padding:.35rem .6rem; font-weight:600; }

    /* action row = two buttons with gap (no sticking) */
    .news-card .actions.action-row{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:.6rem;                      /* <-- ensures spacing */
      margin-top:.25rem;
    }
    .news-card .actions.action-row .btn{
      width:100%;
      border-radius:12px;
      padding:.55rem .9rem;
    }

    .news-card .dropdown-menu{
      border-radius:12px; overflow:hidden; border-color:#e5e7eb;
    }
  }

  /* Small, crisp icons */
  i[data-feather]{ width:16px; height:16px; }
</style>
<style>
  /* give breathing room between Back and Add New */
  .header-actions{ display:flex; gap:.5rem; }
  /* if your project is Bootstrap 4 (no native gap), keep a fallback: */
  @supports not (gap: .5rem){
    .header-actions .btn + .btn{ margin-left:.5rem; }
  }
</style>

<div class="content-header row">
  <div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
      <div class="col-12 d-flex align-items-center justify-content-between">
        <div>
          <h2 class="content-header-title float-left mb-0">Latest News</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">News Post</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + Add New --}}
        <div class="header-actions">
          <a href="{{ url('/newsList') }}"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-fallback="{{ url('/newsList') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>
          <a href="{{ url('/news/create') }}"
             class="btn btn-primary btn-round btn-sm">
            <i data-feather="plus"></i><span class="ms-1">Add New</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>


  {{-- ===== Body ===== --}}
  <div class="content-body">
    <div class="row" id="news-list">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Latest News</h4>
          </div>

          {{-- ==================== DESKTOP TABLE (md and up) ==================== --}}
          <div class="table-responsive d-none d-md-block">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Page Title</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              @if(count($newspost)>0)
                @foreach($newspost as $lists)
                  <tbody>
                    <tr>
                      <td>{{ $lists->id }}</td>
                      <td><b class="text-danger">{{ $lists->pagetitle }}</b></td>
                      <td><b class="text-secondary">{{ $lists->created_at }}</b></td>
                      <td>
                        @if($lists->pagestatus == 'Published')
                          <span class="badge badge-pill badge-light-success mr-1">Published</span>
                        @elseif($lists->pagestatus == 'Pending')
                          <span class="badge badge-pill badge-light-primary mr-1">Pending</span>
                        @else
                          <span class="badge badge-pill badge-light-info mr-1">Draft</span>
                        @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/news-edit/'.$lists->id) }}">
                              <i data-feather="edit-2" class="mr-50"></i> <span>Edit</span>
                            </a>
                            <a href="{{ url('/news-del/'.$lists->id) }}"
                               class="dropdown-item js-swal-delete"
                               data-id="{{ $lists->id }}"
                               data-name="{{ $lists->pagetitle ?? ('#'.$lists->id) }}">
                              <i data-feather="trash" class="mr-50"></i> <span>Delete</span>
                            </a>
                            <form id="delete-media-post-m-{{ $lists->id }}"
                                  action="{{ url('/news-del/'.$lists->id) }}"
                                  method="post" class="d-none">
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
          </div>

          {{-- ==================== MOBILE CARDS (below md) ==================== --}}
          <div class="d-md-none">
            <div class="news-cards">
              @foreach($newspost as $lists)
                <div class="card news-card">
                  <div class="card-body">
                    <h5 class="title">{{ $lists->id }}. {{ $lists->pagetitle }}</h5>

                    <div class="meta">
                      @if($lists->pagestatus == 'Published')
                        <span class="badge badge-light-success">Published</span>
                      @elseif($lists->pagestatus == 'Pending')
                        <span class="badge badge-light-primary">Pending</span>
                      @else
                        <span class="badge badge-light-info">Draft</span>
                      @endif
                      <span class="badge badge-light-info">{{ $lists->created_at }}</span>
                    </div>

                    {{-- two buttons with space --}}
                    <div class="actions action-row">
                      <a class="btn btn-outline-primary" href="{{ url('/news-edit/'.$lists->id) }}">
                        <i data-feather="edit"></i> Edit
                      </a>
                      <a href="{{ url('/news-del/'.$lists->id) }}"
                         class="btn btn-outline-danger js-swal-delete"
                         data-id="{{ $lists->id }}"
                         data-name="{{ $lists->pagetitle ?? ('#'.$lists->id) }}">
                        <i data-feather="trash-2"></i> Delete
                      </a>
                    </div>

                    <form id="delete-media-post-m-{{ $lists->id }}"
                          action="{{ url('/news-del/'.$lists->id) }}"
                          method="post" class="d-none">
                      @csrf @method('DELETE')
                    </form>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          {{-- /MOBILE --}}
        </div>
      </div>
    </div>

    {{-- Pagination --}}
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center mt-2">
        {{ $newspost->links() }}
      </ul>
    </nav>

    @if(count($newspost)==0)
      <h5 class="justify-content-center">No Data found</h5>
    @endif
  </div>
</div>

{{-- Feather icons --}}
<script>
document.addEventListener('DOMContentLoaded', function(){
  if (window.feather) feather.replace();
});
</script>

{{-- SweetAlert delete (with fallback) --}}
<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.js-swal-delete');
  if (!btn) return;

  e.preventDefault();

  const id   = btn.getAttribute('data-id');
  const name = btn.getAttribute('data-name') || 'this item';
  const form = document.getElementById('delete-media-post-m-' + id);
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

{{-- Smart Back (closes Vuexy sidebar/offcanvas before navigating) --}}
<script>
/* ---- Close any Vuexy/Bootstrap offcanvas/overlay before navigating ---- */
function hardCloseMenu() {
  document.body.classList.remove('menu-open','menu-expanded');
  document.querySelectorAll('.sidenav-overlay, .drag-target').forEach(n => { try { n.remove(); } catch(_){} });
  if (window.bootstrap) {
    document.querySelectorAll('.offcanvas.show').forEach(el => {
      const inst = bootstrap.Offcanvas.getInstance(el);
      if (inst) inst.hide();
    });
  }
}

/* ---- Smart back: prefer real referrer, then history.back, then fallback ---- */
function smartBack(fallbackHref) {
  hardCloseMenu();

  const here = location.href;
  const ref  = document.referrer || "";
  const sameOrigin = ref.startsWith(location.origin);

  // If we have a same-origin referrer and it's not this exact URL, go there.
  if (sameOrigin) {
    const refUrl  = new URL(ref);
    const hereUrl = new URL(here);
    if (refUrl.pathname + refUrl.search !== hereUrl.pathname + hereUrl.search) {
      // Use replace so we don't keep the current page in the stack.
      return location.replace(ref);
    }
  }

  // Otherwise try history.back(), and fall back if it doesn't move.
  const before = location.href;
  history.back();

  // If nothing changed, go to fallback.
  setTimeout(() => {
    if (location.href === before) {
      location.assign(fallbackHref);
    }
  }, 500);
}

/* ---- Wire up buttons ---- */
document.addEventListener('click', function (e) {
  const btn = e.target.closest('[data-smart-back]');
  if (!btn) return;

  e.preventDefault();
  e.stopPropagation();

  const fallback = btn.getAttribute('data-back-fallback')
                 || btn.getAttribute('href')
                 || "{{ url('/newsList') }}";

  smartBack(fallback);
});

/* Safety: if page restored from bfcache with menu open, close it */
document.addEventListener('DOMContentLoaded', hardCloseMenu);
window.addEventListener('pageshow', ev => { if (ev.persisted) hardCloseMenu(); });
</script>


@endsection
