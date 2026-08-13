<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hotel Management Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for BHMCT and BHM Hotel Management courses at Bhabha University Bhopal.">
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
  $page_title    = 'Hotel Management <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for BHMCT and BHM degree programs.';
  $page_icon     = 'fa-cutlery';
  $breadcrumbs   = [
    ['label' => 'Home',             'url' => URL_ROOT],
    ['label' => 'Question Papers',  'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Hotel Management', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Department of Hotel Management &amp; Catering Technology</span>
        <h2 class="bu-content-h2">Hotel Management <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code or session (e.g., BHM-101, BHM-102, March 2021)..." onkeyup="filterPapers()">
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
              <!-- Section: BHM / BHMCT -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-cutlery" style="margin-right:8px;"></i> BHM / BHMCT</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BHM-101</span> — BHM Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3a22583c6f6c4ef24cda2e2698e160b5.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BHM-102</span> — BHM Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a8ab3d71f03b41e756425e78dd7b3ab2.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BHM-103</span> — BHM Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f838f8a8244ba8168942d7ba4d1dc27a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BHM-104</span> — BHM Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ae661a9b3c21836cdb6518f09481b06d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BHM-105</span> — BHM Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/97f89c27f8917efff018b74e473c0595.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BHM-106</span> — BHM Paper 106</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/9158e150d1bb63774886f52d9f0e8a18.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">BHM-107</span> — BHM Paper 107</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/611ef23e35a1519c0dd9bb9f1ed1045c.pdf" class="bu-dl-link">
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

