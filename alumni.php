<?php 
include_once("config.php");
$stat = array();
if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_POST['submit'])) {
    // Anti-bot honeypot check
    if (!empty($_POST['bu_website_hp'])) {
        redirect(href("alumni.php") . '#registration');
        exit;
    }

    $name          = trim($_POST['name'] ?? '');
    $enrollment_no = trim($_POST['enrollment_no'] ?? '');
    $course        = trim($_POST['course'] ?? '');
    $passing_year  = trim($_POST['passing_year'] ?? '');
    $mobile        = trim($_POST['mobile'] ?? '');
    $email         = trim($_POST['email'] ?? '');

    if (empty($name) || empty($enrollment_no) || empty($course) || empty($passing_year) || empty($mobile) || empty($email)) {
        $stat['error'] = 'Please fill in all mandatory fields marked with an asterisk (*).';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stat['error'] = 'Please enter a valid email address.';
    } else {
        $data = array(
            "name"           => $name,
            "enrollment_no"  => $enrollment_no,
            "fname"          => trim($_POST['fname'] ?? ''),
            "mname"          => trim($_POST['mname'] ?? ''),
            "nick_name"      => trim($_POST['nick_name'] ?? ''),
            "gender"         => trim($_POST['gender'] ?? ''),
            "college"        => trim($_POST['college'] ?? ''),
            "course"         => $course,
            "branch"         => trim($_POST['branch'] ?? ''),
            "admission_year" => trim($_POST['admission_year'] ?? ''),
            "passing_year"   => $passing_year,
            "further_study"  => trim($_POST['further_study'] ?? ''),
            "dob"            => trim($_POST['dob'] ?? ''),
            "mobile"         => $mobile,
            "whatsapp"       => trim($_POST['whatsapp'] ?? ''),
            "email"          => $email,
            "address"        => trim($_POST['address'] ?? ''),
            "perm_address"   => trim($_POST['perm_address'] ?? ''),
            "occupation"     => trim($_POST['occupation'] ?? ''),
            "company"        => trim($_POST['company'] ?? ''),
            "job_title"      => trim($_POST['job_title'] ?? ''),
            "city"           => trim($_POST['city'] ?? ''),
            "marital"        => trim($_POST['marital'] ?? ''),
            "dom"            => trim($_POST['dom'] ?? ''),
            "linkedin"       => trim($_POST['linkedin'] ?? ''),
            "facebook"       => trim($_POST['facebook'] ?? ''),
            "twitter"        => trim($_POST['twitter'] ?? '')
        );
        $id = $db->insert('alumni', $data);
        if ($id) {
            unset($_POST);
            unset($_SESSION['form']);
            $_SESSION["success"] = 'Thank you! Your Alumni Registration has been submitted successfully.';
            redirect(href("alumni.php") . '#registration');
        } else {
            $stat['error'] = 'Failed to submit registration: ' . ($db->getLastError() ?: 'Please try again.');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alumni Portal &amp; Network - Bhabha University Bhopal</title>
<meta name="description" content="Official Bhabha University Alumni Association (BUAA) portal. Connect with alumni association, registration, membership perks, annual events, notable achievements, and student mentorship.">
<meta name="keywords" content="Bhabha University Alumni, BUAA, Alumni Association, Alumni Registration, Alumni Achievements, Alumni Networking Bhopal">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   BU ALUMNI LANDING PAGE STYLES
   Colors: Navy #0A1B54, Gold #FFC107, Slate #64748B
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #122870;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-gray-bg: #F8FAFC;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

.bu-alumni-landing-wrap {
  background: #FAF9F6;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 0 0 90px;
  clear: both;
  width: 100%;
  box-sizing: border-box;
}

/* Explicit Hero Banner & Sticky Nav layout */
.bu-inner-hero {
  display: block !important;
  float: none !important;
  clear: both !important;
  position: relative !important;
  z-index: 5 !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

/* 1. STICKY IN-PAGE SUB-NAVIGATION BAR */
.bu-alumni-sticky-nav {
  display: block !important;
  clear: both !important;
  float: none !important;
  position: sticky;
  top: 70px;
  z-index: 998;
  width: 100%;
  box-sizing: border-box;
  background: #ffffff;
  border-bottom: 2px solid #E2E8F0;
  box-shadow: 0 4px 18px rgba(10, 27, 84, 0.08);
  transition: all 0.3s ease;
}
.bu-alumni-nav-container {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 15px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  overflow-x: auto;
  white-space: nowrap;
  scrollbar-width: none;
}
.bu-alumni-nav-container::-webkit-scrollbar {
  display: none;
}
.bu-alumni-nav-links {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 10px 0;
}
.bu-alumni-nav-item {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 9px 15px;
  border-radius: 30px;
  font-size: 13px;
  font-weight: 700;
  color: var(--bu-navy);
  text-decoration: none;
  background: #F1F5F9;
  transition: all 0.2s ease;
}
.bu-alumni-nav-item i {
  color: var(--bu-gold-dark);
  font-size: 13.5px;
}
.bu-alumni-nav-item:hover,
.bu-alumni-nav-item.active {
  background: var(--bu-navy);
  color: #ffffff;
  text-decoration: none;
}
.bu-alumni-nav-item:hover i,
.bu-alumni-nav-item.active i {
  color: var(--bu-gold);
}
.bu-nav-btn-reg {
  background: linear-gradient(135deg, #FFC107 0%, #D99B00 100%) !important;
  color: #0A1B54 !important;
  font-weight: 800 !important;
  box-shadow: 0 4px 12px rgba(217, 155, 0, 0.35);
}
.bu-nav-btn-reg i {
  color: #0A1B54 !important;
}
.bu-nav-btn-reg:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(217, 155, 0, 0.45);
}

/* SECTION COMMON STYLES */
.bu-alumni-section {
  max-width: 1240px;
  margin: 0 auto;
  padding: 55px 20px 0;
  scroll-margin-top: 135px;
}
.bu-alumni-sec-header {
  text-align: center;
  margin-bottom: 35px;
}
.bu-alumni-sec-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #FFF8E1;
  border: 1px solid #FFE082;
  color: #8A5D00;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  padding: 4px 14px;
  border-radius: 20px;
  margin-bottom: 8px;
}
.bu-alumni-sec-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(24px, 2.5vw, 34px);
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 10px;
  line-height: 1.25;
}
.bu-alumni-sec-title em {
  color: var(--bu-gold-dark);
  font-style: italic;
}
.bu-alumni-sec-desc {
  font-size: 14px;
  color: var(--bu-text-muted);
  max-width: 720px;
  margin: 0 auto;
  line-height: 1.6;
}

/* =========================================================
   1. ASSOCIATION SECTION
   ========================================================= */
.bu-assoc-hero-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-top: 4px solid var(--bu-gold);
  border-radius: 16px;
  padding: 35px;
  box-shadow: 0 10px 30px rgba(10,27,84,0.06);
  margin-bottom: 30px;
}
.bu-assoc-top-grid {
  display: grid;
  grid-template-columns: 100px 1fr;
  gap: 25px;
  align-items: center;
  margin-bottom: 25px;
  padding-bottom: 25px;
  border-bottom: 1px solid #F1F5F9;
}
.bu-assoc-emblem {
  width: 95px;
  height: 95px;
  border-radius: 50%;
  background: #F8FAFC;
  border: 2px solid #E2E8F0;
  padding: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 14px rgba(10,27,84,0.08);
}
.bu-assoc-emblem img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
.bu-assoc-intro h3 {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 6px;
}
.bu-assoc-intro p {
  font-size: 14px;
  color: var(--bu-text-muted);
  line-height: 1.65;
  margin: 0;
}
.bu-assoc-pillars-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
  margin-top: 25px;
}
.bu-assoc-pillar-card {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 20px 16px;
  text-align: center;
  transition: all 0.25s ease;
}
.bu-assoc-pillar-card:hover {
  background: #ffffff;
  border-color: var(--bu-gold);
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(10,27,84,0.08);
}
.bu-assoc-pillar-icon {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  background: #FFF8E1;
  color: #D99B00;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 12px;
}
.bu-assoc-pillar-card h4 {
  font-size: 14.5px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 6px;
}
.bu-assoc-pillar-card p {
  font-size: 12px;
  color: var(--bu-text-muted);
  line-height: 1.5;
  margin: 0;
}

/* =========================================================
   2. MEMBERSHIP SECTION
   ========================================================= */
.bu-member-tiers-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-bottom: 35px;
}
.bu-member-tier-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  padding: 30px 24px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 6px 20px rgba(10,27,84,0.05);
  transition: all 0.3s ease;
  position: relative;
}
.bu-member-tier-card.featured {
  border: 2px solid var(--bu-gold);
  box-shadow: 0 12px 30px rgba(217, 155, 0, 0.16);
  transform: translateY(-4px);
}
.bu-member-tier-badge {
  position: absolute;
  top: -12px;
  right: 20px;
  background: var(--bu-gold);
  color: var(--bu-navy);
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 4px 12px;
  border-radius: 20px;
}
.bu-tier-title {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 8px;
}
.bu-tier-desc {
  font-size: 13px;
  color: var(--bu-text-muted);
  line-height: 1.5;
  margin-bottom: 18px;
}
.bu-tier-features {
  list-style: none;
  padding: 0;
  margin: 0 0 25px;
}
.bu-tier-features li {
  font-size: 13px;
  color: var(--bu-text-dark);
  padding: 8px 0;
  border-bottom: 1px dashed #F1F5F9;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-tier-features li i {
  color: #10B981;
  font-size: 14px;
  flex-shrink: 0;
}
.bu-member-perks-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 28px;
}
.bu-perks-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-top: 18px;
}
.bu-perk-item {
  display: flex;
  align-items: flex-start;
  gap: 14px;
}
.bu-perk-icon {
  width: 42px;
  height: 42px;
  border-radius: 10px;
  background: #ffffff;
  border: 1px solid #E2E8F0;
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.bu-perk-text h5 {
  font-size: 13.5px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 3px;
}
.bu-perk-text p {
  font-size: 12px;
  color: var(--bu-text-muted);
  margin: 0;
  line-height: 1.45;
}

/* =========================================================
   3. EVENTS & NETWORKING SECTION
   ========================================================= */
.bu-events-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-bottom: 30px;
}
.bu-event-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  display: flex;
  flex-direction: column;
}
.bu-event-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(10,27,84,0.12);
  border-color: var(--bu-gold);
}
.bu-event-top {
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  color: #ffffff;
  padding: 20px 22px;
  position: relative;
}
.bu-event-tag {
  display: inline-block;
  background: rgba(255, 193, 7, 0.25);
  color: #FFC107;
  font-size: 10.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 3px 10px;
  border-radius: 20px;
  margin-bottom: 10px;
}
.bu-event-title {
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  font-weight: 800;
  color: #ffffff;
  margin: 0;
  line-height: 1.35;
}
.bu-event-body {
  padding: 22px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.bu-event-meta {
  list-style: none;
  padding: 0;
  margin: 0 0 14px;
}
.bu-event-meta li {
  font-size: 12.5px;
  color: #64748B;
  margin-bottom: 6px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-event-meta li i {
  color: var(--bu-gold-dark);
  width: 14px;
  text-align: center;
}
.bu-event-desc {
  font-size: 13px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin: 0;
}

/* =========================================================
   4. ACHIEVEMENTS & HALL OF FAME
   ========================================================= */
.bu-alumni-stats-strip {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 25px;
}
.bu-alumni-stat-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 30px;
  padding: 6px 14px;
  font-size: 11.5px;
  font-weight: 700;
  color: var(--bu-navy);
  box-shadow: 0 2px 6px rgba(10,27,84,0.03);
}
.bu-alumni-stat-pill i {
  color: var(--bu-gold-dark);
}
.bu-alumni-stories-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 22px;
}
.bu-story-card {
  width: 100%;
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(10,27,84,0.06);
  display: flex;
  flex-direction: column;
  transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
  cursor: pointer;
  position: relative;
}
.bu-story-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 36px rgba(10,27,84,0.14);
  border-color: var(--bu-gold);
}
.bu-story-img-box {
  width: 100%;
  height: 250px;
  background: #F8FAFC;
  overflow: hidden;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 6px;
  box-sizing: border-box;
  border-bottom: 1px solid #F1F5F9;
}
.bu-story-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  transition: transform 0.35s ease;
  display: block;
}
.bu-story-card:hover .bu-story-img {
  transform: scale(1.03);
}
.bu-story-overlay-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  background: rgba(10, 27, 84, 0.88);
  color: #ffffff;
  border-radius: 20px;
  padding: 3px 8px;
  font-size: 10px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 4px;
  backdrop-filter: blur(4px);
  opacity: 0.9;
  transition: all 0.2s ease;
}
.bu-story-card:hover .bu-story-overlay-badge {
  background: var(--bu-gold-dark);
  color: #0A1B54;
  opacity: 1;
}
.bu-story-body {
  padding: 14px 15px 16px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  flex: 1;
  gap: 6px;
}
.bu-story-name {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 16px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0;
  line-height: 1.3;
}
.bu-story-course {
  font-size: 12px;
  font-weight: 600;
  color: #64748B;
  line-height: 1.45;
}
.bu-story-pkg-pill {
  margin-top: 4px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: linear-gradient(135deg, rgba(255, 193, 7, 0.16) 0%, rgba(217, 155, 0, 0.12) 100%);
  color: #8A5D00;
  border: 1px solid rgba(217, 155, 0, 0.35);
  font-weight: 800;
  font-size: 11px;
  padding: 4px 10px;
  border-radius: 6px;
  width: fit-content;
}
.bu-story-pkg-pill i {
  color: #D99B00;
}

/* =========================================================
   5. ALUMNI–STUDENT INTERACTION SECTION
   ========================================================= */
.bu-interact-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 30px;
}
.bu-interact-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 24px 20px;
  box-shadow: 0 4px 16px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  text-align: center;
}
.bu-interact-card:hover {
  transform: translateY(-4px);
  border-color: var(--bu-navy);
  box-shadow: 0 10px 25px rgba(10,27,84,0.1);
}
.bu-interact-icon {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  color: var(--bu-gold);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 14px;
}
.bu-interact-card h4 {
  font-size: 15px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 8px;
}
.bu-interact-card p {
  font-size: 12.5px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin: 0;
}
.bu-mentor-cta-banner {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  color: #ffffff;
  border-radius: 16px;
  padding: 32px 35px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  box-shadow: 0 12px 32px rgba(10,27,84,0.2);
}
.bu-mentor-cta-text h3 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 6px;
}
.bu-mentor-cta-text p {
  font-size: 13.5px;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
  line-height: 1.5;
}
.bu-btn-mentor {
  background: var(--bu-gold);
  color: var(--bu-navy);
  font-weight: 800;
  font-size: 13.5px;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 12px 28px;
  border-radius: 30px;
  text-decoration: none;
  white-space: nowrap;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s ease;
  box-shadow: 0 4px 14px rgba(255, 193, 7, 0.4);
}
.bu-btn-mentor:hover {
  background: #ffffff;
  color: var(--bu-navy);
  text-decoration: none;
  transform: translateY(-2px);
}

/* =========================================================
   6. REGISTRATION FORM SECTION
   ========================================================= */
.bu-alumni-form-box {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-top: 4px solid var(--bu-gold);
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.04);
}
.bu-form-sec-heading {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 15px;
  font-weight: 800;
  color: var(--bu-navy);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding-bottom: 12px;
  border-bottom: 2px solid #F1F5F9;
  margin: 32px 0 20px;
}
.bu-form-sec-heading:first-of-type {
  margin-top: 0;
}
.bu-form-sec-heading i {
  color: var(--bu-gold-dark);
  font-size: 17px;
}
.bu-grid-2col {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}
.bu-grid-3col {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.bu-form-group {
  margin-bottom: 18px;
}
.bu-form-group label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: var(--bu-navy);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-form-group label span.req {
  color: #DC2626;
  margin-left: 2px;
}

.bu-alumni-landing-wrap input.bu-input,
.bu-alumni-landing-wrap select.bu-input,
.bu-alumni-landing-wrap textarea.bu-input,
.bu-input {
  width: 100% !important;
  height: 48px !important;
  padding: 10px 14px !important;
  border: 1.5px solid #94A3B8 !important;
  border-radius: 6px !important;
  font-size: 14px !important;
  color: #1E293B !important;
  background-color: #FFFFFF !important;
  transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
  box-sizing: border-box !important;
  outline: none !important;
  display: block !important;
}
.bu-alumni-landing-wrap textarea.bu-input {
  height: 90px !important;
  resize: vertical !important;
}
.bu-alumni-landing-wrap select.bu-input {
  cursor: pointer !important;
}
.bu-alumni-landing-wrap input.bu-input:focus,
.bu-alumni-landing-wrap select.bu-input:focus,
.bu-alumni-landing-wrap textarea.bu-input:focus {
  border-color: #0A1B54 !important;
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.12) !important;
}
.bu-input::placeholder {
  color: #94A3B8 !important;
  font-size: 13.5px !important;
}

.bu-btn-submit {
  background: var(--bu-navy);
  color: var(--bu-gold);
  font-weight: 800;
  font-size: 15px;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 15px 42px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.25s ease;
  box-shadow: 0 4px 18px rgba(10,27,84,0.25);
  display: inline-flex;
  align-items: center;
  gap: 10px;
}
.bu-btn-submit:hover {
  background: var(--bu-navy-light);
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(10,27,84,0.35);
}

.bu-alert-success {
  background: #ECFDF5;
  border: 1px solid #6EE7B7;
  color: #065F46;
  padding: 16px 20px;
  border-radius: 8px;
  font-size: 14.5px;
  font-weight: 600;
  margin-bottom: 25px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-alert-error {
  background: #FEF2F2;
  border: 1px solid #FCA5A5;
  color: #991B1B;
  padding: 16px 20px;
  border-radius: 8px;
  font-size: 14.5px;
  font-weight: 600;
  margin-bottom: 25px;
  display: flex;
  align-items: center;
  gap: 10px;
}

/* LIGHTBOX MODAL */
.bu-alumni-modal-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(2, 6, 23, 0.9);
  backdrop-filter: blur(8px);
  z-index: 999999;
  align-items: center;
  justify-content: center;
  padding: 16px;
  box-sizing: border-box;
}
.bu-alumni-modal-overlay.active {
  display: flex;
}
.bu-alumni-modal-content {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  max-width: 92vw;
  max-height: 92vh;
  animation: buModalPop 0.22s ease-out;
}
@keyframes buModalPop {
  from { opacity: 0; transform: scale(0.94); }
  to { opacity: 1; transform: scale(1); }
}
.bu-alumni-modal-close {
  position: absolute;
  top: -16px;
  right: -16px;
  background: #EF4444;
  color: #ffffff;
  border: 2px solid #ffffff;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  font-size: 22px;
  line-height: 1;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
  transition: transform 0.2s ease, background 0.2s ease;
  box-shadow: 0 4px 14px rgba(0,0,0,0.35);
}
.bu-alumni-modal-close:hover {
  background: #DC2626;
  transform: scale(1.1);
}
.bu-alumni-modal-img {
  max-width: 90vw;
  max-height: 88vh;
  width: auto;
  height: auto;
  object-fit: contain;
  border-radius: 10px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
  border: 2px solid rgba(255, 255, 255, 0.2);
  display: block;
}

/* RESPONSIVE QUERIES */
@media (max-width: 1024px) {
  .bu-alumni-stories-grid { grid-template-columns: repeat(3, 1fr); }
  .bu-assoc-pillars-grid { grid-template-columns: repeat(2, 1fr); }
  .bu-member-tiers-grid { grid-template-columns: 1fr; }
  .bu-events-grid { grid-template-columns: 1fr; }
  .bu-interact-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .bu-alumni-sticky-nav { top: 60px; }
  .bu-assoc-top-grid { grid-template-columns: 1fr; text-align: center; }
  .bu-assoc-emblem { margin: 0 auto; }
  .bu-alumni-stories-grid { grid-template-columns: repeat(2, 1fr); }
  .bu-grid-2col, .bu-grid-3col { grid-template-columns: 1fr; }
  .bu-alumni-form-box { padding: 25px 20px; }
  .bu-perks-grid { grid-template-columns: 1fr; }
  .bu-mentor-cta-banner { flex-direction: column; text-align: center; }
}
@media (max-width: 540px) {
  .bu-alumni-stories-grid { grid-template-columns: 1fr; }
  .bu-assoc-pillars-grid { grid-template-columns: 1fr; }
  .bu-interact-grid { grid-template-columns: 1fr; }
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
  $page_title    = 'Alumni <em>Portal &amp; Network</em>';
  $page_subtitle = 'Bhabha University Alumni Association (BUAA) — Reconnect with your alma mater, celebrate achievements, mentor future leaders, and join a global community of 20,000+ graduates.';
  $page_icon     = 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Alumni Portal', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <!-- STICKY IN-PAGE SECTION NAVIGATION -->
  <nav class="bu-alumni-sticky-nav" id="buAlumniNav">
    <div class="bu-alumni-nav-container">
      <div class="bu-alumni-nav-links">
        <a href="#association" class="bu-alumni-nav-item active"><i class="fa fa-university"></i> Alumni Association</a>
        <a href="#membership" class="bu-alumni-nav-item"><i class="fa fa-id-card"></i> Membership</a>
        <a href="#events" class="bu-alumni-nav-item"><i class="fa fa-calendar"></i> Events &amp; Networking</a>
        <a href="#achievements" class="bu-alumni-nav-item"><i class="fa fa-trophy"></i> Achievements</a>
        <a href="#interaction" class="bu-alumni-nav-item"><i class="fa fa-comments"></i> Student Interaction</a>
      </div>
      <div>
        <a href="#registration" class="bu-alumni-nav-item bu-nav-btn-reg"><i class="fa fa-pencil-square-o"></i> Register Now</a>
      </div>
    </div>
  </nav>

  <div class="bu-alumni-landing-wrap">

    <!-- =========================================================
         SECTION 1: ALUMNI ASSOCIATION
         ========================================================= -->
    <section id="association" class="bu-alumni-section">
      <div class="bu-alumni-sec-header">
        <span class="bu-alumni-sec-badge"><i class="fa fa-university"></i> Official Body</span>
        <h2 class="bu-alumni-sec-title">Bhabha University <em>Alumni Association (BUAA)</em></h2>
        <p class="bu-alumni-sec-desc">
          Uniting generations of engineers, pharmacists, managers, doctors, and innovators across the world to maintain lifelong camaraderie with their alma mater.
        </p>
      </div>

      <div class="bu-assoc-hero-card">
        <div class="bu-assoc-top-grid">
          <div class="bu-assoc-emblem">
            <img src="<?php echo URL_IMG;?>Bhabha university logo.png" alt="BU Emblem" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
          </div>
          <div class="bu-assoc-intro">
            <h3>Welcome to BUAA Global Fraternity</h3>
            <p>
              The Bhabha University Alumni Association (BUAA) serves as the vibrant link between the university and its global network of 20,000+ alumni. Every student who graduates from any faculty of Bhabha University automatically becomes an honored lifelong member. BUAA is dedicated to advancing personal career trajectories, promoting collaborative research, fostering student mentorship, and honoring outstanding institutional contributions worldwide.
            </p>
          </div>
        </div>

        <div class="bu-assoc-pillars-grid">
          <div class="bu-assoc-pillar-card">
            <div class="bu-assoc-pillar-icon"><i class="fa fa-globe"></i></div>
            <h4>Global Connectivity</h4>
            <p>Connecting graduates across 15+ countries through active regional chapters and digital meetups.</p>
          </div>
          <div class="bu-assoc-pillar-card">
            <div class="bu-assoc-pillar-icon"><i class="fa fa-handshake-o"></i></div>
            <h4>Career Acceleration</h4>
            <p>Exclusive corporate referral pathways, executive job openings, and startup incubation support.</p>
          </div>
          <div class="bu-assoc-pillar-card">
            <div class="bu-assoc-pillar-icon"><i class="fa fa-heartbeat"></i></div>
            <h4>Student Mentorship</h4>
            <p>Directly guiding final-year students with real-world industry feedback and placement readiness.</p>
          </div>
          <div class="bu-assoc-pillar-card">
            <div class="bu-assoc-pillar-icon"><i class="fa fa-trophy"></i></div>
            <h4>Excellence &amp; Awards</h4>
            <p>Annual Distinguished Alumnus Awards celebrating extraordinary achievements and leadership.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================================================
         SECTION 2: ALUMNI MEMBERSHIP
         ========================================================= -->
    <section id="membership" class="bu-alumni-section">
      <div class="bu-alumni-sec-header">
        <span class="bu-alumni-sec-badge"><i class="fa fa-id-card"></i> Privileges &amp; Benefits</span>
        <h2 class="bu-alumni-sec-title">Alumni <em>Membership &amp; Privileges</em></h2>
        <p class="bu-alumni-sec-desc">
          Choose your involvement level in the university network and unlock exclusive campus benefits, lifelong digital resources, and corporate privileges.
        </p>
      </div>

      <div class="bu-member-tiers-grid">
        <div class="bu-member-tier-card">
          <div>
            <h3 class="bu-tier-title">General Alumni</h3>
            <p class="bu-tier-desc">Complimentary membership for all verified Bhabha University graduates upon degree completion.</p>
            <ul class="bu-tier-features">
              <li><i class="fa fa-check-circle"></i> Official Alumni Portal Directory Profile</li>
              <li><i class="fa fa-check-circle"></i> Quarterly E-Newsletter &amp; Campus Updates</li>
              <li><i class="fa fa-check-circle"></i> Open Invites to Annual Campus Reunions</li>
              <li><i class="fa fa-check-circle"></i> Participation in Online Webinars &amp; Talks</li>
            </ul>
          </div>
          <a href="#registration" class="bu-alumni-nav-item" style="justify-content:center;background:#0A1B54;color:#fff;">Verify &amp; Register Free</a>
        </div>

        <div class="bu-member-tier-card featured">
          <span class="bu-member-tier-badge">Most Popular</span>
          <div>
            <h3 class="bu-tier-title">Lifetime Privilege Member</h3>
            <p class="bu-tier-desc">For alumni seeking closer integration, institutional access, and executive networking perks.</p>
            <ul class="bu-tier-features">
              <li><i class="fa fa-check-circle"></i> Official BUAA Digital &amp; Physical ID Card</li>
              <li><i class="fa fa-check-circle"></i> Lifetime Central Library &amp; E-Journal Access</li>
              <li><i class="fa fa-check-circle"></i> Campus Sports Complex &amp; Gym Privileges</li>
              <li><i class="fa fa-check-circle"></i> Priority Guest House Booking on Campus</li>
              <li><i class="fa fa-check-circle"></i> Special Discounts on MDPs &amp; Conferences</li>
              <li><i class="fa fa-check-circle"></i> VIP Seating at Annual University Convocations</li>
            </ul>
          </div>
          <a href="#registration" class="bu-alumni-nav-item bu-nav-btn-reg" style="justify-content:center;">Apply for Lifetime Membership</a>
        </div>

        <div class="bu-member-tier-card">
          <div>
            <h3 class="bu-tier-title">Global Chapter Patron</h3>
            <p class="bu-tier-desc">For senior executives, entrepreneurs, and international alumni driving chapter leadership.</p>
            <ul class="bu-tier-features">
              <li><i class="fa fa-check-circle"></i> Everything in Lifetime Membership</li>
              <li><i class="fa fa-check-circle"></i> Regional Chapter Head / Executive Voting Right</li>
              <li><i class="fa fa-check-circle"></i> Direct Talent Hiring Priority from Campus</li>
              <li><i class="fa fa-check-circle"></i> Guest Speaker &amp; Board of Studies Panel Invites</li>
              <li><i class="fa fa-check-circle"></i> Mentorship Hub Recognition on University Wall</li>
            </ul>
          </div>
          <a href="#registration" class="bu-alumni-nav-item" style="justify-content:center;background:#0A1B54;color:#fff;">Connect with BUAA Cell</a>
        </div>
      </div>

      <div class="bu-member-perks-box">
        <h4 style="font-family:'Playfair Display',serif;font-size:18px;font-weight:800;color:var(--bu-navy);margin:0 0 4px;">Exclusive Alumni Privileges Overview</h4>
        <p style="font-size:13px;color:var(--bu-text-muted);margin:0;">Take advantage of these facilities whenever you visit Bhopal or reconnect online:</p>
        <div class="bu-perks-grid">
          <div class="bu-perk-item">
            <div class="bu-perk-icon"><i class="fa fa-book"></i></div>
            <div class="bu-perk-text">
              <h5>Central Digital Library</h5>
              <p>Borrowing privileges and access to 10,000+ indexed e-journals and databases.</p>
            </div>
          </div>
          <div class="bu-perk-item">
            <div class="bu-perk-icon"><i class="fa fa-building"></i></div>
            <div class="bu-perk-text">
              <h5>Campus Guest House</h5>
              <p>Subsidized executive stay for alumni and immediate family during campus visits.</p>
            </div>
          </div>
          <div class="bu-perk-item">
            <div class="bu-perk-icon"><i class="fa fa-futbol-o"></i></div>
            <div class="bu-perk-text">
              <h5>Sports &amp; Fitness Complex</h5>
              <p>Complimentary access to cricket grounds, gymnasium suites, and badminton courts.</p>
            </div>
          </div>
          <div class="bu-perk-item">
            <div class="bu-perk-icon"><i class="fa fa-briefcase"></i></div>
            <div class="bu-perk-text">
              <h5>T&amp;P Lateral Hiring Support</h5>
              <p>Exclusive mid-career and senior opportunities circulated through alumni network.</p>
            </div>
          </div>
          <div class="bu-perk-item">
            <div class="bu-perk-icon"><i class="fa fa-lightbulb-o"></i></div>
            <div class="bu-perk-text">
              <h5>Incubation &amp; EDC Cell</h5>
              <p>Co-working space, seed funding guidance, and patenting assistance for alumni startups.</p>
            </div>
          </div>
          <div class="bu-perk-item">
            <div class="bu-perk-icon"><i class="fa fa-id-card-o"></i></div>
            <div class="bu-perk-text">
              <h5>BU Alumni Smart Pass</h5>
              <p>Seamless contactless security entry across the 32-acre university campus.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================================================
         SECTION 3: ALUMNI EVENTS & NETWORKING
         ========================================================= -->
    <section id="events" class="bu-alumni-section">
      <div class="bu-alumni-sec-header">
        <span class="bu-alumni-sec-badge"><i class="fa fa-calendar"></i> Reunions &amp; Meetups</span>
        <h2 class="bu-alumni-sec-title">Alumni Events &amp; <em>Networking Hub</em></h2>
        <p class="bu-alumni-sec-desc">
          From grand campus reunions to metropolitan mixers and virtual masterclasses, experience the thrill of reconnecting with old classmates and faculty.
        </p>
      </div>

      <div class="bu-events-grid">
        <div class="bu-event-card">
          <div class="bu-event-top">
            <span class="bu-event-tag">Signature Reunion</span>
            <h3 class="bu-event-title">"Smriti &amp; Milan" Annual Grand Alumni Meet</h3>
          </div>
          <div class="bu-event-body">
            <div>
              <ul class="bu-event-meta">
                <li><i class="fa fa-calendar-check-o"></i> Every Winter / December</li>
                <li><i class="fa fa-map-marker"></i> Main Convention Arena, BU Campus</li>
                <li><i class="fa fa-users"></i> All Batches &amp; Faculties Welcome</li>
              </ul>
              <p class="bu-event-desc">
                The flagship gala featuring nostalgic batch walk-throughs, campus tours, cultural night, distinguished alumnus awards ceremony, and networking dinners.
              </p>
            </div>
          </div>
        </div>

        <div class="bu-event-card">
          <div class="bu-event-top">
            <span class="bu-event-tag">Metro Chapter</span>
            <h3 class="bu-event-title">Corporate Alumni Mixers (Delhi, Indore &amp; Bengaluru)</h3>
          </div>
          <div class="bu-event-body">
            <div>
              <ul class="bu-event-meta">
                <li><i class="fa fa-calendar-check-o"></i> Quarterly Roundtables</li>
                <li><i class="fa fa-map-marker"></i> Major Metro Tech Hubs</li>
                <li><i class="fa fa-briefcase"></i> IT, Pharma &amp; Management Sectors</li>
              </ul>
              <p class="bu-event-desc">
                Informal evening meetups organized across prime industrial clusters where alumni collaborate on client projects, startup hiring, and business partnerships.
              </p>
            </div>
          </div>
        </div>

        <div class="bu-event-card">
          <div class="bu-event-top">
            <span class="bu-event-tag">Knowledge Exchange</span>
            <h3 class="bu-event-title">"Career Crossroads" Virtual Masterclass Series</h3>
          </div>
          <div class="bu-event-body">
            <div>
              <ul class="bu-event-meta">
                <li><i class="fa fa-calendar-check-o"></i> Monthly Virtual Sessions</li>
                <li><i class="fa fa-video-camera"></i> Live on Google Meet / Zoom</li>
                <li><i class="fa fa-graduation-cap"></i> Interactive Q&amp;A for Students</li>
              </ul>
              <p class="bu-event-desc">
                High-impact webinars where industry veteran alumni share insights on AI disruptions, competitive exam preparation (UPSC/GATE), and study-abroad pathways.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================================================
         SECTION 4: ALUMNI ACHIEVEMENTS & HALL OF FAME
         ========================================================= -->
    <section id="achievements" class="bu-alumni-section">
      <div class="bu-alumni-sec-header">
        <span class="bu-alumni-sec-badge"><i class="fa fa-trophy"></i> Pride of Bhabha</span>
        <h2 class="bu-alumni-sec-title">Distinguished Alumni &amp; <em>Star Achievers</em></h2>
        <p class="bu-alumni-sec-desc">
          Celebrating landmark international salary packages, prestigious UPSC Engineering Services selections, top government administrative roles, and premier IIT admissions.
        </p>
      </div>

      <div class="bu-alumni-stats-strip">
        <span class="bu-alumni-stat-pill"><i class="fa fa-globe"></i> <strong>20,000+</strong> Global Alumni Network</span>
        <span class="bu-alumni-stat-pill"><i class="fa fa-trophy"></i> <strong>₹60.0 LPA</strong> Top Global Package</span>
        <span class="bu-alumni-stat-pill"><i class="fa fa-star"></i> <strong>AIR 68</strong> UPSC Indian Engineering Services</span>
        <span class="bu-alumni-stat-pill"><i class="fa fa-institution"></i> <strong>Deputy Director</strong> DTE Madhya Pradesh</span>
        <span class="bu-alumni-stat-pill"><i class="fa fa-graduation-cap"></i> <strong>IIT Kanpur</strong> M.Tech Selection</span>
        <span class="bu-alumni-stat-pill"><i class="fa fa-building-o"></i> <strong>500+</strong> Recruiting Partners</span>
      </div>

      <div class="bu-alumni-stories-grid">
        <?php
        // Fetch achievers from DB with graceful static fallback
        $alumni_stories = [];
        try {
            $db->where('status', 1);
            $db->orderBy('orders', 'ASC');
            $db->orderBy('id', 'ASC');
            $alumni_stories = $db->get('alumni_achievers');
        } catch (\Throwable $e) {}

        if (empty($alumni_stories)) {
            $alumni_stories = [
              [
                'name'        => 'Mr. Anurag Kumar',
                'degree'      => 'M.Tech (Thermal Science Engineering) — Batch 2025',
                'badge'       => '₹60.0 LPA Package',
                'highlight'   => 'China Petroleum Pipeline Engineering Co. Ltd. (CPP)',
                'role'        => 'Mechanical Engineer - Lead',
                'description' => 'Secured an international milestone package of 60.0 LPA at China Petroleum Pipeline Engineering Co. Ltd.',
                'image'       => 'media/alumni_anurag_kumar_cpp_60lpa.jpg',
              ],
              [
                'name'        => 'Harikesh Singh',
                'degree'      => 'M.Tech – VLSI Design (Batch 2023–2025)',
                'badge'       => 'AIR Rank 68 in IES 2025',
                'highlight'   => 'Indian Engineering Services (IES / ESE 2025)',
                'role'        => 'UPSC Engineering Officer',
                'description' => 'Secured an All India Rank 68 in the prestigious Indian Engineering Services 2025.',
                'image'       => 'media/alumni_harikesh_singh_ies_rank68.jpg',
              ],
              [
                'name'        => 'Mr. Kamlesh Kumar',
                'degree'      => 'Engineering Alumnus — Bhabha University',
                'badge'       => 'UPSC IES Officer',
                'highlight'   => 'Indian Engineering Services (IES / ESE)',
                'role'        => 'UPSC Engineering Officer',
                'description' => 'Cleared the prestigious UPSC Indian Engineering Services examination.',
                'image'       => 'media/alumni_kamlesh_kumar_ies.jpg',
              ],
              [
                'name'        => 'Mr. Anshuman Rajesh Singh',
                'degree'      => 'Engineering Alumnus — Bhabha University',
                'badge'       => 'UPSC IES 2023 Officer',
                'highlight'   => 'Indian Engineering Services (IES / ESE 2023)',
                'role'        => 'UPSC Engineering Officer',
                'description' => 'Successfully cracked the prestigious UPSC Indian Engineering Services (IES 2023) examination.',
                'image'       => 'media/alumni_anshuman_singh_ies.jpg',
              ],
              [
                'name'        => 'Ms. Nidhi Shukla',
                'degree'      => 'Distinguished Alumna — Bhabha University',
                'badge'       => 'Deputy Director, DTE MP',
                'highlight'   => 'Directorate of Technical Education (DTE), Govt. of M.P.',
                'role'        => 'Deputy Director',
                'description' => 'Selected through MPPSC and appointed as Deputy Director at Directorate of Technical Education (DTE).',
                'image'       => 'media/alumni_nidhi_shukla_dte.jpg',
              ],
              [
                'name'        => 'Shubham Kumar Srivastava',
                'degree'      => 'M.Tech (Power Systems - Electrical)',
                'badge'       => '₹12.0 LPA Package',
                'highlight'   => 'National High Speed Rail Corporation Ltd. (NHSRCL)',
                'role'        => 'Junior Technical Manager (Electrical)',
                'description' => 'Selected as Junior Technical Manager for India’s landmark High-Speed Bullet Train project.',
                'image'       => 'media/alumni_shubham_srivastava_nhsrcl.jpg',
              ],
              [
                'name'        => 'Vikash Chandra',
                'degree'      => 'B.Pharm — Bhabha Pharmacy Research Institute (BPRI)',
                'badge'       => 'IIT Kanpur Selection',
                'highlight'   => 'Indian Institute of Technology (IIT) Kanpur',
                'role'        => 'M.Tech (Biomedical Engineering)',
                'description' => 'Achieved direct selection at premier institution IIT Kanpur.',
                'image'       => 'media/alumni_vikash_chandra_iit_kanpur.jpg',
              ],
              [
                'name'        => 'Mr. Rakesh Kumar Roy',
                'degree'      => 'B.Tech – Civil Engineering (Batch 2025)',
                'badge'       => '₹7.44 LPA Package',
                'highlight'   => 'Dhariwal Buildtech Limited (DBL)',
                'role'        => 'Material Engineer',
                'description' => 'Selected as Material Engineer at Dhariwal Buildtech Limited (DBL).',
                'image'       => 'media/alumni_rakesh_roy_dhariwal.jpg',
              ]
            ];
        }

        foreach ($alumni_stories as $story):
            $rawImg = $story['image'] ?? '';
            if (empty($rawImg)) {
                $imgUrl = URL_ROOT . 'upload/media/alumni_anurag_kumar_cpp_60lpa.jpg';
            } elseif (strpos($rawImg, 'upload/') === 0 || strpos($rawImg, 'http') === 0) {
                $imgUrl = (strpos($rawImg, 'http') === 0) ? $rawImg : URL_ROOT . $rawImg;
            } elseif (strpos($rawImg, 'media/') === 0) {
                $imgUrl = URL_ROOT . 'upload/' . $rawImg;
            } else {
                $imgUrl = URL_ROOT . 'upload/alumni/' . $rawImg;
            }
        ?>
        <div class="bu-story-card" onclick="openAlumniPoster('<?php echo $imgUrl;?>', '<?php echo htmlspecialchars($story['name']);?>')">
          <div class="bu-story-img-box">
            <img src="<?php echo $imgUrl;?>" alt="<?php echo htmlspecialchars($story['name']);?>" class="bu-story-img" loading="lazy">
            <span class="bu-story-overlay-badge"><i class="fa fa-expand"></i> Click to View</span>
          </div>
          <div class="bu-story-body">
            <h3 class="bu-story-name"><?php echo htmlspecialchars($story['name']);?></h3>
            <div class="bu-story-course"><?php echo htmlspecialchars($story['degree'] ?? '');?></div>
            <span class="bu-story-pkg-pill"><i class="fa fa-trophy"></i> <?php echo htmlspecialchars($story['badge'] ?? '');?></span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- =========================================================
         SECTION 5: ALUMNI–STUDENT INTERACTION
         ========================================================= -->
    <section id="interaction" class="bu-alumni-section">
      <div class="bu-alumni-sec-header">
        <span class="bu-alumni-sec-badge"><i class="fa fa-comments"></i> Mentorship &amp; Synergy</span>
        <h2 class="bu-alumni-sec-title">Alumni–Student <em>Interaction Hub</em></h2>
        <p class="bu-alumni-sec-desc">
          Empowering the next generation of Bhabha scholars through 1-on-1 mentorship, live project referrals, practical mock interviews, and industry guest lectures.
        </p>
      </div>

      <div class="bu-interact-grid">
        <div class="bu-interact-card">
          <div class="bu-interact-icon"><i class="fa fa-user-plus"></i></div>
          <h4>1-on-1 Mentorship</h4>
          <p>Pairing final-year undergraduates with experienced alumni for 6 months of career guidance and project vetting.</p>
        </div>
        <div class="bu-interact-card">
          <div class="bu-interact-icon"><i class="fa fa-microphone"></i></div>
          <h4>Guest Lectures &amp; Talks</h4>
          <p>Inviting senior alumni back to classrooms to deliver hands-on masterclasses on emerging tech and workplace practices.</p>
        </div>
        <div class="bu-interact-card">
          <div class="bu-interact-icon"><i class="fa fa-file-text-o"></i></div>
          <h4>Resume &amp; Mock Clinics</h4>
          <p>Conducting real-world HR interview simulations and portfolio reviews right before campus recruitment drives.</p>
        </div>
        <div class="bu-interact-card">
          <div class="bu-interact-icon"><i class="fa fa-handshake-o"></i></div>
          <h4>Internship Referrals</h4>
          <p>Connecting meritorious students with exclusive summer internships and pre-placement offers (PPOs) at alumni firms.</p>
        </div>
      </div>

      <div class="bu-mentor-cta-banner">
        <div class="bu-mentor-cta-text">
          <h3>Want to Give Back to Your Alma Mater?</h3>
          <p>Join the Bhabha University Alumni Mentorship Circle today. Dedicate just 2 hours a month to guide a promising junior student toward corporate success.</p>
        </div>
        <a href="#registration" class="bu-btn-mentor">
          <i class="fa fa-paper-plane"></i> Join as Alumni Mentor
        </a>
      </div>
    </section>

    <!-- =========================================================
         SECTION 6: ALUMNI REGISTRATION FORM
         ========================================================= -->
    <section id="registration" class="bu-alumni-section">
      <div class="bu-alumni-sec-header">
        <span class="bu-alumni-sec-badge"><i class="fa fa-pencil-square-o"></i> Join Directory</span>
        <h2 class="bu-alumni-sec-title">Alumni <em>Registration &amp; Enrollment</em></h2>
        <p class="bu-alumni-sec-desc">
          Please complete the official registration form below to update your university alumni records, stay informed about chapter reunions, and activate your membership privileges.
        </p>
      </div>

      <div class="bu-alumni-form-box">
        <!-- Status Messages -->
        <?php if (!empty($stat['success'])): ?>
          <div class="bu-alert-success">
            <i class="fa fa-check-circle" style="font-size:20px;color:#10B981;"></i>
            <span><?php echo $stat['success']; ?></span>
          </div>
        <?php endif; ?>
        <?php if (!empty($stat['error'])): ?>
          <div class="bu-alert-error">
            <i class="fa fa-exclamation-triangle" style="font-size:20px;color:#EF4444;"></i>
            <span><?php echo $stat['error']; ?></span>
          </div>
        <?php endif; ?>

        <form action="#registration" method="post">
          <div style="display:none !important; visibility:hidden; opacity:0; position:absolute; left:-9999px;">
            <input type="text" name="bu_website_hp" tabindex="-1" autocomplete="off">
          </div>

          <!-- 1. PERSONAL INFORMATION -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-user"></i> 1. Personal Information
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Full Name <span class="req">*</span></label>
              <input type="text" name="name" class="bu-input" placeholder="e.g. Rahul Sharma" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Enrollment No. <span class="req">*</span></label>
              <input type="text" name="enrollment_no" class="bu-input" placeholder="e.g. BU2020CS101" required value="<?php echo htmlspecialchars($_POST['enrollment_no'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Nick Name (During College)</label>
              <input type="text" name="nick_name" class="bu-input" placeholder="Campus nickname (optional)" value="<?php echo htmlspecialchars($_POST['nick_name'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Father's Name</label>
              <input type="text" name="fname" class="bu-input" placeholder="Father's full name" value="<?php echo htmlspecialchars($_POST['fname'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Mother's Name</label>
              <input type="text" name="mname" class="bu-input" placeholder="Mother's full name" value="<?php echo htmlspecialchars($_POST['mname'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Gender <span class="req">*</span></label>
              <select name="gender" class="bu-input no-selectric" required>
                <option value="">Select Gender</option>
                <option value="Male" <?php echo (($_POST['gender'] ?? '')=='Male')?'selected':''; ?>>Male</option>
                <option value="Female" <?php echo (($_POST['gender'] ?? '')=='Female')?'selected':''; ?>>Female</option>
                <option value="Other" <?php echo (($_POST['gender'] ?? '')=='Other')?'selected':''; ?>>Other</option>
              </select>
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Date of Birth</label>
              <input type="date" name="dob" class="bu-input" value="<?php echo htmlspecialchars($_POST['dob'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Marital Status</label>
              <select name="marital" class="bu-input no-selectric">
                <option value="">Select Status</option>
                <option value="Unmarried" <?php echo (($_POST['marital'] ?? '')=='Unmarried')?'selected':''; ?>>Unmarried</option>
                <option value="Married" <?php echo (($_POST['marital'] ?? '')=='Married')?'selected':''; ?>>Married</option>
              </select>
            </div>
            <div class="bu-form-group">
              <label>If Married, Date of Marriage</label>
              <input type="date" name="dom" class="bu-input" value="<?php echo htmlspecialchars($_POST['dom'] ?? ''); ?>">
            </div>
          </div>

          <!-- 2. ACADEMIC DETAILS -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-graduation-cap"></i> 2. Academic Records at Bhabha University
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>College / Institute</label>
              <input type="text" name="college" class="bu-input" placeholder="e.g. Faculty of Engineering / Pharmacy" value="<?php echo htmlspecialchars($_POST['college'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Course <span class="req">*</span></label>
              <input type="text" name="course" class="bu-input" placeholder="e.g. B.Tech / B.Pharm / MBA / MCA" required value="<?php echo htmlspecialchars($_POST['course'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Branch / Specialization</label>
              <input type="text" name="branch" class="bu-input" placeholder="e.g. Computer Science / Pharmaceutics" value="<?php echo htmlspecialchars($_POST['branch'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Admission Year</label>
              <input type="text" name="admission_year" class="bu-input" placeholder="e.g. 2019" value="<?php echo htmlspecialchars($_POST['admission_year'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Year of Graduation / Passing <span class="req">*</span></label>
              <input type="text" name="passing_year" class="bu-input" placeholder="e.g. 2023" required value="<?php echo htmlspecialchars($_POST['passing_year'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Further Studies (If any)</label>
              <input type="text" name="further_study" class="bu-input" placeholder="e.g. M.Tech / PhD / MS Abroad" value="<?php echo htmlspecialchars($_POST['further_study'] ?? ''); ?>">
            </div>
          </div>

          <!-- 3. CONTACT & CONNECTIVITY -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-phone"></i> 3. Contact &amp; Communication Details
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Mobile Number <span class="req">*</span></label>
              <input type="tel" name="mobile" class="bu-input" placeholder="10-digit primary mobile" required value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>WhatsApp Number <span class="req">*</span></label>
              <input type="tel" name="whatsapp" class="bu-input" placeholder="WhatsApp contact" required value="<?php echo htmlspecialchars($_POST['whatsapp'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Email Address <span class="req">*</span></label>
              <input type="email" name="email" class="bu-input" placeholder="e.g. name@example.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-2col">
            <div class="bu-form-group">
              <label>Present / Contact Address</label>
              <input type="text" name="address" class="bu-input" placeholder="House/Flat, Street, Area" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Permanent Address</label>
              <input type="text" name="perm_address" class="bu-input" placeholder="Permanent Residence Address" value="<?php echo htmlspecialchars($_POST['perm_address'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Current City / Location</label>
              <input type="text" name="city" class="bu-input" placeholder="e.g. Bhopal / Bengaluru / Delhi" value="<?php echo htmlspecialchars($_POST['city'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>LinkedIn Profile URL</label>
              <input type="url" name="linkedin" class="bu-input" placeholder="https://linkedin.com/in/username" value="<?php echo htmlspecialchars($_POST['linkedin'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Twitter / X Profile Link</label>
              <input type="text" name="twitter" class="bu-input" placeholder="@handle or profile link" value="<?php echo htmlspecialchars($_POST['twitter'] ?? ''); ?>">
            </div>
          </div>

          <!-- 4. CAREER & PROFESSIONAL PROFILE -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-briefcase"></i> 4. Current Career &amp; Professional Details
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Current Occupation</label>
              <select name="occupation" class="bu-input no-selectric">
                <option value="">Select Occupation</option>
                <option value="Private Sector" <?php echo (($_POST['occupation'] ?? '')=='Private Sector')?'selected':''; ?>>Private Sector / Corporate</option>
                <option value="Government / PSU" <?php echo (($_POST['occupation'] ?? '')=='Government / PSU')?'selected':''; ?>>Government / PSU</option>
                <option value="Self Employed / Freelancer" <?php echo (($_POST['occupation'] ?? '')=='Self Employed / Freelancer')?'selected':''; ?>>Self Employed / Freelancer</option>
                <option value="Entrepreneur / Business" <?php echo (($_POST['occupation'] ?? '')=='Entrepreneur / Business')?'selected':''; ?>>Entrepreneur / Business Owner</option>
                <option value="Higher Studies / Research" <?php echo (($_POST['occupation'] ?? '')=='Higher Studies / Research')?'selected':''; ?>>Higher Studies / Research</option>
              </select>
            </div>
            <div class="bu-form-group">
              <label>Name of Organization &amp; Address</label>
              <input type="text" name="company" class="bu-input" placeholder="e.g. Infosys, TCS, Sun Pharma, DTE" value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Job Title / Designation</label>
              <input type="text" name="job_title" class="bu-input" placeholder="e.g. Senior Software Engineer" value="<?php echo htmlspecialchars($_POST['job_title'] ?? ''); ?>">
            </div>
          </div>

          <!-- SUBMIT BUTTON -->
          <div style="margin-top:35px;text-align:center;">
            <button type="submit" name="submit" class="bu-btn-submit">
              Submit Alumni Membership Application <i class="fa fa-paper-plane"></i>
            </button>
          </div>

        </form>
      </div>
    </section>

  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- Alumni Poster Lightbox Modal -->
<div id="buAlumniModal" class="bu-alumni-modal-overlay" onclick="closeAlumniPoster(event)">
  <div class="bu-alumni-modal-content" onclick="event.stopPropagation()">
    <button type="button" class="bu-alumni-modal-close" onclick="closeAlumniPoster(event)" title="Close">&times;</button>
    <img id="buAlumniModalImg" src="" alt="Alumni Achievement Poster" class="bu-alumni-modal-img">
  </div>
</div>

<script>
function openAlumniPoster(imgSrc, name) {
  var modal = document.getElementById('buAlumniModal');
  var modalImg = document.getElementById('buAlumniModalImg');
  if (modal && modalImg) {
    modalImg.src = imgSrc;
    modalImg.alt = name || 'Alumni Achievement';
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}
function closeAlumniPoster(e) {
  var modal = document.getElementById('buAlumniModal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeAlumniPoster();
  }
});

// Smooth Active Navigation Highlighting on Scroll
document.addEventListener('DOMContentLoaded', function() {
  var navLinks = document.querySelectorAll('.bu-alumni-nav-links .bu-alumni-nav-item');
  var sections = document.querySelectorAll('.bu-alumni-section');

  function updateActiveNav() {
    var scrollPos = window.scrollY + 160;
    sections.forEach(function(section) {
      var top = section.offsetTop;
      var height = section.offsetHeight;
      var id = section.getAttribute('id');
      if (scrollPos >= top && scrollPos < top + height) {
        navLinks.forEach(function(link) {
          if (link.getAttribute('href') === '#' + id) {
            link.classList.add('active');
          } else {
            link.classList.remove('active');
          }
        });
      }
    });
  }

  window.addEventListener('scroll', updateActiveNav, { passive: true });
});
</script>

<!-- Scripts -->
<?php include('inc.footer.js.php');?>
</body>
</html>
