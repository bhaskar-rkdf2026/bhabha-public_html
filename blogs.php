<?php 
include_once("config.php");
$portalPage = function_exists('getPortalPage') ? getPortalPage('blogs') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Research, Academic &amp; Tech Blogs - Bhabha University'); ?></title>
<meta name="description" content="Explore insights, faculty thought leadership, research breakthroughs, and career guides on emerging technology, pharmaceuticals, management, and student life.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   BLOGS & ARTICLES PAGE STYLES
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

.bu-blog-wrap {
  background: #F8FAFC;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 50px 20px 80px;
  clear: both !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
}
.bu-blog-container {
  max-width: 1200px;
  margin: 0 auto;
}

/* Category Filter Bar & Search */
.bu-blog-toolbar {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 14px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 15px;
  margin-bottom: 40px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
  flex-wrap: wrap;
}
.bu-blog-cats {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.bu-cat-btn {
  background: #F1F5F9;
  color: var(--bu-text-dark);
  border: none;
  font-size: 13px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
}
.bu-cat-btn:hover, .bu-cat-btn.active {
  background: var(--bu-navy);
  color: var(--bu-gold);
}

.bu-blog-search {
  position: relative;
  min-width: 250px;
}
.bu-blog-search input {
  width: 100%;
  height: 40px;
  border: 1.5px solid #CBD5E1;
  border-radius: 6px;
  padding: 0 35px 0 14px;
  font-size: 13.5px;
  outline: none;
}
.bu-blog-search input:focus {
  border-color: var(--bu-navy);
}
.bu-blog-search i {
  position: absolute;
  right: 12px;
  top: 13px;
  color: var(--bu-text-muted);
}

/* Featured Blog Hero Card */
.bu-featured-blog {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-left: 5px solid var(--bu-gold);
  border-radius: 16px;
  padding: 35px 40px;
  margin-bottom: 45px;
  box-shadow: 0 10px 30px rgba(10,27,84,0.05);
}
.bu-feat-meta {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 12px;
  flex-wrap: wrap;
}
.bu-badge-cat {
  background: #EFF6FF;
  color: #1D4ED8;
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 4px;
  letter-spacing: 0.5px;
}
.bu-blog-date, .bu-blog-readtime {
  font-size: 12.5px;
  color: var(--bu-text-muted);
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 5px;
}
.bu-featured-blog h2 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 12px;
  line-height: 1.35;
}
.bu-featured-blog p {
  font-size: 14.5px;
  color: var(--bu-text-muted);
  line-height: 1.7;
  margin-bottom: 20px;
}
.bu-feat-author-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-top: 1px solid #F1F5F9;
  padding-top: 16px;
  flex-wrap: wrap;
  gap: 15px;
}
.bu-author-info {
  display: flex;
  align-items: center;
  gap: 12px;
}
.bu-author-avatar {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: var(--bu-navy);
  color: var(--bu-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 16px;
}
.bu-author-name {
  font-size: 14px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0;
}
.bu-author-role {
  font-size: 12px;
  color: var(--bu-text-muted);
  margin: 0;
}

/* Featured Hero Grid with Image */
.bu-featured-grid-wrap {
  display: grid;
  grid-template-columns: 1.18fr 0.82fr;
  gap: 32px;
  align-items: center;
}
@media (max-width: 991px) {
  .bu-featured-grid-wrap {
    grid-template-columns: 1fr;
  }
}
.bu-featured-img-col {
  border-radius: 12px;
  overflow: hidden;
  height: 270px;
  box-shadow: 0 8px 24px rgba(10, 27, 84, 0.08);
  border: 1px solid var(--bu-border);
}
.bu-featured-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.bu-featured-img-col:hover .bu-featured-img {
  transform: scale(1.04);
}

/* Blog Posts Grid */
.bu-blog-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 30px;
  margin-bottom: 55px;
}
.bu-post-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.25s ease;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}
.bu-post-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(10,27,84,0.08);
  border-color: #CBD5E1;
}
.bu-post-thumb-wrap {
  width: 100%;
  height: 200px;
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 16px;
  background: #F1F5F9;
  border: 1px solid var(--bu-border);
}
.bu-post-thumb {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.bu-post-card:hover .bu-post-thumb {
  transform: scale(1.04);
}
.bu-post-top {
  margin-bottom: 15px;
}
.bu-post-title {
  font-family: 'Playfair Display', serif;
  font-size: 19px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 10px 0 10px;
  line-height: 1.4;
}
.bu-post-excerpt {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.6;
  margin-bottom: 18px;
}
.bu-post-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 15px;
}
.bu-post-tags span {
  font-size: 11px;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  color: #64748B;
  padding: 2px 8px;
  border-radius: 4px;
  font-weight: 600;
}
.bu-post-footer {
  border-top: 1px solid #F1F5F9;
  padding-top: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-post-author-small {
  font-size: 12.5px;
  font-weight: 700;
  color: var(--bu-navy);
}
.bu-post-btn-read {
  color: var(--bu-navy);
  font-size: 13px;
  font-weight: 800;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
}
.bu-post-btn-read:hover {
  color: var(--bu-gold-dark);
}

.bu-featured-blog h2 a,
.bu-post-title a {
  color: inherit !important;
  text-decoration: none !important;
  transition: color 0.2s ease;
}
.bu-featured-blog h2 a:hover,
.bu-post-title a:hover {
  color: var(--bu-gold-dark) !important;
}

@media (max-width: 768px) {
  .bu-blog-toolbar { flex-direction: column; align-items: stretch; }
  .bu-featured-blog { padding: 25px 20px; }
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- INNER HERO BANNER -->
  <?php
  $page_title    = portalVal($portalPage, 'heading', 'Research, Academic <em>&amp; Tech Blogs</em>');
  $page_subtitle = portalVal($portalPage, 'subheading', 'Insights, faculty thought leadership, research breakthroughs, and career guides on emerging technology, pharmaceuticals, management, and campus life.');
  $page_icon     = 'fa-rss';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Publications', 'url' => href('research.php#media-publications')],
    ['label' => 'Blogs & Insights', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <?php
  // Query blogs from site_blogs table
  $featuredArticle = $db->where('status', 1)->where('is_featured', 1)->getOne('site_blogs');
  if (!$featuredArticle) {
      $featuredArticle = $db->where('status', 1)->orderBy('publish_date', 'DESC')->getOne('site_blogs');
  }

  // Fetch grid articles (excluding featured article if present)
  if ($featuredArticle) {
      $db->where('id', $featuredArticle['id'], '!=');
  }
  $gridArticles = $db->where('status', 1)->orderBy('publish_date', 'DESC')->get('site_blogs');

  if (!function_exists('getBlogUrl')) {
      function getBlogUrl($row) {
          if (!empty($row['slug'])) {
              return URL_ROOT . 'blog/' . rawurlencode($row['slug']);
          }
          return URL_ROOT . 'blog-details.php?id=' . ($row['id'] ?? 1);
      }
  }
  ?>

  <div class="bu-blog-wrap">
    <div class="bu-blog-container">

      <!-- 1. CATEGORY FILTER & SEARCH TOOLBAR -->
      <div class="bu-blog-toolbar">
        <div class="bu-blog-cats">
          <button class="bu-cat-btn active" data-cat="all" onclick="filterBlogCategory('all', this)">All Insights</button>
          <button class="bu-cat-btn" data-cat="tech" onclick="filterBlogCategory('tech', this)">AI &amp; Tech</button>
          <button class="bu-cat-btn" data-cat="pharmacy" onclick="filterBlogCategory('pharmacy', this)">Pharmacy &amp; Health</button>
          <button class="bu-cat-btn" data-cat="research" onclick="filterBlogCategory('research', this)">Patents &amp; Research</button>
          <button class="bu-cat-btn" data-cat="career" onclick="filterBlogCategory('career', this)">Career &amp; Placements</button>
        </div>

        <div class="bu-blog-search">
          <input type="text" id="blogSearchInp" placeholder="Search articles..." onkeyup="searchBlogArticles(this.value)">
          <i class="fa fa-search"></i>
        </div>
      </div>

      <!-- 2. FEATURED HERO ARTICLE -->
      <?php if ($featuredArticle): 
        $featCatKey = htmlspecialchars($featuredArticle['category']);
        $featCatLabel = htmlspecialchars($featuredArticle['category_name'] ?: 'Featured Insight');
        $featDate = date('d F Y', strtotime($featuredArticle['publish_date']));
        $featRead = htmlspecialchars($featuredArticle['read_time'] ?: '5 min read');
        $featTitle = htmlspecialchars($featuredArticle['title']);
        $featSummary = htmlspecialchars($featuredArticle['summary']);
        $featAuthor = htmlspecialchars($featuredArticle['author_name']);
        $featRole = htmlspecialchars($featuredArticle['author_role'] ?? 'Bhabha University');
        $featImg = !empty($featuredArticle['image']) ? ((strpos($featuredArticle['image'], 'http') === 0) ? $featuredArticle['image'] : (URL_ROOT . ltrim($featuredArticle['image'], '/'))) : '';
        $initials = '';
        $parts = explode(' ', trim($featuredArticle['author_name']));
        foreach ($parts as $p) {
          if (!empty($p)) $initials .= strtoupper($p[0]);
          if (strlen($initials) >= 2) break;
        }
        if (empty($initials)) $initials = 'BU';
      ?>
      <div class="bu-featured-blog" data-cat="<?php echo $featCatKey; ?>">
        <div class="bu-featured-grid-wrap">
          <div>
            <div class="bu-feat-meta">
              <span class="bu-badge-cat" style="background:#FEF3C7;color:#92400E;">FEATURED INSIGHT</span>
              <span class="bu-badge-cat"><?php echo $featCatLabel; ?></span>
              <span class="bu-blog-date"><i class="fa fa-calendar-o"></i> <?php echo $featDate; ?></span>
              <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> <?php echo $featRead; ?></span>
            </div>

            <h2><a href="<?php echo getBlogUrl($featuredArticle); ?>"><?php echo $featTitle; ?></a></h2>
            <p>
              <?php echo $featSummary; ?>
            </p>

            <div class="bu-feat-author-bar">
              <div class="bu-author-info">
                <div class="bu-author-avatar"><?php echo htmlspecialchars($initials); ?></div>
                <div>
                  <div class="bu-author-name"><?php echo $featAuthor; ?></div>
                  <div class="bu-author-role"><?php echo $featRole; ?></div>
                </div>
              </div>
              <a href="<?php echo getBlogUrl($featuredArticle); ?>" class="bu-post-btn-read" style="font-size:14px;color:var(--bu-navy);">
                Read Full Story <i class="fa fa-arrow-right"></i>
              </a>
            </div>
          </div>
          <?php if (!empty($featImg)): ?>
          <div class="bu-featured-img-col">
            <a href="<?php echo getBlogUrl($featuredArticle); ?>" style="display:block;height:100%;">
              <img src="<?php echo htmlspecialchars($featImg); ?>" alt="<?php echo $featTitle; ?>" class="bu-featured-img">
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- 3. ARTICLES GRID -->
      <div class="bu-blog-grid" id="blogGrid">
        <?php if (!empty($gridArticles)): ?>
          <?php foreach ($gridArticles as $art): 
            $catKey = htmlspecialchars($art['category']);
            $catLabel = htmlspecialchars($art['category_name'] ?: ucfirst($art['category']));
            $readTime = htmlspecialchars($art['read_time'] ?: '5 min read');
            $title = htmlspecialchars($art['title']);
            $authorName = htmlspecialchars($art['author_name']);
            $summary = htmlspecialchars($art['summary']);
            $tags = array_filter(array_map('trim', explode(',', $art['tags'] ?? '')));
            $artDate = date('d M Y', strtotime($art['publish_date']));
            $artImg = !empty($art['image']) ? ((strpos($art['image'], 'http') === 0) ? $art['image'] : (URL_ROOT . ltrim($art['image'], '/'))) : '';
          ?>
          <div class="bu-post-card" data-cat="<?php echo $catKey; ?>">
            <?php if (!empty($artImg)): ?>
            <div class="bu-post-thumb-wrap">
              <a href="<?php echo getBlogUrl($art); ?>" style="display:block;height:100%;">
                <img src="<?php echo htmlspecialchars($artImg); ?>" alt="<?php echo $title; ?>" class="bu-post-thumb" loading="lazy">
              </a>
            </div>
            <?php endif; ?>
            <div class="bu-post-top">
              <div class="bu-feat-meta">
                <span class="bu-badge-cat"><?php echo $catLabel; ?></span>
                <span class="bu-blog-date"><i class="fa fa-calendar-o"></i> <?php echo $artDate; ?></span>
                <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> <?php echo $readTime; ?></span>
              </div>
              <h3 class="bu-post-title"><a href="<?php echo getBlogUrl($art); ?>"><?php echo $title; ?></a></h3>
              <p class="bu-post-excerpt">
                <?php echo $summary; ?>
              </p>
              <?php if (!empty($tags)): ?>
              <div class="bu-post-tags">
                <?php foreach ($tags as $t): ?>
                  <span>#<?php echo htmlspecialchars(ltrim($t, '#')); ?></span>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
            <div class="bu-post-footer">
              <span class="bu-post-author-small"><i class="fa fa-user-circle-o"></i> <?php echo $authorName; ?></span>
              <a href="<?php echo getBlogUrl($art); ?>" class="bu-post-btn-read">
                Read Article <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="grid-column: 1 / -1; text-align:center; padding: 50px 20px;">
            <i class="fa fa-newspaper-o text-muted" style="font-size:42px; margin-bottom:12px; display:block;"></i>
            <h4 style="color:var(--bu-navy); font-weight:700;">More Articles Coming Soon</h4>
            <p class="text-muted">Check back next month for fresh research publications, career advisories, and technical whitepapers.</p>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<!-- Scripts -->
<?php include('inc.footer.js.php'); ?>
<script>
function filterBlogCategory(cat, btn) {
  document.querySelectorAll('.bu-cat-btn').forEach(function(b) { b.classList.remove('active'); });
  if (btn) btn.classList.add('active');

  var cards = document.querySelectorAll('.bu-post-card');
  cards.forEach(function(card) {
    if(cat === 'all') {
      card.style.display = 'flex';
    } else {
      var cardCats = card.getAttribute('data-cat') || '';
      if(cardCats.indexOf(cat) !== -1) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    }
  });
}

function searchBlogArticles(query) {
  var q = query.toLowerCase();
  var cards = document.querySelectorAll('.bu-post-card');
  cards.forEach(function(card) {
    var text = card.innerText.toLowerCase();
    if(text.indexOf(q) !== -1) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

// Deep linking support for category and search query
document.addEventListener('DOMContentLoaded', function() {
  var urlParams = new URLSearchParams(window.location.search);
  var catParam = urlParams.get('cat');
  var qParam = urlParams.get('q');

  if (catParam) {
    var targetBtn = document.querySelector('.bu-cat-btn[data-cat="' + catParam + '"]');
    if (targetBtn) {
      filterBlogCategory(catParam, targetBtn);
    }
  }

  if (qParam) {
    var searchInput = document.getElementById('blogSearchInp');
    if (searchInput) {
      searchInput.value = qParam;
      searchBlogArticles(qParam);
    }
  }
});
</script>
</body>
</html>
