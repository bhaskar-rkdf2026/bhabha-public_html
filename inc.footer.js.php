<script src="<?php echo URL_JS;?>breaking-news-ticker.min.js" defer></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
<script src="<?php echo URL_JS;?>bootstrap.min.js" defer></script> 
<!--Owl Carousel JavaScript--> 
<script src="<?php echo URL_JS;?>owl.carousel.min.js" defer></script> 
<!--Pretty Photo JavaScript--> 
<script src="<?php echo URL_JS;?>jquery.prettyPhoto.js" defer></script> 
<!--Dl Menu Script--> 
<script src="<?php echo URL_JS;?>dl-menu/modernizr.custom.js" defer></script> 
<script src="<?php echo URL_JS;?>dl-menu/jquery.dlmenu.js" defer></script> 
<!--Full Calendar JavaScript--> 
<script src="<?php echo URL_JS;?>moment.min.js" defer></script> 
<script src="<?php echo URL_JS;?>fullcalendar.min.js" defer></script> 
<script src="<?php echo URL_JS;?>jquery.downCount.js" defer></script> 
<!--Image Filterable JavaScript--> 
<script src="<?php echo URL_JS;?>jquery-filterable.js" defer></script> 
<!--Accordion JavaScript--> 
<script src="<?php echo URL_JS;?>jquery.accordion.js" defer></script> 
<!--Number Count (Waypoints) JavaScript--> 
<script src="<?php echo URL_JS;?>waypoints-min.js" defer></script> 
<!--v ticker--> 
<script src="<?php echo URL_JS;?>jquery.vticker.min.js" defer></script> 
<!--select menu--> 
<script src="<?php echo URL_JS;?>jquery.selectric.min.js" defer></script> 
<!--Side Menu--> 
<script src="<?php echo URL_JS;?>jquery.sidr.min.js" defer></script> 
<!--Custom JavaScript--> 
<?php 
$bu_js_ver = @filemtime(__DIR__ . '/js/custom.js') ?: '20260926';
?>
<script src="<?php echo URL_JS;?>custom.js?v=<?php echo $bu_js_ver;?>" defer></script>

<script>
window.addEventListener('DOMContentLoaded', function() {
  if (typeof $ !== 'undefined') {
    if (typeof $.fn.breakingNews === 'function') {
      $('#newsTicker1').breakingNews();
    }
    if (typeof $.fn.datepicker === 'function') {
      $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1950:2020'
      });
    }
  }
});
</script>

