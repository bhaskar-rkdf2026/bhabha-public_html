<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
define("PAGE", 'academic.php');
define("TITLE", 'Academic Calendar & Settings');
define("DBTAB", 'academic');

// -----------------------------------------------------------------------------
// AJAX UPLOAD HANDLER
// -----------------------------------------------------------------------------
if (isset($_GET['action']) && $_GET['action'] == 'ajax_upload') {
    header('Content-Type: application/json');
    if (!empty($_FILES['ajax_doc']['name'])) {
        $file = $_FILES['ajax_doc'];
        $title = trim($_POST['doc_title'] ?? '') ?: pathinfo($file['name'], PATHINFO_FILENAME);
        $allowed_ext = array('pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx');
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (in_array($ext, $allowed_ext)) {
            $new_filename = md5(uniqid(rand(), true)) . '.' . $ext;
            $target_dir = PATH_ROOT . DS . '..' . DS . 'upload' . DS . 'media' . DS;
            if (!is_dir($target_dir)) {
                @mkdir($target_dir, 0777, true);
            }
            $target_path = $target_dir . $new_filename;

            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                $file_url = URL_UPLOAD . 'media/' . $new_filename;
                echo json_encode([
                    'status' => 'success',
                    'filename' => $new_filename,
                    'url' => $file_url,
                    'title' => $title,
                    'message' => 'Document uploaded successfully!'
                ]);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file on server.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Allowed: PDF, JPG, PNG, DOCX.']);
            exit;
        }
    }
    echo json_encode(['status' => 'error', 'message' => 'No file was uploaded.']);
    exit;
}

// -----------------------------------------------------------------------------
// STANDARD FORM UPLOAD HANDLER (Non-AJAX Fallback)
// -----------------------------------------------------------------------------
$uploaded_file_info = null;
if (isset($_POST['upload_pdf_btn']) && !empty($_FILES['academic_doc']['name'])) {
    $file = $_FILES['academic_doc'];
    $doc_title = trim($_POST['manual_doc_title'] ?? '') ?: 'Academic & Activities Calendar';
    $allowed_ext = array('pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx');
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (in_array($ext, $allowed_ext)) {
        $new_filename = md5(uniqid(rand(), true)) . '.' . $ext;
        $target_dir = PATH_ROOT . DS . '..' . DS . 'upload' . DS . 'media' . DS;
        if (!is_dir($target_dir)) {
            @mkdir($target_dir, 0777, true);
        }
        $target_path = $target_dir . $new_filename;

        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            $uploaded_url = URL_UPLOAD . 'media/' . $new_filename;
            $stat['success'] = "Document uploaded successfully! File URL: " . $uploaded_url;
            $uploaded_file_info = [
                'name' => $file['name'],
                'title' => $doc_title,
                'filename' => $new_filename,
                'url' => $uploaded_url
            ];
        } else {
            $stat['error'] = "Failed to upload document to server.";
        }
    } else {
        $stat['error'] = "Invalid file type. Allowed formats: PDF, JPG, PNG, DOCX.";
    }
}

// -----------------------------------------------------------------------------
// SAVE / UPDATE SETTINGS HANDLER
// -----------------------------------------------------------------------------
if (isset($_POST['submit'])) {
    foreach ($_POST as $field => $value) {
        if ($field == 'submit' || $field == 'upload_pdf_btn' || $field == 'manual_doc_title') continue;
        
        $data = array('value' => $value);
        $db->where('field', $field);
        $existing = $db->getOne(DBTAB);
        
        if ($existing) {
            $db->where('field', $field);
            $db->update(DBTAB, $data);
        } else {
            $db->insert(DBTAB, array('field' => $field, 'value' => $value));
        }
    }
    $stat['success'] = 'Academic Settings updated successfully! Changes are live on the website.';
}

// Fetch Current Settings
$aryForm = array();
$db->where('field', array('about_title', 'content'), 'IN');
$aryFormTemp = $db->get(DBTAB);
if (!is_null($aryFormTemp) && is_array($aryFormTemp) && count($aryFormTemp) > 0) {
    foreach ($aryFormTemp as $iFormTemp) {
        $aryForm[$iFormTemp['field']] = $iFormTemp['value'];
    }
}
$about_title = $aryForm['about_title'] ?? '';
$content     = $aryForm['content'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Bhabha University Admin</title>
<?php include_once("inc.meta.php"); ?>
<style>
/* ==========================================================================
   Bhabha University Executive Academic Settings Theme
   ========================================================================== */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #061442;
  --bu-navy-light: #1E3A8A;
  --bu-gold: #D99B00;
  --bu-gold-light: #FEF3C7;
  --bu-border: #E2E8F0;
  --bu-bg-soft: #F8FAFC;
  --bu-text-dark: #0F172A;
  --bu-text-muted: #64748B;
}

/* Header & Stat Badges */
.bu-admin-header-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 20px 24px;
  margin-bottom: 22px;
  box-shadow: 0 4px 15px rgba(10, 27, 84, 0.04);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
}
.bu-admin-header-title h4 {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 22px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 5px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-admin-header-title p {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  margin: 0;
}
.bu-live-btn {
  background: rgba(10, 27, 84, 0.06);
  color: var(--bu-navy) !important;
  border: 1px solid rgba(10, 27, 84, 0.15);
  font-size: 13.5px;
  font-weight: 700;
  padding: 8px 18px;
  border-radius: 8px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none !important;
  transition: all 0.2s;
}
.bu-live-btn:hover {
  background: var(--bu-navy);
  color: #FFC107 !important;
}

/* Cards & Forms */
.bu-settings-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid var(--bu-border);
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 4px 15px rgba(10, 27, 84, 0.03);
}
.bu-card-title {
  font-size: 16px;
  font-weight: 800;
  color: var(--bu-navy);
  margin-bottom: 18px;
  padding-bottom: 12px;
  border-bottom: 2px solid var(--bu-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
}
.bu-card-title span {
  display: flex;
  align-items: center;
  gap: 8px;
}

.bu-btn-primary {
  background: linear-gradient(135deg, var(--bu-navy) 0%, var(--bu-navy-dark) 100%);
  color: #ffffff !important;
  font-weight: 700;
  border: none;
  border-radius: 8px;
  padding: 11px 26px;
  font-size: 14px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: all 0.2s;
  box-shadow: 0 4px 10px rgba(10, 27, 84, 0.2);
  cursor: pointer;
}
.bu-btn-primary:hover {
  background: linear-gradient(135deg, var(--bu-navy-light) 0%, var(--bu-navy) 100%);
  transform: translateY(-1px);
  box-shadow: 0 6px 14px rgba(10, 27, 84, 0.3);
}

.bu-btn-gold {
  background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
  color: #ffffff !important;
  font-weight: 700;
  border: none;
  border-radius: 8px;
  padding: 10px 18px;
  font-size: 13.5px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  transition: all 0.2s;
}
.bu-btn-gold:hover {
  background: linear-gradient(135deg, #D97706 0%, #B45309 100%);
  transform: translateY(-1px);
}

/* Quick Action Box */
.bu-upload-box {
  background: #F8FAFC;
  border: 2px dashed #CBD5E1;
  border-radius: 10px;
  padding: 18px;
  transition: all 0.2s;
}
.bu-upload-box:hover {
  border-color: var(--bu-navy);
  background: #FFFFFF;
}
</style>
</head>
<body>
<!-- Begin page -->
<div id="wrapper"><!-- Top Bar Start -->
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page"><!-- Start content -->
    <div class="content">
      <div class="container-fluid">
        
        <!-- Header Banner Card -->
        <div class="bu-admin-header-card">
          <div class="bu-admin-header-title">
            <h4><i class="mdi mdi-calendar-clock" style="color:var(--bu-gold);"></i> <?php echo TITLE; ?></h4>
            <p>Manage official academic schedules, annual calendar PDFs, teaching timelines, and examination guidelines.</p>
          </div>
          <div>
            <a href="<?php echo URL_ROOT; ?>academic.php" target="_blank" class="bu-live-btn">
              <i class="mdi mdi-open-in-new" style="color:var(--bu-gold);"></i> View Live Academic Page
            </a>
          </div>
        </div>

        <?php if (!empty($stat)): ?>
          <div class="mb-3"><?php echo msg($stat); ?></div>
        <?php endif; ?>

        <div class="row">
          
          <!-- Main Content Settings Form -->
          <div class="col-lg-8">
            <div class="bu-settings-card">
              <div class="bu-card-title">
                <span><i class="mdi mdi-file-document-edit" style="color:var(--bu-gold);"></i> Academic Content &amp; Calendar Links</span>
                <small class="text-muted font-weight-normal font-12">Synced directly with frontend page</small>
              </div>

              <form action="" method="post" id="academicMainForm">
                <div class="form-group mb-3">
                  <label class="font-weight-bold text-dark"><i class="mdi mdi-format-title"></i> Page Subtitle / Tagline</label>
                  <input type="text" name="about_title" class="form-control" style="border-radius:8px;height:42px;" placeholder="e.g. Academic & Activities Calendar 2026 - 2027" value="<?php echo htmlspecialchars($about_title); ?>">
                  <small class="text-muted">Displayed on the frontend academic calendar hero banner.</small>
                </div>

                <div class="form-group mb-4">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="font-weight-bold text-dark mb-0"><i class="mdi mdi-calendar-multiselect"></i> Calendars &amp; Document List (HTML / Links)</label>
                    <small class="text-primary font-weight-bold">
                      <i class="mdi mdi-lightning-bolt"></i> Upload from right panel to auto-insert
                    </small>
                  </div>
                  <textarea name="content" id="academic_editor" class="form-control ckeditor" rows="9"><?php echo $content; ?></textarea>
                  <small class="text-muted mt-1 d-block">
                    <i class="mdi mdi-information-outline"></i> Tip: Har <code>&lt;a href="PDF_URL"&gt;Academic Calendar 2026-27&lt;/a&gt;</code> link frontend par automatically modern interactive download card me convert ho jata hai.
                  </small>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-2">
                  <button type="submit" name="submit" class="bu-btn-primary">
                    <i class="mdi mdi-content-save"></i> Save &amp; Publish Changes
                  </button>
                  <a href="<?php echo URL_ROOT; ?>academic.php" target="_blank" class="text-primary font-weight-bold font-13">
                    <i class="mdi mdi-eye"></i> Preview on Website
                  </a>
                </div>
              </form>
            </div>
          </div>

          <!-- Right Sidebar: Quick Document Uploader & Help -->
          <div class="col-lg-4">
            
            <!-- Quick PDF Upload & Instant Insert Widget -->
            <div class="bu-settings-card">
              <div class="bu-card-title">
                <span><i class="mdi mdi-cloud-upload" style="color:var(--bu-gold);"></i> Upload &amp; Insert Calendar</span>
              </div>
              <p class="text-muted font-13 mb-3">
                Select your calendar PDF/Document. It will automatically upload and insert directly into the text editor.
              </p>

              <form id="ajaxUploadForm" enctype="multipart/form-data" class="bu-upload-box mb-3">
                <div class="form-group mb-2">
                  <label class="font-weight-bold text-dark font-12 text-uppercase">Calendar Title / Session</label>
                  <input type="text" id="ajax_doc_title" class="form-control form-control-sm" placeholder="e.g. Academic Calendar 2026 - 27" value="Academic & Activities Calendar 2026 - 27">
                </div>

                <div class="form-group mb-3">
                  <label class="font-weight-bold text-dark font-12 text-uppercase">Choose PDF / Image</label>
                  <input type="file" id="ajax_doc_file" class="form-control-file p-1 border rounded bg-white" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                </div>

                <button type="button" id="ajaxUploadBtn" class="bu-btn-gold w-100 justify-content-center">
                  <i class="mdi mdi-plus-circle"></i> Upload &amp; Insert into Editor
                </button>
              </form>

              <!-- Upload Status / Alert Area -->
              <div id="uploadStatusArea"></div>

              <!-- Manual Fallback Upload Form -->
              <details class="mt-3">
                <summary class="font-12 text-muted font-weight-bold" style="cursor:pointer;">Alternative: Standard Form Upload</summary>
                <form action="" method="post" enctype="multipart/form-data" class="mt-2 p-2 bg-light rounded border">
                  <input type="text" name="manual_doc_title" class="form-control form-control-sm mb-2" placeholder="Title">
                  <input type="file" name="academic_doc" class="form-control-file mb-2 font-12" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                  <button type="submit" name="upload_pdf_btn" class="btn btn-sm btn-secondary w-100 font-weight-bold">Upload Document</button>
                </form>
              </details>

              <?php if (!empty($uploaded_file_info)): ?>
                <div class="mt-3 p-3 bg-light rounded border border-success">
                  <div class="font-weight-bold text-success font-13 mb-1"><i class="mdi mdi-check-circle"></i> File Ready:</div>
                  <div class="font-12 text-truncate mb-2 font-weight-bold"><?php echo htmlspecialchars($uploaded_file_info['name']); ?></div>
                  <input type="text" readonly class="form-control form-control-sm mb-2" id="uploaded_url_field" value="<?php echo htmlspecialchars($uploaded_file_info['url']); ?>">
                  <button type="button" class="btn btn-sm btn-primary w-100 font-weight-bold mb-1" onclick="insertLinkToEditor('<?php echo htmlspecialchars($uploaded_file_info['title']); ?>', '<?php echo htmlspecialchars($uploaded_file_info['url']); ?>')">
                    <i class="mdi mdi-plus-box"></i> Insert to Editor
                  </button>
                </div>
              <?php endif; ?>
            </div>

            <!-- Guidelines Card -->
            <div class="bu-settings-card">
              <div class="bu-card-title">
                <span><i class="mdi mdi-lightbulb-on" style="color:var(--bu-gold);"></i> How It Works</span>
              </div>
              <ul class="pl-3 font-13 text-muted" style="line-height:1.7;">
                <li><strong>1-Click Insert:</strong> Upload button file ko upload karke editor me automatically naya bullet link create kar deta hai.</li>
                <li><strong>Dynamic PDF Cards:</strong> Website frontend par har link automatic styled interactive card ban jata hai.</li>
                <li><strong>Top Active Session:</strong> Editor me jo sabse pehla link hoga, wo website ke top featured box aur Download button me set hoga.</li>
              </ul>
            </div>

          </div>

        </div>

      </div>
      <!-- container-fluid -->
    </div>
    <!-- content -->
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
<script>
function insertLinkToEditor(title, url) {
    var linkHtml = '<p><strong><a href="' + url + '" target="_blank"><span style="color:#FF0000">' + title + '</span></a></strong></p>\n';
    
    // Check CKEditor instance
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['academic_editor']) {
        var editor = CKEDITOR.instances['academic_editor'];
        var currentData = editor.getData();
        
        // If content has <ul>, prepend as <li> at the top
        if (currentData.indexOf('<ul>') !== -1) {
            var itemHtml = '<li><strong><a href="' + url + '" target="_blank"><span style="color:#FF0000">' + title + '</span></a></strong></li>';
            var newData = currentData.replace('<ul>', '<ul>\n\t' + itemHtml);
            editor.setData(newData);
        } else {
            editor.insertHtml(linkHtml);
        }
        return true;
    } else {
        var textarea = document.getElementById('academic_editor');
        if (textarea) {
            textarea.value = linkHtml + textarea.value;
            return true;
        }
    }
    return false;
}

$(document).ready(function() {
    $('#ajaxUploadBtn').on('click', function(e) {
        e.preventDefault();
        
        var fileInput = document.getElementById('ajax_doc_file');
        var docTitle = $('#ajax_doc_title').val().trim() || 'Academic Calendar';
        
        if (!fileInput.files || fileInput.files.length === 0) {
            alert('Please select a PDF or document file to upload.');
            return;
        }
        
        var formData = new FormData();
        formData.append('ajax_doc', fileInput.files[0]);
        formData.append('doc_title', docTitle);
        
        var $btn = $(this);
        var origText = $btn.html();
        $btn.html('<i class="mdi mdi-loading mdi-spin"></i> Uploading...').prop('disabled', true);
        
        $('#uploadStatusArea').html('<div class="alert alert-info py-2 font-12"><i class="mdi mdi-loading mdi-spin"></i> Uploading document to server...</div>');
        
        $.ajax({
            url: 'academic.php?action=ajax_upload',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(resp) {
                $btn.html(origText).prop('disabled', false);
                if (resp.status === 'success') {
                    // Insert into CKEditor
                    insertLinkToEditor(resp.title, resp.url);
                    
                    $('#uploadStatusArea').html(
                        '<div class="alert alert-success py-2 font-12 mb-2">' +
                        '  <strong><i class="mdi mdi-check-circle"></i> Uploaded &amp; Inserted!</strong><br>' +
                        '  Link text editor me add ho gaya hai. Ab niche <strong>Save &amp; Publish</strong> par click karein.' +
                        '</div>'
                    );
                    
                    // Reset file input
                    fileInput.value = '';
                } else {
                    $('#uploadStatusArea').html('<div class="alert alert-danger py-2 font-12"><i class="mdi mdi-alert"></i> ' + resp.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                $btn.html(origText).prop('disabled', false);
                $('#uploadStatusArea').html('<div class="alert alert-danger py-2 font-12"><i class="mdi mdi-alert"></i> Upload failed: ' + error + '</div>');
            }
        });
    });
});
</script>
</body>
</html>