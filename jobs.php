<?php 
include('config.php');
$jobs = $db->orderBy('id', 'DESC')->get('jobs');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Current Job Openings &amp; Faculty Recruitment - Bhabha University Bhopal</title>
<meta name="description" content="Explore current job openings, faculty recruitments (Professors, Associate Professors, Assistant Professors), staff vacancies, and walk-in interview schedules at Bhabha University Bhopal.">
<meta name="keywords" content="Bhabha University jobs, faculty recruitment bhopal, teaching vacancies bhabha university, assistant professor jobs bhopal, university jobs mp">
<?php include('inc.meta.php');?>

<style>
/* ================================================
   CURRENT JOB OPENINGS & RECRUITMENT HUB
   Theme: Navy #0A1B54  Gold #FFC107
   Fonts: Plus Jakarta Sans + Playfair Display
   ================================================ */

/* Layout Grid */
.bu-jobs-layout {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 36px;
  max-width: 1240px;
  margin: 0 auto;
  padding: 65px 24px 90px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
  align-items: start;
}

/* Sidebar */
.bu-jobs-sidebar {
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

/* Sidebar HR CTA Card */
.bu-hr-card {
  background: linear-gradient(135deg, #0A1B54 0%, #061442 100%) !important;
  border-radius: 12px;
  padding: 24px 20px;
  color: #ffffff !important;
  box-shadow: 0 6px 20px rgba(10, 27, 84, 0.2);
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.08);
}
.bu-hr-card::after {
  content: '\f0b1';
  font-family: 'FontAwesome';
  position: absolute;
  right: -15px;
  bottom: -20px;
  font-size: 110px;
  color: rgba(255, 255, 255, 0.04);
  pointer-events: none;
}
.bu-hr-card h4 {
  color: #FFFFFF !important;
  font-size: 17px;
  font-weight: 800;
  margin: 0 0 10px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-hr-card h4 i {
  color: #FFC107 !important;
}
.bu-hr-card p {
  font-size: 13px;
  color: #E2E8F0 !important;
  line-height: 1.6;
  margin: 0 0 16px 0;
}
.bu-hr-contact-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 18px;
  position: relative;
  z-index: 2;
}
.bu-hr-contact-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 12.5px;
  color: #FFFFFF !important;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  padding: 8px 12px;
  border-radius: 8px;
  text-decoration: none !important;
  transition: all 0.2s ease;
}
.bu-hr-contact-item:hover {
  background: rgba(255, 255, 255, 0.16);
  color: #FFC107 !important;
}
.bu-hr-contact-item i {
  color: #FFC107 !important;
  font-size: 14px;
  flex-shrink: 0;
}
.bu-hr-contact-item span,
.bu-hr-contact-item strong {
  color: #FFFFFF !important;
  font-weight: 600;
  word-break: break-all;
  line-height: 1.4;
}
.bu-hr-contact-item:hover span,
.bu-hr-contact-item:hover strong {
  color: #FFC107 !important;
}
.bu-hr-btn {
  background: #FFC107 !important;
  color: #0A1B54 !important;
  font-weight: 800;
  font-size: 13.5px;
  padding: 12px 18px;
  border-radius: 8px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  text-decoration: none !important;
  width: 100%;
  transition: all 0.2s ease;
  box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
  position: relative;
  z-index: 2;
}
.bu-hr-btn:hover {
  background: #E5A900 !important;
  color: #0A1B54 !important;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(255, 193, 7, 0.4);
}

/* Main Content Area */
.bu-jobs-content {
  display: flex;
  flex-direction: column;
  gap: 28px;
}

/* Highlight Banner Card */
.bu-highlight-banner {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-left: 5px solid #0A1B54;
  border-radius: 12px;
  padding: 24px 28px;
  box-shadow: 0 4px 20px rgba(10, 27, 84, 0.04);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
}
.bu-highlight-info h3 {
  font-size: 20px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 5px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-highlight-info p {
  font-size: 13.5px;
  color: #64748B;
  margin: 0;
}
.bu-count-badge {
  background: rgba(10, 27, 84, 0.07);
  color: #0A1B54;
  font-size: 13px;
  font-weight: 800;
  padding: 7px 16px;
  border-radius: 20px;
  border: 1px solid rgba(10, 27, 84, 0.15);
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.bu-count-badge strong {
  color: #D99B00;
  font-size: 15px;
}

/* Job Cards Container */
.bu-jobs-list {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.bu-job-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 26px;
  box-shadow: 0 4px 15px rgba(10, 27, 84, 0.03);
  transition: all 0.25s ease;
  display: flex;
  flex-direction: column;
  gap: 14px;
  position: relative;
}
.bu-job-card:hover {
  border-color: #CBD5E1;
  box-shadow: 0 8px 25px rgba(10, 27, 84, 0.08);
  transform: translateY(-2px);
}

.bu-job-top-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
}
.bu-job-pill {
  background: #EFF6FF;
  color: #1E40AF;
  border: 1px solid #BFDBFE;
  font-size: 11.5px;
  font-weight: 800;
  padding: 3px 10px;
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.bu-job-date {
  font-size: 12px;
  color: #64748B;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.bu-job-title {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  line-height: 1.45;
  margin: 0;
}
.bu-job-desc {
  font-size: 13.5px;
  color: #475569;
  line-height: 1.65;
  margin: 0;
}

/* Job Action Buttons */
.bu-job-actions {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
  padding-top: 10px;
  border-top: 1px solid #F1F5F9;
}
.bu-btn-view-doc {
  background: #0A1B54;
  color: #FFFFFF !important;
  font-weight: 700;
  font-size: 13px;
  padding: 9px 18px;
  border-radius: 8px;
  display: inline-flex;
  align-items: center;
  gap: 7px;
  text-decoration: none !important;
  transition: all 0.2s ease;
}
.bu-btn-view-doc:hover {
  background: #061442;
  color: #FFC107 !important;
  transform: translateY(-1px);
}
.bu-btn-apply-email {
  background: #F8FAFC;
  color: #0A1B54 !important;
  border: 1px solid #CBD5E1;
  font-weight: 700;
  font-size: 13px;
  padding: 9px 18px;
  border-radius: 8px;
  display: inline-flex;
  align-items: center;
  gap: 7px;
  text-decoration: none !important;
  transition: all 0.2s ease;
}
.bu-btn-apply-email:hover {
  background: #EFF6FF;
  border-color: #93C5FD;
  color: #1D4ED8 !important;
}

/* Recruitment Guidelines Card */
.bu-guidelines-card {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 26px 28px;
}
.bu-guide-title {
  font-size: 16px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 16px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-steps-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}
.bu-step-box {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 18px;
}
.bu-step-num {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #0A1B54;
  color: #FFC107;
  font-size: 12px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 10px;
}
.bu-step-box h5 {
  font-size: 14px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 6px 0;
}
.bu-step-box p {
  font-size: 12.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}

/* Responsive */
@media (max-width: 991px) {
  .bu-jobs-layout {
    grid-template-columns: 1fr;
    gap: 30px;
    padding: 40px 16px 60px;
  }
  .bu-steps-grid {
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
  $page_title    = 'Current <em>Job Openings &amp; Recruitment</em>';
  $page_subtitle = 'Official notices for faculty appointments (Professors, Associate &amp; Assistant Professors), healthcare specialists, administrative staff, and walk-in interviews at Bhabha University.';
  $page_icon     = 'fa-briefcase';
  $breadcrumbs   = [
    ['label' => 'Home',      'url' => URL_ROOT],
    ['label' => 'Careers',   'url' => href('career.php')],
    ['label' => 'Job Openings', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-jobs-layout">

    <!-- LEFT SIDEBAR -->
    <aside class="bu-jobs-sidebar">
      
      <!-- Navigation Menu -->
      <div class="bu-sidebar-card">
        <div class="bu-sidebar-header">
          <i class="fa fa-briefcase"></i> Careers &amp; HR Hub
        </div>
        <ul class="bu-sidebar-menu">
          <li>
            <a href="<?php echo href('jobs.php'); ?>" class="active">
              <span><i class="fa fa-bullhorn menu-icon"></i> Current Job Openings</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('career.php'); ?>">
              <span><i class="fa fa-users menu-icon"></i> Work With Us</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('faculties.php'); ?>">
              <span><i class="fa fa-user-circle menu-icon"></i> Faculty &amp; Staff Details</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('alumni.php'); ?>">
              <span><i class="fa fa-graduation-cap menu-icon"></i> Alumni Portal</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
          <li>
            <a href="<?php echo href('contact.php'); ?>">
              <span><i class="fa fa-envelope menu-icon"></i> Contact University</span>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
        </ul>
      </div>

      <!-- HR Helpdesk Card -->
      <div class="bu-hr-card">
        <h4><i class="fa fa-id-card"></i> HR Recruitment Cell</h4>
        <p>
          Send your detailed curriculum vitae along with academic publications and experience credentials directly to our HR department.
        </p>
        <div class="bu-hr-contact-list">
          <a href="mailto:hr@bhabhauniversity.edu.in" class="bu-hr-contact-item">
            <i class="fa fa-envelope"></i>
            <span>hr@bhabhauniversity.edu.in</span>
          </a>
          <a href="tel:07554246498" class="bu-hr-contact-item">
            <i class="fa fa-phone"></i>
            <span>0755-4246498 / 4903330</span>
          </a>
        </div>
        <a href="mailto:hr@bhabhauniversity.edu.in?subject=Application%20for%20Faculty%20/%20Staff%20Position" class="bu-hr-btn">
          <i class="fa fa-paper-plane"></i> Email Resume to HR
        </a>
      </div>

      <!-- Quick Info Box -->
      <div class="bu-sidebar-card" style="padding:22px 20px;">
        <h4 style="font-size:14.5px;font-weight:700;color:#0A1B54;margin:0 0 10px 0;display:flex;align-items:center;gap:8px;">
          <i class="fa fa-university" style="color:#D99B00;"></i> University Campus
        </h4>
        <p style="font-size:12.5px;color:#64748B;line-height:1.6;margin:0;">
          <strong>Bhabha University Campus</strong><br>
          Jatkhedi, NH-12, Narmadapuram Road,<br>
          Bhopal, Madhya Pradesh Pin-462047
        </p>
      </div>

    </aside>

    <!-- RIGHT MAIN CONTENT -->
    <main class="bu-jobs-content">

      <!-- Top Highlight Banner -->
      <div class="bu-highlight-banner">
        <div class="bu-highlight-info">
          <h3><i class="fa fa-bullhorn" style="color:#D99B00;"></i> Faculty &amp; Staff Recruitment Portal</h3>
          <p>Explore official employment notices and walk-in interviews across all 11 constituent colleges of Bhabha University.</p>
        </div>
        <div class="bu-count-badge">
          <i class="fa fa-check-circle" style="color:#059669;"></i>
          Active Openings: <strong><?php echo is_array($jobs) ? count($jobs) : 0; ?></strong>
        </div>
      </div>

      <!-- Job Openings Cards List -->
      <div class="bu-jobs-list">
        <?php
        if (is_array($jobs) && count($jobs) > 0) {
            foreach ($jobs as $job) {
                $has_file = !empty($job['image']);
                $file_url = $has_file ? URL_UPLOAD . 'jobs/' . rawurlencode($job['image']) : '';
                $is_pdf   = $has_file && (substr(strtolower($job['image']), -4) === '.pdf');
                
                // Determine tag based on title
                $tag_label = 'Recruitment Notice';
                $t_lower = strtolower($job['title'] ?? '');
                if (strpos($t_lower, 'walk-in') !== false || strpos($t_lower, 'interview') !== false) {
                    $tag_label = 'Walk-In Interview';
                } elseif (strpos($t_lower, 'nursing') !== false || strpos($t_lower, 'paramedical') !== false || strpos($t_lower, 'medical') !== false) {
                    $tag_label = 'Medical & Paramedical';
                } elseif (strpos($t_lower, 'faculty') !== false || strpos($t_lower, 'professor') !== false) {
                    $tag_label = 'Faculty Positions';
                } elseif (strpos($t_lower, 'counselor') !== false || strpos($t_lower, 'admission') !== false) {
                    $tag_label = 'Administrative Position';
                }
        ?>
        <article class="bu-job-card">
          <div class="bu-job-top-row">
            <span class="bu-job-pill">
              <i class="fa fa-tag"></i> <?php echo $tag_label; ?>
            </span>
            <span class="bu-job-date">
              <i class="fa fa-calendar-o"></i> Posted: <?php echo !empty($job['date']) ? date('d M Y', strtotime($job['date'])) : 'Latest'; ?>
            </span>
          </div>

          <h3 class="bu-job-title"><?php echo htmlspecialchars($job['title'] ?? ''); ?></h3>

          <?php if (!empty($job['description'])): ?>
            <div class="bu-job-desc">
              <?php echo $job['description']; ?>
            </div>
          <?php endif; ?>

          <div class="bu-job-actions">
            <?php if ($has_file): ?>
              <a href="<?php echo $file_url; ?>" target="_blank" class="bu-btn-view-doc">
                <i class="fa <?php echo $is_pdf ? 'fa-file-pdf-o' : 'fa-file-image-o'; ?>"></i> View Official Notification / Ad
              </a>
            <?php endif; ?>
            <a href="mailto:hr@bhabhauniversity.edu.in?subject=Application%20for%20<?php echo rawurlencode(strip_tags($job['title'])); ?>" class="bu-btn-apply-email">
              <i class="fa fa-paper-plane"></i> Apply via Email (Send CV)
            </a>
          </div>
        </article>
        <?php
            }
        } else {
        ?>
        <div class="bu-job-card text-center" style="padding:48px 24px;">
          <i class="fa fa-folder-open-o" style="font-size:40px;color:#94A3B8;margin-bottom:12px;"></i>
          <h4 style="color:#0A1B54;font-weight:700;margin:0 0 6px 0;">No Active Openings At The Moment</h4>
          <p style="color:#64748B;font-size:13.5px;margin:0;">
            Please check back soon or forward your spontaneous resume to <strong>hr@bhabhauniversity.edu.in</strong>.
          </p>
        </div>
        <?php } ?>
      </div>

      <!-- Application Steps Guidelines Card -->
      <div class="bu-guidelines-card">
        <h4 class="bu-guide-title">
          <i class="fa fa-check-square-o" style="color:#D99B00;"></i> How to Apply at Bhabha University
        </h4>
        <div class="bu-steps-grid">
          <div class="bu-step-box">
            <div class="bu-step-num">1</div>
            <h5>Review Requirements</h5>
            <p>Check the eligibility criteria, required qualifications, and specialization in the official notification advertisement.</p>
          </div>
          <div class="bu-step-box">
            <div class="bu-step-num">2</div>
            <h5>Prepare Your Resume</h5>
            <p>Assemble your updated curriculum vitae detailing your educational qualifications, research publications, and experience certificates.</p>
          </div>
          <div class="bu-step-box">
            <div class="bu-step-num">3</div>
            <h5>Submit Application</h5>
            <p>Email your CV to <strong>hr@bhabhauniversity.edu.in</strong> with the post applied for in the subject line, or attend walk-in interview on scheduled date.</p>
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
