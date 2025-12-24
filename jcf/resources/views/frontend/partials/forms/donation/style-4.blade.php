{{-- resources/views/frontend/partials/section/style-donation-form-slim.blade.php --}}
<style>
  #kp-donate-slim{--ink:#15212c;--muted:#6f7b7a;--accent:#f0ad3d;color:var(--ink);font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
  #kp-donate-slim,#kp-donate-slim *{box-sizing:border-box}
  #kp-donate-slim .card{max-width:420px;width:100%;background:#fff;border-radius:8px;box-shadow:0 14px 30px rgba(0,0,0,.08);padding:18px;margin:0 auto 24px}
  #kp-donate-slim input,#kp-donate-slim select,#kp-donate-slim textarea{width:100%;padding:14px 12px;border:1px solid #eef0f2;border-radius:4px;margin:10px 0;background:#fbfbfb}
  #kp-donate-slim textarea{min-height:140px}
  #kp-donate-slim .btn{display:block;width:200px;margin:12px 0;background:#f0ad3d;color:#fff;border:none;border-radius:4px;padding:14px 16px;font-weight:900}
</style>
<div id="kp-donate-slim">
  <form class="card">
    <input placeholder="Your Name">
    <input placeholder="Phone Number">
    <input placeholder="Your Email">
    <input placeholder="Amount : $">
    <select><option>Donation To</option><option>Education</option><option>Health</option></select>
    <textarea placeholder="Your Message"></textarea>
    <button class="btn">DONATE NOW</button>
  </form>
</div>
