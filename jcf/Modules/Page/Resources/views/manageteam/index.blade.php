{{-- resources/views/management_team/index.blade.php --}}
@extends('layouts.app')

@section('content')

<style>
  /* ===== Header actions (Back + New) ===== */
  .header-actions{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap}
  @supports not (gap:.5rem){.header-actions>*+*{margin-left:.5rem}}

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
    .team-table-wrap{display:none!important}

    .team-cards{display:grid;gap:.9rem}
    .team-card{
      border:1px solid #edf1f5;border-radius:16px;background:#fff;
      box-shadow:0 10px 24px rgba(16,24,40,.06);overflow:hidden
    }
    .team-card .inner{padding:14px}
    .member-head{display:flex;gap:12px;align-items:center}
    .member-avatar{
      width:72px;height:72px;border-radius:50%;object-fit:cover;flex:0 0 72px;
      background:#f3f4f6;border:3px solid #fff;box-shadow:0 10px 24px rgba(16,24,40,.08)
    }
    .member-title{
      margin:0;font-weight:800;color:#111827;line-height:1.15;
      display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden
    }
    .member-meta{color:#6b7280;font-size:.86rem;margin-top:.1rem}

    /* actions row: two buttons side-by-side */
    .card-actions{display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.7rem}
    .card-actions .btn{width:100%;border-radius:12px;padding:.55rem .9rem}
    .card-actions i[data-feather]{width:16px;height:16px}
  }
</style>

<div class="content-wrapper">
  {{-- ===== Header ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
        {{-- Left: title + breadcrumbs --}}
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">M Team</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Team</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + New --}}
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-href="{{ url('/management-team') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>
          <a href="{{ url('/management-team/create') }}"
             class="btn btn-primary btn-round btn-sm">
            <i data-feather="plus"></i><span class="ms-1">New</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Body ===== --}}
  <div class="content-body">
    @if(count($test) > 0)
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">List</h4></div>

        {{-- Desktop table --}}
        <div class="team-table-wrap">
          <div class="table-responsive">
            <table class="table table-hover-animation">
              <thead>
              <tr>
                <th style="width:70px">ID</th>
                <th style="width:100px">Image</th>
                <th>Name</th>
                <th style="width:140px">Actions</th>
              </tr>
              </thead>

              @foreach($test as $t)
                <tbody>
                <tr>
                  <td>{{ $t->id }}</td>
                  <td>
                    @if($t->images)
                      <img src="{{ asset('backend/teams/'.$t->images) }}" alt="{{ $t->name }}"
                           style="width:64px;height:64px;border-radius:50%;object-fit:cover">
                    @else
                      <img src="{{ asset('frontend/custom/user.png') }}" alt="{{ $t->name }}"
                           style="width:64px;height:64px;border-radius:50%;object-fit:cover">
                    @endif
                  </td>
                  <td>{{ $t->name }}</td>
                  <td>
                    <div class="row-actions">
                      <a href="{{ url('/management-team/'.$t->id.'/edit') }}"
                         class="btn btn-info btn-sm">
                        <i data-feather="edit-2"></i> <span>Edit</span>
                      </a>
                      <a href="{{ url('/management-team/'.$t->id) }}"
                         class="btn btn-danger btn-sm js-swal-delete"
                         data-id="{{ $t->id }}" data-name="{{ $t->name ?? 'this item' }}">
                        <i data-feather="trash-2"></i> <span>Delete</span>
                      </a>
                    </div>
                    <form id="delete-media-post-{{ $t->id }}"
                          action="{{ url('/management-team/'.$t->id) }}"
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
          <div class="team-cards">
            @foreach($test as $t)
              <div class="team-card">
                <div class="inner">
                  <div class="member-head">
                    <img class="member-avatar"
                         src="{{ $t->images ? asset('backend/teams/'.$t->images) : asset('frontend/custom/user.png') }}"
                         alt="{{ $t->name }}">
                    <div class="flex-grow-1">
                      <h5 class="member-title">{{ $t->name }}</h5>
                      @if(!empty($t->desg))
                        <div class="member-meta">{{ $t->desg }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="card-actions">
                    <a href="{{ url('/management-team/'.$t->id.'/edit') }}"
                       class="btn btn-outline-primary">
                      <i data-feather="edit-2"></i> <span>Edit</span>
                    </a>
                    <a href="{{ url('/management-team/'.$t->id) }}"
                       class="btn btn-outline-danger js-swal-delete"
                       data-id="{{ $t->id }}" data-name="{{ $t->name ?? 'this item' }}">
                      <i data-feather="trash-2"></i> <span>Delete</span>
                    </a>
                  </div>

                  <form id="delete-media-post-{{ $t->id }}"
                        action="{{ url('/management-team/'.$t->id) }}"
                        method="post" class="d-none">
                    @csrf @method('DELETE')
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>

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
@endsection

{{-- Feather icons --}}
<script>
document.addEventListener('DOMContentLoaded', function(){ if (window.feather) feather.replace(); });
</script>

{{-- SweetAlert delete (fallback to confirm) --}}
<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.js-swal-delete');
  if (!btn) return;
  e.preventDefault();

  const id = btn.getAttribute('data-id');
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

{{-- Smart Back (referrer or /management-team) --}}
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
  const fallback = btn.dataset.backHref || "{{ url('/management-team') }}";
  const dest = hasRef ? ref : fallback;
  setTimeout(()=>{ location.href = dest; }, 0);
});
</script>
