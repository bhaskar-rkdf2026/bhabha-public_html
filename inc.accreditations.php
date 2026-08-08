<?php
// Bhabha University – Statutory Approvals Component
?>
<!-- =================== STATUTORY APPROVALS SECTION =================== -->
<section class="bu-statutory-section">
  <div class="container" style="max-width:1170px; margin:0 auto; padding:0 15px; text-align:center;">
    <span class="bu-stat-label">Statutory Approvals</span>
    <h2 class="bu-stat-title">Recognised by <em>leading bodies.</em></h2>
    <div class="bu-accred-grid">
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>ugc.png" alt="UGC" class="bu-accred-logo" onerror="this.style.display='none';">
        <span class="bu-accred-badge-name">UGC</span>
        <span class="bu-accred-badge-desc">2(f) &amp; 12(B)</span>
      </div>
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>naac.png" alt="NAAC" class="bu-accred-logo" onerror="this.style.display='none';">
        <span class="bu-accred-badge-name">NAAC</span>
        <span class="bu-accred-badge-desc">Accredited</span>
      </div>
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>AICT.png" alt="AICTE" class="bu-accred-logo">
        <span class="bu-accred-badge-name">AICTE</span>
        <span class="bu-accred-badge-desc">Approved</span>
      </div>
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>PCI.png" alt="PCI" class="bu-accred-logo">
        <span class="bu-accred-badge-name">PCI</span>
        <span class="bu-accred-badge-desc">Approved</span>
      </div>
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>bci.png" alt="BCI" class="bu-accred-logo">
        <span class="bu-accred-badge-name">BCI</span>
        <span class="bu-accred-badge-desc">Approved</span>
      </div>
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>dci.png" alt="DCI" class="bu-accred-logo">
        <span class="bu-accred-badge-name">DCI</span>
        <span class="bu-accred-badge-desc">Approved</span>
      </div>
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>nci.png" alt="NCTE" class="bu-accred-logo">
        <span class="bu-accred-badge-name">NCTE</span>
        <span class="bu-accred-badge-desc">Approved</span>
      </div>
      <div class="bu-accred-badge">
        <img src="<?php echo URL_IMG;?>MPNRC.png" alt="MPNRC" class="bu-accred-logo">
        <span class="bu-accred-badge-name">MPNRC</span>
        <span class="bu-accred-badge-desc">Recognized</span>
      </div>
    </div>
  </div>
</section>

<!-- ===== STYLES ===== -->
<style>
.bu-statutory-section {
  background: #FFFFFF;
  padding: 70px 20px 80px 20px;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-stat-label {
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
  font-size: clamp(30px, 4vw, 48px);
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 35px 0;
  line-height: 1.15;
}
.bu-stat-title em {
  font-style: italic;
  color: #D99B00;
}
.bu-accred-grid {
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 12px;
  width: 100%;
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
  font-size: 9px;
  font-weight: 800;
  letter-spacing: 1px;
  color: #9CA3AF;
  text-transform: uppercase;
}
@media (max-width: 991px) {
  .bu-accred-grid {
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
  }
}
@media (max-width: 575px) {
  .bu-accred-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }
}
</style>
