{{-- Quick Links Section --}}
<style>
  .quick-links-section{
    padding:30px 0 40px;
    font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
  }

  /* White box around the whole block */
  .quick-links-section .auto-container{
    background:#ffffff;
    border-radius:18px;
    padding:14px 12px 18px;
    box-shadow:0 14px 32px rgba(15,23,42,.12);
  }

  .quick-links-section .ql-header{
    text-align:center;
    margin-bottom:12px;
  }
  .quick-links-section .ql-title{
    margin:0;
    font-size:1.5rem;
    font-weight:800;
    color:#ffffff;
    text-shadow:0 2px 6px rgba(0,0,0,.3);
  }

  /* bar behind heading for contrast */
  .quick-links-section .ql-header-bar{
    display:inline-block;
    padding:4px 18px 6px;
    border-radius:999px;
    background:linear-gradient(90deg,#6ab4cf,#ec058e);
  }

  /* === 2 cards per row, 2 rows === */
  .quick-links-section .ql-grid{
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:10px;
    margin-top:10px;
  }

  /* If you ever want single column on very tiny screens, uncomment:
  @media (max-width:480px){
    .quick-links-section .ql-grid{
      grid-template-columns:1fr;
    }
  }
  */

  /* Each card is white now */
  .quick-links-section .ql-card{
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:18px 10px 16px;
    border-radius:14px;
    background:#ffffff; /* white card */
    color:#111827;
    text-decoration:none;
    box-shadow:0 8px 20px rgba(15,23,42,.08);
    border:1px solid #f3f4f6;
    transition:transform .15s ease, box-shadow .15s ease, border-color .15s ease;
  }

  .quick-links-section .ql-card:hover{
    transform:translateY(-3px);
    box-shadow:0 16px 30px rgba(15,23,42,.18);
    border-color:#fed7aa;
    text-decoration:none;
  }

  /* Icon pill with gradient + shadow */
  .quick-links-section .ql-icon{
    width:52px;
    height:52px;
    border-radius:16px;
    background:linear-gradient(135deg,#ec058e,#00a5e2);
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:10px;
    box-shadow:0 8px 18px rgba(236,57,17,.55);
  }

  .quick-links-section .ql-icon i{
    font-size:26px;
    color:#ffffff;
  }

  .quick-links-section .ql-label{
    font-size:.95rem;
    font-weight:800;
    letter-spacing:.02em;
  }
</style>

<section class="quick-links-section">
  <div class="auto-container">
    <div class="ql-header">
      <div class="ql-header-bar">
        <h2 class="ql-title">Quick Links</h2>
      </div>
    </div>

    {{-- IMPORTANT: remove d-flex here --}}
    <div class="ql-grid">
      {{-- Member Apply --}}
      <a href="{{ url('/member-registration') }}" class="ql-card">
        <div class="ql-icon">
          <i class="fas fa-user-plus"></i>
        </div>
        <div class="ql-label">Member Apply</div>
      </a>

      {{-- Generate ID Card --}}
      <a href="{{ url('/idcard-download') }}" class="ql-card">
        <div class="ql-icon">
          <i class="fas fa-id-card"></i>
        </div>
        <div class="ql-label">Generate ID Card</div>
      </a>

      {{-- Generate Certificate --}}
      <a href="{{ url('/idcard-download') }}" class="ql-card">
        <div class="ql-icon">
          <i class="fas fa-certificate"></i>
        </div>
        <div class="ql-label">Generate Certificate</div>
      </a>

      {{-- Donate Us --}}
      <a href="{{ url('/user-donate') }}" class="ql-card">
        <div class="ql-icon">
          <i class="fas fa-hand-holding-heart"></i>
        </div>
        <div class="ql-label">Donate Us</div>
      </a>
    </div>
  </div>
</section>
