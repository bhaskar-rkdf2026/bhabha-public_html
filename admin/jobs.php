<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
define("PAGE", 'jobs.php');
define("TITLE", 'Current Job Openings');
define("DBTAB", 'jobs');
define("UPLOAD", PATH_ROOT . DS . '..' . DS . 'upload' . DS . 'jobs' . DS);

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Add or Edit Submission Handler
if (isset($_POST['submit'])) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    
    if (empty($title)) {
        $stat['error'] = 'Please enter job opening title.';
    }

    $filename_uploaded = '';
    if (!empty($_FILES['icon']['name'])) {
        $allowed_ext = array('jpeg', 'jpg', 'png', 'gif', 'pdf', 'docx', 'doc');
        $ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowed_ext)) {
            $stat["error"] = "Only JPG, PNG, PDF & DOCX files are allowed.";
        } else {
            if (!is_dir(UPLOAD)) {
                @mkdir(UPLOAD, 0777, true);
            }
            $filename_uploaded = md5(microtime()) . "." . $ext;
            if (!move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $filename_uploaded)) {
                $stat["error"] = "Failed to upload file to server.";
            }
        }
    }

    if (empty($stat['error'])) {
        $data = array(
            "title" => $title,
            "description" => $description
        );
        if (!empty($filename_uploaded)) {
            $data['image'] = $filename_uploaded;
        }

        if ($action == "add") {
            $db->insert(DBTAB, $data);
            $_SESSION["success"] = 'Job opening added successfully!';
            redirect(PAGE);
        } elseif ($action == "edit" && !empty($_REQUEST['id'])) {
            $edit_id = intval($_REQUEST['id']);
            if (!empty($filename_uploaded)) {
                $db->where('id', $edit_id);
                $old = $db->getOne(DBTAB);
                if (!empty($old['image'])) {
                    @unlink(UPLOAD . $old['image']);
                }
            }
            $db->where('id', $edit_id);
            $db->update(DBTAB, $data);
            $_SESSION["success"] = 'Job opening updated successfully!';
            redirect(PAGE);
        }
    }
}

// Delete Handler
if ($action == "delete" && !empty($_REQUEST['id'])) {
    $del_id = intval($_REQUEST['id']);
    $db->where('id', $del_id);
    $aryData = $db->getOne(DBTAB);
    if ($aryData && !empty($aryData['image'])) {
        @unlink(UPLOAD . $aryData['image']);
    }
    $db->where('id', $del_id);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Job opening deleted successfully!';
    redirect(PAGE);
}

// Fetch edit data if editing
$editData = null;
if ($action == "edit" && !empty($_REQUEST['id'])) {
    $db->where('id', intval($_REQUEST['id']));
    $editData = $db->getOne(DBTAB);
}

$totalJobs = $db->getValue(DBTAB, 'count(*)');
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
/* ==========================================================================
   Bhabha University Executive Job Openings Theme
   ========================================================================== */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #061442;
  --bu-navy-light: #1E3A8A;
  --bu-gold: #D99B00;
  --bu-gold-light: #FEF3C7;
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

/* Form Card */
.bu-form-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 4px 15px rgba(10, 27, 84, 0.03);
}
.bu-card-title {
  font-size: 16px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 18px;
  padding-bottom: 12px;
  border-bottom: 2px solid var(--bu-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
}

.bu-btn-primary {
  background: linear-gradient(135deg, var(--bu-navy) 0%, var(--bu-navy-dark) 100%);
  color: #ffffff !important;
  font-weight: 700;
  border: none;
  border-radius: 8px;
  padding: 10px 22px;
  font-size: 13.5px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: all 0.2s;
  box-shadow: 0 4px 10px rgba(10, 27, 84, 0.2);
  cursor: pointer;
}
.bu-btn-primary:hover {
  background: linear-gradient(135deg, var(--bu-navy-light) 0%, var(--bu-navy) 100%);
  transform: translateY(-1px);
  box-shadow: 0 6px 14px rgba(10, 27, 84, 0.3);
}

.bu-btn-gold {
  background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
  color: #ffffff !important;
  font-weight: 700;
  border: none;
  border-radius: 8px;
  padding: 9px 18px;
  font-size: 13.5px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none !important;
  transition: all 0.2s;
}
.bu-btn-gold:hover {
  background: linear-gradient(135deg, #D97706 0%, #B45309 100%);
  transform: translateY(-1px);
}

/* Table Card */
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
.bu-btn-edit {
  background: #EFF6FF;
  color: #2563EB !important;
  border: 1px solid #BFDBFE;
}
.bu-btn-edit:hover {
  background: #2563EB;
  color: #ffffff !important;
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

/* Document Chip */
.bu-doc-badge {
  font-size: 12px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 6px;
  background: #EFF6FF;
  border: 1px solid #BFDBFE;
  color: #1E40AF !important;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s ease;
}
.bu-doc-badge:hover {
  background: var(--bu-navy);
  color: #FFC107 !important;
  border-color: var(--bu-navy);
  transform: translateY(-1px);
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
            <h4><i class="mdi mdi-briefcase" style="color:var(--bu-gold);"></i> <?php echo TITLE; ?> Management</h4>
            <p>Publish, edit, and manage faculty recruitment notifications, walk-in interview schedules, and staff vacancies.</p>
          </div>
          <div class="d-flex align-items-center" style="gap:10px;">
            <div class="bu-stat-badge">
              <i class="mdi mdi-briefcase-check" style="color:var(--bu-gold);"></i> Active Openings: <strong><?php echo number_format($totalJobs); ?></strong>
            </div>
            <?php if ($action == 'add' || $action == 'edit'): ?>
              <a href="<?php echo PAGE; ?>" class="btn btn-secondary font-weight-bold" style="border-radius:8px;">
                <i class="mdi mdi-arrow-left"></i> View All Jobs
              </a>
            <?php else: ?>
              <a href="<?php echo PAGE; ?>?action=add" class="bu-btn-gold">
                <i class="mdi mdi-plus-circle"></i> Add New Job Opening
              </a>
              <a href="<?php echo URL_ROOT; ?>jobs.php" target="_blank" class="btn btn-outline-primary font-weight-bold" style="border-radius:8px;">
                <i class="mdi mdi-open-in-new"></i> View Live Page
              </a>
            <?php endif; ?>
          </div>
        </div>

        <?php if (!empty($stat)): ?>
          <div class="mb-3"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <?php
        // =========================================================================
        // ADD / EDIT FORM VIEW
        // =========================================================================
        if ($action == "add" || $action == "edit") {
        ?>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="bu-form-card">
              <div class="bu-card-title">
                <span>
                  <i class="mdi mdi-<?php echo ($action == 'edit') ? 'pencil-box' : 'plus-circle'; ?>" style="color:var(--bu-gold);"></i>
                  <?php echo ($action == 'edit') ? 'Edit Job Opening' : 'Publish New Job Opening'; ?>
                </span>
                <a href="<?php echo PAGE; ?>" class="text-muted font-13 font-weight-bold"><i class="mdi mdi-close"></i> Cancel</a>
              </div>

              <form action="<?php echo PAGE; ?>?action=<?php echo $action; ?><?php if($action=='edit') echo '&id='.$editData['id']; ?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group mb-3">
                  <label class="font-weight-bold text-dark font-13">Job Notification Title <span class="text-danger">*</span></label>
                  <textarea name="title" class="form-control" rows="3" required placeholder="e.g. Applications are invited for Faculty posts (Professor, Associate Professor &amp; Assistant Professor) in Engineering and Pharmacy. Dated 10.07.2024"><?php echo htmlspecialchars($editData['title'] ?? ''); ?></textarea>
                </div>

                <div class="form-group mb-3">
                  <label class="font-weight-bold text-dark font-13">Additional Details / Eligibility (Optional)</label>
                  <textarea name="description" class="form-control ckeditor" rows="4" placeholder="Enter job description, requirements, or contact instructions..."><?php echo htmlspecialchars($editData['description'] ?? ''); ?></textarea>
                </div>

                <div class="form-group mb-4">
                  <label class="font-weight-bold text-dark font-13">Notification Document / Advertisement Image</label>
                  <input type="file" name="icon" class="form-control-file p-2 border rounded bg-light" accept=".pdf,.jpg,.jpeg,.png,.gif,.doc,.docx">
                  <small class="text-muted d-block mt-1">Accepted formats: PDF, JPG, PNG, DOCX (Max: 10MB)</small>

                  <?php if (!empty($editData['image'])): ?>
                    <div class="mt-2 p-2 bg-light rounded border d-inline-flex align-items-center" style="gap:8px;">
                      <i class="mdi mdi-file-check text-success font-18"></i>
                      <span class="font-12 font-weight-bold">Current Attachment:</span>
                      <a href="<?php echo URL_UPLOAD; ?>jobs/<?php echo $editData['image']; ?>" target="_blank" class="bu-doc-badge font-12">
                        <i class="mdi mdi-eye"></i> View <?php echo htmlspecialchars($editData['image']); ?>
                      </a>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                  <button type="submit" name="submit" class="bu-btn-primary">
                    <i class="mdi mdi-check-circle"></i> <?php echo ($action == 'edit') ? 'Update Job Opening' : 'Publish Job Opening'; ?>
                  </button>
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary font-weight-bold" style="border-radius:8px;">Cancel</a>
                </div>

              </form>
            </div>
          </div>
        </div>

        <?php
        } else {
            // =========================================================================
            // LIST ALL JOB OPENINGS
            // =========================================================================
            $db->orderBy('id', 'DESC');
            $jobsList = $db->get(DBTAB);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="bu-table-card">
              <div class="bu-table-header">
                <h5><i class="mdi mdi-format-list-bulleted-type" style="color:var(--bu-gold);"></i> All Active Job Openings &amp; Advertisements</h5>
                <span class="text-muted font-13 font-weight-bold">
                  Total: <?php echo count($jobsList); ?> Listed Notices
                </span>
              </div>
              <div class="p-3">
                <div class="table-responsive">
                  <table id="jobs-datatable" class="table table-hover table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead style="background: #F8FAFC;">
                      <tr style="color: var(--bu-navy); font-size: 13px;">
                        <th style="width: 50px;"># ID</th>
                        <th>Job Opening / Notification Title</th>
                        <th>Official Document</th>
                        <th>Posted Date</th>
                        <th style="text-align:center; width: 110px;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (is_array($jobsList) && count($jobsList) > 0) {
                          foreach ($jobsList as $row) {
                              $is_pdf = (substr(strtolower($row['image'] ?? ''), -4) === '.pdf');
                      ?>
                      <tr>
                        <td>
                          <span class="badge badge-light font-weight-bold" style="font-size:12px;color:var(--bu-navy);border:1px solid #CBD5E1;">
                            #<?php echo $row['id']; ?>
                          </span>
                        </td>
                        <td>
                          <div class="font-weight-bold text-dark font-14" style="line-height:1.5;max-width:550px;white-space:normal;">
                            <?php echo htmlspecialchars($row['title'] ?? ''); ?>
                          </div>
                          <?php if (!empty($row['description'])): ?>
                            <small class="text-muted d-block mt-1 text-truncate" style="max-width:500px;">
                              <?php echo strip_tags($row['description']); ?>
                            </small>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($row['image'])): ?>
                            <a href="<?php echo URL_UPLOAD; ?>jobs/<?php echo $row['image']; ?>" target="_blank" class="bu-doc-badge">
                              <i class="mdi <?php echo $is_pdf ? 'mdi-file-pdf' : 'mdi-file-image'; ?>" style="font-size:15px;"></i>
                              View Notification
                            </a>
                          <?php else: ?>
                            <span class="text-muted font-12"><i class="mdi mdi-minus"></i> No Document</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <small class="text-muted font-weight-bold">
                            <i class="mdi mdi-calendar-clock mr-1"></i>
                            <?php echo !empty($row['date']) ? date('d M Y, h:i A', strtotime($row['date'])) : '-'; ?>
                          </small>
                        </td>
                        <td style="text-align:center;">
                          <div class="bu-action-btn-group">
                            <a href="<?php echo PAGE; ?>?id=<?php echo $row['id']; ?>&action=edit" class="bu-btn-icon bu-btn-edit" title="Edit Job Opening">
                              <i class="mdi mdi-pencil"></i>
                            </a>
                            <a href="<?php echo PAGE; ?>?id=<?php echo $row['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete this job opening?');" class="bu-btn-icon bu-btn-del" title="Delete Job Opening">
                              <i class="mdi mdi-delete"></i>
                            </a>
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
  if ($('#jobs-datatable').length) {
    $('#jobs-datatable').DataTable({
      lengthChange: true,
      lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      pageLength: 25,
      buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
      responsive: true,
      order: [[0, 'desc']],
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search job openings...",
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'></i>",
          next: "<i class='mdi mdi-chevron-right'></i>"
        }
      }
    }).buttons().container().appendTo('#jobs-datatable_wrapper .col-md-6:eq(0)');
  }
});
</script>
</body>
</html>