<?php  
/**
 * admin/popup_notices.php
 * Dynamic Manager for Homepage Important Notices & Results Popup
 * - Full CRUD for Notice Cards (Add, Edit, Delete, Toggle Active/Inactive, Reorder)
 * - Global Popup Settings (Result ERP Link, Title, Subtitle, Left Achiever Poster & CTA)
 */
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'popup_notices.php');
define("TITLE", 'Results & Notice Popup');
define("DBTAB", 'site_popup_notices');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Ensure table exists (fail-safe)
$db->rawQuery("CREATE TABLE IF NOT EXISTS `site_popup_notices` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(150) NOT NULL DEFAULT '',
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `description` TEXT NULL,
  `link` VARCHAR(500) NOT NULL DEFAULT '',
  `color_class` VARCHAR(50) NOT NULL DEFAULT 'is-navy',
  `sort_order` INT(11) NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Load popup global settings from site_portal_pages
$db->where('page_key', 'home_result_popup');
$portalRow = $db->getOne('site_portal_pages');
$popupSettings = [];
if ($portalRow && !empty($portalRow['content_data'])) {
    $popupSettings = json_decode($portalRow['content_data'], true) ?: [];
}

// Defaults
$defaultSettings = [
    'enabled' => 1,
    'header_title' => 'Important Notices & Results',
    'header_subtitle' => 'Official circulars & declared semester examination marks',
    'header_icon' => 'fa fa-bell',
    'result_btn_text' => 'View Result ↗',
    'result_btn_link' => 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx',
    'close_btn_text' => 'Got it, Close',
    'show_dont_show_today' => 1,
    'left_achiever_enabled' => 1,
    'achiever_pill' => 'STAR MILESTONE • ISRO',
    'achiever_image' => 'govind-singh-isro.jpg',
    'achiever_caption' => 'Govind Singh (M.Tech) selected as Scientist/Engineer \'SC\' at URSC, ISRO Bengaluru.',
    'achiever_cta_text' => 'Read Press Coverage',
    'achiever_cta_link' => 'news.php?id=203'
];
$settings = array_merge($defaultSettings, $popupSettings);

// 1. Toggle Notice Card Status (via GET)
if ($action == "toggle_status" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $newStatus = ($curr['status'] == 1) ? 0 : 1;
        $db->where('id', $id);
        $db->update(DBTAB, ['status' => $newStatus]);
        $_SESSION["success"] = 'Notice status updated successfully.';
    }
    redirect(PAGE);
}

// 2. Delete Notice Card
if ($action == "delete" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Notice card deleted successfully.';
    redirect(PAGE);
}

// 3. Handle Add / Edit Submission
if (isset($_POST['submit_notice'])) {
    $subAction = $_POST['action'] ?? '';
    $id = intval($_POST['id'] ?? 0);
    
    $tag = trim($_POST['tag'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $link = trim($_POST['link'] ?? '');
    $color_class = trim($_POST['color_class'] ?? 'is-navy');
    $sort_order = intval($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;

    if (empty($title)) {
        $stat['error'] = 'Title / Course name is required.';
    } else {
        if (empty($link)) {
            $link = $settings['result_btn_link'];
        }

        $cardData = [
            'tag' => $tag,
            'title' => $title,
            'description' => $description,
            'link' => $link,
            'color_class' => $color_class,
            'sort_order' => $sort_order,
            'status' => $status
        ];

        if ($subAction == 'add') {
            $insId = $db->insert(DBTAB, $cardData);
            if ($insId) {
                $_SESSION['success'] = 'New Notice Card added successfully.';
                redirect(PAGE);
            } else {
                $stat['error'] = 'Failed to add notice card.';
            }
        } elseif ($subAction == 'edit' && $id > 0) {
            $db->where('id', $id);
            if ($db->update(DBTAB, $cardData)) {
                $_SESSION['success'] = 'Notice Card updated successfully.';
                redirect(PAGE);
            } else {
                $stat['error'] = 'Failed to update notice card.';
            }
        }
    }
}

// 4. Handle Global Popup Settings Submission
if (isset($_POST['save_settings'])) {
    $newSettings = [
        'enabled' => isset($_POST['popup_enabled']) ? 1 : 0,
        'header_title' => trim($_POST['header_title'] ?? $settings['header_title']),
        'header_subtitle' => trim($_POST['header_subtitle'] ?? $settings['header_subtitle']),
        'header_icon' => trim($_POST['header_icon'] ?? 'fa fa-bell'),
        'result_btn_text' => trim($_POST['result_btn_text'] ?? $settings['result_btn_text']),
        'result_btn_link' => trim($_POST['result_btn_link'] ?? 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx'),
        'close_btn_text' => trim($_POST['close_btn_text'] ?? $settings['close_btn_text']),
        'show_dont_show_today' => isset($_POST['show_dont_show_today']) ? 1 : 0,
        'left_achiever_enabled' => isset($_POST['left_achiever_enabled']) ? 1 : 0,
        'achiever_pill' => trim($_POST['achiever_pill'] ?? $settings['achiever_pill']),
        'achiever_image' => trim($_POST['achiever_image'] ?? $settings['achiever_image']),
        'achiever_caption' => trim($_POST['achiever_caption'] ?? $settings['achiever_caption']),
        'achiever_cta_text' => trim($_POST['achiever_cta_text'] ?? $settings['achiever_cta_text']),
        'achiever_cta_link' => trim($_POST['achiever_cta_link'] ?? $settings['achiever_cta_link'])
    ];

    // Handle file upload for achiever image
    if (isset($_FILES['achiever_image_file']) && $_FILES['achiever_image_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../upload/media/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }
        $origName = basename($_FILES['achiever_image_file']['name']);
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (in_array($ext, $allowed)) {
            $newName = 'achiever_' . time() . '.' . $ext;
            if (move_uploaded_file($_FILES['achiever_image_file']['tmp_name'], $uploadDir . $newName)) {
                $newSettings['achiever_image'] = 'upload/media/' . $newName;
            }
        }
    }

    $jsonPayload = json_encode($newSettings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    
    $db->where('page_key', 'home_result_popup');
    $checkP = $db->getOne('site_portal_pages');
    if ($checkP) {
        $db->where('page_key', 'home_result_popup');
        $db->update('site_portal_pages', [
            'content_data' => $jsonPayload,
            'status' => $newSettings['enabled']
        ]);
    } else {
        $db->insert('site_portal_pages', [
            'page_key' => 'home_result_popup',
            'category' => 'home',
            'content_data' => $jsonPayload,
            'status' => $newSettings['enabled']
        ]);
    }

    $_SESSION['success'] = 'Popup configuration and Result link saved successfully.';
    redirect(PAGE);
}

// Fetch all notices for listing
$db->orderBy('sort_order', 'ASC');
$db->orderBy('id', 'DESC');
$allNotices = $db->get(DBTAB);

// Color options helper
$colorPalette = [
    'is-navy' => ['label' => 'Bhabha Navy', 'color' => '#0A1B54', 'bg' => '#eff6ff'],
    'is-gold' => ['label' => 'Royal Gold', 'color' => '#b45309', 'bg' => '#fef3c7'],
    'is-blue' => ['label' => 'Sky Blue', 'color' => '#1d4ed8', 'bg' => '#e0f2fe'],
    'is-green' => ['label' => 'Emerald Green', 'color' => '#047857', 'bg' => '#ecfdf5'],
    'is-red' => ['label' => 'Crimson Red', 'color' => '#b91c1c', 'bg' => '#fef2f2'],
    'is-purple' => ['label' => 'Royal Purple', 'color' => '#6d28d9', 'bg' => '#f5f3ff']
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
<?php include_once("inc.meta.php"); ?>
<style>
.bu-kpi-card {
  border-radius: 12px;
  background: #fff;
  padding: 16px 20px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  border: 1px solid #e9ecef;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 16px;
}
.bu-kpi-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}
.color-badge-preview {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.5px;
}
.bu-preview-box {
  background: #051235;
  border-radius: 14px;
  padding: 20px;
  color: #fff;
  border: 1px solid rgba(255, 193, 7, 0.4);
}
.bu-sample-card {
  background: #fff;
  border-radius: 10px;
  padding: 12px 16px;
  margin-bottom: 10px;
  border-left: 4px solid #0A1B54;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
}
.table td, .table th {
  vertical-align: middle !important;
}
</style>
</head>
<body>
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        
        <!-- Page Header -->
        <div class="row align-items-center mb-3">
          <div class="col-sm-6">
            <div class="page-title-box">
              <h4 class="page-title" style="font-weight:700; color:#0A1B54;">
                <i class="mdi mdi-bell-ring-outline text-warning mr-2"></i> <?php echo TITLE; ?>
              </h4>
              <p class="text-muted mb-0 font-13">Manage homepage popup notices, semester exam results &amp; portal login links</p>
            </div>
          </div>
          <div class="col-sm-6 text-right">
            <?php if ($action == 'add' || $action == 'edit'): ?>
              <a href="<?php echo PAGE; ?>" class="btn btn-secondary waves-effect">
                <i class="mdi mdi-arrow-left mr-1"></i> Back to List
              </a>
            <?php else: ?>
              <a href="<?php echo PAGE; ?>?action=add" class="btn btn-primary waves-effect waves-light shadow-sm" style="background:#0A1B54; border-color:#0A1B54;">
                <i class="mdi mdi-plus-circle mr-1"></i> Add New Notice Card
              </a>
              <a href="../index.php" target="_blank" class="btn btn-outline-warning ml-2 font-weight-bold">
                <i class="mdi mdi-eye mr-1"></i> View Live Site
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Alert Messages -->
        <?php if (!empty($stat['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle mr-1"></i> <?php echo htmlspecialchars($stat['success']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>
        <?php if (!empty($stat['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle mr-1"></i> <?php echo htmlspecialchars($stat['error']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>

        <?php if ($action == 'add' || $action == 'edit'): ?>
          <?php
            $editData = [
                'id' => 0,
                'tag' => 'RESULT NOTIFICATION • B.PHARM',
                'title' => '',
                'description' => 'Examination results declared and published on the official portal.',
                'link' => $settings['result_btn_link'],
                'color_class' => 'is-navy',
                'sort_order' => count($allNotices) + 1,
                'status' => 1
            ];
            if ($action == 'edit') {
                $id = intval($_GET['id'] ?? 0);
                $db->where('id', $id);
                $found = $db->getOne(DBTAB);
                if ($found) {
                    $editData = $found;
                } else {
                    echo "<div class='alert alert-warning'>Notice card not found!</div>";
                }
            }
          ?>
          <!-- Add / Edit Form Card -->
          <div class="row">
            <div class="col-lg-8">
              <div class="card shadow-sm border-0 mb-4" style="border-radius:12px;">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                  <h5 class="mb-0 text-primary font-weight-bold">
                    <i class="mdi mdi-<?php echo ($action == 'add') ? 'plus-box' : 'pencil-box'; ?> mr-1"></i>
                    <?php echo ($action == 'add') ? 'Add New Notice Card' : 'Edit Notice Card #' . $editData['id']; ?>
                  </h5>
                  <span class="badge badge-soft-info">Popup Notice Card</span>
                </div>
                <div class="card-body p-4">
                  <form action="<?php echo PAGE; ?>" method="post">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">

                    <div class="form-group mb-3">
                      <label class="font-weight-bold text-dark">
                        Category Tag / Badge <span class="text-danger">*</span>
                        <small class="text-muted font-weight-normal">(e.g., RESULT NOTIFICATION • B.PHARM, ADMISSION CIRCULAR, etc.)</small>
                      </label>
                      <input type="text" name="tag" class="form-control" value="<?php echo htmlspecialchars($editData['tag']); ?>" placeholder="RESULT NOTIFICATION • B.PHARM" required>
                    </div>

                    <div class="form-group mb-3">
                      <label class="font-weight-bold text-dark">
                        Title &amp; Programme / Semester <span class="text-danger">*</span>
                        <small class="text-muted font-weight-normal">(You can use emojis like 🎓, 🔬, 📖, 🍴)</small>
                      </label>
                      <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($editData['title']); ?>" placeholder="🎓 B.Pharm – 4th Semester (Regular)" required>
                    </div>

                    <div class="form-group mb-3">
                      <label class="font-weight-bold text-dark">Description / Details</label>
                      <textarea name="description" class="form-control" rows="3" placeholder="Examination results declared and published on the official portal."><?php echo htmlspecialchars($editData['description']); ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                      <label class="font-weight-bold text-dark">
                        Target Link / Result Portal URL
                        <small class="text-muted font-weight-normal">(Default: <?php echo htmlspecialchars($settings['result_btn_link']); ?>)</small>
                      </label>
                      <input type="url" name="link" class="form-control" value="<?php echo htmlspecialchars($editData['link']); ?>" placeholder="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx">
                      <small class="form-text text-muted">Leave blank or keep the default link for the official ERP student login / result portal.</small>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-dark">Accent Color Theme</label>
                        <select name="color_class" class="form-control font-weight-bold">
                          <?php foreach ($colorPalette as $ckey => $cval): ?>
                            <option value="<?php echo $ckey; ?>" <?php echo ($editData['color_class'] === $ckey) ? 'selected' : ''; ?> style="color:<?php echo $cval['color']; ?>;">
                              <?php echo $cval['label']; ?> (<?php echo $cval['color']; ?>)
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="col-md-3 mb-3">
                        <label class="font-weight-bold text-dark">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="<?php echo intval($editData['sort_order']); ?>">
                      </div>

                      <div class="col-md-3 mb-3">
                        <label class="font-weight-bold text-dark">Status</label>
                        <div class="custom-control custom-switch mt-2">
                          <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" <?php echo ($editData['status'] == 1) ? 'checked' : ''; ?>>
                          <label class="custom-control-label font-weight-bold" for="statusSwitch">Active</label>
                        </div>
                      </div>
                    </div>

                    <div class="pt-3 border-top d-flex gap-2">
                      <button type="submit" name="submit_notice" class="btn btn-success px-4 font-weight-bold" style="background:#0A1B54; border-color:#0A1B54;">
                        <i class="mdi mdi-content-save mr-1"></i> <?php echo ($action == 'add') ? 'Save Notice Card' : 'Update Notice Card'; ?>
                      </button>
                      <a href="<?php echo PAGE; ?>" class="btn btn-light ml-2">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Helpful Tips Sidebar -->
            <div class="col-lg-4">
              <div class="card shadow-sm border-0 mb-4" style="border-radius:12px; background:#F8FAFC;">
                <div class="card-body p-4">
                  <h6 class="font-weight-bold text-dark mb-3"><i class="mdi mdi-lightbulb-on text-warning mr-1"></i> Preview &amp; Color Style Guide</h6>
                  <p class="text-muted font-13">Choose an accent color to give each notice a unique left border stripe:</p>
                  
                  <?php foreach ($colorPalette as $ckey => $cval): ?>
                    <div class="p-2 mb-2 rounded" style="background:<?php echo $cval['bg']; ?>; border-left:4px solid <?php echo $cval['color']; ?>;">
                      <div class="d-flex justify-content-between align-items-center">
                        <span style="color:<?php echo $cval['color']; ?>; font-weight:700; font-size:12px;"><?php echo $cval['label']; ?></span>
                        <code class="font-11"><?php echo $ckey; ?></code>
                      </div>
                    </div>
                  <?php endforeach; ?>

                  <div class="alert alert-info mt-3 font-13 mb-0">
                    <i class="mdi mdi-information-outline mr-1"></i> Students clicking any notice will be taken straight to their login/results on <strong>bhabha.accsofterp.com</strong>.
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php else: ?>
          
          <!-- KPI Top Counters -->
          <div class="row">
            <div class="col-md-4">
              <div class="bu-kpi-card">
                <div class="bu-kpi-icon" style="background:#e0f2fe; color:#0369a1;">
                  <i class="mdi mdi-bell-ring"></i>
                </div>
                <div>
                  <h3 class="mb-0 font-weight-bold" style="color:#0A1B54;"><?php echo count($allNotices); ?></h3>
                  <span class="text-muted font-13 font-weight-semibold">Total Notice Cards</span>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="bu-kpi-card">
                <div class="bu-kpi-icon" style="background:#ecfdf5; color:#047857;">
                  <i class="mdi mdi-check-decagram"></i>
                </div>
                <div>
                  <?php 
                    $activeCount = 0;
                    foreach ($allNotices as $n) { if ($n['status'] == 1) $activeCount++; }
                  ?>
                  <h3 class="mb-0 font-weight-bold" style="color:#047857;"><?php echo $activeCount; ?></h3>
                  <span class="text-muted font-13 font-weight-semibold">Active &amp; Visible Live</span>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="bu-kpi-card">
                <div class="bu-kpi-icon" style="background:<?php echo ($settings['enabled'] == 1) ? '#fef3c7' : '#f1f5f9'; ?>; color:<?php echo ($settings['enabled'] == 1) ? '#b45309' : '#64748b'; ?>;">
                  <i class="mdi mdi-power"></i>
                </div>
                <div>
                  <h4 class="mb-0 font-weight-bold" style="color:<?php echo ($settings['enabled'] == 1) ? '#0A1B54' : '#64748b'; ?>;">
                    <?php echo ($settings['enabled'] == 1) ? '<span class="text-success">● ENABLED</span>' : '<span class="text-danger">○ DISABLED</span>'; ?>
                  </h4>
                  <span class="text-muted font-13 font-weight-semibold">Popup Visibility on Homepage</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Main Notice Cards Table -->
          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm border-0 mb-4" style="border-radius:12px;">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between flex-wrap">
                  <div>
                    <h5 class="mb-0 text-primary font-weight-bold">
                      <i class="mdi mdi-format-list-bulleted-square mr-1"></i> Result &amp; Notice Cards
                    </h5>
                    <small class="text-muted">These cards appear in the right scrollable area of the popup</small>
                  </div>
                  <div class="mt-2 mt-sm-0">
                    <a href="<?php echo PAGE; ?>?action=add" class="btn btn-sm btn-primary font-weight-bold" style="background:#0A1B54; border-color:#0A1B54;">
                      <i class="mdi mdi-plus mr-1"></i> Add New Notice
                    </a>
                  </div>
                </div>

                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead style="background:#f8fafc; color:#334155;">
                        <tr>
                          <th style="width:60px;" class="text-center">Order</th>
                          <th style="width:130px;">Color Accent</th>
                          <th>Category Tag &amp; Title</th>
                          <th>Target Link</th>
                          <th style="width:100px;" class="text-center">Status</th>
                          <th style="width:140px;" class="text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (empty($allNotices)): ?>
                          <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                              <i class="mdi mdi-information-outline font-24 mb-2 d-block"></i>
                              No notice cards found. Click <strong>"Add New Notice"</strong> above to create one.
                            </td>
                          </tr>
                        <?php else: ?>
                          <?php foreach ($allNotices as $notice): ?>
                            <?php 
                              $colorInfo = $colorPalette[$notice['color_class']] ?? $colorPalette['is-navy'];
                            ?>
                            <tr>
                              <td class="text-center font-weight-bold text-muted"><?php echo intval($notice['sort_order']); ?></td>
                              <td>
                                <span class="color-badge-preview" style="background:<?php echo $colorInfo['bg']; ?>; color:<?php echo $colorInfo['color']; ?>; border:1px solid <?php echo $colorInfo['color']; ?>;">
                                  <?php echo $colorInfo['label']; ?>
                                </span>
                              </td>
                              <td>
                                <span class="badge badge-light text-uppercase font-10" style="letter-spacing:0.5px; border:1px solid #cbd5e1;"><?php echo htmlspecialchars($notice['tag']); ?></span>
                                <div class="font-weight-bold text-dark mt-1" style="font-size:14px;">
                                  <?php echo htmlspecialchars($notice['title']); ?>
                                </div>
                                <?php if (!empty($notice['description'])): ?>
                                  <div class="text-muted font-12 mt-1" style="max-width:550px; line-height:1.4;">
                                    <?php echo htmlspecialchars($notice['description']); ?>
                                  </div>
                                <?php endif; ?>
                              </td>
                              <td>
                                <a href="<?php echo htmlspecialchars($notice['link']); ?>" target="_blank" class="font-12 text-truncate d-inline-block" style="max-width:200px;" title="<?php echo htmlspecialchars($notice['link']); ?>">
                                  <i class="mdi mdi-open-in-new mr-1"></i><?php echo htmlspecialchars($notice['link']); ?>
                                </a>
                              </td>
                              <td class="text-center">
                                <a href="<?php echo PAGE; ?>?action=toggle_status&id=<?php echo $notice['id']; ?>" class="badge badge-pill <?php echo ($notice['status'] == 1) ? 'badge-success' : 'badge-secondary'; ?> px-2 py-1" title="Click to toggle status">
                                  <?php echo ($notice['status'] == 1) ? 'Active' : 'Inactive'; ?>
                                </a>
                              </td>
                              <td class="text-right">
                                <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $notice['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit Notice">
                                  <i class="mdi mdi-pencil"></i>
                                </a>
                                <a href="<?php echo PAGE; ?>?action=delete&id=<?php echo $notice['id']; ?>" class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('Are you sure you want to delete this notice card?');" title="Delete Notice">
                                  <i class="mdi mdi-trash-can"></i>
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Popup Global Settings Form Card -->
          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm border-0 mb-4" style="border-radius:12px;">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                  <div>
                    <h5 class="mb-0 text-primary font-weight-bold">
                      <i class="mdi mdi-tune-vertical mr-1"></i> Popup Global Settings &amp; Result Portal Link
                    </h5>
                    <small class="text-muted">Configure student login link, modal headers, achiever poster, and display options</small>
                  </div>
                  <span class="badge badge-warning text-dark font-weight-bold px-2 py-1"><i class="mdi mdi-star mr-1"></i> Core Setup</span>
                </div>
                
                <div class="card-body p-4">
                  <form action="<?php echo PAGE; ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                      <!-- Left Column: Modal Header & Result Button -->
                      <div class="col-lg-6 pr-lg-4 border-right">
                        <h6 class="font-weight-bold text-dark mb-3 border-bottom pb-2">
                          <i class="mdi mdi-web text-primary mr-1"></i> 1. Main Modal Settings &amp; Result Link
                        </h6>

                        <div class="form-group mb-3">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="popupEnabledSwitch" name="popup_enabled" value="1" <?php echo ($settings['enabled'] == 1) ? 'checked' : ''; ?>>
                            <label class="custom-control-label font-weight-bold text-dark" for="popupEnabledSwitch">
                              Enable Popup Modal on Website
                            </label>
                          </div>
                          <small class="text-muted">If turned off, the popup will not display to visitors on the homepage.</small>
                        </div>

                        <div class="form-group mb-3">
                          <label class="font-weight-bold text-dark">
                            Result Portal URL <span class="text-danger">*</span>
                          </label>
                          <input type="url" name="result_btn_link" class="form-control font-weight-bold text-primary" value="<?php echo htmlspecialchars($settings['result_btn_link']); ?>" required>
                          <small class="form-text text-muted">
                            <i class="mdi mdi-link-variant mr-1"></i> Current Student ERP Portal: <code>https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx</code>
                          </small>
                        </div>

                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">Result Button Text</label>
                            <input type="text" name="result_btn_text" class="form-control" value="<?php echo htmlspecialchars($settings['result_btn_text']); ?>">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">Close Button Text</label>
                            <input type="text" name="close_btn_text" class="form-control" value="<?php echo htmlspecialchars($settings['close_btn_text']); ?>">
                          </div>
                        </div>

                        <div class="form-group mb-3">
                          <label class="font-weight-bold text-dark">Popup Header Title</label>
                          <input type="text" name="header_title" class="form-control" value="<?php echo htmlspecialchars($settings['header_title']); ?>">
                        </div>

                        <div class="form-group mb-3">
                          <label class="font-weight-bold text-dark">Popup Header Subtitle</label>
                          <input type="text" name="header_subtitle" class="form-control" value="<?php echo htmlspecialchars($settings['header_subtitle']); ?>">
                        </div>

                        <div class="form-group mb-3">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="dontShowCheckbox" name="show_dont_show_today" value="1" <?php echo (!empty($settings['show_dont_show_today'])) ? 'checked' : ''; ?>>
                            <label class="custom-control-label font-weight-bold text-dark font-13" for="dontShowCheckbox">
                              Show "Don't show again today" checkbox in footer
                            </label>
                          </div>
                        </div>
                      </div>

                      <!-- Right Column: Left Achiever Section -->
                      <div class="col-lg-6 pl-lg-4">
                        <h6 class="font-weight-bold text-dark mb-3 border-bottom pb-2">
                          <i class="mdi mdi-trophy-award text-warning mr-1"></i> 2. Left Achiever Poster (Govind Singh / ISRO)
                        </h6>

                        <div class="form-group mb-3">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="achieverEnabledSwitch" name="left_achiever_enabled" value="1" <?php echo (!empty($settings['left_achiever_enabled'])) ? 'checked' : ''; ?>>
                            <label class="custom-control-label font-weight-bold text-dark" for="achieverEnabledSwitch">
                              Show Left Achiever Poster Section
                            </label>
                          </div>
                        </div>

                        <div class="form-group mb-3">
                          <label class="font-weight-bold text-dark">Achiever Pill / Tag</label>
                          <input type="text" name="achiever_pill" class="form-control" value="<?php echo htmlspecialchars($settings['achiever_pill']); ?>">
                        </div>

                        <div class="row">
                          <div class="col-md-7 mb-3">
                            <label class="font-weight-bold text-dark">Poster Image (Upload New)</label>
                            <input type="file" name="achiever_image_file" class="form-control-file border p-1 rounded font-12" accept="image/*">
                            <input type="hidden" name="achiever_image" value="<?php echo htmlspecialchars($settings['achiever_image']); ?>">
                            <small class="text-muted d-block mt-1">Current: <code><?php echo htmlspecialchars($settings['achiever_image']); ?></code></small>
                          </div>
                          <div class="col-md-5 mb-3 text-center">
                            <?php 
                              $posterImg = $settings['achiever_image'];
                              $posterUrl = (strpos($posterImg, 'http') === 0) ? $posterImg : ((strpos($posterImg, 'upload/') === 0) ? '../' . $posterImg : '../img/' . $posterImg);
                            ?>
                            <img src="<?php echo htmlspecialchars($posterUrl); ?>" alt="Preview" class="img-thumbnail" style="max-height:90px; object-fit:cover;" onerror="this.style.display='none';">
                          </div>
                        </div>

                        <div class="form-group mb-3">
                          <label class="font-weight-bold text-dark">Student Name &amp; Achievement Caption</label>
                          <textarea name="achiever_caption" class="form-control" rows="2"><?php echo htmlspecialchars($settings['achiever_caption']); ?></textarea>
                        </div>

                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">CTA Button Text</label>
                            <input type="text" name="achiever_cta_text" class="form-control" value="<?php echo htmlspecialchars($settings['achiever_cta_text']); ?>">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">CTA Target Link</label>
                            <input type="text" name="achiever_cta_link" class="form-control" value="<?php echo htmlspecialchars($settings['achiever_cta_link']); ?>">
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="pt-3 border-top text-right">
                      <button type="submit" name="save_settings" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="background:#0A1B54; border-color:#0A1B54;">
                        <i class="mdi mdi-content-save mr-1"></i> Save Popup Settings &amp; Result Link
                      </button>
                    </div>

                  </form>
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

<?php include_once("inc.footer.js.php"); ?>
</body>
</html>
