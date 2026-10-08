<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'transportation')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Transport & Bus Routes - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Safe & Punctual Transit';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'University <em>Transport Service</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Extensive fleet of 50+ modern, GPS-enabled buses covering all prime corners of Bhopal, Mandideep, and Sehore to ensure safe, comfortable, and punctual daily commutes.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-bus';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/1861bfeabedd25b52f2192d45a03c7f7.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Fleet of GPS-Monitored Student & Staff Buses';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'Bhabha University operates a dedicated, highly organized fleet of over <strong>50+ university buses</strong> managed by experienced transport coordinators. The transport facility provides safe, punctual, and economical travel for day scholars and staff members living across Bhopal and surrounding suburbs.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'With pick-up and drop-off points strategically located across prime residential sectors, bus terminals, and railway junctions, students reach campus with zero commuting stress, well ahead of morning lecture bells.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-map-marker', 'title' => 'GPS Fleet Tracking', 'desc' => 'Every bus is equipped with automated GPS tracking units and speed limit governors ensuring controlled and monitored transit.'],
  ['icon' => 'fa-shield', 'title' => 'Strict Safety Protocol', 'desc' => 'Full compliance with RTO safety norms, verified experienced drivers, emergency exits, and onboard first-aid kits on every vehicle.'],
  ['icon' => 'fa-clock-o', 'title' => 'Punctual Daily Schedule', 'desc' => 'Precise route scheduling tailored to university class timings, laboratory practical shifts, and special exam timetables.'],
  ['icon' => 'fa-ticket', 'title' => 'RFID Digital Bus Pass', 'desc' => 'Simple online seat booking and RFID-enabled digital bus passes issued annually with subsidized route tariffs.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Major Bus Routes & Key Stops';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Transport Cell Helpline';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Have route inquiries or need help with your bus pass? Call 0755-4246498 or submit an online request.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Apply Online';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'enquiry.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Safe, punctual, and extensive university transportation fleet connecting Bhopal, Sehore, Mandideep, and nearby regions to Bhabha University campus. Explore bus routes, schedules, and pass fees.">
<meta name="keywords" content="Bhabha University bus routes, college transportation Bhopal, student bus pass, campus transport Bhabha University">
<?php include('inc.meta.php'); ?>
<style>
.bu-trans-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-trans-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-trans-card:hover {
  transform: translateY(-4px);
  border-color: #FFC107;
  box-shadow: 0 12px 28px rgba(10,27,84,0.12);
}
.bu-trans-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  color: #FFC107;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-trans-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-trans-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-route-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 16px;
  margin-top: 20px;
}
.bu-route-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-left: 4px solid #0A1B54;
  border-radius: 8px;
  padding: 18px 20px;
  transition: all 0.2s ease;
}
.bu-route-box:hover {
  border-left-color: #FFC107;
  background: #ffffff;
  box-shadow: 0 6px 18px rgba(10,27,84,0.08);
}
.bu-route-title {
  font-size: 15px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 6px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-route-stops {
  font-size: 12.5px;
  color: #64748B;
  line-height: 1.5;
  margin: 0;
}
.bu-trans-banner-cta {
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
    <?php $active_page = 'transportation'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/1861bfeabedd25b52f2192d45a03c7f7.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Fleet Features Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Safety &amp; Reliability</span>
        <h2 class="bu-content-h2">Key Features of <em>Our Bus Service</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-trans-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-trans-card">
            <div class="bu-trans-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-bus'); ?>"></i></div>
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
        <!-- Section 3: Popular Bus Routes (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Citywide Coverage</span>
          <h2 class="bu-content-h2">Major Bus Routes &amp; <em>Key Stops</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>Below is an overview of major arterial bus corridors operated by the university daily:</p>

            <div class="bu-route-list">
              <div class="bu-route-box">
                <div class="bu-route-title">
                  <span>Route 1: MP Nagar &amp; New Market</span>
                  <span class="badge" style="background:#0A1B54; color:#FFC107;">Line A</span>
                </div>
                <p class="bu-route-stops"><strong>Stops:</strong> Roshanpura › New Market › Mata Mandir › MP Nagar Zone 1 &amp; 2 › Chetak Bridge › Campus</p>
              </div>

              <div class="bu-route-box">
                <div class="bu-route-title">
                  <span>Route 2: Kolar Road &amp; Chunabhatti</span>
                  <span class="badge" style="background:#0A1B54; color:#FFC107;">Line B</span>
                </div>
                <p class="bu-route-stops"><strong>Stops:</strong> Sarvadharma › Nayapura › Kolar Tiraha › Chunabhatti › Shahpura › 11 No. Stop › Campus</p>
              </div>

              <div class="bu-route-box">
                <div class="bu-route-title">
                  <span>Route 3: BHEL, Indrapuri &amp; Ayodhya</span>
                  <span class="badge" style="background:#0A1B54; color:#FFC107;">Line C</span>
                </div>
                <p class="bu-route-stops"><strong>Stops:</strong> Ayodhya Bypass › Piplani › Indrapuri › BHEL Gate No. 1 › Govindpura › AIIMS Bhopal › Campus</p>
              </div>

              <div class="bu-route-box">
                <div class="bu-route-title">
                  <span>Route 4: Lalghati &amp; Bairagarh</span>
                  <span class="badge" style="background:#0A1B54; color:#FFC107;">Line D</span>
                </div>
                <p class="bu-route-stops"><strong>Stops:</strong> Bairagarh Chouraha › Lalghati › Koh-e-Fiza › VIP Road › Poly Square › Jahangirabad › Campus</p>
              </div>

              <div class="bu-route-box">
                <div class="bu-route-title">
                  <span>Route 5: Hoshangabad Rd &amp; Mandideep</span>
                  <span class="badge" style="background:#0A1B54; color:#FFC107;">Line E</span>
                </div>
                <p class="bu-route-stops"><strong>Stops:</strong> Mandideep Bus Stand › Indus Towne › 11th Mile › Ratanpur › Misrod › Bagmugalia › Campus</p>
              </div>

              <div class="bu-route-box">
                <div class="bu-route-title">
                  <span>Route 6: Sehore Outstation Express</span>
                  <span class="badge" style="background:#0A1B54; color:#FFC107;">Line F</span>
                </div>
                <p class="bu-route-stops"><strong>Stops:</strong> Sehore Bus Stand › Crescent Resort Tiraha › Phanda › Khajuri › Bairagarh Chichali › Campus</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 4: Pass Procedure & Helpdesk -->
        <div class="bu-content-card">
          <span class="bu-content-label">Bus Pass Registration</span>
          <h2 class="bu-content-h2">How to Apply for a <em>Bus Pass</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>
              Students wishing to avail of transport services can apply during admission counseling or via the Student ERP Portal:
            </p>
            <ol style="padding-left:20px; line-height:1.8; color:#475569;">
              <li>Fill the Transportation Application Form at the Transport Cell (Admin Block, Ground Floor) or on the student ERP.</li>
              <li>Select your nearest verified pickup stop from the route roster.</li>
              <li>Submit the annual/semester transport fee receipt and collect your digital RFID Bus Pass.</li>
            </ol>
          </div>
        </div>
      <?php endif; ?>

      <!-- Transport CTA Banner -->
      <div class="bu-trans-banner-cta">
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
