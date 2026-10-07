<?php include('config.php');
$raw_id = isset($_REQUEST['id']) ? trim($_REQUEST['id']) : '1';
$id = intval($raw_id);
$aryData = null;

if ($id > 0 && isset($db) && is_object($db)) {
    try {
        $db->where('id', $id);
        $aryData = $db->getOne('course');
    } catch (\Throwable $e) {}
}

// Fallback search by course name if numeric ID wasn't found
if (!$aryData && !empty($raw_id) && isset($db) && is_object($db)) {
    try {
        $clean_search = urldecode(str_replace(['+', '-'], ' ', $raw_id));
        $db->where('course', '%'.$clean_search.'%', 'LIKE');
        $aryData = $db->getOne('course');
    } catch (\Throwable $e) {}
}

// Resilient fallback for Integrated Courses (e.g. B.Sc. B.Ed. & BA B.Ed.) if not yet in database
if (!$aryData) {
    if ($id === 55 || stripos($raw_id, 'bsc') !== false || stripos($raw_id, 'b.sc') !== false || stripos($raw_id, 'science') !== false) {
        $aryData = [
            'id' => 55,
            'program' => 6,
            'course' => 'B.Sc. B.Ed. (4 Years Integrated)',
            'department' => 6,
            'details' => '<table border="1" cellpadding="0" cellspacing="0" style="width:100%; border-collapse:collapse; margin-top:15px;"><thead><tr style="background:#0A1B54; color:#ffffff;"><th colspan="4" style="padding:14px; text-align:left; font-size:16px;">COLLEGE - BHABHA COLLEGE OF EDUCATION, BHOPAL (APPROVED BY NCTE & UGC)</th></tr><tr style="background:#f8f9fa;"><th style="padding:12px; border:1px solid #ddd; text-align:left; color:#0A1B54;">COURSE</th><th style="padding:12px; border:1px solid #ddd; text-align:center; color:#0A1B54;">DURATION</th><th style="padding:12px; border:1px solid #ddd; text-align:center; color:#0A1B54;">SEATS</th><th style="padding:12px; border:1px solid #ddd; text-align:left; color:#0A1B54;">ELIGIBILITY & ADMISSION CRITERIA</th></tr></thead><tbody><tr><td style="padding:14px; border:1px solid #ddd; vertical-align:top;"><strong style="color:#0A1B54; font-size:15px;">B.Sc. B.Ed. (4 Years Integrated Course)</strong><br><span style="font-size:12.5px; color:#64748B;">Department: Faculty of Education & Science</span><br><span style="display:inline-block; margin-top:6px; padding:3px 8px; background:#EEF2FF; color:#1E40AF; border-radius:4px; font-size:11px; font-weight:700;">NCTE Approved 4-Year Integrated Dual Degree</span></td><td style="padding:14px; border:1px solid #ddd; text-align:center; vertical-align:top; font-weight:700; color:#374151;">4 Years<br><span style="font-size:11.5px; font-weight:normal; color:#6B7280;">(8 Semesters)</span></td><td style="padding:14px; border:1px solid #ddd; text-align:center; vertical-align:top; font-weight:700; color:#0A1B54; font-size:15px;">50 Seats</td><td style="padding:14px; border:1px solid #ddd; vertical-align:top; font-size:13px; line-height:1.7; color:#374151;"><p style="margin:0 0 8px 0;"><strong>1. Academic Eligibility:</strong> Candidates must have passed Senior Secondary / 10+2 examination or equivalent with Science stream (Physics, Chemistry, and Mathematics/Biology) from a recognized Board with a minimum of <strong>50% aggregate marks</strong>.</p><p style="margin:0 0 8px 0;"><strong>2. Relaxation:</strong> A relaxation of <strong>5% marks</strong> in the qualifying examination is allowed for candidates belonging to SC / ST / OBC categories as per NCTE and MP State Government rules (Minimum 45%).</p><p style="margin:0;"><strong>3. Admission Mode:</strong> Merit-based admission through university counseling or MP Higher Education Department portal guidelines.</p></td></tr></tbody></table>',
            'status' => 1
        ];
    } elseif ($id === 56 || stripos($raw_id, 'ba') !== false || stripos($raw_id, 'arts') !== false) {
        $aryData = [
            'id' => 56,
            'program' => 6,
            'course' => 'BA B.Ed. (4 Years Integrated)',
            'department' => 6,
            'details' => '<table border="1" cellpadding="0" cellspacing="0" style="width:100%; border-collapse:collapse; margin-top:15px;"><thead><tr style="background:#0A1B54; color:#ffffff;"><th colspan="4" style="padding:14px; text-align:left; font-size:16px;">COLLEGE - BHABHA COLLEGE OF EDUCATION, BHOPAL (APPROVED BY NCTE & UGC)</th></tr><tr style="background:#f8f9fa;"><th style="padding:12px; border:1px solid #ddd; text-align:left; color:#0A1B54;">COURSE</th><th style="padding:12px; border:1px solid #ddd; text-align:center; color:#0A1B54;">DURATION</th><th style="padding:12px; border:1px solid #ddd; text-align:center; color:#0A1B54;">SEATS</th><th style="padding:12px; border:1px solid #ddd; text-align:left; color:#0A1B54;">ELIGIBILITY & ADMISSION CRITERIA</th></tr></thead><tbody><tr><td style="padding:14px; border:1px solid #ddd; vertical-align:top;"><strong style="color:#0A1B54; font-size:15px;">BA B.Ed. (4 Years Integrated Course)</strong><br><span style="font-size:12.5px; color:#64748B;">Department: Faculty of Education & Arts</span><br><span style="display:inline-block; margin-top:6px; padding:3px 8px; background:#EEF2FF; color:#1E40AF; border-radius:4px; font-size:11px; font-weight:700;">NCTE Approved 4-Year Integrated Dual Degree</span></td><td style="padding:14px; border:1px solid #ddd; text-align:center; vertical-align:top; font-weight:700; color:#374151;">4 Years<br><span style="font-size:11.5px; font-weight:normal; color:#6B7280;">(8 Semesters)</span></td><td style="padding:14px; border:1px solid #ddd; text-align:center; vertical-align:top; font-weight:700; color:#0A1B54; font-size:15px;">50 Seats</td><td style="padding:14px; border:1px solid #ddd; vertical-align:top; font-size:13px; line-height:1.7; color:#374151;"><p style="margin:0 0 8px 0;"><strong>1. Academic Eligibility:</strong> Candidates must have passed Senior Secondary / 10+2 examination or equivalent in any stream from a recognized Board with a minimum of <strong>50% aggregate marks</strong>.</p><p style="margin:0 0 8px 0;"><strong>2. Relaxation:</strong> A relaxation of <strong>5% marks</strong> in qualifying exam is allowed for SC / ST / OBC candidates (Minimum 45%).</p><p style="margin:0;"><strong>3. Admission Mode:</strong> Merit-based admission through university counseling or MP Higher Education guidelines.</p></td></tr></tbody></table>',
            'status' => 1
        ];
    } else {
        redirect(href("course.php"));
        exit;
    }
}

$department = null;
if (!empty($aryData['department']) && isset($db) && is_object($db)) {
    try {
        $db->where('id', $aryData['department']);
        $department = $db->getOne('department');
    } catch (\Throwable $e) {}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['course']);?> - Intake & Eligibility - Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($aryData['course']);?> eligibility criteria, seat intake capacity, duration, and admission requirements at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

/* Styled Table Content for Eligibility */
.bu-content-body table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 20px 0 !important;
  font-size: 14px !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  box-shadow: 0 4px 16px rgba(6,29,124,0.05) !important;
}
.bu-content-body table th {
  background: #0A1B54 !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
  padding: 14px 18px !important;
  text-align: left !important;
  border-bottom: 2px solid #061D7C !important;
}
.bu-content-body table td {
  padding: 14px 18px !important;
  border-bottom: 1px solid #E5E7EB !important;
  color: #374151 !important;
  line-height: 1.6 !important;
}
.bu-content-body table tr:nth-child(even) {
  background: #F8FAFC !important;
}
.bu-content-body table tr:hover {
  background: #F1F5F9 !important;
}
.bu-content-body table th,
.bu-content-body table td {
  word-break: normal !important;
}
.bu-content-body table th:nth-child(1),
.bu-content-body table td:nth-child(1) {
  min-width: 150px !important;
}
.bu-content-body table th:nth-child(2),
.bu-content-body table td:nth-child(2) {
  min-width: 200px !important;
}

.bu-cta-box {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  border-radius: 10px;
  padding: 30px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  margin-top: 30px;
  flex-wrap: wrap;
}
.bu-cta-box h3 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 6px 0;
}
.bu-cta-box p {
  font-size: 13.5px;
  color: rgba(255,255,255,0.75);
  margin: 0;
}
.bu-btn-apply {
  background: #FFC107;
  color: #0A1B54;
  font-weight: 800;
  font-size: 13.5px;
  padding: 14px 28px;
  border-radius: 6px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s ease;
  flex-shrink: 0;
}
.bu-btn-apply:hover {
  background: #ffffff;
  color: #061D7C;
  transform: translateY(-2px);
  text-decoration: none;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = htmlspecialchars($aryData['course']);
  $page_subtitle = 'Course details, seat intake, duration, and entry eligibility criteria.';
  $page_icon     = 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Courses & Intake', 'url' => href("course.php")],
    ['label' => isset($department['title']) ? $department['title'] : 'Institute', 'url' => isset($department['id']) ? href("program.php", "id=".$department['id']) : '#'],
    ['label' => $aryData['course'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Academic Specifications</span>
        <h2 class="bu-content-h2"><?php echo htmlspecialchars($aryData['course']);?> — <em>Intake &amp; Eligibility</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-content-body">
          <?php 
          if(!empty($aryData['details'])) {
              echo $aryData['details'];
          } else {
              echo '<p style="font-size:14px;color:#6B7280;">Eligibility details for this program are being updated. Please contact the admission helpline for instant assistance.</p>';
          }
          ?>
        </div>

        <!-- Quick Apply Callout Banner -->
        <div class="bu-cta-box">
          <div>
            <h3>Ready to Join <?php echo htmlspecialchars($aryData['course']);?>?</h3>
            <p>Submit your admission enquiry online to get connected with our faculty advisors.</p>
          </div>
          <a href="<?php echo href("enquiry.php") . '?course=' . urlencode($aryData['course']);?>" class="bu-btn-apply">Apply For Admission <i class="fa fa-arrow-right" style="margin-left:6px;"></i></a>
        </div>
      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
