<!-- Elegant NGO Registration Form -->
<style>
:root{
  --brand:#ff4d4d;
  --brand2:#ff954d;
  --bg:#f7f9fb;
  --card:#fff;
  --muted:#6b7280;
  --ink:#111827;
  --radius:18px;
  --shadow:0 10px 40px rgba(0,0,0,.10);
  --focus:rgba(255,77,77,.35);
  font-family:"Poppins", system-ui, sans-serif;
}

/* Layout */
.form-section{
  background:linear-gradient(135deg,#fff5f5,#ffe4d8);
  padding:50px 20px;
  display:flex;
  justify-content:center;
}
.form-card{
  background:var(--card);
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  padding:40px 32px;
  max-width:850px;
  width:100%;
  position:relative;
  overflow:hidden;
}
.form-card::before{
  content:"";
  position:absolute; inset:0;
  background:radial-gradient(400px 300px at 20% 10%, rgba(255,77,77,.08), transparent),
             radial-gradient(400px 300px at 90% 90%, rgba(255,149,77,.08), transparent);
  z-index:0;
}
.form-inner{ position:relative; z-index:1; }

/* Heading */
.form-head{
  text-align:center;
  margin-bottom:28px;
}
.form-head h3{
  font-weight:700;
  font-size:1.2rem;
  color:var(--ink);
  margin:0;
}
.form-head p{
  color:var(--muted);
  font-size:15px;
  margin-top:6px;
}

/* Input Groups */
.form-group{
  margin-bottom:18px;
}
.form-label{
  font-weight:500;
  color:var(--ink);
  font-size:14px;
  margin-bottom:6px;
  display:block;
}
.form-control{
  width:100%;
  border:1.6px solid #e5e7eb;
  border-radius:12px;
  padding:10px 14px;
  font-size:15px;
  transition:.25s;
  background:#fff;
}
.form-control:focus{
  border-color:var(--brand);
  box-shadow:0 0 0 4px var(--focus);
  outline:none;
}
textarea.form-control{ min-height:90px; resize:vertical; }

/* Grid */
.form-row{
  display:flex;
  flex-wrap:wrap;
  gap:18px;
}
.form-row .form-group{ flex:1; }

/* Upload */
.upload-box{
  position:relative;
  border:2px dashed #d1d5db;
  border-radius:14px;
  height:100px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#f9fafb;
  transition:.3s;
  cursor:pointer;
}
.upload-box:hover{
  border-color:var(--brand);
  background:#fff0f0;
}
.upload-box i{
  font-size:28px;
  color:var(--brand);
}
.upload-box input[type=file]{
  position:absolute; inset:0;
  opacity:0; cursor:pointer;
}

/* Button */
.btn-submit{
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
  box-shadow:0 8px 20px rgba(255,77,77,.25);
  transition:.25s;
  letter-spacing:.3px;
}
.btn-submit:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 28px rgba(255,77,77,.4);
  cursor:pointer;
}

/* Responsive */
@media(max-width:600px){
  .form-card{ padding:30px 20px; }
  .form-row{ flex-direction:column; }
}
</style>

<section class="form-section">
  <div class="form-card">
    <div class="form-inner">
      <div class="form-head">
        <h3>✨ Register Your Complaint</h3>
        <!-- <p>Please fill in your details — we’ll reach out to assist you shortly.</p> -->
      </div>

      <form action="#" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Full Name*</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
          </div>
          <div class="form-group">
            <label class="form-label">Mobile No.*</label>
            <input type="text" class="form-control" name="mobile" placeholder="Your mobile number" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Address*</label>
          <input type="text" class="form-control" name="address" placeholder="Your complete address" required>
        </div>

        <div class="form-group">
          <label class="form-label">Message*</label>
          <textarea class="form-control" name="message" placeholder="Write your message..." required></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" placeholder="Add extra details (optional)"></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Video URL</label>
          <input type="url" class="form-control" name="video_url" placeholder="Paste a YouTube or video link">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Upload Document 1</label>
            <div class="upload-box">
              <i class="fa fa-camera"></i>
              <input type="file" name="file1">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Upload Document 2</label>
            <div class="upload-box">
              <i class="fa fa-camera"></i>
              <input type="file" name="file2">
            </div>
          </div>
        </div>

        <button type="submit" class="btn-submit">Submit Request</button>
      </form>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
