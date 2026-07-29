<?php
// Bhabha University – Full-Width Video Hero Section with Overlay Text & Stats Bar
?>
<!-- ============ HERO VIDEO SECTION ============ -->
<section class="bu-hero-fw" id="buHeroSection">

  <!-- Background Video -->
  <video class="bu-hero-video" autoplay loop muted playsinline poster="<?php echo URL_IMG; ?>bhabha univ logo.jpg">
    <source src="upload/video/bhabha_video.mp4" type="video/mp4">
    <source src="<?php echo URL_UPLOAD; ?>video/bhabha_video.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Gradient Overlay (Dark Navy at bottom-left for crisp text legibility) -->
  <div class="bu-fwslide-overlay"></div>

  <!-- Text Content (Overlay at bottom-left) -->
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

/* Background Video */
.bu-hero-video {
  position: absolute !important;
  top: 50% !important;
  left: 50% !important;
  min-width: 100% !important;
  min-height: 100% !important;
  width: auto !important;
  height: auto !important;
  transform: translate(-50%, -50%) !important;
  object-fit: cover !important;
  z-index: 0 !important;
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

/* Text Content (Bottom-Left) */
.bu-fwslide-content {
  position: absolute !important;
  bottom: 70px !important;
  left: 60px !important;
  z-index: 2 !important;
  max-width: 650px !important;
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
  font-size: clamp(38px, 4.8vw, 66px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  line-height: 1.1 !important;
  margin: 0 0 18px 0 !important;
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

<!-- ===== COUNTER COUNT-UP ANIMATION SCRIPT ===== -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {
    var counters = document.querySelectorAll('.bu-stat-number');
    
    function startCounterAnimation() {
      counters.forEach(function (counter) {
        var target = parseInt(counter.getAttribute('data-target'), 10);
        var suffix = counter.getAttribute('data-suffix') || '';
        var useCommas = counter.getAttribute('data-commas') === 'true';
        var current = 0;
        
        // duration of 2 seconds (2000ms)
        var duration = 1800; 
        var steps = 50;
        var stepTime = duration / steps;
        var stepValue = Math.ceil(target / steps);
        
        var timer = setInterval(function () {
          current += stepValue;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          
          var formattedVal = current;
          if (useCommas) {
            // Native format for numbers with commas
            formattedVal = current.toLocaleString('en-IN');
          }
          counter.textContent = formattedVal + suffix;
        }, stepTime);
      });
    }

    // IntersectionObserver to start counting when scrolled into view
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            startCounterAnimation();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15 });

      var targetBar = document.querySelector('.bu-stats-bar');
      if (targetBar) {
        observer.observe(targetBar);
      } else {
        startCounterAnimation();
      }
    } else {
      // Fallback
      startCounterAnimation();
    }
  });
})();
</script>

