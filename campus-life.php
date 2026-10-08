<?php
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('campus-life') : null;
$clData = !empty($portalPage['data']) ? $portalPage['data'] : [];

if (!function_exists('bu_cl_img_url')) {
    function bu_cl_img_url($img) {
        if (empty($img)) return URL_ROOT . 'extra-images/col-3-thum5.jpg';
        if (strpos($img, 'http://') === 0 || strpos($img, 'https://') === 0) return $img;
        $clean = ltrim($img, '/\\');
        if (strpos($clean, 'upload/') === 0) {
            return URL_ROOT . $clean;
        }
        return URL_UPLOAD . $clean;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Campus Life - Student Events, Sports & World-Class Infrastructure | Bhabha University Bhopal'); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($clData['meta_description'] ?? 'Experience life at Bhabha University Bhopal — vibrant cultural fests, sports championships, student clubs, 32-acre green campus, modern hostels, and state-of-the-art infrastructure.'); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($clData['meta_keywords'] ?? 'Bhabha University campus life, student life Bhopal, cultural fest Tarang, sports meet, university hostels, campus infrastructure, university clubs, student events'); ?>">
<?php include('inc.meta.php'); ?>

<style>
/* ================================================================
   BHABHA UNIVERSITY — CAMPUS LIFE DEDICATED SHOWCASE
   Theme: Deep Navy #0A1B54, Royal Gold #FFC107, Emerald #10B981
   ================================================================ */
:root {
  --cl-navy: #0A1B54;
  --cl-navy-dark: #051235;
  --cl-navy-light: #162B75;
  --cl-gold: #FFC107;
  --cl-gold-dark: #D99B00;
  --cl-gold-light: #FFF9E6;
  --cl-border: #E2E8F0;
  --cl-text-dark: #1E293B;
  --cl-text-muted: #64748B;
  --cl-bg-light: #F8FAFC;
}

.bu-cl-container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 45px 20px 80px;
  box-sizing: border-box;
  clear: both;
}

/* Quick Stats Bar — Modern Floating Showcase */
.bu-cl-stats-bar {
  background: #ffffff;
  border-radius: 16px;
  padding: 24px 18px;
  margin-top: 0;
  margin-bottom: 45px;
  position: relative;
  z-index: 10;
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 12px;
  box-shadow: 0 16px 40px -10px rgba(10, 27, 84, 0.12), 0 3px 12px rgba(0, 0, 0, 0.04);
  border: 1px solid rgba(10, 27, 84, 0.08);
  border-top: 3px solid var(--cl-gold);
}
.bu-cl-stat-item {
  text-align: center;
  border-right: 1px solid #EDF2F7;
  padding: 8px 12px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: transform 0.25s ease;
}
.bu-cl-stat-item:last-child {
  border-right: none;
}
.bu-cl-stat-item:hover {
  transform: translateY(-3px);
}
.bu-cl-stat-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  margin-bottom: 10px;
  transition: all 0.25s ease;
}
.bu-cl-stat-icon.is-green {
  background: #ECFDF5;
  color: #059669;
}
.bu-cl-stat-icon.is-amber {
  background: #FFFBEB;
  color: #D97706;
}
.bu-cl-stat-icon.is-blue {
  background: #EFF6FF;
  color: #2563EB;
}
.bu-cl-stat-icon.is-indigo {
  background: #EEF2FF;
  color: #4F46E5;
}
.bu-cl-stat-icon.is-gold {
  background: #FFFDF0;
  color: #B45309;
}
.bu-cl-stat-item:hover .bu-cl-stat-icon {
  transform: scale(1.1);
  box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
}
.bu-cl-stat-number {
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--cl-navy);
  line-height: 1.1;
  letter-spacing: -0.5px;
  margin-bottom: 6px;
  display: inline-flex;
  align-items: baseline;
  justify-content: center;
}
.bu-cl-stat-symbol {
  color: #D97706;
  font-weight: 800;
  font-size: 24px;
  margin-left: 2px;
}
.bu-cl-stat-label {
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  font-size: 11.5px;
  text-transform: uppercase;
  letter-spacing: 0.7px;
  color: #64748B;
  font-weight: 700;
  line-height: 1.35;
}
@media (max-width: 991px) {
  .bu-cl-container {
    padding: 30px 16px 60px;
  }
  .bu-cl-stats-bar {
    grid-template-columns: repeat(3, 1fr);
    margin-top: 0;
    padding: 20px 14px;
  }
}
@media (max-width: 600px) {
  .bu-cl-stats-bar {
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    padding: 16px 10px;
  }
  .bu-cl-stat-item {
    border-right: none;
    border-bottom: 1px solid #EDF2F7;
    padding: 12px 6px;
  }
  .bu-cl-stat-number {
    font-size: 26px;
  }
  .bu-cl-stat-symbol {
    font-size: 20px;
  }
}

/* Category Filter Bar */
.bu-cl-filters {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 45px;
}
.bu-cl-filter-btn {
  background: #ffffff;
  border: 1px solid var(--cl-border);
  color: var(--cl-text-dark);
  font-size: 13px;
  font-weight: 700;
  padding: 9px 18px;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
}
.bu-cl-filter-btn:hover,
.bu-cl-filter-btn.active {
  background: var(--cl-navy);
  color: var(--cl-gold);
  border-color: var(--cl-navy);
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(10, 27, 84, 0.15);
  text-decoration: none;
}

/* Section Block Heading */
.bu-cl-sec-header {
  text-align: center;
  max-width: 820px;
  margin: 0 auto 36px;
}
.bu-cl-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--cl-gold-light);
  color: #B45309;
  border: 1px solid rgba(245, 158, 11, 0.35);
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 5px 14px;
  border-radius: 20px;
  margin-bottom: 12px;
}
.bu-cl-title {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 10px 0;
  line-height: 1.25;
}
.bu-cl-title em {
  font-style: italic;
  color: #D97706;
}
.bu-cl-desc {
  font-size: 14.5px;
  line-height: 1.65;
  color: var(--cl-text-muted);
  margin: 0;
}

/* Event & Infrastructure Cards Grid */
.bu-cl-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 26px;
  margin-bottom: 60px;
}
@media (max-width: 768px) {
  .bu-cl-grid {
    grid-template-columns: 1fr;
  }
}

.bu-cl-card {
  background: #ffffff;
  border: 1px solid var(--cl-border);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(10, 27, 84, 0.05);
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  display: flex;
  flex-direction: column;
}
.bu-cl-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 36px rgba(10, 27, 84, 0.12);
  border-color: rgba(255, 193, 7, 0.6);
}

.bu-cl-card-img-wrap {
  position: relative;
  width: 100%;
  height: 230px;
  overflow: hidden;
  background: #0A1B54;
  cursor: pointer;
}
.bu-cl-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
  display: block;
}
.bu-cl-card:hover .bu-cl-card-img {
  transform: scale(1.06);
}
.bu-cl-card-pill {
  position: absolute;
  top: 12px;
  left: 12px;
  background: rgba(7, 19, 56, 0.85);
  backdrop-filter: blur(4px);
  color: #FFC107;
  border: 1px solid rgba(255, 193, 7, 0.4);
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 4px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  z-index: 2;
}
.bu-cl-zoom-btn {
  position: absolute;
  bottom: 12px;
  right: 12px;
  background: rgba(0, 0, 0, 0.65);
  color: #ffffff;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  opacity: 0;
  transform: scale(0.8);
  transition: all 0.25s ease;
  z-index: 2;
}
.bu-cl-card-img-wrap:hover .bu-cl-zoom-btn {
  opacity: 1;
  transform: scale(1);
}

.bu-cl-card-body {
  padding: 22px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.bu-cl-card-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 8px 0;
  line-height: 1.35;
}
.bu-cl-card-text {
  font-size: 13px;
  line-height: 1.6;
  color: var(--cl-text-muted);
  margin: 0 0 14px 0;
  flex-grow: 1;
}
.bu-cl-card-tags {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  margin-top: auto;
  padding-top: 12px;
  border-top: 1px solid #F1F5F9;
}
.bu-cl-tag {
  font-size: 11px;
  font-weight: 600;
  background: #F1F5F9;
  color: #475569;
  padding: 2px 8px;
  border-radius: 4px;
}

/* Feature Showcase Strip (Clubs & Extracurriculars) */
.bu-cl-spotlight-box {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  border-radius: 14px;
  padding: 36px 32px;
  color: #ffffff;
  margin-bottom: 60px;
  position: relative;
  overflow: hidden;
}
.bu-cl-spotlight-box::after {
  content: '';
  position: absolute;
  top: -50%;
  right: -10%;
  width: 350px;
  height: 350px;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.12) 0%, transparent 70%);
  pointer-events: none;
}
.bu-cl-spotlight-header {
  max-width: 700px;
  margin-bottom: 28px;
}
.bu-cl-spotlight-header h3 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 8px 0;
}
.bu-cl-spotlight-header p {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
}
.bu-cl-clubs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
@media (max-width: 991px) {
  .bu-cl-clubs-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 600px) {
  .bu-cl-clubs-grid {
    grid-template-columns: 1fr;
  }
}
.bu-cl-club-item {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 8px;
  padding: 16px 18px;
  transition: all 0.25s ease;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 14px;
}
.bu-cl-club-item:hover {
  background: rgba(255, 193, 7, 0.18);
  border-color: #FFC107;
  transform: translateY(-2px);
  text-decoration: none;
}
.bu-cl-club-icon {
  width: 40px;
  height: 40px;
  background: #FFC107;
  color: #0A1B54;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}
.bu-cl-club-title {
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  margin: 0 0 2px 0;
}
.bu-cl-club-sub {
  color: rgba(255, 255, 255, 0.7);
  font-size: 11.5px;
  margin: 0;
}

/* Call to Action Box */
.bu-cl-cta {
  background: #F8FAFC;
  border: none;
  border-radius: 16px;
  padding: 40px 30px;
  text-align: center;
  margin-top: 40px;
  box-shadow: 0 12px 32px rgba(10, 27, 84, 0.06);
}
.bu-cl-cta h3 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 8px 0;
}
.bu-cl-cta p {
  font-size: 14px;
  color: var(--cl-text-muted);
  max-width: 600px;
  margin: 0 auto 20px;
}
.bu-cl-cta-btns {
  display: flex;
  justify-content: center;
  gap: 14px;
  flex-wrap: wrap;
}
.bu-btn-primary {
  background: var(--cl-gold);
  color: var(--cl-navy);
  font-weight: 800;
  font-size: 13.5px;
  padding: 12px 26px;
  border-radius: 6px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-btn-primary:hover {
  background: var(--cl-navy);
  color: var(--cl-gold);
  text-decoration: none;
  transform: translateY(-2px);
}
.bu-btn-secondary {
  background: var(--cl-navy);
  color: #ffffff;
  font-weight: 700;
  font-size: 13.5px;
  padding: 12px 24px;
  border-radius: 6px;
  text-decoration: none;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-btn-secondary:hover {
  background: #051235;
  color: var(--cl-gold);
  text-decoration: none;
  transform: translateY(-2px);
}

/* Lightbox Modal */
.bu-cl-modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(5, 18, 53, 0.92);
  backdrop-filter: blur(8px);
  z-index: 9999999;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.bu-cl-modal.open {
  display: flex;
}
.bu-cl-modal-content {
  max-width: 900px;
  width: 100%;
  background: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
  position: relative;
  animation: buModalIn 0.3s ease;
}
@keyframes buModalIn {
  from { opacity: 0; transform: scale(0.94); }
  to { opacity: 1; transform: scale(1); }
}
.bu-cl-modal-img {
  width: 100%;
  max-height: 520px;
  object-fit: contain;
  background: #000000;
  display: block;
}
.bu-cl-modal-caption {
  padding: 18px 24px;
  background: #ffffff;
}
.bu-cl-modal-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 4px 0;
}
.bu-cl-modal-desc {
  font-size: 13px;
  color: var(--cl-text-muted);
  margin: 0;
}
.bu-cl-modal-close {
  position: absolute;
  top: 14px;
  right: 14px;
  background: rgba(0, 0, 0, 0.6);
  color: #ffffff;
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 10;
  transition: all 0.2s ease;
}
.bu-cl-modal-close:hover {
  background: #EF4444;
  transform: rotate(90deg);
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <!-- INNER BANNER -->
  <?php
  $page_title    = portalVal($portalPage, 'heading', 'Vibrant <em>Campus Life</em>');
  $page_subtitle = portalVal($portalPage, 'subheading', 'Experience 32 acres of academic innovation, active student clubs, grand cultural fests, sports excellence, and world-class living facilities.');
  $page_icon     = !empty($clData['page_icon']) ? $clData['page_icon'] : 'fa-compass';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-cl-container">
    <main>
      
      <!-- 1. Quick Stats Banner -->
      <?php
      $stats = !empty($clData['stats']) ? $clData['stats'] : [
        ['icon' => 'fa-tree', 'class' => 'is-green', 'number' => '32', 'symbol' => '+', 'label' => 'Lush Green Acres'],
        ['icon' => 'fa-calendar-check-o', 'class' => 'is-amber', 'number' => '50', 'symbol' => '+', 'label' => 'Annual Events &amp; Fests'],
        ['icon' => 'fa-users', 'class' => 'is-blue', 'number' => '8', 'symbol' => '+', 'label' => 'Student Clubs &amp; Cells'],
        ['icon' => 'fa-flask', 'class' => 'is-indigo', 'number' => '120', 'symbol' => '+', 'label' => 'Hi-Tech Labs &amp; Studios'],
        ['icon' => 'fa-sun-o', 'class' => 'is-gold', 'number' => '100', 'symbol' => '%', 'label' => 'Solar-Powered Campus']
      ];
      ?>
      <div class="bu-cl-stats-bar">
        <?php foreach ($stats as $st): ?>
        <div class="bu-cl-stat-item">
          <div class="bu-cl-stat-icon <?php echo htmlspecialchars($st['class'] ?? 'is-blue'); ?>"><i class="fa <?php echo htmlspecialchars($st['icon'] ?? 'fa-star'); ?>"></i></div>
          <div class="bu-cl-stat-number"><?php echo htmlspecialchars($st['number'] ?? '0'); ?><span class="bu-cl-stat-symbol"><?php echo htmlspecialchars($st['symbol'] ?? '+'); ?></span></div>
          <div class="bu-cl-stat-label"><?php echo htmlspecialchars($st['label'] ?? ''); ?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- 2. Section Jump Filters -->
      <div class="bu-cl-filters">
        <a href="#events" class="bu-cl-filter-btn"><i class="fa fa-calendar-check-o text-warning"></i> Cultural Events &amp; Fests</a>
        <a href="#sports" class="bu-cl-filter-btn"><i class="fa fa-futbol-o text-success"></i> Sports &amp; Athletics</a>
        <a href="#clubs" class="bu-cl-filter-btn"><i class="fa fa-users text-info"></i> Clubs &amp; Societies</a>
        <a href="#facilities" class="bu-cl-filter-btn"><i class="fa fa-building-o text-danger"></i> Campus Infrastructure</a>
      </div>

      <!-- 3. SECTION: CULTURAL EVENTS & STUDENT LIFE -->
      <?php
      $evSec = $clData['events_sec'] ?? [];
      $evBadge = $evSec['badge'] ?? 'Student Celebrations';
      $evBadgeIcon = $evSec['badge_icon'] ?? 'fa-calendar-o';
      $evTitle = $evSec['title'] ?? 'Events, Fests &amp; <em>Youth Energy</em>';
      $evDesc = $evSec['desc'] ?? 'At Bhabha University, learning extends far beyond lecture halls. From grand stage performances and tech hackathons to culinary carnivals and social service camps, campus life is alive with creativity, friendship, and leadership.';
      $evItems = !empty($evSec['items']) ? $evSec['items'] : [];
      ?>
      <section id="events" style="scroll-margin-top: 100px;">
        <div class="bu-cl-sec-header">
          <span class="bu-cl-badge"><i class="fa <?php echo htmlspecialchars($evBadgeIcon); ?>"></i> <?php echo htmlspecialchars($evBadge); ?></span>
          <h2 class="bu-cl-title"><?php echo $evTitle; ?></h2>
          <p class="bu-cl-desc"><?php echo htmlspecialchars($evDesc); ?></p>
        </div>

        <div class="bu-cl-grid">
          <?php foreach ($evItems as $ev): 
            $evImgUrl = bu_cl_img_url($ev['image'] ?? '');
            $evTitleText = htmlspecialchars($ev['title'] ?? '');
            $evModalTitle = addslashes(htmlspecialchars($ev['modal_title'] ?? $ev['title'] ?? ''));
            $evModalDesc = addslashes(htmlspecialchars($ev['modal_desc'] ?? $ev['text'] ?? ''));
            $evTags = !empty($ev['tags']) && is_array($ev['tags']) ? $ev['tags'] : [];
          ?>
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo htmlspecialchars($evImgUrl); ?>', '<?php echo $evModalTitle; ?>', '<?php echo $evModalDesc; ?>')">
              <img src="<?php echo htmlspecialchars($evImgUrl); ?>" alt="<?php echo $evTitleText; ?>" class="bu-cl-card-img" loading="lazy">
              <?php if (!empty($ev['pill_text'])): ?>
                <span class="bu-cl-card-pill"><i class="fa <?php echo htmlspecialchars($ev['pill_icon'] ?? 'fa-music'); ?>"></i> <?php echo htmlspecialchars($ev['pill_text']); ?></span>
              <?php endif; ?>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title"><?php echo $evTitleText; ?></h3>
              <p class="bu-cl-card-text"><?php echo htmlspecialchars($ev['text'] ?? ''); ?></p>
              <?php if (!empty($evTags)): ?>
              <div class="bu-cl-card-tags">
                <?php foreach ($evTags as $tag): ?>
                  <span class="bu-cl-tag"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 4. SECTION: SPORTS & FITNESS -->
      <?php
      $spSec = $clData['sports_sec'] ?? [];
      $spBadge = $spSec['badge'] ?? 'Athletics &amp; Wellness';
      $spBadgeIcon = $spSec['badge_icon'] ?? 'fa-trophy';
      $spTitle = $spSec['title'] ?? 'Sports Grounds, Tournaments &amp; <em>Fitness Suite</em>';
      $spDesc = $spSec['desc'] ?? 'Physical well-being and competitive spirit are vital pillars at Bhabha University. With tournament-standard cricket grounds, volleyball arenas, gymnasium suites, and indoor recreation, sports enthusiasts flourish every single day.';
      $spItems = !empty($spSec['items']) ? $spSec['items'] : [];
      ?>
      <section id="sports" style="scroll-margin-top: 100px;">
        <div class="bu-cl-sec-header">
          <span class="bu-cl-badge"><i class="fa <?php echo htmlspecialchars($spBadgeIcon); ?>"></i> <?php echo htmlspecialchars($spBadge); ?></span>
          <h2 class="bu-cl-title"><?php echo $spTitle; ?></h2>
          <p class="bu-cl-desc"><?php echo htmlspecialchars($spDesc); ?></p>
        </div>

        <div class="bu-cl-grid">
          <?php foreach ($spItems as $sp): 
            $spImgUrl = bu_cl_img_url($sp['image'] ?? '');
            $spTitleText = htmlspecialchars($sp['title'] ?? '');
            $spModalTitle = addslashes(htmlspecialchars($sp['modal_title'] ?? $sp['title'] ?? ''));
            $spModalDesc = addslashes(htmlspecialchars($sp['modal_desc'] ?? $sp['text'] ?? ''));
            $spTags = !empty($sp['tags']) && is_array($sp['tags']) ? $sp['tags'] : [];
          ?>
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo htmlspecialchars($spImgUrl); ?>', '<?php echo $spModalTitle; ?>', '<?php echo $spModalDesc; ?>')">
              <img src="<?php echo htmlspecialchars($spImgUrl); ?>" alt="<?php echo $spTitleText; ?>" class="bu-cl-card-img" loading="lazy">
              <?php if (!empty($sp['pill_text'])): ?>
                <span class="bu-cl-card-pill"><i class="fa <?php echo htmlspecialchars($sp['pill_icon'] ?? 'fa-trophy'); ?>"></i> <?php echo htmlspecialchars($sp['pill_text']); ?></span>
              <?php endif; ?>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title"><?php echo $spTitleText; ?></h3>
              <p class="bu-cl-card-text"><?php echo htmlspecialchars($sp['text'] ?? ''); ?></p>
              <?php if (!empty($spTags)): ?>
              <div class="bu-cl-card-tags">
                <?php foreach ($spTags as $tag): ?>
                  <span class="bu-cl-tag"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 5. SECTION: CLUBS & SOCIETIES SPOTLIGHT -->
      <?php
      $clSecBox = $clData['clubs_sec'] ?? [];
      $clBoxTitle = $clSecBox['title'] ?? 'Student Clubs &amp; Creative Societies';
      $clBoxDesc = $clSecBox['desc'] ?? 'Clubs at Bhabha University empower students to lead initiatives, explore diverse hobbies, nurture mental wellness, and create social impact alongside their degree.';
      ?>
      <section id="clubs" style="scroll-margin-top: 100px;">
        <div class="bu-cl-spotlight-box">
          <div class="bu-cl-spotlight-header">
            <h3><?php echo htmlspecialchars($clBoxTitle); ?></h3>
            <p><?php echo htmlspecialchars($clBoxDesc); ?></p>
          </div>

          <div class="bu-cl-clubs-grid">
            <a href="<?php echo href('clubs.php'); ?>#abhivyakti" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-paint-brush"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Abhivyakti Cultural Club</h4>
                <p class="bu-cl-club-sub">Music, Fine Arts, Theater &amp; Dance</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#unload-pittara" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-heart"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Unload Pittara</h4>
                <p class="bu-cl-club-sub">Youth Well-being &amp; Peer Support</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#khelo-bhabha" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-futbol-o"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Khelo Bhabha Club</h4>
                <p class="bu-cl-club-sub">Intra-University Sports &amp; Fitness</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#environment-club" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-leaf"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Green Environment Club</h4>
                <p class="bu-cl-club-sub">1101 Trees &amp; Sustainability</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#navgrah-vatika" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-tree"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Nav Grah Herbal Vatika</h4>
                <p class="bu-cl-club-sub">Medicinal Plants &amp; AYUSH Research</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#edc-cell" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-lightbulb-o"></i></div>
              <div>
                <h4 class="bu-cl-club-title">EDC &amp; Startup Cell</h4>
                <p class="bu-cl-club-sub">Entrepreneurship &amp; Incubation Hub</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#legal-aid" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-balance-scale"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Legal Aid Clinic</h4>
                <p class="bu-cl-club-sub">Social Justice &amp; Free Legal Support</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#ad-mad" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-bullhorn"></i></div>
              <div>
                <h4 class="bu-cl-club-title">AD-MAD Media Club</h4>
                <p class="bu-cl-club-sub">Branding, Advertising &amp; Campaigns</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#staff-club" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-users"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Staff &amp; Faculty Club</h4>
                <p class="bu-cl-club-sub">Educator Well-Being &amp; Synergy</p>
              </div>
            </a>
          </div>

          <div style="margin-top: 24px; text-align: right;">
            <a href="<?php echo href('clubs.php'); ?>" style="color:#FFC107; font-weight:700; font-size:13.5px; text-decoration:none;">
              View All University Clubs &amp; Registration Details <i class="fa fa-arrow-right" style="margin-left:4px;"></i>
            </a>
          </div>
        </div>
      </section>

      <!-- 6. SECTION: CAMPUS INFRASTRUCTURE -->
      <?php
      $inSec = $clData['infra_sec'] ?? [];
      $inBadge = $inSec['badge'] ?? '32-Acre Campus';
      $inBadgeIcon = $inSec['badge_icon'] ?? 'fa-building-o';
      $inTitle = $inSec['title'] ?? 'World-Class <em>Campus Infrastructure</em>';
      $inDesc = $inSec['desc'] ?? 'Every corner of Bhabha University is built with purpose. Explore our air-conditioned convention auditoriums, high-tech simulation laboratories, lush eco-gardens, on-campus hostels, and community radio broadcasting studios.';
      $inItems = !empty($inSec['items']) ? $inSec['items'] : [];
      ?>
      <section id="facilities" style="scroll-margin-top: 100px;">
        <div id="hostels" style="scroll-margin-top: 100px;"></div>
        <div class="bu-cl-sec-header">
          <span class="bu-cl-badge"><i class="fa <?php echo htmlspecialchars($inBadgeIcon); ?>"></i> <?php echo htmlspecialchars($inBadge); ?></span>
          <h2 class="bu-cl-title"><?php echo $inTitle; ?></h2>
          <p class="bu-cl-desc"><?php echo htmlspecialchars($inDesc); ?></p>
        </div>

        <div class="bu-cl-grid">
          <?php foreach ($inItems as $in): 
            $inImgUrl = bu_cl_img_url($in['image'] ?? '');
            $inTitleText = htmlspecialchars($in['title'] ?? '');
            $inModalTitle = addslashes(htmlspecialchars($in['modal_title'] ?? $in['title'] ?? ''));
            $inModalDesc = addslashes(htmlspecialchars($in['modal_desc'] ?? $in['text'] ?? ''));
            $inTags = !empty($in['tags']) && is_array($in['tags']) ? $in['tags'] : [];
            $anchorAttr = !empty($in['anchor_id']) ? ' id="' . htmlspecialchars($in['anchor_id']) . '"' : '';
          ?>
          <article class="bu-cl-card"<?php echo $anchorAttr; ?>>
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo htmlspecialchars($inImgUrl); ?>', '<?php echo $inModalTitle; ?>', '<?php echo $inModalDesc; ?>')">
              <img src="<?php echo htmlspecialchars($inImgUrl); ?>" alt="<?php echo $inTitleText; ?>" class="bu-cl-card-img" loading="lazy">
              <?php if (!empty($in['pill_text'])): ?>
                <span class="bu-cl-card-pill"><i class="fa <?php echo htmlspecialchars($in['pill_icon'] ?? 'fa-building-o'); ?>"></i> <?php echo htmlspecialchars($in['pill_text']); ?></span>
              <?php endif; ?>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title"><?php echo $inTitleText; ?></h3>
              <p class="bu-cl-card-text"><?php echo htmlspecialchars($in['text'] ?? ''); ?></p>
              <?php if (!empty($inTags)): ?>
              <div class="bu-cl-card-tags">
                <?php foreach ($inTags as $tag): ?>
                  <span class="bu-cl-tag"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 7. Call To Action -->
      <?php
      $cta = $clData['cta'] ?? [];
      $ctaHeading = $cta['heading'] ?? 'Ready to Experience Bhabha Campus Life?';
      $ctaDesc = $cta['desc'] ?? 'Step inside our 32-acre thriving campus. Connect with counselors, take a guided tour of our laboratories and hostels, or begin your admission process today.';
      $ctaBtn1Text = $cta['btn1_text'] ?? 'Apply For Admission 2026-27';
      $ctaBtn1Url = !empty($cta['btn1_url']) ? href($cta['btn1_url']) : href('enquiry.php');
      $ctaBtn2Text = $cta['btn2_text'] ?? 'Virtual Campus Tour';
      $ctaBtn2Url = !empty($cta['btn2_url']) ? href($cta['btn2_url']) : href('virtual.php');
      ?>
      <div class="bu-cl-cta">
        <h3><?php echo htmlspecialchars($ctaHeading); ?></h3>
        <p><?php echo htmlspecialchars($ctaDesc); ?></p>
        <div class="bu-cl-cta-btns">
          <a href="<?php echo $ctaBtn1Url; ?>" class="bu-btn-primary"><?php echo htmlspecialchars($ctaBtn1Text); ?> <i class="fa fa-arrow-right"></i></a>
          <a href="<?php echo $ctaBtn2Url; ?>" class="bu-btn-secondary"><i class="fa fa-globe"></i> <?php echo htmlspecialchars($ctaBtn2Text); ?></a>
        </div>
      </div>

    </main>
  </div>

  <!-- Interactive Lightbox Modal -->
  <div id="buClModal" class="bu-cl-modal" onclick="closeClModal(event)">
    <div class="bu-cl-modal-content" onclick="event.stopPropagation()">
      <button type="button" class="bu-cl-modal-close" onclick="closeClModal()">&times;</button>
      <img id="buClModalImg" src="" alt="Campus Life Photo" class="bu-cl-modal-img">
      <div class="bu-cl-modal-caption">
        <h3 id="buClModalTitle" class="bu-cl-modal-title"></h3>
        <p id="buClModalDesc" class="bu-cl-modal-desc"></p>
      </div>
    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php'); ?>

<script>
function openClModal(imgUrl, title, desc) {
  var modal = document.getElementById('buClModal');
  var img = document.getElementById('buClModalImg');
  var t = document.getElementById('buClModalTitle');
  var d = document.getElementById('buClModalDesc');

  if (modal && img) {
    img.src = imgUrl;
    if (t) t.innerText = title || 'Bhabha University Campus';
    if (d) d.innerText = desc || '';
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
}

function closeClModal(e) {
  var modal = document.getElementById('buClModal');
  if (modal) {
    modal.classList.remove('open');
    document.body.style.overflow = '';
  }
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeClModal();
  }
});
</script>
</body>
</html>
