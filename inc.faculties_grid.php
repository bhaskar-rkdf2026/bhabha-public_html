<?php
// Bhabha University – Redesigned Schools & Faculties Section
?>
<section class="bu-faculties-section" id="buFacultiesSection">
  <div class="bu-faculties-container">
    
    <!-- Header Block -->
    <div class="bu-faculties-header">
      <div class="bu-header-left">
        <span class="bu-faculties-label">SCHOOLS &amp; FACULTIES</span>
        <h2 class="bu-faculties-heading">
          25 schools &amp; institutes. One <em>global</em><br>university.
        </h2>
      </div>
      
      <div class="bu-header-right">
        <a href="<?php echo href("institutes.php"); ?>" class="bu-view-all">VIEW ALL SCHOOLS &nbsp;→</a>
        <div class="bu-faculty-slider-ctrls" id="buFacSliderCtrls">
          <button type="button" class="bu-fnav-btn" id="buFacPrevBtn" aria-label="Previous School">
            <i class="fa fa-chevron-left"></i>
          </button>
          <button type="button" class="bu-fnav-btn" id="buFacNextBtn" aria-label="Next School">
            <i class="fa fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Main Grid (4 Columns Desktop / Horizontal Touch Slider on Mobile) -->
    <div class="bu-faculties-grid" id="buFacultiesGrid">
      <?php
      if (!function_exists('bu_get_department_desc')) {
        function bu_get_department_desc($title, $existing_desc = '') {
          if (!empty($existing_desc) && trim($existing_desc) !== 'Industry-aligned curriculum, research labs and expert faculty.') {
            return $existing_desc;
          }
          $t = strtoupper(trim($title));
          if (strpos($t, 'ENGIN') !== false) {
            return 'Industry-aligned technical education, advanced robotics labs, and innovation projects.';
          } elseif (strpos($t, 'PHARM') !== false) {
            return 'PCI-approved pharmaceutical training with modern formulation suites and clinical research.';
          } elseif (strpos($t, 'DENT') !== false) {
            return 'DCI-recognized clinical dental education with a 100+ chair hospital and live patient care.';
          } elseif (strpos($t, 'MANAGE') !== false || strpos($t, 'MBA') !== false || strpos($t, 'BBA') !== false) {
            return 'Future-ready business leadership with corporate case studies, analytics, and global mentorship.';
          } elseif (strpos($t, 'COMPUT') !== false || strpos($t, 'MCA') !== false || strpos($t, 'BCA') !== false || strpos($t, 'IT') !== false) {
            return 'Cutting-edge software engineering, AI, cloud computing, and full-stack development.';
          } elseif (strpos($t, 'EDU') !== false || strpos($t, 'B.ED') !== false || strpos($t, 'TEACH') !== false) {
            return 'NCTE-approved teacher training programs fostering pedagogy, leadership, and modern classroom skills.';
          } elseif (strpos($t, 'LAW') !== false || strpos($t, 'LEGAL') !== false || strpos($t, 'LLB') !== false) {
            return 'Bar Council-approved legal education with moot court training, legal aid, and judiciary prep.';
          } elseif (strpos($t, 'NURS') !== false) {
            return 'INC-approved nursing education with multi-specialty clinical rotations and patient healthcare practice.';
          } elseif (strpos($t, 'HOTEL') !== false || strpos($t, 'HMCT') !== false) {
            return 'Hands-on culinary arts, hospitality operations, front-office mastery, and food production training.';
          } elseif (strpos($t, 'HOM') !== false) {
            return 'CCH-compliant homoeopathic medical education, holistic diagnosis, and multi-bed hospital training.';
          } elseif (strpos($t, 'PARAMED') !== false) {
            return 'Diagnostic radiology, pathology, medical lab technology, and emergency hospital care.';
          } elseif (strpos($t, 'LIB') !== false) {
            return 'Digital archives, modern informatics, knowledge systems, and library classification methods.';
          } elseif (strpos($t, 'AGRI') !== false) {
            return 'Modern agronomy, soil science, precision farming techniques, and sustainable agri-business.';
          } elseif (strpos($t, 'COMMERCE') !== false || strpos($t, 'B.COM') !== false || strpos($t, 'M.COM') !== false) {
            return 'Professional commerce, corporate accounting, fintech, taxation, and financial management.';
          } elseif (strpos($t, 'SCIENCE') !== false || strpos($t, 'BIO') !== false) {
            return 'Research-oriented foundational education in physics, chemistry, mathematics, and biotechnology.';
          } elseif (strpos($t, 'ARTS') !== false || strpos($t, 'HUMAN') !== false) {
            return 'Holistic liberal arts curriculum exploring communication, social science, and critical thought.';
          }
          return 'Excellence in academic learning, hands-on practical training, and industry-oriented research.';
        }
      }

      $department = $db->get('department');
      if(is_array($department) && count($department) > 0) {
        $count = 1;
        $dept_images = [
          'ENGINEER'          => URL_ROOT . 'new-media/image/ENGINEERING.jpg',
          'PHARM'             => URL_ROOT . 'new-media/image/PHARMACY.jpg',
          'DENT'              => URL_ROOT . 'new-media/image/DENTAL_11.jpg',
          'HOTEL'             => URL_ROOT . 'new-media/department/Hotel Management-150kb.webp',
          'MANAGE'            => URL_ROOT . 'new-media/image/MANAGEMENT.jpg',
          'COMPUT'            => URL_ROOT . 'new-media/image/COMPUTER APPLICATION.jpg',
          'EDU'               => URL_ROOT . 'new-media/image/EDUCATION_11.jpg',
          'AGRI'              => URL_ROOT . 'new-media/department/Agriculture-150kb.webp',
          'LAW'               => URL_ROOT . 'new-media/department/Law-150kb.webp',
          'COMMERCE'          => URL_ROOT . 'new-media/department/Commerce-150kb.webp',
          'SCIENCE'           => URL_ROOT . 'new-media/department/Science-150kb.webp',
          'ART'               => URL_ROOT . 'new-media/department/Arts-150kb.webp',
          'NURS'              => URL_ROOT . 'new-media/department/Nursing-150kb.webp',
          'LIB'               => URL_ROOT . 'new-media/department/Library Science-150kb.webp',
          'PARAMED'           => URL_ROOT . 'new-media/department/Paramedical-150kb.webp',
          'HOM'               => URL_ROOT . 'new-media/department/Homeopathy-150kb.webp'
        ];

        $fallback_images = array_values($dept_images);

        foreach($department as $index => $idepartment) {
          $title_upper = strtoupper(trim($idepartment['title']));
          $img_src = '';
          if (!empty($idepartment['image'])) {
            $img_src = (strpos($idepartment['image'], 'http') === 0) ? $idepartment['image'] : URL_ROOT . ltrim($idepartment['image'], '/');
          }
          if (empty($img_src) || strpos($img_src, 'bhabha-administration-and-leadership') !== false) {
            foreach($dept_images as $key => $src) {
              if(strpos($title_upper, $key) !== false) {
                $img_src = $src;
                break;
              }
            }
          }
          if(empty($img_src)) {
            $img_src = $fallback_images[$index % count($fallback_images)];
          }
          $num_str = str_pad($count, 2, '0', STR_PAD_LEFT);
          $count++;
          $dept_desc = bu_get_department_desc($idepartment['title'], !empty($idepartment['short_description']) ? $idepartment['short_description'] : '');
      ?>
      <div class="bu-faculty-card">
        <!-- 3D Flip Card Image Wrapper (Flips ONLY when hovering this image) -->
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
                <p class="bu-flip-desc"><?php echo htmlspecialchars($dept_desc); ?></p>
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
          <p class="bu-card-desc"><?php echo htmlspecialchars($dept_desc); ?></p>
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

  </div>
</section>

<!-- ===== SCHOOLS & FACULTIES STYLES ===== -->
<style>
.bu-faculties-section {
  background-color: #FAF9F6 !important; /* warm light cream bg */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
  overflow: hidden;
}
.bu-faculties-container {
  max-width: 1280px !important;
  margin: 0 auto !important;
  padding: 0 12px !important;
  box-sizing: border-box !important;
}
.bu-faculties-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  margin-bottom: 45px !important;
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
  font-size: clamp(30px, 3.8vw, 44px) !important;
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
.bu-header-right {
  display: flex !important;
  align-items: center !important;
  gap: 16px !important;
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

/* Slider Controls (Hidden on Desktop, Visible on Mobile/Tablet) */
.bu-faculty-slider-ctrls {
  display: none !important;
}
.bu-fnav-btn {
  width: 38px !important;
  height: 38px !important;
  border-radius: 50% !important;
  border: 1.5px solid #061D7C !important;
  background: #FFFFFF !important;
  color: #061D7C !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: 13px !important;
  cursor: pointer !important;
  transition: all 0.2s ease !important;
  box-shadow: 0 2px 8px rgba(6, 29, 124, 0.1) !important;
  outline: none !important;
}
.bu-fnav-btn:hover,
.bu-fnav-btn:active {
  background: #061D7C !important;
  color: #FFC107 !important;
  transform: scale(1.05) !important;
}

/* Grid Layout (4 Columns on Desktop) */
.bu-faculties-grid {
  display: grid !important;
  grid-template-columns: repeat(4, 1fr) !important;
  gap: 28px 22px !important;
  margin-bottom: 15px !important;
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
  height: 270px !important;
  perspective: 1200px !important;
  -webkit-perspective: 1200px !important;
  background: transparent !important;
  border-radius: 8px !important;
  margin-bottom: 16px !important;
  display: block !important;
  cursor: pointer !important;
  text-decoration: none !important;
}

.bu-flip-inner {
  position: relative !important;
  width: 100% !important;
  height: 100% !important;
  text-align: center !important;
  transition: transform 0.75s cubic-bezier(0.4, 0.2, 0.2, 1) !important;
  transform-style: preserve-3d !important;
  -webkit-transform-style: preserve-3d !important;
  border-radius: 8px !important;
}

/* 3D FLIP ONLY ON IMAGE HOVER */
.bu-card-img-wrapper:hover .bu-flip-inner {
  transform: rotateY(180deg) !important;
  -webkit-transform: rotateY(180deg) !important;
}

.bu-flip-face {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  -webkit-backface-visibility: hidden !important;
  backface-visibility: hidden !important;
  border-radius: 8px !important;
  overflow: hidden !important;
}

/* FRONT FACE */
.bu-flip-front {
  background-color: #061D7C !important;
  z-index: 2 !important;
  transform: rotateY(0deg) !important;
  -webkit-transform: rotateY(0deg) !important;
  box-shadow: 0 4px 16px rgba(6, 29, 124, 0.08) !important;
}

.bu-card-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  display: block !important;
  transition: transform 0.6s ease !important;
}

.bu-card-number {
  position: absolute !important;
  top: 14px !important;
  left: 14px !important;
  background: #061D7C !important;
  color: #FFFFFF !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  padding: 4px 10px !important;
  border-radius: 3px !important;
  letter-spacing: 1px !important;
  z-index: 4 !important;
  box-shadow: 0 2px 6px rgba(0,0,0,0.3) !important;
}

.bu-flip-hint {
  position: absolute !important;
  bottom: 12px !important;
  right: 12px !important;
  background: rgba(6, 29, 124, 0.85) !important;
  color: #FFC107 !important;
  font-size: 10px !important;
  font-weight: 800 !important;
  padding: 3px 8px !important;
  border-radius: 20px !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
  backdrop-filter: blur(4px) !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 4px !important;
  z-index: 4 !important;
  transition: opacity 0.3s ease !important;
}

/* BACK FACE */
.bu-flip-back {
  background: linear-gradient(145deg, #030D3A 0%, #061D7C 60%, #020926 100%) !important;
  transform: rotateY(180deg) !important;
  -webkit-transform: rotateY(180deg) !important;
  z-index: 1 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 22px 18px !important;
  box-sizing: border-box !important;
  color: #FFFFFF !important;
  box-shadow: 0 8px 24px rgba(6, 29, 124, 0.25) !important;
}

.bu-flip-bg-img {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  opacity: 0.18 !important;
  filter: blur(2px) grayscale(40%) !important;
  z-index: 1 !important;
}

.bu-flip-overlay {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  background: radial-gradient(circle at center, rgba(6, 29, 124, 0.75) 0%, rgba(3, 13, 58, 0.95) 100%) !important;
  z-index: 2 !important;
}

.bu-flip-content {
  position: relative !important;
  z-index: 3 !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
  width: 100% !important;
  height: 100% !important;
}

.bu-hover-badge {
  font-size: 9.5px !important;
  font-weight: 800 !important;
  letter-spacing: 2px !important;
  color: #FFC107 !important;
  text-transform: uppercase !important;
  margin-bottom: 8px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 5px !important;
}

.bu-hover-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 18px !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  line-height: 1.25 !important;
  margin: 0 0 10px 0 !important;
  text-align: center !important;
  text-shadow: 0 2px 8px rgba(0,0,0,0.5) !important;
}

.bu-hover-divider {
  width: 36px !important;
  height: 2px !important;
  background: #FFC107 !important;
  margin: 0 auto 12px auto !important;
  border-radius: 2px !important;
}

.bu-flip-desc {
  font-size: 11.5px !important;
  color: #E2E8F0 !important;
  line-height: 1.45 !important;
  margin: 0 0 16px 0 !important;
  text-align: center !important;
  display: -webkit-box !important;
  -webkit-line-clamp: 3 !important;
  -webkit-box-orient: vertical !important;
  overflow: hidden !important;
}

.bu-hover-btn {
  background: #FFC107 !important;
  color: #061D7C !important;
  font-size: 11.5px !important;
  font-weight: 800 !important;
  letter-spacing: 0.5px !important;
  padding: 8px 18px !important;
  border-radius: 4px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  box-shadow: 0 4px 14px rgba(255, 193, 7, 0.4) !important;
  transition: all 0.25s ease !important;
  text-transform: uppercase !important;
}

.bu-card-img-wrapper:hover .bu-hover-btn {
  transform: translateY(-2px) scale(1.03) !important;
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
  font-size: 17px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  margin: 0 0 6px 0 !important;
  line-height: 1.3 !important;
}
.bu-card-title-link {
  color: inherit !important;
  text-decoration: none !important;
  transition: color 0.2s ease !important;
}
.bu-card-title-link:hover {
  color: #D99B00 !important;
}
.bu-card-desc {
  font-size: 12.5px !important;
  font-style: italic !important;
  color: #6B7280 !important;
  margin: 0 0 12px 0 !important;
  line-height: 1.5 !important;
}
.bu-card-explore {
  font-size: 11px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  text-decoration: none !important;
  letter-spacing: 0.5px !important;
  display: inline-flex !important;
  align-items: center !important;
  transition: color 0.2s ease !important;
}
.bu-card-explore:hover {
  color: #D99B00 !important;
}

/* ---- RESPONSIVE BREAKPOINTS ---- */
@media (max-width: 1100px) and (min-width: 821px) {
  .bu-faculties-grid {
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 24px !important;
  }
}

/* MOBILE & TABLET: HORIZONTAL TOUCH SLIDER */
@media (max-width: 820px) {
  .bu-faculties-section {
    padding: 55px 16px 65px 16px !important;
  }
  .bu-faculties-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 16px !important;
    margin-bottom: 28px !important;
  }
  .bu-header-right {
    width: 100% !important;
    justify-content: space-between !important;
  }
  .bu-faculty-slider-ctrls {
    display: inline-flex !important;
    gap: 8px !important;
  }

  /* Horizontal Snap Slider Track */
  .bu-faculties-grid {
    display: flex !important;
    flex-wrap: nowrap !important;
    overflow-x: auto !important;
    scroll-snap-type: x mandatory !important;
    scroll-behavior: smooth !important;
    -webkit-overflow-scrolling: touch !important;
    gap: 16px !important;
    padding: 4px 16px 24px 16px !important;
    margin: 0 -16px 10px -16px !important;
    scrollbar-width: thin !important;
    scrollbar-color: #FFC107 rgba(6, 29, 124, 0.08) !important;
  }

  /* Custom Sleek Scrollbar */
  .bu-faculties-grid::-webkit-scrollbar {
    height: 5px !important;
  }
  .bu-faculties-grid::-webkit-scrollbar-track {
    background: rgba(6, 29, 124, 0.05) !important;
    border-radius: 10px !important;
    margin: 0 16px !important;
  }
  .bu-faculties-grid::-webkit-scrollbar-thumb {
    background: #FFC107 !important;
    border-radius: 10px !important;
  }

  .bu-faculty-card {
    flex: 0 0 280px !important;
    width: 280px !important;
    max-width: 82vw !important;
    scroll-snap-align: start !important;
    margin-bottom: 0 !important;
  }

  .bu-card-img-wrapper.bu-flip-card {
    height: 240px !important;
  }
}

@media (max-width: 575px) {
  .bu-faculties-heading {
    font-size: 26px !important;
  }
  .bu-faculty-card {
    flex: 0 0 260px !important;
    width: 260px !important;
    max-width: 80vw !important;
  }
  .bu-card-img-wrapper.bu-flip-card {
    height: 220px !important;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var grid = document.getElementById('buFacultiesGrid');
  var prev = document.getElementById('buFacPrevBtn');
  var next = document.getElementById('buFacNextBtn');

  if (prev && grid) {
    prev.addEventListener('click', function() {
      var cardWidth = (grid.querySelector('.bu-faculty-card') ? grid.querySelector('.bu-faculty-card').offsetWidth : 280) + 16;
      grid.scrollBy({ left: -cardWidth, behavior: 'smooth' });
    });
  }
  if (next && grid) {
    next.addEventListener('click', function() {
      var cardWidth = (grid.querySelector('.bu-faculty-card') ? grid.querySelector('.bu-faculty-card').offsetWidth : 280) + 16;
      grid.scrollBy({ left: cardWidth, behavior: 'smooth' });
    });
  }
});
</script>
