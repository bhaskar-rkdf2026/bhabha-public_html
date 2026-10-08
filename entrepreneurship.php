<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Entrepreneurship &amp; Career Development (EDC) - Bhabha University Bhopal</title>
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
.bu-edc-banner {
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
  $page_title    = 'Entrepreneurship &amp; <em>Career Dev (EDC)</em>';
  $page_subtitle = 'Transforming student ideas into commercial enterprises through incubation workspaces, startup seed funds, patent and IPR facilitation, and industry executive mentorship.';
  $page_icon     = 'fa-rocket';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Entrepreneurship & Career Dev', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'entrepreneurship'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Fostering Innovators &amp; Founders</span>
        <h2 class="bu-content-h2">Entrepreneurship Development <em>Cell (EDC)</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/83e285d874ee031ad471ea4df94a1945.jpg" alt="Bhabha University Innovation &amp; Smart Learning Lab" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-rocket"></i> Bhabha University Entrepreneurship Development Cell &amp; Smart Innovation Hall
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            The <strong>Entrepreneurship Development Cell (EDC) &amp; Incubation Center</strong> at Bhabha University is dedicated to nurturing an entrepreneurial mindset across Engineering, Pharmacy, Management, Information Technology, and Applied Sciences.
          </p>
          <p>
            Rather than just producing job seekers, Bhabha University empowers scholars to become <strong>job creators</strong>. EDC offers complete end-to-end support — from ideation validation, business model canvas drafting, and prototype fabrication to patent filing and seed stage investment pitches.
          </p>
        </div>
      </div>

      <!-- Section 2: Incubation Ecosystem Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Incubation Hub</span>
        <h2 class="bu-content-h2">Startup Support &amp; <em>Incubation Ecosystem</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-edc-grid">
          <div class="bu-edc-card">
            <div class="bu-edc-icon"><i class="fa fa-lightbulb-o"></i></div>
            <h4>Idea Prototyping Labs</h4>
            <p>Access to modern IoT maker labs, 3D printing equipment, simulation software, and specialized testing apparatus to build functional MVPs.</p>
          </div>
          <div class="bu-edc-card">
            <div class="bu-edc-icon"><i class="fa fa-money"></i></div>
            <h4>Seed Funding &amp; Grants</h4>
            <p>Assistance in applying for MSME incubation schemes, MP Startup Policy grants, and university student innovation seed capital.</p>
          </div>
          <div class="bu-edc-card">
            <div class="bu-edc-icon"><i class="fa fa-file-text-o"></i></div>
            <h4>IPR &amp; Patent Guidance</h4>
            <p>Complete legal and technical assistance in conducting patent searches, drafting intellectual property claims, and filing Indian &amp; international patents.</p>
          </div>
          <div class="bu-edc-card">
            <div class="bu-edc-icon"><i class="fa fa-users"></i></div>
            <h4>CXO &amp; Alumni Mentorship</h4>
            <p>Direct 1-on-1 mentorship from successful alumni founders, angel investors, chartered accountants, and senior corporate executives.</p>
          </div>
          <div class="bu-edc-card">
            <div class="bu-edc-icon"><i class="fa fa-briefcase"></i></div>
            <h4>Coworking Incubation Space</h4>
            <p>Furnished air-conditioned startup office cubicles, high-speed Wi-Fi, conference boardrooms, and legal address registration for student enterprises.</p>
          </div>
          <div class="bu-edc-card">
            <div class="bu-edc-icon"><i class="fa fa-bullhorn"></i></div>
            <h4>AD-MAD &amp; Pitch Competitions</h4>
            <p>Regular hackathons, Shark-Tank style pitch sessions, advertising competitions, and business plan showcases with cash prizes.</p>
          </div>
        </div>
      </div>

      <!-- Section 3: Programs & Milestones -->
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

        <div class="bu-dark-cta" style="background:linear-gradient(135deg, #051235 0%, #0A1B54 60%, #162B75 100%) !important;">
          <div>
            <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-rocket text-warning mr-2"></i> Have an Innovative Startup Idea?</h3>
            <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;">Pitch your startup concept to the Bhabha Incubation Cell and receive seed funding support.</p>
          </div>
          <div>
            <a href="<?php echo href('clubs.php'); ?>#edc-cell" class="bu-btn-primary" style="white-space:nowrap;">Register with EDC Cell <i class="fa fa-arrow-right"></i></a>
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
