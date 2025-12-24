@extends('layouts.app')

@section('content')
<style>
  .vol-wrap{ max-width: 1100px; margin: 0 auto; }
  .grid{ display:grid; gap:14px; grid-template-columns: 1fr; }
  @media (min-width: 992px){ .grid{ grid-template-columns: 380px 1fr; } }
  .pane{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; }
  .row{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .btn{ appearance:none; border:1px solid #d1d5db; padding:.5rem .8rem; border-radius:10px; cursor:pointer; font-weight:600; background:#fff; }
  .btn-primary{ background:#2563eb; border-color:#2563eb; color:#fff; }
  .form-control, .form-select{ border:1px solid #e5e7eb; border-radius:10px; padding:.45rem .6rem; width:100%; }
  .canvas-wrap{ text-align:center; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; background:#fff; }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Volunteer Recruitment Poster</h2>
    </div>
  </div>

  <div class="content-body vol-wrap">
    <div class="grid">
      <div class="pane">
        <div class="mb-1">
          <label>Title</label>
          <input id="title" class="form-control" placeholder="Join as Volunteer!">
        </div>
        <div class="mb-1">
          <label>Message</label>
          <textarea id="msg" class="form-control" rows="3" placeholder="Short message / benefits"></textarea>
        </div>
        <div class="mb-1">
          <label>Contact</label>
          <input id="contact" class="form-control" placeholder="Phone / Email / URL">
        </div>
        <div class="mb-1">
          <label>Photo (optional)</label>
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
  const title=document.getElementById('title');
  const msg=document.getElementById('msg');
  const contact=document.getElementById('contact');
  const ratio=document.getElementById('ratio');
  const photo=document.getElementById('photo');
  const dl=document.getElementById('dl');
  let img=null;

  [title,msg,contact].forEach(el=> el.addEventListener('input', draw));
  ratio.addEventListener('change', ()=>{ const [w,h]=ratio.value.split('x').map(Number); cv.width=w; cv.height=h; draw(); });
  dl.addEventListener('click', ()=>{ draw(); const a=document.createElement('a'); a.href=cv.toDataURL('image/png'); a.download='volunteer.png'; a.click(); });
  photo.addEventListener('change', e=>{ const f=e.target.files && e.target.files[0]; if(!f){ img=null; draw(); return; } const r=new FileReader(); r.onload=ev=>{ const i=new Image(); i.onload=()=>{ img=i; draw(); }; i.src=ev.target.result; }; r.readAsDataURL(f); });

  function cover(i,x,y,w,h){ const ir=i.naturalWidth/i.naturalHeight, r=w/h; let dw,dh,dx,dy; if(ir>r){ dh=h; dw=h*ir; dx=x-(dw-w)/2; dy=y; } else { dw=w; dh=w/ir; dx=x; dy=y-(dh-h)/2; } ctx.drawImage(i,dx,dy,dw,dh); }
  function draw(){
    const W=cv.width,H=cv.height; const g=ctx.createLinearGradient(0,0,W,H); g.addColorStop(0,'#2563eb'); g.addColorStop(1,'#06b6d4'); ctx.fillStyle=g; ctx.fillRect(0,0,W,H);
    if(img){ cover(img, W*0.08, H*0.2, W*0.84, H*0.45); ctx.fillStyle='rgba(0,0,0,.22)'; ctx.fillRect(W*0.08, H*0.2, W*0.84, H*0.45); }
    ctx.fillStyle='#fff'; ctx.textAlign='center';
    ctx.font=`900 ${Math.round(Math.max(W,H)*0.075)}px Poppins,Arial`; ctx.fillText(title.value || 'Join as Volunteer!', W/2, Math.round(H*0.15));
    ctx.font=`600 ${Math.round(Math.max(W,H)*0.04)}px Poppins,Arial`; drawParagraph(msg.value || 'Make a difference with us. Help in events, outreach, and community service.', W/2, Math.round(H*0.72), Math.round(W*0.84), Math.round(Math.max(W,H)*0.055));
    ctx.font=`800 ${Math.round(Math.max(W,H)*0.045)}px Poppins,Arial`; ctx.fillText(contact.value || 'Contact: +91-XXXXXXXXXX', W/2, Math.round(H*0.9));
  }
  function drawParagraph(text, cx, y, maxWidth, lh){ ctx.textBaseline='top'; ctx.textAlign='center'; const words=(text||'').split(/\s+/); let line='', yy=y; for(let n=0;n<words.length;n++){ const test=line+words[n]+' '; if(ctx.measureText(test).width>maxWidth && n>0){ ctx.fillText(line, cx, yy); line=words[n]+' '; yy+=lh; } else { line=test; } } ctx.fillText(line.trim(), cx, yy); }
  draw();
})();
</script>
@endsection

