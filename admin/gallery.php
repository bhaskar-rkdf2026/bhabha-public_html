<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
define("PAGE", 'gallery.php');
define("TITLE", 'Photo Gallery');
define("DBTAB", 'gallery');
define("UPLOAD", '../upload/gallery/');

// Ensure upload directories exist
if (!is_dir(UPLOAD)) { @mkdir(UPLOAD, 0777, true); }
if (!is_dir(UPLOAD . 'thumb/')) { @mkdir(UPLOAD . 'thumb/', 0777, true); }
if (!is_dir(UPLOAD . 'large/')) { @mkdir(UPLOAD . 'large/', 0777, true); }

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Fetch all departments for dropdown lookup
$all_departments = $db->get('department', null, 'id, title');
$dept_map = [];
if (is_array($all_departments)) {
    foreach ($all_departments as $d) {
        $dept_map[$d['id']] = $d['title'];
    }
}

// Handle Form Submission (Add / Edit)
if (isset($_POST['submit'])) {
    $dept_id = !empty($_POST['department']) ? intval($_POST['department']) : 0;
    $title = trim($_POST['title'] ?? '');
    $is_home = isset($_POST['is_home']) ? 1 : 0;

    if (empty($title)) {
        $stat["error"] = "Please enter a title for the photo.";
    }

    // Validate uploaded file if provided
    if (!empty($_FILES['icon']['name'])) {
        $filename = basename($_FILES['icon']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($ext, array('jpeg', 'jpg', 'png', 'webp', 'gif'))) {
            $stat["error"] = "Only JPG, JPEG, PNG, WEBP & GIF images are allowed.";
        }
    }

    // 1. ADD ACTION
    if ($action == "add" && count($stat) == 0) {
        if (empty($_FILES['icon']['name'])) {
            $stat["error"] = "Please select an image to upload.";
        } else {
            $data = array(
                "department" => $dept_id,
                "title"      => $title,
                "is_home"    => $is_home
            );

            $ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
            $newfile = md5(microtime() . rand(100, 999)) . "." . $ext;

            if (move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile)) {
                $data['image'] = $newfile;

                // Create large copy & resize if helper exists
                copy(UPLOAD . $newfile, UPLOAD . "large/" . $newfile);
                if (function_exists('resizeBySize')) {
                    resizeBySize($newfile, 750, 400, UPLOAD . "large/", false);
                }

                // Create thumb copy & resize if helper exists
                copy(UPLOAD . $newfile, UPLOAD . "thumb/" . $newfile);
                if (function_exists('resizeBySize')) {
                    resizeBySize($newfile, 325, 200, UPLOAD . "thumb/", false);
                }

                $id = $db->insert(DBTAB, $data);
                unset($_POST);
                unset($_SESSION['form']);
                $_SESSION["success"] = 'Photo added to gallery successfully!';
                redirect(PAGE);
            } else {
                $stat["error"] = "Failed to upload image. Please check directory permissions.";
            }
        }
    }
    // 2. EDIT ACTION
    elseif ($action == "edit" && count($stat) == 0) {
        $edit_id = intval($_REQUEST['id']);
        $data = array(
            "department" => $dept_id,
            "title"      => $title,
            "is_home"    => $is_home
        );

        if (!empty($_FILES['icon']['name'])) {
            $db->where('id', $edit_id);
            $oldData = $db->getOne(DBTAB);

            if (!empty($oldData['image'])) {
                @unlink(UPLOAD . $oldData['image']);
                @unlink(UPLOAD . "thumb/" . $oldData['image']);
                @unlink(UPLOAD . "large/" . $oldData['image']);
            }

            $ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
            $newfile = md5(microtime() . rand(100, 999)) . "." . $ext;

            if (move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile)) {
                $data['image'] = $newfile;

                copy(UPLOAD . $newfile, UPLOAD . "large/" . $newfile);
                if (function_exists('resizeBySize')) {
                    resizeBySize($newfile, 750, 400, UPLOAD . "large/", false);
                }

                copy(UPLOAD . $newfile, UPLOAD . "thumb/" . $newfile);
                if (function_exists('resizeBySize')) {
                    resizeBySize($newfile, 325, 200, UPLOAD . "thumb/", false);
                }
            }
        }

        $db->where('id', $edit_id);
        $db->update(DBTAB, $data);
        unset($_POST);
        unset($_SESSION['form']);
        $_SESSION["success"] = 'Photo updated successfully!';
        redirect(PAGE);
    }
}

// 3. DELETE ACTION
if ($action == "delete" && !empty($_REQUEST['id'])) {
    $del_id = intval($_REQUEST['id']);
    $db->where('id', $del_id);
    $oldData = $db->getOne(DBTAB);

    if (!empty($oldData['image'])) {
        @unlink(UPLOAD . $oldData['image']);
        @unlink(UPLOAD . "thumb/" . $oldData['image']);
        @unlink(UPLOAD . "large/" . $oldData['image']);
    }

    $db->where('id', $del_id);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Photo deleted successfully!';
    redirect(PAGE);
}

// Filter logic for table
$filter_dept = isset($_GET['filter_dept']) ? intval($_GET['filter_dept']) : -1;
if ($filter_dept >= 0) {
    $db->where('department', $filter_dept);
}
$db->orderBy('id', 'DESC');
$galleryList = $db->get(DBTAB);
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
/* Modern Photo Gallery Admin Styling */
.bu-admin-header-card {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #E2E8F0;
  padding: 16px 20px;
  margin-bottom: 20px;
  box-shadow: 0 2px 10px rgba(10, 27, 84, 0.04);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
}
.bu-admin-header-title h4 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 20px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 4px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-admin-header-title p {
  font-size: 12.5px;
  color: #64748B;
  margin: 0;
}
.bu-btn-navy {
  background: #0A1B54;
  color: #ffffff !important;
  font-weight: 700;
  font-size: 13px;
  padding: 9px 18px;
  border-radius: 6px;
  border: 1px solid #0A1B54;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.22s ease;
  box-shadow: 0 3px 8px rgba(10, 27, 84, 0.15);
  text-decoration: none !important;
}
.bu-btn-navy:hover {
  background: #061442;
  color: #FFC107 !important;
  transform: translateY(-2px);
  box-shadow: 0 5px 14px rgba(10, 27, 84, 0.22);
}
.bu-gallery-thumb-wrap {
  position: relative;
  width: 76px;
  height: 56px;
  border-radius: 6px;
  overflow: hidden;
  border: 1px solid #CBD5E1;
  background: #F1F5F9;
  display: inline-block;
  vertical-align: middle;
  cursor: pointer;
  transition: all 0.2s ease;
}
.bu-gallery-thumb-wrap:hover {
  transform: scale(1.08);
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  border-color: #0A1B54;
}
.bu-gallery-thumb-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.bu-badge-dept {
  background: rgba(10, 27, 84, 0.08);
  color: #0A1B54;
  border: 1px solid rgba(10, 27, 84, 0.2);
  font-size: 11px;
  font-weight: 700;
  padding: 4px 9px;
  border-radius: 12px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.bu-badge-general {
  background: #F1F5F9;
  color: #475569;
  border: 1px solid #CBD5E1;
  font-size: 11px;
  font-weight: 700;
  padding: 4px 9px;
  border-radius: 12px;
}
.bu-badge-home-yes {
  background: rgba(16, 185, 129, 0.12);
  color: #065F46;
  border: 1px solid rgba(16, 185, 129, 0.3);
  font-size: 11px;
  font-weight: 700;
  padding: 3px 8px;
  border-radius: 12px;
}
.bu-badge-home-no {
  background: #F8FAFC;
  color: #94A3B8;
  border: 1px solid #E2E8F0;
  font-size: 11px;
  font-weight: 600;
  padding: 3px 8px;
  border-radius: 12px;
}
.bu-action-btn-group {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.bu-btn-action-edit {
  background: #0A1B54;
  color: #ffffff !important;
  font-size: 12px;
  font-weight: 700;
  padding: 5px 10px;
  border-radius: 4px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: all 0.2s;
}
.bu-btn-action-edit:hover {
  background: #061442;
  color: #FFC107 !important;
}
.bu-btn-action-del {
  background: #EF4444;
  color: #ffffff !important;
  font-size: 12px;
  font-weight: 700;
  padding: 5px 10px;
  border-radius: 4px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: all 0.2s;
}
.bu-btn-action-del:hover {
  background: #DC2626;
}
.bu-form-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.05);
  overflow: hidden;
  position: relative;
}
.bu-form-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #FFC107 0%, #0A1B54 100%);
}
.bu-form-header {
  padding: 18px 24px;
  border-bottom: 1px solid #F1F5F9;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-form-header h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0;
}
.bu-form-body {
  padding: 24px;
}
.bu-preview-box {
  width: 140px;
  height: 95px;
  border-radius: 8px;
  border: 2px dashed #CBD5E1;
  background: #F8FAFC;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  margin-top: 8px;
}
.bu-preview-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.bu-filter-bar {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
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
        
        <!-- Header Actions Card -->
        <div class="bu-admin-header-card mt-3">
          <div class="bu-admin-header-title">
            <h4><i class="fa fa-picture-o text-warning"></i> <?php echo TITLE; ?> Management</h4>
            <p>Manage department photo albums, campus life galleries, and homepage showcase photos.</p>
          </div>
          <div>
            <?php if ($action == "add" || $action == "edit"): ?>
              <a href="<?php echo PAGE; ?>" class="btn btn-secondary waves-effect">
                <i class="fa fa-arrow-left"></i> Back to Photo List
              </a>
            <?php else: ?>
              <a href="<?php echo PAGE; ?>?action=add" class="bu-btn-navy">
                <i class="fa fa-plus-circle"></i> Add New Photo
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Notification Alerts -->
        <?php if (!empty($stat)): ?>
          <div class="mb-3"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <?php if ($action == "edit" || $action == "add"): 
          $formData = array(
              'department' => '',
              'title'      => '',
              'is_home'    => 0,
              'image'      => ''
          );

          if ($action == "edit" && !empty($_REQUEST['id'])) {
              $db->where('id', intval($_REQUEST['id']));
              $aryData = $db->getOne(DBTAB);
              if ($aryData) {
                  $formData = $aryData;
              }
          } elseif (!empty($_POST)) {
              $formData['department'] = $_POST['department'] ?? '';
              $formData['title']      = $_POST['title'] ?? '';
              $formData['is_home']    = isset($_POST['is_home']) ? 1 : 0;
          }
        ?>
        <!-- ADD / EDIT FORM CARD -->
        <div class="row">
          <div class="col-lg-10 col-xl-9">
            <div class="bu-form-card">
              <div class="bu-form-header">
                <h4><i class="fa <?php echo ($action == 'add') ? 'fa-plus-circle text-success' : 'fa-pencil-square text-info'; ?>"></i> <?php echo ucfirst($action); ?> Photo Entry</h4>
                <span class="badge badge-primary"><?php echo ($action == 'add') ? 'New Photo' : 'Editing ID #' . intval($_REQUEST['id']); ?></span>
              </div>
              
              <div class="bu-form-body">
                <form action="" method="post" enctype="multipart/form-data" id="buGalleryForm">
                  
                  <div class="row">
                    <!-- Department Selection -->
                    <div class="col-md-6 form-group">
                      <label class="font-weight-bold text-dark"><i class="fa fa-university text-primary"></i> Associated Department / Faculty <span class="text-danger">*</span></label>
                      <select name="department" class="form-control" style="height: 42px; border-radius: 6px;" required>
                        <option value="0" <?php echo ($formData['department'] == '0' || empty($formData['department'])) ? 'selected' : ''; ?>>— General / University-Wide Gallery —</option>
                        <?php if (is_array($all_departments)): ?>
                          <?php foreach ($all_departments as $idept): ?>
                            <option value="<?php echo $idept['id']; ?>" <?php echo ($formData['department'] == $idept['id']) ? 'selected' : ''; ?>>
                              <?php echo htmlspecialchars($idept['title']); ?> (Dept ID: <?php echo $idept['id']; ?>)
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                      <small class="form-text text-muted">Photos assigned to a department will display on that Department's Page Gallery.</small>
                    </div>

                    <!-- Photo Title -->
                    <div class="col-md-6 form-group">
                      <label class="font-weight-bold text-dark"><i class="fa fa-tag text-primary"></i> Photo Title / Event Caption <span class="text-danger">*</span></label>
                      <input type="text" name="title" class="form-control" style="height: 42px; border-radius: 6px;" placeholder="e.g. Computer Applications Seminar, Lab Practical, etc." value="<?php echo htmlspecialchars($formData['title']); ?>" required />
                    </div>
                  </div>

                  <div class="row mt-2">
                    <!-- Image File Upload -->
                    <div class="col-md-8 form-group">
                      <label class="font-weight-bold text-dark"><i class="fa fa-image text-primary"></i> Select Image File <?php echo ($action == 'add') ? '<span class="text-danger">*</span>' : ''; ?></label>
                      <input type="file" name="icon" id="galleryFileInput" class="form-control" accept="image/*" <?php echo ($action == 'add') ? 'required' : ''; ?> onchange="previewGalleryImage(this);" />
                      <small class="form-text text-muted">Supported formats: JPG, JPEG, PNG, WEBP. Recommended dimensions: <strong>750 &times; 400 px</strong> or higher.</small>
                      
                      <!-- Live Preview Container -->
                      <div class="mt-2" id="previewArea">
                        <?php if (!empty($formData['image'])): ?>
                          <div class="d-flex align-items-center gap-3">
                            <div class="bu-preview-box">
                              <img src="<?php echo URL_ROOT; ?>upload/gallery/<?php echo $formData['image']; ?>" alt="Current Image" onerror="this.src='<?php echo URL_ROOT; ?>extra-images/home-gallery1.jpg';" />
                            </div>
                            <span class="text-muted small ml-2"><i class="fa fa-check-circle text-success"></i> Current photo uploaded</span>
                          </div>
                        <?php else: ?>
                          <div class="bu-preview-box" id="emptyPreviewBox">
                            <i class="fa fa-picture-o fa-2x text-muted"></i>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>

                    <!-- Is Homepage Toggle -->
                    <div class="col-md-4 form-group">
                      <label class="font-weight-bold text-dark"><i class="fa fa-home text-primary"></i> Homepage Visibility</label>
                      <div class="custom-control custom-checkbox mt-2">
                        <input type="checkbox" class="custom-control-input" id="is_home_check" name="is_home" value="1" <?php echo (!empty($formData['is_home'])) ? 'checked' : ''; ?>>
                        <label class="custom-control-label font-weight-bold text-dark" for="is_home_check">Show on Main Homepage Gallery</label>
                      </div>
                      <small class="form-text text-muted">Check this box if you want this photo to appear in the Life at Bhabha slider on the main homepage.</small>
                    </div>
                  </div>

                  <hr class="my-4">

                  <!-- Form Action Buttons -->
                  <div class="d-flex align-items-center gap-2">
                    <button type="submit" name="submit" class="bu-btn-navy">
                      <i class="fa fa-save"></i> <?php echo ($action == 'add') ? 'Add Photo to Gallery' : 'Save Changes'; ?>
                    </button>
                    <a href="<?php echo PAGE; ?>" class="btn btn-secondary waves-effect ml-2">Cancel</a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>

        <?php else: ?>

        <!-- GALLERY DATA TABLE CARD -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20" style="border-radius: 10px; border: 1px solid #E2E8F0; box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);">
              <div class="card-body">
                
                <!-- Quick Department Filter -->
                <div class="row align-items-center mb-3">
                  <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-dark">
                      <i class="fa fa-list-ul text-primary"></i> All Gallery Photos 
                      <span class="badge badge-pill badge-primary ml-1"><?php echo is_array($galleryList) ? count($galleryList) : 0; ?> Photos</span>
                    </h5>
                  </div>
                  <div class="col-md-6 text-md-right mt-2 mt-md-0">
                    <form action="" method="get" class="form-inline d-inline-block">
                      <label class="mr-2 font-weight-bold small text-muted"><i class="fa fa-filter"></i> Filter by Department:</label>
                      <select name="filter_dept" class="form-control form-control-sm d-inline-block" style="width: auto;" onchange="this.form.submit();">
                        <option value="-1">All Departments (Show All)</option>
                        <option value="0" <?php echo ($filter_dept === 0) ? 'selected' : ''; ?>>General / University-Wide</option>
                        <?php if (is_array($all_departments)): ?>
                          <?php foreach ($all_departments as $d): ?>
                            <option value="<?php echo $d['id']; ?>" <?php echo ($filter_dept === intval($d['id'])) ? 'selected' : ''; ?>>
                              <?php echo htmlspecialchars($d['title']); ?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </form>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="galleryTable" class="table table-hover table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead style="background: #F8FAFC;">
                      <tr>
                        <th style="width: 50px;"># ID</th>
                        <th style="width: 90px;">Photo</th>
                        <th>Title / Event Caption</th>
                        <th>Department</th>
                        <th style="width: 110px;">Home Slider</th>
                        <th style="width: 120px;" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (is_array($galleryList) && count($galleryList) > 0): ?>
                        <?php foreach ($galleryList as $iList): 
                          $deptTitle = !empty($iList['department']) && isset($dept_map[$iList['department']]) ? $dept_map[$iList['department']] : 'General / Central';
                          $imgSrc = !empty($iList['image']) ? URL_ROOT . 'upload/gallery/' . $iList['image'] : URL_ROOT . 'extra-images/home-gallery1.jpg';
                        ?>
                        <tr>
                          <td class="font-weight-bold text-muted">#<?php echo $iList['id']; ?></td>
                          <td>
                            <a href="<?php echo $imgSrc; ?>" target="_blank" class="bu-gallery-thumb-wrap" title="Click to view full photo">
                              <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($iList['title']); ?>" class="bu-gallery-thumb-img" onerror="this.src='<?php echo URL_ROOT; ?>extra-images/home-gallery1.jpg';">
                            </a>
                          </td>
                          <td>
                            <strong class="text-dark" style="font-size: 13.5px;"><?php echo htmlspecialchars($iList['title']); ?></strong>
                          </td>
                          <td>
                            <?php if (!empty($iList['department']) && isset($dept_map[$iList['department']])): ?>
                              <span class="bu-badge-dept"><i class="fa fa-graduation-cap"></i> <?php echo htmlspecialchars($deptTitle); ?></span>
                            <?php else: ?>
                              <span class="bu-badge-general"><i class="fa fa-university"></i> General / All</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if (!empty($iList['is_home'])): ?>
                              <span class="bu-badge-home-yes"><i class="fa fa-check-circle"></i> Homepage</span>
                            <?php else: ?>
                              <span class="bu-badge-home-no">No</span>
                            <?php endif; ?>
                          </td>
                          <td class="text-center">
                            <div class="bu-action-btn-group">
                              <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=edit" class="bu-btn-action-edit" title="Edit Photo">
                                <i class="fa fa-pencil"></i> Edit
                              </a>
                              <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=delete" onclick="return deletex();" class="bu-btn-action-del" title="Delete Photo">
                                <i class="fa fa-trash"></i> Delete
                              </a>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fa fa-folder-open-o fa-2x mb-2 d-block"></i>
                            No gallery records found.
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
<script src="<?php echo URL_PLUG;?>datatables/jszip.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/pdfmake.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/vfs_fonts.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.html5.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.print.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.colVis.min.js"></script>

<script>
$(document).ready(function() {
  $('#galleryTable').DataTable({
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
      searchPlaceholder: "Search photos...",
      lengthMenu: "Show _MENU_ entries",
      info: "Showing <strong>_START_</strong> to <strong>_END_</strong> of <strong>_TOTAL_</strong> photos",
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

function previewGalleryImage(input) {
  const previewArea = document.getElementById('previewArea');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      previewArea.innerHTML = `
        <div class="d-flex align-items-center gap-3">
          <div class="bu-preview-box">
            <img src="${e.target.result}" alt="New Preview" />
          </div>
          <span class="text-success small ml-2"><i class="fa fa-check-circle"></i> Ready to upload</span>
        </div>
      `;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
</body>
</html>