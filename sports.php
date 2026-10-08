<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'sports')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Sports & Fitness Complex - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Champions in the Making';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'Sports Culture at <em>Bhabha University</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Encouraging athletic vigor, sportsmanship, and holistic stamina through tournament-grade cricket grounds, football turfs, basketball courts, synthetic badminton arenas, and modern gymnasiums.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-futbol-o';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/08ba91f6cd604afe6629e3c47afc8dfa.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Fitness Gymnasium & Multi-Sport Complex';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'Sports and athletic pursuits are central to student life at Bhabha University. We strongly believe that sporting participation builds discipline, resilience, leadership, and emotional balance that enriches academic and professional careers.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Spread across extensive open spaces within our 32-acre campus, the university offers state-of-the-art outdoor grounds and well-equipped indoor recreation complexes accommodating casual players and university varsity teams alike.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-futbol-o', 'title' => 'Full-Size Football Turf', 'desc' => 'Lush, natural grass football field conforming to university tournament specifications with regular inter-college league fixtures.'],
  ['icon' => 'fa-shield', 'title' => 'Cricket Grounds & Nets', 'desc' => 'Expansive cricket stadium with professionally curated pitch and dedicated practice net enclosures for batting and bowling drills.'],
  ['icon' => 'fa-dribbble', 'title' => 'Outdoor Basketball Arena', 'desc' => 'Regulation-size concrete basketball court with floodlights, spring-loaded hoops, and perimeter spectator seating.'],
  ['icon' => 'fa-circle-o', 'title' => 'Volleyball & Throwball Courts', 'desc' => 'Multiple well-maintained clay courts hosting daily evening matches and intra-department tournaments.'],
  ['icon' => 'fa-trophy', 'title' => 'Indoor Badminton & TT Complex', 'desc' => 'Multi-court wooden badminton hall and table tennis tables with professional LED lighting for round-the-year play.'],
  ['icon' => 'fa-heartbeat', 'title' => 'Modern Gymnasium & Cardio Suite', 'desc' => 'Air-conditioned fitness studio featuring commercial treadmills, cross trainers, multi-gym stations, and certified fitness trainers.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : '"Khelo Bhabha" Sports Championship';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Join University Sports Teams';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Are you a state/national level player? Apply for sports trials and scholarship assistance.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Join Khelo Bhabha Club';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'clubs.php#khelo-bhabha';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Discover world-class sports facilities at Bhabha University Bhopal. Features cricket ground, football arena, basketball courts, badminton hall, modern gymnasium, and annual Khelo Bhabha championship.">
<meta name="keywords" content="Bhabha University sports, cricket ground Bhopal, sports complex, gym fitness, badminton court, Khelo Bhabha annual fest">
<?php include('inc.meta.php'); ?>
<style>
.bu-sports-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-sports-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-sports-card:hover {
  transform: translateY(-4px);
  border-color: #10B981;
  box-shadow: 0 12px 28px rgba(16,185,129,0.12);
}
.bu-sports-icon {
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
.bu-sports-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-sports-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-sports-banner {
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
    <?php $active_page = 'sports'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/08ba91f6cd604afe6629e3c47afc8dfa.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Outdoor & Indoor Sports Facilities -->
      <div class="bu-content-card">
        <span class="bu-content-label">Infrastructure</span>
        <h2 class="bu-content-h2">World-Class <em>Sporting Arenas</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-sports-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-sports-card">
            <div class="bu-sports-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-futbol-o'); ?>"></i></div>
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
        <!-- Section 3: Annual Khelo Bhabha Championship (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Annual Flagship Tournament</span>
          <h2 class="bu-content-h2">"Khelo Bhabha" <em>Sports Championship</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>
              The pinnacle of university athletic celebrations is <strong>"Khelo Bhabha"</strong> — an annual week-long mega sports festival where over 2,000+ students from all constituent faculties compete across 25+ sporting categories.
            </p>
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>Events Contested:</strong> Cricket, Football, Basketball, Volleyball, Kho-Kho, Kabaddi, Badminton, Chess, Table Tennis, Tug of War, 100m/200m/400m Athletics Sprint, Shot Put, and Long Jump.</li>
              <li><strong>Inter-University Competitions:</strong> University teams regularly represent Bhabha in Association of Indian Universities (AIU) National Games and West Zone Championships.</li>
              <li><strong>Coaching &amp; Mentorship:</strong> Full-time qualified Physical Education Directors (DPE) and specialized coaches provide tactical training and fitness guidance.</li>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <!-- Sports CTA Banner -->
      <div class="bu-sports-banner">
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
