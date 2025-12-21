<style>
/* ===== What We Do section (scoped) ===== */
.wwd-section{
  padding: 50px 0 60px;
  background:#f9fafb;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
}

.wwd-section .wwd-head{
  text-align:center;
  margin-bottom:30px;
}

.wwd-section .wwd-kicker{
  font-size:.8rem;
  text-transform:uppercase;
  letter-spacing:.18em;
  color:#ff4d4d;
  margin:0 0 6px;
  font-weight:700;
}

.wwd-section .wwd-title-main{
  margin:0 0 8px;
  font-size:1.9rem;
  font-weight:800;
  color:#111827;
}

.wwd-section .wwd-sub{
  margin:0 auto;
  max-width:640px;
  color:#6b7280;
  font-size:.95rem;
}

/* grid */
.wwd-section .wwd-grid{
  display:grid;
  grid-template-columns:repeat(4, minmax(0,1fr));
  gap:20px;
}

/* Tablet + mobile: 2 per row */
@media (max-width:1024px){
  .wwd-section .wwd-grid{
    grid-template-columns:repeat(2, minmax(0,1fr));
  }
}

/* Extra-small phones: still 2 per row, but tighter gap */
@media (max-width:480px){
  .wwd-section .wwd-grid{
    grid-template-columns:repeat(2, minmax(0,1fr));
    gap:12px;
  }
}


/* cards */
.wwd-section .wwd-card{
  background:#ffffff;
  border-radius:18px;
  padding:18px 16px 20px;
  box-shadow:0 14px 32px rgba(15,23,42,.08);
  border:1px solid #f3f4f6;
  transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
}

.wwd-section .wwd-card:hover{
  transform:translateY(-4px);
  box-shadow:0 20px 40px rgba(15,23,42,.16);
  border-color:#fee2e2;
}

/* icon */
.wwd-section .wwd-icon-wrap{
  width:56px;
  height:56px;
  border-radius:18px;
  background:#fff1f1;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:14px;
  box-shadow:0 6px 16px rgba(248,113,113,.35);
}

.wwd-section .wwd-icon-wrap img{
  max-width:36px;
  max-height:36px;
  display:block;
}

.wwd-section .wwd-icon-fallback{
  display:flex;
  align-items:center;
  justify-content:center;
  width:100%; height:100%;
  border-radius:inherit;
  background:linear-gradient(135deg,#ff4d4d,#ff944d);
  color:#fff;
  font-weight:900;
  font-size:.95rem;
}

/* title + wave */
.wwd-section .wwd-card-title{
  margin:0 0 6px;
  font-size:1.02rem;
  font-weight:800;
  color:#0b1b4a;
}

.wwd-section .wwd-wave{
  display:flex;
  gap:4px;
  margin:4px 0 8px;
}
.wwd-section .wwd-wave span{
  width:14px;
  height:3px;
  border-radius:999px;
  background:#10b981;
}

/* description */
.wwd-section .wwd-card-text{
  margin:0;
  font-size:.9rem;
  color:#4b5563;
  line-height:1.55;
}

/* empty state */
.wwd-section .wwd-empty{
  text-align:center;
  color:#6b7280;
  margin-top:18px;
}


</style>

{{-- What We Do / Programs --}}
<section class="wwd-section">
    <div class="auto-container">
        <header class="wwd-head">
            <p class="wwd-kicker">What We Do</p>
            <h2 class="wwd-title-main">Our Key Program Areas</h2>
            <p class="wwd-sub">
                Together with our donors and volunteers, {{$setting->title}} runs focused
                programs that bring hope, dignity and opportunity to those who need it most.
            </p>
        </header>

        @if($whato->count())
            <div class="wwd-grid">
                @foreach($whato as $item)
                    <article class="wwd-card">
                        <div class="wwd-icon-wrap">
                            @if(!empty($item->images)) 
                                {{-- Assume `icon` is an image filename in backend/whato/  --}}
                                <img src="{{ asset('backend/home/todo/'.$item->images) }}"
                                     alt="{{ $item->title ?? 'Program' }}">
                            @else
                                {{-- Fallback circle with initials --}}
                                <span class="wwd-icon-fallback">
                                    {{ strtoupper(mb_substr($item->title ?? 'VSF', 0, 2)) }}
                                </span>
                            @endif
                        </div>

                        <h3 class="wwd-card-title">
                            {{ $item->title ?? 'Program Title' }}
                        </h3>

                        <div class="wwd-wave">
                            <span></span><span></span><span></span>
                        </div>

                        @if(!empty($item->description))
                            <p class="wwd-card-text">
                                {{ $item->description }}
                            </p>
                        @elseif(!empty($item->description))
                            <p class="wwd-card-text">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 80) }}
                            </p>
                        @endif
                    </article>
                @endforeach
            </div>
        @else
            <p class="wwd-empty">No program records found.</p>
        @endif
    </div>
</section>
