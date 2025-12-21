{{-- resources/views/donors/index.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
  /* ===== Header actions (right aligned with spacing) ===== */
  .header-actions{ display:flex; align-items:center; gap:.5rem; flex-wrap:wrap; }
  @supports not (gap:.5rem){ .header-actions > * + *{ margin-left:.5rem; } }

  /* ===== Desktop table polish (kept) ===== */
  #donors-table{ table-layout:fixed; margin-bottom:0; border-collapse:separate; border-spacing:0; }
  #donors-table thead th{ white-space:nowrap; font-weight:700; color:#6b7280; letter-spacing:.02em; }
  #donors-table tbody td{ vertical-align:middle; padding:14px 16px; border-color:#f1f5f9; }
  #donors-table tbody tr + tr td{ border-top:1px solid #f3f4f6; }
  #donors-table td:first-child img{
    width:56px; height:56px; border-radius:50%; object-fit:cover;
    box-shadow:0 10px 24px rgba(16,24,40,.08); border:3px solid #fff;
  }

  /* ===== Mobile cards (≤ md) ===== */
  @media (max-width: 767.98px){
    /* hide desktop table on phones */
    #donors-list .table-responsive{ display:none !important; }

    .donor-cards{ display:grid; gap:.9rem; padding:0 .5rem .75rem; }
    .donor-card{
      border:1px solid #edf1f5; border-radius:16px;
      box-shadow:0 10px 24px rgba(16,24,40,.06); overflow:hidden; background:#fff;
    }
    .donor-card .card-body{ padding:14px; }

    /* Header row with avatar | name | kebab (⋯) on the right */
    .donor-head{ display:flex; align-items:center; gap:12px; }
    .donor-avatar{
      width:72px; height:72px; border-radius:50%; object-fit:cover; flex:0 0 72px; background:#f3f4f6;
    }
    .donor-info{ flex:1 1 auto; min-width:0; }
    .donor-title{
      margin:0; font-weight:800; color:#111827; line-height:1.15;
      display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }
    .donor-meta{ color:#6b7280; font-size:.86rem; margin-top:.15rem; }
    .donor-kebab{ margin-left:auto; }
    .donor-kebab .btn{ padding:.35rem .55rem; border-radius:10px; border:1px solid #e5e7eb; background:#fff; }

    /* Primary action row beneath header */
    .donor-actions{
      display:grid; grid-template-columns:1fr 1fr; gap:.5rem; margin-top:.7rem;
    }
    .donor-actions .btn{ width:100%; border-radius:12px; padding:.55rem .9rem; }

    /* compress labels on ultra-small phones */
    @media (max-width:420px){ .donor-actions .btn span{ display:none; } }
  }

  /* small icon size everywhere */
  i[data-feather]{ width:16px; height:16px; }
</style>

<div class="content-wrapper">
  {{-- ===== Header ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">Donors</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Donor list</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + Add New --}}
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-href="{{ url('/donors') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>

          <a href="{{ url('/donors/create') }}" class="btn btn-primary btn-round btn-sm">
            <i data-feather="plus"></i><span class="ms-1">Add New</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Body ===== --}}
  <div class="content-body" id="donors-list">
    <div class="row">
      <div class="col-12">
        <div class="card">

          {{-- ========== DESKTOP TABLE (md and up) ========== --}}
          <div class="table-responsive d-none d-md-block">
            <table class="table" id="donors-table">
              <thead>
                <tr>
                  <th style="width:84px">Image</th>
                  <th>Name</th>
                  <th style="width:160px">Donations</th>
                  <th style="width:140px">Contact</th>
                  <th style="width:90px">Actions</th>
                </tr>
              </thead>
              @if(count($donar) > 0)
                @foreach($donar as $lists)
                  <tbody>
                    <tr>
                      <td>
                        @if($lists->profile)
                          <img src="{{ asset('backend/uploads/'.$lists->profile) }}" alt="{{ $lists->name }}">
                        @else
                          <img src="{{ asset('backend/uploads/user.jpg') }}" alt="{{ $lists->name }}">
                        @endif
                      </td>
                      <td><strong class="text-dark">{{ $lists->name }}</strong></td>
                      <td>
                        <a class="btn btn-sm btn-outline-primary"
                           href="{{ route('donations.index', ['donor' => $lists->id]) }}">
                          <i data-feather="credit-card"></i> <span>View</span>
                        </a>
                      </td>
                      <td>{{ $lists->mobile }}</td>
                      <td class="actions-cell">
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('/donors/'.$lists->id) }}">
                              <i data-feather="edit-2" class="mr-50"></i><span>Edit</span>
                            </a>
                            <a class="dropdown-item js-swal-delete"
                               href="{{ url('/donors/'.$lists->id) }}"
                               data-id="{{ $lists->id }}"
                               data-name="{{ $lists->name ?? 'this item' }}">
                              <i data-feather="trash" class="mr-50"></i><span>Delete</span>
                            </a>
                            <form id="delete-media-post-{{ $lists->id }}"
                                  action="{{ url('/donors/'.$lists->id) }}"
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

          {{-- ========== MOBILE CARDS (below md) ========== --}}
          <div class="d-md-none">
            @if(count($donar) > 0)
              <div class="donor-cards">
                @foreach($donar as $lists)
                  <div class="card donor-card">
                    <div class="card-body">

                      {{-- Header: avatar | name/meta | kebab top-right --}}
                      <div class="donor-head">
                        <img class="donor-avatar"
                             src="{{ $lists->profile ? asset('backend/uploads/'.$lists->profile) : asset('backend/uploads/user.jpg') }}"
                             alt="{{ $lists->name }}">
                        <div class="donor-info">
                          <h5 class="donor-title">{{ $lists->name }}</h5>
                          @if(!empty($lists->mobile))
                            <div class="donor-meta"><i data-feather="phone"></i> {{ $lists->mobile }}</div>
                          @endif
                        </div>
                        <div class="donor-kebab">
                          <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item js-swal-delete"
                                 href="{{ url('/donors/'.$lists->id) }}"
                                 data-id="{{ $lists->id }}"
                                 data-name="{{ $lists->name ?? 'this item' }}">
                                <i data-feather="trash"></i> Delete
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>

                      {{-- Primary actions row --}}
                      <div class="donor-actions">
                        <a href="{{ route('donations.index', ['donor' => $lists->id]) }}"
                           class="btn btn-outline-primary">
                          <i data-feather="credit-card"></i> <span>Donations</span>
                        </a>
                        <a href="{{ url('/donors/'.$lists->id) }}"
                           class="btn btn-outline-secondary">
                          <i data-feather="edit-2"></i> <span>Edit</span>
                        </a>
                      </div>

                      <form id="delete-media-post-{{ $lists->id }}"
                            action="{{ url('/donors/'.$lists->id) }}"
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
          {{-- /MOBILE CARDS --}}
        </div>

        {{-- Pagination --}}
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center mt-2">
            {{ $donar->links() }}
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

{{-- Feather refresh (if not already globally) --}}
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
  }).then(function (result) {
    if (result.isConfirmed) form.submit();
  });
});
</script>

{{-- Smart Back consistent with other pages --}}
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
  const DONOR_BACK_FALLBACK = "{{ url('/donors') }}";
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-smart-back]');
    if (!btn) return;
    e.preventDefault(); e.stopPropagation();
    hardCloseMenu();
    const ref = document.referrer || "";
    const dest = btn.dataset.backHref || (ref.startsWith(location.origin) ? ref : DONOR_BACK_FALLBACK);
    setTimeout(()=>{ location.href = dest; }, 0);
  });
</script>
@endsection
