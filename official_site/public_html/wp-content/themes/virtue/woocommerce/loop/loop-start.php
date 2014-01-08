<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php if(kadence_display_sidebar()) {
	$columns = "s-threecolumn";
	} else {
	$columns = "fourcolumn";} ?>
<div id="product_wrapper" class="products <?php echo $columns; ?> clearfix">