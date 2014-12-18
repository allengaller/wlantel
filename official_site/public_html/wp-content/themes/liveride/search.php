<?php
/**
 * The search results template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php printf( __( 'Search Results for: %s', 'liveride' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
  </div>  
<?php liveride_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content">    
      <div class="archive-meta"><p class="number-of-results"><?php _e( 'Number of Results: ', 'liveride' ); ?><?php echo $wp_query->found_posts; ?></p></div>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="navigation" role="navigation">
			<h2 class="navigation-headline section-heading"><?php _e( 'Search results navigation', 'liveride' ); ?></h2>
      <div class="nav-wrapper">
			 <p class="navigation-links">
<?php $big = 999999999;
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
  'prev_text' => __( '&larr; Previous', 'liveride' ),
	'next_text' => __( 'Next &rarr;', 'liveride' ),
	'total' => $wp_query->max_num_pages
) );
?>
        </p>
      </div>
    </div>
<?php endif; ?>

<?php else : ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php _e( 'Nothing Found', 'liveride' ); ?></h1>
  </div>  
<?php liveride_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content">
      <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'liveride' ); ?></p>
<?php endif; ?> 
    </div> <!-- end of content -->
<?php get_sidebar(); ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>