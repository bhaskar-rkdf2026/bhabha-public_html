<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Campus & Infrastructure - Bhabha University Bhopal</title>
<meta name="description" content="Explore Bhabha University's 32-acre lush green campus in Bhopal — state-of-the-art labs, smart classrooms, central library, hostels and sports facilities.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Campus & <em>Infrastructure</em>';
  $page_subtitle = 'A 32-acre lush green campus on Narmadapuram Road, Bhopal — built to inspire learning, innovation and holistic development.';
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
            Bhabha University is spread across a vast <strong>32-acre lush green campus</strong> on NH-12, 
            Narmadapuram Road, Bhopal, Madhya Pradesh. The remarkable aspect of the campus is its 
            avant-garde infrastructure provided for both students and faculty. Fully furnished and 
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
            ['icon'=>'fa-users','name'=>'Open Auditorium','desc'=>'Spacious open-air auditorium for student events, fests, gatherings and cultural activities.'],
            ['icon'=>'fa-wifi','name'=>'Wi-Fi Campus','desc'=>'24x7 high-speed internet connectivity across the entire 32-acre campus.'],
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
          .bu-content-card, .bu-fac-card {
            scroll-margin-top: 110px;
          }
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

      <!-- DB Infrastructure Items (Modern Card Layout) -->
      <div class="bu-content-card" style="padding: 26px 22px;">
        <span class="bu-content-label">Campus Amenities</span>
        <h2 class="bu-content-h2">Campus <em>Infrastructure &amp; Facilities</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-infra-grid">
          <?php
          $infrastructure = $db->get('infrastructure');
          if(is_array($infrastructure) && count($infrastructure) > 0) {
            foreach($infrastructure as $inf): 
              $cardSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inf['title'])));
              $rawDesc = strip_tags($inf['description']);
              $words = explode(' ', trim($rawDesc));
              $wordCount = count($words);
              $isLong = $wordCount > 30;
              $shortDesc = $isLong ? implode(' ', array_slice($words, 0, 30)) . '...' : $rawDesc;
            ?>
            <div class="bu-infra-card" id="<?php echo $cardSlug; ?>">
              
              <!-- Card Media Header (Compact Fixed-Ratio Frame for Crisp Images) -->
              <div class="bu-infra-media">
                <?php if(!empty($inf['image'])): ?>
                  <img src="<?php echo URL_UPLOAD;?>infrastructure/<?php echo $inf['image'];?>" 
                       alt="<?php echo htmlspecialchars($inf['title']);?>"
                       class="bu-infra-img"
                       loading="lazy"
                       onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                  <div class="bu-infra-placeholder" style="display:none;">
                    <i class="fa fa-university"></i>
                    <span>Bhabha University</span>
                  </div>
                <?php else: ?>
                  <div class="bu-infra-placeholder">
                    <i class="fa fa-university"></i>
                    <span>Bhabha University</span>
                  </div>
                <?php endif; ?>
                <span class="bu-infra-badge"><i class="fa fa-building-o"></i> Facility</span>
              </div>

              <!-- Card Body -->
              <div class="bu-infra-body">
                <h3 class="bu-infra-title"><?php echo htmlspecialchars($inf['title']); ?></h3>
                <div class="bu-infra-divider"></div>
                <div class="bu-infra-desc">
                  <?php echo nl2br(htmlspecialchars($shortDesc)); ?>
                </div>

                <div class="bu-infra-footer">
                  <?php if($isLong): ?>
                    <button type="button" class="bu-infra-btn-more" 
                            onclick="openInfraModal(<?php echo htmlspecialchars(json_encode($inf['title']), ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars(json_encode($inf['description']), ENT_QUOTES, 'UTF-8'); ?>)">
                      Read More <i class="fa fa-angle-right"></i>
                    </button>
                  <?php else: ?>
                    <span class="bu-infra-status"><i class="fa fa-check-circle"></i> Available on Campus</span>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          <?php endforeach; } ?>
        </div>
      </div>

      <!-- Infrastructure Details Modal -->
      <div id="buInfraModalBackdrop" class="bu-infra-modal-backdrop" onclick="closeInfraModal(event)">
        <div class="bu-infra-modal-card" onclick="event.stopPropagation()">
          <button type="button" class="bu-infra-modal-close" onclick="closeInfraModal()" aria-label="Close">&times;</button>
          <span class="bu-content-label" style="margin-bottom:8px;">Campus Facility</span>
          <h3 id="buInfraModalTitle" class="bu-infra-modal-title"></h3>
          <div class="bu-content-divider" style="margin-bottom:14px;"></div>
          <div id="buInfraModalBody" class="bu-infra-modal-body"></div>
        </div>
      </div>

      <style>
      .bu-infra-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 22px;
        margin-top: 16px;
      }
      .bu-infra-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(6, 29, 124, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
      }
      .bu-infra-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(6, 29, 124, 0.12);
        border-color: #FFC107;
      }
      .bu-infra-media {
        position: relative;
        width: 100%;
        height: 190px;
        overflow: hidden;
        background: #0A1B54;
      }
      .bu-infra-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        image-rendering: -webkit-optimize-contrast;
        transition: transform 0.4s ease;
        display: block;
      }
      .bu-infra-card:hover .bu-infra-img {
        transform: scale(1.05);
      }
      .bu-infra-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, #0A1B54 0%, #153285 100%);
        color: rgba(255, 255, 255, 0.9);
      }
      .bu-infra-placeholder i {
        font-size: 36px;
        color: #FFC107;
      }
      .bu-infra-placeholder span {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
      }
      .bu-infra-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(6, 29, 124, 0.85);
        backdrop-filter: blur(4px);
        color: #FFC107;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 20px;
        border: 1px solid rgba(255, 193, 7, 0.3);
      }
      .bu-infra-body {
        padding: 18px 16px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
      }
      .bu-infra-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 17px;
        font-weight: 800;
        color: #061D7C;
        margin: 0 0 8px 0;
        line-height: 1.25;
      }
      .bu-infra-divider {
        width: 32px;
        height: 2px;
        background: #FFC107;
        border-radius: 2px;
        margin-bottom: 12px;
      }
      .bu-infra-desc {
        font-size: 12.5px;
        line-height: 1.6;
        color: #4B5563;
        flex-grow: 1;
        margin-bottom: 14px;
      }
      .bu-infra-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 1px solid #F1F5F9;
        margin-top: auto;
      }
      .bu-infra-status {
        font-size: 11px;
        font-weight: 700;
        color: #059669;
        display: inline-flex;
        align-items: center;
        gap: 5px;
      }
      .bu-infra-btn-more {
        background: transparent;
        border: none;
        color: #061D7C;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        padding: 0;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s, transform 0.2s;
      }
      .bu-infra-btn-more:hover {
        color: #D99B00;
        transform: translateX(3px);
      }

      /* Modal Popup */
      .bu-infra-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(4, 15, 74, 0.7);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 100000;
        padding: 20px;
      }
      .bu-infra-modal-backdrop.active {
        display: flex;
      }
      .bu-infra-modal-card {
        background: #ffffff;
        border-radius: 16px;
        max-width: 620px;
        width: 100%;
        max-height: 85vh;
        overflow-y: auto;
        padding: 28px 24px;
        position: relative;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        animation: buModalIn 0.25s ease-out;
      }
      @keyframes buModalIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
      }
      .bu-infra-modal-close {
        position: absolute;
        top: 16px;
        right: 18px;
        background: #F1F5F9;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #061D7C;
        transition: all 0.2s;
      }
      .bu-infra-modal-close:hover {
        background: #FFC107;
        color: #000;
      }
      .bu-infra-modal-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 22px;
        font-weight: 800;
        color: #061D7C;
        margin: 0 0 8px 0;
        padding-right: 35px;
      }
      .bu-infra-modal-body {
        font-size: 13.5px;
        line-height: 1.7;
        color: #374151;
        margin-top: 14px;
      }

      @media(max-width: 576px) {
        .bu-infra-grid {
          grid-template-columns: 1fr;
          gap: 16px;
        }
        .bu-infra-media {
          height: 170px;
        }
      }
      </style>

      <script>
      function openInfraModal(title, description) {
        var modal = document.getElementById('buInfraModalBackdrop');
        var titleEl = document.getElementById('buInfraModalTitle');
        var bodyEl = document.getElementById('buInfraModalBody');
        if (modal && titleEl && bodyEl) {
          titleEl.textContent = title;
          bodyEl.innerHTML = description;
          modal.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      }
      function closeInfraModal(e) {
        if (e && e.target && !e.target.classList.contains('bu-infra-modal-backdrop') && !e.target.classList.contains('bu-infra-modal-close')) {
          return;
        }
        var modal = document.getElementById('buInfraModalBackdrop');
        if (modal) {
          modal.classList.remove('active');
          document.body.style.overflow = '';
        }
      }
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeInfraModal();
      });
      </script>

    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
