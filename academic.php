<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('academic') : null;

// Fetch Academic Settings & Dynamic Calendars from database
$db->where('field', array('about_title', 'content'), 'IN');
$acad_records = $db->get('academic');
$acad_settings = [];
if (!empty($acad_records) && is_array($acad_records)) {
    foreach ($acad_records as $ar) {
        $acad_settings[$ar['field']] = $ar['value'];
    }
}
$db_title = trim($acad_settings['about_title'] ?? '');
$db_content = trim($acad_settings['content'] ?? '');

$dynamic_calendars = [];
if (!empty($db_content)) {
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $db_content);
    $links = $dom->getElementsByTagName('a');
    foreach ($links as $index => $a) {
        $href = trim($a->getAttribute('href'));
        $title = trim($a->textContent);
        if (empty($href) || empty($title) || $title === '#') continue;

        // Session year extraction
        $session = '';
        if (preg_match('/(20\d\d\s*[-–]\s*\d{2,4})/', $title, $m)) {
            $session = $m[1];
        }

        // Check if URL is full or filename
        $file_url = $href;
        $file_base = basename($href);
        if (!preg_match('#^https?://#i', $href)) {
            $file_url = URL_UPLOAD . 'media/' . $href;
        }

        $is_img = (preg_match('/\.(jpg|jpeg|png)$/i', $file_base) === 1);

        $dynamic_calendars[] = [
            'title' => $title,
            'session' => $session ?: 'Official Schedule',
            'is_current' => ($index === 0),
            'url' => $file_url,
            'file' => $file_base,
            'is_img' => $is_img,
            'desc' => ($index === 0) ? 'Current active university calendar for all UG, PG & Diploma programs.' : 'Annual academic schedule and examination roadmap.'
        ];
    }
}

// Fallback in case table has no links
if (empty($dynamic_calendars)) {
    $dynamic_calendars = [
        [
            'title' => 'Academic & Activities Calendar 2026 - 27',
            'session' => '2026 - 27',
            'is_current' => true,
            'url' => URL_UPLOAD . 'media/7d991d249d84e341262b9dbef5f996ff.pdf',
            'file' => '7d991d249d84e341262b9dbef5f996ff.pdf',
            'is_img' => false,
            'desc' => 'Current active university calendar for all UG, PG & Diploma programs.'
        ]
    ];
}

$active_cal = $dynamic_calendars[0];
$active_download_url = $active_cal['url'];
$active_session_title = $active_cal['session'] ?: '2026 – 2027';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Academic Calendar &amp; Schedule - Bhabha University Bhopal</title>
<meta name="description" content="Official Academic Calendar of Bhabha University Bhopal — Semester dates, examination schedules, teaching days, holidays, and academic event timelines.">
<meta name="keywords" content="Bhabha University academic calendar, academic schedule bhopal, semester timetable bhabha university, examination dates 2026-27">
<?php include('inc.meta.php');?>

<style>
/* ================================================
   ACADEMIC CALENDAR & SCHEDULE HUB
   Theme: Navy #0A1B54  Gold #FFC107
   Fonts: Playfair Display + Plus Jakarta Sans
   ================================================ */

/* Layout & Containers */
.bu-acad-layout {
  display: grid;
  grid-template-columns: 290px 1fr;
  gap: 36px;
  max-width: 1240px;
  margin: 0 auto;
  padding: 65px 24px 90px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
  align-items: start;
}

/* Sidebar Styling */
.bu-acad-sidebar {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.bu-sidebar-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(6, 29, 124, 0.05);
}
.bu-sidebar-header {
  background: linear-gradient(135deg, #0A1B54, #061D7C);
  color: #FFFFFF;
  padding: 16px 20px;
  font-size: 15px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-sidebar-header i {
  color: #FFC107;
  font-size: 16px;
}
.bu-sidebar-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}
.bu-sidebar-menu li {
  border-bottom: 1px solid #F1F5F9;
}
.bu-sidebar-menu li:last-child {
  border-bottom: none;
}
.bu-sidebar-menu a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 13px 20px;
  color: #334155;
  font-size: 13.5px;
  font-weight: 600;
  text-decoration: none !important;
  transition: all 0.2s ease;
}
.bu-sidebar-menu a i.menu-icon {
  width: 20px;
  color: #0A1B54;
  margin-right: 10px;
  font-size: 14px;
  transition: color 0.2s;
}
.bu-sidebar-menu a:hover,
.bu-sidebar-menu a.active {
  background: #0A1B54;
  color: #FFFFFF;
  padding-left: 24px;
}
.bu-sidebar-menu a:hover i.menu-icon,
.bu-sidebar-menu a.active i.menu-icon,
.bu-sidebar-menu a:hover i.fa-angle-right,
.bu-sidebar-menu a.active i.fa-angle-right {
  color: #FFC107;
}

/* Sidebar CTA Card */
.bu-sidebar-cta {
  background: linear-gradient(145deg, #051235 0%, #0A1B54 100%);
  border: 1px solid rgba(255, 193, 7, 0.3);
  border-radius: 12px;
  padding: 24px 20px;
  color: #FFFFFF;
  text-align: center;
  position: relative;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(10, 27, 84, 0.2);
}
.bu-sidebar-cta::before {
  content: '';
  position: absolute;
  top: -40px; right: -40px;
  width: 100px; height: 100px;
  border-radius: 50%;
  background: rgba(255, 193, 7, 0.08);
}
.bu-sidebar-cta h4 {
  font-size: 16px;
  font-weight: 700;
  color: #FFFFFF;
  margin: 0 0 8px 0;
  font-family: 'Playfair Display', Georgia, serif;
}
.bu-sidebar-cta p {
  font-size: 12.5px;
  color: rgba(255, 255, 255, 0.75);
  line-height: 1.5;
  margin: 0 0 16px 0;
}
.bu-sidebar-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  background: #FFC107;
  color: #0A1B54;
  font-size: 12.5px;
  font-weight: 800;
  padding: 11px 16px;
  border-radius: 6px;
  text-decoration: none !important;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-sidebar-btn:hover {
  background: #E5AC00;
  color: #0A1B54;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(255, 193, 7, 0.3);
}

/* Main Content Area */
.bu-acad-content {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

/* Featured 2026-27 Hero Box */
.bu-featured-calendar-card {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 60%, #061D7C 100%);
  border: 1.5px solid rgba(255, 193, 7, 0.35);
  border-radius: 16px;
  padding: 36px 36px 32px;
  color: #FFFFFF;
  position: relative;
  overflow: hidden;
  box-shadow: 0 16px 40px rgba(6, 29, 124, 0.18);
}
.bu-featured-calendar-card::before {
  content: '';
  position: absolute;
  top: -80px; right: -80px;
  width: 280px; height: 280px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.12) 0%, transparent 70%);
  pointer-events: none;
}
.bu-featured-badge-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 16px;
}
.bu-active-pill {
  background: #10B981;
  color: #FFFFFF;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 4px 14px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
}
.bu-session-indicator {
  color: #FFC107;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
}
.bu-featured-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(24px, 3vw, 32px);
  font-weight: 800;
  color: #FFFFFF;
  line-height: 1.2;
  margin: 0 0 12px 0;
}
.bu-featured-title em {
  font-style: italic;
  color: #FFC107;
}
.bu-featured-desc {
  font-size: 14.5px;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.82);
  margin: 0 0 26px 0;
  max-width: 800px;
}

/* 4 Milestone Pillars */
.bu-milestones-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  margin-bottom: 28px;
}
.bu-milestone-item {
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 10px;
  padding: 16px 14px;
  transition: all 0.25s ease;
}
.bu-milestone-item:hover {
  background: rgba(255, 193, 7, 0.1);
  border-color: #FFC107;
  transform: translateY(-3px);
}
.bu-ms-header {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 6px;
}
.bu-ms-header i {
  color: #FFC107;
  font-size: 13px;
}
.bu-ms-title {
  font-size: 12px;
  font-weight: 800;
  color: #FFFFFF;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-ms-val {
  font-size: 14px;
  font-weight: 700;
  color: #FFC107;
  display: block;
  margin-bottom: 4px;
}
.bu-ms-sub {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.65);
  line-height: 1.4;
  margin: 0;
}

/* Featured Buttons */
.bu-featured-actions {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 14px;
}
.bu-btn-download-primary {
  background: #FFC107;
  color: #0A1B54 !important;
  font-size: 13.5px;
  font-weight: 800;
  padding: 13px 26px;
  border-radius: 8px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: all 0.25s ease;
  box-shadow: 0 6px 20px rgba(255, 193, 7, 0.25);
}
.bu-btn-download-primary:hover {
  background: #E5AC00;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
}
.bu-btn-secondary-link {
  background: rgba(255, 255, 255, 0.1);
  color: #FFFFFF !important;
  font-size: 13px;
  font-weight: 700;
  padding: 12px 22px;
  border-radius: 8px;
  text-decoration: none !important;
  border: 1px solid rgba(255, 255, 255, 0.25);
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.25s ease;
}
.bu-btn-secondary-link:hover {
  background: rgba(255, 255, 255, 0.2);
  border-color: #FFFFFF;
}

/* Archive Cards Section */
.bu-content-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 36px 36px 32px;
  box-shadow: 0 4px 20px rgba(6, 29, 124, 0.04);
}
.bu-content-label {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2px;
  color: #D99B00;
  text-transform: uppercase;
  margin-bottom: 8px;
  display: block;
}
.bu-content-h2 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 26px;
  font-weight: 800;
  color: #061D7C;
  line-height: 1.25;
  margin: 0 0 16px 0;
}
.bu-content-h2 em {
  font-style: italic;
  color: #D99B00;
}
.bu-content-divider {
  width: 50px;
  height: 3px;
  background: #FFC107;
  border-radius: 2px;
  margin-bottom: 24px;
}

/* Archives Grid */
.bu-calendar-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}
.bu-cal-card {
  display: flex !important;
  align-items: center !important;
  gap: 16px !important;
  padding: 18px 20px !important;
  background: #F8FAFC !important;
  border: 1px solid #E2E8F0 !important;
  border-radius: 10px !important;
  border-left: 4px solid #FFC107 !important;
  text-decoration: none !important;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
  box-sizing: border-box !important;
}
.bu-cal-icon-box {
  width: 46px;
  height: 46px;
  border-radius: 8px;
  background: rgba(10, 27, 84, 0.07);
  color: #0A1B54;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
  transition: all 0.25s ease;
}
.bu-cal-info {
  flex: 1;
  min-width: 0;
}
.bu-cal-title-row {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 4px;
  flex-wrap: wrap;
}
.bu-cal-title {
  font-size: 14.5px;
  font-weight: 700;
  color: #0A1B54;
  line-height: 1.35;
  transition: color 0.25s ease;
}
.bu-cal-session-pill {
  font-size: 10.5px;
  font-weight: 800;
  color: #059669;
  background: #ECFDF5;
  border: 1px solid #A7F3D0;
  padding: 2px 8px;
  border-radius: 12px;
  letter-spacing: 0.5px;
}
.bu-cal-sub {
  font-size: 12px;
  color: #64748B;
  display: block;
  line-height: 1.4;
  transition: color 0.25s ease;
}
.bu-cal-arrow {
  font-size: 14px;
  color: #94A3B8;
  flex-shrink: 0;
  transition: all 0.25s ease;
}

/* Hover State */
.bu-cal-card:hover,
.bu-cal-card:focus,
.bu-cal-card:active {
  background: #0A1B54 !important;
  border-color: #0A1B54 !important;
  border-left-color: #FFC107 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 24px rgba(10, 27, 84, 0.22) !important;
}
.bu-cal-card:hover *,
.bu-cal-card:focus *,
.bu-cal-card:active *,
.bu-cal-card:hover .bu-cal-title {
  color: #FFFFFF !important;
}
.bu-cal-card:hover .bu-cal-sub {
  color: #FFC107 !important;
  opacity: 0.9 !important;
}
.bu-cal-card:hover .bu-cal-icon-box {
  background: #FFC107 !important;
  color: #0A1B54 !important;
}
.bu-cal-card:hover .bu-cal-arrow {
  color: #FFC107 !important;
  transform: translateX(4px) !important;
}
.bu-cal-card:hover .bu-cal-session-pill {
  background: #FFC107 !important;
  color: #0A1B54 !important;
  border-color: #FFC107 !important;
}

/* Academic Regulations & Guidelines Grid */
.bu-regulations-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 18px;
  margin-top: 10px;
}
.bu-reg-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 22px 20px;
  transition: all 0.25s ease;
  position: relative;
}
.bu-reg-box:hover {
  background: #FFFFFF;
  border-color: #CBD5E1;
  box-shadow: 0 6px 18px rgba(6, 29, 124, 0.06);
  transform: translateY(-2px);
}
.bu-reg-header {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 10px;
}
.bu-reg-icon {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: rgba(10, 27, 84, 0.08);
  color: #0A1B54;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
}
.bu-reg-header h4 {
  font-size: 15px;
  font-weight: 700;
  color: #061D7C;
  margin: 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.3;
}
.bu-reg-box p {
  font-size: 13px;
  line-height: 1.65;
  color: #4B5563;
  margin: 0;
}

/* Responsive Styles */
@media (max-width: 991px) {
  .bu-acad-layout {
    grid-template-columns: 1fr;
    gap: 30px;
    margin: 0 auto;
    padding: 40px 16px 60px;
  }
  .bu-milestones-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .bu-calendar-grid {
    grid-template-columns: 1fr;
  }
}
@media (max-width: 575px) {
  .bu-featured-calendar-card {
    padding: 24px 20px;
  }
  .bu-content-card {
    padding: 24px 20px;
  }
  .bu-milestones-grid {
    grid-template-columns: 1fr;
  }
  .bu-regulations-grid {
    grid-template-columns: 1fr;
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
  $page_title    = 'Academic <em>Calendar &amp; Schedule</em>';
  $page_subtitle = !empty($db_title) ? htmlspecialchars($db_title) : 'Official schedule for academic sessions, semester timelines, examination schedules, teaching days, and institutional events at Bhabha University.';
  $page_icon     = 'fa-calendar';
  $breadcrumbs   = [
    ['label' => 'Home',      'url' => URL_ROOT],
    ['label' => 'Academics', 'url' => '#'],
    ['label' => 'Academic Calendar', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-acad-layout">

    <!-- LEFT SIDEBAR -->
    <aside class="bu-acad-sidebar">
      
      <!-- Academic Hub Navigation -->
      <div class="bu-sidebar-card">
        <div class="bu-sidebar-header">
          <i class="fa fa-graduation-cap"></i> Academics Hub
        </div>
        <ul class="bu-sidebar-menu">
          <li>
            <a href="<?php echo href('academic.php'); ?>" class="active">
              <span><i class="fa fa-calendar menu-icon"></i> Academic Calendar</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('course.php'); ?>">
              <span><i class="fa fa-book menu-icon"></i> Degree Programs</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('time-table.php'); ?>">
              <span><i class="fa fa-clock-o menu-icon"></i> Examination Time Table</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('scholarship.php'); ?>">
              <span><i class="fa fa-trophy menu-icon"></i> Scholarship Schemes</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('iqac.php'); ?>">
              <span><i class="fa fa-shield menu-icon"></i> IQAC Quality Cell</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('advisory.php'); ?>">
              <span><i class="fa fa-sitemap menu-icon"></i> Cells &amp; Committees</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('approvals.php'); ?>">
              <span><i class="fa fa-certificate menu-icon"></i> Approvals &amp; Accreditations</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('student_corner.php'); ?>">
              <span><i class="fa fa-user-circle menu-icon"></i> Student Portal</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
        </ul>
      </div>

      <!-- Quick Download CTA -->
      <div class="bu-sidebar-cta">
        <h4>Session <?php echo htmlspecialchars($active_session_title); ?></h4>
        <p>Get the complete official calendar with semester breakdown, exam weeks and university holidays.</p>
        <a href="<?php echo $active_download_url; ?>" target="_blank" class="bu-sidebar-btn">
          <i class="fa fa-file-pdf-o"></i> Download Calendar
        </a>
      </div>

      <!-- Academic Office Contacts -->
      <div class="bu-sidebar-card" style="padding:22px 20px;">
        <h4 style="font-size:14.5px;font-weight:700;color:#0A1B54;margin:0 0 12px 0;display:flex;align-items:center;gap:8px;">
          <i class="fa fa-phone" style="color:#D99B00;"></i> Academic Enquiries
        </h4>
        <p style="font-size:12.5px;color:#64748B;line-height:1.6;margin:0 0 12px 0;">
          For queries related to term commencement, syllabus, or examination dates:
        </p>
        <div style="font-size:12.5px;color:#334155;line-height:1.7;">
          <div><strong>Office of Dean Academics:</strong></div>
          <div style="color:#0A1B54;font-weight:600;"><i class="fa fa-envelope-o" style="color:#D99B00;margin-right:5px;"></i> info@bhabhauniversity.edu.in</div>
          <div style="color:#0A1B54;font-weight:600;"><i class="fa fa-phone" style="color:#D99B00;margin-right:5px;"></i> 0755-4246498 / 0755-4903330</div>
        </div>
      </div>

    </aside>

    <!-- RIGHT MAIN CONTENT -->
    <main class="bu-acad-content">

      <!-- 1. FEATURED ACTIVE CALENDAR -->
      <section class="bu-featured-calendar-card">
        <div class="bu-featured-badge-row">
          <span class="bu-active-pill"><i class="fa fa-circle"></i> Active Academic Session</span>
          <span class="bu-session-indicator"><i class="fa fa-check-circle"></i> <?php echo htmlspecialchars($active_session_title); ?> Approved</span>
        </div>
        
        <h2 class="bu-featured-title"><?php echo htmlspecialchars($active_cal['title'] ?? 'Academic & Activities Calendar'); ?></h2>
        <p class="bu-featured-desc">
          Official institutional roadmap approved by the Academic Council. It outlines teaching timelines, internal assessments, semester-end examinations, cultural festivals, sports meets, and statutory university holidays.
        </p>

        <!-- 4 Milestone Breakdown -->
        <div class="bu-milestones-grid">
          <div class="bu-milestone-item">
            <div class="bu-ms-header">
              <i class="fa fa-calendar-check-o"></i>
              <span class="bu-ms-title">Odd Semester</span>
            </div>
            <span class="bu-ms-val">July – Dec</span>
            <p class="bu-ms-sub">Commencement of classes &amp; orientation</p>
          </div>

          <div class="bu-milestone-item">
            <div class="bu-ms-header">
              <i class="fa fa-pencil-square-o"></i>
              <span class="bu-ms-title">Mid-Term (CIE)</span>
            </div>
            <span class="bu-ms-val">Sept &amp; Oct</span>
            <p class="bu-ms-sub">Continuous Internal Evaluation tests</p>
          </div>

          <div class="bu-milestone-item">
            <div class="bu-ms-header">
              <i class="fa fa-refresh"></i>
              <span class="bu-ms-title">Even Semester</span>
            </div>
            <span class="bu-ms-val">Jan – June</span>
            <p class="bu-ms-sub">Spring semester teaching &amp; labs</p>
          </div>

          <div class="bu-milestone-item">
            <div class="bu-ms-header">
              <i class="fa fa-graduation-cap"></i>
              <span class="bu-ms-title">University Exams</span>
            </div>
            <span class="bu-ms-val">Nov-Dec &amp; May-Jun</span>
            <p class="bu-ms-sub">Theory &amp; Practical evaluations</p>
          </div>
        </div>

        <!-- Download & Action Buttons -->
        <div class="bu-featured-actions">
          <a href="<?php echo $active_download_url; ?>" target="_blank" class="bu-btn-download-primary">
            <i class="fa fa-file-pdf-o" style="font-size:16px;"></i> Download Official Calendar (PDF)
          </a>
          <a href="#archives" class="bu-btn-secondary-link">
            <i class="fa fa-history"></i> Browse Previous Calendars
          </a>
        </div>
      </section>

      <!-- 2. ARCHIVE OF CALENDARS -->
      <section class="bu-content-card" id="archives">
        <span class="bu-content-label">Official Document Repository</span>
        <h2 class="bu-content-h2">Academic Calendars &amp; <em>Annual Schedules</em></h2>
        <div class="bu-content-divider"></div>
        <p style="font-size:14px;color:#64748B;line-height:1.7;margin:0 0 24px 0;">
          Access and download verified academic schedules for current and past academic sessions:
        </p>

        <div class="bu-calendar-grid">
          <?php foreach($dynamic_calendars as $cal): ?>
          <a href="<?php echo $cal['url']; ?>" target="_blank" class="bu-cal-card">
            <div class="bu-cal-icon-box">
              <i class="fa <?php echo !empty($cal['is_img']) ? 'fa-file-image-o' : 'fa-file-pdf-o'; ?>"></i>
            </div>
            <div class="bu-cal-info">
              <div class="bu-cal-title-row">
                <span class="bu-cal-title"><?php echo htmlspecialchars($cal['title']); ?></span>
                <?php if(!empty($cal['is_current'])): ?>
                  <span class="bu-cal-session-pill" style="background:#ECFDF5;color:#059669;border-color:#A7F3D0;">Latest</span>
                <?php endif; ?>
              </div>
              <span class="bu-cal-sub"><?php echo htmlspecialchars($cal['desc']); ?></span>
            </div>
            <i class="fa fa-external-link bu-cal-arrow"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 3. ACADEMIC REGULATIONS & GUIDELINES -->
      <section class="bu-content-card">
        <span class="bu-content-label">Academic Governance &amp; Standards</span>
        <h2 class="bu-content-h2">Key Academic <em>Regulations</em></h2>
        <div class="bu-content-divider"></div>
        <p style="font-size:14px;color:#64748B;line-height:1.7;margin:0 0 20px 0;">
          All enrolled students and teaching faculty are required to adhere to statutory university norms and UGC/AICTE guidelines:
        </p>

        <div class="bu-regulations-grid">
          <div class="bu-reg-box">
            <div class="bu-reg-header">
              <div class="bu-reg-icon"><i class="fa fa-check-square-o"></i></div>
              <h4>75% Minimum Attendance</h4>
            </div>
            <p>
              Students must maintain a minimum of 75% attendance in theory lectures and practical laboratories across all courses to qualify for end-semester university examinations.
            </p>
          </div>

          <div class="bu-reg-box">
            <div class="bu-reg-header">
              <div class="bu-reg-icon"><i class="fa fa-calendar-o"></i></div>
              <h4>90 Instructional Days / Sem</h4>
            </div>
            <p>
              Every semester guarantees at least 90 days of actual classroom teaching, project work, and lab sessions (amounting to 180+ instructional days per academic year).
            </p>
          </div>

          <div class="bu-reg-box">
            <div class="bu-reg-header">
              <div class="bu-reg-icon"><i class="fa fa-line-chart"></i></div>
              <h4>Continuous Evaluation (CIE)</h4>
            </div>
            <p>
              Continuous Internal Evaluation carries comprehensive weightage comprising mid-semester sessional exams, case study presentations, quizzes, and laboratory performance.
            </p>
          </div>

          <div class="bu-reg-box">
            <div class="bu-reg-header">
              <div class="bu-reg-icon"><i class="fa fa-balance-scale"></i></div>
              <h4>Examination &amp; Re-Evaluation</h4>
            </div>
            <p>
              Transparent evaluation system with timely publishing of results, option for answer book viewing, re-totalling, and academic grievance resolution under the Controller of Examinations.
            </p>
          </div>
        </div>
      </section>

    </main>

  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
