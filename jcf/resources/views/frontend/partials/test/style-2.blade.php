{{-- resources/views/frontend/partials/test/style-2.blade.php --}}
{{-- Inline-scoped partial. Safe to include inside any page. --}}
<style>
  /* ======= STRICTLY SCOPED TO THIS WRAPPER ======= */
  #kp-food-1 {
    --kp-ink: #1a2730;
    --kp-muted: #6d7b7b;
    --kp-line: #dfe7ee;
    --kp-card-border: #cbd8e6;
    --kp-progress-bg: #edf2f6;
    --kp-progress-fill: #ffd34d;
    --kp-btn: #4cd964;
    color: var(--kp-ink);
    font-family: Poppins, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  }
  #kp-food-1, #kp-food-1 * { box-sizing: border-box; }
  #kp-food-1 img { max-width: 100% !important; height: auto !important; display: block !important; }

  #kp-food-1 .kp-wrap { max-width: 420px; width: 100%; margin: 0 auto; }
  #kp-food-1 .kp-card { border: 1px solid var(--kp-card-border); border-radius: 12px; overflow: hidden; box-shadow: 0 10px 24px rgba(0,0,0,.06); background: #fff; }
  #kp-food-1 .kp-title { margin: 12px; text-align: center; font-family: Georgia, "Times New Roman", serif; line-height: 1.1; font-size: 22px; }
  #kp-food-1 .kp-media img { width: 100%; aspect-ratio: 4/3; object-fit: cover; border-top: 1px solid var(--kp-line); border-bottom: 1px solid var(--kp-line); }

  #kp-food-1 .kp-kv { display: flex; justify-content: space-between; padding: 12px 16px; border-top: 1px solid var(--kp-line); border-bottom: 1px solid var(--kp-line); font-weight: 900; }
  #kp-food-1 .kp-kv small { display: block; font-weight: 700; color: #55626f; }

  #kp-food-1 .kp-progress { padding: 10px 16px; }
  #kp-food-1 .kp-progress .kp-label { font-weight: 900; margin-bottom: 6px; }
  #kp-food-1 .kp-bar { height: 10px; background: var(--kp-progress-bg); border-radius: 999px; overflow: hidden; }
  #kp-food-1 .kp-fill { height: 100%; width: 5%; background: var(--kp-progress-fill); border-radius: 999px; }

  #kp-food-1 .kp-btn { display: block; margin: 12px 16px; background: var(--kp-btn); color: #fff !important; text-align: center; font-weight: 900; border: none; border-radius: 8px; padding: 14px 16px; text-decoration: none; cursor: pointer; }
  #kp-food-1 .kp-secure { display: flex; align-items: center; gap: 8px; justify-content: center; color: var(--kp-muted); font-size: .95rem; margin: 0 0 14px; }
</style>

<div id="kp-food-1">
  <div class="kp-wrap">
    <article class="kp-card">
      <div class="kp-title">Food Assistance</div>
      <div class="kp-media">
        <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=1400&auto=format&fit=crop" alt="Food assistance program">
      </div>

      <div class="kp-kv">
        <div><div>8K</div><small>Raised</small></div>
        <div><div>3</div><small>Donations</small></div>
        <div><div>₹ 50L</div><small>Goal</small></div>
      </div>

      <div class="kp-progress">
        <div class="kp-label">₹5 Collection</div>
        <div class="kp-bar"><div class="kp-fill" style="width:5%"></div></div>
      </div>

      <a class="kp-btn" href="/donate">❤ Donate Now</a>
      <div class="kp-secure">🔒 100% Secure Donation</div>
    </article>
  </div>
</div>
