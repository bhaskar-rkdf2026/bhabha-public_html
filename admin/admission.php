<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
define("PAGE", 'admission.php');
define("TITLE", 'Online Admission Applications');
define("DBTAB", 'admission');

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
    $_SESSION["success"] = 'Admission record deleted successfully!';
    redirect(PAGE);
}

// Courses and Branches Map
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

// CSV Export Handler
if ($action == "export_csv") {
    $filename = "bhabha_admissions_" . date('Y-m-d_His') . ".csv";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    $output = fopen('php://output', 'w');
    fputs($output, "\xEF\xBB\xBF"); // Excel UTF-8 BOM
    fputcsv($output, ['ID', 'Applicant Name', 'Father Name', 'Mother Name', 'Gender', 'DOB', 'Category', 'Mobile Number', 'Email Address', 'Course', 'Branch', 'Present Address', 'Aadhar No', 'Submission Date']);

    $db->orderBy('id', 'DESC');
    $records = $db->get(DBTAB);
    foreach ($records as $r) {
        $cname = isset($course_map[$r['course']]) ? $course_map[$r['course']] : $r['course'];
        $bname = isset($branch_map[$r['branch']]) ? $branch_map[$r['branch']] : $r['branch'];
        fputcsv($output, [
            $r['id'],
            $r['name'],
            $r['fname'],
            $r['mother'],
            $r['gender'],
            $r['dob'],
            $r['category'],
            $r['mobile'],
            $r['email'],
            $cname,
            $bname,
            $r['present_address'],
            $r['aadhar'],
            $r['date']
        ]);
    }
    fclose($output);
    exit;
}

$totalAdmissions = $db->getValue(DBTAB, 'count(*)');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Bhabha University Admin</title>
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
  padding: 14px 18px;
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
  font-size: 13.5px;
  font-weight: 600;
  color: #0A1B54;
}
.bu-section-hdr {
  font-size: 14px;
  font-weight: 800;
  color: #0A1B54;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding-bottom: 8px;
  border-bottom: 2px solid #E2E8F0;
  margin: 20px 0 16px 0;
  display: flex;
  align-items: center;
  gap: 8px;
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
            <h4><i class="mdi mdi-account-check" style="color:#10B981;"></i> <?php echo TITLE; ?></h4>
            <p>Official candidate registrations, fee submissions, and verification documents.</p>
          </div>
          <div class="d-flex align-items-center" style="gap:12px;">
            <span class="badge badge-success" style="font-size:13px; padding:7px 14px; font-weight:700;">
              Total: <?php echo number_format($totalAdmissions); ?> Registrations
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
          $cname = isset($course_map[$aryData['course']]) ? $course_map[$aryData['course']] : $aryData['course'];
          $bname = isset($branch_map[$aryData['branch']]) ? $branch_map[$aryData['branch']] : $aryData['branch'];
        ?>
          <!-- View Full Application Detail Card -->
          <div class="bu-table-card" style="margin-bottom:24px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 style="color:#0A1B54; font-weight:800; margin:0;">
                <i class="mdi mdi-account-box-outline"></i> Application Details #<?php echo $aryData['id']; ?> — <?php echo htmlspecialchars($aryData['name']); ?>
              </h5>
              <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-secondary"><i class="mdi mdi-arrow-left"></i> Back to List</a>
            </div>

            <!-- Personal Info -->
            <div class="bu-section-hdr"><i class="mdi mdi-account"></i> 1. Personal & Family Profile</div>
            <div class="row">
              <div class="col-md-4"><div class="bu-detail-box"><label>Full Name</label><div class="val"><?php echo htmlspecialchars($aryData['name'] ?? '—'); ?></div></div></div>
              <div class="col-md-4"><div class="bu-detail-box"><label>Father's Name</label><div class="val"><?php echo htmlspecialchars($aryData['fname'] ?? '—'); ?></div></div></div>
              <div class="col-md-4"><div class="bu-detail-box"><label>Mother's Name</label><div class="val"><?php echo htmlspecialchars($aryData['mother'] ?? '—'); ?></div></div></div>
              <div class="col-md-3"><div class="bu-detail-box"><label>Gender</label><div class="val"><?php echo htmlspecialchars($aryData['gender'] ?? '—'); ?></div></div></div>
              <div class="col-md-3"><div class="bu-detail-box"><label>Date of Birth</label><div class="val"><?php echo htmlspecialchars($aryData['dob'] ?? '—'); ?></div></div></div>
              <div class="col-md-3"><div class="bu-detail-box"><label>Category</label><div class="val"><?php echo htmlspecialchars($aryData['category'] ?? '—'); ?></div></div></div>
              <div class="col-md-3"><div class="bu-detail-box"><label>Aadhar No.</label><div class="val"><?php echo htmlspecialchars($aryData['aadhar'] ?? '—'); ?></div></div></div>
            </div>

            <!-- Contact & Course Info -->
            <div class="bu-section-hdr"><i class="mdi mdi-school"></i> 2. Academic Program & Contact</div>
            <div class="row">
              <div class="col-md-6"><div class="bu-detail-box"><label>Applied Course</label><div class="val" style="color:#2563EB; font-weight:700;"><?php echo htmlspecialchars($cname ?: '—'); ?></div></div></div>
              <div class="col-md-6"><div class="bu-detail-box"><label>Branch / Specialization</label><div class="val"><?php echo htmlspecialchars($bname ?: '—'); ?></div></div></div>
              <div class="col-md-4"><div class="bu-detail-box"><label>Mobile Number</label><div class="val"><a href="tel:<?php echo htmlspecialchars($aryData['mobile']); ?>"><i class="mdi mdi-phone"></i> <?php echo htmlspecialchars($aryData['mobile'] ?? '—'); ?></a></div></div></div>
              <div class="col-md-4"><div class="bu-detail-box"><label>Email Address</label><div class="val"><a href="mailto:<?php echo htmlspecialchars($aryData['email']); ?>"><i class="mdi mdi-email-outline"></i> <?php echo htmlspecialchars($aryData['email'] ?? '—'); ?></a></div></div></div>
              <div class="col-md-4"><div class="bu-detail-box"><label>Registration Date</label><div class="val"><?php echo htmlspecialchars($aryData['date'] ?? '—'); ?></div></div></div>
              <div class="col-12"><div class="bu-detail-box"><label>Present Address</label><div class="val"><?php echo htmlspecialchars($aryData['present_address'] ?? '—'); ?></div></div></div>
            </div>

            <!-- Educational Background -->
            <div class="bu-section-hdr"><i class="mdi mdi-certificate"></i> 3. Academic Records</div>
            <div class="row">
              <div class="col-md-6"><div class="bu-detail-box"><label>10th Standard (High School)</label><div class="val" style="font-size:12.5px;"><?php echo htmlspecialchars($aryData['high_school'] ?? '—'); ?></div></div></div>
              <div class="col-md-6"><div class="bu-detail-box"><label>12th Standard (Higher Secondary)</label><div class="val" style="font-size:12.5px;"><?php echo htmlspecialchars($aryData['higher_secondary'] ?? '—'); ?></div></div></div>
              <div class="col-md-6"><div class="bu-detail-box"><label>Graduation Records</label><div class="val" style="font-size:12.5px;"><?php echo htmlspecialchars($aryData['graduation'] ?? '—'); ?></div></div></div>
              <div class="col-md-6"><div class="bu-detail-box"><label>Post Graduation Records</label><div class="val" style="font-size:12.5px;"><?php echo htmlspecialchars($aryData['pgraduation'] ?? '—'); ?></div></div></div>
            </div>

            <!-- Payment -->
            <div class="bu-section-hdr"><i class="mdi mdi-cash-multiple"></i> 4. Payment Details</div>
            <div class="row">
              <div class="col-12"><div class="bu-detail-box" style="background:#F0FDF4; border-color:#BBF7D0;"><label style="color:#166534;">Payment Summary</label><div class="val" style="color:#15803D; font-size:13px;"><?php echo htmlspecialchars($aryData['payment'] ?? '—'); ?></div></div></div>
            </div>

            <div class="mt-4">
              <a href="<?php echo PAGE; ?>?id=<?php echo $aryData['id']; ?>&action=delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this admission application?');">
                <i class="mdi mdi-trash-can"></i> Delete Application
              </a>
              <a href="<?php echo PAGE; ?>" class="btn btn-light ml-2">Back to List</a>
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
                    <th>Applicant Name</th>
                    <th>Applied Course</th>
                    <th>Contact Info</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $db->orderBy('id', 'DESC');
                  $aryData = $db->get(DBTAB);
                  if (is_array($aryData) && count($aryData) > 0):
                    foreach ($aryData as $row):
                      $cname = isset($course_map[$row['course']]) ? $course_map[$row['course']] : $row['course'];
                  ?>
                    <tr>
                      <td>#<?php echo $row['id']; ?></td>
                      <td>
                        <strong style="color:#0A1B54; font-size:14px;"><?php echo htmlspecialchars($row['name']); ?></strong>
                        <?php if (!empty($row['fname'])): ?>
                          <div style="font-size:11.5px; color:#64748B;">S/o: <?php echo htmlspecialchars($row['fname']); ?></div>
                        <?php endif; ?>
                      </td>
                      <td>
                        <span class="badge badge-success" style="font-size:12px; padding:5px 9px;">
                          <?php echo htmlspecialchars($cname ?: 'General Admission'); ?>
                        </span>
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
                        <span style="font-size:12.5px; color:#475569;"><?php echo htmlspecialchars($row['category'] ?: '—'); ?></span>
                      </td>
                      <td>
                        <span style="font-size:12px; color:#64748B;"><?php echo htmlspecialchars($row['date']); ?></span>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="<?php echo PAGE; ?>?id=<?php echo $row['id']; ?>&action=view" class="btn btn-sm btn-info" title="View Application">
                            <i class="mdi mdi-eye"></i> View
                          </a>
                          <a href="<?php echo PAGE; ?>?id=<?php echo $row['id']; ?>&action=delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this admission application?');" title="Delete">
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