<!-- Improved Glassmorphism NGO Form -->
<style>
:root {
  --brand:#ff4d4d;
  --brand2:#ff8a47;
  --bg:#0e141b;
  --text:#1f2937;
  --muted:#6b7280;
  --glass-bg:rgba(255,255,255,.14);
  --border:rgba(255,255,255,.25);
  --radius:18px;
  --shadow:0 10px 40px rgba(0,0,0,.25);
  --blur:14px;
  font-family:'Poppins',system-ui,sans-serif;
}

/* Hero Background */
.hero-wrap {
  min-height:100vh;
  background:
    radial-gradient(800px 400px at 10% 10%, rgba(255,77,77,.15), transparent 60%),
    radial-gradient(700px 380px at 90% 90%, rgba(255,149,77,.18), transparent 60%),
    #0b1220 url('https://images.unsplash.com/photo-1603575448368-5f1eac03e3aa?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
  display:flex;
  justify-content:center;
  align-items:center;
  padding:40px 20px;
}

/* Glass Card */
.glass-card {
  width:100%;
  max-width:480px;
  border-radius:var(--radius);
  background:linear-gradient(120deg,rgba(255,255,255,.22),rgba(255,255,255,.08));
  border:1px solid var(--border);
  box-shadow:var(--shadow);
  backdrop-filter:blur(var(--blur));
  -webkit-backdrop-filter:blur(var(--blur));
  overflow:hidden;
}

/* Header */
.glass-head {
  padding:20px 26px;
  background:linear-gradient(135deg,var(--brand),var(--brand2));
  color:#fff;
  display:flex;
  align-items:center;
  gap:12px;
}
.glass-head i {
  font-size:20px;
  opacity:.9;
}
.glass-head h3 {
  font-size:1.25rem;
  font-weight:600;
  margin:0;
}

/* Form Body */
.glass-body {
  padding:28px 24px;
  color:#fff;
}
.glass-body label {
  font-weight:500;
  font-size:14px;
  margin-bottom:6px;
  display:block;
  color:rgba(255,255,255,.9);
}
.glass-body input,
.glass-body textarea {
  width:100%;
  background:rgba(255,255,255,.1);
  border:1px solid rgba(255,255,255,.3);
  border-radius:12px;
  padding:10px 14px;
  font-size:15px;
  color:#fff;
  transition:.25s;
}
.glass-body input::placeholder,
.glass-body textarea::placeholder {
  color:rgba(255,255,255,.6);
}
.glass-body input:focus,
.glass-body textarea:focus {
  outline:none;
  border-color:rgba(255,255,255,.9);
  box-shadow:0 0 0 4px rgba(255,77,77,.3);
  background:rgba(255,255,255,.16);
}
.glass-body textarea {
  min-height:90px;
  resize:vertical;
}
.form-row {
  display:flex;
  flex-wrap:wrap;
  gap:18px;
}
.form-row .form-group { flex:1; }
.form-group { margin-bottom:18px; }

/* Upload Boxes */
.upload-box {
  position:relative;
  border:2px dashed rgba(255,255,255,.35);
  border-radius:14px;
  height:100px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:rgba(255,255,255,.08);
  transition:.25s;
  cursor:pointer;
}
.upload-box:hover {
  border-color:#fff;
  background:rgba(255,255,255,.12);
}
.upload-box i {
  font-size:26px;
  color:#fff;
}
.upload-box input[type=file] {
  position:absolute;
  inset:0;
  opacity:0;
  cursor:pointer;
}

/* Button */
.btn-submit {
  display:block;
  width:100%;
  margin-top:10px;
  background:linear-gradient(135deg,var(--brand),var(--brand2));
  color:#fff;
  font-weight:600;
  font-size:17px;
  padding:14px;
  border:none;
  border-radius:14px;
  box-shadow:0 8px 24px rgba(255,77,77,.25);
  transition:.3s;
  letter-spacing:.3px;
}
.btn-submit:hover {
  transform:translateY(-2px);
  box-shadow:0 12px 28px rgba(255,77,77,.45);
  cursor:pointer;
}

/* Responsive */
@media(max-width:600px){
  .glass-body{ padding:24px 18px; }
  .form-row{ flex-direction:column; }
}
</style>

<section class="hero-wrap">
  <div class="glass-card">
    <div class="glass-head">
      <i class="fa-solid fa-hand-holding-heart"></i>
      <h3>Register Your Complaint</h3>
    </div>

    <form class="glass-body" action="#" method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group">
          <label>Name*</label>
          <input type="text" name="name" placeholder="Full Name" required>
        </div>
        <div class="form-group">
          <label>Mobile No.*</label>
          <input type="text" name="mobile" placeholder="Mobile Number" required>
        </div>
      </div>

      <div class="form-group">
        <label>Address*</label>
        <input type="text" name="address" placeholder="Complete Address" required>
      </div>

      <div class="form-group">
        <label>Message*</label>
        <textarea name="message" placeholder="Write a message..." required></textarea>
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" placeholder="Additional details (optional)"></textarea>
      </div>

      <div class="form-group">
        <label>Video URL</label>
        <input type="url" name="video_url" placeholder="https://example.com/video">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Upload Document 1</label>
          <div class="upload-box">
            <i class="fa-solid fa-paperclip"></i>
            <input type="file" name="file1">
          </div>
        </div>
        <div class="form-group">
          <label>Upload Document 2</label>
          <div class="upload-box">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <input type="file" name="file2">
          </div>
        </div>
      </div>

      <button type="submit" class="btn-submit">Submit Request</button>
    </form>
  </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
