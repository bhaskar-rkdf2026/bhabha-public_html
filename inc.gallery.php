<?php
// Bhabha University - Homepage Photo Gallery Section
$db->where('is_home', 1);
$db->orderBy("RAND ()");
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
          $thumbImg = !empty($gItem['image']) ? URL_UPLOAD.'gallery/thumb/'.$gItem['image'] : 'new-media/image/school-of-engineering.jpg';
          $largeImg = !empty($gItem['image']) ? URL_UPLOAD.'gallery/large/'.$gItem['image'] : $thumbImg;
          $gTitle   = !empty($gItem['title']) ? htmlspecialchars($gItem['title']) : 'Campus Gallery';
      ?>
      <div class="bu-hg-card">
        <div class="bu-hg-card-inner">
          <img src="<?php echo $thumbImg; ?>" alt="<?php echo $gTitle; ?>" class="bu-hg-img" loading="lazy" onerror="this.src='new-media/image/school-of-engineering.jpg';">
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

<!-- Homepage Lightbox Modal -->
<div class="bu-hg-lightbox" id="buHgLightbox">
  <div class="bu-hg-lightbox-bg"></div>
  <div class="bu-hg-lightbox-box">
    <button class="bu-hg-lightbox-close" id="buHgLightboxClose">&times;</button>
    <img src="" alt="" id="buHgLightboxImg" class="bu-hg-lightbox-img">
    <div class="bu-hg-lightbox-caption" id="buHgLightboxCaption"></div>
  </div>
</div>

<style>
/* ============================================================
   BHABHA UNIVERSITY - HOMEPAGE GALLERY SECTION
   ============================================================ */
.bu-home-gallery-section {
  background-color: #FAF7F2 !important; /* Warm creamy background */
  padding: 85px 20px 95px !important;
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
  border-radius: 3px !important;
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

/* Lightbox Modal */
.bu-hg-lightbox {
  position: fixed !important;
  inset: 0 !important;
  z-index: 99999 !important;
  display: none;
  align-items: center !important;
  justify-content: center !important;
}
.bu-hg-lightbox.active {
  display: flex !important;
}
.bu-hg-lightbox-bg {
  position: absolute !important;
  inset: 0 !important;
  background: rgba(5, 18, 53, 0.88) !important;
  backdrop-filter: blur(6px) !important;
}
.bu-hg-lightbox-box {
  position: relative !important;
  z-index: 2 !important;
  max-width: 90vw !important;
  max-height: 85vh !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
}
.bu-hg-lightbox-img {
  max-width: 90vw !important;
  max-height: 75vh !important;
  border-radius: 4px !important;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5) !important;
  object-fit: contain !important;
}
.bu-hg-lightbox-caption {
  margin-top: 14px !important;
  color: #FFFFFF !important;
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 18px !important;
  font-weight: 700 !important;
  text-align: center !important;
}
.bu-hg-lightbox-close {
  position: absolute !important;
  top: -45px !important;
  right: 0 !important;
  background: transparent !important;
  border: none !important;
  color: #FFFFFF !important;
  font-size: 36px !important;
  cursor: pointer !important;
  line-height: 1 !important;
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
    var closeBtn = document.getElementById('buHgLightboxClose');
    var bgOverlay = document.querySelector('.bu-hg-lightbox-bg');

    document.querySelectorAll('.bu-hg-view-btn').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var largeSrc = btn.getAttribute('data-large');
        var caption  = btn.getAttribute('data-caption');

        if (modalImg) modalImg.src = largeSrc;
        if (modalCaption) modalCaption.textContent = caption;
        if (modal) modal.classList.add('active');
      });
    });

    function closeHgModal() {
      if (modal) modal.classList.remove('active');
    }

    if (closeBtn) closeBtn.addEventListener('click', closeHgModal);
    if (bgOverlay) bgOverlay.addEventListener('click', closeHgModal);
  });
})();
</script>
