<?php 
include('config.php'); 

// Dynamic CMS query
$dbPage = $db->where('page_key', 'cafeteria')->getOne('site_portal_pages');
$dbContent = !empty($dbPage['content_data']) ? json_decode($dbPage['content_data'], true) : [];

$page_title_raw = !empty($dbPage['page_title']) ? $dbPage['page_title'] : 'Cafeteria & Food Court - Bhabha University Bhopal';
$page_badge     = !empty($dbPage['badge']) ? $dbPage['badge'] : 'Dining & Refreshment';
$page_heading   = !empty($dbPage['heading']) ? $dbPage['heading'] : 'Central Cafeteria & <em>Dining Hubs</em>';
$page_sub       = !empty($dbPage['subheading']) ? $dbPage['subheading'] : 'Nutritious, hygienic, and multi-cuisine culinary hubs across campus — from freshly prepared North & South Indian meals to bakery snacks, juice bars, and coffee corners.';
$page_icon      = !empty($dbContent['page_icon']) ? normFa($dbContent['page_icon']) : 'fa-cutlery';

$featured_img   = !empty($dbContent['featured_image']) ? (strpos($dbContent['featured_image'], 'upload/') === 0 ? URL_ROOT . $dbContent['featured_image'] : URL_UPLOAD . $dbContent['featured_image']) : URL_UPLOAD . 'infrastructure/3864d09b8c0761c29ab3d67b49585238.jpg';
$img_caption    = !empty($dbContent['image_caption']) ? $dbContent['image_caption'] : 'Bhabha University Campus Canteen & Multi-Cuisine Food Court';
$overview_lead  = !empty($dbContent['overview_lead']) ? $dbContent['overview_lead'] : 'At Bhabha University, good food and good health go hand-in-hand. The <strong>Central Campus Food Court</strong> spans a vibrant, airy 500-seater dining complex designed to provide students, faculty, and visiting guests with high-quality, delicious, and balanced meals throughout the day.';
$overview_p2    = !empty($dbContent['overview_p2']) ? $dbContent['overview_p2'] : 'Operating from <strong>8:00 AM to 8:30 PM</strong>, the cafeteria serves as one of the most animated and sociable hubs on campus — an ideal spot for lively debates over coffee, project brainstorming sessions, or unwinding between lectures.';

$features       = !empty($dbContent['features']) ? $dbContent['features'] : [
  ['icon' => 'fa-certificate', 'title' => 'FSSAI Certified Hygiene', 'desc' => 'Strict food safety compliance, regular surprise health audits, and commercial stainless steel cooking equipment ensure impeccable hygiene.'],
  ['icon' => 'fa-tint', 'title' => 'RO Purified Water', 'desc' => '100% of food preparation and public drinking water points utilize advanced industrial RO filtration and UV purification systems.'],
  ['icon' => 'fa-coffee', 'title' => 'Nescafe & Tea Lounges', 'desc' => 'Branded kiosks offering espresso coffees, iced beverages, flavored teas, and grab-and-go energy snacks across prime academic blocks.'],
  ['icon' => 'fa-money', 'title' => 'Subsidized Student Pricing', 'desc' => 'University-monitored price caps maintain affordable rates for wholesome daily thalis, combos, and fresh seasonal snacks.']
];

$detail_title   = !empty($dbContent['detail_title']) ? $dbContent['detail_title'] : 'Diverse Culinary Options Available';
$detail_rich    = !empty($dbContent['detail_rich']) ? $dbContent['detail_rich'] : '';

$cta_title      = !empty($dbContent['cta_title']) ? $dbContent['cta_title'] : 'Have Dining Suggestions or Feedback?';
$cta_desc       = !empty($dbContent['cta_desc']) ? $dbContent['cta_desc'] : 'Contact the Campus Hospitality & Canteen Committee for catering services or meal plan queries.';
$cta_btn_text   = !empty($dbContent['cta_btn_text']) ? $dbContent['cta_btn_text'] : 'Contact Us';
$cta_btn_url    = !empty($dbContent['cta_btn_url']) ? $dbContent['cta_btn_url'] : 'contact.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo strip_tags($page_title_raw); ?> - Bhabha University Bhopal</title>
<meta name="description" content="Experience multi-cuisine, hygienic, and affordable dining at Bhabha University Bhopal Cafeteria & Food Court. Features diverse food outlets, fresh juice counters, and Nescafe kiosks.">
<meta name="keywords" content="Bhabha University cafeteria, campus canteen Bhopal, food court, university dining, student mess Bhabha">
<?php include('inc.meta.php'); ?>
<style>
.bu-cafe-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-cafe-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-cafe-card:hover {
  transform: translateY(-4px);
  border-color: #FFC107;
  box-shadow: 0 12px 28px rgba(10,27,84,0.12);
}
.bu-cafe-icon {
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
.bu-cafe-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-cafe-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-menu-showcase {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
  margin-top: 20px;
}
.bu-menu-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 18px 16px;
  text-align: center;
  transition: all 0.2s ease;
}
.bu-menu-item:hover {
  background: #FFFDF0;
  border-color: #FFC107;
  transform: translateY(-2px);
}
.bu-menu-item i {
  font-size: 24px;
  color: #D99B00;
  margin-bottom: 8px;
}
.bu-menu-item h5 {
  font-size: 14.5px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 4px;
}
.bu-menu-item span {
  font-size: 12px;
  color: #64748B;
}
.bu-cafe-banner-cta {
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
    <?php $active_page = 'cafeteria'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo htmlspecialchars($page_badge); ?></span>
        <h2 class="bu-content-h2"><?php echo $page_heading; ?></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo $featured_img; ?>" alt="<?php echo htmlspecialchars(strip_tags($page_heading)); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_UPLOAD; ?>infrastructure/3864d09b8c0761c29ab3d67b49585238.jpg';">
          <div class="bu-page-featured-caption">
            <i class="<?php echo $page_icon; ?>"></i> <?php echo htmlspecialchars($img_caption); ?>
          </div>
        </div>

        <div class="bu-content-body">
          <p><?php echo $overview_lead; ?></p>
          <?php if (!empty($overview_p2)): ?><p><?php echo $overview_p2; ?></p><?php endif; ?>
        </div>
      </div>

      <!-- Section 2: Culinary Highlights Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Quality Assured</span>
        <h2 class="bu-content-h2">What Makes Our <em>Food Court Special</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-cafe-grid">
          <?php foreach ($features as $f): ?>
          <div class="bu-cafe-card">
            <div class="bu-cafe-icon"><i class="<?php echo normFa($f['icon'] ?? 'fa-cutlery'); ?>"></i></div>
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
        <!-- Section 3: Cuisine & Menu Spectrum (Default) -->
        <div class="bu-content-card">
          <span class="bu-content-label">Diverse Flavors</span>
          <h2 class="bu-content-h2">Diverse Culinary <em>Options Available</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>The cafeteria features dedicated stalls catering to regional taste preferences and dietary choices:</p>

            <div class="bu-menu-showcase">
              <div class="bu-menu-item">
                <i class="fa fa-cutlery"></i>
                <h5>North Indian Meals</h5>
                <span>Daily Special Thalis, Paneer, Dal Makhani &amp; Rotis</span>
              </div>
              <div class="bu-menu-item">
                <i class="fa fa-circle-o"></i>
                <h5>South Indian Delights</h5>
                <span>Crispy Dosas, Idlis, Vadas &amp; Sambhar</span>
              </div>
              <div class="bu-menu-item">
                <i class="fa fa-bolt"></i>
                <h5>Chinese &amp; Fast Food</h5>
                <span>Noodles, Fried Rice, Manchurian, Rolls &amp; Burgers</span>
              </div>
              <div class="bu-menu-item">
                <i class="fa fa-apple"></i>
                <h5>Fresh Juice &amp; Shakes</h5>
                <span>Seasonal Fruit Juices, Smoothies &amp; Cold Drinks</span>
              </div>
              <div class="bu-menu-item">
                <i class="fa fa-birthday-cake"></i>
                <h5>Bakery &amp; Snacks</h5>
                <span>Patties, Sandwiches, Samosas, Pastries &amp; Cookies</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 4: Safety & Quality Monitoring -->
        <div class="bu-content-card">
          <span class="bu-content-label">Student Governance</span>
          <h2 class="bu-content-h2">Canteen Committee &amp; <em>Feedback</em></h2>
          <div class="bu-content-divider"></div>
          <div class="bu-content-body">
            <p>
              A joint <strong>Canteen Advisory Committee</strong> comprising student representatives, faculty members, and residential wardens meets monthly to review food quality, vendor compliance, price indexes, and hygiene standards.
            </p>
            <div style="background:#F8FAFC; border-left:4px solid #FFC107; padding:16px 20px; border-radius:0 8px 8px 0; margin-top:15px;">
              <p style="margin:0; font-size:14px; color:#1E293B;">
                <strong>Feedback &amp; Suggestions:</strong> Students can drop physical feedback in the canteen suggestion box or send remarks directly to the Student Welfare Office at <a href="mailto:info@bhabhauniversity.edu.in" style="color:#0A1B54; font-weight:700;">info@bhabhauniversity.edu.in</a>.
              </p>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Cafeteria CTA Banner -->
      <div class="bu-cafe-banner-cta">
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
