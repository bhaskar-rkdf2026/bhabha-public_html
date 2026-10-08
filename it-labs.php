<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'it-labs')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'IT & Computer Labs - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'High-Tech Infrastructure';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'Next-Gen <em>Computing Infrastructure</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Advanced computing facilities featuring 1,000+ networked high-end systems, dedicated 1 Gbps fiber connectivity, AI/ML compute labs, and specialized engineering software.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-laptop';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/b6123df20111594aa04d8b15dd6ce2af.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Central High-Performance Computing Laboratory';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'Bhabha University recognizes computational prowess as an indispensable pillar of modern scientific inquiry, engineering innovation, and corporate success. The university hosts over <strong>1,000+ high-end desktop workstations</strong> organized into 15+ specialized, air-conditioned computer laboratories.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Every laboratory is interconnected through gigabit structured cabling backed by a high-capacity <strong>1 Gbps dedicated optical fiber leased line</strong> and university-wide secure Wi-Fi access, empowering scholars with uninterrupted research bandwidth.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-desktop', 'title' => '1,000+ Latest PC Nodes', 'desc' => 'High-performance desktop workstations equipped with Intel Core processors, SSD storage, and ergonomic setups.'],
  ['icon' => 'fa-wifi', 'title' => '1 Gbps Optical Leased Line', 'desc' => 'Dedicated ultra-high-speed fiber internet backbone with campus-wide secure Wi-Fi access points.'],
  ['icon' => 'fa-server', 'title' => '15+ Specialized Labs', 'desc' => 'Air-conditioned computing laboratories dedicated to AI/ML, Cloud DevOps, Cybersecurity, CAD/CAM, and coding.'],
  ['icon' => 'fa-lock', 'title' => '100% Firewall Protected', 'desc' => 'Enterprise hardware firewall with automated threat filtering, intrusion detection, and continuous data backup.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Domain-Specific Computer Laboratories';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'University IT Helpdesk & Support';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Have computing queries or need lab scheduling assistance? Contact the University IT Cell.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'View IT Cell Team';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'bhabhaitcell.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Explore state-of-the-art computer labs, Apple iMac lab, AI/ML computing clusters, and high-speed fiber-optic network at Bhabha University Bhopal.">
<meta name="keywords" content="Bhabha University computer labs, IT infrastructure Bhopal, AI ML lab, computing center, Apple Mac lab, engineering simulation labs">
<?php include('inc.meta.php'); ?>
<style>
.bu-it-hero-img-box {
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 25px;
  box-shadow: 0 6px 20px rgba(10,27,84,0.08);
}
.bu-it-hero-img-box img {
  width: 100%;
  max-height: 380px;
  object-fit: cover;
  display: block;
}
.bu-it-specs-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin: 25px 0 35px;
}
.bu-it-spec-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 22px 18px;
  text-align: center;
  box-shadow: 0 4px 14px rgba(10,27,84,0.04);
  transition: all 0.25s ease;
}
.bu-it-spec-card:hover {
  transform: translateY(-3px);
  border-color: #FFC107;
  box-shadow: 0 10px 24px rgba(10,27,84,0.1);
}
.bu-it-spec-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  color: #FFC107;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 12px;
}
.bu-it-spec-num {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  line-height: 1.2;
  margin-bottom: 6px;
}
.bu-it-spec-label {
  font-size: 13px;
  color: #64748B;
  line-height: 1.5;
}
.bu-labs-spectrum-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
  margin-top: 20px;
}
.bu-lab-item-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 22px 20px;
  transition: all 0.2s ease;
}
.bu-lab-item-box:hover {
  background: #ffffff;
  border-color: #0A1B54;
  box-shadow: 0 8px 24px rgba(10,27,84,0.08);
}
.bu-lab-item-box h4 {
  font-size: 16px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-lab-item-box h4 i {
  color: #D99B00;
}
.bu-lab-item-box p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.55;
  margin: 0;
}
.bu-it-banner-cta {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  border-radius: 14px;
  padding: 30px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  margin-top: 30px;
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
    <?php $active_page = 'it-labs'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/b6123df20111594aa04d8b15dd6ce2af.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>

        <!-- Specs Grid -->
        <div class="bu-it-specs-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-it-spec-card">
            <div class="bu-it-spec-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-desktop'); ?>"></i></div>
            <div class="bu-it-spec-num"><?php echo htmlspecialchars($f['title'] ?? ''); ?></div>
            <div class="bu-it-spec-label"><?php echo htmlspecialchars($f['desc'] ?? ''); ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <?php if (!empty($detail_rich)): ?>
        <!-- Section 2: Custom Details from Admin -->
        <div class="bu-content-card">
          <span class="bu-content-label">Detailed Information</span>
          <h2 class="bu-content-h2"><?php echo htmlspecialchars($detail_title); ?></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <?php echo $detail_rich; ?>
          </div>
        </div>
      <?php else: ?>
        <!-- Section 2: Specialized Computer Labs (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Specialized Facilities</span>
          <h2 class="bu-content-h2">Domain-Specific <em>Computer Laboratories</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>Our computing centers are tailored to industry-standard tools and contemporary engineering demands:</p>

            <div class="bu-labs-spectrum-grid">
              <div class="bu-lab-item-box">
                <h4><i class="fa fa-cogs"></i> AI &amp; Machine Learning Lab</h4>
                <p>High-memory compute nodes equipped with NVIDIA GPUs, Python, TensorFlow, PyTorch, and Anaconda for deep learning model training.</p>
              </div>
              <div class="bu-lab-item-box">
                <h4><i class="fa fa-apple"></i> Apple iMac Multimedia Studio</h4>
                <p>Creative design and iOS app development workstations equipped with macOS, Xcode, Final Cut Pro, and Adobe Creative Cloud suite.</p>
              </div>
              <div class="bu-lab-item-box">
                <h4><i class="fa fa-shield"></i> Cyber Security &amp; Network Lab</h4>
                <p>Configured with Cisco routers, virtual switch simulators, Wireshark, Kali Linux, and ethical hacking sandboxes for hands-on defense training.</p>
              </div>
              <div class="bu-lab-item-box">
                <h4><i class="fa fa-code"></i> Full-Stack Software Development</h4>
                <p>Dedicated coding laboratory supporting Java, C/C++, Node.js, React, Android Studio, and database management platforms like Oracle and PostgreSQL.</p>
              </div>
              <div class="bu-lab-item-box">
                <h4><i class="fa fa-cubes"></i> CAD / CAM &amp; Simulation Lab</h4>
                <p>Equipped with licensed AutoCAD, SolidWorks, MATLAB, ANSYS, and Xilinx suites for mechanical, civil, and electrical engineering modeling.</p>
              </div>
              <div class="bu-lab-item-box">
                <h4><i class="fa fa-cloud"></i> Cloud Computing &amp; DevOps Lab</h4>
                <p>Virtualization environments running Docker, Kubernetes, AWS Educate, and Azure cloud computing resources for modern DevOps workflows.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 3: Licensed Software & Enterprise Support -->
        <div class="bu-content-card">
          <span class="bu-content-label">Industry Licenses</span>
          <h2 class="bu-content-h2">Licensed Software &amp; <em>IT Support</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>Microsoft Campus Agreement:</strong> Legal licensed Windows 11 Enterprise, Microsoft Office 365, and Visual Studio tools available across all terminals.</li>
              <li><strong>Engineering Suite:</strong> MATLAB &amp; Simulink with 50+ toolboxes, ANSYS Multiphysics, AutoCAD, and LabVIEW.</li>
              <li><strong>Pharmacy &amp; Medical Informatics:</strong> ChemDraw, Molecular Docking Software (AutoDock), and statistical tools (SPSS, GraphPad Prism).</li>
              <li><strong>Uninterrupted Power:</strong> 3-Phase centralized industrial online UPS systems ensuring zero data loss during power fluctuations.</li>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <!-- IT CTA Banner -->
      <div class="bu-it-banner-cta">
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
