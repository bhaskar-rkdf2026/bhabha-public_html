<?php
// Bhabha University – Testimonials Section ("Voices of Bhabha")
// Fetches all records directly from DB as requested, with compact image sizing for DB photos.

$testimonials_list = [];

if (isset($db) && is_object($db)) {
    // Prioritize Mr. Kamlesh Kumar, Mr. Anshuman Rajesh Singh, and Ms. Nidhi Shukla first
    $db_testimonials = $db->rawQuery("
        SELECT * FROM testimonial 
        ORDER BY 
            CASE 
                WHEN name LIKE '%Kamlesh%' THEN 1
                WHEN name LIKE '%Anshuman%' THEN 2
                WHEN name LIKE '%Nidhi%' THEN 3
                ELSE 4 
            END ASC, 
            id DESC
    ");
    if (is_array($db_testimonials) && count($db_testimonials) > 0) {
        foreach ($db_testimonials as $t) {
            $imgName = !empty($t['image']) ? trim($t['image']) : '';
            if (!empty($imgName)) {
                if (file_exists(__DIR__ . '/upload/testimonial/' . $imgName)) {
                    $imgSrc = (defined('URL_UPLOAD') ? URL_UPLOAD . 'testimonial/' . $imgName : 'upload/testimonial/' . $imgName);
                } elseif (file_exists(__DIR__ . '/upload/media/' . $imgName)) {
                    $imgSrc = (defined('URL_UPLOAD') ? URL_UPLOAD . 'media/' . $imgName : 'upload/media/' . $imgName);
                } else {
                    $imgSrc = (defined('URL_UPLOAD') ? URL_UPLOAD . 'testimonial/' . $imgName : 'upload/testimonial/' . $imgName);
                }
            } else {
                $imgSrc = URL_ROOT . 'extra-images/author.jpg';
            }
            $testimonials_list[] = [
                'name' => !empty($t['name']) ? htmlspecialchars($t['name']) : '',
                'desig' => !empty($t['designation']) ? htmlspecialchars($t['designation']) : '',
                'text' => !empty($t['testimonial']) ? htmlspecialchars(strip_tags($t['testimonial'])) : '',
                'img' => $imgSrc
            ];
        }
    }
}

if (empty($testimonials_list)) {
    $testimonials_list = [
        [
            'name' => 'Mr. Kamlesh Kumar',
            'desig' => 'UPSC IES Officer | Engineering Alumnus',
            'text' => "My journey at Bhabha University laid the technical foundation and discipline required to clear one of the nation’s toughest examinations. The faculty guidance, laboratory exposure, and encouraging academic atmosphere were instrumental in my selection as a UPSC IES Officer.",
            'img' => (defined('URL_UPLOAD') ? URL_UPLOAD : 'upload/') . 'testimonial/alumni_kamlesh_kumar_ies.jpg'
        ],
        [
            'name' => 'Mr. Anshuman Rajesh Singh',
            'desig' => 'UPSC IES 2023 Officer | Engineering Alumnus',
            'text' => "Bhabha University provided me with the ideal ecosystem to hone my engineering intellect and leadership skills. The rigorous curriculum, state-of-the-art labs, and continuous mentorship by experienced professors empowered me to achieve success in UPSC IES 2023.",
            'img' => (defined('URL_UPLOAD') ? URL_UPLOAD : 'upload/') . 'testimonial/alumni_anshuman_singh_ies.jpg'
        ],
        [
            'name' => 'Ms. Nidhi Shukla',
            'desig' => 'Deputy Director, DTE MP | Distinguished Alumna',
            'text' => "Studying at Bhabha University transformed my perspective and professional capabilities. The institute’s focus on practical learning, state-of-the-art infrastructure, and continuous encouragement helped me reach the prestigious position of Deputy Director at DTE Madhya Pradesh.",
            'img' => (defined('URL_UPLOAD') ? URL_UPLOAD : 'upload/') . 'testimonial/alumni_nidhi_shukla_dte.jpg'
        ]
    ];
}
?>

<!-- Include Google Fonts for Playfair Display and Plus Jakarta Sans -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<section class="bu-voices-section">
  <div class="bu-voices-container">
    
    <!-- Section Header -->
    <div class="bu-voices-header">
      <span class="bu-voices-kicker">VOICES OF BHABHA</span>
      <h2 class="bu-voices-title">The people who make this place.</h2>
    </div>

    <!-- Carousel Container -->
    <div class="bu-voices-carousel" id="buVoicesCarousel">
      <div class="bu-voices-track">
        <?php foreach ($testimonials_list as $index => $item): ?>
        <div class="bu-voices-slide <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>">
          <div class="bu-voices-card">
            
            <!-- Left Column: Compact Student Portrait -->
            <div class="bu-voices-img-wrap">
              <img src="<?php echo $item['img']; ?>" 
                   alt="<?php echo $item['name']; ?>" 
                   class="bu-voices-img" 
                   onerror="this.src='<?php echo URL_ROOT;?>extra-images/author.jpg'">
            </div>

            <!-- Right Column: Content & Quote -->
            <div class="bu-voices-content">
              <!-- Stylized Double Quote Icon -->
              <div class="bu-voices-quote-icon">
                <svg width="40" height="32" viewBox="0 0 46 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.8 0H12.4L0 38H11.6L18.8 0ZM45.2 0H38.8L26.4 38H38L45.2 0Z" stroke="#E2A537" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>

              <!-- Quote Text -->
              <blockquote class="bu-voices-text">
                “<?php echo trim($item['text'], '“"'); ?>”
              </blockquote>

              <!-- Footer Row: Author & Nav Buttons -->
              <div class="bu-voices-footer">
                <div class="bu-voices-author">
                  <h4 class="bu-voices-name"><?php echo $item['name']; ?></h4>
                  <?php if (!empty($item['desig'])): ?>
                  <p class="bu-voices-desig"><?php echo $item['desig']; ?></p>
                  <?php endif; ?>
                </div>

                <div class="bu-voices-nav">
                  <button type="button" class="bu-voices-btn bu-voices-prev" aria-label="Previous Testimonial">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                  </button>
                  <button type="button" class="bu-voices-btn bu-voices-next" aria-label="Next Testimonial">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                  </button>
                </div>
              </div>

            </div>

          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<!-- ===== VOICES OF BHABHA SECTION STYLES ===== -->
<style>
.bu-voices-section {
  background-color: #142760 !important;
  color: #FFFFFF !important;
  padding: 70px 24px 80px 24px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
  box-sizing: border-box !important;
  position: relative !important;
  overflow: hidden !important;
}

.bu-voices-container {
  max-width: 1140px !important;
  width: 100% !important;
  margin: 0 auto !important;
}

/* Header */
.bu-voices-header {
  text-align: left !important;
  margin-bottom: 35px !important;
}

.bu-voices-kicker {
  color: #E2A537 !important;
  font-family: 'Plus Jakarta Sans', -apple-system, sans-serif !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  display: block !important;
  margin-bottom: 10px !important;
}

.bu-voices-title {
  color: #FFFFFF !important;
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 42px !important;
  font-weight: 400 !important;
  margin: 0 !important;
  line-height: 1.2 !important;
  letter-spacing: -0.5px !important;
}

/* Carousel Track & Slides */
.bu-voices-carousel {
  position: relative !important;
  width: 100% !important;
}

.bu-voices-track {
  position: relative !important;
  width: 100% !important;
  min-height: 280px !important;
}

.bu-voices-slide {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  opacity: 0 !important;
  visibility: hidden !important;
  transform: translateY(15px) !important;
  transition: opacity 0.4s ease, transform 0.4s ease, visibility 0.4s !important;
  pointer-events: none !important;
}

.bu-voices-slide.active {
  position: relative !important;
  opacity: 1 !important;
  visibility: visible !important;
  transform: translateY(0) !important;
  pointer-events: auto !important;
}

/* 2-Column Split Grid Card with Circular Student Portrait */
.bu-voices-card {
  display: grid !important;
  grid-template-columns: 210px 1fr !important;
  gap: 40px !important;
  align-items: center !important;
  width: 100% !important;
  box-sizing: border-box !important;
  background-color: rgba(255, 255, 255, 0.03) !important;
  padding: 36px 40px !important;
  border-radius: 20px !important;
  border: 1px solid rgba(255, 255, 255, 0.08) !important;
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2) !important;
}

/* Left: Circular Student Image with Gold Border */
.bu-voices-img-wrap {
  width: 190px !important;
  height: 190px !important;
  border-radius: 50% !important;
  overflow: hidden !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35) !important;
  background-color: #0b173c !important;
  flex-shrink: 0 !important;
  border: 4px solid #D99B00 !important;
  padding: 4px !important;
  margin: 0 auto !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  position: relative !important;
}

.bu-voices-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: center top !important;
  display: block !important;
  border-radius: 50% !important;
}

/* Right: Content */
.bu-voices-content {
  display: flex !important;
  flex-direction: column !important;
  justify-content: center !important;
}

.bu-voices-quote-icon {
  margin-bottom: 16px !important;
}

.bu-voices-quote-icon svg {
  display: block !important;
}

.bu-voices-text {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 22px !important;
  line-height: 1.5 !important;
  color: #FFFFFF !important;
  font-weight: 400 !important;
  margin: 0 0 30px 0 !important;
  padding: 0 !important;
  border: none !important;
  letter-spacing: -0.2px !important;
}

/* Footer Row */
.bu-voices-footer {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  gap: 20px !important;
}

.bu-voices-author {
  flex: 1 !important;
}

.bu-voices-name {
  font-family: 'Plus Jakarta Sans', -apple-system, sans-serif !important;
  font-size: 18px !important;
  font-weight: 600 !important;
  color: #E2A537 !important;
  margin: 0 0 4px 0 !important;
  letter-spacing: 0.2px !important;
}

.bu-voices-desig {
  font-family: 'Plus Jakarta Sans', -apple-system, sans-serif !important;
  font-size: 14px !important;
  color: #8FA6D0 !important;
  margin: 0 !important;
  font-weight: 400 !important;
}

/* Navigation Arrow Buttons */
.bu-voices-nav {
  display: flex !important;
  gap: 12px !important;
}

.bu-voices-btn {
  width: 42px !important;
  height: 42px !important;
  border-radius: 50% !important;
  border: 1px solid rgba(255, 255, 255, 0.25) !important;
  background-color: rgba(255, 255, 255, 0.04) !important;
  color: #FFFFFF !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  transition: all 0.25s ease !important;
  outline: none !important;
  padding: 0 !important;
}

.bu-voices-btn:hover {
  border-color: #E2A537 !important;
  background-color: rgba(226, 165, 55, 0.15) !important;
  color: #E2A537 !important;
  transform: translateY(-2px) !important;
}

.bu-voices-btn:active {
  transform: translateY(0) scale(0.96) !important;
}

/* Responsive Styles */
@media (max-width: 991px) {
  .bu-voices-title {
    font-size: 34px !important;
  }
  .bu-voices-card {
    grid-template-columns: 1fr !important;
    gap: 25px !important;
    padding: 28px 20px !important;
    text-align: center !important;
  }
  .bu-voices-img-wrap {
    width: 160px !important;
    height: 160px !important;
    margin: 0 auto !important;
  }
  .bu-voices-text {
    font-size: 19px !important;
    margin-bottom: 24px !important;
    text-align: center !important;
  }
  .bu-voices-content {
    align-items: center !important;
  }
}

@media (max-width: 576px) {
  .bu-voices-section {
    padding: 50px 16px 60px 16px !important;
  }
  .bu-voices-title {
    font-size: 28px !important;
  }
  .bu-voices-img-wrap {
    width: 130px !important;
    height: 130px !important;
  }
  .bu-voices-text {
    font-size: 16px !important;
    line-height: 1.5 !important;
  }
}
</style>

<!-- ===== VOICES OF BHABHA CAROUSEL LOGIC ===== -->
<script>
(function() {
  function initVoicesCarousel() {
    var carousel = document.getElementById('buVoicesCarousel');
    if (!carousel) return;

    var slides = carousel.querySelectorAll('.bu-voices-slide');
    if (!slides.length) return;

    var currentIndex = 0;

    function goToSlide(index) {
      if (index < 0) {
        index = slides.length - 1;
      } else if (index >= slides.length) {
        index = 0;
      }

      slides.forEach(function(slide, i) {
        if (i === index) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });

      currentIndex = index;
    }

    carousel.addEventListener('click', function(e) {
      var prevBtn = e.target.closest('.bu-voices-prev');
      var nextBtn = e.target.closest('.bu-voices-next');

      if (prevBtn) {
        e.preventDefault();
        goToSlide(currentIndex - 1);
      } else if (nextBtn) {
        e.preventDefault();
        goToSlide(currentIndex + 1);
      }
    });

    var timer = setInterval(function() {
      goToSlide(currentIndex + 1);
    }, 7000);

    carousel.addEventListener('mouseenter', function() {
      clearInterval(timer);
    });

    carousel.addEventListener('mouseleave', function() {
      timer = setInterval(function() {
        goToSlide(currentIndex + 1);
      }, 7000);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initVoicesCarousel);
  } else {
    initVoicesCarousel();
  }
})();
</script>
