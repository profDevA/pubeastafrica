<?php
global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$attachment_ids = $product->get_gallery_image_ids();

$classes[] = 'columns';
$classes[] = 'product-style2';

?>

<li <?php wc_product_class($classes,$product); ?>>
	<figure class="product-image">
		<?php do_action( 'thb_product_badge'); ?>
		<?php

			woocommerce_template_loop_product_link_open();
			do_action( 'woocommerce_before_shop_loop_item_title' );
			if ($attachment_ids) {
				echo wp_get_attachment_image( $attachment_ids[0], 'woocommerce_thumbnail' );
			}
			woocommerce_template_loop_product_link_close();
		?>
	</figure>
	<header class="product-title">
		<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</header>
</li><!-- end product -->
