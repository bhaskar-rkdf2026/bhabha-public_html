<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'entrepreneurship')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Entrepreneurship & Career Dev - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Incubating Future Leaders';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'Entrepreneurship Development <em>Cell (EDC)</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Transforming student ideas into commercial enterprises through incubation workspaces, startup seed funds, patent and IPR facilitation, and industry executive mentorship.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-rocket';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/83e285d874ee031ad471ea4df94a1945.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Entrepreneurship Development Cell & Smart Innovation Hall';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'The <strong>Entrepreneurship Development Cell (EDC) &amp; Incubation Center</strong> at Bhabha University is dedicated to nurturing an entrepreneurial mindset across Engineering, Pharmacy, Management, Information Technology, and Applied Sciences.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Rather than just producing job seekers, Bhabha University empowers scholars to become <strong>job creators</strong>. EDC offers complete end-to-end support — from ideation validation, business model canvas drafting, and prototype fabrication to patent filing and seed stage investment pitches.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-lightbulb-o', 'title' => 'Idea Prototyping Labs', 'desc' => 'Access to modern IoT maker labs, 3D printing equipment, simulation software, and specialized testing apparatus to build functional MVPs.'],
  ['icon' => 'fa-money', 'title' => 'Seed Funding & Grants', 'desc' => 'Assistance in applying for MSME incubation schemes, MP Startup Policy grants, and university student innovation seed capital.'],
  ['icon' => 'fa-file-text-o', 'title' => 'IPR & Patent Guidance', 'desc' => 'Complete legal and technical assistance in conducting patent searches, drafting intellectual property claims, and filing patents.'],
  ['icon' => 'fa-users', 'title' => 'CXO & Alumni Mentorship', 'desc' => 'Direct 1-on-1 mentorship from successful alumni founders, angel investors, chartered accountants, and senior corporate executives.'],
  ['icon' => 'fa-briefcase', 'title' => 'Coworking Incubation Space', 'desc' => 'Furnished air-conditioned startup office cubicles, high-speed Wi-Fi, conference boardrooms, and company registration support.'],
  ['icon' => 'fa-bullhorn', 'title' => 'AD-MAD & Pitch Competitions', 'desc' => 'Regular hackathons, Shark-Tank style pitch sessions, advertising competitions, and business plan showcases with cash prizes.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Annual Startup Events & Competitions';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Have an Innovative Startup Idea?';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Pitch your startup concept to the Bhabha Incubation Cell and receive seed funding support.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Register with EDC Cell';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'clubs.php#edc-cell';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Discover the Entrepreneurship Development Cell (EDC) and Startup Incubation Center at Bhabha University Bhopal. Supporting student innovation, seed funding, IPR patents, and business mentorship.">
<meta name="keywords" content="Bhabha University EDC, startup incubation Bhopal, entrepreneurship development cell, student seed funding, patent filing, AD-MAD club">
<?php include('inc.meta.php'); ?>
<style>
.bu-edc-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-edc-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-edc-card:hover {
  transform: translateY(-4px);
  border-color: #F59E0B;
  box-shadow: 0 12px 28px rgba(245,158,11,0.14);
}
.bu-edc-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: #FFFBEB;
  color: #D97706;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-edc-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-edc-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-edc-banner-cta {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
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
    <?php $active_page = 'entrepreneurship'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/2aa0d1727f2df6a9ddfa7bb009eb7873.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Incubation Ecosystem Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Incubation Hub</span>
        <h2 class="bu-content-h2">Startup Support &amp; <em>Incubation Ecosystem</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-edc-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-edc-card">
            <div class="bu-edc-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-rocket'); ?>"></i></div>
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
        <!-- Section 3: Programs & Milestones (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Activities &amp; Impact</span>
          <h2 class="bu-content-h2">Annual Startup Events &amp; <em>Competitions</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>B-Plan Hackathon:</strong> 36-hour inter-college entrepreneurial sprint testing innovative product ideas with immediate jury feedback.</li>
              <li><strong>Startup Bootcamp:</strong> Specialized weekend workshops on company registration (Pvt Ltd/LLP), GST compliance, and digital marketing.</li>
              <li><strong>Angel Investor Demo Days:</strong> Curated investor meetups connecting vetted student startup founders with local venture capitalists.</li>
              <li><strong>IPR Awareness Workshops:</strong> Interactive sessions educating engineering and pharma students on turning thesis projects into commercial patents.</li>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <!-- EDC CTA Banner -->
      <div class="bu-edc-banner-cta">
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
