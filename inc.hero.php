<?php
// Bhabha University – Full-Width Video Hero Section with Overlay Text & Stats Bar
?>
<!-- ============ HERO VIDEO SECTION ============ -->
<section class="bu-hero-fw" id="buHeroSection">

  <!-- Background Video (Infinite Autoplay Loop with Deferred Fast Preloading) -->
  <video class="bu-hero-video" id="buHeroVideo" autoplay loop muted playsinline preload="metadata" poster="<?php echo URL_ROOT;?>new-media/image/campus-aerial.png">
    <source src="<?php echo URL_ROOT;?>new-media/image/hero/hero-final.mp4" type="video/mp4">
    <source src="<?php echo URL_ROOT;?>new-media/image/hero/drone-campus.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Gradient Overlay (Dark Navy at bottom-left for crisp text legibility) -->
  <div class="bu-fwslide-overlay"></div>

  <!-- Text Content (Overlay with Top Padding & 2-Line Heading) -->
  <div class="bu-fwslide-content">
    <span class="bu-fwslide-label">
      <span class="bu-label-dot"></span>
      AERIAL &nbsp;·&nbsp; BHOPAL CAMPUS
    </span>
    <h1 class="bu-fwslide-heading">
      150 acres of<br>
      <em>living, learning</em> landscape.
    </h1>
    <p class="bu-fwslide-sub">
      From the medical quadrangle to the engineering labs — a bird's-eye view of the community our students call home.
    </p>
  </div>

  <!-- Scroll hint on right side -->
  <div class="bu-scroll-hint">
    <span>Scroll</span>
    <div class="bu-scroll-line"></div>
  </div>

</section>

<!-- ============ HERO STATS COUNTER BAR ============ -->
<div class="bu-stats-bar">
  <div class="bu-stats-container">
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="15000" data-suffix="+" data-commas="true">0</span>
      <span class="bu-stat-label">STUDENTS</span>
    </div>
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="850" data-suffix="+">0</span>
      <span class="bu-stat-label">FACULTY</span>
    </div>
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="200" data-suffix="+">0</span>
      <span class="bu-stat-label">PROGRAMS</span>
    </div>
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="15" data-suffix="">0</span>
      <span class="bu-stat-label">SCHOOLS</span>
    </div>
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="500" data-suffix="+">0</span>
      <span class="bu-stat-label">RECRUITERS</span>
    </div>
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="75" data-suffix="k+">0</span>
      <span class="bu-stat-label">ALUMNI</span>
    </div>
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="1200" data-suffix="+" data-commas="true">0</span>
      <span class="bu-stat-label">PUBLICATIONS</span>
    </div>
    <div class="bu-stat-item">
      <span class="bu-stat-number" data-target="150" data-suffix=" ac">0</span>
      <span class="bu-stat-label">CAMPUS</span>
    </div>
  </div>
</div>

<!-- ===== HERO & STATS CSS ===== -->
<style>
/* ---- Hero Container ---- */
.bu-hero-fw {
  position: relative !important;
  width: 100% !important;
  height: 68vh !important;
  min-height: 500px !important;
  overflow: hidden !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  background: #040F4A !important;
}

/* Background Video - Cropped & Scaled to hide burned-in video logos/text */
.bu-hero-video {
  position: absolute !important;
  top: 50% !important;
  left: 50% !important;
  min-width: 100% !important;
  min-height: 100% !important;
  width: 100% !important;
  height: 100% !important;
  transform: translate(-50%, -50%) !important;
  object-fit: cover !important;
  object-position: center center !important;
  z-index: 0 !important;
  transition: opacity 0.5s ease-in-out !important;
}

/* Gradient Overlay (Dark Navy) */
.bu-fwslide-overlay {
  position: absolute !important;
  inset: 0 !important;
  background:
    linear-gradient(
      to top,
      rgba(4, 15, 74, 0.92) 0%,
      rgba(4, 15, 74, 0.60) 35%,
      rgba(4, 15, 74, 0.15) 70%,
      transparent 100%
    ),
    linear-gradient(
      to right,
      rgba(4, 15, 74, 0.65) 0%,
      transparent 60%
    ) !important;
  z-index: 1 !important;
}

/* Text Content (Bottom-Left with Reduced Bottom Padding) */
.bu-fwslide-content {
  position: absolute !important;
  bottom: 35px !important;
  left: 60px !important;
  z-index: 2 !important;
  max-width: 850px !important;
  animation: buFadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
}

@keyframes buFadeUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Label with Pulsing Dot */
.bu-fwslide-label {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  font-size: 10.5px !important;
  font-weight: 800 !important;
  letter-spacing: 2.2px !important;
  text-transform: uppercase !important;
  color: var(--bu-gold, #FFC107) !important;
  margin-bottom: 16px !important;
}
.bu-label-dot {
  width: 7px !important;
  height: 7px !important;
  background: #E63946 !important;
  border-radius: 50% !important;
  display: inline-block !important;
  animation: buPulseDot 1.5s infinite !important;
}
@keyframes buPulseDot {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.4; transform: scale(1.4); }
}

/* Heading */
.bu-fwslide-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(38px, 4.8vw, 62px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  line-height: 1.15 !important;
  margin: 0 0 14px 0 !important;
  letter-spacing: -0.5px !important;
}
.bu-fwslide-heading em {
  font-style: italic !important;
  color: var(--bu-gold, #FFC107) !important;
  font-weight: 700 !important;
}

/* Subtitle */
.bu-fwslide-sub {
  font-size: 15px !important;
  color: rgba(255, 255, 255, 0.78) !important;
  line-height: 1.72 !important;
  margin: 0 !important;
  max-width: 500px !important;
  font-weight: 400 !important;
}

/* Scroll Hint (Right) */
.bu-scroll-hint {
  position: absolute !important;
  right: 28px !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  z-index: 5 !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 10px !important;
}
.bu-scroll-hint span {
  font-size: 9px !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: rgba(255, 255, 255, 0.5) !important;
  writing-mode: vertical-lr !important;
  font-weight: 700 !important;
}
.bu-scroll-line {
  width: 1px !important;
  height: 50px !important;
  background: linear-gradient(to bottom, rgba(255, 255, 255, 0.6), transparent) !important;
}

/* ---- STATS COUNTER BAR ---- */
.bu-stats-bar {
  background-color: #F8F5EE !important; /* Cream background matching design */
  border-top: 4px solid #061D7C !important;
  border-bottom: 1px solid #E5E0D5 !important;
  padding: 24px 20px !important;
  width: 100% !important;
  position: relative !important;
  z-index: 10 !important;
  box-shadow: 0 4px 15px rgba(0,0,0,0.04) !important;
  float: left !important;
  clear: both !important;
  display: block !important;
}
.bu-stats-container {
  max-width: 1380px !important;
  margin: 0 auto !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-around !important;
  flex-wrap: wrap !important;
  gap: 20px 15px !important;
}
.bu-stat-item {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  text-align: center !important;
  padding: 0 8px !important;
  flex: 1 !important;
  min-width: 110px !important;
}
.bu-stat-number {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 28px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  line-height: 1.1 !important;
  letter-spacing: -0.5px !important;
  margin-bottom: 4px !important;
}
.bu-stat-label {
  font-size: 10px !important;
  font-weight: 800 !important;
  letter-spacing: 1.8px !important;
  text-transform: uppercase !important;
  color: #6B7280 !important;
}

/* ---- Responsive ---- */
@media (max-width: 1200px) {
  .bu-stat-number { font-size: 24px !important; }
  .bu-stat-label { font-size: 9px !important; letter-spacing: 1.4px !important; }
}
@media (max-width: 991px) {
  .bu-hero-fw { height: 60vh !important; min-height: 400px !important; }
  .bu-fwslide-content { left: 32px !important; bottom: 50px !important; max-width: 85% !important; }
  .bu-scroll-hint { display: none !important; }
  .bu-stats-bar { padding: 18px 10px !important; }
  .bu-stat-item { min-width: 95px !important; }
  .bu-stat-number { font-size: 20px !important; }
}
@media (max-width: 575px) {
  .bu-hero-fw { height: 55vh !important; min-height: 330px !important; }
  .bu-fwslide-content { left: 16px !important; right: 16px !important; bottom: 35px !important; max-width: 100% !important; }
  .bu-fwslide-heading { font-size: 28px !important; }
  .bu-fwslide-sub { font-size: 12.5px !important; }
  .bu-stats-container { display: grid !important; grid-template-columns: repeat(4, 1fr) !important; gap: 14px 6px !important; }
  .bu-stat-number { font-size: 17px !important; }
  .bu-stat-label { font-size: 8.5px !important; letter-spacing: 1px !important; }
}
</style>

<!-- ===== COUNTER & VIDEO ANIMATION SCRIPT ===== -->
<script>
(function() {
  var counterAnimated = false;

  function startCounterAnimation() {
    if (counterAnimated) return;
    counterAnimated = true;

    var counters = document.querySelectorAll('.bu-stat-number');
    var startTime = null;
    var duration = 2000; // 2 seconds ultra-smooth easing

    function easeOutQuart(t) {
      return 1 - Math.pow(1 - t, 4);
    }

    function animate(timestamp) {
      if (!startTime) startTime = timestamp;
      var elapsed = timestamp - startTime;
      var progress = Math.min(elapsed / duration, 1);
      var easedProgress = easeOutQuart(progress);

      counters.forEach(function (counter) {
        var target = parseInt(counter.getAttribute('data-target'), 10);
        if (isNaN(target)) return;

        var prefix = counter.getAttribute('data-prefix') || '';
        var suffix = counter.getAttribute('data-suffix') || '';
        var useCommas = counter.getAttribute('data-commas') === 'true';

        var currentVal = Math.floor(easedProgress * target);

        var formattedVal = currentVal;
        if (useCommas) {
          formattedVal = currentVal.toLocaleString('en-IN');
        }
        counter.textContent = prefix + formattedVal + suffix;
      });

      if (progress < 1) {
        requestAnimationFrame(animate);
      }
    }

    requestAnimationFrame(animate);
  }

  function initHeroVideo() {
    var heroVideo = document.getElementById('buHeroVideo');
    if (!heroVideo) return;

    var videoSources = [
      '<?php echo URL_ROOT;?>new-media/image/hero/hero-final.mp4',
      '<?php echo URL_ROOT;?>new-media/image/hero/drone-campus.mp4',
      '<?php echo URL_ROOT;?>new-media/image/hero/hero3.mp4',
      '<?php echo URL_ROOT;?>new-media/image/hero/about.mp4'
    ];
    var currentTrack = 0;
    heroVideo.muted = true;

    var playVideo = function() {
      var promise = heroVideo.play();
      if (promise !== undefined) {
        promise.then(function() {
          heroVideo.style.opacity = '1';
        }).catch(function() {
          document.addEventListener('click', function playOnClick() {
            heroVideo.play().then(function() {
              heroVideo.style.opacity = '1';
            });
          }, { once: true });
        });
      }
    };

    // Cycle through campus hero videos for a dynamic background visual
    heroVideo.addEventListener('ended', function () {
      currentTrack = (currentTrack + 1) % videoSources.length;
      heroVideo.src = videoSources[currentTrack];
      heroVideo.load();
      playVideo();
    });

    heroVideo.addEventListener('pause', function () {
      if (!heroVideo.seeking) {
        playVideo();
      }
    });

    // Deferred start after DOM load for maximum page speed performance
    setTimeout(playVideo, 100);
  }

  function initAll() {
    initHeroVideo();

    // IntersectionObserver for Stats Counter
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            startCounterAnimation();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });

      var targetBar = document.querySelector('.bu-stats-bar');
      if (targetBar) {
        observer.observe(targetBar);
      } else {
        startCounterAnimation();
      }
    } else {
      startCounterAnimation();
    }

    // Safety fallback: ensure counters animate even if observer threshold is missed
    setTimeout(startCounterAnimation, 600);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
  } else {
    initAll();
  }
})();
</script>

