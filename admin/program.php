<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'program.php');
define("TITLE", 'Program Category');
define("DBTAB", 'program');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Helper to make slug
function bu_make_slug($string) {
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', trim($string));
    return strtolower(trim($slug, '-'));
}

if (isset($_POST['submit'])) {
    $prog_name = trim($_POST['program'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    if (empty($slug) && !empty($prog_name)) {
        $slug = bu_make_slug($prog_name);
    }
    $icon = trim($_POST['icon'] ?? 'fa-graduation-cap');
    $sort_order = intval($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;

    if (empty($prog_name)) {
        $stat['error'] = 'Program Category Name cannot be empty.';
    }

    if ($action == "add" && count($stat) == 0) {
        $data = array(
            "program"    => $prog_name,
            "slug"       => $slug,
            "icon"       => $icon,
            "sort_order" => $sort_order,
            "status"     => $status
        );
        
        $id = $db->insert(DBTAB, $data);
        if ($id) {
            unset($_POST);
            unset($_SESSION['form']);
            $_SESSION["success"] = 'Program category added successfully.';
            redirect(PAGE);
        } else {
            $stat['error'] = 'Failed to add category: ' . $db->getLastError();
        }
    } elseif ($action == "edit" && count($stat) == 0) {
        $id = intval($_REQUEST['id']);
        $data = array(
            "program"    => $prog_name,
            "slug"       => $slug,
            "icon"       => $icon,
            "sort_order" => $sort_order,
            "status"     => $status
        );

        $db->where('id', $id);
        if ($db->update(DBTAB, $data)) {
            unset($_POST);
            unset($_SESSION['form']);
            $_SESSION["success"] = 'Program category updated successfully.';
            redirect(PAGE);
        } else {
            $stat['error'] = 'Failed to update category: ' . $db->getLastError();
        }
    }
}

if ($action == "delete") {
    $del_id = intval($_REQUEST['id']);
    
    // Check if any courses are assigned to this category
    $db->where('program', $del_id);
    $courseCount = $db->getValue('course', 'count(*)');
    
    if ($courseCount > 0) {
        $_SESSION["error"] = "Cannot delete this category: {$courseCount} courses are currently assigned to it. Please reassign those courses first.";
        redirect(PAGE);
    } else {
        $db->where('id', $del_id);
        $db->delete(DBTAB);
        $_SESSION["success"] = 'Program category deleted successfully.';
        redirect(PAGE);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> Management - Bhabha Admin</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
</head>
<body>
<!-- Begin page -->
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><?php echo TITLE; ?> Settings</h4>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="section_hub.php?section=schools">Institutes &amp; Courses</a></li>
                <li class="breadcrumb-item active"><?php echo TITLE; ?></li>
              </ol>
            </div>
          </div>
        </div>

        <?php if ($action == "edit" || $action == "add"): 
          $aryData = [];
          if ($action == "edit") {
              $db->where('id', intval($_REQUEST['id']));
              $aryData = $db->getOne(DBTAB);
          }
        ?>
        <div class="row">
          <div class="col-12 col-lg-8">
            <div class="card m-b-20">
              <div class="card-body">
                <h4 class="mt-0 header-title"><?php echo ucfirst($action); ?> <?php echo TITLE; ?></h4>
                <p class="text-muted m-b-20 font-14">Configure programme categories (e.g. Under Graduate, Post Graduate, Integrated Programmes, Doctoral, Diploma, Certificate) that organize courses on the frontend.</p>
                
                <div style="margin-bottom: 20px;">
                  <?php echo msg($stat); ?>
                </div>

                <form action="" method="post">
                  <div class="form-group">
                    <label>Category / Program Name <span class="text-danger">*</span></label>
                    <input type="text" name="program" class="form-control" required 
                           placeholder="e.g. Integrated Programmes, Under Graduate, Post Graduate"
                           value="<?php echo htmlspecialchars($action == 'edit' ? ($aryData['program'] ?? '') : ($_POST['program'] ?? '')); ?>" />
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>URL Slug</label>
                      <input type="text" name="slug" class="form-control" 
                             placeholder="e.g. integrated, undergraduate, postgraduate"
                             value="<?php echo htmlspecialchars($action == 'edit' ? ($aryData['slug'] ?? '') : ($_POST['slug'] ?? '')); ?>" />
                      <small class="form-text text-muted">Used in URL filter (e.g. <code>programmes.php?type=integrated</code>). Auto-generated from name if left empty.</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label>FontAwesome Icon Class</label>
                      <input type="text" name="icon" class="form-control" 
                             placeholder="e.g. fa-cubes, fa-graduation-cap, fa-book"
                             value="<?php echo htmlspecialchars($action == 'edit' ? ($aryData['icon'] ?? 'fa-graduation-cap') : ($_POST['icon'] ?? 'fa-graduation-cap')); ?>" />
                      <small class="form-text text-muted">Icons: <code>fa-cubes</code> (Integrated), <code>fa-graduation-cap</code> (UG), <code>fa-book</code> (PG), <code>fa-university</code> (Doctoral), <code>fa-certificate</code> (Diploma), <code>fa-file-text-o</code> (Certificate)</small>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Sort Order</label>
                      <input type="number" name="sort_order" class="form-control" 
                             value="<?php echo htmlspecialchars($action == 'edit' ? ($aryData['sort_order'] ?? 0) : ($_POST['sort_order'] ?? 0)); ?>" />
                      <small class="form-text text-muted">Lower number displays first in menu and tabs.</small>
                    </div>

                    <div class="form-group col-md-6 d-flex align-items-center" style="margin-top:25px;">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="statusCheckbox" name="status" value="1" 
                          <?php 
                            if ($action == 'edit') {
                                if (($aryData['status'] ?? 1) == 1) echo 'checked';
                            } else {
                                echo 'checked';
                            }
                          ?> />
                        <label class="custom-control-label" for="statusCheckbox">Active Status (Visible on frontend)</label>
                      </div>
                    </div>
                  </div>

                  <div class="mt-4">
                    <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                      <i class="fa fa-save mr-1"></i> Save Category
                    </button>
                    <a href="<?php echo PAGE; ?>" class="btn btn-secondary waves-effect ml-2">Cancel</a>
                  </div>
                </form>

              </div>
            </div>
          </div>

          <div class="col-12 col-lg-4">
            <div class="card m-b-20 border-info">
              <div class="card-header bg-info text-white font-weight-bold">
                <i class="mdi mdi-information-outline mr-1"></i> Quick Tips
              </div>
              <div class="card-body font-13" style="line-height: 1.7;">
                <p><strong>How Categories Work:</strong></p>
                <ul>
                  <li>Any category added here will automatically appear in the <strong>Course Add/Edit</strong> dropdown.</li>
                  <li>It will also display in the frontend <strong>Programmes menu</strong> (navbar dropdown) and <strong>Programmes page tabs</strong> (<code>programmes.php</code>).</li>
                  <li>When you create a course (e.g. <em>B.Sc. B.Ed.</em>), select its category (e.g. <em>Integrated Programmes</em>) to link it.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <?php else: ?>

        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="mt-0 header-title"><?php echo TITLE; ?> Directory</h4>
                    <p class="text-muted font-14 m-b-0">Manage degree levels and programme categories for Bhabha University.</p>
                  </div>
                  <div>
                    <a class="btn btn-primary waves-effect waves-light" href="<?php echo PAGE; ?>?action=add">
                      <i class="mdi mdi-plus-circle mr-1"></i> Add Category
                    </a>
                  </div>
                </div>

                <div style="margin-bottom: 15px;">
                  <?php echo msg($stat); ?>
                </div>

                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                    <thead>
                      <tr>
                        <th style="width:50px;">#</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th style="width:80px; text-align:center;">Icon</th>
                        <th style="text-align:center;">Courses Assigned</th>
                        <th style="width:80px; text-align:center;">Sort Order</th>
                        <th style="width:80px; text-align:center;">Status</th>
                        <th style="width:130px; text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $aryData = $db->rawQuery("
                          SELECT p.*, COUNT(c.id) AS course_count 
                          FROM program p 
                          LEFT JOIN course c ON c.program = p.id 
                          GROUP BY p.id 
                          ORDER BY p.sort_order ASC, p.id ASC
                      ");
                      if (is_array($aryData) && count($aryData) > 0) {
                          foreach ($aryData as $iList) {
                              $isActive = ($iList['status'] ?? 1) == 1;
                              $icon = !empty($iList['icon']) ? $iList['icon'] : 'fa-graduation-cap';
                      ?>
                      <tr>
                        <td><?php echo $iList['id']; ?></td>
                        <td>
                          <strong><?php echo htmlspecialchars($iList['program']); ?></strong>
                        </td>
                        <td><code><?php echo htmlspecialchars($iList['slug'] ?? ''); ?></code></td>
                        <td class="text-center">
                          <i class="fa <?php echo htmlspecialchars($icon); ?> fa-lg text-primary"></i>
                        </td>
                        <td class="text-center">
                          <a href="course.php" class="badge badge-pill badge-info font-12" style="padding: 6px 12px;">
                            <i class="mdi mdi-book-open-variant mr-1"></i> <?php echo intval($iList['course_count']); ?> Courses
                          </a>
                        </td>
                        <td class="text-center"><?php echo intval($iList['sort_order'] ?? 0); ?></td>
                        <td class="text-center">
                          <?php if ($isActive): ?>
                            <span class="badge badge-success" style="padding:5px 10px;">Active</span>
                          <?php else: ?>
                            <span class="badge badge-secondary" style="padding:5px 10px;">Inactive</span>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=edit" class="btn btn-sm btn-info">
                            <i class="mdi mdi-pencil"></i> Edit
                          </a>
                          <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=delete" 
                             onclick="return confirm('Are you sure you want to delete this program category?');" 
                             class="btn btn-sm btn-danger">
                            <i class="mdi mdi-delete"></i> Delete
                          </a>
                        </td>
                      </tr>
                      <?php
                          }
                      } else {
                      ?>
                      <tr>
                        <td colspan="8" class="text-center">No program categories found.</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

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
<!-- Required datatable js --> 
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.buttons.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.js"></script> 
<script src="<?php echo URL_JS;?>datatables.init.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/jszip.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/pdfmake.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/vfs_fonts.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.html5.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.print.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.colVis.min.js"></script>
</body>
</html>
