<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
define("PAGE", 'enquiry.php');
define("TITLE", 'Course Enquiries');
define("DBTAB", 'enquiry');

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
    $oldData = $db->getOne(DBTAB);

    // Delete uploaded marksheets if any
    if ($oldData) {
        $docs = ['tenth', 'twelfth', 'graduation', 'pgraduation'];
        foreach ($docs as $docKey) {
            if (!empty($oldData[$docKey])) {
                @unlink('../upload/enquiry/' . $oldData[$docKey]);
            }
        }
    }

    $db->where('id', $del_id);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Course enquiry deleted successfully!';
    redirect(PAGE);
}

// Pre-fetch all courses & branches in memory (Prevents N+1 Query bottleneck)
$all_courses = $db->get('course', null, 'id, course');
$course_map = [];
if (is_array($all_courses)) {
    foreach ($all_courses as $c) {
        $course_map[$c['id']] = $c['course'];
    }
}

$all_branches = $db->get('branch', null, 'id, branch');
$branch_map = [];
if (is_array($all_branches)) {
    foreach ($all_branches as $b) {
        $branch_map[$b['id']] = $b['branch'];
    }
}

// Optional Course filter
$filter_course = isset($_GET['filter_course']) ? intval($_GET['filter_course']) : 0;
if ($filter_course > 0) {
    $db->where('course', $filter_course);
}

// Fetch latest enquiries (fast & indexed)
$db->orderBy('id', 'DESC');
$enquiryList = $db->get(DBTAB, 1500); // Load latest 1,500 active records lightning-fast
$totalEnquiries = $db->getValue(DBTAB, 'count(*)');
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
/* Modern Course Enquiry Admin Styling */
.bu-admin-header-card {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #E2E8F0;
  padding: 18px 24px;
  margin-bottom: 22px;
  box-shadow: 0 2px 10px rgba(10, 27, 84, 0.04);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 14px;
}
.bu-admin-header-title h4 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 20px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 4px 0;
  display: flex;
  align-items: center;
  gap: 9px;
}
.bu-admin-header-title p {
  font-size: 13px;
  color: #64748B;
  margin: 0;
}
.bu-stat-badge {
  background: rgba(10, 27, 84, 0.08);
  color: #0A1B54;
  border: 1px solid rgba(10, 27, 84, 0.18);
  font-size: 13px;
  font-weight: 800;
  padding: 7px 16px;
  border-radius: 20px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-stat-badge strong {
  color: #D99B00;
  font-size: 15px;
}

/* Sender & Course Details */
.bu-sender-info {
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.bu-sender-name {
  font-size: 14px;
  font-weight: 700;
  color: #0A1B54;
}
.bu-sender-contact {
  font-size: 12px;
  color: #475569;
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}
.bu-sender-link {
  color: #2563EB !important;
  text-decoration: none !important;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: color 0.18s;
}
.bu-sender-link:hover {
  color: #1D4ED8 !important;
  text-decoration: underline !important;
}

.bu-badge-course {
  background: rgba(10, 27, 84, 0.08);
  color: #0A1B54;
  border: 1px solid rgba(10, 27, 84, 0.2);
  font-size: 12px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.bu-badge-branch {
  background: #FEF3C7;
  color: #92400E;
  border: 1px solid #FCD34D;
  font-size: 11px;
  font-weight: 700;
  padding: 3px 8px;
  border-radius: 4px;
  display: inline-block;
  margin-top: 3px;
}

.bu-doc-chip {
  font-size: 10.5px;
  font-weight: 700;
  padding: 3px 7px;
  border-radius: 4px;
  background: #F1F5F9;
  border: 1px solid #CBD5E1;
  color: #334155 !important;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 3px;
  transition: all 0.2s ease;
  margin: 1px;
}
.bu-doc-chip:hover {
  background: #0A1B54;
  color: #FFC107 !important;
  border-color: #0A1B54;
  transform: translateY(-1px);
}

/* Action Button Group */
.bu-action-btn-group {
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.bu-btn-icon {
  width: 32px;
  height: 32px;
  border-radius: 6px;
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
  background: #0A1B54;
  color: #ffffff !important;
}
.bu-btn-view:hover {
  background: #061442;
  color: #FFC107 !important;
  transform: translateY(-2px);
}
.bu-btn-email {
  background: #10B981;
  color: #ffffff !important;
}
.bu-btn-email:hover {
  background: #059669;
  transform: translateY(-2px);
}
.bu-btn-call {
  background: #F59E0B;
  color: #ffffff !important;
}
.bu-btn-call:hover {
  background: #D97706;
  transform: translateY(-2px);
}
.bu-btn-del {
  background: #EF4444;
  color: #ffffff !important;
}
.bu-btn-del:hover {
  background: #DC2626;
  transform: translateY(-2px);
}

/* ================================================================
   PAGINATION & DATATABLES CUSTOM CONTROLS
   ================================================================ */
.dataTables_wrapper {
  padding: 8px 0;
}
.dataTables_length {
  display: inline-flex;
  align-items: center;
  margin-left: 12px;
}
.dataTables_length label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: #475569;
  margin-bottom: 0;
}
.dataTables_length select {
  height: 34px !important;
  border-radius: 6px !important;
  border: 1px solid #CBD5E1 !important;
  padding: 4px 10px !important;
  font-size: 13px !important;
  color: #0A1B54 !important;
  font-weight: 700 !important;
  outline: none !important;
  background-color: #F8FAFC !important;
}
.dataTables_filter {
  margin-bottom: 0;
}
.dataTables_filter label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: #475569;
  margin-bottom: 0;
  width: 100%;
  justify-content: flex-end;
}
.dataTables_filter input {
  height: 36px !important;
  border-radius: 6px !important;
  border: 1px solid #CBD5E1 !important;
  padding: 6px 14px !important;
  font-size: 13px !important;
  color: #0A1B54 !important;
  min-width: 260px !important;
  background: #FFFFFF !important;
  outline: none !important;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
  transition: all 0.2s ease !important;
}
.dataTables_filter input:focus {
  border-color: #0A1B54 !important;
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.12) !important;
}

/* Pagination Bar */
.dataTables_info {
  font-size: 13px !important;
  font-weight: 600 !important;
  color: #64748B !important;
  padding-top: 8px !important;
}
.dataTables_paginate {
  padding-top: 6px !important;
}
.dataTables_paginate .pagination {
  margin: 0 !important;
  gap: 4px !important;
}
.dataTables_paginate .page-item .page-link {
  color: #0A1B54 !important;
  background-color: #FFFFFF !important;
  border: 1px solid #CBD5E1 !important;
  border-radius: 6px !important;
  padding: 6px 13px !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  transition: all 0.2s ease !important;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
}
.dataTables_paginate .page-item .page-link:hover {
  background-color: #EEF2FF !important;
  border-color: #0A1B54 !important;
  color: #0A1B54 !important;
  transform: translateY(-1px) !important;
}
.dataTables_paginate .page-item.active .page-link {
  background-color: #0A1B54 !important;
  border-color: #0A1B54 !important;
  color: #FFC107 !important;
  box-shadow: 0 3px 8px rgba(10, 27, 84, 0.22) !important;
}
.dataTables_paginate .page-item.disabled .page-link {
  color: #94A3B8 !important;
  background-color: #F8FAFC !important;
  border-color: #E2E8F0 !important;
  opacity: 0.7 !important;
  cursor: not-allowed !important;
}

/* Modal Details */
.bu-enquiry-modal .modal-content {
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 10px 35px rgba(10, 27, 84, 0.15);
  overflow: hidden;
}
.bu-enquiry-modal .modal-header {
  background: #0A1B54;
  color: #ffffff;
  padding: 16px 20px;
}
.bu-enquiry-modal .modal-title {
  font-size: 16px;
  font-weight: 800;
  color: #ffffff;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-enquiry-modal .close {
  color: #ffffff;
  opacity: 0.85;
}
.bu-enquiry-modal .modal-body {
  padding: 22px;
  background: #F8FAFC;
}
.bu-info-row {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 12px 16px;
  margin-bottom: 12px;
}
.bu-info-label {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: #64748B;
  margin-bottom: 4px;
}
.bu-info-val {
  font-size: 14px;
  font-weight: 700;
  color: #0A1B54;
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
        
        <!-- Header Card -->
        <div class="bu-admin-header-card mt-3">
          <div class="bu-admin-header-title">
            <h4><i class="fa fa-graduation-cap text-warning"></i> <?php echo TITLE; ?> Management</h4>
            <p>Manage prospective student admissions, course inquiries, and attached qualifications.</p>
          </div>
          <div>
            <span class="bu-stat-badge">
              <i class="fa fa-users"></i> Total Enquiries: <strong><?php echo $totalEnquiries; ?></strong>
            </span>
          </div>
        </div>

        <!-- Notification Alerts -->
        <?php if (!empty($stat)): ?>
          <div class="mb-3"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <!-- ENQUIRIES DATA TABLE CARD -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20" style="border-radius: 10px; border: 1px solid #E2E8F0; box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);">
              <div class="card-body">
                
                <div class="table-responsive">
                  <table id="enquiryTable" class="table table-hover table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead style="background: #F8FAFC;">
                      <tr>
                        <th style="width: 55px;" class="text-center"># ID</th>
                        <th style="min-width: 180px;">Student Details</th>
                        <th style="min-width: 170px;">Applied Course / Branch</th>
                        <th style="min-width: 110px;">Place / City</th>
                        <th style="min-width: 130px;">Documents</th>
                        <th style="width: 110px;">Date</th>
                        <th style="width: 130px;" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (is_array($enquiryList) && count($enquiryList) > 0): ?>
                        <?php foreach ($enquiryList as $item): 
                          $studentName  = !empty($item['name']) ? htmlspecialchars($item['name']) : 'Not Specified';
                          $studentEmail = !empty($item['email']) ? htmlspecialchars($item['email']) : '';
                          $studentPhone = !empty($item['mobile']) ? htmlspecialchars($item['mobile']) : '';
                          
                          $courseName = !empty($item['course']) && isset($course_map[$item['course']]) ? $course_map[$item['course']] : (!empty($item['course']) ? $item['course'] : 'General');
                          $branchName = !empty($item['branch']) && isset($branch_map[$item['branch']]) ? $branch_map[$item['branch']] : '';
                          $place      = !empty($item['place']) ? htmlspecialchars($item['place']) : '—';
                          $formattedDate = !empty($item['date']) ? date('d M Y, h:i A', strtotime($item['date'])) : '—';
                          
                          $docs = [];
                          if (!empty($item['tenth']))       $docs['10th'] = $item['tenth'];
                          if (!empty($item['twelfth']))     $docs['12th'] = $item['twelfth'];
                          if (!empty($item['graduation']))  $docs['Grad'] = $item['graduation'];
                          if (!empty($item['pgraduation'])) $docs['PG']   = $item['pgraduation'];

                          $jsonData = htmlspecialchars(json_encode([
                              'id'         => $item['id'],
                              'name'       => $studentName,
                              'email'      => $studentEmail,
                              'phone'      => $studentPhone,
                              'course'     => $courseName,
                              'branch'     => $branchName,
                              'place'      => $place,
                              'date'       => $formattedDate,
                              'docs'       => $docs
                          ]), ENT_QUOTES, 'UTF-8');
                        ?>
                        <tr>
                          <td class="font-weight-bold text-muted text-center align-middle">#<?php echo $item['id']; ?></td>
                          
                          <!-- Student Info -->
                          <td>
                            <div class="bu-sender-info">
                              <span class="bu-sender-name"><?php echo $studentName; ?></span>
                              <div class="bu-sender-contact">
                                <?php if (!empty($studentEmail)): ?>
                                  <a href="mailto:<?php echo $studentEmail; ?>" class="bu-sender-link" title="Send Email">
                                    <i class="fa fa-envelope-o text-primary"></i> <?php echo $studentEmail; ?>
                                  </a>
                                <?php endif; ?>
                              </div>
                              <div class="bu-sender-contact mt-1">
                                <?php if (!empty($studentPhone)): ?>
                                  <a href="tel:<?php echo $studentPhone; ?>" class="bu-sender-link" style="color: #059669 !important;" title="Call Student">
                                    <i class="fa fa-phone text-success"></i> <?php echo $studentPhone; ?>
                                  </a>
                                <?php endif; ?>
                              </div>
                            </div>
                          </td>

                          <!-- Applied Course & Branch -->
                          <td class="align-middle">
                            <span class="bu-badge-course">
                              <i class="fa fa-book text-warning"></i> <?php echo htmlspecialchars($courseName); ?>
                            </span>
                            <?php if (!empty($branchName)): ?>
                              <div class="bu-badge-branch">
                                <i class="fa fa-code-fork"></i> <?php echo htmlspecialchars($branchName); ?>
                              </div>
                            <?php endif; ?>
                          </td>

                          <!-- Place / City -->
                          <td class="align-middle text-dark font-weight-bold" style="font-size: 13px;">
                            <i class="fa fa-map-marker text-danger mr-1"></i> <?php echo $place; ?>
                          </td>

                          <!-- Attached Documents -->
                          <td class="align-middle">
                            <?php if (count($docs) > 0): ?>
                              <div class="d-flex flex-wrap">
                                <?php foreach ($docs as $label => $file): ?>
                                  <a href="<?php echo URL_ROOT; ?>upload/enquiry/<?php echo $file; ?>" target="_blank" class="bu-doc-chip" title="View <?php echo $label; ?> Marksheet">
                                    <i class="fa fa-file-text-o text-primary"></i> <?php echo $label; ?>
                                  </a>
                                <?php endforeach; ?>
                              </div>
                            <?php else: ?>
                              <span class="text-muted small">None attached</span>
                            <?php endif; ?>
                          </td>

                          <!-- Date -->
                          <td class="align-middle text-muted small">
                            <?php echo $formattedDate; ?>
                          </td>

                          <!-- Actions -->
                          <td class="text-center align-middle">
                            <div class="bu-action-btn-group">
                              <!-- View Modal Button -->
                              <button type="button" class="bu-btn-icon bu-btn-view" title="View Full Details" onclick='viewEnquiryDetails(<?php echo $jsonData; ?>);'>
                                <i class="fa fa-eye"></i>
                              </button>
                              
                              <!-- Direct Email Button -->
                              <?php if (!empty($studentEmail)): ?>
                                <a href="mailto:<?php echo $studentEmail; ?>?subject=Admission%20Inquiry%20Response%20-%20Bhabha%20University" class="bu-btn-icon bu-btn-email" title="Reply via Email">
                                  <i class="fa fa-reply"></i>
                                </a>
                              <?php endif; ?>

                              <!-- Call Button -->
                              <?php if (!empty($studentPhone)): ?>
                                <a href="tel:<?php echo $studentPhone; ?>" class="bu-btn-icon bu-btn-call" title="Call Student">
                                  <i class="fa fa-phone"></i>
                                </a>
                              <?php endif; ?>

                              <!-- Delete Button -->
                              <a href="<?php echo PAGE; ?>?id=<?php echo $item['id']; ?>&action=delete" onclick="return deletex();" class="bu-btn-icon bu-btn-del" title="Delete Enquiry">
                                <i class="fa fa-trash"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fa fa-inbox fa-2x mb-2 d-block text-muted"></i>
                            No course enquiry records found.
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>

<!-- ================================================================
     COURSE ENQUIRY DETAILS MODAL DIALOG
     ================================================================ -->
<div class="modal fade bu-enquiry-modal" id="enquiryDetailModal" tabindex="-1" role="dialog" aria-labelledby="enquiryModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="enquiryModalTitle">
          <i class="fa fa-graduation-cap text-warning"></i> Course Enquiry Details <span id="modalEnquiryIdBadge" class="badge badge-light ml-2 font-weight-bold">#</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <!-- Student Name -->
          <div class="col-md-4">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-user text-primary"></i> Student Name</div>
              <div class="bu-info-val" id="modalStudentName">-</div>
            </div>
          </div>

          <!-- Email -->
          <div class="col-md-4">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-envelope text-info"></i> Email Address</div>
              <div class="bu-info-val" id="modalStudentEmail">-</div>
            </div>
          </div>

          <!-- Mobile -->
          <div class="col-md-4">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-phone text-success"></i> Phone Number</div>
              <div class="bu-info-val" id="modalStudentPhone">-</div>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Applied Course -->
          <div class="col-md-6">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-book text-warning"></i> Course &amp; Specialization</div>
              <div class="bu-info-val" id="modalStudentCourse">-</div>
            </div>
          </div>

          <!-- City / Place -->
          <div class="col-md-3">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-map-marker text-danger"></i> Place / City</div>
              <div class="bu-info-val" id="modalStudentPlace">-</div>
            </div>
          </div>

          <!-- Enquiry Date -->
          <div class="col-md-3">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-calendar text-primary"></i> Submission Date</div>
              <div class="bu-info-val" id="modalStudentDate" style="font-size: 12.5px;">-</div>
            </div>
          </div>
        </div>

        <!-- Attached Documents Container -->
        <div class="bu-info-row">
          <div class="bu-info-label mb-2"><i class="fa fa-paperclip text-primary"></i> Uploaded Marksheets &amp; Documents</div>
          <div id="modalStudentDocs" class="d-flex flex-wrap gap-2">
            <!-- Populated via JS -->
          </div>
        </div>

      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="#" id="modalReplyMailBtn" class="btn btn-success font-weight-bold">
          <i class="fa fa-reply"></i> Reply to Student
        </a>
      </div>
    </div>
  </div>
</div>

<?php include_once("inc.footer.js.php"); ?>

<!-- Required datatable js --> 
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script> 
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
  $('#enquiryTable').DataTable({
    pageLength: 10,
    lengthMenu: [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "All"]],
    order: [[0, "desc"]],
    dom: "<'row align-items-center mb-3'<'col-md-6 d-flex align-items-center flex-wrap'B l><'col-md-6 text-md-right mt-2 mt-md-0'f>>" +
         "<'row'<'col-12'tr>>" +
         "<'row align-items-center mt-3'<'col-md-5'i><'col-md-7 d-flex justify-content-md-end mt-2 mt-md-0'p>>",
    buttons: [
      { extend: 'copy', className: 'btn btn-secondary btn-sm', text: '<i class="fa fa-copy"></i> Copy' },
      { extend: 'excel', className: 'btn btn-success btn-sm', text: '<i class="fa fa-file-excel-o"></i> Excel' },
      { extend: 'pdf', className: 'btn btn-danger btn-sm', text: '<i class="fa fa-file-pdf-o"></i> PDF' },
      { extend: 'print', className: 'btn btn-info btn-sm', text: '<i class="fa fa-print"></i> Print' }
    ],
    language: {
      search: "",
      searchPlaceholder: "Search by student name, email, course, city...",
      lengthMenu: "Show _MENU_ entries",
      info: "Showing <strong>_START_</strong> to <strong>_END_</strong> of <strong>_TOTAL_</strong> course enquiries",
      infoEmpty: "Showing 0 to 0 of 0 records",
      infoFiltered: "(filtered from _MAX_ total)",
      paginate: {
        first: '<i class="fa fa-angle-double-left"></i>',
        previous: '<i class="fa fa-chevron-left"></i> Prev',
        next: 'Next <i class="fa fa-chevron-right"></i>',
        last: '<i class="fa fa-angle-double-right"></i>'
      }
    }
  });
});

function viewEnquiryDetails(data) {
  if (!data) return;

  document.getElementById('modalEnquiryIdBadge').textContent = '#' + data.id;
  document.getElementById('modalStudentName').textContent = data.name || 'Not Specified';
  
  // Email
  const emailEl = document.getElementById('modalStudentEmail');
  if (data.email) {
    emailEl.innerHTML = `<a href="mailto:${data.email}" class="text-primary font-weight-bold">${data.email}</a>`;
  } else {
    emailEl.textContent = 'Not Provided';
  }

  // Phone
  const phoneEl = document.getElementById('modalStudentPhone');
  if (data.phone) {
    phoneEl.innerHTML = `<a href="tel:${data.phone}" class="text-success font-weight-bold">${data.phone}</a>`;
  } else {
    phoneEl.textContent = 'Not Provided';
  }

  // Course & Branch
  let courseStr = data.course || 'General';
  if (data.branch) {
    courseStr += ' (' + data.branch + ')';
  }
  document.getElementById('modalStudentCourse').textContent = courseStr;
  document.getElementById('modalStudentPlace').textContent = data.place || '—';
  document.getElementById('modalStudentDate').textContent = data.date || '—';

  // Documents
  const docsContainer = document.getElementById('modalStudentDocs');
  docsContainer.innerHTML = '';
  if (data.docs && Object.keys(data.docs).length > 0) {
    for (const [key, val] of Object.entries(data.docs)) {
      const docLink = document.createElement('a');
      docLink.href = `<?php echo URL_ROOT; ?>upload/enquiry/${val}`;
      docLink.target = '_blank';
      docLink.className = 'btn btn-outline-primary btn-sm mr-2 mb-2 font-weight-bold';
      docLink.innerHTML = `<i class="fa fa-download"></i> View ${key} Marksheet`;
      docsContainer.appendChild(docLink);
    }
  } else {
    docsContainer.innerHTML = '<span class="text-muted font-italic">No qualification marksheets uploaded.</span>';
  }

  // Reply Button link
  const replyBtn = document.getElementById('modalReplyMailBtn');
  if (data.email) {
    replyBtn.style.display = 'inline-flex';
    replyBtn.href = `mailto:${data.email}?subject=Regarding Admission Enquiry for ${encodeURIComponent(data.course || 'Bhabha University')}`;
  } else {
    replyBtn.style.display = 'none';
  }

  $('#enquiryDetailModal').modal('show');
}
</script>
</body>
</html>