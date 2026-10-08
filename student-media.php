<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'student-media')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Student Media & Communication - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Voices of Bhabha';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'The Voice of <em>Bhabha Campus</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Amplifying the creative voice of Bhabha University — featuring Radio Popcorn 90.4 FM (first campus radio in MP), Campus Pulse newsletter, podcast studio, and digital media journalism.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-bullhorn';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/9d2419cc88e43953ae02ef09e8d0bd2c.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Community Radio Station 90.8 FM & Media Studio';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'At Bhabha University, students possess vibrant avenues to broadcast their voices, hone multimedia storytelling skills, write impactful investigative stories, and produce professional audio-visual content.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Our premier media pride is <strong>Radio Popcorn 90.4 FM</strong> — the first recognized Community Radio Station established by a private educational institution in Madhya Pradesh, broadcasting 10 hours daily to a listening radius of over 25+ kilometers.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-microphone', 'title' => 'Radio Popcorn 90.4 FM', 'desc' => 'Student RJs host live talk shows, health awareness interviews, career podcasts, and youth music countdowns reaching over 100,000 citizens in Bhopal.'],
  ['icon' => 'fa-newspaper-o', 'title' => '"Campus Pulse" E-Newsletter', 'desc' => 'Quarterly digital student publication documenting department triumphs, research breakthroughs, campus fashion, and creative literary essays.'],
  ['icon' => 'fa-video-camera', 'title' => 'Digital Studio & Podcasts', 'desc' => 'Acoustic studio with 4K recording cameras, condenser mics, and multi-track mixers for student podcast series and YouTube educational shorts.'],
  ['icon' => 'fa-bullhorn', 'title' => 'AD-MAD & PR Cell', 'desc' => 'Student creative agency handling event promotion, social media reels, graphic banners, and brand management for university festivals.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Radio Popcorn 90.4 FM On-Air';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Listen to Radio Popcorn 90.8 FM';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Explore studio archives, RJ schedule, and audio episodes on our dedicated radio page.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Visit Radio 90.8 FM Page';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'radio.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Explore Student Media & Communication at Bhabha University Bhopal featuring Radio Popcorn 90.4 FM, Campus Pulse digital newsletter, podcast studio, and media journalism club.">
<meta name="keywords" content="Bhabha University media, Radio Popcorn 90.4 FM Bhopal, student journalism, campus newsletter, community radio, media club">
<?php include('inc.meta.php'); ?>
<style>
.bu-media-hero-img-box {
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 25px;
  box-shadow: 0 6px 20px rgba(10,27,84,0.08);
}
.bu-media-hero-img-box img {
  width: 100%;
  max-height: 380px;
  object-fit: cover;
  display: block;
}
.bu-media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-media-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-media-card:hover {
  transform: translateY(-4px);
  border-color: #0284C7;
  box-shadow: 0 12px 28px rgba(2,132,199,0.12);
}
.bu-media-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: #F0F9FF;
  color: #0284C7;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-media-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-media-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-media-banner-cta {
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
    <?php $active_page = 'student-media'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/9d2419cc88e43953ae02ef09e8d0bd2c.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Media Divisions Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Broadcasting &amp; Press</span>
        <h2 class="bu-content-h2">Student Media <em>Divisions &amp; Channels</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-media-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-bullhorn'); ?>"></i></div>
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
        <!-- Section 3: Radio Popcorn Feature (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Flagship Community Radio</span>
          <h2 class="bu-content-h2">Radio Popcorn <em>90.4 FM On-Air</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>Inception:</strong> Launched on 14th February 2008 as the pioneer campus community radio in Madhya Pradesh.</li>
              <li><strong>Transmission Coverage:</strong> 50 Watt FM transmitter providing crystal-clear reception across Bhopal, Mandideep, and adjacent rural belts.</li>
              <li><strong>Student Radio Jockey (RJ) Auditions:</strong> Held every semester giving budding orators, poets, and broadcasters practical studio training.</li>
              <li><strong>Key Programs:</strong> "Yuva Tarang", "Career Pathshala", "Kisan Vaani", and "Swasthya Sandesh".</li>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <!-- Student Media CTA Banner -->
      <div class="bu-media-banner-cta">
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
