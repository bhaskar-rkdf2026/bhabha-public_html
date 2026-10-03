<?php
/**
 * inc.homeopathy_sections.php
 * Comprehensive Homeopathy Sections for Bhabha Homoeopathic Medical College & Hospital
 * Sourced directly from updated WEBSITE MATTER-1.docx
 * Includes:
 * 1. Four Pillars of Educational Approach (Learn, Practise, Experience, Serve)
 * 2. Detailed BHMS Year-by-Year Curriculum under NCH Regulations
 * 3. Core Faculty & Academic Leadership Showcase (Dr. Tasneem, Dr. Manisha, Dr. Rashmi, Dr. Prachi, Dr. Sushma)
 * 4. Bhabha Homoeopathic Teaching Hospital Showcase (OPD 300+, IPD 25+, Departments, Labs & OT)
 * 5. Admissions 2026-27: Eligibility Criteria & 10-Step Counselling Guide
 * 6. Mandatory Documents Required Checklist
 * 7. Dedicated Contact & Admission Helpline Box
 */
?>

<style>
/* ================================================================
   HOMOEOPATHIC COLLEGE SPECIALIZED STYLES (NAVY & GOLD THEME)
   ================================================================ */
.bu-homeo-wrap {
  margin-top: 10px;
}

/* 1. Four Educational Pillars */
.bu-pillars-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-top: 14px;
}
@media (max-width: 991px) {
  .bu-pillars-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 575px) {
  .bu-pillars-grid {
    grid-template-columns: 1fr;
  }
}
.bu-pillar-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 22px 18px;
  text-align: center;
  box-shadow: 0 4px 14px rgba(6, 29, 124, 0.04);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-pillar-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3.5px;
  background: #CBD5E1;
  transition: background 0.25s ease;
}
.bu-pillar-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(6, 29, 124, 0.1);
  border-color: #CBD5E1;
}
.bu-pillar-card:hover::before {
  background: #FFC107;
}
.bu-pillar-icon {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: #EEF2FF;
  color: #061D7C;
  font-size: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 14px auto;
  transition: all 0.25s ease;
}
.bu-pillar-card:hover .bu-pillar-icon {
  background: #061D7C;
  color: #FFC107;
  transform: scale(1.08);
}
.bu-pillar-title {
  font-size: 17px;
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 8px 0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-pillar-desc {
  font-size: 13px;
  color: #475569;
  line-height: 1.6;
  margin: 0;
}

/* 2. Curriculum Year Tabs */
.bu-curr-tabs-nav {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 20px;
  border-bottom: 2px solid #E2E8F0;
  padding-bottom: 10px;
}
.bu-curr-tab-btn {
  background: #F8FAFC;
  border: 1.5px solid #CBD5E1;
  color: #334155;
  font-size: 13.5px;
  font-weight: 700;
  padding: 9px 18px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-curr-tab-btn:hover {
  background: #EEF2FF;
  border-color: #061D7C;
  color: #061D7C;
}
.bu-curr-tab-btn.active {
  background: #061D7C;
  border-color: #061D7C;
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.25);
}
.bu-curr-tab-pane {
  display: none;
  animation: buFadeIn 0.3s ease;
}
.bu-curr-tab-pane.active {
  display: block;
}
@keyframes buFadeIn {
  from { opacity: 0; transform: translateY(6px); }
  to { opacity: 1; transform: translateY(0); }
}
.bu-curr-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 14px;
}
.bu-curr-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-left: 4px solid #061D7C;
  border-radius: 8px;
  padding: 14px 16px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  transition: all 0.2s ease;
}
.bu-curr-card:hover {
  border-left-color: #FFC107;
  transform: translateX(3px);
  box-shadow: 0 4px 14px rgba(6, 29, 124, 0.08);
}
.bu-curr-subject {
  font-size: 14.5px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 5px 0;
  display: flex;
  align-items: baseline;
  gap: 6px;
}
.bu-curr-subject i {
  color: #D99B00;
  font-size: 12px;
}
.bu-curr-desc {
  font-size: 12.5px;
  color: #475569;
  line-height: 1.55;
  margin: 0;
}
.bu-curr-footer-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #FEF3C7;
  color: #92400E;
  border: 1px solid #FDE68A;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 700;
  margin-top: 14px;
  text-decoration: none !important;
}
.bu-curr-footer-badge:hover {
  background: #FDE68A;
  color: #78350F;
}

/* 3. Core Faculty Cards */
.bu-faculty-profiles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 18px;
  margin-top: 14px;
}
.bu-faculty-prof-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 16px rgba(6, 29, 124, 0.05);
  display: flex;
  flex-direction: column;
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-faculty-prof-card:hover {
  transform: translateY(-3px);
  border-color: #CBD5E1;
  box-shadow: 0 10px 24px rgba(6, 29, 124, 0.12);
}
.bu-faculty-prof-top {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 14px;
  padding-bottom: 12px;
  border-bottom: 1px solid #F1F5F9;
}
.bu-faculty-prof-avatar {
  width: 58px;
  height: 58px;
  border-radius: 50%;
  background: linear-gradient(135deg, #061D7C 0%, #0A2699 100%);
  color: #FFC107;
  font-size: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  border: 2px solid #FFC107;
  box-shadow: 0 4px 10px rgba(6, 29, 124, 0.2);
}
.bu-faculty-prof-info h4 {
  font-size: 16px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 3px 0;
}
.bu-faculty-prof-desig {
  font-size: 12px;
  font-weight: 700;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-faculty-prof-dept {
  font-size: 11.5px;
  color: #64748B;
  margin-top: 2px;
}
.bu-faculty-prof-meta {
  font-size: 12px;
  color: #334155;
  line-height: 1.6;
  margin-bottom: 10px;
}
.bu-faculty-prof-meta strong {
  color: #0A1B54;
}
.bu-faculty-prof-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: auto;
  padding-top: 10px;
  border-top: 1px dashed #E2E8F0;
}
.bu-fac-badge {
  background: #F1F5F9;
  border: 1px solid #E2E8F0;
  color: #334155;
  font-size: 11px;
  font-weight: 600;
  padding: 3px 8px;
  border-radius: 4px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.bu-fac-badge i {
  color: #061D7C;
  font-size: 10px;
}

/* 4. Teaching Hospital Showcase */
.bu-hosp-banner {
  background: linear-gradient(135deg, #040F4A 0%, #061D7C 60%, #0A2699 100%);
  color: #ffffff;
  border-radius: 14px;
  padding: 28px;
  box-shadow: 0 10px 30px rgba(6, 29, 124, 0.2);
  margin-top: 12px;
  position: relative;
  overflow: hidden;
}
.bu-hosp-banner::after {
  content: '\f0f8';
  font-family: 'FontAwesome';
  position: absolute;
  right: -20px;
  bottom: -30px;
  font-size: 180px;
  color: rgba(255, 255, 255, 0.05);
  pointer-events: none;
}
.bu-hosp-stats-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  margin-top: 20px;
}
@media (max-width: 991px) {
  .bu-hosp-stats-row {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 575px) {
  .bu-hosp-stats-row {
    grid-template-columns: 1fr;
  }
}
.bu-hosp-stat-card {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 10px;
  padding: 16px 14px;
  text-align: center;
  backdrop-filter: blur(5px);
}
.bu-hosp-stat-num {
  font-size: 28px;
  font-weight: 800;
  color: #FFC107;
  line-height: 1;
  margin-bottom: 6px;
  font-family: 'Playfair Display', Georgia, serif;
}
.bu-hosp-stat-label {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: #ffffff;
  margin-bottom: 4px;
}
.bu-hosp-stat-sub {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.75);
}

.bu-hosp-facilities-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 16px;
  margin-top: 22px;
}
.bu-hosp-fac-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 14px rgba(6, 29, 124, 0.05);
  transition: all 0.25s ease;
}
.bu-hosp-fac-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 24px rgba(6, 29, 124, 0.1);
  border-color: #CBD5E1;
}
.bu-hosp-fac-img {
  width: 100%;
  height: 155px;
  object-fit: cover;
  display: block;
}
.bu-hosp-fac-body {
  padding: 14px 16px;
}
.bu-hosp-fac-body h5 {
  font-size: 15px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 6px 0;
}
.bu-hosp-fac-body p {
  font-size: 12px;
  color: #64748B;
  line-height: 1.55;
  margin: 0;
}

/* 5. Admission 10 Steps Timeline */
.bu-adm-steps-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 12px;
  margin-top: 14px;
}
.bu-step-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 14px 14px;
  position: relative;
  transition: all 0.2s ease;
}
.bu-step-card:hover {
  border-color: #061D7C;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(6, 29, 124, 0.08);
}
.bu-step-num {
  font-size: 11px;
  font-weight: 800;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 4px;
  display: block;
}
.bu-step-title {
  font-size: 13.5px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 5px 0;
  line-height: 1.35;
}
.bu-step-desc {
  font-size: 12px;
  color: #64748B;
  line-height: 1.5;
  margin: 0;
}

/* 6. Documents Checklist */
.bu-docs-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 10px;
  margin-top: 14px;
}
.bu-doc-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 10px 14px;
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 12.5px;
  color: #334155;
  line-height: 1.45;
}
.bu-doc-item i {
  color: #10B981;
  font-size: 14px;
  margin-top: 2px;
  flex-shrink: 0;
}
.bu-doc-item strong {
  color: #0A1B54;
}

/* 7. Helpdesk Box */
.bu-helpdesk-card {
  background: #FFFDF5;
  border: 1.5px solid #FDE68A;
  border-radius: 12px;
  padding: 18px 22px;
  margin-top: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
}
.bu-helpdesk-left {
  display: flex;
  align-items: center;
  gap: 14px;
}
.bu-helpdesk-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: #FEF3C7;
  color: #B45309;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.bu-helpdesk-left h4 {
  font-size: 15px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 3px 0;
}
.bu-helpdesk-left p {
  font-size: 12.5px;
  color: #475569;
  margin: 0;
}
.bu-helpdesk-right {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}
.bu-helpdesk-btn {
  background: #0A1B54;
  color: #ffffff !important;
  font-size: 12.5px;
  font-weight: 700;
  padding: 9px 18px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.2s ease;
}
.bu-helpdesk-btn:hover {
  background: #FFC107;
  color: #0A1B54 !important;
}
.bu-helpdesk-btn-sec {
  background: #ffffff;
  color: #0A1B54 !important;
  border: 1.5px solid #CBD5E1;
  font-size: 12.5px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.2s ease;
}
.bu-helpdesk-btn-sec:hover {
  background: #F1F5F9;
  border-color: #0A1B54;
}
</style>

<div class="bu-homeo-wrap">

  <!-- ================================================================
       SECTION 1: FOUR PILLARS OF OUR EDUCATIONAL APPROACH
       ================================================================ -->
  <section class="bu-section-block">
    <div class="bu-sec-header">
      <span class="bu-sec-subtitle">Where Education Meets Healing</span>
      <h2 class="bu-sec-title">Four Pillars of Our <em>Educational Approach</em></h2>
      <div class="bu-sec-divider"></div>
      <p style="font-size:14px; color:#475569; max-width:850px; margin:8px 0 0 0; line-height:1.6;">
        At Bhabha Homoeopathic Medical College &amp; Hospital, medical education is more than acquiring theoretical knowledge. It is about developing clinical acumen, diagnostic precision, and the empathy required to heal humanity.
      </p>
    </div>

    <div class="bu-pillars-grid">
      <div class="bu-pillar-card">
        <div class="bu-pillar-icon"><i class="fa fa-graduation-cap"></i></div>
        <h4 class="bu-pillar-title">Learn</h4>
        <p class="bu-pillar-desc">Build a strong scientific foundation through structured classroom teaching of human anatomy, physiology, pathology, and classical Homoeopathy.</p>
      </div>

      <div class="bu-pillar-card">
        <div class="bu-pillar-icon"><i class="fa fa-flask"></i></div>
        <h4 class="bu-pillar-title">Practise</h4>
        <p class="bu-pillar-desc">Reinforce concepts through hands-on laboratory experiments, cadaveric dissection, pharmacy potentisation, and computerized repertorisation.</p>
      </div>

      <div class="bu-pillar-card">
        <div class="bu-pillar-icon"><i class="fa fa-hospital-o"></i></div>
        <h4 class="bu-pillar-title">Experience</h4>
        <p class="bu-pillar-desc">Connect academic knowledge with real patients through bedside clinical training in our attached 300+ daily OPD and inpatient hospital wings.</p>
      </div>

      <div class="bu-pillar-card">
        <div class="bu-pillar-icon"><i class="fa fa-heartbeat"></i></div>
        <h4 class="bu-pillar-title">Serve</h4>
        <p class="bu-pillar-desc">Deliver compassionate, ethical, and holistic patient care through community outreach camps, rural dispensaries, and public healthcare programmes.</p>
      </div>
    </div>
  </section>

  <!-- ================================================================
       SECTION 2: BHMS YEAR-BY-YEAR CURRICULUM (NCH REGULATIONS)
       ================================================================ -->
  <section class="bu-section-block">
    <div class="bu-sec-header" style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:10px;">
      <div>
        <span class="bu-sec-subtitle">Comprehensive 5½ Years Medical Syllabus</span>
        <h2 class="bu-sec-title">BHMS Curriculum &amp; <em>Professional Syllabus</em></h2>
        <div class="bu-sec-divider"></div>
      </div>
      <a href="https://nch.org.in" target="_blank" rel="noopener" class="bu-curr-footer-badge" style="margin-top:0;">
        <i class="fa fa-external-link"></i> Regulated by National Commission for Homoeopathy (NCH)
      </a>
    </div>

    <!-- Year Tabs Navigation -->
    <div class="bu-curr-tabs-nav" id="buCurrTabsNav">
      <button type="button" class="bu-curr-tab-btn active" onclick="switchBhmsTab(event, 'buYear1')">
        <i class="fa fa-book"></i> First Professional Year
      </button>
      <button type="button" class="bu-curr-tab-btn" onclick="switchBhmsTab(event, 'buYear2')">
        <i class="fa fa-stethoscope"></i> Second Professional Year
      </button>
      <button type="button" class="bu-curr-tab-btn" onclick="switchBhmsTab(event, 'buYear3')">
        <i class="fa fa-hospital-o"></i> Third Professional Year
      </button>
      <button type="button" class="bu-curr-tab-btn" onclick="switchBhmsTab(event, 'buYear4')">
        <i class="fa fa-user-md"></i> Fourth Professional Year
      </button>
      <button type="button" class="bu-curr-tab-btn" onclick="switchBhmsTab(event, 'buInternship')">
        <i class="fa fa-refresh"></i> 1-Year Rotatory Internship
      </button>
    </div>

    <!-- Tab 1: First Year -->
    <div id="buYear1" class="bu-curr-tab-pane active">
      <div class="bu-curr-grid">
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Anatomy, Histology &amp; Embryology</h5>
          <p class="bu-curr-desc">In-depth study of human body gross structure, tissues, organs, developmental embryology, osteology, and full cadaveric dissection.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Human Physiology &amp; Bio-Chemistry</h5>
          <p class="bu-curr-desc">Study of cellular physiology, cardiovascular, nervous, endocrine mechanisms, haematology labs, and biochemical molecular processes.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Homoeopathic Pharmacy</h5>
          <p class="bu-curr-desc">Principles of drug collection, identification, preparation of mother tinctures, triturations, centesimal/decimal potentisation, and posology.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Homoeopathic Materia Medica</h5>
          <p class="bu-curr-desc">Introduction to drug provings, therapeutic remedy profiles, mental/physical generals, and symptom pathogenesis of foundational remedies.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Organon of Medicine &amp; Psychology</h5>
          <p class="bu-curr-desc">Hahnemannian principles, dynamic concept of health, vital force, nature of cure, and fundamentals of human behavioural psychology.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Homoeopathic Repertory &amp; Case Taking</h5>
          <p class="bu-curr-desc">Systematic methodology of recording patient history, observation, symptom classification, and introductory repertory indexing.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Yoga for Health Promotion</h5>
          <p class="bu-curr-desc">Traditional Yogic asanas, pranayama, and meditation integrated as supportive lifestyle medicine for holistic health preservation.</p>
        </div>
      </div>
      <div style="margin-top:12px;">
        <a href="https://nch.org.in/first-bhms" target="_blank" rel="noopener" class="bu-curr-footer-badge">
          <i class="fa fa-external-link"></i> View Official NCH First-BHMS Regulations &amp; Scheme
        </a>
      </div>
    </div>

    <!-- Tab 2: Second Year -->
    <div id="buYear2" class="bu-curr-tab-pane">
      <div class="bu-curr-grid">
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Pathology &amp; Microbiology</h5>
          <p class="bu-curr-desc">Pathological disease processes, systemic pathology, bacteriology, virology, parasitology, and correlating clinical pathology with miasmatic diathesis.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Forensic Medicine &amp; Toxicology</h5>
          <p class="bu-curr-desc">Medical jurisprudence, legal responsibilities, court procedures, post-mortem signs, poison identification, and management of acute poisonings.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Homoeopathic Materia Medica (Expanded)</h5>
          <p class="bu-curr-desc">Expanded study of polychrest and semi-polychrest medicines, drug relationships, complementary remedies, and comparative therapeutics.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Organon of Medicine &amp; Philosophy</h5>
          <p class="bu-curr-desc">In-depth study of Aphorisms, chronic disease miasms (Psora, Sycosis, Syphilis), susceptibility, second prescription, and posological rules.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Surgery &amp; Homoeo-Therapeutics</h5>
          <p class="bu-curr-desc">Principles of general surgery, aseptic techniques, wounds, ulcers, surgical emergencies, and pre/post-operative homoeopathic management.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Practice of Medicine (Foundational)</h5>
          <p class="bu-curr-desc">Clinical examination techniques, bedside diagnostics, vital signs monitoring, and fundamentals of medical case documentation.</p>
        </div>
      </div>
      <div style="margin-top:12px;">
        <a href="https://nch.org.in/second-bhms" target="_blank" rel="noopener" class="bu-curr-footer-badge">
          <i class="fa fa-external-link"></i> View Official NCH Second-BHMS Regulations &amp; Scheme
        </a>
      </div>
    </div>

    <!-- Tab 3: Third Year -->
    <div id="buYear3" class="bu-curr-tab-pane">
      <div class="bu-curr-grid">
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Surgery &amp; Homoeo-Therapeutics (Advanced)</h5>
          <p class="bu-curr-desc">Clinical surgery covering Orthopaedics, Ophthalmology, ENT, Dentistry, Minor OT procedures, and homoeopathic surgical management.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Gynaecology &amp; Obstetrics</h5>
          <p class="bu-curr-desc">Maternal healthcare, normal and abnormal pregnancy, labour management, neonatal care, and gentle homoeopathic therapeutics for women's disorders.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Homoeopathic Materia Medica</h5>
          <p class="bu-curr-desc">Advanced comparative remedy differentiation, rare homoeopathic medicines, nosodes, sarcodes, and acute/chronic clinical correlations.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Organon of Medicine (Advanced Doctrine)</h5>
          <p class="bu-curr-desc">Advanced evaluation of chronic diseases, Kent's 12 observations, Stuart Close and Roberts philosophy, and holistic cure analysis.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Repertory (Advanced Repertorisation)</h5>
          <p class="bu-curr-desc">Mastery of Kent, Boenninghausen, Boger repertories, modern computerised software repertorisation, rubric hunting, and case synthesis.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Practice of Medicine (Systemic Diseases)</h5>
          <p class="bu-curr-desc">Clinical diagnostics, pathology, and homoeopathic treatment of cardiovascular, respiratory, gastrointestinal, and renal diseases.</p>
        </div>
      </div>
    </div>

    <!-- Tab 4: Fourth Year -->
    <div id="buYear4" class="bu-curr-tab-pane">
      <div class="bu-curr-grid">
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Practice of Medicine &amp; Therapeutics</h5>
          <p class="bu-curr-desc">Comprehensive clinical medicine, neurological, endocrine, dermatological, geriatric, and paediatric diseases with individualized homoeopathic care.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Homoeopathic Materia Medica (Mastery)</h5>
          <p class="bu-curr-desc">Complete mastery of drug pictures, clinical bedside application, constitutional remedies, and management of complex pathologies.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Organon of Medicine &amp; Philosophy</h5>
          <p class="bu-curr-desc">Advanced clinical case management, posology in incurable diseases, palliative care, and ethical practice of medicine.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Case Taking &amp; Repertory in Practice</h5>
          <p class="bu-curr-desc">Practical application of repertory in complex chronic cases, bedside clinical repertorisation, and therapeutic decision making.</p>
        </div>
        <div class="bu-curr-card">
          <h5 class="bu-curr-subject"><i class="fa fa-check-circle"></i> Community Medicine (Preventive &amp; Social)</h5>
          <p class="bu-curr-desc">Public health, epidemiology, national health programmes, environmental sanitation, occupational diseases, and community nutrition.</p>
        </div>
      </div>
      <div style="margin-top:12px;">
        <a href="https://nch.org.in/fourth-bhms" target="_blank" rel="noopener" class="bu-curr-footer-badge">
          <i class="fa fa-external-link"></i> View Official NCH Fourth-BHMS Regulations &amp; Scheme
        </a>
      </div>
    </div>

    <!-- Tab 5: Internship -->
    <div id="buInternship" class="bu-curr-tab-pane">
      <div class="bu-curr-card" style="border-left-color: #10B981; padding: 20px;">
        <h4 style="color:#0A1B54; font-size:17px; font-weight:800; margin:0 0 10px 0;"><i class="fa fa-refresh text-success"></i> 1-Year Compulsory Rotatory Clinical Internship</h4>
        <p style="font-size:13.5px; line-height:1.75; color:#374151; margin-bottom:14px;">
          The BHMS programme culminates in a mandatory <strong>one-year rotatory clinical internship</strong>. Interns rotate across all major hospital departments including Outpatient (OPD), Inpatient (IPD), Minor OT, Labour Room, Clinical Pathology, Pharmacy, and Peripheral Rural Health Camps.
        </p>
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap:10px;">
          <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:10px 12px; border-radius:6px; font-size:12.5px; color:#334155;">
            <strong>🏥 Clinical Bedside Duties:</strong> Supervised patient examination, case taking, and progress charting.
          </div>
          <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:10px 12px; border-radius:6px; font-size:12.5px; color:#334155;">
            <strong>🌿 OPD Consultations:</strong> Practical repertorisation, potency selection, and medicine dispensing.
          </div>
          <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:10px 12px; border-radius:6px; font-size:12.5px; color:#334155;">
            <strong>🚐 Rural Health Camps:</strong> Active community health checkups and rural dispensaries.
          </div>
          <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:10px 12px; border-radius:6px; font-size:12.5px; color:#334155;">
            <strong>📜 Licensing &amp; Registration:</strong> Prepares candidates for state/central medical council registration.
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================================
       SECTION 3: CORE FACULTY & DISTINGUISHED PROFESSORS
       ================================================================ -->
  <section class="bu-section-block">
    <div class="bu-sec-header">
      <span class="bu-sec-subtitle">Eminent Medical Educators &amp; Clinicians</span>
      <h2 class="bu-sec-title">Core Faculty &amp; <em>Academic Leadership</em></h2>
      <div class="bu-sec-divider"></div>
      <p style="font-size:14px; color:#475569; max-width:850px; margin:8px 0 0 0; line-height:1.6;">
        Our students learn under the mentorship of seasoned academicians and clinical practitioners with decades of combined teaching, hospital practice, and medical research experience.
      </p>
    </div>

    <div class="bu-faculty-profiles-grid">
      <!-- 1. Dr. Tasneem Amir Hussain -->
      <div class="bu-faculty-prof-card">
        <div class="bu-faculty-prof-top">
          <div class="bu-faculty-prof-avatar"><i class="fa fa-user-md"></i></div>
          <div class="bu-faculty-prof-info">
            <h4>Dr. Tasneem Amir Hussain</h4>
            <div class="bu-faculty-prof-desig">Associate Professor</div>
            <div class="bu-faculty-prof-dept">Department of Human Anatomy</div>
          </div>
        </div>
        <div class="bu-faculty-prof-meta">
          <div><strong>🎓 Qualification:</strong> BHMS, MD (Hom), BPT</div>
          <div><strong>⏳ Experience:</strong> 4.10 Years Teaching + 24 Years Clinical Practice</div>
          <div style="margin-top:6px;"><strong>🏆 Highlights &amp; Research:</strong> Actively participated in Covid Research Programme at Govt. Homoeopathic Medical College &amp; Hospital Bhopal (2020). Ex Co-editor of <em>NewLife Era</em> Homoeopathic Journal. Committed anatomy teacher running educational video lectures.</div>
        </div>
        <div class="bu-faculty-prof-badges">
          <span class="bu-fac-badge"><i class="fa fa-stethoscope"></i> Anatomy Specialist</span>
          <span class="bu-fac-badge"><i class="fa fa-certificate"></i> Covid Research</span>
          <span class="bu-fac-badge"><i class="fa fa-youtube-play text-danger"></i> Anatomy Educator</span>
        </div>
      </div>

      <!-- 2. Dr. Manisha Shrivastava -->
      <div class="bu-faculty-prof-card">
        <div class="bu-faculty-prof-top">
          <div class="bu-faculty-prof-avatar"><i class="fa fa-user-md"></i></div>
          <div class="bu-faculty-prof-info">
            <h4>Dr. Manisha Shrivastava</h4>
            <div class="bu-faculty-prof-desig">Professor</div>
            <div class="bu-faculty-prof-dept">Department of Human Physiology &amp; Biochemistry</div>
          </div>
        </div>
        <div class="bu-faculty-prof-meta">
          <div><strong>🎓 Qualification:</strong> BHMS, MD (Hom)</div>
          <div><strong>⏳ Experience:</strong> 18 Years Academic Teaching + 20 Years Clinical Practice</div>
          <div style="margin-top:6px;"><strong>🏆 Highlights:</strong> Former Principal at Sophia Homoeopathic Medical College &amp; Hospital, Gwalior. Former Editor-in-Chief of <em>Homoeopathic Pulse</em> and Co-editor of <em>Homoeo-vision</em>.</div>
        </div>
        <div class="bu-faculty-prof-badges">
          <span class="bu-fac-badge"><i class="fa fa-flask"></i> Physiology &amp; Biochemistry</span>
          <span class="bu-fac-badge"><i class="fa fa-star text-warning"></i> Ex Principal</span>
          <span class="bu-fac-badge"><i class="fa fa-book"></i> Journal Editor</span>
        </div>
      </div>

      <!-- 3. Dr. Rashmi Jirapure -->
      <div class="bu-faculty-prof-card">
        <div class="bu-faculty-prof-top">
          <div class="bu-faculty-prof-avatar"><i class="fa fa-user-md"></i></div>
          <div class="bu-faculty-prof-info">
            <h4>Dr. Rashmi Jirapure</h4>
            <div class="bu-faculty-prof-desig">Professor</div>
            <div class="bu-faculty-prof-dept">Department of Homoeopathic Materia Medica</div>
          </div>
        </div>
        <div class="bu-faculty-prof-meta">
          <div><strong>🎓 Qualification:</strong> BHMS, MD (Hom)</div>
          <div><strong>⏳ Experience:</strong> 15 Years Academic Experience + 20 Years Clinical Practice</div>
          <div style="margin-top:6px;"><strong>🎯 Focus:</strong> In-depth symptom pathogenesis, drug pictures, individualisation, and comparative materia medica for clinical decision-making.</div>
        </div>
        <div class="bu-faculty-prof-badges">
          <span class="bu-fac-badge"><i class="fa fa-medkit"></i> Materia Medica Expert</span>
          <span class="bu-fac-badge"><i class="fa fa-clock-o"></i> 20+ Yrs Clinical</span>
        </div>
      </div>

      <!-- 4. Dr. Prachi Vyas -->
      <div class="bu-faculty-prof-card">
        <div class="bu-faculty-prof-top">
          <div class="bu-faculty-prof-avatar"><i class="fa fa-user-md"></i></div>
          <div class="bu-faculty-prof-info">
            <h4>Dr. Prachi Vyas</h4>
            <div class="bu-faculty-prof-desig">Professor</div>
            <div class="bu-faculty-prof-dept">Department of Organon of Medicine</div>
          </div>
        </div>
        <div class="bu-faculty-prof-meta">
          <div><strong>🎓 Qualification:</strong> BHMS, MD (Hom)</div>
          <div><strong>⏳ Experience:</strong> 20 Years Academic Experience + 25 Years Clinical Practice</div>
          <div style="margin-top:6px;"><strong>📝 Research &amp; Publications:</strong> Author of published clinical write-ups in <em>Free Press Journal</em>, Indore. Expert in Hahnemannian philosophy and chronic disease management.</div>
        </div>
        <div class="bu-faculty-prof-badges">
          <span class="bu-fac-badge"><i class="fa fa-balance-scale"></i> Organon &amp; Philosophy</span>
          <span class="bu-fac-badge"><i class="fa fa-newspaper-o"></i> Published Author</span>
          <span class="bu-fac-badge"><i class="fa fa-clock-o"></i> 25 Yrs Clinical</span>
        </div>
      </div>

      <!-- 5. Dr. Sushma Singh Patel -->
      <div class="bu-faculty-prof-card">
        <div class="bu-faculty-prof-top">
          <div class="bu-faculty-prof-avatar"><i class="fa fa-user-md"></i></div>
          <div class="bu-faculty-prof-info">
            <h4>Dr. Sushma Singh Patel</h4>
            <div class="bu-faculty-prof-desig">Professor</div>
            <div class="bu-faculty-prof-dept">Department of Repertory</div>
          </div>
        </div>
        <div class="bu-faculty-prof-meta">
          <div><strong>🎓 Qualification:</strong> BHMS, MD (Hom), Ph.D.</div>
          <div><strong>⏳ Experience:</strong> 9 Years Academic Experience + 9 Years Clinical Practice</div>
          <div style="margin-top:6px;"><strong>🔬 Research Publication:</strong> <em>Clinical Utility of Dr. J.T. Kent Repertory in Management of Hypothyroidism</em>. Specialises in computerized repertorisation and case synthesis.</div>
        </div>
        <div class="bu-faculty-prof-badges">
          <span class="bu-fac-badge"><i class="fa fa-search"></i> Repertory &amp; Case Taking</span>
          <span class="bu-fac-badge"><i class="fa fa-graduation-cap"></i> Ph.D. Scholar</span>
          <span class="bu-fac-badge"><i class="fa fa-flask"></i> Clinical Research</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================================
       SECTION 4: BHABHA HOMOEOPATHIC TEACHING HOSPITAL
       ================================================================ -->
  <section class="bu-section-block">
    <div class="bu-sec-header">
      <span class="bu-sec-subtitle">Patient Care, Clinical Education &amp; Training</span>
      <h2 class="bu-sec-title">Bhabha Homoeopathic <em>Teaching Hospital</em></h2>
      <div class="bu-sec-divider"></div>
      <p style="font-size:14px; color:#475569; max-width:850px; margin:8px 0 0 0; line-height:1.6;">
        Bhabha Homoeopathic Medical College &amp; Hospital is supported by an attached, fully-functioning teaching hospital providing comprehensive patient care while serving as the vital center for bedside clinical education and live practical training.
      </p>
    </div>

    <!-- Hospital Fast Stats -->
    <div class="bu-hosp-banner">
      <div style="max-width:800px;">
        <span style="font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:1px; color:#FFC107; background:rgba(255,193,7,0.15); padding:4px 10px; border-radius:4px; display:inline-block; margin-bottom:8px;">
          <i class="fa fa-hospital-o"></i> Live Clinical Education Center
        </span>
        <h3 style="font-size: clamp(20px, 2.5vw, 26px); font-weight:800; margin:0 0 10px 0; color:#ffffff;">
          Integrated Outpatient &amp; Inpatient Healthcare Services
        </h3>
        <p style="font-size:13.5px; color:rgba(255,255,255,0.85); line-height:1.65; margin:0;">
          Students gain extensive hands-on experience under the direct supervision of experienced professors through patient case taking, general physical examination, symptom repertorisation, follow-ups, and compassionate care.
        </p>
      </div>

      <div class="bu-hosp-stats-row">
        <div class="bu-hosp-stat-card">
          <div class="bu-hosp-stat-num">300+</div>
          <div class="bu-hosp-stat-label">OPD Patients / Day</div>
          <div class="bu-hosp-stat-sub">Rich variety of clinical disease cases</div>
        </div>

        <div class="bu-hosp-stat-card">
          <div class="bu-hosp-stat-num">25+</div>
          <div class="bu-hosp-stat-label">IPD Bed Capacity</div>
          <div class="bu-hosp-stat-sub">Inpatient observation &amp; bedside care</div>
        </div>

        <div class="bu-hosp-stat-card">
          <div class="bu-hosp-stat-num">04</div>
          <div class="bu-hosp-stat-label">Clinical Departments</div>
          <div class="bu-hosp-stat-sub">Medicine, Surgery, Gynae, Paediatrics</div>
        </div>

        <div class="bu-hosp-stat-card">
          <div class="bu-hosp-stat-num" style="font-size:22px; padding-top:4px;">9:30 - 4:00</div>
          <div class="bu-hosp-stat-label">Daily OPD Timings</div>
          <div class="bu-hosp-stat-sub">Consultations, follow-ups &amp; pharmacy</div>
        </div>
      </div>
    </div>

    <!-- Hospital Infrastructure Cards with Real Photos -->
    <div class="bu-hosp-facilities-grid">
      <div class="bu-hosp-fac-card">
        <img src="<?php echo URL_ROOT;?>upload/media/2a7fdce1f7f3ac0431def1d879cf9e82.jpg" alt="Homoeopathic Pharmacy Lab" class="bu-hosp-fac-img" loading="lazy" onerror="this.src='<?php echo URL_ROOT;?>new-media/department/Homeopathy-150kb.webp';">
        <div class="bu-hosp-fac-body">
          <h5><i class="fa fa-flask text-warning mr-1"></i> Homoeopathic Pharmacy</h5>
          <p>Well-stocked dispensary with high-quality mother tinctures, potentised dilutions, bio-chemic remedies, and standardized dispensing protocols.</p>
        </div>
      </div>

      <div class="bu-hosp-fac-card">
        <img src="<?php echo URL_ROOT;?>upload/media/452c9c12f9ef95bf28173c751c2ff9a4.jpg" alt="X-Ray & Radiology Room" class="bu-hosp-fac-img" loading="lazy" onerror="this.src='<?php echo URL_ROOT;?>new-media/department/Homeopathy-150kb.webp';">
        <div class="bu-hosp-fac-body">
          <h5><i class="fa fa-heartbeat text-danger mr-1"></i> Diagnostic Labs &amp; X-Ray</h5>
          <p>In-house computerized diagnostic radiology unit, clinical pathology, routine haematology, biochemistry, and microbiology slide investigation.</p>
        </div>
      </div>

      <div class="bu-hosp-fac-card">
        <img src="<?php echo URL_ROOT;?>upload/media/338c81f59c6adfcd4d0182ac12339e25.jpg" alt="Operation Theatre Suite" class="bu-hosp-fac-img" loading="lazy" onerror="this.src='<?php echo URL_ROOT;?>new-media/department/Homeopathy-150kb.webp';">
        <div class="bu-hosp-fac-body">
          <h5><i class="fa fa-medkit text-primary mr-1"></i> Minor OT &amp; Surgical Care</h5>
          <p>Equipped minor operation theatre for aseptic procedures, surgical wound dressings, emergency trauma triage, and homoeo-therapeutics.</p>
        </div>
      </div>

      <div class="bu-hosp-fac-card">
        <img src="<?php echo URL_ROOT;?>upload/media/66cb0a95699ed62f2e2e11ede670343c.jpg" alt="Labour Room & Antenatal Unit" class="bu-hosp-fac-img" loading="lazy" onerror="this.src='<?php echo URL_ROOT;?>new-media/department/Homeopathy-150kb.webp';">
        <div class="bu-hosp-fac-body">
          <h5><i class="fa fa-female text-info mr-1"></i> Labour Room &amp; Maternity Unit</h5>
          <p>Comprehensive antenatal check-ups, normal delivery observation, maternal healthcare, postnatal monitoring, and infant care.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================================
       SECTION 5: ADMISSIONS 2026-27 & 10-STEP COUNSELLING GUIDE
       ================================================================ -->
  <section class="bu-section-block">
    <div class="bu-sec-header">
      <span class="bu-sec-subtitle">NCH &amp; NEET-UG Admission Walkthrough</span>
      <h2 class="bu-sec-title">BHMS Admissions 2026-27 &amp; <em>10-Step Guide</em></h2>
      <div class="bu-sec-divider"></div>
      <p style="font-size:14px; color:#475569; max-width:850px; margin:8px 0 0 0; line-height:1.6;">
        Admission to the Bachelor of Homoeopathic Medicine and Surgery (BHMS) programme is conducted strictly through prescribed statutory counselling in accordance with National Commission for Homoeopathy (NCH) regulations.
      </p>
    </div>

    <!-- Eligibility Criteria Box -->
    <div style="background:#F8FAFC; border:1px solid #CBD5E1; border-left:4.5px solid #061D7C; border-radius:10px; padding:18px 20px; margin-bottom:18px;">
      <h4 style="font-size:16px; font-weight:800; color:#0A1B54; margin:0 0 10px 0;"><i class="fa fa-check-square-o text-warning mr-1"></i> BHMS Prescribed Eligibility Criteria</h4>
      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:12px; font-size:13px; color:#334155; line-height:1.65;">
        <div>
          <strong>1. Academic Qualification:</strong> Candidate must have passed 10+2 or equivalent with <strong>Physics, Chemistry, and Biology (PCB)</strong> and English from a recognised board.
        </div>
        <div>
          <strong>2. Minimum PCB Marks:</strong><br>
          &bull; General / EWS: Minimum <strong>50%</strong> in PCB<br>
          &bull; SC / ST / OBC: Minimum <strong>40%</strong> in PCB<br>
          &bull; PwBD (General): <strong>45%</strong> | PwBD (Reserved): <strong>40%</strong>
        </div>
        <div>
          <strong>3. Age Requirement:</strong> Candidate must have attained a minimum of <strong>17 years of age</strong> on or before 31st December of the admission year.
        </div>
        <div>
          <strong>4. Mandatory NEET-UG:</strong> Must qualify NEET-UG conducted by NTA (50th percentile for General/EWS; 40th percentile for SC/ST/OBC; 45th percentile for PwBD).
        </div>
      </div>
    </div>

    <!-- 10 Step Cards -->
    <div class="bu-adm-steps-grid">
      <div class="bu-step-card">
        <span class="bu-step-num">Step 01</span>
        <h5 class="bu-step-title">Appear in NEET-UG</h5>
        <p class="bu-step-desc">Candidate must register, appear, and qualify in the NEET-UG examination conducted by the National Testing Agency (NTA).</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 02</span>
        <h5 class="bu-step-title">Register for Counselling</h5>
        <p class="bu-step-desc">Register on AACCC portal (15% All India Quota) or State AYUSH Counselling Portal (85% State Quota).</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 03</span>
        <h5 class="bu-step-title">Eligibility Verification</h5>
        <p class="bu-step-desc">Verification of NEET percentile, academic eligibility, and category status by the counselling authority.</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 04</span>
        <h5 class="bu-step-title">Choice Filling &amp; Locking</h5>
        <p class="bu-step-desc">Select <strong>Bhabha Homoeopathic Medical College &amp; Hospital, Bhopal</strong> as your preferred choice and lock choices.</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 05</span>
        <h5 class="bu-step-title">Seat Allotment Result</h5>
        <p class="bu-step-desc">Check counselling portal for merit-based seat allotment results as per NCH regulations.</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 06</span>
        <h5 class="bu-step-title">Download Allotment Letter</h5>
        <p class="bu-step-desc">Download the official provisional seat allotment document from the counselling portal.</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 07</span>
        <h5 class="bu-step-title">Report to College</h5>
        <p class="bu-step-desc">Report in person at BHMCH campus, Jatkhedi, Bhopal within the scheduled reporting dates.</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 08</span>
        <h5 class="bu-step-title">Document Verification</h5>
        <p class="bu-step-desc">Present original certificates along with 2 sets of self-attested photocopies for verification.</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 09</span>
        <h5 class="bu-step-title">Admission Formalities</h5>
        <p class="bu-step-desc">Complete institutional enrollment formalities, medical fitness review, and submit applicable tuition fees.</p>
      </div>

      <div class="bu-step-card">
        <span class="bu-step-num">Step 10</span>
        <h5 class="bu-step-title">Begin BHMS Journey</h5>
        <p class="bu-step-desc">Attend student orientation, receive your white coat, and commence your academic medical journey at Bhabha.</p>
      </div>
    </div>
  </section>

  <!-- ================================================================
       SECTION 6: MANDATORY DOCUMENTS REQUIRED CHECKLIST
       ================================================================ -->
  <section class="bu-section-block">
    <div class="bu-sec-header">
      <span class="bu-sec-subtitle">Original Documents &amp; 2 Sets of Self-Attested Photocopies</span>
      <h2 class="bu-sec-title">Mandatory Documents <em>Checklist for Admission</em></h2>
      <div class="bu-sec-divider"></div>
      <p style="font-size:14px; color:#475569; max-width:850px; margin:8px 0 0 0; line-height:1.6;">
        Candidates must carry original copies along with two sets of self-attested photocopies to finalize their admission into the BHMS course:
      </p>
    </div>

    <div class="bu-docs-grid">
      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Provisional Allotment Letter:</strong> Generated from AACCC or State AYUSH counseling portal.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>NEET-UG Admit Card:</strong> Issued by National Testing Agency (NTA).</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>NEET-UG Scorecard / Rank Letter:</strong> Showing qualified marks &amp; All India Rank.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Class 10 Marksheet &amp; Passing Certificate:</strong> Official proof of Date of Birth (DOB).</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Class 12 Marksheet &amp; Certificate:</strong> Verifying aggregate marks in Physics, Chemistry, Biology &amp; English.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Transfer Certificate (TC):</strong> School leaving certificate from the last attended institution.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Migration Certificate:</strong> Required if shifting from a different school board or university.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Character Certificate:</strong> Issued by previous school/college principal.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>8 to 12 Passport-Size Photographs:</strong> Recent photos matching the NEET application form.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Valid Photo ID Proof:</strong> Government ID (Aadhaar Card, PAN Card, Passport, or Driving License).</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Medical Fitness Certificate:</strong> Issued by a Registered Medical Practitioner in the prescribed format.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Category / Caste Certificate:</strong> Compulsory for SC, ST, or OBC-NCL candidates in standard Govt format.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>EWS / PwD Certificate:</strong> Income &amp; Asset certificate for current FY or PwD board disability certificate.</div>
      </div>

      <div class="bu-doc-item">
        <i class="fa fa-check-circle"></i>
        <div><strong>Domicile Certificate &amp; Gap Affidavit:</strong> Domicile for State Quota and notarized affidavit for gap year (if any).</div>
      </div>
    </div>
  </section>

  <!-- ================================================================
       SECTION 7: HELPDESK & ADMISSION ENQUIRY
       ================================================================ -->
  <div class="bu-helpdesk-card">
    <div class="bu-helpdesk-left">
      <div class="bu-helpdesk-icon"><i class="fa fa-phone"></i></div>
      <div>
        <h4>Need Guidance on BHMS Admissions &amp; Campus Visit?</h4>
        <p>Contact the Bhabha Homoeopathic Medical College &amp; Hospital Admission Office: <strong>0755-4246498</strong> / <strong>7974846908</strong>, <strong>9039921140</strong></p>
      </div>
    </div>
    <div class="bu-helpdesk-right">
      <a href="tel:7974846908" class="bu-helpdesk-btn"><i class="fa fa-phone"></i> Call Admission Office</a>
      <a href="<?php echo href('enquiry.php');?>" class="bu-helpdesk-btn-sec"><i class="fa fa-envelope-o"></i> Submit Enquiry</a>
    </div>
  </div>

</div>

<!-- Interactive Tab Switcher Script -->
<script>
function switchBhmsTab(e, tabId) {
  var nav = document.getElementById('buCurrTabsNav');
  var btns = nav.getElementsByClassName('bu-curr-tab-btn');
  for (var i = 0; i < btns.length; i++) {
    btns[i].classList.remove('active');
  }
  if (e && e.currentTarget) {
    e.currentTarget.classList.add('active');
  }

  var panes = document.getElementsByClassName('bu-curr-tab-pane');
  for (var j = 0; j < panes.length; j++) {
    panes[j].classList.remove('active');
  }
  var target = document.getElementById(tabId);
  if (target) {
    target.classList.add('active');
  }
}
</script>
