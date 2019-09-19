<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
?>
<?php if ( $rating_count > 0 ) : ?>
<div class="woocommerce-product-rating">
	<?php echo wc_get_rating_html( $average, $rating_count ); ?>
</div>
<?php endif; ?>
<?php if ($rating_count == 0) { ?>
<div class="woocommerce-product-rating cf" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	<a href="#comments" data-class="review-popup" class="write_first"><?php esc_html_e( 'Write the first review','thevoux' ); ?></a>
</div>
<?php } ?>