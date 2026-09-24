<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('ugc-proforma') : null;
$pdfUrl = portalVal($portalPage, 'pdf_url', '<?php echo URL_ROOT;?>upload/media/8a5cc8e8a663be0f26243b584eab0a19.pdf');
if (strpos($pdfUrl, 'http') !== 0) $pdfUrl = URL_ROOT . ltrim($pdfUrl, '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'UGC Proforma - Bhabha University Bhopal'); ?></title>
<meta name="description" content="Bhabha University UGC Proforma information in the prescribed format as required by the University Grants Commission, India.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = portalVal($portalPage, 'heading', 'UGC <em>Proforma</em>');
  $page_subtitle = portalVal($portalPage, 'subheading', 'University Grants Commission information in prescribed format — ensuring transparency and regulatory compliance.');
  $page_icon     = (!empty($portalPage['data']['page_icon'])) ? $portalPage['data']['page_icon'] : 'fa-file-text';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'UGC Proforma', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'ugc-proforma'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo portalVal($portalPage, 'badge', 'Regulatory Compliance'); ?></span>
        <h2 class="bu-content-h2"><?php echo portalVal($portalPage, 'heading', 'UGC <em>Proforma</em>'); ?></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            In accordance with the University Grants Commission (UGC) guidelines, Bhabha University 
            maintains complete disclosure of institutional information in the prescribed proforma format. 
            These documents are available for download below.
          </p>
        </div>
        <style>
        .bu-doc-card {
          display: flex !important;
          align-items: center !important;
          gap: 16px !important;
          padding: 20px 24px !important;
          background: #F8FAFC !important;
          border: 1px solid #E5E7EB !important;
          border-radius: 8px !important;
          border-left: 4px solid #FFC107 !important;
          text-decoration: none !important;
          transition: all 0.25s ease !important;
        }
        .bu-doc-card .bu-doc-title {
          font-size: 15px !important;
          font-weight: 700 !important;
          color: #0A1B54 !important;
          display: block !important;
          margin-bottom: 3px !important;
          transition: color 0.25s ease !important;
        }
        .bu-doc-card .bu-doc-sub {
          font-size: 11px !important;
          font-weight: 600 !important;
          color: #64748B !important;
          text-transform: uppercase !important;
          letter-spacing: 0.5px !important;
          display: block !important;
          transition: color 0.25s ease !important;
        }
        .bu-doc-card .bu-doc-icon {
          font-size: 20px !important;
          color: #D99B00 !important;
          transition: color 0.25s ease !important;
        }
        .bu-doc-card .bu-doc-dl {
          font-size: 16px !important;
          color: #D99B00 !important;
          flex-shrink: 0 !important;
          transition: color 0.25s ease !important;
        }

        /* Hover State */
        .bu-doc-card:hover {
          background: #0A1B54 !important;
          border-color: #0A1B54 !important;
          border-left-color: #FFC107 !important;
          transform: translateY(-2px) !important;
          box-shadow: 0 6px 18px rgba(10, 27, 84, 0.22) !important;
        }
        .bu-doc-card:hover .bu-doc-title {
          color: #FFFFFF !important;
        }
        .bu-doc-card:hover .bu-doc-sub {
          color: #FFC107 !important;
        }
        .bu-doc-card:hover .bu-doc-icon,
        .bu-doc-card:hover .bu-doc-dl {
          color: #FFC107 !important;
        }
        </style>

        <div style="display:grid;gap:12px;margin-top:24px;">
          <a href="<?php echo $pdfUrl;?>" 
             target="_blank"
             class="bu-doc-card">
            <div style="width:44px;height:44px;background:rgba(217,155,0,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i class="fa fa-file-pdf-o bu-doc-icon"></i>
            </div>
            <div style="flex:1;">
              <span class="bu-doc-title"><?php echo portalVal($portalPage, 'pdf_title', 'Filled UGC Proforma Information in Prescribed Format'); ?></span>
              <span class="bu-doc-sub">PDF Document &bull; University Grants Commission</span>
            </div>
            <i class="fa fa-download bu-doc-dl"></i>
          </a>
        </div>
      </div>

      <!-- Info Note -->
      <div class="bu-content-card" style="background:#FFF8E1;border-color:#FFC107;">
        <div style="display:flex;gap:14px;align-items:flex-start;">
          <i class="fa fa-info-circle" style="font-size:22px;color:#D99B00;flex-shrink:0;margin-top:2px;"></i>
          <div>
            <h4 style="font-size:14px;font-weight:700;color:#92400E;margin:0 0 4px 0;">Statutory Recognition</h4>
            <p style="font-size:13px;line-height:1.6;color:#78350F;margin:0;">
              <?php echo portalVal($portalPage, 'note', 'Bhabha University is established under Madhya Pradesh Niji Vishwavidyalaya (Sthapana Avam Sanchalan) Adhiniyam, 2007, and recognised by the UGC under Section 2(f) and 12(B) of the UGC Act, 1956.'); ?>
            </p>
          </div>
        </div>
      </div>
    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
