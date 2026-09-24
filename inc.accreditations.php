<?php
// Bhabha University – Statutory Approvals Component
$accred_items = [
    [
        'img'  => 'ugc.png',
        'alt'  => 'UGC',
        'name' => 'UGC',
        'desc' => '2(f) & 12(B)'
    ],
    [
        'img'  => 'naac.png',
        'alt'  => 'NAAC',
        'name' => 'NAAC',
        'desc' => 'Accredited'
    ],
    [
        'img'  => 'AICT.png',
        'alt'  => 'AICTE',
        'name' => 'AICTE',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'PCI.png',
        'alt'  => 'PCI',
        'name' => 'PCI',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'bci.png',
        'alt'  => 'BCI',
        'name' => 'BCI',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'dci.png',
        'alt'  => 'DCI',
        'name' => 'DCI',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'nci.png',
        'alt'  => 'NCTE',
        'name' => 'NCTE',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'MPNRC.png',
        'alt'  => 'MPNRC',
        'name' => 'MPNRC',
        'desc' => 'Recognized'
    ]
];
?>
<!-- =================== STATUTORY APPROVALS SECTION =================== -->
<section class="bu-statutory-section">
  <div class="bu-statutory-container">
    <span class="bu-accred-section-label">Statutory Approvals</span>
    <h2 class="bu-stat-title">Recognised by <em>leading bodies.</em></h2>
    
    <!-- Marquee Slider Container (Auto-slides on mobile, 8-col grid on desktop) -->
    <div class="bu-accred-slider-wrap">
      <div class="bu-accred-track">
        <!-- Set 1 -->
        <?php foreach ($accred_items as $item): ?>
          <div class="bu-accred-badge">
            <img src="<?php echo URL_IMG . $item['img']; ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>" class="bu-accred-logo" onerror="this.style.display='none';">
            <span class="bu-accred-badge-name"><?php echo htmlspecialchars($item['name']); ?></span>
            <span class="bu-accred-badge-desc"><?php echo htmlspecialchars($item['desc']); ?></span>
          </div>
        <?php endforeach; ?>

        <!-- Set 2 (Duplicate for Seamless Infinite Auto-Scroll on Mobile) -->
        <?php foreach ($accred_items as $item): ?>
          <div class="bu-accred-badge bu-accred-duplicate">
            <img src="<?php echo URL_IMG . $item['img']; ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>" class="bu-accred-logo" onerror="this.style.display='none';">
            <span class="bu-accred-badge-name"><?php echo htmlspecialchars($item['name']); ?></span>
            <span class="bu-accred-badge-desc"><?php echo htmlspecialchars($item['desc']); ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<!-- ===== STYLES ===== -->
<style>
.bu-statutory-section {
  background: #FFFFFF;
  padding: 65px 20px 75px 20px;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
  font-family: 'Plus Jakarta Sans', sans-serif;
  overflow: hidden;
}
.bu-statutory-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 10px;
  text-align: center;
}
.bu-accred-section-label {
  display: inline-block;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #D99B00;
  text-transform: uppercase;
  margin-bottom: 12px;
  background: rgba(255, 193, 7, 0.15);
  padding: 6px 18px;
  border-radius: 30px;
  border: 1px solid rgba(255, 193, 7, 0.3);
}
.bu-stat-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(28px, 3.8vw, 46px);
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 32px 0;
  line-height: 1.15;
}
.bu-stat-title em {
  font-style: italic;
  color: #D99B00;
}

/* DESKTOP (8-Column Grid) */
.bu-accred-slider-wrap {
  width: 100%;
  overflow: visible;
}
.bu-accred-track {
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 12px;
  width: 100%;
}
.bu-accred-duplicate {
  display: none !important;
}

.bu-accred-badge {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 18px 8px;
  text-align: center;
  box-shadow: 0 4px 16px rgba(6, 29, 124, 0.06);
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 6px;
  width: 100%;
  box-sizing: border-box;
}
.bu-accred-badge:hover {
  box-shadow: 0 14px 30px rgba(6, 29, 124, 0.14);
  transform: translateY(-4px);
  border-color: #FFC107;
}
.bu-accred-logo {
  height: 52px;
  width: auto;
  max-width: 85px;
  object-fit: contain;
  margin-bottom: 2px;
  image-rendering: -webkit-optimize-contrast;
  filter: contrast(1.08) brightness(1.02);
  transition: transform 0.3s ease;
}
.bu-accred-badge:hover .bu-accred-logo {
  transform: scale(1.06);
}
.bu-accred-badge-name {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 16px;
  font-weight: 800;
  color: #061D7C;
  display: block;
  line-height: 1;
}
.bu-accred-badge-desc {
  font-size: 9.5px;
  font-weight: 800;
  letter-spacing: 1px;
  color: #9CA3AF;
  text-transform: uppercase;
}

/* MOBILE & TABLET (Smooth Continuous Auto-Slide Marquee) */
@media (max-width: 991px) {
  .bu-statutory-section {
    padding: 42px 0 48px 0 !important;
  }
  .bu-stat-title {
    margin-bottom: 24px !important;
    padding: 0 16px !important;
  }
  .bu-accred-slider-wrap {
    overflow: hidden !important;
    width: 100% !important;
    mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
    padding: 8px 0 !important;
  }
  .bu-accred-track {
    display: flex !important;
    width: max-content !important;
    gap: 14px !important;
    animation: buAccredMarquee 18s linear infinite !important;
    will-change: transform !important;
  }
  .bu-accred-track:hover,
  .bu-accred-track:active {
    animation-play-state: paused !important;
  }
  .bu-accred-duplicate {
    display: flex !important;
  }
  .bu-accred-badge {
    width: 135px !important;
    min-width: 135px !important;
    max-width: 135px !important;
    flex-shrink: 0 !important;
    padding: 14px 6px !important;
    border-radius: 12px !important;
  }
  .bu-accred-logo {
    height: 44px !important;
    max-width: 75px !important;
  }
  .bu-accred-badge-name {
    font-size: 14px !important;
  }
  .bu-accred-badge-desc {
    font-size: 8.5px !important;
  }
}

@keyframes buAccredMarquee {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-50% - 7px));
  }
}
</style>
