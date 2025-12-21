{{-- ========== HOME FAQ SECTION ========== --}}
<style>
  .hp-faq-section{
    --blue:#0000fe;
    --lemon:#e3feb1;

    padding:50px 0 60px;
    font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
    background:#f8fafc;
  }

  .hp-faq-section .hp-faq-wrap{
    background:#ffffff;
    border-radius:24px;
    padding:26px 22px 30px;
    box-shadow:0 20px 60px rgba(15,23,42,.18);
    position:relative;
    overflow:hidden;
  }

  /* soft gradient halo */
  .hp-faq-section .hp-faq-wrap::before{
    content:"";
    position:absolute;
    inset:-60%;
    background:radial-gradient(circle at 0% 0%, rgba(227,254,177,.45), transparent 55%),
               radial-gradient(circle at 100% 100%, rgba(0,0,254,.22), transparent 60%);
    opacity:.7;
    pointer-events:none;
  }

  .hp-faq-inner{
    position:relative;
    z-index:1;
  }

  /* LEFT: intro */
  .hp-faq-left h6{
    text-transform:uppercase;
    letter-spacing:.22em;
    font-size:.78rem;
    color:#6366f1;
    margin-bottom:6px;
    font-weight:700;
  }
  .hp-faq-left h2{
    font-size:1.9rem;
    font-weight:900;
    color:#020617;
    margin-bottom:8px;
  }
  .hp-faq-left p{
    color:#4b5563;
    font-size:.95rem;
    margin-bottom:14px;
  }
  .hp-faq-left .hp-faq-chip{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:6px 12px;
    border-radius:999px;
    background:linear-gradient(90deg,var(--lemon),var(--blue));
    color:#020617;
    font-size:.8rem;
    font-weight:800;
    box-shadow:0 8px 20px rgba(15,23,42,.25);
  }

  /* RIGHT: accordion */
  .hp-faq-accordion{
    list-style:none;
    margin:0;
    padding:0;
  }
  .hp-faq-item{
    border-radius:14px;
    background:rgba(255,255,255,.82);
    border:1px solid rgba(148,163,184,.4);
    margin-bottom:10px;
    overflow:hidden;
    backdrop-filter:blur(4px);
    transition:box-shadow .18s ease,border-color .18s ease,transform .18s ease;
  }
  .hp-faq-item.is-open{
    box-shadow:0 14px 40px rgba(15,23,42,.18);
    border-color:rgba(0,0,254,.35);
    transform:translateY(-1px);
  }

  .hp-faq-question{
    width:100%;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
    padding:12px 14px;
    background:transparent;
    border:none;
    cursor:pointer;
    text-align:left;
  }
  .hp-faq-q-label{
    display:flex;
    align-items:center;
    gap:8px;
    color:#020617;
    font-weight:700;
    font-size:.95rem;
  }
  .hp-faq-q-label span.hp-faq-dot{
    width:18px;
    height:18px;
    border-radius:999px;
    background:linear-gradient(135deg,var(--blue),var(--lemon));
    display:inline-flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:.7rem;
  }
  .hp-faq-toggle{
    width:26px;
    height:26px;
    border-radius:999px;
    border:1px solid rgba(148,163,184,.9);
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    background:#f8fafc;
    color:#020617;
  }
  .hp-faq-item.is-open .hp-faq-toggle{
    background:linear-gradient(135deg,var(--lemon),var(--blue));
    color:#020617;
    border-color:transparent;
  }

  .hp-faq-answer{
    max-height:0;
    overflow:hidden;
    padding:0 14px;
    transition:max-height .22s ease,padding-bottom .22s ease;
  }
  .hp-faq-item.is-open .hp-faq-answer{
    padding-bottom:10px;
  }
  .hp-faq-answer p{
    margin:0;
    font-size:.9rem;
    color:#4b5563;
  }

  /* layout tweaks */
  @media (min-width: 992px){
    .hp-faq-cols{
      display:flex;
      align-items:flex-start;
      gap:28px;
    }
    .hp-faq-left{ flex:0 0 38%; max-width:38%; }
    .hp-faq-right{ flex:1; }
  }

  @media (max-width: 991.98px){
    .hp-faq-section{
      padding:40px 0 44px;
    }
    .hp-faq-wrap{
      padding:20px 14px 22px;
    }
    .hp-faq-left h2{
      font-size:1.5rem;
    }
    .hp-faq-left{
      margin-bottom:14px;
    }
  }
</style>

<section class="hp-faq-section">
  <div class="auto-container">
    <div class="hp-faq-wrap">
      <div class="hp-faq-inner">
        <div class="hp-faq-cols">
          {{-- LEFT: intro copy --}}
          <div class="hp-faq-left">
            <h6>Have Questions?</h6>
            <h2>FAQ’s About <span style="color:#0000fe;">{{$sitting->title}}</span></h2>
            <p>
              We know you may want to understand how your support is used,
              how we work with communities, and how you can get more involved.
              Here are some of the most asked questions from our donors and well-wishers.
            </p>
            <span class="hp-faq-chip">
              <i class="fas fa-question-circle"></i>
              Clear answers. Honest impact.
            </span>
          </div>

          {{-- RIGHT: dynamic accordion from DB --}}
          <div class="hp-faq-right">
            @if($faq->count())
              <ul class="hp-faq-accordion" id="hp-faq-accordion">
                @foreach($faq as $index => $ques)
                  @php $isOpen = $index === 0; @endphp
                  <li class="hp-faq-item {{ $isOpen ? 'is-open' : '' }}">
                    <button class="hp-faq-question"
                            type="button"
                            aria-expanded="{{ $isOpen ? 'true' : 'false' }}">
                      <span class="hp-faq-q-label">
                        <span class="hp-faq-dot"><i class="fas fa-q"></i></span>
                        {{ $ques->question }}
                      </span>
                      <span class="hp-faq-toggle">
                        <i class="fas {{ $isOpen ? 'fa-minus' : 'fa-plus' }}"></i>
                      </span>
                    </button>
                    <div class="hp-faq-answer">
                      <p>{{ $ques->answer }}</p>
                    </div>
                  </li>
                @endforeach
              </ul>
            @else
              <p style="color:#4b5563;">FAQ’s will be updated soon.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    const accordion = document.getElementById('hp-faq-accordion');
    if (!accordion) return;

    const items = accordion.querySelectorAll('.hp-faq-item');

    items.forEach(item => {
      const btn = item.querySelector('.hp-faq-question');
      const answer = item.querySelector('.hp-faq-answer');
      const icon = item.querySelector('.hp-faq-toggle i');

      // set initial height
      if (item.classList.contains('is-open')) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
      }

      btn.addEventListener('click', () => {
        const isOpen = item.classList.contains('is-open');

        // close all
        items.forEach(other => {
          if (other !== item) {
            other.classList.remove('is-open');
            const a = other.querySelector('.hp-faq-answer');
            const i = other.querySelector('.hp-faq-toggle i');
            a.style.maxHeight = null;
            other.querySelector('.hp-faq-question')
                 .setAttribute('aria-expanded', 'false');
            i.classList.remove('fa-minus');
            i.classList.add('fa-plus');
          }
        });

        // toggle current
        if (!isOpen) {
          item.classList.add('is-open');
          answer.style.maxHeight = answer.scrollHeight + 'px';
          btn.setAttribute('aria-expanded', 'true');
          icon.classList.remove('fa-plus');
          icon.classList.add('fa-minus');
        } else {
          item.classList.remove('is-open');
          answer.style.maxHeight = null;
          btn.setAttribute('aria-expanded', 'false');
          icon.classList.remove('fa-minus');
          icon.classList.add('fa-plus');
        }
      });
    });
  })();
</script>
