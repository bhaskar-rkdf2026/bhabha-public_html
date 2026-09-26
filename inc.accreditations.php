<?php
// Bhabha University – Statutory Approvals Component
$accred_items = [
    [
        'img'  => 'ugc_new_logo.jpg',
        'alt'  => 'UGC - University Grants Commission',
        'name' => 'UGC',
        'desc' => '2(f) & 12(B)'
    ],
    [
        'img'  => 'AICT.png',
        'alt'  => 'AICTE - All India Council for Technical Education',
        'name' => 'AICTE',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'PCI.png',
        'alt'  => 'PCI - Pharmacy Council of India',
        'name' => 'PCI',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'bci.png',
        'alt'  => 'BCI - Bar Council of India',
        'name' => 'BCI',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'dci.png',
        'alt'  => 'DCI - Dental Council of India',
        'name' => 'DCI',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'nci.png',
        'alt'  => 'NCTE - National Council for Teacher Education',
        'name' => 'NCTE',
        'desc' => 'Approved'
    ],
    [
        'img'  => 'MPNRC.png',
        'alt'  => 'MPNRC - Madhya Pradesh Nurses Registration Council',
        'name' => 'MPNRC',
        'desc' => 'Recognized'
    ],
    [
        'img'  => 'mp_govt_logo.jpg',
        'alt'  => 'Government of Madhya Pradesh',
        'name' => 'MP Govt.',
        'desc' => 'Recognized'
    ],
    [
        'img'  => 'mppurc_logo.jpg',
        'alt'  => 'MP Private University Regulatory Commission',
        'name' => 'MPPURC',
        'desc' => 'Approved'
    ]
];
?>
<!-- =================== STATUTORY APPROVALS SECTION =================== -->
<section class="bu-statutory-section" id="buStatutoryApprovalsSection">
  <div class="bu-statutory-container">
    <span class="bu-accred-section-label">Statutory Approvals</span>
    <h2 class="bu-stat-title">Recognised by <em>leading bodies.</em></h2>
    
    <!-- Continuous Auto-Sliding Marquee Container (Desktop & Mobile) -->
    <div class="bu-accred-slider-wrap">
      <div class="bu-accred-track">
        <!-- Set 1 -->
        <?php foreach ($accred_items as $item): ?>
          <a href="<?php echo function_exists('href') ? href('approvals.php') : 'approvals.php'; ?>" class="bu-accred-badge" title="<?php echo htmlspecialchars($item['alt']); ?>">
            <img src="<?php echo URL_IMG . $item['img']; ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>" class="bu-accred-logo" loading="lazy" decoding="async" onerror="this.style.display='none';">
            <span class="bu-accred-badge-name"><?php echo htmlspecialchars($item['name']); ?></span>
            <span class="bu-accred-badge-desc"><?php echo htmlspecialchars($item['desc']); ?></span>
          </a>
        <?php endforeach; ?>

        <!-- Set 2 (Duplicate for Seamless Infinite Auto-Scroll on Desktop & Mobile) -->
        <?php foreach ($accred_items as $item): ?>
          <a href="<?php echo function_exists('href') ? href('approvals.php') : 'approvals.php'; ?>" class="bu-accred-badge bu-accred-duplicate" title="<?php echo htmlspecialchars($item['alt']); ?>" aria-hidden="true" tabindex="-1">
            <img src="<?php echo URL_IMG . $item['img']; ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>" class="bu-accred-logo" loading="lazy" decoding="async" onerror="this.style.display='none';">
            <span class="bu-accred-badge-name"><?php echo htmlspecialchars($item['name']); ?></span>
            <span class="bu-accred-badge-desc"><?php echo htmlspecialchars($item['desc']); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<!-- ===== STYLES ===== -->
<style>
.bu-statutory-section {
  background: #FFFFFF;
  padding: 60px 20px 70px 20px;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
  font-family: 'Plus Jakarta Sans', sans-serif;
  overflow: hidden;
  position: relative;
}
.bu-statutory-container {
  max-width: 1240px;
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
  font-size: clamp(28px, 3.8vw, 44px);
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 32px 0;
  line-height: 1.15;
}
.bu-stat-title em {
  font-style: italic;
  color: #D99B00;
}

/* CONTINUOUS MARQUEE SLIDER (DESKTOP & MOBILE) */
.bu-accred-slider-wrap {
  width: 100%;
  overflow: hidden;
  position: relative;
  padding: 10px 0 18px 0;
  mask-image: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
  -webkit-mask-image: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
}

.bu-accred-track {
  display: flex !important;
  width: max-content !important;
  gap: 16px !important;
  animation: buAccredMarquee 26s linear infinite !important;
  will-change: transform !important;
}

.bu-accred-track:hover,
.bu-accred-track:focus-within {
  animation-play-state: paused !important;
}

.bu-accred-duplicate {
  display: flex !important;
}

.bu-accred-badge {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 18px 12px;
  text-align: center;
  box-shadow: 0 4px 16px rgba(6, 29, 124, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 7px;
  width: 158px;
  min-width: 158px;
  max-width: 158px;
  flex-shrink: 0;
  box-sizing: border-box;
  text-decoration: none;
  cursor: pointer;
}

.bu-accred-badge:hover {
  box-shadow: 0 12px 28px rgba(6, 29, 124, 0.14);
  transform: translateY(-5px);
  border-color: #FFC107;
}

.bu-accred-logo {
  height: 54px;
  width: auto;
  max-width: 85px;
  object-fit: contain;
  margin-bottom: 2px;
  image-rendering: -webkit-optimize-contrast;
  filter: contrast(1.06) brightness(1.02);
  transition: transform 0.3s ease;
}

.bu-accred-badge:hover .bu-accred-logo {
  transform: scale(1.08);
}

.bu-accred-badge-name {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 15.5px;
  font-weight: 800;
  color: #061D7C;
  display: block;
  line-height: 1.1;
  white-space: nowrap;
}

.bu-accred-badge-desc {
  font-size: 9.5px;
  font-weight: 800;
  letter-spacing: 0.8px;
  color: #9CA3AF;
  text-transform: uppercase;
  white-space: nowrap;
}

/* MARQUEE ANIMATION */
@keyframes buAccredMarquee {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-50% - 8px));
  }
}

/* MOBILE & TABLET OPTIMIZATIONS */
@media (max-width: 991px) {
  .bu-statutory-section {
    padding: 42px 10px 48px 10px !important;
  }
  .bu-stat-title {
    margin-bottom: 22px !important;
  }
  .bu-accred-track {
    gap: 12px !important;
    animation-duration: 20s !important;
  }
  .bu-accred-badge {
    width: 135px !important;
    min-width: 135px !important;
    max-width: 135px !important;
    padding: 14px 8px !important;
    border-radius: 12px !important;
  }
  .bu-accred-logo {
    height: 46px !important;
    max-width: 75px !important;
  }
  .bu-accred-badge-name {
    font-size: 14px !important;
  }
  .bu-accred-badge-desc {
    font-size: 8.5px !important;
  }
}
</style>
