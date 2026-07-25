<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>About Us - Bhabha University Bhopal | Best University in MP</title>
<meta name="description" content="Learn about Bhabha University Bhopal – our history, vision, mission, leadership, accreditations and campus. One of the best private universities in Madhya Pradesh, established in 2004.">
<meta name="keywords" content="About Bhabha University, Bhabha University history, best university bhopal, bhabha university overview, chancellor bhabha university">
<?php include('inc.meta.php');?>

<style>
/* ================================================
   ABOUT US PAGE - BHABHA UNIVERSITY
   Theme: Navy #0A1B54  Gold #FFC107
   Fonts: Playfair Display + Plus Jakarta Sans
   ================================================ */

/* ---- PAGE HERO BANNER ---- */
.bu-about-hero {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 55%, #061D7C 100%);
  padding: 90px 20px 70px;
  position: relative;
  overflow: hidden;
  width: 100%;
  float: left;
  clear: both;
}
.bu-about-hero::before {
  content: '';
  position: absolute;
  top: -60px; right: -60px;
  width: 400px; height: 400px;
  border-radius: 50%;
  background: rgba(255,193,7,0.06);
  pointer-events: none;
}
.bu-about-hero::after {
  content: '';
  position: absolute;
  bottom: -80px; left: -80px;
  width: 500px; height: 500px;
  border-radius: 50%;
  background: rgba(255,193,7,0.04);
  pointer-events: none;
}
.bu-about-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}
.bu-about-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  list-style: none;
  margin: 0 0 22px 0;
  padding: 0;
}
.bu-about-breadcrumb li { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 0.8px; }
.bu-about-breadcrumb li a { color: rgba(255,255,255,0.55); text-decoration: none; transition: color 0.2s; }
.bu-about-breadcrumb li a:hover { color: #FFC107; }
.bu-about-breadcrumb li::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.25); }
.bu-about-breadcrumb li:last-child::after { display: none; }
.bu-about-breadcrumb li:last-child { color: #FFC107; }
.bu-about-hero-label {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 3px;
  color: #FFC107;
  text-transform: uppercase;
  margin-bottom: 16px;
  display: block;
}
.bu-about-hero-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(38px, 5vw, 64px);
  font-weight: 800;
  color: #ffffff;
  line-height: 1.1;
  margin: 0 0 20px 0;
}
.bu-about-hero-title em {
  font-style: italic;
  color: #FFC107;
}
.bu-about-hero-desc {
  font-size: 16px;
  line-height: 1.75;
  color: rgba(255,255,255,0.72);
  max-width: 620px;
  margin: 0 0 36px 0;
}
.bu-about-hero-stats {
  display: flex;
  gap: 48px;
  flex-wrap: wrap;
  padding-top: 16px;
  border-top: 1px solid rgba(255,255,255,0.12);
}
.bu-hero-stat-item { display: flex; flex-direction: column; gap: 4px; }
.bu-hero-stat-num {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 36px;
  font-weight: 800;
  color: #FFC107;
  line-height: 1;
}
.bu-hero-stat-lbl {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.55);
  text-transform: uppercase;
}

/* ---- SECTION WRAPPER ---- */
.bu-about-section {
  width: 100%;
  float: left;
  clear: both;
  padding: 80px 20px;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-about-section-alt { background: #FAF9F6; }
.bu-about-section-dark { background: linear-gradient(135deg, #051235, #0A1B54); }
.bu-about-container { max-width: 1200px; margin: 0 auto; }
.bu-section-label {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #D99B00;
  text-transform: uppercase;
  margin-bottom: 14px;
  display: block;
}
.bu-section-label-light {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #FFC107;
  text-transform: uppercase;
  margin-bottom: 14px;
  display: block;
}
.bu-section-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(30px, 3.5vw, 44px);
  font-weight: 800;
  color: #061D7C;
  line-height: 1.15;
  margin: 0 0 18px 0;
}
.bu-section-title em { font-style: italic; color: #D99B00; font-weight: 700; }
.bu-section-title-light {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(30px, 3.5vw, 44px);
  font-weight: 800;
  color: #fff;
  line-height: 1.15;
  margin: 0 0 18px 0;
}
.bu-section-title-light em { font-style: italic; color: #FFC107; }
.bu-section-text {
  font-size: 15px;
  line-height: 1.8;
  color: #4B5563;
  margin: 0;
}
.bu-section-divider {
  width: 60px;
  height: 3px;
  background: #FFC107;
  border-radius: 2px;
  margin: 0 0 28px 0;
}

/* ---- OVERVIEW SECTION (2-col) ---- */
.bu-overview-grid {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: 70px;
  align-items: center;
}
.bu-overview-img-wrap {
  position: relative;
}
.bu-overview-img {
  width: 100%;
  height: 480px;
  object-fit: cover;
  border-radius: 6px;
  display: block;
  box-shadow: 0 20px 50px rgba(6,29,124,0.12);
}
.bu-overview-badge {
  position: absolute;
  bottom: -24px;
  left: -24px;
  background: #0A1B54;
  color: #FFC107;
  padding: 20px 24px;
  border-radius: 4px;
  box-shadow: 0 12px 30px rgba(10,27,84,0.25);
}
.bu-overview-badge-num {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 40px;
  font-weight: 800;
  display: block;
  line-height: 1;
  margin-bottom: 4px;
}
.bu-overview-badge-lbl {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: rgba(255,255,255,0.7);
  display: block;
}
.bu-overview-text-wrap { display: flex; flex-direction: column; gap: 0; }
.bu-overview-points {
  list-style: none;
  padding: 0;
  margin: 28px 0 0 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.bu-overview-points li {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  font-size: 14px;
  line-height: 1.6;
  color: #374151;
}
.bu-overview-points li .bu-pt-icon {
  flex-shrink: 0;
  width: 22px;
  height: 22px;
  background: rgba(255,193,7,0.15);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #D99B00;
  font-size: 10px;
  margin-top: 1px;
}
.bu-overview-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: 32px;
  background: #0A1B54;
  color: #fff;
  font-size: 12px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 13px 28px;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.25s;
  border: 2px solid #0A1B54;
  align-self: flex-start;
}
.bu-overview-link:hover {
  background: #FFC107;
  color: #0A1B54;
  border-color: #FFC107;
  text-decoration: none;
}

/* ---- TIMELINE SECTION ---- */
.bu-timeline {
  position: relative;
  padding: 20px 0;
}
.bu-timeline::before {
  content: '';
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  top: 0; bottom: 0;
  width: 2px;
  background: linear-gradient(to bottom, #FFC107, rgba(255,193,7,0.1));
}
.bu-timeline-item {
  display: flex;
  align-items: flex-start;
  gap: 30px;
  margin-bottom: 48px;
  position: relative;
}
.bu-timeline-item:nth-child(even) { flex-direction: row-reverse; }
.bu-timeline-item-content {
  flex: 1;
  background: #fff;
  border-radius: 6px;
  padding: 28px 32px;
  box-shadow: 0 4px 24px rgba(6,29,124,0.07);
  border: 1px solid #E5E7EB;
  position: relative;
}
.bu-timeline-item-content::before {
  content: '';
  position: absolute;
  top: 22px;
  width: 12px; height: 12px;
  background: #FFC107;
  border-radius: 50%;
}
.bu-timeline-item:nth-child(odd) .bu-timeline-item-content::before { right: -36px; }
.bu-timeline-item:nth-child(even) .bu-timeline-item-content::before { left: -36px; }
.bu-timeline-year {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 13px;
  font-weight: 700;
  color: #FFC107;
  background: #0A1B54;
  padding: 4px 12px;
  border-radius: 20px;
  display: inline-block;
  margin-bottom: 10px;
  letter-spacing: 1px;
}
.bu-timeline-item-content h4 {
  font-size: 17px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 8px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-timeline-item-content p {
  font-size: 13.5px;
  line-height: 1.65;
  color: #6B7280;
  margin: 0;
}
.bu-timeline-spacer { flex: 1; }

/* ---- VISION MISSION SECTION ---- */
.bu-vm-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  margin-top: 48px;
}
.bu-vm-card {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 8px;
  padding: 36px 32px;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
}
.bu-vm-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}
.bu-vm-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 4px; height: 100%;
  background: #FFC107;
}
.bu-vm-icon {
  font-size: 28px;
  color: #FFC107;
  margin-bottom: 18px;
}
.bu-vm-card h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 22px;
  font-weight: 700;
  color: #fff;
  margin: 0 0 14px 0;
}
.bu-vm-card p {
  font-size: 14px;
  line-height: 1.75;
  color: rgba(255,255,255,0.72);
  margin: 0;
}

/* ---- STATS STRIP ---- */
.bu-stats-strip {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0;
  background: #0A1B54;
  border-radius: 8px;
  overflow: hidden;
  margin-top: 60px;
  box-shadow: 0 20px 50px rgba(6,29,124,0.15);
}
.bu-stat-cell {
  padding: 36px 24px;
  text-align: center;
  border-right: 1px solid rgba(255,255,255,0.08);
  transition: background 0.25s;
}
.bu-stat-cell:last-child { border-right: none; }
.bu-stat-cell:hover { background: rgba(255,193,7,0.08); }
.bu-stat-number {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 42px;
  font-weight: 800;
  color: #FFC107;
  display: block;
  line-height: 1;
  margin-bottom: 8px;
}
.bu-stat-label {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.6);
  text-transform: uppercase;
}

/* ---- SUB-PAGES QUICK LINKS ---- */
.bu-subpages-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-top: 48px;
}
.bu-subpage-card {
  background: #fff;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  padding: 30px 26px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  gap: 12px;
  transition: all 0.28s;
  position: relative;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(6,29,124,0.05);
}
.bu-subpage-card::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0;
  width: 100%; height: 3px;
  background: #FFC107;
  transform: scaleX(0);
  transition: transform 0.28s;
}
.bu-subpage-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(6,29,124,0.12); text-decoration: none; }
.bu-subpage-card:hover::after { transform: scaleX(1); }
.bu-subpage-icon {
  width: 48px; height: 48px;
  background: rgba(10,27,84,0.07);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
  color: #0A1B54;
  transition: all 0.28s;
}
.bu-subpage-card:hover .bu-subpage-icon { background: #0A1B54; color: #FFC107; }
.bu-subpage-card h4 {
  font-size: 16px;
  font-weight: 700;
  color: #061D7C;
  margin: 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.3;
}
.bu-subpage-card p {
  font-size: 13px;
  line-height: 1.6;
  color: #6B7280;
  margin: 0;
}
.bu-subpage-arrow {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  color: #D99B00;
  margin-top: 4px;
}
.bu-subpage-arrow i { font-size: 10px; transition: transform 0.2s; }
.bu-subpage-card:hover .bu-subpage-arrow i { transform: translateX(4px); }

/* ---- ACCREDITATIONS ---- */
.bu-accred-grid {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  margin-top: 40px;
  justify-content: center;
}
.bu-accred-badge {
  background: #fff;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  padding: 20px 28px;
  text-align: center;
  min-width: 120px;
  box-shadow: 0 2px 12px rgba(6,29,124,0.06);
  transition: all 0.25s;
}
.bu-accred-badge:hover { box-shadow: 0 12px 30px rgba(6,29,124,0.12); transform: translateY(-3px); }
.bu-accred-badge-name {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 22px;
  font-weight: 800;
  color: #061D7C;
  display: block;
  line-height: 1;
  margin-bottom: 6px;
}
.bu-accred-badge-desc {
  font-size: 9.5px;
  font-weight: 800;
  letter-spacing: 1.5px;
  color: #9CA3AF;
  text-transform: uppercase;
}

/* ---- CTA ---- */
.bu-about-cta {
  width: 100%;
  float: left;
  clear: both;
  padding: 80px 20px;
  background: linear-gradient(135deg, #061D7C, #0A1B54);
  text-align: center;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-about-cta h2 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(28px, 3.5vw, 42px);
  font-weight: 800;
  color: #fff;
  margin: 0 0 16px 0;
}
.bu-about-cta h2 em { font-style: italic; color: #FFC107; }
.bu-about-cta p {
  font-size: 16px;
  color: rgba(255,255,255,0.72);
  margin: 0 0 36px 0;
  line-height: 1.7;
  max-width: 560px;
  margin-left: auto; margin-right: auto;
}
.bu-cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.bu-cta-btn-primary {
  background: #FFC107;
  color: #0A1B54;
  font-size: 13px;
  font-weight: 800;
  padding: 14px 34px;
  border-radius: 4px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s;
  display: inline-block;
}
.bu-cta-btn-primary:hover { background: #D99B00; color: #0A1B54; text-decoration: none; transform: translateY(-2px); }
.bu-cta-btn-secondary {
  background: transparent;
  color: #fff;
  font-size: 13px;
  font-weight: 800;
  padding: 14px 34px;
  border-radius: 4px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 2px solid rgba(255,255,255,0.4);
  transition: all 0.25s;
  display: inline-block;
}
.bu-cta-btn-secondary:hover { border-color: #FFC107; color: #FFC107; text-decoration: none; }

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-about-hero { padding: 60px 16px 50px; }
  .bu-about-hero-stats { gap: 28px; }
  .bu-overview-grid { grid-template-columns: 1fr; gap: 50px; }
  .bu-overview-img { height: 340px; }
  .bu-overview-badge { left: 0; bottom: -16px; }
  .bu-timeline::before { left: 20px; transform: none; }
  .bu-timeline-item, .bu-timeline-item:nth-child(even) { flex-direction: column; padding-left: 52px; }
  .bu-timeline-item-content::before { left: -44px !important; right: auto !important; }
  .bu-timeline-spacer { display: none; }
  .bu-vm-grid { grid-template-columns: 1fr; }
  .bu-stats-strip { grid-template-columns: repeat(2, 1fr); }
  .bu-subpages-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 575px) {
  .bu-about-section { padding: 50px 16px; }
  .bu-about-hero-stats { flex-direction: column; gap: 18px; }
  .bu-stats-strip { grid-template-columns: 1fr 1fr; }
  .bu-subpages-grid { grid-template-columns: 1fr; }
  .bu-accred-grid { gap: 12px; }
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->

  <!-- =================== PAGE HERO =================== -->
  <section class="bu-about-hero">
    <div class="bu-about-hero-inner">
      <ul class="bu-about-breadcrumb">
        <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
        <li>About Us</li>
      </ul>
      <span class="bu-about-hero-label">About Bhabha University</span>
      <h1 class="bu-about-hero-title">
        Shaping futures since<br><em>2004.</em>
      </h1>
      <p class="bu-about-hero-desc">
        Bhabha University, Bhopal stands as one of Central India's most respected private universities — 
        committed to academic excellence, research innovation, and producing leaders who make a difference.
      </p>
      <div class="bu-about-hero-stats">
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">20+</span>
          <span class="bu-hero-stat-lbl">Years of Excellence</span>
        </div>
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">25,000+</span>
          <span class="bu-hero-stat-lbl">Alumni Network</span>
        </div>
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">150</span>
          <span class="bu-hero-stat-lbl">Acre Green Campus</span>
        </div>
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">50+</span>
          <span class="bu-hero-stat-lbl">Programmes Offered</span>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== UNIVERSITY OVERVIEW =================== -->
  <section class="bu-about-section">
    <div class="bu-about-container">
      <div class="bu-overview-grid">
        <!-- Image Side -->
        <div class="bu-overview-img-wrap">
          <img src="https://www.bhabhauniversity.edu.in/images/campus.jpg" 
               alt="Bhabha University Campus, Bhopal" 
               class="bu-overview-img"
               onerror="this.style.background='linear-gradient(135deg,#0A1B54,#061D7C)'; this.style.minHeight='480px';">
          <div class="bu-overview-badge">
            <span class="bu-overview-badge-num">2004</span>
            <span class="bu-overview-badge-lbl">Established</span>
          </div>
        </div>
        <!-- Text Side -->
        <div class="bu-overview-text-wrap">
          <span class="bu-section-label">University Overview</span>
          <h2 class="bu-section-title">A university built<br>for <em>real-world impact.</em></h2>
          <div class="bu-section-divider"></div>
          <p class="bu-section-text">
            Bhabha University, located on NH-12 Narmadapuram Road, Bhopal, Madhya Pradesh, 
            was established by the Ayushmati Education and Social Society. Over two decades, 
            it has grown into a vibrant multi-disciplinary university offering programmes in 
            Engineering, Pharmacy, Dental Sciences, Nursing, Management, Law, Agriculture, 
            Science, Commerce, Education, and Hotel Management.
          </p>
          <ul class="bu-overview-points">
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Approved by AICTE, PCI, DCI, BCI, NCTE &amp; recognized by UGC under 2(f) &amp; 12(B)
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              NAAC Accredited &mdash; committed to quality education and continuous improvement
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Wi-Fi enabled 150-acre green campus with modern labs, library and hostels
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Strong Industry Connect with 500+ companies visiting for campus placements
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Active research culture with 120+ labs, patents and international collaborations
            </li>
          </ul>
          <a href="<?php echo href('page.php','id=20');?>" class="bu-overview-link">
            Read Full Overview <i class="fa fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== STATS STRIP =================== -->
  <div class="bu-stats-strip" style="max-width:100%; border-radius:0; margin:0;">
    <div class="bu-stat-cell">
      <span class="bu-stat-number">98%</span>
      <span class="bu-stat-label">Placement Rate</span>
    </div>
    <div class="bu-stat-cell">
      <span class="bu-stat-number">120+</span>
      <span class="bu-stat-label">Research Labs</span>
    </div>
    <div class="bu-stat-cell">
      <span class="bu-stat-number">60+</span>
      <span class="bu-stat-label">Global MoUs</span>
    </div>
    <div class="bu-stat-cell">
      <span class="bu-stat-number">₹52L</span>
      <span class="bu-stat-label">Highest Package</span>
    </div>
  </div>

  <!-- =================== VISION & MISSION =================== -->
  <section class="bu-about-section bu-about-section-dark">
    <div class="bu-about-container">
      <div style="text-align:center; margin-bottom:10px;">
        <span class="bu-section-label-light">Our Purpose</span>
        <h2 class="bu-section-title-light">Vision & <em>Mission</em></h2>
      </div>
      <div class="bu-vm-grid">
        <div class="bu-vm-card">
          <div class="bu-vm-icon"><i class="fa fa-eye"></i></div>
          <h3>Our Vision</h3>
          <p>
            To be a globally recognised university that provides transformative, high-quality education across 
            disciplines — producing innovative graduates and leaders who contribute to society, drive 
            sustainability, and shape the future of India and the world.
          </p>
        </div>
        <div class="bu-vm-card">
          <div class="bu-vm-icon"><i class="fa fa-rocket"></i></div>
          <h3>Our Mission</h3>
          <p>
            To provide greater access to higher education — especially for socially and economically 
            disadvantaged youth — through excellence in teaching, research, and community engagement. 
            To foster creativity, critical thinking, and interdisciplinary collaboration that prepares 
            students for the challenges of the 21st century.
          </p>
        </div>
      </div>
      <div style="text-align:center; margin-top:32px;">
        <a href="<?php echo href('mission-vision.php');?>" style="display:inline-flex;align-items:center;gap:8px;color:#FFC107;font-size:12px;font-weight:800;letter-spacing:1px;text-transform:uppercase;text-decoration:none;border:2px solid rgba(255,193,7,0.4);padding:12px 28px;border-radius:4px;transition:all 0.25s;" onmouseover="this.style.borderColor='#FFC107';this.style.background='rgba(255,193,7,0.1)';" onmouseout="this.style.borderColor='rgba(255,193,7,0.4)';this.style.background='transparent';">
          Read Full Vision & Mission <i class="fa fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- =================== JOURNEY / TIMELINE =================== -->
  <section class="bu-about-section bu-about-section-alt">
    <div class="bu-about-container">
      <div style="text-align:center; margin-bottom:60px;">
        <span class="bu-section-label">Our Journey</span>
        <h2 class="bu-section-title">Milestones of <em>excellence.</em></h2>
      </div>
      <div class="bu-timeline">
        <div class="bu-timeline-item">
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2004</span>
            <h4>Foundation Established</h4>
            <p>Bhabha University was founded by Ayushmati Education and Social Society with a vision to provide quality higher education in Central India.</p>
          </div>
          <div class="bu-timeline-spacer"></div>
        </div>
        <div class="bu-timeline-item">
          <div class="bu-timeline-spacer"></div>
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2010</span>
            <h4>Multi-Discipline Expansion</h4>
            <p>Expanded to include Engineering, Pharmacy, Dental Sciences, Nursing, and Management schools on the 150-acre Narmadapuram Road campus.</p>
          </div>
        </div>
        <div class="bu-timeline-item">
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2015</span>
            <h4>National Accreditation</h4>
            <p>Achieved NAAC accreditation and UGC recognition under 2(f) &amp; 12(B), marking a major milestone in quality assurance and credibility.</p>
          </div>
          <div class="bu-timeline-spacer"></div>
        </div>
        <div class="bu-timeline-item">
          <div class="bu-timeline-spacer"></div>
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2020</span>
            <h4>Digital Transformation</h4>
            <p>Launched smart classrooms, online examination systems, ERP portal, and digital library resources — empowering students in the digital era.</p>
          </div>
        </div>
        <div class="bu-timeline-item">
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2024+</span>
            <h4>Global Research Excellence</h4>
            <p>120+ research labs, 60+ international MoUs, 1,200+ publications, and placements exceeding ₹52 LPA — setting new benchmarks every year.</p>
          </div>
          <div class="bu-timeline-spacer"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== EXPLORE ABOUT SUB-PAGES =================== -->
  <section class="bu-about-section">
    <div class="bu-about-container">
      <span class="bu-section-label">Explore Further</span>
      <h2 class="bu-section-title">Everything about <em>Bhabha University.</em></h2>
      <div class="bu-subpages-grid">

        <a href="<?php echo href('page.php','id=20');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-university"></i></div>
          <h4>University Overview</h4>
          <p>Learn about our establishment, governance, campus facilities, and academic ecosystem.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('mission-vision.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-eye"></i></div>
          <h4>Vision &amp; Mission</h4>
          <p>Understand the core purpose that drives every decision and initiative at Bhabha University.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('infrastructure.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-building"></i></div>
          <h4>Campus &amp; Infrastructure</h4>
          <p>Discover our 150-acre green campus — smart classrooms, labs, hostels, library and more.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('page.php','id=18');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-heart"></i></div>
          <h4>Core Values</h4>
          <p>The principles of integrity, innovation, inclusivity, and excellence that define who we are.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('leadership.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-users"></i></div>
          <h4>Administration &amp; Leadership</h4>
          <p>Meet our visionary Chancellor, Vice-Chancellor, and the leadership team steering the university.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('page.php','id=19');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-star"></i></div>
          <h4>Why Choose Bhabha</h4>
          <p>From NAAC accreditation to global placements — the reasons that make us the right choice.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('awards.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-trophy"></i></div>
          <h4>Awards &amp; Achievements</h4>
          <p>Recognised nationally and globally for academic excellence, innovation, and social impact.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('advisory.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-sitemap"></i></div>
          <h4>Cells &amp; Committees</h4>
          <p>Our active statutory cells, grievance committees, ICC, IQAC and other regulatory bodies.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

        <a href="<?php echo href('approvals.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-icon"><i class="fa fa-certificate"></i></div>
          <h4>Approvals &amp; Recognitions</h4>
          <p>Official approvals from UGC, AICTE, PCI, DCI, BCI, NCTE and NAAC accreditation details.</p>
          <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
        </a>

      </div>
    </div>
  </section>

  <!-- =================== ACCREDITATIONS =================== -->
  <section class="bu-about-section bu-about-section-alt" style="padding-top:50px; padding-bottom:70px;">
    <div class="bu-about-container" style="text-align:center;">
      <span class="bu-section-label">Statutory Approvals</span>
      <h2 class="bu-section-title">Recognised by <em>leading bodies.</em></h2>
      <div class="bu-accred-grid">
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">UGC</span>
          <span class="bu-accred-badge-desc">2(f) &amp; 12(B)</span>
        </div>
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">NAAC</span>
          <span class="bu-accred-badge-desc">Accredited</span>
        </div>
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">AICTE</span>
          <span class="bu-accred-badge-desc">Approved</span>
        </div>
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">PCI</span>
          <span class="bu-accred-badge-desc">Approved</span>
        </div>
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">BCI</span>
          <span class="bu-accred-badge-desc">Approved</span>
        </div>
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">DCI</span>
          <span class="bu-accred-badge-desc">Approved</span>
        </div>
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">NCTE</span>
          <span class="bu-accred-badge-desc">Approved</span>
        </div>
        <div class="bu-accred-badge">
          <span class="bu-accred-badge-name">MPNRC</span>
          <span class="bu-accred-badge-desc">Recognized</span>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== CTA =================== -->
  <div class="bu-about-cta">
    <h2>Ready to <em>begin your journey</em>?</h2>
    <p>Join thousands of students who have transformed their lives at Bhabha University, Bhopal.</p>
    <div class="bu-cta-btns">
      <a href="<?php echo href('enquiry.php');?>" class="bu-cta-btn-primary">Apply for Admission</a>
      <a href="<?php echo href('contact.php');?>" class="bu-cta-btn-secondary">Contact Us</a>
    </div>
  </div>

  <!--FOOTER START-->
  <?php include('inc.footer.php');?>
  <!--FOOTER END-->
</div>
<!--KF KODE WRAPPER WRAP END-->
<?php include('inc.footer.js.php');?>
</body>
</html>
