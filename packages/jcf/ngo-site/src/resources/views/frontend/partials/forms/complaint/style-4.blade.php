<!-- Register Complaint – Minimal (no deps, mobile-first) -->
<style>
  :root{
    --brand:#ff4d4d; --ink:#0f172a; --muted:#6b7280; --line:#e5e7eb; --bg:#fafafa;
  }
  .mc-wrap{max-width:760px;margin:16px auto;padding:0 12px;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;}
  .mc-card{background:#fff;border:1px solid var(--line);border-radius:14px;overflow:hidden}
  .mc-head{padding:14px 16px;border-bottom:1px solid var(--line);font-weight:700;color:var(--ink)}
  .mc-body{padding:16px;display:grid;gap:12px;background:#fff}
  .row{display:grid;gap:12px}
  @media (min-width:680px){ .row.two{grid-template-columns:1fr 1fr} }

  label{font-size:13px;color:#0b1220;font-weight:600;margin-bottom:4px;display:block}
  .input,.select,.textarea{
    width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:10px;
    font-size:14px;color:var(--ink);background:#fff;outline:0
  }
  .input:focus,.select:focus,.textarea:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(255,77,77,.15)}
  .textarea{min-height:110px;resize:vertical}
  .hint{font-size:12px;color:var(--muted)}
  .req{color:#ef4444}

  .uploader{padding:12px;border:1px dashed #d9dfeb;border-radius:10px;background:#fafcff}
  .files{margin-top:8px;font-size:13px;color:var(--muted)}

  .mc-foot{padding:12px 16px;border-top:1px solid var(--line);background:var(--bg);display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end}
  .btn{padding:11px 16px;border-radius:10px;border:1px solid var(--line);background:#fff;font-weight:700}
  .btn.primary{background:linear-gradient(180deg,#ff4d4d,#ff944d);border:none;color:#fff}
</style>

<div class="mc-wrap">
  <form class="mc-card" method="post" action="/complaints" enctype="multipart/form-data">
    <!-- In Blade: @csrf -->
    <div class="mc-head">Register Complaint</div>

    <div class="mc-body">
      <div class="row two">
        <div>
          <label for="full_name">Full Name <span class="req">*</span></label>
          <input class="input" id="full_name" name="full_name" required placeholder="Your full name">
        </div>
        <div>
          <label for="mobile">Mobile No. <span class="req">*</span></label>
          <input class="input" id="mobile" name="mobile" required inputmode="numeric" pattern="[0-9]{10}" maxlength="10" placeholder="10-digit number">
          <div class="hint">India only (10 digits)</div>
        </div>
      </div>

      <div>
        <label for="address">Address <span class="req">*</span></label>
        <input class="input" id="address" name="address" required placeholder="House/Street, City, PIN">
      </div>

      <div class="row two">
        <div>
          <label for="category">Problem Type <span class="req">*</span></label>
          <select class="select" id="category" name="category" required>
            <option value="" selected disabled>Select</option>
            <option>Police</option>
            <option>House / Property</option>
            <option>Electricity</option>
            <option>Water</option>
            <option>Bank</option>
            <option>Government Office</option>
            <option>Medical</option>
            <option>Other</option>
          </select>
        </div>
        <div>
          <label for="video_url">Video URL</label>
          <input class="input" id="video_url" name="video_url" type="url" placeholder="YouTube/Drive link (optional)">
        </div>
      </div>

      <div>
        <label for="message">Message <span class="req">*</span></label>
        <textarea class="textarea" id="message" name="message" required placeholder="What happened? What help do you need?"></textarea>
      </div>

      <div>
        <label for="description">Description</label>
        <textarea class="textarea" id="description" name="description" placeholder="Details, dates, reference no., people involved"></textarea>
      </div>

      <div class="uploader">
        <label for="files">Upload Documents / Media</label>
        <input class="input" id="files" name="files[]" type="file" accept=".pdf,image/*,audio/*,video/*" multiple>
        <div id="fileNote" class="files">Allowed: JPG/PNG, PDF, MP3, MP4 · Max 20MB each</div>
        <!-- optional quick capture -->
        <div style="display:flex;gap:8px;margin-top:8px">
          <label class="btn" style="padding:8px 12px">
            <input type="file" name="capture_photo" accept="image/*" capture="environment" hidden> 📷 Capture Photo
          </label>
          <label class="btn" style="padding:8px 12px">
            <input type="file" name="capture_audio" accept="audio/*" capture="microphone" hidden> 🎙️ Record Audio
          </label>
        </div>
      </div>

      <div>
        <label style="display:flex;gap:8px;align-items:flex-start;font-size:13px;color:var(--ink)">
          <input type="checkbox" name="anonymous" value="1"> <span>Keep my identity private from third parties.</span>
        </label>
        <label style="display:flex;gap:8px;align-items:flex-start;font-size:13px;color:var(--ink)">
          <input type="checkbox" name="consent" required> <span>I confirm the information provided is true to the best of my knowledge.</span>
        </label>
      </div>
    </div>

    <div class="mc-foot">
      <button type="reset" class="btn">Reset</button>
      <button type="submit" class="btn primary">Submit Complaint</button>
    </div>
  </form>
</div>

<script>
  // tiny enhancement: show selected file names/count
  (function(){
    const fi = document.getElementById('files');
    const note = document.getElementById('fileNote');
    if(!fi || !note) return;
    fi.addEventListener('change', ()=>{
      if(!fi.files || !fi.files.length){ note.textContent='Allowed: JPG/PNG, PDF, MP3, MP4 · Max 20MB each'; return; }
      const names = [...fi.files].slice(0,3).map(f=>f.name).join(', ');
      const more = fi.files.length>3 ? ` +${fi.files.length-3} more` : '';
      note.textContent = `${fi.files.length} file(s): ${names}${more}`;
    });
  })();
</script>
