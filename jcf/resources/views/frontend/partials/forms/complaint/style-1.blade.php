<!-- Register Complaint – Sleek Mobile-First UI (copy–paste) -->
<section class="complaint-wrap">
  <div class="cmp-card">
    <header class="cmp-head">
      <div class="bg"></div>
      <div class="title">
        <span class="pill">🔔 New</span>
        <h1>Register Complaint</h1>
        <p>Share your issue with proof (photos, audio, video, or documents). Our team will review and reach out.</p>
      </div>
      <div class="stats">
        <div class="stat">
          <span class="k">⏱️</span>
          <span class="v">~3 min</span>
          <small>to complete</small>
        </div>
        <div class="stat">
          <span class="k">🛡️</span>
          <span class="v">Secure</span>
          <small>data privacy</small>
        </div>
      </div>
    </header>

    <form class="cmp-form" action="#" method="post" enctype="multipart/form-data" novalidate>
      <!-- Basic Details -->
      <div class="cmp-grid">
        <label class="cmp-field">
          <span class="lbl">👤 Full Name <b>*</b></span>
          <input type="text" name="full_name" placeholder="Enter your full name" required>
          <span class="hint">As per ID (optional for anonymous: toggle below)</span>
        </label>

        <label class="cmp-field">
          <span class="lbl">📱 Mobile No. <b>*</b></span>
          <input type="tel" name="mobile" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" placeholder="10-digit number" required>
          <span class="hint">We’ll use this to contact you about your complaint.</span>
        </label>

        <label class="cmp-field">
          <span class="lbl">📍 Address <b>*</b></span>
          <input type="text" name="address" placeholder="House/Street, Area, City" required>
        </label>

        <div class="cmp-2col">
          <label class="cmp-field">
            <span class="lbl">🏷️ Category <b>*</b></span>
            <select name="category" required>
              <option value="">Select a category</option>
              <option>Police / Law & Order</option>
              <option>Civic Issue (Water / Sewer / Roads)</option>
              <option>Electricity / Power</option>
              <option>Housing / Property</option>
              <option>Domestic Violence / Abuse</option>
              <option>Corruption / Bribery</option>
              <option>Health / Hospital</option>
              <option>Education / School</option>
              <option>Other</option>
            </select>
          </label>

          <label class="cmp-field">
            <span class="lbl">⚡ Urgency</span>
            <select name="urgency">
              <option>Normal</option>
              <option>High</option>
              <option>Critical</option>
            </select>
          </label>
        </div>
      </div>

      <!-- Message & Description -->
      <label class="cmp-field">
        <span class="lbl">📝 Message <b>*</b></span>
        <textarea name="message" rows="3" placeholder="Write a short summary of your problem..." maxlength="300" required></textarea>
        <span class="hint"><span id="msgCount">0</span>/300 characters</span>
      </label>

      <label class="cmp-field">
        <span class="lbl">📄 Detailed Description</span>
        <textarea name="description" rows="5" placeholder="Explain what happened, where, when, and who is involved. Include any FIR number, receipt, or reference details if available."></textarea>
      </label>

      <!-- Links & Media -->
      <div class="cmp-2col">
        <label class="cmp-field">
          <span class="lbl">🎥 Video URL</span>
          <input type="url" name="video_url" placeholder="https://… (YouTube, Drive link, etc.)">
          <span class="hint">If your video is already online, paste the link here.</span>
        </label>

        <label class="cmp-field">
          <span class="lbl">🎧 Audio URL</span>
          <input type="url" name="audio_url" placeholder="https://… (Drive link, etc.)">
          <span class="hint">Or upload audio in the section below.</span>
        </label>
      </div>

      <!-- Upload Area -->
      <div class="cmp-upload">
        <label for="files" class="up-box" id="dropArea">
          <input id="files" type="file" name="attachments[]" multiple
                 accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx,.xls,.xlsx,.mp4,.mov,.m4v,.mp3,.wav"
                 hidden>
          <div class="up-icon">⬆️</div>
          <div class="up-text">
            <b>Upload Documents / Photos / Audio / Video</b>
            <span>Drag & drop or <u>browse files</u> (max 10 files, 25MB each)</span>
          </div>
        </label>
        <ul class="up-list" id="fileList"></ul>
      </div>

      <!-- Options -->
      <div class="cmp-options">
        <label class="chk">
          <input type="checkbox" name="anonymous" id="anonymous">
          <span>Submit anonymously (we won’t show your name publicly)</span>
        </label>
        <label class="chk">
          <input type="checkbox" name="whatsapp_optin" checked>
          <span>Send updates on WhatsApp</span>
        </label>
        <label class="chk">
          <input type="checkbox" name="consent" required>
          <span>I confirm the information is true to the best of my knowledge. <b>*</b></span>
        </label>
      </div>

      <!-- CTA -->
      <div class="cmp-actions">
        <button type="submit" class="btn-primary">Submit</button>
        <button type="reset" class="btn-ghost">Reset</button>
      </div>
      <p class="foot-note">By submitting, you agree to our <a href="#">Terms</a> & <a href="#">Privacy Policy</a>.</p>
    </form>
  </div>
</section>

<style>
:root{
  --brand:#ff4747; --brand2:#ff8a47;
  --ink:#0f172a; --muted:#667085;
  --card:#fff; --soft:#f6f8fb; --line:#e7eaf0;
  --focus:rgba(255,71,71,.2);
  --radius:16px; --shadow:0 14px 34px rgba(0,0,0,.08);
  --font: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
}

*{box-sizing:border-box}
.complaint-wrap{padding:20px; background:linear-gradient(180deg,#fff, #f9fbff);}
.cmp-card{
  max-width:980px; margin:20px auto; background:var(--card); border:1px solid var(--line);
  border-radius:24px; overflow:hidden; box-shadow:var(--shadow); font-family:var(--font);
}

/* Header */
.cmp-head{position:relative; padding:28px 22px 16px;}
.cmp-head .bg{
  position:absolute; inset:0; pointer-events:none; opacity:.5;
  background:
    radial-gradient(180px 120px at 12% 24%, rgba(0,91,255,.10), transparent 60%),
    radial-gradient(220px 160px at 88% 70%, rgba(255,71,71,.12), transparent 60%);
}
.cmp-head .title{position:relative; z-index:1}
.cmp-head .pill{
  display:inline-block; font-size:12px; padding:4px 10px; border-radius:999px;
  background:linear-gradient(90deg, var(--brand), var(--brand2)); color:#fff; letter-spacing:.2px;
}
.cmp-head h1{margin:8px 0 6px; font-size:26px; line-height:1.2; color:var(--ink)}
.cmp-head p{margin:0; color:var(--muted); font-size:14px}

.stats{display:flex; gap:14px; margin-top:14px; position:relative; z-index:1}
.stat{
  background:#fff; border:1px solid var(--line); border-radius:12px; padding:10px 12px; min-width:110px;
  display:grid; justify-items:start;
}
.stat .k{font-size:16px}
.stat .v{font-weight:700; color:var(--ink); line-height:1.1}
.stat small{color:var(--muted); font-size:12px}

/* Form */
.cmp-form{padding:16px 16px 22px}
.cmp-grid{display:grid; gap:14px}
.cmp-2col{display:grid; grid-template-columns:1fr; gap:14px}
@media (min-width:720px){ .cmp-2col{grid-template-columns:1fr 1fr} }

.cmp-field{display:block}
.cmp-field .lbl{display:block; font-weight:600; color:var(--ink); margin:6px 2px}
.cmp-field b{color:var(--brand)}
.cmp-field input[type="text"],
.cmp-field input[type="tel"],
.cmp-field input[type="url"],
.cmp-field select,
.cmp-field textarea{
  width:100%; border:1px solid var(--line); border-radius:14px; padding:12px 14px;
  background:#fff; outline:none; color:var(--ink); font-size:14px;
  transition: box-shadow .2s ease, border-color .2s ease, transform .06s ease;
}
.cmp-field textarea{resize:vertical}
.cmp-field input:focus,
.cmp-field select:focus,
.cmp-field textarea:focus
