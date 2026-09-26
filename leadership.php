<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('leadership') : null;

// Fetch all leadership rows dynamically from database ordered by sort_order
$leadership_data = $db->orderBy('sort_order', 'ASC')->get('leadership');

$chancellor = null;
$council_leaders = [];
$officers = [];

if (is_array($leadership_data)) {
    foreach ($leadership_data as $row) {
        $title_lower = strtolower(trim($row['title'] ?? ''));
        $desig_lower = strtolower(trim($row['designation'] ?? ''));
        
        // Chancellor
        if (strpos($title_lower, 'pro chancellor') === false && (strpos($title_lower, 'chancellor') !== false || strpos($desig_lower, 'chancellor') !== false) && !$chancellor) {
            $chancellor = $row;
        } 
        // Apex Council (Pro-Chancellor & Vice-Chancellor)
        elseif (strpos($title_lower, 'pro chancellor') !== false || strpos($desig_lower, 'pro chancellor') !== false ||
                strpos($title_lower, 'vice chancellor') !== false || strpos($desig_lower, 'vice chancellor') !== false || 
                strpos($desig_lower, 'vc') !== false) {
            $council_leaders[] = $row;
        } 
        // Officers & Administration (CEO, Registrar, CVO, and others)
        else {
            $officers[] = $row;
        }
    }
}

// Helper to get image URL
function getLeaderImgUrl($imgName) {
    if (!empty($imgName)) {
        if (strpos($imgName, 'http') === 0) return $imgName;
        if (strpos($imgName, 'new-media/') === 0) return URL_ROOT . $imgName;
        if (file_exists('new-media/leadership/' . $imgName)) {
            return URL_ROOT . 'new-media/leadership/' . $imgName;
        }
        if (file_exists('upload/leadership/' . $imgName)) {
            return URL_ROOT . 'upload/leadership/' . $imgName;
        }
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Administration & Leadership - Bhabha University Bhopal'); ?></title>
<meta name="description" content="Meet the visionary leadership and administration of Bhabha University Bhopal — Chancellor Sadhna Kumari, Pro-Chancellor Dr. Siddarth Kapoor, Vice-Chancellor, CEO, and Registrar dedicated to transformative higher education.">
<?php include('inc.meta.php');?>

<style>
/* ================================================================
   BHABHA UNIVERSITY — MODERN EXECUTIVE LEADERSHIP STYLING
   Theme: Navy #061D7C, Royal Gold #FFC107, Soft White #F8FAFC
   ================================================================ */

:root {
  --bu-lead-navy: #061D7C;
  --bu-lead-navy-dark: #040F4A;
  --bu-lead-navy-light: #0D2CB5;
  --bu-lead-gold: #FFC107;
  --bu-lead-gold-dark: #D99B00;
  --bu-lead-gold-light: #FFF8E1;
  --bu-lead-text: #0F172A;
  --bu-lead-muted: #475569;
  --bu-lead-border: #E2E8F0;
  --bu-lead-card-bg: #FFFFFF;
}

/* Page Intro Banner Card */
.bu-lead-intro-card {
  background: #ffffff;
  border-radius: 14px;
  border: 1px solid var(--bu-lead-border);
  box-shadow: 0 6px 24px rgba(6, 29, 124, 0.05);
  padding: 24px 28px;
  margin-bottom: 22px;
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
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  padding: 4px 10px;
  border-radius: 20px;
  margin-bottom: 8px;
}

.bu-lead-intro-p {
  font-size: 14px;
  line-height: 1.7;
  color: #334155;
  margin: 0 0 16px 0;
  max-width: 900px;
}

/* Quick Metrics Row */
.bu-lead-metrics-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
  margin-top: 14px;
  padding-top: 16px;
  border-top: 1px solid #F1F5F9;
}

.bu-lead-metric-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 10px 14px;
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
  font-size: 15px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  font-family: 'Playfair Display', Georgia, serif;
  line-height: 1.15;
}

.bu-lead-metric-info span {
  font-size: 10.5px;
  color: var(--bu-lead-muted);
  font-weight: 600;
}

/* ================================================================
   CHANCELLOR APEX SPOTLIGHT CARD
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

.bu-chancellor-badge-tag {
  display: none;
}

.bu-chancellor-oxford-pill {
  background: #FFFBEB;
  border: 1px solid rgba(217, 155, 0, 0.35);
  color: #854D0E;
  font-size: 10.5px;
  font-weight: 700;
  padding: 5px 10px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  line-height: 1.25;
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

/* Chancellor Callout Quote */
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

/* Focus Chips Row */
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
}

.bu-focus-chip i {
  color: #10B981;
  font-size: 10px;
}

/* ================================================================
   SECTION 2: APEX ACADEMIC & COUNCIL LEADERSHIP (2-COLUMN BALANCED)
   ================================================================ */
.bu-lead-sec-heading {
  margin: 28px 0 16px 0;
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

.bu-council-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 18px;
  align-items: stretch;
  margin-bottom: 24px;
}

.bu-council-card {
  background: #ffffff;
  border: 1px solid var(--bu-lead-border);
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(6, 29, 124, 0.04);
  padding: 22px 20px 18px 20px;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
  box-sizing: border-box;
  transition: all 0.28s ease;
}

.bu-council-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3.5px;
  background: linear-gradient(90deg, var(--bu-lead-gold) 0%, var(--bu-lead-navy) 100%);
}

.bu-council-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 28px rgba(6, 29, 124, 0.09);
  border-color: rgba(6, 29, 124, 0.25);
}

.bu-council-top {
  display: flex;
  gap: 20px;
  align-items: center;
  margin-bottom: 16px;
  padding-bottom: 16px;
  border-bottom: 1px solid #F1F5F9;
}

.bu-council-avatar {
  width: 175px;
  max-width: 100%;
  height: auto;
  aspect-ratio: 1 / 1.05;
  border-radius: 14px;
  overflow: hidden;
  border: 3.5px solid #ffffff;
  box-shadow: 0 10px 26px rgba(6, 29, 124, 0.14), 0 0 0 2px var(--bu-lead-gold);
  background: #ffffff;
  flex-shrink: 0;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.bu-council-avatar:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 28px rgba(6, 29, 124, 0.2), 0 0 0 2.5px var(--bu-lead-gold-dark);
}

.bu-council-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center top;
  display: block;
}

.bu-council-header-info {
  flex: 1;
  min-width: 0;
}

.bu-council-header-info h4 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 18.5px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 3px 0;
  line-height: 1.2;
}

.bu-council-role-badge {
  font-size: 9.5px;
  font-weight: 800;
  color: #996500;
  background: rgba(255, 193, 7, 0.18);
  padding: 3px 8px;
  border-radius: 12px;
  display: inline-block;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 4px;
}

.bu-council-desig-text {
  font-size: 11.5px;
  color: #64748B;
  font-weight: 600;
  margin: 0;
}

.bu-council-quote {
  background: #F8FAFC;
  border-left: 3px solid var(--bu-lead-gold-dark);
  border-radius: 4px;
  padding: 10px 12px;
  margin-bottom: 14px;
  font-size: 12.5px;
  font-style: italic;
  color: var(--bu-lead-navy-dark);
  line-height: 1.45;
}

.bu-council-body {
  font-size: 13px;
  line-height: 1.65;
  color: #475569;
  flex-grow: 1;
  margin-bottom: 16px;
}

.bu-council-body p {
  margin-bottom: 10px;
  text-align: justify;
}

.bu-council-body p:last-child {
  margin-bottom: 0;
}

.bu-council-chips-footer {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  padding-top: 12px;
  border-top: 1px solid #F1F5F9;
}

.bu-council-chip {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 3.5px 9px;
  font-size: 10.5px;
  font-weight: 700;
  color: #334155;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.bu-council-chip i {
  color: var(--bu-lead-navy);
  font-size: 9.5px;
}

/* ================================================================
   SECTION 3: EXECUTIVE & STATUTORY OFFICERS (3-COLUMN BALANCED)
   ================================================================ */
.bu-officers-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  align-items: stretch;
  margin-bottom: 24px;
}

.bu-officer-card {
  background: #ffffff;
  border: 1px solid var(--bu-lead-border);
  border-radius: 10px;
  padding: 18px 16px 14px 16px;
  box-shadow: 0 3px 12px rgba(6, 29, 124, 0.03);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
  box-sizing: border-box;
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}

.bu-officer-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: #E2E8F0;
  transition: background 0.25s ease;
}

.bu-officer-card:hover {
  transform: translateY(-3px);
  border-color: rgba(6, 29, 124, 0.25);
  box-shadow: 0 10px 22px rgba(6, 29, 124, 0.08);
}

.bu-officer-card:hover::before {
  background: linear-gradient(90deg, var(--bu-lead-navy) 0%, var(--bu-lead-gold) 100%);
}

.bu-officer-top {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
  padding-bottom: 10px;
  border-bottom: 1px solid #F1F5F9;
}

.bu-officer-avatar {
  width: 120px;
  height: auto;
  aspect-ratio: 1 / 1.05;
  border-radius: 12px;
  overflow: hidden;
  border: 3px solid #ffffff;
  box-shadow: 0 6px 18px rgba(6, 29, 124, 0.14), 0 0 0 1.5px var(--bu-lead-navy);
  background: #ffffff;
  flex-shrink: 0;
  transition: transform 0.25s ease;
}

.bu-officer-avatar:hover {
  transform: translateY(-2px);
}

.bu-officer-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center top;
  display: block;
}

.bu-officer-header-info {
  flex: 1;
  min-width: 0;
}

.bu-officer-header-info h4 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 15.5px;
  font-weight: 800;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 2px 0;
  line-height: 1.2;
}

.bu-officer-badge {
  font-size: 9px;
  font-weight: 800;
  color: var(--bu-lead-navy);
  background: rgba(6, 29, 124, 0.08);
  padding: 2.5px 7px;
  border-radius: 10px;
  display: inline-block;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  margin-bottom: 2px;
}

.bu-officer-desig {
  font-size: 10.5px;
  color: #64748B;
  font-weight: 600;
  margin: 0;
}

.bu-officer-quote-line {
  font-size: 11px;
  font-style: italic;
  color: var(--bu-lead-navy);
  background: #F8FAFC;
  border-left: 2.5px solid var(--bu-lead-gold);
  padding: 5px 8px;
  border-radius: 3px;
  margin-bottom: 10px;
  line-height: 1.4;
}

.bu-officer-desc {
  font-size: 12px;
  line-height: 1.6;
  color: #475569;
  flex-grow: 1;
  margin-bottom: 12px;
  text-align: justify;
}

.bu-officer-desc p {
  margin: 0;
}

.bu-officer-chips-footer {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
  padding-top: 10px;
  border-top: 1px solid #F1F5F9;
}

.bu-officer-chip {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 2.5px 7px;
  font-size: 9.5px;
  font-weight: 700;
  color: #475569;
  display: inline-flex;
  align-items: center;
  gap: 3.5px;
}

.bu-officer-chip i {
  color: #10B981;
  font-size: 8px;
}

/* ================================================================
   SECTION 4: GOVERNANCE & STEWARDSHIP PILLARS (4-GRID)
   ================================================================ */
.bu-gov-pillars-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
  margin-bottom: 24px;
}

.bu-gov-card {
  background: #ffffff;
  border: 1px solid var(--bu-lead-border);
  border-radius: 10px;
  padding: 14px 14px 12px 14px;
  box-shadow: 0 2px 8px rgba(6, 29, 124, 0.03);
  transition: all 0.25s ease;
  display: flex;
  flex-direction: column;
}

.bu-gov-card:hover {
  transform: translateY(-2px);
  border-color: rgba(6, 29, 124, 0.25);
  box-shadow: 0 8px 18px rgba(6, 29, 124, 0.08);
}

.bu-gov-icon-box {
  width: 34px;
  height: 34px;
  border-radius: 7px;
  background: rgba(6, 29, 124, 0.07);
  color: var(--bu-lead-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  margin-bottom: 8px;
  transition: all 0.25s ease;
}

.bu-gov-card:hover .bu-gov-icon-box {
  background: var(--bu-lead-navy);
  color: var(--bu-lead-gold);
}

.bu-gov-card h4 {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--bu-lead-navy-dark);
  margin: 0 0 4px 0;
  line-height: 1.3;
}

.bu-gov-card p {
  font-size: 11.5px;
  color: #64748B;
  line-height: 1.4;
  margin: 0;
  flex-grow: 1;
}

/* ================================================================
   SECTION 5: SECRETARIAT & EXECUTIVE CONTACT STRIP
   ================================================================ */
.bu-secretariat-strip {
  background: linear-gradient(135deg, var(--bu-lead-navy-dark) 0%, var(--bu-lead-navy) 100%);
  border-radius: 12px;
  padding: 20px 24px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  box-shadow: 0 8px 24px rgba(6, 29, 124, 0.15);
  border: 1px solid rgba(255, 193, 7, 0.2);
}

.bu-secretariat-text h4 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 19px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 4px 0;
}

.bu-secretariat-text p {
  font-size: 12px;
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
}

.bu-secretariat-contacts {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.bu-sec-contact-pill {
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.25);
  border-radius: 6px;
  padding: 6px 12px;
  color: #ffffff !important;
  font-size: 11.5px;
  font-weight: 700;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.22s ease;
}

.bu-sec-contact-pill i {
  color: var(--bu-lead-gold);
}

.bu-sec-contact-pill:hover {
  background: var(--bu-lead-gold);
  color: var(--bu-lead-navy-dark) !important;
  border-color: var(--bu-lead-gold);
  transform: translateY(-2px);
}

.bu-sec-contact-pill:hover i {
  color: var(--bu-lead-navy-dark);
}

/* ================================================================
   RESPONSIVE DESIGN (MOBILE VIEW 5PX PADDING)
   ================================================================ */
@media(max-width: 991px) {
  .bu-chancellor-grid {
    grid-template-columns: 1fr;
    gap: 22px;
  }
  .bu-chancellor-left-col {
    align-items: center;
  }
  .bu-chancellor-portrait-wrap {
    width: 280px;
    max-width: 90%;
    margin: 0 auto 16px auto;
  }
  .bu-council-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .bu-officers-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .bu-gov-pillars-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .bu-lead-metrics-row {
    grid-template-columns: repeat(2, 1fr);
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
    height: auto;
    aspect-ratio: 1 / 1.08;
    margin: 0 auto 14px auto;
  }
  .bu-chancellor-right-col h3 {
    font-size: 22px;
  }
  .bu-council-top {
    flex-direction: column;
    text-align: center;
    gap: 14px;
  }
  .bu-council-avatar {
    width: 200px;
    max-width: 85%;
    margin: 0 auto;
  }
  .bu-council-header-info {
    text-align: center;
  }
  .bu-council-card {
    padding: 18px 16px;
  }
  .bu-officers-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  .bu-gov-pillars-grid {
    grid-template-columns: 1fr;
    gap: 8px;
  }
  .bu-secretariat-strip {
    padding: 16px 14px;
    text-align: center;
    justify-content: center;
  }
  .bu-secretariat-contacts {
    justify-content: center;
    width: 100%;
  }
  .bu-sec-contact-pill {
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
  $page_title    = portalVal($portalPage, 'heading', 'Administration & <em>Leadership</em>');
  $page_subtitle = portalVal($portalPage, 'subheading', 'Visionary leaders steering academic excellence, research innovation, and egalitarian student empowerment.');
  $page_icon     = 'fa-users';
  $breadcrumbs   = [
    ['label' => 'Home',     'url' => URL_ROOT],
    ['label' => 'About',    'url' => href('about.php')],
    ['label' => 'Administration & Leadership', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'leadership'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- SECTION 1: EXECUTIVE OVERVIEW BANNER CARD -->
      <div class="bu-lead-intro-card">
        <div class="bu-lead-header-row">
          <div class="bu-lead-title-box">
            <span class="bu-lead-badge"><i class="fa fa-university"></i> Governance &amp; Stewardship</span>
            <h2>Administration &amp; <em>Leadership</em></h2>
          </div>
        </div>
        
        <p class="bu-lead-intro-p">
          At Bhabha University, our governance structure brings together eminent academicians, visionary philanthropists, 
          and seasoned corporate administrators. Driven by a passion for borderless learning and impactful research, 
          our leadership team creates an egalitarian, world-class ecosystem where curiosity thrives and technical leadership is nurtured.
        </p>

        <!-- Institutional Metrics -->
        <div class="bu-lead-metrics-row">
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-graduation-cap"></i></div>
            <div class="bu-lead-metric-info">
              <strong>16+ Faculties</strong>
              <span>Academic Departments</span>
            </div>
          </div>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-handshake-o"></i></div>
            <div class="bu-lead-metric-info">
              <strong>50+ MOUs</strong>
              <span>Industry &amp; Research Ties</span>
            </div>
          </div>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-users"></i></div>
            <div class="bu-lead-metric-info">
              <strong>500+ Mentors</strong>
              <span>Scholars &amp; Professors</span>
            </div>
          </div>
          <div class="bu-lead-metric-item">
            <div class="bu-lead-metric-icon"><i class="fa fa-globe"></i></div>
            <div class="bu-lead-metric-info">
              <strong>Oxford UK</strong>
              <span>Academic Union Honors</span>
            </div>
          </div>
        </div>
      </div>

      <!-- SECTION 2: THE CHANCELLOR'S EXECUTIVE DESK (APEX SPOTLIGHT) -->
      <?php if ($chancellor): 
          $chancellor_img = getLeaderImgUrl($chancellor['image'] ?? '');
          $chanc_chips = !empty($chancellor['chips']) ? array_map('trim', explode(',', $chancellor['chips'])) : [
              'Research-Driven Formations', 'Academic Union Oxford Linkage', 'Entrepreneurial Incubation', 'Digital Campus Transformation'
          ];
      ?>
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <!-- Left Column: Portrait & Honors Badge -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <?php if (!empty($chancellor_img)): ?>
                <img src="<?php echo $chancellor_img; ?>" alt="<?php echo htmlspecialchars($chancellor['name']); ?>" loading="lazy" decoding="async" onerror="this.src='<?php echo URL_IMG;?>vcpic.jpg'">
              <?php else: ?>
                <img src="<?php echo URL_ROOT; ?>images/vcpic.jpg" alt="<?php echo htmlspecialchars($chancellor['name']); ?>" loading="lazy" decoding="async" onerror="this.src='<?php echo URL_IMG;?>vcpic.jpg'">
              <?php endif; ?>
              <div class="bu-chancellor-badge-tag"><?php echo htmlspecialchars($chancellor['title'] ?: 'Chancellor'); ?></div>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> Honorary Professor, Academic Union Oxford, UK
            </div>
          </div>

          <!-- Right Column: Executive Statement & Bio -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-quote-left"></i> From the Chancellor's Desk</span>
            <h3><?php echo htmlspecialchars($chancellor['name']); ?></h3>
            <span class="bu-chancellor-desig-sub"><?php echo htmlspecialchars($chancellor['designation']); ?></span>

            <?php if (!empty($chancellor['quote'])): ?>
            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “<?php echo htmlspecialchars($chancellor['quote']); ?>”
              </p>
            </div>
            <?php endif; ?>

            <div class="bu-chancellor-body-text">
              <?php echo $chancellor['about']; ?>
            </div>

            <!-- Focus Chips -->
            <?php if (!empty($chanc_chips)): ?>
            <div class="bu-chancellor-chips-row">
              <?php foreach ($chanc_chips as $chip): ?>
                <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> <?php echo htmlspecialchars($chip); ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
      <?php endif; ?>

      <!-- SECTION 3: APEX ACADEMIC & COUNCIL LEADERSHIP (SPOTLIGHT CARDS) -->
      <?php if (!empty($council_leaders)): ?>
      <div class="bu-lead-sec-heading">
        <span class="bu-sec-label">Executive Stewardship</span>
        <h3>Apex Academic &amp; Council Leadership</h3>
        <div class="bu-lead-sec-divider"></div>
      </div>

      <?php foreach ($council_leaders as $lead): 
          $lead_img = getLeaderImgUrl($lead['image'] ?? '');
          $lead_chips = !empty($lead['chips']) ? array_map('trim', explode(',', $lead['chips'])) : [];
          $is_vc = (stripos($lead['title'] ?? '', 'vice') !== false || stripos($lead['designation'] ?? '', 'vice') !== false);
          $pill_text = $is_vc ? 'Academic Leadership & Research Excellence' : 'Executive Stewardship & Strategic Vision';
          $desk_title = trim($lead['title'] ?: ($is_vc ? 'Vice-Chancellor' : 'Pro-Chancellor'));
      ?>
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <!-- Left Column: Portrait & Sub-Pill Badge -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <?php if (!empty($lead_img)): ?>
                <img src="<?php echo $lead_img; ?>" alt="<?php echo htmlspecialchars($lead['name']); ?>" loading="lazy" decoding="async" onerror="this.src='<?php echo URL_IMG;?>vcpic.jpg'">
              <?php else: ?>
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#F8FAFC;color:var(--bu-lead-navy);font-size:48px;"><i class="fa fa-user"></i></div>
              <?php endif; ?>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> <?php echo htmlspecialchars($pill_text); ?>
            </div>
          </div>

          <!-- Right Column: Executive Statement & Bio -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-quote-left"></i> From the <?php echo htmlspecialchars($desk_title); ?>'s Desk</span>
            <h3><?php echo htmlspecialchars($lead['name']); ?></h3>
            <span class="bu-chancellor-desig-sub"><?php echo htmlspecialchars($lead['designation']); ?></span>

            <?php if (!empty($lead['quote'])): ?>
            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “<?php echo htmlspecialchars($lead['quote']); ?>”
              </p>
            </div>
            <?php endif; ?>

            <div class="bu-chancellor-body-text">
              <?php echo $lead['about']; ?>
            </div>

            <!-- Focus Chips -->
            <?php if (!empty($lead_chips)): ?>
            <div class="bu-chancellor-chips-row">
              <?php foreach ($lead_chips as $chip): ?>
                <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> <?php echo htmlspecialchars($chip); ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>

      <!-- SECTION 4: STRATEGIC & ADMINISTRATIVE LEADERSHIP (SPOTLIGHT CARDS) -->
      <?php if (!empty($officers)): ?>
      <div class="bu-lead-sec-heading">
        <span class="bu-sec-label">University Governance</span>
        <h3>Strategic Administration &amp; Statutory Officers</h3>
        <div class="bu-lead-sec-divider"></div>
      </div>

      <?php foreach ($officers as $lead): 
          $lead_img = getLeaderImgUrl($lead['image'] ?? '');
          $lead_chips = !empty($lead['chips']) ? array_map('trim', explode(',', $lead['chips'])) : [];
          $title_clean = trim($lead['title'] ?: 'Officer');
          
          // Tailored status pills
          $pill_text = 'Statutory Administration & Governance';
          if (stripos($title_clean, 'ceo') !== false) {
              $pill_text = 'Operational Innovation & Corporate Synergy';
          } elseif (stripos($title_clean, 'registrar') !== false) {
              $pill_text = 'Statutory Compliance & Administration';
          } elseif (stripos($title_clean, 'vigilance') !== false || stripos($title_clean, 'cvo') !== false) {
              $pill_text = 'Institutional Ethics & Vigilance';
          }
      ?>
      <div class="bu-chancellor-spotlight">
        <div class="bu-chancellor-grid">
          
          <!-- Left Column: Portrait & Sub-Pill Badge -->
          <div class="bu-chancellor-left-col">
            <div class="bu-chancellor-portrait-wrap">
              <?php if (!empty($lead_img)): ?>
                <img src="<?php echo $lead_img; ?>" alt="<?php echo htmlspecialchars($lead['name']); ?>" loading="lazy" decoding="async" onerror="this.src='<?php echo URL_IMG;?>vcpic.jpg'">
              <?php else: ?>
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#F8FAFC;color:var(--bu-lead-navy);font-size:48px;"><i class="fa fa-user"></i></div>
              <?php endif; ?>
            </div>
            
            <div class="bu-chancellor-oxford-pill">
              <i class="fa fa-star"></i> <?php echo htmlspecialchars($pill_text); ?>
            </div>
          </div>

          <!-- Right Column: Executive Statement & Bio -->
          <div class="bu-chancellor-right-col">
            <span class="bu-chancellor-desk-label"><i class="fa fa-quote-left"></i> From the <?php echo htmlspecialchars($title_clean); ?>'s Desk</span>
            <h3><?php echo htmlspecialchars($lead['name']); ?></h3>
            <span class="bu-chancellor-desig-sub"><?php echo htmlspecialchars($lead['designation']); ?></span>

            <?php if (!empty($lead['quote'])): ?>
            <div class="bu-chancellor-quote-box">
              <p>
                <i class="fa fa-quote-left"></i> 
                “<?php echo htmlspecialchars($lead['quote']); ?>”
              </p>
            </div>
            <?php endif; ?>

            <div class="bu-chancellor-body-text">
              <?php echo $lead['about']; ?>
            </div>

            <!-- Focus Chips -->
            <?php if (!empty($lead_chips)): ?>
            <div class="bu-chancellor-chips-row">
              <?php foreach ($lead_chips as $chip): ?>
                <span class="bu-focus-chip"><i class="fa fa-check-circle"></i> <?php echo htmlspecialchars($chip); ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>

      <!-- SECTION 5: GOVERNANCE & STEWARDSHIP PRINCIPLES (4 PILLARS) -->
      <div class="bu-lead-sec-heading">
        <span class="bu-sec-label">Guiding Principles</span>
        <h3>Our Governance Framework</h3>
        <div class="bu-lead-sec-divider"></div>
      </div>

      <div class="bu-gov-pillars-grid">
        <div class="bu-gov-card">
          <div class="bu-gov-icon-box"><i class="fa fa-book"></i></div>
          <h4>Academic Integrity</h4>
          <p>Upholding rigorous pedagogical standards, flexible curricula, and genuine research enquiry.</p>
        </div>
        <div class="bu-gov-card">
          <div class="bu-gov-icon-box"><i class="fa fa-globe"></i></div>
          <h4>Global Benchmarks</h4>
          <p>Collaborating with premier international institutions like Academic Union Oxford for global relevance.</p>
        </div>
        <div class="bu-gov-card">
          <div class="bu-gov-icon-box"><i class="fa fa-users"></i></div>
          <h4>Inclusive Access</h4>
          <p>Extending quality education to all socio-economic strata, championing equity and justice.</p>
        </div>
        <div class="bu-gov-card">
          <div class="bu-gov-icon-box"><i class="fa fa-balance-scale"></i></div>
          <h4>Ethical Governance</h4>
          <p>Maintaining statutory compliance, transparent decision-making, and proactive student welfare.</p>
        </div>
      </div>

      <!-- SECTION 6: EXECUTIVE CONTACT STRIP -->
      <div class="bu-secretariat-strip">
        <div class="bu-secretariat-text">
          <h4>Office of the Vice-Chancellor &amp; Secretariat</h4>
          <p>For administrative inquiries, statutory collaborations, or appointments with leadership:</p>
        </div>
        <div class="bu-secretariat-contacts">
          <a href="mailto:info@bhabhauniversity.edu.in" class="bu-sec-contact-pill">
            <i class="fa fa-envelope"></i> info@bhabhauniversity.edu.in
          </a>
          <a href="tel:+917554936300" class="bu-sec-contact-pill">
            <i class="fa fa-phone"></i> +91-755-4936300
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
