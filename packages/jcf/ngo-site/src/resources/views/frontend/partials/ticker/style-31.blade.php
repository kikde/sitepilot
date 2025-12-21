<!-- ===== NGO Upcoming Features (Ticker + Highlights + Roadmap) ===== -->
<section class="ngo-upcoming">
  <!-- Head -->
  <header class="ngo-head">
    <h2>Our Features</h2>
   
  </header>

  <!-- Ticker / News Strip -->
  <div class="ngo-ticker" aria-label="Upcoming feature ticker">
    <div class="ngo-ticker-track">
      <span>🎯 Donor 360 Profile</span>
      <span>🧾 Instant 80G/12A e-Receipt</span>
      <span>📊 Live Impact Dashboard</span>
      <span>🤝 Corporate CSR Portal</span>
      <span>📍 Event Check-in with QR</span>
      <span>📬 WhatsApp Acknowledgements</span>
      <span>🔒 Fraud-Safe Payment Links</span>
      <span>🌱 Carbon-Offset Counter</span>
    </div>
  </div>

  <!-- Highlights (what donors & partners care about) -->
  <div class="ngo-grid">
    <article class="ngo-card">
      <div class="ngo-chip chip-soon">Coming Soon</div>
      <h3 class="ngo-card-title">Instant 80G e-Receipt</h3>
      <p>Auto-generate, e-mail & WhatsApp receipts right after a successful donation.</p>
      <ul class="ngo-points">
        <li>Auto PDF with QR + receipt no.</li>
        <li>PAN capture & validation</li>
        <li>Razorpay/UPI compatible</li>
      </ul>
      <div class="ngo-badge-row">
        <span class="ngo-badge">Top NGOs do this ✅</span>
        <span class="ngo-badge light">Trust Booster</span>
      </div>
    </article>

    <article class="ngo-card">
      <div class="ngo-chip chip-beta">Beta</div>
      <h3 class="ngo-card-title">Live Impact Dashboard</h3>
      <p>Beautiful metrics that update automatically from campaigns & events.</p>
      <ul class="ngo-points">
        <li>Funds → Beneficiaries mapping</li>
        <li>Campaign-wise transparency</li>
        <li>Embeddable widgets</li>
      </ul>
      <div class="ngo-badge-row">
        <span class="ngo-badge">Real-time 📈</span>
        <span class="ngo-badge light">Shareable</span>
      </div>
    </article>

    <article class="ngo-card">
      <div class="ngo-chip chip-next">Next</div>
      <h3 class="ngo-card-title">Donor 360 & Certificates</h3>
      <p>A single place for donation history, receipts, certificates & preferences.</p>
      <ul class="ngo-points">
        <li>One-click annual statement</li>
        <li>Smart reminders & nudges</li>
        <li>Tax-friendly summaries</li>
      </ul>
      <div class="ngo-badge-row">
        <span class="ngo-badge">Delight Factor ✨</span>
        <span class="ngo-badge light">Retention ↑</span>
      </div>
    </article>

    <article class="ngo-card">
      <div class="ngo-chip chip-soon">Pro-Plus</div>
      <h3 class="ngo-card-title">CSR / Partner Portal</h3>
      <p>Give corporate partners a login to view impact, invoices, and MoUs.</p>
      <ul class="ngo-points">
        <li>Milestone tracking</li>
        <li>Custom reporting</li>
        <li>Brand assets & approvals</li>
      </ul>
      <div class="ngo-badge-row">
        <span class="ngo-badge">Enterprise-ready 🏢</span>
        <span class="ngo-badge light">Co-branding</span>
      </div>
    </article>
  </div>

  <!-- Mini Roadmap -->
  <div class="ngo-roadmap">
    <h4 class="ngo-roadmap-title">Roadmap</h4>
    <ol class="ngo-steps">
      <li>
        <span class="dot live"></span>
        <div>
          <strong>Now</strong>
          <p>Community Needs Assessment (beta)</p>
        </div>
      </li>
      <li>
        <span class="dot next"></span>
        <div>
          <strong>Next</strong>
          <p>Learning Centers Expansion</p>
        </div>
      </li>
      <li>
        <span class="dot later"></span>
        <div>
          <strong>Later</strong>
          <p>Community Leadership Academy</p>
        </div>
      </li>
    </ol>
  </div>
</section>

<style>
  :root{
    --ink:#0f172a;
    --muted:#240d75;
    --bg:#ffffff;
    --soft:#f8fafc;
    --brand:#ef4444;        /* primary (CTA) */
    --brand-2:#f97316;      /* gradient end */
    --ring:#e5e7eb;         /* borders */
    --glow:0 18px 38px rgba(15,23,42,.12);
  }
  .ngo-upcoming{ max-width:1100px; margin:0 auto; padding:24px 14px; font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial; color:var(--ink); }
  .ngo-head h2{ margin:0 0 4px; font-size:28px; font-weight:800; letter-spacing:.2px; }
  .ngo-head p{ margin:0 0 14px; color: #240d75!important; }

  /* Ticker */
  .ngo-ticker{ position:relative; overflow:hidden; background:linear-gradient(90deg, #fff 0,#fff7f5 60%,#fff 100%); border:1px solid var(--ring); border-radius:14px; box-shadow:var(--glow); }
  .ngo-ticker:before,.ngo-ticker:after{
    content:""; position:absolute; inset:0; width:40px; pointer-events:none;
  }
  .ngo-ticker:before{ left:0; background:linear-gradient(90deg,#fff,transparent); }
  .ngo-ticker:after{ right:0; background:linear-gradient(270deg,#fff,transparent); }
  .ngo-ticker-track{
    display:flex; gap:22px; white-space:nowrap; padding:10px 16px;
    animation:ngo-scroll 22s linear infinite;
  }
  .ngo-ticker-track span{
    display:inline-flex; align-items:center; gap:8px;
    font-weight:700; font-size:14px; padding:6px 12px; border-radius:999px;
    background:#fff; border:1px solid var(--ring); color: #240d75 !important;
  }
  @keyframes ngo-scroll{
    from{ transform:translateX(0); }
    to  { transform:translateX(-50%); }
  }

  /* Grid */
  .ngo-grid{ display:grid; gap:16px; grid-template-columns:repeat(4,1fr); margin:18px 0; }
  @media (max-width:992px){ .ngo-grid{ grid-template-columns:repeat(2,1fr);} }
  @media (max-width:600px){ .ngo-grid{ grid-template-columns:1fr; } }

  .ngo-card{
     border:1px solid var(--ring); border-radius:20px; padding:16px;
    box-shadow:var(--glow); position:relative; overflow:hidden;
  }
  .ngo-card-title{ margin:6px 0 8px; font-size:18px; font-weight:800; }
  .ngo-chip{
    position:absolute; top:10px; right:10px; font-size:11px; font-weight:800; letter-spacing:.06em;
    padding:4px 10px; border-radius:999px; color:#fff;
  }
  .chip-soon{ background:linear-gradient(90deg,#ef4444,#f97316); }
  .chip-beta{ background:linear-gradient(90deg,#2563eb,#22d3ee); }
  .chip-next{ background:linear-gradient(90deg,#16a34a,#84cc16); }

  .ngo-points{ margin:10px 0 0 0; padding:0 0 0 18px; color:#374151; font-size:14px; }
  .ngo-points li{ margin:4px 0; }

  .ngo-badge-row{ display:flex; gap:8px; flex-wrap:wrap; margin-top:10px; }
  .ngo-badge{
    font-size:12px; font-weight:800; padding:6px 10px; border-radius:999px;
    background:#fee2e2; color:#991b1b; border:1px solid #fecaca;
  }
  .ngo-badge.light{ background:#eef2ff; color:#3730a3; border-color:#c7d2fe; }

  /* Roadmap */
  .ngo-roadmap{ margin-top:8px; background:var(--soft); border:1px dashed var(--ring); border-radius:16px; padding:14px; }
  .ngo-roadmap-title{ margin:0 0 10px; font-weight:800; font-size:16px; }
  .ngo-steps{ margin:0; padding:0; list-style:none; display:grid; gap:10px; }
  .ngo-steps li{ display:flex; align-items:flex-start; gap:10px; }
  .ngo-steps strong{ display:block; color: #240d75; }
  .ngo-steps p{ margin:2px 0 0; color: #240d75 !important; }
  .dot{ width:10px; height:10px; border-radius:50%; margin-top:6px; box-shadow:0 0 0 3px #fff, 0 0 0 4px var(--ring); }
  .dot.live{ background:#ef4444; }
  .dot.next{ background:#f59e0b; }
  .dot.later{ background:#10b981; }
</style>

<script>
  // Duplicate ticker content so it loops seamlessly
  (function(){
    const track = document.querySelector('.ngo-ticker-track');
    if(!track) return;
    track.innerHTML += track.innerHTML; // simple clone
  })();
</script>
