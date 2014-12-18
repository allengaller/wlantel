<?php
/**
 * The author archive template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php the_post(); ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php printf( __( 'Author Archive: %s', 'liveride' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
  </div>  
<?php liveride_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content">
<?php rewind_posts(); ?>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
    <div class="archive-meta">
      <div class="author-info">
		    <div class="author-description">
          <div class="author-avatar">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'liveride_author_bio_avatar_size', 60 ) ); ?>
		      </div>
			    <p><?php the_author_meta( 'description' ); ?></p>
		    </div>
		  </div>
    </div>
<?php endif; ?>    
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?> 
<?php liveride_content_nav( 'nav-below' ); ?> 
    </div> <!-- end of content -->
<?php get_sidebar(); ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>