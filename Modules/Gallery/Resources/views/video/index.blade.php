{{-- resources/views/videogallery/index.blade.php --}}
@extends('layouts.app')

@section('content')

<style>
  /* Right-side actions with reliable spacing */
  .header-actions{
    display:flex; align-items:center; gap:.5rem; flex-wrap:wrap;
    margin-left:auto;                 /* push to right inside the row */
  }
  @supports not (gap:.5rem){ .header-actions > * + *{ margin-left:.5rem; } } /* BS4 fallback */
  @media (max-width:575.98px){ .header-actions{ margin-left:0; } }            /* tidy on phones */
</style>

<div class="content-wrapper">
  {{-- ===== Header ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
        {{-- Left: Title + breadcrumbs --}}
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">Video Gallery</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Gallery list</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + Add New --}}
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-fallback="{{ url('/videogallery') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>

          <a href="{{ url('videogallery/create') }}"
             class="btn btn-primary btn-round btn-sm">
            <i data-feather="plus"></i><span class="ms-1">Add New</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Body ===== --}}
  <div class="content-body">
    @if(count($gall) > 0)
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header"><h4 class="card-title">List</h4></div>

          <div class="table-responsive">
            <table class="table table-hover-animation">
              <thead>
                <tr>
                  <th>Video</th>
                  <th>Title</th>
          
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              @foreach($gall as $gallery)
              <tbody>
                <tr>
                  <td>
                    @if ($gallery->video)
                      <video width="320" height="180" controls preload="metadata">
                        <source src="{{ asset('backend/gallery/video/'.$gallery->video) }}" type="video/mp4">
                      </video>
                    @else
                      <img src="{{ asset('frontend/custom/breadcrump.png') }}" class="mr-75" height="100" width="100" alt="Placeholder" />
                    @endif
                  </td>

                  <td>{{ $gallery->title }}</td>
               

                  <td>
                    @if($gallery->status == "Published")
                      <span class="badge badge-pill badge-light-success">Published</span>
                    @elseif($gallery->status == "Pending")
                      <span class="badge badge-pill badge-light-primary">Pending</span>
                    @else
                      <span class="badge badge-pill badge-light-info">Draft</span>
                    @endif
                  </td>

                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                        <i data-feather="more-vertical"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('/videogallery/'.$gallery->id.'/video') }}">
                          <i data-feather="edit-2" class="mr-50"></i><span>Edit</span>
                        </a>
                        <a class="dropdown-item" href="{{ url('/photogallery/'.$gallery->id) }}"
                           onclick="event.preventDefault(); document.getElementById('delete-media-post-{{ $gallery->id }}').submit();">
                          <i data-feather="trash" class="mr-50"></i><span>Delete</span>
                        </a>
                        <form id="delete-media-post-{{ $gallery->id }}"
                              action="{{ url('/photogallery/'.$gallery->id) }}"
                              method="post" class="d-none">
                          @csrf @method('DELETE')
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>

    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center mt-2">
        {{ $gall->links() }}
      </ul>
    </nav>
    @else
      <h5 class="justify-content-center">No Data found</h5>
    @endif
  </div>
</div>

{{-- Feather icons --}}
<script>
document.addEventListener('DOMContentLoaded', function(){ if (window.feather) feather.replace(); });
</script>

{{-- Smart Back: prefer referrer, otherwise fallback; also closes any overlay/sidebar --}}
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
document.addEventListener('click', function (e) {
  const btn = e.target.closest('[data-smart-back]');
  if (!btn) return;

  e.preventDefault(); e.stopPropagation();
  hardCloseMenu();

  const ref = document.referrer || "";
  const hasRef = ref.startsWith(location.origin) && ref !== location.href;
  const fallback = btn.dataset.backFallback || "{{ url('/videogallery') }}";
  const dest = hasRef ? ref : fallback;

  setTimeout(()=>{ location.href = dest; }, 0);
});
</script>

@endsection
