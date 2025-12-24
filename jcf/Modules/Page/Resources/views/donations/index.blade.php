{{-- resources/views/donations/index.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
  /* --------- Header right actions --------- */
  .header-actions{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;}
  @supports not (gap:.5rem){.header-actions>*+*{margin-left:.5rem}}
  /* --------- Card grid --------- */
  .don-grid{display:grid;gap:12px;}
  @media (min-width: 768px){ .don-grid{grid-template-columns: 1fr 1fr;} }
  /* --------- Card --------- */
  .don-card{
    border:1px solid #eef2f7; border-radius:16px; background:#fff;
    box-shadow:0 6px 16px rgba(16,24,40,.06);
  }
  .don-card .card-inner{ padding:16px; }
  /* Header: avatar + name + badge right */
  .don-card .head{ display:flex; align-items:center; gap:12px; }
  .don-card .avatar{
    width:40px; height:40px; border-radius:999px; background:#eef2ff; color:#4f46e5;
    display:flex; align-items:center; justify-content:center; font-weight:800;
    box-shadow:inset 0 0 0 2px #fff;
  }
  .don-card .title{ margin:0; font-weight:800; color:#111827; }
  .don-card .subtle{ color:#6b7280; font-size:.85rem; }
  .don-card .status{
    margin-left:auto; background:#e8faf0; color:#127c47; border-radius:999px; padding:.25rem .6rem; font-weight:700; font-size:.8rem;
  }
  .don-card .status.failed{ background:#fee2e2; color:#b91c1c; }
  .don-card .status.pending{ background:#eef6ff; color:#1e64d0; }

  /* Body split: left meta / right amount */
  .don-card .body{
    display:grid; gap:10px; margin-top:10px;
    grid-template-columns: 1fr;
  }
  @media (min-width: 768px){
    .don-card .body{ grid-template-columns: 1fr 220px; align-items:flex-start; }
  }

  /* Meta list */
  .meta .label{ color:#94a3b8; font-size:.75rem; margin-bottom:2px; }
  .meta .value{ color:#0f172a; font-weight:600; margin-bottom:.5rem; word-break:break-word; }
  .chip{
    display:inline-flex; align-items:center; gap:.35rem; background:#f2f4f7;
    border:1px solid #e5e7eb; border-radius:999px; padding:.2rem .55rem; font-size:.8rem; font-weight:600; color:#334155;
  }

  /* Amount block (right column) */
  .amt{
    background:#fafbff; border:1px dashed #e5e7eb; border-radius:12px; padding:12px;
    text-align:center;
  }
  .cur{ color:#64748b; font-size:.9rem; font-weight:700; }
  .num{ font-size:1.35rem; line-height:1.1; font-weight:900; color:#0f172a; }
  .paymode{ margin-top:6px; }

  /* Footer (date) */
  .don-card .foot{ margin-top:8px; color:#64748b; font-size:.85rem; }

  /* Table wrapper if you keep the table below */
  .table-wrap{ overflow:auto; }

  /* Prevent any horizontal scroll on this page */
  .content-wrapper{ overflow-x: hidden; }
  .don-grid{ overflow-x: hidden; }
  .don-card{ max-width: 100%; }
  .don-card img{ max-width: 100%; height: auto; }
</style>

<div class="content-wrapper">
  {{-- ===== Header ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">Donations</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Donations</li>
            </ol>
          </div>
        </div>

        {{-- Right: Back + Add New --}}
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-href="{{ url('/donations') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>
          {{-- If you don’t have a “create donation” route, hide/remove this --}}
          <!--<a href="{{ url('/donations/create') }}"-->
          <!--   class="btn btn-primary btn-round btn-sm">-->
          <!--  <i data-feather="plus"></i><span class="ms-1">Add Donation</span>-->
          <!--</a>-->
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Body (card grid) ===== --}}
  <div class="content-body">
    <div class="don-grid">
      @forelse($rows as $r)
        @php
          $donor = optional($r->donor);
          $name  = $donor->name ?? '—';
          $initial = mb_strtoupper(mb_substr($name,0,1));
          $status = strtolower($r->status ?? 'pending'); // paid|failed|pending
          $statusClass = $status === 'paid' ? '' : ($status === 'failed' ? 'failed' : 'pending');
        @endphp

        <div class="don-card">
          <div class="card-inner">
            {{-- Head --}}
            <div class="head">
              <div class="avatar">{{ $initial }}</div>
              <div>
                <h5 class="title">{{ $name }}</h5>
                <div class="subtle">{{ $r->campaign ?? '—' }}</div>
              </div>
              <span class="status {{ $statusClass }}">{{ ucfirst($status) }}</span>
            </div>

            {{-- Body --}}
            <div class="body">
              {{-- Left: details --}}
              <div class="meta">
                <div class="label">Mobile</div>
                <div class="value">{{ $donor->mobile ?? '—' }}</div>

                <div class="label">Order ID</div>
                <div class="value" style="word-break:break-all">{{ $r->razorpay_order_id ?? '—' }}</div>

                <div class="label">Payment ID</div>
                <div class="value" style="word-break:break-all">{{ $r->razorpay_payment_id ?? ($r->meta['payment_id'] ?? '—') }}</div>
              </div>

              {{-- Right: amount + pay mode --}}
              <div class="amt">
                <div class="cur">₹</div>
                <div class="num">{{ number_format(($r->amount_paise ?? 0)/100, 2) }}</div>
                @if(!empty($r->meta['pay_mode']))
                  <div class="paymode"><span class="chip">{{ $r->meta['pay_mode'] }}</span></div>
                @endif
              </div>
            </div>

            {{-- Footer: actions + date --}}
            <div class="foot d-flex align-items-center justify-content-between flex-wrap gap-2">
              <div class="d-flex align-items-center gap-1">
                @if($r->status === 'paid')
                  @if(empty($r->receipt_pdf_path))
                    <form method="post" action="{{ route('donations.receipt.generate', $r) }}">@csrf
                      <button class="btn btn-sm btn-outline-primary" type="submit">Generate Receipt</button>
                    </form>
                  @else
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('donations.receipt.download', $r) }}">Download</a>
                    @if(optional($r->donor)->email)
                      <form method="post" action="{{ route('donations.receipt.email', $r) }}" class="d-inline">@csrf
                        <button class="btn btn-sm btn-outline-success" type="submit">Email</button>
                      </form>
                    @endif
                  @endif
                @endif
              </div>
              <span>{{ optional($r->created_at)->format('d M Y, h:i A') }}</span>
            </div>
          </div>
        </div>
      @empty
        <div class="don-card">
          <div class="card-inner text-center text-muted">No donations found.</div>
        </div>
      @endforelse
    </div>

    {{-- If you also want pagination, uncomment below --}}
    {{-- <div class="mt-1">{{ $rows->links() }}</div> --}}
  </div>
</div>

{{-- Feather (icons) + Smart Back (same behavior as your other pages) --}}
<script>
  document.addEventListener('DOMContentLoaded', function(){ if (window.feather) feather.replace(); });

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
    const ref = document.referrer || "";
    const dest = btn.dataset.backHref || (ref.startsWith(location.origin) ? ref : "{{ url('/donations') }}");
    setTimeout(()=>{ location.href = dest; }, 0);
  });
</script>
@endsection

