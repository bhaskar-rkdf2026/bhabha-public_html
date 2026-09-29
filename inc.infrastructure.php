<?php
// Bhabha University – Campus & Infrastructure section (Dynamic from Database)
global $db;
$db->where('section_key', 'infrastructure_grid');
$infra_sec = $db->getOne('homepage_sections');

if (!$infra_sec || $infra_sec['status'] != 1) {
    return;
}

$infra_title = !empty($infra_sec['title']) ? $infra_sec['title'] : 'CAMPUS & INFRASTRUCTURE';
$infra_heading = !empty($infra_sec['heading']) ? $infra_sec['heading'] : 'A campus designed for<br><em>discovery.</em>';
$infra_sub = !empty($infra_sec['subheading']) ? $infra_sec['subheading'] : '32 acres of lush green campus with smart classrooms, research labs, an open auditorium, sports complex, hostels and an incubation centre.';

$infra_extra = !empty($infra_sec['extra_data']) ? json_decode($infra_sec['extra_data'], true) : [];
$infra_facilities = $infra_extra['facilities'] ?? [];

// Helper to resolve images properly
function bu_resolve_infra_img($img) {
    if (empty($img)) return URL_ROOT . 'new-media/image/campus-academic-block.png';
    if (strpos($img, 'http://') === 0 || strpos($img, 'https://') === 0) return $img;
    return URL_ROOT . ltrim($img, '/');
}

// Split into 2 columns
$fac_keys = array_keys($infra_facilities);
$total_fac = count($fac_keys);
$half = ceil($total_fac / 2);
$col1_keys = array_slice($fac_keys, 0, $half);
$col2_keys = array_slice($fac_keys, $half);
?>
<section class="bu-infra-section">
  <div class="bu-infra-container">
    
    <!-- LEFT: Text & List -->
    <div class="bu-infra-text-col">
      <span class="bu-infra-label"><?php echo htmlspecialchars($infra_title); ?></span>
      <h2 class="bu-infra-heading"><?php echo $infra_heading; ?></h2>
      <p class="bu-infra-sub"><?php echo htmlspecialchars($infra_sub); ?></p>
      
      <!-- 2-Column List -->
      <div class="bu-infra-list">
        <ul class="bu-infra-ul">
          <?php foreach ($col1_keys as $k): 
            $f = $infra_facilities[$k];
          ?>
            <li>
              <a href="javascript:void(0)" onclick="openInfraQuickModal('<?php echo htmlspecialchars($k); ?>')" class="bu-infra-link">
                <span class="bu-bullet"></span><?php echo htmlspecialchars($f['title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <ul class="bu-infra-ul">
          <?php foreach ($col2_keys as $k): 
            $f = $infra_facilities[$k];
          ?>
            <li>
              <a href="javascript:void(0)" onclick="openInfraQuickModal('<?php echo htmlspecialchars($k); ?>')" class="bu-infra-link">
                <span class="bu-bullet"></span><?php echo htmlspecialchars($f['title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <a href="<?php echo href("infrastructure.php"); ?>" class="bu-btn-navy bu-infra-btn">DISCOVER CAMPUS LIFE &nbsp;→</a>
    </div>

    <!-- RIGHT: Photo Collage -->
    <div class="bu-infra-collage-col">
      <div class="bu-collage-wrapper">
        <div class="bu-collage-main">
          <img src="<?php echo URL_ROOT;?>new-media/image/campus-academic-block.png" alt="Bhabha University Academic Block" class="bu-collage-img" loading="lazy" decoding="async">
        </div>
        <div class="bu-collage-side">
          <div class="bu-collage-side-top">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-entrance.png" alt="Bhabha University Campus Entrance" class="bu-collage-img" loading="lazy" decoding="async">
          </div>
          <div class="bu-collage-side-bottom">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-students.jpg" alt="Bhabha University Students" class="bu-collage-img" loading="lazy" decoding="async">
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ===== POPUP MODAL FOR INFRASTRUCTURE POINTS ===== -->
<div id="buInfraQuickModal" class="bu-infra-quick-modal" onclick="closeInfraQuickModal(event)">
  <div class="bu-infra-quick-dialog" onclick="event.stopPropagation()">
    <button type="button" class="bu-infra-quick-close" onclick="closeInfraQuickModal()" aria-label="Close modal">&times;</button>
    
    <div class="bu-infra-quick-img-wrap">
      <img id="buInfraQuickImg" src="" alt="Campus Facility" class="bu-infra-quick-img">
      <span id="buInfraQuickBadge" class="bu-infra-quick-badge">Facility</span>
    </div>

    <div class="bu-infra-quick-content">
      <h3 id="buInfraQuickTitle" class="bu-infra-quick-title"></h3>
      <p id="buInfraQuickDesc" class="bu-infra-quick-desc"></p>
      
      <div class="bu-infra-quick-actions">
        <a id="buInfraQuickBtn" href="#" class="bu-infra-quick-view-btn">
          View Detailed Page &nbsp;<i class="fa fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
const buInfraFacilities = <?php 
  $js_fac = [];
  foreach ($infra_facilities as $k => $v) {
      $js_fac[$k] = [
          'title' => $v['title'] ?? '',
          'badge' => $v['badge'] ?? '',
          'desc'  => $v['desc'] ?? '',
          'image' => bu_resolve_infra_img($v['image'] ?? ''),
          'link'  => !empty($v['link']) ? (strpos($v['link'], 'http') === 0 ? $v['link'] : URL_ROOT . ltrim($v['link'], '/')) : href('infrastructure.php')
      ];
  }
  echo json_encode($js_fac, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); 
?>;

function openInfraQuickModal(key) {
  const item = buInfraFacilities[key];
  if (!item) return;

  const modal = document.getElementById('buInfraQuickModal');
  const img = document.getElementById('buInfraQuickImg');
  const badge = document.getElementById('buInfraQuickBadge');
  const title = document.getElementById('buInfraQuickTitle');
  const desc = document.getElementById('buInfraQuickDesc');
  const btn = document.getElementById('buInfraQuickBtn');

  if (img) {
    img.src = item.image;
    img.alt = item.title;
  }
  if (badge) badge.textContent = item.badge || 'Campus Facility';
  if (title) title.textContent = item.title;
  if (desc) desc.textContent = item.desc;
  if (btn) btn.href = item.link;

  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeInfraQuickModal(e) {
  if (e && e.target && e.target.closest('.bu-infra-quick-dialog') && !e.target.classList.contains('bu-infra-quick-close')) {
    return;
  }
  const modal = document.getElementById('buInfraQuickModal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeInfraQuickModal();
  }
});
</script>

<!-- ===== INFRASTRUCTURE STYLES ===== -->
<style>
.bu-infra-section {
  background-color: #FAF9F6 !important; /* soft cream bg */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-infra-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
  display: flex !important;
  align-items: center !important;
  gap: 50px !important;
}

/* Left Text Column */
.bu-infra-text-col {
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-infra-label {
  color: #061D7C !important;
  font-size: 11.5px !important;
  font-weight: 800 !important;
  letter-spacing: 2px !important;
  text-transform: uppercase !important;
  margin-bottom: 12px !important;
  display: inline-block !important;
}
.bu-infra-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 40px !important;
  color: #061D7C !important;
  line-height: 1.15 !important;
  margin: 0 0 16px 0 !important;
  font-weight: 700 !important;
}
.bu-infra-heading em {
  font-style: italic !important;
  font-weight: 400 !important;
  color: #D99B00 !important;
}
.bu-infra-sub {
  font-size: 14.5px !important;
  color: #4A5568 !important;
  line-height: 1.6 !important;
  margin-bottom: 30px !important;
  max-width: 520px !important;
}

/* 2-Column Links List */
.bu-infra-list {
  display: flex !important;
  gap: 40px !important;
  margin-bottom: 35px !important;
}
.bu-infra-ul {
  list-style: none !important;
  padding: 0 !important;
  margin: 0 !important;
  display: flex !important;
  flex-direction: column !important;
  gap: 12px !important;
}
.bu-infra-ul li {
  display: flex !important;
  align-items: center !important;
  font-size: 13.5px !important;
  font-weight: 600 !important;
  color: #061D7C !important;
}
.bu-infra-link {
  color: #061D7C !important;
  text-decoration: none !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 10px !important;
  transition: all 0.2s ease !important;
  cursor: pointer !important;
}
.bu-infra-link:hover {
  color: #D99B00 !important;
  transform: translateX(4px) !important;
}
.bu-bullet {
  width: 7px !important;
  height: 7px !important;
  background-color: #D99B00 !important;
  border-radius: 50% !important;
  display: inline-block !important;
}

.bu-infra-btn {
  font-size: 11.5px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  background: #061D7C !important;
  color: #ffffff !important;
  padding: 12px 28px !important;
  border-radius: 4px !important;
  text-decoration: none !important;
  display: inline-block !important;
  transition: all 0.2s ease !important;
}
.bu-infra-btn:hover {
  background: #D99B00 !important;
  color: #061D7C !important;
  transform: translateY(-2px) !important;
}

/* Right Collage */
.bu-infra-collage-col {
  flex: 1 !important;
}
.bu-collage-wrapper {
  display: grid !important;
  grid-template-columns: 1.4fr 1fr !important;
  gap: 15px !important;
  height: 380px !important;
}
.bu-collage-main {
  width: 100% !important;
  height: 100% !important;
  overflow: hidden !important;
  border-radius: 8px !important;
}
.bu-collage-side {
  display: flex !important;
  flex-direction: column !important;
  gap: 15px !important;
  height: 100% !important;
}
.bu-collage-side-top,
.bu-collage-side-bottom {
  flex: 1 !important;
  overflow: hidden !important;
  border-radius: 8px !important;
}
.bu-collage-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  display: block !important;
  transition: transform 0.4s ease !important;
}
.bu-collage-img:hover {
  transform: scale(1.04) !important;
}

/* Modal Styling */
.bu-infra-quick-modal {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  background: rgba(4, 15, 74, 0.75) !important;
  backdrop-filter: blur(6px) !important;
  display: none !important;
  align-items: center !important;
  justify-content: center !important;
  z-index: 99999 !important;
  padding: 20px !important;
  box-sizing: border-box !important;
}
.bu-infra-quick-modal.active {
  display: flex !important;
  animation: buFadeIn 0.25s ease-out forwards !important;
}
@keyframes buFadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.bu-infra-quick-dialog {
  background: #ffffff !important;
  border-radius: 12px !important;
  max-width: 540px !important;
  width: 100% !important;
  overflow: hidden !important;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35) !important;
  position: relative !important;
  animation: buScaleUp 0.28s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
}
@keyframes buScaleUp {
  from { opacity: 0; transform: scale(0.92) translateY(15px); }
  to { opacity: 1; transform: scale(1) translateY(0); }
}

.bu-infra-quick-close {
  position: absolute !important;
  top: 12px !important;
  right: 12px !important;
  width: 34px !important;
  height: 34px !important;
  background: rgba(0, 0, 0, 0.55) !important;
  border: none !important;
  border-radius: 50% !important;
  color: #ffffff !important;
  font-size: 22px !important;
  cursor: pointer !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  z-index: 10 !important;
  transition: background 0.2s ease !important;
  line-height: 1 !important;
  padding: 0 !important;
}
.bu-infra-quick-close:hover {
  background: #E8B200 !important;
  color: #040F4A !important;
}

.bu-infra-quick-img-wrap {
  width: 100% !important;
  height: 230px !important;
  position: relative !important;
  background: #040F4A !important;
}
.bu-infra-quick-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  display: block !important;
}
.bu-infra-quick-badge {
  position: absolute !important;
  bottom: 12px !important;
  left: 16px !important;
  background: #E8B200 !important;
  color: #040F4A !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.8px !important;
  padding: 4px 10px !important;
  border-radius: 4px !important;
}

.bu-infra-quick-content {
  padding: 22px 24px 26px !important;
}
.bu-infra-quick-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 22px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  margin: 0 0 10px 0 !important;
  line-height: 1.25 !important;
}
.bu-infra-quick-desc {
  font-size: 13.5px !important;
  color: #4A5568 !important;
  line-height: 1.6 !important;
  margin: 0 0 20px 0 !important;
}
.bu-infra-quick-actions {
  display: flex !important;
  align-items: center !important;
  justify-content: flex-end !important;
}
.bu-infra-quick-view-btn {
  background: #061D7C !important;
  color: #ffffff !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  padding: 10px 22px !important;
  border-radius: 6px !important;
  text-decoration: none !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  transition: all 0.25s ease !important;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.25) !important;
}
.bu-infra-quick-view-btn:hover {
  background: #FFC107 !important;
  color: #061D7C !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 18px rgba(255, 193, 7, 0.4) !important;
  text-decoration: none !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-infra-container {
    flex-direction: column !important;
    gap: 36px !important;
  }
  .bu-infra-text-col {
    width: 100% !important;
    align-items: flex-start !important;
    text-align: left !important;
  }
  .bu-infra-list {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 16px 20px !important;
    width: 100% !important;
  }
  .bu-infra-ul {
    text-align: left !important;
  }
}
@media (max-width: 575px) {
  .bu-infra-section {
    padding: 50px 16px !important;
  }
  .bu-infra-heading {
    font-size: clamp(26px, 7vw, 32px) !important;
    line-height: 1.22 !important;
    margin-bottom: 14px !important;
  }
  .bu-infra-sub {
    font-size: 13.5px !important;
    line-height: 1.6 !important;
    margin-bottom: 22px !important;
  }
  .bu-infra-list {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 10px 12px !important;
    margin-bottom: 28px !important;
  }
  .bu-infra-ul li {
    font-size: 12.5px !important;
    gap: 8px !important;
  }
  .bu-collage-wrapper {
    grid-template-columns: 1fr !important;
    gap: 12px !important;
    height: auto !important;
  }
  .bu-collage-main {
    height: 220px !important;
  }
  .bu-collage-side {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 12px !important;
    height: 130px !important;
  }
  .bu-collage-side-top,
  .bu-collage-side-bottom {
    height: 130px !important;
  }
  .bu-infra-btn {
    width: 100% !important;
    text-align: center !important;
    justify-content: center !important;
  }
  .bu-infra-quick-img-wrap {
    height: 180px !important;
  }
  .bu-infra-quick-content {
    padding: 16px 18px 20px !important;
  }
  .bu-infra-quick-title {
    font-size: 19px !important;
  }
  .bu-infra-quick-view-btn {
    width: 100% !important;
    justify-content: center !important;
  }
}
</style>
