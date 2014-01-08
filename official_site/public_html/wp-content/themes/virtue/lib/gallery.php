<?php 
/**
 * Clean up gallery_shortcode()
 *
 * Re-create the [gallery] shortcode and use thumbnails styling from Bootstrap
 *
 * @link http://twitter.github.com/bootstrap/components.html#thumbnails
 */
function kadence_gallery($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if (!empty($attr['ids'])) {
    if (empty($attr['orderby'])) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  $output = apply_filters('post_gallery', '', $attr);

  if ($output != '') {
    return $output;
  }

  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) {
      unset($attr['orderby']);
    }
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => '',
    'icontag'    => '',
    'captiontag' => '',
    'columns'    => 3,
    'size'       => 'large',
    'include'    => '',
    'exclude'    => ''
  ), $attr));

  $id = intval($id);

  if ($order === 'RAND') {
    $orderby = 'none';
  }

  if (!empty($include)) {
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }

  if (empty($attachments)) {
    return '';
  }

  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment) {
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    }
    return $output;
  }
 if(kadence_display_sidebar()) {  
        if ($columns == 4) {
           $output .= '<ul class="s-fourcolumn gallery kad-light-gallery clearfix">';
           $imgsize = 172;
        } elseif ($columns == 2) {
          $output .= '<ul class="s-twocolumn gallery kad-light-gallery clearfix">';
          $imgsize = 365;
        } elseif ($columns == 5) {
          $output .= '<ul class="s-fivecolumn gallery kad-light-gallery clearfix">';
          $imgsize = 134;
        } elseif ($columns == 6) {
          $output .= '<ul class="s-sixcolumn gallery kad-light-gallery clearfix">';
          $imgsize = 120;
        } elseif ($columns == 7) {
          $output .= '<ul class="s-sevencolumn gallery kad-light-gallery clearfix">';
          $imgsize = 120;
        } else {
          $output .= '<ul class="s-threecolumn gallery kad-light-gallery clearfix">';
          $imgsize = 236;
        }
  } else {
        if ($columns == 4) {
           $output .= '<ul class="fourcolumn gallery kad-light-gallery clearfix">';
           $imgsize = 270;
        } elseif ($columns == 5) {
          $output .= '<ul class="fivecolumn gallery kad-light-gallery clearfix">';
          $imgsize = 214;
        } elseif ($columns == 6) {
          $output .= '<ul class="sixcolumn gallery kad-light-gallery clearfix">';
          $imgsize = 175;
        } elseif ($columns == 7) {
          $output .= '<ul class="sevencolumn gallery kad-light-gallery clearfix">';
          $imgsize = 147;
        }  elseif ($columns == 2) {
          $output .= '<ul class="twocolumn gallery kad-light-gallery clearfix">';
          $imgsize = 556;
        } else {
          $output .= '<ul class="threecolumn gallery kad-light-gallery clearfix">';
          $imgsize = 370;
        }
  }
  $i = 0;
  foreach ($attachments as $id => $attachment) {
    $attachment_url = wp_get_attachment_url($id);
    $image = aq_resize($attachment_url, $imgsize, $imgsize, true);
    $link = isset($attr['link']) && 'post' == $attr['link'] ? wp_get_attachment_link($id, $size, true, false) : wp_get_attachment_link($id, $size, false, false);

    $output .= '<li class="grid_item"><a href="'.$attachment_url.'" rel="lightbox[pp_gal]" class="lightboxhover" title="'.$attachment->post_excerpt.'">
                          <img src="'.$image.'" alt="'.$attachment->post_excerpt.'" class="light-dropshaddow"/>
                        </a>';
    if (trim($attachment->post_excerpt)) {
      $output .= '<div class="caption hidden">' . wptexturize($attachment->post_excerpt) . '</div>';
    }
    $output .= '</li>';
  }

  $output .= '</ul>';

  return $output;
}
  global $virtue;
if(isset($virtue['virtue_gallery']) && $virtue['virtue_gallery'] == '1')  {
  remove_shortcode('gallery');
  add_shortcode('gallery', 'kadence_gallery');
} 