<?php
include('config.php');

$event_id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$aryData  = null;

if ($event_id > 0) {
    $db->where('id', $event_id);
    $aryData = $db->getOne('events');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo (!empty($aryData) && is_array($aryData) && !empty($aryData['title'])) ? htmlspecialchars($aryData['title']) . ' - Bhabha University Bhopal' : 'Campus Events & Activities - Bhabha University Bhopal'; ?></title>
<meta name="description" content="<?php echo (!empty($aryData) && is_array($aryData) && !empty($aryData['description'])) ? htmlspecialchars(substr(strip_tags($aryData['description']), 0, 160)) : 'Explore upcoming academic, cultural, research, and placement events at Bhabha University Bhopal Madhya Pradesh.'; ?>">

<!-- Include standard meta and fonts -->
<?php include('inc.meta.php'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<style>
/* ============================================================
   BHABHA UNIVERSITY - EVENTS PAGE THEMED STYLES
   Theme: Navy #0A1B54 | Gold #FFC107 | Cream/Light #F8FAFC
   ============================================================ */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051235;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-bg-light: #F8FAFC;
  --bu-card-bg: #FFFFFF;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

body {
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
  background-color: var(--bu-bg-light) !important;
  color: var(--bu-text-dark) !important;
}

/* Page Layout Wrappers */
.bu-evt-wrap {
  width: 100%;
  float: left;
  clear: both;
  padding: 50px 0 90px 0;
}
.bu-evt-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  box-sizing: border-box;
}

/* Two Column Layout Grid */
.bu-evt-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 350px;
  gap: 32px;
  align-items: start;
}
@media (max-width: 991px) {
  .bu-evt-grid {
    grid-template-columns: 1fr;
  }
}

/* Detail Card Boxes */
.bu-evt-card {
  background: var(--bu-card-bg);
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  padding: 32px;
  margin-bottom: 30px;
  box-shadow: 0 4px 20px rgba(10, 27, 84, 0.04);
  transition: all 0.3s ease;
}
.bu-evt-card:hover {
  box-shadow: 0 10px 30px rgba(10, 27, 84, 0.08);
}

/* Main Featured Image */
.bu-evt-banner-wrap {
  position: relative;
  border-radius: 16px;
  overflow: hidden;
  margin-bottom: 30px;
  box-shadow: 0 8px 30px rgba(10, 27, 84, 0.08);
  border: 1px solid var(--bu-border);
  background: #051235;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
}
.bu-evt-banner-img {
  max-width: 100%;
  height: auto;
  max-height: 650px;
  object-fit: contain;
  border-radius: 10px;
  display: block;
  margin: 0 auto;
  transition: transform 0.4s ease;
}
.bu-evt-banner-wrap:hover .bu-evt-banner-img {
  transform: scale(1.01);
}
.bu-evt-badge-overlay {
  position: absolute;
  top: 20px;
  left: 20px;
  background: var(--bu-gold);
  color: var(--bu-navy);
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 30px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

/* Headings & Typography */
.bu-evt-h2 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(24px, 2.5vw, 32px);
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0 0 16px 0;
  line-height: 1.25;
}
.bu-evt-h2 em {
  font-style: italic;
  color: var(--bu-gold-dark);
}
.bu-evt-divider {
  width: 50px;
  height: 3px;
  background: var(--bu-gold);
  margin-bottom: 24px;
  border-radius: 2px;
}

/* Description Text */
.bu-evt-desc {
  font-size: 15px;
  line-height: 1.8;
  color: #334155;
}
.bu-evt-desc p {
  margin-bottom: 16px;
}
.bu-evt-desc img {
  max-width: 100% !important;
  height: auto !important;
  border-radius: 12px;
  margin: 15px 0;
}

/* Sidebar Widgets */
.bu-widget {
  background: var(--bu-card-bg);
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
}
.bu-widget-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 18px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0 0 16px 0;
  padding-bottom: 10px;
  border-bottom: 2px solid #F1F5F9;
  position: relative;
}
.bu-widget-title::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 40px;
  height: 2px;
  background: var(--bu-gold);
}

/* Quick Info Items */
.bu-info-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.bu-info-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px dashed #E2E8F0;
}
.bu-info-item:last-child {
  border-bottom: none;
}
.bu-info-icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(10, 27, 84, 0.06);
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  flex-shrink: 0;
}
.bu-info-content label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: var(--bu-text-muted);
  margin: 0 0 2px 0;
}
.bu-info-content span {
  font-size: 13.5px;
  font-weight: 600;
  color: var(--bu-text-dark);
}

/* Recent Events List Widget */
.bu-recent-event {
  display: flex;
  gap: 12px;
  align-items: center;
  padding: 10px 0;
  border-bottom: 1px solid #F1F5F9;
  text-decoration: none;
  transition: all 0.2s ease;
}
.bu-recent-event:last-child {
  border-bottom: none;
}
.bu-recent-event:hover {
  transform: translateX(4px);
}
.bu-recent-img {
  width: 60px;
  height: 60px;
  border-radius: 8px;
  object-fit: cover;
  flex-shrink: 0;
}
.bu-recent-title {
  font-size: 13px;
  font-weight: 600;
  color: var(--bu-navy);
  line-height: 1.35;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* CTA Sidebar Card */
.bu-cta-card {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 100%);
  color: #ffffff;
  border-radius: 16px;
  padding: 28px;
  text-align: center;
  box-shadow: 0 8px 24px rgba(10, 27, 84, 0.2);
}
.bu-cta-card h4 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px;
  color: var(--bu-gold);
  margin: 0 0 10px 0;
}
.bu-cta-card p {
  font-size: 13px;
  color: #94A3B8;
  margin-bottom: 20px;
  line-height: 1.5;
}
.bu-cta-btn {
  display: inline-block;
  background: var(--bu-gold);
  color: var(--bu-navy);
  font-size: 12.5px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 12px 24px;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.25s ease;
}
.bu-cta-btn:hover {
  background: var(--bu-gold-dark);
  color: var(--bu-navy);
  transform: translateY(-2px);
  text-decoration: none;
}
.bu-back-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--bu-navy);
  color: var(--bu-gold);
  font-weight: 700;
  font-size: 13px;
  padding: 10px 20px;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.25s ease;
}
.bu-back-btn:hover {
  background: var(--bu-navy-light);
  color: #ffffff;
  text-decoration: none;
}

/* ============================================================
   EVENTS DIRECTORY & LIST VIEW (TAB WISE & SEARCH BAR)
   ============================================================ */
.bu-events-dir-header {
  text-align: center;
  margin-bottom: 36px;
}
.bu-events-dir-header .bu-evt-h2 {
  margin-bottom: 8px;
}
.bu-events-dir-header p {
  font-size: 15px;
  color: var(--bu-text-muted);
  max-width: 600px;
  margin: 0 auto;
}

/* Category Filter Tabs */
.bu-events-cat-nav {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 28px;
}
.bu-cat-tab-btn {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  color: var(--bu-text-dark);
  padding: 10px 20px;
  border-radius: 30px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s ease;
  box-shadow: 0 2px 6px rgba(0,0,0,0.03);
}
.bu-cat-tab-btn i {
  color: var(--bu-gold-dark);
  font-size: 14px;
}
.bu-cat-tab-btn:hover {
  background: #f1f5f9;
  border-color: #cbd5e1;
  transform: translateY(-1px);
}
.bu-cat-tab-btn.active {
  background: var(--bu-navy);
  color: #ffffff;
  border-color: var(--bu-navy);
  box-shadow: 0 4px 14px rgba(10, 27, 84, 0.2);
}
.bu-cat-tab-btn.active i {
  color: var(--bu-gold);
}

/* Search Bar Toolbar */
.bu-events-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  background: #ffffff;
  padding: 14px 20px;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  box-shadow: 0 2px 10px rgba(10, 27, 84, 0.03);
  margin-bottom: 30px;
  flex-wrap: wrap;
}
.bu-events-search-bar-wrap {
  position: relative;
  flex: 1;
  min-width: 260px;
}
.bu-events-search-icon {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--bu-text-muted);
  font-size: 15px;
  pointer-events: none;
}
.bu-events-search-input {
  width: 100%;
  padding: 11px 40px 11px 40px;
  border: 1.5px solid #e2e8f0;
  border-radius: 8px;
  font-size: 14px;
  color: var(--bu-navy);
  background: #f8fafc;
  outline: none;
  transition: all 0.2s ease;
  box-sizing: border-box;
}
.bu-events-search-input:focus {
  background: #ffffff;
  border-color: var(--bu-navy);
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.1);
}
.bu-events-search-clear {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #94a3b8;
  cursor: pointer;
  font-size: 16px;
  padding: 4px;
  display: none;
}
.bu-events-search-clear:hover {
  color: #ef4444;
}
.bu-events-count-badge {
  font-size: 13px;
  color: var(--bu-navy);
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* Event List Row View */
.bu-events-list-wrap {
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.bu-event-row {
  display: flex;
  align-items: center;
  background: var(--bu-card-bg);
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 20px 24px;
  box-shadow: 0 3px 12px rgba(10, 27, 84, 0.03);
  transition: all 0.25s ease;
  gap: 24px;
}
.bu-event-row:hover {
  border-color: var(--bu-gold);
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(10, 27, 84, 0.08);
}
.bu-event-col-media {
  flex-shrink: 0;
  width: 140px;
  height: 95px;
  border-radius: 10px;
  overflow: hidden;
  background: #051235;
  display: flex;
  align-items: center;
  justify-content: center;
}
.bu-event-thumb {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.bu-event-badge-box {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #0A1B54 0%, #051235 100%);
  color: var(--bu-gold);
  padding: 10px;
  text-align: center;
  box-sizing: border-box;
}
.bu-event-badge-box i {
  font-size: 26px;
  margin-bottom: 5px;
}
.bu-badge-text {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #ffffff;
}
.bu-event-col-content {
  flex: 1;
  min-width: 0;
}
.bu-event-meta-row {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 6px;
  flex-wrap: wrap;
}
.bu-event-tag {
  background: rgba(255, 193, 7, 0.15);
  color: #92400e;
  border: 1px solid rgba(255, 193, 7, 0.4);
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-event-meta-item {
  font-size: 12px;
  color: var(--bu-text-muted);
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.bu-event-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 19px;
  font-weight: 700;
  margin: 0 0 6px 0;
  line-height: 1.35;
}
.bu-event-title a {
  color: var(--bu-navy);
  text-decoration: none;
  transition: color 0.2s ease;
}
.bu-event-title a:hover {
  color: var(--bu-gold-dark);
}
.bu-event-desc {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.bu-event-col-action {
  flex-shrink: 0;
}
.bu-event-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #f1f5f9;
  color: var(--bu-navy);
  font-size: 13px;
  font-weight: 700;
  padding: 10px 18px;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s ease;
  white-space: nowrap;
}
.bu-event-btn i {
  font-size: 12px;
  transition: transform 0.2s ease;
}
.bu-event-row:hover .bu-event-btn {
  background: var(--bu-navy);
  color: var(--bu-gold);
}
.bu-event-row:hover .bu-event-btn i {
  transform: translateX(4px);
}

@media (max-width: 767px) {
  .bu-event-row {
    flex-direction: column;
    align-items: flex-start;
    padding: 18px;
    gap: 16px;
  }
  .bu-event-col-media {
    width: 100%;
    height: 140px;
  }
  .bu-event-col-action {
    width: 100%;
  }
  .bu-event-btn {
    width: 100%;
    justify-content: center;
  }
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  // Setup Inner Page Banner
  $hasSingle = (!empty($aryData) && is_array($aryData));
  $page_title    = $hasSingle ? htmlspecialchars($aryData['title']) : 'Campus <em>Events &amp; Activities</em>';
  $page_subtitle = $hasSingle ? 'Official notification, event highlights, and activity schedule.' : 'Explore upcoming seminars, cultural festivals, academic workshops, and campus activities at Bhabha University.';
  $page_icon     = 'fa-calendar';
  $breadcrumbs   = [
    ['label' => 'Home',   'url' => URL_ROOT],
    ['label' => 'Events', 'url' => href('events.php')],
  ];
  if ($hasSingle) {
    $breadcrumbs[] = ['label' => htmlspecialchars($aryData['title']), 'url' => '#'];
  }
  include('inc.page-banner.php');
  ?>

  <div class="bu-evt-wrap">
    <div class="bu-evt-container">

      <?php if ($hasSingle): ?>
      <!-- ================= SINGLE EVENT VIEW ================= -->
      <div class="bu-evt-grid">
        
        <!-- Left Main Column -->
        <main>
          <!-- Main Feature Image Banner (Rendered only if image is set in database) -->
          <?php if (!empty($aryData['image'])): ?>
          <div class="bu-evt-banner-wrap">
            <img src="<?php echo URL_UPLOAD . 'events/' . $aryData['image']; ?>" alt="<?php echo htmlspecialchars($aryData['title']); ?>" class="bu-evt-banner-img" onerror="this.closest('.bu-evt-banner-wrap').style.display='none';">
            <span class="bu-evt-badge-overlay"><i class="fa fa-calendar-check-o"></i> Official Campus Event</span>
          </div>
          <?php endif; ?>

          <!-- Description Card -->
          <div class="bu-evt-card">
            <h2 class="bu-evt-h2"><?php echo htmlspecialchars($aryData['title']); ?></h2>
            <div class="bu-evt-divider"></div>
            
            <div class="bu-evt-desc">
              <h4 style="font-size: 17px; font-weight: 700; color: var(--bu-navy); margin-bottom: 12px;">Event Overview</h4>
              <?php echo !empty($aryData['description']) ? $aryData['description'] : '<p>Join us at Bhabha University for this special campus event. Students, faculty, and academic experts gather to participate and collaborate.</p>'; ?>
            </div>
          </div>

          <!-- Detailed Information Card -->
          <?php if (!empty($aryData['details'])): ?>
          <div class="bu-evt-card">
            <h3 class="bu-evt-h2" style="font-size: 22px;">Event <em>Details &amp; Schedule</em></h3>
            <div class="bu-evt-divider"></div>
            <div class="bu-evt-desc">
              <?php echo $aryData['details']; ?>
            </div>
          </div>
          <?php endif; ?>

          <!-- Action & Navigation Bar -->
          <div style="margin-top: 20px; display: flex; gap: 15px; flex-wrap: wrap; align-items: center; justify-content: space-between;">
            <a href="<?php echo href('events.php'); ?>" class="bu-back-btn"><i class="fa fa-arrow-left"></i> View All Events</a>
            <a href="<?php echo href('contact.php'); ?>" class="bu-cta-btn" style="background: var(--bu-navy); color: var(--bu-gold);"><i class="fa fa-envelope-o" style="margin-right:6px;"></i> Contact Organiser</a>
          </div>

        </main>

        <!-- Right Sidebar Column -->
        <aside>
          <!-- Quick Info Widget -->
          <div class="bu-widget">
            <h3 class="bu-widget-title">Event Quick Info</h3>
            <ul class="bu-info-list">
              <li class="bu-info-item">
                <div class="bu-info-icon"><i class="fa fa-university"></i></div>
                <div class="bu-info-content">
                  <label>Venue / Location</label>
                  <span>Bhabha University Campus, Bhopal</span>
                </div>
              </li>
              <li class="bu-info-item">
                <div class="bu-info-icon"><i class="fa fa-clock-o"></i></div>
                <div class="bu-info-content">
                  <label>Timing</label>
                  <span>10:00 AM onwards</span>
                </div>
              </li>
              <li class="bu-info-item">
                <div class="bu-info-icon"><i class="fa fa-users"></i></div>
                <div class="bu-info-content">
                  <label>Organized By</label>
                  <span>Bhabha University Event Cell</span>
                </div>
              </li>
              <li class="bu-info-item">
                <div class="bu-info-icon"><i class="fa fa-ticket"></i></div>
                <div class="bu-info-content">
                  <label>Registration &amp; Entry</label>
                  <span>Open for Students &amp; Faculty</span>
                </div>
              </li>
            </ul>
          </div>

          <!-- Other Recent Events Sidebar Widget -->
          <div class="bu-widget">
            <h3 class="bu-widget-title">Recent Events</h3>
            <?php
            if (isset($aryData['id'])) {
              $db->where('id', $aryData['id'], '!=');
            }
            $otherEvents = $db->get('events', 4);
            if (is_array($otherEvents) && count($otherEvents) > 0):
              foreach($otherEvents as $oevt):
                $hasThumb = !empty($oevt['image']);
            ?>
            <a href="<?php echo href('events.php', 'id=' . $oevt['id']); ?>" class="bu-recent-event">
              <?php if ($hasThumb): ?>
                <img src="<?php echo URL_UPLOAD . 'events/' . $oevt['image']; ?>" alt="<?php echo htmlspecialchars($oevt['title']); ?>" class="bu-recent-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="bu-recent-icon-badge" style="display:none;"><i class="fa fa-calendar-check-o"></i></div>
              <?php else: ?>
                <div class="bu-recent-icon-badge"><i class="fa fa-calendar-check-o"></i></div>
              <?php endif; ?>
              <div class="bu-recent-title"><?php echo htmlspecialchars($oevt['title']); ?></div>
            </a>
            <?php 
              endforeach;
            else:
              echo '<p style="font-size:13px; color:#64748B;">No other events listed currently.</p>';
            endif;
            ?>
          </div>

          <!-- CTA Sidebar Card -->
          <div class="bu-cta-card">
            <h4>Admissions 2026-27</h4>
            <p>Explore top undergraduate, postgraduate, and diploma programs at Bhabha University Bhopal.</p>
            <a href="<?php echo href('enquiry.php'); ?>" class="bu-cta-btn">Apply Now &nbsp;→</a>
          </div>
        </aside>

      </div>

      <?php else: ?>
      <!-- ================= ALL EVENTS DIRECTORY LIST VIEW ================= -->
      <div class="bu-events-directory-header">
        <span class="bu-events-subtitle-tag"><i class="fa fa-calendar"></i> Campus Life &amp; Activities</span>
        <h2 class="bu-evt-h2" style="font-size: 36px; margin-bottom: 12px;">Discover <em>Campus Events</em></h2>
        <p style="font-size: 15px; color: var(--bu-text-muted); max-width: 650px; margin: 0 auto 25px;">Stay connected with seminars, workshops, cultural fests, and academic celebrations happening across Bhabha University.</p>
        <div class="bu-evt-divider" style="margin: 0 auto;"></div>
      </div>

      <?php
      $allEvents = $db->get('events');
      $totalEvents = (is_array($allEvents)) ? count($allEvents) : 0;

      // Calculate category counts
      $categoryCounts = [];
      if ($totalEvents > 0) {
        foreach ($allEvents as $evt) {
          $catName = !empty($evt['category']) ? trim($evt['category']) : 'Campus Event';
          $categoryCounts[$catName] = ($categoryCounts[$catName] ?? 0) + 1;
        }
      }
      ?>

      <!-- Category Filter Tabs -->
      <?php if ($totalEvents > 0 && count($categoryCounts) > 1): ?>
      <div class="bu-events-cat-tabs" id="eventsCategoryTabs">
        <button type="button" class="bu-cat-tab-btn active" data-category="all">
          <i class="fa fa-th-large"></i>
          <span>All Events</span>
          <span class="bu-tab-count"><?php echo $totalEvents; ?></span>
        </button>
        <?php foreach ($categoryCounts as $catName => $catCnt): 
          $catIcon = 'fa-tag';
          if (stripos($catName, 'webinar') !== false) $catIcon = 'fa-laptop';
          elseif (stripos($catName, 'seminar') !== false || stripos($catName, 'workshop') !== false) $catIcon = 'fa-graduation-cap';
          elseif (stripos($catName, 'lecture') !== false) $catIcon = 'fa-microphone';
          elseif (stripos($catName, 'celebrat') !== false || stripos($catName, 'fest') !== false) $catIcon = 'fa-trophy';
          elseif (stripos($catName, 'cultural') !== false || stripos($catName, 'sport') !== false) $catIcon = 'fa-users';
        ?>
        <button type="button" class="bu-cat-tab-btn" data-category="<?php echo htmlspecialchars($catName); ?>">
          <i class="fa <?php echo $catIcon; ?>"></i>
          <span><?php echo htmlspecialchars($catName); ?></span>
          <span class="bu-tab-count"><?php echo $catCnt; ?></span>
        </button>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <!-- Search & Count Bar -->
      <div class="bu-events-controls-bar">
        <div class="bu-events-search-box">
          <i class="fa fa-search bu-events-search-icon"></i>
          <input type="text" id="eventSearchInput" class="bu-events-search-input" placeholder="Search events by title, keyword, or topic..." autocomplete="off">
          <button type="button" id="clearSearchBtn" class="bu-events-search-clear" title="Clear search"><i class="fa fa-times-circle"></i></button>
        </div>
        <div id="eventsCountBadge" class="bu-events-count-badge">
          <i class="fa fa-calendar-check-o" style="color:var(--bu-gold-dark);"></i> Showing <strong><?php echo $totalEvents; ?></strong> Events
        </div>
      </div>

      <div class="bu-events-list-wrap" id="eventsListContainer">
        <?php
        if ($totalEvents > 0):
          foreach ($allEvents as $evt):
            $cleanTitle = htmlspecialchars($evt['title']);
            $cleanDesc  = !empty($evt['description']) ? strip_tags($evt['description']) : 'Official event and interactive session hosted at Bhabha University Bhopal campus.';
            $hasImg     = !empty($evt['image']);
            $imgUrl     = $hasImg ? URL_UPLOAD . 'events/' . $evt['image'] : '';
            $rowCat     = !empty($evt['category']) ? $evt['category'] : 'Campus Event';
        ?>
        <div class="bu-event-row" data-category="<?php echo htmlspecialchars($rowCat); ?>" data-title="<?php echo strtolower($cleanTitle); ?>" data-desc="<?php echo strtolower(htmlspecialchars($cleanDesc)); ?>">
          <!-- Media / Badge Box -->
          <div class="bu-event-col-media">
            <?php if ($hasImg): ?>
              <img src="<?php echo $imgUrl; ?>" alt="<?php echo $cleanTitle; ?>" class="bu-event-thumb" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
              <div class="bu-event-badge-box" style="display: none;">
                <i class="fa fa-calendar-check-o"></i>
                <span class="bu-badge-text">EVENT</span>
              </div>
            <?php else: ?>
              <div class="bu-event-badge-box">
                <i class="fa fa-calendar-check-o"></i>
                <span class="bu-badge-text">EVENT</span>
              </div>
            <?php endif; ?>
          </div>

          <!-- Content Details -->
          <div class="bu-event-col-content">
            <div class="bu-event-meta-row">
              <span class="bu-event-tag"><i class="fa fa-tag"></i> <?php echo htmlspecialchars($rowCat); ?></span>
              <span class="bu-event-meta-item"><i class="fa fa-map-marker"></i> Bhopal Campus</span>
            </div>
            <h3 class="bu-event-title">
              <a href="<?php echo href('events.php', 'id=' . $evt['id']); ?>">
                <?php echo $cleanTitle; ?>
              </a>
            </h3>
            <p class="bu-event-desc">
              <?php echo $cleanDesc; ?>
            </p>
          </div>

          <!-- Action Button -->
          <div class="bu-event-col-action">
            <a href="<?php echo href('events.php', 'id=' . $evt['id']); ?>" class="bu-event-btn">
              <span>View Details</span> <i class="fa fa-arrow-right"></i>
            </a>
          </div>
        </div>
        <?php 
          endforeach;
        ?>

        <!-- No Matching Search Results Placeholder -->
        <div id="noSearchResults" style="display: none; text-align: center; background: #ffffff; padding: 48px; border-radius: 14px; border: 1px solid var(--bu-border); box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);">
          <i class="fa fa-search" style="font-size: 38px; color: var(--bu-gold); margin-bottom: 14px;"></i>
          <h4 style="font-size: 18px; color: var(--bu-navy); font-weight: 700; margin-bottom: 6px;">No Matching Events Found</h4>
          <p style="font-size: 14px; color: var(--bu-text-muted); margin: 0;">Try adjusting your search terms or selecting a different category tab.</p>
        </div>

        <?php else: ?>
        <div style="text-align: center; background: #ffffff; padding: 48px; border-radius: 16px; border: 1px solid var(--bu-border);">
          <i class="fa fa-calendar-o" style="font-size: 42px; color: var(--bu-gold); margin-bottom: 16px;"></i>
          <h3 style="font-size: 20px; color: var(--bu-navy); font-weight: 700; margin-bottom: 8px;">No Events Found</h3>
          <p style="font-size: 14px; color: var(--bu-text-muted); margin-bottom: 20px;">There are no active events posted at the moment. Please check back soon.</p>
          <a href="<?php echo href('index.php'); ?>" class="bu-back-btn">Return to Home</a>
        </div>
        <?php endif; ?>
      </div>

      <?php endif; ?>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var searchInput = document.getElementById('eventSearchInput');
  var clearSearchBtn = document.getElementById('clearSearchBtn');
  var countBadge = document.getElementById('eventsCountBadge');
  var eventRows = document.querySelectorAll('.bu-event-row');
  var noResultsBox = document.getElementById('noSearchResults');
  var tabButtons = document.querySelectorAll('.bu-cat-tab-btn');
  
  var currentCategory = 'all';
  var currentQuery = '';

  function filterEvents() {
    var visibleCount = 0;

    eventRows.forEach(function(row) {
      var rowCategory = (row.getAttribute('data-category') || '').trim();
      var title = row.getAttribute('data-title') || '';
      var desc = row.getAttribute('data-desc') || '';

      var categoryMatches = (currentCategory === 'all' || rowCategory.toLowerCase() === currentCategory.toLowerCase());
      var queryMatches = (!currentQuery || title.indexOf(currentQuery) !== -1 || desc.indexOf(currentQuery) !== -1);

      if (categoryMatches && queryMatches) {
        row.style.display = 'flex';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    if (countBadge) {
      countBadge.innerHTML = '<i class="fa fa-calendar-check-o" style="color:var(--bu-gold-dark);"></i> Showing <strong>' + visibleCount + '</strong> Event' + (visibleCount === 1 ? '' : 's');
    }

    if (noResultsBox) {
      noResultsBox.style.display = (visibleCount === 0) ? 'block' : 'none';
    }
  }

  // Category Tab Click Handler
  tabButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      tabButtons.forEach(function(b) { b.classList.remove('active'); });
      this.classList.add('active');
      currentCategory = this.getAttribute('data-category') || 'all';
      filterEvents();
    });
  });

  // Search Input Handler
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      currentQuery = this.value.toLowerCase().trim();
      if (clearSearchBtn) {
        clearSearchBtn.style.display = currentQuery ? 'block' : 'none';
      }
      filterEvents();
    });
  }

  // Clear Search Handler
  if (clearSearchBtn) {
    clearSearchBtn.addEventListener('click', function() {
      if (searchInput) {
        searchInput.value = '';
        currentQuery = '';
        this.style.display = 'none';
        searchInput.focus();
        filterEvents();
      }
    });
  }
});
</script>
</body>
</html>
