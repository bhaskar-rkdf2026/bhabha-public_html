<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Media &amp; Communication - Bhabha University Bhopal</title>
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
.bu-radio-spotlight-box {
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
  $page_title    = 'Student Media &amp; <em>Communication</em>';
  $page_subtitle = 'Amplifying the creative voice of Bhabha University — featuring Radio Popcorn 90.4 FM (first campus radio in MP), Campus Pulse newsletter, podcast studio, and digital media journalism.';
  $page_icon     = 'fa-bullhorn';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Student Media & Communication', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'student-media'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Creative Expression &amp; Journalism</span>
        <h2 class="bu-content-h2">The Voice of <em>Bhabha Campus</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/9d2419cc88e43953ae02ef09e8d0bd2c.jpg" alt="Bhabha University Community Radio Popcorn 90.8 FM" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-microphone"></i> Bhabha University Community Radio Station 90.8 FM &amp; Media Studio
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            At Bhabha University, students possess vibrant avenues to broadcast their voices, hone multimedia storytelling skills, write impactful investigative stories, and produce professional audio-visual content.
          </p>
          <p>
            Our premier media pride is <strong>Radio Popcorn 90.4 FM</strong> — the first recognized Community Radio Station established by a private educational institution in Madhya Pradesh, broadcasting 10 hours daily to a listening radius of over 25+ kilometers.
          </p>
        </div>
      </div>

      <!-- Section 2: Media Divisions Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Broadcasting &amp; Press</span>
        <h2 class="bu-content-h2">Student Media <em>Divisions &amp; Channels</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-media-grid">
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="fa fa-microphone"></i></div>
            <h4>Radio Popcorn 90.4 FM</h4>
            <p>Student RJs host live talk shows, health awareness interviews, career podcasts, and youth music countdowns reaching over 100,000 citizens in Bhopal.</p>
          </div>
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="fa fa-newspaper-o"></i></div>
            <h4>"Campus Pulse" E-Newsletter</h4>
            <p>Quarterly digital student publication documenting department triumphs, research breakthroughs, campus fashion, and creative literary essays.</p>
          </div>
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="fa fa-video-camera"></i></div>
            <h4>Digital Studio &amp; Podcasts</h4>
            <p>Acoustic studio with 4K recording cameras, condenser mics, and multi-track mixers for student podcast series and YouTube educational shorts.</p>
          </div>
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="fa fa-bullhorn"></i></div>
            <h4>AD-MAD &amp; PR Cell</h4>
            <p>Student creative agency handling event promotion, social media reels, graphic banners, and brand management for university festivals.</p>
          </div>
        </div>
      </div>

      <!-- Section 3: Radio Popcorn Feature -->
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

        <div class="bu-dark-cta" style="background:linear-gradient(135deg, #051235 0%, #0A1B54 60%, #162B75 100%) !important;">
          <div>
            <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-podcast text-warning mr-2"></i> Listen to Radio Popcorn 90.8 FM</h3>
            <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;">Explore studio archives, RJ schedule, and audio episodes on our dedicated radio page.</p>
          </div>
          <div>
            <a href="<?php echo href('radio.php'); ?>" class="bu-btn-primary" style="white-space:nowrap;">Visit Radio 90.8 FM Page <i class="fa fa-arrow-right"></i></a>
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
