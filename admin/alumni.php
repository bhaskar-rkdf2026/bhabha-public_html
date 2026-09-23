<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
define("PAGE", 'alumni.php');
define("TITLE", 'Alumni Registrations');
define("DBTAB", 'alumni');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Delete Handler
if ($action == "delete" && !empty($_REQUEST['id'])) {
    $del_id = intval($_REQUEST['id']);
    $db->where('id', $del_id);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Alumni record deleted successfully!';
    redirect(PAGE);
}

// Fetch filter parameters
$filter_name           = trim($_GET['filter_name'] ?? '');
$filter_college        = trim($_GET['filter_college'] ?? '');
$filter_specialization = trim($_GET['filter_specialization'] ?? '');
$filter_year           = trim($_GET['filter_year'] ?? '');

$has_filter = (!empty($filter_name) || !empty($filter_college) || !empty($filter_specialization) || !empty($filter_year));

// Datalist options
$distinct_colleges = $db->rawQuery("SELECT DISTINCT college FROM alumni WHERE college != '' AND college IS NOT NULL ORDER BY college ASC");
$distinct_branches = $db->rawQuery("SELECT DISTINCT branch as val FROM alumni WHERE branch != '' AND branch IS NOT NULL UNION SELECT DISTINCT course as val FROM alumni WHERE course != '' AND course IS NOT NULL ORDER BY val ASC");
$distinct_years    = $db->rawQuery("SELECT DISTINCT passing_year FROM alumni WHERE passing_year != '' AND passing_year IS NOT NULL ORDER BY passing_year DESC");

$totalAlumni = $db->getValue(DBTAB, 'count(*)');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> Management - Bhabha University Admin</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<style>
/* ==========================================================================
   Bhabha University Executive Alumni Theme
   ========================================================================== */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #061442;
  --bu-navy-light: #1E3A8A;
  --bu-gold: #D99B00;
  --bu-gold-light: #FEF3C7;
  --bu-gold-dark: #B8860B;
  --bu-border: #E2E8F0;
  --bu-bg-soft: #F8FAFC;
  --bu-text-dark: #0F172A;
  --bu-text-muted: #64748B;
}

/* Header & Stat Badges */
.bu-admin-header-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 20px 24px;
  margin-bottom: 22px;
  box-shadow: 0 4px 15px rgba(10, 27, 84, 0.04);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
}
.bu-admin-header-title h4 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 22px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 5px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-admin-header-title p {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  margin: 0;
}
.bu-stat-badge {
  background: rgba(10, 27, 84, 0.06);
  color: var(--bu-navy);
  border: 1px solid rgba(10, 27, 84, 0.15);
  font-size: 13.5px;
  font-weight: 700;
  padding: 8px 18px;
  border-radius: 30px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-stat-badge strong {
  color: var(--bu-gold);
  font-size: 16px;
}

/* Filter Card */
.bu-filter-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 20px 24px;
  margin-bottom: 22px;
  box-shadow: 0 4px 15px rgba(10, 27, 84, 0.03);
}
.bu-filter-title {
  font-size: 15px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-filter-card label {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--bu-text-muted);
  letter-spacing: 0.4px;
  margin-bottom: 6px;
  display: flex;
  align-items: center;
  gap: 5px;
}
.bu-filter-card .form-control {
  border-radius: 8px;
  border: 1px solid #CBD5E1;
  font-size: 13.5px;
  height: 40px;
  padding: 8px 12px;
  transition: all 0.2s;
}
.bu-filter-card .form-control:focus {
  border-color: var(--bu-navy);
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.1);
}

.bu-btn-primary {
  background: linear-gradient(135deg, var(--bu-navy) 0%, var(--bu-navy-dark) 100%);
  color: #ffffff !important;
  font-weight: 700;
  border: none;
  border-radius: 8px;
  padding: 9px 20px;
  font-size: 13.5px;
  height: 40px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  transition: all 0.2s;
  box-shadow: 0 4px 10px rgba(10, 27, 84, 0.2);
}
.bu-btn-primary:hover {
  background: linear-gradient(135deg, var(--bu-navy-light) 0%, var(--bu-navy) 100%);
  transform: translateY(-1px);
  box-shadow: 0 6px 14px rgba(10, 27, 84, 0.3);
}
.bu-btn-reset {
  background: #F1F5F9;
  color: #475569 !important;
  font-weight: 700;
  border: 1px solid #CBD5E1;
  border-radius: 8px;
  padding: 9px 16px;
  font-size: 13px;
  height: 40px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
  text-decoration: none !important;
  transition: all 0.2s;
}
.bu-btn-reset:hover {
  background: #E2E8F0;
  color: #1E293B !important;
}

/* Data Table Card */
.bu-table-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  box-shadow: 0 4px 20px rgba(10, 27, 84, 0.04);
  overflow: hidden;
  margin-bottom: 30px;
}
.bu-table-header {
  padding: 18px 24px;
  border-bottom: 1px solid var(--bu-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
}
.bu-table-header h5 {
  margin: 0;
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Member Column */
.bu-member-cell {
  display: flex;
  align-items: center;
  gap: 12px;
}
.bu-member-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--bu-navy) 0%, var(--bu-navy-light) 100%);
  color: #FFC107;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  font-weight: 800;
  flex-shrink: 0;
  border: 2px solid #E2E8F0;
}
.bu-member-meta {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.bu-member-name {
  font-weight: 800;
  font-size: 14px;
  color: var(--bu-navy);
}
.bu-enroll-badge {
  background: rgba(10, 27, 84, 0.08);
  color: var(--bu-navy);
  font-size: 11px;
  font-weight: 700;
  padding: 2px 7px;
  border-radius: 4px;
  border: 1px solid rgba(10, 27, 84, 0.15);
  display: inline-block;
  width: fit-content;
}

/* Academic Info */
.bu-course-pill {
  background: #EFF6FF;
  color: #1E40AF;
  border: 1px solid #BFDBFE;
  font-size: 12px;
  font-weight: 800;
  padding: 3px 8px;
  border-radius: 5px;
  display: inline-block;
}
.bu-branch-sub {
  font-size: 11px;
  color: #64748B;
  font-weight: 600;
  margin-top: 3px;
  display: flex;
  align-items: center;
  gap: 4px;
}
.bu-year-chip {
  background: var(--bu-gold-light);
  color: #92400E;
  border: 1px solid #FCD34D;
  font-size: 12px;
  font-weight: 800;
  padding: 3px 9px;
  border-radius: 12px;
  display: inline-block;
}

/* Contact Links */
.bu-contact-stack {
  display: flex;
  flex-direction: column;
  gap: 3px;
  font-size: 12px;
}
.bu-contact-link {
  color: #2563EB !important;
  font-weight: 600;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.bu-contact-link:hover {
  text-decoration: underline !important;
  color: #1D4ED8 !important;
}

/* Action Buttons */
.bu-action-btn-group {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.bu-btn-icon {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  transition: all 0.2s ease;
  border: none;
  cursor: pointer;
  text-decoration: none !important;
}
.bu-btn-view {
  background: var(--bu-navy);
  color: #ffffff !important;
}
.bu-btn-view:hover {
  background: var(--bu-navy-dark);
  color: #FFC107 !important;
  transform: translateY(-2px);
}
.bu-btn-whatsapp {
  background: #25D366;
  color: #ffffff !important;
}
.bu-btn-whatsapp:hover {
  background: #1EBE5D;
  transform: translateY(-2px);
}
.bu-btn-del {
  background: #FEE2E2;
  color: #DC2626 !important;
  border: 1px solid #FECACA;
}
.bu-btn-del:hover {
  background: #DC2626;
  color: #ffffff !important;
  transform: translateY(-2px);
}

/* Detail Section View */
.bu-detail-header-banner {
  background: linear-gradient(135deg, var(--bu-navy) 0%, var(--bu-navy-dark) 100%);
  border-radius: 12px;
  padding: 24px 28px;
  color: #ffffff;
  margin-bottom: 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  box-shadow: 0 6px 20px rgba(10, 27, 84, 0.15);
}
.bu-detail-title-group h3 {
  margin: 0 0 6px 0;
  font-size: 24px;
  font-weight: 800;
  color: #ffffff;
  font-family: 'Plus Jakarta Sans', sans-serif;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-detail-title-group p {
  margin: 0;
  color: #E2E8F0;
  font-size: 14px;
}
.bu-detail-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 24px;
  margin-bottom: 22px;
  box-shadow: 0 4px 15px rgba(10, 27, 84, 0.03);
}
.bu-section-title {
  font-size: 16px;
  font-weight: 800;
  color: var(--bu-navy);
  text-transform: uppercase;
  letter-spacing: 0.6px;
  padding-bottom: 12px;
  border-bottom: 2px solid var(--bu-border);
  margin-bottom: 18px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-section-title i {
  color: var(--bu-gold);
  font-size: 18px;
}
.bu-info-item label {
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--bu-text-muted);
  letter-spacing: 0.5px;
  margin-bottom: 4px;
  display: block;
}
.bu-info-item .val {
  font-size: 14.5px;
  font-weight: 600;
  color: var(--bu-text-dark);
  background: var(--bu-bg-soft);
  border: 1px solid var(--bu-border);
  border-radius: 8px;
  padding: 10px 14px;
  min-height: 42px;
  display: flex;
  align-items: center;
  word-break: break-word;
}

/* Modal Polish */
.modal-content {
  border-radius: 14px;
  border: none;
  box-shadow: 0 15px 40px rgba(10, 27, 84, 0.2);
}
.modal-header {
  background: linear-gradient(135deg, var(--bu-navy) 0%, var(--bu-navy-dark) 100%);
  color: #ffffff;
  border-top-left-radius: 14px;
  border-top-right-radius: 14px;
  padding: 16px 22px;
}
.modal-header .modal-title {
  color: #ffffff;
  font-weight: 800;
  font-size: 17px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.modal-header .close {
  color: #ffffff;
  opacity: 0.85;
}

/* DataTable Buttons & Controls Theme */
.dt-buttons .btn-secondary {
  background: #ffffff !important;
  color: var(--bu-navy) !important;
  border: 1px solid var(--bu-border) !important;
  font-weight: 700 !important;
  font-size: 12.5px !important;
  border-radius: 6px !important;
  box-shadow: none !important;
  margin-right: 4px !important;
  padding: 5px 12px !important;
  transition: all 0.2s !important;
}
.dt-buttons .btn-secondary:hover {
  background: var(--bu-navy) !important;
  color: #FFC107 !important;
  border-color: var(--bu-navy) !important;
}
div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link {
  background-color: var(--bu-navy) !important;
  border-color: var(--bu-navy) !important;
  color: #ffffff !important;
  font-weight: 800;
}
</style>
</head>
<body>
<!-- Begin page -->
<div id="wrapper"><!-- Top Bar Start -->
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page"><!-- Start content -->
    <div class="content">
      <div class="container-fluid">
        
        <!-- Header Banner Card -->
        <div class="bu-admin-header-card">
          <div class="bu-admin-header-title">
            <h4><i class="mdi mdi-school" style="color:var(--bu-gold);"></i> <?php echo TITLE; ?></h4>
            <p>Search, review, and manage verified alumni members and graduation profiles across university colleges.</p>
          </div>
          <div class="bu-stat-badge">
            <i class="mdi mdi-account-group" style="color:var(--bu-gold);font-size:16px;"></i>
            Total Registrations: <strong><?php echo number_format($totalAlumni); ?></strong>
          </div>
        </div>

        <?php if (!empty($stat)): ?>
          <div class="mb-3"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <?php
        // =========================================================================
        // VIEW SINGLE ALUMNI RECORD
        // =========================================================================
        if ($action == "view") {
            $view_id = intval($_REQUEST['id'] ?? 0);
            $db->where('id', $view_id);
            $aryData = $db->getOne(DBTAB);

            if (!$aryData) {
                echo '<div class="alert alert-danger font-weight-bold p-3 rounded-lg"><i class="mdi mdi-alert-circle"></i> Alumni record not found. <a href="alumni.php" class="text-white ml-2 underline">Back to list</a></div>';
            } else {
        ?>
        <!-- Detail Header Banner -->
        <div class="bu-detail-header-banner">
          <div class="bu-detail-title-group">
            <h3><i class="mdi mdi-account-card-details" style="color:var(--bu-gold);"></i> <?php echo htmlspecialchars($aryData['name'] ?? ''); ?></h3>
            <p>
              <?php if (!empty($aryData['enrollment_no'])): ?>
                <span class="badge badge-warning mr-2" style="font-size:12px;color:#000;font-weight:800;"><?php echo htmlspecialchars($aryData['enrollment_no']); ?></span>
              <?php endif; ?>
              <?php echo htmlspecialchars($aryData['course'] ?: 'Alumnus'); ?> • Class of <?php echo htmlspecialchars($aryData['passing_year'] ?: '-'); ?>
            </p>
          </div>
          <div class="d-flex align-items-center" style="gap:10px;">
            <?php if (!empty($aryData['whatsapp'])): ?>
              <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $aryData['whatsapp']); ?>" target="_blank" class="btn btn-success font-weight-bold waves-effect" style="border-radius:8px;">
                <i class="mdi mdi-whatsapp"></i> WhatsApp
              </a>
            <?php endif; ?>
            <a href="<?php echo PAGE;?>" class="btn btn-light font-weight-bold waves-effect" style="border-radius:8px;color:var(--bu-navy);">
              <i class="mdi mdi-arrow-left"></i> Back to List
            </a>
            <a href="<?php echo PAGE;?>?id=<?php echo $aryData['id']?>&action=delete" onclick="return confirm('Are you sure you want to permanently delete this alumni record?');" class="btn btn-danger font-weight-bold waves-effect" style="border-radius:8px;">
              <i class="mdi mdi-delete"></i> Delete
            </a>
          </div>
        </div>

        <div class="row">
          <!-- Left Column: Personal & Academic -->
          <div class="col-lg-6">
            
            <!-- 1. PERSONAL DETAILS -->
            <div class="bu-detail-card">
              <div class="bu-section-title">
                <i class="mdi mdi-account-circle"></i> Personal Details
              </div>
              <div class="row">
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Full Name</label>
                  <div class="val font-weight-bold text-dark"><?php echo htmlspecialchars($aryData['name'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Enrollment Number</label>
                  <div class="val text-primary font-weight-bold"><?php echo htmlspecialchars($aryData['enrollment_no'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>College Nick Name</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['nick_name'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Gender</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['gender'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Father's Name</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['fname'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Mother's Name</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['mname'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Date of Birth</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['dob'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Marital Status</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['marital'] ?: '-'); ?></div>
                </div>
                <?php if (!empty($aryData['dom'])): ?>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Date of Marriage</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['dom']); ?></div>
                </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- 2. ACADEMIC RECORDS -->
            <div class="bu-detail-card">
              <div class="bu-section-title">
                <i class="mdi mdi-school"></i> Academic Records
              </div>
              <div class="row">
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>College / Institute</label>
                  <div class="val font-weight-bold" style="color:var(--bu-navy);"><?php echo htmlspecialchars($aryData['college'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Course Completed</label>
                  <div class="val font-weight-bold text-primary"><?php echo htmlspecialchars($aryData['course'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Branch / Specialization</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['branch'] ?: '-'); ?></div>
                </div>
                <div class="col-md-4 mb-3 bu-info-item">
                  <label>Admission Year</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['admission_year'] ?: '-'); ?></div>
                </div>
                <div class="col-md-4 mb-3 bu-info-item">
                  <label>Passing Year</label>
                  <div class="val font-weight-bold text-success"><?php echo htmlspecialchars($aryData['passing_year'] ?: '-'); ?></div>
                </div>
                <div class="col-md-4 mb-3 bu-info-item">
                  <label>Further Studies</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['further_study'] ?: '-'); ?></div>
                </div>
              </div>
            </div>

          </div>

          <!-- Right Column: Contact & Professional -->
          <div class="col-lg-6">
            
            <!-- 3. CONTACT DETAILS -->
            <div class="bu-detail-card">
              <div class="bu-section-title">
                <i class="mdi mdi-phone-in-talk"></i> Contact &amp; Communication
              </div>
              <div class="row">
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Mobile Number</label>
                  <div class="val">
                    <?php if (!empty($aryData['mobile'])): ?>
                      <a href="tel:<?php echo htmlspecialchars($aryData['mobile']); ?>" class="bu-contact-link"><i class="mdi mdi-phone"></i> <?php echo htmlspecialchars($aryData['mobile']); ?></a>
                    <?php else: ?> - <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>WhatsApp Number</label>
                  <div class="val">
                    <?php if (!empty($aryData['whatsapp'])): ?>
                      <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $aryData['whatsapp']); ?>" target="_blank" class="bu-contact-link text-success"><i class="mdi mdi-whatsapp"></i> <?php echo htmlspecialchars($aryData['whatsapp']); ?></a>
                    <?php else: ?> - <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Email Address</label>
                  <div class="val">
                    <?php if (!empty($aryData['email'])): ?>
                      <a href="mailto:<?php echo htmlspecialchars($aryData['email']); ?>" class="bu-contact-link"><i class="mdi mdi-email-outline"></i> <?php echo htmlspecialchars($aryData['email']); ?></a>
                    <?php else: ?> - <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Current City / Location</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['city'] ?: '-'); ?></div>
                </div>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Present Address</label>
                  <div class="val"><?php echo nl2br(htmlspecialchars($aryData['address'] ?: '-')); ?></div>
                </div>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Permanent Address</label>
                  <div class="val"><?php echo nl2br(htmlspecialchars($aryData['perm_address'] ?: '-')); ?></div>
                </div>
              </div>
            </div>

            <!-- 4. PROFESSIONAL & SOCIAL PROFILE -->
            <div class="bu-detail-card">
              <div class="bu-section-title">
                <i class="mdi mdi-briefcase"></i> Professional &amp; Social Profile
              </div>
              <div class="row">
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Current Occupation</label>
                  <div class="val font-weight-bold"><?php echo htmlspecialchars($aryData['occupation'] ?: '-'); ?></div>
                </div>
                <div class="col-md-6 mb-3 bu-info-item">
                  <label>Designation / Job Title</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['job_title'] ?: '-'); ?></div>
                </div>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Company / Organization</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['company'] ?: '-'); ?></div>
                </div>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Social Profiles</label>
                  <div class="val d-flex flex-wrap" style="gap:8px;min-height:48px;">
                    <?php if (!empty($aryData['linkedin'])): ?>
                      <a href="<?php echo htmlspecialchars($aryData['linkedin']); ?>" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius:6px;"><i class="mdi mdi-linkedin"></i> LinkedIn</a>
                    <?php endif; ?>
                    <?php if (!empty($aryData['facebook'])): ?>
                      <a href="<?php echo htmlspecialchars($aryData['facebook']); ?>" target="_blank" class="btn btn-sm btn-outline-info" style="border-radius:6px;"><i class="mdi mdi-facebook"></i> Facebook</a>
                    <?php endif; ?>
                    <?php if (!empty($aryData['twitter'])): ?>
                      <a href="<?php echo htmlspecialchars($aryData['twitter']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" style="border-radius:6px;"><i class="mdi mdi-twitter"></i> Twitter/X</a>
                    <?php endif; ?>
                    <?php if (empty($aryData['linkedin']) && empty($aryData['facebook']) && empty($aryData['twitter'])): ?>
                      <span class="text-muted">No social profile links provided.</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-12 mb-3 bu-info-item">
                  <label>Application Registration Date</label>
                  <div class="val text-muted"><i class="mdi mdi-calendar-clock mr-1"></i> <?php echo htmlspecialchars($aryData['date'] ?? 'N/A'); ?></div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="mb-4">
          <a href="<?php echo PAGE;?>" class="bu-btn-primary"><i class="mdi mdi-arrow-left"></i> Back to Registrations List</a>
        </div>

        <?php
            }
        } else {
            // =========================================================================
            // LIST VIEW WITH SEARCH FILTER & DATATABLE
            // =========================================================================
        ?>
        
        <!-- Filter Card -->
        <div class="bu-filter-card">
          <div class="bu-filter-title">
            <i class="mdi mdi-filter-variant" style="color:var(--bu-gold);font-size:18px;"></i> Search &amp; Filter Alumni Network
          </div>
          <form method="get" action="alumni.php" class="row">
            <div class="form-group col-lg-3 col-md-6 mb-3">
              <label><i class="mdi mdi-account-search"></i> Name / Roll No / Phone</label>
              <input type="text" name="filter_name" class="form-control" placeholder="Search by name, roll no, mobile..." value="<?php echo htmlspecialchars($filter_name); ?>">
            </div>
            <div class="form-group col-lg-3 col-md-6 mb-3">
              <label><i class="mdi mdi-domain"></i> College / Institute</label>
              <input type="text" name="filter_college" list="list_colleges" class="form-control" placeholder="Select or type college..." value="<?php echo htmlspecialchars($filter_college); ?>">
              <datalist id="list_colleges">
                <?php if (is_array($distinct_colleges)) foreach ($distinct_colleges as $dc): ?>
                  <option value="<?php echo htmlspecialchars($dc['college']); ?>"></option>
                <?php endforeach; ?>
              </datalist>
            </div>
            <div class="form-group col-lg-3 col-md-6 mb-3">
              <label><i class="mdi mdi-book-open-variant"></i> Specialization / Branch</label>
              <input type="text" name="filter_specialization" list="list_branches" class="form-control" placeholder="e.g. Computer Science, Pharmacy..." value="<?php echo htmlspecialchars($filter_specialization); ?>">
              <datalist id="list_branches">
                <?php if (is_array($distinct_branches)) foreach ($distinct_branches as $dbx): if (!empty($dbx['val'])): ?>
                  <option value="<?php echo htmlspecialchars($dbx['val']); ?>"></option>
                <?php endif; endforeach; ?>
              </datalist>
            </div>
            <div class="form-group col-lg-1 col-md-3 mb-3">
              <label><i class="mdi mdi-calendar"></i> Year</label>
              <input type="text" name="filter_year" list="list_years" class="form-control" placeholder="Year" value="<?php echo htmlspecialchars($filter_year); ?>">
              <datalist id="list_years">
                <?php if (is_array($distinct_years)) foreach ($distinct_years as $dy): ?>
                  <option value="<?php echo htmlspecialchars($dy['passing_year']); ?>"></option>
                <?php endforeach; ?>
              </datalist>
            </div>
            <div class="form-group col-lg-2 col-md-3 mb-3 d-flex align-items-end" style="gap:6px;">
              <button type="submit" class="bu-btn-primary flex-grow-1"><i class="mdi mdi-magnify"></i> Search</button>
              <?php if ($has_filter): ?>
                <a href="alumni.php" class="bu-btn-reset" title="Reset Filters"><i class="mdi mdi-close"></i></a>
              <?php endif; ?>
            </div>
          </form>

          <?php if ($has_filter): ?>
            <div class="mt-2 text-primary font-weight-bold font-13">
              <i class="mdi mdi-filter-check"></i> Active filters applied. 
              <a href="alumni.php" class="text-danger ml-2 font-weight-normal"><i class="mdi mdi-close-circle"></i> Clear all filters</a>
            </div>
          <?php endif; ?>
        </div>

        <!-- Table Card -->
        <div class="bu-table-card">
          <div class="bu-table-header">
            <h5><i class="mdi mdi-account-group" style="color:var(--bu-gold);"></i> All Alumni Registrations</h5>
            <span class="text-muted font-13 font-weight-bold">
              Showing indexed records with instant export &amp; details preview
            </span>
          </div>
          <div class="p-3">
            <div class="table-responsive">
              <table id="alumni-datatable" class="table table-hover table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background: #F8FAFC;">
                  <tr style="color: var(--bu-navy); font-size: 13px;">
                    <th style="width: 50px;"># ID</th>
                    <th>Alumni Member</th>
                    <th>College / Institute</th>
                    <th>Course &amp; Branch</th>
                    <th style="text-align:center;">Passing Year</th>
                    <th>Contact &amp; Social</th>
                    <th>Registered</th>
                    <th style="text-align:center; width: 120px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Build queries based on filter
                  if (!empty($filter_name)) {
                      $escName = $db->escape($filter_name);
                      $db->where("(name LIKE '%".$escName."%' OR enrollment_no LIKE '%".$escName."%' OR email LIKE '%".$escName."%' OR mobile LIKE '%".$escName."%')");
                  }
                  if (!empty($filter_college)) {
                      $escCollege = $db->escape($filter_college);
                      $db->where("college LIKE '%".$escCollege."%'");
                  }
                  if (!empty($filter_specialization)) {
                      $escSpec = $db->escape($filter_specialization);
                      $db->where("(branch LIKE '%".$escSpec."%' OR course LIKE '%".$escSpec."%')");
                  }
                  if (!empty($filter_year)) {
                      $escYear = $db->escape($filter_year);
                      $db->where("passing_year LIKE '%".$escYear."%'");
                  }

                  $db->orderBy('id', 'DESC');
                  $alumniList = $db->get(DBTAB, 1500);

                  if (is_array($alumniList) && count($alumniList) > 0) {
                      foreach ($alumniList as $row) {
                          $initial = strtoupper(substr(trim($row['name'] ?: 'A'), 0, 1));
                          $cleanPhone = preg_replace('/[^0-9]/', '', $row['mobile'] ?? '');
                          $cleanWa = preg_replace('/[^0-9]/', '', $row['whatsapp'] ?? ($row['mobile'] ?? ''));
                  ?>
                  <tr>
                    <td>
                      <span class="badge badge-light font-weight-bold" style="font-size:12px;color:var(--bu-navy);border:1px solid #CBD5E1;">
                        #<?php echo $row['id']; ?>
                      </span>
                    </td>
                    <td>
                      <div class="bu-member-cell">
                        <div class="bu-member-avatar"><?php echo $initial; ?></div>
                        <div class="bu-member-meta">
                          <span class="bu-member-name"><?php echo htmlspecialchars(ucwords(strtolower($row['name'] ?? ''))); ?></span>
                          <?php if (!empty($row['enrollment_no'])): ?>
                            <span class="bu-enroll-badge"><?php echo htmlspecialchars($row['enrollment_no']); ?></span>
                          <?php endif; ?>
                          <?php if (!empty($row['nick_name'])): ?>
                            <small class="text-muted"><i class="mdi mdi-emoticon-outline"></i> "<?php echo htmlspecialchars($row['nick_name']); ?>"</small>
                          <?php endif; ?>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span style="font-size:13px;font-weight:600;color:#334155;">
                        <?php echo htmlspecialchars($row['college'] ?: '-'); ?>
                      </span>
                    </td>
                    <td>
                      <span class="bu-course-pill"><?php echo htmlspecialchars($row['course'] ?: '-'); ?></span>
                      <?php if (!empty($row['branch'])): ?>
                        <div class="bu-branch-sub"><i class="mdi mdi-tag-outline"></i> <?php echo htmlspecialchars($row['branch']); ?></div>
                      <?php endif; ?>
                    </td>
                    <td style="text-align:center;">
                      <span class="bu-year-chip"><?php echo htmlspecialchars($row['passing_year'] ?: '-'); ?></span>
                    </td>
                    <td>
                      <div class="bu-contact-stack">
                        <?php if (!empty($row['mobile'])): ?>
                          <a href="tel:<?php echo htmlspecialchars($row['mobile']); ?>" class="bu-contact-link">
                            <i class="mdi mdi-phone font-14"></i> <?php echo htmlspecialchars($row['mobile']); ?>
                          </a>
                        <?php endif; ?>
                        <?php if (!empty($row['email'])): ?>
                          <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="bu-contact-link" style="color:var(--bu-text-muted)!important;font-size:11.5px;">
                            <i class="mdi mdi-email-outline"></i> <?php echo htmlspecialchars($row['email']); ?>
                          </a>
                        <?php endif; ?>
                        <?php if (!empty($row['city'])): ?>
                          <span style="font-size:11px;color:#64748B;"><i class="mdi mdi-map-marker-outline"></i> <?php echo htmlspecialchars($row['city']); ?></span>
                        <?php endif; ?>
                      </div>
                    </td>
                    <td>
                      <small class="text-muted font-weight-bold"><?php echo !empty($row['date']) ? date('d M Y', strtotime($row['date'])) : '-'; ?></small>
                    </td>
                    <td style="text-align:center;">
                      <div class="bu-action-btn-group">
                        <!-- Quick View Modal Trigger -->
                        <button type="button" class="bu-btn-icon bu-btn-view" data-toggle="modal" data-target="#alumniModal<?php echo $row['id']; ?>" title="Quick Preview">
                          <i class="mdi mdi-eye"></i>
                        </button>
                        <!-- WhatsApp Link -->
                        <?php if (!empty($cleanWa)): ?>
                          <a href="https://wa.me/<?php echo $cleanWa; ?>" target="_blank" class="bu-btn-icon bu-btn-whatsapp" title="Chat on WhatsApp">
                            <i class="mdi mdi-whatsapp"></i>
                          </a>
                        <?php endif; ?>
                        <!-- Delete Action -->
                        <a href="<?php echo PAGE;?>?id=<?php echo $row['id'];?>&action=delete" onclick="return confirm('Are you sure you want to delete this alumni registration?');" class="bu-btn-icon bu-btn-del" title="Delete Record">
                          <i class="mdi mdi-delete"></i>
                        </a>
                      </div>

                      <!-- Quick View Modal -->
                      <div class="modal fade text-left" id="alumniModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">
                                <i class="mdi mdi-school" style="color:var(--bu-gold);"></i> Alumni Details: <?php echo htmlspecialchars($row['name'] ?? ''); ?> (#<?php echo $row['id']; ?>)
                              </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body p-4">
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Enrollment No</small>
                                  <div class="font-weight-bold text-primary font-15"><?php echo htmlspecialchars($row['enrollment_no'] ?: 'Not Provided'); ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Passing Year</small>
                                  <div class="font-weight-bold text-success font-15"><?php echo htmlspecialchars($row['passing_year'] ?: 'N/A'); ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">College / Institute</small>
                                  <div class="font-weight-bold text-dark"><?php echo htmlspecialchars($row['college'] ?: '-'); ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Course &amp; Branch</small>
                                  <div class="font-weight-bold"><?php echo htmlspecialchars($row['course'] ?: '-'); ?> <?php if(!empty($row['branch'])) echo '('.htmlspecialchars($row['branch']).')'; ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Mobile &amp; WhatsApp</small>
                                  <div>
                                    <a href="tel:<?php echo htmlspecialchars($row['mobile'] ?? ''); ?>"><?php echo htmlspecialchars($row['mobile'] ?: '-'); ?></a>
                                    <?php if(!empty($row['whatsapp'])): ?> / <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $row['whatsapp']); ?>" target="_blank" class="text-success font-weight-bold"><i class="mdi mdi-whatsapp"></i> WhatsApp</a><?php endif; ?>
                                  </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Email Address</small>
                                  <div><a href="mailto:<?php echo htmlspecialchars($row['email'] ?? ''); ?>"><?php echo htmlspecialchars($row['email'] ?: '-'); ?></a></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Current Occupation</small>
                                  <div class="font-weight-bold"><?php echo htmlspecialchars($row['occupation'] ?: '-'); ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Company / Organization</small>
                                  <div class="font-weight-bold"><?php echo htmlspecialchars($row['company'] ?: '-'); ?> <?php if(!empty($row['job_title'])) echo ' - ' . htmlspecialchars($row['job_title']); ?></div>
                                </div>
                                <div class="col-md-12 mb-3">
                                  <small class="text-muted text-uppercase font-weight-bold">Location &amp; Address</small>
                                  <div><?php echo htmlspecialchars($row['city'] ?: ''); ?> <?php if(!empty($row['address'])) echo '• ' . htmlspecialchars($row['address']); ?></div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer bg-light">
                              <a href="<?php echo PAGE; ?>?id=<?php echo $row['id']; ?>&action=view" class="btn btn-primary font-weight-bold waves-effect">
                                <i class="mdi mdi-open-in-new"></i> Full Details Page
                              </a>
                              <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    </td>
                  </tr>
                  <?php
                      }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <?php } ?>

      </div>
      <!-- container-fluid -->
    </div>
    <!-- content -->
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
<!-- Required datatable js --> 
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script> 
<!-- Buttons examples --> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.buttons.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/jszip.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/pdfmake.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/vfs_fonts.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.html5.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.print.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.colVis.min.js"></script>
<script>
$(document).ready(function() {
  if ($('#alumni-datatable').length) {
    $('#alumni-datatable').DataTable({
      lengthChange: true,
      lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      pageLength: 25,
      buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
      responsive: true,
      order: [[0, 'desc']],
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Quick filter rows...",
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'></i>",
          next: "<i class='mdi mdi-chevron-right'></i>"
        }
      }
    }).buttons().container().appendTo('#alumni-datatable_wrapper .col-md-6:eq(0)');
  }
});
</script>
</body>
</html>
