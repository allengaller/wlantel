
        		<div id="blog_carousel_container" class="carousel_outerrim">
           			<?php global $post; $text = get_post_meta( $post->ID, '_kad_blog_carousel_title', true ); if( $text != '') { echo '<h3 class="title">'.$text.'</h3>'; } else {echo '<h3 class="title">Recent Posts</h3>';} ?>
            <div class="blog-carouselcase fredcarousel">
            	<?php if (kadence_display_sidebar()) { 
            	$columns_class = 's-threecolumn'; } else { $columns_class = 'fourcolumn'; } ?>

            	<ul id="blog_carousel" class="blog_carousel <?php echo $columns_class; ?> clearfix">
                    <?php
				$temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array(
					'post__not_in' => array($post->ID),
					'posts_per_page'=>6));
					$count =0;
			?>
                    <?php if ( $wp_query ) : 
					 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                	<li class="blog_item grid_item <?php post_class(); ?> clearfix">
				
	                    		<?php if (has_post_thumbnail( $post->ID ) ) {
										$image_url = wp_get_attachment_image_src( 
											get_post_thumbnail_id( $post->ID ), 'full' ); 
										$thumbnailURL = $image_url[0]; 
										$image = aq_resize($thumbnailURL, 272, 272, true);
											if(empty($image)) {$image = $thumbnailURL;} 
									}else { $theme_url = get_template_directory_uri(); 
									$image = $theme_url.'/assets/img/post_standard.jpg';
								}?>
								
									 <div class="imghoverclass">
		                           		<a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
		                           			<img src="<?php echo $image ?>" alt="<?php the_title(); ?>" class="iconhover" style="display:block;">
		                           		</a> 
		                         	</div>
                           		<?php $image = null; $thumbnailURL = null; ?>
                           		
              <a href="<?php the_permalink() ?>" class="bcarousellink">
				                    <header>
			                          <h5 class="entry-title"><?php the_title(); ?></h5>
			                          <div class="subhead">
			                          	<span class="postday"><?php echo get_the_date(get_option( 'date_format' )); ?></span>
			                        </div>
			                          	
			                        </header>
		                        	<div class="entry-content">
		                          		<p><?php echo virtue_excerpt(16); ?></p>
		                        	</div>
		                      	
                           </a>
                </li>
					<?php endwhile; else: ?>
					 
					<li class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'virtue');?></li>
						
				<?php endif; ?>	
                <?php 
					  $wp_query = null; 
					  $wp_query = $temp;  // Reset
					?>
                    <?php wp_reset_query(); ?>
													
			</ul>
     <div class="clearfix"></div>
            <a id="prevport_blog" class="prev_carousel icon-chevron-left" href="#"></a>
			<a id="nextport_blog" class="next_carousel icon-chevron-right" href="#"></a>
            </div>
</div><!-- Porfolio Container-->					