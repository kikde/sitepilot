@extends('layouts.app')

@section('content')
<style>
  .dp-wrap{ max-width: 1100px; margin: 0 auto; }
  .grid{ display:grid; gap:14px; grid-template-columns: 1fr; }
  @media (min-width: 992px){ .grid{ grid-template-columns: 380px 1fr; } }
  .pane{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; }
  .row{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .btn{ appearance:none; border:1px solid #d1d5db; padding:.5rem .8rem; border-radius:10px; cursor:pointer; font-weight:600; background:#fff; }
  .btn-primary{ background:#22c55e; border-color:#22c55e; color:#fff; }
  .form-control, .form-select{ border:1px solid #e5e7eb; border-radius:10px; padding:.45rem .6rem; width:100%; }
  .color{ width:44px; height:36px; border-radius:8px; border:1px solid #e5e7eb; }
  .canvas-wrap{ text-align:center; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; background:#fff; }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Daily Poster</h2>
    </div>
  </div>

  <div class="content-body dp-wrap">
    <div class="grid">
      <div class="pane">
        <div class="mb-1">
          <label>Title</label>
          <input id="title" class="form-control" placeholder="e.g. Good Morning, Join Our Drive, ...">
        </div>
        <div class="mb-1">
          <label>Message</label>
          <textarea id="msg" class="form-control" rows="3" placeholder="Short message"></textarea>
        </div>
        <div class="row mb-1">
          <label>Date</label>
          <input id="date" type="date" class="form-control" style="max-width:200px">
          <label>Canvas</label>
          <select id="ratio" class="form-select">
            <option value="1080x1080">Square 1080×1080</option>
            <option value="1920x1080">Landscape 1920×1080</option>
            <option value="1080x1920">Portrait 1080×1920</option>
          </select>
        </div>
        <div class="row mb-1">
          <label>BG Gradient</label>
          <input id="c1" type="color" class="color" value="#0ea5e9">
          <input id="c2" type="color" class="color" value="#22c55e">
          <label>Text Color <input id="tcolor" type="color" class="color" value="#ffffff"></label>
        </div>
        <div class="row mb-1">
          <label>Photo (optional)</label>
          <input id="photo" type="file" accept="image/*" class="form-control">
        </div>
        <div class="row mb-1">
          <button id="dl" class="btn btn-primary">Download</button>
        </div>
      </div>
      <div class="pane canvas-wrap">
        <canvas id="cv" width="1080" height="1080"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const cv=document.getElementById('cv'); const ctx=cv.getContext('2d');
  const title=document.getElementById('title');
  const msg=document.getElementById('msg');
  const date=document.getElementById('date');
  const ratio=document.getElementById('ratio');
  const c1=document.getElementById('c1');
  const c2=document.getElementById('c2');
  const tcolor=document.getElementById('tcolor');
  const photo=document.getElementById('photo');
  const dl=document.getElementById('dl');
  let img=null;

  [title,msg,date,c1,c2,tcolor].forEach(el=> el.addEventListener('input', draw));
  ratio.addEventListener('change', ()=>{ const [w,h]=ratio.value.split('x').map(Number); cv.width=w; cv.height=h; draw(); });
  dl.addEventListener('click', ()=>{ draw(); const a=document.createElement('a'); a.href=cv.toDataURL('image/png'); a.download='daily-poster.png'; a.click(); });
  photo.addEventListener('change', e=>{ const f=e.target.files && e.target.files[0]; if(!f){ img=null; draw(); return; } const r=new FileReader(); r.onload=ev=>{ const i=new Image(); i.onload=()=>{ img=i; draw(); }; i.src=ev.target.result; }; r.readAsDataURL(f); });

  function cover(i,x,y,w,h){ const ir=i.naturalWidth/i.naturalHeight, r=w/h; let dw,dh,dx,dy; if(ir>r){ dh=h; dw=h*ir; dx=x-(dw-w)/2; dy=y; } else { dw=w; dh=w/ir; dx=x; dy=y-(dh-h)/2; } ctx.drawImage(i,dx,dy,dw,dh); }
  function draw(){
    const W=cv.width,H=cv.height; const g=ctx.createLinearGradient(0,0,W,H); g.addColorStop(0,c1.value); g.addColorStop(1,c2.value); ctx.fillStyle=g; ctx.fillRect(0,0,W,H);
    if(img){ cover(img,0,0,W,H); ctx.fillStyle='rgba(0,0,0,.25)'; ctx.fillRect(0,0,W,H); }
    ctx.fillStyle=tcolor.value; ctx.textAlign='center';
    // title
    ctx.font=`900 ${Math.round(Math.max(W,H)*0.07)}px Poppins,Arial`; ctx.fillText(title.value || 'Daily Poster', W/2, Math.round(H*0.22));
    // message (multiline)
    ctx.font=`600 ${Math.round(Math.max(W,H)*0.035)}px Poppins,Arial`; drawParagraph(msg.value || 'Write a short message here...', W/2, Math.round(H*0.32), Math.round(W*0.8), Math.round(Math.max(W,H)*0.05));
    // date pill
    const dstr = date.value ? new Date(date.value).toLocaleDateString() : new Date().toLocaleDateString();
    const pillW = Math.round(W*0.38), pillH = Math.round(Math.max(W,H)*0.06), x=(W-pillW)/2, y=Math.round(H*0.82);
    ctx.fillStyle='rgba(255,255,255,.15)'; roundRect(ctx, x, y, pillW, pillH, 16); ctx.fill();
    ctx.fillStyle=tcolor.value; ctx.font=`700 ${Math.round(pillH*0.5)}px Poppins,Arial`; ctx.textBaseline='middle'; ctx.fillText(dstr, W/2, y+pillH/2);
  }
  function drawParagraph(text, cx, y, maxWidth, lh){ ctx.textBaseline='top'; ctx.textAlign='center'; const words=(text||'').split(/\s+/); let line='', yy=y; for(let n=0;n<words.length;n++){ const test=line+words[n]+' '; if(ctx.measureText(test).width>maxWidth && n>0){ ctx.fillText(line, cx, yy); line=words[n]+' '; yy+=lh; } else { line=test; } } ctx.fillText(line.trim(), cx, yy); }
  function roundRect(ctx, x, y, w, h, r){ ctx.beginPath(); ctx.moveTo(x+r,y); ctx.arcTo(x+w,y,x+w,y+h,r); ctx.arcTo(x+w,y+h,x,y+h,r); ctx.arcTo(x,y+h,x,y,r); ctx.arcTo(x,y,x+w,y,r); ctx.closePath(); }

  draw();
})();
</script>
@endsection

