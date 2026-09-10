<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'policies.php');
define("TITLE", 'Legal & Policies');
define("CATEGORY", 'legal');
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

// Handle Form Submission
if (isset($_POST['submit'])) {
    $id = intval($_POST['id'] ?? 0);
    $db->where('id', $id);
    $db->where('category', CATEGORY);
    $pageRow = $db->getOne(DBTAB);

    if (!$pageRow) {
        $_SESSION['error'] = 'Policy page not found.';
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

    if (isset($_POST['body'])) {
        $contentData['body'] = trim($_POST['body']);
    }

    // Process Public MD Download Forms if present
    if ($pageKey == 'public-md' && isset($_POST['form_title'])) {
        $fTitles = $_POST['form_title'];
        $fUrls   = $_POST['form_url'] ?? [];
        $forms = [];
        for ($i = 0; $i < count($fTitles); $i++) {
            $ft = trim($fTitles[$i]);
            if (!empty($ft)) {
                $curUrl = trim($fUrls[$i] ?? '');
                // Handle file upload
                if (isset($_FILES['form_file']['name'][$i]) && !empty($_FILES['form_file']['name'][$i])) {
                    $uploadDir = '../upload/media/';
                    if (!is_dir($uploadDir)) {
                        @mkdir($uploadDir, 0777, true);
                    }
                    $origName = basename($_FILES['form_file']['name'][$i]);
                    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                    $allowed = ['pdf', 'doc', 'docx'];
                    if (in_array($ext, $allowed)) {
                        $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                        $fileName = $cleanBase . '_' . time() . '_' . rand(10, 99) . '.' . $ext;
                        if (move_uploaded_file($_FILES['form_file']['tmp_name'][$i], $uploadDir . $fileName)) {
                            $curUrl = 'upload/media/' . $fileName;
                        }
                    }
                }
                $forms[] = [
                    'title' => $ft,
                    'url'   => $curUrl
                ];
            }
        }
        $contentData['forms'] = $forms;
    }

    $data['content_data'] = json_encode($contentData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $db->where('id', $id);
    $db->update(DBTAB, $data);

    $_SESSION['success'] = 'Policy page "' . $pageRow['page_title'] . '" updated successfully!';
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
    'privacy-policy'       => '../privacy-policy.php',
    'term-and-condition'   => '../term-and-condition.php',
    'refund-policy'        => '../refund-policy.php',
    'mandatory-disclosure' => '../mandatory-disclosure.php',
    'public-md'            => '../public-md.php',
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
<link href="<?php echo URL_PLUG;?>summernote/summernote-bs4.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<style>
.dash-portal-hero {
  background: linear-gradient(135deg, #1E1B4B 0%, #312E81 55%, #3730A3 100%);
  color: #ffffff;
  border-radius: 12px;
  padding: 24px 28px;
  margin-bottom: 24px;
  box-shadow: 0 8px 24px rgba(30,27,75,0.16);
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
  color: #C7D2FE;
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
.kpi-mini-icon.indigo { background: #EEF2FF; color: #4F46E5; }
.kpi-mini-icon.blue   { background: #EFF6FF; color: #2563EB; }
.kpi-mini-icon.emerald{ background: #ECFDF5; color: #059669; }
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
  color: #1E1B4B;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  border-bottom: 2px solid #E2E8F0;
  padding-bottom: 8px;
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
            <h2 class="dash-portal-title"><i class="fa fa-balance-scale"></i> Legal &amp; Policies Pillar</h2>
            <p class="dash-portal-sub">Manage institutional legal agreements, terms of service, fee refund policies, AICTE mandatory disclosures &amp; statutory compliance.</p>
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
              echo '<div class="alert alert-danger">Policy page not found. <a href="' . PAGE . '">Return to list</a></div>';
          } else {
              $pKey = $editPage['page_key'];
              $cData = !empty($editPage['content_data']) ? json_decode($editPage['content_data'], true) : [];
              if (!is_array($cData)) $cData = [];
              $liveUrl = $urlMap[$pKey] ?? '#';
              $formsList = $cData['forms'] ?? [];
        ?>

        <!-- EDIT FORM -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <div>
                  <h4 class="text-indigo font-weight-bold mb-1" style="color:#3730A3;">
                    <i class="fa fa-pencil-square-o"></i> Edit Policy: <?php echo htmlspecialchars($editPage['page_title']); ?>
                  </h4>
                  <small class="text-muted">Unique Key: <code><?php echo htmlspecialchars($pKey); ?></code> &bull; Category: <span class="badge badge-primary">Legal &amp; Policies</span></small>
                </div>
                <div>
                  <a href="<?php echo $liveUrl; ?>" target="_blank" class="btn btn-sm btn-outline-primary mr-2">
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
                        <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($editPage['badge'] ?? ''); ?>" placeholder="e.g. Legal & Terms">
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
                        <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($editPage['heading'] ?? ''); ?>" placeholder="e.g. Terms &amp; <em>Conditions</em>">
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

                <!-- 2. POLICY DOCUMENT BODY (HTML/WYSIWYG) -->
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-file-text-o"></i> Policy Clauses &amp; Content Body
                  </div>
                  <div class="form-group mb-0">
                    <label class="font-weight-bold">Document Content (HTML supported)</label>
                    <textarea name="body" class="form-control summernote" rows="12"><?php echo htmlspecialchars($cData['body'] ?? ''); ?></textarea>
                  </div>
                </div>

                <!-- 3. PUBLIC MANDATORY FORMS (Only for public-md) -->
                <?php if ($pKey == 'public-md'): ?>
                <div class="simple-card-group">
                  <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <div class="simple-card-title mb-0 border-0 p-0">
                      <i class="fa fa-download text-primary"></i> Statutory Application Forms &amp; Direct Downloads (<?php echo count($formsList); ?> forms)
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" onclick="addFormRow()">
                      <i class="fa fa-plus"></i> Add Form
                    </button>
                  </div>

                  <div id="formsListContainer">
                    <?php 
                    $fCount = max(count($formsList), 1);
                    for ($i = 0; $i < $fCount; $i++): 
                      $f = $formsList[$i] ?? ['title' => '', 'url' => ''];
                    ?>
                    <div class="doc-row-card" id="formRow_<?php echo $i; ?>" style="background:#ffffff;border:1px solid #e2e8f0;border-radius:6px;padding:12px;margin-bottom:10px;">
                      <div class="row align-items-center">
                        <div class="col-md-5">
                          <div class="form-group mb-2">
                            <small class="text-muted font-weight-bold">Form Name / Certificate Title</small>
                            <input type="text" name="form_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['title'] ?? ''); ?>" placeholder="e.g. Application for Degree Certificate">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group mb-2">
                            <small class="text-muted font-weight-bold">PDF Form (Upload or Media URL)</small>
                            <input type="file" name="form_file[]" class="form-control form-control-sm mb-1" accept=".pdf">
                            <input type="text" name="form_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['url'] ?? ''); ?>" placeholder="upload/media/... or https://">
                          </div>
                        </div>
                        <div class="col-md-2 text-center">
                          <?php if (!empty($f['url']) && $f['url'] !== '#'): ?>
                            <a href="../<?php echo htmlspecialchars($f['url']); ?>" target="_blank" class="btn btn-sm btn-outline-info mr-1" title="Preview PDF">
                              <i class="fa fa-external-link"></i>
                            </a>
                          <?php endif; ?>
                          <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFormRow(<?php echo $i; ?>)" title="Remove">
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>

                <script>
                var formIndex = <?php echo $fCount; ?>;
                function addFormRow() {
                  var c = document.getElementById('formsListContainer');
                  var html = '<div class="doc-row-card" id="formRow_' + formIndex + '" style="background:#ffffff;border:1px solid #e2e8f0;border-radius:6px;padding:12px;margin-bottom:10px;">' +
                    '<div class="row align-items-center">' +
                      '<div class="col-md-5">' +
                        '<div class="form-group mb-2">' +
                          '<small class="text-muted font-weight-bold">Form Name / Certificate Title</small>' +
                          '<input type="text" name="form_title[]" class="form-control form-control-sm" placeholder="e.g. Application for Transcript">' +
                        '</div>' +
                      '</div>' +
                      '<div class="col-md-5">' +
                        '<div class="form-group mb-2">' +
                          '<small class="text-muted font-weight-bold">PDF Form (Upload or URL)</small>' +
                          '<input type="file" name="form_file[]" class="form-control form-control-sm mb-1" accept=".pdf">' +
                          '<input type="text" name="form_url[]" class="form-control form-control-sm" placeholder="upload/media/...">' +
                        '</div>' +
                      '</div>' +
                      '<div class="col-md-2 text-center">' +
                        '<button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFormRow(' + formIndex + ')"><i class="fa fa-trash"></i></button>' +
                      '</div>' +
                    '</div>' +
                  '</div>';
                  c.insertAdjacentHTML('beforeend', html);
                  formIndex++;
                }
                function removeFormRow(idx) {
                  var r = document.getElementById('formRow_' + idx);
                  if (r) r.remove();
                }
                </script>
                <?php endif; ?>

                <!-- SUBMIT BUTTON -->
                <div class="text-right mt-4 pt-3 border-top">
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary mr-2">
                    <i class="fa fa-times"></i> Cancel
                  </a>
                  <button type="submit" name="submit" class="btn btn-primary px-4" style="background:#312E81;border-color:#312E81;">
                    <i class="fa fa-check"></i> Save Policy Content
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
              <div class="kpi-mini-icon indigo">
                <i class="fa fa-balance-scale"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $totalCount; ?></div>
                <div class="kpi-mini-label">Legal &amp; Policy Pages</div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon emerald">
                <i class="fa fa-check-circle"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $activeCount; ?></div>
                <div class="kpi-mini-label">Enforced &amp; Active</div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon blue">
                <i class="fa fa-shield"></i>
              </div>
              <div>
                <div class="kpi-mini-num">AICTE / UGC</div>
                <div class="kpi-mini-label">Statutory Compliance Slabs</div>
              </div>
            </div>
          </div>
        </div>

        <!-- POLICIES PAGES TABLE -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary font-weight-bold mb-0" style="color:#312E81 !important;">
                  <i class="fa fa-list"></i> Managed Legal &amp; Policy Pages
                </h5>
                <small class="text-muted">All updates reflect instantaneously on public portals.</small>
              </div>

              <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                  <thead class="thead-light">
                    <tr>
                      <th width="50">#</th>
                      <th>Policy Title</th>
                      <th width="160">Page Key</th>
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
                        <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary mr-1" style="background:#312E81;border-color:#312E81;" title="Edit Content">
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
<script src="<?php echo URL_PLUG;?>summernote/summernote-bs4.min.js"></script>
<script>
$(document).ready(function(){
  $('.summernote').summernote({
    height: 320,
    minHeight: 200,
    maxHeight: 600,
    focus: false
  });
});
</script>
</body>
</html>
