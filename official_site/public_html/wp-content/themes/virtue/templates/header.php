
<header class="banner headerclass" role="banner">
<?php if (kadence_display_topbar()) : ?>
  <section id="topbar" class="topclass">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="topbarmenu clearfix">
          <?php if (has_nav_menu('topbar_navigation')) :
              wp_nav_menu(array('theme_location' => 'topbar_navigation', 'menu_class' => 'sf-menu'));
            endif;?>
            <?php if(kadence_display_topbar_icons()) : ?>
            <div class="topbar_social">
              <ul>
                <?php global $smof_data; $top_icons = $smof_data['topbar_icon_menu'];
                foreach ($top_icons as $top_icon) {
                  echo '<li><a href="'.$top_icon['link'].' title="'.$top_icon['title'].'" rel="tooltip" data-placement="bottom" data-original-title="'.$top_icon['title'].'">';
                  if($top_icon['url'] != '') echo '<img src="'.$top_icon['url'].'"/>' ; else echo '<i class="'.$top_icon['icon_o'].'"></i>';
                  echo '</a></li>';
                } ?>
              </ul>
            </div>
          <?php endif; ?>
            <?php global $smof_data; if(isset($smof_data['show_cartcount'])) {
               if($smof_data['show_cartcount'] == '1') { 
                if (class_exists('woocommerce')) {
                  global $woocommerce; ?>
                    <ul>
                      <li>
                      <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woocommerce'); ?>">
                          <i class="icon-shopping-cart" style="padding-right:5px;"></i> <?php _e('Your Cart', 'woocommerce');?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
                      </a>
                    </li>
                  </ul>
                <?php } } }?>
          </div>
        </div><!-- close span6 -->
        <div class="span6">
          <div id="topbar-search" class="topbar-widget">
            <?php if(kadence_display_topbar_widget()) { if(is_active_sidebar('topbarright')) { dynamic_sidebar("Topbar Widget"); } 
              } else { if(kadence_display_top_search()) {get_search_form();} 
          } ?>
        </div>
        </div> <!-- close span6-->
      </div> <!-- Close Row -->
    </div> <!-- Close Container -->
  </section>
<?php endif; ?>
<?php global $smof_data; if(!empty($smof_data['logo_layout']) && ($smof_data['logo_layout'] == 'logocenter')) {$logocclass = 'span12'; $menulclass = 'span12';} else {$logocclass = 'span4'; $menulclass = 'span8';} ?>
  <div class="container">
    <div class="row">
          <div class="<?php echo $logocclass; ?>  clearfix">
            <div id="logo" class="logocase">
              <a class="brand logofont" href="<?php echo home_url(); ?>/">
                       <?php global $smof_data; if (!empty($smof_data['logo_upload'])) { ?> <div id="thelogo"><img src="<?php echo $smof_data['logo_upload']; ?>" <?php if(isset($smof_data['x2logo_upload'])) {echo 'data-at2x="'.$smof_data['x2logo_upload'].'"';} ?> /></div> <?php } else { bloginfo('name'); } ?>
              </a>
              <?php if (isset($smof_data['logo_below_text'])) { ?> <p class="belowlogo-text"><?php echo $smof_data['logo_below_text']; ?></p> <?php }?>
           </div> <!-- Close #logo -->
       </div><!-- close logo span -->

       <div class="<?php echo $menulclass; ?>">
         <nav id="nav-main" class="clearfix" role="navigation">
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'sf-menu')); 
            endif;
            if (has_nav_menu('mobile_navigation')) :
            wp_nav_menu( array('theme_location' => 'mobile_navigation', 'items_wrap' => '<select id="%1$s" class="%2$s">%3$s</select>', 'menu_class' => 'navselect', 'walker' => new Virtue_Dropdown_Nav() ));
            global $smof_data; if(!empty($smof_data['mobile_menu_text'])) {$menu_text = $smof_data['mobile_menu_text'];} else {$menu_text = __('menu', 'virtue');} ?>
             <div class="mobilenav-button"><i class="icon-reorder"></i><span class="headerfont"><?php echo $menu_text ?></span></div> <?php
           endif;
          ?>    
          </nav>
        </div> <!-- Close menu span -->
    </div> <!-- Close Row -->
  </div> <!-- Close Container -->
  <?php
            if (has_nav_menu('secondary_navigation')) : ?>
  <section id="cat_nav" class="navclass">
    <div class="container">
     <nav id="nav-second" class="clearfix" role="navigation">
     <?php wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'sf-menu')); ?>
   </nav>
    </div><!--close container-->
    </section>
    <?php endif; ?> 
     <?php global $smof_data; if (!empty($smof_data['banner_upload'])) { ?> <div class="container"><div class="virtue_banner"><img src="<?php echo $smof_data['banner_upload']; ?>" /></div></div> <?php } ?>
</header>