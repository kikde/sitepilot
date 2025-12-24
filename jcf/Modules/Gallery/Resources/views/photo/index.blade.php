{{-- resources/views/photogallery/index.blade.php --}}
@extends('layouts.app')

@section('content')

@php
  $section      = request('share_site') ?? 'gallery';
  $sectionLabel = ucfirst($section);
  $listUrl      = url('/photogallery') . ($section ? '?share_site='.$section : '');
@endphp

<style>
  /* ===== Header actions (Back + Add) ===== */
  .header-actions{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;margin-left:auto}
  @supports not (gap:.5rem){.header-actions>*+*{margin-left:.5rem}}
  @media (max-width:575.98px){.header-actions{margin-left:0}}

  /* ===== Table polish (desktop) ===== */
  .table thead th{white-space:nowrap;font-weight:700;color:#6b7280;letter-spacing:.02em}
  .table tbody td{vertical-align:middle}
  .row-actions{display:inline-flex;gap:.5rem;align-items:center;white-space:nowrap}
  .row-actions .btn{padding:.34rem .6rem;border-radius:10px;font-size:.82rem;line-height:1.15}
  .row-actions i[data-feather]{width:16px;height:16px}
  @media (max-width:520px){.row-actions .btn span{display:none}}

  /* ===== Mobile cards (≤ md) ===== */
  @media (max-width:767.98px){
    /* hide desktop table on phones */
    .pg-table-wrap{display:none!important}

    .pg-cards{display:grid;gap:.9rem}
    .pg-card{
      border:1px solid #edf1f5;border-radius:16px;background:#fff;
      box-shadow:0 10px 24px rgba(16,24,40,.06);overflow:hidden
    }
    .pg-card .inner{padding:14px}
    .pg-top{display:flex;align-items:center;justify-content:space-between;gap:.75rem;margin-bottom:.5rem}
    .pg-top .badge{border-radius:999px;padding:.35rem .6rem;font-weight:600}

    .pg-media{
      width:100%;border-radius:12px;overflow:hidden;background:#f8fafc;
      display:block;max-height:220px
    }
    .pg-media img{width:100%;height:100%;object-fit:cover;display:block}

    .pg-actions{display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.75rem}
    .pg-actions .btn{width:100%;border-radius:12px;padding:.55rem .9rem}
    .pg-actions i[data-feather]{width:16px;height:16px}
  }
</style>

<div class="content-header row">
  <div class="col-12">
    <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
      {{-- Left: Title + breadcrumbs --}}
      <div class="mb-1 mb-md-0">
        <h2 class="content-header-title mb-0">{{ $sectionLabel }}</h2>
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $sectionLabel }} list</li>
          </ol>
        </div>
      </div>

      {{-- Right: Back + Add New --}}
      <div class="header-actions">
        <a href="{{ $listUrl }}" class="btn btn-outline-secondary btn-round btn-sm"
           data-smart-back data-back-href="{{ $listUrl }}">
          <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
        </a>
        <a href="{{ route('photogallery.create', ['share_site' => $section]) }}"
           class="btn btn-primary btn-round btn-sm">
          <i data-feather="plus"></i><span class="ms-1">Add {{ $sectionLabel }}</span>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="content-body">
  @if(count($gall) > 0)
    <div class="card">
      <div class="card-header"><h4 class="card-title mb-0">{{ $sectionLabel }} List</h4></div>

      {{-- Desktop table --}}
      <div class="pg-table-wrap">
        <div class="table-responsive">
          <table class="table table-hover-animation">
            <thead>
              <tr>
                <th style="width:70px">ID</th>
                <th style="width:140px">Image</th>
                <th>Status</th>
                <th style="width:120px">Actions</th>
              </tr>
            </thead>

            @foreach($gall as $gallery)
              <tbody>
                <tr>
                  <td>{{ $gallery->id }}</td>
                  <td>
                    @if ($gallery->images)
                      <img src="{{ asset('backend/gallery/photo/'.$gallery->images) }}" alt="Image"
                           style="width:100px;height:100px;object-fit:cover;border-radius:10px">
                    @else
                      <img src="{{ asset('frontend/custom/breadcrump.png') }}" alt="Default"
                           style="width:100px;height:100px;object-fit:cover;border-radius:10px">
                    @endif
                  </td>
                  <td>
                    @if($gallery->status === 'Published')
                      <span class="badge badge-pill badge-light-success">Published</span>
                    @elseif($gallery->status === 'Pending')
                      <span class="badge badge-pill badge-light-primary">Pending</span>
                    @else
                      <span class="badge badge-pill badge-light-info">Draft</span>
                    @endif
                  </td>
                  <td>
                    <div class="row-actions">
                      <a href="{{ url('/photogallery/'.$gallery->id.'/edit?share_site='.$section) }}"
                         class="btn btn-info btn-sm">
                        <i data-feather="edit-2"></i> <span>Edit</span>
                      </a>
                      <a href="{{ url('/photogallery/'.$gallery->id) }}"
                         class="btn btn-danger btn-sm"
                         onclick="event.preventDefault(); document.getElementById('delete-media-post-{{ $gallery->id }}').submit();">
                        <i data-feather="trash-2"></i> <span>Delete</span>
                      </a>
                    </div>
                    <form id="delete-media-post-{{ $gallery->id }}"
                          action="{{ url('/photogallery/'.$gallery->id.'?share_site='.$section) }}"
                          method="post" class="d-none">
                      @csrf @method('DELETE')
                    </form>
                  </td>
                </tr>
              </tbody>
            @endforeach
          </table>
        </div>
      </div>

      {{-- Mobile cards --}}
      <div class="d-md-none px-1 pb-1">
        <div class="pg-cards">
          @foreach($gall as $gallery)
            <div class="pg-card">
              <div class="inner">
                <div class="pg-top">
                  <strong>#{{ $gallery->id }}</strong>
                  @if($gallery->status === 'Published')
                    <span class="badge badge-light-success">Published</span>
                  @elseif($gallery->status === 'Pending')
                    <span class="badge badge-light-primary">Pending</span>
                  @else
                    <span class="badge badge-light-info">Draft</span>
                  @endif
                </div>

                <a class="pg-media" href="{{ url('/photogallery/'.$gallery->id.'/edit?share_site='.$section) }}">
                  @if ($gallery->images)
                    <img src="{{ asset('backend/gallery/photo/'.$gallery->images) }}" alt="Image">
                  @else
                    <img src="{{ asset('frontend/custom/breadcrump.png') }}" alt="Default">
                  @endif
                </a>

                <div class="pg-actions">
                  <a href="{{ url('/photogallery/'.$gallery->id.'/edit?share_site='.$section) }}"
                     class="btn btn-outline-primary">
                    <i data-feather="edit-2"></i> <span>Edit</span>
                  </a>
                  <a href="{{ url('/photogallery/'.$gallery->id) }}"
                     class="btn btn-outline-danger"
                     onclick="event.preventDefault(); document.getElementById('delete-media-post-{{ $gallery->id }}').submit();">
                    <i data-feather="trash-2"></i> <span>Delete</span>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>

    {{-- Pagination (keeps ?share_site=) --}}
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center mt-2">
        {{ $gall->appends(request()->query())->links() }}
      </ul>
    </nav>
  @else
    <div class="card"><div class="card-body text-center text-muted">No Data found</div></div>
  @endif
</div>

{{-- Smart Back (referrer or listUrl) --}}
<script>
function hardCloseMenu(){
  document.body.classList.remove('menu-open','menu-expanded');
  document.querySelectorAll('.sidenav-overlay, .drag-target').forEach(n=>{try{n.remove()}catch(e){}});
  if (window.bootstrap){
    document.querySelectorAll('.offcanvas.show').forEach(el=>{
      const inst = bootstrap.Offcanvas.getInstance(el);
      if (inst) inst.hide();
    });
  }
}
document.addEventListener('click', function (e) {
  const btn = e.target.closest('[data-smart-back]');
  if (!btn) return;
  e.preventDefault(); e.stopPropagation();
  hardCloseMenu();

  const ref = document.referrer || "";
  const hasRef = ref.startsWith(location.origin) && ref !== location.href;
  const fallback = btn.dataset.backHref || "{{ $listUrl }}";
  const dest = hasRef ? ref : fallback;
  setTimeout(()=>{ location.href = dest; }, 0);
});
document.addEventListener('DOMContentLoaded', function(){ if (window.feather) feather.replace(); });
</script>

@endsection
