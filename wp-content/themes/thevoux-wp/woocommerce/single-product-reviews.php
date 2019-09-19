<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div class="row">
	<div class="small-12 medium-10 medium-centered columns">
<div class="row">
	<div class="small-12 medium-10 medium-centered columns">
		<div id="reviews" class="woocommerce-Reviews">

		<div id="comments">
			<?php if ( have_comments() ) : ?>
				<div class="comment_container">
					<ol class="commentlist">
						<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
					</ol>
				</div>
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						) ) );
						echo '</nav>';
					endif; ?>
			<?php else : ?>

				<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'thevoux' ); ?></p>

			<?php endif; ?>
		</div>
			<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

				<div id="review_form_wrapper">
					<div id="review_form">
					<?php
						$commenter = wp_get_current_commenter();

						$comment_form = array(
							'title_reply' => false,
							'comment_notes_before' => '',
							'comment_notes_after' => '',
							'fields' => array(
								'author' => '<div class="row"><div class="small-12 medium-6 columns">' . '<label for="author">' . esc_html__( 'Name', 'thevoux' ) . ' <span class="required">*</span></label> ' .
								            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></div>',
								'email'  => '<div class="small-12 medium-6 columns"><label for="email">' . esc_html__( 'Email', 'thevoux' ) . ' <span class="required">*</span></label> ' .
								            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required /></div></div>',
							),
							'label_submit' => esc_html__( 'Submit Review', 'thevoux' ),
							'logged_in_as' => '',
							'comment_field' => ''
						);

						$account_page_url = wc_get_page_permalink( 'myaccount' );
						if ( $account_page_url ) {
							$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'thevoux' ), esc_url( $account_page_url ) ) . '</p>';
						}

						if ( wc_review_ratings_enabled() ) {

							$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Rating', 'thevoux' ) .'</label><select name="rating" id="rating">
								<option value="">'.esc_html__( 'Rate&hellip;', 'thevoux' ).'</option>
								<option value="5">'.esc_html__( 'Perfect', 'thevoux' ).'</option>
								<option value="4">'.esc_html__( 'Good', 'thevoux' ).'</option>
								<option value="3">'.esc_html__( 'Average', 'thevoux' ).'</option>
								<option value="2">'.esc_html__( 'Not that bad', 'thevoux' ).'</option>
								<option value="1">'.esc_html__( 'Very Poor', 'thevoux' ).'</option>
							</select></div>';


						}

						$comment_form['comment_field'] .= '<div class="row"><div class="small-12 columns"><label for="comment">' . esc_html__( 'Your Review', 'thevoux' ) . '</label><textarea id="comment" name="comment" required></textarea></div></div>';

						comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					?>
					</div>
				</div>
			<?php else : ?>

				<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'thevoux' ); ?></p>

			<?php endif; ?>
	</div>
</div>
	</div>
</div>