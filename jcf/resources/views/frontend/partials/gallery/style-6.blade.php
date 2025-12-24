{{-- resources/views/gallery.blade.php --}}

{{-- ========== Mosaic Gallery ========== --}}
<section class="gallery-mosaic dp-scope">
  <h3 class="gm-title">Highlights</h3>

  <div class="gm-grid">
    @forelse($photos as $photo)
      <a class="gm-item" href="{{ url('photo-gallery') }}">
        <img 
          src="{{ asset('backend/gallery/photo/'.$photo->images) }}" 
          alt="{{ $photo->title ?? 'Gallery Photo' }}" 
          loading="lazy">
      </a>
    @empty
      {{-- fallback placeholders if no photos --}}
      @for($i=1; $i<=8; $i++)
        <a class="gm-item" href="#">
          <img src="https://picsum.photos/seed/m{{ $i }}/800/600" alt="Placeholder">
        </a>
      @endfor
    @endforelse
  </div>

  <div class="gm-footer">
    <a href="https://mdmks.kikde.in/photo-gallery" class="gm-btn">View All</a>
  </div>
</section>



{{-- ========== Justified Rows Gallery ========== --}}
<section class="gallery-justified dp-scope">
  <h3 class="gj-title">Moments</h3>

  <div class="gj-rows" id="gjRows">
    @forelse($photos as $photo)
      <img 
        src="{{ asset('backend/gallery/photo/'.$photo->images) }}" 
        alt="{{ $photo->title ?? 'Gallery Photo' }}" 
        loading="lazy">
    @empty
      {{-- fallback placeholders --}}
      @for($i=1; $i<=8; $i++)
        <img src="https://picsum.photos/seed/j{{ $i }}/800/600" alt="Placeholder">
      @endfor
    @endforelse
  </div>

  <div class="gj-footer">
    <a href="https://mdmks.kikde.in/photo-gallery" class="gj-btn">Explore More</a>
  </div>
</section>


<style>
/* ===== Scoped base (prevents theme overrides) ===== */
.dp-scope img { display:block; border:0; }

/* ===== Design A: Mosaic Magazine Grid ===== */
.gallery-mosaic{
  --gap: 12px;
  background:#fff; border:1px solid #e8e8e8; border-radius:14px;
  box-shadow:0 6px 18px rgba(0,0,0,.08);
  padding:22px 18px 30px; margin:20px 0; text-align:center;
}
.gm-title{
  font-weight:800; font-size:22px; color:#0c1b2a; margin:0 0 14px; display:inline-block; position:relative;
}
.gm-title::after{ content:""; display:block; width:72px; height:3px; background:#e31d1d; border-radius:3px; margin:6px auto 0; }

.gm-grid{
  display:grid !important;                 /* hard override */
  grid-template-columns: repeat(6, 1fr);
  grid-auto-rows: 140px;                   /* base tile height */
  gap: var(--gap);
}
.gm-item{ position:relative; overflow:hidden; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,.06); }
.gm-item img{
  width:100% !important; height:100% !important; /* ⬅️ force fill */
  object-fit:cover !important; display:block !important;
  transition:transform .35s ease;
}
.gm-item:hover img{ transform:scale(1.06); }

/* Pattern (spans) */
.gm-item:nth-child(7n+1){ grid-column: span 3; grid-row: span 2; }
.gm-item:nth-child(7n+3){ grid-column: span 2; grid-row: span 2; }
.gm-item:nth-child(7n+5){ grid-column: span 2; }

@media (max-width:1200px){
  .gm-grid{ grid-template-columns: repeat(4, 1fr); grid-auto-rows: 130px; }
}
@media (max-width:768px){
  .gm-grid{ grid-template-columns: repeat(2, 1fr); grid-auto-rows: 120px; }
}

/* Button */
.gm-footer{ margin-top:18px; }
.gm-btn{
  display:inline-block; padding:9px 22px; border-radius:8px; font-weight:700; color:#fff; text-decoration:none;
  background:linear-gradient(135deg,#0a2b67,#e31d1d); box-shadow:0 4px 12px rgba(0,0,0,.2);
  transition:transform .15s, box-shadow .15s;
}
.gm-btn:hover{ transform:translateY(-2px); box-shadow:0 6px 18px rgba(0,0,0,.3); }

/* ===== Design B: Justified Rows ===== */
.gallery-justified{
  background:#fff;border:1px solid #e8e8e8;border-radius:14px;
  box-shadow:0 6px 18px rgba(0,0,0,.08); padding:22px 14px; margin:20px 0; text-align:center;
}
.gj-title{font-weight:800;font-size:22px;color:#0c1b2a;margin:0 0 14px;position:relative;display:inline-block;}
.gj-title::after{content:"";display:block;width:72px;height:3px;background:#0a8ddf;border-radius:3px;margin:6px auto 0;}

.gj-rows{ display:flex; flex-wrap:wrap; gap:10px; }
.gj-rows .gj-box{
  overflow:hidden;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,.06);
  transition:transform .2s ease, box-shadow .2s ease; background:#f7f7f7;
}
.gj-rows .gj-box img{ width:100% !important; height:100% !important; object-fit:cover !important; display:block; }
.gj-rows .gj-box:hover{ transform:translateY(-3px); box-shadow:0 8px 20px rgba(0,0,0,.14); }
</style>

<script>
/* ===== Design B: Justified Rows builder =====
   Places images into perfect-height rows. */
document.addEventListener('DOMContentLoaded', function(){
  const container = document.getElementById('gjRows');
  if(!container) return;

  const GAP = 10;        // must match CSS gap
  const TARGET = 180;    // target row height
  const imgs = Array.from(container.querySelectorAll('img'));

  function build(){
    // move images back to a fragment (so we can reflow on resize)
    const list = imgs.map(img => {
      // ensure we know aspect ratio
      const w = img.naturalWidth || parseInt((img.getAttribute('src')||'').split('/')[5]) || 800;
      const h = img.naturalHeight || parseInt((img.getAttribute('src')||'').split('/')[6]) || 600;
      return { img, ratio: w / h };
    });

    container.innerHTML = '';
    let row = [], ratioSum = 0;

    const flush = () => {
      if(!row.length) return;
      const W = container.clientWidth;
      const totalGap = GAP * (row.length - 1);
      // compute row height to fit container width
      const height = Math.max(120, Math.min(260, (W - totalGap) / ratioSum));
      row.forEach(({img, ratio}) => {
        const box = document.createElement('div');
        box.className = 'gj-box';
        box.style.width  = Math.round(height * ratio) + 'px';
        box.style.height = Math.round(height) + 'px';
        box.appendChild(img);
        container.appendChild(box);
      });
      row = []; ratioSum = 0;
    };

    list.forEach((r, i) => {
      row.push(r); ratioSum += r.ratio;
      const W = container.clientWidth;
      const h = (W - GAP * (row.length - 1)) / ratioSum;
      if(h <= TARGET) flush();
    });
    flush(); // last row
  }

  // If images aren’t loaded yet, wait
  let pending = imgs.length;
  imgs.forEach(img => {
    if (img.complete) { if(--pending===0) build(); }
    else img.addEventListener('load', () => { if(--pending===0) build(); });
    // fallback if some images cache-block: build anyway after a moment
    setTimeout(()=>{ if(pending>0){ pending=0; build(); } }, 1500);
  });

  // Rebuild on resize (debounced)
  let t; window.addEventListener('resize', () => {
    clearTimeout(t); t = setTimeout(build, 150);
  });
});
</script>
