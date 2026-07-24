<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
$stat=array();
$action='';
$action=$_GET['action'];
define("PAGE",'inquiry.php');
define("TITLE",'Inquiry');
define("DBTAB",'inquiry');

if($_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if($action=="delete")
{
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
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <h4 class="mt-0 header-title"><?php echo TITLE; ?></h4>
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
            <th>Email</th>
            <th>Mobile</th>
            <th>Subject</th> <th>Message</th>
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
            <td><?php echo $iList['email'];?></td>
            <td><?php echo $iList['mobile'];?></td>
            <td><?php echo $iList['subject'];?></td>
            <td><?php echo $iList['message'];?></td>
            <td>
              <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete"  class="btn btn-sm btn-danger">Delete</a></td>
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