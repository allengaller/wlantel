<?php
/**
 * The header template file.
 * @package LiveRide
 * @since LiveRide 1.0.0
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php global $liveride_options_db; ?>
  <meta charset="<?php bloginfo( 'charset' ); ?>" /> 
  <meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0" />  
  <title><?php wp_title( '|', true, 'right' ); ?></title>  
  <!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
<?php if ($liveride_options_db['liveride_favicon_url'] != ''){ ?>
	<link rel="shortcut icon" href="<?php echo esc_url($liveride_options_db['liveride_favicon_url']); ?>" />
<?php } ?>
<?php wp_head(); ?>  
</head>
 
<body <?php body_class(); ?> id="wrapper">  
<div id="left-sidebar">
    <div class="site-headline-box">
<?php if ( $liveride_options_db['liveride_logo_url'] == '' ) { ?>
      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
<?php } else { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="header-logo" src="<?php echo esc_url($liveride_options_db['liveride_logo_url']); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
<?php } ?>
<?php if ( $liveride_options_db['liveride_display_site_description'] != 'Hide' ) { ?>
      <p class="site-description"><?php bloginfo( 'description' ); ?></p>
<?php } ?>
    </div>
<?php if ( !is_page_template('template-landing-page.php') ) { ?>
    <div class="menu-box">
<?php wp_nav_menu( array( 'menu_id'=>'nav', 'theme_location'=>'main-navigation' ) ); ?>
    </div>
<?php } ?>
</div> <!-- end of left-sidebar -->
  
<div id="container">
<?php if ( is_home() || is_front_page() ) { ?>
<?php if ( get_header_image() != '' ) { ?>
  <header id="header"> 
    <img class="header-image" src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />   
  </header>
<?php } ?>
<?php } else { ?>
<?php if ( get_header_image() != '' && $liveride_options_db['liveride_display_header_image'] != 'Only on Homepage' ) { ?>
  <header id="header"> 
    <img class="header-image" src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />   
  </header>
<?php }} ?>