<?php
// Bhabha University – Redesigned Schools & Faculties Section
?>
<section class="bu-faculties-section">
  <div class="bu-faculties-container">
    
    <!-- Header Block -->
    <div class="bu-faculties-header">
      <div class="bu-header-left">
        <span class="bu-faculties-label">SCHOOLS & FACULTIES</span>
        <h2 class="bu-faculties-heading">
          15 schools. One <em>global</em><br>university.
        </h2>
      </div>
      
      <div class="bu-header-right">
        <a href="<?php echo href("institutes.php"); ?>" class="bu-view-all">VIEW ALL SCHOOLS &nbsp;→</a>
      </div>
    </div>

    <!-- Main Grid (Dynamic Schools from DB) -->
    <div class="bu-faculties-grid">
      <?php
      $department = $db->get('department');
      $other_schools = [];
      if(is_array($department) && count($department) > 0) {
        $count = 1;
        $dept_images = [
          'ENGINEERING'          => URL_ROOT . 'new-media/image/ENGINEERING.jpg',
          'PHARMACY'             => URL_ROOT . 'new-media/image/PHARMACY.jpg',
          'DENTAL'               => URL_ROOT . 'new-media/image/DENTAL_11.jpg',
          'MANAGEMENT'           => URL_ROOT . 'new-media/image/MANAGEMENT.jpg',
          'COMPUTER'             => URL_ROOT . 'new-media/image/COMPUTER APPLICATION.jpg',
          'EDUCATION'            => URL_ROOT . 'new-media/image/EDUCATION_11.jpg',
        ];

        $fallback_images = [
          URL_ROOT . 'new-media/image/ENGINEERING.jpg',
          URL_ROOT . 'new-media/image/PHARMACY.jpg',
          URL_ROOT . 'new-media/image/DENTAL_11.jpg',
          URL_ROOT . 'new-media/image/MANAGEMENT.jpg',
          URL_ROOT . 'new-media/image/COMPUTER APPLICATION.jpg',
          URL_ROOT . 'new-media/image/EDUCATION_11.jpg'
        ];
        
        $main_schools = array_slice($department, 0, 6);
        $other_schools = array_slice($department, 6);

        foreach($main_schools as $index => $idepartment) {
          $title_upper = strtoupper(trim($idepartment['title']));
          $img_src = '';
          foreach($dept_images as $key => $src) {
            if(strpos($title_upper, $key) !== false) {
              $img_src = $src;
              break;
            }
          }
          if(empty($img_src)) {
            $img_src = $fallback_images[$index % count($fallback_images)];
          }
          $num_str = str_pad($count, 2, '0', STR_PAD_LEFT);
          $count++;
      ?>
      <div class="bu-faculty-card">
        <!-- 3D Flip Card Image Wrapper -->
        <a href="<?php echo href("department.php","id=".$idepartment['id']); ?>" class="bu-card-img-wrapper bu-flip-card" title="<?php echo htmlspecialchars($idepartment['title']); ?>">
          <div class="bu-flip-inner">
            
            <!-- FRONT FACE: Original Image + Badge -->
            <div class="bu-flip-face bu-flip-front">
              <span class="bu-card-number"><?php echo $num_str; ?></span>
              <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($idepartment['title']); ?>" class="bu-card-img">
              <div class="bu-flip-hint"><i class="fa fa-refresh"></i> Flip</div>
            </div>

            <!-- BACK FACE: Dark Navy Luxury Background with Large Title & Action Button -->
            <div class="bu-flip-face bu-flip-back">
              <img src="<?php echo $img_src; ?>" alt="" class="bu-flip-bg-img" aria-hidden="true">
              <div class="bu-flip-overlay"></div>
              <div class="bu-flip-content">
                <span class="bu-hover-badge"><i class="fa fa-graduation-cap"></i> FACULTY OF</span>
                <h4 class="bu-hover-title"><?php echo htmlspecialchars($idepartment['title']); ?></h4>
                <div class="bu-hover-divider"></div>
                <p class="bu-flip-desc"><?php echo !empty($idepartment['short_description']) ? htmlspecialchars($idepartment['short_description']) : 'Industry-aligned curriculum, research labs and expert faculty.'; ?></p>
                <span class="bu-hover-btn">
                  <span>Explore Faculty</span>
                  <i class="fa fa-arrow-right"></i>
                </span>
              </div>
            </div>

          </div>
        </a>

        <!-- Card Body -->
        <div class="bu-card-body">
          <h3 class="bu-card-title">
            <a href="<?php echo href("department.php","id=".$idepartment['id']); ?>" class="bu-card-title-link"><?php echo htmlspecialchars($idepartment['title']); ?></a>
          </h3>
          <p class="bu-card-desc"><?php echo !empty($idepartment['short_description']) ? htmlspecialchars($idepartment['short_description']) : 'Industry-aligned curriculum, research labs and expert faculty.'; ?></p>
          <a href="<?php echo href("department.php","id=".$idepartment['id']); ?>" class="bu-card-explore">EXPLORE FACULTY &nbsp;›</a>
        </div>
      </div>
      <?php 
        }
      } else {
        echo '<p>No schools found.</p>';
      }
      ?>
    </div>

    <?php if(!empty($other_schools) && count($other_schools) > 0) { ?>
    <!-- Bottom Buttons (Remaining Schools from DB) -->
    <div class="bu-faculties-footer-links">
      <?php
      foreach($other_schools as $idepartment) {
        echo '<a href="'.href("department.php","id=".$idepartment['id']).'" class="bu-footer-tag">'.htmlspecialchars($idepartment['title']).'</a>';
      }
      ?>
    </div>
    <?php } ?>

  </div>
</section>

<!-- ===== SCHOOLS & FACULTIES STYLES ===== -->
<style>
.bu-faculties-section {
  background-color: #FAF9F6 !important; /* warm light cream bg */
  padding: 90px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-faculties-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}
.bu-faculties-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  margin-bottom: 50px !important;
  gap: 20px !important;
}
.bu-faculties-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: #D99B00 !important;
  text-transform: uppercase !important;
  margin-bottom: 12px !important;
  display: block !important;
}
.bu-faculties-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 4vw, 48px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.15 !important;
  margin: 0 !important;
}
.bu-faculties-heading em {
  font-style: italic !important;
  color: #061D7C !important;
  font-weight: 700;
  text-decoration: underline !important;
  text-decoration-color: #FFC107 !important;
  text-underline-offset: 4px !important;
}
.bu-view-all {
  font-size: 11.5px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  text-decoration: none !important;
  border-bottom: 2px solid #FFC107 !important;
  padding-bottom: 6px !important;
  letter-spacing: 1px !important;
  transition: all 0.2s ease !important;
  white-space: nowrap !important;
}
.bu-view-all:hover {
  color: #D99B00 !important;
  border-bottom-color: #061D7C !important;
}

/* Grid Layout */
.bu-faculties-grid {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 40px 30px !important;
  margin-bottom: 60px !important;
}
.bu-faculty-card {
  background: transparent !important;
  display: flex !important;
  flex-direction: column !important;
  position: relative !important;
}

/* ===== 3D FLIP CARD STYLES ===== */
.bu-card-img-wrapper.bu-flip-card {
  position: relative !important;
  width: 100% !important;
  height: 320px !important;
  perspective: 1200px !important;
  -webkit-perspective: 1200px !important;
  background: transparent !important;
  border-radius: 6px !important;
  margin-bottom: 20px !important;
  display: block !important;
  cursor: pointer !important;
  text-decoration: none !important;
}

.bu-flip-inner {
  position: relative !important;
  width: 100% !important;
  height: 100% !important;
  transform-style: preserve-3d !important;
  -webkit-transform-style: preserve-3d !important;
  transition: transform 0.75s cubic-bezier(0.34, 1.3, 0.64, 1) !important;
  border-radius: 6px !important;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
}

/* Flip Trigger on Hover */
.bu-faculty-card:hover .bu-flip-inner,
.bu-card-img-wrapper:hover .bu-flip-inner {
  transform: rotateY(180deg) !important;
  box-shadow: 0 16px 35px rgba(6, 29, 124, 0.22) !important;
}

/* Front & Back Faces Common */
.bu-flip-face {
  position: absolute !important;
  inset: 0 !important;
  width: 100% !important;
  height: 100% !important;
  border-radius: 6px !important;
  overflow: hidden !important;
  backface-visibility: hidden !important;
  -webkit-backface-visibility: hidden !important;
}

/* ===== 1. FRONT FACE ===== */
.bu-flip-front {
  background-color: #061D7C !important;
  z-index: 2 !important;
  transform: rotateY(0deg) !important;
}

.bu-flip-front .bu-card-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  display: block !important;
  transition: transform 0.5s ease !important;
}

.bu-faculty-card:hover .bu-flip-front .bu-card-img {
  transform: scale(1.05) !important;
}

.bu-card-number {
  position: absolute !important;
  top: 15px !important;
  left: 15px !important;
  background-color: #061D7C !important;
  color: #FFFFFF !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  padding: 4px 8px !important;
  border-radius: 2px !important;
  z-index: 5 !important;
}

.bu-flip-hint {
  position: absolute !important;
  bottom: 12px !important;
  right: 12px !important;
  background: rgba(6, 29, 124, 0.8) !important;
  backdrop-filter: blur(4px) !important;
  -webkit-backdrop-filter: blur(4px) !important;
  color: #FFC107 !important;
  font-size: 10px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  padding: 4px 10px !important;
  border-radius: 20px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 5px !important;
  opacity: 0.9 !important;
  transition: all 0.3s ease !important;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
}

/* ===== 2. BACK FACE ===== */
.bu-flip-back {
  background: linear-gradient(145deg, #061D7C 0%, #020A30 100%) !important;
  transform: rotateY(180deg) !important;
  z-index: 1 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 24px 20px !important;
  box-sizing: border-box !important;
  border: 1px solid rgba(255, 193, 7, 0.3) !important;
}

.bu-flip-bg-img {
  position: absolute !important;
  inset: 0 !important;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  opacity: 0.16 !important;
  filter: blur(4px) grayscale(50%) !important;
}

.bu-flip-overlay {
  position: absolute !important;
  inset: 0 !important;
  background: radial-gradient(circle at center, rgba(6, 29, 124, 0.7) 0%, rgba(2, 10, 48, 0.95) 100%) !important;
}

.bu-flip-content {
  position: relative !important;
  z-index: 2 !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
  text-align: center !important;
  width: 100% !important;
}

.bu-hover-badge {
  font-size: 10px !important;
  font-weight: 800 !important;
  letter-spacing: 2px !important;
  color: #FFC107 !important;
  text-transform: uppercase !important;
  margin-bottom: 8px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
}

.bu-hover-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(20px, 2.2vw, 25px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  margin: 0 !important;
  line-height: 1.25 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.8px !important;
  text-shadow: 0 3px 12px rgba(0, 0, 0, 0.5) !important;
}

.bu-hover-divider {
  width: 44px !important;
  height: 3px !important;
  background-color: #FFC107 !important;
  border-radius: 2px !important;
  margin: 10px auto 12px auto !important;
}

.bu-flip-desc {
  font-size: 12.5px !important;
  color: rgba(255, 255, 255, 0.78) !important;
  line-height: 1.5 !important;
  margin: 0 0 16px 0 !important;
  max-width: 260px !important;
}

.bu-hover-btn {
  font-size: 11px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  background-color: #FFC107 !important;
  padding: 8px 20px !important;
  border-radius: 20px !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4) !important;
  transition: all 0.25s ease !important;
}

.bu-faculty-card:hover .bu-hover-btn {
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 20px rgba(255, 193, 7, 0.6) !important;
  background-color: #FFD54F !important;
}

/* Card Body */
.bu-card-body {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-card-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 19px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  margin: 0 0 8px 0 !important;
  line-height: 1.35 !important;
}
.bu-card-title-link {
  color: inherit !important;
  text-decoration: none !important;
  transition: color 0.2s ease !important;
}
.bu-card-title-link:hover,
.bu-faculty-card:hover .bu-card-title-link {
  color: #D99B00 !important;
}
.bu-card-desc {
  font-size: 13.5px !important;
  font-style: italic !important;
  color: #6B7280 !important;
  margin: 0 0 16px 0 !important;
  line-height: 1.5 !important;
}
.bu-card-tags {
  display: flex !important;
  gap: 8px !important;
  flex-wrap: wrap !important;
  margin-bottom: 20px !important;
}
.bu-tag {
  background-color: #F3EFE7 !important; /* subtle grey cream */
  color: #4B5563 !important;
  font-size: 9.5px !important;
  font-weight: 700 !important;
  letter-spacing: 0.5px !important;
  padding: 4px 10px !important;
  border-radius: 2px !important;
}
.bu-card-explore {
  font-size: 11px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  text-decoration: none !important;
  letter-spacing: 1px !important;
  display: inline-flex !important;
  align-items: center !important;
  transition: color 0.2s ease !important;
}
.bu-card-explore:hover {
  color: #D99B00 !important;
}

/* Footer Tag Links Grid */
.bu-faculties-footer-links {
  display: flex !important;
  flex-wrap: wrap !important;
  justify-content: space-between !important;
  gap: 8px !important;
  width: 100% !important;
  border-top: 1px solid #EAEAEA !important;
  padding-top: 40px !important;
}
.bu-footer-tag {
  flex: 1 1 0px !important;
  min-width: 0 !important;
  background-color: #F3EFE7 !important;
  color: #061D7C !important;
  font-size: 10.5px !important;
  font-weight: 700 !important;
  text-align: center !important;
  padding: 14px 4px !important;
  border-radius: 3px !important;
  text-decoration: none !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  transition: all 0.25s ease !important;
  line-height: 1.25 !important;
}
.bu-footer-tag:hover {
  background-color: #061D7C !important;
  color: #FFFFFF !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.15) !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 1024px) {
  .bu-faculties-footer-links {
    display: grid !important;
    grid-template-columns: repeat(5, 1fr) !important;
    gap: 10px !important;
  }
}
@media (max-width: 991px) {
  .bu-faculties-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 30px 20px !important;
  }
  .bu-card-img-wrapper {
    height: 280px !important;
  }
  .bu-faculties-footer-links {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
  }
  .bu-faculties-section {
    padding: 60px 16px !important;
  }
}
@media (max-width: 575px) {
  .bu-faculties-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 16px !important;
  }
  .bu-faculties-grid {
    grid-template-columns: 1fr !important;
    gap: 30px !important;
  }
  .bu-faculties-footer-links {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 8px !important;
  }
}
</style>
