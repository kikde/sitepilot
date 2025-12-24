@extends('layouts.app')

@section('content')
<style>
  .bn-wrap{ max-width: 1100px; margin: 0 auto; }
  .grid{ display:grid; gap:14px; grid-template-columns: 1fr; }
  @media (min-width: 992px){ .grid{ grid-template-columns: 380px 1fr; } }
  .pane{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; }
  .row{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
  .btn{ appearance:none; border:1px solid #d1d5db; padding:.5rem .8rem; border-radius:10px; cursor:pointer; font-weight:600; background:#fff; }
  .btn-primary{ background:#ef4444; border-color:#ef4444; color:#fff; }
  .form-control, .form-select{ border:1px solid #e5e7eb; border-radius:10px; padding:.45rem .6rem; width:100%; }
  .color{ width:44px; height:36px; border-radius:8px; border:1px solid #e5e7eb; }
  .canvas-wrap{ text-align:center; border:1px dashed #e5e7eb; border-radius:12px; padding:12px; background:#fff; }
  .muted{ color:#6b7280; font-size:.9rem; }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Breaking News Maker</h2>
    </div>
  </div>

  <div class="content-body bn-wrap">
    <div class="grid">
      <div class="pane">
        <div class="mb-1">
          <label class="form-label">Headline</label>
          <input id="headline" class="form-control" placeholder="Type headline">
        </div>
        <div class="mb-1">
          <label class="form-label">Subheadline</label>
          <input id="sub" class="form-control" placeholder="Optional sub headline">
        </div>
        <div class="mb-1">
          <label class="form-label">Ticker / Strapline</label>
          <input id="ticker" class="form-control" placeholder="Optional ticker at bottom">
        </div>
        <!-- Custom features: time, breaking label, toggles, colors, watermark -->
        <div class="row mb-1">
          <div style="flex:1 1 120px">
            <label class="form-label">Time</label>
            <input id="timeText" class="form-control" placeholder="HH:MM" value="15:30">
          </div>
          <div style="flex:1 1 120px">
            <label class="form-label">Breaking Label</label>
            <input id="breakingLabel" class="form-control" value="BREAKING NEWS">
          </div>
        </div>
        <div class="row mb-1">
          <label class="muted"><input type="checkbox" id="liveToggle" checked> Show LIVE badge</label>
          <label class="muted"><input type="checkbox" id="wmToggle" checked> Watermark</label>
        </div>
        <div class="row mb-1">
          <label>Headline Color <input type="color" id="headColor" class="color" value="#ffffff"></label>
          <label>Breaking Bar <input type="color" id="breakingColor" class="color" value="#d92d20"></label>
          <label>Ticker BG <input type="color" id="tickerBg" class="color" value="#ffd60a"></label>
          <label>BG Color <input type="color" id="bgColor" class="color" value="#0b0f1a"></label>
        </div>
        <div class="mb-1">
          <label>Watermark Text <small class="muted">(top-right)</small></label>
          <input id="wmText" class="form-control" value="breakyourownnews.com">
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
        <div class="mb-1">
          <label>Background Image (optional)</label>
          <input id="bgFile" type="file" accept="image/*" class="form-control">
        </div>
      </div>
      <div class="pane canvas-wrap">
        <canvas id="c" width="1080" height="1080"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const c = document.getElementById('c');
  const ctx = c.getContext('2d');
  const headline = document.getElementById('headline');
  const ticker = document.getElementById('ticker');
  const ratio = document.getElementById('ratio');
  const dl = document.getElementById('dl');
  const headColor = document.getElementById('headColor');
  const bgColor = document.getElementById('bgColor');
  const bgFile = document.getElementById('bgFile');
  const timeText = document.getElementById('timeText');
  const breakingLabel = document.getElementById('breakingLabel');
  const breakingColor = document.getElementById('breakingColor');
  const tickerBg = document.getElementById('tickerBg');
  const liveToggle = document.getElementById('liveToggle');
  const wmToggle = document.getElementById('wmToggle');
  const wmText = document.getElementById('wmText');
  let bgImg = null;

  [headline, ticker, headColor, bgColor].forEach(el => el.addEventListener('input', draw));
  [timeText, breakingLabel, breakingColor, tickerBg, wmText].forEach(el => el && el.addEventListener('input', draw));
  [liveToggle, wmToggle].forEach(el => el && el.addEventListener('change', draw));
  ratio.addEventListener('change', () => { const [w,h] = ratio.value.split('x').map(Number); c.width=w; c.height=h; draw(); });
  dl.addEventListener('click', () => { draw(); const a=document.createElement('a'); a.href=c.toDataURL('image/png'); a.download='breaking-news.png'; a.click(); });
  bgFile.addEventListener('change', e => { const f=e.target.files && e.target.files[0]; if(!f){ bgImg=null; draw(); return; } const r=new FileReader(); r.onload=ev=>{ const i=new Image(); i.onload=()=>{ bgImg=i; draw(); }; i.src=ev.target.result; }; r.readAsDataURL(f); });

  function cover(img, x,y,w,h){
    const ir = img.naturalWidth/img.naturalHeight, r=w/h; let dw,dh,dx,dy;
    if(ir>r){ dh=h; dw=h*ir; dx=x-(dw-w)/2; dy=y; } else { dw=w; dh=w/ir; dx=x; dy=y-(dh-h)/2; }
    ctx.drawImage(img,dx,dy,dw,dh);
  }

  function draw(){
    const W=c.width, H=c.height; ctx.clearRect(0,0,W,H); ctx.fillStyle=bgColor.value; ctx.fillRect(0,0,W,H);
    if(bgImg){ cover(bgImg,0,0,W,H); ctx.fillStyle='rgba(0,0,0,.20)'; ctx.fillRect(0,0,W,H); }

    // Watermark top-right
    if (wmToggle && wmToggle.checked) {
      ctx.fillStyle='rgba(255,255,255,0.85)';
      ctx.font = `600 ${Math.round(H*0.03)}px Poppins,Arial`;
      ctx.textBaseline='top';
      const txt = (wmText && wmText.value || '').trim();
      if (txt) ctx.fillText(txt, W-20-ctx.measureText(txt).width, 16);
    }

    // LIVE badge top-left
    if (liveToggle && liveToggle.checked) {
      const pad=14; const lw = Math.round(H*0.10); const lh = Math.round(H*0.05);
      roundRect(ctx, pad, pad, lw, lh, 8, '#e11d48');
      ctx.fillStyle='#fff'; ctx.font=`bold ${Math.round(lh*0.55)}px Poppins,Arial`; ctx.textBaseline='middle';
      ctx.fillText('LIVE', pad+10, pad+Math.round(lh/2));
    }

    // Breaking ribbon near lower third
    const ribbonY = Math.round(H*0.62);
    const ribbonH = Math.max(60, Math.round(H*0.10));
    ctx.fillStyle = (breakingColor && breakingColor.value) || '#d92d20';
    ctx.fillRect(0, ribbonY, W, ribbonH);
    ctx.fillStyle = '#ffffff'; ctx.font = `800 ${Math.round(ribbonH*0.5)}px Poppins,Arial`; ctx.textBaseline='middle';
    const blabel = (breakingLabel && breakingLabel.value || 'BREAKING NEWS').toUpperCase();
    ctx.fillText(blabel, 20, ribbonY + Math.round(ribbonH/2));

    // Headline block
    const headY = ribbonY + ribbonH + Math.round(H*0.015);
    const headH = Math.max(90, Math.round(H*0.14));
    ctx.fillStyle='rgba(0,0,0,0.25)'; ctx.fillRect(0, headY, W, headH);
    ctx.fillStyle = headColor.value; ctx.font = `900 ${Math.round(headH*0.55)}px Poppins,Arial`; ctx.textBaseline='middle';
    wrapText((headline.value||'YOUR HEADLINE').toUpperCase(), 20, headY + Math.round(headH/2), W-40, Math.round(headH*0.62));

    // Ticker bottom
    const th = Math.max(60, Math.round(H*0.085));
    const timeW = Math.max(120, Math.round(W*0.12));
    // time chip
    ctx.fillStyle = '#111111'; ctx.fillRect(0, H-th, timeW, th);
    ctx.fillStyle = '#ffffff'; ctx.font = `800 ${Math.round(th*0.45)}px Poppins,Arial`; ctx.textBaseline='middle';
    const tt = (timeText && timeText.value || '').trim() || new Date().toTimeString().slice(0,5);
    const tw = ctx.measureText(tt).width; ctx.fillText(tt, timeW/2 - tw/2, H - Math.round(th/2));
    // strap
    ctx.fillStyle = (tickerBg && tickerBg.value) || '#ffd60a'; ctx.fillRect(timeW, H-th, W-timeW, th);
    ctx.fillStyle = '#111111'; ctx.font = `900 ${Math.round(th*0.45)}px Poppins,Arial`; ctx.textBaseline='middle';
    wrapText((ticker.value||'').toUpperCase(), timeW+20, H - Math.round(th/2), W-timeW-40, Math.round(th*0.52));
  }

  function wrapText(text, x, y, maxWidth, lineHeight){
    const words = text.split(/\s+/); let line=''; let yy=y;
    for(let n=0;n<words.length;n++){
      const test = line + words[n] + ' ';
      if (ctx.measureText(test).width > maxWidth && n>0){ ctx.fillText(line, x, yy); line = words[n] + ' '; yy += lineHeight; } else { line = test; }
    }
    ctx.fillText(line.trim(), x, yy);
  }
  function roundRect(ctx,x,y,w,h,r,fill){
    const rr = Math.min(r, w/2, h/2);
    ctx.beginPath();
    ctx.moveTo(x+rr,y);
    ctx.arcTo(x+w,y,x+w,y+h,rr);
    ctx.arcTo(x+w,y+h,x,y+h,rr);
    ctx.arcTo(x,y+h,x,y,rr);
    ctx.arcTo(x,y,x+w,y,rr);
    ctx.closePath();
    ctx.fillStyle = fill; ctx.fill();
  }

  draw();
})();
</script>
@endsection
