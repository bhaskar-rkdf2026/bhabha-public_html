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

  <!-- Lightbox Modal -->
  <div class="bu-lightbox-modal" id="buLightboxModal">
    <div class="bu-lightbox-overlay"></div>
    <div class="bu-lightbox-content">
      <button class="bu-lightbox-close" id="buLightboxClose">&times;</button>
      <img src="" alt="" id="buLightboxImg" class="bu-lightbox-img">
      <div class="bu-lightbox-caption" id="buLightboxCaption"></div>
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
  border-radius: 3px !important;
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
  border-radius: 6px !important;
  overflow: hidden !important;
  background: #FFFFFF !important;
  border: 1px solid #EBE6DE !important;
  box-shadow: 0 4px 16px rgba(11, 37, 69, 0.04) !important;
  transition: all 0.35s ease !important;
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
  border-radius: 2px !important;
  cursor: pointer !important;
  transition: all 0.2s ease !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
}
.bu-gallery-zoom-btn:hover {
  background-color: #FFC107 !important;
}

/* Lightbox Modal */
.bu-lightbox-modal {
  position: fixed !important;
  inset: 0 !important;
  z-index: 99999 !important;
  display: none;
  align-items: center !important;
  justify-content: center !important;
}
.bu-lightbox-modal.active {
  display: flex !important;
}
.bu-lightbox-overlay {
  position: absolute !important;
  inset: 0 !important;
  background: rgba(5, 18, 53, 0.88) !important;
  backdrop-filter: blur(6px) !important;
}
.bu-lightbox-content {
  position: relative !important;
  z-index: 2 !important;
  max-width: 90vw !important;
  max-height: 85vh !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
}
.bu-lightbox-img {
  max-width: 90vw !important;
  max-height: 75vh !important;
  border-radius: 4px !important;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5) !important;
  object-fit: contain !important;
}
.bu-lightbox-caption {
  margin-top: 16px !important;
  color: #FFFFFF !important;
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 20px !important;
  font-weight: 700 !important;
  text-align: center !important;
}
.bu-lightbox-close {
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
    }

    // Filter Buttons Click Handler
    filterBtns.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var filterId = btn.getAttribute('data-filter');
        filterGallery(filterId);
      });
    });

    // Lightbox Handler
    var modal = document.getElementById('buLightboxModal');
    var modalImg = document.getElementById('buLightboxImg');
    var modalCaption = document.getElementById('buLightboxCaption');
    var closeBtn = document.getElementById('buLightboxClose');
    var overlay = document.querySelector('.bu-lightbox-overlay');

    document.querySelectorAll('.bu-gallery-zoom-btn').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var largeSrc = btn.getAttribute('data-large');
        var caption = btn.getAttribute('data-caption');

        modalImg.src = largeSrc;
        modalCaption.textContent = caption;
        modal.classList.add('active');
      });
    });

    function closeModal() {
      modal.classList.remove('active');
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (overlay) overlay.addEventListener('click', closeModal);
  });
})();
</script>
</body>
</html>
