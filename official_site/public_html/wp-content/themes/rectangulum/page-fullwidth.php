<?php
/**
 * Template Name: Full Width
 *
 * @package Rectangulum
 */

get_header(); ?>

	<div id="content" class="site-content clearfix">

	<?php if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'rectangulum-featured' );
	} ?>
		<div class="content-full" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- .content-full -->

	</div><!-- #content -->

<?php get_footer(); ?>
