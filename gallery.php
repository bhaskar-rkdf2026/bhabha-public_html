<?php 
include('config.php');

$page_title    = 'Photo Gallery';
$page_subtitle = 'Explore campus life, academic events, cultural fests, and state-of-the-art facilities at Bhabha University.';
$page_icon     = 'fa-camera';
$breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Photo Gallery', 'url' => '#']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Photo Gallery - Bhabha University Bhopal</title>
<meta name="description" content="Explore campus events, academic activities, cultural fests, and facilities at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- INNER HERO BANNER -->
  <?php include('inc.page-banner.php');?>

  <!-- MAIN GALLERY SECTION -->
  <section class="bu-gallery-section">
    <div class="bu-gallery-container">
      
      <!-- Filter Categories -->
      <div class="bu-gallery-filters-wrapper">
        <div class="bu-gallery-filters">
          <button class="bu-filter-btn active" data-filter="all">ALL</button>
          <?php
          $departments = $db->get('department');
          if(is_array($departments) && count($departments) > 0) {
            foreach($departments as $dept) {
              echo '<button class="bu-filter-btn" data-filter="'.$dept['id'].'">'.htmlspecialchars(strtoupper($dept['title'])).'</button>';
            }
          }
          ?>
        </div>
      </div>

      <!-- Gallery Cards Grid -->
      <div class="bu-gallery-grid" id="buGalleryGrid">
        <?php
        $db->orderBy('id', 'desc');
        $gallery = $db->get('gallery');
        if(is_array($gallery) && count($gallery) > 0) {
          foreach($gallery as $item) {
            $deptVal = isset($item['department']) ? trim($item['department']) : '';
            
            // Image fallback path check
            $thumbUrl = !empty($item['image']) ? URL_UPLOAD.'gallery/thumb/'.$item['image'] : URL_ROOT.'new-media/image/school-of-engineering.jpg';
            $largeUrl = !empty($item['image']) ? URL_UPLOAD.'gallery/large/'.$item['image'] : $thumbUrl;
            $title = !empty($item['title']) ? htmlspecialchars($item['title']) : 'Campus Life Gallery';
        ?>
        <div class="bu-gallery-card dept-<?php echo $deptVal; ?>" data-dept="<?php echo htmlspecialchars($deptVal); ?>">
          <div class="bu-gallery-card-inner">
            <img src="<?php echo $thumbUrl; ?>" alt="<?php echo $title; ?>" class="bu-gallery-img" loading="lazy" onerror="this.src='<?php echo URL_ROOT;?>new-media/image/school-of-engineering.jpg';">
            <div class="bu-gallery-overlay">
              <div class="bu-gallery-info">
                <h4 class="bu-gallery-title"><?php echo $title; ?></h4>
                <button class="bu-gallery-zoom-btn" data-large="<?php echo $largeUrl; ?>" data-caption="<?php echo $title; ?>">
                  <i class="fa fa-search-plus"></i> View Image
                </button>
              </div>
            </div>
          </div>
        </div>
        <?php 
          }
        } else {
          echo '<div class="bu-no-data"><p>No gallery images found.</p></div>';
        }
        ?>
      </div>

    </div>
  </section>

  <!-- Lightbox Modal with Full Navigation -->
  <div class="bu-lightbox-modal" id="buLightboxModal" role="dialog" aria-modal="true" aria-label="Photo Gallery Viewer">
    <div class="bu-lightbox-overlay" id="buLightboxOverlay"></div>
    <div class="bu-lightbox-content">
      <div class="bu-lightbox-topbar">
        <span class="bu-lightbox-counter" id="buLightboxCounter">Photo 1 of 1</span>
        <button type="button" class="bu-lightbox-close" id="buLightboxClose" aria-label="Close Lightbox">&times;</button>
      </div>
      
      <div class="bu-lightbox-stage">
        <button type="button" class="bu-lightbox-nav bu-lightbox-prev" id="buLightboxPrev" aria-label="Previous Photo">
          <i class="fa fa-chevron-left"></i>
        </button>

        <div class="bu-lightbox-img-wrap" id="buLightboxImgWrap">
          <img src="" alt="" id="buLightboxImg" class="bu-lightbox-img">
        </div>

        <button type="button" class="bu-lightbox-nav bu-lightbox-next" id="buLightboxNext" aria-label="Next Photo">
          <i class="fa fa-chevron-right"></i>
        </button>
      </div>

      <div class="bu-lightbox-caption-wrap">
        <div class="bu-lightbox-caption" id="buLightboxCaption"></div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include('inc.footer.php');?>
</div>

<!-- STYLES -->
<style>
.bu-gallery-section {
  background-color: #FAF7F2 !important; /* Soft warm light cream */
  padding: 65px 20px 90px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-gallery-container {
  max-width: 1240px !important;
  margin: 0 auto !important;
}

/* Category Filter Buttons */
.bu-gallery-filters-wrapper {
  margin-bottom: 45px !important;
  width: 100% !important;
  display: flex !important;
  justify-content: center !important;
}
.bu-gallery-filters {
  display: flex !important;
  flex-wrap: wrap !important;
  gap: 8px !important;
  justify-content: center !important;
  align-items: center !important;
}
.bu-filter-btn {
  background-color: #FFFFFF !important;
  border: 1px solid #D5D0C7 !important;
  color: #0B2545 !important;
  font-size: 11px !important;
  font-weight: 700 !important;
  letter-spacing: 0.6px !important;
  padding: 9px 18px !important;
  cursor: pointer !important;
  transition: all 0.22s ease !important;
  border-radius: 4px !important;
  text-transform: uppercase !important;
  outline: none !important;
}
.bu-filter-btn:hover {
  background-color: rgba(11, 37, 69, 0.05) !important;
  border-color: #0B2545 !important;
}
.bu-filter-btn.active {
  background-color: #0B2545 !important;
  border-color: #0B2545 !important;
  color: #FFFFFF !important;
  font-weight: 800 !important;
  box-shadow: 0 4px 12px rgba(11, 37, 69, 0.15) !important;
}

/* Gallery Grid */
.bu-gallery-grid {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 24px !important;
  width: 100% !important;
}

/* Gallery Card */
.bu-gallery-card {
  border-radius: 8px !important;
  overflow: hidden !important;
  background: #FFFFFF !important;
  border: 1px solid #EBE6DE !important;
  box-shadow: 0 4px 16px rgba(11, 37, 69, 0.04) !important;
  transition: all 0.35s ease !important;
  cursor: pointer !important;
}
.bu-gallery-card.bu-hidden {
  display: none !important;
}
.bu-gallery-card:hover {
  transform: translateY(-5px) !important;
  box-shadow: 0 16px 36px rgba(11, 37, 69, 0.14) !important;
  border-color: #D99B00 !important;
}

.bu-gallery-card-inner {
  position: relative !important;
  width: 100% !important;
  height: 260px !important;
  overflow: hidden !important;
}
.bu-gallery-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.5s ease !important;
}
.bu-gallery-card:hover .bu-gallery-img {
  transform: scale(1.08) !important;
}

/* Hover Overlay */
.bu-gallery-overlay {
  position: absolute !important;
  inset: 0 !important;
  background: linear-gradient(to top, rgba(11, 37, 69, 0.92) 0%, rgba(11, 37, 69, 0.4) 60%, transparent 100%) !important;
  opacity: 0 !important;
  transition: opacity 0.35s ease !important;
  display: flex !important;
  align-items: flex-end !important;
  padding: 24px !important;
}
.bu-gallery-card:hover .bu-gallery-overlay {
  opacity: 1 !important;
}

.bu-gallery-info {
  width: 100% !important;
  color: #FFFFFF !important;
}
.bu-gallery-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 18px !important;
  font-weight: 700 !important;
  color: #FFFFFF !important;
  margin: 0 0 12px 0 !important;
  line-height: 1.3 !important;
}
.bu-gallery-zoom-btn {
  background-color: #D99B00 !important;
  color: #0B2545 !important;
  border: none !important;
  padding: 8px 16px !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 0.5px !important;
  border-radius: 4px !important;
  cursor: pointer !important;
  transition: all 0.2s ease !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
}
.bu-gallery-zoom-btn:hover {
  background-color: #FFC107 !important;
}

/* ================================================================
   MODERN INTERACTIVE LIGHTBOX MODAL WITH NAVIGATION CONTROLS
   ================================================================ */
.bu-lightbox-modal {
  position: fixed !important;
  inset: 0 !important;
  z-index: 999999 !important;
  display: none;
  align-items: center !important;
  justify-content: center !important;
  opacity: 0;
  transition: opacity 0.28s ease;
}
.bu-lightbox-modal.active {
  display: flex !important;
  opacity: 1 !important;
}
.bu-lightbox-overlay {
  position: absolute !important;
  inset: 0 !important;
  background: rgba(4, 15, 74, 0.94) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
  cursor: pointer;
}
.bu-lightbox-content {
  position: relative !important;
  z-index: 2 !important;
  width: 96vw !important;
  max-width: 1140px !important;
  max-height: 94vh !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
  pointer-events: auto;
}
.bu-lightbox-topbar {
  width: 100% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  padding: 0 10px 10px !important;
  box-sizing: border-box !important;
}
.bu-lightbox-counter {
  color: #FFC107 !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  letter-spacing: 0.6px !important;
  background: rgba(255, 255, 255, 0.12) !important;
  padding: 5px 14px !important;
  border-radius: 20px !important;
  border: 1px solid rgba(255, 193, 7, 0.4) !important;
}
.bu-lightbox-close {
  background: rgba(255, 255, 255, 0.12) !important;
  border: 1px solid rgba(255, 255, 255, 0.25) !important;
  color: #FFFFFF !important;
  font-size: 26px !important;
  width: 40px !important;
  height: 40px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  line-height: 1 !important;
  transition: all 0.2s ease !important;
}
.bu-lightbox-close:hover {
  background: #EF4444 !important;
  border-color: #EF4444 !important;
  transform: rotate(90deg) scale(1.08) !important;
}

.bu-lightbox-stage {
  position: relative !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  width: 100% !important;
}
.bu-lightbox-img-wrap {
  max-width: calc(100% - 130px) !important;
  max-height: 72vh !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  overflow: hidden !important;
  border-radius: 8px !important;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.65) !important;
  border: 2px solid rgba(255, 255, 255, 0.2) !important;
  background: #000000 !important;
}
.bu-lightbox-img {
  max-width: 100% !important;
  max-height: 72vh !important;
  width: auto !important;
  height: auto !important;
  object-fit: contain !important;
  display: block !important;
  transition: opacity 0.22s ease, transform 0.22s ease !important;
}
.bu-lightbox-img.changing {
  opacity: 0.2 !important;
  transform: scale(0.97) !important;
}

.bu-lightbox-nav {
  position: absolute !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  width: 48px !important;
  height: 48px !important;
  border-radius: 50% !important;
  background: rgba(10, 27, 84, 0.85) !important;
  border: 1px solid rgba(255, 255, 255, 0.35) !important;
  color: #FFFFFF !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: 18px !important;
  cursor: pointer !important;
  z-index: 10 !important;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4) !important;
  transition: all 0.22s ease !important;
}
.bu-lightbox-prev {
  left: 0 !important;
}
.bu-lightbox-next {
  right: 0 !important;
}
.bu-lightbox-nav:hover {
  background: #FFC107 !important;
  color: #0A1B54 !important;
  border-color: #FFC107 !important;
  transform: translateY(-50%) scale(1.1) !important;
}
.bu-lightbox-caption-wrap {
  margin-top: 14px !important;
  text-align: center !important;
  max-width: 85% !important;
}
.bu-lightbox-caption {
  color: #FFFFFF !important;
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 19px !important;
  font-weight: 700 !important;
  line-height: 1.3 !important;
  letter-spacing: 0.3px !important;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8) !important;
}

@media (max-width: 768px) {
  .bu-lightbox-img-wrap {
    max-width: 100% !important;
    max-height: 64vh !important;
  }
  .bu-lightbox-img {
    max-height: 64vh !important;
  }
  .bu-lightbox-nav {
    width: 38px !important;
    height: 38px !important;
    font-size: 14px !important;
    background: rgba(10, 27, 84, 0.9) !important;
  }
  .bu-lightbox-prev { left: 4px !important; }
  .bu-lightbox-next { right: 4px !important; }
  .bu-lightbox-caption {
    font-size: 15px !important;
  }
  .bu-lightbox-counter {
    font-size: 11.5px !important;
    padding: 4px 10px !important;
  }
}

/* Responsive Grid */
@media (max-width: 991px) {
  .bu-gallery-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 18px !important;
  }
}
@media (max-width: 580px) {
  .bu-gallery-grid {
    grid-template-columns: 1fr !important;
  }
  .bu-gallery-filters {
    gap: 6px !important;
  }
  .bu-filter-btn {
    padding: 7px 14px !important;
    font-size: 10px !important;
  }
}
</style>

<!-- SCRIPTS -->
<?php include('inc.footer.js.php');?>
<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {
    var filterBtns = document.querySelectorAll('.bu-filter-btn');
    var galleryCards = document.querySelectorAll('.bu-gallery-card');

    // Lightbox Elements
    var modal = document.getElementById('buLightboxModal');
    var modalImg = document.getElementById('buLightboxImg');
    var modalCaption = document.getElementById('buLightboxCaption');
    var modalCounter = document.getElementById('buLightboxCounter');
    var closeBtn = document.getElementById('buLightboxClose');
    var overlay = document.getElementById('buLightboxOverlay');
    var prevBtn = document.getElementById('buLightboxPrev');
    var nextBtn = document.getElementById('buLightboxNext');

    var currentVisibleItems = [];
    var currentIndex = 0;

    // Collect currently visible photos for navigation
    function updateVisibleItems() {
      currentVisibleItems = [];
      galleryCards.forEach(function (card) {
        if (!card.classList.contains('bu-hidden') && card.style.display !== 'none') {
          var btn = card.querySelector('.bu-gallery-zoom-btn');
          if (btn) {
            currentVisibleItems.push({
              large: btn.getAttribute('data-large'),
              caption: btn.getAttribute('data-caption') || card.querySelector('.bu-gallery-title')?.textContent || 'Photo Gallery'
            });
          }
        }
      });
    }

    function filterGallery(filterId) {
      filterId = String(filterId || '').trim().toLowerCase();

      filterBtns.forEach(function (b) {
        var bFilter = String(b.getAttribute('data-filter') || '').trim().toLowerCase();
        if (bFilter === filterId) {
          b.classList.add('active');
        } else {
          b.classList.remove('active');
        }
      });

      galleryCards.forEach(function (card) {
        var cardDept = String(card.getAttribute('data-dept') || '').trim().toLowerCase();
        var isMatch = (
          filterId === 'all' ||
          cardDept === filterId ||
          card.classList.contains('dept-' + filterId) ||
          card.classList.contains(filterId)
        );

        if (isMatch) {
          card.classList.remove('bu-hidden');
          card.style.setProperty('display', 'block', 'important');
        } else {
          card.classList.add('bu-hidden');
          card.style.setProperty('display', 'none', 'important');
        }
      });

      updateVisibleItems();
    }

    // Filter Buttons Click Handler
    filterBtns.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var filterId = btn.getAttribute('data-filter');
        filterGallery(filterId);
      });
    });

    // Display image at specific index in Lightbox
    function showLightboxImage(index) {
      if (!currentVisibleItems.length) return;

      if (index < 0) {
        index = currentVisibleItems.length - 1;
      } else if (index >= currentVisibleItems.length) {
        index = 0;
      }

      currentIndex = index;
      var item = currentVisibleItems[currentIndex];

      // Smooth fade transition
      modalImg.classList.add('changing');
      setTimeout(function() {
        modalImg.src = item.large;
        modalCaption.textContent = item.caption;
        if (modalCounter) {
          modalCounter.textContent = 'Photo ' + (currentIndex + 1) + ' of ' + currentVisibleItems.length;
        }
        modalImg.onload = function() {
          modalImg.classList.remove('changing');
        };
        setTimeout(function() {
          modalImg.classList.remove('changing');
        }, 150);
      }, 100);
    }

    function openLightbox(largeSrc) {
      updateVisibleItems();
      var foundIndex = currentVisibleItems.findIndex(function(it) {
        return it.large === largeSrc;
      });

      if (foundIndex !== -1) {
        currentIndex = foundIndex;
      } else {
        currentIndex = 0;
      }

      showLightboxImage(currentIndex);
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    // Bind Zoom Button and Card Click
    galleryCards.forEach(function (card) {
      card.addEventListener('click', function (e) {
        // Prevent double trigger if clicking zoom btn
        var btn = card.querySelector('.bu-gallery-zoom-btn');
        if (btn) {
          e.preventDefault();
          openLightbox(btn.getAttribute('data-large'));
        }
      });
    });

    // Prev / Next Button Clicks
    if (prevBtn) {
      prevBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        showLightboxImage(currentIndex - 1);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        showLightboxImage(currentIndex + 1);
      });
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (overlay) overlay.addEventListener('click', closeModal);

    // Keyboard Navigation (Left/Right Arrows, ESC)
    document.addEventListener('keydown', function (e) {
      if (!modal.classList.contains('active')) return;

      if (e.key === 'ArrowLeft' || e.keyCode === 37) {
        e.preventDefault();
        showLightboxImage(currentIndex - 1);
      } else if (e.key === 'ArrowRight' || e.keyCode === 39) {
        e.preventDefault();
        showLightboxImage(currentIndex + 1);
      } else if (e.key === 'Escape' || e.keyCode === 27) {
        e.preventDefault();
        closeModal();
      }
    });

    // Touch Swipe Gesture for Mobile
    var touchStartX = 0;
    var touchEndX = 0;
    var stage = document.querySelector('.bu-lightbox-stage');
    if (stage) {
      stage.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      stage.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        if (touchStartX - touchEndX > 45) {
          showLightboxImage(currentIndex + 1); // Swipe Left -> Next
        } else if (touchEndX - touchStartX > 45) {
          showLightboxImage(currentIndex - 1); // Swipe Right -> Prev
        }
      }, { passive: true });
    }

    // Initial populate
    updateVisibleItems();
  });
})();
</script>
</body>
</html>
