<style>
.ad-section {
  margin: 40px 0;
}

.ad-box-glow {
  background: linear-gradient(90deg, #005bff, #00c6ff);
  border-radius: 20px;
  padding: 30px 20px;
  text-align: center;
  color: #fff;
  box-shadow: 0 5px 25px rgba(0, 91, 255, 0.4);
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.ad-box-glow::after {
  content: "";
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.15) 20%, transparent 21%);
  background-size: 30px 30px;
  animation: admove 6s linear infinite;
  opacity: 0.3;
}

@keyframes admove {
  0% { transform: translate(0, 0); }
  100% { transform: translate(30px, 30px); }
}

.ad-box-glow:hover {
  transform: scale(1.02);
  box-shadow: 0 8px 35px rgba(0, 91, 255, 0.6);
}

.ad-box-glow h3 {
  font-size: 1.6rem;
  margin-bottom: 12px;
  font-weight: 700;
}

.ad-box-glow .ad-btn {
  background: #fff;
  color: #005bff;
  padding: 10px 25px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  display: inline-block;
  transition: 0.3s;
}

.ad-box-glow .ad-btn:hover {
  background: #ff4747;
  color: #fff;
}
</style>

<div class="ad-section">
  <div class="ad-box-glow">
    <h3>🚀 Showcase Your Brand to Thousands!</h3>
    <a href="#" class="ad-btn">Advertise Now</a>
  </div>
</div>
