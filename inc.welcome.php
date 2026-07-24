<section style="background-color:#F9F9F9">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="kf_edu2_heading1">
          <h3>Events</h3>
        </div>
        <div class="edu2_faculty_wrap">
          <div id="owl-demo-23" class="owl-carousel owl-theme">
            
             <?php
$events  = $db->get('events');
if(is_array($events ) && count($events )>0)
          {
              foreach($events  as $ievents )
              { 
?>
<div class="item"> 
              <!-- FACULTY DES START-->
              <div class="edu2_faculty_des">
                <div class="edu2_faculty_des2">
                  <h6><a href="<?php echo href("events.php","id=".$ievents['id']."");?>"><?php echo $ievents['title']?></a></h6>
                  <p ><a style="color:#000;" href="<?php echo href("events.php","id=".$ievents['id']."");?>"><?php echo $ievents['description']?></a></p>
                </div>
              </div>
              <!-- FACULTY DES END--> 
            </div>

        
        <?php 
			  }
		  }?>
            
            
          </div>
        </div>
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $aryForm['youtube_id']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="col-md-7"> 
        <!-- HEADING 2 END-->
        <div class="kf_edu2_heading2">
          <h3>Welcome To Bhabha University</h3>
          <p style="text-align:justify">We are a renowned educational group in central India established in 2003. Now BHABHA Group of Institutions has become "BHABHA UNIVERSITY”. Established by the Act of Madhya Pradesh Legislature and is notified in the Official Gazette of the State Government. </p>
        </div>
        <!-- INTERO DES START--><a href="<?php echo href("page.php","id=21");?>">
        <div class="kf_intro_des">
          <div class="kf_intro_des_caption"> <span style="padding-top:15px;"><img src="<?php echo URL_IMG?>books.png" width="50" alt=""/></span>
            <h6>BOOKS & LIBRARY</h6>
          </div>
          <figure> <img src="<?php echo URL_IMG?>/library.jpg" alt=""/> </figure>
        </div></a>
        <!-- INTERO DES END--> 
        <!-- INTERO DES START-->
        <a href="<?php echo href("page.php","id=22");?>">
        <div class="kf_intro_des">
          <div class="kf_intro_des_caption"> <span style="padding-top:15px;"><img src="<?php echo URL_IMG?>solar.png" width="50" alt=""/></span>
            <h6>Solar Plant</h6>
          </div>
          <figure> <img src="<?php echo URL_IMG?>/solar.jpg" alt=""/> </figure>
        </div></a>
        <!-- INTERO DES END--> 
        
        <!-- INTERO DES START-->
         <a href="<?php echo href("page.php","id=23");?>">
        <div class="kf_intro_des">
          <div class="kf_intro_des_caption"> <span style="padding-top:15px;"><img src="<?php echo URL_IMG?>radio.png" width="50" alt=""/></span>
            <h6>Campus Radio</h6>
          </div>
          <figure> <img src="<?php echo URL_IMG?>/radio.jpg" alt=""/> </figure>
        </div></a>
      </div>
    </div>
  </div>
</section>
