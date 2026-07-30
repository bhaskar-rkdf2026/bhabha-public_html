<?php
// Bhabha University – Research & Innovation section (Exact Design Match)
?>
<section class="bu-research-section">
  <div class="bu-research-container">
    
    <!-- LEFT: Text content & Metrics -->
    <div class="bu-research-text-col">
      <span class="bu-res-label">RESEARCH & INNOVATION</span>
      <h2 class="bu-res-heading">Knowledge that <em>moves</em> the<br>world forward.</h2>
      <p class="bu-res-sub">From climate-resilient agriculture to AI in healthcare — our 120+ labs and research centres tackle the questions that matter most.</p>
      
      <!-- Metrics Grid -->
      <div class="bu-res-metrics">
        <div class="bu-metric-item">
          <div class="bu-metric-value" data-target="250" data-suffix="+">0</div>
          <div class="bu-metric-lbl">PATENTS FILED</div>
        </div>
        <div class="bu-metric-item">
          <div class="bu-metric-value" data-target="1200" data-suffix="+" data-commas="true">0</div>
          <div class="bu-metric-lbl">PUBLICATIONS</div>
        </div>
        <div class="bu-metric-item">
          <div class="bu-metric-value" data-target="85" data-prefix="₹" data-suffix=" Cr">0</div>
          <div class="bu-metric-lbl">ACTIVE GRANTS</div>
        </div>
        <div class="bu-metric-item">
          <div class="bu-metric-value" data-target="60" data-suffix="+">0</div>
          <div class="bu-metric-lbl">GLOBAL MOUS</div>
        </div>
      </div>
      
      <a href="<?php echo href("page.php","id=22"); ?>" class="bu-res-btn">EXPLORE RESEARCH &nbsp;→</a>
    </div>

    <!-- RIGHT: Image & Highlight Card -->
    <div class="bu-research-img-col">
      <div class="bu-res-img-wrapper">
        <img src="new-media/image/campus-aerial.png" alt="Research at Bhabha University" class="bu-res-img">
        <div class="bu-res-highlight-card">
          <div class="bu-card-icon"><i class="fa fa-flask"></i></div>
          <p class="bu-card-highlight-text">Featured: DST-funded sustainable energy research lab — ₹2.4 Cr grant.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ===== RESEARCH SECTION STYLES ===== -->
<style>
.bu-research-section {
  background-color: #FAF9F6 !important; /* soft warm cream bg */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-research-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
  display: flex !important;
  align-items: center !important;
  gap: 60px !important;
}

/* Left Content Col */
.bu-research-text-col {
  flex: 1.1 !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-res-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: #D99B00 !important;
  text-transform: uppercase !important;
  margin-bottom: 16px !important;
  display: block !important;
}
.bu-res-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(30px, 3.8vw, 44px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.25 !important;
  margin: 0 0 20px 0 !important;
}
.bu-res-heading em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
  text-decoration: underline !important;
  text-decoration-color: #061D7C !important;
  text-underline-offset: 4px !important;
}
.bu-res-sub {
  font-size: 14.5px !important;
  color: #4B5563 !important;
  line-height: 1.7 !important;
  margin: 0 0 36px 0 !important;
  max-width: 490px !important;
}

/* Metrics Grid */
.bu-res-metrics {
  display: grid !important;
  grid-template-columns: repeat(2, 1fr) !important;
  gap: 24px 40px !important;
  margin-bottom: 40px !important;
  width: 100% !important;
}
.bu-metric-item {
  border-left: 2px solid #FFC107 !important;
  padding-left: 16px !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-metric-value {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 28px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.1 !important;
  margin-bottom: 5px !important;
}
.bu-metric-lbl {
  font-size: 9.5px !important;
  font-weight: 800 !important;
  letter-spacing: 1.5px !important;
  color: #9CA3AF !important;
  text-transform: uppercase !important;
}

/* Button */
.bu-res-btn {
  background-color: transparent !important;
  border: 1.5px solid #061D7C !important;
  color: #061D7C !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  padding: 12px 28px !important;
  border-radius: 2px !important;
  text-decoration: none !important;
  transition: all 0.22s ease !important;
}
.bu-res-btn:hover {
  background-color: #061D7C !important;
  color: #FFFFFF !important;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.15) !important;
}

/* Right Image Col */
.bu-research-img-col {
  flex: 1 !important;
  max-width: 480px !important;
  position: relative !important;
}
.bu-res-img-wrapper {
  position: relative !important;
  width: 100% !important;
}
.bu-res-img {
  width: 100% !important;
  height: 480px !important;
  object-fit: cover !important;
  border-radius: 4px !important;
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08) !important;
  display: block !important;
}
.bu-res-highlight-card {
  position: absolute !important;
  bottom: -20px !important;
  left: -30px !important;
  background-color: #D99B00 !important; /* Gold matching mockup */
  padding: 20px 24px !important;
  border-radius: 2px !important;
  max-width: 280px !important;
  box-shadow: 0 12px 28px rgba(217, 155, 0, 0.2) !important;
  z-index: 5 !important;
}
.bu-card-icon {
  font-size: 18px !important;
  color: #061D7C !important;
  margin-bottom: 10px !important;
}
.bu-card-highlight-text {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 14.5px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  line-height: 1.45 !important;
  margin: 0 !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-research-container {
    flex-direction: column-reverse !important;
    gap: 40px !important;
  }
  .bu-research-img-col {
    max-width: 100% !important;
    width: 100% !important;
    display: flex !important;
    justify-content: center !important;
  }
  .bu-res-img-wrapper {
    max-width: 400px !important;
  }
  .bu-res-img {
    height: 400px !important;
  }
  .bu-res-highlight-card {
    left: -20px !important;
    bottom: -20px !important;
  }
  .bu-research-text-col {
    width: 100% !important;
    align-items: center !important;
    text-align: center !important;
  }
  .bu-res-metrics {
    justify-items: center !important;
  }
  .bu-metric-item {
    align-items: center !important;
    border-left: none !important;
    border-top: 2px solid #FFC107 !important;
    padding-left: 0 !important;
    padding-top: 10px !important;
    width: 80% !important;
  }
}
@media (max-width: 575px) {
  .bu-research-section {
    padding: 60px 16px !important;
  }
  .bu-res-img {
    height: 320px !important;
  }
  .bu-res-highlight-card {
    position: static !important;
    max-width: 100% !important;
    margin-top: 15px !important;
    box-shadow: 0 8px 24px rgba(217, 155, 0, 0.15) !important;
  }
  .bu-res-metrics {
    grid-template-columns: 1fr !important;
    gap: 16px !important;
  }
  .bu-metric-item {
    width: 100% !important;
  }
}
</style>

<!-- ===== RESEARCH COUNT-UP SCRIPT ===== -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {
    var rCounters = document.querySelectorAll('.bu-metric-value');
    
    function startResearchCounters() {
      rCounters.forEach(function (counter) {
        var target = parseInt(counter.getAttribute('data-target'), 10);
        var prefix = counter.getAttribute('data-prefix') || '';
        var suffix = counter.getAttribute('data-suffix') || '';
        var useCommas = counter.getAttribute('data-commas') === 'true';
        var current = 0;
        
        var duration = 1800;
        var steps = 40;
        var stepTime = duration / steps;
        var stepValue = Math.ceil(target / steps);
        
        var timer = setInterval(function () {
          current += stepValue;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          var valStr = current;
          if (useCommas) {
            valStr = current.toLocaleString('en-IN');
          }
          counter.textContent = prefix + valStr + suffix;
        }, stepTime);
      });
    }

    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            startResearchCounters();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 });

      var researchSec = document.querySelector('.bu-research-section');
      if (researchSec) {
        observer.observe(researchSec);
      } else {
        startResearchCounters();
      }
    } else {
      startResearchCounters();
    }
  });
})();
</script>
