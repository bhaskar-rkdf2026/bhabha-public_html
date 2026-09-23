<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'blogs.php');
define("TITLE", 'Research, Academic & Tech Blogs');
define("DBTAB", 'site_blogs');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// 1. Toggle Status (Published / Draft)
if ($action == "toggle_status" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $newStatus = ($curr['status'] == 1) ? 0 : 1;
        $db->where('id', $id);
        $db->update(DBTAB, ['status' => $newStatus, 'updated_at' => date('Y-m-d H:i:s')]);
        $_SESSION["success"] = 'Status updated for "' . htmlspecialchars($curr['title']) . '"!';
    }
    redirect(PAGE);
}

// 2. Toggle Featured (Hero Spotlight)
if ($action == "toggle_featured" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $newFeat = ($curr['is_featured'] == 1) ? 0 : 1;
        if ($newFeat == 1) {
            $db->update(DBTAB, ['is_featured' => 0]);
        }
        $db->where('id', $id);
        $db->update(DBTAB, ['is_featured' => $newFeat, 'updated_at' => date('Y-m-d H:i:s')]);
        $_SESSION["success"] = ($newFeat == 1) ? 'Article pinned as Featured Spotlight!' : 'Article removed from Featured Spotlight.';
    }
    redirect(PAGE);
}

// 3. Delete Blog Post
if ($action == "delete" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $db->where('id', $id);
        $db->delete(DBTAB);
        $_SESSION["success"] = 'Blog article "' . htmlspecialchars($curr['title']) . '" deleted successfully!';
    }
    redirect(PAGE);
}

// Helper: Handle Image Upload
if (!function_exists('handleBlogImageUpload')) {
    function handleBlogImageUpload($fileInput, $fallbackUrl = '') {
        if (isset($_FILES[$fileInput]) && !empty($_FILES[$fileInput]['name'])) {
            $uploadDir = '../upload/media/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $origName = basename($_FILES[$fileInput]['name']);
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            if (in_array($ext, $allowed)) {
                $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                $fileName = 'blog_' . $cleanBase . '_' . time() . '.' . $ext;
                if (move_uploaded_file($_FILES[$fileInput]['tmp_name'], $uploadDir . $fileName)) {
                    return 'upload/media/' . $fileName;
                }
            }
        }
        return $fallbackUrl;
    }
}

// Helper: Create URL slug
if (!function_exists('makeSlug')) {
    function makeSlug($string) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return trim($slug, '-');
    }
}

// 4. Handle Add / Edit Submission (POST)
if (isset($_POST['submit'])) {
    $title        = trim($_POST['title'] ?? '');
    $category     = trim($_POST['category'] ?? 'tech');
    $catName      = trim($_POST['category_name'] ?? '');
    $authorName   = trim($_POST['author_name'] ?? 'Faculty Contributor');
    $authorRole   = trim($_POST['author_role'] ?? '');
    $publishDate  = trim($_POST['publish_date'] ?? date('Y-m-d'));
    $readTime     = trim($_POST['read_time'] ?? '5 min read');
    $tags         = trim($_POST['tags'] ?? '');
    $summary      = trim($_POST['summary'] ?? '');
    $content      = trim($_POST['content'] ?? '');
    $isFeatured   = isset($_POST['is_featured']) ? intval($_POST['is_featured']) : 0;
    $status       = isset($_POST['status']) ? intval($_POST['status']) : 1;
    $existingImg  = trim($_POST['existing_image'] ?? '');
    $customSlug   = trim($_POST['slug'] ?? '');
    $metaTitle    = trim($_POST['meta_title'] ?? '');
    $metaDesc     = trim($_POST['meta_description'] ?? '');
    $metaKeywords = trim($_POST['meta_keywords'] ?? '');

    if (empty($title)) {
        $stat['error'] = 'Article Title is required.';
    } else {
        if (empty($catName)) {
            $catMap = [
                'tech'        => 'AI & Tech',
                'pharmacy'    => 'Pharmacy & Health',
                'research'    => 'Patents & Research',
                'career'      => 'Career & Placements',
                'academic'    => 'Academic & Curriculum',
                'student_life'=> 'Campus & Student Life'
            ];
            $catName = $catMap[$category] ?? ucfirst($category);
        }

        $imagePath = handleBlogImageUpload('image_file', $existingImg);
        $slug = !empty($customSlug) ? makeSlug($customSlug) : makeSlug($title);
        if (empty($slug)) {
            $slug = 'blog-' . time();
        }

        $postData = [
            'title'            => $title,
            'slug'             => $slug,
            'meta_title'       => $metaTitle,
            'meta_description' => $metaDesc,
            'meta_keywords'    => $metaKeywords,
            'category'         => $category,
            'category_name'    => $catName,
            'author_name'      => $authorName,
            'author_role'      => $authorRole,
            'publish_date'     => $publishDate,
            'read_time'        => $readTime,
            'tags'             => $tags,
            'summary'          => $summary,
            'content'          => $content,
            'image'            => $imagePath,
            'is_featured'      => $isFeatured,
            'status'           => $status,
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        if ($isFeatured == 1) {
            $db->update(DBTAB, ['is_featured' => 0]);
        }

        if ($action == 'add') {
            $postData['created_at'] = date('Y-m-d H:i:s');
            $insertId = $db->insert(DBTAB, $postData);
            if ($insertId) {
                $_SESSION['success'] = 'New blog article "' . htmlspecialchars($title) . '" published successfully!';
                redirect(PAGE);
            } else {
                $stat['error'] = 'Failed to insert article: ' . $db->getLastError();
            }
        } elseif ($action == 'edit') {
            $id = intval($_POST['id'] ?? 0);
            $db->where('id', $id);
            if ($db->update(DBTAB, $postData)) {
                $_SESSION['success'] = 'Blog article "' . htmlspecialchars($title) . '" updated successfully!';
                redirect(PAGE);
            } else {
                $stat['error'] = 'Failed to update article: ' . $db->getLastError();
            }
        }
    }
}

// Fetch KPIs
$totalBlogs    = $db->getValue(DBTAB, 'count(*)');
$activeBlogs   = $db->where('status', 1)->getValue(DBTAB, 'count(*)');
$featuredCount = $db->where('is_featured', 1)->getValue(DBTAB, 'count(*)');
$categories    = $db->rawQuery("SELECT DISTINCT category FROM " . DBTAB);
$catCount      = count($categories);

// Fetch All Blogs
$allBlogs = $db->orderBy('publish_date', 'DESC')->get(DBTAB);

// Edit Row Fetch
$editRow = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $editId = intval($_GET['id']);
    $db->where('id', $editId);
    $editRow = $db->getOne(DBTAB);
    if (!$editRow) {
        $_SESSION['error'] = 'Blog article not found.';
        redirect(PAGE);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Bhabha Admin</title>
<?php include_once("inc.meta.php"); ?>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

<style>
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051235;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
}

.dash-blog-hero {
  background: linear-gradient(135deg, var(--bu-navy) 0%, #152C70 60%, var(--bu-navy-dark) 100%);
  color: #ffffff;
  border-radius: 12px;
  padding: 22px 28px;
  margin-bottom: 22px;
  box-shadow: 0 8px 24px rgba(10,27,84,0.18);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}
.dash-blog-title {
  font-size: 20px;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 4px;
}
.dash-blog-sub {
  font-size: 13px;
  color: #CBD5E1;
  margin: 0;
}
.kpi-mini-box {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  padding: 16px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 22px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.02);
  transition: transform 0.2s;
}
.kpi-mini-box:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(10,27,84,0.08);
}
.kpi-mini-icon {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.kpi-mini-icon.navy   { background: rgba(10,27,84,0.1); color: var(--bu-navy); }
.kpi-mini-icon.green  { background: rgba(40,167,69,0.12); color: #28a745; }
.kpi-mini-icon.gold   { background: rgba(255,193,7,0.18); color: #D99B00; }
.kpi-mini-icon.purple { background: rgba(111,66,193,0.12); color: #6f42c1; }

.kpi-mini-num {
  font-size: 20px;
  font-weight: 700;
  color: var(--bu-navy);
  line-height: 1.2;
}
.kpi-mini-label {
  font-size: 12px;
  color: #64748B;
  margin-top: 2px;
  font-weight: 600;
}
.card-section-box {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}
.badge-active { background-color: #28a745; color: #fff; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; text-decoration:none; display:inline-block; }
.badge-inactive { background-color: #6c757d; color: #fff; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; text-decoration:none; display:inline-block; }
.badge-feat-yes { background-color: #FFC107; color: #0A1B54; padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 11px; text-decoration:none; display:inline-block; }
.badge-feat-no { background-color: #F1F5F9; color: #64748B; border: 1px solid #CBD5E1; padding: 3px 8px; border-radius: 6px; font-weight: 600; font-size: 11px; text-decoration:none; display:inline-block; }

.cat-badge {
  font-size: 11px;
  font-weight: 700;
  padding: 4px 9px;
  border-radius: 6px;
  display: inline-block;
}
.cat-badge.tech { background:#EFF6FF; color:#1D4ED8; }
.cat-badge.pharmacy { background:#ECFDF5; color:#047857; }
.cat-badge.research { background:#F5F3FF; color:#6D28D9; }
.cat-badge.career { background:#FEF3C7; color:#B45309; }
.cat-badge.default { background:#F1F5F9; color:#475569; }

/* Action Buttons */
.btn-action-edit {
  background: var(--bu-navy);
  color: #fff !important;
  font-weight: 600;
  border-radius: 6px;
  font-size: 12px;
  padding: 4px 10px;
}
.btn-action-edit:hover {
  background: #152C70;
}
.btn-action-del {
  border-radius: 6px;
  font-size: 12px;
  padding: 4px 8px;
}
.btn-action-view {
  border-radius: 6px;
  font-size: 12px;
  padding: 4px 8px;
}
</style>
</head>
<body class="fixed-left">
<div id="wrapper">
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page">
    <div class="content">
      <?php include_once("inc.top.php"); ?>
      
      <div class="page-content-wrapper">
        <div class="container-fluid">

          <!-- Header Hero -->
          <div class="dash-blog-hero">
            <div>
              <h4 class="dash-blog-title d-flex align-items-center">
                <i class="mdi mdi-newspaper text-warning mr-2" style="font-size: 26px;"></i>
                Research, Academic &amp; Tech Blogs Manager
              </h4>
              <p class="dash-blog-sub">Publish monthly blog articles, manage categories, authors, and featured spotlight posts.</p>
            </div>
            <div>
              <?php if ($action == 'add' || $action == 'edit'): ?>
                <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-outline-light mr-1 font-weight-bold">
                  <i class="mdi mdi-arrow-left mr-1"></i> Back to Blog List
                </a>
              <?php else: ?>
                <a href="<?php echo PAGE; ?>?action=add" class="btn btn-sm btn-warning font-weight-bold mr-1 shadow-sm" style="background:#FFC107;color:#0A1B54;border:none;border-radius:8px;padding:6px 14px;">
                  <i class="mdi mdi-plus-circle mr-1"></i> + Add New Blog Post
                </a>
              <?php endif; ?>
              <a href="../blogs.php" target="_blank" class="btn btn-sm btn-outline-light mr-1 font-weight-bold">
                <i class="mdi mdi-open-in-new mr-1"></i> Live Blog Portal
              </a>
            </div>
          </div>

          <!-- Alerts -->
          <?php if (!empty($stat['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:8px;font-weight:600;">
              <i class="mdi mdi-check-circle mr-1"></i> <?php echo $stat['success']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          <?php endif; ?>
          <?php if (!empty($stat['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:8px;font-weight:600;">
              <i class="mdi mdi-alert-circle mr-1"></i> <?php echo $stat['error']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          <?php endif; ?>

          <!-- KPI Summary Cards (List view only) -->
          <?php if ($action != 'add' && $action != 'edit'): ?>
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="kpi-mini-box">
                <div class="kpi-mini-icon navy">
                  <i class="mdi mdi-file-document-box"></i>
                </div>
                <div>
                  <div class="kpi-mini-num"><?php echo $totalBlogs; ?></div>
                  <div class="kpi-mini-label">Total Articles</div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="kpi-mini-box">
                <div class="kpi-mini-icon green">
                  <i class="mdi mdi-check-circle"></i>
                </div>
                <div>
                  <div class="kpi-mini-num text-success"><?php echo $activeBlogs; ?></div>
                  <div class="kpi-mini-label">Active &amp; Published</div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="kpi-mini-box">
                <div class="kpi-mini-icon gold">
                  <i class="mdi mdi-star"></i>
                </div>
                <div>
                  <div class="kpi-mini-num" style="color:#D99B00;"><?php echo $featuredCount; ?> Active</div>
                  <div class="kpi-mini-label">Hero Spotlight Story</div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="kpi-mini-box">
                <div class="kpi-mini-icon purple">
                  <i class="mdi mdi-tag-multiple"></i>
                </div>
                <div>
                  <div class="kpi-mini-num" style="color:#6f42c1;"><?php echo $catCount; ?> Topics</div>
                  <div class="kpi-mini-label">Academic Categories</div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- ======================================================== -->
          <!-- VIEW 1: ADD / EDIT FORM VIEW                             -->
          <!-- ======================================================== -->
          <?php if ($action == 'add' || $action == 'edit'): 
            $isEdit = ($action == 'edit' && !empty($editRow));
            $formTitle = $isEdit ? 'Edit Blog Article: ' . htmlspecialchars($editRow['title']) : 'Publish New Blog Article';
          ?>
          <div class="row">
            <div class="col-12">
              <div class="card-section-box">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                  <div>
                    <h5 class="mb-0 font-weight-bold" style="color:var(--bu-navy);font-size:16px;">
                      <i class="mdi mdi-square-edit-outline mr-1 text-primary"></i> <?php echo $formTitle; ?>
                    </h5>
                    <small class="text-muted">Fill out the details below to publish or update an article on the university blog portal.</small>
                  </div>
                  <div>
                    <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-secondary font-weight-bold" style="border-radius:6px;">
                      <i class="mdi mdi-close mr-1"></i> Cancel
                    </a>
                  </div>
                </div>

                <form method="POST" action="<?php echo PAGE; ?>?action=<?php echo $action; ?>" enctype="multipart/form-data">
                  <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $editRow['id']; ?>">
                    <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editRow['image'] ?? ''); ?>">
                  <?php endif; ?>

                  <!-- Row 1: Title & Category -->
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Article Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($editRow['title'] ?? ''); ?>" placeholder="e.g. Commercializing Academic Research: How BU Developed Formulations" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Category Key</label>
                        <select name="category" class="form-control" id="catSelect" onchange="autoFillCatName(this.value)">
                          <?php 
                          $currCat = $editRow['category'] ?? 'tech';
                          $catOptions = [
                            'tech'         => 'AI & Tech (tech)',
                            'pharmacy'     => 'Pharmacy & Health (pharmacy)',
                            'research'     => 'Patents & Research (research)',
                            'career'       => 'Career & Placements (career)',
                            'academic'     => 'Academic & Curriculum (academic)',
                            'student_life' => 'Campus & Student Life (student_life)'
                          ];
                          foreach ($catOptions as $k => $v) {
                            $sel = ($currCat == $k) ? 'selected' : '';
                            echo "<option value='{$k}' {$sel}>{$v}</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Row 2: Category Display Name & Author Info -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Category Display Name</label>
                        <input type="text" name="category_name" id="catNameInp" class="form-control" value="<?php echo htmlspecialchars($editRow['category_name'] ?? 'AI & Tech'); ?>" placeholder="e.g. Pharmacy & Health">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Author Name <span class="text-danger">*</span></label>
                        <input type="text" name="author_name" class="form-control" value="<?php echo htmlspecialchars($editRow['author_name'] ?? 'Faculty Contributor'); ?>" placeholder="e.g. Dr. S. K. Verma" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Author Role / Designation</label>
                        <input type="text" name="author_role" class="form-control" value="<?php echo htmlspecialchars($editRow['author_role'] ?? 'Dean, Research & Development'); ?>" placeholder="e.g. Dean, Research & Development">
                      </div>
                    </div>
                  </div>

                  <!-- Row 3: Dates, Read Time, Tags -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Publication Date</label>
                        <input type="date" name="publish_date" class="form-control" value="<?php echo htmlspecialchars($editRow['publish_date'] ?? date('Y-m-d')); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Estimated Read Time</label>
                        <input type="text" name="read_time" class="form-control" value="<?php echo htmlspecialchars($editRow['read_time'] ?? '5 min read'); ?>" placeholder="e.g. 5 min read">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Tags (Comma Separated)</label>
                        <input type="text" name="tags" class="form-control" value="<?php echo htmlspecialchars($editRow['tags'] ?? 'Research, Pharmacy, Patents'); ?>" placeholder="e.g. AI, Edge Computing, Research">
                      </div>
                    </div>
                  </div>

                  <!-- Row 4: Custom URL Slug & Featured / Status Checkboxes -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Custom URL Slug</label>
                        <input type="text" name="slug" class="form-control" value="<?php echo htmlspecialchars($editRow['slug'] ?? ''); ?>" placeholder="e.g. commercializing-academic-research">
                        <small class="text-muted">Live Link: <code>blog-details.php?slug=...</code></small>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Featured Spotlight</label>
                        <select name="is_featured" class="form-control">
                          <option value="0" <?php echo (($editRow['is_featured'] ?? 0) == 0) ? 'selected' : ''; ?>>No (Standard Listing)</option>
                          <option value="1" <?php echo (($editRow['is_featured'] ?? 0) == 1) ? 'selected' : ''; ?>>Yes (Pin as Hero Story)</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Publication Status</label>
                        <select name="status" class="form-control">
                          <option value="1" <?php echo (($editRow['status'] ?? 1) == 1) ? 'selected' : ''; ?>>Published (Visible Live)</option>
                          <option value="0" <?php echo (($editRow['status'] ?? 1) == 0) ? 'selected' : ''; ?>>Draft (Hidden)</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Row 5: Cover Image -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark">Featured Cover Image</label>
                    <input type="file" name="image_file" class="form-control-file">
                    <?php if (!empty($editRow['image'])): ?>
                      <div class="mt-2 d-flex align-items-center" style="gap:12px;">
                        <img src="../<?php echo htmlspecialchars($editRow['image']); ?>" alt="Cover" style="width:80px;height:55px;object-fit:cover;border-radius:6px;border:1px solid #CBD5E1;">
                        <small class="text-muted">Current file: <code><?php echo htmlspecialchars($editRow['image']); ?></code></small>
                      </div>
                    <?php endif; ?>
                  </div>

                  <!-- Row 6: Summary & Excerpt -->
                  <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark">Short Summary / Excerpt <span class="text-danger">*</span></label>
                    <textarea name="summary" class="form-control" rows="3" placeholder="Brief 2-3 sentence overview shown in blog cards and social previews..." required><?php echo htmlspecialchars($editRow['summary'] ?? ''); ?></textarea>
                  </div>

                  <!-- Row 7: Full Article Content (CKEditor) -->
                  <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark">Full Article Content</label>
                    <textarea name="content" id="blog_editor" class="form-control" rows="12"><?php echo htmlspecialchars($editRow['content'] ?? ''); ?></textarea>
                  </div>

                  <!-- SEO Accordion -->
                  <div class="accordion mb-4" id="blogSeoAcc">
                    <div class="card border rounded">
                      <div class="card-header bg-white p-2" id="seoHead">
                        <button class="btn btn-link btn-block text-left text-dark font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#seoBody" aria-expanded="false" style="text-decoration:none;">
                          <span><i class="mdi mdi-chart-areaspline text-warning mr-1"></i> Article SEO Meta Information</span>
                          <i class="mdi mdi-chevron-down"></i>
                        </button>
                      </div>
                      <div id="seoBody" class="collapse" data-parent="#blogSeoAcc">
                        <div class="card-body bg-light">
                          <div class="form-group mb-2">
                            <label class="font-weight-bold text-dark" style="font-size:12px;">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control form-control-sm" value="<?php echo htmlspecialchars($editRow['meta_title'] ?? ''); ?>" placeholder="Custom title for Google search results">
                          </div>
                          <div class="form-group mb-2">
                            <label class="font-weight-bold text-dark" style="font-size:12px;">Meta Description</label>
                            <textarea name="meta_description" class="form-control form-control-sm" rows="2" placeholder="Custom description for Google snippet"><?php echo htmlspecialchars($editRow['meta_description'] ?? ''); ?></textarea>
                          </div>
                          <div class="form-group mb-0">
                            <label class="font-weight-bold text-dark" style="font-size:12px;">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control form-control-sm" value="<?php echo htmlspecialchars($editRow['meta_keywords'] ?? ''); ?>" placeholder="Comma separated keywords">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end" style="gap:10px;">
                    <a href="<?php echo PAGE; ?>" class="btn btn-secondary font-weight-bold" style="border-radius:6px;">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary font-weight-bold px-4" style="background:var(--bu-navy);border-color:var(--bu-navy);border-radius:6px;">
                      <i class="mdi mdi-content-save mr-1"></i> Save Blog Article
                    </button>
                  </div>

                </form>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- ======================================================== -->
          <!-- VIEW 2: ALL BLOGS LIST TABLE VIEW                        -->
          <!-- ======================================================== -->
          <?php if ($action != 'add' && $action != 'edit'): ?>
          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm border-0" style="border-radius:12px;">
                <div class="card-body p-4">
                  
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-weight-bold m-0" style="color:var(--bu-navy);">
                      <i class="mdi mdi-format-list-bulleted mr-1 text-primary"></i> All Published Blog Posts &amp; Insights
                    </h5>
                  </div>

                  <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-striped mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr style="background:#F8FAFC; color:var(--bu-navy); font-size:13px;">
                          <th style="width:35px;">#</th>
                          <th>Article Title &amp; Excerpt</th>
                          <th style="width:125px;">Category</th>
                          <th style="width:140px;">Author</th>
                          <th style="width:105px;">Publish Date</th>
                          <th style="width:85px;">Read Time</th>
                          <th style="width:85px;" class="text-center">Spotlight</th>
                          <th style="width:75px;" class="text-center">Status</th>
                          <th style="width:125px;" class="text-center">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $sn = 1;
                        foreach ($allBlogs as $row): 
                          $catClass = in_array($row['category'], ['tech', 'pharmacy', 'research', 'career']) ? $row['category'] : 'default';
                          $pubDateFormatted = date('d M Y', strtotime($row['publish_date']));
                        ?>
                        <tr>
                          <td class="font-weight-bold text-muted"><?php echo $sn++; ?></td>
                          <td>
                            <div class="d-flex align-items-center" style="gap:12px;">
                              <?php if (!empty($row['image'])): ?>
                                <img src="../<?php echo htmlspecialchars($row['image']); ?>" alt="Cover" style="width:52px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #CBD5E1;flex-shrink:0;">
                              <?php endif; ?>
                              <div>
                                <div class="font-weight-bold" style="color:var(--bu-navy);font-size:13.5px;">
                                  <?php echo htmlspecialchars($row['title']); ?>
                                </div>
                                <div class="mt-1">
                                  <a href="../blog-details.php?slug=<?php echo htmlspecialchars($row['slug']); ?>" target="_blank" class="badge badge-light border text-primary" style="font-size:11px;text-decoration:none;" title="Preview live article">
                                    <i class="mdi mdi-link mr-1"></i>/blog/<?php echo htmlspecialchars($row['slug']); ?> 
                                    <i class="mdi mdi-eye text-muted ml-1" style="font-size:10px;"></i>
                                  </a>
                                </div>
                                <small class="text-muted d-block mt-1" style="line-height:1.4;">
                                  <?php echo htmlspecialchars(mb_strimwidth($row['summary'], 0, 95, '...')); ?>
                                </small>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="cat-badge <?php echo $catClass; ?>">
                              <?php echo htmlspecialchars($row['category_name'] ?: ucfirst($row['category'])); ?>
                            </span>
                          </td>
                          <td>
                            <div class="font-weight-bold text-dark" style="font-size:12.5px;">
                              <i class="mdi mdi-account text-muted mr-1"></i><?php echo htmlspecialchars($row['author_name']); ?>
                            </div>
                            <?php if (!empty($row['author_role'])): ?>
                              <small class="text-muted d-block" style="font-size:11px;"><?php echo htmlspecialchars($row['author_role']); ?></small>
                            <?php endif; ?>
                          </td>
                          <td>
                            <div class="font-weight-bold text-dark" style="font-size:12.5px;"><?php echo $pubDateFormatted; ?></div>
                            <small class="text-muted"><?php echo date('F Y', strtotime($row['publish_date'])); ?></small>
                          </td>
                          <td>
                            <span class="badge badge-light border text-muted font-weight-bold">
                              <i class="mdi mdi-clock mr-1"></i><?php echo htmlspecialchars($row['read_time'] ?: '5 min'); ?>
                            </span>
                          </td>
                          <td class="text-center">
                            <a href="<?php echo PAGE; ?>?action=toggle_featured&id=<?php echo $row['id']; ?>" title="Click to toggle hero spotlight">
                              <?php if ($row['is_featured'] == 1): ?>
                                <span class="badge-feat-yes"><i class="mdi mdi-star mr-1"></i> Featured</span>
                              <?php else: ?>
                                <span class="badge-feat-no"><i class="mdi mdi-star-outline mr-1"></i> Standard</span>
                              <?php endif; ?>
                            </a>
                          </td>
                          <td class="text-center">
                            <a href="<?php echo PAGE; ?>?action=toggle_status&id=<?php echo $row['id']; ?>" title="Click to toggle status">
                              <?php if ($row['status'] == 1): ?>
                                <span class="badge-active">Published</span>
                              <?php else: ?>
                                <span class="badge-inactive">Draft</span>
                              <?php endif; ?>
                            </a>
                          </td>
                          <td class="text-center">
                            <div class="d-inline-flex align-items-center" style="gap:4px;">
                              <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary font-weight-bold px-2 py-1" style="background:var(--bu-navy);border-color:var(--bu-navy);border-radius:6px;font-size:12px;" title="Edit Article">
                                <i class="mdi mdi-pencil mr-1"></i> Edit
                              </a>
                              <a href="<?php echo PAGE; ?>?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog post?');" class="btn btn-sm btn-outline-danger px-2 py-1" style="border-radius:6px;font-size:12px;" title="Delete Article">
                                <i class="mdi mdi-delete"></i>
                              </a>
                              <a href="../blog-details.php?slug=<?php echo htmlspecialchars($row['slug']); ?>" target="_blank" class="btn btn-sm btn-outline-info px-2 py-1" style="border-radius:6px;font-size:12px;" title="View Live Blog">
                                <i class="mdi mdi-eye"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>

<?php include_once("inc.footer.js.php"); ?>
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
  if ($('#datatable').length) {
    $('#datatable').DataTable({
      "pageLength": 10,
      "ordering": false,
      "language": {
        "search": "_INPUT_",
        "searchPlaceholder": "Search articles by title, author, or category..."
      }
    });
  }

  if ($('#blog_editor').length && typeof CKEDITOR !== 'undefined') {
    CKEDITOR.replace('blog_editor', {
      height: 300
    });
  }
});

function autoFillCatName(cat) {
  var map = {
    'tech': 'AI & Tech',
    'pharmacy': 'Pharmacy & Health',
    'research': 'Patents & Research',
    'career': 'Career & Placements',
    'academic': 'Academic & Curriculum',
    'student_life': 'Campus & Student Life'
  };
  var inp = document.getElementById('catNameInp');
  if (inp && map[cat]) {
    inp.value = map[cat];
  }
}
</script>
</body>
</html>
