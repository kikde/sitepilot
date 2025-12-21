<!-- Video Section with Title + Description + Video (Autoplay toggle inside code) -->
@php
    // 🔹 Toggle autoplay ON/OFF here
    $autoplay = true; // 👉 change to false to disable autoplay

    // 🔹 Your YouTube video ID
    $videoId = 'v1aJkA0ZT5I';

    // 🔹 Video Title and Text
    $postTitle = 'महादेव मानव कल्याण समिति - शिक्षा के माध्यम से सशक्तिकरण';
    $postText = 'हमारा उद्देश्य ग्रामीण एवं पिछड़े क्षेत्रों में शिक्षा के माध्यम से सामाजिक और आर्थिक सशक्तिकरण को बढ़ावा देना है। इस पहल के तहत हम बालिकाओं की शिक्षा, जागरूकता और विकास के लिए कार्यरत हैं।';

    // 🔹 Build embed URL dynamically
    $autoplayFlag = $autoplay ? 1 : 0;
    $videoSrc = "https://www.youtube.com/embed/{$videoId}?autoplay={$autoplayFlag}&mute=1&controls=1&rel=0&modestbranding=1&playsinline=1&loop=1&playlist={$videoId}";
@endphp

<section id="video-post" class="video-post-section">
  <div class="container">
     <!-- Video Block -->
    <div class="vp-video">
      <iframe
        src="{{ $videoSrc }}"
        title="YouTube video player"
        frameborder="0"
        allow="autoplay; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen>
      </iframe>
    </div>
    <!-- Post Title -->
    <h2 class="vp-title">{{ $postTitle }}</h2>

    <!-- Post Description -->
    <p class="vp-text">{{ $postText }}</p>

   

  </div>

  <style>
    /* ====== Video Post Styling ====== */
    .video-post-section {
      padding: 60px 20px;
      background: #fafafa;
      text-align: center;
    }

    .video-post-section .container {
      max-width: 900px;
      margin: 0 auto;
    }

    .vp-title {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 15px;
      color: #222;
      line-height: 1.3;
    }

    .vp-text {
      font-size: 1.05rem;
      color: #444;
      margin-bottom: 25px;
      line-height: 1.6;
    }

    .vp-video {
      position: relative;
      width: 100%;
      padding-top: 56.25%; /* 16:9 */
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .vp-video iframe {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      border: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
      .vp-title { font-size: 1.4rem; }
      .vp-text { font-size: 0.95rem; }
    }
  </style>
</section>
