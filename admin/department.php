<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'department.php');
define("TITLE", 'Department');
define("DBTAB", 'department');
define("UPLOAD", '../upload/department/');

if (!file_exists(UPLOAD)) {
    @mkdir(UPLOAD, 0777, true);
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

    // 2. Process Why Choose 5 Pillars JSON
    $whyChooseData = [];
    if (!empty($_POST['pillar_title']) && is_array($_POST['pillar_title'])) {
        for ($i = 0; $i < count($_POST['pillar_title']); $i++) {
            $pilTitle = trim($_POST['pillar_title'][$i] ?? '');
            if (!empty($pilTitle)) {
                $points = [];
                $ptTitles = $_POST['pt_title'][$i] ?? [];
                $ptDescs  = $_POST['pt_desc'][$i] ?? [];
                $ptSpan2  = $_POST['pt_span2'][$i] ?? [];

                if (is_array($ptTitles)) {
                    for ($j = 0; $j < count($ptTitles); $j++) {
                        if (!empty($ptTitles[$j]) || !empty($ptDescs[$j])) {
                            $pItem = [
                                'title' => trim($ptTitles[$j] ?? ''),
                                'desc'  => trim($ptDescs[$j] ?? '')
                            ];
                            if (!empty($ptSpan2[$j])) {
                                $pItem['span2'] = true;
                            }
                            $points[] = $pItem;
                        }
                    }
                }

                $whyChooseData[] = [
                    'tab_label'  => trim($_POST['pillar_tab_label'][$i] ?? "0" . ($i + 1) . ". $pilTitle"),
                    'tab_icon'   => trim($_POST['pillar_tab_icon'][$i] ?? 'fa-star'),
                    'badge_pill' => trim($_POST['pillar_badge_pill'][$i] ?? 'Pillar Feature'),
                    'icon'       => trim($_POST['pillar_icon'][$i] ?? 'fa-check-circle'),
                    'icon_class' => trim($_POST['pillar_icon_class'][$i] ?? 'bu-icon-navy'),
                    'accent'     => trim($_POST['pillar_accent'][$i] ?? '#061D7C'),
                    'title'      => $pilTitle,
                    'summary'    => trim($_POST['pillar_summary'][$i] ?? ''),
                    'points'     => $points
                ];
            }
        }
    }

    // 3. Process Graduate Attributes JSON
    $attributesData = [];
    if (!empty($_POST['attr_title']) && is_array($_POST['attr_title'])) {
        for ($i = 0; $i < count($_POST['attr_title']); $i++) {
            $aTitle = trim($_POST['attr_title'][$i] ?? '');
            if (!empty($aTitle)) {
                $attributesData[] = [
                    'num'   => str_pad($i + 1, 2, '0', STR_PAD_LEFT),
                    'icon'  => trim($_POST['attr_icon'][$i] ?? 'fa-check'),
                    'title' => $aTitle,
                    'sub'   => trim($_POST['attr_sub'][$i] ?? '')
                ];
            }
        }
    }

    // Build Master Data Array
    $data = [
        "title"            => trim($_POST['title'] ?? ''),
        "subtitle"         => trim($_POST['subtitle'] ?? ''),
        "icon"             => trim($_POST['icon'] ?? 'fa-university'),
        "description"      => trim($_POST['description'] ?? ''),
        "approval_text"    => trim($_POST['approval_text'] ?? ''),
        "affiliation_text" => trim($_POST['affiliation_text'] ?? ''),
        "about_lead"       => trim($_POST['about_lead'] ?? ''),
        "about_full"       => trim($_POST['about_full'] ?? ''),
        "vision"           => trim($_POST['vision'] ?? ''),
        "mission"          => trim($_POST['mission'] ?? ''),
        "programs_data"    => !empty($programsData) ? json_encode($programsData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        "why_choose_data"  => !empty($whyChooseData) ? json_encode($whyChooseData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        "attributes_data"  => !empty($attributesData) ? json_encode($attributesData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        "status"           => isset($_POST['status']) ? intval($_POST['status']) : 1
    ];

    // Handle Image Upload if any
    if (!empty($_FILES['image']['name'])) {
        $filename = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $newfile = 'dept_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD . $newfile)) {
                $data['image'] = 'upload/department/' . $newfile;
            }
        }
    }

    if ($action == "add" && count($stat) == 0) {
        $id = $db->insert(DBTAB, $data);
        $_SESSION["success"] = 'Department Added Successfully!';
        redirect(PAGE);
    } elseif ($action == "edit" && count($stat) == 0) {
        $db->where('id', intval($_REQUEST['id']));
        $db->update(DBTAB, $data);
        $_SESSION["success"] = 'Department Updated Successfully!';
        redirect(PAGE);
    }
}

// Delete Handler
if ($action == "delete") {
    $db->where('id', intval($_REQUEST['id']));
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Department Successfully Deleted!';
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
/* Custom Modern Department Admin Styling */
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
.bu-pt-item {
    background: #fff;
    border: 1px solid #edf2f7;
    border-radius: 6px;
    padding: 10px;
    margin-bottom: 8px;
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
            $progs   = !empty($aryData['programs_data']) ? json_decode($aryData['programs_data'], true) : [];
            $pillars = !empty($aryData['why_choose_data']) ? json_decode($aryData['why_choose_data'], true) : [];
            $attrs   = !empty($aryData['attributes_data']) ? json_decode($aryData['attributes_data'], true) : [];
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h4 class="mt-0 header-title text-primary"><i class="fa fa-pencil-square-o"></i> <?php echo ucfirst($action);?> <?php echo TITLE; ?>: <strong><?php echo htmlspecialchars($aryData['title'] ?? ''); ?></strong></h4>
                  <a href="<?php echo PAGE;?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Listing</a>
                </div>

                <div><?php echo msg($stat);?></div>

                <form action="" method="post" enctype="multipart/form-data">
                  
                  <!-- Section-wise Navigation Tabs -->
                  <ul class="nav nav-tabs bu-admin-tabs mb-4" id="deptTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#tab-overview" role="tab"><i class="fa fa-university"></i> 1. Overview &amp; Meta</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="vm-tab" data-toggle="tab" href="#tab-vm" role="tab"><i class="fa fa-bullseye"></i> 2. Vision &amp; Mission</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="programs-tab" data-toggle="tab" href="#tab-programs" role="tab"><i class="fa fa-graduation-cap"></i> 3. Programmes &amp; Branches</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="why-tab" data-toggle="tab" href="#tab-why" role="tab"><i class="fa fa-cubes"></i> 4. Why Choose Pillars</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="attrs-tab" data-toggle="tab" href="#tab-attrs" role="tab"><i class="fa fa-list-ol"></i> 5. Graduate Attributes</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="deptTabContent">
                    
                    <!-- ========================================================
                         TAB 1: OVERVIEW & META INFORMATION
                         ======================================================== -->
                    <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Department Title / Name *</label>
                          <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($aryData['title'] ?? $_POST['title'] ?? '');?>"/>
                          <small class="text-muted">e.g. ENGINEERING, PHARMACY, MANAGEMENT</small>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Subtitle / Tagline</label>
                          <input type="text" name="subtitle" class="form-control" value="<?php echo htmlspecialchars($aryData['subtitle'] ?? $_POST['subtitle'] ?? '');?>"/>
                          <small class="text-muted">e.g. Premier Technical &amp; Engineering Education in Central India</small>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">FontAwesome Icon Class</label>
                          <input type="text" name="icon" class="form-control" value="<?php echo htmlspecialchars($aryData['icon'] ?? $_POST['icon'] ?? 'fa-graduation-cap');?>"/>
                          <small class="text-muted">e.g. <code>fa fa-laptop</code>, <code>fa fa-flask</code>, <code>fa fa-cogs</code></small>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Approval Text (e.g. AICTE / PCI / NCTE)</label>
                          <input type="text" name="approval_text" class="form-control" value="<?php echo htmlspecialchars($aryData['approval_text'] ?? $_POST['approval_text'] ?? 'Approved by Statutory Regulatory Authorities');?>"/>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="font-weight-bold">Affiliation Text</label>
                          <input type="text" name="affiliation_text" class="form-control" value="<?php echo htmlspecialchars($aryData['affiliation_text'] ?? $_POST['affiliation_text'] ?? 'Affiliated with Bhabha University, Bhopal');?>"/>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Featured / Hero Lab Image</label>
                          <input type="file" name="image" class="form-control" accept="image/*"/>
                          <?php if (!empty($aryData['image'])): ?>
                            <div class="mt-2">
                              <small class="text-muted">Current Image:</small><br>
                              <img src="<?php echo URL_ROOT . $aryData['image'];?>" style="max-height: 80px; border-radius: 6px; border: 1px solid #ccc;">
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
                        <label class="font-weight-bold">Department Overview Summary (Shown on Hero Card)</label>
                        <textarea name="about_lead" class="form-control ckeditor" rows="4"><?php echo htmlspecialchars($aryData['about_lead'] ?? $_POST['about_lead'] ?? '');?></textarea>
                        <small class="text-muted">2-3 clean introductory paragraphs displayed directly in the school overview hero card.</small>
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Full Welcome Message &amp; Pedagogical Philosophy (Shown in Modal Popup)</label>
                        <textarea name="about_full" class="form-control ckeditor" rows="6"><?php echo htmlspecialchars($aryData['about_full'] ?? $_POST['about_full'] ?? '');?></textarea>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 2: VISION & MISSION
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-vm" role="tabpanel">
                      <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> These statements power the executive <strong>Vision &amp; Mission</strong> cards with golden &amp; navy accents.
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold text-primary"><i class="fa fa-eye"></i> Vision Statement</label>
                        <textarea name="vision" class="form-control ckeditor" rows="4" placeholder="Enter Vision statement..."><?php echo htmlspecialchars($aryData['vision'] ?? $_POST['vision'] ?? '');?></textarea>
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold text-danger"><i class="fa fa-bullseye"></i> Mission Statement</label>
                        <textarea name="mission" class="form-control ckeditor" rows="4" placeholder="Enter Mission statement..."><?php echo htmlspecialchars($aryData['mission'] ?? $_POST['mission'] ?? '');?></textarea>
                      </div>
                    </div>

                    <!-- ========================================================
                         TAB 3: PROGRAMMES & SPECIALIZATIONS
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-programs" role="tabpanel">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="text-muted m-0">Manage degrees and specialization branches. These display in a <strong>2-column compact card layout</strong> with inline branch chips.</p>
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
                         TAB 4: WHY CHOOSE BHABHA (5 SHOWCASE PILLARS)
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-why" role="tabpanel">
                      <div class="alert alert-warning">
                        <i class="fa fa-cubes"></i> These 5 cards power the <strong>3D Single-Card Interactive Deck</strong> with tabs, wheel scroll, and step counters.
                      </div>

                      <?php
                      $pillarDefaults = [
                          ["title" => "Faculty & Mentorship", "icon" => "fa-users", "accent" => "#061D7C", "pill" => "Academic Pillar"],
                          ["title" => "Tech & Innovation", "icon" => "fa-microchip", "accent" => "#059669", "pill" => "R&D & Incubation"],
                          ["title" => "Campus Infrastructure", "icon" => "fa-building-o", "accent" => "#D97706", "pill" => "Smart Eco-Campus"],
                          ["title" => "Placements & MoUs", "icon" => "fa-briefcase", "accent" => "#7C3AED", "pill" => "Careers Since 2003"],
                          ["title" => "Social Commitment & Aid", "icon" => "fa-heartbeat", "accent" => "#E11D48", "pill" => "Student Welfare"]
                      ];

                      for ($i = 0; $i < 5; $i++):
                          $pData = $pillars[$i] ?? $pillarDefaults[$i];
                          $pts = $pData['points'] ?? [
                              ["title" => "Highlight 1", "desc" => "Description of point 1."],
                              ["title" => "Highlight 2", "desc" => "Description of point 2."],
                              ["title" => "Highlight 3", "desc" => "Description of point 3."],
                              ["title" => "Highlight 4", "desc" => "Description of point 4."],
                              ["title" => "Key Feature", "desc" => "Comprehensive summary feature point.", "span2" => true]
                          ];
                      ?>
                      <div class="card mb-4 border-primary">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                          <h5 class="m-0 text-primary"><i class="fa <?php echo htmlspecialchars($pData['icon'] ?? 'fa-star');?>"></i> Pillar 0<?php echo $i + 1; ?>: <strong><?php echo htmlspecialchars($pData['title'] ?? '');?></strong></h5>
                          <span class="badge badge-primary">Pillar 0<?php echo $i + 1;?> / 05</span>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-md-4">
                              <label>Pillar Heading *</label>
                              <input type="text" name="pillar_title[]" class="form-control font-weight-bold" required value="<?php echo htmlspecialchars($pData['title'] ?? '');?>"/>
                            </div>
                            <div class="form-group col-md-4">
                              <label>Top Tab Label</label>
                              <input type="text" name="pillar_tab_label[]" class="form-control" value="<?php echo htmlspecialchars($pData['tab_label'] ?? "0" . ($i + 1) . ". " . ($pData['title'] ?? ''));?>"/>
                            </div>
                            <div class="form-group col-md-4">
                              <label>Badge Pill Text</label>
                              <input type="text" name="pillar_badge_pill[]" class="form-control" value="<?php echo htmlspecialchars($pData['badge_pill'] ?? 'Core Feature');?>"/>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-3">
                              <label>Hero Icon Class</label>
                              <input type="text" name="pillar_icon[]" class="form-control" value="<?php echo htmlspecialchars($pData['icon'] ?? 'fa-star');?>"/>
                            </div>
                            <div class="form-group col-md-3">
                              <label>Icon Style Class</label>
                              <select name="pillar_icon_class[]" class="form-control">
                                <option value="bu-icon-navy" <?php if(($pData['icon_class'] ?? '') == 'bu-icon-navy') echo 'selected';?>>Navy Blue</option>
                                <option value="bu-icon-green" <?php if(($pData['icon_class'] ?? '') == 'bu-icon-green') echo 'selected';?>>Emerald Green</option>
                                <option value="bu-icon-amber" <?php if(($pData['icon_class'] ?? '') == 'bu-icon-amber') echo 'selected';?>>Amber Gold</option>
                                <option value="bu-icon-purple" <?php if(($pData['icon_class'] ?? '') == 'bu-icon-purple') echo 'selected';?>>Royal Purple</option>
                                <option value="bu-icon-rose" <?php if(($pData['icon_class'] ?? '') == 'bu-icon-rose') echo 'selected';?>>Rose Red</option>
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label>Accent Hex Color</label>
                              <input type="text" name="pillar_accent[]" class="form-control" value="<?php echo htmlspecialchars($pData['accent'] ?? '#061D7C');?>"/>
                            </div>
                            <div class="form-group col-md-3">
                              <label>Tab Icon</label>
                              <input type="text" name="pillar_tab_icon[]" class="form-control" value="<?php echo htmlspecialchars($pData['tab_icon'] ?? $pData['icon'] ?? 'fa-star');?>"/>
                            </div>
                          </div>

                          <div class="form-group">
                            <label>Left Hero Summary (Description below title)</label>
                            <input type="text" name="pillar_summary[]" class="form-control" value="<?php echo htmlspecialchars($pData['summary'] ?? '');?>"/>
                          </div>

                          <h6 class="font-weight-bold text-secondary mt-3">Right Feature Bullet Chips (Up to 5):</h6>
                          <div class="row">
                            <?php for($k = 0; $k < 5; $k++): 
                                $pt = $pts[$k] ?? ['title' => '', 'desc' => '', 'span2' => ($k == 4)];
                            ?>
                            <div class="<?php echo ($k == 4) ? 'col-12' : 'col-md-6'; ?> mb-2">
                              <div class="bu-pt-item">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <strong class="text-dark small">Point #<?php echo $k + 1;?></strong>
                                  <label class="small m-0 text-muted">
                                    <input type="checkbox" name="pt_span2[<?php echo $i;?>][<?php echo $k;?>]" value="1" <?php if(!empty($pt['span2'])) echo 'checked';?>> Full Width (Span 2)
                                  </label>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <input type="text" name="pt_title[<?php echo $i;?>][]" class="form-control form-control-sm" placeholder="Point Title" value="<?php echo htmlspecialchars($pt['title'] ?? '');?>"/>
                                  </div>
                                  <div class="col-md-7">
                                    <input type="text" name="pt_desc[<?php echo $i;?>][]" class="form-control form-control-sm" placeholder="Point Description..." value="<?php echo htmlspecialchars($pt['desc'] ?? '');?>"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php endfor; ?>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>

                    <!-- ========================================================
                         TAB 5: GRADUATE ATTRIBUTES (12 COMPETENCY CARDS)
                         ======================================================== -->
                    <div class="tab-pane fade" id="tab-attrs" role="tabpanel">
                      <div class="alert alert-success">
                        <i class="fa fa-list-ol"></i> Manage the <strong>12 Graduate Learning Outcomes</strong> displayed in a 4x3 symmetrical grid.
                      </div>

                      <div class="row">
                        <?php
                        $attrDefaults = [
                            ["num" => "01", "icon" => "fa-book", "title" => "Strong Knowledge Base", "sub" => "Mastery of fundamental engineering & scientific principles."],
                            ["num" => "02", "icon" => "fa-cogs", "title" => "Specialisation Expertise", "sub" => "In-depth branch competence in specialized domains."],
                            ["num" => "03", "icon" => "fa-lightbulb-o", "title" => "Problem Solving Skills", "sub" => "Critical thinking, algorithmic models & logical analysis."],
                            ["num" => "04", "icon" => "fa-search", "title" => "Problem Investigation", "sub" => "Research-based laboratory experiments & data synthesis."],
                            ["num" => "05", "icon" => "fa-wrench", "title" => "Designing Solutions", "sub" => "Engineering feasible prototypes & industrial solutions."],
                            ["num" => "06", "icon" => "fa-laptop", "title" => "Modern Tools & Software", "sub" => "Proficiency in CAD, simulation, coding & computational tools."],
                            ["num" => "07", "icon" => "fa-users", "title" => "Collaborative Teamwork", "sub" => "Multidisciplinary synergy, leadership & team spirit."],
                            ["num" => "08", "icon" => "fa-comments-o", "title" => "Communication Skills", "sub" => "Effective technical reporting & persuasive presentations."],
                            ["num" => "09", "icon" => "fa-shield", "title" => "Professional Standards", "sub" => "High conduct, accountability & global compliance."],
                            ["num" => "10", "icon" => "fa-leaf", "title" => "Environment & Society", "sub" => "Sustainable, eco-conscious engineering development."],
                            ["num" => "11", "icon" => "fa-balance-scale", "title" => "Ethical Values & Integrity", "sub" => "Unwavering moral principles & social commitment."],
                            ["num" => "12", "icon" => "fa-refresh", "title" => "Lifelong Learning", "sub" => "Continuous self-development & technological agility."]
                        ];

                        for ($m = 0; $m < 12; $m++):
                            $att = $attrs[$m] ?? $attrDefaults[$m];
                        ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                          <div class="bu-card-repeater p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                              <span class="badge badge-secondary font-weight-bold">Attribute #<?php echo str_pad($m + 1, 2, '0', STR_PAD_LEFT);?></span>
                              <div class="input-group input-group-sm" style="width: 140px;">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-flag"></i></span></div>
                                <input type="text" name="attr_icon[]" class="form-control" value="<?php echo htmlspecialchars($att['icon'] ?? 'fa-check');?>" placeholder="Icon"/>
                              </div>
                            </div>
                            <div class="form-group mb-2">
                              <label class="small font-weight-bold mb-1">Title</label>
                              <input type="text" name="attr_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($att['title'] ?? '');?>"/>
                            </div>
                            <div class="form-group mb-0">
                              <label class="small text-muted mb-1">Outcome Subtitle</label>
                              <input type="text" name="attr_sub[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($att['sub'] ?? '');?>"/>
                            </div>
                          </div>
                        </div>
                        <?php endfor; ?>
                      </div>
                    </div>

                  </div> <!-- End Tab Content -->

                  <hr class="mt-4 mb-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <input type="submit" value="Save &amp; Update Department" name="submit" class="btn btn-success btn-lg px-4"/>
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
        <!-- Department Listing Table -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="mt-0 header-title text-primary"><i class="fa fa-university"></i> All Departments</h4>
                  <a class="btn btn-primary" href="<?php echo PAGE;?>?action=add"><i class="fa fa-plus"></i> Add New Department</a>
                </div>

                <div><?php echo msg($stat);?></div>

                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <?php
                    $aryData = $db->get(DBTAB);
                    if (is_array($aryData) && count($aryData) > 0) {
                    ?>
                    <thead class="thead-dark">
                      <tr>
                        <th style="width:50px;">ID</th>
                        <th>Icon</th>
                        <th>Department Title</th>
                        <th>Subtitle</th>
                        <th>Status</th>
                        <th style="width:140px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      foreach($aryData as $iList): 
                        $rawIcon = !empty($iList['icon']) ? trim($iList['icon']) : 'fa-university';
                        if(strpos($rawIcon, 'fa ') !== 0 && strpos($rawIcon, 'fa-') === 0) {
                            $iconClass = 'fa ' . $rawIcon;
                        } elseif(strpos($rawIcon, 'fa ') !== 0 && strpos($rawIcon, 'fa-') !== 0 && strpos($rawIcon, 'icon-') === false) {
                            $iconClass = 'fa fa-' . $rawIcon;
                        } else {
                            $iconClass = $rawIcon;
                        }
                      ?>
                      <tr>
                        <td><strong>#<?php echo $iList['id'];?></strong></td>
                        <td class="text-center">
                          <div style="width: 40px; height: 40px; background: rgba(6, 29, 124, 0.08); border: 1px solid rgba(6, 29, 124, 0.15); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color: #061D7C; font-size: 18px;">
                            <i class="<?php echo htmlspecialchars($iconClass);?>"></i>
                          </div>
                        </td>
                        <td>
                          <strong><?php echo ucfirst($iList['title']);?></strong>
                          <br>
                          <a href="<?php echo URL_ROOT;?>department.php?id=<?php echo $iList['id'];?>" target="_blank" class="small text-info"><i class="fa fa-external-link"></i> View Public Page</a>
                        </td>
                        <td><small class="text-muted"><?php echo htmlspecialchars($iList['subtitle'] ?? '');?></small></td>
                        <td>
                          <?php if($iList['status'] == 1): ?>
                            <span class="badge badge-success px-2 py-1">Active</span>
                          <?php else: ?>
                            <span class="badge badge-secondary px-2 py-1">Inactive</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=edit" class="btn btn-sm btn-info" title="Edit Department Sections"><i class="fa fa-edit"></i> Edit</a>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete" onclick="return confirm('Are you sure you want to delete this department?');" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <?php } else { ?>
                    <tbody>
                      <tr><td colspan="6" class="text-center">No Department Records Found.</td></tr>
                    </tbody>
                    <?php } ?>
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

<!-- Department Admin Interactivity Script -->
<script>
$(document).ready(function() {
    // 1. Rock-solid Tab Switching
    $('#deptTab .nav-link').on('click', function(e) {
        e.preventDefault();
        var targetPaneId = $(this).attr('href');
        
        // Remove active class from all tabs & add to clicked tab
        $('#deptTab .nav-link').removeClass('active');
        $(this).addClass('active');
        
        // Hide all panes & show target pane
        $('#deptTabContent > .tab-pane').removeClass('show active').css('display', 'none');
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
    if (initialHash && $('#deptTab .nav-link[href="' + initialHash + '"]').length > 0) {
        $('#deptTab .nav-link[href="' + initialHash + '"]').trigger('click');
    } else {
        $('#deptTabContent > .tab-pane').removeClass('show active').css('display', 'none');
        $('#tab-overview').addClass('show active').css('display', 'block');
        $('#deptTab .nav-link[href="#tab-overview"]').addClass('active');
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

    // 3. Program Repeater Dynamic Controls
    $('#btnAddProgram').on('click', function() {
        var count = $('#programsContainer .prog-card-item').length + 1;
        var html = `
        <div class="bu-card-repeater prog-card-item">
          <div class="bu-repeater-header">
            <span class="bu-badge-counter">Program #<span class="prog-index">${count}</span></span>
            <button type="button" class="btn btn-danger btn-sm btn-remove-prog" title="Remove Program"><i class="fa fa-trash"></i> Remove</button>
          </div>
          <div class="row">
            <div class="form-group col-md-5">
              <label>Degree / Programme Title *</label>
              <input type="text" name="prog_title[]" class="form-control" required placeholder="e.g. Master of Science (M.Sc.)"/>
            </div>
            <div class="form-group col-md-4">
              <label>Duration &amp; Level Badge</label>
              <input type="text" name="prog_badge[]" class="form-control" placeholder="e.g. 2 Years • PG Degree"/>
            </div>
            <div class="form-group col-md-3">
              <label>Icon Class</label>
              <input type="text" name="prog_icon[]" class="form-control" value="fa-graduation-cap"/>
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
              <textarea name="prog_branches[]" class="form-control" rows="2" placeholder="e.g. Branch A, Branch B, Branch C"></textarea>
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
        $('#programsContainer').append(html);
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
});
</script>
</body>
</html>