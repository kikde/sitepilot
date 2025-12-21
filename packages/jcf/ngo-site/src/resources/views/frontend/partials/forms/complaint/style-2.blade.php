<!-- Register Complaint – Alt UI (mobile-first, floating labels, glass card) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
:root{
  --brand:#ff4d4d; --brand2:#ff944d;
  --ink:#0f172a; --muted:#6b7280;
  --card:#ffffff; --soft:#f8fafc; --line:#e5e7eb;
  --focus:rgba(255,77,77,.25);
  --radius:16px;
  --shadow:0 16px 48px rgba(0,0,0,.10);
  --grad:linear-gradient(135deg, rgba(255,77,77,.12), rgba(255,148,77,.10));
  font-family:'Poppins', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
}

/* wrapper */
.rc-wrap{
  background:linear-gradient(180deg,#fff,#f7fbff 50%,#fff);
  padding:28px 14px;
  display:flex; justify-content:center;
}

/* card */
.rc-card{
  width:100%; max-width:980px;
  background:var(--card);
  border:1px solid var(--line);
  border-radius:22px;
  box-shadow:var(--shadow);
  overflow:hidden;
}

/* header */
.rc-head{
  position:relative;
  padding:22px 18px 18px;
  background:var(--grad);
}
.rc-badges{
  display:flex; gap:8px; flex-wrap:wrap; margin-bottom:10px;
}
.rc-badge{
  font-size:12px; padding:6px 10px; border-radius:999px;
  background:#fff; border:1px solid var(--line); color:var(--ink);
}
.rc-title{
  font-weight:700; font-size:20px; color:var(--ink);
  display:flex; align-items:center; gap:10px;
}
.rc-sub{ color:var(--muted); font-size:13px; margin-top:6px; }

/* body layout */
.rc-body{
  display:grid; gap:0;
  grid-template-columns:1fr;
}
.rc-aside{
  display:none; padding:18px;
  background:#fff; border-top:1px solid var(--line);
}
.rc-form{
  padding:18px;
  background:#fff;
}

/* info panel (desktop) */
.rc-tiles{
  display:grid; gap:12px;
}
.rc-tile{
  border:1px dashed #e6eaf0; border-radius:14px; padding:14px;
  background:linear-gradient(180deg,#ffffff, #fcfdff);
}
.rc-thead{ font-size:12px; color:var(--muted); margin-bottom:4px; }
.rc-tnum{ font-size:22px; font-weight:700; color:var(--ink); }

/* form controls */
.f-row{ display:grid; grid-template-columns:1fr; gap:12px; }
@media (min-width:760px){
  .rc-body{ grid-template-columns:360px 1fr; }
  .rc-aside{ display:block; border-top:none; border-right:1px solid var(--line); }
  .rc-form{ padding:24px; }
  .f-row.two{ grid-template-columns:1fr 1fr; }
}

/* floating-field */
.fld{
  position:relative; border:1px solid var(--line); border-radius:14px;
  background:#fff; transition:border-color .2s, box-shadow .2s;
}
.fld:focus-within{ border-color:var(--brand); box-shadow:0 0 0 6px var(--focus); }
.fld input, .fld select, .fld textarea{
  width:100%; border:0; background:transparent; outline:0;
  padding:22px 14px 10px; font-size:14px; color:var(--ink); border-radius:14px;
}
.fld textarea{ min-height:110px; resize:vertical; }
.fld label{
  position:absolute; left:12px; top:12px; pointer-events:none;
  background:#fff; padding:0 6px; border-radius:8px;
  color:var(--muted); font-size:12px; transform-origin:left top;
  transition:all .18s ease;
}
.fld input:focus + label,
.fld input:not(:placeholder-shown) + label,
.fld select:focus + label,
.fld select:not([value=""]) + label,
.fld textarea:focus + label,
.fld textarea:not(:placeholder-shown) + label{
  top:-9px; font-size:11px; color:#d43a3a;
}

/* select shim to trigger label float */
.fld select{
  padding-right:38px; appearance:none; -webkit-appearance:none; -moz-appearance:none;
  background-image: url('data:image/svg+xml;utf8,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 8l4 4 4-4" fill="none" stroke="%236b7280" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>');
  background-repeat:no-repeat; background-position:right 12px center;
}

/* helper rows */
.help{ font-size:12px; color:var(--muted); margin-top:6px; }

/* upload box */
.uploader{
  border:1px dashed #d7ddea; border-radius:14px; padding:14px;
  background:#fbfcff;
}
.u-head{ font-size:14px; font-weight:600; margin-bottom:6px; color:var(--ink); }
.u-sub{ font-size:12px; color:var(--muted); margin-bottom:10px; }
.u-actions{ display:flex; gap:10px; flex-wrap:wrap; }
.btn{
  display:inline-flex; align-items:center; justify-content:center; gap:8px;
  padding:11px 14px; border-radius:12px; border:1px solid var(--line);
  background:#fff; color:var(--ink); font-weight:600; font-size:14px; cursor:pointer;
  transition:transform .06s ease, box-shadow .2s;
}
.btn:active{ transform:translateY(1px); }
.btn-primary{
  background:linear-gradient(180deg, var(--brand), var(--brand2));
  color:#fff; border:none;
}
.btn-ghost{ background:#fff; }
.btn-full{ width:100%; }

/* footer */
.rc-foot{
  padding:16px 18px; border-top:1px solid var(--line);
  background:#fff; display:flex; flex-direction:column; gap:10px;
}
.rc-terms{ font-size:12px; color:var(--muted); }
.chk{ display:flex; align-items:flex-start; gap:10px; font-size:13px; color:var(--ink); }
.chk input{ transform:translateY(2px); }

/* tiny icon */
.i24{ width:18px; height:18px; display:inline-block; }
</style>

<section class="rc-wrap">
  <div class="rc-card" role="form" aria-labelledby="rcTitle">
    <!-- Header -->
    <div class="rc-head">
      <div class="rc-badges">
        <span class="rc-badge">Quick Help</span>
        <span class="rc-badge">Attach Proof</span>
        <span class="rc-badge">Trackable</span>
      </div>
      <div class="rc-title" id="rcTitle">
        🛡️ Register Complaint
      </div>
      <div class="rc-sub">Describe your issue and attach any audio/video/documents. We’ll route it to the right team.</div>
    </div>

    <!-- Body -->
    <div class="rc-body">
      <!-- Aside / Info -->
      <aside class="rc-aside">
        <div class="rc-tiles">
          <div class="rc-tile">
            <div class="rc-thead">Avg. Response</div>
            <div class="rc-tnum">24–48 hrs</div>
          </div>
          <div class="rc-tile">
            <div class="rc-thead">Supported Types</div>
            <div class="rc-tnum">Police, House, Water, Power, Bank, Govt</div>
          </div>
          <div class="rc-tile">
            <div class="rc-thead">Tips</div>
            <div class="rc-tnum" style="font-size:14px; font-weight:600;">
              Keep message clear. Add photos, bills, FIR, clips.
            </div>
          </div>
        </div>
      </aside>

      <!-- Form -->
      <form class="rc-form" method="post" action="/complaints" enctype="multipart/form-data">
        <!-- if using Laravel, include @csrf here -->
        <div class="f-row two">
          <div class="fld">
            <input type="text" name="full_name" id="full_name" placeholder=" " required>
            <label for="full_name">Full Name *</label>
          </div>

          <div class="fld">
            <input type="tel" name="mobile" id="mobile" placeholder=" " required
                   inputmode="numeric" pattern="[0-9]{10}" maxlength="10">
            <label for="mobile">Mobile No. *</label>
          </div>
        </div>

        <div class="f-row">
          <div class="fld">
            <input type="text" name="address" id="address" placeholder=" " required>
            <label for="address">Address *</label>
          </div>
        </div>

        <div class="f-row two">
          <div class="fld">
            <select name="category" id="category" aria-label="Problem Category" required
                    onchange="this.setAttribute('value', this.value);">
              <option value="" selected disabled>Choose category</option>
              <option value="Police">Police</option>
              <option value="House">House / Property</option>
              <option value="Electricity">Electricity</option>
              <option value="Water">Water</option>
              <option value="Bank">Bank</option>
              <option value="Government">Government Office</option>
              <option value="Medical">Medical</option>
              <option value="Other">Other</option>
            </select>
            <label for="category">Problem Type *</label>
          </div>

          <div class="fld">
            <input type="url" name="video_url" id="video_url" placeholder=" ">
            <label for="video_url">Video URL (optional)</label>
          </div>
        </div>

        <div class="f-row">
          <div class="fld">
            <textarea name="message" id="message" placeholder=" " required></textarea>
            <label for="message">Message * (what help do you need?)</label>
          </div>
        </div>

        <div class="f-row">
          <div class="fld">
            <textarea name="description" id="description" placeholder=" "></textarea>
            <label for="description">Description (details, dates, people)</label>
          </div>
        </div>

        <!-- Uploader -->
        <div class="uploader">
          <div class="u-head">Upload Documents / Media</div>
          <div class="u-sub">Attach photos, PDFs, audio or video. Max 20MB each.</div>
          <div class="u-actions">
            <label class="btn">
              <svg class="i24" viewBox="0 0 24 24" fill="none"><path d="M21 15v4a2 2 0 0 1-2 2H7a4 4 0 0 1-4-4V9a4 4 0 0 1 4-4h8" stroke="#0f172a" stroke-width="1.6" stroke-linecap="round"/><path d="M12 12l8-8M20 8V4h-4" stroke="#0f172a" stroke-width="1.6" stroke-linecap="round"/></svg>
              <input type="file" name="files[]" accept=".pdf,image/*,audio/*,video/*" multiple hidden>
              Choose Files
            </label>

            <!-- Direct camera / mic capture (mobile browsers) -->
            <label class="btn">
              📷
              <input type="file" name="capture_photo" accept="image/*" capture="environment" hidden>
              Capture Photo
            </label>
            <label class="btn">
              🎙️
              <input type="file" name="capture_audio" accept="audio/*" capture="microphone" hidden>
              Record Audio
            </label>
            <label class="btn">
              🎥
              <input type="file" name="capture_video" accept="video/*" capture="environment" hidden>
              Record Video
            </label>
          </div>
          <div class="help">Allowed: JPG/PNG, PDF, MP3, MP4 (others may be rejected).</div>
        </div>

        <!-- Privacy & consent -->
        <div class="f-row" style="margin-top:10px;">
          <label class="chk">
            <input type="checkbox" name="anonymous" value="1">
            <span>Keep my identity private from third parties.</span>
          </label>
          <label class="chk">
            <input type="checkbox" name="consent" required>
            <span>I confirm the information provided is true to the best of my knowledge.</span>
          </label>
        </div>

        <!-- Actions -->
        <div class="rc-foot">
          <button type="submit" class="btn btn-primary btn-full">Submit Complaint</button>
          <div class="rc-terms">By submitting, you agree to our terms and consent to be contacted for verification.</div>
        </div>
      </form>
    </div>
  </div>
</section>
