<!-- Register Complaint – Version 3 (Stepper + Chips + Sticky Footer) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --brand:#ff4d4d; --brand2:#ff944d;
  --ink:#0f172a; --muted:#6b7280; --line:#e5e7eb; --bg:#f8fafc; --card:#ffffff;
  --focus:rgba(255,77,77,.20); --ok:#10b981; --warn:#f59e0b;
  --r:16px; --shadow:0 16px 40px rgba(15, 23, 42, .08);
  font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
}

/* wrapper */
.rc3-wrap{ background:linear-gradient(180deg,#fff,#f8fbff 60%,#fff); padding:20px 12px; display:flex; justify-content:center; }
.rc3-card{ width:100%; max-width:980px; background:var(--card); border:1px solid var(--line); border-radius:22px; box-shadow:var(--shadow); overflow:hidden; position:relative; }

/* header */
.rc3-head{ padding:18px; border-bottom:1px solid var(--line);
  background:
    radial-gradient(300px 120px at -10% 10%, rgba(255,77,77,.08), transparent 60%),
    radial-gradient(260px 120px at 110% 0%, rgba(255,148,77,.10), transparent 60%),
    #fff;
}
.rc3-title{ font-size:20px; font-weight:700; color:var(--ink); display:flex; gap:10px; align-items:center; }
.rc3-sub{ font-size:13px; color:var(--muted); margin-top:6px; }

/* stepper line */
.rc3-steps{ display:grid; grid-template-columns:repeat(3,1fr); gap:8px; margin-top:14px; }
.step{ display:flex; align-items:center; gap:8px; font-size:12px; color:var(--muted); padding:8px 10px; border:1px dashed #e0e6f0; border-radius:999px; background:#fff; }
.step.active{ border-style:solid; border-color:#ffd2d2; background:linear-gradient(180deg,#fff7f7,#fff); color:#b91c1c; }
.dot{ width:18px; height:18px; border-radius:50%; display:inline-grid; place-items:center; background:#fff; border:1px solid #f0b2b2; }
.step.active .dot{ background:linear-gradient(180deg,var(--brand),var(--brand2)); border:0; color:#fff; }

/* body columns */
.rc3-body{ display:grid; grid-template-columns:1fr; }
@media (min-width:860px){ .rc3-body{ grid-template-columns:360px 1fr; } }

/* left info */
.rc3-aside{ padding:18px; border-right:1px solid var(--line); display:none; background:#fff; }
@media (min-width:860px){ .rc3-aside{ display:block; } }
.info-card{ border:1px solid var(--line); border-radius:14px; padding:14px; background:#fff; }
.info-title{ font-size:13px; color:var(--muted); margin-bottom:6px; }
.info-big{ font-size:22px; font-weight:700; color:var(--ink); }
.info-list{ margin-top:10px; font-size:13px; color:var(--ink); display:grid; gap:8px; }
.badge{ display:inline-block; padding:6px 10px; border-radius:999px; border:1px solid var(--line); font-size:12px; }

/* form */
.rc3-form{ padding:18px; background:#fff; }
.row{ display:grid; grid-template-columns:1fr; gap:10px; }
.row.two{ grid-template-columns:1fr; }
@media (min-width:680px){ .row.two{ grid-template-columns:1fr 1fr; } }

/* input */
.ctrl{ display:grid; gap:6px; }
.label{ font-size:13px; color:#0b1220; font-weight:600; }
.input, .select, .textarea{
  width:100%; border:1px solid var(--line); border-radius:12px; background:#fff;
  padding:12px 12px; font-size:14px; color:var(--ink); outline:0; transition:box-shadow .15s,border-color .15s;
}
.input:focus, .select:focus, .textarea:focus{ border-color:var(--brand); box-shadow:0 0 0 6px var(--focus); }
.textarea{ min-height:110px; resize:vertical; }

/* chips */
.chips{ display:flex; gap:8px; flex-wrap:wrap; }
.chip{
  padding:8px 12px; border-radius:999px; border:1px solid var(--line); background:#fff;
  font-size:13px; color:var(--ink); cursor:pointer; user-select:none; transition:transform .06s, border-color .15s, background .15s;
}
.chip:active{ transform:translateY(1px); }
.chip.active{ background:linear-gradient(180deg,#fff,#fff0f0); border-color:#ffc7c2; box-shadow:0 2px 0 rgba(255,77,77,.10) inset; }

/* uploader */
.uploader{ border:1px dashed #d9dfeb; border-radius:14px; padding:12px; background:#fbfcff; }
.u-head{ font-size:14px; font-weight:600; color:var(--ink); margin-bottom:4px; }
.u-sub{ font-size:12px; color:var(--muted); margin-bottom:10px; }
.u-actions{ display:flex; gap:10px; flex-wrap:wrap; }
.btn{ display:inline-flex; align-items:center; gap:8px; padding:11px 14px; border-radius:12px; border:1px solid var(--line); background:#fff; font-weight:600; font-size:14px; cursor:pointer; }
.btn.primary{ background:linear-gradient(180deg,var(--brand),var(--brand2)); color:#fff; border:none; }
.btn.ghost{ background:#fff; }
.small{ font-size:12px; color:var(--muted); }
.files{ margin-top:10px; display:grid; gap:8px; }
.file-row{ font-size:13px; color:var(--ink); display:flex; align-items:center; justify-content:space-between; padding:8px 10px; border:1px solid #eef1f6; border-radius:10px; background:#fff; }

/* sticky footer */
.rc3-foot{
  position:sticky; bottom:0; background:#ffffffcc; backdrop-filter:blur(8px);
  border-top:1px solid var(--line); padding:12px 18px; display:flex; flex-wrap:wrap; gap:10px; align-items:center; justify-content:space-between;
}
.progress{ display:flex; align-items:center; gap:10px; font-size:12px; color:var(--muted); }
.bar{ width:140px; height:8px; background:#f1f5f9; border-radius:999px; overflow:hidden; }
.fill{ height:100%; width:0%; background:linear-gradient(90deg,var(--brand),var(--brand2)); }
.actions{ display:flex; gap:10px; }
.kbtn{ padding:11px 16px; border-radius:12px; border:1px solid var(--line); background:#fff; font-weight:700; }
.kbtn.primary{ background:linear-gradient(180deg,var(--brand),var(--brand2)); color:#fff; border:none; }
.kbtn.ghost{ background:#fff; }

/* helper */
.req{ color:#ef4444; }
.hide{ display:none!important; }
</style>

<section class="rc3-wrap">
  <div class="rc3-card" role="form" aria-labelledby="rc3Title">
    <!-- header -->
    <div class="rc3-head">
      <div class="rc3-title" id="rc3Title">📝 Register Complaint</div>
      <div class="rc3-sub">Three quick steps. Attach proof and we’ll route it to the right desk.</div>
      <div class="rc3-steps" id="steps">
        <div class="step active" data-step="1"><span class="dot">1</span> Your Info</div>
        <div class="step" data-step="2"><span class="dot">2</span> Complaint</div>
        <div class="step" data-step="3"><span class="dot">3</span> Attach & Send</div>
      </div>
    </div>

    <div class="rc3-body">
      <!-- aside -->
      <aside class="rc3-aside">
        <div class="info-card">
          <div class="info-title">Avg. Response</div>
          <div class="info-big">24–48 hrs</div>
          <div class="info-list">
            <span class="badge">Police</span>
            <span class="badge">Electricity</span>
            <span class="badge">Water</span>
            <span class="badge">Bank</span>
            <span class="badge">Govt Office</span>
          </div>
        </div>
      </aside>

      <!-- form -->
      <form id="complaintForm" class="rc3-form" method="post" action="/complaints" enctype="multipart/form-data">
        <!-- STEP 1 -->
        <div class="step-pane" data-pane="1">
          <div class="row two">
            <div class="ctrl">
              <label class="label" for="full_name">Full Name <span class="req">*</span></label>
              <input class="input" id="full_name" name="full_name" required placeholder="Your full name">
            </div>
            <div class="ctrl">
              <label class="label" for="mobile">Mobile No. <span class="req">*</span></label>
              <input class="input" id="mobile" name="mobile" required inputmode="numeric" pattern="[0-9]{10}" maxlength="10" placeholder="10-digit number">
              <span class="small">India only (10 digits)</span>
            </div>
          </div>
          <div class="row">
            <div class="ctrl">
              <label class="label" for="address">Address <span class="req">*</span></label>
              <input class="input" id="address" name="address" required placeholder="House/Street, City, PIN">
            </div>
          </div>
        </div>

        <!-- STEP 2 -->
        <div class="step-pane hide" data-pane="2">
          <div class="row">
            <div class="ctrl">
              <span class="label">Problem Type <span class="req">*</span></span>
              <div class="chips" id="chipGroup" role="group" aria-label="Problem categories">
                <span class="chip" data-val="Police">Police</span>
                <span class="chip" data-val="House/Property">House</span>
                <span class="chip" data-val="Electricity">Electricity</span>
                <span class="chip" data-val="Water">Water</span>
                <span class="chip" data-val="Bank">Bank</span>
                <span class="chip" data-val="Government Office">Govt Office</span>
                <span class="chip" data-val="Medical">Medical</span>
                <span class="chip" data-val="Other">Other</span>
              </div>
              <input type="hidden" name="category" id="category" required>
              <span class="small">Tap to select one. You can refine in message.</span>
            </div>
          </div>

          <div class="row">
            <div class="ctrl">
              <label class="label" for="message">Message <span class="req">*</span></label>
              <textarea class="textarea" id="message" name="message" required placeholder="What happened? What help do you need?"></textarea>
            </div>
          </div>

          <div class="row two">
            <div class="ctrl">
              <label class="label" for="video_url">Video URL</label>
              <input class="input" id="video_url" name="video_url" type="url" placeholder="Link to evidence (YouTube/Drive etc.)">
            </div>
            <div class="ctrl">
              <label class="label" for="description">Description</label>
              <input class="input" id="description" name="description" placeholder="Extra details, dates, reference no.">
            </div>
          </div>
        </div>

        <!-- STEP 3 -->
        <div class="step-pane hide" data-pane="3">
          <div class="uploader">
            <div class="u-head">Upload Documents / Media</div>
            <div class="u-sub">Add images, PDFs, audio or video. Max 20MB each.</div>
            <div class="u-actions">
              <label class="btn">
                <input type="file" name="files[]" accept=".pdf,image/*,audio/*,video/*" multiple hidden onchange="rc3ListFiles(this)">
                📎 Choose Files
              </label>
              <label class="btn ghost">
                <input type="file" name="capture_photo" accept="image/*" capture="environment" hidden>
                📷 Capture Photo
              </label>
              <label class="btn ghost">
                <input type="file" name="capture_audio" accept="audio/*" capture="microphone" hidden>
                🎙️ Record Audio
              </label>
              <label class="btn ghost">
                <input type="file" name="capture_video" accept="video/*" capture="environment" hidden>
                🎥 Record Video
              </label>
            </div>
            <div id="fileList" class="files"></div>
          </div>

          <div class="row" style="margin-top:12px">
            <label style="display:flex; gap:10px; align-items:flex-start; font-size:13px; color:var(--ink);">
              <input type="checkbox" name="anonymous" value="1">
              <span>Keep my identity private from third parties.</span>
            </label>
            <label style="display:flex; gap:10px; align-items:flex-start; font-size:13px; color:var(--ink);">
              <input type="checkbox" name="consent" required>
              <span>I confirm the information provided is true to the best of my knowledge.</span>
            </label>
          </div>
        </div>

        <!-- sticky footer -->
        <div class="rc3-foot">
          <div class="progress">
            <span id="stepLabel">Step 1 of 3</span>
            <div class="bar"><div class="fill" id="fillBar" style="width:33%"></div></div>
          </div>
          <div class="actions">
            <button type="button" class="kbtn ghost" id="prevBtn" disabled>Back</button>
            <button type="button" class="kbtn primary" id="nextBtn">Next</button>
            <button type="submit" class="kbtn primary hide" id="submitBtn">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<script>
(function(){
  let step = 1; const max = 3;
  const panes = document.querySelectorAll('.step-pane');
  const steps = document.querySelectorAll('.step');
  const stepLabel = document.getElementById('stepLabel');
  const fillBar = document.getElementById('fillBar');
  const nextBtn = document.getElementById('nextBtn');
  const prevBtn = document.getElementById('prevBtn');
  const submitBtn = document.getElementById('submitBtn');
  const categoryInput = document.getElementById('category');

  function render(){
    panes.forEach(p=>p.classList.add('hide'));
    document.querySelector(`.step-pane[data-pane="${step}"]`).classList.remove('hide');

    steps.forEach(s=>s.classList.remove('active'));
    document.querySelector(`.step[data-step="${step}"]`).classList.add('active');

    stepLabel.textContent = `Step ${step} of ${max}`;
    fillBar.style.width = (step*100/max)+'%';

    prevBtn.disabled = (step===1);
    nextBtn.classList.toggle('hide', step===max);
    submitBtn.classList.toggle('hide', step!==max);
  }

  nextBtn.addEventListener('click', ()=>{
    if(step===1){
      // quick required check
      const req = ['full_name','mobile','address'].map(id=>document.getElementById(id));
      for(const el of req){ if(!el.value.trim()){ el.focus(); return; } }
    }
    if(step===2){
      if(!categoryInput.value){ alert('Please select a problem type.'); return; }
      if(!document.getElementById('message').value.trim()){ document.getElementById('message').focus(); return; }
    }
    if(step<max) step++; render();
  });
  prevBtn.addEventListener('click', ()=>{ if(step>1) step--; render(); });

  // chips logic
  const chips = document.querySelectorAll('.chip');
  chips.forEach(ch=>{
    ch.addEventListener('click', ()=>{
      chips.forEach(c=>c.classList.remove('active'));
      ch.classList.add('active');
      categoryInput.value = ch.dataset.val;
    });
  });

  // click on step header (optional)
  steps.forEach(s=>{
    s.addEventListener('click', ()=>{
      const n = parseInt(s.dataset.step,10);
      // guard: cannot jump ahead without completing required fields
      if(n<step) { step=n; render(); }
    });
  });

  render();
})();

function rc3ListFiles(input){
  const box = document.getElementById('fileList');
  box.innerHTML='';
  if(!input.files || !input.files.length) return;
  [...input.files].forEach(f=>{
    const row = document.createElement('div');
    row.className='file-row';
    row.innerHTML = `<span>📄 ${f.name}</span><span class="small">${(f.size/1024/1024).toFixed(2)} MB</span>`;
    box.appendChild(row);
  });
}
</script>
