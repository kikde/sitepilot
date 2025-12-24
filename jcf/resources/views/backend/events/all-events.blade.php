{{-- resources/views/admin/events/index.blade.php --}}
@extends('layouts.app')

@section('content')

<style>
  /* ===== Header (title left, actions right on page bg) ===== */
  .header-bar{
    display:flex; align-items:center; justify-content:space-between;
    gap:1rem; flex-wrap:wrap; padding:.25rem 0 .5rem;
  }
  .header-actions{ display:flex; gap:.5rem; flex-wrap:wrap; }
  @supports not (gap:.5rem){ .header-actions > * + * { margin-left:.5rem; } }
  @media (max-width:480px){ .header-actions .btn{ flex:1 1 auto; } }

  /* Buttons look like the rest of your app */
  .btn-round{ border-radius:999px; }
  .btn-primary{ background:#6c5ce7; border-color:#6c5ce7; }
  .btn-primary:hover{ background:#5947e4; border-color:#5947e4; }
  .btn-outline-secondary{ background:transparent; }

  /* ===== Card grid ===== */
  .event-grid{
    display:grid; grid-template-columns: repeat(12, 1fr); gap:16px;
  }
  .event-grid > .event-col{ grid-column: span 12; }
  @media (min-width:576px){ .event-grid > .event-col{ grid-column: span 6; } }
  @media (min-width:992px){ .event-grid > .event-col{ grid-column: span 4; } }
  @media (min-width:1400px){ .event-grid > .event-col{ grid-column: span 3; } }

  /* ===== Event card ===== */
  .event-card{
    position:relative;
    border:1px solid #eef1f6; border-radius:18px; background:#fff;
    box-shadow:0 8px 18px rgba(16,24,40,.06); overflow:hidden;
    transition:transform .16s ease, box-shadow .16s ease;
  }
  .event-card:hover{ transform:translateY(-2px); box-shadow:0 14px 28px rgba(16,24,40,.10); }

  /* top accent */
  .event-accent{
    height:8px; width:100%;
    background:linear-gradient(90deg,#6c5ce7,#a78bfa,#22c55e);
  }

  .event-body{ padding:16px; }

  .event-head{
    display:flex; align-items:flex-start; gap:12px; margin-bottom:.75rem;
  }
  .event-thumb{
    width:72px; height:72px; border-radius:12px; object-fit:cover;
    background:#f3f4f6; flex:0 0 72px; border:2px solid #fff; box-shadow:0 6px 14px rgba(16,24,40,.08);
  }
  .event-title{
    margin:0; font-weight:800; line-height:1.25; color:#111827;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
  }

  .event-meta{
    display:flex; flex-wrap:wrap; gap:.4rem .6rem; margin-top:.35rem; align-items:center;
    font-size:.85rem; color:#6b7280;
  }
  .pill{
    display:inline-flex; align-items:center; gap:.35rem; padding:.28rem .55rem;
    border-radius:999px; border:1px solid #e5e7eb; background:#fff; font-weight:600; font-size:.78rem;
  }
  .badge-soft{
    padding:.28rem .55rem; border-radius:999px; font-weight:700; font-size:.78rem;
  }
  .badge-publish{ background:#e8faf0; color:#137a4b; border:1px solid #b7efcd; }
  .badge-draft{ background:#eef1f6; color:#475569; border:1px solid #e2e8f0; }

  .event-footer{
    padding:12px 16px 16px;
  }

  /* centered action buttons (equal width) */
  .event-actions{
    display:grid; grid-template-columns:1fr 1fr 1fr; gap:.6rem;
  }
  .event-actions .btn{ border-radius:12px; width:100%; }
  .btn-outline-primary{ border-color:#c7c9ff; color:#4f46e5; }
  .btn-outline-primary:hover{ color:#fff; background:#4f46e5; border-color:#4f46e5; }
  .btn-outline-secondary{ border-color:#d1d5db; color:#374151; }
  .btn-outline-secondary:hover{ color:#111827; background:#e5e7eb; }
  .btn-outline-danger{ border-color:#fecaca; color:#dc2626; }
  .btn-outline-danger:hover{ color:#fff; background:#dc2626; border-color:#dc2626; }

  /* small icon size */
  i[data-feather]{ width:16px; height:16px; }
</style>

<div class="content-wrapper">

  {{-- ===== Header (no white card behind) ===== --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="header-bar">
        <div>
          <h2 class="content-header-title mb-0">All Events</h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">All Events</li>
            </ol>
          </nav>
        </div>
        <div class="header-actions">
          <a href="javascript:void(0)"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-fallback="{{ url('/admin/events') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>
          <a href="{{ route('admin.events.new') }}"
             class="btn btn-primary btn-round btn-sm">
            <i data-feather="plus"></i><span class="ms-1">Add Event</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== Body (Card Grid) ===== --}}
  <div class="content-body">
    <div class="event-grid">
      @forelse($all_events as $data)
        <div class="event-col">
          <div class="event-card">
            <div class="event-accent"></div>

            <div class="event-body">
              <div class="event-head">
                <img class="event-thumb"
                     src="{{ $data->image ? asset('backend/events/'.$data->image) : asset('frontend/custom/breadcrump.png') }}"
                     alt="{{ $data->title }}">
                <div class="min-w-0 flex-1">
                  <h5 class="event-title">{{ $data->title }}</h5>

                  <div class="event-meta">
                    <span class="pill">#{{ $data->id }}</span>
                    @if(optional($data->category)->title)
                      <span class="pill"><i data-feather="tag"></i> {{ optional($data->category)->title }}</span>
                    @endif
                    @php
                      $isPublish = ($data->status ?? 'draft') === 'publish';
                      $when = optional($data->created_at)->format('d M Y, h:i A') ?? '';
                    @endphp
                    <span class="badge-soft {{ $isPublish ? 'badge-publish' : 'badge-draft' }}">
                      {{ ucfirst($data->status ?? 'draft') }}
                    </span>
                    @if($when)
                      <span class="pill"><i data-feather="clock"></i> {{ $when }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="event-footer">
              <div class="event-actions">
                {{-- Edit --}}
                <a href="{{ route('admin.events.edit',$data->id) }}"
                   class="btn btn-outline-primary btn-sm">
                  <i data-feather="edit-2"></i> <span class="ms-1">Edit</span>
                </a>

                {{-- Clone --}}
                <form method="POST" action="{{ route('admin.events.clone') }}">
                  @csrf
                  <input type="hidden" name="id" value="{{ $data->id }}">
                  <button class="btn btn-outline-secondary btn-sm" type="submit">
                    <i data-feather="copy"></i> <span class="ms-1">Clone</span>
                  </button>
                </form>

                {{-- Delete --}}
                <form method="POST" action="{{ route('admin.events.delete',$data->id) }}"
                      onsubmit="return confirm('Delete this event?')">
                  @csrf
             
                  <button class="btn btn-outline-danger btn-sm" type="submit">
                    <i data-feather="trash-2"></i> <span class="ms-1">Delete</span>
                  </button>
                </form>
              </div>
            </div>

          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="card">
            <div class="card-body text-center text-muted">No events found.</div>
          </div>
        </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-center">
      {{ $all_events->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>

{{-- Feather (icons) + Smart Back --}}
<script>
  document.addEventListener('DOMContentLoaded', function(){
    if (window.feather) feather.replace();
  });

  (function(){
    function hardCloseMenu(){
      document.body.classList.remove('menu-open','menu-expanded');
      document.querySelectorAll('.sidenav-overlay, .drag-target')
        .forEach(n=>{ try{ n.remove(); }catch(e){} });
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
      const fallback = btn.dataset.backFallback || "{{ url('/admin/events') }}";
      const ref = document.referrer || '';
      const dest = ref.startsWith(location.origin) ? ref : fallback;
      setTimeout(()=>{ location.href = dest; }, 0);
    });
  })();
</script>

@endsection
