<?php global $virtue; $icons = $virtue['icon_menu']; 
                $iconcount = count($icons);
                if(kadence_display_sidebar()) {
                    if ($iconcount == "2") {
                            $columnsize = 'span6'; $img_width = '375'; $row_type = "row-fluid";
                    } else {
                            $columnsize = 'span4'; $img_width = '244'; $row_type = "row-fluid";
                        }
                } else {
                        if ($iconcount == "2") {
                            $columnsize = 'span6'; $img_width = '570'; $row_type = "row";
                    } elseif ($iconcount == "3") {
                            $columnsize = 'span4'; $img_width = '370'; $row_type = "row";
                    } elseif ($iconcount == "6") {
                            $columnsize = 'span4'; $img_width = '370'; $row_type = "row";
                    } else {
                            $columnsize = 'span3'; $img_width = '270'; $row_type = "row";
                        }
                    }                     
                    ?>
                <div class="home-margin home-padding">
                    <div class="<?php echo $row_type; ?> homepromo">
                    <?php $counter = 1;?>
                        <?php foreach ($icons as $icon) : ?>
                            <div class="<?php echo $columnsize;?> home-iconmenu <?php echo 'homeitemcount'.$counter;?>">
                                <a href="<?php echo $icon['link'] ?>" title="<?php echo $icon['title'] ?>">
                                <?php if($icon['url'] != '') echo '<img src="'.$icon['url'].'"/>' ; else echo '<i class="'.$icon['icon_o'].'"></i>'; ?>
                                <?php if ($icon['title'] != '') echo '<h4>'.$icon['title'].'</h4>'; ?>
                                <?php if ($icon['description'] != '') echo '<p>'.$icon['description'].'</p>'; ?>
                                </a>
                            </div>
                             <?php $counter ++ ?>
                        <?php endforeach; ?>

                    </div> <!--homepromo -->
                </div>