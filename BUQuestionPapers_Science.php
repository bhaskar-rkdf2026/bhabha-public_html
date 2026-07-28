<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Science Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for B.Sc specializations including Biotechnology, Botany, Chemistry, Computer, Mathematics, Microbiology, and Zoology at Bhabha University Bhopal.">
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
  $page_title    = 'Science <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for B.Sc. specializations.';
  $page_icon     = 'fa-flask';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Science',         'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Faculty of Basic &amp; Applied Science</span>
        <h2 class="bu-content-h2">Science <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by subject (e.g., Biotechnology, Chemistry, Maths, Zoology, Micro, BT-301, BCH-301)..." onkeyup="filterPapers()">
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
              <!-- Section: B.Sc Biotechnology -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-flask" style="margin-right:8px;"></i> B.Sc. Biotechnology</td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BT-301(1)</span> — Biotechnology Paper 1</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/29d1eb02f586b02c6d3d6195ac65fdaa.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BT-301(2)</span> — Biotechnology Paper 2</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/de2636b529892836f9b08383c6165cb3.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Sc Botany -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-flask" style="margin-right:8px;"></i> B.Sc. Botany</td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBT-301(1)</span> — Botany Paper 1</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d9dba42e6e8e28a69134db2d60d57c4a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BBT-301(2)</span> — Botany Paper 2</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/9aced90da8dde50efa0b11f5a776879d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Sc Chemistry -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-flask" style="margin-right:8px;"></i> B.Sc. Chemistry</td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BCH-301 (1)</span> — Physical Chemistry</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/86a5aa8a441c921a29d5b33ad3022174.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BCH-301 (2)</span> — Inorganic Chemistry</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/de6906891d5f14e152a0ec95d0974c3f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BCH-301 (3)</span> — Organic Chemistry</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/35b45e08153d9c79d386be68be11b0f1.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Sc Computer -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-flask" style="margin-right:8px;"></i> B.Sc. Computer Science</td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BFC-301(1)</span> — Computer Science Paper 1</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e07d1129f284e55801416429d07190e0.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BFC-301(2)</span> — Computer Science Paper 2</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6a74587fb79af5742a977d891e7d0220.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Sc Mathematics -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-flask" style="margin-right:8px;"></i> B.Sc. Mathematics</td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BMT-301(1)</span> — Mathematics Paper 1</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/91e74d8753cdf6c0ba62215246264ce4.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BMT-301(2)</span> — Mathematics Paper 2</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/24890e62f71e79d30e47ab476fa23bc6.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Sc Microbiology -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-flask" style="margin-right:8px;"></i> B.Sc. Microbiology</td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BMB -301 (1)</span> — Microbiology Paper 1</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c66003523d31c055f014d42abd600506.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BMB -301 (2)</span> — Microbiology Paper 2</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/39ad231f1622e7402755ccd151653b34.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: B.Sc Zoology -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-flask" style="margin-right:8px;"></i> B.Sc. Zoology</td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BZT -301 (1)</span> — Zoology Paper 1</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d23d3cc4196e573d61fe4db6a1473cff.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>B.Sc. IIIrd year / May 2021</td>
                <td><span class="bu-paper-code">BZT -301 (2)</span> — Zoology Paper 2</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f54b8052def8edfe2650c70a3aed25a3.pdf" class="bu-dl-link">
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
