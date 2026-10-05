<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('clubs') : null;
$cbData = !empty($portalPage['data']) ? $portalPage['data'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'University Clubs & Societies - Bhabha University Bhopal'); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($cbData['meta_description'] ?? 'Explore vibrant Student & University Clubs at Bhabha University Bhopal — Abhivyakti Club, Unload Pittara, Staff Club, Environment Club, Legal Aid Clinic, Khelo Bhabha, Nav Grah Vatika, EDC & AD-MAD Club. Learn beyond classrooms, lead with purpose, and create impact.'); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($cbData['meta_keywords'] ?? 'Bhabha University clubs, student societies Bhopal, Abhivyakti cultural club, Unload Pittara mental wellness, Khelo Bhabha sports, Environment club 1101 trees, Legal aid clinic, Nav Grah Vatika, EDC incubation, AD MAD club'); ?>">
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
      <?php
      $introBadge = !empty($cbData['badge']) ? $cbData['badge'] : 'Co-Curricular Excellence &amp; Student Life';
      $introHeading = portalVal($portalPage, 'heading', 'University <em>Clubs &amp; Societies</em>');
      $introP = !empty($cbData['intro_p']) ? $cbData['intro_p'] : 'At Bhabha University, Bhopal, learning goes beyond classrooms. It is about discovering passions, nurturing talents, building character and preparing future-ready professionals! At Bhabha University, clubs are not merely extracurricular activities; they are platforms that inspire aspirations, cultivate leadership, foster well-being and shape socially responsible citizens ready to lead the future.';
      $mottoLabel = !empty($cbData['motto_label']) ? $cbData['motto_label'] : 'OUR MOTTO';
      $mottoItems = !empty($cbData['motto']) ? $cbData['motto'] : [
        ['icon' => 'fa-book', 'title' => 'Learn Beyond Classrooms'],
        ['icon' => 'fa-bullseye', 'title' => 'Lead with Purpose'],
        ['icon' => 'fa-heart', 'title' => 'Grow with Values'],
        ['icon' => 'fa-rocket', 'title' => 'Create Impact']
      ];
      $metrics = !empty($cbData['metrics']) ? $cbData['metrics'] : [
        ['icon' => 'fa-cubes', 'num' => '9+ Specialized', 'label' => 'Clubs &amp; Cells'],
        ['icon' => 'fa-paint-brush', 'num' => '35+ Activities', 'label' => 'Cultural &amp; Creative'],
        ['icon' => 'fa-smile-o', 'num' => '1,700+ Scholars', 'label' => 'Mentored for Wellness'],
        ['icon' => 'fa-tree', 'num' => '1,101 Trees', 'label' => 'Green Mission 2026'],
        ['icon' => 'fa-gavel', 'num' => '18+ Years', 'label' => 'Free Legal Aid Service']
      ];
      ?>
      <div class="bu-lead-intro-card">
        <div class="bu-lead-header-row">
          <div class="bu-lead-title-box">
            <span class="bu-lead-badge"><i class="fa fa-cubes"></i> <?php echo htmlspecialchars($introBadge); ?></span>
            <h2><?php echo $introHeading; ?></h2>
          </div>
        </div>
        
        <p class="bu-lead-intro-p">
          <?php echo htmlspecialchars($introP); ?>
        </p>

        <!-- 4-Pillar University Motto Box -->
        <div class="bu-motto-strip">
          <div class="bu-motto-label"><i class="fa fa-compass"></i> <?php echo htmlspecialchars($mottoLabel); ?></div>
          <div class="bu-motto-grid">
            <?php foreach ($mottoItems as $mt): ?>
            <div class="bu-motto-item">
              <div class="bu-motto-icon"><i class="fa <?php echo htmlspecialchars($mt['icon'] ?? 'fa-check'); ?>"></i></div>
              <span><?php echo htmlspecialchars($mt['title'] ?? ''); ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Institutional Metrics -->
        <div class="bu-lead-metrics-row">
          <?php foreach ($metrics as $met): ?>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa <?php echo htmlspecialchars($met['icon'] ?? 'fa-star'); ?>"></i></div>
            <div class="bu-lead-metric-info">
              <strong><?php echo htmlspecialchars($met['num'] ?? ''); ?></strong>
              <span><?php echo htmlspecialchars($met['label'] ?? ''); ?></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- SECTION 2: UNIVERSITY CLUBS DIRECTORY (SPOTLIGHT CARDS) -->
      <?php
      $secLabel = !empty($cbData['sec_label']) ? $cbData['sec_label'] : 'Active Student Societies';
      $secHeading = !empty($cbData['sec_heading']) ? $cbData['sec_heading'] : 'Our Flagship Clubs &amp; Specialized Cells';
      $clubsList = !empty($cbData['clubs']) ? $cbData['clubs'] : [];
      ?>
      <div class="bu-lead-sec-heading">
        <span class="bu-sec-label"><?php echo htmlspecialchars($secLabel); ?></span>
        <h3><?php echo htmlspecialchars($secHeading); ?></h3>
        <div class="bu-lead-sec-divider"></div>
      </div>

      <?php foreach ($clubsList as $club): 
        $clubAnchor = htmlspecialchars($club['id'] ?? '');
        $clubName = htmlspecialchars($club['name'] ?? '');
        $clubDesig = htmlspecialchars($club['desig'] ?? '');
        $deskLabel = htmlspecialchars($club['desk_label'] ?? '');
        $deskIcon = htmlspecialchars($club['desk_icon'] ?? 'fa-ticket');
        $pillText = htmlspecialchars($club['pill_text'] ?? '');
        $pillIcon = htmlspecialchars($club['pill_icon'] ?? 'fa-star');
        $visualBg = htmlspecialchars($club['visual_bg'] ?? 'linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%)');
        $visualIcon = htmlspecialchars($club['visual_icon'] ?? 'fa-users');
        $visualCat = htmlspecialchars($club['visual_cat'] ?? '');
        $visualName = htmlspecialchars($club['visual_name'] ?? $club['name'] ?? '');
        $visualTag = htmlspecialchars($club['visual_tag'] ?? '');
        $quoteText = htmlspecialchars($club['quote'] ?? '');
        $chips = !empty($club['chips']) && is_array($club['chips']) ? $club['chips'] : [];
      ?>
      <div class="bu-chancellor-spotlight" id="<?php echo $clubAnchor; ?>">
        <div class="bu-chancellor-grid">
          
          <!-- Left Visual Frame -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <div class="bu-club-visual-box" style="background: <?php echo $visualBg; ?>;">
                <div class="bu-club-icon-circle"><i class="fa <?php echo $visualIcon; ?>"></i></div>
                <?php if (!empty($visualCat)): ?><span class="bu-club-visual-cat"><?php echo $visualCat; ?></span><?php endif; ?>
                <h4 class="bu-club-visual-name"><?php echo $visualName; ?></h4>
                <?php if (!empty($visualTag)): ?><span class="bu-club-visual-tag"><?php echo $visualTag; ?></span><?php endif; ?>
              </div>
            </div>
            <?php if (!empty($pillText)): ?>
            <div class="bu-chancellor-oxford-pill">
              <i class="fa <?php echo $pillIcon; ?>"></i> <?php echo $pillText; ?>
            </div>
            <?php endif; ?>
          </div>

          <!-- Right Content Column -->
          <div class="bu-chancellor-right-col">
            <?php if (!empty($deskLabel)): ?>
            <span class="bu-chancellor-desk-label"><i class="fa <?php echo $deskIcon; ?>"></i> <?php echo $deskLabel; ?></span>
            <?php endif; ?>
            <h3><?php echo $clubName; ?></h3>
            <?php if (!empty($clubDesig)): ?>
            <span class="bu-chancellor-desig-sub"><?php echo $clubDesig; ?></span>
            <?php endif; ?>

            <?php if (!empty($quoteText)): ?>
            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “<?php echo $quoteText; ?>”
              </p>
            </div>
            <?php endif; ?>

            <div class="bu-chancellor-body-text">
              <?php if (!empty($club['body_p1'])): ?>
                <p><?php echo $club['body_p1']; ?></p>
              <?php endif; ?>
              <?php if (!empty($club['body_p2'])): ?>
                <p><?php echo $club['body_p2']; ?></p>
              <?php endif; ?>
            </div>

            <?php if (!empty($chips)): ?>
            <div class="bu-chancellor-chips-row">
              <?php foreach ($chips as $chip): ?>
                <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> <?php echo htmlspecialchars($chip); ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
      <?php endforeach; ?>

      <!-- SECTION 3: MEMBERSHIP & ENGAGEMENT CTA STRIP -->
      <?php
      $cbCta = $cbData['cta'] ?? [];
      $cbCtaHeading = $cbCta['heading'] ?? 'Join a University Club &amp; Lead with Purpose!';
      $cbCtaDesc = $cbCta['desc'] ?? 'Discover your passion, collaborate with passionate peers, organize flagship events, and build lifelong leadership skills. Open to all registered undergraduate, postgraduate, and diploma students.';
      $cbBtn1Text = $cbCta['btn1_text'] ?? 'Join a Club Today';
      $cbBtn1Url = !empty($cbCta['btn1_url']) ? href($cbCta['btn1_url']) : href('enquiry.php');
      $cbBtn2Text = $cbCta['btn2_text'] ?? 'Contact Club Coordinators';
      $cbBtn2Url = !empty($cbCta['btn2_url']) ? href($cbCta['btn2_url']) : href('contact.php');
      ?>
      <div class="bu-join-club-strip">
        <div class="bu-join-club-info">
          <h4><?php echo htmlspecialchars($cbCtaHeading); ?></h4>
          <p><?php echo htmlspecialchars($cbCtaDesc); ?></p>
        </div>
        <div class="bu-join-club-actions">
          <a href="<?php echo $cbBtn1Url; ?>" class="bu-btn-gold">
            <i class="fa fa-user-plus"></i> <?php echo htmlspecialchars($cbBtn1Text); ?>
          </a>
          <a href="<?php echo $cbBtn2Url; ?>" class="bu-btn-outline-white">
            <i class="fa fa-envelope"></i> <?php echo htmlspecialchars($cbBtn2Text); ?>
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
