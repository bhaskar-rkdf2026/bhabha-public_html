<?php
// Bhabha University – Redesigned Chancellor's Message Section
?>
<section class="bu-chancellor-section">
  <div class="bu-chancellor-container">
    
    <!-- LEFT: Image & Gold Quote Card -->
    <div class="bu-chancellor-img-col">
      <div class="bu-chancellor-img-wrapper">
        <img src="<?php echo URL_IMG;?>vcpic.jpg" alt="Dr. Sadhna Kapoor, Chancellor Bhabha University" class="bu-chancellor-img" onerror="this.src='https://www.bhabhauniversity.edu.in/images/vcpic.jpg'">
        <div class="bu-chancellor-quote-card">
          <p class="bu-quote-text">“We bridge academic brilliance with industrial pragmatism.”</p>
          <span class="bu-quote-author">DR. SADHNA KAPOOR · CHANCELLOR</span>
        </div>
      </div>
    </div>
    
    <!-- RIGHT: Text content & Recognitions -->
    <div class="bu-chancellor-text-col">
      <span class="bu-chancellor-label">CHANCELLOR'S MESSAGE</span>
      <h2 class="bu-chancellor-heading">
        A legacy of <em>excellence</em>.<br>
        A vision for tomorrow.
      </h2>
      <div class="bu-chancellor-desc">
        <p><strong>Dr. Sadhna Kapoor</strong> is the Chancellor of BHABHA University. A visionary and a selfless leader with exceptional entrepreneurial, interpersonal, social and administrative skills; Dr. Sadhna Kapoor is passionate about technology and innovation, community development, social service, and interdisciplinary teaching and research.</p>
        <p>She has been awarded the title of “Honorary Professor” by the Academic Union Oxford, UK, reflecting her global dedication to educational innovation and excellence.</p>
      </div>
      
      <div class="bu-chancellor-divider"></div>
      
      <!-- Recognitions Row -->
      <div class="bu-chancellor-recognitions">
        <div class="bu-recog-item">
          <span class="bu-recog-title">UGC</span>
          <span class="bu-recog-label">RECOGNISED</span>
        </div>
        <div class="bu-recog-item">
          <span class="bu-recog-title">NAAC</span>
          <span class="bu-recog-label">A+ GRADE</span>
        </div>
        <div class="bu-recog-item">
          <span class="bu-recog-title">AICTE</span>
          <span class="bu-recog-label">APPROVED</span>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ===== CHANCELLOR STYLES ===== -->
<style>
.bu-chancellor-section {
  background-color: #FAF9F6 !important; /* light cream bg */
  padding: 80px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
}
.bu-chancellor-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
  display: flex !important;
  align-items: center !important;
  gap: 60px !important;
}
.bu-chancellor-img-col {
  flex: 1 !important;
  max-width: 480px !important;
  position: relative !important;
}
.bu-chancellor-img-wrapper {
  position: relative !important;
  width: 100% !important;
}
.bu-chancellor-img {
  width: 100% !important;
  max-height: 450px !important;
  object-fit: cover !important;
  object-position: center top !important;
  border-radius: 6px !important;
  box-shadow: 0 16px 36px rgba(0,0,0,0.12) !important;
  display: block !important;
  image-rendering: -webkit-optimize-contrast !important;
  image-rendering: crisp-edges !important;
  image-rendering: high-quality !important;
  filter: contrast(1.04) saturate(1.05) brightness(1.01) !important;
}
.bu-chancellor-quote-card {
  position: absolute !important;
  bottom: -25px !important;
  right: -30px !important;
  background-color: #FFC107 !important;
  padding: 24px 28px !important;
  border-radius: 2px !important;
  max-width: 320px !important;
  box-shadow: 0 15px 35px rgba(217,155,0,0.25) !important;
  z-index: 5 !important;
}
.bu-quote-text {
  font-size: 15px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  line-height: 1.5 !important;
  margin-bottom: 12px !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
}
.bu-quote-author {
  font-size: 9.5px !important;
  font-weight: 800 !important;
  letter-spacing: 1.5px !important;
  color: #061D7C !important;
  text-transform: uppercase !important;
  display: block !important;
}

/* Right side content */
.bu-chancellor-text-col {
  flex: 1.2 !important;
  display: flex !important;
  flex-direction: column !important;
}
.bu-chancellor-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 16px !important;
  display: block !important;
}
.bu-chancellor-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 3.8vw, 48px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.15 !important;
  margin: 0 0 24px 0 !important;
}
.bu-chancellor-heading em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
}
.bu-chancellor-desc p {
  font-size: 15px !important;
  line-height: 1.8 !important;
  color: #4B5563 !important;
  margin-bottom: 16px !important;
}
.bu-chancellor-desc p strong {
  color: #061D7C !important;
  font-weight: 700 !important;
}
.bu-chancellor-divider {
  height: 1px !important;
  background-color: #E5E7EB !important;
  width: 100% !important;
  margin: 28px 0 !important;
}

/* Recognitions */
.bu-chancellor-recognitions {
  display: flex !important;
  gap: 48px !important;
}
.bu-recog-item {
  display: flex !important;
  flex-direction: column !important;
  gap: 4px !important;
}
.bu-recog-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 24px !important;
  font-weight: 850 !important;
  color: #061D7C !important;
  line-height: 1 !important;
}
.bu-recog-label {
  font-size: 9px !important;
  font-weight: 800 !important;
  letter-spacing: 1.5px !important;
  color: #9CA3AF !important;
  text-transform: uppercase !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-chancellor-container {
    flex-direction: column !important;
    gap: 40px !important;
  }
  .bu-chancellor-img-col {
    max-width: 100% !important;
    width: 100% !important;
    display: flex !important;
    justify-content: center !important;
  }
  .bu-chancellor-img-wrapper {
    max-width: 400px !important;
  }
  .bu-chancellor-img {
    height: 440px !important;
  }
  .bu-chancellor-quote-card {
    right: -20px !important;
    bottom: -20px !important;
  }
  .bu-chancellor-text-col {
    width: 100% !important;
    align-items: center !important;
    text-align: center !important;
  }
  .bu-chancellor-divider {
    margin: 24px 0 !important;
  }
  .bu-chancellor-recognitions {
    justify-content: center !important;
    width: 100% !important;
  }
}
@media (max-width: 575px) {
  .bu-chancellor-section {
    padding: 50px 16px !important;
  }
  .bu-chancellor-img {
    height: 360px !important;
  }
  .bu-chancellor-quote-card {
    position: static !important;
    max-width: 100% !important;
    margin-top: 15px !important;
    box-shadow: 0 8px 24px rgba(217,155,0,0.15) !important;
  }
  .bu-chancellor-recognitions {
    gap: 24px !important;
  }
  .bu-recog-title {
    font-size: 20px !important;
  }
}
</style>
