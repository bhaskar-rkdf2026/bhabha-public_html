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
			$db->update ('settings', $data);
		}
		$stat['success']='Setting Update';
		
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Setting Dashboard - Silvery Infotech</title>
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
              <h4 class="page-title">Account Settings</h4>
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
			$db->where('field', Array('admin_uname','admin_pswd','title','description','keywords','address','phone_one','phone_two','mobile_one','mobile_two','email','facebook','twitter','webmail_link','erp_login','youtube_id'), 'IN');
			$aryFormTemp = $db->get('settings');
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
                <h4 class="mt-0 header-title">Settings</h4>
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label>User Name</label>
                      <input type="text" name="admin_uname" class="form-control"  value="<?php echo $aryForm['admin_uname']; ?>" required/>
                    </div>
                    <div class="col-sm-6">
                      <label>Password</label>
                      <input type="password" name="admin_pswd" class="form-control"  value="<?php echo $aryForm['admin_pswd']; ?>" required/>
                    </div>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>SEO Title</label>
                    <input type="text" name="title" class="form-control"  value="<?php echo $aryForm['title']; ?>" />
                  </div>
                  <div class="form-group col-xs-12">
                    <label>SEO Description</label>
                    <input type="text" name="description" class="form-control"  value="<?php echo $aryForm['description']; ?>" />
                  </div>
                  <div class="form-group col-xs-12">
                    <label>SEO Keywords</label>
                    <input type="text" name="keywords" class="form-control"  value="<?php echo $aryForm['keywords']; ?>" />
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                      <label>Phone Number 1</label>
                      <input type="text" name="phone_one" class="form-control"  value="<?php echo $aryForm['phone_one']; ?>"/>
                    </div>
                    <div class="col-sm-2">
                      <label>Phone Number 2</label>
                      <input type="text" name="phone_two" class="form-control"  value="<?php echo $aryForm['phone_two']; ?>"/>
                    </div>
                    <div class="col-sm-2">
                      <label>Mobile (Inquiry)</label>
                      <input type="text" name="mobile_one" class="form-control"  value="<?php echo $aryForm['mobile_one']; ?>" />
                    </div>
                     <div class="col-sm-2">
                      <label>Mobile (Admission)</label>
                      <input type="text" name="mobile_two" class="form-control"  value="<?php echo $aryForm['mobile_two']; ?>" />
                    </div>
                    <div class="col-sm-4">
                      <label>Email Address</label>
                      <input type="text" name="email" class="form-control"  value="<?php echo $aryForm['email']; ?>" />
                    </div>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>Address</label>
                    <input type="test" name="address" class="form-control"  value="<?php echo $aryForm['address']; ?>" />
                  </div>
                  
                
                   <div class="form-group col-xs-12">
                    <label>Web Mail</label>
                    <input type="test" name="webmail_link" class="form-control"  value="<?php echo $aryForm['webmail_link']; ?>" />
                  </div>
                  <div class="form-group col-xs-12">
                    <label>ERP Login</label>
                    <input type="test" name="erp_login" class="form-control"  value="<?php echo $aryForm['erp_login']; ?>" />
                  </div>
                  <div class="form-group col-xs-12">
                    <label>Home Youtube Video ID</label>"https://www.youtube.com/watch?v=licjBYeWKks" licjBYeWKks Is ID
                    <input type="test" name="youtube_id" class="form-control"  value="<?php echo $aryForm['youtube_id']; ?>" />
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