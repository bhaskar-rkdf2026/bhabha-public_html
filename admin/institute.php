<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'institute.php');
define("TITLE", 'Institute');
define("DBTAB", 'institute');
define("UPLOAD_INST", '../upload/institute/');

if (!file_exists(UPLOAD_INST)) {
    @mkdir(UPLOAD_INST, 0777, true);
}

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// POST Save/Update Handler
if (isset($_POST['submit'])) {
    // 1. Process Program Cards JSON
    $programsData = [];
    if (!empty($_POST['prog_title']) && is_array($_POST['prog_title'])) {
        for ($i = 0; $i < count($_POST['prog_title']); $i++) {
            $pTitle = trim($_POST['prog_title'][$i] ?? '');
            if (!empty($pTitle)) {
                $rawBranches = trim($_POST['prog_branches'][$i] ?? '');
                $branchesArr = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $rawBranches)));
                $programsData[] = [
                    'title'           => $pTitle,
                    'badge'           => trim($_POST['prog_badge'][$i] ?? ''),
                    'icon'            => trim($_POST['prog_icon'][$i] ?? 'fa-graduation-cap'),
                    'intro'           => trim($_POST['prog_intro'][$i] ?? ''),
                    'branches_title'  => trim($_POST['prog_branches_title'][$i] ?? 'Specializations:'),
                    'branches'        => array_values($branchesArr),
                    'apply_url'       => trim($_POST['prog_apply_url'][$i] ?? 'admissions.php'),
                    'secondary_url'   => trim($_POST['prog_sec_url'][$i] ?? 'syllabus.php'),
                    'secondary_label' => trim($_POST['prog_sec_label'][$i] ?? 'Syllabus')
                ];
            }
        }
    }

    // 2. Process Activities JSON
    $activitiesData = [];
    if (!empty($_POST['act_title']) && is_array($_POST['act_title'])) {
        for ($i = 0; $i < count($_POST['act_title']); $i++) {
            $aTitle = trim($_POST['act_title'][$i] ?? '');
            if (!empty($aTitle)) {
                $activitiesData[] = [
                    'title'    => $aTitle,
                    'category' => trim($_POST['act_category'][$i] ?? 'Student Life'),
                    'icon'     => trim($_POST['act_icon'][$i] ?? 'fa-check-circle'),
                    'desc'     => trim($_POST['act_desc'][$i] ?? '')
                ];
            }
        }
    }

    // 3. Process Placements Data JSON
    $placementsData = [];
    $rawCompanies = trim($_POST['plc_companies'] ?? '');
    $companiesArr = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $rawCompanies)));
    
    $rawPoints = trim($_POST['plc_points'] ?? '');
    $pointsArr = array_filter(array_map('trim', preg_split('/[\r\n]+/', $rawPoints)));

    $docItems = [];
    if (!empty($_POST['doc_title']) && is_array($_POST['doc_title'])) {
        for ($k = 0; $k < count($_POST['doc_title']); $k++) {
            $dTitle = trim($_POST['doc_title'][$k] ?? '');
            $dUrl   = trim($_POST['doc_url'][$k] ?? '');
            if (!empty($dTitle) && !empty($dUrl)) {
                $docItems[] = [
                    'title' => $dTitle,
                    'url'   => $dUrl,
                    'type'  => trim($_POST['doc_type'][$k] ?? 'PDF Report')
                ];
            }
        }
    }

    $placementsData = [
        'heading'            => trim($_POST['plc_heading'] ?? 'Career & Campus Placements'),
        'tagline'            => trim($_POST['plc_tagline'] ?? 'Where best of recruiters meet the best of students'),
        'intro'              => trim($_POST['plc_intro'] ?? ''),
        'eligibility_points' => array_values($pointsArr),
        'companies'          => array_values($companiesArr),
        'documents'          => $docItems
    ];

    // 4. Process Vision & Mission JSON
    $vPointsArr = array_filter(array_map('trim', preg_split('/[\r\n]+/', trim($_POST['vm_vision_points'] ?? ''))));
    $mPointsArr = array_filter(array_map('trim', preg_split('/[\r\n]+/', trim($_POST['vm_mission_points'] ?? ''))));
    $coreValuesArr = array_filter(array_map('trim', preg_split('/[\r\n,]+/', trim($_POST['vm_core_values'] ?? ''))));

    $visionMissionData = [
        'vision'        => trim($_POST['vm_vision'] ?? ''),
        'vision_points' => array_values($vPointsArr),
        'mission'       => trim($_POST['vm_mission'] ?? ''),
        'mission_points'=> array_values($mPointsArr),
        'core_values'   => array_values($coreValuesArr)
    ];

    // 5. Build Master Data Array
    $data = [
        "department"              => intval($_POST['department'] ?? 0),
        "institute_name"          => trim($_POST['institute_name'] ?? ''),
        "subtitle"                => trim($_POST['subtitle'] ?? ''),
        "icon"                    => trim($_POST['icon'] ?? 'fa-university'),
        "est_year"                => trim($_POST['est_year'] ?? ''),
        "approval_text"           => trim($_POST['approval_text'] ?? ''),
        "affiliation_text"        => trim($_POST['affiliation_text'] ?? ''),
        "about_institute"         => trim($_POST['about_institute'] ?? ''),
        "principal_message"       => trim($_POST['principal_message'] ?? ''),
        "principal_name"          => trim($_POST['principal_name'] ?? ''),
        "principal_designation"   => trim($_POST['principal_designation'] ?? 'Principal / Director'),
        "principal_qualification" => trim($_POST['principal_qualification'] ?? ''),
        "principal_email"         => trim($_POST['principal_email'] ?? ''),
        "principal_phone"         => trim($_POST['principal_phone'] ?? ''),
        "courses"                 => trim($_POST['courses'] ?? ''),
        "branches"                => trim($_POST['branches'] ?? ''),
        "departments"             => trim($_POST['departments'] ?? ''),
        "activities"              => trim($_POST['activities'] ?? ''),
        "placement"               => trim($_POST['placement'] ?? ''),
        "programs_data"           => !empty($programsData) ? json_encode($programsData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        "activities_data"         => !empty($activitiesData) ? json_encode($activitiesData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        "placements_data"         => !empty($placementsData) ? json_encode($placementsData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        "vision_mission_data"     => (!empty($visionMissionData['vision']) || !empty($visionMissionData['mission'])) ? json_encode($visionMissionData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        "status"                  => isset($_POST['status']) ? intval($_POST['status']) : 1
    ];

    // Handle Hero Image Upload
    if (!empty($_FILES['image']['name'])) {
        $filename = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $newfile = 'inst_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_INST . $newfile)) {
                $data['image'] = 'upload/institute/' . $newfile;
            }
        }
    }

    // Handle Principal Image Upload
    if (!empty($_FILES['principal_image']['name'])) {
        $pFilename = basename($_FILES['principal_image']['name']);
        $pExt = strtolower(pathinfo($pFilename, PATHINFO_EXTENSION));
        if (in_array($pExt, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $newPFile = 'prin_' . time() . '_' . rand(100, 999) . '.' . $pExt;
            if (move_uploaded_file($_FILES['principal_image']['tmp_name'], UPLOAD_INST . $newPFile)) {
                $data['principal_image'] = 'upload/institute/' . $newPFile;
            }
        }
    }

    if ($action == "add" && count($stat) == 0) {
        $id = $db->insert(DBTAB, $data);
        $_SESSION["success"] = 'Institute Added Successfully!';
        redirect(PAGE);
    } elseif ($action == "edit" && count($stat) == 0) {
        $db->where('id', intval($_REQUEST['id']));
        $db->update(DBTAB, $data);
        $_SESSION["success"] = 'Institute Updated Successfully!';
        redirect(PAGE);
    }
}

// Delete Handler
if ($action == "delete") {
    $db->where('id', intval($_REQUEST['id']));
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Institute Successfully Deleted!';
    redirect(PAGE);
}
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
/* Custom Modern Institute Admin Styling */
.bu-admin-tabs .nav-link {
    font-weight: 700;
    color: #495057;
    padding: 12px 18px;
    border-radius: 6px 6px 0 0;
    transition: all 0.2s ease;
    cursor: pointer;
}
.bu-admin-tabs .nav-link.active {
    color: #061D7C !important;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff !important;
    border-top: 3px solid #061D7C;
}
.tab-content > .tab-pane {
    display: none;
}
.tab-content > .tab-pane.active {
    display: block !important;
}
.bu-admin-tabs .nav-link i {
    margin-right: 6px;
    color: #f39c12;
}
.bu-card-repeater {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 16px;
    position: relative;
}
.bu-repeater-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e2e8f0;
}
.bu-badge-counter {
    background: #061D7C;
    color: #fff;
    font-size: 11px;
    font-weight: 800;
    padding: 3px 8px;
    border-radius: 12px;
}
.bu-btn-add {
    background: #061D7C;
    color: #fff;
    font-weight: 700;
    border-radius: 5px;
}
.bu-btn-add:hover {
    background: #040F4A;
    color: #fff;
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
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><?php echo TITLE; ?> Management</h4>
            </div>
          </div>
        </div>

        <?php
        if ($action == "edit" || $action == "add") {
            $aryData = [];
            if ($action == "edit") {
                $db->where('id', intval($_REQUEST['id']));
                $aryData = $db->getOne(DBTAB);
            }
            
            // Parse existing JSON blocks
            $progs = !empty($aryData['programs_data']) ? json_decode($aryData['programs_data'], true) : [];
            $acts  = !empty($aryData['activities_data']) ? json_decode($aryData['activities_data'], true) : [];
            $plcs  = !empty($aryData['placements_data']) ? json_decode($aryData['placements_data'], true) : [];
            $vm    = !empty($aryData['vision_mission_data']) ? json_decode($aryData['vision_mission_data'], true) : [];
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h4 class="mt-0 header-title text-primary"><i class="fa fa-pencil-square-o"></i> <?php echo ucfirst($action);?> <?php echo TITLE; ?>: <strong><?php echo htmlspecialchars($aryData['institute_name'] ?? ''); ?></strong></h4>
                  <a href="<?php echo PAGE;?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Listing</a>
                </div>

                <div><?php echo msg($stat);?></div>

                <form action="" method="post" enctype="multipart/form-data">
                  
                  <!-- Section-wise Navigation Tabs -->
                  <ul class="nav nav-tabs bu-admin-tabs mb-4" id="instTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#tab-overview" role="tab"><i class="fa fa-university"></i> 1. Overview &amp; Meta</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="principal-tab" data-toggle="tab" href="#tab-principal" role="tab"><i class="fa fa-user-circle"></i> 2. Leadership &amp; Principal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="vm-tab" data-toggle="tab" href="#tab-vision-mission" role="tab"><i class="fa fa-bullseye"></i> 3. Vision &amp; Mission</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="programs-tab" data-toggle="tab" href="#tab-programs" role="tab"><i class="fa fa-graduation-cap"></i> 4. Programmes &amp; Branches</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="activities-tab" data-toggle="tab" href="#tab-activities" role="tab"><i class="fa fa-futbol-o"></i> 5. Student Activities</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="placements-tab" data-toggle="tab" href="#tab-placements" role="tab"><i class="fa fa-briefcase"></i> 6. Placements &amp; NIRF</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="legacy-tab" data-toggle="tab" href="#tab-legacy" role="tab"><i class="fa fa-code"></i> 7. Legacy HTML</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="instTabContent">
                    
                    <!-- ========================================================
                         TAB 1: OVERVIEW & META INFORMATION
                         ======================================================== -->
                    <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">
                      <div class="row">
                        <div class="form-group col-md-8">
                          <label class="font-weight-bold">Institute Title (Name) *</label>
                          <input type="text" name="institute_name" class="form-control" required value="<?php echo htmlspecialchars($aryData['institute_name'] ?? $_POST['institute_name'] ?? '');?>"/>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Parent Department / Faculty *</label>
                          <select name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <?php
                            $departments = $db->get('department');
                            if (is_array($departments)) {
                                foreach ($departments as $dept) {
                                    $selected = (($aryData['department'] ?? $_POST['department'] ?? '') == $dept['id']) ? 'selected="selected"' : '';
                                    echo "<option value=\"{$dept['id']}\" {$selected}>" . htmlspecialchars($dept['title']) . "</option>";
                                }
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Subtitle / Tagline</label>
                          <input type="text" name="subtitle" class="form-control" value="<?php echo htmlspecialchars($aryData['subtitle'] ?? $_POST['subtitle'] ?? '');?>" placeholder="e.g. Excellence in Technical Education, Research &amp; Innovation"/>
                        </div>
                        <div class="form-group col-md-3">
                          <label class="font-weight-bold">Establishment Year</label>
                          <input type="text" name="est_year" class="form-control" value="<?php echo htmlspecialchars($aryData['est_year'] ?? $_POST['est_year'] ?? 'Est. 2003');?>" placeholder="e.g. Est. 2003"/>
                        </div>
                        <div class="form-group col-md-3">
                          <label class="font-weight-bold">FontAwesome Icon</label>
                          <input type="text" name="icon" class="form-control" value="<?php echo htmlspecialchars($aryData['icon'] ?? $_POST['icon'] ?? 'fa-university');?>" placeholder="e.g. fa-cogs, fa-flask"/>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Approval Text</label>
                          <input type="text" name="approval_text" class="form-control" value="<?php echo htmlspecialchars($aryData['approval_text'] ?? $_POST['approval_text'] ?? 'Approved by AICTE / PCI / UGC & Govt. of MP');?>"/>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Affiliation Text</label>
                          <input type="text" name="affiliation_text" class="form-control" value="<?php echo htmlspecialchars($aryData['affiliation_text'] ?? $_POST['affiliation_text'] ?? 'Constituent Institute of Bhabha University, Bhopal');?>"/>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Featured / Campus Hero Image</label>
                          <input type="file" name="image" class="form-control" accept="image/*"/>
                          <?php if (!empty($aryData['image'])): 
                            $previewImg = (strpos($aryData['image'], 'http') === 0 ? $aryData['image'] : URL_ROOT . $aryData['image']);
                          ?>
                            <div class="mt-2">
                              <small class="text-muted font-weight-bold">Current Featured Image:</small><br>
                              <img src="<?php echo $previewImg;?>" style="max-height: 90px; border-radius: 6px; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-top: 4px;">
                            </div>
                          <?php endif; ?>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Status</label>
                          <div class="mt-2">
                            <label class="switch">
                              <input type="checkbox" name="status" value="1" <?php if(!isset($aryData['status']) || $aryData['status'] == 1){ echo "checked";} ?>>
                              <span class="slider round"></span> Active on Public Website
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">About Institute (Rich Overview Description)</label>
                        <textarea name="about_institute" class="form-control ckeditor" rows="6"><?php echo htmlspecialchars($aryData['about_institute'] ?? $_POST['about_institute'] ?? '');?></textarea>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 2: LEADERSHIP & PRINCIPAL
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-principal" role="tabpanel">
                      <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> Configure the <strong>Principal / Director Leadership Spotlight</strong> card displayed on the institute page.
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Principal / Director Name</label>
                          <input type="text" name="principal_name" class="form-control" value="<?php echo htmlspecialchars($aryData['principal_name'] ?? $_POST['principal_name'] ?? '');?>" placeholder="e.g. Prof. (Dr.) Mohit Gangwar"/>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Designation</label>
                          <input type="text" name="principal_designation" class="form-control" value="<?php echo htmlspecialchars($aryData['principal_designation'] ?? $_POST['principal_designation'] ?? 'Principal / Director');?>"/>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Qualifications / Bio</label>
                          <input type="text" name="principal_qualification" class="form-control" value="<?php echo htmlspecialchars($aryData['principal_qualification'] ?? $_POST['principal_qualification'] ?? '');?>" placeholder="e.g. B.Tech., M.Tech., Ph.D."/>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Principal Photo</label>
                          <input type="file" name="principal_image" class="form-control" accept="image/*"/>
                          <?php if (!empty($aryData['principal_image'])): 
                            $pImg = (strpos($aryData['principal_image'], 'http') === 0 ? $aryData['principal_image'] : URL_ROOT . $aryData['principal_image']);
                          ?>
                            <div class="mt-2">
                              <img src="<?php echo $pImg;?>" style="max-height: 80px; border-radius: 6px; border: 1px solid #ccc;">
                            </div>
                          <?php endif; ?>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Official Email</label>
                          <input type="text" name="principal_email" class="form-control" value="<?php echo htmlspecialchars($aryData['principal_email'] ?? $_POST['principal_email'] ?? '');?>"/>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Office Phone / Contact</label>
                          <input type="text" name="principal_phone" class="form-control" value="<?php echo htmlspecialchars($aryData['principal_phone'] ?? $_POST['principal_phone'] ?? '');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Principal's Welcome Message</label>
                        <textarea name="principal_message" class="form-control ckeditor" rows="6"><?php echo htmlspecialchars($aryData['principal_message'] ?? $_POST['principal_message'] ?? '');?></textarea>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 3: VISION & MISSION
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-vision-mission" role="tabpanel">
                      <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> Configure the institutional <strong>Vision, Mission, and Core Values</strong>. These display as a modern dual-card glassmorphism spotlight on the frontend.
                      </div>
                      
                      <div class="card mb-4 border shadow-sm">
                        <div class="card-header bg-light">
                          <h5 class="mb-0 text-primary"><i class="fa fa-eye"></i> Institutional Vision</h5>
                        </div>
                        <div class="card-body">
                          <div class="form-group">
                            <label class="font-weight-bold">Vision Statement</label>
                            <textarea name="vm_vision" class="form-control" rows="3" placeholder="Enter the primary vision statement for this institute..."><?php echo htmlspecialchars($vm['vision'] ?? $_POST['vm_vision'] ?? '');?></textarea>
                          </div>
                          <div class="form-group mb-0">
                            <label class="font-weight-bold">Vision Key Highlights / Objectives (One per line)</label>
                            <textarea name="vm_vision_points" class="form-control" rows="3" placeholder="Objective 1&#10;Objective 2&#10;Objective 3"><?php 
                              $vPts = $vm['vision_points'] ?? [];
                              echo htmlspecialchars(is_array($vPts) ? implode("\n", $vPts) : ($_POST['vm_vision_points'] ?? ''));
                            ?></textarea>
                            <small class="form-text text-muted">Each new line will be displayed as a distinct checkmark bullet under Vision.</small>
                          </div>
                        </div>
                      </div>

                      <div class="card mb-4 border shadow-sm">
                        <div class="card-header bg-light">
                          <h5 class="mb-0 text-primary"><i class="fa fa-bullseye"></i> Institutional Mission</h5>
                        </div>
                        <div class="card-body">
                          <div class="form-group">
                            <label class="font-weight-bold">Mission Statement</label>
                            <textarea name="vm_mission" class="form-control" rows="3" placeholder="Enter the mission statement for this institute..."><?php echo htmlspecialchars($vm['mission'] ?? $_POST['vm_mission'] ?? '');?></textarea>
                          </div>
                          <div class="form-group mb-0">
                            <label class="font-weight-bold">Mission Action Points / Pillars (One per line)</label>
                            <textarea name="vm_mission_points" class="form-control" rows="4" placeholder="Action point 1&#10;Action point 2&#10;Action point 3"><?php 
                              $mPts = $vm['mission_points'] ?? [];
                              echo htmlspecialchars(is_array($mPts) ? implode("\n", $mPts) : ($_POST['vm_mission_points'] ?? ''));
                            ?></textarea>
                            <small class="form-text text-muted">Each new line will be rendered as a structured mission action pillar.</small>
                          </div>
                        </div>
                      </div>

                      <div class="card mb-3 border shadow-sm">
                        <div class="card-header bg-light">
                          <h5 class="mb-0 text-primary"><i class="fa fa-diamond"></i> Institutional Core Values</h5>
                        </div>
                        <div class="card-body">
                          <div class="form-group mb-0">
                            <label class="font-weight-bold">Core Values (Comma separated or one per line)</label>
                            <input type="text" name="vm_core_values" class="form-control" placeholder="e.g. Academic Excellence, Clinical Acumen, Research & Innovation, Compassion & Ethics" value="<?php 
                              $cVals = $vm['core_values'] ?? [];
                              echo htmlspecialchars(is_array($cVals) ? implode(", ", $cVals) : ($_POST['vm_core_values'] ?? ''));
                            ?>"/>
                            <small class="form-text text-muted">These will be rendered as sleek golden badge pills under the Vision & Mission cards.</small>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 4: PROGRAMMES & SPECIALIZATIONS
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-programs" role="tabpanel">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="text-muted m-0">Manage degrees and specialization branches. These display in a <strong>2-column structured card grid</strong> with branch chips.</p>
                        <button type="button" class="btn btn-sm bu-btn-add" id="btnAddProgram"><i class="fa fa-plus"></i> Add New Program</button>
                      </div>

                      <div id="programsContainer">
                        <?php
                        $progList = (!empty($progs) && is_array($progs)) ? $progs : [
                            [
                                "title" => "Bachelor Degree (UG)",
                                "badge" => "4 Years • Degree",
                                "icon" => "fa-laptop",
                                "intro" => "Undergraduate programme with comprehensive curriculum and lab workshops.",
                                "branches_title" => "Specializations:",
                                "branches" => ["Specialization 1", "Specialization 2"],
                                "apply_url" => "admissions.php",
                                "secondary_url" => "syllabus.php",
                                "secondary_label" => "Syllabus"
                            ]
                        ];
                        foreach($progList as $pIdx => $pItem):
                        ?>
                        <div class="bu-card-repeater prog-card-item">
                          <div class="bu-repeater-header">
                            <span class="bu-badge-counter">Program #<span class="prog-index"><?php echo $pIdx + 1; ?></span></span>
                            <button type="button" class="btn btn-danger btn-sm btn-remove-prog" title="Remove Program"><i class="fa fa-trash"></i> Remove</button>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-5">
                              <label>Degree / Programme Title *</label>
                              <input type="text" name="prog_title[]" class="form-control" required value="<?php echo htmlspecialchars($pItem['title'] ?? '');?>" placeholder="e.g. Bachelor of Technology (B.Tech.)"/>
                            </div>
                            <div class="form-group col-md-4">
                              <label>Duration &amp; Level Badge</label>
                              <input type="text" name="prog_badge[]" class="form-control" value="<?php echo htmlspecialchars($pItem['badge'] ?? '');?>" placeholder="e.g. 4 Years • UG Degree"/>
                            </div>
                            <div class="form-group col-md-3">
                              <label>Icon Class</label>
                              <input type="text" name="prog_icon[]" class="form-control" value="<?php echo htmlspecialchars($pItem['icon'] ?? 'fa-graduation-cap');?>" placeholder="e.g. fa-laptop"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Short Description</label>
                            <input type="text" name="prog_intro[]" class="form-control" value="<?php echo htmlspecialchars($pItem['intro'] ?? '');?>" placeholder="Short overview of the degree programme"/>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label>Specializations Section Title</label>
                              <input type="text" name="prog_branches_title[]" class="form-control" value="<?php echo htmlspecialchars($pItem['branches_title'] ?? 'Specializations:');?>"/>
                            </div>
                            <div class="form-group col-md-8">
                              <label>Specialization Branches (Comma or Newline Separated)</label>
                              <textarea name="prog_branches[]" class="form-control" rows="2" placeholder="e.g. Computer Science (CSE), Civil Engineering, Mechanical Engineering"><?php echo htmlspecialchars(implode(', ', (array)($pItem['branches'] ?? [])));?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label>Apply Button URL</label>
                              <input type="text" name="prog_apply_url[]" class="form-control" value="<?php echo htmlspecialchars($pItem['apply_url'] ?? 'admissions.php');?>"/>
                            </div>
                            <div class="form-group col-md-4">
                              <label>Secondary Button Label</label>
                              <input type="text" name="prog_sec_label[]" class="form-control" value="<?php echo htmlspecialchars($pItem['secondary_label'] ?? 'Syllabus');?>"/>
                            </div>
                            <div class="form-group col-md-4">
                              <label>Secondary Button URL</label>
                              <input type="text" name="prog_sec_url[]" class="form-control" value="<?php echo htmlspecialchars($pItem['secondary_url'] ?? 'syllabus.php');?>"/>
                            </div>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 4: STUDENT ACTIVITIES & CLUBS
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-activities" role="tabpanel">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="text-muted m-0">Manage co-curricular activities, student clubs, and development cells.</p>
                        <button type="button" class="btn btn-sm bu-btn-add" id="btnAddActivity"><i class="fa fa-plus"></i> Add New Activity</button>
                      </div>

                      <div id="activitiesContainer">
                        <?php
                        $actList = (!empty($acts) && is_array($acts)) ? $acts : [
                            ["title" => "Sports & Athletics", "category" => "Fitness", "icon" => "fa-futbol-o", "desc" => "Annual sports meet and athletic competitions."],
                            ["title" => "Community Camps", "category" => "Outreach", "icon" => "fa-users", "desc" => "Social welfare and awareness camps."],
                            ["title" => "Cultural Programs", "category" => "Arts", "icon" => "fa-music", "desc" => "Annual festival, music, drama, and fine arts."],
                            ["title" => "Scientific Programs", "category" => "Tech", "icon" => "fa-flask", "desc" => "Seminars, workshops, and science exhibitions."],
                            ["title" => "NCC & National Service", "category" => "Discipline", "icon" => "fa-shield", "desc" => "National Cadet Corps training and leadership drills."]
                        ];
                        foreach($actList as $aIdx => $aItem):
                        ?>
                        <div class="bu-card-repeater act-card-item">
                          <div class="bu-repeater-header">
                            <span class="bu-badge-counter">Activity #<span class="act-index"><?php echo $aIdx + 1; ?></span></span>
                            <button type="button" class="btn btn-danger btn-sm btn-remove-act" title="Remove Activity"><i class="fa fa-trash"></i> Remove</button>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-5">
                              <label>Activity Title *</label>
                              <input type="text" name="act_title[]" class="form-control" required value="<?php echo htmlspecialchars($aItem['title'] ?? '');?>" placeholder="e.g. Sports &amp; Athletics"/>
                            </div>
                            <div class="form-group col-md-4">
                              <label>Category Tag</label>
                              <input type="text" name="act_category[]" class="form-control" value="<?php echo htmlspecialchars($aItem['category'] ?? 'Student Life');?>" placeholder="e.g. Athletics &amp; Fitness"/>
                            </div>
                            <div class="form-group col-md-3">
                              <label>Icon Class</label>
                              <input type="text" name="act_icon[]" class="form-control" value="<?php echo htmlspecialchars($aItem['icon'] ?? 'fa-check-circle');?>" placeholder="e.g. fa-futbol-o"/>
                            </div>
                          </div>
                          <div class="form-group mb-0">
                            <label>Short Description</label>
                            <input type="text" name="act_desc[]" class="form-control" value="<?php echo htmlspecialchars($aItem['desc'] ?? '');?>" placeholder="Brief description of the activity or initiative"/>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 5: PLACEMENTS & NIRF DOCUMENTS
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-placements" role="tabpanel">
                      <div class="alert alert-primary">
                        <i class="fa fa-briefcase"></i> Manage career placement highlights, recruiter companies, and <strong>NIRF / Statutory PDF Reports</strong>.
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Placement Section Heading</label>
                          <input type="text" name="plc_heading" class="form-control" value="<?php echo htmlspecialchars($plcs['heading'] ?? 'Career &amp; Campus Placements');?>"/>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Tagline / Motto</label>
                          <input type="text" name="plc_tagline" class="form-control" value="<?php echo htmlspecialchars($plcs['tagline'] ?? 'Where best of recruiters meet the best of students');?>"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Placement Cell Overview Introduction</label>
                        <textarea name="plc_intro" class="form-control" rows="3"><?php echo htmlspecialchars($plcs['intro'] ?? '');?></textarea>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Eligibility &amp; Preparation Guidelines (1 per line)</label>
                          <textarea name="plc_points" class="form-control" rows="4" placeholder="Secured good marks&#10;Active in extracurricular activities&#10;Cleared all courses&#10;Attended Personality Development Program"><?php 
                            if (!empty($plcs['eligibility_points']) && is_array($plcs['eligibility_points'])) {
                                echo htmlspecialchars(implode("\n", $plcs['eligibility_points']));
                            }
                          ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Recruiting Companies (Comma or Newline Separated)</label>
                          <textarea name="plc_companies" class="form-control" rows="4" placeholder="HCL Technologies, Tata Sons, Maruti Suzuki, ICICI Prudential, HDFC Bank, Reliance Group"><?php 
                            if (!empty($plcs['companies']) && is_array($plcs['companies'])) {
                                echo htmlspecialchars(implode(", ", $plcs['companies']));
                            }
                          ?></textarea>
                        </div>
                      </div>

                      <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                        <h6 class="font-weight-bold text-primary m-0"><i class="fa fa-file-pdf-o"></i> NIRF &amp; Statutory Report Download Cards</h6>
                        <button type="button" class="btn btn-sm bu-btn-add" id="btnAddDoc"><i class="fa fa-plus"></i> Add Report Document</button>
                      </div>

                      <div id="docsContainer">
                        <?php
                        $docList = (!empty($plcs['documents']) && is_array($plcs['documents'])) ? $plcs['documents'] : [];
                        foreach($docList as $dIdx => $dItem):
                        ?>
                        <div class="bu-card-repeater doc-card-item">
                          <div class="bu-repeater-header">
                            <span class="bu-badge-counter">Document #<span class="doc-index"><?php echo $dIdx + 1; ?></span></span>
                            <button type="button" class="btn btn-danger btn-sm btn-remove-doc" title="Remove Document"><i class="fa fa-trash"></i> Remove</button>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-5">
                              <label>Document / Report Title *</label>
                              <input type="text" name="doc_title[]" class="form-control" required value="<?php echo htmlspecialchars($dItem['title'] ?? '');?>" placeholder="e.g. NIRF BERI Overall 2021"/>
                            </div>
                            <div class="form-group col-md-5">
                              <label>File URL / PDF Link *</label>
                              <input type="text" name="doc_url[]" class="form-control" required value="<?php echo htmlspecialchars($dItem['url'] ?? '');?>" placeholder="e.g. https://www.bhabhauniversity.edu.in/upload/media/xxx.pdf"/>
                            </div>
                            <div class="form-group col-md-2">
                              <label>Badge Type</label>
                              <input type="text" name="doc_type[]" class="form-control" value="<?php echo htmlspecialchars($dItem['type'] ?? 'PDF Report');?>"/>
                            </div>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 6: LEGACY HTML RAW CONTENT
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-legacy" role="tabpanel">
                      <div class="alert alert-secondary">
                        <i class="fa fa-database"></i> These are the original raw HTML fields stored in the database. They remain preserved for full backwards compatibility.
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Courses (Legacy HTML)</label>
                        <textarea name="courses" class="form-control ckeditor" rows="3"><?php echo htmlspecialchars($aryData['courses'] ?? '');?></textarea>
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Branches (Legacy HTML)</label>
                        <textarea name="branches" class="form-control ckeditor" rows="3"><?php echo htmlspecialchars($aryData['branches'] ?? '');?></textarea>
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Departments (Legacy HTML)</label>
                        <textarea name="departments" class="form-control ckeditor" rows="3"><?php echo htmlspecialchars($aryData['departments'] ?? '');?></textarea>
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Activities (Legacy HTML)</label>
                        <textarea name="activities" class="form-control ckeditor" rows="3"><?php echo htmlspecialchars($aryData['activities'] ?? '');?></textarea>
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Placement (Legacy HTML)</label>
                        <textarea name="placement" class="form-control ckeditor" rows="3"><?php echo htmlspecialchars($aryData['placement'] ?? '');?></textarea>
                      </div>
                    </div>

                  </div> <!-- End Tab Content -->

                  <hr class="mt-4 mb-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <input type="submit" value="Save &amp; Update Institute" name="submit" class="btn btn-success btn-lg px-4"/>
                    <a href="<?php echo PAGE;?>" class="btn btn-outline-secondary">Cancel</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <?php
        } else {
        ?>
        <!-- Institute Listing Table -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="mt-0 header-title text-primary"><i class="fa fa-university"></i> All Institutes</h4>
                  <a class="btn btn-primary" href="<?php echo PAGE;?>?action=add"><i class="fa fa-plus"></i> Add New Institute</a>
                </div>

                <div><?php echo msg($stat);?></div>

                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Institute Name</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $aryData = $db->get(DBTAB);
                      if (is_array($aryData) && count($aryData) > 0) {
                          foreach ($aryData as $iList) {
                              $deptTitle = '-';
                              if (!empty($iList['department'])) {
                                  $db->where('id', $iList['department']);
                                  $dRow = $db->getOne('department');
                                  if ($dRow) $deptTitle = $dRow['title'];
                              }
                      ?>
                      <tr>
                        <td><strong>#<?php echo $iList['id'];?></strong></td>
                        <td>
                          <strong><?php echo htmlspecialchars($iList['institute_name']);?></strong>
                          <?php if(!empty($iList['subtitle'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($iList['subtitle']);?></small>
                          <?php endif; ?>
                        </td>
                        <td><span class="badge badge-info"><?php echo htmlspecialchars($deptTitle);?></span></td>
                        <td>
                          <?php if($iList['status'] == 1): ?>
                            <span class="badge badge-success">Active</span>
                          <?php else: ?>
                            <span class="badge badge-danger">Inactive</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=edit" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>  
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete" onclick="return confirm('Are you sure you want to delete this institute?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                      </tr>
                      <?php
                          }
                      } else {
                      ?>
                      <tr>
                        <td colspan="5" class="text-center">No Records Found.</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>

<?php include_once("inc.footer.js.php"); ?>

<!-- DataTables JS -->
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.buttons.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.js"></script> 
<script src="<?php echo URL_JS;?>datatables.init.js"></script> 

<!-- Institute Admin Interactivity Script -->
<script>
$(document).ready(function() {
    // 1. Rock-solid Tab Switching
    $('#instTab .nav-link').on('click', function(e) {
        e.preventDefault();
        var targetPaneId = $(this).attr('href');
        
        // Remove active class from all tabs & add to clicked tab
        $('#instTab .nav-link').removeClass('active');
        $(this).addClass('active');
        
        // Hide all panes & show target pane
        $('#instTabContent > .tab-pane').removeClass('show active').css('display', 'none');
        $(targetPaneId).addClass('show active').css('display', 'block');
        
        // Update browser URL hash without scrolling
        if (history.pushState) {
            history.pushState(null, null, targetPaneId);
        } else {
            location.hash = targetPaneId;
        }
    });

    // 2. Handle URL Hash on Page Load
    var initialHash = window.location.hash;
    if (initialHash && $('#instTab .nav-link[href="' + initialHash + '"]').length > 0) {
        $('#instTab .nav-link[href="' + initialHash + '"]').trigger('click');
    } else {
        $('#instTabContent > .tab-pane').removeClass('show active').css('display', 'none');
        $('#tab-overview').addClass('show active').css('display', 'block');
        $('#instTab .nav-link[href="#tab-overview"]').addClass('active');
    }

    // 3. Ensure CKEditor updates data before Form Submit
    $('form').on('submit', function() {
        if (typeof CKEDITOR !== 'undefined') {
            for (var instanceName in CKEDITOR.instances) {
                if (CKEDITOR.instances[instanceName]) {
                    CKEDITOR.instances[instanceName].updateElement();
                }
            }
        }
    });

    // 4. Add New Program Repeater
    $('#btnAddProgram').on('click', function() {
        var count = $('#programsContainer .prog-card-item').length + 1;
        var tpl = `
        <div class="bu-card-repeater prog-card-item">
          <div class="bu-repeater-header">
            <span class="bu-badge-counter">Program #<span class="prog-index">${count}</span></span>
            <button type="button" class="btn btn-danger btn-sm btn-remove-prog" title="Remove Program"><i class="fa fa-trash"></i> Remove</button>
          </div>
          <div class="row">
            <div class="form-group col-md-5">
              <label>Degree / Programme Title *</label>
              <input type="text" name="prog_title[]" class="form-control" required placeholder="e.g. Master of Technology (M.Tech.)"/>
            </div>
            <div class="form-group col-md-4">
              <label>Duration &amp; Level Badge</label>
              <input type="text" name="prog_badge[]" class="form-control" placeholder="e.g. 2 Years • PG Degree"/>
            </div>
            <div class="form-group col-md-3">
              <label>Icon Class</label>
              <input type="text" name="prog_icon[]" class="form-control" value="fa-graduation-cap" placeholder="e.g. fa-laptop"/>
            </div>
          </div>
          <div class="form-group">
            <label>Short Description</label>
            <input type="text" name="prog_intro[]" class="form-control" placeholder="Short overview of the degree programme"/>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label>Specializations Section Title</label>
              <input type="text" name="prog_branches_title[]" class="form-control" value="Specializations:"/>
            </div>
            <div class="form-group col-md-8">
              <label>Specialization Branches (Comma or Newline Separated)</label>
              <textarea name="prog_branches[]" class="form-control" rows="2" placeholder="e.g. Computer Science (CSE), Thermal Science, Power System"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label>Apply Button URL</label>
              <input type="text" name="prog_apply_url[]" class="form-control" value="admissions.php"/>
            </div>
            <div class="form-group col-md-4">
              <label>Secondary Button Label</label>
              <input type="text" name="prog_sec_label[]" class="form-control" value="Syllabus"/>
            </div>
            <div class="form-group col-md-4">
              <label>Secondary Button URL</label>
              <input type="text" name="prog_sec_url[]" class="form-control" value="syllabus.php"/>
            </div>
          </div>
        </div>`;
        $('#programsContainer').append(tpl);
    });

    $(document).on('click', '.btn-remove-prog', function() {
        if ($('#programsContainer .prog-card-item').length > 1) {
            $(this).closest('.prog-card-item').remove();
            $('#programsContainer .prog-card-item').each(function(idx) {
                $(this).find('.prog-index').text(idx + 1);
            });
        } else {
            alert('At least one program card is required.');
        }
    });

    // 5. Add New Activity Repeater
    $('#btnAddActivity').on('click', function() {
        var count = $('#activitiesContainer .act-card-item').length + 1;
        var tpl = `
        <div class="bu-card-repeater act-card-item">
          <div class="bu-repeater-header">
            <span class="bu-badge-counter">Activity #<span class="act-index">${count}</span></span>
            <button type="button" class="btn btn-danger btn-sm btn-remove-act" title="Remove Activity"><i class="fa fa-trash"></i> Remove</button>
          </div>
          <div class="row">
            <div class="form-group col-md-5">
              <label>Activity Title *</label>
              <input type="text" name="act_title[]" class="form-control" required placeholder="e.g. Industrial Visits"/>
            </div>
            <div class="form-group col-md-4">
              <label>Category Tag</label>
              <input type="text" name="act_category[]" class="form-control" value="Student Life" placeholder="e.g. Industry Exposure"/>
            </div>
            <div class="form-group col-md-3">
              <label>Icon Class</label>
              <input type="text" name="act_icon[]" class="form-control" value="fa-check-circle" placeholder="e.g. fa-industry"/>
            </div>
          </div>
          <div class="form-group mb-0">
            <label>Short Description</label>
            <input type="text" name="act_desc[]" class="form-control" placeholder="Brief description of the activity or initiative"/>
          </div>
        </div>`;
        $('#activitiesContainer').append(tpl);
    });

    $(document).on('click', '.btn-remove-act', function() {
        $(this).closest('.act-card-item').remove();
        $('#activitiesContainer .act-card-item').each(function(idx) {
            $(this).find('.act-index').text(idx + 1);
        });
    });

    // 6. Add Document Repeater
    $('#btnAddDoc').on('click', function() {
        var count = $('#docsContainer .doc-card-item').length + 1;
        var tpl = `
        <div class="bu-card-repeater doc-card-item">
          <div class="bu-repeater-header">
            <span class="bu-badge-counter">Document #<span class="doc-index">${count}</span></span>
            <button type="button" class="btn btn-danger btn-sm btn-remove-doc" title="Remove Document"><i class="fa fa-trash"></i> Remove</button>
          </div>
          <div class="row">
            <div class="form-group col-md-5">
              <label>Document / Report Title *</label>
              <input type="text" name="doc_title[]" class="form-control" required placeholder="e.g. NIRF 2024 Report"/>
            </div>
            <div class="form-group col-md-5">
              <label>File URL / PDF Link *</label>
              <input type="text" name="doc_url[]" class="form-control" required placeholder="e.g. https://www.bhabhauniversity.edu.in/...pdf"/>
            </div>
            <div class="form-group col-md-2">
              <label>Badge Type</label>
              <input type="text" name="doc_type[]" class="form-control" value="PDF Report"/>
            </div>
          </div>
        </div>`;
        $('#docsContainer').append(tpl);
    });

    $(document).on('click', '.btn-remove-doc', function() {
        $(this).closest('.doc-card-item').remove();
        $('#docsContainer .doc-card-item').each(function(idx) {
            $(this).find('.doc-index').text(idx + 1);
        });
    });
});
</script>
</body>
</html>