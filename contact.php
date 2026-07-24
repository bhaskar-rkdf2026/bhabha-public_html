<?php include_once("config.php");
$stat=array();
if($_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
	$data = Array(
			"name" => $_POST['name'],
			"email" => $_POST['email'],
			"mobile" => $_POST['mobile'],
			"subject" => $_POST['subject'],
			"message" => $_POST['message']
			 );
		$id = $db->insert('inquiry',$data);
		unset($_POST);
		unset($_SESSION['form']);
		$_SESSION["success"] = 'Message Send Successfully';
		redirect(href("contact.php").'#validation');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Best University in Bhopal - Bhabha University Bhopal</title>
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1044262718273018');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1044262718273018&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
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
              <h3>Contact US</h3>
            </div>
            <div class="kf_inr_breadcrumb">
              <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="<?php echo href("contact.php")?>">contact us</a></li>
              </ul>
            </div>
          </div>
          <!--KF INR BANNER DES Wrap End--> 
        </div>
      </div>
    </div>
  </div>
  <div class="kf_content_wrap">
    <div class="kf_location_wrap">
      <!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14671.796461456019!2d77.4712569!3d23.1720572!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x10c314f1ebd7443d!2sBHABHA%20UNIVERSITY%20BHOPAL!5e0!3m2!1sen!2sin!4v1591698837664!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d458.48993205215265!2d77.47143157668663!3d23.173139575550074!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397c413e272caceb%3A0x10c314f1ebd7443d!2sBHABHA%20UNIVERSITY%20BHOPAL!5e0!3m2!1sen!2sin!4v1627023546427!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
      
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d871.6195191978886!2d77.47102521946762!3d23.17144184075258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397c4145d4a74e11%3A0x1070e69bc11aa403!2sBhabha%20University!5e1!3m2!1sen!2sin!4v1627023920982!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <section>
      <div class="container">
        <div class="row">
          <div class="contct_wrap">
          <div class="col-md-8">
          <div class="contact_heading" id="validation">
                  <h4>Sent A Message</h4>
                </div>
                
          <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post" enctype="multipart/form-data">
          <div class="row">
                  <div class="col-md-6"><div class="inputs_des"> <span><i class="fa fa-user"></i>Name</span>
                        <input type="text" name="name" required>
                      </div></div>
                   <div class="col-md-6">
                    <div class="inputs_des"> <span><i class="fa fa-envelope-o"></i>E-mail</span>
                        <input type="email" name="email" required>
                      </div>
                   </div>
                  </div>
           <div class="row">
                  <div class="col-md-6"><div class="inputs_des"> <span><i class="fa fa-phone"></i>Mobile Number</span>
                        <input type="tel" name="mobile" required>
                      </div></div>
                   <div class="col-md-6">
                    <div class="inputs_des"> <span><i class="fa fa-file-text-o"></i>Subject</span>
                      <input type="text" name="subject" required>
                    </div>
                   </div>
                  </div>
                  
          <div class="row">
                  <div class="col-md-12"><div class="inputs_des"> <span><i class="fa fa-comments-o"></i>Your Message</span>
                      <textarea name="message" rows="2" required></textarea>
                    </div></div>
                   
                  </div>
                  
                  <div class="row">
                  <div class="col-md-12"><div class="contact_des">
                        <button type="submit" name="submit">Submit</button>
                      </div>
                  </div>
                   
                  </div>
                  </form>
          </div>
          <div class="col-md-4">
                <div class="contact_heading">
                  <h4>Contact info</h4>
                  <p>Explore the way to BHABHA University. We are here to provide you more information and answer any query you may have for all your educational needs.</p>
                </div>
                <ul class="contact_meta">
                  <li><i class="fa fa-home"></i><?php echo $aryForm['address']?></li>
                  
                  <li><i class="fa fa-phone"></i><a href="tel:<?php echo $aryForm['phone_one']?>"><?php echo $aryForm['phone_one']?></a> (Academic)</li>
                  <li><i class="fa fa-phone"></i><a href="tel:<?php echo $aryForm['phone_two']?>"><?php echo $aryForm['phone_two']?></a> (Registrar)</li>
                  
                  <li><i class="fa fa-phone"></i><a href="tel:<?php echo $aryForm['mobile_two']?>"><?php echo $aryForm['mobile_two']?></a>, <a href="tel:<?php echo $aryForm['mobile_one']?>"><?php echo $aryForm['mobile_one']?></a> (Admission)</li>
                  <li><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $aryForm['email']?>"><?php echo $aryForm['email']?></a></li>
                </ul>
                
                <!-- hide social code ...
                
                <div class="contact_heading social">
                  <h4>Get Social</h4>
                </div>
                <ul class="cont_socil_meta">
                  <li><a href="<?php echo $aryForm['facebook']?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  
                </ul> 
                
                -->
              
              </div>
          
          
            <form action="" method="post" enctype="multipart/form-data">
            </form>
                </div>
              </div>
              
            
          </div>
    </section>
  </div>
  <!--NEWS LETTERS END--> 
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
