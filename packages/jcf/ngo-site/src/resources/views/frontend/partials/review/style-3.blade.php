<section class="rv-section">
  <div class="container position-relative">
    <h3 class="rv-title">What people say</h3>

    <div class="rv-viewport edge-fade" id="rvViewport">
      <div class="rv-track" id="rvTrack">
        <!-- Card 1 -->
        <article class="rv-card">
          <img class="rv-avatar" src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?w=300&q=80" alt="">
          <h4 class="rv-name">आरोही शर्मा</h4>
          <span class="rv-role">स्वयंसेवक · महादेव मानव कल्याण समिति</span>
          <p class="rv-text">“यह संस्था समाज के लिए बहुत प्रेरणादायक काम कर रही है। शिक्षा और महिला सशक्तिकरण में योगदान सराहनीय है।”</p>
          <div class="rv-stars">★★★★★</div>
        </article>

        <!-- Card 2 -->
        <article class="rv-card">
          <img class="rv-avatar" src="https://images.unsplash.com/photo-1542909168-82c3e7fdca5c?w=300&q=80" alt="">
          <h4 class="rv-name">विवेक मिश्रा</h4>
          <span class="rv-role">दानकर्ता</span>
          <p class="rv-text">“एमडीएमकेएस पर दान करना आसान और सुरक्षित है। पारदर्शी रिपोर्ट्स भरोसा बढ़ाती हैं।”</p>
          <div class="rv-stars">★★★★★</div>
        </article>

        <!-- Card 3 -->
        <article class="rv-card">
          <img class="rv-avatar" src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?w=300&q=80" alt="">
          <h4 class="rv-name">Sana</h4>
          <span class="rv-role">Community Member</span>
          <p class="rv-text">“स्वास्थ्य शिविर और शिक्षा पहल, दोनों का असर साफ दिखता है।”</p>
          <div class="rv-stars">★★★★☆</div>
        </article>
      </div>
    </div>

    <!-- Arrows -->
    <button class="rv-arrow rv-prev" type="button" aria-label="Previous">&#10094;</button>
    <button class="rv-arrow rv-next" type="button" aria-label="Next">&#10095;</button>
  </div>
</section>

<style>
/* --- Big slider styles --- */
.rv-section{ padding:56px 0; background:#f6f9fc;}
.rv-title{ font-size:24px; font-weight:800; color:#0f172a; margin-bottom:18px;}

.rv-viewport{
  overflow-x:auto; overflow-y:visible;
  scroll-snap-type:x mandatory;
  -webkit-overflow-scrolling:touch;
  padding-bottom:8px;
}
.rv-track{
  display:flex; gap:20px; padding:6px 8px;
  transform: translateX(-12px); /* peek from outside */
}

.rv-card{
  flex:0 0 clamp(280px, 55vw, 520px);
  scroll-snap-align:center;
  background:#fff;
  border-radius:20px;
  box-shadow:0 10px 30px rgba(2,6,23,.08);
  padding:28px 22px;
  text-align:center;
  border:1px solid rgba(2,6,23,.06);
}
.rv-avatar{
  width:96px; height:96px; border-radius:50%;
  object-fit:cover; display:block; margin:0 auto 14px auto;
  box-shadow:0 0 0 6px #fff, 0 6px 18px rgba(15,23,42,.15);
}
.rv-name{ margin:0; font-size:22px; font-weight:800; color:#0f172a;}
.rv-role{ display:block; color:#64748b; font-size:14px; margin-top:4px;}
.rv-text{ color:#334155; font-size:16px; line-height:1.8; margin:12px 0 10px;}
.rv-stars{ color:#f59e0b; letter-spacing:2px; font-size:18px;}
.edge-fade{
  -webkit-mask-image: linear-gradient(90deg, transparent 0, #000 28px, #000 calc(100% - 28px), transparent 100%);
  mask-image: linear-gradient(90deg, transparent 0, #000 28px, #000 calc(100% - 28px), transparent 100%);
}
.rv-arrow{
  position:absolute; top:50%; transform:translateY(-50%);
  width:42px; height:42px; border-radius:999px; border:0;
  background:#fff; box-shadow:0 8px 20px rgba(2,6,23,.12);
  color:#0f172a; font-size:20px; line-height:42px; text-align:center;
  z-index:2;
}
.rv-prev{ left:-6px; }
.rv-next{ right:-6px; }
.rv-arrow:active{ transform:translateY(-50%) scale(.98); }
@media (max-width: 768px){
  .rv-card{ flex-basis: 86vw; }
  .rv-prev{ left:2px;} .rv-next{ right:2px;}
}
</style>

<script>
/* --- Index-based navigation so arrows work perfectly on mobile --- */
(function(){
  const viewport = document.getElementById('rvViewport');
  const track = document.getElementById('rvTrack');
  const prevBtn = document.querySelector('.rv-prev');
  const nextBtn = document.querySelector('.rv-next');
  const cards = Array.from(track.querySelectorAll('.rv-card'));

  // compute the closest card index to current scrollLeft
  function currentIndex(){
    const left = viewport.scrollLeft;
    let idx = 0, min = Infinity;
    cards.forEach((card, i) => {
      const x = card.offsetLeft - 12; // compensate starting translate
      const d = Math.abs(left - x);
      if(d < min){ min = d; idx = i; }
    });
    return idx;
  }

  function scrollToIndex(i){
    i = Math.max(0, Math.min(cards.length - 1, i));
    const target = cards[i].offsetLeft - 12; // align to card start
    viewport.scrollTo({ left: target, behavior: 'smooth' });
  }

  prevBtn.addEventListener('click', () => {
    scrollToIndex(currentIndex() - 1);
  });
  nextBtn.addEventListener('click', () => {
    scrollToIndex(currentIndex() + 1);
  });

  // Allow swipe as well—snap stays intact
  // (No autoplay to keep arrows 100% responsive on mobile)
})();
</script>
