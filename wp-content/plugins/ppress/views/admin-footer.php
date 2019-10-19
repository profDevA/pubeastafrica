<?php
/**
 * Admin Footer
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Add rating links to the admin dashboard
 *
 * @param       string $footer_text The existing footer text
 * @return      string
 */
function pp_admin_rate_us( $footer_text ) {

	if ( is_pp_admin_page() ) {
		$rate_text = sprintf( __( 'Thank you for using <a href="%1$s" target="_blank">ProfilePress</a>! Please <a href="%2$s" target="_blank">rate us</a> on <a href="%2$s" target="_blank">WordPress.org</a> | Upgrade to <a href="%3$s" target="_blank">Premium</a>.', 'ppress' ),
			'https://profilepress.net',
			'https://wordpress.org/support/view/plugin-reviews/ppress?filter=5#postform',
			'https://profilepress.net/pricing/'
		);

		return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
	} else {
		return $footer_text;
	}
}
add_filter( 'admin_footer_text', 'pp_admin_rate_us' );
