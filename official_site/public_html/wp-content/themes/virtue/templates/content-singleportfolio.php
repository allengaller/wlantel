
	<div id="pageheader" class="titleclass">
		<div class="container">
			<div class="page-header">
				<div class="portfolionav clearfix">
   			<?php previous_post_link_plus( array('order_by' => 'menu_order', 'loop' => true, 'format' => '%link', 'link' => '<i class="icon-chevron-left"></i>') ); ?>
   			<?php global $virtue; if( !empty($virtue['portfolio_link'])){ ?>
					 <a href="<?php echo get_page_link($virtue["portfolio_link"]); ?>">
				<?php } else {?> 
				<a href="../">
				<?php } ?>
   				<i class="icon-th"></i></a> 
   				<?php next_post_link_plus( array('order_by' => 'menu_order', 'loop' => true, 'format' => '%link', 'link' => '<i class="icon-chevron-right"></i>') ); ?>
   				<span>&nbsp;</span>
   			</div>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
		</div><!--container-->
	</div><!--titleclass-->
<div id="content" class="container">
    <div class="row">
      <div class="main <?php echo kadence_main_class(); ?> portfolio-single" role="main">
      <?php while (have_posts()) : the_post(); ?>
      <?php global $post; $layout = get_post_meta( $post->ID, '_kad_ppost_layout', true ); 
						$ppost_type = get_post_meta( $post->ID, '_kad_ppost_type', true );
						 $imgheight = get_post_meta( $post->ID, '_kad_posthead_height', true );
						 $imgwidth = get_post_meta( $post->ID, '_kad_posthead_width', true );
		if($layout == 'above')  {
				$imgclass = 'span12';
				$textclass = 'pcfull clearfix';
				$entryclass = 'span8';
				$valueclass = 'span4';
				$slidewidth_d = 1170;
		} elseif ($layout == 'three')  {
				$imgclass = 'span12';
				$textclass = 'pcfull clearfix';
				$entryclass = 'span12';
				$valueclass = 'span12';
				$slidewidth_d = 1170;
			} else {
				$imgclass = 'span7';
				$textclass = 'span5 pcside';
				$entryclass = '';
				$valueclass = '';
				$slidewidth_d = 670;
			 	}
			 	$portfolio_margin = '';
		if (!empty($imgheight)) { $slideheight = $imgheight; } else { $slideheight = 450; } 
		if (!empty($imgwidth)) { $slidewidth = $imgwidth; } else { $slidewidth = $slidewidth_d; } 
		 ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
      <div class="postclass">
      	<div class="row">
      		<div class="<?php echo $imgclass; ?>">
				<?php if ($ppost_type == 'flex') { ?>
					<div class="flexslider loading kad-light-gallery" style="max-width:<?php echo $slidewidth;?>px;">
                       <ul class="slides">
						<?php global $post;
                          	$image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                          		if(!empty($image_gallery)) {
                    				$attachments = array_filter( explode( ',', $image_gallery ) );
                    					if ($attachments) {
											foreach ($attachments as $attachment) {
												$attachment_url = wp_get_attachment_url($attachment , 'full');
												$caption = get_post($attachment)->post_excerpt;
												$image = aq_resize($attachment_url, $slidewidth, $slideheight, true);
													if(empty($image)) {$image = $attachment_url;}
												echo '<li><a href="'.$attachment_url.'" rel="lightbox" title="'.$caption.'"><img src="'.$image.'" alt="'.$caption.'"/></a></li>';
											}
										}
                    			} else {
                    				$attach_args = array('order'=> 'ASC','post_type'=> 'attachment','post_parent'=> $post->ID,'post_mime_type' => 'image','post_status'=> null,'orderby'=> 'menu_order','numberposts'=> -1);
									$attachments = get_posts($attach_args);
										if ($attachments) {
											foreach ($attachments as $attachment) {
												$attachment_url = wp_get_attachment_url($attachment->ID , 'full');
												$image = aq_resize($attachment_url, $slidewidth, $slideheight, true);
													if(empty($image)) {$image = $attachment_url;}
												echo '<li><a href="'.$attachment_url.'" rel="lightbox"><img src="'.$image.'"/></a></li>';
											}
                    					}	
								} ?>                                
					</ul>
					<script type="text/javascript">
			            jQuery(window).load(function () {
			                jQuery('.flexslider').flexslider({
			                    animation: "fade",
			                    animationSpeed: 500,
			                    slideshow: true,
			                    slideshowSpeed: 7000,

			                    before: function(slider) {
			                      slider.removeClass('loading');
			                    }  
			                  });
			                });
			      </script>
              </div> <!--Flex Slides-->
				<?php }
				else if ($ppost_type == 'video') { ?>
					<div class="videofit">
                  <?php global $post; $video = get_post_meta( $post->ID, '_kad_post_video', true ); echo $video; ?>
                  </div>
				<?php } else if ($ppost_type == 'none') {
					 $portfolio_margin = "kad_portfolio_nomargin";
				} else {					
							$post_id = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $post_id);
							$image = aq_resize( $img_url, $slidewidth, $slideheight, true ); //resize & crop the image
							if(empty($image)) {$image = $img_url; }
							?>
                                <?php if($image) : ?>
                                    <div class="imghoverclass">
                                    	<a href="<?php echo $img_url ?>" rel="lightbox" class="lightboxhover">
                                    		<img src="<?php echo $image ?>" alt="<?php echo get_post($post_id)->post_excerpt; ?>" />
                                    	</a>
                                    </div>
                                <?php endif; ?>
				<?php } ?>
        </div><!--imgclass -->
  		<div class="<?php echo $textclass; ?>">
		    <div class="entry-content <?php echo $entryclass; ?> <?php echo $portfolio_margin; ?>">
		      <?php the_content(); ?>
		  </div>
	    		<div class="<?php echo $valueclass; ?>">
	    			<div class="pcbelow">
				    <ul class="portfolio-content disc">
				    	<?php global $post; $project_v1t = get_post_meta( $post->ID, '_kad_project_val01_title', true );
				    						$project_v1d = get_post_meta( $post->ID, '_kad_project_val01_description', true );
				    						$project_v2t = get_post_meta( $post->ID, '_kad_project_val02_title', true );
				    						$project_v2d = get_post_meta( $post->ID, '_kad_project_val02_description', true );
				    						$project_v3t = get_post_meta( $post->ID, '_kad_project_val03_title', true );
				    						$project_v3d = get_post_meta( $post->ID, '_kad_project_val03_description', true );
				    						$project_v4t = get_post_meta( $post->ID, '_kad_project_val04_title', true );
				    						$project_v4d = get_post_meta( $post->ID, '_kad_project_val04_description', true );
				    						$project_v5t = get_post_meta( $post->ID, '_kad_project_val05_title', true );
				    						$project_v5d = get_post_meta( $post->ID, '_kad_project_val05_description', true ); ?>
				    <?php if ($project_v1t != '') echo '<li class="pdetails"><span>'.$project_v1t.'</span> '.$project_v1d.'</li>'; ?>
				    <?php if ($project_v2t != '') echo '<li class="pdetails"><span>'.$project_v2t.'</span> '.$project_v2d.'</li>'; ?>
				    <?php if ($project_v3t != '') echo '<li class="pdetails"><span>'.$project_v3t.'</span> '.$project_v3d.'</li>'; ?>
				    <?php if ($project_v4t != '') echo '<li class="pdetails"><span>'.$project_v4t.'</span> '.$project_v4d.'</li>'; ?>
				    <?php if ($project_v5t != '') echo '<li class="pdetails"><span>'.$project_v5t.'</span> <a href="'.$project_v5d.'" target="_new">'.$project_v5d.'</a></li>'; ?>
				    </ul><!--Portfolio-content-->
				</div>
				</div>
    	</div><!--textclass -->
    </div><!--row-->
    <div class="clearfix"></div>
    </div><!--postclass-->
    <footer>
      <?php wp_link_pages(array('before' => '<nav id="page-nav" class="wp-pagenavi"><p>' . __('Pages:', 'virtue'), 'after' => '</p></nav>')); ?>
      <?php global $post; $portfolio_carousel_recent = get_post_meta( $post->ID, '_kad_portfolio_carousel_recent', true ); if ($portfolio_carousel_recent == 'similar') { get_template_part('templates/similarportfolio', 'carousel'); } else if ($portfolio_carousel_recent == 'recent') { get_template_part('templates/recentportfolio', 'carousel');} ?>
    </footer>
    <?php global $virute; if(isset($virtue['portfolio_comments']) && $virtue['portfolio_comments'] == 1) { 
    comments_template('/templates/comments.php'); 
	} ?>
  </article>
<?php endwhile; ?>
</div>