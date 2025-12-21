
<!-- Member Registration – Elegant, mobile-first UI -->
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
.member-register{ background:linear-gradient(180deg,#fff8f7,#f6fafc); padding:36px 16px; display:flex; justify-content:center; }
.mr-card{ width:100%; max-width:1040px; background:var(--card); border:1px solid var(--line); border-radius:22px; overflow:hidden; box-shadow:var(--shadow); }
.mr-head{ display:flex; align-items:center; gap:12px; padding:18px 22px; color:#fff; background:linear-gradient(135deg,var(--brand),var(--brand2)); }
.mr-head i{ font-size:20px; }
.mr-head h2{ margin:0; font-size:1.4rem; font-weight:700; letter-spacing:.2px; }
.mr-body{ padding:26px; }
.mr-grid{ display:grid; grid-template-columns:1fr 1fr; gap:18px; }
.mr-field label{ display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; color:#2b3441; margin-bottom:6px; }
.mr-input, .mr-select, .mr-file{ width:100%; background:#fff; border:1.5px solid var(--line); border-radius:12px; padding:11px 14px; font-size:15px; color:#111827; transition:.25s; }
.mr-select{ -webkit-appearance:none; appearance:none; background-color:#fff; border:1.5px solid var(--line) !important; }
.mr-select:focus{ border-color:var(--brand) !important; box-shadow:0 0 0 4px var(--focus); }
/* Align text left in native selects (requested) */
.mr-select{ text-align-last:left; -moz-text-align-last:left; }
.mr-select option{ text-align:left; }

/* If theme enhances selects via .nice-select, keep our look and centered label */
.nice-select{ width:100%; border:1.5px solid var(--line); border-radius:12px; padding:6px 14px; background:#fff; height:40px; line-height:26px; }
.nice-select:focus, .nice-select.open{ border-color:var(--brand); box-shadow:0 0 0 4px var(--focus); }
.nice-select .current{ width:100%; display:inline-block; text-align:center; }
.nice-select .list{ width:100%; }
.mr-input::placeholder{ color:#9aa3ad; }
.mr-input:focus, .mr-select:focus{ outline:none; border-color:var(--brand); box-shadow:0 0 0 4px var(--focus); }
.mr-textarea{ min-height:100px; resize:vertical; }
.mr-avatar{ display:flex; gap:14px; align-items:center; }
.mr-avatar img{ width:90px; height:90px; border-radius:14px; object-fit:cover; box-shadow:0 6px 16px rgba(0,0,0,.12); border:1px solid var(--line); }
.mr-avatar .btns{ display:flex; gap:10px; flex-wrap:wrap; }
.btn{ appearance:none; border:1px solid transparent; cursor:pointer; padding:10px 14px; border-radius:10px; font-weight:600; font-size:14px; }
.btn-primary{ background:linear-gradient(135deg,var(--brand),var(--brand2)); color:#fff; box-shadow:0 8px 20px rgba(255,77,77,.25); }
.btn-primary:hover{ transform:translateY(-1px); box-shadow:0 10px 26px rgba(255,77,77,.35); }
/* Keep gradient when disabled (browsers often make disabled buttons white) */
.btn-primary:disabled, .btn-primary[disabled]{
  background:linear-gradient(135deg,var(--brand),var(--brand2)) !important;
  color:#fff !important; opacity:.7; cursor:not-allowed;
}
.btn-ghost{ background:#f6f7f9; color:#111827; border:1px solid #d1d5db; }
.btn-ghost:hover{ background:#eef1f5; }
.mr-actions{ display:flex; gap:12px; margin-top:6px; }
.btn-wide{ width:100%; }
@media (max-width:992px){ .mr-grid{ grid-template-columns:1fr; } }
@media (max-width:600px){ .mr-body{ padding:20px; } }

/* modal */
.modal-backdrop{ position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:saturate(120%) blur(2px); display:none; align-items:center; justify-content:center; z-index:2147483647; }
.modal-backdrop.open{ display:flex; }
.modal-card{ width:min(720px, 92vw); background:#fff; border:1px solid var(--line); border-radius:18px; box-shadow:0 24px 60px rgba(0,0,0,.22); overflow:hidden; animation:pop .18s ease-out; font-family:inherit; }
@keyframes pop{ from{ transform:translateY(8px); opacity:.0; } to{ transform:none; opacity:1; } }
.modal-head{ display:flex; align-items:center; justify-content:space-between; gap:10px; padding:14px 18px; color:#fff; background:linear-gradient(135deg,var(--brand),var(--brand2)); }
.modal-title{ font-weight:700; letter-spacing:.2px; }
.modal-close{ appearance:none; background:rgba(255,255,255,.22); color:#fff; border:1px solid rgba(255,255,255,.35); width:32px; height:32px; border-radius:9px; cursor:pointer; font-weight:700; }
.modal-body{ padding:18px; color: #111827; }
.modal-actions{ display:flex; gap:10px; padding:0 18px 18px; }
.modal-actions .btn{ text-decoration:none; display:inline-block; }
/* ==== Member form: custom searchable State dropdown ==== */
.mr-select-search{
  position:relative;
  font-size:15px;
  width:100%;
}

.mr-select-display{
  border-radius:12px;
  border:1.5px solid var(--line);
  background:#ffffff;
  cursor:pointer;
  height:40px;
  padding:0 12px;
  display:flex;
  align-items:center;
}

/* hide theme’s auto-enhanced select (like we did for donate form) */
#state + * {
  display:none !important;
}

/* dropdown wrapper */
.mr-select-dropdown{
  position:absolute;
  left:0;
  right:0;
  top:0;
  background:#ffffff;
  border-radius:12px;
  border:1.5px solid var(--line);
  box-shadow:0 10px 24px rgba(15,23,42,.18);
  z-index:999;
  display:none;
}

/* when open */
.mr-select-search.is-open .mr-select-display{
  display:none;
}
.mr-select-search.is-open .mr-select-dropdown{
  display:block;
}

.mr-select-input{
  width:100%;
  border:none;
  border-bottom:1px solid #e5e7eb;
  padding:8px 10px;
  outline:none;
  font-size:14px;
  border-radius:12px 12px 0 0;
}

.mr-select-options{
  max-height:220px;
  overflow-y:auto;
}

.mr-select-option{
  padding:7px 10px;
  cursor:pointer;
  font-size:14px;
}

.mr-select-option:hover,
.mr-select-option.is-active{
  background:#6366f1;
  color:#ffffff;
}

</style>

<section class="member-register">
  <div class="mr-card">
    <div class="mr-head">
      <i class="fa-solid fa-id-card-clip"></i>
      <h2>Member Registration</h2>
    </div>

    <div class="mr-body">
      <form class="auth-register-form" action="{{ route('member.register.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Row: Name / Gender --}}
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-user"></i> Name</label>
            <input type="text" class="mr-input" name="name" placeholder="Name" value="{{ old('name') }}" required>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-venus-mars"></i> Gender</label>
            @php $g = old('gender','Female'); @endphp
            <select class="mr-select" name="gender" required>
              <option value="Male"   @selected($g==='Male')>Male</option>
              <option value="Female" @selected($g==='Female')>Female</option>
              <option value="Trans"  @selected($g==='Trans')>Trans</option>
            </select>
          </div>
        </div>

        {{-- Row: DOB / Father --}}
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-cake-candles"></i> DOB</label>
            <input type="date" class="mr-input" name="dob" value="{{ old('dob') }}">
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-user-tie"></i> Father Name</label>
            <input type="text" class="mr-input" name="father_name" placeholder="Father Name" value="{{ old('father_name') }}">
          </div>
        </div>

        {{-- Row: Profession / Blood Group --}}
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-briefcase"></i> Profession</label>
            @php $prof = old('profession','Student'); @endphp
            <select class="mr-select" name="profession" required>
              <option @selected($prof==='Government Job')>Government Job</option>
              <option @selected($prof==='Private Job')>Private Job</option>
              <option @selected($prof==='Police')>Police</option>
              <option @selected($prof==='Army')>Army</option>
              <option @selected($prof==='Farmer')>Farmer</option>
              <option @selected($prof==='Self Business')>Self Business</option>
              <option @selected($prof==='Student')>Student</option>
              <option @selected($prof==='House Wife')>House Wife</option>
              <option @selected($prof==='Other')>Other</option>
            </select>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-droplet"></i> Blood Group</label>
            @php $bg = old('bloodgroup','A+'); @endphp
            <select class="mr-select" name="bloodgroup" required>
              <option @selected($bg==='A+')>A+</option><option @selected($bg==='B+')>B+</option>
              <option @selected($bg==='O+')>O+</option><option @selected($bg==='AB+')>AB+</option>
              <option @selected($bg==='A-')>A-</option><option @selected($bg==='B-')>B-</option>
              <option @selected($bg==='O-')>O-</option><option @selected($bg==='AB-')>AB-</option>
            </select>
          </div>
        </div>

        {{-- Row: State / City --}}
        <div class="mr-grid">
          <div class="mr-field">
  <label><i class="fa-solid fa-map-location-dot"></i> State</label>
  @php $st = old('state','Delhi (DL)'); @endphp

  {{-- real select used for submit (hidden) --}}
  <select name="state" id="state" required style="display:none;">
    <option value="Delhi (DL)" @selected($st==='Delhi (DL)')>Delhi (DL)</option>
    <option value="Andhra Pradesh (AP)" @selected($st==='Andhra Pradesh (AP)')>Andhra Pradesh (AP)</option>
    <option value="Arunachal Pradesh (AR)" @selected($st==='Arunachal Pradesh (AR)')>Arunachal Pradesh (AR)</option>
    <option value="Assam (AS)" @selected($st==='Assam (AS)')>Assam (AS)</option>
    <option value="Bihar (BR)" @selected($st==='Bihar (BR)')>Bihar (BR)</option>
    <option value="Chhattisgarh (CG)" @selected($st==='Chhattisgarh (CG)')>Chhattisgarh (CG)</option>
    <option value="Dadra and Nagar Haveli (DN)" @selected($st==='Dadra and Nagar Haveli (DN)')>Dadra and Nagar Haveli (DN)</option>
    <option value="Daman and Diu (DD)" @selected($st==='Daman and Diu (DD)')>Daman and Diu (DD)</option>
    <option value="Goa (GA)" @selected($st==='Goa (GA)')>Goa (GA)</option>
    <option value="Gujarat (GJ)" @selected($st==='Gujarat (GJ)')>Gujarat (GJ)</option>
    <option value="Haryana (HR)" @selected($st==='Haryana (HR)')>Haryana (HR)</option>
    <option value="Himachal Pradesh (HP)" @selected($st==='Himachal Pradesh (HP)')>Himachal Pradesh (HP)</option>
    <option value="Jammu and Kashmir (JK)" @selected($st==='Jammu and Kashmir (JK)')>Jammu and Kashmir (JK)</option>
    <option value="Jharkhand (JH)" @selected($st==='Jharkhand (JH)')>Jharkhand (JH)</option>
    <option value="Karnataka (KA)" @selected($st==='Karnataka (KA)')>Karnataka (KA)</option>
    <option value="Kerala (KL)" @selected($st==='Kerala (KL)')>Kerala (KL)</option>
    <option value="Madhya Pradesh (MP)" @selected($st==='Madhya Pradesh (MP)')>Madhya Pradesh (MP)</option>
    <option value="Maharashtra (MH)" @selected($st==='Maharashtra (MH)')>Maharashtra (MH)</option>
    <option value="Manipur (MN)" @selected($st==='Manipur (MN)')>Manipur (MN)</option>
    <option value="Meghalaya (ML)" @selected($st==='Meghalaya (ML)')>Meghalaya (ML)</option>
    <option value="Mizoram (MZ)" @selected($st==='Mizoram (MZ)')>Mizoram (MZ)</option>
    <option value="Nagaland (NL)" @selected($st==='Nagaland (NL)')>Nagaland (NL)</option>
    <option value="Orissa (OR)" @selected($st==='Orissa (OR)')>Orissa (OR)</option>
    <option value="Pondicherry (Puducherry) (PY)" @selected($st==='Pondicherry (Puducherry) (PY)')>Pondicherry (Puducherry) (PY)</option>
    <option value="Punjab (PB)" @selected($st==='Punjab (PB)')>Punjab (PB)</option>
    <option value="Rajasthan (RJ)" @selected($st==='Rajasthan (RJ)')>Rajasthan (RJ)</option>
    <option value="Sikkim (SK)" @selected($st==='Sikkim (SK)')>Sikkim (SK)</option>
    <option value="Tamil Nadu (TN)" @selected($st==='Tamil Nadu (TN)')>Tamil Nadu (TN)</option>
    <option value="Tripura (TR)" @selected($st==='Tripura (TR)')>Tripura (TR)</option>
    <option value="Uttar Pradesh (UP)" @selected($st==='Uttar Pradesh (UP)')>Uttar Pradesh (UP)</option>
    <option value="Uttarakhand (UK)" @selected($st==='Uttarakhand (UK)')>Uttarakhand (UK)</option>
    <option value="West Bengal (WB)" @selected($st==='West Bengal (WB)')>West Bengal (WB)</option>
  </select>

  {{-- custom searchable UI --}}
  <div id="mr-state-custom" class="mr-select-search">
    <div class="mr-select-display">Select State</div>
    <div class="mr-select-dropdown">
      <input type="text" class="mr-select-input" placeholder="Search state...">
      <div class="mr-select-options"></div>
    </div>
  </div>
</div>

<div class="mr-field">
  <label><i class="fa-solid fa-city"></i> City</label>
  <input
      type="text"
      class="mr-input"
      id="city"
      name="city"
      placeholder="City"
      value="{{ old('city') }}"
      required
  >
</div>

        <!-- <div class="mr-field">-->
        <!--<label><i class="fa-solid fa-city"></i> City</label>-->
        <!--@php $ct = old('city'); @endphp-->
        <!--<select class="mr-select" id="city" name="city" required>-->
        <!--    <option value="">Select City</option>-->
        <!--    @if($ct)-->
        <!--        <option value="{{ $ct }}" selected>{{ $ct }}</option>-->
        <!--    @endif-->
        <!--</select>-->
        <!--</div>-->


        {{-- Row: Mobile / Email --}}
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-phone"></i> Mobile</label>
            <input type="tel" class="mr-input" name="mobile" inputmode="numeric" pattern="[6-9][0-9]{9}" maxlength="10" placeholder="10-digit mobile" value="{{ old('mobile') }}" required>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-envelope"></i> Email</label>
            <input type="email" class="mr-input" name="email" placeholder="Email" value="{{ old('email') }}" required>
          </div>
        </div>
        <div class="mr-field">
            <label><i class="fa-solid fa-lock"></i>Password</label>
            <input type="password" class="mr-input" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
          </div>

        {{-- Row: Address / Pincode --}}
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-location-dot"></i> Address</label>
            <input class="mr-input" id="address" name="address" placeholder="Address" value="{{ old('address') }}" required>
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-hashtag"></i> Pincode</label>
            <input type="number" class="mr-input" name="pincode" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" placeholder="Pincode" value="{{ old('pincode') }}" required>
          </div>
        </div>

        {{-- Avatar + Upload --}}
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-image"></i> Profile Photo</label>
            <div class="mr-avatar">
              <img id="avatar-preview" src="{{asset('/frontend/custom/user.png')}}" alt="avatar">
              <div class="btns">
                <label class="btn btn-primary" for="change-picture">Upload</label>
                <input class="mr-file" type="file" name="profile_image" id="change-picture" hidden required accept="image/*" onchange="
                  const f=this.files?.[0];
                  if(f){ const r=new FileReader(); r.onload=e=>document.getElementById('avatar-preview').src=e.target.result; r.readAsDataURL(f); }
                ">
                <button class="btn btn-ghost" type="button" onclick="document.getElementById('change-picture').value=''; document.getElementById('avatar-preview').src='https://ngo.kikdein.test/frontend/custom/user.png'">Remove</button>
              </div>
            </div>
          </div>

          <div class="mr-field">
            <label><i class="fa-solid fa-id-card"></i> Select Id Type</label>
            @php $idtype = old('idtype','Aadhaar Card'); @endphp
            <select class="mr-select" name="idtype" required>
              <option value="Aadhaar Card" @selected($idtype==='Aadhaar Card')>Aadhaar Card</option>
              <option value="Pan card" @selected($idtype==='Pan card')>Pan card</option>
              <option value="Voter Id" @selected($idtype==='Voter Id')>Voter Id</option>
              <option value="Driving Lisence" @selected($idtype==='Driving Lisence')>Driving Lisence</option>
              <option value="Rashan Card" @selected($idtype==='Rashan Card')>Rashan Card</option>
              <option value="Class 10th Marksheet" @selected($idtype==='Class 10th Marksheet')>Class 10th Marksheet</option>
            </select>
          </div>
        </div>

        {{-- Row: ID Upload / Other Docs --}}
        <div class="mr-grid">
          <div class="mr-field">
            <label><i class="fa-solid fa-paperclip"></i> Upload ID Document</label>
            <input type="file" id="brouchure" class="mr-file" name="document" required accept="image/*,.pdf">
          </div>
          <div class="mr-field">
            <label><i class="fa-solid fa-folder-open"></i> Other Documents (optional)</label>
            <input type="file" id="account-upload" class="mr-file" name="other_document" accept="image/*,.pdf">
          </div>
        </div>

        {{-- Hidden status (kept for back-compat) --}}
        <input type="hidden" id="status-hidden" name="status" value="0">

        {{-- Actions --}}
        <div class="mr-actions">
          <button type="submit" class="btn btn-primary btn-wide">Submit</button>
          <button type="reset" class="btn btn-ghost btn-wide" onclick="
            document.getElementById('avatar-preview').src='{{asset("/frontend/custom/user.png")}}'
          ">Reset</button>
        </div>
      </form>

      {{-- Toasts: success/error (fixed, auto-hide) --}}
      @if(session('success') || session('error') || $errors->any())
        <div id="toast"
             style="position:fixed;right:16px;top:16px;max-width:360px;z-index:2147483647;background:#fff;border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 12px 34px rgba(0,0,0,.12);padding:12px 14px;color:#0f172a;">
          <div style="display:flex;gap:8px;align-items:flex-start">
            <div style="font-size:18px;">
              @if(session('success')) ✅ @elseif(session('error') || $errors->any()) ⚠️ @endif
            </div>
            <div style="flex:1;">
              @if(session('success'))
                <div style="font-weight:700;margin-bottom:4px;">Success</div>
                <div>{{ session('success') }}</div>
              @elseif(session('error'))
                <div style="font-weight:700;margin-bottom:4px;">Unable to submit</div>
                <div>{{ session('error') }}</div>
              @elseif($errors->any())
                <div style="font-weight:700;margin-bottom:4px;">Please fix the following:</div>
                <ul style="margin:0;padding-left:18px;">
                  @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                  @endforeach
                </ul>
              @endif
            </div>
            <button onclick="document.getElementById('toast').remove()" style="border:none;background:transparent;cursor:pointer;font-size:16px;line-height:1;margin-left:6px;">✖</button>
          </div>
        </div>
        <script>setTimeout(()=>{ const t=document.getElementById('toast'); if(t) t.remove(); }, 5000);</script>
      @endif

      <p style="text-align:center; margin:18px 0 0; color:var(--muted);">
        Already have an account?
        <a href="{{url('/idcard-download')}}" style="color:var(--brand); text-decoration:none; font-weight:600;">Download Your IdCard</a>
      </p>
    </div>
  </div>
</section>

{{-- Success Modal --}}
<div id="reg-modal" class="modal-backdrop @if(session('success')) open @endif" aria-hidden="true">
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="regModalTitle">
    <div class="modal-head">
      <div id="regModalTitle" class="modal-title">
        <i class="fa-solid fa-circle-check" style="margin-right:8px;"></i>
        @php
          $succ = session('success');
          $succType = session('success_type');
          $isPayment = $succType === 'payment' || (is_string($succ) && (\Illuminate\Support\Str::contains($succ, 'Payment') || \Illuminate\Support\Str::contains($succ, 'Autopay')));
        @endphp
        {{ $isPayment ? 'Payment Successful' : 'Registration Submitted' }}
      </div>
      <button class="modal-close" type="button" aria-label="Close" onclick="closeRegModal()">✖</button>
    </div>

    <div class="modal-body">
      @if(session('success'))
        <div style="font-size:1rem; line-height:1.5;">
          {!! session('success') !!}
        </div>
      @else
        <p style="margin:0 0 6px;">
          Hi <strong>{{ session('member_name') }}</strong>, thanks for registering with us.
        </p>
        <ul>
          <li>Your application status: <strong>Pending verification</strong>.</li>
          <li>We’ll notify you once your ID Card is active.</li>
          <li>You can later download your ID Card from the website.</li>
        </ul>
      @endif
    </div>

    <div class="modal-actions">
      @php $succType = session('success_type'); @endphp
      @if($succType !== 'payment')
        <a href="{{ route('payment') }}" class="btn btn-primary">Proceed To Pay</a>
      @endif
      <a href="{{ route('member.register.show') }}" class="btn btn-primary">Register Another Member</a>
      <a href="{{ url('/') }}" class="btn btn-ghost">Go to Homepage</a>
    </div>
  </div>
</div>

<script>
// Ensure modal close works from header button, ESC key, and backdrop click
function closeRegModal() {
  var el = document.getElementById('reg-modal');
  if (!el) return;
  el.classList.remove('open');
  el.setAttribute('aria-hidden', 'true');
}
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') closeRegModal();
});
document.addEventListener('click', function (e) {
  var el = document.getElementById('reg-modal');
  if (!el || !el.classList.contains('open')) return;
  if (e.target === el) closeRegModal();
});
// Make available globally in case of inline onclick
window.closeRegModal = closeRegModal;
</script>

<script>
(() => {
  const doc = window.document; // avoid any accidental shadowing
  const input = doc.getElementById('change-picture');
  const img   = doc.querySelector('.mr-avatar img');

  if (!input || !img) return;

  input.addEventListener('change', (e) => {
    const file = e.target.files && e.target.files[0];
    if (!file) return; // user canceled

    // only preview images
    if (!/^image\//i.test(file.type)) {
      // optional: you can show a toast here
      return;
    }

    const reader = new FileReader();
    reader.onload = (ev) => { img.src = ev.target.result || img.src; };
    reader.readAsDataURL(file);
  });
})();
</script>

<script>
(function () {
    const select  = document.getElementById('state');
    const wrapper = document.getElementById('mr-state-custom');
    if (!select || !wrapper) return;

    const display  = wrapper.querySelector('.mr-select-display');
    const dropdown = wrapper.querySelector('.mr-select-dropdown');
    const input    = wrapper.querySelector('.mr-select-input');
    const listBox  = wrapper.querySelector('.mr-select-options');

    const items = [];

    // Build list from hidden <select> options
    for (let i = 0; i < select.options.length; i++) {
        const opt = select.options[i];
        if (!opt.value) continue;

        const div = document.createElement('div');
        div.className = 'mr-select-option';
        div.textContent = opt.text;
        div.dataset.value = opt.value;
        listBox.appendChild(div);
        items.push(div);
    }

    function openDropdown() {
        wrapper.classList.add('is-open');
        input.value = '';
        filterOptions('');
        input.focus();
    }

    function closeDropdown() {
        wrapper.classList.remove('is-open');
    }

    function filterOptions(term) {
        const t = term.toLowerCase();
        items.forEach(el => {
            const match = el.textContent.toLowerCase().includes(t);
            el.style.display = match ? 'block' : 'none';
        });
    }

    // click on “Select State” box
    display.addEventListener('click', function (e) {
        e.stopPropagation();
        if (wrapper.classList.contains('is-open')) {
            closeDropdown();
        } else {
            openDropdown();
        }
    });

    // typing in search box
    input.addEventListener('input', function () {
        filterOptions(this.value);
    });

    // choose an option
    listBox.addEventListener('click', function (e) {
        const item = e.target.closest('.mr-select-option');
        if (!item) return;

        select.value = item.dataset.value;      // update real select
        display.textContent = item.textContent; // show selected text

        closeDropdown();
    });

    // close when clicking outside
    document.addEventListener('click', function (e) {
        if (!wrapper.contains(e.target)) {
            closeDropdown();
        }
    });

    // On load, if a state already selected (old() value), reflect it
    if (select.value) {
        const selectedOpt = select.options[select.selectedIndex];
        if (selectedOpt) {
            display.textContent = selectedOpt.text;
        }
    }
})();


</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const stateSelect = document.getElementById('state');
    const citySelect  = document.getElementById('city');
    if (!stateSelect || !citySelect) return;

    function loadCities(selectedCity = null) {
        const sid = stateSelect.value;
        if (!sid) {
            citySelect.innerHTML = '<option value="">Select City</option>';
            return;
        }

        fetch("{{ url('fetch.cities') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ sid })
        })
        .then(res => res.text())
        .then(html => {
            citySelect.innerHTML = html;

            if (selectedCity) {
                Array.from(citySelect.options).forEach(opt => {
                    if (opt.value === selectedCity) {
                        opt.selected = true;
                    }
                });
            }
        })
        .catch(err => {
            console.error('Error loading cities:', err);
        });
    }

    // When state changes (triggered by our custom widget)
    stateSelect.addEventListener('change', () => loadCities());

    // On first load, if old state/city exist, pre-fill
    @if(old('state'))
        loadCities(@json(old('city')));
    @endif
});
</script>
