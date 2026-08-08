<?php // Virtual Campus Tour Section — used on Home page ?>

<style>
/* ===== Virtual Campus Tour – Home Page ===== */
.bu-hvt-section {
  background: linear-gradient(135deg, #040F4A 0%, #061D7C 60%, #02092E 100%);
  padding: 90px 20px 80px;
  position: relative;
  overflow: hidden;
  color: #FFFFFF;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
}
.bu-hvt-section::before {
  content: '';
  position: absolute;
  top: -140px; right: -100px;
  width: 550px; height: 550px;
  background: radial-gradient(circle, rgba(255,193,7,0.09) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}
.bu-hvt-section::after {
  content: '';
  position: absolute;
  bottom: -100px; left: -80px;
  width: 380px; height: 380px;
  background: radial-gradient(circle, rgba(6,29,124,0.5) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}
.bu-hvt-container {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

/* Header */
.bu-hvt-header {
  text-align: center;
  margin-bottom: 52px;
}
.bu-hvt-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #FFC107;
  text-transform: uppercase;
  margin-bottom: 14px;
}
.bu-hvt-label-dot {
  width: 8px;
  height: 8px;
  background: #E63946;
  border-radius: 50%;
  display: inline-block;
  box-shadow: 0 0 8px rgba(230,57,70,0.8);
  animation: buHvtPulse 1.5s infinite;
}
@keyframes buHvtPulse {
  0%, 100% { transform: scale(1); opacity: 1; }
  50%       { transform: scale(1.6); opacity: 0.45; }
}
.bu-hvt-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(28px, 4vw, 46px);
  font-weight: 800;
  color: #FFFFFF;
  margin: 0 0 16px;
  line-height: 1.2;
}
.bu-hvt-title em {
  font-style: italic;
  color: #FFC107;
}
.bu-hvt-desc {
  font-size: 15px;
  color: rgba(255,255,255,0.75);
  max-width: 640px;
  margin: 0 auto;
  line-height: 1.7;
}

/* Grid */
.bu-hvt-grid {
  display: grid;
  grid-template-columns: 1fr 360px;
  gap: 28px;
  align-items: start;
}

/* Player */
.bu-hvt-player-wrap {
  position: relative;
  background: #000;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.08);
}
.bu-hvt-video {
  width: 100%;
  height: 480px;
  object-fit: cover;
  display: block;
}
.bu-hvt-player-overlay {
  position: absolute;
  top: 16px; left: 16px; right: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  pointer-events: none;
  z-index: 5;
}
.bu-hvt-badge {
  background: rgba(4,15,74,0.85);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.2);
  padding: 7px 16px;
  border-radius: 30px;
  font-size: 11px;
  font-weight: 700;
  color: #FFFFFF;
  display: flex;
  align-items: center;
  gap: 7px;
  letter-spacing: 0.4px;
}
.bu-hvt-badge i { color: #FFC107; }

/* Controls */
.bu-hvt-controls-bar {
  position: absolute;
  bottom: 0; left: 0; right: 0;
  background: linear-gradient(to top, rgba(4,15,74,0.95) 0%, rgba(4,15,74,0.5) 60%, transparent 100%);
  padding: 30px 20px 18px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 6;
  gap: 12px;
  flex-wrap: wrap;
}
.bu-hvt-controls-left { display: flex; align-items: center; gap: 10px; }
.bu-hvt-btn {
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.3);
  color: #FFFFFF;
  width: 36px; height: 36px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.22s ease;
  outline: none;
  font-size: 13px;
}
.bu-hvt-btn:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #040F4A;
  transform: scale(1.1);
}

/* Tabs */
.bu-hvt-tabs { display: flex; gap: 7px; flex-wrap: wrap; }
.bu-hvt-tab-btn {
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.2);
  color: rgba(255,255,255,0.85);
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.bu-hvt-tab-btn.active,
.bu-hvt-tab-btn:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #040F4A;
}

/* Side Cards */
.bu-hvt-side-cards { display: flex; flex-direction: column; gap: 14px; }
.bu-hvt-info-card {
  background: rgba(255,255,255,0.06);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 14px;
  padding: 18px 20px;
  display: flex;
  align-items: flex-start;
  gap: 16px;
  transition: all 0.3s ease;
  cursor: default;
}
.bu-hvt-info-card:hover {
  background: rgba(255,255,255,0.11);
  border-color: rgba(255,193,7,0.45);
  transform: translateX(4px);
}
.bu-hvt-icon-box {
  width: 46px; height: 46px; min-width: 46px;
  border-radius: 12px;
  background: linear-gradient(135deg, #FFC107 0%, #D99B00 100%);
  color: #040F4A;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  box-shadow: 0 4px 14px rgba(255,193,7,0.35);
}
.bu-hvt-card-content h4 {
  font-size: 14.5px;
  font-weight: 700;
  color: #FFFFFF;
  margin: 0 0 5px;
  line-height: 1.3;
}
.bu-hvt-card-content p {
  font-size: 12.5px;
  color: rgba(255,255,255,0.65);
  margin: 0;
  line-height: 1.5;
}

/* CTA */
.bu-hvt-cta-row {
  text-align: center;
  margin-top: 48px;
}
.bu-hvt-cta-btn {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  background: #FFC107;
  color: #040F4A;
  font-size: 13px;
  font-weight: 800;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  text-decoration: none;
  padding: 14px 34px;
  border-radius: 4px;
  transition: all 0.25s ease;
  box-shadow: 0 6px 22px rgba(255,193,7,0.35);
}
.bu-hvt-cta-btn:hover {
  background: #E8B200;
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(255,193,7,0.45);
  color: #040F4A;
}

/* Responsive */
@media (max-width: 991px) {
  .bu-hvt-grid { grid-template-columns: 1fr; }
  .bu-hvt-video { height: 380px; }
  .bu-hvt-side-cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
}
@media (max-width: 575px) {
  .bu-hvt-section { padding: 60px 16px 50px; }
  .bu-hvt-video { height: 260px; }
  .bu-hvt-side-cards { grid-template-columns: 1fr; }
  .bu-hvt-tab-btn { font-size: 10px; padding: 5px 10px; }
  .bu-hvt-controls-bar { flex-direction: column; align-items: flex-start; gap: 10px; }
}
</style>

<!-- =================== VIRTUAL CAMPUS TOUR =================== -->
<section class="bu-hvt-section" id="homeCampusTour">
  <div class="bu-hvt-container">

    <!-- Header -->
    <div class="bu-hvt-header">
      <span class="bu-hvt-label">
        <span class="bu-hvt-label-dot"></span>
        Explore Campus &nbsp;·&nbsp; 360° Drone View
      </span>
      <h2 class="bu-hvt-title">Virtual Tour of <em>Bhabha Campus</em></h2>
      <p class="bu-hvt-desc">
        Experience our breathtaking 150-acre green campus from the sky. Explore world-class academic blocks, 
        research labs, sports arenas, and vibrant student life — all from right here.
      </p>
    </div>

    <!-- Grid: Player + Cards -->
    <div class="bu-hvt-grid">

      <!-- Video Player -->
      <div class="bu-hvt-player-wrap">

        <!-- Floating Badges -->
        <div class="bu-hvt-player-overlay">
          <span class="bu-hvt-badge">
            <i class="fa fa-video-camera"></i> Live Campus Video
          </span>
          <span class="bu-hvt-badge">
            <i class="fa fa-map-marker"></i> Bhopal, MP
          </span>
        </div>

        <video id="buHvtVideo" class="bu-hvt-video" autoplay loop muted playsinline
               poster="<?php echo URL_ROOT;?>new-media/image/campus-aerial.png">
          <source id="buHvtSource" src="<?php echo URL_UPLOAD;?>video/bhabha_video.mp4" type="video/mp4">
          Your browser does not support HTML5 video.
        </video>

        <!-- Controls -->
        <div class="bu-hvt-controls-bar">
          <div class="bu-hvt-controls-left">
            <button id="buHvtPlayBtn" class="bu-hvt-btn" title="Play / Pause">
              <i class="fa fa-pause"></i>
            </button>
            <button id="buHvtMuteBtn" class="bu-hvt-btn" title="Mute / Unmute">
              <i class="fa fa-volume-off"></i>
            </button>
          </div>

          <div class="bu-hvt-tabs">
            <button class="bu-hvt-tab-btn" onclick="switchHvtVideo('<?php echo URL_ROOT;?>new-media/image/hero/drone-campus.mp4', this)">
              <i class="fa fa-plane"></i> Aerial Drone
            </button>
            <button class="bu-hvt-tab-btn active" onclick="switchHvtVideo('<?php echo URL_UPLOAD;?>video/bhabha_video.mp4', this)">
              <i class="fa fa-film"></i> Campus Tour Video
            </button>
            <button class="bu-hvt-tab-btn" onclick="switchHvtVideo('<?php echo URL_ROOT;?>new-media/image/hero/hero2.mp4', this)">
              <i class="fa fa-flask"></i> Academic &amp; Labs
            </button>
            <button class="bu-hvt-tab-btn" onclick="switchHvtVideo('<?php echo URL_ROOT;?>new-media/image/hero/about.mp4', this)">
              <i class="fa fa-graduation-cap"></i> Student Life
            </button>
          </div>
        </div>
      </div>

      <!-- Side Highlight Cards -->
      <div class="bu-hvt-side-cards">

        <div class="bu-hvt-info-card">
          <div class="bu-hvt-icon-box"><i class="fa fa-tree"></i></div>
          <div class="bu-hvt-card-content">
            <h4>150-Acre Green Campus</h4>
            <p>Eco-friendly campus with solar energy, botanical gardens, and spacious plazas.</p>
          </div>
        </div>

        <div class="bu-hvt-info-card">
          <div class="bu-hvt-icon-box"><i class="fa fa-university"></i></div>
          <div class="bu-hvt-card-content">
            <h4>15 Schools &amp; Institutes</h4>
            <p>Engineering, Medical, Dental, Pharmacy, Law, Agriculture &amp; Management blocks.</p>
          </div>
        </div>

        <div class="bu-hvt-info-card">
          <div class="bu-hvt-icon-box"><i class="fa fa-flask"></i></div>
          <div class="bu-hvt-card-content">
            <h4>120+ Modern Labs</h4>
            <p>Hi-tech practical skill labs, research wings, and state-of-art computing centers.</p>
          </div>
        </div>

        <div class="bu-hvt-info-card">
          <div class="bu-hvt-icon-box"><i class="fa fa-hospital-o"></i></div>
          <div class="bu-hvt-card-content">
            <h4>500-Bed Hospital</h4>
            <p>Full-fledged multi-speciality teaching hospital &amp; clinical training facility.</p>
          </div>
        </div>

      </div>
    </div>

    <!-- CTA Button -->
    <div class="bu-hvt-cta-row">
      <a href="<?php echo href('about.php'); ?>#virtualTour" class="bu-hvt-cta-btn">
        <i class="fa fa-play-circle"></i> Explore Full Virtual Tour
      </a>
    </div>

  </div>
</section>

<script>
function switchHvtVideo(src, btn) {
  var video = document.getElementById('buHvtVideo');
  var source = document.getElementById('buHvtSource');
  if (!video || !source) return;
  source.src = src;
  video.load();
  video.play();
  document.querySelectorAll('.bu-hvt-tab-btn').forEach(function(b) { b.classList.remove('active'); });
  if (btn) btn.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
  var video   = document.getElementById('buHvtVideo');
  var playBtn = document.getElementById('buHvtPlayBtn');
  var muteBtn = document.getElementById('buHvtMuteBtn');

  if (playBtn && video) {
    playBtn.addEventListener('click', function() {
      if (video.paused) {
        video.play();
        playBtn.innerHTML = '<i class="fa fa-pause"></i>';
      } else {
        video.pause();
        playBtn.innerHTML = '<i class="fa fa-play"></i>';
      }
    });
  }

  if (muteBtn && video) {
    muteBtn.addEventListener('click', function() {
      video.muted = !video.muted;
      muteBtn.innerHTML = video.muted
        ? '<i class="fa fa-volume-off"></i>'
        : '<i class="fa fa-volume-up"></i>';
    });
  }
});
</script>
