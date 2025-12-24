@extends('layouts.app')

@section('content')
<style>
  .bd-wrap{ max-width: 1100px; margin: 0 auto; }
  .grid{ display:grid; gap:14px; grid-template-columns: 1fr; }
  @media (min-width: 992px){ .grid{ grid-template-columns: 380px 1fr; } }
  .pane{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; }
  .row{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .btn{ appearance:none; border:1px solid #d1d5db; padding:.5rem .8rem; border-radius:10px; cursor:pointer; font-weight:600; background:#fff; }
  .btn-primary{ background:#f59e0b; border-color:#f59e0b; color:#fff; }
  .form-control, .form-select{ border:1px solid #e5e7eb; border-radius:10px; padding:.45rem .6rem; width:100%; }
  .canvas-wrap{ text-align:center; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; background:#fff; }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Upcoming Birthday (Poster Tool)</h2>
    </div>
  </div>

  <div class="content-body bd-wrap">
    <div class="grid">
      <div class="pane">
        <div class="mb-1">
          <label>Name</label>
          <input id="name" class="form-control" placeholder="Person's name">
        </div>
        <div class="row mb-1">
          <label>Birthday</label>
          <input id="bday" type="date" class="form-control" style="max-width:200px">
          <label>Age</label>
          <input id="age" type="number" min="0" class="form-control" style="max-width:120px" placeholder="Optional">
        </div>
        <div class="mb-1">
          <label>Photo</label>
          <input id="photo" type="file" accept="image/*" class="form-control">
        </div>
        <div class="row mb-1">
          <label>Canvas</label>
          <select id="ratio" class="form-select">
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
  const cv=document.getElementById('cv'), ctx=cv.getContext('2d');
  const name=document.getElementById('name');
  const bday=document.getElementById('bday');
  const age=document.getElementById('age');
  const ratio=document.getElementById('ratio');
  const photo=document.getElementById('photo');
  const dl=document.getElementById('dl');
  let img=null;

  [name,bday,age].forEach(el=> el.addEventListener('input', draw));
  ratio.addEventListener('change', ()=>{ const [w,h]=ratio.value.split('x').map(Number); cv.width=w; cv.height=h; draw(); });
  dl.addEventListener('click', ()=>{ draw(); const a=document.createElement('a'); a.href=cv.toDataURL('image/png'); a.download='birthday.png'; a.click(); });
  photo.addEventListener('change', e=>{ const f=e.target.files && e.target.files[0]; if(!f){ img=null; draw(); return; } const r=new FileReader(); r.onload=ev=>{ const i=new Image(); i.onload=()=>{ img=i; draw(); }; i.src=ev.target.result; }; r.readAsDataURL(f); });

  function cover(i,x,y,w,h){ const ir=i.naturalWidth/i.naturalHeight, r=w/h; let dw,dh,dx,dy; if(ir>r){ dh=h; dw=h*ir; dx=x-(dw-w)/2; dy=y; } else { dw=w; dh=w/ir; dx=x; dy=y-(dh-h)/2; } ctx.drawImage(i,dx,dy,dw,dh); }
  function confetti(){ for(let i=0;i<150;i++){ ctx.fillStyle=`hsl(${Math.random()*360},80%,60%)`; const x=Math.random()*cv.width, y=Math.random()*cv.height, s=Math.random()*6+2; ctx.fillRect(x,y,s,s); } }
  function draw(){
    const W=cv.width,H=cv.height; const g=ctx.createLinearGradient(0,0,W,H); g.addColorStop(0,'#f59e0b'); g.addColorStop(1,'#f97316'); ctx.fillStyle=g; ctx.fillRect(0,0,W,H);
    if(img){ cover(img, W*0.1, H*0.18, W*0.8, H*0.5); ctx.fillStyle='rgba(0,0,0,.2)'; ctx.fillRect(W*0.1, H*0.18, W*0.8, H*0.5); }
    confetti();
    ctx.fillStyle='#fff'; ctx.textAlign='center';
    ctx.font=`900 ${Math.round(Math.max(W,H)*0.08)}px Poppins,Arial`; ctx.fillText('HAPPY BIRTHDAY', W/2, Math.round(H*0.12));
    ctx.font=`800 ${Math.round(Math.max(W,H)*0.06)}px Poppins,Arial`; ctx.fillText(name.value || 'Your Name', W/2, Math.round(H*0.76));
    ctx.font=`600 ${Math.round(Math.max(W,H)*0.04)}px Poppins,Arial`;
    const dstr = bday.value ? new Date(bday.value).toLocaleDateString() : '';
    const ages = age.value ? ` · Age ${age.value}` : '';
    if (dstr || ages){ ctx.fillText(`${dstr}${ages}`, W/2, Math.round(H*0.86)); }
  }
  draw();
})();
</script>
@endsection

