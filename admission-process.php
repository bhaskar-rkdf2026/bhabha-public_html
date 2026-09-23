<?php 
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admission Process &amp; Guidelines - Bhabha University Bhopal</title>
<meta name="description" content="Official admission process, step-by-step roadmap, eligibility verification, document checklist, and refund policy for Admissions 2026-27 at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>

<style>
/* ============================================================
   BHABHA UNIVERSITY - ADMISSION PROCESS STATIC STYLING
   ============================================================ */
@keyframes buPulseGlow {
  0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(217, 155, 0, 0.4); }
  70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(217, 155, 0, 0); }
  100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(217, 155, 0, 0); }
}

@keyframes buFlowLine {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.bu-inner-layout {
  width: 100% !important;
  max-width: 1200px !important;
  box-sizing: border-box !important;
}

.bu-inner-content {
  min-width: 0 !important;
  width: 100% !important;
  max-width: 100% !important;
  box-sizing: border-box !important;
}

.bu-content-card {
  min-width: 0 !important;
  width: 100% !important;
  max-width: 100% !important;
  box-sizing: border-box !important;
  overflow: hidden !important;
}

/* Roadmap Wrapper Canvas */
.bu-roadmap-wrapper {
  background: radial-gradient(#E2E8F0 1.2px, transparent 1.2px) 0 0 / 22px 22px, linear-gradient(180deg, #F8FAFC 0%, #FFFFFF 100%);
  border: 1.5px solid #E2E8F0;
  border-radius: 18px;
  padding: 28px 22px;
  margin: 24px 0 36px;
  position: relative;
  box-shadow: 0 8px 30px rgba(10, 27, 84, 0.04);
  width: 100% !important;
  max-width: 100% !important;
  box-sizing: border-box !important;
}

.bu-roadmap-top-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 20px;
  padding-bottom: 14px;
  border-bottom: 1.5px solid #E2E8F0;
}

.bu-roadmap-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #0A1B54;
  color: #FFC107;
  font-size: 11.5px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(10, 27, 84, 0.15);
}

.bu-roadmap-tag .bu-live-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #10B981;
  box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
  animation: buPulseGlow 2s infinite;
}

/* Horizontal Pipeline Progress Track */
.bu-pipeline-tracker {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  background: #FFFFFF;
  border: 1px solid #CBD5E1;
  border-radius: 12px;
  padding: 12px 16px;
  margin-bottom: 26px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  width: 100%;
  box-sizing: border-box;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.bu-pipeline-tracker::before {
  content: '';
  position: absolute;
  left: 36px;
  right: 36px;
  top: 50%;
  height: 3px;
  background: linear-gradient(90deg, #2563EB, #6366F1, #D99B00, #E11D48, #0D9488, #059669);
  background-size: 200% 200%;
  animation: buFlowLine 4s ease infinite;
  z-index: 1;
  transform: translateY(-50%);
}

.bu-pipeline-step-node {
  position: relative;
  z-index: 2;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
  background: #FFFFFF;
  padding: 0 6px;
  cursor: default;
  transition: transform 0.25s ease;
  flex-shrink: 0;
}

.bu-pipeline-step-node:hover {
  transform: translateY(-2px);
}

.bu-step-circle-mini {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #0A1B54;
  color: #FFC107;
  font-size: 11px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #FFFFFF;
  box-shadow: 0 2px 8px rgba(10, 27, 84, 0.2);
  transition: all 0.3s ease;
}

.bu-pipeline-step-node:hover .bu-step-circle-mini {
  background: #FFC107;
  color: #0A1B54;
  transform: scale(1.15);
}

.bu-pipeline-step-node.final-node .bu-step-circle-mini {
  background: #059669;
  color: #FFFFFF;
}

.bu-step-name-mini {
  font-size: 10.5px;
  font-weight: 700;
  color: #475569;
  white-space: nowrap;
}

/* 6-Stage Interactive Roadmap Cards Grid (Spacious 2-Column Pairs) */
.bu-roadmap-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 22px;
  position: relative;
  width: 100%;
  box-sizing: border-box;
}

.bu-roadmap-card {
  background: #FFFFFF;
  border: 1.5px solid #E2E8F0;
  border-top: 4px solid var(--card-accent, #0A1B54);
  border-radius: 14px;
  padding: 24px 22px 20px;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 4px 16px rgba(10, 27, 84, 0.04);
  width: 100%;
  min-width: 0;
  box-sizing: border-box;
  word-break: break-word;
  overflow-wrap: break-word;
}

.bu-roadmap-card:hover {
  transform: translateY(-6px) scale(1.01);
  border-color: var(--card-accent, #0A1B54);
  border-top-width: 5px;
  box-shadow: 0 16px 32px -8px rgba(10, 27, 84, 0.15), 0 0 0 1px var(--card-accent, #0A1B54);
}

/* Watermark Number in Card */
.bu-card-watermark {
  position: absolute;
  right: 14px;
  top: 10px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 56px;
  font-weight: 900;
  line-height: 1;
  color: rgba(10, 27, 84, 0.04);
  user-select: none;
  pointer-events: none;
  z-index: 1;
  transition: all 0.35s ease;
}

.bu-roadmap-card:hover .bu-card-watermark {
  color: rgba(10, 27, 84, 0.08);
  transform: scale(1.08) translateX(-3px);
}

/* Card Header Section */
.bu-card-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 16px;
  position: relative;
  z-index: 2;
  gap: 10px;
}

.bu-card-step-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 0.6px;
  text-transform: uppercase;
  color: var(--card-accent, #0A1B54);
  background: var(--card-badge-bg, rgba(10, 27, 84, 0.08));
  padding: 5px 10px;
  border-radius: 6px;
  border: 1px solid var(--card-badge-border, transparent);
  flex-shrink: 0;
}

.bu-card-icon-orb {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: var(--card-icon-bg, #F1F5F9);
  color: var(--card-accent, #0A1B54);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
  flex-shrink: 0;
  margin-left: auto;
  transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.bu-roadmap-card:hover .bu-card-icon-orb {
  background: var(--card-accent, #0A1B54);
  color: #FFFFFF;
  transform: scale(1.15) rotate(6deg);
  box-shadow: 0 8px 20px rgba(10, 27, 84, 0.25);
}

/* Card Content */
.bu-card-body {
  position: relative;
  z-index: 2;
  width: 100%;
}

.bu-card-body h4 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 15.5px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px 0;
  line-height: 1.35;
  transition: color 0.2s ease;
  word-break: break-word;
  overflow-wrap: break-word;
}

.bu-roadmap-card:hover .bu-card-body h4 {
  color: var(--card-accent, #0A1B54);
}

.bu-card-body p {
  font-size: 13px !important;
  color: #475569 !important;
  line-height: 1.6 !important;
  margin: 0 0 16px 0 !important;
  word-break: break-word;
  overflow-wrap: break-word;
}

/* Card Footer Action / Status Tag */
.bu-card-foot {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 10px;
  border-top: 1px solid #F1F5F9;
  position: relative;
  z-index: 2;
  gap: 8px;
}

.bu-card-pill-info {
  font-size: 11px;
  font-weight: 700;
  color: #64748B;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  word-break: break-word;
}

.bu-card-arrow-btn {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #F1F5F9;
  color: #0A1B54;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 10.5px;
  flex-shrink: 0;
  transition: all 0.3s ease;
}

.bu-roadmap-card:hover .bu-card-arrow-btn {
  background: var(--card-accent, #0A1B54);
  color: #FFFFFF;
  transform: translateX(3px);
}

/* ============================================================
   ADMISSION RULES CARDS (HOVER & STYLING)
   ============================================================ */
.bu-rules-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin: 20px 0 32px;
  width: 100%;
  box-sizing: border-box;
}

.bu-rule-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-left: 4px solid #0A1B54;
  border-radius: 10px;
  padding: 18px 18px;
  box-shadow: 0 2px 10px rgba(6, 29, 124, 0.03);
  transition: all 0.3s ease;
  width: 100%;
  min-width: 0;
  box-sizing: border-box;
  word-break: break-word;
}

.bu-rule-card:hover {
  transform: translateY(-4px);
  border-color: #CBD5E1;
  border-left-color: #D99B00;
  box-shadow: 0 8px 24px rgba(10, 27, 84, 0.08);
}

.bu-rule-card h5 {
  font-size: 14.5px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 6px 0;
  display: flex;
  align-items: center;
  gap: 8px;
  word-break: break-word;
}

.bu-rule-card h5 i {
  color: #D99B00;
  font-size: 14.5px;
  flex-shrink: 0;
}

.bu-rule-card p {
  font-size: 13px !important;
  color: #475569 !important;
  line-height: 1.6 !important;
  margin: 0 !important;
  word-break: break-word;
}

/* Documents Grid */
.bu-docs-panel-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 20px;
  margin: 24px 0 32px;
  width: 100%;
  box-sizing: border-box;
}

.bu-doc-checklist-panel {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 22px 20px;
  border-top: 4px solid #0A1B54;
  box-shadow: 0 4px 16px rgba(0,0,0,0.03);
  width: 100%;
  min-width: 0;
  box-sizing: border-box;
  word-break: break-word;
}

.bu-doc-checklist-panel.highlight-panel {
  background: #FFFDF5;
  border-top-color: #FFC107;
}

.bu-doc-panel-head {
  font-size: 15.5px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 14px 0;
  display: flex;
  align-items: center;
  gap: 10px;
  word-break: break-word;
}

.bu-doc-panel-head i {
  color: #D99B00;
  font-size: 16px;
  flex-shrink: 0;
}

.bu-doc-items-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 9px;
  width: 100%;
}

.bu-doc-items-list li {
  display: flex;
  align-items: flex-start;
  gap: 9px;
  font-size: 13px;
  line-height: 1.55;
  color: #334155;
  padding: 3px 5px;
  border-radius: 6px;
  transition: background 0.2s ease;
  word-break: break-word;
}

.bu-doc-items-list li:hover {
  background: rgba(10, 27, 84, 0.04);
}

.bu-doc-items-list li i {
  color: #059669;
  font-size: 13px;
  margin-top: 3px;
  flex-shrink: 0;
  transition: transform 0.2s ease;
}

.bu-doc-items-list li:hover i {
  transform: scale(1.2);
}

.bu-doc-items-list.orig-items li i {
  color: #D99B00;
}

/* ============================================================
   HIGH-CONTRAST READABLE REFUND POLICY ALERT BOX
   ============================================================ */
.bu-policy-alert-box {
  background: #FFFDF2 !important;
  border: 2px solid #FCD34D !important;
  border-left: 6px solid #D99B00 !important;
  border-radius: 14px !important;
  padding: 26px 22px !important;
  margin-top: 26px !important;
  box-shadow: 0 6px 24px rgba(217, 155, 0, 0.12) !important;
  transition: box-shadow 0.3s ease;
  width: 100% !important;
  box-sizing: border-box !important;
  word-break: break-word !important;
}

.bu-policy-alert-box:hover {
  box-shadow: 0 10px 30px rgba(217, 155, 0, 0.18) !important;
}

.bu-policy-alert-box h4 {
  font-size: 17px !important;
  font-weight: 800 !important;
  color: #92400E !important;
  margin: 0 0 12px 0 !important;
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
  word-break: break-word !important;
}

.bu-policy-alert-box h4 i {
  color: #D99B00 !important;
  font-size: 20px !important;
  flex-shrink: 0 !important;
}

.bu-policy-highlight-pills {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin: 12px 0 14px 0;
}

.bu-policy-pill {
  background: #FEF3C7;
  color: #92400E;
  border: 1.5px solid #FDE68A;
  font-size: 11.5px;
  font-weight: 800;
  padding: 5px 12px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 7px;
  transition: all 0.25s ease;
  box-shadow: 0 2px 6px rgba(217, 155, 0, 0.08);
}

.bu-policy-pill:hover {
  background: #FDE68A;
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(217, 155, 0, 0.15);
}

.bu-policy-alert-box p {
  font-size: 14px !important;
  line-height: 1.75 !important;
  color: #1E293B !important;
  margin: 0 0 12px 0 !important;
  word-break: break-word !important;
}

.bu-policy-alert-box strong,
.bu-policy-alert-box b {
  color: #0A1B54 !important;
  font-weight: 800 !important;
}

.bu-policy-alert-box .bu-policy-footer {
  font-size: 13px !important;
  color: #475569 !important;
  border-top: 1.5px solid #FDE68A !important;
  padding-top: 12px !important;
  margin-top: 12px !important;
  word-break: break-word !important;
}

/* Action CTA Bar */
.bu-page-cta-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 28px;
  padding-top: 22px;
  border-top: 1px solid #E2E8F0;
  width: 100%;
  box-sizing: border-box;
}

.bu-btn-page-gold {
  background: #FFC107;
  color: #0A1B54 !important;
  font-size: 13px;
  font-weight: 800;
  padding: 12px 22px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 14px rgba(255, 193, 7, 0.25);
}

.bu-btn-page-gold:hover {
  background: #E5AC00;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(255, 193, 7, 0.35);
}

.bu-btn-page-navy {
  background: #0A1B54;
  color: #FFFFFF !important;
  font-size: 13px;
  font-weight: 800;
  padding: 12px 22px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
}

.bu-btn-page-navy:hover {
  background: #061D7C;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(10, 27, 84, 0.2);
}

/* ============================================================
   RESPONSIVE MEDIA QUERIES (TABLET & MOBILE SCREENS)
   ============================================================ */
@media (max-width: 991px) {
  .bu-rules-grid {
    grid-template-columns: 1fr;
    gap: 14px;
  }
  .bu-docs-panel-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
}

@media (max-width: 767px) {
  .bu-inner-layout {
    padding: 20px 12px 40px !important;
    gap: 20px !important;
  }
  .bu-content-card {
    padding: 20px 14px !important;
    border-radius: 12px !important;
    margin-bottom: 20px !important;
  }
  .bu-content-h2 {
    font-size: 22px !important;
  }
  .bu-roadmap-wrapper {
    padding: 16px 10px !important;
    border-radius: 14px !important;
    margin: 16px 0 24px !important;
  }
  .bu-roadmap-top-bar {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 12px;
  }
  .bu-pipeline-tracker {
    padding: 10px 10px !important;
    margin-bottom: 16px !important;
    justify-content: flex-start;
    gap: 16px;
  }
  .bu-pipeline-tracker::before {
    left: 24px;
    right: 24px;
  }
  .bu-roadmap-grid {
    grid-template-columns: 1fr !important;
    gap: 14px !important;
  }
  .bu-roadmap-card {
    padding: 16px 14px 14px !important;
    border-radius: 12px !important;
  }
  .bu-card-watermark {
    font-size: 42px !important;
    right: 8px !important;
    top: 4px !important;
    opacity: 0.05 !important;
  }
  .bu-card-head {
    margin-bottom: 10px !important;
  }
  .bu-card-icon-orb {
    width: 38px !important;
    height: 38px !important;
    font-size: 16px !important;
    border-radius: 10px !important;
  }
  .bu-card-body h4 {
    font-size: 15px !important;
    margin-bottom: 6px !important;
  }
  .bu-card-body p {
    font-size: 13px !important;
    line-height: 1.6 !important;
    margin-bottom: 12px !important;
  }
  .bu-card-foot {
    padding-top: 8px !important;
  }
  .bu-policy-alert-box {
    padding: 18px 14px !important;
    border-radius: 12px !important;
    margin-top: 20px !important;
  }
  .bu-policy-alert-box h4 {
    font-size: 15.5px !important;
  }
  .bu-policy-alert-box p {
    font-size: 13px !important;
    line-height: 1.65 !important;
  }
  .bu-policy-highlight-pills {
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 6px !important;
  }
  .bu-policy-pill {
    font-size: 11px !important;
    padding: 6px 12px !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }
  .bu-page-cta-bar {
    flex-direction: column !important;
    gap: 10px !important;
    padding-top: 18px !important;
  }
  .bu-btn-page-gold,
  .bu-btn-page-navy {
    width: 100% !important;
    justify-content: center !important;
    text-align: center !important;
    padding: 12px 16px !important;
    box-sizing: border-box !important;
  }
}

@media (max-width: 480px) {
  .bu-inner-layout {
    padding: 12px 6px 30px !important;
  }
  .bu-content-card {
    padding: 16px 10px !important;
  }
  .bu-roadmap-wrapper {
    padding: 12px 8px !important;
  }
  .bu-doc-checklist-panel {
    padding: 16px 12px !important;
  }
  .bu-doc-items-list li {
    font-size: 12.5px !important;
    gap: 7px !important;
  }
  .bu-rule-card {
    padding: 14px 12px !important;
  }
  .bu-rule-card h5 {
    font-size: 13.5px !important;
  }
  .bu-rule-card p {
    font-size: 12px !important;
  }
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Admission <em>Process &amp; Guidelines</em>';
  $page_subtitle = 'Official admission roadmap, seat allotment criteria, document checklists, and refund policy for Session 2026-27.';
  $page_icon     = 'fa-sliders';
  $breadcrumbs   = [
    ['label' => 'Home',        'url' => URL_ROOT],
    ['label' => 'Admissions',  'url' => href('admissions.php')],
    ['label' => 'Admission Process', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php 
      $active_page = 'process';
      include('inc.admissions-sidebar.php');
    ?>

    <main class="bu-inner-content">

      <!-- ============================================================
           STANDALONE STATIC ADMISSION PROCESS PAGE
           ============================================================ -->
      <div class="bu-content-card">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:12px;">
          <div>
            <span class="bu-content-label">Admissions 2026-27</span>
            <h2 class="bu-content-h2" style="margin-bottom:0;">Admission <em>Process &amp; Guidelines</em></h2>
          </div>
          <span style="font-size:12px; font-weight:800; color:#059669; background:#ECFDF5; border:1px solid #A7F3D0; padding:4px 14px; border-radius:20px; display:inline-flex; align-items:center; gap:6px;">
            <i class="fa fa-check-circle"></i> Session 2026-27 Active
          </span>
        </div>
        <div class="bu-content-divider"></div>

        <p style="font-size:14.5px; color:#4B5563; line-height:1.75; margin:0 0 20px 0;">
          For information about the courses offered under various Constituent Institutions and Teaching Departments of Bhabha University — including seat intake, minimum eligibility criteria, and fee structure — please explore our official website or consult the Central Counseling Cell.
        </p>

        <!-- INTERACTIVE ANIMATED ADMISSION ROADMAP & FLOWCHART -->
        <div class="bu-roadmap-wrapper">
          <div class="bu-roadmap-top-bar">
            <div>
              <span class="bu-roadmap-tag">
                <span class="bu-live-dot"></span> Official 6-Stage Roadmap
              </span>
            </div>
            <div style="font-size:12.5px; font-weight:700; color:#64748B;">
              <i class="fa fa-info-circle" style="color:#D99B00;"></i> Follow each consecutive step for verified enrollment
            </div>
          </div>

          <!-- Horizontal Pipeline Progress Track -->
          <div class="bu-pipeline-tracker">
            <div class="bu-pipeline-step-node">
              <div class="bu-step-circle-mini">01</div>
              <span class="bu-step-name-mini">Enquiry &amp; Form</span>
            </div>
            <div class="bu-pipeline-step-node">
              <div class="bu-step-circle-mini">02</div>
              <span class="bu-step-name-mini">Eligibility Check</span>
            </div>
            <div class="bu-pipeline-step-node">
              <div class="bu-step-circle-mini">03</div>
              <span class="bu-step-name-mini">Docs Upload</span>
            </div>
            <div class="bu-pipeline-step-node">
              <div class="bu-step-circle-mini">04</div>
              <span class="bu-step-name-mini">Seat Allotment</span>
            </div>
            <div class="bu-pipeline-step-node">
              <div class="bu-step-circle-mini">05</div>
              <span class="bu-step-name-mini">Fee Deposit</span>
            </div>
            <div class="bu-pipeline-step-node final-node">
              <div class="bu-step-circle-mini"><i class="fa fa-check"></i></div>
              <span class="bu-step-name-mini" style="color:#059669; font-weight:800;">Admitted</span>
            </div>
          </div>

          <!-- 6-Stage Interactive Roadmap Cards Grid -->
          <div class="bu-roadmap-grid">

            <!-- STAGE 01 -->
            <div class="bu-roadmap-card" style="--card-accent:#2563EB; --card-badge-bg:rgba(37,99,235,0.08); --card-badge-border:rgba(37,99,235,0.2); --card-icon-bg:#EFF6FF;">
              <div class="bu-card-watermark">01</div>
              <div class="bu-card-head">
                <span class="bu-card-step-badge"><i class="fa fa-play-circle"></i> Stage 01 &bull; Start</span>
                <div class="bu-card-icon-orb"><i class="fa fa-file-text-o"></i></div>
              </div>
              <div class="bu-card-body">
                <h4>Enquiry &amp; Registration Form</h4>
                <p>Fill and submit the official admission enquiry form online via University ERP Portal or offline at the Central Counseling Cell.</p>
              </div>
              <div class="bu-card-foot">
                <span class="bu-card-pill-info"><i class="fa fa-globe" style="color:#2563EB;"></i> Online / Offline Mode</span>
                <div class="bu-card-arrow-btn"><i class="fa fa-arrow-right"></i></div>
              </div>
            </div>

            <!-- STAGE 02 -->
            <div class="bu-roadmap-card" style="--card-accent:#6366F1; --card-badge-bg:rgba(99,102,241,0.08); --card-badge-border:rgba(99,102,241,0.2); --card-icon-bg:#EEF2FF;">
              <div class="bu-card-watermark">02</div>
              <div class="bu-card-head">
                <span class="bu-card-step-badge"><i class="fa fa-check-circle-o"></i> Stage 02</span>
                <div class="bu-card-icon-orb"><i class="fa fa-check-square-o"></i></div>
              </div>
              <div class="bu-card-body">
                <h4>Check Eligibility &amp; Merit</h4>
                <p>Thorough verification of minimum educational criteria (10+2 / Diploma / Graduation) and entrance exam score ranking.</p>
              </div>
              <div class="bu-card-foot">
                <span class="bu-card-pill-info"><i class="fa fa-percent" style="color:#6366F1;"></i> Qualifying Cutoff</span>
                <div class="bu-card-arrow-btn"><i class="fa fa-arrow-right"></i></div>
              </div>
            </div>

            <!-- STAGE 03 -->
            <div class="bu-roadmap-card" style="--card-accent:#D99B00; --card-badge-bg:rgba(217,155,0,0.08); --card-badge-border:rgba(217,155,0,0.25); --card-icon-bg:#FEF3C7;">
              <div class="bu-card-watermark">03</div>
              <div class="bu-card-head">
                <span class="bu-card-step-badge"><i class="fa fa-upload"></i> Stage 03</span>
                <div class="bu-card-icon-orb"><i class="fa fa-cloud-upload"></i></div>
              </div>
              <div class="bu-card-body">
                <h4>Upload &amp; Submit Documents</h4>
                <p>Furnish 2 complete sets of self-attested photocopies covering all academic marksheets, caste, income, domicile &amp; ID proofs.</p>
              </div>
              <div class="bu-card-foot">
                <span class="bu-card-pill-info"><i class="fa fa-clone" style="color:#D99B00;"></i> 2 Attested Sets</span>
                <div class="bu-card-arrow-btn"><i class="fa fa-arrow-right"></i></div>
              </div>
            </div>

            <!-- STAGE 04 -->
            <div class="bu-roadmap-card" style="--card-accent:#E11D48; --card-badge-bg:rgba(225,29,72,0.08); --card-badge-border:rgba(225,29,72,0.2); --card-icon-bg:#FFE4E6;">
              <div class="bu-card-watermark">04</div>
              <div class="bu-card-head">
                <span class="bu-card-step-badge"><i class="fa fa-users"></i> Stage 04</span>
                <div class="bu-card-icon-orb"><i class="fa fa-id-badge"></i></div>
              </div>
              <div class="bu-card-body">
                <h4>Counseling &amp; Seat Allotment</h4>
                <p>Merit counseling and institutional seat allocation as per regulatory guidelines, University ordinance &amp; MP reservation policies.</p>
              </div>
              <div class="bu-card-foot">
                <span class="bu-card-pill-info"><i class="fa fa-shield" style="color:#E11D48;"></i> Merit &amp; Quota Base</span>
                <div class="bu-card-arrow-btn"><i class="fa fa-arrow-right"></i></div>
              </div>
            </div>

            <!-- STAGE 05 -->
            <div class="bu-roadmap-card" style="--card-accent:#0D9488; --card-badge-bg:rgba(13,148,136,0.08); --card-badge-border:rgba(13,148,136,0.2); --card-icon-bg:#CCFBF1;">
              <div class="bu-card-watermark">05</div>
              <div class="bu-card-head">
                <span class="bu-card-step-badge"><i class="fa fa-credit-card"></i> Stage 05</span>
                <div class="bu-card-icon-orb"><i class="fa fa-money"></i></div>
              </div>
              <div class="bu-card-body">
                <h4>Fee Payment &amp; Confirmation</h4>
                <p>Deposit 1st semester / annual tuition fee along with hostel or transportation charges to secure provisional admission allotment.</p>
              </div>
              <div class="bu-card-foot">
                <span class="bu-card-pill-info"><i class="fa fa-lock" style="color:#0D9488;"></i> Secure Gateway</span>
                <div class="bu-card-arrow-btn"><i class="fa fa-arrow-right"></i></div>
              </div>
            </div>

            <!-- STAGE 06 -->
            <div class="bu-roadmap-card" style="--card-accent:#059669; --card-badge-bg:rgba(5,150,105,0.08); --card-badge-border:rgba(5,150,105,0.25); --card-icon-bg:#D1FAE5;">
              <div class="bu-card-watermark">06</div>
              <div class="bu-card-head">
                <span class="bu-card-step-badge" style="background:#ECFDF5; color:#059669; border-color:#10B981;"><i class="fa fa-trophy"></i> Stage 06 &bull; Confirmed</span>
                <div class="bu-card-icon-orb" style="background:#059669; color:#FFFFFF;"><i class="fa fa-graduation-cap"></i></div>
              </div>
              <div class="bu-card-body">
                <h4>Originals Submission &amp; Roll No.</h4>
                <p>Submit original Transfer Certificate, Migration, Character &amp; Affidavits to receive official University Enrollment ID &amp; Roll Number.</p>
              </div>
              <div class="bu-card-foot">
                <span class="bu-card-pill-info" style="color:#059669; font-weight:800;"><i class="fa fa-check-circle" style="color:#059669;"></i> Enrolled Student</span>
                <div class="bu-card-arrow-btn" style="background:#059669; color:#FFFFFF;"><i class="fa fa-check"></i></div>
              </div>
            </div>

          </div>
        </div>

        <!-- ADMISSION RULES / GUIDELINES -->
        <h3 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:17.5px; font-weight:800; color:#0A1B54; margin:28px 0 14px 0; display:flex; align-items:center; gap:8px;">
          <i class="fa fa-book" style="color:#D99B00;"></i> Admission Rules &amp; Guidelines
        </h3>

        <div class="bu-rules-grid">

          <div class="bu-rule-card">
            <h5><i class="fa fa-calendar-check-o"></i> Counseling &amp; Admission Schedule</h5>
            <p>The process of counseling and admissions commences from <strong>1st April</strong> and continues till the last date of admissions on every working day of the University based on merit.</p>
          </div>

          <div class="bu-rule-card">
            <h5><i class="fa fa-laptop"></i> Online &amp; Offline Counseling</h5>
            <p>In special circumstances, the University may conduct Online Counseling with statutory approvals. Students must subsequently submit all original documents for verification.</p>
          </div>

          <div class="bu-rule-card">
            <h5><i class="fa fa-trophy"></i> Basis of Seat Allotment</h5>
            <p>Seat allotment is done first on the basis of marks obtained in entrance examination (if required) and thereafter for all remaining seats on qualifying examination merit.</p>
          </div>

          <div class="bu-rule-card">
            <h5><i class="fa fa-shield"></i> Category Reservation Policy</h5>
            <p>Seat allotment for reserved categories is strictly executed as per the ordinance of Bhabha University and Govt. of Madhya Pradesh / Regulatory Body directives.</p>
          </div>

          <div class="bu-rule-card">
            <h5><i class="fa fa-user-circle-o"></i> Accurate Information Mandate</h5>
            <p>Applicants must provide accurate permanent address, mobile numbers, Email ID, Aadhar number, and blood group in the Application Form and Online ERP Section.</p>
          </div>

          <div class="bu-rule-card">
            <h5><i class="fa fa-institution"></i> Institutional Document Verification</h5>
            <p>Original Transfer Certificate, Character Certificate, Migration Certificate, and Anti-Ragging affidavits must be submitted at the allotted constituent department.</p>
          </div>

        </div>

        <!-- REQUIRED DOCUMENTS CHECKLIST -->
        <h3 style="font-family:'Plus Jakarta Sans',sans-serif; font-size:17.5px; font-weight:800; color:#0A1B54; margin:28px 0 14px 0; display:flex; align-items:center; gap:8px;">
          <i class="fa fa-folder-open" style="color:#D99B00;"></i> Required Documents Checklist
        </h3>

        <div class="bu-docs-panel-grid">

          <!-- 10 Self-Attested Photocopies (2 Sets) -->
          <div class="bu-doc-checklist-panel">
            <h4 class="bu-doc-panel-head">
              <i class="fa fa-files-o"></i> Self-Attested Photocopies (Enclose 2 Sets)
            </h4>
            <ul class="bu-doc-items-list">
              <li><i class="fa fa-check-circle"></i> <span>Valid Admit Card and Merit Score of Entrance Examination (if applicable)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Marksheet of Qualifying Examination (Degree / Diploma)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Marksheet of Higher Secondary Examination (10+2)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Marksheet of 10th / Secondary Examination (Proof of Age)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Domicile Certificate of Madhya Pradesh (if applicable)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Caste Certificate issued by Competent Authority (SC / ST / OBC)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Income Certificate issued by Competent Authority (if applicable)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Percentage / Grade Conversion Formula from Board / University (if Grade based)</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Permanent Address Proof &amp; Aadhar Card</span></li>
              <li><i class="fa fa-check-circle"></i> <span>Five (5) Recent Passport Size Colour Photographs</span></li>
            </ul>
          </div>

          <!-- Original Documents Required -->
          <div class="bu-doc-checklist-panel highlight-panel">
            <h4 class="bu-doc-panel-head">
              <i class="fa fa-certificate"></i> Documents Required in Original Form
            </h4>
            <p style="font-size:12.5px; color:#64748B; margin:0 0 12px 0; line-height:1.5;">
              To be submitted at the Counseling Office for final confirmation:
            </p>
            <ul class="bu-doc-items-list orig-items">
              <li><i class="fa fa-file-text-o"></i> <span><strong>Original Anti-Ragging Affidavits</strong> (Signed by Student &amp; Parent)</span></li>
              <li><i class="fa fa-file-text-o"></i> <span><strong>Original TC / Leaving Certificate</strong> (School / College)</span></li>
              <li><i class="fa fa-file-text-o"></i> <span><strong>Original Character Certificate</strong> (From last institution)</span></li>
              <li><i class="fa fa-file-text-o"></i> <span><strong>Original Migration Certificate</strong> (From Board / University)</span></li>
            </ul>

            <div style="margin-top:16px; padding:10px 12px; background:rgba(217,155,0,0.12); border-left:3px solid #D99B00; border-radius:6px; font-size:11.5px; color:#78350F; line-height:1.5;">
              <i class="fa fa-info-circle"></i> Original verification of all marksheets will also be conducted at the respective teaching department.
            </div>
          </div>

        </div>

        <!-- CANCELLATION & REGULATORY POLICY ALERT -->
        <div class="bu-policy-alert-box">
          <h4><i class="fa fa-exclamation-triangle"></i> Admission Cancellation &amp; Fee Refund Policy</h4>
          
          <div class="bu-policy-highlight-pills">
            <span class="bu-policy-pill"><i class="fa fa-clock-o"></i> 06 Days Advance Notice Required</span>
            <span class="bu-policy-pill"><i class="fa fa-percent"></i> 10% Administrative Deduction Only</span>
          </div>

          <p>
            <strong>Cancellation Timeline &amp; Refund:</strong> In case of cancellation of admission, the candidate must apply formally in writing to the Central Counseling Office of the University <strong>before 06 days from the last date of admission</strong>. Only the tuition fee will be refunded after a <strong>10% statutory administrative deduction</strong>. Other institutional charges, application, and registration fees are non-refundable.
          </p>

          <p class="bu-policy-footer">
            <i class="fa fa-balance-scale" style="color:#D99B00; margin-right:4px;"></i> <strong>Statutory Regulatory Notice:</strong> On recommendation of respective Regulatory Councils / Govt. of Madhya Pradesh / Madhya Pradesh Private University Regulatory Commission (MPPURC), there can be changes in seat intake capacity, courses, admission dates, and minimum eligibility criteria. In case of any dispute, the final decision shall be of the <strong>Vice Chancellor, Bhabha University Bhopal</strong>.
          </p>
        </div>

        <!-- ACTION CTA BAR -->
        <div class="bu-page-cta-bar">
          <a href="<?php echo href('online-admission.php');?>" class="bu-btn-page-gold">
            <i class="fa fa-pencil-square-o"></i> Apply for Admission 2026-27
          </a>
          <a href="<?php echo href('course.php');?>" class="bu-btn-page-navy">
            <i class="fa fa-book"></i> Browse Degree Courses
          </a>
          <a href="<?php echo href('page.php','id=24');?>" class="bu-btn-page-navy" style="background:#059669;">
            <i class="fa fa-phone"></i> Admission Helpline
          </a>
        </div>

      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
