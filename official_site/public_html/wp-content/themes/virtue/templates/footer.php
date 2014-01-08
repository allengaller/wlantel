<footer id="containerfooter" class="footerclass" role="contentinfo">
  <div class="container">
  	<div class="row">
  		<?php global $virtue; if(isset($virtue['footer_layout'])) { $footer_layout = $virtue['footer_layout']; } else { $footer_layout = 'fourc'; }
  			if ($footer_layout == "fourc") {
  				if (is_active_sidebar('footer_1') ) { ?> 
					<div class="span3 footercol1">
					<?php dynamic_sidebar(__("Footer Column 1", "virtue")); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?> 
					<div class="span3 footercol2">
					<?php dynamic_sidebar(__("Footer Column 2", "virtue")); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?> 
					<div class="span3 footercol3">
					<?php dynamic_sidebar(__("Footer Column 3", "virtue")); ?>
					</div> 
	            <?php }; ?>
				<?php if (is_active_sidebar('footer_4') ) { ?> 
					<div class="span3 footercol4">
					<?php dynamic_sidebar(__("Footer Column 4", "virtue")); ?>
					</div> 
		        <?php }; ?>
		    <?php } else if($footer_layout == "threec") {
		    	if (is_active_sidebar('footer_third_1') ) { ?> 
					<div class="span4 footercol1">
					<?php dynamic_sidebar(__("Footer Column 1", "virtue")); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_third_2') ) { ?> 
					<div class="span4 footercol2">
					<?php dynamic_sidebar(__("Footer Column 2", "virtue")); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_third_3') ) { ?> 
					<div class="span4 footercol3">
					<?php dynamic_sidebar(__("Footer Column 3", "virtue")); ?>
					</div> 
	            <?php }; ?>
			<?php } else {
					if (is_active_sidebar('footer_double_1') ) { ?>
					<div class="span6 footercol1">
					<?php dynamic_sidebar(__("Footer Column 1", "virtue")); ?> 
					</div> 
		            <?php }; ?>
		        <?php if (is_active_sidebar('footer_double_2') ) { ?>
					<div class="span6 footercol2">
					<?php dynamic_sidebar(__("Footer Column 2", "virtue")); ?> 
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
        	<p><?php if(!isset($virtue['footer_text'])) { $footertext = $virtue['footer_text'];} else {$footertext = '[copyright] [the-year] [site-name]';} echo do_shortcode($footertext); //[theme-credit]?></p>
    	</div>

  </div>

</footer>

<?php wp_footer(); ?>
