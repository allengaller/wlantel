<?php
/**
 * @package Rectangulum
 */
get_header(); ?>


<?php if ( !is_front_page() ) : ?>

<!--Page Header Image-->

<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumb">
		<?php the_post_thumbnail( 'rectangulum-featured' ); ?>
	</div>
<?php } ?>
	<div class="content-left excerpt">
	<?php if ( has_excerpt() ) : ?>
		<?php the_excerpt(); ?>
	<?php endif; //has_excerpt() ?>	
	</div>
<!--END Page Header Image-->

	<div id="content" class="site-content clearfix">

		<div class="content-right" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

	<?php
		if ( comments_open() || '0' != get_comments_number() )
			comments_template();
	?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- .content-right -->

	<?php get_sidebar( 'page' ); ?>

	</div><!-- #content -->

<?php endif; ?>

<?php if ( is_front_page() ) : ?>	

	<div id="content" class="site-content clearfix">

		<div class="content-full tagline" role="main" style="background: <?php echo get_theme_mod( 'rectangulum_main_color' ); ?> url(<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'rectangulum-featured' ); echo $thumbnail[0]; ?>) no-repeat; background-position: 60% 50%; background-size: cover;">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- .content-full -->

<?php
	global $count; //post number for left-right align
	$sticky_posts = get_option('sticky_posts');

		if ( !empty( $sticky_posts ) ) :
			$args = array(
			    'post__in' => get_option('sticky_posts'),
				'post_status' => 'publish'
			);

			$sticky_query = new WP_Query( $args ); ?>

			<?php if ( $sticky_query->have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); ?>
<?php $count ++; 
//posts number for left-right align
?>
			<div class="clearfix">
				<?php get_template_part( 'content', 'sticky' ); ?>
			</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php endif; // $sticky_query->have_posts() ?>
				
		<?php endif; // !empty( $sticky_posts ) ?>

	</div><!-- #content -->

<?php endif; // is_front_page() ?>

<?php get_footer(); ?>
