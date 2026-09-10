<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'student_publications.php');
define("TITLE", 'Student & Publications');
define("CATEGORY", 'student_publications');
define("DBTAB", 'site_portal_pages');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Quick status toggle via GET
if ($action == "toggle_status" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $db->where('category', CATEGORY);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $newStatus = ($curr['status'] == 1) ? 0 : 1;
        $db->where('id', $id);
        $db->update(DBTAB, ['status' => $newStatus, 'updated_at' => date('Y-m-d H:i:s')]);
        $_SESSION["success"] = 'Status updated for "' . $curr['page_title'] . '"!';
    }
    redirect(PAGE);
}

// Helper function for uploading PDFs
function handleMagPdfUpload($fileInput, $fallbackUrl = '') {
    if (isset($_FILES[$fileInput]) && !empty($_FILES[$fileInput]['name'])) {
        $uploadDir = '../upload/media/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }
        $origName = basename($_FILES[$fileInput]['name']);
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $allowed = ['pdf', 'doc', 'docx', 'jpg', 'png', 'webp'];
        if (in_array($ext, $allowed)) {
            $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
            $fileName = $cleanBase . '_' . time() . '.' . $ext;
            if (move_uploaded_file($_FILES[$fileInput]['tmp_name'], $uploadDir . $fileName)) {
                return 'upload/media/' . $fileName;
            }
        }
    }
    return $fallbackUrl;
}

// Helper function for uploading array-based media/PDFs
function handleArrayMediaUpload($fileInputKey, $index, $fallbackUrl = '') {
    if (isset($_FILES[$fileInputKey]['name'][$index]) && !empty($_FILES[$fileInputKey]['name'][$index])) {
        if (isset($_FILES[$fileInputKey]['error'][$index]) && $_FILES[$fileInputKey]['error'][$index] === UPLOAD_ERR_OK) {
            $uploadDir = '../upload/media/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $origName = basename($_FILES[$fileInputKey]['name'][$index]);
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'webp'];
            if (in_array($ext, $allowed)) {
                $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                $fileName = $cleanBase . '_' . time() . '_' . $index . '.' . $ext;
                if (move_uploaded_file($_FILES[$fileInputKey]['tmp_name'][$index], $uploadDir . $fileName)) {
                    return 'upload/media/' . $fileName;
                }
            }
        }
    }
    return $fallbackUrl;
}

// Handle Form Submission
if (isset($_POST['submit'])) {
    $id = intval($_POST['id'] ?? 0);
    $db->where('id', $id);
    $db->where('category', CATEGORY);
    $pageRow = $db->getOne(DBTAB);

    if (!$pageRow) {
        $_SESSION['error'] = 'Page not found.';
        redirect(PAGE);
    }

    $pageKey = $pageRow['page_key'];

    // Common metadata
    $data = [
        'page_title' => trim($_POST['page_title'] ?? $pageRow['page_title']),
        'badge'      => trim($_POST['badge'] ?? ''),
        'heading'    => trim($_POST['heading'] ?? ''),
        'subheading' => trim($_POST['subheading'] ?? ''),
        'status'     => isset($_POST['status']) ? intval($_POST['status']) : 1,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $contentData = !empty($pageRow['content_data']) ? json_decode($pageRow['content_data'], true) : [];
    if (!is_array($contentData)) {
        $contentData = [];
    }

    // 1. Admissions
    if ($pageKey == 'admissions') {
        $steps = [];
        $sNums   = $_POST['step_num'] ?? [];
        $sTitles = $_POST['step_title'] ?? [];
        $sDescs  = $_POST['step_desc'] ?? [];
        for ($i = 0; $i < count($sTitles); $i++) {
            if (!empty($sTitles[$i])) {
                $steps[] = [
                    'step'  => !empty($sNums[$i]) ? trim($sNums[$i]) : sprintf("%02d", $i + 1),
                    'title' => trim($sTitles[$i]),
                    'desc'  => trim($sDescs[$i] ?? '')
                ];
            }
        }
        $contentData['steps'] = $steps;
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    }
    // 2. Scholarship
    elseif ($pageKey == 'scholarship') {
        $schemes = [];
        $scTitles = $_POST['scheme_title'] ?? [];
        $scAuths  = $_POST['scheme_authority'] ?? [];
        $scDescs  = $_POST['scheme_desc'] ?? [];
        for ($i = 0; $i < count($scTitles); $i++) {
            if (!empty($scTitles[$i])) {
                $schemes[] = [
                    'title'     => trim($scTitles[$i]),
                    'authority' => trim($scAuths[$i] ?? ''),
                    'desc'      => trim($scDescs[$i] ?? '')
                ];
            }
        }
        $contentData['schemes'] = $schemes;
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    }
    // 3. Career & 4. Activities
    elseif ($pageKey == 'career' || $pageKey == 'activities') {
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    }
    // 5. Magazine
    elseif ($pageKey == 'magazine') {
        $flagPdf = trim($_POST['flag_pdf_url'] ?? '');
        $flagPdf = handleMagPdfUpload('flag_pdf_file', $flagPdf);

        $contentData['flagship'] = [
            'title'    => trim($_POST['flag_title'] ?? 'BHABHA SPANDAN'),
            'edition'  => trim($_POST['flag_edition'] ?? '2025 – 2026'),
            'subtitle' => trim($_POST['flag_subtitle'] ?? 'Annual University Magazine'),
            'desc'     => trim($_POST['flag_desc'] ?? ''),
            'pdf_url'  => $flagPdf
        ];

        // Archives
        $arcTitles = $_POST['arc_title'] ?? [];
        $arcThemes = $_POST['arc_theme'] ?? [];
        $arcUrls   = $_POST['arc_url'] ?? [];
        $archives = [];
        for ($i = 0; $i < count($arcTitles); $i++) {
            if (!empty($arcTitles[$i])) {
                $archives[] = [
                    'title' => trim($arcTitles[$i]),
                    'theme' => trim($arcThemes[$i] ?? ''),
                    'url'   => trim($arcUrls[$i] ?? '#')
                ];
            }
        }
        $contentData['archive'] = $archives;
    }
    // 6. Newsletter
    elseif ($pageKey == 'newsletter') {
        $nlPdf = trim($_POST['nl_pdf_url'] ?? '');
        $nlPdf = handleMagPdfUpload('nl_pdf_file', $nlPdf);

        // Process highlights textarea into array
        $rawHighlights = trim($_POST['nl_highlights'] ?? '');
        $highlights = [];
        if (!empty($rawHighlights)) {
            $lines = explode("\n", str_replace("\r", "", $rawHighlights));
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $highlights[] = $line;
                }
            }
        }

        $contentData['latest'] = [
            'title'      => trim($_POST['nl_title'] ?? 'Bhabha Chronicle — Q2 2026 Edition'),
            'volume'     => trim($_POST['nl_volume'] ?? 'Vol. 6 | Issue 2'),
            'period'     => trim($_POST['nl_period'] ?? 'Apr – Jun 2026'),
            'badge'      => trim($_POST['nl_badge'] ?? 'LATEST RELEASE'),
            'desc'       => trim($_POST['nl_desc'] ?? ''),
            'highlights' => $highlights,
            'pdf_url'    => $nlPdf
        ];

        // Archive / Quarterly Editions Repeater (Product Launch pattern)
        $archive = [];
        $itemTitles = $_POST['nl_item_title'] ?? [];
        $itemVols   = $_POST['nl_item_vol'] ?? [];
        $itemDates  = $_POST['nl_item_date'] ?? [];
        $itemSizes  = $_POST['nl_item_size'] ?? [];
        $itemTopics = $_POST['nl_item_topics'] ?? [];
        $itemUrls   = $_POST['nl_item_url'] ?? [];

        for ($i = 0; $i < count($itemTitles); $i++) {
            $title = trim($itemTitles[$i]);
            if (!empty($title)) {
                $fileUrl = handleArrayMediaUpload('nl_item_file', $i, trim($itemUrls[$i] ?? ''));

                $rawT = trim($itemTopics[$i] ?? '');
                $topicsArr = [];
                if (!empty($rawT)) {
                    $lines = explode("\n", str_replace("\r", "", $rawT));
                    foreach ($lines as $l) {
                        $l = trim($l);
                        if (!empty($l)) {
                            $topicsArr[] = $l;
                        }
                    }
                }

                $archive[] = [
                    'title'  => $title,
                    'vol'    => trim($itemVols[$i] ?? ''),
                    'date'   => trim($itemDates[$i] ?? ''),
                    'size'   => trim($itemSizes[$i] ?? '16 Pages • PDF'),
                    'topics' => $topicsArr,
                    'url'    => $fileUrl
                ];
            }
        }
        $contentData['archive'] = $archive;
    }
    // 7. Blogs
    elseif ($pageKey == 'blogs') {
        $bTitles   = $_POST['blog_title'] ?? [];
        $bAuthors  = $_POST['blog_author'] ?? [];
        $bCats     = $_POST['blog_cat'] ?? [];
        $bDates    = $_POST['blog_date'] ?? [];
        $bTimes    = $_POST['blog_time'] ?? [];
        $bSums     = $_POST['blog_sum'] ?? [];
        $articles = [];
        for ($i = 0; $i < count($bTitles); $i++) {
            if (!empty($bTitles[$i])) {
                $articles[] = [
                    'title'     => trim($bTitles[$i]),
                    'author'    => trim($bAuthors[$i] ?? 'Faculty Contributor'),
                    'category'  => trim($bCats[$i] ?? 'Academic'),
                    'date'      => trim($bDates[$i] ?? date('Y-m-d')),
                    'read_time' => trim($bTimes[$i] ?? '5 min read'),
                    'summary'   => trim($bSums[$i] ?? '')
                ];
            }
        }
        $contentData['articles'] = $articles;
    }

    $data['content_data'] = json_encode($contentData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $db->where('id', $id);
    $db->update(DBTAB, $data);

    $_SESSION['success'] = 'Page "' . $pageRow['page_title'] . '" updated successfully!';
    redirect(PAGE);
}

// Fetch stats for category
$allPages = $db->where('category', CATEGORY)->get(DBTAB);
$totalCount = count($allPages);
$activeCount = 0;
foreach ($allPages as $p) {
    if ($p['status'] == 1) $activeCount++;
}

// Map page_key to frontend URL
$urlMap = [
    'admissions'  => '../admissions.php',
    'scholarship' => '../scholarship.php',
    'career'      => '../career.php',
    'activities'  => '../activities.php',
    'magazine'    => '../magazine.php',
    'newsletter'  => '../newsletter.php',
    'blogs'       => '../blogs.php',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Admin Dashboard</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<style>
.dash-portal-hero {
  background: linear-gradient(135deg, #78350F 0%, #B45309 55%, #D97706 100%);
  color: #ffffff;
  border-radius: 12px;
  padding: 24px 28px;
  margin-bottom: 24px;
  box-shadow: 0 8px 24px rgba(120,53,15,0.18);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}
.dash-portal-title {
  font-size: 22px;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 4px;
}
.dash-portal-sub {
  font-size: 13px;
  color: #FEF3C7;
  margin: 0;
}
.kpi-mini-box {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 24px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.02);
}
.kpi-mini-icon {
  width: 46px;
  height: 46px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.kpi-mini-icon.amber  { background: #FEF3C7; color: #D97706; }
.kpi-mini-icon.green  { background: #ECFDF5; color: #059669; }
.kpi-mini-icon.blue   { background: #EFF6FF; color: #2563EB; }
.kpi-mini-num {
  font-size: 20px;
  font-weight: 700;
  color: #0F172A;
  line-height: 1.2;
}
.kpi-mini-label {
  font-size: 12px;
  color: #64748B;
  margin-top: 2px;
}
.card-section-box {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.simple-card-group {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 18px 20px;
  margin-bottom: 22px;
}
.simple-card-title {
  font-size: 14px;
  font-weight: 700;
  color: #78350F;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  border-bottom: 2px solid #E2E8F0;
  padding-bottom: 8px;
}
.simple-item-box {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  padding: 14px;
  height: 100%;
}
.badge-active { background-color: #28a745; color: #fff; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 11px; }
.badge-inactive { background-color: #dc3545; color: #fff; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 11px; }
</style>
</head>
<body>
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">

        <!-- Header Hero -->
        <div class="dash-portal-hero mt-3">
          <div>
            <h2 class="dash-portal-title"><i class="fa fa-book"></i> Student &amp; Publications Pillar</h2>
            <p class="dash-portal-sub">Admissions guidelines, scholarship concessions, career openings, campus life, university magazine (Bhabha Spandan), newsletters &amp; tech blogs.</p>
          </div>
          <div>
            <a href="dashboard.php" class="btn btn-sm btn-outline-light"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
          </div>
        </div>

        <?php if (!empty($stat['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle"></i> <?php echo $stat['success']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <?php if (!empty($stat['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle"></i> <?php echo $stat['error']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <?php if ($action == 'edit' && isset($_GET['id'])): 
          $id = intval($_GET['id']);
          $db->where('id', $id);
          $db->where('category', CATEGORY);
          $editPage = $db->getOne(DBTAB);
          if (!$editPage) {
              echo '<div class="alert alert-danger">Page not found. <a href="' . PAGE . '">Return to list</a></div>';
          } else {
              $pKey = $editPage['page_key'];
              $cData = !empty($editPage['content_data']) ? json_decode($editPage['content_data'], true) : [];
              if (!is_array($cData)) $cData = [];
              $liveUrl = $urlMap[$pKey] ?? '#';
        ?>

        <!-- EDIT FORM -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <div>
                  <h4 class="font-weight-bold mb-1" style="color:#B45309;">
                    <i class="fa fa-pencil-square-o"></i> Edit Page: <?php echo htmlspecialchars($editPage['page_title']); ?>
                  </h4>
                  <small class="text-muted">Unique Key: <code><?php echo htmlspecialchars($pKey); ?></code> &bull; Category: <span class="badge badge-warning">Student &amp; Publications</span></small>
                </div>
                <div>
                  <a href="<?php echo $liveUrl; ?>" target="_blank" class="btn btn-sm btn-outline-warning mr-2">
                    <i class="fa fa-external-link"></i> Live Preview
                  </a>
                  <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-secondary">
                    <i class="fa fa-times"></i> Cancel
                  </a>
                </div>
              </div>

              <form method="POST" action="<?php echo PAGE; ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $editPage['id']; ?>">

                <!-- 1. GENERAL METADATA -->
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-tags"></i> Header Banner &amp; Metadata
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="font-weight-bold">Browser Title (SEO)</label>
                        <input type="text" name="page_title" class="form-control" value="<?php echo htmlspecialchars($editPage['page_title']); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold">Badge Text</label>
                        <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($editPage['badge'] ?? ''); ?>" placeholder="e.g. Admission Gateway">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <select name="status" class="form-control">
                          <option value="1" <?php echo ($editPage['status'] == 1) ? 'selected' : ''; ?>>Active (Published)</option>
                          <option value="0" <?php echo ($editPage['status'] == 0) ? 'selected' : ''; ?>>Inactive (Draft)</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="font-weight-bold">Page / Section Heading</label>
                        <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($editPage['heading'] ?? ''); ?>" placeholder="e.g. Admissions <em>Overview</em>">
                        <small class="text-muted">Tip: Use <code>&lt;em&gt;</code> for highlight styling.</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="font-weight-bold">Subheading / Description</label>
                        <textarea name="subheading" class="form-control" rows="2"><?php echo htmlspecialchars($editPage['subheading'] ?? ''); ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- 2. SPECIFIC SECTION CONTENT -->

                <!-- A. Admissions (Steps) -->
                <?php if ($pKey == 'admissions'): 
                  $steps = !empty($cData['steps']) ? $cData['steps'] : [];
                ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-list-ol"></i> 4 Admission Application Steps
                  </div>
                  <div class="row">
                    <?php for ($i = 0; $i < 4; $i++): 
                      $st = $steps[$i] ?? ['step' => sprintf("%02d", $i + 1), 'title' => '', 'desc' => ''];
                    ?>
                    <div class="col-md-6 mb-3">
                      <div class="simple-item-box">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                          <label class="font-weight-bold mb-0" style="color:#B45309;">Step #<?php echo $i + 1; ?></label>
                          <div style="width:60px;">
                            <input type="text" name="step_num[]" class="form-control form-control-sm text-center font-weight-bold" value="<?php echo htmlspecialchars($st['step'] ?? sprintf("%02d", $i + 1)); ?>">
                          </div>
                        </div>
                        <div class="form-group mb-2">
                          <small class="text-muted">Step Title</small>
                          <input type="text" name="step_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['title'] ?? ''); ?>" placeholder="Choose Your Program">
                        </div>
                        <div class="form-group mb-0">
                          <small class="text-muted">Step Guidance</small>
                          <textarea name="step_desc[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($st['desc'] ?? ''); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>
                <?php endif; ?>

                <!-- B. Scholarship (Schemes) -->
                <?php if ($pKey == 'scholarship'): 
                  $schemes = !empty($cData['schemes']) ? $cData['schemes'] : [];
                ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-graduation-cap"></i> Scholarship &amp; Fee Concession Schemes
                  </div>
                  <div class="row">
                    <?php for ($i = 0; $i < 3; $i++): 
                      $sc = $schemes[$i] ?? ['title' => '', 'authority' => '', 'desc' => ''];
                    ?>
                    <div class="col-md-4 mb-3">
                      <div class="simple-item-box">
                        <label class="font-weight-bold" style="color:#B45309;">Scheme #<?php echo $i + 1; ?></label>
                        <div class="form-group mb-2">
                          <small class="text-muted">Scheme Name</small>
                          <input type="text" name="scheme_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($sc['title'] ?? ''); ?>" placeholder="Post-Matric Scholarship">
                        </div>
                        <div class="form-group mb-2">
                          <small class="text-muted">Sanctioning Body / Authority</small>
                          <input type="text" name="scheme_authority[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($sc['authority'] ?? ''); ?>" placeholder="Government of Madhya Pradesh">
                        </div>
                        <div class="form-group mb-0">
                          <small class="text-muted">Eligibility &amp; Concessions</small>
                          <textarea name="scheme_desc[]" class="form-control form-control-sm" rows="3"><?php echo htmlspecialchars($sc['desc'] ?? ''); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>
                <?php endif; ?>

                <!-- C. Career & Activities Narrative -->
                <?php if ($pKey == 'career' || $pKey == 'activities'): ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-file-text-o"></i> Institutional Narrative &amp; Guidelines (HTML supported)
                  </div>
                  <div class="form-group mb-0">
                    <textarea name="body" class="form-control" rows="8"><?php echo htmlspecialchars($cData['body'] ?? ''); ?></textarea>
                  </div>
                </div>
                <?php endif; ?>

                <!-- D. Magazine (Flagship + Archive) -->
                <?php if ($pKey == 'magazine'): 
                  $flag = !empty($cData['flagship']) ? $cData['flagship'] : [];
                  $arcs = !empty($cData['archive']) ? $cData['archive'] : [];
                ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-star text-warning"></i> Flagship Annual Magazine (Bhabha Spandan)
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="font-weight-bold">Magazine Title</label>
                        <input type="text" name="flag_title" class="form-control" value="<?php echo htmlspecialchars($flag['title'] ?? 'BHABHA SPANDAN'); ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold">Edition / Year</label>
                        <input type="text" name="flag_edition" class="form-control" value="<?php echo htmlspecialchars($flag['edition'] ?? '2025 – 2026'); ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold">Subtitle</label>
                        <input type="text" name="flag_subtitle" class="form-control" value="<?php echo htmlspecialchars($flag['subtitle'] ?? 'Annual University Magazine'); ?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="font-weight-bold">Editorial Description</label>
                        <textarea name="flag_desc" class="form-control" rows="3"><?php echo htmlspecialchars($flag['desc'] ?? ''); ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-0">
                        <label class="font-weight-bold">Upload Magazine PDF</label>
                        <input type="file" name="flag_pdf_file" class="form-control" accept=".pdf">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-0">
                        <label class="font-weight-bold">Existing PDF Link or URL</label>
                        <input type="text" name="flag_pdf_url" class="form-control" value="<?php echo htmlspecialchars($flag['pdf_url'] ?? ''); ?>" placeholder="upload/media/... or https://">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-archive"></i> Past Magazine Archive Editions
                  </div>
                  <div class="row">
                    <?php for ($i = 0; $i < 3; $i++): 
                      $ar = $arcs[$i] ?? ['title' => '', 'theme' => '', 'url' => ''];
                    ?>
                    <div class="col-md-4 mb-3">
                      <div class="simple-item-box">
                        <label class="font-weight-bold text-muted">Archive Edition #<?php echo $i + 1; ?></label>
                        <div class="form-group mb-2">
                          <small class="text-muted">Edition Title</small>
                          <input type="text" name="arc_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ar['title'] ?? ''); ?>" placeholder="Bhabha Spandan 2023-24">
                        </div>
                        <div class="form-group mb-2">
                          <small class="text-muted">Theme</small>
                          <input type="text" name="arc_theme[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ar['theme'] ?? ''); ?>" placeholder="Innovation & Future">
                        </div>
                        <div class="form-group mb-0">
                          <small class="text-muted">PDF Download URL</small>
                          <input type="text" name="arc_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ar['url'] ?? ''); ?>" placeholder="upload/media/...">
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>
                <?php endif; ?>

                <!-- E. Newsletter -->
                <?php if ($pKey == 'newsletter'): 
                  $nl = !empty($cData['latest']) ? $cData['latest'] : [];
                  $archives = !empty($cData['archive']) ? $cData['archive'] : [];
                  $nlHighlightsStr = '';
                  if (!empty($nl['highlights'])) {
                    $nlHighlightsStr = is_array($nl['highlights']) ? implode("\n", $nl['highlights']) : $nl['highlights'];
                  }
                ?>
                <!-- 1. Featured Current Issue -->
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-star text-warning"></i> Current Featured Newsletter Digest (Hero Banner)
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold">Newsletter Title</label>
                        <input type="text" name="nl_title" class="form-control" value="<?php echo htmlspecialchars($nl['title'] ?? 'Bhabha Chronicle — Q2 2026 Edition'); ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold">Volume / Issue</label>
                        <input type="text" name="nl_volume" class="form-control" value="<?php echo htmlspecialchars($nl['volume'] ?? 'Vol. 6 | Issue 2'); ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold">Quarter / Period</label>
                        <input type="text" name="nl_period" class="form-control" value="<?php echo htmlspecialchars($nl['period'] ?? 'Apr – Jun 2026'); ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="font-weight-bold">Cover Badge</label>
                        <input type="text" name="nl_badge" class="form-control" value="<?php echo htmlspecialchars($nl['badge'] ?? 'LATEST RELEASE'); ?>" placeholder="LATEST RELEASE">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="font-weight-bold">Digest Summary</label>
                        <textarea name="nl_desc" class="form-control" rows="3"><?php echo htmlspecialchars($nl['desc'] ?? ''); ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="font-weight-bold">Key Highlights / Milestones <span class="text-muted font-weight-normal">(One bullet point per line)</span></label>
                        <textarea name="nl_highlights" class="form-control" rows="3" placeholder="Launch of 14 Commercial Formulations&#10;Campus placement milestone&#10;Faculty patents"><?php echo htmlspecialchars($nlHighlightsStr); ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-0">
                        <label class="font-weight-bold">Upload Featured Newsletter PDF</label>
                        <input type="file" name="nl_pdf_file" class="form-control" accept=".pdf">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-0">
                        <label class="font-weight-bold">Existing PDF Link or URL</label>
                        <div class="input-group">
                          <input type="text" name="nl_pdf_url" class="form-control" value="<?php echo htmlspecialchars($nl['pdf_url'] ?? ''); ?>" placeholder="upload/media/... or https://">
                          <?php if (!empty($nl['pdf_url'])): ?>
                          <div class="input-group-append">
                            <a href="../<?php echo htmlspecialchars($nl['pdf_url']); ?>" target="_blank" class="btn btn-outline-secondary" title="View PDF">
                              <i class="fa fa-external-link"></i> View
                            </a>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- 2. Quarterly Newsletter Editions & Archive Repeater (Product Launch Pattern) -->
                <div class="simple-card-group">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                      <div class="simple-card-title mb-1" style="border-bottom:none; padding-bottom:0;">
                        <i class="fa fa-newspaper-o text-primary"></i> Quarterly Newsletter Editions &amp; Archives
                      </div>
                      <p class="small text-muted mb-0">Add, edit, upload PDF files, or delete past editions displayed in the newsletter archive collection grid.</p>
                    </div>
                    <button type="button" class="btn btn-success btn-sm font-weight-bold shadow-sm" id="btn-add-nl">
                      <i class="fa fa-plus-circle"></i> + Add New Newsletter
                    </button>
                  </div>

                  <div id="newsletter-container" class="row">
                    <?php for ($i = 0; $i < count($archives); $i++): 
                      $ed = $archives[$i];
                      $topicsText = is_array($ed['topics'] ?? null) ? implode("\n", $ed['topics']) : ($ed['topics'] ?? '');
                    ?>
                    <div class="col-md-4 mb-4 nl-card-col">
                      <div class="simple-item-box" style="border-top: 3px solid #0A1B54; position:relative;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                          <span class="badge badge-primary nl-badge-number">Edition #<?php echo $i + 1; ?></span>
                          <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 remove-nl-btn" title="Remove Newsletter Edition">
                            <i class="fa fa-trash"></i> Delete
                          </button>
                        </div>

                        <div class="form-group mb-2">
                          <label class="font-weight-bold">Issue Title / Headline</label>
                          <input type="text" name="nl_item_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ed['title'] ?? ''); ?>" placeholder="e.g. New Horizons in Innovation" required>
                        </div>

                        <div class="form-row mb-2">
                          <div class="col-6">
                            <small class="text-muted font-weight-bold">Volume / Issue</small>
                            <input type="text" name="nl_item_vol[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ed['vol'] ?? ''); ?>" placeholder="e.g. Vol. 6 | Issue 1">
                          </div>
                          <div class="col-6">
                            <small class="text-muted font-weight-bold">Quarter / Period</small>
                            <input type="text" name="nl_item_date[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ed['date'] ?? ''); ?>" placeholder="e.g. Jan – Mar 2026">
                          </div>
                        </div>

                        <div class="form-group mb-2">
                          <small class="text-muted font-weight-bold">Page Count / Format</small>
                          <input type="text" name="nl_item_size[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ed['size'] ?? '16 Pages • PDF'); ?>" placeholder="e.g. 16 Pages • PDF">
                        </div>

                        <div class="form-group mb-2">
                          <small class="text-muted font-weight-bold">Featured Topics / Highlights (One per line)</small>
                          <textarea name="nl_item_topics[]" class="form-control form-control-sm" rows="3" placeholder="Topic 1&#10;Topic 2&#10;Topic 3"><?php echo htmlspecialchars($topicsText); ?></textarea>
                        </div>

                        <div class="form-group mb-2">
                          <small class="text-muted font-weight-bold">Upload Newsletter PDF</small>
                          <input type="file" name="nl_item_file[]" class="form-control form-control-sm" accept=".pdf">
                        </div>

                        <div class="form-group mb-0">
                          <small class="text-muted font-weight-bold">Existing PDF Link or URL</small>
                          <div class="input-group input-group-sm">
                            <input type="text" name="nl_item_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ed['url'] ?? ''); ?>" placeholder="upload/media/... or https://">
                            <?php if (!empty($ed['url'])): ?>
                            <div class="input-group-append">
                              <a href="../<?php echo htmlspecialchars($ed['url']); ?>" target="_blank" class="btn btn-outline-secondary" title="View PDF">
                                <i class="fa fa-external-link"></i>
                              </a>
                            </div>
                            <?php endif; ?>
                          </div>
                        </div>

                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>

                  <!-- Add New Newsletter Button Bottom Bar -->
                  <div class="text-center py-3 mt-2" style="background:#f8fafc; border:2px dashed #cbd5e1; border-radius:8px;">
                    <button type="button" class="btn btn-outline-success font-weight-bold px-4" id="btn-add-nl-bottom">
                      <i class="fa fa-plus-circle"></i> + Add Another Newsletter Edition
                    </button>
                  </div>
                </div>

                <!-- Template for dynamic cloning -->
                <template id="nl-card-template">
                  <div class="col-md-4 mb-4 nl-card-col">
                    <div class="simple-item-box" style="border-top: 3px solid #28a745; position:relative; animation:fadeIn 0.3s ease;">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge badge-success nl-badge-number">Edition #NEW</span>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 remove-nl-btn" title="Remove Newsletter Edition">
                          <i class="fa fa-trash"></i> Delete
                        </button>
                      </div>

                      <div class="form-group mb-2">
                        <label class="font-weight-bold">Issue Title / Headline</label>
                        <input type="text" name="nl_item_title[]" class="form-control form-control-sm" value="" placeholder="e.g. New Horizons in Academic Milestones" required>
                      </div>

                      <div class="form-row mb-2">
                        <div class="col-6">
                          <small class="text-muted font-weight-bold">Volume / Issue</small>
                          <input type="text" name="nl_item_vol[]" class="form-control form-control-sm" value="" placeholder="e.g. Vol. 6 | Issue 3">
                        </div>
                        <div class="col-6">
                          <small class="text-muted font-weight-bold">Quarter / Period</small>
                          <input type="text" name="nl_item_date[]" class="form-control form-control-sm" value="" placeholder="e.g. Jul – Sep 2026">
                        </div>
                      </div>

                      <div class="form-group mb-2">
                        <small class="text-muted font-weight-bold">Page Count / Format</small>
                        <input type="text" name="nl_item_size[]" class="form-control form-control-sm" value="16 Pages • PDF" placeholder="e.g. 16 Pages • PDF">
                      </div>

                      <div class="form-group mb-2">
                        <small class="text-muted font-weight-bold">Featured Topics / Highlights (One per line)</small>
                        <textarea name="nl_item_topics[]" class="form-control form-control-sm" rows="3" placeholder="Key topic 1&#10;Key topic 2&#10;Key topic 3"></textarea>
                      </div>

                      <div class="form-group mb-2">
                        <small class="text-muted font-weight-bold">Upload Newsletter PDF</small>
                        <input type="file" name="nl_item_file[]" class="form-control form-control-sm" accept=".pdf">
                      </div>

                      <div class="form-group mb-0">
                        <small class="text-muted font-weight-bold">Existing PDF Link or URL</small>
                        <input type="text" name="nl_item_url[]" class="form-control form-control-sm" value="" placeholder="upload/media/... or https://">
                      </div>

                    </div>
                  </div>
                </template>
                <?php endif; ?>

                <!-- F. Blogs & Articles -->
                <?php if ($pKey == 'blogs'): 
                  $liveBlogsCount = $db->getValue('site_blogs', 'count(*)');
                  $liveActiveCount = $db->where('status', 1)->getValue('site_blogs', 'count(*)');
                  $recentBlogs = $db->orderBy('publish_date', 'DESC')->get('site_blogs', 3);
                ?>
                <div class="simple-card-group" style="background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%); border: 2px solid #BFDBFE;">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                      <div class="simple-card-title mb-1" style="border-bottom:none; padding-bottom:0; color:#0A1B54; font-size:16px;">
                        <i class="fa fa-rss text-danger"></i> Dedicated Monthly Blog &amp; Article Manager
                      </div>
                      <p class="small text-muted mb-0">Because research, tech, and academic blogs are uploaded on a monthly cycle, they are managed in a dedicated full-featured database table with search, pagination, status toggling, and complete Add / Edit / Delete controls.</p>
                    </div>
                    <a href="blogs.php" class="btn btn-primary font-weight-bold shadow-sm" style="background:#0A1B54; border-color:#0A1B54; padding:10px 20px;">
                      <i class="fa fa-rss"></i> Open Blogs Manager &rarr;
                    </a>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-4">
                      <div class="p-3 bg-white rounded border text-center">
                        <div class="h3 font-weight-bold text-primary mb-0"><?php echo $liveBlogsCount; ?></div>
                        <small class="text-muted font-weight-bold text-uppercase">Total Blog Articles</small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="p-3 bg-white rounded border text-center">
                        <div class="h3 font-weight-bold text-success mb-0"><?php echo $liveActiveCount; ?></div>
                        <small class="text-muted font-weight-bold text-uppercase">Published &amp; Active</small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="p-3 bg-white rounded border text-center">
                        <div class="h3 font-weight-bold text-warning mb-0"><i class="fa fa-calendar-check-o"></i> Monthly</div>
                        <small class="text-muted font-weight-bold text-uppercase">Publishing Cycle</small>
                      </div>
                    </div>
                  </div>

                  <div class="mt-4 pt-3 border-top">
                    <label class="font-weight-bold text-dark mb-2"><i class="fa fa-clock-o text-muted"></i> Recent Blog Articles Published:</label>
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered bg-white mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th>Article Headline</th>
                            <th width="140">Category</th>
                            <th width="140">Author</th>
                            <th width="110">Date</th>
                            <th width="90" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($recentBlogs as $rb): ?>
                          <tr>
                            <td class="font-weight-bold"><?php echo htmlspecialchars($rb['title']); ?></td>
                            <td><span class="badge badge-light border text-primary"><?php echo htmlspecialchars($rb['category_name'] ?: ucfirst($rb['category'])); ?></span></td>
                            <td><small><?php echo htmlspecialchars($rb['author_name']); ?></small></td>
                            <td><small class="text-muted"><?php echo date('M Y', strtotime($rb['publish_date'])); ?></small></td>
                            <td class="text-center">
                              <a href="blogs.php?action=edit&id=<?php echo $rb['id']; ?>" class="btn btn-xs btn-outline-primary py-0 px-2">Edit</a>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="text-center mt-3">
                      <a href="blogs.php?action=add" class="btn btn-success btn-sm font-weight-bold mr-2">
                        <i class="fa fa-plus-circle"></i> + Add New Monthly Blog Post
                      </a>
                      <a href="blogs.php" class="btn btn-outline-primary btn-sm font-weight-bold">
                        <i class="fa fa-list"></i> View All Articles in Full List Table
                      </a>
                    </div>
                  </div>
                </div>
                <?php endif; ?>

                <!-- SUBMIT BUTTON -->
                <div class="text-right mt-4 pt-3 border-top">
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary mr-2">
                    <i class="fa fa-times"></i> Cancel
                  </a>
                  <button type="submit" name="submit" class="btn btn-warning px-4 font-weight-bold" style="background:#D97706;border-color:#D97706;color:#ffffff;">
                    <i class="fa fa-check"></i> Save Content
                  </button>
                </div>

              </form>
            </div>
          </div>
        </div>

        <?php } endif; ?>

        <?php if ($action != 'edit'): ?>
        <!-- KPI METRICS ROW -->
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon amber">
                <i class="fa fa-book"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $totalCount; ?></div>
                <div class="kpi-mini-label">Student &amp; Publication Pages</div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon green">
                <i class="fa fa-check-circle"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $activeCount; ?></div>
                <div class="kpi-mini-label">Active &amp; Visible</div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon blue">
                <i class="fa fa-newspaper-o"></i>
              </div>
              <div>
                <div class="kpi-mini-num">Flagship + Digest</div>
                <div class="kpi-mini-label">Bhabha Spandan &amp; Chronicles</div>
              </div>
            </div>
          </div>
        </div>

        <!-- STUDENT & PUBLICATIONS PAGES TABLE -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-warning font-weight-bold mb-0" style="color:#B45309 !important;">
                  <i class="fa fa-list"></i> Managed Student &amp; Publication Portals
                </h5>
                <small class="text-muted">Real-time updates synchronize across all student publication channels.</small>
              </div>

              <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                  <thead class="thead-light">
                    <tr>
                      <th width="50">#</th>
                      <th>Page Title</th>
                      <th width="150">Page Key</th>
                      <th width="160">Badge Text</th>
                      <th>Main Heading</th>
                      <th width="100" class="text-center">Status</th>
                      <th width="180" class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sn = 1;
                    foreach ($allPages as $row): 
                      $key = $row['page_key'];
                      $liveUrl = $urlMap[$key] ?? '#';
                    ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td class="font-weight-bold">
                        <?php echo htmlspecialchars($row['page_title']); ?>
                      </td>
                      <td>
                        <span class="badge badge-light border text-dark"><?php echo htmlspecialchars($key); ?></span>
                      </td>
                      <td>
                        <small class="text-muted"><?php echo htmlspecialchars($row['badge'] ?? '—'); ?></small>
                      </td>
                      <td>
                        <small class="text-muted"><?php echo strip_tags($row['heading'] ?? ''); ?></small>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo PAGE; ?>?action=toggle_status&id=<?php echo $row['id']; ?>" title="Click to toggle status">
                          <?php if ($row['status'] == 1): ?>
                            <span class="badge-active">Active</span>
                          <?php else: ?>
                            <span class="badge-inactive">Inactive</span>
                          <?php endif; ?>
                        </a>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning mr-1" style="background:#D97706;border-color:#D97706;color:#ffffff;" title="Edit Content">
                          <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a href="<?php echo $liveUrl; ?>" target="_blank" class="btn btn-sm btn-outline-info" title="View Live Page">
                          <i class="fa fa-eye"></i> View
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.js.php"); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var container = document.getElementById('newsletter-container');
  var template = document.getElementById('nl-card-template');
  var btnAddTop = document.getElementById('btn-add-nl');
  var btnAddBottom = document.getElementById('btn-add-nl-bottom');

  function updateNewsletterIndices() {
    if (!container) return;
    var cards = container.querySelectorAll('.nl-card-col');
    cards.forEach(function(card, idx) {
      var badge = card.querySelector('.nl-badge-number');
      if (badge) {
        badge.textContent = 'Edition #' + (idx + 1);
        badge.className = 'badge badge-primary nl-badge-number';
      }
    });
  }

  function addNewsletter() {
    if (!container || !template) return;
    var clone = template.content.cloneNode(true);
    container.appendChild(clone);
    updateNewsletterIndices();

    var allCards = container.querySelectorAll('.nl-card-col');
    var lastCard = allCards[allCards.length - 1];
    if (lastCard) {
      lastCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
      var firstInput = lastCard.querySelector('input[type="text"], textarea');
      if (firstInput) {
        setTimeout(function() {
          firstInput.focus();
        }, 250);
      }
    }
  }

  if (btnAddTop) {
    btnAddTop.addEventListener('click', function(e) {
      e.preventDefault();
      addNewsletter();
    });
  }

  if (btnAddBottom) {
    btnAddBottom.addEventListener('click', function(e) {
      e.preventDefault();
      addNewsletter();
    });
  }

  if (container) {
    container.addEventListener('click', function(e) {
      var btn = e.target.closest('.remove-nl-btn');
      if (!btn) return;
      e.preventDefault();

      var card = btn.closest('.nl-card-col');
      if (!card) return;

      var totalCards = container.querySelectorAll('.nl-card-col').length;
      if (totalCards <= 1) {
        alert('You must have at least one newsletter edition in the archive.');
        return;
      }

      var nameInput = card.querySelector('input[name="nl_item_title[]"]');
      var edName = nameInput && nameInput.value.trim() ? ('"' + nameInput.value.trim() + '"') : 'this newsletter edition';

      if (confirm('Are you sure you want to delete ' + edName + '?')) {
        card.style.transition = 'all 0.25s ease';
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        setTimeout(function() {
          card.remove();
          updateNewsletterIndices();
        }, 250);
      }
    });
  }
});
</script>
</body>
</html>
