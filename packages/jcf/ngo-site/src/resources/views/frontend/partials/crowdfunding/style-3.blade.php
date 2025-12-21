{{-- Crowdfunding cards --}}
<style>
:root{
  --brand:#ff4747; --brand-2:#ff8a47; --ink:#0f172a; --muted:#6b7280;
  --card:#ffffff; --soft:#f8fafc;
}

/* card shell */
.donate-card{
  display:flex; flex-direction:column;                /* mobile first: stacked */
  max-width: 980px;
  margin: 16px auto;
  background: var(--card);
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 14px 34px rgba(0,0,0,.10);
  border: 1px solid rgba(0,0,0,.06);
  font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
}

/* desktop: image/content side-by-side */
@media (min-width: 768px){
  .donate-card{ flex-direction:row; }
  .dn-hero{ width: 42%; min-height: 320px; height: auto; }
  .dn-body{ width: 58%; }
}

/* hero image (URL is set inline per-card) */
.dn-hero{
  position: relative;
  height: 220px;                                     /* mobile height */
  background-size: cover; background-position: center; background-repeat: no-repeat;
}
.dn-hero::after{
  content:""; position:absolute; inset:0;
  background: linear-gradient(180deg, rgba(0,0,0,.0), rgba(0,0,0,.45));
}

/* tag + title on image */
.dn-tag{
  position:absolute; left:12px; top:12px; z-index:2;
  background:#fff; color:#0b1220; font-weight:800;
  padding:6px 10px; border-radius:999px; font-size:.8rem;
  box-shadow:0 6px 14px rgba(0,0,0,.12);
}
.dn-title{
  position:absolute; left:14px; right:14px; bottom:12px; z-index:2;
  color:#fff; font-size:1.05rem; font-weight:900; line-height:1.25;
  text-shadow:0 2px 10px rgba(0,0,0,.35);
}

.dn-body{ padding: 14px 16px 16px; }

/* progress */
.dn-progress{ margin-top: 6px; background: var(--soft); height: 14px; border-radius: 999px; overflow:hidden; border: 1px solid rgba(0,0,0,.05); }
.dn-progress > span{
  display:block; height:100%; width:72%;
  background: linear-gradient(90deg, var(--brand), var(--brand-2));
  border-radius: inherit; box-shadow: inset 0 0 8px rgba(255,255,255,.35);
  transition: width .6s ease;
}

/* stats */
.dn-stats{ display:flex; align-items:center; justify-content:space-between; margin-top:10px; gap:10px; }
.dn-raised{ font-weight:900; color:#ff5347; font-size:1.05rem; }
.dn-goal{ color:#ff5347; font-weight:700; font-size:.92rem; }
.dn-eta{ margin-top:6px; color:#0b1220; font-weight:700; font-size:.9rem; }

/* donors */
.dn-donors{ margin-top:12px; display:flex; align-items:center; justify-content:space-between; }
.dn-avatars{ display:flex; align-items:center; }
.dn-avatars img{ width:30px; height:30px; border-radius:50%; border:2px solid #fff; box-shadow:0 3px 10px rgba(0,0,0,.12); margin-left:-8px; }
.dn-avatars img:first-child{ margin-left:0; }
.dn-count{ font-weight:800; color:#ff5347; font-size:.9rem; }

/* CTAs */
.dn-cta{ margin-top:14px; display:flex; gap:10px; }
.dn-btn{
  flex:1; display:inline-block; text-align:center; padding:12px 16px; border-radius:12px;
  text-decoration:none; font-weight:900; color: #fff !important;
  background: linear-gradient(90deg, var(--brand), var(--brand-2));
  box-shadow:0 10px 22px rgba(255,71,71,.30); transition: transform .2s, box-shadow .2s;
}
.dn-btn:hover{ transform: translateY(-2px); box-shadow:0 12px 28px rgba(255,71,71,.38); }
.dn-secondary{
  padding:12px 14px; border-radius:12px; font-weight:800; text-decoration:none;
  color:#0f172a; background: #fff; border:1px solid rgba(0,0,0,.08);
  box-shadow:0 6px 16px rgba(0,0,0,.06);
}

/* trust + note */
.dn-trust{ margin-top:12px; display:flex; gap:8px; align-items:center; flex-wrap:wrap; color: var(--muted); font-size:.86rem; font-weight:700; }
.dn-chip{ display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; background:#f1f5f9; color:#0b1220; border:1px solid rgba(0,0,0,.06); font-weight:800; font-size:.8rem; }
.dn-note{ margin-top:10px; color:#64748b; font-size:.8rem; }
</style>


@foreach($crowdfund as $funds)
  <div class="donate-card" role="region" aria-label="Donate Now – Crowdfunding">
    {{-- set background per-card to avoid “same image” issue --}}
    <div class="dn-hero" style="background-image:url('{{ asset('backend/uploads/'.$funds->breadcrumb) }}');">
      <span class="dn-tag">{{ $funds->pagekeyword }}</span>
      <div class="dn-title">{{ $funds->pagetitle }}</div>
    </div>

    <div class="dn-body">
      {{-- Stats --}}
      <div class="dn-stats" aria-live="polite">
        <div class="dn-raised">₹7,20,850 <span style="color:#6b7280;font-weight:700;font-size:.9rem;">raised</span></div>
        <div class="dn-goal">Donate: ₹10,00,000</div>
      </div>

      <div class="dn-progress" aria-label="Funding progress">
        <span style="width:72%" aria-valuemin="0" aria-valuemax="100" aria-valuenow="72" role="progressbar"></span>
      </div>



      {{-- Donors --}}
      <div class="dn-donors">
        
        <div class="dn-count">1,284 donors</div>
      </div>

      {{-- CTAs --}}
      <div class="dn-cta">
        <a href="{{ url('/user-donate') }}" class="dn-btn">Donate Now</a>
        <a href="https://wa.me/{{ $setting->phone }}?text={{ urlencode('Hello Team, Thank you for your support!') }}"
           target="_blank" rel="noopener" class="dn-secondary">Share</a>
      </div>

      {{-- Trust --}}
      <div class="dn-trust">
        <span class="dn-chip">🔒 100% Secure</span>
        <span class="dn-chip">📜 80G Eligible</span>
        <span class="dn-chip">✅ Verified</span>
      </div>

      <div class="dn-note">
        <b>Latest donors: Aman (₹1,000) — Thank you! 💙</b>
      </div>
    </div>
  </div>

    
@endforeach
    <div class="dn-cta">
        <a href="{{ url('/crowdfunding') }}" class="dn-btn">Crowd Funding</a>
      
      </div>