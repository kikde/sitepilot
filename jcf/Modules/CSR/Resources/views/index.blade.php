@extends('layouts.app')

@section('content')
<style>
  .csr-wrap{ max-width: 1100px; margin: 0 auto; }
  .grid{ display:grid; gap:14px; grid-template-columns: 1fr; }
  @media (min-width: 992px){ .grid{ grid-template-columns: 380px 1fr; } }
  .pane{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; }
  .row{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .btn{ appearance:none; border:1px solid #d1d5db; padding:.5rem .8rem; border-radius:10px; cursor:pointer; font-weight:600; background:#fff; }
  .btn-primary{ background:#10b981; border-color:#10b981; color:#fff; }
  .form-control, .form-select{ border:1px solid #e5e7eb; border-radius:10px; padding:.45rem .6rem; width:100%; }
  .color{ width:44px; height:36px; border-radius:8px; border:1px solid #e5e7eb; }
  .canvas-wrap{ text-align:center; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; background:#fff; }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">CSR Certificate / Poster</h2>
    </div>
  </div>

  <div class="content-body csr-wrap">
    <div class="grid">
      <div class="pane">
        <div class="mb-1">
          <label>Company / Donor</label>
          <input id="company" class="form-control" placeholder="Company / Donor name">
        </div>
        <div class="mb-1">
          <label>Purpose</label>
          <input id="purpose" class="form-control" placeholder="e.g. Education Support, Health Camp...">
        </div>
        <div class="row mb-1">
          <label>Amount (INR)</label>
          <input id="amount" type="number" class="form-control" style="max-width:200px" placeholder="50000">
          <label>Date</label>
          <input id="date" type="date" class="form-control" style="max-width:200px">
        </div>
        <div class="mb-1">
          <label>Logo (optional)</label>
          <input id="logoFile" type="file" accept="image/*" class="form-control">
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
  const company=document.getElementById('company');
  const purpose=document.getElementById('purpose');
  const amount=document.getElementById('amount');
  const date=document.getElementById('date');
  const ratio=document.getElementById('ratio');
  const logoFile=document.getElementById('logoFile');
  const dl=document.getElementById('dl');
  let logo=null;

  [company,purpose,amount,date].forEach(el=> el.addEventListener('input', draw));
  ratio.addEventListener('change', ()=>{ const [w,h]=ratio.value.split('x').map(Number); cv.width=w; cv.height=h; draw(); });
  dl.addEventListener('click', ()=>{ draw(); const a=document.createElement('a'); a.href=cv.toDataURL('image/png'); a.download='csr.png'; a.click(); });
  logoFile.addEventListener('change', e=>{ const f=e.target.files && e.target.files[0]; if(!f){ logo=null; draw(); return; } const r=new FileReader(); r.onload=ev=>{ const i=new Image(); i.onload=()=>{ logo=i; draw(); }; i.src=ev.target.result; }; r.readAsDataURL(f); });

  function draw(){
    const W=cv.width,H=cv.height; ctx.clearRect(0,0,W,H); // background
    const g=ctx.createLinearGradient(0,0,W,H); g.addColorStop(0,'#14b8a6'); g.addColorStop(1,'#0ea5e9'); ctx.fillStyle=g; ctx.fillRect(0,0,W,H);

    // card
    const pad=Math.round(Math.max(W,H)*0.06); const cardR=18; ctx.fillStyle='rgba(255,255,255,.95)'; roundRect(ctx,pad,pad,W-2*pad,H-2*pad,cardR); ctx.fill();

    // heading
    ctx.fillStyle='#0f172a'; ctx.textAlign='center'; ctx.font=`900 ${Math.round(Math.max(W,H)*0.06)}px Poppins,Arial`; ctx.fillText('CSR CONTRIBUTION', W/2, pad*1.3);

    // logo
    if(logo){ const s= Math.min(W,H)*0.18; const ratio = logo.naturalWidth/logo.naturalHeight; const lw=Math.min(s, s*ratio), lh=lw/ratio; ctx.drawImage(logo, pad*1.3, pad*1.2, lw, lh); }

    // details
    ctx.textAlign='left'; ctx.font=`700 ${Math.round(Math.max(W,H)*0.045)}px Poppins,Arial`; ctx.fillText(company.value || 'Company / Donor', pad*1.3, Math.round(H*0.45));
    ctx.font=`600 ${Math.round(Math.max(W,H)*0.035)}px Poppins,Arial`; ctx.fillText('Purpose: ' + (purpose.value || '—'), pad*1.3, Math.round(H*0.54));
    const amt = amount.value ? new Intl.NumberFormat('en-IN').format(parseInt(amount.value,10)) : '—';
    ctx.fillText('Amount: ₹ ' + amt, pad*1.3, Math.round(H*0.62));
    const d = date.value ? new Date(date.value).toLocaleDateString() : new Date().toLocaleDateString();
    ctx.fillText('Date: ' + d, pad*1.3, Math.round(H*0.69));

    // footer
    ctx.textAlign='center'; ctx.font=`800 ${Math.round(Math.max(W,H)*0.04)}px Poppins,Arial`; ctx.fillStyle='#0f172a'; ctx.fillText('Thank you for supporting our cause.', W/2, Math.round(H*0.85));
  }

  function roundRect(ctx, x, y, w, h, r){ ctx.beginPath(); ctx.moveTo(x+r,y); ctx.arcTo(x+w,y,x+w,y+h,r); ctx.arcTo(x+w,y+h,x,y+h,r); ctx.arcTo(x,y+h,x,y,r); ctx.arcTo(x,y,x+w,y,r); ctx.closePath(); }
  draw();
})();
</script>
@endsection

