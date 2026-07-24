<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
$stat=array();
$action='';
$action=$_GET['action'];
define("PAGE",'admission.php');
define("TITLE",'Admission');
define("DBTAB",'admission');

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
<title><?php echo TITLE; ?>Dashboard - Silvery Infotech</title>
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
        if($action=="view")
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
                  <?php echo $aryData['name']?> </div>
                <div class="form-group col-xs-12">
                  <label>Father Name : </label>
                  <?php echo $aryData['fname']?> </div>
                <div class="form-group col-xs-12" >
                  <label>Mother Name : </label>
                  <?php echo $aryData['mother']?> </div>
                <div class="form-group col-xs-12" >
                  <label>Father Occupation : </label>
                  <?php echo $aryData['occupation']?> </div>
                <div class="form-group col-xs-12" >
                  <label>Gender : </label>
                  <?php echo $aryData['gender']?> </div>
                <div class="form-group col-xs-12" >
                  <label>Mobile Number: </label>
                  <?php echo $aryData['mobile']?> </div>
                <div class="form-group col-xs-12">
                  <label>Permanent Address : </label>
                  <?php echo $aryData['permanent_address']?> </div>
                <div class="form-group col-xs-12">
                  <label>Present Address : </label>
                  <?php echo $aryData['present_address']?> </div>
                <div class="form-group col-xs-12">
                  <label>Phone Number: </label>
                  <?php echo $aryData['phone']?> </div>
                <div class="form-group col-xs-12">
                  <label>Email : </label>
                  <?php echo $aryData['email']?> </div>
                <div class="form-group col-xs-12">
                  <label>Nationality : </label>
                  <?php echo $aryData['nationality']?> </div>
                <div class="form-group col-xs-12">
                  <label>Religion : </label>
                  <?php echo $aryData['religion']?> </div>
                <div class="form-group col-xs-12">
                  <label>Domicile : </label>
                  <?php echo $aryData['domicile']?> </div>
                <div class="form-group col-xs-12">
                  <label>Aadhar Number : </label>
                  <?php echo $aryData['aadhar']?> </div>
                <div class="form-group col-xs-12">
                  <label>Category : </label>
                  <?php echo $aryData['category']?> </div>
                <div class="form-group col-xs-12">
                  <label>Domicile : </label>
                  <?php echo $aryData['domicile_c']?> </div>
                <div class="form-group col-xs-12">
                  <label>Income : </label>
                  <?php echo $aryData['income_c']?> </div>
                <div class="form-group col-xs-12">
                  <label>Category : </label>
                  <?php echo $aryData['category_c']?> </div>
                <div class="form-group col-xs-12">
                  <label>Course : </label>
                  <?php 
				  $db->where('id',$aryData['course']);
					$course = $db->getOne('course');
				   ?>
                  <?php echo $course['course']?> </div>
                <div class="form-group col-xs-12">
                  <label>Branch : </label>
                  <?php echo $aryData['branch']?> </div>
                <div class="form-group col-xs-12">
                  <label>High School : </label>
                  <?php echo $aryData['high_school']?> </div>
                <div class="form-group col-xs-12">
                  <label>higher_secondary : </label>
                  <?php echo $aryData['higher_secondary']?> </div>
                <div class="form-group col-xs-12">
                  <label>graduation : </label>
                  <?php echo $aryData['graduation']?> </div>
                <div class="form-group col-xs-12">
                  <label>pgraduation : </label>
                  <?php echo $aryData['pgraduation']?> </div>
                <div class="form-group col-xs-12">
                  <label> Whether participated in National/State level sports, please give details : </label>
                  <?php echo $aryData['sports']?> </div>
                <div class="form-group col-xs-12">
                  <label> Details of Extra/Co curricular Activities : </label>
                  <?php echo $aryData['activities']?> </div>
                <div class="form-group col-xs-12">
                  <label>Someone studying in this University?</label>
                  <?php echo $aryData['studying']?> </div>
                <div class="form-group col-xs-12">
                  <label>Know About Us : </label>
                  <?php echo $aryData['know-about']?> </div>
                <div class="form-group col-xs-12">
                  <label>Payment : </label>
                  <?php echo $aryData['payment']?> </div>
                <div class="form-group col-xs-12">
                  <label>Reference One : </label>
                  <?php echo $aryData['reference_one']?> </div>
                <div class="form-group col-xs-12">
                  <label>References Two : </label>
                  <?php echo $aryData['references_two']?> </div>
                
                
                <div class="form-group col-xs-12">
                  <label>Domicile Certificate Number : </label>
                  <?php echo $aryData['domicile_number']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Domicile Certificate Issue Date : </label>
                  <?php echo $aryData['domicile_issue_date']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Domicile Certificate : </label>
                  
                   <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['upload_domicile']?>">View</a><div class="form-group col-xs-12">
                   </div>
                 
                  <label>Caste Certificate Number : </label>
                  <?php echo $aryData['caste_number']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Caste Certificate Issue Date : </label>
                  <?php echo $aryData['caste_issue_date']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Caste Certificate: </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['upload_caste']?>">View</a> </div>
                  <div class="form-group col-xs-12">
                  <label>Income Certificate Number : </label>
                  <?php echo $aryData['income_number']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Income Certificate Issue Date : </label>
                  <?php echo $aryData['income_issue_date']?> </div>
                
                
                <div class="form-group col-xs-12">
                  <label>Income Certificate : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['upload_income']?>">View</a> </div>
                  <div class="form-group col-xs-12">
                  <label>High School Certificate Number : </label>
                  <?php echo $aryData['high_school_number']?> </div>
                  <div class="form-group col-xs-12">
                  <label>High School Rollnumber : </label>
                  <?php echo $aryData['high_school_rollnumber']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Upload High School : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['upload_high_school']?>">View</a> </div>
                  <div class="form-group col-xs-12">
                  <label>Higher School Certificate Number : </label>
                  <?php echo $aryData['higher_school_number']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Higher School Rollnumber : </label>
                  <?php echo $aryData['higher_school_rollnumber']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Higher School Certificate : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['upload_higher_school']?>">View</a> </div>
                  <div class="form-group col-xs-12">
                  <label>Graduation Certificate Number : </label>
                  <?php echo $aryData['g_cnumber']?> </div>
                  <div class="form-group col-xs-12">
                  <label>Graduation Rollnumber : </label>
                  <?php echo $aryData['g_rollnumber']?> </div>
                   <div class="form-group col-xs-12">
                  <label>Graduation Certificate : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['uploadg']?>">View</a> </div>
                   <div class="form-group col-xs-12">
                  <label>PG Certificate Number : </label>
                  <?php echo $aryData['pg_cnumber']?> </div>
                   <div class="form-group col-xs-12">
                  <label>PG Roll Number : </label>
                  <?php echo $aryData['pg_rollnumber']?> </div>
                   <div class="form-group col-xs-12">
                  <label>PG Certificate : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['uploadpg']?>">View</a> </div>
                   <div class="form-group col-xs-12">
                  <label>Aadhar Card : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['aadhar_card']?>">View</a></div>
                   <div class="form-group col-xs-12">
                  <label>Photo : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['photo']?>">View</a> </div>
                   <div class="form-group col-xs-12">
                  <label>Other : </label>
                  <a target="_blank" href="<?php echo URL_ROOT?>admission/<?php echo $aryData['otherdocx']?>">View</a> </div>
                <input value="Back" class="btn btn-warning waves-effect waves-light" 
                  name="Back" type="button" onclick="window.location='javascript:history.go(-1)'" />
              </div>
            </div>
          </div>
          <!-- end col --></div>
        <?php
		}
		else
		{?>
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
                        <th>Phone</th>
                        <th>Date</th>
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
                        <td><?php echo $iList['phone'];?></td>
                        <td><?php echo $iList['date'];?></td>
                        <td><a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=view" class="btn btn-sm btn-success">View</a> <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete"  class="btn btn-sm btn-danger">Delete</a></td>
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
        <?php } ?>
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