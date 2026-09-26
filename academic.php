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

/* ================================================================
   BHABHA UNIVERSITY — LUXURY SPOTLIGHT CARDS & ACADEMIC HUB
   Theme: Navy #061D7C, Royal Gold #FFC107, Soft White #F8FAFC
   ================================================================ */

:root {
  --bu-lead-navy: #061D7C;
  --bu-lead-navy-dark: #040F4A;
  --bu-lead-gold: #FFC107;
  --bu-lead-gold-dark: #D99B00;
  --bu-lead-border: #E2E8F0;
}

/* Main Content Area */
.bu-acad-content {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

/* ================================================================
   SPOTLIGHT CARDS (EXACT LUXURY SYSTEM)
   ================================================================ */
.bu-chancellor-spotlight {
  background: linear-gradient(135deg, #FFFFFF 0%, #FAF9F6 100%);
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  box-shadow: 0 10px 30px rgba(6, 29, 124, 0.07);
  padding: 26px 30px;
  margin-bottom: 24px;
  position: relative;
  overflow: hidden;
  border-left: 5px solid var(--bu-lead-gold-dark);
}

.bu-chancellor-grid {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 32px;
  align-items: flex-start;
}

.bu-chancellor-left-col {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.bu-chancellor-portrait-wrap {
  position: relative;
  width: 280px;
  max-width: 100%;
  height: auto;
  aspect-ratio: 1 / 1.08;
  border-radius: 16px;
  overflow: hidden;
  border: 4px solid #ffffff;
  box-shadow: 0 12px 32px rgba(6, 29, 124, 0.16), 0 0 0 2.5px var(--bu-lead-gold);
  background: #ffffff;
  margin-bottom: 14px;
}

.bu-chancellor-portrait-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center top;
  display: block;
  transition: transform 0.4s ease;
}

.bu-chancellor-portrait-wrap:hover img {
  transform: scale(1.05);
}

.bu-chancellor-oxford-pill {
  background: #FFFBEB;
  border: 1px solid rgba(217, 155, 0, 0.35);
  color: #854D0E;
  font-size: 10.5px;
  font-weight: 700;
  padding: 5px 10px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  line-height: 1.25;
  text-align: center;
}

.bu-chancellor-oxford-pill i {
  color: #D97706;
}

.bu-chancellor-right-col {
  display: flex;
  flex-direction: column;
}

.bu-chancellor-desk-label {
  font-size: 11px;
  font-weight: 800;
  color: var(--bu-lead-gold-dark);
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 4px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.bu-chancellor-right-col h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 2px 0;
  line-height: 1.2;
}

.bu-chancellor-desig-sub {
  font-size: 13px;
  font-weight: 700;
  color: var(--bu-lead-navy);
  margin-bottom: 12px;
}

.bu-chancellor-quote-box {
  background: #F8FAFC;
  border-left: 4px solid var(--bu-lead-navy);
  border-radius: 8px;
  padding: 12px 16px;
  margin-bottom: 14px;
  position: relative;
}

.bu-chancellor-quote-box p {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 14px;
  font-style: italic;
  font-weight: 600;
  color: var(--bu-lead-navy-dark);
  line-height: 1.55;
  margin: 0;
}

.bu-chancellor-quote-box i {
  color: var(--bu-lead-gold-dark);
  font-size: 14px;
  margin-right: 5px;
}

.bu-chancellor-body-text {
  font-size: 13.5px;
  line-height: 1.7;
  color: #334155;
  margin-bottom: 14px;
}

.bu-chancellor-body-text p {
  margin-bottom: 8px;
}

.bu-chancellor-body-text p:last-child {
  margin-bottom: 0;
}

.bu-chancellor-chips-row {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 4px;
}

.bu-focus-chip {
  background: #ffffff;
  border: 1px solid #CBD5E1;
  border-radius: 20px;
  padding: 4px 11px;
  font-size: 11px;
  font-weight: 700;
  color: #1E293B;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
}

.bu-focus-chip i {
  color: #10B981;
  font-size: 10px;
}

/* Section Headings */
.bu-lead-sec-heading {
  margin: 28px 0 16px 0;
}

.bu-lead-sec-heading .bu-sec-label {
  font-size: 10.5px;
  font-weight: 800;
  color: var(--bu-lead-gold-dark);
  text-transform: uppercase;
  letter-spacing: 1.5px;
  display: block;
  margin-bottom: 2px;
}

.bu-lead-sec-heading h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 22px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 6px 0;
}

.bu-lead-sec-divider {
  width: 36px;
  height: 3px;
  background: var(--bu-lead-gold);
  border-radius: 2px;
}

/* Archive Cards Section */
.bu-content-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 28px 30px;
  box-shadow: 0 4px 20px rgba(6, 29, 124, 0.04);
}

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
  border-left: 4px solid var(--bu-lead-gold) !important;
  text-decoration: none !important;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
  box-sizing: border-box !important;
}

.bu-cal-icon-box {
  width: 46px;
  height: 46px;
  border-radius: 8px;
  background: rgba(6, 29, 124, 0.08);
  color: var(--bu-lead-navy);
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
  font-size: 14px;
  font-weight: 700;
  color: var(--bu-lead-navy-dark);
  line-height: 1.35;
  transition: color 0.25s ease;
}

.bu-cal-session-pill {
  font-size: 10px;
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

.bu-cal-card:hover {
  background: var(--bu-lead-navy-dark) !important;
  border-color: var(--bu-lead-navy-dark) !important;
  border-left-color: var(--bu-lead-gold) !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 24px rgba(6, 29, 124, 0.18) !important;
}

.bu-cal-card:hover * {
  color: #FFFFFF !important;
}

.bu-cal-card:hover .bu-cal-sub {
  color: var(--bu-lead-gold) !important;
  opacity: 0.9 !important;
}

.bu-cal-card:hover .bu-cal-icon-box {
  background: var(--bu-lead-gold) !important;
  color: var(--bu-lead-navy-dark) !important;
}

.bu-cal-card:hover .bu-cal-arrow {
  color: var(--bu-lead-gold) !important;
  transform: translateX(4px) !important;
}

.bu-cal-card:hover .bu-cal-session-pill {
  background: var(--bu-lead-gold) !important;
  color: var(--bu-lead-navy-dark) !important;
  border-color: var(--bu-lead-gold) !important;
}

/* Responsive */
@media (max-width: 991px) {
  .bu-acad-layout {
    grid-template-columns: 1fr;
    gap: 30px;
    padding: 30px 16px 50px;
  }
  .bu-chancellor-grid {
    grid-template-columns: 1fr;
    gap: 22px;
  }
  .bu-chancellor-portrait-wrap {
    width: 280px;
    max-width: 90%;
    margin: 0 auto 16px auto;
  }
  .bu-calendar-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .bu-acad-layout {
    padding: 10px 8px 40px;
  }
  .bu-chancellor-spotlight {
    padding: 20px 16px;
    margin-bottom: 18px;
  }
  .bu-chancellor-portrait-wrap {
    width: 260px;
    max-width: 100%;
    margin: 0 auto 14px auto;
  }
  .bu-chancellor-right-col h3 {
    font-size: 22px;
  }
  .bu-content-card {
    padding: 20px 16px;
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

      <!-- 1. FEATURED ACTIVE CALENDAR (SPOTLIGHT CARD) -->
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <!-- Left Column: Calendar Visual Badge & Council Pill -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap" style="background: linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:20px; text-align:center; color:#ffffff;">
              <div style="position:absolute; width:140px; height:140px; border-radius:50%; background:radial-gradient(circle, rgba(255,193,7,0.18) 0%, transparent 70%); top:-30px; right:-30px;"></div>
              <div style="width:58px; height:58px; border-radius:12px; background:rgba(255,193,7,0.18); border:1.5px solid #FFC107; display:flex; align-items:center; justify-content:center; color:#FFC107; font-size:26px; margin-bottom:12px; box-shadow:0 6px 18px rgba(0,0,0,0.25);">
                <i class="fa fa-calendar-check-o"></i>
              </div>
              <span style="font-size:11px; font-weight:800; color:#FFC107; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:4px;">Academic Session</span>
              <h4 style="font-family:'Playfair Display', Georgia, serif; font-size:24px; font-weight:800; color:#FFFFFF; margin:0 0 6px 0; line-height:1.15;"><?php echo htmlspecialchars($active_session_title); ?></h4>
              <span style="display:inline-block; background:rgba(16,185,129,0.2); border:1px solid #10B981; color:#34D399; font-size:10px; font-weight:800; padding:2px 10px; border-radius:12px; text-transform:uppercase; letter-spacing:0.8px;">Active &amp; Approved</span>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Academic Council Approved • Session <?php echo htmlspecialchars($active_session_title); ?>
            </div>
          </div>

          <!-- Right Column: Schedule Details & Download -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-calendar-check-o"></i> Official Academic Schedule</span>
            <h3><?php echo htmlspecialchars($active_cal['title'] ?? 'Academic & Activities Calendar'); ?></h3>
            <span class="bu-chancellor-desig-sub">Bhabha University Apex Governing Body &amp; Examination Directorate</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “The academic calendar sets the university's statutory timeline for comprehensive syllabus coverage, continuous internal evaluations, laboratory research, and co-curricular milestones.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>Official institutional roadmap approved by the Academic Council. It meticulously orchestrates teaching timelines, internal assessments (CIE), semester-end university examinations, cultural festivals, national hackathons, sports meets, and statutory university holidays across all undergraduate, postgraduate, and diploma faculties.</p>
            </div>

            <!-- Milestone Chips -->
            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-calendar-check-o" style="color:#061D7C;"></i> Odd Sem: July – Dec</span>
              <span class="bu-focus-chip"><i class="fa fa-pencil-square-o" style="color:#061D7C;"></i> Mid-Term CIE: Sept &amp; Oct</span>
              <span class="bu-focus-chip"><i class="fa fa-refresh" style="color:#061D7C;"></i> Even Sem: Jan – June</span>
              <span class="bu-focus-chip"><i class="fa fa-graduation-cap" style="color:#061D7C;"></i> Semester Exams: Nov-Dec &amp; May-Jun</span>
            </div>

            <!-- Action CTAs -->
            <div style="margin-top: 18px; display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
              <a href="<?php echo $active_download_url; ?>" target="_blank" style="background:#FFC107; color:#040F4A !important; font-weight:800; font-size:13px; padding:11px 24px; border-radius:8px; display:inline-flex; align-items:center; gap:8px; text-decoration:none !important; box-shadow:0 4px 14px rgba(255,193,7,0.35); transition:all 0.25s ease;">
                <i class="fa fa-file-pdf-o"></i> Download Official Calendar (PDF)
              </a>
              <a href="#archives" style="background:#F8FAFC; color:#061D7C !important; font-weight:700; font-size:12.5px; padding:10px 18px; border-radius:8px; display:inline-flex; align-items:center; gap:6px; text-decoration:none !important; border:1px solid #CBD5E1; transition:all 0.25s ease;">
                <i class="fa fa-history"></i> Browse Previous Calendars
              </a>
            </div>
          </div>

        </div>
      </div>

      <!-- 2. ARCHIVE OF CALENDARS -->
      <section class="bu-content-card" id="archives">
        <span class="bu-sec-label" style="font-size:10.5px;font-weight:800;color:var(--bu-lead-gold-dark);text-transform:uppercase;letter-spacing:1.5px;display:block;margin-bottom:2px;">Official Document Repository</span>
        <h3 style="font-family:'Playfair Display', Georgia, serif;font-size:22px;font-weight:800;color:var(--bu-lead-navy-dark);margin:0 0 6px 0;">Academic Calendars &amp; <em>Annual Schedules</em></h3>
        <div class="bu-lead-sec-divider" style="margin-bottom:18px;"></div>
        <p style="font-size:13.5px;color:#64748B;line-height:1.7;margin:0 0 20px 0;">
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
                  <span class="bu-cal-session-pill">Latest</span>
                <?php endif; ?>
              </div>
              <span class="bu-cal-sub"><?php echo htmlspecialchars($cal['desc']); ?></span>
            </div>
            <i class="fa fa-external-link bu-cal-arrow"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 3. KEY ACADEMIC REGULATIONS (4 SPOTLIGHT CARDS) -->
      <div class="bu-lead-sec-heading">
        <span class="bu-sec-label">Academic Governance &amp; Standards</span>
        <h3>Key Academic Regulations &amp; Policy Norms</h3>
        <div class="bu-lead-sec-divider"></div>
      </div>

      <!-- Regulation Card 1: 75% Attendance -->
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap" style="background: linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:20px; text-align:center; color:#ffffff;">
              <div style="position:absolute; width:140px; height:140px; border-radius:50%; background:radial-gradient(circle, rgba(255,193,7,0.18) 0%, transparent 70%); top:-30px; right:-30px;"></div>
              <div style="width:58px; height:58px; border-radius:12px; background:rgba(255,193,7,0.18); border:1.5px solid #FFC107; display:flex; align-items:center; justify-content:center; color:#FFC107; font-size:26px; margin-bottom:12px; box-shadow:0 6px 18px rgba(0,0,0,0.25);">
                <i class="fa fa-check-square-o"></i>
              </div>
              <span style="font-size:11px; font-weight:800; color:#FFC107; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:4px;">Mandatory Norm</span>
              <h4 style="font-family:'Playfair Display', Georgia, serif; font-size:26px; font-weight:800; color:#FFFFFF; margin:0 0 4px 0; line-height:1.15;">75% Attendance</h4>
              <span style="display:inline-block; background:rgba(16,185,129,0.2); border:1px solid #10B981; color:#34D399; font-size:10px; font-weight:800; padding:2px 10px; border-radius:12px; text-transform:uppercase; letter-spacing:0.8px;">Exam Eligibility</span>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Statutory UGC &amp; AICTE Requirement
            </div>
          </div>

          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-shield"></i> Statutory Regulation 01</span>
            <h3>75% Mandatory Attendance Standard</h3>
            <span class="bu-chancellor-desig-sub">Directorate of Academic Affairs &amp; Examination Eligibility</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Regularity in classroom lectures and laboratory participation is fundamental to conceptual mastery and institutional discipline.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>Students are required to maintain a minimum of 75% cumulative attendance in theory lectures, practical laboratories, and tutorial sessions across all enrolled courses. Attendance is tracked in real-time via the university's biometric and ERP systems. Falling below this statutory threshold disqualifies candidates from appearing in end-semester examinations, subject to standard medical leave regulations.</p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Theory Lectures &ge; 75%</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Practical Labs &ge; 75%</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Medical Exemption Policy</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Real-Time ERP Attendance Tracking</span>
            </div>
          </div>

        </div>
      </div>

      <!-- Regulation Card 2: 90 Instructional Days -->
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap" style="background: linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:20px; text-align:center; color:#ffffff;">
              <div style="position:absolute; width:140px; height:140px; border-radius:50%; background:radial-gradient(circle, rgba(255,193,7,0.18) 0%, transparent 70%); top:-30px; right:-30px;"></div>
              <div style="width:58px; height:58px; border-radius:12px; background:rgba(255,193,7,0.18); border:1.5px solid #FFC107; display:flex; align-items:center; justify-content:center; color:#FFC107; font-size:26px; margin-bottom:12px; box-shadow:0 6px 18px rgba(0,0,0,0.25);">
                <i class="fa fa-calendar-o"></i>
              </div>
              <span style="font-size:11px; font-weight:800; color:#FFC107; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:4px;">Academic Council Norm</span>
              <h4 style="font-family:'Playfair Display', Georgia, serif; font-size:26px; font-weight:800; color:#FFFFFF; margin:0 0 4px 0; line-height:1.15;">90 Days / Sem</h4>
              <span style="display:inline-block; background:rgba(16,185,129,0.2); border:1px solid #10B981; color:#34D399; font-size:10px; font-weight:800; padding:2px 10px; border-radius:12px; text-transform:uppercase; letter-spacing:0.8px;">180+ Days / Year</span>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Academic Council Pedagogical Standard
            </div>
          </div>

          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-book"></i> Statutory Regulation 02</span>
            <h3>180+ Annual Instructional Teaching Days</h3>
            <span class="bu-chancellor-desig-sub">Curricular Delivery Framework &amp; Academic Scheduling</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Uncompromising instructional rigor guarantees thorough syllabus delivery, advanced research mentorship, and project incubation.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>Every academic semester guarantees a minimum of 90 actual working days dedicated strictly to classroom lectures, laboratory practicals, industrial internships, seminars, and capstone project guidance (amounting to 180+ instructional days per year). Compensatory classes and workshops are organized whenever institutional schedules encounter unforeseen closures.</p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> 90 Teaching Days / Semester</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> 180+ Annual Academic Days</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Capstone Project Mentorship</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Remedial &amp; Tutorial Hours</span>
            </div>
          </div>

        </div>
      </div>

      <!-- Regulation Card 3: Continuous Internal Evaluation (CIE) -->
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap" style="background: linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:20px; text-align:center; color:#ffffff;">
              <div style="position:absolute; width:140px; height:140px; border-radius:50%; background:radial-gradient(circle, rgba(255,193,7,0.18) 0%, transparent 70%); top:-30px; right:-30px;"></div>
              <div style="width:58px; height:58px; border-radius:12px; background:rgba(255,193,7,0.18); border:1.5px solid #FFC107; display:flex; align-items:center; justify-content:center; color:#FFC107; font-size:26px; margin-bottom:12px; box-shadow:0 6px 18px rgba(0,0,0,0.25);">
                <i class="fa fa-line-chart"></i>
              </div>
              <span style="font-size:11px; font-weight:800; color:#FFC107; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:4px;">Evaluation Norm</span>
              <h4 style="font-family:'Playfair Display', Georgia, serif; font-size:26px; font-weight:800; color:#FFFFFF; margin:0 0 4px 0; line-height:1.15;">CIE System</h4>
              <span style="display:inline-block; background:rgba(16,185,129,0.2); border:1px solid #10B981; color:#34D399; font-size:10px; font-weight:800; padding:2px 10px; border-radius:12px; text-transform:uppercase; letter-spacing:0.8px;">Outcome-Based</span>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Outcome-Based Continuous Assessment
            </div>
          </div>

          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-pencil-square-o"></i> Statutory Regulation 03</span>
            <h3>Continuous Internal Evaluation (CIE) Framework</h3>
            <span class="bu-chancellor-desig-sub">Comprehensive Student Progress &amp; Assessment Architecture</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Holistic internal evaluations measure regular academic progress, practical problem solving, and analytical acumen throughout the semester.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>The university follows a multi-tier Continuous Internal Evaluation (CIE) system comprising mid-semester sessional examinations, case-study presentations, technical quizzes, viva-voce assessments, and practical laboratory performance records. Internal scores are displayed transparently to students prior to the commencement of end-semester university examinations.</p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Mid-Semester Sessional Tests</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Technical Presentations &amp; Seminars</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Lab Practical Vivas &amp; Records</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Continuous Quizzes &amp; Assignments</span>
            </div>
          </div>

        </div>
      </div>

      <!-- Regulation Card 4: Fair Examination & Grievance Resolution -->
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap" style="background: linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:20px; text-align:center; color:#ffffff;">
              <div style="position:absolute; width:140px; height:140px; border-radius:50%; background:radial-gradient(circle, rgba(255,193,7,0.18) 0%, transparent 70%); top:-30px; right:-30px;"></div>
              <div style="width:58px; height:58px; border-radius:12px; background:rgba(255,193,7,0.18); border:1.5px solid #FFC107; display:flex; align-items:center; justify-content:center; color:#FFC107; font-size:26px; margin-bottom:12px; box-shadow:0 6px 18px rgba(0,0,0,0.25);">
                <i class="fa fa-balance-scale"></i>
              </div>
              <span style="font-size:11px; font-weight:800; color:#FFC107; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:4px;">Statutory Right</span>
              <h4 style="font-family:'Playfair Display', Georgia, serif; font-size:26px; font-weight:800; color:#FFFFFF; margin:0 0 4px 0; line-height:1.15;">Fair Exams</h4>
              <span style="display:inline-block; background:rgba(16,185,129,0.2); border:1px solid #10B981; color:#34D399; font-size:10px; font-weight:800; padding:2px 10px; border-radius:12px; text-transform:uppercase; letter-spacing:0.8px;">Transparent Redressal</span>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Transparent Merit &amp; Grievance Governance
            </div>
          </div>

          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-check-circle"></i> Statutory Regulation 04</span>
            <h3>Examination Integrity &amp; Transparent Grievance Policy</h3>
            <span class="bu-chancellor-desig-sub">Office of the Controller of Examinations (COE)</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Uncompromising evaluation integrity with full statutory provision for answer-script inspection, re-totalling, and swift grievance redressal.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>Examinations are administered with strict adherence to security protocols, utilizing barcoded answer scripts and centralized digital evaluation cells. Students have statutory rights to request answer-sheet viewing, certified copies, and re-totalling within 15 days of result declarations under the Examination Grievance Redressal Committee.</p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Barcoded Answer Scripts</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Centralized Evaluation Cell</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Transparent Re-totalling Rights</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Swift Academic Grievance Cell</span>
            </div>
          </div>

        </div>
      </div>

    </main>

  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
