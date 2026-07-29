<?php
// Bhabha University – News & Events section (Exact Design Match with Pagination)
?>
<section class="bu-events-section">
  <div class="bu-events-container">
    
    <!-- Header Row -->
    <div class="bu-events-header">
      <div class="bu-events-header-left">
        <span class="bu-events-label">NEWS & EVENTS</span>
        <h2 class="bu-events-heading">Latest from campus.</h2>
      </div>
      <div class="bu-events-header-right">
        <a href="<?php echo href("events.php"); ?>" class="bu-all-news">ALL NEWS &nbsp;→</a>
      </div>
    </div>

    <!-- Events List Table-style Rows -->
    <div class="bu-events-list">
      
      <?php
      // Fetch only 5 latest events from database
      $events = $db->get('events', 5);
      if(is_array($events) && count($events) > 0):
        $categories = ['ADMISSIONS', 'RESEARCH', 'EVENTS', 'PLACEMENTS'];
        $dates = ['12 Mar 2026', '08 Mar 2026', '01 Mar 2026', '24 Feb 2026'];
        
        foreach($events as $idx => $ievent):
          $cat = $categories[$idx % count($categories)];
          $date = isset($dates[$idx]) ? $dates[$idx] : date('d M Y', strtotime("-".($idx * 5)." days"));
      ?>
      <a href="<?php echo href("events.php","id=".$ievent['id']."");?>" class="bu-event-row">
        <span class="bu-event-date"><?php echo $date; ?></span>
        <span class="bu-event-category"><?php echo $cat; ?></span>
        <span class="bu-event-title"><?php echo htmlspecialchars($ievent['title']); ?></span>
        <span class="bu-event-arrow"><i class="fa fa-arrow-right"></i></span>
      </a>
      <?php 
        endforeach;
      else:
        // Mock fallback rows matching image exactly
        $mocks = [
          ['date' => '12 Mar 2026', 'cat' => 'ADMISSIONS', 'title' => 'Applications open for 2026-27 academic session across all 15 schools'],
          ['date' => '08 Mar 2026', 'cat' => 'RESEARCH', 'title' => 'Engineering team secures ₹2.4 Cr DST grant for sustainable energy lab'],
          ['date' => '01 Mar 2026', 'cat' => 'EVENTS', 'title' => "Convergence '26 — annual international research conference returns"],
          ['date' => '24 Feb 2026', 'cat' => 'PLACEMENTS', 'title' => 'Record placement season closes with 98% offers and 12 international roles'],
          ['date' => '18 Feb 2026', 'cat' => 'ADMISSIONS', 'title' => 'Direct Admission rounds start for Diploma and Certificate courses'],
          ['date' => '10 Feb 2026', 'cat' => 'RESEARCH', 'title' => 'Department of Pharmacy publishes 12 new research papers in international journals'],
          ['date' => '02 Feb 2026', 'cat' => 'EVENTS', 'title' => 'Spandan 2026 — Annual national cultural festival scheduled next week']
        ];
        foreach($mocks as $mock):
      ?>
      <a href="<?php echo href("events.php"); ?>" class="bu-event-row">
        <span class="bu-event-date"><?php echo $mock['date']; ?></span>
        <span class="bu-event-category"><?php echo $mock['cat']; ?></span>
        <span class="bu-event-title"><?php echo $mock['title']; ?></span>
        <span class="bu-event-arrow"><i class="fa fa-arrow-right"></i></span>
      </a>
      <?php
        endforeach;
      endif;
      ?>

    </div>

    <!-- Pagination Container -->
    <div class="bu-events-pagination" id="buEventsPagination"></div>

  </div>
</section>

<!-- ===== EVENTS SECTION STYLES ===== -->
<style>
.bu-events-section {
  background-color: #FAF9F6 !important; /* soft cream bg */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-events-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}
.bu-events-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  margin-bottom: 50px !important;
  gap: 20px !important;
}
.bu-events-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 12px !important;
  display: block !important;
}
.bu-events-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(30px, 3.8vw, 44px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.2 !important;
  margin: 0 !important;
}
.bu-all-news {
  font-size: 11.5px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  text-decoration: none !important;
  border-bottom: 2px solid #FFC107 !important;
  padding-bottom: 6px !important;
  letter-spacing: 1px !important;
  transition: all 0.2s ease !important;
  white-space: nowrap !important;
}
.bu-all-news:hover {
  color: #D99B00 !important;
  border-bottom-color: #061D7C !important;
}

/* Event list rows */
.bu-events-list {
  border-top: 1px solid #E5E7EB !important;
  width: 100% !important;
}
.bu-event-row {
  display: grid !important;
  grid-template-columns: 140px 140px 1fr 40px !important;
  align-items: center !important;
  padding: 32px 0 !important;
  border-bottom: 1px solid #E5E7EB !important;
  text-decoration: none !important;
  transition: all 0.25s ease !important;
  background-color: transparent !important;
}
.bu-event-row:hover {
  background-color: #FFFFFF !important;
  padding-left: 20px !important;
  padding-right: 10px !important;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02) !important;
}

.bu-event-date {
  font-size: 13.5px !important;
  color: #9CA3AF !important;
  font-weight: 500 !important;
}
.bu-event-category {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 1.8px !important;
  color: #D99B00 !important;
  text-transform: uppercase !important;
}
.bu-event-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 20px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  line-height: 1.35 !important;
  padding-right: 20px !important;
}
.bu-event-arrow {
  color: #061D7C !important;
  font-size: 16px !important;
  text-align: right !important;
  transition: transform 0.25s ease !important;
}
.bu-event-row:hover .bu-event-arrow {
  transform: translateX(6px) !important;
  color: #FFC107 !important;
}

/* Pagination controls style */
.bu-events-pagination {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  gap: 8px !important;
  margin-top: 40px !important;
  width: 100% !important;
}
.bu-page-btn {
  background-color: #FFFFFF !important;
  border: 1px solid #EAEAEA !important;
  color: #061D7C !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  width: 38px !important;
  height: 38px !important;
  border-radius: 3px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  transition: all 0.22s ease !important;
  user-select: none !important;
}
.bu-page-btn:hover {
  border-color: #FFC107 !important;
  color: #D99B00 !important;
}
.bu-page-btn.active {
  background-color: #061D7C !important;
  border-color: #061D7C !important;
  color: #FFFFFF !important;
}
.bu-page-nav-btn {
  background-color: #FFFFFF !important;
  border: 1px solid #EAEAEA !important;
  color: #061D7C !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
  padding: 0 16px !important;
  height: 38px !important;
  border-radius: 3px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  transition: all 0.22s ease !important;
  user-select: none !important;
}
.bu-page-nav-btn:hover {
  border-color: #FFC107 !important;
  color: #D99B00 !important;
}
.bu-page-nav-btn.disabled {
  opacity: 0.35 !important;
  cursor: not-allowed !important;
  pointer-events: none !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-event-row {
    grid-template-columns: 120px 120px 1fr 30px !important;
    padding: 24px 0 !important;
  }
  .bu-event-title {
    font-size: 18px !important;
  }
}
@media (max-width: 768px) {
  .bu-event-row {
    grid-template-columns: 100px 1fr 20px !important;
    gap: 10px !important;
  }
  .bu-event-category {
    grid-column: 2 !important;
    grid-row: 1 !important;
  }
  .bu-event-title {
    grid-column: 2 !important;
    grid-row: 2 !important;
    font-size: 16px !important;
    padding-right: 0 !important;
  }
  .bu-event-arrow {
    grid-column: 3 !important;
    grid-row: 1 / span 2 !important;
  }
}
</style>

<!-- ===== EVENTS PAGINATION CONTROLLER ===== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  var rows = document.querySelectorAll('.bu-event-row');
  var itemsPerPage = 5;
  var totalItems = rows.length;
  var totalPages = Math.ceil(totalItems / itemsPerPage);
  var currentPage = 1;
  var pagContainer = document.getElementById('buEventsPagination');

  if (totalItems <= itemsPerPage) {
    if (pagContainer) pagContainer.style.display = 'none';
    return;
  }

  function showPage(page) {
    currentPage = page;
    var start = (page - 1) * itemsPerPage;
    var end = start + itemsPerPage;

    rows.forEach(function (row, idx) {
      if (idx >= start && idx < end) {
        row.style.display = 'grid';
      } else {
        row.style.display = 'none';
      }
    });

    renderControls();
  }

  function renderControls() {
    if (!pagContainer) return;
    pagContainer.innerHTML = '';

    // Prev button
    var prevBtn = document.createElement('div');
    prevBtn.className = 'bu-page-nav-btn' + (currentPage === 1 ? ' disabled' : '');
    prevBtn.innerHTML = 'PREV';
    prevBtn.addEventListener('click', function () {
      if (currentPage > 1) showPage(currentPage - 1);
    });
    pagContainer.appendChild(prevBtn);

    // Page number buttons
    for (var i = 1; i <= totalPages; i++) {
      (function (pageNum) {
        var pageBtn = document.createElement('div');
        pageBtn.className = 'bu-page-btn' + (currentPage === pageNum ? ' active' : '');
        pageBtn.innerText = pageNum;
        pageBtn.addEventListener('click', function () {
          showPage(pageNum);
        });
        pagContainer.appendChild(pageBtn);
      })(i);
    }

    // Next button
    var nextBtn = document.createElement('div');
    nextBtn.className = 'bu-page-nav-btn' + (currentPage === totalPages ? ' disabled' : '');
    nextBtn.innerHTML = 'NEXT';
    nextBtn.addEventListener('click', function () {
      if (currentPage < totalPages) showPage(currentPage + 1);
    });
    pagContainer.appendChild(nextBtn);
  }

  // Show page 1 on load
  showPage(1);
});
</script>
