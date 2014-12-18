<?php 
/**
 * Library of Theme options functions.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/ 

// Display Breadcrumb navigation
function liveride_get_breadcrumb() { 
global $liveride_options_db;
		if ($liveride_options_db['liveride_display_breadcrumb'] != 'Hide') { ?>
<?php if(function_exists( 'bcn_display' ) && !is_front_page()){ _e('<div id="breadcrumb-navigation"><p>', 'liveride'); ?><?php bcn_display(); ?><?php _e('</p></div>', 'liveride');} ?>
<?php } 
} 

// Display featured images on single posts
function liveride_get_display_image_post() { 
global $liveride_options_db;
		if ($liveride_options_db['liveride_display_image_post'] == '' || $liveride_options_db['liveride_display_image_post'] == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
}

// Display featured images on pages
function liveride_get_display_image_page() { 
global $liveride_options_db;
		if ($liveride_options_db['liveride_display_image_page'] == '' || $liveride_options_db['liveride_display_image_page'] == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
} ?>