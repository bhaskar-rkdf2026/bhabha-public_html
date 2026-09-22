<!-- END wrapper -->
<!-- jQuery  -->
<script src="<?php echo URL_JS;?>bootstrap.bundle.min.js"></script>
<script src="<?php echo URL_JS;?>metisMenu.min.js"></script>
<script src="<?php echo URL_JS;?>jquery.slimscroll.js"></script>
<script src="<?php echo URL_JS;?>waves.min.js"></script>
<script src="<?php echo URL_PLUG;?>jquery-sparkline/jquery.sparkline.min.js"></script>
<!--Morris Chart-->
<script src="<?php echo URL_PLUG;?>morris/morris.min.js"></script>
<script src="<?php echo URL_PLUG;?>raphael/raphael-min.js"></script>
<script src="assets/pages/dashboard.js"></script>
<!-- App js -->
<script src="<?php echo URL_JS;?>app.js"></script>

<!-- Auto-Scroll & Sticky Active Tab in Admin Sidebar -->
<script>
$(document).ready(function() {
  function scrollToActiveMenu() {
    var $activeItem = $('#sidebar-menu li.active > a.active, #sidebar-menu li.active, #sidebar-menu a.active').first();
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
          $container.animate({ scrollTop: targetScroll }, 200);
        }
      }
    }
  }

  // Trigger on load with multi-stage timers to ensure MetisMenu & SlimScroll are ready
  setTimeout(scrollToActiveMenu, 100);
  setTimeout(scrollToActiveMenu, 300);
  setTimeout(scrollToActiveMenu, 600);
});
</script>
