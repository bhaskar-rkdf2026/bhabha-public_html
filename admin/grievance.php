<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
define("PAGE", 'grievance.php');
define("TITLE", 'Grievance Redressal');
define("DBTAB", 'grievance');

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
    $_SESSION["success"] = 'Grievance record deleted successfully!';
    redirect(PAGE);
}

// CSV Export Handler
if ($action == "export_csv") {
    $filename = "bhabha_grievances_" . date('Y-m-d_His') . ".csv";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    $output = fopen('php://output', 'w');
    fputs($output, "\xEF\xBB\xBF"); // Excel UTF-8 BOM
    fputcsv($output, ['ID', 'Student Name', 'Course', 'Year', 'Enrollment Number', 'Mobile Number', 'Email Address', 'Grievance Details', 'Submission Date']);

    $db->orderBy('id', 'DESC');
    $records = $db->get(DBTAB);
    foreach ($records as $r) {
        fputcsv($output, [
            $r['id'],
            $r['name'],
            $r['course'],
            $r['year'],
            $r['enrollment'],
            $r['mobile'],
            $r['email'],
            $r['grievance'],
            $r['date']
        ]);
    }
    fclose($output);
    exit;
}

$totalGrievances = $db->getValue(DBTAB, 'count(*)');
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
.bu-admin-header-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  padding: 20px 24px;
  margin-bottom: 22px;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
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
.bu-btn-export {
  background: #10B981;
  color: #ffffff !important;
  font-weight: 700;
  font-size: 13px;
  padding: 8px 18px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 7px;
  text-decoration: none !important;
  box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
  transition: all 0.2s;
}
.bu-btn-export:hover {
  background: #059669;
  transform: translateY(-1px);
}
.bu-table-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  padding: 24px;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
}
.bu-detail-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 16px 20px;
  margin-bottom: 14px;
}
.bu-detail-box label {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  color: #64748B;
  letter-spacing: 0.5px;
  margin-bottom: 4px;
  display: block;
}
.bu-detail-box .val {
  font-size: 14px;
  font-weight: 600;
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
        <div class="bu-admin-header-card">
          <div class="bu-admin-header-title">
            <h4><i class="mdi mdi-scale-balance" style="color:#D99B00;"></i> <?php echo TITLE; ?></h4>
            <p>Review student and staff grievances, complaints, and redressal submissions.</p>
          </div>
          <div class="d-flex align-items-center" style="gap:12px;">
            <span class="badge badge-warning" style="font-size:13px; padding:7px 14px; font-weight:700;">
              Total: <?php echo number_format($totalGrievances); ?> Grievances
            </span>
            <a href="<?php echo PAGE; ?>?action=export_csv" class="bu-btn-export">
              <i class="mdi mdi-file-excel"></i> Export CSV
            </a>
          </div>
        </div>

        <?php if (!empty($stat)): ?>
          <div style="margin-bottom: 20px;"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <?php if ($action == "view" && !empty($_REQUEST['id'])): 
          $db->where('id', intval($_REQUEST['id']));
          $aryData = $db->getOne(DBTAB);
        ?>
          <!-- View Grievance Detail Card -->
          <div class="bu-table-card" style="margin-bottom:24px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 style="color:#0A1B54; font-weight:800; margin:0;">
                <i class="mdi mdi-account-card-details-outline"></i> Grievance Details #<?php echo $aryData['id']; ?>
              </h5>
              <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-secondary"><i class="mdi mdi-arrow-left"></i> Back to List</a>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="bu-detail-box">
                  <label>Student Name</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['name'] ?? '—'); ?></div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="bu-detail-box">
                  <label>Course & Year</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['course'] ?? '—'); ?> (Year: <?php echo htmlspecialchars($aryData['year'] ?? '—'); ?>)</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="bu-detail-box">
                  <label>Enrollment Number</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['enrollment'] ?? '—'); ?></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="bu-detail-box">
                  <label>Mobile Number</label>
                  <div class="val">
                    <a href="tel:<?php echo htmlspecialchars($aryData['mobile'] ?? ''); ?>">
                      <i class="mdi mdi-phone"></i> <?php echo htmlspecialchars($aryData['mobile'] ?? '—'); ?>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="bu-detail-box">
                  <label>Email Address</label>
                  <div class="val">
                    <a href="mailto:<?php echo htmlspecialchars($aryData['email'] ?? ''); ?>">
                      <i class="mdi mdi-email-outline"></i> <?php echo htmlspecialchars($aryData['email'] ?? '—'); ?>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="bu-detail-box">
                  <label>Submission Date</label>
                  <div class="val"><?php echo htmlspecialchars($aryData['date'] ?? '—'); ?></div>
                </div>
              </div>

              <div class="col-12">
                <div class="bu-detail-box" style="background:#FFFBEB; border-color:#FDE68A;">
                  <label style="color:#92400E;">Grievance / Complaint Description</label>
                  <div class="val" style="font-weight:500; font-size:14px; line-height:1.7; color:#1E293B; white-space:pre-wrap;">
                    <?php echo htmlspecialchars($aryData['grievance'] ?? 'No message provided.'); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-3">
              <a href="<?php echo PAGE; ?>?id=<?php echo $aryData['id']; ?>&action=delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this grievance?');">
                <i class="mdi mdi-trash-can"></i> Delete Grievance
              </a>
              <a href="<?php echo PAGE; ?>" class="btn btn-light ml-2">Back</a>
            </div>
          </div>

        <?php else: ?>

          <!-- List Table Card -->
          <div class="bu-table-card">
            <div class="table-responsive">
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                <thead>
                  <tr style="background:#F8FAFC; color:#0A1B54; font-size:13px; text-transform:uppercase;">
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Course & Roll</th>
                    <th>Contact Info</th>
                    <th>Submission Date</th>
                    <th>Grievance Preview</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $db->orderBy('id', 'DESC');
                  $aryData = $db->get(DBTAB, 1000);
                  if (is_array($aryData) && count($aryData) > 0):
                    foreach ($aryData as $row):
                  ?>
                    <tr>
                      <td>#<?php echo $row['id']; ?></td>
                      <td>
                        <strong style="color:#0A1B54; font-size:14px;"><?php echo htmlspecialchars($row['name']); ?></strong>
                      </td>
                      <td>
                        <div style="font-size:13px; font-weight:600; color:#334155;"><?php echo htmlspecialchars($row['course']); ?></div>
                        <div style="font-size:11.5px; color:#64748B;">Roll: <?php echo htmlspecialchars($row['enrollment'] ?: '—'); ?> (Yr: <?php echo htmlspecialchars($row['year'] ?: '—'); ?>)</div>
                      </td>
                      <td>
                        <div style="font-size:12.5px;">
                          <?php if (!empty($row['mobile'])): ?>
                            <div><i class="mdi mdi-phone" style="color:#10B981;"></i> <a href="tel:<?php echo htmlspecialchars($row['mobile']); ?>"><?php echo htmlspecialchars($row['mobile']); ?></a></div>
                          <?php endif; ?>
                          <?php if (!empty($row['email'])): ?>
                            <div><i class="mdi mdi-email-outline" style="color:#2563EB;"></i> <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></div>
                          <?php endif; ?>
                        </div>
                      </td>
                      <td>
                        <span style="font-size:12px; color:#64748B;"><?php echo htmlspecialchars($row['date']); ?></span>
                      </td>
                      <td>
                        <span style="font-size:12.5px; color:#475569;">
                          <?php echo htmlspecialchars(mb_substr($row['grievance'] ?? '', 0, 70)) . '...'; ?>
                        </span>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="<?php echo PAGE; ?>?id=<?php echo $row['id']; ?>&action=view" class="btn btn-sm btn-info" title="View Full Grievance">
                            <i class="mdi mdi-eye"></i> View
                          </a>
                          <a href="<?php echo PAGE; ?>?id=<?php echo $row['id']; ?>&action=delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this grievance?');" title="Delete">
                            <i class="mdi mdi-trash-can"></i>
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
    $('#datatable-buttons').DataTable({
        lengthChange: true,
        pageLength: 25,
        order: [[0, 'desc']],
        buttons: ['copy', 'excel', 'pdf', 'colvis']
    });
});
</script>
</body>
</html>