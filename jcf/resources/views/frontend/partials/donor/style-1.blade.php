


  <style>
    /* Basic reset just for this demo page.
       When you paste into your own site, you can remove body + * if you like. */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
        sans-serif;
    }

    /* body {
      background: #f5f5f5;
      padding: 40px;
    } */

    /* All classes are prefixed with vsf- to avoid conflicts */

    .vsf-donor-wrapper {
      width: 100%;
      max-width: 420px;
      margin: 0 auto;
      background: linear-gradient(135deg, #ffffff 0%, #fff7f2 45%, #ffe7d9 100%);
      border-radius: 32px;
      padding: 24px 22px 26px;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
      color: #222222;
      overflow: hidden;
      position: relative;
      border: 1px solid rgba(255, 255, 255, 0.9);
    }

    .vsf-donor-header {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 8px;
      margin-bottom: 18px;
    }

    .vsf-donor-header-top {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .vsf-donor-header-title {
      font-size: 1.2rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
      color: #ff5a1f;
    }

    .vsf-donor-header-title-icon {
      font-size: 1.2rem;
    }

    .vsf-donor-badge {
      font-size: 0.75rem;
      text-transform: uppercase;
      background: #00a5e2;
      color: #ffffff;
      padding: 5px 14px;
      border-radius: 999px;
      font-weight: 800;
      box-shadow: 0 0 14px rgba(255, 193, 7, 0.6);
      white-space: nowrap;
      border: 1px solid rgba(255, 255, 255, 0.9);
    }

    .vsf-donor-subtitle {
      font-size: 0.85rem;
      opacity: 0.9;
      line-height: 1.4;
      color: #374151;
    }

    .vsf-donor-slider-viewport {
      margin-top: 6px;
      border-radius: 22px;
      background: rgba(255, 255, 255, 0.85);
      padding: 14px 10px 18px;
      overflow: hidden;
      position: relative;
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.9);
    }

    .vsf-donor-slider {
      display: flex;
      gap: 18px;
      overflow-x: auto;
      padding-bottom: 4px;
      scroll-behavior: auto;
    }

    .vsf-donor-slider::-webkit-scrollbar {
      display: none;
    }

    .vsf-donor-slider {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .vsf-donor-card {
      flex: 0 0 260px;
      background: radial-gradient(circle at top, rgba(255, 255, 255, 0.9), #00a5e2);
      border-radius: 18px;
      padding: 16px 16px 18px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 12px 28px rgba(249, 115, 22, 0.35);
      border: 1px solid rgba(255, 255, 255, 0.9);
      transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
      color: #ffffff;
    }

    .vsf-donor-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.6), transparent 55%);
      opacity: 0.8;
      mix-blend-mode: screen;
      pointer-events: none;
    }

    .vsf-donor-card:hover {
      transform: translateY(-6px) scale(1.02);
      box-shadow: 0 18px 40px rgba(249, 115, 22, 0.45);
      border-color: #ffeb3b;
    }

    .vsf-donor-rank-chip {
      position: absolute;
      top: 10px;
      left: 10px;
      font-size: 0.7rem;
      text-transform: uppercase;
      padding: 4px 10px;
      border-radius: 999px;
      background: rgba(0, 0, 0, 0.55);
      border: 1px solid rgba(255, 255, 255, 0.85);
      display: flex;
      align-items: center;
      gap: 4px;
      z-index: 1;
    }

    .vsf-donor-rank-chip-icon {
      font-size: 0.9rem;
    }

    .vsf-donor-image-wrapper {
      display: flex;
      justify-content: center;
      margin-bottom: 10px;
      margin-top: 8px;
    }

    .vsf-donor-image {
      width: 96px;
      height: 96px;
      border-radius: 50%;
      border: 3px solid rgba(255, 255, 255, 0.95);
      object-fit: cover;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.4);
      background: #fff;
    }

    .vsf-donor-name {
      text-align: center;
      font-size: 1.05rem;
      font-weight: 800;
      letter-spacing: 0.03em;
      margin-bottom: 4px;
      text-transform: uppercase;
    }

    .vsf-donor-tagline {
      text-align: center;
      font-size: 0.85rem;
      opacity: 0.95;
      margin-bottom: 10px;
    }

    .vsf-donor-stars-wrap {
      display: flex;
      justify-content: center;
    }

    .vsf-donor-stars {
      display: inline-flex;
      justify-content: center;
      gap: 3px;
      margin-bottom: 8px;
      padding: 4px 10px;
      border-radius: 999px;
      background: rgba(0, 0, 0, 0.55);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.5);
    }

    .vsf-star {
      font-size: 1.1rem;
      text-shadow: 0 0 4px rgba(255, 255, 255, 0.9),
                   0 0 10px rgba(255, 193, 7, 0.9);
    }

    .vsf-star-gold {
      color: #ffeb3b;
    }

    .vsf-star-dim {
      color: rgba(255, 255, 255, 0.45);
    }

    .vsf-donor-amount-wrapper {
      display: flex;
      justify-content: center;
    }

    .vsf-donor-amount {
      text-align: center;
      font-size: 0.9rem;
      font-weight: 700;
      padding: 7px 12px;
      border-radius: 999px;
      background: #e18c25;
      border: 1px solid rgba(255, 255, 255, 0.95);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin: 0 auto 10px;
      color: #ffffff;
    }

    .vsf-donor-amount-label {
      opacity: 0.9;
      font-size: 0.8rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }

    .vsf-donor-amount-value {
      font-size: 0.95rem;
    }

    .vsf-donor-footer {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      font-size: 0.8rem;
      opacity: 0.97;
      margin-top: 6px;
    }

    .vsf-donor-spark {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #ffeb3b;
      box-shadow: 0 0 12px rgba(255, 235, 59, 0.9);
      animation: vsf-pulse 1.4s infinite alternate;
    }

    @keyframes vsf-pulse {
      from {
        transform: scale(0.8);
        opacity: 0.7;
      }
      to {
        transform: scale(1.2);
        opacity: 1;
      }
    }

    .vsf-donor-glow-dot-row {
      display: flex;
      justify-content: center;
      gap: 6px;
      margin-top: 10px;
    }

    .vsf-donor-glow-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: rgba(249, 115, 22, 0.3);
      box-shadow: 0 0 8px rgba(249, 115, 22, 0.4);
    }

    @media (max-width: 480px) {
      body {
        padding: 16px;
      }
      .vsf-donor-wrapper {
        padding: 20px 16px 22px;
        border-radius: 26px;
      }
      .vsf-donor-card {
        flex: 0 0 230px;
      }
    }
  </style>

<section>
    <div class="vsf-donor-wrapper">
        <div class="vsf-donor-header">
            <div class="vsf-donor-header-top">
                <div class="vsf-donor-header-title">
                    <span class="vsf-donor-header-title-icon">⭐</span>
                    <span>TOP DONORS WALL</span>
                </div>
                <span class="vsf-donor-badge">Premium Supporters</span>
            </div>
            <div class="vsf-donor-subtitle">
                Thank you for powering our mission.<br />
                Every star here represents a real impact.
            </div>
        </div>

        <div class="vsf-donor-slider-viewport">
            <div class="vsf-donor-slider" id="vsfDonorSlider">

                @if(isset($donors) && count($donors) > 0)
                    @foreach($donors as $list)
                        <div class="vsf-donor-card">

                            {{-- Rank chip example (you can change logic) --}}
                            <div class="vsf-donor-rank-chip">
                                @if($loop->first)
                                    <span class="vsf-donor-rank-chip-icon">🔥</span> Legend
                                @elseif($loop->iteration <= 3)
                                    <span class="vsf-donor-rank-chip-icon">⭐</span> Elite
                                @else
                                    <span class="vsf-donor-rank-chip-icon">🌟</span> Supporter
                                @endif
                            </div>

                            {{-- Donor photo --}}
                            <div class="vsf-donor-image-wrapper">
                                @if(!empty($list->profile))
                                    <img class="vsf-donor-image"
                                         src="{{ asset('backend/uploads/'.$list->profile) }}"
                                         alt="{{ $list->name ?? 'Donor' }}">
                                @else
                                    <img class="vsf-donor-image"
                                         src="{{ asset('frontend/custom/user.png') }}"
                                         alt="Donor">
                                @endif
                            </div>

                            {{-- Donor name --}}
                            <div class="vsf-donor-name">
                                {{ $list->name ?? 'Anonymous Donor' }}
                            </div>

                            {{-- Optional tagline = city --}}
                            @if(!empty($list->city))
                                <div class="vsf-donor-tagline">
                                    {{ $list->city }}
                                </div>
                            @endif

                            {{-- Stars (static 4.5 as example, adjust if you want dynamic rating) --}}
                            <div class="vsf-donor-stars-wrap">
                                <div class="vsf-donor-stars">
                                    <span class="vsf-star vsf-star-gold">★</span>
                                    <span class="vsf-star vsf-star-gold">★</span>
                                    <span class="vsf-star vsf-star-gold">★</span>
                                    <span class="vsf-star vsf-star-gold">★</span>
                                    <span class="vsf-star vsf-star-dim">★</span>
                                </div>
                            </div>

                            {{-- Donation amount (change "amount" to your actual field) --}}
                            @if(!empty($list->amount))
                                <div class="vsf-donor-amount-wrapper">
                                    <div class="vsf-donor-amount">
                                        <span class="vsf-donor-amount-value">
                                            ₹ {{ number_format($list->amount) }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            {{-- Footer label --}}
                            <div class="vsf-donor-footer">
                                <span class="vsf-donor-spark"></span>
                                <span>Golden Star Donor</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p style="padding:10px 0; text-align:center;">No donors found yet.</p>
                @endif

            </div>

            <div class="vsf-donor-glow-dot-row">
                <div class="vsf-donor-glow-dot"></div>
                <div class="vsf-donor-glow-dot"></div>
                <div class="vsf-donor-glow-dot"></div>
                
            </div>
            <div class="vsf-donor-glow-dot-row">
            <a href="{{url('/our-donors')}}" >  <span class="vsf-donor-badge">View All Donors</span>
        
    </a>
              
            </div>
             
        </div>
    </div>
</section>

  <script>
    // Auto-slide with unique ID & variable names
    const vsfDonorSlider = document.getElementById("vsfDonorSlider");
    let vsfLastTimestamp = null;

    function vsfAutoSlide(timestamp) {
      if (!vsfLastTimestamp) vsfLastTimestamp = timestamp;
      const elapsed = timestamp - vsfLastTimestamp;

      if (elapsed > 30) {
        vsfDonorSlider.scrollLeft += 1;
        if (
          vsfDonorSlider.scrollLeft >=
          vsfDonorSlider.scrollWidth - vsfDonorSlider.clientWidth - 2
        ) {
          vsfDonorSlider.scrollLeft = 0;
        }
        vsfLastTimestamp = timestamp;
      }
      window.requestAnimationFrame(vsfAutoSlide);
    }

    let vsfIsHovered = false;

    vsfDonorSlider.addEventListener("mouseenter", () => {
      vsfIsHovered = true;
    });

    vsfDonorSlider.addEventListener("mouseleave", () => {
      vsfIsHovered = false;
    });

    function vsfHoverAwareSlide(timestamp) {
      if (!vsfIsHovered) {
        vsfAutoSlide(timestamp);
      } else {
        vsfLastTimestamp = timestamp;
        window.requestAnimationFrame(vsfHoverAwareSlide);
      }
    }

    window.requestAnimationFrame(vsfHoverAwareSlide);
  </script>
