<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
$stat=array();
$action='';
$action=$_GET['action'] ?? '';
define("PAGE",'news.php');
define("TITLE",'News & Press Coverage');
define("DBTAB",'news');
define("UPLOAD",'../upload/news/');

if(isset($_SESSION['success']) && $_SESSION['success']!="")
{
    $stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_SESSION['error']) && $_SESSION['error']!="")
{
    $stat['error']=$_SESSION['error'];
	unset($_SESSION['error']);
}

if(isset($_POST['submit']))
{
	if(!empty($_FILES['icon']['name']))
	{
		$filename = basename($_FILES['icon']['name']);
		$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
		if($ext != '' && !in_array($ext,array('jpeg','jpg','png','gif','webp')))
		{
			$stat["error"] = "Only JPG, PNG, WEBP & GIF images are allowed.";
		}
	}
	if($_REQUEST['action']=="add" && count($stat) == 0)	
	{ 	
		$data = Array(
			"title" => $_POST['title'] ?? '',
			"news_date" => !empty($_POST['news_date']) ? $_POST['news_date'] : date('Y-m-d'),
			"orders" => !empty($_POST['orders']) ? (int)$_POST['orders'] : 0
		);
		if(!empty($_FILES['icon']['name']))
		{
			$file_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
			$newfile = md5(microtime()).".".$file_ext;
			if(move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD.$newfile))
			{
				$data['image'] = $newfile;
				if(file_exists(UPLOAD.$newfile)) {
					@copy(UPLOAD.$newfile, UPLOAD."large/".$newfile);
					if(function_exists('resizeBySize')) {
						resizeBySize($newfile, 750, 400, UPLOAD."large/", false);
					}
					@copy(UPLOAD.$newfile, UPLOAD."thumb/".$newfile);
					if(function_exists('resizeBySize')) {
						resizeBySize($newfile, 325, 200, UPLOAD."thumb/", false);
					}
				}
			}
		}
		$id = $db->insert(DBTAB,$data);
		unset($_POST);
		unset($_SESSION['form']);
		$_SESSION["success"] = 'News Item Added Successfully';
		redirect(PAGE);
	}
	elseif($_REQUEST['action']=="edit" && count($stat) == 0)	
	{
		$data = Array(
			"title" => $_POST['title'] ?? '',
			"news_date" => !empty($_POST['news_date']) ? $_POST['news_date'] : date('Y-m-d'),
			"orders" => !empty($_POST['orders']) ? (int)$_POST['orders'] : 0
		);
		if(!empty($_FILES['icon']['name']))
		{
			$db->where('id',$_REQUEST['id']);
			$aryData = $db->getOne(DBTAB);
			if(!empty($aryData['image'])) {
				if(file_exists(UPLOAD.$aryData['image'])) @unlink(UPLOAD.$aryData['image']);
				if(file_exists(UPLOAD."thumb/".$aryData['image'])) @unlink(UPLOAD."thumb/".$aryData['image']);
				if(file_exists(UPLOAD."large/".$aryData['image'])) @unlink(UPLOAD."large/".$aryData['image']);
			}
			
			$file_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
			$newfile = md5(microtime()).".".$file_ext;
			if(move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD.$newfile))
			{
				$data['image'] = $newfile;
				if(file_exists(UPLOAD.$newfile)) {
					@copy(UPLOAD.$newfile, UPLOAD."large/".$newfile);
					if(function_exists('resizeBySize')) {
						resizeBySize($newfile, 750, 400, UPLOAD."large/", false);
					}
					@copy(UPLOAD.$newfile, UPLOAD."thumb/".$newfile);
					if(function_exists('resizeBySize')) {
						resizeBySize($newfile, 325, 200, UPLOAD."thumb/", false);
					}
				}
			}
		}
		$db->where('id',$_REQUEST['id']);
		$aryData = $db->update(DBTAB,$data);
		unset($_POST);
		unset($_SESSION['form']);
		$_SESSION["success"] = 'News Item Updated Successfully';
		redirect(PAGE);
	}
}

if($action=="delete")
{
	$db->where('id',$_REQUEST['id']);
	$aryData = $db->getOne(DBTAB);
	if(!empty($aryData['image'])) {
		if(file_exists(UPLOAD.$aryData['image'])) @unlink(UPLOAD.$aryData['image']);
		if(file_exists(UPLOAD."thumb/".$aryData['image'])) @unlink(UPLOAD."thumb/".$aryData['image']);
		if(file_exists(UPLOAD."large/".$aryData['image'])) @unlink(UPLOAD."large/".$aryData['image']);
	}
	$db->where('id',$_REQUEST['id']);
	$db->delete(DBTAB);
	$_SESSION["success"] = 'News Item Deleted Successfully';
	redirect(PAGE);	
}

// KPI Stats
$totalNewsRes = $db->rawQuery("SELECT COUNT(*) as total FROM `news`");
$totalNews = $totalNewsRes[0]['total'] ?? 0;
$year2026Res = $db->rawQuery("SELECT COUNT(*) as total FROM `news` WHERE YEAR(news_date) = 2026");
$year2026Count = $year2026Res[0]['total'] ?? 0;
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
   MODERN ADMIN NEWS MANAGEMENT STYLES
   ============================================================ */
:root {
  --adm-navy: #0A1B54;
  --adm-gold: #FFC107;
  --adm-gold-dark: #D99B00;
  --adm-bg: #F8FAFC;
  --adm-border: #E2E8F0;
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
  color: #64748B;
  margin: 0;
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
  background: #162B75 !important;
  color: var(--adm-gold) !important;
  transform: translateY(-2px);
}

/* KPI Summary Cards */
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
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}

.adm-kpi-icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  background: #EEF2FF;
  color: var(--adm-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
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
  color: #64748B;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Table Card */
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

/* Styled DataTable */
#datatable-news {
  width: 100% !important;
  border-collapse: collapse !important;
}

#datatable-news thead th {
  background: #0A1B54 !important;
  color: #FFFFFF !important;
  font-weight: 700 !important;
  font-size: 13px !important;
  padding: 12px 16px !important;
  border: none !important;
  vertical-align: middle !important;
  letter-spacing: 0.3px;
}

#datatable-news tbody td {
  padding: 14px 16px !important;
  vertical-align: middle !important;
  font-size: 13.5px !important;
  color: #1E293B !important;
  border-bottom: 1px solid #F1F5F9 !important;
}

#datatable-news tbody tr:hover {
  background: #F8FAFC !important;
}

/* Badges */
.adm-date-badge {
  background: #EEF2FF;
  color: #1E40AF;
  border: 1px solid #C7D2FE;
  font-size: 12px;
  font-weight: 700;
  padding: 5px 12px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  white-space: nowrap;
}

.adm-thumb-preview {
  width: 65px;
  height: 65px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 2px 6px rgba(0,0,0,0.06);
  cursor: pointer;
  transition: transform 0.2s;
}

.adm-thumb-preview:hover {
  transform: scale(1.1);
}

/* Action Buttons */
.adm-action-btns {
  display: flex;
  align-items: center;
  gap: 8px;
}

.adm-btn-edit {
  background: #EFF6FF;
  color: #1D4ED8 !important;
  border: 1px solid #BFDBFE;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 12.5px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 5px;
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
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 12.5px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 5px;
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
  margin-bottom: 8px;
  display: block;
}

.adm-form-control {
  width: 100%;
  height: 46px;
  padding: 10px 16px;
  font-size: 14px;
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
<!-- Begin page -->
<div id="wrapper"><!-- Top Bar Start -->
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page"><!-- Start content -->
    <div class="content">
      <div class="container-fluid">
        
        <!-- Header Row -->
        <div class="adm-page-header">
          <div class="adm-page-title-group">
            <h4><i class="fa fa-newspaper-o" style="color:var(--adm-gold);"></i> <?php echo TITLE; ?></h4>
            <p>Publish, edit, and organize press releases and newspaper clippings date-wise.</p>
          </div>
          <?php if($action != "add" && $action != "edit"): ?>
            <a class="adm-btn-primary" href="<?php echo PAGE;?>?action=add">
              <i class="fa fa-plus-circle"></i> Add News Clipping
            </a>
          <?php endif; ?>
        </div>

        <!-- Alert Notification -->
        <?php if(!empty($stat)): ?>
          <div style="margin-bottom: 20px;"> <?php echo msg($stat);?></div>
        <?php endif; ?>

        <?php
        if($action=="edit" || $action=="add")
		{
			if($action=="edit")
			{
				$db->where('id',$_REQUEST['id']);
				$aryData = $db->getOne(DBTAB);
			}
		?>
        <!-- ADD / EDIT FORM CARD -->
        <div class="adm-card">
          <div class="adm-card-header">
            <h5><i class="fa fa-<?php echo ($action=='add') ? 'plus' : 'pencil'; ?>"></i> <?php echo ucfirst($action);?> News Clipping</h5>
            <a href="<?php echo PAGE;?>" class="btn btn-sm btn-outline-secondary">
              <i class="fa fa-arrow-left"></i> Back to News List
            </a>
          </div>
          <div class="adm-card-body">
            <form action="" method="post" enctype="multipart/form-data">
              
              <div class="row">
                <!-- Title / Headline -->
                <div class="col-md-8">
                  <div class="adm-form-group">
                    <label>News Headline / Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="adm-form-control" placeholder="Enter headline as appeared in press..." value="<?php if($action=="edit"){echo htmlspecialchars($aryData['title'] ?? '');}else{echo htmlspecialchars($_POST['title'] ?? '');}?>" required/>
                  </div>
                </div>

                <!-- News Date -->
                <div class="col-md-4">
                  <div class="adm-form-group">
                    <label>Published Date <span class="text-danger">*</span></label>
                    <input type="date" name="news_date" class="adm-form-control" value="<?php if($action=="edit"){echo !empty($aryData['news_date']) ? date('Y-m-d', strtotime($aryData['news_date'])) : date('Y-m-d');}else{echo $_POST['news_date'] ?? date('Y-m-d');}?>" required/>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Image Upload -->
                <div class="col-md-8">
                  <div class="adm-form-group">
                    <label>Newspaper Clipping Image <span class="text-danger">*</span></label>
                    <div class="adm-file-upload-box">
                      <input type="file" name="icon" class="form-control-file" accept="image/*" />
                      <small class="text-muted d-block mt-2">Accepted formats: JPG, PNG, WEBP, GIF. Recommended size: 750x400 px or high quality scan.</small>
                    </div>
                  </div>
                </div>

                <!-- Display Order -->
                <div class="col-md-4">
                  <div class="adm-form-group">
                    <label>Display Priority / Order</label>
                    <input type="number" name="orders" class="adm-form-control" placeholder="0" value="<?php if($action=="edit"){echo $aryData['orders'] ?? 0;}else{echo $_POST['orders'] ?? 0;}?>"/>
                    <small class="text-muted">Higher number gets display priority.</small>
                  </div>

                  <?php if($action=="edit" && !empty($aryData['image'])): ?>
                    <div class="adm-form-group mt-3">
                      <label>Current Image:</label>
                      <div>
                        <img src="<?php echo URL_ROOT?>upload/news/<?php echo $aryData['image'];?>" style="max-height:100px; border-radius:8px; border:1px solid #CBD5E1; box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" name="submit" class="adm-btn-primary mr-2">
                  <i class="fa fa-check-circle"></i> <?php echo ($action=='add') ? 'Publish News Clipping' : 'Save Changes'; ?>
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
            <div class="adm-kpi-icon"><i class="fa fa-newspaper-o"></i></div>
            <div class="adm-kpi-info">
              <h5><?php echo $totalNews; ?></h5>
              <span>Total Clippings</span>
            </div>
          </div>
          <div class="adm-kpi-card">
            <div class="adm-kpi-icon" style="background:#FEF3C7; color:#B45309;"><i class="fa fa-calendar-check-o"></i></div>
            <div class="adm-kpi-info">
              <h5><?php echo $year2026Count; ?></h5>
              <span>Year 2026 Clippings</span>
            </div>
          </div>
          <div class="adm-kpi-card">
            <div class="adm-kpi-icon" style="background:#ECFDF5; color:#047857;"><i class="fa fa-sort-amount-desc"></i></div>
            <div class="adm-kpi-info">
              <h5>Latest First</h5>
              <span>Descending Order</span>
            </div>
          </div>
        </div>

        <!-- NEWS LISTING TABLE CARD -->
        <div class="adm-card">
          <div class="adm-card-header">
            <h5><i class="fa fa-list"></i> News Clippings Archive (Descending Order)</h5>
            <span class="badge badge-info" style="font-size:12.5px; padding:6px 12px;"><?php echo $totalNews; ?> Total Records</span>
          </div>
          <div class="adm-card-body">
            <div class="table-responsive">
              <table id="datatable-news" class="table table-bordered dt-responsive nowrap">
                <?php
				$db->orderBy("news_date", "desc");
				$db->orderBy("id", "desc");
				$aryData = $db->get(DBTAB);
                if(is_array($aryData) && count($aryData)>0)
                {
                ?>
                <thead>
                  <tr>
                    <th style="width:130px;">Published Date</th>
                    <th>News Title / Headline</th>
                    <th style="width:70px; text-align:center;">Order</th>
                    <th style="width:90px; text-align:center;">Clipping</th>
                    <th style="width:150px; text-align:center;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($aryData as $iList)
                  {
                    $rawDate = !empty($iList['news_date']) ? $iList['news_date'] : '1970-01-01';
                    $formattedDate = !empty($iList['news_date']) ? date('d M Y', strtotime($iList['news_date'])) : '-';
                    $imgUrl = !empty($iList['image']) ? URL_ROOT . 'upload/news/' . $iList['image'] : '';
                  ?>
                  <tr>
                    <!-- Date Column with ISO order for DataTables -->
                    <td data-order="<?php echo $rawDate;?>">
                      <span class="adm-date-badge">
                        <i class="fa fa-calendar-check-o"></i> <?php echo $formattedDate; ?>
                      </span>
                    </td>

                    <!-- Headline Title -->
                    <td>
                      <strong style="color:var(--adm-navy); font-size:14px;"><?php echo htmlspecialchars($iList['title']);?></strong>
                    </td>

                    <!-- Order -->
                    <td style="text-align:center;">
                      <span class="badge badge-light" style="font-size:12px; font-weight:700; border:1px solid #CBD5E1;"><?php echo $iList['orders'];?></span>
                    </td>

                    <!-- Image Thumbnail -->
                    <td style="text-align:center;">
                      <?php if(!empty($imgUrl)): ?>
                        <a href="<?php echo $imgUrl; ?>" target="_blank" title="Click to view full image">
                          <img src="<?php echo $imgUrl;?>" class="adm-thumb-preview" alt="News thumbnail" onerror="this.src='<?php echo URL_ROOT;?>extra-images/news1.jpg'">
                        </a>
                      <?php else: ?>
                        <span class="text-muted" style="font-size:12px;">No Image</span>
                      <?php endif; ?>
                    </td>

                    <!-- Action Buttons -->
                    <td style="text-align:center;">
                      <div class="adm-action-btns" style="justify-content:center;">
                        <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=edit" class="adm-btn-edit" title="Edit News">
                          <i class="fa fa-pencil"></i> Edit
                        </a> 
                        <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete" onclick="return confirm('Are you sure you want to permanently delete this news clipping?');" class="adm-btn-del" title="Delete News">
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
                    <td colspan="5" class="text-center py-4 text-muted">No news records found. Click "Add News Clipping" to add one.</td>
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

      </div><!-- container-fluid -->
    </div><!-- content -->
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
<script src="<?php echo URL_PLUG;?>datatables/jszip.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/pdfmake.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/vfs_fonts.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.html5.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.print.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.colVis.min.js"></script>
<script>
$(document).ready(function() {
  $('#datatable-news').DataTable({
    order: [[0, 'desc']],
    lengthChange: true,
    pageLength: 25,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search news records..."
    },
    buttons: [
      { extend: 'copy', className: 'btn btn-sm btn-outline-secondary' },
      { extend: 'excel', className: 'btn btn-sm btn-outline-secondary' },
      { extend: 'pdf', className: 'btn btn-sm btn-outline-secondary' },
      { extend: 'colvis', className: 'btn btn-sm btn-outline-secondary' }
    ]
  }).buttons().container().appendTo('#datatable-news_wrapper .col-md-6:eq(0)');
});
</script>
</body>
</html>