<section>
      <div class="container">
        <div class="row"> 
          <!-- HEADING 2 START-->
          <div class="col-md-12">
            <div class="kf_edu2_heading2">
              <h3>Our Recruiters</h3>
            </div>
          </div>
          <!-- HEADING 2 END--> 
          <!-- TESTEMONIAL SLIDER WRAP START-->
          <div class="edu2_testemonial_slider_wrap">
            <div id="owl-demo-8">
                      <?php
$recruiters = $db->get('recruiters');
if(is_array($recruiters) && count($recruiters)>0)
          {
              foreach($recruiters as $irecruiters)
              { 
?>
              <div class="item"> 
                <!-- TESTEMONIAL SLIDER WRAP START-->
                <figure><img src="<?php echo URL_UPLOAD;?>recruiters/<?php echo $irecruiters['image']?>" alt="<?php echo $irecruiters['name']?>"/></figure>
                <!-- TESTEMONIAL SLIDER WRAP END--> 
              </div>
           <?php 
			  }
		  }?>
            </div>
          </div>
          <!-- TESTEMONIAL SLIDER WRAP END--> 
        </div>
      </div>
    </section>