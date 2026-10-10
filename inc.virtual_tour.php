<?php
// Virtual Campus Tour Section — used on Home page
$vt_sec = null;
if (isset($db) && is_object($db)) {
    $db->where('section_key', 'virtual_tour');
    $vt_sec = $db->getOne('homepage_sections');
}
if ($vt_sec && isset($vt_sec['status']) && $vt_sec['status'] == 0) {
    return; // Section disabled from Admin
}

$vt_title = !empty($vt_sec['title']) ? $vt_sec['title'] : 'Explore Campus · 360° Drone View';
$vt_heading = !empty($vt_sec['heading']) ? $vt_sec['heading'] : 'Virtual Tour of <em>Bhabha Campus</em>';
$vt_desc = !empty($vt_sec['subheading']) ? $vt_sec['subheading'] : 'Experience our breathtaking 32-acre green campus from the sky. Explore world-class academic blocks, research labs, sports arenas, and vibrant student life — all from right here.';

$vt_extra = !empty($vt_sec['extra_data']) ? json_decode($vt_sec['extra_data'], true) : [];
$vt_poster = !empty($vt_extra['poster']) ? (strpos($vt_extra['poster'], 'http') === 0 ? $vt_extra['poster'] : URL_ROOT . ltrim($vt_extra['poster'], '/')) : URL_ROOT . 'new-media/image/campus-aerial.png';
$vt_badge1 = !empty($vt_extra['badge1']) ? $vt_extra['badge1'] : 'Live Campus Video';
$vt_badge2 = !empty($vt_extra['badge2']) ? $vt_extra['badge2'] : 'Bhopal, MP';

$vt_tabs = !empty($vt_extra['video_tabs']) ? $vt_extra['video_tabs'] : [
    ['label' => 'Aerial Drone', 'icon' => 'fa fa-plane', 'video_url' => 'upload/video/bhabha_video.mp4'],
    ['label' => 'Campus Tour Video', 'icon' => 'fa fa-film', 'video_url' => 'new-media/image/hero/bhabha_2.mp4'],
    ['label' => 'Academic & Labs', 'icon' => 'fa fa-flask', 'video_url' => 'new-media/image/hero/academic-lab.mp4'],
    ['label' => 'Student Life', 'icon' => 'fa fa-graduation-cap', 'video_url' => 'new-media/image/hero/bhabha_4.mp4']
];
$vt_cards = !empty($vt_extra['info_cards']) ? $vt_extra['info_cards'] : [
    ['icon' => 'fa fa-tree', 'title' => '32-Acre Green Campus', 'desc' => 'Eco-friendly lush green campus with solar energy, botanical gardens, and spacious plazas.'],
    ['icon' => 'fa fa-university', 'title' => '25 Institutes', 'desc' => 'Engineering, Medical, Dental, Pharmacy, Law, Agriculture & Management blocks.'],
    ['icon' => 'fa fa-flask', 'title' => '120+ Modern Labs', 'desc' => 'Hi-tech practical skill labs, research wings, and state-of-art computing centers.'],
    ['icon' => 'fa fa-hospital-o', 'title' => '500-Bed Hospital', 'desc' => 'Full-fledged multi-speciality teaching hospital & clinical training facility.']
];
$vt_cta_text = !empty($vt_extra['cta_text']) ? $vt_extra['cta_text'] : 'Explore Full Virtual Tour';
$vt_cta_url = !empty($vt_extra['cta_url']) ? $vt_extra['cta_url'] : (function_exists('href') ? href('about.php') : 'about.php') . '#virtualTour';
if (strpos($vt_cta_url, 'http') !== 0 && strpos($vt_cta_url, '/') !== 0 && strpos($vt_cta_url, '#') !== 0) {
    $vt_cta_url = URL_ROOT . $vt_cta_url;
}

$first_tab_raw = !empty($vt_tabs[0]['video_url']) ? trim($vt_tabs[0]['video_url']) : 'upload/video/bhabha_video.mp4';
$parsed_first = function_exists('bu_parse_video_url') ? bu_parse_video_url($first_tab_raw) : ['type' => 'direct'];
$initial_type = $parsed_first['type'];

if ($initial_type === 'vimeo') {
    $initial_src = "https://player.vimeo.com/video/{$parsed_first['id']}?autoplay=1&loop=1&muted=1&background=1&autopause=0&controls=0&playsinline=1&title=0&byline=0&portrait=0&badge=0&dnt=1";
} elseif ($initial_type === 'youtube') {
    $initial_src = "https://www.youtube-nocookie.com/embed/{$parsed_first['id']}?autoplay=1&mute=1&loop=1&playlist={$parsed_first['id']}&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&playsinline=1&enablejsapi=1";
} else {
    $initial_src = strpos($first_tab_raw, 'http') === 0 ? $first_tab_raw : URL_ROOT . ltrim($first_tab_raw, '/');
}
?>

<style>
/* ===== Virtual Campus Tour – Home Page ===== */
.bu-hvt-section {
  background: linear-gradient(135deg, #040F4A 0%, #061D7C 60%, #02092E 100%);
  padding: 40px 20px 80px;
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
.bu-hvt-side-cards { display: flex; flex-direction: column; gap: 14px; }

/* Player */
.bu-hvt-player-wrap {
  position: relative;
  background: #000;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.08);
  height: 480px;
}
.bu-hvt-video {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transform: scale(1.05); /* slightly zoom in to hide encoded black bars */
}
.bu-hvt-iframe-wrap {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  background: #000;
  display: block;
  overflow: hidden;
  z-index: 1;
}
.bu-hvt-iframe {
  position: absolute !important;
  top: 50% !important;
  left: 50% !important;
  transform: translate(-50%, -50%) scale(1.35) !important;
  width: 100% !important;
  height: 100% !important;
  min-width: 135% !important;
  min-height: 135% !important;
  border: 0 !important;
  display: block !important;
  pointer-events: none !important;
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
.bu-hvt-icon-box i,
.bu-hvt-icon-box .fa {
  font-family: 'FontAwesome' !important;
  font-style: normal !important;
  font-weight: normal !important;
  display: inline-block !important;
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
  .bu-hvt-player-wrap { height: 380px; }
  .bu-hvt-video,
  .bu-hvt-iframe-wrap { height: 100%; }
  .bu-hvt-side-cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
}
@media (max-width: 575px) {
  .bu-hvt-section { padding: 60px 16px 50px; }
  .bu-hvt-player-wrap { height: 260px; }
  .bu-hvt-video,
  .bu-hvt-iframe-wrap { height: 100%; }
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
        <?php echo htmlspecialchars($vt_title); ?>
      </span>
      <h2 class="bu-hvt-title"><?php echo $vt_heading; ?></h2>
      <p class="bu-hvt-desc">
        <?php echo nl2br(htmlspecialchars($vt_desc)); ?>
      </p>
    </div>

    <!-- Grid: Player + Cards -->
    <div class="bu-hvt-grid">

      <!-- Video Player -->
      <div class="bu-hvt-player-wrap">

        <!-- Floating Badges -->
        <div class="bu-hvt-player-overlay">
          <span class="bu-hvt-badge">
            <i class="fa fa-video-camera"></i> <?php echo htmlspecialchars($vt_badge1); ?>
          </span>
          <span class="bu-hvt-badge">
            <i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($vt_badge2); ?>
          </span>
        </div>

        <video id="buHvtVideo" class="bu-hvt-video" loop muted playsinline preload="none"
               poster="<?php echo $vt_poster;?>" style="<?php echo ($initial_type === 'vimeo' || $initial_type === 'youtube') ? 'display:none;' : 'display:block;'; ?>">
          <source id="buHvtSource" src="<?php echo ($initial_type === 'direct') ? htmlspecialchars($initial_src) : ''; ?>" type="video/mp4">
          Your browser does not support HTML5 video.
        </video>

        <!-- Vimeo / YouTube Responsive Embed Iframe Container -->
        <div id="buHvtIframeWrap" class="bu-hvt-iframe-wrap" style="<?php echo ($initial_type === 'vimeo' || $initial_type === 'youtube') ? 'display:block;' : 'display:none;'; ?>">
          <iframe id="buHvtIframe" class="bu-hvt-iframe" 
                  src="<?php echo ($initial_type === 'vimeo' || $initial_type === 'youtube') ? htmlspecialchars($initial_src) : ''; ?>" 
                  frameborder="0" 
                  allow="autoplay; fullscreen; picture-in-picture; encrypted-media" 
                  allowfullscreen
                  title="Virtual Tour Video Player"></iframe>
        </div>

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
            <?php foreach ($vt_tabs as $idx => $tab): 
              $raw_tab_url = trim($tab['video_url'] ?? '');
              $parsed = function_exists('bu_parse_video_url') ? bu_parse_video_url($raw_tab_url) : ['type' => 'direct'];
              $tab_type = $parsed['type'];
              
              if ($tab_type === 'vimeo') {
                  $tab_src = "https://player.vimeo.com/video/{$parsed['id']}?autoplay=1&loop=1&muted=1&background=1&autopause=0&controls=0&playsinline=1&title=0&byline=0&portrait=0&badge=0&dnt=1";
              } elseif ($tab_type === 'youtube') {
                  $tab_src = "https://www.youtube-nocookie.com/embed/{$parsed['id']}?autoplay=1&mute=1&loop=1&playlist={$parsed['id']}&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&playsinline=1&enablejsapi=1";
              } else {
                  $tab_src = strpos($raw_tab_url, 'http') === 0 ? $raw_tab_url : URL_ROOT . ltrim($raw_tab_url, '/');
              }

              $rawTabIcon = trim($tab['icon'] ?? 'fa fa-video-camera');
              if (strpos($rawTabIcon, 'fa ') !== 0 && strpos($rawTabIcon, 'fas ') !== 0 && strpos($rawTabIcon, 'far ') !== 0 && strpos($rawTabIcon, 'fab ') !== 0) {
                  $tabIconClass = 'fa ' . (strpos($rawTabIcon, 'fa-') === 0 ? $rawTabIcon : 'fa-' . $rawTabIcon);
              } else {
                  $tabIconClass = $rawTabIcon;
              }
            ?>
              <button type="button" 
                      class="bu-hvt-tab-btn <?php echo $idx === 0 ? 'active' : ''; ?>" 
                      data-type="<?php echo htmlspecialchars($tab_type); ?>"
                      data-src="<?php echo htmlspecialchars($tab_src); ?>"
                      onclick="switchHvtVideo(this)">
                <i class="<?php echo htmlspecialchars($tabIconClass); ?>"></i> <?php echo htmlspecialchars($tab['label']); ?>
              </button>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Side Highlight Cards -->
      <div class="bu-hvt-side-cards">
        <?php foreach ($vt_cards as $card): 
          $rawCardIcon = trim($card['icon'] ?? 'fa fa-check');
          if (strpos($rawCardIcon, 'fa ') !== 0 && strpos($rawCardIcon, 'fas ') !== 0 && strpos($rawCardIcon, 'far ') !== 0 && strpos($rawCardIcon, 'fab ') !== 0) {
              $cardIconClass = 'fa ' . (strpos($rawCardIcon, 'fa-') === 0 ? $rawCardIcon : 'fa-' . $rawCardIcon);
          } else {
              $cardIconClass = $rawCardIcon;
          }
        ?>
          <div class="bu-hvt-info-card">
            <div class="bu-hvt-icon-box"><i class="<?php echo htmlspecialchars($cardIconClass); ?>"></i></div>
            <div class="bu-hvt-card-content">
              <h4><?php echo htmlspecialchars($card['title']); ?></h4>
              <p><?php echo htmlspecialchars($card['desc']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- CTA Button -->
    <div class="bu-hvt-cta-row">
      <a href="<?php echo $vt_cta_url; ?>" class="bu-hvt-cta-btn">
        <i class="fa fa-play-circle"></i> <?php echo htmlspecialchars($vt_cta_text); ?>
      </a>
    </div>

  </div>
</section>

<script>
function switchHvtVideo(btn) {
  if (!btn) return;
  var type = btn.getAttribute('data-type') || 'direct';
  var src  = btn.getAttribute('data-src')  || '';

  var video        = document.getElementById('buHvtVideo');
  var source       = document.getElementById('buHvtSource');
  var iframeWrap   = document.getElementById('buHvtIframeWrap');
  var iframe       = document.getElementById('buHvtIframe');
  var playBtn      = document.getElementById('buHvtPlayBtn');

  /* Update active tab button */
  document.querySelectorAll('.bu-hvt-tab-btn').forEach(function(b) {
    b.classList.remove('active');
  });
  btn.classList.add('active');

  if (type === 'vimeo' || type === 'youtube') {
    // 1. Pause and hide native video
    if (video) {
      video.pause();
      video.style.display = 'none';
    }
    // 2. Show and load clean iframe
    if (iframeWrap && iframe) {
      iframeWrap.style.display = 'block';
      iframe.src = src;
    }
    if (playBtn) {
      playBtn.setAttribute('data-paused', 'false');
      playBtn.innerHTML = '<i class="fa fa-pause"></i>';
    }
  } else {
    // 1. Clear and hide iframe
    if (iframeWrap && iframe) {
      iframe.src = '';
      iframeWrap.style.display = 'none';
    }
    // 2. Show and play native video
    if (video) {
      video.style.display = 'block';
      if (source) source.src = src;
      video.src = src;
      video.load();
      var playPromise = video.play();
      if (playPromise !== undefined) {
        playPromise.then(function() {
          if (playBtn) playBtn.innerHTML = '<i class="fa fa-pause"></i>';
        }).catch(function() {
          video.muted = true;
          video.play().then(function() {
            if (playBtn) playBtn.innerHTML = '<i class="fa fa-pause"></i>';
          });
        });
      }
    }
  }
}

document.addEventListener('DOMContentLoaded', function() {
  var video   = document.getElementById('buHvtVideo');
  var playBtn = document.getElementById('buHvtPlayBtn');
  var muteBtn = document.getElementById('buHvtMuteBtn');

  if (playBtn) {
    playBtn.addEventListener('click', function() {
      var iframeWrap = document.getElementById('buHvtIframeWrap');
      var iframe     = document.getElementById('buHvtIframe');
      var isIframe   = iframeWrap && iframeWrap.style.display !== 'none';

      if (isIframe && iframe) {
        if (playBtn.getAttribute('data-paused') === 'true') {
          // Play iframe
          try {
            iframe.contentWindow.postMessage('{"method":"play"}', '*');
            iframe.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
          } catch(e) {}
          playBtn.setAttribute('data-paused', 'false');
          playBtn.innerHTML = '<i class="fa fa-pause"></i>';
        } else {
          // Pause iframe
          try {
            iframe.contentWindow.postMessage('{"method":"pause"}', '*');
            iframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
          } catch(e) {}
          playBtn.setAttribute('data-paused', 'true');
          playBtn.innerHTML = '<i class="fa fa-play"></i>';
        }
      } else if (video) {
        if (video.paused) {
          video.play();
          playBtn.innerHTML = '<i class="fa fa-pause"></i>';
        } else {
          video.pause();
          playBtn.innerHTML = '<i class="fa fa-play"></i>';
        }
      }
    });
  }

  if (muteBtn) {
    muteBtn.addEventListener('click', function() {
      var iframeWrap = document.getElementById('buHvtIframeWrap');
      var iframe     = document.getElementById('buHvtIframe');
      var isIframe   = iframeWrap && iframeWrap.style.display !== 'none';

      if (isIframe && iframe) {
        if (muteBtn.getAttribute('data-muted') === 'false') {
          // Mute iframe
          try {
            iframe.contentWindow.postMessage('{"method":"setVolume","value":0}', '*');
            iframe.contentWindow.postMessage('{"event":"command","func":"mute","args":""}', '*');
          } catch(e) {}
          muteBtn.setAttribute('data-muted', 'true');
          muteBtn.innerHTML = '<i class="fa fa-volume-off"></i>';
        } else {
          // Unmute iframe
          try {
            iframe.contentWindow.postMessage('{"method":"setVolume","value":1}', '*');
            iframe.contentWindow.postMessage('{"event":"command","func":"unMute","args":""}', '*');
          } catch(e) {}
          muteBtn.setAttribute('data-muted', 'false');
          muteBtn.innerHTML = '<i class="fa fa-volume-up"></i>';
        }
      } else if (video) {
        video.muted = !video.muted;
        muteBtn.innerHTML = video.muted
          ? '<i class="fa fa-volume-off"></i>'
          : '<i class="fa fa-volume-up"></i>';
      }
    });
  }
});
</script>
