<?php
if ( ! thb_wc_supported() ) {
	return;
}
// Reviews Tab.
function thb_reviews_setup() {
	if ( 'off' === ot_get_option( 'shop_reviews_tab' ) ) {
		add_filter( 'woocommerce_product_tabs', 'thb_remove_reviews_tab', 98 );
		function thb_remove_reviews_tab( $tabs ) {
			unset( $tabs['reviews'] );
			return $tabs;
		}
	}
}
add_action( 'after_setup_theme', 'thb_reviews_setup' );

// Add WooCommerce assets to Edit Post Screen.
function set_wc_screen_ids( $screen ) {
	$screen[] = 'post';
	$screen[] = 'page';
	return $screen;
}
add_filter( 'woocommerce_screen_ids', 'set_wc_screen_ids' );

// Header Cart.
function thb_quick_cart() {
	if ( 'off' === ot_get_option( 'header_cart', 'on' ) ) {
		return;
	}
	?>
	<a class="quick_cart" data-target="open-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'thevoux' ); ?>">
		<?php get_template_part( 'assets/svg/cart.svg' ); ?>
		<span class="float_count"><?php echo esc_html( WC()->cart->cart_contents_count ); ?></span>
	</a>
	<?php
}
add_action( 'thb_quick_cart', 'thb_quick_cart', 3 );

// Product Badges.
function thb_product_badge() {
	global $post, $product;
	if ( thb_out_of_stock() ) {
		echo '<span class="badge out-of-stock">' . esc_html__( 'Out of Stock', 'thevoux' ) . '</span>';
	} elseif ( $product->is_on_sale() ) {
		if ( 'discount' === ot_get_option( 'shop_sale_badge', 'text' ) ) {
			if ( 'variable' === $product->get_type() ) {
				$available_variations = $product->get_available_variations();
				$maximumper           = 0;
				$count                = count( $available_variations );
				for ( $i = 0; $i < $count; ++$i ) {
					$variation_id      = $available_variations[ $i ]['variation_id'];
					$variable_product1 = new WC_Product_Variation( $variation_id );
					$regular_price     = $variable_product1->regular_price;
					$sales_price       = $variable_product1->sale_price;
					$percentage        = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ) : 0;
					if ( $percentage > $maximumper ) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters( 'woocommerce_sale_flash', '<span class="badge onsale perc">&darr; ' . esc_html( $maximumper ) . '%</span>', $post, $product );
			} elseif ( 'simple' === $product->get_type() ) {
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				echo apply_filters( 'woocommerce_sale_flash', '<span class="badge onsale perc">&darr; ' . esc_html( $percentage ) . '%</span>', $post, $product );
			}
		} else {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="badge onsale">' . esc_html__( 'Sale', 'thevoux' ) . '</span>', $post, $product );
		}
	} else {
		$postdate      = get_the_time( 'Y-m-d' );
		$postdatestamp = strtotime( $postdate );
		$newness       = ot_get_option( 'shop_newness', 7 );
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
			echo '<span class="badge new">' . esc_html__( 'Just Arrived', 'thevoux' ) . '</span>';
		}
	}
}
add_action( 'thb_product_badge', 'thb_product_badge', 3 );

// WOOCOMMERCE CART LINK.
function thb_woocomerce_ajax_cart_update( $fragments ) {
	ob_start();
	?>
		<span class="float_count"><?php echo esc_html( WC()->cart->cart_contents_count ); ?></span>
	<?php
	$fragments['.float_count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update' );

// Shop Page - Remove Breadcrumb.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'thb_breadcrumbs', 'woocommerce_breadcrumb', 20 );

// Category Text.
function thb_before_subcategory_title() {
	echo '<div>';
}
add_action( 'woocommerce_before_subcategory_title', 'thb_before_subcategory_title', 15 );

function thb_subcategory_title() {
	echo '<span>' . esc_html__( 'Explore Now', 'thevoux' ) . '</span>';
}
add_action( 'woocommerce_shop_loop_subcategory_title', 'thb_subcategory_title', 15 );

function thb_after_subcategory_title() {
	echo '</div>';
}
add_action( 'woocommerce_after_subcategory_title', 'thb_after_subcategory_title', 15 );

function thb_subcategory_count_html( $markup, $category ) {
	return '<mark class="count">' . $category->count . '</mark>';
}
add_filter( 'woocommerce_subcategory_count_html', 'thb_subcategory_count_html', 10, 2 );

// Change Category Thumbnail Size.
function thb_template_loop_category_link_open( $category ) {
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}
	echo '<a href="' . esc_url( get_term_link( $category, 'product_cat' ) ) . '" style="background-image:url(' . esc_attr( $image ) . ' )">';
}
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
add_action( 'woocommerce_before_subcategory', 'thb_template_loop_category_link_open', 10 );

// Shop Page - Remove orderby & breadcrumb.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

add_filter( 'woocommerce_loop_add_to_cart_args', 'thb_woocommerce_loop_add_to_cart_args', 10, 2 );
function thb_woocommerce_loop_add_to_cart_args( $args, $product ) {
	$get_shop_product_listing = filter_input( INPUT_GET, 'shop_product_listing', FILTER_SANITIZE_STRING );
	$shop_product_listing     = $get_shop_product_listing ? $get_shop_product_listing : ot_get_option( 'shop_product_listing', 'style1' );

	if ( 'style2' === $shop_product_listing ) {
		$args['class'] = $args['class'] . ' transparent-accent medium border-radius-small';
	}
	return $args;
}

// Product Page - Move tabs.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );

// Product Page - Move breadcrumbs.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'thb_woocommerce_product_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );

// Product Page - Remove Sale Flash.
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Product Page - Remove Related Products.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Product Page - Move Upsells.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 70 );

// Product Page - Move Sharing to top.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 35 );

// Product Page - Move Rating to top.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

// Product Page - Add Social Sharing.
add_action( 'woocommerce_single_product_summary', 'thb_social_product', 59 );

// Cart Page - Move Cross Sells.
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

// Out of Stock Check.
function thb_out_of_stock() {
	global $post;
	$thb_id = $post->ID;
	$status = get_post_meta( $thb_id, '_stock_status', true );

	if ( 'outofstock' === $status ) {
		return true;
	} else {
		return false;
	}
}

// Product Nav.
function thb_product_nav() {
	global $wp_query, $post;

	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
	}

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
		return;
	}
	?>
	<nav class="post_nav">
		<?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i>' . esc_html__( 'PREV', 'thevoux' ) ); ?>
		<?php next_post_link( '%link', esc_html__( 'NEXT', 'thevoux' ) . '<i class="fa fa-angle-right"></i>' ); ?>
	</nav>
	<?php
}

// Change breadcrumb delimiter.
add_filter( 'woocommerce_breadcrumb_defaults', 'thb_change_breadcrumb_delimiter' );
function thb_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = ' <span>&mdash;</span> ';
	return $defaults;
}

// Redirect to Homepage when customer log out.
add_filter( 'logout_url', 'thb_new_logout_url', 10, 2 );
function thb_new_logout_url( $logouturl, $redir ) {
	$redirect = get_option( 'siteurl' );
	return $logouturl . '&amp;redirect_to=' . rawurlencode( $redirect );
}

// Plugin Page Ajax Add to Cart.
function thb_woocommerce_single_product() {
	if ( ot_get_option( 'shop_product_ajax_addtocart', 'on' ) === 'off' ) {
		return;
	}

	function thb_ajax_add_to_cart_redirect_template() {
		$thb_ajax = filter_input( INPUT_GET, 'thb-ajax-add-to-cart', FILTER_VALIDATE_BOOLEAN );

		if ( $thb_ajax ) {
			wc_get_template( 'ajax/add-to-cart-fragments.php' );
			exit;
		}
	}
	add_action( 'wp', 'thb_ajax_add_to_cart_redirect_template', 1000 );
	function thb_woocommerce_after_add_to_cart_button() {
		global $product;
		?>
			<input type="hidden" name="action" value="wc_prod_ajax_to_cart" />
		<?php
		// Make sure we have the add-to-cart avaiable as button name doesn't submit via ajax.
		if ( $product->is_type( 'simple' ) ) {
			?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
			<?php
		}
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'thb_woocommerce_after_add_to_cart_button' );
	function thb_woocommerce_display_site_notice() {
		?>
		<div class="thb_prod_ajax_to_cart_notices"></div>
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'thb_woocommerce_display_site_notice', 10 );
}
add_action( 'before_woocommerce_init', 'thb_woocommerce_single_product' );
