              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                  <div class="row">
                      <?php global $post; $postsummery = get_post_meta( $post->ID, '_kad_post_summery', true );
                          $height = get_post_meta( $post->ID, '_kad_posthead_height', true ); if (!empty($height)) $slideheight = $height; else $slideheight = 400; 
                          $swidth = get_post_meta( $post->ID, '_kad_posthead_width', true ); if (!empty($swidth)) $slidewidth = $swidth; else $slidewidth = 1170;
                          if(empty($postsummery) || $postsummery == 'default') {
                            global $virtue;
                            if(!empty($virtue['post_summery_default'])) {
                            $postsummery = $virtue['post_summery_default'];
                            } else {
                              $postsummery = 'img_portrait';
                            }
                          }
                          if($postsummery == 'img_landscape') { 
                            $textsize = 'span12'; 
                            if (has_post_thumbnail( $post->ID ) ) {
                              $image_url = wp_get_attachment_image_src( 
                              get_post_thumbnail_id( $post->ID ), 'full' ); 
                              $thumbnailURL = $image_url[0]; 
                              $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);
                              if(empty($image)) { $image = $thumbnailURL; } ?>
                          <div class="span12">
                              <div class="imghoverclass img-margin-center">
                                <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                                  <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" class="iconhover" style="display:block;">
                                </a> 
                              </div>
                          </div>
                          <?php $image = null; $thumbnailURL = null; }?>

                      <?php } elseif($postsummery == 'img_portrait') { 
                            $textsize = 'span8'; 
                            if (has_post_thumbnail( $post->ID ) ) {
                              $image_url = wp_get_attachment_image_src( 
                              get_post_thumbnail_id( $post->ID ), 'full' ); 
                              $thumbnailURL = $image_url[0];
                              $image = aq_resize($thumbnailURL, 370, 370, true); 
                              if(empty($image)) { $image = $thumbnailURL; } ?>
                                <div class="span4">
                                  <div class="imghoverclass img-margin-center">
                                    <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                                      <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" class="iconhover" style="display:block;">
                                    </a> 
                                  </div>
                                </div>
                              <?php $image = null; $thumbnailURL = null; } ?>

                      <?php } elseif($postsummery == 'slider_landscape') {
                            $textsize = 'span12'; ?>
                                <div class="span12">
                                  <div class="flexslider loading" style="max-width:<?php echo $slidewidth;?>px;">
                                    <ul class="slides">
                                     <?php global $post;
                                        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                            if(!empty($image_gallery)) {
                                              $attachments = array_filter( explode( ',', $image_gallery ) );
                                                if ($attachments) {
                                                foreach ($attachments as $attachment) {
                                                  $attachment_url = wp_get_attachment_url($attachment , 'full');
                                                  $image = aq_resize($attachment_url, $slidewidth, $slideheight, true);
                                                    if(empty($image)) {$image = $attachment_url;} ?>
                                                    <li>
                                                      <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>">
                                                        <img src="<?php echo $image ?>" class="" />
                                                      </a>
                                                    </li>
                                                <?php 
                                                }
                                              }
                                            } else {
                                              $attach_args = array('order'=> 'ASC','post_type'=> 'attachment','post_parent'=> $post->ID,'post_mime_type' => 'image','post_status'=> null,'orderby'=> 'menu_order','numberposts'=> -1);
                                              $attachments = get_posts($attach_args);
                                                if ($attachments) {
                                                  foreach ($attachments as $attachment) {
                                                    $attachment_url = wp_get_attachment_url($attachment->ID , 'full');
                                                    $image = aq_resize($attachment_url, $slidewidth, $slideheight, true);
                                                      if(empty($image)) {$image = $attachment_url;} ?>
                                                    <li>
                                                      <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>">
                                                        <img src="<?php echo $image ?>" class="" />
                                                      </a>
                                                    </li>
                                                <?php 
                                                  }
                                                } 
                                            } ?>                                                      
                                    </ul>
                                  </div> <!--Flex Slides-->
                                  <script type="text/javascript">
                                    jQuery(window).load(function () {
                                        jQuery('.flexslider').flexslider({
                                            animation: "fade",
                                            animationSpeed: 400,
                                            slideshow: true,
                                            slideshowSpeed: 7000,
                                            before: function(slider) {
                                              slider.removeClass('loading');
                                            }  
                                          });
                                        });
                                  </script>
                                </div>

                      <?php } elseif($postsummery == 'slider_portrait') { 
                            $textsize = 'span8'; ?>
                              <div class="span4">
                                <div class="flexslider loading">
                                  <ul class="slides">
                                   <?php global $post;
                                        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                            if(!empty($image_gallery)) {
                                              $attachments = array_filter( explode( ',', $image_gallery ) );
                                                if ($attachments) {
                                                foreach ($attachments as $attachment) {
                                                  $attachment_url = wp_get_attachment_url($attachment , 'full');
                                                  $image = aq_resize($attachment_url, 370, 370, true);
                                                    if(empty($image)) {$image = $attachment_url;} ?>
                                                    <li>
                                                      <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>">
                                                        <img src="<?php echo $image ?>" class="" />
                                                      </a>
                                                    </li>
                                                <?php 
                                                }
                                              }
                                            } else {
                                              $attach_args = array('order'=> 'ASC','post_type'=> 'attachment','post_parent'=> $post->ID,'post_mime_type' => 'image','post_status'=> null,'orderby'=> 'menu_order','numberposts'=> -1);
                                              $attachments = get_posts($attach_args);
                                                if ($attachments) {
                                                  foreach ($attachments as $attachment) {
                                                    $attachment_url = wp_get_attachment_url($attachment->ID , 'full');
                                                    $image = aq_resize($attachment_url, 370, 370, true);
                                                      if(empty($image)) {$image = $attachment_url;} ?>
                                                    <li>
                                                      <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>">
                                                        <img src="<?php echo $image ?>" class="" />
                                                      </a>
                                                    </li>
                                                <?php 
                                                  }
                                                } 
                                            } ?>                               
                                  </ul>
                              </div> <!--Flex Slides-->
                              <script type="text/javascript">
                                jQuery(window).load(function () {
                                    jQuery('.flexslider').flexslider({
                                        animation: "fade",
                                        animationSpeed: 400,
                                        slideshow: true,
                                        slideshowSpeed: 7000,
                                        before: function(slider) {
                                          slider.removeClass('loading');
                                        }  
                                      });
                                    });
                              </script>
                            </div>

                  <?php } elseif($postsummery == 'video') { 
                        $textsize = 'span12'; ?>
                        <div class="span12">
                            <div class="videofit">
                              <?php global $post; $video = get_post_meta( $post->ID, '_kad_post_video', true ); echo $video; ?>
                            </div>
                        </div>

                  <?php } else { 
                        $textsize = 'span12'; 
                        } ?>

                      <div class="<?php echo $textsize;?> postcontent">
                          <div class="postmeta">
                              <div class="postdate bg-lightgray headerfont">
                                  <span class="postday"><?php echo get_the_date('j'); ?></span>
                                  <?php echo get_the_date('M Y');?>
                              </div>       
                          </div>
                          <header>
                              <a href="<?php the_permalink() ?>"><h2 class="entry-title"><?php the_title(); ?></h2></a>
                                <div class="subhead">
                                  <span class="postauthortop">
                                    <i class="icon-user"></i> <?php echo __('by', 'virtue');?>  <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author"><?php echo get_the_author() ?></a> |
                                  </span>
                                  <?php $post_category = get_the_category($post->ID); if ( $post_category==true ) { ?>  <span class="postedintop"><i class="icon-folder-open"></i> <?php _e('posted in:', 'virtue');?> <?php the_category(', ') ?></span> <?php }?>
                                  | 
                                  <span class="postcommentscount">
                                      <i class="icon-comments-alt"></i> <?php comments_number( '0', '1', '%' ); ?>
                                  </span>
                                </div>   
                          </header>
                          <div class="entry-content">
                              <?php the_excerpt(); ?>
                          </div>
                          <footer>
                              <?php $tags = get_the_tags(); if ($tags) { ?> <span class="posttags"><i class="icon-tag"></i> <?php the_tags('', ', ', ''); ?> </span><?php } ?>
                          </footer>
                        </div><!-- Text size -->
                  </div><!-- row-->
              </article> <!-- Article -->