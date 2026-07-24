<?php include_once("config.php");
$stat=array();
$validate=new Validation();
if(isset($_POST['login']))
{
	$validate->addRule($_POST['admin_uname'],'','Username',true);
	$validate->addRule($_POST['admin_pswd'],'','Password',true);
	if($validate->validate() && count($stat) == 0)
	{
		$db->where ('field','admin_uname');
		$db->where ('value',$_POST['admin_uname']);
		$aryAdminUser = $db->get('settings');
		if(is_array($aryAdminUser) && count($aryAdminUser)>0)
		{
			$db->where ('field','admin_pswd');
			$db->where ('value',$_POST['admin_pswd']);
			$aryAdminPwd = $db->get('settings');
			if(is_array($aryAdminPwd) && count($aryAdminPwd)>0)
			{
				$_SESSION[LOGIN_ADMIN]['userName'] = $_POST['admin_uname'];
				redirect(URL_ADMIN."dashboard.php");
			}
			else
			{
				$stat['error']='Invalid Password';
			}
			
		}
		else
		{
			$stat['error']='Invalid Username';
		}
	}
	if(count($stat) == 0)
	{
		$stat["error"]=$validate->errors();
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Login Admin</title>
<?php include_once("inc.meta.php"); ?>
 <style>
.bgbody{
  background-image: url('img/bg.jpg');
}
</style> 
</head>
<body class="bgbody">
<!-- Begin page -->
<div class="wrapper-page">
  <div class="card">
    <div class="card-body">
      <h3 class="text-center m-0"><a href="" class="logo logo-admin"><img src="img/logo.png" height="80" alt="logo"></a></h3>
      <div class="p-3">
        <p class="text-muted text-center">Sign in to continue.</p>
        <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
        <form class="form-horizontal m-t-30" action="" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="admin_uname" id="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="userpassword">Password</label>
            <input type="password" class="form-control" name="admin_pswd" id="userpassword" placeholder="Enter password">
          </div>
          <div class="form-group row m-t-20">
            <div class="col-4"> </div>
            <div class="col-4 text-right">
              <input type="submit" class="btn btn-primary w-md waves-effect waves-light" name="login" value="Log In">
            </div>
            <div class="col-4"> </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
</div>
<!-- jQuery  --><script src="<?php echo URL_JS;?>jquery.min.js"></script><script src="<?php echo URL_JS;?>bootstrap.bundle.min.js"></script><script src="<?php echo URL_JS;?>metisMenu.min.js"></script><script src="<?php echo URL_JS;?>jquery.slimscroll.js"></script><script src="<?php echo URL_JS;?>waves.min.js"></script><script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script><!-- App js --><script src="<?php echo URL_JS;?>app.js"></script>
</body>
</html>