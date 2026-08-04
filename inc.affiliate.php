
<style>
/* Footer / Affiliation Logos Single Row Layout */
.bu-affiliates-container {
  width: 100% !important;
  margin-top: 40px !important;
  padding-top: 50px !important;
  margin-bottom: 35px !important;
  display: block !important;
  clear: both !important;
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
}
.bu-affiliates-container,
.bu-affiliates-container *,
.bu-affiliates-container *:before,
.bu-affiliates-container *:after {
  box-shadow: none !important;
}
.bu-affiliates-container figure:before,
.bu-affiliates-container figure:after,
.bu-affiliates-wrapper figure:before,
.bu-affiliates-wrapper figure:after,
#owl-demo-87 figure:before,
#owl-demo-87 figure:after {
  display: none !important;
  content: none !important;
  opacity: 0 !important;
  width: 0 !important;
  height: 0 !important;
  background: none !important;
  border: none !important;
}
.bu-affiliates-wrapper {
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: nowrap !important;
  justify-content: space-between !important;
  align-items: center !important;
  gap: 15px !important;
  width: 100% !important;
  margin: 0 auto !important;
  background: transparent !important;
  border: none !important;
}
#owl-demo-87 {
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: nowrap !important;
  justify-content: space-between !important;
  align-items: center !important;
  width: 100% !important;
  float: none !important;
  background: transparent !important;
  border: none !important;
}
#owl-demo-87 .owl-wrapper-outer {
  width: 100% !important;
  overflow: visible !important;
  float: none !important;
  background: transparent !important;
  border: none !important;
}
#owl-demo-87 .owl-wrapper {
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: nowrap !important;
  justify-content: space-between !important;
  align-items: center !important;
  width: 100% !important;
  transform: none !important;
  float: none !important;
  background: transparent !important;
  border: none !important;
}
#owl-demo-87 .owl-item,
.bu-affiliates-wrapper .item {
  float: none !important;
  flex: 1 1 0px !important;
  width: auto !important;
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  padding: 0 5px !important;
  box-sizing: border-box !important;
  background: transparent !important;
  border: none !important;
}
#owl-demo-87 .item figure,
.bu-affiliates-wrapper .item figure {
  margin: 0 !important;
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background: transparent !important;
  border: none !important;
}
#owl-demo-87 .item img,
.bu-affiliates-wrapper .item img {
  max-width: 105px !important;
  max-height: 105px !important;
  width: auto !important;
  height: auto !important;
  object-fit: contain !important;
  margin: 0 auto !important;
  display: block !important;
  transition: transform 0.3s ease !important;
  border: none !important;
  background: transparent !important;
}
#owl-demo-87 .item img:hover,
.bu-affiliates-wrapper .item img:hover {
  transform: scale(1.08) !important;
}
#owl-demo-87 .owl-controls,
#owl-demo-87 .owl-pagination {
  display: none !important;
}

@media (max-width: 767px) {
  .bu-affiliates-container {
    margin-top: 30px !important;
    padding-top: 35px !important;
  }
  #owl-demo-87 .item img,
  .bu-affiliates-wrapper .item img {
    max-width: 70px !important;
    max-height: 70px !important;
  }
}
@media (max-width: 480px) {
  .bu-affiliates-container {
    margin-top: 20px !important;
    padding-top: 25px !important;
  }
  #owl-demo-87 .item img,
  .bu-affiliates-wrapper .item img {
    max-width: 50px !important;
    max-height: 50px !important;
  }
  .bu-affiliates-wrapper {
    gap: 6px !important;
  }
}
</style>

<div class="container bu-affiliates-container">
  <div class="row"> 
    <div class="edu2_testemonial_slider_wrap bu-affiliates-wrapper">
      <div id="owl-demo-87">
        <?php
$affiliate  = $db->get('affiliate');
if(is_array($affiliate ) && count($affiliate )>0)
          {
              foreach($affiliate  as $iaffiliate )
              { 
?>
        <div class="item"> 
          <figure><img width="100px" src="<?php echo URL_UPLOAD;?>affiliate/thumb/<?php echo $iaffiliate['image']?>" alt="<?php echo $iaffiliate['name']?>"/></figure>
        </div>
        <?php 
			  }
		  }?>
      </div>
    </div>
  </div>
</div>
