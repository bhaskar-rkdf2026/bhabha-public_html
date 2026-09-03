<?php 
include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Internal Quality Assurance Cell (IQAC) - Bhabha University Bhopal</title>
<meta name="description" content="Internal Quality Assurance Cell (IQAC) of Bhabha University Bhopal. NAAC, AQAR, SSR reports, institutional policies, audits, strategic plans, and best practices.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   IQAC PORTAL STYLES - BULLETPROOF MODERN LAYOUT
   Navy #0A1B54 | Gold #FFC107
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

/* RESET style.css DEFAULT OVERFLOW & PADDINGS */
.kode_wrapper {
  overflow: visible !important;
}

/* =========================================================
   1. DEDICATED IQAC HERO BANNER (NO BROKEN FLOATS)
   ========================================================= */
.bu-hero-iqac {
  background: linear-gradient(135deg, #030B24 0%, #0A1B54 50%, #061D7C 100%) !important;
  position: relative !important;
  width: 100% !important;
  padding: 50px 20px 45px !important;
  color: #ffffff !important;
  overflow: hidden !important;
  box-sizing: border-box !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  clear: both !important;
  float: left !important;
}
.bu-hero-iqac::before {
  content: '';
  position: absolute;
  top: -100px; right: -80px;
  width: 380px; height: 380px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.14) 0%, rgba(255,193,7,0) 70%);
  pointer-events: none;
}
.bu-hero-iqac-container {
  max-width: 1240px;
  margin: 0 auto;
  position: relative;
  z-index: 3;
}
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
  font-size: clamp(28px, 4vw, 44px);
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
  margin: 0;
  max-width: 800px;
}

/* =========================================================
   2. MAIN IQAC PAGE & LAYOUT
   ========================================================= */
.bu-iqac-page {
  background: #FAF9F6 !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  padding: 45px 20px 80px !important;
  clear: both !important;
  float: left !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
  position: relative !important;
}
.bu-iqac-container {
  max-width: 1240px !important;
  margin: 0 auto !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

.bu-iqac-layout {
  display: flex !important;
  gap: 28px !important;
  align-items: flex-start !important;
  width: 100% !important;
  box-sizing: border-box !important;
}
@media (max-width: 960px) {
  .bu-iqac-layout { flex-direction: column !important; }
  .bu-iqac-sidebar { width: 100% !important; }
}

/* Sidebar Menu */
.bu-iqac-sidebar {
  width: 290px !important;
  flex-shrink: 0 !important;
  background: #ffffff !important;
  border: 1px solid var(--bu-border) !important;
  border-top: 4px solid var(--bu-gold) !important;
  border-radius: 12px !important;
  overflow: hidden !important;
  box-shadow: 0 6px 20px rgba(10,27,84,0.05) !important;
  box-sizing: border-box !important;
}
.bu-iqac-sidebar-header {
  background: var(--bu-navy);
  color: #fff;
  padding: 16px 20px;
  font-size: 14.5px;
  font-weight: 800;
  letter-spacing: 0.5px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-iqac-sidebar-header i { color: var(--bu-gold); }
.bu-iqac-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}
.bu-iqac-menu li {
  border-bottom: 1px solid #F1F5F9;
}
.bu-iqac-menu li:last-child { border-bottom: none; }
.bu-iqac-nav-btn {
  width: 100%;
  text-align: left;
  background: none;
  border: none;
  padding: 12px 18px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--bu-text-dark);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: all 0.2s ease;
}
.bu-iqac-nav-btn:hover, .bu-iqac-nav-btn.active {
  background: rgba(10,27,84,0.06);
  color: var(--bu-navy);
  font-weight: 700;
  border-left: 4px solid var(--bu-gold);
  padding-left: 14px;
}

/* Main Content Card */
.bu-iqac-card {
  flex: 1 !important;
  min-width: 0 !important;
  background: #ffffff !important;
  border: 1px solid var(--bu-border) !important;
  border-radius: 14px !important;
  padding: 35px 40px !important;
  box-shadow: 0 6px 22px rgba(10,27,84,0.04) !important;
  box-sizing: border-box !important;
}
.bu-iqac-section-view {
  display: none;
}
.bu-iqac-section-view.active {
  display: block;
  animation: iqacFade 0.25s ease;
}
@keyframes iqacFade {
  from { opacity: 0; transform: translateY(6px); }
  to { opacity: 1; transform: translateY(0); }
}

.bu-sec-badge {
  display: inline-block;
  background: var(--bu-gold-light);
  color: #92400E;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 20px;
  margin-bottom: 10px;
}
.bu-iqac-heading {
  font-size: 25px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 12px;
  font-family: 'Playfair Display', serif;
}
.bu-iqac-divider {
  height: 3px;
  width: 55px;
  background: var(--bu-gold);
  margin-bottom: 20px;
  border-radius: 2px;
}

/* Document Grid */
.bu-doc-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 14px;
  margin-top: 18px;
}
.bu-doc-card {
  background: var(--bu-gray-bg);
  border: 1px solid var(--bu-border);
  border-radius: 10px;
  padding: 16px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
  text-decoration: none;
  transition: all 0.2s ease;
  border-left: 3px solid var(--bu-gold);
}
.bu-doc-card:hover {
  background: var(--bu-navy);
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(10,27,84,0.12);
}
.bu-doc-card i {
  font-size: 20px;
  color: var(--bu-gold-dark);
  flex-shrink: 0;
}
.bu-doc-card:hover i {
  color: var(--bu-gold);
}
.bu-doc-name {
  font-size: 13px;
  font-weight: 700;
  color: inherit;
  line-height: 1.4;
}

/* Committee Table */
.bu-comm-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
  font-size: 13.5px;
}
.bu-comm-table th {
  background: #F1F5F9;
  color: var(--bu-navy);
  font-weight: 700;
  padding: 12px 14px;
  text-align: left;
  border-bottom: 2px solid var(--bu-border);
}
.bu-comm-table td {
  padding: 11px 14px;
  border-bottom: 1px solid var(--bu-border);
  color: var(--bu-text-dark);
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- =========================================================
       DEDICATED IQAC HERO BANNER
       ========================================================= -->
  <div class="bu-hero-iqac">
    <div class="bu-hero-iqac-container">
      <ul class="bu-hero-breadcrumb">
        <li><a href="<?php echo URL_ROOT; ?>">Home</a></li>
        <li class="sep">›</li>
        <li class="active">Internal Quality Assurance Cell</li>
      </ul>

      <div class="bu-hero-badge">
        <i class="fa fa-shield"></i> Statutory Quality Sustenance Cell
      </div>

      <h1 class="bu-hero-title">
        Internal Quality <em>Assurance Cell (IQAC)</em>
      </h1>

      <p class="bu-hero-desc">
        Institutional mechanism for continuous quality enhancement, academic and administrative audits, NAAC benchmark sustenance, and holistic educational excellence at Bhabha University Bhopal.
      </p>
    </div>
  </div>

  <div class="bu-iqac-page">
    <div class="bu-iqac-container">
      <div class="bu-iqac-layout">

        <!-- Sidebar Navigation based on Rajiv Sir's Document -->
        <aside class="bu-iqac-sidebar">
          <div class="bu-iqac-sidebar-header">
            <i class="fa fa-shield"></i> IQAC Sections
          </div>
          <ul class="bu-iqac-menu">
            <li><button class="bu-iqac-nav-btn active" onclick="showIqacTab('structure', this)">Structure of IQAC <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('composition', this)">Composition of IQAC <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('meetings', this)">Meetings &amp; Minutes <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('ssr', this)">SSR Report <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('aqar', this)">AQAR <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('accreditation', this)">Accreditation &amp; Certificates <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('annual', this)">Annual Report <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('strategic', this)">Strategic Plan <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('policies', this)">Policies <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('audits', this)">Audits (AAA &amp; Green) <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('cells', this)">Cells &amp; Committees <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('distinctiveness', this)">Institutional Distinctiveness <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('bestpractices', this)">Best Practices Implemented <i class="fa fa-angle-right"></i></button></li>
            <li><button class="bu-iqac-nav-btn" onclick="showIqacTab('academic_calendar', this)">Academic Calendar <i class="fa fa-angle-right"></i></button></li>
          </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="bu-iqac-card">

          <!-- 1. Structure of IQAC -->
          <div id="iqac-structure" class="bu-iqac-section-view active">
            <span class="bu-sec-badge">Institutional Architecture</span>
            <h2 class="bu-iqac-heading">Structure of IQAC</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              The Internal Quality Assurance Cell (IQAC) at Bhabha University acts as a nodal agency for coordinating quality-related activities, including the adoption and dissemination of best practices, development of quality benchmarks, and facilitation of learner-centric education.
            </p>
            <div style="background:var(--bu-gray-bg);border-radius:10px;padding:22px;border:1px solid var(--bu-border);margin-top:20px;">
              <h4 style="font-size:15px;font-weight:800;color:var(--bu-navy);margin-bottom:12px;">Core Objectives:</h4>
              <ul style="padding-left:20px;color:var(--bu-text-dark);line-height:1.7;font-size:13.5px;">
                <li>To develop a conscious, consistent and catalytic action plan for quality enhancement.</li>
                <li>To channelize all efforts and measures of the University towards promoting academic excellence.</li>
                <li>To ensure internalized quality culture through institutional functioning.</li>
                <li>To integrate modern methods of teaching, assessment, and administrative digitalization.</li>
              </ul>
            </div>
          </div>

          <!-- 2. Composition of IQAC -->
          <div id="iqac-composition" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Committee Members</span>
            <h2 class="bu-iqac-heading">Composition of IQAC</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              In accordance with statutory UGC/NAAC guidelines, the IQAC composition comprises senior administration, academic deans, management representatives, external industry experts, and student nominees.
            </p>
            <div style="overflow-x:auto;">
              <table class="bu-comm-table">
                <thead>
                  <tr>
                    <th>Designation in IQAC</th>
                    <th>Nominee / Official</th>
                    <th>Role in University</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Chairperson</strong></td>
                    <td>Hon'ble Vice Chancellor</td>
                    <td>Head of the Institution</td>
                  </tr>
                  <tr>
                    <td><strong>Director / Coordinator</strong></td>
                    <td>Senior Academic Dean</td>
                    <td>Director, IQAC</td>
                  </tr>
                  <tr>
                    <td><strong>Senior Administrative Officers</strong></td>
                    <td>Registrar, Finance Officer, CoE</td>
                    <td>University Administration</td>
                  </tr>
                  <tr>
                    <td><strong>Faculty Representatives</strong></td>
                    <td>Deans of Faculties / Institutes</td>
                    <td>Academic Leadership</td>
                  </tr>
                  <tr>
                    <td><strong>Management Representative</strong></td>
                    <td>Nominee of Sponsoring Body</td>
                    <td>Trustee / Management</td>
                  </tr>
                  <tr>
                    <td><strong>Industry &amp; Alumni Nominees</strong></td>
                    <td>Leading Industrialists &amp; Alumni Rep</td>
                    <td>External Quality Stakeholders</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- 3. Meetings & Minutes -->
          <div id="iqac-meetings" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Proceedings &amp; Resolutions</span>
            <h2 class="bu-iqac-heading">Meetings &amp; Minutes of IQAC</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Regular quarterly meetings of the IQAC are convened to deliberate on curriculum revisions, infrastructure expansion, quality benchmarks, and implementation status.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">IQAC Meeting Minutes &amp; ATR 2024-25</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">IQAC Meeting Minutes &amp; ATR 2023-24</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">IQAC Meeting Minutes &amp; ATR 2022-23</span>
              </a>
            </div>
          </div>

          <!-- 4. SSR Report -->
          <div id="iqac-ssr" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Accreditation Document</span>
            <h2 class="bu-iqac-heading">Self Study Report (SSR)</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Comprehensive institutional Self Study Report submitted to the National Assessment and Accreditation Council (NAAC) reflecting curricular aspects, teaching-learning evaluations, and research metrics.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">Download SSR Report Cycle-1</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">Executive Summary SSR</span>
              </a>
            </div>
          </div>

          <!-- 5. AQAR -->
          <div id="iqac-aqar" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Annual Quality Assurance Report</span>
            <h2 class="bu-iqac-heading">AQAR Submissions</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Yearly records submitted by the University detailing quality sustenance activities, faculty research, student support, and community development.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">AQAR Report (2023 - 2024)</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">AQAR Report (2022 - 2023)</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">AQAR Report (2021 - 2022)</span>
              </a>
            </div>
          </div>

          <!-- 6. Accreditation & Certificates -->
          <div id="iqac-accreditation" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Statutory Accreditations</span>
            <h2 class="bu-iqac-heading">Accreditation &amp; Recognitions</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Statutory recognition orders and approval certificates from apex educational regulatory bodies of the Government of India.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-certificate"></i>
                <span class="bu-doc-name">UGC 2(f) Recognition Order</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-certificate"></i>
                <span class="bu-doc-name">PCI Approval Certificates</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-certificate"></i>
                <span class="bu-doc-name">AICTE Approval Letters</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-certificate"></i>
                <span class="bu-doc-name">BCI Law Affiliation Certificate</span>
              </a>
            </div>
          </div>

          <!-- 7. Annual Report -->
          <div id="iqac-annual" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Institutional Yearbooks</span>
            <h2 class="bu-iqac-heading">Annual Reports</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Yearly compilations documenting institutional progress, exam results, student achievements, campus placements, and research milestones.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-book"></i>
                <span class="bu-doc-name">University Annual Report 2023-24</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-book"></i>
                <span class="bu-doc-name">University Annual Report 2022-23</span>
              </a>
            </div>
          </div>

          <!-- 8. Strategic Plan -->
          <div id="iqac-strategic" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Perspective Development</span>
            <h2 class="bu-iqac-heading">Strategic Plan &amp; Deployment</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Long-term roadmaps outlining vision goals, technological infrastructure upgrades, internationalization, and curriculum enhancements aligned with NEP 2020.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-line-chart"></i>
                <span class="bu-doc-name">Strategic Development Plan (2020-2025)</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-text-o"></i>
                <span class="bu-doc-name">Strategic Deployment &amp; Review Matrix</span>
              </a>
            </div>
          </div>

          <!-- 9. Policies -->
          <div id="iqac-policies" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Regulatory Governance</span>
            <h2 class="bu-iqac-heading">University Quality Policies</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Governing policies standardizing operational workflows, intellectual property, ethical conduct, and campus welfare.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i> <span class="bu-doc-name">Research Promotion Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i> <span class="bu-doc-name">Code of Ethics &amp; Conduct</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i> <span class="bu-doc-name">Green Campus &amp; Energy Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i> <span class="bu-doc-name">IT &amp; E-Governance Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i> <span class="bu-doc-name">Consultancy &amp; Seed Grant Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i> <span class="bu-doc-name">Differently Abled (Divyangjan) Policy</span></a>
            </div>
          </div>

          <!-- 10. Audits -->
          <div id="iqac-audits" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Quality Evaluation</span>
            <h2 class="bu-iqac-heading">Audits (AAA, Green &amp; Energy)</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Third-party external and internal evaluations assessing pedagogical standards, ecological sustainability, and energy efficiencies.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card"><i class="fa fa-check-square-o"></i> <span class="bu-doc-name">Academic &amp; Administrative Audit (AAA)</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-leaf"></i> <span class="bu-doc-name">Green Campus Audit Report</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-bolt"></i> <span class="bu-doc-name">Energy Audit &amp; Conservation Report</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-tint"></i> <span class="bu-doc-name">Environmental &amp; Water Audit</span></a>
            </div>
          </div>

          <!-- 11. Cells & Committees -->
          <div id="iqac-cells" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Student &amp; Staff Welfare</span>
            <h2 class="bu-iqac-heading">Statutory Cells &amp; Committees</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Proactive institutional bodies ensuring zero discrimination, safety, and grievance redressal across campus.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card"><i class="fa fa-users"></i> <span class="bu-doc-name">Anti-Ragging Committee &amp; Squad</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-users"></i> <span class="bu-doc-name">Internal Complaints Committee (ICC)</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-users"></i> <span class="bu-doc-name">Student Grievance Redressal Cell</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-users"></i> <span class="bu-doc-name">SC / ST / OBC Welfare Committee</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-users"></i> <span class="bu-doc-name">Women Development Cell</span></a>
            </div>
          </div>

          <!-- 12. Distinctiveness -->
          <div id="iqac-distinctiveness" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Institutional Hallmark</span>
            <h2 class="bu-iqac-heading">Institutional Distinctiveness</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Bhabha University's distinctive institutional strength lies in **"Industry-Oriented Pharmaceutical Research &amp; Commercialization"** driven by the *Bhabha Pharmacy Research Laboratories* (FSSAI Approved, MSME Registered) and the *University Incubation Centre*, fostering healthcare innovations directly into consumer products.
            </p>
            <div style="background:#FFF9E6;border-left:4px solid var(--bu-gold);padding:18px 20px;border-radius:6px;margin-top:16px;">
              <strong style="color:var(--bu-navy);font-size:14px;">Key Distinctive Pillars:</strong>
              <p style="margin:6px 0 0;font-size:13.5px;color:var(--bu-text-dark);">
                Integration of live industrial labs with academic curriculum, providing pharmacy, biotechnology, and engineering scholars real-world experience in product formulation, regulatory filings, and startup entrepreneurship.
              </p>
            </div>
          </div>

          <!-- 13. Best Practices -->
          <div id="iqac-bestpractices" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Excellence Benchmarks</span>
            <h2 class="bu-iqac-heading">Best Practices Implemented</h2>
            <div class="bu-iqac-divider"></div>
            <div style="display:grid;gap:16px;margin-top:16px;">
              <div style="background:var(--bu-gray-bg);border:1px solid var(--bu-border);border-radius:10px;padding:20px;">
                <h4 style="font-size:15px;font-weight:800;color:var(--bu-navy);margin-bottom:6px;">
                  Best Practice 1: Student Entrepreneurship &amp; Incubation Ecosystem
                </h4>
                <p style="font-size:13.5px;color:var(--bu-text-muted);margin:0;line-height:1.6;">
                  Providing pre-incubation mentorship, patent filing support, and pilot manufacturing facilities to convert student ideas into viable commercial startups.
                </p>
              </div>
              <div style="background:var(--bu-gray-bg);border:1px solid var(--bu-border);border-radius:10px;padding:20px;">
                <h4 style="font-size:15px;font-weight:800;color:var(--bu-navy);margin-bottom:6px;">
                  Best Practice 2: Experiential Community Health Outreach
                </h4>
                <p style="font-size:13.5px;color:var(--bu-text-muted);margin:0;line-height:1.6;">
                  Regular free medical camps, dental diagnostics, and generic medicine awareness initiatives conducted by healthcare faculties in surrounding rural belts.
                </p>
              </div>
            </div>
          </div>

          <!-- 14. Academic Calendar -->
          <div id="iqac-academic_calendar" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Annual Schedule</span>
            <h2 class="bu-iqac-heading">Academic Calendar</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:14.5px;color:var(--bu-text-muted);line-height:1.7;">
              Official institutional schedule specifying semester commencement dates, internal examination weeks, winter/summer vacations, and university convocation.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-calendar"></i>
                <span class="bu-doc-name">Academic Calendar (Session 2024-25)</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-calendar"></i>
                <span class="bu-doc-name">Academic Calendar (Session 2023-24)</span>
              </a>
            </div>
          </div>

        </main>

      </div>
    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- Scripts -->
<?php include('inc.footer.js.php');?>
<script>
function showIqacTab(tabKey, btnElement) {
  var views = document.querySelectorAll('.bu-iqac-section-view');
  var btns = document.querySelectorAll('.bu-iqac-nav-btn');
  
  views.forEach(function(v) { v.classList.remove('active'); });
  btns.forEach(function(b) { b.classList.remove('active'); });
  
  var target = document.getElementById('iqac-' + tabKey);
  if (target) {
    target.classList.add('active');
  }
  if (btnElement) {
    btnElement.classList.add('active');
  }
}
</script>
</body>
</html>
