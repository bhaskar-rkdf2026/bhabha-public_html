<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
define("PAGE", 'inquiry.php');
define("TITLE", 'Contact Inquiries');
define("DBTAB", 'inquiry');

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
    $_SESSION["success"] = 'Inquiry deleted successfully!';
    redirect(PAGE);
}

// Fetch total count and latest inquiries sorted by latest first for fast loading
$totalInquiries = $db->getValue(DBTAB, 'count(*)');
$db->orderBy('id', 'DESC');
$inquiryList = $db->get(DBTAB, 1000); // Load latest 1,000 records for instant loading
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
/* Modern Inquiry Admin Styling */
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

/* Sender & Message Details in Table */
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

.bu-badge-subject {
  background: #F1F5F9;
  color: #1E293B;
  border: 1px solid #CBD5E1;
  font-size: 12px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 6px;
  display: inline-block;
  max-width: 200px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.bu-msg-snippet {
  font-size: 12.5px;
  color: #334155;
  line-height: 1.45;
  max-width: 320px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.bu-read-more-link {
  font-size: 11px;
  font-weight: 700;
  color: #D99B00;
  cursor: pointer;
  display: inline-block;
  margin-top: 2px;
}
.bu-read-more-link:hover {
  color: #B45309;
  text-decoration: underline;
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

/* DataTables Buttons (Copy, Excel, PDF, Print) */
.dt-buttons .btn {
  border-radius: 6px !important;
  font-size: 12px !important;
  font-weight: 700 !important;
  padding: 6px 12px !important;
  margin-right: 4px !important;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
}

/* Inquiry Details Modal */
.bu-inquiry-modal .modal-content {
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 10px 35px rgba(10, 27, 84, 0.15);
  overflow: hidden;
}
.bu-inquiry-modal .modal-header {
  background: #0A1B54;
  color: #ffffff;
  padding: 16px 20px;
}
.bu-inquiry-modal .modal-title {
  font-size: 16px;
  font-weight: 800;
  color: #ffffff;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-inquiry-modal .close {
  color: #ffffff;
  opacity: 0.85;
}
.bu-inquiry-modal .modal-body {
  padding: 22px;
  background: #F8FAFC;
}
.bu-info-row {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 14px 16px;
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
.bu-msg-box {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 14px 16px;
  font-size: 13.5px;
  line-height: 1.6;
  color: #334155;
  white-space: pre-wrap;
  word-break: break-word;
  max-height: 250px;
  overflow-y: auto;
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
            <h4><i class="fa fa-envelope-open text-warning"></i> <?php echo TITLE; ?> Management</h4>
            <p>View, manage, paginate, and respond to incoming contact requests &amp; student inquiries.</p>
          </div>
          <div>
            <span class="bu-stat-badge">
              <i class="fa fa-comments-o"></i> Total Inquiries: <strong><?php echo $totalInquiries; ?></strong>
            </span>
          </div>
        </div>

        <!-- Notification Alerts -->
        <?php if (!empty($stat)): ?>
          <div class="mb-3"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <!-- INQUIRIES DATA TABLE CARD -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20" style="border-radius: 10px; border: 1px solid #E2E8F0; box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);">
              <div class="card-body">
                
                <div class="table-responsive">
                  <table id="inquiryTable" class="table table-hover table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead style="background: #F8FAFC;">
                      <tr>
                        <th style="width: 60px;" class="text-center"># ID</th>
                        <th style="min-width: 190px;">Sender Details</th>
                        <th style="min-width: 150px;">Subject</th>
                        <th style="min-width: 250px;">Message Preview</th>
                        <th style="width: 130px;" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (is_array($inquiryList) && count($inquiryList) > 0): ?>
                        <?php foreach ($inquiryList as $item): 
                          $senderName  = !empty($item['name']) ? htmlspecialchars($item['name']) : 'Anonymous / Not Specified';
                          $senderEmail = !empty($item['email']) ? htmlspecialchars($item['email']) : '';
                          $senderPhone = !empty($item['mobile']) ? htmlspecialchars($item['mobile']) : '';
                          $subject     = !empty($item['subject']) ? htmlspecialchars($item['subject']) : 'General Inquiry';
                          $message     = !empty($item['message']) ? htmlspecialchars($item['message']) : '';
                          $rawMsgJson  = htmlspecialchars(json_encode([
                              'id'      => $item['id'],
                              'name'    => $senderName,
                              'email'   => $senderEmail,
                              'phone'   => $senderPhone,
                              'subject' => $subject,
                              'message' => $message
                          ]), ENT_QUOTES, 'UTF-8');
                        ?>
                        <tr>
                          <td class="font-weight-bold text-muted text-center align-middle">#<?php echo $item['id']; ?></td>
                          
                          <!-- Sender Info -->
                          <td>
                            <div class="bu-sender-info">
                              <span class="bu-sender-name"><?php echo $senderName; ?></span>
                              <div class="bu-sender-contact">
                                <?php if (!empty($senderEmail)): ?>
                                  <a href="mailto:<?php echo $senderEmail; ?>" class="bu-sender-link" title="Send Email">
                                    <i class="fa fa-envelope-o text-primary"></i> <?php echo $senderEmail; ?>
                                  </a>
                                <?php endif; ?>
                              </div>
                              <div class="bu-sender-contact mt-1">
                                <?php if (!empty($senderPhone)): ?>
                                  <a href="tel:<?php echo $senderPhone; ?>" class="bu-sender-link" style="color: #059669 !important;" title="Call Phone">
                                    <i class="fa fa-phone text-success"></i> <?php echo $senderPhone; ?>
                                  </a>
                                <?php endif; ?>
                              </div>
                            </div>
                          </td>

                          <!-- Subject -->
                          <td class="align-middle">
                            <span class="bu-badge-subject" title="<?php echo $subject; ?>">
                              <i class="fa fa-tag text-warning"></i> <?php echo $subject; ?>
                            </span>
                          </td>

                          <!-- Message Preview -->
                          <td>
                            <div class="bu-msg-snippet">
                              <?php echo $message ?: '<em class="text-muted">No message content provided.</em>'; ?>
                            </div>
                            <?php if (strlen($message) > 60): ?>
                              <span class="bu-read-more-link" onclick='viewInquiryDetails(<?php echo $rawMsgJson; ?>);'>
                                <i class="fa fa-expand"></i> View Full Message
                              </span>
                            <?php endif; ?>
                          </td>

                          <!-- Actions -->
                          <td class="text-center align-middle">
                            <div class="bu-action-btn-group">
                              <!-- View Modal Button -->
                              <button type="button" class="bu-btn-icon bu-btn-view" title="View Full Details" onclick='viewInquiryDetails(<?php echo $rawMsgJson; ?>);'>
                                <i class="fa fa-eye"></i>
                              </button>
                              
                              <!-- Direct Email Button -->
                              <?php if (!empty($senderEmail)): ?>
                                <a href="mailto:<?php echo $senderEmail; ?>?subject=Re:%20<?php echo urlencode($subject); ?>" class="bu-btn-icon bu-btn-email" title="Reply via Email">
                                  <i class="fa fa-reply"></i>
                                </a>
                              <?php endif; ?>

                              <!-- Call Button -->
                              <?php if (!empty($senderPhone)): ?>
                                <a href="tel:<?php echo $senderPhone; ?>" class="bu-btn-icon bu-btn-call" title="Call Sender">
                                  <i class="fa fa-phone"></i>
                                </a>
                              <?php endif; ?>

                              <!-- Delete Button -->
                              <a href="<?php echo PAGE; ?>?id=<?php echo $item['id']; ?>&action=delete" onclick="return deletex();" class="bu-btn-icon bu-btn-del" title="Delete Inquiry">
                                <i class="fa fa-trash"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fa fa-inbox fa-2x mb-2 d-block text-muted"></i>
                            No inquiry records found.
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
     INQUIRY DETAILS MODAL DIALOG
     ================================================================ -->
<div class="modal fade bu-inquiry-modal" id="inquiryDetailModal" tabindex="-1" role="dialog" aria-labelledby="inquiryModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inquiryModalTitle">
          <i class="fa fa-file-text-o text-warning"></i> Inquiry Details <span id="modalInquiryIdBadge" class="badge badge-light ml-2 font-weight-bold">#</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <!-- Sender Name -->
          <div class="col-md-4">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-user text-primary"></i> Sender Name</div>
              <div class="bu-info-val" id="modalSenderName">-</div>
            </div>
          </div>

          <!-- Email -->
          <div class="col-md-4">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-envelope text-info"></i> Email Address</div>
              <div class="bu-info-val" id="modalSenderEmail">-</div>
            </div>
          </div>

          <!-- Mobile -->
          <div class="col-md-4">
            <div class="bu-info-row">
              <div class="bu-info-label"><i class="fa fa-phone text-success"></i> Phone Number</div>
              <div class="bu-info-val" id="modalSenderPhone">-</div>
            </div>
          </div>
        </div>

        <!-- Subject -->
        <div class="bu-info-row">
          <div class="bu-info-label"><i class="fa fa-tag text-warning"></i> Inquiry Subject</div>
          <div class="bu-info-val" id="modalInquirySubject" style="font-size: 15px; color: #0A1B54;">-</div>
        </div>

        <!-- Full Message -->
        <div class="bu-info-label font-weight-bold text-dark mb-1"><i class="fa fa-commenting-o text-primary"></i> Complete Message:</div>
        <div class="bu-msg-box" id="modalInquiryMessage">-</div>

      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="#" id="modalReplyMailBtn" class="btn btn-success font-weight-bold">
          <i class="fa fa-reply"></i> Reply via Email
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
  // Initialize Custom Inquiry DataTable with Pagination & Length Controls
  var inquiryDT = $('#inquiryTable').DataTable({
    pageLength: 10,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
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
      searchPlaceholder: "Search inquiries...",
      lengthMenu: "Show _MENU_ entries",
      info: "Showing <strong>_START_</strong> to <strong>_END_</strong> of <strong>_TOTAL_</strong> inquiries",
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

function viewInquiryDetails(data) {
  if (!data) return;

  document.getElementById('modalInquiryIdBadge').textContent = '#' + data.id;
  document.getElementById('modalSenderName').textContent = data.name || 'Not Specified';
  
  // Email
  const emailEl = document.getElementById('modalSenderEmail');
  if (data.email) {
    emailEl.innerHTML = `<a href="mailto:${data.email}" class="text-primary font-weight-bold">${data.email}</a>`;
  } else {
    emailEl.textContent = 'Not Provided';
  }

  // Phone
  const phoneEl = document.getElementById('modalSenderPhone');
  if (data.phone) {
    phoneEl.innerHTML = `<a href="tel:${data.phone}" class="text-success font-weight-bold">${data.phone}</a>`;
  } else {
    phoneEl.textContent = 'Not Provided';
  }

  document.getElementById('modalInquirySubject').textContent = data.subject || 'General Inquiry';
  document.getElementById('modalInquiryMessage').textContent = data.message || 'No message provided.';

  // Reply Button link
  const replyBtn = document.getElementById('modalReplyMailBtn');
  if (data.email) {
    replyBtn.style.display = 'inline-flex';
    replyBtn.href = `mailto:${data.email}?subject=Re: ${encodeURIComponent(data.subject || 'Inquiry Response')}`;
  } else {
    replyBtn.style.display = 'none';
  }

  $('#inquiryDetailModal').modal('show');
}
</script>
</body>
</html>