<?php
/**
 * Theme activation
 */
function updatedatabaseoptions($oldname, $oldtheme=false) {

		$options =  get_theme_mods();  // Get old values
		// logo font
		if(isset($options['font_logo_style']['size'])) {
			$options['font_logo_style']['font-size'] = $options['font_logo_style']['size'];
		}
		if(isset($options['font_logo_style']['height'])) {
			$options['font_logo_style']['line-height'] = $options['font_logo_style']['height'];
		}
		//if(isset($options['font_logo_style']['style'])) {
		//	$options['font_logo_style']['font-style'] = $options['font_logo_style']['style'];
		//}
		if(isset($options['font_logo'])) {
			$options['font_logo_style']['font-family'] = $options['font_logo'];
		}
		// tagline font
		if(isset($options['font_tagline_style']['size'])) {
			$options['font_tagline_style']['font-size'] = $options['font_tagline_style']['size'];
		}
		if(isset($options['font_tagline_style']['height'])) {
			$options['font_tagline_style']['line-height'] = $options['font_tagline_style']['height'];
		}
	//	if(isset($options['font_tagline_style']['style'])) {
	//		$options['font_tagline_style']['font-style'] = $options['font_tagline_style']['style'];
	//	}
		if(isset($options['font_tagline'])) {
			$options['font_tagline_style']['font-family'] = $options['font_tagline'];
		}
		// H1 font
		if(isset($options['font_h1']['size'])) {
			$options['font_h1']['font-size'] = $options['font_h1']['size'];
		}
		if(isset($options['font_h1']['height'])) {
			$options['font_h1']['line-height'] = $options['font_h1']['height'];
		}
		//if(isset($options['font_h1']['style'])) {
	//		$options['font_h1']['font-style'] = $options['font_h1']['style'];
	//	}
		if(isset($options['font_header'])) {
			$options['font_h1']['font-family'] = $options['font_header'];
		}
		// H2 font
		if(isset($options['font_h2']['size'])) {
			$options['font_h2']['font-size'] = $options['font_h2']['size'];
		}
		if(isset($options['font_h2']['height'])) {
			$options['font_h2']['line-height'] = $options['font_h2']['height'];
		}
		//if(isset($options['font_h2']['style'])) {
		//	$options['font_h2']['font-style'] = $options['font_h2']['style'];
		//}
		if(isset($options['font_header'])) {
			$options['font_h2']['font-family'] = $options['font_header'];
		}
		// H3 font
		if(isset($options['font_h3']['size'])) {
			$options['font_h3']['font-size'] = $options['font_h3']['size'];
		}
		if(isset($options['font_h3']['height'])) {
			$options['font_h3']['line-height'] = $options['font_h3']['height'];
		}
		//if(isset($options['font_h3']['style'])) {
		//	$options['font_h3']['font-style'] = $options['font_h3']['style'];
		//}
		if(isset($options['font_header'])) {
			$options['font_h3']['font-family'] = $options['font_header'];
		}
		// H4 font
		if(isset($options['font_h4']['size'])) {
			$options['font_h4']['font-size'] = $options['font_h4']['size'];
		}
		if(isset($options['font_h4']['height'])) {
			$options['font_h4']['line-height'] = $options['font_h4']['height'];
		}
		//if(isset($options['font_h4']['style'])) {
		//	$options['font_h4']['font-style'] = $options['font_h4']['style'];
		//}
		if(isset($options['font_header'])) {
			$options['font_h4']['font-family'] = $options['font_header'];
		}
		// H5 font
		if(isset($options['font_h5']['size'])) {
			$options['font_h5']['font-size'] = $options['font_h5']['size'];
		}
		if(isset($options['font_h5']['height'])) {
			$options['font_h5']['line-height'] = $options['font_h5']['height'];
		}
		//if(isset($options['font_h5']['style'])) {
		//	$options['font_h5']['font-style'] = $options['font_h5']['style'];
		//}
		if(isset($options['font_header'])) {
			$options['font_h5']['font-family'] = $options['font_header'];
		}
		// Body font
		if(isset($options['font_p']['size'])) {
			$options['font_p']['font-size'] = $options['font_p']['size'];
		}
		if(isset($options['font_p']['height'])) {
			$options['font_p']['line-height'] = $options['font_p']['height'];
		}
		//if(isset($options['font_p']['style'])) {
		//	$options['font_p']['font-style'] = $options['font_p']['style'];
		//}
		//if(isset($options['font_body'])) {
		//	$options['font_p']['font-family'] = $options['font_body'];
	//	}
		// Menu font
		if(isset($options['font_primary_menu']['size'])) {
			$options['font_primary_menu']['font-size'] = $options['font_primary_menu']['size'];
		}
		if(isset($options['font_primary_menu']['height'])) {
			$options['font_primary_menu']['line-height'] = $options['font_primary_menu']['height'];
		}
		//if(isset($options['font_primary_menu']['style'])) {
		//	$options['font_primary_menu']['font-style'] = $options['font_primary_menu']['style'];
		//}
		if(isset($options['font_menu'])) {
			$options['font_primary_menu']['font-family'] = $options['font_menu'];
		}
		// Secondary Menu font
		if(isset($options['font_secondary_menu']['size'])) {
			$options['font_secondary_menu']['font-size'] = $options['font_secondary_menu']['size'];
		}
		if(isset($options['font_secondary_menu']['height'])) {
			$options['font_secondary_menu']['line-height'] = $options['font_secondary_menu']['height'];
		}
		//if(isset($options['font_secondary_menu']['style'])) {
		//	$options['font_secondary_menu']['font-style'] = $options['font_secondary_menu']['style'];
		//}
		if(isset($options['font_menu'])) {
			$options['font_secondary_menu']['font-family'] = $options['font_menu'];
		}
		// Mobile Menu font
		if(isset($options['font_mobile_menu']['size'])) {
			$options['font_mobile_menu']['font-size'] = $options['font_mobile_menu']['size'];
		}
		if(isset($options['font_mobile_menu']['height'])) {
			$options['font_mobile_menu']['line-height'] = $options['font_mobile_menu']['height'];
		}
		//if(isset($options['font_mobile_menu']['style'])) {
		//	$options['font_mobile_menu']['font-style'] = $options['font_mobile_menu']['style'];
		//}
		if(isset($options['font_menu'])) {
			$options['font_mobile_menu']['font-family'] = $options['font_menu'];
		}
		// IMAGES 
		// Logo upload
		$site_url = get_site_url();
		if(isset($options['logo_upload'])) {
			$options['x1_virtue_logo_upload']['url'] = str_replace('[site_url]', $site_url, $options['logo_upload']);
		}
		if(isset($options['x2logo_upload'])) {
			$options['x2_virtue_logo_upload']['url'] = str_replace('[site_url]', $site_url, $options['x2logo_upload']);
		}
		//banner
		if(isset($options['banner_upload'])) {
			$options['virtue_banner_upload']['url'] = str_replace('[site_url]', $site_url, $options['banner_upload']);
		}
		//content bg
		if(isset($options['content_bg_img'])) {
			$options['bg_content_bg_img']['url'] = str_replace('[site_url]', $site_url, $options['content_bg_img']);
		}
		//header bg
		if(isset($options['header_bg_img'])) {
			$options['bg_header_bg_img']['url'] = str_replace('[site_url]', $site_url, $options['header_bg_img']);
		}
		//topbar bg
		if(isset($options['topbar_bg_img'])) {
			$options['bg_topbar_bg_img']['url'] = str_replace('[site_url]', $site_url, $options['topbar_bg_img']);
		}
		//menu bg
		if(isset($options['menu_bg_img'])) {
			$options['bg_menu_bg_img']['url'] = str_replace('[site_url]', $site_url, $options['menu_bg_img']);
		}
		//mobile bg
		if(isset($options['mobile_bg_img'])) {
			$options['bg_mobile_bg_img']['url'] = str_replace('[site_url]', $site_url, $options['mobile_bg_img']);
		}
		//footer bg
		if(isset($options['footer_bg_img'])) {
			$options['bg_footer_bg_img']['url'] = str_replace('[site_url]', $site_url, $options['footer_bg_img']);
		}
		//boxed bg
		if(isset($options['boxed_bg_img'])) {
			$options['bg_boxed_bg_img']['url'] = str_replace('[site_url]', $site_url, $options['boxed_bg_img']);
		}
		//custom_favicon
		if(isset($options['custom_favicon'])) {
			$options['virtue_custom_favicon']['url'] = str_replace('[site_url]', $site_url, $options['custom_favicon']);
		}
		// Sidebars
		if(isset($options['c_sidebars'])) {
			$sidebarlist = array();
			$i = 1;
			foreach ($options['c_sidebars'] as $sidebar) {
				if(empty($sidebar['title'])) {$sidebar['title'] = 'sidebar'.$i;}
				$sidebarlist[] = $sidebar['title'];
				$i++; 
			}
			$options['cust_sidebars'] = $sidebarlist;
		}

		update_option('virtue', $options);
	
}
add_action("after_switch_theme", "updatedatabaseoptions", 10 ,  2);

