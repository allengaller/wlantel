<?php
/**
 * The archive template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php if ( is_day() ) :
						printf( __( 'Daily Archive: %s', 'liveride' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archive: %s', 'liveride' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'liveride' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archive: %s', 'liveride' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'liveride' ) ) . '</span>' );
					else :
						_e( 'Archive', 'liveride' );
					endif ;?></h1>
  </div>  
<?php liveride_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content">    
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?> 
<?php liveride_content_nav( 'nav-below' ); ?> 
    </div> <!-- end of content -->
<?php get_sidebar(); ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>