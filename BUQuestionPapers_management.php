<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Management Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for BBA, MBA (Full Time), and MBA (Part Time) programs at Bhabha University Bhopal.">
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
  $page_title    = 'Management <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for BBA, MBA (Full Time), and MBA (Part Time) programs.';
  $page_icon     = 'fa-line-chart';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Management',      'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Faculty of Management Studies</span>
        <h2 class="bu-content-h2">Management <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, course, or session (e.g., BBA-301, CP-101, PT-101, May 2021)..." onkeyup="filterPapers()">
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
              <!-- Section: BBA IIIrd Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-line-chart" style="margin-right:8px;"></i> BBA (Bachelor of Business Administration)</td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBA-301</span> — BBA Paper 301</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a68c1fd702060d760665a960642d2058.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBA-302</span> — BBA Paper 302</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6fc388aaf0efd6c616cc2db8183e8cce.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBA-303</span> — BBA Paper 303</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/10ec44a091748bacc6c40241ec673b6c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBA-304</span> — BBA Paper 304</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/43b8efd79f4027ffdc3c32c60c509e42.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBAFM-305</span> — Financial Management 305</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/991f470264e3597d1e98f892704ddcc5.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBAFM-306</span> — Financial Management 306</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f30f25beb28114c5727962c703acb4b8.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBAHRM-305</span> — HR Management 305</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/1a435b95126eb05db7a82d4304aa25ba.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBAHRM-306</span> — HR Management 306</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/daea92f7cb4dfbebdfc362dd08ae282c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBAMM-305</span> — Marketing Management 305</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3bbcaa8c2be9383735e3397e7f4688f8.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BBA IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBAMM-306</span> — Marketing Management 306</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6ab02c45083b2174551a9055c21be4fd.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: MBA (Full Time) -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-line-chart" style="margin-right:8px;"></i> MBA (Full Time 2 Years)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CP-101</span> — MBA Core Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2bc070f11debe558c7f19e9b2110108e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CP-102</span> — MBA Core Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6f0d08173a0029cbb7de7ec71f677556.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CP-103</span> — MBA Core Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2a2d52e445df8f082a72f361cae3c564.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CP-104</span> — MBA Core Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d1319075f958ad6ddff99f7161b31107.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CP-105</span> — MBA Core Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/bbc0e17cd4c09f2ffd578fca73eb5c0d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CP-106</span> — MBA Core Paper 106</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d6c836e6f8036d5e340913679582f996.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: MBA (Part Time) -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-line-chart" style="margin-right:8px;"></i> MBA (Part Time 3 Years)</td>
              </tr>
              <tr class="paper-item">
                <td>MBA I-Sem / March 2021</td>
                <td><span class="bu-paper-code">PT-101</span> — MBA Part Time Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a50643f95e06d86be4a9efa01f52143b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">PT-102</span> — MBA Part Time Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c03ce658ff81c8b9bd219a583a38c147.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">PT-103</span> — MBA Part Time Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/eba6d62eb6310783909db78e7f3b8b3b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">PT-104</span> — MBA Part Time Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/9fcb865e9245d5c8cff34f9d3f94e2f9.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">PT-105</span> — MBA Part Time Paper 105</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/8ef246893916c03e954f6258fecbab18.pdf" class="bu-dl-link">
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
