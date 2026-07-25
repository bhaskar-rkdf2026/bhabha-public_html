<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Campus & Infrastructure - Bhabha University Bhopal</title>
<meta name="description" content="Explore Bhabha University's 150-acre green campus in Bhopal — state-of-the-art labs, smart classrooms, central library, hostels and sports facilities.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Campus & <em>Infrastructure</em>';
  $page_subtitle = 'A 150-acre green campus on Narmadapuram Road, Bhopal — built to inspire learning, innovation and holistic development.';
  $page_icon     = 'fa-building';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'Campus & Infrastructure', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'infrastructure'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Campus Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Our Campus</span>
        <h2 class="bu-content-h2">Campus & <em>Infrastructure</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            Bhabha University is spread across a vast <strong>150-acre green campus</strong> on NH-12, 
            Narmadapuram Road, Bhopal, Madhya Pradesh. The remarkable aspect of the campus is its 
            avant-grade infrastructure provided for both students and faculty. Fully furnished and 
            well-equipped laboratories grace every school building in the university.
          </p>
          <p>
            The campus is consolidated with abundant features supporting diverse events — 
            Auditorium, open spaces, outdoor stages, sports grounds and much more — creating an 
            environment where students thrive academically, socially, and professionally.
          </p>
        </div>
      </div>

      <!-- Campus Features Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Facilities</span>
        <h2 class="bu-content-h2">World-class <em>Facilities</em></h2>
        <div class="bu-content-divider"></div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;">
          <?php
          $facilities = [
            ['icon'=>'fa-flask','name'=>'120+ Research Labs','desc'=>'Cutting-edge laboratories for engineering, pharmacy, biotech, and applied sciences.'],
            ['icon'=>'fa-book','name'=>'Central Library','desc'=>'50,000+ books, e-journals, digital resources and INFLIBNET access.'],
            ['icon'=>'fa-wifi','name'=>'Wi-Fi Campus','desc'=>'24x7 high-speed internet connectivity across the entire 150-acre campus.'],
            ['icon'=>'fa-home','name'=>'Boys & Girls Hostels','desc'=>'Secure, comfortable accommodation with modern amenities for resident students.'],
            ['icon'=>'fa-tv','name'=>'Smart Classrooms','desc'=>'Digital classrooms with projectors, audio-visual aids and e-learning tools.'],
            ['icon'=>'fa-futbol-o','name'=>'Sports Complex','desc'=>'Cricket, football, basketball, badminton, indoor games and gymnasium.'],
            ['icon'=>'fa-leaf','name'=>'Green Campus','desc'=>'Eco-friendly campus with solar panels, waste management and botanical garden.'],
            ['icon'=>'fa-ambulance','name'=>'Medical Centre','desc'=>'On-campus health clinic with qualified medical staff for student welfare.'],
            ['icon'=>'fa-bank','name'=>'Bank & ATM','desc'=>'On-campus banking facility and 24-hour ATM for students and staff.'],
            ['icon'=>'fa-bus','name'=>'Transport Facility','desc'=>'University bus service covering major routes across Bhopal city.'],
            ['icon'=>'fa-coffee','name'=>'Cafeteria','desc'=>'Multiple food courts and canteens serving hygienic, nutritious meals.'],
            ['icon'=>'fa-music','name'=>'Auditorium','desc'=>'State-of-the-art auditorium for seminars, convocations, and cultural events.'],
          ];
          foreach($facilities as $f): ?>
          <div class="bu-fac-card">
            <div class="fac-icon-wrap">
              <i class="fa <?php echo $f['icon'];?> fac-icon"></i>
            </div>
            <h4 class="fac-title"><?php echo $f['name'];?></h4>
            <p class="fac-desc"><?php echo $f['desc'];?></p>
          </div>
          <?php endforeach; ?>
        </div>
        <style>
          .bu-fac-card {
            background: #F8FAFC;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 20px 16px;
            text-align: center;
            transition: all 0.25s ease;
            cursor: pointer;
          }
          .bu-fac-card:hover {
            background: #0A1B54 !important;
            border-color: #0A1B54 !important;
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(10, 27, 84, 0.15);
          }
          .bu-fac-card .fac-icon-wrap {
            width: 48px;
            height: 48px;
            background: rgba(10, 27, 84, 0.08);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            transition: all 0.25s ease;
          }
          .bu-fac-card .fac-icon {
            font-size: 20px;
            color: #0A1B54;
            transition: color 0.25s ease;
          }
          .bu-fac-card .fac-title {
            font-size: 13px;
            font-weight: 700;
            color: #061D7C;
            margin: 0 0 6px 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: color 0.25s ease;
          }
          .bu-fac-card .fac-desc {
            font-size: 12px;
            line-height: 1.55;
            color: #6B7280;
            margin: 0;
            transition: color 0.25s ease;
          }
          .bu-fac-card:hover .fac-icon-wrap {
            background: rgba(255, 193, 7, 0.18) !important;
          }
          .bu-fac-card:hover .fac-icon {
            color: #FFC107 !important;
          }
          .bu-fac-card:hover .fac-title {
            color: #ffffff !important;
          }
          .bu-fac-card:hover .fac-desc {
            color: rgba(255, 255, 255, 0.8) !important;
          }
        </style>
      </div>

      <!-- DB Infrastructure Items -->
      <?php
      $infrastructure = $db->get('infrastructure');
      if(is_array($infrastructure) && count($infrastructure) > 0) {
        foreach($infrastructure as $inf): ?>
        <div class="bu-content-card">
          <h2 class="bu-content-h2"><?php echo $inf['title'];?></h2>
          <div class="bu-content-divider"></div>
          <?php if($inf['image'] != ''): ?>
          <img src="<?php echo URL_UPLOAD;?>infrastructure/<?php echo $inf['image'];?>" 
               alt="<?php echo $inf['title'];?>"
               style="width:100%;max-width:500px;height:280px;object-fit:cover;border-radius:8px;box-shadow:0 8px 24px rgba(6,29,124,0.12);margin-bottom:20px;display:block;">
          <?php endif; ?>
          <div class="bu-content-body">
            <p><?php echo $inf['description'];?></p>
          </div>
        </div>
      <?php endforeach; } ?>

    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
