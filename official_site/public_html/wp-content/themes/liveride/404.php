<?php
/**
 * The 404 page (Not Found) template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
get_header(); ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php _e( 'Nothing Found', 'liveride' ); ?></h1>
  </div>  
<?php liveride_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content">    
      <div class="entry-content">
        <p><?php _e( 'Apologies, but no results were found for your request. Perhaps searching will help you to find a related content.', 'liveride' ); ?></p><?php get_search_form(); ?>
      </div>  
    </div> <!-- end of content -->
<?php get_sidebar(); ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>