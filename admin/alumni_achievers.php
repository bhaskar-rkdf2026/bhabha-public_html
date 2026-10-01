<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = $_GET['action'] ?? '';
define("PAGE", 'alumni_achievers.php');
define("TITLE", 'Distinguished Alumni & Star Achievers');
define("DBTAB", 'alumni_achievers');
define("UPLOAD", '../upload/alumni/');

// Auto-create table if not exists and seed initial data
$db->rawQuery("CREATE TABLE IF NOT EXISTS `alumni_achievers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `highlight` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `orders` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Check if seeding is needed
$existCount = $db->getValue(DBTAB, "count(*)");
if ($existCount == 0) {
    $initial_stories = [
        [
            'name'        => 'Mr. Anurag Kumar',
            'degree'      => 'M.Tech (Thermal Science Engineering) — Batch 2025',
            'badge'       => '₹60.0 LPA Package',
            'highlight'   => 'China Petroleum Pipeline Engineering Co. Ltd. (CPP)',
            'role'        => 'Mechanical Engineer - Lead',
            'description' => 'Secured an international milestone package of 60.0 LPA at China Petroleum Pipeline Engineering Co. Ltd., representing the cutting-edge engineering competence cultivated at Bhabha University.',
            'image'       => 'media/alumni_anurag_kumar_cpp_60lpa.jpg',
            'orders'      => 1,
            'status'      => 1
        ],
        [
            'name'        => 'Harikesh Singh',
            'degree'      => 'M.Tech – VLSI Design (Batch 2023–2025)',
            'badge'       => 'AIR Rank 68 in IES 2025',
            'highlight'   => 'Indian Engineering Services (IES / ESE 2025)',
            'role'        => 'UPSC Engineering Officer',
            'description' => 'Secured an All India Rank 68 in the prestigious Indian Engineering Services 2025, demonstrating top-tier academic dedication, perseverance, and technical excellence.',
            'image'       => 'media/alumni_harikesh_singh_ies_rank68.jpg',
            'orders'      => 2,
            'status'      => 1
        ],
        [
            'name'        => 'Mr. Kamlesh Kumar',
            'degree'      => 'Engineering Alumnus — Bhabha University',
            'badge'       => 'UPSC IES Officer',
            'highlight'   => 'Indian Engineering Services (IES / ESE)',
            'role'        => 'UPSC Engineering Officer',
            'description' => 'Cleared the prestigious Union Public Service Commission (UPSC) Indian Engineering Services examination and selected as an IES Officer in the Government of India.',
            'image'       => 'media/alumni_kamlesh_kumar_ies.jpg',
            'orders'      => 3,
            'status'      => 1
        ],
        [
            'name'        => 'Mr. Anshuman Rajesh Singh',
            'degree'      => 'Engineering Alumnus — Bhabha University',
            'badge'       => 'UPSC IES 2023 Officer',
            'highlight'   => 'Indian Engineering Services (IES / ESE 2023)',
            'role'        => 'UPSC Engineering Officer',
            'description' => 'Successfully cracked the prestigious UPSC Indian Engineering Services (IES 2023) examination and appointed as an Engineering Officer in the Government of India.',
            'image'       => 'media/alumni_anshuman_singh_ies.jpg',
            'orders'      => 4,
            'status'      => 1
        ],
        [
            'name'        => 'Ms. Nidhi Shukla',
            'degree'      => 'Distinguished Alumna — Bhabha University',
            'badge'       => 'Deputy Director, DTE MP',
            'highlight'   => 'Directorate of Technical Education (DTE), Govt. of M.P.',
            'role'        => 'Deputy Director',
            'description' => 'Selected through MPPSC and appointed as Deputy Director at Directorate of Technical Education (DTE), Government of Madhya Pradesh.',
            'image'       => 'media/alumni_nidhi_shukla_dte.jpg',
            'orders'      => 5,
            'status'      => 1
        ],
        [
            'name'        => 'Shubham Kumar Srivastava',
            'degree'      => 'M.Tech (Power Systems - Electrical)',
            'badge'       => '₹12.0 LPA Package',
            'highlight'   => 'National High Speed Rail Corporation Ltd. (NHSRCL)',
            'role'        => 'Junior Technical Manager (Electrical)',
            'description' => 'Selected as Junior Technical Manager (Electrical) for India’s landmark High-Speed Bullet Train project at NHSRCL with an attractive 12 LPA package.',
            'image'       => 'media/alumni_shubham_srivastava_nhsrcl.jpg',
            'orders'      => 6,
            'status'      => 1
        ],
        [
            'name'        => 'Vikash Chandra',
            'degree'      => 'B.Pharm — Bhabha Pharmacy Research Institute (BPRI)',
            'badge'       => 'IIT Kanpur Selection',
            'highlight'   => 'Indian Institute of Technology (IIT) Kanpur',
            'role'        => 'M.Tech (Biomedical Engineering)',
            'description' => 'Achieved direct selection at premier institution IIT Kanpur for postgraduate research and M.Tech in Biomedical Engineering after graduating from BPRI.',
            'image'       => 'media/alumni_vikash_chandra_iit_kanpur.jpg',
            'orders'      => 7,
            'status'      => 1
        ],
        [
            'name'        => 'Mr. Rakesh Kumar Roy',
            'degree'      => 'B.Tech – Civil Engineering (Batch 2025)',
            'badge'       => '₹7.44 LPA Package',
            'highlight'   => 'Dhariwal Buildtech Limited (DBL)',
            'role'        => 'Material Engineer',
            'description' => 'Selected as Material Engineer at leading infrastructure conglomerate Dhariwal Buildtech Limited (DBL) with a commendable annual CTC of 7.44 LPA.',
            'image'       => 'media/alumni_rakesh_roy_dhariwal.jpg',
            'orders'      => 8,
            'status'      => 1
        ]
    ];
    foreach ($initial_stories as $st) {
        $db->insert(DBTAB, $st);
    }
}

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Handle Form Submission
if (isset($_POST['submit']) || (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['name']) || isset($_POST['badge'])))) {
    if (!empty($_FILES['icon']['name'])) {
        $filename = basename($_FILES['icon']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($ext, array('jpeg', 'jpg', 'png', 'gif', 'webp', 'svg'))) {
            $stat["error"] = "Only JPG, PNG, WEBP, GIF & SVG images are allowed.";
        }
    }

    if ($action == "add" && count($stat) == 0) {
        $data = array(
            "name"        => trim($_POST['name'] ?? ''),
            "degree"      => trim($_POST['degree'] ?? ''),
            "badge"       => trim($_POST['badge'] ?? ''),
            "highlight"   => trim($_POST['highlight'] ?? ''),
            "role"        => trim($_POST['role'] ?? ''),
            "description" => trim($_POST['description'] ?? ''),
            "orders"      => !empty($_POST['orders']) ? (int)$_POST['orders'] : 0,
            "status"      => isset($_POST['status']) ? (int)$_POST['status'] : 1
        );

        if (!empty($_FILES['icon']['name'])) {
            if (!is_dir(UPLOAD)) {
                @mkdir(UPLOAD, 0777, true);
            }
            $file_ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
            $newfile = 'alumni_' . md5(microtime(true) . rand(100, 999)) . "." . $file_ext;
            if (move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile)) {
                $data['image'] = $newfile;
            }
        }

        $id = $db->insert(DBTAB, $data);
        if ($id) {
            unset($_POST);
            $_SESSION["success"] = 'Distinguished Alumni / Star Achiever added successfully!';
            redirect(PAGE);
        } else {
            $stat['error'] = 'Database insertion failed. Please try again.';
        }
    } elseif ($action == "edit" && count($stat) == 0 && !empty($_REQUEST['id'])) {
        $edit_id = (int)$_REQUEST['id'];
        $data = array(
            "name"        => trim($_POST['name'] ?? ''),
            "degree"      => trim($_POST['degree'] ?? ''),
            "badge"       => trim($_POST['badge'] ?? ''),
            "highlight"   => trim($_POST['highlight'] ?? ''),
            "role"        => trim($_POST['role'] ?? ''),
            "description" => trim($_POST['description'] ?? ''),
            "orders"      => !empty($_POST['orders']) ? (int)$_POST['orders'] : 0,
            "status"      => isset($_POST['status']) ? (int)$_POST['status'] : 1
        );

        if (!empty($_FILES['icon']['name'])) {
            $db->where('id', $edit_id);
            $aryData = $db->getOne(DBTAB);
            if (!empty($aryData['image'])) {
                if (file_exists(UPLOAD . $aryData['image'])) {
                    @unlink(UPLOAD . $aryData['image']);
                } elseif (file_exists('../upload/' . $aryData['image'])) {
                    @unlink('../upload/' . $aryData['image']);
                }
            }

            if (!is_dir(UPLOAD)) {
                @mkdir(UPLOAD, 0777, true);
            }
            $file_ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
            $newfile = 'alumni_' . md5(microtime(true) . rand(100, 999)) . "." . $file_ext;
            if (move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD . $newfile)) {
                $data['image'] = $newfile;
            }
        }

        $db->where('id', $edit_id);
        $db->update(DBTAB, $data);
        unset($_POST);
        $_SESSION["success"] = 'Alumni details updated successfully!';
        redirect(PAGE);
    }
}

// Delete Handler
if ($action == "delete" && !empty($_REQUEST['id'])) {
    $del_id = (int)$_REQUEST['id'];
    $db->where('id', $del_id);
    $aryData = $db->getOne(DBTAB);
    if (!empty($aryData['image'])) {
        if (file_exists(UPLOAD . $aryData['image'])) {
            @unlink(UPLOAD . $aryData['image']);
        } elseif (file_exists('../upload/' . $aryData['image'])) {
            @unlink('../upload/' . $aryData['image']);
        }
    }
    $db->where('id', $del_id);
    $db->delete(DBTAB);
    $_SESSION["success"] = 'Alumni record deleted successfully!';
    redirect(PAGE);
}

// Status Toggle Handler
if ($action == "toggle_status" && !empty($_REQUEST['id'])) {
    $toggle_id = (int)$_REQUEST['id'];
    $db->where('id', $toggle_id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $newStat = ($curr['status'] == 1) ? 0 : 1;
        $db->where('id', $toggle_id);
        $db->update(DBTAB, ['status' => $newStat]);
        $_SESSION["success"] = 'Alumni display status updated!';
    }
    redirect(PAGE);
}

// Stats for KPI Cards
$totalAchievers = $db->getValue(DBTAB, "count(*)");
$activeAchievers = $db->where('status', 1)->getValue(DBTAB, "count(*)");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Admin Dashboard</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>

<style>
/* ============================================================
   EXECUTIVE ALUMNI ACHIEVERS MANAGEMENT STYLES
   ============================================================ */
:root {
  --adm-navy: #0A1B54;
  --adm-navy-light: #162B75;
  --adm-gold: #FFC107;
  --adm-gold-dark: #D99B00;
  --adm-gold-light: #FFF8E1;
  --adm-bg: #F8FAFC;
  --adm-border: #E2E8F0;
  --adm-text-dark: #1E293B;
  --adm-text-muted: #64748B;
}

.adm-page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 24px;
  padding-top: 10px;
}

.adm-page-title-group h4 {
  font-size: 20px;
  font-weight: 800;
  color: var(--adm-navy);
  margin: 0 0 4px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.adm-page-title-group p {
  font-size: 13px;
  color: var(--adm-text-muted);
  margin: 0;
}

.adm-header-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.adm-btn-primary {
  background: var(--adm-navy) !important;
  color: #FFFFFF !important;
  border: none !important;
  padding: 10px 20px !important;
  font-size: 13.5px !important;
  font-weight: 700 !important;
  border-radius: 8px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  box-shadow: 0 4px 14px rgba(10, 27, 84, 0.2) !important;
  transition: all 0.25s ease !important;
  text-decoration: none !important;
}

.adm-btn-primary:hover {
  background: var(--adm-navy-light) !important;
  color: var(--adm-gold) !important;
  transform: translateY(-2px);
}

.adm-btn-secondary {
  background: #FFFFFF !important;
  color: var(--adm-navy) !important;
  border: 1px solid var(--adm-border) !important;
  padding: 10px 18px !important;
  font-size: 13.5px !important;
  font-weight: 700 !important;
  border-radius: 8px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  transition: all 0.2s ease !important;
  text-decoration: none !important;
}

.adm-btn-secondary:hover {
  background: #F1F5F9 !important;
  color: var(--adm-navy) !important;
}

/* KPI Grid */
.adm-kpi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-bottom: 24px;
}

.adm-kpi-card {
  background: #FFFFFF;
  border: 1px solid var(--adm-border);
  border-radius: 12px;
  padding: 18px 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}

.adm-kpi-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: #EEF2FF;
  color: var(--adm-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}

.adm-kpi-info h5 {
  font-size: 22px;
  font-weight: 800;
  color: var(--adm-navy);
  margin: 0;
  line-height: 1.2;
}

.adm-kpi-info span {
  font-size: 12px;
  font-weight: 600;
  color: var(--adm-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Card */
.adm-card {
  background: #FFFFFF;
  border: 1px solid var(--adm-border);
  border-radius: 14px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.04);
  margin-bottom: 30px;
  overflow: hidden;
}

.adm-card-header {
  padding: 18px 24px;
  background: #FFFFFF;
  border-bottom: 1px solid var(--adm-border);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
}

.adm-card-header h5 {
  font-size: 16px;
  font-weight: 700;
  color: var(--adm-navy);
  margin: 0;
}

.adm-card-body {
  padding: 24px;
}

/* Styled Table */
#datatable-alumni {
  width: 100% !important;
  border-collapse: collapse !important;
}

#datatable-alumni thead th {
  background: #0A1B54 !important;
  color: #FFFFFF !important;
  font-weight: 700 !important;
  font-size: 13px !important;
  padding: 12px 16px !important;
  border: none !important;
  vertical-align: middle !important;
}

#datatable-alumni tbody td {
  padding: 14px 16px !important;
  vertical-align: middle !important;
  font-size: 13.5px !important;
  color: #1E293B !important;
  border-bottom: 1px solid #F1F5F9 !important;
}

#datatable-alumni tbody tr:hover {
  background: #F8FAFC !important;
}

/* Poster Thumbnail Preview */
.adm-poster-thumb {
  width: 70px;
  height: 70px;
  object-fit: contain;
  background: #F8FAFC;
  border-radius: 8px;
  border: 1px solid #CBD5E1;
  padding: 3px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.06);
  cursor: pointer;
  transition: transform 0.2s;
}

.adm-poster-thumb:hover {
  transform: scale(1.15);
  box-shadow: 0 6px 16px rgba(10,27,84,0.15);
}

.adm-badge-gold {
  background: linear-gradient(135deg, rgba(255, 193, 7, 0.2) 0%, rgba(217, 155, 0, 0.15) 100%);
  color: #8A5D00;
  border: 1px solid rgba(217, 155, 0, 0.4);
  font-weight: 700;
  font-size: 11.5px;
  padding: 4px 10px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

/* Action Buttons */
.adm-action-btns {
  display: flex;
  align-items: center;
  gap: 6px;
}

.adm-btn-edit {
  background: #EFF6FF;
  color: #1D4ED8 !important;
  border: 1px solid #BFDBFE;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: all 0.2s;
  text-decoration: none !important;
}

.adm-btn-edit:hover {
  background: #1D4ED8;
  color: #FFFFFF !important;
}

.adm-btn-del {
  background: #FEF2F2;
  color: #DC2626 !important;
  border: 1px solid #FECACA;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: all 0.2s;
  text-decoration: none !important;
}

.adm-btn-del:hover {
  background: #DC2626;
  color: #FFFFFF !important;
}

/* Styled Form */
.adm-form-group {
  margin-bottom: 20px;
}

.adm-form-group label {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--adm-navy);
  margin-bottom: 6px;
  display: block;
}

.adm-form-control {
  width: 100%;
  height: 44px;
  padding: 10px 14px;
  font-size: 13.5px;
  border: 1px solid #CBD5E1;
  border-radius: 8px;
  background: #FFFFFF;
  color: #0F172A;
  outline: none;
  transition: all 0.2s;
}

.adm-form-control:focus {
  border-color: var(--adm-navy);
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.1);
}

.adm-file-upload-box {
  border: 2px dashed #CBD5E1;
  border-radius: 10px;
  padding: 20px;
  background: #F8FAFC;
  text-align: center;
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
        
        <!-- Header Row -->
        <div class="adm-page-header">
          <div class="adm-page-title-group">
            <h4><i class="fa fa-graduation-cap" style="color:var(--adm-gold);"></i> <?php echo TITLE; ?></h4>
            <p>Manage, add, and publish star alumni posters and success stories displayed on the website.</p>
          </div>
          <div class="adm-header-actions">
            <a href="alumni.php" class="adm-btn-secondary">
              <i class="fa fa-list-alt"></i> View Alumni Form Submissions
            </a>
            <?php if($action != "add" && $action != "edit"): ?>
              <a class="adm-btn-primary" href="<?php echo PAGE;?>?action=add">
                <i class="fa fa-plus-circle"></i> Add Star Achiever / Poster
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Alert Notification -->
        <?php if(!empty($stat)): ?>
          <div style="margin-bottom: 20px;"> <?php echo msg($stat);?></div>
        <?php endif; ?>

        <?php
        if($action=="edit" || $action=="add")
        {
          if($action=="edit" && !empty($_REQUEST['id']))
          {
            $db->where('id', (int)$_REQUEST['id']);
            $aryData = $db->getOne(DBTAB);
          }
        ?>
        <!-- ADD / EDIT FORM CARD -->
        <div class="adm-card">
          <div class="adm-card-header">
            <h5><i class="fa fa-<?php echo ($action=='add') ? 'plus' : 'pencil'; ?>"></i> <?php echo ucfirst($action);?> Distinguished Alumni / Star Achiever</h5>
            <a href="<?php echo PAGE;?>" class="btn btn-sm btn-outline-secondary">
              <i class="fa fa-arrow-left"></i> Back to Achievers List
            </a>
          </div>
          <div class="adm-card-body">
            <form action="" method="post" enctype="multipart/form-data">
              
              <div class="row">
                <!-- Name -->
                <div class="col-md-6">
                  <div class="adm-form-group">
                    <label>Alumni Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="adm-form-control" placeholder="e.g. Mr. Anurag Kumar / Harikesh Singh" value="<?php echo htmlspecialchars($aryData['name'] ?? ($_POST['name'] ?? '')); ?>" required/>
                  </div>
                </div>

                <!-- Degree / Course / Batch -->
                <div class="col-md-6">
                  <div class="adm-form-group">
                    <label>Course / Degree & Batch</label>
                    <input type="text" name="degree" class="adm-form-control" placeholder="e.g. M.Tech (Thermal Science Engineering) — Batch 2025" value="<?php echo htmlspecialchars($aryData['degree'] ?? ($_POST['degree'] ?? '')); ?>"/>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Achievement Badge -->
                <div class="col-md-4">
                  <div class="adm-form-group">
                    <label>Achievement Badge / Package <span class="text-danger">*</span></label>
                    <input type="text" name="badge" class="adm-form-control" placeholder="e.g. ₹60.0 LPA Package / AIR Rank 68 in IES / UPSC IES Officer" value="<?php echo htmlspecialchars($aryData['badge'] ?? ($_POST['badge'] ?? '')); ?>" required/>
                    <small class="text-muted">Highlights package, rank, or premier achievement.</small>
                  </div>
                </div>

                <!-- Company / Organization -->
                <div class="col-md-4">
                  <div class="adm-form-group">
                    <label>Company / Organization / Department</label>
                    <input type="text" name="highlight" class="adm-form-control" placeholder="e.g. China Petroleum Pipeline Eng. (CPP) / IIT Kanpur / DTE MP" value="<?php echo htmlspecialchars($aryData['highlight'] ?? ($_POST['highlight'] ?? '')); ?>"/>
                  </div>
                </div>

                <!-- Role / Designation -->
                <div class="col-md-4">
                  <div class="adm-form-group">
                    <label>Role / Designation / Exam Post</label>
                    <input type="text" name="role" class="adm-form-control" placeholder="e.g. Mechanical Engineer - Lead / UPSC Engineering Officer" value="<?php echo htmlspecialchars($aryData['role'] ?? ($_POST['role'] ?? '')); ?>"/>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Description -->
                <div class="col-md-12">
                  <div class="adm-form-group">
                    <label>Achievement Summary / Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Brief summary of their remarkable accomplishment..."><?php echo htmlspecialchars($aryData['description'] ?? ($_POST['description'] ?? '')); ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Image / Poster Upload -->
                <div class="col-md-6">
                  <div class="adm-form-group">
                    <label>Poster / Photo Image <span class="text-danger">*</span></label>
                    <div class="adm-file-upload-box">
                      <input type="file" name="icon" class="form-control-file" accept="image/*" />
                      <small class="text-muted d-block mt-2">Accepted formats: JPG, PNG, WEBP, GIF. Recommended size: 600x600 px or high quality poster scan.</small>
                    </div>
                  </div>
                </div>

                <!-- Priority & Current Image -->
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="adm-form-group">
                        <label>Display Priority / Order</label>
                        <input type="number" name="orders" class="adm-form-control" placeholder="0" value="<?php echo htmlspecialchars($aryData['orders'] ?? ($_POST['orders'] ?? 0)); ?>"/>
                        <small class="text-muted">Lowest number displays first (1, 2, 3...).</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="adm-form-group">
                        <label>Visibility Status</label>
                        <select name="status" class="adm-form-control">
                          <option value="1" <?php echo (isset($aryData['status']) && $aryData['status'] == 1) ? 'selected' : ''; ?>>Active (Visible on Website)</option>
                          <option value="0" <?php echo (isset($aryData['status']) && $aryData['status'] == 0) ? 'selected' : ''; ?>>Inactive (Hidden)</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <?php 
                  if($action=="edit" && !empty($aryData['image'])): 
                    $currImgUrl = (strpos($aryData['image'], 'media/') !== false) ? URL_ROOT . 'upload/' . $aryData['image'] : URL_ROOT . 'upload/alumni/' . $aryData['image'];
                  ?>
                    <div class="adm-form-group mt-2">
                      <label>Current Poster / Photo:</label>
                      <div>
                        <img src="<?php echo $currImgUrl;?>" style="max-height:110px; border-radius:8px; border:1px solid #CBD5E1; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:4px; background:#fff;">
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" name="submit" value="1" class="adm-btn-primary mr-2">
                  <i class="fa fa-check-circle"></i> <?php echo ($action=='add') ? 'Publish Star Achiever' : 'Save Changes'; ?>
                </button>
                <a href="<?php echo PAGE;?>" class="btn btn-secondary" style="height:44px; display:inline-flex; align-items:center; font-weight:600; border-radius:8px;">
                  Cancel
                </a>
              </div>
            </form>
          </div>
        </div>

        <?php 
        }
        else
        {
        ?>
        <!-- KPI METRICS ROW -->
        <div class="adm-kpi-grid">
          <div class="adm-kpi-card">
            <div class="adm-kpi-icon"><i class="fa fa-trophy"></i></div>
            <div class="adm-kpi-info">
              <h5><?php echo $totalAchievers; ?></h5>
              <span>Total Star Achievers</span>
            </div>
          </div>
          <div class="adm-kpi-card">
            <div class="adm-kpi-icon" style="background:#FEF3C7; color:#B45309;"><i class="fa fa-star"></i></div>
            <div class="adm-kpi-info">
              <h5>₹60.0 LPA</h5>
              <span>Top Milestone Package</span>
            </div>
          </div>
          <div class="adm-kpi-card">
            <div class="adm-kpi-icon" style="background:#ECFDF5; color:#047857;"><i class="fa fa-check-circle"></i></div>
            <div class="adm-kpi-info">
              <h5><?php echo $activeAchievers; ?> Active</h5>
              <span>Live on Alumni Portal</span>
            </div>
          </div>
        </div>

        <!-- LISTING TABLE CARD -->
        <div class="adm-card">
          <div class="adm-card-header">
            <h5><i class="fa fa-star text-warning"></i> Distinguished Alumni Directory (Live Display)</h5>
            <span class="badge badge-info" style="font-size:12.5px; padding:6px 12px;"><?php echo $totalAchievers; ?> Total Achievers</span>
          </div>
          <div class="adm-card-body">
            <div class="table-responsive">
              <table id="datatable-alumni" class="table table-bordered dt-responsive nowrap">
                <?php
                $db->orderBy("orders", "asc");
                $db->orderBy("id", "desc");
                $aryData = $db->get(DBTAB);
                if(is_array($aryData) && count($aryData)>0)
                {
                ?>
                <thead>
                  <tr>
                    <th style="width:60px; text-align:center;">Order</th>
                    <th style="width:80px; text-align:center;">Poster</th>
                    <th>Alumni Name & Degree</th>
                    <th>Achievement Badge</th>
                    <th>Organization / Role</th>
                    <th style="width:90px; text-align:center;">Status</th>
                    <th style="width:140px; text-align:center;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($aryData as $iList)
                  {
                    $imgUrl = '';
                    if(!empty($iList['image'])) {
                      if(strpos($iList['image'], 'media/') !== false) {
                        $imgUrl = URL_ROOT . 'upload/' . $iList['image'];
                      } else {
                        $imgUrl = URL_ROOT . 'upload/alumni/' . $iList['image'];
                      }
                    }
                  ?>
                  <tr>
                    <!-- Order -->
                    <td style="text-align:center;">
                      <span class="badge badge-light" style="font-size:12px; font-weight:700; border:1px solid #CBD5E1;"><?php echo $iList['orders'];?></span>
                    </td>

                    <!-- Thumbnail Poster -->
                    <td style="text-align:center;">
                      <?php if(!empty($imgUrl)): ?>
                        <a href="<?php echo $imgUrl; ?>" target="_blank" title="Click to view full poster">
                          <img src="<?php echo $imgUrl;?>" class="adm-poster-thumb" alt="Poster preview" onerror="this.src='<?php echo URL_ROOT;?>upload/media/alumni_anurag_kumar_cpp_60lpa.jpg'">
                        </a>
                      <?php else: ?>
                        <span class="text-muted" style="font-size:12px;">No Image</span>
                      <?php endif; ?>
                    </td>

                    <!-- Name & Degree -->
                    <td>
                      <strong style="color:var(--adm-navy); font-size:14.5px; display:block;"><?php echo htmlspecialchars($iList['name']);?></strong>
                      <span class="text-muted" style="font-size:12px;"><?php echo htmlspecialchars($iList['degree'] ?? '-');?></span>
                    </td>

                    <!-- Badge -->
                    <td>
                      <span class="adm-badge-gold">
                        <i class="fa fa-trophy"></i> <?php echo htmlspecialchars($iList['badge'] ?? '-');?>
                      </span>
                    </td>

                    <!-- Organization & Role -->
                    <td>
                      <div style="font-weight:600; font-size:13px; color:#1E293B;"><?php echo htmlspecialchars($iList['highlight'] ?? '-'); ?></div>
                      <div style="font-size:12px; color:#64748B;"><?php echo htmlspecialchars($iList['role'] ?? ''); ?></div>
                    </td>

                    <!-- Status -->
                    <td style="text-align:center;">
                      <?php if($iList['status'] == 1): ?>
                        <a href="<?php echo PAGE;?>?id=<?php echo $iList['id'];?>&action=toggle_status" class="badge badge-success" style="padding:5px 10px; cursor:pointer;" title="Click to hide">
                          <i class="fa fa-eye"></i> Active
                        </a>
                      <?php else: ?>
                        <a href="<?php echo PAGE;?>?id=<?php echo $iList['id'];?>&action=toggle_status" class="badge badge-secondary" style="padding:5px 10px; cursor:pointer;" title="Click to make visible">
                          <i class="fa fa-eye-slash"></i> Inactive
                        </a>
                      <?php endif; ?>
                    </td>

                    <!-- Action Buttons -->
                    <td style="text-align:center;">
                      <div class="adm-action-btns" style="justify-content:center;">
                        <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=edit" class="adm-btn-edit" title="Edit Alumni">
                          <i class="fa fa-pencil"></i> Edit
                        </a> 
                        <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete" onclick="return confirm('Are you sure you want to permanently delete this alumni poster?');" class="adm-btn-del" title="Delete Alumni">
                          <i class="fa fa-trash"></i> Delete
                        </a>
                      </div>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <?php
                }
                else
                {
                ?>
                <tbody>
                  <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No alumni achiever records found. Click "Add Star Achiever / Poster" to add one.</td>
                  </tr>
                </tbody>
                <?php
                }
                ?>
              </table>
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

<!-- Required datatable js --> 
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.buttons.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/jszip.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/pdfmake.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/vfs_fonts.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.html5.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.print.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.colVis.min.js"></script>
<script>
$(document).ready(function() {
  $('#datatable-alumni').DataTable({
    order: [[0, 'asc']],
    lengthChange: true,
    pageLength: 25,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search star achievers..."
    },
    buttons: [
      { extend: 'copy', className: 'btn btn-sm btn-outline-secondary' },
      { extend: 'excel', className: 'btn btn-sm btn-outline-secondary' },
      { extend: 'pdf', className: 'btn btn-sm btn-outline-secondary' },
      { extend: 'colvis', className: 'btn btn-sm btn-outline-secondary' }
    ]
  }).buttons().container().appendTo('#datatable-alumni_wrapper .col-md-6:eq(0)');
});
</script>
</body>
</html>
