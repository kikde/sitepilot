{{-- resources/views/frontend/partials/section/style-charitics-footer-dark.blade.php --}}
<style>
  #kp-footer-dark{--bg:#0e1a24;--panel:#111f2a;--ink:#e9f0f5;--muted:#9cb0bf;--accent:#ff6f3d;color:var(--ink);font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
  #kp-footer-dark,#kp-footer-dark *{box-sizing:border-box}
  #kp-footer-dark .footer{max-width:420px;margin:0 auto 24px;padding:18px;background:#0e1a24;border-left:1px solid #1a2b3a;border-right:1px solid #1a2b3a}
  #kp-footer-dark .brand{display:flex;align-items:center;gap:8px;font-weight:900}
  #kp-footer-dark .brand:before{content:'❤';color:#ff6f3d}
  #kp-footer-dark p{color:var(--muted);line-height:1.7;margin:8px 0 12px}
  #kp-footer-dark .row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
  #kp-footer-dark h4{margin:0 0 8px}
  #kp-footer-dark .list{list-style:none;padding:0;margin:0}
  #kp-footer-dark .list li{margin:8px 0;color:#c7d6e2}
  #kp-footer-dark .post{display:flex;gap:10px;margin:10px 0}
  #kp-footer-dark .thumb{width:64px;height:48px;border-radius:8px;background:#1a2b3a url('https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=200&auto=format&fit=crop') center/cover}
  #kp-footer-dark .meta{font-size:.85rem}
  #kp-footer-dark .input{display:flex;margin-top:10px}
  #kp-footer-dark .input input{flex:1;border-radius:8px 0 0 8px;border:none;padding:12px;background:#1a2b3a;color:#e9f0f5}
  #kp-footer-dark .input button{border:none;background:#ff6f3d;color:#fff;padding:0 14px;border-radius:0 8px 8px 0;font-weight:900}
  #kp-footer-dark .small{margin-top:8px;color:#9cb0bf;font-size:.85rem}
  #kp-footer-dark .small input{margin-right:6px}
  #kp-footer-dark .row2{margin-top:18px}
  #kp-footer-dark .socials{display:flex;gap:10px}
  #kp-footer-dark .sq{width:36px;height:36px;border-radius:6px;background:#1a2b3a;display:grid;place-items:center;color:#c7d6e2}
</style>
<div id="kp-footer-dark">
  <footer class="footer">
    <div class="brand">Charitics</div>
    <p>Phasellus ultricies aliquam volutpat ullamcorper laoreet neque, a lacinia curabitur lacinia mollis</p>
    <div class="socials">
      <div class="sq">f</div><div class="sq">t</div><div class="sq">in</div><div class="sq">▶</div>
    </div>
    <div class="row row2">
      <div>
        <h4>Quick Links</h4>
        <ul class="list"><li>About Us</li><li>Our Services</li><li>Our Blogs</li><li>FAQ’S</li><li>Contact Us</li></ul>
      </div>
      <div>
        <h4>Recent Posts</h4>
        <div class="post">
          <div class="thumb"></div>
          <div class="meta"><div>May 12, 2025</div><strong>There are many vario ns of passages of</strong></div>
        </div>
        <div class="post">
          <div class="thumb" style="background-image:url('https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=200&auto=format&fit=crop')"></div>
          <div class="meta"><div>May 12, 2025</div><strong>There are many vario ns of passages of</strong></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div>
        <h4>Contact Us</h4>
        <div class="list">
          <div>📧 info@example.com</div>
          <div>📞 123-456-7890</div>
        </div>
        <div class="input"><input placeholder="Your Email Address"><button>➤</button></div>
        <div class="small"><label><input type="checkbox"> I agree with the <u>Privacy Policy</u></label></div>
      </div>
    </div>
  </footer>
</div>
