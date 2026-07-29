<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NIRF Rankings & Submission Reports - Bhabha University Bhopal</title>
  <meta name="description" content="National Institutional Ranking Framework (NIRF) data reports submitted by Bhabha University Bhopal to the Ministry of Education, Government of India.">
  <?php include('inc.meta.php'); ?>

  <style>
  /* ============================================================
     NIRF RANKINGS PAGE STYLES
     Theme: Navy #0A1B54  Gold #FFC107  BG #F8FAFC
     ============================================================ */
  .bu-nirf-page-wrap {
    background-color: #F8FAFC;
    padding: 80px 20px 90px 20px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #1E293B;
    clear: both;
    width: 100%;
    float: left;
    box-sizing: border-box;
  }
  .bu-nirf-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* ---- OVERVIEW BANNER CARD ---- */
  .bu-nirf-overview-card {
    background: linear-gradient(135deg, #051235 0%, #0A1B54 60%, #061D7C 100%);
    border-radius: 16px;
    padding: 40px 48px;
    color: #ffffff;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(10, 27, 84, 0.15);
    position: relative;
    overflow: hidden;
  }
  .bu-nirf-overview-card::after {
    content: 'NIRF';
    position: absolute;
    right: -20px;
    bottom: -30px;
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 160px;
    font-weight: 800;
    color: rgba(255, 255, 255, 0.03);
    pointer-events: none;
    line-height: 1;
  }
  .bu-nirf-badge-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 193, 7, 0.15);
    border: 1px solid rgba(255, 193, 7, 0.35);
    color: #FFC107;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 20px;
    margin-bottom: 16px;
  }
  .bu-nirf-overview-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(26px, 3.5vw, 38px);
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 14px 0;
    line-height: 1.25;
  }
  .bu-nirf-overview-desc {
    font-size: 15px;
    line-height: 1.75;
    color: rgba(255, 255, 255, 0.78);
    max-width: 820px;
    margin: 0 0 24px 0;
  }
  .bu-nirf-stats-row {
    display: flex;
    gap: 28px;
    flex-wrap: wrap;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
  }
  .bu-nirf-stat-item {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .bu-nirf-stat-icon {
    width: 38px;
    height: 38px;
    background: rgba(255, 193, 7, 0.2);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFC107;
    font-size: 16px;
  }
  .bu-nirf-stat-text span {
    display: block;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 1px;
    color: rgba(255, 255, 255, 0.55);
    text-transform: uppercase;
  }
  .bu-nirf-stat-text strong {
    font-size: 14px;
    font-weight: 700;
    color: #ffffff;
  }

  /* ---- SEARCH & FILTER BAR ---- */
  .bu-nirf-controls-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
  }
  .bu-nirf-tabs {
    display: flex;
    gap: 10px;
    background: #ffffff;
    padding: 6px;
    border-radius: 10px;
    border: 1px solid #E2E8F0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }
  .bu-nirf-tab-btn {
    padding: 10px 22px;
    font-size: 13px;
    font-weight: 700;
    border-radius: 7px;
    border: none;
    background: transparent;
    color: #64748B;
    cursor: pointer;
    transition: all 0.25s ease;
  }
  .bu-nirf-tab-btn.active {
    background: #0A1B54;
    color: #FFC107;
    box-shadow: 0 4px 12px rgba(10, 27, 84, 0.15);
  }
  .bu-nirf-tab-btn:hover:not(.active) {
    color: #0A1B54;
    background: #F1F5F9;
  }

  .bu-nirf-search-box {
    position: relative;
    max-width: 380px;
    width: 100%;
  }
  .bu-nirf-search-input {
    width: 100%;
    padding: 12px 18px 12px 42px;
    background: #ffffff;
    border: 1px solid #E2E8F0;
    border-radius: 10px;
    font-size: 13.5px;
    color: #0F172A;
    outline: none;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }
  .bu-nirf-search-input:focus {
    border-color: #0A1B54;
    box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.1);
  }
  .bu-nirf-search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #94A3B8;
    font-size: 14px;
  }

  /* ---- REPORT CARDS GRID ---- */
  .bu-nirf-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 50px;
  }
  .bu-nirf-card {
    background: #ffffff;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 24px 28px;
    box-shadow: 0 4px 18px rgba(6, 29, 124, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
  }
  .bu-nirf-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 5px; height: 100%;
    background: #0A1B54;
    transition: background 0.3s ease;
  }
  .bu-nirf-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 36px rgba(6, 29, 124, 0.1);
    border-color: #CBD5E1;
  }
  .bu-nirf-card:hover::before {
    background: #FFC107;
  }

  .bu-nirf-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 14px;
  }
  .bu-nirf-disc-badge {
    background: rgba(10, 27, 84, 0.08);
    color: #0A1B54;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 6px;
    display: inline-block;
  }
  .bu-nirf-year-tag {
    background: #FEF3C7;
    color: #92400E;
    font-size: 11px;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 20px;
  }
  .bu-nirf-card-title {
    font-size: 17px;
    font-weight: 700;
    color: #0F172A;
    margin: 0 0 10px 0;
    line-height: 1.4;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  .bu-nirf-card-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12.5px;
    color: #64748B;
    margin-bottom: 20px;
  }
  .bu-nirf-card-meta i {
    color: #EF4444; /* PDF Red */
    font-size: 16px;
  }

  .bu-nirf-card-actions {
    display: flex;
    gap: 12px;
    padding-top: 16px;
    border-top: 1px solid #F1F5F9;
  }
  .bu-nirf-btn-view {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #0A1B54;
    color: #ffffff;
    font-size: 12.5px;
    font-weight: 700;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none !important;
    transition: all 0.25s ease;
  }
  .bu-nirf-btn-view:hover {
    background: #061D7C;
    color: #FFC107;
  }
  .bu-nirf-btn-dl {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 40px;
    background: #F1F5F9;
    color: #334155;
    font-size: 14px;
    border-radius: 8px;
    text-decoration: none !important;
    transition: all 0.25s ease;
  }
  .bu-nirf-btn-dl:hover {
    background: #FFC107;
    color: #0A1B54;
  }

  /* ---- PARAMETERS SECTION ---- */
  .bu-nirf-params-sec {
    background: #ffffff;
    border-radius: 16px;
    padding: 44px 48px;
    border: 1px solid #E2E8F0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
  }
  .bu-nirf-sec-header {
    text-align: center;
    max-width: 650px;
    margin: 0 auto 40px auto;
  }
  .bu-nirf-sec-label {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2.5px;
    color: #D99B00;
    text-transform: uppercase;
    margin-bottom: 10px;
    display: block;
  }
  .bu-nirf-sec-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(24px, 3vw, 34px);
    font-weight: 800;
    color: #061D7C;
    margin: 0;
    line-height: 1.2;
  }

  .bu-nirf-params-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 18px;
  }
  .bu-nirf-param-card {
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    padding: 22px 18px;
    text-align: center;
    transition: all 0.25s ease;
  }
  .bu-nirf-param-card:hover {
    background: #ffffff;
    border-color: #FFC107;
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(6, 29, 124, 0.08);
  }
  .bu-nirf-param-num {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 28px;
    font-weight: 800;
    color: #FFC107;
    margin-bottom: 6px;
    line-height: 1;
  }
  .bu-nirf-param-name {
    font-size: 13.5px;
    font-weight: 700;
    color: #0A1B54;
    margin: 0 0 6px 0;
  }
  .bu-nirf-param-desc {
    font-size: 11.5px;
    color: #64748B;
    line-height: 1.45;
    margin: 0;
  }

  /* ---- RESPONSIVE ---- */
  @media (max-width: 991px) {
    .bu-nirf-grid { grid-template-columns: 1fr; }
    .bu-nirf-params-grid { grid-template-columns: repeat(2, 1fr); }
    .bu-nirf-overview-card { padding: 30px 24px; }
    .bu-nirf-params-sec { padding: 30px 20px; }
  }
  @media (max-width: 575px) {
    .bu-nirf-params-grid { grid-template-columns: 1fr; }
    .bu-nirf-controls-bar { flex-direction: column; align-items: stretch; }
    .bu-nirf-search-box { max-width: 100%; }
  }
  </style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <!-- HERO BANNER -->
  <?php 
  $page_title    = "NIRF Rankings & Submission Reports";
  $page_subtitle = "National Institutional Ranking Framework (NIRF) data reports submitted by Bhabha University to the Ministry of Education, Govt. of India.";
  $page_icon     = "fa-line-chart";
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'NIRF Rankings', 'url' => '#']
  ];
  include('inc.page-banner.php');
  ?>

  <!-- MAIN NIRF CONTENT WRAPPER -->
  <div class="bu-nirf-page-wrap">
    <div class="bu-nirf-container">
      
      <!-- OVERVIEW CARD -->
      <div class="bu-nirf-overview-card">
        <span class="bu-nirf-badge-tag"><i class="fa fa-certificate"></i> Govt. of India Accredited</span>
        <h2 class="bu-nirf-overview-title">National Institutional Ranking Framework</h2>
        <p class="bu-nirf-overview-desc">
          The National Institutional Ranking Framework (NIRF) was launched by the Honorable Minister of Human Resource Development (now Ministry of Education). This framework outlines a methodology to rank institutions across India based on five broad parameter categories: Teaching, Research, Graduation Outcomes, Outreach, and Perception.
        </p>
        
        <div class="bu-nirf-stats-row">
          <div class="bu-nirf-stat-item">
            <div class="bu-nirf-stat-icon"><i class="fa fa-university"></i></div>
            <div class="bu-nirf-stat-text">
              <span>Institution Type</span>
              <strong>State Private University</strong>
            </div>
          </div>
          <div class="bu-nirf-stat-item">
            <div class="bu-nirf-stat-icon"><i class="fa fa-check-circle"></i></div>
            <div class="bu-nirf-stat-text">
              <span>Statutory Compliance</span>
              <strong>100% Verified Submissions</strong>
            </div>
          </div>
          <div class="bu-nirf-stat-item">
            <div class="bu-nirf-stat-icon"><i class="fa fa-folder-open"></i></div>
            <div class="bu-nirf-stat-text">
              <span>Data Submissions</span>
              <strong>NIRF 2026 &amp; 2025</strong>
            </div>
          </div>
        </div>
      </div>

      <!-- SEARCH & CONTROLS BAR -->
      <div class="bu-nirf-controls-bar">
        <!-- Year Tabs -->
        <div class="bu-nirf-tabs">
          <button class="bu-nirf-tab-btn active" onclick="switchYear('2026', this)">NIRF 2026 Reports</button>
          <button class="bu-nirf-tab-btn" onclick="switchYear('2025', this)">NIRF 2025 Reports</button>
        </div>

        <!-- Search Input -->
        <div class="bu-nirf-search-box">
          <i class="fa fa-search bu-nirf-search-icon"></i>
          <input type="text" id="nirfSearchInput" class="bu-nirf-search-input" placeholder="Search discipline (e.g. Engineering, Dental)..." onkeyup="filterNIRFReports()">
        </div>
      </div>

      <!-- ================= NIRF 2026 REPORTS GRID ================= -->
      <div id="nirfGrid2026" class="bu-nirf-grid">
        
        <!-- Overall 2026 -->
        <div class="bu-nirf-card" data-title="Overall NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">OVERALL</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Overall NIRF Data Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/e7499fa68f8c45da5de179244ce06453.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/e7499fa68f8c45da5de179244ce06453.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- College 2026 -->
        <div class="bu-nirf-card" data-title="College NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">COLLEGE</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — College NIRF Data Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/b962b78c485d262ff1e7f07aeb9e4792.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/b962b78c485d262ff1e7f07aeb9e4792.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Management 2026 -->
        <div class="bu-nirf-card" data-title="Management NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">MANAGEMENT</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Management NIRF Data Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/809e6f0f24caae71558512a96eb824ba.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/809e6f0f24caae71558512a96eb824ba.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Engineering 2026 -->
        <div class="bu-nirf-card" data-title="Engineering NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">ENGINEERING</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Engineering NIRF Data Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/10e4e67d2bd221beb9bd9f25c14beb44.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/10e4e67d2bd221beb9bd9f25c14beb44.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Dental 2026 -->
        <div class="bu-nirf-card" data-title="Dental NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">DENTAL</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Dental NIRF Data Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/d67c5238d424c629091bc9d04f151c1f.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/d67c5238d424c629091bc9d04f151c1f.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Agriculture 2026 -->
        <div class="bu-nirf-card" data-title="Agriculture and Allied Sectors NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">AGRICULTURE &amp; ALLIED</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Agriculture &amp; Allied Sectors NIRF Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/4d6fe79475b028260ee9c2d26e5e13eb.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/4d6fe79475b028260ee9c2d26e5e13eb.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Law 2026 -->
        <div class="bu-nirf-card" data-title="Law NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">LAW</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Law NIRF Data Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/57d360d54612fee3c65985bc9ad0eba0.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/57d360d54612fee3c65985bc9ad0eba0.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Pharmacy 2026 -->
        <div class="bu-nirf-card" data-title="Pharmacy NIRF 2026 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">PHARMACY</span>
              <span class="bu-nirf-year-tag">NIRF 2026</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Pharmacy NIRF Data Report 2026</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/609d5cf76b83a259a1ba4eac912aa03e.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/609d5cf76b83a259a1ba4eac912aa03e.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- ================= NIRF 2025 REPORTS GRID ================= -->
      <div id="nirfGrid2025" class="bu-nirf-grid" style="display: none;">
        
        <!-- Overall 2025 -->
        <div class="bu-nirf-card" data-title="Overall NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">OVERALL</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Overall NIRF Data Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/793ae2cd79002c644adb9a4953bd382a.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/793ae2cd79002c644adb9a4953bd382a.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Dental 2025 -->
        <div class="bu-nirf-card" data-title="Dental NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">DENTAL</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Dental NIRF Data Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/839d6947c4dde5eac88955478d58cde5.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/839d6947c4dde5eac88955478d58cde5.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Agriculture 2025 -->
        <div class="bu-nirf-card" data-title="Agriculture NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">AGRICULTURE</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Agriculture &amp; Allied Sectors Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/57338e0c0b13a285d1e1c952d154f2f4.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/57338e0c0b13a285d1e1c952d154f2f4.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Engineering 2025 -->
        <div class="bu-nirf-card" data-title="Engineering NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">ENGINEERING</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Engineering NIRF Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/a393ffc91a953491b308ebeba22ed736.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/a393ffc91a953491b308ebeba22ed736.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Pharmacy 2025 -->
        <div class="bu-nirf-card" data-title="Pharmacy NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">PHARMACY</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Pharmacy NIRF Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/cbf8482fb2da983120f4dd11ebbc6bfa.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/cbf8482fb2da983120f4dd11ebbc6bfa.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Law 2025 -->
        <div class="bu-nirf-card" data-title="Law NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">LAW</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Law NIRF Data Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/a3e37e53a24b73abb61896b5565500d3.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/a3e37e53a24b73abb61896b5565500d3.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- Management 2025 -->
        <div class="bu-nirf-card" data-title="Management NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">MANAGEMENT</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — Management NIRF Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/0f7e5f295610fb57157d51cff3a51543.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/0f7e5f295610fb57157d51cff3a51543.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

        <!-- College 2025 -->
        <div class="bu-nirf-card" data-title="College NIRF 2025 Bhabha University Bhopal">
          <div>
            <div class="bu-nirf-card-header">
              <span class="bu-nirf-disc-badge">COLLEGE</span>
              <span class="bu-nirf-year-tag">NIRF 2025</span>
            </div>
            <h3 class="bu-nirf-card-title">Bhabha University, Bhopal — College NIRF Data Report 2025</h3>
            <div class="bu-nirf-card-meta">
              <i class="fa fa-file-pdf-o"></i>
              <span>Official Submission Document (PDF)</span>
            </div>
          </div>
          <div class="bu-nirf-card-actions">
            <a href="https://www.bhabhauniversity.edu.in/upload/media/bca33ac13cb1aac2cad201f5700c6fef.pdf" target="_blank" class="bu-nirf-btn-view">
              <i class="fa fa-external-link"></i> View Report
            </a>
            <a href="https://www.bhabhauniversity.edu.in/upload/media/bca33ac13cb1aac2cad201f5700c6fef.pdf" download target="_blank" class="bu-nirf-btn-dl" title="Download PDF">
              <i class="fa fa-download"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- PARAMETERS SECTION -->
      <div class="bu-nirf-params-sec">
        <div class="bu-nirf-sec-header">
          <span class="bu-nirf-sec-label">Evaluation Methodology</span>
          <h2 class="bu-nirf-sec-title">5 Key Parameters of <em>NIRF Ranking</em></h2>
        </div>

        <div class="bu-nirf-params-grid">
          <div class="bu-nirf-param-card">
            <div class="bu-nirf-param-num">01</div>
            <h4 class="bu-nirf-param-name">Teaching &amp; Learning</h4>
            <p class="bu-nirf-param-desc">Student strength, faculty ratio, doctoral credentials &amp; financial resource utilization.</p>
          </div>
          <div class="bu-nirf-param-card">
            <div class="bu-nirf-param-num">02</div>
            <h4 class="bu-nirf-param-name">Research Excellence</h4>
            <p class="bu-nirf-param-desc">Journal publications, citation metrics, patents granted &amp; sponsored projects.</p>
          </div>
          <div class="bu-nirf-param-card">
            <div class="bu-nirf-param-num">03</div>
            <h4 class="bu-nirf-param-name">Graduation Outcomes</h4>
            <p class="bu-nirf-param-desc">Campus placement rates, median salary, higher education ratio &amp; pass percentage.</p>
          </div>
          <div class="bu-nirf-param-card">
            <div class="bu-nirf-param-num">04</div>
            <h4 class="bu-nirf-param-name">Outreach &amp; Inclusivity</h4>
            <p class="bu-nirf-param-desc">Diversity across states, gender parity, economic inclusion &amp; facilities for PwD.</p>
          </div>
          <div class="bu-nirf-param-card">
            <div class="bu-nirf-param-num">05</div>
            <h4 class="bu-nirf-param-name">Peer Perception</h4>
            <p class="bu-nirf-param-desc">Academic peers &amp; employer feedback evaluating overall university reputation.</p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<!-- JAVASCRIPT FOR FILTERING & TABS -->
<script>
function switchYear(year, btn) {
  // Update buttons
  document.querySelectorAll('.bu-nirf-tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  // Toggle grids
  if (year === '2026') {
    document.getElementById('nirfGrid2026').style.display = 'grid';
    document.getElementById('nirfGrid2025').style.display = 'none';
  } else {
    document.getElementById('nirfGrid2026').style.display = 'none';
    document.getElementById('nirfGrid2025').style.display = 'grid';
  }

  // Re-apply search filter
  filterNIRFReports();
}

function filterNIRFReports() {
  var input = document.getElementById('nirfSearchInput').value.toLowerCase();
  var activeGrid = document.querySelector('.bu-nirf-grid[style*="display: grid"]') || document.getElementById('nirfGrid2026');
  var cards = activeGrid.getElementsByClassName('bu-nirf-card');

  for (var i = 0; i < cards.length; i++) {
    var title = cards[i].getAttribute('data-title').toLowerCase();
    if (title.includes(input)) {
      cards[i].style.display = 'flex';
    } else {
      cards[i].style.display = 'none';
    }
  }
}
</script>

<?php include('inc.footer.js.php'); ?>
</body>
</html>
