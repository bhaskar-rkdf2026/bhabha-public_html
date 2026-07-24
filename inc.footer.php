<footer> 
  <!--EDU2 FOOTER CONTANT WRAP START-->
  <div class="container">
    <div class="row"> 
      <!--EDU2 FOOTER CONTANT DES START-->
      <div class="col-md-3">
        <div class="widget widget-links">
          <h5>Quick Links</h5>
          <ul>
            <?php
$links = $db->get('links');
if(is_array($links) && count($links)>0)
          {
              foreach($links as $ilinks)
              { 
?>
            <li><a href="<?php echo $ilinks['link']?>" target="_blank"><?php echo $ilinks['title']?></a></li>
            <?php 
			  }
		  }?>
            <li><a href="<?php echo href("page.php","id=2");?>" >Online Fee Payment</a></li>
          </ul>
        </div>
      </div>
      <!--EDU2 FOOTER CONTANT DES END--> 
      
      <!--EDU2 FOOTER CONTANT DES START-->
      <div class="col-md-3">
        <div class="widget widget-links">
          <h5>Rules and Regulations</h5>
          <ul>
            <li><a href="<?php echo href("term-and-condition.php")?>">Terms & Conditions</a></li>
            <li><a href="<?php echo href("privacy-policy.php")?>">Privacy Policy</a></li>
            <li><a href="<?php echo href("refund-policy.php")?>">Refund and Cancellation Policy</a></li>
          
            <li><a href="https://bhabhauniversity.edu.in/sitemap.xml">Site Map</a></li>
            
           <!-- social links -->
          <!--<h5>Social Links</h5>-->
          <li><h5>Social Links</h5></li>
          <li>
            <a href="https://www.facebook.com/BhabhaUniversityIndia/" target="_blank" title="Facebook"> <i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a>
            &nbsp; <a href="https://www.instagram.com/bhabhauniversitybhopal/" target="_blank" title="Instagram"> <i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
             &nbsp; <a href="https://twitter.com/bhabhaUniversty" target="_blank" title="Twitter"> <i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></a>
             &nbsp; <a href="https://www.youtube.com/channel/UCHyRBhcOyXt2CvTAW6JzP-g" target="_blank" title="YouTube"> <i class="fa fa-youtube-square fa-2x" aria-hidden="true"></i></a>
             
             
             &nbsp; <a href="https://in.linkedin.com/company/bhabha-university" target="_blank" title="LinkedIn"> <i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
             
             &nbsp; <a href="https://in.pinterest.com/buwebsite2020/" target="_blank" title="Pinterest"> <i class="fa fa-pinterest fa-2x" aria-hidden="true"></i></a>
             
             
             &nbsp; <a href="https://gmail.com/" target="_blank" title="Gmail"> <i class="fa fa-google fa-2x" aria-hidden="true"></i></a>
             
             
           </li>
           <!-- social links -->
          </ul>
    
        
        </div>
      </div>
      <!--EDU2 FOOTER CONTANT DES END--> 
      
      <!--EDU2 FOOTER CONTANT DES START-->
      <div class="col-md-3">
        <div class="widget widget-links">
          <h5>Announcements</h5>
          <ul>
            <?php
$db->where('is_announcement',1);
$announcement = $db->get('news_and_announcement',8);
if(is_array($announcement) && count($announcement)>0)
          {
              foreach($announcement as $iannouncement)
              { 
?>
            <li><a href="<?php echo href("announcements.php","id=".$iannouncement['id']."");?>" ><?php echo $iannouncement['title']?></a></li>
            <?php 
			  }
		  }?>
          </ul>
        </div>
      </div>
      <!--EDU2 FOOTER CONTANT DES END--> 
      
      <!--EDU2 FOOTER CONTANT DES START-->
      <div class="col-md-3">
        <div class="widget widget-contact">
          <h5>Contact</h5>
          <ul>
              <li><img src="https://www.bhabhauniversity.edu.in/images/Bhabha university logo.png" width="100%" alt="Bhabha University Logo" title="bhabha university logo" /></li>
            <li><?php echo $aryForm['address']?></li>
            <li>Phone : <a href="tel:<?php echo $aryForm['phone_one']?>"> <?php echo $aryForm['phone_one']?></a></li>
            <li>For Admission : <a href="tel:<?php echo $aryForm['mobile_two']?>"> <?php echo $aryForm['mobile_two']?></a>, <a href="tel:<?php echo $aryForm['mobile_one']?>"> <?php echo $aryForm['mobile_one']?></a></li>
            <li>Email : <a href="mailto:<?php echo $aryForm['email']?>"> <?php echo $aryForm['email']?></a></li>
          </ul>
        </div>
      </div>
      <!--EDU2 FOOTER CONTANT DES END--> 
    </div>
  </div>
  <?php include('inc.affiliate.php');?>
</footer>
<div class="edu2_copyright_wrap">
  <div class="container">
    <div class="row">
      <div class="col-md-3"> </div>
      <div class="col-md-6">
        <div class="copyright_des"> <span>&copy; 2023 All Rights reserved. Website Design & Developed By <a href="https://www.sileryinfotech.com/">Silery Infotech</a> || Maintained by <a href="bhabhaitcell.html" title="web developer">Bhabha IT Cell</a></span></div>
      </div>
      <div class="col-md-3"> </div>
    </div>
  </div>
</div>
