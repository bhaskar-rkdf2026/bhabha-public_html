<?php
// Bhabha University – Campus & Infrastructure section (Exact Design Match + Interactive Facility Popups)
$infra_facilities = [
  'smart-classrooms' => [
    'title' => 'Smart Classrooms',
    'badge' => 'Digital Learning',
    'desc'  => 'Modern multimedia classrooms equipped with audio-visual equipment, digital podiums, interactive projection systems, and ergonomic seating to enhance interactive learning.',
    'image' => URL_UPLOAD . 'infrastructure/83e285d874ee031ad471ea4df94a1945.jpg',
    'link'  => href("infrastructure.php") . '#smart-classrooms'
  ],
  'research-labs' => [
    'title' => 'Research & Innovation Labs',
    'badge' => 'Advanced Research',
    'desc'  => 'Over 120+ cutting-edge laboratories for engineering, pharmacy, biotech, and applied sciences with sophisticated analytical instruments and modern computational facilities.',
    'image' => URL_ROOT . 'new-media/image/research-students.png',
    'link'  => href("research.php")
  ],
  'medical-centre' => [
    'title' => 'Medical & Health Centre',
    'badge' => 'Healthcare & Wellness',
    'desc'  => 'Dedicated on-campus medical centre with qualified doctors, round-the-clock nursing staff, first-aid support, and ambulance facility for student and faculty wellness.',
    'image' => URL_UPLOAD . 'infrastructure/e24d4326ba8712763cc0e1484f66dc4d.jpg',
    'link'  => href("infrastructure.php") . '#health-centre'
  ],
  'hostels' => [
    'title' => 'Boys & Girls Hostels',
    'badge' => 'Student Living',
    'desc'  => 'Safe, hygienic, and spacious residential facilities on campus with high-speed internet, recreational zones, 24/7 security surveillance, and mess facilities.',
    'image' => URL_UPLOAD . 'infrastructure/f26b29937f258d4966b0be4de6bea02d.jpg',
    'link'  => href("infrastructure.php") . '#hostel'
  ],
  'auditorium' => [
    'title' => 'Auditorium & Seminar Hall',
    'badge' => 'Events & Convocations',
    'desc'  => 'Acoustically treated grand auditorium with state-of-the-art sound systems, digital projection, and stage lighting for seminars, guest lectures, and convocations.',
    'image' => URL_ROOT . 'new-media/image/auditorium-hall-1.jpg',
    'link'  => href("infrastructure.php") . '#seminar-hall'
  ],
  'open-auditorium' => [
    'title' => 'Open Auditorium & Amphitheatre',
    'badge' => 'Cultural & Arts Arena',
    'desc'  => 'Expansive open-air amphitheatre designed for cultural fests, annual functions, youth festivals, musical concerts, and student talent showcases.',
    'image' => URL_ROOT . 'new-media/image/auditorium-hall-2.jpg',
    'link'  => href("infrastructure.php") . '#open-auditorium'
  ],
  'innovation-hub' => [
    'title' => 'Innovation & Incubation Hub',
    'badge' => 'Startups & Patents',
    'desc'  => 'University incubation centre providing mentorship, seed-grant assistance, prototyping workspace, and patent support to turn innovative ideas into successful enterprises.',
    'image' => URL_ROOT . 'new-media/image/bhabha-engineering-building.jpg',
    'link'  => href("research.php") . '#incubation'
  ],
  'sports-complex' => [
    'title' => 'Sports Complex & Gymnasium',
    'badge' => 'Athletics & Fitness',
    'desc'  => 'World-class sports infrastructure featuring cricket grounds, football arena, basketball and volleyball courts, indoor games, and a modern fitness gymnasium.',
    'image' => URL_UPLOAD . 'infrastructure/08ba91f6cd604afe6629e3c47afc8dfa.jpg',
    'link'  => href("activities.php")
  ],
  'cafeteria' => [
    'title' => 'Campus Cafeteria & Food Court',
    'badge' => 'Dining & Hangouts',
    'desc'  => 'Multiple food outlets and spacious central cafeteria serving hygienic, fresh, and nutritious meals, beverages, and snacks in a lively community atmosphere.',
    'image' => URL_UPLOAD . 'infrastructure/3864d09b8c0761c29ab3d67b49585238.jpg',
    'link'  => href("infrastructure.php") . '#canteen'
  ],
  'wifi-campus' => [
    'title' => 'Wi-Fi Enabled Campus',
    'badge' => 'Smart Connectivity',
    'desc'  => '24x7 high-speed enterprise Wi-Fi connectivity blanketed across the entire 32-acre campus, academic blocks, libraries, laboratories, and hostel rooms.',
    'image' => URL_UPLOAD . 'infrastructure/adefd4e53054c616c24d6bd83c5b3aaf.jpg',
    'link'  => href("infrastructure.php") . '#wi-fi-campus'
  ]
];
?>
<section class="bu-infra-section">
  <div class="bu-infra-container">
    
    <!-- LEFT: Text & List -->
    <div class="bu-infra-text-col">
      <span class="bu-infra-label">CAMPUS & INFRASTRUCTURE</span>
      <h2 class="bu-infra-heading">A campus designed for<br><em>discovery.</em></h2>
      <p class="bu-infra-sub">32 acres of lush green campus with smart classrooms, research labs, an open auditorium, sports complex, hostels and an incubation centre.</p>
      
      <!-- 2-Column List -->
      <div class="bu-infra-list">
        <ul class="bu-infra-ul">
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('smart-classrooms')" class="bu-infra-link">
              <span class="bu-bullet"></span>Smart Classrooms
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('research-labs')" class="bu-infra-link">
              <span class="bu-bullet"></span>Research Labs
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('medical-centre')" class="bu-infra-link">
              <span class="bu-bullet"></span>Medical Centre
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('hostels')" class="bu-infra-link">
              <span class="bu-bullet"></span>Hostels
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('auditorium')" class="bu-infra-link">
              <span class="bu-bullet"></span>Auditorium
            </a>
          </li>
        </ul>
        <ul class="bu-infra-ul">
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('open-auditorium')" class="bu-infra-link">
              <span class="bu-bullet"></span>Open Auditorium
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('innovation-hub')" class="bu-infra-link">
              <span class="bu-bullet"></span>Innovation Hub
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('sports-complex')" class="bu-infra-link">
              <span class="bu-bullet"></span>Sports Complex
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('cafeteria')" class="bu-infra-link">
              <span class="bu-bullet"></span>Cafeteria
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="openInfraQuickModal('wifi-campus')" class="bu-infra-link">
              <span class="bu-bullet"></span>Wi-Fi Campus
            </a>
          </li>
        </ul>
      </div>

      <a href="<?php echo href("infrastructure.php"); ?>" class="bu-btn-navy bu-infra-btn">DISCOVER CAMPUS LIFE &nbsp;→</a>
    </div>

    <!-- RIGHT: Photo Collage -->
    <div class="bu-infra-collage-col">
      <div class="bu-collage-wrapper">
        <div class="bu-collage-main">
          <img src="<?php echo URL_ROOT;?>new-media/image/campus-academic-block.png" alt="Bhabha University Academic Block" class="bu-collage-img">
        </div>
        <div class="bu-collage-side">
          <div class="bu-collage-side-top">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-entrance.png" alt="Bhabha University Campus Entrance" class="bu-collage-img">
          </div>
          <div class="bu-collage-side-bottom">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-students.jpg" alt="Bhabha University Students" class="bu-collage-img">
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
const buInfraFacilities = <?php echo json_encode($infra_facilities, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

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
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 12px !important;
  display: block !important;
}
.bu-infra-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(30px, 3.8vw, 44px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.25 !important;
  margin: 0 0 20px 0 !important;
}
.bu-infra-heading em {
  font-style: italic !important;
  color: #061D7C !important;
  font-weight: 700 !important;
  text-decoration: underline !important;
  text-decoration-color: #FFC107 !important;
  text-underline-offset: 4px !important;
}
.bu-infra-sub {
  font-size: 14.5px !important;
  color: #4B5563 !important;
  line-height: 1.7 !important;
  margin: 0 0 28px 0 !important;
  max-width: 480px !important;
}

/* 2-Column list */
.bu-infra-list {
  display: flex !important;
  gap: 40px !important;
  width: 100% !important;
  margin-bottom: 36px !important;
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
  margin: 0 !important;
  display: flex !important;
  align-items: center !important;
}
.bu-infra-link {
  font-size: 14px !important;
  font-weight: 600 !important;
  color: #061D7C !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 10px !important;
  text-decoration: none !important;
  transition: all 0.2s ease !important;
  cursor: pointer !important;
  padding: 2px 4px !important;
  border-radius: 4px !important;
}
.bu-infra-link:hover {
  color: #D99B00 !important;
  transform: translateX(4px) !important;
  text-decoration: none !important;
  background-color: rgba(255, 193, 7, 0.08) !important;
}
.bu-infra-link:hover .bu-bullet {
  background-color: #061D7C !important;
  transform: scale(1.35) !important;
}
.bu-bullet {
  width: 7px !important;
  height: 7px !important;
  background-color: #FFC107 !important;
  border-radius: 50% !important;
  display: inline-block !important;
  transition: all 0.2s ease !important;
  flex-shrink: 0 !important;
}
.bu-infra-btn {
  padding: 12px 28px !important;
  border-radius: 3px !important;
}

/* Right Collage Column */
.bu-infra-collage-col {
  flex: 1.2 !important;
  width: 100% !important;
}
.bu-collage-wrapper {
  display: grid !important;
  grid-template-columns: 1.3fr 1fr !important;
  gap: 16px !important;
  width: 100% !important;
}
.bu-collage-main {
  height: 380px !important;
  border-radius: 4px !important;
  overflow: hidden !important;
}
.bu-collage-side {
  display: flex !important;
  flex-direction: column !important;
  gap: 16px !important;
  height: 380px !important;
}
.bu-collage-side-top,
.bu-collage-side-bottom {
  flex: 1 !important;
  border-radius: 4px !important;
  overflow: hidden !important;
}
.bu-collage-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.4s ease !important;
  display: block !important;
}
.bu-collage-main:hover .bu-collage-img,
.bu-collage-side-top:hover .bu-collage-img,
.bu-collage-side-bottom:hover .bu-collage-img {
  transform: scale(1.05) !important;
}

/* ===== POPUP MODAL STYLES ===== */
.bu-infra-quick-modal {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  background: rgba(6, 29, 124, 0.65) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
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
.bu-infra-quick-modal.active {
  opacity: 1 !important;
  visibility: visible !important;
}
.bu-infra-quick-dialog {
  background: #ffffff !important;
  width: 100% !important;
  max-width: 500px !important;
  border-radius: 14px !important;
  overflow: hidden !important;
  box-shadow: 0 25px 50px -12px rgba(6, 29, 124, 0.35) !important;
  transform: scale(0.92) translateY(12px) !important;
  transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1) !important;
  position: relative !important;
  display: flex !important;
  flex-direction: column !important;
}
.bu-infra-quick-modal.active .bu-infra-quick-dialog {
  transform: scale(1) translateY(0) !important;
}
.bu-infra-quick-close {
  position: absolute !important;
  top: 12px !important;
  right: 12px !important;
  width: 34px !important;
  height: 34px !important;
  background: rgba(0, 0, 0, 0.55) !important;
  color: #ffffff !important;
  border: none !important;
  border-radius: 50% !important;
  font-size: 20px !important;
  line-height: 1 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  z-index: 10 !important;
  transition: background 0.2s ease, transform 0.2s ease !important;
}
.bu-infra-quick-close:hover {
  background: #E11D48 !important;
  transform: rotate(90deg) !important;
}
.bu-infra-quick-img-wrap {
  position: relative !important;
  width: 100% !important;
  height: 230px !important;
  background: #061D7C !important;
  overflow: hidden !important;
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
  background: #FFC107 !important;
  color: #061D7C !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.8px !important;
  padding: 4px 12px !important;
  border-radius: 20px !important;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2) !important;
}
.bu-infra-quick-content {
  padding: 22px 24px 24px !important;
  text-align: left !important;
}
.bu-infra-quick-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 22px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  margin: 0 0 10px 0 !important;
  line-height: 1.3 !important;
}
.bu-infra-quick-desc {
  font-size: 13.5px !important;
  color: #4B5563 !important;
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

