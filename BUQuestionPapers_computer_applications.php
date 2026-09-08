<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Computer Applications Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for BCA, MCA, DCA, and PGDCA courses at Bhabha University Bhopal.">
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
  $page_title    = 'Computer Applications <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for BCA, MCA, DCA, and PGDCA programs.';
  $page_icon     = 'fa-laptop';
  $breadcrumbs   = [
    ['label' => 'Home',                  'url' => URL_ROOT],
    ['label' => 'Question Papers',       'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Computer Applications', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Department of Computer Applications</span>
        <h2 class="bu-content-h2">Computer Applications <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, course name, or session (e.g., BCA-31, MCA-11, PGDCA, Jan 2019)..." onkeyup="filterPapers()">
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
              <!-- Section: BCA IIIrd Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-laptop" style="margin-right:8px;"></i> BCA IIIrd Year</td>
              </tr>
              <tr class="paper-item">
                <td>BCA IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BCA-31</span> — Computer Applications Paper 31</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/8f8ec7fc79fe3e5bababd9f575149b16.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BCA IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BCA-32</span> — Computer Applications Paper 32</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/9b0e93b0317f76d9389196f347ce8d1a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BCA IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BCA-33</span> — Computer Applications Paper 33</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/58ef7181174ca36454ea0801400ceefa.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BCA IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BCA-34</span> — Computer Applications Paper 34</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e3ec3adada31e124fff2fb7c3b74b15c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BCA IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BCA-35</span> — Computer Applications Paper 35</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a9b570eb4e3ad4ec0f9dcc47fb58f40a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>BCA IIIrd Year / May 2021</td>
                <td><span class="bu-paper-code">BCA-36</span> — Computer Applications Paper 36</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/03f4648f02194e776d13fba0cc5b9ed6.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: BCA Ist Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-laptop" style="margin-right:8px;"></i> BCA Ist Year</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCA-11</span> — Computer Applications Paper 11</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/60c0724d343fa9540a6670ca9a5600a5.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCA-12</span> — Computer Applications Paper 12</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/790debe182c3bffdbfe3573b2c13cc8d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCA-13</span> — Computer Applications Paper 13</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/fd6881992f9f1dfb3bbbf09fe881d3d4.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCA-14</span> — Computer Applications Paper 14</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/8a2c95784cd433881059f0f85ab3598b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCA-15</span> — Computer Applications Paper 15</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ae05195d2f43414632febc4745fa2f7f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Year / June 2019</td>
                <td><span class="bu-paper-code">BCA-16</span> — Computer Applications Paper 16</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/80bf8dd5f57e6b2ea1092f6b322461b3.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: MCA -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-laptop" style="margin-right:8px;"></i> MCA (Master of Computer Applications)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">MCA-11</span> — MCA Paper 11</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/dc3b6dcb6c4b5db7882e1605d4e3e5fe.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">MCA-12</span> — MCA Paper 12</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3136ca5ec2e70d35c243a010feef9675.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">MCA-13</span> — MCA Paper 13</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3136ca5ec2e70d35c243a010feef9675.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">MCA-14</span> — MCA Paper 14</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/fb762b64fd745b515a055b727253f0ab.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">MCA-15</span> — MCA Paper 15</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/52009d99b7dfeed99b8d9c545c2675d0.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: DCA -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-laptop" style="margin-right:8px;"></i> DCA (Diploma in Computer Applications)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">DCA-101</span> — DCA Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/5d82755adb5bc3629897ebaf9a3e63fa.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">DCA-102</span> — DCA Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/51bb557826db582533c18a88082d64ea.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">DCA-103</span> — DCA Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/b032bba43171a7b73b5336e6b8a63c86.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: PGDCA -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-laptop" style="margin-right:8px;"></i> PGDCA (Post Graduate Diploma in Computer Applications)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">PGDCA-11</span> — PGDCA Paper 11</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/af64430ea82d49e04f5e917b3dfabb8e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">PGDCA-12</span> — PGDCA Paper 12</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2f8d0330d9a3d04b67a1aa2903bf7964.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">PGDCA-13</span> — PGDCA Paper 13</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3b1e25ce9d9c957614608e7aaac6bb79.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / Jan 2019</td>
                <td><span class="bu-paper-code">PGDCA-14</span> — PGDCA Paper 14</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/5dc2d8fed334920550565373dc218221.pdf" class="bu-dl-link">
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

