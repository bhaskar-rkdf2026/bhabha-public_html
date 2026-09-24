<?php
// Bhabha University – International Network & YouTube Live / Video Section
$glob_sec = null;
if (isset($db) && is_object($db)) {
    $db->where('section_key', 'global_network');
    $glob_sec = $db->getOne('homepage_sections');
}
if ($glob_sec && isset($glob_sec['status']) && $glob_sec['status'] == 0) {
    return; // Section disabled from Admin
}

$glob_label = !empty($glob_sec['title']) ? $glob_sec['title'] : 'INTERNATIONAL';
$glob_heading = !empty($glob_sec['heading']) ? $glob_sec['heading'] : 'A truly <em>global</em> network.';
$glob_sub = !empty($glob_sec['subheading']) ? $glob_sec['subheading'] : '60+ MoUs with leading universities across North America, Europe and Asia. Student exchange, joint research and dual degree pathways.';

$glob_extra = !empty($glob_sec['extra_data']) ? json_decode($glob_sec['extra_data'], true) : [];
$glob_tags = !empty($glob_extra['tags']) ? $glob_extra['tags'] : ['University of Toronto', 'TU Munich', 'NUS Singapore', 'Monash', 'Curtin', 'UPenn', 'Sheffield', 'Kyoto University', 'ETH Zürich'];
$glob_btn_text = !empty($glob_extra['button_text']) ? $glob_extra['button_text'] : 'APPLY NOW &nbsp;→';
$glob_btn_url = !empty($glob_extra['button_url']) ? $glob_extra['button_url'] : (function_exists('href') ? href("enquiry.php") : 'enquiry.php');
if (strpos($glob_btn_url, 'http') !== 0 && strpos($glob_btn_url, '/') !== 0 && strpos($glob_btn_url, '#') !== 0) {
    $glob_btn_url = (defined('URL_ROOT') ? URL_ROOT : '') . $glob_btn_url;
}

// YouTube Live & Video settings
$yt_is_live = !empty($glob_extra['yt_is_live']) ? (int)$glob_extra['yt_is_live'] : 0;
$yt_live_url = trim($glob_extra['yt_live_url'] ?? '');
$yt_video_url = trim($glob_extra['yt_video_url'] ?? 'https://www.youtube.com/watch?v=zUsj1r_9wuM');
$yt_title = !empty($glob_extra['yt_title']) ? $glob_extra['yt_title'] : 'Bhabha University Broadcast & Official Events';
$yt_desc = !empty($glob_extra['yt_desc']) ? $glob_extra['yt_desc'] : 'Watch live telecasts, convocation, expert talks, campus festivals and latest video updates.';
$yt_channel_url = !empty($glob_extra['yt_channel_url']) ? $glob_extra['yt_channel_url'] : 'https://www.youtube.com/channel/UCHyRBhcOyXt2CvTAW6JzP-g';
$yt_channel_btn = !empty($glob_extra['yt_channel_btn']) ? $glob_extra['yt_channel_btn'] : 'Watch on YouTube →';

// Function to convert YouTube URL/ID to embed link
if (!function_exists('bu_get_youtube_embed')) {
    function bu_get_youtube_embed($input, $is_live = false) {
        if (empty($input)) return '';
        $input = trim($input);
        
        // If iframe is passed
        if (preg_match('/<iframe.*?src=["\'](.*?)["\']/i', $input, $m)) {
            $input = $m[1];
        }
        
        // Extract 11-char video ID from common YouTube URL formats
        $vid = '';
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|live|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $input, $m)) {
            $vid = $m[1];
        } elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            $vid = $input;
        }
        
        if (!empty($vid)) {
            return 'https://www.youtube.com/embed/' . $vid . ($is_live ? '?autoplay=1&mute=1&rel=0' : '?rel=0');
        }
        
        if (strpos($input, 'youtube.com/embed/') !== false || strpos($input, 'youtube-nocookie.com/embed/') !== false) {
            return $input;
        }
        
        return $input;
    }
}

// Select active stream / video source
$active_raw_url = ($yt_is_live && !empty($yt_live_url)) ? $yt_live_url : (!empty($yt_video_url) ? $yt_video_url : $yt_live_url);
$yt_embed_url = bu_get_youtube_embed($active_raw_url, ($yt_is_live == 1));
?>
<section class="bu-global-network-section">
  <div class="bu-global-network-container">
    
    <div class="bu-net-yt-grid">
      
      <!-- ===== LEFT COLUMN: International / Global Network ===== -->
      <div class="bu-net-col-left">
        <!-- Top Icon -->
        <div class="bu-network-icon-wrap">
          <i class="fa fa-globe"></i>
        </div>
        
        <!-- Header Block -->
        <span class="bu-network-label"><?php echo htmlspecialchars($glob_label); ?></span>
        <h2 class="bu-network-heading"><?php echo $glob_heading; ?></h2>
        <p class="bu-network-sub"><?php echo nl2br(htmlspecialchars($glob_sub)); ?></p>
        
        <!-- Partner Tags Grid -->
        <div class="bu-network-tags">
          <div class="bu-network-tags-row">
            <?php foreach ($glob_tags as $tag): ?>
              <span class="bu-net-tag"><?php echo htmlspecialchars($tag); ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        
        <!-- Bottom Button -->
        <div class="bu-network-btn-wrap">
          <a href="<?php echo $glob_btn_url; ?>" class="bu-btn-gold"><?php echo $glob_btn_text; ?></a>
        </div>
      </div>

      <!-- ===== RIGHT COLUMN: YouTube Live Telecast & Video Broadcast ===== -->
      <div class="bu-net-col-right">
        <div class="bu-yt-live-card">
          
          <!-- Card Header & Live Badge -->
          <div class="bu-yt-card-header">
            <div class="bu-yt-brand">
              <span class="bu-yt-icon-box"><i class="fa fa-youtube-play"></i></span>
              <div class="bu-yt-brand-info">
                <span class="bu-yt-brand-title">BHABHA UNIVERSITY</span>
                <span class="bu-yt-brand-sub">Official Video &amp; Broadcast</span>
              </div>
            </div>
            
            <?php if ($yt_is_live): ?>
              <div class="bu-yt-status-badge bu-yt-badge-live">
                <span class="bu-live-dot"></span>
                <span>LIVE NOW</span>
              </div>
            <?php else: ?>
              <div class="bu-yt-status-badge bu-yt-badge-featured">
                <i class="fa fa-play-circle"></i>
                <span>FEATURED VIDEO</span>
              </div>
            <?php endif; ?>
          </div>

          <!-- Video Embed Frame -->
          <div class="bu-yt-player-wrap">
            <?php if (!empty($yt_embed_url)): ?>
              <iframe 
                src="<?php echo htmlspecialchars($yt_embed_url); ?>" 
                title="<?php echo htmlspecialchars($yt_title); ?>"
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
              </iframe>
            <?php else: ?>
              <div class="bu-yt-placeholder">
                <i class="fa fa-youtube-play bu-yt-ph-icon"></i>
                <h5>Official Video Streaming</h5>
                <p>Visit our official YouTube Channel for live broadcasts and events.</p>
              </div>
            <?php endif; ?>
          </div>

          <!-- Video Info & Channel Action -->
          <div class="bu-yt-card-footer">
            <div class="bu-yt-info">
              <h4 class="bu-yt-video-title"><?php echo htmlspecialchars($yt_title); ?></h4>
              <?php if (!empty($yt_desc)): ?>
                <p class="bu-yt-video-desc"><?php echo nl2br(htmlspecialchars($yt_desc)); ?></p>
              <?php endif; ?>
            </div>
            <div class="bu-yt-action">
              <a href="<?php echo htmlspecialchars($yt_channel_url); ?>" target="_blank" class="bu-yt-btn">
                <i class="fa fa-youtube-play"></i> <?php echo htmlspecialchars($yt_channel_btn); ?>
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>
</section>

<!-- ===== GLOBAL NETWORK & YOUTUBE SECTION STYLES ===== -->
<style>
.bu-global-network-section {
  background: #061D7C !important;
  background: radial-gradient(circle at 80% 20%, #0d2899 0%, #061D7C 60%, #030e42 100%) !important;
  padding: 80px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
  position: relative !important;
  overflow: hidden !important;
}
.bu-global-network-container {
  max-width: 1240px !important;
  margin: 0 auto !important;
  padding: 0 10px !important;
}

/* 2-Column Flex Layout */
.bu-net-yt-grid {
  display: flex !important;
  flex-wrap: wrap !important;
  align-items: center !important;
  justify-content: space-between !important;
  gap: 40px !important;
}

.bu-net-col-left {
  flex: 1 1 500px !important;
  max-width: 580px !important;
  text-align: left !important;
  box-sizing: border-box !important;
}

.bu-net-col-right {
  flex: 1 1 480px !important;
  max-width: 580px !important;
  box-sizing: border-box !important;
}

/* --- Left Column: International Elements --- */
.bu-network-icon-wrap {
  font-size: 28px !important;
  color: #FFC107 !important;
  width: 54px !important;
  height: 54px !important;
  background: rgba(255, 193, 7, 0.12) !important;
  border: 1px solid rgba(255, 193, 7, 0.3) !important;
  border-radius: 12px !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  margin-bottom: 18px !important;
  box-shadow: 0 4px 15px rgba(255, 193, 7, 0.15) !important;
}
.bu-network-icon-wrap i,
.bu-network-icon-wrap .fa {
  font-family: 'FontAwesome' !important;
  font-style: normal !important;
  font-weight: normal !important;
}

.bu-network-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: #FFC107 !important;
  text-transform: uppercase !important;
  margin-bottom: 12px !important;
  display: block !important;
}

.bu-network-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(28px, 3.2vw, 42px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  line-height: 1.22 !important;
  margin: 0 0 16px 0 !important;
}
.bu-network-heading em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
}

.bu-network-sub {
  font-size: 14.5px !important;
  line-height: 1.7 !important;
  color: rgba(255, 255, 255, 0.78) !important;
  margin: 0 0 28px 0 !important;
}

/* Partner tags */
.bu-network-tags {
  margin-bottom: 32px !important;
}
.bu-network-tags-row {
  display: flex !important;
  gap: 10px !important;
  justify-content: flex-start !important;
  flex-wrap: wrap !important;
}
.bu-net-tag {
  background-color: #040F4A !important;
  border: 1px solid rgba(255, 255, 255, 0.14) !important;
  color: #FFFFFF !important;
  font-size: 11.5px !important;
  font-weight: 600 !important;
  padding: 8px 14px !important;
  border-radius: 4px !important;
  transition: all 0.22s ease !important;
  cursor: default !important;
  display: inline-block !important;
}
.bu-net-tag:hover {
  border-color: #FFC107 !important;
  color: #FFC107 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 4px 12px rgba(255, 193, 7, 0.18) !important;
}

/* Gold Button */
.bu-network-btn-wrap {
  display: flex !important;
  justify-content: flex-start !important;
}
.bu-btn-gold {
  background-color: #FFC107 !important;
  color: #061D7C !important;
  font-size: 11.5px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  padding: 13px 28px !important;
  border-radius: 4px !important;
  text-decoration: none !important;
  transition: all 0.22s ease !important;
  display: inline-block !important;
  border: none !important;
}
.bu-btn-gold:hover {
  background-color: #E8A800 !important;
  color: #000000 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 20px rgba(255, 193, 7, 0.35) !important;
  text-decoration: none !important;
}

/* --- Right Column: YouTube Live & Video Card --- */
.bu-yt-live-card {
  background: rgba(4, 15, 74, 0.88) !important;
  border: 1px solid rgba(255, 255, 255, 0.14) !important;
  border-radius: 16px !important;
  padding: 22px !important;
  box-shadow: 0 20px 45px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 193, 7, 0.08) !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
  position: relative !important;
  transition: transform 0.25s ease, box-shadow 0.25s ease !important;
}
.bu-yt-live-card:hover {
  border-color: rgba(255, 193, 7, 0.25) !important;
  box-shadow: 0 24px 50px rgba(0, 0, 0, 0.5), 0 0 20px rgba(255, 193, 7, 0.12) !important;
}

/* Card Header */
.bu-yt-card-header {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  margin-bottom: 16px !important;
  flex-wrap: wrap !important;
  gap: 10px !important;
}
.bu-yt-brand {
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
}
.bu-yt-icon-box {
  width: 38px !important;
  height: 38px !important;
  background: #FF0000 !important;
  color: #FFFFFF !important;
  border-radius: 8px !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: 20px !important;
  box-shadow: 0 4px 12px rgba(255, 0, 0, 0.4) !important;
}
.bu-yt-brand-info {
  display: flex !important;
  flex-direction: column !important;
  text-align: left !important;
}
.bu-yt-brand-title {
  color: #FFFFFF !important;
  font-size: 13px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
}
.bu-yt-brand-sub {
  color: rgba(255, 255, 255, 0.6) !important;
  font-size: 11px !important;
}

/* Status Badges */
.bu-yt-status-badge {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 0.5px !important;
  padding: 5px 12px !important;
  border-radius: 20px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
}
.bu-yt-badge-live {
  background: #E50914 !important;
  color: #FFFFFF !important;
  box-shadow: 0 0 14px rgba(229, 9, 20, 0.6) !important;
}
.bu-live-dot {
  width: 8px !important;
  height: 8px !important;
  background-color: #FFFFFF !important;
  border-radius: 50% !important;
  display: inline-block !important;
  animation: buLivePulseAnim 1.3s infinite ease-in-out !important;
}
@keyframes buLivePulseAnim {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.5); opacity: 0.4; }
}
.bu-yt-badge-featured {
  background: rgba(255, 255, 255, 0.1) !important;
  color: #FFC107 !important;
  border: 1px solid rgba(255, 193, 7, 0.3) !important;
}

/* Player Frame 16:9 */
.bu-yt-player-wrap {
  position: relative !important;
  width: 100% !important;
  padding-bottom: 56.25% !important; /* 16:9 ratio */
  height: 0 !important;
  border-radius: 10px !important;
  overflow: hidden !important;
  background: #000000 !important;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5) !important;
}
.bu-yt-player-wrap iframe {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  border: 0 !important;
}
.bu-yt-placeholder {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 20px !important;
  text-align: center !important;
  color: rgba(255, 255, 255, 0.7) !important;
}
.bu-yt-ph-icon {
  font-size: 48px !important;
  color: #FF0000 !important;
  margin-bottom: 10px !important;
}
.bu-yt-placeholder h5 {
  color: #FFFFFF !important;
  margin-bottom: 4px !important;
}
.bu-yt-placeholder p {
  font-size: 12px !important;
  margin: 0 !important;
}

/* Card Footer */
.bu-yt-card-footer {
  margin-top: 16px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  flex-wrap: wrap !important;
  gap: 14px !important;
}
.bu-yt-info {
  flex: 1 1 260px !important;
  text-align: left !important;
}
.bu-yt-video-title {
  color: #FFFFFF !important;
  font-size: 14.5px !important;
  font-weight: 700 !important;
  margin: 0 0 4px 0 !important;
  line-height: 1.35 !important;
}
.bu-yt-video-desc {
  color: rgba(255, 255, 255, 0.68) !important;
  font-size: 12px !important;
  line-height: 1.5 !important;
  margin: 0 !important;
}
.bu-yt-action {
  flex-shrink: 0 !important;
}
.bu-yt-btn {
  background: #CC181E !important;
  color: #FFFFFF !important;
  font-size: 11.5px !important;
  font-weight: 700 !important;
  padding: 10px 18px !important;
  border-radius: 4px !important;
  text-decoration: none !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  transition: all 0.2s ease !important;
  letter-spacing: 0.3px !important;
}
.bu-yt-btn:hover {
  background: #FF0000 !important;
  color: #FFFFFF !important;
  box-shadow: 0 4px 15px rgba(255, 0, 0, 0.45) !important;
  transform: translateY(-2px) !important;
  text-decoration: none !important;
}

/* ===== RESPONSIVE BREAKPOINTS ===== */
@media (max-width: 991px) {
  .bu-global-network-section {
    padding: 45px 16px !important;
  }
  .bu-net-yt-grid {
    gap: 26px !important;
  }
  .bu-net-col-left,
  .bu-net-col-right {
    flex: 1 1 100% !important;
    max-width: 100% !important;
  }
  .bu-net-col-left {
    text-align: center !important;
  }
  .bu-network-heading {
    font-size: 26px !important;
    margin-bottom: 12px !important;
  }
  .bu-network-sub {
    margin-left: auto !important;
    margin-right: auto !important;
    max-width: 600px !important;
    margin-bottom: 18px !important;
    font-size: 13.5px !important;
  }
  .bu-network-tags {
    margin-bottom: 20px !important;
  }
  .bu-network-tags-row {
    justify-content: center !important;
  }
  .bu-network-btn-wrap {
    justify-content: center !important;
  }
  .bu-yt-live-card {
    padding: 16px 14px !important;
  }
  .bu-yt-card-footer {
    margin-top: 14px !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 12px !important;
  }
  .bu-yt-info {
    flex: 1 1 100% !important;
    width: 100% !important;
  }
  .bu-yt-action {
    width: 100% !important;
  }
  .bu-yt-btn {
    width: 100% !important;
    justify-content: center !important;
    padding: 11px 16px !important;
  }
}

@media (max-width: 575px) {
  .bu-global-network-section {
    padding: 35px 12px !important;
  }
  .bu-yt-live-card {
    padding: 14px 12px !important;
  }
  .bu-network-heading {
    font-size: 26px !important;
  }
  .bu-network-sub {
    font-size: 13.5px !important;
  }
  .bu-net-tag {
    font-size: 11px !important;
    padding: 7px 12px !important;
  }
  .bu-btn-gold {
    padding: 11px 24px !important;
    font-size: 11px !important;
  }
  .bu-yt-card-footer {
    flex-direction: column !important;
    align-items: flex-start !important;
  }
  .bu-yt-action {
    width: 100% !important;
  }
  .bu-yt-btn {
    width: 100% !important;
    justify-content: center !important;
  }
}
</style>
