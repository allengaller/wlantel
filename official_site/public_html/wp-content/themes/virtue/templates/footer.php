<footer id="containerfooter" class="content-info footerclass" role="contentinfo">
  <div class="container">
  	<div class="row">
  		<?php global $smof_data; if(isset($smof_data['footer_layout'])) { $footer_layout = $smof_data['footer_layout']; } else { $footer_layout = 'fourc'; }
  			if ($footer_layout == "twoc") {
					if (is_active_sidebar('footer_double_1') ) { ?>
					<div class="span6">
					<?php dynamic_sidebar("Footer Column 1"); ?> 
					</div> 
		            <?php }; ?>
		        <?php if (is_active_sidebar('footer_double_2') ) { ?>
					<div class="span6">
					<?php dynamic_sidebar("Footer Column 2"); ?> 
					</div> 
		            <?php }; ?>
		        <?php } else if($footer_layout == "threec") {
		    	if (is_active_sidebar('footer_third_1') ) { ?> 
					<div class="span4">
					<?php dynamic_sidebar("Footer Column 1"); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_third_2') ) { ?> 
					<div class="span4">
					<?php dynamic_sidebar("Footer Column 2"); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_third_3') ) { ?> 
					<div class="span4">
					<?php dynamic_sidebar("Footer Column 3"); ?>
					</div> 
	            <?php }; ?>
			<?php }  else {
  				if (is_active_sidebar('footer_1') ) { ?> 
					<div class="span3">
					<?php dynamic_sidebar("Footer Column 1"); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?> 
					<div class="span3">
					<?php dynamic_sidebar("Footer Column 2"); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?> 
					<div class="span3">
					<?php dynamic_sidebar("Footer Column 3"); ?>
					</div> 
	            <?php }; ?>
				<?php if (is_active_sidebar('footer_4') ) { ?> 
					<div class="span3">
					<?php dynamic_sidebar("Footer Column 4"); ?>
					</div> 
		        <?php }; ?>
		    <?php } ?>
        </div>
        <div class="footercredits clearfix">
    		
    		<?php if (has_nav_menu('footer_navigation')) :
        	?><div class="footernav clearfix"><?php 
              wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footermenu'));
            ?></div><?php
        	endif;?>
        	<p><?php if(isset($smof_data['footer_text'])) { $footertext = $smof_data['footer_text'];} else {$footertext = '[copyright] [the-year] [site-name] [theme-credit]';} echo do_shortcode($footertext); ?></p>
    	</div>

  </div>

</footer>

<?php wp_footer(); ?>
