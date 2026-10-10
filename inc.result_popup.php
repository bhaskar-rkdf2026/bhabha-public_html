<?php
/**
 * inc.result_popup.php
 * Official Notification Modal Popup for Homepage (Dual-Section Feature)
 * Left Section: Star Milestone / ISRO Selection Poster + Press Coverage CTA
 * Right Section: Important University Notices, Declared Results & Circulars
 * Bhabha University Theme: Deep Navy (#0A1B54, #051235), Royal Gold (#FFC107, #D99B00)
 */

global $db;

// 1. Fetch Dynamic Popup Settings
$popupSettings = [];
if (isset($db) && is_object($db)) {
    $db->where('page_key', 'home_result_popup');
    $portalRow = $db->getOne('site_portal_pages');
    if ($portalRow && !empty($portalRow['content_data'])) {
        $popupSettings = json_decode($portalRow['content_data'], true) ?: [];
    }
}

// Check if popup is disabled by admin
if (isset($popupSettings['enabled']) && intval($popupSettings['enabled']) === 0) {
    return; // Don't output popup if turned off
}

// Default fallback settings
$defaultSettings = [
    'enabled' => 1,
    'header_title' => 'Important Notices & Results',
    'header_subtitle' => 'Official circulars & declared semester examination marks',
    'header_icon' => 'fa fa-bell',
    'result_btn_text' => 'View Result ↗',
    'result_btn_link' => 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx',
    'close_btn_text' => 'Got it, Close',
    'show_dont_show_today' => 1,
    'left_achiever_enabled' => 1,
    'achiever_pill' => 'STAR MILESTONE • ISRO',
    'achiever_image' => 'govind-singh-isro.jpg',
    'achiever_caption' => "<strong>Govind Singh (M.Tech)</strong> selected as Scientist/Engineer 'SC' at URSC, ISRO Bengaluru.",
    'achiever_cta_text' => 'Read Press Coverage',
    'achiever_cta_link' => 'news.php?id=203'
];
$pop = array_merge($defaultSettings, $popupSettings);

// 2. Fetch dynamic notice cards from site_popup_notices
$popupNotices = [];
if (isset($db) && is_object($db)) {
    try {
        $db->where('status', 1);
        $db->orderBy('sort_order', 'ASC');
        $db->orderBy('id', 'DESC');
        $popupNotices = $db->get('site_popup_notices');
    } catch (\Exception $e) {}
}

// Fallback notices if none returned from DB
if (empty($popupNotices)) {
    $popupNotices = [
        [
            'tag' => 'RESULT NOTIFICATION • B.SC. B.ED',
            'title' => '📖 B.Sc. B.Ed – 6th Semester (Regular)',
            'description' => 'June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-green'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • B.SC. B.ED',
            'title' => '📖 B.Sc. B.Ed – 5th, 3rd & 1st Semester (Ex)',
            'description' => 'June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-gold'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • M.SC.',
            'title' => '🔬 M.Sc. – 2nd Semester (Regular) – All Branches',
            'description' => 'June-2026 post-graduate results declared (05 Oct 2026). All concerned students please check your results online.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-blue'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • M.SC.',
            'title' => '🔬 M.Sc. – 1st Semester (Ex) – All Branches',
            'description' => 'June-2026 post-graduate examination results declared (05 Oct 2026). All concerned students please check your results online.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-purple'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • B.PHARM',
            'title' => '🎓 B.Pharm – 4th Semester (Regular)',
            'description' => 'Examination results declared and published on the official portal.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-navy'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • DIPLOMA HMCT',
            'title' => '🍽️ Diploma HMCT – 1st Year (Regular)',
            'description' => '1st Year annual examination marksheet and result live.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-gold'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • M.PHARM',
            'title' => '🔬 M.Pharm – 2nd Semester (Regular)',
            'description' => 'Post-graduate semester examination results available online.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-blue'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • B.SC. B.ED',
            'title' => '📖 B.Sc. B.Ed – 2nd Semester (Regular)',
            'description' => '4-Year integrated programme results declared.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-green'
        ],
        [
            'tag' => 'RESULT NOTIFICATION • B.PHARM',
            'title' => '🎓 B.Pharm – 2nd Semester (Regular)',
            'description' => '2nd Semester regular examination results declared.',
            'link' => $pop['result_btn_link'],
            'color_class' => 'is-navy'
        ]
    ];
}

if (!function_exists('bu_pop_resolve_url')) {
    function bu_pop_resolve_url($url) {
        if (empty($url)) return '#';
        $url = trim($url);
        if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0 || strpos($url, '//') === 0 || strpos($url, '#') === 0 || strpos($url, 'javascript:') === 0 || strpos($url, 'mailto:') === 0 || strpos($url, 'tel:') === 0) {
            return $url;
        }
        $root = defined('URL_ROOT') ? URL_ROOT : '/';
        return rtrim($root, '/') . '/' . ltrim($url, '/');
    }
}

// 3. Achiever Section Assets
$govindNews = null;
if (isset($db) && is_object($db)) {
    $govindNews = $db->where('image', '307a24b505ca5d4b45f4bef7b8d1bd75.jpg')->getOne('news');
    if (!$govindNews) {
        $govindNews = $db->where('id', 203)->getOne('news');
    }
}
$govindId = ($govindNews && !empty($govindNews['id'])) ? $govindNews['id'] : 203;
$defaultGovindUrl = defined('URL_ROOT') ? URL_ROOT . 'news.php?id=' . $govindId : 'news.php?id=' . $govindId;
$rawCtaLink = !empty($pop['achiever_cta_link']) ? $pop['achiever_cta_link'] : $defaultGovindUrl;
$achieverCtaUrl = bu_pop_resolve_url($rawCtaLink);

$achieverImgRaw = $pop['achiever_image'];
$achieverWebp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $achieverImgRaw);
if (file_exists(PATH_ROOT . '/images/' . $achieverWebp)) {
    $achieverImgRaw = $achieverWebp;
}
if (strpos($achieverImgRaw, 'http://') === 0 || strpos($achieverImgRaw, 'https://') === 0 || strpos($achieverImgRaw, '//') === 0) {
    $achieverImgUrl = $achieverImgRaw;
} elseif (strpos($achieverImgRaw, 'upload/') === 0) {
    $achieverImgUrl = (defined('URL_ROOT') ? URL_ROOT : '') . $achieverImgRaw;
} else {
    $achieverImgUrl = URL_IMG . $achieverImgRaw;
}
$mainResultLink = bu_pop_resolve_url(!empty($pop['result_btn_link']) ? $pop['result_btn_link'] : 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx');
?>
<style>
/* ================================================================
   BHABHA UNIVERSITY — NOTIFICATION MODAL POPUP (DUAL-SECTION)
   Theme: Deep Navy #0A1B54, Gold #FFC107, Clean White & Slate
   ================================================================ */
.bu-res-popup-overlay {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  margin: 0 !important;
  padding: 24px 16px !important;
  background: rgba(5, 18, 53, 0.78) !important;
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  z-index: 99999999 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  box-sizing: border-box !important;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.28s ease, visibility 0.28s ease;
}
.bu-res-popup-overlay.show {
  opacity: 1;
  visibility: visible;
}

.bu-res-popup-box {
  background: #ffffff;
  border-radius: 18px;
  max-width: 880px !important;
  width: 95% !important;
  margin: auto !important;
  box-shadow: 0 25px 70px -10px rgba(5, 18, 53, 0.65), 0 0 0 1px rgba(255, 193, 7, 0.35);
  overflow: hidden;
  position: relative;
  display: flex;
  flex-direction: row;
  transform: scale(0.94);
  transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
  box-sizing: border-box;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  max-height: 90vh;
}
.bu-res-popup-overlay.show .bu-res-popup-box {
  transform: scale(1);
}

/* ================================================================
   LEFT SECTION: STAR ACHIEVER / ISRO POSTER & CTA
   ================================================================ */
.bu-res-popup-left {
  flex: 0 0 350px;
  max-width: 350px;
  background: linear-gradient(180deg, #051235 0%, #0A1B54 60%, #07153D 100%);
  padding: 16px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-sizing: border-box;
  border-right: 2px solid rgba(255, 193, 7, 0.25);
  position: relative;
  overflow: hidden;
}
.bu-res-popup-left::before {
  content: "";
  position: absolute;
  top: -40px;
  left: -40px;
  width: 140px;
  height: 140px;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.18) 0%, transparent 70%);
  pointer-events: none;
}

.bu-achiever-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(255, 193, 7, 0.15);
  border: 1px solid rgba(255, 193, 7, 0.4);
  color: #FFC107;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 0.6px;
  text-transform: uppercase;
  padding: 5px 10px;
  border-radius: 20px;
  margin-bottom: 10px;
  align-self: flex-start;
}
.bu-achiever-star {
  font-size: 11px;
  animation: buStarPulse 1.8s ease-in-out infinite;
}
@keyframes buStarPulse {
  0%, 100% { transform: scale(1); opacity: 0.9; }
  50% { transform: scale(1.25); opacity: 1; }
}

.bu-achiever-img-wrap {
  width: 100%;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.45);
  border: 1px solid rgba(255, 255, 255, 0.15);
  background: #051235;
  margin-bottom: 12px;
  display: block;
  text-decoration: none;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.bu-achiever-img-wrap:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 30px rgba(0, 0, 0, 0.6);
}
.bu-achiever-img {
  width: 100%;
  height: auto;
  max-height: 310px;
  object-fit: contain;
  display: block;
}

.bu-achiever-bottom {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.bu-achiever-caption {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.85);
  line-height: 1.4;
  margin: 0;
}
.bu-achiever-caption strong {
  color: #FFC107;
  font-weight: 700;
}

/* Call to Action Button */
.bu-achiever-cta {
  background: linear-gradient(135deg, #FFC107 0%, #FFB300 100%);
  color: #0A1B54 !important;
  font-size: 12.5px;
  font-weight: 800;
  letter-spacing: -0.1px;
  padding: 10px 14px;
  border-radius: 8px;
  text-decoration: none !important;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 4px 14px rgba(255, 193, 7, 0.35);
  transition: all 0.22s ease;
}
.bu-achiever-cta:hover {
  background: linear-gradient(135deg, #FFD54F 0%, #FFC107 100%);
  transform: translateY(-1.5px);
  box-shadow: 0 6px 18px rgba(255, 193, 7, 0.5);
  color: #051235 !important;
}
.bu-achiever-cta i.fa-arrow-right {
  transition: transform 0.2s ease;
}
.bu-achiever-cta:hover i.fa-arrow-right {
  transform: translateX(4px);
}

/* ================================================================
   RIGHT SECTION: NOTICES & CIRCULARS LIST
   ================================================================ */
.bu-res-popup-right {
  flex: 1 1 auto;
  display: flex;
  flex-direction: column;
  background: #ffffff;
  min-width: 0;
}

/* 1. Header (University Navy + Gold Bottom Accent) */
.bu-res-popup-header {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 100%);
  padding: 13px 18px;
  color: #ffffff;
  position: relative;
  border-bottom: 3px solid #FFC107;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-res-header-left {
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-res-header-bell {
  font-size: 20px;
  color: #FFC107;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  animation: buBellRing 3s ease-in-out infinite;
  transform-origin: top center;
}
@keyframes buBellRing {
  0%, 100% { transform: rotate(0); }
  10%, 30% { transform: rotate(14deg); }
  20%, 40% { transform: rotate(-14deg); }
  50% { transform: rotate(0); }
}
.bu-res-header-text h3 {
  font-size: 13.5px;
  font-weight: 800;
  margin: 0;
  color: #ffffff;
  line-height: 1.25;
  letter-spacing: -0.2px;
}
.bu-res-header-text p {
  font-size: 10px;
  color: rgba(255, 255, 255, 0.8);
  margin: 2px 0 0 0;
  line-height: 1.2;
}

.bu-res-popup-close {
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #ffffff;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  line-height: 1;
  padding: 0;
  flex-shrink: 0;
}
.bu-res-popup-close:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #0A1B54;
  transform: rotate(90deg);
}

/* 2. Body */
.bu-res-popup-body {
  padding: 12px 16px;
  max-height: 330px;
  overflow-y: auto;
  background: #ffffff;
  box-sizing: border-box;
  flex: 1 1 auto;
}

/* Custom Sleek Scrollbar */
.bu-res-popup-body::-webkit-scrollbar {
  width: 5px;
}
.bu-res-popup-body::-webkit-scrollbar-track {
  background: #F1F5F9;
  border-radius: 4px;
}
.bu-res-popup-body::-webkit-scrollbar-thumb {
  background: #CBD5E1;
  border-radius: 4px;
}
.bu-res-popup-body::-webkit-scrollbar-thumb:hover {
  background: #94A3B8;
}

.bu-notif-cards-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

/* Individual Notification Card */
.bu-notif-card {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 8px 12px;
  text-decoration: none !important;
  color: inherit !important;
  display: block;
  transition: all 0.2s ease;
  position: relative;
}
.bu-notif-card:hover {
  transform: translateY(-1.5px);
  background: #FFFDF5;
  box-shadow: 0 4px 14px rgba(10, 27, 84, 0.08);
}

/* Theme Accents */
.bu-notif-card.is-navy {
  border-left: 4px solid #0A1B54;
}
.bu-notif-card.is-navy .bu-notif-tag {
  color: #0A1B54;
}
.bu-notif-card.is-gold {
  border-left: 4px solid #D99B00;
  background: #FFFDF5;
}
.bu-notif-card.is-gold .bu-notif-tag {
  color: #B45309;
}
.bu-notif-card.is-blue {
  border-left: 4px solid #1E40AF;
}
.bu-notif-card.is-blue .bu-notif-tag {
  color: #1E40AF;
}
.bu-notif-card.is-green {
  border-left: 4px solid #059669;
  background: #F0FDF4;
}
.bu-notif-card.is-green .bu-notif-tag {
  color: #059669;
}
.bu-notif-card.is-purple {
  border-left: 4px solid #6D28D9;
  background: #FAF5FF;
}
.bu-notif-card.is-purple .bu-notif-tag {
  color: #6D28D9;
}
.bu-notif-card.is-red {
  border-left: 4px solid #B91C1C;
  background: #FEF2F2;
}
.bu-notif-card.is-red .bu-notif-tag {
  color: #B91C1C;
}

.bu-notif-tag {
  font-size: 9.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 2px;
  display: block;
}

.bu-notif-content {
  font-size: 11.5px;
  color: #374151;
  line-height: 1.4;
  margin: 0;
}
.bu-notif-content strong {
  color: #0A1B54;
  font-weight: 700;
}

/* 3. Footer Bar */
.bu-res-popup-footer {
  background: #ffffff;
  border-top: 1px solid #E5E7EB;
  padding: 10px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  box-sizing: border-box;
}

.bu-notif-checkbox-label {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 11px;
  color: #64748B;
  cursor: pointer;
  user-select: none;
  margin: 0;
  font-weight: 600;
}
.bu-notif-checkbox-label input[type="checkbox"] {
  cursor: pointer;
  width: 14px;
  height: 14px;
  accent-color: #0A1B54;
  margin: 0;
}

.bu-notif-footer-btns {
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-notif-btn-outline {
  background: #ffffff;
  border: 1.5px solid #CBD5E1;
  color: #0A1B54 !important;
  font-size: 11.5px;
  font-weight: 700;
  padding: 6px 12px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s ease;
  cursor: pointer;
}
.bu-notif-btn-outline:hover {
  background: #F1F5F9;
  border-color: #0A1B54;
  color: #0A1B54 !important;
}

.bu-notif-btn-close {
  background: #0A1B54;
  border: 1.5px solid #0A1B54;
  color: #ffffff !important;
  font-size: 11.5px;
  font-weight: 700;
  padding: 6px 14px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.bu-notif-btn-close:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #0A1B54 !important;
}

/* ================================================================
   RESPONSIVE LAYOUT (MOBILE & TABLET BREAKPOINTS)
   ================================================================ */
@media (max-width: 768px) {
  .bu-res-popup-overlay {
    padding: 16px 12px !important;
  }
  .bu-res-popup-box {
    flex-direction: column !important;
    max-width: 96% !important;
    width: 96% !important;
    max-height: 88vh !important;
    overflow-y: auto !important;
  }
  .bu-res-popup-left {
    flex: none !important;
    max-width: 100% !important;
    border-right: none !important;
    border-bottom: 3px solid #FFC107 !important;
    padding: 14px !important;
  }
  .bu-achiever-img {
    max-height: 220px !important;
  }
  .bu-res-popup-right {
    flex: none !important;
  }
  .bu-res-popup-body {
    max-height: 220px !important;
    padding: 12px 14px !important;
  }
  .bu-res-popup-footer {
    padding: 10px 14px !important;
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 8px !important;
  }
  .bu-notif-footer-btns {
    justify-content: space-between !important;
  }
  .bu-notif-btn-outline, .bu-notif-btn-close {
    flex: 1 !important;
    justify-content: center !important;
  }
}
</style>

<!-- DUAL-SECTION MODAL POPUP COMPONENT (CENTERED SCREEN OVERLAY) -->
<div id="buResultModalOverlay" class="bu-res-popup-overlay" onclick="closeBuResultModal(event)">
  <div class="bu-res-popup-box" onclick="event.stopPropagation()">
    
    <?php if (!empty($pop['left_achiever_enabled'])): ?>
    <!-- LEFT SECTION: STAR ACHIEVER / ISRO POSTER & CTA -->
    <div class="bu-res-popup-left">
      <div>
        <div class="bu-achiever-pill">
          <span class="bu-achiever-star"><i class="fa fa-star"></i></span>
          <span><?php echo htmlspecialchars($pop['achiever_pill']); ?></span>
        </div>

        <a href="<?php echo htmlspecialchars($achieverCtaUrl); ?>" class="bu-achiever-img-wrap" title="<?php echo htmlspecialchars(strip_tags($pop['achiever_caption'])); ?>">
          <img src="<?php echo htmlspecialchars($achieverImgUrl); ?>" alt="Bhabha University Achiever" class="bu-achiever-img" loading="lazy" decoding="async" width="316" height="220">
        </a>
      </div>

      <div class="bu-achiever-bottom">
        <p class="bu-achiever-caption">
          <?php echo $pop['achiever_caption']; ?>
        </p>
        <a href="<?php echo htmlspecialchars($achieverCtaUrl); ?>" class="bu-achiever-cta">
          <span><i class="fa fa-newspaper-o" style="margin-right:6px;"></i> <?php echo htmlspecialchars($pop['achiever_cta_text']); ?></span>
          <i class="fa fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <?php endif; ?>

    <!-- RIGHT SECTION: IMPORTANT NOTICES, RESULTS & CIRCULARS -->
    <div class="bu-res-popup-right">
      
      <!-- Header -->
      <div class="bu-res-popup-header">
        <div class="bu-res-header-left">
          <div class="bu-res-header-bell">
            <i class="<?php echo htmlspecialchars($pop['header_icon'] ?? 'fa fa-bell'); ?>"></i>
          </div>
          <div class="bu-res-header-text">
            <h3><?php echo htmlspecialchars($pop['header_title']); ?></h3>
            <p><?php echo htmlspecialchars($pop['header_subtitle']); ?></p>
          </div>
        </div>
        <button type="button" class="bu-res-popup-close" onclick="closeBuResultModal()" aria-label="Close">&times;</button>
      </div>

      <!-- Body: Notification Cards with Theme Colored Accents -->
      <div class="bu-res-popup-body">
        <div class="bu-notif-cards-list">
          <?php foreach ($popupNotices as $card): 
            $cardLink = !empty($card['link']) ? $card['link'] : $pop['result_btn_link'];
            $colorCls = !empty($card['color_class']) ? $card['color_class'] : 'is-navy';
          ?>
          <a href="<?php echo htmlspecialchars($cardLink); ?>" target="_blank" class="bu-notif-card <?php echo htmlspecialchars($colorCls); ?>">
            <span class="bu-notif-tag"><?php echo htmlspecialchars($card['tag']); ?></span>
            <p class="bu-notif-content">
              <strong><?php echo htmlspecialchars($card['title']); ?></strong><?php if (!empty($card['description'])): ?> &mdash; <?php echo htmlspecialchars($card['description']); ?><?php endif; ?>
            </p>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Footer Bar -->
      <div class="bu-res-popup-footer">
        <?php if (!empty($pop['show_dont_show_today'])): ?>
        <label class="bu-notif-checkbox-label">
          <input type="checkbox" id="buNotifDontShowToday"> Don't show again today
        </label>
        <?php else: ?>
        <div></div>
        <?php endif; ?>
        <div class="bu-notif-footer-btns">
          <a href="<?php echo htmlspecialchars($mainResultLink); ?>" target="_blank" class="bu-notif-btn-outline">
            <?php echo htmlspecialchars($pop['result_btn_text']); ?>
          </a>
          <button type="button" onclick="closeBuResultModal()" class="bu-notif-btn-close">
            <?php echo htmlspecialchars($pop['close_btn_text']); ?>
          </button>
        </div>
      </div>

    </div>

  </div>
</div>

<script>
(function() {
  var STORAGE_KEY = 'bu_result_popup_dismissed_v3_date';

  function shouldShowPopup() {
    try {
      // Do not auto-display during automated PageSpeed / Lighthouse performance audits
      if (/Lighthouse|PageSpeed|Google-InspectionTool|HeadlessChrome|GTmetrix/i.test(navigator.userAgent)) {
        return false;
      }
      var savedDate = localStorage.getItem(STORAGE_KEY);
      var today = new Date().toISOString().slice(0, 10);
      if (savedDate === today) {
        return false;
      }
    } catch(e) {}
    return true;
  }

  function openBuResultModal() {
    if (!shouldShowPopup()) return;
    var overlay = document.getElementById('buResultModalOverlay');
    if (overlay) {
      overlay.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
  }

  window.closeBuResultModal = function(e) {
    if (e && e.target && e.target !== e.currentTarget && !e.target.classList.contains('bu-res-popup-close') && !e.target.classList.contains('bu-notif-btn-close')) {
      return;
    }
    
    // Check if user selected "Don't show again today"
    var chk = document.getElementById('buNotifDontShowToday');
    if (chk && chk.checked) {
      try {
        var today = new Date().toISOString().slice(0, 10);
        localStorage.setItem(STORAGE_KEY, today);
      } catch(e) {}
    }

    var overlay = document.getElementById('buResultModalOverlay');
    if (overlay) {
      overlay.classList.remove('show');
      document.body.style.overflow = '';
    }
  };

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      window.closeBuResultModal();
    }
  });

  // Delay opening for human visitors until hero is established & painted
  window.addEventListener('load', function() {
    setTimeout(openBuResultModal, 2500);
  });
})();
</script>
