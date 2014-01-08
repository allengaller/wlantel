<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'kad-first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'kad-last';

$classes[] = 'grid_item';
$classes[] = 'product_item';
$classes[] = 'clearfix';
if(isset($virtue_premium['product_img_resize']) && $virtue_premium['product_img_resize'] == 0) {
	$resizeimage = 0;
} else {
	$resizeimage = 1;
	$productimgwidth = 270;
	$productimgheight = 270;
}
?>
                    <?php
						$terms = get_the_terms( $post->ID, 'product_cat' );
								
						if ( $terms && ! is_wp_error( $terms ) ) : 
							$links = array();

							foreach ( $terms as $term ) 
							{
								$links[] = $term->name;
							}
							$links = str_replace(' ', '-', $links);	
							$tax = join( " ", $links );		
						else :	
							$tax = '';	
						endif;
						$classes[] = strtolower($tax);
						?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>" class="product_item_link">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			//do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
			<?php echo woocommerce_show_product_loop_sale_flash($post, $product); ?>

			<?php // echo woocommerce_template_loop_product_thumbnail($post, $product, $size); ?>
			<?php if($resizeimage == 1) { 
				if ( has_post_thumbnail() ) {
					$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
					$product_image_url = $product_image[0]; 
					$image_product = aq_resize($product_image_url, $productimgwidth, $productimgheight, true);
	            	if(empty($image_product)) {$image_product = $product_image_url;} ?> 
	            	 <img width="<?php echo $productimgwidth;?>" height="<?php echo $productimgheight;?>" src="<?php echo $image_product;?>" class="attachment-shop_catalog wp-post-image" alt="<?php the_title();?>">
	            	 <?php
        		} elseif ( woocommerce_placeholder_img_src() ) {
		             echo woocommerce_placeholder_img( 'shop_catalog' );
		             }  
			} else { 
				echo woocommerce_template_loop_product_thumbnail();
         }?>
             </a>
		<div class="product_details">
			<a href="<?php the_permalink(); ?>" class="product_item_link">
			<h5><?php the_title(); ?></h5>
			</a>

			<div class="product_excerpt"><?php the_excerpt(); ?></div>
		</div>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>