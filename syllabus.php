<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Scheme & Syllabus - Bhabha University Bhopal</title>
<meta name="description" content="Download official course scheme, curriculum, and semester syllabus for undergraduate, postgraduate, and diploma programs at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
  margin-bottom: 20px;
}
.bu-form-group {
  margin-bottom: 16px;
}
.bu-form-group label {
  display: block;
  font-size: 12.5px;
  font-weight: 700;
  color: #061D7C;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-form-control {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid #D1D5DB;
  border-radius: 6px;
  font-size: 14px;
  color: #1F2937;
  background: #F9FAFB;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-form-control:focus {
  outline: none;
  border-color: #0A1B54;
  background: #ffffff;
  box-shadow: 0 0 0 3px rgba(10,27,84,0.1);
}

.bu-btn-submit {
  background: #0A1B54;
  color: #FFC107;
  font-weight: 800;
  font-size: 13.5px;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 14px 36px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.25s ease;
  box-shadow: 0 4px 16px rgba(10,27,84,0.2);
}
.bu-btn-submit:hover {
  background: #061D7C;
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(10,27,84,0.3);
}

/* Styled Table Content for Syllabus Results */
.bu-table-wrap {
  margin-top: 30px;
  overflow-x: auto;
}
.bu-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(6,29,124,0.05);
}
.bu-table th {
  background: #0A1B54;
  color: #FFC107;
  font-weight: 700;
  padding: 14px 18px;
  text-align: left;
  border-bottom: 2px solid #061D7C;
}
.bu-table td {
  padding: 14px 18px;
  border-bottom: 1px solid #E5E7EB;
  color: #374151;
}
.bu-table tr:nth-child(even) {
  background: #F8FAFC;
}
.bu-table tr:hover {
  background: #F1F5F9;
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
<script type="text/javascript">
   $(document).ready(function(){
	   $("#course").change(function(){					 
			 var course=$("#course").val();
			 $.ajax({
				type:"post",
				url:"<?php echo URL_ROOT;?>getBranch.php",
				data:"course="+course,
				success:function(data){
					  $("#branch").html(data);
				}
			 });
	   });

	   $("#branch").change(function(){					 
			 var branch=$("#branch").val();
			 $.ajax({
				type:"post",
				url:"<?php echo URL_ROOT;?>getYear.php",
				data:"branch="+branch,
				success:function(data){
					  $("#year").html(data);
				}
			 });
	   });
   });
</script>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Scheme &amp; <em>Syllabus</em>';
  $page_subtitle = 'Search and download official course curricula, semester schemes, and syllabus documents.';
  $page_icon     = 'fa-file-text';
  $breadcrumbs   = [
    ['label' => 'Home',      'url' => URL_ROOT],
    ['label' => 'Academics', 'url' => '#'],
    ['label' => 'Scheme & Syllabus', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Curriculum Portal</span>
        <h2 class="bu-content-h2">Search Scheme &amp; <em>Syllabus</em></h2>
        <div class="bu-content-divider"></div>

        <form action="" method="post" style="margin-top:20px;">
          <div class="bu-form-grid">
            
            <div class="bu-form-group">
              <label>Select Course *</label>
              <select name="course" id="course" class="bu-form-control" required>
                <option value="">-- Select Course --</option>
                <?php
                $courses = $db->get('course');
                if(is_array($courses) && count($courses) > 0) {
                  foreach($courses as $icourse) {
                    $selected = (isset($_POST['course']) && $_POST['course'] == $icourse['id']) ? 'selected="selected"' : '';
                    echo '<option value="'.$icourse['id'].'" '.$selected.'>'.$icourse['course'].'</option>';
                  }
                }
                ?>
              </select>
            </div>

            <div class="bu-form-group">
              <label>Branch / Specialization *</label>
              <select name="branch" id="branch" class="bu-form-control" required>
                <option value="">-- Select Branch --</option>
                <?php
                if(isset($_POST['course'])) {
                  $db->where('course', $_POST['course']);
                  $branches = $db->get('branch');
                  if(is_array($branches) && count($branches) > 0) {
                    foreach($branches as $ibranch) {
                      $selected = (isset($_POST['branch']) && $_POST['branch'] == $ibranch['id']) ? 'selected="selected"' : '';
                      echo '<option value="'.$ibranch['id'].'" '.$selected.'>'.$ibranch['branch'].'</option>';
                    }
                  }
                }
                ?>
              </select>
            </div>

            <div class="bu-form-group">
              <label>Semester / Year *</label>
              <select name="year" id="year" class="bu-form-control" required>
                <option value="">-- Select Sem / Year --</option>
              </select>
            </div>

          </div>

          <div style="margin-top:16px;">
            <button type="submit" name="submit" class="bu-btn-submit">Show Downloads <i class="fa fa-search" style="margin-left:6px;"></i></button>
          </div>
        </form>

        <!-- Syllabus Results -->
        <?php if(isset($_POST['submit'])): ?>
        <div class="bu-table-wrap">
          <table class="bu-table">
            <thead>
              <tr>
                <th>Course</th>
                <th>Branch &amp; Semester / Year</th>
                <th>Download Link</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $db->where('course', $_POST['course']);
              $db->where('branch', $_POST['branch']);
              $syllabus = $db->get('syllabus');
              if(is_array($syllabus) && count($syllabus) > 0) {
                foreach($syllabus as $isyllabus) {
                  $db->where('id', $isyllabus['course']);
                  $c_data = $db->getOne('course');

                  $db->where('id', $isyllabus['branch']);
                  $b_data = $db->getOne('branch');
              ?>
              <tr>
                <td><strong><?php echo isset($c_data['course']) ? $c_data['course'] : '';?></strong></td>
                <td><?php echo isset($b_data['branch']) ? $b_data['branch'] : '';?> — <?php echo $isyllabus['heading'];?></td>
                <td>
                  <a target="_blank" href="<?php echo URL_UPLOAD;?>syllabus/<?php echo $isyllabus['image'];?>" class="bu-dl-link">
                    <i class="fa fa-download"></i> Download Syllabus PDF
                  </a>
                </td>
              </tr>
              <?php
                }
              } else {
                echo '<tr><td colspan="3" style="text-align:center;color:#6B7280;padding:24px;">No syllabus document found for the selected criteria. Please check back soon or try another selection.</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
        <?php endif; ?>

      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
