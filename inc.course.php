
<div class="kf_course_outerwrap">

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row"> 
              <!--COURSE CATEGORIES WRAP START-->
              <div class="kf_cur_catg_wrap"> 
                <!--COURSE CATEGORIES WRAP HEADING START-->
                <div class="col-md-12">
                  <div class="kf_edu2_heading1">
                    <h3>Programmes We Offer</h3>
                  </div>
                </div>
                <!--COURSE CATEGORIES WRAP HEADING END--> 
                    <?php
					$i=1;
$department = $db->get('department');
if(is_array($department) && count($department)>0)
          {
              foreach($department as $idepartment)
              { 
?>
                <!--COURSE CATEGORIES DES START-->
                <div class="col-md-4">
                <a href="<?php echo href("department.php","id=".$idepartment['id']."");?>">
                  <div class="kf_cur_catg_des color-<?php echo $i?>"> <span><i class="<?php echo $idepartment['icon']?>"></i></span>
                    <div class="kf_cur_catg_capstion">
                      <h5><?php echo $idepartment['title']?></h5>
                    
                    </div>
                  </div></a>
                </div>
                <!--COURSE CATEGORIES DES END--> 
               <?php 
			   $i++;
			   if($i==7)
			   {
				   $i=1;
			   }
			  }
		  }?>
              </div>
              <!--COURSE CATEGORIES WRAP END--> 
            </div>
          </div>
        </div>
      </div>
    </div>