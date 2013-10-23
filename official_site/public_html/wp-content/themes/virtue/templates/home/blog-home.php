<div class="home_blog home-margin clearfix home-padding">
	<?php global $smof_data; if(isset($smof_data['blog_title'])) { $btitle = $smof_data['blog_title'];} else { $btitle = __('Latest from the Blog', 'virtue'); } ?>
		<div class="clearfix"><h3 class="hometitle"><?php echo $btitle; ?></h3></div>
	<div class="row">
		<?php global $smof_data; if(isset($smof_data['home_post_count'])) { $blogcount = $smof_data['home_post_count'];} else { $blogcount = '2'; } 
				 if(isset($smof_data['home_post_type'])) { $blog_category = $smof_data['home_post_type'];}
				 if($blog_category == 'All' || $blog_category == '') {
      					$blog_cat_slug = '';
					} else {
					$blog_cat = get_term_by ('name',$blog_category,'category');
					$blog_cat_slug = $blog_cat -> slug;
					}
					?>
				<?php $temp = $wp_query; 
					  $wp_query = null; 
					  $wp_query = new WP_Query();
					  $wp_query->query(array(
						'posts_per_page' => $blogcount,
						'category_name'=> $blog_cat_slug,
						'post__not_in' => get_option( 'sticky_posts' )));
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<div class="span6 clearclass<?php echo ($xyz++%2); ?>">
				  	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                    <div class="row">
	                    			<?php 
	                    			if (has_post_thumbnail( $post->ID ) ) {
	                    				$textsize = 'span3';
										$image_url = wp_get_attachment_image_src( 
											get_post_thumbnail_id( $post->ID ), 'full' ); 
										$thumbnailURL = $image_url[0]; 
									$image = aq_resize($thumbnailURL, 270, 270, true);
										if(empty($image)) {$image = $thumbnailURL; } ?>
								 <div class="span3">
									 <div class="imghoverclass">
		                           		<a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
		                           			<img src="<?php echo $image ?>" alt="<?php the_title(); ?>" class="iconhover" style="display:block;">
		                           		</a> 
		                             </div>
		                         </div>

                           		<?php $image = null; $thumbnailURL = null; ?> 
                           		<?php } else { $textsize = 'span6'; } ?>
	                       		<div class="<?php echo $textsize;?> postcontent">
	                       			<div class="postmeta color_gray">
				                        	<div class="postdate bg-lightgray headerfont">
				                        		<span class="postday"><?php echo get_the_date('j'); ?></span>
				                        		<?php echo get_the_date('M Y');?>
				                        	</div>
				                            
				                        </div>
				                    <header class="home_blog_title">
			                          <a href="<?php the_permalink() ?>"><h4 class="entry-title"><?php the_title(); ?></h4></a>
			                          <div class="subhead color_gray">
			                          	<span class="postauthortop" rel="tooltip" data-placement="bottom" data-original-title="<?php echo get_the_author() ?>">
			                          		<i class="icon-user"></i>
			                          	</span>
			                          		<?php $post_category = get_the_category($post->ID); if ( $post_category==true ) { ?> | <span class="postedintop"><i class="icon-folder-open"></i> <?php _e('posted in:', 'virtue');?> <?php the_category(', ') ?></span> <?php }?>
			                        	|
			                        	<span class="postcommentscount" rel="tooltip" data-placement="bottom" data-original-title="<?php comments_number( '0', '1', '%' ); ?>">
			                        		<i class="icon-comments-alt"></i>
			                        	</span>
			                        </div>
			                        </header>
		                        	<div class="entry-content">
		                          		<p><?php echo virtue_excerpt(34); ?> <a href="<?php the_permalink() ?>"><?php _e('READ MORE', 'virtue');?></a></p>
		                        	</div>
		                      		<footer>
                       				</footer>
							</div>
	                   	</div>
                    </article>
                </div>

                    <?php endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'virtue');?></li>
					<?php endif; ?>
                
				
				<?php $wp_query = null; $wp_query = $temp;  // Reset ?>
				<?php wp_reset_query(); ?>

	</div>
</div> <!--home-blog -->