<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
$stat=array();
$action='';
$action=$_GET['action'] ?? '';
define("PAGE",'leadership.php');
define("TITLE",'Leadership');
define("DBTAB",'leadership');
define("UPLOAD",'../upload/leadership/');

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
	if(isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != '')
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
			"name" => $_POST['name'] ?? '',
			"designation" => $_POST['designation'] ?? '',
			"quote" => $_POST['quote'] ?? '',
			"chips" => $_POST['chips'] ?? '',
			"sort_order" => intval($_POST['sort_order'] ?? 0),
			"about" => $_POST['about'] ?? ''
		);
		if(isset($_FILES['icon']) && !empty($_FILES['icon']['name']))
		{
			$file_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
			$newfile = md5(microtime()).".".$file_ext;
			if(move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD.$newfile))
			{
				$data['image'] = $newfile;
			}
		}
		$id = $db->insert(DBTAB,$data);
		unset($_POST);
		$_SESSION["success"] = 'Added Successfully';
		redirect(PAGE);
	}
	elseif($_REQUEST['action']=="edit" && count($stat) == 0)	
	{
		$data = Array(
			"title" => $_POST['title'] ?? '',
			"name" => $_POST['name'] ?? '',
			"designation" => $_POST['designation'] ?? '',
			"quote" => $_POST['quote'] ?? '',
			"chips" => $_POST['chips'] ?? '',
			"sort_order" => intval($_POST['sort_order'] ?? 0),
			"about" => $_POST['about'] ?? ''
		);
		if(isset($_FILES['icon']) && !empty($_FILES['icon']['name']))
		{
			$db->where('id',$_REQUEST['id']);
			$aryData = $db->getOne(DBTAB);
			if(!empty($aryData['image']) && file_exists(UPLOAD.$aryData['image'])) {
				@unlink(UPLOAD.$aryData['image']);
			}
			$file_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
			$newfile = md5(microtime()).".".$file_ext;
			if(move_uploaded_file($_FILES['icon']['tmp_name'], UPLOAD.$newfile))
			{
				$data['image'] = $newfile;
			}
		}
		$db->where('id',$_REQUEST['id']);
		$db->update(DBTAB,$data);
		unset($_POST);
		$_SESSION["success"] = 'Updated Successfully';
		redirect(PAGE);
	}
}

if($action=="delete")
{
	$db->where('id',$_REQUEST['id']);
	$aryData = $db->getOne(DBTAB);
	if(!empty($aryData['image']) && file_exists(UPLOAD.$aryData['image'])) {
		@unlink(UPLOAD.$aryData['image']);
	}
	$db->where('id',$_REQUEST['id']);
	$db->delete(DBTAB);
	$_SESSION["success"] = 'Successfully Deleted';
	redirect(PAGE);	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?>&nbsp;Dashboard - Silvery Infotech</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body>
<!-- Begin page -->
<div id="wrapper"><!-- Top Bar Start -->
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page"><!-- Start content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><?php echo TITLE; ?> Settings</h4>
            </div>
          </div>
        </div>
        <!-- end row -->
        <?php
        if($action=="edit" || $action=="add")
		{
			if($action=="edit")
			{
				$db->where('id',$_REQUEST['id']);
				$aryData = $db->getOne(DBTAB);
			}
			?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <h4 class="mt-0 header-title"><?php echo ucfirst($action);?> <?php echo TITLE; ?></h4>
                <br>
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Leader Name <span class="text-danger">*</span></label>
                      <input type="text" name="name" class="form-control" required value="<?php if($action=="edit"){echo htmlspecialchars($aryData['name'] ?? '');}else{echo htmlspecialchars($_POST['name'] ?? '');}?>"/>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Title / Category (e.g. Chancellor, Pro Chancellor, Vice Chancellor, CEO, Registrar, Chief Vigilance Officer)</label>
                      <input type="text" name="title" class="form-control" value="<?php if($action=="edit"){echo htmlspecialchars($aryData['title'] ?? '');}else{echo htmlspecialchars($_POST['title'] ?? '');}?>"/>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-8">
                      <label>Designation (e.g. Chancellor, Bhabha University, Bhopal)</label>
                      <input type="text" name="designation" class="form-control" value="<?php if($action=="edit"){echo htmlspecialchars($aryData['designation'] ?? '');}else{echo htmlspecialchars($_POST['designation'] ?? '');}?>"/>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Display Order (1 = Top)</label>
                      <input type="number" name="sort_order" class="form-control" value="<?php if($action=="edit"){echo intval($aryData['sort_order'] ?? 0);}else{echo intval($_POST['sort_order'] ?? 0);}?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Highlight Quote / Key Statement</label>
                    <textarea name="quote" class="form-control" rows="2" placeholder="e.g. Transforming dedicated scholars into decisive professionals equipped for global excellence."><?php if($action=="edit"){echo htmlspecialchars($aryData['quote'] ?? '');}else{echo htmlspecialchars($_POST['quote'] ?? '');}?></textarea>
                  </div>

                  <div class="form-group">
                    <label>Key Focus Chips / Tags (Comma-separated)</label>
                    <input type="text" name="chips" class="form-control" placeholder="e.g. Advanced Methodologies, Functional MOUs, Technical Competence" value="<?php if($action=="edit"){echo htmlspecialchars($aryData['chips'] ?? '');}else{echo htmlspecialchars($_POST['chips'] ?? '');}?>"/>
                  </div>

                  <div class="form-group">
                    <label>About / Message / Bio (Full description)</label>
                    <textarea name="about" id="ck_about" class="form-control ckeditor" rows="6"><?php if($action=="edit"){echo $aryData['about'] ?? '';}else{echo $_POST['about'] ?? '';}?></textarea>
                  </div>

                  <div class="form-group">
                    <label>Leader Photo</label>
                    <input type="file" name="icon" class="form-control"/>
                    <?php if($action=="edit" && !empty($aryData['image']) && file_exists(UPLOAD.$aryData['image'])): ?>
                      <div class="mt-2">
                        <img src="<?php echo UPLOAD.$aryData['image']; ?>" alt="Current Photo" style="max-height:100px; border-radius:6px; border:1px solid #ddd;"/>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="mt-4">
                    <input type="submit" value="<?php echo ucfirst($action);?> Leader" name="submit" class="btn btn-success"/>
                    <input value="Cancel" class="btn btn-secondary waves-effect waves-light" type="button" onclick="window.location='<?php echo PAGE;?>'" />
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- end col -->
        </div>
        <?php
		}
		else
		{
		?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-10">
                    <h4 class="mt-0 header-title"><?php echo TITLE; ?> Management</h4>
                  </div>
                  <div class="col-sm-2"> <a class="btn btn-primary" style="float:right" href="<?php echo PAGE;?>?action=add"><i class="fa fa-plus"></i> Add New Leader</a> </div>
                </div>
                <br>
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <?php
		$aryData = $db->orderBy('sort_order', 'ASC')->get(DBTAB);
        if(is_array($aryData) && count($aryData)>0)
        {
        ?>
                    <thead>
                      <tr>
                        <th width="60">Photo</th>
                        <th>Name</th>
                        <th>Role / Title</th>
                        <th>Designation</th>
                        <th width="80">Order</th>
                        <th width="120">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
              foreach($aryData as $iList)
              {
                ?>
                      <tr>
                        <td>
                          <?php if(!empty($iList['image']) && file_exists(UPLOAD.$iList['image'])): ?>
                            <img src="<?php echo UPLOAD.$iList['image']; ?>" style="width:45px; height:45px; object-fit:cover; border-radius:4px;"/>
                          <?php else: ?>
                            <div style="width:45px; height:45px; background:#eee; display:flex; align-items:center; justify-content:center; border-radius:4px;"><i class="fa fa-user text-muted"></i></div>
                          <?php endif; ?>
                        </td>
                        <td><strong><?php echo htmlspecialchars($iList['name']);?></strong></td>
                        <td><span class="badge badge-info"><?php echo htmlspecialchars($iList['title']);?></span></td>
                        <td><?php echo htmlspecialchars($iList['designation']);?></td>
                        <td><span class="badge badge-secondary"><?php echo intval($iList['sort_order']);?></span></td>
                        <td>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=edit" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>  
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete" onclick="return confirm('Are you sure you want to delete this leader?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                        <td colspan="6" class="text-center py-4">No Leadership records found. Click "Add New Leader" to create one.</td>
                      </tr>
                    </tbody>
                    <?php
          }
          ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- end col -->
        </div>
        <?php 
		}
		?>
        <!-- end row -->
      </div>
      <!-- container-fluid -->
    </div>
    <!-- content -->
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
<script>
if (typeof CKEDITOR !== 'undefined') {
    CKEDITOR.replace('ck_about');
}
</script>
</body>
</html>