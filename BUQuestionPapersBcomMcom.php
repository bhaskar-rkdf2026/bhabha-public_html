<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Commerce Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for B.Com and M.Com courses at Bhabha University Bhopal.">
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
  $page_title    = 'Commerce <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for B.Com and M.Com degree programs.';
  $page_icon     = 'fa-briefcase';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Commerce',        'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Department of Commerce</span>
        <h2 class="bu-content-h2">Commerce <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, subject name, or exam session (e.g., BC301, M.Com, June 2019)..." onkeyup="filterPapers()">
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
              <!-- Section: B.Com IIIrd Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-briefcase" style="margin-right:8px;"></i> B.Com IIIrd Year</td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BC301 (01)</span> — Commerce Paper 301 (1)</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/dff0b3e47163091e6b3dab508f727809.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BC301 (02)</span> — Commerce Paper 301 (2)</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/0a2237e158ae115c23917700ba549868.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BC302 (01)</span> — Commerce Paper 302 (1)</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/194d7138584e0ca0cb522161d30ca460.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BC302 (02)</span> — Commerce Paper 302 (2)</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/8011452f28ed0aac1148ef7990ea1da8.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BC303 (01)</span> — Commerce Paper 303 (1)</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f5679fae2ba91d14239d53a440c41a4a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BC303 (02)</span> — Commerce Paper 303 (2)</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/8effb5c0dd86186eed4363c36300506f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BCC303 (01)</span> — Web Designing</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e9ff47897611504a7fa526e513874da0.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Com IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BCC303 (02)</span> — Digital Marketing</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f0028761657279c320519ed7a6d96a75.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Com Ist Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-briefcase" style="margin-right:8px;"></i> B.Com Ist Year</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BC-101</span> — B.Com Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/743c33b5b4159aa23cbc3dfbe53c02e8.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BC-102</span> — B.Com Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/439420d758eca54a61a55000361bc25c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BC-103</span> — B.Com Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f921187d962dc5e2db07f7278d220def.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BC-104</span> — B.Com Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/adf1c4ee3d2036bcb6139070adf602db.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BC-105</span> — B.Com Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/19fbafe71ec82937387775ffd3708b7f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BC-106</span> — B.Com Paper 106</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/308653b751fe8fc1c95fe65760bd14b6.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCC-101</span> — B.Com Computer Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a764f0cfd5f3591409e2bbd68beee21e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCC-102</span> — B.Com Computer Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c377f15606b8a0ff48c1192628bbacc5.pdf" class="bu-dl-link">
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

              <!-- Section: M.Com -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-briefcase" style="margin-right:8px;"></i> M.Com (Master of Commerce)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MC-101</span> — M.Com Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/22c6ee0a03427e8bc7f97b0ff3a20136.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MC-102</span> — M.Com Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/842e75cbc9026d03abbbb1a86fe83cb9.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MC-103</span> — M.Com Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ccf7218db7888f0c1514d5a558eb0ea7.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MC-104</span> — M.Com Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ae42dc00af305e8892866f6f1e5e4917.pdf" class="bu-dl-link">
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

