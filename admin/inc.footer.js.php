<!-- END wrapper -->
<!-- jQuery  -->
<script src="<?php echo URL_JS;?>bootstrap.bundle.min.js"></script>
<script src="<?php echo URL_JS;?>metisMenu.min.js"></script>
<script src="<?php echo URL_JS;?>jquery.slimscroll.js"></script>
<script src="<?php echo URL_JS;?>waves.min.js"></script>
<script src="<?php echo URL_PLUG;?>jquery-sparkline/jquery.sparkline.min.js"></script>
<?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php'): ?>
<!--Morris Chart-->
<script src="<?php echo URL_PLUG;?>morris/morris.min.js"></script>
<script src="<?php echo URL_PLUG;?>raphael/raphael-min.js"></script>
<script src="assets/pages/dashboard.js"></script>
<?php endif; ?>
<!-- App js -->
<script src="<?php echo URL_JS;?>app.js?v=<?php echo time(); ?>"></script>

<!-- Auto-Scroll & Sticky Active Tab in Admin Sidebar -->
<script>
$(document).ready(function() {
  // Ensure server-rendered active submenu has class 'in'
  $('#sidebar-menu li.active > ul.submenu').addClass('collapse in').attr('aria-expanded', 'true');

  function scrollToActiveMenu() {
    var $activeItem = $('#sidebar-menu ul.submenu li.active > a, #sidebar-menu ul.submenu a.active, #sidebar-menu li.active > a.active, #sidebar-menu li.active').first();
    if ($activeItem.length) {
      var $container = $('.slimscroll-menu');
      if ($container.length) {
        var containerTop = $container.offset().top;
        var itemTop = $activeItem.offset().top;
        var currentScroll = $container.scrollTop();
        var targetScroll = currentScroll + (itemTop - containerTop) - ($container.height() / 2) + ($activeItem.outerHeight() / 2);
        
        targetScroll = Math.max(0, targetScroll);
        
        if (typeof $container.slimScroll === 'function') {
          $container.slimScroll({ scrollTo: targetScroll + 'px' });
        } else {
          $container.scrollTop(targetScroll);
        }
      }
    }
  }

  // Multi-stage trigger ensures SlimScroll and MetisMenu have painted
  setTimeout(scrollToActiveMenu, 100);
  setTimeout(scrollToActiveMenu, 300);
  setTimeout(scrollToActiveMenu, 600);
});
</script>
