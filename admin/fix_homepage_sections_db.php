<?php
/**
 * Bhabha University - Admin Database Fix & Sync Utility for Homepage Sections
 * Accessible directly by logged-in admin or to repair table on production.
 */
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');
require_once('inc.homepage_sections_schema.php');

$result = null;
$error = null;

try {
    $result = bu_ensure_homepage_sections_schema($db);
    $allRows = $db->get('homepage_sections');
} catch (\Throwable $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Homepage Sections Database Sync - Admin Panel</title>
<?php include_once("inc.meta.php"); ?>
<style>
.sync-card {
    background: #fff;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    margin-top: 20px;
}
.sync-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
}
.sync-badge-ok {
    background: #d4edda;
    color: #155724;
}
.sync-badge-warn {
    background: #fff3cd;
    color: #856404;
}
.sync-badge-err {
    background: #f8d7da;
    color: #721c24;
}
</style>
</head>
<body>
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><i class="mdi mdi-database-check"></i> Homepage Sections Database Synchronizer</h4>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="sync-card">
              <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                  <h5><i class="fa fa-exclamation-triangle"></i> Database Error Encountered</h5>
                  <p><?php echo htmlspecialchars($error); ?></p>
                </div>
              <?php else: ?>
                <div class="alert alert-success">
                  <h5><i class="fa fa-check-circle"></i> Database Synced Successfully!</h5>
                  <p class="mb-0">Table <code>homepage_sections</code> is verified and active on the database.</p>
                </div>
              <?php endif; ?>
              
              <div class="row mt-4">
                <div class="col-md-4 mb-3">
                  <div class="card border p-3 text-center">
                    <small class="text-muted">Table Status</small>
                    <h5 class="mt-2 mb-0">
                      <?php if ($result && $result['table_created']): ?>
                        <span class="sync-badge sync-badge-warn">Created Fresh</span>
                      <?php else: ?>
                        <span class="sync-badge sync-badge-ok">Active &amp; Ready</span>
                      <?php endif; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="card border p-3 text-center">
                    <small class="text-muted">Rows Seeded</small>
                    <h5 class="mt-2 mb-0">
                      <span class="sync-badge sync-badge-ok"><?php echo is_array($allRows) ? count($allRows) : 0; ?> / 14 Sections</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="card border p-3 text-center">
                    <small class="text-muted">New Columns Added</small>
                    <h5 class="mt-2 mb-0">
                      <span class="sync-badge sync-badge-ok"><?php echo $result['cols_added'] ?? 0; ?> Added</span>
                    </h5>
                  </div>
                </div>
              </div>
              
              <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                <a href="homepage_sections.php" class="btn btn-primary btn-lg">
                  <i class="fa fa-arrow-left"></i> Go to Homepage Sections Manager
                </a>
                <a href="fix_homepage_sections_db.php" class="btn btn-outline-secondary">
                  <i class="fa fa-refresh"></i> Re-Run Diagnostics
                </a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
</body>
</html>
