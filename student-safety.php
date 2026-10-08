<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'student-safety')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Student Safety & Support - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Multi-Layered Security';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'A Fearless &amp; <em>Secure Campus Environment</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Ensuring a secure, zero-tolerance anti-ragging campus through 24x7 surveillance, Women Internal Complaints Committee (ICC), student counseling, and quick-response security teams.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-shield';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/a21a86aaaa2a4e2d73c247cdb15af08e.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : '24x7 High-Definition CCTV Surveillance & Regulated Campus Checkpoints';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'Bhabha University maintains an unwavering commitment to the safety, dignity, mental comfort, and well-being of all students, faculty members, and campus visitors.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Our sprawling 32-acre campus operates under comprehensive round-the-clock physical security patrols, high-definition electronic surveillance, strictly monitored perimeter checkpoints, and institutional grievance bodies adhering strictly to UGC and Supreme Court mandates.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-ban', 'title' => 'Anti-Ragging Squad', 'desc' => 'Zero tolerance policy against ragging. Strict adherence to UGC guidelines with surprise squad patrols across hostels, canteens, and sports fields.'],
  ['icon' => 'fa-female', 'title' => 'Women\'s Safety & ICC', 'desc' => 'Active Internal Complaints Committee (ICC) ensuring strict gender sensitization, prevention of sexual harassment (POSH), and confidential hearings.'],
  ['icon' => 'fa-video-camera', 'title' => '24x7 HD CCTV Surveillance', 'desc' => 'Over 200+ networked digital security cameras monitoring entry gates, academic corridors, common lounges, and hostel perimeter fences.'],
  ['icon' => 'fa-id-card', 'title' => 'Biometric Access & Guards', 'desc' => 'Trained security personnel stationed at all campus gates with biometric turnstiles and mandatory visitor verification logging.'],
  ['icon' => 'fa-fire-extinguisher', 'title' => 'Fire & Disaster Safety', 'desc' => 'Commercial fire hydrants, automated smoke alarms, dry powder extinguishers on every floor, and scheduled student evacuation drills.'],
  ['icon' => 'fa-user-secret', 'title' => 'Confidential Grievance Portal', 'desc' => 'Digital grievance redressal portal allowing students to submit academic or administrative concerns directly to the university ombudsman.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Anti-Ragging Regulations & Penalties';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Campus Emergency Control Room';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : '24x7 Emergency Contact: Security Desk (0755-4246498) | Proctor Office (+91-9893000000) | National UGC Helpline (1800-180-5522)';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Report an Issue';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'contact.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Discover the comprehensive student safety, zero-tolerance anti-ragging policy, 24x7 security, Women's Internal Complaints Committee (ICC), and emergency support at Bhabha University Bhopal.">
<meta name="keywords" content="Bhabha University student safety, anti ragging cell Bhopal, women safety ICC, campus security CCTV, student grievance redressal">
<?php include('inc.meta.php'); ?>
<style>
.bu-safe-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-safe-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-safe-card:hover {
  transform: translateY(-4px);
  border-color: #EF4444;
  box-shadow: 0 12px 28px rgba(239,68,68,0.12);
}
.bu-safe-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: #FEF2F2;
  color: #DC2626;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-safe-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-safe-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-emergency-box {
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  border-radius: 14px;
  padding: 28px 30px;
  color: #ffffff;
  margin-top: 25px;
}
.bu-emergency-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-top: 18px;
}
.bu-em-card {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 8px;
  padding: 14px 16px;
}
.bu-em-card h5 {
  color: #FFC107;
  font-size: 13px;
  font-weight: 800;
  text-transform: uppercase;
  margin: 0 0 4px;
}
.bu-em-card p {
  font-size: 15px;
  font-weight: 700;
  color: #ffffff;
  margin: 0;
}
.bu-safety-cta {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 60%, #162B75 100%);
  border-radius: 14px;
  padding: 30px;
  color: #ffffff;
  margin-top: 25px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  flex-wrap: wrap;
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
  $page_title    = $page_heading;
  $page_subtitle = $page_sub;
  $page_icon     = $page_icon;
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => strip_tags($page_title_raw), 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'student-safety'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/a21a86aaaa2a4e2d73c247cdb15af08e.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Safety Pillars Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Multi-Layered Security</span>
        <h2 class="bu-content-h2">Security Systems &amp; <em>Support Cells</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-safe-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-safe-card">
            <div class="bu-safe-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-shield'); ?>"></i></div>
            <h4><?php echo htmlspecialchars($f['title'] ?? ''); ?></h4>
            <p><?php echo htmlspecialchars($f['desc'] ?? ''); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <?php if (!empty($detail_rich)): ?>
        <!-- Section 3: Custom Details from Admin -->
        <div class="bu-content-card">
          <span class="bu-content-label">Detailed Information</span>
          <h2 class="bu-content-h2"><?php echo htmlspecialchars($detail_title); ?></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <?php echo $detail_rich; ?>
          </div>
        </div>
      <?php else: ?>
        <!-- Section 3: Anti-Ragging Measures & Rules (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Statutory Compliance</span>
          <h2 class="bu-content-h2">Anti-Ragging Regulations &amp; <em>Penalties</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>
              In compliance with the regulations of the University Grants Commission (UGC) and Apex Court directives, ragging in any physical, verbal, mental, or cyber form is a non-bailable criminal offense.
            </p>
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>Mandatory Affidavit:</strong> Every enrolled student and their parent must submit an online anti-ragging affidavit at the start of each academic year.</li>
              <li><strong>Immediate Penalties:</strong> Involvement in ragging warrants immediate rustication, cancellation of scholarship/hostel allotment, and lodging of an FIR with local police.</li>
              <li><strong>Anti-Ragging Helpline (Toll-Free):</strong> 1800-180-5522 (National 24x7 UGC Helpline).</li>
            </ul>
          </div>

          <div class="bu-emergency-box" style="background:linear-gradient(135deg, #051235 0%, #0A1B54 60%, #162B75 100%) !important; border-radius:12px; padding:26px 28px; margin-top:25px; box-shadow:0 8px 24px rgba(10,27,84,0.15); border:1px solid rgba(255,193,7,0.2);">
            <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-phone text-warning mr-2"></i> Campus Emergency Control Room</h3>
            <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0 0 16px;">Save these 24x7 emergency contacts on your mobile phone:</p>

            <div class="bu-emergency-grid">
              <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
                <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Campus Security Desk</h5>
                <p style="color:#ffffff !important; font-size:14px; font-weight:700; margin:0;">0755-4246498</p>
              </div>
              <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
                <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Chief Proctor Office</h5>
                <p style="color:#ffffff !important; font-size:14px; font-weight:700; margin:0;">+91-9893000000</p>
              </div>
              <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
                <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Women Safety Cell (ICC)</h5>
                <p style="color:#ffffff !important; font-size:13px; font-weight:600; margin:0;">icc@bhabhauniversity.edu.in</p>
              </div>
              <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
                <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Local Police Control</h5>
                <p style="color:#ffffff !important; font-size:14px; font-weight:700; margin:0;">112 / 100</p>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Safety CTA Banner -->
      <div class="bu-safety-cta">
        <div>
          <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="<?php echo $page_icon; ?> text-warning mr-2"></i> <?php echo htmlspecialchars($cta_title); ?></h3>
          <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;"><?php echo htmlspecialchars($cta_desc); ?></p>
        </div>
        <div>
          <a href="<?php echo href($cta_btn_url); ?>" class="bu-btn-primary" style="white-space:nowrap;"><?php echo htmlspecialchars($cta_btn_text); ?> <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>
<?php include('inc.footer.js.php'); ?>
</body>
</html>
