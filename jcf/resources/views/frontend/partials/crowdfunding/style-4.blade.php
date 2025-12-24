@props([
  /* Content */
  'title'      => 'Support Children’s Education',
  'tag'        => 'Emergency • Relief',
  'image'      => 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1200&q=80',

  /* Numbers (INR) */
  'goal'       => 1000000,          // 10,00,000
  'raised'     => 720850,           // 7,20,850
  'percent'    => null,             // optional; auto-calculated if null
  'daysLeft'   => 9,
  'donors'     => 1284,

  /* Payment */
  'defaultAmount' => 1000,
  'upi'           => 'NGO@upi',
  'donateUrl'     => '/donate',     // your route; we append ?amount=

  /* Theme & Colors */
  'theme'      => 'glass',          // 'glass' | 'soft' | 'brand' | 'dark'
  'brand'      => '#005bff',
  'accent'     => '#ff4747',

  /* UX */
  'showShare'  => true,
])

@php
  // basic INR formatting
  $fmt = fn($n) => '₹' . number_format((float)$n, 0, '.', ',');

  // calc percent if not passed
  $pct = is_null($percent) && $goal > 0 ? min(100, round(($raised / $goal) * 100)) : (int) $percent;
  if ($pct < 0) $pct = 0; if ($pct > 100) $pct = 100;

  // unique scope id for CSS scoping
  $uid = 'dnc-' . substr(md5($attributes->get('id') ?? uniqid()), 0, 8);

  // theme classes
  $themeClass = match($theme) {
    'soft'  => 't-soft',
    'brand' => 't-brand',
    'dark'  => 't-dark',
    default => 't-glass'
  };

  // pills (you can customize)
  $pills = [250, 500, 1000, 2500, 5000];
@endphp

<style>
/* ===== Donate Card (scoped) ===== */
.{{ $uid }}{--p:{{ $brand }};--a:{{ $accent }};--ink:#0f172a;--muted:#6b7280;--card:#fff;--soft:#f8fafc; font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;}
.{{ $uid }} .card{max-width:520px;margin:16px auto;background:var(--card);border-radius:18px;overflow:hidden;
  box-shadow:0 14px 34px rgba(0,0,0,.10);border:1px solid rgba(0,0,0,.06);}
.{{ $uid }} .hero{position:relative;height:180px;background:center/cover no-repeat;}
.{{ $uid }} .hero::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,0),rgba(0,0,0,.45));}
.{{ $uid }} .tag{position:absolute;left:12px;top:12px;z-index:2;background:#fff;color:#0b1220;font-weight:800;padding:6px 10px;border-radius:999px;font-size:.8rem;box-shadow:0 6px 14px rgba(0,0,0,.12);}
.{{ $uid }} .title{position:absolute;left:14px;right:14px;bottom:12px;z-index:2;color:#fff;font-size:1.12rem;font-weight:900;text-shadow:0 2px 10px rgba(0,0,0,.35);}
.{{ $uid }} .body{padding:14px 14px 16px;background:#fff;}
.{{ $uid }} .stats{display:flex;justify-content:space-between;gap:8px;margin-top:6px;}
.{{ $uid }} .raised{font-weight:900;color:var(--ink);font-size:1.05rem;}
.{{ $uid }} .goal{color:var(--muted);font-weight:700;font-size:.92rem;}
.{{ $uid }} .bar{margin:8px 0;background:var(--soft);height:14px;border-radius:999px;overflow:hidden;border:1px solid rgba(0,0,0,.05);}
.{{ $uid }} .bar>span{display:block;height:100%;width:{{ $pct }}%;background:linear-gradient(90deg,var(--p),var(--a));border-radius:inherit;box-shadow:inset 0 0 8px rgba(255,255,255,.35);transition:width .6s ease;}
.{{ $uid }} .eta{color:#0b1220;font-weight:700;font-size:.9rem;}

.{{ $uid }} .amt{margin-top:12px;}
.{{ $uid }} .amt-title{font-weight:900;color:var(--ink);margin-bottom:8px;}
.{{ $uid }} .pills{display:flex;flex-wrap:wrap;gap:8px;}
.{{ $uid }} .pill{padding:10px 12px;border-radius:999px;background:#eef2ff;border:1px solid #dbeafe;color:#0b1220;font-weight:800;font-size:.95rem;cursor:pointer;user-select:none;}
.{{ $uid }} .pill.active{background:linear-gradient(90deg,var(--p),var(--a));border-color:transparent;color:#fff;box-shadow:0 8px 18px rgba(0,91,255,.22);}
.{{ $uid }} .custom{margin-top:10px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;}
.{{ $uid }} .input{flex:1;min-width:180px;padding:10px 12px;border-radius:12px;border:1px solid #e5e7eb;background:#fff;font-weight:800;}
.{{ $uid }} .input:focus{outline:none;border-color:#ff7a6a;box-shadow:0 0 0 3px rgba(255,122,106,.2);}
.{{ $uid }} .small{font-size:.82rem;color:var(--muted);}

.{{ $uid }} .pay{margin-top:14px;background:#fff;border:1px dashed #e5e7eb;border-radius:12px;padding:10px;}
.{{ $uid }} .pay-title{font-weight:900;margin-bottom:6px;color:var(--ink);}
.{{ $uid }} .grid{display:grid;grid-template-columns:88px 1fr;gap:10px;align-items:center;}
.{{ $uid }} .qr{width:88px;height:88px;border-radius:10px;background:#fff;display:grid;place-items:center;border:1px solid #e5e7eb;}
.{{ $uid }} .upi{font-weight:800;color:#0b1220;}
.{{ $uid }} .methods{display:flex;gap:6px;flex-wrap:wrap;margin-top:6px;}
.{{ $uid }} .badge{padding:6px 8px;border-radius:8px;background:#f1f5f9;border:1px solid #e5e7eb;font-weight:800;font-size:.78rem;}

.{{ $uid }} .cta{margin-top:14px;display:flex;gap:10px;}
.{{ $uid }} .btn{flex:1;text-align:center;padding:12px 16px;border-radius:12px;text-decoration:none;font-weight:900;color:#fff;background:linear-gradient(90deg,var(--p),var(--a));box-shadow:0 10px 22px rgba(0,91,255,.30);transition:transform .2s, box-shadow .2s;}
.{{ $uid }} .btn:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(0,91,255,.35);}
.{{ $uid }} .sec{padding:12px 14px;border-radius:12px;font-weight:800;text-decoration:none;color:#0f172a;background:#fff;border:1px solid rgba(0,0,0,.08);box-shadow:0 6px 16px rgba(0,0,0,.06);}

.{{ $uid }} .trust{margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;color:#64748b;font-size:.86rem;font-weight:700;}
.{{ $uid }} .chip{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:999px;background:#f1f5f9;color:#0b1220;border:1px solid rgba(0,0,0,.06);font-weight:800;font-size:.8rem;}
.{{ $uid }} .note{margin-top:10px;color:#64748b;font-size:.8rem;}

/* Themes (background/bar accents) */
.{{ $uid }}.t-glass .card{background:rgba(255,255,255,.65);backdrop-filter:blur(10px)}
.{{ $uid }}.t-soft  .card{background:linear-gradient(180deg,#f6f9ff,#fff)}
:root{ --brand-global: {{ $brand }}; } /* optional global */
.{{ $uid }}.t-brand .card{background: color-mix(in srgb, var(--p) 8%, #fff);}
.{{ $uid }}.t-dark  .card{background:#0f172a;border-color:rgba(255,255,255,.08);}
.{{ $uid }}.t-dark  .body{background:#0f172a;color:#e5e7eb}
.{{ $uid }}.t-dark  .goal, .{{ $uid }}.t-dark .small{color:#94a3b8}
.{{ $uid }}.t-dark  .badge{background:#0b1220;border-color:#1e293b;color:#e2e8f0}
.{{ $uid }}.t-dark  .sec{background:#0b1220;color:#e2e8f0;border-color:#1f2937}
.{{ $uid }}.t-dark  .pill{background:#0b1220;color:#e5e7eb;border-color:#1f2937}
</style>

<div class="{{ $uid }} {{ $themeClass }}" data-component="donate-card">
  <div class="card" role="region" aria-label="Donate Now – Crowdfunding">
    <div class="hero" style="background-image:url('{{ $image }}')">
      <span class="tag">{{ $tag }}</span>
      <div class="title">{{ $title }}</div>
    </div>

    <div class="body">
      <div class="stats" aria-live="polite">
        <div class="raised">{{ $fmt($raised) }} <span class="small">raised</span></div>
        <div class="goal">Goal: {{ $fmt($goal) }}</div>
      </div>
      <div class="bar" aria-label="Funding progress"><span role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $pct }}"></span></div>
      <div class="eta">⏳ {{ $daysLeft }} days left • {{ $pct }}% funded • {{ number_format($donors) }} donors</div>

      <div class="amt">
        <div class="amt-title">Choose an amount</div>
        <div class="pills" id="{{ $uid }}-pills">
          @foreach ($pills as $p)
            <span class="pill {{ $p == $defaultAmount ? 'active' : '' }}" data-amt="{{ $p }}">₹{{ number_format($p) }}</span>
          @endforeach
        </div>
        <div class="custom">
          <input class="input" id="{{ $uid }}-custom" type="number" min="1" step="1" placeholder="Enter custom amount (₹)">
          <span class="small" id="{{ $uid }}-preview">Selected: ₹{{ number_format($defaultAmount) }}</span>
        </div>
      </div>

      <div class="pay">
        <div class="pay-title">Pay via UPI / QR or Card</div>
        <div class="grid">
          <div class="qr" title="Scan to pay">
            <!-- simple inline QR placeholder -->
            <svg viewBox="0 0 100 100" width="70" height="70" aria-hidden="true">
              <rect width="100" height="100" fill="#000" rx="6"></rect>
              <rect x="8" y="8" width="24" height="24" fill="#fff"></rect>
              <rect x="68" y="8" width="24" height="24" fill="#fff"></rect>
              <rect x="8" y="68" width="24" height="24" fill="#fff"></rect>
              <rect x="28" y="28" width="44" height="44" fill="#fff"></rect>
              <rect x="38" y="38" width="24" height="24" fill="#000"></rect>
            </svg>
          </div>
          <div>
            <div class="upi">UPI ID: {{ $upi }}</div>
            <div class="methods">
              <span class="badge">GPay</span>
              <span class="badge">PhonePe</span>
              <span class="badge">Paytm</span>
              <span class="badge">Card</span>
              <span class="badge">NetBanking</span>
            </div>
            <div class="small" style="margin-top:6px;">Scan the QR or use UPI ID. For card/netbanking, tap Donate.</div>
          </div>
        </div>
      </div>

      <div class="cta">
        <a href="{{ $donateUrl }}?amount={{ $defaultAmount }}" class="btn" id="{{ $uid }}-btn">Donate Now</a>
        @if($showShare)
          <a href="#share" class="sec">Share</a>
        @endif
      </div>

      <div class="trust">
        <span class="chip">📜 80G Receipt</span>
        <span class="chip">🔒 Secure</span>
        <span class="chip">✅ Verified</span>
      </div>
      <div class="note">Recent donors: Anita ₹500, Kunal ₹1,000, Priya ₹250 — Thank you! 💙</div>
    </div>
  </div>
</div>

<script>
(() => {
  const root   = document.querySelector('.{{ $uid }}');
  if(!root) return;

  const pills  = root.querySelectorAll('#{{ $uid }}-pills .pill');
  const custom = root.querySelector('#{{ $uid }}-custom');
  const prev   = root.querySelector('#{{ $uid }}-preview');
  const btn    = root.querySelector('#{{ $uid }}-btn');

  function setAmount(v){
    v = Math.max(1, parseInt(v||0, 10));
    prev.textContent = 'Selected: ₹' + v.toLocaleString('en-IN');
    btn.href = '{{ $donateUrl }}' + '?amount=' + v;
  }

  pills.forEach(p => {
    p.addEventListener('click', () => {
      pills.forEach(x => x.classList.remove('active'));
      p.classList.add('active');
      custom.value = '';
      setAmount(p.dataset.amt);
    });
  });

  custom.addEventListener('input', () => {
    pills.forEach(x => x.classList.remove('active'));
    setAmount(custom.value);
  });

  // init
  setAmount({{ (int) $defaultAmount }});
})();
</script>
