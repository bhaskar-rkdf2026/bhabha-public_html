<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sports &amp; Fitness Complex - Bhabha University Bhopal</title>
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
  $page_title    = 'Sports &amp; <em>Fitness Complex</em>';
  $page_subtitle = 'Encouraging athletic vigor, sportsmanship, and holistic stamina through tournament-grade cricket grounds, football turfs, basketball courts, synthetic badminton arenas, and modern gymnasiums.';
  $page_icon     = 'fa-futbol-o';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Sports & Fitness', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'sports'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Championing Youth Energy</span>
        <h2 class="bu-content-h2">Sports Culture at <em>Bhabha University</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/08ba91f6cd604afe6629e3c47afc8dfa.jpg" alt="Bhabha University Fitness Gymnasium &amp; Sports Complex" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-futbol-o"></i> Bhabha University Fitness Gymnasium &amp; Multi-Sport Complex
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            Sports and athletic pursuits are central to student life at Bhabha University. We strongly believe that sporting participation builds discipline, resilience, leadership, and emotional balance that enriches academic and professional careers.
          </p>
          <p>
            Spread across extensive open spaces within our 32-acre campus, the university offers state-of-the-art outdoor grounds and well-equipped indoor recreation complexes accommodating casual players and university varsity teams alike.
          </p>
        </div>
      </div>

      <!-- Section 2: Outdoor & Indoor Sports Facilities -->
      <div class="bu-content-card">
        <span class="bu-content-label">Infrastructure</span>
        <h2 class="bu-content-h2">World-Class <em>Sporting Arenas</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-sports-grid">
          <div class="bu-sports-card">
            <div class="bu-sports-icon"><i class="fa fa-futbol-o"></i></div>
            <h4>Full-Size Football Turf</h4>
            <p>Lush, natural grass football field conforming to university tournament specifications with regular inter-college league fixtures.</p>
          </div>
          <div class="bu-sports-card">
            <div class="bu-sports-icon"><i class="fa fa-shield"></i></div>
            <h4>Cricket Grounds &amp; Nets</h4>
            <p>Expansive cricket stadium with professionally curated pitch and dedicated practice net enclosures for batting and bowling drills.</p>
          </div>
          <div class="bu-sports-card">
            <div class="bu-sports-icon"><i class="fa fa-dribbble"></i></div>
            <h4>Outdoor Basketball Arena</h4>
            <p>Regulation-size concrete basketball court with floodlights, spring-loaded hoops, and perimeter spectator seating.</p>
          </div>
          <div class="bu-sports-card">
            <div class="bu-sports-icon"><i class="fa fa-circle-o"></i></div>
            <h4>Volleyball &amp; Throwball Courts</h4>
            <p>Multiple well-maintained clay courts hosting daily evening matches and intra-department tournaments.</p>
          </div>
          <div class="bu-sports-card">
            <div class="bu-sports-icon"><i class="fa fa-trophy"></i></div>
            <h4>Indoor Badminton &amp; TT Complex</h4>
            <p>Multi-court wooden badminton hall and table tennis tables with professional LED lighting for round-the-year play.</p>
          </div>
          <div class="bu-sports-card">
            <div class="bu-sports-icon"><i class="fa fa-heartbeat"></i></div>
            <h4>Modern Gymnasium &amp; Cardio Suite</h4>
            <p>Air-conditioned fitness studio featuring commercial treadmills, cross trainers, multi-gym stations, and certified fitness trainers.</p>
          </div>
        </div>
      </div>

      <!-- Section 3: Annual Khelo Bhabha Championship -->
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

        <div class="bu-sports-banner">
          <div>
            <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-trophy text-warning mr-2"></i> Join University Sports Teams</h3>
            <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;">Are you a state/national level player? Apply for sports trials and scholarship assistance.</p>
          </div>
          <div>
            <a href="<?php echo href('clubs.php'); ?>#khelo-bhabha" class="bu-btn-primary" style="white-space:nowrap;">Join Khelo Bhabha Club <i class="fa fa-arrow-right"></i></a>
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
