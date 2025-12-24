@extends('layouts.app')

@section('content')
<style>
  .collage-wrap{ max-width: 1100px; margin: 0 auto; }
  .controls{ display: grid; gap: 12px; grid-template-columns: 1fr; }
  .pane{ background: #fff; border:1px solid #e5e7eb; border-radius: 12px; padding: 14px; }
  .thumbs{ display:flex; flex-wrap:wrap; gap:8px; }
  .thumb{ width:84px; height:84px; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; position:relative; cursor:grab; background:#f8fafc; }
  .thumb img{ width:100%; height:100%; object-fit:cover; }
  .thumb .del{ position:absolute; right:4px; top:4px; background:#ef4444; color:#fff; border:none; border-radius:8px; padding:2px 6px; font-size:12px; cursor:pointer; }
  .row{ display:flex; flex-wrap:wrap; gap:12px; align-items:center; }
  .row > * { flex: 0 0 auto; }
  .canvas-wrap{ background:#fff; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; text-align:center; }
  .btn{ appearance:none; border:1px solid #e5e7eb; background:#fff; color:#111827; padding:.5rem .9rem; border-radius:10px; font-weight:600; cursor:pointer; }
  .btn-primary{ border-color:#6366f1; color:#fff; background:#6366f1; }
  .btn-ghost{ background:#f6f7fb; }
  .layout{ display:flex; flex-wrap:wrap; gap:8px; }
  .layout label{ border:1px solid #e5e7eb; border-radius:10px; padding:6px 10px; cursor:pointer; }
  .layout input{ margin-right:6px; }
  @media (min-width: 900px){ .controls{ grid-template-columns: 380px 1fr; } }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Collage Maker</h2>
    </div>
  </div>

  <div class="content-body collage-wrap">
    <div class="controls">
      <div class="pane">
        <div class="row">
          <input id="files" type="file" accept="image/*" multiple class="btn" />
          <button id="clear" class="btn">Clear</button>
        </div>
        <div class="row" style="margin-top:10px">
          <div class="layout">
            <label><input type="radio" name="layout" value="2x2" checked> 2×2</label>
            <label><input type="radio" name="layout" value="3x3"> 3×3</label>
            <label><input type="radio" name="layout" value="1plus3"> 1 + 3</label>
            <label><input type="radio" name="layout" value="hstrip"> H‑Strip</label>
            <label><input type="radio" name="layout" value="vstrip"> V‑Strip</label>
          </div>
        </div>
        <div class="row" style="margin-top:8px">
          <label>Canvas Size:
            <select id="size" class="btn">
              <option value="1200">Square 1200×1200</option>
              <option value="1600">Square 1600×1600</option>
              <option value="1920">Square 1920×1920</option>
            </select>
          </label>
          <button id="download" class="btn btn-primary">Download Collage</button>
        </div>
        <p class="text-muted" style="margin-top:8px">Tip: Drag thumbnails to reorder. Delete with ×.</p>
        <div id="thumbs" class="thumbs" aria-live="polite"></div>
      </div>
      <div class="pane canvas-wrap">
        <canvas id="canvas" width="1200" height="1200"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const fileInput = document.getElementById('files');
  const thumbs    = document.getElementById('thumbs');
  const canvas    = document.getElementById('canvas');
  const ctx       = canvas.getContext('2d');
  const sizeSel   = document.getElementById('size');
  const clearBtn  = document.getElementById('clear');
  const dlBtn     = document.getElementById('download');
  let layout      = '2x2';
  let items       = [];

  document.querySelectorAll('input[name="layout"]').forEach(r => {
    r.addEventListener('change', () => { layout = r.value; draw(); });
  });
  sizeSel.addEventListener('change', () => { const s=+sizeSel.value; canvas.width=s; canvas.height=s; draw(); });
  clearBtn.addEventListener('click', () => { items=[]; thumbs.innerHTML=''; draw(); });
  dlBtn.addEventListener('click', () => {
    draw();
    const url = canvas.toDataURL('image/png');
    const a = document.createElement('a');
    a.href = url; a.download = 'collage.png'; a.click();
  });

  fileInput.addEventListener('change', async (e) => {
    const files = Array.from(e.target.files || []);
    for (const f of files){ await addFile(f); }
    draw();
  });

  async function addFile(file){
    return new Promise((resolve) => {
      const reader = new FileReader();
      reader.onload = ev => {
        const img = new Image();
        img.onload = () => { items.push({img, src:ev.target.result, w:img.naturalWidth, h:img.naturalHeight}); addThumb(items.length-1); resolve(); };
        img.src = ev.target.result;
      };
      reader.readAsDataURL(file);
    });
  }

  function addThumb(i){
    const t = document.createElement('div'); t.className='thumb'; t.draggable=true; t.dataset.index=i;
    const im = document.createElement('img'); im.src = items[i].src; t.appendChild(im);
    const del = document.createElement('button'); del.className='del'; del.textContent='×';
    del.addEventListener('click', (ev)=>{ ev.stopPropagation(); const idx=[...thumbs.children].indexOf(t); if(idx>=0){ items.splice(idx,1); thumbs.removeChild(t); refreshThumbs(); draw(); }});
    t.appendChild(del);
    t.addEventListener('dragstart', (e)=>{ e.dataTransfer.setData('text/plain', [...thumbs.children].indexOf(t)); });
    t.addEventListener('dragover', (e)=>{ e.preventDefault(); t.style.outline='2px dashed #6366f1'; });
    t.addEventListener('dragleave', ()=>{ t.style.outline='none'; });
    t.addEventListener('drop', (e)=>{ e.preventDefault(); t.style.outline='none'; const from = +e.dataTransfer.getData('text/plain'); const to=[...thumbs.children].indexOf(t); if(from===to) return; const it = items.splice(from,1)[0]; items.splice(to,0,it); refreshThumbs(); draw(); });
    thumbs.appendChild(t);
  }

  function refreshThumbs(){
    thumbs.innerHTML='';
    items.forEach((_,i)=> addThumb(i));
  }

  function coverDraw(img, x, y, w, h){
    const ir = img.naturalWidth / img.naturalHeight;
    const r  = w / h;
    let dw, dh, dx, dy;
    if (ir > r){
      dh = h; dw = h * ir; dx = x - (dw - w)/2; dy = y;
    } else {
      dw = w; dh = w / ir; dx = x; dy = y - (dh - h)/2;
    }
    ctx.drawImage(img, dx, dy, dw, dh);
  }

  function draw(){
    const W = canvas.width, H = canvas.height;
    ctx.fillStyle = '#ffffff'; ctx.fillRect(0,0,W,H);
    const n = items.length;
    if (!n) return;

    if (layout === '2x2'){
      const cols=2, rows=2; const cw=W/cols, ch=H/rows;
      for (let i=0;i<Math.min(n,4);i++){
        const c = i % cols, r = Math.floor(i/cols);
        coverDraw(items[i].img, c*cw, r*ch, cw, ch);
      }
    } else if (layout === '3x3'){
      const cols=3, rows=3; const cw=W/cols, ch=H/rows; const lim = Math.min(n,9);
      for (let i=0;i<lim;i++){
        const c = i % cols, r = Math.floor(i/cols);
        coverDraw(items[i].img, c*cw, r*ch, cw, ch);
      }
    } else if (layout === '1plus3'){
      const leftW = W*0.6; coverDraw(items[0].img, 0, 0, leftW, H);
      const rightW = W-leftW, ch = H/3;
      for (let i=1;i<Math.min(n,4);i++){
        coverDraw(items[i].img, leftW, (i-1)*ch, rightW, ch);
      }
    } else if (layout === 'hstrip'){
      const ch = H; const cw = W / n;
      for (let i=0;i<n;i++){ coverDraw(items[i].img, i*cw, 0, cw, ch); }
    } else if (layout === 'vstrip'){
      const cw = W; const ch = H / n;
      for (let i=0;i<n;i++){ coverDraw(items[i].img, 0, i*ch, cw, ch); }
    }
  }
})();
</script>
@endsection

