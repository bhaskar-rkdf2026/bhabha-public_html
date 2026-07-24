<?php
// Bhabha University – Industry & Placements section (Exact Design Match)
?>
<section class="bu-placements-section">
  <div class="bu-placements-container">
    
    <!-- Top Row: Headers and Counters -->
    <div class="bu-place-top-row">
      <div class="bu-place-header-left">
        <span class="bu-place-label">INDUSTRY & PLACEMENTS</span>
        <h2 class="bu-place-heading">Careers that go <em>global.</em></h2>
      </div>
      
      <!-- Counters Grid -->
      <div class="bu-place-counters">
        <div class="bu-place-counter-item">
          <span class="bu-place-number" data-target="98" data-suffix="%">0</span>
          <span class="bu-place-sub">PLACEMENTS</span>
        </div>
        <div class="bu-place-counter-item">
          <span class="bu-place-number" data-target="52" data-prefix="₹" data-suffix=" LPA">0</span>
          <span class="bu-place-sub">HIGHEST PKG</span>
        </div>
        <div class="bu-place-counter-item">
          <span class="bu-place-number" data-target="500" data-suffix="+">0</span>
          <span class="bu-place-sub">RECRUITERS</span>
        </div>
      </div>
    </div>
    
    <div class="bu-place-divider"></div>
    
    <!-- Bottom Row: Infinite Scrolling Brand Names -->
    <div class="bu-place-ticker">
      <div class="bu-place-ticker-track">
        <span class="bu-company">Amazon</span>
        <span class="bu-company">TCS</span>
        <span class="bu-company">Infosys</span>
        <span class="bu-company">Wipro</span>
        <span class="bu-company">Deloitte</span>
        <span class="bu-company">Accenture</span>
        <span class="bu-company">Cognizant</span>
        <span class="bu-company">Capgemini</span>
        <span class="bu-company">Tech Mahindra</span>
        <span class="bu-company">HCL Technologies</span>
        <!-- Duplicate elements for continuous scrolling loop -->
        <span class="bu-company">Amazon</span>
        <span class="bu-company">TCS</span>
        <span class="bu-company">Infosys</span>
        <span class="bu-company">Wipro</span>
        <span class="bu-company">Deloitte</span>
        <span class="bu-company">Accenture</span>
        <span class="bu-company">Cognizant</span>
        <span class="bu-company">Capgemini</span>
        <span class="bu-company">Tech Mahindra</span>
        <span class="bu-company">HCL Technologies</span>
      </div>
    </div>

  </div>
</section>

<!-- ===== PLACEMENTS SECTION STYLES ===== -->
<style>
.bu-placements-section {
  background-color: #061D7C !important; /* Deep Navy background matching mockup */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
  position: relative !important;
  overflow: hidden !important;
}
.bu-placements-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}

/* Top Row Layout */
.bu-place-top-row {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  margin-bottom: 50px !important;
  gap: 30px !important;
}
.bu-place-header-left {
  flex: 1.2 !important;
}
.bu-place-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: #FFC107 !important;
  text-transform: uppercase !important;
  margin-bottom: 16px !important;
  display: block !important;
}
.bu-place-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 4.2vw, 52px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  line-height: 1.15 !important;
  margin: 0 !important;
}
.bu-place-heading em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
}

/* Placements Counters */
.bu-place-counters {
  display: flex !important;
  gap: 60px !important;
  align-items: center !important;
}
.bu-place-counter-item {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-place-number {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(34px, 4vw, 48px) !important;
  font-weight: 800 !important;
  color: #FFC107 !important;
  line-height: 1.1 !important;
  margin-bottom: 6px !important;
}
.bu-place-sub {
  font-size: 9.5px !important;
  font-weight: 800 !important;
  letter-spacing: 1.8px !important;
  color: rgba(255, 255, 255, 0.5) !important;
  text-transform: uppercase !important;
}

.bu-place-divider {
  height: 1px !important;
  background-color: rgba(255, 255, 255, 0.1) !important;
  width: 100% !important;
  margin-bottom: 40px !important;
}

/* Infinite Ticker Row */
.bu-place-ticker {
  width: 100% !important;
  overflow: hidden !important;
  position: relative !important;
  padding: 10px 0 !important;
}
.bu-place-ticker-track {
  display: flex !important;
  gap: 80px !important;
  width: max-content !important;
  animation: buPlaceTickerScroll 28s linear infinite !important;
}
@keyframes buPlaceTickerScroll {
  0% { transform: translate3d(0, 0, 0); }
  100% { transform: translate3d(-50%, 0, 0); }
}
.bu-company {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 26px !important;
  font-style: italic !important;
  font-weight: 700 !important;
  color: rgba(255, 255, 255, 0.35) !important;
  white-space: nowrap !important;
  letter-spacing: 0.5px !important;
  transition: color 0.3s ease !important;
  cursor: default !important;
}
.bu-company:hover {
  color: #FFC107 !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-place-top-row {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 30px !important;
  }
  .bu-place-counters {
    width: 100% !important;
    justify-content: space-between !important;
    gap: 20px !important;
  }
  .bu-placements-section {
    padding: 60px 16px !important;
  }
}
@media (max-width: 575px) {
  .bu-place-counters {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 16px 8px !important;
  }
  .bu-place-number {
    font-size: 26px !important;
  }
  .bu-place-sub {
    font-size: 8.5px !important;
    letter-spacing: 1px !important;
  }
  .bu-place-ticker-track {
    gap: 40px !important;
  }
  .bu-company {
    font-size: 20px !important;
  }
}
</style>

<!-- ===== PLACEMENTS COUNT-UP SCRIPT ===== -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {
    var pCounters = document.querySelectorAll('.bu-place-number');
    
    function startPlacementsCounters() {
      pCounters.forEach(function (counter) {
        var target = parseInt(counter.getAttribute('data-target'), 10);
        var prefix = counter.getAttribute('data-prefix') || '';
        var suffix = counter.getAttribute('data-suffix') || '';
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
          counter.textContent = prefix + current + suffix;
        }, stepTime);
      });
    }

    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            startPlacementsCounters();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 });

      var placementsSec = document.querySelector('.bu-placements-section');
      if (placementsSec) {
        observer.observe(placementsSec);
      } else {
        startPlacementsCounters();
      }
    } else {
      startPlacementsCounters();
    }
  });
})();
</script>
