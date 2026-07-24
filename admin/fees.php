<?php  
require_once('config.php');
$stat=array();
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
if(isset($_POST['submit']))
{
		foreach($_POST as $field=>$value)
		{
			$data = Array (
				'value' => $value
			);
			$db->where ('field',$field);
			$db->update ('fees', $data);
		}
		$stat['success']='Fees Setting Update';
		
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Fees Setting Dashboard - Silvery Infotech</title>
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
              <h4 class="page-title">Fees Settings</h4>
            </div>
          </div>
        </div>
        <?php
        if(isset($_SESSION['form']))
        {
            $aryForm=$_SESSION['form'];
            unset($_SESSION['form']);
        }
        else
        {
			$db->where('field', Array('about_title','content'), 'IN');
			$aryFormTemp = $db->get('fees');
            if(!is_null($aryFormTemp) && is_array($aryFormTemp) && count($aryFormTemp)>0)
            {
								
                foreach($aryFormTemp as $iFormTemp)
                {
                    $aryForm[$iFormTemp['field']]=$iFormTemp['value'];
                }
            }
        }
        ?>
        <!-- end row -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <h4 class="mt-0 header-title">Fees Settings</h4>
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group col-xs-12">
                    <label>Page Title</label>
                    <input type="text" name="about_title" class="form-control"  value="<?php echo $aryForm['about_title']; ?>" required/>
                  </div>
                  <div class="form-group col-xs-12" >
                    <label>Content</label>
                    <textarea name="content" class="form-control ckeditor" rows="3" ><?php echo $aryForm['content'];?>
</textarea>
                  </div>
                  <button type="submit" name="submit" class="btn btn-default">Update</button>
                </form>
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
</body>
</html>