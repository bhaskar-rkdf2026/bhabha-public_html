<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Approvals & Recognitions - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University holds approvals from UGC, AICTE, PCI, BCI, DCI, NCTE, INC and is NAAC accredited. Explore all official recognitions.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Approvals & <em>Recognitions</em>';
  $page_subtitle = 'Bhabha University holds statutory approvals from India\'s premier regulatory bodies — ensuring quality, credibility and global acceptance of our programmes.';
  $page_icon     = 'fa-certificate';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'Approvals & Recognitions', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'approvals'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Accreditations Strip -->
      <div class="bu-content-card" style="background:linear-gradient(135deg,#0A1B54,#061D7C); border-color:#0A1B54; margin-bottom:24px;">
        <h2 style="font-family:'Playfair Display',serif;font-size:22px;font-weight:800;color:#fff;margin:0 0 20px 0;">Our Key <span style="color:#FFC107;">Accreditations</span></h2>
        <div style="display:flex;gap:16px;flex-wrap:wrap;">
          <?php
          $badges = [
            ['name'=>'NAAC', 'desc'=>'Accredited'],
            ['name'=>'UGC',  'desc'=>'2(f) & 12(B)'],
            ['name'=>'AICTE','desc'=>'Approved'],
            ['name'=>'PCI',  'desc'=>'Approved'],
            ['name'=>'BCI',  'desc'=>'Approved'],
            ['name'=>'DCI',  'desc'=>'Approved'],
            ['name'=>'NCTE', 'desc'=>'Approved'],
            ['name'=>'INC',  'desc'=>'Approved'],
            ['name'=>'MPNRC','desc'=>'Recognized'],
          ];
          foreach($badges as $b): ?>
          <div style="background:rgba(255,193,7,0.1);border:1px solid rgba(255,193,7,0.25);border-radius:6px;padding:14px 18px;text-align:center;min-width:90px;">
            <span style="font-family:'Playfair Display',serif;font-size:20px;font-weight:800;color:#FFC107;display:block;line-height:1;margin-bottom:5px;"><?php echo $b['name'];?></span>
            <span style="font-size:9px;font-weight:800;letter-spacing:1px;color:rgba(255,255,255,0.55);text-transform:uppercase;"><?php echo $b['desc'];?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Documents List -->
      <style>
      .bu-approvals-filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
        align-items: center;
      }
      .bu-filter-btn {
        background: #F1F5F9;
        color: #0A1B54;
        border: 1px solid #CBD5E1;
        padding: 7px 15px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
      }
      .bu-filter-btn .bu-count-pill {
        background: rgba(10, 27, 84, 0.1);
        color: #0A1B54;
        padding: 1px 7px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 800;
        transition: all 0.2s ease;
      }
      .bu-filter-btn:hover,
      .bu-filter-btn.active {
        background: #0A1B54;
        color: #FFC107;
        border-color: #0A1B54;
      }
      .bu-filter-btn:hover .bu-count-pill,
      .bu-filter-btn.active .bu-count-pill {
        background: #FFC107;
        color: #0A1B54;
      }
      .bu-approvals-search-box {
        width: 100%;
        margin-bottom: 18px;
        position: relative;
      }
      .bu-approvals-search-box input {
        width: 100%;
        padding: 11px 16px 11px 40px;
        border-radius: 8px;
        border: 1px solid #CBD5E1;
        font-size: 13.5px;
        background: #FFFFFF;
        box-sizing: border-box;
      }
      .bu-approvals-search-box i {
        position: absolute;
        left: 14px;
        top: 14px;
        color: #94A3B8;
        font-size: 14px;
      }
      .bu-approval-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        background: #F8FAFC;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        border-left: 4px solid #FFC107;
        text-decoration: none;
        transition: all 0.25s ease;
        box-sizing: border-box;
      }
      .bu-approval-card.bu-is-hidden {
        display: none !important;
      }
      .bu-approval-card .bu-app-title {
        font-size: 14px;
        font-weight: 700;
        color: #0A1B54;
        display: block;
        line-height: 1.4;
        transition: color 0.25s ease;
      }
      .bu-approval-card .bu-app-sub {
        font-size: 11.5px;
        color: #64748B;
        display: block;
        line-height: 1.3;
        margin-top: 3px;
        transition: color 0.25s ease;
      }
      .bu-approval-card .bu-app-icon {
        font-size: 24px;
        color: #D99B00;
        flex-shrink: 0;
        transition: color 0.25s ease;
      }
      .bu-approval-card .bu-app-link-icon {
        font-size: 14px;
        color: #D99B00;
        flex-shrink: 0;
        transition: color 0.25s ease;
      }
      .bu-session-tag {
        display: inline-block;
        padding: 2px 8px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
        border-radius: 4px;
        background: rgba(16, 185, 129, 0.12);
        color: #059669;
        margin-left: 6px;
        text-transform: uppercase;
      }

      /* Hover State - White Title, Gold Icons & Subtitle on Dark Navy Card */
      .bu-approval-card:hover,
      .bu-approval-card:focus,
      .bu-approval-card:active {
        background: #0A1B54 !important;
        border-color: #0A1B54 !important;
        border-left-color: #FFC107 !important;
        transform: translateX(4px) !important;
        box-shadow: 0 6px 18px rgba(10, 27, 84, 0.25) !important;
      }
      .bu-approval-card:hover *,
      .bu-approval-card:focus *,
      .bu-approval-card:active *,
      .bu-approval-card:hover .bu-app-title {
        color: #FFFFFF !important;
      }
      .bu-approval-card:hover .bu-app-sub {
        color: #FFC107 !important;
        opacity: 0.9 !important;
      }
      .bu-approval-card:hover .bu-app-icon,
      .bu-approval-card:hover .bu-app-link-icon,
      .bu-approval-card:hover i,
      .bu-approval-card:focus i,
      .bu-approval-card:active i {
        color: #FFC107 !important;
      }
      .bu-approval-card:hover .bu-session-tag {
        background: #FFC107 !important;
        color: #0A1B54 !important;
      }
      </style>

      <div class="bu-content-card">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;margin-bottom:12px;gap:10px;">
          <div>
            <span class="bu-content-label">Regulatory Compliance</span>
            <h2 class="bu-content-h2" style="margin-bottom:0;">Approvals &amp; <em>Recognitions (2026-27)</em></h2>
          </div>
          <span style="font-size:12px;font-weight:700;color:#059669;background:#ECFDF5;padding:4px 12px;border-radius:20px;border:1px solid #A7F3D0;">
            <i class="fa fa-check-circle"></i> 2026-27 Session Updated
          </span>
        </div>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">

          <!-- Search Filter Box -->
          <div class="bu-approvals-search-box">
            <i class="fa fa-search"></i>
            <input type="text" id="buApprovalSearch" placeholder="Search approvals by college, authority (AICTE, PCI, BCI, NCH, Paramedical)..." oninput="filterApprovals()">
          </div>

          <!-- Quick Category Filters -->
          <div class="bu-approvals-filter-bar">
            <button type="button" class="bu-filter-btn active" onclick="setApprovalFilter('all', this)">All Approvals <span class="bu-count-pill">23</span></button>
            <button type="button" class="bu-filter-btn" onclick="setApprovalFilter('aicte', this)">AICTE EOA (2026-27) <span class="bu-count-pill">7</span></button>
            <button type="button" class="bu-filter-btn" onclick="setApprovalFilter('pci', this)">Pharmacy (PCI) <span class="bu-count-pill">5</span></button>
            <button type="button" class="bu-filter-btn" onclick="setApprovalFilter('medical', this)">Medical &amp; Nursing <span class="bu-count-pill">3</span></button>
            <button type="button" class="bu-filter-btn" onclick="setApprovalFilter('law', this)">Law (BCI) <span class="bu-count-pill">1</span></button>
            <button type="button" class="bu-filter-btn" onclick="setApprovalFilter('education', this)">Education (NCTE) <span class="bu-count-pill">2</span></button>
            <button type="button" class="bu-filter-btn" onclick="setApprovalFilter('statutory', this)">UGC &amp; Statutory <span class="bu-count-pill">5</span></button>
          </div>

        <?php
        $approvals = $db->get('approvals');
        if(is_array($approvals) && count($approvals) > 0) {
          echo '<div style="display:grid;gap:12px;" id="buApprovalsList">';
          foreach($approvals as $iapprovals) { 
            $img = trim($iapprovals['image'] ?? '');
            $file_url = '';
            if (!empty($img)) {
              if (file_exists(PATH_ROOT . DS . 'upload' . DS . 'approvals' . DS . $img)) {
                $file_url = URL_UPLOAD . 'approvals/' . rawurlencode($img);
              } elseif (file_exists(PATH_ROOT . DS . 'new-media' . DS . 'pdf' . DS . $img)) {
                $file_url = URL_ROOT . 'new-media/pdf/' . rawurlencode($img);
              } else {
                $file_url = URL_UPLOAD . 'approvals/' . rawurlencode($img);
              }
            }

            // Determine filter category tag
            $t = strtolower($iapprovals['title'] . ' ' . ($iapprovals['description'] ?? ''));
            $cat = 'statutory';
            if (strpos($t, 'pci') !== false || strpos($t, 'pharmacy') !== false) {
              $cat = 'pci';
            } elseif (strpos($t, 'aicte') !== false || strpos($t, 'eoa') !== false) {
              $cat = 'aicte';
            } elseif (strpos($t, 'bci') !== false || strpos($t, 'law') !== false) {
              $cat = 'law';
            } elseif (strpos($t, 'ncte') !== false || strpos($t, 'b.ed') !== false || strpos($t, 'm.ed') !== false) {
              $cat = 'education';
            } elseif (strpos($t, 'homoeopathic') !== false || strpos($t, 'hmc') !== false || strpos($t, 'paramedical') !== false || strpos($t, 'mpnrc') !== false || strpos($t, 'nursing') !== false) {
              $cat = 'medical';
            } elseif (strpos($t, 'ugc') !== false || strpos($t, 'statute') !== false || strpos($t, 'gazette') !== false || strpos($t, 'rajpatra') !== false || strpos($t, 'mppurc') !== false || strpos($t, 'notification') !== false) {
              $cat = 'statutory';
            }

            $is2026 = (strpos($t, '2026') !== false || strpos($t, '2025-26') !== false || strpos($t, '2026-27') !== false);
          ?>
          <a target="_blank" 
             href="<?php echo $file_url; ?>"
             class="bu-approval-card"
             data-cat="<?php echo $cat; ?>"
             data-title="<?php echo htmlspecialchars(strtolower($iapprovals['title'] . ' ' . ($iapprovals['description'] ?? ''))); ?>">
            <i class="fa fa-file-pdf-o bu-app-icon"></i>
            <div style="flex:1;">
              <span class="bu-app-title">
                <?php echo htmlspecialchars($iapprovals['title']); ?>
                <?php if($is2026): ?>
                  <span class="bu-session-tag">2026-27</span>
                <?php endif; ?>
              </span>
              <span class="bu-app-sub"><?php echo !empty($iapprovals['description']) ? htmlspecialchars($iapprovals['description']) : 'Click to view / download official document'; ?></span>
            </div>
            <i class="fa fa-external-link bu-app-link-icon"></i>
          </a>
          <?php }
          echo '</div>';
          
          // No results message container
          echo '<div id="buNoApprovalsNotice" style="display:none;padding:30px;text-align:center;background:#F8FAFC;border:1px dashed #CBD5E1;border-radius:8px;margin-top:10px;">
                  <i class="fa fa-search" style="font-size:24px;color:#94A3B8;margin-bottom:8px;display:block;"></i>
                  <p style="margin:0;color:#64748B;font-size:14px;font-weight:600;">No approvals found matching your search.</p>
                </div>';
        } ?>

        </div>
      </div>

      <script>
      var currentApprovalCat = 'all';

      function applyApprovalFilters() {
        var searchInput = document.getElementById('buApprovalSearch');
        var query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        var cards = document.querySelectorAll('.bu-approval-card');
        var visibleCount = 0;

        cards.forEach(function(card) {
          var cardCat = card.getAttribute('data-cat') || '';
          var title = card.getAttribute('data-title') || '';
          var matchesCat = (currentApprovalCat === 'all' || cardCat === currentApprovalCat);
          var matchesQuery = (query === '' || title.indexOf(query) !== -1);

          if (matchesCat && matchesQuery) {
            card.classList.remove('bu-is-hidden');
            card.style.display = 'flex';
            visibleCount++;
          } else {
            card.classList.add('bu-is-hidden');
            card.style.display = 'none';
          }
        });

        var emptyNotice = document.getElementById('buNoApprovalsNotice');
        if (emptyNotice) {
          emptyNotice.style.display = (visibleCount === 0) ? 'block' : 'none';
        }
      }

      function setApprovalFilter(cat, btn) {
        currentApprovalCat = cat;
        document.querySelectorAll('.bu-filter-btn').forEach(function(b){ 
          b.classList.remove('active'); 
        });
        if(btn) {
          btn.classList.add('active');
        }
        applyApprovalFilters();
      }

      function filterApprovals() {
        applyApprovalFilters();
      }
      </script>

    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
