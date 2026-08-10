<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>About Us - Bhabha University Bhopal | Best University in MP</title>
<meta name="description" content="Learn about Bhabha University Bhopal – our history, vision, mission, leadership, accreditations and campus. One of the best private universities in Madhya Pradesh, established in 2004.">
<meta name="keywords" content="About Bhabha University, Bhabha University history, best university bhopal, bhabha university overview, chancellor bhabha university">
<?php include('inc.meta.php');?>

<style>
/* ================================================
   ABOUT US PAGE - BHABHA UNIVERSITY
   Theme: Navy #0A1B54  Gold #FFC107
   Fonts: Playfair Display + Plus Jakarta Sans
   ================================================ */

/* ---- PAGE HERO BANNER ---- */
.bu-about-hero {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 55%, #061D7C 100%);
  padding: 90px 48px 70px;
  position: relative;
  overflow: hidden;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
}
.bu-about-hero::before {
  content: '';
  position: absolute;
  top: -60px; right: -60px;
  width: 400px; height: 400px;
  border-radius: 50%;
  background: rgba(255,193,7,0.06);
  pointer-events: none;
}
.bu-about-hero::after {
  content: '';
  position: absolute;
  bottom: -80px; left: -80px;
  width: 500px; height: 500px;
  border-radius: 50%;
  background: rgba(255,193,7,0.04);
  pointer-events: none;
}
.bu-about-hero-inner {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 24px;
  position: relative;
  z-index: 2;
  box-sizing: border-box;
}
.bu-about-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  list-style: none;
  margin: 0 0 22px 0;
  padding: 0;
}
.bu-about-breadcrumb li { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 0.8px; }
.bu-about-breadcrumb li a { color: rgba(255,255,255,0.55); text-decoration: none; transition: color 0.2s; }
.bu-about-breadcrumb li a:hover { color: #FFC107; }
.bu-about-breadcrumb li::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.25); }
.bu-about-breadcrumb li:last-child::after { display: none; }
.bu-about-breadcrumb li:last-child { color: #FFC107; }
.bu-about-hero-label {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 3px;
  color: #FFC107;
  text-transform: uppercase;
  margin-bottom: 16px;
  display: block;
}
.bu-about-hero-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(38px, 5vw, 64px);
  font-weight: 800;
  color: #ffffff;
  line-height: 1.1;
  margin: 0 0 20px 0;
}
.bu-about-hero-title em {
  font-style: italic;
  color: #FFC107;
}
.bu-about-hero-desc {
  font-size: 16px;
  line-height: 1.75;
  color: rgba(255,255,255,0.72);
  max-width: 620px;
  margin: 0 0 36px 0;
}
.bu-about-hero-stats {
  display: flex;
  gap: 48px;
  flex-wrap: wrap;
  padding-top: 16px;
  border-top: 1px solid rgba(255,255,255,0.12);
}
.bu-hero-stat-item { display: flex; flex-direction: column; gap: 4px; }
.bu-hero-stat-num {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 36px;
  font-weight: 800;
  color: #FFC107;
  line-height: 1;
}
.bu-hero-stat-lbl {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.55);
  text-transform: uppercase;
}

/* ---- SECTION WRAPPER ---- */
.bu-about-section {
  width: 100%;
  float: left;
  clear: both;
  padding: 85px 48px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}
.bu-about-section-alt { background: #FAF9F6; }
.bu-about-section-dark { background: linear-gradient(135deg, #051235, #0A1B54); }
.bu-about-container { max-width: 1240px; margin: 0 auto; padding: 0 24px; box-sizing: border-box; }
.bu-section-label {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #D99B00;
  text-transform: uppercase;
  margin-bottom: 14px;
  display: block;
}
.bu-section-label-light {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #FFC107;
  text-transform: uppercase;
  margin-bottom: 14px;
  display: block;
}
.bu-section-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(30px, 3.5vw, 44px);
  font-weight: 800;
  color: #061D7C;
  line-height: 1.15;
  margin: 0 0 18px 0;
}
.bu-section-title em { font-style: italic; color: #D99B00; font-weight: 700; }
.bu-section-title-light {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(30px, 3.5vw, 44px);
  font-weight: 800;
  color: #fff;
  line-height: 1.15;
  margin: 0 0 18px 0;
}
.bu-section-title-light em { font-style: italic; color: #FFC107; }
.bu-section-text {
  font-size: 15px;
  line-height: 1.8;
  color: #4B5563;
  margin: 0;
}
.bu-section-divider {
  width: 60px;
  height: 3px;
  background: #FFC107;
  border-radius: 2px;
  margin: 0 0 28px 0;
}

/* ---- OVERVIEW SECTION (2-col) ---- */
.bu-overview-grid {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: 70px;
  align-items: center;
}
.bu-overview-img-wrap {
  position: relative;
}
.bu-overview-img {
  width: 100%;
  height: 480px;
  object-fit: cover;
  border-radius: 6px;
  display: block;
  box-shadow: 0 20px 50px rgba(6,29,124,0.12);
}
.bu-overview-badge {
  position: absolute;
  bottom: -24px;
  left: -24px;
  background: #0A1B54;
  color: #FFC107;
  padding: 20px 24px;
  border-radius: 4px;
  box-shadow: 0 12px 30px rgba(10,27,84,0.25);
}
.bu-overview-badge-num {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 40px;
  font-weight: 800;
  display: block;
  line-height: 1;
  margin-bottom: 4px;
}
.bu-overview-badge-lbl {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: rgba(255,255,255,0.7);
  display: block;
}
.bu-overview-text-wrap { display: flex; flex-direction: column; gap: 0; }
.bu-overview-points {
  list-style: none;
  padding: 0;
  margin: 28px 0 0 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.bu-overview-points li {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  font-size: 14px;
  line-height: 1.6;
  color: #374151;
}
.bu-overview-points li .bu-pt-icon {
  flex-shrink: 0;
  width: 22px;
  height: 22px;
  background: rgba(255,193,7,0.15);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #D99B00;
  font-size: 10px;
  margin-top: 1px;
}
.bu-overview-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: 32px;
  background: #0A1B54;
  color: #fff;
  font-size: 12px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 13px 28px;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.25s;
  border: 2px solid #0A1B54;
  align-self: flex-start;
}
.bu-overview-link:hover {
  background: #FFC107;
  color: #0A1B54;
  border-color: #FFC107;
  text-decoration: none;
}

/* ---- TIMELINE SECTION ---- */
.bu-timeline {
  position: relative;
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px 0;
}
.bu-timeline::before {
  content: '';
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  top: 0; bottom: 0;
  width: 4px;
  background: #FFC107;
  border-radius: 2px;
}
.bu-timeline-item {
  position: relative;
  width: 50%;
  box-sizing: border-box;
  margin-bottom: 32px;
}
.bu-timeline-item:nth-child(odd) {
  left: 0;
  padding: 0 45px 0 0;
}
.bu-timeline-item:nth-child(even) {
  left: 50%;
  padding: 0 0 0 45px;
}
.bu-timeline-dot {
  position: absolute;
  top: 22px;
  width: 18px;
  height: 18px;
  background: #FFC107;
  border: 3.5px solid #0A1B54;
  border-radius: 50%;
  z-index: 3;
  box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);
}
.bu-timeline-item:nth-child(odd) .bu-timeline-dot {
  right: -9px;
  left: auto;
}
.bu-timeline-item:nth-child(even) .bu-timeline-dot {
  left: -9px;
  right: auto;
}
.bu-timeline-item-content {
  background: #ffffff;
  border-radius: 8px;
  padding: 26px 30px;
  box-shadow: 0 8px 26px rgba(6, 29, 124, 0.07);
  border: 1px solid #E5E7EB;
  border-top: 4px solid #0A1B54;
  position: relative;
  text-align: left;
  transition: all 0.3s ease;
}
.bu-timeline-item-content:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 36px rgba(6, 29, 124, 0.14);
}
.bu-timeline-year {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 13px;
  font-weight: 800;
  color: #FFC107;
  background: #0A1B54;
  padding: 5px 14px;
  border-radius: 20px;
  display: inline-block;
  margin-bottom: 12px;
  letter-spacing: 1px;
}
.bu-timeline-item-content h4 {
  font-size: 18px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 10px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.3;
}
.bu-timeline-item-content p {
  font-size: 14px;
  line-height: 1.65;
  color: #4B5563;
  margin: 0;
}

/* ---- VISION MISSION SECTION ---- */
.bu-vm-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  margin-top: 48px;
}
.bu-vm-card {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 8px;
  padding: 0 0 32px 0;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
}
.bu-vm-card-img-wrap {
  width: 100%;
  height: 170px;
  overflow: hidden;
  position: relative;
}
.bu-vm-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.bu-vm-card:hover .bu-vm-card-img {
  transform: scale(1.06);
}
.bu-vm-card-body {
  padding: 24px 32px 0 32px;
}
.bu-vm-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}
.bu-vm-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 4px; height: 100%;
  background: #FFC107;
  z-index: 2;
}
.bu-vm-icon {
  font-size: 28px;
  color: #FFC107;
  margin-bottom: 14px;
}
.bu-vm-card h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 22px;
  font-weight: 700;
  color: #fff;
  margin: 0 0 14px 0;
}
.bu-vm-card p {
  font-size: 14px;
  line-height: 1.75;
  color: rgba(255,255,255,0.72);
  margin: 0;
}

/* ---- CAMPUS HIGHLIGHTS GRID ---- */
.bu-campus-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
  margin-top: 40px;
}
.bu-campus-card {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(6,29,124,0.06);
  border: 1px solid #E5E7EB;
  transition: all 0.3s ease;
}
.bu-campus-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 18px 36px rgba(6,29,124,0.12);
}
.bu-campus-img-wrap {
  width: 100%;
  height: 170px;
  overflow: hidden;
  position: relative;
}
.bu-campus-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.bu-campus-card:hover .bu-campus-img {
  transform: scale(1.08);
}
.bu-campus-info {
  padding: 18px 20px;
}
.bu-campus-info h4 {
  font-size: 15px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 6px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-campus-info p {
  font-size: 12.5px;
  color: #6B7280;
  margin: 0;
  line-height: 1.5;
}

/* ---- STATS STRIP ---- */
.bu-stats-strip {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0;
  background: #0A1B54;
  border-radius: 8px;
  overflow: hidden;
  margin-top: 60px;
  box-shadow: 0 20px 50px rgba(6,29,124,0.15);
}
.bu-stat-cell {
  padding: 36px 24px;
  text-align: center;
  border-right: 1px solid rgba(255,255,255,0.08);
  transition: background 0.25s;
}
.bu-stat-cell:last-child { border-right: none; }
.bu-stat-cell:hover { background: rgba(255,193,7,0.08); }
.bu-stat-number {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 42px;
  font-weight: 800;
  color: #FFC107;
  display: block;
  line-height: 1;
  margin-bottom: 8px;
}
.bu-stat-label {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.6);
  text-transform: uppercase;
}

/* ---- SUB-PAGES QUICK LINKS (EXPLORE FURTHER) ---- */
.bu-subpages-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px;
  margin-top: 48px;
}
.bu-subpage-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 0;
  text-decoration: none !important;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(6, 29, 124, 0.05);
}
.bu-subpage-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 38px rgba(6, 29, 124, 0.12);
  border-color: #FFC107;
}
.bu-subpage-img-wrap {
  width: 100%;
  height: 185px;
  overflow: hidden;
  position: relative;
  background: #0A1B54;
}
.bu-subpage-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
  transition: transform 0.45s ease;
  image-rendering: -webkit-optimize-contrast;
  filter: contrast(1.03) brightness(1.02);
}
.bu-subpage-card:hover .bu-subpage-img {
  transform: scale(1.06);
}

/* Floating Icon Badge over Image */
.bu-subpage-icon-badge {
  position: absolute;
  bottom: 12px;
  right: 14px;
  width: 44px;
  height: 44px;
  background: #0A1B54;
  color: #FFC107;
  border: 2px solid #ffffff;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
  z-index: 3;
}
.bu-subpage-card:hover .bu-subpage-icon-badge {
  background: #FFC107;
  color: #0A1B54;
  transform: scale(1.08);
}

.bu-subpage-body {
  padding: 22px 24px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  flex-grow: 1;
  justify-content: space-between;
}
.bu-subpage-card h4 {
  font-size: 17px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 6px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.35;
}
.bu-subpage-card p {
  font-size: 13.5px;
  line-height: 1.6;
  color: #6B7280;
  margin: 0;
}
.bu-subpage-arrow {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  color: #D99B00;
  margin-top: 10px;
}
.bu-subpage-arrow i { font-size: 10px; transition: transform 0.2s ease; }
.bu-subpage-card:hover .bu-subpage-arrow i { transform: translateX(4px); }

/* ---- ACCREDITATIONS & STATUTORY APPROVAL LOGOS (ALL IN 1 ROW) ---- */
.bu-accred-grid {
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 12px;
  margin-top: 40px;
  width: 100%;
}
.bu-accred-badge {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 16px 8px;
  text-align: center;
  box-shadow: 0 4px 14px rgba(6, 29, 124, 0.05);
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
  box-shadow: 0 14px 30px rgba(6, 29, 124, 0.12);
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

/* ---- CTA ---- */
.bu-about-cta {
  width: 100%;
  float: left;
  clear: both;
  padding: 80px 20px;
  background: linear-gradient(135deg, #061D7C, #0A1B54);
  text-align: center;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-about-cta h2 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(28px, 3.5vw, 42px);
  font-weight: 800;
  color: #fff;
  margin: 0 0 16px 0;
}
.bu-about-cta h2 em { font-style: italic; color: #FFC107; }
.bu-about-cta p {
  font-size: 16px;
  color: rgba(255,255,255,0.72);
  margin: 0 0 36px 0;
  line-height: 1.7;
  max-width: 560px;
  margin-left: auto; margin-right: auto;
}
.bu-cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.bu-cta-btn-primary {
  background: #FFC107;
  color: #0A1B54;
  font-size: 13px;
  font-weight: 800;
  padding: 14px 34px;
  border-radius: 4px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s;
  display: inline-block;
}
.bu-cta-btn-primary:hover { background: #D99B00; color: #0A1B54; text-decoration: none; transform: translateY(-2px); }
.bu-cta-btn-secondary {
  background: transparent;
  color: #fff;
  font-size: 13px;
  font-weight: 800;
  padding: 14px 34px;
  border-radius: 4px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 2px solid rgba(255,255,255,0.4);
  transition: all 0.25s;
  display: inline-block;
}
.bu-cta-btn-secondary:hover { border-color: #FFC107; color: #FFC107; text-decoration: none; }

/* ---- RESPONSIVE ---- */
@media (max-width: 1400px) {
  .bu-about-section { padding: 75px 36px !important; }
  .bu-about-hero { padding: 80px 36px 60px !important; }
}
@media (max-width: 991px) {
  .bu-about-hero { padding: 60px 24px 50px !important; }
  .bu-about-section { padding: 60px 24px !important; }
  .bu-about-cta { padding: 60px 24px !important; }
  .bu-about-hero-stats { gap: 28px; }
  .bu-overview-grid { grid-template-columns: 1fr; gap: 40px; }
  .bu-overview-img { height: 340px; }
  .bu-overview-badge { left: 0; bottom: -16px; }
  .bu-timeline::before { left: 20px; transform: none; }
  .bu-timeline-item, .bu-timeline-item:nth-child(odd), .bu-timeline-item:nth-child(even) { width: 100%; left: 0 !important; padding: 0 0 30px 50px !important; }
  .bu-timeline-item:nth-child(odd) .bu-timeline-dot, .bu-timeline-item:nth-child(even) .bu-timeline-dot { left: 13px !important; right: auto !important; }
  .bu-vm-grid { grid-template-columns: 1fr; }
  .bu-campus-grid { grid-template-columns: repeat(2, 1fr); }
  .bu-stats-strip { grid-template-columns: repeat(2, 1fr); max-width: 100% !important; margin: 30px 0 !important; border-radius: 8px !important; }
  .bu-subpages-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 575px) {
  .bu-about-section { padding: 45px 16px !important; }
  .bu-about-hero { padding: 45px 16px 40px !important; }
  .bu-about-cta { padding: 45px 16px !important; }
  .bu-about-hero-stats { flex-direction: column; gap: 18px; }
  .bu-campus-grid { grid-template-columns: 1fr; }
  .bu-stats-strip { grid-template-columns: 1fr 1fr; }
  .bu-subpages-grid { grid-template-columns: 1fr; }
  .bu-accred-grid { gap: 12px; }
}

/* =================== VIRTUAL TOUR SECTION =================== */
.bu-vt-section {
  background: linear-gradient(135deg, #040F4A 0%, #061D7C 60%, #02092E 100%);
  padding: 90px 20px 80px;
  position: relative;
  overflow: hidden;
  color: #FFFFFF;
  font-family: 'Plus Jakarta Sans', sans-serif;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
}
.bu-vt-section::before {
  content: '';
  position: absolute;
  top: -120px; right: -80px;
  width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.10) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}
.bu-vt-section::after {
  content: '';
  position: absolute;
  bottom: -80px; left: -80px;
  width: 350px; height: 350px;
  background: radial-gradient(circle, rgba(6, 29, 124, 0.5) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}
.bu-vt-container {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

/* --- Header --- */
.bu-vt-header {
  text-align: center;
  margin-bottom: 50px;
}
.bu-vt-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #FFC107;
  text-transform: uppercase;
  margin-bottom: 14px;
}
.bu-vt-label-dot {
  width: 8px;
  height: 8px;
  background-color: #E63946;
  border-radius: 50%;
  display: inline-block;
  box-shadow: 0 0 8px rgba(230, 57, 70, 0.8);
  animation: buVtPulse 1.5s infinite;
}
@keyframes buVtPulse {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.5); opacity: 0.5; }
}
.bu-vt-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(28px, 4vw, 46px);
  font-weight: 800;
  color: #FFFFFF;
  margin: 0 0 16px 0;
  line-height: 1.2;
}
.bu-vt-title em {
  font-style: italic;
  color: #FFC107;
}
.bu-vt-desc {
  font-size: 15px;
  color: rgba(255, 255, 255, 0.75);
  max-width: 650px;
  margin: 0 auto;
  line-height: 1.7;
}

/* --- Grid Layout --- */
.bu-vt-grid {
  display: grid;
  grid-template-columns: 1fr 360px;
  gap: 28px;
  align-items: start;
}

/* --- Video Player --- */
.bu-vt-player-wrap {
  position: relative;
  background: #000;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255,255,255,0.1);
}
.bu-vt-video {
  width: 100%;
  height: 480px;
  object-fit: cover;
  display: block;
}
.bu-vt-player-overlay {
  position: absolute;
  top: 16px;
  left: 16px;
  right: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  pointer-events: none;
  z-index: 5;
}
.bu-vt-badge {
  background: rgba(4, 15, 74, 0.85);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  padding: 7px 16px;
  border-radius: 30px;
  font-size: 11px;
  font-weight: 700;
  color: #FFFFFF;
  display: flex;
  align-items: center;
  gap: 7px;
  letter-spacing: 0.5px;
}
.bu-vt-badge i { color: #FFC107; }

/* --- Controls Bar --- */
.bu-vt-controls-bar {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to top, rgba(4,15,74,0.95) 0%, rgba(4,15,74,0.5) 60%, transparent 100%);
  padding: 30px 20px 18px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 6;
  gap: 12px;
  flex-wrap: wrap;
}
.bu-vt-controls-left {
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-vt-btn {
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: #FFFFFF;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.22s ease;
  outline: none;
  font-size: 13px;
}
.bu-vt-btn:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #040F4A;
  transform: scale(1.1);
}

/* --- Video Selector Tabs --- */
.bu-vt-tabs {
  display: flex;
  gap: 7px;
  flex-wrap: wrap;
}
.bu-vt-tab-btn {
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: rgba(255,255,255,0.85);
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  letter-spacing: 0.3px;
}
.bu-vt-tab-btn.active,
.bu-vt-tab-btn:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #040F4A;
}

/* --- Side Info Cards --- */
.bu-vt-side-cards {
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.bu-vt-info-card {
  background: rgba(255, 255, 255, 0.06);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 14px;
  padding: 18px 20px;
  display: flex;
  align-items: flex-start;
  gap: 16px;
  transition: all 0.3s ease;
  cursor: default;
}
.bu-vt-info-card:hover {
  background: rgba(255, 255, 255, 0.11);
  border-color: rgba(255, 193, 7, 0.45);
  transform: translateX(4px);
}
.bu-vt-icon-box {
  width: 46px;
  height: 46px;
  min-width: 46px;
  border-radius: 12px;
  background: linear-gradient(135deg, #FFC107 0%, #D99B00 100%);
  color: #040F4A;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  box-shadow: 0 4px 14px rgba(255, 193, 7, 0.35);
}
.bu-vt-card-content h4 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 14.5px;
  font-weight: 700;
  color: #FFFFFF;
  margin: 0 0 5px 0;
  line-height: 1.3;
}
.bu-vt-card-content p {
  font-size: 12.5px;
  color: rgba(255, 255, 255, 0.65);
  margin: 0;
  line-height: 1.5;
}

/* --- Responsive Virtual Tour --- */
@media (max-width: 991px) {
  .bu-vt-grid { grid-template-columns: 1fr; }
  .bu-vt-video { height: 380px; }
  .bu-vt-side-cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
}
@media (max-width: 575px) {
  .bu-vt-section { padding: 60px 16px 50px; }
  .bu-vt-video { height: 260px; }
  .bu-vt-side-cards { grid-template-columns: 1fr; }
  .bu-vt-tabs { gap: 5px; }
  .bu-vt-tab-btn { font-size: 10px; padding: 5px 10px; }
  .bu-vt-controls-bar { flex-direction: column; align-items: flex-start; gap: 10px; }
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->

  <!-- =================== PAGE HERO =================== -->
  <section class="bu-about-hero">
    <div class="bu-about-hero-inner">
      <ul class="bu-about-breadcrumb">
        <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
        <li>About Us</li>
      </ul>
      <span class="bu-about-hero-label">About Bhabha University</span>
      <h1 class="bu-about-hero-title">
        Shaping futures since<br><em>2004.</em>
      </h1>
      <p class="bu-about-hero-desc">
        Bhabha University, Bhopal stands as one of Central India's most respected private universities — 
        committed to academic excellence, research innovation, and producing leaders who make a difference.
      </p>
      <div class="bu-about-hero-stats">
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">20+</span>
          <span class="bu-hero-stat-lbl">Years of Excellence</span>
        </div>
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">25,000+</span>
          <span class="bu-hero-stat-lbl">Alumni Network</span>
        </div>
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">150</span>
          <span class="bu-hero-stat-lbl">Acre Green Campus</span>
        </div>
        <div class="bu-hero-stat-item">
          <span class="bu-hero-stat-num">50+</span>
          <span class="bu-hero-stat-lbl">Programmes Offered</span>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== UNIVERSITY OVERVIEW =================== -->
  <section class="bu-about-section">
    <div class="bu-about-container">
      <div class="bu-overview-grid">
        <!-- Image Side -->
        <div class="bu-overview-img-wrap">
          <img src="<?php echo URL_ROOT;?>new-media/image/bhabha-main-building.jpg" 
               alt="Bhabha University Bhopal Campus" 
               class="bu-overview-img">
          <div class="bu-overview-badge">
            <span class="bu-overview-badge-num">2004</span>
            <span class="bu-overview-badge-lbl">Established</span>
          </div>
        </div>
        <!-- Text Side -->
        <div class="bu-overview-text-wrap">
          <span class="bu-section-label">University Overview</span>
          <h2 class="bu-section-title">A university built<br>for <em>real-world impact.</em></h2>
          <div class="bu-section-divider"></div>
          <p class="bu-section-text">
            Bhabha University, located on NH-12 Narmadapuram Road, Bhopal, Madhya Pradesh, 
            was established by the Ayushmati Education and Social Society. Over two decades, 
            it has grown into a vibrant multi-disciplinary university offering programmes in 
            Engineering, Pharmacy, Dental Sciences, Nursing, Management, Law, Agriculture, 
            Science, Commerce, Education, and Hotel Management.
          </p>
          <ul class="bu-overview-points">
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Approved by AICTE, PCI, DCI, BCI, NCTE &amp; recognized by UGC under 2(f) &amp; 12(B)
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              NAAC Accredited &mdash; committed to quality education and continuous improvement
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Wi-Fi enabled 150-acre green campus with modern labs, library and hostels
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Strong Industry Connect with 500+ companies visiting for campus placements
            </li>
            <li>
              <span class="bu-pt-icon"><i class="fa fa-check"></i></span>
              Active research culture with 120+ labs, patents and international collaborations
            </li>
          </ul>
          <a href="<?php echo href('page.php','id=20');?>" class="bu-overview-link">
            Read Full Overview <i class="fa fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== STATS STRIP =================== -->
  <div class="bu-about-container" style="padding-top: 10px; padding-bottom: 10px;">
    <div class="bu-stats-strip" style="max-width:1240px; border-radius:12px; margin:0 auto;">
      <div class="bu-stat-cell">
        <span class="bu-stat-number">98%</span>
        <span class="bu-stat-label">Placement Rate</span>
      </div>
      <div class="bu-stat-cell">
        <span class="bu-stat-number">120+</span>
        <span class="bu-stat-label">Research Labs</span>
      </div>
      <div class="bu-stat-cell">
        <span class="bu-stat-number">60+</span>
        <span class="bu-stat-label">Global MoUs</span>
      </div>
      <div class="bu-stat-cell">
        <span class="bu-stat-number">₹52L</span>
        <span class="bu-stat-label">Highest Package</span>
      </div>
    </div>
  </div>


  <!-- =================== VISION & MISSION =================== -->
  <section class="bu-about-section bu-about-section-dark">
    <div class="bu-about-container">
      <div style="text-align:center; margin-bottom:40px;">
        <span class="bu-section-label-light">Our Purpose</span>
        <h2 class="bu-section-title-light">Vision & <em>Mission</em></h2>
      </div>

      <div class="bu-vm-grid">
        <div class="bu-vm-card">
          <div class="bu-vm-card-img-wrap">
            <img src="<?php echo URL_ROOT;?>new-media/image/vision.jpeg" alt="Our Vision" class="bu-vm-card-img">
          </div>
          <div class="bu-vm-card-body">
            <div class="bu-vm-icon"><i class="fa fa-eye"></i></div>
            <h3>Our Vision</h3>
            <p>
              To be a globally recognised university that provides transformative, high-quality education across 
              disciplines — producing innovative graduates and leaders who contribute to society, drive 
              sustainability, and shape the future of India and the world.
            </p>
          </div>
        </div>
        <div class="bu-vm-card">
          <div class="bu-vm-card-img-wrap">
            <img src="<?php echo URL_ROOT;?>new-media/image/mission.jpeg" alt="Our Mission" class="bu-vm-card-img">
          </div>
          <div class="bu-vm-card-body">
            <div class="bu-vm-icon"><i class="fa fa-rocket"></i></div>
            <h3>Our Mission</h3>
            <p>
              To provide greater access to higher education — especially for socially and economically 
              disadvantaged youth — through excellence in teaching, research, and community engagement. 
              To foster creativity, critical thinking, and interdisciplinary collaboration that prepares 
              students for the challenges of the 21st century.
            </p>
          </div>
        </div>
      </div>
      <div style="text-align:center; margin-top:32px;">
        <a href="<?php echo href('mission-vision.php');?>" style="display:inline-flex;align-items:center;gap:8px;color:#FFC107;font-size:12px;font-weight:800;letter-spacing:1px;text-transform:uppercase;text-decoration:none;border:2px solid rgba(255,193,7,0.4);padding:12px 28px;border-radius:4px;transition:all 0.25s;" onmouseover="this.style.borderColor='#FFC107';this.style.background='rgba(255,193,7,0.1)';" onmouseout="this.style.borderColor='rgba(255,193,7,0.4)';this.style.background='transparent';">
          Read Full Vision & Mission <i class="fa fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- =================== JOURNEY / TIMELINE =================== -->
  <section class="bu-about-section bu-about-section-alt">
    <div class="bu-about-container">
      <div style="text-align:center; margin-bottom:60px;">
        <span class="bu-section-label">Our Journey</span>
        <h2 class="bu-section-title">Milestones of <em>excellence.</em></h2>
      </div>
      <div class="bu-timeline">
        <!-- Item 1 (Left) -->
        <div class="bu-timeline-item">
          <div class="bu-timeline-dot"></div>
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2004</span>
            <h4>Foundation Established</h4>
            <p>Bhabha University was founded by Ayushmati Education and Social Society with a vision to provide quality higher education in Central India.</p>
          </div>
        </div>

        <!-- Item 2 (Right) -->
        <div class="bu-timeline-item">
          <div class="bu-timeline-dot"></div>
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2010</span>
            <h4>Multi-Discipline Expansion</h4>
            <p>Expanded to include Engineering, Pharmacy, Dental Sciences, Nursing, and Management schools on the 150-acre Narmadapuram Road campus.</p>
          </div>
        </div>

        <!-- Item 3 (Left) -->
        <div class="bu-timeline-item">
          <div class="bu-timeline-dot"></div>
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2015</span>
            <h4>National Accreditation</h4>
            <p>Achieved NAAC accreditation and UGC recognition under 2(f) &amp; 12(B), marking a major milestone in quality assurance and credibility.</p>
          </div>
        </div>

        <!-- Item 4 (Right) -->
        <div class="bu-timeline-item">
          <div class="bu-timeline-dot"></div>
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2020</span>
            <h4>Digital Transformation</h4>
            <p>Launched smart classrooms, online examination systems, ERP portal, and digital library resources — empowering students in the digital era.</p>
          </div>
        </div>

        <!-- Item 5 (Left) -->
        <div class="bu-timeline-item">
          <div class="bu-timeline-dot"></div>
          <div class="bu-timeline-item-content">
            <span class="bu-timeline-year">2024+</span>
            <h4>Global Research Excellence</h4>
            <p>120+ research labs, 60+ international MoUs, 1,200+ publications, and placements exceeding ₹52 LPA — setting new benchmarks every year.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== VIRTUAL TOUR OF CAMPUS =================== -->
  <section class="bu-vt-section" id="virtualTour">
    <div class="bu-vt-container">
      
      <!-- Section Header -->
      <div class="bu-vt-header">
        <span class="bu-vt-label">
          <span class="bu-vt-label-dot"></span>
          Immersive Experience &nbsp;·&nbsp; 360° Drone View
        </span>
        <h2 class="bu-vt-title">Virtual Tour of <em>Bhabha Campus</em></h2>
        <p class="bu-vt-desc">
          Take a visual journey through our 150-acre lush green campus in Bhopal. Explore modern academic blocks, research facilities, sports arenas, and vibrant student life.
        </p>
      </div>

      <!-- Player & Info Grid -->
      <div class="bu-vt-grid">
        
        <!-- Video Player -->
        <div class="bu-vt-player-wrap">
          
          <!-- Floating Badges -->
          <div class="bu-vt-player-overlay">
            <span class="bu-vt-badge">
              <i class="fa fa-video-camera"></i> Live Campus Video
            </span>
            <span class="bu-vt-badge">
              <i class="fa fa-map-marker"></i> Bhopal, MP
            </span>
          </div>

          <video id="buVtVideo" class="bu-vt-video" autoplay loop muted playsinline poster="<?php echo URL_ROOT;?>new-media/image/campus-aerial.png">
            <source id="buVtSource" src="<?php echo URL_ROOT;?>new-media/image/hero/about.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
          </video>

          <!-- Custom Player Controls & Selector -->
          <div class="bu-vt-controls-bar">
            <div class="bu-vt-controls-left">
              <button id="buVtPlayBtn" class="bu-vt-btn" title="Play / Pause">
                <i class="fa fa-pause"></i>
              </button>
              <button id="buVtMuteBtn" class="bu-vt-btn" title="Mute / Unmute Sound">
                <i class="fa fa-volume-off"></i>
              </button>
            </div>
            
            <div class="bu-vt-tabs">
              <button class="bu-vt-tab-btn" onclick="switchVtVideo('<?php echo URL_ROOT;?>new-media/image/hero/drone-campus.mp4', this)">
                <i class="fa fa-plane"></i> Aerial Drone
              </button>
              <button class="bu-vt-tab-btn" onclick="switchVtVideo('<?php echo URL_ROOT;?>new-media/image/hero/hero2.mp4', this)">
                <i class="fa fa-building"></i> Campus Walk
              </button>
              <button class="bu-vt-tab-btn" onclick="switchVtVideo('<?php echo URL_ROOT;?>new-media/image/hero/hero2.mp4', this)">
                <i class="fa fa-flask"></i> Labs &amp; Quad
              </button>
              <button class="bu-vt-tab-btn active" onclick="switchVtVideo('<?php echo URL_ROOT;?>new-media/image/hero/about.mp4', this)">
                <i class="fa fa-graduation-cap"></i> Student Life
              </button>
            </div>
          </div>
        </div>

        <!-- Side Highlights Cards -->
        <div class="bu-vt-side-cards">
          
          <div class="bu-vt-info-card">
            <div class="bu-vt-icon-box"><i class="fa fa-tree"></i></div>
            <div class="bu-vt-card-content">
              <h4>150-Acre Green Campus</h4>
              <p>Eco-friendly campus with solar energy, botanical gardens, and spacious plazas.</p>
            </div>
          </div>

          <div class="bu-vt-info-card">
            <div class="bu-vt-icon-box"><i class="fa fa-university"></i></div>
            <div class="bu-vt-card-content">
              <h4>15 Schools &amp; Institutes</h4>
              <p>Engineering, Medical, Dental, Pharmacy, Law, Agriculture &amp; Management blocks.</p>
            </div>
          </div>

          <div class="bu-vt-info-card">
            <div class="bu-vt-icon-box"><i class="fa fa-flask"></i></div>
            <div class="bu-vt-card-content">
              <h4>120+ Modern Labs</h4>
              <p>Hi-tech practical skill labs, research wings, and computing centers.</p>
            </div>
          </div>

          <div class="bu-vt-info-card">
            <div class="bu-vt-icon-box"><i class="fa fa-hospital-o"></i></div>
            <div class="bu-vt-card-content">
              <h4>500-Bed Hospital</h4>
              <p>Full-fledged multi-speciality teaching hospital &amp; clinical facility.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  <script>
  function switchVtVideo(src, btn) {
    var video = document.getElementById('buVtVideo');
    var source = document.getElementById('buVtSource');
    if (!video || !source) return;
    
    source.src = src;
    video.load();
    video.play();

    var buttons = document.querySelectorAll('.bu-vt-tab-btn');
    buttons.forEach(function(b) { b.classList.remove('active'); });
    if (btn) btn.classList.add('active');
  }

  document.addEventListener('DOMContentLoaded', function() {
    var video = document.getElementById('buVtVideo');
    var playBtn = document.getElementById('buVtPlayBtn');
    var muteBtn = document.getElementById('buVtMuteBtn');

    if (playBtn && video) {
      playBtn.addEventListener('click', function() {
        if (video.paused) {
          video.play();
          playBtn.innerHTML = '<i class="fa fa-pause"></i>';
        } else {
          video.pause();
          playBtn.innerHTML = '<i class="fa fa-play"></i>';
        }
      });
    }

    if (muteBtn && video) {
      muteBtn.addEventListener('click', function() {
        video.muted = !video.muted;
        if (video.muted) {
          muteBtn.innerHTML = '<i class="fa fa-volume-off"></i>';
        } else {
          muteBtn.innerHTML = '<i class="fa fa-volume-up"></i>';
        }
      });
    }
  });
  </script>

  <!-- =================== CAMPUS HIGHLIGHTS / FACILITIES =================== -->
  <section class="bu-about-section">
    <div class="bu-about-container">
      <div style="text-align:center; margin-bottom:40px;">
        <span class="bu-section-label">Campus Life &amp; Infrastructure</span>
        <h2 class="bu-section-title">World-class <em>facilities &amp; environment.</em></h2>
      </div>
      <div class="bu-campus-grid">
        <div class="bu-campus-card">
          <div class="bu-campus-img-wrap">
            <img src="<?php echo URL_ROOT;?>images/library.jpg" alt="Central Library" class="bu-campus-img">
          </div>
          <div class="bu-campus-info">
            <h4>Central Library</h4>
            <p>50,000+ books, digital e-journals &amp; silent reading halls</p>
          </div>
        </div>
        <div class="bu-campus-card">
          <div class="bu-campus-img-wrap">
            <img src="<?php echo URL_ROOT;?>images/solar.jpg" alt="Solar & Research Labs" class="bu-campus-img">
          </div>
          <div class="bu-campus-info">
            <h4>Solar &amp; Green Energy</h4>
            <p>Eco-friendly campus with advanced solar research wing</p>
          </div>
        </div>
        <div class="bu-campus-card">
          <div class="bu-campus-img-wrap">
            <img src="<?php echo URL_ROOT;?>images/radio.jpg" alt="Radio Bhabha FM Studio" class="bu-campus-img">
          </div>
          <div class="bu-campus-info">
            <h4>Radio Bhabha 90.4 FM</h4>
            <p>Community radio station broadcasting student media projects</p>
          </div>
        </div>
        <div class="bu-campus-card">
          <div class="bu-campus-img-wrap">
            <img src="<?php echo URL_ROOT;?>images/skill_lab.jpg" alt="Modern Skill & Practical Labs" class="bu-campus-img" onerror="this.src='<?php echo URL_ROOT;?>extra-images/col-3-thum5.jpg';">
          </div>
          <div class="bu-campus-info">
            <h4>Modern Skill Labs</h4>
            <p>State-of-the-art practical simulation &amp; training centers</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =================== EXPLORE ABOUT SUB-PAGES =================== -->
  <section class="bu-about-section bu-about-section-alt">
    <div class="bu-about-container">
      <div style="text-align:center; margin-bottom:40px;">
        <span class="bu-section-label">Explore Further</span>
        <h2 class="bu-section-title">Everything about <em>Bhabha University.</em></h2>
      </div>
      <div class="bu-subpages-grid">

        <a href="<?php echo href('page.php','id=20');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>new-media/image/bhabha-engineering-building.jpg" alt="University Overview" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-university"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>University Overview</h4>
              <p>Learn about our establishment, governance, campus facilities, and academic ecosystem.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('mission-vision.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>new-media/image/vision.jpeg" alt="Vision & Mission" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-eye"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Vision &amp; Mission</h4>
              <p>Understand the core purpose that drives every decision and initiative at Bhabha University.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('infrastructure.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>new-media/image/bhabha-main-building.jpg" alt="Campus & Infrastructure" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-building"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Campus &amp; Infrastructure</h4>
              <p>Discover our 150-acre green campus — smart classrooms, labs, hostels, library and more.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('page.php','id=18');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-students.jpg" alt="Core Values" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-heart"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Core Values</h4>
              <p>The principles of integrity, innovation, inclusivity, and excellence that define who we are.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('leadership.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>images/vcpic.jpg" alt="Administration & Leadership" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-users"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Administration &amp; Leadership</h4>
              <p>Meet our visionary Chancellor, Vice-Chancellor, and the leadership team steering the university.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('page.php','id=19');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>extra-images/student-3.jpg" alt="Why Choose Bhabha" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-star"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Why Choose Bhabha</h4>
              <p>From NAAC accreditation to global placements — the reasons that make us the right choice.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('awards.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>extra-images/filterable5.jpg" alt="Awards & Achievements" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-trophy"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Awards &amp; Achievements</h4>
              <p>Recognised nationally and globally for academic excellence, innovation, and social impact.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('advisory.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>extra-images/intro-3.jpg" alt="Cells & Committees" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-sitemap"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Cells &amp; Committees</h4>
              <p>Our active statutory cells, grievance committees, ICC, IQAC and other regulatory bodies.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

        <a href="<?php echo href('approvals.php');?>" class="bu-subpage-card">
          <div class="bu-subpage-img-wrap">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-entrance.png" alt="Approvals & Recognitions" class="bu-subpage-img">
            <div class="bu-subpage-icon-badge"><i class="fa fa-certificate"></i></div>
          </div>
          <div class="bu-subpage-body">
            <div>
              <h4>Approvals &amp; Recognitions</h4>
              <p>Official approvals from UGC, AICTE, PCI, DCI, BCI, NCTE and NAAC accreditation details.</p>
            </div>
            <div class="bu-subpage-arrow">Explore <i class="fa fa-arrow-right"></i></div>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- =================== ACCREDITATIONS =================== -->
  <section class="bu-about-section" style="padding-top:50px; padding-bottom:70px;">
    <div class="bu-about-container" style="text-align:center;">
      <span class="bu-section-label">Statutory Approvals</span>
      <h2 class="bu-section-title">Recognised by <em>leading bodies.</em></h2>
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

  <!-- =================== CTA =================== -->
  <div class="bu-about-cta">
    <h2>Ready to <em>begin your journey</em>?</h2>
    <p>Join thousands of students who have transformed their lives at Bhabha University, Bhopal.</p>
    <div class="bu-cta-btns">
      <a href="<?php echo href('enquiry.php');?>" class="bu-cta-btn-primary">Apply for Admission</a>
      <a href="<?php echo href('contact.php');?>" class="bu-cta-btn-secondary">Contact Us</a>
    </div>
  </div>

  <!--FOOTER START-->
  <?php include('inc.footer.php');?>
  <!--FOOTER END-->
</div>
<!--KF KODE WRAPPER WRAP END-->
<?php include('inc.footer.js.php');?>
</body>
</html>
