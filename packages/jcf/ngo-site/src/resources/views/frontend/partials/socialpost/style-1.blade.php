{{-- resources/views/gallery-post.blade.php --}}
{{-- If you use a layout, uncomment next lines and wrap the section content in @section --}}
{{-- @extends('layouts.app') --}}
{{-- @section('content') --}}

<section class="post-wrap">
  <article class="post-card">

    <!-- Header -->
    <header class="post-head">
      <div class="post-badge">
        <img src="https://i.imgur.com/0Z8FQZy.png" alt="NGO logo">
      </div>
      <div class="post-meta">
        <h3 class="post-title">मानवाधिकार सुरक्षा एवं संरक्षण संगठन</h3>
        <div class="post-sub">
          <span class="post-tag">ग्राम हरियाली अभियान</span>
          <span class="dot">•</span>
          <time datetime="2025-09-25T16:20">25 सितम्बर 2025 · 4:20 PM</time>
        </div>
      </div>
      <div class="post-actions">
        <button class="p-btn" aria-label="More">⋯</button>
      </div>
    </header>

    <!-- Image Collage: use g-1 … g-8 based on count -->
    <div class="post-gallery g-6">
      <a class="pg-item" href="#"><img src="https://picsum.photos/seed/p1/800/600" alt=""></a>
      <a class="pg-item" href="#"><img src="https://picsum.photos/seed/p2/800/600" alt=""></a>
      <a class="pg-item" href="#"><img src="https://picsum.photos/seed/p3/800/600" alt=""></a>
      <a class="pg-item" href="#"><img src="https://picsum.photos/seed/p4/800/600" alt=""></a>
      <a class="pg-item" href="#"><img src="https://picsum.photos/seed/p5/800/600" alt=""></a>
      <a class="pg-item" href="#"><img src="https://picsum.photos/seed/p6/800/600" alt=""></a>
    </div>

    <!-- Caption -->
    <div class="post-body">
      <p class="post-text">
        प्रकृति बचाने के लिए हर कदम महत्वपूर्ण है। हमारे हरियाली अभियान में
        प्रशासनिक सहयोग के साथ स्वयंसेवकों ने पौधारोपण किया—आइए, एक पेड़ हम भी लगाएँ 🌱
      </p>
    </div>

    <!-- Footer -->
    <footer class="post-foot">
      <div class="pf-left">
        <button class="pf-btn">👍 128</button>
        <button class="pf-btn">💬 12</button>
        <button class="pf-btn">↗️ Share</button>
      </div>
      <a class="pf-link" href="/gallery">View album</a>
    </footer>

  </article>
</section>

<style>
/* ====== Social Post Card – Scoped ====== */
.post-wrap{
  display:flex; justify-content:center; padding:18px 0;
  background:#f6f9fc;
}
.post-card{
  width:min(900px, 100%);
  background:#fff; border:1px solid #e9eef5;
  border-radius:16px; box-shadow:0 10px 24px rgba(15,23,42,.08);
  overflow:hidden;
}

/* Header */
.post-head{
  display:grid; grid-template-columns:auto 1fr auto; gap:12px;
  align-items:center; padding:14px 16px 8px;
}
.post-badge{
  width:46px; height:46px; border-radius:50%; overflow:hidden;
  display:grid; place-items:center; background:#fff;
  box-shadow:0 3px 10px rgba(15,23,42,.12);
}
.post-badge img{ width:85%; height:85%; object-fit:contain; }
.post-title{ margin:0; font-size:18px; font-weight:800; color:#0f172a; }
.post-sub{ color:#64748b; font-size:13px; display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
.post-tag{ background:#eef6ff; color:#0a66c2; font-weight:700; font-size:12px; padding:3px 8px; border-radius:999px; }
.post-actions .p-btn{ border:0; background:#f1f5f9; width:36px; height:36px; border-radius:10px; cursor:pointer; }

/* Gallery */
.post-gallery{
  display:grid;
  gap:10px;
  padding:10px 12px;
}
.pg-item{
  display:block; overflow:hidden; border-radius:12px;
  background:#f1f5f9;
  box-shadow:0 2px 10px rgba(0,0,0,.06);
}
.pg-item img{
  width:100% !important; height:100% !important; object-fit:cover !important; display:block !important;
  transition:transform .35s ease;
}
.pg-item:hover img{ transform:scale(1.05); }

/* Layout presets by count */
.post-gallery.g-1{ grid-template-columns:1fr; grid-auto-rows: 360px; }
.post-gallery.g-2{ grid-template-columns:1fr 1fr; grid-auto-rows: 260px; }
.post-gallery.g-3{ grid-template-columns:2fr 1fr; grid-auto-rows: 260px; }
.post-gallery.g-3 .pg-item:nth-child(1){ grid-row: span 2; }
.post-gallery.g-4{ grid-template-columns:repeat(2,1fr); grid-auto-rows: 220px; }
.post-gallery.g-5{ grid-template-columns:2fr 1fr; grid-auto-rows: 220px; }
.post-gallery.g-5 .pg-item:nth-child(1){ grid-row: span 2; }
.post-gallery.g-6{ grid-template-columns:repeat(3,1fr); grid-auto-rows: 190px; } /* 6 images */
.post-gallery.g-7{ grid-template-columns:repeat(3,1fr); grid-auto-rows: 180px; }
.post-gallery.g-7 .pg-item:nth-child(1){ grid-column: span 2; grid-row: span 2; }
.post-gallery.g-8{ grid-template-columns:repeat(4,1fr); grid-auto-rows: 160px; }

/* Caption */
.post-body{ padding:2px 16px 12px; }
.post-text{ margin:0; color:#334155; line-height:1.75; font-size:15px; }

/* Footer */
.post-foot{
  display:flex; align-items:center; justify-content:space-between;
  padding:12px 16px 16px; border-top:1px dashed #e5eaf1;
}
.pf-left{ display:flex; gap:10px; flex-wrap:wrap; }
.pf-btn{
  background:#f1f5f9; border:1px solid #e2e8f0; color:#0f172a;
  padding:6px 10px; border-radius:10px; font-weight:700; cursor:pointer;
}
.pf-link{ color:#0a66c2; font-weight:800; text-decoration:none; }

/* Mobile tweaks */
@media (max-width: 720px){
  .post-gallery.g-6{ grid-template-columns:repeat(2,1fr); grid-auto-rows:160px; }
  .post-gallery.g-4{ grid-auto-rows: 180px; }
  .post-gallery.g-5{ grid-template-columns:1fr 1fr; grid-auto-rows:160px; }
  .post-gallery.g-8{ grid-template-columns:repeat(2,1fr); grid-auto-rows:140px; }
}
</style>

{{-- Optional: super-simple lightbox (click any image to enlarge) --}}
<script>
document.addEventListener('click', function(e){
  const img = e.target.closest('.pg-item img');
  if(!img) return;
  const o = document.createElement('div');
  o.style.cssText='position:fixed;inset:0;background:rgba(0,0,0,.9);display:flex;align-items:center;justify-content:center;z-index:99999';
  const c = document.createElement('img');
  c.src = img.src;
  c.style.cssText='max-width:92%;max-height:92%;border-radius:10px;box-shadow:0 0 40px rgba(0,0,0,.8)';
  o.appendChild(c);
  o.addEventListener('click', ()=> o.remove());
  document.body.appendChild(o);
});
</script>

{{-- @endsection --}}
