<?php
/**
 * The main template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
get_header(); ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php if($liveride_options_db['liveride_latest_posts_headline'] == '') { ?><?php _e( 'Latest Posts' , 'liveride' ); ?><?php } else { echo esc_attr($liveride_options_db['liveride_latest_posts_headline']); } ?></h1>
  </div>  
  <div id="main-content">    
    <div id="content">
<?php if ($liveride_options_db['liveride_display_latest_posts'] != 'Hide') { ?>    
      <section class="home-latest-posts">      
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?>
<?php liveride_content_nav( 'nav-below' ); ?>
      </section>
<?php } ?>
<?php if ( dynamic_sidebar( 'sidebar-3' ) ) : else : ?>
<?php endif; ?>  
    </div> <!-- end of content -->
<?php get_sidebar(); ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>