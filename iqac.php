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
   IQAC PORTAL STYLES
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-gray-bg: #F8FAFC;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

.bu-iqac-page {
  background: #FAF9F6;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 50px 20px 80px;
}
.bu-iqac-container {
  max-width: 1240px;
  margin: 0 auto;
}

.bu-iqac-layout {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 30px;
  align-items: start;
}
@media (max-width: 960px) {
  .bu-iqac-layout { grid-template-columns: 1fr; }
}

/* Sidebar Menu */
.bu-iqac-sidebar {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  position: sticky;
  top: 20px;
}
.bu-iqac-sidebar-header {
  background: var(--bu-navy);
  color: #fff;
  padding: 18px 20px;
  font-size: 15px;
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
  padding: 13px 18px;
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
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 40px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.03);
}
.bu-iqac-section-view {
  display: none;
}
.bu-iqac-section-view.active {
  display: block;
  animation: iqacFade 0.3s ease;
}
@keyframes iqacFade {
  from { opacity: 0; transform: translateY(8px); }
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
  padding: 5px 12px;
  border-radius: 20px;
  margin-bottom: 12px;
}
.bu-iqac-heading {
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 16px;
  font-family: 'Playfair Display', serif;
}
.bu-iqac-divider {
  height: 3px;
  width: 60px;
  background: var(--bu-gold);
  margin-bottom: 24px;
  border-radius: 2px;
}

/* Document Grid */
.bu-doc-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 16px;
  margin-top: 20px;
}
.bu-doc-card {
  background: var(--bu-gray-bg);
  border: 1px solid var(--bu-border);
  border-radius: 10px;
  padding: 18px 20px;
  display: flex;
  align-items: center;
  gap: 14px;
  text-decoration: none;
  transition: all 0.25s ease;
  border-left: 3px solid var(--bu-gold);
}
.bu-doc-card:hover {
  background: var(--bu-navy);
  color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 6px 18px rgba(10,27,84,0.15);
}
.bu-doc-card i {
  font-size: 22px;
  color: var(--bu-gold-dark);
  flex-shrink: 0;
}
.bu-doc-card:hover i {
  color: var(--bu-gold);
}
.bu-doc-name {
  font-size: 13.5px;
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
  padding: 12px 16px;
  text-align: left;
  border-bottom: 2px solid var(--bu-border);
}
.bu-comm-table td {
  padding: 12px 16px;
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

  <!-- INNER HERO BANNER -->
  <?php
  $page_title    = 'Internal Quality <em>Assurance Cell (IQAC)</em>';
  $page_subtitle = 'Institutional mechanism for continuous quality enhancement, academic audits, NAAC accreditation, and holistic benchmark sustenance at Bhabha University.';
  $page_icon     = 'fa-shield';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'IQAC', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

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
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              The Internal Quality Assurance Cell (IQAC) at Bhabha University acts as a nodal agency for coordinating quality-related activities, including the adoption and dissemination of best practices, development of quality benchmarks, and facilitation of learner-centric education.
            </p>
            <div style="background:var(--bu-gray-bg);border-radius:10px;padding:24px;border:1px solid var(--bu-border);margin-top:20px;">
              <h4 style="font-size:16px;font-weight:800;color:var(--bu-navy);margin-bottom:12px;">Core Objectives:</h4>
              <ul style="padding-left:20px;color:var(--bu-text-dark);line-height:1.7;font-size:14px;">
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
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
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
                    <td>Leading Industrialists &amp; BUAA Rep</td>
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
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
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
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              The comprehensive Self Study Report (SSR) prepared for assessment and accreditation by the National Assessment and Accreditation Council (NAAC).
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-text-o"></i>
                <span class="bu-doc-name">Bhabha University SSR Document (Full Report)</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-external-link"></i>
                <span class="bu-doc-name">Executive Summary &amp; Profile of the University</span>
              </a>
            </div>
          </div>

          <!-- 5. AQAR -->
          <div id="iqac-aqar" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Annual Submissions</span>
            <h2 class="bu-iqac-heading">Annual Quality Assurance Report (AQAR)</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              Yearly compilation of institutional activities, quantitative metrics, and quality initiatives submitted to national accreditation councils.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">AQAR Report (Session 2023 - 2024)</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">AQAR Report (Session 2022 - 2023)</span>
              </a>
              <a href="#" class="bu-doc-card">
                <i class="fa fa-file-pdf-o"></i>
                <span class="bu-doc-name">AQAR Report (Session 2021 - 2022)</span>
              </a>
            </div>
          </div>

          <!-- 6. Accreditation & Recognition Certificate -->
          <div id="iqac-accreditation" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Statutory Accreditations</span>
            <h2 class="bu-iqac-heading">Accreditation &amp; Recognition Certificates</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              Statutory recognition certificates and approvals granted by UGC, AICTE, PCI, DCI, MPNRC, and Government bodies.
            </p>
            <div class="bu-doc-grid">
              <a href="<?php echo href('approvals.php'); ?>" class="bu-doc-card">
                <i class="fa fa-certificate"></i>
                <span class="bu-doc-name">View All University Approvals &amp; Gazette</span>
              </a>
              <a href="<?php echo href('ugc-proforma.php'); ?>" class="bu-doc-card">
                <i class="fa fa-check-circle"></i>
                <span class="bu-doc-name">UGC Inspection &amp; Compliance Proforma</span>
              </a>
            </div>
          </div>

          <!-- 7. Annual Report -->
          <div id="iqac-annual" class="bu-iqac-section-view">
            <span class="bu-sec-badge">University Records</span>
            <h2 class="bu-iqac-heading">Annual Reports</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              Annual publications documenting the total academic, financial, developmental, and research progress of the University.
            </p>
            <div class="bu-doc-grid">
              <a href="<?php echo URL_UPLOAD; ?>media/671d06f0fea73f07576a994c4343281c.pdf" target="_blank" class="bu-doc-card">
                <i class="fa fa-book"></i>
                <span class="bu-doc-name">Annual Report 2024 (Download PDF)</span>
              </a>
              <a href="<?php echo href('auditreport.php'); ?>" class="bu-doc-card">
                <i class="fa fa-balance-scale"></i>
                <span class="bu-doc-name">Audited Balance Sheets &amp; Financials</span>
              </a>
            </div>
          </div>

          <!-- 8. Strategic Plan -->
          <div id="iqac-strategic" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Future Roadmap</span>
            <h2 class="bu-iqac-heading">Strategic Plan &amp; Deployment</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              5-Year and 10-Year institutional strategic roadmap focusing on academic modernization, patent generation, industry incubation, and sustainable eco-campus goals.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card">
                <i class="fa fa-line-chart"></i>
                <span class="bu-doc-name">Institutional Strategic Plan (2023 - 2028)</span>
              </a>
            </div>
          </div>

          <!-- 9. Policies -->
          <div id="iqac-policies" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Institutional Code</span>
            <h2 class="bu-iqac-heading">University Policies</h2>
            <div class="bu-iqac-divider"></div>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i><span class="bu-doc-name">Research Promotion Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i><span class="bu-doc-name">IT &amp; E-Governance Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i><span class="bu-doc-name">Environment &amp; Green Campus Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i><span class="bu-doc-name">Consultancy &amp; Seed Grant Policy</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-shield"></i><span class="bu-doc-name">Code of Conduct &amp; Ethics</span></a>
            </div>
          </div>

          <!-- 10. Audits -->
          <div id="iqac-audits" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Internal &amp; External Audits</span>
            <h2 class="bu-iqac-heading">Quality Audits</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              Periodic environmental, academic, and gender audits conducted by recognized third-party assessors.
            </p>
            <div class="bu-doc-grid">
              <a href="#" class="bu-doc-card"><i class="fa fa-leaf"></i><span class="bu-doc-name">Green Campus Audit Report</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-bolt"></i><span class="bu-doc-name">Energy Audit Report</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-graduation-cap"></i><span class="bu-doc-name">Academic &amp; Administrative Audit (AAA)</span></a>
              <a href="#" class="bu-doc-card"><i class="fa fa-venus-mars"></i><span class="bu-doc-name">Gender Equality Audit Report</span></a>
            </div>
          </div>

          <!-- 11. Cells & Committees -->
          <div id="iqac-cells" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Governance</span>
            <h2 class="bu-iqac-heading">Cells &amp; Committees</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              Active statutory cells including Internal Complaints Committee (ICC), Anti-Ragging Cell, SC/ST Cell, and Grievance Redressal Committee.
            </p>
            <a href="<?php echo href('advisory.php'); ?>" class="bu-doc-card" style="display:inline-flex;">
              <i class="fa fa-users"></i>
              <span class="bu-doc-name">View Complete Cells &amp; Committees Details &rarr;</span>
            </a>
          </div>

          <!-- 12. Institutional Distinctiveness -->
          <div id="iqac-distinctiveness" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Core Identity</span>
            <h2 class="bu-iqac-heading">Institutional Distinctiveness</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              Bhabha University's distinctive focus on practical industrial training, incubation of student startups, affordable professional education, and hands-on pharmacy formulation laboratories.
            </p>
          </div>

          <!-- 13. Best Practices Implemented -->
          <div id="iqac-bestpractices" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Quality Milestones</span>
            <h2 class="bu-iqac-heading">Best Practices Implemented</h2>
            <div class="bu-iqac-divider"></div>
            <div style="background:var(--bu-gray-bg);border-radius:10px;padding:24px;border:1px solid var(--bu-border);margin-top:10px;">
              <h4 style="font-size:16px;font-weight:800;color:var(--bu-navy);margin-bottom:8px;">1. Commercial Pharmacy Innovation &amp; Incubation</h4>
              <p style="font-size:14px;color:var(--bu-text-muted);line-height:1.6;margin-bottom:18px;">
                Formulation and official licensing of commercial consumer health products (Dextro Zing Jeera, Energy Drink, Aloe Vera Gel) directly by university laboratory faculty and students.
              </p>
              <h4 style="font-size:16px;font-weight:800;color:var(--bu-navy);margin-bottom:8px;">2. Digital Governance &amp; Student Portals</h4>
              <p style="font-size:14px;color:var(--bu-text-muted);line-height:1.6;">
                100% paperless student lifecycle management covering admissions, exam timetable, e-results, and National Academic Depository (NAD) integration.
              </p>
            </div>
          </div>

          <!-- 14. Academic Calendar -->
          <div id="iqac-academic_calendar" class="bu-iqac-section-view">
            <span class="bu-sec-badge">Session Planning</span>
            <h2 class="bu-iqac-heading">Academic Calendar</h2>
            <div class="bu-iqac-divider"></div>
            <p style="font-size:15px;color:var(--bu-text-muted);line-height:1.7;">
              Central academic schedules covering teaching days, continuous assessments, mid-semester evaluations, vacation periods, and final university examinations.
            </p>
            <a href="<?php echo href('academic.php'); ?>" class="bu-doc-card" style="display:inline-flex;">
              <i class="fa fa-calendar"></i>
              <span class="bu-doc-name">View Complete University Academic Calendar &rarr;</span>
            </a>
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
