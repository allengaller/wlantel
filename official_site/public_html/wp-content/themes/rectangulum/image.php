<?php
/**
 * The template for displaying image attachments.
 * @package Rectangulum
 */

get_header(); ?>

	<div id="content" class="site-content clearfix">

		<div class="content-full" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php
							$metadata = wp_get_attachment_metadata();
							printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%7$s</a>', 'rectangulum' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( wp_get_attachment_url() ),
								$metadata['width'],
								$metadata['height'],
								esc_url( get_permalink( $post->post_parent ) ),
								get_the_title( $post->post_parent )
							);

							edit_post_link( __( 'Edit', 'rectangulum' ), '<span class="edit-link">', '</span>' );
						?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment">
							<?php rectangulum_the_attached_image(); ?>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'rectangulum' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<?php edit_post_link( __( 'Edit', 'rectangulum' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
			</article><!-- #post-## -->

		<?php endwhile; // end of the loop. ?>

		</div><!-- .content-full -->

	</div><!-- #content -->

<?php get_footer(); ?>
