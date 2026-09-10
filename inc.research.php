<?php
// Bhabha University – Research & Innovation section (Exact Design Match)
$res_sec = null;
if (isset($db) && is_object($db)) {
    $db->where('section_key', 'research_innovation');
    $res_sec = $db->getOne('homepage_sections');
}
if ($res_sec && isset($res_sec['status']) && $res_sec['status'] == 0) {
    return; // Section disabled from Admin
}

$res_label = !empty($res_sec['title']) ? $res_sec['title'] : 'RESEARCH & INNOVATION';
$res_heading = !empty($res_sec['heading']) ? $res_sec['heading'] : 'Knowledge that <em>moves</em> the<br>world forward.';
$res_sub = !empty($res_sec['subheading']) ? $res_sec['subheading'] : 'From climate-resilient agriculture to AI in healthcare — our 120+ labs and research centres tackle the questions that matter most.';
$res_img = !empty($res_sec['media_url']) ? (strpos($res_sec['media_url'], 'http') === 0 ? $res_sec['media_url'] : URL_ROOT . ltrim($res_sec['media_url'], '/')) : URL_ROOT . 'new-media/image/research-students.png';

$res_extra = !empty($res_sec['extra_data']) ? json_decode($res_sec['extra_data'], true) : [];
$res_metrics = !empty($res_extra['metrics']) ? $res_extra['metrics'] : [
    ['target' => 250, 'value' => '250', 'suffix' => '+', 'prefix' => '', 'commas' => false, 'label' => 'PATENTS FILED'],
    ['target' => 1200, 'value' => '1200', 'suffix' => '+', 'prefix' => '', 'commas' => true, 'label' => 'PUBLICATIONS'],
    ['target' => 85, 'value' => '85', 'suffix' => ' Cr', 'prefix' => '₹', 'commas' => false, 'label' => 'ACTIVE GRANTS'],
    ['target' => 60, 'value' => '60', 'suffix' => '+', 'prefix' => '', 'commas' => false, 'label' => 'GLOBAL MOUS']
];
$res_highlight = !empty($res_extra['highlight_text']) ? $res_extra['highlight_text'] : 'Featured: DST-funded sustainable energy research lab — ₹2.4 Cr grant.';
$res_highlight_icon = !empty($res_extra['highlight_icon']) ? trim($res_extra['highlight_icon']) : 'fa fa-flask';
if (strpos($res_highlight_icon, 'fa ') !== 0 && strpos($res_highlight_icon, 'fas ') !== 0 && strpos($res_highlight_icon, 'far ') !== 0 && strpos($res_highlight_icon, 'fab ') !== 0) {
    $res_highlight_icon = 'fa ' . (strpos($res_highlight_icon, 'fa-') === 0 ? $res_highlight_icon : 'fa-' . $res_highlight_icon);
}
$res_btn_text = !empty($res_extra['button_text']) ? $res_extra['button_text'] : 'EXPLORE RESEARCH &nbsp;→';
$raw_btn_url = !empty($res_extra['button_url']) ? $res_extra['button_url'] : 'research.php';
if (strpos($raw_btn_url, 'http') === 0 || strpos($raw_btn_url, '#') === 0) {
    $res_btn_url = $raw_btn_url;
} else {
    $res_btn_url = function_exists('href') ? href($raw_btn_url) : URL_ROOT . ltrim($raw_btn_url, '/');
}
?>
<section class="bu-research-section">
  <div class="bu-research-container">
    
    <!-- LEFT: Text content & Metrics -->
    <div class="bu-research-text-col">
      <span class="bu-res-label"><?php echo htmlspecialchars($res_label); ?></span>
      <h2 class="bu-res-heading"><?php echo $res_heading; ?></h2>
      <p class="bu-res-sub"><?php echo nl2br(htmlspecialchars($res_sub)); ?></p>
      
      <!-- Metrics Grid -->
      <div class="bu-res-metrics">
        <?php foreach ($res_metrics as $m): 
          $rawNum = !empty($m['target']) ? $m['target'] : ($m['value'] ?? 0);
          $targetVal = (int)preg_replace('/[^0-9]/', '', (string)$rawNum);
          $prefix = $m['prefix'] ?? '';
          $suffix = $m['suffix'] ?? '';
          $useCommas = !empty($m['commas']) || ($targetVal >= 1000);
          $formattedNum = $useCommas ? number_format($targetVal) : $targetVal;
          $cleanSuffix = (preg_match('/^[a-zA-Z]/', $suffix)) ? ' ' . $suffix : $suffix;
          $displayText = $prefix . $formattedNum . $cleanSuffix;
        ?>
          <div class="bu-metric-item">
            <div class="bu-metric-value" 
                 data-target="<?php echo $targetVal; ?>" 
                 data-suffix="<?php echo htmlspecialchars($cleanSuffix); ?>" 
                 data-prefix="<?php echo htmlspecialchars($prefix); ?>" 
                 data-commas="<?php echo $useCommas ? 'true' : 'false'; ?>"><?php echo htmlspecialchars($displayText); ?></div>
            <div class="bu-metric-lbl"><?php echo htmlspecialchars($m['label']); ?></div>
          </div>
        <?php endforeach; ?>
      </div>
      
      <a href="<?php echo $res_btn_url; ?>" class="bu-res-btn"><?php echo $res_btn_text; ?></a>
    </div>

    <!-- RIGHT: Image & Highlight Card -->
    <div class="bu-research-img-col">
      <div class="bu-res-img-wrapper">
        <img src="<?php echo $res_img; ?>" alt="Research at Bhabha University" class="bu-res-img">
        <div class="bu-res-highlight-card">
          <div class="bu-card-icon"><i class="<?php echo htmlspecialchars($res_highlight_icon); ?>"></i></div>
          <p class="bu-card-highlight-text"><?php echo htmlspecialchars($res_highlight); ?></p>
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
.bu-card-icon i,
.bu-card-icon .fa {
  font-family: 'FontAwesome' !important;
  font-style: normal !important;
  font-weight: normal !important;
  display: inline-block !important;
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
        if (isNaN(target) || target <= 0) return;
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
      }, { threshold: 0.1 });

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
