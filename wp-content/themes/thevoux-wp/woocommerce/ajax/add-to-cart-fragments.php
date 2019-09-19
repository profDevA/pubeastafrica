<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Shop notices
?>
<div class="thb_ajax_product_addtocart_container">
	<div class="thb_prod_ajax_to_cart_notices">
		<?php
			if ( is_ajax() ) {
				wc_print_notices();
				wc_clear_notices();
			}
		?>
	</div>
<?php
// Cart contents count
?>
	<span class="float_count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
	<div class="widget_shopping_cart_content">
		<?php woocommerce_mini_cart(); ?>
	</div>
</div>