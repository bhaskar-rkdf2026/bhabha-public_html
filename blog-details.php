<?php
include_once("config.php");

// Helper function to generate clean custom blog URLs
if (!function_exists('getBlogUrl')) {
    function getBlogUrl($row) {
        if (!empty($row['slug'])) {
            return URL_ROOT . 'blog/' . rawurlencode($row['slug']);
        }
        return URL_ROOT . 'blog-details.php?id=' . ($row['id'] ?? 1);
    }
}

// Fetch the requested article by slug or id
$param = isset($_GET['slug']) ? trim($_GET['slug']) : (isset($_GET['id']) ? trim($_GET['id']) : '');

$article = null;
if (!empty($param)) {
    if (is_numeric($param)) {
        $article = $db->where('id', intval($param))->where('status', 1)->getOne('site_blogs');
    } else {
        $article = $db->where('slug', $param)->where('status', 1)->getOne('site_blogs');
    }
}

// Fallback to latest article if none found
if (!$article) {
    $article = $db->where('status', 1)->orderBy('is_featured', 'DESC')->orderBy('publish_date', 'DESC')->getOne('site_blogs');
}

// If no blogs exist at all in the database
if (!$article) {
    header("Location: " . URL_ROOT . "blogs.php");
    exit;
}

// Extract article fields safely
$id           = $article['id'];
$title        = $article['title'];
$slug         = !empty($article['slug']) ? $article['slug'] : $article['id'];
$category     = $article['category'];
$categoryName = !empty($article['category_name']) ? $article['category_name'] : ucfirst($article['category']);
$authorName   = !empty($article['author_name']) ? $article['author_name'] : 'Bhabha University Academic Cell';
$authorRole   = !empty($article['author_role']) ? $article['author_role'] : 'Faculty & Research Directorate';
$publishDate  = !empty($article['publish_date']) ? date('d F, Y', strtotime($article['publish_date'])) : date('d F, Y');
$readTime     = !empty($article['read_time']) ? $article['read_time'] : '5 min read';
$summary      = $article['summary'];
$content      = $article['content'];
$image        = !empty($article['image']) ? $article['image'] : '';
$imgSrc       = !empty($image) ? ((strpos($image, 'http') === 0) ? $image : (URL_ROOT . ltrim($image, '/'))) : '';
$tagsRaw      = !empty($article['tags']) ? $article['tags'] : '';
$tagsArray    = array_filter(array_map('trim', explode(',', $tagsRaw)));
$isFeatured   = !empty($article['is_featured']) && $article['is_featured'] == 1;

// Custom SEO Meta Fields (from Admin Panel or fallback)
$seoTitle       = !empty($article['meta_title']) ? $article['meta_title'] : ($article['title'] . ' - Bhabha University Blogs');
$seoDescription = !empty($article['meta_description']) ? $article['meta_description'] : (mb_substr(strip_tags($summary), 0, 160) . '...');
$seoKeywords    = !empty($article['meta_keywords']) ? $article['meta_keywords'] : ($tagsRaw . ', Bhabha University, Research, Academic Blog');

// Canonical Article URL (Using custom slug if available)
$canonicalUrl = getBlogUrl($article);
$encodedUrl   = urlencode($canonicalUrl);
$encodedTitle = urlencode($seoTitle);

// Author initials for monogram avatar
$initials = '';
$parts = explode(' ', trim($authorName));
foreach ($parts as $p) {
    if (!empty($p)) $initials .= strtoupper($p[0]);
    if (strlen($initials) >= 2) break;
}
if (empty($initials)) $initials = 'BU';

// Fetch Previous & Next Articles
$prevArticle = $db->where('status', 1)->where('id', $id, '<')->orderBy('id', 'DESC')->getOne('site_blogs', 'id, title, slug, category_name, publish_date');
$nextArticle = $db->where('status', 1)->where('id', $id, '>')->orderBy('id', 'ASC')->getOne('site_blogs', 'id, title, slug, category_name, publish_date');

// Fetch Related / Recent Articles for Sidebar (excluding current)
$relatedArticles = $db->where('status', 1)->where('id', $id, '!=')->orderBy('is_featured', 'DESC')->orderBy('publish_date', 'DESC')->get('site_blogs', 4, 'id, title, slug, category_name, publish_date, image');

// Fetch Category Counts for Sidebar
$catCounts = $db->rawQuery("SELECT category, category_name, COUNT(*) as total_count FROM site_blogs WHERE status = 1 GROUP BY category, category_name ORDER BY total_count DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($seoTitle); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($seoDescription); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($seoKeywords); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">

<!-- OpenGraph Meta Tags for Rich Social Sharing -->
<meta property="og:title" content="<?php echo htmlspecialchars($seoTitle); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($seoDescription); ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
<?php if (!empty($imgSrc)): ?>
<meta property="og:image" content="<?php echo htmlspecialchars($imgSrc); ?>">
<meta name="twitter:image" content="<?php echo htmlspecialchars($imgSrc); ?>">
<?php endif; ?>

<?php include('inc.meta.php'); ?>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* =========================================================
   BHABHA UNIVERSITY - BLOG DETAILS EDITORIAL THEME
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051235;
  --bu-navy-light: #1E3A8A;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFFBEB;
  --bu-amber: #D97706;
  --bu-slate: #0F172A;
  --bu-body: #334155;
  --bu-muted: #64748B;
  --bu-border: #E2E8F0;
  --bu-bg-soft: #F8FAFC;
  --bu-radius: 16px;
}

/* Reading Progress Bar */
.bu-reading-progress-wrap {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: transparent;
  z-index: 99999;
}
.bu-reading-progress-bar {
  height: 100%;
  width: 0%;
  background: linear-gradient(90deg, var(--bu-gold), #F59E0B, #EF4444);
  transition: width 0.1s ease-out;
}

/* Page Layout Wrapper */
.bu-details-wrap {
  background: #F8FAFC;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
  padding: 45px 20px 85px;
  clear: both !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

.bu-details-container {
  max-width: 1240px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: minmax(0, 1fr) 360px;
  gap: 35px;
  align-items: start;
}

/* =========================================================
   LEFT MAIN ARTICLE COLUMN
   ========================================================= */
.bu-article-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: var(--bu-radius);
  padding: 42px 45px;
  box-shadow: 0 8px 30px rgba(10, 27, 84, 0.04);
  position: relative;
}

/* Category & Meta Pills */
.bu-article-meta-top {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 20px;
}

.bu-badge-cat-detail {
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  padding: 5px 12px;
  border-radius: 6px;
  letter-spacing: 0.6px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

/* Dynamic category colors */
.bu-cat-tech { background: #EFF6FF; color: #1D4ED8; border: 1px solid #DBEAFE; }
.bu-cat-pharmacy { background: #ECFDF5; color: #047857; border: 1px solid #D1FAE5; }
.bu-cat-research { background: #F5F3FF; color: #6D28D9; border: 1px solid #EDE9FE; }
.bu-cat-career { background: #FFFBEB; color: #B45309; border: 1px solid #FEF3C7; }
.bu-cat-academic { background: #EEF2FF; color: #4338CA; border: 1px solid #E0E7FF; }
.bu-cat-default { background: #F1F5F9; color: var(--bu-navy); border: 1px solid #E2E8F0; }

.bu-badge-spotlight {
  background: linear-gradient(135deg, #FEF3C7, #FDE68A);
  color: #92400E;
  border: 1px solid #FCD34D;
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  padding: 5px 12px;
  border-radius: 6px;
  letter-spacing: 0.6px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.bu-meta-item {
  font-size: 13px;
  color: var(--bu-muted);
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.bu-meta-item i {
  color: var(--bu-amber);
}

/* Main Article Title */
.bu-article-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--bu-navy);
  line-height: 1.35;
  margin: 12px 0 24px;
  letter-spacing: -0.3px;
}

/* Author Header Strip */
.bu-author-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #F8FAFC;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 16px 20px;
  margin-bottom: 30px;
  flex-wrap: wrap;
  gap: 15px;
}

.bu-author-profile {
  display: flex;
  align-items: center;
  gap: 14px;
}

.bu-author-avatar-big {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--bu-navy), #1E3A8A);
  color: var(--bu-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 17px;
  box-shadow: 0 4px 12px rgba(10, 27, 84, 0.15);
}

.bu-author-name-text {
  font-size: 15.5px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 2px;
}
.bu-author-role-text {
  font-size: 12.5px;
  color: var(--bu-muted);
  margin: 0;
  font-weight: 500;
}

.bu-header-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}

.bu-share-pill-btn {
  background: #ffffff;
  border: 1px solid #CBD5E1;
  color: var(--bu-navy);
  font-size: 12.5px;
  font-weight: 700;
  padding: 6px 14px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  transition: all 0.2s;
  text-decoration: none !important;
}
.bu-share-pill-btn:hover {
  background: var(--bu-navy);
  color: #ffffff !important;
  border-color: var(--bu-navy);
}

/* Executive Summary Callout Box */
.bu-lead-callout {
  background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
  border-left: 4px solid var(--bu-gold-dark);
  border-radius: 10px;
  padding: 22px 26px;
  margin-bottom: 35px;
  box-shadow: 0 4px 15px rgba(217, 155, 0, 0.05);
}
.bu-lead-callout-header {
  font-size: 12px;
  font-weight: 800;
  text-transform: uppercase;
  color: #92400E;
  letter-spacing: 0.8px;
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.bu-lead-callout p {
  font-size: 15.5px;
  line-height: 1.75;
  color: #78350F;
  margin: 0;
  font-weight: 500;
}

/* Featured Article Image */
.bu-featured-media {
  margin-bottom: 35px;
  border-radius: 12px;
  overflow: hidden;
  border: 1px solid var(--bu-border);
  box-shadow: 0 6px 20px rgba(0,0,0,0.04);
}
.bu-featured-media img {
  width: 100%;
  height: auto;
  max-height: 480px;
  object-fit: cover;
  display: block;
}
.bu-media-caption {
  font-size: 12.5px;
  color: var(--bu-muted);
  padding: 10px 16px;
  background: #F8FAFC;
  border-top: 1px solid var(--bu-border);
  font-style: italic;
}

/* Article Body Content Typography */
.bu-article-body {
  font-size: 16px;
  line-height: 1.85;
  color: var(--bu-body);
}

.bu-article-body p {
  margin-bottom: 22px;
}

.bu-article-body h2 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 24px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 36px 0 16px;
  line-height: 1.4;
  padding-bottom: 8px;
  border-bottom: 2px solid #F1F5F9;
  position: relative;
}
.bu-article-body h2::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 50px;
  height: 2px;
  background: var(--bu-gold);
}

.bu-article-body h3 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 28px 0 12px;
  line-height: 1.4;
}

.bu-article-body strong,
.bu-article-body b {
  color: var(--bu-navy);
  font-weight: 700;
}

.bu-article-body ul,
.bu-article-body ol {
  padding-left: 24px;
  margin-bottom: 24px;
}
.bu-article-body li {
  margin-bottom: 10px;
  line-height: 1.75;
}

.bu-article-body blockquote {
  background: #F8FAFC;
  border-left: 4px solid var(--bu-navy);
  border-radius: 0 10px 10px 0;
  padding: 20px 24px;
  margin: 30px 0;
  font-family: 'Playfair Display', Georgia, serif;
  font-style: italic;
  font-size: 17px;
  line-height: 1.7;
  color: var(--bu-navy);
}

.bu-article-body table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 28px 0 !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  border: 1px solid var(--bu-border);
}
.bu-article-body table th {
  background: var(--bu-navy) !important;
  color: #ffffff !important;
  font-weight: 700 !important;
  padding: 12px 16px !important;
  font-size: 14px;
}
.bu-article-body table td {
  padding: 12px 16px !important;
  border-bottom: 1px solid var(--bu-border);
  font-size: 14.5px;
}
.bu-article-body table tr:nth-child(even) td {
  background: #F8FAFC;
}

/* Article Tags & Keywords */
.bu-article-tags-wrap {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 8px;
  padding-top: 25px;
  margin-top: 35px;
  border-top: 1px solid #F1F5F9;
}
.bu-tags-label {
  font-size: 13px;
  font-weight: 800;
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  gap: 6px;
  margin-right: 5px;
}
.bu-tag-pill {
  font-size: 12px;
  font-weight: 600;
  background: #F1F5F9;
  color: var(--bu-navy);
  border: 1px solid #E2E8F0;
  padding: 4px 12px;
  border-radius: 20px;
  text-decoration: none !important;
  transition: all 0.2s;
}
.bu-tag-pill:hover {
  background: var(--bu-navy);
  color: var(--bu-gold) !important;
  border-color: var(--bu-navy);
}

/* Social Share Bar */
.bu-share-bar-bottom {
  background: #F8FAFC;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 20px 24px;
  margin: 35px 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 15px;
}
.bu-share-title {
  font-size: 14px;
  font-weight: 800;
  color: var(--bu-navy);
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0;
}
.bu-share-buttons {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.bu-social-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 8px;
  color: #ffffff !important;
  font-size: 14px;
  text-decoration: none !important;
  transition: transform 0.2s, opacity 0.2s;
}
.bu-social-btn:hover {
  transform: translateY(-2px);
  opacity: 0.9;
}
.bu-btn-wa { background: #25D366; }
.bu-btn-in { background: #0A66C2; }
.bu-btn-tw { background: #1DA1F2; }
.bu-btn-fb { background: #1877F2; }
.bu-btn-copy {
  background: #475569;
  cursor: pointer;
  border: none;
}

/* Author Biography Card */
.bu-author-bio-card {
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 26px;
  background: #ffffff;
  display: flex;
  gap: 20px;
  align-items: center;
  margin-top: 30px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}
.bu-author-bio-avatar {
  width: 65px;
  height: 65px;
  border-radius: 50%;
  background: var(--bu-navy);
  color: var(--bu-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  font-weight: 800;
  flex-shrink: 0;
}
.bu-author-bio-text h4 {
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 4px;
}
.bu-author-bio-text h6 {
  font-size: 13px;
  color: var(--bu-amber);
  font-weight: 700;
  margin: 0 0 8px;
}
.bu-author-bio-text p {
  font-size: 13.5px;
  color: var(--bu-muted);
  line-height: 1.6;
  margin: 0;
}

/* Previous / Next Article Navigation */
.bu-article-nav-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin-top: 40px;
}
.bu-nav-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 18px 20px;
  text-decoration: none !important;
  display: flex;
  flex-direction: column;
  justify-content: center;
  transition: all 0.25s ease;
}
.bu-nav-card:hover {
  transform: translateY(-3px);
  border-color: var(--bu-navy);
  box-shadow: 0 8px 20px rgba(10, 27, 84, 0.06);
}
.bu-nav-sub {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  color: var(--bu-amber);
  margin-bottom: 4px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.bu-nav-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 14.5px;
  font-weight: 700;
  color: var(--bu-navy);
  margin: 0;
  line-height: 1.4;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

/* =========================================================
   RIGHT SIDEBAR COLUMN
   ========================================================= */
.bu-sidebar-sticky {
  position: sticky;
  top: 30px;
  display: flex;
  flex-direction: column;
  gap: 28px;
}

.bu-sidebar-widget {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 24px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}

.bu-widget-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 17px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 16px;
  padding-bottom: 10px;
  border-bottom: 2px solid #F1F5F9;
  position: relative;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-widget-title::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 35px;
  height: 2px;
  background: var(--bu-gold);
}

/* Search Box in Sidebar */
.bu-side-search-form {
  position: relative;
}
.bu-side-search-form input {
  width: 100%;
  height: 42px;
  border: 1.5px solid var(--bu-border);
  border-radius: 8px;
  padding: 0 40px 0 14px;
  font-size: 13.5px;
  outline: none;
  background: #F8FAFC;
  transition: all 0.2s;
  box-sizing: border-box;
}
.bu-side-search-form input:focus {
  border-color: var(--bu-navy);
  background: #ffffff;
}
.bu-side-search-form button {
  position: absolute;
  right: 6px;
  top: 5px;
  height: 32px;
  width: 32px;
  border: none;
  background: var(--bu-navy);
  color: var(--bu-gold);
  border-radius: 6px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Recent Posts List in Sidebar */
.bu-recent-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.bu-recent-item {
  display: flex;
  flex-direction: column;
  gap: 4px;
  padding-bottom: 14px;
  border-bottom: 1px solid #F1F5F9;
  text-decoration: none !important;
}
.bu-recent-item:last-child {
  border-bottom: none;
  padding-bottom: 0;
}
.bu-recent-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 11px;
  color: var(--bu-muted);
  font-weight: 600;
}
.bu-recent-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 14px;
  font-weight: 700;
  color: var(--bu-navy);
  line-height: 1.4;
  margin: 0;
  transition: color 0.2s;
}
.bu-recent-item:hover .bu-recent-title {
  color: var(--bu-amber);
}

/* Categories List in Sidebar */
.bu-cat-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.bu-cat-list li {
  margin-bottom: 8px;
}
.bu-cat-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 8px 12px;
  border-radius: 8px;
  background: #F8FAFC;
  color: var(--bu-navy);
  font-size: 13px;
  font-weight: 700;
  text-decoration: none !important;
  transition: all 0.2s ease;
}
.bu-cat-link:hover {
  background: var(--bu-navy);
  color: var(--bu-gold) !important;
  transform: translateX(3px);
}
.bu-cat-count {
  background: #ffffff;
  color: var(--bu-muted);
  font-size: 11px;
  font-weight: 800;
  padding: 2px 8px;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
}
.bu-cat-link:hover .bu-cat-count {
  background: rgba(255,255,255,0.2);
  color: #ffffff;
  border-color: transparent;
}

/* Call to Action Card in Sidebar */
.bu-cta-sidebar {
  background: linear-gradient(135deg, var(--bu-navy) 0%, #061D7C 100%);
  border-radius: 14px;
  padding: 26px 24px;
  color: #ffffff;
  text-align: center;
  box-shadow: 0 10px 25px rgba(10, 27, 84, 0.15);
}
.bu-cta-icon {
  width: 50px;
  height: 50px;
  background: rgba(255, 193, 7, 0.15);
  border: 1px solid rgba(255, 193, 7, 0.3);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 15px;
  color: var(--bu-gold);
  font-size: 20px;
}
.bu-cta-sidebar h4 {
  font-family: 'Playfair Display', serif;
  color: #ffffff;
  font-size: 18px;
  font-weight: 700;
  margin: 0 0 10px;
}
.bu-cta-sidebar p {
  font-size: 12.5px;
  color: #CBD5E1;
  line-height: 1.6;
  margin-bottom: 18px;
}
.bu-cta-btn {
  display: inline-block;
  background: var(--bu-gold);
  color: var(--bu-navy);
  font-size: 13px;
  font-weight: 800;
  padding: 10px 20px;
  border-radius: 6px;
  text-decoration: none !important;
  transition: all 0.2s;
  box-shadow: 0 4px 12px rgba(255,193,7,0.3);
}
.bu-cta-btn:hover {
  background: #ffffff;
  color: var(--bu-navy);
  transform: translateY(-2px);
}

/* Back to Blog List Button */
.bu-back-btn-widget {
  display: block;
  text-align: center;
  background: #ffffff;
  border: 1.5px solid var(--bu-navy);
  color: var(--bu-navy);
  font-size: 13.5px;
  font-weight: 800;
  padding: 12px 20px;
  border-radius: 8px;
  text-decoration: none !important;
  transition: all 0.2s;
}
.bu-back-btn-widget:hover {
  background: var(--bu-navy);
  color: var(--bu-gold) !important;
}

/* Copy Toast */
.bu-copy-toast {
  position: fixed;
  bottom: 30px;
  right: 30px;
  background: var(--bu-navy);
  color: #ffffff;
  padding: 12px 20px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  z-index: 999999;
  opacity: 0;
  transform: translateY(20px);
  pointer-events: none;
  transition: all 0.3s ease;
}
.bu-copy-toast.show {
  opacity: 1;
  transform: translateY(0);
}

/* Responsive Overrides */
@media (max-width: 992px) {
  .bu-details-container {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  .bu-article-card {
    padding: 30px 22px;
  }
  .bu-article-title {
    font-size: 26px;
  }
  .bu-author-bar {
    flex-direction: column;
    align-items: flex-start;
  }
  .bu-article-nav-grid {
    grid-template-columns: 1fr;
  }
}
</style>
</head>

<body>
<!-- Reading Progress -->
<div class="bu-reading-progress-wrap">
  <div class="bu-reading-progress-bar" id="readingProgress"></div>
</div>

<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <!-- INNER HERO BANNER -->
  <?php
  $page_title    = 'Blogs <em>&amp; Academic Insights</em>';
  $page_subtitle = 'Thought leadership, research whitepapers, and academic publications from Bhabha University.';
  $page_icon     = 'fa-newspaper-o';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Blogs & Insights', 'url' => URL_ROOT . 'blogs.php'],
    ['label' => $categoryName, 'url' => URL_ROOT . 'blogs.php?cat=' . urlencode($category)],
    ['label' => 'Article', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <!-- MAIN ARTICLE WRAPPER -->
  <div class="bu-details-wrap">
    <div class="bu-details-container">

      <!-- =========================================================
           MAIN ARTICLE BODY (LEFT COLUMN)
           ========================================================= -->
      <article class="bu-article-card">
        
        <!-- 1. Metadata Top Bar -->
        <div class="bu-article-meta-top">
          <?php
            $catClass = 'bu-cat-default';
            if ($category == 'tech') $catClass = 'bu-cat-tech';
            elseif ($category == 'pharmacy') $catClass = 'bu-cat-pharmacy';
            elseif ($category == 'research') $catClass = 'bu-cat-research';
            elseif ($category == 'career') $catClass = 'bu-cat-career';
            elseif ($category == 'academic') $catClass = 'bu-cat-academic';
          ?>
          <span class="bu-badge-cat-detail <?php echo $catClass; ?>">
            <i class="fa fa-folder-open-o"></i> <?php echo htmlspecialchars($categoryName); ?>
          </span>

          <?php if ($isFeatured): ?>
          <span class="bu-badge-spotlight">
            <i class="fa fa-star"></i> Hero Spotlight
          </span>
          <?php endif; ?>

          <span class="bu-meta-item">
            <i class="fa fa-calendar-o"></i> <?php echo $publishDate; ?>
          </span>

          <span class="bu-meta-item">
            <i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($readTime); ?>
          </span>
        </div>

        <!-- 2. Headline -->
        <h1 class="bu-article-title"><?php echo htmlspecialchars($title); ?></h1>

        <!-- 3. Author Bar & Quick Share Trigger -->
        <div class="bu-author-bar">
          <div class="bu-author-profile">
            <div class="bu-author-avatar-big"><?php echo htmlspecialchars($initials); ?></div>
            <div>
              <div class="bu-author-name-text"><?php echo htmlspecialchars($authorName); ?></div>
              <div class="bu-author-role-text"><?php echo htmlspecialchars($authorRole); ?></div>
            </div>
          </div>
          <div class="bu-header-actions">
            <button type="button" class="bu-share-pill-btn" onclick="copyArticleLink()" title="Copy Link to Clipboard">
              <i class="fa fa-link"></i> Copy Link
            </button>
            <button type="button" class="bu-share-pill-btn" onclick="window.print()" title="Print Article">
              <i class="fa fa-print"></i> Print
            </button>
          </div>
        </div>

        <!-- 4. Lead Summary Callout (if available) -->
        <?php if (!empty($summary)): ?>
        <div class="bu-lead-callout">
          <div class="bu-lead-callout-header">
            <i class="fa fa-bookmark"></i> Executive Summary &amp; Key Insight
          </div>
          <p><?php echo nl2br(htmlspecialchars($summary)); ?></p>
        </div>
        <?php endif; ?>

        <!-- 5. Featured Image (if available) -->
        <?php if (!empty($imgSrc)): ?>
        <div class="bu-featured-media">
          <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="<?php echo htmlspecialchars($title); ?>">
          <div class="bu-media-caption">
            <i class="fa fa-camera"></i> Official publication asset &bull; Bhabha University Academic Repository
          </div>
        </div>
        <?php endif; ?>

        <!-- 6. Full Article HTML Content Body -->
        <div class="bu-article-body">
          <?php 
          if (!empty($content)) {
              echo $content;
          } else {
              echo '<p>' . nl2br(htmlspecialchars($summary)) . '</p>';
          }
          ?>
        </div>

        <!-- 7. Tags & Topics -->
        <?php if (!empty($tagsArray)): ?>
        <div class="bu-article-tags-wrap">
          <span class="bu-tags-label"><i class="fa fa-tags"></i> Topics:</span>
          <?php foreach ($tagsArray as $tg): 
            $cleanTag = ltrim(trim($tg), '#');
          ?>
            <a href="<?php echo URL_ROOT; ?>blogs.php?q=<?php echo urlencode($cleanTag); ?>" class="bu-tag-pill">
              #<?php echo htmlspecialchars($cleanTag); ?>
            </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- 8. Social Share Strip -->
        <div class="bu-share-bar-bottom">
          <div class="bu-share-title">
            <i class="fa fa-share-alt" style="color:var(--bu-amber);"></i> Share this article with peers:
          </div>
          <div class="bu-share-buttons">
            <!-- WhatsApp -->
            <a href="https://api.whatsapp.com/send?text=<?php echo $encodedTitle . '%20' . $encodedUrl; ?>" target="_blank" class="bu-social-btn bu-btn-wa" title="Share on WhatsApp">
              <i class="fa fa-whatsapp"></i>
            </a>
            <!-- LinkedIn -->
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $encodedUrl; ?>" target="_blank" class="bu-social-btn bu-btn-in" title="Share on LinkedIn">
              <i class="fa fa-linkedin"></i>
            </a>
            <!-- Twitter / X -->
            <a href="https://twitter.com/intent/tweet?text=<?php echo $encodedTitle; ?>&url=<?php echo $encodedUrl; ?>" target="_blank" class="bu-social-btn bu-btn-tw" title="Share on Twitter">
              <i class="fa fa-twitter"></i>
            </a>
            <!-- Facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encodedUrl; ?>" target="_blank" class="bu-social-btn bu-btn-fb" title="Share on Facebook">
              <i class="fa fa-facebook"></i>
            </a>
            <!-- Copy Link -->
            <button type="button" class="bu-social-btn bu-btn-copy" onclick="copyArticleLink()" title="Copy Link">
              <i class="fa fa-copy"></i>
            </button>
          </div>
        </div>

        <!-- 9. Author Bio Card -->
        <div class="bu-author-bio-card">
          <div class="bu-author-bio-avatar"><?php echo htmlspecialchars($initials); ?></div>
          <div class="bu-author-bio-text">
            <h4><?php echo htmlspecialchars($authorName); ?></h4>
            <h6><?php echo htmlspecialchars($authorRole); ?></h6>
            <p>Faculty researcher and contributing scholar at Bhabha University Bhopal. Actively engaged in curriculum modernization, peer-reviewed publications, and university-industry research translation across interdisciplinary domains.</p>
          </div>
        </div>

        <!-- 10. Next / Prev Article Navigation -->
        <div class="bu-article-nav-grid">
          <?php if ($prevArticle): ?>
            <a href="<?php echo getBlogUrl($prevArticle); ?>" class="bu-nav-card">
              <span class="bu-nav-sub"><i class="fa fa-arrow-left"></i> Previous Insight</span>
              <p class="bu-nav-title"><?php echo htmlspecialchars($prevArticle['title']); ?></p>
            </a>
          <?php else: ?>
            <div class="bu-nav-card" style="opacity: 0.6; cursor: default;">
              <span class="bu-nav-sub"><i class="fa fa-check"></i> Oldest Article</span>
              <p class="bu-nav-title">You are reading our earliest archived publication.</p>
            </div>
          <?php endif; ?>

          <?php if ($nextArticle): ?>
            <a href="<?php echo getBlogUrl($nextArticle); ?>" class="bu-nav-card" style="text-align: right;">
              <span class="bu-nav-sub" style="justify-content: flex-end;">Next Insight <i class="fa fa-arrow-right"></i></span>
              <p class="bu-nav-title"><?php echo htmlspecialchars($nextArticle['title']); ?></p>
            </a>
          <?php else: ?>
            <div class="bu-nav-card" style="opacity: 0.6; cursor: default; text-align: right;">
              <span class="bu-nav-sub" style="justify-content: flex-end;">Latest Insight <i class="fa fa-star"></i></span>
              <p class="bu-nav-title">You are reading the most recent published story.</p>
            </div>
          <?php endif; ?>
        </div>

      </article>

      <!-- =========================================================
           RIGHT SIDEBAR COLUMN
           ========================================================= -->
      <aside class="bu-sidebar-sticky">

        <!-- 1. Search Box -->
        <div class="bu-sidebar-widget">
          <h4 class="bu-widget-title"><i class="fa fa-search" style="color:var(--bu-amber);"></i> Search Insights</h4>
          <form action="<?php echo URL_ROOT; ?>blogs.php" method="GET" class="bu-side-search-form">
            <input type="text" name="q" placeholder="Search keywords, topics..." required>
            <button type="submit"><i class="fa fa-arrow-right"></i></button>
          </form>
        </div>

        <!-- 2. Recent Articles Widget -->
        <div class="bu-sidebar-widget">
          <h4 class="bu-widget-title"><i class="fa fa-newspaper-o" style="color:var(--bu-amber);"></i> Recent Articles</h4>
          <div class="bu-recent-list">
            <?php if (!empty($relatedArticles)): ?>
              <?php foreach ($relatedArticles as $rel): 
                $relDate = date('d M, Y', strtotime($rel['publish_date']));
                $relImg = !empty($rel['image']) ? ((strpos($rel['image'], 'http') === 0) ? $rel['image'] : (URL_ROOT . ltrim($rel['image'], '/'))) : '';
              ?>
              <a href="<?php echo getBlogUrl($rel); ?>" class="bu-recent-item" style="display:flex;flex-direction:row;align-items:center;gap:12px;">
                <?php if (!empty($relImg)): ?>
                  <img src="<?php echo htmlspecialchars($relImg); ?>" alt="<?php echo htmlspecialchars($rel['title']); ?>" style="width:65px;height:52px;object-fit:cover;border-radius:8px;border:1px solid #E2E8F0;flex-shrink:0;">
                <?php endif; ?>
                <div style="flex:1;min-width:0;">
                  <div class="bu-recent-meta">
                    <span style="color:var(--bu-amber);font-weight:700;"><?php echo htmlspecialchars($rel['category_name'] ?: 'Insight'); ?></span>
                    &bull;
                    <span><?php echo $relDate; ?></span>
                  </div>
                  <p class="bu-recent-title" style="margin-top:3px;font-size:13.5px;"><?php echo htmlspecialchars(mb_strimwidth($rel['title'], 0, 58, '...')); ?></p>
                </div>
              </a>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted" style="font-size:13px; margin:0;">More articles coming soon.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- 3. Academic Categories Widget -->
        <div class="bu-sidebar-widget">
          <h4 class="bu-widget-title"><i class="fa fa-folder-open-o" style="color:var(--bu-amber);"></i> Academic Fields</h4>
          <ul class="bu-cat-list">
            <?php if (!empty($catCounts)): ?>
              <?php foreach ($catCounts as $cc): ?>
              <li>
                <a href="<?php echo URL_ROOT; ?>blogs.php?cat=<?php echo urlencode($cc['category']); ?>" class="bu-cat-link">
                  <span><?php echo htmlspecialchars($cc['category_name'] ?: ucfirst($cc['category'])); ?></span>
                  <span class="bu-cat-count"><?php echo $cc['total_count']; ?></span>
                </a>
              </li>
              <?php endforeach; ?>
            <?php else: ?>
              <li><a href="<?php echo URL_ROOT; ?>blogs.php" class="bu-cat-link">All Articles <span class="bu-cat-count">1</span></a></li>
            <?php endif; ?>
          </ul>
        </div>

        <!-- 4. Contribute Callout -->
        <div class="bu-cta-sidebar">
          <div class="bu-cta-icon">
            <i class="fa fa-pencil-square-o"></i>
          </div>
          <h4>Contribute Research</h4>
          <p>Are you a Bhabha faculty member, PhD scholar, or student researcher? Publish your whitepaper or findings with us.</p>
          <a href="mailto:research@bhabhauniversity.edu.in?subject=Blog%20Article%20Submission%20-%20Bhabha%20University" class="bu-cta-btn">
            <i class="fa fa-paper-plane-o"></i> Submit Manuscript
          </a>
        </div>

        <!-- 5. Back to All Articles Button -->
        <a href="<?php echo URL_ROOT; ?>blogs.php" class="bu-back-btn-widget">
          <i class="fa fa-arrow-left"></i> &nbsp;Browse All Blog Articles
        </a>

      </aside>

    </div>
  </div>

  <!-- COPY TOAST NOTIFICATION -->
  <div class="bu-copy-toast" id="copyToast">
    <i class="fa fa-check-circle" style="color:var(--bu-gold);font-size:16px;"></i> Article link copied to clipboard!
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<!-- SCRIPTS -->
<?php include('inc.footer.js.php'); ?>

<script>
// Reading Progress Bar
window.addEventListener('scroll', function() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  var bar = document.getElementById('readingProgress');
  if (bar) {
    bar.style.width = scrolled + '%';
  }
});

// Copy Article Link
function copyArticleLink() {
  var dummy = document.createElement('input');
  dummy.value = window.location.href;
  document.body.appendChild(dummy);
  dummy.select();
  document.execCommand('copy');
  document.body.removeChild(dummy);

  var toast = document.getElementById('copyToast');
  if (toast) {
    toast.classList.add('show');
    setTimeout(function() {
      toast.classList.remove('show');
    }, 2500);
  }
}
</script>
</body>
</html>
