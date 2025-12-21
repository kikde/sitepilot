{{-- resources/views/testimonials/index.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
  /* ===== Header actions (Back + Add) ===== */
  .header-actions{display:flex;gap:.5rem;justify-content:flex-end;flex-wrap:wrap}
  @supports not (gap:.5rem){.header-actions .btn+.btn{margin-left:.5rem}}

  /* ===== Desktop table polish ===== */
  .table thead th{white-space:nowrap;font-weight:700;color:#6b7280;letter-spacing:.02em}
  .table tbody td{vertical-align:middle}
  .avatar{width:56px;height:56px;border-radius:50%;object-fit:cover;box-shadow:0 6px 16px rgba(16,24,40,.08);border:3px solid #fff}

  /* Compact, consistent action buttons */
  .action-buttons{display:inline-flex;gap:.5rem}
  .action-buttons .btn{padding:.35rem .6rem;border-radius:10px}
  .action-buttons i[data-feather]{width:16px;height:16px}

  /* ===== Mobile cards (≤ md) ===== */
  @media (max-width: 767.98px){
    /* hide table on phones */
    #tlist .table-wrap{display:none!important}

    .t-cards{display:grid;gap:.9rem}
    .t-card{
      border:1px solid #eef2f7;border-radius:16px;background:#fff;
      box-shadow:0 10px 24px rgba(16,24,40,.06);overflow:hidden
    }
    .t-card .inner{padding:14px}
    .t-head{display:flex;gap:12px;align-items:center}
    .t-name{margin:0;font-weight:800;color:#111827;line-height:1.15}
    .t-sub{color:#6b7280;font-size:.86rem}
    .t-actions{display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.75rem}
    .t-actions .btn{width:100%;border-radius:12px;padding:.55rem .9rem}
    /* keep icons tidy */
    .t-actions i[data-feather]{width:16px;height:16px}
  }
</style>

<div class="content-wrapper">
  {{-- ===== Header ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">Testimonials</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Testimonial list</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + Add New --}}
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-fallback="{{ url('/testimonials') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>
          <a href="{{ url('/testimonials/create') }}"
             class="btn btn-primary btn-round btn-sm">
            <i data-feather="plus"></i><span class="ms-1">Add New</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Body ===== --}}
  <div class="content-body" id="tlist">
    @if(count($test) > 0)
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0"></h4></div>

        {{-- Desktop table --}}
        <div class="table-wrap">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th style="width:70px">ID</th>
                  <th style="width:90px">Image</th>
                  <th>Name</th>
                  <th style="width:160px">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($test as $t)
                <tr>
                  <td>{{ $t->id }}</td>
                  <td>
                    <img
                      src="{{ $t->images ? asset('backend/testimonial/'.$t->images) : asset('frontend/custom/user.png') }}"
                      alt="{{ $t->name }}" class="avatar">
                  </td>
                  <td><strong class="text-dark">{{ $t->name }}</strong></td>
                  <td>
                    <div class="action-buttons">
                      <a href="{{ url('/testimonials/'.$t->id.'/edit') }}" class="btn btn-info btn-sm" title="Edit">
                        <i data-feather="edit-2"></i><span class="d-none d-sm-inline"> Edit</span>
                      </a>
                      <a href="{{ url('/testimonials/'.$t->id) }}"
                         class="btn btn-danger btn-sm js-swal-delete"
                         data-id="{{ $t->id }}" data-name="{{ $t->name ?? 'this item' }}">
                        <i data-feather="trash-2"></i><span class="d-none d-sm-inline"> Delete</span>
                      </a>
                      <form id="delete-media-post-{{ $t->id }}"
                            action="{{ url('/testimonials/'.$t->id) }}"
                            method="post" class="d-none">
                        @csrf @method('DELETE')
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>

        {{-- Mobile cards --}}
        <div class="d-md-none p-1">
          <div class="t-cards">
            @foreach($test as $t)
              <div class="t-card">
                <div class="inner">
                  <div class="t-head">
                    <img
                      src="{{ $t->images ? asset('backend/testimonial/'.$t->images) : asset('frontend/custom/user.png') }}"
                      alt="{{ $t->name }}" class="avatar">
                    <div class="flex-grow-1">
                      <h5 class="t-name">{{ $t->name }}</h5>
                      <div class="t-sub">#{{ $t->id }}</div>
                    </div>
                  </div>

                  <div class="t-actions">
                    <a href="{{ url('/testimonials/'.$t->id.'/edit') }}" class="btn btn-outline-primary">
                      <i data-feather="edit-2"></i> <span>Edit</span>
                    </a>
                    <a href="{{ url('/testimonials/'.$t->id) }}"
                       class="btn btn-outline-danger js-swal-delete"
                       data-id="{{ $t->id }}" data-name="{{ $t->name ?? 'this item' }}">
                      <i data-feather="trash-2"></i> <span>Delete</span>
                    </a>
                  </div>

                  <form id="delete-media-post-{{ $t->id }}"
                        action="{{ url('/testimonials/'.$t->id) }}"
                        method="post" class="d-none">
                    @csrf @method('DELETE')
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>

      {{-- Pagination --}}
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-2">
          {{ $test->links() }}
        </ul>
      </nav>
    @else
      <div class="card"><div class="card-body text-center text-muted">No Data found</div></div>
    @endif
  </div>
</div>

{{-- Feather icons --}}
<script>
document.addEventListener('DOMContentLoaded', function(){ if (window.feather) feather.replace(); });
</script>

{{-- SweetAlert delete (with fallback) --}}
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
    customClass: { confirmButton: 'btn btn-primary', cancelButton: 'btn btn-outline-danger ml-1' }
  }).then(r => { if (r.isConfirmed) form.submit(); });
});
</script>

{{-- Smart Back (referrer or fallback) --}}
<script>
(function(){
  function hardCloseMenu(){
    document.body.classList.remove('menu-open','menu-expanded');
    document.querySelectorAll('.sidenav-overlay,.drag-target').forEach(n=>{ try{ n.remove(); }catch(e){} });
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
    const fallback = btn.dataset.backFallback || '{{ url('/testimonials') }}';
    const ref = document.referrer || '';
    const dest = ref.startsWith(location.origin) ? ref : fallback;
    setTimeout(()=>{ location.href = dest; }, 0);
  });
  document.addEventListener('DOMContentLoaded', hardCloseMenu);
  window.addEventListener('pageshow', ev => { if (ev.persisted) hardCloseMenu(); });
})();
</script>
@endsection
