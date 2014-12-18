<?php
/**
 * Setup the WordPress core custom header feature.
 * @package Rectangulum
 */

if ( ! function_exists( 'rectangulum_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see rectangulum_custom_header_setup().
 */
function rectangulum_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" width="100%" />
		<?php endif; ?>
	</div>
<?php
}
endif; // rectangulum_admin_header_image
