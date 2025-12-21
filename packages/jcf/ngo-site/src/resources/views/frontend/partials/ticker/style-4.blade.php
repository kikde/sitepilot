<style>
    :root{
      --page-bg: #eef2ff;
      --frame-bg: #e32317;
      --frame-border: #ed801b;
      --panels-bg: #eef2ff;
      --text:#0f172a;
      --muted:#475569;
      --radius:18px;
      --frame-padding:18px;
      --frame-height:300px;
      --speed:30s
    }
    *{box-sizing:border-box}
    /* body{
      margin:0;
      font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Noto Sans",Arial;
      background:var(--page-bg);
      color:var(--text);
      min-height:100dvh; display:grid; place-items:center; padding:18px;
    } */
    .wrap{max-width:900px;width:100%}
    .title{font-weight:800;margin:0 0 10px 4px}
    .hint{color:var(--muted);margin:0 0 14px 4px}

    .frame{position:relative;border-radius:var(--radius);padding:6px;
      background:linear-gradient(180deg,var(--frame-border),#0b1a70 60%,var(--frame-border));
      box-shadow:0 12px 26px rgba(2,6,23,.15);
    }
    .frame::before{content:"";position:absolute;inset:0;border-radius:var(--radius);padding:3px;
      background:linear-gradient(135deg,#9ab0ff,transparent 40%);
      -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);
      -webkit-mask-composite:xor;mask-composite:exclude;
    }
    .frame-inner{border-radius:calc(var(--radius) - 6px);background:var(--frame-bg);
      padding:var(--frame-padding);border:1px solid rgba(255,255,255,.35);
    }
    .panels{background: #fff !important; border-radius:12px;padding:16px;height:var(--frame-height);
      overflow:hidden;position:relative;box-shadow:inset 0 0 0 1px rgba(15,23,42,.08);
    }
    .panels::before,.panels::after{content:"";position:absolute;left:0;right:0;height:24px;pointer-events:none}
    .panels::before{top:0;background:linear-gradient(#eef2ff,transparent)}
    .panels::after{bottom:0;background:linear-gradient(transparent,#eef2ff)}
    .track{display:flex;flex-direction:column;gap:18px;animation:scroll-up var(--speed) linear infinite}
    .item{font-size:1.05rem;line-height:1.7;color:#0b1b48;text-align:center;padding:10px 8px}
    .item strong{color:#0a1f9c}
    .item .sub{color:#334155;font-size:.98rem}
    .track>.chunk{display:flex;flex-direction:column;gap:18px}
    @keyframes scroll-up{from{transform:translateY(100%)}to{transform:translateY(-100%)}}
    .panels:hover .track{animation-play-state:paused}
    @media (prefers-reduced-motion: reduce){.track{animation:none}}


 /* Container for this button only */
  #kp-btns-4{
    margin-top:12px;
    margin-bottom:12px;
  }

  /* center the button */
  #kp-btns-4 .row{
    display:flex;
    justify-content:center;
  }

  /* optional: keep it a nice max-width if you want */
  #kp-btns-4 .wrap{
    max-width:900px;
    width:100%;
    margin:0 auto;
  }

  /* Base Button – only inside #kp-btns-4 */
  #kp-btns-4 .btn{
    --btn-bg:#111827; --btn-fg:#fff; --btn-r:12px;
    appearance:none; border:none; outline:none;
    display:inline-flex; align-items:center; justify-content:center; gap:10px;
    padding:12px 18px; border-radius:var(--btn-r);
    background:var(--btn-bg); color:var(--btn-fg);
    box-shadow:0 8px 18px rgba(0,0,0,.12);
    cursor:pointer; text-decoration:none;
    font-weight:900; letter-spacing:.3px; text-transform:uppercase;
    transition:transform .08s ease, filter .2s ease,
               box-shadow .2s ease, background .2s ease;
  }

  #kp-btns-4 .btn:active{
    transform:translateY(1px) scale(.98);
  }

  #kp-btns-4 .pill{
    border-radius:999px;
  }

  #kp-btns-4 .g1{
    background:linear-gradient(135deg,#ff4d4d,#ff934d);
  }

  </style>

<div id="kp-btns-4">
    <button class="btn pill"
            style="background:#fff; color:#1a52ff; border:3px solid #392482">
      Latest Activity
    </button>
  </div>

  <main class="wrap">
   
    <section class="frame" aria-label="Colored frame with vertical scroller">
      <div class="frame-inner">
        <div class="panels" role="region" aria-live="polite">
          <div class="track">
            <!-- chunk A -->
            <div class="chunk">
              <div class="item"><strong>संदेश 01:</strong> देश में पहली बार ऐसी क्रांति लाएँगे जो युवाओं की सोच और जोश को सम्मान दे।</div>
              <div class="item"><strong>संदेश 02:</strong> सर्व समाज एकता मिशन संगठन द्वारा भारत सरकार संचालित <span class="sub">नमामि गंगे</span> व नेहरू युवा केंद्र भारत के सहयोग से कार्यक्रम।</div>
              <div class="item"><strong>संदेश 03:</strong> माँ दुर्गा का जागरण—गायक साथी अग्रवाल, सर्व समाज एकता मिशन।</div>
              <div class="item"><strong>संदेश 04:</strong> डेमो लाइन—यह फ्रेम रंगीन बॉर्डर के साथ है और कंटेंट अंदर नीचे से ऊपर स्क्रोल होता है।</div>
              <div class="item"><strong>संदेश 05:</strong> डेमो लाइन—यह फ्रेम रंगीन बॉर्डर के साथ है और कंटेंट अंदर नीचे से ऊपर स्क्रोल होता है।</div>
              <div class="item"><strong>संदेश 06:</strong> यह लाइन केवल परीक्षण के लिए है ताकि आप स्क्रॉल मूवमेंट साफ़ देख सकें।</div>
              <div class="item"><strong>संदेश 07:</strong> मोबाइल‑फ्रेंडली—ऊँचाई ऑटो एडजस्ट और होवर पर पॉज़।</div>
              <div class="item"><strong>संदेश 08:</strong> लगातार लूप के लिए नीचे वही कंटेंट दोहराया गया है।</div>
              <div class="item"><strong>संदेश 09:</strong> यह एक और डेमो लाइन—यदि आप चाहें तो इमोजी 🙂 भी चला सकते हैं।</div>
              <div class="item"><strong>संदेश 10:</strong> धन्यवाद! अब आपको स्पष्ट दिखेगा कि टेक्स्ट नीचे से ऊपर जा रहा है।</div>
            </div>
            <!-- chunk B (repeat for seamless loop) -->
            <div class="chunk">
              <div class="item"><strong>संदेश 01:</strong> देश में पहली बार ऐसी क्रांति लाएँगे जो युवाओं की सोच और जोश को सम्मान दे।</div>
              <div class="item"><strong>संदेश 02:</strong> सर्व समाज एकता मिशन संगठन द्वारा भारत सरकार संचालित <span class="sub">नमामि गंगे</span> व नेहरू युवा केंद्र भारत के सहयोग से कार्यक्रम।</div>
              <div class="item"><strong>संदेश 03:</strong> माँ दुर्गा का जागरण—गायक साथी अग्रवाल, सर्व समाज एकता मिशन।</div>
              <div class="item"><strong>संदेश 04:</strong> डेमो लाइन—यह फ्रेम रंगीन बॉर्डर के साथ है और कंटेंट अंदर नीचे से ऊपर स्क्रोल होता है।</div>
              <div class="item"><strong>संदेश 05:</strong> डेमो लाइन—यह फ्रेम रंगीन बॉर्डर के साथ है और कंटेंट अंदर नीचे से ऊपर स्क्रोल होता है।</div>
              <div class="item"><strong>संदेश 06:</strong> यह लाइन केवल परीक्षण के लिए है ताकि आप स्क्रॉल मूवमेंट साफ़ देख सकें।</div>
              <div class="item"><strong>संदेश 07:</strong> मोबाइल‑फ्रेंडली—ऊँचाई ऑटो एडजस्ट और होवर पर पॉज़।</div>
              <div class="item"><strong>संदेश 08:</strong> लगातार लूप के लिए नीचे वही कंटेंट दोहराया गया है।</div>
              <div class="item"><strong>संदेश 09:</strong> यह एक और डेमो लाइन—यदि आप चाहें तो इमोजी 🙂 भी चला सकते हैं।</div>
              <div class="item"><strong>संदेश 10:</strong> धन्यवाद! अब आपको स्पष्ट दिखेगा कि टेक्स्ट नीचे से ऊपर जा रहा है।</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

