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
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

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

/* Grid Layout for All Events View */
.bu-events-directory-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 28px;
}
.bu-dir-card {
  background: var(--bu-card-bg);
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
  display: flex;
  flex-direction: column;
  transition: all 0.3s ease;
}
.bu-dir-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(10, 27, 84, 0.12);
  border-color: var(--bu-gold);
}
.bu-dir-img-wrap {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: var(--bu-navy-dark);
}
.bu-dir-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.bu-dir-card:hover .bu-dir-img {
  transform: scale(1.05);
}
.bu-dir-body {
  padding: 22px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.bu-dir-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 18px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0 0 10px 0;
  line-height: 1.3;
}
.bu-dir-desc {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin-bottom: 18px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.bu-dir-btn {
  margin-top: auto;
  align-self: flex-start;
  color: var(--bu-navy);
  font-weight: 700;
  font-size: 13px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: gap 0.2s ease, color 0.2s ease;
}
.bu-dir-btn:hover {
  color: var(--bu-gold-dark);
  gap: 10px;
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
          <!-- Main Feature Image Banner -->
          <div class="bu-evt-banner-wrap">
            <?php 
            $evtImg = !empty($aryData['image']) ? URL_UPLOAD . 'events/' . $aryData['image'] : URL_ROOT . 'images/banner4.jpg';
            ?>
            <img src="<?php echo $evtImg; ?>" alt="<?php echo htmlspecialchars($aryData['title']); ?>" class="bu-evt-banner-img" onerror="this.src='<?php echo URL_ROOT;?>images/banner4.jpg';">
            <span class="bu-evt-badge-overlay"><i class="fa fa-calendar-check-o"></i> Official Campus Event</span>
          </div>

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
                $thumb = !empty($oevt['image']) ? URL_UPLOAD . 'events/' . $oevt['image'] : URL_ROOT . 'images/banner4.jpg';
            ?>
            <a href="<?php echo href('events.php', 'id=' . $oevt['id']); ?>" class="bu-recent-event">
              <img src="<?php echo $thumb; ?>" alt="<?php echo htmlspecialchars($oevt['title']); ?>" class="bu-recent-img" onerror="this.src='<?php echo URL_ROOT;?>images/banner4.jpg';">
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
      <!-- ================= ALL EVENTS DIRECTORY VIEW ================= -->
      <div style="margin-bottom: 35px; text-align: center;">
        <span style="font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: var(--bu-gold-dark); display: block; margin-bottom: 8px;">CAMPUS LIFE &amp; ACTIVITIES</span>
        <h2 class="bu-evt-h2" style="font-size: 36px; margin-bottom: 12px;">Discover <em>Campus Events</em></h2>
        <p style="font-size: 15px; color: var(--bu-text-muted); max-width: 650px; margin: 0 auto 25px;">Stay connected with seminars, workshops, cultural fests, and academic celebrations happening across Bhabha University.</p>
        <div class="bu-evt-divider" style="margin: 0 auto;"></div>
      </div>

      <div class="bu-events-directory-grid">
        <?php
        $allEvents = $db->get('events');
        if (is_array($allEvents) && count($allEvents) > 0):
          foreach ($allEvents as $evt):
            $eImg = !empty($evt['image']) ? URL_UPLOAD . 'events/' . $evt['image'] : URL_ROOT . 'images/banner4.jpg';
        ?>
        <div class="bu-dir-card">
          <div class="bu-dir-img-wrap">
            <img src="<?php echo $eImg; ?>" alt="<?php echo htmlspecialchars($evt['title']); ?>" class="bu-dir-img" onerror="this.src='<?php echo URL_ROOT;?>images/banner4.jpg';">
          </div>
          <div class="bu-dir-body">
            <h3 class="bu-dir-title"><?php echo htmlspecialchars($evt['title']); ?></h3>
            <div class="bu-dir-desc"><?php echo !empty($evt['description']) ? strip_tags($evt['description']) : 'Official event at Bhabha University Bhopal campus.'; ?></div>
            <a href="<?php echo href('events.php', 'id=' . $evt['id']); ?>" class="bu-dir-btn">
              Event Details <i class="fa fa-arrow-right"></i>
            </a>
          </div>
        </div>
        <?php 
          endforeach;
        else:
        ?>
        <div style="grid-column: 1 / -1; text-align: center; background: #ffffff; padding: 48px; border-radius: 16px; border: 1px solid var(--bu-border);">
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
</body>
</html>
