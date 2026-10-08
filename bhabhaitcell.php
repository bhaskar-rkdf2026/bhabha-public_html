<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('bhabhaitcell') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Central IT Cell &amp; Digital Services - Bhabha University Bhopal</title>
<meta name="description" content="Official Central IT Cell (CITC) at Bhabha University Bhopal - managing high-speed campus networking, enterprise ERP, web development, smart computing labs, and 24/7 technical helpdesk.">
<meta name="keywords" content="Bhabha University IT Cell, university ERP, web development, campus wifi, computing labs, Rajeev Indoria, tech support Bhopal">
<?php include('inc.meta.php'); ?>
<style>
/* ============================================================
   BHABHA UNIVERSITY - CENTRAL IT CELL (CITC) REDESIGN
   Brand Colors: Navy #0A1B54, Gold #FFC107, Dark Gold #D99B00
   ============================================================ */
:root {
  --bu-citc-navy: #0A1B54;
  --bu-citc-navy-dark: #051235;
  --bu-citc-navy-light: #162B75;
  --bu-citc-gold: #FFC107;
  --bu-citc-gold-dark: #D99B00;
  --bu-citc-bg-soft: #F8FAFC;
  --bu-citc-border: #E2E8F0;
  --bu-citc-text: #1E293B;
  --bu-citc-muted: #64748B;
}

.bu-citc-wrapper {
  background: #F8FAFC;
  padding: 40px 0 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--bu-citc-text);
}
.bu-citc-container {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Stat Ribbon */
.bu-citc-stats-ribbon {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-top: -30px;
  margin-bottom: 45px;
  position: relative;
  z-index: 10;
}
.bu-citc-stat-box {
  background: #ffffff;
  border-radius: 14px;
  padding: 24px 20px;
  box-shadow: 0 10px 25px rgba(10,27,84,0.07);
  border: 1px solid var(--bu-citc-border);
  border-top: 4px solid var(--bu-citc-navy);
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all 0.25s ease;
}
.bu-citc-stat-box:hover {
  transform: translateY(-4px);
  border-top-color: var(--bu-citc-gold);
  box-shadow: 0 16px 32px rgba(10,27,84,0.12);
}
.bu-citc-stat-icon {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  background: linear-gradient(135deg, var(--bu-citc-navy) 0%, var(--bu-citc-navy-light) 100%);
  color: var(--bu-citc-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.bu-citc-stat-number {
  font-size: 24px;
  font-weight: 800;
  color: var(--bu-citc-navy);
  line-height: 1.1;
  margin-bottom: 4px;
}
.bu-citc-stat-label {
  font-size: 13px;
  font-weight: 600;
  color: var(--bu-citc-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Section Header */
.bu-citc-section-header {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 40px;
}
.bu-citc-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(10,27,84,0.08);
  color: var(--bu-citc-navy);
  padding: 6px 16px;
  border-radius: 30px;
  font-size: 12.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 12px;
}
.bu-citc-section-title {
  font-size: 32px;
  font-weight: 800;
  color: var(--bu-citc-navy);
  margin: 0 0 12px;
  line-height: 1.25;
}
.bu-citc-section-title em {
  color: var(--bu-citc-gold-dark);
  font-style: normal;
}
.bu-citc-section-subtitle {
  font-size: 15.5px;
  color: var(--bu-citc-muted);
  line-height: 1.6;
  margin: 0;
}

/* Overview Card */
.bu-citc-overview-card {
  background: #ffffff;
  border-radius: 16px;
  padding: 36px 40px;
  border: 1px solid var(--bu-citc-border);
  box-shadow: 0 8px 24px rgba(10,27,84,0.05);
  margin-bottom: 45px;
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 40px;
  align-items: center;
}
.bu-citc-overview-text h3 {
  font-size: 24px;
  font-weight: 800;
  color: var(--bu-citc-navy);
  margin: 0 0 14px;
}
.bu-citc-overview-text p {
  font-size: 15px;
  line-height: 1.7;
  color: #475569;
  margin-bottom: 16px;
}
.bu-citc-features-list {
  list-style: none;
  padding: 0;
  margin: 20px 0 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}
.bu-citc-features-list li {
  font-size: 14px;
  font-weight: 600;
  color: var(--bu-citc-navy);
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-citc-features-list li i {
  color: #10B981;
  font-size: 15px;
}
.bu-citc-overview-media {
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  border-radius: 14px;
  padding: 24px;
  text-align: center;
  box-shadow: 0 12px 28px rgba(10,27,84,0.15);
  position: relative;
  overflow: hidden;
}
.bu-citc-overview-media img {
  width: 100%;
  max-height: 250px;
  object-fit: cover;
  border-radius: 10px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
  transition: transform 0.3s ease;
}
.bu-citc-overview-media:hover img {
  transform: scale(1.02);
}
.bu-citc-media-caption {
  color: #ffffff;
  font-size: 13.5px;
  margin-top: 14px;
  font-weight: 600;
}

/* Services Grid */
.bu-citc-services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-bottom: 50px;
}
.bu-citc-service-card {
  background: #ffffff;
  border-radius: 14px;
  padding: 30px 26px;
  border: 1px solid var(--bu-citc-border);
  box-shadow: 0 6px 18px rgba(10,27,84,0.04);
  transition: all 0.25s ease;
  position: relative;
  display: flex;
  flex-direction: column;
}
.bu-citc-service-card:hover {
  transform: translateY(-5px);
  border-color: #CBD5E1;
  box-shadow: 0 16px 32px rgba(10,27,84,0.1);
}
.bu-citc-service-icon-wrap {
  width: 56px;
  height: 56px;
  border-radius: 14px;
  background: rgba(10,27,84,0.06);
  color: var(--bu-citc-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin-bottom: 20px;
  transition: all 0.25s ease;
}
.bu-citc-service-card:hover .bu-citc-service-icon-wrap {
  background: var(--bu-citc-navy);
  color: var(--bu-citc-gold);
}
.bu-citc-service-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--bu-citc-navy);
  margin: 0 0 10px;
}
.bu-citc-service-desc {
  font-size: 14px;
  color: var(--bu-citc-muted);
  line-height: 1.6;
  margin-bottom: 18px;
  flex-grow: 1;
}
.bu-citc-service-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  list-style: none;
  padding: 0;
  margin: 0;
}
.bu-citc-service-tags li {
  font-size: 11.5px;
  font-weight: 700;
  padding: 4px 10px;
  background: #F1F5F9;
  color: #334155;
  border-radius: 6px;
}

/* Quick Access Portals */
.bu-citc-portals-section {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 100%);
  border-radius: 18px;
  padding: 44px 36px;
  color: #ffffff;
  margin-bottom: 50px;
  box-shadow: 0 14px 34px rgba(10,27,84,0.18);
}
.bu-citc-portals-header {
  text-align: center;
  max-width: 650px;
  margin: 0 auto 34px;
}
.bu-citc-portals-header h3 {
  font-size: 26px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 8px;
}
.bu-citc-portals-header p {
  font-size: 14.5px;
  color: rgba(255,255,255,0.75);
  margin: 0;
}
.bu-citc-portals-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}
.bu-citc-portal-btn {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 12px;
  padding: 20px;
  color: #ffffff;
  text-decoration: none !important;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all 0.25s ease;
}
.bu-citc-portal-btn:hover {
  background: rgba(255,255,255,0.18);
  border-color: var(--bu-citc-gold);
  transform: translateY(-3px);
  color: #ffffff !important;
}
.bu-citc-portal-btn i {
  font-size: 24px;
  color: var(--bu-citc-gold);
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: rgba(255,193,7,0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.bu-citc-portal-name {
  font-size: 15.5px;
  font-weight: 700;
  margin: 0 0 3px;
  display: block;
}
.bu-citc-portal-sub {
  font-size: 12px;
  color: rgba(255,255,255,0.7);
  display: block;
}

/* Leadership & Team Section */
.bu-citc-team-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  margin-bottom: 50px;
  align-items: stretch;
}
.bu-citc-lead-card {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid var(--bu-citc-border);
  box-shadow: 0 10px 30px rgba(10,27,84,0.06);
  padding: 36px 32px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.bu-citc-lead-header {
  display: flex;
  gap: 24px;
  align-items: center;
  margin-bottom: 22px;
}
.bu-citc-lead-avatar-wrap {
  position: relative;
  flex-shrink: 0;
}
.bu-citc-lead-avatar {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid var(--bu-citc-gold);
  box-shadow: 0 8px 20px rgba(10,27,84,0.15);
  background: #0A1B54;
}
.bu-citc-lead-avatar-badge {
  position: absolute;
  bottom: 0;
  right: 0;
  background: #10B981;
  color: #fff;
  width: 26px;
  height: 26px;
  border-radius: 50%;
  border: 2px solid #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
}
.bu-citc-lead-meta h4 {
  font-size: 22px;
  font-weight: 800;
  color: var(--bu-citc-navy);
  margin: 0 0 6px;
}
.bu-citc-lead-badge {
  display: inline-block;
  background: rgba(217,155,0,0.12);
  color: var(--bu-citc-gold-dark);
  font-size: 12px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 4px 12px;
  border-radius: 20px;
  margin-bottom: 6px;
}
.bu-citc-lead-dept {
  font-size: 13.5px;
  color: var(--bu-citc-muted);
  margin: 0;
}
.bu-citc-lead-bio {
  font-size: 14px;
  color: #475569;
  line-height: 1.65;
  margin-bottom: 22px;
}
.bu-citc-contact-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.bu-citc-contact-list li {
  font-size: 13.5px;
  color: #334155;
  display: flex;
  align-items: center;
  gap: 12px;
  background: #F8FAFC;
  padding: 10px 14px;
  border-radius: 8px;
}
.bu-citc-contact-list li i {
  color: var(--bu-citc-navy);
  font-size: 15px;
  width: 18px;
  text-align: center;
}
.bu-citc-contact-list li a {
  color: var(--bu-citc-navy);
  text-decoration: none;
  font-weight: 600;
}
.bu-citc-contact-list li a:hover {
  color: var(--bu-citc-gold-dark);
  text-decoration: underline;
}

/* Secondary Team Card */
.bu-citc-dept-roles-card {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid var(--bu-citc-border);
  box-shadow: 0 10px 30px rgba(10,27,84,0.06);
  padding: 36px 32px;
}
.bu-citc-dept-roles-card h4 {
  font-size: 20px;
  font-weight: 800;
  color: var(--bu-citc-navy);
  margin: 0 0 18px;
  padding-bottom: 12px;
  border-bottom: 2px solid #F1F5F9;
}
.bu-citc-role-item {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 18px;
  padding-bottom: 18px;
  border-bottom: 1px dashed #E2E8F0;
}
.bu-citc-role-item:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}
.bu-citc-role-icon {
  width: 42px;
  height: 42px;
  border-radius: 10px;
  background: rgba(10,27,84,0.06);
  color: var(--bu-citc-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 17px;
  flex-shrink: 0;
}
.bu-citc-role-details h5 {
  font-size: 15px;
  font-weight: 700;
  color: var(--bu-citc-navy);
  margin: 0 0 3px;
}
.bu-citc-role-details p {
  font-size: 13px;
  color: var(--bu-citc-muted);
  line-height: 1.5;
  margin: 0;
}

/* Guidelines & Helpdesk Two-Column */
.bu-citc-bottom-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
}
.bu-citc-card-white {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid var(--bu-citc-border);
  box-shadow: 0 8px 24px rgba(10,27,84,0.05);
  padding: 34px 30px;
}
.bu-citc-card-white h4 {
  font-size: 20px;
  font-weight: 800;
  color: var(--bu-citc-navy);
  margin: 0 0 18px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-citc-card-white h4 i {
  color: var(--bu-citc-gold-dark);
}
.bu-citc-policy-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.bu-citc-policy-list li {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  font-size: 13.8px;
  line-height: 1.55;
  color: #475569;
}
.bu-citc-policy-list li i {
  color: var(--bu-citc-navy);
  font-size: 15px;
  margin-top: 3px;
  flex-shrink: 0;
}

/* Helpdesk Form */
.bu-citc-form-group {
  margin-bottom: 14px;
}
.bu-citc-form-group label {
  font-size: 13px;
  font-weight: 700;
  color: var(--bu-citc-navy);
  margin-bottom: 5px;
  display: block;
}
.bu-citc-form-control {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid var(--bu-citc-border);
  border-radius: 8px;
  font-size: 13.5px;
  font-family: inherit;
  outline: none;
  transition: border-color 0.2s ease;
  box-sizing: border-box;
}
.bu-citc-form-control:focus {
  border-color: var(--bu-citc-navy);
  box-shadow: 0 0 0 3px rgba(10,27,84,0.1);
}
.bu-citc-submit-btn {
  background: linear-gradient(135deg, var(--bu-citc-navy) 0%, var(--bu-citc-navy-light) 100%);
  color: #ffffff;
  border: none;
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: 700;
  font-size: 14px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.25s ease;
  width: 100%;
  justify-content: center;
}
.bu-citc-submit-btn:hover {
  background: #051235;
  color: var(--bu-citc-gold);
  transform: translateY(-2px);
  box-shadow: 0 8px 18px rgba(10,27,84,0.18);
}
.bu-citc-alert-success {
  display: none;
  background: #ECFDF5;
  border: 1px solid #A7F3D0;
  color: #065F46;
  padding: 12px;
  border-radius: 8px;
  font-size: 13.5px;
  margin-top: 14px;
  text-align: center;
}

/* Responsive Media Queries */
@media (max-width: 991px) {
  .bu-citc-stats-ribbon {
    grid-template-columns: repeat(2, 1fr);
  }
  .bu-citc-overview-card {
    grid-template-columns: 1fr;
    padding: 30px 24px;
  }
  .bu-citc-services-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .bu-citc-portals-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .bu-citc-team-grid {
    grid-template-columns: 1fr;
  }
  .bu-citc-bottom-grid {
    grid-template-columns: 1fr;
  }
}
@media (max-width: 600px) {
  .bu-citc-stats-ribbon {
    grid-template-columns: 1fr;
    margin-top: -20px;
  }
  .bu-citc-services-grid {
    grid-template-columns: 1fr;
  }
  .bu-citc-portals-grid {
    grid-template-columns: 1fr;
  }
  .bu-citc-features-list {
    grid-template-columns: 1fr;
  }
  .bu-citc-lead-header {
    flex-direction: column;
    text-align: center;
  }
  .bu-citc-section-title {
    font-size: 26px;
  }
}
</style>
</head>
<body>
<div class="kode_wrapper">
  <!-- MAIN HEADER -->
  <?php include('inc.header.php'); ?>
  
  <!-- INNER PAGE BANNER -->
  <?php 
  $page_title    = 'Central <em>IT Cell &amp; Digital Services</em>';
  $page_subtitle = 'Powering Bhabha University with robust campus computing, enterprise ERP automation, high-speed optical network, and 24/7 technical support.';
  $page_icon     = 'fa-laptop';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Central IT Cell', 'url' => '#'],
  ];
  include('inc.page-banner.php'); 
  ?>

  <!-- MAIN CITC CONTENT -->
  <div class="bu-citc-wrapper">
    <div class="bu-citc-container">

      <!-- 1. INFRASTRUCTURE AT A GLANCE (STAT RIBBON) -->
      <div class="bu-citc-stats-ribbon">
        <div class="bu-citc-stat-box">
          <div class="bu-citc-stat-icon"><i class="fa fa-wifi"></i></div>
          <div>
            <div class="bu-citc-stat-number">1 Gbps+</div>
            <div class="bu-citc-stat-label">Fiber Leased Line</div>
          </div>
        </div>
        <div class="bu-citc-stat-box">
          <div class="bu-citc-stat-icon"><i class="fa fa-desktop"></i></div>
          <div>
            <div class="bu-citc-stat-number">1,500+</div>
            <div class="bu-citc-stat-label">Networked Workstations</div>
          </div>
        </div>
        <div class="bu-citc-stat-box">
          <div class="bu-citc-stat-icon"><i class="fa fa-cogs"></i></div>
          <div>
            <div class="bu-citc-stat-number">100%</div>
            <div class="bu-citc-stat-label">Automated ERP &amp; SIS</div>
          </div>
        </div>
        <div class="bu-citc-stat-box">
          <div class="bu-citc-stat-icon"><i class="fa fa-shield"></i></div>
          <div>
            <div class="bu-citc-stat-number">24&times;7</div>
            <div class="bu-citc-stat-label">Cyber Threat Shield</div>
          </div>
        </div>
      </div>

      <!-- 2. OVERVIEW & STRATEGIC MISSION -->
      <div class="bu-citc-overview-card">
        <div class="bu-citc-overview-text">
          <span class="bu-citc-badge"><i class="fa fa-terminal"></i> Digital Backbone of Bhabha University</span>
          <h3>Central Information Technology Cell (CITC)</h3>
          <p>
            The <strong>Central IT Cell (CITC)</strong> serves as the technological backbone of Bhabha University Bhopal, orchestrating cutting-edge computational power, resilient campus-wide high-speed networking, integrated enterprise resource planning (ERP), and continuous cyber defence.
          </p>
          <p>
            From streamlining online admissions and digital marksheets to equipping 18+ state-of-the-art computer labs with specialized simulation software, the IT Cell empowers over 10,000+ students, researchers, and faculty members with seamless digital governance.
          </p>

          <ul class="bu-citc-features-list">
            <li><i class="fa fa-check-circle"></i> High-Speed Campus Optical Backbone</li>
            <li><i class="fa fa-check-circle"></i> End-to-End Automated Student ERP</li>
            <li><i class="fa fa-check-circle"></i> ResultSoft Online Exam Processing</li>
            <li><i class="fa fa-check-circle"></i> Next-Gen Hardware &amp; Smart Classrooms</li>
            <li><i class="fa fa-check-circle"></i> Fortinet Unified Threat Management</li>
            <li><i class="fa fa-check-circle"></i> Dedicated Tech Desk &amp; Ticketing Desk</li>
          </ul>
        </div>

        <div class="bu-citc-overview-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/b6123df20111594aa04d8b15dd6ce2af.jpg" alt="Bhabha University Central IT &amp; Server Infrastructure" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_ROOT; ?>images/skill_lab.jpg';">
          <div class="bu-citc-media-caption">
            <i class="fa fa-server"></i> Central Computing Facility, High-Speed Optical Server Node &amp; Digital Portal Hub
          </div>
        </div>
      </div>

      <!-- 3. CORE SERVICES & DIVISIONS -->
      <div class="bu-citc-section-header">
        <span class="bu-citc-badge"><i class="fa fa-cubes"></i> Core Operations</span>
        <h2 class="bu-citc-section-title">Key Divisions &amp; <em>Digital Services</em></h2>
        <p class="bu-citc-section-subtitle">Delivering high-availability enterprise services across software engineering, networking, systems administration, and student support.</p>
      </div>

      <div class="bu-citc-services-grid">
        <!-- Service 1 -->
        <div class="bu-citc-service-card">
          <div class="bu-citc-service-icon-wrap"><i class="fa fa-globe"></i></div>
          <h4 class="bu-citc-service-title">Web Development &amp; Portal Engineering</h4>
          <p class="bu-citc-service-desc">Continuous design, development, and hosting of Bhabha University’s official website, constituent college portals, dynamic admission enquiry engines, and automated notification feeds.</p>
          <ul class="bu-citc-service-tags">
            <li>CMS Architecture</li>
            <li>PHP/MySQL</li>
            <li>Mobile Responsive</li>
            <li>SEO Engine</li>
          </ul>
        </div>

        <!-- Service 2 -->
        <div class="bu-citc-service-card">
          <div class="bu-citc-service-icon-wrap"><i class="fa fa-wifi"></i></div>
          <h4 class="bu-citc-service-title">Enterprise Networking &amp; Campus Wi-Fi</h4>
          <p class="bu-citc-service-desc">Multi-gigabit optical fiber backbone spanning all academic departments, administrative centers, auditoriums, and student hostels with secure VLAN isolation and 1 Gbps redundant leased lines.</p>
          <ul class="bu-citc-service-tags">
            <li>1 Gbps Leased Line</li>
            <li>Wi-Fi 6 APs</li>
            <li>VLAN Segmentation</li>
            <li>Hostel Connectivity</li>
          </ul>
        </div>

        <!-- Service 3 -->
        <div class="bu-citc-service-card">
          <div class="bu-citc-service-icon-wrap"><i class="fa fa-database"></i></div>
          <h4 class="bu-citc-service-title">University ERP &amp; Student Lifecycle (SIS)</h4>
          <p class="bu-citc-service-desc">End-to-end management of digital admissions, fee challan processing, attendance analytics, student profile records, faculty management, and integrated academic workflows.</p>
          <ul class="bu-citc-service-tags">
            <li>Student Information</li>
            <li>Fee Gateway</li>
            <li>Attendance Tracker</li>
            <li>DigiLocker</li>
          </ul>
        </div>

        <!-- Service 4 -->
        <div class="bu-citc-service-card">
          <div class="bu-citc-service-icon-wrap"><i class="fa fa-file-text-o"></i></div>
          <h4 class="bu-citc-service-title">Examination Systems &amp; ResultSoft</h4>
          <p class="bu-citc-service-desc">Automated processing of semester exam enrolments, digital admit card issuance, question paper repository management, and rapid online publication of confidential student results.</p>
          <ul class="bu-citc-service-tags">
            <li>Question Papers</li>
            <li>Online Results</li>
            <li>Admit Cards</li>
            <li>Grade Sheets</li>
          </ul>
        </div>

        <!-- Service 5 -->
        <div class="bu-citc-service-card">
          <div class="bu-citc-service-icon-wrap"><i class="fa fa-lock"></i></div>
          <h4 class="bu-citc-service-title">Cybersecurity &amp; Identity Protection</h4>
          <p class="bu-citc-service-desc">Enterprise Fortinet Next-Gen Firewall implementation, SSL/TLS certificate governance, active malware filtering, anti-spoofing security, and scheduled automated off-site database backups.</p>
          <ul class="bu-citc-service-tags">
            <li>UTM Firewall</li>
            <li>SSL Encryption</li>
            <li>Identity Auth</li>
            <li>Automated Backups</li>
          </ul>
        </div>

        <!-- Service 6 -->
        <div class="bu-citc-service-card">
          <div class="bu-citc-service-icon-wrap"><i class="fa fa-wrench"></i></div>
          <h4 class="bu-citc-service-title">Hardware, Systems &amp; Smart Classrooms</h4>
          <p class="bu-citc-service-desc">Preventive diagnostics and on-site hardware maintenance for 1,500+ desktop workstations, smart classroom interactive interactive screens, digital podiums, and auditorium AV setups.</p>
          <ul class="bu-citc-service-tags">
            <li>18+ Computer Labs</li>
            <li>Smart Podiums</li>
            <li>OS Licensing</li>
            <li>Rapid Repair</li>
          </ul>
        </div>
      </div>

      <!-- 4. QUICK ACCESS PORTALS (STUDENTS & FACULTY) -->
      <div class="bu-citc-portals-section">
        <div class="bu-citc-portals-header">
          <h3><i class="fa fa-external-link text-warning"></i> Quick Access Portals &amp; Systems</h3>
          <p>Instant access to vital digital resources, academic databases, and student computing facilities.</p>
        </div>

        <div class="bu-citc-portals-grid">
          <a href="<?php echo href('online-admission.php'); ?>" class="bu-citc-portal-btn">
            <i class="fa fa-user-plus"></i>
            <div>
              <span class="bu-citc-portal-name">Online Admission Portal</span>
              <span class="bu-citc-portal-sub">New registrations &amp; document status</span>
            </div>
          </a>

          <a href="<?php echo href('fees.php'); ?>" class="bu-citc-portal-btn">
            <i class="fa fa-credit-card"></i>
            <div>
              <span class="bu-citc-portal-name">Online Fee Payment Desk</span>
              <span class="bu-citc-portal-sub">Pay semester fees with instant receipts</span>
            </div>
          </a>

          <a href="<?php echo href('examination.php'); ?>" class="bu-citc-portal-btn">
            <i class="fa fa-graduation-cap"></i>
            <div>
              <span class="bu-citc-portal-name">Examination &amp; Results</span>
              <span class="bu-citc-portal-sub">Semester results, schedules &amp; admit cards</span>
            </div>
          </a>

          <a href="<?php echo href('BUQuestionPapers.php'); ?>" class="bu-citc-portal-btn">
            <i class="fa fa-file-pdf-o"></i>
            <div>
              <span class="bu-citc-portal-name">BU Question Papers Archive</span>
              <span class="bu-citc-portal-sub">Branch-wise previous examination papers</span>
            </div>
          </a>

          <a href="<?php echo href('library.php'); ?>" class="bu-citc-portal-btn">
            <i class="fa fa-book"></i>
            <div>
              <span class="bu-citc-portal-name">Central E-Library (DELNET)</span>
              <span class="bu-citc-portal-sub">OPAC, e-books &amp; national journals</span>
            </div>
          </a>

          <a href="<?php echo href('grievance.php'); ?>" class="bu-citc-portal-btn">
            <i class="fa fa-life-ring"></i>
            <div>
              <span class="bu-citc-portal-name">IT Support &amp; Grievance Portal</span>
              <span class="bu-citc-portal-sub">Lodge technical complaints &amp; Wi-Fi issues</span>
            </div>
          </a>
        </div>
      </div>

      <!-- 5. LEADERSHIP & IT TEAM DIRECTORY -->
      <div class="bu-citc-section-header">
        <span class="bu-citc-badge"><i class="fa fa-users"></i> Technical Team</span>
        <h2 class="bu-citc-section-title">IT Cell Leadership &amp; <em>Staff Directory</em></h2>
        <p class="bu-citc-section-subtitle">Dedicated engineers and technical professionals ensuring zero downtime and seamless university digital operations.</p>
      </div>

      <div class="bu-citc-team-grid">
        <!-- Lead In-Charge Card -->
        <div class="bu-citc-lead-card">
          <div>
            <div class="bu-citc-lead-header">
              <div class="bu-citc-lead-avatar-wrap">
                <img src="<?php echo URL_IMG; ?>web%20developer.jpg" alt="Er. Rajeev Indoria" class="bu-citc-lead-avatar" onerror="this.onerror=null; this.src='<?php echo URL_IMG; ?>favicon.png';">
                <div class="bu-citc-lead-avatar-badge" title="Active Head"><i class="fa fa-check"></i></div>
              </div>
              <div class="bu-citc-lead-meta">
                <span class="bu-citc-lead-badge"><i class="fa fa-shield"></i> Division Head</span>
                <h4>Er. Rajeev Indoria</h4>
                <div style="font-size:14px; font-weight:700; color:#0A1B54; margin-bottom:4px;">Head - Central IT Cell &amp; Lead Web Developer</div>
                <p class="bu-citc-lead-dept">Department of Information Technology &amp; Software Systems, Bhabha University Bhopal</p>
              </div>
            </div>

            <p class="bu-citc-lead-bio">
              Responsible for strategic planning, portal architecture, enterprise database administration, software lifecycle management, and institutional web governance across all constituent institutes of Bhabha University.
            </p>
          </div>

          <ul class="bu-citc-contact-list">
            <li>
              <i class="fa fa-building-o"></i>
              <span><strong>Office:</strong> Central IT Cell, Administrative Block, BU Campus</span>
            </li>
            <li>
              <i class="fa fa-phone"></i>
              <span><strong>Phone / Mobile:</strong> <a href="tel:+919039809598">+91-9039809598</a></span>
            </li>
            <li>
              <i class="fa fa-envelope-o"></i>
              <span><strong>Official Email:</strong> <a href="mailto:rajeev@bhabhauniversity.edu.in">rajeev@bhabhauniversity.edu.in</a></span>
            </li>
            <li>
              <i class="fa fa-clock-o"></i>
              <span><strong>Consultation Hours:</strong> Monday – Saturday, 10:00 AM – 4:00 PM</span>
            </li>
          </ul>
        </div>

        <!-- Department Roles & Team Hierarchy -->
        <div class="bu-citc-dept-roles-card">
          <h4><i class="fa fa-sitemap mr-2 text-warning"></i> Operational Units &amp; Technical Hierarchy</h4>

          <div class="bu-citc-role-item">
            <div class="bu-citc-role-icon"><i class="fa fa-laptop"></i></div>
            <div class="bu-citc-role-details">
              <h5>Software &amp; Web Development Wing</h5>
              <p>Specializes in dynamic portal engineering, responsive UI/UX architectures, security patching, student portal upgrades, and database management.</p>
            </div>
          </div>

          <div class="bu-citc-role-item">
            <div class="bu-citc-role-icon"><i class="fa fa-sitemap"></i></div>
            <div class="bu-citc-role-details">
              <h5>Network &amp; Cybersecurity Operations</h5>
              <p>Oversees campus-wide optical fiber backbones, Wi-Fi 6 access controllers, DNS routing, Fortinet UTM firewall, and 24/7 security event monitoring.</p>
            </div>
          </div>

          <div class="bu-citc-role-item">
            <div class="bu-citc-role-icon"><i class="fa fa-cogs"></i></div>
            <div class="bu-citc-role-details">
              <h5>ERP &amp; Academic Information Systems</h5>
              <p>Administers student enrollment records, automated semester fee collection reconciliations, ResultSoft grade generation, and faculty portals.</p>
            </div>
          </div>

          <div class="bu-citc-role-item">
            <div class="bu-citc-role-icon"><i class="fa fa-wrench"></i></div>
            <div class="bu-citc-role-details">
              <h5>Hardware Engineering &amp; Helpdesk Support</h5>
              <p>Provides rapid-response desktop troubleshooting, lab maintenance across 18+ computing labs, smart classroom audio-visual support, and server diagnostics.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 6. IT POLICY & HELPDESK TICKETING -->
      <div class="bu-citc-bottom-grid">
        <!-- Guidelines Card -->
        <div class="bu-citc-card-white">
          <h4><i class="fa fa-shield"></i> Campus IT &amp; Cyber Hygiene Guidelines</h4>
          <p style="font-size:14px; color:#64748B; margin-bottom:18px;">All students and staff connected to Bhabha University network must adhere to the acceptable computing code:</p>

          <ul class="bu-citc-policy-list">
            <li>
              <i class="fa fa-check-circle-o"></i>
              <span><strong>Authorized Access:</strong> Use only official login credentials for university Wi-Fi and ERP portals. Sharing credentials is strictly prohibited.</span>
            </li>
            <li>
              <i class="fa fa-check-circle-o"></i>
              <span><strong>Network Integrity:</strong> Tampering with campus network switches, access points, or attempting unauthorized port scanning will lead to permanent MAC blocking.</span>
            </li>
            <li>
              <i class="fa fa-check-circle-o"></i>
              <span><strong>Licensed Software:</strong> Use only university-approved software in laboratory environments. Installation of cracked or pirated executables is not permitted.</span>
            </li>
            <li>
              <i class="fa fa-check-circle-o"></i>
              <span><strong>Data Privacy:</strong> Official university data and academic documents should only be handled via authorized institutional email addresses.</span>
            </li>
          </ul>
        </div>

        <!-- Helpdesk & Support Form -->
        <div class="bu-citc-card-white">
          <h4><i class="fa fa-headphones"></i> Central IT Helpdesk &amp; Support Request</h4>
          <p style="font-size:14px; color:#64748B; margin-bottom:18px;">Need assistance with campus Wi-Fi, ERP login, ResultSoft, or lab computers? Lodge a quick support request:</p>

          <form id="citcHelpdeskForm" onsubmit="handleCitcSubmit(event)">
            <div class="bu-citc-form-group">
              <label for="it_user_name">Full Name &amp; Enrollment / Employee ID *</label>
              <input type="text" id="it_user_name" class="bu-citc-form-control" placeholder="e.g. Rahul Sharma (BU22CS012)" required>
            </div>

            <div class="bu-citc-form-group">
              <label for="it_user_contact">Mobile Number / Official Email *</label>
              <input type="text" id="it_user_contact" class="bu-citc-form-control" placeholder="e.g. 9876543210 / student@bhabhauniversity.edu.in" required>
            </div>

            <div class="bu-citc-form-group">
              <label for="it_query_type">Issue Category *</label>
              <select id="it_query_type" class="bu-citc-form-control" required>
                <option value="">-- Select Issue Category --</option>
                <option value="wifi">Campus Wi-Fi / Hostel Network Access</option>
                <option value="erp">Student ERP &amp; Fee Portal Login Issue</option>
                <option value="result">ResultSoft / Examination Marks Display</option>
                <option value="email">Institutional Email Account Request</option>
                <option value="lab">Computer Lab / Workstation Software Support</option>
                <option value="other">General IT Query / Other</option>
              </select>
            </div>

            <div class="bu-citc-form-group">
              <label for="it_message">Description of Problem *</label>
              <textarea id="it_message" class="bu-citc-form-control" rows="3" placeholder="Briefly describe the error or request details..." required></textarea>
            </div>

            <button type="submit" class="bu-citc-submit-btn">
              <i class="fa fa-paper-plane"></i> Submit IT Support Request
            </button>

            <div id="citcSuccessMsg" class="bu-citc-alert-success">
              <i class="fa fa-check-circle mr-1"></i> <strong>Thank you!</strong> Your request has been logged with the Central IT Cell. Our technical team will reach out shortly.
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php'); ?>
<script>
function handleCitcSubmit(e) {
  e.preventDefault();
  var name = document.getElementById('it_user_name').value;
  var contact = document.getElementById('it_user_contact').value;
  var cat = document.getElementById('it_query_type').value;
  var msg = document.getElementById('it_message').value;

  if (!name || !contact || !cat || !msg) {
    alert("Please fill in all required fields.");
    return;
  }

  var btn = document.querySelector('.bu-citc-submit-btn');
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
  btn.disabled = true;

  setTimeout(function() {
    btn.innerHTML = '<i class="fa fa-check"></i> Request Submitted';
    document.getElementById('citcSuccessMsg').style.display = 'block';
    document.getElementById('citcHelpdeskForm').reset();
    setTimeout(function() {
      btn.innerHTML = '<i class="fa fa-paper-plane"></i> Submit IT Support Request';
      btn.disabled = false;
    }, 4000);
  }, 800);
}
</script>
</body>
</html>
