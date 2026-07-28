<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Art Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for BA Economics, English, Political Science, Sociology, and Foundation Courses at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-back-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #0A1B54;
  color: #FFC107;
  font-weight: 700;
  font-size: 13px;
  padding: 10px 20px;
  border-radius: 6px;
  text-decoration: none;
  margin-bottom: 24px;
  transition: all 0.2s ease;
}
.bu-back-btn:hover {
  background: #061D7C;
  color: #ffffff;
  text-decoration: none;
}

.bu-search-filter-box {
  position: relative;
  margin: 20px 0 28px;
}
.bu-search-input {
  width: 100%;
  padding: 14px 20px 14px 48px;
  font-size: 15px;
  border: 1px solid #D1D5DB;
  border-radius: 8px;
  background: #F8FAFC;
  color: #1E293B;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-search-input:focus {
  outline: none;
  border-color: #0A1B54;
  background: #ffffff;
  box-shadow: 0 0 0 4px rgba(10,27,84,0.1);
}
.bu-search-icon {
  position: absolute;
  left: 18px;
  top: 50%;
  transform: translateY(-50%);
  color: #64748B;
  font-size: 16px;
}

.bu-qp-table-wrap {
  overflow-x: auto;
}
.bu-qp-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(6,29,124,0.05);
  background: #ffffff;
}
.bu-qp-table th {
  background: #0A1B54;
  color: #FFC107;
  font-weight: 700;
  padding: 14px 20px;
  text-align: left;
  font-size: 13.5px;
  text-transform: uppercase;
  letter-spacing: 0.6px;
}
.bu-qp-table td {
  padding: 14px 20px;
  border-bottom: 1px solid #E2E8F0;
  color: #334155;
}
.bu-qp-table tr.bu-qp-section-row td {
  background: #F1F5F9;
  color: #0A1B54;
  font-weight: 800;
  font-size: 15px;
  border-left: 4px solid #FFC107;
}
.bu-qp-table tr:hover:not(.bu-qp-section-row) {
  background: #F8FAFC;
}

.bu-paper-code {
  font-weight: 700;
  color: #061D7C;
}

.bu-dl-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(10,27,84,0.08);
  color: #061D7C;
  font-weight: 700;
  font-size: 12.5px;
  padding: 8px 16px;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.2s ease;
}
.bu-dl-link:hover {
  background: #0A1B54;
  color: #FFC107;
  text-decoration: none;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Art <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for Bachelor of Arts (BA) courses.';
  $page_icon     = 'fa-paint-brush';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Art',             'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Department of Humanities &amp; Social Sciences</span>
        <h2 class="bu-content-h2">Art <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, subject name, or exam session (e.g., BAE-301, Sociology, 2021)..." onkeyup="filterPapers()">
        </div>

        <div class="bu-qp-table-wrap">
          <table class="bu-qp-table" id="paperTable">
            <thead>
              <tr>
                <th>Session / Exam Period</th>
                <th>Subject Name / Paper Code</th>
                <th>Download Link</th>
              </tr>
            </thead>
            <tbody>
              <!-- Section: B.A. Economics-IIIrd Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-book" style="margin-right:8px;"></i> B.A. Economics - IIIrd Year</td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAE-301 (I)</span> — Economics Paper I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/1524542df8922395e3f2e330e93dda57.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAE-301 (II)</span> — Economics Paper II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e36dba173d02185b1a0d52c309c6f643.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.A. English-IIIrd Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-book" style="margin-right:8px;"></i> B.A. English - IIIrd Year</td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAEL-301 (I)</span> — English Literature Paper I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/5bc5d89197f2f219abc657a67a61ec8c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAE-301 (II)</span> — English Literature Paper II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/063771a972980278a98212785942b3a8.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.A. Political Science-IIIrd Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-book" style="margin-right:8px;"></i> B.A. Political Science - IIIrd Year</td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAP-301 (I)</span> — Political Science Paper I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/df4c08927df2f5642c7dee1ea6068923.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAP-301 (II)</span> — Political Science Paper II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/15c468143132e86da5f7828cbc7b61e8.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.A. Sociology-IIIrd Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-book" style="margin-right:8px;"></i> B.A. Sociology - IIIrd Year</td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAS-301 (I)</span> — Sociology Paper I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/5724a65dcfa0f80c0365cd4647179059.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BAS-301 (II)</span> — Sociology Paper II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c6c7583d336144c1f24d7ce99a0ca658.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.A. Ist Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-book" style="margin-right:8px;"></i> B.A. Ist Year</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BAE-101</span> — Microeconomics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f6d2301d6c984bd9e380fd349725ab93.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BAE-102</span> — Indian Economics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/fd2fd7f63bf1c0fecd802543b03d3716.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BAP-101</span> — Political Science Paper I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/459bac15ea4c44897bf05775a85c9368.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BAP-102</span> — Political Science Paper II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/26192f1d0e8ef22c753cb29e389747e3.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BAS-101</span> — Sociology</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e8a79cac732baf6e28b7126e20490dd7.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BAS-102</span> — Indian Society</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ea2b998c9c1722cbb6cdb585960c9e54.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">FC-101</span> — Foundation Course I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/333e7732704b083c9a346bc82199af42.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">FC-102</span> — Foundation Course II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/db34629581255c826148a130cab9c6f0.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">FC-103</span> — Foundation Course III</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/053a0fb12b56b6fb247b23b1e1a6e05e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>

<script>
function filterPapers() {
  var input = document.getElementById("paperSearchInput");
  var filter = input.value.toLowerCase();
  var rows = document.querySelectorAll("#paperTable tbody tr.paper-item");
  
  rows.forEach(function(row) {
    var text = row.innerText.toLowerCase();
    if (text.indexOf(filter) > -1) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}
</script>
</body>
</html>
