<?php 
include('config.php');

function parseAwardDescription($descHtml) {
    if (empty(trim((string)$descHtml))) return [];
    
    // Convert absolute localhost upload urls to clean URL_UPLOAD
    $descHtml = preg_replace('/https?:\/\/[^\/]+\/[^\/]+\/upload\//i', URL_UPLOAD, $descHtml);
    
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="utf-8" ?><div>' . $descHtml . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();
    
    $items = [];
    $currentText = '';
    $currentImg = '';
    
    $xpath = new DOMXPath($doc);
    $nodes = $xpath->query('//li | //p');
    
    if ($nodes->length === 0) {
        return [['text' => strip_tags($descHtml), 'img' => '']];
    }
    
    foreach ($nodes as $node) {
        $imgNodes = $node->getElementsByTagName('img');
        $hasImg = $imgNodes->length > 0;
        
        if ($hasImg) {
            $imgSrc = $imgNodes->item(0)->getAttribute('src');
            $clone = $node->cloneNode(true);
            $imgsToRemove = $clone->getElementsByTagName('img');
            while ($imgsToRemove->length > 0) {
                $imgsToRemove->item(0)->parentNode->removeChild($imgsToRemove->item(0));
            }
            $nodeText = trim($clone->textContent);
            $cleaned = trim(str_replace(["\xc2\xa0", "&nbsp;"], ' ', $nodeText));
            
            if (!empty($cleaned)) {
                if (!empty($currentText) || !empty($currentImg)) {
                    $items[] = ['text' => $currentText, 'img' => $currentImg];
                    $currentText = '';
                    $currentImg = '';
                }
                $items[] = ['text' => $cleaned, 'img' => $imgSrc];
            } else {
                if (!empty($currentText)) {
                    $currentImg = $imgSrc;
                    $items[] = ['text' => $currentText, 'img' => $currentImg];
                    $currentText = '';
                    $currentImg = '';
                } else {
                    $items[] = ['text' => '', 'img' => $imgSrc];
                }
            }
        } else {
            $nodeText = trim($node->textContent);
            $cleaned = trim(str_replace(["\xc2\xa0", "&nbsp;"], ' ', $nodeText));
            if (!empty($cleaned)) {
                if (!empty($currentText)) {
                    $items[] = ['text' => $currentText, 'img' => $currentImg];
                    $currentText = '';
                    $currentImg = '';
                }
                $currentText = $cleaned;
            }
        }
    }
    
    if (!empty($currentText) || !empty($currentImg)) {
        $items[] = ['text' => $currentText, 'img' => $currentImg];
    }
    
    return $items;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Awards &amp; Achievements - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University has been recognised for excellence with national and international awards. Explore our achievements and accolades.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Awards &amp; <em>Achievements</em>';
  $page_subtitle = 'Recognitions that reflect our commitment to excellence in education, research, and community service.';
  $page_icon     = 'fa-trophy';
  $breadcrumbs   = [
    ['label' => 'Home',     'url' => URL_ROOT],
    ['label' => 'About',    'url' => href('about.php')],
    ['label' => 'Awards & Achievements', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'awards'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      
      <!-- Top Overview Banner -->
      <div class="bu-content-card" style="padding: 28px 24px; margin-bottom: 24px;">
        <span class="bu-content-label">Honours &amp; Recognition</span>
        <h2 class="bu-content-h2">Awards &amp; <em>Achievements</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p style="font-size: 15px; color: #4B5563; line-height: 1.7; margin-bottom: 20px;">
            Bhabha University and its distinguished faculty members are consistently honored with state, national, and international accolades for groundbreaking research, educational excellence, institutional innovation, and societal impact.
          </p>

          <!-- 3 Quick Highlight Badges -->
          <div class="bu-award-stats-grid">
            <div class="bu-award-stat-box">
              <div class="bu-award-stat-icon"><i class="fa fa-trophy"></i></div>
              <div class="bu-award-stat-info">
                <h4>National &amp; State Awards</h4>
                <p>Recognitions across engineering, health &amp; sciences</p>
              </div>
            </div>
            <div class="bu-award-stat-box">
              <div class="bu-award-stat-icon"><i class="fa fa-star"></i></div>
              <div class="bu-award-stat-info">
                <h4>Eminent Scholars</h4>
                <p>Faculty &amp; scientists honored for academic leadership</p>
              </div>
            </div>
            <div class="bu-award-stat-box">
              <div class="bu-award-stat-icon"><i class="fa fa-certificate"></i></div>
              <div class="bu-award-stat-info">
                <h4>World Record Accolades</h4>
                <p>Iconic achievements in the field of higher education</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Awards List / Showcase -->
      <div class="bu-awards-stack">
        <?php
        $awards = $db->get('awards');
        if(is_array($awards) && count($awards) > 0) {
          foreach($awards as $iawards) {
            $hasImg = !empty($iawards['image']);
            $subAwards = parseAwardDescription($iawards['description']);
        ?>
        <div class="bu-award-card">
          
          <!-- Card Header: Profile/Award Image & Recipient Details -->
          <div class="bu-award-header">
            <div class="bu-award-media">
              <?php if($hasImg): ?>
                <img src="<?php echo URL_UPLOAD;?>awards/<?php echo $iawards['image']?>" 
                     alt="<?php echo htmlspecialchars($iawards['title'] ?? ''); ?>"
                     class="bu-award-img"
                     loading="lazy"
                     onerror="this.parentElement.innerHTML='<div class=\'bu-award-img-ph\'><i class=\'fa fa-trophy\'></i></div>';">
              <?php else: ?>
                <div class="bu-award-img-ph">
                  <i class="fa fa-trophy"></i>
                </div>
              <?php endif; ?>
            </div>

            <div class="bu-award-meta-wrap">
              <span class="bu-award-pill"><i class="fa fa-trophy"></i> Recognition &amp; Honour</span>
              <h3 class="bu-award-title"><?php echo htmlspecialchars($iawards['title'] ?? ''); ?></h3>
              
              <?php if(!empty($iawards['name'])): ?>
                <div class="bu-award-recipient">
                  <i class="fa fa-user-circle"></i>
                  <span><?php echo htmlspecialchars($iawards['name']); ?></span>
                </div>
              <?php endif; ?>

              <?php if(!empty($iawards['designation'])): ?>
                <div class="bu-award-desig">
                  <i class="fa fa-briefcase"></i>
                  <span><?php echo htmlspecialchars($iawards['designation']); ?></span>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Structured Subcards: Certificate Image + Citation Description in Same Unit -->
          <?php if (!empty($subAwards)): ?>
            <div class="bu-award-subcards-grid">
              <?php foreach ($subAwards as $idx => $sub): 
                $hasCertImg = !empty($sub['img']);
                $subText = trim($sub['text']);
                if (empty($subText) && !$hasCertImg) continue;
              ?>
                <div class="bu-cert-card <?php echo $hasCertImg ? 'has-cert-image' : 'text-only-cert'; ?>">
                  <?php if ($hasCertImg): ?>
                    <div class="bu-cert-thumb-wrap" onclick="openCertModal(<?php echo htmlspecialchars(json_encode($sub['img']), ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars(json_encode(!empty($subText) ? $subText : $iawards['title']), ENT_QUOTES, 'UTF-8'); ?>)">
                      <img src="<?php echo htmlspecialchars($sub['img']); ?>" alt="Award Certificate" class="bu-cert-thumb" loading="lazy">
                      <div class="bu-cert-zoom-overlay">
                        <i class="fa fa-search-plus"></i>
                        <span>View Certificate</span>
                      </div>
                    </div>
                  <?php endif; ?>

                  <div class="bu-cert-details">
                    <div class="bu-cert-pill">
                      <i class="fa fa-certificate"></i> Award Citation
                    </div>
                    <?php if (!empty($subText)): ?>
                      <p class="bu-cert-text"><?php echo nl2br(htmlspecialchars($subText)); ?></p>
                    <?php else: ?>
                      <p class="bu-cert-text">Honoured with prestigious award and recognition.</p>
                    <?php endif; ?>

                    <?php if ($hasCertImg): ?>
                      <button type="button" class="bu-cert-btn-zoom" onclick="openCertModal(<?php echo htmlspecialchars(json_encode($sub['img']), ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars(json_encode(!empty($subText) ? $subText : $iawards['title']), ENT_QUOTES, 'UTF-8'); ?>)">
                        <i class="fa fa-expand"></i> View Full Certificate
                      </button>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="bu-award-body">
              <?php echo $iawards['description']; ?>
            </div>
          <?php endif; ?>

          <!-- Card Footer -->
          <div class="bu-award-footer">
            <span class="bu-award-tag"><i class="fa fa-check-circle"></i> Verified University Achievement</span>
            <span class="bu-award-campus"><i class="fa fa-university"></i> Bhabha University, Bhopal</span>
          </div>

        </div>
        <?php
          }
        } else { ?>
        <!-- Default Fallback Awards -->
        <div class="bu-default-awards-grid">
          <?php 
          $default_awards = [
            ['icon'=>'fa-trophy','title'=>'Best Private University Award','org'=>'MP Education Excellence Awards 2023','desc'=>'Recognised as the Best Private University in Madhya Pradesh for academic innovation and placement excellence.'],
            ['icon'=>'fa-star','title'=>'Academic Excellence Award','org'=>'National Higher Education Forum','desc'=>'Recognised for holistic academic infrastructure, curriculum design, and student learning outcomes.'],
            ['icon'=>'fa-globe','title'=>'Excellence in Research','org'=>'India Research Summit 2022','desc'=>'Honoured for 120+ active research labs, 250+ patents, and 1,200+ international publications.'],
            ['icon'=>'fa-graduation-cap','title'=>'Top Placement University','org'=>'India Education Congress 2023','desc'=>'Awarded for achieving 98% placement rate with top recruiters like Infosys, TCS, and Amazon.'],
          ];
          foreach($default_awards as $aw): ?>
          <div class="bu-default-award-card">
            <div class="bu-default-award-icon">
              <i class="fa <?php echo $aw['icon'];?>"></i>
            </div>
            <h4><?php echo $aw['title'];?></h4>
            <span class="bu-default-award-org"><?php echo $aw['org'];?></span>
            <p><?php echo $aw['desc'];?></p>
          </div>
          <?php endforeach; ?>
        </div>
        <?php } ?>
      </div>

      <!-- Certificate Lightbox Modal -->
      <div id="buCertModalBackdrop" class="bu-cert-modal-backdrop" onclick="closeCertModal(event)">
        <div class="bu-cert-modal-box" onclick="event.stopPropagation()">
          <button type="button" class="bu-cert-modal-close" onclick="closeCertModal()" aria-label="Close">&times;</button>
          <div class="bu-cert-pill" style="margin-bottom:6px;"><i class="fa fa-certificate"></i> Official Certificate</div>
          <h4 id="buCertModalTitle" class="bu-cert-modal-heading"></h4>
          <div class="bu-cert-modal-img-frame">
            <img id="buCertModalImg" src="" alt="Full Certificate" class="bu-cert-modal-img">
          </div>
        </div>
      </div>

      <!-- Stylesheet for Modern Awards Layout -->
      <style>
      /* Stats Grid */
      .bu-award-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-top: 20px;
      }
      .bu-award-stat-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.25s ease;
      }
      .bu-award-stat-box:hover {
        background: #0A1B54;
        border-color: #0A1B54;
        transform: translateY(-2px);
      }
      .bu-award-stat-icon {
        width: 44px;
        height: 44px;
        background: rgba(10, 27, 84, 0.08);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 20px;
        color: #0A1B54;
        transition: all 0.25s ease;
      }
      .bu-award-stat-box:hover .bu-award-stat-icon {
        background: rgba(255, 193, 7, 0.2);
        color: #FFC107;
      }
      .bu-award-stat-info h4 {
        font-size: 13.5px;
        font-weight: 700;
        color: #061D7C;
        margin: 0 0 3px 0;
        transition: color 0.25s ease;
      }
      .bu-award-stat-box:hover .bu-award-stat-info h4 {
        color: #ffffff;
      }
      .bu-award-stat-info p {
        font-size: 12px;
        color: #64748B;
        margin: 0;
        line-height: 1.4;
        transition: color 0.25s ease;
      }
      .bu-award-stat-box:hover .bu-award-stat-info p {
        color: rgba(255, 255, 255, 0.8);
      }

      /* Award Stack Cards */
      .bu-awards-stack {
        display: flex;
        flex-direction: column;
        gap: 28px;
      }
      .bu-award-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 6px 24px rgba(6, 29, 124, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        position: relative;
      }
      .bu-award-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #FFC107 0%, #D99B00 50%, #061D7C 100%);
      }
      .bu-award-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 36px rgba(6, 29, 124, 0.1);
        border-color: #FFC107;
      }

      /* Card Header */
      .bu-award-header {
        display: flex;
        align-items: center;
        gap: 22px;
        padding: 24px 28px;
        background: linear-gradient(to right, #F8FAFC 0%, #ffffff 100%);
        border-bottom: 1px solid #E2E8F0;
      }
      .bu-award-media {
        width: 135px;
        height: 110px;
        flex-shrink: 0;
        border-radius: 10px;
        overflow: hidden;
        background: #0A1B54;
        box-shadow: 0 4px 14px rgba(6, 29, 124, 0.12);
        border: 2px solid #ffffff;
      }
      .bu-award-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        image-rendering: -webkit-optimize-contrast;
        transition: transform 0.3s ease;
      }
      .bu-award-card:hover .bu-award-img {
        transform: scale(1.05);
      }
      .bu-award-img-ph {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
        color: #FFC107;
        font-size: 38px;
      }
      .bu-award-meta-wrap {
        flex: 1;
        min-width: 0;
      }
      .bu-award-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #D99B00;
        background: rgba(255, 193, 7, 0.15);
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid rgba(255, 193, 7, 0.3);
        margin-bottom: 8px;
      }
      .bu-award-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 21px;
        font-weight: 800;
        color: #061D7C;
        margin: 0 0 6px 0;
        line-height: 1.25;
      }
      .bu-award-recipient {
        font-size: 13.5px;
        font-weight: 700;
        color: #D99B00;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }
      .bu-award-desig {
        font-size: 13px;
        color: #4B5563;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
      }

      /* Subcards (Certificate + Description in Same Unit) */
      .bu-award-subcards-grid {
        display: flex;
        flex-direction: column;
        gap: 16px;
        padding: 22px 26px;
        background: #F8FAFC;
      }
      .bu-cert-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(6, 29, 124, 0.04);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        display: flex;
        align-items: stretch;
      }
      .bu-cert-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(6, 29, 124, 0.09);
        border-color: #FFC107;
      }
      .bu-cert-thumb-wrap {
        width: 190px;
        min-width: 190px;
        max-width: 190px;
        position: relative;
        overflow: hidden;
        background: #0A1B54;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .bu-cert-thumb {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #f1f5f9;
        padding: 6px;
        transition: transform 0.3s ease;
        image-rendering: -webkit-optimize-contrast;
      }
      .bu-cert-thumb-wrap:hover .bu-cert-thumb {
        transform: scale(1.05);
      }
      .bu-cert-zoom-overlay {
        position: absolute;
        inset: 0;
        background: rgba(4, 15, 74, 0.75);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        color: #FFC107;
        opacity: 0;
        transition: opacity 0.25s ease;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
      }
      .bu-cert-thumb-wrap:hover .bu-cert-zoom-overlay {
        opacity: 1;
      }
      .bu-cert-zoom-overlay i {
        font-size: 22px;
      }
      .bu-cert-details {
        padding: 20px 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }
      .bu-cert-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 9.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #D99B00;
        background: rgba(255, 193, 7, 0.12);
        padding: 3px 10px;
        border-radius: 14px;
        margin-bottom: 8px;
        width: fit-content;
      }
      .bu-cert-text {
        font-size: 14px;
        line-height: 1.65;
        color: #374151;
        font-weight: 600;
        margin: 0 0 12px 0;
      }
      .bu-cert-btn-zoom {
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        color: #061D7C;
        font-size: 11.5px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: fit-content;
        transition: all 0.2s;
      }
      .bu-cert-btn-zoom:hover {
        background: #061D7C;
        color: #FFC107;
        border-color: #061D7C;
      }

      /* Card Footer */
      .bu-award-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 28px;
        background: #ffffff;
        border-top: 1px solid #E2E8F0;
        font-size: 12px;
      }
      .bu-award-tag {
        color: #059669;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .bu-award-campus {
        color: #64748B;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
      }

      /* Certificate Lightbox Modal */
      .bu-cert-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(4, 15, 74, 0.85);
        backdrop-filter: blur(6px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 100000;
        padding: 24px;
      }
      .bu-cert-modal-backdrop.active {
        display: flex;
      }
      .bu-cert-modal-box {
        background: #ffffff;
        border-radius: 16px;
        max-width: 800px;
        width: 100%;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        padding: 24px;
        position: relative;
        box-shadow: 0 24px 50px rgba(0, 0, 0, 0.35);
        animation: buCertModalZoom 0.25s ease-out;
      }
      @keyframes buCertModalZoom {
        from { opacity: 0; transform: scale(0.92); }
        to { opacity: 1; transform: scale(1); }
      }
      .bu-cert-modal-close {
        position: absolute;
        top: 16px;
        right: 18px;
        background: #F1F5F9;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #061D7C;
        transition: all 0.2s;
        z-index: 10;
      }
      .bu-cert-modal-close:hover {
        background: #FFC107;
        color: #000;
      }
      .bu-cert-modal-heading {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 18px;
        font-weight: 800;
        color: #061D7C;
        margin: 0 0 16px 0;
        padding-right: 40px;
        line-height: 1.35;
      }
      .bu-cert-modal-img-frame {
        width: 100%;
        flex: 1;
        max-height: calc(85vh - 120px);
        overflow: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px;
      }
      .bu-cert-modal-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        display: block;
      }

      /* Default Fallback Grid */
      .bu-default-awards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
      }
      .bu-default-award-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 28px 22px;
        text-align: center;
        box-shadow: 0 4px 16px rgba(6, 29, 124, 0.04);
        transition: all 0.3s ease;
      }
      .bu-default-award-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(6, 29, 124, 0.1);
        border-color: #FFC107;
      }
      .bu-default-award-icon {
        width: 56px;
        height: 56px;
        background: rgba(10, 27, 84, 0.08);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px auto;
        font-size: 22px;
        color: #061D7C;
      }
      .bu-default-award-card h4 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 18px;
        font-weight: 800;
        color: #061D7C;
        margin: 0 0 8px 0;
      }
      .bu-default-award-org {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: #D99B00;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
      }
      .bu-default-award-card p {
        font-size: 13.5px;
        color: #4B5563;
        line-height: 1.6;
        margin: 0;
      }

      @media(max-width: 768px) {
        .bu-award-header {
          flex-direction: column;
          align-items: flex-start;
          padding: 20px;
          gap: 16px;
        }
        .bu-award-media {
          width: 100%;
          height: 150px;
        }
        .bu-award-subcards-grid {
          padding: 16px;
        }
        .bu-cert-card {
          flex-direction: column;
        }
        .bu-cert-thumb-wrap {
          width: 100%;
          min-width: 100%;
          max-width: 100%;
          height: 200px;
        }
        .bu-cert-details {
          padding: 16px;
        }
        .bu-award-footer {
          flex-direction: column;
          align-items: flex-start;
          gap: 8px;
          padding: 14px 20px;
        }
      }
      </style>

      <script>
      function openCertModal(imgSrc, title) {
        var modal = document.getElementById('buCertModalBackdrop');
        var imgEl = document.getElementById('buCertModalImg');
        var titleEl = document.getElementById('buCertModalTitle');
        if (modal && imgEl) {
          imgEl.src = imgSrc;
          if (titleEl) titleEl.textContent = title || 'Award Certificate';
          modal.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      }
      function closeCertModal(e) {
        if (e && e.target && !e.target.classList.contains('bu-cert-modal-backdrop') && !e.target.classList.contains('bu-cert-modal-close')) {
          return;
        }
        var modal = document.getElementById('buCertModalBackdrop');
        if (modal) {
          modal.classList.remove('active');
          document.body.style.overflow = '';
        }
      }
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeCertModal();
      });
      </script>

    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
