<!-- Stylish Mini Donation Form + Live QR (self-contained) -->
<style>
:root{
  --brand:#ec058e; --brand2:#00a5e2;         /* your red/peach theme */
  --ink:#0f2230; --muted:#6b7280;
  --line:#e9edf3; --card:#fff; --bg:#fafafb;
  --radius:16px; --shadow:0 10px 28px rgba(0,0,0,.10);
  font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
}
.qrwrap{min-height:100dvh;
  var(--bg); padding:16px; display:flex; justify-content:center;}
.qrcard{width:100%; max-width:460px; background:var(--card); border:1px solid var(--line);
  border-radius:22px; box-shadow:var(--shadow); overflow:hidden;}
.qrhead{display:flex; gap:10px; align-items:center; color:#fff;
  background:linear-gradient(135deg,var(--brand),var(--brand2)); padding:14px 16px;}
.qrhead .logo{width:34px; height:34px; border-radius:50%; background:#fff8; display:grid; place-items:center; font-weight:900;}
.qrhead h3{margin:0; font-size:16px; line-height:1.1; font-weight:800;}
.qrbody{padding:16px;}
/* Fields */
.field{margin-top:12px;}
.label{font-size:13px; color:#1f2d3a; font-weight:700; margin:0 0 6px 2px;}
.input{width:100%; border:1.6px solid var(--line); background:#fff; border-radius:12px; padding:12px; font-size:15px;}
.input:focus{outline:none; border-color:#ffb27b; box-shadow:0 0 0 3px rgba(255,148,77,.25);}
.small{font-size:12px; color:var(--muted); margin-top:6px;}
/* QR panel */
.qrpanel{margin-top:14px; border:1.6px dashed #ffd0b8; background:#fff7f2; border-radius:16px; padding:14px;}
.qrbox{display:flex; gap:14px; align-items:center;}
.qrimg{width:140px; height:140px; border-radius:12px; background:#fff; border:1px solid #ffe4d6; display:grid; place-items:center; overflow:hidden;}
.qrmeta{flex:1;}
.qrmeta h4{margin:0 0 6px; font-size:15px; color:#7b321b;}
.qrmeta p{margin:0; font-size:13px; color:#8a4a2b;}
/* Buttons */
.actions{display:flex; gap:10px; margin-top:14px;}
.btn{flex:1; border:none; padding:12px; border-radius:12px; font-weight:800; font-size:15px;}
.btn-dark{background:#0f2230; color:#fff;}
.btn-grad{background:linear-gradient(135deg,var(--brand),var(--brand2)); color:#fff; box-shadow:0 10px 20px rgba(255,77,77,.25);}
.btn-ghost{background:#f3f5f8; color:#0f2230; border:1px solid #e1e5eb;}
/* Divider */
.div{height:1px; background:linear-gradient(90deg,transparent,#eee,transparent); margin:14px 0;}
/* Footer trust */
.trust{display:flex; gap:8px; align-items:center; justify-content:center; color:#95a0ad; font-size:12px; margin:10px 0 4px;}
</style>

<div class="qrwrap">
  <form class="qrcard" id="miniDonate" onsubmit="return false">
    <div class="qrhead">
      <div class="logo">❤</div>
      <div>
        <h3>Quick Donate via UPI</h3>
        <div style="opacity:.9;font-size:12px;font-weight:600;">Scan &amp; pay in seconds</div>
      </div>
    </div>

    <div class="qrbody">
      <!-- Basic details -->
       <form method="POST" action="{{ route('donate.start') }}">
        @csrf
      <div class="field">
        <div class="label">Full Name *</div>
        <input class="input" id="name" name="name" placeholder="Your full name" required>
      </div>
      <div class="field">
        <div class="label">Email *</div>
        <input class="input" id="email" type="email" name="email" placeholder="you@example.com" required>
      </div>
       <div class="field">
        <div class="label">Mobile *</div>
        <input class="input" id="mobile" type="number"  name="mobile" placeholder="you@example.com" required>
      </div>
      <div class="field">
        <div class="label">PAN *</div>
        <input class="input" id="pan" maxlength="10" name="pan_no"  placeholder="ABCDE1234F" required>
        <div class="small">PAN helps us issue your 80G tax receipt.</div>
      </div>
       <div class="field">
        <div class="label">State *</div>
        <input class="input" id="state" type="text"  name="state" placeholder="" required>
      </div>
        <div class="field">
        <div class="label">City *</div>
        <input class="input" id="city" type="text"  name="city" placeholder="" required>
      </div>
       <div class="field">
        <div class="label">Address *</div>
        <input class="input" id="address" type="text"  name="address" placeholder="" required>
      </div>
       <div class="field">
        <div class="label">Pincode *</div>
        <input class="input" id="pincode" type="text"  name="pincode" placeholder="" required>
      </div>
        
      <input type="hidden" name="campaign" value="General Fund"> 


      <!-- Optional amount (you can remove this if you want fixed amount) -->
      <div class="field">
        <div class="label">Amount (₹)</div>
        <input class="input" id="amount" type="number" min="1" name="amount" placeholder="e.g. 1000" inputmode="numeric">
      </div>

      <!-- QR panel -->
      <div class="qrpanel">
        <div class="qrbox">
          <div class="qrimg">
            <!-- live QR -->
            <img id="qrImage" src="" alt="UPI QR" style="width:100%;height:100%;object-fit:contain;">
          </div>
          <div class="qrmeta">
            <h4 id="qrTitle">Scan & Pay to NGO</h4>
            <p id="qrDesc">UPI: <b id="upiShow">narinderverma2007@okaxis</b><br>Amount: <b id="amtShow">—</b></p>
            <div class="actions" style="margin-top:10px;">
              <button class="btn btn-ghost" type="button" id="downloadQR">Download</button>
              <button class="btn btn-grad" type="button" id="refreshQR">Refresh</button>
            </div>
          </div>
        </div>
      </div>

      <div class="div"></div>
      <input type="hidden" name="campaign" value="General Fund"> 

      <div class="actions">
        <button class="btn btn-dark" type="submit"  type="button" id="submitBtn">Submit To Pay</button>
        <button class="btn btn-grad" type="button" id="upiIntent">Open UPI App</button>
      </div>

      <div class="trust">🔒 Secure — UPI handled by your bank app</div>
    </div>
  </form>
</div>

<script>
/*
  Minimal, dependency-free QR flow using a public image endpoint.
  Change THESE two constants to your real values:
*/
const NGO_UPI_ID   = 'narinderverma2007@okaxis';                 // your VPA
const NGO_NAME     = '{{$setting->title}}';            // receiver name (UPI)
const DEFAULT_AMT  = 500;                        // default amount if none typed
const NOTE_PREFIX  = 'Donation';                 // remark in UPI app

// Build UPI URI
function upiUri(amount){
  const am = Number(amount) > 0 ? Number(amount).toFixed(2) : '';
  const params = new URLSearchParams({
    pa: NGO_UPI_ID,
    pn: NGO_NAME,
    cu: 'INR',
    tn: NOTE_PREFIX
  });
  if(am) params.set('am', am);
  return `upi://pay?${params.toString()}`;
}

// Generate QR src (using qrserver image API)
function qrSrc(str){
  const size = 300; // high-res; we downscale in UI
  const url = `https://api.qrserver.com/v1/create-qr-code/?size=${size}x${size}&margin=0&data=${encodeURIComponent(str)}`;
  return url;
}

function formatINR(n){
  const x = Number(n||0);
  return x ? x.toLocaleString('en-IN') : '—';
}

function refreshQR(){
  const amtInput = document.getElementById('amount').value;
  const amount = Number(amtInput) > 0 ? Number(amtInput) : '';
  const uri = upiUri(amount || DEFAULT_AMT);
  const img = document.getElementById('qrImage');
  img.src = qrSrc(uri);
  document.getElementById('upiShow').textContent = NGO_UPI_ID;
  document.getElementById('amtShow').textContent = amount ? `₹${formatINR(amount)}` : `₹${formatINR(DEFAULT_AMT)} (default)`;
  document.getElementById('qrTitle').textContent = 'Scan & Pay to {{$setting->title}}';
  document.getElementById('qrDesc').style.opacity = 1;
}

// Download QR as PNG
document.getElementById('downloadQR').addEventListener('click', async ()=>{
  const img = document.getElementById('qrImage');
  // draw to canvas to force download
  const canvas = document.createElement('canvas');
  canvas.width = 600; canvas.height = 600;
  const ctx = canvas.getContext('2d');
  // white background
  ctx.fillStyle = '#fff'; ctx.fillRect(0,0,canvas.width,canvas.height);
  // load current QR
  const qr = new Image();
  qr.crossOrigin = 'anonymous';
  qr.src = img.src;
  qr.onload = () => {
    ctx.drawImage(qr, 0,0,600,600);
    const a = document.createElement('a');
    a.href = canvas.toDataURL('image/png');
    a.download = 'ngo-upi-qr.png';
    a.click();
  };
});

// Rebuild QR on demand
document.getElementById('refreshQR').addEventListener('click', refreshQR);

// Open UPI app with intent link
document.getElementById('upiIntent').addEventListener('click', ()=>{
  const amt = Number(document.getElementById('amount').value) || DEFAULT_AMT;
  const uri = upiUri(amt);
  // Android UPI apps handle this schema directly:
  window.location.href = uri;
});

// Simple confirm (you can POST to backend here)
document.getElementById('submitBtn').addEventListener('click', ()=>{
  const name = document.getElementById('name').value.trim();
  const email= document.getElementById('email').value.trim();
  const mobile= document.getElementById('mobile').value.trim();
  const pan_no  = document.getElementById('pan_no').value.trim().toUpperCase();
  if(!name || !email || !/^[A-Z]{5}\d{4}[A-Z]$/.test(pan)){
    alert('Please fill Name, Email and a valid PAN (e.g., ABCDE1234F).'); return;
  }
  const amt = Number(document.getElementById('amount').value) || DEFAULT_AMT;
  const payload = { name, email, pan, upi: NGO_UPI_ID, amount: amt };
  console.log('CONFIRM →', payload);
  alert('Thanks! Now scan the QR or tap "Open UPI App" to complete payment.');
});

document.addEventListener('DOMContentLoaded', refreshQR);
</script>
