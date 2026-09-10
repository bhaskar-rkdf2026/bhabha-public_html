<?php 
include_once('config.php');

// Dynamically load Research & Innovation Portal configuration from DB
$portal_sections = [];
if (isset($db) && is_object($db)) {
    $rawPortal = $db->get('research_portal');
    if (!empty($rawPortal)) {
        foreach ($rawPortal as $ps) {
            $ps['extra'] = !empty($ps['extra_data']) ? json_decode($ps['extra_data'], true) : [];
            $portal_sections[$ps['section_key']] = $ps;
        }
    }
}

if (!function_exists('getPortalSec')) {
    function getPortalSec($key, $default = []) {
        global $portal_sections;
        return $portal_sections[$key] ?? $default;
    }
}

if (!function_exists('isPortalSecActive')) {
    function isPortalSecActive($key) {
        global $portal_sections;
        if (!isset($portal_sections[$key])) return true;
        return ($portal_sections[$key]['status'] == 1);
    }
}

// Fallback metrics if not set in hero
$portal_metrics = [
    ['target' => 250, 'value' => '250', 'suffix' => '+', 'prefix' => '', 'commas' => false, 'label' => 'Patents Filed'],
    ['target' => 1200, 'value' => '1200', 'suffix' => '+', 'prefix' => '', 'commas' => true, 'label' => 'Scopus / UGC Papers'],
    ['target' => 85, 'value' => '85', 'suffix' => ' Cr', 'prefix' => '₹', 'commas' => false, 'label' => 'Active Grants'],
    ['target' => 60, 'value' => '60', 'suffix' => '+', 'prefix' => '', 'commas' => false, 'label' => 'Global & Ind. MoUs']
];
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

/* RESET style.css DEFAULT EXCESSIVE PADDINGS & ADD PROPER SECTION SPACING */
.bu-res-portal section,
.kode_wrapper section {
  padding: 15px 0 !important;
  margin: 0 0 75px 0 !important;
  float: none !important;
  overflow: visible !important;
  clear: both !important;
}

/* =========================================================
   1. DEDICATED RESEARCH HERO BANNER (ELEGANT & SPACIOUS)
   ========================================================= */
.bu-hero-research {
  background: linear-gradient(135deg, #030B24 0%, #0A1B54 50%, #061D7C 100%) !important;
  position: relative !important;
  width: 100% !important;
  padding: 70px 30px 65px !important;
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
  gap: 48px;
  align-items: center;
}
@media (max-width: 991px) {
  .bu-hero-research-container { grid-template-columns: 1fr; gap: 32px; }
  .bu-hero-research { padding: 45px 20px 40px !important; }
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
  border-radius: 16px;
  padding: 28px 24px;
  box-shadow: 0 16px 36px rgba(0,0,0,0.25);
}
.bu-hero-stats-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 18px;
}
.bu-hero-stat-box {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 12px;
  padding: 16px 16px;
  text-align: center;
  transition: transform 0.2s ease;
}
.bu-hero-stat-box:hover {
  transform: translateY(-3px);
  background: rgba(255,255,255,0.1);
}
.bu-hero-stat-num {
  font-size: 27px;
  font-weight: 800;
  color: var(--bu-gold);
  line-height: 1.1;
  margin-bottom: 5px;
}
.bu-hero-stat-lbl {
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: rgba(255,255,255,0.85);
}

/* =========================================================
   2. STICKY SUB-NAVIGATION BAR (SPACIOUS)
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
  padding: 0 24px;
  display: flex;
  align-items: center;
  overflow-x: auto;
  scrollbar-width: none;
}
.bu-res-nav-container::-webkit-scrollbar { display: none; }
.bu-res-nav-link {
  padding: 16px 22px;
  font-size: 13.5px;
  font-weight: 700;
  color: var(--bu-text-muted);
  text-decoration: none;
  white-space: nowrap;
  border-bottom: 3px solid transparent;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-res-nav-link:hover, .bu-res-nav-link.active {
  color: var(--bu-navy);
  border-bottom-color: var(--bu-gold);
  background: rgba(255,193,7,0.06);
}

/* =========================================================
   3. SECTION LAYOUT & GENEROUS SPACING
   ========================================================= */
.bu-res-portal {
  background: #FAF9F6;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--bu-text-dark);
  padding: 60px 24px 90px;
}
@media (max-width: 767px) {
  .bu-res-portal { padding: 40px 16px 60px; }
}
.bu-res-wrap {
  max-width: 1240px;
  margin: 0 auto;
}

/* Section Header (Spacious) */
.bu-sec-title-wrap {
  text-align: center;
  max-width: 780px;
  margin: 0 auto 38px;
}
.bu-badge-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--bu-gold-light);
  color: #8D6B00;
  font-size: 11.5px;
  font-weight: 800;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 5px 16px;
  border-radius: 50px;
  border: 1px solid rgba(217,155,0,0.25);
  margin-bottom: 10px;
}
.bu-sec-title {
  font-size: 28px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 10px;
  line-height: 1.25;
  font-family: 'Playfair Display', serif;
}
.bu-sec-title em {
  color: var(--bu-gold-dark);
  font-style: italic;
}
.bu-sec-desc {
  font-size: 14.5px;
  color: var(--bu-text-muted);
  line-height: 1.6;
  margin: 0;
}

/* =========================================================
   4. BHABHA PHARMACY RESEARCH LABS (DISTINCT LIGHT R&D THEME)
   ========================================================= */
.bu-pharm-card {
  background: #ffffff !important;
  border-radius: 16px !important;
  border: 1px solid var(--bu-border) !important;
  border-top: 4px solid var(--bu-gold) !important;
  padding: 38px 40px !important;
  color: var(--bu-text-dark) !important;
  position: relative !important;
  overflow: hidden !important;
  box-shadow: 0 8px 26px rgba(10,27,84,0.06) !important;
}
@media (max-width: 767px) {
  .bu-pharm-card { padding: 24px 20px !important; }
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
  margin-bottom: 26px;
}
.bu-pharm-heading {
  font-size: 28px !important;
  font-weight: 800 !important;
  color: var(--bu-navy) !important;
  margin: 6px 0 10px !important;
  font-family: 'Playfair Display', serif !important;
  line-height: 1.25 !important;
}
.bu-pharm-desc {
  font-size: 14.5px !important;
  color: var(--bu-text-muted) !important;
  line-height: 1.65 !important;
  max-width: 850px !important;
  margin: 0 !important;
}

/* 4 Trust Certification Cards */
.bu-pharm-cert-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 18px;
  margin: 26px 0;
}
.bu-cert-card {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 15px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
  transition: all 0.2s ease;
}
.bu-cert-card:hover {
  transform: translateY(-2px);
  background: #ffffff;
  border-color: var(--bu-gold);
  box-shadow: 0 4px 14px rgba(10,27,84,0.06);
}
.bu-cert-icon-box {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.bu-cert-fssai { background: #ECFDF5; color: #059669; }
.bu-cert-msme { background: #FEF3C7; color: #D97706; }
.bu-cert-gumasta { background: #EFF6FF; color: #2563EB; }
.bu-cert-gmp { background: #F5F3FF; color: #7C3AED; }

.bu-cert-title {
  font-size: 14px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 2px;
}
.bu-cert-subtitle {
  font-size: 12px;
  color: var(--bu-text-muted);
  font-weight: 600;
}

/* 4 Stat Highlights in White with Colored Left Accent */
.bu-pharm-stats-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  gap: 18px;
  padding-top: 24px;
  border-top: 1px dashed var(--bu-border);
}
.bu-pharm-stat-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 14px 18px;
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
  font-size: 25px;
  font-weight: 800;
  color: var(--bu-navy);
  line-height: 1;
}
.bu-pharm-stat-lbl {
  font-size: 11.5px;
  font-weight: 700;
  color: var(--bu-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-top: 2px;
}

/* =========================================================
   5. LAUNCHED PRODUCTS (SPACIOUS STYLISH CARDS)
   ========================================================= */
.bu-products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
  gap: 28px;
}
.bu-prod-card {
  background: #ffffff;
  border-radius: 14px;
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
  padding: 26px 24px;
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
  width: 58px;
  height: 58px;
  border-radius: 14px;
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  color: var(--bu-gold);
  font-size: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(10,27,84,0.2);
}
.bu-prod-body {
  padding: 24px 24px 26px;
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
  font-size: 20px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 8px;
}
.bu-prod-desc {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.6;
  margin-bottom: 18px;
  flex-grow: 1;
}
.bu-prod-specs {
  background: var(--bu-gray-bg);
  border-radius: 10px;
  padding: 12px 16px;
  margin-bottom: 18px;
  font-size: 12px;
}
.bu-prod-spec-row {
  display: flex;
  justify-content: space-between;
  padding: 4px 0;
  border-bottom: 1px dashed #E2E8F0;
}
.bu-prod-spec-row:last-child { border-bottom: none; }
.bu-prod-spec-lbl { color: var(--bu-text-muted); font-weight: 500; }
.bu-prod-spec-val { color: var(--bu-navy); font-weight: 700; }

/* =========================================================
   6. INCUBATION & EDC (SPACIOUS)
   ========================================================= */
.bu-innov-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
  gap: 28px;
}
.bu-innov-box {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 30px 28px;
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
  margin-bottom: 16px;
}
.bu-innov-icon {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  background: rgba(10,27,84,0.06);
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  flex-shrink: 0;
}
.bu-innov-box:hover .bu-innov-icon {
  background: var(--bu-navy);
  color: var(--bu-gold);
}
.bu-innov-title {
  font-size: 19px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0;
}
.bu-innov-desc {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.65;
  margin-bottom: 16px;
}
.bu-innov-bullets {
  list-style: none;
  padding: 0;
  margin: 0;
}
.bu-innov-bullets li {
  font-size: 13px;
  color: var(--bu-text-dark);
  padding: 6px 0 6px 22px;
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
   7. RESEARCH PILLARS & DOMAINS (SPACIOUS GRID)
   ========================================================= */
.bu-res-domains-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 18px;
}
.bu-domain-item {
  background: #fff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 16px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
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
  width: 42px;
  height: 42px;
  border-radius: 10px;
  background: var(--bu-gray-bg);
  color: var(--bu-navy-light);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
  transition: all 0.2s ease;
}
.bu-domain-item:hover .bu-domain-icon {
  background: rgba(255,255,255,0.15);
  color: var(--bu-gold);
}
.bu-domain-title {
  font-size: 14px;
  font-weight: 700;
  color: inherit;
  line-height: 1.35;
}

/* =========================================================
   8. DATA TABLES CARD (SPACIOUS)
   ========================================================= */
.bu-tables-card {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid var(--bu-border);
  padding: 32px 28px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.03);
}
.bu-table-tabs {
  display: flex;
  gap: 10px;
  border-bottom: 2px solid var(--bu-border);
  margin-bottom: 22px;
  overflow-x: auto;
  scrollbar-width: none;
}
.bu-table-tab-btn {
  padding: 12px 20px;
  font-size: 14px;
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
  font-size: 13.5px;
  text-align: left;
}
.bu-data-table th {
  background: #F1F5F9;
  color: var(--bu-navy);
  font-weight: 700;
  padding: 14px 16px;
  border-bottom: 2px solid var(--bu-border);
  white-space: nowrap;
}
.bu-data-table td {
  padding: 13px 16px;
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
   9. PUBLICATIONS & MEDIA (SPACIOUS)
   ========================================================= */
.bu-media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 24px;
}
.bu-media-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 28px 24px;
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
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: var(--bu-gold-light);
  color: var(--bu-gold-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin: 0 auto 14px;
}
.bu-media-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 6px;
}
.bu-media-desc {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin-bottom: 16px;
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
  <!-- HEADER END -->  <!-- =========================================================
       HERO BANNER SECTION (CUSTOM LUXURY HIGH-IMPACT DESIGN)
       ========================================================= -->
  <?php 
  $heroSec = getPortalSec('hero');
  $heroExtra = $heroSec['extra'] ?? [];
  $heroBadgeText = !empty($heroSec['badge_text']) ? $heroSec['badge_text'] : 'Centre for Advanced Research & Excellence';
  $heroBadgeIcon = !empty($heroSec['badge_icon']) ? $heroSec['badge_icon'] : 'fa fa-flask';
  $heroHeading = !empty($heroSec['heading']) ? $heroSec['heading'] : 'Research, Innovation & <em>Enterprise</em>';
  $heroDesc = !empty($heroSec['subheading']) ? $heroSec['subheading'] : 'Advancing cutting-edge pharmaceutical formulations, commercial product development, student startup incubation, and global indexed publications at Bhabha University Bhopal.';
  $heroActions = !empty($heroExtra['actions']) ? $heroExtra['actions'] : [
      ['text' => 'Launched Products (15 Aug)', 'url' => '#launched-products', 'icon' => 'fa fa-cube', 'style' => 'gold'],
      ['text' => 'Patents & Papers', 'url' => '#patents-publications', 'icon' => 'fa fa-database', 'style' => 'outline'],
      ['text' => 'Incubation Centre', 'url' => '#incubation-edc', 'icon' => 'fa fa-lightbulb-o', 'style' => 'outline']
  ];
  $portal_milestones = !empty($heroExtra['milestones']) ? $heroExtra['milestones'] : $portal_metrics;
  $heroMsTitle = !empty($heroExtra['milestones_title']) ? $heroExtra['milestones_title'] : 'Research Milestones at a Glance';
  ?>
  <?php if (isPortalSecActive('hero')): ?>
  <div class="bu-hero-research">
    <div class="bu-hero-research-container">
      
      <!-- LEFT: Hero Content & Actions -->
      <div>
        <ul class="bu-hero-breadcrumb">
          <li><a href="<?php echo URL_ROOT; ?>">Home</a></li>
          <li class="sep">›</li>
          <li class="active"><?php echo htmlspecialchars($heroExtra['breadcrumb_active'] ?? 'Research & Innovation'); ?></li>
        </ul>

        <div class="bu-hero-badge">
          <i class="<?php echo htmlspecialchars($heroBadgeIcon); ?>"></i> <?php echo htmlspecialchars($heroBadgeText); ?>
        </div>

        <h1 class="bu-hero-title">
          <?php echo $heroHeading; ?>
        </h1>

        <p class="bu-hero-desc">
          <?php echo nl2br(htmlspecialchars($heroDesc)); ?>
        </p>

        <!-- Quick Jump Buttons -->
        <div class="bu-hero-actions">
          <?php foreach ($heroActions as $ha): 
            $btnClass = ($ha['style'] == 'gold') ? 'bu-btn-gold' : 'bu-btn-outline-white';
          ?>
          <a href="<?php echo htmlspecialchars($ha['url']); ?>" class="<?php echo $btnClass; ?>">
            <i class="<?php echo htmlspecialchars($ha['icon']); ?>"></i> <?php echo htmlspecialchars($ha['text']); ?>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- RIGHT: Glassmorphic Metrics Card -->
      <div>
        <div class="bu-hero-stats-card">
          <div style="font-size:12px;font-weight:800;letter-spacing:1px;color:var(--bu-gold);text-transform:uppercase;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
            <i class="fa fa-line-chart"></i> <?php echo htmlspecialchars($heroMsTitle); ?>
          </div>
          <div class="bu-hero-stats-grid">
            <?php foreach ($portal_milestones as $pm): 
              $rawVal = !empty($pm['target']) ? $pm['target'] : ($pm['value'] ?? 0);
              $targetNum = (int)preg_replace('/[^0-9]/', '', (string)$rawVal);
              $pPrefix = $pm['prefix'] ?? '';
              $pSuffix = $pm['suffix'] ?? '';
              $useCommas = !empty($pm['commas']) || ($targetNum >= 1000);
              $cleanSuffix = (preg_match('/^[a-zA-Z]/', $pSuffix)) ? ' ' . $pSuffix : $pSuffix;
              $displayVal = $pPrefix . ($useCommas ? number_format($targetNum) : $targetNum) . $cleanSuffix;
            ?>
            <div class="bu-hero-stat-box">
              <div class="bu-hero-stat-num"><?php echo htmlspecialchars($displayVal); ?></div>
              <div class="bu-hero-stat-lbl"><?php echo htmlspecialchars($pm['label']); ?></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
  <?php endif; ?>

  <!-- Quick Sticky Sub-Navigation -->
  <div class="bu-res-nav-bar">
    <div class="bu-res-nav-container">
      <?php if (isPortalSecActive('pharmacy_labs')): ?><a href="#pharmacy-labs" class="bu-res-nav-link active"><i class="fa fa-medkit"></i> Pharmacy Labs</a><?php endif; ?>
      <?php if (isPortalSecActive('launched_products')): ?><a href="#launched-products" class="bu-res-nav-link"><i class="fa fa-cube"></i> Launched Products</a><?php endif; ?>
      <?php if (isPortalSecActive('incubation_edc')): ?><a href="#incubation-edc" class="bu-res-nav-link"><i class="fa fa-lightbulb-o"></i> Incubation &amp; EDC</a><?php endif; ?>
      <?php if (isPortalSecActive('research_domains')): ?><a href="#research-domains" class="bu-res-nav-link"><i class="fa fa-th-large"></i> Research Domains</a><?php endif; ?>
      <?php if (isPortalSecActive('patents_publications')): ?><a href="#patents-publications" class="bu-res-nav-link"><i class="fa fa-table"></i> Patents &amp; Papers</a><?php endif; ?>
      <?php if (isPortalSecActive('media_publications')): ?><a href="#media-publications" class="bu-res-nav-link"><i class="fa fa-newspaper-o"></i> E-Newsletter &amp; Blogs</a><?php endif; ?>
    </div>
  </div>

  <div class="bu-res-portal">
    <div class="bu-res-wrap">

      <!-- ================= 1. BHABHA PHARMACY RESEARCH LABORATORIES ================= -->
      <?php if (isPortalSecActive('pharmacy_labs')): 
        $pharmSec = getPortalSec('pharmacy_labs');
        $pharmExtra = $pharmSec['extra'] ?? [];
        $pharmBadgeText = !empty($pharmSec['badge_text']) ? $pharmSec['badge_text'] : 'CENTRE OF EXCELLENCE · R&D FACILITY';
        $pharmBadgeIcon = !empty($pharmSec['badge_icon']) ? $pharmSec['badge_icon'] : 'fa fa-flask';
        $pharmHeading = !empty($pharmSec['heading']) ? $pharmSec['heading'] : 'Bhabha Pharmacy Research Laboratories';
        $pharmDesc = !empty($pharmSec['subheading']) ? $pharmSec['subheading'] : 'Pioneering formulation development, phytochemical research, analytical testing, and commercial health innovations under stringent national regulatory approvals and standardization protocols.';
        $pharmCertBadge = !empty($pharmExtra['certified_badge']) ? $pharmExtra['certified_badge'] : 'Certified Facility';
        $pharmCerts = !empty($pharmExtra['certifications']) ? $pharmExtra['certifications'] : [];
        $pharmStats = !empty($pharmExtra['stats']) ? $pharmExtra['stats'] : [];
      ?>
      <section id="pharmacy-labs" style="scroll-margin-top: 60px;">
        <div class="bu-pharm-card">
          
          <!-- Top Header Info -->
          <div class="bu-pharm-top">
            <div>
              <span class="bu-badge-pill" style="background:#FFF9E6; color:#92400E; border:1px solid #FDE68A;">
                <i class="<?php echo htmlspecialchars($pharmBadgeIcon); ?>"></i> <?php echo htmlspecialchars($pharmBadgeText); ?>
              </span>
              <h2 class="bu-pharm-heading">
                <?php echo $pharmHeading; ?>
              </h2>
              <p class="bu-pharm-desc">
                <?php echo nl2br(htmlspecialchars($pharmDesc)); ?>
              </p>
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
              <span style="background:#0A1B54;color:#FFC107;font-size:12px;font-weight:800;padding:6px 14px;border-radius:20px;letter-spacing:0.8px;text-transform:uppercase;">
                <i class="fa fa-certificate"></i> <?php echo htmlspecialchars($pharmCertBadge); ?>
              </span>
            </div>
          </div>

          <!-- 4 Regulatory Approvals & Certifications Grid -->
          <div class="bu-pharm-cert-grid">
            <?php foreach ($pharmCerts as $pc): 
              $pTheme = !empty($pc['theme']) ? 'bu-cert-' . $pc['theme'] : 'bu-cert-fssai';
            ?>
            <div class="bu-cert-card">
              <div class="bu-cert-icon-box <?php echo $pTheme; ?>">
                <i class="<?php echo htmlspecialchars($pc['icon']); ?>"></i>
              </div>
              <div>
                <div class="bu-cert-title"><?php echo htmlspecialchars($pc['title']); ?></div>
                <div class="bu-cert-subtitle"><?php echo htmlspecialchars($pc['subtitle']); ?></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- 4 Lab Stat Highlights in Soft Clean Cards -->
          <div class="bu-pharm-stats-row">
            <?php foreach ($pharmStats as $ps): ?>
            <div class="bu-pharm-stat-item">
              <div style="width:40px;height:40px;border-radius:8px;background:<?php echo htmlspecialchars($ps['bg'] ?? '#ECFDF5'); ?>;color:<?php echo htmlspecialchars($ps['color'] ?? '#059669'); ?>;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                <i class="<?php echo htmlspecialchars($ps['icon']); ?>"></i>
              </div>
              <div>
                <div class="bu-pharm-stat-val" style="color:<?php echo htmlspecialchars($ps['color'] ?? '#059669'); ?>;"><?php echo htmlspecialchars($ps['val']); ?></div>
                <div class="bu-pharm-stat-lbl"><?php echo htmlspecialchars($ps['lbl']); ?></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

        </div>
      </section>
      <?php endif; ?>

      <!-- ================= 2. LAUNCHED PRODUCTS (15th August Launch) ================= -->
      <?php if (isPortalSecActive('launched_products')): 
        $prodSec = getPortalSec('launched_products');
        $prodExtra = $prodSec['extra'] ?? [];
        $prodBadgeText = !empty($prodSec['badge_text']) ? $prodSec['badge_text'] : 'Commercial Innovations';
        $prodBadgeIcon = !empty($prodSec['badge_icon']) ? $prodSec['badge_icon'] : 'fa fa-rocket';
        $prodHeading = !empty($prodSec['heading']) ? $prodSec['heading'] : 'Products Developed & <em>Launched</em>';
        $prodDesc = !empty($prodSec['subheading']) ? $prodSec['subheading'] : 'Formulated and commercially launched by Bhabha Pharmacy Research Laboratories on 15th August, adhering to pharmaceutical purity standards.';
        $productList = !empty($prodExtra['products']) ? $prodExtra['products'] : [];
      ?>
      <section id="launched-products" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="<?php echo htmlspecialchars($prodBadgeIcon); ?>"></i> <?php echo htmlspecialchars($prodBadgeText); ?></span>
          <h2 class="bu-sec-title"><?php echo $prodHeading; ?></h2>
          <p class="bu-sec-desc">
            <?php echo nl2br(htmlspecialchars($prodDesc)); ?>
          </p>
        </div>

        <div class="bu-products-grid">
          <?php foreach ($productList as $prod): ?>
          <div class="bu-prod-card">
            <div class="bu-prod-header">
              <div class="bu-prod-icon-circle">
                <i class="<?php echo htmlspecialchars($prod['icon'] ?? 'fa fa-cube'); ?>"></i>
              </div>
              <div style="text-align:right;">
                <?php if (!empty($prod['badge_left'])): ?>
                <span class="bu-prod-badge-left"><i class="fa fa-calendar"></i> <?php echo htmlspecialchars($prod['badge_left']); ?></span>
                <?php endif; ?>
                <?php if (!empty($prod['badge_right'])): ?>
                <div style="margin-top:6px;">
                  <span class="bu-prod-badge-right"><i class="fa fa-check"></i> <?php echo htmlspecialchars($prod['badge_right']); ?></span>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="bu-prod-body">
              <div class="bu-prod-sub"><?php echo htmlspecialchars($prod['subtitle']); ?></div>
              <h3 class="bu-prod-title"><?php echo htmlspecialchars($prod['name']); ?></h3>
              <p class="bu-prod-desc">
                <?php echo nl2br(htmlspecialchars($prod['desc'])); ?>
              </p>
              <?php if (!empty($prod['specs']) && is_array($prod['specs'])): ?>
              <div class="bu-prod-specs">
                <?php foreach ($prod['specs'] as $sp): 
                  if (empty($sp['value']) && empty($sp['label'])) continue;
                ?>
                <div class="bu-prod-spec-row">
                  <span class="bu-prod-spec-lbl"><?php echo htmlspecialchars($sp['label']); ?></span>
                  <span class="bu-prod-spec-val"><?php echo htmlspecialchars($sp['value']); ?></span>
                </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
              <?php if (!empty($prod['lab'])): ?>
              <div style="font-size:11.5px;color:var(--bu-text-muted);display:flex;align-items:center;gap:6px;">
                <i class="fa fa-building-o" style="color:var(--bu-gold-dark);"></i> <?php echo htmlspecialchars($prod['lab']); ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- ================= 3. INCUBATION & ENTREPRENEURSHIP CELL ================= -->
      <?php if (isPortalSecActive('incubation_edc')): 
        $incSec = getPortalSec('incubation_edc');
        $incExtra = $incSec['extra'] ?? [];
        $incBadgeText = !empty($incSec['badge_text']) ? $incSec['badge_text'] : 'Startup Ecosystem';
        $incBadgeIcon = !empty($incSec['badge_icon']) ? $incSec['badge_icon'] : 'fa fa-building';
        $incHeading = !empty($incSec['heading']) ? $incSec['heading'] : 'Incubation Centre & <em>EDC</em>';
        $incDesc = !empty($incSec['subheading']) ? $incSec['subheading'] : 'Empowering students and faculty to transform innovative ideas into viable enterprises through mentorship and prototyping facilities.';
        $incBoxes = !empty($incExtra['boxes']) ? $incExtra['boxes'] : [];
      ?>
      <section id="incubation-edc" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="<?php echo htmlspecialchars($incBadgeIcon); ?>"></i> <?php echo htmlspecialchars($incBadgeText); ?></span>
          <h2 class="bu-sec-title"><?php echo $incHeading; ?></h2>
          <p class="bu-sec-desc">
            <?php echo nl2br(htmlspecialchars($incDesc)); ?>
          </p>
        </div>

        <div class="bu-innov-grid">
          <?php foreach ($incBoxes as $ib): ?>
          <div class="bu-innov-box">
            <div class="bu-innov-header">
              <div class="bu-innov-icon"><i class="<?php echo htmlspecialchars($ib['icon']); ?>"></i></div>
              <h3 class="bu-innov-title"><?php echo htmlspecialchars($ib['title']); ?></h3>
            </div>
            <p class="bu-innov-desc">
              <?php echo nl2br(htmlspecialchars($ib['desc'])); ?>
            </p>
            <?php if (!empty($ib['bullets']) && is_array($ib['bullets'])): ?>
            <ul class="bu-innov-bullets">
              <?php foreach ($ib['bullets'] as $blt): if(empty($blt)) continue; ?>
              <li><?php echo htmlspecialchars($blt); ?></li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- ================= 4. RESEARCH PILLARS & DOMAINS ================= -->
      <?php if (isPortalSecActive('research_domains')): 
        $domSec = getPortalSec('research_domains');
        $domExtra = $domSec['extra'] ?? [];
        $domBadgeText = !empty($domSec['badge_text']) ? $domSec['badge_text'] : 'Academic Framework';
        $domBadgeIcon = !empty($domSec['badge_icon']) ? $domSec['badge_icon'] : 'fa fa-sitemap';
        $domHeading = !empty($domSec['heading']) ? $domSec['heading'] : 'Research Pillars & <em>Framework</em>';
        $domDesc = !empty($domSec['subheading']) ? $domSec['subheading'] : 'Institutional framework governing interdisciplinary research, ethical compliance, and technology transfers.';
        $domainItems = !empty($domExtra['domains']) ? $domExtra['domains'] : [];
      ?>
      <section id="research-domains" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="<?php echo htmlspecialchars($domBadgeIcon); ?>"></i> <?php echo htmlspecialchars($domBadgeText); ?></span>
          <h2 class="bu-sec-title"><?php echo $domHeading; ?></h2>
          <p class="bu-sec-desc">
            <?php echo nl2br(htmlspecialchars($domDesc)); ?>
          </p>
        </div>

        <div class="bu-res-domains-grid">
          <?php foreach ($domainItems as $di): 
            $dUrl = !empty($di['url']) ? $di['url'] : '';
          ?>
          <div class="bu-domain-item">
            <div class="bu-domain-icon"><i class="<?php echo htmlspecialchars($di['icon']); ?>"></i></div>
            <div class="bu-domain-title">
              <?php if (!empty($dUrl)): ?>
                <a href="<?php echo htmlspecialchars($dUrl); ?>" style="color:inherit; text-decoration:none;"><?php echo htmlspecialchars($di['title']); ?></a>
              <?php else: ?>
                <?php echo htmlspecialchars($di['title']); ?>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- ================= 5. PATENTS, RESEARCH PAPERS & BOOKS TABLES ================= -->
      <?php if (isPortalSecActive('patents_publications')): 
        $patSec = getPortalSec('patents_publications');
        $patExtra = $patSec['extra'] ?? [];
        $patBadgeText = !empty($patSec['badge_text']) ? $patSec['badge_text'] : 'Scholarly Records';
        $patBadgeIcon = !empty($patSec['badge_icon']) ? $patSec['badge_icon'] : 'fa fa-database';
        $patHeading = !empty($patSec['heading']) ? $patSec['heading'] : 'Patents, Publications & <em>Research Papers</em>';
        $patDesc = !empty($patSec['subheading']) ? $patSec['subheading'] : 'Verified repository of filed patents, indexed papers (Scopus, UGC CARE), and authored book chapters.';
      ?>
      <section id="patents-publications" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="<?php echo htmlspecialchars($patBadgeIcon); ?>"></i> <?php echo htmlspecialchars($patBadgeText); ?></span>
          <h2 class="bu-sec-title"><?php echo $patHeading; ?></h2>
          <p class="bu-sec-desc">
            <?php echo nl2br(htmlspecialchars($patDesc)); ?>
          </p>
        </div>

        <div class="bu-tables-card">
          <!-- Table Tab Navigation -->
          <div class="bu-table-tabs">
            <button class="bu-table-tab-btn active" onclick="switchTableTab(event, 'tab-patents')">
              <i class="fa fa-lightbulb-o"></i> <?php echo htmlspecialchars($patExtra['tab1_title'] ?? 'Patent Filing Records'); ?>
            </button>
            <button class="bu-table-tab-btn" onclick="switchTableTab(event, 'tab-papers')">
              <i class="fa fa-file-text-o"></i> <?php echo htmlspecialchars($patExtra['tab2_title'] ?? 'Research Paper List'); ?>
            </button>
            <button class="bu-table-tab-btn" onclick="switchTableTab(event, 'tab-books')">
              <i class="fa fa-book"></i> <?php echo htmlspecialchars($patExtra['tab3_title'] ?? 'Books & Chapters Published'); ?>
            </button>
          </div>

          <!-- TAB 1: PATENTS TABLE -->
          <div id="tab-patents" class="bu-tab-panel active">
            <div style="margin-bottom:12px;font-size:12.5px;color:var(--bu-text-muted);display:flex;justify-content:space-between;align-items:center;">
              <span><?php echo htmlspecialchars($patExtra['tab1_desc'] ?? 'Official patent applications submitted by university faculty and researchers.'); ?></span>
              <span class="bu-tag-patent"><?php echo htmlspecialchars($patExtra['tab1_tag'] ?? 'Format: IPO Indian Patent Office'); ?></span>
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
                      <span style="font-size:12.5px; color:#94A3B8;"><?php echo htmlspecialchars($patExtra['tab1_empty'] ?? 'Official patent filing data will be updated upon departmental submission.'); ?></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- TAB 2: RESEARCH PAPERS TABLE -->
          <div id="tab-papers" class="bu-tab-panel">
            <div style="margin-bottom:12px;font-size:12.5px;color:var(--bu-text-muted);display:flex;justify-content:space-between;align-items:center;">
              <span><?php echo htmlspecialchars($patExtra['tab2_desc'] ?? 'Papers indexed in Scopus, SCIE, UGC Care Group I & II, and PubMed journals.'); ?></span>
              <span class="bu-tag-index"><?php echo htmlspecialchars($patExtra['tab2_tag'] ?? 'Indexed Repository'); ?></span>
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
                      <span style="font-size:12.5px; color:#94A3B8;"><?php echo htmlspecialchars($patExtra['tab2_empty'] ?? 'Official publications list will be updated upon departmental submission.'); ?></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- TAB 3: BOOKS & CHAPTERS TABLE -->
          <div id="tab-books" class="bu-tab-panel">
            <div style="margin-bottom:12px;font-size:12.5px;color:var(--bu-text-muted);">
              <span><?php echo htmlspecialchars($patExtra['tab3_desc'] ?? 'Authored reference textbooks and chapters published by recognized national and international publishers.'); ?></span>
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
                      <span style="font-size:12.5px; color:#94A3B8;"><?php echo htmlspecialchars($patExtra['tab3_empty'] ?? 'Official authored books and chapters records will be updated upon departmental submission.'); ?></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
      <?php endif; ?>

      <!-- ================= 6. E-NEWSLETTER, MAGAZINE & BLOGS ================= -->
      <?php if (isPortalSecActive('media_publications')): 
        $medSec = getPortalSec('media_publications');
        $medExtra = $medSec['extra'] ?? [];
        $medBadgeText = !empty($medSec['badge_text']) ? $medSec['badge_text'] : 'Publications';
        $medBadgeIcon = !empty($medSec['badge_icon']) ? $medSec['badge_icon'] : 'fa fa-bookmark';
        $medHeading = !empty($medSec['heading']) ? $medSec['heading'] : 'E-Newsletter, Magazine & <em>Blogs</em>';
        $medDesc = !empty($medSec['subheading']) ? $medSec['subheading'] : 'Stay updated with quarterly research updates, student magazines, and academic insights.';
        $mediaCards = !empty($medExtra['cards']) ? $medExtra['cards'] : [];
      ?>
      <section id="media-publications" style="scroll-margin-top: 60px;">
        <div class="bu-sec-title-wrap">
          <span class="bu-badge-pill"><i class="<?php echo htmlspecialchars($medBadgeIcon); ?>"></i> <?php echo htmlspecialchars($medBadgeText); ?></span>
          <h2 class="bu-sec-title"><?php echo $medHeading; ?></h2>
          <p class="bu-sec-desc">
            <?php echo nl2br(htmlspecialchars($medDesc)); ?>
          </p>
        </div>

        <div class="bu-media-grid">
          <?php foreach ($mediaCards as $mc): 
            $mcUrl = !empty($mc['btn_url']) ? (strpos($mc['btn_url'], 'http') === 0 ? $mc['btn_url'] : (function_exists('href') ? href($mc['btn_url']) : URL_ROOT . ltrim($mc['btn_url'], '/'))) : '#';
          ?>
          <div class="bu-media-card">
            <div class="bu-media-icon"><i class="<?php echo htmlspecialchars($mc['icon']); ?>"></i></div>
            <h3 class="bu-media-title"><?php echo htmlspecialchars($mc['title']); ?></h3>
            <p class="bu-media-desc"><?php echo nl2br(htmlspecialchars($mc['desc'])); ?></p>
            <a href="<?php echo $mcUrl; ?>" class="bu-media-btn">
              <i class="<?php echo htmlspecialchars($mc['btn_icon']); ?>"></i> <?php echo htmlspecialchars($mc['btn_text']); ?>
            </a>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

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
