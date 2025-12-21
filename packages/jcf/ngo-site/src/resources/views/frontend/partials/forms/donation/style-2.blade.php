
<style>
:root{
  --brand:#f55c3e;
  --brand-600:#e24b2d;
  --ink:#0f3a3e;
  --text:#1f2937;
  --muted:#6b7280;
  --line:#e5e7eb;
  --card:#ffffff;
  --bg:#f9fafb;
  --radius:14px;
  --shadow:0 10px 26px rgba(0,0,0,.08);
  font-family: system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;
}
.don-wrap{
  background:var(--bg);
  padding:14px;
  display:flex; justify-content:center;
}
.don-card{
  width:100%; max-width:440px;
  background:var(--card);
  border:1px solid #f0f0f0; border-radius:18px;
  box-shadow:var(--shadow);
  padding:16px 14px 18px;
}
.title{
  color:var(--ink); text-align:center; font-weight:800;
  font-size:20px; margin:4px 0 14px;
}

/* Amount grid */
.grid-amt{
  display:grid; grid-template-columns:1fr 1fr; gap:12px;
}
.chip{
  border:2px solid #dbe0e6; border-radius:12px;
  background:#fff; padding:12px 0; text-align:center;
  font-weight:800; font-size:16px; color:#1b2b34;
}
.chip.active{
  background:var(--brand); color:#fff; border-color:#ffcabf;
  box-shadow:0 6px 16px rgba(245,92,62,.35);
}

/* inputs */
.field{ margin-top:12px; }
.label{ font-size:13px; color:#374151; font-weight:700; margin:0 0 6px 2px; }
.input, .select{
  width:100%; border:2px solid var(--line); border-radius:12px;
  background:#fff; padding:12px 12px; font-size:15px;
}
.input:focus, .select:focus{ outline:none; border-color:#b4c7ff; box-shadow:0 0 0 3px rgba(68,99,221,.15); }
.inline2{ display:grid; grid-template-columns:1fr 1fr; gap:12px; }

/* helper card */
.helper{
  margin-top:12px; border:2px solid #ffd8b8; background:#fff5ea;
  border-radius:12px; padding:12px; color:#8a520d; font-size:14px; line-height:1.45;
}
.helper b{ color:#b5471a; }

/* tax note */
.note{
  margin-top:12px; border:2px solid #b4f3c7; background:#ecfff3;
  border-radius:12px; padding:12px; color:#165e2b; font-size:14px;
}

/* CTA */
.btn{
  width:100%; margin-top:14px; border:none;
  background:var(--brand); color:#fff; border-radius:14px;
  padding:14px 14px; font-size:16px; font-weight:900;
  box-shadow:0 10px 22px rgba(245,92,62,.30);
}
.btn:active{ background:var(--brand-600); }

/* footer trust */
.trust{
  display:flex; gap:8px; align-items:center; justify-content:center;
  color:#8b97a3; margin-top:10px; font-size:12px;
}
.trust i{ font-style:normal }
</style>

<div class="don-wrap">
  <form class="don-card" id="donationForm" onsubmit="return false">
    <div class="title">Make a Donation</div>

    <div class="label">Select Amount (₹)</div>
    <div class="grid-amt" id="presetGrid">
      <button type="button" class="chip" data-amt="1000">₹1,000</button>
      <button type="button" class="chip" data-amt="2500">₹2,500</button>
      <button type="button" class="chip active" data-amt="5000">₹5,000</button>
      <button type="button" class="chip" data-amt="10000">₹10,000</button>
    </div>

    <div class="field">
      <input class="input" id="amountInput" type="number" min="1" placeholder="₹  5000" inputmode="numeric">
    </div>

    <div class="helper" id="impactBox">
      <b>Your ₹5,000 can:</b><br>
      Provide education support for 10 children for a month
    </div>

    <div class="field">
      <div class="label">Full Name *</div>
      <input class="input" id="fullName" placeholder="Enter your full name" required>
    </div>

    <div class="field">
      <div class="label">Email Address *</div>
      <input class="input" id="email" type="email" placeholder="Enter your email" required>
    </div>

    <div class="field">
      <div class="label">Phone Number *</div>
      <input class="input" id="phone" type="tel" maxlength="10" inputmode="numeric" placeholder="Enter your phone number" required>
    </div>

    <div class="field">
      <div class="label">Date of Birth *</div>
      <input class="input" id="dob" type="date" required>
    </div>

    <div class="field">
      <div class="label">PAN No. *</div>
      <input class="input" id="pan" maxlength="10" placeholder="Enter your PAN number" required>
    </div>

    <div class="field">
      <div class="label">Address *</div>
      <input class="input" id="address" placeholder="Enter your address" required>
    </div>

    <div class="field inline2">
      <div>
        <div class="label">City *</div>
        <input class="input" id="city" placeholder="Enter your city" required>
      </div>
      <div>
        <div class="label">State *</div>
        <input class="input" id="state" placeholder="Enter your state" required>
      </div>
    </div>

    <div class="field">
      <div class="label">Pincode *</div>
      <input class="input" id="pincode" inputmode="numeric" maxlength="6" placeholder="Enter your pincode" required>
    </div>

    <div class="note">💰 <b>Tax Benefit:</b> Get 50% tax deduction under Section 80G</div>

    <button class="btn" id="payBtn">Donate ₹5,000 Now</button>

    <div class="trust"><i>🔒</i> Secure payment powered by Razorpay</div>
  </form>
</div>

<script>
(function(){
  const presetGrid = document.getElementById('presetGrid');
  const amountInput = document.getElementById('amountInput');
  const impactBox = document.getElementById('impactBox');
  const payBtn = document.getElementById('payBtn');

  const presets = {
    1000: 'Provide nutrition for 2 elders for a week',
    2500: 'Support medicines for 5 elders',
    5000: 'Provide education support for 10 children for a month',
    10000:'Fund a community health camp'
  };

  function formatINR(n){
    n = Number(n||0);
    return n.toLocaleString('en-IN');
  }

  function setActive(amt){
    // set chip active
    [...presetGrid.querySelectorAll('.chip')].forEach(ch=>{
      ch.classList.toggle('active', Number(ch.dataset.amt) === Number(amt));
    });
    // update input placeholder + impact + CTA
    amountInput.placeholder = '₹  ' + formatINR(amt);
    impactBox.innerHTML = `<b>Your ₹${formatINR(amt)} can:</b><br>${presets[amt] || 'Create real impact for people in need'}`;
    payBtn.textContent = `Donate ₹${formatINR(amt)} Now`;
    payBtn.dataset.amount = amt;
  }

  // default active (5000)
  setActive(5000);

  // Click on preset
  presetGrid.addEventListener('click', (e)=>{
    const chip = e.target.closest('.chip');
    if(!chip) return;
    const amt = Number(chip.dataset.amt);
    amountInput.value = '';
    setActive(amt);
  });

  // Custom amount typing
  amountInput.addEventListener('input', ()=>{
    const val = Number(amountInput.value);
    if(!val || val < 1){ return; }
    [...presetGrid.querySelectorAll('.chip')].forEach(c=>c.classList.remove('active'));
    impactBox.innerHTML = `<b>Your ₹${formatINR(val)} can:</b><br>Create real impact for people in need`;
    payBtn.textContent = `Donate ₹${formatINR(val)} Now`;
    payBtn.dataset.amount = val;
  });

  // Submit (replace with your gateway)
  payBtn.addEventListener('click', (e)=>{
    e.preventDefault();
    const amount = Number(payBtn.dataset.amount || 5000);
    const required = ['fullName','email','phone','dob','pan','address','city','state','pincode'];
    for(const id of required){
      const el = document.getElementById(id);
      if(!el || !el.value.trim()){ el.focus(); alert('Please complete the form.'); return; }
    }
    // Build payload (ready to POST to backend or init Razorpay)
    const payload = {
      amount,
      donor:{
        name:document.getElementById('fullName').value.trim(),
        email:document.getElementById('email').value.trim(),
        phone:document.getElementById('phone').value.trim(),
        dob:document.getElementById('dob').value,
        pan:document.getElementById('pan').value.trim(),
        address:document.getElementById('address').value.trim(),
        city:document.getElementById('city').value.trim(),
        state:document.getElementById('state').value.trim(),
        pincode:document.getElementById('pincode').value.trim(),
      }
    };
    console.log('DONATION PAYLOAD →', payload);
    alert(`Proceed to payment: ₹${formatINR(amount)}`);
    // Example to POST:
    // fetch('/donate', {method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:JSON.stringify(payload)})
  });
})();
</script>
