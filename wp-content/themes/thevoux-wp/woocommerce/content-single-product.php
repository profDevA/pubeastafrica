<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

/**
 * Hook Woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );


$product_style = isset($_GET['product_style']) ? $_GET['product_style'] : ot_get_option( 'product_style', 'style1');
$product_image_size = isset($_GET['product_image_size']) ? $_GET['product_image_size'] : ot_get_option( 'product_image_size', '6');
$product_image_position = isset($_GET['product_image_position']) ? $_GET['product_image_position'] : ot_get_option( 'product_image_position', 'left');
$product_image_position_class = $product_image_position === 'right' ? 'large-order-3' : false;
?>
<?php if ( post_password_required() ) { ?>
	<div class="row align-center page-padding">
		<div class="small-12 medium-8 large-6 columns">
			<?php echo get_the_password_form(); // WPCS: XSS ok. ?>
		</div>
	</div>
<?php } else { ?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('post-detail product-page', $product); ?>>
		<div class="row">
				<div class="small-12 small-order-1 large-<?php echo esc_attr($product_image_size); ?> <?php echo esc_attr($product_image_position_class); ?> columns product-gallery">

			    <?php
			        /**
			         * woocommerce_show_product_images hook
			         *
			         * @hooked woocommerce_show_product_sale_flash - 10
			         * @hooked woocommerce_show_product_images - 20
			         *
			         */
			        do_action( 'woocommerce_before_single_product_summary' );
			    ?>
			    <?php
		          /**
		           * woocommerce_after_single_product_summary hook
		           *
		           * @hooked woocommerce_output_related_products - 20
		           */
		          do_action( 'woocommerce_after_single_product_summary' );
		      ?>
			 	</div>
			  <div class="small-12 small-order-2 large-<?php echo esc_attr(12 - intval($product_image_size)); ?> columns product-information">
			  	<div class="<?php if ($product_style === 'style2') { echo 'fixed-me'; } ?>">
						<?php
				  		/**
				  		 * woocommerce_before_single_product hook
				  		 *
				  		 * @hooked woocommerce_show_messages - 10
				  		 */
				  		 do_action( 'woocommerce_before_single_product' );
				  	?>
				  	<?php echo thb_product_nav(); ?>
		  			<?php do_action('thb_woocommerce_product_breadcrumb'); ?>
				    <?php
			        /**
			        	 * woocommerce_single_product_summary hook
			        	 *
			        	 * @hooked woocommerce_template_single_title - 5
			        	 * @hooked woocommerce_template_single_rating - 10
			        	 * @hooked woocommerce_template_single_price - 10
			        	 * @hooked woocommerce_template_single_excerpt - 20
			        	 * @hooked woocommerce_template_single_add_to_cart - 30
			        	 * @hooked woocommerce_template_single_meta - 40
			        	 * @hooked woocommerce_template_single_sharing - 50
			        	 */
			        do_action( 'woocommerce_single_product_summary' );
				    ?>
			    </div>
			  </div>
		</div>
		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	</div><!-- #product-<?php the_ID(); ?> -->
	<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php } ?>