<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Campus Life - Student Events, Sports & World-Class Infrastructure | Bhabha University Bhopal</title>
<meta name="description" content="Experience life at Bhabha University Bhopal — vibrant cultural fests, sports championships, student clubs, 32-acre green campus, modern hostels, and state-of-the-art infrastructure.">
<meta name="keywords" content="Bhabha University campus life, student life Bhopal, cultural fest Tarang, sports meet, university hostels, campus infrastructure, university clubs, student events">
<?php include('inc.meta.php'); ?>

<style>
/* ================================================================
   BHABHA UNIVERSITY — CAMPUS LIFE DEDICATED SHOWCASE
   Theme: Deep Navy #0A1B54, Royal Gold #FFC107, Emerald #10B981
   ================================================================ */
:root {
  --cl-navy: #0A1B54;
  --cl-navy-dark: #051235;
  --cl-navy-light: #162B75;
  --cl-gold: #FFC107;
  --cl-gold-dark: #D99B00;
  --cl-gold-light: #FFF9E6;
  --cl-border: #E2E8F0;
  --cl-text-dark: #1E293B;
  --cl-text-muted: #64748B;
  --cl-bg-light: #F8FAFC;
}

.bu-cl-container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 45px 20px 80px;
  box-sizing: border-box;
  clear: both;
}

/* Quick Stats Bar — Modern Floating Showcase */
.bu-cl-stats-bar {
  background: #ffffff;
  border-radius: 16px;
  padding: 24px 18px;
  margin-top: 0;
  margin-bottom: 45px;
  position: relative;
  z-index: 10;
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 12px;
  box-shadow: 0 16px 40px -10px rgba(10, 27, 84, 0.12), 0 3px 12px rgba(0, 0, 0, 0.04);
  border: 1px solid rgba(10, 27, 84, 0.08);
  border-top: 3px solid var(--cl-gold);
}
.bu-cl-stat-item {
  text-align: center;
  border-right: 1px solid #EDF2F7;
  padding: 8px 12px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: transform 0.25s ease;
}
.bu-cl-stat-item:last-child {
  border-right: none;
}
.bu-cl-stat-item:hover {
  transform: translateY(-3px);
}
.bu-cl-stat-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  margin-bottom: 10px;
  transition: all 0.25s ease;
}
.bu-cl-stat-icon.is-green {
  background: #ECFDF5;
  color: #059669;
}
.bu-cl-stat-icon.is-amber {
  background: #FFFBEB;
  color: #D97706;
}
.bu-cl-stat-icon.is-blue {
  background: #EFF6FF;
  color: #2563EB;
}
.bu-cl-stat-icon.is-indigo {
  background: #EEF2FF;
  color: #4F46E5;
}
.bu-cl-stat-icon.is-gold {
  background: #FFFDF0;
  color: #B45309;
}
.bu-cl-stat-item:hover .bu-cl-stat-icon {
  transform: scale(1.1);
  box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
}
.bu-cl-stat-number {
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--cl-navy);
  line-height: 1.1;
  letter-spacing: -0.5px;
  margin-bottom: 6px;
  display: inline-flex;
  align-items: baseline;
  justify-content: center;
}
.bu-cl-stat-symbol {
  color: #D97706;
  font-weight: 800;
  font-size: 24px;
  margin-left: 2px;
}
.bu-cl-stat-label {
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  font-size: 11.5px;
  text-transform: uppercase;
  letter-spacing: 0.7px;
  color: #64748B;
  font-weight: 700;
  line-height: 1.35;
}
@media (max-width: 991px) {
  .bu-cl-container {
    padding: 30px 16px 60px;
  }
  .bu-cl-stats-bar {
    grid-template-columns: repeat(3, 1fr);
    margin-top: 0;
    padding: 20px 14px;
  }
}
@media (max-width: 600px) {
  .bu-cl-stats-bar {
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    padding: 16px 10px;
  }
  .bu-cl-stat-item {
    border-right: none;
    border-bottom: 1px solid #EDF2F7;
    padding: 12px 6px;
  }
  .bu-cl-stat-number {
    font-size: 26px;
  }
  .bu-cl-stat-symbol {
    font-size: 20px;
  }
}

/* Category Filter Bar */
.bu-cl-filters {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 45px;
}
.bu-cl-filter-btn {
  background: #ffffff;
  border: 1px solid var(--cl-border);
  color: var(--cl-text-dark);
  font-size: 13px;
  font-weight: 700;
  padding: 9px 18px;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
}
.bu-cl-filter-btn:hover,
.bu-cl-filter-btn.active {
  background: var(--cl-navy);
  color: var(--cl-gold);
  border-color: var(--cl-navy);
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(10, 27, 84, 0.15);
  text-decoration: none;
}

/* Section Block Heading */
.bu-cl-sec-header {
  text-align: center;
  max-width: 820px;
  margin: 0 auto 36px;
}
.bu-cl-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--cl-gold-light);
  color: #B45309;
  border: 1px solid rgba(245, 158, 11, 0.35);
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 5px 14px;
  border-radius: 20px;
  margin-bottom: 12px;
}
.bu-cl-title {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 10px 0;
  line-height: 1.25;
}
.bu-cl-title em {
  font-style: italic;
  color: #D97706;
}
.bu-cl-desc {
  font-size: 14.5px;
  line-height: 1.65;
  color: var(--cl-text-muted);
  margin: 0;
}

/* Event & Infrastructure Cards Grid */
.bu-cl-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 26px;
  margin-bottom: 60px;
}
@media (max-width: 768px) {
  .bu-cl-grid {
    grid-template-columns: 1fr;
  }
}

.bu-cl-card {
  background: #ffffff;
  border: 1px solid var(--cl-border);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(10, 27, 84, 0.05);
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  display: flex;
  flex-direction: column;
}
.bu-cl-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 36px rgba(10, 27, 84, 0.12);
  border-color: rgba(255, 193, 7, 0.6);
}

.bu-cl-card-img-wrap {
  position: relative;
  width: 100%;
  height: 230px;
  overflow: hidden;
  background: #0A1B54;
  cursor: pointer;
}
.bu-cl-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
  display: block;
}
.bu-cl-card:hover .bu-cl-card-img {
  transform: scale(1.06);
}
.bu-cl-card-pill {
  position: absolute;
  top: 12px;
  left: 12px;
  background: rgba(7, 19, 56, 0.85);
  backdrop-filter: blur(4px);
  color: #FFC107;
  border: 1px solid rgba(255, 193, 7, 0.4);
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 4px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  z-index: 2;
}
.bu-cl-zoom-btn {
  position: absolute;
  bottom: 12px;
  right: 12px;
  background: rgba(0, 0, 0, 0.65);
  color: #ffffff;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  opacity: 0;
  transform: scale(0.8);
  transition: all 0.25s ease;
  z-index: 2;
}
.bu-cl-card-img-wrap:hover .bu-cl-zoom-btn {
  opacity: 1;
  transform: scale(1);
}

.bu-cl-card-body {
  padding: 22px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.bu-cl-card-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 8px 0;
  line-height: 1.35;
}
.bu-cl-card-text {
  font-size: 13px;
  line-height: 1.6;
  color: var(--cl-text-muted);
  margin: 0 0 14px 0;
  flex-grow: 1;
}
.bu-cl-card-tags {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  margin-top: auto;
  padding-top: 12px;
  border-top: 1px solid #F1F5F9;
}
.bu-cl-tag {
  font-size: 11px;
  font-weight: 600;
  background: #F1F5F9;
  color: #475569;
  padding: 2px 8px;
  border-radius: 4px;
}

/* Feature Showcase Strip (Clubs & Extracurriculars) */
.bu-cl-spotlight-box {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  border-radius: 14px;
  padding: 36px 32px;
  color: #ffffff;
  margin-bottom: 60px;
  position: relative;
  overflow: hidden;
}
.bu-cl-spotlight-box::after {
  content: '';
  position: absolute;
  top: -50%;
  right: -10%;
  width: 350px;
  height: 350px;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.12) 0%, transparent 70%);
  pointer-events: none;
}
.bu-cl-spotlight-header {
  max-width: 700px;
  margin-bottom: 28px;
}
.bu-cl-spotlight-header h3 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 8px 0;
}
.bu-cl-spotlight-header p {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
}
.bu-cl-clubs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
@media (max-width: 991px) {
  .bu-cl-clubs-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 600px) {
  .bu-cl-clubs-grid {
    grid-template-columns: 1fr;
  }
}
.bu-cl-club-item {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 8px;
  padding: 16px 18px;
  transition: all 0.25s ease;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 14px;
}
.bu-cl-club-item:hover {
  background: rgba(255, 193, 7, 0.18);
  border-color: #FFC107;
  transform: translateY(-2px);
  text-decoration: none;
}
.bu-cl-club-icon {
  width: 40px;
  height: 40px;
  background: #FFC107;
  color: #0A1B54;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}
.bu-cl-club-title {
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  margin: 0 0 2px 0;
}
.bu-cl-club-sub {
  color: rgba(255, 255, 255, 0.7);
  font-size: 11.5px;
  margin: 0;
}

/* Call to Action Box */
.bu-cl-cta {
  background: #F8FAFC;
  border: none;
  border-radius: 16px;
  padding: 40px 30px;
  text-align: center;
  margin-top: 40px;
  box-shadow: 0 12px 32px rgba(10, 27, 84, 0.06);
}
.bu-cl-cta h3 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 8px 0;
}
.bu-cl-cta p {
  font-size: 14px;
  color: var(--cl-text-muted);
  max-width: 600px;
  margin: 0 auto 20px;
}
.bu-cl-cta-btns {
  display: flex;
  justify-content: center;
  gap: 14px;
  flex-wrap: wrap;
}
.bu-btn-primary {
  background: var(--cl-gold);
  color: var(--cl-navy);
  font-weight: 800;
  font-size: 13.5px;
  padding: 12px 26px;
  border-radius: 6px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-btn-primary:hover {
  background: var(--cl-navy);
  color: var(--cl-gold);
  text-decoration: none;
  transform: translateY(-2px);
}
.bu-btn-secondary {
  background: var(--cl-navy);
  color: #ffffff;
  font-weight: 700;
  font-size: 13.5px;
  padding: 12px 24px;
  border-radius: 6px;
  text-decoration: none;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-btn-secondary:hover {
  background: #051235;
  color: var(--cl-gold);
  text-decoration: none;
  transform: translateY(-2px);
}

/* Lightbox Modal */
.bu-cl-modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(5, 18, 53, 0.92);
  backdrop-filter: blur(8px);
  z-index: 9999999;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.bu-cl-modal.open {
  display: flex;
}
.bu-cl-modal-content {
  max-width: 900px;
  width: 100%;
  background: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
  position: relative;
  animation: buModalIn 0.3s ease;
}
@keyframes buModalIn {
  from { opacity: 0; transform: scale(0.94); }
  to { opacity: 1; transform: scale(1); }
}
.bu-cl-modal-img {
  width: 100%;
  max-height: 520px;
  object-fit: contain;
  background: #000000;
  display: block;
}
.bu-cl-modal-caption {
  padding: 18px 24px;
  background: #ffffff;
}
.bu-cl-modal-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--cl-navy);
  margin: 0 0 4px 0;
}
.bu-cl-modal-desc {
  font-size: 13px;
  color: var(--cl-text-muted);
  margin: 0;
}
.bu-cl-modal-close {
  position: absolute;
  top: 14px;
  right: 14px;
  background: rgba(0, 0, 0, 0.6);
  color: #ffffff;
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 10;
  transition: all 0.2s ease;
}
.bu-cl-modal-close:hover {
  background: #EF4444;
  transform: rotate(90deg);
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <!-- INNER BANNER -->
  <?php
  $page_title    = 'Vibrant <em>Campus Life</em>';
  $page_subtitle = 'Experience 32 acres of academic innovation, active student clubs, grand cultural fests, sports excellence, and world-class living facilities.';
  $page_icon     = 'fa-compass';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-cl-container">
    <main>
      
      <!-- 1. Quick Stats Banner -->
      <div class="bu-cl-stats-bar">
        <div class="bu-cl-stat-item">
          <div class="bu-cl-stat-icon is-green"><i class="fa fa-tree"></i></div>
          <div class="bu-cl-stat-number">32<span class="bu-cl-stat-symbol">+</span></div>
          <div class="bu-cl-stat-label">Lush Green Acres</div>
        </div>
        <div class="bu-cl-stat-item">
          <div class="bu-cl-stat-icon is-amber"><i class="fa fa-calendar-check-o"></i></div>
          <div class="bu-cl-stat-number">50<span class="bu-cl-stat-symbol">+</span></div>
          <div class="bu-cl-stat-label">Annual Events &amp; Fests</div>
        </div>
        <div class="bu-cl-stat-item">
          <div class="bu-cl-stat-icon is-blue"><i class="fa fa-users"></i></div>
          <div class="bu-cl-stat-number">8<span class="bu-cl-stat-symbol">+</span></div>
          <div class="bu-cl-stat-label">Student Clubs &amp; Cells</div>
        </div>
        <div class="bu-cl-stat-item">
          <div class="bu-cl-stat-icon is-indigo"><i class="fa fa-flask"></i></div>
          <div class="bu-cl-stat-number">120<span class="bu-cl-stat-symbol">+</span></div>
          <div class="bu-cl-stat-label">Hi-Tech Labs &amp; Studios</div>
        </div>
        <div class="bu-cl-stat-item">
          <div class="bu-cl-stat-icon is-gold"><i class="fa fa-sun-o"></i></div>
          <div class="bu-cl-stat-number">100<span class="bu-cl-stat-symbol">%</span></div>
          <div class="bu-cl-stat-label">Solar-Powered Campus</div>
        </div>
      </div>

      <!-- 2. Section Jump Filters -->
      <div class="bu-cl-filters">
        <a href="#events" class="bu-cl-filter-btn"><i class="fa fa-calendar-check-o text-warning"></i> Cultural Events &amp; Fests</a>
        <a href="#sports" class="bu-cl-filter-btn"><i class="fa fa-futbol-o text-success"></i> Sports &amp; Athletics</a>
        <a href="#clubs" class="bu-cl-filter-btn"><i class="fa fa-users text-info"></i> Clubs &amp; Societies</a>
        <a href="#facilities" class="bu-cl-filter-btn"><i class="fa fa-building-o text-danger"></i> Campus Infrastructure</a>
      </div>

      <!-- 3. SECTION: CULTURAL EVENTS & STUDENT LIFE -->
      <section id="events" style="scroll-margin-top: 100px;">
        <div class="bu-cl-sec-header">
          <span class="bu-cl-badge"><i class="fa fa-calendar-o"></i> Student Celebrations</span>
          <h2 class="bu-cl-title">Events, Fests &amp; <em>Youth Energy</em></h2>
          <p class="bu-cl-desc">At Bhabha University, learning extends far beyond lecture halls. From grand stage performances and tech hackathons to culinary carnivals and social service camps, campus life is alive with creativity, friendship, and leadership.</p>
        </div>

        <div class="bu-cl-grid">
          
          <!-- Event 1: Cultural Fest Tarang -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/f81d40b399d52222915976848a04afa8.jpg', 'Annual Cultural Fest — Tarang', 'Vibrant stage performances, classical and contemporary dance competitions, rock band shows, and theatrical showcases on our open-air university stage.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/f81d40b399d52222915976848a04afa8.jpg" alt="Annual Cultural Fest" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-music"></i> Cultural Fest</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Annual Youth Cultural Fest — "Tarang"</h3>
              <p class="bu-cl-card-text">A multi-day extravaganza where students across all institutes unite to celebrate music, drama, fashion shows, and performing arts on grand auditorium and open-air stages.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Music &amp; Dance</span>
                <span class="bu-cl-tag">Theater</span>
                <span class="bu-cl-tag">Celebrity Evenings</span>
              </div>
            </div>
          </article>

          <!-- Event 2: Welcome Freshers -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/3f8bfe94415a00337c91ccefe3f6ae22.jpg', 'Welcome Freshers Carnival', 'Welcoming incoming batches with talent rounds, creative games, peer mentorship, and dynamic student connections.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/3f8bfe94415a00337c91ccefe3f6ae22.jpg" alt="Welcome Freshers" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-handshake-o"></i> Induction</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Freshers' Welcome Carnival &amp; Talent Hunt</h3>
              <p class="bu-cl-card-text">Every new academic journey begins with warmth, mentorship, and celebration. Incoming students showcase their unique talents, build lasting friendships, and integrate smoothly into university life.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Talent Rounds</span>
                <span class="bu-cl-tag">Peer Bonding</span>
                <span class="bu-cl-tag">Mentorship</span>
              </div>
            </div>
          </article>

          <!-- Event 3: Orientation Program -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/9107c678caa82c85e369f38c8c6cbe16.jpg', 'University Orientation & Convocation Assembly', 'Academic induction, leadership keynote addresses, and inspiring career orientations inside the Central Auditorium.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/9107c678caa82c85e369f38c8c6cbe16.jpg" alt="Orientation Program" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-graduation-cap"></i> Academic Induction</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Orientation Program &amp; Leadership Conclaves</h3>
              <p class="bu-cl-card-text">Held inside the air-conditioned Central Auditorium, orientation sessions bridge the gap between school and professional university studies, featuring industry leaders and distinguished alumni.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Academic Vision</span>
                <span class="bu-cl-tag">Career Guidance</span>
                <span class="bu-cl-tag">Industry Talks</span>
              </div>
            </div>
          </article>

          <!-- Event 4: Food Festival -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/c3a81fc4f56922a13272a69d03f0081b.jpg', 'Annual Hospitality Food Festival', 'Live culinary stalls, multi-cuisine cooking demonstrations, and student entrepreneurship food counters organized by Hotel Management students.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/c3a81fc4f56922a13272a69d03f0081b.jpg" alt="Food Festival" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-cutlery"></i> Culinary Arts</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Annual Hospitality &amp; Culinary Carnival</h3>
              <p class="bu-cl-card-text">Organized by our School of Hotel Management &amp; Catering Technology, students conceptualize themed pop-up cafes, live pastry kitchens, and food tasting counters across open lawns.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Hotel Mgmt</span>
                <span class="bu-cl-tag">Live Kitchens</span>
                <span class="bu-cl-tag">Student Enterprise</span>
              </div>
            </div>
          </article>

          <!-- Event 5: Engineer's Day Innovation -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/00ddc9caf03d120b67ca736c80de9658.jpg', 'Engineer\'s Day Tech Expo', 'Students presenting working robotics, IoT smart farming prototypes, renewable solar models, and software creations.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/00ddc9caf03d120b67ca736c80de9658.jpg" alt="Engineer's Day Tech Expo" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-cogs"></i> Tech Innovation</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Engineer's Day &amp; National Science Fair</h3>
              <p class="bu-cl-card-text">An intellectual showcase of robotics, automated hardware models, renewable energy devices, and medical software applications built independently by student engineering squads.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Robotics</span>
                <span class="bu-cl-tag">AI &amp; IoT</span>
                <span class="bu-cl-tag">Model Demonstrations</span>
              </div>
            </div>
          </article>

          <!-- Event 6: Mechanical Engineering Car Project -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/5b8e9565e03c670d630c62ada74bfa25.jpg', 'Formula Student & Go-Kart Racing Project', 'Complete fabrication, chassis welding, engine tuning and track testing of electric and combustion race vehicles by student engineers.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/5b8e9565e03c670d630c62ada74bfa25.jpg" alt="Go-Kart Project" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-car"></i> Automotive Lab</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Formula Student &amp; Automotive Vehicle Project</h3>
              <p class="bu-cl-card-text">Mechanical and electrical engineering students design and build competitive race karts, exploring electric powertrain integration, suspension ergonomics, and on-track endurance trials.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Motorsport</span>
                <span class="bu-cl-tag">Hands-on R&amp;D</span>
                <span class="bu-cl-tag">Chassis Fabrication</span>
              </div>
            </div>
          </article>

          <!-- Event 7: NCC & Leadership -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/efce40fadd861f6910b310d1e1a81826.jpg', 'NCC Unit Drill & National Youth Leadership', 'Disciplined parade training, obstacle courses, national camps, and character building under the University NCC Army Wing.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/efce40fadd861f6910b310d1e1a81826.jpg" alt="NCC Cadets" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-shield"></i> NCC Wing</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">NCC Cadets &amp; Youth Leadership Training</h3>
              <p class="bu-cl-card-text">Building patriotism, discipline, and physical fitness, our active NCC wing participates in Republic Day parades, adventure camps, firing ranges, and national integration expeditions.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Army Wing</span>
                <span class="bu-cl-tag">Discipline</span>
                <span class="bu-cl-tag">Parade Training</span>
              </div>
            </div>
          </article>

          <!-- Event 8: Blood Donation Camp -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/0f625636125ac766ccba02c59bc086f5.jpg', 'NSS Mega Blood Donation & Healthcare Camp', 'Over 300+ units of blood collected in university campus camps in collaboration with Red Cross and government civil hospitals.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/0f625636125ac766ccba02c59bc086f5.jpg" alt="Blood Donation Camp" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-heartbeat"></i> Social Service</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Blood Donation &amp; Community Outreach Camps</h3>
              <p class="bu-cl-card-text">Instilling social consciousness, student volunteers regularly organize voluntary blood donation camps, free dental checkups, rural literacy campaigns, and eco-plantation drives across Bhopal.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Community Aid</span>
                <span class="bu-cl-tag">Red Cross</span>
                <span class="bu-cl-tag">NSS Volunteers</span>
              </div>
            </div>
          </article>

          <!-- Event 9: Industrial Visits -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/7784e47dc525c0cfb55a3854d0ab3010.jpg', 'Industrial Field Exposure Visits', 'Student cohorts touring major pharmaceutical manufacturing plants, automated factories, and technical production facilities.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/7784e47dc525c0cfb55a3854d0ab3010.jpg" alt="Industrial Visit" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-industry"></i> Industry Connect</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Corporate Industrial &amp; Field Study Tours</h3>
              <p class="bu-cl-card-text">Real-world corporate exposure through regular industrial tours to BHEL, pharmaceutical manufacturing plants, IT software hubs, and civil engineering infrastructure projects.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Plant Tours</span>
                <span class="bu-cl-tag">Corporate Interaction</span>
                <span class="bu-cl-tag">Experiential Learning</span>
              </div>
            </div>
          </article>

        </div>
      </section>

      <!-- 4. SECTION: SPORTS & FITNESS -->
      <section id="sports" style="scroll-margin-top: 100px;">
        <div class="bu-cl-sec-header">
          <span class="bu-cl-badge"><i class="fa fa-trophy"></i> Athletics &amp; Wellness</span>
          <h2 class="bu-cl-title">Sports Grounds, Tournaments &amp; <em>Fitness Suite</em></h2>
          <p class="bu-cl-desc">Physical well-being and competitive spirit are vital pillars at Bhabha University. With tournament-standard cricket grounds, volleyball arenas, gymnasium suites, and indoor recreation, sports enthusiasts flourish every single day.</p>
        </div>

        <div class="bu-cl-grid">
          
          <!-- Cricket & Tournaments -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/cd3e8ce169d796421247b396bb3bfecb.jpg', 'Cricket Championship & Tournament Matches', 'Full-sized lush green cricket stadium hosting inter-departmental championships and university state-level leagues.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/cd3e8ce169d796421247b396bb3bfecb.jpg" alt="Cricket Match" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-trophy"></i> Cricket Ground</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Cricket Stadium &amp; Annual Premier League</h3>
              <p class="bu-cl-card-text">Our expansive cricket ground features turf pitches, boundary fencing, and spectator pavilions. The annual Bhabha Champions Trophy brings thrilling matches, live commentary, and student team spirit.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Inter-College League</span>
                <span class="bu-cl-tag">Turf Wickets</span>
                <span class="bu-cl-tag">Day Tournaments</span>
              </div>
            </div>
          </article>

          <!-- Gymnasium & Fitness Suite -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/08ba91f6cd604afe6629e3c47afc8dfa.jpg', 'Modern Campus Gymnasium Suite', 'Professional fitness equipment, strength training stations, treadmills, free weights, and fitness trainers for students and staff.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/08ba91f6cd604afe6629e3c47afc8dfa.jpg" alt="University Gym" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-heartbeat"></i> Gymnasium</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Fully Equipped Gymnasium &amp; Strength Suite</h3>
              <p class="bu-cl-card-text">Designed to keep our campus community fit and active, the air-conditioned gymnasium offers cardio machines, multi-station weight rigs, dumbbells, and guidance from qualified physical education mentors.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Strength Training</span>
                <span class="bu-cl-tag">Cardio Suite</span>
                <span class="bu-cl-tag">Personal Trainers</span>
              </div>
            </div>
          </article>

          <!-- International Women's Day & Sports Achievements -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>gallery/large/94b8b12372e5b74acca5e7ff2d2412c3.jpg', 'Sports Honors & Student Award Felicitations', 'Recognizing university athletes, inter-varsity medalists, and champions during annual award galas.')">
              <img src="<?php echo URL_UPLOAD; ?>gallery/large/94b8b12372e5b74acca5e7ff2d2412c3.jpg" alt="Sports Awards" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-star"></i> Athlete Honors</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Sports Honors, Medals &amp; Annual Awards</h3>
              <p class="bu-cl-card-text">Every athletic achievement is celebrated. State, national, and university-level tournament winners receive trophies, medals, sports scholarships, and university certificates of excellence.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Medal Winners</span>
                <span class="bu-cl-tag">Sports Quota</span>
                <span class="bu-cl-tag">University Colors</span>
              </div>
            </div>
          </article>

        </div>
      </section>

      <!-- 5. SECTION: CLUBS & SOCIETIES SPOTLIGHT -->
      <section id="clubs" style="scroll-margin-top: 100px;">
        <div class="bu-cl-spotlight-box">
          <div class="bu-cl-spotlight-header">
            <h3>Student Clubs &amp; Creative Societies</h3>
            <p>Clubs at Bhabha University empower students to lead initiatives, explore diverse hobbies, nurture mental wellness, and create social impact alongside their degree.</p>
          </div>

          <div class="bu-cl-clubs-grid">
            <a href="<?php echo href('clubs.php'); ?>#abhivyakti" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-paint-brush"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Abhivyakti Cultural Club</h4>
                <p class="bu-cl-club-sub">Music, Fine Arts, Theater &amp; Dance</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#unload-pittara" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-heart"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Unload Pittara</h4>
                <p class="bu-cl-club-sub">Youth Well-being &amp; Peer Support</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#khelo-bhabha" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-futbol-o"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Khelo Bhabha Club</h4>
                <p class="bu-cl-club-sub">Intra-University Sports &amp; Fitness</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#environment-club" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-leaf"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Green Environment Club</h4>
                <p class="bu-cl-club-sub">1101 Trees &amp; Sustainability</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#navgrah-vatika" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-tree"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Nav Grah Herbal Vatika</h4>
                <p class="bu-cl-club-sub">Medicinal Plants &amp; AYUSH Research</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#edc-cell" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-lightbulb-o"></i></div>
              <div>
                <h4 class="bu-cl-club-title">EDC &amp; Startup Cell</h4>
                <p class="bu-cl-club-sub">Entrepreneurship &amp; Incubation Hub</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#legal-aid" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-balance-scale"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Legal Aid Clinic</h4>
                <p class="bu-cl-club-sub">Social Justice &amp; Free Legal Support</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#ad-mad" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-bullhorn"></i></div>
              <div>
                <h4 class="bu-cl-club-title">AD-MAD Media Club</h4>
                <p class="bu-cl-club-sub">Branding, Advertising &amp; Campaigns</p>
              </div>
            </a>

            <a href="<?php echo href('clubs.php'); ?>#staff-club" class="bu-cl-club-item">
              <div class="bu-cl-club-icon"><i class="fa fa-users"></i></div>
              <div>
                <h4 class="bu-cl-club-title">Staff &amp; Faculty Club</h4>
                <p class="bu-cl-club-sub">Educator Well-Being &amp; Synergy</p>
              </div>
            </a>
          </div>

          <div style="margin-top: 24px; text-align: right;">
            <a href="<?php echo href('clubs.php'); ?>" style="color:#FFC107; font-weight:700; font-size:13.5px; text-decoration:none;">
              View All University Clubs &amp; Registration Details <i class="fa fa-arrow-right" style="margin-left:4px;"></i>
            </a>
          </div>
        </div>
      </section>

      <!-- 6. SECTION: CAMPUS INFRASTRUCTURE -->
      <section id="facilities" style="scroll-margin-top: 100px;">
        <div class="bu-cl-sec-header">
          <span class="bu-cl-badge"><i class="fa fa-building-o"></i> 32-Acre Campus</span>
          <h2 class="bu-cl-title">World-Class <em>Campus Infrastructure</em></h2>
          <p class="bu-cl-desc">Every corner of Bhabha University is built with purpose. Explore our air-conditioned convention auditoriums, high-tech simulation laboratories, lush eco-gardens, on-campus hostels, and community radio broadcasting studios.</p>
        </div>

        <div class="bu-cl-grid">
          
          <!-- Infra 1: Auditorium -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/2aa0d1727f2df6a9ddfa7bb009eb7873.jpg', 'Central Auditorium & Conference Facility', 'Air-conditioned 600+ capacity auditorium with high-definition projection, acoustic sound engineering, and stage lighting for convocations, summits and national conferences.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/2aa0d1727f2df6a9ddfa7bb009eb7873.jpg" alt="Auditorium" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-microphone"></i> Auditorium</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Central Auditorium &amp; Convention Hall</h3>
              <p class="bu-cl-card-text">Equipped with 600+ plush seats, advanced digital surround sound, theatrical stage spotlights, and HD presentation systems for university convocations, national symposia, and cultural galas.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">600+ Seats</span>
                <span class="bu-cl-tag">Acoustic Audio</span>
                <span class="bu-cl-tag">Central A/C</span>
              </div>
            </div>
          </article>

          <!-- Infra 2: Smart Classrooms -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/83e285d874ee031ad471ea4df94a1945.jpg', 'Smart Digital Classrooms', 'Digital smart boards, lecture recording systems, audio-visual enhancements and ergonomic seating across every academic department.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/83e285d874ee031ad471ea4df94a1945.jpg" alt="Smart Classrooms" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-desktop"></i> Smart Class</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Interactive Smart Digital Lecture Theaters</h3>
              <p class="bu-cl-card-text">Step-tiered lecture theaters equipped with multimedia ceiling projectors, interactive whiteboards, high-fidelity microphones, and comfortable seating to facilitate active pedagogical discussions.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Digital Projectors</span>
                <span class="bu-cl-tag">Tiered Theaters</span>
                <span class="bu-cl-tag">Wi-Fi Enabled</span>
              </div>
            </div>
          </article>

          <!-- Infra 3: Central Library -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/acacb02dda9b764fac164d4397a2accd.jpg', 'Central Library & Knowledge Hub', 'Over 75,000+ text volumes, international research journals, DELNET e-resources, and silent study chambers.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/acacb02dda9b764fac164d4397a2accd.jpg" alt="Central Library" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-book"></i> Central Library</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Central Library &amp; E-Resource Center</h3>
              <p class="bu-cl-card-text">Spanning multiple wings, our automated library provides thousands of academic volumes, reference encyclopedias, national journals, research databases (IEEE, DELNET, Springer), and quiet research cabins.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">75,000+ Books</span>
                <span class="bu-cl-tag">Digital Journals</span>
                <span class="bu-cl-tag">Reading Halls</span>
              </div>
            </div>
          </article>

          <!-- Infra 4: Computer Labs -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/b6123df20111594aa04d8b15dd6ce2af.jpg', 'Central Computer Center & AI Labs', 'Networked high-performance workstations, licensed simulation software, high-speed optical fiber connectivity, and dedicated coding terminals.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/b6123df20111594aa04d8b15dd6ce2af.jpg" alt="Computer Labs" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-laptop"></i> IT Infrastructure</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Central Computer Center &amp; AI Cloud Lab</h3>
              <p class="bu-cl-card-text">Equipped with hundreds of latest-generation computer nodes, gigabit internet, CAD/CAM design tools, programming compilers, and AI machine-learning development suites for student coders.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Gigabit LAN</span>
                <span class="bu-cl-tag">Python &amp; Java Labs</span>
                <span class="bu-cl-tag">Cloud Software</span>
              </div>
            </div>
          </article>

          <!-- Infra 5: Hostels -->
          <article class="bu-cl-card" id="hostels">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/f26b29937f258d4966b0be4de6bea02d.jpg', 'On-Campus Student Hostels', 'Separate residential halls for boys and girls with 24x7 security guards, CCTV surveillance, Wi-Fi connectivity, RO drinking water, and indoor recreational rooms.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/f26b29937f258d4966b0be4de6bea02d.jpg" alt="Hostels" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-home"></i> Student Hostels</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Boys &amp; Girls Hostels — Home Away from Home</h3>
              <p class="bu-cl-card-text">Safe and comfortable on-campus living with furnished rooms, round-the-clock security, continuous power backup, resident faculty wardens, common rooms with televisions, and laundry facilities.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Separate Hostels</span>
                <span class="bu-cl-tag">24/7 Gated Security</span>
                <span class="bu-cl-tag">RO Water</span>
              </div>
            </div>
          </article>

          <!-- Infra 6: Cafeteria -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/3864d09b8c0761c29ab3d67b49585238.jpg', 'Multi-Cuisine Campus Cafeteria', 'Spacious and hygienic food court serving hot nutritious meals, snacks, coffee, and beverages throughout the day.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/3864d09b8c0761c29ab3d67b49585238.jpg" alt="Cafeteria" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-coffee"></i> Cafeteria</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Hygienic Multi-Cuisine Food Court &amp; Canteen</h3>
              <p class="bu-cl-card-text">The lively social hub of the campus where students unwind between lectures. Serving vegetarian, nutritious home-style meals, breakfast, fresh juices, and evening refreshments under strict quality standards.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Hygienic Kitchen</span>
                <span class="bu-cl-tag">Budget-Friendly</span>
                <span class="bu-cl-tag">Social Hub</span>
              </div>
            </div>
          </article>

          <!-- Infra 7: Community Radio -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/9d2419cc88e43953ae02ef09e8d0bd2c.jpg', 'Radio Popcorn 90.8 FM Community Station', 'Madhya Pradesh\'s premier university community radio station where journalism and mass media students script, voice, and broadcast shows daily.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/9d2419cc88e43953ae02ef09e8d0bd2c.jpg" alt="Radio Popcorn 90.8 FM" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-bullhorn"></i> Radio Popcorn 90.8</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Popcorn 90.8 FM — Campus Community Radio</h3>
              <p class="bu-cl-card-text">The university houses an authorized community FM radio channel. Students gain practical broadcast experience as Radio Jockeys, sound engineers, voice-over artists, and news correspondents.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">Live FM Station</span>
                <span class="bu-cl-tag">RJ Opportunities</span>
                <span class="bu-cl-tag">Audio Studio</span>
              </div>
            </div>
          </article>

          <!-- Infra 8: Solar Power Plant -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/ed3185628b9828212309305234c8a863.jpg', 'University Solar Power Plant', 'Extensive rooftop and ground solar arrays generating clean renewable electricity, making Bhabha University a green eco-campus.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/ed3185628b9828212309305234c8a863.jpg" alt="Solar Power Plant" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-sun-o"></i> Green Energy</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Clean Solar Power Plant &amp; Green Campus</h3>
              <p class="bu-cl-card-text">Pioneering sustainable education in Central India, our on-campus solar infrastructure generates hundreds of kilowatts of clean green power, reducing carbon footprint while acting as a live research site.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">100% Sustainable</span>
                <span class="bu-cl-tag">Clean Energy</span>
                <span class="bu-cl-tag">Live Solar R&amp;D</span>
              </div>
            </div>
          </article>

          <!-- Infra 9: University Buses -->
          <article class="bu-cl-card">
            <div class="bu-cl-card-img-wrap" onclick="openClModal('<?php echo URL_UPLOAD; ?>infrastructure/1861bfeabedd25b52f2192d45a03c7f7.jpg', 'University Transport Fleet', 'Dedicated fleet of modern university buses traversing safe routes across all corners of Bhopal, Mandideep, and nearby regions.')">
              <img src="<?php echo URL_UPLOAD; ?>infrastructure/1861bfeabedd25b52f2192d45a03c7f7.jpg" alt="Transport Fleet" class="bu-cl-card-img" loading="lazy">
              <span class="bu-cl-card-pill"><i class="fa fa-bus"></i> Transport</span>
              <span class="bu-cl-zoom-btn"><i class="fa fa-search-plus"></i></span>
            </div>
            <div class="bu-cl-card-body">
              <h3 class="bu-cl-card-title">Dedicated City-Wide Transport Bus Network</h3>
              <p class="bu-cl-card-text">Ensuring reliable and secure commutes for day scholars, a dedicated fleet of university buses operates along dozens of scheduled routes spanning Bhopal city, Bairagarh, Kolar, MP Nagar, and suburbs.</p>
              <div class="bu-cl-card-tags">
                <span class="bu-cl-tag">City-Wide Routes</span>
                <span class="bu-cl-tag">Safe Commute</span>
                <span class="bu-cl-tag">GPS Fleet</span>
              </div>
            </div>
          </article>

        </div>
      </section>

      <!-- 7. Call To Action -->
      <div class="bu-cl-cta">
        <h3>Ready to Experience Bhabha Campus Life?</h3>
        <p>Step inside our 32-acre thriving campus. Connect with counselors, take a guided tour of our laboratories and hostels, or begin your admission process today.</p>
        <div class="bu-cl-cta-btns">
          <a href="<?php echo href('enquiry.php'); ?>" class="bu-btn-primary">Apply For Admission 2026-27 <i class="fa fa-arrow-right"></i></a>
          <a href="<?php echo href('virtual.php'); ?>" class="bu-btn-secondary"><i class="fa fa-globe"></i> Virtual Campus Tour</a>
        </div>
      </div>

    </main>
  </div>

  <!-- Interactive Lightbox Modal -->
  <div id="buClModal" class="bu-cl-modal" onclick="closeClModal(event)">
    <div class="bu-cl-modal-content" onclick="event.stopPropagation()">
      <button type="button" class="bu-cl-modal-close" onclick="closeClModal()">&times;</button>
      <img id="buClModalImg" src="" alt="Campus Life Photo" class="bu-cl-modal-img">
      <div class="bu-cl-modal-caption">
        <h3 id="buClModalTitle" class="bu-cl-modal-title"></h3>
        <p id="buClModalDesc" class="bu-cl-modal-desc"></p>
      </div>
    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php'); ?>

<script>
function openClModal(imgUrl, title, desc) {
  var modal = document.getElementById('buClModal');
  var img = document.getElementById('buClModalImg');
  var t = document.getElementById('buClModalTitle');
  var d = document.getElementById('buClModalDesc');

  if (modal && img) {
    img.src = imgUrl;
    if (t) t.innerText = title || 'Bhabha University Campus';
    if (d) d.innerText = desc || '';
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
}

function closeClModal(e) {
  var modal = document.getElementById('buClModal');
  if (modal) {
    modal.classList.remove('open');
    document.body.style.overflow = '';
  }
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeClModal();
  }
});
</script>
</body>
</html>
