<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'library')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Central Library & E-Resources - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Knowledge Sanctuary';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'The Central <em>Library</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'A premier intellectual sanctuary holding 50,000+ volumes, DELNET subscriptions, IEEE/Springer journals, quiet research carrels, and 24x7 online repository access.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-book';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/acacb02dda9b764fac164d4397a2accd.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Central Library & Air-Conditioned Digital Reading Hall';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'The <strong>Central Library of Bhabha University</strong> stands as the academic heartbeat of the institution. Spanning multiple spacious, air-conditioned floors, the library caters to scholars, faculty members, and research aspirants across Engineering, Pharmacy, Management, Medicine, Sciences, Education, and Law.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Operating with modern automated Library Management Software (KOHA/RFID), students enjoy computerized book searching, quick barcode borrowing, and seamless access to thousands of peer-reviewed digital journals.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-book', 'title' => '50,000+ Printed Books', 'desc' => 'Comprehensive textbook and reference collections across engineering, medical, management, and pharmacy sciences.'],
  ['icon' => 'fa-desktop', 'title' => '10,000+ E-Journals', 'desc' => 'Instant access to international research publications, IEEE, ScienceDirect, and electronic theses repositories.'],
  ['icon' => 'fa-users', 'title' => '500+ Seater Reading Hall', 'desc' => 'Acoustically soundproof, centrally air-conditioned study environment engineered for high academic concentration.'],
  ['icon' => 'fa-database', 'title' => 'DELNET & NDLI Access', 'desc' => 'Institutional network member linking students to inter-library loan facilities across thousands of Indian universities.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Digital Resources & Databases';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Need Library Assistance?';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Connect with the Chief Librarian desk for book reservations, catalog search, or research repository access.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Contact Librarian';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'contact.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Explore Bhabha University Central Library featuring 50,000+ volumes, 10,000+ e-journals, DELNET, NDLI digital library access, quiet reading halls, and research study booths.">
<meta name="keywords" content="Bhabha University library, central library Bhopal, digital library DELNET, e-journals, engineering pharmacy law books, university reading hall">
<?php include('inc.meta.php'); ?>
<style>
.bu-lib-hero-img-box {
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 25px;
  box-shadow: 0 6px 20px rgba(10,27,84,0.08);
}
.bu-lib-hero-img-box img {
  width: 100%;
  max-height: 380px;
  object-fit: cover;
  display: block;
}
.bu-lib-stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin: 25px 0 35px;
}
.bu-lib-stat-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 22px 16px;
  text-align: center;
  box-shadow: 0 4px 14px rgba(10,27,84,0.04);
  transition: all 0.25s ease;
}
.bu-lib-stat-card:hover {
  transform: translateY(-3px);
  border-color: #FFC107;
  box-shadow: 0 10px 24px rgba(10,27,84,0.1);
}
.bu-lib-stat-icon {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  background: #FFF8E1;
  color: #D99B00;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 12px;
}
.bu-lib-stat-num {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  line-height: 1.2;
  margin-bottom: 6px;
}
.bu-lib-stat-label {
  font-size: 13px;
  color: #64748B;
  line-height: 1.5;
}
.bu-lib-services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-top: 20px;
}
.bu-lib-service-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 20px;
}
.bu-lib-service-item h4 {
  font-size: 16px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-lib-service-item h4 i {
  color: #D99B00;
}
.bu-lib-service-item p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.55;
  margin: 0;
}
.bu-lib-banner-cta {
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
    <?php $active_page = 'library'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/acacb02dda9b764fac164d4397a2accd.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>

        <!-- Features / Stats Grid -->
        <div class="bu-lib-stats-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-lib-stat-card">
            <div class="bu-lib-stat-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-book'); ?>"></i></div>
            <div class="bu-lib-stat-num"><?php echo htmlspecialchars($f['title'] ?? ''); ?></div>
            <div class="bu-lib-stat-label"><?php echo htmlspecialchars($f['desc'] ?? ''); ?></div>
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
        <!-- Section 2: Digital Library & E-Databases (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Online Learning Portals</span>
          <h2 class="bu-content-h2">Digital Resources &amp; <em>Databases</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>
              Bhabha University has partnered with premier national and global digital consortiums, providing students unrestricted on-campus and remote e-access:
            </p>
            <div class="bu-lib-services-grid">
              <div class="bu-lib-service-item">
                <h4><i class="fa fa-globe"></i> DELNET Institutional Access</h4>
                <p>Inter-library loan and document delivery from 7,000+ top Indian and South Asian libraries covering millions of research articles.</p>
              </div>
              <div class="bu-lib-service-item">
                <h4><i class="fa fa-graduation-cap"></i> NDLI (National Digital Library)</h4>
                <p>Single-window access to learning resources from primary school to post-graduate research supported by the Ministry of Education.</p>
              </div>
              <div class="bu-lib-service-item">
                <h4><i class="fa fa-file-text-o"></i> Peer-Reviewed E-Journals</h4>
                <p>Full-text subscriptions to IEEE, Springer, ScienceDirect, Elsevier, PubMed Central, and Bentham Science repositories.</p>
              </div>
              <div class="bu-lib-service-item">
                <h4><i class="fa fa-archive"></i> Exam Papers &amp; Theses Bank</h4>
                <p>Archived collection of university previous year exam question papers, student dissertations, and doctoral theses in digital format.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 3: Reading Halls & Facilities -->
        <div class="bu-content-card">
          <span class="bu-content-label">Study Spaces</span>
          <h2 class="bu-content-h2">Reading Halls &amp; <em>Research Booths</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <ul style="padding-left:20px; line-height:1.8; color:#475569;">
              <li><strong>Quiet Study Zone:</strong> Acoustically optimized reading space accommodating 500+ readers simultaneously.</li>
              <li><strong>Digital Media Lab:</strong> 40+ networked multimedia computers dedicated for online literature review and plagiarism analysis.</li>
              <li><strong>Faculty Research Cabins:</strong> Private, soundproof workstations for professors and doctoral research scholars.</li>
              <li><strong>Reprography &amp; Printing:</strong> Low-cost photocopying, color scanning, and document printing facility available within the library.</li>
              <li><strong>Reference Section:</strong> Encyclopedias, dictionaries, Indian Pharmacopoeia, civil codes, and rare historical archives.</li>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <!-- Library CTA Banner -->
      <div class="bu-lib-banner-cta">
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
