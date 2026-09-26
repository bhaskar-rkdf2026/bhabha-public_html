<?php
// Bhabha University - Homepage Photo Gallery Section
$db->where('is_home', 1);
$db->orderBy('id', 'desc');
$homeGallery = $db->get('gallery', 8);
?>
<section class="bu-home-gallery-section" id="buHomeGallery">
  <div class="bu-home-gallery-container">
    
    <!-- Section Header -->
    <div class="bu-home-gallery-header">
      <span class="bu-home-gallery-badge">
        <span class="bu-home-gallery-dot"></span>
        LIFE AT BHABHA &nbsp;·&nbsp; PHOTO GALLERY
      </span>
      <h2 class="bu-home-gallery-title">Capturing Moments &amp; Campus Excellence</h2>
      <p class="bu-home-gallery-sub">
        A glimpse into our vibrant academic life, cultural celebrations, research labs, and student achievements across Bhabha University.
      </p>
    </div>

    <!-- Gallery Grid -->
    <div class="bu-home-gallery-grid">
      <?php
      if (is_array($homeGallery) && count($homeGallery) > 0) {
        foreach ($homeGallery as $gItem) {
          $thumbImg = !empty($gItem['image']) ? URL_UPLOAD.'gallery/thumb/'.$gItem['image'] : URL_ROOT.'new-media/image/school-of-engineering.jpg';
          $largeImg = !empty($gItem['image']) ? URL_UPLOAD.'gallery/large/'.$gItem['image'] : $thumbImg;
          $gTitle   = !empty($gItem['title']) ? htmlspecialchars($gItem['title']) : 'Campus Gallery';
      ?>
      <div class="bu-hg-card">
        <div class="bu-hg-card-inner">
          <img loading="lazy" src="<?php echo $thumbImg; ?>" alt="<?php echo $gTitle; ?>" class="bu-hg-img" loading="lazy" onerror="this.src='<?php echo URL_ROOT;?>new-media/image/school-of-engineering.jpg';">
          <div class="bu-hg-overlay">
            <div class="bu-hg-info">
              <h4 class="bu-hg-item-title"><?php echo $gTitle; ?></h4>
              <button class="bu-hg-view-btn" data-large="<?php echo $largeImg; ?>" data-caption="<?php echo $gTitle; ?>">
                <i class="fa fa-search-plus"></i> View Image
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      } else {
        echo '<div class="bu-hg-empty"><p>Gallery items coming soon.</p></div>';
      }
      ?>
    </div>

    <!-- Action Button -->
    <div class="bu-home-gallery-action">
      <a href="<?php echo href('gallery.php'); ?>" class="bu-hg-cta-btn">
        EXPLORE FULL GALLERY &nbsp;&rarr;
      </a>
    </div>

  </div>
</section>

<!-- Homepage Lightbox Modal with Full Navigation -->
<div class="bu-hg-lightbox" id="buHgLightbox" role="dialog" aria-modal="true" aria-label="Campus Photo Viewer">
  <div class="bu-hg-lightbox-bg" id="buHgLightboxBg"></div>
  <div class="bu-hg-lightbox-box">
    <div class="bu-hg-lightbox-topbar">
      <span class="bu-hg-lightbox-counter" id="buHgLightboxCounter">Photo 1 of 1</span>
      <button type="button" class="bu-hg-lightbox-close" id="buHgLightboxClose" aria-label="Close Lightbox">&times;</button>
    </div>

    <div class="bu-hg-lightbox-stage">
      <button type="button" class="bu-hg-lightbox-nav bu-hg-lightbox-prev" id="buHgLightboxPrev" aria-label="Previous Photo">
        <i class="fa fa-chevron-left"></i>
      </button>

      <div class="bu-hg-lightbox-img-wrap" id="buHgLightboxImgWrap">
        <img loading="lazy" src="" alt="" id="buHgLightboxImg" class="bu-hg-lightbox-img">
      </div>

      <button type="button" class="bu-hg-lightbox-nav bu-hg-lightbox-next" id="buHgLightboxNext" aria-label="Next Photo">
        <i class="fa fa-chevron-right"></i>
      </button>
    </div>

    <div class="bu-hg-lightbox-caption-wrap">
      <div class="bu-hg-lightbox-caption" id="buHgLightboxCaption"></div>
    </div>
  </div>
</div>

<style>
/* ============================================================
   BHABHA UNIVERSITY - HOMEPAGE GALLERY SECTION
   ============================================================ */
.bu-home-gallery-section {
  background-color: #FAF7F2 !important; /* Warm creamy background */
  padding: 30px 20px 30px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
  position: relative !important;
}
.bu-home-gallery-container {
  max-width: 1240px !important;
  margin: 0 auto !important;
}

/* Header */
.bu-home-gallery-header {
  text-align: center !important;
  max-width: 720px !important;
  margin: 0 auto 50px auto !important;
}
.bu-home-gallery-badge {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.2px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 12px !important;
}
.bu-home-gallery-dot {
  width: 7px !important;
  height: 7px !important;
  background-color: #D99B00 !important;
  border-radius: 50% !important;
  display: inline-block !important;
}
.bu-home-gallery-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(28px, 3.4vw, 42px) !important;
  font-weight: 800 !important;
  color: #0B2545 !important;
  margin: 0 0 16px 0 !important;
  line-height: 1.2 !important;
}
.bu-home-gallery-sub {
  font-size: 15px !important;
  color: #556070 !important;
  line-height: 1.65 !important;
  margin: 0 !important;
}

/* Gallery Grid */
.bu-home-gallery-grid {
  display: grid !important;
  grid-template-columns: repeat(4, 1fr) !important;
  gap: 20px !important;
  width: 100% !important;
  margin-bottom: 45px !important;
}

/* Card */
.bu-hg-card {
  border-radius: 8px !important;
  overflow: hidden !important;
  background: #FFFFFF !important;
  border: 1px solid #EBE6DE !important;
  box-shadow: 0 4px 16px rgba(11, 37, 69, 0.05) !important;
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
  cursor: pointer !important;
}
.bu-hg-card:hover {
  transform: translateY(-6px) !important;
  box-shadow: 0 18px 38px rgba(11, 37, 69, 0.14) !important;
  border-color: #D99B00 !important;
}
.bu-hg-card-inner {
  position: relative !important;
  width: 100% !important;
  height: 240px !important;
  overflow: hidden !important;
  background: #0B2545 !important; /* Dark background for letterboxing */
}
.bu-hg-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.5s ease !important;
}
.bu-hg-card:hover .bu-hg-img {
  transform: scale(1.09) !important;
}

/* Overlay */
.bu-hg-overlay {
  position: absolute !important;
  inset: 0 !important;
  background: linear-gradient(to top, rgba(11, 37, 69, 0.94) 0%, rgba(11, 37, 69, 0.35) 65%, transparent 100%) !important;
  opacity: 0 !important;
  transition: opacity 0.35s ease !important;
  display: flex !important;
  align-items: flex-end !important;
  padding: 20px !important;
}
.bu-hg-card:hover .bu-hg-overlay {
  opacity: 1 !important;
}
.bu-hg-info {
  width: 100% !important;
}
.bu-hg-item-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 16px !important;
  font-weight: 700 !important;
  color: #FFFFFF !important;
  margin: 0 0 10px 0 !important;
  line-height: 1.3 !important;
}
.bu-hg-view-btn {
  background-color: #D99B00 !important;
  color: #0B2545 !important;
  border: none !important;
  padding: 7px 14px !important;
  font-size: 10.5px !important;
  font-weight: 800 !important;
  letter-spacing: 0.5px !important;
  border-radius: 4px !important;
  cursor: pointer !important;
  transition: background 0.2s ease !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 5px !important;
}
.bu-hg-view-btn:hover {
  background-color: #FFC107 !important;
}

/* CTA Button */
.bu-home-gallery-action {
  text-align: center !important;
}
.bu-hg-cta-btn {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  background-color: #0B2545 !important;
  color: #FFFFFF !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  letter-spacing: 1.2px !important;
  padding: 14px 34px !important;
  border-radius: 4px !important;
  text-decoration: none !important;
  transition: all 0.25s ease !important;
  box-shadow: 0 4px 14px rgba(11, 37, 69, 0.18) !important;
}
.bu-hg-cta-btn:hover {
  background-color: #D99B00 !important;
  color: #0B2545 !important;
  box-shadow: 0 6px 20px rgba(217, 155, 0, 0.35) !important;
  transform: translateY(-2px) !important;
}

/* ============================================================
   INTERACTIVE LIGHTBOX MODAL WITH FULL CONTROLS
   ============================================================ */
.bu-hg-lightbox {
  position: fixed !important;
  inset: 0 !important;
  z-index: 999999 !important;
  display: none;
  align-items: center !important;
  justify-content: center !important;
  opacity: 0;
  transition: opacity 0.28s ease;
}
.bu-hg-lightbox.active {
  display: flex !important;
  opacity: 1 !important;
}
.bu-hg-lightbox-bg {
  position: absolute !important;
  inset: 0 !important;
  background: rgba(4, 15, 74, 0.94) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
  cursor: pointer;
}
.bu-hg-lightbox-box {
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
.bu-hg-lightbox-topbar {
  width: 100% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  padding: 0 10px 10px !important;
  box-sizing: border-box !important;
}
.bu-hg-lightbox-counter {
  color: #FFC107 !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  letter-spacing: 0.6px !important;
  background: rgba(255, 255, 255, 0.12) !important;
  padding: 5px 14px !important;
  border-radius: 20px !important;
  border: 1px solid rgba(255, 193, 7, 0.4) !important;
}
.bu-hg-lightbox-close {
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
.bu-hg-lightbox-close:hover {
  background: #EF4444 !important;
  border-color: #EF4444 !important;
  transform: rotate(90deg) scale(1.08) !important;
}

.bu-hg-lightbox-stage {
  position: relative !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  width: 100% !important;
}
.bu-hg-lightbox-img-wrap {
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
.bu-hg-lightbox-img {
  max-width: 100% !important;
  max-height: 72vh !important;
  width: auto !important;
  height: auto !important;
  object-fit: contain !important;
  display: block !important;
  transition: opacity 0.22s ease, transform 0.22s ease !important;
}
.bu-hg-lightbox-img.changing {
  opacity: 0.2 !important;
  transform: scale(0.97) !important;
}

.bu-hg-lightbox-nav {
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
.bu-hg-lightbox-prev {
  left: 0 !important;
}
.bu-hg-lightbox-next {
  right: 0 !important;
}
.bu-hg-lightbox-nav:hover {
  background: #FFC107 !important;
  color: #0A1B54 !important;
  border-color: #FFC107 !important;
  transform: translateY(-50%) scale(1.1) !important;
}
.bu-hg-lightbox-caption-wrap {
  margin-top: 14px !important;
  text-align: center !important;
  max-width: 85% !important;
}
.bu-hg-lightbox-caption {
  color: #FFFFFF !important;
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 19px !important;
  font-weight: 700 !important;
  line-height: 1.3 !important;
  letter-spacing: 0.3px !important;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8) !important;
}

@media (max-width: 768px) {
  .bu-hg-lightbox-img-wrap {
    max-width: 100% !important;
    max-height: 64vh !important;
  }
  .bu-hg-lightbox-img {
    max-height: 64vh !important;
  }
  .bu-hg-lightbox-nav {
    width: 38px !important;
    height: 38px !important;
    font-size: 14px !important;
    background: rgba(10, 27, 84, 0.9) !important;
  }
  .bu-hg-lightbox-prev { left: 4px !important; }
  .bu-hg-lightbox-next { right: 4px !important; }
  .bu-hg-lightbox-caption {
    font-size: 15px !important;
  }
  .bu-hg-lightbox-counter {
    font-size: 11.5px !important;
    padding: 4px 10px !important;
  }
}

/* Responsive */
@media (max-width: 1024px) {
  .bu-home-gallery-grid {
    grid-template-columns: repeat(3, 1fr) !important;
  }
}
@media (max-width: 768px) {
  .bu-home-gallery-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 16px !important;
  }
  .bu-home-gallery-section {
    padding: 60px 15px 70px !important;
  }
}
@media (max-width: 480px) {
  .bu-home-gallery-grid {
    grid-template-columns: 1fr !important;
  }
}
</style>

<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('buHgLightbox');
    var modalImg = document.getElementById('buHgLightboxImg');
    var modalCaption = document.getElementById('buHgLightboxCaption');
    var modalCounter = document.getElementById('buHgLightboxCounter');
    var closeBtn = document.getElementById('buHgLightboxClose');
    var bgOverlay = document.getElementById('buHgLightboxBg');
    var prevBtn = document.getElementById('buHgLightboxPrev');
    var nextBtn = document.getElementById('buHgLightboxNext');
    var cards = document.querySelectorAll('.bu-hg-card');

    var items = [];
    var currentIndex = 0;

    cards.forEach(function (card) {
      var btn = card.querySelector('.bu-hg-view-btn');
      if (btn) {
        items.push({
          large: btn.getAttribute('data-large'),
          caption: btn.getAttribute('data-caption') || card.querySelector('.bu-hg-item-title')?.textContent || 'Campus Gallery'
        });
      }
    });

    function showHgImage(index) {
      if (!items.length) return;

      if (index < 0) {
        index = items.length - 1;
      } else if (index >= items.length) {
        index = 0;
      }

      currentIndex = index;
      var item = items[currentIndex];

      modalImg.classList.add('changing');
      setTimeout(function() {
        modalImg.src = item.large;
        modalCaption.textContent = item.caption;
        if (modalCounter) {
          modalCounter.textContent = 'Photo ' + (currentIndex + 1) + ' of ' + items.length;
        }
        modalImg.onload = function() {
          modalImg.classList.remove('changing');
        };
        setTimeout(function() {
          modalImg.classList.remove('changing');
        }, 150);
      }, 100);
    }

    function openHgModal(largeSrc) {
      var foundIndex = items.findIndex(function(it) {
        return it.large === largeSrc;
      });

      if (foundIndex !== -1) {
        currentIndex = foundIndex;
      } else {
        currentIndex = 0;
      }

      showHgImage(currentIndex);
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeHgModal() {
      if (modal) modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    cards.forEach(function (card) {
      card.addEventListener('click', function (e) {
        var btn = card.querySelector('.bu-hg-view-btn');
        if (btn) {
          e.preventDefault();
          openHgModal(btn.getAttribute('data-large'));
        }
      });
    });

    if (prevBtn) {
      prevBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        showHgImage(currentIndex - 1);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        showHgImage(currentIndex + 1);
      });
    }

    if (closeBtn) closeBtn.addEventListener('click', closeHgModal);
    if (bgOverlay) bgOverlay.addEventListener('click', closeHgModal);

    document.addEventListener('keydown', function (e) {
      if (!modal || !modal.classList.contains('active')) return;

      if (e.key === 'ArrowLeft' || e.keyCode === 37) {
        e.preventDefault();
        showHgImage(currentIndex - 1);
      } else if (e.key === 'ArrowRight' || e.keyCode === 39) {
        e.preventDefault();
        showHgImage(currentIndex + 1);
      } else if (e.key === 'Escape' || e.keyCode === 27) {
        e.preventDefault();
        closeHgModal();
      }
    });

    var touchStartX = 0;
    var touchEndX = 0;
    var stage = document.querySelector('.bu-hg-lightbox-stage');
    if (stage) {
      stage.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      stage.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        if (touchStartX - touchEndX > 45) {
          showHgImage(currentIndex + 1);
        } else if (touchEndX - touchStartX > 45) {
          showHgImage(currentIndex - 1);
        }
      }, { passive: true });
    }
  });
})();
</script>

