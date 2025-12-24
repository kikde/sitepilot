@extends('layouts.master')

@section('content')

<style>
  /* ====== Scoped About Page Styling (won't touch other pages) ====== */
  .vsf-about-section{
    position: relative;
    padding: 60px 0 40px;
    background: radial-gradient(circle at top left,#fff7f7,#fff),
                radial-gradient(circle at bottom right,#fff1e6,#ffffff);
  }

  .vsf-about-section .vsf-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:6px 14px;
    border-radius:999px;
    font-size:.78rem;
    text-transform:uppercase;
    letter-spacing:.16em;
    background:#fff1f2;
    color:#e11d48;
    font-weight:800;
    box-shadow:0 10px 30px rgba(248,113,113,.25);
  }

  .vsf-about-section .vsf-badge span.icon{
    width:20px;height:20px;
    display:inline-flex;align-items:center;justify-content:center;
    border-radius:999px;
    background:linear-gradient(135deg,#ff4d4d,#ff934d);
    color:#fff;font-size:.8rem;
  }

  .vsf-about-section .vsf-title-wrap{
    max-width:900px;
    margin:0 auto 24px;
    text-align:center;
  }

  .vsf-about-section .vsf-title-wrap h1{
    font-size:2rem;
    font-weight:800;
    margin:14px 0 8px;
    color:#111827;
    line-height:1.25;
  }

  .vsf-about-section .vsf-title-wrap h1 span{
    background:linear-gradient(135deg,#ff4d4d,#ff934d);
    -webkit-background-clip:text;
    color:transparent;
  }

  .vsf-about-section .vsf-sub{
    font-size:.98rem;
    color:#4b5563;
    max-width:720px;
    margin:0 auto;
  }

  /* grid layout */
  .vsf-about-grid{
    margin-top:28px;
    display:grid;
    grid-template-columns: minmax(0,1.1fr) minmax(0,0.9fr) minmax(0,0.9fr);
    gap:22px;
    align-items:stretch;
  }

  /* left: about text */
  .vsf-about-main{
    background:#ffffff;
    border-radius:18px;
    padding:18px 18px 20px;
    box-shadow:0 16px 40px rgba(15,23,42,.08);
    border:1px solid #f3f4f6;
  }

  .vsf-about-main h4{
    font-size:1rem;
    font-weight:700;
    color:#ef4444;
    margin-bottom:6px;
  }

  .vsf-about-main h2{
    font-size:1.2rem;
    font-weight:800;
    margin:0 0 10px;
    color:#111827;
  }

  .vsf-about-main p{
    font-size:.94rem;
    color:#4b5563;
    margin-bottom:10px;
  }

  .vsf-pill-row{
    margin-top:10px;
    display:flex;
    flex-wrap:wrap;
    gap:8px;
  }
  .vsf-pill{
    padding:6px 12px;
    border-radius:999px;
    background:#fee2e2;
    color:#b91c1c;
    font-size:.78rem;
    font-weight:700;
  }

  /* middle: image + overlay card */
  .vsf-about-photo-card{
    position:relative;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 18px 44px rgba(15,23,42,.15);
    background:#000;
  }
  .vsf-about-photo-card img{
    width:100%;height:100%;object-fit:cover;display:block;
    opacity:.94;
  }
  .vsf-photo-overlay{
    position:absolute;
    inset:auto 14px 14px 14px;
    border-radius:14px;
    padding:10px 12px;
    background:linear-gradient(135deg,rgba(15,23,42,.85),rgba(153,27,27,.9));
    color:#f9fafb;
    display:flex;
    flex-direction:column;
    gap:2px;
  }
  .vsf-photo-overlay h4{
    margin:0;font-size:.98rem;font-weight:800;
  }
  .vsf-photo-overlay span{
    font-size:.8rem;opacity:.9;
  }

  /* right column: mission + statements stacked */
  .vsf-right-stack{
    display:flex;
    flex-direction:column;
    gap:14px;
  }

  /* mission quote box */
  .vsf-mission-box{
    background:#111827;
    color:#e5e7eb;
    border-radius:18px;
    padding:16px 16px 18px;
    position:relative;
    overflow:hidden;
  }
  .vsf-mission-box::before{
    content:"";
    position:absolute;inset:-40%;opacity:.08;
    background:radial-gradient(circle at top left,#fb7185,transparent 55%);
  }
  .vsf-mission-icon{
    width:32px;height:32px;border-radius:999px;
    display:flex;align-items:center;justify-content:center;
    background:#f97316;color:#fff;
    margin-bottom:8px;
    position:relative;z-index:1;
  }
  .vsf-mission-text{
    position:relative;z-index:1;
    font-size:.93rem;line-height:1.6;
  }
  .vsf-mission-author{
    position:relative;z-index:1;
    margin-top:10px;
  }
  .vsf-mission-author h4{
    margin:0;font-size:.9rem;font-weight:800;color:#f9fafb;
  }
  .vsf-mission-author h6{
    margin:0;font-size:.8rem;font-weight:500;color:#e5e7eb;
  }

  /* our statements card */
  .vsf-statements{
    position:relative;
    border-radius:18px;
    padding:16px 16px 14px;
    background:linear-gradient(135deg,#f97316,#ec4899);
    color:#fff;
    overflow:hidden;
  }
  .vsf-statements::before{
    content:"";position:absolute;
    width:180px;height:180px;border-radius:999px;
    background:radial-gradient(circle,#fef3c7,transparent);
    right:-60px;top:-80px;opacity:.28;
  }
  .vsf-statements h3{
    margin:0 0 4px;
    font-weight:800;
    font-size:1.1rem;
  }
  .vsf-statements p{
    margin:0 0 8px;
    font-size:.86rem;
  }
  .vsf-statements ul{
    list-style:none;margin:0;padding:0;display:flex;flex-wrap:wrap;gap:6px;
  }
  .vsf-statements li{
    font-size:.8rem;font-weight:700;
    padding:5px 10px;border-radius:999px;
    background:rgba(255,255,255,.16);
    backdrop-filter:blur(8px);
  }

  /* responsive */
  @media (max-width: 991.98px){
    .vsf-about-grid{
      grid-template-columns: minmax(0,1fr);
    }
  }
  @media (max-width: 575.98px){
    .vsf-about-section{ padding:36px 0 34px; }
    .vsf-about-section .vsf-title-wrap h1{
      font-size:1.45rem;
    }
  }
</style>

<section class="vsf-about-section">
  <div class="auto-container">
    <!-- Heading -->
    <div class="vsf-title-wrap">
      <div class="vsf-badge">
        <span class="icon">❤️</span>
        <span>{{ $setting->title }} • About Us</span>
      </div>

      <h1>
        <span>सशक्त भारत</span> का निर्माण,  
        एक कदम समाज सेवा के नाम
      </h1>

      <p class="vsf-sub">
        <strong>{{ $setting->title }}</strong> एक गैर-लाभकारी संस्था है जो वंचित और ज़रूरतमंद बच्चों, परिवारों 
        और समाज के कमजोर वर्गों के सर्वांगीण विकास के लिए समर्पित है – शिक्षा, स्वास्थ्य, पोषण और 
        आत्मनिर्भरता के माध्यम से।
      </p>
    </div>

    <!-- 3-column content -->
    <div class="vsf-about-grid">
      {{-- Left: About text --}}
      <div class="vsf-about-main">
        <h4>हम कौन हैं?</h4>
        <h2>{{ $setting->title }} – आशा, शिक्षा और सशक्तिकरण का संगम</h2>

        <p>
          <b>{{ $setting->title }}</b> एक गैर-लाभकारी संस्था (Non-Profit Organisation) है, 
          जो भारत में वंचित और ज़रूरतमंद बच्चों के सर्वांगीण विकास के लिए कार्यरत है। 
          हमारा उद्देश्य है कि हर बच्चा अपने जीवन की पूरी क्षमता तक पहुँच सके – 
          चाहे वह शारीरिक, मानसिक या शैक्षणिक विकास हो।
        </p>

        <p>
          हम शिक्षा, स्वास्थ्य, पोषण, आवास और कौशल विकास जैसे क्षेत्रों में सतत प्रयास करते हैं ताकि 
          हर बच्चा आत्मनिर्भर, आत्मविश्वासी और समाज का सशक्त नागरिक बन सके। हमारा विश्वास है कि 
          हर बच्चे में उज्जवल भविष्य की एक अनोखी चिंगारी है, बस ज़रूरत है सही अवसर और सही मार्गदर्शन की।
        </p>

        <p>
          <b>{{ $setting->title }}</b> का संकल्प है – 
          <em>“जहाँ ज़रूरत, वहाँ हमारी सेवा; जहाँ अंधेरा, वहाँ हमारे प्रयासों की रोशनी।”</em>
        </p>

        <div class="vsf-pill-row">
          <span class="vsf-pill">Education &amp; Skill Development</span>
          <span class="vsf-pill">Health • Nutrition • Shelter</span>
          <span class="vsf-pill">Dignity &amp; Equal Opportunity</span>
        </div>
      </div>

      {{-- Middle: Photo + overlay --}}
      <div class="vsf-about-photo-card">
        <img src="{{ asset('frontend/custom/co-president.jpg') }}" alt="Vihatmaa Sewa Foundation Leader">

        <div class="vsf-photo-overlay">
          <h4>{{ $setting->meta_author }}</h4>
          <span>Manager, {{ $setting->title }}</span>
          <span style="font-size:.78rem;opacity:.9;">
            “सेवा ही हमारा धर्म, और सशक्तिकरण ही हमारा लक्ष्य है।”
          </span>
        </div>
      </div>

      {{-- Right: Mission + Our Statements --}}
      <div class="vsf-right-stack">
        <div class="vsf-mission-box">
          <div class="vsf-mission-icon">
            <i class="flaticon-quote"></i>
          </div>

          <div class="vsf-mission-text">
            हमारा मिशन उन वंचित और उपेक्षित वर्गों को उनकी वास्तविक क्षमता का बोध कराना,
            उन्हें शिक्षित, सशक्त और आत्मनिर्भर बनाना है — ताकि वे न केवल अपने जीवन को बेहतर
            बना सकें, बल्कि समाज के उज्जवल भविष्य के निर्माण में भी भागीदार बनें।
          </div>

          <div class="vsf-mission-author">
            <h4>{{ $setting->meta_author }}</h4>
            <h6>Manager • {{ $setting->title }}</h6>
          </div>
        </div>

        <div class="vsf-statements">
          <h3>Our Statements</h3>
          <p>
            {{ $setting->title }} 6 मुख्य सिद्धांतों पर कार्य करता है – 
            यही हमारे काम की पहचान और समाज सेवा की प्रेरणा हैं।
          </p>
          <ul>
            <li>Noble Intentions</li>
            <li>Initiative to Serve</li>
            <li>Educate Every Child</li>
            <li>Develop Communities</li>
            <li>Empower for Tomorrow</li>
            <li>Attribute Towards a Better Nation</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

@include ("frontend.partials.donate.style-2")

@endsection
