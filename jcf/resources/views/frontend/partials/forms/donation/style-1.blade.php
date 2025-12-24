<!-- DONATION (scoped, mobile-first, conflict-safe) -->
<style>
.donate, .donate * { box-sizing: border-box; }

/* THEME */
.donate{
  --brand:#ff4d4d;     /* heart accent */
  --amber:#ffc727;     /* yellow highlight */
  --amber-600:#ffb300;
  --navy:#0f2230;      /* dark CTA */
  --ink:#1f2937;
  --muted:#6b7280;
  --line:#e5e7eb;
  --bg:#fafafa;
  --card:#ffffff;
  --radius:14px;
  --shadow:0 10px 28px rgba(0,0,0,.08);
  font-family: system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;
}

/* wrapper + card */
.donate .dn-wrap{ background:var(--bg); padding:14px; }
.donate .dn-card{
  max-width:520px; margin:0 auto; background:var(--card);
  border:1px solid #f2f2f2; border-radius:18px; box-shadow:var(--shadow);
  overflow:visible; position:relative;
  isolation:isolate;           /* isolate layer without transforms */
  backface-visibility:hidden;
}
/* remove decorative bottom strip (white patch) */
.donate .dn-card::after{ content:none !important; }

/* header tabs */
.donate .dn-tabs{ display:flex; gap:10px; padding:12px; }
.donate .dn-tab{
  flex:1; min-width:0;
  display:flex; align-items:center; justify-content:center; gap:8px;
  padding:10px 12px; border-radius:12px; border:1.6px solid #cfe9d6;
  background:#f4fbf6; color:#0b5133; font-weight:700; font-size:14px;
}
.donate .dn-tab i{ font-style:normal }
.donate .dn-tab.is-inactive{ background:#fff; border-color:#d7dbe0; color:#111; }

/* subnote */
.donate .dn-note{
  margin:0 12px 12px; padding:10px 12px; border-radius:10px;
  background:#fff4d6; color:#4a3c12; font-size:13px; border:1px dashed #e6c36c;
  display:flex; align-items:center; gap:8px;
}

/* sections */
.donate .dn-section{ padding:0 12px 14px; }
.donate .dn-row{ display:flex; gap:10px; }
.donate .dn-row .flex{ flex:1; min-width:0; }

/* toggle chips */
.donate .toggle{ display:flex; gap:10px; margin:8px 0 12px; }
.donate .tchip{
  flex:1; min-width:0;
  display:flex; align-items:center; justify-content:center; gap:8px;
  border-radius:10px; padding:12px 10px; font-weight:700; font-size:14px;
  border:1.6px solid #e7eaef; background:#f4f5f7; color:#111;
}
.donate .tchip .heart{ color:var(--brand); font-size:16px }
.donate .tchip.is-active{ background:var(--amber); border-color:#e7b218; }

/* amount chips */
.donate .amounts{ display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-bottom:10px; }
.donate .achip{
  border-radius:10px; padding:12px 0; text-align:center; font-weight:800;
  border:1.6px solid #e7eaef; background:#f4f5f7; min-width:0;
}
.donate .achip.is-active{ background:#111; color:#fff; border-color:#111; }

/* labels/inputs */
.donate .field{ margin:10px 0; }
.donate .label{ font-size:13px; color:#111; margin:0 0 6px 2px; font-weight:700; }
.donate .input{
  width:100%; padding:12px 12px; border-radius:10px;
  border:1.6px solid var(--line); background:#fff; font-size:15px; max-width:100%;
}
.donate .input:focus{ outline:none; box-shadow:0 0 0 3px rgba(255,199,39,.35); border-color:#ffcf5a; }

/* SELECT: wrapper + custom arrow (no native arrow glitches) */
.donate .select-wrap{
  position:relative; border:1.6px solid var(--line); border-radius:10px; background:#fff;
  overflow:hidden;  /* hides any first-paint edge */
}
.donate .select-wrap:after{
  content:""; position:absolute; right:12px; top:50%; translate:0 -50%;
  width:18px; height:18px; pointer-events:none;
  background:center/contain no-repeat url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%238A8F98' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
}
.donate .select{
  -webkit-appearance:none; appearance:none; border:0; width:100%;
  padding:12px 44px 12px 12px; font-size:15px; background:transparent; border-radius:10px;
}
.donate .select:focus{ outline:none; }
.donate .select-wrap:has(.select:focus){
  box-shadow:0 0 0 3px rgba(255,199,39,.35); border-color:#ffcf5a;
}
.donate select::-ms-expand{ display:none; }

/* CTA buttons */
/* single button row */
.donate .cta{ display:block; margin-top:12px; }
.donate .cta .btn{
  display:block; width:100%; border:none; padding:13px 14px;
  border-radius:12px; font-weight:800; font-size:15px;
}
/* two buttons row */
.donate .cta.-split{ display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:12px; }
.donate .cta.-split .btn{ width:100%; }

/* button colors */
.donate .btn-dark{ background:var(--navy); color:#fff; }
.donate .btn-dark:active{ opacity:.9 }
.donate .btn-amber{ background:var(--amber); }
.donate .btn-amber:active{ background:var(--amber-600); }

/* info panel (SCOPED) */
.donate .info{
  margin:14px 12px 12px; border-radius:10px; border:1.6px dashed #e6c36c;
  background:#fff9e8; color:#7a5a17; padding:12px 12px; font-size:13px; line-height:1.45;
}
.donate .info strong{ color:#333; }

/* footer login */
.donate .dn-footer{
  margin:10px 12px 16px; background:var(--amber); border-radius:10px;
  display:flex; align-items:center; justify-content:center; gap:10px;
  padding:12px 10px; font-weight:800;
}

/* stepper */
.donate .step{ display:none; }
.donate .step.is-active{ display:block; }

/* step 2 grid */
.donate .form{ padding:0 12px 14px; }
.donate .twocol{ display:grid; grid-template-columns:1fr; gap:12px; }
@media (min-width:380px){ .donate .twocol{ grid-template-columns:1fr 1fr; } }
.donate .hint{ font-size:12px; color:#8a8f98; margin:6px 2px 0; }

/* radios inline */
.donate .inline{ display:flex; gap:14px; align-items:center; margin-top:8px; flex-wrap:wrap; }
.donate .inline label{ display:flex; gap:8px; align-items:center; font-size:14px; }
</style>

<div class="donate">
  <div class="dn-wrap">
    <div class="dn-card" id="donateCard">

      <!-- Tabs -->
      <div class="dn-tabs">
        <button class="dn-tab" id="tabIndian"><i>✅</i> Indian Citizens</button>
        <button class="dn-tab is-inactive" id="tabForeign"><i>⭕</i> Foreign Citizens/OCI</button>
      </div>

      <!-- Subnote -->
      <div class="dn-note" id="passportNote">
        <span>ℹ️</span> <span id="noteText">For Indian Passport holders</span>
      </div>

      <!-- STEP 1 -->
      <div class="dn-section step is-active" id="step1">
        <div class="toggle" id="freqToggle">
          <button class="tchip is-active" data-freq="onetime"><span class="heart">❤️</span> One Time</button>
          <button class="tchip" data-freq="monthly"><span class="heart">❤️</span> Monthly</button>
        </div>

        <div class="amounts" id="amountGrid">
          <button class="achip is-active" data-amt="5000">₹5000</button>
          <button class="achip" data-amt="15000">₹15000</button>
          <button class="achip" data-amt="20000">₹20000</button>
        </div>

        <div class="field dn-row">
          <div class="flex">
            <div class="label">Enter Your Own Amount <span style="color:#ef4444">*</span></div>
            <input class="input" id="ownAmount" type="number" placeholder="5000" min="1" inputmode="numeric">
          </div>
        </div>

        <div class="field">
          <div class="label">I Pledge My Support For <span style="color:#ef4444">*</span></div>
          <div class="select-wrap">
            <select class="select" id="pledgeFor">
              <option value="Elder Care">Elder Care</option>
              <option value="Healthcare">Healthcare</option>
              <option value="Education">Education</option>
              <option value="Relief">Relief</option>
            </select>
          </div>
        </div>

        <div class="cta">
          <button class="btn btn-dark" id="nextToForm">Next</button>
        </div>

        <div class="info">
          As per Indian Income Tax rules, a donor with Indian passport is required to add their Address and PAN number in case they wish to receive the 80G tax-exemption certificate.
          <br><br><strong>No refunds</strong> will be entertained after the instant tax exemption has been issued.
        </div>

        <div class="dn-footer">🪪 Donor Login</div>
      </div>

      <!-- STEP 1B -->
      <div class="dn-section step" id="foreignPane">
        <div class="info" style="background:#eef8ff; border-color:#b6dbff; color:#103a56;">
          For citizens having Passport of any country other than India, we prefer receiving donations through our US entity.
          <br><br>US Donors can avail <strong>100% Tax Exemption in USA</strong> under 501(c)(3) and EIN number is <strong>83-3780707</strong>.
          <br><br>Click submit to be redirected.
        </div>
        <div class="cta">
          <button class="btn btn-dark" id="foreignSubmit">Submit →</button>
        </div>
      </div>

      <!-- STEP 2 -->
      <div class="form step" id="step2">
        <div class="twocol">
          <div>
            <div class="label">First Name <span style="color:#ef4444">*</span></div>
            <input class="input" id="firstName" placeholder="First Name">
          </div>
          <div>
            <div class="label">Last Name</div>
            <input class="input" id="lastName" placeholder="Last Name">
          </div>
        </div>

        <div class="twocol">
          <div>
            <div class="label">Email <span style="color:#ef4444">*</span></div>
            <input class="input" id="email" type="email" placeholder="Email">
          </div>
          <div>
            <div class="label">Mobile Number <span style="color:#ef4444">*</span></div>
            <input class="input" id="mobile" type="tel" placeholder="Mobile Number" maxlength="10" inputmode="numeric">
          </div>
        </div>

        <div class="twocol">
          <div>
            <div class="label">Date of Birth</div>
            <input class="input" id="dob" type="date">
          </div>
          <div>
            <div class="label">PAN Number</div>
            <input class="input" id="pan" placeholder="PAN Number" maxlength="10">
          </div>
        </div>

        <div class="field">
          <div class="label">Street Address <span style="color:#ef4444">*</span></div>
          <input class="input" id="address" placeholder="Street Address">
        </div>

        <div class="twocol">
          <div>
            <div class="label">Zip/ Postal Code</div>
            <input class="input" id="zip" placeholder="Zip/ Postal Code" inputmode="numeric">
          </div>
          <div>
            <div class="label">City <span style="color:#ef4444">*</span></div>
            <input class="input" id="city" placeholder="City">
          </div>
        </div>

        <div class="field">
          <div class="label">State/Province <span style="color:#ef4444">*</span></div>
          <div class="select-wrap">
            <select class="select" id="state">
              <option value="">Select</option>
              <option>Delhi</option><option>Punjab</option><option>Maharashtra</option>
              <option>Uttar Pradesh</option><option>Karnataka</option><option>Other</option>
            </select>
          </div>
        </div>

        <div class="field">
          <div class="label">Are you an existing donor? <span style="color:#ef4444">*</span></div>
          <div class="inline">
            <label><input type="radio" name="existing" value="Yes"> Yes</label>
            <label><input type="radio" name="existing" value="No" checked> No</label>
          </div>
        </div>

        <label class="inline" style="align-items:flex-start;margin-top:8px;">
          <input type="checkbox" id="consent" checked>
          <span class="hint" style="max-width:36ch">
            By sharing your details, you agree to receive tax receipt, stories and updates via mobile, WhatsApp, email, and post.
          </span>
        </label> 
        <input type="hidden" name="campaign" value="General Fund"> 

        <div class="cta -split">
          <button class="btn btn-amber" id="backToAmounts">Back</button>
          <button class="btn btn-dark" id="payNow">Pay Now</button>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
(function(){
  const tabIndian  = document.getElementById('tabIndian');
  const tabForeign = document.getElementById('tabForeign');
  const note       = document.getElementById('passportNote');
  const noteText   = document.getElementById('noteText');

  const step1      = document.getElementById('step1');
  const foreignPane= document.getElementById('foreignPane');
  const step2      = document.getElementById('step2');

  const freqToggle = document.getElementById('freqToggle');
  const amountGrid = document.getElementById('amountGrid');
  const ownAmount  = document.getElementById('ownAmount');
  const pledgeFor  = document.getElementById('pledgeFor');

  let state = { citizen:'indian', freq:'onetime', amount:5000 };

  tabIndian.addEventListener('click', ()=>{
    state.citizen='indian';
    tabIndian.classList.remove('is-inactive');
    tabForeign.classList.add('is-inactive');
    note.style.display='flex'; noteText.textContent='For Indian Passport holders';
    step1.classList.add('is-active'); foreignPane.classList.remove('is-active'); step2.classList.remove('is-active');
  });

  tabForeign.addEventListener('click', ()=>{
    state.citizen='foreign';
    tabForeign.classList.remove('is-inactive');
    tabIndian.classList.add('is-inactive');
    note.style.display='flex'; noteText.textContent='For citizens with passports other than India';
    step1.classList.remove('is-active'); foreignPane.classList.add('is-active'); step2.classList.remove('is-active');
  });

  freqToggle.addEventListener('click', e=>{
    const btn = e.target.closest('.tchip'); if(!btn) return;
    [...freqToggle.children].forEach(b=>b.classList.remove('is-active')); btn.classList.add('is-active');
    state.freq = btn.dataset.freq;
    amountGrid.innerHTML = (state.freq==='monthly')
      ? `<button class="achip" data-amt="500">₹500</button>
         <button class="achip" data-amt="1000">₹1000</button>
         <button class="achip is-active" data-amt="2000">₹2000</button>`
      : `<button class="achip is-active" data-amt="5000">₹5000</button>
         <button class="achip" data-amt="15000">₹15000</button>
         <button class="achip" data-amt="20000">₹20000</button>`;
    attachAmountClicks();
  });

  function attachAmountClicks(){
    amountGrid.querySelectorAll('.achip').forEach(ch=>{
      ch.addEventListener('click', ()=>{
        amountGrid.querySelectorAll('.achip').forEach(x=>x.classList.remove('is-active'));
        ch.classList.add('is-active');
        state.amount = parseInt(ch.dataset.amt,10);
        ownAmount.value = state.amount;
      });
    });
    const active=amountGrid.querySelector('.achip.is-active');
    if(active){ state.amount=parseInt(active.dataset.amt,10); ownAmount.value=state.amount; }
  }
  attachAmountClicks();

  ownAmount.addEventListener('input', ()=>{
    const v=parseInt(ownAmount.value||0,10);
    state.amount = isNaN(v)?0:v;
    amountGrid.querySelectorAll('.achip').forEach(x=>x.classList.remove('is-active'));
  });

  document.getElementById('nextToForm').addEventListener('click', ()=>{
    if(!state.amount || state.amount<1){ ownAmount.focus(); return; }
    step1.classList.remove('is-active'); step2.classList.add('is-active');
    window.scrollTo({top:0, behavior:'smooth'});
  });

  document.getElementById('backToAmounts').addEventListener('click', ()=>{
    step2.classList.remove('is-active'); step1.classList.add('is-active');
    window.scrollTo({top:0, behavior:'smooth'});
  });

  document.getElementById('foreignSubmit').addEventListener('click', ()=>{
    alert('Redirecting to international donations gateway…');
  });

  document.getElementById('payNow').addEventListener('click', ()=>{
    const payload = {
      citizen: state.citizen,
      frequency: state.freq,
      amount: state.amount,
      purpose: (document.getElementById('pledgeFor')||{}).value,
      donor: {
        first_name: (document.getElementById('firstName')||{}).value?.trim(),
        last_name : (document.getElementById('lastName')||{}).value?.trim(),
        email     : (document.getElementById('email')||{}).value?.trim(),
        mobile    : (document.getElementById('mobile')||{}).value?.trim(),
        dob       : (document.getElementById('dob')||{}).value,
        pan       : (document.getElementById('pan')||{}).value?.trim(),
        address   : (document.getElementById('address')||{}).value?.trim(),
        zip       : (document.getElementById('zip')||{}).value?.trim(),
        city      : (document.getElementById('city')||{}).value?.trim(),
        state     : (document.getElementById('state')||{}).value,
        existing  : (document.querySelector('input[name="existing"]:checked')||{}).value || 'No',
        consent   : document.getElementById('consent')?.checked ? 1 : 0,
      }
    };
    if(!payload.donor.first_name || !payload.donor.email || !payload.donor.mobile || !payload.donor.address || !payload.donor.city || !payload.donor.state){
      alert('Please fill all required fields.'); return;
    }
    console.log('PAYLOAD →', payload);
    alert('Proceed to gateway with amount ₹'+payload.amount+' ('+payload.frequency+')');
  });

  /* one-time layout settle to avoid any first-paint hiccup */
  requestAnimationFrame(() => { void document.getElementById('donateCard').offsetWidth; });
})();
</script>
