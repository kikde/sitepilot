<!-- Member Registration – Elegant UI (names unchanged) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
  --brand:#ff4d4d; --brand2:#ff944d;
  --ink:#0f172a; --muted:#6b7280;
  --card:#ffffff; --bg:#f8fafc; --line:#e5e7eb;
  --focus:rgba(255,77,77,.28);
  --radius:16px; --shadow:0 12px 34px rgba(0,0,0,.08);
  font-family:'Poppins', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
}
.member-register{
  background:linear-gradient(180deg,#fff8f7,#f6fafc);
  padding:36px 16px;
  display:flex; justify-content:center;
}
.mr-card{
  width:100%; max-width:1040px;
  background:var(--card);
  border:1px solid var(--line);
  border-radius:22px;
  overflow:hidden;
  box-shadow:var(--shadow);
}
.mr-head{
  display:flex; align-items:center; gap:12px;
  padding:18px 22px; color:#fff;
  background:linear-gradient(135deg,var(--brand),var(--brand2));
}
.mr-head i{ font-size:20px; }
.mr-head h2{ margin:0; font-size:1.2rem; font-weight:600; letter-spacing:.2px; }
.mr-body{ padding:26px; }
.mr-grid{ display:grid; grid-template-columns:1fr 1fr; gap:18px; }
.mr-grid-1{ display:grid; grid-template-columns:1fr; gap:18px; }

.mr-field label{
  display:flex; align-items:center; gap:8px;
  font-size:14px; font-weight:600; color:var(--ink); margin-bottom:6px;
}
.mr-field label .hint{ font-weight:500; color:var(--muted); }
.mr-input, .mr-select, .mr-file{
  width:100%; background:#fff;
  border:1.5px solid var(--line); border-radius:12px;
  padding:11px 14px; font-size:15px; color:#111827;
  transition:.25s;
}
.mr-input::placeholder{ color:#9aa3ad; }
.mr-input:focus, .mr-select:focus{
  outline:none; border-color:var(--brand);
  box-shadow:0 0 0 4px var(--focus);
}
.mr-textarea{ min-height:100px; resize:vertical; }

.mr-avatar{ display:flex; gap:14px; align-items:center; }
.mr-avatar img{
  width:90px; height:90px; border-radius:14px; object-fit:cover;
  box-shadow:0 6px 16px rgba(0,0,0,.12); border:1px solid var(--line);
}
.mr-avatar .btns{ display:flex; gap:10px; flex-wrap:wrap; }
.btn{
  appearance:none; border:1px solid transparent; cursor:pointer;
  padding:10px 14px; border-radius:10px; font-weight:600; font-size:14px;
}
.btn-primary{ background:linear-gradient(135deg,var(--brand),var(--brand2)); color:#fff; box-shadow:0 8px 20px rgba(255,77,77,.25); }
.btn-primary:hover{ transform:translateY(-1px); box-shadow:0 10px 26px rgba(255,77,77,.35); }
.btn-ghost{ background:#f6f7f9; color:#111827; border-color:#d1d5db; }
.btn-ghost:hover{ background:#eef1f5; }

.mr-actions{ display:flex; gap:12px; margin-top:6px; }
.btn-wide{ width:100%; }

@media (max-width:992px){ .mr-grid{ grid-template-columns:1fr; } }
@media (max-width:600px){ .mr-body{ padding:20px; } }
</style>

<section class="member-register">
  <div class="mr-card">
    <div class="mr-head">
      <i class="fa-solid fa-id-card-clip"></i>
      <h2>New Member Registration</h2>
    </div>

    <div class="mr-body">
      <form class="auth-register-form" action="https://mdmks.kikde.com/member-registration" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="gCdU8tOwc2ONmDuA4KyNoJT33aWYbLMONw0e3wqY">

        <!-- Row: Name / Gender -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-user"></i> Name</label>
            <input type="text" class="mr-input" name="name" placeholder="Name" value="John Doe" required>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-venus-mars"></i> Gender</label>
            <select class="mr-select" name="gender" required>
              <option value="Male">Male</option><option value="Female" selected>Female</option><option value="Trans">Trans</option>
            </select>
          </div>
        </div>

        <!-- Row: DOB / Father -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-cake-candles"></i> DOB</label>
            <input type="date" class="mr-input" name="dob" value="2025-10-05">
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-user-tie"></i> Father Name</label>
            <input type="text" class="mr-input" name="fname" placeholder="Father Name" value="xyz">
          </div>
        </div>

        <!-- Row: Profession / Blood Group -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-briefcase"></i> Profession</label>
            <select class="mr-select" name="profession" required>
              <option>Government Job</option><option>Private Job</option><option>Police</option><option>Army</option>
              <option>Farmer</option><option>Self Business</option><option selected>Student</option>
              <option>House Wife</option><option>Other</option>
            </select>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-droplet"></i> Blood Group</label>
            <select class="mr-select" name="bloodgroup" required>
              <option selected>A+</option><option>B+</option><option>O+</option><option>AB+</option>
              <option>A-</option><option>B-</option><option>O-</option><option>AB-</option>
            </select>
          </div>
        </div>

        <!-- Row: State / City -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-map-location-dot"></i> State</label>
            <select name="state" id="state" class="mr-select">
              <option value="Delhi">Delhi</option>
              <option value="Andhra Pradesh (AP)">Andhra Pradesh (AP)</option>
              <option value="Arunachal Pradesh (AR)">Arunachal Pradesh (AR)</option>
              <option value="Assam (AS)">Assam (AS)</option>
              <option value="Bihar (BR)">Bihar (BR)</option>
              <option value="Chhattisgarh (CG)">Chhattisgarh (CG)</option>
              <option value="Dadra and Nagar Haveli (DN)">Dadra and Nagar Haveli (DN)</option>
              <option value="Daman and Diu (DD)">Daman and Diu (DD)</option>
              <option value="Delhi (DL)">Delhi (DL)</option>
              <option value="Goa (GA)">Goa (GA)</option>
              <option value="Gujarat (GJ)">Gujarat (GJ)</option>
              <option value="Haryana (HR)">Haryana (HR)</option>
              <option value="Himachal Pradesh (HP)">Himachal Pradesh (HP)</option>
              <option value="Jammu and Kashmir (JK)">Jammu and Kashmir (JK)</option>
              <option value="Jharkhand (JH)">Jharkhand (JH)</option>
              <option value="Karnataka (KA)">Karnataka (KA)</option>
              <option value="Kerala (KL)">Kerala (KL)</option>
              <option value="Madhya Pradesh (MP)">Madhya Pradesh (MP)</option>
              <option value="Maharashtra (MH)">Maharashtra (MH)</option>
              <option value="Manipur (MN)">Manipur (MN)</option>
              <option value="Meghalaya (ML)">Meghalaya (ML)</option>
              <option value="Mizoram (MZ)">Mizoram (MZ)</option>
              <option value="Nagaland (NL)">Nagaland (NL)</option>
              <option value="Orissa (OR)">Orissa (OR)</option>
              <option value="Pondicherry (Puducherry) (PY)">Pondicherry (Puducherry) (PY)</option>
              <option value="Punjab (PB)">Punjab (PB)</option>
              <option value="Rajasthan (RJ)">Rajasthan (RJ)</option>
              <option value="Sikkim (SK)">Sikkim (SK)</option>
              <option value="Tamil Nadu (TN)">Tamil Nadu (TN)</option>
              <option value="Tripura (TR)">Tripura (TR)</option>
              <option value="Uttar Pradesh (UP)">Uttar Pradesh (UP)</option>
              <option value="Uttarakhand (UK)">Uttarakhand (UK)</option>
              <option value="West Bengal (WB)">West Bengal (WB)</option>
            </select>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-city"></i> City</label>
            <!-- kept/select enhanced; added name="city" so it submits -->
            <select class="mr-select" id="city" name="city">
              <option value="Delhi" selected>Delhi</option>
            </select>
          </div>
        </div>

        <!-- Row: Mobile / Email -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-phone"></i> Mobile</label>
            <input type="tel" class="mr-input" name="mobile" maxlength="10" placeholder="Mobile" value="1023346479" required>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-envelope"></i> Email</label>
            <input type="email" class="mr-input" name="email" placeholder="Email" value="xyz@gmail.com" required>
          </div>
        </div>

        <!-- Row: Address / Pincode -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-location-dot"></i> Address</label>
            <input class="mr-input" id="address" name="address" placeholder="Address" value="dsjfkf" required>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-hashtag"></i> Pincode</label>
            <input type="number" class="mr-input" name="pincode" placeholder="Pincode" maxlength="6" value="878723">
          </div>
        </div>

        <!-- Avatar + Upload -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-image"></i> Profile Photo</label>
            <div class="mr-avatar">
              <img src="https://mdmks.kikde.com/frontend/custom/user.png" alt="avatar">
              <div class="btns">
                <label class="btn btn-primary" for="change-picture">Upload</label>
                <input class="mr-file" type="file" name="images" id="change-picture" hidden>
                <button class="btn btn-ghost" type="button">Remove</button>
              </div>
            </div>
          </div>

          <div class="mr-field">
            <label><i class="fa-solid fa-id-card"></i> Select Id Type</label>
            <select class="mr-select" name="idtype" required>
              <option value="Aadhaar Card" selected>Aadhaar Card</option>
              <option value="Pan card">Pan card</option>
              <option value="Voter Id">Voter Id</option>
              <option value="Driving Lisence">Driving Lisence</option>
              <option value="Rashan Card">Rashan Card</option>
              <option value="Class 10th Marksheet">Class 10th Marksheet</option>
            </select>
          </div>
        </div>

        <!-- Row: ID Upload / Other Docs -->
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-paperclip"></i> uploadfile</label>
            <input type="file" id="brouchure" class="mr-file" name="brouchure">
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-folder-open"></i> Other Documents</label>
            <input type="file" id="account-upload" class="mr-file" name="documents">
          </div>
        </div>

        <!-- Hidden status (kept) -->
        <input type="hidden" id="status-hidden" name="status" value="0">

        <!-- Actions -->
        <div class="mr-actions">
          <button type="submit" class="btn btn-primary btn-wide">Submit</button>
          <button type="reset" class="btn btn-ghost btn-wide">Reset</button>
        </div>
      </form>

      <p style="text-align:center; margin:18px 0 0; color:var(--muted);">
        Already have an account?
        <a href="https://mdmks.kikde.com/download" style="color:var(--brand); text-decoration:none; font-weight:600;">Download Your IdCard</a>
      </p>
    </div>
  </div>
</section>
