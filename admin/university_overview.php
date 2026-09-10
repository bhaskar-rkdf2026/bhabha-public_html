<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'university_overview.php');
define("TITLE", 'University Overview Pages');
define("CATEGORY", 'overview');
define("DBTAB", 'site_portal_pages');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Icon normalizer helper
if (!function_exists('normFa')) {
    function normFa($icon) {
        $icon = trim($icon);
        if (empty($icon)) return 'fa fa-circle';
        if (strpos($icon, 'fa ') !== 0 && strpos($icon, 'fas ') !== 0 && strpos($icon, 'far ') !== 0 && strpos($icon, 'fab ') !== 0) {
            return 'fa ' . (strpos($icon, 'fa-') === 0 ? $icon : 'fa-' . $icon);
        }
        return $icon;
    }
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

// Handle Edit Submission
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

    // Common fields
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

    // 1. Mission & Vision
    if ($pageKey == 'mission-vision') {
        $cards = [];
        $cLabels = $_POST['card_label'] ?? [];
        $cHeadings = $_POST['card_heading'] ?? [];
        $cBodies = $_POST['card_body'] ?? [];
        for ($i = 0; $i < count($cLabels); $i++) {
            if (!empty($cLabels[$i]) || !empty($cHeadings[$i])) {
                $cArr = [
                    'label'   => trim($cLabels[$i]),
                    'heading' => trim($cHeadings[$i]),
                    'body'    => trim($cBodies[$i] ?? '')
                ];
                if ($i == 2) {
                    $cArr['style'] = 'background:linear-gradient(135deg,#0A1B54,#061D7C); border-color:#0A1B54;';
                    $cArr['label_style'] = 'color:#FFC107 !important;';
                    $cArr['heading_style'] = 'color:#ffffff !important;';
                }
                $cards[] = $cArr;
            }
        }
        $contentData['cards'] = $cards;
    }
    // 2. Core Values
    elseif ($pageKey == 'values') {
        $values = [];
        $vTitles = $_POST['val_title'] ?? [];
        $vIcons  = $_POST['val_icon'] ?? [];
        $vDescs  = $_POST['val_desc'] ?? [];
        for ($i = 0; $i < count($vTitles); $i++) {
            if (!empty($vTitles[$i])) {
                $values[] = [
                    'title' => trim($vTitles[$i]),
                    'icon'  => normFa($vIcons[$i] ?? 'fa-circle'),
                    'desc'  => trim($vDescs[$i] ?? '')
                ];
            }
        }
        $contentData['values'] = $values;
    }
    // 3. Why Us (10 Pillars)
    elseif ($pageKey == 'why-us') {
        $pillars = [];
        $pNums   = $_POST['pillar_num'] ?? [];
        $pTitles = $_POST['pillar_title'] ?? [];
        $pDescs  = $_POST['pillar_desc'] ?? [];
        for ($i = 0; $i < count($pTitles); $i++) {
            if (!empty($pTitles[$i])) {
                $numStr = !empty($pNums[$i]) ? trim($pNums[$i]) : sprintf("%02d", $i + 1);
                $pillars[] = [
                    'num'   => $numStr,
                    'title' => trim($pTitles[$i]),
                    'desc'  => trim($pDescs[$i] ?? '')
                ];
            }
        }
        $contentData['pillars'] = $pillars;
    }
    // 4. About Us
    elseif ($pageKey == 'about') {
        $stats = [];
        $sNums   = $_POST['stat_num'] ?? [];
        $sLabels = $_POST['stat_label'] ?? [];
        $sIcons  = $_POST['stat_icon'] ?? [];
        for ($i = 0; $i < count($sNums); $i++) {
            if (!empty($sNums[$i])) {
                $stats[] = [
                    'num'   => trim($sNums[$i]),
                    'label' => trim($sLabels[$i] ?? ''),
                    'icon'  => normFa($sIcons[$i] ?? 'fa-star')
                ];
            }
        }
        $contentData['stats'] = $stats;
        if (isset($_POST['body'])) {
            $contentData['body'] = trim($_POST['body']);
        }
    }
    // 5. Hotel & Amenities
    elseif ($pageKey == 'hotel') {
        if (isset($_POST['body'])) {
            $contentData['body'] = trim($_POST['body']);
        }
    }
    // 6. University Leadership
    elseif ($pageKey == 'university') {
        if (isset($_POST['body'])) {
            $contentData['body'] = trim($_POST['body']);
        }
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
    'about'          => '../about.php',
    'mission-vision' => '../mission-vision.php',
    'values'         => '../values.php',
    'why-us'         => '../why-us.php',
    'hotel'          => '../hotel.php',
    'university'     => '../university.php',
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
  background: linear-gradient(135deg, #0A1B54 0%, #152B75 55%, #1C358A 100%);
  color: #ffffff;
  border-radius: 12px;
  padding: 24px 28px;
  margin-bottom: 24px;
  box-shadow: 0 8px 24px rgba(10,27,84,0.12);
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
  color: #CBD5E1;
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
.kpi-mini-icon.blue  { background: #EFF6FF; color: #2563EB; }
.kpi-mini-icon.green { background: #ECFDF5; color: #059669; }
.kpi-mini-icon.gold  { background: #FEF3C7; color: #D97706; }
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
  color: #0A1B54;
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
            <h2 class="dash-portal-title"><i class="fa fa-university"></i> University Overview Pillar</h2>
            <p class="dash-portal-sub">Manage and edit institutional identity pages: About Us, Mission &amp; Vision, Core Values, Why Us, Amenities &amp; Leadership.</p>
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
                  <h4 class="text-primary font-weight-bold mb-1">
                    <i class="fa fa-pencil-square-o"></i> Edit Page: <?php echo htmlspecialchars($editPage['page_title']); ?>
                  </h4>
                  <small class="text-muted">Unique Key: <code><?php echo htmlspecialchars($pKey); ?></code> &bull; Category: <span class="badge badge-info">Overview</span></small>
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

              <form method="POST" action="<?php echo PAGE; ?>">
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
                        <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($editPage['badge'] ?? ''); ?>" placeholder="e.g. Our Purpose & Direction">
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
                        <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($editPage['heading'] ?? ''); ?>" placeholder="e.g. Vision & <em>Mission</em>">
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

                <!-- A. Mission & Vision -->
                <?php if ($pKey == 'mission-vision'): 
                  $cards = !empty($cData['cards']) ? $cData['cards'] : [];
                ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-eye"></i> Vision, Mission &amp; Philosophy Cards
                  </div>
                  <div class="row">
                    <?php 
                    $cardLabelsDefault = ['Our Purpose', 'What Drives Us', 'Philosophy'];
                    $cardHeadingsDefault = ['Our <em>Vision</em>', 'Our <em>Mission</em>', 'Our <em style="color:#FFC107 !important;">Core Philosophy</em>'];
                    for ($i = 0; $i < 3; $i++): 
                      $c = $cards[$i] ?? [];
                    ?>
                    <div class="col-md-4 mb-3">
                      <div class="simple-item-box">
                        <label class="text-primary font-weight-bold">Card #<?php echo $i + 1; ?>: <?php echo $cardLabelsDefault[$i]; ?></label>
                        <div class="form-group mb-2">
                          <small class="text-muted">Badge Label</small>
                          <input type="text" name="card_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['label'] ?? $cardLabelsDefault[$i]); ?>">
                        </div>
                        <div class="form-group mb-2">
                          <small class="text-muted">Heading</small>
                          <input type="text" name="card_heading[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['heading'] ?? $cardHeadingsDefault[$i]); ?>">
                        </div>
                        <div class="form-group mb-0">
                          <small class="text-muted">Content Body (HTML supported)</small>
                          <textarea name="card_body[]" class="form-control form-control-sm" rows="6"><?php echo htmlspecialchars($c['body'] ?? ''); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>
                <?php endif; ?>

                <!-- B. Core Values -->
                <?php if ($pKey == 'values'): 
                  $values = !empty($cData['values']) ? $cData['values'] : [];
                ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-compass"></i> Core Values (6 Key Principles)
                  </div>
                  <div class="row">
                    <?php for ($i = 0; $i < 6; $i++): 
                      $v = $values[$i] ?? ['title' => '', 'icon' => 'fa fa-star', 'desc' => ''];
                    ?>
                    <div class="col-md-4 mb-3">
                      <div class="simple-item-box">
                        <label class="text-primary font-weight-bold">Value #<?php echo $i + 1; ?></label>
                        <div class="form-group mb-2">
                          <small class="text-muted">Value Title</small>
                          <input type="text" name="val_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($v['title'] ?? ''); ?>" placeholder="e.g. Excellence in Education">
                        </div>
                        <div class="form-group mb-2">
                          <small class="text-muted">FontAwesome Icon Class</small>
                          <input type="text" name="val_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($v['icon'] ?? 'fa fa-star'); ?>" placeholder="fa fa-graduation-cap">
                        </div>
                        <div class="form-group mb-0">
                          <small class="text-muted">Description</small>
                          <textarea name="val_desc[]" class="form-control form-control-sm" rows="3"><?php echo htmlspecialchars($v['desc'] ?? ''); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>
                <?php endif; ?>

                <!-- C. Why Choose Us -->
                <?php if ($pKey == 'why-us'): 
                  $pillars = !empty($cData['pillars']) ? $cData['pillars'] : [];
                ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-star"></i> 10 Distinctive Institutional Pillars
                  </div>
                  <div class="row">
                    <?php for ($i = 0; $i < 10; $i++): 
                      $p = $pillars[$i] ?? ['num' => sprintf("%02d", $i + 1), 'title' => '', 'desc' => ''];
                    ?>
                    <div class="col-md-6 mb-3">
                      <div class="simple-item-box">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                          <label class="text-primary font-weight-bold mb-0">Pillar #<?php echo $i + 1; ?></label>
                          <div style="width:70px;">
                            <input type="text" name="pillar_num[]" class="form-control form-control-sm text-center font-weight-bold" value="<?php echo htmlspecialchars($p['num'] ?? sprintf("%02d", $i + 1)); ?>" placeholder="01">
                          </div>
                        </div>
                        <div class="form-group mb-2">
                          <small class="text-muted">Pillar Title</small>
                          <input type="text" name="pillar_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['title'] ?? ''); ?>" placeholder="e.g. UGC Recognised & Statutory Approvals">
                        </div>
                        <div class="form-group mb-0">
                          <small class="text-muted">Description</small>
                          <textarea name="pillar_desc[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($p['desc'] ?? ''); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>
                <?php endif; ?>

                <!-- D. About Us -->
                <?php if ($pKey == 'about'): 
                  $stats = !empty($cData['stats']) ? $cData['stats'] : [];
                ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-bar-chart"></i> Campus &amp; University Key Metrics
                  </div>
                  <div class="row">
                    <?php 
                    $statLabelsDef = ['Acres Lush Green Campus', 'UG, PG & Research Programmes', 'Top Recruiter Network', 'Distinguished Alumni Fraternity'];
                    for ($i = 0; $i < 4; $i++): 
                      $s = $stats[$i] ?? ['num' => '', 'label' => $statLabelsDef[$i] ?? '', 'icon' => 'fa fa-trophy'];
                    ?>
                    <div class="col-md-3 mb-3">
                      <div class="simple-item-box">
                        <label class="text-primary font-weight-bold">Stat #<?php echo $i + 1; ?></label>
                        <div class="form-group mb-2">
                          <small class="text-muted">Value / Number</small>
                          <input type="text" name="stat_num[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($s['num'] ?? ''); ?>" placeholder="e.g. 50+">
                        </div>
                        <div class="form-group mb-2">
                          <small class="text-muted">Label</small>
                          <input type="text" name="stat_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($s['label'] ?? ''); ?>" placeholder="Acres Campus">
                        </div>
                        <div class="form-group mb-0">
                          <small class="text-muted">Icon Class</small>
                          <input type="text" name="stat_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($s['icon'] ?? 'fa fa-star'); ?>" placeholder="fa fa-map-o">
                        </div>
                      </div>
                    </div>
                    <?php endfor; ?>
                  </div>
                </div>

                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-file-text-o"></i> Detailed Narrative / Institutional Overview
                  </div>
                  <div class="form-group mb-0">
                    <textarea name="body" class="form-control" rows="5"><?php echo htmlspecialchars($cData['body'] ?? ''); ?></textarea>
                  </div>
                </div>
                <?php endif; ?>

                <!-- E. Hotel & University -->
                <?php if ($pKey == 'hotel' || $pKey == 'university'): ?>
                <div class="simple-card-group">
                  <div class="simple-card-title">
                    <i class="fa fa-file-text-o"></i> Page Content &amp; Facilities Narrative
                  </div>
                  <div class="form-group mb-0">
                    <label class="font-weight-bold">Full Section Content / Remarks (HTML supported)</label>
                    <textarea name="body" class="form-control" rows="6"><?php echo htmlspecialchars($cData['body'] ?? ''); ?></textarea>
                  </div>
                </div>
                <?php endif; ?>

                <!-- SUBMIT BUTTON -->
                <div class="text-right mt-4 pt-3 border-top">
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary mr-2">
                    <i class="fa fa-times"></i> Cancel
                  </a>
                  <button type="submit" name="submit" class="btn btn-primary px-4">
                    <i class="fa fa-check"></i> Save Changes
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
              <div class="kpi-mini-icon blue">
                <i class="fa fa-university"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $totalCount; ?></div>
                <div class="kpi-mini-label">Overview Pages</div>
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
                <div class="kpi-mini-label">Active &amp; Published</div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon gold">
                <i class="fa fa-clock-o"></i>
              </div>
              <div>
                <div class="kpi-mini-num">100%</div>
                <div class="kpi-mini-label">Dynamic Sync Live</div>
              </div>
            </div>
          </div>
        </div>

        <!-- OVERVIEW PAGES TABLE -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary font-weight-bold mb-0">
                  <i class="fa fa-list"></i> Managed Overview Pages
                </h5>
                <small class="text-muted">All changes update the live website immediately.</small>
              </div>

              <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                  <thead class="thead-light">
                    <tr>
                      <th width="50">#</th>
                      <th>Page Title</th>
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
                        <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary mr-1" title="Edit Content">
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
