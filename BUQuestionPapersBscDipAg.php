<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Agriculture Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for B.Sc Agriculture and Diploma Agriculture courses at Bhabha University Bhopal.">
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
  $page_title    = 'Agriculture <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for B.Sc Agriculture and Diploma Agriculture courses.';
  $page_icon     = 'fa-leaf';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Agriculture',    'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Department of Agricultural Sciences</span>
        <h2 class="bu-content-h2">Agriculture <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, course name, or session (e.g., BAG-5101, DAG-101, March 2021)..." onkeyup="filterPapers()">
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
              <!-- Section: BSc Agriculture -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-leaf" style="margin-right:8px;"></i> B.Sc Agriculture</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5101</span> — B.Sc Agriculture Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/1f10729b220f6e6bd28ad2cb08f36d57.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5102</span> — B.Sc Agriculture Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a6b38afe3df9b6dc4133060c33048021.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5103</span> — B.Sc Agriculture Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/683ea089b49deeeea9f752689d771693.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5104</span> — B.Sc Agriculture Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2b1fb5d08082efaaa11606fcb95bd2ce.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5105</span> — B.Sc Agriculture Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2b3ebf847876d282b7808e5d21b30330.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5106</span> — B.Sc Agriculture Paper 106</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6521244cf28c4db61707d8532b947479.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5107 B</span> — B.Sc Agriculture Paper 107 B</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/70687823bbe818ddb440f707df6a788e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5107 M</span> — B.Sc Agriculture Paper 107 M</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/175745697461ca86eb8584e375ef4e5a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5108</span> — B.Sc Agriculture Paper 108</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/da8c07646bacc4e78e4216355d2e9fc8.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5109</span> — B.Sc Agriculture Paper 109</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/0030b38eb4e80f6b5f2136162c76028a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BAG-5110</span> — B.Sc Agriculture Paper 110</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a0f9b13219a22d2755566eafc42f393b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: Diploma Agriculture -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-leaf" style="margin-right:8px;"></i> Diploma Agriculture</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">DAG-101</span> — Diploma Agriculture Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a976991e083da161aba64c27be1db284.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">DAG-102</span> — Diploma Agriculture Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c24cd73d71579ab6b4c4bfe279d3799b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">DAG-103</span> — Diploma Agriculture Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/536b1558c9ef8788297e3946e55b5b29.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">DAG-104</span> — Diploma Agriculture Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ae057689caf0cf46e20bd722dd0d0dcf.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">DAG-105</span> — Diploma Agriculture Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e6fb3dabd488f6df7f8e90dab4959d0a.pdf" class="bu-dl-link">
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

