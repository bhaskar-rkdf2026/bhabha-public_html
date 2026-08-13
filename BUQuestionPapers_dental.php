<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dental Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for BDS and MDS programs at Bhabha University Bhopal.">
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
  $page_title    = 'Dental <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for BDS and MDS dental surgical programs.';
  $page_icon     = 'fa-hospital-o';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Dental',          'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Faculty of Dental Sciences</span>
        <h2 class="bu-content-h2">Dental <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, specialization, or session (e.g., BDS-101, MDS, Periodontics, Sept 2021)..." onkeyup="filterPapers()">
        </div>

        <div class="bu-qp-table-wrap">
          <table class="bu-qp-table" id="paperTable">
            <thead>
              <tr>
                <th>Session / Exam Period</th>
                <th>Subject Name / Specialization</th>
                <th>Download Link</th>
              </tr>
            </thead>
            <tbody>
              <!-- Section: BDS -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-hospital-o" style="margin-right:8px;"></i> BDS (Bachelor of Dental Surgery)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / Jan 2022</td>
                <td><span class="bu-paper-code">BDS-101</span> — Dental Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/fce064f79fc0b584dac02f4eaaf31b9d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / Jan 2022</td>
                <td><span class="bu-paper-code">BDS-102</span> — Dental Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/152c66f83ff8553186a6c4e1fd326874.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / Jan 2022</td>
                <td><span class="bu-paper-code">BDS-103</span> — Dental Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/263a51ce826b16f2fb4fc0f49d0aa42d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: MDS -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-hospital-o" style="margin-right:8px;"></i> MDS (Master of Dental Surgery)</td>
              </tr>
              <tr class="paper-item">
                <td>MDS Part I / Sept 2021</td>
                <td><span class="bu-paper-code">MDS-101</span> — Conservative Dentistry &amp; Endodontics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/481be831edc254745d137775f4c29edb.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MDS Part I / Sept 2021</td>
                <td><span class="bu-paper-code">MDS-101</span> — Oral Medicine &amp; Radiology</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/51041a40ae0d388f0ca100580fb5b2d6.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MDS Part I / Sept 2021</td>
                <td><span class="bu-paper-code">MDS-101</span> — Oral Pathology &amp; Microbiology</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/59509a1e53d57e5188057213b47a2dd2.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MDS Part I / Sept 2021</td>
                <td><span class="bu-paper-code">MDS-101</span> — Orthodontics and Dentofacial Orthopedics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/9fab3f9dcc2927a411a8a7faa1f73246.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MDS Part I / Sept 2021</td>
                <td><span class="bu-paper-code">MDS-101</span> — Periodontics and Implantology</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/dd6bd4c6fc9e369945861fe2bdac4bf1.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MDS Part I / Sept 2021</td>
                <td><span class="bu-paper-code">MDS-101</span> — Prosthodontics and Crown &amp; Bridge</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6402e4c3f682a2b6cf1e1097abe14050.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MDS Part I / Sept 2021</td>
                <td><span class="bu-paper-code">MDS-101</span> — Public Health Dentistry</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e8e9a9d1aae192183b5e2f7170b6f678.pdf" class="bu-dl-link">
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

