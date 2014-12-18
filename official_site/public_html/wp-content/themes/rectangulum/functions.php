<?php
/**
 * @package Rectangulum
 */


if ( ! function_exists( 'rectangulum_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function rectangulum_setup() {

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 2800; /* pixels */
	}

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Make theme available for translation
	 */
	load_theme_textdomain( 'rectangulum', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Set the Custom Image Sizes
	 */
	add_image_size( 'rectangulum-rectangulum', 400, 220, true );

	add_image_size( 'rectangulum-sticky', 600, 420, true );

	add_image_size( 'rectangulum-featured-small', 1400, 750, true );

	add_image_size( 'rectangulum-featured', 2800, 1400, true );

	// Uses custom gallery styles
	add_filter( 'use_default_gallery_style', '__return_false' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'quote', 'link', 'aside', 'status', 'gallery' ) );

	/**
	 * Setup the WordPress core custom header image.
	 */
	add_theme_support( 'custom-header', apply_filters( 'rectangulum_custom_header_args', array(
		'default-image'          => get_template_directory_uri().'/img/header.jpg',
                                'header-text'            => false,
		'width'                  => 1860,
		'height'                 => 750,
		'flex-height'            => true,
                                'flex-width'    => true, 
	) ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'rectangulum_custom_background_args', array(
		'default-color' => 'fff'
	) ) );

	/**
	 * Custom Menu location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Header Menu', 'rectangulum' ),
		'top' => __( 'Top Menu', 'rectangulum' ),
		'social' => __( 'Social Menu', 'rectangulum' )
	) );

	/**
	 * Editor styles for the win
	 */
	add_editor_style( 'editor-style.css' );

}
endif; // rectangulum_setup
add_action( 'after_setup_theme', 'rectangulum_setup' );

/**
 * Add Excerpt for Page.
 */
function true_add_excerpt_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action('init', 'true_add_excerpt_to_pages');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Widgetized
 */
function rectangulum_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'rectangulum' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'rectangulum' ),
		'id'            => 'sidebar-page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name' => __('Footer1', 'rectangulum'),
		'description' => __('Located in the footer left of the page.', 'rectangulum'),
		'id' => 'footer1',
		'before_title' => '<h5>', //class="hidden"
		'after_title' => '</h5>',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div>'
	) );
       register_sidebar( array(
            'name' => __('Footer2', 'rectangulum'),
            'description' => __('Located in the footer center of the page.', 'rectangulum'),
            'id' => 'footer2',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
            'before_widget' => '<div class="footer-widget">',
            'after_widget' => '</div>'
        ) );
       register_sidebar( array(
            'name' => __('Footer3', 'rectangulum'),
            'description' => __('Located in the footer right of the page.', 'rectangulum'),
            'id' => 'footer3',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
            'before_widget' => '<div class="footer-widget">',
            'after_widget' => '</div>'
        ) );
}
add_action( 'widgets_init', 'rectangulum_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function rectangulum_scripts() {
                
                wp_enqueue_style( 'dsc-googlefonts', 'http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic&subset=latin,cyrillic|Open+Sans:400,700,400italic&subset=latin,cyrillic|Ubuntu:400,500,700&subset=latin,cyrillic' );

	wp_enqueue_style( 'awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );//Awesome inc
	
                wp_enqueue_style( 'rectangulum-style', get_stylesheet_uri() );

	wp_enqueue_script( 'rectangulum-html5', get_template_directory_uri() . '/js/html5.js', false, '3.7.0', false );

	wp_enqueue_script( 'rectangulum-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '2.1', true );

	wp_enqueue_script( 'rectangulum-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

	wp_enqueue_script( 'rectangulum-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '8082014', true );

	wp_enqueue_script( 'rectangulum-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '8082014', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rectangulum_scripts' );

/**
 * Excerpt length
 */
function rectangulum_excerpt_length($length) {
	if ( is_sticky() ) {
		$length = 50;
	} elseif ( is_archive() || is_search() ) {
		$length = 30;
	} else {
		$length = 20;
	}
	return $length;
}
add_filter('excerpt_length', 'rectangulum_excerpt_length', 999);

/**
 * Replace [...] in excerpts with something new
 */
function rectangulum_excerpt_more($more) {
	return '&hellip;';
}
add_filter('excerpt_more', 'rectangulum_excerpt_more');

/**
 * Gallery layout
 */
require( get_template_directory() . '/inc/gallery.php');

/**
 * Add button CSS class
 */
function rectangulum_add_btn_link_class() {
	return 'class="btn"';
}
add_filter('next_posts_link_attributes', 'rectangulum_add_btn_link_class');
add_filter('previous_posts_link_attributes', 'rectangulum_add_btn_link_class');
add_filter('next_comments_link_attributes', 'rectangulum_add_btn_link_class');
add_filter('previous_comments_link_attributes', 'rectangulum_add_btn_link_class');

/**
 * Footer credits.
 */
function rectangulum_txt_credits() {
	$text = sprintf( __( 'Powered by %s', 'rectangulum' ), '<a href="http://wordpress.org/">WordPress</a>' );
	$text .= '<span class="sep"> | </span>';
	$text .= sprintf( __( 'Theme by %s', 'rectangulum' ), '<a href="http://dinevthemes.com/">DinevThemes</a>' );
	echo apply_filters( 'rectangulum_txt_credits', $text );
}
add_action( 'rectangulum_credits', 'rectangulum_txt_credits' );

/**
 * Theme Customizer
 **/
require_once ( get_template_directory() .'/inc/customizer.php' );