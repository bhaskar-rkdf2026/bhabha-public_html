<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'community-service')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Community Service & Environment - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Social Responsibility';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'Empowering Society &amp; <em>Protecting Nature</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Instilling civic consciousness and sustainable stewardship through National Service Scheme (NSS), green energy, 1101 tree plantation drives, Nav Grah Vatika, and village outreach.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-leaf';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/ed3185628b9828212309305234c8a863.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Green Energy Solar Power Plant & Environmental Sustainability at Bhabha University';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'At Bhabha University, education goes hand in hand with societal upliftment and environmental responsibility. We actively instill in our scholars the values of compassion, community service, civic consciousness, and ecological sustainability.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'From village adoption initiatives and rural health awareness campaigns to campus-wide solar power generation and mass tree plantation missions, our students and faculty continually strive to build a cleaner, greener, and more equitable tomorrow.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-users', 'title' => 'National Service Scheme (NSS)', 'desc' => 'Active government-recognized NSS unit conducting village youth camps, literacy drives, cleanliness rallies, and hygiene education.'],
  ['icon' => 'fa-tree', 'title' => '"1101 Trees" Plantation Drive', 'desc' => 'Annual mass afforestation commitment planting and adopting over 1,101 native oxygen-rich trees across the campus perimeter.'],
  ['icon' => 'fa-leaf', 'title' => 'Nav Grah Herbal Vatika', 'desc' => 'Unique medicinal botanical garden harboring planetary and Ayurvedic flora for herbal research, traditional botany, and nature walks.'],
  ['icon' => 'fa-tint', 'title' => 'Rainwater Harvesting & Solar', 'desc' => 'Comprehensive rooftop rainwater harvesting recharge pits and a solar power installation supplying clean green energy to the campus.'],
  ['icon' => 'fa-heart', 'title' => 'Mega Blood Donation Camps', 'desc' => 'Annual voluntary donation drives in collaboration with the Indian Red Cross, mobilizing hundreds of units of blood for Bhopal hospitals.'],
  ['icon' => 'fa-balance-scale', 'title' => 'Free Legal Aid Clinic', 'desc' => 'Constituent law faculty students and professors provide free legal counseling, dispute mediation, and awareness to underprivileged citizens.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Rural Adoption & Swachh Bharat Mission';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Become an NSS Student Volunteer';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Join our active volunteer network, earn NSS certificates, and lead community impact projects.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Explore Environment Club';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'clubs.php#environment-club';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Discover Community Service and Environmental Initiatives at Bhabha University Bhopal. Features National Service Scheme (NSS), 1101 Tree Plantation, Nav Grah Vatika, and village development.">
<meta name="keywords" content="Bhabha University NSS, community service Bhopal, green campus 1101 trees, Nav Grah Vatika, blood donation drive, sustainability Bhopal">
<?php include('inc.meta.php'); ?>
<style>
.bu-comm-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-comm-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-comm-card:hover {
  transform: translateY(-4px);
  border-color: #10B981;
  box-shadow: 0 12px 28px rgba(16,185,129,0.12);
}
.bu-comm-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: #ECFDF5;
  color: #059669;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-comm-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-comm-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-comm-banner-cta {
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
    <?php $active_page = 'community-service'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/ed3185628b9828212309305234c8a863.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Flagship Initiatives Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Key Pillars</span>
        <h2 class="bu-content-h2">Community &amp; Eco <em>Initiatives</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-comm-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-comm-card">
            <div class="bu-comm-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-leaf'); ?>"></i></div>
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
        <!-- Section 3: Village Development & Cleanliness (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Grassroots Outreach</span>
          <h2 class="bu-content-h2">Rural Adoption &amp; <em>Swachh Bharat Mission</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>
              Under the <strong>Unnat Bharat Abhiyan</strong> framework, the university has adopted neighboring rural hamlets surrounding Bhopal to provide sustained developmental assistance:
            </p>
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>Digital Literacy &amp; Computer Camps:</strong> Free computer skills sessions for rural school children and youth.</li>
              <li><strong>Women Health &amp; Nutrition Camps:</strong> Awareness sessions conducted by our medical and pharmacy faculty on maternal nutrition and hygiene.</li>
              <li><strong>Plastic-Free Campus Campaign:</strong> Bhabha University strictly enforces a zero single-use plastic policy across all canteens and departmental buildings.</li>
              <li><strong>Waste Segregation &amp; Composting:</strong> Wet organic waste from hostels and canteens is converted into organic compost for university landscaping.</li>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <!-- Community Service CTA Banner -->
      <div class="bu-comm-banner-cta">
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
