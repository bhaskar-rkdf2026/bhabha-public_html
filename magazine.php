<?php 
include_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>University Magazine &amp; Publications - Bhabha University</title>
<meta name="description" content="Explore 'Bhabha Spandan' and annual university magazines celebrating creative literature, student expressions, technological breakthroughs, and institutional glory.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   UNIVERSITY MAGAZINE PAGE STYLES
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

.bu-mag-wrap {
  background: #FAF9F6;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 50px 20px 80px;
  clear: both !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
}
.bu-mag-container {
  max-width: 1200px;
  margin: 0 auto;
}

/* Featured Flagship Magazine Hero Showcase */
.bu-mag-hero-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-top: 5px solid var(--bu-gold);
  border-radius: 18px;
  padding: 40px;
  display: grid;
  grid-template-columns: 320px 1fr;
  gap: 40px;
  align-items: center;
  margin-bottom: 55px;
  box-shadow: 0 12px 35px rgba(10,27,84,0.06);
}

.bu-mag-cover-box {
  background: linear-gradient(145deg, #0A1B54 0%, #061D7C 100%);
  border-radius: 14px;
  padding: 30px 24px;
  color: #fff;
  text-align: center;
  position: relative;
  box-shadow: 0 15px 30px rgba(10,27,84,0.25);
  border: 3px solid #FFC107;
}
.bu-mag-cover-box .mag-tag {
  background: #FFC107;
  color: #0A1B54;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 4px 12px;
  border-radius: 50px;
  display: inline-block;
  margin-bottom: 15px;
}
.bu-mag-cover-box h3 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 4px;
  letter-spacing: 0.5px;
}
.bu-mag-cover-box .mag-subtitle {
  font-size: 13px;
  color: #FFC107;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 20px;
}
.bu-mag-cover-box .mag-year {
  font-size: 20px;
  font-weight: 800;
  color: #ffffff;
  border-top: 1px solid rgba(255,255,255,0.2);
  border-bottom: 1px solid rgba(255,255,255,0.2);
  padding: 8px 0;
  margin: 15px 0;
}
.bu-mag-cover-box .mag-theme {
  font-size: 12px;
  color: rgba(255,255,255,0.8);
  font-style: italic;
}

.bu-mag-details h2 {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 12px;
}
.bu-mag-details p {
  color: var(--bu-text-muted);
  font-size: 14.5px;
  line-height: 1.7;
  margin-bottom: 20px;
}

.bu-mag-pill-list {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 25px;
}
.bu-mag-pill-list span {
  background: #F1F5F9;
  color: var(--bu-navy);
  font-size: 12.5px;
  font-weight: 700;
  padding: 6px 14px;
  border-radius: 6px;
  border: 1px solid #E2E8F0;
}

.bu-mag-actions {
  display: flex;
  align-items: center;
  gap: 14px;
  flex-wrap: wrap;
}
.bu-btn-primary {
  background: var(--bu-navy);
  color: #FFC107;
  font-weight: 800;
  font-size: 14px;
  padding: 13px 28px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.25s;
  box-shadow: 0 4px 15px rgba(10,27,84,0.18);
}
.bu-btn-primary:hover {
  background: var(--bu-navy-light);
  color: #ffffff;
  transform: translateY(-2px);
}
.bu-btn-secondary {
  background: #ffffff;
  color: var(--bu-navy);
  border: 1.5px solid var(--bu-navy);
  font-weight: 700;
  font-size: 14px;
  padding: 12px 24px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s;
}
.bu-btn-secondary:hover {
  background: #F8FAFC;
  color: var(--bu-navy-light);
}

/* Magazine Categories & Departmental Publications */
.bu-sec-heading-wrap {
  text-align: center;
  margin-bottom: 40px;
}
.bu-sec-badge {
  display: inline-block;
  background: var(--bu-gold-light);
  border: 1px solid rgba(217,155,0,0.3);
  color: var(--bu-gold-dark);
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 4px 14px;
  border-radius: 50px;
  margin-bottom: 8px;
}
.bu-sec-heading {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 8px;
}
.bu-sec-desc {
  color: var(--bu-text-muted);
  font-size: 14px;
  max-width: 650px;
  margin: 0 auto;
}

.bu-mag-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
  gap: 25px;
  margin-bottom: 55px;
}
.bu-mag-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: all 0.25s ease;
  box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.bu-mag-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 14px 35px rgba(10,27,84,0.09);
  border-color: #CBD5E1;
}
.bu-mag-card-header {
  padding: 24px 20px;
  text-align: center;
  color: #fff;
}
.bu-mag-card-header.c1 { background: linear-gradient(135deg, #1E3A8A, #0A1B54); }
.bu-mag-card-header.c2 { background: linear-gradient(135deg, #047857, #064E3B); }
.bu-mag-card-header.c3 { background: linear-gradient(135deg, #B45309, #78350F); }
.bu-mag-card-header.c4 { background: linear-gradient(135deg, #6B21A8, #4C1D95); }

.bu-mag-card-header i {
  font-size: 32px;
  margin-bottom: 10px;
  display: block;
}
.bu-mag-card-header h4 {
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  font-weight: 800;
  margin: 0 0 4px;
  color: #ffffff;
}
.bu-mag-card-header span {
  font-size: 11.5px;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  opacity: 0.85;
}

.bu-mag-card-body {
  padding: 20px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.bu-mag-card-body p {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin-bottom: 18px;
}
.bu-mag-card-footer {
  border-top: 1px solid #F1F5F9;
  padding-top: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-mag-btn-read {
  background: var(--bu-navy);
  color: #ffffff;
  font-size: 12.5px;
  font-weight: 700;
  padding: 7px 14px;
  border-radius: 6px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.2s;
}
.bu-mag-btn-read:hover {
  background: var(--bu-navy-light);
  color: var(--bu-gold);
}

/* Inside the Magazine Featurettes */
.bu-mag-pillars {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-bottom: 50px;
}
.bu-pillar-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 22px;
  text-align: center;
}
.bu-pillar-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: var(--bu-gold-light);
  color: var(--bu-gold-dark);
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 12px;
}
.bu-pillar-card h4 {
  font-size: 16px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 6px;
}
.bu-pillar-card p {
  font-size: 13px;
  color: var(--bu-text-muted);
  margin: 0;
  line-height: 1.5;
}

@media (max-width: 900px) {
  .bu-mag-hero-card { grid-template-columns: 1fr; }
  .bu-mag-pillars { grid-template-columns: 1fr; }
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
  $page_title    = 'University <em>Magazine &amp; Publications</em>';
  $page_subtitle = 'Bhabha Spandan & Annual Chronicles — A vibrant canvas of creative literature, student expressions, technological breakthroughs, and institutional glory.';
  $page_icon     = 'fa-book';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Publications', 'url' => href('research.php#media-publications')],
    ['label' => 'University Magazine', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-mag-wrap">
    <div class="bu-mag-container">

      <!-- 1. FEATURED FLAGSHIP ANNUAL MAGAZINE -->
      <div class="bu-mag-hero-card">
        <div class="bu-mag-cover-box">
          <span class="mag-tag">FLAGSHIP EDITION</span>
          <h3>BHABHA SPANDAN</h3>
          <div class="mag-subtitle">Annual University Magazine</div>
          <div class="mag-year">2025 – 2026</div>
          <div class="mag-theme">Theme: "Innovating for a Sustainable &amp; Inclusive Tomorrow"</div>
        </div>

        <div class="bu-mag-details">
          <h2>Bhabha Spandan — 2025-26 Edition</h2>
          <p>
            'Bhabha Spandan' is the annual creative and intellectual flagship publication of Bhabha University. It chronicles student achievements, literary poetry, thought leadership essays by faculty members, campus event photo stories, and our journey towards becoming a global hub of higher learning.
          </p>

          <div class="bu-mag-pill-list">
            <span><i class="fa fa-pencil"></i> Student Literature &amp; Art</span>
            <span><i class="fa fa-flask"></i> Research Highlights</span>
            <span><i class="fa fa-trophy"></i> Sports &amp; Cultural Chronicles</span>
            <span><i class="fa fa-user-circle"></i> Alumni Spotlight</span>
            <span><i class="fa fa-star"></i> Chancellor's &amp; VC's Address</span>
          </div>

          <div class="bu-mag-actions">
            <a href="#" onclick="alert('Magazine PDF coming soon! Contact admin for access.'); return false;" class="bu-btn-primary">
              <i class="fa fa-file-pdf-o"></i> Read Full Magazine (PDF)
            </a>
            <a href="<?php echo href('gallery.php'); ?>" class="bu-btn-secondary">
              <i class="fa fa-image"></i> Campus Photo Gallery
            </a>
          </div>
        </div>
      </div>

      <!-- 2. DEPARTMENTAL MAGAZINES & EDITIONS -->
      <div class="bu-sec-heading-wrap">
        <span class="bu-sec-badge"><i class="fa fa-th-large"></i> Faculty Publications</span>
        <h2 class="bu-sec-heading">Departmental &amp; Annual Magazines</h2>
        <p class="bu-sec-desc">Explore specialized journals and student-led annual publications from our various faculties.</p>
      </div>

      <div class="bu-mag-grid">

        <!-- Mag 1 -->
        <div class="bu-mag-card">
          <div class="bu-mag-card-header c1">
            <i class="fa fa-laptop"></i>
            <h4>ByteStream</h4>
            <span>Faculty of Computer Applications &bull; 2025</span>
          </div>
          <div class="bu-mag-card-body">
            <p>Focusing on Artificial Intelligence, Cloud Computing, Cyber Security breakthroughs, and student coding hackathons.</p>
            <div class="bu-mag-card-footer">
              <small class="text-muted"><i class="fa fa-file-text-o"></i> 48 Pages</small>
              <a href="#" onclick="alert('ByteStream PDF coming soon!'); return false;" class="bu-mag-btn-read">
                <i class="fa fa-download"></i> Read PDF
              </a>
            </div>
          </div>
        </div>

        <!-- Mag 2 -->
        <div class="bu-mag-card">
          <div class="bu-mag-card-header c2">
            <i class="fa fa-medkit"></i>
            <h4>PharmTech Bulletin</h4>
            <span>Faculty of Pharmacy &bull; 2025</span>
          </div>
          <div class="bu-mag-card-body">
            <p>Annual research magazine documenting formulation studies, drug delivery innovations, and healthcare community camps.</p>
            <div class="bu-mag-card-footer">
              <small class="text-muted"><i class="fa fa-file-text-o"></i> 64 Pages</small>
              <a href="#" onclick="alert('PharmTech Bulletin PDF coming soon!'); return false;" class="bu-mag-btn-read">
                <i class="fa fa-download"></i> Read PDF
              </a>
            </div>
          </div>
        </div>

        <!-- Mag 3 -->
        <div class="bu-mag-card">
          <div class="bu-mag-card-header c3">
            <i class="fa fa-line-chart"></i>
            <h4>Management Synergy</h4>
            <span>Faculty of Management &bull; 2025</span>
          </div>
          <div class="bu-mag-card-body">
            <p>Case studies on corporate leadership, startup entrepreneurship, fintech trends, and MBA campus placement drives.</p>
            <div class="bu-mag-card-footer">
              <small class="text-muted"><i class="fa fa-file-text-o"></i> 52 Pages</small>
              <a href="#" onclick="alert('Management Synergy PDF coming soon!'); return false;" class="bu-mag-btn-read">
                <i class="fa fa-download"></i> Read PDF
              </a>
            </div>
          </div>
        </div>

        <!-- Mag 4 -->
        <div class="bu-mag-card">
          <div class="bu-mag-card-header c4">
            <i class="fa fa-cogs"></i>
            <h4>TechnoVision</h4>
            <span>Engineering &amp; Technology &bull; 2025</span>
          </div>
          <div class="bu-mag-card-body">
            <p>Showcasing student engineering prototypes, robotics design competitions, green energy initiatives, and patent filings.</p>
            <div class="bu-mag-card-footer">
              <small class="text-muted"><i class="fa fa-file-text-o"></i> 56 Pages</small>
              <a href="#" onclick="alert('TechnoVision PDF coming soon!'); return false;" class="bu-mag-btn-read">
                <i class="fa fa-download"></i> Read PDF
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- 3. MAGAZINE SECTION PILLARS -->
      <div class="bu-sec-heading-wrap">
        <span class="bu-sec-badge"><i class="fa fa-pencil-square-o"></i> Editorial Sections</span>
        <h2 class="bu-sec-heading">What’s Inside Bhabha Spandan?</h2>
      </div>

      <div class="bu-mag-pillars">
        <div class="bu-pillar-card">
          <div class="bu-pillar-icon"><i class="fa fa-paint-brush"></i></div>
          <h4>Creative Expressions</h4>
          <p>Original poems, short stories, paintings, sketches, and photography contributed by students across disciplines.</p>
        </div>

        <div class="bu-pillar-card">
          <div class="bu-pillar-icon"><i class="fa fa-lightbulb-o"></i></div>
          <h4>Research &amp; Ideas</h4>
          <p>Scholarly articles on cutting-edge technological trends, sustainability, and socio-economic transformation.</p>
        </div>

        <div class="bu-pillar-card">
          <div class="bu-pillar-icon"><i class="fa fa-star-o"></i></div>
          <h4>Campus Chronicles</h4>
          <p>Annual round-up of convocations, celebrity visits, cultural festivals, sports tournaments, and award galas.</p>
        </div>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- Scripts -->
<?php include('inc.footer.js.php');?>
</body>
</html>
