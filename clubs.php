<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('clubs') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'University Clubs & Societies - Bhabha University Bhopal'); ?></title>
<meta name="description" content="Explore vibrant Student & University Clubs at Bhabha University Bhopal — Abhivyakti Club, Unload Pittara, Staff Club, Environment Club, Legal Aid Clinic, Khelo Bhabha, Nav Grah Vatika, EDC & AD-MAD Club. Learn beyond classrooms, lead with purpose, and create impact.">
<meta name="keywords" content="Bhabha University clubs, student societies Bhopal, Abhivyakti cultural club, Unload Pittara mental wellness, Khelo Bhabha sports, Environment club 1101 trees, Legal aid clinic, Nav Grah Vatika, EDC incubation, AD MAD club">
<?php include('inc.meta.php');?>

<style>
/* ================================================================
   BHABHA UNIVERSITY — UNIVERSITY CLUBS & SOCIETIES
   Theme: Deep Navy #061D7C, Royal Gold #FFC107, Emerald #10B981
   Fonts: Playfair Display + Plus Jakarta Sans
   ================================================================ */

:root {
  --bu-lead-navy: #061D7C;
  --bu-lead-navy-dark: #040F4A;
  --bu-lead-navy-light: #0D2CB5;
  --bu-lead-gold: #FFC107;
  --bu-lead-gold-dark: #D99B00;
  --bu-lead-gold-light: #FFF8E1;
  --bu-lead-border: #E2E8F0;
  --bu-lead-text: #0F172A;
  --bu-lead-muted: #475569;
}

/* Page Intro Banner Card */
.bu-lead-intro-card {
  background: #ffffff;
  border-radius: 14px;
  border: 1px solid var(--bu-lead-border);
  box-shadow: 0 6px 24px rgba(6, 29, 124, 0.05);
  padding: 26px 30px;
  margin-bottom: 24px;
  position: relative;
  overflow: hidden;
}

.bu-lead-intro-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--bu-lead-gold) 0%, var(--bu-lead-gold-dark) 50%, var(--bu-lead-navy) 100%);
}

.bu-lead-header-row {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
}

.bu-lead-title-box h2 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(24px, 2.6vw, 32px);
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 6px 0;
  line-height: 1.2;
}

.bu-lead-title-box h2 em {
  font-style: italic;
  color: var(--bu-lead-navy);
}

.bu-lead-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255, 193, 7, 0.16);
  color: var(--bu-lead-gold-dark);
  font-size: 10.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  padding: 4px 12px;
  border-radius: 20px;
  margin-bottom: 8px;
}

.bu-lead-intro-p {
  font-size: 14px;
  line-height: 1.7;
  color: #334155;
  margin: 0 0 16px 0;
  max-width: 950px;
}

/* 4-Pillar University Motto Box */
.bu-motto-strip {
  background: linear-gradient(135deg, #040F4A 0%, #061D7C 100%);
  border-radius: 12px;
  padding: 18px 22px;
  color: #ffffff;
  margin-bottom: 18px;
  border: 1px solid rgba(255, 193, 7, 0.3);
  box-shadow: 0 8px 24px rgba(6, 29, 124, 0.12);
}

.bu-motto-label {
  font-size: 10px;
  font-weight: 800;
  color: var(--bu-lead-gold);
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.bu-motto-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
}

.bu-motto-item {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 8px;
  padding: 10px 12px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: all 0.25s ease;
}

.bu-motto-item:hover {
  background: rgba(255, 193, 7, 0.15);
  border-color: var(--bu-lead-gold);
  transform: translateY(-2px);
}

.bu-motto-icon {
  width: 32px;
  height: 32px;
  border-radius: 6px;
  background: var(--bu-lead-gold);
  color: var(--bu-lead-navy-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  flex-shrink: 0;
  font-weight: 800;
}

.bu-motto-item span {
  font-size: 12px;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.3;
}

/* Quick Metrics Row */
.bu-lead-metrics-row {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 10px;
  margin-top: 14px;
  padding-top: 16px;
  border-top: 1px solid #F1F5F9;
}

.bu-lead-metric-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 10px 12px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: all 0.25s ease;
}

.bu-lead-metric-item:hover {
  background: #EEF2FF;
  border-color: #CBD5E1;
  transform: translateY(-2px);
}

.bu-lead-metric-icon {
  width: 34px;
  height: 34px;
  border-radius: 7px;
  background: rgba(6, 29, 124, 0.08);
  color: var(--bu-lead-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  flex-shrink: 0;
}

.bu-lead-metric-info strong {
  display: block;
  font-size: 14.5px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  font-family: 'Playfair Display', Georgia, serif;
  line-height: 1.15;
}

.bu-lead-metric-info span {
  font-size: 10px;
  color: var(--bu-lead-muted);
  font-weight: 600;
}

/* ================================================================
   EXECUTIVE SPOTLIGHT CARD STYLES (MATCHING CHANCELLOR CARD)
   ================================================================ */
.bu-chancellor-spotlight {
  background: linear-gradient(135deg, #FFFFFF 0%, #FAF9F6 100%);
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  box-shadow: 0 10px 30px rgba(6, 29, 124, 0.07);
  padding: 26px 30px;
  margin-bottom: 24px;
  position: relative;
  overflow: hidden;
  border-left: 5px solid var(--bu-lead-gold-dark);
  transition: transform 0.28s ease, box-shadow 0.28s ease;
}

.bu-chancellor-spotlight:hover {
  box-shadow: 0 14px 36px rgba(6, 29, 124, 0.1);
  transform: translateY(-2px);
}

.bu-chancellor-grid {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 32px;
  align-items: flex-start;
}

.bu-chancellor-left-col {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.bu-chancellor-portrait-wrap {
  position: relative;
  width: 280px;
  max-width: 100%;
  height: auto;
  aspect-ratio: 1 / 1.08;
  border-radius: 16px;
  overflow: hidden;
  border: 4px solid #ffffff;
  box-shadow: 0 12px 32px rgba(6, 29, 124, 0.16), 0 0 0 2.5px var(--bu-lead-gold);
  background: #ffffff;
  margin-bottom: 14px;
}

.bu-chancellor-portrait-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center top;
  display: block;
  transition: transform 0.4s ease;
}

.bu-chancellor-portrait-wrap:hover img {
  transform: scale(1.05);
}

.bu-club-visual-box {
  width: 100%;
  height: 100%;
  background: linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  text-align: center;
  color: #ffffff;
  position: relative;
  overflow: hidden;
}

.bu-club-visual-box::before {
  content: '';
  position: absolute;
  width: 140px;
  height: 140px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.18) 0%, transparent 70%);
  top: -30px;
  right: -30px;
}

.bu-club-icon-circle {
  width: 58px;
  height: 58px;
  border-radius: 12px;
  background: rgba(255, 193, 7, 0.18);
  border: 1.5px solid var(--bu-lead-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--bu-lead-gold);
  font-size: 26px;
  margin-bottom: 12px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
  transition: transform 0.3s ease;
}

.bu-chancellor-spotlight:hover .bu-club-icon-circle {
  transform: scale(1.1) rotate(5deg);
}

.bu-club-visual-cat {
  font-size: 10.5px;
  font-weight: 800;
  color: var(--bu-lead-gold);
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 4px;
}

.bu-club-visual-name {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 22px;
  font-weight: 800;
  color: #FFFFFF;
  margin: 0 0 6px 0;
  line-height: 1.15;
}

.bu-club-visual-tag {
  display: inline-block;
  background: rgba(16, 185, 129, 0.2);
  border: 1px solid #10B981;
  color: #34D399;
  font-size: 10px;
  font-weight: 800;
  padding: 2.5px 10px;
  border-radius: 12px;
  text-transform: uppercase;
  letter-spacing: 0.8px;
}

.bu-chancellor-oxford-pill {
  background: #FFFBEB;
  border: 1px solid rgba(217, 155, 0, 0.35);
  color: #854D0E;
  font-size: 10.5px;
  font-weight: 700;
  padding: 5px 12px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  line-height: 1.25;
  text-align: center;
}

.bu-chancellor-oxford-pill i {
  color: #D97706;
}

.bu-chancellor-right-col {
  display: flex;
  flex-direction: column;
}

.bu-chancellor-desk-label {
  font-size: 11px;
  font-weight: 800;
  color: var(--bu-lead-gold-dark);
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 4px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.bu-chancellor-right-col h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 2px 0;
  line-height: 1.2;
}

.bu-chancellor-desig-sub {
  font-size: 13px;
  font-weight: 700;
  color: var(--bu-lead-navy);
  margin-bottom: 12px;
}

/* Quote Box */
.bu-chancellor-quote-box {
  background: #F8FAFC;
  border-left: 4px solid var(--bu-lead-navy);
  border-radius: 8px;
  padding: 12px 16px;
  margin-bottom: 14px;
  position: relative;
}

.bu-chancellor-quote-box p {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 14px;
  font-style: italic;
  font-weight: 600;
  color: var(--bu-lead-navy-dark);
  line-height: 1.55;
  margin: 0;
}

.bu-chancellor-quote-box i {
  color: var(--bu-lead-gold-dark);
  font-size: 14px;
  margin-right: 5px;
}

.bu-chancellor-body-text {
  font-size: 13.5px;
  line-height: 1.7;
  color: #334155;
  margin-bottom: 14px;
}

.bu-chancellor-body-text p {
  margin-bottom: 8px;
}

.bu-chancellor-body-text p:last-child {
  margin-bottom: 0;
}

/* Focus Chips */
.bu-chancellor-chips-row {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 4px;
}

.bu-focus-chip {
  background: #ffffff;
  border: 1px solid #CBD5E1;
  border-radius: 20px;
  padding: 4px 11px;
  font-size: 11px;
  font-weight: 700;
  color: #1E293B;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
  transition: all 0.2s ease;
}

.bu-focus-chip:hover {
  background: #F1F5F9;
  border-color: var(--bu-lead-navy);
  transform: translateY(-1px);
}

.bu-focus-chip i {
  color: #10B981;
  font-size: 10px;
}

/* Section Headings */
.bu-lead-sec-heading {
  margin: 28px 0 18px 0;
}

.bu-lead-sec-heading .bu-sec-label {
  font-size: 10.5px;
  font-weight: 800;
  color: var(--bu-lead-gold-dark);
  text-transform: uppercase;
  letter-spacing: 1.5px;
  display: block;
  margin-bottom: 2px;
}

.bu-lead-sec-heading h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 22px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 6px 0;
}

.bu-lead-sec-divider {
  width: 36px;
  height: 3px;
  background: var(--bu-lead-gold);
  border-radius: 2px;
}

/* Interactive Filter Bar */
.bu-clubs-filter-bar {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 22px;
  background: #ffffff;
  padding: 8px 12px;
  border-radius: 10px;
  border: 1px solid var(--bu-lead-border);
}

.bu-filter-btn {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  color: #475569;
  font-size: 11.5px;
  font-weight: 700;
  padding: 6px 14px;
  border-radius: 20px;
  cursor: pointer;
  transition: all 0.22s ease;
}

.bu-filter-btn:hover,
.bu-filter-btn.active {
  background: var(--bu-lead-navy);
  color: #ffffff;
  border-color: var(--bu-lead-navy);
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.18);
}

/* Join a Club Action Strip */
.bu-join-club-strip {
  background: linear-gradient(135deg, var(--bu-lead-navy-dark) 0%, var(--bu-lead-navy) 100%);
  border-radius: 14px;
  padding: 26px 30px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
  box-shadow: 0 10px 30px rgba(6, 29, 124, 0.18);
  border: 1px solid rgba(255, 193, 7, 0.25);
  margin-top: 10px;
}

.bu-join-club-info h4 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 22px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 4px 0;
}

.bu-join-club-info p {
  font-size: 13px;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
  max-width: 650px;
}

.bu-join-club-actions {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

.bu-btn-gold {
  background: var(--bu-lead-gold);
  color: var(--bu-lead-navy-dark) !important;
  font-size: 13px;
  font-weight: 800;
  padding: 11px 24px;
  border-radius: 8px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 16px rgba(255, 193, 7, 0.3);
}

.bu-btn-gold:hover {
  background: #E5AC00;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 193, 7, 0.45);
}

.bu-btn-outline-white {
  background: rgba(255, 255, 255, 0.1);
  color: #ffffff !important;
  font-size: 12.5px;
  font-weight: 700;
  padding: 10px 18px;
  border-radius: 8px;
  text-decoration: none !important;
  border: 1px solid rgba(255, 255, 255, 0.3);
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.25s ease;
}

.bu-btn-outline-white:hover {
  background: rgba(255, 255, 255, 0.2);
  border-color: #ffffff;
}

/* ================================================================
   RESPONSIVE STYLING (MOBILE 5PX PADDING)
   ================================================================ */
@media(max-width: 991px) {
  .bu-chancellor-grid {
    grid-template-columns: 1fr;
    gap: 22px;
  }
  .bu-chancellor-portrait-wrap {
    width: 280px;
    max-width: 90%;
    margin: 0 auto 16px auto;
  }
  .bu-motto-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .bu-lead-metrics-row {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media(max-width: 768px) {
  .bu-inner-layout {
    padding: 5px !important;
  }
  .bu-inner-content {
    padding: 0 !important;
  }
  .bu-lead-intro-card {
    padding: 18px 16px;
    margin-bottom: 14px;
  }
  .bu-motto-strip {
    padding: 16px 14px;
  }
  .bu-motto-grid {
    grid-template-columns: 1fr;
    gap: 8px;
  }
  .bu-lead-metrics-row {
    grid-template-columns: 1fr;
    gap: 8px;
  }
  .bu-chancellor-spotlight {
    padding: 20px 16px;
    margin-bottom: 18px;
  }
  .bu-chancellor-portrait-wrap {
    width: 260px;
    max-width: 100%;
    margin: 0 auto 14px auto;
  }
  .bu-chancellor-right-col h3 {
    font-size: 22px;
  }
  .bu-join-club-strip {
    padding: 20px 16px;
    text-align: center;
    justify-content: center;
  }
  .bu-join-club-actions {
    width: 100%;
    justify-content: center;
  }
  .bu-btn-gold, .bu-btn-outline-white {
    width: 100%;
    justify-content: center;
  }
}
</style>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = portalVal($portalPage, 'heading', 'University <em>Clubs &amp; Societies</em>');
  $page_subtitle = portalVal($portalPage, 'subheading', 'Learn Beyond Classrooms • Lead with Purpose • Grow with Values • Create Impact.');
  $page_icon     = 'fa-users';
  $breadcrumbs   = [
    ['label' => 'Home',     'url' => URL_ROOT],
    ['label' => 'About',    'url' => href('about.php')],
    ['label' => 'University Clubs', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'clubs'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- SECTION 1: EXECUTIVE OVERVIEW BANNER CARD -->
      <div class="bu-lead-intro-card">
        <div class="bu-lead-header-row">
          <div class="bu-lead-title-box">
            <span class="bu-lead-badge"><i class="fa fa-cubes"></i> Co-Curricular Excellence &amp; Student Life</span>
            <h2>University <em>Clubs &amp; Societies</em></h2>
          </div>
        </div>
        
        <p class="bu-lead-intro-p">
          At Bhabha University, Bhopal, learning goes beyond classrooms. It is about discovering passions, nurturing talents, 
          building character and preparing future-ready professionals! At Bhabha University, clubs are not merely extracurricular 
          activities; they are platforms that inspire aspirations, cultivate leadership, foster well-being and shape socially 
          responsible citizens ready to lead the future.
        </p>

        <!-- 4-Pillar University Motto Box -->
        <div class="bu-motto-strip">
          <div class="bu-motto-label"><i class="fa fa-compass"></i> OUR MOTTO</div>
          <div class="bu-motto-grid">
            <div class="bu-motto-item">
              <div class="bu-motto-icon"><i class="fa fa-book"></i></div>
              <span>Learn Beyond Classrooms</span>
            </div>
            <div class="bu-motto-item">
              <div class="bu-motto-icon"><i class="fa fa-bullseye"></i></div>
              <span>Lead with Purpose</span>
            </div>
            <div class="bu-motto-item">
              <div class="bu-motto-icon"><i class="fa fa-heart"></i></div>
              <span>Grow with Values</span>
            </div>
            <div class="bu-motto-item">
              <div class="bu-motto-icon"><i class="fa fa-rocket"></i></div>
              <span>Create Impact</span>
            </div>
          </div>
        </div>

        <!-- Institutional Metrics -->
        <div class="bu-lead-metrics-row">
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-cubes"></i></div>
            <div class="bu-lead-metric-info">
              <strong>9+ Specialized</strong>
              <span>Clubs &amp; Cells</span>
            </div>
          </div>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-paint-brush"></i></div>
            <div class="bu-lead-metric-info">
              <strong>35+ Activities</strong>
              <span>Cultural &amp; Creative</span>
            </div>
          </div>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-smile-o"></i></div>
            <div class="bu-lead-metric-info">
              <strong>1,700+ Scholars</strong>
              <span>Mentored for Wellness</span>
            </div>
          </div>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-tree"></i></div>
            <div class="bu-lead-metric-info">
              <strong>1,101 Trees</strong>
              <span>Green Mission 2026</span>
            </div>
          </div>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-gavel"></i></div>
            <div class="bu-lead-metric-info">
              <strong>18+ Years</strong>
              <span>Free Legal Aid Service</span>
            </div>
          </div>
        </div>
      </div>

      <!-- SECTION 2: UNIVERSITY CLUBS DIRECTORY (SPOTLIGHT CARDS) -->
      <div class="bu-lead-sec-heading">
        <span class="bu-sec-label">Active Student Societies</span>
        <h3>Our Flagship Clubs &amp; Specialized Cells</h3>
        <div class="bu-lead-sec-divider"></div>
      </div>

      <!-- CLUB 1: ABHIVYAKTI CLUB -->
      <div class="bu-chancellor-spotlight" id="abhivyakti">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box">
                <div class="bu-club-icon-circle"><i class="fa fa-paint-brush"></i></div>
                <span class="bu-club-visual-cat">Cultural &amp; Arts</span>
                <h4 class="bu-club-visual-name">Abhivyakti</h4>
                <span class="bu-club-visual-tag">35+ Annual Activities</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Personality &amp; Cultural Platform
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-ticket"></i> Cultural &amp; Creative Platform</span>
            <h3>Abhivyakti Club</h3>
            <span class="bu-chancellor-desig-sub">Personality Development, Communication, Creativity &amp; Life-Career Readiness</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Empowering students to express, excel and evolve through nearly 35 cultural, creative and skill-oriented activities.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                With nearly 35 cultural, creative and skill-oriented activities, <strong>Abhivyakti Club</strong> serves as a dynamic 
                platform for personality development, leadership, communication, creativity and life-career readiness, empowering 
                students to express, excel and evolve.
              </p>
              <p>
                From theatrical productions and musical performances to public speaking debates and art exhibitions, the club provides an 
                inclusive stage for every scholar to explore their latent artistic abilities while cultivating decisive stage presence and self-confidence.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> 35+ Annual Cultural Activities</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Personality Grooming &amp; Soft Skills</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Public Speaking &amp; Debate Mastery</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Creative Arts &amp; Theatrical Productions</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Inter-University Mega Festivals</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 2: UNLOAD PITTARA -->
      <div class="bu-chancellor-spotlight" id="unload-pittara">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #064E3B 0%, #047857 60%, #059669 100%);">
                <div class="bu-club-icon-circle" style="color:#10B981; border-color:#10B981; background:rgba(16,185,129,0.2);"><i class="fa fa-heartbeat"></i></div>
                <span class="bu-club-visual-cat" style="color:#6EE7B7;">Mental Well-Being</span>
                <h4 class="bu-club-visual-name">Unload Pittara</h4>
                <span class="bu-club-visual-tag" style="background:rgba(255,255,255,0.2); border-color:#ffffff; color:#ffffff;">1,700+ Mentored</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> MP Police Community Collaboration
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-heart"></i> Psychological Wellness &amp; Emotional Support</span>
            <h3>Unload Pittara — Mental Well-Being Club</h3>
            <span class="bu-chancellor-desig-sub">Emotional Well-Being, Stress Management &amp; Psychological Resilience</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Because every voice deserves to be heard — providing a safe and supportive space for self-expression, mental wellness, and care.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                Because every voice deserves to be heard, <strong>Unload Pittara Club</strong> provides a safe and supportive space for 
                emotional well-being, self-expression, stress management and psychological resilience, fostering a culture of care and belonging.
              </p>
              <p>
                Having mentored more than <strong>1,700 students</strong> through seminars and workshops on happy living, the club has 
                emerged as a significant initiative for promoting emotional wellness. It has also actively collaborated with <strong>MP Police 
                under Community Policing initiatives</strong>, extending support to underprivileged children during moments of distress and vulnerability.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> 1,700+ Students Mentored</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> MP Police Community Policing Linkage</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Happy Living Seminars &amp; Workshops</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Underprivileged Child Support Initiatives</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Peer Counselling &amp; Safe Listening Circles</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 3: STAFF CLUB -->
      <div class="bu-chancellor-spotlight" id="staff-club">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #1E1B4B 0%, #312E81 60%, #4338CA 100%);">
                <div class="bu-club-icon-circle"><i class="fa fa-users"></i></div>
                <span class="bu-club-visual-cat">Faculty Synergy</span>
                <h4 class="bu-club-visual-name">Staff Club</h4>
                <span class="bu-club-visual-tag">Inclusive Culture</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Educator Well-Being &amp; Family Care
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-handshake-o"></i> Institutional Culture &amp; Faculty Synergy</span>
            <h3>Staff Club</h3>
            <span class="bu-chancellor-desig-sub">Professional Engagement, Collaboration, Educator Well-Being &amp; Community Care</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Recognizing that empowered educators inspire empowered learners — promoting collaboration and a positive institutional culture.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                Recognizing that empowered educators inspire empowered learners, the <strong>Staff Club</strong> promotes professional engagement, 
                well-being, collaboration and a positive institutional culture across the University.
              </p>
              <p>
                The club regularly organizes different workshops, fun engagement activities and provides <strong>free career counselling support 
                for the children of staff members</strong>, fostering a caring, egalitarian, and inclusive university community.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Professional Collaboration Workshops</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Free Career Counselling for Staff Children</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Educator Wellness &amp; Engagement Activities</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Inclusive University Culture</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Annual Staff Family Reconnect Meets</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 4: ENVIRONMENT CLUB -->
      <div class="bu-chancellor-spotlight" id="environment-club">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #14532D 0%, #15803D 60%, #16A34A 100%);">
                <div class="bu-club-icon-circle" style="color:#86EFAC; border-color:#86EFAC; background:rgba(134,239,172,0.2);"><i class="fa fa-tree"></i></div>
                <span class="bu-club-visual-cat" style="color:#BBF7D0;">Green Campus Mission</span>
                <h4 class="bu-club-visual-name">Environment Club</h4>
                <span class="bu-club-visual-tag" style="background:#FEF08A; color:#854D0E; border-color:#FEF08A;">1,101 Trees Target</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Mission 1,101 Trees (World Env Day – 15 Aug 2026)
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-leaf"></i> Sustainability &amp; Planetary Stewardship</span>
            <h3>Environment Club</h3>
            <span class="bu-chancellor-desig-sub">Eco-Conscious Practices, Conservation Campaigns &amp; Carbon Neutrality</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “At Bhabha University, sustainability is a way of life — nurturing environmentally responsible citizens for a greener tomorrow.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                At Bhabha University, sustainability is a way of life. Through awareness campaigns, conservation initiatives and 
                eco-conscious practices, the <strong>Environment Club</strong> nurtures environmentally responsible citizens.
              </p>
              <p>
                As a major Green Initiative &amp; Commitment, the University has undertaken a mission to plant <strong>1,101 trees 
                between 5th June (World Environment Day) and 15th August 2026</strong>, further enriching our already lush green 32-acre 
                campus and reinforcing our vision for a greener and more sustainable future.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Mission 1,101 Trees Plantation Drive</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> 5th June to 15th August 2026 Commitment</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Eco-Conscious Campus Lifestyle</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Water Conservation &amp; Solar Audits</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Zero-Plastic Awareness Drives</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 5: LEGAL AID CLINIC -->
      <div class="bu-chancellor-spotlight" id="legal-aid">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #451A03 0%, #78350F 60%, #92400E 100%);">
                <div class="bu-club-icon-circle"><i class="fa fa-gavel"></i></div>
                <span class="bu-club-visual-cat">Social Justice</span>
                <h4 class="bu-club-visual-name">Legal Aid Clinic</h4>
                <span class="bu-club-visual-tag">18+ Years Service</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Hundreds of Free Consultations &amp; Support
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-balance-scale"></i> Access to Justice &amp; Constitutional Literacy</span>
            <h3>Legal Aid Clinic</h3>
            <span class="bu-chancellor-desig-sub">Free Legal Consultation, Legal Awareness &amp; Community Social Justice</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Committed to the ideals of justice and social responsibility — empowering individuals through knowledge and free access to justice.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                Committed to the ideals of justice and social responsibility, the <strong>Legal Aid Clinic</strong> provides free legal 
                consultation, legal awareness and community support, empowering individuals through knowledge and access to justice.
              </p>
              <p>
                Over the last <strong>18 years</strong>, the clinic has facilitated hundreds of free legal consultations and guidance sessions, 
                reflecting Bhabha University's enduring commitment towards Social Justice and Community Service. Law students gain invaluable 
                pro-bono clinical apprenticeship under the guidance of seasoned advocates and legal scholars.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> 18+ Years of Enduring Pro-Bono Service</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Hundreds of Free Legal Consultations</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Community Legal Literacy Camps</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Rights Awareness for Underprivileged</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Clinical Student Advocate Training</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 6: KHELO BHABHA -->
      <div class="bu-chancellor-spotlight" id="khelo-bhabha">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #7C2D12 0%, #C2410C 60%, #EA580C 100%);">
                <div class="bu-club-icon-circle"><i class="fa fa-trophy"></i></div>
                <span class="bu-club-visual-cat">Sports &amp; Athletics</span>
                <h4 class="bu-club-visual-name">Khelo Bhabha</h4>
                <span class="bu-club-visual-tag">Fit Campus Initiative</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Fitness, Teamwork &amp; Sportsmanship
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-soccer-ball-o"></i> Athletic Excellence &amp; Physical Fitness</span>
            <h3>Khelo Bhabha — Sports Club</h3>
            <span class="bu-chancellor-desig-sub">Fitness, Discipline, Teamwork, Inter-University Championships &amp; Sportsmanship</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Celebrating the spirit of fitness, discipline, teamwork and sportsmanship — pursuing athletic excellence both on and off the field.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                <strong>Khelo Bhabha</strong> celebrates the spirit of fitness, discipline, teamwork and sportsmanship, encouraging students 
                to pursue excellence both on and off the field.
              </p>
              <p>
                Equipped with extensive outdoor sports grounds and indoor sports complexes, the club organizes annual university leagues, 
                inter-departmental tournaments in cricket, football, basketball, and volleyball, while nurturing top athletic talent for state 
                and national collegiate championships.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Annual Inter-Departmental Sports Meet</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Cricket, Football &amp; Volleyball Leagues</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> State &amp; National Championship Representation</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Indoor Gymnasium &amp; Badminton Courts</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Mindful Fitness &amp; Yoga Camps</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 7: NAV GRAH VATIKA -->
      <div class="bu-chancellor-spotlight" id="nav-grah-vatika">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #1E3A8A 0%, #1E40AF 60%, #0369A1 100%);">
                <div class="bu-club-icon-circle"><i class="fa fa-globe"></i></div>
                <span class="bu-club-visual-cat">Ecological Heritage</span>
                <h4 class="bu-club-visual-name">Nav Grah Vatika</h4>
                <span class="bu-club-visual-tag">9 Sacred Celestial Trees</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Nakshatra Shastra &amp; Ecological Heritage
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-sun-o"></i> Ancient Wisdom &amp; Botanical Biodiversity</span>
            <h3>Nav Grah Vatika</h3>
            <span class="bu-chancellor-desig-sub">Nakshatra Shastra, Sacred Celestial Flora, Indigenous Species &amp; Cosmic Ecology</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Harmonizing India's ancient ecological wisdom and Nakshatra Shastra with indigenous biodiversity conservation and cosmic consciousness.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                Inspired by India's ancient wisdom and the science of <strong>Nakshatra Shastra</strong>, <strong>Nav Grah Vatika</strong> is a unique 
                initiative of Bhabha University, Bhopal.
              </p>
              <p>
                Designed around the traditional association of sacred trees with the nine celestial bodies, it stands as a tribute to our 
                ecological heritage, promoting the restoration of indigenous tree species, biodiversity conservation and harmony between 
                nature, culture and cosmic consciousness.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> 9 Celestial Sacred Trees Garden</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Nakshatra Shastra Botanical Association</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Indigenous Tree Species Restoration</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Herbal &amp; Medicinal Plant Conservation</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Mindful Nature Harmony &amp; Research</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 8: ENTREPRENEURSHIP DEVELOPMENT CELL -->
      <div class="bu-chancellor-spotlight" id="edc-cell">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #701A75 0%, #86198F 60%, #A21CAF 100%);">
                <div class="bu-club-icon-circle"><i class="fa fa-lightbulb-o"></i></div>
                <span class="bu-club-visual-cat">Startup &amp; Enterprise</span>
                <h4 class="bu-club-visual-name">EDC Cell</h4>
                <span class="bu-club-visual-tag">Cottage Industry MSME</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Mentored Thousands in Practical Industry Skills
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-rocket"></i> Innovation, Incubation &amp; Self-Reliance</span>
            <h3>Entrepreneurship Development Cell (EDC)</h3>
            <span class="bu-chancellor-desig-sub">Startup Mentorship, Cottage Industries Incubation, Product Development &amp; Enterprise</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “Cultivating innovation, leadership and enterprise by encouraging students to transform ideas into viable ventures.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                The <strong>Entrepreneurship Development Cell</strong> cultivates innovation, leadership and enterprise by encouraging 
                students to transform ideas into impactful ventures through mentorship, industry interaction and entrepreneurial exposure.
              </p>
              <p>
                Over the years, the Cell has mentored <strong>thousands of aspiring entrepreneurs</strong> in developing practical skills 
                for establishing cottage industries, including the production of <strong>soaps, detergents, skin creams, nail paint removers, 
                phenyl and other sustainable livelihood products</strong>, fostering self-reliance and entrepreneurial thinking.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Cottage Industry Practical Skill Incubation</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Production of Soaps, Detergents &amp; Creams</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Mentored Thousands of Young Entrepreneurs</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Sustainable Livelihood MSME Training</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Angel Investor &amp; Industry Exposure</span>
            </div>
          </div>

        </div>
      </div>

      <!-- CLUB 9: AD-MAD CLUB -->
      <div class="bu-chancellor-spotlight" id="ad-mad">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: linear-gradient(145deg, #0F172A 0%, #1E293B 60%, #334155 100%);">
                <div class="bu-club-icon-circle"><i class="fa fa-bullhorn"></i></div>
                <span class="bu-club-visual-cat">Branding &amp; Media</span>
                <h4 class="bu-club-visual-name">AD-MAD Club</h4>
                <span class="bu-club-visual-tag">Strategic Persuasion</span>
              </div>
            </div>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Persuasion, Branding &amp; Media Strategy
            </div>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-video-camera"></i> Branding, Advertising &amp; Strategic Marketing</span>
            <h3>AD-MAD Club</h3>
            <span class="bu-chancellor-desig-sub">Creative Communications, Commercial Jingles, Campaign Pitching &amp; Brand Strategy</span>

            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “A creative hub for aspiring communicators and marketers, nurturing the art of persuasion, branding, advertising and strategic media.”
              </p>
            </div>

            <div class="bu-chancellor-body-text">
              <p>
                The <strong>AD-MAD Club</strong> is a creative hub for aspiring communicators and marketers, nurturing the art of persuasion, 
                branding, advertising and strategic marketing, preparing students for the ever-evolving world of business and media.
              </p>
              <p>
                Through high-energy ad-making hackathons, jingle composition competitions, viral marketing case studies, and corporate pitch 
                simulations, members learn how to craft compelling messages that captivate global audiences.
              </p>
            </div>

            <div class="bu-chancellor-chips-row">
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Live Ad-Film &amp; Jingle Competitions</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Brand Strategy &amp; Positioning Labs</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Corporate Pitch Simulation &amp; Storytelling</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Digital Marketing &amp; Viral Campaigns</span>
              <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> Radio &amp; Broadcast Media Collaborations</span>
            </div>
          </div>

        </div>
      </div>

      <!-- SECTION 3: MEMBERSHIP & ENGAGEMENT CTA STRIP -->
      <div class="bu-join-club-strip">
        <div class="bu-join-club-info">
          <h4>Join a University Club &amp; Lead with Purpose!</h4>
          <p>
            Discover your passion, collaborate with passionate peers, organize flagship events, and build lifelong leadership skills.
            Open to all registered undergraduate, postgraduate, and diploma students.
          </p>
        </div>
        <div class="bu-join-club-actions">
          <a href="<?php echo href('enquiry.php'); ?>" class="bu-btn-gold">
            <i class="fa fa-user-plus"></i> Join a Club Today
          </a>
          <a href="<?php echo href('contact.php'); ?>" class="bu-btn-outline-white">
            <i class="fa fa-envelope"></i> Contact Club Coordinators
          </a>
        </div>
      </div>

    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
