<?php
/**
 * Headerdata of Theme options.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/  

// additional js and css
if(	!is_admin()){
function liveride_fonts_include () {
global $liveride_options_db;
// Google Fonts
$bodyfont = $liveride_options_db['liveride_body_google_fonts'];
$headingfont = $liveride_options_db['liveride_headings_google_fonts'];
$descriptionfont = $liveride_options_db['liveride_description_google_fonts'];
$headlinefont = $liveride_options_db['liveride_headline_google_fonts'];
$headlineboxfont = $liveride_options_db['liveride_headline_box_google_fonts'];
$postentryfont = $liveride_options_db['liveride_postentry_google_fonts'];
$sidebarfont = $liveride_options_db['liveride_sidebar_google_fonts'];
$menufont = $liveride_options_db['liveride_menu_google_fonts'];

$fonturl = "//fonts.googleapis.com/css?family=";

$bodyfonturl = $fonturl.$bodyfont;
$headingfonturl = $fonturl.$headingfont;
$descriptionfonturl = $fonturl.$descriptionfont;
$headlinefonturl = $fonturl.$headlinefont;
$headlineboxfonturl = $fonturl.$headlineboxfont;
$postentryfonturl = $fonturl.$postentryfont;
$sidebarfonturl = $fonturl.$sidebarfont;
$menufonturl = $fonturl.$menufont;
	// Google Fonts
     if ($bodyfont != 'default' && $bodyfont != ''){
      wp_enqueue_style('liveride-google-font1', $bodyfonturl); 
		 }
     if ($headingfont != 'default' && $headingfont != ''){
      wp_enqueue_style('liveride-google-font2', $headingfonturl);
		 }
     if ($descriptionfont != 'default' && $descriptionfont != ''){
      wp_enqueue_style('liveride-google-font3', $descriptionfonturl);
		 }
     if ($headlinefont != 'default' && $headlinefont != ''){
      wp_enqueue_style('liveride-google-font4', $headlinefonturl); 
		 }
     if ($postentryfont != 'default' && $postentryfont != ''){
      wp_enqueue_style('liveride-google-font5', $postentryfonturl); 
		 }
     if ($sidebarfont != 'default' && $sidebarfont != ''){
      wp_enqueue_style('liveride-google-font6', $sidebarfonturl);
		 }
     if ($menufont != 'default' && $menufont != ''){
      wp_enqueue_style('liveride-google-font8', $menufonturl);
		 }
     if ($headlineboxfont != 'default' && $headlineboxfont != ''){
      wp_enqueue_style('liveride-google-font10', $headlineboxfonturl); 
		 }
}
add_action( 'wp_enqueue_scripts', 'liveride_fonts_include' );
}

// additional js and css
function liveride_css_include () {
global $liveride_options_db;
	if ($liveride_options_db['liveride_css'] == 'Green (default)' ){
			wp_enqueue_style('liveride-style', get_stylesheet_uri());
		}

		if ($liveride_options_db['liveride_css'] == 'Blue' ){
			wp_enqueue_style('liveride-style-blue', get_template_directory_uri().'/css/blue.css');
		}

		if ($liveride_options_db['liveride_css'] == 'Orange' ){
			wp_enqueue_style('liveride-style-orange', get_template_directory_uri().'/css/orange.css');
		}
}
add_action( 'wp_enqueue_scripts', 'liveride_css_include' );

// Display sidebar
function liveride_display_sidebar() {
global $liveride_options_db;
    $display_sidebar = $liveride_options_db['liveride_display_sidebar']; 
		if ($display_sidebar == 'Hide') { ?>
		<?php _e('#wrapper #container #content { width: 870px; }', 'liveride'); ?>
<?php } 
}

// Left Sidebar Position
function liveride_left_sidebar_position() {
global $liveride_options_db;
    $left_sidebar_position = $liveride_options_db['liveride_left_sidebar_position']; 
		if ($left_sidebar_position == 'Absolute (scrolled)') { ?>
		<?php _e('body #left-sidebar { height: auto; position: absolute; } body .sidebar-background { display: block; }', 'liveride'); ?>
<?php } 
}

// Display Meta Box on posts - post entries styling
function liveride_display_meta_post_entry() {
global $liveride_options_db;
    $display_meta_post_entry = $liveride_options_db['liveride_display_meta_post']; 
		if ($display_meta_post_entry == 'Hide') { ?>
		<?php _e('#wrapper #main-content .post-entry .attachment-post-thumbnail { margin-bottom: 17px; } #wrapper #main-content .post-entry .post-entry-content { margin-bottom: -4px; }', 'liveride'); ?>
<?php } 
}

// FONTS
// Body font
function liveride_get_body_font() {
global $liveride_options_db;
    $bodyfont = $liveride_options_db['liveride_body_google_fonts'];
    if ($bodyfont != 'default' && $bodyfont != '') { ?>
    <?php _e('html body, #wrapper blockquote, #wrapper q, #wrapper #container #comments .comment, #wrapper #container #comments .comment time, #wrapper #container #commentform .form-allowed-tags, #wrapper #container #commentform p, #wrapper input, #wrapper button, #wrapper select, #wrapper #main-content .post-meta { font-family: "', 'liveride'); ?><?php echo $bodyfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// Site title font
function liveride_get_headings_google_fonts() {
global $liveride_options_db;
    $headingfont = $liveride_options_db['liveride_headings_google_fonts']; 
		if ($headingfont != 'default' && $headingfont != '') { ?>
		<?php _e('#wrapper .site-title { font-family: "', 'liveride'); ?><?php echo $headingfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// Site description font
function liveride_get_description_font() {
global $liveride_options_db;
    $descriptionfont = $liveride_options_db['liveride_description_google_fonts'];
    if ($descriptionfont != 'default' && $descriptionfont != '') { ?>
    <?php _e('#wrapper #left-sidebar .site-description {font-family: "', 'liveride'); ?><?php echo $descriptionfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// Page/post headlines font
function liveride_get_headlines_font() {
global $liveride_options_db;
    $headlinefont = $liveride_options_db['liveride_headline_google_fonts'];
    if ($headlinefont != 'default' && $headlinefont != '') { ?>
		<?php _e('#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper #container .navigation .section-heading { font-family: "', 'liveride'); ?><?php echo $headlinefont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// LiveRide Posts-Default Widgets headlines font
function liveride_get_headline_box_google_fonts() {
global $liveride_options_db;
    $headline_box_google_fonts = $liveride_options_db['liveride_headline_box_google_fonts']; 
		if ($headline_box_google_fonts != 'default' && $headline_box_google_fonts != '') { ?>
		<?php _e('#wrapper #container #main-content section .entry-headline { font-family: "', 'liveride'); ?><?php echo $headline_box_google_fonts ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// Post entry font
function liveride_get_postentry_font() {
global $liveride_options_db;
    $postentryfont = $liveride_options_db['liveride_postentry_google_fonts']; 
		if ($postentryfont != 'default' && $postentryfont != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline { font-family: "', 'liveride'); ?><?php echo $postentryfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// Sidebar and Footer widget headlines font
function liveride_get_sidebar_widget_font() {
global $liveride_options_db;
    $sidebarfont = $liveride_options_db['liveride_sidebar_google_fonts'];
    if ($sidebarfont != 'default' && $sidebarfont != '') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget .sidebar-headline, #wrapper #footer .footer-signature .footer-headline { font-family: "', 'liveride'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// Menu font
function liveride_get_menu_font() {
global $liveride_options_db;
    $menufont = $liveride_options_db['liveride_menu_google_fonts']; 
		if ($menufont != 'default' && $menufont != '') { ?>
		<?php _e('#wrapper #left-sidebar .menu-box ul li a { font-family: "', 'liveride'); ?><?php echo $menufont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'liveride'); ?>
<?php } 
}

// User defined CSS.
function liveride_get_own_css() {
global $liveride_options_db;
    $own_css = $liveride_options_db['liveride_own_css']; 
		if ($own_css != '') { ?>
		<?php echo esc_attr($own_css); ?>
<?php } 
}

// Display custom CSS.
function liveride_custom_styles() { ?>
<?php echo ("<style type='text/css'>"); ?>
<?php liveride_get_own_css(); ?>
<?php liveride_display_sidebar(); ?>
<?php liveride_left_sidebar_position(); ?>
<?php liveride_display_meta_post_entry(); ?>
<?php liveride_get_body_font(); ?>
<?php liveride_get_headings_google_fonts(); ?>
<?php liveride_get_description_font(); ?>
<?php liveride_get_headlines_font(); ?>
<?php liveride_get_headline_box_google_fonts(); ?>
<?php liveride_get_postentry_font(); ?>
<?php liveride_get_sidebar_widget_font(); ?>
<?php liveride_get_menu_font(); ?>
<?php echo ("</style>"); ?>
<?php
} 
add_action('wp_enqueue_scripts', 'liveride_custom_styles');	?>