<?php
global $product;


$classes[] = 'product-hotspots';
?>

<div <?php wc_product_class($classes,$product); ?>>
	<figure class="product-image">
		<?php do_action( 'thb_product_badge'); ?>
		<?php
			woocommerce_template_loop_product_link_open();
			the_post_thumbnail();
			woocommerce_template_loop_product_link_close();
		?>
	</figure>
	<div class="product-title">
		<h6><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
		<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hotspots-buynow"><?php esc_html_e('BUY NOW', 'thevoux' ); ?></a>
	</div>
</div><!-- end product -->
