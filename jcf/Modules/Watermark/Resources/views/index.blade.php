@extends('layouts.app')

@section('content')
<style>
  .wm-wrap{ max-width: 1100px; margin: 0 auto; }
  .grid{ display:grid; gap:14px; grid-template-columns: 1fr; }
  @media (min-width: 992px){ .grid{ grid-template-columns: 380px 1fr; } }
  .pane{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; }
  .row{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .btn{ appearance:none; border:1px solid #d1d5db; padding:.5rem .8rem; border-radius:10px; cursor:pointer; font-weight:600; background:#fff; }
  .btn-primary{ background:#0ea5e9; border-color:#0ea5e9; color:#fff; }
  .form-control, .form-select{ border:1px solid #e5e7eb; border-radius:10px; padding:.45rem .6rem; width:100%; }
  .color{ width:44px; height:36px; border-radius:8px; border:1px solid #e5e7eb; }
  .canvas-wrap{ text-align:center; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; background:#fff; }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Watermark Tool</h2>
    </div>
  </div>

  <div class="content-body wm-wrap">
    <div class="grid">
      <div class="pane">
        <div class="mb-1">
          <label>Image</label>
          <input id="imgFile" type="file" accept="image/*" class="form-control">
        </div>
        <div class="mb-1">
          <label>Watermark Text</label>
          <input id="wmText" class="form-control" placeholder="Type watermark text">
        </div>
        <div class="row mb-1">
          <label>Opacity <input id="opacity" type="range" min="10" max="100" value="25"></label>
          <label>Font Size <input id="fontSize" type="range" min="12" max="120" value="42"></label>
          <label>Color <input id="color" type="color" class="color" value="#ffffff"></label>
        </div>
        <div class="row mb-1">
          <label><input type="radio" name="mode" value="single" checked> Single</label>
          <label><input type="radio" name="mode" value="tile"> Tile</label>
          <label>Angle <input id="angle" type="range" min="-90" max="90" value="-30"></label>
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
  const cv=document.getElementById('cv'); const ctx=cv.getContext('2d');
  const imgFile=document.getElementById('imgFile');
  const wmText=document.getElementById('wmText');
  const opacity=document.getElementById('opacity');
  const fontSize=document.getElementById('fontSize');
  const color=document.getElementById('color');
  const angle=document.getElementById('angle');
  const ratio=document.getElementById('ratio');
  const dl=document.getElementById('dl');
  let img=null, mode='single';

  document.querySelectorAll('input[name="mode"]').forEach(r=> r.addEventListener('change',()=>{ mode=r.value; draw(); }));
  [wmText, opacity, fontSize, color, angle].forEach(el=> el.addEventListener('input', draw));
  ratio.addEventListener('change', ()=>{ resizeFromRatio(); draw(); });
  dl.addEventListener('click', ()=>{ draw(); const a=document.createElement('a'); a.href=cv.toDataURL('image/png'); a.download='watermark.png'; a.click(); });

  imgFile.addEventListener('change', e=> loadImg(e.target.files[0]).then(i=>{ img=i; resizeFromRatio(); draw(); }));
  function loadImg(file){ return new Promise(res=>{ if(!file){ res(null); return; } const r=new FileReader(); r.onload=ev=>{ const i=new Image(); i.onload=()=>res(i); i.src=ev.target.result; }; r.readAsDataURL(file); }); }
  function resizeFromRatio(){ if(!img) return; const v=ratio.value; if(v==='auto'){ cv.width=img.naturalWidth; cv.height=img.naturalHeight; } else { const [w,h]=v.split('x').map(Number); cv.width=w; cv.height=h; } }
  function cover(i,x,y,w,h){ const ir=i.naturalWidth/i.naturalHeight, r=w/h; let dw,dh,dx,dy; if(ir>r){ dh=h; dw=h*ir; dx=x-(dw-w)/2; dy=y; } else { dw=w; dh=w/ir; dx=x; dy=y-(dh-h)/2; } ctx.drawImage(i,dx,dy,dw,dh); }

  function draw(){
    const W=cv.width,H=cv.height; ctx.clearRect(0,0,W,H); ctx.fillStyle='#fff'; ctx.fillRect(0,0,W,H); if(img) cover(img,0,0,W,H);
    if(!wmText.value) return;
    ctx.save();
    ctx.fillStyle=color.value; ctx.globalAlpha=(+opacity.value)/100; ctx.font=`700 ${+fontSize.value}px Poppins,Arial`; ctx.textAlign='center'; ctx.textBaseline='middle';
    ctx.translate(W/2,H/2); ctx.rotate((+angle.value)*Math.PI/180);
    if(mode==='single'){
      ctx.fillText(wmText.value, 0, 0);
    } else {
      const step=Math.max(+fontSize.value*4, 200);
      for(let y=-H; y<=H; y+=step){
        for(let x=-W; x<=W; x+=step){ ctx.fillText(wmText.value, x, y); }
      }
    }
    ctx.restore();
  }
  draw();
})();
</script>
@endsection

