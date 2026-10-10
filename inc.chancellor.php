<?php
// Bhabha University – Redesigned Chancellor's Message Section
$chanc_sec = null;
if (isset($db) && is_object($db)) {
    $db->where('section_key', 'chancellor_welcome');
    $chanc_sec = $db->getOne('homepage_sections');
}
if ($chanc_sec && isset($chanc_sec['status']) && $chanc_sec['status'] == 0) {
    return; // Section disabled from Admin
}

$chanc_label = !empty($chanc_sec['title']) ? $chanc_sec['title'] : "CHANCELLOR'S MESSAGE";
$chanc_heading = !empty($chanc_sec['heading']) ? $chanc_sec['heading'] : "A legacy of <em>excellence</em>.<br>\nA vision for tomorrow.";
$chanc_quote = !empty($chanc_sec['quote']) ? $chanc_sec['quote'] : '“We bridge academic brilliance with industrial pragmatism.”';
$chanc_author = !empty($chanc_sec['author']) ? $chanc_sec['author'] : 'DR. SADHNA KAPOOR · CHANCELLOR';
$chanc_desc = !empty($chanc_sec['content']) ? $chanc_sec['content'] : "<p><strong>Dr. Sadhna Kapoor</strong> is the Chancellor of BHABHA University. A visionary and a selfless leader with exceptional entrepreneurial, interpersonal, social and administrative skills; Dr. Sadhna Kapoor is passionate about technology and innovation, community development, social service, and interdisciplinary teaching and research.</p>\n<p>She has been awarded the title of “Honorary Professor” by the Academic Union Oxford, UK, reflecting her global dedication to educational innovation and excellence.</p>";
$chanc_extra = !empty($chanc_sec['extra_data']) ? json_decode($chanc_sec['extra_data'], true) : [];
$chanc_media_type = $chanc_extra['media_type'] ?? '';
$chanc_video_fit  = $chanc_extra['video_fit'] ?? 'portrait';
$chanc_image_url  = !empty($chanc_extra['image_url']) ? $chanc_extra['image_url'] : '';

$chanc_raw_media = !empty($chanc_sec['media_url']) ? trim($chanc_sec['media_url']) : "new-media/image/hero/sadhna-mam.mp4";

// Check if user selected photo mode or provided an image file
$is_image_mode = ($chanc_media_type === 'image' || (!empty($chanc_raw_media) && preg_match('/\.(jpg|jpeg|png|webp|gif|svg)$/i', $chanc_raw_media)));

$is_embed = false;
$is_video = false;
$is_image = false;
$embed_src = '';
$video_url = '';
$image_url = '';

if ($is_image_mode) {
    $is_image = true;
    $active_img = !empty($chanc_image_url) ? $chanc_image_url : (!empty($chanc_raw_media) && preg_match('/\.(jpg|jpeg|png|webp|gif|svg)$/i', $chanc_raw_media) ? $chanc_raw_media : 'assets/images/vcpic.jpg');
    $image_url = (strpos($active_img, 'http') === 0 ? $active_img : URL_ROOT . ltrim($active_img, '/'));
} else {
    $vInfo = function_exists('bu_parse_video_url') ? bu_parse_video_url($chanc_raw_media) : ['type' => 'direct', 'url' => $chanc_raw_media];
    $is_embed = ($vInfo['type'] === 'vimeo' || $vInfo['type'] === 'youtube');
    if ($is_embed) {
        if ($vInfo['type'] === 'vimeo') {
            $embed_src = "https://player.vimeo.com/video/{$vInfo['id']}?autoplay=1&loop=1&muted=1&autopause=0&controls=0&playsinline=1&title=0&byline=0&portrait=0&badge=0&dnt=1" . (!empty($vInfo['hashParam']) ? $vInfo['hashParam'] : '');
        } else { // youtube
            $embed_src = "https://www.youtube-nocookie.com/embed/{$vInfo['id']}?autoplay=1&mute=1&loop=1&playlist={$vInfo['id']}&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&playsinline=1&enablejsapi=1";
        }
    } else {
        $is_video = true;
        $video_url = (strpos($chanc_raw_media, 'http') === 0 ? $chanc_raw_media : URL_ROOT . ltrim($chanc_raw_media, '/'));
    }
}

$chanc_recogs = !empty($chanc_extra['recognitions']) ? $chanc_extra['recognitions'] : [
    ['title' => 'UGC', 'label' => 'RECOGNISED'],
    ['title' => 'MPPURC', 'label' => 'APPROVED'],
    ['title' => 'AICTE', 'label' => 'APPROVED']
];
?>
<section class="bu-chancellor-section">
  <div class="bu-chancellor-container">
    
    <!-- LEFT: Media (Embed / Video / Image) & Gold Quote Card -->
    <div class="bu-chancellor-img-col">
      <div class="bu-chancellor-img-wrapper">
        <?php if ($is_embed): ?>
          <div class="bu-chancellor-iframe-wrap bu-chancellor-fit-<?php echo htmlspecialchars($chanc_video_fit); ?>">
            <iframe class="bu-chancellor-iframe" 
                    src="<?php echo htmlspecialchars($embed_src); ?>" 
                    frameborder="0" 
                    allow="autoplay; fullscreen; picture-in-picture; encrypted-media" 
                    allowfullscreen 
                    title="Chancellor Message Video"></iframe>
          </div>
        <?php elseif ($is_video): ?>
          <video id="chancellor-video" class="bu-chancellor-img" playsinline muted autoplay loop preload="metadata" poster="<?php echo URL_IMG;?>vcpic.jpg" src="<?php echo htmlspecialchars($video_url); ?>" style="background:#000; cursor:pointer;" title="Click to Play / Pause"></video>
          <button id="chancellor-mute-btn" class="bu-chancellor-mute-btn" onclick="toggleChancellorMute(event)" title="Toggle Sound" aria-label="Toggle mute">
            <i class="fa fa-volume-off"></i>
          </button>
        <?php else: ?>
          <img loading="lazy" src="<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($chanc_author); ?>" class="bu-chancellor-img" onerror="this.src='<?php echo URL_IMG;?>vcpic.jpg'">
        <?php endif; ?>
        <div class="bu-chancellor-quote-card">
          <p class="bu-quote-text"><?php echo htmlspecialchars($chanc_quote); ?></p>
          <span class="bu-quote-author"><?php echo htmlspecialchars($chanc_author); ?></span>
        </div>
      </div>
    </div>
    
    <!-- RIGHT: Text content & Recognitions -->
    <div class="bu-chancellor-text-col">
      <span class="bu-chancellor-label"><?php echo htmlspecialchars($chanc_label); ?></span>
      <h2 class="bu-chancellor-heading">
        <?php echo $chanc_heading; ?>
      </h2>
      <div class="bu-chancellor-desc">
        <?php echo $chanc_desc; ?>
      </div>
      
      <div class="bu-chancellor-divider"></div>
      
      <!-- Recognitions Row -->
      <div class="bu-chancellor-recognitions">
        <?php foreach($chanc_recogs as $rec): ?>
        <div class="bu-recog-item">
          <span class="bu-recog-title"><?php echo htmlspecialchars($rec['title']); ?></span>
          <span class="bu-recog-label"><?php echo htmlspecialchars($rec['label']); ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<!-- ===== CHANCELLOR STYLES ===== -->
<style>
.bu-chancellor-section {
  background-color: #FAF9F6 !important; /* light cream bg */
  padding: 80px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
}
.bu-chancellor-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
  display: flex !important;
  align-items: center !important;
  gap: 60px !important;
}
.bu-chancellor-img-col {
  flex: 1 !important;
  max-width: 480px !important;
  position: relative !important;
}
.bu-chancellor-img-wrapper {
  position: relative !important;
  width: 100% !important;
}
.bu-chancellor-img {
  width: 100% !important;
  height: 520px !important;
  max-height: 520px !important;
  object-fit: cover !important;
  object-position: center top !important;
  border-radius: 6px !important;
  box-shadow: 0 16px 36px rgba(0,0,0,0.12) !important;
  display: block !important;
  image-rendering: -webkit-optimize-contrast !important;
  image-rendering: crisp-edges !important;
  image-rendering: high-quality !important;
  filter: contrast(1.04) saturate(1.05) brightness(1.01) !important;
}
video.bu-chancellor-img {
  width: 100% !important;
  height: 520px !important;
  max-height: 520px !important;
  object-fit: cover !important;
  object-position: center top !important;
  background: #000 !important;
  border-radius: 6px !important;
}
img.bu-chancellor-img {
  width: 100% !important;
  height: 520px !important;
  max-height: 520px !important;
  object-fit: cover !important;
  object-position: center top !important;
  background: #061D7C !important;
  border-radius: 6px !important;
}
.bu-chancellor-iframe-wrap {
  width: 100% !important;
  height: 520px !important;
  max-height: 520px !important;
  border-radius: 6px !important;
  overflow: hidden !important;
  box-shadow: 0 16px 36px rgba(0,0,0,0.12) !important;
  background: #000 !important;
  position: relative !important;
}

/* Portrait / 9:16 Full Bleed (Removes Black Bars on Sides for Phone/Reels) */
.bu-chancellor-fit-portrait .bu-chancellor-iframe {
  position: absolute !important;
  top: 50% !important;
  left: 0 !important;
  transform: translateY(-50%) !important;
  width: 100% !important;
  height: 180% !important;
  min-height: 180% !important;
  border: 0 !important;
  display: block !important;
}

/* Landscape / 16:9 Full Bleed (Removes Black Bars for Widescreen Video) */
.bu-chancellor-fit-landscape .bu-chancellor-iframe {
  position: absolute !important;
  top: 0 !important;
  left: 50% !important;
  transform: translateX(-50%) !important;
  height: 100% !important;
  width: 180% !important;
  min-width: 180% !important;
  border: 0 !important;
  display: block !important;
}

/* Fit Center */
.bu-chancellor-fit-fit .bu-chancellor-iframe {
  width: 100% !important;
  height: 100% !important;
  border: 0 !important;
  display: block !important;
}
.bu-chancellor-mute-btn {
  position: absolute !important;
  top: 15px !important;
  right: 15px !important;
  background: rgba(0,0,0,0.65) !important;
  color: #fff !important;
  border: 1px solid rgba(255,255,255,0.2) !important;
  border-radius: 50% !important;
  width: 40px !important;
  height: 40px !important;
  font-size: 16px !important;
  cursor: pointer !important;
  z-index: 10 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  transition: all 0.3s !important;
}
.bu-chancellor-mute-btn:hover {
  background: rgba(255,193,7,0.95) !important;
  color: #040F4A !important;
}
.bu-chancellor-play-btn {
  display: none !important;
}
.bu-chancellor-quote-card {
  position: absolute !important;
  bottom: -45px !important;
  right: -30px !important;
  background-color: #FFC107 !important;
  padding: 24px 28px !important;
  border-radius: 2px !important;
  max-width: 320px !important;
  box-shadow: 0 15px 35px rgba(217,155,0,0.25) !important;
  z-index: 5 !important;
}
.bu-quote-text {
  font-size: 15px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  line-height: 1.5 !important;
  margin-bottom: 12px !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
}
.bu-quote-author {
  font-size: 9.5px !important;
  font-weight: 800 !important;
  letter-spacing: 1.5px !important;
  color: #061D7C !important;
  text-transform: uppercase !important;
  display: block !important;
}

/* Right side content */
.bu-chancellor-text-col {
  flex: 1.2 !important;
  display: flex !important;
  flex-direction: column !important;
}
.bu-chancellor-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 16px !important;
  display: block !important;
}
.bu-chancellor-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 3.8vw, 48px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.15 !important;
  margin: 0 0 24px 0 !important;
}
.bu-chancellor-heading em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
}
.bu-chancellor-desc p {
  font-size: 15px !important;
  line-height: 1.8 !important;
  color: #4B5563 !important;
  margin-bottom: 16px !important;
}
.bu-chancellor-desc p strong {
  color: #061D7C !important;
  font-weight: 700 !important;
}
.bu-chancellor-divider {
  height: 1px !important;
  background-color: #E5E7EB !important;
  width: 100% !important;
  margin: 28px 0 !important;
}

/* Recognitions */
.bu-chancellor-recognitions {
  display: flex !important;
  gap: 48px !important;
}
.bu-recog-item {
  display: flex !important;
  flex-direction: column !important;
  gap: 4px !important;
}
.bu-recog-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 24px !important;
  font-weight: 850 !important;
  color: #061D7C !important;
  line-height: 1 !important;
}
.bu-recog-label {
  font-size: 9px !important;
  font-weight: 800 !important;
  letter-spacing: 1.5px !important;
  color: #9CA3AF !important;
  text-transform: uppercase !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-chancellor-container {
    flex-direction: column !important;
    gap: 40px !important;
  }
  .bu-chancellor-img-col {
    max-width: 100% !important;
    width: 100% !important;
    display: flex !important;
    justify-content: center !important;
  }
  .bu-chancellor-img-wrapper {
    max-width: 400px !important;
  }
  .bu-chancellor-img,
  .bu-chancellor-iframe-wrap {
    height: 440px !important;
  }
  .bu-chancellor-quote-card {
    right: -20px !important;
    bottom: -20px !important;
  }
  .bu-chancellor-text-col {
    width: 100% !important;
    align-items: center !important;
    text-align: center !important;
  }
  .bu-chancellor-divider {
    margin: 24px 0 !important;
  }
  .bu-chancellor-recognitions {
    justify-content: center !important;
    width: 100% !important;
  }
}
@media (max-width: 575px) {
  .bu-chancellor-section {
    padding: 50px 16px !important;
  }
  .bu-chancellor-img,
  .bu-chancellor-iframe-wrap {
    height: 360px !important;
  }
  .bu-chancellor-quote-card {
    position: static !important;
    max-width: 100% !important;
    margin-top: 15px !important;
    box-shadow: 0 8px 24px rgba(217,155,0,0.15) !important;
  }
  .bu-chancellor-recognitions {
    gap: 24px !important;
  }
  .bu-recog-title {
    font-size: 20px !important;
  }
}
</style>

<script>
(function() {
  var video   = document.getElementById("chancellor-video");
  var muteBtn = document.getElementById("chancellor-mute-btn");
  if (!video) return;

  function initVideo() {
    video.muted = true;
    var p = video.play();
    if (p !== undefined) {
      p.catch(function() {
        video.muted = true;
        video.play();
      });
    }
  }

  window.toggleChancellorMute = function(e) {
    if (e && e.stopPropagation) e.stopPropagation();
    var btnIcon = document.querySelector("#chancellor-mute-btn i");
    if (video.muted) {
      video.muted = false;
      if (btnIcon) {
        btnIcon.classList.remove("fa-volume-off");
        btnIcon.classList.add("fa-volume-up");
      }
    } else {
      video.muted = true;
      if (btnIcon) {
        btnIcon.classList.remove("fa-volume-up");
        btnIcon.classList.add("fa-volume-off");
      }
    }
  };

  video.addEventListener("click", function() {
    if (video.paused) {
      video.play();
    } else {
      video.pause();
    }
  });

  // IntersectionObserver to auto play / pause based on viewport visibility
  if ("IntersectionObserver" in window) {
    var obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          initVideo();
        } else {
          if (!video.paused) {
            video.pause();
          }
        }
      });
    }, { rootMargin: "150px 0px" });
    obs.observe(video);
  } else {
    initVideo();
  }
})();
</script>

