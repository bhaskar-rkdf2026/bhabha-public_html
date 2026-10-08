<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'health-wellness')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Health & Wellness - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Care & Healing';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'Campus Medical &amp; <em>Wellness Center</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Prioritizing student well-being through an on-campus primary healthcare center, 24x7 doctor on call, ambulance facility, mental wellness counseling, and regular health checkup camps.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-heartbeat';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/e24d4326ba8712763cc0e1484f66dc4d.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Campus Health Care & Emergency Medical Centre';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'At Bhabha University, student health, physical vitality, and mental peace of mind form the foundation of academic achievement. The university maintains a well-appointed <strong>On-Campus Health Center</strong> staffed with qualified resident medical officers, experienced nursing staff, and emergency medical technicians.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Whether it is immediate first-aid, routine seasonal care, medication dispensing, or mental wellness mentoring, students receive caring, confidential, and prompt attention round the clock.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-user-md', 'title' => '24x7 Medical Officer On-Call', 'desc' => 'Qualified physicians and nursing personnel stationed on-campus for general consultations, diagnosis, and emergency first response.'],
  ['icon' => 'fa-ambulance', 'title' => 'Dedicated Ambulance Unit', 'desc' => 'Fully equipped 24-hour campus ambulance on standby with oxygen support and stretcher facilities for rapid hospital transfer.'],
  ['icon' => 'fa-medkit', 'title' => 'Free Dispensary & Pharmacy', 'desc' => 'Essential medicines, first-aid supplies, antiseptic dressings, and over-the-counter wellness tablets provided free of cost to students.'],
  ['icon' => 'fa-hospital-o', 'title' => 'Tie-Up With Multi-Specialty Hospitals', 'desc' => 'Institutional tie-ups with leading multi-specialty tertiary hospitals in Bhopal for prioritized inpatient care and diagnostics.'],
  ['icon' => 'fa-leaf', 'title' => 'AYUSH & Homeopathic OPD', 'desc' => 'Holistic healthcare support leveraging the university\'s esteemed Faculty of Homeopathy and Ayurvedic medicinal resources.'],
  ['icon' => 'fa-heart', 'title' => 'Mental Wellness: Unload Pittara', 'desc' => 'Dedicated youth psychological counselling cell providing confidential stress relief, career guidance, and anti-anxiety support.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Annual Health Drives & Wellness Camps';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : '24x7 Medical Emergency Line';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'In case of illness or medical emergency, reach the Health Center immediately.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Emergency: 0755-4246498';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'tel:07554246498';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Comprehensive student healthcare at Bhabha University Bhopal. Features on-campus medical center, 24x7 doctor on call, ambulance service, homeopathy clinic, and Unload Pittara mental wellness support.">
<meta name="keywords" content="Bhabha University healthcare, campus medical center Bhopal, student health wellness, ambulance service, Unload Pittara counselling">
<?php include('inc.meta.php'); ?>
<style>
.bu-health-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-health-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-health-card:hover {
  transform: translateY(-4px);
  border-color: #EF4444;
  box-shadow: 0 12px 28px rgba(239,68,68,0.12);
}
.bu-health-icon {
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
.bu-health-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-health-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-health-banner-cta {
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
    <?php $active_page = 'health-wellness'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/e24d4326ba8712763cc0e1484f66dc4d.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Healthcare Highlights Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Medical Amenities</span>
        <h2 class="bu-content-h2">Key Healthcare <em>Services</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-health-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-health-card">
            <div class="bu-health-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-heartbeat'); ?>"></i></div>
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
        <!-- Section 3: Preventive Wellness & Annual Camps (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Preventive Care</span>
          <h2 class="bu-content-h2">Annual Health Drives &amp; <em>Wellness Camps</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>The university regularly conducts proactive health and screening programs for the campus community:</p>
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>Annual Student Health Checkups:</strong> Mandatory medical examinations for all incoming first-year scholars covering vision, blood grouping, BMI, and vital checks.</li>
              <li><strong>Dental Care &amp; Oral Hygiene Camps:</strong> Organized in collaboration with dental surgeons offering free consultations and preventative advice.</li>
              <li><strong>Blood Donation Drives:</strong> Regular voluntary donation camps organized in partnership with Bhopal Red Cross Society and local blood banks.</li>
              <li><strong>Yoga &amp; Meditation Sessions:</strong> Daily early-morning wellness sessions at the central sports ground cultivating mental calm and stamina.</li>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <!-- Health CTA Banner -->
      <div class="bu-health-banner-cta">
        <div>
          <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="<?php echo $page_icon; ?> text-danger mr-2"></i> <?php echo htmlspecialchars($cta_title); ?></h3>
          <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;"><?php echo htmlspecialchars($cta_desc); ?></p>
        </div>
        <div>
          <a href="<?php echo htmlspecialchars($cta_btn_url); ?>" class="bu-btn-primary" style="white-space:nowrap; background:#EF4444 !important; color:#ffffff !important;"><i class="fa fa-phone"></i> <?php echo htmlspecialchars($cta_btn_text); ?></a>
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
