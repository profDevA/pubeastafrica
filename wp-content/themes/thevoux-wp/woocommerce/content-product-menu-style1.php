<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}


// Increase loop count
$attachment_ids = $product->get_gallery_image_ids();
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
?>

<div <?php post_class("post product"); ?>>
	<figure class="product-image">
		<?php 
			do_action( 'thb_product_badge');
			woocommerce_template_loop_product_link_open();
			do_action( 'woocommerce_before_shop_loop_item_title' );	
			woocommerce_template_loop_product_link_close();
		?>
	</figure>
	<div class="post-title">
		<h6><?php the_title(); ?></h6>
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
	</div>
	
</div><!-- end product -->