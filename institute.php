<?php 
include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 2;
$db->where('id', $id);
$aryData = $db->getOne('institute');

if(!$aryData) {
    header("Location: ".URL_ROOT);
    exit;
}

$department = null;
if (!empty($aryData['department'])) {
    $db->where('id', $aryData['department']);
    $department = $db->getOne('department');
}

// Fetch sub-departments / wings if any
$db->where('institute', $id);
$sub_department = $db->get('sub_department');

// Decode structured JSON data
$programs_list   = !empty($aryData['programs_data']) ? json_decode($aryData['programs_data'], true) : [];
$activities_list = !empty($aryData['activities_data']) ? json_decode($aryData['activities_data'], true) : [];
$placements_data = !empty($aryData['placements_data']) ? json_decode($aryData['placements_data'], true) : [];

// Icon class fallback
$inst_icon = !empty($aryData['icon']) ? $aryData['icon'] : 'fa-university';
if (strpos($inst_icon, 'fa ') !== 0 && strpos($inst_icon, 'fa-') === 0) {
    $inst_icon = 'fa ' . $inst_icon;
}

// Featured hero image determination
$hero_img = '';
if (!empty($aryData['image']) && file_exists(PATH_ROOT . DS . str_replace('/', DS, $aryData['image']))) {
    $hero_img = URL_ROOT . $aryData['image'];
} else {
    // Check if there is an image in about_institute
    if (preg_match('/<img[^>]+src=[\'"]([^\'"]+)[\'"]/i', $aryData['about_institute'], $mImg)) {
        $hero_img = $mImg[1];
    } else {
        $hero_img = URL_ROOT . 'extra-images/slider1.jpg';
    }
}

// Clean intro text for hero summary
$about_plain = trim(strip_tags($aryData['about_institute']));
$overview_short = mb_substr($about_plain, 0, 360, 'UTF-8');
if (mb_strlen($about_plain, 'UTF-8') > 360) {
    $overview_short .= '...';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['institute_name']);?> | Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($aryData['institute_name']);?> at Bhabha University Bhopal. Explore academic programs, faculty leadership, modern labs, student activities and placement opportunities.">
<?php include('inc.meta.php');?>
<style>
/* ================================================================
   INSTITUTE PAGE — FULL-WIDTH EXECUTIVE NAVY & GOLD DESIGN SYSTEM
   Bhabha University | Premium Redesign
   ================================================================ */

:root {
  --bu-navy-primary: #061D7C;
  --bu-navy-dark: #040F4A;
  --bu-navy-light: #0A2699;
  --bu-gold-primary: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFE082;
  --bu-text-dark: #0F172A;
  --bu-text-muted: #475569;
  --bu-border: #E2E8F0;
  --bu-bg-soft: #F8FAFC;
  --bu-bg-card: #FFFFFF;
}

/* ================================================================
   0. TOP EXECUTIVE HERO BANNER
   ================================================================ */
.bu-inst-hero {
  background: linear-gradient(135deg, #040F4A 0%, #0A1B54 50%, #061D7C 100%);
  padding: 55px 20px 45px;
  position: relative;
  overflow: hidden;
  width: 100%;
  clear: both;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-shadow: 0 4px 20px rgba(4, 15, 74, 0.18);
}

.bu-inst-hero::before {
  content: '';
  position: absolute;
  top: -100px; right: -80px;
  width: 420px; height: 420px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.12) 0%, transparent 70%);
  pointer-events: none;
}

.bu-inst-hero::after {
  content: '';
  position: absolute;
  bottom: -80px; left: 10%;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.08) 0%, transparent 70%);
  pointer-events: none;
}

.bu-inst-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 35px;
  position: relative;
  z-index: 2;
  box-sizing: border-box;
}

@media(max-width: 991px) {
  .bu-inst-hero-inner {
    padding: 0 15px;
  }
  .bu-inst-hero {
    padding: 40px 15px 35px;
  }
}

/* Breadcrumb in Hero */
.bu-inst-breadcrumb {
  display: flex;
  align-items: center;
  gap: 0;
  list-style: none;
  margin: 0 0 14px 0;
  padding: 0;
  flex-wrap: wrap;
}

.bu-inst-breadcrumb li {
  font-size: 11.5px;
  font-weight: 600;
  color: rgba(255,255,255,0.6);
  text-transform: uppercase;
  letter-spacing: 0.8px;
}

.bu-inst-breadcrumb li a {
  color: rgba(255,255,255,0.65);
  text-decoration: none;
  transition: color 0.2s;
}

.bu-inst-breadcrumb li a:hover { 
  color: #FFC107; 
}

.bu-inst-breadcrumb li + li::before {
  content: '›';
  margin: 0 8px;
  color: rgba(255,255,255,0.35);
}

.bu-inst-breadcrumb li:last-child { 
  color: #FFC107; 
  font-weight: 700; 
}

.bu-inst-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255,193,7,0.15);
  border: 1px solid rgba(255,193,7,0.35);
  color: #FFC107;
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 20px;
  margin-bottom: 12px;
}

.bu-inst-hero-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(26px, 3.6vw, 42px);
  font-weight: 800;
  color: #FFFFFF;
  margin: 0 0 8px 0;
  line-height: 1.2;
}

.bu-inst-hero-subtitle {
  font-size: 14.5px;
  color: rgba(255,255,255,0.78);
  line-height: 1.6;
  max-width: 820px;
  margin: 0 0 18px 0;
}

.bu-inst-hero-pills {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.bu-inst-hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.18);
  color: #FFFFFF;
  font-size: 12px;
  font-weight: 600;
  padding: 5px 13px;
  border-radius: 20px;
  backdrop-filter: blur(4px);
}

.bu-inst-hero-pill i {
  color: #FFC107;
}

.bu-inst-wrapper {
  background-color: #F8F9FD;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--bu-text-dark);
  padding: 24px 24px 40px 24px;
  overflow-x: hidden;
}

.bu-inst-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 40px;
  box-sizing: border-box;
}

@media(max-width: 991px) {
  .bu-inst-container {
    padding: 0 15px;
  }
}

@media(max-width: 768px) {
  .bu-inst-wrapper {
    padding: 12px 6px !important;
  }
  .bu-inst-container {
    padding: 0 4px !important;
  }
}

/* ================================================================
   1. OVERVIEW HERO CARD (2-COLUMN BALANCED LAYOUT)
   ================================================================ */
.bu-inst-hero-card {
  background: #ffffff;
  border-radius: 14px;
  border: 1px solid var(--bu-border);
  box-shadow: 0 8px 24px rgba(6, 29, 124, 0.05);
  padding: 24px 28px;
  margin-top: 0;
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.bu-inst-hero-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--bu-gold-primary) 0%, var(--bu-gold-dark) 50%, var(--bu-navy-primary) 100%);
}

.bu-inst-hero-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 26px;
  align-items: center;
}

@media(max-width: 991px) {
  .bu-inst-hero-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  .bu-inst-hero-card {
    padding: 20px 16px;
  }
}

.bu-inst-badge-row {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 10px;
}

.bu-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  padding: 4px 10px;
  border-radius: 20px;
}

.bu-badge-gold {
  background: rgba(255, 193, 7, 0.16);
  color: #996500;
  border: 1px solid rgba(217, 155, 0, 0.35);
}

.bu-badge-navy {
  background: rgba(6, 29, 124, 0.08);
  color: var(--bu-navy-primary);
  border: 1px solid rgba(6, 29, 124, 0.18);
}

.bu-badge-green {
  background: rgba(16, 185, 129, 0.1);
  color: #065F46;
  border: 1px solid rgba(16, 185, 129, 0.25);
}

.bu-inst-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(23px, 2.4vw, 32px);
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 6px 0;
  line-height: 1.22;
}

.bu-inst-subtitle {
  font-size: 13.5px;
  color: var(--bu-gold-dark);
  font-weight: 700;
  margin: 0 0 12px 0;
  display: flex;
  align-items: center;
  gap: 6px;
}

.bu-lead-text {
  font-size: 14px;
  line-height: 1.7;
  color: #334155;
  margin-bottom: 14px;
}

.bu-lead-text strong {
  color: var(--bu-navy-dark);
}

.bu-approvals-bar {
  display: flex;
  align-items: center;
  gap: 12px;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 8px 12px;
  margin-bottom: 14px;
  flex-wrap: wrap;
}

.bu-approval-item {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 700;
  color: var(--bu-navy-primary);
}

.bu-approval-item i {
  color: #10B981;
  font-size: 13px;
}

.bu-approval-divider {
  width: 1px;
  height: 14px;
  background: #CBD5E1;
}

.bu-hero-btn-row {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.bu-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: var(--bu-navy-primary);
  color: #ffffff !important;
  font-weight: 700;
  font-size: 12.5px;
  padding: 9px 18px;
  border-radius: 6px;
  text-decoration: none !important;
  cursor: pointer;
  border: 1px solid var(--bu-navy-dark);
  transition: all 0.25s ease;
  box-shadow: 0 4px 10px rgba(6, 29, 124, 0.15);
}

.bu-btn-primary:hover {
  background: var(--bu-navy-dark);
  color: var(--bu-gold-primary) !important;
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(6, 29, 124, 0.22);
}

.bu-btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: #ffffff;
  color: var(--bu-navy-primary) !important;
  font-weight: 700;
  font-size: 12.5px;
  padding: 8px 16px;
  border-radius: 6px;
  text-decoration: none !important;
  border: 1px solid var(--bu-border);
  transition: all 0.2s ease;
}

.bu-btn-outline:hover {
  background: #EEF2FF;
  border-color: var(--bu-navy-primary);
}

/* Hero Media Box */
.bu-inst-hero-media {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(6, 29, 124, 0.12);
  height: 270px;
  background: #040F4A;
}

.bu-inst-hero-media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}

.bu-inst-hero-media:hover img {
  transform: scale(1.03);
}

.bu-inst-hero-stats-badge {
  position: absolute;
  bottom: 12px;
  left: 12px;
  right: 12px;
  background: rgba(4, 15, 74, 0.90);
  backdrop-filter: blur(6px);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 8px;
  padding: 8px 14px;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.bu-stat-mini {
  text-align: center;
}

.bu-stat-mini strong {
  display: block;
  color: var(--bu-gold-primary);
  font-size: 15px;
  font-weight: 800;
  font-family: 'Playfair Display', Georgia, serif;
  line-height: 1;
}

.bu-stat-mini span {
  font-size: 9.5px;
  color: rgba(255, 255, 255, 0.85);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* ================================================================
   2. SECTION BLOCKS (FULL-WIDTH)
   ================================================================ */
.bu-section-block {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  box-shadow: 0 4px 16px rgba(6, 29, 124, 0.04);
  padding: 24px 28px;
  margin-bottom: 20px;
  position: relative;
}

@media(max-width: 768px) {
  .bu-section-block {
    padding: 16px 14px;
  }
}

.bu-sec-header {
  margin-bottom: 18px;
}

.bu-sec-subtitle {
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 2px;
  color: var(--bu-gold-dark);
  text-transform: uppercase;
  margin-bottom: 3px;
  display: block;
}

.bu-sec-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(20px, 2.2vw, 26px);
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 6px 0;
  line-height: 1.25;
}

.bu-sec-title em {
  font-style: italic;
  color: var(--bu-gold-dark);
}

.bu-sec-divider {
  width: 44px;
  height: 3px;
  background: linear-gradient(90deg, var(--bu-gold-primary), var(--bu-gold-dark));
  border-radius: 2px;
  margin-top: 6px;
}

/* ================================================================
   3. PRINCIPAL / LEADERSHIP SPOTLIGHT
   ================================================================ */
.bu-leadership-card {
  display: grid;
  grid-template-columns: 180px 1fr;
  gap: 24px;
  align-items: center;
  background: linear-gradient(135deg, #F8FAFF 0%, #EEF2FF 100%);
  border: 1px solid #DCE4FC;
  border-radius: 12px;
  padding: 22px;
}

@media(max-width: 650px) {
  .bu-leadership-card {
    grid-template-columns: 1fr;
    text-align: center;
  }
}

.bu-lead-avatar-wrap {
  text-align: center;
}

.bu-lead-avatar {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid #ffffff;
  box-shadow: 0 6px 16px rgba(6, 29, 124, 0.15);
  margin: 0 auto 10px;
  display: block;
  background: #E2E8F0;
}

.bu-lead-avatar-dummy {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  background: linear-gradient(135deg, #0A2699 0%, #040F4A 100%);
  border: 4px solid #ffffff;
  box-shadow: 0 6px 16px rgba(6, 29, 124, 0.15);
  margin: 0 auto 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--bu-gold-primary);
  font-size: 54px;
}

.bu-lead-name {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 18px;
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 3px 0;
}

.bu-lead-designation {
  font-size: 12px;
  font-weight: 700;
  color: var(--bu-gold-dark);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 4px;
}

.bu-lead-qual {
  font-size: 12px;
  color: var(--bu-text-muted);
  margin-bottom: 8px;
}

.bu-lead-quote {
  font-size: 13.5px;
  line-height: 1.7;
  color: #334155;
  font-style: italic;
  position: relative;
  padding-left: 18px;
  border-left: 3px solid var(--bu-gold-primary);
}

@media(max-width: 650px) {
  .bu-lead-quote {
    padding-left: 0;
    border-left: none;
    border-top: 2px solid var(--bu-gold-primary);
    padding-top: 12px;
  }
}

/* ================================================================
   4. ACADEMIC PROGRAMMES & BRANCHES (STRUCTURED CARDS)
   ================================================================ */
.bu-programs-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 18px;
}

.bu-program-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 20px;
  box-shadow: 0 3px 12px rgba(6, 29, 124, 0.04);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.28s ease;
  position: relative;
  overflow: hidden;
}

.bu-program-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: #E2E8F0;
  transition: background 0.3s ease;
}

.bu-program-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 24px rgba(6, 29, 124, 0.08);
  border-color: rgba(6, 29, 124, 0.22);
}

.bu-program-card:hover::before {
  background: linear-gradient(90deg, var(--bu-gold-primary), var(--bu-navy-primary));
}

.bu-prog-top-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  margin-bottom: 10px;
}

.bu-prog-avatar {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: rgba(6, 29, 124, 0.07);
  color: var(--bu-navy-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  transition: all 0.25s;
}

.bu-program-card:hover .bu-prog-avatar {
  background: var(--bu-navy-primary);
  color: var(--bu-gold-primary);
}

.bu-prog-duration-badge {
  font-size: 10px;
  font-weight: 800;
  color: #996500;
  background: rgba(255, 193, 7, 0.18);
  padding: 3px 9px;
  border-radius: 14px;
  letter-spacing: 0.3px;
}

.bu-program-card h3 {
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 6px 0;
  font-family: 'Playfair Display', Georgia, serif;
  line-height: 1.25;
}

.bu-prog-intro {
  font-size: 12.5px;
  color: var(--bu-text-muted);
  line-height: 1.5;
  margin-bottom: 12px;
}

.bu-prog-branches-title {
  font-size: 10.5px;
  font-weight: 800;
  color: var(--bu-navy-primary);
  text-transform: uppercase;
  letter-spacing: 0.6px;
  margin-bottom: 6px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.bu-branch-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 16px;
}

.bu-branch-chip {
  background: #F8FAFC;
  color: #1E293B;
  font-size: 11px;
  font-weight: 600;
  padding: 4px 9px;
  border-radius: 6px;
  border: 1px solid #E2E8F0;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s ease;
}

.bu-branch-chip i {
  color: #10B981;
  font-size: 7px;
}

.bu-program-card:hover .bu-branch-chip {
  background: #EEF2FF;
  border-color: #CBD5E1;
  color: var(--bu-navy-dark);
}

.bu-prog-card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding-top: 12px;
  border-top: 1px solid #F1F5F9;
  margin-top: auto;
}

.bu-prog-apply-btn {
  font-size: 11.5px;
  font-weight: 700;
  color: var(--bu-navy-primary) !important;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: all 0.2s;
}

.bu-prog-apply-btn:hover {
  color: var(--bu-gold-dark) !important;
}

.bu-prog-sec-btn {
  font-size: 11px;
  font-weight: 700;
  color: #64748B !important;
  text-decoration: none !important;
  background: #F1F5F9;
  padding: 4px 10px;
  border-radius: 4px;
  transition: all 0.2s;
}

.bu-prog-sec-btn:hover {
  background: #E2E8F0;
  color: var(--bu-navy-primary) !important;
}

/* ================================================================
   5. ACTIVITIES & STUDENT LIFE GRID
   ================================================================ */
.bu-activities-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 14px;
}

.bu-activity-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 10px;
  padding: 16px;
  display: flex;
  align-items: flex-start;
  gap: 12px;
  box-shadow: 0 2px 8px rgba(6, 29, 124, 0.03);
  transition: all 0.25s ease;
}

.bu-activity-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 18px rgba(6, 29, 124, 0.08);
  border-color: rgba(6, 29, 124, 0.2);
}

.bu-act-icon-box {
  width: 38px;
  height: 38px;
  border-radius: 8px;
  background: rgba(6, 29, 124, 0.08);
  color: var(--bu-navy-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
  transition: all 0.25s;
}

.bu-activity-card:hover .bu-act-icon-box {
  background: var(--bu-navy-primary);
  color: var(--bu-gold-primary);
}

.bu-act-content h4 {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--bu-navy-dark);
  margin: 0 0 2px 0;
}

.bu-act-content span.bu-act-cat {
  font-size: 10px;
  font-weight: 700;
  color: var(--bu-gold-dark);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: block;
  margin-bottom: 4px;
}

.bu-act-content p {
  font-size: 11.5px;
  color: var(--bu-text-muted);
  line-height: 1.4;
  margin: 0;
}

/* ================================================================
   6. CAREER, PLACEMENTS & NIRF DOCUMENTS
   ================================================================ */
.bu-placement-banner {
  background: linear-gradient(135deg, #040F4A 0%, #061D7C 100%);
  color: #ffffff;
  border-radius: 10px;
  padding: 20px 24px;
  margin-bottom: 18px;
  position: relative;
  overflow: hidden;
}

.bu-placement-banner::after {
  content: '';
  position: absolute;
  top: -30px;
  right: -30px;
  width: 140px;
  height: 140px;
  border-radius: 50%;
  background: rgba(255, 193, 7, 0.1);
  pointer-events: none;
}

.bu-placement-banner h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 19px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 4px 0;
}

.bu-placement-banner p {
  font-size: 13px;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

.bu-plc-points-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 12px;
  margin-bottom: 18px;
}

.bu-plc-point-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 12px 14px;
  font-size: 13px;
  color: #334155;
  display: flex;
  align-items: flex-start;
  gap: 10px;
}

.bu-plc-point-item i {
  color: #10B981;
  font-size: 14px;
  margin-top: 2px;
  flex-shrink: 0;
}

.bu-doc-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 12px;
  margin-top: 12px;
}

.bu-doc-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 8px;
  padding: 12px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  text-decoration: none !important;
  transition: all 0.2s ease;
  border-left: 3px solid #EF4444;
}

.bu-doc-card:hover {
  background: #FEF2F2;
  border-color: #FCA5A5;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.12);
}

.bu-doc-info {
  display: flex;
  align-items: center;
  gap: 10px;
}

.bu-doc-info i {
  font-size: 20px;
  color: #DC2626;
}

.bu-doc-info strong {
  display: block;
  font-size: 12.5px;
  color: var(--bu-navy-dark);
  line-height: 1.3;
}

.bu-doc-info span {
  font-size: 10px;
  color: #64748B;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.bu-doc-btn {
  font-size: 11px;
  font-weight: 700;
  color: #DC2626;
  white-space: nowrap;
}

/* Recruiters Chips */
.bu-recruiter-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 10px;
}

.bu-recruiter-chip {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 20px;
  padding: 6px 14px;
  font-size: 11.5px;
  font-weight: 700;
  color: var(--bu-navy-primary);
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
}

/* ================================================================
   7. DEPARTMENTS & WINGS GRID
   ================================================================ */
.bu-dept-wings-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 14px;
}

.bu-wing-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 8px;
  padding: 14px 16px;
  text-decoration: none !important;
  display: flex;
  align-items: center;
  gap: 12px;
  transition: all 0.25s ease;
  border-left: 4px solid var(--bu-navy-primary);
}

.bu-wing-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(6, 29, 124, 0.08);
  border-left-color: var(--bu-gold-primary);
}

.bu-wing-card i {
  color: var(--bu-navy-primary);
  font-size: 16px;
}

.bu-wing-card span {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--bu-navy-dark);
}

/* ================================================================
   8. BOTTOM ADMISSIONS CTA BANNER
   ================================================================ */
.bu-inst-cta-banner {
  background: linear-gradient(135deg, #040F4A 0%, #061D7C 100%);
  border-radius: 12px;
  padding: 24px 30px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  margin-top: 10px;
  box-shadow: 0 8px 24px rgba(6, 29, 124, 0.15);
  position: relative;
  overflow: hidden;
}

.bu-inst-cta-banner::before {
  content: '';
  position: absolute;
  top: -40px;
  right: -40px;
  width: 160px;
  height: 160px;
  border-radius: 50%;
  background: rgba(255, 193, 7, 0.1);
}

.bu-inst-cta-text h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 21px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 4px 0;
}

.bu-inst-cta-text p {
  font-size: 13px;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

.bu-inst-cta-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--bu-gold-primary);
  color: var(--bu-navy-dark) !important;
  font-size: 13px;
  font-weight: 800;
  padding: 11px 24px;
  border-radius: 6px;
  text-decoration: none !important;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
}

.bu-inst-cta-btn:hover {
  background: var(--bu-gold-dark);
  color: #ffffff !important;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
}

/* ================================================================
   9. MODAL POPUP (OVERVIEW DETAILS)
   ================================================================ */
.bu-modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(4, 15, 74, 0.75);
  backdrop-filter: blur(4px);
  z-index: 99999;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.bu-modal-dialog {
  background: #ffffff;
  border-radius: 14px;
  max-width: 820px;
  width: 100%;
  max-height: 85vh;
  display: flex;
  flex-direction: column;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
  overflow: hidden;
  animation: buModalFadeIn 0.3s ease;
}

@keyframes buModalFadeIn {
  from { opacity: 0; transform: translateY(20px) scale(0.97); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

.bu-modal-header {
  padding: 18px 24px;
  background: #040F4A;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.bu-modal-header h3 {
  font-size: 18px;
  font-weight: 800;
  color: #ffffff;
  margin: 0;
  font-family: 'Playfair Display', Georgia, serif;
}

.bu-modal-close-icon {
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.8);
  font-size: 24px;
  cursor: pointer;
  line-height: 1;
}

.bu-modal-close-icon:hover {
  color: #FFC107;
}

.bu-modal-body {
  padding: 24px;
  overflow-y: auto;
  font-size: 14px;
  line-height: 1.8;
  color: #334155;
}

.bu-modal-body img {
  max-width: 100% !important;
  height: auto !important;
  border-radius: 8px;
  margin: 12px 0;
}

.bu-modal-footer {
  padding: 14px 24px;
  background: #F8FAFC;
  border-top: 1px solid #E2E8F0;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

/* Breadcrumb */
.bu-breadcrumb-wrap {
  margin-bottom: 12px;
}
.bu-breadcrumb-list {
  display: flex;
  align-items: center;
  gap: 6px;
  list-style: none;
  padding: 0;
  margin: 0;
  flex-wrap: wrap;
}
.bu-breadcrumb-list li {
  font-size: 11.5px;
  font-weight: 600;
  color: #64748B;
}
.bu-breadcrumb-list li a {
  color: var(--bu-navy-primary);
  text-decoration: none;
}
.bu-breadcrumb-list li a:hover {
  color: var(--bu-gold-dark);
}
.bu-breadcrumb-list li + li::before {
  content: '/';
  margin-right: 6px;
  color: #CBD5E1;
}
.bu-breadcrumb-list li.active {
  color: #0F172A;
  font-weight: 700;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER -->
  <?php include('inc.header.php');?>

  <!-- ================================================================
       0. FULL-WIDTH EXECUTIVE HERO BANNER
       ================================================================ -->
  <div class="bu-inst-hero">
    <div class="bu-inst-hero-inner">
      
      <!-- BREADCRUMB -->
      <ul class="bu-inst-breadcrumb">
        <li><a href="<?php echo URL_ROOT;?>"><i class="fa fa-home"></i> Home</a></li>
        <?php if($department): ?>
        <li><a href="<?php echo href('department.php','id='.$department['id']);?>"><?php echo htmlspecialchars($department['title']);?></a></li>
        <?php endif; ?>
        <li class="active"><?php echo htmlspecialchars($aryData['institute_name']);?></li>
      </ul>

      <div class="bu-inst-hero-badge">
        <i class="<?php echo $inst_icon;?>"></i> Bhabha University &bull; UGC Recognized
      </div>

      <h1 class="bu-inst-hero-title"><?php echo htmlspecialchars($aryData['institute_name']);?></h1>

      <?php if(!empty($aryData['subtitle'])): ?>
      <p class="bu-inst-hero-subtitle">
        <i class="fa fa-star text-warning"></i> <?php echo htmlspecialchars($aryData['subtitle']);?>
      </p>
      <?php else: ?>
      <p class="bu-inst-hero-subtitle">
        Constituent Institute of Bhabha University, Bhopal &bull; Committed to Academic Excellence, Innovation &amp; Career Growth
      </p>
      <?php endif; ?>

      <!-- Hero Fast-Fact Pills -->
      <div class="bu-inst-hero-pills">
        <span class="bu-inst-hero-pill"><i class="fa fa-check-circle"></i> <?php echo htmlspecialchars(!empty($aryData['approval_text']) ? $aryData['approval_text'] : 'Approved by Statutory Regulatory Bodies');?></span>
        <span class="bu-inst-hero-pill"><i class="fa fa-university"></i> <?php echo htmlspecialchars(!empty($aryData['affiliation_text']) ? $aryData['affiliation_text'] : 'Constituent Institute of Bhabha University');?></span>
        <?php if(!empty($aryData['est_year'])): ?>
        <span class="bu-inst-hero-pill"><i class="fa fa-calendar-check-o"></i> <?php echo htmlspecialchars($aryData['est_year']);?></span>
        <?php endif; ?>
        <span class="bu-inst-hero-pill"><i class="fa fa-graduation-cap"></i> Degrees &amp; Research</span>
      </div>

    </div>
  </div>

  <div class="bu-inst-wrapper">
    <div class="bu-inst-container">

      <!-- ================================================================
           1. EXECUTIVE HERO & OVERVIEW CARD (2-COLUMN GRID)
           ================================================================ -->
      <div class="bu-inst-hero-card">
        <div class="bu-inst-hero-grid">
          
          <!-- Left: Title, Tagline, Approvals, Lead & Actions -->
          <div class="bu-inst-hero-left">
            <div class="bu-inst-badge-row">
              <span class="bu-badge bu-badge-navy"><i class="<?php echo $inst_icon;?>"></i> Bhabha University</span>
              <?php if(!empty($aryData['est_year'])): ?>
              <span class="bu-badge bu-badge-gold"><i class="fa fa-calendar-check-o"></i> <?php echo htmlspecialchars($aryData['est_year']);?></span>
              <?php endif; ?>
              <span class="bu-badge bu-badge-green"><i class="fa fa-shield"></i> UGC Recognized</span>
            </div>

            <h2 class="bu-inst-title" style="font-size: clamp(20px, 2.2vw, 28px); margin-bottom: 6px;"><?php echo htmlspecialchars($aryData['institute_name']);?></h2>
            
            <?php if(!empty($aryData['subtitle'])): ?>
            <div class="bu-inst-subtitle">
              <i class="fa fa-star text-warning"></i> <?php echo htmlspecialchars($aryData['subtitle']);?>
            </div>
            <?php endif; ?>

            <div class="bu-lead-text">
              <?php echo $overview_short;?>
            </div>

            <!-- Approvals Bar -->
            <div class="bu-approvals-bar">
              <div class="bu-approval-item">
                <i class="fa fa-check-circle"></i>
                <span><?php echo htmlspecialchars(!empty($aryData['approval_text']) ? $aryData['approval_text'] : 'Approved by Statutory Regulatory Bodies');?></span>
              </div>
              <div class="bu-approval-divider"></div>
              <div class="bu-approval-item">
                <i class="fa fa-check-circle"></i>
                <span><?php echo htmlspecialchars(!empty($aryData['affiliation_text']) ? $aryData['affiliation_text'] : 'Constituent Institute of Bhabha University');?></span>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="bu-hero-btn-row">
              <button type="button" class="bu-btn-primary" id="btnOpenOverviewModal">
                <i class="fa fa-book"></i> Read Full Overview &amp; Profile
              </button>
              <a href="<?php echo href('online-admission.php');?>" class="bu-btn-outline">
                <i class="fa fa-pencil-square-o"></i> Apply for Admission
              </a>
            </div>
          </div>

          <!-- Right: Featured Campus Media & Floating Stats -->
          <div class="bu-inst-hero-media">
            <img src="<?php echo $hero_img;?>" alt="<?php echo htmlspecialchars($aryData['institute_name']);?>" loading="lazy" onerror="this.src='<?php echo URL_ROOT;?>extra-images/slider1.jpg';">
            <div class="bu-inst-hero-stats-badge">
              <div class="bu-stat-mini">
                <strong>20+</strong>
                <span>Years Legacy</span>
              </div>
              <div class="bu-stat-mini">
                <strong>500+</strong>
                <span>Annual Alumni</span>
              </div>
              <div class="bu-stat-mini">
                <strong>95%</strong>
                <span>Career Assist</span>
              </div>
              <div class="bu-stat-mini">
                <strong>UGC</strong>
                <span>Approved</span>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ================================================================
           2. FULL-WIDTH CONTENT SECTIONS
           ================================================================ -->
      
      <!-- A. PRINCIPAL / LEADERSHIP SPOTLIGHT -->
      <?php 
        $rawMsg = $aryData['principal_message'] ?? '';
        // Automatically unwrap HTML comments if present
        $rawMsg = preg_replace('/<!--\s*([\s\S]*?)\s*-->/', '$1', $rawMsg);
        $cleanMsg = trim(strip_tags($rawMsg, '<p><br><strong><b><em>'));

        if (empty($cleanMsg) || mb_strlen($cleanMsg, 'UTF-8') < 10) {
            $prinWelcomeMsg = "<p>Welcome to <strong>" . htmlspecialchars($aryData['institute_name']) . "</strong> at Bhabha University. Our institute is dedicated to providing transformative education, fostering critical thinking, and promoting innovative research and industrial competence. Supported by state-of-the-art laboratory infrastructure, highly experienced faculty, and strong placement tie-ups, we prepare our students to excel in a rapidly evolving global landscape. We welcome all aspiring learners to join us in achieving academic and professional excellence.</p>";
        } else {
            $prinWelcomeMsg = $rawMsg;
        }

        $prinName = !empty($aryData['principal_name']) ? $aryData['principal_name'] : 'Principal / Dean';
        $prinDesig = !empty($aryData['principal_designation']) ? $aryData['principal_designation'] : 'Principal / Director';
        $prinQual = !empty($aryData['principal_qualification']) ? $aryData['principal_qualification'] : '';
        $hasPrinImg = !empty($aryData['principal_image']) && (strpos($aryData['principal_image'], 'http') === 0 || file_exists(PATH_ROOT . DS . str_replace('/', DS, $aryData['principal_image'])));
        $prinImg = $hasPrinImg ? (strpos($aryData['principal_image'], 'http') === 0 ? $aryData['principal_image'] : URL_ROOT . $aryData['principal_image']) : '';
      ?>
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Institutional Leadership</span>
          <h2 class="bu-sec-title">Principal's <em>Welcome &amp; Message</em></h2>
          <div class="bu-sec-divider"></div>
        </div>

        <div class="bu-leadership-card">
          <div class="bu-lead-avatar-wrap">
            <?php if (!empty($prinImg)): ?>
              <img src="<?php echo $prinImg;?>" alt="<?php echo htmlspecialchars($prinName);?>" class="bu-lead-avatar" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
              <div class="bu-lead-avatar-dummy" style="display:none;"><i class="fa fa-user"></i></div>
            <?php else: ?>
              <div class="bu-lead-avatar-dummy"><i class="fa fa-user"></i></div>
            <?php endif; ?>
            <h4 class="bu-lead-name"><?php echo htmlspecialchars($prinName);?></h4>
            <div class="bu-lead-designation"><?php echo htmlspecialchars($prinDesig);?></div>
            <?php if(!empty($prinQual)): ?>
            <div class="bu-lead-qual"><?php echo htmlspecialchars($prinQual);?></div>
            <?php endif; ?>
          </div>
          <div class="bu-lead-quote">
            <?php echo $prinWelcomeMsg;?>
          </div>
        </div>
      </section>

      <!-- B. ACADEMIC PROGRAMMES & SPECIALIZATIONS -->
      <?php if(!empty($programs_list) && is_array($programs_list)): ?>
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Degrees &amp; Disciplines</span>
          <h2 class="bu-sec-title">Academic <em>Programmes &amp; Specializations</em></h2>
          <div class="bu-sec-divider"></div>
        </div>

        <div class="bu-programs-grid">
          <?php foreach($programs_list as $prog): 
            $pIcon = !empty($prog['icon']) ? $prog['icon'] : 'fa-graduation-cap';
            if (strpos($pIcon, 'fa ') !== 0 && strpos($pIcon, 'fa-') === 0) {
                $pIcon = 'fa ' . $pIcon;
            }
          ?>
          <div class="bu-program-card">
            <div>
              <div class="bu-prog-top-row">
                <div class="bu-prog-avatar"><i class="<?php echo $pIcon;?>"></i></div>
                <?php if(!empty($prog['badge'])): ?>
                <span class="bu-prog-duration-badge"><?php echo htmlspecialchars($prog['badge']);?></span>
                <?php endif; ?>
              </div>

              <h3><?php echo htmlspecialchars($prog['title'] ?? 'Degree Programme');?></h3>
              
              <?php if(!empty($prog['intro'])): ?>
              <div class="bu-prog-intro"><?php echo htmlspecialchars($prog['intro']);?></div>
              <?php endif; ?>

              <?php if(!empty($prog['branches']) && is_array($prog['branches'])): ?>
              <div class="bu-prog-branches-title">
                <i class="fa fa-tags"></i> <?php echo htmlspecialchars($prog['branches_title'] ?? 'Specializations:');?>
              </div>
              <div class="bu-branch-chips">
                <?php foreach($prog['branches'] as $br): ?>
                <span class="bu-branch-chip"><i class="fa fa-circle"></i> <?php echo htmlspecialchars($br);?></span>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>

            <div class="bu-prog-card-footer">
              <a href="<?php echo href(!empty($prog['apply_url']) ? $prog['apply_url'] : 'online-admission.php');?>" class="bu-prog-apply-btn">
                Apply Online <i class="fa fa-arrow-right"></i>
              </a>
              <a href="<?php echo href(!empty($prog['secondary_url']) ? $prog['secondary_url'] : 'syllabus.php');?>" class="bu-prog-sec-btn">
                <?php echo htmlspecialchars(!empty($prog['secondary_label']) ? $prog['secondary_label'] : 'Syllabus');?>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php elseif(!empty($aryData['courses']) || !empty($aryData['branches'])): ?>
      <!-- Legacy HTML Fallback with clean modern styling -->
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Degrees &amp; Disciplines</span>
          <h2 class="bu-sec-title">Offered <em>Courses &amp; Branches</em></h2>
          <div class="bu-sec-divider"></div>
        </div>
        <div style="font-size: 14px; line-height: 1.8; color: #334155;">
          <?php if(!empty($aryData['courses'])): ?>
            <h4 style="color: var(--bu-navy-primary); font-size: 16px; margin-bottom: 8px;">Offered Degree Programmes</h4>
            <?php echo $aryData['courses'];?>
          <?php endif; ?>
          <?php if(!empty($aryData['branches'])): ?>
            <h4 style="color: var(--bu-navy-primary); font-size: 16px; margin-top: 16px; margin-bottom: 8px;">Specializations &amp; Branches</h4>
            <?php echo $aryData['branches'];?>
          <?php endif; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- C. CONSTITUENT DEPARTMENTS & WINGS -->
      <?php if((is_array($sub_department) && count($sub_department) > 0) || !empty($aryData['departments'])): ?>
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Academic Units</span>
          <h2 class="bu-sec-title">Departments &amp; <em>Wings</em></h2>
          <div class="bu-sec-divider"></div>
        </div>

        <?php if(is_array($sub_department) && count($sub_department) > 0): ?>
        <div class="bu-dept-wings-grid">
          <?php foreach($sub_department as $sub): ?>
          <a href="<?php echo href('departments.php', 'id='.$sub['id']);?>" class="bu-wing-card">
            <i class="fa fa-folder-open"></i>
            <span><?php echo htmlspecialchars($sub['title']);?></span>
          </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($aryData['departments'])): ?>
        <div style="margin-top: 14px; font-size: 13.5px; color: #334155;">
          <?php echo $aryData['departments'];?>
        </div>
        <?php endif; ?>
      </section>
      <?php endif; ?>

      <!-- D. STUDENT SUCCESS: CO-CURRICULAR ACTIVITIES & CLUBS -->
      <?php if(!empty($activities_list) && is_array($activities_list)): ?>
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Holistic Student Development</span>
          <h2 class="bu-sec-title">Co-Curricular <em>Activities &amp; Student Life</em></h2>
          <div class="bu-sec-divider"></div>
        </div>

        <div class="bu-activities-grid">
          <?php foreach($activities_list as $act): 
            $aIcon = !empty($act['icon']) ? $act['icon'] : 'fa-check-circle';
            if (strpos($aIcon, 'fa ') !== 0 && strpos($aIcon, 'fa-') === 0) {
                $aIcon = 'fa ' . $aIcon;
            }
          ?>
          <div class="bu-activity-card">
            <div class="bu-act-icon-box"><i class="<?php echo $aIcon;?>"></i></div>
            <div class="bu-act-content">
              <span class="bu-act-cat"><?php echo htmlspecialchars($act['category'] ?? 'Student Life');?></span>
              <h4><?php echo htmlspecialchars($act['title'] ?? 'Activity');?></h4>
              <?php if(!empty($act['desc'])): ?>
              <p><?php echo htmlspecialchars($act['desc']);?></p>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php elseif(!empty($aryData['activities'])): ?>
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Holistic Student Development</span>
          <h2 class="bu-sec-title">Co-Curricular <em>Activities</em></h2>
          <div class="bu-sec-divider"></div>
        </div>
        <div style="font-size: 14px; line-height: 1.8; color: #334155;">
          <?php echo $aryData['activities'];?>
        </div>
      </section>
      <?php endif; ?>

      <!-- E. CAREER, PLACEMENTS & NIRF DOCUMENTS -->
      <?php if(!empty($placements_data) && is_array($placements_data)): ?>
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Industry Connect &amp; Compliance</span>
          <h2 class="bu-sec-title">Career, Placements &amp; <em>NIRF Reports</em></h2>
          <div class="bu-sec-divider"></div>
        </div>

        <div class="bu-placement-banner">
          <h3><?php echo htmlspecialchars($placements_data['heading'] ?? 'Career & Campus Placements');?></h3>
          <p><?php echo htmlspecialchars($placements_data['tagline'] ?? 'Where best of recruiters meet the best of students');?></p>
        </div>

        <?php if(!empty($placements_data['intro'])): ?>
        <div style="font-size: 13.5px; color: #334155; line-height: 1.7; margin-bottom: 14px;">
          <?php echo htmlspecialchars($placements_data['intro']);?>
        </div>
        <?php endif; ?>

        <?php if(!empty($placements_data['eligibility_points']) && is_array($placements_data['eligibility_points'])): ?>
        <div class="bu-plc-points-grid">
          <?php foreach($placements_data['eligibility_points'] as $pt): ?>
          <div class="bu-plc-point-item">
            <i class="fa fa-check-circle"></i>
            <span><?php echo htmlspecialchars($pt);?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Recruiter Companies -->
        <?php if(!empty($placements_data['companies']) && is_array($placements_data['companies'])): ?>
        <div style="margin-top: 14px; margin-bottom: 18px;">
          <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: var(--bu-navy-primary); letter-spacing: 0.8px;">
            <i class="fa fa-building-o"></i> Top Visiting Recruiters:
          </span>
          <div class="bu-recruiter-chips">
            <?php foreach($placements_data['companies'] as $comp): ?>
            <span class="bu-recruiter-chip"><?php echo htmlspecialchars($comp);?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- NIRF & Statutory Reports Download Grid -->
        <?php if(!empty($placements_data['documents']) && is_array($placements_data['documents'])): ?>
        <div style="margin-top: 18px;">
          <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: var(--bu-navy-primary); letter-spacing: 0.8px;">
            <i class="fa fa-file-pdf-o text-danger"></i> Institutional &amp; NIRF Ranking Reports:
          </span>
          <div class="bu-doc-grid">
            <?php foreach($placements_data['documents'] as $doc): ?>
            <a href="<?php echo htmlspecialchars($doc['url']);?>" target="_blank" rel="noopener" class="bu-doc-card">
              <div class="bu-doc-info">
                <i class="fa fa-file-pdf-o"></i>
                <div>
                  <strong><?php echo htmlspecialchars($doc['title']);?></strong>
                  <span><?php echo htmlspecialchars($doc['type'] ?? 'PDF Report');?></span>
                </div>
              </div>
              <span class="bu-doc-btn">View <i class="fa fa-external-link"></i></span>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </section>
      <?php elseif(!empty($aryData['placement'])): ?>
      <section class="bu-section-block">
        <div class="bu-sec-header">
          <span class="bu-sec-subtitle">Industry Connect &amp; Compliance</span>
          <h2 class="bu-sec-title">Career &amp; <em>Placements</em></h2>
          <div class="bu-sec-divider"></div>
        </div>
        <div style="font-size: 14px; line-height: 1.8; color: #334155;">
          <?php echo $aryData['placement'];?>
        </div>
      </section>
      <?php endif; ?>

      <!-- F. FULL-WIDTH ADMISSIONS CALL TO ACTION BANNER -->
      <div class="bu-inst-cta-banner">
        <div class="bu-inst-cta-text">
          <h3>Ready to Start Your Career at Bhabha University?</h3>
          <p>Admissions Open for Academic Session 2026–27. Explore courses, experienced faculty, and placement opportunities.</p>
        </div>
        <a href="<?php echo href('online-admission.php');?>" class="bu-inst-cta-btn">
          <i class="fa fa-pencil-square-o"></i> Apply for Admission Online
        </a>
      </div>

    </div>
  </div>

  <!-- ================================================================
       READ FULL OVERVIEW MODAL POPUP
       ================================================================ -->
  <div class="bu-modal-backdrop" id="buOverviewModal" role="dialog" aria-modal="true" aria-labelledby="buModalTitle">
    <div class="bu-modal-dialog">
      <div class="bu-modal-header">
        <h3 id="buModalTitle"><i class="<?php echo $inst_icon;?> text-warning mr-2"></i> <?php echo htmlspecialchars($aryData['institute_name']);?></h3>
        <button type="button" class="bu-modal-close-icon" id="buCloseOverviewModal" aria-label="Close Modal">&times;</button>
      </div>

      <div class="bu-modal-body">
        <?php if(!empty($aryData['about_institute'])): ?>
          <?php echo $aryData['about_institute']; ?>
        <?php else: ?>
          <p>Welcome to <strong><?php echo htmlspecialchars($aryData['institute_name']);?></strong> under Bhabha University, Bhopal. Committed to providing transformative education, hands-on industrial skills, and high-impact research opportunities.</p>
        <?php endif; ?>
      </div>

      <div class="bu-modal-footer">
        <button type="button" class="bu-btn-outline" id="buCloseModalFooterBtn">Close</button>
        <a href="<?php echo href('online-admission.php');?>" class="bu-btn-primary">
          <i class="fa fa-pencil-square-o"></i> Apply for Admission
        </a>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include('inc.footer.php');?>
</div>

<?php include('inc.footer.js.php');?>

<script>
$(document).ready(function() {
    // Overview Modal Open / Close Handler
    $('#btnOpenOverviewModal').on('click', function(e) {
        e.preventDefault();
        $('#buOverviewModal').css('display', 'flex');
        $('body').css('overflow', 'hidden');
    });

    $('#buCloseOverviewModal, #buCloseModalFooterBtn, #buOverviewModal').on('click', function(e) {
        if (e.target === this) {
            $('#buOverviewModal').css('display', 'none');
            $('body').css('overflow', '');
        }
    });

    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $('#buOverviewModal').css('display', 'none');
            $('body').css('overflow', '');
        }
    });
});
</script>
</body>
</html>
