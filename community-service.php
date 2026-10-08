<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Community Service &amp; Environment - Bhabha University Bhopal</title>
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
.bu-comm-banner {
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
  $page_title    = 'Community Service &amp; <em>Environment</em>';
  $page_subtitle = 'Instilling civic consciousness and sustainable stewardship through National Service Scheme (NSS), green energy, 1101 tree plantation drives, Nav Grah Vatika, and village outreach.';
  $page_icon     = 'fa-leaf';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Community Service & Environment', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'community-service'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Social Impact &amp; Stewardship</span>
        <h2 class="bu-content-h2">Empowering Society &amp; <em>Protecting Nature</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/ed3185628b9828212309305234c8a863.jpg" alt="Bhabha University Green Energy Solar Plant &amp; Campus" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-leaf"></i> Green Energy Solar Power Plant &amp; Environmental Sustainability at Bhabha University
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            At Bhabha University, education goes hand in hand with societal upliftment and environmental responsibility. We actively instill in our scholars the values of compassion, community service, civic consciousness, and ecological sustainability.
          </p>
          <p>
            From village adoption initiatives and rural health awareness campaigns to campus-wide solar power generation and mass tree plantation missions, our students and faculty continually strive to build a cleaner, greener, and more equitable tomorrow.
          </p>
        </div>
      </div>

      <!-- Section 2: Flagship Initiatives Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Key Pillars</span>
        <h2 class="bu-content-h2">Community &amp; Eco <em>Initiatives</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-comm-grid">
          <div class="bu-comm-card">
            <div class="bu-comm-icon"><i class="fa fa-users"></i></div>
            <h4>National Service Scheme (NSS)</h4>
            <p>Active government-recognized NSS unit conducting village youth camps, literacy drives, cleanliness rallies, and hygiene education.</p>
          </div>
          <div class="bu-comm-card">
            <div class="bu-comm-icon"><i class="fa fa-tree"></i></div>
            <h4>"1101 Trees" Plantation Drive</h4>
            <p>Annual mass afforestation commitment planting and adopting over 1,101 native oxygen-rich trees across the campus perimeter.</p>
          </div>
          <div class="bu-comm-card">
            <div class="bu-comm-icon"><i class="fa fa-leaf"></i></div>
            <h4>Nav Grah Herbal Vatika</h4>
            <p>Unique medicinal botanical garden harboring planetary and Ayurvedic flora for herbal research, traditional botany, and nature walks.</p>
          </div>
          <div class="bu-comm-card">
            <div class="bu-comm-icon"><i class="fa fa-tint"></i></div>
            <h4>Rainwater Harvesting &amp; Solar</h4>
            <p>Comprehensive rooftop rainwater harvesting recharge pits and a solar power installation supplying clean green energy to the campus.</p>
          </div>
          <div class="bu-comm-card">
            <div class="bu-comm-icon"><i class="fa fa-heart"></i></div>
            <h4>Mega Blood Donation Camps</h4>
            <p>Annual voluntary donation drives in collaboration with the Indian Red Cross, mobilizing hundreds of units of blood for Bhopal hospitals.</p>
          </div>
          <div class="bu-comm-card">
            <div class="bu-comm-icon"><i class="fa fa-balance-scale"></i></div>
            <h4>Free Legal Aid Clinic</h4>
            <p>Constituent law faculty students and professors provide free legal counseling, dispute mediation, and awareness to underprivileged citizens.</p>
          </div>
        </div>
      </div>

      <!-- Section 3: Village Development & Cleanliness -->
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

        <div class="bu-dark-cta" style="background:linear-gradient(135deg, #051235 0%, #0A1B54 60%, #162B75 100%) !important;">
          <div>
            <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-handshake-o text-warning mr-2"></i> Become an NSS Student Volunteer</h3>
            <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;">Join our active volunteer network, earn NSS certificates, and lead community impact projects.</p>
          </div>
          <div>
            <a href="<?php echo href('clubs.php'); ?>#environment-club" class="bu-btn-primary" style="white-space:nowrap;">Explore Environment Club <i class="fa fa-arrow-right"></i></a>
          </div>
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
