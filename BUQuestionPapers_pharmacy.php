<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pharmacy Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for D.Pharm, B.Pharm, and M.Pharm programs at Bhabha University Bhopal.">
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
  margin-top: 30px;
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
  $page_title    = 'Pharmacy <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for D.Pharm, B.Pharm, and M.Pharm programs.';
  $page_icon     = 'fa-plus-square';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Pharmacy',        'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Faculty of Pharmacy</span>
        <h2 class="bu-content-h2">Pharmacy <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, course, or session (e.g., DP-101, BP-101, MPH-101T, MPL-101T)..." onkeyup="filterPapers()">
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
              <!-- Section: D.Pharm -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-plus-square" style="margin-right:8px;"></i> D.Pharm (Diploma in Pharmacy)</td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy IInd year / June 2021</td>
                <td><span class="bu-paper-code">DP-201</span> — D.Pharm 2nd Year Paper 201</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/4fdc59c05487eaae3512f2a0176006ab.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy IInd year / June 2021</td>
                <td><span class="bu-paper-code">DP-202</span> — D.Pharm 2nd Year Paper 202</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/5954f208f6a82c7e625a5b13398b7721.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy IInd year / June 2021</td>
                <td><span class="bu-paper-code">DP-203</span> — D.Pharm 2nd Year Paper 203</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/02be5efc8fbd0ebbe35c793c9c98c1a5.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy IInd year / June 2021</td>
                <td><span class="bu-paper-code">DP-204</span> — D.Pharm 2nd Year Paper 204</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/9ee76e211be5c538bbbf480fc13b629c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy IInd year / June 2021</td>
                <td><span class="bu-paper-code">DP-205</span> — D.Pharm 2nd Year Paper 205</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/650aaad46595c41a25cdab3a53054d0d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- D.Pharm 1st Year April 2021 -->
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / April 2021</td>
                <td><span class="bu-paper-code">DP-101</span> — D.Pharm 1st Year Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/4d63ea37140eabdf13b87e6f45cbfde7.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / April 2021</td>
                <td><span class="bu-paper-code">DP-102</span> — D.Pharm 1st Year Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d0d52107217770387c706c636dc8792e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / April 2021</td>
                <td><span class="bu-paper-code">DP-103</span> — D.Pharm 1st Year Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/bf208f26cfed3b266153f3da47c21073.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / April 2021</td>
                <td><span class="bu-paper-code">DP-104</span> — D.Pharm 1st Year Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2e93f90e3b9eeed452f201b3a0d94eb6.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / April 2021</td>
                <td><span class="bu-paper-code">DP-105</span> — D.Pharm 1st Year Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/761b7f3fe2657f3c4d9ef4c3faeb5f4a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / April 2021</td>
                <td><span class="bu-paper-code">DP-106</span> — D.Pharm 1st Year Paper 106</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/7529aee90610f0100961e88dd3fceaa2.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- D.Pharm 1st Year June 2019 -->
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / June 2019</td>
                <td><span class="bu-paper-code">DP-101</span> — D.Pharm 1st Year Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6149094617470cbcb21c05a5d03f08d9.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / June 2019</td>
                <td><span class="bu-paper-code">DP-102</span> — D.Pharm 1st Year Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/4fb843b5fc75bf3c542fd19e6f7f9c8f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / June 2019</td>
                <td><span class="bu-paper-code">DP-103</span> — D.Pharm 1st Year Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/282e50f310c469b51ae8b2c37f18491b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / June 2019</td>
                <td><span class="bu-paper-code">DP-104</span> — D.Pharm 1st Year Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/fe80f28fbbc2e7ebb38effa2c275abe7.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / June 2019</td>
                <td><span class="bu-paper-code">DP-105</span> — D.Pharm 1st Year Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/8a9a1a6fc84b48b7bbf05fcbf501c013.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>D.Pharmacy Ist year / June 2019</td>
                <td><span class="bu-paper-code">DP-106</span> — D.Pharm 1st Year Paper 106</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/bf0918d6caacd14405d5120e5ae6b0f7.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Pharm -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-plus-square" style="margin-right:8px;"></i> B.Pharm (Bachelor of Pharmacy)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BP-101</span> — B.Pharm Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a0ec1b8e04cf9401bc92b3a799e4d00e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BP-102</span> — B.Pharm Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e3de4370e83b8d7eeec0459eb06c2222.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BP-103</span> — B.Pharm Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/0677c5fcc4c5b37ca6fdf6ddf4bf173e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BP-104</span> — B.Pharm Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c7d18e83d3914a7514edd69859b1dc1e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: M.Pharm -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-plus-square" style="margin-right:8px;"></i> M.Pharm (Master of Pharmacy)</td>
              </tr>
              <!-- Pharmaceutics -->
              <tr class="paper-item">
                <td>MPharm (P'Ceutics) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPH-101T</span> — Pharmaceutics Paper 101T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/cd758c631aae00cdd38e91a28ae11c6c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MPharm (P'Ceutics) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPH-102T</span> — Pharmaceutics Paper 102T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/165ba40baa4c11827f140f31b8d2162e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MPharm (P'Ceutics) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPH-103T</span> — Pharmaceutics Paper 103T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/0a3b5a11f2911732b57371641622be1e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MPharm (P'Ceutics) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPH-104T</span> — Pharmaceutics Paper 104T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ecf41a29ce28d364d796b14a3241a0d2.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Pharmacology -->
              <tr class="paper-item">
                <td>M.Pharm (P'Cology) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPL-101T</span> — Pharmacology Paper 101T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f385e564fcae672280b556ba15a11d83.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>M.Pharm (P'Cology) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPL-102T</span> — Pharmacology Paper 102T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/0741fcb90d9f7c2dc155c27b6615057b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>M.Pharm (P'Cology) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPL-103T</span> — Pharmacology Paper 103T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/aede07d60d2074e358a802a7cc0ce637.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>M.Pharm (P'Cology) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MPL-104T</span> — Pharmacology Paper 104T</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/927afbce1ddc2ce912564f685edc287e.pdf" class="bu-dl-link">
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

