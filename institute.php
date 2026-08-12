<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('institute');

if(!$aryData) {
    header("Location: ".URL_ROOT);
    exit;
}

$db->where('id', $aryData['department']);
$department = $db->getOne('department');

// Fetch sub-departments
$db->where('institute', $id);
$sub_department = $db->get('sub_department');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['institute_name']);?> - Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($aryData['institute_name']);?> at Bhabha University Bhopal. Explore programs, faculty, research labs and career opportunities.">
<?php include('inc.meta.php');?>
<style>
/* ================================================================
   INSTITUTE PAGE — Premium Navy + Gold Theme
   Matches Bhabha University homepage design system
   ================================================================ */

/* ---- HERO BANNER ---- */
.bu-inst-hero {
  background: linear-gradient(135deg, #040F4A 0%, #0A1B54 50%, #061D7C 100%);
  padding: 80px 20px 70px;
  position: relative;
  overflow: hidden;
  width: 100%;
  clear: both;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-inst-hero::before {
  content: '';
  position: absolute;
  top: -100px; right: -80px;
  width: 420px; height: 420px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.10) 0%, transparent 70%);
  pointer-events: none;
}
.bu-inst-hero::after {
  content: '';
  position: absolute;
  bottom: -80px; left: 10%;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.07) 0%, transparent 70%);
  pointer-events: none;
}
.bu-inst-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

/* Breadcrumb */
.bu-inst-breadcrumb {
  display: flex;
  align-items: center;
  gap: 0;
  list-style: none;
  margin: 0 0 24px 0;
  padding: 0 0 0 20px;
  flex-wrap: wrap;
}
.bu-inst-breadcrumb li {
  font-size: 11px;
  font-weight: 600;
  color: rgba(255,255,255,0.45);
  text-transform: uppercase;
  letter-spacing: 0.8px;
}
.bu-inst-breadcrumb li a {
  color: rgba(255,255,255,0.55);
  text-decoration: none;
  transition: color 0.2s;
}
.bu-inst-breadcrumb li a:hover { color: #FFC107; }
.bu-inst-breadcrumb li + li::before {
  content: '›';
  margin: 0 8px;
  color: rgba(255,255,255,0.25);
}
.bu-inst-breadcrumb li:last-child { color: rgba(255,255,255,0.75); }

/* Hero Content */
.bu-inst-hero-top {
  display: flex;
  align-items: flex-start;
  gap: 28px;
  padding-left: 20px;
}

.bu-inst-hero-text { flex: 1; }
.bu-inst-hero-badge {
  display: inline-block;
  background: rgba(255,193,7,0.15);
  border: 1px solid rgba(255,193,7,0.35);
  color: #FFC107;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 20px;
  margin-bottom: 12px;
}
.bu-inst-hero-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(26px, 4vw, 42px);
  font-weight: 800;
  color: #FFFFFF;
  margin: 0 0 12px 0;
  line-height: 1.2;
}
.bu-inst-hero-subtitle {
  font-size: 15px;
  color: rgba(255,255,255,0.65);
  line-height: 1.65;
  max-width: 700px;
  margin: 0;
}

/* Stats Strip */
.bu-inst-stats {
  display: flex;
  gap: 40px;
  margin-top: 36px;
  padding: 28px 0 0 20px;
  border-top: 1px solid rgba(255,255,255,0.1);
  flex-wrap: wrap;
}
.bu-inst-stat-item {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.bu-inst-stat-num {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 28px;
  font-weight: 800;
  color: #FFC107;
  line-height: 1;
}
.bu-inst-stat-label {
  font-size: 10px;
  font-weight: 700;
  color: rgba(255,255,255,0.45);
  text-transform: uppercase;
  letter-spacing: 1.5px;
}

/* ---- PAGE LAYOUT ---- */
.bu-inst-page-wrap {
  background: #F8F7F4;
  width: 100%;
  clear: both;
}
.bu-inst-layout {
  max-width: 1200px;
  margin: 0 auto;
  padding: 60px 20px 80px;
  display: grid;
  grid-template-columns: 1fr 300px;
  gap: 36px;
  align-items: start;
  box-sizing: border-box;
}

/* ---- MAIN CONTENT AREA ---- */
.bu-inst-main {}

/* Section Card */
.bu-inst-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E5E7EB;
  padding: 40px 44px;
  box-shadow: 0 4px 24px rgba(6,29,124,0.05);
  margin-bottom: 28px;
  overflow: hidden;
  position: relative;
}
.bu-inst-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 4px;
  height: 100%;
  background: linear-gradient(180deg, #FFC107 0%, #D99B00 100%);
  border-radius: 12px 0 0 12px;
}
.bu-inst-card-label {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #D99B00;
  text-transform: uppercase;
  margin-bottom: 8px;
  display: block;
}
.bu-inst-card-heading {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(22px, 2.5vw, 30px);
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 8px 0;
  line-height: 1.25;
}
.bu-inst-card-heading em {
  font-style: italic;
  color: #D99B00;
}
.bu-inst-divider {
  width: 48px;
  height: 3px;
  background: linear-gradient(90deg, #FFC107, #D99B00);
  border-radius: 2px;
  margin: 14px 0 28px 0;
}

/* CMS Content Body */
.bu-inst-body {
  font-size: 15px;
  line-height: 1.85;
  color: #4B5563;
  overflow: hidden;
}
.bu-inst-body p {
  margin-bottom: 16px;
  line-height: 1.85;
}
.bu-inst-body p:last-child { margin-bottom: 0; }
.bu-inst-body strong, .bu-inst-body b { color: #061D7C; font-weight: 700; }
.bu-inst-body h3, .bu-inst-body h4 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: #061D7C;
  font-weight: 700;
  margin: 24px 0 12px 0;
}
.bu-inst-body h3 { font-size: 19px; }
.bu-inst-body h4 {
  font-size: 16px;
  padding-left: 14px;
  border-left: 3px solid #FFC107;
}
.bu-inst-body ul {
  padding-left: 20px;
  margin: 0 0 16px 0;
}
.bu-inst-body ul li {
  padding-bottom: 8px;
  font-size: 14.5px;
  line-height: 1.7;
  color: #4B5563;
  display: list-item;
}
.bu-inst-body ul li:last-child { padding-bottom: 0; }
.bu-inst-body a { color: #061D7C; font-weight: 600; text-decoration: underline; }
.bu-inst-body a:hover { color: #D99B00; }
.bu-inst-body img {
  max-width: 100% !important;
  height: auto !important;
  border-radius: 10px !important;
  border: none !important;
  box-shadow: 0 6px 24px rgba(6,29,124,0.10) !important;
  margin: 16px 0;
}
.bu-inst-body img[style*="float: left"],
.bu-inst-body img[style*="float:left"],
.bu-inst-body img[align="left"] {
  float: left !important;
  margin: 6px 28px 20px 0 !important;
}
.bu-inst-body img[style*="float: right"],
.bu-inst-body img[style*="float:right"],
.bu-inst-body img[align="right"] {
  float: right !important;
  margin: 6px 0 20px 28px !important;
}
.bu-inst-body::after {
  content: '';
  display: table;
  clear: both;
}
.bu-inst-body table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 20px 0 !important;
  font-size: 14px !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  box-shadow: 0 2px 12px rgba(6,29,124,0.06) !important;
}
.bu-inst-body table th,
.bu-inst-body table tr:first-child td {
  background: #0A1B54 !important;
  color: #fff !important;
  font-weight: 700 !important;
  padding: 12px 16px !important;
}
.bu-inst-body table th *,
.bu-inst-body table tr:first-child td * {
  color: #fff !important;
}
.bu-inst-body table th a,
.bu-inst-body table tr:first-child td a {
  color: #FFC107 !important;
}
.bu-inst-body table td {
  padding: 10px 16px !important;
  border-bottom: 1px solid #E5E7EB !important;
  color: #374151 !important;
}
.bu-inst-body table tr:nth-child(even) { background: #F8FAFC !important; }

/* Principal Quote */
.bu-inst-quote {
  background: linear-gradient(135deg, #F8FAFF 0%, #EEF2FF 100%);
  border-left: 4px solid #FFC107;
  padding: 28px 32px;
  border-radius: 0 12px 12px 0;
  margin: 8px 0;
  position: relative;
}
.bu-inst-quote::before {
  content: '\201C';
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 80px;
  color: rgba(6,29,124,0.07);
  position: absolute;
  top: -10px; left: 16px;
  line-height: 1;
}
.bu-inst-quote p {
  font-size: 15px;
  line-height: 1.85;
  color: #374151;
  font-style: italic;
  margin: 0;
}

/* Sub-departments grid */
.bu-inst-dept-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 16px;
  margin-top: 8px;
}
.bu-inst-dept-item {
  background: #F8F9FF;
  border: 1px solid #E0E7FF;
  border-radius: 10px;
  padding: 18px 20px;
  display: flex;
  align-items: center;
  gap: 14px;
  text-decoration: none;
  transition: all 0.25s ease;
}
.bu-inst-dept-item:hover {
  background: #061D7C;
  border-color: #061D7C;
  transform: translateY(-3px);
  box-shadow: 0 10px 28px rgba(6,29,124,0.18);
  text-decoration: none;
}
.bu-inst-dept-icon {
  width: 40px; height: 40px;
  background: rgba(6,29,124,0.08);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 16px;
  color: #061D7C;
  flex-shrink: 0;
  transition: all 0.25s ease;
}
.bu-inst-dept-item:hover .bu-inst-dept-icon {
  background: rgba(255,193,7,0.2);
  color: #FFC107;
}
.bu-inst-dept-name {
  font-size: 13.5px;
  font-weight: 700;
  color: #061D7C;
  line-height: 1.4;
  transition: color 0.25s;
}
.bu-inst-dept-item:hover .bu-inst-dept-name { color: #FFFFFF; }

/* ---- SIDEBAR ---- */
.bu-inst-sidebar {}

.bu-inst-sidebar-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E5E7EB;
  padding: 28px 24px;
  box-shadow: 0 4px 20px rgba(6,29,124,0.05);
  margin-bottom: 24px;
}
.bu-inst-sidebar-heading {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 13px;
  font-weight: 800;
  color: #061D7C;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 18px;
  padding-bottom: 12px;
  border-bottom: 2px solid #FFC107;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-inst-sidebar-heading i { color: #D99B00; font-size: 14px; }

/* Quick Info */
.bu-inst-quick-info { list-style: none; padding: 0; margin: 0; }
.bu-inst-quick-info li {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid #F3F4F6;
  font-size: 13.5px;
}
.bu-inst-quick-info li:last-child { border-bottom: none; }
.bu-inst-quick-info .qi-icon {
  width: 30px; height: 30px;
  background: rgba(6,29,124,0.06);
  border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  font-size: 13px;
  color: #061D7C;
}
.bu-inst-quick-info .qi-text { flex: 1; }
.bu-inst-quick-info .qi-label {
  font-size: 10px;
  font-weight: 700;
  color: #9CA3AF;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  display: block;
  margin-bottom: -2px;
  line-height: 1;
}
.bu-inst-quick-info .qi-value {
  font-size: 13.5px;
  font-weight: 600;
  color: #111827;
}

/* CTA sidebar */
.bu-inst-cta-card {
  background: linear-gradient(135deg, #061D7C 0%, #0A1B54 100%);
  border-radius: 12px;
  padding: 30px 24px;
  text-align: center;
  margin-bottom: 24px;
  position: relative;
  overflow: hidden;
}
.bu-inst-cta-card::before {
  content: '';
  position: absolute;
  top: -40px; right: -40px;
  width: 130px; height: 130px;
  border-radius: 50%;
  background: rgba(255,193,7,0.08);
}
.bu-inst-cta-card-tag {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 2px;
  color: #FFC107;
  text-transform: uppercase;
  margin-bottom: 10px;
  display: block;
}
.bu-inst-cta-card-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px;
  font-weight: 800;
  color: #FFFFFF;
  margin-bottom: 10px;
  line-height: 1.3;
}
.bu-inst-cta-card-text {
  font-size: 13px;
  color: rgba(255,255,255,0.65);
  line-height: 1.6;
  margin-bottom: 20px;
}
.bu-inst-cta-btn {
  display: inline-block;
  background: #FFC107;
  color: #061D7C;
  font-size: 12px;
  font-weight: 800;
  padding: 11px 26px;
  border-radius: 6px;
  text-decoration: none;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
}
.bu-inst-cta-btn:hover {
  background: #D99B00;
  color: #040F4A;
  text-decoration: none;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Related links sidebar */
.bu-inst-nav-links { list-style: none; padding: 0; margin: 0; }
.bu-inst-nav-links li { border-bottom: 1px solid #F3F4F6; }
.bu-inst-nav-links li:last-child { border-bottom: none; }
.bu-inst-nav-links li a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 11px 0;
  font-size: 13.5px;
  font-weight: 600;
  color: #374151;
  text-decoration: none;
  transition: all 0.2s;
}
.bu-inst-nav-links li a i {
  color: #D99B00;
  font-size: 12px;
  width: 16px;
  text-align: center;
}
.bu-inst-nav-links li a:hover { color: #061D7C; padding-left: 4px; }

/* ---- RESPONSIVE ---- */
@media (max-width: 1024px) {
  .bu-inst-layout {
    grid-template-columns: 1fr;
  }
  .bu-inst-sidebar {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
  .bu-inst-cta-card { grid-column: 1 / -1; }
}
@media (max-width: 767px) {
  .bu-inst-hero { padding: 60px 16px 50px; }
  .bu-inst-hero-top { flex-direction: column; gap: 18px; }
  .bu-inst-stats { gap: 24px; }
  .bu-inst-layout { padding: 40px 16px 60px; gap: 24px; }
  .bu-inst-card { padding: 28px 22px; }
  .bu-inst-sidebar { display: block; }
  .bu-inst-body img[style*="float: left"],
  .bu-inst-body img[style*="float:left"],
  .bu-inst-body img[style*="float: right"],
  .bu-inst-body img[style*="float:right"],
  .bu-inst-body img[align="left"],
  .bu-inst-body img[align="right"] {
    float: none !important;
    display: block !important;
    margin: 16px auto !important;
  }
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER -->
  <?php include('inc.header.php');?>

  <!-- ============ HERO BANNER ============ -->
  <div class="bu-inst-hero">
    <div class="bu-inst-hero-inner">
      <!-- Breadcrumb -->
      <ul class="bu-inst-breadcrumb">
        <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
        <?php if(isset($department['title']) && isset($department['id'])): ?>
        <li><a href="<?php echo href('department.php','id='.$department['id']);?>"><?php echo htmlspecialchars($department['title']);?></a></li>
        <?php endif; ?>
        <li><?php echo htmlspecialchars($aryData['institute_name']);?></li>
      </ul>

      <div class="bu-inst-hero-top">

        <div class="bu-inst-hero-text">
          <span class="bu-inst-hero-badge">Bhabha University · Institute</span>
          <h1 class="bu-inst-hero-title"><?php echo htmlspecialchars($aryData['institute_name']);?></h1>
          <p class="bu-inst-hero-subtitle">Providing transformative, high-quality education and career preparation under Bhabha University, Bhopal.</p>
        </div>
      </div>

      <!-- Stats strip -->
      <div class="bu-inst-stats">
        <div class="bu-inst-stat-item">
          <span class="bu-inst-stat-num">20+</span>
          <span class="bu-inst-stat-label">Years Legacy</span>
        </div>
        <div class="bu-inst-stat-item">
          <span class="bu-inst-stat-num">500+</span>
          <span class="bu-inst-stat-label">Alumni</span>
        </div>
        <div class="bu-inst-stat-item">
          <span class="bu-inst-stat-num">95%</span>
          <span class="bu-inst-stat-label">Placement Rate</span>
        </div>
        <div class="bu-inst-stat-item">
          <span class="bu-inst-stat-num">UGC</span>
          <span class="bu-inst-stat-label">Recognized</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ============ MAIN CONTENT + SIDEBAR ============ -->
  <div class="bu-inst-page-wrap">
    <div class="bu-inst-layout">

      <!-- ---- MAIN COLUMN ---- -->
      <main class="bu-inst-main">

        <!-- About Institute -->
        <?php if(!empty($aryData['about_institute'])): ?>
        <div class="bu-inst-card">
          <span class="bu-inst-card-label">Institute Overview</span>
          <h2 class="bu-inst-card-heading"><?php echo htmlspecialchars($aryData['institute_name']);?></h2>
          <div class="bu-inst-divider"></div>
          <div class="bu-inst-body">
            <?php echo $aryData['about_institute'];?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Principal Message -->
        <?php if(!empty($aryData['principal_message'])): ?>
        <div class="bu-inst-card">
          <span class="bu-inst-card-label">Leadership</span>
          <h2 class="bu-inst-card-heading">Principal's <em>Message</em></h2>
          <div class="bu-inst-divider"></div>
          <div class="bu-inst-quote">
            <?php echo $aryData['principal_message'];?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Courses & Branches -->
        <?php if(!empty($aryData['courses']) || !empty($aryData['branches'])): ?>
        <div class="bu-inst-card">
          <span class="bu-inst-card-label">Academic Programs</span>
          <h2 class="bu-inst-card-heading">Courses &amp; <em>Branches</em></h2>
          <div class="bu-inst-divider"></div>
          <div class="bu-inst-body">
            <?php if(!empty($aryData['courses'])): ?>
              <h4>Offered Courses</h4>
              <?php echo $aryData['courses'];?>
            <?php endif; ?>
            <?php if(!empty($aryData['branches'])): ?>
              <h4 style="margin-top:24px;">Specializations &amp; Branches</h4>
              <?php echo $aryData['branches'];?>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Departments / Wings -->
        <?php if((is_array($sub_department) && count($sub_department) > 0) || !empty($aryData['departments'])): ?>
        <div class="bu-inst-card">
          <span class="bu-inst-card-label">Academic Units</span>
          <h2 class="bu-inst-card-heading">Departments &amp; <em>Wings</em></h2>
          <div class="bu-inst-divider"></div>
          <?php if(is_array($sub_department) && count($sub_department) > 0): ?>
          <div class="bu-inst-dept-grid">
            <?php foreach($sub_department as $isub): ?>
            <a href="<?php echo href('departments.php','id='.$isub['id']);?>" class="bu-inst-dept-item">
              <div class="bu-inst-dept-icon"><i class="fa fa-folder-open"></i></div>
              <span class="bu-inst-dept-name"><?php echo htmlspecialchars($isub['title']);?></span>
            </a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <?php if(!empty($aryData['departments'])): ?>
          <div class="bu-inst-body" style="margin-top:20px;">
            <?php echo $aryData['departments'];?>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Activities & Placements -->
        <?php if(!empty($aryData['activities']) || !empty($aryData['placement'])): ?>
        <div class="bu-inst-card">
          <span class="bu-inst-card-label">Student Success</span>
          <h2 class="bu-inst-card-heading">Activities &amp; <em>Placements</em></h2>
          <div class="bu-inst-divider"></div>
          <div class="bu-inst-body">
            <?php if(!empty($aryData['activities'])): ?>
              <h4>Co-Curricular Activities</h4>
              <?php echo $aryData['activities'];?>
            <?php endif; ?>
            <?php if(!empty($aryData['placement'])): ?>
              <h4 style="margin-top:24px;">Career &amp; Placements</h4>
              <?php echo $aryData['placement'];?>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>

      </main>

      <!-- ---- SIDEBAR ---- -->
      <aside class="bu-inst-sidebar">

        <!-- CTA Card -->
        <div class="bu-inst-cta-card">
          <span class="bu-inst-cta-card-tag">Admissions Open</span>
          <div class="bu-inst-cta-card-title">Apply for 2025–26</div>
          <p class="bu-inst-cta-card-text">Start your academic journey at Bhabha University. Limited seats available.</p>
          <a href="<?php echo href('online-admission.php');?>" class="bu-inst-cta-btn">Apply Now &nbsp;→</a>
        </div>

        <!-- Quick Info -->
        <div class="bu-inst-sidebar-card">
          <div class="bu-inst-sidebar-heading">
            <i class="fa fa-info-circle"></i>
            Quick Information
          </div>
          <ul class="bu-inst-quick-info">
            <li>
              <div class="qi-icon"><i class="fa fa-university"></i></div>
              <div class="qi-text">
                <span class="qi-label">University</span>
                <span class="qi-value">Bhabha University</span>
              </div>
            </li>
            <?php if(isset($department['title'])): ?>
            <li>
              <div class="qi-icon"><i class="fa fa-sitemap"></i></div>
              <div class="qi-text">
                <span class="qi-label">School / Faculty</span>
                <span class="qi-value"><?php echo htmlspecialchars($department['title']);?></span>
              </div>
            </li>
            <?php endif; ?>
            <li>
              <div class="qi-icon"><i class="fa fa-map-marker"></i></div>
              <div class="qi-text">
                <span class="qi-label">Location</span>
                <span class="qi-value">Narmadapuram Road, Bhopal</span>
              </div>
            </li>
            <li>
              <div class="qi-icon"><i class="fa fa-certificate"></i></div>
              <div class="qi-text">
                <span class="qi-label">Recognition</span>
                <span class="qi-value">UGC / AICTE Approved</span>
              </div>
            </li>
            <li>
              <div class="qi-icon"><i class="fa fa-phone"></i></div>
              <div class="qi-text">
                <span class="qi-label">Enquiry</span>
                <span class="qi-value">+91-7554-099099</span>
              </div>
            </li>
          </ul>
        </div>

        <!-- Quick Links -->
        <div class="bu-inst-sidebar-card">
          <div class="bu-inst-sidebar-heading">
            <i class="fa fa-link"></i>
            Quick Links
          </div>
          <ul class="bu-inst-nav-links">
            <li><a href="<?php echo href('online-admission.php');?>"><i class="fa fa-angle-right"></i>Online Admission</a></li>
            <li><a href="<?php echo href('fees.php');?>"><i class="fa fa-angle-right"></i>Fee Structure</a></li>
            <li><a href="<?php echo href('eligibility.php');?>"><i class="fa fa-angle-right"></i>Eligibility Criteria</a></li>
            <li><a href="<?php echo href('syllabus.php');?>"><i class="fa fa-angle-right"></i>Syllabus &amp; Curriculum</a></li>
            <li><a href="<?php echo href('placements.php');?>"><i class="fa fa-angle-right"></i>Placements</a></li>
            <li><a href="<?php echo href('contact.php');?>"><i class="fa fa-angle-right"></i>Contact Us</a></li>
          </ul>
        </div>

        <!-- Download Brochure -->
        <div class="bu-inst-sidebar-card" style="background: linear-gradient(135deg, #FFFDF0 0%, #FFF8DB 100%); border-color: #FFC107;">
          <div class="bu-inst-sidebar-heading" style="border-color: #D99B00; color: #B57D00;">
            <i class="fa fa-download"></i>
            Downloads
          </div>
          <ul class="bu-inst-nav-links">
            <li><a href="https://drive.google.com/file/d/1jhIfUzZbjtOWSCnYu77C0MM5C8U5vumt/view" target="_blank" style="color:#7A5200;"><i class="fa fa-file-pdf-o" style="color:#D99B00;"></i>Prospectus 2024–25</a></li>
            <li><a href="<?php echo href('online-admission.php');?>" style="color:#7A5200;"><i class="fa fa-wpforms" style="color:#D99B00;"></i>Admission Form</a></li>
          </ul>
        </div>

      </aside>
    </div><!-- /bu-inst-layout -->
  </div><!-- /bu-inst-page-wrap -->

  <!-- FOOTER -->
  <?php include('inc.footer.php');?>
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
