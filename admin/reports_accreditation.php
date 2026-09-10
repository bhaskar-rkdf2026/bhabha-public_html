<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'reports_accreditation.php');
define("TITLE", 'Reports & Accreditation');
define("CATEGORY", 'reports');
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

// Helper function for uploading PDFs / docs
function handleReportFileUpload($fileInput, $fallbackUrl = '') {
    if (isset($_FILES[$fileInput]) && !empty($_FILES[$fileInput]['name'])) {
        $uploadDir = '../upload/media/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }
        $origName = basename($_FILES[$fileInput]['name']);
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ext, $allowed)) {
            $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
            $fileName = $cleanBase . '_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES[$fileInput]['tmp_name'], $uploadDir . $fileName)) {
                return 'upload/media/' . $fileName;
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
        $_SESSION['error'] = 'Report page not found.';
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

    // Process Repeatable Documents List (Used across NIRF, IQAC, Audit, UGC, Downloads)
    $docTitles = $_POST['doc_title'] ?? [];
    $docYears  = $_POST['doc_year'] ?? [];
    $docUrls   = $_POST['doc_url'] ?? [];
    $docCats   = $_POST['doc_category'] ?? [];

    $docs = [];
    for ($i = 0; $i < count($docTitles); $i++) {
        $t = trim($docTitles[$i]);
        if (!empty($t)) {
            $existingUrl = trim($docUrls[$i] ?? '');
            
            // Check if a file was uploaded for this row
            if (isset($_FILES['doc_file']['name'][$i]) && !empty($_FILES['doc_file']['name'][$i])) {
                $uploadDir = '../upload/media/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES['doc_file']['name'][$i]);
                $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];
                if (in_array($ext, $allowed)) {
                    $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                    $fileName = $cleanBase . '_' . time() . '_' . rand(10, 99) . '.' . $ext;
                    if (move_uploaded_file($_FILES['doc_file']['tmp_name'][$i], $uploadDir . $fileName)) {
                        $existingUrl = 'upload/media/' . $fileName;
                    }
                }
            }

            $docs[] = [
                'title'    => $t,
                'year'     => trim($docYears[$i] ?? ''),
                'category' => trim($docCats[$i] ?? ''),
                'url'      => $existingUrl
            ];
        }
    }

    if ($pageKey == 'nirf') {
        $contentData['reports'] = $docs;
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    } elseif ($pageKey == 'iqac') {
        $contentData['documents'] = $docs;
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    } elseif ($pageKey == 'auditreport') {
        $contentData['reports'] = $docs;
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    } elseif ($pageKey == 'ugc-proforma') {
        $contentData['documents'] = $docs;
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    } elseif ($pageKey == 'downlod1') {
        $contentData['downloads'] = $docs;
        if (isset($_POST['body'])) $contentData['body'] = trim($_POST['body']);
    }

    $data['content_data'] = json_encode($contentData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $db->where('id', $id);
    $db->update(DBTAB, $data);

    $_SESSION['success'] = 'Report page "' . $pageRow['page_title'] . '" updated successfully!';
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
    'nirf'         => '../nirf.php',
    'iqac'         => '../iqac.php',
    'auditreport'  => '../auditreport.php',
    'ugc-proforma' => '../ugc-proforma.php',
    'downlod1'     => '../downlod1.php',
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
  background: linear-gradient(135deg, #064E3B 0%, #047857 55%, #059669 100%);
  color: #ffffff;
  border-radius: 12px;
  padding: 24px 28px;
  margin-bottom: 24px;
  box-shadow: 0 8px 24px rgba(6,78,59,0.14);
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
  color: #D1FAE5;
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
.kpi-mini-icon.emerald { background: #ECFDF5; color: #059669; }
.kpi-mini-icon.blue    { background: #EFF6FF; color: #2563EB; }
.kpi-mini-icon.amber   { background: #FFFBEB; color: #D97706; }
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
  color: #064E3B;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  border-bottom: 2px solid #E2E8F0;
  padding-bottom: 8px;
}
.doc-row-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  padding: 14px;
  margin-bottom: 12px;
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
            <h2 class="dash-portal-title"><i class="fa fa-certificate"></i> Reports &amp; Accreditation Pillar</h2>
            <p class="dash-portal-sub">Institutional disclosures, NIRF data, IQAC quality reports, financial audits, UGC compliance &amp; public downloads.</p>
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

              // Extract documents array
              $docList = $cData['reports'] ?? ($cData['documents'] ?? ($cData['downloads'] ?? []));
              if (!is_array($docList)) $docList = [];
        ?>

        <!-- EDIT FORM -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <div>
                  <h4 class="text-success font-weight-bold mb-1">
                    <i class="fa fa-pencil-square-o"></i> Edit Report Page: <?php echo htmlspecialchars($editPage['page_title']); ?>
                  </h4>
                  <small class="text-muted">Unique Key: <code><?php echo htmlspecialchars($pKey); ?></code> &bull; Category: <span class="badge badge-success">Reports &amp; Accreditation</span></small>
                </div>
                <div>
                  <a href="<?php echo $liveUrl; ?>" target="_blank" class="btn btn-sm btn-outline-success mr-2">
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
                    <i class="fa fa-tags"></i> Page Banner &amp; Metadata
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
                        <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($editPage['badge'] ?? ''); ?>" placeholder="e.g. Statutory Disclosure">
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
                        <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($editPage['heading'] ?? ''); ?>" placeholder="e.g. NIRF <em>Data &amp; Submissions</em>">
                        <small class="text-muted">Tip: Use <code>&lt;em&gt;</code> for gold highlight.</small>
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

                <!-- 2. NARRATIVE / INTRODUCTORY BODY -->
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-align-left"></i> Statutory Introduction &amp; Mandate (Optional)
                  </div>
                  <div class="form-group mb-0">
                    <textarea name="body" class="form-control" rows="3" placeholder="Overview of regulatory compliance, accreditation background, or committee composition..."><?php echo htmlspecialchars($cData['body'] ?? ''); ?></textarea>
                  </div>
                </div>

                <!-- 3. REPEATABLE DOCUMENTS / REPORTS LIST -->
                <div class="simple-card-group">
                  <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <div class="simple-card-title mb-0 border-0 p-0">
                      <i class="fa fa-file-pdf-o text-danger"></i> Official Documents &amp; Downloadable Reports (<?php echo count($docList); ?> items)
                    </div>
                    <button type="button" class="btn btn-sm btn-success" onclick="addDocRow()">
                      <i class="fa fa-plus"></i> Add New Document
                    </button>
                  </div>

                  <div id="docListContainer">
                    <?php 
                    $rowCount = max(count($docList), 1);
                    for ($i = 0; $i < $rowCount; $i++): 
                      $d = $docList[$i] ?? ['title' => '', 'year' => '', 'category' => '', 'url' => ''];
                    ?>
                    <div class="doc-row-card" id="docRow_<?php echo $i; ?>">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <div class="form-group mb-2">
                            <small class="text-muted font-weight-bold">Document / Report Title</small>
                            <input type="text" name="doc_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($d['title'] ?? ''); ?>" placeholder="e.g. NIRF 2024 Overall Submission">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group mb-2">
                            <small class="text-muted font-weight-bold">Year / Session</small>
                            <input type="text" name="doc_year[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($d['year'] ?? ''); ?>" placeholder="2024-25">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group mb-2">
                            <small class="text-muted font-weight-bold">Category / Discipline</small>
                            <input type="text" name="doc_category[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($d['category'] ?? ''); ?>" placeholder="Pharmacy / Overall">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group mb-2">
                            <small class="text-muted font-weight-bold">PDF File (Upload or URL)</small>
                            <input type="file" name="doc_file[]" class="form-control form-control-sm mb-1" accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <input type="text" name="doc_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($d['url'] ?? ''); ?>" placeholder="upload/media/... or https://">
                          </div>
                        </div>
                        <div class="col-md-1 text-center">
                          <?php if (!empty($d['url']) && $d['url'] !== '#'): ?>
                            <a href="../<?php echo htmlspecialchars($d['url']); ?>" target="_blank" class="btn btn-sm btn-outline-info mb-1" title="View PDF">
                              <i class="fa fa-external-link"></i>
                            </a>
                          <?php endif; ?>
                          <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeDocRow(<?php echo $i; ?>)" title="Remove Item">
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>

                  <small class="text-muted"><i class="fa fa-info-circle"></i> Administrators can directly upload PDF documents or paste existing media links. Empty rows will automatically be ignored upon save.</small>
                </div>

                <!-- SUBMIT BUTTON -->
                <div class="text-right mt-4 pt-3 border-top">
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary mr-2">
                    <i class="fa fa-times"></i> Cancel
                  </a>
                  <button type="submit" name="submit" class="btn btn-success px-4">
                    <i class="fa fa-check"></i> Save Report Page
                  </button>
                </div>

              </form>
            </div>
          </div>
        </div>

        <script>
        var docIndex = <?php echo $rowCount; ?>;
        function addDocRow() {
          var container = document.getElementById('docListContainer');
          var html = '<div class="doc-row-card" id="docRow_' + docIndex + '">' +
            '<div class="row align-items-center">' +
              '<div class="col-md-4">' +
                '<div class="form-group mb-2">' +
                  '<small class="text-muted font-weight-bold">Document / Report Title</small>' +
                  '<input type="text" name="doc_title[]" class="form-control form-control-sm" placeholder="e.g. Annual Audit Report">' +
                '</div>' +
              '</div>' +
              '<div class="col-md-2">' +
                '<div class="form-group mb-2">' +
                  '<small class="text-muted font-weight-bold">Year / Session</small>' +
                  '<input type="text" name="doc_year[]" class="form-control form-control-sm" placeholder="2024-25">' +
                '</div>' +
              '</div>' +
              '<div class="col-md-2">' +
                '<div class="form-group mb-2">' +
                  '<small class="text-muted font-weight-bold">Category / Discipline</small>' +
                  '<input type="text" name="doc_category[]" class="form-control form-control-sm" placeholder="Statutory">' +
                '</div>' +
              '</div>' +
              '<div class="col-md-3">' +
                '<div class="form-group mb-2">' +
                  '<small class="text-muted font-weight-bold">PDF File (Upload or URL)</small>' +
                  '<input type="file" name="doc_file[]" class="form-control form-control-sm mb-1" accept=".pdf,.doc,.docx">' +
                  '<input type="text" name="doc_url[]" class="form-control form-control-sm" placeholder="upload/media/...">' +
                '</div>' +
              '</div>' +
              '<div class="col-md-1 text-center">' +
                '<button type="button" class="btn btn-sm btn-outline-danger" onclick="removeDocRow(' + docIndex + ')" title="Remove">' +
                  '<i class="fa fa-trash"></i>' +
                '</button>' +
              '</div>' +
            '</div>' +
          '</div>';
          container.insertAdjacentHTML('beforeend', html);
          docIndex++;
        }
        function removeDocRow(idx) {
          var row = document.getElementById('docRow_' + idx);
          if (row) row.remove();
        }
        </script>

        <?php } endif; ?>

        <?php if ($action != 'edit'): ?>
        <!-- KPI METRICS ROW -->
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon emerald">
                <i class="fa fa-certificate"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $totalCount; ?></div>
                <div class="kpi-mini-label">Reports &amp; Accreditations</div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon blue">
                <i class="fa fa-check-circle"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $activeCount; ?></div>
                <div class="kpi-mini-label">Active Disclosures Live</div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon amber">
                <i class="fa fa-file-pdf-o"></i>
              </div>
              <div>
                <div class="kpi-mini-num">PDF Ready</div>
                <div class="kpi-mini-label">Direct Download Vault</div>
              </div>
            </div>
          </div>
        </div>

        <!-- REPORTS PAGES TABLE -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-success font-weight-bold mb-0">
                  <i class="fa fa-list"></i> Managed Accreditation &amp; Statutory Reports
                </h5>
                <small class="text-muted">All uploaded PDFs immediately link to the frontend website.</small>
              </div>

              <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                  <thead class="thead-light">
                    <tr>
                      <th width="50">#</th>
                      <th>Report Page Title</th>
                      <th width="140">Page Key</th>
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
                        <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success mr-1" title="Edit Content & PDFs">
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
</body>
</html>
