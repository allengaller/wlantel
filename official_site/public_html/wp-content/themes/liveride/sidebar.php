<?php
/**
 * The sidebar template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
?>
<?php global $liveride_options_db; ?>
<?php if ($liveride_options_db['liveride_display_sidebar'] != 'Hide') { ?>
<aside id="sidebar">
<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
<?php endif; ?>
</aside> <!-- end of sidebar -->
<?php } ?>