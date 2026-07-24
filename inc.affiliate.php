
<div class="container" style="margin-top:20px;">
  <div class="row"> 
    <!-- HEADING 2 START-->
    <!-- HEADING 2 END--> 
    <!-- TESTEMONIAL SLIDER WRAP START-->
    <div class="edu2_testemonial_slider_wrap">
      <div id="owl-demo-87">
        <?php
$affiliate  = $db->get('affiliate');
if(is_array($affiliate ) && count($affiliate )>0)
          {
              foreach($affiliate  as $iaffiliate )
              { 
?>
        <div class="item"> 
          <!-- TESTEMONIAL SLIDER WRAP START-->
          <figure><img width="100px" src="<?php echo URL_UPLOAD;?>affiliate/thumb/<?php echo $iaffiliate['image']?>" alt="<?php echo $iaffiliate['name']?>"/></figure>
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
