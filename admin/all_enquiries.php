<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
$type_filter = isset($_GET['type']) ? trim($_GET['type']) : 'all';
define("PAGE", 'all_enquiries.php');
define("TITLE", 'All Forms & Enquiries');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Fetch total stats for all 5 forms
$count_course_enquiry = $db->getValue('enquiry', 'count(*)') ?? 0;
$count_admission      = $db->getValue('admission', 'count(*)') ?? 0;
$count_inquiry        = $db->getValue('inquiry', 'count(*)') ?? 0;
$count_grievance      = $db->getValue('grievance', 'count(*)') ?? 0;
$count_alumni         = $db->getValue('alumni', 'count(*)') ?? 0;
$count_total          = $count_course_enquiry + $count_admission + $count_inquiry + $count_grievance + $count_alumni;

// Course & Branch mapping for readable course names
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

// ==========================================
// CSV Export Handler
// ==========================================
if ($action == "export_csv") {
    $filename = "bhabha_enquiries_" . ($type_filter !== 'all' ? $type_filter . "_" : "all_") . date('Y-m-d_His') . ".csv";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    $output = fopen('php://output', 'w');
    // Output UTF-8 BOM for Microsoft Excel compatibility
    fputs($output, "\xEF\xBB\xBF");

    fputcsv($output, ['ID', 'Form Type', 'Full Name', 'Email Address', 'Mobile Number', 'Course / Branch / Subject', 'Submission Date / Time', 'Details / Message']);

    // Fetch and write rows depending on filter
    if ($type_filter === 'all' || $type_filter === 'enquiry') {
        $db->orderBy('id', 'DESC');
        $enquiries = $db->get('enquiry', 1000);
        foreach ($enquiries as $r) {
            $cname = isset($course_map[$r['course']]) ? $course_map[$r['course']] : $r['course'];
            $bname = isset($branch_map[$r['branch']]) ? $branch_map[$r['branch']] : $r['branch'];
            $course_label = trim($cname . ($bname ? " - " . $bname : ""));
            fputcsv($output, [$r['id'], 'Course Enquiry', $r['name'], $r['email'], $r['mobile'], $course_label, $r['date'], "City: " . $r['place']]);
        }
    }

    if ($type_filter === 'all' || $type_filter === 'admission') {
        $db->orderBy('id', 'DESC');
        $admissions = $db->get('admission', 1000);
        foreach ($admissions as $r) {
            $cname = isset($course_map[$r['course']]) ? $course_map[$r['course']] : $r['course'];
            $bname = isset($branch_map[$r['branch']]) ? $branch_map[$r['branch']] : $r['branch'];
            $course_label = trim($cname . ($bname ? " - " . $bname : ""));
            fputcsv($output, [$r['id'], 'Online Admission', $r['name'], $r['email'], $r['mobile'], $course_label, $r['date'], "Father: " . $r['fname'] . ", Address: " . $r['present_address']]);
        }
    }

    if ($type_filter === 'all' || $type_filter === 'inquiry') {
        $db->orderBy('id', 'DESC');
        $inquiries = $db->get('inquiry', 1000);
        foreach ($inquiries as $r) {
            fputcsv($output, [$r['id'], 'Contact Inquiry', $r['name'], $r['email'], $r['mobile'], $r['subject'], 'N/A', $r['message']]);
        }
    }

    if ($type_filter === 'all' || $type_filter === 'grievance') {
        $db->orderBy('id', 'DESC');
        $grievances = $db->get('grievance', 1000);
        foreach ($grievances as $r) {
            fputcsv($output, [$r['id'], 'Grievance Redressal', $r['name'], $r['email'], $r['mobile'], "Course: " . $r['course'] . " (Yr: " . $r['year'] . ")", $r['date'], $r['grievance']]);
        }
    }

    if ($type_filter === 'all' || $type_filter === 'alumni') {
        $db->orderBy('id', 'DESC');
        $alumni = $db->get('alumni', 1000);
        foreach ($alumni as $r) {
            fputcsv($output, [$r['id'], 'Alumni Registration', $r['name'], $r['email'], $r['mobile'], $r['course'] . " (Batch: " . $r['passing_year'] . ")", $r['date'], "Company: " . $r['company'] . ", Role: " . $r['job_title']]);
        }
    }

    fclose($output);
    exit;
}

// Single delete handler
if ($action == "delete" && !empty($_REQUEST['id']) && !empty($_REQUEST['form_type'])) {
    $del_id = intval($_REQUEST['id']);
    $del_type = trim($_REQUEST['form_type']);
    $valid_tables = ['enquiry' => 'enquiry', 'admission' => 'admission', 'inquiry' => 'inquiry', 'grievance' => 'grievance', 'alumni' => 'alumni'];
    
    if (isset($valid_tables[$del_type])) {
        $db->where('id', $del_id);
        $db->delete($valid_tables[$del_type]);
        $_SESSION["success"] = 'Enquiry record deleted successfully!';
    }
    redirect(PAGE . ($type_filter !== 'all' ? '?type=' . urlencode($type_filter) : ''));
}

// Fetch Enquiries for table display
$unified_records = [];

if ($type_filter === 'all' || $type_filter === 'enquiry') {
    $db->orderBy('id', 'DESC');
    $res = $db->get('enquiry', 150);
    foreach ($res as $r) {
        $cname = isset($course_map[$r['course']]) ? $course_map[$r['course']] : $r['course'];
        $bname = isset($branch_map[$r['branch']]) ? $branch_map[$r['branch']] : $r['branch'];
        $unified_records[] = [
            'id'          => $r['id'],
            'type_key'    => 'enquiry',
            'type_label'  => 'Course Enquiry',
            'badge_class' => 'badge-primary',
            'name'        => $r['name'],
            'email'       => $r['email'],
            'mobile'      => $r['mobile'],
            'subject'     => trim($cname . ($bname ? ' (' . $bname . ')' : '')),
            'date'        => !empty($r['date']) ? $r['date'] : '—',
            'detail_url'  => 'enquiry.php?id=' . $r['id'] . '&action=view',
            'summary'     => 'Place: ' . (!empty($r['place']) ? htmlspecialchars($r['place']) : 'N/A')
        ];
    }
}

if ($type_filter === 'all' || $type_filter === 'admission') {
    $db->orderBy('id', 'DESC');
    $res = $db->get('admission', 150);
    foreach ($res as $r) {
        $cname = isset($course_map[$r['course']]) ? $course_map[$r['course']] : $r['course'];
        $unified_records[] = [
            'id'          => $r['id'],
            'type_key'    => 'admission',
            'type_label'  => 'Online Admission',
            'badge_class' => 'badge-success',
            'name'        => $r['name'],
            'email'       => $r['email'],
            'mobile'      => $r['mobile'],
            'subject'     => $cname ?: 'Admission Form',
            'date'        => !empty($r['date']) ? $r['date'] : '—',
            'detail_url'  => 'admission.php?id=' . $r['id'] . '&action=view',
            'summary'     => "Father: " . htmlspecialchars($r['fname'] ?? '') . " | Cat: " . htmlspecialchars($r['category'] ?? '')
        ];
    }
}

if ($type_filter === 'all' || $type_filter === 'inquiry') {
    $db->orderBy('id', 'DESC');
    $res = $db->get('inquiry', 150);
    foreach ($res as $r) {
        $unified_records[] = [
            'id'          => $r['id'],
            'type_key'    => 'inquiry',
            'type_label'  => 'Contact Inquiry',
            'badge_class' => 'badge-info',
            'name'        => $r['name'],
            'email'       => $r['email'],
            'mobile'      => $r['mobile'],
            'subject'     => $r['subject'] ?: 'General Inquiry',
            'date'        => '—',
            'detail_url'  => 'inquiry.php?id=' . $r['id'] . '&action=view',
            'summary'     => htmlspecialchars(mb_substr($r['message'] ?? '', 0, 80)) . '...'
        ];
    }
}

if ($type_filter === 'all' || $type_filter === 'grievance') {
    $db->orderBy('id', 'DESC');
    $res = $db->get('grievance', 150);
    foreach ($res as $r) {
        $unified_records[] = [
            'id'          => $r['id'],
            'type_key'    => 'grievance',
            'type_label'  => 'Grievance',
            'badge_class' => 'badge-warning',
            'name'        => $r['name'],
            'email'       => $r['email'],
            'mobile'      => $r['mobile'],
            'subject'     => "Course: " . ($r['course'] ?? '') . " (Roll: " . ($r['enrollment'] ?? '') . ")",
            'date'        => !empty($r['date']) ? $r['date'] : '—',
            'detail_url'  => 'grievance.php?id=' . $r['id'] . '&action=view',
            'summary'     => htmlspecialchars(mb_substr($r['grievance'] ?? '', 0, 80)) . '...'
        ];
    }
}

if ($type_filter === 'all' || $type_filter === 'alumni') {
    $db->orderBy('id', 'DESC');
    $res = $db->get('alumni', 150);
    foreach ($res as $r) {
        $unified_records[] = [
            'id'          => $r['id'],
            'type_key'    => 'alumni',
            'type_label'  => 'Alumni Reg.',
            'badge_class' => 'badge-secondary',
            'name'        => $r['name'],
            'email'       => $r['email'],
            'mobile'      => $r['mobile'],
            'subject'     => ($r['course'] ?? '') . ' (Batch ' . ($r['passing_year'] ?? '') . ')',
            'date'        => !empty($r['date']) ? $r['date'] : '—',
            'detail_url'  => 'alumni.php?id=' . $r['id'] . '&action=view',
            'summary'     => "Company: " . htmlspecialchars($r['company'] ?? '') . " (" . htmlspecialchars($r['job_title'] ?? '') . ")"
        ];
    }
}

// Sort by date if possible or preserve recent insertions
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
/* Modern Forms Hub UI */
.bu-hub-header {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  padding: 22px 26px;
  margin-bottom: 24px;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
}
.bu-hub-title h3 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 22px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-hub-title p {
  font-size: 13.5px;
  color: #64748B;
  margin: 0;
}

/* Stats Cards Grid */
.bu-stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
  margin-bottom: 24px;
}
.bu-stat-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: transform 0.2s, box-shadow 0.2s;
  text-decoration: none !important;
}
.bu-stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(10, 27, 84, 0.08);
  border-color: #CBD5E1;
}
.bu-stat-icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.bu-stat-info h5 {
  font-size: 22px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 2px 0;
  line-height: 1;
}
.bu-stat-info span {
  font-size: 12px;
  font-weight: 600;
  color: #64748B;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Filter Nav Tabs */
.bu-filter-tabs {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 18px;
  background: #F1F5F9;
  padding: 6px;
  border-radius: 8px;
}
.bu-filter-tab {
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 700;
  color: #475569;
  text-decoration: none !important;
  transition: all 0.2s;
}
.bu-filter-tab:hover {
  background: #E2E8F0;
  color: #0A1B54;
}
.bu-filter-tab.active {
  background: #0A1B54;
  color: #ffffff;
  box-shadow: 0 2px 8px rgba(10, 27, 84, 0.2);
}
.bu-filter-tab .badge {
  margin-left: 6px;
  font-size: 11px;
}

/* Table Card */
.bu-table-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  padding: 24px;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
}
.bu-btn-export {
  background: #10B981;
  color: #ffffff !important;
  font-weight: 700;
  font-size: 13.5px;
  padding: 9px 20px;
  border-radius: 6px;
  border: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s;
  box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
  text-decoration: none !important;
}
.bu-btn-export:hover {
  background: #059669;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
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
        <div class="bu-hub-header">
          <div class="bu-hub-title">
            <h3><i class="mdi mdi-clipboard-text-multiple-outline" style="color:#D99B00;"></i> All Forms & Enquiries Hub</h3>
            <p>Unified management, live search, and CSV export for all 5 public website submission forms.</p>
          </div>
          <div>
            <a href="<?php echo PAGE; ?>?action=export_csv&type=<?php echo urlencode($type_filter); ?>" class="bu-btn-export">
              <i class="mdi mdi-file-excel"></i> Export Current View to CSV / Excel
            </a>
          </div>
        </div>

        <?php if (!empty($stat)): ?>
          <div style="margin-bottom: 20px;"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <!-- Stats Overview Cards -->
        <div class="bu-stats-grid">
          <a href="<?php echo PAGE; ?>?type=all" class="bu-stat-card" style="border-left: 4px solid #0A1B54;">
            <div class="bu-stat-icon" style="background: rgba(10,27,84,0.1); color: #0A1B54;">
              <i class="mdi mdi-layers-outline"></i>
            </div>
            <div class="bu-stat-info">
              <h5><?php echo number_format($count_total); ?></h5>
              <span>Total Submissions</span>
            </div>
          </a>

          <a href="<?php echo PAGE; ?>?type=enquiry" class="bu-stat-card" style="border-left: 4px solid #2563EB;">
            <div class="bu-stat-icon" style="background: rgba(37,99,235,0.1); color: #2563EB;">
              <i class="mdi mdi-book-education-outline"></i>
            </div>
            <div class="bu-stat-info">
              <h5><?php echo number_format($count_course_enquiry); ?></h5>
              <span>Course Enquiries</span>
            </div>
          </a>

          <a href="<?php echo PAGE; ?>?type=admission" class="bu-stat-card" style="border-left: 4px solid #10B981;">
            <div class="bu-stat-icon" style="background: rgba(16,185,129,0.1); color: #10B981;">
              <i class="mdi mdi-account-check-outline"></i>
            </div>
            <div class="bu-stat-info">
              <h5><?php echo number_format($count_admission); ?></h5>
              <span>Online Admissions</span>
            </div>
          </a>

          <a href="<?php echo PAGE; ?>?type=inquiry" class="bu-stat-card" style="border-left: 4px solid #06B6D4;">
            <div class="bu-stat-icon" style="background: rgba(6,182,212,0.1); color: #06B6D4;">
              <i class="mdi mdi-email-outline"></i>
            </div>
            <div class="bu-stat-info">
              <h5><?php echo number_format($count_inquiry); ?></h5>
              <span>Contact Inquiries</span>
            </div>
          </a>

          <a href="<?php echo PAGE; ?>?type=grievance" class="bu-stat-card" style="border-left: 4px solid #F59E0B;">
            <div class="bu-stat-icon" style="background: rgba(245,158,11,0.1); color: #F59E0B;">
              <i class="mdi mdi-scale-balance"></i>
            </div>
            <div class="bu-stat-info">
              <h5><?php echo number_format($count_grievance); ?></h5>
              <span>Grievances</span>
            </div>
          </a>

          <a href="<?php echo PAGE; ?>?type=alumni" class="bu-stat-card" style="border-left: 4px solid #8B5CF6;">
            <div class="bu-stat-icon" style="background: rgba(139,92,246,0.1); color: #8B5CF6;">
              <i class="mdi mdi-school-outline"></i>
            </div>
            <div class="bu-stat-info">
              <h5><?php echo number_format($count_alumni); ?></h5>
              <span>Alumni Registrations</span>
            </div>
          </a>
        </div>

        <!-- Filter Tabs -->
        <div class="bu-filter-tabs">
          <a href="<?php echo PAGE; ?>?type=all" class="bu-filter-tab <?php echo ($type_filter === 'all') ? 'active' : ''; ?>">
            All Enquiries <span class="badge badge-light"><?php echo $count_total; ?></span>
          </a>
          <a href="<?php echo PAGE; ?>?type=enquiry" class="bu-filter-tab <?php echo ($type_filter === 'enquiry') ? 'active' : ''; ?>">
            Course Enquiries <span class="badge badge-light"><?php echo $count_course_enquiry; ?></span>
          </a>
          <a href="<?php echo PAGE; ?>?type=admission" class="bu-filter-tab <?php echo ($type_filter === 'admission') ? 'active' : ''; ?>">
            Online Admissions <span class="badge badge-light"><?php echo $count_admission; ?></span>
          </a>
          <a href="<?php echo PAGE; ?>?type=inquiry" class="bu-filter-tab <?php echo ($type_filter === 'inquiry') ? 'active' : ''; ?>">
            Contact Inquiries <span class="badge badge-light"><?php echo $count_inquiry; ?></span>
          </a>
          <a href="<?php echo PAGE; ?>?type=grievance" class="bu-filter-tab <?php echo ($type_filter === 'grievance') ? 'active' : ''; ?>">
            Grievance Redressal <span class="badge badge-light"><?php echo $count_grievance; ?></span>
          </a>
          <a href="<?php echo PAGE; ?>?type=alumni" class="bu-filter-tab <?php echo ($type_filter === 'alumni') ? 'active' : ''; ?>">
            Alumni Registrations <span class="badge badge-light"><?php echo $count_alumni; ?></span>
          </a>
        </div>

        <!-- Main Enquiries Table -->
        <div class="bu-table-card">
          <div class="table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
              <thead>
                <tr style="background:#F8FAFC; color:#0A1B54; font-size:13px; text-transform:uppercase; letter-spacing:0.5px;">
                  <th>Form Type</th>
                  <th>Applicant / Student</th>
                  <th>Contact Info</th>
                  <th>Course / Subject</th>
                  <th>Submission Date</th>
                  <th>Key Details</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($unified_records)): ?>
                  <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No enquiry records found in this category.</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($unified_records as $item): ?>
                    <tr>
                      <td>
                        <span class="badge <?php echo $item['badge_class']; ?>" style="font-size:11.5px; padding:5px 9px; font-weight:700;">
                          <?php echo $item['type_label']; ?>
                        </span>
                      </td>
                      <td>
                        <strong style="color:#0A1B54; font-size:14px;"><?php echo htmlspecialchars($item['name']); ?></strong>
                      </td>
                      <td>
                        <div style="font-size:13px;">
                          <?php if (!empty($item['mobile'])): ?>
                            <div><i class="mdi mdi-phone" style="color:#10B981;"></i> <a href="tel:<?php echo htmlspecialchars($item['mobile']); ?>" style="color:#334155; font-weight:600;"><?php echo htmlspecialchars($item['mobile']); ?></a></div>
                          <?php endif; ?>
                          <?php if (!empty($item['email'])): ?>
                            <div><i class="mdi mdi-email-outline" style="color:#2563EB;"></i> <a href="mailto:<?php echo htmlspecialchars($item['email']); ?>" style="color:#64748B; font-size:12px;"><?php echo htmlspecialchars($item['email']); ?></a></div>
                          <?php endif; ?>
                        </div>
                      </td>
                      <td>
                        <span style="font-weight:600; color:#334155; font-size:13px;">
                          <?php echo htmlspecialchars($item['subject'] ?: '—'); ?>
                        </span>
                      </td>
                      <td>
                        <span style="font-size:12.5px; color:#64748B;">
                          <?php echo htmlspecialchars($item['date']); ?>
                        </span>
                      </td>
                      <td>
                        <span style="font-size:12px; color:#64748B;">
                          <?php echo $item['summary']; ?>
                        </span>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="<?php echo $item['detail_url']; ?>" class="btn btn-sm btn-info" title="View Full Details">
                            <i class="mdi mdi-eye"></i> View
                          </a>
                          <a href="<?php echo PAGE; ?>?action=delete&id=<?php echo $item['id']; ?>&form_type=<?php echo $item['type_key']; ?>&type=<?php echo urlencode($type_filter); ?>" 
                             class="btn btn-sm btn-danger" 
                             onclick="return confirm('Are you sure you want to delete this enquiry record?');"
                             title="Delete">
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
        order: [[4, 'desc']],
        buttons: ['copy', 'excel', 'pdf', 'colvis']
    });
});
</script>
</body>
</html>
