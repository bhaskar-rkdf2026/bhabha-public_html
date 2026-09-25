<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('department');
if(!$aryData) {
    header("Location: ".URL_ROOT);
    exit;
}

// Fetch associated institutes
$db->where('department', $id);
$insti = $db->get('institute');

// Fetch gallery
$db->where('department', $id);
$db->orderBy('id', 'DESC');
$gallery = $db->get('gallery');

$is_engineering = ($id == 1 || stripos($aryData['title'], 'engineering') !== false);

// Decode structured section data from DB
$programs_list = !empty($aryData['programs_data']) ? json_decode($aryData['programs_data'], true) : [];
$why_pillars   = !empty($aryData['why_choose_data']) ? json_decode($aryData['why_choose_data'], true) : [];
$attributes    = !empty($aryData['attributes_data']) ? json_decode($aryData['attributes_data'], true) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['title']);?> - Faculty &amp; Programs | Bhabha University Bhopal</title>
<meta name="description" content="Explore <?php echo htmlspecialchars($aryData['title']);?> at Bhabha University Bhopal. Discover diploma, undergraduate (B.Tech), postgraduate (M.Tech), and doctoral (Ph.D) programs with world-class labs and placement opportunities.">
<?php include('inc.meta.php');?>
<style>
/* ================================================================
   DEPARTMENT & SCHOOL PAGE — MODERN NAVY & GOLD DESIGN SYSTEM
   Bhabha University | Premium Executive Redesign (Compact & Balanced)
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

.bu-dept-wrapper {
  background-color: #F8F9FD;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--bu-text-dark);
  padding: 16px 24px 30px 24px;
  overflow-x: hidden;
}

.bu-dept-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 75px;
  box-sizing: border-box;
}

@media(max-width: 991px) {
  .bu-dept-container {
    padding: 0 20px;
  }
}

@media(max-width: 768px) {
  .bu-dept-wrapper {
    padding: 5px !important;
  }
  .bu-dept-container {
    padding: 0 5px !important;
  }
}

/* ================================================================
   1. OVERVIEW HERO CARD (2-COLUMN BALANCED LAYOUT)
   ================================================================ */
.bu-dept-hero-card {
  background: #ffffff;
  border-radius: 14px;
  border: 1px solid var(--bu-border);
  box-shadow: 0 8px 24px rgba(6, 29, 124, 0.05);
  padding: 24px 28px;
  margin-top: 5px;
  margin-bottom: 18px;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.bu-dept-hero-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--bu-gold-primary) 0%, var(--bu-gold-dark) 50%, var(--bu-navy-primary) 100%);
}

.bu-dept-hero-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 24px;
  align-items: center;
}

@media(max-width: 991px) {
  .bu-dept-hero-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  .bu-dept-hero-card {
    padding: 20px 16px;
  }
}

@media(max-width: 768px) {
  .bu-dept-hero-card {
    padding: 14px 12px;
    margin-bottom: 12px;
    border-radius: 10px;
  }
  .bu-dept-hero-grid {
    gap: 14px;
  }
}

.bu-dept-badge-row {
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

.bu-dept-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(24px, 2.5vw, 32px);
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 4px 0;
  line-height: 1.2;
}

.bu-dept-title em {
  font-style: normal;
  color: var(--bu-navy-primary);
}

@media(max-width: 768px) {
  .bu-dept-title {
    font-size: 21px;
  }
}

.bu-dept-subtitle {
  font-size: 13.5px;
  color: var(--bu-gold-dark);
  font-weight: 700;
  margin: 0 0 10px 0;
  display: flex;
  align-items: center;
  gap: 6px;
}

.bu-lead-text {
  font-size: 14px;
  line-height: 1.65;
  color: #334155;
  margin-bottom: 12px;
}

.bu-lead-text strong {
  color: var(--bu-navy-dark);
}

.bu-lead-text p {
  margin-bottom: 8px;
}

.bu-lead-text p:last-child {
  margin-bottom: 0;
}

.bu-approvals-bar {
  display: flex;
  flex-direction: column;
  gap: 7px;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-left: 3.5px solid #10B981;
  border-radius: 8px;
  padding: 10px 14px;
  margin-bottom: 12px;
}

.bu-approval-item {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  font-size: 12.5px;
  font-weight: 700;
  color: var(--bu-navy-primary);
  line-height: 1.45;
}

.bu-approval-item i {
  color: #10B981;
  font-size: 14px;
  margin-top: 2px;
  flex-shrink: 0;
}

.bu-approval-divider {
  display: none;
}

.bu-overview-action-row {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px solid #E2E8F0;
}

.bu-read-more-btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: var(--bu-navy-primary);
  color: #ffffff !important;
  font-weight: 700;
  font-size: 12.5px;
  padding: 8px 16px;
  border-radius: 6px;
  text-decoration: none !important;
  cursor: pointer;
  border: 1px solid var(--bu-navy-dark);
  transition: all 0.25s ease;
  box-shadow: 0 4px 10px rgba(6, 29, 124, 0.15);
}

.bu-read-more-btn:hover {
  background: var(--bu-navy-dark);
  color: var(--bu-gold-primary) !important;
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(6, 29, 124, 0.22);
}

.bu-read-more-btn i {
  color: var(--bu-gold-primary);
  font-size: 12px;
  transition: transform 0.2s ease;
}

.bu-read-more-btn:hover i {
  transform: translateX(3px);
}

.bu-action-note {
  font-size: 11.5px;
  color: var(--bu-text-muted);
  font-style: italic;
}

.bu-hero-image-wrap {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 22px rgba(6, 29, 124, 0.10);
  border: 2px solid #ffffff;
}

.bu-hero-image-wrap img {
  width: 100%;
  height: 280px;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}

@media(max-width: 768px) {
  .bu-hero-image-wrap img {
    height: 200px;
  }
}

.bu-hero-image-wrap:hover img {
  transform: scale(1.03);
}

.bu-hero-image-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(6, 29, 124, 0.05) 0%, rgba(4, 15, 74, 0.60) 100%);
  pointer-events: none;
}

.bu-img-floating-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  background: rgba(4, 15, 74, 0.85);
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
  color: #FFC107;
  border: 1px solid rgba(255, 193, 7, 0.4);
  font-size: 9.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  padding: 4px 10px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.bu-img-bottom-pill {
  position: absolute;
  bottom: 10px;
  left: 10px;
  right: 10px;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
  border-radius: 6px;
  padding: 8px 12px;
  display: flex;
  align-items: center;
  gap: 8px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.10);
}

.bu-img-pill-icon {
  width: 28px;
  height: 28px;
  border-radius: 5px;
  background: rgba(6, 29, 124, 0.08);
  color: var(--bu-navy-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  flex-shrink: 0;
}

.bu-img-pill-text {
  font-size: 11px;
  color: #334155;
  line-height: 1.25;
}

.bu-img-pill-text strong {
  display: block;
  font-size: 11.5px;
  color: var(--bu-navy-dark);
}

/* ================================================================
   SECTION HEADINGS (COMPACT SPACING)
   ================================================================ */
.bu-section-block,
section.bu-section-block {
  padding: 10px 0 !important;
  margin-bottom: 18px;
}

@media(max-width: 768px) {
  .bu-section-block,
  section.bu-section-block {
    padding: 6px 0 !important;
    margin-bottom: 14px;
  }
}

.bu-sec-header {
  margin-bottom: 10px;
}

.bu-sec-subtitle {
  font-size: 10px;
  font-weight: 800;
  color: var(--bu-gold-dark);
  text-transform: uppercase;
  letter-spacing: 1.2px;
  display: block;
  margin-bottom: 2px;
}

.bu-sec-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(20px, 2.2vw, 25px);
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0;
  line-height: 1.2;
}

.bu-sec-title em {
  color: var(--bu-navy-primary);
  font-style: normal;
}

.bu-sec-divider {
  width: 32px;
  height: 2.5px;
  background: var(--bu-gold-primary);
  border-radius: 2px;
  margin-top: 5px;
}

/* ================================================================
   2. VISION & MISSION (PREMIUM EXECUTIVE DUAL CARDS)
   ================================================================ */
.bu-dual-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

@media(max-width: 768px) {
  .bu-dual-grid { 
    grid-template-columns: 1fr; 
    gap: 10px;
  }
}

.bu-vm-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 16px 20px;
  position: relative;
  transition: all 0.28s ease;
  box-shadow: 0 3px 12px rgba(6, 29, 124, 0.04);
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

@media(max-width: 768px) {
  .bu-vm-card {
    padding: 12px 14px;
    border-radius: 10px;
  }
}

.bu-vm-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, var(--bu-gold-primary) 0%, var(--bu-navy-primary) 100%);
}

.bu-vm-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 22px rgba(6, 29, 124, 0.08);
  border-color: rgba(6, 29, 124, 0.2);
}

.bu-vm-watermark {
  position: absolute;
  right: 12px;
  bottom: 6px;
  font-size: 60px;
  color: rgba(6, 29, 124, 0.03);
  pointer-events: none;
}

.bu-vm-header {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 8px;
}

.bu-vm-icon {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: linear-gradient(135deg, rgba(255, 193, 7, 0.2) 0%, rgba(217, 155, 0, 0.3) 100%);
  color: var(--bu-navy-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  border: 1px solid rgba(255, 193, 7, 0.4);
  flex-shrink: 0;
}

.bu-vm-header-text h4 {
  margin: 0;
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy-dark);
  font-family: 'Playfair Display', Georgia, serif;
}

.bu-vm-header-text span {
  font-size: 9.5px;
  font-weight: 800;
  color: var(--bu-gold-dark);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.bu-vm-card p {
  font-size: 13.5px;
  line-height: 1.6;
  color: #475569;
  margin: 0;
  position: relative;
  z-index: 2;
}

.bu-vm-content {
  font-size: 13.5px;
  line-height: 1.65;
  color: #475569;
  position: relative;
  z-index: 2;
  flex-grow: 1;
}

.bu-vm-content p {
  margin-bottom: 8px;
}

.bu-vm-content p:last-child {
  margin-bottom: 0;
}

.bu-vm-content ul, .bu-vm-content ol {
  padding-left: 20px;
  margin-bottom: 8px;
}

.bu-vm-content li {
  margin-bottom: 4px;
}

/* ================================================================
   3. PROGRAMMES & SPECIALIZATIONS (2-COLUMN BALANCED CARDS)
   ================================================================ */
.bu-programs-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}

@media(max-width: 860px) {
  .bu-programs-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
}

.bu-program-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 18px 18px 14px;
  box-shadow: 0 3px 12px rgba(6, 29, 124, 0.04);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.28s ease;
  position: relative;
  overflow: hidden;
}

@media(max-width: 768px) {
  .bu-program-card {
    padding: 14px 12px;
    border-radius: 10px;
  }
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
  width: 34px;
  height: 34px;
  border-radius: 7px;
  background: rgba(6, 29, 124, 0.07);
  color: var(--bu-navy-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
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
  padding: 3px 8px;
  border-radius: 14px;
  letter-spacing: 0.3px;
}

.bu-program-card h3 {
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 5px 0;
  font-family: 'Playfair Display', Georgia, serif;
  line-height: 1.25;
}

.bu-prog-intro {
  font-size: 12px;
  color: var(--bu-text-muted);
  line-height: 1.45;
  margin-bottom: 10px;
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
  margin-bottom: 14px;
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
  gap: 10px;
  padding-top: 14px;
  border-top: 1px solid #EEF2F6;
  margin-top: auto;
  flex-wrap: wrap;
}

.bu-prog-btn,
.bu-btn-primary-sm,
.bu-btn-outline-sm {
  font-size: 12px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  line-height: 1.4;
  cursor: pointer;
  transition: all 0.22s ease-in-out;
  box-sizing: border-box;
}

/* Primary Button (Apply Online) */
.bu-prog-btn-primary,
.bu-btn-primary-sm {
  background: var(--bu-navy-primary);
  color: #FFFFFF !important;
  border: 1px solid var(--bu-navy-primary);
  box-shadow: 0 2px 6px rgba(6, 29, 124, 0.16);
}

.bu-prog-btn-primary i,
.bu-btn-primary-sm i {
  color: var(--bu-gold-primary);
  font-size: 12px;
  transition: transform 0.2s ease;
}

.bu-prog-btn-primary:hover,
.bu-btn-primary-sm:hover {
  background: var(--bu-navy-dark);
  color: var(--bu-gold-primary) !important;
  border-color: var(--bu-navy-dark);
  transform: translateY(-2px);
  box-shadow: 0 5px 12px rgba(6, 29, 124, 0.25);
}

.bu-prog-btn-primary:hover i,
.bu-btn-primary-sm:hover i {
  color: var(--bu-gold-primary);
  transform: scale(1.1);
}

/* Outline / Secondary Button (Syllabus) */
.bu-prog-btn-outline,
.bu-btn-outline-sm {
  background: #F8FAFC;
  color: var(--bu-navy-primary) !important;
  border: 1px solid #CBD5E1;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.bu-prog-btn-outline i,
.bu-btn-outline-sm i {
  color: #64748B;
  font-size: 12px;
  transition: color 0.2s ease;
}

.bu-prog-btn-outline:hover,
.bu-btn-outline-sm:hover {
  background: #EEF2FF;
  color: var(--bu-navy-dark) !important;
  border-color: var(--bu-navy-primary);
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(6, 29, 124, 0.10);
}

.bu-prog-btn-outline:hover i,
.bu-btn-outline-sm:hover i {
  color: var(--bu-navy-primary);
}

/* ================================================================
   4. ACADEMIC & EXAMINATION QUICK RESOURCES (4-COLUMN CARDS)
   ================================================================ */
.bu-resource-section {
  margin-bottom: 18px;
  width: 100%;
  clear: both;
}

.bu-resource-grid {
  display: grid !important;
  grid-template-columns: repeat(4, 1fr) !important;
  gap: 12px !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

@media(max-width: 991px) {
  .bu-resource-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 10px !important;
  }
}

@media(max-width: 575px) {
  .bu-resource-grid {
    grid-template-columns: 1fr !important;
  }
}

.bu-resource-link {
  background: #ffffff !important;
  border: 1px solid var(--bu-border) !important;
  border-radius: 10px !important;
  padding: 12px 14px !important;
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
  text-decoration: none !important;
  color: var(--bu-navy-dark) !important;
  box-shadow: 0 3px 12px rgba(6, 29, 124, 0.04) !important;
  transition: all 0.25s ease !important;
  position: relative !important;
  overflow: hidden !important;
  box-sizing: border-box !important;
  min-width: 0 !important;
}

.bu-resource-link::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 4px;
  background: var(--bu-navy-primary);
  transition: background 0.25s ease;
}

.bu-resource-link:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 20px rgba(6, 29, 124, 0.10) !important;
  border-color: rgba(6, 29, 124, 0.25) !important;
  color: var(--bu-navy-primary) !important;
}

.bu-resource-link:hover::before {
  background: var(--bu-gold-primary);
}

.bu-resource-icon-wrap {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: rgba(6, 29, 124, 0.07);
  color: var(--bu-navy-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
  transition: all 0.25s ease;
}

.bu-resource-link:hover .bu-resource-icon-wrap {
  background: var(--bu-navy-primary);
  color: var(--bu-gold-primary);
}

.bu-resource-content {
  display: flex;
  flex-direction: column;
  min-width: 0;
  flex-grow: 1;
}

.bu-resource-content strong {
  font-size: 12.5px;
  font-weight: 700;
  color: var(--bu-navy-dark);
  line-height: 1.25;
  margin-bottom: 1px;
  display: block;
}

.bu-resource-content span {
  font-size: 10.5px;
  color: var(--bu-text-muted);
  font-weight: 500;
  display: block;
}

.bu-resource-arrow {
  font-size: 11px;
  color: #94A3B8;
  transition: transform 0.2s ease, color 0.2s ease;
  margin-left: auto;
  flex-shrink: 0;
}

.bu-resource-link:hover .bu-resource-arrow {
  transform: translateX(3px);
  color: var(--bu-gold-dark);
}

/* ================================================================
   5. WHY CHOOSE BHABHA (3D SCROLL & TABBED SINGLE-CARD SHOWCASE)
   ================================================================ */
.bu-why-3d-wrapper {
  position: relative;
  width: 100%;
  margin-bottom: 22px;
}

@media(max-width: 768px) {
  .bu-why-3d-wrapper {
    margin-bottom: 14px;
  }
}

/* Category Pill Tabs Row */
.bu-why-tabs-row {
  display: flex;
  align-items: center;
  gap: 8px;
  overflow-x: auto;
  scrollbar-width: none;
  padding: 2px 2px 10px 2px;
  margin-bottom: 4px;
  -webkit-overflow-scrolling: touch;
}

.bu-why-tabs-row::-webkit-scrollbar {
  display: none;
}

@media(max-width: 768px) {
  .bu-why-tabs-row {
    gap: 6px;
    padding: 2px 2px 6px 2px;
    margin-bottom: 6px;
  }
}

.bu-why-tab-btn {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 24px;
  padding: 6px 13px;
  font-size: 11.5px;
  font-weight: 700;
  color: #475569;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  white-space: nowrap;
  transition: all 0.25s ease;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
}

@media(max-width: 768px) {
  .bu-why-tab-btn {
    padding: 5px 11px;
    font-size: 11px;
    gap: 5px;
  }
}

.bu-why-tab-btn i {
  font-size: 12px;
  color: var(--bu-navy-primary);
  transition: color 0.2s;
}

@media(max-width: 768px) {
  .bu-why-tab-btn i {
    font-size: 11px;
  }
}

.bu-why-tab-btn:hover {
  border-color: var(--bu-navy-primary);
  color: var(--bu-navy-primary);
  transform: translateY(-1px);
}

.bu-why-tab-btn.active {
  background: var(--bu-navy-primary);
  color: #ffffff;
  border-color: var(--bu-navy-primary);
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.2);
}

.bu-why-tab-btn.active i {
  color: var(--bu-gold-primary);
}

/* 3D Stage Container */
.bu-why-3d-stage {
  position: relative;
  width: 100%;
  min-height: 255px;
  perspective: 1200px;
}

@media(max-width: 860px) {
  .bu-why-3d-stage {
    min-height: auto;
    perspective: none;
  }
}

/* 3D Full-Width Cards */
.bu-why-3d-card {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  background: #ffffff;
  border-radius: 14px;
  border: 1px solid var(--bu-border);
  box-shadow: 0 10px 30px rgba(6, 29, 124, 0.07);
  padding: 18px 22px;
  box-sizing: border-box;
  opacity: 0;
  visibility: hidden;
  transform: translate3d(0, 25px, -50px) rotateX(-5deg);
  transition: opacity 0.42s cubic-bezier(0.2, 0.8, 0.2, 1),
              transform 0.42s cubic-bezier(0.2, 0.8, 0.2, 1),
              visibility 0.42s ease;
  pointer-events: none;
  overflow: hidden;
  display: grid;
  grid-template-columns: 320px 1fr;
  gap: 20px;
  align-items: center;
  z-index: 1;
}

@media(max-width: 860px) {
  .bu-why-3d-card {
    grid-template-columns: 1fr;
    gap: 12px;
    height: auto;
    padding: 14px 12px;
    position: relative;
    display: none;
    transform: none;
    border-radius: 10px;
  }
  .bu-why-3d-card.active {
    display: grid;
  }
}

.bu-why-3d-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--card-accent, #061D7C) 0%, var(--bu-gold-primary) 100%);
}

.bu-why-3d-card.active {
  opacity: 1;
  visibility: visible;
  transform: translate3d(0, 0, 0) rotateX(0deg);
  pointer-events: auto;
  z-index: 5;
}

.bu-why-3d-card.prev-card {
  opacity: 0;
  visibility: hidden;
  transform: translate3d(0, -25px, -50px) rotateX(5deg);
  z-index: 2;
}

/* Left Hero Highlight of the 3D Card */
.bu-why-card-hero {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding-right: 18px;
  border-right: 1px solid #F1F5F9;
}

@media(max-width: 860px) {
  .bu-why-card-hero {
    border-right: none;
    border-bottom: 1px solid #F1F5F9;
    padding-right: 0;
    padding-bottom: 10px;
  }
}

.bu-why-watermark-num {
  position: absolute;
  top: -12px;
  right: 4px;
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 60px;
  font-weight: 900;
  color: rgba(6, 29, 124, 0.04);
  line-height: 1;
  pointer-events: none;
  user-select: none;
}

@media(max-width: 860px) {
  .bu-why-watermark-num {
    font-size: 38px;
    top: -6px;
    right: 0px;
  }
}

.bu-why-hero-top {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 8px;
}

@media(max-width: 860px) {
  .bu-why-hero-top {
    gap: 8px;
    margin-bottom: 6px;
  }
}

.bu-why-hero-badge-icon {
  width: 40px;
  height: 40px;
  border-radius: 9px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}

@media(max-width: 860px) {
  .bu-why-hero-badge-icon {
    width: 34px;
    height: 34px;
    font-size: 15px;
    border-radius: 7px;
  }
}

.bu-icon-navy { background: rgba(6, 29, 124, 0.08); color: var(--bu-navy-primary); }
.bu-icon-green { background: rgba(16, 185, 129, 0.12); color: #059669; }
.bu-icon-amber { background: rgba(245, 158, 11, 0.14); color: #D97706; }
.bu-icon-purple { background: rgba(124, 58, 237, 0.12); color: #7C3AED; }
.bu-icon-rose { background: rgba(225, 29, 72, 0.12); color: #E11D48; }

.bu-why-hero-badge-pill {
  font-size: 9.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  padding: 3px 8px;
  border-radius: 12px;
  background: #F1F5F9;
  color: var(--bu-navy-primary);
}

@media(max-width: 860px) {
  .bu-why-hero-badge-pill {
    font-size: 9px;
    padding: 2.5px 7px;
  }
}

.bu-why-card-hero h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px;
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 5px 0;
  line-height: 1.25;
}

@media(max-width: 860px) {
  .bu-why-card-hero h3 {
    font-size: 17px;
    margin-bottom: 3px;
  }
}

.bu-why-card-hero p {
  font-size: 12px;
  color: #475569;
  line-height: 1.45;
  margin: 0;
}

@media(max-width: 860px) {
  .bu-why-card-hero p {
    font-size: 11.5px;
    line-height: 1.4;
  }
}

/* Right Feature Grid of the 3D Card */
.bu-why-card-points {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px 12px;
}

@media(max-width: 768px) {
  .bu-why-card-points {
    grid-template-columns: 1fr;
    gap: 6px;
  }
  .bu-why-card-points .bu-why-point-chip {
    grid-column: span 1 !important;
  }
}

.bu-why-point-chip {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 7px;
  padding: 7px 9px;
  display: flex;
  align-items: flex-start;
  gap: 7px;
  font-size: 11.5px;
  line-height: 1.35;
  color: #334155;
  transition: all 0.2s ease;
}

@media(max-width: 768px) {
  .bu-why-point-chip {
    padding: 7px 9px;
    font-size: 11px;
    line-height: 1.35;
  }
}

.bu-why-point-chip:hover {
  background: #EEF2FF;
  border-color: #CBD5E1;
  transform: translateX(2px);
}

.bu-why-point-chip i {
  color: #10B981;
  font-size: 10px;
  margin-top: 2px;
  flex-shrink: 0;
}

.bu-why-point-chip strong {
  color: var(--bu-navy-dark);
  font-weight: 700;
}

/* Controls & Indicator Row */
.bu-why-controls-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 10px;
  padding: 0 2px;
}

.bu-why-counter-pill {
  font-size: 11px;
  font-weight: 800;
  color: var(--bu-navy-primary);
  background: rgba(6, 29, 124, 0.08);
  padding: 4px 10px;
  border-radius: 14px;
  letter-spacing: 0.5px;
}

@media(max-width: 768px) {
  .bu-why-counter-pill {
    font-size: 10px;
    padding: 3px 8px;
  }
}

.bu-why-arrow-btn-group {
  display: flex;
  align-items: center;
  gap: 6px;
}

.bu-why-arrow-btn {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: #ffffff;
  border: 1px solid var(--bu-border);
  color: var(--bu-navy-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  cursor: pointer;
  transition: all 0.2s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

@media(max-width: 768px) {
  .bu-why-arrow-btn {
    width: 26px;
    height: 26px;
    font-size: 10px;
  }
}

.bu-why-arrow-btn:hover {
  background: var(--bu-navy-primary);
  color: #ffffff;
  border-color: var(--bu-navy-primary);
  transform: scale(1.06);
}

/* ================================================================
   6. GRADUATE ATTRIBUTES (12 PILLARS GRID — 4x3 BALANCED CARDS)
   ================================================================ */
.bu-attributes-full-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
}

@media(max-width: 1024px) {
  .bu-attributes-full-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media(max-width: 768px) {
  .bu-attributes-full-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }
}

@media(max-width: 480px) {
  .bu-attributes-full-grid {
    grid-template-columns: 1fr;
  }
}

.bu-attr-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 10px;
  padding: 13px 14px 12px 14px;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  box-shadow: 0 2px 8px rgba(6, 29, 124, 0.03);
  transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
  overflow: hidden;
}

.bu-attr-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: #E2E8F0;
  transition: background 0.25s ease;
}

.bu-attr-card:hover {
  border-color: rgba(6, 29, 124, 0.25);
  transform: translateY(-3px);
  box-shadow: 0 8px 18px rgba(6, 29, 124, 0.08);
}

.bu-attr-card:hover::before {
  background: linear-gradient(90deg, var(--bu-navy-primary), var(--bu-gold-primary));
}

.bu-attr-card-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 9px;
}

.bu-attr-icon-box {
  width: 32px;
  height: 32px;
  border-radius: 7px;
  background: rgba(6, 29, 124, 0.06);
  color: var(--bu-navy-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13.5px;
  transition: all 0.25s ease;
}

.bu-attr-card:hover .bu-attr-icon-box {
  background: var(--bu-navy-primary);
  color: #ffffff;
}

.bu-attr-num-tag {
  font-size: 11px;
  font-weight: 800;
  color: #94A3B8;
  letter-spacing: 0.5px;
  font-family: 'Playfair Display', Georgia, serif;
}

.bu-attr-title {
  font-size: 12.5px;
  font-weight: 700;
  color: var(--bu-navy-dark);
  line-height: 1.3;
  margin: 0 0 3px 0;
}

.bu-attr-sub {
  font-size: 11px;
  color: #64748B;
  line-height: 1.35;
  margin: 0;
}

/* ================================================================
   7. CONSTITUENT INSTITUTES CARDS
   ================================================================ */
.bu-school-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 12px;
}

.bu-school-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 8px;
  padding: 14px 14px;
  text-decoration: none !important;
  display: flex;
  align-items: center;
  gap: 12px;
  box-shadow: 0 3px 12px rgba(6, 29, 124, 0.04);
  transition: all 0.25s ease;
  border-left: 4px solid var(--bu-navy-primary);
}

.bu-school-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 18px rgba(6, 29, 124, 0.09);
  border-left-color: var(--bu-gold-primary);
}

.bu-school-card-icon {
  width: 36px;
  height: 36px;
  background: rgba(6, 29, 124, 0.08);
  border-radius: 7px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  color: var(--bu-navy-primary);
  flex-shrink: 0;
  transition: all 0.25s ease;
}

.bu-school-card:hover .bu-school-card-icon {
  background: var(--bu-navy-primary);
  color: var(--bu-gold-primary);
}

.bu-school-card-info h4 {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--bu-navy-primary);
  margin: 0 0 3px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.3;
}

.bu-school-card-link {
  font-size: 10.5px;
  font-weight: 800;
  color: var(--bu-gold-dark);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: flex;
  align-items: center;
  gap: 4px;
}

/* ================================================================
   8. PHOTO GALLERY (SMOOTH AUTO-SCROLL SLIDER)
   ================================================================ */
.bu-gallery-slider-wrapper {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding: 6px 0;
}

.bu-gallery-track {
  display: flex;
  gap: 14px;
  overflow-x: auto;
  scroll-behavior: smooth;
  scrollbar-width: none;
  -webkit-overflow-scrolling: touch;
  padding: 4px 2px;
  scroll-snap-type: x mandatory;
}

.bu-gallery-track::-webkit-scrollbar {
  display: none;
}

.bu-gallery-slide {
  flex: 0 0 calc(25% - 11px);
  min-width: 220px;
  max-width: 280px;
  height: 165px;
  scroll-snap-align: start;
}

@media(max-width: 991px) {
  .bu-gallery-slide {
    flex: 0 0 calc(33.333% - 10px);
    min-width: 190px;
    height: 150px;
  }
}

@media(max-width: 600px) {
  .bu-gallery-slide {
    flex: 0 0 calc(50% - 7px);
    min-width: 150px;
    height: 130px;
  }
}

.bu-gallery-item {
  position: relative;
  border-radius: 10px;
  overflow: hidden;
  width: 100%;
  height: 100%;
  box-shadow: 0 3px 10px rgba(6, 29, 124, 0.07);
  border: 1px solid var(--bu-border);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.bu-gallery-item:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(6, 29, 124, 0.12);
}

.bu-gallery-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.bu-gallery-item:hover .bu-gallery-img {
  transform: scale(1.06);
}

.bu-gallery-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(4, 15, 74, 0.88) 0%, rgba(4, 15, 74, 0.2) 60%, transparent 100%);
  display: flex;
  align-items: flex-end;
  padding: 10px 12px;
  opacity: 0;
  transition: opacity 0.25s ease;
}

.bu-gallery-item:hover .bu-gallery-overlay {
  opacity: 1;
}

.bu-gallery-overlay span {
  color: #ffffff;
  font-size: 11.5px;
  font-weight: 700;
  line-height: 1.3;
}

.bu-gallery-nav-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #ffffff;
  border: 1px solid var(--bu-border);
  color: var(--bu-navy-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  cursor: pointer;
  z-index: 5;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.15);
  transition: all 0.25s ease;
}

.bu-gallery-nav-btn:hover {
  background: var(--bu-navy-primary);
  color: #ffffff;
  border-color: var(--bu-navy-primary);
  transform: translateY(-50%) scale(1.08);
}

.bu-gallery-prev { left: 6px; }
.bu-gallery-next { right: 6px; }

/* Department Gallery Lightbox */
.bu-dept-lightbox {
  position: fixed !important;
  inset: 0 !important;
  z-index: 999999 !important;
  display: none;
  align-items: center !important;
  justify-content: center !important;
  opacity: 0;
  transition: opacity 0.28s ease;
}
.bu-dept-lightbox.active {
  display: flex !important;
  opacity: 1 !important;
}
.bu-dept-lightbox-bg {
  position: absolute !important;
  inset: 0 !important;
  background: rgba(4, 15, 74, 0.94) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
  cursor: pointer;
}
.bu-dept-lightbox-box {
  position: relative !important;
  z-index: 2 !important;
  width: 96vw !important;
  max-width: 1140px !important;
  max-height: 94vh !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
  pointer-events: auto;
}
.bu-dept-lightbox-topbar {
  width: 100% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  padding: 0 10px 10px !important;
  box-sizing: border-box !important;
}
.bu-dept-lightbox-counter {
  color: #FFC107 !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  letter-spacing: 0.6px !important;
  background: rgba(255, 255, 255, 0.12) !important;
  padding: 5px 14px !important;
  border-radius: 20px !important;
  border: 1px solid rgba(255, 193, 7, 0.4) !important;
}
.bu-dept-lightbox-close {
  background: rgba(255, 255, 255, 0.12) !important;
  border: 1px solid rgba(255, 255, 255, 0.25) !important;
  color: #FFFFFF !important;
  font-size: 26px !important;
  width: 40px !important;
  height: 40px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  line-height: 1 !important;
  transition: all 0.2s ease !important;
}
.bu-dept-lightbox-close:hover {
  background: #EF4444 !important;
  border-color: #EF4444 !important;
  transform: rotate(90deg) scale(1.08) !important;
}
.bu-dept-lightbox-stage {
  position: relative !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  width: 100% !important;
}
.bu-dept-lightbox-img-wrap {
  max-width: calc(100% - 130px) !important;
  max-height: 72vh !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  overflow: hidden !important;
  border-radius: 8px !important;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.65) !important;
  border: 2px solid rgba(255, 255, 255, 0.2) !important;
  background: #000000 !important;
}
.bu-dept-lightbox-img {
  max-width: 100% !important;
  max-height: 72vh !important;
  width: auto !important;
  height: auto !important;
  object-fit: contain !important;
  display: block !important;
  transition: opacity 0.22s ease, transform 0.22s ease !important;
}
.bu-dept-lightbox-img.changing {
  opacity: 0.2 !important;
  transform: scale(0.97) !important;
}
.bu-dept-lightbox-nav {
  position: absolute !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  width: 48px !important;
  height: 48px !important;
  border-radius: 50% !important;
  background: rgba(10, 27, 84, 0.85) !important;
  border: 1px solid rgba(255, 255, 255, 0.35) !important;
  color: #FFFFFF !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: 18px !important;
  cursor: pointer !important;
  z-index: 10 !important;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4) !important;
  transition: all 0.22s ease !important;
}
.bu-dept-lightbox-prev { left: 0 !important; }
.bu-dept-lightbox-next { right: 0 !important; }
.bu-dept-lightbox-nav:hover {
  background: #FFC107 !important;
  color: #0A1B54 !important;
  border-color: #FFC107 !important;
  transform: translateY(-50%) scale(1.1) !important;
}
.bu-dept-lightbox-caption-wrap {
  margin-top: 14px !important;
  text-align: center !important;
  max-width: 85% !important;
}
.bu-dept-lightbox-caption {
  color: #FFFFFF !important;
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 19px !important;
  font-weight: 700 !important;
  line-height: 1.3 !important;
  letter-spacing: 0.3px !important;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8) !important;
}

@media (max-width: 768px) {
  .bu-dept-lightbox-img-wrap {
    max-width: 100% !important;
    max-height: 64vh !important;
  }
  .bu-dept-lightbox-img {
    max-height: 64vh !important;
  }
  .bu-dept-lightbox-nav {
    width: 38px !important;
    height: 38px !important;
    font-size: 14px !important;
    background: rgba(10, 27, 84, 0.9) !important;
  }
  .bu-dept-lightbox-prev { left: 4px !important; }
  .bu-dept-lightbox-next { right: 4px !important; }
  .bu-dept-lightbox-caption {
    font-size: 15px !important;
  }
  .bu-dept-lightbox-counter {
    font-size: 11.5px !important;
    padding: 4px 10px !important;
  }
}

/* ================================================================
   9. ADMISSIONS CTA STRIP
   ================================================================ */
.bu-dept-cta-banner {
  background: linear-gradient(135deg, #FFC107 0%, #FFA000 100%);
  border-radius: 10px;
  padding: 20px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 14px;
  box-shadow: 0 6px 20px rgba(255, 193, 7, 0.22);
  margin-top: 18px;
}

.bu-dept-cta-text h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 21px;
  font-weight: 800;
  color: var(--bu-navy-dark);
  margin: 0 0 3px 0;
}

.bu-dept-cta-text p {
  font-size: 12.5px;
  font-weight: 600;
  color: #3b2a00;
  margin: 0;
}

.bu-dept-cta-btn {
  background: var(--bu-navy-dark);
  color: #ffffff !important;
  font-weight: 800;
  font-size: 12px;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none !important;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  box-shadow: 0 4px 10px rgba(4, 15, 74, 0.20);
  transition: all 0.22s ease;
}

.bu-dept-cta-btn:hover {
  background: var(--bu-navy-primary);
  color: var(--bu-gold-primary) !important;
  transform: translateY(-2px);
}

/* ================================================================
   INTERACTIVE OVERVIEW MODAL DIALOG (SHOWS ONLY THE IMAGE'S TEXT)
   ================================================================ */
.bu-modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(4, 15, 74, 0.72);
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  z-index: 999999;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 20px;
  opacity: 0;
  transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.bu-modal-backdrop.bu-modal-open {
  display: flex;
  opacity: 1;
}

.bu-modal-dialog {
  background: #ffffff;
  width: 100%;
  max-width: 820px;
  max-height: 85vh;
  border-radius: 16px;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  transform: scale(0.95) translateY(15px);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.bu-modal-backdrop.bu-modal-open .bu-modal-dialog {
  transform: scale(1) translateY(0);
}

.bu-modal-header {
  background: linear-gradient(135deg, var(--bu-navy-dark) 0%, var(--bu-navy-primary) 100%);
  padding: 20px 24px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 3px solid var(--bu-gold-primary);
  flex-shrink: 0;
}

.bu-modal-header-left {
  display: flex;
  align-items: center;
  gap: 12px;
}

.bu-modal-header-icon {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  background: rgba(255, 193, 7, 0.15);
  border: 1px solid rgba(255, 193, 7, 0.35);
  color: var(--bu-gold-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}

.bu-modal-header h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 19px;
  font-weight: 800;
  color: #ffffff;
  margin: 0;
  line-height: 1.2;
}

.bu-modal-header p {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.7);
  margin: 2px 0 0 0;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.bu-modal-close-icon {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.12);
  border: none;
  color: #ffffff;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  line-height: 1;
}

.bu-modal-close-icon:hover {
  background: #EF4444;
  color: #ffffff;
  transform: rotate(90deg);
}

.bu-modal-body {
  padding: 24px 28px;
  overflow-y: auto;
  font-size: 14.5px;
  line-height: 1.8;
  color: #334155;
  flex-grow: 1;
}

.bu-modal-body h4 {
  font-family: 'Playfair Display', Georgia, serif;
  color: var(--bu-navy-primary);
  font-weight: 800;
  margin: 0 0 14px 0;
  font-size: 19px;
  border-bottom: 2px solid #F1F5F9;
  padding-bottom: 6px;
}

.bu-modal-body p {
  margin-bottom: 14px;
  text-align: justify;
}

.bu-modal-body p:last-child {
  margin-bottom: 0;
}

.bu-modal-body img {
  max-width: 100%;
  height: auto !important;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.08);
  margin: 10px 0;
}

/* Executive Dean Profile Card inside Modal */
.bu-dean-profile-card {
  display: flex;
  align-items: center;
  gap: 20px;
  background: linear-gradient(135deg, #F8FAFC 0%, #EEF2FF 100%);
  border: 1px solid #CBD5E1;
  border-left: 5px solid var(--bu-navy-primary);
  border-radius: 12px;
  padding: 16px 20px;
  margin-bottom: 18px;
  box-shadow: 0 4px 14px rgba(6, 29, 124, 0.05);
}

@media(max-width: 600px) {
  .bu-dean-profile-card {
    flex-direction: column;
    text-align: center;
  }
}

.bu-dean-avatar-wrap {
  position: relative;
  width: 120px;
  height: 120px;
  flex-shrink: 0;
  border-radius: 12px;
  overflow: hidden;
  border: 2px solid var(--bu-gold-primary);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
  background: #061D7C;
}

.bu-dean-avatar-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 40px;
  color: #FFC107;
}

.bu-dean-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: top center;
  display: block;
}

.bu-dean-badge {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(4, 15, 74, 0.92);
  color: #FFC107;
  font-size: 9.5px;
  font-weight: 800;
  text-align: center;
  padding: 3px 2px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.bu-dean-info h4 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 19px;
  font-weight: 800;
  color: var(--bu-navy-primary);
  margin: 0 0 4px 0 !important;
  border: none !important;
  padding: 0 !important;
}

.bu-dean-deg {
  display: inline-block;
  background: rgba(6, 29, 124, 0.08);
  color: var(--bu-navy-primary);
  font-size: 11.5px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 14px;
  margin-bottom: 4px;
}

.bu-dean-sub {
  font-size: 12px;
  font-weight: 600;
  color: #64748B;
  margin: 0 !important;
}

/* Executive Dean Quote Box */
.bu-dean-quote-box {
  background: #FFFBEB;
  border-left: 4px solid var(--bu-gold-primary);
  border-radius: 8px;
  padding: 14px 18px;
  margin: 16px 0 18px 0;
  position: relative;
}

.bu-quote-icon {
  color: var(--bu-gold-dark);
  font-size: 16px;
  margin-right: 8px;
}

.bu-dean-quote-box p {
  font-size: 13.5px;
  line-height: 1.65;
  color: #78350F;
  margin: 0 !important;
  text-align: left !important;
}

/* Lead Box */
.bu-modal-lead-box {
  background: rgba(6, 29, 124, 0.03);
  border: 1px solid rgba(6, 29, 124, 0.12);
  border-left: 4px solid var(--bu-navy-primary);
  border-radius: 8px;
  padding: 14px 18px;
  margin-bottom: 16px;
}

.bu-lead-paragraph {
  font-size: 14.5px;
  font-weight: 600;
  color: var(--bu-navy-dark);
  margin: 0 !important;
  line-height: 1.6;
}

/* Highlight Box with 2-Column Grid */
.bu-modal-highlight-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 16px 20px;
  margin: 18px 0 16px 0;
}

.bu-modal-highlight-box h5 {
  font-size: 13.5px;
  font-weight: 800;
  color: var(--bu-navy-primary);
  margin: 0 0 10px 0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.bu-modal-highlight-box ul {
  padding-left: 0;
  list-style: none;
  margin: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px 16px;
}

@media(max-width: 600px) {
  .bu-modal-highlight-box ul {
    grid-template-columns: 1fr;
  }
}

.bu-modal-highlight-box li {
  font-size: 12.5px;
  color: #334155;
  position: relative;
  padding-left: 18px;
  line-height: 1.45;
}

.bu-modal-highlight-box li::before {
  content: "✔";
  position: absolute;
  left: 0;
  top: 0;
  color: #10B981;
  font-weight: bold;
  font-size: 11px;
}

.bu-modal-footer {
  padding: 14px 24px;
  background: #F8FAFC;
  border-top: 1px solid #E2E8F0;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 10px;
  flex-shrink: 0;
}

.bu-modal-close-btn {
  background: #E2E8F0;
  color: #334155;
  font-weight: 700;
  font-size: 12.5px;
  padding: 9px 18px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  transition: background 0.2s;
}

.bu-modal-close-btn:hover {
  background: #CBD5E1;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = $aryData['title'];
  $page_subtitle = $is_engineering 
    ? 'Fostering innovation, high-end research, and technical leadership across engineering and multidisciplinary technological domains.' 
    : 'Empowering future professionals through industry-relevant curriculum, state-of-the-art infrastructure, and expert faculty.';
  
  $rawDeptIcon = !empty($aryData['icon']) ? trim($aryData['icon']) : 'fa-graduation-cap';
  if(strpos($rawDeptIcon, 'fa ') === 0) {
      $dept_icon_class = $rawDeptIcon;
  } elseif(strpos($rawDeptIcon, 'fa-') === 0) {
      $dept_icon_class = 'fa ' . $rawDeptIcon;
  } else {
      $dept_icon_class = 'fa fa-' . $rawDeptIcon;
  }

  $page_icon     = $dept_icon_class;
  $breadcrumbs   = [
    ['label' => 'Home',    'url' => URL_ROOT],
    ['label' => 'Schools & Faculties', 'url' => href('faculties.php')],
    ['label' => $aryData['title'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-dept-wrapper">
    <div class="bu-dept-container">
      <main>

        <!-- 1. School Overview Section (2-Column Layout with Visual Image & Compact Spacing) -->
        <section class="bu-dept-hero-card" id="bu-school-overview">
          <div class="bu-dept-hero-grid">
            
            <!-- Left Column: Content & CTA -->
            <div class="bu-dept-hero-left">
              <div class="bu-dept-badge-row">
                <span class="bu-badge bu-badge-gold"><i class="fa fa-certificate"></i> AICTE / Recognized</span>
                <span class="bu-badge bu-badge-navy"><i class="fa fa-university"></i> Bhabha University Bhopal</span>
              </div>

              <h1 class="bu-dept-title">Faculty of <em><?php echo htmlspecialchars($aryData['title']);?></em></h1>
              <div class="bu-dept-subtitle"><i class="<?php echo $dept_icon_class;?>"></i> <?php echo !empty($aryData['subtitle']) ? htmlspecialchars($aryData['subtitle']) : 'Premier Higher Education at Bhabha University Bhopal';?></div>

              <!-- Approvals & Affiliations Banner -->
              <div class="bu-approvals-bar">
                <div class="bu-approval-item">
                  <i class="fa fa-check-circle"></i>
                  <span><?php echo !empty($aryData['approval_text']) ? htmlspecialchars($aryData['approval_text']) : 'Approved by Statutory Regulatory Authorities';?></span>
                </div>
                <div class="bu-approval-item">
                  <i class="fa fa-check-circle"></i>
                  <span><?php echo !empty($aryData['affiliation_text']) ? htmlspecialchars($aryData['affiliation_text']) : 'Affiliated with Bhabha University, Bhopal';?></span>
                </div>
              </div>

              <!-- Clean Short Preview of the Overview Text -->
              <div class="bu-lead-text">
                <?php if(!empty($aryData['about_lead'])): ?>
                  <?php echo $aryData['about_lead']; ?>
                <?php elseif(!empty($aryData['about'])): ?>
                  <p><?php echo strip_tags(substr($aryData['about'], 0, 400)); ?>...</p>
                <?php else: ?>
                  <p>Welcome to the <strong>Faculty of <?php echo htmlspecialchars($aryData['title']);?> at Bhabha University Bhopal</strong>. We provide state-of-the-art education, practical training, research infrastructure, and distinguished mentorship to prepare students for impactful global careers.</p>
                <?php endif; ?>
              </div>

              <!-- Action Row: Read More Modal Trigger (Opens ONLY the Image Text) -->
              <div class="bu-overview-action-row">
                <button type="button" class="bu-read-more-btn" id="buOpenOverviewModal" aria-haspopup="dialog">
                  <i class="fa fa-file-text-o"></i> Read Full Faculty Overview <i class="fa fa-arrow-right"></i>
                </button>
                <span class="bu-action-note"><i class="fa fa-info-circle"></i> Click to read the complete welcome message &amp; pedagogical philosophy.</span>
              </div>
            </div>

            <!-- Right Column: Engineering Visual Showcase Image -->
            <div class="bu-dept-hero-right">
              <div class="bu-hero-image-wrap">
                <img src="<?php echo !empty($aryData['image']) ? (strpos($aryData['image'], 'http') === 0 ? $aryData['image'] : URL_ROOT . $aryData['image']) : URL_ROOT . 'images/skill_lab.jpg';?>" 
                     alt="Faculty of <?php echo htmlspecialchars($aryData['title']);?>" 
                     onerror="this.src='<?php echo URL_ROOT;?>extra-images/slider1.jpg';">
                <div class="bu-hero-image-overlay"></div>
                <span class="bu-img-floating-badge"><i class="<?php echo $dept_icon_class;?>"></i> High-Tech Labs &amp; R&amp;D</span>
                <div class="bu-img-bottom-pill">
                  <div class="bu-img-pill-icon"><i class="fa fa-trophy"></i></div>
                  <div class="bu-img-pill-text">
                    <strong>20+ Years of Academic Excellence</strong>
                    Industry-aligned curriculum, research &amp; innovation.
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>

        <!-- 2. Vision & Mission Section (Redesigned into Premium Executive Cards) -->
        <section class="bu-section-block">
          <div class="bu-sec-header">
            <span class="bu-sec-subtitle">Guiding Principles</span>
            <h2 class="bu-sec-title">Vision &amp; <em>Mission</em></h2>
            <div class="bu-sec-divider"></div>
          </div>

          <div class="bu-dual-grid">
            <!-- Vision Card -->
            <div class="bu-vm-card">
              <div class="bu-vm-watermark"><i class="fa fa-eye"></i></div>
              <div class="bu-vm-header">
                <div class="bu-vm-icon"><i class="fa fa-eye"></i></div>
                <div class="bu-vm-header-text">
                  <span>Our Strategic Direction</span>
                  <h4>Vision</h4>
                </div>
              </div>
              <div class="bu-vm-content">
                <?php echo !empty($aryData['vision']) ? $aryData['vision'] : '<p>Our vision is to have a competent, innovative and nationally competitive human resource contributing to educational and societal advancement.</p>'; ?>
              </div>
            </div>

            <!-- Mission Card -->
            <div class="bu-vm-card">
              <div class="bu-vm-watermark"><i class="fa fa-bullseye"></i></div>
              <div class="bu-vm-header">
                <div class="bu-vm-icon"><i class="fa fa-bullseye"></i></div>
                <div class="bu-vm-header-text">
                  <span>Our Core Purpose</span>
                  <h4>Mission</h4>
                </div>
              </div>
              <div class="bu-vm-content">
                <?php echo !empty($aryData['mission']) ? $aryData['mission'] : '<p>Our mission is to ensure open and equitable access to high-quality academic and professional education of a recognized standard.</p>'; ?>
              </div>
            </div>
          </div>
        </section>

        <?php if(is_array($programs_list) && count($programs_list) > 0): ?>
        <!-- 3. Programs Offered & Branches/Specializations (2-Column Balanced Cards with Inline Tags) -->
        <section class="bu-section-block">
          <div class="bu-sec-header">
            <span class="bu-sec-subtitle">Academic Offerings</span>
            <h2 class="bu-sec-title">Programmes &amp; <em>Branches / Specialization</em></h2>
            <div class="bu-sec-divider"></div>
          </div>

          <div class="bu-programs-grid">
            <?php foreach($programs_list as $prog): ?>
            <div class="bu-program-card">
              <div>
                <div class="bu-prog-top-row">
                  <div class="bu-prog-avatar"><i class="fa <?php echo !empty($prog['icon']) ? $prog['icon'] : 'fa-graduation-cap';?>"></i></div>
                  <?php if(!empty($prog['badge'])): ?>
                  <span class="bu-prog-duration-badge"><?php echo htmlspecialchars($prog['badge']);?></span>
                  <?php endif; ?>
                </div>
                <h3><?php echo htmlspecialchars($prog['title'] ?? '');?></h3>
                <?php if(!empty($prog['intro'])): ?>
                <p class="bu-prog-intro"><?php echo htmlspecialchars($prog['intro']);?></p>
                <?php endif; ?>
                
                <?php if(!empty($prog['branches']) && is_array($prog['branches'])): ?>
                <div class="bu-prog-branches-title"><i class="fa fa-graduation-cap"></i> <?php echo htmlspecialchars($prog['branches_title'] ?? 'Specializations:');?></div>
                <div class="bu-branch-chips">
                  <?php foreach($prog['branches'] as $br): ?>
                  <span class="bu-branch-chip"><i class="fa fa-circle"></i> <?php echo htmlspecialchars($br);?></span>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
              </div>

              <div class="bu-prog-card-footer">
                <a href="<?php echo href(!empty($prog['apply_url']) ? $prog['apply_url'] : 'admissions.php');?>" class="bu-prog-btn bu-prog-btn-primary">
                  <i class="fa fa-pencil-square-o"></i> Apply Online
                </a>
                <?php if(!empty($prog['secondary_url'])): ?>
                <a href="<?php echo href($prog['secondary_url']);?>" class="bu-prog-btn bu-prog-btn-outline">
                  <i class="fa fa-file-text-o"></i> <?php echo htmlspecialchars(!empty($prog['secondary_label']) ? $prog['secondary_label'] : 'Syllabus');?>
                </a>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </section>
        <?php endif; ?>

        <!-- 4. Academic & Examination Quick Resources Section -->
        <section class="bu-section-block bu-resource-section">
          <div class="bu-sec-header">
            <span class="bu-sec-subtitle">Student Portals &amp; Academics</span>
            <h2 class="bu-sec-title">Academic &amp; <em>Examination Resources</em></h2>
            <div class="bu-sec-divider"></div>
          </div>

          <div class="bu-resource-grid">
            <a href="<?php echo href('BUQuestionPapers_engineering.php');?>" class="bu-resource-link">
              <div class="bu-resource-icon-wrap"><i class="fa fa-files-o"></i></div>
              <div class="bu-resource-content">
                <strong>Engineering Question Papers</strong>
                <span>Past Exam Question Papers</span>
              </div>
              <i class="fa fa-chevron-right bu-resource-arrow"></i>
            </a>

            <a href="<?php echo href('syllabus.php');?>" class="bu-resource-link">
              <div class="bu-resource-icon-wrap"><i class="fa fa-book"></i></div>
              <div class="bu-resource-content">
                <strong>Scheme &amp; Syllabus</strong>
                <span>Curriculum &amp; Course Structure</span>
              </div>
              <i class="fa fa-chevron-right bu-resource-arrow"></i>
            </a>

            <a href="<?php echo href('time-table.php');?>" class="bu-resource-link">
              <div class="bu-resource-icon-wrap"><i class="fa fa-calendar-check-o"></i></div>
              <div class="bu-resource-content">
                <strong>Exam Time Table</strong>
                <span>Schedule &amp; Datesheets</span>
              </div>
              <i class="fa fa-chevron-right bu-resource-arrow"></i>
            </a>

            <a href="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx" target="_blank" rel="noopener" class="bu-resource-link">
              <div class="bu-resource-icon-wrap"><i class="fa fa-user-circle"></i></div>
              <div class="bu-resource-content">
                <strong>Student ERP Login</strong>
                <span>Attendance, Marks &amp; Fees</span>
              </div>
              <i class="fa fa-external-link bu-resource-arrow"></i>
            </a>
          </div>
        </section>

        <?php if(is_array($why_pillars) && count($why_pillars) > 0): ?>
        <!-- 5. Why Choose BHABHA? (Dynamic 3D Single-Card Showcase) -->
        <section class="bu-section-block bu-why-showcase-section" id="buWhySection">
          <div class="bu-sec-header" style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:8px;">
            <div>
              <span class="bu-sec-subtitle">Institutional Excellence</span>
              <h2 class="bu-sec-title">Why Choose <em>BHABHA?</em></h2>
              <div class="bu-sec-divider"></div>
            </div>
            
            <div class="bu-why-arrow-btn-group">
              <span class="bu-why-counter-pill" id="buWhyCounter">Pillar 01 / 0<?php echo count($why_pillars);?></span>
              <button type="button" class="bu-why-arrow-btn" id="buWhyPrevBtn" aria-label="Previous Pillar"><i class="fa fa-chevron-left"></i></button>
              <button type="button" class="bu-why-arrow-btn" id="buWhyNextBtn" aria-label="Next Pillar"><i class="fa fa-chevron-right"></i></button>
            </div>
          </div>

          <div class="bu-why-3d-wrapper" id="buWhyWrapper">
            <!-- Category Tabs -->
            <div class="bu-why-tabs-row" id="buWhyTabs">
              <?php foreach($why_pillars as $pIdx => $pil): ?>
              <button type="button" class="bu-why-tab-btn <?php echo ($pIdx === 0) ? 'active' : '';?>" data-index="<?php echo $pIdx;?>">
                <i class="fa <?php echo !empty($pil['tab_icon']) ? $pil['tab_icon'] : (!empty($pil['icon']) ? $pil['icon'] : 'fa-star');?>"></i> <?php echo htmlspecialchars($pil['tab_label'] ?? $pil['title'] ?? '');?>
              </button>
              <?php endforeach; ?>
            </div>

            <!-- 3D Stage of Cards -->
            <div class="bu-why-3d-stage" id="buWhyStage">
              <?php foreach($why_pillars as $pIdx => $pil): 
                  $accentColor = !empty($pil['accent']) ? $pil['accent'] : '#061D7C';
                  $iconClass   = !empty($pil['icon_class']) ? $pil['icon_class'] : 'bu-icon-navy';
                  $iconName    = !empty($pil['icon']) ? $pil['icon'] : 'fa-check-circle';
                  $watermark   = str_pad($pIdx + 1, 2, '0', STR_PAD_LEFT);
              ?>
              <div class="bu-why-3d-card <?php echo ($pIdx === 0) ? 'active' : '';?>" data-card="<?php echo $pIdx;?>" style="--card-accent: <?php echo $accentColor;?>;">
                <div class="bu-why-card-hero">
                  <div class="bu-why-watermark-num"><?php echo $watermark;?></div>
                  <div class="bu-why-hero-top">
                    <div class="bu-why-hero-badge-icon <?php echo $iconClass;?>"><i class="fa <?php echo $iconName;?>"></i></div>
                    <span class="bu-why-hero-badge-pill"><?php echo htmlspecialchars($pil['badge_pill'] ?? 'Core Feature');?></span>
                  </div>
                  <h3><?php echo htmlspecialchars($pil['title'] ?? '');?></h3>
                  <p><?php echo htmlspecialchars($pil['summary'] ?? '');?></p>
                </div>
                <div class="bu-why-card-points">
                  <?php if(!empty($pil['points']) && is_array($pil['points'])): ?>
                    <?php foreach($pil['points'] as $pt): ?>
                    <div class="bu-why-point-chip" <?php if(!empty($pt['span2'])) echo 'style="grid-column: span 2;"';?>>
                      <i class="fa fa-check-circle"></i> 
                      <span><strong><?php echo htmlspecialchars($pt['title'] ?? '');?>:</strong> <?php echo htmlspecialchars($pt['desc'] ?? '');?></span>
                    </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php endif; ?>

        <?php if(is_array($attributes) && count($attributes) > 0): ?>
        <!-- 6. Our Graduate Attributes (Dynamic 4x3 Grid) -->
        <section class="bu-section-block">
          <div class="bu-sec-header">
            <span class="bu-sec-subtitle">Competencies &amp; Outcomes</span>
            <h2 class="bu-sec-title">Our Graduate <em>Attributes</em></h2>
            <div class="bu-sec-divider"></div>
          </div>

          <div class="bu-attributes-full-grid">
            <?php foreach($attributes as $mIdx => $att): 
                $attNum = !empty($att['num']) ? $att['num'] : str_pad($mIdx + 1, 2, '0', STR_PAD_LEFT);
                $attIcon = !empty($att['icon']) ? $att['icon'] : 'fa-check';
            ?>
            <div class="bu-attr-card">
              <div class="bu-attr-card-top">
                <div class="bu-attr-icon-box"><i class="fa <?php echo $attIcon;?>"></i></div>
                <span class="bu-attr-num-tag">#<?php echo $attNum;?></span>
              </div>
              <h4 class="bu-attr-title"><?php echo htmlspecialchars($att['title'] ?? '');?></h4>
              <?php if(!empty($att['sub'])): ?>
              <p class="bu-attr-sub"><?php echo htmlspecialchars($att['sub']);?></p>
              <?php endif; ?>
            </div>
            <?php endforeach; ?>
          </div>
        </section>
        <?php endif; ?>

        <!-- 7. Associated Constituent Institutes / Colleges -->
        <?php if(is_array($insti) && count($insti) > 0): ?>
        <section class="bu-section-block">
          <div class="bu-sec-header">
            <span class="bu-sec-subtitle">Constituent Units</span>
            <h2 class="bu-sec-title">Academic <em>Institutes &amp; Colleges</em></h2>
            <div class="bu-sec-divider"></div>
          </div>
          <div class="bu-school-grid">
            <?php foreach($insti as $iinsti): ?>
            <a href="<?php echo href("institute.php", "id=".$iinsti['id']);?>" class="bu-school-card">
              <div class="bu-school-card-icon">
                <i class="fa <?php echo !empty($aryData['icon']) ? $aryData['icon'] : 'fa-university';?>"></i>
              </div>
              <div class="bu-school-card-info">
                <h4><?php echo htmlspecialchars($iinsti['institute_name']);?></h4>
                <span class="bu-school-card-link">Explore Institute <i class="fa fa-arrow-right"></i></span>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
        </section>
        <?php endif; ?>

        <!-- 8. Photo Gallery (Auto-Scroll Interactive Slider) -->
        <?php if(is_array($gallery) && count($gallery) > 0): ?>
        <section class="bu-section-block">
          <div class="bu-sec-header" style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:8px;">
            <div>
              <span class="bu-sec-subtitle">Campus Life &amp; Events</span>
              <h2 class="bu-sec-title">Photo <em>Gallery</em></h2>
              <div class="bu-sec-divider"></div>
            </div>
            <div class="bu-why-arrow-btn-group" style="margin-bottom: 4px;">
              <button type="button" class="bu-why-arrow-btn" id="buGalleryManualPrev" aria-label="Previous photos"><i class="fa fa-chevron-left"></i></button>
              <button type="button" class="bu-why-arrow-btn" id="buGalleryManualNext" aria-label="Next photos"><i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
          
          <div class="bu-gallery-slider-wrapper" id="buGalleryWrapper">
            <div class="bu-gallery-track" id="buGalleryTrack">
              <?php foreach($gallery as $igallery): 
                $gImg = !empty($igallery['image']) ? $igallery['image'] : '';
                $imgSrc = !empty($gImg) ? (file_exists(PATH_ROOT . DS . 'upload' . DS . 'gallery' . DS . 'thumb' . DS . $gImg) ? URL_UPLOAD . 'gallery/thumb/' . $gImg : URL_UPLOAD . 'gallery/' . $gImg) : URL_ROOT . 'extra-images/home-gallery1.jpg';
                $largeSrc = !empty($gImg) ? (file_exists(PATH_ROOT . DS . 'upload' . DS . 'gallery' . DS . 'large' . DS . $gImg) ? URL_UPLOAD . 'gallery/large/' . $gImg : URL_UPLOAD . 'gallery/' . $gImg) : $imgSrc;
                $caption = !empty($igallery['title']) ? htmlspecialchars($igallery['title']) : 'Faculty Photo Gallery';
              ?>
              <div class="bu-gallery-slide">
                <div class="bu-gallery-item" data-large="<?php echo $largeSrc;?>" data-caption="<?php echo $caption;?>" style="cursor: pointer;">
                  <img src="<?php echo $imgSrc;?>" 
                       alt="<?php echo $caption;?>" 
                       class="bu-gallery-img"
                       loading="lazy"
                       onerror="this.src='<?php echo URL_ROOT;?>extra-images/home-gallery1.jpg';">
                  <div class="bu-gallery-overlay">
                    <span><?php echo $caption;?></span>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php endif; ?>

        <!-- 9. Admissions Call to Action Strip -->
        <div class="bu-dept-cta-banner">
          <div class="bu-dept-cta-text">
            <h3>Ready to Build Your Career at Bhabha University?</h3>
            <p>Admissions Open for Diploma, B.Tech, M.Tech &amp; Ph.D Programmes for 2026 Academic Session.</p>
          </div>
          <a href="<?php echo href('admissions.php');?>" class="bu-dept-cta-btn">
            <i class="fa fa-pencil-square-o"></i> Apply for Admission Online
          </a>
        </div>

      </main>
    </div>
  </div>

  <!-- ================================================================
       READ MORE POPUP / MODAL (CONTAINS ONLY THE IMAGE TEXT)
       ================================================================ -->
  <div class="bu-modal-backdrop" id="buOverviewModal" role="dialog" aria-modal="true" aria-labelledby="buModalTitle">
    <div class="bu-modal-dialog">
      <div class="bu-modal-header">
        <div class="bu-modal-header-left">
          <div class="bu-modal-header-icon">
            <i class="<?php echo $dept_icon_class;?>"></i>
          </div>
          <div>
            <h3 id="buModalTitle">Faculty of <?php echo htmlspecialchars($aryData['title']);?></h3>
            <p>Official Department Overview &amp; Philosophy</p>
          </div>
        </div>
        <button type="button" class="bu-modal-close-icon" id="buCloseOverviewModal" aria-label="Close Modal">&times;</button>
      </div>

      <div class="bu-modal-body">
        <h4>Faculty of <?php echo htmlspecialchars($aryData['title']);?></h4>
        <?php if(!empty($aryData['about_full'])): ?>
          <?php echo $aryData['about_full']; ?>
        <?php elseif(!empty($aryData['about'])): ?>
          <?php echo $aryData['about']; ?>
        <?php else: ?>
          <p>Welcome to the <strong>Faculty of <?php echo htmlspecialchars($aryData['title']);?> at Bhabha University Bhopal</strong>. We are committed to academic excellence, hands-on industrial skills, and high-impact research education.</p>
        <?php endif; ?>
      </div>

      <div class="bu-modal-footer">
        <button type="button" class="bu-modal-close-btn" id="buCloseModalFooterBtn">Close</button>
        <a href="<?php echo href('admissions.php');?>" class="bu-read-more-btn" style="padding: 9px 18px; font-size: 12.5px;">
          <i class="fa fa-pencil-square-o"></i> Apply for Admission
        </a>
      </div>
    </div>
  </div>

  <!-- Department Gallery Lightbox Modal -->
  <div class="bu-dept-lightbox" id="buDeptLightbox" role="dialog" aria-modal="true" aria-label="Department Photo Gallery Viewer">
    <div class="bu-dept-lightbox-bg" id="buDeptLightboxBg"></div>
    <div class="bu-dept-lightbox-box">
      <div class="bu-dept-lightbox-topbar">
        <span class="bu-dept-lightbox-counter" id="buDeptLightboxCounter">Photo 1 of 1</span>
        <button type="button" class="bu-dept-lightbox-close" id="buDeptLightboxClose" aria-label="Close Lightbox">&times;</button>
      </div>

      <div class="bu-dept-lightbox-stage">
        <button type="button" class="bu-dept-lightbox-nav bu-dept-lightbox-prev" id="buDeptLightboxPrev" aria-label="Previous Photo">
          <i class="fa fa-chevron-left"></i>
        </button>

        <div class="bu-dept-lightbox-img-wrap" id="buDeptLightboxImgWrap">
          <img loading="lazy" src="" alt="" id="buDeptLightboxImg" class="bu-dept-lightbox-img">
        </div>

        <button type="button" class="bu-dept-lightbox-nav bu-dept-lightbox-next" id="buDeptLightboxNext" aria-label="Next Photo">
          <i class="fa fa-chevron-right"></i>
        </button>
      </div>

      <div class="bu-dept-lightbox-caption-wrap">
        <div class="bu-dept-lightbox-caption" id="buDeptLightboxCaption"></div>
      </div>
    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>

<!-- Modal Interactive JavaScript -->
<script>
(function() {
  const openBtn = document.getElementById('buOpenOverviewModal');
  const modal = document.getElementById('buOverviewModal');
  const closeIcon = document.getElementById('buCloseOverviewModal');
  const closeFooterBtn = document.getElementById('buCloseModalFooterBtn');

  function openModal() {
    if (modal) {
      modal.classList.add('bu-modal-open');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeModal() {
    if (modal) {
      modal.classList.remove('bu-modal-open');
      document.body.style.overflow = '';
    }
  }

  if (openBtn) openBtn.addEventListener('click', openModal);
  if (closeIcon) closeIcon.addEventListener('click', closeModal);
  if (closeFooterBtn) closeFooterBtn.addEventListener('click', closeModal);

  // Close when clicking on backdrop
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModal();
      }
    });
  }

  // Close on Escape key press
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal && modal.classList.contains('bu-modal-open')) {
      closeModal();
    }
  });
})();

/* ================================================================
   3D WHY CHOOSE SHOWCASE CONTROLLER (SCROLL & TAB SYNCHRONIZATION)
   ================================================================ */
(function() {
  const cards = document.querySelectorAll('.bu-why-3d-card');
  const tabs = document.querySelectorAll('.bu-why-tab-btn');
  const counter = document.getElementById('buWhyCounter');
  const prevBtn = document.getElementById('buWhyPrevBtn');
  const nextBtn = document.getElementById('buWhyNextBtn');
  const wrapper = document.getElementById('buWhyWrapper');

  if (!cards.length) return;

  let currentIndex = 0;
  const totalCards = cards.length;

  function showCard(index, direction) {
    if (index < 0) index = totalCards - 1;
    if (index >= totalCards) index = 0;

    cards.forEach((card, i) => {
      card.classList.remove('active', 'prev-card');
      if (i === index) {
        card.classList.add('active');
      } else if (i < index) {
        card.classList.add('prev-card');
      }
    });

    tabs.forEach((tab, i) => {
      if (i === index) {
        tab.classList.add('active');
        tab.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
      } else {
        tab.classList.remove('active');
      }
    });

    if (counter) {
      counter.textContent = 'Pillar 0' + (index + 1) + ' / 0' + totalCards;
    }

    currentIndex = index;
  }

  // Tab click event
  tabs.forEach(tab => {
    tab.addEventListener('click', function() {
      const idx = parseInt(this.getAttribute('data-index'), 10);
      showCard(idx);
    });
  });

  // Next / Prev button events
  if (prevBtn) prevBtn.addEventListener('click', () => showCard(currentIndex - 1, 'prev'));
  if (nextBtn) nextBtn.addEventListener('click', () => showCard(currentIndex + 1, 'next'));

  // Interactive Wheel Scroll Detection when hovering over the showcase
  let isThrottled = false;
  if (wrapper) {
    wrapper.addEventListener('wheel', function(e) {
      if (Math.abs(e.deltaY) > 25) {
        if (!isThrottled) {
          if (e.deltaY > 0 && currentIndex < totalCards - 1) {
            e.preventDefault();
            showCard(currentIndex + 1, 'next');
            isThrottled = true;
            setTimeout(() => { isThrottled = false; }, 400);
          } else if (e.deltaY < 0 && currentIndex > 0) {
            e.preventDefault();
            showCard(currentIndex - 1, 'prev');
            isThrottled = true;
            setTimeout(() => { isThrottled = false; }, 400);
          }
        }
      }
    }, { passive: false });

    // Touch swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    wrapper.addEventListener('touchstart', function(e) {
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    wrapper.addEventListener('touchend', function(e) {
      touchEndX = e.changedTouches[0].screenX;
      if (touchStartX - touchEndX > 50) {
        showCard(currentIndex + 1, 'next');
      } else if (touchEndX - touchStartX > 50) {
        showCard(currentIndex - 1, 'prev');
      }
    }, { passive: true });
  }
})();

/* ================================================================
   PHOTO GALLERY AUTO-SCROLL SLIDER CONTROLLER
   ================================================================ */
(function() {
  const track = document.getElementById('buGalleryTrack');
  const wrapper = document.getElementById('buGalleryWrapper');
  const manualPrev = document.getElementById('buGalleryManualPrev');
  const manualNext = document.getElementById('buGalleryManualNext');

  if (!track) return;

  let isHovered = false;
  let autoTimer = null;

  function getSlideWidth() {
    const firstSlide = track.querySelector('.bu-gallery-slide');
    if (!firstSlide) return 260;
    return firstSlide.offsetWidth + 14;
  }

  function nextSlide() {
    const step = getSlideWidth();
    const maxScroll = track.scrollWidth - track.clientWidth;
    
    if (track.scrollLeft >= maxScroll - 10) {
      track.scrollTo({ left: 0, behavior: 'smooth' });
    } else {
      track.scrollBy({ left: step, behavior: 'smooth' });
    }
  }

  function prevSlide() {
    const step = getSlideWidth();
    if (track.scrollLeft <= 10) {
      track.scrollTo({ left: track.scrollWidth, behavior: 'smooth' });
    } else {
      track.scrollBy({ left: -step, behavior: 'smooth' });
    }
  }

  function startAuto() {
    stopAuto();
    autoTimer = setInterval(() => {
      if (!isHovered) {
        nextSlide();
      }
    }, 3200);
  }

  function stopAuto() {
    if (autoTimer) {
      clearInterval(autoTimer);
      autoTimer = null;
    }
  }

  if (wrapper) {
    wrapper.addEventListener('mouseenter', () => { isHovered = true; stopAuto(); });
    wrapper.addEventListener('mouseleave', () => { isHovered = false; startAuto(); });
    wrapper.addEventListener('touchstart', () => { isHovered = true; stopAuto(); }, { passive: true });
    wrapper.addEventListener('touchend', () => { isHovered = false; startAuto(); }, { passive: true });
  }

  if (manualNext) {
    manualNext.addEventListener('click', () => {
      nextSlide();
      startAuto();
    });
  }

  if (manualPrev) {
    manualPrev.addEventListener('click', () => {
      prevSlide();
      startAuto();
    });
  }

  startAuto();

  // Department Gallery Interactive Lightbox Controller
  const deptModal = document.getElementById('buDeptLightbox');
  const deptModalImg = document.getElementById('buDeptLightboxImg');
  const deptModalCaption = document.getElementById('buDeptLightboxCaption');
  const deptModalCounter = document.getElementById('buDeptLightboxCounter');
  const deptCloseBtn = document.getElementById('buDeptLightboxClose');
  const deptBgOverlay = document.getElementById('buDeptLightboxBg');
  const deptPrevBtn = document.getElementById('buDeptLightboxPrev');
  const deptNextBtn = document.getElementById('buDeptLightboxNext');
  const galleryItems = document.querySelectorAll('#buGalleryTrack .bu-gallery-item');

  let deptItems = [];
  let deptCurrentIndex = 0;

  galleryItems.forEach(item => {
    deptItems.push({
      large: item.getAttribute('data-large') || item.querySelector('img')?.src,
      caption: item.getAttribute('data-caption') || item.querySelector('.bu-gallery-overlay span')?.textContent || 'Photo Gallery'
    });
  });

  function showDeptImage(index) {
    if (!deptItems.length || !deptModalImg) return;

    if (index < 0) {
      index = deptItems.length - 1;
    } else if (index >= deptItems.length) {
      index = 0;
    }

    deptCurrentIndex = index;
    const cur = deptItems[deptCurrentIndex];

    deptModalImg.classList.add('changing');
    setTimeout(() => {
      deptModalImg.src = cur.large;
      if (deptModalCaption) deptModalCaption.textContent = cur.caption;
      if (deptModalCounter) {
        deptModalCounter.textContent = 'Photo ' + (deptCurrentIndex + 1) + ' of ' + deptItems.length;
      }
      deptModalImg.onload = () => deptModalImg.classList.remove('changing');
      setTimeout(() => deptModalImg.classList.remove('changing'), 150);
    }, 100);
  }

  function openDeptModal(largeSrc) {
    if (!deptModal) return;
    const foundIdx = deptItems.findIndex(it => it.large === largeSrc);
    deptCurrentIndex = (foundIdx !== -1) ? foundIdx : 0;
    showDeptImage(deptCurrentIndex);
    deptModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeDeptModal() {
    if (deptModal) {
      deptModal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  galleryItems.forEach(item => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
      openDeptModal(item.getAttribute('data-large'));
    });
  });

  if (deptPrevBtn) {
    deptPrevBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      showDeptImage(deptCurrentIndex - 1);
    });
  }

  if (deptNextBtn) {
    deptNextBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      showDeptImage(deptCurrentIndex + 1);
    });
  }

  if (deptCloseBtn) deptCloseBtn.addEventListener('click', closeDeptModal);
  if (deptBgOverlay) deptBgOverlay.addEventListener('click', closeDeptModal);

  document.addEventListener('keydown', (e) => {
    if (!deptModal || !deptModal.classList.contains('active')) return;
    if (e.key === 'ArrowLeft') {
      e.preventDefault();
      showDeptImage(deptCurrentIndex - 1);
    } else if (e.key === 'ArrowRight') {
      e.preventDefault();
      showDeptImage(deptCurrentIndex + 1);
    } else if (e.key === 'Escape') {
      e.preventDefault();
      closeDeptModal();
    }
  });

  const deptStage = document.querySelector('.bu-dept-lightbox-stage');
  if (deptStage) {
    let tStartX = 0;
    let tEndX = 0;
    deptStage.addEventListener('touchstart', (e) => {
      tStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    deptStage.addEventListener('touchend', (e) => {
      tEndX = e.changedTouches[0].screenX;
      if (tStartX - tEndX > 45) {
        showDeptImage(deptCurrentIndex + 1);
      } else if (tEndX - tStartX > 45) {
        showDeptImage(deptCurrentIndex - 1);
      }
    }, { passive: true });
  }
})();
</script>
</body>
</html>
