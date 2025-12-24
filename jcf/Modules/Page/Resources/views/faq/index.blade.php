{{-- resources/views/faqs/index.blade.php --}}
@extends('layouts.app')

@section('content')

<style>
  /* ===== Header actions (Back + Add) ===== */
  .header-actions{display:flex;gap:.5rem;justify-content:flex-end;flex-wrap:wrap}
  @supports not (gap:.5rem){.header-actions .btn+.btn{margin-left:.5rem}}
  @media (max-width:480px){ .header-actions .btn{flex:1 1 auto} }

  /* ===== Desktop table: calm, non-shaky row actions ===== */
  .table thead th{white-space:nowrap;font-weight:700;color:#6b7280;letter-spacing:.02em}
  .table tbody td{vertical-align:middle}
  .row-actions{display:inline-flex;gap:.5rem;align-items:center;white-space:nowrap}
  .row-actions .btn{padding:.34rem .6rem;border-radius:10px;font-size:.82rem;line-height:1.15}
  .row-actions i[data-feather]{width:16px;height:16px}
  @media (max-width:520px){ .row-actions .btn span{display:none} }

  /* ===== Mobile cards (≤ md) ===== */
  @media (max-width: 767.98px){
    /* hide desktop table on phones */
    .faq-table-wrap{display:none!important}

    .faq-cards{display:grid;gap:.9rem}
    .faq-card{
      border:1px solid #eef2f7;border-radius:16px;background:#fff;
      box-shadow:0 10px 24px rgba(16,24,40,.06);overflow:hidden
    }
    .faq-card .inner{padding:14px}
    .faq-head{display:flex;gap:12px;align-items:flex-start}
    .faq-bullet{
      width:36px;height:36px;border-radius:12px;flex:0 0 36px;
      display:grid;place-items:center;background:#f3f4f6;color:#111827;font-weight:800
    }
    .faq-title{margin:0;font-weight:800;color:#111827;line-height:1.15}
    .faq-meta{color:#6b7280;font-size:.86rem;margin-top:.1rem}

    /* mini accordion for answer preview */
    .faq-accordion{margin-top:.65rem;border:1px dashed #e5e7eb;border-radius:12px;background:#fafbfd}
    .faq-accordion summary{
      list-style:none;cursor:pointer;padding:.55rem .75rem;border-radius:12px;
      display:flex;align-items:center;gap:.5rem
    }
    .faq-accordion summary::-webkit-details-marker{display:none}
    .faq-accordion .body{padding:0 .75rem .75rem;color:#4b5563;font-size:.95rem}
    .faq-accordion .tag{font-size:.75rem;padding:.12rem .45rem;border-radius:999px;background:#eef6ff;color:#1e64d0}

    /* actions row: stable 2-column buttons */
    .card-actions{display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.7rem}
    .card-actions .btn{width:100%;border-radius:12px;padding:.55rem .9rem}
    .card-actions i[data-feather]{width:16px;height:16px}
  }
</style>

<div class="content-wrapper">
  {{-- ===== Header ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">FAQ’s</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">FAQ list</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + Add FAQ --}}
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-fallback="{{ url('/faqs') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>
          <button type="button" class="btn btn-primary btn-round btn-sm"
                  data-toggle="modal" data-target="#inlineForm">
            <i data-feather="plus"></i><span class="ms-1">Add FAQ</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Body ===== --}}
  <div class="content-body">

    <div class="card">
      <div class="card-header"><h4 class="card-title mb-0">List</h4></div>

      {{-- Desktop table --}}
      <div class="faq-table-wrap">
        @if(count($faq) > 0)
        <div class="table-responsive">
          <table class="table table-hover-animation">
            <thead>
              <tr>
                <th style="width:90px">S.No.</th>
                <th>Question</th>
                <th style="width:180px">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($faq as $f)
              <tr>
                <td>{{ $f->id }}</td>
                <td>{{ $f->question }}</td>
                <td>
                  <div class="row-actions">
                    <a class="btn btn-info btn-sm" data-toggle="modal"
                       data-target="#inlineForm-{{ $f->id }}" title="Edit">
                      <i data-feather="edit-2"></i><span> Edit</span>
                    </a>
                    <a href="{{ url('/faqs/'.$f->id) }}"
                       class="btn btn-danger btn-sm js-swal-delete"
                       data-id="{{ $f->id }}" data-name="{{ $f->question ?? 'this item' }}">
                      <i data-feather="trash-2"></i><span> Delete</span>
                    </a>
                  </div>
                  <form id="delete-form-{{ $f->id }}" action="{{ url('/faqs/'.$f->id) }}" method="post" class="d-none">
                    @csrf @method('DELETE')
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>

      {{-- Mobile cards --}}
      <div class="d-md-none px-1 pb-1">
        @if(count($faq) > 0)
          <div class="faq-cards">
            @foreach($faq as $f)
              <div class="faq-card">
                <div class="inner">
                  <div class="faq-head">
                    <div class="faq-bullet">{{ $f->id }}</div>
                    <div class="flex-grow-1">
                      <h5 class="faq-title">{{ $f->question }}</h5>
                      <div class="faq-meta">ID: #{{ $f->id }}</div>
                    </div>
                  </div>

                  <details class="faq-accordion">
                    <summary>
                      <span class="tag">Answer</span>
                      <span class="ms-1 text-muted">(tap to view)</span>
                    </summary>
                    <div class="body">{!! nl2br(e($f->answer)) ?: '—' !!}</div>
                  </details>

                  <div class="card-actions">
                    <a class="btn btn-outline-primary" data-toggle="modal"
                       data-target="#inlineForm-{{ $f->id }}">
                      <i data-feather="edit-2"></i> <span>Edit</span>
                    </a>
                    <a href="{{ url('/faqs/'.$f->id) }}"
                       class="btn btn-outline-danger js-swal-delete"
                       data-id="{{ $f->id }}" data-name="{{ $f->question ?? 'this item' }}">
                      <i data-feather="trash-2"></i> <span>Delete</span>
                    </a>
                  </div>

                  <form id="delete-form-{{ $f->id }}" action="{{ url('/faqs/'.$f->id) }}" method="post" class="d-none">
                    @csrf @method('DELETE')
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    {{-- Pagination / Empty --}}
    @if(count($faq))
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-2">{{ $faq->links() }}</ul>
      </nav>
    @else
      <div class="card"><div class="card-body text-center text-muted">No Data found</div></div>
    @endif

    {{-- Add Modal --}}
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add FAQ’s</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
          </div>
          <form action="{{ url('/faqs') }}" method="POST">
            @csrf
            <div class="modal-body">
              <label>Question:</label>
              <input type="text" name="question" class="form-control mb-1" />
              <label>Answer:</label>
              <textarea name="answer" class="form-control" rows="4"></textarea>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Edit Modals --}}
    @foreach($faq as $f)
      <div class="modal fade text-left" id="inlineForm-{{ $f->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit FAQ’s</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <form action="{{ url('/faqs/'.$f->id) }}" method="POST">
              @csrf @method('PUT')
              <div class="modal-body">
                <label>Question:</label>
                <input type="text" name="question" value="{{ $f->question }}" class="form-control mb-1" />
                <label>Answer:</label>
                <textarea name="answer" class="form-control" rows="4">{{ $f->answer }}</textarea>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach

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

  const id   = btn.getAttribute('data-id');
  const name = btn.getAttribute('data-name') || 'this item';
  const form = document.getElementById('delete-form-' + id);
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
    const fallback = btn.dataset.backFallback || '{{ url('/faqs') }}';
    const ref = document.referrer || '';
    const dest = ref.startsWith(location.origin) ? ref : fallback;
    setTimeout(()=>{ location.href = dest; }, 0);
  });
  document.addEventListener('DOMContentLoaded', hardCloseMenu);
  window.addEventListener('pageshow', ev => { if (ev.persisted) hardCloseMenu(); });
})();
</script>
