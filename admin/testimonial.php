<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
$stat=array();
$action='';
$action=$_GET['action'];
define("PAGE",'testimonial.php');
define("TITLE",'Testimonial');
define("DBTAB",'testimonial');
define("UPLOAD",'../upload/testimonial/');

if($_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if($_SESSION['error']!="")
{
   $stat['error']=$_SESSION['error'];
	unset($_SESSION['error']);
}
if(isset($_POST['submit']))
{
	if($_FILES['icon']['name'] != '')
		{
			$filename = basename($_FILES['icon']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','gif')))
			{
				$stat["error"] = "Only JPG, GIF & PNG images are allowed.";
			}
		}
	if($_REQUEST['action']=="add" && count($stat) == 0)	
	{
		$data = Array(
					"name" => $_POST['name'],
					"designation" => $_POST['designation'],
					"testimonial" => $_POST['testimonial']
					 );
					 if(isset($_FILES['icon']) && count($_FILES['icon']['name']) > 0 && $_FILES['icon']['name'] != '')
					{
						$file_ext = end(explode('.', strtolower($_FILES['icon']['name'])));
						$newfile=md5(microtime()).".".$file_ext;
						echo $_FILES['icon']['tmp_name'],UPLOAD.$newfile;
						if(move_uploaded_file($_FILES['icon']['tmp_name'],UPLOAD.$newfile));
						{
							$data['image'] = $newfile;
						}
					resizeBySize($newfile,150,150,UPLOAD,false);
					}
					$id = $db->insert(DBTAB,$data);
					unset($_POST);
					unset($_SESSION['form']);
					$_SESSION["success"] = 'Add Successfully';
					redirect(PAGE);
	}
	elseif($_REQUEST['action']=="edit" && count($stat) == 0)	
	{
		$data = Array(
					"name" => $_POST['name'],
					"designation" => $_POST['designation'],
					"testimonial" => $_POST['testimonial']
					 );
			 if($_FILES['icon']['name'] != '')
				{
				$db->where('id',$_REQUEST['id']);
				$aryData = $db->getOne(DBTAB);
			
				unlink(UPLOAD.$aryData['image']."");
				$file_ext = end(explode('.', strtolower($_FILES['icon']['name'])));
				$newfile=md5(microtime()).".".$file_ext;
				if(move_uploaded_file($_FILES['icon']['tmp_name'],UPLOAD.$newfile));
				{
					$data['image'] = $newfile;
				}
				resizeBySize($newfile,150,150,UPLOAD,false);
					}
					$db->where('id',$_REQUEST['id']);
					$aryData = $db->update(DBTAB,$data);
					unset($_POST);
					unset($_SESSION['form']);
					$_SESSION["success"] = 'Edit Successfully';
					redirect(PAGE);
			}
}
if($action=="delete")
{
	$db->where('id',$_REQUEST['id']);
	$aryData = $db->getOne(DBTAB);
	unlink(UPLOAD.$aryData['image']."");
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
<title><?php echo TITLE; ?> Dashboard - Silvery Infotech</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
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
                  <div class="form-group col-xs-12">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"  value="<?php if($action=="edit"){echo $aryData['name'];}else{echo $_POST['name'];}?>"/>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control"  value="<?php if($action=="edit"){echo $aryData['designation'];}else{echo $_POST['designation'];}?>" />
                  </div>
                  <div class="form-group col-xs-12" >
                    <label>Testimonial</label>
                    <textarea name="testimonial" class="form-control" rows="3" ><?php if($action=="edit"){echo $aryData['testimonial'];}else{echo $_POST['testimonial'];}?>
</textarea>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>User Icone</label>
                    <input type="file" name="icon"/>
                    150*150 </div>
                  <input type="submit" value="<?php echo ucfirst($action);?> Data" name="submit" class="btn btn-default"/> <input value="Back" class="btn btn-warning waves-effect waves-light" 
                  name="Back" type="button" onclick="window.location='javascript:history.go(-1)'" />
                </form>
              </div>
            </div>
          </div>
          <!-- end col --></div>
        <?php
		}
		elseif($action=="view")
		{
			$db->where('id',$_REQUEST['id']);
			$aryData = $db->getOne(DBTAB);
			?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <h4 class="mt-0 header-title"><?php echo ucfirst($action);?> <?php echo TITLE; ?></h4>
                <br>
              <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>

                  <div class="form-group col-xs-12">
                    <label>Name : </label>
                    <?php echo $aryData['name']?>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>Designation : </label>
                    <?php echo $aryData['designation']?>
                  </div>
                  <div class="form-group col-xs-12" >
                    <label>Testimonial : </label>
                    <?php echo $aryData['testimonial']?>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>User Icone : </label>
                    
                    <img src="<?php echo UPLOAD;?><?php echo $aryData['image']?>" width="100" height="100">
                   
                  </div>
                  <input value="Back" class="btn btn-warning waves-effect waves-light" 
                  name="Back" type="button" onclick="window.location='javascript:history.go(-1)'" />
              </div>
            </div>
          </div>
          <!-- end col --></div>
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
                    <h4 class="mt-0 header-title"><?php echo TITLE; ?></h4>
                  </div>
                  <div class="col-sm-2"> <a class="btn btn-primary" style="float:right" href="<?php echo PAGE;?>?action=add">Add <?php echo TITLE; ?></a> </div>
                </div>
                <br>
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <?php
		$aryData = $db->get(DBTAB);
         if(is_array($aryData) && count($aryData)>0)
          {
  ?>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Testimonial</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
              foreach($aryData as $iList)
              {
                ?>
                      <tr>
                        <td><?php echo ucfirst($iList['name']);?></td>
                        <td><?php echo $iList['designation'];?></td>
                        <td><?php echo $iList['testimonial'];?></td>
                        <td>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=edit" class="btn btn-sm btn-info">Edit</a>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=view" class="btn btn-sm btn-success">View</a>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete" onclick="return deletex();" class="btn btn-sm btn-danger">Delete</a></td>
                      </tr>
                      <?php
              }
              ?>
                      <?php
          }
          else
          {
          ?>
                      <tr>
                        <td colspan="5" class="list-tr">No Records Found.</td>
                      </tr>
                      <?php
          }
          ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- end col --></div>
        <?php 
		}
		?>
        <!-- end row --></div>
      <!-- container-fluid --></div>
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
<!-- Datatable init js --> 
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