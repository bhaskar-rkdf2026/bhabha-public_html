<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Infrastructure - Bhabha University Bhopal Madhya Pradesh</title>
    <!-- Bootstrap core CSS -->
    <?php include('inc.meta.php');?>
    </head>
    
    <body>
<!--KF KODE WRAPPER WRAP START-->
<div class="kode_wrapper"> 
      <!-- register Modal --> 
      <!--HEADER START-->
      <?php include('inc.header.php');?>
      <!--HEADER END-->
      <div class="kf_inr_banner">
    <div class="container">
          <div class="row">
        <div class="col-md-12"> 
              <!--KF INR BANNER DES Wrap Start-->
              <div class="kf_inr_ban_des">
            <div class="inr_banner_heading">
                  <h3>Infrastructure</h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">Infrastructure</a></li>
              </ul>
                </div>
          </div>
              <!--KF INR BANNER DES Wrap End--> 
            </div>
      </div>
        </div>
  </div>
      <!--NEWS LETTERS END-->
      <div class="kf_content_wrap"> 
    
    <!--ABOUT UNIVERSITY START-->
    <section>
          <div class="container">
        <div class="row">
              <div class="col-md-12">
            <div class="abt_univ_wrap"> 
                  <!-- HEADING 1 START-->
                  <div class="kf_edu2_heading1">
                <h5>BHABHA UNIVERSITY</h5>
                <h3>Infrastructure</h3>
              </div>
                  <!-- HEADING 1 END-->
                  <div class="abt_univ_des"> 
                  <p>Bhabha University is spread across a vast area of 27 acres. The remarkable aspect of Bhabha University is the avant-grade infrastructure provided for both students and faculty. Fully furnished and well-equipped labs grace every building in the University. Moreover, the campus is consolidated with abundant features that support diverse events- Auditorium, open spaces, outdoor stages and much more</p>
                  
                  <?php
				  $infrastructure = $db->get('infrastructure');
if(is_array($infrastructure) && count($infrastructure)>0)
          {
              foreach($infrastructure as $iinfrastructure)
              { 
?>
<h4><?php echo $iinfrastructure['title']?></h4><br>
<?php if($iinfrastructure['image']!=''){ ?>
<img width="400px" src="<?php echo URL_UPLOAD;?>infrastructure/<?php echo $iinfrastructure['image']?>" style=" -webkit-box-shadow: 0px 0px 8px 2px #000000;
       -moz-box-shadow: 0px 0px 8px 2px #000000;
            box-shadow: 0px 0px 8px 2px #000000;"><?php }?>
<p><?php echo $iinfrastructure['description']?></p>
<hr>
                  <?php 
			  }
		  }?>
                  </div>
                </div>
          </div>
            </div>
      </div>
        </section>
    <!--ABOUT UNIVERSITY END--> 
    
  </div>
      <!--FOOTER START-->
      <?php include('inc.footer.php');?>
      
      <!--FOOTER END--> 
      <!--COPYRIGHTS START--> 
      
      <!--COPYRIGHTS START--> 
    </div>
<!--KF KODE WRAPPER WRAP END--> 
<!--Bootstrap core JavaScript-->
<?php include('inc.footer.js.php');?>
</body>
</html>
