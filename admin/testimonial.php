<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');
$stat = array();
$action = $_GET['action'] ?? '';
define("PAGE", 'testimonial.php');
define("TITLE", 'Student & Alumni Testimonials');
define("DBTAB", 'testimonial');
define("UPLOAD", '../upload/testimonial/');

if(isset($_SESSION['success']) && $_SESSION['success'] != "")
{
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if(isset($_SESSION['error']) && $_SESSION['error'] != "")
{
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

if(isset($_POST['submit']))
{
    if(isset($_FILES['icon']) && $_FILES['icon']['name'] != '')
    {
        $filename = basename($_FILES['icon']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if(!in_array($ext, array('jpeg', 'jpg', 'png', 'gif', 'svg', 'webp')))
        {
            $stat["error"] = "Only JPG, PNG, GIF, SVG & WEBP images are allowed.";
        }
    }
    
    if($action == "add" && count($stat) == 0)	
    {
        $data = array(
            "name"        => trim($_POST['name'] ?? ''),
            "designation" => trim($_POST['designation'] ?? ''),
            "testimonial" => trim($_POST['testimonial'] ?? '')
        );
        if(isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != '')
        {
            if(!is_dir(UPLOAD)) {
                mkdir(UPLOAD, 0777, true);
            }
            $file_ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
            $newfile = md5(microtime(true) . rand(100, 999)) . "." . $file_ext;
            if(move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile))
            {
                $data['image'] = $newfile;
                if(in_array($file_ext, array('jpg', 'jpeg', 'png', 'gif'))) {
                    resizeBySize($newfile, 200, 200, UPLOAD, false);
                }
            }
        }
        $id = $db->insert(DBTAB, $data);
        unset($_POST);
        $_SESSION["success"] = 'Testimonial added successfully!';
        redirect(PAGE);
    }
    elseif($action == "edit" && count($stat) == 0)	
    {
        $data = array(
            "name"        => trim($_POST['name'] ?? ''),
            "designation" => trim($_POST['designation'] ?? ''),
            "testimonial" => trim($_POST['testimonial'] ?? '')
        );
        if(isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != '')
        {
            $db->where('id', $_REQUEST['id']);
            $aryData = $db->getOne(DBTAB);
            if(!empty($aryData['image']) && file_exists(UPLOAD . $aryData['image'])) {
                @unlink(UPLOAD . $aryData['image']);
            }
            if(!is_dir(UPLOAD)) {
                mkdir(UPLOAD, 0777, true);
            }
            $file_ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
            $newfile = md5(microtime(true) . rand(100, 999)) . "." . $file_ext;
            if(move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile))
            {
                $data['image'] = $newfile;
                if(in_array($file_ext, array('jpg', 'jpeg', 'png', 'gif'))) {
                    resizeBySize($newfile, 200, 200, UPLOAD, false);
                }
            }
        }
        $db->where('id', $_REQUEST['id']);
        $db->update(DBTAB, $data);
        unset($_POST);
        $_SESSION["success"] = 'Testimonial updated successfully!';
        redirect(PAGE);
    }
}
if($action == "delete")
{
    $db->where('id', $_REQUEST['id']);
    $aryData = $db->getOne(DBTAB);
    if(!empty($aryData['image']) && file_exists(UPLOAD . $aryData['image'])) {
        @unlink(UPLOAD . $aryData['image']);
    }
    $db->where('id', $_REQUEST['id']);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Testimonial deleted successfully!';
    redirect(PAGE);	
}

// Fetch all testimonials count
$totalTestimonials = $db->getValue(DBTAB, "count(*)");
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
   Executive Testimonials Theme Styles
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
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
}
.bu-form-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 20px;
  padding-bottom: 12px;
  border-bottom: 2px solid var(--bu-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* Upload Preview Box */
.bu-avatar-preview-box {
  background: #F8FAFC;
  border: 2px dashed #CBD5E1;
  border-radius: 10px;
  padding: 16px;
  text-align: center;
  min-height: 120px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 10px;
  transition: all 0.2s ease;
}
.bu-avatar-preview-box img {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  object-fit: cover;
  background: #ffffff;
  padding: 3px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  border: 2px solid #D99B00;
}

/* Table Card */
.bu-table-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 22px;
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
}
.bu-table thead th {
  background: #0A1B54;
  color: #FFFFFF;
  font-weight: 700;
  font-size: 13px;
  letter-spacing: 0.5px;
  border: none;
  padding: 12px 14px;
  vertical-align: middle;
}
.bu-table tbody td {
  vertical-align: middle;
  padding: 14px;
  color: var(--bu-text-dark);
  font-size: 13.5px;
  border-color: #F1F5F9;
}
.bu-table tbody tr:hover {
  background-color: #F8FAFC;
}

/* User Avatar in Table */
.bu-user-avatar {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #E2E8F0;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  transition: transform 0.2s ease, border-color 0.2s ease;
}
.bu-user-avatar:hover {
  transform: scale(1.15);
  border-color: var(--bu-gold);
}
.bu-avatar-placeholder {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: linear-gradient(135deg, #0A1B54 0%, #1E3A8A 100%);
  color: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 18px;
  box-shadow: 0 2px 6px rgba(10,27,84,0.15);
}

/* Testimonial Quote Bubble in Table */
.bu-quote-box {
  background: #F8FAFC;
  border-left: 3px solid var(--bu-gold);
  border-radius: 0 8px 8px 0;
  padding: 8px 12px;
  font-size: 12.5px;
  color: #475569;
  line-height: 1.5;
  max-width: 420px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  position: relative;
}

/* Action Buttons */
.bu-btn-action {
  width: 34px;
  height: 34px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  line-height: 1;
  transition: all 0.2s ease;
  margin: 0 2px;
  border: none;
  text-decoration: none !important;
  vertical-align: middle;
}
.bu-btn-action i {
  font-size: 17px;
  line-height: 1;
}
.bu-btn-view {
  background: #E8F5E9;
  color: #2E7D32 !important;
  border: 1px solid #C8E6C9;
}
.bu-btn-view:hover {
  background: #2E7D32;
  color: #FFFFFF !important;
}
.bu-btn-edit {
  background: #EEF2FF;
  color: #3730A3 !important;
  border: 1px solid #C7D2FE;
}
.bu-btn-edit:hover {
  background: #3730A3;
  color: #FFFFFF !important;
}
.bu-btn-del {
  background: #FEF2F2;
  color: #DC2626 !important;
  border: 1px solid #FECACA;
}
.bu-btn-del:hover {
  background: #DC2626;
  color: #FFFFFF !important;
}
</style>
</head>
<body>
<!-- Begin page -->
<div id="wrapper">
  <!-- Top Bar Start -->
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        
        <!-- Executive Header Bar -->
        <div class="row">
          <div class="col-12">
            <div class="bu-admin-header-card">
              <div class="bu-admin-header-title">
                <h4><i class="mdi mdi-comment-account-outline" style="color:var(--bu-gold);"></i> Student &amp; Alumni Testimonials</h4>
                <p>Manage student reviews and alumni success stories displayed in "Voices of Bhabha" on the homepage.</p>
              </div>
              <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                <div class="bu-stat-badge">
                  <i class="mdi mdi-checkbox-marked-circle-outline" style="color:#059669; font-size:18px;"></i>
                  Total Testimonials: <strong><?php echo $totalTestimonials; ?></strong>
                </div>
                <a href="<?php echo PAGE;?>?action=add" class="btn" style="background:#0A1B54; color:#FFFFFF; font-weight:700; border-radius:8px; padding:8px 18px; box-shadow:0 4px 12px rgba(10,27,84,0.2);">
                  <i class="mdi mdi-plus-circle" style="color:#FFC107; font-size:16px; margin-right:4px;"></i> Add Testimonial
                </a>
              </div>
            </div>
          </div>
        </div>

        <?php if(!empty($stat)): ?>
        <div class="row">
          <div class="col-12">
            <?php echo msg($stat); ?>
          </div>
        </div>
        <?php endif; ?>

        <?php
        // ADD or EDIT MODE
        if($action == "edit" || $action == "add"):
            $aryData = array('name' => '', 'designation' => '', 'testimonial' => '', 'image' => '');
            if($action == "edit")
            {
                $db->where('id', $_REQUEST['id']);
                $aryData = $db->getOne(DBTAB);
            }
        ?>
        <div class="row">
          <div class="col-lg-8 offset-lg-2 col-md-12">
            <div class="bu-form-card">
              <div class="bu-form-title">
                <span>
                  <i class="mdi <?php echo ($action == 'edit' ? 'mdi-pencil' : 'mdi-plus-circle'); ?>" style="color:var(--bu-gold); margin-right:8px; font-size:20px;"></i>
                  <?php echo ucfirst($action); ?> Testimonial Record
                </span>
                <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-outline-secondary" style="border-radius:6px;">
                  <i class="mdi mdi-arrow-left"></i> Back to List
                </a>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                
                <div class="row">
                  <div class="col-md-6 form-group mb-3">
                    <label style="font-weight:700; color:var(--bu-navy);"><i class="mdi mdi-account" style="color:var(--bu-gold); margin-right:4px;"></i> Student / Alumni Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Abhishek Kumar, Ankit Sharma" value="<?php echo htmlspecialchars($action == 'edit' ? $aryData['name'] : ($_POST['name'] ?? '')); ?>" style="height:44px; border-radius:8px; border:1px solid #CBD5E1;">
                  </div>
                  
                  <div class="col-md-6 form-group mb-3">
                    <label style="font-weight:700; color:var(--bu-navy);"><i class="mdi mdi-school" style="color:var(--bu-gold); margin-right:4px;"></i> Designation / Program / Role <span class="text-danger">*</span></label>
                    <input type="text" name="designation" class="form-control" required placeholder="e.g. B.Tech-CSE, MBA Student, Assistant Engineer" value="<?php echo htmlspecialchars($action == 'edit' ? $aryData['designation'] : ($_POST['designation'] ?? '')); ?>" style="height:44px; border-radius:8px; border:1px solid #CBD5E1;">
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label style="font-weight:700; color:var(--bu-navy);"><i class="mdi mdi-format-quote-open" style="color:var(--bu-gold); margin-right:4px;"></i> Testimonial Quote / Feedback <span class="text-danger">*</span></label>
                  <textarea name="testimonial" class="form-control" rows="4" required placeholder="Write the student's personal feedback, campus experience, or placement journey..." style="border-radius:8px; border:1px solid #CBD5E1; padding:12px; font-size:13.5px;"><?php echo htmlspecialchars($action == 'edit' ? $aryData['testimonial'] : ($_POST['testimonial'] ?? '')); ?></textarea>
                </div>
                
                <div class="form-group mb-4">
                  <label style="font-weight:700; color:var(--bu-navy);"><i class="mdi mdi-camera" style="color:var(--bu-gold); margin-right:4px;"></i> Student Photo (Avatar)</label>
                  <div class="custom-file" style="margin-bottom:8px;">
                    <input type="file" name="icon" class="custom-file-input" id="studentAvatarInput" accept="image/*" onchange="previewStudentAvatar(this)">
                    <label class="custom-file-label" for="studentAvatarInput" style="border-radius:8px;">Choose Student photo file...</label>
                  </div>
                  <small class="text-muted"><i class="mdi mdi-information-outline"></i> Recommended: Square Photo <strong>150 x 150 px</strong> (JPG, PNG, WEBP).</small>
                  
                  <!-- Live Preview Box -->
                  <div class="bu-avatar-preview-box" id="avatarPreviewContainer">
                    <?php if($action == 'edit' && !empty($aryData['image']) && file_exists(UPLOAD . $aryData['image'])): ?>
                      <div style="font-size:11.5px; font-weight:700; color:var(--bu-navy); margin-bottom:8px;">Current Active Photo:</div>
                      <img src="<?php echo UPLOAD . $aryData['image']; ?>" id="avatarPreviewImg" alt="Student Photo">
                    <?php else: ?>
                      <div id="previewPlaceholder" class="text-muted" style="font-size:12.5px;">
                        <i class="mdi mdi-account-circle-outline" style="font-size:36px; color:#CBD5E1; display:block; margin-bottom:4px;"></i>
                        Photo preview will appear here upon file selection.
                      </div>
                      <img src="" id="avatarPreviewImg" style="display:none;" alt="Student Photo Preview">
                    <?php endif; ?>
                  </div>
                </div>

                <div style="display:flex; gap:12px; justify-content:flex-end;">
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary" style="border-radius:8px; padding:10px 20px; font-weight:600;">Cancel</a>
                  <button type="submit" name="submit" class="btn" style="background:#0A1B54; color:#FFFFFF; font-weight:700; border-radius:8px; padding:10px 24px; box-shadow:0 4px 14px rgba(10,27,84,0.25);">
                    <i class="mdi mdi-check" style="color:#FFC107; margin-right:6px;"></i> Save Testimonial
                  </button>
                </div>

              </form>
            </div>
          </div>
        </div>
        
        <?php
        // VIEW MODE
        elseif($action == "view"):
            $db->where('id', $_REQUEST['id']);
            $aryData = $db->getOne(DBTAB);
            $has_img = !empty($aryData['image']) && file_exists(UPLOAD . $aryData['image']);
        ?>
        <div class="row">
          <div class="col-lg-6 offset-lg-3 col-md-12">
            <div class="bu-form-card text-center">
              <div class="bu-form-title text-left">
                <span><i class="mdi mdi-eye" style="color:var(--bu-gold); margin-right:8px; font-size:20px;"></i> View Testimonial Details</span>
                <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-outline-secondary" style="border-radius:6px;">Back</a>
              </div>

              <div style="padding:20px 0;">
                <div style="width:100px; height:100px; margin:0 auto 16px;">
                  <?php if($has_img): ?>
                    <img src="<?php echo UPLOAD . $aryData['image']; ?>" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid var(--bu-gold); box-shadow:0 6px 18px rgba(0,0,0,0.12);" alt="<?php echo htmlspecialchars($aryData['name']); ?>">
                  <?php else: ?>
                    <div style="width:100px; height:100px; border-radius:50%; background:#0A1B54; color:#fff; display:flex; align-items:center; justify-content:center; font-size:32px; font-weight:800; margin:0 auto;">
                      <?php echo strtoupper(substr($aryData['name'], 0, 1)); ?>
                    </div>
                  <?php endif; ?>
                </div>

                <h3 style="color:var(--bu-navy); font-weight:800; font-size:22px; margin-bottom:4px;"><?php echo htmlspecialchars($aryData['name']); ?></h3>
                <span class="badge badge-pill badge-warning" style="background:#FEF3C7; color:#B45309; font-size:12.5px; font-weight:700; padding:6px 14px; border:1px solid #FDE68A;">
                  <i class="mdi mdi-school mr-1"></i><?php echo htmlspecialchars($aryData['designation']); ?>
                </span>

                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; padding:20px; margin-top:20px; text-align:left; position:relative;">
                  <i class="mdi mdi-format-quote-open" style="font-size:32px; color:#CBD5E1; position:absolute; top:10px; left:12px; opacity:0.5;"></i>
                  <p style="font-size:14px; color:#334155; line-height:1.7; font-style:italic; margin:0; padding-left:24px;">
                    "<?php echo nl2br(htmlspecialchars($aryData['testimonial'])); ?>"
                  </p>
                </div>
              </div>

              <div class="bu-content-divider" style="height:1px; background:#E2E8F0; margin:20px 0;"></div>

              <div style="display:flex; justify-content:center; gap:12px;">
                <a href="<?php echo PAGE; ?>?id=<?php echo $aryData['id']; ?>&action=edit" class="btn btn-primary" style="background:#0A1B54; border:none; border-radius:8px; padding:8px 20px; font-weight:700;">
                  <i class="mdi mdi-pencil" style="color:#FFC107; margin-right:6px;"></i> Edit Testimonial
                </a>
                <a href="<?php echo PAGE; ?>" class="btn btn-secondary" style="border-radius:8px; padding:8px 20px; font-weight:600;">
                  Back to List
                </a>
              </div>
            </div>
          </div>
        </div>

        <?php
        // LIST TABLE MODE
        else:
            $aryData = $db->get(DBTAB);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="bu-table-card">
              <div class="table-responsive">
                <table id="datatable-buttons" class="table bu-table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                    <tr>
                      <th style="width:50px; text-align:center;">#</th>
                      <th style="width:70px; text-align:center;">Photo</th>
                      <th style="width:200px;">Student / Alumni</th>
                      <th style="width:160px;">Program / Role</th>
                      <th>Testimonial Story</th>
                      <th style="width:120px; text-align:center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(is_array($aryData) && count($aryData) > 0):
                        $i = 1;
                        foreach($aryData as $iList):
                            $has_img = !empty($iList['image']) && file_exists(UPLOAD . $iList['image']);
                            $img_src = $has_img ? (UPLOAD . $iList['image']) : '';
                    ?>
                    <tr>
                      <td style="text-align:center; font-weight:700; color:#94A3B8;"><?php echo $i++; ?></td>
                      <td style="text-align:center;">
                        <?php if($has_img): ?>
                          <img src="<?php echo $img_src; ?>" class="bu-user-avatar" alt="<?php echo htmlspecialchars($iList['name']); ?>" title="<?php echo htmlspecialchars($iList['name']); ?>">
                        <?php else: ?>
                          <div class="bu-avatar-placeholder" style="margin:0 auto;" title="<?php echo htmlspecialchars($iList['name']); ?>">
                            <?php echo strtoupper(substr($iList['name'], 0, 1)); ?>
                          </div>
                        <?php endif; ?>
                      </td>
                      <td>
                        <strong style="color:var(--bu-navy); font-size:14.5px;"><?php echo htmlspecialchars($iList['name']); ?></strong>
                        <div style="font-size:11.5px; color:#94A3B8; margin-top:2px;">ID: #<?php echo $iList['id']; ?></div>
                      </td>
                      <td>
                        <span class="badge badge-light" style="background:#FEF3C7; color:#92400E; font-size:12px; font-weight:700; padding:6px 10px; border-radius:6px; border:1px solid #FDE68A;">
                          <i class="mdi mdi-school mr-1" style="font-size:13px;"></i><?php echo htmlspecialchars($iList['designation']); ?>
                        </span>
                      </td>
                      <td>
                        <div class="bu-quote-box" title="<?php echo htmlspecialchars($iList['testimonial']); ?>">
                          "<?php echo htmlspecialchars($iList['testimonial']); ?>"
                        </div>
                      </td>
                      <td style="text-align:center;">
                        <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=view" class="bu-btn-action bu-btn-view" title="View Testimonial">
                          <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=edit" class="bu-btn-action bu-btn-edit" title="Edit Testimonial">
                          <i class="mdi mdi-pencil"></i>
                        </a>
                        <a href="<?php echo PAGE; ?>?id=<?php echo $iList['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete testimonial from <?php echo addslashes($iList['name']); ?>?');" class="bu-btn-action bu-btn-del" title="Delete Testimonial">
                          <i class="mdi mdi-delete"></i>
                        </a>
                      </td>
                    </tr>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <tr>
                      <td colspan="6" style="text-align:center; padding:30px; color:#94A3B8;">
                        <i class="mdi mdi-information-outline" style="font-size:24px; display:block; margin-bottom:8px;"></i>
                        No testimonial records found. Click <strong>"Add Testimonial"</strong> to add your first student story.
                      </td>
                    </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
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
<!-- Buttons examples --> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.buttons.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script> 
<!-- Datatable init js --> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.js"></script> 
<script src="<?php echo URL_JS;?>datatables.init.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/jszip.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/pdfmake.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/vfs_fonts.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.html5.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.print.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.colVis.min.js"></script>

<script>
function previewStudentAvatar(input) {
  var file = input.files[0];
  if (file) {
    var label = input.nextElementSibling;
    if (label) { label.innerText = file.name; }
    
    var reader = new FileReader();
    reader.onload = function(e) {
      var img = document.getElementById('avatarPreviewImg');
      var placeholder = document.getElementById('previewPlaceholder');
      if (img) {
        img.src = e.target.result;
        img.style.display = 'inline-block';
      }
      if (placeholder) {
        placeholder.style.display = 'none';
      }
    };
    reader.readAsDataURL(file);
  }
}
</script>
</body>
</html>