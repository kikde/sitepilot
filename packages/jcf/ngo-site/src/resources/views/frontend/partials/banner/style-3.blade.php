<!-- Simple YouTube Video Banner -->
@php
    // 🔹 Toggle autoplay ON/OFF here
    $autoplay = false; // 👉 change to false to disable autoplay

    // 🔹 Your YouTube video ID
    $videoId = 'v1aJkA0ZT5I';

    // 🔹 Build the embed URL dynamically
    $autoplayFlag = $autoplay ? 1 : 0;
    $videoSrc = "https://www.youtube.com/embed/{$videoId}?autoplay={$autoplayFlag}&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1&loop=1&playlist={$videoId}";
@endphp

<section id="homepage-banner" class="banner-section style-three centred">
  <div class="video-banner">
    <iframe
      src="{{ $videoSrc }}"
      title="YouTube video player"
      frameborder="0"
      allow="autoplay; encrypted-media; gyroscope; picture-in-picture; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen>
    </iframe>
  </div>

  <style>
    /* --- Responsive full-width banner --- */
    #homepage-banner { background: #000; overflow: hidden; }
    #homepage-banner .video-banner {
      position: relative;
      width: 100%;
      padding-top: 56.25%; /* 16:9 aspect ratio */
    }
    #homepage-banner .video-banner iframe {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
    }

    /* Adjust ratio on devices */
    @media (max-width: 600px) {
      #homepage-banner .video-banner { padding-top: 62.5%; } /* ~16:10 */
    }
    @media (min-width: 1200px) {
      #homepage-banner .video-banner { padding-top: 42.5%; } /* ~21:9 cinematic */
    }
  </style>
</section>
