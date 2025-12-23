
  <style>
    :root{
      --bg:#1f2937;         /* panel dark */
      --page:#0f172a;       /* page darkest */
      --ink:#e5e7eb;        /* text main */
      --muted:#cbd5e1;      /* text muted */
      --line:#2b3340;       /* borders */
      --accent:#ec058e;     /* green accent */
      --accent-2:#00a5e2;   /* orange accent */
      --bar-start:#00a5e2;  /* gradient left */
      --bar-end:#ec058e;    /* gradient right */
      --badge:#f59e0b;      /* visitor badge */
      --radius:14px;
    }
    
    footer{
    width:100%;
    color:var(--ink);
  }
  .wrapper{
    max-width:980px;
    margin:0 auto;
  }
  .panel{
    background:var(--bg);
    border-top:1px solid var(--line);
    padding:26px 18px 32px;
    border-radius:16px 16px 0 0;
    box-shadow:0 -20px 60px rgba(0,0,0,.35) inset;
  }

  .panel h3{
    margin:0 0 6px;
    font-size:1.15rem;
    letter-spacing:.4px;
    color:#fff;
  }
  .underline{
    width:56px;height:4px;border-radius:6px;
    background:linear-gradient(90deg,var(--accent-2),var(--accent));
    margin:6px 0 16px;
  }

  .links{
    list-style:none;margin:0 0 18px;padding:0;
  }

  /* make links flex so icon + text align nicely */
  .links li{
    margin:8px 0;
    color:var(--muted);
  }
  .links a{
    color:var(--muted);
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:8px;
    font-size:.95rem;
  }
  .links a i{
    font-size:.9rem;
    color:#e5e7eb;
    width:18px;
    text-align:center;
  }
  .links a:hover{
    color:#fff;
    text-decoration:underline;
    text-underline-offset:3px;
  }

  .reach p{
    margin:0 0 16px;
    color:var(--muted);
  }

  /* QUICK LINKS header row with logo */
  .quick-links-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
  }
  .quick-links-header .footer-logo{
    max-height:32px;
    width:auto;
  }

  /* Gradient social bar */
.social-bar{
  background:linear-gradient(90deg,#00a5e2,#ec058e);
  padding:12px 14px;
  display:flex;
  justify-content:center;
  gap:12px;
}

.icon{
  width:36px;
  height:36px;
  border-radius:999px;
  background:rgba(0,0,0,.15);
  display:flex;
  align-items:center;
  justify-content:center;
  border:1px solid #ffffff33;
  transition:transform .15s ease, background .15s ease;
}

.icon:hover{
  transform:translateY(-2px);
  background:rgba(255,255,255,.18);
}

.icon i{
  font-size:18px;
  color:#ffffff;
}

  .bottom{
    background:#2b3441;
    color:#eaeef5;
    text-align:center;
    padding:18px 14px 28px;
  }
  .bottom small{
    display:block;
    margin:4px auto;
    max-width:820px;
    opacity:.95;
  }
  .badge{
    display:inline-block;
    background:var(--badge);
    color:#111827;
    font-weight:700;
    padding:8px 14px;
    border-radius:10px;
    margin-top:8px;
    box-shadow:0 4px 0 rgba(0,0,0,.25) inset;
  }

  .grid{
    display:grid;
    gap:18px;
  }
  @media(min-width:800px){
    .grid{
      grid-template-columns:1fr 1fr;
      gap:40px;
    }
  }
</style>

<footer>
  <div class="wrapper">
    <div class="panel">
      <div class="grid">
        {{-- QUICK LINKS + logo --}}
        <section>
          <div class="quick-links-header">
            <h3>QUICK LINKS</h3>
            {{-- change logo path if needed --}}
          
          </div>
          <div class="underline"></div>
          <ul class="links">
            <li>
              <a href="{{ url('/about') }}">
                <i class="fas fa-info-circle"></i>
                <span>About Us</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/our-management-body') }}">
                <i class="fas fa-users-cog"></i>
                <span>Management Team</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/our-members') }}">
                <i class="fas fa-users"></i>
                <span>Members</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/terms-and-conditions') }}">
                <i class="fas fa-file-contract"></i>
                <span>Terms &amp; Conditions</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/privacy-policy') }}">
                <i class="fas fa-user-shield"></i>
                <span>Privacy Policy</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/video-gallery') }}">
                <i class="fas fa-video"></i>
                <span>A Video on NGO Portal</span>
              </a>
            </li>
          </ul>
          
            <img src="{{ asset('backend/uploads/'.$setting->site_logo) }}"
                 alt="{{ $setting->title }}"
                 class="footer-logo">
        </section>

        {{-- REACH US --}}
        <section class="reach">
          <h3>REACH US</h3>
          <div class="underline"></div>
          <p>{{ $setting->address }}<br>{{ $setting->phone }}</p>
          <p>{{ $setting->site_email }}</p>
        </section>
      </div>
    </div>

    {{-- Social bar --}}
  <div class="social-bar" aria-label="Social links">
  {{-- Instagram --}}
  <a class="icon" href="{{ $setting->insta_url }}" aria-label="Instagram" target="_blank">
    <i class="fab fa-instagram"></i>
  </a>

  {{-- X / Twitter --}}
  <a class="icon" href="{{ $setting->twitter }}" aria-label="X (Twitter)" target="_blank">
    <i class="fab fa-twitter"></i>
  </a>

  {{-- Facebook --}}
  <a class="icon" href="{{ $setting->facebook_url }}" aria-label="Facebook" target="_blank">
    <i class="fab fa-facebook-f"></i>
  </a>

  {{-- Google (you can point to Gmail / Google profile etc.) --}}
  <a class="icon" href="https://google.com" aria-label="Google" target="_blank">
    <i class="fab fa-google"></i>
  </a>

  {{-- LinkedIn --}}
  <a class="icon" href="#" aria-label="LinkedIn" target="_blank">
    <i class="fab fa-linkedin-in"></i>
  </a>

  {{-- Pinterest --}}
  <a class="icon" href="https://pinterest.com/yourprofile" aria-label="Pinterest" target="_blank">
    <i class="fab fa-pinterest-p"></i>
  </a>

  {{-- WhatsApp --}}
  <a class="icon" href="https://wa.me/{{ $setting->phone }}" aria-label="WhatsApp" target="_blank">
    <i class="fab fa-whatsapp"></i>
  </a>

  {{-- Share (generic) --}}
  <a class="icon" href="#" aria-label="Share">
    <i class="fas fa-share-alt"></i>
  </a>
</div>


    <div class="bottom">
      <small>&copy; Content Owned by {{ $setting->title }}, NGO of India. Site Maintained Kikde Group</small>
<div class="badge">Visitors Count {{ number_format(App\Services\VisitorCounter::total()) }}</div>
    </div></footer>


