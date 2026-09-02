<?php 
include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Research &amp; Innovation - Bhabha University Bhopal</title>
<meta name="description" content="Research and Innovation at Bhabha University: Bhabha Pharmacy Research Laboratories, FSSAI & MSME approved innovations, Patents, Scopus/UGC Care publications, Incubation Centre & EDC.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   BHABHA RESEARCH & INNOVATION PORTAL - COMPACT & MODERN
   Navy #0A1B54 | Gold #FFC107 | Deep Luxury Theme
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051033;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-gray-bg: #F8FAFC;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

/* RESET style.css DEFAULT EXCESSIVE PADDINGS */
.bu-res-portal section,
.kode_wrapper section {
  padding: 0 !important;
  margin: 0 0 35px 0 !important;
  float: none !important;
  overflow: visible !important;
  clear: both !important;
}

/* =========================================================
   1. DEDICATED RESEARCH HERO BANNER (NO MORE BLANK SPACE)
   ========================================================= */
.bu-hero-research {
  background: linear-gradient(135deg, #030B24 0%, #0A1B54 50%, #061D7C 100%) !important;
  position: relative !important;
  width: 100% !important;
  padding: 50px 20px 45px !important;
  color: #ffffff !important;
  overflow: hidden !important;
  box-sizing: border-box !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
}
.bu-hero-research::before {
  content: '';
  position: absolute;
  top: -120px;
  right: -100px;
  width: 450px;
  height: 450px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.15) 0%, rgba(255,193,7,0) 70%);
  pointer-events: none;
}
.bu-hero-research::after {
  content: '';
  position: absolute;
  bottom: -100px;
  left: 10%;
  width: 350px;
  height: 350px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(6,29,124,0.4) 0%, rgba(6,29,124,0) 70%);
  pointer-events: none;
}
.bu-hero-research-container {
  max-width: 1240px;
  margin: 0 auto;
  position: relative;
  z-index: 3;
  display: grid;
  grid-template-columns: 1.35fr 1fr;
  gap: 35px;
  align-items: center;
}
@media (max-width: 991px) {
  .bu-hero-research-container { grid-template-columns: 1fr; gap: 28px; }
  .bu-hero-research { padding: 36px 16px 32px !important; }
}

/* Breadcrumb */
.bu-hero-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  list-style: none;
  padding: 0;
  margin: 0 0 12px 0;
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
}
.bu-hero-breadcrumb li a {
  color: rgba(255,255,255,0.65);
  text-decoration: none;
  transition: color 0.2s ease;
}
.bu-hero-breadcrumb li a:hover { color: var(--bu-gold); }
.bu-hero-breadcrumb li.active { color: var(--bu-gold); }
.bu-hero-breadcrumb li.sep { color: rgba(255,255,255,0.3); }

/* Main Title & Sub */
.bu-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 193, 7, 0.15);
  border: 1px solid rgba(255, 193, 7, 0.35);
  color: var(--bu-gold);
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 30px;
  margin-bottom: 12px;
}
.bu-hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(28px, 3.8vw, 44px);
  font-weight: 800;
  line-height: 1.18;
  color: #ffffff;
  margin: 0 0 12px 0;
}
.bu-hero-title em {
  font-style: italic;
  color: var(--bu-gold);
}
.bu-hero-desc {
  font-size: 14.5px;
  color: rgba(255,255,255,0.85);
  line-height: 1.6;
  margin: 0 0 20px 0;
  max-width: 620px;
}

/* Hero CTA Buttons */
.bu-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 22px;
}
.bu-btn-gold {
  background: var(--bu-gold);
  color: var(--bu-navy);
  font-weight: 800;
  font-size: 13px;
  padding: 10px 22px;
  border-radius: 6px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 14px rgba(255,193,7,0.3);
}
.bu-btn-gold:hover {
  background: #ffffff;
  color: var(--bu-navy);
  transform: translateY(-2px);
}
.bu-btn-outline-white {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.3);
  color: #ffffff;
  font-weight: 700;
  font-size: 13px;
  padding: 10px 20px;
  border-radius: 6px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.25s ease;
}
.bu-btn-outline-white:hover {
  background: rgba(255,255,255,0.2);
  color: #ffffff;
  border-color: #ffffff;
}

/* Hero Stat Grid (Right Side) */
.bu-hero-stats-card {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.16);
  backdrop-filter: blur(12px);
  border-radius: 14px;
  padding: 24px;
  box-shadow: 0 16px 36px rgba(0,0,0,0.25);
}
.bu-hero-stats-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}
.bu-hero-stat-box {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 10px;
  padding: 14px 16px;
  text-align: center;
  transition: transform 0.2s ease;
}
.bu-hero-stat-box:hover {
  transform: translateY(-3px);
  background: rgba(255,255,255,0.1);
}
.bu-hero-stat-num {
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-gold);
  line-height: 1.1;
  margin-bottom: 4px;
}
.bu-hero-stat-lbl {
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: rgba(255,255,255,0.85);
}

/* =========================================================
   2. STICKY SUB-NAVIGATION BAR (COMPACT)
   ========================================================= */
.bu-res-nav-bar {
  background: #ffffff;
  border-bottom: 1px solid var(--bu-border);
  box-shadow: 0 3px 12px rgba(0,0,0,0.04);
  position: sticky;
  top: 0;
  z-index: 99;
}
.bu-res-nav-container {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 16px;
  display: flex;
  align-items: center;
  overflow-x: auto;
  scrollbar-width: none;
}
.bu-res-nav-container::-webkit-scrollbar { display: none; }
.bu-res-nav-link {
  padding: 14px 18px;
  font-size: 13px;
  font-weight: 700;
  color: var(--bu-text-muted);
  text-decoration: none;
  white-space: nowrap;
  border-bottom: 3px solid transparent;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  gap: 6px;
}
.bu-res-nav-link:hover, .bu-res-nav-link.active {
  color: var(--bu-navy);
  border-bottom-color: var(--bu-gold);
  background: rgba(255,193,7,0.06);
}

/* =========================================================
   3. SECTION LAYOUT & COMPACT SPACING
   ========================================================= */
.bu-res-portal {
  background: #FAF9F6;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--bu-text-dark);
  padding: 30px 16px 50px;
}
.bu-res-wrap {
  max-width: 1240px;
  margin: 0 auto;
}

/* Section Header (Compact) */
.bu-sec-title-wrap {
  text-align: center;
  max-width: 750px;
  margin: 0 auto 24px;
}
.bu-badge-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--bu-gold-light);
  color: #8D6B00;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 4px 14px;
  border-radius: 50px;
  border: 1px solid rgba(217,155,0,0.25);
  margin-bottom: 8px;
}
.bu-sec-title {
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 8px;
  line-height: 1.25;
  font-family: 'Playfair Display', serif;
}
.bu-sec-title em {
  color: var(--bu-gold-dark);
  font-style: italic;
}
.bu-sec-desc {
  font-size: 14px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin: 0;
}

/* =========================================================
   4. BHABHA PHARMACY RESEARCH LABS (DISTINCT LIGHT R&D THEME)
   ========================================================= */
.bu-pharm-card {
  background: #ffffff !important;
  border-radius: 14px !important;
  border: 1px solid var(--bu-border) !important;
  border-top: 4px solid var(--bu-gold) !important;
  padding: 28px 32px !important;
  color: var(--bu-text-dark) !important;
  position: relative !important;
  overflow: hidden !important;
  box-shadow: 0 8px 26px rgba(10,27,84,0.06) !important;
}
.bu-pharm-card::before {
  display: none !important;
}
.bu-pharm-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 20px;
}
.bu-pharm-heading {
  font-size: 26px !important;
  font-weight: 800 !important;
  color: var(--bu-navy) !important;
  margin: 6px 0 8px !important;
  font-family: 'Playfair Display', serif !important;
  line-height: 1.25 !important;
}
.bu-pharm-desc {
  font-size: 14px !important;
  color: var(--bu-text-muted) !important;
  line-height: 1.6 !important;
  max-width: 820px !important;
  margin: 0 !important;
}

/* 4 Trust Certification Cards */
.bu-pharm-cert-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 14px;
  margin: 20px 0;
}
.bu-cert-card {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 12px 14px;
  display: flex;
  align-items: center;
  gap: 12px;
  transition: all 0.2s ease;
}
.bu-cert-card:hover {
  transform: translateY(-2px);
  background: #ffffff;
  border-color: var(--bu-gold);
  box-shadow: 0 4px 14px rgba(10,27,84,0.06);
}
.bu-cert-icon-box {
  width: 42px;
  height: 42px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  flex-shrink: 0;
}
.bu-cert-fssai { background: #ECFDF5; color: #059669; }
.bu-cert-msme { background: #FEF3C7; color: #D97706; }
.bu-cert-gumasta { background: #EFF6FF; color: #2563EB; }
.bu-cert-gmp { background: #F5F3FF; color: #7C3AED; }

.bu-cert-title {
  font-size: 13.5px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 2px;
}
.bu-cert-subtitle {
  font-size: 11.5px;
  color: var(--bu-text-muted);
  font-weight: 600;
}

/* 4 Stat Highlights in White with Colored Left Accent */
.bu-pharm-stats-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  gap: 12px;
  padding-top: 18px;
  border-top: 1px dashed var(--bu-border);
}
.bu-pharm-stat-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 12px 16px;
  display: flex;
  align-items: center;
  gap: 14px;
  transition: all 0.2s ease;
}
.bu-pharm-stat-item:hover {
  background: #ffffff;
  border-color: var(--bu-gold);
  box-shadow: 0 4px 12px rgba(10,27,84,0.05);
}
.bu-pharm-stat-val {
  font-size: 24px;
  font-weight: 800;
  color: var(--bu-navy);
  line-height: 1;
}
.bu-pharm-stat-lbl {
  font-size: 11px;
  font-weight: 700;
  color: var(--bu-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-top: 2px;
}

/* =========================================================
   5. LAUNCHED PRODUCTS (COMPACT STYLISH CARDS)
   ========================================================= */
.bu-products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
  gap: 22px;
}
.bu-prod-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(0,0,0,0.03);
  transition: all 0.25s ease;
  display: flex;
  flex-direction: column;
}
.bu-prod-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 28px rgba(10,27,84,0.1);
  border-color: rgba(255,193,7,0.7);
}
.bu-prod-header {
  padding: 24px 20px;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #F1F5F9;
}
.bu-prod-badge-left {
  background: var(--bu-navy);
  color: var(--bu-gold);
  font-size: 11px;
  font-weight: 800;
  padding: 4px 10px;
  border-radius: 14px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.bu-prod-badge-right {
  background: #10B981;
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 14px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.bu-prod-icon-circle {
  width: 56px;
  height: 56px;
  border-radius: 12px;
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  color: var(--bu-gold);
  font-size: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(10,27,84,0.2);
}
.bu-prod-body {
  padding: 20px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}
.bu-prod-sub {
  font-size: 11.5px;
  font-weight: 700;
  color: var(--bu-gold-dark);
  text-transform: uppercase;
  letter-spacing: 0.6px;
  margin-bottom: 6px;
}
.bu-prod-title {
  font-size: 19px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 8px;
}
.bu-prod-desc {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin-bottom: 14px;
  flex-grow: 1;
}
.bu-prod-specs {
  background: var(--bu-gray-bg);
  border-radius: 8px;
  padding: 10px 14px;
  margin-bottom: 14px;
  font-size: 12px;
}
.bu-prod-spec-row {
  display: flex;
  justify-content: space-between;
  padding: 3px 0;
  border-bottom: 1px dashed #E2E8F0;
}
.bu-prod-spec-row:last-child { border-bottom: none; }
.bu-prod-spec-lbl { color: var(--bu-text-muted); font-weight: 500; }
.bu-prod-spec-val { color: var(--bu-navy); font-weight: 700; }

/* =========================================================
   6. INCUBATION & EDC (COMPACT)
   ========================================================= */
.bu-innov-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
  gap: 22px;
}
.bu-innov-box {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 26px 24px;
  border-left: 4px solid var(--bu-navy);
  box-shadow: 0 6px 18px rgba(0,0,0,0.02);
  transition: all 0.25s ease;
}
.bu-innov-box:hover {
  transform: translateY(-3px);
  border-left-color: var(--bu-gold);
  box-shadow: 0 10px 24px rgba(10,27,84,0.07);
}
.bu-innov-header {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 14px;
}
.bu-innov-icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  background: rgba(10,27,84,0.06);
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.bu-innov-box:hover .bu-innov-icon {
  background: var(--bu-navy);
  color: var(--bu-gold);
}
.bu-innov-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0;
}
.bu-innov-desc {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.6;
  margin-bottom: 14px;
}
.bu-innov-bullets {
  list-style: none;
  padding: 0;
  margin: 0;
}
.bu-innov-bullets li {
  font-size: 13px;
  color: var(--bu-text-dark);
  padding: 5px 0 5px 20px;
  position: relative;
}
.bu-innov-bullets li::before {
  content: '✓';
  position: absolute;
  left: 0;
  color: #10B981;
  font-weight: 900;
}

/* =========================================================
   7. RESEARCH PILLARS & DOMAINS (COMPACT GRID)
   ========================================================= */
.bu-res-domains-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 14px;
}
.bu-domain-item {
  background: #fff;
  border: 1px solid var(--bu-border);
  border-radius: 10px;
  padding: 14px 16px;
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
  transition: all 0.2s ease;
}
.bu-domain-item:hover {
  background: var(--bu-navy);
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(10,27,84,0.12);
}
.bu-domain-icon {
  width: 38px;
  height: 38px;
  border-radius: 8px;
  background: var(--bu-gray-bg);
  color: var(--bu-navy-light);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
  transition: all 0.2s ease;
}
.bu-domain-item:hover .bu-domain-icon {
  background: rgba(255,255,255,0.15);
  color: var(--bu-gold);
}
.bu-domain-title {
  font-size: 13.5px;
  font-weight: 700;
  color: inherit;
  line-height: 1.35;
}

/* =========================================================
   8. DATA TABLES CARD (COMPACT)
   ========================================================= */
.bu-tables-card {
  background: #ffffff;
  border-radius: 14px;
  border: 1px solid var(--bu-border);
  padding: 24px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.03);
}
.bu-table-tabs {
  display: flex;
  gap: 8px;
  border-bottom: 2px solid var(--bu-border);
  margin-bottom: 18px;
  overflow-x: auto;
  scrollbar-width: none;
}
.bu-table-tab-btn {
  padding: 10px 18px;
  font-size: 13.5px;
  font-weight: 700;
  border: none;
  background: transparent;
  color: var(--bu-text-muted);
  cursor: pointer;
  border-bottom: 3px solid transparent;
  margin-bottom: -2px;
  transition: all 0.2s ease;
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: 7px;
}
.bu-table-tab-btn.active {
  color: var(--bu-navy);
  border-bottom-color: var(--bu-gold);
  font-weight: 800;
}
.bu-tab-panel { display: none; }
.bu-tab-panel.active { display: block; animation: fadeIn 0.25s ease; }
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(4px); }
  to { opacity: 1; transform: translateY(0); }
}
.bu-responsive-table {
  width: 100%;
  overflow-x: auto;
  border-radius: 8px;
  border: 1px solid var(--bu-border);
}
.bu-data-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13px;
  text-align: left;
}
.bu-data-table th {
  background: #F1F5F9;
  color: var(--bu-navy);
  font-weight: 700;
  padding: 12px 14px;
  border-bottom: 2px solid var(--bu-border);
  white-space: nowrap;
}
.bu-data-table td {
  padding: 11px 14px;
  border-bottom: 1px solid var(--bu-border);
  color: var(--bu-text-dark);
  vertical-align: top;
}
.bu-data-table tr:hover td { background: #F8FAFC; }
.bu-tag-index {
  display: inline-block;
  background: #E0E7FF;
  color: #3730A3;
  font-size: 10.5px;
  font-weight: 700;
  padding: 2px 7px;
  border-radius: 4px;
}
.bu-tag-patent {
  display: inline-block;
  background: #FEF3C7;
  color: #92400E;
  font-size: 10.5px;
  font-weight: 700;
  padding: 2px 7px;
  border-radius: 4px;
}

/* =========================================================
   9. PUBLICATIONS & MEDIA (COMPACT)
   ========================================================= */
.bu-media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 18px;
}
.bu-media-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 20px;
  text-align: center;
  transition: all 0.25s ease;
  box-shadow: 0 4px 14px rgba(0,0,0,0.03);
}
.bu-media-card:hover {
  transform: translateY(-3px);
  border-color: var(--bu-gold);
  box-shadow: 0 10px 22px rgba(10,27,84,0.07);
}
.bu-media-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--bu-gold-light);
  color: var(--bu-gold-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin: 0 auto 12px;
}
.bu-media-title {
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 6px;
}
.bu-media-desc {
  font-size: 13px;
  color: var(--bu-text-muted);
  line-height: 1.5;
  margin-bottom: 14px;
}
.bu-media-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12.5px;
  font-weight: 700;
  color: var(--bu-navy);
  text-decoration: none;
  padding: 7px 16px;
  background: var(--bu-gray-bg);
  border-radius: 6px;
  border: 1px solid var(--bu-border);
  transition: all 0.2s ease;
}
.bu-media-btn:hover {
  background: var(--bu-navy);
  color: #fff;
  border-color: var(--bu-navy);
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- =========================================================
       HERO BANNER SECTION (CUSTOM LUXURY HIGH-IMPACT DESIGN)
       ========================================================= -->
  <div class="bu-hero-research">
    <div class="bu-hero-research-container">
      
      <!-- LEFT: Hero Content & Actions -->
      <div>
        <ul class="bu-hero-breadcrumb">
          <li><a href="<?php echo URL_ROOT; ?>">Home</a></li>
          <li class="sep">›</li>
          <li class="active">Research &amp; Innovation</li>
        </ul>

        <div class="bu-hero-badge">
          <i class="fa fa-flask"></i> Centre for Advanced Research &amp; Excellence
        </div>

        <h1 class="bu-hero-title">
          Research, Innovation &amp; <em>Enterprise</em>
        </h1>

        <p class="bu-hero-desc">
          Advancing cutting-edge pharmaceutical formulations, commercial product development, student startup incubation, and global indexed publications at Bhabha University Bhopal.
        </p>

        <!-- Quick Jump Buttons -->
        <div class="bu-hero-actions">
          <a href="#launched-products" class="bu-btn-gold">
            <i class="fa fa-cube"></i> Launched Products (15 Aug)
          </a>
          <a href="#patents-publications" class="bu-btn-outline-white">
            <i class="fa fa-database"></i> Patents &amp; Papers
          </a>
          <a href="#incubation-edc" class="bu-btn-outline-white">
            <i class="fa fa-lightbulb-o"></i> Incubation Centre
          </a>
        </div>
      </div>

      <!-- RIGHT: Glassmorphic Metrics Card -->
      <div>
        <div class="bu-hero-stats-card">
          <div style="font-size:12px;font-weight:800;letter-spacing:1px;color:var(--bu-gold);text-transform:uppercase;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
            <i class="fa fa-line-chart"></i> Research Milestones at a Glance
          </div>
          <div class="bu-hero-stats-grid">
            <div class="bu-hero-stat-box">
              <div class="bu-hero-stat-num">250+</div>
              <div class="bu-hero-stat-lbl">Patents Filed</div>
            </div>
            <div class="bu-hero-stat-box">
              <div class="bu-hero-stat-num">1,200+</div>
              <div class="bu-hero-stat-lbl">Scopus / UGC Papers</div>
            </div>
            <div class="bu-hero-stat-box">
              <div class="bu-hero-stat-num">₹85 Cr+</div>
              <div class="bu-hero-stat-lbl">Active Grants</div>
            </div>
            <div class="bu-hero-stat-box">
              <div class="bu-hero-stat-num">60+</div>
              <div class="bu-hero-stat-lbl">Global &amp; Ind. MoUs</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Quick Sticky Sub-Navigation -->
  <div class="bu-res-nav-bar">
    <div class="bu-res-nav-container">
      <a href="#pharmacy-labs" class="bu-res-nav-link active"><i class="fa fa-medkit"></i> Pharmacy Labs</a>
      <a href="#launched-products" class="bu-res-nav-link"><i class="fa fa-cube"></i> Launched Products</a>
      <a href="#incubation-edc" class="bu-res-nav-link"><i class="fa fa-lightbulb-o"></i> Incubation &amp; EDC</a>
      <a href="#research-domains" class="bu-res-nav-link"><i class="fa fa-th-large"></i> Research Domains</a>
      <a href="#patents-publications" class="bu-res-nav-link"><i class="fa fa-table"></i> Patents &amp; Papers</a>
      <a href="#media-publications" class="bu-res-nav-link"><i class="fa fa-newspaper-o"></i> E-Newsletter &amp; Blogs</a>
    </div>
  </div>

  <div class="bu-res-portal">
    <div class="bu-res-wrap">

      <!-- ================= 1. BHABHA PHARMACY RESEARCH LABORATORIES ================= -->
      <section id="pharmacy-labs" style="scroll-margin-top: 60px;">
        <div class="bu-pharm-card">
          
          <!-- Top Header Info -->
          <div class="bu-pharm-top">
            <div>
              <span class="bu-badge-pill" style="background:#FFF9E6; color:#92400E; border:1px solid #FDE68A;">
                <i class="fa fa-flask"></i> CENTRE OF EXCELLENCE · R&amp;D FACILITY
              </span>
              <h2 class="bu-pharm-heading">
                Bhabha Pharmacy Research Laboratories
              </h2>
              <p class="bu-pharm-desc">
                Pioneering formulation development, phytochemical research, analytical testing, and commercial health innovations under stringent national regulatory approvals and standardization protocols.
              </p>
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
              <span style="background:#0A1B54;color:#FFC107;font-size:12px;font-weight:800;padding:6px 14px;border-radius:20px;letter-spacing:0.8px;text-transform:uppercase;">
                <i class="fa fa-certificate"></i> Certified Facility
              </span>
            </div>
          </div>

          <!-- 4 Regulatory Approvals & Certifications Grid -->
          <div class="bu-pharm-cert-grid">
            
            <div class="bu-cert-card">
              <div class="bu-cert-icon-box bu-cert-fssai">
                <i class="fa fa-check-circle"></i>
              </div>
              <div>
                <div class="bu-cert-title">FSSAI Approved</div>
                <div class="bu-cert-subtitle">Food Safety &amp; Standards Authority</div>
              </div>
            </div>

            <div class="bu-cert-card">
              <div class="bu-cert-icon-box bu-cert-msme">
                <i class="fa fa-certificate"></i>
              </div>
              <div>
                <div class="bu-cert-title">MSME Registered</div>
                <div class="bu-cert-subtitle">Ministry of MSME, Govt. of India</div>
              </div>
            </div>

            <div class="bu-cert-card">
              <div class="bu-cert-icon-box bu-cert-gumasta">
                <i class="fa fa-shield"></i>
              </div>
              <div>
                <div class="bu-cert-title">Gumasta Licensed</div>
                <div class="bu-cert-subtitle">Municipal Trade Registration</div>
              </div>
            </div>

            <div class="bu-cert-card">
              <div class="bu-cert-icon-box bu-cert-gmp">
                <i class="fa fa-industry"></i>
              </div>
              <div>
                <div class="bu-cert-title">GMP Compliant</div>
                <div class="bu-cert-subtitle">Standardized Testing Labs</div>
              </div>
            </div>

          </div>

          <!-- 4 Lab Stat Highlights in Soft Clean Cards -->
          <div class="bu-pharm-stats-row">
            
            <div class="bu-pharm-stat-item">
              <div style="width:40px;height:40px;border-radius:8px;background:#ECFDF5;color:#059669;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                <i class="fa fa-cubes"></i>
              </div>
              <div>
                <div class="bu-pharm-stat-val" style="color:#059669;">3+</div>
                <div class="bu-pharm-stat-lbl">Commercial Products</div>
              </div>
            </div>

            <div class="bu-pharm-stat-item">
              <div style="width:40px;height:40px;border-radius:8px;background:#EFF6FF;color:#2563EB;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                <i class="fa fa-shield"></i>
              </div>
              <div>
                <div class="bu-pharm-stat-val" style="color:#2563EB;">100%</div>
                <div class="bu-pharm-stat-lbl">Regulatory Compliance</div>
              </div>
            </div>

            <div class="bu-pharm-stat-item">
              <div style="width:40px;height:40px;border-radius:8px;background:#FEF3C7;color:#D97706;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                <i class="fa fa-users"></i>
              </div>
              <div>
                <div class="bu-pharm-stat-val" style="color:#D97706;">25+</div>
                <div class="bu-pharm-stat-lbl">Faculty Researchers</div>
              </div>
            </div>

            <div class="bu-pharm-stat-item">
              <div style="width:40px;height:40px;border-radius:8px;background:#F5F3FF;color:#7C3AED;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                <i class="fa fa-flask"></i>
              </div>
              <div>
                <div class="bu-pharm-stat-val" style="color:#7C3AED;">12+</div>
                <div class="bu-pharm-stat-lbl">Active R&amp;D Projects</div>
              </div>
            </div>

          </div>

        </div>
      </section>

      <!-- ================= 2. LAUNCHED PRODUCTS (15th August Launch) ================= -->
      <section id="launched-products" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="fa fa-rocket"></i> Commercial Innovations</span>
          <h2 class="bu-sec-title">Products Developed &amp; <em>Launched</em></h2>
          <p class="bu-sec-desc">
            Formulated and commercially launched by Bhabha Pharmacy Research Laboratories on 15th August, adhering to pharmaceutical purity standards.
          </p>
        </div>

        <div class="bu-products-grid">
          
          <!-- Product 1: Dextro Zing (Jeera) -->
          <div class="bu-prod-card">
            <div class="bu-prod-header">
              <div class="bu-prod-icon-circle">
                <i class="fa fa-coffee"></i>
              </div>
              <div style="text-align:right;">
                <span class="bu-prod-badge-left"><i class="fa fa-calendar"></i> 15 Aug Launch</span>
                <div style="margin-top:6px;">
                  <span class="bu-prod-badge-right"><i class="fa fa-check"></i> FSSAI Approved</span>
                </div>
              </div>
            </div>
            <div class="bu-prod-body">
              <div class="bu-prod-sub">Nutraceutical Formulation</div>
              <h3 class="bu-prod-title">Dextro Zing (Jeera)</h3>
              <p class="bu-prod-desc">
                Instant energy formulation enriched with digestive cumin (Jeera) extracts and essential electrolytes for rapid replenishment.
              </p>
              <div class="bu-prod-specs">
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Category:</span>
                  <span class="bu-prod-spec-val">Oral Electrolyte &amp; Energy</span>
                </div>
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Flavour:</span>
                  <span class="bu-prod-spec-val">Natural Refreshing Jeera</span>
                </div>
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Registration:</span>
                  <span class="bu-prod-spec-val">FSSAI / MSME Approved</span>
                </div>
              </div>
              <div style="font-size:11.5px;color:var(--bu-text-muted);display:flex;align-items:center;gap:6px;">
                <i class="fa fa-building-o" style="color:var(--bu-gold-dark);"></i> Bhabha Pharmacy Research Labs
              </div>
            </div>
          </div>

          <!-- Product 2: Energy Drink -->
          <div class="bu-prod-card">
            <div class="bu-prod-header">
              <div class="bu-prod-icon-circle">
                <i class="fa fa-bolt"></i>
              </div>
              <div style="text-align:right;">
                <span class="bu-prod-badge-left"><i class="fa fa-calendar"></i> 15 Aug Launch</span>
                <div style="margin-top:6px;">
                  <span class="bu-prod-badge-right"><i class="fa fa-check"></i> FSSAI Approved</span>
                </div>
              </div>
            </div>
            <div class="bu-prod-body">
              <div class="bu-prod-sub">Health &amp; Vitality Drink</div>
              <h3 class="bu-prod-title">Bhabha Energy Drink</h3>
              <p class="bu-prod-desc">
                Scientifically balanced revitalizing beverage designed with active vitamins, minerals, and revitalizing supplements.
              </p>
              <div class="bu-prod-specs">
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Category:</span>
                  <span class="bu-prod-spec-val">Nutritional Beverage</span>
                </div>
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Key Nutrients:</span>
                  <span class="bu-prod-spec-val">Vitamin B Complex &amp; Taurine</span>
                </div>
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Testing:</span>
                  <span class="bu-prod-spec-val">Lab Standardized</span>
                </div>
              </div>
              <div style="font-size:11.5px;color:var(--bu-text-muted);display:flex;align-items:center;gap:6px;">
                <i class="fa fa-building-o" style="color:var(--bu-gold-dark);"></i> Bhabha Pharmacy Research Labs
              </div>
            </div>
          </div>

          <!-- Product 3: Aloe Vera Gel -->
          <div class="bu-prod-card">
            <div class="bu-prod-header">
              <div class="bu-prod-icon-circle">
                <i class="fa fa-leaf"></i>
              </div>
              <div style="text-align:right;">
                <span class="bu-prod-badge-left"><i class="fa fa-calendar"></i> 15 Aug Launch</span>
                <div style="margin-top:6px;">
                  <span class="bu-prod-badge-right"><i class="fa fa-check"></i> Herbal Pure</span>
                </div>
              </div>
            </div>
            <div class="bu-prod-body">
              <div class="bu-prod-sub">Herbal Skincare &amp; Cosmetic</div>
              <h3 class="bu-prod-title">Pure Aloe Vera Gel</h3>
              <p class="bu-prod-desc">
                Cold-pressed Aloe barbadensis leaf extract enriched with natural Vitamin E. Hypoallergenic and soothing formulation.
              </p>
              <div class="bu-prod-specs">
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Formulation:</span>
                  <span class="bu-prod-spec-val">99% Pure Organic Aloe</span>
                </div>
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Properties:</span>
                  <span class="bu-prod-spec-val">Paraben &amp; Sulphate Free</span>
                </div>
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl">Testing:</span>
                  <span class="bu-prod-spec-val">Dermatologically Safe</span>
                </div>
              </div>
              <div style="font-size:11.5px;color:var(--bu-text-muted);display:flex;align-items:center;gap:6px;">
                <i class="fa fa-building-o" style="color:var(--bu-gold-dark);"></i> Bhabha Pharmacy Research Labs
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- ================= 3. INCUBATION & ENTREPRENEURSHIP CELL ================= -->
      <section id="incubation-edc" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="fa fa-building"></i> Startup Ecosystem</span>
          <h2 class="bu-sec-title">Incubation Centre &amp; <em>EDC</em></h2>
          <p class="bu-sec-desc">
            Empowering students and faculty to transform innovative ideas into viable enterprises through mentorship and prototyping facilities.
          </p>
        </div>

        <div class="bu-innov-grid">
          <!-- Box 1 -->
          <div class="bu-innov-box">
            <div class="bu-innov-header">
              <div class="bu-innov-icon"><i class="fa fa-industry"></i></div>
              <h3 class="bu-innov-title">University / Industrial Incubation Centre</h3>
            </div>
            <p class="bu-innov-desc">
              Bridging academia with industry by offering pre-incubation, prototyping lab facilities, intellectual property guidance, and investor access.
            </p>
            <ul class="bu-innov-bullets">
              <li>Comprehensive Prototype Development &amp; Pilot Testing Labs</li>
              <li>Seed funding support &amp; government grant proposal guidance</li>
              <li>Corporate technology transfer &amp; patent filing assistance</li>
            </ul>
          </div>

          <!-- Box 2 -->
          <div class="bu-innov-box">
            <div class="bu-innov-header">
              <div class="bu-innov-icon"><i class="fa fa-line-chart"></i></div>
              <h3 class="bu-innov-title">Entrepreneurship Development Cell (EDC)</h3>
            </div>
            <p class="bu-innov-desc">
              Cultivating an entrepreneurial mindset across all faculties through bootcamps, business plan competitions, and startup pitch events.
            </p>
            <ul class="bu-innov-bullets">
              <li>Annual Startup Summits, Hackathons &amp; Pitch Competitions</li>
              <li>One-on-one mentorship by experienced founders &amp; angel networks</li>
              <li>Legal and financial advisory for corporate registration &amp; compliance</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- ================= 4. RESEARCH PILLARS & DOMAINS ================= -->
      <section id="research-domains" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="fa fa-sitemap"></i> Academic Framework</span>
          <h2 class="bu-sec-title">Research Pillars &amp; <em>Framework</em></h2>
          <p class="bu-sec-desc">
            Institutional framework governing interdisciplinary research, ethical compliance, and technology transfers.
          </p>
        </div>

        <div class="bu-res-domains-grid">
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-compass"></i></div>
            <div class="bu-domain-title">Research Overview &amp; Mandate</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-bullseye"></i></div>
            <div class="bu-domain-title">Vision &amp; Mission of Research</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-handshake-o"></i></div>
            <div class="bu-domain-title">Collaborations &amp; MoUs</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-tasks"></i></div>
            <div class="bu-domain-title">Funded Research Projects</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-certificate"></i></div>
            <div class="bu-domain-title">Patents &amp; Publications</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-graduation-cap"></i></div>
            <div class="bu-domain-title">Faculty Training Programs</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-shield"></i></div>
            <div class="bu-domain-title">Ethical Committee</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-cogs"></i></div>
            <div class="bu-domain-title">Skill Development Programs</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-users"></i></div>
            <div class="bu-domain-title">Workshops, Seminars &amp; CDE</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-video-camera"></i></div>
            <div class="bu-domain-title">R&amp;D Videos</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-exchange"></i></div>
            <div class="bu-domain-title">Transfer of Technology (ToT)</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-trophy"></i></div>
            <div class="bu-domain-title">Research Achievements</div>
          </div>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="fa fa-book"></i></div>
            <div class="bu-domain-title">University Research Policy</div>
          </div>
        </div>
      </section>

      <!-- ================= 5. PATENTS, RESEARCH PAPERS & BOOKS TABLES ================= -->
      <section id="patents-publications" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="fa fa-database"></i> Scholarly Records</span>
          <h2 class="bu-sec-title">Patents, Publications &amp; <em>Research Papers</em></h2>
          <p class="bu-sec-desc">
            Verified repository of filed patents, indexed papers (Scopus, UGC CARE), and authored book chapters.
          </p>
        </div>

        <div class="bu-tables-card">
          <!-- Table Tab Navigation -->
          <div class="bu-table-tabs">
            <button class="bu-table-tab-btn active" onclick="switchTableTab(event, 'tab-patents')">
              <i class="fa fa-lightbulb-o"></i> Patent Filing Records
            </button>
            <button class="bu-table-tab-btn" onclick="switchTableTab(event, 'tab-papers')">
              <i class="fa fa-file-text-o"></i> Research Paper List
            </button>
            <button class="bu-table-tab-btn" onclick="switchTableTab(event, 'tab-books')">
              <i class="fa fa-book"></i> Books &amp; Chapters Published
            </button>
          </div>

          <!-- TAB 1: PATENTS TABLE -->
          <div id="tab-patents" class="bu-tab-panel active">
            <div style="margin-bottom:12px;font-size:12.5px;color:var(--bu-text-muted);display:flex;justify-content:space-between;align-items:center;">
              <span>Official patent applications submitted by university faculty and researchers.</span>
              <span class="bu-tag-patent">Format: IPO Indian Patent Office</span>
            </div>
            <div class="bu-responsive-table">
              <table class="bu-data-table">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Patent App No.</th>
                    <th>Applicant</th>
                    <th>Title of Invention</th>
                    <th>Inventor(s)</th>
                    <th>Department</th>
                    <th>Filing Date</th>
                    <th>Type</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="9" style="text-align:center; padding:36px 20px; color:#64748B;">
                      <i class="fa fa-folder-open-o" style="font-size:28px; color:#94A3B8; display:block; margin-bottom:8px;"></i>
                      <strong style="font-size:14px; color:var(--bu-navy); display:block; margin-bottom:4px;">No Patent Records Available</strong>
                      <span style="font-size:12.5px; color:#94A3B8;">Official patent filing data will be updated upon departmental submission.</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- TAB 2: RESEARCH PAPERS TABLE -->
          <div id="tab-papers" class="bu-tab-panel">
            <div style="margin-bottom:12px;font-size:12.5px;color:var(--bu-text-muted);display:flex;justify-content:space-between;align-items:center;">
              <span>Papers indexed in Scopus, SCIE, UGC Care Group I &amp; II, and PubMed journals.</span>
              <span class="bu-tag-index">Indexed Repository</span>
            </div>
            <div class="bu-responsive-table">
              <table class="bu-data-table">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>ISSN</th>
                    <th>Title of Paper</th>
                    <th>Author ORCID</th>
                    <th>Author(s)</th>
                    <th>Department</th>
                    <th>Journal Name</th>
                    <th>Indexing</th>
                    <th>Link</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="9" style="text-align:center; padding:36px 20px; color:#64748B;">
                      <i class="fa fa-folder-open-o" style="font-size:28px; color:#94A3B8; display:block; margin-bottom:8px;"></i>
                      <strong style="font-size:14px; color:var(--bu-navy); display:block; margin-bottom:4px;">No Research Papers Available</strong>
                      <span style="font-size:12.5px; color:#94A3B8;">Official publications list will be updated upon departmental submission.</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- TAB 3: BOOKS & CHAPTERS TABLE -->
          <div id="tab-books" class="bu-tab-panel">
            <div style="margin-bottom:12px;font-size:12.5px;color:var(--bu-text-muted);">
              <span>Authored reference textbooks and chapters published by recognized national and international publishers.</span>
            </div>
            <div class="bu-responsive-table">
              <table class="bu-data-table">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Teacher Name</th>
                    <th>Book Title</th>
                    <th>Chapter Title</th>
                    <th>Year</th>
                    <th>ISBN Number</th>
                    <th>Publisher</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="7" style="text-align:center; padding:36px 20px; color:#64748B;">
                      <i class="fa fa-folder-open-o" style="font-size:28px; color:#94A3B8; display:block; margin-bottom:8px;"></i>
                      <strong style="font-size:14px; color:var(--bu-navy); display:block; margin-bottom:4px;">No Books / Chapters Available</strong>
                      <span style="font-size:12.5px; color:#94A3B8;">Official authored books and chapters records will be updated upon departmental submission.</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>

      <!-- ================= 6. E-NEWSLETTER, MAGAZINE & BLOGS ================= -->
      <section id="media-publications" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="fa fa-bookmark"></i> Publications</span>
          <h2 class="bu-sec-title">E-Newsletter, Magazine &amp; <em>Blogs</em></h2>
          <p class="bu-sec-desc">
            Stay updated with quarterly research updates, student magazines, and academic insights.
          </p>
        </div>

        <div class="bu-media-grid">
          <!-- Card 1 -->
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="fa fa-envelope-open-o"></i></div>
            <h3 class="bu-media-title">E-Newsletter</h3>
            <p class="bu-media-desc">Quarterly digest featuring campus events, academic milestones, and research discoveries.</p>
            <a href="<?php echo href('news.php'); ?>" class="bu-media-btn">
              <i class="fa fa-download"></i> View Newsletters
            </a>
          </div>

          <!-- Card 2 -->
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="fa fa-book"></i></div>
            <h3 class="bu-media-title">University Magazine</h3>
            <p class="bu-media-desc">Annual flagship publication highlighting creative writing and institutional milestones.</p>
            <a href="<?php echo href('news.php'); ?>" class="bu-media-btn">
              <i class="fa fa-file-pdf-o"></i> Read Magazine
            </a>
          </div>

          <!-- Card 3 -->
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="fa fa-rss"></i></div>
            <h3 class="bu-media-title">Research &amp; Tech Blog</h3>
            <p class="bu-media-desc">Opinion pieces, case studies, and faculty perspectives on emerging technology and healthcare.</p>
            <a href="<?php echo href('news.php'); ?>" class="bu-media-btn">
              <i class="fa fa-external-link"></i> Explore Blogs
            </a>
          </div>
        </div>
      </section>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- Scripts -->
<?php include('inc.footer.js.php');?>
<script>
function switchTableTab(evt, tabId) {
  var panels = document.querySelectorAll('.bu-tab-panel');
  var btns = document.querySelectorAll('.bu-table-tab-btn');
  
  panels.forEach(function(p) { p.classList.remove('active'); });
  btns.forEach(function(b) { b.classList.remove('active'); });
  
  var target = document.getElementById(tabId);
  if (target) target.classList.add('active');
  if (evt && evt.currentTarget) evt.currentTarget.classList.add('active');
}

// Smooth scroll active state for sticky sub-nav
document.addEventListener('DOMContentLoaded', function() {
  var navLinks = document.querySelectorAll('.bu-res-nav-link');
  window.addEventListener('scroll', function() {
    var fromTop = window.scrollY + 100;
    navLinks.forEach(function(link) {
      var section = document.querySelector(link.getAttribute('href'));
      if (section && section.offsetTop <= fromTop && (section.offsetTop + section.offsetHeight) > fromTop) {
        navLinks.forEach(function(l) { l.classList.remove('active'); });
        link.classList.add('active');
      }
    });
  });
});
</script>
</body>
</html>
