{{-- resources/views/banks/index.blade.php --}}
@extends('layouts.app')

@section('content')

<style>
  /* ===== Header actions (Back + Add) ===== */
  .header-actions{ display:flex; gap:.5rem; justify-content:flex-end; flex-wrap:wrap; }
  @supports not (gap:.5rem){ .header-actions .btn + .btn{ margin-left:.5rem; } }

  /* ===== Desktop table polish ===== */
  .action-buttons{ display:inline-flex; gap:.5rem; align-items:center; }
  @supports not (gap:.5rem){ .action-buttons .btn + .btn{ margin-left:.5rem; } }
  .action-buttons .btn{
    width:auto !important; min-width:unset !important;
    padding:.32rem .55rem !important; font-size:.78rem !important;
    line-height:1.1 !important; border-radius:8px !important;
  }
  .action-buttons .btn i{ width:14px; height:14px; }

  /* ===== Mobile cards (≤ md) ===== */
  @media (max-width: 767.98px){
    /* hide desktop table on phones */
    #banks-list .table-responsive{ display:none !important; }

    .bank-cards{
      display:grid; gap:.9rem; padding:0 .5rem .75rem;
    }
    .bank-card{
      border:1px solid #edf1f5; border-radius:16px;
      box-shadow:0 10px 24px rgba(16,24,40,.06);
      background:#fff; overflow:hidden;
    }
    .bank-card .card-body{ padding:14px; }

    .bank-top{
      display:flex; align-items:center; gap:12px; margin-bottom:.4rem;
    }
    .bank-icon{
      width:48px; height:48px; border-radius:12px;
      display:flex; align-items:center; justify-content:center;
      background:#eef2ff; color:#4f46e5; font-weight:800; flex:0 0 48px;
    }
    .bank-title{
      margin:0; font-weight:800; color:#111827; line-height:1.15;
      display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }
    .muted{ color:#6b7280; font-size:.86rem; }

    .kv{ display:flex; align-items:center; gap:.4rem; }
    .kv b{ min-width:110px; color:#374151; }
    .kv + .kv{ margin-top:.25rem; }

    .bank-actions{
      display:grid; grid-template-columns:1fr 1fr; gap:.5rem; margin-top:.7rem;
    }
    .bank-actions .btn{ width:100%; border-radius:12px; padding:.55rem .9rem; }
    .bank-kebab{ margin-top:.4rem; display:flex; justify-content:flex-end; }
    .bank-kebab .btn{ padding:.35rem .55rem; border-radius:10px; border:1px solid #e5e7eb; background:#fff; }

    /* compress labels on ultra-small phones */
    @media (max-width:420px){ .bank-actions .btn span{ display:none; } }
  }
</style>

<div class="content-wrapper">
  {{-- ===== Header ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">BANKS</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + Add (modal) --}}
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-fallback="{{ url('/bank-details') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>

          <!--<button type="button"-->
          <!--        class="btn btn-primary btn-round btn-sm"-->
          <!--        data-toggle="modal" data-target="#inlineForm">-->
          <!--  <i data-feather="plus"></i><span class="ms-1">Add Bank Details</span>-->
          <!--</button>-->
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Content ===== --}}
  <div class="content-body" id="banks-list">
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header"><h4 class="card-title">List</h4></div>

          {{-- Desktop table (md and up) --}}
          <div class="table-responsive d-none d-md-block">
            @if(count($bank) > 0)
              <table class="table table-hover-animation">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Account Holder</th>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>IFSC</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                @foreach($bank as $list)
                  <tbody>
                    <tr>
                      <td>{{ $list->id }}</td>
                      <td>{{ $list->account_holder }}</td>
                      <td>{{ $list->bank_name }}</td>
                      <td>{{ $list->account_number }}</td>
                      <td>{{ $list->account_ifsc }}</td>
                      <td>
                        <div class="action-buttons">
                          <a class="btn btn-info btn-sm"
                             data-toggle="modal"
                             data-target="#inlineForm-{{ $list->id }}"
                             title="Edit">
                            <i data-feather="edit-2"></i><span class="d-none d-sm-inline"> Edit</span>
                          </a>

                          <a href="{{ url('/bank-details/'.$list->id) }}"
                             class="btn btn-danger btn-sm js-swal-delete"
                             data-id="{{ $list->id }}"
                             data-name="{{ $list->account_holder ?? 'this item' }}">
                            <i data-feather="trash-2"></i><span class="d-none d-sm-inline"> Delete</span>
                          </a>
                        </div>

                        <form id="delete-form-{{ $list->id }}"
                              action="{{ url('/bank-details/'.$list->id) }}"
                              method="post" class="d-none">
                          @csrf @method('DELETE')
                        </form>
                      </td>
                    </tr>
                  </tbody>
                @endforeach
              </table>
            @endif
          </div>

          {{-- Mobile cards (below md) --}}
          <div class="d-md-none">
            @if(count($bank) > 0)
              <div class="bank-cards">
                @foreach($bank as $list)
                  <div class="card bank-card">
                    <div class="card-body">
                      <div class="bank-top">
                        <div class="bank-icon">₹</div>
                        <div class="flex-grow-1">
                          <h5 class="bank-title">{{ $list->account_holder }}</h5>
                          <div class="muted">{{ $list->bank_name }}</div>
                        </div>

                        {{-- kebab menu --}}
                        <div class="bank-kebab">
                          <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item"
                                 data-toggle="modal"
                                 data-target="#inlineForm-{{ $list->id }}">
                                <i data-feather="edit-2" class="mr-50"></i> Edit
                              </a>
                              <a class="dropdown-item js-swal-delete"
                                 href="{{ url('/bank-details/'.$list->id) }}"
                                 data-id="{{ $list->id }}"
                                 data-name="{{ $list->account_holder ?? 'this item' }}">
                                <i data-feather="trash" class="mr-50"></i> Delete
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="kv"><b>Account #:</b> <span>{{ $list->account_number }}</span></div>
                      <div class="kv"><b>IFSC:</b> <span>{{ $list->account_ifsc }}</span></div>
                      @if(!empty($list->message))
                        <div class="kv"><b>Note:</b> <span class="muted">{{ $list->message }}</span></div>
                      @endif

                      <div class="bank-actions">
                        <a class="btn btn-outline-primary"
                           data-toggle="modal"
                           data-target="#inlineForm-{{ $list->id }}">
                          <i data-feather="edit-2"></i> <span>Edit</span>
                        </a>
                        <a href="{{ url('/bank-details/'.$list->id) }}"
                           class="btn btn-outline-danger js-swal-delete"
                           data-id="{{ $list->id }}"
                           data-name="{{ $list->account_holder ?? 'this item' }}">
                          <i data-feather="trash-2"></i> <span>Delete</span>
                        </a>
                      </div>

                      <form id="delete-form-{{ $list->id }}"
                            action="{{ url('/bank-details/'.$list->id) }}"
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

          {{-- Add Modal --}}
          <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel33">Add Details</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ url('/bank-details') }}" method="POST" id="faqform" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <label>Account Holder:</label>
                    <div class="form-group">
                      <input type="text" name="account_holder" class="form-control" required/>
                    </div>
                    <label>Bank Name:</label>
                    <div class="form-group">
                      <input type="text" name="bank_name" class="form-control" required/>
                    </div>
                    <label>Account Number:</label>
                    <div class="form-group">
                      <input type="text" name="account_number" class="form-control" required/>
                    </div>
                    <label>IFSC Code:</label>
                    <div class="form-group">
                      <input type="text" name="account_ifsc" class="form-control" required/>
                    </div>
                    <label>Message:</label>
                    <div class="form-group">
                      <textarea name="message" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" id="submit" class="btn btn-primary" value="Save">
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- Edit Modals --}}
          @foreach($bank as $list)
            <div class="modal fade text-left" id="inlineForm-{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{ url('/bank-details/'.$list->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <input type="hidden" name="user_id" value="{{ $list->user_id }}">
                    <div class="modal-body">
                      <label>Account Holder:</label>
                      <div class="form-group">
                        <input type="text" name="account_holder" value="{{ $list->account_holder }}" class="form-control" />
                      </div>
                      <label>Bank Name:</label>
                      <div class="form-group">
                        <input type="text" name="bank_name" value="{{ $list->bank_name }}" class="form-control" />
                      </div>
                      <label>Account Number:</label>
                      <div class="form-group">
                        <input type="text" name="account_number" value="{{ $list->account_number }}" class="form-control" required/>
                      </div>
                      <label>IFSC Code:</label>
                      <div class="form-group">
                        <input type="text" name="account_ifsc" value="{{ $list->account_ifsc }}" class="form-control" required/>
                      </div>
                      <label>Message:</label>
                      <div class="form-group">
                        <textarea name="message" class="form-control">{{ $list->message }}</textarea>
                      </div>
                      <label>Payment QR Code (file):</label>
                      <div class="form-group">
                        <input type="file" name="qr_code" class="form-control" />
                        @php
                          $qr='';
                          $msg=json_decode($list->message,true);
                          if (is_array($msg) && !empty($msg['qr'])) $qr=$msg['qr'];
                        @endphp
                        @if(!empty($qr))
                          @php
                            $ext = strtolower(pathinfo($qr, PATHINFO_EXTENSION));
                            $isImg = in_array($ext, ['jpg','jpeg','png','webp','gif','svg']);
                          @endphp
                          <div class="mt-1">
                            @if($isImg)
                              <img src="{{ asset('storage/'.$qr) }}" alt="QR" style="max-width:140px;border:1px solid #e5e7eb;border-radius:8px;" />
                            @else
                              <a class="btn btn-outline-primary btn-sm" href="{{ asset('storage/'.$qr) }}" target="_blank">Open current file</a>
                            @endif
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>

    {{-- Pagination / Empty --}}
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center mt-2">
        {{ $bank->links() }}
        @if(count($bank) == 0)
          <li class="mt-2 text-muted">No Data found</li>
        @endif
      </ul>
    </nav>
  </div>
</div>

@endsection

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
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ml-1'
    }
  }).then(function (result) {
    if (result.isConfirmed) form.submit();
  });
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
    e.preventDefault();
    e.stopPropagation();
    hardCloseMenu();

    const fallback = btn.dataset.backFallback || '{{ url("/bank-details") }}';
    const ref = document.referrer || '';
    const dest = ref.startsWith(location.origin) ? ref : fallback;

    setTimeout(()=>{ location.href = dest; }, 0);
  });

  document.addEventListener('DOMContentLoaded', hardCloseMenu);
  window.addEventListener('pageshow', ev => { if (ev.persisted) hardCloseMenu(); });
})();
</script>
