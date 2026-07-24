<section class="kode-gallery-section"> 
  <!-- HEADING 2 START-->
  <div class="col-md-12">
    <div class="kf_edu2_heading2">
      <h3>Our Gallery</h3>
      <p>Student gallery of the year past graduated passouts</p>
    </div>
  </div>
  <!-- HEADING 2 END--> 
  <!-- EDU2 GALLERY WRAP START-->
  <div class="edu2_gallery_wrap gallery"> 
    
    <!-- EDU2 GALLERY DES START-->
    <div class="gallery3">
      <?php
$db->where('is_home',1);
$db->orderBy("RAND ()");
$gallery = $db->get('gallery',8);
if(is_array($gallery) && count($gallery)>0)
          {
              foreach($gallery as $igallery)
              { 
?>
      <div class="filterable-item all col-md-3 col-sm-4 col-xs-12 no_padding">
        <div class="edu2_gallery_des">
          <figure> <img alt="" src="<?php echo URL_UPLOAD;?>gallery/thumb/<?php echo $igallery['image']?>" height="250" width="300">
            <figcaption> <a rel="prettyPhoto[pp_gal]" href="<?php echo URL_UPLOAD;?>gallery/large/<?php echo $igallery['image']?>"><i class="fa fa-eye"></i></a>
              <h5><?php echo $igallery['title']?></h5>
            </figcaption>
          </figure>
        </div>
      </div>
      <?php 
			  }
		  }?>
    </div>
    
    <!-- EDU2 GALLERY WRAP END--> 
  </div>
  <div class="loadmore"> <a href="<?php echo href("gallery.php")?>" class="btn-3">View More</a> </div>
</section>
