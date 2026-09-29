<?php
// Bhabha University – Marquee Ticker (Direct Clickable News & Announcements)
global $db;
$db->where('section_key', 'achievements_ticker');
$ach_sec = $db->getOne('homepage_sections');

if (!$ach_sec || $ach_sec['status'] != 1) {
    return;
}

$ach_title = !empty($ach_sec['title']) ? $ach_sec['title'] : 'LATEST NEWS & UPDATES :';
$ach_extra = !empty($ach_sec['extra_data']) ? json_decode($ach_sec['extra_data'], true) : [];
$ticker_source = $ach_extra['source'] ?? 'news';

$ticker_items = [];

// 1. Fetch direct from news table (Press Coverage & Official News)
if ($ticker_source === 'news' || empty($ach_extra['items'])) {
    $db->orderBy('news_date', 'desc');
    $db->orderBy('id', 'desc');
    $db_news = $db->get('news', 15);
    if (is_array($db_news) && count($db_news) > 0) {
        foreach ($db_news as $dn) {
            $ticker_items[] = [
                'title' => $dn['title'],
                'url'   => href('news.php', 'id=' . $dn['id'])
            ];
        }
    }
}

// 2. Custom ticker items fallback
if (empty($ticker_items) && !empty($ach_extra['items'])) {
    foreach ($ach_extra['items'] as $it) {
        if (is_array($it)) {
            $ticker_items[] = [
                'title' => $it['title'] ?? ($it['text'] ?? ''),
                'url'   => !empty($it['url']) ? href($it['url']) : ''
            ];
        } else {
            $ticker_items[] = [
                'title' => $it,
                'url'   => ''
            ];
        }
    }
}
?>
<!-- ACHIEVEMENTS / NEWS TICKER START -->
<div class="edu2_ft_topbar_wrap">
  <div class="container">
    <div class="row bu-ticker-align-row">
      <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="bu-achievements-title">
          <h5><i class="fa fa-bullhorn"></i> <?php echo htmlspecialchars($ach_title); ?></h5>
        </div>
      </div>
      <div class="col-md-9 col-sm-8 col-xs-12">
        <div class="bu-achievements-marquee">
          <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
            <?php 
            $total_ach = count($ticker_items);
            foreach ($ticker_items as $a_idx => $tItem): 
              $hasUrl = !empty($tItem['url']);
            ?>
              <span class="ticker-item">
                <?php if ($hasUrl): ?>
                  <a href="<?php echo htmlspecialchars($tItem['url']); ?>" style="color:inherit; text-decoration:none;" onmouseover="this.style.textDecoration='underline'; this.style.color='#ffc107';" onmouseout="this.style.textDecoration='none'; this.style.color='inherit';">
                    <i class="fa fa-angle-double-right text-warning" style="margin-right: 4px;"></i><?php echo htmlspecialchars($tItem['title']); ?>
                  </a>
                <?php else: ?>
                  <?php echo htmlspecialchars($tItem['title']); ?>
                <?php endif; ?>
              </span>
              <?php if ($a_idx < $total_ach - 1): ?>
                <span class="ticker-sep" style="margin: 0 16px; opacity: 0.6;">||</span>
              <?php endif; ?>
            <?php endforeach; ?>
          </marquee>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ACHIEVEMENTS / NEWS TICKER END -->

