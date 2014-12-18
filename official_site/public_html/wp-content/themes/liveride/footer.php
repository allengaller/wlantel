<?php
/**
 * The footer template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
?>
<?php if ( is_active_sidebar( 'sidebar-2' ) && !is_page_template('template-landing-page.php') ) { ?>
  <footer id="footer"> 
<?php dynamic_sidebar( 'sidebar-2' ); ?> 
  </footer>  <!-- end of footer -->
<?php } ?>
</div> <!-- end of container -->
<div class="sidebar-background"></div>
<?php wp_footer(); ?>         
</body>
</html>