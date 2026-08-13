<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Engineering Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year examination question papers for B.Tech, M.Tech, and Diploma Engineering courses at Bhabha University Bhopal.">
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
  $page_title    = 'Engineering <em>Question Papers</em>';
  $page_subtitle = 'Previous year examination question papers for B.Tech, M.Tech, and Diploma Engineering branches.';
  $page_icon     = 'fa-cogs';
  $breadcrumbs   = [
    ['label' => 'Home',            'url' => URL_ROOT],
    ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
    ['label' => 'Engineering',     'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-back-btn">
          <i class="fa fa-arrow-left"></i> Back to All Departments
        </a>

        <span class="bu-content-label">Faculty of Engineering &amp; Technology</span>
        <h2 class="bu-content-h2">Engineering <em>Question Papers</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="paperSearchInput" class="bu-search-input" placeholder="Search by paper code, subject name, or branch (e.g., CE-11, MTech CSE, Thermal, Diploma)..." onkeyup="filterPapers()">
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
              <!-- Section: B.Tech First Year -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-cogs" style="margin-right:8px;"></i> B.Tech (Bachelor of Technology)</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CE-11</span> — Basic Civil Engineering &amp; Mechanics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3dccea924cfb8ffd575b0ea8ea1c78e9.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CH-11</span> — Engineering Chemistry</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6f7ec2fc49617076edd18f73889ccbec.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CS-11</span> — Basic Computer Engineering</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2cc118539fccf95e5f75aae07cf63671.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EE-11</span> — Basic Electrical &amp; Electronics Engineering</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/5373d9382177c142267bc5ab7e636519.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">HU-11</span> — English for Communication</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/671ec80c3a19f0c07cd2aa00f62c0c8f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MA-11</span> — Mathematics-I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/879945998386e50c8ba3123f93a025ee.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>IInd Sem / March 2021</td>
                <td><span class="bu-paper-code">MA-21</span> — Mathematics-II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ac5b4ab91296436d21498abe11db4bc4.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-11</span> — Engineering Graphics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/f87b3e11be64db737827e23a8c859340.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-13</span> — Basic Mechanical Engineering</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e6ea941a6739292ebfb220f93c6be5f9.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">PY-11</span> — Engineering Physics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/4dbdc6e88d98959c943c3922cd027fc9.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: M.Tech -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-cogs" style="margin-right:8px;"></i> M.Tech (Master of Technology)</td>
              </tr>
              <!-- MTech CSE -->
              <tr class="paper-item">
                <td>MTech (CSE) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CS-101</span> — Advance Data Structure &amp; Algorithm</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/5a1963a506c5b5327c5b231d44e05183.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CSE) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CS-102</span> — Object Oriented Technology and UML</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/6387126827d4282c700741b50fb1544f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CSE) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CS-103</span> — Advanced Computer Architecture</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3d0aef10454a732481ae8ab1e569456d.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CSE) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CS-104</span> — Advanced Computer Networking</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2a00a3e6ba86ac90bbf758a4268b963f.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CSE) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MA-104</span> — Advanced Mathematics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/4d5246bd76ac37a7df9fb02aaf6a2490.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <!-- MTech CTM -->
              <tr class="paper-item">
                <td>MTech (CTM) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CE-101</span> — MTech (CTM) Paper 101</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/e53a128d55023d70cfbf34bcb931859e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CTM) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CE-102</span> — MTech (CTM) Paper 102</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d04930e339b14fb947ab74fd57440b32.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CTM) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CE-103</span> — MTech (CTM) Paper 103</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/adc283f0e38d73239a96954d040def29.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CTM) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CE-104</span> — MTech (CTM) Paper 104</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c76512ab4312fdb953f8d9ad6e9274f9.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (CTM) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MA-101</span> — MTech (CTM) Mathematics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2cba97b12cddacf28a2010d031bf9c78.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <!-- MTech DC -->
              <tr class="paper-item">
                <td>MTech (DC) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EC-101</span> — VLSI Design</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3e0529cef9d9f8a144b2cbddcdecf222.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (DC) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EC-102</span> — Data Communication and Computer Networks</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/0d1c755f900d38d203f3dd8f1fd57c6e.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (DC) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EC-103</span> — Micro Controller System Design</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/0050888e2e409b6fecbfe509e3895a4a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (DC) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EC-104</span> — DSP Application</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d6ce3a50cfb6a3984f99564263c777c5.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <!-- MTech PS -->
              <tr class="paper-item">
                <td>MTech (PS) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EE-101</span> — Power System Dynamics Analysis &amp; Control</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/32c044780072ec3d7679e04ea60bfbb0.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (PS) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EE-102</span> — Advance Power System Protection Relays</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/1b943b5b7c3d5ca0969f6630b55b4a84.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (PS) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EE-103</span> — Power Electronics Applications to Power Systems</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/b0701c07dfaa11b1a3bbbf61b31b3f76.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (PS) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">EE-104</span> — Advance Course in Electrical Machines</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/c9b3a58ba3a6b1b12fe78bace8aafa13.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (PS) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MA-104</span> — Advanced Mathematics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/d36ba298b384af0c684dc17deab0ca22.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <!-- MTech THERMAL -->
              <tr class="paper-item">
                <td>MTech (THERMAL) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-101</span> — Thermodynamics and Combustion</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/a472da9d5560b468ad0c243a31b6767a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (THERMAL) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-102</span> — Heat &amp; Mass Transfer</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/48a2093bff388721924bfc66cc0857c3.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (THERMAL) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-103</span> — Advanced Fluid Mechanics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/dbda124d8e97d91e635a7501dafa340a.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (THERMAL) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-104</span> — IC Engines &amp; Alternate Fuels</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/b9212603c3f10543ca8713219e639ce3.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>MTech (THERMAL) Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MA-104</span> — Advanced Mathematics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/4ae87fecd40779deb5ba0d1a4c089ae1.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>

              <!-- Section: Diploma Engineering -->
              <tr class="bu-qp-section-row">
                <td colspan="3"><i class="fa fa-cogs" style="margin-right:8px;"></i> Diploma Engineering</td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CH-1001</span> — Diploma Chemistry</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/738a9923c176d0965ba8d195326d8f57.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CH-1002</span> — Diploma Chemistry II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/fbabf47a1c5ddfbe5350b2e8ecefdf69.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">CS-1001</span> — Diploma Computer Science</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/8dbf251e0688a100c5d35a57272e43ef.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">HU-1001</span> — Diploma English</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/ef8295a1790862d7811140d1d0387c20.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">MA-1001</span> — Diploma Mathematics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/3bcc6642afaeaefd4d7025972734489c.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-1001</span> — Diploma Mechanical I</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/67252fc57ba859804c145d0b62df867b.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">ME-1002</span> — Diploma Mechanical II</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/2ce7c3986fedf63b6c634d3ef7eab568.pdf" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download PDF
                  </a>
                </td>
              </tr>
              <tr class="paper-item">
                <td>Ist Sem / March 2021</td>
                <td><span class="bu-paper-code">PY-1001</span> — Diploma Physics</td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>media/1122b46a7f677720429aeebaf1ad2509.pdf" class="bu-dl-link">
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

