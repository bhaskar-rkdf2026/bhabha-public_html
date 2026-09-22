<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'pages.php');
define("TITLE", 'Website Pages');
define("DBTAB", 'page');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Quick status toggle via GET
if ($action == "toggle_status" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $newStatus = ($curr['status'] == 1) ? 0 : 1;
        $db->where('id', $id);
        $db->update(DBTAB, ['status' => $newStatus]);
        $_SESSION["success"] = 'Status updated for "' . $curr['title'] . '"!';
    }
    redirect(PAGE);
}

// Handle Form Submission (Add / Edit)
if (isset($_POST['submit'])) {
    $title    = trim($_POST['title'] ?? '');
    $heading  = trim($_POST['heading'] ?? '');
    $identity = trim($_POST['identity'] ?? '');
    $data     = $_POST['data'] ?? '';
    $status   = isset($_POST['status']) ? intval($_POST['status']) : 0;

    if (empty($title)) {
        $stat['error'] = 'Page title is required.';
    } else {
        $dataArr = [
            "title"    => $title,
            "slug"     => createslug($title),
            "identity" => $identity,
            "heading"  => $heading,
            "data"     => $data,
            "status"   => $status
        ];

        if ($action == "add" && count($stat) == 0) {
            $id = $db->insert(DBTAB, $dataArr);
            unset($_POST);
            unset($_SESSION['form']);
            $_SESSION["success"] = 'New page added successfully!';
            redirect(PAGE);
        } elseif ($action == "edit" && count($stat) == 0 && isset($_REQUEST['id'])) {
            $db->where('id', intval($_REQUEST['id']));
            $db->update(DBTAB, $dataArr);
            unset($_POST);
            unset($_SESSION['form']);
            $_SESSION["success"] = 'Page details updated successfully!';
            redirect(PAGE);
        }
    }
}

// Handle Delete
if ($action == "delete" && isset($_REQUEST['id'])) {
    $db->where('id', intval($_REQUEST['id']));
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Page deleted successfully!';
    redirect(PAGE);	
}

// Fetch stats
$allPages = $db->get(DBTAB);
$totalCount = is_array($allPages) ? count($allPages) : 0;
$activeCount = 0;
if (is_array($allPages)) {
    foreach ($allPages as $p) {
        if (!empty($p['status']) && $p['status'] == 1) $activeCount++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> Dashboard - Bhabha University</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<style>
/* ============================================================
   BHABHA UNIVERSITY - ADMIN THEME STYLING
   ============================================================ */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-bg: #F8FAFC;
  --bu-card-border: #E2E8F0;
}

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
  display: flex;
  align-items: center;
  gap: 10px;
}
.dash-portal-title i {
  color: var(--bu-gold);
}
.dash-portal-sub {
  font-size: 13px;
  color: #CBD5E1;
  margin: 0;
}

.kpi-mini-box {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid var(--bu-card-border);
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 24px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.02);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.kpi-mini-box:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(10,27,84,0.06);
}
.kpi-mini-icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.kpi-mini-icon.navy  { background: rgba(10, 27, 84, 0.08); color: var(--bu-navy); }
.kpi-mini-icon.green { background: #ECFDF5; color: #059669; }
.kpi-mini-icon.gold  { background: #FEF3C7; color: #D97706; }
.kpi-mini-num {
  font-size: 22px;
  font-weight: 800;
  color: #0F172A;
  line-height: 1.1;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.kpi-mini-label {
  font-size: 12px;
  color: #64748B;
  font-weight: 600;
  margin-top: 3px;
}

.card-section-box {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-card-border);
  padding: 26px;
  margin-bottom: 24px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.04);
}
.card-box-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 14px;
  border-bottom: 1.5px solid var(--bu-card-border);
  flex-wrap: wrap;
  gap: 12px;
}
.card-box-title {
  font-size: 17px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Custom DataTable Header */
#datatable-pages thead th {
  background: #0A1B54 !important;
  color: #ffffff !important;
  font-weight: 600;
  font-size: 13px;
  letter-spacing: 0.5px;
  border-color: #0A1B54 !important;
  padding: 12px 14px;
}
#datatable-pages tbody td {
  vertical-align: middle;
  font-size: 13.5px;
  padding: 12px 14px;
  color: #334155;
  border-color: #F1F5F9;
}
#datatable-pages tbody tr:hover {
  background-color: #F8FAFC !important;
}

/* Identity & Status Badges */
.bu-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 10px;
  border-radius: 6px;
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.3px;
}
.bu-badge-identity {
  background: #EEF2FF;
  color: #4338CA;
  border: 1px solid #C7D2FE;
}
.bu-badge-id {
  background: #F1F5F9;
  color: #475569;
  font-weight: 700;
  font-family: monospace;
  font-size: 12px;
  padding: 2px 7px;
  border-radius: 4px;
}
.badge-active {
  background-color: #DCFCE7 !important;
  color: #15803D !important;
  border: 1px solid #BBF7D0;
  cursor: pointer;
}
.badge-inactive {
  background-color: #FEE2E2 !important;
  color: #B91C1C !important;
  border: 1px solid #FECACA;
  cursor: pointer;
}
.badge-active:hover, .badge-inactive:hover {
  opacity: 0.85;
}

/* Action Buttons */
.btn-bu-primary {
  background: var(--bu-navy);
  border-color: var(--bu-navy);
  color: #ffffff !important;
  font-weight: 600;
  border-radius: 6px;
  padding: 8px 18px;
  transition: all 0.2s ease;
}
.btn-bu-primary:hover {
  background: var(--bu-navy-dark);
  border-color: var(--bu-navy-dark);
  box-shadow: 0 4px 12px rgba(10,27,84,0.25);
  transform: translateY(-1px);
}
.btn-bu-gold {
  background: var(--bu-gold);
  border-color: var(--bu-gold);
  color: #0A1B54 !important;
  font-weight: 700;
  border-radius: 6px;
  padding: 8px 18px;
  transition: all 0.2s ease;
}
.btn-bu-gold:hover {
  background: var(--bu-gold-dark);
  border-color: var(--bu-gold-dark);
  color: #ffffff !important;
}
.btn-action-edit {
  background: #EFF6FF;
  color: #1D4ED8 !important;
  border: 1px solid #BFDBFE;
  font-weight: 600;
  border-radius: 6px;
  padding: 5px 12px;
  font-size: 12.5px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s ease;
}
.btn-action-edit:hover {
  background: #1D4ED8;
  color: #ffffff !important;
  border-color: #1D4ED8;
}
.btn-action-view {
  background: #F8FAFC;
  color: #475569 !important;
  border: 1px solid #CBD5E1;
  font-weight: 600;
  border-radius: 6px;
  padding: 5px 10px;
  font-size: 12.5px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s ease;
}
.btn-action-view:hover {
  background: #0A1B54;
  color: #ffffff !important;
  border-color: #0A1B54;
}

/* Modern Form Controls */
.bu-form-label {
  font-size: 13px;
  font-weight: 700;
  color: #1E293B;
  margin-bottom: 6px;
}
.bu-form-control {
  border: 1.5px solid #CBD5E1;
  border-radius: 6px;
  padding: 10px 14px;
  font-size: 14px;
  color: #0F172A;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.bu-form-control:focus {
  border-color: var(--bu-navy);
  box-shadow: 0 0 0 3px rgba(10,27,84,0.12);
  outline: none;
}
.bu-switch-wrap {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
}
</style>
</head>
<body>
<!-- Begin page -->
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">

        <!-- Header Hero Banner -->
        <div class="dash-portal-hero mt-3">
          <div>
            <h2 class="dash-portal-title"><i class="mdi mdi-album"></i> Website Standalone Pages</h2>
            <p class="dash-portal-sub">Manage content for custom pages, fee structures, bank details, research notices, and examination alerts.</p>
          </div>
          <div class="d-flex align-items-center gap-2">
            <?php if($action == "edit" || $action == "add"): ?>
              <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-outline-light"><i class="mdi mdi-arrow-left"></i> Back to Pages List</a>
            <?php else: ?>
              <a href="<?php echo PAGE; ?>?action=add" class="btn btn-sm btn-bu-gold"><i class="mdi mdi-plus-circle"></i> Add New Page</a>
              <a href="dashboard.php" class="btn btn-sm btn-outline-light"><i class="mdi mdi-view-dashboard"></i> Dashboard</a>
            <?php endif; ?>
          </div>
        </div>

        <!-- KPI Summary Cards -->
        <?php if($action != "edit" && $action != "add"): ?>
        <div class="row">
          <div class="col-md-4">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon navy"><i class="mdi mdi-file-multiple" style="font-size:24px;"></i></div>
              <div>
                <div class="kpi-mini-num"><?php echo $totalCount; ?></div>
                <div class="kpi-mini-label">TOTAL STANDALONE PAGES</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon green"><i class="mdi mdi-checkbox-marked-circle-outline" style="font-size:24px;"></i></div>
              <div>
                <div class="kpi-mini-num"><?php echo $activeCount; ?></div>
                <div class="kpi-mini-label">PUBLISHED & ACTIVE</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon gold"><i class="mdi mdi-earth" style="font-size:24px;"></i></div>
              <div>
                <div class="kpi-mini-num">page.php?id=..</div>
                <div class="kpi-mini-label">CMS DYNAMIC ROUTING</div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Alerts -->
        <?php if(!empty($stat['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-checkbox-marked-circle"></i> <?php echo $stat['success']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <?php if(!empty($stat['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle"></i> <?php echo $stat['error']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <!-- ADD / EDIT FORM -->
        <?php
        if($action=="edit" || $action=="add")
		{
			if($action=="edit")
			{
				$db->where('id', intval($_REQUEST['id']));
				$aryData = $db->getOne(DBTAB);
                if(!$aryData) {
                    echo '<div class="alert alert-danger">Page record not found. <a href="'.PAGE.'">Return to list</a></div>';
                }
			}
            if($action=="add" || !empty($aryData)) {
			?>
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="card-box-header">
                <div>
                  <h4 class="card-box-title">
                    <i class="mdi mdi-pencil-box-outline text-primary"></i> 
                    <?php echo ($action=="edit") ? 'Edit Page: ' . htmlspecialchars($aryData['title']) : 'Create New Standalone Page'; ?>
                  </h4>
                  <p class="text-muted font-13 mb-0">Fill in the SEO metadata, section identity and rich HTML body content.</p>
                </div>
                <?php if($action=="edit"): ?>
                <div>
                  <a href="../page.php?id=<?php echo $aryData['id']; ?>" target="_blank" class="btn btn-sm btn-action-view">
                    <i class="mdi mdi-open-in-new"></i> Preview Live Page
                  </a>
                </div>
                <?php endif; ?>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="bu-form-label">SEO Page Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" required class="form-control bu-form-control" placeholder="e.g. University Account Details" value="<?php if($action=="edit"){echo htmlspecialchars($aryData['title']);}else{echo htmlspecialchars($_POST['title'] ?? '');}?>"/>
                    <small class="form-text text-muted">Displayed on browser tab and search results.</small>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="bu-form-label">Page Heading</label>
                    <input type="text" name="heading" class="form-control bu-form-control" placeholder="e.g. Bank Account & NEFT Details" value="<?php if($action=="edit"){echo htmlspecialchars($aryData['heading']);}else{echo htmlspecialchars($_POST['heading'] ?? '');}?>"/>
                    <small class="form-text text-muted">Large banner heading on the frontend page.</small>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="bu-form-label">Section / Category Identity</label>
                    <input type="text" name="identity" class="form-control bu-form-control" placeholder="e.g. Admissions, Academic, Research" value="<?php if($action=="edit"){echo htmlspecialchars($aryData['identity']);}else{echo htmlspecialchars($_POST['identity'] ?? '');}?>"/>
                    <small class="form-text text-muted">Controls sidebar navigation category context.</small>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="bu-form-label">Publication Status</label>
                    <div class="bu-switch-wrap mt-1">
                      <input type="checkbox" id="statusCheckbox" name="status" value="1" <?php if($action=="edit"){ if($aryData['status']==1){ echo "checked";}} else { echo "checked"; }?>>
                      <label for="statusCheckbox" class="mb-0 font-weight-bold text-dark" style="cursor:pointer;">
                        Active &amp; Published on Website
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="bu-form-label">Page Content Body (Rich HTML)</label>
                  <textarea name="data" class="form-control ckeditor" rows="8"><?php if($action=="edit"){echo $aryData['data'];}else{echo $_POST['data'] ?? '';}?></textarea>
                </div>
                
                <hr class="mt-4 mb-4">
                
                <div class="d-flex align-items-center gap-2">
                  <button type="submit" name="submit" class="btn btn-bu-primary">
                    <i class="mdi mdi-content-save"></i> Save &amp; Publish Changes
                  </button>
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary" style="border-radius:6px; padding:8px 18px;">
                    <i class="mdi mdi-close"></i> Cancel
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php
            }
		}
		else
		{
		?>
        <!-- PAGES LIST DATATABLE -->
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="card-box-header">
                <div>
                  <h4 class="card-box-title"><i class="mdi mdi-format-list-bulleted text-primary"></i> All Standalone Website Pages</h4>
                  <p class="text-muted font-13 mb-0">Total <?php echo $totalCount; ?> standalone pages registered in the database.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <a href="<?php echo PAGE; ?>?action=add" class="btn btn-sm btn-bu-gold">
                    <i class="mdi mdi-plus-circle"></i> Add New Page
                  </a>
                </div>
              </div>

              <div class="table-responsive">
                <table id="datatable-pages" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%;">
                  <thead>
                    <tr>
                      <th style="width:60px; text-align:center;">ID</th>
                      <th>Page Title &amp; Slug</th>
                      <th style="width:180px;">Identity / Section</th>
                      <th style="width:110px; text-align:center;">Status</th>
                      <th style="width:140px; text-align:center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(is_array($allPages) && count($allPages) > 0)
                    {
                      foreach($allPages as $iList)
                      {
                        $isAct = (!empty($iList['status']) && $iList['status'] == 1);
                    ?>
                    <tr>
                      <td style="text-align:center;">
                        <span class="bu-badge-id">#<?php echo $iList['id'];?></span>
                      </td>
                      <td>
                        <strong style="color:#0A1B54; font-size:14.5px;"><?php echo htmlspecialchars($iList['title']);?></strong>
                        <?php if(!empty($iList['heading']) && $iList['heading'] != $iList['title']): ?>
                          <div style="font-size:12px; color:#64748B; margin-top:2px;">Heading: <?php echo htmlspecialchars($iList['heading']); ?></div>
                        <?php endif; ?>
                        <div style="font-size:11.5px; color:#94A3B8; font-family:monospace; margin-top:3px;">
                          page.php?id=<?php echo $iList['id'];?>
                        </div>
                      </td>
                      <td>
                        <span class="bu-badge bu-badge-identity">
                          <i class="mdi mdi-folder-outline"></i> <?php echo htmlspecialchars($iList['identity'] ?: 'General'); ?>
                        </span>
                      </td>
                      <td style="text-align:center;">
                        <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=toggle_status" 
                           title="Click to toggle status"
                           class="bu-badge <?php echo $isAct ? 'badge-active' : 'badge-inactive'; ?>">
                          <i class="mdi <?php echo $isAct ? 'mdi-check' : 'mdi-close'; ?>"></i> 
                          <?php echo $isAct ? 'Active' : 'Inactive'; ?>
                        </a>
                      </td>
                      <td style="text-align:center;">
                        <div class="d-inline-flex gap-1">
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=edit" class="btn-action-edit" title="Edit Page Content">
                            <i class="mdi mdi-pencil"></i> Edit
                          </a>
                          <a href="../page.php?id=<?php echo $iList['id']; ?>" target="_blank" class="btn-action-view" title="View Live Page">
                            <i class="mdi mdi-open-in-new"></i>
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
        <?php 
		}
		?>
      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>

<!-- DataTables JS & Plugins -->
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script> 
<script>
$(document).ready(function() {
  $('#datatable-pages').DataTable({
    pageLength: 25,
    responsive: true,
    order: [[0, 'asc']],
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search pages...",
      lengthMenu: "Show _MENU_ records",
      info: "Showing _START_ to _END_ of _TOTAL_ pages"
    }
  });
});
</script>
</body>
</html>