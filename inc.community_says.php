<?php
// Bhabha University – What our community says (Interactive Testimonials Slider)
?>
<section class="bu-voices-section">
  <div class="bu-voices-container">
    
    <!-- Centered Header Block -->
    <div class="bu-voices-header">
      <span class="bu-voices-label">VOICES</span>
      <h2 class="bu-voices-heading">What our <em>community</em> says.</h2>
    </div>

    <!-- Testimonials Slider Wrapper -->
    <div class="bu-voices-slider-wrap">
      <div id="buVoicesCarousel" class="owl-carousel bu-voices-owl">
        
        <?php
        // Fetch exactly 3 testimonials – Owl Carousel loop:true clones internally
        $testimonial = $db->get('testimonial', 3);
        if(is_array($testimonial) && count($testimonial) > 0):
          foreach($testimonial as $iTestimonial):
            $desig = !empty($iTestimonial['designation']) ? $iTestimonial['designation'] : 'Alumni';
        ?>
        <div class="item">
          <div class="bu-voice-card">
            <div class="bu-voice-icon"><i class="fa fa-quote-left"></i></div>
            <p class="bu-voice-quote">"<?php echo htmlspecialchars(strip_tags($iTestimonial['testimonial'])); ?>"</p>
            <h4 class="bu-voice-author"><?php echo htmlspecialchars($iTestimonial['name']); ?></h4>
            <span class="bu-voice-details"><?php echo htmlspecialchars($desig); ?></span>
          </div>
        </div>
        <?php 
            endforeach;
        else:
          // Fallback mock testimonials matching design
          $fallbacks = [
            [
              'quote' => 'Bhabha gave me the rigour, the network and the courage to start my company in my final year.',
              'name' => 'Priya Menon',
              'desig' => 'Founder, Halio Labs · MBA \'23'
            ],
            [
              'quote' => 'The mentorship from senior clinicians at the teaching hospital is unmatched — I felt ready from day one.',
              'name' => 'Dr. Arjun Rao',
              'desig' => 'Resident, AIIMS · MBBS \'22'
            ],
            [
              'quote' => 'We hire from Bhabha every year. Graduates arrive with strong fundamentals and a real engineering mindset.',
              'name' => 'Sarah Lin',
              'desig' => 'Director, Microsoft IDC'
            ]
          ];
          // Owl Carousel loop:true clones internally – render once only
          foreach($fallbacks as $fb):
        ?>
        <div class="item">
          <div class="bu-voice-card">
            <div class="bu-voice-icon"><i class="fa fa-quote-left"></i></div>
            <p class="bu-voice-quote">"<?php echo $fb['quote']; ?>"</p>
            <h4 class="bu-voice-author"><?php echo $fb['name']; ?></h4>
            <span class="bu-voice-details"><?php echo $fb['desig']; ?></span>
          </div>
        </div>
        <?php
            endforeach;
        endif;
        ?>

      </div>
    </div>

  </div>
</section>

<!-- ===== VOICES SECTION STYLES ===== -->
<style>
.bu-voices-section {
  background-color: #FAF9F6 !important; /* soft cream bg */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-voices-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}
.bu-voices-header {
  text-align: center !important;
  margin-bottom: 55px !important;
}
.bu-voices-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 12px !important;
  display: block !important;
}
.bu-voices-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 3.8vw, 44px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.2 !important;
  margin: 0 !important;
}
.bu-voices-heading em {
  font-style: italic !important;
  color: #061D7C !important;
  font-weight: 700 !important;
  text-decoration: underline !important;
  text-decoration-color: #FFC107 !important;
  text-underline-offset: 4px !important;
}

/* Testimonial Card */
.bu-voice-card {
  background-color: #FFFFFF !important;
  border: 1px solid #EAEAEA !important;
  border-radius: 4px !important;
  padding: 44px 36px !important;
  min-height: 320px !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  transition: all 0.3s ease !important;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01) !important;
  margin: 10px 5px !important;
}
.bu-voice-card:hover {
  transform: translateY(-4px) !important;
  box-shadow: 0 12px 28px rgba(6, 29, 124, 0.06) !important;
  border-color: #FFC107 !important;
}
.bu-voice-icon {
  font-size: 20px !important;
  color: #FFC107 !important;
  margin-bottom: 24px !important;
}
.bu-voice-quote {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 19px !important;
  font-weight: 500 !important;
  color: #061D7C !important;
  line-height: 1.55 !important;
  margin: 0 0 32px 0 !important;
  text-align: left !important;
  flex: 1 !important;
}
.bu-voice-author {
  font-size: 14.5px !important;
  font-weight: 750 !important;
  color: #061D7C !important;
  margin: 0 0 4px 0 !important;
}
.bu-voice-details {
  font-size: 11px !important;
  font-weight: 500 !important;
  color: #9CA3AF !important;
}

/* Dots and Slider Styles */
.bu-voices-owl .owl-dots {
  text-align: center !important;
  margin-top: 36px !important;
}
.bu-voices-owl .owl-dot span {
  background: rgba(6, 29, 124, 0.2) !important;
  width: 8px !important;
  height: 8px !important;
  border-radius: 50% !important;
  margin: 0 5px !important;
  transition: all 0.3s !important;
}
.bu-voices-owl .owl-dot.active span {
  background: #FFC107 !important;
  width: 24px !important;
  border-radius: 4px !important;
}
</style>

<!-- ===== VOICES SLIDER INIT ===== -->
<script>
(function() {
  function initVoicesSlider() {
    if (typeof jQuery === 'undefined') { setTimeout(initVoicesSlider, 150); return; }
    var $ = jQuery;
    var $car = $('#buVoicesCarousel');
    if (!$car.length) return;

    if ($car.hasClass('owl-loaded')) {
      $car.trigger('destroy.owl.carousel').removeClass('owl-loaded owl-drag');
    }

    $car.owlCarousel({
      loop: true,
      margin: 15,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      smartSpeed: 900,
      dots: true,
      nav: false,
      responsive: {
        0: { items: 1 },
        768: { items: 2 },
        992: { items: 3 }
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initVoicesSlider);
  } else {
    initVoicesSlider();
  }
})();
</script>
