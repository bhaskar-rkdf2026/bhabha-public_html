<?php
// Bhabha University – Hall of Fame & Placement Highlights Redesigned Slider Section
$creative_images = [
  [
    'src'      => URL_ROOT . 'upload/media/highest-package-60lpa.png',
    'title'    => 'Mr. Anurag Kumar - ₹60.0 LPA at CPP',
    'alt'      => 'Mr. Anurag Kumar Highest Package 60 LPA Bhabha University',
    'category' => 'Highest Placement (₹60 LPA)'
  ],
  [
    'src'      => URL_ROOT . 'upload/media/alumni_harikesh_singh_ies_rank68.jpg',
    'title'    => 'Harikesh Singh - AIR Rank 68 in UPSC IES 2025',
    'alt'      => 'Harikesh Singh AIR Rank 68 UPSC IES Bhabha University',
    'category' => 'UPSC IES Selection'
  ],
  [
    'src'      => URL_ROOT . 'upload/media/alumni_shubham_srivastava_nhsrcl.jpg',
    'title'    => 'Shubham Kumar Srivastava - ₹12.0 LPA at NHSRCL',
    'alt'      => 'Shubham Kumar Srivastava NHSRCL 12 LPA Bhabha University',
    'category' => 'PSU Placement (₹12 LPA)'
  ],
  [
    'src'      => URL_ROOT . 'upload/media/alumni_rakesh_roy_dhariwal.jpg',
    'title'    => 'Mr. Rakesh Kumar Roy - ₹7.44 LPA at Dhariwal Buildtech',
    'alt'      => 'Mr. Rakesh Kumar Roy Dhariwal Buildtech Bhabha University',
    'category' => 'Corporate Placement'
  ],
  [
    'src'      => URL_ROOT . 'upload/media/alumni_anshuman_singh_ies.jpg',
    'title'    => 'Anshuman Singh - Indian Engineering Services (UPSC IES)',
    'alt'      => 'Anshuman Singh Selected in UPSC IES Bhabha University',
    'category' => 'UPSC IES Selection'
  ],
  [
    'src'      => URL_ROOT . 'upload/media/alumni_kamlesh_kumar_ies.jpg',
    'title'    => 'Kamlesh Kumar - Indian Engineering Services (UPSC IES)',
    'alt'      => 'Kamlesh Kumar Selected in UPSC IES Bhabha University',
    'category' => 'UPSC IES Selection'
  ],
  [
    'src'      => URL_ROOT . 'upload/media/alumni_nidhi_shukla_dte.jpg',
    'title'    => 'Nidhi Shukla - Selected in DTE / PSU Placement',
    'alt'      => 'Nidhi Shukla DTE PSU Placement Bhabha University',
    'category' => 'Govt / PSU Placement'
  ],
  [
    'src'      => URL_ROOT . 'upload/media/alumni_vikash_chandra_iit_kanpur.jpg',
    'title'    => 'Vikash Chandra - M.Tech Selection at IIT Kanpur',
    'alt'      => 'Vikash Chandra IIT Kanpur Selection Bhabha University',
    'category' => 'Higher Studies (IIT)'
  ]
];
?>

<!-- ===== HALL OF FAME & HIGHLIGHTS REDESIGNED SECTION ===== -->
<section class="bu-fame-section" id="buHallOfFameSection">
  <div class="bu-fame-container">
    
    <!-- Section Header with Title & Navigation Controls -->
    <div class="bu-fame-header">
      <div class="bu-fame-header-left">
        <span class="bu-fame-badge"><i class="fa fa-trophy"></i> HALL OF FAME &amp; HIGHLIGHTS</span>
        <h2 class="bu-fame-title">Spotlight on <em>Excellence &amp; Achievements</em></h2>
        <p class="bu-fame-subtitle">Celebrating milestone placements, competitive exam rank holders, and prestigious recruitment selections at Bhabha University.</p>
      </div>
      
      <!-- Top Action Arrow Buttons -->
      <div class="bu-fame-header-actions">
        <button type="button" class="bu-fame-ctrl-btn" id="buFameTopPrev" aria-label="Previous Slide">
          <i class="fa fa-chevron-left"></i>
        </button>
        <button type="button" class="bu-fame-ctrl-btn" id="buFameTopNext" aria-label="Next Slide">
          <i class="fa fa-chevron-right"></i>
        </button>
      </div>
    </div>

    <!-- Main Carousel Area -->
    <div class="bu-fame-carousel-wrap" id="buFameCarouselWrap">
      
      <!-- Floating Side Navigation Arrows (Desktop) -->
      <button type="button" class="bu-fame-side-btn bu-fame-side-prev" id="buFameSidePrev" aria-label="Previous Poster">
        <i class="fa fa-angle-left"></i>
      </button>
      <button type="button" class="bu-fame-side-btn bu-fame-side-next" id="buFameSideNext" aria-label="Next Poster">
        <i class="fa fa-angle-right"></i>
      </button>

      <!-- Carousel Viewport & Flexible Track -->
      <div class="bu-fame-viewport">
        <div class="bu-fame-track" id="buFameTrack">
          <?php foreach ($creative_images as $idx => $cimg): ?>
          <div class="bu-fame-slide" data-slide-index="<?php echo $idx; ?>">
            <div class="bu-fame-card" onclick="openFameLightbox('<?php echo $cimg['src']; ?>', '<?php echo htmlspecialchars(addslashes($cimg['title'])); ?>')">
              
              <!-- Category Pill Badge -->
              <span class="bu-fame-card-badge">
                <i class="fa fa-star"></i> <?php echo htmlspecialchars($cimg['category']); ?>
              </span>

              <!-- Poster Image Container -->
              <div class="bu-fame-poster-holder">
                <img src="<?php echo $cimg['src']; ?>" alt="<?php echo htmlspecialchars($cimg['alt']); ?>" class="bu-fame-poster-img" loading="lazy" decoding="async">
                
                <!-- Hover Overlay with Zoom Icon -->
                <div class="bu-fame-card-overlay">
                  <span class="bu-fame-zoom-pill">
                    <i class="fa fa-search-plus"></i> View Full Poster
                  </span>
                </div>
              </div>

              <!-- Bottom Title Caption -->
              <div class="bu-fame-card-footer">
                <h4 class="bu-fame-card-title"><?php echo htmlspecialchars($cimg['title']); ?></h4>
              </div>

            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

    <!-- Pagination Dot Indicators -->
    <div class="bu-fame-pagination" id="buFamePagination"></div>

  </div>
</section>

<!-- Full-Size Lightbox Modal -->
<div id="buFameLightbox" class="bu-fame-lightbox" onclick="closeFameLightbox(event)">
  <div class="bu-fame-lightbox-dialog" onclick="event.stopPropagation()">
    <button type="button" class="bu-fame-lightbox-close" onclick="closeFameLightbox()" aria-label="Close Lightbox">&times;</button>
    <div class="bu-fame-lightbox-img-wrap">
      <img id="buFameLightboxImg" src="" alt="Full View Creative" class="bu-fame-lightbox-img">
    </div>
    <div id="buFameLightboxCaption" class="bu-fame-lightbox-caption"></div>
  </div>
</div>

<!-- ===== CAROUSEL SCRIPT ===== -->
<script>
(function() {
  function initFameCarousel() {
    const wrap = document.getElementById('buFameCarouselWrap');
    const track = document.getElementById('buFameTrack');
    const slides = document.querySelectorAll('.bu-fame-slide');
    const pagination = document.getElementById('buFamePagination');
    if (!wrap || !track || slides.length === 0) return;

    let currentIndex = 0;
    let cardsPerView = getCardsPerView();
    let maxIndex = Math.max(0, slides.length - cardsPerView);
    let autoPlayInterval = null;
    let isInteracting = false;

    function getCardsPerView() {
      const w = window.innerWidth;
      if (w >= 1180) return 4;
      if (w >= 900) return 3;
      if (w >= 580) return 2;
      return 1;
    }

    function updateSlideWidths() {
      cardsPerView = getCardsPerView();
      maxIndex = Math.max(0, slides.length - cardsPerView);
      if (currentIndex > maxIndex) {
        currentIndex = maxIndex;
      }
      
      const slidePercent = 100 / cardsPerView;
      slides.forEach(slide => {
        slide.style.setProperty('flex', `0 0 ${slidePercent}%`, 'important');
        slide.style.setProperty('max-width', `${slidePercent}%`, 'important');
        slide.style.setProperty('width', `${slidePercent}%`, 'important');
      });

      renderDots();
      moveToSlide(currentIndex, false);
    }

    function renderDots() {
      if (!pagination) return;
      pagination.innerHTML = '';
      const totalSteps = maxIndex + 1;
      
      for (let i = 0; i < totalSteps; i++) {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'bu-fame-dot' + (i === currentIndex ? ' active' : '');
        dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
        dot.addEventListener('click', () => {
          moveToSlide(i, true);
          restartAutoPlay();
        });
        pagination.appendChild(dot);
      }
    }

    function updateDots() {
      if (!pagination) return;
      const dots = pagination.querySelectorAll('.bu-fame-dot');
      dots.forEach((dot, idx) => {
        if (idx === currentIndex) {
          dot.classList.add('active');
        } else {
          dot.classList.remove('active');
        }
      });
    }

    function moveToSlide(index, animate = true) {
      if (index < 0) {
        index = maxIndex;
      } else if (index > maxIndex) {
        index = 0;
      }
      currentIndex = index;

      if (animate) {
        track.style.transition = 'transform 0.45s cubic-bezier(0.25, 1, 0.5, 1)';
      } else {
        track.style.transition = 'none';
      }

      const offsetPercent = (100 / cardsPerView) * currentIndex;
      track.style.transform = `translateX(-${offsetPercent}%)`;
      updateDots();
    }

    function nextSlide() {
      moveToSlide(currentIndex + 1, true);
    }

    function prevSlide() {
      moveToSlide(currentIndex - 1, true);
    }

    function startAutoPlay() {
      stopAutoPlay();
      autoPlayInterval = setInterval(() => {
        if (!isInteracting) {
          nextSlide();
        }
      }, 3600);
    }

    function stopAutoPlay() {
      if (autoPlayInterval) {
        clearInterval(autoPlayInterval);
        autoPlayInterval = null;
      }
    }

    function restartAutoPlay() {
      stopAutoPlay();
      startAutoPlay();
    }

    // Attach Event Listeners to Nav Buttons
    const topPrev = document.getElementById('buFameTopPrev');
    const topNext = document.getElementById('buFameTopNext');
    const sidePrev = document.getElementById('buFameSidePrev');
    const sideNext = document.getElementById('buFameSideNext');

    if (topPrev) topPrev.addEventListener('click', () => { prevSlide(); restartAutoPlay(); });
    if (topNext) topNext.addEventListener('click', () => { nextSlide(); restartAutoPlay(); });
    if (sidePrev) sidePrev.addEventListener('click', () => { prevSlide(); restartAutoPlay(); });
    if (sideNext) sideNext.addEventListener('click', () => { nextSlide(); restartAutoPlay(); });

    // Hover & Touch Events for AutoPlay Pause
    wrap.addEventListener('mouseenter', () => { isInteracting = true; });
    wrap.addEventListener('mouseleave', () => { isInteracting = false; });
    wrap.addEventListener('touchstart', () => { isInteracting = true; }, { passive: true });
    wrap.addEventListener('touchend', () => { 
      setTimeout(() => { isInteracting = false; }, 2000); 
    }, { passive: true });

    // Touch Swipe Gesture Support
    let startX = 0;
    let isSwiping = false;

    wrap.addEventListener('touchstart', (e) => {
      if (e.touches.length === 1) {
        startX = e.touches[0].clientX;
        isSwiping = true;
      }
    }, { passive: true });

    wrap.addEventListener('touchend', (e) => {
      if (!isSwiping) return;
      isSwiping = false;
      const endX = e.changedTouches[0].clientX;
      const diffX = startX - endX;
      if (Math.abs(diffX) > 40) {
        if (diffX > 0) {
          nextSlide();
        } else {
          prevSlide();
        }
        restartAutoPlay();
      }
    }, { passive: true });

    // Handle Window Resize
    let resizeTimer = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(updateSlideWidths, 100);
    });

    // Orientation change
    window.addEventListener('orientationchange', () => {
      setTimeout(updateSlideWidths, 150);
    });

    // Initial Setup
    updateSlideWidths();
    startAutoPlay();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFameCarousel);
  } else {
    initFameCarousel();
  }
})();

// Lightbox Modal Functions
function openFameLightbox(src, title) {
  const modal = document.getElementById('buFameLightbox');
  const img = document.getElementById('buFameLightboxImg');
  const caption = document.getElementById('buFameLightboxCaption');
  
  if (img) {
    img.src = src;
    img.alt = title || 'Bhabha University Poster';
  }
  if (caption) {
    caption.textContent = title || '';
  }
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeFameLightbox(e) {
  if (e && e.target && e.target.closest('.bu-fame-lightbox-dialog') && !e.target.classList.contains('bu-fame-lightbox-close')) {
    return;
  }
  const modal = document.getElementById('buFameLightbox');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeFameLightbox();
  }
});
</script>

<!-- ===== CAROUSEL STYLES ===== -->
<style>
/* Section Base */
.bu-fame-section {
  width: 100% !important;
  background: radial-gradient(circle at 50% 15%, #061D7C 0%, #030E40 60%, #01061C 100%) !important;
  padding: 70px 0 75px 0 !important;
  position: relative !important;
  overflow: hidden !important;
  float: left !important;
  clear: both !important;
  box-sizing: border-box !important;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

.bu-fame-section::before {
  content: '' !important;
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  background: radial-gradient(circle at 85% 15%, rgba(255, 193, 7, 0.08) 0%, transparent 45%),
              radial-gradient(circle at 15% 85%, rgba(6, 29, 124, 0.35) 0%, transparent 50%) !important;
  pointer-events: none !important;
}

.bu-fame-container {
  max-width: 1240px !important;
  margin: 0 auto !important;
  padding: 0 20px !important;
  position: relative !important;
  z-index: 2 !important;
  box-sizing: border-box !important;
}

/* Header */
.bu-fame-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  margin-bottom: 35px !important;
  gap: 20px !important;
}

.bu-fame-header-left {
  max-width: 780px !important;
}

.bu-fame-badge {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  background: rgba(255, 193, 7, 0.15) !important;
  border: 1px solid rgba(255, 193, 7, 0.35) !important;
  color: #FFC107 !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2px !important;
  text-transform: uppercase !important;
  padding: 6px 16px !important;
  border-radius: 30px !important;
  margin-bottom: 12px !important;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
}

.bu-fame-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(26px, 3.4vw, 40px) !important;
  font-weight: 800 !important;
  color: #ffffff !important;
  line-height: 1.25 !important;
  margin: 0 0 10px 0 !important;
}

.bu-fame-title em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
  text-decoration: underline !important;
  text-decoration-color: rgba(255, 193, 7, 0.5) !important;
  text-underline-offset: 6px !important;
}

.bu-fame-subtitle {
  font-size: 14px !important;
  color: rgba(255, 255, 255, 0.8) !important;
  line-height: 1.6 !important;
  margin: 0 !important;
}

/* Header Top Controls */
.bu-fame-header-actions {
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
  flex-shrink: 0 !important;
}

.bu-fame-ctrl-btn {
  width: 44px !important;
  height: 44px !important;
  border-radius: 50% !important;
  background: rgba(255, 255, 255, 0.08) !important;
  border: 1.5px solid rgba(255, 193, 7, 0.4) !important;
  color: #FFC107 !important;
  font-size: 15px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  transition: all 0.25s ease !important;
  outline: none !important;
}

.bu-fame-ctrl-btn:hover {
  background: #FFC107 !important;
  color: #061D7C !important;
  border-color: #FFC107 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 18px rgba(255, 193, 7, 0.4) !important;
}

/* Carousel Wrapper & Viewport */
.bu-fame-carousel-wrap {
  position: relative !important;
  width: 100% !important;
  padding: 10px 0 !important;
  box-sizing: border-box !important;
}

.bu-fame-viewport {
  width: 100% !important;
  overflow: hidden !important;
  position: relative !important;
  border-radius: 12px !important;
}

.bu-fame-track {
  display: flex !important;
  width: 100% !important;
  box-sizing: border-box !important;
  transition: transform 0.45s cubic-bezier(0.25, 1, 0.5, 1) !important;
  will-change: transform !important;
}

/* Slide Item Responsive Default */
.bu-fame-slide {
  box-sizing: border-box !important;
  padding: 0 10px !important;
  flex: 0 0 25%;
  max-width: 25%;
  width: 25%;
}

/* Card Container */
.bu-fame-card {
  width: 100% !important;
  height: 380px !important;
  background: #040D33 !important;
  border: 1.5px solid rgba(255, 193, 7, 0.3) !important;
  border-radius: 14px !important;
  overflow: hidden !important;
  display: flex !important;
  flex-direction: column !important;
  position: relative !important;
  box-shadow: 0 10px 26px rgba(0, 0, 0, 0.45) !important;
  cursor: pointer !important;
  box-sizing: border-box !important;
  transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease !important;
}

.bu-fame-card:hover {
  border-color: #FFC107 !important;
  transform: translateY(-6px) !important;
  box-shadow: 0 18px 36px rgba(0, 0, 0, 0.65), 0 0 22px rgba(255, 193, 7, 0.35) !important;
}

/* Top Pill Badge */
.bu-fame-card-badge {
  position: absolute !important;
  top: 12px !important;
  left: 12px !important;
  background: rgba(3, 10, 38, 0.88) !important;
  backdrop-filter: blur(4px) !important;
  -webkit-backdrop-filter: blur(4px) !important;
  border: 1px solid rgba(255, 193, 7, 0.5) !important;
  color: #FFC107 !important;
  font-size: 10.5px !important;
  font-weight: 800 !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
  padding: 4px 10px !important;
  border-radius: 20px !important;
  z-index: 5 !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 5px !important;
  white-space: nowrap !important;
}

/* Poster Holder */
.bu-fame-poster-holder {
  width: 100% !important;
  height: 310px !important;
  position: relative !important;
  background: #02071E !important;
  overflow: hidden !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}

.bu-fame-poster-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: contain !important;
  display: block !important;
  transition: transform 0.4s ease !important;
}

.bu-fame-card:hover .bu-fame-poster-img {
  transform: scale(1.03) !important;
}

/* Overlay & Button */
.bu-fame-card-overlay {
  position: absolute !important;
  inset: 0 !important;
  background: rgba(4, 15, 74, 0.65) !important;
  backdrop-filter: blur(3px) !important;
  -webkit-backdrop-filter: blur(3px) !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  opacity: 0 !important;
  transition: opacity 0.28s ease !important;
}

.bu-fame-card:hover .bu-fame-card-overlay {
  opacity: 1 !important;
}

.bu-fame-zoom-pill {
  background: #FFC107 !important;
  color: #061D7C !important;
  font-size: 11.5px !important;
  font-weight: 800 !important;
  padding: 8px 18px !important;
  border-radius: 25px !important;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.35) !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
  transform: translateY(6px) !important;
  transition: transform 0.25s ease !important;
}

.bu-fame-card:hover .bu-fame-zoom-pill {
  transform: translateY(0) !important;
}

/* Card Bottom Footer */
.bu-fame-card-footer {
  width: 100% !important;
  height: 70px !important;
  padding: 10px 14px !important;
  box-sizing: border-box !important;
  background: #030A28 !important;
  border-top: 1px solid rgba(255, 193, 7, 0.2) !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  text-align: center !important;
}

.bu-fame-card-title {
  color: #ffffff !important;
  font-size: 12.5px !important;
  font-weight: 700 !important;
  line-height: 1.35 !important;
  margin: 0 !important;
  display: -webkit-box !important;
  -webkit-line-clamp: 2 !important;
  -webkit-box-orient: vertical !important;
  overflow: hidden !important;
}

/* Floating Side Navigation Buttons */
.bu-fame-side-btn {
  position: absolute !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  width: 44px !important;
  height: 44px !important;
  border-radius: 50% !important;
  background: rgba(3, 10, 38, 0.92) !important;
  border: 1.5px solid rgba(255, 193, 7, 0.6) !important;
  color: #FFC107 !important;
  font-size: 26px !important;
  line-height: 1 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  z-index: 20 !important;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6) !important;
  transition: all 0.25s ease !important;
  outline: none !important;
}

.bu-fame-side-prev {
  left: -20px !important;
}

.bu-fame-side-next {
  right: -20px !important;
}

.bu-fame-side-btn:hover {
  background: #FFC107 !important;
  color: #061D7C !important;
  border-color: #FFC107 !important;
  transform: translateY(-50%) scale(1.1) !important;
  box-shadow: 0 10px 25px rgba(255, 193, 7, 0.45) !important;
}

/* Pagination Dots */
.bu-fame-pagination {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 8px !important;
  margin-top: 30px !important;
}

.bu-fame-dot {
  width: 10px !important;
  height: 10px !important;
  border-radius: 50% !important;
  background: rgba(255, 255, 255, 0.25) !important;
  border: none !important;
  cursor: pointer !important;
  padding: 0 !important;
  transition: all 0.3s ease !important;
  outline: none !important;
}

.bu-fame-dot.active {
  width: 30px !important;
  border-radius: 10px !important;
  background: #FFC107 !important;
  box-shadow: 0 0 10px rgba(255, 193, 7, 0.6) !important;
}

/* Lightbox Modal */
.bu-fame-lightbox {
  position: fixed !important;
  inset: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  background: rgba(2, 6, 26, 0.92) !important;
  backdrop-filter: blur(12px) !important;
  -webkit-backdrop-filter: blur(12px) !important;
  z-index: 999999 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 20px !important;
  opacity: 0 !important;
  visibility: hidden !important;
  transition: opacity 0.28s ease, visibility 0.28s ease !important;
  box-sizing: border-box !important;
}

.bu-fame-lightbox.active {
  opacity: 1 !important;
  visibility: visible !important;
}

.bu-fame-lightbox-dialog {
  max-width: 600px !important;
  width: 100% !important;
  max-height: 92vh !important;
  position: relative !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  transform: scale(0.92) !important;
  transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.bu-fame-lightbox.active .bu-fame-lightbox-dialog {
  transform: scale(1) !important;
}

.bu-fame-lightbox-close {
  position: absolute !important;
  top: -16px !important;
  right: -16px !important;
  width: 38px !important;
  height: 38px !important;
  background: #FFC107 !important;
  color: #061D7C !important;
  border: none !important;
  border-radius: 50% !important;
  font-size: 22px !important;
  font-weight: 700 !important;
  line-height: 1 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  z-index: 10 !important;
  box-shadow: 0 4px 12px rgba(0,0,0,0.5) !important;
  transition: transform 0.2s ease, background 0.2s ease !important;
}

.bu-fame-lightbox-close:hover {
  transform: scale(1.1) rotate(90deg) !important;
  background: #E11D48 !important;
  color: #ffffff !important;
}

.bu-fame-lightbox-img-wrap {
  width: 100% !important;
  max-height: 82vh !important;
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background: #030A28 !important;
  border-radius: 12px !important;
  border: 2px solid rgba(255, 193, 7, 0.45) !important;
  overflow: hidden !important;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7) !important;
}

.bu-fame-lightbox-img {
  max-width: 100% !important;
  max-height: 80vh !important;
  object-fit: contain !important;
  display: block !important;
}

.bu-fame-lightbox-caption {
  color: #ffffff !important;
  font-size: 14px !important;
  font-weight: 600 !important;
  margin-top: 12px !important;
  text-align: center !important;
  text-shadow: 0 2px 8px rgba(0,0,0,0.6) !important;
}

/* ========================================================
   RESPONSIVE BREAKPOINTS FOR ALL DEVICES
   ======================================================== */

/* Small Desktop & Large Tablets (3 Cards) */
@media (max-width: 1179px) and (min-width: 900px) {
  .bu-fame-slide {
    flex: 0 0 33.333% !important;
    max-width: 33.333% !important;
    width: 33.333% !important;
  }
}

/* Medium Tablets & iPads (2 Cards) */
@media (max-width: 899px) and (min-width: 580px) {
  .bu-fame-slide {
    flex: 0 0 50% !important;
    max-width: 50% !important;
    width: 50% !important;
  }
  .bu-fame-side-prev {
    left: -10px !important;
  }
  .bu-fame-side-next {
    right: -10px !important;
  }
  .bu-fame-card {
    height: 370px !important;
  }
  .bu-fame-poster-holder {
    height: 295px !important;
  }
}

/* Mobile Devices & Phones (1 Large Full Card per view) */
@media (max-width: 579px) {
  .bu-fame-section {
    padding: 45px 0 55px 0 !important;
  }
  .bu-fame-container {
    padding: 0 16px !important;
  }
  .bu-fame-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 14px !important;
    margin-bottom: 22px !important;
  }
  .bu-fame-title {
    font-size: 24px !important;
    line-height: 1.22 !important;
  }
  .bu-fame-subtitle {
    font-size: 13px !important;
    line-height: 1.55 !important;
  }
  .bu-fame-header-actions {
    width: 100% !important;
    justify-content: flex-end !important;
    margin-top: 2px !important;
  }
  .bu-fame-ctrl-btn {
    width: 40px !important;
    height: 40px !important;
  }
  
  /* 1 Full-Width Card on Mobile */
  .bu-fame-slide {
    flex: 0 0 100% !important;
    max-width: 100% !important;
    width: 100% !important;
    padding: 0 4px !important;
  }
  .bu-fame-card {
    height: 420px !important;
    max-width: 360px !important;
    margin: 0 auto !important;
  }
  .bu-fame-poster-holder {
    height: 340px !important;
  }
  .bu-fame-card-footer {
    height: 80px !important;
    padding: 10px 14px !important;
  }
  .bu-fame-card-title {
    font-size: 13.5px !important;
  }
  .bu-fame-card-badge {
    font-size: 10px !important;
    padding: 4px 10px !important;
    top: 10px !important;
    left: 10px !important;
  }
  .bu-fame-side-btn {
    display: none !important;
  }
  .bu-fame-lightbox-close {
    top: -12px !important;
    right: -8px !important;
  }
}
</style>
