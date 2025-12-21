<!-- Elegant Light NGO Form -->
<style>
:root {
  --brand:#ff4d4d;
  --brand2:#ff944d;
  --ink:#1e293b;
  --muted:#6b7280;
  --bg:#f8fafc;
  --card:#ffffff;
  --border:#e2e8f0;
  --radius:18px;
  --shadow:0 10px 30px rgba(0,0,0,.08);
  --focus:rgba(255,77,77,.28);
  font-family:'Poppins',system-ui,sans-serif;
}

/* Section background */
.section-light{
  background:linear-gradient(180deg,#fff9f8,#f9fafb);
  padding:60px 20px;
  display:flex;
  justify-content:center;
}

/* Card */
.card-form{
  width:100%;
  max-width:680px;
  background:var(--card);
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  border:1px solid var(--border);
  overflow:hidden; 
}

/* Header */
.card-head{
  background:linear-gradient(135deg,var(--brand),var(--brand2));
  color:#fff;
  padding:20px 26px;
  display:flex;
  align-items:center;
  gap:10px;
}
.card-head i{ font-size:20px; }
.card-head h3{
  margin:0; font-size:1.1rem; font-weight:600; letter-spacing:.2px;
}

/* Body */
.card-body{
  padding:28px 26px;
}
.form-row{ display:flex; gap:20px; flex-wrap:wrap; }
.form-group{ flex:1; margin-bottom:20px; }
label{
  font-size:14px; font-weight:500;
  color:var(--ink); margin-bottom:6px; display:block;
}
input,textarea{
  width:100%;
  border:1.5px solid var(--border);
  border-radius:12px;
  padding:10px 14px;
  font-size:15px;
  background:#fff;
  transition:.25s;
}
input:focus,textarea:focus{
  outline:none;
  border-color:var(--brand);
  box-shadow:0 0 0 4px var(--focus);
}
textarea{ min-height:90px; resize:vertical; }

/* Upload boxes */
.upload-box{
  position:relative;
  border:2px dashed #d1d5db;
  border-radius:14px;
  height:90px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#f9fafb;
  transition:.3s;
  cursor:pointer;
}
.upload-box:hover{
  border-color:var(--brand);
  background:#fff6f6;
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
@media(max-width:640px){
  .form-row{ flex-direction:column; }
  .card-body{ padding:24px 18px; }
}
</style>

<section class="section-light">
  <div class="card-form">
    <div class="card-head">
      <i class="fa-solid fa-hand-holding-heart"></i>
      <h3>Register Your Complaint</h3>
    </div>

    <form class="card-body" action="{{url('/send-mail')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group">
          <label>Name*</label>
          <input type="text" name="name" placeholder="Full Name" required>
        </div>
        <div class="form-group">
          <label>Mobile No.*</label>
          <input type="number" name="mobile" inputmode="numeric" pattern="[6-9][0-9]{9}" maxlength="10" placeholder="10-digit mobile" required>
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
