<?php  
/**
 * admin/leadership.php
 * Premium Leadership & Administrative Dignitaries Manager
 * Bhabha University Theme: Deep Navy (#0A1B54), Royal Gold (#FFC107), Clean Slate
 */
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'leadership.php');
define("TITLE", 'Leadership');
define("DBTAB", 'leadership');
define("UPLOAD", '../upload/leadership/');

if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Ensure upload directory exists
if (!is_dir(UPLOAD)) {
    @mkdir(UPLOAD, 0777, true);
}

// Handle Form Submission (Add & Edit)
if (isset($_POST['submit'])) {
    if (isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != '') {
        $filename = basename($_FILES['icon']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($ext != '' && !in_array($ext, array('jpeg', 'jpg', 'png', 'gif', 'webp'))) {
            $stat["error"] = "Only JPG, PNG, WEBP & GIF images are allowed.";
        }
    }
    
    $reqAction = $_POST['action'] ?? ($action ?? '');
    
    if ($reqAction == "add" && count($stat) == 0) {
        $data = array(
            "title" => trim($_POST['title'] ?? ''),
            "name" => trim($_POST['name'] ?? ''),
            "designation" => trim($_POST['designation'] ?? ''),
            "quote" => trim($_POST['quote'] ?? ''),
            "chips" => trim($_POST['chips'] ?? ''),
            "sort_order" => intval($_POST['sort_order'] ?? 0),
            "about" => $_POST['about'] ?? ''
        );
        if (isset($_FILES['icon']) && !empty($_FILES['icon']['name'])) {
            $file_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
            $newfile = md5(microtime() . $_FILES['icon']['name']) . "." . $file_ext;
            if (move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile)) {
                $data['image'] = $newfile;
            }
        }
        $id = $db->insert(DBTAB, $data);
        unset($_POST);
        $_SESSION["success"] = 'Leader added successfully.';
        redirect(PAGE);
    } elseif ($reqAction == "edit" && count($stat) == 0) {
        $id = intval($_POST['id'] ?? ($_GET['id'] ?? 0));
        $data = array(
            "title" => trim($_POST['title'] ?? ''),
            "name" => trim($_POST['name'] ?? ''),
            "designation" => trim($_POST['designation'] ?? ''),
            "quote" => trim($_POST['quote'] ?? ''),
            "chips" => trim($_POST['chips'] ?? ''),
            "sort_order" => intval($_POST['sort_order'] ?? 0),
            "about" => $_POST['about'] ?? ''
        );
        if (isset($_FILES['icon']) && !empty($_FILES['icon']['name'])) {
            $db->where('id', $id);
            $aryData = $db->getOne(DBTAB);
            if (!empty($aryData['image']) && file_exists(UPLOAD . $aryData['image'])) {
                @unlink(UPLOAD . $aryData['image']);
            }
            $file_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
            $newfile = md5(microtime() . $_FILES['icon']['name']) . "." . $file_ext;
            if (move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile)) {
                $data['image'] = $newfile;
            }
        }
        $db->where('id', $id);
        $db->update(DBTAB, $data);
        unset($_POST);
        $_SESSION["success"] = 'Leader updated successfully.';
        redirect(PAGE);
    }
}

// Handle Delete
if ($action == "delete" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $aryData = $db->getOne(DBTAB);
    if (!empty($aryData['image']) && file_exists(UPLOAD . $aryData['image'])) {
        @unlink(UPLOAD . $aryData['image']);
    }
    $db->where('id', $id);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Leader deleted successfully.';
    redirect(PAGE);
}

// Quick Order Reordering AJAX / Action
if ($action == "reorder" && isset($_GET['id']) && isset($_GET['dir'])) {
    $id = intval($_GET['id']);
    $dir = $_GET['dir'];
    $db->where('id', $id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $curOrder = intval($curr['sort_order']);
        $newOrder = ($dir === 'up') ? max(1, $curOrder - 1) : $curOrder + 1;
        $db->where('id', $id);
        $db->update(DBTAB, ['sort_order' => $newOrder]);
        $_SESSION["success"] = 'Order updated successfully.';
    }
    redirect(PAGE);
}

// Fetch all leaders for list and KPI counts
$allLeaders = $db->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC')->get(DBTAB);
$totalLeaders = count($allLeaders);

// Count key roles
$executiveCount = 0;
$adminCount = 0;
foreach ($allLeaders as $ldr) {
    $roleLower = strtolower($ldr['title'] ?? '');
    if (strpos($roleLower, 'chancellor') !== false) {
        $executiveCount++;
    } else {
        $adminCount++;
    }
}

// Role badge styling helper
function bu_get_role_badge($title) {
    $t = strtolower(trim($title));
    if (strpos($t, 'pro chancellor') !== false) {
        return ['cls' => 'badge-pro-chancellor', 'label' => $title, 'icon' => 'mdi-account-star', 'bg' => '#EFF6FF', 'color' => '#1D4ED8', 'border' => '#BFDBFE'];
    } elseif (strpos($t, 'chancellor') !== false) {
        return ['cls' => 'badge-chancellor', 'label' => $title, 'icon' => 'mdi-crown', 'bg' => '#FEF3C7', 'color' => '#B45309', 'border' => '#FDE68A'];
    } elseif (strpos($t, 'vice chancellor') !== false || strpos($t, 'vc') !== false) {
        return ['cls' => 'badge-vc', 'label' => $title, 'icon' => 'mdi-school', 'bg' => '#ECFDF5', 'color' => '#047857', 'border' => '#A7F3D0'];
    } elseif (strpos($t, 'ceo') !== false) {
        return ['cls' => 'badge-ceo', 'label' => $title, 'icon' => 'mdi-briefcase-check', 'bg' => '#F5F3FF', 'color' => '#6D28D9', 'border' => '#DDD6FE'];
    } elseif (strpos($t, 'director') !== false) {
        return ['cls' => 'badge-director', 'label' => $title, 'icon' => 'mdi-tie', 'bg' => '#FDF2F8', 'color' => '#BE185D', 'border' => '#FBCFE8'];
    } elseif (strpos($t, 'registrar') !== false) {
        return ['cls' => 'badge-registrar', 'label' => $title, 'icon' => 'mdi-certificate', 'bg' => '#F0F9FF', 'color' => '#0284C7', 'border' => '#BAE6FD'];
    } else {
        return ['cls' => 'badge-default', 'label' => $title, 'icon' => 'mdi-shield', 'bg' => '#F1F5F9', 'color' => '#334155', 'border' => '#E2E8F0'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> Settings - Bhabha University Admin</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<style>
/* ============================================================
   PREMIUM LEADERSHIP ADMIN STYLES
   Theme: Bhabha Deep Navy (#0A1B54) & Royal Gold (#FFC107)
   ============================================================ */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051235;
  --bu-gold: #FFC107;
  --bu-gold-hover: #D99B00;
  --bu-slate-50: #F8FAFC;
  --bu-slate-100: #F1F5F9;
  --bu-slate-200: #E2E8F0;
  --bu-slate-600: #475569;
  --bu-slate-800: #1E293B;
}

/* Page Top Header Banner */
.bu-lead-hero-bar {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 70%, #162B75 100%);
  border-radius: 16px;
  padding: 24px 28px;
  margin-bottom: 24px;
  color: #FFFFFF;
  box-shadow: 0 10px 30px rgba(5, 18, 53, 0.15);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  border-bottom: 3px solid var(--bu-gold);
  position: relative;
  overflow: hidden;
}
.bu-lead-hero-bar::after {
  content: "";
  position: absolute;
  right: -30px;
  top: -30px;
  width: 160px;
  height: 160px;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.15) 0%, transparent 70%);
  pointer-events: none;
}
.bu-hero-title {
  font-size: 22px;
  font-weight: 800;
  margin: 0 0 6px 0;
  color: #FFFFFF;
  letter-spacing: -0.3px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-hero-subtitle {
  font-size: 13.5px;
  color: #CBD5E1;
  margin: 0;
  font-weight: 500;
}
.bu-hero-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  z-index: 2;
}
.bu-btn-gold {
  background: linear-gradient(135deg, #FFC107 0%, #FFB300 100%);
  color: #051235 !important;
  font-weight: 800;
  font-size: 13.5px;
  padding: 10px 20px;
  border-radius: 10px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 4px 14px rgba(255, 193, 7, 0.35);
  border: none;
  transition: all 0.22s ease;
}
.bu-btn-gold:hover {
  background: linear-gradient(135deg, #FFD54F 0%, #FFC107 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 193, 7, 0.5);
  color: #051235 !important;
}
.bu-btn-outline-white {
  background: rgba(255, 255, 255, 0.12);
  color: #FFFFFF !important;
  font-weight: 700;
  font-size: 13px;
  padding: 10px 18px;
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.25);
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s ease;
  backdrop-filter: blur(4px);
}
.bu-btn-outline-white:hover {
  background: rgba(255, 255, 255, 0.22);
  color: #FFFFFF !important;
  transform: translateY(-1px);
}

/* KPI Summary Cards */
.bu-kpi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-bottom: 24px;
}
.bu-kpi-box {
  background: #FFFFFF;
  border-radius: 14px;
  padding: 18px 20px;
  border: 1px solid var(--bu-slate-200);
  box-shadow: 0 2px 10px rgba(10, 27, 84, 0.04);
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all 0.2s ease;
}
.bu-kpi-box:hover {
  box-shadow: 0 6px 18px rgba(10, 27, 84, 0.08);
  border-color: #CBD5E1;
  transform: translateY(-2px);
}
.bu-kpi-icon-wrap {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  flex-shrink: 0;
}
.bu-kpi-val {
  font-size: 24px;
  font-weight: 800;
  line-height: 1.1;
  color: var(--bu-navy);
  margin-bottom: 2px;
}
.bu-kpi-lbl {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--bu-slate-600);
  text-transform: uppercase;
  letter-spacing: 0.4px;
}

/* Modern Main Card Container */
.bu-card-main {
  background: #FFFFFF;
  border-radius: 16px;
  border: 1px solid var(--bu-slate-200);
  box-shadow: 0 4px 20px rgba(10, 27, 84, 0.05);
  margin-bottom: 30px;
  overflow: hidden;
}
.bu-card-header-bar {
  padding: 18px 24px;
  background: #FFFFFF;
  border-bottom: 1px solid var(--bu-slate-200);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 14px;
}
.bu-card-title {
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Search & Filter Toolbar */
.bu-filter-toolbar {
  padding: 14px 24px;
  background: var(--bu-slate-50);
  border-bottom: 1px solid var(--bu-slate-200);
  display: flex;
  align-items: center;
  gap: 14px;
  flex-wrap: wrap;
}
.bu-search-box {
  position: relative;
  flex: 1 1 280px;
  max-width: 450px;
}
.bu-search-box i {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #94A3B8;
  font-size: 15px;
}
.bu-search-input {
  width: 100%;
  height: 40px;
  padding: 8px 16px 8px 38px;
  border: 1px solid #CBD5E1;
  border-radius: 10px;
  font-size: 13.5px;
  background: #FFFFFF;
  outline: none;
  transition: all 0.2s ease;
}
.bu-search-input:focus {
  border-color: var(--bu-navy);
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.08);
}
.bu-role-filter-select {
  height: 40px;
  padding: 6px 14px;
  border: 1px solid #CBD5E1;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 600;
  color: var(--bu-slate-800);
  background: #FFFFFF;
  outline: none;
  cursor: pointer;
}

/* Redesigned Modern Leadership Table - 100% Screen Fit */
.table-responsive {
  width: 100% !important;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  margin-bottom: 0;
}
@media (min-width: 1200px) {
  .table-responsive {
    overflow-x: hidden !important;
  }
}

.bu-table {
  width: 100% !important;
  border-collapse: separate;
  border-spacing: 0;
  margin-bottom: 0;
  table-layout: auto !important;
}
.bu-table thead th {
  background: var(--bu-slate-50);
  color: #334155;
  font-weight: 700;
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 10px 8px;
  border-bottom: 1px solid var(--bu-slate-200);
  border-top: none;
  vertical-align: middle;
  white-space: nowrap;
}
.bu-table tbody tr {
  transition: all 0.18s ease;
}
.bu-table tbody tr:hover {
  background-color: #F8FAFC !important;
}
.bu-table tbody td {
  padding: 8px 8px;
  vertical-align: middle;
  border-top: 1px solid #F1F5F9;
  font-size: 12.5px;
  color: #334155;
}

/* Avatar Photo Frame */
.bu-avatar-wrap {
  width: 42px;
  height: 42px;
  border-radius: 9px;
  overflow: hidden;
  position: relative;
  background: #F1F5F9;
  border: 1.5px solid #E2E8F0;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
  flex-shrink: 0;
  margin: 0 auto;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.bu-avatar-wrap:hover {
  transform: scale(1.08);
  box-shadow: 0 4px 12px rgba(10, 27, 84, 0.15);
  border-color: var(--bu-gold);
}
.bu-avatar-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: top center;
  display: block;
}
.bu-avatar-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  color: #FFFFFF;
  font-weight: 800;
  font-size: 13px;
}

/* Leader Name & Subtitle */
.bu-leader-name {
  font-weight: 800;
  font-size: 13.5px;
  color: var(--bu-navy);
  margin-bottom: 2px;
  letter-spacing: -0.2px;
  line-height: 1.25;
}
.bu-leader-subquote {
  font-size: 11px;
  color: #64748B;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 280px;
  font-style: italic;
  display: block;
}
.bu-chips-strip {
  display: flex;
  gap: 3px;
  flex-wrap: wrap;
  margin-top: 3px;
}
.bu-chip-tag {
  font-size: 9.5px;
  padding: 1px 5px;
  border-radius: 3px;
  background: #F1F5F9;
  color: #475569;
  border: 1px solid #E2E8F0;
  font-weight: 600;
  white-space: nowrap;
}

/* Role Badges */
.bu-role-pill {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 8px;
  border-radius: 12px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.1px;
  white-space: nowrap;
  max-width: 100%;
}

/* Order Badge */
.bu-order-circle {
  width: 26px;
  height: 26px;
  border-radius: 7px;
  background: #FFFFFF;
  border: 1px solid #CBD5E1;
  color: var(--bu-navy);
  font-weight: 800;
  font-size: 11.5px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
}

/* Action Button Group */
.bu-action-btn-group {
  display: flex;
  align-items: center;
  gap: 4px;
  justify-content: flex-end;
  white-space: nowrap;
}
.bu-btn-action {
  height: 28px;
  padding: 0 8px;
  border-radius: 6px;
  font-size: 11.5px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 3px;
  text-decoration: none !important;
  transition: all 0.2s ease;
  border: 1px solid transparent;
}
.bu-btn-edit {
  background: #EFF6FF;
  color: #1D4ED8;
  border-color: #BFDBFE;
}
.bu-btn-edit:hover {
  background: #1D4ED8;
  color: #FFFFFF;
  box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25);
}
.bu-btn-delete {
  background: #FEF2F2;
  color: #DC2626;
  border-color: #FECACA;
}
.bu-btn-delete:hover {
  background: #DC2626;
  color: #FFFFFF;
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
}

/* Add / Edit Form Styling */
.bu-form-card {
  background: #FFFFFF;
  border-radius: 16px;
  border: 1px solid var(--bu-slate-200);
  box-shadow: 0 4px 20px rgba(10, 27, 84, 0.05);
  margin-bottom: 30px;
  overflow: hidden;
}
.bu-form-body {
  padding: 28px;
}
.bu-form-label {
  font-size: 13px;
  font-weight: 700;
  color: #1E293B;
  margin-bottom: 6px;
  display: block;
}
.bu-form-control {
  width: 100%;
  height: 44px;
  padding: 10px 14px;
  border: 1px solid #CBD5E1;
  border-radius: 10px;
  font-size: 13.5px;
  color: #0F172A;
  background: #FFFFFF;
  outline: none;
  transition: all 0.2s ease;
}
.bu-form-control:focus {
  border-color: var(--bu-navy);
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.08);
}
textarea.bu-form-control {
  height: auto;
  min-height: 80px;
}
.bu-role-suggestions {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: 6px;
}
.bu-role-suggest-btn {
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 14px;
  background: #F1F5F9;
  color: #334155;
  border: 1px solid #E2E8F0;
  cursor: pointer;
  transition: all 0.18s;
}
.bu-role-suggest-btn:hover {
  background: var(--bu-navy);
  color: #FFFFFF;
  border-color: var(--bu-navy);
}

/* Upload Preview Box */
.bu-upload-zone {
  border: 2px dashed #CBD5E1;
  border-radius: 14px;
  padding: 24px;
  text-align: center;
  background: #F8FAFC;
  transition: all 0.2s ease;
  position: relative;
}
.bu-upload-zone:hover {
  border-color: var(--bu-navy);
  background: #F1F5F9;
}
.bu-preview-avatar {
  width: 110px;
  height: 110px;
  border-radius: 16px;
  object-fit: cover;
  border: 3px solid var(--bu-gold);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
  margin-bottom: 12px;
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
        
        <!-- Modern Hero Banner -->
        <div class="bu-lead-hero-bar">
          <div>
            <h2 class="bu-hero-title">
              <i class="mdi mdi-account-star text-warning"></i> Leadership &amp; Administrative Dignitaries
            </h2>
            <p class="bu-hero-subtitle">
              Manage Chancellor, Vice Chancellor, Pro Chancellor, Directors, and Administrative Leadership displayed across the university portal.
            </p>
          </div>
          <div class="bu-hero-actions">
            <?php if ($action == "add" || $action == "edit"): ?>
              <a href="<?php echo PAGE; ?>" class="bu-btn-outline-white">
                <i class="mdi mdi-arrow-left"></i> Back to Leaders List
              </a>
            <?php else: ?>
              <a href="../leadership.php" target="_blank" class="bu-btn-outline-white">
                <i class="mdi mdi-open-in-new"></i> View Live Page
              </a>
              <a href="<?php echo PAGE; ?>?action=add" class="bu-btn-gold">
                <i class="mdi mdi-plus-circle"></i> Add New Leader
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Alert Notifications -->
        <?php if (!empty($stat['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius:12px; font-weight:600;">
            <i class="mdi mdi-check-circle mr-1"></i> <?php echo htmlspecialchars($stat['success']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>
        <?php if (!empty($stat['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius:12px; font-weight:600;">
            <i class="mdi mdi-alert-circle mr-1"></i> <?php echo htmlspecialchars($stat['error']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>

        <?php if ($action == "add" || $action == "edit"): ?>
          <?php
            $editData = [
                'id' => 0,
                'name' => '',
                'title' => '',
                'designation' => '',
                'sort_order' => $totalLeaders + 1,
                'quote' => '',
                'chips' => '',
                'about' => '',
                'image' => ''
            ];
            if ($action == "edit") {
                $id = intval($_GET['id'] ?? 0);
                $db->where('id', $id);
                $found = $db->getOne(DBTAB);
                if ($found) {
                    $editData = $found;
                }
            }
          ?>
          <!-- Add / Edit Modern Form -->
          <div class="bu-form-card">
            <div class="bu-card-header-bar">
              <h5 class="bu-card-title">
                <i class="mdi mdi-<?php echo ($action == 'add') ? 'account-plus' : 'account-edit'; ?> text-primary"></i>
                <?php echo ($action == 'add') ? 'Add New University Leader' : 'Edit Leader: ' . htmlspecialchars($editData['name']); ?>
              </h5>
              <span class="badge badge-light border px-3 py-2 font-weight-bold text-muted">
                <?php echo ($action == 'add') ? 'New Profile' : 'Leader ID #' . $editData['id']; ?>
              </span>
            </div>

            <div class="bu-form-body">
              <form action="<?php echo PAGE; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="<?php echo $action; ?>">
                <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">

                <div class="row">
                  <!-- Left Form Column -->
                  <div class="col-lg-8 pr-lg-4 border-right">
                    
                    <div class="row">
                      <div class="col-md-7 mb-3">
                        <label class="bu-form-label">
                          Leader Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="bu-form-control" placeholder="e.g. Prof. (Dr.) Bharti Satankar" required value="<?php echo htmlspecialchars($editData['name']); ?>">
                      </div>

                      <div class="col-md-5 mb-3">
                        <label class="bu-form-label">
                          Display Order <span class="text-muted font-weight-normal">(1 = Highest)</span>
                        </label>
                        <input type="number" name="sort_order" class="bu-form-control font-weight-bold" value="<?php echo intval($editData['sort_order']); ?>">
                      </div>
                    </div>

                    <div class="form-group mb-3">
                      <label class="bu-form-label">
                        Role / Title <span class="text-danger">*</span>
                        <small class="text-muted font-weight-normal">(Category pill shown on card)</small>
                      </label>
                      <input type="text" id="roleTitleInput" name="title" class="bu-form-control" placeholder="e.g. Chancellor, Pro Chancellor, Vice Chancellor, Registrar" value="<?php echo htmlspecialchars($editData['title']); ?>" required>
                      <div class="bu-role-suggestions">
                        <span class="text-muted font-11 font-weight-bold mr-1 align-self-center">Quick Select:</span>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('Chancellor')">Chancellor</button>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('Pro Chancellor')">Pro Chancellor</button>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('Vice Chancellor')">Vice Chancellor</button>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('CEO')">CEO</button>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('Group Director')">Group Director</button>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('Registrar')">Registrar</button>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('Dean Students\' Welfare')">DSW</button>
                        <button type="button" class="bu-role-suggest-btn" onclick="setRoleTitle('Controller of Examination')">COE</button>
                      </div>
                    </div>

                    <div class="form-group mb-3">
                      <label class="bu-form-label">
                        Official Designation / Institute Affiliation
                      </label>
                      <input type="text" name="designation" class="bu-form-control" placeholder="e.g. Vice Chancellor (I/C), Bhabha University, Bhopal" value="<?php echo htmlspecialchars($editData['designation']); ?>">
                    </div>

                    <div class="form-group mb-3">
                      <label class="bu-form-label">
                        Highlight Quote / Vision Statement
                        <small class="text-muted font-weight-normal">(Featured quote rendered on leadership banner &amp; cards)</small>
                      </label>
                      <textarea name="quote" class="bu-form-control" rows="2" placeholder="e.g. Transforming dedicated scholars into decisive professionals equipped for global excellence."><?php echo htmlspecialchars($editData['quote']); ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                      <label class="bu-form-label">
                        Key Focus Chips / Expertise Tags
                        <small class="text-muted font-weight-normal">(Comma-separated values)</small>
                      </label>
                      <input type="text" name="chips" class="bu-form-control" placeholder="e.g. Advanced Methodologies, Industry MOUs, Institutional Governance" value="<?php echo htmlspecialchars($editData['chips']); ?>">
                    </div>

                    <div class="form-group mb-0">
                      <label class="bu-form-label">
                        Leader Message / Biography / Profile Details
                      </label>
                      <textarea name="about" id="ck_about" class="form-control ckeditor" rows="6"><?php echo $editData['about']; ?></textarea>
                    </div>

                  </div>

                  <!-- Right Form Column: Image Upload & Preview -->
                  <div class="col-lg-4 pl-lg-4">
                    <div class="mb-4">
                      <label class="bu-form-label mb-2">
                        <i class="mdi mdi-camera mr-1 text-primary"></i> Leader Portrait Photo
                      </label>
                      
                      <div class="bu-upload-zone">
                        <?php 
                          $hasPhoto = (!empty($editData['image']) && file_exists(UPLOAD . $editData['image']));
                          $photoUrl = $hasPhoto ? UPLOAD . $editData['image'] : '';
                        ?>
                        <?php if ($hasPhoto): ?>
                          <img src="<?php echo $photoUrl; ?>" alt="Preview" class="bu-preview-avatar" id="photoPreviewImg">
                        <?php else: ?>
                          <div class="bu-preview-avatar d-flex align-items-center justify-content-center mx-auto bg-light text-muted font-24" id="photoPlaceholder">
                            <i class="mdi mdi-account"></i>
                          </div>
                          <img src="" alt="Preview" class="bu-preview-avatar" id="photoPreviewImg" style="display:none;">
                        <?php endif; ?>

                        <div class="font-weight-bold text-dark font-14 mb-1">
                          <?php echo ($hasPhoto) ? 'Replace Current Photo' : 'Upload Leader Photo'; ?>
                        </div>
                        <p class="text-muted font-12 mb-3">Recommended: Square portrait, 500x500px, JPG, PNG or WEBP format</p>
                        
                        <input type="file" name="icon" id="leaderPhotoInput" class="form-control-file border p-1 rounded font-12 bg-white" accept="image/*" onchange="previewSelectedPhoto(this)">
                      </div>
                    </div>

                    <!-- Helpful Card Tips -->
                    <div class="p-3 rounded-lg" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                      <h6 class="font-weight-bold text-dark font-13 mb-2">
                        <i class="mdi mdi-information-outline text-info mr-1"></i> Display Guidelines
                      </h6>
                      <ul class="text-muted font-12 pl-3 mb-0" style="line-height:1.6;">
                        <li><strong>Display Order 1-3:</strong> Top executive cards (Chancellor, Pro Chancellor, VC).</li>
                        <li><strong>Quotes:</strong> Highlight quotes appear prominently on both desktop and mobile views.</li>
                        <li><strong>Real-time Preview:</strong> You can see live changes on <a href="../leadership.php" target="_blank" class="text-primary font-weight-bold">leadership.php</a> immediately after saving.</li>
                      </ul>
                    </div>

                  </div>
                </div>

                <div class="pt-4 mt-4 border-top d-flex align-items-center justify-content-between">
                  <a href="<?php echo PAGE; ?>" class="btn btn-light px-4 py-2 font-weight-bold text-muted">
                    <i class="mdi mdi-close mr-1"></i> Cancel
                  </a>
                  <button type="submit" name="submit" class="bu-btn-gold px-4 py-2">
                    <i class="mdi mdi-content-save mr-1"></i> <?php echo ($action == 'add') ? 'Save Leader Profile' : 'Update Leader Profile'; ?>
                  </button>
                </div>
              </form>
            </div>
          </div>

        <?php else: ?>

          <!-- KPI Summary Metrics Strip -->
          <div class="bu-kpi-grid">
            <div class="bu-kpi-box">
              <div class="bu-kpi-icon-wrap" style="background:#EFF6FF; color:#1D4ED8;">
                <i class="mdi mdi-account-multiple"></i>
              </div>
              <div>
                <div class="bu-kpi-val"><?php echo $totalLeaders; ?></div>
                <div class="bu-kpi-lbl">Total Leaders</div>
              </div>
            </div>

            <div class="bu-kpi-box">
              <div class="bu-kpi-icon-wrap" style="background:#FEF3C7; color:#B45309;">
                <i class="mdi mdi-crown"></i>
              </div>
              <div>
                <div class="bu-kpi-val"><?php echo $executiveCount; ?></div>
                <div class="bu-kpi-lbl">Executive Chancellery</div>
              </div>
            </div>

            <div class="bu-kpi-box">
              <div class="bu-kpi-icon-wrap" style="background:#F0F9FF; color:#0284C7;">
                <i class="mdi mdi-shield"></i>
              </div>
              <div>
                <div class="bu-kpi-val"><?php echo $adminCount; ?></div>
                <div class="bu-kpi-lbl">Administrative Heads</div>
              </div>
            </div>

            <div class="bu-kpi-box">
              <div class="bu-kpi-icon-wrap" style="background:#ECFDF5; color:#047857;">
                <i class="mdi mdi-check-circle"></i>
              </div>
              <div>
                <div class="bu-kpi-val text-success">Active</div>
                <div class="bu-kpi-lbl">Live on Portal</div>
              </div>
            </div>
          </div>

          <!-- Main Table Card -->
          <div class="bu-card-main">
            <div class="bu-card-header-bar">
              <div>
                <h5 class="bu-card-title">
                  <i class="mdi mdi-account-star text-primary"></i> University Leadership Directory
                </h5>
                <span class="text-muted font-12">Ordered roster of Chancellor, VC, Deans, Directors and Administrative Heads</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <a href="<?php echo PAGE; ?>?action=add" class="bu-btn-gold" style="font-size:12.5px; padding:8px 16px;">
                  <i class="mdi mdi-plus"></i> Add New Leader
                </a>
              </div>
            </div>

            <!-- Instant Search & Filter Toolbar -->
            <div class="bu-filter-toolbar">
              <div class="bu-search-box">
                <i class="mdi mdi-magnify"></i>
                <input type="text" id="leaderSearchInput" class="bu-search-input" placeholder="Search leader by name, role or designation..." onkeyup="filterLeaderTable()">
              </div>
              <div>
                <select id="roleFilterSelect" class="bu-role-filter-select" onchange="filterLeaderTable()">
                  <option value="all">All Roles &amp; Categories</option>
                  <option value="chancellor">Chancellor / Pro Chancellor</option>
                  <option value="vice chancellor">Vice Chancellor</option>
                  <option value="ceo">CEO</option>
                  <option value="director">Director</option>
                  <option value="registrar">Registrar</option>
                </select>
              </div>
              <div class="ml-auto text-muted font-12 font-weight-bold">
                Showing <span id="visibleCount" class="text-primary font-weight-bold"><?php echo $totalLeaders; ?></span> of <?php echo $totalLeaders; ?> Leaders
              </div>
            </div>

            <!-- Table Container -->
            <div class="table-responsive">
              <table class="bu-table" id="leadersTable">
                <thead>
                  <tr>
                    <th style="width:52px;" class="text-center">Photo</th>
                    <th style="width:31%;">Name &amp; Vision Statement</th>
                    <th style="width:18%;">Role / Title</th>
                    <th style="width:29%;">Official Designation</th>
                    <th style="width:48px;" class="text-center">Order</th>
                    <th style="width:115px;" class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($allLeaders)): ?>
                    <tr>
                      <td colspan="6" class="text-center py-4 text-muted">
                        <i class="mdi mdi-account-off font-32 text-muted mb-2 d-block"></i>
                        No Leadership records found. Click <strong>"Add New Leader"</strong> above to create one.
                      </td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($allLeaders as $ldr): ?>
                      <?php
                        $badgeInfo = bu_get_role_badge($ldr['title'] ?? '');
                        $hasImage = (!empty($ldr['image']) && file_exists(UPLOAD . $ldr['image']));
                        $imgSrc = $hasImage ? UPLOAD . $ldr['image'] : '';
                        $initials = '';
                        $nameParts = explode(' ', trim($ldr['name']));
                        foreach ($nameParts as $p) {
                            if (!empty($p) && !in_array(strtolower($p), ['mr.', 'ms.', 'dr.', 'prof.', 'prof.(dr.)', 'shri'])) {
                                $initials .= strtoupper(substr($p, 0, 1));
                                if (strlen($initials) >= 2) break;
                            }
                        }
                        if (empty($initials)) $initials = 'BU';
                      ?>
                      <tr class="leader-row" 
                          data-name="<?php echo htmlspecialchars(strtolower($ldr['name'])); ?>"
                          data-role="<?php echo htmlspecialchars(strtolower($ldr['title'])); ?>"
                          data-desig="<?php echo htmlspecialchars(strtolower($ldr['designation'])); ?>">
                        
                        <!-- Photo Column -->
                        <td class="text-center">
                          <div class="bu-avatar-wrap">
                            <?php if ($hasImage): ?>
                              <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($ldr['name']); ?>" class="bu-avatar-img">
                            <?php else: ?>
                              <div class="bu-avatar-placeholder"><?php echo $initials; ?></div>
                            <?php endif; ?>
                          </div>
                        </td>

                        <!-- Name Column -->
                        <td>
                          <div class="bu-leader-name">
                            <?php echo htmlspecialchars($ldr['name']); ?>
                          </div>
                          <?php if (!empty($ldr['quote'])): ?>
                            <span class="bu-leader-subquote" title="<?php echo htmlspecialchars($ldr['quote']); ?>">
                              &ldquo;<?php echo htmlspecialchars($ldr['quote']); ?>&rdquo;
                            </span>
                          <?php endif; ?>
                          <?php if (!empty($ldr['chips'])): ?>
                            <div class="bu-chips-strip">
                              <?php 
                                $chipsArr = array_slice(explode(',', $ldr['chips']), 0, 2);
                                foreach ($chipsArr as $ch):
                                  $ch = trim($ch);
                                  if (!empty($ch)):
                              ?>
                                <span class="bu-chip-tag"><?php echo htmlspecialchars($ch); ?></span>
                              <?php endif; endforeach; ?>
                            </div>
                          <?php endif; ?>
                        </td>

                        <!-- Role / Title Column -->
                        <td>
                          <span class="bu-role-pill" style="background:<?php echo $badgeInfo['bg']; ?>; color:<?php echo $badgeInfo['color']; ?>; border:1px solid <?php echo $badgeInfo['border']; ?>;">
                            <i class="mdi <?php echo $badgeInfo['icon']; ?>"></i>
                            <?php echo htmlspecialchars($badgeInfo['label']); ?>
                          </span>
                        </td>

                        <!-- Designation Column -->
                        <td>
                          <div style="font-size:12px; line-height:1.35; color:#334155; font-weight:500;">
                            <?php echo htmlspecialchars($ldr['designation']); ?>
                          </div>
                        </td>

                        <!-- Order Column -->
                        <td class="text-center">
                          <div class="bu-order-circle">
                            <?php echo intval($ldr['sort_order']); ?>
                          </div>
                        </td>

                        <!-- Action Buttons -->
                        <td class="text-right">
                          <div class="bu-action-btn-group">
                            <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $ldr['id']; ?>" class="bu-btn-action bu-btn-edit" title="Edit Leader">
                              <i class="mdi mdi-pencil"></i> Edit
                            </a>
                            <a href="<?php echo PAGE; ?>?action=delete&id=<?php echo $ldr['id']; ?>" class="bu-btn-action bu-btn-delete" onclick="return confirm('Are you sure you want to delete <?php echo addslashes($ldr['name']); ?>?');" title="Delete Leader">
                              <i class="mdi mdi-delete"></i> Delete
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

          </div>

        <?php endif; ?>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>

<?php include_once("inc.footer.js.php"); ?>

<script>
// Initialize CKEditor if on Add / Edit view
if (typeof CKEDITOR !== 'undefined' && document.getElementById('ck_about')) {
    CKEDITOR.replace('ck_about');
}

// Quick helper to fill Role Title suggestion
function setRoleTitle(roleText) {
    var input = document.getElementById('roleTitleInput');
    if (input) {
        input.value = roleText;
        input.focus();
    }
}

// Live preview photo on selection
function previewSelectedPhoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var imgEl = document.getElementById('photoPreviewImg');
            var phEl = document.getElementById('photoPlaceholder');
            if (imgEl) {
                imgEl.src = e.target.result;
                imgEl.style.display = 'block';
            }
            if (phEl) {
                phEl.style.display = 'none';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Instant table search & role filter
function filterLeaderTable() {
    var searchInput = document.getElementById('leaderSearchInput');
    var query = (searchInput ? searchInput.value : '').toLowerCase().trim();
    
    var roleSelect = document.getElementById('roleFilterSelect');
    var selectedRole = (roleSelect ? roleSelect.value : 'all').toLowerCase();
    
    var rows = document.querySelectorAll('.leader-row');
    var visible = 0;

    rows.forEach(function(row) {
        var name = row.getAttribute('data-name') || '';
        var role = row.getAttribute('data-role') || '';
        var desig = row.getAttribute('data-desig') || '';

        var matchesSearch = (query === '' || name.indexOf(query) !== -1 || role.indexOf(query) !== -1 || desig.indexOf(query) !== -1);
        var matchesRole = (selectedRole === 'all' || role.indexOf(selectedRole) !== -1);

        if (matchesSearch && matchesRole) {
            row.style.display = '';
            visible++;
        } else {
            row.style.display = 'none';
        }
    });

    var countEl = document.getElementById('visibleCount');
    if (countEl) {
        countEl.textContent = visible;
    }
}
</script>
</body>
</html>