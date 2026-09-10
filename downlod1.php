<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('downlod1') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Student Form Downloads - Bhabha University Bhopal'); ?></title>
<meta name="description" content="Download official Bhabha University application forms for degree certificates, migration certificates, duplicate mark sheets, transcript issuance, and fee notices.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   STUDENT FORM DOWNLOADS - HOMEPAGE LUXURY THEME
   Navy #0A1B54 / Gold #FFC107 / Light Slate #F8FAFC
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #061D7C;
  --bu-navy-dark: #051235;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-border: #E2E8F0;
  --bu-text-dark: #0F172A;
  --bu-text-muted: #64748B;
  --bu-card-bg: #ffffff;
}

.bu-dl-wrap {
  background: #F8FAFC;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 50px 20px 80px;
  clear: both !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

.bu-dl-container {
  max-width: 1200px;
  margin: 0 auto;
}

/* Section Header */
.bu-sec-header {
  text-align: center;
  margin-bottom: 35px;
}
.bu-sec-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(10, 27, 84, 0.08);
  color: var(--bu-navy);
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  padding: 6px 16px;
  border-radius: 30px;
  margin-bottom: 12px;
}
.bu-sec-heading {
  font-size: 32px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 10px;
  letter-spacing: -0.5px;
}
.bu-sec-heading em {
  font-style: normal;
  color: var(--bu-gold-dark);
}
.bu-sec-sub {
  font-size: 14.5px;
  color: var(--bu-text-muted);
  max-width: 720px;
  margin: 0 auto;
  line-height: 1.6;
}

/* Feature Assurance Cards Strip */
.bu-feature-strip {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
  margin-bottom: 40px;
}
.bu-feature-pill {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 16px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
  box-shadow: 0 4px 14px rgba(10, 27, 84, 0.03);
  transition: all 0.25s ease;
}
.bu-feature-pill:hover {
  transform: translateY(-2px);
  border-color: var(--bu-gold);
  box-shadow: 0 8px 20px rgba(10, 27, 84, 0.08);
}
.bu-feature-icon {
  width: 42px;
  height: 42px;
  border-radius: 10px;
  background: rgba(10, 27, 84, 0.06);
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}
.bu-feature-pill:hover .bu-feature-icon {
  background: var(--bu-navy);
  color: var(--bu-gold);
}
.bu-feature-text strong {
  display: block;
  font-size: 13px;
  font-weight: 700;
  color: var(--bu-navy);
  margin-bottom: 2px;
}
.bu-feature-text span {
  display: block;
  font-size: 11.5px;
  color: var(--bu-text-muted);
  line-height: 1.3;
}

/* Filter Bar & Search Toolbar */
.bu-dl-toolbar {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 14px 20px;
  margin-bottom: 30px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
  flex-wrap: wrap;
}
.bu-dl-tabs {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.bu-tab-btn {
  background: #F1F5F9;
  border: 1px solid transparent;
  color: #475569;
  font-size: 12.5px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.bu-tab-btn:hover {
  background: #E2E8F0;
  color: var(--bu-navy);
}
.bu-tab-btn.active {
  background: var(--bu-navy);
  color: var(--bu-gold);
  border-color: var(--bu-navy);
  box-shadow: 0 4px 12px rgba(10, 27, 84, 0.16);
}
.bu-tab-count {
  background: rgba(255, 255, 255, 0.2);
  color: inherit;
  font-size: 10.5px;
  font-weight: 800;
  padding: 2px 7px;
  border-radius: 10px;
}
.bu-tab-btn.active .bu-tab-count {
  background: rgba(255, 193, 7, 0.25);
  color: #ffffff;
}

.bu-dl-search {
  position: relative;
  min-width: 280px;
  flex-shrink: 0;
}
.bu-dl-search input {
  width: 100%;
  height: 42px;
  background: #F8FAFC;
  border: 1px solid var(--bu-border);
  border-radius: 8px;
  padding: 0 16px 0 38px;
  font-size: 13.5px;
  color: var(--bu-text-dark);
  outline: none;
  transition: all 0.2s;
  box-sizing: border-box;
}
.bu-dl-search input:focus {
  background: #ffffff;
  border-color: var(--bu-navy);
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.08);
}
.bu-dl-search i {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #94A3B8;
  font-size: 14px;
}

/* Cards Grid */
.bu-dl-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 22px;
  margin-bottom: 45px;
}
.bu-dl-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 24px 26px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(10, 27, 84, 0.04);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.bu-dl-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 5px; height: 100%;
  background: var(--bu-navy);
  transition: background 0.3s ease;
}
.bu-dl-card:hover {
  transform: translateY(-4px);
  border-color: #CBD5E1;
  box-shadow: 0 14px 30px rgba(10, 27, 84, 0.1);
}
.bu-dl-card:hover::before {
  background: var(--bu-gold);
}

.bu-dl-card-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 14px;
  gap: 10px;
}
.bu-dl-cat-badge {
  font-size: 11px;
  font-weight: 800;
  color: var(--bu-navy);
  background: rgba(10, 27, 84, 0.06);
  padding: 4px 10px;
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.8px;
}
.bu-dl-format-tag {
  font-size: 11px;
  font-weight: 700;
  color: #DC2626;
  background: #FEF2F2;
  border: 1px solid #FECACA;
  padding: 3px 9px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.bu-dl-title {
  font-size: 17.5px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0 0 8px;
  line-height: 1.35;
}
.bu-dl-desc {
  font-size: 13px;
  color: var(--bu-text-muted);
  line-height: 1.55;
  margin-bottom: 18px;
}

.bu-dl-meta-strip {
  display: flex;
  align-items: center;
  gap: 16px;
  font-size: 12px;
  color: #64748B;
  margin-bottom: 20px;
  padding-bottom: 16px;
  border-bottom: 1px dashed #E2E8F0;
  flex-wrap: wrap;
}
.bu-dl-meta-strip span {
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.bu-dl-meta-strip i {
  color: var(--bu-gold-dark);
}

.bu-dl-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-btn-dl {
  background: var(--bu-navy);
  color: #ffffff !important;
  font-size: 13px;
  font-weight: 700;
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.25s ease;
  border: 1px solid var(--bu-navy);
}
.bu-btn-dl:hover {
  background: var(--bu-navy-light);
  color: var(--bu-gold) !important;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(10, 27, 84, 0.2);
}
.bu-btn-view {
  background: #F8FAFC;
  color: var(--bu-navy) !important;
  font-size: 13px;
  font-weight: 700;
  padding: 10px 18px;
  border-radius: 8px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  border: 1px solid var(--bu-border);
  transition: all 0.2s ease;
}
.bu-btn-view:hover {
  background: #ffffff;
  border-color: var(--bu-navy);
  color: var(--bu-navy) !important;
}

/* Submission Steps Guide Box */
.bu-guide-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  padding: 35px 40px;
  margin-bottom: 40px;
  box-shadow: 0 4px 20px rgba(10, 27, 84, 0.04);
}
.bu-guide-header {
  margin-bottom: 25px;
}
.bu-guide-header h3 {
  font-size: 20px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 6px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-guide-header p {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  margin: 0;
}
.bu-steps-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}
.bu-step-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 20px;
  position: relative;
}
.bu-step-num {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  background: var(--bu-navy);
  color: var(--bu-gold);
  font-size: 14px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 12px;
}
.bu-step-box h4 {
  font-size: 14.5px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0 0 6px;
}
.bu-step-box p {
  font-size: 12.5px;
  color: var(--bu-text-muted);
  line-height: 1.5;
  margin: 0;
}

/* Support Help Banner */
.bu-support-banner {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 60%, #051235 100%);
  border-radius: 16px;
  padding: 30px 40px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  box-shadow: 0 10px 30px rgba(10, 27, 84, 0.15);
  flex-wrap: wrap;
}
.bu-support-info h4 {
  font-size: 20px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 6px;
}
.bu-support-info p {
  font-size: 13.5px;
  color: #CBD5E1;
  margin: 0;
  line-height: 1.5;
}
.bu-support-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}
.bu-btn-helpline {
  background: var(--bu-gold);
  color: var(--bu-navy) !important;
  font-size: 13.5px;
  font-weight: 800;
  padding: 11px 22px;
  border-radius: 8px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s ease;
}
.bu-btn-helpline:hover {
  background: #ffffff;
  color: var(--bu-navy) !important;
  transform: translateY(-2px);
}
.bu-btn-email {
  background: rgba(255, 255, 255, 0.12);
  color: #ffffff !important;
  border: 1px solid rgba(255, 255, 255, 0.3);
  font-size: 13.5px;
  font-weight: 700;
  padding: 11px 20px;
  border-radius: 8px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s ease;
}
.bu-btn-email:hover {
  background: #ffffff;
  color: var(--bu-navy) !important;
}

/* Empty State */
.bu-empty-state {
  grid-column: 1 / -1;
  background: #ffffff;
  border: 1.5px dashed #CBD5E1;
  border-radius: 12px;
  padding: 40px;
  text-align: center;
  display: none;
}
.bu-empty-state i {
  font-size: 36px;
  color: #94A3B8;
  margin-bottom: 12px;
}
.bu-empty-state h4 {
  font-size: 16px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0 0 4px;
}
.bu-empty-state p {
  font-size: 13px;
  color: var(--bu-text-muted);
  margin: 0;
}

@media (max-width: 992px) {
  .bu-feature-strip { grid-template-columns: repeat(2, 1fr); }
  .bu-steps-grid { grid-template-columns: repeat(2, 1fr); }
  .bu-dl-grid { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
  .bu-feature-strip { grid-template-columns: 1fr; }
  .bu-steps-grid { grid-template-columns: 1fr; }
  .bu-dl-toolbar { flex-direction: column; align-items: stretch; }
  .bu-dl-search { width: 100%; }
  .bu-guide-card { padding: 25px 20px; }
  .bu-support-banner { padding: 25px 20px; text-align: center; justify-content: center; }
  .bu-support-actions { justify-content: center; width: 100%; }
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- INNER HERO BANNER (Matches Home Page Luxury Gradient) -->
  <?php
  $page_title    = portalVal($portalPage, 'heading', 'Student Form <em>Downloads</em>');
  $page_subtitle = portalVal($portalPage, 'subheading', 'Official university application forms, certificate requests, mark sheet duplicate requisitions, and student verification documents.');
  $page_icon     = 'fa-download';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Student Portal', 'url' => href('admissions.php')],
    ['label' => 'Form Downloads', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <!-- MAIN CONTENT WRAPPER -->
  <div class="bu-dl-wrap">
    <div class="bu-dl-container">

      <!-- Section Title & Intro -->
      <div class="bu-sec-header">
        <span class="bu-sec-badge"><i class="fa fa-folder-open"></i> <?php echo portalVal($portalPage, 'badge', 'Student Portal &bull; Official Downloads'); ?></span>
        <h2 class="bu-sec-heading"><?php echo portalVal($portalPage, 'heading', 'Prescribed <em>Application Forms &amp; Circulars</em>'); ?></h2>
        <p class="bu-sec-sub">
          <?php echo portalVal($portalPage, 'subheading', 'Download prescribed university application formats for degree award, migration certificates, transcript issuance, duplicate marksheets, and student examination notices.'); ?>
        </p>
      </div>

      <!-- 4 Assurance Feature Cards -->
      <div class="bu-feature-strip">
        <div class="bu-feature-pill">
          <div class="bu-feature-icon"><i class="fa fa-file-pdf-o"></i></div>
          <div class="bu-feature-text">
            <strong>Standard A4 Format</strong>
            <span>Print-ready PDFs with official university layout</span>
          </div>
        </div>
        <div class="bu-feature-pill">
          <div class="bu-feature-icon"><i class="fa fa-shield"></i></div>
          <div class="bu-feature-text">
            <strong>Statutory Formats</strong>
            <span>Prescribed by Examination &amp; Registrar branch</span>
          </div>
        </div>
        <div class="bu-feature-pill">
          <div class="bu-feature-icon"><i class="fa fa-bolt"></i></div>
          <div class="bu-feature-text">
            <strong>Instant Downloads</strong>
            <span>Direct high-speed downloads without registration</span>
          </div>
        </div>
        <div class="bu-feature-pill">
          <div class="bu-feature-icon"><i class="fa fa-university"></i></div>
          <div class="bu-feature-text">
            <strong>Counter Acceptance</strong>
            <span>Accepted across all constituent institutes</span>
          </div>
        </div>
      </div>

      <!-- Filter & Search Toolbar -->
      <div class="bu-dl-toolbar">
        <div class="bu-dl-tabs">
          <button class="bu-tab-btn active" onclick="filterForms('all', this)">
            All Forms <span class="bu-tab-count" id="countAll">5</span>
          </button>
          <button class="bu-tab-btn" onclick="filterForms('certificates', this)">
            Certificates &amp; Degrees <span class="bu-tab-count">2</span>
          </button>
          <button class="bu-tab-btn" onclick="filterForms('marksheet', this)">
            Marksheets <span class="bu-tab-count">1</span>
          </button>
          <button class="bu-tab-btn" onclick="filterForms('migration', this)">
            Migration &amp; Transcript <span class="bu-tab-count">2</span>
          </button>
          <button class="bu-tab-btn" onclick="filterForms('fees', this)">
            Fee Notices <span class="bu-tab-count">1</span>
          </button>
        </div>

        <div class="bu-dl-search">
          <i class="fa fa-search"></i>
          <input type="text" id="formSearchInput" placeholder="Search forms (e.g. Migration, Degree, Fees)..." onkeyup="searchForms(this.value)">
        </div>
      </div>

      <!-- Forms Download Cards Grid -->
      <div class="bu-dl-grid" id="formsGrid">
        <?php
        $default_forms = [
          [
            'title'    => 'Notice University Certificate (Fees)',
            'category' => 'Fee Notices',
            'code'     => 'fees',
            'desc'     => 'Official notification outlining fee schedules, charges, and guidelines for obtaining university certificates.',
            'url'      => 'upload/media/43220e47ba4dc41f2feedaa84d2b75b1.pdf'
          ],
          [
            'title'    => 'Issue of Duplicate Name Correction In MarkSheet New',
            'category' => 'Marksheets',
            'code'     => 'marksheet',
            'desc'     => 'Statutory application form for issuance of duplicate mark sheets and corrections in student or parent names.',
            'url'      => 'upload/media/4dfae40cb8bf1f1b5d0fb8b63d542672.pdf'
          ],
          [
            'title'    => 'Application Form for Issue of Provisional / Migration Certificate',
            'category' => 'Migration & Transcript',
            'code'     => 'migration',
            'desc'     => 'Requisition form for students seeking Provisional Degree or University Migration Certificate for higher studies.',
            'url'      => 'upload/media/019c18458f2b9b6485deb792fc7c3c2b.pdf'
          ],
          [
            'title'    => 'Application for Issue of Degree Certificate',
            'category' => 'Certificates & Degrees',
            'code'     => 'certificates',
            'desc'     => 'Prescribed application form for award of final Convocation Degree Certificate by Bhabha University.',
            'url'      => 'upload/media/9feec28a9ceec19a4a7cef2f7f07795a.pdf'
          ],
          [
            'title'    => 'Application Form for Issue of Transcript',
            'category' => 'Migration & Transcript',
            'code'     => 'migration',
            'desc'     => 'Official application form for issuing academic transcripts and verified credentials for employment or studies abroad.',
            'url'      => 'upload/media/Application Form for Issue of transcript (1).pdf'
          ]
        ];

        // Dynamic binding from portal data or fallback to production forms
        $formsData = (!empty($portalPage['data']['forms']) && is_array($portalPage['data']['forms'])) 
                      ? $portalPage['data']['forms'] 
                      : ((!empty($portalPage['data']['downloads']) && is_array($portalPage['data']['downloads'])) ? $portalPage['data']['downloads'] : $default_forms);

        foreach ($formsData as $idx => $item):
          $title = $item['title'] ?? 'Download Form';
          $rawUrl = $item['url'] ?? '#';
          $pdfUrl = strpos($rawUrl, 'http') === 0 ? $rawUrl : URL_ROOT . ltrim($rawUrl, '/');
          
          // Auto-categorize if not provided
          $cat = $item['category'] ?? '';
          $code = $item['code'] ?? '';
          $desc = $item['desc'] ?? '';
          if (empty($code)) {
            $tLower = strtolower($title);
            if (strpos($tLower, 'fee') !== false) {
              $code = 'fees'; $cat = 'Fee Notices';
              $desc = 'Official notification outlining fee schedules and payment guidelines for university credentials.';
            } elseif (strpos($tLower, 'marksheet') !== false || strpos($tLower, 'name') !== false) {
              $code = 'marksheet'; $cat = 'Marksheets';
              $desc = 'Requisition form for duplicate marksheet issuance and record corrections.';
            } elseif (strpos($tLower, 'migration') !== false || strpos($tLower, 'provisional') !== false || strpos($tLower, 'transcript') !== false) {
              $code = 'migration'; $cat = 'Migration & Transcript';
              $desc = 'Official application for obtaining migration, provisional certificates or verified transcripts.';
            } else {
              $code = 'certificates'; $cat = 'Certificates & Degrees';
              $desc = 'Prescribed format for obtaining official degree awards and university credentials.';
            }
          }
        ?>
        <div class="bu-dl-card" data-cat="<?php echo htmlspecialchars($code); ?>" data-search="<?php echo htmlspecialchars(strtolower($title . ' ' . $cat . ' ' . $desc)); ?>">
          <div>
            <div class="bu-dl-card-top">
              <span class="bu-dl-cat-badge"><?php echo htmlspecialchars($cat); ?></span>
              <span class="bu-dl-format-tag"><i class="fa fa-file-pdf-o"></i> PDF FORM</span>
            </div>

            <h3 class="bu-dl-title"><?php echo htmlspecialchars($title); ?></h3>
            <p class="bu-dl-desc"><?php echo htmlspecialchars($desc); ?></p>

            <div class="bu-dl-meta-strip">
              <span><i class="fa fa-university"></i> Registrar Office</span>
              <span><i class="fa fa-check-circle text-success"></i> Official Format</span>
              <span><i class="fa fa-print"></i> Printable A4</span>
              <span><i class="fa fa-language"></i> English</span>
            </div>
          </div>

          <div class="bu-dl-actions">
            <a href="<?php echo $pdfUrl; ?>" target="_blank" download class="bu-btn-dl">
              <i class="fa fa-download"></i> Download PDF
            </a>
            <a href="<?php echo $pdfUrl; ?>" target="_blank" class="bu-btn-view">
              <i class="fa fa-eye"></i> View Online
            </a>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Empty Search Result State -->
        <div class="bu-empty-state" id="emptyState">
          <i class="fa fa-search"></i>
          <h4>No Matching Forms Found</h4>
          <p>Please try searching with different keywords like 'Degree', 'Migration', 'Fees', or 'Transcript'.</p>
        </div>
      </div>

      <!-- Step-by-Step Submission Procedure Guide -->
      <div class="bu-guide-card">
        <div class="bu-guide-header">
          <h3><i class="fa fa-tasks text-warning"></i> Guidelines for Form Submission</h3>
          <p>Follow these standard steps to ensure seamless processing of your academic requisitions.</p>
        </div>

        <div class="bu-steps-grid">
          <div class="bu-step-box">
            <div class="bu-step-num">1</div>
            <h4>Download &amp; Print</h4>
            <p>Download the required prescribed PDF form and take a clear, high-resolution printout on standard A4 paper.</p>
          </div>

          <div class="bu-step-box">
            <div class="bu-step-num">2</div>
            <h4>Fill Required Fields</h4>
            <p>Accurately fill in your Enrollment Number, Roll Number, Course, Department, Year, and active contact details.</p>
          </div>

          <div class="bu-step-box">
            <div class="bu-step-num">3</div>
            <h4>Attach Enclosures</h4>
            <p>Attach self-attested copies of previous semester marksheets, identity proof, and the requisite fee payment slip.</p>
          </div>

          <div class="bu-step-box">
            <div class="bu-step-num">4</div>
            <h4>Submit at Counter</h4>
            <p>Submit the completed form in person at the University Student Section / Registrar Desk or send via registered post.</p>
          </div>
        </div>
      </div>

      <!-- Support Helpline Banner -->
      <div class="bu-support-banner">
        <div class="bu-support-info">
          <h4><i class="fa fa-question-circle text-warning"></i> Need Help with Form Submission?</h4>
          <p>Our Student Welfare &amp; Verification Desk is here to guide you Monday to Saturday, 10:00 AM – 5:00 PM.</p>
        </div>

        <div class="bu-support-actions">
          <a href="tel:07554246498" class="bu-btn-helpline">
            <i class="fa fa-phone"></i> 0755-4246498
          </a>
          <a href="mailto:info@bhabhauniversity.edu.in" class="bu-btn-email">
            <i class="fa fa-envelope"></i> info@bhabhauniversity.edu.in
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- JAVASCRIPT FOR INSTANT FILTERING & SEARCH -->
<script>
function filterForms(category, btnElement) {
  // Update active tab button
  var tabButtons = document.querySelectorAll('.bu-tab-btn');
  tabButtons.forEach(function(btn) {
    btn.classList.remove('active');
  });
  btnElement.classList.add('active');

  // Filter cards
  var cards = document.querySelectorAll('.bu-dl-card');
  var visibleCount = 0;

  cards.forEach(function(card) {
    var cardCat = card.getAttribute('data-cat');
    if (category === 'all' || cardCat === category) {
      card.style.display = 'flex';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  // Empty state check
  var emptyState = document.getElementById('emptyState');
  if (visibleCount === 0) {
    emptyState.style.display = 'block';
  } else {
    emptyState.style.display = 'none';
  }
}

function searchForms(query) {
  var term = query.trim().toLowerCase();
  var cards = document.querySelectorAll('.bu-dl-card');
  var visibleCount = 0;

  // Reset tab to all
  var tabButtons = document.querySelectorAll('.bu-tab-btn');
  tabButtons.forEach(function(btn, idx) {
    if (idx === 0) btn.classList.add('active');
    else btn.classList.remove('active');
  });

  cards.forEach(function(card) {
    var searchContent = card.getAttribute('data-search');
    if (!term || searchContent.indexOf(term) !== -1) {
      card.style.display = 'flex';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  var emptyState = document.getElementById('emptyState');
  if (visibleCount === 0) {
    emptyState.style.display = 'block';
  } else {
    emptyState.style.display = 'none';
  }
}
</script>

<?php include('inc.footer.js.php');?>
</body>
</html>
