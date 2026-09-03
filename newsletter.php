<?php 
include_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>E-Newsletter &amp; Quarterly Digest - Bhabha University</title>
<meta name="description" content="Read the official Bhabha University E-Newsletter and quarterly digests featuring campus news, research discoveries, academic achievements, and student milestones.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   E-NEWSLETTER PAGE STYLES
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

.bu-newslet-wrap {
  background: #F8FAFC;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 50px 20px 80px;
  clear: both !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
}
.bu-newslet-container {
  max-width: 1200px;
  margin: 0 auto;
}

/* Featured Current Issue Card */
.bu-feat-nl-card {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 60%, #051235 100%);
  border-radius: 18px;
  padding: 40px 45px;
  color: #ffffff;
  display: flex;
  align-items: center;
  gap: 40px;
  margin-bottom: 50px;
  box-shadow: 0 14px 35px rgba(10,27,84,0.18);
  position: relative;
  overflow: hidden;
}
.bu-feat-nl-card::after {
  content: '';
  position: absolute;
  top: -50px; right: -50px;
  width: 250px; height: 250px;
  border-radius: 50%;
  background: rgba(255,193,7,0.08);
  pointer-events: none;
}
.bu-feat-nl-cover {
  width: 200px;
  min-height: 260px;
  background: #ffffff;
  border-radius: 12px;
  padding: 16px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 10px 25px rgba(0,0,0,0.25);
  flex-shrink: 0;
  border: 2px solid rgba(255,193,7,0.4);
  color: var(--bu-navy);
  text-align: center;
}
.bu-feat-nl-cover .cover-badge {
  background: #DC2626;
  color: #fff;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 4px 8px;
  border-radius: 4px;
  display: inline-block;
  align-self: center;
}
.bu-feat-nl-cover .cover-logo {
  max-width: 70px;
  margin: 10px auto;
}
.bu-feat-nl-cover .cover-title {
  font-family: 'Playfair Display', serif;
  font-size: 16px;
  font-weight: 800;
  line-height: 1.2;
  color: var(--bu-navy);
  margin: 5px 0;
}
.bu-feat-nl-cover .cover-vol {
  font-size: 11px;
  color: #64748B;
  font-weight: 600;
  border-top: 1px solid #E2E8F0;
  padding-top: 6px;
}

.bu-feat-nl-info {
  flex: 1;
}
.bu-feat-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255,193,7,0.18);
  border: 1px solid rgba(255,193,7,0.4);
  color: #FFC107;
  font-size: 12px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 5px 14px;
  border-radius: 50px;
  margin-bottom: 12px;
}
.bu-feat-nl-info h2 {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 10px;
  line-height: 1.3;
}
.bu-feat-nl-info p {
  color: rgba(255,255,255,0.85);
  font-size: 14.5px;
  line-height: 1.65;
  margin-bottom: 20px;
}
.bu-feat-highlights {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px 20px;
  margin-bottom: 25px;
}
.bu-feat-highlights li {
  list-style: none;
  font-size: 13.5px;
  color: rgba(255,255,255,0.9);
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-feat-highlights li i {
  color: #FFC107;
  font-size: 14px;
}
.bu-feat-actions {
  display: flex;
  align-items: center;
  gap: 15px;
  flex-wrap: wrap;
}
.bu-btn-gold {
  background: #FFC107;
  color: #0A1B54;
  font-weight: 800;
  font-size: 13.5px;
  padding: 12px 26px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s;
  box-shadow: 0 4px 15px rgba(255,193,7,0.3);
}
.bu-btn-gold:hover {
  background: #ffffff;
  color: #0A1B54;
  transform: translateY(-2px);
}
.bu-btn-outline-white {
  background: transparent;
  color: #ffffff;
  border: 1.5px solid rgba(255,255,255,0.4);
  font-weight: 700;
  font-size: 13.5px;
  padding: 11px 22px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s;
}
.bu-btn-outline-white:hover {
  border-color: #ffffff;
  background: rgba(255,255,255,0.1);
  color: #ffffff;
}

/* Section Headings */
.bu-sec-header {
  text-align: center;
  margin-bottom: 35px;
}
.bu-sec-badge {
  display: inline-block;
  background: var(--bu-gold-light);
  border: 1px solid rgba(217,155,0,0.3);
  color: var(--bu-gold-dark);
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 4px 14px;
  border-radius: 50px;
  margin-bottom: 8px;
}
.bu-sec-heading {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 8px;
}
.bu-sec-sub {
  color: var(--bu-text-muted);
  font-size: 14px;
  max-width: 600px;
  margin: 0 auto;
}

/* Newsletter Archive Grid */
.bu-nl-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 25px;
  margin-bottom: 50px;
}
.bu-nl-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  transition: all 0.25s ease;
  box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.bu-nl-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(10,27,84,0.08);
  border-color: #CBD5E1;
}
.bu-nl-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}
.bu-nl-vol {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: var(--bu-navy);
  background: #EEF2FF;
  padding: 3px 10px;
  border-radius: 4px;
}
.bu-nl-date {
  font-size: 12px;
  font-weight: 600;
  color: var(--bu-text-muted);
}
.bu-nl-title {
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 10px;
  line-height: 1.35;
}
.bu-nl-topics {
  list-style: none;
  padding: 0;
  margin: 0 0 20px;
  flex: 1;
}
.bu-nl-topics li {
  font-size: 13px;
  color: var(--bu-text-dark);
  padding: 4px 0 4px 16px;
  position: relative;
  line-height: 1.45;
}
.bu-nl-topics li::before {
  content: '•';
  position: absolute;
  left: 4px;
  color: var(--bu-gold-dark);
  font-weight: 900;
  font-size: 15px;
}
.bu-nl-footer {
  border-top: 1px solid #F1F5F9;
  padding-top: 15px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-nl-size {
  font-size: 12px;
  color: var(--bu-text-muted);
  font-weight: 500;
}
.bu-nl-btn-dl {
  background: var(--bu-navy);
  color: #ffffff;
  font-size: 12.5px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 6px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.2s;
}
.bu-nl-btn-dl:hover {
  background: var(--bu-navy-light);
  color: var(--bu-gold);
}

/* Subscribe & Editorial Box */
.bu-subscribe-box {
  background: #ffffff;
  border: 1.5px dashed #CBD5E1;
  border-radius: 16px;
  padding: 35px 40px;
  text-align: center;
  max-width: 800px;
  margin: 0 auto;
}
.bu-subscribe-box h3 {
  font-size: 20px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 6px;
}
.bu-subscribe-box p {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  margin: 0 0 20px;
}
.bu-sub-form {
  display: flex;
  max-width: 500px;
  margin: 0 auto;
  gap: 8px;
}
.bu-sub-input {
  flex: 1;
  height: 46px;
  border: 1.5px solid #CBD5E1;
  border-radius: 8px;
  padding: 0 16px;
  font-size: 14px;
  outline: none;
}
.bu-sub-input:focus {
  border-color: var(--bu-navy);
}
.bu-sub-btn {
  background: var(--bu-navy);
  color: var(--bu-gold);
  border: none;
  font-weight: 800;
  font-size: 13.5px;
  padding: 0 24px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s;
}
.bu-sub-btn:hover {
  background: var(--bu-navy-light);
  color: #fff;
}

@media (max-width: 768px) {
  .bu-feat-nl-card { flex-direction: column; padding: 25px 20px; text-align: center; }
  .bu-feat-highlights { grid-template-columns: 1fr; }
  .bu-sub-form { flex-direction: column; }
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- INNER HERO BANNER -->
  <?php
  $page_title    = 'E-Newsletter <em>&amp; Quarterly Digest</em>';
  $page_subtitle = 'Official electronic newsletters of Bhabha University — Celebrating academic excellence, research milestones, campus chronicles, and student achievements.';
  $page_icon     = 'fa-newspaper-o';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Publications', 'url' => href('research.php#media-publications')],
    ['label' => 'E-Newsletter', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-newslet-wrap">
    <div class="bu-newslet-container">

      <!-- 1. FEATURED CURRENT ISSUE -->
      <div class="bu-feat-nl-card">
        <div class="bu-feat-nl-cover">
          <span class="cover-badge">LATEST RELEASE</span>
          <img src="<?php echo URL_IMG;?>Bhabha university logo.png" alt="BU Logo" class="cover-logo" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
          <div class="cover-title">BHABHA CHRONICLE</div>
          <div class="cover-vol">Vol. 6 | Issue 2 (Apr – Jun 2026)</div>
        </div>

        <div class="bu-feat-nl-info">
          <div class="bu-feat-pill">
            <i class="fa fa-star"></i> Featured Current Edition
          </div>
          <h2>Bhabha Chronicle — Q2 2026 Edition</h2>
          <p>
            Dive into the latest quarterly happenings across all 11 constituent institutes of Bhabha University, featuring major commercial research launches, international academic collaborations, NAAC updates, and our highest placement records.
          </p>

          <ul class="bu-feat-highlights">
            <li><i class="fa fa-check-circle"></i> Launch of 14 Commercial Herbal Formulations (15th August)</li>
            <li><i class="fa fa-check-circle"></i> Record campus placement offers with TCS, Infosys, Sun Pharma</li>
            <li><i class="fa fa-check-circle"></i> Inauguration of New AI &amp; Robotics Centre of Excellence</li>
            <li><i class="fa fa-check-circle"></i> Faculty patent grants in advanced drug delivery systems</li>
          </ul>

          <div class="bu-feat-actions">
            <a href="<?php echo URL_UPLOAD;?>research/overview.pdf" target="_blank" class="bu-btn-gold">
              <i class="fa fa-file-pdf-o"></i> Read Current Issue (PDF)
            </a>
            <a href="<?php echo href('news.php'); ?>" class="bu-btn-outline-white">
              <i class="fa fa-calendar"></i> Campus News Feed
            </a>
          </div>
        </div>
      </div>

      <!-- 2. NEWSLETTER ARCHIVES -->
      <div class="bu-sec-header">
        <span class="bu-sec-badge"><i class="fa fa-archive"></i> Archive Collection</span>
        <h2 class="bu-sec-heading">Quarterly Newsletter Archives</h2>
        <p class="bu-sec-sub">Browse and download past editions of the official Bhabha University E-Newsletter.</p>
      </div>

      <div class="bu-nl-grid">

        <!-- Issue 1 -->
        <div class="bu-nl-card">
          <div class="bu-nl-header">
            <span class="bu-nl-vol">Vol. 6 | Issue 1</span>
            <span class="bu-nl-date">Jan – Mar 2026</span>
          </div>
          <h3 class="bu-nl-title">New Horizons in Innovation &amp; Academic Milestones</h3>
          <ul class="bu-nl-topics">
            <li>National Conference on Smart Computing &amp; IoT Solutions</li>
            <li>Annual Sports Meet &amp; Cultural Fest 'Tarang 2026'</li>
            <li>Launch of Entrepreneurship &amp; Incubation EDC Cell</li>
          </ul>
          <div class="bu-nl-footer">
            <span class="bu-nl-size"><i class="fa fa-file-text-o"></i> 16 Pages &bull; PDF</span>
            <a href="<?php echo URL_UPLOAD;?>research/overview.pdf" target="_blank" class="bu-nl-btn-dl">
              <i class="fa fa-download"></i> Download
            </a>
          </div>
        </div>

        <!-- Issue 2 -->
        <div class="bu-nl-card">
          <div class="bu-nl-header">
            <span class="bu-nl-vol">Vol. 5 | Issue 4</span>
            <span class="bu-nl-date">Oct – Dec 2025</span>
          </div>
          <h3 class="bu-nl-title">Convocation Special &amp; Industry Collaboration Report</h3>
          <ul class="bu-nl-topics">
            <li>5th Annual University Convocation &amp; Gold Medalists</li>
            <li>MOU Signing with leading pharmaceutical &amp; IT giants</li>
            <li>Winter Faculty Development Programme (FDP) outcomes</li>
          </ul>
          <div class="bu-nl-footer">
            <span class="bu-nl-size"><i class="fa fa-file-text-o"></i> 20 Pages &bull; PDF</span>
            <a href="<?php echo URL_UPLOAD;?>research/overview.pdf" target="_blank" class="bu-nl-btn-dl">
              <i class="fa fa-download"></i> Download
            </a>
          </div>
        </div>

        <!-- Issue 3 -->
        <div class="bu-nl-card">
          <div class="bu-nl-header">
            <span class="bu-nl-vol">Vol. 5 | Issue 3</span>
            <span class="bu-nl-date">Jul – Sep 2025</span>
          </div>
          <h3 class="bu-nl-title">Pharmacy Research &amp; Healthcare Outreach Focus</h3>
          <ul class="bu-nl-topics">
            <li>Community Health Camps conducted across Bhopal district</li>
            <li>International Pharmacy Week &amp; Clinical Trial Workshop</li>
            <li>Student innovators receive State Science Council Grant</li>
          </ul>
          <div class="bu-nl-footer">
            <span class="bu-nl-size"><i class="fa fa-file-text-o"></i> 18 Pages &bull; PDF</span>
            <a href="<?php echo URL_UPLOAD;?>research/overview.pdf" target="_blank" class="bu-nl-btn-dl">
              <i class="fa fa-download"></i> Download
            </a>
          </div>
        </div>

        <!-- Issue 4 -->
        <div class="bu-nl-card">
          <div class="bu-nl-header">
            <span class="bu-nl-vol">Vol. 5 | Issue 2</span>
            <span class="bu-nl-date">Apr – Jun 2025</span>
          </div>
          <h3 class="bu-nl-title">Engineering Innovations &amp; Smart Campus Upgrades</h3>
          <ul class="bu-nl-topics">
            <li>Solar-powered green campus initiative completion</li>
            <li>Hackathon 2025 winners develop Agriculture IoT kit</li>
            <li>Alumni Mentorship series conducted across all departments</li>
          </ul>
          <div class="bu-nl-footer">
            <span class="bu-nl-size"><i class="fa fa-file-text-o"></i> 16 Pages &bull; PDF</span>
            <a href="<?php echo URL_UPLOAD;?>research/overview.pdf" target="_blank" class="bu-nl-btn-dl">
              <i class="fa fa-download"></i> Download
            </a>
          </div>
        </div>

        <!-- Issue 5 -->
        <div class="bu-nl-card">
          <div class="bu-nl-header">
            <span class="bu-nl-vol">Vol. 5 | Issue 1</span>
            <span class="bu-nl-date">Jan – Mar 2025</span>
          </div>
          <h3 class="bu-nl-title">Academic Year Kickoff &amp; Placement Milestones</h3>
          <ul class="bu-nl-topics">
            <li>Orientation of 2025 academic batch across 50+ courses</li>
            <li>Over 850 campus placement offers recorded in Phase 1</li>
            <li>IQAC quality enhancement framework rollout</li>
          </ul>
          <div class="bu-nl-footer">
            <span class="bu-nl-size"><i class="fa fa-file-text-o"></i> 14 Pages &bull; PDF</span>
            <a href="<?php echo URL_UPLOAD;?>research/overview.pdf" target="_blank" class="bu-nl-btn-dl">
              <i class="fa fa-download"></i> Download
            </a>
          </div>
        </div>

        <!-- Issue 6 -->
        <div class="bu-nl-card">
          <div class="bu-nl-header">
            <span class="bu-nl-vol">Vol. 4 | Special Issue</span>
            <span class="bu-nl-date">Annual Roundup 2024</span>
          </div>
          <h3 class="bu-nl-title">20 Years of Educational Excellence — 2004 to 2024</h3>
          <ul class="bu-nl-topics">
            <li>Two-decade institutional milestone commemorative report</li>
            <li>Notable Alumni hall of fame &amp; global contributions</li>
            <li>Strategic 2030 vision roadmap of Bhabha University</li>
          </ul>
          <div class="bu-nl-footer">
            <span class="bu-nl-size"><i class="fa fa-file-text-o"></i> 32 Pages &bull; PDF</span>
            <a href="<?php echo URL_UPLOAD;?>research/overview.pdf" target="_blank" class="bu-nl-btn-dl">
              <i class="fa fa-download"></i> Download
            </a>
          </div>
        </div>

      </div>

      <!-- 3. SUBSCRIBE TO FUTURE EDITIONS -->
      <div class="bu-subscribe-box">
        <i class="fa fa-envelope-o" style="font-size:32px;color:var(--bu-gold-dark);margin-bottom:10px;"></i>
        <h3>Subscribe to Bhabha University E-Newsletter</h3>
        <p>Get quarterly academic digests, research breakthroughs, and campus notifications delivered straight to your email.</p>
        <form class="bu-sub-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing! You will receive our next quarterly edition.'); this.reset();">
          <input type="email" placeholder="Enter your email address..." class="bu-sub-input" required>
          <button type="submit" class="bu-sub-btn">Subscribe</button>
        </form>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- Scripts -->
<?php include('inc.footer.js.php');?>
</body>
</html>
