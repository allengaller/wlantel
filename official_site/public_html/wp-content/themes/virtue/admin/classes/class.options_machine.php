<?php 
/**
 * SMOF Options Machine Class
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.0.0
 * @author      Syamil MJ
 */
class Options_Machine {

	/**
	 * PHP5 contructor
	 *
	 * @since 1.0.0
	 */
	function __construct($options) {
		
		$return = $this->optionsframework_machine($options);
		
		$this->Inputs = $return[0];
		$this->Menu = $return[1];
		$this->Defaults = $return[2];
		
	}

	/** 
	 * Sanitize option
	 *
	 * Sanitize & returns default values if don't exist
	 * 
	 * Notes:
	 	- For further uses, you can check for the $value['type'] and performs
	 	  more speficic sanitization on the option
	 	- The ultimate objective of this function is to prevent the "undefined index"
	 	  errors some authors are having due to malformed options array
	 */
	static function sanitize_option( $value ) {
		$defaults = array(
			"name" 		=> "",
			"desc" 		=> "",
			"id" 		=> "",
			"std" 		=> "",
			"mod"		=> "",
			"type" 		=> ""
		);

		$value = wp_parse_args( $value, $defaults );

		return $value;

	}


	/**
	 * Process options data and build option fields
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function optionsframework_machine($options) {
		global $smof_output, $smof_details, $smof_data;
		if (empty($options))
			return;
		if (empty($smof_data))
			$smof_data = of_get_options();
		$data = $smof_data;

		$defaults = array();   
	    $counter = 0;
		$menu = '';
		$output = '';
		$update_data = false;

		do_action('optionsframework_machine_before', array(
				'options'	=> $options,
				'smof_data'	=> $smof_data,
			));
		if ($smof_output != "") {
			$output .= $smof_output;
			$smof_output = "";
		}



		foreach ($options as $value) {

			// sanitize option
			if ($value['type'] != "heading")
				$value = self::sanitize_option($value);

			$counter++;
			$val = '';

			//create array of defaults		
			if ($value['type'] == 'multicheck'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			}

			/* condition start */
			if(!empty($smof_data) || !empty($data)){

				if (array_key_exists('id', $value) && !isset($smof_data[$value['id']])) {
					$smof_data[$value['id']] = $value['std'];
					if ($value['type'] == "checkbox" && $value['std'] == 0) {
						$smof_data[$value['id']] = 0;
					} else {
						$update_data = true;
					}
				}
				if (array_key_exists('id', $value) && !isset($smof_details[$value['id']])) {
					$smof_details[$value['id']] = $smof_data[$value['id']];
				}

			//Start Heading
			 if ( $value['type'] != "heading" )
			 {
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }

				//hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {
					if (isset($smof_data[$value['fold']]) && $smof_data[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}

				$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";

				//only show header if 'name' value exists
				if($value['name']) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";

				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

			 } 
			 //End Heading

			//if (!isset($smof_data[$value['id']]) && $value['type'] != "heading")
			//	continue;
			
			//switch statement to handle various options type                              
			switch ( $value['type'] ) {
			
				//text input
				case 'text':
					$t_value = '';
					$t_value = stripslashes($smof_data[$value['id']]);
					
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					
					$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
				break;
				
				//select option
				case 'select':
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';

					foreach ($value['options'] as $select_ID => $option) {
						$theValue = $option;
						if (!is_numeric($select_ID))
							$theValue = $select_ID;
						$output .= '<option id="' . $select_ID . '" value="'.$theValue.'" ' . selected($smof_data[$value['id']], $theValue, false) . ' />'.$option.'</option>';	 
					 } 
					$output .= '</select></div>';
				break;
				
				//textarea option
				case 'textarea':	
					$cols = '8';
					$ta_value = '';
					
					if(isset($value['options'])){
							$ta_options = $value['options'];
							if(isset($ta_options['cols'])){
							$cols = $ta_options['cols'];
							} 
						}
						
						$ta_value = stripslashes($smof_data[$value['id']]);			
						$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';		
				break;
				
				//radiobox option
				case "radio":
					$checked = (isset($smof_data[$value['id']])) ? checked($smof_data[$value['id']], $option, false) : '';
					 foreach($value['options'] as $option=>$name) {
						$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($smof_data[$value['id']], $option, false) . ' /><label class="radio">'.$name.'</label><br/>';				
					}
				break;
				
				//checkbox option
				case 'checkbox':
					if (!isset($smof_data[$value['id']])) {
						$smof_data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
				break;
				
				//multiple checkbox option
				case 'multicheck': 			
					(isset($smof_data[$value['id']]))? $multi_stored = $smof_data[$value['id']] : $multi_stored="";
								
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';								
					}			 
				break;
				
				// Color picker
				case "color":
					$default_color = '';
					if ( isset($value['std']) ) {
						if ( $smof_data[$value['id']] !=  $value['std'] )
							$default_color = ' data-default-color="' .$value['std'] . '" ';
					}
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" class="of-color"  type="text" value="' . $smof_data[$value['id']] . '"' . $default_color .' />';
		 	
				break;

				//typography option	
				case 'typography':
				
					$typography_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];
					
					/* Font Size */
					
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 73; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
					
					/* Line Height */
					if(isset($typography_stored['height'])) {
					
						$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
						$output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							for ($i = 14; $i < 73; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
						
					/* Font Face */
					if(isset($typography_stored['face'])) {
					
						$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
						$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						
						$faces = array('arial'=>'Arial',
										'verdana'=>'Verdana, Geneva',
										'trebuchet'=>'Trebuchet',
										'georgia' =>'Georgia',
										'times'=>'Times New Roman',
										'tahoma'=>'Tahoma, Geneva',
										'palatino'=>'Palatino',
										'helvetica'=>'Helvetica' );			
						foreach ($faces as $i=>$face) {
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
						}			
										
						$output .= '</select></div>';
					
					}
					
					/* Font Weight */
					if(isset($typography_stored['style'])) {
					
						$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
						$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
						$styles = array('normal'=>'Normal',
										'200'=>'Light',
										'bold'=>'Bold');
										
						foreach ($styles as $i=>$style){
						
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
						}
						$output .= '</select></div>';
					
					}
					
					/* Font Color */
					if(isset($typography_stored['color'])) {
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
					
					}
					
				break;
				
				//border option
				case 'border':
						
					/* Border Width */
					$border_stored = $smof_data[$value['id']];
					
					$output .= '<div class="select_wrapper border-width">';
					$output .= '<select class="of-border of-border-width select" name="'.$value['id'].'[width]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 21; $i++){ 
						$output .= '<option value="'. $i .'" ' . selected($border_stored['width'], $i, false) . '>'. $i .'</option>';				 }
					$output .= '</select></div>';
					
					/* Border Style */
					$output .= '<div class="select_wrapper border-style">';
					$output .= '<select class="of-border of-border-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
					
					$styles = array('none'=>'None',
									'solid'=>'Solid',
									'dashed'=>'Dashed',
									'dotted'=>'Dotted');
									
					foreach ($styles as $i=>$style){
						$output .= '<option value="'. $i .'" ' . selected($border_stored['style'], $i, false) . '>'. $style .'</option>';		
					}
					
					$output .= '</select></div>';
					
					/* Border Color */		
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$border_stored['color'].'"></div></div>';
					$output .= '<input class="of-color of-border of-border-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $border_stored['color'] .'" />';
					
				break;
				
				//images checkbox - use image as checkboxes
				case 'images':
				
					$i = 0;
					
					$select_value = (isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : '';
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $key, false)) {
							$checked = checked($select_value, $key, false);
							$selected = 'of-radio-img-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-img-label">'. $key .'</div>';
						$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
						$output .= '</span>';				
					}
					
				break;
				
				//info (for small intro box etc)
				case "info":
					$info_text = $value['std'];
					$output .= '<div class="of-info">'.$info_text.'</div>';
				break;
				
				//display a single image
				case "image":
					$src = $value['std'];
					$output .= '<img src="'.$src.'">';
				break;
				
				//tab heading
				case 'heading':
					if($counter >= 2){
					   $output .= '</div>'."\n";
					}
					//custom icon
					$icon = '';
					if(isset($value['icon'])){
						$icon = ' style="background-image: url('. $value['icon'] .');"';
					}
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($jquery_click_hook))))));
					
					$menu .= '<li class="'. $header_class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'"'. $icon .'>'.  $value['name'] .'</a></li>';
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
				break;
				
				//drag & drop slide manager
				case 'slider':
					$output .= '<div class="slider"><ul id="'.$value['id'].'">';
					$slides = $smof_data[$value['id']];
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
						}
					}			
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';
					
				break;

				case 'sidebars':
					$output .= '<div class="slider"><ul id="'.$value['id'].'">';
					$sidebars = $smof_data[$value['id']];
					$count = count($sidebars);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_sidebars_function($value['id'],$value['std'],$oldorder,$order);
					} else {
						$i = 0;
						foreach ($sidebars as $sidebar) {
							$oldorder = $sidebar['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_sidebars_function($value['id'],$value['std'],$oldorder,$order);
						}
					}			
					$output .= '</ul>';
					$output .= '<a href="#" class="button sidebar_add_button">Add New Sidebar</a></div>';
					
				break;

				case 'icons':
					$output .= '<div class="slider"><ul id="'.$value['id'].'">';
					$icons = $smof_data[$value['id']];
					$count = count($icons);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_icons_function($value['id'],$value['std'],$oldorder,$order);
					} else {
						$i = 0;
						foreach ($icons as $icon) {
							$oldorder = $icon['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_icons_function($value['id'],$value['std'],$oldorder,$order);
						}
					}			
					$output .= '</ul>';
					$output .= '<a href="#" class="button icon_add_button">Add New Icon</a></div>';
					
				break;
				
				//drag & drop block manager
				case 'sorter':

				    // Make sure to get list of all the default blocks first
				    $all_blocks = $value['std'];

				    $temp = array(); // holds default blocks
				    $temp2 = array(); // holds saved blocks

					foreach($all_blocks as $blocks) {
					    $temp = array_merge($temp, $blocks);
					}

				    $sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];

				    foreach( $sortlists as $sortlist ) {
					$temp2 = array_merge($temp2, $sortlist);
				    }

				    // now let's compare if we have anything missing
				    foreach($temp as $k => $v) {
					if(!array_key_exists($k, $temp2)) {
					    $sortlists['disabled'][$k] = $v;
					}
				    }

				    // now check if saved blocks has blocks not registered under default blocks
				    foreach( $sortlists as $key => $sortlist ) {
					foreach($sortlist as $k => $v) {
					    if(!array_key_exists($k, $temp)) {
						unset($sortlist[$k]);
					    }
					}
					$sortlists[$key] = $sortlist;
				    }

				    // assuming all sync'ed, now get the correct naming for each block
				    foreach( $sortlists as $key => $sortlist ) {
					foreach($sortlist as $k => $v) {
					    $sortlist[$k] = $temp[$k];
					}
					$sortlists[$key] = $sortlist;
				    }

				    $output .= '<div id="'.$value['id'].'" class="sorter">';


				    if ($sortlists) {

					foreach ($sortlists as $group=>$sortlist) {

					    $output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
					    $output .= '<h3>'.$group.'</h3>';

					    foreach ($sortlist as $key => $list) {

						$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';

						if ($key != "placebo") {

						    $output .= '<li id="'.$key.'" class="sortee">';
						    $output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
						    $output .= $list;
						    $output .= '</li>';

						}

					    }

					    $output .= '</ul>';
					}
				    }

				    $output .= '</div>';
				break;
				
				//background images option
				case 'tiles':
					
					$i = 0;
					$select_value = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
					if (is_array($value['options'])) {
						foreach ($value['options'] as $key => $option) { 
						$i++;
				
							$checked = '';
							$selected = '';
							if(NULL!=checked($select_value, $option, false)) {
								$checked = checked($select_value, $option, false);
								$selected = 'of-radio-tile-selected';  
							}
							$output .= '<span>';
							$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'.$option.'" name="'.$value['id'].'" '.$checked.' />';
							$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
							$output .= '</span>';				
						}
					}
					
				break;
				
				//backup and restore options data
				case 'backup':
				
					$instructions = $value['desc'];
					$backup = of_get_options(BACKUPS);
					$init = of_get_options('smof_init');


					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}
					
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>'. __('Last Backup : ', 'virtue').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
					$output .= '</div>';
				
				break;
				
				// google font field
				case 'select_google_font':
					$output .= '<div class="select_wrapper">';
					$output .= '<select class="select of-input google_font_select" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_key => $option) {
						$output .= '<option value="'.$select_key.'" ' . selected((isset($smof_data[$value['id']]))? $smof_data[$value['id']] : "", $option, false) . ' />'.$option.'</option>';
					} 
					$output .= '</select></div>';
					
					if(isset($value['preview']['text'])){
						$g_text = $value['preview']['text'];
					} else {
						$g_text = '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
					}
					if(isset($value['preview']['size'])) {
						$g_size = 'style="font-size: '. $value['preview']['size'] .';"';
					} else { 
						$g_size = '';
					}
					$hide = " hide";
					if ($smof_data[$value['id']] != "none" && $smof_data[$value['id']] != "")
						$hide = "";
					
					$output .= '<p class="'.$value['id'].'_ggf_previewer google_font_preview'.$hide.'" '. $g_size .'>'. $g_text .'</p>';
				break;
				
				//JQuery UI Slider
				case 'sliderui':
					$s_val = $s_min = $s_max = $s_step = $s_edit = '';//no errors, please
					
					$s_val  = stripslashes($smof_data[$value['id']]);
					
					if(!isset($value['min'])){ $s_min  = '0'; }else{ $s_min = $value['min']; }
					if(!isset($value['max'])){ $s_max  = $s_min + 1; }else{ $s_max = $value['max']; }
					if(!isset($value['step'])){ $s_step  = '1'; }else{ $s_step = $value['step']; }
					
					if(!isset($value['edit'])){ 
						$s_edit  = ' readonly="readonly"'; 
					}
					else
					{
						$s_edit  = '';
					}
					
					if ($s_val == '') $s_val = $s_min;
					
					//values
					$s_data = 'data-id="'.$value['id'].'" data-val="'.$s_val.'" data-min="'.$s_min.'" data-max="'.$s_max.'" data-step="'.$s_step.'"';
					
					//html output
					$output .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'. $s_val .'" class="mini" '. $s_edit .' />';
					$output .= '<div id="'.$value['id'].'-slider" class="smof_sliderui" style="margin-left: 7px;" '. $s_data .'></div>';
					
				break;
				
				
				//Switch option
				case 'switch':
					if (!isset($smof_data[$value['id']])) {
						$smof_data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="s_fld ";
					
					$cb_enabled = $cb_disabled = '';//no errors, please
					
					//Get selected
					if ($smof_data[$value['id']] == 1){
						$cb_enabled = ' selected';
						$cb_disabled = '';
					}else{
						$cb_enabled = '';
						$cb_disabled = ' selected';
					}
					
					//Label ON
					if(!isset($value['on'])){
						$on = "On";
					}else{
						$on = $value['on'];
					}
					
					//Label OFF
					if(!isset($value['off'])){
						$off = "Off";
					}else{
						$off = $value['off'];
					}
					
					$output .= '<p class="switch-options">';
						$output .= '<label class="'.$fold.'cb-enable'. $cb_enabled .'" data-id="'.$value['id'].'"><span>'. $on .'</span></label>';
						$output .= '<label class="'.$fold.'cb-disable'. $cb_disabled .'" data-id="'.$value['id'].'"><span>'. $off .'</span></label>';
						
						$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
						$output .= '<input type="checkbox" id="'.$value['id'].'" class="'.$fold.'checkbox of-input main_checkbox" name="'.$value['id'].'"  value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
						
					$output .= '</p>';
					
				break;

				// Uploader 3.5
				case "upload":
				case "media":

					if(!isset($value['mod'])) $value['mod'] = '';
					
					$u_val = '';
					if($smof_data[$value['id']]){
						$u_val = stripslashes($smof_data[$value['id']]);
					}

					$output .= Options_Machine::optionsframework_media_uploader_function($value['id'],$u_val, $value['mod']);
					
				break;
				
			}

			do_action('optionsframework_machine_loop', array(
					'options'	=> $options,
					'smof_data'	=> $smof_data,
					'defaults'	=> $defaults,
					'counter'	=> $counter,
					'menu'		=> $menu,
					'output'	=> $output,
					'value'		=> $value
				));
			$output .= $smof_output;
			
			//description of each option
			if ( $value['type'] != 'heading') { 
				if(!isset($value['desc'])){ $explain_value = ''; } else{ 
					$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n"; 
				} 
				$output .= '</div>'.$explain_value."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
				}
			
			} /* condition empty end */
		   
		}
		
	    $output .= '</div>';

	    do_action('optionsframework_machine_after', array(
					'options'		=> $options,
					'smof_data'		=> $smof_data,
					'defaults'		=> $defaults,
					'counter'		=> $counter,
					'menu'			=> $menu,
					'output'		=> $output,
					'value'			=> $value
				));
	    $output .= $smof_output;
	    
	    return array($output,$menu,$defaults);
	    
	}


	/**
	 * Native media library uploader
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id,$std,$mod){

	    $data = of_get_options();
	    $smof_data = of_get_options();
		
		$uploader = '';
		$upload = "";
		if (isset($smof_data[$id]))
	    	$upload = $smof_data[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		//Upload controls DIV
		$uploader .= '<div class="upload_button_div">';
		//If the user has WP3.5+ show upload/remove button
		if ( function_exists( 'wp_enqueue_media' ) ) {
			$uploader .= '<span class="button media_upload_button" id="'.$id.'">Upload</span>';
			
			if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
			$uploader .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		}
		else 
		{
			$output .= '<p class="upload-notice"><i>Upgrade your version of WordPress for full media support.</i></p>';
		}

		$uploader .='</div>' . "\n";

		//Preview
		$uploader .= '<div class="screenshot">';
		if(!empty($upload)){	
	    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';			
			}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
		
	}

	/**
	 * Drag and drop slides manager
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order){
		
	    $data = of_get_options();
	    $smof_data = of_get_options();
		
		$slider = '';
		$slide = array();
		if (isset($smof_data[$id]))
	    	$slide = $smof_data[$id];
		
	    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
		
		//initialize all vars
		$slidevars = array('title','url','link','description');
		
		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}
		
		//begin slider interface	
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>Slide '.$order.'</strong>';
		}
		
		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	
		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		
		$slider .= '<div class="slide_body">';
		
		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		
		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="upload slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';
		
		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'">Upload</span>';
		
		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){
			
	    	$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
	    	$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
	    	$slider .= '</a>';
			
			}
		$slider .= '</div>';	
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		
		$slider .= '<label>Description (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';
	
		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	    $slider .= '<div class="clear"></div>' . "\n";
	
		$slider .= '</div>';
		$slider .= '</li>';
	
		return $slider;
		
	}
	public static function optionsframework_sidebars_function($id,$std,$oldorder,$order){
	
	    $data = of_get_options();
	    $smof_data = of_get_options();
		
		$sidebars = '';
		$sidebar = array();
		if (isset($smof_data[$id]))
	    	$sidebar = $smof_data[$id];
		
	    if (isset($sidebar[$oldorder])) { $val = $sidebar[$oldorder]; } else {$val = $std;}
		
		//initialize all vars
		$sidebarvars = array('title','url','link','description');
		
		foreach ($sidebarvars as $sidebarvar) {
			if (!isset($val[$sidebarvar])) {
				$val[$sidebarvar] = '';
			}
		}
		//begin sidebar interface	
		if (!empty($val['title'])) {
			$sidebars .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$sidebars .= '<li><div class="slide_header"><strong>Sidebar '.$order.'</strong>';
		}
		
		$sidebars .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	
		$sidebars .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		
		$sidebars .= '<div class="slide_body">';
		
		$sidebars .= '<label>Sidebar Name</label>';
		$sidebars .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';		
	
		$sidebars .= '<a class="slide_delete_button" href="#">Delete</a>';
	    $sidebars .= '<div class="clear"></div>' . "\n";
	
		$sidebars .= '</div>';
		$sidebars.= '</li>';
	
		return $sidebars;
		
	}
		public static function optionsframework_icons_function($id,$std,$oldorder,$order){
	
	    $data = of_get_options();
	    $smof_data = of_get_options();
		
		$icons = '';
		$icon = array();
		if (isset($smof_data[$id]))
	    	$icon = $smof_data[$id];
		
	    if (isset($icon[$oldorder])) { $val = $icon[$oldorder]; } else {$val = $std;}
		
		//initialize all vars
		$iconvars = array('title','icon','url','link');
		
		foreach ($iconvars as $iconvar) {
			if (!isset($val[$iconvar])) {
				$val[$iconvar] = '';
			}
		}
		
		//begin social interface	
		if (!empty($val['title'])) {
			$icons .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$icons .= '<li><div class="slide_header"><strong>Icon '.$order.'</strong>';
		}
		
		$icons .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	
		$icons .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		
		$icons .= '<div class="slide_body">';
		
		$icons .= '<label>Title</label>';
		$icons .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		
		$icons .= '<label>Choose a preset icon</label>';
		if(!empty($val['icon_o'])) {
			$icons .= '<select class="select of-input kad_icomoon" name="'. $id .'['.$order.'][icon_o]" id="'. $id.'_'.$order.'_icon" value="'. $val['icon_o'].'" />';
			} else {
			$icons .= '<select class="select of-input kad_icomoon" name="'. $id .'['.$order.'][icon_o]" id="'. $id.'_'.$order.'_icon" value="icon-home" />';
			}
			$icon_option = array(
			"icon-glass " => "icon-glass ", "icon-music " => "icon-music ", "icon-search " => "icon-search ", "icon-envelope-alt " => "icon-envelope-alt ", "icon-heart " => "icon-heart ", "icon-star " => "icon-star ", "icon-star-empty " => "icon-star-empty ", "icon-user " => "icon-user ", "icon-film " => "icon-film ", "icon-th-large " => "icon-th-large ", "icon-th " => "icon-th ", "icon-th-list " => "icon-th-list ", "icon-ok " => "icon-ok ", "icon-remove " => "icon-remove ", "icon-zoom-in " => "icon-zoom-in ", "icon-zoom-out " => "icon-zoom-out ", "icon-power-off" => "icon-power-off", "icon-off " => "icon-off ", "icon-signal " => "icon-signal ", "icon-gear" => "icon-gear", "icon-cog " => "icon-cog ", "icon-trash " => "icon-trash ", "icon-home " => "icon-home ", "icon-file-alt " => "icon-file-alt ", "icon-time " => "icon-time ", "icon-road " => "icon-road ", "icon-download-alt " => "icon-download-alt ", "icon-download " => "icon-download ", "icon-upload " => "icon-upload ", "icon-inbox " => "icon-inbox ", "icon-play-circle " => "icon-play-circle ", "icon-rotate-right" => "icon-rotate-right", "icon-repeat " => "icon-repeat ", "icon-refresh " => "icon-refresh ", "icon-list-alt " => "icon-list-alt ", "icon-lock " => "icon-lock ", "icon-flag " => "icon-flag ", "icon-headphones " => "icon-headphones ", "icon-volume-off " => "icon-volume-off ", "icon-volume-down " => "icon-volume-down ", "icon-volume-up " => "icon-volume-up ", "icon-qrcode " => "icon-qrcode ", "icon-barcode " => "icon-barcode ", "icon-tag " => "icon-tag ", "icon-tags " => "icon-tags ", "icon-book " => "icon-book ", "icon-bookmark " => "icon-bookmark ", "icon-print " => "icon-print ", "icon-camera " => "icon-camera ", "icon-font " => "icon-font ", "icon-bold " => "icon-bold ", "icon-italic " => "icon-italic ", "icon-text-height " => "icon-text-height ", "icon-text-width " => "icon-text-width ", "icon-align-left " => "icon-align-left ", "icon-align-center " => "icon-align-center ", "icon-align-right " => "icon-align-right ", "icon-align-justify " => "icon-align-justify ", "icon-list " => "icon-list ", "icon-indent-left " => "icon-indent-left ", "icon-indent-right " => "icon-indent-right ", "icon-facetime-video " => "icon-facetime-video ", "icon-picture " => "icon-picture ", "icon-pencil " => "icon-pencil ", "icon-map-marker " => "icon-map-marker ", "icon-adjust " => "icon-adjust ", "icon-tint " => "icon-tint ", "icon-edit " => "icon-edit ", "icon-share " => "icon-share ", "icon-check " => "icon-check ", "icon-move " => "icon-move ", "icon-step-backward " => "icon-step-backward ", "icon-fast-backward " => "icon-fast-backward ", "icon-backward " => "icon-backward ", "icon-play " => "icon-play ", "icon-pause " => "icon-pause ", "icon-stop " => "icon-stop ", "icon-forward " => "icon-forward ", "icon-fast-forward " => "icon-fast-forward ", "icon-step-forward " => "icon-step-forward ", "icon-eject " => "icon-eject ", "icon-chevron-left " => "icon-chevron-left ", "icon-chevron-right " => "icon-chevron-right ", "icon-plus-sign " => "icon-plus-sign ", "icon-minus-sign " => "icon-minus-sign ", "icon-remove-sign " => "icon-remove-sign ", "icon-ok-sign " => "icon-ok-sign ", "icon-question-sign " => "icon-question-sign ", "icon-info-sign " => "icon-info-sign ", "icon-screenshot " => "icon-screenshot ", "icon-remove-circle " => "icon-remove-circle ", "icon-ok-circle " => "icon-ok-circle ", "icon-ban-circle " => "icon-ban-circle ", "icon-arrow-left " => "icon-arrow-left ", "icon-arrow-right " => "icon-arrow-right ", "icon-arrow-up " => "icon-arrow-up ", "icon-arrow-down " => "icon-arrow-down ", "icon-mail-forward:before" => "icon-mail-forward:before", "icon-share-alt " => "icon-share-alt ", "icon-resize-full " => "icon-resize-full ", "icon-resize-small " => "icon-resize-small ", "icon-plus " => "icon-plus ", "icon-minus " => "icon-minus ", "icon-asterisk " => "icon-asterisk ", "icon-exclamation-sign " => "icon-exclamation-sign ", "icon-gift " => "icon-gift ", "icon-leaf " => "icon-leaf ", "icon-fire " => "icon-fire ", "icon-eye-open " => "icon-eye-open ", "icon-eye-close " => "icon-eye-close ", "icon-warning-sign " => "icon-warning-sign ", "icon-plane " => "icon-plane ", "icon-calendar " => "icon-calendar ", "icon-random " => "icon-random ", "icon-comment " => "icon-comment ", "icon-magnet " => "icon-magnet ", "icon-chevron-up " => "icon-chevron-up ", "icon-chevron-down " => "icon-chevron-down ", "icon-retweet " => "icon-retweet ", "icon-shopping-cart " => "icon-shopping-cart ", "icon-folder-close " => "icon-folder-close ", "icon-folder-open " => "icon-folder-open ", "icon-resize-vertical " => "icon-resize-vertical ", "icon-resize-horizontal " => "icon-resize-horizontal ", "icon-bar-chart " => "icon-bar-chart ", "icon-twitter-sign " => "icon-twitter-sign ", "icon-facebook-sign " => "icon-facebook-sign ", "icon-camera-retro " => "icon-camera-retro ", "icon-key " => "icon-key ", "icon-gears" => "icon-gears", "icon-cogs " => "icon-cogs ", "icon-comments " => "icon-comments ", "icon-thumbs-up-alt " => "icon-thumbs-up-alt ", "icon-thumbs-down-alt " => "icon-thumbs-down-alt ", "icon-star-half " => "icon-star-half ", "icon-heart-empty " => "icon-heart-empty ", "icon-signout " => "icon-signout ", "icon-linkedin-sign " => "icon-linkedin-sign ", "icon-pushpin " => "icon-pushpin ", "icon-external-link " => "icon-external-link ", "icon-signin " => "icon-signin ", "icon-trophy " => "icon-trophy ", "icon-github-sign " => "icon-github-sign ", "icon-upload-alt " => "icon-upload-alt ", "icon-lemon " => "icon-lemon ", "icon-phone " => "icon-phone ", "icon-unchecked" => "icon-unchecked", "icon-check-empty " => "icon-check-empty ", "icon-bookmark-empty " => "icon-bookmark-empty ", "icon-phone-sign " => "icon-phone-sign ", "icon-twitter " => "icon-twitter ", "icon-facebook " => "icon-facebook ", "icon-github " => "icon-github ", "icon-unlock " => "icon-unlock ", "icon-credit-card " => "icon-credit-card ", "icon-rss " => "icon-rss ", "icon-hdd " => "icon-hdd ", "icon-bullhorn " => "icon-bullhorn ", "icon-bell " => "icon-bell ", "icon-certificate " => "icon-certificate ", "icon-hand-right " => "icon-hand-right ", "icon-hand-left " => "icon-hand-left ", "icon-hand-up " => "icon-hand-up ", "icon-hand-down " => "icon-hand-down ", "icon-circle-arrow-left " => "icon-circle-arrow-left ", "icon-circle-arrow-right " => "icon-circle-arrow-right ", "icon-circle-arrow-up " => "icon-circle-arrow-up ", "icon-circle-arrow-down " => "icon-circle-arrow-down ", "icon-globe " => "icon-globe ", "icon-wrench " => "icon-wrench ", "icon-tasks " => "icon-tasks ", "icon-filter " => "icon-filter ", "icon-briefcase " => "icon-briefcase ", "icon-fullscreen " => "icon-fullscreen ", "icon-group " => "icon-group ", "icon-link " => "icon-link ", "icon-cloud " => "icon-cloud ", "icon-beaker " => "icon-beaker ", "icon-cut " => "icon-cut ", "icon-copy " => "icon-copy ", "icon-paperclip" => "icon-paperclip", "icon-paper-clip " => "icon-paper-clip ", "icon-save " => "icon-save ", "icon-sign-blank " => "icon-sign-blank ", "icon-reorder " => "icon-reorder ", "icon-list-ul " => "icon-list-ul ", "icon-list-ol " => "icon-list-ol ", "icon-strikethrough " => "icon-strikethrough ", "icon-underline " => "icon-underline ", "icon-table " => "icon-table ", "icon-magic " => "icon-magic ", "icon-truck " => "icon-truck ", "icon-pinterest " => "icon-pinterest ", "icon-pinterest-sign " => "icon-pinterest-sign ", "icon-google-plus-sign " => "icon-google-plus-sign ", "icon-google-plus " => "icon-google-plus ", "icon-money " => "icon-money ", "icon-caret-down " => "icon-caret-down ", "icon-caret-up " => "icon-caret-up ", "icon-caret-left " => "icon-caret-left ", "icon-caret-right " => "icon-caret-right ", "icon-columns " => "icon-columns ", "icon-sort " => "icon-sort ", "icon-sort-down " => "icon-sort-down ", "icon-sort-up " => "icon-sort-up ", "icon-envelope " => "icon-envelope ", "icon-linkedin " => "icon-linkedin ", "icon-rotate-left" => "icon-rotate-left", "icon-undo " => "icon-undo ", "icon-legal " => "icon-legal ", "icon-dashboard " => "icon-dashboard ", "icon-comment-alt " => "icon-comment-alt ", "icon-comments-alt " => "icon-comments-alt ", "icon-bolt " => "icon-bolt ", "icon-sitemap " => "icon-sitemap ", "icon-umbrella " => "icon-umbrella ", "icon-paste " => "icon-paste ", "icon-lightbulb " => "icon-lightbulb ", "icon-exchange " => "icon-exchange ", "icon-cloud-download " => "icon-cloud-download ", "icon-cloud-upload " => "icon-cloud-upload ", "icon-user-md " => "icon-user-md ", "icon-stethoscope " => "icon-stethoscope ", "icon-suitcase " => "icon-suitcase ", "icon-bell-alt " => "icon-bell-alt ", "icon-coffee " => "icon-coffee ", "icon-food " => "icon-food ", "icon-file-text-alt " => "icon-file-text-alt ", "icon-building " => "icon-building ", "icon-hospital " => "icon-hospital ", "icon-ambulance " => "icon-ambulance ", "icon-medkit " => "icon-medkit ", "icon-fighter-jet " => "icon-fighter-jet ", "icon-beer " => "icon-beer ", "icon-h-sign " => "icon-h-sign ", "icon-plus-sign-alt " => "icon-plus-sign-alt ", "icon-double-angle-left " => "icon-double-angle-left ", "icon-double-angle-right " => "icon-double-angle-right ", "icon-double-angle-up " => "icon-double-angle-up ", "icon-double-angle-down " => "icon-double-angle-down ", "icon-angle-left " => "icon-angle-left ", "icon-angle-right " => "icon-angle-right ", "icon-angle-up " => "icon-angle-up ", "icon-angle-down " => "icon-angle-down ", "icon-desktop " => "icon-desktop ", "icon-laptop " => "icon-laptop ", "icon-tablet " => "icon-tablet ", "icon-mobile-phone " => "icon-mobile-phone ", "icon-circle-blank " => "icon-circle-blank ", "icon-quote-left " => "icon-quote-left ", "icon-quote-right " => "icon-quote-right ", "icon-spinner " => "icon-spinner ", "icon-circle " => "icon-circle ", "icon-mail-reply" => "icon-mail-reply", "icon-reply " => "icon-reply ", "icon-github-alt " => "icon-github-alt ", "icon-folder-close-alt " => "icon-folder-close-alt ", "icon-folder-open-alt " => "icon-folder-open-alt ", "icon-expand-alt " => "icon-expand-alt ", "icon-collapse-alt " => "icon-collapse-alt ", "icon-smile " => "icon-smile ", "icon-frown " => "icon-frown ", "icon-meh " => "icon-meh ", "icon-gamepad " => "icon-gamepad ", "icon-keyboard " => "icon-keyboard ", "icon-flag-alt " => "icon-flag-alt ", "icon-flag-checkered " => "icon-flag-checkered ", "icon-terminal " => "icon-terminal ", "icon-code " => "icon-code ", "icon-reply-all " => "icon-reply-all ", "icon-mail-reply-all " => "icon-mail-reply-all ", "icon-star-half-full" => "icon-star-half-full", "icon-star-half-empty " => "icon-star-half-empty ", "icon-location-arrow " => "icon-location-arrow ", "icon-crop " => "icon-crop ", "icon-code-fork " => "icon-code-fork ", "icon-unlink " => "icon-unlink ", "icon-question " => "icon-question ", "icon-info " => "icon-info ", "icon-exclamation " => "icon-exclamation ", "icon-superscript " => "icon-superscript ", "icon-subscript " => "icon-subscript ", "icon-eraser " => "icon-eraser ", "icon-puzzle-piece " => "icon-puzzle-piece ", "icon-microphone " => "icon-microphone ", "icon-microphone-off " => "icon-microphone-off ", "icon-shield " => "icon-shield ", "icon-calendar-empty " => "icon-calendar-empty ", "icon-fire-extinguisher " => "icon-fire-extinguisher ", "icon-rocket " => "icon-rocket ", "icon-maxcdn " => "icon-maxcdn ", "icon-chevron-sign-left " => "icon-chevron-sign-left ", "icon-chevron-sign-right " => "icon-chevron-sign-right ", "icon-chevron-sign-up " => "icon-chevron-sign-up ", "icon-chevron-sign-down " => "icon-chevron-sign-down ", "icon-html5 " => "icon-html5 ", "icon-css3 " => "icon-css3 ", "icon-anchor " => "icon-anchor ", "icon-unlock-alt " => "icon-unlock-alt ", "icon-bullseye " => "icon-bullseye ", "icon-ellipsis-horizontal " => "icon-ellipsis-horizontal ", "icon-ellipsis-vertical " => "icon-ellipsis-vertical ", "icon-rss-sign " => "icon-rss-sign ", "icon-play-sign " => "icon-play-sign ", "icon-ticket " => "icon-ticket ", "icon-minus-sign-alt " => "icon-minus-sign-alt ", "icon-check-minus " => "icon-check-minus ", "icon-level-up " => "icon-level-up ", "icon-level-down " => "icon-level-down ", "icon-check-sign " => "icon-check-sign ", "icon-edit-sign " => "icon-edit-sign ", "icon-external-link-sign " => "icon-external-link-sign ", "icon-share-sign " => "icon-share-sign ", "icon-compass " => "icon-compass ", "icon-collapse " => "icon-collapse ", "icon-collapse-top " => "icon-collapse-top ", "icon-expand " => "icon-expand ", "icon-euro" => "icon-euro", "icon-eur " => "icon-eur ", "icon-gbp " => "icon-gbp ", "icon-dollar" => "icon-dollar", "icon-usd " => "icon-usd ", "icon-rupee" => "icon-rupee", "icon-inr " => "icon-inr ", "icon-yen" => "icon-yen", "icon-jpy " => "icon-jpy ", "icon-renminbi" => "icon-renminbi", "icon-cny " => "icon-cny ", "icon-won" => "icon-won", "icon-krw " => "icon-krw ", "icon-bitcoin" => "icon-bitcoin", "icon-btc " => "icon-btc ", "icon-file " => "icon-file ", "icon-file-text " => "icon-file-text ", "icon-sort-by-alphabet " => "icon-sort-by-alphabet ", "icon-sort-by-alphabet-alt " => "icon-sort-by-alphabet-alt ", "icon-sort-by-attributes " => "icon-sort-by-attributes ", "icon-sort-by-attributes-alt " => "icon-sort-by-attributes-alt ", "icon-sort-by-order " => "icon-sort-by-order ", "icon-sort-by-order-alt " => "icon-sort-by-order-alt ", "icon-thumbs-up " => "icon-thumbs-up ", "icon-thumbs-down " => "icon-thumbs-down ", "icon-youtube-sign " => "icon-youtube-sign ", "icon-youtube " => "icon-youtube ", "icon-xing " => "icon-xing ", "icon-xing-sign " => "icon-xing-sign ", "icon-youtube-play " => "icon-youtube-play ", "icon-dropbox " => "icon-dropbox ", "icon-stackexchange " => "icon-stackexchange ", "icon-instagram " => "icon-instagram ", "icon-flickr " => "icon-flickr ", "icon-adn " => "icon-adn ", "icon-bitbucket " => "icon-bitbucket ", "icon-bitbucket-sign " => "icon-bitbucket-sign ", "icon-tumblr " => "icon-tumblr ", "icon-tumblr-sign " => "icon-tumblr-sign ", "icon-long-arrow-down " => "icon-long-arrow-down ", "icon-long-arrow-up " => "icon-long-arrow-up ", "icon-long-arrow-left " => "icon-long-arrow-left ", "icon-long-arrow-right " => "icon-long-arrow-right ", "icon-apple " => "icon-apple ", "icon-windows " => "icon-windows ", "icon-android " => "icon-android ", "icon-linux " => "icon-linux ", "icon-dribbble " => "icon-dribbble ", "icon-skype " => "icon-skype ", "icon-foursquare " => "icon-foursquare ", "icon-trello " => "icon-trello ", "icon-female " => "icon-female ", "icon-male " => "icon-male ", "icon-gittip " => "icon-gittip ", "icon-sun " => "icon-sun ", "icon-moon " => "icon-moon ", "icon-archive " => "icon-archive ", "icon-bug " => "icon-bug ", "icon-vk " => "icon-vk ", "icon-weibo " => "icon-weibo ", "icon-renren " => "icon-renren ",);
					if(!empty($val['icon_o'])) {
						foreach ($icon_option as $ic=>$icon_v){$icons .= '<option value="'. $ic .'" ' . selected($val['icon_o'], $ic, false) . '>'. $icon_v .'</option>';}	
					} else {
						foreach ($icon_option as $ic=>$icon_v){$icons .= '<option value="'. $ic .'">'. $icon_v .'</option>';}
					}
						$icons .= '</select><br/>';
		
		
		$icons .= '<label>Or upload your own icon.</label>';
		$icons .= '<input class="upload slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';

		$icons .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'">Upload</span>';

		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$icons .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$icons .='</div>' . "\n";
		$icons .= '<div class="screenshot">';
		if(!empty($val['url'])){
			
	    	$icons .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
	    	$icons .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
	    	$icons .= '</a>';
			
			}
		$icons .= '</div>';	
		$icons .= '<label>Link URL</label>';
		$icons .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		
	
		$icons .= '<a class="slide_delete_button" href="#">Delete</a>';
	    $icons.= '<div class="clear"></div>' . "\n";
	
		$icons .= '</div>';
		$icons .= '</li>';
	
		return $icons;
		
	}

	
}//end Options Machine class

?>
