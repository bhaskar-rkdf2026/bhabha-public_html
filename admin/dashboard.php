<?php include_once("config.php");
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Admin Dashboard</title>
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
              <h4 class="page-title">Dashboard : <strong>Admin</strong></h4>
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">Welcome to <strong>Bhabha University Bhopal Madhya Pradesh</strong> Dashboard</li>
              </ol>
              
            </div>
          </div>
        </div>
        <!-- end row -->
       </div>
      <!-- container-fluid --></div>
    <!-- content -->
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
</body>
</html>