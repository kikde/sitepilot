<!-- WordPress-Style Minimal Form -->
<style>
:root{
  /* WordPress-ish palette */
  --wp-primary:#2271b1;       /* primary button */
  --wp-primary-hover:#135e96; /* hover */
  --wp-ring:#72aee6;          /* focus ring */
  --border:#dcdfe4;           /* field border */
  --text:#1e1e1e;
  --muted:#646970;
  --bg:#f6f7f7;               /* light gray background */
  --card:#ffffff;
  --radius:8px;               /* WP uses small radii */
  --shadow:0 1px 2px rgba(0,0,0,.06);
  font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,"Apple Color Emoji","Segoe UI Emoji";
}

.wp-section{
  background:var(--bg);
  padding:48px 16px;
  display:flex; justify-content:center;
}
.wp-card{
  width:100%; max-width:820px;
  background:var(--card);
  border:1px solid #e2e4e7;
  border-radius:12px;
  box-shadow:var(--shadow);
}
.wp-head{
  padding:20px 24px;
  border-bottom:1px solid #eef0f3;
}
.wp-eyebrow{
  letter-spacing:.08em; text-transform:uppercase;
  font-size:12px; color:var(--muted);
}
.wp-title{
  margin:6px 0 0; font-size:22px; font-weight:600; color:var(--text);
}
.wp-body{ padding:24px; }

.wp-row{ display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.wp-row-1{ display:grid; grid-template-columns:1fr; gap:20px; }

.wp-field label{
  display:block; font-size:14px; color:var(--text);
  margin:0 0 6px;
}
.wp-input, .wp-textarea, .wp-file{
  width:100%; font-size:14px; color:var(--text);
  background:#fff;
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:10px 12px; transition:.2s;
}
.wp-input::placeholder, .wp-textarea::placeholder{ color:#8a8f98; }
.wp-input:focus, .wp-textarea:focus{
  outline:none;
  border-color:var(--wp-ring);
  box-shadow:0 0 0 3px color-mix(in srgb, var(--wp-ring) 35%, transparent);
}
.wp-textarea{ min-height:120px; resize:vertical; }

/* Drag & drop file (simple) */
.wp-drop{
  border:1px dashed var(--border);
  background:#fbfbfb;
  text-align:center; padding:18px; border-radius:var(--radius);
  color:var(--muted); font-size:14px;
}
.wp-drop input[type=file]{ display:block; margin:8px auto 0; }

/* Checkbox line */
.wp-check{
  display:flex; gap:10px; align-items:flex-start; font-size:13px; color:var(--muted);
}
.wp-check input{ margin-top:3px; }

/* Button bar */
.wp-actions{ margin-top:10px; display:flex; gap:12px; align-items:center; }
.wp-btn{
  appearance:none; border:1px solid transparent; cursor:pointer;
  padding:10px 16px; font-weight:600; font-size:14px; border-radius:4px;
}
.wp-btn-primary{
  background:var(--wp-primary); color:#fff;
}
.wp-btn-primary:hover{ background:var(--wp-primary-hover); }
.wp-btn-secondary{
  background:#f6f7f7; color:var(--text); border-color:#c3c4c7;
}
.wp-help{ font-size:12px; color:var(--muted); }

@media (max-width:820px){
  .wp-row{ grid-template-columns:1fr; }
}
</style>

<section class="wp-section">
  <div class="wp-card">
    <div class="wp-head">
      <div class="wp-eyebrow">Registration</div>
      <h3 class="wp-title">Submit Your Request</h3>
    </div>

    <form class="wp-body" action="#" method="POST" enctype="multipart/form-data">
      <div class="wp-row">
        <div class="wp-field">
          <label for="name">Full Name<span style="color:#d63638;">*</span></label>
          <input id="name" name="name" type="text" class="wp-input" placeholder="John Doe" required>
        </div>
        <div class="wp-field">
          <label for="mobile">Mobile No.<span style="color:#d63638;">*</span></label>
          <input id="mobile" name="mobile" type="tel" class="wp-input" placeholder="+91 98xxxxxxx" required>
        </div>
      </div>

      <div class="wp-row-1">
        <div class="wp-field">
          <label for="address">Address<span style="color:#d63638;">*</span></label>
          <input id="address" name="address" type="text" class="wp-input" placeholder="House / Street / City" required>
        </div>
      </div>

      <div class="wp-row">
        <div class="wp-field">
          <label for="message">Message<span style="color:#d63638;">*</span></label>
          <textarea id="message" name="message" class="wp-textarea" placeholder="Write your message..." required></textarea>
        </div>
        <div class="wp-field">
          <label for="description">Description</label>
          <textarea id="description" name="description" class="wp-textarea" placeholder="Additional details (optional)"></textarea>
        </div>
      </div>

      <div class="wp-row-1">
        <div class="wp-field">
          <label for="video">Video URL</label>
          <input id="video" name="video_url" type="url" class="wp-input" placeholder="https://youtu.be/…">
        </div>
      </div>

      <div class="wp-row">
        <div class="wp-field">
          <label>Upload Document 1</label>
          <div class="wp-drop">
            Drag & drop or choose a file
            <input type="file" name="file1" class="wp-file">
          </div>
        </div>
        <div class="wp-field">
          <label>Upload Document 2</label>
          <div class="wp-drop">
            Drag & drop or choose a file
            <input type="file" name="file2" class="wp-file">
          </div>
        </div>
      </div>

      <div class="wp-row-1">
        <label class="wp-check">
          <input type="checkbox" name="consent" required>
          <span>I agree to the <a href="#" style="color:var(--wp-primary); text-decoration:none;">terms & privacy</a>.</span>
        </label>
      </div>

      <div class="wp-actions">
        <button type="submit" class="wp-btn wp-btn-primary">Submit </button>
        <button type="reset" class="wp-btn wp-btn-secondary">Reset</button>
        <span class="wp-help">We’ll respond within 24–48 hours.</span>
      </div>
    </form>
  </div>
</section>
