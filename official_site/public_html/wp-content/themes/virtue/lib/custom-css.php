<?php
 header("Content-type: text/css; charset: UTF-8");
$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

 global $smof_data; 
//Logo
if(!empty($smof_data['font_logo'])) {
  $logo_font = '.logofont {font-family:'.$smof_data['font_logo'].';}';
} else {
  $logo_font = '.logofont {font-family:Pacifico;}';
}
if(!empty($smof_data['font_logo_style'])) {
  $font_lg = $smof_data['font_logo_style'];
 $font_logo = '#logo a.brand {font-size:' . $font_lg['size']. '; font-weight:' . $font_lg['style']. '; line-height:' . $font_lg['height']. '; color:' . $font_lg['color']. ';}';
} else {
  $font_logo = '#logo a.brand {font-size:38px; font-weight:normal; line-height:40px;}';
}
if(!empty($smof_data['font_tagline'])) {
  $tagline_font = '.kad_tagline {font-family:'.$smof_data['font_tagline'].';}';
} else {
  $tagline_font = '.kad_tagline {font-family:Lato;}';
}
if(!empty($smof_data['font_tagline_style'])) {
  $font_tg = $smof_data['font_tagline_style'];
 $font_tagline = '.kad_tagline {font-size:' . $font_tg['size']. '; font-weight:' . $font_tg['style']. '; line-height:' . $font_tg['height']. '; color:' . $font_tg['color']. ';}';
} else {
  $font_tagline = '.kad_tagline {font-size:14px; font-weight:normal; line-height:20px;}';
}
if(!empty($smof_data['logo_padding_top'])) {
$logo_padding_top = '#logo {padding-top:'.$smof_data['logo_padding_top'].'px;}';
} else {
  $logo_padding_top = '#logo {padding-top:25px;}';
}
if(!empty($smof_data['logo_padding_bottom'])) {
 $logo_padding_bottom = '#logo {padding-bottom:'.$smof_data['logo_padding_bottom'].'px;}';
 } else {
  $logo_padding_bottom = '#logo {padding-bottom:10px;}';
 } 
 if(!empty($smof_data['logo_padding_left'])) {
 $logo_padding_left = '#logo {margin-left:'.$smof_data['logo_padding_left'].'px;}';
 } else {
$logo_padding_left = '#logo {margin-left:0px;}';
 }
 if(!empty($smof_data['logo_padding_right'])) {
  $logo_padding_right = '#logo {margin-right:'.$smof_data['logo_padding_right'].'px;}';
} else {
  $logo_padding_right = '#logo {margin-right:0px;}';
}
if(!empty($smof_data['menu_margin_top'])) {
 $menu_margin_top = '#nav-main {margin-top:'.$smof_data['menu_margin_top'].'px;}';
 } else {
  $menu_margin_top = '#nav-main {margin-top:40px;}';
 } 
 if(!empty($smof_data['menu_margin_bottom'])) {
 $menu_margin_bottom = '#nav-main {margin-bottom:'.$smof_data['menu_margin_bottom'].'px;}';
} else {
  $menu_margin_bottom = '#nav-main {margin-bottom:10px;}';
}
//Typography
if(!empty($smof_data['font_header'])) {
  $font_family = 'h1, h2, h3, h4, h5, .headerfont, .tp-caption {font-family:'.$smof_data['font_header'].';} 
  .sf-menu a, .menufont, .topbarmenu ul li {font-family:'.$smof_data['font_menu'].';}
  body {font-family:'.$smof_data['font_body'].';}';
} else {
  $font_family = 'h1, h2, h3, h4, h5, .headerfont, .tp-caption {font-family:Lato;}
  .sf-menu a, .menufont, .topbarmenu ul li {font-family:Lato;}
  body {font-family:Verdana;}';
}
if(!empty($smof_data['font_h1'])) {
  $font_h1 = 'h1 {font-size:' . $smof_data['font_h1']['size']. '; font-weight:' . $smof_data['font_h1']['style']. '; line-height:' . $smof_data['font_h1']['height']. '; color:' . $smof_data['font_h1']['color']. ';}';
  } else {
    $font_h1 = 'h1 {font-size:38px; font-weight:normal; line-height:40px;}';
  }
  if(!empty($smof_data['font_h2'])) {
  $font_h2 = 'h2 {font-size:' . $smof_data['font_h2']['size']. '; font-weight:' . $smof_data['font_h2']['style']. '; line-height:' . $smof_data['font_h2']['height']. '; color:' . $smof_data['font_h2']['color']. ';}';
  } else {
    $font_h2 = 'h2 {font-size:32px; font-weight:normal; line-height:40px;}';
  }
  if(!empty($smof_data['font_h3'])) {
  $font_h3 = 'h3 {font-size:' . $smof_data['font_h3']['size']. '; font-weight:' . $smof_data['font_h3']['style']. '; line-height:' . $smof_data['font_h3']['height']. '; color:' . $smof_data['font_h3']['color']. ';}';
  } else {
    $font_h3 = 'h3 {font-size:28px; font-weight:200; line-height:40px;}';
  }
  if(!empty($smof_data['font_h4'])) {
  $font_h4 = 'h4 {font-size:' . $smof_data['font_h4']['size']. '; font-weight:' . $smof_data['font_h4']['style']. '; line-height:' . $smof_data['font_h4']['height']. '; color:' . $smof_data['font_h4']['color']. ';}';
  } else {
    $font_h4 = 'h4 {font-size:24px; font-weight:normal; line-height:40px;}';
  }
   if(!empty($smof_data['font_h5'])) {
  $font_h5 = 'h5 {font-size:' . $smof_data['font_h5']['size']. '; font-weight:' . $smof_data['font_h5']['style']. '; line-height:' . $smof_data['font_h5']['height']. '; color:' . $smof_data['font_h5']['color']. ';}';
  } else {
    $font_h5 = 'h5 {font-size:18px; font-weight:bold; line-height:24px;}';
  }
  if(!empty($smof_data['font_p'])) {
  $font_p = 'body {font-size:' . $smof_data['font_p']['size']. '; font-weight:' . $smof_data['font_p']['style']. '; line-height:' . $smof_data['font_p']['height']. '; color:' . $smof_data['font_p']['color']. ';} .sidebar a, .color_body, .author-name a, .author-latestposts h5 a, .author-latestposts h5, .nav-tabs > .active > a, .nav-tabs > .active > a:hover, .author-profile .author-occupation, .product_price {color:' . $smof_data['font_p']['color']. ';}';
  } else {
  $font_p = 'body {font-size:14px; font-weight:normal; line-height:20px;}';
  }
  if(!empty($smof_data['font_primary_menu'])) {
  $font_primary_menu = '#nav-main ul.sf-menu a {font-size:' . $smof_data['font_primary_menu']['size']. '; font-weight:' . $smof_data['font_primary_menu']['style']. '; line-height:' . $smof_data['font_primary_menu']['height']. '; color:' . $smof_data['font_primary_menu']['color']. ';}';
  } else {
    $font_primary_menu = '#nav-main ul.sf-menu a {font-size:12px; font-weight:normal; line-height:20px;}';
  }if(!empty($smof_data['font_secondary_menu'])) {
    $font_secondary_menu = '#nav-second ul.sf-menu a {font-size:' . $smof_data['font_secondary_menu']['size']. '; font-weight:' . $smof_data['font_secondary_menu']['style']. '; line-height:' . $smof_data['font_secondary_menu']['height']. '; color:' . $smof_data['font_secondary_menu']['color']. ';}';
  } else {
    $font_secondary_menu = '#nav-second ul.sf-menu a {font-size:18px; font-weight:normal; line-height:22px;}';
  }
  

//Basic Styling

if(!empty($smof_data['primary_color'])) {
  $primaryrgb = hex2rgb($smof_data['primary_color']); 
  $color_primary = '.home-message:hover {background-color:'.$smof_data['primary_color'].'; background-color: rgba('.$primaryrgb[0].', '.$primaryrgb[1].', '.$primaryrgb[2].', 0.6);}
  nav.woocommerce-pagination ul li a:hover, .wp-pagenavi a:hover, .accordion-heading .accordion-toggle.open {border-color: '.$smof_data['primary_color'].';}
  a, #nav-main ul.sf-menu ul li a:hover, .product_price ins .amount, .color_primary, .primary-color, #logo a.brand, #nav-main ul.sf-menu a:hover,
  .woocommerce-message:before, .woocommerce-info:before, #nav-second ul.sf-menu a:hover, .footerclass a:hover, .posttags a:hover, .subhead a:hover {color: '.$smof_data['primary_color'].';}
  .widget_price_filter .ui-slider .ui-slider-handle, .product_item .kad_add_to_cart:hover, .kad-btn-primary, .woocommerce-message .button, 
  #containerfooter .menu li a:hover, .bg_primary, .portfolionav a:hover, .home-iconmenu a:hover, p.demo_store, .topclass, #commentform .form-submit #submit {background: '.$smof_data['primary_color'].';}';
} else {
  $color_primary = '';
}
if(!empty($smof_data['primary20_color'])) {
  $color_primary30 =  'a:hover {color: '.$smof_data['primary20_color'].';} .kad-btn-primary:hover, .woocommerce-message .button:hover, #commentform .form-submit #submit:hover {background: '.$primary20.';}';
} else {
  $color_primary30 = '';
}
if(!empty($smof_data['gray_font_color'])) {
  $color_grayfont = '.color_gray, .subhead, .subhead a, .posttags, .posttags a, .product_meta a {color:'.$smof_data['gray_font_color'].';}';
} else {
  $color_grayfont = '';
}
if(!empty($smof_data['footerfont_color'])) {
  $color_footerfont = '#containerfooter h3, #containerfooter, .footercredits p, .footerclass a, .footernav ul li a {color:'.$smof_data['footerfont_color'].';}';
} else {
  $color_footerfont = '';
}

//Advanced Styling

if(!empty($smof_data['content_bg_color'])) {
$content_bg_color = $smof_data['content_bg_color'];
} else {
  $content_bg_color = '';
}
if(!empty($smof_data['content_bg_img'])) { 
  $content_bg_img = 'url('.$smof_data['content_bg_img'].')'; 
} else {
  $content_bg_img = '';
}
if(!empty($smof_data['content_bg_repeat'])) {
$content_bg_repeat = $smof_data['content_bg_repeat'];
} else {
  $content_bg_repeat = '';
}
if(!empty($smof_data['content_bg_placementx'])) {
  $content_bg_x = $smof_data['content_bg_placementx'];
} else {
  $content_bg_x = '';
}
if (!empty($smof_data['content_bg_placementy'])) {
$content_bg_y = $smof_data['content_bg_placementy']; 
} else {
  $content_bg_y = '';
}
if(!empty($smof_data['header_bg_color'])) {
$header_bg_color = $smof_data['header_bg_color'];
} else {
  $header_bg_color = '';
}
if(!empty($smof_data['header_bg_img'])) { 
  $header_bg_img = 'url('.$smof_data['header_bg_img'].')'; 
} else {
  $header_bg_img = '';
}
if(!empty($smof_data['header_bg_repeat'])) {
$header_bg_repeat = $smof_data['header_bg_repeat'];
} else {
  $header_bg_repeat = '';
}
if(!empty($smof_data['header_bg_placementx'])) {
$header_bg_x = $smof_data['header_bg_placementx'];
} else {
  $header_bg_x = '';
}
if(!empty($smof_data['header_bg_placementy'])) {
$header_bg_y = $smof_data['header_bg_placementy'];
} else {
  $header_bg_y = '';
}
if(!empty($smof_data['topbar_bg_color'])) {
$topbar_bg_color = $smof_data['topbar_bg_color'];
} else {
  $topbar_bg_color = '';
}
if(!empty($smof_data['topbar_bg_img'])) { 
  $topbar_bg_img = 'url('.$smof_data['topbar_bg_img'].')'; 
} else {
  $topbar_bg_img = '';
}
if(!empty($smof_data['topbar_bg_repeat'])) {
$topbar_bg_repeat = $smof_data['topbar_bg_repeat'];
} else {
  $topbar_bg_repeat = '';
}
if(!empty($smof_data['topbar_bg_placementx'])) {
$topbar_bg_x = $smof_data['topbar_bg_placementx'];
} else {
  $topbar_bg_x = '';
}
if(!empty($smof_data['topbar_bg_placementy'])) {
$topbar_bg_y = $smof_data['topbar_bg_placementy'];
} else {
  $topbar_bg_y = '';
}
if(!empty($smof_data['menu_bg_color'])) {
$menu_bg_color = $smof_data['menu_bg_color'];
} else {
  $menu_bg_color = '';
}
if(!empty($smof_data['menu_bg_img'])) {
 $menu_bg_img = 'url('.$smof_data['menu_bg_img'].')'; 
} else {
  $menu_bg_img = '';
}
if(!empty($smof_data['menu_bg_repeat'])) {
$menu_bg_repeat = $smof_data['menu_bg_repeat'];
} else {
  $menu_bg_repeat = '';
}
if(!empty($smof_data['menu_bg_placementx'])) {
$menu_bg_x = $smof_data['menu_bg_placementx'];
} else {
  $menu_bg_x = '';
}
if(!empty($smof_data['menu_bg_placementy'])) {
$menu_bg_y = $smof_data['menu_bg_placementy'];
} else {
  $menu_bg_y = '';
}

if(!empty($smof_data['feat_bg_color'])) {
$feat_bg_color = $smof_data['feat_bg_color'];
} else {
  $feat_bg_color = '';
}
if(!empty($smof_data['feat_bg_img'])) { 
  $feat_bg_img = 'url('.$smof_data['feat_bg_img'].')'; 
} else {
  $feat_bg_img = '';
}
if(!empty($smof_data['feat_bg_repeat'])) {
$feat_bg_repeat = $smof_data['feat_bg_repeat'];
} else {
  $feat_bg_repeat = '';
}
if(!empty($smof_data['feat_bg_placementx'])) {
$feat_bg_x = $smof_data['feat_bg_placementx'];
} else {
  $feat_bg_x = '';
}
if(!empty($smof_data['feat_bg_placementy'])) {
$feat_bg_y = $smof_data['feat_bg_placementy'];
} else {
  $feat_bg_y = '';
}
if(!empty($smof_data['footer_bg_color'])) {
$footer_bg_color = $smof_data['footer_bg_color'];
} else {
  $footer_bg_color = '';
}
if(!empty($smof_data['footer_bg_img'])) {
 $footer_bg_img = 'url('.$smof_data['footer_bg_img'].')'; 
} else {
  $footer_bg_img = '';
}
if(!empty($smof_data['footer_bg_repeat'])) {
$footer_bg_repeat = $smof_data['footer_bg_repeat'];
} else {
  $footer_bg_repeat = '';
}
if(!empty($smof_data['footer_bg_placementx'])) {
$footer_bg_x = $smof_data['footer_bg_placementx'];
} else {
  $footer_bg_x = '';
}
if(!empty($smof_data['footer_bg_placementy'])) {
$footer_bg_y = $smof_data['footer_bg_placementy'];
} else {
  $footer_bg_y = '';
}
if(!empty($smof_data['boxed_bg_color'])) {
$boxedbg_color = $smof_data['boxed_bg_color'];
} else {
  $boxedbg_color = '';
}
if(!empty($smof_data['boxed_bg_img'])) { 
  $boxedbg_img = 'url('.$smof_data['boxed_bg_img'].')'; 
} else {
  $boxedbg_img = '';
}
if(!empty($smof_data['boxed_bg_repeat'])) {
$boxedbg_repeat = $smof_data['boxed_bg_repeat'];
} else {
  $boxedbg_repeat = '';
}
if(!empty($smof_data['boxed_bg_placementx'])) {
$boxedbg_x = $smof_data['boxed_bg_placementx'];
} else {
  $boxedbg_x = '';
}
if(!empty($smof_data['boxed_bg_placementy'])) {
$boxedbg_y = $smof_data['boxed_bg_placementy'];
} else {
  $boxedbg_y = '';
}
if(!empty($smof_data['boxed_bg_fixed'])) {
$boxedbg_fixed = $smof_data['boxed_bg_fixed']; 
} else {
  $boxedbg_fixed = '';
}

if (!empty($smof_data['custom_css'])) {
  $custom_css = $smof_data['custom_css'];
} else {
  $custom_css = '';
}

echo $logo_font.$font_logo.$font_tagline.$tagline_font.$logo_padding_top.$logo_padding_bottom.$logo_padding_left.$logo_padding_right.$menu_margin_top.$menu_margin_bottom.$font_family.$font_h1.$font_h2.$font_h3.$font_h4.$font_h5.$font_p.$font_primary_menu.$font_secondary_menu.$color_primary.$color_primary30.$color_grayfont.$color_footerfont.'

  .contentclass, .nav-tabs>.active>a, .nav-tabs>.active>a:hover, .nav-tabs>.active>a:focus {background:'.$content_bg_color.' '.$content_bg_img.' '.$content_bg_repeat.' '.$content_bg_x.' '.$content_bg_y.';}
  .headerclass {background:'.$header_bg_color.' '.$header_bg_img.' '.$header_bg_repeat.' '.$header_bg_x.' '.$header_bg_y.';}
  .topclass {background:'.$topbar_bg_color.' '.$topbar_bg_img.' '.$topbar_bg_repeat.' '.$topbar_bg_x.' '.$topbar_bg_y.';}
  .navclass {background:'.$menu_bg_color.' '.$menu_bg_img.' '.$menu_bg_repeat.' '.$menu_bg_x.' '.$menu_bg_y.';}
  .featclass {background:'.$feat_bg_color.' '.$feat_bg_img.' '.$feat_bg_repeat.' '.$feat_bg_x.' '.$feat_bg_y.';}
  .footerclass {background:'.$footer_bg_color.' '.$footer_bg_img.' '.$footer_bg_repeat.' '.$footer_bg_x.' '.$footer_bg_y.';}
  body {background:'.$boxedbg_color.' '.$boxedbg_img.' '.$boxedbg_repeat.' '.$boxedbg_x.' '.$boxedbg_y.'; background-attachment:'.$boxedbg_fixed.';}

  '.$custom_css;
?>