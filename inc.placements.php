<?php
// Bhabha University – Industry & Placements section (Recruiter Logos Integration)
$recruiterList = [];
if (isset($db) && is_object($db)) {
    $dbRecs = $db->get('recruiters');
    if (is_array($dbRecs) && count($dbRecs) > 0) {
        $recruiterList = $dbRecs;
    }
}
if (empty($recruiterList)) {
    $recruiterList = [
        ['name'=>'TCS', 'image'=>'d3caeae9e816d5fc99453d507f514203.png'],
        ['name'=>'Tech Mahindra', 'image'=>'287bce7543bd9523612115973d1823e9.png'],
        ['name'=>'Wipro', 'image'=>'267602a126ca0fa3237b5689caf35b42.png'],
        ['name'=>'HDFC Bank', 'image'=>'fcd40ef53870b5e70f69092351dd732c.png'],
        ['name'=>'Syntel', 'image'=>'1f17da56f6e681107ce8fd4e40472e10.png'],
        ['name'=>'IBM', 'image'=>'36720c47d7ec81cd036be1bf86cad756.png'],
        ['name'=>'Cognizant', 'image'=>'bbffe2a8fa53d9c33316523169719bdd.png'],
        ['name'=>'Infosys', 'image'=>'fc5f88c2e5e86434c8cf00d207207846.jpg'],
        ['name'=>'Zensar', 'image'=>'be6dce6b467138ed5da63bca53af7c79.jpg'],
        ['name'=>'Mahindra', 'image'=>'fcc7063ae19568816bb5ca014c29437d.jpg'],
        ['name'=>'L&T', 'image'=>'b00170d10909ec0620948ef6ff111be0.jpg'],
        ['name'=>'Eicher', 'image'=>'46105367aa015578e7975c6bc5693693.jpg'],
        ['name'=>'Dell', 'image'=>'bc6e50436615f8493dd4f92cc620be75.png']
    ];
}
$loopRecruiters = array_merge($recruiterList, $recruiterList);
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
    
    <!-- Bottom Row: Recruiter Logo Infinite Marquee Track -->
    <div class="bu-place-ticker" onmouseover="this.querySelector('.bu-place-ticker-track').style.animationPlayState='paused'" onmouseout="this.querySelector('.bu-place-ticker-track').style.animationPlayState='running'">
      <div class="bu-place-ticker-track">
        <?php foreach($loopRecruiters as $irec): ?>
        <div class="bu-logo-pill" title="<?php echo htmlspecialchars($irec['name']); ?>">
          <img src="<?php echo URL_UPLOAD;?>recruiters/<?php echo $irec['image'];?>" 
               alt="<?php echo htmlspecialchars($irec['name']);?>" 
               loading="lazy">
        </div>
        <?php endforeach; ?>
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

/* Infinite Ticker Row - Recruiter Logos */
.bu-place-ticker {
  width: 100% !important;
  overflow: hidden !important;
  position: relative !important;
  padding: 16px 0 !important;
}
.bu-place-ticker-track {
  display: flex !important;
  gap: 24px !important;
  width: max-content !important;
  align-items: center !important;
  animation: buPlaceTickerScroll 35s linear infinite !important;
}
@keyframes buPlaceTickerScroll {
  0% { transform: translate3d(0, 0, 0); }
  100% { transform: translate3d(-50%, 0, 0); }
}

.bu-logo-pill {
  background: #FFFFFF !important;
  border-radius: 12px !important;
  padding: 6px 16px !important;
  height: 88px !important;
  min-width: 175px !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2) !important;
  flex-shrink: 0 !important;
  transition: transform 0.25s ease, box-shadow 0.25s ease !important;
  overflow: hidden !important;
}
.bu-logo-pill:hover {
  transform: translateY(-4px) !important;
  box-shadow: 0 10px 28px rgba(255, 193, 7, 0.45) !important;
}
.bu-logo-pill img {
  height: 72px !important;
  max-height: 72px !important;
  max-width: 190px !important;
  width: 100% !important;
  object-fit: cover !important;
  display: block !important;
  mix-blend-mode: multiply !important;
  filter: contrast(1.18) brightness(0.98) !important;
  image-rendering: -webkit-optimize-contrast !important;
  transform: scale(1.14) !important;
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
