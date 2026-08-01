<?php
/**
 * inc.page-banner.php
 * Reusable inner-page hero banner for all About sub-pages.
 * 
 * Usage: include at the top of any inner page after the header.
 * Variables to set before including:
 *   $page_title      - e.g. "Mission & Vision"
 *   $page_subtitle   - optional short description text
 *   $page_icon       - Font Awesome class, e.g. "fa-eye"
 *   $breadcrumbs     - array of ['label' => 'Home', 'url' => '/'], last item is current page
 */

$page_title    = $page_title    ?? 'Page';
$page_subtitle = $page_subtitle ?? '';
$page_icon     = $page_icon     ?? 'fa-file';
$breadcrumbs   = $breadcrumbs   ?? [['label' => 'Home', 'url' => URL_ROOT], ['label' => $page_title, 'url' => '#']];
?>
<style>
/* ============================================================
   BU INNER PAGE BANNER & SIDEBAR NAV
   Navy #0A1B54 / Gold #FFC107 — Matches homepage theme
   ============================================================ */
.bu-inner-hero {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 55%, #061D7C 100%);
  padding: 70px 20px 60px;
  position: relative;
  overflow: hidden;
  width: 100%;
  float: left;
  clear: both;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-inner-hero::before {
  content: '';
  position: absolute;
  top: -80px; right: -80px;
  width: 350px; height: 350px;
  border-radius: 50%;
  background: rgba(255,193,7,0.06);
  pointer-events: none;
}
.bu-inner-hero::after {
  content: '';
  position: absolute;
  bottom: -60px; left: 20%;
  width: 280px; height: 280px;
  border-radius: 50%;
  background: rgba(255,193,7,0.04);
  pointer-events: none;
}
.bu-inner-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  gap: 30px;
}
.bu-inner-hero-icon-wrap {
  flex-shrink: 0;
  width: 70px; height: 70px;
  background: rgba(255,193,7,0.12);
  border: 2px solid rgba(255,193,7,0.3);
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 28px;
  color: #FFC107;
}
.bu-inner-hero-text { flex: 1; }
.bu-inner-breadcrumb {
  display: flex;
  align-items: center;
  gap: 0;
  list-style: none;
  margin: 0 0 12px 0;
  padding: 0;
  flex-wrap: wrap;
}
.bu-inner-breadcrumb li {
  font-size: 11px;
  font-weight: 600;
  color: rgba(255,255,255,0.5);
  text-transform: uppercase;
  letter-spacing: 0.7px;
}
.bu-inner-breadcrumb li a {
  color: rgba(255,255,255,0.5);
  text-decoration: none;
  transition: color 0.2s;
}
.bu-inner-breadcrumb li a:hover { color: #FFC107; }
.bu-inner-breadcrumb li:not(:last-child)::after {
  content: '›';
  margin: 0 8px;
  color: rgba(255,255,255,0.25);
}
.bu-inner-breadcrumb li:last-child { color: #FFC107; }
.bu-inner-hero-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(28px, 4vw, 46px);
  font-weight: 800;
  color: #fff;
  margin: 0 0 10px 0;
  line-height: 1.15;
}
.bu-inner-hero-title em { font-style: italic; color: #FFC107; }
.bu-inner-hero-subtitle {
  font-size: 15px;
  color: rgba(255,255,255,0.65);
  line-height: 1.6;
  margin: 0;
  max-width: 600px;
}

/* ---- INNER PAGE LAYOUT ---- */
.bu-inner-layout {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 260px 1fr;
  gap: 40px;
  padding: 60px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  align-items: start;
}

/* ---- SIDEBAR NAV ---- */
.bu-inner-sidebar {}
.bu-sidebar-nav {
  background: #fff;
  border-radius: 8px;
  border: 1px solid #E5E7EB;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(6,29,124,0.07);
  position: sticky;
  top: 20px;
}
.bu-sidebar-nav-header {
  background: #0A1B54;
  color: #FFC107;
  padding: 16px 20px;
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
}
.bu-sidebar-nav ul {
  list-style: none;
  margin: 0;
  padding: 8px 0;
}
.bu-sidebar-nav ul li a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 11px 20px;
  font-size: 13px;
  font-weight: 600;
  color: #374151;
  text-decoration: none;
  transition: all 0.2s;
  border-left: 3px solid transparent;
}
.bu-sidebar-nav ul li a i {
  font-size: 13px;
  color: #9CA3AF;
  width: 16px;
  text-align: center;
  transition: color 0.2s;
}
.bu-sidebar-nav ul li a:hover,
.bu-sidebar-nav ul li a.active {
  background: #F8FAFC;
  color: #0A1B54;
  border-left-color: #FFC107;
  text-decoration: none;
}
.bu-sidebar-nav ul li a:hover i,
.bu-sidebar-nav ul li a.active i { color: #D99B00; }

/* ---- CONTENT AREA ---- */
.bu-inner-content {}
.bu-content-card {
  background: #fff;
  border-radius: 8px;
  border: 1px solid #E5E7EB;
  padding: 40px 44px;
  box-shadow: 0 4px 20px rgba(6,29,124,0.05);
  margin-bottom: 30px;
}
.bu-content-label {
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #D99B00;
  text-transform: uppercase;
  margin-bottom: 12px;
  display: block;
}
.bu-content-h2 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(24px, 3vw, 34px);
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 8px 0;
  line-height: 1.2;
}
.bu-content-h2 em { font-style: italic; color: #D99B00; }
.bu-content-divider {
  width: 50px;
  height: 3px;
  background: #FFC107;
  border-radius: 2px;
  margin: 16px 0 24px 0;
}
.bu-content-body p {
  font-size: 15px;
  line-height: 1.85;
  color: #4B5563;
  margin-bottom: 16px;
}
.bu-content-body p:last-child { margin-bottom: 0; }
.bu-content-body strong, .bu-content-body b { color: #061D7C; font-weight: 700; }
.bu-content-body h4 {
  font-size: 18px;
  font-weight: 700;
  color: #061D7C;
  margin: 28px 0 10px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding-left: 14px;
  border-left: 3px solid #FFC107;
  clear: both;
}
.bu-content-body ul {
  list-style: none;
  padding: 0;
  margin: 0 0 16px 0;
}
.bu-content-body ul li {
  position: relative;
  padding-left: 24px;
  font-size: 14.5px;
  line-height: 1.7;
  color: #4B5563;
  padding-top: 4px;
  padding-bottom: 8px;
  border-bottom: 1px solid #F3F4F6;
  display: block;
}
.bu-content-body ul li:last-child { border-bottom: none; }
.bu-content-body ul li::before {
  content: '\f00c';
  font-family: 'FontAwesome';
  color: #D99B00;
  font-size: 11px;
  position: absolute;
  left: 0;
  top: 7px;
}
.bu-content-body a {
  color: #0A1B54;
  font-weight: 600;
  text-decoration: underline;
  transition: color 0.2s;
}
.bu-content-body a:hover { color: #D99B00; }

/* --- Responsive --- */
@media (max-width: 991px) {
  .bu-inner-layout { grid-template-columns: 1fr; gap: 24px; padding: 40px 16px 60px; }
  .bu-inner-hero { padding: 50px 16px 40px; }
  .bu-inner-hero-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
  .bu-content-card { padding: 28px 20px; }
  .bu-sidebar-nav { position: static; }
}
</style>

<div class="bu-inner-hero">
  <div class="bu-inner-hero-inner">
    <div class="bu-inner-hero-icon-wrap">
      <i class="fa <?php echo $page_icon; ?>"></i>
    </div>
    <div class="bu-inner-hero-text">
      <ul class="bu-inner-breadcrumb">
        <?php foreach($breadcrumbs as $i => $crumb): ?>
          <li>
            <?php if($i < count($breadcrumbs) - 1): ?>
              <a href="<?php echo $crumb['url']; ?>"><?php echo $crumb['label']; ?></a>
            <?php else: ?>
              <?php echo $crumb['label']; ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <h1 class="bu-inner-hero-title"><?php echo $page_title; ?></h1>
      <?php if($page_subtitle): ?>
        <p class="bu-inner-hero-subtitle"><?php echo $page_subtitle; ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>
