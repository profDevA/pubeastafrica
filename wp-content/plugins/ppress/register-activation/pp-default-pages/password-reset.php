<?php
namespace pp_default_pages;

/**
 * Create a password reset page powered by ProfilePress
 *
 * @package pp_default_pages
 */
class Password_Reset {

	/** insert the page to db */
	public static function instance() {
		// Create post object
		$post_args = array(
			'post_title'    => 'Reset Password',
			'post_content'  => '[profilepress-password-reset id="1"]',
			'post_status'   => 'publish',
			'post_type' => 'page'
		);

		// Insert the post into the database
		$insert = wp_insert_post( $post_args, true );

		if($insert && !is_wp_error($insert)) {
			return $insert;
		}
		else {
			return null;
		}
	}
}