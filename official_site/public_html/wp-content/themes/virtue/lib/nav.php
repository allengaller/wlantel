<?php
/**
 * Cleaner walker for wp_nav_menu()
 *
 */
class kadence_Nav_Walker extends Walker_Nav_Menu {
  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"sf-dropdown-menu\">\n";
  }
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $wp_query;
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $slug = sanitize_title($item->title);
    $id = 'menu-' . $slug;

    $class_names = $value = '';
    $li_attributes = '';
    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes = array_filter($classes, array(&$this, 'check_current'));


    if ($custom_classes = get_post_meta($item->ID, '_menu_item_classes', true)) {
      foreach ($custom_classes as $custom_class) {
        //$classes[] = $custom_class;
      }
    }

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = $class_names ? ' class="' . $id . ' ' . esc_attr($class_names) . '"' : ' class="' . $id . '"';

    $output .= $indent . '<li '. $class_names . '>';

    $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
    $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
    $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
    $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
  
  $description  = ! empty( $item->description ) ? '<span class="sf-description">'.esc_attr( $item->description ).'</span>' : '';
  $icon  = ! empty( $custom_class) ? '<i class="'. $custom_class . '"></i>' : '';
  
  if($depth != 0)
           {
                     $description = "";
           }

    $item_output  = $args->before;
    $item_output .= '<a'. $attributes . '>'.$icon;
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $description . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

    if ($element->is_dropdown) {
      if ($depth === 0) {
        $element->classes[] = 'sf-dropdown';
      } elseif ($depth === 1) {
        $element->classes[] = 'sf-dropdown-submenu';
      }
    }


    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */
function kadence_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  $classes[] = 'menu-' . $slug;

  $classes = array_unique($classes);

  return array_filter($classes, 'is_element_empty');
}
add_filter('nav_menu_css_class', 'kadence_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use kadence_Nav_Walker() by default
 */
function kadence_nav_menu_args($args = '') {
  $kadence_nav_menu_args['container'] = false;

  if (!$args['items_wrap']) {
    $kadence_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }

    $kadence_nav_menu_args['depth'] = 10;

  if (!$args['walker']) {
    $kadence_nav_menu_args['walker'] = new kadence_Nav_Walker();
  }

  return array_merge($args, $kadence_nav_menu_args);
}
add_filter('wp_nav_menu_args', 'kadence_nav_menu_args');




// Mobile Menu Output

class Virtue_Dropdown_Nav extends Walker_Nav_Menu {

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $indent_sub  = "";
    if($depth != 0)
           {
               $indent_sub = "&ndash;&nbsp;";
           }
      if($depth == 2)
           {
               $indent_sub = "&ndash;&ndash;&nbsp;";
           }

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $selected = in_array('current-menu-item',$classes) ? 'selected="selected"' : '';
    $output .= '<option '.$selected.' value="'.$item->url.'">';
    $output .= $indent_sub;
    $output .= $item->title;
  }
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</option>";
  }
}