
<div class="edu2_main_bn_wrap">
  <div id="owl-demo-main" class="owl-carousel owl-theme">
    <?php
$slider = $db->get('slider');
if(is_array($slider) && count($slider)>0)
          {
              foreach($slider as $islider)
              { 
?>
    <div class="item">
      <figure> <img src="<?php echo URL_UPLOAD;?>slider/<?php echo $islider['image']?>" alt=""/>
      
        <figcaption> <?php if($islider['top_heading']!=""){?><span><?php echo $islider['top_heading']?></span>
        <?php }?>
          <h2><?php echo $islider['title']?></h2>
          <p ><strong style="color:#FFF !important"><?php echo $islider['description']?></strong></p>
           </figcaption>
      </figure>
    </div>
    <?php 
			  }
		  }?>
  </div>
</div>
