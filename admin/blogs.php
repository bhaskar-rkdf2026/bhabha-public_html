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
            // Un-feature others so there is 1 primary hero post
            $db->update(DBTAB, ['is_featured' => 0]);
        }
        $db->where('id', $id);
        $db->update(DBTAB, ['is_featured' => $newFeat, 'updated_at' => date('Y-m-d H:i:s')]);
        $_SESSION["success"] = ($newFeat == 1) ? 'Article pinned as Featured Hero Spotlight!' : 'Article removed from Featured Spotlight.';
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
        // Auto-assign category display name if left empty
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

        // If marked featured, remove featured flag from others
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
<title><?php echo TITLE; ?> - Admin Dashboard</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<style>
.dash-blog-hero {
  background: linear-gradient(135deg, #0A1B54 0%, #152B75 55%, #1C358A 100%);
  color: #ffffff;
  border-radius: 12px;
  padding: 24px 28px;
  margin-bottom: 24px;
  box-shadow: 0 8px 24px rgba(10,27,84,0.18);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}
.dash-blog-title {
  font-size: 22px;
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
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 24px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.02);
}
.kpi-mini-icon {
  width: 46px;
  height: 46px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.kpi-mini-icon.navy   { background: #EEF2FF; color: #0A1B54; }
.kpi-mini-icon.green  { background: #ECFDF5; color: #059669; }
.kpi-mini-icon.gold   { background: #FEF3C7; color: #D97706; }
.kpi-mini-icon.purple { background: #F5F3FF; color: #7C3AED; }

.kpi-mini-num {
  font-size: 20px;
  font-weight: 700;
  color: #0F172A;
  line-height: 1.2;
}
.kpi-mini-label {
  font-size: 12px;
  color: #64748B;
  margin-top: 2px;
}
.card-section-box {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.badge-active { background-color: #28a745; color: #fff; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 11px; text-decoration:none; }
.badge-inactive { background-color: #dc3545; color: #fff; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 11px; text-decoration:none; }
.badge-feat-yes { background-color: #FFC107; color: #0A1B54; padding: 4px 10px; border-radius: 4px; font-weight: 700; font-size: 11px; text-decoration:none; }
.badge-feat-no { background-color: #F1F5F9; color: #64748B; border: 1px solid #CBD5E1; padding: 3px 8px; border-radius: 4px; font-weight: 600; font-size: 11px; text-decoration:none; }

.cat-badge {
  font-size: 11px;
  font-weight: 700;
  padding: 3px 8px;
  border-radius: 4px;
  display: inline-block;
}
.cat-badge.tech { background:#EFF6FF; color:#1D4ED8; }
.cat-badge.pharmacy { background:#ECFDF5; color:#047857; }
.cat-badge.research { background:#F5F3FF; color:#6D28D9; }
.cat-badge.career { background:#FEF3C7; color:#B45309; }
.cat-badge.default { background:#F1F5F9; color:#475569; }
</style>
</head>
<body>
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">

        <!-- Header Hero -->
        <div class="dash-blog-hero mt-3">
          <div>
            <h2 class="dash-blog-title"><i class="fa fa-rss"></i> Research, Academic &amp; Tech Blogs Manager</h2>
            <p class="dash-blog-sub">Publish monthly blog articles, manage categories, author attributions, publication dates, and featured hero insights.</p>
          </div>
          <div>
            <?php if ($action == 'add' || $action == 'edit'): ?>
              <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-outline-light mr-1"><i class="fa fa-arrow-left"></i> Back to Blog List</a>
            <?php else: ?>
              <a href="<?php echo PAGE; ?>?action=add" class="btn btn-sm btn-warning font-weight-bold mr-1" style="background:#FFC107;color:#0A1B54;border:none;">
                <i class="fa fa-plus-circle"></i> + Add New Blog Post
              </a>
            <?php endif; ?>
            <a href="../blogs.php" target="_blank" class="btn btn-sm btn-outline-light mr-1">
              <i class="fa fa-external-link-alt"></i> Live Blogs Page
            </a>
            <a href="student_publications.php" class="btn btn-sm btn-outline-light">
              <i class="fa fa-book"></i> Student &amp; Publications
            </a>
          </div>
        </div>

        <!-- Alerts -->
        <?php if (!empty($stat['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle"></i> <?php echo $stat['success']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>
        <?php if (!empty($stat['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle"></i> <?php echo $stat['error']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>

        <!-- KPI Summary Cards (List view only) -->
        <?php if ($action != 'add' && $action != 'edit'): ?>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon navy">
                <i class="fa fa-newspaper"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $totalBlogs; ?></div>
                <div class="kpi-mini-label">Total Blog Articles</div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon green">
                <i class="fa fa-check-circle"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $activeBlogs; ?></div>
                <div class="kpi-mini-label">Active &amp; Published</div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon gold">
                <i class="fa fa-star"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $featuredCount; ?> Active</div>
                <div class="kpi-mini-label">Hero Spotlight Story</div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="kpi-mini-box">
              <div class="kpi-mini-icon purple">
                <i class="fa fa-tags"></i>
              </div>
              <div>
                <div class="kpi-mini-num"><?php echo $catCount; ?> Topics</div>
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
                  <h4 class="card-title mb-0 text-white" style="font-size:16px;">
                    <i class="fa fa-edit"></i> <?php echo $formTitle; ?>
                  </h4>
                  <small class="text-muted">Fill out the details below to publish or update an article on the university blog portal.</small>
                </div>
                <div>
                  <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-secondary">
                    <i class="fa fa-times"></i> Cancel
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
                      <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($editRow['title'] ?? ''); ?>" placeholder="e.g. Advancements in Machine Learning for Drug Discovery" required>
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
                        foreach ($catOptions as $k => $v):
                        ?>
                          <option value="<?php echo $k; ?>" <?php echo ($currCat == $k) ? 'selected' : ''; ?>><?php echo $v; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Row 1B: Custom URL Slug & Permalinks -->
                <div class="row">
                  <div class="col-12">
                    <div class="form-group mb-3">
                      <label class="font-weight-bold text-dark d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-link text-primary mr-1"></i> Custom Article URL Slug <span class="text-danger">*</span></span>
                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="generateSlugFromTitle()" style="font-size:11px;padding:2px 8px;">
                          <i class="fa fa-magic"></i> Auto-Generate from Title
                        </button>
                      </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-light text-muted font-weight-bold" style="font-size:13px;"><?php echo URL_ROOT; ?>blog/</span>
                        </div>
                        <input type="text" name="slug" id="slugInput" class="form-control font-weight-bold text-primary" value="<?php echo htmlspecialchars($editRow['slug'] ?? ''); ?>" placeholder="custom-blog-url-slug" oninput="syncSlugPreview(this.value)" required>
                      </div>
                      <small class="text-muted d-block mt-1">
                        Define custom public URL for this article. Only lowercase letters, numbers, and dashes. Live preview: <code><?php echo URL_ROOT; ?>blog/<span id="slugPreviewText"><?php echo htmlspecialchars($editRow['slug'] ?? 'custom-blog-url-slug'); ?></span></code>
                      </small>
                    </div>
                  </div>
                </div>

                <!-- Row 2: Category Name, Author & Publication Date -->
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Category Display Label</label>
                      <input type="text" name="category_name" id="catNameInp" class="form-control" value="<?php echo htmlspecialchars($editRow['category_name'] ?? 'AI & Tech'); ?>" placeholder="e.g. AI & Tech">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Author Name <span class="text-danger">*</span></label>
                      <input type="text" name="author_name" class="form-control" value="<?php echo htmlspecialchars($editRow['author_name'] ?? 'Faculty Contributor'); ?>" placeholder="e.g. Dr. A. K. Sharma" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Author Designation / Dept</label>
                      <input type="text" name="author_role" class="form-control" value="<?php echo htmlspecialchars($editRow['author_role'] ?? ''); ?>" placeholder="e.g. Dept. of Computer Science">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Publish Date / Month <span class="text-danger">*</span></label>
                      <input type="date" name="publish_date" class="form-control" value="<?php echo htmlspecialchars($editRow['publish_date'] ?? date('Y-m-d')); ?>" required>
                    </div>
                  </div>
                </div>

                <!-- Row 3: Read Time, Tags, Featured, Status -->
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Estimated Read Time</label>
                      <input type="text" name="read_time" class="form-control" value="<?php echo htmlspecialchars($editRow['read_time'] ?? '5 min read'); ?>" placeholder="e.g. 5 min read">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Tags (Comma-separated)</label>
                      <input type="text" name="tags" class="form-control" value="<?php echo htmlspecialchars($editRow['tags'] ?? ''); ?>" placeholder="e.g. CloudComputing, EdgeAI, IoT">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Featured Hero Spotlight?</label>
                      <select name="is_featured" class="form-control">
                        <option value="0" <?php echo (empty($editRow['is_featured'])) ? 'selected' : ''; ?>>No — Regular Grid Post</option>
                        <option value="1" <?php echo (!empty($editRow['is_featured']) && $editRow['is_featured'] == 1) ? 'selected' : ''; ?>>★ Yes — Pinned Hero Article</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Publishing Status</label>
                      <select name="status" class="form-control">
                        <option value="1" <?php echo (!isset($editRow['status']) || $editRow['status'] == 1) ? 'selected' : ''; ?>>Active (Published)</option>
                        <option value="0" <?php echo (isset($editRow['status']) && $editRow['status'] == 0) ? 'selected' : ''; ?>>Draft (Hidden)</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Row 4: Image Upload -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="font-weight-bold text-dark">Upload Cover / Featured Image</label>
                      <input type="file" name="image_file" class="form-control" accept="image/*">
                      <small class="text-muted">Supported formats: JPG, PNG, WEBP (Optional).</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <?php if ($isEdit && !empty($editRow['image'])): ?>
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Current Image Preview</label>
                        <div class="d-flex align-items-center gap-3">
                          <img src="../<?php echo htmlspecialchars($editRow['image']); ?>" alt="Cover" style="height:45px;border-radius:6px;border:1px solid #CBD5E1;">
                          <small class="text-muted ml-2"><code><?php echo htmlspecialchars($editRow['image']); ?></code></small>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Row 5: Summary / Excerpt -->
                <div class="form-group">
                  <label class="font-weight-bold text-dark">Article Excerpt / Short Summary <span class="text-danger">*</span></label>
                  <textarea name="summary" class="form-control" rows="3" placeholder="Brief 2-3 sentence overview displayed on the blog card..." oninput="updateSerpPreview()" required><?php echo htmlspecialchars($editRow['summary'] ?? ''); ?></textarea>
                </div>

                <!-- Row 6: Full Article Content -->
                <div class="form-group">
                  <label class="font-weight-bold text-dark">Full Article Narrative &amp; Content (HTML supported) <span class="text-danger">*</span></label>
                  <textarea name="content" class="form-control" rows="10" placeholder="Write full article body. Paragraphs with <p>...</p>, headings with <h4>...</h4> etc. are fully supported." required><?php echo htmlspecialchars($editRow['content'] ?? ''); ?></textarea>
                </div>

                <!-- Row 7: SEO Meta & Search Engine Optimization Card -->
                <div class="card border mb-4" style="background:#F8FAFC;border-radius:8px;border-color:#E2E8F0 !important;">
                  <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center" style="border-top-left-radius:8px;border-top-right-radius:8px;">
                    <div>
                      <h6 class="font-weight-bold mb-0 text-dark">
                        <i class="fa fa-search text-success mr-1"></i> Search Engine Optimization (SEO) &amp; Meta Settings
                      </h6>
                      <small class="text-muted">Customize how this blog post appears on Google Search, LinkedIn, Facebook, and Twitter.</small>
                    </div>
                    <span class="badge badge-success px-2 py-1"><i class="fa fa-google mr-1"></i> Google SERP Preview</span>
                  </div>
                  <div class="card-body p-4">
                    <!-- Live Google Search Preview Box -->
                    <div class="p-3 mb-4 rounded border bg-white shadow-sm" style="max-width: 680px; font-family: Arial, sans-serif;">
                      <div class="d-flex align-items-center mb-1">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2" style="width:26px;height:26px;border:1px solid #e2e8f0;">
                          <i class="fa fa-globe text-primary" style="font-size:13px;"></i>
                        </div>
                        <div style="font-size: 13px; color: #202124; line-height: 1.2;">
                          <div style="font-size: 12px; color: #202124;">bhabhauniversity.edu.in</div>
                          <div style="font-size: 11px; color: #5f6368;" id="serpUrlPreview"><?php echo URL_ROOT; ?>blog/<?php echo htmlspecialchars($editRow['slug'] ?? 'custom-article-slug'); ?></div>
                        </div>
                      </div>
                      <h4 id="serpTitlePreview" style="color: #1a0dab; font-size: 18px; margin: 4px 0 3px; cursor: pointer; text-decoration: none; font-weight: normal; font-family: Arial, sans-serif; line-height: 1.3;">
                        <?php echo htmlspecialchars(!empty($editRow['meta_title']) ? $editRow['meta_title'] : (!empty($editRow['title']) ? $editRow['title'] . ' | Bhabha University Blog' : 'Article Title | Bhabha University Blog')); ?>
                      </h4>
                      <p id="serpDescPreview" style="color: #4d5156; font-size: 13px; line-height: 1.45; margin: 0;">
                        <?php echo htmlspecialchars(!empty($editRow['meta_description']) ? $editRow['meta_description'] : (!empty($editRow['summary']) ? $editRow['summary'] : 'Article summary and search engine snippet will appear here...')); ?>
                      </p>
                    </div>

                    <!-- SEO Inputs -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="font-weight-bold text-dark d-flex justify-content-between">
                            <span>SEO Meta Title</span>
                            <span class="small text-muted font-weight-normal" id="metaTitleCount">0/70 chars (recommended)</span>
                          </label>
                          <input type="text" name="meta_title" id="metaTitleInp" class="form-control" maxlength="150" value="<?php echo htmlspecialchars($editRow['meta_title'] ?? ''); ?>" placeholder="e.g. Advancements in Machine Learning for Drug Discovery | Bhabha University" oninput="updateSerpPreview()">
                          <small class="text-muted">Target length: 50-60 chars. If left blank, article title will be used automatically.</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="font-weight-bold text-dark">SEO Focus Keywords</label>
                          <input type="text" name="meta_keywords" id="metaKeywordsInp" class="form-control" value="<?php echo htmlspecialchars($editRow['meta_keywords'] ?? ''); ?>" placeholder="e.g. Machine Learning, Pharmacy AI, Drug Discovery Research, Bhabha University Bhopal">
                          <small class="text-muted">Comma-separated focus search keywords for indexing.</small>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group mb-0">
                          <label class="font-weight-bold text-dark d-flex justify-content-between">
                            <span>SEO Meta Description</span>
                            <span class="small text-muted font-weight-normal" id="metaDescCount">0/160 chars (recommended)</span>
                          </label>
                          <textarea name="meta_description" id="metaDescInp" class="form-control" rows="3" maxlength="300" placeholder="Concise summary (150-160 characters) providing a compelling hook for search engine users to click your link..." oninput="updateSerpPreview()"><?php echo htmlspecialchars($editRow['meta_description'] ?? ''); ?></textarea>
                          <small class="text-muted">Target length: 140-160 chars. If left blank, article excerpt will be used automatically.</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                  <a href="<?php echo PAGE; ?>" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Cancel
                  </a>
                  <button type="submit" name="submit" class="btn btn-primary px-4 font-weight-bold" style="background:#0A1B54;border-color:#0A1B54;">
                    <i class="fa fa-check"></i> <?php echo $isEdit ? 'Update Article' : 'Publish Article'; ?>
                  </button>
                </div>

              </form>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- ======================================================== -->
        <!-- VIEW 2: LIST VIEW (DEFAULT)                              -->
        <!-- ======================================================== -->
        <?php if ($action != 'add' && $action != 'edit'): 
          $allBlogs = $db->orderBy('is_featured', 'DESC')->orderBy('publish_date', 'DESC')->get(DBTAB);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card-section-box">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h5 class="font-weight-bold mb-1" style="color:#0A1B54;">
                    <i class="fa fa-list"></i> All Published Blog Posts &amp; Insights
                  </h5>
                  <small class="text-muted">Articles are ordered by publication month, with pinned hero insights displayed on top.</small>
                </div>
                <a href="<?php echo PAGE; ?>?action=add" class="btn btn-success btn-sm font-weight-bold shadow-sm">
                  <i class="fa fa-plus-circle"></i> + Add New Blog Post
                </a>
              </div>

              <div class="table-responsive">
                <table id="datatable" class="table table-hover table-bordered mb-0">
                  <thead class="thead-light">
                    <tr>
                      <th width="40">#</th>
                      <th>Article Title &amp; Excerpt</th>
                      <th width="140">Category</th>
                      <th width="160">Author</th>
                      <th width="120">Publish Date</th>
                      <th width="90">Read Time</th>
                      <th width="100" class="text-center">Spotlight</th>
                      <th width="90" class="text-center">Status</th>
                      <th width="140" class="text-center">Actions</th>
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
                      <td><?php echo $sn++; ?></td>
                      <td>
                        <div class="d-flex align-items-center" style="gap:14px;">
                          <?php if (!empty($row['image'])): ?>
                            <img src="../<?php echo htmlspecialchars($row['image']); ?>" alt="Cover" style="width:58px;height:44px;object-fit:cover;border-radius:6px;border:1px solid #CBD5E1;flex-shrink:0;">
                          <?php endif; ?>
                          <div>
                            <div class="font-weight-bold" style="color:#0A1B54;font-size:14px;">
                              <?php echo htmlspecialchars($row['title']); ?>
                            </div>
                            <a href="<?php echo URL_ROOT; ?>blog/<?php echo htmlspecialchars($row['slug']); ?>" target="_blank" class="badge badge-light border text-primary mt-1" style="font-size:11px;text-decoration:none;" title="Open live clean URL">
                              <i class="fa fa-link text-muted mr-1"></i>/blog/<?php echo htmlspecialchars($row['slug']); ?> <i class="fa fa-external-link text-muted ml-1" style="font-size:9px;"></i>
                            </a>
                            <small class="text-muted d-block mt-1" style="line-height:1.4;">
                              <?php echo htmlspecialchars(mb_strimwidth($row['summary'], 0, 110, '...')); ?>
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
                        <div class="font-weight-bold small text-dark">
                          <i class="fa fa-user-circle-o text-muted mr-1"></i><?php echo htmlspecialchars($row['author_name']); ?>
                        </div>
                        <?php if (!empty($row['author_role'])): ?>
                          <small class="text-muted d-block"><?php echo htmlspecialchars($row['author_role']); ?></small>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div class="small font-weight-bold text-dark"><?php echo $pubDateFormatted; ?></div>
                        <small class="text-muted"><?php echo date('F Y', strtotime($row['publish_date'])); ?></small>
                      </td>
                      <td>
                        <small class="text-muted font-weight-bold"><i class="fa fa-clock"></i> <?php echo htmlspecialchars($row['read_time'] ?: '5 min'); ?></small>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo PAGE; ?>?action=toggle_featured&id=<?php echo $row['id']; ?>" title="Click to toggle hero spotlight">
                          <?php if ($row['is_featured'] == 1): ?>
                            <span class="badge-feat-yes"><i class="fa fa-star"></i> Featured</span>
                          <?php else: ?>
                            <span class="badge-feat-no"><i class="fa fa-star" style="opacity:0.4;"></i> Standard</span>
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
                      <td class="text-center" style="white-space: nowrap;">
                        <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning mr-1" style="background:#D97706;border-color:#D97706;color:#ffffff;font-weight:600;" title="Edit Article">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?php echo PAGE; ?>?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog post?');" class="btn btn-sm btn-outline-danger mr-1" style="font-weight:600;" title="Delete Article">
                          <i class="fa fa-trash-alt"></i> Delete
                        </a>
                        <a href="<?php echo URL_ROOT; ?>blog/<?php echo htmlspecialchars($row['slug']); ?>" target="_blank" class="btn btn-sm btn-outline-info" style="font-weight:600;" title="View Live Blog">
                          <i class="fa fa-eye"></i> View
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.js.php"); ?>
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
  if ($('#datatable').length) {
    $('#datatable').DataTable({
      "pageLength": 10,
      "ordering": false,
      "language": {
        "search": "Search articles:"
      }
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

function makeSlugJs(str) {
  return str.toLowerCase()
    .trim()
    .replace(/[^a-z0-9 -]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-');
}

function generateSlugFromTitle() {
  var titleInp = document.querySelector('input[name="title"]');
  var slugInp = document.getElementById('slugInput');
  if (titleInp && slugInp && titleInp.value.trim() !== '') {
    slugInp.value = makeSlugJs(titleInp.value);
    syncSlugPreview(slugInp.value);
    updateSerpPreview();
  }
}

// Auto-populate slug when typing title on Add mode
var titleField = document.querySelector('input[name="title"]');
if (titleField) {
  titleField.addEventListener('input', function() {
    var slugInp = document.getElementById('slugInput');
    <?php if ($action == 'add'): ?>
    if (slugInp && (!slugInp.dataset.userEdited || slugInp.value === '')) {
      slugInp.value = makeSlugJs(this.value);
      syncSlugPreview(slugInp.value);
    }
    <?php endif; ?>
    updateSerpPreview();
  });
}

var slugField = document.getElementById('slugInput');
if (slugField) {
  slugField.addEventListener('input', function() {
    this.dataset.userEdited = "true";
    syncSlugPreview(this.value);
  });
}

function syncSlugPreview(val) {
  var clean = makeSlugJs(val);
  var previewSpan = document.getElementById('slugPreviewText');
  var serpUrl = document.getElementById('serpUrlPreview');
  var rootUrl = '<?php echo URL_ROOT; ?>blog/';
  if (previewSpan) {
    previewSpan.innerText = clean || 'custom-article-slug';
  }
  if (serpUrl) {
    serpUrl.innerText = rootUrl + (clean || 'custom-article-slug');
  }
}

function updateSerpPreview() {
  var titleInp = document.querySelector('input[name="title"]');
  var metaTitleInp = document.getElementById('metaTitleInp');
  var serpTitle = document.getElementById('serpTitlePreview');
  var metaTitleCount = document.getElementById('metaTitleCount');

  var descInp = document.querySelector('textarea[name="summary"]');
  var metaDescInp = document.getElementById('metaDescInp');
  var serpDesc = document.getElementById('serpDescPreview');
  var metaDescCount = document.getElementById('metaDescCount');

  // Title preview
  var finalTitle = '';
  if (metaTitleInp && metaTitleInp.value.trim() !== '') {
    finalTitle = metaTitleInp.value;
    if (metaTitleCount) metaTitleCount.innerText = metaTitleInp.value.length + '/70 chars';
  } else if (titleInp && titleInp.value.trim() !== '') {
    finalTitle = titleInp.value + ' | Bhabha University Blog';
    if (metaTitleCount) metaTitleCount.innerText = 'Auto: ' + finalTitle.length + ' chars';
  } else {
    finalTitle = 'Article Title | Bhabha University Blog';
    if (metaTitleCount) metaTitleCount.innerText = '0/70 chars (recommended)';
  }
  if (serpTitle) serpTitle.innerText = finalTitle;

  // Description preview
  var finalDesc = '';
  if (metaDescInp && metaDescInp.value.trim() !== '') {
    finalDesc = metaDescInp.value;
    if (metaDescCount) metaDescCount.innerText = metaDescInp.value.length + '/160 chars';
  } else if (descInp && descInp.value.trim() !== '') {
    finalDesc = descInp.value;
    if (metaDescCount) metaDescCount.innerText = 'Auto: ' + descInp.value.length + ' chars';
  } else {
    finalDesc = 'Article summary and search engine snippet will appear here...';
    if (metaDescCount) metaDescCount.innerText = '0/160 chars (recommended)';
  }
  if (serpDesc) serpDesc.innerText = finalDesc;
}

$(document).ready(function() {
  if (document.getElementById('metaTitleInp')) {
    updateSerpPreview();
  }
});
</script>
</body>
</html>
