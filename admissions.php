<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('admissions') : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo portalVal($portalPage, 'page_title', 'Admission 2021 Apply Now | - Bhabha University Bhopal Madhya Pradesh'); ?></title>
    <!-- Bootstrap core CSS -->
    <?php include('inc.meta.php');?>
    </head>

    <body>
<!--KF KODE WRAPPER WRAP START-->
<div class="kode_wrapper"> 
      <!-- register Modal --> 
      <!--HEADER START-->
      <?php include('inc.header.php');?>
      <!--HEADER END-->
      <div class="kf_inr_banner">
    <div class="container">
          <div class="row">
        <div class="col-md-12"> 
              <!--KF INR BANNER DES Wrap Start-->
              <div class="kf_inr_ban_des">
            <div class="inr_banner_heading">
                  <h3><?php echo strip_tags(portalVal($portalPage, 'heading', 'Admissions')); ?></h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#"><?php echo strip_tags(portalVal($portalPage, 'heading', 'Admissions')); ?></a></li>
              </ul>
                </div>
          </div>
              <!--KF INR BANNER DES Wrap End--> 
            </div>
      </div>
        </div>
  </div>
      <div class="kf_content_wrap"> 
    
    <!--ABOUT UNIVERSITY START-->
    <section>
          <div class="container">
        <div class="row">
              <div class="col-md-12">
            <div class="abt_univ_wrap"> 
                  <!-- HEADING 1 START-->
                  <div class="kf_edu2_heading1">
                <h5><?php echo portalVal($portalPage, 'badge', 'BHABHA UNIVERSITY'); ?></h5>
                <h3><?php echo portalVal($portalPage, 'heading', 'ADMISSION RULES/PROCEDURES/GUIDELINES'); ?></h3>
              </div>
                  <!-- HEADING 1 END-->
                  
                  <div class="abt_univ_des"> 
                    <?php if (!empty($portalPage['data']['steps']) && is_array($portalPage['data']['steps'])): ?>
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin:20px 0 35px 0;">
                      <?php foreach ($portalPage['data']['steps'] as $st): ?>
                      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-top:3px solid #0A1B54;border-radius:8px;padding:20px 18px;">
                        <span style="display:inline-block;font-size:18px;font-weight:800;color:#FFC107;font-family:'Playfair Display',serif;margin-bottom:8px;"><?php echo htmlspecialchars($st['step'] ?? ''); ?></span>
                        <h4 style="font-size:15px;font-weight:700;color:#0A1B54;margin:0 0 6px 0;"><?php echo htmlspecialchars($st['title'] ?? ''); ?></h4>
                        <p style="font-size:13px;line-height:1.6;color:#64748B;margin:0;"><?php echo htmlspecialchars($st['desc'] ?? ''); ?></p>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($portalPage['data']['body'])): ?>
                      <div style="font-size:15px;line-height:1.8;color:#475569;margin-bottom:24px;">
                        <?php echo $portalPage['data']['body']; ?>
                      </div>
                    <?php else: ?>
                    <span>For information about the courses offered under various Constituent Institutions and Teaching Departments of the University along with details like admission rules, seat intake, minimum eligibility criteria for admission, and basis of seat allotment, please refer to the official Bhabha University Website.</span>
                <p><strong>Process of counseling and admissions starts from 1st April and continues till the last date of admissions.</strong> It will be held on every working day of the University on the basis of merit marks obtained in the entrance examination (if required) or on the basis of marks obtained in the qualifying examination.</p>
                <p>In case of special circumstances, the University may also conduct Online Counselling with due approvals. After online counselling, students must submit all original documents for verification to the counseling department.</p>
                <ul type="circle" style="padding-left:80px;">
                       <li>Original TC/Leaving Certificate, Character Certificate and Migration Certificate will be submitted in the allotted constituent institutions or teaching departments.</li>
                      <li>Seat allotment in courses will be done — first on the basis of marks obtained in the entrance examination (if required) and thereafter for all remaining seats on the basis of marks obtained in the qualifying examination.</li>
                      <li>Seat allotment for reserved category will be done as per the ordinance of Bhabha University which complies with respective Regulatory Bodies / Govt. of Madhya Pradesh directives.</li>
                      <li>Applicants shall ensure fulfillment of minimum educational qualification eligibility and age requirements at the time of application submission. The admission of the applicant will be confirmed only on fulfillment of minimum eligibility criteria and submission of fees.</li>
                      <li>At the time of admission confirmation, applicants shall submit original documents of Transfer Certificate, Character Certificate, Migration Certificate, five passport photos, online/offline Anti-Ragging affidavit, first semester/year tuition fees, Hostel or Transport Fees (if applicable) and other university fees at the Counseling Office. Verification of all documents will be carried out in the allotted constituent institution or teaching department, and applicants shall submit two sets of self-attested photocopies of all documents.</li>
                      <li>Applicants shall ensure to fill correct permanent address, telephone numbers, mobile numbers, email ID, Aadhaar number and blood group at the time of admission in the Application Form and Online ERP Section.</li>
                      <li>The University administration reserves the right to modify admission guidelines from time to time, which shall be displayed and confirmed on the University Website.</li>
                      <li>Applicants and parents are advised to visit the university website regularly for updates.</li>
                      <li>In case of cancellation of admission, candidate needs to apply for cancellation of admission to the counseling office of the university at least 6 days before the last date of admission. Tuition fees will be refunded after 10% deduction, but other fees are non-refundable.</li>
                    </ul>
                <p>Please enclose two sets of self-attested photocopies of all documents along with the application form:</p>
                <ol style="padding-left:80px;">
                      <li>Valid admit card and merit score of entrance examination (if applicable)</li>
                      <li>Mark sheet of qualifying examination</li>
                      <li>Mark sheet of Higher secondary examination or 10+2 examination</li>
                      <li>Mark sheet of 10th examination or secondary examination</li>
                      <li>Domicile certificate</li>
                      <li>Caste certificate issued by competent authority (if applicable)</li>
                      <li>Income certificate issued by competent authority (if applicable)</li>
                      <li>Percentage/marks conversion authorized documents of respective Board/University (Applicable only in case Grade based mark sheet)</li>
                      <li>Permanent address proof</li>
                      <li>Aadhar Card</li>
                      <li>Five colour passport size photographs</li>
                    </ol>
                <p>Documents required in original form: </p>
                <ul style="padding-left:80px;">
                      <li>Original Anti-Ragging Affidavits of Student and Parent</li>
                      <li>Original TC/College or School Leaving Certificate.</li>
                      <li>Original Character Certificate</li>
                      <li>Original Migration Certificate</li>
                    </ul>
                <p>List of original documents required for verification </p>
                <ol style="padding-left:80px;">
                      <li>Valid admit card and merit score of entrance examination (if applicable)</li>
                      <li>Mark sheet of qualifying examination</li>
                      <li>Mark sheet of Higher secondary examination or 10+2 examination</li>
                      <li>Mark sheet of 10th examination or secondary examination</li>
                      <li>Domicile certificate</li>
                      <li>Caste certificate issued by competent authority (if applicable)</li>
                      <li>Income certificate issued by competent authority (if applicable)</li>
                      <li>Percentage/marks conversion authorized documents of respective Board/University (Applicable only in case Grade based mark sheet)</li>
                      <li>Permanent address proof</li>
                      <li>Aadhar Card</li>
                    </ol>
                <strong>On recommendation of respective Councils/ Govt. of Madhya Pradesh/ Madhya Pradesh Private University Regulatory Commission, there can be change in University Admission Guidelines 2020-21 for Seat intake capacity, courses, Admission dates and procedure and minimum eligibility criteria. The changes shall be updated regularly and could be seen on University website, from time to time. </strong><br> <strong>In case of any dispute, the final decision will be of the Vice Chancellor of Bhabha University Bhopal</strong>
                <?php endif; ?>
              </div>
                </div>
          </div>
            </div>
      </div>
        </section>
    <!--ABOUT UNIVERSITY END--> 
    
  </div>
      <!--NEWS LETTERS END--> 
      <!--FOOTER START-->
      <?php include('inc.footer.php');?>
      
      <!--FOOTER END--> 
      <!--COPYRIGHTS START--> 
      
      <!--COPYRIGHTS START--> 
    </div>
<!--KF KODE WRAPPER WRAP END--> 
<!--Bootstrap core JavaScript-->
<?php include('inc.footer.js.php');?>
</body>
</html>
