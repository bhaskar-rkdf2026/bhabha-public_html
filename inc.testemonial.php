<section>
  <div class="container">
    <div class="row"> 
      <div class="col-md-12">
        <div class="kf_edu2_heading2">
          <h3>Our Happy Student</h3>
        </div>
      </div>
      <div class="edu2_testemonial_slider_wrap">
        <div id="owl-demo-9">
          <?php
$testimonial = $db->get('testimonial');
if(is_array($testimonial) && count($testimonial)>0)
          {
              foreach($testimonial as $iTestimonial)
              { 
?>
          <div class="item"> 
            <div class="edu_testemonial_wrap">
              <figure><img src="<?php echo URL_UPLOAD;?>testimonial/<?php echo $iTestimonial['image']?>" alt="<?php echo $iTestimonial['name']?>"/></figure>
              <div class="kode-text">
                <p><?php echo $iTestimonial['testimonial']?></p>
                <a href="#"><?php echo $iTestimonial['name']?><span>- <?php echo $iTestimonial['designation']?></span></a> </div>
            </div>
          </div>
          <?php 
			  }
		  }?>
        </div>
      </div>
    </div>
  </div>
</section>
