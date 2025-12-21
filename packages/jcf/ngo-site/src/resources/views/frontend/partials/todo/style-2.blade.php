<style>
/* ==== WHAT WE DO – STYLE 2 (BIG IMAGE CARDS) ==== */
.wwd2-section{
  padding:50px 0 65px;
  background:#f3f4ff;
  font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
}

.wwd2-section .wwd2-head{
  text-align:center;
  margin-bottom:26px;
}

.wwd2-section .wwd2-kicker{
  font-size:.8rem;
  text-transform:uppercase;
  letter-spacing:.18em;
  color:#ff4d4d;
  margin:0 0 6px;
  font-weight:700;
}

.wwd2-section .wwd2-title-main{
  margin:0 0 8px;
  font-size:1.9rem;
  font-weight:800;
  color:#0f172a;
}

.wwd2-section .wwd2-sub{
  margin:0 auto;
  max-width:650px;
  font-size:.95rem;
  color:#64748b;
}

/* GRID: desktop 4, tablet 3, mobile 2 */
.wwd2-section .wwd2-grid{
  display:grid;
  grid-template-columns:repeat(4,minmax(0,1fr));
  gap:20px;
}

@media(max-width:1024px){
  .wwd2-section .wwd2-grid{
    grid-template-columns:repeat(3,minmax(0,1fr));
  }
}
@media(max-width:768px){
  .wwd2-section .wwd2-grid{
    grid-template-columns:repeat(2,minmax(0,1fr));
  }
}
@media(max-width:480px){
  .wwd2-section .wwd2-grid{
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:12px;
  }
}

/* CARD */
.wwd2-section .wwd2-card{
  background:#ffffff;
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 16px 40px rgba(15,23,42,.14);
  border:1px solid #e5e7eb;
  display:flex;
  flex-direction:column;
  transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
}

.wwd2-section .wwd2-card:hover{
  transform:translateY(-4px);
  box-shadow:0 22px 52px rgba(15,23,42,.22);
  border-color:#fecaca;
}

/* TOP IMAGE AREA */
.wwd2-section .wwd2-media{
  position:relative;
  width:100%;
  height:150px;
  background:#e5e7eb;
  overflow:hidden;
}

.wwd2-section .wwd2-media img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
}

/* gradient fallback if no image */
.wwd2-section .wwd2-media-fallback{
  width:100%; height:100%;
  display:flex; align-items:center; justify-content:center;
  background:linear-gradient(135deg,#ff4d4d,#ff944d);
  color:#fff; font-weight:900; font-size:1.3rem;
}

/* subtle top highlight */
.wwd2-section .wwd2-media::after{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(180deg,rgba(255,255,255,.5),transparent 40%);
}

/* BODY */
.wwd2-section .wwd2-body{
  padding:14px 14px 16px;
}

.wwd2-section .wwd2-title{
  margin:4px 0 6px;
  font-size:1rem;
  font-weight:800;
  color:#0b1b4a;
}

/* little green waves like reference */
.wwd2-section .wwd2-accent-line{
  display:flex;
  gap:4px;
  margin-bottom:8px;
}
.wwd2-section .wwd2-accent-line span{
  width:16px;
  height:3px;
  border-radius:999px;
  background:#10b981;
}

.wwd2-section .wwd2-text{
  margin:0;
  font-size:.88rem;
  color:#4b5563;
  line-height:1.55;
}

/* empty */
.wwd2-section .wwd2-empty{
  text-align:center;
  color:#6b7280;
  margin-top:20px;
}

</style>



{{-- WHAT WE DO – STYLE 2 (BIG IMAGE CARDS) --}}
<section class="wwd2-section">
    <div class="auto-container">
        <header class="wwd2-head">
            <p class="wwd2-kicker">What We Do</p>
            <h2 class="wwd2-title-main">Programmes That Create Real Impact</h2>
            <p class="wwd2-sub">
                Each initiative of Vihatmaa Sewa Foundation is designed to touch lives through
                education, health, nutrition and social empowerment.
            </p>
        </header>

        @if($whato->count())
            <div class="wwd2-grid">
                @foreach($whato as $item)
                    <article class="wwd2-card">
                        {{-- Top image / banner --}}
                        <div class="wwd2-media">
                            @if(!empty($item->images))
                                {{-- assuming icon is an image file name in backend/whato --}}
                                <img src="{{ asset('backend/home/todo/'.$item->images) }}"
                                     alt="{{ $item->title ?? 'Programme' }}">
                            @else
                                {{-- fallback gradient block with initials --}}
                                <div class="wwd2-media-fallback">
                                    <span>{{ strtoupper(mb_substr($item->title ?? 'VSF', 0, 2)) }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Text area --}}
                        <div class="wwd2-body">
                            <h3 class="wwd2-title">
                                {{ $item->title ?? 'Programme Title' }}
                            </h3>

                            <div class="wwd2-accent-line">
                                <span></span><span></span><span></span>
                            </div>

                            @if(!empty($item->short_description))
                                <p class="wwd2-text">
                                    {{ $item->short_description }}
                                </p>
                            @elseif(!empty($item->description))
                                <p class="wwd2-text">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 90) }}
                                </p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="wwd2-empty">No programme records available at the moment.</p>
        @endif
    </div>
</section>
