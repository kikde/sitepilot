@extends('layouts.app')

@section('content')
<style>
  .brand-wrap{ max-width: 1100px; margin: 0 auto; }
  .grid{ display:grid; gap:14px; grid-template-columns: 1fr; }
  @media (min-width: 992px){ .grid{ grid-template-columns: 380px 1fr; } }
  .pane{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; }
  .row{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .btn{ appearance:none; border:1px solid #d1d5db; padding:.5rem .8rem; border-radius:10px; cursor:pointer; font-weight:600; background:#fff; }
  .btn-primary{ background:#6366f1; border-color:#6366f1; color:#fff; }
  .form-control, .form-select{ border:1px solid #e5e7eb; border-radius:10px; padding:.45rem .6rem; width:100%; }
  .color{ width:44px; height:36px; border-radius:8px; border:1px solid #e5e7eb; }
  .canvas-wrap{ text-align:center; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; background:#fff; }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Branding Tool</h2>
    </div>
  </div>

  <div class="content-body brand-wrap">
    <div class="grid">
      <div class="pane">
        <div class="mb-1">
          <label>Base Image</label>
          <input id="baseFile" type="file" accept="image/*" class="form-control">
        </div>
        <div class="mb-1">
          <label>Logo Image</label>
          <input id="logoFile" type="file" accept="image/*" class="form-control">
        </div>
        <div class="row mb-1">
          <label>Logo Position</label>
          <select id="pos" class="form-select">
            <option value="br">Bottom Right</option>
            <option value="bl">Bottom Left</option>
            <option value="tr">Top Right</option>
            <option value="tl">Top Left</option>
            <option value="ct">Center</option>
          </select>
          <label>Logo Scale</label>
          <input id="scale" type="range" min="5" max="50" value="18">
        </div>
        <div class="mb-1">
          <label>Brand Text</label>
          <input id="text" class="form-control" placeholder="e.g. Utsah Foundation">
        </div>
        <div class="row mb-1">
          <label>Text Color <input type="color" id="textColor" class="color" value="#ffffff"></label>
          <label>Shadow <input type="checkbox" id="shadow" checked></label>
        </div>
        <div class="row mb-1">
          <label>Canvas</label>
          <select id="ratio" class="form-select">
            <option value="auto">Auto (from image)</option>
            <option value="1080x1080">Square 1080×1080</option>
            <option value="1920x1080">Landscape 1920×1080</option>
            <option value="1080x1920">Portrait 1080×1920</option>
          </select>
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
  const cv = document.getElementById('cv');
  const ctx= cv.getContext('2d');
  const baseFile = document.getElementById('baseFile');
  const logoFile = document.getElementById('logoFile');
  const pos = document.getElementById('pos');
  const scale = document.getElementById('scale');
  const text = document.getElementById('text');
  const textColor = document.getElementById('textColor');
  const shadow = document.getElementById('shadow');
  const ratio = document.getElementById('ratio');
  const dl = document.getElementById('dl');
  let base=null, logo=null;

  baseFile.addEventListener('change', e=> loadImg(e.target.files[0]).then(i=>{ base=i; resizeFromRatio(); draw(); }));
  logoFile.addEventListener('change', e=> loadImg(e.target.files[0]).then(i=>{ logo=i; draw(); }));
  [pos, scale, text, textColor, shadow].forEach(el=> el.addEventListener('input', draw));
  ratio.addEventListener('change', ()=>{ resizeFromRatio(); draw(); });
  dl.addEventListener('click', ()=>{ draw(); const a=document.createElement('a'); a.href=cv.toDataURL('image/png'); a.download='branding.png'; a.click(); });

  function loadImg(file){ return new Promise(res=>{ if(!file){ res(null); return; } const r=new FileReader(); r.onload=ev=>{ const i=new Image(); i.onload=()=>res(i); i.src=ev.target.result; }; r.readAsDataURL(file); }); }
  function resizeFromRatio(){ if(!base) return; const v=ratio.value; if(v==='auto'){ cv.width=base.naturalWidth; cv.height=base.naturalHeight; } else { const [w,h]=v.split('x').map(Number); cv.width=w; cv.height=h; } }
  function cover(img,x,y,w,h){ const ir=img.naturalWidth/img.naturalHeight, r=w/h; let dw,dh,dx,dy; if(ir>r){ dh=h; dw=h*ir; dx=x-(dw-w)/2; dy=y; } else { dw=w; dh=w/ir; dx=x; dy=y-(dh-h)/2; } ctx.drawImage(img,dx,dy,dw,dh); }

  function draw(){
    const W=cv.width,H=cv.height; ctx.clearRect(0,0,W,H); ctx.fillStyle='#fff'; ctx.fillRect(0,0,W,H);
    if(base) cover(base,0,0,W,H);
    // draw logo
    if(logo){ const s=(+scale.value)/100; const targetW = Math.round(W*s); const ratio = logo.naturalWidth/logo.naturalHeight; const targetH = Math.round(targetW/ratio); let x=0,y=0, m=24; const p=pos.value; if(p==='br'){ x=W-targetW-m; y=H-targetH-m; } else if(p==='bl'){ x=m; y=H-targetH-m; } else if(p==='tr'){ x=W-targetW-m; y=m; } else if(p==='tl'){ x=m; y=m; } else { x=(W-targetW)/2; y=(H-targetH)/2; } ctx.drawImage(logo,x,y,targetW,targetH); }
    // draw text
    if(text.value){ ctx.save(); ctx.fillStyle=textColor.value; ctx.font=`700 ${Math.round(Math.max(W,H)*0.04)}px Poppins,Arial`; ctx.textAlign='right'; ctx.textBaseline='bottom'; if(shadow.checked){ ctx.shadowColor='rgba(0,0,0,.4)'; ctx.shadowBlur=6; ctx.shadowOffsetX=2; ctx.shadowOffsetY=2; } ctx.fillText(text.value, W-24, H-24); ctx.restore(); }
  }
  // initial
  draw();
})();
</script>
@endsection

