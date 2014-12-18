<?php
/**
 * @package Rectangulum
 */
?>
	</div><!-- #main -->

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
		
	<div class="grid3 clearfix">
		<div class="col"><?php dynamic_sidebar('footer1'); ?></div>
		<div class="col"><?php dynamic_sidebar('footer2'); ?></div>
		<div class="col"><?php dynamic_sidebar('footer3'); ?></div>
	</div><!-- .grid3 -->

		<div class="site-info">				
<?php echo '&copy; '.date('Y').' - '; ?><span id="copyright-message"><?php echo get_theme_mod( 'rectangulum_footer_copyright_text', 'All Rights Reserved' ); ?></span>
<?php do_action( 'rectangulum_credits' ); ?>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>