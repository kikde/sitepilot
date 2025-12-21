<!-- Split Layout NGO Registration Form -->
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

.section-wrap{
  display:flex;
  flex-wrap:wrap;
  align-items:stretch;
  min-height:100vh;
  background:linear-gradient(135deg,#fff5f5,#ffe9d6);
}

/* Left image panel */
.section-image{
  flex:1 1 45%;
  background:url('https://images.unsplash.com/photo-1603575448368-5f1eac03e3aa?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
  border-top-left-radius:var(--radius);
  border-bottom-left-radius:var(--radius);
  position:relative;
}
.section-image::after{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(180deg, rgba(0,0,0,.2), rgba(0,0,0,.3));
  border-top-left-radius:var(--radius);
  border-bottom-left-radius:var(--radius);
}

/* Right form card */
.section-form{
  flex:1 1 55%;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:50px 40px;
  background:#fff;
  border-top-right-radius:var(--radius);
  border-bottom-right-radius:var(--radius);
  box-shadow:var(--shadow);
}
.form-inner{
  width:100%;
  max-width:480px;
}

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
  font-size:12px;
  margin-top:6px;
}

/* Fields */
.form-group{ margin-bottom:18px; }
.form-label{
  font-weight:500;
  color:var(--ink);
  font-size:14px;
  margin-bottom:6px;
  display:flex;
  align-items:center;
  gap:6px;
}
.form-label i{ color:var(--brand); font-size:15px; }
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

.form-row{ display:flex; flex-wrap:wrap; gap:18px; }
.form-row .form-group{ flex:1; }

/* Upload Box */
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
  font-size:26px;
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
@media(max-width:900px){
  .section-wrap{ flex-direction:column; }
  .section-image{
    height:220px;
    border-radius:var(--radius) var(--radius) 0 0;
  }
  .section-form{
    border-radius:0 0 var(--radius) var(--radius);
    padding:40px 24px;
  }
}
</style>

<section class="section-wrap">
  <!-- Left side image -->
  <div class="section-image"></div>

  <!-- Right side form -->
  <div class="section-form">
    <div class="form-inner">
      <div class="form-head">
        <h3>🤝 Register Your Complaint</h3>
        <p>Fill in your details — our NGO team will connect with you soon.</p>
      </div>

      <form action="#" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label"><i class="fa-solid fa-user"></i> Full Name*</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
          </div>
          <div class="form-group">
            <label class="form-label"><i class="fa-solid fa-phone"></i> Mobile No.*</label>
            <input type="text" class="form-control" name="mobile" placeholder="Your mobile number" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label"><i class="fa-solid fa-location-dot"></i> Address*</label>
          <input type="text" class="form-control" name="address" placeholder="Your complete address" required>
        </div>

        <div class="form-group">
          <label class="form-label"><i class="fa-solid fa-message"></i> Message*</label>
          <textarea class="form-control" name="message" placeholder="Write your message..." required></textarea>
        </div>

        <div class="form-group">
          <label class="form-label"><i class="fa-solid fa-align-left"></i> Description</label>
          <textarea class="form-control" name="description" placeholder="Add extra details (optional)"></textarea>
        </div>

        <div class="form-group">
          <label class="form-label"><i class="fa-brands fa-youtube"></i> Video URL</label>
          <input type="url" class="form-control" name="video_url" placeholder="Paste a YouTube or video link">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label"><i class="fa-solid fa-paperclip"></i> Upload Document 1</label>
            <div class="upload-box">
              <i class="fa-solid fa-file-arrow-up"></i>
              <input type="file" name="file1">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label"><i class="fa-solid fa-paperclip"></i> Upload Document 2</label>
            <div class="upload-box">
              <i class="fa-solid fa-file-arrow-up"></i>
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
