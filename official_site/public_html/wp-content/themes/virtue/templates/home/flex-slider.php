<div class="sliderclass">
  <?php  global $smof_data; 
         if(isset($smof_data['slider_size'])) {$slideheight = $smof_data['slider_size'];} else { $slideheight = 400; }
        if(isset($smof_data['slider_size_width'])) {$slidewidth = $smof_data['slider_size_width'];} else { $slidewidth = 1170; }
        if(isset($smof_data['slider_captions'])) { $captions = $smof_data['slider_captions']; } else {$captions = '';}
        if(isset($smof_data['home_slider'])) {$slides = $smof_data['home_slider']; } else {$slides = '';}
                ?>
  <div id="imageslider" class="container">
    <div class="flexslider loading" style="max-width:<?php echo $slidewidth;?>px; margin-left: auto; margin-right:auto;">
        <ul class="slides">
            <?php foreach ($slides as $slide) : 
                    $image = aq_resize($slide['url'], $slidewidth, $slideheight, true);
                    if(empty($image)) {$image = $slide['url'];} ?>
                      <li> 
                        <?php if($slide['link'] != '') echo '<a href="'.$slide['link'].'">'; ?>
                          <img src="<?php echo $image; ?>" alt="<?php echo $slide['description']?>" title="<?php echo $slide['title'] ?>" />
                              <?php if ($captions == '1') { ?> 
                                <div class="flex-caption">
              								  <?php if ($slide['title'] != '') echo '<div class="captiontitle headerfont">'.$slide['title'].'</div>'; ?>
              								  <?php if ($slide['description'] != '') echo '<div><div class="captiontext headerfont"><p>'.$slide['description'].'</p></div></div>';?>
                                </div> 
                              <?php } ?>
                        <?php if($slide['link'] != '') echo '</a>'; ?>
                      </li>
                  <?php endforeach; ?>
        </ul>
      </div> <!--Flex Slides-->
  </div><!--Container-->
</div><!--sliderclass-->

      <?php 
          if(isset($smof_data['trans_type'])) {$transtype = $smof_data['trans_type'];} else { $transtype = 'slide';}
          if(isset($smof_data['slider_transtime'])) {$transtime = $smof_data['slider_transtime'];} else {$transtime = '300';}
          if(isset($smof_data['slider_autoplay'])) {$autoplay = $smof_data['slider_autoplay'];} else {$autoplay = 'true';}
          if(isset($smof_data['slider_pausetime'])) {$pausetime = $smof_data['slider_pausetime'];} else {$pausetime = '7000';}
      ?>
      <script type="text/javascript">
            jQuery(window).load(function () {
                jQuery('.flexslider').flexslider({
                    animation: "<?php echo $transtype ?>",
                    animationSpeed: <?php echo $transtime ?>,
                    slideshow: <?php echo $autoplay ?>,
                    slideshowSpeed: <?php echo $pausetime ?>,
                    smoothHeight: true,

                    before: function(slider) {
                      slider.removeClass('loading');
                    }  
                  });
                });
      </script>