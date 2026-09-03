<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');
$stat=array();
$action='';
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
define("PAGE",'alumni.php');
define("TITLE",'Alumni Registrations');
define("DBTAB",'alumni');

if(!empty($_SESSION['success']))
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if($action=="delete")
{
	$db->where('id',$_REQUEST['id']);
	$db->delete(DBTAB);
	$_SESSION["success"] = 'Alumni record successfully deleted.';
	redirect(PAGE);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Admin Dashboard</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<style>
.alumni-detail-section {
  border-bottom: 2px solid #f1f5f9;
  padding-bottom: 12px;
  margin: 25px 0 15px;
  font-size: 16px;
  font-weight: 700;
  color: #0a1b54;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.alumni-detail-section:first-of-type {
  margin-top: 5px;
}
.alumni-detail-section i {
  color: #d99b00;
  margin-right: 8px;
}
.alumni-info-item {
  margin-bottom: 14px;
}
.alumni-info-item label {
  font-weight: 600;
  color: #475569;
  margin-bottom: 2px;
  display: block;
  font-size: 13px;
  text-transform: uppercase;
}
.alumni-info-item .val {
  font-size: 15px;
  color: #0f172a;
  font-weight: 500;
  background: #f8fafc;
  padding: 8px 12px;
  border-radius: 6px;
  border: 1px solid #e2e8f0;
  display: block;
  word-break: break-word;
}
</style>
</head>
<body>
<!-- Begin page -->
<div id="wrapper"><!-- Top Bar Start -->
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page"><!-- Start content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><?php echo TITLE; ?></h4>
            </div>
          </div>
        </div>
        <!-- end row -->
        <?php
        if($action=="view")
        {
          $db->where('id',$_REQUEST['id']);
          $aryData = $db->getOne(DBTAB);
          if(!$aryData) {
            echo '<div class="alert alert-danger">Record not found. <a href="alumni.php">Back to list</a></div>';
          } else {
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="mt-0 header-title font-weight-bold" style="font-size:18px;">
                    <i class="mdi mdi-account-card-details text-primary"></i> Alumni Details: <?php echo htmlspecialchars($aryData['name'] ?? ''); ?> (ID #<?php echo $aryData['id']; ?>)
                  </h4>
                  <div>
                    <a href="<?php echo PAGE;?>" class="btn btn-secondary waves-effect"><i class="mdi mdi-arrow-left"></i> Back to List</a>
                    <a href="<?php echo PAGE;?>?id=<?php echo $aryData['id']?>&action=delete" onclick="return confirm('Are you sure you want to delete this alumni record?');" class="btn btn-danger waves-effect"><i class="mdi mdi-delete"></i> Delete</a>
                  </div>
                </div>
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>

                <!-- 1. PERSONAL DETAILS -->
                <div class="alumni-detail-section">
                  <i class="mdi mdi-account"></i> Personal Details
                </div>
                <div class="row">
                  <div class="col-md-4 alumni-info-item">
                    <label>Full Name</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['name'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Enrollment Number</label>
                    <div class="val font-weight-bold text-primary"><?php echo htmlspecialchars($aryData['enrollment_no'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Nick Name (During College)</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['nick_name'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Father's Name</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['fname'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Mother's Name</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['mname'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Gender</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['gender'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Date of Birth</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['dob'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Marital Status</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['marital'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Date of Marriage</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['dom'] ?: '-'); ?></div>
                  </div>
                </div>

                <!-- 2. ACADEMIC DETAILS -->
                <div class="alumni-detail-section">
                  <i class="mdi mdi-school"></i> Academic Records
                </div>
                <div class="row">
                  <div class="col-md-4 alumni-info-item">
                    <label>College / Institute</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['college'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Course</label>
                    <div class="val font-weight-bold"><?php echo htmlspecialchars($aryData['course'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Branch / Specialization</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['branch'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Admission Year</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['admission_year'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Year of Graduation / Passing</label>
                    <div class="val font-weight-bold text-success"><?php echo htmlspecialchars($aryData['passing_year'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Further Studies</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['further_study'] ?: '-'); ?></div>
                  </div>
                </div>

                <!-- 3. CONTACT DETAILS -->
                <div class="alumni-detail-section">
                  <i class="mdi mdi-phone-classic"></i> Contact & Communication
                </div>
                <div class="row">
                  <div class="col-md-4 alumni-info-item">
                    <label>Mobile Number</label>
                    <div class="val"><a href="tel:<?php echo htmlspecialchars($aryData['mobile'] ?? ''); ?>"><?php echo htmlspecialchars($aryData['mobile'] ?: '-'); ?></a></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>WhatsApp Number</label>
                    <div class="val"><a target="_blank" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $aryData['whatsapp'] ?? ''); ?>"><?php echo htmlspecialchars($aryData['whatsapp'] ?: '-'); ?></a></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Email Address</label>
                    <div class="val"><a href="mailto:<?php echo htmlspecialchars($aryData['email'] ?? ''); ?>"><?php echo htmlspecialchars($aryData['email'] ?: '-'); ?></a></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Current City / Location</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['city'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Present Address</label>
                    <div class="val"><?php echo nl2br(htmlspecialchars($aryData['address'] ?: '-')); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Permanent Address</label>
                    <div class="val"><?php echo nl2br(htmlspecialchars($aryData['perm_address'] ?: '-')); ?></div>
                  </div>
                </div>

                <!-- 4. PROFESSIONAL & SOCIAL -->
                <div class="alumni-detail-section">
                  <i class="mdi mdi-briefcase"></i> Professional & Social Profile
                </div>
                <div class="row">
                  <div class="col-md-4 alumni-info-item">
                    <label>Current Occupation</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['occupation'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Company / Organization</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['company'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Job Title / Designation</label>
                    <div class="val"><?php echo htmlspecialchars($aryData['job_title'] ?: '-'); ?></div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>LinkedIn</label>
                    <div class="val">
                      <?php if(!empty($aryData['linkedin'])): ?>
                        <a href="<?php echo htmlspecialchars($aryData['linkedin']); ?>" target="_blank" class="text-primary"><i class="mdi mdi-linkedin"></i> <?php echo htmlspecialchars($aryData['linkedin']); ?></a>
                      <?php else: ?> - <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Facebook</label>
                    <div class="val">
                      <?php if(!empty($aryData['facebook'])): ?>
                        <a href="<?php echo htmlspecialchars($aryData['facebook']); ?>" target="_blank" class="text-primary"><i class="mdi mdi-facebook"></i> <?php echo htmlspecialchars($aryData['facebook']); ?></a>
                      <?php else: ?> - <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Twitter / X</label>
                    <div class="val">
                      <?php if(!empty($aryData['twitter'])): ?>
                        <a href="<?php echo htmlspecialchars($aryData['twitter']); ?>" target="_blank" class="text-primary"><i class="mdi mdi-twitter"></i> <?php echo htmlspecialchars($aryData['twitter']); ?></a>
                      <?php else: ?> - <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-md-4 alumni-info-item">
                    <label>Submission Date</label>
                    <div class="val text-muted"><?php echo htmlspecialchars($aryData['date'] ?? 'N/A'); ?></div>
                  </div>
                </div>

                <div class="mt-4">
                  <a href="<?php echo PAGE;?>" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-arrow-left"></i> Back to Registrations List</a>
                </div>

              </div>
            </div>
          </div>
        </div>
        <?php
          }
        }
        else
        {
        ?>
        <div class="row">
          <div class="col-12">
            <!-- Search & Filter Card -->
            <div class="card m-b-20">
              <div class="card-body">
                <h4 class="mt-0 header-title font-weight-bold" style="font-size:16px;">
                  <i class="mdi mdi-filter-variant text-primary"></i> Search &amp; Filter Alumni
                </h4>
                <p class="text-muted font-13 mb-3">Filter registrations by Name/Enrollment, College, Specialization/Branch, or Passing Year.</p>
                
                <?php
                // Fetch distinct values for datalist filter suggestions
                $distinct_colleges = $db->rawQuery("SELECT DISTINCT college FROM alumni WHERE college != '' AND college IS NOT NULL ORDER BY college ASC");
                $distinct_branches = $db->rawQuery("SELECT DISTINCT branch as val FROM alumni WHERE branch != '' AND branch IS NOT NULL UNION SELECT DISTINCT course as val FROM alumni WHERE course != '' AND course IS NOT NULL ORDER BY val ASC");
                $distinct_years    = $db->rawQuery("SELECT DISTINCT passing_year FROM alumni WHERE passing_year != '' AND passing_year IS NOT NULL ORDER BY passing_year DESC");

                $filter_name           = trim($_GET['filter_name'] ?? '');
                $filter_college        = trim($_GET['filter_college'] ?? '');
                $filter_specialization = trim($_GET['filter_specialization'] ?? '');
                $filter_year           = trim($_GET['filter_year'] ?? '');

                $has_filter = (!empty($filter_name) || !empty($filter_college) || !empty($filter_specialization) || !empty($filter_year));
                ?>

                <form method="get" action="alumni.php" class="row">
                  <div class="form-group col-md-3">
                    <label class="font-weight-bold text-dark"><i class="mdi mdi-account-search"></i> Name / Enrollment / Mobile</label>
                    <input type="text" name="filter_name" class="form-control" placeholder="Search by name, roll no, mobile..." value="<?php echo htmlspecialchars($filter_name); ?>">
                  </div>
                  <div class="form-group col-md-3">
                    <label class="font-weight-bold text-dark"><i class="mdi mdi-domain"></i> College / Institute</label>
                    <input type="text" name="filter_college" list="list_colleges" class="form-control" placeholder="Select or type college..." value="<?php echo htmlspecialchars($filter_college); ?>">
                    <datalist id="list_colleges">
                      <?php if(is_array($distinct_colleges)) foreach($distinct_colleges as $dc): ?>
                        <option value="<?php echo htmlspecialchars($dc['college']); ?>"></option>
                      <?php endforeach; ?>
                    </datalist>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="font-weight-bold text-dark"><i class="mdi mdi-book-open-page-variant"></i> Specialization / Course / Branch</label>
                    <input type="text" name="filter_specialization" list="list_branches" class="form-control" placeholder="e.g. Computer Science, Pharmacy, B.Tech..." value="<?php echo htmlspecialchars($filter_specialization); ?>">
                    <datalist id="list_branches">
                      <?php if(is_array($distinct_branches)) foreach($distinct_branches as $dbx): if(!empty($dbx['val'])): ?>
                        <option value="<?php echo htmlspecialchars($dbx['val']); ?>"></option>
                      <?php endif; endforeach; ?>
                    </datalist>
                  </div>
                  <div class="form-group col-md-1">
                    <label class="font-weight-bold text-dark"><i class="mdi mdi-calendar"></i> Year</label>
                    <input type="text" name="filter_year" list="list_years" class="form-control" placeholder="Year" value="<?php echo htmlspecialchars($filter_year); ?>">
                    <datalist id="list_years">
                      <?php if(is_array($distinct_years)) foreach($distinct_years as $dy): ?>
                        <option value="<?php echo htmlspecialchars($dy['passing_year']); ?>"></option>
                      <?php endforeach; ?>
                    </datalist>
                  </div>
                  <div class="form-group col-md-2 d-flex align-items-end" style="gap:6px;">
                    <button type="submit" class="btn btn-primary waves-effect waves-light flex-grow-1"><i class="mdi mdi-magnify"></i> Search</button>
                    <?php if($has_filter): ?>
                      <a href="alumni.php" class="btn btn-secondary waves-effect" title="Reset All Filters"><i class="mdi mdi-close"></i> Reset</a>
                    <?php endif; ?>
                  </div>
                </form>

                <?php if($has_filter): ?>
                  <div class="mt-2 text-primary font-weight-bold font-13">
                    <i class="mdi mdi-filter-check"></i> Filter applied. <a href="alumni.php" class="text-danger ml-2 font-weight-normal"><i class="mdi mdi-close-circle"></i> Clear filters</a>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- Alumni Records Table Card -->
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="mt-0 header-title font-weight-bold" style="font-size:18px;">
                    <i class="mdi mdi-school text-primary"></i> All Alumni Applications
                  </h4>
                </div>
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th># ID</th>
                        <th>Name &amp; Enrollment</th>
                        <th>College / Institute</th>
                        <th>Course &amp; Specialization</th>
                        <th>Passing Year</th>
                        <th>Contact (Mobile &amp; Email)</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Apply filters if any
                      if(!empty($filter_name)) {
                        $escName = $db->escape($filter_name);
                        $db->where("(name LIKE '%".$escName."%' OR enrollment_no LIKE '%".$escName."%' OR email LIKE '%".$escName."%' OR mobile LIKE '%".$escName."%')");
                      }
                      if(!empty($filter_college)) {
                        $escCollege = $db->escape($filter_college);
                        $db->where("college LIKE '%".$escCollege."%'");
                      }
                      if(!empty($filter_specialization)) {
                        $escSpec = $db->escape($filter_specialization);
                        $db->where("(branch LIKE '%".$escSpec."%' OR course LIKE '%".$escSpec."%')");
                      }
                      if(!empty($filter_year)) {
                        $escYear = $db->escape($filter_year);
                        $db->where("passing_year LIKE '%".$escYear."%'");
                      }

                      $db->orderBy('id', 'desc');
                      $aryData = $db->get(DBTAB);
                      if(is_array($aryData) && count($aryData)>0)
                      {
                        foreach($aryData as $iList)
                        {
                      ?>
                      <tr>
                        <td><?php echo $iList['id'];?></td>
                        <td>
                          <strong><?php echo htmlspecialchars(ucwords($iList['name'] ?? ''));?></strong>
                          <?php if(!empty($iList['enrollment_no'])): ?>
                            <br><span class="badge badge-info" style="font-size:11.5px;"><?php echo htmlspecialchars($iList['enrollment_no']);?></span>
                          <?php endif; ?>
                        </td>
                        <td><small><?php echo htmlspecialchars($iList['college'] ?: '-'); ?></small></td>
                        <td>
                          <strong><?php echo htmlspecialchars($iList['course'] ?: '-'); ?></strong>
                          <?php if(!empty($iList['branch'])): ?>
                            <br><small class="text-muted"><i class="mdi mdi-tag-outline"></i> <?php echo htmlspecialchars($iList['branch']); ?></small>
                          <?php endif; ?>
                        </td>
                        <td><span class="badge badge-light" style="font-size:12px;"><?php echo htmlspecialchars($iList['passing_year'] ?: '-');?></span></td>
                        <td>
                          <?php if(!empty($iList['mobile'])): ?>
                            <a href="tel:<?php echo htmlspecialchars($iList['mobile']); ?>"><i class="mdi mdi-phone"></i> <?php echo htmlspecialchars($iList['mobile']);?></a>
                          <?php endif; ?>
                          <?php if(!empty($iList['email'])): ?>
                            <br><small><a href="mailto:<?php echo htmlspecialchars($iList['email']); ?>" class="text-muted"><i class="mdi mdi-email-outline"></i> <?php echo htmlspecialchars($iList['email']);?></a></small>
                          <?php endif; ?>
                        </td>
                        <td><small><?php echo htmlspecialchars($iList['date'] ?: '-');?></small></td>
                        <td>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=view" class="btn btn-sm btn-success waves-effect waves-light" title="View Full Details"><i class="mdi mdi-eye"></i> View</a>
                          <a href="<?php echo PAGE;?>?id=<?php echo $iList['id']?>&action=delete" onclick="return confirm('Are you sure you want to delete this alumni registration?');" class="btn btn-sm btn-danger waves-effect waves-light" title="Delete Record"><i class="mdi mdi-delete"></i> Delete</a>
                        </td>
                      </tr>
                      <?php
                        }
                      }
                      else
                      {
                      ?>
                      <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                          <i class="mdi mdi-information-outline font-20"></i><br>
                          No Alumni Records Found Matching Your Filter Criteria.
                        </td>
                      </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- end col -->
        </div>
        <?php } ?>
        <!-- end row -->
      </div>
      <!-- container-fluid -->
    </div>
    <!-- content -->
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
<!-- Required datatable js --> 
<script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script> 
<!-- Buttons examples --> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.buttons.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script> 
<!-- Datatable init js --> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.js"></script> 
<script src="<?php echo URL_JS;?>datatables.init.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/jszip.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/pdfmake.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/vfs_fonts.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.html5.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.print.min.js"></script> 
<script src="<?php echo URL_PLUG;?>datatables/buttons.colVis.min.js"></script>
</body>
</html>
